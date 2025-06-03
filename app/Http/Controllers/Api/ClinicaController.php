<?php

namespace App\Http\Controllers\Api;

use App\Clinica;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClinicaRequest;
use Illuminate\Support\Facades\Validator;

class ClinicaController extends Controller
{
    public function index(Request $request)
    {
        $query = Clinica::with(['regional', 'especialidades']);
        $filters = $request->only(['razao_social', 'nome_fantasia', 'cnpj', 'regional_id', 'ativa']);
        $sort = $request->get('sort', 'razao_social');
        $order = $request->get('order', 'asc');
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 2);
        $search = $request->get('search', '');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('razao_social', 'like', "%{$search}%")
                    ->orWhere('nome_fantasia', 'like', "%{$search}%")
                    ->orWhere('cnpj', 'like', "%{$search}%");
            });
        }

        if ($filters) {
            foreach ($filters as $key => $value) {
                if ($value !== null && $value !== '') {
                    $query->where($key, $value);
                }
            }
        }
        $query->orderBy($sort, $order);
        $clinicas = $query->paginate($perPage, ['*'], 'page', $page);
        return response()->json($clinicas);
    }

    public function store(Request $request)
    {
        $clinica = Clinica::create($request->only([
            'razao_social',
            'nome_fantasia',
            'cnpj',
            'regional_id',
            'data_inauguracao',
            'ativa',
        ]));


        $clinica->especialidades()->sync($request->especialidades);

        return response()->json([
            'message' => 'Clínica cadastrada com sucesso!',
            'clinica' => $clinica->load('regional', 'especialidades')
        ], 201);
    }



    public function show($id)
    {
        $clinica = Clinica::with(['regional', 'especialidades'])->find($id);

        if (!$clinica) {
            return response()->json(['message' => 'Clínica não encontrada.'], 404);
        }

        return response()->json($clinica, 200);
    }

    public function update(Request $request, $id)
    {
        $clinica = Clinica::find($id);

        if (!$clinica) {
            return response()->json(['message' => 'Clínica não encontrada.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:clinicas,cnpj,' . $clinica->id,
            'regional_id' => 'required|exists:regionais,id',
            'data_inauguracao' => 'required|date',
            'ativa' => 'boolean',
            'especialidades' => 'required|array|min:5',
            'especialidades.*' => 'string|size:36|exists:especialidades,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $clinica->update($request->only([
            'razao_social',
            'nome_fantasia',
            'cnpj',
            'regional_id',
            'data_inauguracao',
            'ativa'
        ]));

        $clinica->especialidades()->sync($request->especialidades);

        return response()->json([
            'message' => 'Clínica atualizada com sucesso!',
            'clinica' => $clinica->load('regional', 'especialidades')
        ], 200);
    }

    public function destroy($id)
    {
        $clinica = Clinica::find($id);

        if (!$clinica) {
            return response()->json(['message' => 'Clínica não encontrada.'], 404);
        }

        $clinica->especialidades()->detach();
        $clinica->delete();

        return response()->json(['message' => 'Clínica removida com sucesso.'], 204);
    }
}

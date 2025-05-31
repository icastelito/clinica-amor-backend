<?php

namespace App\Http\Controllers\Api;

use App\Clinica;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClinicaRequest;
use Illuminate\Support\Facades\Validator;

class ClinicaController extends Controller
{
    public function index()
    {
        $clinicas = Clinica::with(['regional', 'especialidades'])->paginate(10);

        return response()->json($clinicas, 200);
    }

    public function store(StoreClinicaRequest $request)
    {
        $clinica = Clinica::create($request->only([
            'razao_social',
            'nome_fantasia',
            'cnpj',
            'regional_id',
            'data_inauguracao',
            'ativa'
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
            'especialidades.*' => 'uuid|exists:especialidades,id',
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

    // Os métodos create() e edit() não são usados em APIs REST
    public function create() {}
    public function edit($id) {}
}

<?php

namespace App\Http\Controllers\Api;

use App\Regional;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class RegionalController extends Controller
{
    public function index()
    {
        return response()->json(Regional::all(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $regional = Regional::create([
            'id' => (string) Str::uuid(),
            'label' => $request->label,
        ]);

        return response()->json([
            'message' => 'Regional cadastrada com sucesso!',
            'regional' => $regional,
        ], 201);
    }

    public function show($id)
    {
        $regional = Regional::find($id);

        if (!$regional) {
            return response()->json(['message' => 'Regional não encontrada.'], 404);
        }

        return response()->json($regional, 200);
    }

    public function update(Request $request, $id)
    {
        $regional = Regional::find($id);

        if (!$regional) {
            return response()->json(['message' => 'Regional não encontrada.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'label' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $regional->update([
            'label' => $request->label,
        ]);

        return response()->json([
            'message' => 'Regional atualizada com sucesso!',
            'regional' => $regional,
        ], 200);
    }

    public function destroy($id)
    {
        $regional = Regional::find($id);

        if (!$regional) {
            return response()->json(['message' => 'Regional não encontrada.'], 404);
        }

        $regional->delete();

        return response()->json(['message' => 'Regional removida com sucesso.'], 204);
    }

    public function create() {}
    public function edit($id) {}
}

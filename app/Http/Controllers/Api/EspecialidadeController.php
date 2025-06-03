<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EspecialidadeController extends Controller
{
    public function index()
    {
        $especialidades = \App\Especialidade::all();

        return response()->json($especialidades);
    }
}

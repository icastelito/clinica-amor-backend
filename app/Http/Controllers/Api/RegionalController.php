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
}

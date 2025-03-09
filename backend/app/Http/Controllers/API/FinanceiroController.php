<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Lista de registros financeiros']);
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'Registro financeiro criado']);
    }

    public function show($id)
    {
        return response()->json(['message' => 'Detalhes do registro financeiro ' . $id]);
    }

    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Registro financeiro atualizado']);
    }

    public function destroy($id)
    {
        return response()->json(['message' => 'Registro financeiro removido']);
    }
}

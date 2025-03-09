<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessoController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Lista de processos']);
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'Processo criado']);
    }

    public function show($id)
    {
        return response()->json(['message' => 'Detalhes do processo ' . $id]);
    }

    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Processo atualizado']);
    }

    public function destroy($id)
    {
        return response()->json(['message' => 'Processo removido']);
    }

    public function adicionarNota(Request $request, $id)
    {
        return response()->json(['message' => 'Nota adicionada ao processo ' . $id]);
    }
}

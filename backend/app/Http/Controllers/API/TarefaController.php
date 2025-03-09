<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Lista de tarefas']);
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'Tarefa criada']);
    }

    public function show($id)
    {
        return response()->json(['message' => 'Detalhes da tarefa ' . $id]);
    }

    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Tarefa atualizada']);
    }

    public function destroy($id)
    {
        return response()->json(['message' => 'Tarefa removida']);
    }
}

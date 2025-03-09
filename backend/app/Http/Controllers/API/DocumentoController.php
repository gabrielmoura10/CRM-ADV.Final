<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Lista de documentos']);
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'Documento criado']);
    }

    public function show($id)
    {
        return response()->json(['message' => 'Detalhes do documento ' . $id]);
    }

    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Documento atualizado']);
    }

    public function destroy($id)
    {
        return response()->json(['message' => 'Documento removido']);
    }
}

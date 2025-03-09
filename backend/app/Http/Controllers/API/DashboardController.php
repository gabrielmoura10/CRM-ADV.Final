<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function diretor()
    {
        return response()->json([
            'processos_ativos' => 10,
            'clientes_ativos' => 5,
            'faturamento_mes' => 5000,
            'tarefas_pendentes' => 3
        ]);
    }

    public function advogado()
    {
        return response()->json([
            'processos_responsavel' => 5,
            'audiencias_proximas' => 2,
            'tarefas_pendentes' => 4
        ]);
    }
}

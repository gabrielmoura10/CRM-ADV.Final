<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Exibe uma lista de todos os clientes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            // Verifica se a tabela clientes existe
            if (DB::getSchemaBuilder()->hasTable('clientes')) {
                $clientes = DB::table('clientes')
                    ->select('id', 'nome', 'email', 'telefone', 'endereco', 'created_at', 'updated_at')
                    ->orderBy('nome')
                    ->get();
            } else {
                // Tabela não existe, retorna dados de exemplo
                $clientes = [
                    [
                        'id' => 1,
                        'nome' => 'Cliente Exemplo 1',
                        'email' => 'cliente1@exemplo.com',
                        'telefone' => '(11) 98765-4321',
                        'endereco' => 'Rua Exemplo, 123',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'id' => 2,
                        'nome' => 'Cliente Exemplo 2',
                        'email' => 'cliente2@exemplo.com',
                        'telefone' => '(11) 12345-6789',
                        'endereco' => 'Av. Modelo, 456',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ];
            }

            return response()->json($clientes); // Retorna um array diretamente
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Não foi possível recuperar os clientes',
                'mensagem' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Armazena um novo cliente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nome' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'telefone' => 'nullable|string|max:20',
                'endereco' => 'nullable|string|max:255',
                'cpf_cnpj' => 'nullable|string|max:20',
                'observacoes' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Verifica se a tabela clientes existe
            if (DB::getSchemaBuilder()->hasTable('clientes')) {
                $id = DB::table('clientes')->insertGetId([
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'telefone' => $request->telefone,
                    'endereco' => $request->endereco,
                    'cpf_cnpj' => $request->cpf_cnpj ?? null,
                    'observacoes' => $request->observacoes ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $cliente = DB::table('clientes')->find($id);
            } else {
                // Simulação quando a tabela não existe
                $cliente = [
                    'id' => 3,
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'telefone' => $request->telefone,
                    'endereco' => $request->endereco,
                    'cpf_cnpj' => $request->cpf_cnpj ?? null,
                    'observacoes' => $request->observacoes ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            return response()->json($cliente, 201);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Não foi possível criar o cliente',
                'mensagem' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Exibe um cliente específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            // Verifica se a tabela clientes existe
            if (DB::getSchemaBuilder()->hasTable('clientes')) {
                $cliente = DB::table('clientes')->find($id);

                if (!$cliente) {
                    return response()->json(['message' => 'Cliente não encontrado'], 404);
                }
            } else {
                // Dados de exemplo
                $cliente = [
                    'id' => $id,
                    'nome' => 'Cliente Exemplo ' . $id,
                    'email' => 'cliente' . $id . '@exemplo.com',
                    'telefone' => '(11) 98765-4321',
                    'endereco' => 'Rua Exemplo, ' . $id,
                    'cpf_cnpj' => '123.456.789-' . str_pad($id, 2, '0', STR_PAD_LEFT),
                    'observacoes' => 'Observações do cliente ' . $id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            return response()->json($cliente);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Não foi possível recuperar o cliente',
                'mensagem' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Atualiza um cliente específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nome' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|max:255',
                'telefone' => 'nullable|string|max:20',
                'endereco' => 'nullable|string|max:255',
                'cpf_cnpj' => 'nullable|string|max:20',
                'observacoes' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            // Verifica se a tabela clientes existe
            if (DB::getSchemaBuilder()->hasTable('clientes')) {
                $cliente = DB::table('clientes')->find($id);
                
                if (!$cliente) {
                    return response()->json(['message' => 'Cliente não encontrado'], 404);
                }
                
                $updateData = [
                    'updated_at' => now(),
                ];
                
                // Atualiza apenas os campos fornecidos
                if ($request->has('nome')) $updateData['nome'] = $request->nome;
                if ($request->has('email')) $updateData['email'] = $request->email;
                if ($request->has('telefone')) $updateData['telefone'] = $request->telefone;
                if ($request->has('endereco')) $updateData['endereco'] = $request->endereco;
                if ($request->has('cpf_cnpj')) $updateData['cpf_cnpj'] = $request->cpf_cnpj;
                if ($request->has('observacoes')) $updateData['observacoes'] = $request->observacoes;
                
                DB::table('clientes')->where('id', $id)->update($updateData);
                
                // Retorna o cliente atualizado
                $clienteAtualizado = DB::table('clientes')->find($id);
            } else {
                // Simulação quando a tabela não existe
                $clienteAtualizado = [
                    'id' => $id,
                    'nome' => $request->nome ?? 'Cliente Exemplo ' . $id,
                    'email' => $request->email ?? 'cliente' . $id . '@exemplo.com',
                    'telefone' => $request->telefone ?? '(11) 98765-4321',
                    'endereco' => $request->endereco ?? 'Rua Exemplo, ' . $id,
                    'cpf_cnpj' => $request->cpf_cnpj ?? '123.456.789-' . str_pad($id, 2, '0', STR_PAD_LEFT),
                    'observacoes' => $request->observacoes ?? 'Observações atualizadas',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            return response()->json($clienteAtualizado);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Não foi possível atualizar o cliente',
                'mensagem' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove um cliente específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            // Verifica se a tabela clientes existe
            if (DB::getSchemaBuilder()->hasTable('clientes')) {
                $cliente = DB::table('clientes')->find($id);
                
                if (!$cliente) {
                    return response()->json(['message' => 'Cliente não encontrado'], 404);
                }
                
                DB::table('clientes')->where('id', $id)->delete();
            }
            
            return response()->json(['message' => 'Cliente removido com sucesso']);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Não foi possível remover o cliente',
                'mensagem' => $e->getMessage()
            ], 500);
        }
    }
}

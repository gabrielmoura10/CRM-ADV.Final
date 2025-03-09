<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Sede;
use Illuminate\Support\Facades\Hash;

class SetupSeeder extends Seeder
{
    public function run(): void
    {
        // Criar sede principal
        $sede = Sede::create([
            'nome' => 'Sede Principal',
            'endereco' => 'Endereço da Sede Principal',
            'telefone' => '(00) 0000-0000'
        ]);

        // Criar usuário administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@exemplo.com',
            'password' => Hash::make('senha123'),
            'nivel' => 'DIRETOR',
            'sede_id' => $sede->id
        ]);
    }
}
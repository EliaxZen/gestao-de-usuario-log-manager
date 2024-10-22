<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Certifique-se de que você está usando o modelo User
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com', // Altere para o email desejado
            'password' => Hash::make('password'), // Altere para a senha desejada
            'tipo' => 'administrador',
            'telefone' => '12345678', // Altere conforme necessário
            'sexo' => 'Masculino', // Altere conforme necessário
        ]);
    }
}

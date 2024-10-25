<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     $order = Order::create([
    //         'nome_recebedor' => 'Elias Galvão',
    //         'cep' => '12345-678',
    //         'endereco' => 'Rua 123',
    //         'numero' => '100',
    //         'bairro' => 'Bairro Central',
    //         'cidade' => 'Cidade do Sul',
    //         'estado' => 'DF',
    //         'complemento' => 'Apartamento 101',
    //     ]);

    //     // Associar produtos ao pedido
    //     $order->products()->createMany([
    //         [
    //             'nome_produto' => 'Cebola',
    //             'preco_produto' => 2.50,
    //             'quantidade_produto' => 2,
    //         ],
    //         [
    //             'nome_produto' => 'Batata',
    //             'preco_produto' => 3.00,
    //             'quantidade_produto' => 1,
    //         ]
    //     ]);
    // }
}

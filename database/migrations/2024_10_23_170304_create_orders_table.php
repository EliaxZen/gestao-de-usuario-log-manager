<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nome_recebedor');
            $table->string('cep', 9);  // Ajuste o tamanho do CEP conforme necessário
            $table->string('endereco');
            $table->string('numero', 10);  // Limite para o número do endereço
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado', 2);  // Estado em formato sigla, ex.: 'SP'
            $table->text('complemento')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

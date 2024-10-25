<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_recebedor',
        'cep',
        'endereco',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'complemento',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

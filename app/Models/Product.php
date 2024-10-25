<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_produto',
        'preco_produto',
        'quantidade_produto',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

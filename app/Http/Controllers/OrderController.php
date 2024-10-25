<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products')->get();
        return view("orders.index", compact("orders"));
    }

    public function create()
    {
        return view("orders.create");
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nome_recebedor' => 'required|string',
            'cep' => 'required|string',
            'endereco' => 'required|string',
            'numero' => 'required|integer',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string',
            'complemento' => 'nullable|string',
            'products' => 'required|array|min:1', // Valida que ao menos um produto foi incluído
            'products.*.nome_produto' => 'required|string',
            'products.*.preco_produto' => 'required|numeric',
            'products.*.quantidade_produto' => 'required|integer',
        ]);

        $order = Order::create($request->only([
            'nome_recebedor',
            'cep',
            'endereco',
            'numero',
            'bairro',
            'cidade',
            'estado',
            'complemento'
        ]));

        foreach ($request->products as $productData) {
            $order->products()->create($productData);
        }

        return redirect()->route('orders.index')->with('success', 'Pedido criado com sucesso');
    }

    public function show($id)
    {
        $order = Order::with('products')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $order->load('products');
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'nome_recebedor' => 'required|string',
            'cep' => 'required|string',
            'endereco' => 'required|string',
            'numero' => 'required|integer',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string',
            'products.*.id' => 'nullable|integer', // Inclui o id para identificar produtos existentes
            'products.*.nome_produto' => 'required|string',
            'products.*.preco_produto' => 'required|numeric',
            'products.*.quantidade_produto' => 'required|integer',
        ]);

        $order->update($request->only([
            'nome_recebedor',
            'cep',
            'endereco',
            'numero',
            'bairro',
            'cidade',
            'estado',
            'complemento'
        ]));

        // Verifica produtos enviados
        $productIds = [];
        foreach ($request->products as $productData) {
            if (isset($productData['id'])) {
                // Atualiza produto existente
                $product = $order->products()->where('id', $productData['id'])->first();
                if ($product) {
                    $product->update($productData);
                    $productIds[] = $product->id;
                }
            } else {
                // Cria novo produto
                $newProduct = $order->products()->create($productData);
                $productIds[] = $newProduct->id;
            }
        }

        // Remove produtos que não foram enviados no request (foram deletados na edição)
        $order->products()->whereNotIn('id', $productIds)->delete();

        return redirect()->route('orders.index')->with('success', 'Pedido atualizado com sucesso');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pedido excluído com sucesso');
    }
}

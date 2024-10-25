<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view("products.index", compact("products"));
    }

    public function create()
    {
        return view("products.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_produto' => 'required|string',
            'preco_produto' => 'required|numeric',
            'quantidade_produto' => 'required|integer',
        ]);

        Product::create($request->only(['nome_produto', 'preco_produto', 'quantidade_produto']));

        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nome_produto' => 'required|string',
            'preco_produto' => 'required|numeric',
            'quantidade_produto' => 'required|integer',
        ]);

        $product->update($request->only(['nome_produto', 'preco_produto', 'quantidade_produto']));

        return redirect()->route('products.index')->with('success', 'Produto editado com sucesso');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produto excluído com sucesso');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view("products.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome_produto' => 'required|string',
            'preco_produto' => 'required|numeric|min:0',
            'quantidade_produto' => 'required|integer',
        ]);

        Product::create([
            'nome_produto' => $request->nome_produto,
            'preco_produto' => $request->preco_produto,
            'quantidade_produto' => $request->quantidade_produto,
        ]);

        return redirect()->route('products.index')->with('success','produto criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nome_produto' => 'required|string',
            'preco_produto' => 'required|numeric|min:0',
            'quantidade_produto' => 'required|integer',
        ]);

        $product->update([
            'nome_produto' => $request->nome_produto,
            'preco_produto' => $request->preco_produto,
            'quantidade_produto' => $request->quantidade_produto,
        ]);

        return redirect()->route('products.index')->with('success','produto editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','produto excluído com sucesso');
    }
}

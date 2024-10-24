<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view("orders.index", compact("orders"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("orders.create");
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
            'nome_recebedor' => 'required|string',
            'cep' => 'required',
            'endereco' => 'required',
            'numero' => 'required|integer',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado'=> 'required',
            'complemento' => 'nullable|string',
        ]);

        Order::create([
            'nome_recebedor'=> $request->nome_recebedor,
            'cep' => $request->cep,
            'endereco' => $request->endereco,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade'=> $request->cidade,
            'estado'=> $request->uf,
            'complemento'=> $request->complemento,
        ]);

        return redirect()->route('orders.index')->with('success','pedido criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'nome_recebedor' => 'required|string',
            'cep' => 'required',
            'endereco' => 'required',
            'numero' => 'required|integer',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'complemento' => 'nullable|string',
        ]);

        $order->update([
            'nome_recebedor' => $request->nome_recebedor,
            'cep' => $request->cep,
            'endereco' => $request->endereco,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->uf,
            'complemento' => $request->complemento,
        ]);

        return redirect()->route('orders.index')->with('success','pedido atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success','pedido excluido');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class UserController extends Controller
{
    public function index()
    {
        // Listar usuários
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        // Mostrar formulário de criação
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validar dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telefone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'tipo' => 'required|string|in:administrador,vendedor,transportadora',
        ]);

        // Limpar o telefone removendo caracteres não numéricos
        $telefoneLimpo = preg_replace('/\D/', '', $request->telefone);

        // Criar o usuário
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telefone' => $telefoneLimpo, // Salvando telefone limpo
            'password' => Hash::make($request->password),
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Usuário criado com sucesso!')->withInput();
    }

    public function edit(User $user)
    {
        // Mostrar formulário de edição
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validar dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'telefone' => 'required|string|max:15|min:14',
            'tipo' => 'required|string|in:administrador,vendedor,transportadora',
        ]);

        // Limpar o telefone removendo caracteres não numéricos
        $telefoneLimpo = preg_replace('/\D/', '', $request->telefone);

        // Atualizar o usuário
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'telefone' => $telefoneLimpo, // Salvando telefone limpo
            'tipo' => $request->tipo,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        // Excluir o usuário
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Usuário excluído com sucesso!');
    }
}

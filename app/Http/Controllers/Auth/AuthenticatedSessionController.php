<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Lógica de redirecionamento com base no tipo de usuário
        return $this->redirectUser(Auth::user());
    }

    /**
     * Redireciona o usuário para a página apropriada.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectUser($user)
    {
        if ($user->tipo === 'administrador') {
            return redirect()->route('dashboard'); // Rota para o painel do administrador
        } elseif ($user->tipo === 'vendedor') {
            return redirect()->route('dashboard'); // Rota para o painel do vendedor
        } elseif ($user->tipo === 'transportadora') {
            return redirect()->route('dashboard'); // Rota para o painel da transportadora
        }

        // Caso o tipo não seja reconhecido, redireciona para uma rota padrão
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

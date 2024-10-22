<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;


class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Tentativa de enviar o link de redefinição de senha para o e-mail fornecido
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Redireciona com mensagem de sucesso ou erro
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function sendAdminResetLink(Request $request, User $user)
    {
        // Envia o link de redefinição de senha para o e-mail do usuário
        $status = Password::sendResetLink(
            ['email' => $user->email]
        );

        // Retorna uma resposta de acordo com o status do envio
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}

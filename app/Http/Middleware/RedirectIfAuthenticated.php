<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Permitir acesso à página de redefinição de senha mesmo logado
                if ($request->route()->named('password.reset') || $request->route()->named('password.update')) {
                    return $next($request);
                }

                // Redirecionar se o usuário está logado e não está acessando a página de redefinição de senha
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}

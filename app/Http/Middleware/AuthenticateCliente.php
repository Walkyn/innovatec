<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthenticateCliente
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('AuthenticateCliente middleware: ', [
            'has_session' => session()->has('cliente_id'),
            'cliente_id' => session('cliente_id'),
            'current_route' => $request->route()->getName()
        ]);

        if (!session()->has('cliente_id')) {
            return redirect()->route('login-cliente')->with('errorDetails', 'Por favor inicie sesión para acceder');
        }

        return $next($request);
    }
} 
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserPermissions
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $routeName = $request->route()->getName();

        if ($user->id_rol === 1) {
            return $next($request);
        }

        // Obtener los módulos del usuario
        $modulos = $user->modulos->pluck('nombre_modulo')->toArray();

        $allowed = false;

        if (in_array('manage', $modulos)) {
            $allowedRoutes = ['services', 'contracts', 'months'];
            foreach ($allowedRoutes as $routePrefix) {
                if (str_starts_with($routeName, $routePrefix)) {
                    $allowed = true;
                    break;
                }
            }
        }

        if (!$allowed) {
            foreach ($modulos as $modulo) {
                if (str_starts_with($routeName, $modulo)) {
                    $allowed = true;
                    break;
                }
            }
        }

        if (!$allowed) {
            Auth::logout();
            return redirect()->route('sin-permisos');
        }

        return $next($request);
    }
}
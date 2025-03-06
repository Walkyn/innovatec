<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Debe ingresar su correo electrónico.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'password.required' => 'Debe ingresar su contraseña.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Verificar si el usuario es administrador o empleado
            if ($user->id_rol === 1) {
                return redirect()->route('home.index');
            } else {
                $modulos = $user->modulos;

                if ($modulos->isEmpty()) {
                    Auth::logout();
                    return redirect()->route('sin-permisos');
                }

                // Redirigir al primer módulo que tenga asignado
                $primerModulo = $modulos->first();

                if ($primerModulo->nombre_modulo === 'manage') {
                    return redirect()->route('services.index');
                }

                // Redirigir al módulo correspondiente
                return redirect()->route($primerModulo->nombre_modulo . '.index');
            }
        }

        return redirect()->route('login')->with([
            'errorDetails' => 'Credenciales incorrectas, por favor intenta otra vez',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

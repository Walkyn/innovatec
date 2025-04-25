<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfiguracionEmpresa;
class PanelController extends Controller
{

    public function index()
    {
        $configuracion = ConfiguracionEmpresa::first();
        return view('panel.login-cliente', compact('configuracion'));
    }

    public function dashboard()
    {
        return view('panel.dashboard');
    }

    public function miPerfil()
    {
        return view('panel.mi-perfil');
    }

    public function realizarPago()
    {
        return view('panel.realizar-pago');
    }

    public function historialPagos()
    {
        return view('panel.historial-pago');
    }

    public function comprobantes()
    {
        return view('panel.comprobantes');
    }

    public function mesesPendientes()
    {
        return view('panel.meses-pendientes');
    }

    public function cambiarPassword()
    {
        return view('panel.cambiar-password');
    }

    public function mensajes()
    {
        return view('panel.mensajes');
    }

    public function misPagos()
    {
        return view('panel.mis-pagos');
    }

    public function updatePassword(Request $request)
    {
        // Validar los datos
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        try {
            // Obtener el usuario autenticado
            $user = auth()->user();

            // Verificar que el DNI coincida con el usuario
            if ($user->dni !== $request->dni) {
                return back()->with('error', 'El DNI ingresado no coincide con tu cuenta');
            }

            // Actualizar la contraseña
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Contraseña actualizada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la contraseña');
        }
    }
}

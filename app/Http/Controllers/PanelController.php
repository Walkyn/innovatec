<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfiguracionEmpresa;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;

class PanelController extends Controller
{

    public function index()
    {
        $configuracion = ConfiguracionEmpresa::first();
        return view('panel.login-cliente', compact('configuracion'));
    }

    public function dashboard()
    {
        $configuracion = ConfiguracionEmpresa::first();
        return view('panel.dashboard', compact('configuracion'));
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
            $user = auth()->cliente();

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

    public function login(Request $request)
    {
        $request->validate([
            'identificacion' => 'required',
            'clave_acceso' => 'required'
        ], [
            'identificacion.required' => 'Por favor, ingrese su identificación',
            'clave_acceso.required' => 'Por favor, ingrese su contraseña'
        ]);

        try {
            $cliente = Cliente::where('identificacion', $request->identificacion)
                             ->where('estado_cliente', 'activo')
                             ->first();

            if (!$cliente || !Hash::check($request->clave_acceso, $cliente->clave_acceso)) {
                return back()->with('errorDetails', 'Credenciales incorrectas')->withInput();
            }

            // Limpiar cualquier sesión existente antes de iniciar la nueva
            session()->forget(['cliente_id', 'cliente_nombre']);
            
            // Iniciar sesión del cliente
            session(['cliente_id' => $cliente->id]);
            session(['cliente_nombre' => $cliente->nombres . ' ' . $cliente->apellidos]);

            return redirect()->route('panel.dashboard');
            
        } catch (\Exception $e) {
            return back()->with('errorDetails', 'Error al iniciar sesión. Por favor, intente nuevamente.')->withInput();
        }
    }

    public function logout()
    {
        session()->forget(['cliente_id', 'cliente_nombre']);
        return redirect()->route('login-cliente')->with('success', 'Sesión cerrada correctamente');
    }
}

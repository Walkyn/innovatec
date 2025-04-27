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
        $cliente = \App\Models\Cliente::find(session('cliente_id'));
        $contratos = \App\Models\Contrato::where('cliente_id', $cliente->id)
            ->orderByDesc('fecha_contrato')
            ->get();
        return view('panel.meses-pendientes', compact('contratos'));
    }

    public function cambiarPassword()
    {
        return view('panel.cambiar-password');
    }

    public function mensajes()
    {
        return view('panel.mensajes');
    }

    public function historialServicios()
    {
        return view('panel.historial-servicios');
    }

    public function misPagos()
    {
        return view('panel.mis-pagos');
    }

    public function updatePassword(Request $request)
    {
        return view('panel.cambiar-password');
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
        return redirect()->route('login-cliente')->with('successDetails', 'Sesión cerrada correctamente');
    }
}

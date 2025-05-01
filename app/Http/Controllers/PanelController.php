<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfiguracionEmpresa;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use App\Models\MedioPago;

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
        // Obtener todos los medios de pago
        $mediosPago = MedioPago::all();
        
        // Mapeo de códigos a nombres completos
        $nombresMediosPago = [
            'BCP' => 'BCP',
            'BBVA' => 'BBVA', 
            'BN' => 'Banco de la Nación',
            'CAJA_PIURA' => 'Caja Piura',
            'YAPE' => 'Yape',
            'PLIN' => 'Plin',
        ];
        
        // Agregar el nombre legible a cada medio de pago
        foreach ($mediosPago as $medioPago) {
            $medioPago->nombre_tipo_pago = $nombresMediosPago[$medioPago->tipo_pago] ?? $medioPago->tipo_pago;
        }
        
        return view('panel.realizar-pago', compact('mediosPago'));
    }

    public function historialPagos()
    {
        return $this->historialPago();
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

    /**
     * Guarda un nuevo pago realizado por el cliente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardarPago(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'medio_pago' => 'required|string',
            'servicios' => 'required|json',
            'total_pagar' => 'required|numeric',
            'comprobante' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120', // 5MB máximo
        ]);

        try {
            // Procesar los servicios JSON
            $servicios = json_decode($request->servicios, true);
            if (empty($servicios)) {
                return response()->json(['error' => 'No hay servicios seleccionados'], 422);
            }

            // Procesar y guardar el archivo de comprobante
            $comprobantePath = null;
            if ($request->hasFile('comprobante') && $request->file('comprobante')->isValid()) {
                $file = $request->file('comprobante');
                $filename = 'comprobante_' . time() . '.' . $file->getClientOriginalExtension();
                $comprobantePath = $file->storeAs('comprobantes', $filename, 'public');
            }

            // Crear un array con todos los meses pagados
            $mesesPagados = [];
            $detallesServicio = [];

            foreach ($servicios as $servicio) {
                $detallesServicio[] = [
                    'contrato' => $servicio['contratoNumero'],
                    'servicio' => $servicio['servicioNombre'],
                    'precio' => $servicio['precio'],
                    'subtotal' => $servicio['subtotal']
                ];
                
                // Agregar los meses a la lista total de meses pagados
                if (!empty($servicio['mesesTexto'])) {
                    $mesesPagados[] = $servicio['mesesTexto'];
                }
            }

            // Crear el registro de pago
            $pago = new \App\Models\Pago([
                'cliente_id' => session('cliente_id'),
                'medio_pago' => $validated['medio_pago'],
                'detalles_servicio' => json_encode($detallesServicio),
                'meses_pagados' => implode(', ', $mesesPagados),
                'monto_total' => $validated['total_pagar'],
                'comprobante_path' => $comprobantePath,
                'estado' => 'en_revision'
            ]);

            $pago->save();

            return response()->json([
                'success' => true,
                'message' => 'Pago registrado correctamente. Está en revisión por nuestro equipo.',
                'pago_id' => $pago->id
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error al guardar pago: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error al procesar el pago: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Muestra la lista de pagos del cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function listarPagos()
    {
        $cliente_id = session('cliente_id');
        $pagos = \App\Models\Pago::where('cliente_id', $cliente_id)
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('panel.pagos', compact('pagos'));
    }

    /**
     * Muestra el historial de pagos del cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function historialPago()
    {
        $cliente_id = session('cliente_id');
        
        // Consultar todos los pagos para las estadísticas
        $todosPagos = \App\Models\Pago::where('cliente_id', $cliente_id)->get();
        
        // Consultar los pagos paginados para la tabla
        $pagos = \App\Models\Pago::where('cliente_id', $cliente_id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        
        // Calcular estadísticas por estado
        $totales = [
            'Aceptado' => ['count' => 0, 'sum' => 0],
            'en_revision' => ['count' => 0, 'sum' => 0],
            'Rechazado' => ['count' => 0, 'sum' => 0]
        ];
        
        foreach($todosPagos as $pago) {
            if (isset($totales[$pago->estado])) {
                $totales[$pago->estado]['count']++;
                $totales[$pago->estado]['sum'] += $pago->monto_total;
            }
        }
        
        return view('panel.historial-pago', compact('pagos', 'totales'));
    }
}

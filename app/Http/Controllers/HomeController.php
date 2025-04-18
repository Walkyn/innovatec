<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Cobranza;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $totalClientes = Cliente::count();
        $totalUsuarios = User::count();
        $totalUsuariosActivos = User::where('last_activity', '>=', now()->subMinutes(5)->timestamp)->count();
        $cantidadClientesActivos = Cliente::where('estado_cliente', 'activo')->count();
        
        // Calcular porcentajes
        $porcentajeClientesActivos = $totalClientes > 0 ? round(($cantidadClientesActivos / $totalClientes) * 100, 2) : 0;
        $porcentajeUsuariosActivos = $totalUsuarios > 0 ? round(($totalUsuariosActivos / $totalUsuarios) * 100, 2) : 0;
        
        // Obtener el período seleccionado (por defecto 'dia')
        $periodo = $request->periodo ?? 'dia';
        
        // Configurar las fechas según el período
        $fechaInicio = now()->startOfDay();
        $fechaFin = now()->endOfDay();
        
        switch($periodo) {
            case 'semana':
                $fechaInicio = now()->startOfWeek();
                $fechaFin = now()->endOfWeek();
                break;
            case 'mes':
                $fechaInicio = now()->startOfMonth();
                $fechaFin = now()->endOfMonth();
                break;
        }
        
        // Consultar cobranzas según el período
        $clientesCobrados = Cobranza::whereBetween('fecha_cobro', [$fechaInicio, $fechaFin])
            ->where('estado_cobro', 'emitido')
            ->distinct('cliente_id')
            ->count('cliente_id');
            
        $totalCobrado = Cobranza::whereBetween('fecha_cobro', [$fechaInicio, $fechaFin])
            ->where('estado_cobro', 'emitido')
            ->sum('monto_total');
        
        // Obtener clientes únicos cobrados este mes
        $clientesCobradosMes = Cobranza::where('estado_cobro', 'emitido')
            ->whereMonth('fecha_cobro', now()->month)
            ->whereYear('fecha_cobro', now()->year)
            ->distinct('cliente_id')
            ->count('cliente_id');
        
        // Calcular el porcentaje de clientes cobrados respecto a los activos
        $porcentajeClientesCobrados = $cantidadClientesActivos > 0 
            ? round(($clientesCobradosMes / $cantidadClientesActivos) * 100, 2) 
            : 0;

        // Calcular el total de servicios activos contratados
        $ingresoTotalServicios = DB::table('contrato_servicio')
            ->join('contratos', 'contrato_servicio.contrato_id', '=', 'contratos.id')
            ->join('planes', 'contrato_servicio.plan_id', '=', 'planes.id')
            ->where('contrato_servicio.estado_servicio_cliente', 'activo')
            ->sum('planes.precio');

        // Calcular el total cobrado este mes
        $totalCobradoMes = Cobranza::where('estado_cobro', 'emitido')
            ->whereMonth('fecha_cobro', now()->month)
            ->whereYear('fecha_cobro', now()->year)
            ->sum('monto_total');

        // Calcular el ingreso del mes anterior para comparación
        $ingresoMesAnterior = DB::table('contrato_servicio')
            ->join('contratos', 'contrato_servicio.contrato_id', '=', 'contratos.id')
            ->join('planes', 'contrato_servicio.plan_id', '=', 'planes.id')
            ->where('contrato_servicio.estado_servicio_cliente', 'activo')
            ->where('contrato_servicio.created_at', '<', now()->startOfMonth())
            ->sum('planes.precio');

        // Calcular el porcentaje de variación
        $porcentajeVariacion = 0;
        if ($ingresoMesAnterior > 0) {
            $porcentajeVariacion = round((($ingresoTotalServicios - $ingresoMesAnterior) / $ingresoMesAnterior) * 100, 2);
        }

        return view('home.index', compact(
            'totalClientes',
            'totalUsuariosActivos',
            'cantidadClientesActivos',
            'porcentajeClientesActivos',
            'porcentajeUsuariosActivos',
            'clientesCobrados',
            'totalCobrado',
            'periodo',
            'clientesCobradosMes',
            'porcentajeClientesCobrados',
            'totalCobradoMes',
            'ingresoTotalServicios',
            'porcentajeVariacion'
        ));
    }

    // Agregar método para AJAX
    public function obtenerDatosPeriodo(Request $request)
    {
        $periodo = $request->periodo ?? 'dia';
        
        // Configurar fechas según período
        $fechaInicio = now()->startOfDay();
        $fechaFin = now()->endOfDay();
        
        // Configurar locale en español
        setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain.1252');
        Carbon::setLocale('es');
        
        switch($periodo) {
            case 'semana':
                $fechaInicio = now()->startOfWeek();
                $fechaFin = now()->endOfWeek();
                break;
            case 'mes':
                $fechaInicio = now()->startOfMonth();
                $fechaFin = now()->endOfMonth();
                break;
        }

        if ($periodo === 'dia') {
            // Para día, agrupar por hora y contar clientes únicos
            $cobranzas = Cobranza::where('estado_cobro', 'emitido')
                ->whereDate('fecha_cobro', now())
                ->selectRaw('HOUR(fecha_cobro) as hora, 
                            COUNT(DISTINCT cliente_id) as total_clientes,
                            SUM(monto_total) as total_cobros')
                ->groupBy('hora')
                ->orderBy('hora')
                ->get();

            $fechas = [];
            $clientes = [];
            $cobros = [];

            for ($hora = 0; $hora < 24; $hora++) {
                $horaFormato = str_pad($hora, 2, '0', STR_PAD_LEFT) . ':00';
                $fechas[] = $horaFormato;
                
                $cobranzaHora = $cobranzas->where('hora', $hora)->first();
                $clientes[] = $cobranzaHora ? $cobranzaHora->total_clientes : 0;
                $cobros[] = $cobranzaHora ? $cobranzaHora->total_cobros : 0;
            }
        } else {
            // Para semana y mes, agrupar por fecha y contar clientes únicos
            $cobranzas = Cobranza::where('estado_cobro', 'emitido')
                ->whereBetween('fecha_cobro', [$fechaInicio, $fechaFin])
                ->selectRaw('DATE(fecha_cobro) as fecha, 
                            COUNT(DISTINCT cliente_id) as total_clientes,
                            SUM(monto_total) as total_cobros')
                ->groupBy('fecha')
                ->orderBy('fecha')
                ->get();

            $fechas = [];
            $clientes = [];
            $cobros = [];

            foreach ($cobranzas as $cobranza) {
                $fecha = Carbon::parse($cobranza->fecha);
                
                if ($periodo === 'semana') {
                    $fechas[] = ucfirst($fecha->isoFormat('dddd'));
                } else {
                    $fechas[] = $fecha->isoFormat('D [de] MMMM');
                }
                
                $clientes[] = (int)$cobranza->total_clientes;
                $cobros[] = (float)$cobranza->total_cobros;
            }
        }

        // Calcular el total de clientes únicos para todo el período
        $totalClientesUnicos = Cobranza::where('estado_cobro', 'emitido')
            ->whereBetween('fecha_cobro', [$fechaInicio, $fechaFin])
            ->distinct('cliente_id')
            ->count('cliente_id');

        $totalCobrado = $cobranzas->sum('total_cobros');

        return response()->json([
            'success' => true,
            'clientesCobrados' => $totalClientesUnicos,
            'totalCobrado' => number_format($totalCobrado, 2),
            'grafico' => [
                'fechas' => $fechas,
                'clientes' => $clientes,
                'cobros' => $cobros
            ]
        ]);
    }
}

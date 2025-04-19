<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Cliente;
use App\Models\Cobranza;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $semana = $request->get('semana', 'actual');
        
        if ($semana === 'anterior') {
            $startOfWeek = Carbon::now()->subWeek()->startOfWeek();
            $endOfWeek = Carbon::now()->subWeek()->endOfWeek();
        } else {
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();
        }

        $cobranzas = DB::table('cobranzas')
            ->select(
                DB::raw('DATE(fecha_cobro) as fecha'),
                DB::raw('COUNT(DISTINCT cliente_id) as total_clientes'),
                DB::raw('SUM(monto_total) as monto_total')
            )
            ->whereBetween('fecha_cobro', [$startOfWeek, $endOfWeek])
            ->groupBy('fecha')
            ->get();

        $datosGrafico = [
            'fechas' => [],
            'total_clientes' => [],
            'montos' => [],
            'semanaSeleccionada' => $semana
        ];

        foreach ($cobranzas as $cobranza) {
            Carbon::setLocale('es');
            $dia = Carbon::parse($cobranza->fecha)->format('D');
            $diaEspanol = match($dia) {
                'Mon' => 'Lun',
                'Tue' => 'Mar',
                'Wed' => 'Mié',
                'Thu' => 'Jue',
                'Fri' => 'Vie',
                'Sat' => 'Sáb',
                'Sun' => 'Dom',
                default => $dia,
            };
            
            $datosGrafico['fechas'][] = $diaEspanol;
            $datosGrafico['total_clientes'][] = intval($cobranza->total_clientes);
            $datosGrafico['montos'][] = floatval($cobranza->monto_total);
        }

        $now = Carbon::now();
        
        $chartData = [
            'pagoEfectivo' => Cobranza::whereMonth('fecha_cobro', $now->month)
                ->whereYear('fecha_cobro', $now->year)
                ->where('estado_cobro', 'emitido')
                ->where('tipo_pago', 'efectivo')
                ->sum('monto_total'),
                
            'pagoDeposito' => Cobranza::whereMonth('fecha_cobro', $now->month)
                ->whereYear('fecha_cobro', $now->year)
                ->where('estado_cobro', 'emitido')
                ->where('tipo_pago', 'deposito')
                ->sum('monto_total'),
                
            'totalEmitido' => Cobranza::whereMonth('fecha_cobro', $now->month)
                ->whereYear('fecha_cobro', $now->year)
                ->where('estado_cobro', 'emitido')
                ->sum('monto_total'),
                
            'totalAnulado' => Cobranza::whereMonth('fecha_cobro', $now->month)
                ->whereYear('fecha_cobro', $now->year)
                ->where('estado_cobro', 'anulado')
                ->sum('monto_total')
        ];

        return view('reports.index', compact('datosGrafico', 'chartData'));
    }
}

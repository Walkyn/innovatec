<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cobranza;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getChartData()
    {
        $now = Carbon::now();
        
        $clientesActivos = Cliente::where('estado_cliente', 'activo')->count();
        
        $clientesCobrados = Cobranza::whereMonth('fecha_cobro', $now->month)
            ->whereYear('fecha_cobro', $now->year)
            ->distinct('cliente_id')
            ->count('cliente_id');
            
        $totalEmitido = Cobranza::whereMonth('fecha_cobro', $now->month)
            ->whereYear('fecha_cobro', $now->year)
            ->where('estado_cobro', 'emitido')
            ->sum('monto_total');
            
        $cobrosAnulados = Cobranza::whereMonth('fecha_cobro', $now->month)
            ->whereYear('fecha_cobro', $now->year)
            ->where('estado_cobro', 'anulado')
            ->count();

        return [
            'clientesActivos' => $clientesActivos,
            'clientesCobrados' => $clientesCobrados,
            'totalEmitido' => $totalEmitido,
            'cobrosAnulados' => $cobrosAnulados
        ];
    }
} 
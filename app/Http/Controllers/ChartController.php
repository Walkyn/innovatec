<?php

namespace App\Http\Controllers;

use App\Models\Cobranza;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function obtenerDatosChart02(Request $request)
    {
        $periodo = $request->periodo;
        $now = Carbon::now();
        $now->locale('es'); // Establecer locale en español
        
        switch($periodo) {
            case 'semana_actual':
                $inicio = $now->startOfWeek();
                $fin = $now->copy()->endOfWeek();
                $datos = Cobranza::selectRaw('DATE(fecha_cobro) as fecha, COUNT(DISTINCT cliente_id) as clientes, SUM(monto_total) as total')
                    ->whereBetween('fecha_cobro', [$inicio, $fin])
                    ->where('estado_cobro', 'emitido')
                    ->groupBy('fecha')
                    ->get();
                $labels = collect(range(0, 6))->map(fn($i) => ucfirst($inicio->copy()->addDays($i)->isoFormat('ddd')));
                break;
                
            case 'semana_anterior':
                $inicio = $now->copy()->subWeek()->startOfWeek();
                $fin = $inicio->copy()->endOfWeek();
                $datos = Cobranza::selectRaw('DATE(fecha_cobro) as fecha, COUNT(DISTINCT cliente_id) as clientes, SUM(monto_total) as total')
                    ->whereBetween('fecha_cobro', [$inicio, $fin])
                    ->where('estado_cobro', 'emitido')
                    ->groupBy('fecha')
                    ->get();
                $labels = collect(range(0, 6))->map(fn($i) => ucfirst($inicio->copy()->addDays($i)->isoFormat('ddd')));
                break;
                
            case 'mes_actual':
                $datosMeses = Cobranza::selectRaw('MONTH(fecha_cobro) as mes, COUNT(DISTINCT cliente_id) as clientes, SUM(monto_total) as total')
                    ->whereYear('fecha_cobro', $now->year)
                    ->where('estado_cobro', 'emitido')
                    ->groupBy('mes')
                    ->orderBy('mes')
                    ->get()
                    ->keyBy('mes');

                // Array con nombres de meses en español
                $nombresMeses = [
                    1 => 'Enero',
                    2 => 'Febrero',
                    3 => 'Marzo',
                    4 => 'Abril',
                    5 => 'Mayo',
                    6 => 'Junio',
                    7 => 'Julio',
                    8 => 'Agosto',
                    9 => 'Septiembre',
                    10 => 'Octubre',
                    11 => 'Noviembre',
                    12 => 'Diciembre'
                ];

                $datos = [];
                $labels = [];
                
                foreach ($nombresMeses as $mes => $nombre) {
                    $labels[] = $nombre;
                    if (isset($datosMeses[$mes])) {
                        $datos[] = [
                            'mes' => $mes,
                            'total' => round($datosMeses[$mes]->total, 2),
                            'clientes' => $datosMeses[$mes]->clientes
                        ];
                    } else {
                        $datos[] = [
                            'mes' => $mes,
                            'total' => 0,
                            'clientes' => 0
                        ];
                    }
                }

                return response()->json([
                    'labels' => $labels,
                    'series' => [
                        [
                            'name' => 'Total Cobrado',
                            'data' => collect($datos)->pluck('total')
                        ],
                        [
                            'name' => 'Clientes Cobrados',
                            'data' => collect($datos)->pluck('clientes')
                        ]
                    ]
                ]);
                break;
                
            case 'todos_años':
                $datos = Cobranza::selectRaw('YEAR(fecha_cobro) as año, COUNT(DISTINCT cliente_id) as clientes, SUM(monto_total) as total')
                    ->where('estado_cobro', 'emitido')
                    ->groupBy('año')
                    ->orderBy('año')
                    ->get();
                $labels = $datos->pluck('año')->map(fn($año) => $año);
                break;
        }
        
        return response()->json([
            'labels' => $labels,
            'datos' => $datos,
            'series' => [
                [
                    'name' => 'Total Cobrado',
                    'data' => $datos->pluck('total')->map(fn($val) => round($val, 2))
                ],
                [
                    'name' => 'Clientes Cobrados',
                    'data' => $datos->pluck('clientes')
                ]
            ]
        ]);
    }
} 
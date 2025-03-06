<?php

namespace App\Http\Controllers;

use App\Models\Mes;
use Carbon\Carbon;

class MesController extends Controller
{
    public function index()
    {
        $anioActual = Carbon::now()->year;
        $mesesPorAnio = Mes::all();
        $meses = Mes::select('anio')->distinct()->paginate(7);
        return view('months.index', compact('meses', 'anioActual','mesesPorAnio'));
    }

    public function store()
    {
        $anioActual = Carbon::now()->year;

        $meses = [
            ['nombre' => 'Enero', 'numero' => 1],
            ['nombre' => 'Febrero', 'numero' => 2],
            ['nombre' => 'Marzo', 'numero' => 3],
            ['nombre' => 'Abril', 'numero' => 4],
            ['nombre' => 'Mayo', 'numero' => 5],
            ['nombre' => 'Junio', 'numero' => 6],
            ['nombre' => 'Julio', 'numero' => 7],
            ['nombre' => 'Agosto', 'numero' => 8],
            ['nombre' => 'Septiembre', 'numero' => 9],
            ['nombre' => 'Octubre', 'numero' => 10],
            ['nombre' => 'Noviembre', 'numero' => 11],
            ['nombre' => 'Diciembre', 'numero' => 12],
        ];

        $existenTodos = true;
        $mesesFaltantes = [];

        foreach ($meses as $mes) {
            $existe = Mes::where('anio', $anioActual)
                ->where('numero', $mes['numero'])
                ->exists();

            if (!$existe) {

                $mesesFaltantes[] = $mes;
                $existenTodos = false;
            }
        }

        if ($existenTodos) {

            return redirect()->route('months.index')->with([
                'warningMessage' => 'Atención',
                'warningDetails' => 'Todos los meses ya fueron generados previamente.'
            ]);
        } else {
            // Insertar los meses faltantes
            foreach ($mesesFaltantes as $mes) {
                $fechaInicio = Carbon::create($anioActual, $mes['numero'], 1)->format('Y-m-d');
                $fechaFin = Carbon::create($anioActual, $mes['numero'], 1)->endOfMonth()->format('Y-m-d');

                Mes::create([
                    'nombre' => $mes['nombre'],
                    'numero' => $mes['numero'],
                    'anio' => $anioActual,
                    'fecha_inicio' => $fechaInicio,
                    'fecha_fin' => $fechaFin,
                ]);
            }

            // Mostrar mensaje de éxito si se insertaron meses
            return redirect()->route('months.index')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Meses generados correctamente.'
            ]);
        }
    }
}

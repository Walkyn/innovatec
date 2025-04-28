<?php

namespace App\Http\Controllers;

use App\Models\Mes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MesController extends Controller
{
    public function index()
    {
        $anioActual = Carbon::now()->year;
        $mesesPorAnio = Mes::all();
        $meses = Mes::select('anio')->distinct()->paginate(7);
        return view('months.index', compact('meses', 'anioActual','mesesPorAnio'));
    }

    public function store(Request $request)
    {
        // 1) Leer el input 'anio', con fallback al año actual
        $anioInput = $request->input('anio', Carbon::now()->year);
        // 2) Extraer solo la parte del año si viene "YYYY-MM"
        if (strpos($anioInput, '-') !== false) {
            $anio = intval(explode('-', $anioInput)[0]);
        } else {
            $anio = intval($anioInput);
        }

        // 3) Arreglo de nombres de meses
        $meses = [
            ['nombre'=>'Enero','numero'=>1],
            ['nombre'=>'Febrero','numero'=>2],
            ['nombre'=>'Marzo','numero'=>3],
            ['nombre'=>'Abril','numero'=>4],
            ['nombre'=>'Mayo','numero'=>5],
            ['nombre'=>'Junio','numero'=>6],
            ['nombre'=>'Julio','numero'=>7],
            ['nombre'=>'Agosto','numero'=>8],
            ['nombre'=>'Septiembre','numero'=>9],
            ['nombre'=>'Octubre','numero'=>10],
            ['nombre'=>'Noviembre','numero'=>11],
            ['nombre'=>'Diciembre','numero'=>12],
        ];

        // 4) Comprobar qué meses faltan
        $faltantes = [];
        foreach ($meses as $m) {
            $existe = Mes::where('anio', $anio)
                         ->where('numero', $m['numero'])
                         ->exists();
            if (!$existe) {
                $faltantes[] = $m;
            }
        }

        if (empty($faltantes)) {
            // Ya existen todos
            return redirect()
                ->route('months.index')
                ->with('warningMessage','Atención')
                ->with('warningDetails',"Todos los meses de $anio ya existen.");
        }

        // 5) Insertar los que faltan
        foreach ($faltantes as $m) {
            $inicio = Carbon::create($anio, $m['numero'], 1)->format('Y-m-d');
            $fin    = Carbon::create($anio, $m['numero'], 1)
                            ->endOfMonth()
                            ->format('Y-m-d');

            Mes::create([
                'nombre'       => $m['nombre'],
                'numero'       => $m['numero'],
                'anio'         => $anio,
                'fecha_inicio' => $inicio,
                'fecha_fin'    => $fin,
            ]);
        }

        // 6) Redirigir mostrando éxito
        return redirect()
            ->route('months.index')
            ->with('successMessage','Éxito')
            ->with('successDetails',"Meses de $anio generados correctamente.");
    }
}

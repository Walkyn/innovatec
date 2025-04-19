@php
    $now = Carbon\Carbon::now();
    $now->locale('es');
    
    // Obtener todos los usuarios que han realizado cobros
    $usuarios = App\Models\User::whereHas('cobranzas')->get();
    
    // Obtener los últimos 12 meses
    $meses = collect(range(11, 0, -1))->map(function($i) use ($now) {
        $fecha = $now->copy()->subMonths($i);
        return [
            'nombre' => ucfirst($fecha->translatedFormat('M')),
            'fecha' => $fecha->format('Y-m')
        ];
    });
    
    // Preparar datos para cada usuario
    $datosUsuarios = [];
    foreach ($usuarios as $usuario) {
        $cobrosPorMes = [];
        foreach ($meses as $mes) {
            $fecha = Carbon\Carbon::createFromFormat('Y-m', $mes['fecha']);
            $cobros = App\Models\Cobranza::where('usuario_id', $usuario->id)
                ->whereYear('fecha_cobro', $fecha->year)
                ->whereMonth('fecha_cobro', $fecha->month)
                ->where('estado_cobro', 'emitido')
                ->sum('monto_total');
            $cobrosPorMes[] = round($cobros, 2);
        }
        $datosUsuarios[$usuario->id] = $cobrosPorMes;
    }
@endphp

<div class="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5">
    <div class="mb-3 justify-between gap-4 sm:flex">
        <div>
            <h3 class="text-xl font-bold text-black dark:text-white">
                Análisis de Cobros por Usuario
            </h3>
        </div>
        <div>
            <select id="usuarioSelect" class="bg-white border rounded-md px-3 py-1 mr-2 dark:bg-boxdark dark:border-strokedark">
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <div id="chartFive" class="-ml-5"></div>
    </div>
</div>

<input type="hidden" id="datosGrafico" value="{{ json_encode([
    'meses' => $meses->pluck('nombre'),
    'usuarios' => $usuarios,
    'datos' => $datosUsuarios
]) }}"> 
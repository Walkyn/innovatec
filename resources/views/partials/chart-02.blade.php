@php
    $now = Carbon\Carbon::now();
    $now->locale('es');
    setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain.1252');
    
    // Función para obtener datos según el período
    function obtenerDatosPeriodo($periodo) {
        $now = Carbon\Carbon::now();
        $now->locale('es');
        
        switch($periodo) {
            case 'semana_actual':
                $inicio = $now->startOfWeek(Carbon\Carbon::MONDAY);
                $fin = $now->copy()->endOfWeek(Carbon\Carbon::SUNDAY);
                
                // Debug para ver qué fechas se están procesando
                \Log::info('Fecha inicio:', [$inicio->format('Y-m-d')]);
                \Log::info('Fecha fin:', [$fin->format('Y-m-d')]);
                
                $cobros = App\Models\Cobranza::selectRaw('
                    DATE(fecha_cobro) as fecha,
                    COUNT(DISTINCT cliente_id) as clientes,
                    SUM(monto_total) as total
                ')
                ->whereBetween('fecha_cobro', [$inicio, $fin])
                ->where('estado_cobro', 'emitido')
                ->groupBy('fecha')
                ->orderBy('fecha')
                ->get();

                // Debug para ver los cobros
                \Log::info('Cobros encontrados:', $cobros->toArray());

                // Solo enviamos los datos crudos, el formateo lo haremos en JavaScript
                $datos = $cobros->map(function($cobro) {
                    return [
                        'fecha' => $cobro->fecha,
                        'clientes' => (int)$cobro->clientes,
                        'total' => (float)$cobro->total
                    ];
                })->toArray();
                
                // No necesitamos labels separados, los generaremos en JavaScript
                $labels = [];
                break;
                
            case 'semana_anterior':
                $inicio = $now->copy()->subWeek()->startOfWeek();
                $fin = $inicio->copy()->endOfWeek();
                $datos = App\Models\Cobranza::selectRaw('DATE(fecha_cobro) as fecha, COUNT(DISTINCT cliente_id) as clientes, SUM(monto_total) as total')
                    ->whereBetween('fecha_cobro', [$inicio, $fin])
                    ->where('estado_cobro', 'emitido')
                    ->groupBy('fecha')
                    ->get();
                $labels = collect(range(0, 6))->map(fn($i) => ucfirst($inicio->copy()->addDays($i)->isoFormat('ddd')));
                break;
                
            case 'mes_actual':
                // Obtenemos todos los meses que tienen datos
                $datosMeses = App\Models\Cobranza::selectRaw('MONTH(fecha_cobro) as mes, COUNT(DISTINCT cliente_id) as clientes, SUM(monto_total) as total')
                    ->whereYear('fecha_cobro', $now->year)
                    ->where('estado_cobro', 'emitido')
                    ->groupBy('mes')
                    ->orderBy('mes')
                    ->get()
                    ->keyBy('mes');

                // Array con nombres de meses en español
                $nombresMeses = [
                    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                    5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                    9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                ];

                // Creamos array con todos los meses del año
                $datos = [];
                $labels = [];
                
                for ($mes = 1; $mes <= 12; $mes++) {
                    $nombreMes = $nombresMeses[$mes];
                    $labels[] = $nombreMes;
                    
                    if (isset($datosMeses[$mes])) {
                        $datos[] = [
                            'mes' => $mes,
                            'nombre' => $nombreMes,
                            'total' => $datosMeses[$mes]->total,
                            'clientes' => $datosMeses[$mes]->clientes
                        ];
                    } else {
                        $datos[] = [
                            'mes' => $mes,
                            'nombre' => $nombreMes,
                            'total' => 0,
                            'clientes' => 0
                        ];
                    }
                }
                break;
                
            case 'todos_años':
                $datos = App\Models\Cobranza::selectRaw('YEAR(fecha_cobro) as año, COUNT(DISTINCT cliente_id) as clientes, SUM(monto_total) as total')
                    ->where('estado_cobro', 'emitido')
                    ->groupBy('año')
                    ->orderBy('año')
                    ->get();
                $labels = $datos->pluck('año');
                break;
        }
        
        return [
            'labels' => $labels,
            'datos' => $datos
        ];
    }
    
    $periodoInicial = 'semana_actual';
    $datosIniciales = obtenerDatosPeriodo($periodoInicial);
@endphp

<div
  class="col-span-12 rounded-sm border border-stroke bg-white p-7.5 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-6"
>
  <div class="mb-4 justify-between gap-4 sm:flex">
    <div>
      <h4 class="text-xl font-bold text-black dark:text-white">
        Análisis de Cobros
      </h4>
    </div>
    <div>
      <select id="periodSelect" class="bg-white border rounded-md px-3 py-1 dark:bg-boxdark dark:border-strokedark">
        <option value="semana_actual" selected>Semana Actual</option>
        <option value="semana_anterior">Semana Anterior</option>
        <option value="mes_actual">Por Meses</option>
        <option value="todos_años">Por Años</option>
      </select>
    </div>
  </div>

  <div>
    <div id="chartTwo" class="-ml-5"></div>
  </div>
</div>

<input type="hidden" id="datosChart02" value="{{ json_encode([
    'labels' => $datosIniciales['labels'],
    'datos' => $datosIniciales['datos']
]) }}">
<input type="hidden" id="rutaObtenerDatos" value="{{ route('obtener.datos.chart02') }}">

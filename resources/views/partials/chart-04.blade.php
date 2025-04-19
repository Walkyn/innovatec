@php
    $now = Carbon\Carbon::now();
    $now->locale('es'); // Establecer el locale a español
    $daysInMonth = $now->daysInMonth;
    
    // Obtener cobros por día del mes actual
    $cobrosPorDia = App\Models\Cobranza::selectRaw('DATE(fecha_cobro) as fecha, SUM(monto_total) as total')
        ->whereMonth('fecha_cobro', $now->month)
        ->whereYear('fecha_cobro', $now->year)
        ->where('estado_cobro', 'emitido')
        ->groupBy('fecha')
        ->get()
        ->pluck('total', 'fecha')
        ->toArray();
    
    // Crear array con todos los días del mes
    $datosGrafico = [];
    for ($dia = 1; $dia <= $daysInMonth; $dia++) {
        $fecha = $now->format('Y-m-') . str_pad($dia, 2, '0', STR_PAD_LEFT);
        $datosGrafico[] = isset($cobrosPorDia[$fecha]) ? round($cobrosPorDia[$fecha], 2) : 0;
    }
@endphp

<div
  class="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5"
>
  <div>
    <h3 class="text-xl font-bold text-black dark:text-white">
      Análisis de Cobros Diarios - {{ ucfirst($now->translatedFormat('F Y')) }}
    </h3>
  </div>
  <div>
    <div id="chartFour" class="-ml-5"></div>
  </div>
</div>

<input type="hidden" id="datosCobrosDiarios" value="{{ json_encode($datosGrafico) }}">
<input type="hidden" id="diasDelMes" value="{{ $daysInMonth }}">

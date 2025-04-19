@php
    $now = Carbon\Carbon::now();
    
    $chartData = [
        'pagoEfectivo' => App\Models\Cobranza::whereMonth('fecha_cobro', $now->month)
            ->whereYear('fecha_cobro', $now->year)
            ->where('estado_cobro', 'emitido')
            ->where('tipo_pago', 'efectivo')
            ->sum('monto_total'),
            
        'pagoDeposito' => App\Models\Cobranza::whereMonth('fecha_cobro', $now->month)
            ->whereYear('fecha_cobro', $now->year)
            ->where('estado_cobro', 'emitido')
            ->where('tipo_pago', 'deposito')
            ->sum('monto_total'),
            
        'totalEmitido' => App\Models\Cobranza::whereMonth('fecha_cobro', $now->month)
            ->whereYear('fecha_cobro', $now->year)
            ->where('estado_cobro', 'emitido')
            ->sum('monto_total'),
            
        'totalAnulado' => App\Models\Cobranza::whereMonth('fecha_cobro', $now->month)
            ->whereYear('fecha_cobro', $now->year)
            ->where('estado_cobro', 'anulado')
            ->sum('monto_total')
    ];
@endphp

<div
  class="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:col-span-6"
>
  <div class="mb-3 justify-between gap-4 sm:flex">
    <div>
      <h4 class="text-xl font-bold text-black dark:text-white">
        Análisis de Cobros Mensual
      </h4>
    </div>
  </div>
  <div class="mb-2">
    <div id="chartThree" class="mx-auto flex justify-center"></div>
  </div>
  <div class="-mx-8 flex flex-wrap items-center justify-center gap-y-3">
    <div class="w-full px-8 sm:w-1/2">
      <div class="flex w-full items-center">
        <span
          class="mr-2 block h-3 w-full max-w-3 rounded-full bg-[#3C50E0]"
        ></span>
        <p
          class="flex w-full justify-between text-sm font-medium text-black dark:text-white"
        >
          <span>Pagos Efectivo</span>
          <span>S/. {{ number_format($chartData['pagoEfectivo'], 2) }}</span>
        </p>
      </div>
    </div>
    <div class="w-full px-8 sm:w-1/2">
      <div class="flex w-full items-center">
        <span
          class="mr-2 block h-3 w-full max-w-3 rounded-full bg-[#80CAEE]"
        ></span>
        <p
          class="flex w-full justify-between text-sm font-medium text-black dark:text-white"
        >
          <span>Pagos Depósito</span>
          <span>S/. {{ number_format($chartData['pagoDeposito'], 2) }}</span>
        </p>
      </div>
    </div>
    <div class="w-full px-8 sm:w-1/2">
      <div class="flex w-full items-center">
        <span
          class="mr-2 block h-3 w-full max-w-3 rounded-full bg-[#00E396]"
        ></span>
        <p
          class="flex w-full justify-between text-sm font-medium text-black dark:text-white"
        >
          <span>Total Emitido</span>
          <span>S/. {{ number_format($chartData['totalEmitido'], 2) }}</span>
        </p>
      </div>
    </div>
    <div class="w-full px-8 sm:w-1/2">
      <div class="flex w-full items-center">
        <span
          class="mr-2 block h-3 w-full max-w-3 rounded-full bg-[#FF4560]"
        ></span>
        <p
          class="flex w-full justify-between text-sm font-medium text-black dark:text-white"
        >
          <span>Total Anulado</span>
          <span>S/. {{ number_format($chartData['totalAnulado'], 2) }}</span>
        </p>
      </div>
    </div>
  </div>
  <input type="hidden" id="pagoEfectivo" value="{{ $chartData['pagoEfectivo'] }}">
  <input type="hidden" id="pagoDeposito" value="{{ $chartData['pagoDeposito'] }}">
  <input type="hidden" id="totalEmitido" value="{{ $chartData['totalEmitido'] }}">
  <input type="hidden" id="totalAnulado" value="{{ $chartData['totalAnulado'] }}">
</div>

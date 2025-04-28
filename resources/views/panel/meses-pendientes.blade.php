@extends('layouts.app-cliente')
@section('title', 'Nexus - Meses Pendientes')

@section('content')
    <div class="relative p-4 w-full max-h-full mx-auto">
        <div class="bg-white rounded shadow-sm border border-gray-100 overflow-hidden dark:bg-gray-800 dark:border-gray-700">
            <div class="border-b border-gray-100 px-6 py-4 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Meses pendientes</h3>
            </div>

            <div class="p-6">
                @php
                    $cliente = \App\Models\Cliente::find(session('cliente_id'));
                    $contratos = \App\Models\Contrato::where('cliente_id', $cliente->id)
                        ->orderByDesc('fecha_contrato')
                        ->get();
                @endphp

                @forelse($contratos as $index => $contrato)
                    <div class="mb-6" 
                         x-data="{ 
                             open: {{ $index === 0 ? 'true' : 'false' }}, 
                             openServiceId: null 
                         }">
                        <!-- Cabecera del contrato -->
                        <button @click="open = !open" 
                            class="w-full flex items-center justify-between px-4 py-2 bg-gray-50 hover:bg-gray-100 rounded-t transition text-left dark:bg-gray-700 dark:hover:bg-gray-600">
                            <div class="flex items-center gap-4">
                                <span class="font-semibold text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                    {{ 'CTR-' . str_pad($contrato->id, 5, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    Fecha: {{ \Carbon\Carbon::parse($contrato->fecha_contrato)->format('d/m/Y') }}
                                </span>
                                <span class="text-xs font-semibold px-2 py-0.5 rounded-full inline-flex items-center
                                    {{ $contrato->estado_contrato === 'activo' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    {{ ucfirst($contrato->estado_contrato) }}
                                </span>
                        </div>
                            <span>
                                <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'"></i>
                            </span>
                        </button>

                        <!-- Contenido del contrato -->
                        <div x-show="open" x-transition class="border border-t-0 border-gray-100 rounded-b p-4 dark:border-gray-700">
                            @foreach($contrato->contratoServicios()->with(['servicio','plan'])->get() as $cs)
                                @php
                                    $meses          = \App\Models\Mes::where('anio', date('Y'))->orderBy('numero')->get();
                                    $fechaInicio    = \Carbon\Carbon::parse($cs->fecha_servicio);
                                    $mesActual      = (int)\Carbon\Carbon::now()->format('n');
                                    $mesInicio      = (int)$fechaInicio->format('n');

                                    // Fecha de suspensión y mes de suspensión (si aplica)
                                    $fechaSuspension = $cs->estado_servicio_cliente === 'suspendido' && $cs->fecha_suspension_servicio
                                        ? \Carbon\Carbon::parse($cs->fecha_suspension_servicio)
                                        : null;
                                    $mesSuspension = $fechaSuspension ? (int)$fechaSuspension->format('n') : null;
                                @endphp

                                <div class="mb-4 last:mb-0">
                                    <!-- Cabecera de servicio minimalista -->
                                    <button
                                        @click="openServiceId = (openServiceId === {{ $cs->id }} ? null : {{ $cs->id }})"
                                        class="w-full text-sm flex items-center justify-between py-2 border-b border-gray-200 text-left transition-colors hover:text-gray-900 dark:border-gray-600">
                                        
                                        <div class="flex flex-wrap items-center gap-2">
                                            <!-- Nombre y plan -->
                                            <span class="text-gray-800 dark:text-gray-200">
                                                {{ $cs->servicio->nombre }} {{ $cs->plan->nombre }}
                                            </span>
                                            
                                            <!-- Precio -->
                                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                                S/ {{ number_format($cs->plan->precio,2) }}
                                            </span>
                                            
                                            @php
                                                // Preparar clases e icono según estado del servicio
                                                $state = $cs->estado_servicio_cliente;
                                                switch($state){
                                                    case 'activo':
                                                        $stateClasses = 'bg-green-100 text-green-700';
                                                        $stateIcon    = 'fa-check-circle';
                                                        break;
                                                    case 'suspendido':
                                                        $stateClasses = 'bg-red-100 text-red-700';
                                                        $stateIcon    = 'fa-times-circle';
                                                        break;
                                                    case 'cancelado':
                                                        $stateClasses = 'bg-red-100 text-red-700';
                                                        $stateIcon    = 'fa-times-circle';
                                                        break;
                                                    default:
                                                        $stateClasses = 'bg-gray-100 text-gray-600';
                                                        $stateIcon    = 'fa-question-circle';
                                                }
                                            @endphp
                                            
                                            <!-- Badge de estado -->
                                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $stateClasses }}">
                                                <i class="fas {{ $stateIcon }} mr-1"></i> {{ ucfirst($state) }}
                                            </span>
                    </div>

                                        <!-- Flecha del acordeón -->
                                        <svg :class="openServiceId === {{ $cs->id }} ? 'transform rotate-180' : ''"
                                             class="w-4 h-4 text-gray-500 dark:text-gray-400 transition-transform"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>

                                    <!-- Contenido de meses (colapsable) -->
                                    <div x-show="openServiceId === {{ $cs->id }}" x-transition class="mt-3">
                                        {{-- Acordeón por años --}}
                                        @php
                                            $anioInicio = $fechaInicio->year;
                                            $anioActual = now()->year;
                                            $years      = range($anioInicio, $anioActual);
                                            // Invertimos el orden para mostrar primero el año más reciente
                                            $years      = array_reverse($years);
                                        @endphp
                                        <div x-data="{ openYear: null }">
                                            @foreach($years as $year)
                                                <div class="mb-4">
                                                    <button
                                                        @click="openYear = openYear === '{{ $cs->id }}-{{ $year }}' ? null : '{{ $cs->id }}-{{ $year }}'"
                                                        class="w-full flex items-center justify-between px-4 py-2 bg-gray-50 hover:bg-gray-100 rounded transition text-left">
                                                        <span class="font-medium">Año {{ $year }}</span>
                                                        <i :class="openYear === '{{ $cs->id }}-{{ $year }}' 
                                                                  ? 'fas fa-chevron-up' 
                                                                  : 'fas fa-chevron-down'"></i>
                                                    </button>

                                                    <div x-show="openYear === '{{ $cs->id }}-{{ $year }}'" x-transition class="mt-2">
                                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                                            @php
                                                                $mesesYear = \App\Models\Mes::where('anio', $year)
                                                                                ->orderBy('numero')
                                                                                ->get();
                                                            @endphp

                                                            @foreach($mesesYear as $mesYear)
                                                                @php
                                                                    // Verificar si debemos omitir este mes (posterior a suspensión)
                                                                    $omitirMes = false;
                                                                    if ($fechaSuspension) {
                                                                        // Omitir meses posteriores al mes de suspensión en el mismo año
                                                                        if ($year === $fechaSuspension->year && $mesYear->numero > $mesSuspension) {
                                                                            $omitirMes = true;
                                                                        }
                                                                        // Omitir todos los meses de años posteriores al año de suspensión
                                                                        if ($year > $fechaSuspension->year) {
                                                                            $omitirMes = true;
                                                                        }
                                                                    }
                                                                    
                                                                    // Si debemos omitir este mes, continuamos con el siguiente
                                                                    if ($omitirMes) continue;
                                                                    
                                                                    // Parsear fechas del mes y hoy
                                                                    $fechaInicioMes = \Carbon\Carbon::parse($mesYear->fecha_inicio);
                                                                    $fechaFinMes    = \Carbon\Carbon::parse($mesYear->fecha_fin);
                                                                    $hoy            = \Carbon\Carbon::now();

                                                                    // Variables del servicio
                                                                    $fechaInicio = \Carbon\Carbon::parse($cs->fecha_servicio);
                                                                    $mesActual   = (int) \Carbon\Carbon::now()->format('n');
                                                                    $mesInicio   = (int) $fechaInicio->format('n');

                                                                    // 1) Determinar estado
                                                                    // Primero verificamos si existe un registro en cobranza con algún estado
                                                                    if (\Illuminate\Support\Facades\DB::table('cobranza_contratoservicio')
                                                                        ->where('contrato_servicio_id', $cs->id)
                                                                        ->where('mes_id', $mesYear->id)
                                                                        ->where('estado_pago', 'pagado')
                                                                        ->exists()) {
                                                                        $estado = 'pagado';
                                                                    } elseif (\Illuminate\Support\Facades\DB::table('cobranza_contratoservicio')
                                                                        ->where('contrato_servicio_id', $cs->id)
                                                                        ->where('mes_id', $mesYear->id)
                                                                        ->where('estado_pago', 'no_aplica')
                                                                        ->exists()) {
                                                                        $estado = 'no_aplica';
                                                                    // Si no hay registro, aplicamos las reglas automáticas
                                                                    } elseif ($year === $anioInicio && $mesYear->numero < $mesInicio) {
                                                                        $estado = 'no_aplica';
                                                                    } elseif ($fechaSuspension && $year === $fechaSuspension->year && $mesYear->numero === $mesSuspension) {
                                                                        $estado = now()->gte($fechaSuspension) ? 'pendiente' : 'en_curso';
                                                                    } elseif ($year === now()->year && $mesYear->numero === $mesActual) {
                                                                        $estado = 'en_curso';
                                                                    } elseif ($year > now()->year || ($year === now()->year && $mesYear->numero > $mesActual)) {
                                                                        $estado = 'futuro';
                                                                    } else {
                                                                        $estado = 'pendiente';
                                                                    }

                                                                    // 2) Cálculo de precioMostrar
                                                                    if ($year === $anioInicio && $mesYear->numero === $mesInicio) {
                                                                        // prorrateo primer mes
                                                                        $ultimoDia     = (int) $fechaFinMes->format('j');
                                                                        $diaInstalacion = (int) $fechaInicio->format('j');
                                                                        $diasRestantes = $ultimoDia - $diaInstalacion;
                                                                        if ($diasRestantes < 5) {
                                                                            $estado        = 'no_aplica';
                                                                            $precioMostrar = 0;
                                                                        } else {
                                                                            if ($diaInstalacion <= 5) {
                                                                                $precioMostrar = $cs->plan->precio;
                                                                            } else {
                                                                                $diasTotales = $fechaInicioMes->diffInDays($fechaFinMes) + 1;
                                                                                $diasServ    = $fechaInicio->diffInDays($fechaFinMes) + 1;
                                                                                $precioMostrar = ($cs->plan->precio / $diasTotales) * $diasServ;
                                                                            }
                                                                        }
                                                                    } elseif ($fechaSuspension && $year === $fechaSuspension->year && $mesYear->numero === $mesSuspension) {
                                                                        // prorrateo mes de suspensión
                                                                        $diasTotales   = $fechaInicioMes->diffInDays($fechaFinMes) + 1;
                                                                        $diasHastaSusp = $fechaInicioMes->diffInDays($fechaSuspension) + 1;
                                                                        $precioMostrar = ($cs->plan->precio / $diasTotales) * $diasHastaSusp;
                                                                    } else {
                                                                        // resto meses cobran precio completo
                                                                        $precioMostrar = $cs->plan->precio;
                                                                    }
                                                                    $precioMostrar = round($precioMostrar, 2, PHP_ROUND_HALF_UP);

                                                                    // 3) Clases CSS según estado
                                                                    switch ($estado) {
                                                                        case 'pagado':
                                                                            $bgClasses    = 'bg-green-50 dark:bg-green-900/20 border-green-100';
                                                                            $barClasses   = 'bg-green-500';
                                                                            $badgeClasses = 'bg-green-100 text-green-700';
                                                                            break;
                                                                        case 'en_curso':
                                                                            $bgClasses    = 'bg-yellow-50 dark:bg-yellow-900/20 border-yellow-100';
                                                                            $barClasses   = 'bg-yellow-500';
                                                                            $badgeClasses = 'bg-yellow-100 text-yellow-700';
                                                                            break;
                                                                        case 'no_aplica':
                                                                        case 'futuro':
                                                                            $bgClasses    = 'bg-gray-100 dark:bg-gray-700 border-gray-200 dark:border-gray-600';
                                                                            $barClasses   = 'bg-gray-300 dark:bg-gray-500';
                                                                            $badgeClasses = 'bg-gray-200 text-gray-600 dark:bg-gray-600 dark:text-gray-200';
                                                                            break;
                                                                        default: // pendiente
                                                                            $bgClasses    = 'bg-red-50 dark:bg-red-900/20 border-red-100';
                                                                            $barClasses   = 'bg-red-500';
                                                                            $badgeClasses = 'bg-red-100 text-red-700';
                                                                    }

                                                                    // 4) Cálculo de progreso
                                                                    if (in_array($estado, ['pagado','pendiente'])) {
                                                                        $progressPercent = 100;
                                                                    } elseif ($estado === 'en_curso') {
                                                                        $totalDias = $fechaInicioMes->diffInDays($fechaFinMes) + 1;
                                                                        if ($hoy->lt($fechaInicioMes)) {
                                                                            $progressPercent = 0;
                                                                        } elseif ($hoy->gt($fechaFinMes)) {
                                                                            $progressPercent = 100;
                                                                        } else {
                                                                            $trans = $fechaInicioMes->diffInDays($hoy) + 1;
                                                                            $progressPercent = round(($trans / $totalDias) * 100);
                                                                        }
                                                                    } else {
                                                                        $progressPercent = 0;
                                                                    }

                                                                    // 5) Icono y etiqueta
                                                                    if ($estado === 'no_aplica') {
                                                                        $label = 'No aplica';
                                                                        $icon  = 'fas fa-ban';
                                                                    } elseif ($estado === 'futuro') {
                                                                        $label = 'Próximo';
                                                                        $icon  = 'fas fa-calendar';
                                                                    } elseif ($estado === 'en_curso') {
                                                                        $label = 'En curso';
                                                                        $icon  = 'fas fa-hourglass-half';
                                                                    } elseif ($estado === 'pendiente') {
                                                                        $label = 'Pendiente';
                                                                        $icon  = 'fas fa-clock';
                                                                    } else {
                                                                        $label = 'Pagado';
                                                                        $icon  = 'fas fa-check-circle';
                                                                    }
                                                                @endphp

                                                                <div class="p-4 rounded-lg {{ $bgClasses }} border">
                                                                    <!-- Barra de progreso -->
                                                                    <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3">
                                                                        <div class="h-1.5 rounded-full {{ $barClasses }}"
                                                                             style="width: {{ $progressPercent }}%"></div>
                                                                    </div>

                                                                    <!-- Nombre + badge -->
                                                                    <div class="flex justify-between items-start">
                                                                        <h4 class="text-sm font-bold text-gray-700">
                                                                            {{ ucfirst($mesYear->nombre) }}
                                                                        </h4>
                                                                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $badgeClasses }}">
                                                                            <i class="{{ $icon }} mr-1"></i> {{ $label }}
                                                                        </span>
                                                                    </div>

                                                                    <!-- Vence y monto -->
                                                                    <div class="mt-3 flex items-center justify-between text-xs">
                                                                        <span class="text-gray-500">
                                                                            Vence: {{ \Carbon\Carbon::parse($mesYear->fecha_fin)->format('d/m/Y') }}
                                                                        </span>
                                                                        @if(in_array($estado, ['pagado','pendiente','en_curso']))
                                                                            <span class="text-gray-800 font-medium">
                                                                                S/ {{ number_format($precioMostrar, 0, '.', '') }}
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{-- Fin acordeón de años --}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-400 dark:text-gray-500 py-8">
                        No tienes contratos registrados.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush

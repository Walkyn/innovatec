@extends('layouts.app-cliente')
@section('title', 'Nexus - Realizar Pago')

@section('content')

    <!--Start Content -->
    <div class="relative p-4 w-full max-h-full mx-auto">
        <!-- Toast notification -->
        <div x-data="{
            show: false,
            message: '',
            type: 'success',
            progress: 0,
            progressInterval: null,
            showToast(msg, type = 'success') {
                this.message = msg;
                this.type = type;
                this.show = true;
                this.progress = 0;
        
                if (this.progressInterval) clearInterval(this.progressInterval);
        
                const startTime = Date.now();
                const duration = 3000;
        
                this.progressInterval = setInterval(() => {
                    const elapsed = Date.now() - startTime;
                    this.progress = (elapsed / duration) * 100;
        
                    if (this.progress >= 100) {
                        this.show = false;
                        clearInterval(this.progressInterval);
                    }
                }, 10);
        
                setTimeout(() => {
                    this.show = false;
                    clearInterval(this.progressInterval);
                }, duration);
            }
        }" @notify.window="showToast($event.detail.message, $event.detail.type || 'success')"
            class="fixed inset-0 flex items-center justify-center pointer-events-none z-50">
            <div x-show="show" x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="max-w-sm w-full mx-4 shadow-lg rounded-lg pointer-events-auto ring-1 ring-opacity-5 overflow-hidden"
                :class="{
                    'bg-green-50 ring-green-300 border border-green-200': type === 'success',
                    'bg-red-50 ring-red-300 border border-red-200': type === 'error',
                    'bg-yellow-50 ring-yellow-300 border border-yellow-200': type === 'warning',
                    'bg-blue-50 ring-blue-300 border border-blue-200': type === 'info',
                    'bg-gray-800 ring-gray-700 border border-gray-700 text-white': type === 'dark'
                }">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <!-- Icono de éxito (checkmark) -->
                            <svg x-show="type === 'success'" class="h-6 w-6 text-green-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <!-- Icono de error (X en círculo) -->
                            <svg x-show="type === 'error'" class="h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <!-- Icono de advertencia (exclamación) -->
                            <svg x-show="type === 'warning'" class="h-6 w-6 text-yellow-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>

                            <!-- Icono de información (i) -->
                            <svg x-show="type === 'info'" class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <!-- Icono para modo oscuro (campana) -->
                            <svg x-show="type === 'dark'" class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1">
                            <p class="text-sm font-medium"
                                :class="{
                                    'text-green-800': type === 'success',
                                    'text-red-800': type === 'error',
                                    'text-yellow-800': type === 'warning',
                                    'text-blue-800': type === 'info',
                                    'text-white': type === 'dark'
                                }"
                                x-text="message"></p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="show = false" class="rounded-md inline-flex focus:outline-none"
                                :class="{
                                    'text-green-500 hover:text-green-600': type === 'success',
                                    'text-red-500 hover:text-red-600': type === 'error',
                                    'text-yellow-500 hover:text-yellow-600': type === 'warning',
                                    'text-blue-500 hover:text-blue-600': type === 'info',
                                    'text-gray-300 hover:text-white': type === 'dark'
                                }">
                                <span class="sr-only">Cerrar</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mt-3 w-full bg-gray-200 rounded-full h-1" :class="{ 'bg-gray-600': type === 'dark' }">
                        <div class="h-1 rounded-full transition-all duration-10 ease-linear"
                            :class="{
                                'bg-green-500': type === 'success',
                                'bg-red-500': type === 'error',
                                'bg-yellow-500': type === 'warning',
                                'bg-blue-500': type === 'info',
                                'bg-gray-300': type === 'dark'
                            }"
                            :style="'width: ' + progress + '%'">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium text-lg">Realizar Pagos</div>
            </div>

            @php
                use App\Models\Contrato;
                use App\Models\Mes;

                // 1) Obtengo contratos con sus servicios, planes y relación con servicio/plan
                $cliente = \App\Models\Cliente::find(session('cliente_id'));
                $contratos = Contrato::where('cliente_id', $cliente->id)
                    ->with(['contratoServicios.servicio', 'contratoServicios.plan'])
                    ->orderByDesc('fecha_contrato')
                    ->get();

                // 2) Pre-cálculo de meses con estado y monto prorrateado, agrupados por año
                $mesesData = [];
                foreach ($contratos as $c) {
                    foreach ($c->contratoServicios as $cs) {
                        $fechaInicio = \Carbon\Carbon::parse($cs->fecha_servicio);
                        $anioInicio = $fechaInicio->year;
                        $anioActual = now()->year;

                        $anios = [];

                        // Por cada año desde el inicio del servicio hasta el actual
                        for ($anio = $anioInicio; $anio <= $anioActual; $anio++) {
                            $mesesAnio = Mes::where('anio', $anio)->orderBy('numero')->get();

                            if ($mesesAnio->isEmpty()) {
                                continue;
                            }

                            $mesesTmp = [];
                            $tienePendientes = false;
                            $tieneEnCurso = false;

                            $mesActual = (int) \Carbon\Carbon::now()->format('n');
                            $mesInicio = $anio == $anioInicio ? (int) $fechaInicio->format('n') : 1;
                            $fechaSuspension =
                                $cs->estado_servicio_cliente == 'suspendido' && $cs->fecha_suspension_servicio
                                    ? \Carbon\Carbon::parse($cs->fecha_suspension_servicio)
                                    : null;
                            $mesSuspension =
                                $fechaSuspension && $fechaSuspension->year == $anio
                                    ? (int) $fechaSuspension->format('n')
                                    : null;

                            foreach ($mesesAnio as $mes) {
                                if (
                                    $fechaSuspension &&
                                    $anio == $fechaSuspension->year &&
                                    $mes->numero > $mesSuspension
                                ) {
                                    continue;
                                }
                                if ($fechaSuspension && $anio > $fechaSuspension->year) {
                                    continue;
                                }

                                // 1) Determinar estado
                                if (
                                    \Illuminate\Support\Facades\DB::table('cobranza_contratoservicio')
                                        ->where('contrato_servicio_id', $cs->id)
                                        ->where('mes_id', $mes->id)
                                        ->where('estado_pago', 'pagado')
                                        ->exists()
                                ) {
                                    $estado = 'pagado';
                                } elseif (
                                    \Illuminate\Support\Facades\DB::table('cobranza_contratoservicio')
                                        ->where('contrato_servicio_id', $cs->id)
                                        ->where('mes_id', $mes->id)
                                        ->where('estado_pago', 'no_aplica')
                                        ->exists()
                                ) {
                                    $estado = 'no_aplica';
                                } elseif ($mes->numero < $mesInicio) {
                                    $estado = 'no_aplica';
                                } elseif (
                                    $fechaSuspension &&
                                    $anio == $fechaSuspension->year &&
                                    $mes->numero == $mesSuspension
                                ) {
                                    $estado = \Carbon\Carbon::now()->gte($fechaSuspension) ? 'pendiente' : 'en_curso';
                                    if ($estado == 'en_curso') {
                                        $tieneEnCurso = true;
                                    }
                                } elseif ($anio == $anioActual && $mes->numero == $mesActual) {
                                    $estado = 'en_curso';
                                    $tieneEnCurso = true;
                                } elseif ($anio > $anioActual || ($anio == $anioActual && $mes->numero > $mesActual)) {
                                    $estado = 'futuro';
                                } else {
                                    $estado = 'pendiente';
                                }

                                if ($estado == 'pendiente') {
                                    $tienePendientes = true;
                                }

                                $fechaInicioMes = \Carbon\Carbon::parse($mes->fecha_inicio);
                                $fechaFinMes = \Carbon\Carbon::parse($mes->fecha_fin);

                                if ($anio == $anioInicio && $mes->numero == $mesInicio) {
                                    // Prorrateo primer mes
                                    $ultimoDia = (int) $fechaFinMes->format('j');
                                    $diaInst = (int) $fechaInicio->format('j');
                                    $restantes = $ultimoDia - $diaInst;

                                    if ($restantes < 5) {
                                        $estado = 'no_aplica';
                                        $precioMostrar = 0;
                                    } else {
                                        if ($diaInst <= 5) {
                                            $precioMostrar = $cs->plan->precio;
                                        } else {
                                            $totales = $fechaInicioMes->diffInDays($fechaFinMes) + 1;
                                            $servicioDias = $fechaInicio->diffInDays($fechaFinMes) + 1;
                                            $precioMostrar = ($cs->plan->precio / $totales) * $servicioDias;
                                        }
                                    }
                                } elseif (
                                    $fechaSuspension &&
                                    $anio == $fechaSuspension->year &&
                                    $mes->numero == $mesSuspension
                                ) {
                                    // Prorrateo mes de suspensión
                                    $totales = $fechaInicioMes->diffInDays($fechaFinMes) + 1;
                                    $hastaSuspension = $fechaInicioMes->diffInDays($fechaSuspension) + 1;
                                    $precioMostrar = ($cs->plan->precio / $totales) * $hastaSuspension;
                                } else {
                                    $precioMostrar = $cs->plan->precio;
                                }

                                // Redondeo final
                                $precioMostrar = round($precioMostrar, 2, PHP_ROUND_HALF_UP);

                                // Agregar mes
                                $mesesTmp[] = [
                                    'id' => $mes->id,
                                    'numero' => $mes->numero,
                                    'nombre' => $mes->nombre,
                                    'estado' => $estado,
                                    'precioMostrar' => number_format($precioMostrar, 0, '.', ''),
                                ];
                            }

                            if ($tienePendientes || $tieneEnCurso) {
                                $anios[] = [
                                    'anio' => $anio,
                                    'meses' => $mesesTmp,
                                    'tienePendientes' => $tienePendientes,
                                    'tieneEnCurso' => $tieneEnCurso,
                                ];
                            }
                        }

                        $anios = array_reverse($anios);
                        $mesesData[$cs->id] = $anios;
                    }
                }
            @endphp

            <div x-data="() => ({
                contratos: @js($contratos),
                mesesServicios: @js($mesesData),
                selectedContrato: '',
                servicios: [],
                selectedServicio: '',
                anios: [],
                openAnio: null,
            
                // Método para manejar la selección de meses de forma continua
                handleMonthSelection: function(event, mesActual, mesesAnio) {
                    var checkbox = event.target;
            
                    // Filtrar y ordenar meses pendientes y en curso
                    var mesesSeleccionables = mesesAnio
                        .filter(function(m) { return m.estado === 'pendiente' || m.estado === 'en_curso'; })
                        .sort(function(a, b) { return a.numero - b.numero; });
            
                    // Si está desmarcando, verificar que no haya meses posteriores marcados
                    if (!checkbox.checked) {
                        var mesIndex = -1;
                        for (var i = 0; i < mesesSeleccionables.length; i++) {
                            if (mesesSeleccionables[i].id === mesActual.id) {
                                mesIndex = i;
                                break;
                            }
                        }
            
                        // Verificar si hay meses posteriores marcados
                        for (var i = mesIndex + 1; i < mesesSeleccionables.length; i++) {
                            var nextCheckbox = document.getElementById('month-' + mesesSeleccionables[i].id);
                            if (nextCheckbox && nextCheckbox.checked) {
                                // Si un mes posterior está marcado, impedir desmarcar este
                                checkbox.checked = true;
            
                                // Notificar al usuario
                                window.dispatchEvent(new CustomEvent('notify', {
                                    detail: {
                                        message: 'Debe desmarcar los meses posteriores primero'
                                    }
                                }));
            
                                return;
                            }
                        }
            
                        return;
                    }
            
                    // Si está marcando, encontrar el índice del mes actual
                    var mesIndex = -1;
                    for (var i = 0; i < mesesSeleccionables.length; i++) {
                        if (mesesSeleccionables[i].id === mesActual.id) {
                            mesIndex = i;
                            break;
                        }
                    }
            
                    // Marcar automáticamente todos los meses anteriores
                    for (var i = 0; i < mesIndex; i++) {
                        document.getElementById('month-' + mesesSeleccionables[i].id).checked = true;
                    }
                },
            
                // Método para cargar y desplegar automáticamente el año con deuda más antiguo
                cargarServicio: function(servicioId) {
                    this.selectedServicio = servicioId;
                    this.anios = this.mesesServicios[servicioId] || [];
            
                    // Si hay años con meses pendientes, abrir automáticamente el más antiguo
                    if (this.anios.length > 0) {
                        // Copiar el array y revertirlo para buscar desde el más antiguo
                        var aniosInvertidos = this.anios.slice().reverse();
                        var anioConDeuda = null;
            
                        for (var i = 0; i < aniosInvertidos.length; i++) {
                            if (aniosInvertidos[i].tienePendientes) {
                                anioConDeuda = aniosInvertidos[i];
                                break;
                            }
                        }
            
                        if (anioConDeuda) {
                            this.openAnio = anioConDeuda.anio;
                        } else {
                            // Si no hay pendientes pero hay en curso, abrir el más reciente
                            this.openAnio = this.anios[0].anio;
                        }
                    }
                },
            
                // Seleccionar todos los meses pendientes de un año
                seleccionarTodosMesesAno: function(anio) {
                    var mesesPendientes = anio.meses.filter(function(m) {
                        return m.estado === 'pendiente';
                    });
            
                    for (var i = 0; i < mesesPendientes.length; i++) {
                        var checkbox = document.getElementById('month-' + mesesPendientes[i].id);
                        if (checkbox) checkbox.checked = true;
                    }
                },
            
                // Método para verificar si todos los meses pendientes están seleccionados
                verificarSeleccionCompleta: function() {
                    var todosSeleccionados = true;
                    var algunoSeleccionado = false;
            
                    // Recorrer todos los años
                    for (var a = 0; a < this.anios.length; a++) {
                        var anio = this.anios[a];
                        // Filtrar los meses pendientes
                        var mesesPendientes = anio.meses.filter(function(m) {
                            return m.estado === 'pendiente';
                        });
            
                        // Verificar si todos los meses pendientes están seleccionados
                        for (var m = 0; m < mesesPendientes.length; m++) {
                            var mes = mesesPendientes[m];
                            var checkbox = document.getElementById('month-' + mes.id);
                            if (checkbox) {
                                if (checkbox.checked) {
                                    algunoSeleccionado = true;
                                } else {
                                    todosSeleccionados = false;
                                }
                            }
                        }
                    }
            
                    return { todosSeleccionados: todosSeleccionados, algunoSeleccionado: algunoSeleccionado };
                }
            })" class="grid grid-cols-1 mb-2">
                {{-- Select Contrato --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contrato</label>
                        <select x-model="selectedContrato"
                            @change=" 
                                servicios = contratos.find(function(c) { return c.id == selectedContrato; })?.contrato_servicios || [];
                                selectedServicio = '';
                                anios = [];
                                openAnio = null;
                            "
                            class="w-full border border-gray-200 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="">Seleccione un contrato</option>
                            <template x-for="c in contratos" :key="c.id">
                                <option :value="c.id" x-text="'CTR-' + String(c.id).padStart(5,'0')"></option>
                            </template>
                        </select>
                    </div>

                    {{-- Select Servicio --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                        <select x-model="selectedServicio" @change="cargarServicio($event.target.value)"
                            class="w-full border border-gray-200 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="">Seleccione un servicio</option>
                            <template x-for="s in servicios" :key="s.id">
                                <option :value="s.id"
                                    x-text="s.servicio.nombre + ' ' + s.plan.nombre + ' (S/ ' + Number(s.plan.precio).toFixed(2) + ')'">
                            </template>
                        </select>
                    </div>
                </div>

                {{-- Acordeón de años --}}
                <div class="col-span-2">
                    <template x-for="(anio, index) in anios" :key="index">
                        <div class="mb-4">
                            <button @click="openAnio = openAnio === anio.anio ? null : anio.anio"
                                class="w-full flex items-center justify-between px-4 py-2 rounded-md transition text-left"
                                :class="anio.tienePendientes ? 'bg-red-50 hover:bg-red-100' : 'bg-gray-50 hover:bg-gray-100'">
                                <div class="flex items-center">
                                    <span class="font-semibold" x-text="'Año ' + anio.anio"></span>
                                    <span x-show="anio.tienePendientes"
                                        class="ml-2 text-xs px-2 py-0.5 bg-red-100 text-red-800 rounded-full">
                                        Pendiente
                                    </span>
                                </div>
                                <svg :class="openAnio === anio.anio ? 'transform rotate-180' : ''"
                                    class="w-4 h-4 text-gray-500 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="openAnio === anio.anio" x-transition>
                                <div class="flex justify-between items-center mt-3 mb-1">
                                    <label class="block text-sm font-medium text-gray-700">Meses a pagar</label>

                                    <!-- Botón de seleccionar todos -->
                                    <button x-show="anio.tienePendientes" @click="seleccionarTodosMesesAno(anio)"
                                        class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded hover:bg-red-200">
                                        Seleccionar todos
                                    </button>
                                </div>

                                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-2 mt-2">
                                    <template x-for="mes in anio.meses" :key="mes.id">
                                        <div class="relative">
                                            <input type="checkbox" :id="'month-' + mes.id" class="hidden peer"
                                                :disabled="mes.estado !== 'pendiente' && mes.estado !== 'en_curso'"
                                                @click="handleMonthSelection($event, mes, anio.meses)">
                                            <label :for="'month-' + mes.id"
                                                class="flex items-center justify-between p-2 border-2 rounded-lg"
                                                :class="{
                                                    'border-green-200 bg-green-50 cursor-not-allowed text-gray-700': mes
                                                        .estado === 'pagado',
                                                    'border-yellow-200 bg-yellow-50 hover:bg-yellow-100 peer-checked:border-yellow-500 peer-checked:bg-yellow-100 text-gray-700': mes
                                                        .estado === 'en_curso',
                                                    'border-red-200 hover:bg-red-50 peer-checked:border-red-500 peer-checked:bg-red-100 text-gray-700': mes
                                                        .estado === 'pendiente',
                                                    'border-gray-200 bg-gray-50 cursor-not-allowed text-gray-400': mes
                                                        .estado === 'no_aplica' || mes.estado === 'futuro'
                                                }">
                                                <span class="text-sm font-medium" x-text="mes.nombre"></span>

                                                <!-- Mostrar "No aplica" solo para estados no_aplica -->
                                                <span x-show="['no_aplica'].includes(mes.estado)"
                                                    class="text-xs text-gray-400 ml-2">
                                                    No aplica
                                                </span>

                                                <!-- Mostrar "Próximo" para meses futuros pero con el mismo color gris -->
                                                <span x-show="mes.estado === 'futuro'" class="text-xs text-gray-400 ml-2">
                                                    Próximo
                                                </span>

                                                <!-- Mostrar precio para mes pagado -->
                                                <span x-show="mes.estado === 'pagado'" class="text-xs text-green-600 ml-2"
                                                    x-text="'S/ ' + mes.precioMostrar">
                                                </span>

                                                <!-- Mostrar precio para mes en curso -->
                                                <span x-show="mes.estado === 'en_curso'"
                                                    class="text-xs text-yellow-600 ml-2"
                                                    x-text="'S/ ' + mes.precioMostrar">
                                                </span>

                                                <!-- Mostrar precio para mes pendiente -->
                                                <span x-show="mes.estado === 'pendiente'"
                                                    class="text-xs text-red-600 ml-2" x-text="'S/ ' + mes.precioMostrar">
                                                </span>

                                                <!-- Indicador de estado (punto de color) -->
                                                <span
                                                    class="absolute -top-1 -right-1 w-3 h-3 rounded-full border-2 border-white"
                                                    :class="mes.estado === 'pagado' ?
                                                        'bg-green-500' :
                                                        mes.estado === 'pendiente' ?
                                                        'bg-red-500' :
                                                        mes.estado === 'en_curso' ?
                                                        'bg-yellow-500' :
                                                        'bg-gray-400'">
                                                </span>
                                            </label>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Mensaje cuando no hay años/meses disponibles -->
                    <div x-show="selectedServicio && anios.length === 0"
                        class="flex flex-col items-center justify-center mb-2 p-8 bg-white border border-gray-100 rounded-xl shadow-sm">

                        <!-- Para servicios activos y al día -->
                        <template
                            x-if="servicios.find(function(s) { return s.id == selectedServicio; })?.estado_servicio_cliente === 'activo'">
                            <div class="flex flex-col items-center">
                                <!-- Icono de check -->
                                <div class="w-16 h-16 mb-4 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>

                                <!-- Título -->
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                    ¡Estás al día!
                                </h3>

                                <!-- Mensaje -->
                                <p class="text-gray-500 text-center max-w-sm">
                                    No tienes pagos pendientes para este servicio. Gracias por tu puntualidad.
                                </p>

                                <!-- Badge con el estado -->
                                <div
                                    class="mt-4 inline-flex items-center px-4 py-2 rounded-full bg-green-50 text-sm text-green-700">
                                    <span class="mr-1.5">•</span>
                                    <span>Servicio al día</span>
                                </div>

                                <!-- Nota adicional -->
                                <p class="mt-6 text-sm text-gray-400 text-center">
                                    Tu próximo pago se habilitará cuando inicie el siguiente mes de servicio
                                </p>
                            </div>
                        </template>

                        <!-- Para servicios suspendidos -->
                        <template
                            x-if="servicios.find(function(s) { return s.id == selectedServicio; })?.estado_servicio_cliente === 'suspendido'">
                            <div class="flex flex-col items-center">
                                <!-- Icono de advertencia -->
                                <div class="w-16 h-16 mb-4 rounded-full bg-red-100 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>

                                <!-- Título -->
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                    Servicio Suspendido
                                </h3>

                                <!-- Mensaje -->
                                <p class="text-gray-500 text-center max-w-sm">
                                    Este servicio se encuentra actualmente suspendido. Por favor, contacta con soporte para
                                    más información.
                                </p>

                                <!-- Badge con el estado -->
                                <div
                                    class="mt-4 inline-flex items-center  font-bold text-xs px-4 py-2 rounded-full bg-red-50 text-red-700">
                                    <i class="fas fa-ban mr-1"></i>
                                    <span>Suspendido</span>
                                </div>
                            </div>
                        </template>

                        <!-- Para servicios cancelados -->
                        <template
                            x-if="servicios.find(function(s) { return s.id == selectedServicio; })?.estado_servicio_cliente === 'cancelado'">
                            <div class="flex flex-col items-center">
                                <!-- Icono de cancelado -->
                                <div class="w-16 h-16 mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>

                                <!-- Título -->
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                    Servicio Cancelado
                                </h3>

                                <!-- Mensaje -->
                                <p class="text-gray-500 text-center max-w-sm">
                                    Este servicio ha sido cancelado. Si deseas reactivarlo, por favor contacta con nuestro
                                    equipo de soporte.
                                </p>

                                <!-- Badge con el estado -->
                                <div
                                    class="mt-4 inline-flex items-center px-4 py-2 rounded-full bg-gray-100 text-sm text-gray-700">
                                    <span class="mr-1.5">•</span>
                                    <span>Cancelado</span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Botón Agregar con solución directa en el onclick -->
            <div class="flex justify-center mb-6">
                <button type="button" id="botonAgregar" onclick="agregarServicioDirecto()"
                    class="bg-gray-600 hover:bg-gray-700 text-white text-sm py-3 px-4 items-center justify-center font-medium lg:w-1/2 xl:w-1/3 w-full rounded-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    AGREGAR
                </button>
            </div>

            <!-- Tabla de detalles -->
            <div class="mb-6">
                <div class="font-medium mb-2">Detalles del Pago</div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[460px]">
                        <thead>
                            <tr>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">
                                    Acción</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Contrato</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Servicio</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Precio/mes</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Meses</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md text-right">
                                    Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Contenido dinámico aquí -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5"
                                    class="py-2 px-4 border-b border-b-gray-50 text-right font-medium text-gray-600">
                                    Total a pagar:</td>
                                <td
                                    class="py-2 px-4 border-b border-b-gray-50 font-bold text-emerald-500 text-right whitespace-nowrap">
                                    S/ 0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Selección de medio de pago mejorada -->
            <div x-data="{
                mediosPago: @js($mediosPago),
                selectedMethod: '',
                copyToClipboard(text) {
                    navigator.clipboard.writeText(text)
                        .then(() => {
                            window.dispatchEvent(new CustomEvent('notify', {
                                detail: {
                                    message: 'Información copiada al portapapeles'
                                }
                            }));
                        })
                        .catch(err => {
                            window.dispatchEvent(new CustomEvent('notify', {
                                detail: {
                                    message: 'Error al copiar la información'
                                }
                            }));
                        });
                }
            }" class="mb-6">
                <div class="font-medium mb-4">Seleccione un método de pago</div>

                <!-- Selector de método de pago -->
                <div class="mb-4">
                    <select x-model="selectedMethod"
                        class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4 border border-gray-200 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <option value="">Seleccione medio de pago</option>
                        <template x-for="medio in mediosPago" :key="medio.id">
                            <option :value="medio.tipo_pago" x-text="medio.nombre_tipo_pago || medio.tipo_pago"></option>
                        </template>
                    </select>
                </div>

                <!-- Contenedor de tarjetas -->
                <div class="relative">
                    <!-- Contenedor con altura fija -->
                    <div class="relative h-[200px]">
                        <!-- Mensaje cuando no hay método seleccionado -->
                        <div x-show="!selectedMethod" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            class="absolute inset-0 bg-gray-50 rounded-xl p-4 border-2 border-dashed border-gray-300 flex flex-col items-center justify-center text-center sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4">
                            <div class="mb-2">
                                <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                    </path>
                                </svg>
                            </div>
                            <p class="text-gray-600 font-medium">Seleccione un método de pago</p>
                            <p class="text-gray-400 text-sm">Para ver los detalles de la cuenta</p>
                        </div>

                        <!-- Tarjeta dinámica para cada medio de pago -->
                        <template x-for="medio in mediosPago" :key="medio.id">
                            <div x-show="selectedMethod === medio.tipo_pago"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95"
                                :class="{
                                    'bg-[#005696]': medio.tipo_pago === 'BCP',
                                    'bg-[#00427F]': medio.tipo_pago === 'BBVA',
                                    'bg-[#D12C1F]': medio.tipo_pago === 'BN',
                                    'bg-gradient-to-r from-[#003C7F] to-[#0056B3]': medio.tipo_pago === 'CAJA_PIURA',
                                    'bg-[#742284]': medio.tipo_pago === 'YAPE',
                                    'bg-[#6AB4E0]': medio.tipo_pago === 'PLIN',
                                }"
                                class="absolute inset-0 rounded-xl p-4 text-white shadow-md sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4">
                                <div class="flex items-center justify-between mb-4">
                                    <p class="text-lg font-semibold" x-text="medio.nombre_tipo_pago || medio.tipo_pago">
                                    </p>
                                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                        <img :src="'{{ asset('images/paymethods/') }}/' + medio.tipo_pago.toLowerCase() + '.png'"
                                            :alt="medio.nombre_tipo_pago || medio.tipo_pago" class="w-10 h-10">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div>
                                        <p class="text-xs text-white/80"
                                            x-text="medio.tipo_pago === 'YAPE' || medio.tipo_pago === 'PLIN' ? 'Número de Teléfono' : 'Cuenta Corriente'">
                                        </p>
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-medium" x-text="medio.numero_cuenta"></p>
                                            <button @click="copyToClipboard(medio.numero_cuenta)"
                                                class="text-white/80 hover:text-white">
                                                <i class="fas fa-copy text-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs text-white/80">Titular</p>
                                        <p class="text-sm" x-text="medio.titular"></p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Confirmación de pago -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Confirmación de Pago</label>
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="confirm-payment"
                        class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                    <label for="confirm-payment" class="ml-2 text-sm text-gray-700">Confirmo que he realizado el
                        depósito/transferencia</label>
                </div>

                <!-- Subir comprobante con previsualización -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subir comprobante</label>
                    <div class="flex flex-col items-center" x-data="{
                        fileName: '',
                        fileSize: '',
                        fileType: '',
                        previewUrl: null,
                        fileSelected: false,
                    
                        handleFileChange(event) {
                            const file = event.target.files[0];
                            if (!file) {
                                this.resetFileData();
                                return;
                            }
                    
                            this.fileName = file.name;
                            this.fileType = file.type;
                            this.fileSize = this.formatBytes(file.size);
                            this.fileSelected = true;
                    
                            // Crear URL para previsualización
                            if (file.type.startsWith('image/')) {
                                this.previewUrl = URL.createObjectURL(file);
                            } else if (file.type === 'application/pdf') {
                                this.previewUrl = '{{ asset('images/pdf-icon.png') }}';
                            } else {
                                this.previewUrl = '{{ asset('images/file-icon.png') }}';
                            }
                        },
                    
                        formatBytes(bytes, decimals = 2) {
                            if (bytes === 0) return '0 Bytes';
                    
                            const k = 1024;
                            const dm = decimals < 0 ? 0 : decimals;
                            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                    
                            const i = Math.floor(Math.log(bytes) / Math.log(k));
                    
                            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
                        },
                    
                        resetFileData() {
                            this.fileName = '';
                            this.fileSize = '';
                            this.fileType = '';
                            this.previewUrl = null;
                            this.fileSelected = false;
                            document.getElementById('dropzone-file').value = '';
                        }
                    }">
                        <!-- Área de arrastrar y soltar cuando no hay archivo -->
                        <label x-show="!fileSelected"
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click para subir</span>
                                    o arrastrar</p>
                                <p class="text-xs text-gray-500">PNG, JPG o PDF (MAX. 5MB)</p>
                            </div>
                            <input @change="handleFileChange($event)" id="dropzone-file" type="file" class="hidden"
                                accept=".jpg,.jpeg,.png,.pdf" />
                        </label>

                        <!-- Previsualización del archivo -->
                        <div x-show="fileSelected" class="w-full">
                            <div class="relative w-full p-4 mb-4 bg-white border rounded-lg">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 mr-4">
                                        <img :src="previewUrl" class="h-16 w-16 object-cover rounded bg-gray-100"
                                            :class="{ 'object-contain p-2': !fileType.startsWith('image/') }" />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate" x-text="fileName"></p>
                                        <p class="text-sm text-gray-500" x-text="fileSize"></p>
                                        <p class="text-xs text-gray-400" x-text="fileType"></p>
                                    </div>
                                    <div class="flex-shrink-0 ml-4">
                                        <button type="button" @click="resetFileData"
                                            class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Previsualización de imagen grande -->
                                <div x-show="fileType.startsWith('image/')" class="mt-3">
                                    <img :src="previewUrl"
                                        class="w-full h-auto max-h-64 object-contain rounded border border-gray-200" />
                                </div>

                                <!-- Mensaje para archivos PDF -->
                                <div x-show="fileType === 'application/pdf'"
                                    class="mt-3 text-center text-gray-500 text-sm">
                                    Vista previa de PDF no disponible
                                </div>
                            </div>

                            <!-- Botón para cambiar archivo -->
                            <button type="button" @click="document.getElementById('dropzone-file').click()"
                                class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                                <svg class="-ml-1 mr-2 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Cambiar archivo
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón Enviar Pago con AJAX -->
            <div class="flex justify-end">
                <button id="enviarPago" type="button"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white py-2 md:w-1/4 w-full px-6 justify-center rounded-md flex items-center"
                    onclick="enviarPago()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Enviar Pago
                </button>
            </div>
        </div>
    </div>
    <!--End Content -->

    <!-- Script con la función del botón agregar con soporte para toasts de color -->
    <script>
        // Variables globales para almacenar los servicios y el total
        var serviciosAgregados = [];
        var totalPagar = 0;

        // Función para mostrar notificaciones toast con iconos específicos según el tipo
        function mostrarNotificacion(mensaje, tipo = 'success') {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: {
                    message: mensaje,
                    type: tipo
                }
            }));
        }

        // Función para verificar si un mes ya está en la tabla detalles
        function verificarMesExistente(contratoNumero, servicioNombre, nombreMes) {
            for (var i = 0; i < serviciosAgregados.length; i++) {
                var servicio = serviciosAgregados[i];
                if (servicio.contratoNumero === contratoNumero &&
                    servicio.servicioNombre === servicioNombre &&
                    servicio.mesesTexto.includes(nombreMes)) {
                    return true;
                }
            }
            return false;
        }

        // Modificar la función agregarServicioDirecto
        function agregarServicioDirecto() {
            console.log('Función agregarServicioDirecto ejecutada');

            // 1. Obtener el contrato seleccionado
            var selectContrato = document.querySelector('select[x-model="selectedContrato"]');
            if (!selectContrato || selectContrato.selectedIndex === 0) {
                mostrarNotificacion('Por favor, seleccione un contrato primero', 'error');
                return;
            }
            var contratoTexto = selectContrato.options[selectContrato.selectedIndex].text;

            // 2. Obtener el servicio seleccionado y su precio
            var selectServicio = document.querySelector('select[x-model="selectedServicio"]');
            if (!selectServicio || selectServicio.selectedIndex === 0) {
                mostrarNotificacion('Por favor, seleccione un servicio primero', 'error');
                return;
            }
            var servicioTextoCompleto = selectServicio.options[selectServicio.selectedIndex].text;
            var servicioNombre = servicioTextoCompleto.replace(/\s*\(S\/\s*[0-9.]+\)/, '').trim();

            // Extraer el precio del servicio del texto completo
            var precioMatch = servicioTextoCompleto.match(/\(S\/\s*([0-9.]+)\)/);
            var precioServicio = precioMatch ? precioMatch[1].trim() : '0.00';

            // 3. Verificar que al menos un mes esté seleccionado
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var algunMesSeleccionado = false;

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked && !checkboxes[i].disabled && checkboxes[i].id.startsWith('month-')) {
                    algunMesSeleccionado = true;
                    break;
                }
            }

            if (!algunMesSeleccionado) {
                mostrarNotificacion('Por favor, seleccione al menos un mes a pagar', 'error');
                return;
            }

            // Verificar meses duplicados
            var mesesDuplicados = [];

            // 4. Obtener los meses seleccionados con ordenamiento cronológico
            var mesesSeleccionados = [];
            checkboxes = document.querySelectorAll('input[type="checkbox"]');

            for (var i = 0; i < checkboxes.length; i++) {
                var checkbox = checkboxes[i];
                if (checkbox.checked && !checkbox.disabled && checkbox.id.startsWith('month-')) {
                    var labelId = checkbox.id;
                    var label = document.querySelector('label[for="' + labelId + '"]');

                    if (label) {
                        // Encontrar el año del mes (buscando en los ancestros hasta encontrar el año)
                        var anioElement = label.closest('[x-show="openAnio === anio.anio"]');
                        var anio = anioElement ?
                            parseInt(anioElement.previousElementSibling.textContent.match(/\d+/)[0]) :
                            new Date().getFullYear();

                        var nombreSpan = label.querySelector('span:first-child');
                        if (nombreSpan) {
                            var nombreMes = nombreSpan.textContent.trim();
                            var numeroMes = obtenerNumeroMes(nombreMes);

                            // Buscar el precio
                            var precio = 0;
                            var precioSpan = label.querySelector('span.text-red-600') ||
                                label.querySelector('span.text-yellow-600');

                            if (precioSpan) {
                                precio = parseFloat(precioSpan.textContent.replace('S/', '').trim());
                            }

                            // Verificar si el mes ya está en la tabla
                            if (verificarMesExistente(contratoTexto, servicioNombre, nombreMes)) {
                                mesesDuplicados.push(nombreMes);
                                checkbox.checked = false;
                            } else {
                                // Si no está duplicado, agregarlo a mesesSeleccionados
                                mesesSeleccionados.push({
                                    nombre: nombreMes,
                                    precio: precio,
                                    anio: anio,
                                    numeroMes: numeroMes
                                });
                            }
                        }
                    }
                }
            }

            // Si hay meses duplicados, mostrar notificación y detener
            if (mesesDuplicados.length > 0) {
                mostrarNotificacion(
                    'Los siguientes meses ya están agregados: ' + mesesDuplicados.join(', '),
                    'warning'
                );
                return;
            }

            // Verificar si quedaron meses seleccionados después de filtrar duplicados
            if (mesesSeleccionados.length === 0) {
                mostrarNotificacion('No hay meses válidos para agregar', 'error');
                return;
            }

            // Ordenar meses cronológicamente
            mesesSeleccionados.sort(function(a, b) {
                if (a.anio !== b.anio) {
                    return a.anio - b.anio;
                }
                return a.numeroMes - b.numeroMes;
            });

            // Calcular subtotal y crear texto de meses
            var subtotal = 0;
            var mesesTexto = mesesSeleccionados.map(function(mes) {
                subtotal += mes.precio;
                return mes.nombre;
            }).join(', ');

            // 5. Crear objeto del servicio y agregarlo a la lista
            var nuevoServicio = {
                id: Date.now(),
                contratoNumero: contratoTexto,
                codigo_contrato: selectContrato.value,
                servicioNombre: servicioNombre,
                precio: precioServicio,
                mesesTexto: mesesTexto,
                subtotal: subtotal.toFixed(2)
            };

            serviciosAgregados.push(nuevoServicio);

            // 6. Actualizar el total
            totalPagar = 0;
            for (var i = 0; i < serviciosAgregados.length; i++) {
                totalPagar += parseFloat(serviciosAgregados[i].subtotal);
            }

            // 7. Actualizar la tabla de detalles
            actualizarTablaDetalles();

            // 8. Limpiar selecciones
            limpiarSelecciones();

            // 9. Mostrar notificación de éxito
            mostrarNotificacion('Servicio agregado correctamente', 'success');

            console.log('Servicio agregado correctamente');
        }

        // Función para actualizar la tabla de detalles
        function actualizarTablaDetalles() {
            var tabla = document.querySelector('.overflow-x-auto table');
            if (!tabla) {
                console.error('No se encontró la tabla');
                return;
            }

            var tbody = tabla.querySelector('tbody');
            var tfootTotal = tabla.querySelector('tfoot td:last-child');

            if (!tbody || !tfootTotal) {
                console.error('No se encontraron elementos de la tabla');
                return;
            }

            // Limpiar tabla
            tbody.innerHTML = '';

            // Verificar si hay servicios
            if (serviciosAgregados.length === 0) {
                var tr = document.createElement('tr');
                tr.innerHTML = '<td colspan="6" class="py-4 text-center text-gray-500">' +
                    'No hay servicios agregados. Seleccione un servicio y los meses a pagar.' +
                    '</td>';
                tbody.appendChild(tr);
            } else {
                // Agregar cada servicio a la tabla
                for (var i = 0; i < serviciosAgregados.length; i++) {
                    var servicio = serviciosAgregados[i];
                    var index = i;

                    // Extraer solo los nombres de los meses (sin precios)
                    var mesesSoloNombres = servicio.mesesTexto.split(',')
                        .map(function(mes) {
                            return mes.split('(')[0].trim();
                        })
                        .join(', ');

                    var tr = document.createElement('tr');
                    tr.innerHTML = '<td class="py-2 px-4 border-b border-b-gray-50">' +
                        '<div class="flex items-center">' +
                        '<button onclick="eliminarServicio(' + index +
                        ')" class="w-8 h-8 rounded bg-red-100 flex items-center justify-center hover:bg-red-200">' +
                        '<i class="fas fa-trash text-red-500 text-sm"></i>' +
                        '</button>' +
                        '</div>' +
                        '</td>' +
                        '<td class="py-2 px-2 border-b border-b-gray-50">' +
                        '<span class="text-gray-600 text-sm font-medium ml-2">' + servicio.contratoNumero + '</span>' +
                        '</td>' +
                        '<td class="py-2 px-2 border-b border-b-gray-50 whitespace-nowrap">' +
                        '<span class="text-gray-600 text-sm font-medium ml-2 break-words" style="word-wrap: break-word; max-width: 200px; display: block;">' +
                        servicio.servicioNombre +
                        '</span>' +
                        '</td>' +
                        '<td class="py-2 px-4 border-b border-b-gray-50">' +
                        '<span class="text-[13px] font-medium text-gray-600">S/ ' + servicio.precio + '</span>' +
                        '</td>' +
                        '<td class="py-2 px-4 border-b border-b-gray-50">' +
                        '<span class="text-[13px] font-medium text-gray-600">' + mesesSoloNombres + '</span>' +
                        '</td>' +
                        '<td class="py-2 px-4 border-b border-b-gray-50 text-right">' +
                        '<span class="text-[13px] font-medium text-emerald-500">S/ ' + servicio.subtotal + '</span>' +
                        '</td>';
                    tbody.appendChild(tr);
                }
            }

            // Actualizar el total
            tfootTotal.textContent = 'S/ ' + totalPagar.toFixed(2);
        }

        // Función para eliminar un servicio
        function eliminarServicio(index) {
            serviciosAgregados.splice(index, 1);
            totalPagar = 0;
            for (var i = 0; i < serviciosAgregados.length; i++) {
                totalPagar += parseFloat(serviciosAgregados[i].subtotal);
            }
            actualizarTablaDetalles();
            mostrarNotificacion('Servicio eliminado correctamente', 'dark');
        }

        // Función para limpiar selecciones
        function limpiarSelecciones() {
            // Desmarcar todos los checkboxes
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            for (var i = 0; i < checkboxes.length; i++) {
                if (!checkboxes[i].disabled) {
                    checkboxes[i].checked = false;
                }
            }

            var selectServicio = document.querySelector('select[x-model="selectedServicio"]');
            if (selectServicio) {
                selectServicio.value = '';
                try {
                    selectServicio.dispatchEvent(new Event('change'));
                } catch (e) {
                    console.error('Error al disparar evento change:', e);
                }
            }
        }

        // Inicializar tabla al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            actualizarTablaDetalles();
            console.log('Tabla inicializada');
        });

        // Función auxiliar para obtener el número del mes
        function obtenerNumeroMes(nombreMes) {
            var meses = {
                'Enero': 1,
                'Febrero': 2,
                'Marzo': 3,
                'Abril': 4,
                'Mayo': 5,
                'Junio': 6,
                'Julio': 7,
                'Agosto': 8,
                'Septiembre': 9,
                'Octubre': 10,
                'Noviembre': 11,
                'Diciembre': 12
            };
            return meses[nombreMes] || 0;
        }

        // Función para enviar el pago mediante AJAX
        function enviarPago() {
            // Validaciones básicas
            var medioPago = document.querySelector('select[x-model="selectedMethod"]').value;
            if (!medioPago) {
                mostrarNotificacion('Por favor, seleccione un método de pago', 'error');
                return;
            }

            // Verificar que haya servicios agregados
            if (serviciosAgregados.length === 0) {
                mostrarNotificacion('Por favor, agregue al menos un servicio para pagar', 'error');
                return;
            }

            // Verificar la confirmación de pago
            if (!document.getElementById('confirm-payment').checked) {
                mostrarNotificacion('Debe confirmar que ha realizado el pago', 'error');
                return;
            }

            // Verificar que se haya subido un comprobante
            var comprobante = document.getElementById('dropzone-file').files[0];
            if (!comprobante) {
                mostrarNotificacion('Por favor, suba un comprobante de pago', 'error');
                return;
            }

            // Configurar el formulario para enviarlo con AJAX
            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('medio_pago', medioPago);
            formData.append('servicios', JSON.stringify(serviciosAgregados));
            formData.append('total_pagar', totalPagar);
            formData.append('comprobante', comprobante);

            // Cambiar estado del botón a "Enviando..."
            var botonEnviar = document.getElementById('enviarPago');
            var textoOriginal = botonEnviar.innerHTML;
            botonEnviar.disabled = true;
            botonEnviar.innerHTML =
                '<svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Enviando...';

            // Enviar datos mediante AJAX
            fetch('{{ route('panel.guardar-pago') }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        mostrarNotificacion(data.message, 'success');

                        setTimeout(function() {
                            limpiarFormulario();
                            window.location.href = "{{ route('panel.historial-pagos') }}";
                        }, 2000);
                    } else {
                        mostrarNotificacion(data.error, 'error');
                        botonEnviar.disabled = false;
                        botonEnviar.innerHTML = textoOriginal;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    mostrarNotificacion('Ocurrió un error al procesar la solicitud. Inténtelo nuevamente.', 'error');
                    botonEnviar.disabled = false;
                    botonEnviar.innerHTML = textoOriginal;
                });
        }

        // Función para limpiar el formulario completo
        function limpiarFormulario() {
            // Limpiar selecciones de contrato y servicio
            document.querySelector('select[x-model="selectedContrato"]').value = '';
            document.querySelector('select[x-model="selectedServicio"]').value = '';

            // Limpiar medio de pago
            document.querySelector('select[x-model="selectedMethod"]').value = '';

            // Desmarcar checkbox de confirmación
            document.getElementById('confirm-payment').checked = false;

            // Limpiar el input de archivo
            document.getElementById('dropzone-file').value = '';

            // Limpiar tabla de servicios agregados
            serviciosAgregados = [];
            totalPagar = 0;
            actualizarTablaDetalles();

            // Limpiar checkboxes
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            for (var i = 0; i < checkboxes.length; i++) {
                if (!checkboxes[i].disabled) {
                    checkboxes[i].checked = false;
                }
            }
        }
    </script>

@endsection

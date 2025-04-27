@extends('layouts.app-cliente')
@section('title', 'Nexus - Mi Perfil')

@section('content')

    <!-- Contenido principal -->
    <div class="relative p-4 w-full max-h-full mx-auto">
        <!-- Tarjeta principal -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <!-- Encabezado -->
            <div class="border-b border-gray-100 px-6 py-4">
                <h3 class="text-xl font-semibold text-gray-800">Mi Perfil</h3>
            </div>

            <!-- Contenido -->
            <div class="p-6">
                <!-- Sección superior: Información personal -->
                <div class="flex flex-col md:flex-row gap-6 mb-8 items-stretch">
                    <!-- Avatar y datos básicos -->
                    <div class="flex-1 bg-white p-5 rounded-lg border border-gray-100 shadow-xs">
                        <div class="flex items-start gap-5 h-full">
                            <!-- Avatar -->
                            <div class="relative flex-shrink-0 hidden md:block">
                                @php
                                    $cliente = \App\Models\Cliente::find(session('cliente_id'));
                                    $iniciales = strtoupper(substr($cliente->nombres, 0, 1) . substr($cliente->apellidos, 0, 1));
                                @endphp
                                <div
                                    class="w-18 h-18 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-sm">
                                    <span class="text-xl font-bold text-white">{{ $iniciales }}</span>
                                </div>
                                <div
                                    class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white">
                                </div>
                            </div>

                            <!-- Información básica -->
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <h2 class="text-xl font-light text-gray-900 mb-1">{{ $cliente->nombres . ' ' . $cliente->apellidos }}</h2>
                                    <div class="flex items-center text-xs text-gray-500 mb-2 ml-1">
                                        @php
                                            $meses = [
                                                1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
                                                5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
                                                9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
                                            ];
                                            $mes = $meses[$cliente->created_at->format('n')];
                                            $fecha = $cliente->created_at->format('d') . ' de ' . $mes . ' del ' . $cliente->created_at->format('Y');
                                        @endphp
                                        Registrado el {{ $fecha }}
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <span
                                        class="px-2.5 py-0.5 bg-blue-50 text-blue-600 text-xs rounded-full">{{ $cliente->identificacion }}</span>
                                    <span class="px-2.5 py-0.5 bg-gray-50 text-gray-600 text-xs rounded-full">
                                        {{ optional($cliente->region)->nombre }}, {{ optional($cliente->provincia)->nombre }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        use App\Models\Contrato;
                        use App\Models\ContratoServicio;

                        $servicioMostrado = null;
                        $planMostrado = null;
                        $estadoMostrado = null;

                        // Obtener todos los contratos del cliente
                        $contratos = Contrato::where('cliente_id', $cliente->id)->get();

                        // Buscar el primer servicio activo entre todos los contratos
                        $servicioActivo = ContratoServicio::whereIn('contrato_id', $contratos->pluck('id'))
                            ->where('estado_servicio_cliente', 'activo')
                            ->orderBy('fecha_servicio', 'asc')
                            ->with(['servicio', 'plan'])
                            ->first();

                        if ($servicioActivo) {
                            $servicioMostrado = $servicioActivo->servicio;
                            $planMostrado = $servicioActivo->plan;
                            $estadoMostrado = 'activo';
                        } else {
                            // Si no hay activos, buscar el último suspendido
                            $servicioSuspendido = ContratoServicio::whereIn('contrato_id', $contratos->pluck('id'))
                                ->where('estado_servicio_cliente', 'suspendido')
                                ->orderBy('fecha_suspension_servicio', 'desc')
                                ->with(['servicio', 'plan'])
                                ->first();

                            if ($servicioSuspendido) {
                                $servicioMostrado = $servicioSuspendido->servicio;
                                $planMostrado = $servicioSuspendido->plan;
                                $estadoMostrado = 'suspendido';
                            }
                        }
                    @endphp

                    <!-- Estado del servicio -->
                    <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-xs flex-1">
                        <div class="flex items-start space-x-3 h-full">
                            <!-- Icono minimalista -->
                            <i class="fas fa-wifi {{ $estadoMostrado === 'activo' ? 'text-green-500 dark:text-green-300' : 'text-gray-400 dark:text-gray-500' }}"></i>

                            <!-- Contenido -->
                            <div class="flex flex-col justify-between flex-1 h-full">
                                <div>
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-xs font-medium text-gray-500 tracking-wider">SERVICIO CONTRATADO</span>
                                        @if($estadoMostrado === 'activo')
                                            <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-0.5 rounded-full whitespace-nowrap">
                                                <i class="fas fa-check-circle"></i>
                                                Activo
                                            </span>
                                        @elseif($estadoMostrado === 'suspendido')
                                            <span class="text-xs font-semibold text-red-600 bg-red-100 px-2 py-0.5 rounded-full whitespace-nowrap">
                                                <i class="fas fa-times-circle"></i>
                                                Suspendido
                                            </span>
                                        @else
                                            <span class="text-xs font-semibold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full whitespace-nowrap">
                                                Sin servicios
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="text-base font-normal text-gray-800 mt-1.5">
                                        {{ $servicioMostrado ? $servicioMostrado->nombre : 'Sin servicio' }}
                                    </h3>
                                </div>
                                <div class="flex justify-between items-baseline mt-2">
                                    <span class="text-sm text-gray-500">Precio Mensual</span>
                                    <span class="text-base font-medium text-gray-900">
                                        {{ $planMostrado ? 'S/' . number_format($planMostrado->precio, 2) : '--' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información de contacto y ubicación -->
                <div
                    class="w-full grid grid-cols-1 md:grid-cols-3 gap-6 mb-4 rounded-lg border border-gray-100 shadow-xs bg-white dark:bg-gray-700 p-4">

                    <!-- 2. Teléfono -->
                    <div class="flex items-center space-x-3">
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <i class="fas fa-phone text-blue-500 dark:text-blue-300"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Teléfono</p>
                            <a href="tel:{{ $cliente->telefono }}"
                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium text-sm">
                                {{ $cliente->telefono }}
                            </a>
                        </div>
                    </div>

                    <!-- 3. Fecha de Instalación -->
                    <div class="flex items-center space-x-3">
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-blue-500 dark:text-blue-300"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Instalación</p>
                            <p class="text-gray-800 dark:text-white font-medium text-sm">{{ $cliente->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>

                    <!-- 6. Provincia -->
                    <div class="flex items-center space-x-3">
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                            <i class="fas fa-city text-purple-500 dark:text-purple-300"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Provincia</p>
                            <p class="text-gray-800 dark:text-white font-medium text-sm">
                                {{ optional($cliente->provincia)->nombre ?? '--' }}
                            </p>
                        </div>
                    </div>

                    <!-- 7. Distrito -->
                    <div class="flex items-center space-x-3">
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                            <i class="fas fa-map-marked-alt text-purple-500 dark:text-purple-300"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Distrito</p>
                            <p class="text-gray-800 dark:text-white font-medium text-sm">
                                {{ optional($cliente->distrito)->nombre ?? '--' }}
                            </p>
                        </div>
                    </div>

                    <!-- 8. Centro Poblado -->
                    <div class="flex items-center space-x-3">
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                            <i class="fas fa-map-pin text-purple-500 dark:text-purple-300"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Pueblo</p>
                            <p class="text-gray-800 dark:text-white font-medium text-sm">
                                {{ optional($cliente->pueblo)->nombre ?? '--' }}
                            </p>
                        </div>
                    </div>

                    <!-- 9. Dirección -->
                    <div class="flex w-full items-center space-x-3">
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                            <i class="fas fa-home text-purple-500 dark:text-purple-300"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Dirección Completa</p>
                            <p class="text-gray-800 dark:text-white font-medium text-sm">
                                {{ $cliente->direccion }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Historial de servicios -->
                <div class="pt-4">
                    <h4 class="text-lg font-medium text-gray-800 mb-4">Servicios Contratados</h4>

                    <div class="overflow-x-auto">
                        @php
                            // Obtener todos los contratos activos del cliente
                            $contratosActivos = \App\Models\Contrato::where('cliente_id', $cliente->id)
                                ->where('estado_contrato', 'activo')
                                ->get();

                            // Filtrar solo los contratos que tienen servicios activos
                            $contratosConServiciosActivos = $contratosActivos->filter(function($contrato) {
                                return $contrato->contratoServicios()
                                    ->where('estado_servicio_cliente', 'activo')
                                    ->count() > 0;
                            });
                        @endphp

                        @forelse($contratosConServiciosActivos as $contrato)
                            <div class="mb-6">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-sm font-medium text-gray-600">
                                        {{ 'CTR-' . str_pad($contrato->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <span class="text-xs px-2 py-0.5 rounded-full inline-flex items-center bg-green-100 text-green-700">
                                        <i class="fas fa-check-circle mr-1"></i> Activo
                                    </span>
                                </div>

                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Servicio</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($contrato->contratoServicios()->where('estado_servicio_cliente', 'activo')->get() as $cs)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-500">
                                                            <i class="fas fa-network-wired"></i>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $cs->servicio ? $cs->servicio->nombre : '--' }}
                                                                @if($cs->plan)
                                                                    - {{ $cs->plan->nombre }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ $cs->plan ? 'S/' . number_format($cs->plan->precio, 2) : '--' }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    @php
                                                        $fecha = $cs->fecha_servicio;
                                                        if ($fecha) {
                                                            $fechaObj = \Carbon\Carbon::parse($fecha);
                                                            $mes = $meses[$fechaObj->format('n')];
                                                            echo $fechaObj->format('d') . ' de ' . $mes . ' del ' . $fechaObj->format('Y');
                                                        } else {
                                                            echo '--';
                                                        }
                                                    @endphp
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-0.5 rounded-full">
                                                        <i class="fas fa-check-circle"></i> Activo
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @empty
                            <div class="text-center text-gray-400 py-4">
                                No tienes servicios activos actualmente.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

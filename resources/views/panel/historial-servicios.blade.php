@extends('layouts.app-cliente')
@section('title', 'Nexus - Historial de Servicios')

@section('content')
    <div class="relative p-4 w-full max-h-full mx-auto">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-b border-gray-100 px-6 py-4">
                <h3 class="text-xl font-semibold text-gray-800">Historial de Servicios</h3>
            </div>
            <div class="p-6">
                <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
                @php
                    use App\Models\Cliente;
                    use App\Models\Contrato;
                    $cliente = \App\Models\Cliente::find(session('cliente_id'));
                    $contratos = \App\Models\Contrato::where('cliente_id', $cliente->id)
                        ->orderByDesc('fecha_contrato')
                        ->get();
                    $meses = [
                        1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
                        5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
                        9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
                    ];
                    $config = \App\Models\ConfiguracionEmpresa::first();
                    $whatsapp = $config && $config->whatsapp ? $config->whatsapp : '';
                @endphp

                @forelse($contratos as $index => $contrato)
                    <div class="mb-4" x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }">
                        <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-2 bg-gray-50 hover:bg-gray-100 rounded-t transition text-left">
                            <div class="flex items-center gap-4">
                                <span class="font-semibold text-gray-700">
                                    Contrato {{ 'CTR-' . str_pad($contrato->id, 5, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    Fecha: 
                                    @php
                                        $fechaContrato = \Carbon\Carbon::parse($contrato->fecha_contrato);
                                        $mesContrato = $meses[$fechaContrato->format('n')];
                                        echo $fechaContrato->format('d') . ' de ' . $mesContrato . ' del ' . $fechaContrato->format('Y');
                                    @endphp
                                </span>
                                <span class="text-xs font-semibold px-2 py-0.5 rounded-full inline-flex items-center
                                    {{ $contrato->estado_contrato === 'activo' ? 'bg-green-100 text-green-700' : ($contrato->estado_contrato === 'suspendido' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-500') }}">
                                    @if($contrato->estado_contrato === 'activo')
                                        <i class="fas fa-check-circle mr-1"></i>
                                    @elseif($contrato->estado_contrato === 'suspendido')
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                    @else
                                        <i class="fas fa-circle mr-1"></i>
                                    @endif
                                    {{ ucfirst($contrato->estado_contrato) }}
                                </span>
                            </div>
                            <span>
                                <i :class="open ? 'fas fa-chevron-up' : 'fas fa-chevron-down'"></i>
                            </span>
                        </button>
                        <div x-show="open" x-transition>
                            <div class="overflow-x-auto border border-t-0 border-gray-100 rounded-b">
                                <table class="min-w-full text-sm divide-y divide-gray-200 mb-4">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-2 text-left font-semibold">Servicio</th>
                                            <th class="px-4 py-2 text-left font-semibold">Plan</th>
                                            <th class="px-4 py-2 text-left font-semibold">Fecha</th>
                                            <th class="px-4 py-2 text-left font-semibold">Fecha de suspensión</th>
                                            <th class="px-4 py-2 text-left font-semibold">Estado</th>
                                            <th class="px-4 py-2 text-center font-semibold">Renovar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($contrato->contratoServicios()->with(['servicio', 'plan'])->orderByDesc('fecha_servicio')->get() as $cs)
                                            <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                                                <td class="px-4 py-2">
                                                    {{ $cs->servicio ? $cs->servicio->nombre : '--' }}
                                                    @if($cs->plan)
                                                        - {{ $cs->plan->nombre }}
                                                    @endif
                                                </td>
                                                <td class="px-4 py-2">
                                                    {{ $cs->plan ? 'S/' . number_format($cs->plan->precio, 2) : '--' }}
                                                </td>
                                                <td class="px-4 py-2">
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
                                                <td class="px-4 py-2">
                                                    @if($cs->estado_servicio_cliente === 'suspendido' && $cs->fecha_suspension_servicio)
                                                        @php
                                                            $fechaSusp = \Carbon\Carbon::parse($cs->fecha_suspension_servicio);
                                                            $mesSusp = $meses[$fechaSusp->format('n')];
                                                            echo $fechaSusp->format('d') . ' de ' . $mesSusp . ' del ' . $fechaSusp->format('Y');
                                                        @endphp
                                                    @else
                                                        --
                                                    @endif
                                                </td>
                                                <td class="px-4 py-2">
                                                    @if($cs->estado_servicio_cliente === 'activo')
                                                        <span class="inline-flex items-center font-semibold px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                            <i class="fas fa-check-circle mr-1"></i> Activo
                                                        </span>
                                                    @elseif($cs->estado_servicio_cliente === 'suspendido')
                                                        <span class="inline-flex items-center font-semibold px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-600">
                                                            <i class="fas fa-times-circle mr-1"></i> Suspendido
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center font-semibold px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                                            <i class="fas fa-circle mr-1"></i> {{ ucfirst($cs->estado_servicio_cliente) }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-2 text-center">
                                                    @php
                                                        $nombreServicio = $cs->servicio ? $cs->servicio->nombre : '';
                                                        $nombrePlan = $cs->plan ? $cs->plan->nombre : '';
                                                        $precioPlan = $cs->plan ? 'S/' . number_format($cs->plan->precio, 2) : '';
                                                        $mensaje = rawurlencode("Hola, quiero renovar el servicio: $nombreServicio - $nombrePlan ($precioPlan)");
                                                        $numeroLimpio = trim(str_replace(['https://wa.me/', '+', ' '], '', $whatsapp));
                                                        $urlWhatsapp = $numeroLimpio ? "https://wa.me/$numeroLimpio?text=$mensaje" : "#";
                                                    @endphp
                                                    <a href="{{ $urlWhatsapp }}" target="_blank" title="Renovar por WhatsApp"
                                                       class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 text-white rounded-full w-8 h-8 transition">
                                                        <i class="fab fa-whatsapp text-lg"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="px-4 py-3 text-center text-gray-400">
                                                    No hay servicios en este contrato.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-400 py-8">
                        No tienes contratos registrados.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection


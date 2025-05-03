@extends('layouts.app-cliente')
@section('title', 'Nexus - Mensajes y Notificaciones')

@section('content')
    <!--Start Content -->
    <div class="container mx-auto p-4">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <!-- Encabezado -->
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium text-lg flex items-center gap-2">
                    <i class="fas fa-bell text-gray-600"></i>
                    Mensajes y Notificaciones
                </div>
            </div>

            <!-- Lista de Notificaciones -->
            <div class="space-y-4">
                @php
                    // Obtener el ID del cliente conectado actualmente
                    $cliente_id = session('cliente_id');
                    
                    // Consultar los pagos usando el cliente_id correcto
                    $pagos = DB::table('pagos')
                        ->where('cliente_id', $cliente_id)
                        ->whereIn('estado', ['Aprobado', 'Rechazado'])
                        ->orderBy('updated_at', 'desc')
                        ->get();
                    
                    $hayPagos = $pagos->count() > 0;
                    
                    // Configurar Carbon para usar español
                    \Carbon\Carbon::setLocale('es');
                @endphp
                
                @if($hayPagos)
                    @foreach($pagos as $pago)
                        @php
                            $clases = [
                                'Aprobado' => [
                                    'bg' => 'bg-white',
                                    'border' => 'border-l-4 border-emerald-400',
                                    'badge-bg' => 'bg-emerald-100',
                                    'badge-text' => 'text-emerald-600',
                                    'icon' => 'fas fa-check-circle'
                                ],
                                'Rechazado' => [
                                    'bg' => 'bg-white',
                                    'border' => 'border-l-4 border-rose-400',
                                    'badge-bg' => 'bg-rose-100',
                                    'badge-text' => 'text-rose-600',
                                    'icon' => 'fas fa-times-circle'
                                ]
                            ];
                            
                            $estado = $pago->estado;
                            $clase = $clases[$estado] ?? $clases['Aprobado'];
                            
                            // Obtener el tiempo transcurrido en formato legible en español
                            $tiempoTranscurrido = \Carbon\Carbon::parse($pago->updated_at)->diffForHumans();
                            
                            $metodoPago = 'default';

                            if (!empty($pago->medio_pago)) {
                                $metodoPago = $pago->medio_pago;
                            } 
                            else {
                                $detalles = json_decode($pago->detalles_servicio, true);
                                
                                if (is_array($detalles) && !empty($detalles)) {
                                    foreach ($detalles as $detalle) {
                                        if (!empty($detalle['metodoPago'])) {
                                            $metodoPago = $detalle['metodoPago'];
                                            break;
                                        }
                                    }
                                }
                            }
                            
                            $nombresMediosPago = [
                                'BCP' => 'Banco de Crédito del Perú',
                                'BBVA' => 'BBVA',
                                'BN' => 'Banco de la Nación',
                                'CAJA_PIURA' => 'Caja Piura',
                                'YAPE' => 'Yape',
                                'PLIN' => 'Plin',
                                'INTERBANK' => 'Interbank',
                                'SCOTIABANK' => 'Scotiabank'
                            ];
                            
                            // Obtener el nombre completo del medio de pago
                            $nombreMedioPago = $nombresMediosPago[strtoupper($metodoPago)] ?? ucfirst($metodoPago);
                            
                            // Crear la ruta de la imagen para el ícono
                            $imagenRuta = 'images/paymethods/' . strtolower($metodoPago) . '.png';
                            
                            // Obtener el color de fondo según el tipo de pago
                            $colorFondo = [
                                'BCP' => 'bg-[#005696]',
                                'BBVA' => 'bg-[#00427F]',
                                'BN' => 'bg-[#D12C1F]',
                                'CAJA_PIURA' => 'bg-gradient-to-r from-[#003C7F] to-[#0056B3]',
                                'YAPE' => 'bg-[#742284]',
                                'PLIN' => 'bg-[#6AB4E0]',
                                'INTERBANK' => 'bg-[#0A7A38]',
                                'SCOTIABANK' => 'bg-[#EC111A]'
                            ][strtoupper($metodoPago)] ?? 'bg-gray-200';
                            
                            // Obtenemos el servicio y período de los detalles
                            $servicio = '';
                            $periodo = $pago->meses_pagados ?? 'No especificado';
                            $monto = $pago->monto_total ?? '0.00';
                            
                            // Intentamos obtener el detalle de servicios si está disponible
                            $detalles = json_decode($pago->detalles_servicio, true);
                            if (is_array($detalles) && !empty($detalles)) {
                                $servicios = array_map(function($item) {
                                    return $item['servicio'] ?? 'No especificado';
                                }, $detalles);
                                
                                $servicio = implode(', ', $servicios);
                            }
                        @endphp
                        
                        <div class="flex flex-col sm:flex-row items-start gap-3 p-3 {{ $clase['bg'] }} {{ $clase['border'] }} border-t border-r border-b border-gray-100 rounded-md hover:shadow-sm transition-all duration-200">
                            <div class="flex-shrink-0 mb-2 sm:mb-0 flex items-center">
                                <div class="w-10 h-10 rounded-lg {{ $colorFondo }} flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset($imagenRuta) }}" alt="{{ $nombreMedioPago }}" class="w-full h-full object-cover">
                                </div>
                                <div class="ml-2 sm:hidden">
                                    <span class="whitespace-nowrap text-xs font-medium {{ $clase['badge-text'] }} {{ $clase['badge-bg'] }} px-1.5 py-0.5 rounded-md flex items-center gap-1">
                                        <i class="{{ $clase['icon'] }}"></i>
                                        {{ $estado === 'Aprobado' ? 'Aprobado' : $estado }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-1 w-full">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-1 gap-1">
                                    <div class="flex items-center gap-2">
                                        <span class="hidden sm:flex whitespace-nowrap text-xs font-medium {{ $clase['badge-text'] }} {{ $clase['badge-bg'] }} px-2 py-0.5 rounded-md items-center gap-1">
                                            <i class="{{ $clase['icon'] }}"></i>
                                            {{ $estado === 'Aprobado' ? 'Aprobado' : $estado }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-1 text-xs text-gray-500 bg-gray-50 px-1.5 py-0.5 rounded-md self-end sm:self-auto">
                                        <i class="far fa-clock"></i>
                                        <span>{{ $tiempoTranscurrido }}</span>
                                    </div>
                                </div>
                                <div class="mt-2 text-sm text-gray-600">
                                    <!-- Información general de pago -->
                                    <div class="grid grid-cols-2 gap-2 mb-2">
                                        <div>
                                            <span class="text-xs font-medium text-gray-500">Monto Total</span>
                                            <p class="font-medium text-gray-800">S/ {{ number_format((float)$monto, 2, '.', ',') }}</p>
                                        </div>
                                        <div>
                                            <span class="text-xs font-medium text-gray-500">Método de pago</span>
                                            <p class="font-medium text-gray-800">{{ $nombreMedioPago }}</p>
                                        </div>
                                    </div>
                                    
                                    @php
                                        $serviciosDetallados = [];
                                        $detallesArray = json_decode($pago->detalles_servicio, true);
                                        
                                        if (is_array($detallesArray) && !empty($detallesArray)) {
                                            foreach ($detallesArray as $detalle) {
                                                $serviciosDetallados[] = [
                                                    'servicio' => $detalle['servicio'] ?? 'No especificado',
                                                    'periodo' => $detalle['mesesTexto'] ?? ($detalle['meses'] ?? 'No especificado')
                                                ];
                                            }
                                        } else {
                                            $serviciosDetallados[] = [
                                                'servicio' => $servicio ?: 'No especificado',
                                                'periodo' => $periodo
                                            ];
                                        }
                                    @endphp
                                    
                                    <!-- Lista de servicios -->
                                    <div class="border-t border-gray-100 pt-2 mt-2">
                                        <div class="space-y-2 pl-1">
                                            @foreach($serviciosDetallados as $index => $item)
                                                <div class="{{ $index > 0 ? 'pt-2 border-t border-gray-50' : '' }}">
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-1">
                                                        <div>
                                                            <span class="text-xs font-medium text-gray-500">Servicio</span>
                                                            <p class="font-medium text-gray-800">{{ $item['servicio'] }}</p>
                                                        </div>
                                                        <div class="mt-1 sm:mt-0">
                                                            <span class="text-xs font-medium text-gray-500">Periodo</span>
                                                            <p class="font-medium text-gray-800">{{ $item['periodo'] }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    @if($estado === 'Rechazado' && !empty($pago->observaciones))
                                    <div class="mt-2 flex items-start gap-1.5 text-rose-600 bg-rose-50 p-2 rounded-md text-xs">
                                        <i class="fas fa-exclamation-circle mt-0.5"></i>
                                        <span>Motivo del rechazo: {{ $pago->observaciones }}</span>
                                    </div>
                                    @elseif(!empty($pago->observaciones))
                                    <div class="mt-2 flex items-start gap-1.5 text-gray-600 bg-gray-50 p-2 rounded-md text-xs">
                                        <i class="fas fa-info-circle mt-0.5"></i>
                                        <span>Observaciones: {{ $pago->observaciones }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex items-center justify-center p-5 bg-white border border-gray-100 rounded-md">
                        <div class="text-center">
                            <div class="inline-flex p-2 mb-3 rounded-full bg-gray-50">
                                <i class="far fa-bell-slash text-2xl text-gray-300"></i>
                            </div>
                            <p class="text-base font-medium text-gray-800">No tienes notificaciones aún</p>
                            <p class="mt-1 text-xs text-gray-500">Cuando un pago sea aprobado o rechazado, podrás ver su estado aquí.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!--End Content -->
@endsection

@section('scripts')
<script>
    // Al cargar la página de mensajes, marcar todas las notificaciones como vistas
    document.addEventListener('DOMContentLoaded', function() {
        @php
        // Obtener solo los pagos del cliente autenticado
        $cliente_id = session('cliente_id');
        $pagos = DB::table('pagos')
            ->where('cliente_id', $cliente_id)  // Filtrar por el ID del cliente autenticado
            ->whereIn('estado', ['Aprobado', 'Rechazado']) 
            ->orderBy('updated_at', 'desc')
            ->get();
            
        // Crear un array con información detallada de cada pago
        $pagosInfo = [];
        foreach ($pagos as $pago) {
            $pagosInfo[] = [
                'id' => $pago->id,
                'estado' => $pago->estado,
                'updated_at' => $pago->updated_at
            ];
        }
        $pagosInfoJson = json_encode($pagosInfo);
        @endphp
        
        // Guardamos la información de pagos en localStorage
        localStorage.setItem('pagos_vistos', JSON.stringify({{ $pagosInfoJson }}));
        
        // Ocultar el contador inmediatamente
        const badgeElement = document.getElementById('nuevos-mensajes-badge');
        if (badgeElement) {
            badgeElement.classList.add('hidden');
        }
        
        // Disparar evento para actualizar otras pestañas
        window.dispatchEvent(new StorageEvent('storage', {
            key: 'pagos_vistos',
            newValue: JSON.stringify({{ $pagosInfoJson }})
        }));
    });

    // Función para verificar nuevas notificaciones (usar en otras vistas)
    function verificarNuevasNotificaciones() {
        fetch('/obtener-pagos')
            .then(response => response.json())
            .then(pagosActuales => {
                const pagosVistosStr = localStorage.getItem('pagos_vistos') || '[]';
                let pagosVistos;
                
                try {
                    pagosVistos = JSON.parse(pagosVistosStr);
                } catch (e) {
                    pagosVistos = [];
                    console.error('Error al parsear pagos_vistos:', e);
                }
                
                // Crear mapa para búsqueda rápida de pagos vistos
                const mapaPagosVistos = new Map();
                pagosVistos.forEach(pago => {
                    mapaPagosVistos.set(pago.id, {
                        estado: pago.estado,
                        updated_at: pago.updated_at
                    });
                });
                
                // Contar pagos nuevos o con estado cambiado (solo Aprobados o Rechazados)
                let contadorNuevos = 0;
                
                pagosActuales.forEach(pago => {
                    // Solo considerar pagos Aprobados o Rechazados
                    if (pago.estado !== 'Aprobado' && pago.estado !== 'Rechazado') {
                        return;
                    }
                    
                    const pagoVisto = mapaPagosVistos.get(pago.id);
                    
                    // Es nuevo o cambió su estado o se actualizó después
                    if (!pagoVisto || 
                        pagoVisto.estado !== pago.estado || 
                        new Date(pago.updated_at) > new Date(pagoVisto.updated_at)) {
                        contadorNuevos++;
                    }
                });
                
                // Actualizar contador en la interfaz
                const badgeElement = document.getElementById('nuevos-mensajes-badge');
                if (badgeElement) {
                    if (contadorNuevos > 0) {
                        badgeElement.textContent = contadorNuevos;
                        badgeElement.classList.remove('hidden');
                    } else {
                        badgeElement.classList.add('hidden');
                    }
                }
            })
            .catch(error => console.error('Error al verificar notificaciones:', error));
    }
</script>
@endsection



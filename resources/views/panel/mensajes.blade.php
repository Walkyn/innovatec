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

                    $cliente_id = Auth::id();
                    $pagos = DB::table('pagos')
                        ->where('cliente_id', $cliente_id)
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
                                'en_revision' => [
                                    'bg' => 'bg-yellow-50',
                                    'border' => 'border-yellow-100',
                                    'badge-bg' => 'bg-yellow-100/60',
                                    'badge-text' => 'text-yellow-600',
                                    'icon-border' => 'border-yellow-200',
                                    'icon' => 'fas fa-clock'
                                ],
                                'Aprobado' => [
                                    'bg' => 'bg-green-50',
                                    'border' => 'border-green-100',
                                    'badge-bg' => 'bg-emerald-100/60',
                                    'badge-text' => 'text-emerald-600',
                                    'icon-border' => 'border-green-200',
                                    'icon' => 'fas fa-check-circle'
                                ],
                                'Rechazado' => [
                                    'bg' => 'bg-red-50',
                                    'border' => 'border-red-100',
                                    'badge-bg' => 'bg-rose-100/60',
                                    'badge-text' => 'text-rose-600',
                                    'icon-border' => 'border-red-200',
                                    'icon' => 'fas fa-times-circle'
                                ]
                            ];
                            
                            $estado = $pago->estado;
                            $clase = $clases[$estado] ?? $clases['en_revision'];
                            
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
                        
                        <div class="flex items-start gap-4 p-4 {{ $clase['bg'] }} border {{ $clase['border'] }} rounded-lg hover:shadow-md transition-all duration-200">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-full {{ $colorFondo }} flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset($imagenRuta) }}" alt="{{ $nombreMedioPago }}" class="w-full h-full object-cover p-1">
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="whitespace-nowrap text-xs font-medium {{ $clase['badge-text'] }} {{ $clase['badge-bg'] }} px-2 py-0.5 rounded-full flex items-center gap-1">
                                            <i class="{{ $clase['icon'] }}"></i>
                                            {{ $estado === 'en_revision' ? 'En Revisión' : $estado }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <i class="far fa-clock"></i>
                                        <span>{{ $tiempoTranscurrido }}</span>
                                    </div>
                                </div>
                                <div class="mt-3 text-sm text-gray-600">
                                    <div class="grid grid-cols-2 gap-3 ml-6">
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <span class="text-xs text-gray-500">Servicio</span>
                                                <p class="font-medium">{{ $servicio ?: 'No especificado' }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <span class="text-xs text-gray-500">Período</span>
                                                <p class="font-medium">{{ $periodo }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <span class="text-xs text-gray-500">Monto</span>
                                                <p class="font-medium">S/ {{ number_format((float)$monto, 2, '.', ',') }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <span class="text-xs text-gray-500">Método de pago</span>
                                                <p class="font-medium">{{ $nombreMedioPago }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($estado === 'Rechazado' && !empty($pago->observaciones))
                                    <div class="mt-3 flex items-center gap-2 text-rose-600 bg-rose-50 p-2 rounded-md">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <span class="text-xs">Motivo del rechazo: {{ $pago->observaciones }}</span>
                                    </div>
                                    @elseif(!empty($pago->observaciones))
                                    <div class="mt-3 flex items-center gap-2 text-gray-600 bg-gray-50 p-2 rounded-md">
                                        <i class="fas fa-info-circle"></i>
                                        <span class="text-xs">Observaciones: {{ $pago->observaciones }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex items-center justify-center p-6 text-gray-500">
                        <div class="text-center">
                            <i class="far fa-bell-slash text-4xl mb-2 text-gray-300"></i>
                            <p>No tienes notificaciones de pagos aún.</p>
                            <p class="text-sm mt-2">Cuando realices un pago, podrás ver su estado aquí.</p>
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
        $cliente_id = Auth::id();
        $pagos = DB::table('pagos')
            ->where('cliente_id', $cliente_id)
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
                
                // Contar pagos nuevos o con estado cambiado
                let contadorNuevos = 0;
                
                pagosActuales.forEach(pago => {
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


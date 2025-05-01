@extends('layouts.app-cliente')
@section('title', 'Nexus - Historial de Pagos')

@section('content')

    <!--Start Content -->
    <div class="relative p-4 w-full max-h-full mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Estado de Pagos</div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                    @php
                        // Calcular estadísticas por estado
                        $totales = [
                            'Aceptado' => ['count' => 0, 'sum' => 0],
                            'en_revision' => ['count' => 0, 'sum' => 0],
                            'Rechazado' => ['count' => 0, 'sum' => 0]
                        ];
                        
                        foreach($pagos as $pago) {
                            if (isset($totales[$pago->estado])) {
                                $totales[$pago->estado]['count']++;
                                $totales[$pago->estado]['sum'] += $pago->monto_total;
                            }
                        }
                    @endphp

                    <!-- Pagos Aceptados -->
                    <div class="rounded-md border border-dashed border-gray-200 p-4">
                        <div class="flex items-center mb-0.5">
                            <div class="text-xl font-semibold">{{ $totales['Aceptado']['count'] }}</div>
                            <span class="p-1 rounded text-[12px] font-semibold bg-emerald-500/10 text-emerald-500 leading-none ml-1">
                                S/ {{ number_format($totales['Aceptado']['sum'], 2) }}
                            </span>
                        </div>
                        <span class="text-gray-400 text-sm">Completado</span>
                    </div>
                    
                    <!-- Pagos en Revisión -->
                    <div class="rounded-md border border-dashed border-gray-200 p-4">
                        <div class="flex items-center mb-0.5">
                            <div class="text-xl font-semibold">{{ $totales['en_revision']['count'] }}</div>
                            <span class="p-1 rounded text-[12px] font-semibold bg-yellow-500/10 text-yellow-500 leading-none ml-1">
                                S/ {{ number_format($totales['en_revision']['sum'], 2) }}
                            </span>
                        </div>
                        <span class="text-gray-400 text-sm">En revisión</span>
                    </div>
                    
                    <!-- Pagos Rechazados -->
                    <div class="rounded-md border border-dashed border-gray-200 p-4">
                        <div class="flex items-center mb-0.5">
                            <div class="text-xl font-semibold">{{ $totales['Rechazado']['count'] }}</div>
                            <span class="p-1 rounded text-[12px] font-semibold bg-rose-500/10 text-rose-500 leading-none ml-1">
                                S/ {{ number_format($totales['Rechazado']['sum'], 2) }}
                            </span>
                        </div>
                        <span class="text-gray-400 text-sm">Rechazado</span>
                    </div>
                </div>

                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Historial de Pagos</div>
                </div>
                <div class="overflow-x-auto">
                    @php
                        $nombresMediosPago = [
                            'BCP' => 'Banco de Crédito del Perú',
                            'BBVA' => 'Banco BBVA',
                            'BN' => 'Banco de la Nación',
                            'CAJA_PIURA' => 'Caja Piura',
                            'YAPE' => 'Yape',
                            'PLIN' => 'Plin'
                        ];
                    @endphp
                    <table class="w-full min-w-[460px] whitespace-no-wrap">
                        <thead>
                            <tr>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md whitespace-nowrap">
                                    Medio de Pago</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Servicio</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Meses</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Monto</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Fecha</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md whitespace-nowrap">
                                    Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pagos as $pago)
                                <tr>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <div class="flex items-center">
                                            <img src="{{ asset('images/paymethods/' . strtolower($pago->medio_pago) . '.png') }}" alt="{{ $pago->medio_pago }}"
                                                class="w-8 h-8 rounded object-cover block">
                                            <span class="text-gray-600 text-sm font-medium ml-2 truncate">
                                                {{ $nombresMediosPago[$pago->medio_pago] ?? $pago->medio_pago }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        @php
                                            $detalles = json_decode($pago->detalles_servicio, true);
                                            $servicios = array_map(function($detalle) {
                                                return $detalle['servicio'];
                                            }, $detalles);
                                            $servicioTexto = implode(', ', array_slice($servicios, 0, 2));
                                            if (count($servicios) > 2) {
                                                $servicioTexto .= ' y ' . (count($servicios) - 2) . ' más';
                                            }
                                        @endphp
                                        <span class="text-[13px] font-medium text-gray-500">{{ $servicioTexto }}</span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="text-[13px] font-medium text-gray-500">{{ $pago->meses_pagados }}</span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50 whitespace-nowrap">
                                        <span class="text-[13px] font-medium text-emerald-500">S/ {{ number_format($pago->monto_total, 2) }}</span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="text-[13px] font-medium text-gray-500">{{ $pago->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50 whitespace-nowrap">
                                        @if($pago->estado == 'en_revision')
                                            <span class="text-xs font-medium text-yellow-600 bg-yellow-100/50 px-2 py-0.5 rounded-full flex items-center gap-1">
                                                <i class="fas fa-clock"></i>
                                                En revisión
                                            </span>
                                        @elseif($pago->estado == 'Aceptado')
                                            <span class="text-xs font-medium text-emerald-600 bg-emerald-100/50 px-2 py-0.5 rounded-full flex items-center gap-1">
                                                <i class="fas fa-check-circle"></i>
                                                Completado
                                            </span>
                                        @elseif($pago->estado == 'Rechazado')
                                            <span class="text-xs font-medium text-rose-600 bg-rose-100/50 px-2 py-0.5 rounded-full flex items-center gap-1">
                                                <i class="fas fa-times-circle"></i>
                                                Rechazado
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-gray-500">
                                        No has realizado ningún pago todavía.
                                        <a href="{{ route('panel.realizar-pago') }}" class="text-blue-500 hover:underline">Realiza tu primer pago</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginación -->
                <div class="mt-4 flex justify-center">
                    @if ($pagos->hasPages())
                    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
                        {{-- Botón Anterior --}}
                        @if ($pagos->onFirstPage())
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                                Anterior
                            </span>
                        @else
                            <a href="{{ $pagos->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                                Anterior
                            </a>
                        @endif

                        {{-- Números de Páginas --}}
                        <div class="hidden md:flex">
                            @foreach ($pagos->getUrlRange(1, $pagos->lastPage()) as $page => $url)
                                <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 mx-1 text-sm font-medium border rounded-md 
                                    {{ $page == $pagos->currentPage() ? 'bg-blue-50 border-blue-500 text-blue-600' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50' }}">
                                    {{ $page }}
                                </a>
                            @endforeach
                        </div>

                        {{-- Botón Siguiente --}}
                        @if ($pagos->hasMorePages())
                            <a href="{{ $pagos->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                                Siguiente
                            </a>
                        @else
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                                Siguiente
                            </span>
                        @endif
                    </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!--End Content -->

    <!-- Estilos personalizados para la paginación con Tailwind -->
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            padding: 0.5rem;
            margin-top: 1rem;
        }
        
        .pagination > nav {
            display: flex;
            justify-content: center;
            width: 100%;
        }
        
        .pagination .flex.justify-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .pagination .flex.items-center {
            display: flex;
            align-items: center;
        }
        
        .pagination .rounded-md {
            border-radius: 0.375rem;
        }
        
        .pagination .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .pagination .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        
        .pagination .text-gray-700 {
            color: rgba(55, 65, 81, 1);
        }
        
        .pagination .text-gray-500 {
            color: rgba(107, 114, 128, 1);
        }
        
        .pagination .hover\:bg-gray-50:hover {
            background-color: rgba(249, 250, 251, 1);
        }
        
        .pagination .border {
            border-width: 1px;
        }
        
        .pagination .border-gray-300 {
            border-color: rgba(209, 213, 219, 1);
        }
        
        .pagination svg {
            width: 1.25rem;
            height: 1.25rem;
        }
        
        .pagination .relative {
            position: relative;
        }
        
        .pagination .inline-flex {
            display: inline-flex;
        }
        
        .pagination .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        
        .pagination .cursor-default {
            cursor: default;
        }
        
        .pagination .cursor-not-allowed {
            cursor: not-allowed;
        }
        
        .pagination .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }
        
        .pagination .font-medium {
            font-weight: 500;
        }
        
        .pagination a {
            text-decoration: none;
        }
    </style>
@endsection

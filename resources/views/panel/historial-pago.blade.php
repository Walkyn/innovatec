@extends('layouts.app-cliente')
@section('title', 'Nexus - Historial de Pagos')

@section('content')

    <!--Start Content -->
    <div class="relative p-4 w-full max-h-full mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
                <div class="flex justify-between mb-4 items-center">
                    <div class="font-medium">Estado de Pagos</div>
                    <div class="relative">
                        <select id="yearSelector" class="bg-white border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-32 p-2">
                            @foreach($años_disponibles as $año)
                                <option value="{{ $año }}" {{ $año == $año_seleccionado ? 'selected' : '' }}>
                                    {{ $año }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                    @php
                        // Calcular estadísticas por estado
                        $totales = [
                            'Aprobado' => ['count' => 0, 'sum' => 0],
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
                            <div class="text-xl font-semibold">{{ $totales['Aprobado']['count'] }}</div>
                            <span class="p-1 rounded text-[12px] font-semibold bg-emerald-500/10 text-emerald-500 leading-none ml-1">
                                S/ {{ number_format($totales['Aprobado']['sum'], 2) }}
                            </span>
                        </div>
                        <span class="text-gray-400 text-sm">Aprobado</span>
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
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Estado</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Observaciones</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                    Acciones</th>
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
                                        @elseif($pago->estado == 'Aprobado')
                                            <span class="text-xs font-medium text-emerald-600 bg-emerald-100/50 px-2 py-0.5 rounded-full flex items-center gap-1">
                                                <i class="fas fa-check-circle"></i>
                                                Aprobado
                                            </span>
                                        @elseif($pago->estado == 'Rechazado')
                                            <span class="text-xs font-medium text-rose-600 bg-rose-100/50 px-2 py-0.5 rounded-full flex items-center gap-1">
                                                <i class="fas fa-times-circle"></i>
                                                Rechazado
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        @if($pago->estado == 'Rechazado')
                                            <span class="text-xs text-rose-600">{{ $pago->observaciones ?? '-' }}</span>
                                        @else
                                            <span class="text-xs text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <button onclick="confirmarEliminacion({{ $pago->id }})" 
                                                {{ $pago->estado != 'en_revision' ? 'disabled' : '' }}
                                                class="text-xs font-medium px-2 py-1 rounded-full flex items-center gap-1
                                                {{ $pago->estado == 'en_revision' 
                                                    ? 'text-rose-600 bg-rose-100/50 hover:bg-rose-200/50 cursor-pointer' 
                                                    : 'text-gray-400 bg-gray-100/50 cursor-not-allowed opacity-50' }}">
                                            <i class="fas fa-trash-alt"></i>
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-4 text-center text-gray-500">
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
                    {{ $pagos->links() }}
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

    <!-- Modal de Confirmación -->
    <div id="modalConfirmacion" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Fondo oscuro -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" aria-hidden="true"></div>

            <!-- Centrar modal -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Contenido del Modal -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Confirmar eliminación
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    ¿Estás seguro de que deseas eliminar este pago? Esta acción no se puede deshacer.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirmarEliminacion"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Eliminar
                    </button>
                    <button type="button" id="cancelarEliminacion"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Éxito -->
    <div id="modalExito" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Fondo oscuro -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Centrar modal -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Contenido del Modal -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Pago eliminado
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    El pago ha sido eliminado correctamente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="cerrarExito"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Aceptar
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const yearSelector = document.getElementById('yearSelector');
            const modalConfirmacion = document.getElementById('modalConfirmacion');
            const modalExito = document.getElementById('modalExito');
            let pagoIdToDelete = null;

            // Funciones para mostrar/ocultar modales
            function mostrarModalConfirmacion() {
                modalConfirmacion.classList.remove('hidden');
            }

            function ocultarModalConfirmacion() {
                modalConfirmacion.classList.add('hidden');
            }

            function mostrarModalExito() {
                modalExito.classList.remove('hidden');
            }

            function ocultarModalExito() {
                modalExito.classList.add('hidden');
                window.location.reload(); // Recargar solo después de cerrar el modal de éxito
            }

            // Manejador del selector de año
            if (yearSelector) {
                yearSelector.addEventListener('change', function() {
                    const selectedYear = this.value;
                    window.location.href = "{{ route('panel.historial-pago') }}?año=" + selectedYear;
                });
            }

            // Función para confirmar eliminación
            window.confirmarEliminacion = function(pagoId) {
                pagoIdToDelete = pagoId;
                mostrarModalConfirmacion();
            }

            // Botón de cancelar eliminación
            document.getElementById('cancelarEliminacion').addEventListener('click', ocultarModalConfirmacion);

            // Botón de confirmar eliminación
            document.getElementById('confirmarEliminacion').addEventListener('click', async function() {
                if (pagoIdToDelete) {
                    try {
                        const response = await fetch(`{{ route('panel.eliminar-pago', '') }}/${pagoIdToDelete}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            ocultarModalConfirmacion();
                            mostrarModalExito();
                        } else {
                            alert(data.message || 'Error al eliminar el pago');
                        }
                    } catch (error) {
                        alert('Error al procesar la solicitud');
                    }
                }
            });

            // Botón de cerrar modal de éxito
            document.getElementById('cerrarExito').addEventListener('click', ocultarModalExito);

            // Cerrar modales al hacer clic fuera
            window.addEventListener('click', function(event) {
                if (event.target === modalConfirmacion) {
                    ocultarModalConfirmacion();
                }
                if (event.target === modalExito) {
                    ocultarModalExito();
                }
            });

            // Cerrar modales con la tecla ESC
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    ocultarModalConfirmacion();
                    ocultarModalExito();
                }
            });
        });
    </script>
    @endpush

    @php
        // Agregar temporalmente para debug
        // dd([
        //     'año_seleccionado' => $año_seleccionado,
        //     'años_disponibles' => $años_disponibles,
        //     'total_pagos' => $pagos->count(),
        //     'cliente_id' => Auth::id()
        // ]);
    @endphp
@endsection

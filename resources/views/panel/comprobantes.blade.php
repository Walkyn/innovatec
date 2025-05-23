@extends('layouts.app-cliente')
@section('title', 'Nexus - Comprobantes')

@section('content')
    <!-- Contenido principal -->
    <div class="relative p-4 w-full max-h-full mx-auto">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium text-lg">Mis Comprobantes de Pago</div>
            </div>

            <!-- Buscador -->
            <div class="mb-4">
                <form action="{{ route('panel.comprobantes') }}" method="GET" class="w-full">
                    <label for="search" class="sr-only">Buscar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                            @if (request('search'))
                                <a href="{{ route('panel.comprobantes') }}"
                                    class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 cursor-pointer">
                                    <i class="fas fa-times"></i>
                                </a>
                            @else
                                <div class="pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <input type="search" id="search" name="search"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-200 rounded-md bg-white focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Buscar boleta ej: B2025-000001" 
                            value="{{ request('search') }}" />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>

            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <div class="max-h-[500px] overflow-y-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead class="sticky top-0 bg-gray-50">
                                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b">
                                    <th class="px-4 py-3">Boleta</th>
                                    <th class="px-4 py-3">Total</th>
                                    <th class="px-4 py-3">Fecha</th>
                                    <th class="px-4 py-3">Tipo Pago</th>
                                    <th class="px-4 py-3">Estado</th>
                                    <th class="px-4 py-3 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y">
                                @forelse($cobranzas->where('estado_cobro', 'emitido') as $cobranza)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 text-sm whitespace-nowrap">B{{ $cobranza->numero_boleta }}</td>
                                        <td class="px-4 py-3 text-sm whitespace-nowrap">
                                            <span class="whitespace-nowrap">
                                                S/ {{ number_format($cobranza->monto_total, 2) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">{{ $cobranza->fecha_cobro->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3 text-sm">{{ ucfirst($cobranza->tipo_pago) }}</td>
                                        <td class="px-4 py-3 text-xs">
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight rounded-full flex items-center text-green-700 bg-green-100">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                Emitido
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-2 text-sm text-center justify-center">
                                                <button
                                                    data-modal-target="ver-cobro-modal"
                                                    data-modal-toggle="ver-cobro-modal"
                                                    data-cobranza-id="{{ $cobranza->id }}"
                                                    class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-md hover:bg-blue-100 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-offset-1"
                                                    aria-label="Ver">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-3 text-sm text-center text-gray-500">
                                            No tienes comprobantes emitidos
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Paginación -->
            <div class="mt-4 flex justify-center">
                {{ $cobranzas->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Función para cargar los detalles del pago
            const cargarDetallesPago = async (cobranzaId) => {
                try {
                    const response = await fetch(`/panel/comprobante/${cobranzaId}/detalle`);
                    const data = await response.json();

                    if (!data.success) {
                        throw new Error(data.message || 'Error al cargar los detalles del comprobante');
                    }

                    const { cobranza, cliente, detalles } = data.data;

                    // Llenar datos del cliente
                    document.getElementById('numero-boleta').textContent = `B${cobranza.numero_boleta}`;
                    document.getElementById('cliente-nombre').value = cliente.nombres;
                    document.getElementById('cliente-identificacion').value = cliente.identificacion;
                    document.getElementById('cliente-telefono').value = cliente.telefono || 'No registrado';
                    document.getElementById('tipo-pago').value = cobranza.tipo_pago.charAt(0).toUpperCase() + cobranza.tipo_pago.slice(1);
                    document.getElementById('glosa').value = cobranza.glosa || 'Sin notas adicionales';
                    document.getElementById('fecha-cobro').textContent = cobranza.fecha_cobro;
                    document.getElementById('monto-total').textContent = `S/ ${cobranza.monto_total}`;

                    // Estado del cobro con icono
                    const estadoCobro = cobranza.estado_cobro;
                    const estadoCobroSpan = document.getElementById('estado-cobro');
                    const estadoIconos = {
                        'emitido': '<i class="fas fa-check-circle mr-2 text-green-600 dark:text-green-400"></i>',
                        'anulado': '<i class="fas fa-times-circle mr-2 text-red-600 dark:text-red-400"></i>'
                    };
                    const estadoClases = {
                        'emitido': 'text-green-600 dark:text-green-400',
                        'anulado': 'text-red-600 dark:text-red-400'
                    };

                    estadoCobroSpan.className = `flex items-center font-semibold ${estadoClases[estadoCobro]}`;
                    estadoCobroSpan.innerHTML = `${estadoIconos[estadoCobro]}${estadoCobro.charAt(0).toUpperCase() + estadoCobro.slice(1)}`;

                    // Llenar tabla de detalles
                    const tbody = document.getElementById('detalles-tabla');
                    tbody.innerHTML = '';

                    const detalleEstadoIconos = {
                        'pagado': '<i class="fas fa-check-circle mr-2"></i>',
                        'pendiente': '<i class="fas fa-clock mr-2"></i>',
                        'anulado': '<i class="fas fa-times-circle mr-2"></i>',
                        'no_aplica': '<i class="fas fa-ban mr-2"></i>'
                    };

                    const detalleEstadoClases = {
                        'pagado': 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100',
                        'pendiente': 'text-yellow-700 bg-yellow-100 dark:bg-yellow-700 dark:text-yellow-100',
                        'anulado': 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100',
                        'no_aplica': 'text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100'
                    };

                    detalles.forEach((detalle, index) => {
                        const tr = document.createElement('tr');
                        tr.className = 'text-gray-700 dark:text-gray-400';

                        tr.innerHTML = `
                            <td class="px-4 py-3 text-sm">${index + 1}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap overflow-hidden text-ellipsis">${detalle.servicio}</td>
                            <td class="px-4 py-3 text-sm whitespace-nowrap overflow-hidden text-ellipsis">${detalle.mes}</td>
                            <td class="px-4 py-3 text-xs">
                                <span class="px-2 py-1 font-semibold leading-tight rounded-full ${detalleEstadoClases[detalle.estado_pago]} flex items-center w-fit">
                                    ${detalleEstadoIconos[detalle.estado_pago]}
                                    ${detalle.estado_pago.charAt(0).toUpperCase() + detalle.estado_pago.slice(1)}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-right whitespace-nowrap">S/ ${detalle.monto_pagado}</td>
                        `;

                        tbody.appendChild(tr);
                    });

                } catch (error) {
                    console.error('Error:', error);
                    alert('Error al cargar los detalles del comprobante');
                }
            };

            // Agregar evento para abrir el modal
            document.querySelectorAll('[data-modal-target="ver-cobro-modal"]').forEach(button => {
                button.addEventListener('click', () => {
                    const cobranzaId = button.dataset.cobranzaId;
                    if (cobranzaId) {
                        cargarDetallesPago(cobranzaId);
                    }
                });
            });
        });
    </script>

    <!-- Modal Ver Comprobante -->
    <div id="ver-cobro-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 py-20 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900/50">
        <div class="relative p-4 w-full max-w-3xl max-h-full">
            <form>
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            <span id="numero-boleta" class="font-bold">B</span>
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="ver-cobro-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Cerrar modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <!-- Primera fila - Nombre y Identificación -->
                        <div class="flex flex-col md:flex-row -mx-3 mb-4">
                            <!-- Nombres y Apellidos -->
                            <div class="px-3 mb-4 md:mb-0 md:w-2/3">
                                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2" for="cliente-nombre">
                                    Nombres y Apellidos
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <i class="fas fa-user text-gray-500 dark:text-gray-400"></i>
                                    </div>
                                    <input type="text" id="cliente-nombre"
                                        class="border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        disabled />
                                </div>
                            </div>
                    
                            <!-- Identificación -->
                            <div class="px-3 md:w-1/3">
                                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2" for="cliente-identificacion">
                                    Identificación
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <i class="fas fa-id-card text-gray-500 dark:text-gray-400"></i>
                                    </div>
                                    <input class="bg-white border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        id="cliente-identificacion" disabled>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Segunda fila - Tipo de pago, Teléfono y Estado -->
                        <div class="flex flex-col md:flex-row -mx-3 mb-4">
                            <!-- Tipo de Pago -->
                            <div class="w-full px-3 mb-4 md:mb-0 md:w-1/3">
                                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2" for="tipo-pago">
                                    Tipo de Pago
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <i class="fas fa-money-bill text-gray-500 dark:text-gray-400"></i>
                                    </div>
                                    <input type="text" id="tipo-pago"
                                        class="border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        disabled />
                                </div>
                            </div>
                    
                            <!-- Teléfono -->
                            <div class="w-full px-3 mb-4 md:mb-0 md:w-1/3">
                                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2" for="cliente-telefono">
                                    Teléfono
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <i class="fas fa-phone text-gray-500 dark:text-gray-400"></i>
                                    </div>
                                    <input class="bg-white border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        id="cliente-telefono" disabled>
                                </div>
                            </div>
                    
                            <!-- Estado del Cobro -->
                            <div class="w-full px-3 md:w-1/3">
                                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2" for="estado-cobro">
                                    Estado del Cobro
                                </label>
                                <div class="relative">
                                    <div class="bg-white border border-gray-100 text-gray-900 text-sm rounded p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-white flex items-center">
                                        <span id="estado-cobro" class="flex items-center font-semibold"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Glosa -->
                        <div class="w-full mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2" for="glosa">
                                Glosa
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 start-3 pointer-events-none">
                                    <i class="fas fa-sticky-note text-gray-500 dark:text-gray-400"></i>
                                </div>
                                <textarea id="glosa"
                                    class="border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    disabled rows="2"></textarea>
                            </div>
                        </div>
                    
                        <!-- Tabla de detalles -->
                        <div class="w-full overflow-hidden rounded-lg shadow-xs">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full whitespace-nowrap">
                                    <thead>
                                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3">Item</th>
                                            <th class="px-4 py-3">Servicio</th>
                                            <th class="px-4 py-3">Mes</th>
                                            <th class="px-4 py-3">Estado</th>
                                            <th class="px-4 py-3 text-right">Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalles-tabla" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Total -->
                            <div class="px-4 py-3 text-xs font-semibold tracking-wide uppercase border-t dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                                    <div class="mb-2 md:mb-0">
                                        <span class="text-gray-600 dark:text-gray-400">FECHA DE COBRO:</span>
                                        <span id="fecha-cobro" class="text-gray-800 dark:text-gray-200 ml-2"></span>
                                    </div>
                                    <div class="flex whitespace-nowrap">
                                        <span class="text-gray-600 dark:text-gray-400">TOTAL:</span>
                                        <span id="monto-total" class="text-gray-800 dark:text-gray-200 ml-2"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="ver-cobro-modal" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Cerrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

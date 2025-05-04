@extends('layouts.app')
@section('title', 'Innovatec - Mensajes')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>

        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Mensajes
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{ route('home.index') }}">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Mensajes</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Alerts Start -->
            @include('partials.alerts')
            <!-- ====== Alerts End -->

            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">
                <!-- Botón de volver (solo visible en móviles) -->
                <button id="btnVolver" class="md:hidden fixed top-4 left-4 z-50 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-lg shadow-lg flex items-center space-x-1 transition-all duration-300 transform scale-100 hover:scale-110 hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="font-medium text-sm">Volver</span>
                </button>

                <div class="flex h-screen flex-col md:flex-row">
                    <!-- Sidebar con clientes agrupados -->
                    <div id="sidebar-clientes" class="w-full md:w-1/3 bg-white dark:bg-boxdark border-r border-gray-200 dark:border-strokedark">
                        <div class="p-6">
                            <h1 class="text-xl font-semibold text-black dark:text-white flex justify-between">
                                Pagos por revisar
                                @php
                                    $pagosPorCliente = $pagos->groupBy(function($pago) {
                                        return $pago['cliente']['id'] ?? 'desconocido';
                                    });
                                    // Contar clientes con al menos un pago pendiente
                                    $clientesConPagosPendientes = $pagosPorCliente->filter(function($pagosCliente) {
                                        return $pagosCliente->where('estado', 'en_revision')->count() > 0;
                                    })->count();
                                @endphp
                                <span class="bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300 text-sm px-2 py-1 rounded-md">{{ $clientesConPagosPendientes }} pendientes</span>
                            </h1>
                        </div>
                        <div class="overflow-y-auto p-4">
                            @foreach($pagosPorCliente as $clienteId => $pagosCliente)
                                @php
                                    $cliente = $pagosCliente->first()['cliente'] ?? null;
                                    $totalPagos = $pagosCliente->count();
                                    // Contar solo los pagos en estado de revisión
                                    $pagosPendientes = $pagosCliente->where('estado', 'en_revision')->count();
                                    $ordenados = $pagosCliente->sortByDesc('created_at');
                                    $ultimoPago = $ordenados->first();
                                    $fechaTexto = \Carbon\Carbon::parse($ultimoPago['created_at'])->format('d/m/Y');
                                @endphp
                                <div class="flex items-center text-sm mb-2 p-2 hover:bg-gray-50 dark:hover:bg-meta-4 cursor-pointer cliente-item"
                                    data-cliente-id="{{ $clienteId }}">
                                    <div class="relative">
                                        @php
                                            $iniciales = $cliente ? strtoupper(substr($cliente['nombres'],0,1) . substr($cliente['apellidos'],0,1)) : '?';
                                        @endphp
                                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                            {{ $iniciales }}
                                        </div>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="font-semibold text-black dark:text-white flex justify-between">
                                            {{ $cliente ? $cliente['nombres'] . ' ' . $cliente['apellidos'] : 'Cliente no encontrado' }}
                                            @if($pagosPendientes > 0)
                                            <span class="bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300 text-xs px-2 py-0.5 rounded-full whitespace-nowrap">
                                                {{ $pagosPendientes }}
                                            </span>
                                            @else
                                            <span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs px-2 py-0.5 rounded-full whitespace-nowrap">
                                                0
                                            </span>
                                            @endif
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                            <span class="whitespace-nowrap">
                                                <i class="far fa-calendar-alt mr-1"></i> Último pago: {{ $fechaTexto }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                
                    <!-- Área de detalle del pago seleccionado -->
                    <div id="detalle-pago" class="hidden md:flex flex-1 flex-col bg-gray-50 dark:bg-boxdark-2">
                        <div class="flex items-center justify-center h-full text-gray-400">
                            Selecciona un pago para ver los detalles.
                        </div>
                    </div>
                </div>

            </div>
            <!-- ====== Table Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

@endsection

<!-- Modal de éxito minimalista -->
<div id="modalExito" class="fixed inset-0 z-50 hidden bg-black bg-opacity-30" style="display: none;">
    <div class="bg-white p-5 rounded shadow max-w-xs w-full text-center">
        <p class="text-green-600 font-semibold mb-2">¡Pago actualizado!</p>
        <p class="text-gray-600 text-sm mb-4">Los cambios se guardaron correctamente.</p>
        <button id="cerrarModalExito" class="px-4 py-1.5 bg-green-500 text-white rounded hover:bg-green-600 text-sm font-medium">
            Aceptar
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pagos = @json($pagos);
        const detallePago = document.getElementById('detalle-pago');
        const sidebarClientes = document.getElementById('sidebar-clientes');
        const btnVolver = document.getElementById('btnVolver');
        
        // Recuperar el cliente temporal después de una actualización
        const clienteTemporal = localStorage.getItem('temp_cliente_actualizado');
        
        // Configuramos la delegación de eventos para los formularios
        document.addEventListener('click', function(e) {
            if (e.target && e.target.closest('.actualizar-form button[type="submit"]')) {
                const form = e.target.closest('.actualizar-form');
                if (form) {
                    e.preventDefault();
                    
                    const formData = new FormData(form);
                    const pagoId = formData.get('pago_id');
                    const nuevoEstado = formData.get('estado');
                    const observaciones = formData.get('observaciones');
                    
                    // Guardamos el cliente actual en localStorage antes de enviar
                    const clienteActual = form.closest('.flex-col.h-full').querySelector('.cliente-item')?.getAttribute('data-cliente-id') || 
                                         document.querySelector('.cliente-item.bg-gray-100')?.getAttribute('data-cliente-id');
                    
                    if (clienteActual) {
                        localStorage.setItem('temp_cliente_actualizado', clienteActual);
                    }
                    
                    // Enviamos el formulario a través de fetch
                    const data = {
                        pago_id: pagoId,
                        estado: nuevoEstado,
                        observaciones: observaciones,
                        _token: '{{ csrf_token() }}'
                    };
                    
                    fetch("{{ route('panel.actualizar-pago') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Mostrar el modal de éxito
                            const modal = document.getElementById('modalExito');
                            modal.classList.remove('hidden');
                            modal.style.display = 'flex';
                            modal.style.alignItems = 'center';
                            modal.style.justifyContent = 'center';
                            
                            // Al cerrar el modal, recargamos la página
                            document.getElementById('cerrarModalExito').onclick = function() {
                                modal.classList.add('hidden');
                                modal.style.display = 'none';
                                // Recargar la página para mostrar los cambios en la base de datos
                                window.location.reload();
                            };
                        } else {
                            alert(data.message || 'Error al actualizar el pago');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud');
                    });
                }
            }
        });
        
        // Función para manejar cambios de vista en móviles y escritorio
        function toggleVistaMobile(mostrarDetalle) {
            // En escritorio (md y superior): siempre mostrar ambos paneles
            if (window.innerWidth >= 768) {
                // Forzar visibilidad del sidebar en escritorio
                sidebarClientes.style.display = 'block';
                sidebarClientes.classList.remove('hidden', 'opacity-0');
                
                // Mostrar área de detalles
                detallePago.classList.remove('hidden');
                detallePago.classList.add('flex');
                
                // Ocultar botón volver
                btnVolver.classList.add('hidden');
                return;
            }
            
            // En móvil
            if (mostrarDetalle) {
                // Ocultar sidebar y mostrar detalle
                sidebarClientes.style.display = 'none';
                sidebarClientes.classList.add('hidden');
                
                detallePago.style.display = 'flex';
                detallePago.classList.remove('hidden');
                detallePago.classList.add('flex');
                
                btnVolver.classList.remove('hidden');
            } else {
                // Mostrar sidebar y ocultar detalle
                sidebarClientes.style.display = 'block';
                sidebarClientes.classList.remove('hidden');
                
                detallePago.style.display = 'none';
                detallePago.classList.add('hidden');
                detallePago.classList.remove('flex');
                
                btnVolver.classList.add('hidden');
            }
        }
        
        // Verificar estado al cargar la página
        if (window.innerWidth >= 768) {
            // Asegurar que ambos paneles sean visibles en desktop
            sidebarClientes.classList.remove('hidden');
            detallePago.classList.remove('hidden');
            detallePago.classList.add('flex');
        } else {
            // En móvil, mostrar solo el sidebar inicialmente
            sidebarClientes.classList.remove('hidden');
            detallePago.classList.add('hidden');
            detallePago.classList.remove('flex');
        }

        // Manejar cambio de tamaño de ventana
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                // En escritorio: FORZAR visibilidad de ambos paneles
                sidebarClientes.style.display = 'block';
                sidebarClientes.classList.remove('hidden', 'opacity-0');
                
                detallePago.classList.remove('hidden');
                detallePago.classList.add('flex');
                
                btnVolver.classList.add('hidden');
            } else {
                // En móvil: mantener estado actual pero con estilo correcto
                const detalleEstaVisible = detallePago.querySelector('.flex-col.h-full') !== null;
                
                if (detalleEstaVisible) {
                    sidebarClientes.style.display = 'none';
                    sidebarClientes.classList.add('hidden');
                    
                    detallePago.style.display = 'flex';
                    detallePago.classList.remove('hidden');
                    
                    btnVolver.classList.remove('hidden');
                } else {
                    sidebarClientes.style.display = 'block';
                    sidebarClientes.classList.remove('hidden');
                    
                    detallePago.style.display = 'none';
                    detallePago.classList.add('hidden');
                    
                    btnVolver.classList.add('hidden');
                }
            }
        });
        
        // Botón para volver al listado en móviles
        btnVolver.addEventListener('click', function() {
            toggleVistaMobile(false);
        });

        // Agrupar pagos por cliente para nuestro uso en el frontend
        const pagosPorCliente = {};
        pagos.forEach(pago => {
            if (pago.cliente && pago.cliente.id) {
                if (!pagosPorCliente[pago.cliente.id]) {
                    pagosPorCliente[pago.cliente.id] = [];
                }
                pagosPorCliente[pago.cliente.id].push(pago);
            }
        });

        // Ordenar pagos por fecha (más recientes primero)
        Object.keys(pagosPorCliente).forEach(clienteId => {
            pagosPorCliente[clienteId].sort((a, b) => 
                new Date(b.created_at) - new Date(a.created_at)
            );
        });

        // Manejar clics en los items de cliente
        document.querySelectorAll('.cliente-item').forEach(function(item) {
            item.addEventListener('click', function() {
                const clienteId = this.getAttribute('data-cliente-id');
                const pagosCliente = pagosPorCliente[clienteId] || [];
                const cliente = pagosCliente.length > 0 ? pagosCliente[0].cliente : null;
                
                if (!cliente) return;

                // Mostrar vista de detalles en móvil
                toggleVistaMobile(true);

                // Seleccionar y resaltar el cliente activo
                document.querySelectorAll('.cliente-item').forEach(i => 
                    i.classList.remove('bg-gray-100', 'dark:bg-meta-4')
                );
                this.classList.add('bg-gray-100', 'dark:bg-meta-4');

                // Calcular pagos pendientes
                const pagosPendientes = pagosCliente.filter(pago => pago.estado === 'en_revision').length;

                // Crear el historial de pagos como un chat
                let historialHTML = `
                    <div class="flex flex-col h-full">
                        <div class="flex items-center border-b px-4 py-4 bg-white dark:bg-boxdark border-gray-100 dark:border-gray-700">
                            <!-- Botón volver visible solo en móvil -->
                            <button class="mr-2 md:hidden text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400" id="btnVolverHeader">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            
                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white text-lg font-bold">
                                ${cliente.nombres.charAt(0).toUpperCase()}${cliente.apellidos.charAt(0).toUpperCase()}
                            </div>
                            <div class="ml-3 flex-1">
                                <div class="font-semibold text-black dark:text-white text-sm flex items-center flex-wrap">
                                    <span class="whitespace-nowrap">${cliente.nombres} ${cliente.apellidos}</span>
                                    ${pagosPendientes > 0 ? `
                                    <span class="ml-2 mt-1 text-xs bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300 px-2 py-0.5 rounded-full whitespace-nowrap">
                                        ${pagosPendientes}
                                    </span>
                                    ` : `
                                    <span class="ml-2 mt-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 px-2 py-0.5 rounded-full whitespace-nowrap">
                                        0
                                    </span>
                                    `}
                                </div>
                                <div class="text-xs text-gray-400 dark:text-gray-500">
                                    ${cliente.email ?? ''}
                                    <span class="ml-2 text-gray-400">Total: ${pagosCliente.length} pagos</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Historial de pagos (como chat) -->
                        <div class="flex-1 overflow-y-auto p-4 bg-gray-50 dark:bg-boxdark-2">
                `;

                // Generar cada pago como un "mensaje" en el chat
                pagosCliente.forEach(pago => {
                    const estados = [
                        {
                            valor: 'en_revision', 
                            texto: 'En revisión', 
                            icono: '<i class="fas fa-clock"></i>',
                            bgClaro: 'bg-yellow-100', 
                            bgOscuro: 'dark:bg-yellow-900/50', 
                            textClaro: 'text-yellow-600', 
                            textOscuro: 'dark:text-yellow-300'
                        },
                        {
                            valor: 'Aprobado', 
                            texto: 'Aprobado', 
                            icono: '<i class="fas fa-check-circle"></i>',
                            bgClaro: 'bg-emerald-100', 
                            bgOscuro: 'dark:bg-emerald-900/50', 
                            textClaro: 'text-emerald-600', 
                            textOscuro: 'dark:text-emerald-300'
                        },
                        {
                            valor: 'Rechazado', 
                            texto: 'Rechazado', 
                            icono: '<i class="fas fa-times-circle"></i>',
                            bgClaro: 'bg-rose-100', 
                            bgOscuro: 'dark:bg-rose-900/50', 
                            textClaro: 'text-rose-600', 
                            textOscuro: 'dark:text-rose-300'
                        }
                    ];
                    const estado = estados.find(e => e.valor === pago.estado) || estados[0];
                    
                    // Obtener detalles de servicios
                    let detallesHtml = '';
                    try {
                        const servicios = JSON.parse(pago.detalles_servicio);
                        detallesHtml = `
                            <div class="bg-white p-3 rounded-lg mb-3 border-l-4 border-blue-400">
                                <div class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Detalles del pago:</div>
                                
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    <div>
                                        <span class="text-xs font-medium text-gray-500">Monto Total</span>
                                        <p class="font-medium text-gray-800">S/ ${parseFloat(pago.monto_total).toFixed(2)}</p>
                                    </div>
                                    <div>
                                        <span class="text-xs font-medium text-gray-500">Método</span>
                                        <p class="font-medium text-gray-800">${pago.medio_pago || 'No especificado'}</p>
                                    </div>
                                </div>
                                
                                <div class="mt-3 border-t border-gray-100 pt-2">
                                    <div class="space-y-2">
                                        ${servicios.map((s, index) => `
                                            <div class="${index > 0 ? 'pt-2 border-t border-gray-50' : ''}">
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-1">
                                                    <div>
                                                        <span class="text-xs font-medium text-gray-500">Contrato</span>
                                                        <p class="font-medium text-gray-800">${s.contrato || 'No especificado'}</p>
                                                    </div>
                                                    <div class="mt-1 sm:mt-0">
                                                        <span class="text-xs font-medium text-gray-500">Servicio</span>
                                                        <p class="font-medium text-gray-800">${s.servicio}</p>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-2 gap-1 mt-1">
                                                    <div>
                                                        <span class="text-xs font-medium text-gray-500">Periodo</span>
                                                        <p class="font-medium text-gray-800">${s.mesesTexto || 'No especificado'}</p>
                                                    </div>
                                                    <div>
                                                        <span class="text-xs font-medium text-gray-500">Subtotal</span>
                                                        <p class="font-medium text-emerald-600">S/ ${s.subtotal || '0.00'}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        `).join('')}
                                    </div>
                                </div>
                            </div>
                        `;
                    } catch (e) {
                        detallesHtml = `
                            <div class="bg-white p-3 rounded-lg mb-3 border-l-4 border-blue-400">
                                <div class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Detalles del pago:</div>
                                <div class="text-gray-500 dark:text-gray-400">Detalles no disponibles</div>
                                <div class="mt-2">
                                    <span class="text-xs font-medium text-gray-500">Monto Total</span>
                                    <p class="font-medium text-gray-800">S/ ${parseFloat(pago.monto_total).toFixed(2)}</p>
                                </div>
                            </div>
                        `;
                    }

                    // Generar HTML para el comprobante
                    let comprobanteHtml = '';
                    if (pago.comprobante_path) {
                        comprobanteHtml = `
                            <div class="mt-2 p-2 border border-gray-200 dark:border-gray-700 rounded">
                                <div class="flex items-center mb-2">
                                    <svg class="w-4 h-4 text-blue-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                    </svg>
                                    <a href="/storage/${pago.comprobante_path}" target="_blank" class="text-blue-600 dark:text-blue-400 text-sm">Ver comprobante</a>
                                </div>
                                <img src="/storage/${pago.comprobante_path}" alt="Comprobante" class="max-w-xs rounded shadow-sm">
                            </div>
                        `;
                    }

                    // Crear el "mensaje" de pago
                    historialHTML += `
                        <div class="mb-6 bg-white dark:bg-boxdark rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden" id="pago-${pago.id}">
                            <!-- Cabecera del pago -->
                            <div class="border-b border-gray-100 dark:border-gray-700 p-3">
                                <div class="flex flex-col">
                                    <!-- Primera fila: ID de pago y estado -->
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="font-medium text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                            Pago #${pago.id}
                                        </span>
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold whitespace-nowrap flex items-center gap-1 ${estado.bgClaro} ${estado.bgOscuro} ${estado.textClaro} ${estado.textOscuro}">
                                            <span class="inline-block">${estado.icono}</span>
                                            <span>${estado.texto}</span>
                                        </span>
                                    </div>
                                    
                                    <!-- Segunda fila: fecha -->
                                    <div class="text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        ${new Date(pago.created_at).toLocaleDateString()} 
                                        <span class="text-xs ml-1">
                                            ${new Date(pago.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Cuerpo del pago -->
                            <div class="p-4">
                                <!-- Detalles de servicios -->
                                ${detallesHtml}
                                
                                <!-- Comprobante si existe -->
                                ${comprobanteHtml}
                                
                                <!-- Observaciones -->
                                ${pago.observaciones ? `
                                    <div class="mt-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                        <div class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Observaciones:</div>
                                        <div class="text-gray-600 dark:text-gray-400 text-sm">${pago.observaciones}</div>
                                    </div>
                                ` : ''}
                            </div>
                            
                            <!-- Actualizar estado (solo si está en revisión) -->
                            ${pago.estado === 'en_revision' ? `
                                <form class="border-t border-gray-100 dark:border-gray-700 p-3 flex flex-col gap-2 actualizar-form" data-pago-id="${pago.id}">
                                    <div class="flex items-center gap-2">
                                        <label class="text-xs font-semibold text-gray-500 dark:text-gray-400">Cambiar estado:</label>
                                        <select name="estado" class="border border-gray-300 dark:border-gray-700 dark:bg-meta-4 dark:text-white rounded p-1 text-sm">
                                            ${estados.map(e => `<option value="${e.valor}" ${pago.estado === e.valor ? 'selected' : ''}>${e.texto}</option>`).join('')}
                                        </select>
                                        <input type="hidden" name="pago_id" value="${pago.id}">
                                        <button type="submit" class="ml-auto bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-semibold">Actualizar</button>
                                    </div>
                                    <textarea name="observaciones" placeholder="Añadir observaciones..." class="mt-1 border border-gray-300 dark:border-gray-700 dark:bg-meta-4 dark:text-white rounded p-2 text-sm w-full"></textarea>
                                </form>
                            ` : ''}
                        </div>
                    `;
                });

                // Cerrar el contenedor del historial
                historialHTML += `
                        </div>
                    </div>
                `;

                // Insertar el HTML en el contenedor
                detallePago.innerHTML = historialHTML;

                // Asignar evento al botón volver dentro del header
                const btnVolverHeader = document.getElementById('btnVolverHeader');
                if (btnVolverHeader) {
                    btnVolverHeader.addEventListener('click', function() {
                        toggleVistaMobile(false);
                    });
                }
            });
        });
        
        if (clienteTemporal) {
            localStorage.removeItem('temp_cliente_actualizado');
            
            const elementoCliente = document.querySelector(`.cliente-item[data-cliente-id="${clienteTemporal}"]`);
            if (elementoCliente) {
                setTimeout(() => {
                    elementoCliente.click();
                }, 200);
            }
        }
    });
</script>







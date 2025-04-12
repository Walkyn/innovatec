<!-- Main modal -->
<div id="ver-cobro-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 py-20 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-3xl max-h-full">
        <form>
            <!-- Modal content -->
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
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <!-- Campo de Datos del Cliente y Identificación -->
                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="cliente-nombre">
                                Datos del Cliente
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

                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="cliente-identificacion">
                                Identificación
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <i class="fas fa-id-card text-gray-500 dark:text-gray-400"></i>
                                </div>
                                <input
                                    class="bg-white border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    id="cliente-identificacion" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="tipo-pago">
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

                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="cliente-telefono">
                                Teléfono
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <i class="fas fa-phone text-gray-500 dark:text-gray-400"></i>
                                </div>
                                <input
                                    class="bg-white border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    id="cliente-telefono" disabled>
                            </div>
                        </div>

                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="estado-cobro">
                                Estado del Cobro
                            </label>
                            <div class="relative">
                                <div
                                    class="bg-white border border-gray-100 text-gray-900 text-sm rounded p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-white flex items-center">
                                    <span id="estado-cobro" class="flex items-center font-semibold"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Glosa -->
                    <div class="w-full mb-6">
                        <label
                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                            for="glosa">
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

                    <main class="h-full overflow-y-auto">
                        <div class="w-full overflow-hidden rounded-lg shadow-xs">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full whitespace-no-wrap">
                                    <thead>
                                        <tr
                                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3">Item</th>
                                            <th class="px-4 py-3">Servicio</th>
                                            <th class="px-4 py-3">Mes</th>
                                            <th class="px-4 py-3">Estado</th>
                                            <th class="px-4 py-3 text-right">Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalles-tabla"
                                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    </tbody>
                                </table>
                            </div>
                            <!-- Total y Cambio -->
                            <div
                                class="px-4 py-3 text-xs font-semibold tracking-wide uppercase border-t dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <div
                                    class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-2 md:space-y-0">
                                    <div class="flex flex-col space-y-2 w-full md:w-auto">
                                        <div class="flex items-center justify-between w-full">
                                            <span class="text-gray-600 dark:text-gray-400">FECHA DE COBRO:</span>
                                            <span id="fecha-cobro" class="text-gray-800 dark:text-gray-200 ml-2"></span>
                                        </div>
                                        <div class="flex items-center justify-between w-full">
                                            <span class="text-gray-600 dark:text-gray-400">USUARIO:</span>
                                            <span id="usuario-nombre"
                                                class="text-gray-800 dark:text-gray-200 ml-2"></span>
                                        </div>
                                    </div>
                                    <div
                                        class="flex flex-col md:flex-row items-start md:items-center space-y-2 md:space-y-0 md:space-x-8 w-full md:w-auto">
                                        <div class="flex items-center justify-between w-full md:w-auto">
                                            <span class="text-gray-600 dark:text-gray-400">PAGO:</span>
                                            <span id="monto-pago"
                                                class="text-gray-800 dark:text-gray-200 ml-2"></span>
                                        </div>
                                        <div class="flex items-center justify-between w-full md:w-auto">
                                            <span class="text-gray-600 dark:text-gray-400">CAMBIO:</span>
                                            <span id="monto-cambio"
                                                class="text-gray-800 dark:text-gray-200 ml-2"></span>
                                        </div>
                                        <div class="flex items-center justify-between w-full md:w-auto">
                                            <span class="text-gray-600 dark:text-gray-400">TOTAL:</span>
                                            <span id="monto-total"
                                                class="text-gray-800 dark:text-gray-200 ml-2"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="ver-cobro-modal" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Cerrar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Función para cargar los detalles del pago
        const cargarDetallesPago = async (cobranzaId) => {
            try {
                const response = await fetch(`/payments/${cobranzaId}`);
                const data = await response.json();

                if (!data.success) {
                    throw new Error(data.message || 'Error al cargar los detalles del pago');
                }

                const {
                    cobranza,
                    cliente,
                    detalles
                } = data.data;

                // Llenar datos del cliente
                document.getElementById('numero-boleta').textContent = `B${cobranza.numero_boleta}`;
                document.getElementById('cliente-nombre').value = cliente.nombres;
                document.getElementById('cliente-identificacion').value = cliente.identificacion;
                document.getElementById('cliente-telefono').value = cliente.telefono;
                document.getElementById('tipo-pago').value = cobranza.tipo_pago.charAt(0)
                .toUpperCase() + cobranza.tipo_pago.slice(1);
                document.getElementById('usuario-nombre').textContent = cobranza.usuario.name;
                document.getElementById('glosa').value = cobranza.glosa || 'Sin notas adicionales';
                document.getElementById('fecha-cobro').textContent = cobranza.fecha_cobro;
                document.getElementById('monto-total').textContent = `S/ ${cobranza.monto_total}`;
                document.getElementById('monto-pago').textContent =
                `S/ ${cobranza.monto_pago_efectivo}`;
                document.getElementById('monto-cambio').textContent =
                    `S/ ${cobranza.monto_cambio_efectivo}`;

                // Manejar el estado del cobro con icono
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

                estadoCobroSpan.className =
                    `flex items-center font-semibold ${estadoClases[estadoCobro]}`;
                estadoCobroSpan.innerHTML =
                    `${estadoIconos[estadoCobro]}${estadoCobro.charAt(0).toUpperCase() + estadoCobro.slice(1)}`;

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
                alert('Error al cargar los detalles del pago');
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

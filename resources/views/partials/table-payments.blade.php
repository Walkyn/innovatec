<main class="h-full pb-16 overflow-y-auto">
    <div>
        <div class="flex justify-between items-center mb-4 mt-2">
            <!-- Título -->
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                Lista de cobranzas
            </h4>

            <!-- Botón cobro -->
            <div class="flex space-x-4">
                <button data-modal-target="cobro-modal" data-modal-toggle="cobro-modal" type="button"
                    class="flex items-center px-6 py-2 text-sm font-medium leading-5 text-white bg-green-600 rounded shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-hand-holding-usd mr-2"></i>
                    Nuevo Cobro
                </button>
            </div>

        </div>

        <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 md:space-x-4 mb-4">
            <!-- Item Buscador Start -->
            <form class="w-full md:w-2/3">
                <label for="default-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar Pagos, Clientes..." required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                </div>
            </form>
            <!-- Item Buscador End -->

            <!-- Campo de Estado Servicio -->
            <div class="w-full md:w-1/3">
                <div class="relative">
                    <select id="large" class="block w-full px-4 py-3.5 text-base text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <option selected>Buscar tipo de pago</option>
                      <option value="EF">Efectivo</option>
                      <option value="DP">Depósito</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Boleta</th>
                            <th class="px-4 py-3 hidden">Identificación</th>
                            <th class="px-4 py-3">Cliente</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Fecha</th>
                            <th class="px-4 py-3">Pago</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse($cobranzas as $cobranza)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">B{{ $cobranza->numero_boleta }}</td>
                            <td class="px-4 py-3 text-sm hidden">{{ $cobranza->cliente->identificacion }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold">{{ $cobranza->cliente->nombres }} {{ $cobranza->cliente->apellidos }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">S/ {{ number_format($cobranza->monto_total, 2) }}</td>
                            <td class="px-4 py-3 text-sm">{{ $cobranza->fecha_cobro->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-sm">{{ ucfirst($cobranza->tipo_pago) }}</td>
                            <td class="px-4 py-3 text-xs">
                                <span class="px-2 py-1 font-semibold leading-tight rounded-full flex items-center 
                                    {{ $cobranza->estado_cobro === 'emitido' ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100' }}">
                                    <i class="fas {{ $cobranza->estado_cobro === 'emitido' ? 'fa-check-circle mr-2' : 'fa-times-circle mr-2' }}"></i>
                                    {{ ucfirst($cobranza->estado_cobro) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-2 text-sm">
                                    <!-- Botón Imprimir -->
                                    <button
                                        class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-md hover:bg-green-100 focus:outline-none focus:ring-1 focus:ring-green-300 focus:ring-offset-1 dark:text-green-200 dark:bg-green-900 dark:border-green-700 dark:hover:bg-green-800 dark:focus:ring-green-600"
                                        aria-label="Imprimir">
                                        <i class="fas fa-print"></i>
                                    </button>

                                    <!-- Botón Exportar a PDF -->
                                    <button
                                        class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-purple-600 bg-purple-50 border border-purple-200 rounded-md hover:bg-purple-100 focus:outline-none focus:ring-1 focus:ring-purple-300 focus:ring-offset-1 dark:text-purple-200 dark:bg-purple-900 dark:border-purple-700 dark:hover:bg-purple-800 dark:focus:ring-purple-600"
                                        aria-label="Exportar a PDF">
                                        <i class="fas fa-file-pdf"></i>
                                    </button>

                                    <!-- Botón Ver -->
                                    <button data-modal-target="ver-cobro-modal" data-modal-toggle="ver-cobro-modal"
                                        type="button" data-cobranza-id="{{ $cobranza->id }}"
                                        class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-md hover:bg-blue-100 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-offset-1 dark:text-blue-200 dark:bg-blue-900 dark:border-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-600"
                                        aria-label="Ver">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Botón Anular -->
                                    @if($cobranza->estado_cobro !== 'anulado')
                                    <button data-cobranza-id="{{ $cobranza->id }}"
                                        class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-yellow-600 bg-yellow-50 border border-yellow-200 rounded-md hover:bg-yellow-100 focus:outline-none focus:ring-1 focus:ring-yellow-300 focus:ring-offset-1 dark:text-yellow-200 dark:bg-yellow-900 dark:border-yellow-700 dark:hover:bg-yellow-800 dark:focus:ring-yellow-600 btn-anular"
                                        aria-label="Anular">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-4 py-3 text-sm text-center text-gray-500 dark:text-gray-400">
                                No hay cobranzas registradas
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                    Viendo {{ $cobranzas->firstItem() ?? 0 }}-{{ $cobranzas->lastItem() ?? 0 }} de {{ $cobranzas->total() ?? 0 }}
                </span>
                <span class="col-span-2"></span>
                <!-- Paginación -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    {{ $cobranzas->links() }}
                </span>
            </div>
        </div>

    </div>
</main>

<script>
    // Agregar al final del script existente
    document.addEventListener('DOMContentLoaded', function() {
        // Función para mostrar el modal de confirmación de anulación
        const mostrarConfirmacionAnulacion = (cobranzaId) => {
            const modal = document.createElement('div');
            modal.className = 'relative z-[100]';
            modal.setAttribute('aria-labelledby', 'modal-title');
            modal.setAttribute('role', 'dialog');
            modal.setAttribute('aria-modal', 'true');

            modal.innerHTML = `
                <div class="fixed inset-0 bg-gray-900/75 dark:bg-gray-900/90 transition-opacity"></div>
                <div class="fixed inset-0 z-[100] w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-700 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <div class="bg-white dark:bg-gray-700 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900 sm:mx-0 sm:h-10 sm:w-10">
                                        <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-200"></i>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white" id="modal-title">
                                            Confirmar anulación
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500 dark:text-gray-300">
                                                ¿Está seguro que desea anular este cobro? Esta acción no se puede deshacer.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-600 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="button" id="confirmar-anulacion"
                                    class="inline-flex w-full justify-center rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-500 sm:ml-3 sm:w-auto">
                                    Confirmar
                                </button>
                                <button type="button" id="cancelar-anulacion"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);

            // Manejar la confirmación
            document.getElementById('confirmar-anulacion').addEventListener('click', async () => {
                try {
                    const response = await fetch(`/payments/${cobranzaId}/anular`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        window.location.reload();
                    } else {
                        throw new Error(data.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Error al anular el cobro: ' + error.message);
                } finally {
                    document.body.removeChild(modal);
                }
            });

            // Manejar la cancelación
            document.getElementById('cancelar-anulacion').addEventListener('click', () => {
                document.body.removeChild(modal);
            });
        };

        // Agregar evento a los botones de anular
        document.querySelectorAll('.btn-anular').forEach(button => {
            button.addEventListener('click', () => {
                const cobranzaId = button.dataset.cobranzaId;
                mostrarConfirmacionAnulacion(cobranzaId);
            });
        });
    });
</script>

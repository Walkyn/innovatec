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

        <div class="flex items-center justify-between space-x-4 mb-4">
            <!-- Item Buscador Start -->
            <form class="w-2/3">
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
            <div class="w-1/3">
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
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">2025-0000001</td>
                            <td class="px-4 py-3 text-sm hidden">63371697</td>
                            <td class="px-4 py-3 text-sm">Brayan Capa Medina</td>
                            <td class="px-4 py-3 text-sm">50.00</td>
                            <td class="px-4 py-3 text-sm">2025-01-15</td>
                            <td class="px-4 py-3 text-sm">Efectivo</td>
                            <td class="px-4 py-3 text-xs">
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                    Aceptado
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
                                        type="button"
                                        class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-md hover:bg-blue-100 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-offset-1 dark:text-blue-200 dark:bg-blue-900 dark:border-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-600"
                                        aria-label="Ver">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Botón Eliminar -->
                                    <button
                                        class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-red-600 bg-red-50 border border-red-200 rounded-md hover:bg-red-100 focus:outline-none focus:ring-1 focus:ring-red-300 focus:ring-offset-1 dark:text-red-200 dark:bg-red-900 dark:border-red-700 dark:hover:bg-red-800 dark:focus:ring-red-600"
                                        aria-label="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <span class="flex items-center col-span-3">
                    Viendo 1-10 de 50
                </span>
                <span class="col-span-2"></span>
                <!-- Paginación -->
                <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                    <nav aria-label="Table navigation">
                        <ul class="inline-flex items-center">
                            <li>
                                <button
                                    class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                    aria-label="Previous">
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </li>
                            <li>
                                <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                    1
                                </button>
                            </li>
                            <li>
                                <button
                                    class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                                    2
                                </button>
                            </li>
                            <li>
                                <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                    3
                                </button>
                            </li>
                            <li>
                                <span class="px-3 py-1">...</span>
                            </li>
                            <li>
                                <button
                                    class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                    aria-label="Next">
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4-4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </li>
                        </ul>
                    </nav>
                </span>
            </div>
        </div>

    </div>
</main>

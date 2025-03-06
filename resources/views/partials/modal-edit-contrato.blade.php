<!-- Main modal -->
<div id="modificar-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 py-20 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <form>
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Actualizar Contrato
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="modificar-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <!-- Campo de Datos del Cliente -->
                        <div class="w-full md:w-full px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="client-name">
                                Datos del Cliente
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <i class="fa fa-user text-gray-500 dark:text-gray-400"></i>
                                </div>
                                <input type="text" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    disabled />
                            </div>
                        </div>
                    </div>

                    <!-- ====== Servicio - Plan Section Start -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="grid-state">
                                Categoría
                            </label>
                            <div class="relative">
                                <select
                                    class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                    id="categoria">
                                    <option>Streaming</option>
                                    <option>Energía</option>
                                    <option>Internet</option>
                                </select>
                            </div>
                        </div>

                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="grid-city">
                                Servicio
                            </label>
                            <div class="relative">
                                <select
                                    class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                    id="servicio">
                                    <option>Internet</option>
                                    <option>Netflix</option>
                                    <option>DGO</option>
                                </select>
                            </div>
                        </div>

                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="grid-zip">
                                Plan
                            </label>
                            <div class="relative">
                                <div class="relative">
                                    <input
                                        class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                        id="plan" placeholder="50.00" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ====== Servicio - Plan Section End -->

                    <!-- ====== Estado - Fecha - Boton Section Start -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <!-- Campo de Fecha -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="grid-city">
                                Fecha
                            </label>
                            <input type="date"
                                class="appearance-none block w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                id="fecha_servicio">
                        </div>

                        <!-- Campo de Estado -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="grid-city">
                                Estado
                            </label>
                            <div class="relative">
                                <select
                                    class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                    id="servicio">
                                    <option>Activo</option>
                                    <option>Inactivo</option>
                                    <option>Suspendido</option>
                                </select>
                            </div>
                        </div>

                        <!-- Botón Agregar -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <div class="relative">
                                <!-- Botón con ícono de agregar -->
                                <button type="button"
                                    class="block mt-6 w-full bg-green-500 dark:bg-green-700 border border-green-500 dark:border-green-700 text-white dark:text-gray-300 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-green-600 dark:focus:bg-green-800 items-center justify-center">
                                    <i class="fa fa-plus text-sm"></i> <!-- Icono de agregar -->
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- ====== Estado - Fecha - Boton Section End -->

                    <main class="h-full overflow-y-auto">
                        <div>
                            <div class="flex justify-start items-center mb-4">
                                <!-- Título -->
                                <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                                    Detalles
                                </h4>
                            </div>

                            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                                <div class="w-full overflow-x-auto">
                                    <table class="w-full whitespace-no-wrap">
                                        <thead>
                                            <tr
                                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                                <th class="px-4 py-3">Acción</th>
                                                <th class="px-4 py-3">Servicio</th>
                                                <th class="px-4 py-3">Fecha</th>
                                                <th class="px-4 py-3">Mes</th>
                                                <th class="px-4 py-3">Estado</th>
                                                <th class="px-4 py-3 text-right">Plan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                            <tr class="text-gray-700 dark:text-gray-400">
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center space-x-4 text-sm">
                                                        <!-- Botón Eliminar -->
                                                        <button
                                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                            aria-label="Eliminar">
                                                            <i class="fas fa-trash-alt w-5 h-5"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">Servicio de internet</td>
                                                <td class="px-4 py-3 text-sm">1/10/2020</td>
                                                <td class="px-4 py-3 text-sm">Enero</td>
                                                <td class="px-4 py-3 text-xs">
                                                    <span
                                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                        Activo
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 text-sm text-right">$ 50.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Total alineado a la derecha fuera de la tabla -->
                                <div
                                    class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                                    <span
                                        class="col-span-5 sm:col-span-4 sm:col-start-6 flex justify-end text-right text-sm font-semibold text-gray-600 dark:text-gray-400">
                                        Total: $ 50.00
                                    </span>
                                </div>
                            </div>
                        </div>
                    </main>

                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="modificar-modal" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Modificar Contrato</button>
                    <button data-modal-hide="modificar-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
                </div>
        </form>
    </div>
</div>
</div>

<!-- Main modal -->
<div id="cobro-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 py-20 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    @if (!auth()->user()->checkModuloAcceso('payments', 'guardar'))
        <!-- Toast de error -->
        <div id="cobro-modal"
            class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div
                class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">Sin permisos para esta acción.</div>
            <!-- Botón de cierre del toast y modal -->
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-modal-hide="cobro-modal" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @else
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <form>
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Realizar cobro
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="cobro-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <!-- Campo de Datos del Cliente -->
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                    for="client-name">
                                    Datos del Cliente
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <i class="fa fa-user text-gray-500 dark:text-gray-400"></i>
                                    </div>
                                    <input type="text" id="selected-client" value=""
                                        class="bg-white border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        required readonly />
                                    <input type="hidden" id="selected-client-id" name="cliente_id" value="">
                                </div>
                            </div>

                            <!-- Botón de Seleccionar Cliente -->
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                    for="client-name">
                                    Buscar Cliente
                                </label>
                                <button id="toggleDropdown" type="button"
                                    class="inline-flex items-center p-3 text-ellipsis font-outfit text-gray-700 dark:text-white bg-white dark:bg-gray-700 border border-gray-100 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-slate-500 dark:focus:ring-slate-500 rounded w-full">
                                    <span class="flex-1 text-left dark:text-gray-300">Seleccionar</span>
                                    <i class="fas fa-chevron-down text-xs ml-2.5"></i>
                                </button>
                            </div>

                            <!-- Botón de Seleccionar Pago Start -->
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                    for="grid-zip">
                                    Tipo de pago
                                </label>
                                <div class="relative">
                                    <select
                                        class="block appearance-none w-full bg-white dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3.5 px-4 pr-8 text-ellipsis rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                        id="tipo_pago">
                                        <option value="efectivo">Efectivo</option>
                                        <option value="deposito">Depósito</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Botón de Seleccionar Pago End -->
                        </div>

                        <!-- Menú desplegable de clientes -->
                        <div id="dropdown"
                            class="z-10 bg-zinc-50 rounded-lg top-40 shadow-md border md:w-90 dark:bg-gray-700 absolute right-0.5 w-full hidden">
                            <div class="p-3">
                                <label for="input-group-search" class="sr-only">Buscar</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <i class="fas fa-search w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                                    </div>
                                    <input type="text" id="searchInput"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Buscar cliente" />
                                </div>
                            </div>
                            <ul id="clientList"
                                class="divide-y divide-gray-200 dark:divide-gray-700 max-h-60 overflow-y-auto mx-2">
                                @foreach ($clientes as $cliente)
                                    @if($cliente->estado_cliente === 'activo')
                                        <li class="flex items-center p-2 text-sm text-gray-700 dark:text-gray-200 client-item"
                                            data-id="{{ $cliente->id }}" 
                                            data-nombres="{{ $cliente->nombres }}"
                                            data-apellidos="{{ $cliente->apellidos }}"
                                            data-identificacion="{{ $cliente->identificacion }}"
                                            data-telefono="{{ $cliente->telefono }}">
                                            <div class="flex items-center space-x-2">
                                                <input type="radio" name="clienteSeleccionado"
                                                    value="{{ $cliente->id }}"
                                                    class="form-radio h-4 w-4 text-blue-600 focus:ring-blue-500">
                                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100 cursor-pointer">
                                                    {{ $cliente->nombres }} {{ $cliente->apellidos }}
                                                </span>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                            <div
                                class="p-3 border-gray-200 bg-white dark:border-gray-600 dark:bg-gray-700 rounded-b-lg">
                                <a id="clearClient"
                                    class="flex items-center p-2 text-sm font-medium text-red-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-red-500 hover:underline cursor-pointer">
                                    <i class="fas fa-trash-alt text-xs w-4 h-4 me-2"></i>
                                    Borrar cliente
                                </a>
                            </div>
                        </div>

                        <!-- ====== Identificación - Telefono Section Start -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                    for="grid-state">
                                    Identificación
                                </label>
                                <div class="relative">
                                    <input
                                        class="block appearance-none w-full bg-white dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                        id="identificacion" placeholder="" disabled>
                                </div>
                            </div>

                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                    for="grid-city">
                                    Telefono
                                </label>
                                <div class="relative">
                                    <input
                                        class="block appearance-none w-full bg-white dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                        id="telefono" placeholder="" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- ====== Identificación - Telefono Section End -->

                        <!-- ====== Servicio - Boton Section Start -->
                        <div class="flex flex-wrap -mx-3 mb-6">

                            <!-- Campo de Contrato -->
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                    for="grid-city">
                                    Contrato
                                </label>
                                <div class="relative">
                                    <select
                                        class="block appearance-none w-full bg-white dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                        id="contrato">
                                    </select>
                                </div>
                            </div>

                            <!-- Campo de Servicio -->
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                    for="grid-city">
                                    Servicio
                                </label>
                                <div class="relative">
                                    <select
                                        class="block appearance-none w-full bg-white dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800 whitespace-nowrap text-ellipsis overflow-hidden"
                                        id="servicio">
                                    </select>
                                </div>
                            </div>

                            <!-- Campo de Meses -->
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                    for="grid-city">
                                    Meses a pagar
                                </label>
                                <div class="relative">
                                    <select
                                        class="block appearance-none w-full bg-white dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800 whitespace-nowrap text-ellipsis overflow-hidden"
                                        id="mes">
                                    </select>
                                </div>
                            </div>

                            <input class="hidden" type="text" id="precio-plan">

                            <!-- Botón Agregar -->
                            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                                <div class="relative">
                                    <button type="button" id="add-details"
                                        class="block mt-6 w-full bg-green-500 dark:bg-green-600 border border-green-500 dark:border-green-600 text-white dark:text-gray-300 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-green-600 dark:focus:bg-green-700 items-center justify-center">
                                        <i class="fa fa-plus text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- ====== Servicio - Boton Section End -->

                        <div class="w-full mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                                GLOSA
                            </label>
                            <div class="relative flex items-center">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-file-alt text-gray-500 dark:text-gray-400"></i>
                                </div>
                                <input type="text" id="glosa" name="glosa" placeholder="Notas adicionales"
                                    class="bg-white border border-gray-100 text-gray-900 text-sm rounded focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    required />
                            </div>
                        </div>

                        <!-- Alerta -->
                        <div id="modal" x-data="{ showAlert: false }">
                            <!-- Contenido del modal -->
                            <div x-show="showAlert" x-transition:enter="transition transform ease-out duration-500"
                                x-transition:enter-start="translate-x-full opacity-0"
                                x-transition:enter-end="translate-x-0 opacity-100"
                                x-transition:leave="transition transform ease-in duration-500"
                                x-transition:leave-start="opacity-100 translate-x-0"
                                x-transition:leave-end="translate-x-full opacity-0"
                                class="flex w-full border-l-6 border-[#D0915C] bg-[#D0915C] bg-opacity-[15%] px-7 py-4 shadow-md dark:bg-[#051224] dark:bg-opacity-30 md:p-4">
                                <div
                                    class="mr-5 flex h-9 w-9 items-center justify-center rounded-lg bg-[#D0915C] bg-opacity-30">
                                    <i class="fas fa-exclamation-triangle text-[#D0915C]"></i>
                                </div>
                                <div class="w-full">
                                    <p class="text-base dark:text-[#D0915C] pt-1 leading-relaxed text-body">
                                        <span id="alert-message">Por favor, complete todos los campos
                                            requeridos.</span>
                                    </p>
                                </div>
                            </div>
                        </div>

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
                                        <!-- Tabla en el modal -->
                                        <table id="tabla-modal" class="w-full whitespace-no-wrap">
                                            <thead>
                                                <tr
                                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                                    <th class="px-4 py-3">Acción</th>
                                                    <th class="px-4 py-3">Item</th>
                                                    <th class="px-4 py-3">Servicio</th>
                                                    <th class="px-4 py-3">Mes</th>
                                                    <th class="px-4 py-3">Estado</th>
                                                    <th class="px-4 py-3 text-right">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- SubTotal -->
                                    <div
                                        class="flex px-4 py-3 text-xs font-semibold tracking-wide justify-between text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                                        <span
                                            class="col-span-6 text-left text-sm font-semibold text-gray-600 dark:text-gray-400">
                                            TOTAL:
                                        </span>
                                        <span
                                            class="col-span-3 text-right text-sm font-semibold text-gray-600 dark:text-gray-400"
                                            id="total">
                                            S/ 0.00
                                        </span>
                                    </div>

                                    <!-- Pago y Cambio -->
                                    <div
                                        class="flex justify-between space-x-6 md:space-x-32 font-outfit text-base bg-gray-50 border-t border-gray-300 dark:border-gray-700 dark:bg-gray-800 px-4 py-3 text-gray-600 dark:text-gray-400">
                                        <div class="flex-1">
                                            <label class="block mb-2 text-sm font-semibold uppercase">PAGÓ</label>
                                            <input type="number" id="pago"
                                                class="input border border-gray-500 rounded p-3 w-full text-right text-sm dark:bg-gray-700 font-semibold text-gray-600 dark:text-gray-400 focus:border-blue-500 dark:focus:border-blue-400 focus:ring focus:ring-blue-200 dark:focus:ring-blue-800"
                                                placeholder="0.00" />
                                        </div>
                                        <div class="flex-1 flex flex-col items-end">
                                            <label class="block mb-2 text-sm font-semibold uppercase">CAMBIO</label>
                                            <span id="cambio"
                                                class="block border border-gray-500 rounded p-3 w-full text-right bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-sm font-semibold">
                                                0.00
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </main>

                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex justify-between items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" id="btn-guardar-cobro"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Realizar Cobro
                        </button>
                        <button type="button" data-modal-hide="cobro-modal"
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Cancelar
                        </button>
                    </div>
            </form>
        </div>
</div>
@endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        console.log('Script cargado correctamente');

        const elements = {
            toggleDropdownButton: document.getElementById('toggleDropdown'),
            dropdown: document.getElementById('dropdown'),
            searchInput: document.getElementById('searchInput'),
            clientList: document.getElementById('clientList'),
            selectedClientInput: document.getElementById('selected-client'),
            selectedClientIdInput: document.getElementById('selected-client-id'),
            clearClientButton: document.getElementById('clearClient'),
            identificacionInput: document.getElementById('identificacion'),
            telefonoInput: document.getElementById('telefono'),
            contratoSelect: document.getElementById('contrato'),
            servicioSelect: document.getElementById('servicio'),
            mesSelect: document.getElementById('mes'),
            montoTotalInput: document.getElementById('monto-total'),
            precioPlanInput: document.getElementById('precio-plan')
        };

        // Función para agregar detalles a la tabla
        const agregarDetalle = () => {
            const servicioSelect = elements.servicioSelect;
            const mesSelect = elements.mesSelect;
            const precioPlanInput = elements.precioPlanInput;
            const selectedClientInput = elements.selectedClientInput;
            const contratoSelect = elements.contratoSelect;

            // Validar si el cliente no ha sido seleccionado
            if (!selectedClientInput.value) {
                showAlert('Por favor, seleccione un cliente.');
                return;
            }

            // Validar campos
            if (!servicioSelect.value || !mesSelect.value || !precioPlanInput.value) {
                showAlert('Por favor, complete todos los campos requeridos.');
                return;
            }

            // Obtener el servicio - mes y año seleccionados
            const mesText = mesSelect.options[mesSelect.selectedIndex].text;
            const precio = precioPlanInput.value;
            const servicio = servicioSelect.options[servicioSelect.selectedIndex].text;
            const contratoServicioId = servicioSelect.value;
            const mesId = mesSelect.value;

            const existeMesYServicioEnTabla = (mesText, servicio) => {
                const filas = document.querySelectorAll('#tabla-modal tbody tr');
                for (const fila of filas) {
                    const mesEnFila = fila.querySelector('td:nth-child(4)').textContent.trim();
                    const servicioEnFila = fila.querySelector('td:nth-child(3)').textContent.trim();
                    if (mesEnFila === mesText && servicioEnFila === servicio) {
                        return true;
                    }
                }
                return false;
            };

            if (existeMesYServicioEnTabla(mesText, servicio)) {
                showAlert('El mes seleccionado ya ha sido registrado para este servicio en este ticket.');
                return;
            }

            // Si no hay duplicados, agregar la nueva fila
            const tbody = document.querySelector('#tabla-modal tbody');
            const nuevaFila = document.createElement('tr');
            nuevaFila.classList.add('text-gray-700', 'dark:text-gray-400');
            nuevaFila.dataset.contratoServicioId = contratoServicioId;
            nuevaFila.dataset.mesId = mesId;

            nuevaFila.innerHTML = `
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">
                        <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray eliminar-item" aria-label="Eliminar">
                            <i class="fas fa-trash-alt w-5 h-5"></i>
                        </button>
                    </div>
                </td>
                <td class="px-4 py-3 text-sm">${tbody.children.length + 1}</td>
                <td class="px-4 py-3 text-sm whitespace-nowrap">${servicio}</td>
                <td class="px-4 py-3 text-sm whitespace-nowrap">${mesText}</td>
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-2">
                        <select class="block w-auto px-2 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 whitespace-nowrap">
                            <option value="pagado" selected class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-1"></i> Pagado
                            </option>
                            <option value="pendiente" class="flex items-center">
                                <i class="fas fa-clock text-yellow-500 mr-1"></i> Pendiente
                            </option>
                            <option value="no_aplica" class="flex items-center">
                                <i class="fas fa-ban text-gray-500 mr-1"></i> No Aplica
                            </option>
                        </select>
                    </div>
                </td>
                <td class="px-4 py-3 text-sm text-right">${precio}</td>
            `;

            tbody.appendChild(nuevaFila);
            calcularTotal();

            // Limpiar selects y campos
            elements.mesSelect.innerHTML = '<option disabled selected>Seleccionar mes</option>';
            elements.precioPlanInput.value = 'S/ 0.00';

            // Recargar los servicios del contrato actual
            if (contratoSelect.value) {
                loadServicios(contratoSelect.value, elements.selectedClientIdInput.value);
            }
        };
        // Función para calcular el total
        const calcularTotal = () => {
            const filas = document.querySelectorAll('#tabla-modal tbody tr');
            let total = 0;

            filas.forEach(fila => {
                const estadoSelect = fila.querySelector('td:nth-child(5) select');
                const precioCell = fila.querySelector('td:nth-child(6)');
                
                // Guardamos el precio original si aún no está guardado
                if (!precioCell.dataset.precioOriginal) {
                    precioCell.dataset.precioOriginal = precioCell.textContent.replace('S/ ', '');
                }
                
                const precioOriginal = parseFloat(precioCell.dataset.precioOriginal);

                if (estadoSelect.value === 'pagado') {
                    // Si está pagado, mostramos y sumamos el precio original
                    precioCell.textContent = `S/ ${precioOriginal.toFixed(2)}`;
                    if (!isNaN(precioOriginal)) {
                        total += precioOriginal;
                    }
                } else if (estadoSelect.value === 'no_aplica') {
                    // Si es no_aplica, mostramos 0
                    precioCell.textContent = 'S/ 0.00';
                } else {
                    // Si es pendiente o anulado, mostramos el precio pero no sumamos al total
                    precioCell.textContent = `S/ ${precioOriginal.toFixed(2)}`;
                }
            });

            // Mostrar el total
            const totalElement = document.getElementById('total');
            if (totalElement) {
                totalElement.textContent = `S/ ${total.toFixed(2)}`;
            }

            // Actualizar el campo de pago con el total
            const pagoInput = document.getElementById('pago');
            if (pagoInput) {
                pagoInput.value = total.toFixed(2);
            }

            calcularCambio();
        };

        // Función para calcular el cambio
        const calcularCambio = () => {
            const pagoInput = document.getElementById('pago');
            const cambioElement = document.getElementById('cambio');

            if (pagoInput && cambioElement) {
                const total = parseFloat(document.getElementById('total').textContent.replace('S/ ', ''));
                const pago = parseFloat(pagoInput.value);

                if (!isNaN(pago)) {
                    const cambio = pago - total;
                    cambioElement.textContent = cambio.toFixed(2);
                } else {
                    cambioElement.textContent = '0.00';
                }
            }
        };

        // Eliminar un ítem de la tabla
        document.addEventListener('click', (event) => {
            if (event.target.closest('.eliminar-item')) {
                const fila = event.target.closest('tr');
                fila.remove();
                calcularTotal();

                const filas = document.querySelectorAll('#tabla-modal tbody tr');
                filas.forEach((fila, index) => {
                    fila.querySelector('td:nth-child(2)').textContent = index + 1;
                });
            }
        });

        // Botón Agregar
        const agregarButton = document.getElementById('add-details');
        if (agregarButton) {
            agregarButton.addEventListener('click', agregarDetalle);
        }

        // Vincular el campo de pago
        const pagoInput = document.getElementById('pago');
        if (pagoInput) {
            pagoInput.addEventListener('input', (e) => {
                const total = parseFloat(document.getElementById('total').textContent.replace('S/ ',
                    ''));
                const pago = parseFloat(e.target.value);

                if (!isNaN(pago) && pago < total) {
                    e.target.classList.add('border-red-500', 'focus:border-red-500',
                        'focus:ring-red-200');
                    e.target.classList.remove('border-gray-500', 'focus:border-blue-500',
                        'focus:ring-blue-200');
                } else {
                    e.target.classList.remove('border-red-500', 'focus:border-red-500',
                        'focus:ring-red-200');
                    e.target.classList.add('border-gray-500', 'focus:border-blue-500',
                        'focus:ring-blue-200');
                }

                calcularCambio();
            });
        }

        // Event listener para actualizar el precio cuando se cambia el mes
        elements.mesSelect.addEventListener('change', function() {
            const mesId = this.value;
            const precio = preciosMeses[mesId];
            if (precio) {
                elements.precioPlanInput.value = `S/ ${precio}`;
            }
        });

        const toggleDropdown = () => {
            elements.dropdown.classList.toggle('hidden');
            elements.searchInput.value = '';
            resetClientList();
        };

        const handleClickOutside = (event) => {
            if (!elements.dropdown.contains(event.target) && !elements.toggleDropdownButton.contains(event
                    .target)) {
                elements.dropdown.classList.add('hidden');
            }
        };

        const filterClients = () => {
            const query = elements.searchInput.value.toLowerCase();
            Array.from(elements.clientList.getElementsByClassName('client-item')).forEach(item => {
                const nombres = item.dataset.nombres.toLowerCase();
                const apellidos = item.dataset.apellidos.toLowerCase();
                item.style.display = nombres.includes(query) || apellidos.includes(query) ? '' :
                    'none';
            });
        };

        const selectClient = async (target) => {
            const {
                nombres,
                apellidos,
                id: clientId,
                identificacion,
                telefono
            } = target.dataset;
            const radioButton = target.querySelector('input[type="radio"]');
            if (radioButton) radioButton.checked = true;

            elements.selectedClientInput.value = `${nombres} ${apellidos}`;
            elements.selectedClientIdInput.value = clientId;
            elements.identificacionInput.value = identificacion;
            elements.telefonoInput.value = telefono;

            // Cerrar el dropdown después de seleccionar
            elements.dropdown.classList.add('hidden');

            limpiarTablaDetalles();

            elements.contratoSelect.innerHTML =
                '<option disabled selected>Seleccionar contrato</option>';
            elements.servicioSelect.innerHTML =
                '<option disabled selected>Seleccionar servicio</option>';
            elements.mesSelect.innerHTML = '<option disabled selected>Seleccionar mes</option>';

            await loadContratos(clientId);
        };

        const loadContratos = async (clientId) => {
            elements.contratoSelect.innerHTML =
                '';
            try {
                const response = await fetch(`/contratos/${clientId}`);
                const contratos = await response.json();
                if (contratos.length > 0) {
                    contratos.forEach(contrato => {
                        const option = new Option(
                            `CTR-${contrato.id.toString().padStart(6, '0')}`, contrato.id);
                        elements.contratoSelect.add(option);
                    });
                    elements.contratoSelect.value = contratos[0].id;
                    await loadServicios(contratos[0].id, clientId);
                } else {
                    elements.contratoSelect.add(new Option('Sin contratos', '', true, true));
                }
            } catch (error) {
                console.error('Error al obtener contratos:', error);
            }
        };

        const loadServicios = async (contratoId, clientId) => {
            elements.servicioSelect.innerHTML = '';
            try {
                const response = await fetch(`/contratos/${contratoId}/servicios`);
                if (!response.ok) {
                    throw new Error('Error al obtener servicios');
                }
                const servicios = await response.json();
                if (servicios.length > 0) {
                    servicios.forEach(servicio => {
                        const option = new Option(
                            `${servicio.nombre} - ${servicio.plan_nombre}`,
                            servicio.contrato_servicio_id
                        );
                        elements.servicioSelect.add(option);
                    });
                    elements.servicioSelect.value = servicios[0].contrato_servicio_id;
                    await loadMeses(servicios[0].contrato_servicio_id);
                } else {
                    elements.servicioSelect.add(new Option('Sin servicios', '', true, true));
                }
            } catch (error) {
                console.error('Error al obtener servicios:', error);
                elements.servicioSelect.add(new Option('Error al cargar servicios', '', true, true));
            }
        };

        // Objeto para almacenar los precios de cada mes
        const preciosMeses = {};

        const loadMeses = async (contratoServicioId) => {
            elements.mesSelect.innerHTML = '';
            elements.mesSelect.disabled = true;

            try {
                // Mostrar estado de carga
                const loadingOption = new Option('Cargando meses...', '', true, true);
                elements.mesSelect.add(loadingOption);

                const response = await fetch(`/meses-pendientes/${contratoServicioId}`);
                const data = await response.json();

                // Limpiar el select
                elements.mesSelect.innerHTML = '';
                elements.mesSelect.disabled = false;

                if (!data.success) {
                    const errorOption = new Option(data.message || 'Error al cargar meses', '', true,
                        true);
                    elements.mesSelect.add(errorOption);

                    const precioPlanInput = document.getElementById('precio-plan');
                    if (precioPlanInput) {
                        precioPlanInput.value = 'S/ 0.00';
                    }

                    showAlert(data.message || 'Error al obtener meses pendientes', 'error');
                    return;
                }

                // Obtener los meses que ya están en la tabla
                const mesesEnTabla = new Set();
                const filas = document.querySelectorAll('#tabla-modal tbody tr');
                filas.forEach(fila => {
                    const mesText = fila.querySelector('td:nth-child(4)').textContent.trim();
                    const servicioText = fila.querySelector('td:nth-child(3)').textContent
                        .trim();
                    const servicioActual = elements.servicioSelect.options[elements
                        .servicioSelect.selectedIndex]?.text;
                    if (servicioText === servicioActual) {
                        mesesEnTabla.add(mesText);
                    }
                });

                const mesesPendientes = data.meses_pendientes || [];
                const precioPlan = parseFloat(data.precio_plan) || 0;
                const montoProporcional = parseFloat(data.monto_proporcional) || 0;
                const mesInicioServicio = mesesPendientes.length > 0 ? mesesPendientes[0].id : null;

                // Filtrar los meses que no están en la tabla
                const mesesDisponibles = mesesPendientes.filter(mes => {
                    const mesText = `${mes.nombre} ${mes.anio}`;
                    return !mesesEnTabla.has(mesText);
                });

                if (mesesDisponibles.length > 0) {
                    mesesDisponibles.forEach((mes) => {
                        // Primero verificar si es el mes de inicio del servicio
                        let precioMes;
                        if (mes.id === mesInicioServicio && montoProporcional > 0) {
                            precioMes = montoProporcional;
                        } else {
                            // Si no es mes de inicio, usar precio proporcional si está disponible (para mes de suspensión)
                            precioMes = mes.precio_proporcional || mes.monto || precioPlan;
                        }

                        const precioRedondeado = Math.round(precioMes);
                        const precioFormateado = precioRedondeado.toFixed(2);

                        preciosMeses[mes.id] = precioFormateado;

                        const option = new Option(
                            `${mes.nombre} ${mes.anio}`,
                            mes.id
                        );
                        elements.mesSelect.add(option);
                    });

                    // Seleccionar automáticamente el primer mes disponible
                    elements.mesSelect.value = mesesDisponibles[0].id;
                    const precioAMostrar = preciosMeses[mesesDisponibles[0].id];

                    // Actualizar el precio del plan con el primer mes
                    const precioPlanInput = document.getElementById('precio-plan');
                    if (precioPlanInput) {
                        precioPlanInput.value = `S/ ${precioAMostrar}`;
                    }
                } else {
                    // Mostrar mensaje cuando no hay meses
                    const noDataOption = new Option(
                        'No hay meses pendientes para este servicio',
                        '',
                        true,
                        true
                    );
                    elements.mesSelect.add(noDataOption);

                    const precioPlanInput = document.getElementById('precio-plan');
                    if (precioPlanInput) {
                        precioPlanInput.value = 'S/ 0.00';
                    }

                    showAlert('No hay meses pendientes de pago para este servicio', 'info');
                }
            } catch (error) {
                console.error('Error al obtener meses pendientes:', error);

                elements.mesSelect.innerHTML = '';
                const errorOption = new Option('Error al cargar meses', '', true, true);
                elements.mesSelect.add(errorOption);

                const precioPlanInput = document.getElementById('precio-plan');
                if (precioPlanInput) {
                    precioPlanInput.value = 'S/ 0.00';
                }

                showAlert('Ocurrió un error al cargar los meses pendientes', 'error');
            }
        };

        // Función auxiliar para mostrar alertas
        function showAlert(message, type = 'error') {
            const modal = document.getElementById('modal');
            if (modal) {
                const alpineData = Alpine.$data(modal);
                alpineData.showAlert = true;

                const alertMessage = document.getElementById('alert-message');
                if (alertMessage) {
                    alertMessage.textContent = message;

                    // Cambiar color según el tipo
                    const alertBox = modal.querySelector('.border-l-6');
                    if (alertBox) {
                        alertBox.className = alertBox.className.replace(/border-\[.*?\] bg-\[.*?\]/, '');
                        if (type === 'error') {
                            alertBox.classList.add('border-red-500', 'bg-red-100', 'dark:bg-red-800');
                        } else if (type === 'info') {
                            alertBox.classList.add('border-blue-500', 'bg-blue-100', 'dark:bg-blue-800');
                        } else {
                            alertBox.classList.add('border-[#D0915C]', 'bg-[#D0915C]');
                        }
                    }
                }

                setTimeout(() => {
                    alpineData.showAlert = false;
                }, 5500);
            }
        }

        const limpiarTablaDetalles = () => {
            const tbody = document.querySelector('#tabla-modal tbody');
            if (tbody) {
                tbody.innerHTML = '';
            }
            calcularTotal();
        };

        const clearSelection = (event) => {
            event.preventDefault();

            // Limpiar los inputs de texto
            ['selectedClientInput', 'selectedClientIdInput', 'identificacionInput', 'telefonoInput',
                'precioPlanInput'
            ].forEach(id => {
                if (elements[id]) {
                    elements[id].value = '';
                }
            });

            // Restablecer los selects
            elements.contratoSelect.innerHTML = '<option disabled selected>Seleccionar contrato</option>';
            elements.servicioSelect.innerHTML = '<option disabled selected>Seleccionar servicio</option>';
            elements.mesSelect.innerHTML = '<option disabled selected>Seleccionar mes</option>';

            // Deseleccionar los radios
            if (elements.clientList) {
                Array.from(elements.clientList.querySelectorAll('input[type="radio"]')).forEach(radio => {
                    radio.checked = false;
                });
            }

            limpiarTablaDetalles();
        };

        const resetClientList = () => {
            Array.from(elements.clientList.getElementsByClassName('client-item')).forEach(item => {
                item.style.display = '';
            });
        };

        // Event listeners
        elements.toggleDropdownButton.addEventListener('click', toggleDropdown);
        document.addEventListener('click', handleClickOutside);
        elements.searchInput.addEventListener('input', filterClients);
        elements.clientList.addEventListener('click', (event) => {
            const target = event.target.closest('.client-item');
            if (target) selectClient(target);
        });
        elements.contratoSelect.addEventListener('change', async () => {
            if (elements.contratoSelect.value && elements.selectedClientIdInput.value) {
                // Limpiar la tabla de detalles al cambiar de contrato
                limpiarTablaDetalles();
                await loadServicios(elements.contratoSelect.value, elements.selectedClientIdInput
                    .value);
            }
        });
        elements.servicioSelect.addEventListener('change', () => {
            if (elements.contratoSelect.value && elements.servicioSelect.value) {
                loadMeses(elements.servicioSelect.value);
            }
        });
        elements.clearClientButton.addEventListener('click', clearSelection);

        // Función para mostrar alerta de cobro
        const mostrarAlertaCobro = (mensaje, tipo = 'error', callback = null) => {
            const modal = document.createElement('div');
            modal.className = 'relative z-[100]';
            modal.setAttribute('aria-labelledby', 'modal-title');
            modal.setAttribute('role', 'dialog');
            modal.setAttribute('aria-modal', 'true');

            const icono = tipo === 'error' ?
                `<svg class="size-6 text-yellow-600 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>` :
                `<svg class="size-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>`;

            const colorFondo = tipo === 'error' ? 'bg-yellow-100 dark:bg-yellow-900/30' :
                'bg-green-100 dark:bg-green-900/30';
            const colorBoton = tipo === 'error' ?
                'bg-yellow-600 hover:bg-yellow-500 dark:hover:bg-yellow-700' :
                'bg-green-600 hover:bg-green-500 dark:hover:bg-green-700';

            modal.innerHTML = `
                <div class="fixed inset-0 bg-gray-900/75 dark:bg-gray-900/90 transition-opacity" aria-hidden="true"></div>
                <div class="fixed inset-0 z-[100] w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-700 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <div class="bg-white dark:bg-gray-700 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full ${colorFondo} sm:mx-0 sm:size-10">
                                        ${icono}
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-base font-semibold text-gray-900 dark:text-white" id="modal-title">
                                            ${tipo === 'error' ? 'Atención' : 'Éxito'}
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500 dark:text-gray-300">${mensaje}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-600 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="button" id="cerrar-alerta" class="inline-flex w-full justify-center rounded-md ${colorBoton} px-3 py-2 text-sm font-semibold text-white shadow-xs sm:ml-3 sm:w-auto">
                                    Aceptar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);

            // Agregar evento al botón de cerrar
            document.getElementById('cerrar-alerta').addEventListener('click', () => {
                document.body.removeChild(modal);
                if (callback) {
                    callback();
                }
            });
        };

        // Función para guardar el cobro
        const guardarCobro = async () => {
            try {
                const clienteId = document.getElementById('selected-client-id').value;
                const montoTotal = parseFloat(document.getElementById('total').textContent.replace(
                    'S/ ', ''));
                const montoPagoEfectivo = parseFloat(document.getElementById('pago').value);
                const tipoPago = document.getElementById('tipo_pago').value;
                const glosa = document.getElementById('glosa').value;

                // Validar que el monto de pago no sea menor al total
                if (montoPagoEfectivo < montoTotal) {
                    mostrarAlertaCobro('El monto de pago no puede ser menor al total');
                    return;
                }

                // Obtener los detalles de la tabla
                const detalles = [];
                const filas = document.querySelectorAll('#tabla-modal tbody tr');

                if (filas.length === 0) {
                    mostrarAlertaCobro('Debe agregar al menos un servicio para realizar el cobro');
                    return;
                }

                filas.forEach(fila => {
                    const contratoServicioId = fila.dataset.contratoServicioId;
                    const mesId = fila.dataset.mesId;
                    const monto = parseFloat(fila.querySelector('td:nth-child(6)').textContent
                        .replace('S/ ', ''));
                    const estado = fila.querySelector('td:nth-child(5) select').value;

                    if (!contratoServicioId || !mesId) {
                        mostrarAlertaCobro(
                            'Error en los datos del servicio. Por favor, vuelva a seleccionar los servicios.'
                        );
                        return;
                    }

                    detalles.push({
                        contrato_servicio_id: contratoServicioId,
                        mes_id: mesId,
                        monto_pagado: monto,
                        estado_pago: estado
                    });
                });

                const response = await fetch('/payments', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .content
                    },
                    body: JSON.stringify({
                        cliente_id: clienteId,
                        monto_total: montoTotal,
                        monto_pago_efectivo: montoPagoEfectivo,
                        tipo_pago: tipoPago,
                        glosa: glosa,
                        detalles: detalles
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Cerrar el modal de cobro
                    document.getElementById('cobro-modal').classList.add('hidden');

                    // Mostrar mensaje de éxito y recargar la página solo después de aceptar
                    mostrarAlertaCobro(data.message, 'success', () => {
                        window.location.reload();
                    });
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                mostrarAlertaCobro('Error al registrar el cobro: ' + error.message);
            }
        };

        // Agregar evento al botón de guardar
        const botonGuardar = document.getElementById('btn-guardar-cobro');
        if (botonGuardar) {
            botonGuardar.addEventListener('click', guardarCobro);
        }

        let cobranzaIdAnular = null;

        // Modal de confirmación de anulación
        const mostrarModalAnular = (cobranzaId) => {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-[100] overflow-y-auto';
            modal.setAttribute('aria-labelledby', 'modal-title');
            modal.setAttribute('role', 'dialog');
            modal.setAttribute('aria-modal', 'true');
            modal.innerHTML = `
                <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                    <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>
                    <div class="inline-block transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6 sm:align-middle">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Confirmar anulación</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">¿Está seguro que desea anular este pago? Esta acción no se puede deshacer.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="button" id="btn-confirmar-anulacion" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Anular</button>
                            <button type="button" onclick="cerrarModalAnular()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancelar</button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            cobranzaIdAnular = cobranzaId;
        };

        function cerrarModalAnular() {
            const modal = document.querySelector('.fixed.inset-0.z-[100]');
            if (modal) {
                modal.remove();
            }
            cobranzaIdAnular = null;
        }

        // Verificar si el botón existe antes de agregar el event listener
        const btnConfirmarAnulacion = document.getElementById('btn-confirmar-anulacion');
        if (btnConfirmarAnulacion) {
            btnConfirmarAnulacion.addEventListener('click', function() {
                if (!cobranzaIdAnular) return;

                fetch(`/payments/${cobranzaIdAnular}/anular`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .content,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            mostrarAlertaCobro(data.message, 'success');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        } else {
                            mostrarAlertaCobro(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        mostrarAlertaCobro('Error al anular el pago', 'error');
                    })
                    .finally(() => {
                        cerrarModalAnular();
                    });
            });
        }

        // Agregar evento change a los selectores de estado
        document.addEventListener('change', (event) => {
            if (event.target.matches('td:nth-child(5) select')) {
                calcularTotal();
            }
        });
    });
</script>

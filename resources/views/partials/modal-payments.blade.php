<!-- Main modal -->
<div id="cobro-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 py-20 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
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
                                class="inline-flex items-center p-3 text-sm font-outfit text-gray-700 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 focus:ring-2 focus:outline-none focus:ring-slate-500 dark:focus:ring-slate-500 rounded w-full">
                                <span class="flex-1 text-left">Seleccionar</span>
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
                                    class="block appearance-none w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 text-sm dark:text-gray-300 py-3.5 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
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
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Buscar cliente" />
                            </div>
                        </div>
                        <ul id="clientList"
                            class="divide-y divide-gray-200 dark:divide-gray-700 max-h-60 overflow-y-auto mx-2">
                            @foreach ($clientes as $cliente)
                                <li class="flex items-center p-2 text-sm text-gray-700 dark:text-gray-200 client-item"
                                    data-id="{{ $cliente->id }}" data-nombres="{{ $cliente->nombres }}"
                                    data-apellidos="{{ $cliente->apellidos }}"
                                    data-identificacion="{{ $cliente->identificacion }}"
                                    data-telefono="{{ $cliente->telefono }}">
                                    <div class="flex items-center space-x-2">
                                        <input type="radio" name="clienteSeleccionado" value="{{ $cliente->id }}"
                                            class="form-radio h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <span
                                            class="text-sm font-medium text-gray-900 dark:text-gray-100 cursor-pointer">
                                            {{ $cliente->nombres }} {{ $cliente->apellidos }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                        <div class="p-3 border-gray-200 bg-gray-50 dark:border-gray-600 dark:bg-gray-700 rounded-b-lg">
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
                                    class="block appearance-none w-full bg-gray-200 dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
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
                                    class="block appearance-none w-full bg-gray-200 dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
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
                                    class="block appearance-none w-full bg-gray-200 dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
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
                                    class="block appearance-none w-full bg-gray-200 dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
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
                                    class="block appearance-none w-full bg-gray-200 dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
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
                                    <span id="alert-message">Por favor, complete todos los campos requeridos.</span>
                                </p>
                            </div>
                        </div>
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

                                // Validar si el cliente no ha sido seleccionado
                                if (!selectedClientInput.value) {
                                    const modal = document.getElementById('modal');
                                    if (modal) {
                                        const alpineData = Alpine.$data(modal);
                                        alpineData.showAlert = true;

                                        const alertMessage = document.getElementById('alert-message');
                                        if (alertMessage) {
                                            alertMessage.textContent = 'Por favor, seleccione un cliente.';
                                        }

                                        setTimeout(() => {
                                            alpineData.showAlert = false;
                                        }, 5500);
                                    }

                                    return;
                                }

                                // Validar campos
                                if (!servicioSelect.value || !mesSelect.value || !precioPlanInput.value) {
                                    const modal = document.getElementById('modal');
                                    if (modal) {
                                        const alpineData = Alpine.$data(modal);
                                        alpineData.showAlert = true;

                                        const alertMessage = document.getElementById('alert-message');
                                        if (alertMessage) {
                                            if (!servicioSelect.value) {
                                                alertMessage.textContent = 'Por favor, seleccione un servicio.';
                                            } else if (!mesSelect.value) {
                                                alertMessage.textContent = 'Por favor, seleccione un mes.';
                                            } else if (!precioPlanInput.value) {
                                                alertMessage.textContent = 'Por favor, ingrese el precio.';
                                            } else {
                                                alertMessage.textContent =
                                                    'Por favor, complete todos los campos requeridos: servicio, mes y precio.';
                                            }
                                        }

                                        setTimeout(() => {
                                            alpineData.showAlert = false;
                                        }, 5500);
                                    }

                                    return;
                                }

                                // Obtener el servicio - mes y año seleccionados
                                const mesText = mesSelect.options[mesSelect.selectedIndex].text;
                                const precio = precioPlanInput.value;
                                const servicio = servicioSelect.options[servicioSelect.selectedIndex].text;

                                const existeMesYServicioEnTabla = (mesText, servicio) => {
                                    const filas = document.querySelectorAll('#tabla-modal tbody tr');
                                    for (const fila of filas) {
                                        const mesEnFila = fila.querySelector('td:nth-child(5)').textContent.trim();
                                        const servicioEnFila = fila.querySelector('td:nth-child(3)').textContent.trim();
                                        if (mesEnFila === mesText && servicioEnFila === servicio) {
                                            return true;
                                        }
                                    }
                                    return false;
                                };

                                if (existeMesYServicioEnTabla(mesText, servicio)) {
                                    const modal = document.getElementById('modal');
                                    if (modal) {
                                        const alpineData = Alpine.$data(modal);
                                        alpineData.showAlert = true;

                                        const alertMessage = document.getElementById('alert-message');
                                        if (alertMessage) {
                                            alertMessage.textContent =
                                                'El mes seleccionado ya ha sido registrado para este servicio en este ticket.';
                                        }

                                        setTimeout(() => {
                                            alpineData.showAlert = false;
                                        }, 5500);
                                    }

                                    return;
                                }

                                // Si no hay duplicados, agregar la nueva fila
                                const fechaActual = new Date().toLocaleDateString();

                                const tbody = document.querySelector('#tabla-modal tbody');
                                const nuevaFila = document.createElement('tr');
                                nuevaFila.classList.add('text-gray-700', 'dark:text-gray-400');

                                nuevaFila.innerHTML = `
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-4 text-sm">
                                            <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray eliminar-item" aria-label="Eliminar">
                                                <i class="fas fa-trash-alt w-5 h-5"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">${tbody.children.length + 1}</td>
                                    <td class="px-4 py-3">${servicio}</td>
                                    <td class="px-4 py-3 text-sm">${fechaActual}</td>
                                    <td class="px-4 py-3 text-sm">${mesText}</td> <!-- Mes y año -->
                                    <td class="px-4 py-3 text-sm text-right">${precio}</td> <!-- Precio -->
                                `;

                                tbody.appendChild(nuevaFila);
                                calcularTotal();

                                // Limpiar campos
                                elements.servicioSelect.value = '';
                                elements.mesSelect.value = '';
                                elements.precioPlanInput.value = 'S/ 0.00';
                            };
                            // Función para calcular el total
                            const calcularTotal = () => {
                                const filas = document.querySelectorAll('#tabla-modal tbody tr');
                                let total = 0;

                                filas.forEach(fila => {
                                    const precio = parseFloat(fila.querySelector('td:nth-child(6)').textContent.replace(
                                        'S/ ', ''));
                                    total += precio;
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
                                pagoInput.addEventListener('input', calcularCambio);
                            }


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
                                elements.servicioSelect.innerHTML =
                                    '';
                                try {
                                    const response = await fetch(`/contratos/${contratoId}/servicios`);
                                    const servicios = await response.json();
                                    if (servicios.length > 0) {
                                        servicios.forEach(servicio => {
                                            const option = new Option(servicio.nombre, servicio
                                                .contrato_servicio_id);
                                            elements.servicioSelect.add(option);
                                        });
                                        elements.servicioSelect.value = servicios[0].contrato_servicio_id;
                                        await loadMeses(servicios[0].contrato_servicio_id);
                                    } else {
                                        elements.servicioSelect.add(new Option('Sin servicios', '', true, true));
                                    }
                                } catch (error) {
                                    console.error('Error al obtener servicios:', error);
                                }
                            };

                            // Objeto para almacenar los precios de cada mes
                            const preciosMeses = {};

                            const loadMeses = async (contratoServicioId) => {
                                elements.mesSelect.innerHTML = '';
                                try {
                                    const response = await fetch(`/meses-pendientes/${contratoServicioId}`);
                                    const data = await response.json();
                                    const mesesPendientes = data.meses_pendientes;
                                    const precioPlan = parseFloat(data.precio_plan);
                                    const montoProporcional = parseFloat(data.monto_proporcional);

                                    if (mesesPendientes.length > 0) {
                                        mesesPendientes.forEach((mes, index) => {
                                            // Calcular el precio del mes
                                            const precioMes = (index === 0 && montoProporcional > 0) ?
                                                montoProporcional : precioPlan;

                                            const precioRedondeado = Math.round(precioMes);
                                            const precioFormateado = precioRedondeado.toFixed(
                                                2);

                                            // Almacenar el precio en el objeto preciosMeses
                                            preciosMeses[mes.id] = precioFormateado;

                                            // Mostrar solo el mes y el año
                                            const option = new Option(
                                                `${mes.nombre} ${mes.anio}`,
                                                mes.id
                                            );
                                            elements.mesSelect.add(option);
                                        });

                                        // Seleccionar el primer mes por defecto
                                        elements.mesSelect.value = mesesPendientes[0].id;

                                        const precioAMostrar = preciosMeses[mesesPendientes[0].id];
                                        const precioPlanInput = document.getElementById('precio-plan');
                                        if (precioPlanInput) {
                                            precioPlanInput.value = `S/ ${precioAMostrar}`;
                                        }
                                    } else {
                                        elements.mesSelect.add(new Option('No hay meses pendientes de pago', '', true,
                                            true));

                                        const precioPlanInput = document.getElementById('precio-plan');
                                        if (precioPlanInput) {
                                            precioPlanInput.value = 'S/ 0.00';
                                        }
                                    }
                                } catch (error) {
                                    console.error('Error al obtener meses pendientes:', error);
                                }
                            };

                            // Evento change para actualizar el precio cuando se selecciona un mes
                            elements.mesSelect.addEventListener('change', () => {
                                const mesId = elements.mesSelect.value;
                                const precio = preciosMeses[mesId];

                                const precioPlanInput = document.getElementById('precio-plan');
                                if (precioPlanInput) {
                                    precioPlanInput.value = `S/ ${precio}`;
                                }
                            });

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
                        });
                    </script>

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
                                                <th class="px-4 py-3">Fecha</th>
                                                <th class="px-4 py-3">Mes</th>
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
                                            class="block border border-gray-300 rounded p-3 w-full text-right bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-sm font-semibold">
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
                    <button data-modal-hide="cobro-modal" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Realizar Cobro
                    </button>
                    <button data-modal-hide="cobro-modal" type="button"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Cancelar
                    </button>
                </div>

        </form>
    </div>
</div>
</div>

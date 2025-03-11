<!-- Main modal -->
<div id="contrato-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 py-20 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">

        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Registrar Contrato
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="contrato-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="{{ route('contracts.store') }}" method="POST" id="contractForm">
                @csrf
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <!-- Campo de Datos del Cliente -->
                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
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
                                    readonly required />
                                <input type="hidden" id="selected-client-id" name="cliente_id" value="">
                            </div>
                        </div>

                        <!-- Botón de Seleccionar Cliente -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
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

                        <!-- Menú desplegable de clientes -->
                        <div x-data="{
                            clienteSeleccionado: null,
                            clientes: @js($clientes),
                            searchQuery: '',
                            seleccionarCliente(id) {
                                if (this.clienteSeleccionado === id) {
                                    this.clienteSeleccionado = null;
                                } else {
                                    this.clienteSeleccionado = id;
                                }
                            },
                            limpiarCliente() {
                                this.clienteSeleccionado = null;
                            }
                        }">
                            <!-- Dropdown para seleccionar cliente -->
                            <div id="dropdown"
                                class="z-10 bg-zinc-50 rounded-lg shadow-md border w-80 dark:bg-gray-700 absolute right-3 top-44">
                                <div class="p-3">
                                    <label for="input-group-search" class="sr-only">Buscar</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <i class="fas fa-search w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                                        </div>
                                        <input type="text" id="searchInput"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Buscar cliente" x-model="searchQuery" />
                                    </div>
                                </div>
                                <ul id="clientList"
                                    class="divide-y divide-gray-200 dark:divide-gray-700 max-h-60 overflow-y-auto mx-2">
                                    <template x-for="cliente in clientes" :key="cliente.id">
                                        <li class="flex items-center p-2 text-sm text-gray-700 dark:text-gray-200 client-item"
                                            :data-id="cliente.id" :data-nombres="cliente.nombres"
                                            :data-apellidos="cliente.apellidos">
                                            <div class="flex items-center space-x-2">
                                                <input type="radio" :value="cliente.id"
                                                    x-model="clienteSeleccionado"
                                                    @change="seleccionarCliente(cliente.id)"
                                                    class="form-radio h-4 w-4 text-blue-600 focus:ring-blue-500">
                                                <span
                                                    class="text-sm font-medium text-gray-900 dark:text-gray-100 cursor-pointer"
                                                    x-text="`${cliente.nombres} ${cliente.apellidos}`">
                                                </span>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                                <div
                                    class="p-3 border-gray-200 bg-gray-50 dark:border-gray-600 dark:bg-gray-700 rounded-b-lg">
                                    <a id="clearClient" @click="limpiarCliente"
                                        class="flex items-center p-2 text-sm font-medium text-red-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-red-500 hover:underline cursor-pointer">
                                        <i class="fas fa-trash-alt text-xs w-4 h-4 me-2"></i>
                                        Borrar cliente
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ====== Categoría - Servicio - Plan Section Start -->
                    <div x-data="{
                        detalles: [],
                        total: 0,
                        categoriaId: '',
                        servicioId: '',
                        planId: '',
                        precioPlan: '',
                        fecha: '',
                        estadoContrato: 'activo',
                        categorias: @js($categorias),
                        serviciosDisponibles: [],
                        planesDisponibles: [],
                    
                        fetchServicios() {
                            const categoriaSeleccionada = this.categorias.find(c => c.id == this.categoriaId);
                            if (categoriaSeleccionada) {
                                this.serviciosDisponibles = categoriaSeleccionada.servicios.filter(servicio => servicio.estado_servicio === 'activo');
                            } else {
                                this.serviciosDisponibles = [];
                            }
                            this.servicioId = '';
                            this.planesDisponibles = [];
                            this.precioPlan = '';
                        },
                    
                        fetchPlanes() {
                            const servicioSeleccionado = this.serviciosDisponibles.find(s => s.id == this.servicioId);
                            this.planesDisponibles = servicioSeleccionado ? servicioSeleccionado.planes : [];
                            this.planId = '';
                            this.precioPlan = '';
                        },
                    
                        actualizarPrecio() {
                            const planSeleccionado = this.planesDisponibles.find(p => p.id == this.planId);
                            this.precioPlan = planSeleccionado ? planSeleccionado.precio : '';
                        },
                    
                        agregarDetalle() {
                            if (!this.validarCampos()) return;
                    
                            const categoria = this.categorias.find(c => c.id == this.categoriaId);
                            const servicio = this.serviciosDisponibles.find(s => s.id == this.servicioId);
                            const plan = this.planesDisponibles.find(p => p.id == this.planId);
                    
                            if (categoria && servicio && plan) {
                                const nuevoDetalle = {
                                    id: Date.now(),
                                    categoriaId: categoria.id,
                                    categoria: categoria.nombre,
                                    servicioId: servicio.id,
                                    servicio: servicio.nombre,
                                    planId: plan.id,
                                    plan: plan.nombre,
                                    estado: this.estadoContrato,
                                    precio: this.precioPlan
                                };
                    
                                this.detalles.push(nuevoDetalle);
                                console.log('Detalles actualizados:', this.detalles);
                    
                                this.actualizarTotal();
                                this.reset();
                            }
                        },
                    
                        validarCampos() {
                            if (!this.categoriaId) {
                                this.mostrarAlerta('Seleccione una categoría.');
                                return false;
                            }
                            if (!this.servicioId) {
                                this.mostrarAlerta('Seleccione un servicio.');
                                return false;
                            }
                            if (!this.planId) {
                                this.mostrarAlerta('Seleccione un plan.');
                                return false;
                            }
                            if (!this.precioPlan) {
                                this.mostrarAlerta('Por favor, ingrese el precio.');
                                return false;
                            }
                            return true;
                        },
                    
                        mostrarAlerta(mensaje) {
                            const modal = document.getElementById('modal');
                            if (modal) {
                                const alpineData = Alpine.$data(modal);
                                alpineData.showAlert = true;
                    
                                const alertMessage = document.getElementById('alert-message');
                                if (alertMessage) {
                                    alertMessage.textContent = mensaje;
                                }
                    
                                setTimeout(() => {
                                    alpineData.showAlert = false;
                                }, 2500);
                            }
                        },
                    
                        actualizarTotal() {
                            this.total = this.detalles.reduce((sum, detalle) => sum + parseFloat(detalle.precio || 0), 0);
                        },
                    
                        reset() {
                            this.categoriaId = '';
                            this.servicioId = '';
                            this.planId = '';
                            this.precioPlan = '';
                            this.serviciosDisponibles = [];
                            this.planesDisponibles = [];
                        },
                    
                        eliminarDetalle(id) {
                            this.detalles = this.detalles.filter(detalle => detalle.id !== id);
                            this.actualizarTotal();
                        }
                    }">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <!-- Categoría -->
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Categoría</label>
                                <div class="relative">
                                    <select x-model="categoriaId" @change="fetchServicios()"
                                        class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                                        <option value="">Seleccionar</option>
                                        <template x-for="categoria in categorias" :key="categoria.id">
                                            <option :value="categoria.id" x-text="categoria.nombre"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>

                            <!-- Servicio -->
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Servicio</label>
                                <div class="relative">
                                    <select x-model="servicioId" @change="fetchPlanes()"
                                        class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                                        <option value="">Seleccionar</option>
                                        <template x-for="servicio in serviciosDisponibles" :key="servicio.id">
                                            <option :value="servicio.id" x-text="servicio.nombre"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>

                            <!-- Plan -->
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Plan</label>
                                <div class="relative">
                                    <select x-model="planId" @change="actualizarPrecio()"
                                        class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                                        <option value="">Seleccionar</option>
                                        <template x-for="plan in planesDisponibles" :key="plan.id">
                                            <option :value="plan.id" x-text="plan.nombre"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- ====== Estado - Fecha - Precio Section Start -->
                        <div class="flex flex-wrap -mx-3 mb-4">
                            <!-- Precio Input -->
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Precio</label>
                                <div class="relative">
                                    <input x-model="precioPlan"
                                        class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-2 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                        placeholder="0.00" disabled>
                                </div>
                            </div>

                            <!-- Campo de Fecha -->
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Fecha</label>
                                <input type="date" name="fecha" x-model="fecha"
                                    class="appearance-none block w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 
                                border border-gray-200 dark:border-gray-600 rounded py-3 px-4 leading-tight 
                                focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                    required>
                            </div>

                            <!-- Campo de Estado -->
                            <div class="w-full md:w-1/3 px-3 mb-2 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                                    Estado
                                </label>
                                <div class="relative">
                                    <select x-model="estadoContrato"
                                        class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800 cursor-not-allowed"
                                        disabled>
                                        <option value="activo">Activo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- ====== Estado - Fecha - Precio Section End -->

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <!-- Campo de Datos del Cliente -->
                            <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                    for="client-name">
                                    Observaciones
                                </label>
                                <div class="relative flex items-center">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <i class="fa fa-user text-gray-500 dark:text-gray-400"></i>
                                    </div>
                                    <input type="text" id="observaciones" value=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        readonly required />
                                    <input type="hidden" id="observaciones" name="observacioens" value="">
                                </div>
                            </div>

                            <!-- Botón Agregar -->
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 flex items-end">
                                <button type="button" @click="agregarDetalle"
                                    class="w-full bg-slate-500 dark:bg-slate-900 border border-slate-500 dark:border-slate-700 text-white dark:text-gray-300 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-slate-600 dark:focus:bg-slate-800 flex items-center justify-center">
                                    <i class="fa fa-plus text-sm"></i>
                                </button>
                            </div>
                        </div>


                        <!-- Alerta Cliente -->
                        <div id="alert-cliente" x-data="{ showAlert: false }">
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
                                        <span id="alert-cliente-message">Por favor, complete todos los campos
                                            requeridos.</span>
                                    </p>
                                </div>
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
                                <div class="flex justify-start items-center mb-2">
                                    <!-- Título -->
                                    <h4 class="text-lg mt-4 font-semibold text-gray-600 dark:text-gray-300">
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
                                                    <th class="px-4 py-3 hidden">Categoria</th>
                                                    <th class="px-4 py-3">Servicio</th>
                                                    <th class="px-4 py-3">Plan</th>
                                                    <th class="px-4 py-3 text-right">Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                                <template x-for="detalle in detalles" :key="detalle.id">
                                                    <tr class="text-gray-700 dark:text-gray-400">
                                                        <td class="px-4 py-3">
                                                            <button type="button"
                                                                @click="eliminarDetalle(detalle.id)"
                                                                class="text-red-500">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>

                                                        <!-- Solo los ID -->
                                                        <input type="hidden" name="categoria_id[]"
                                                            x-model="detalle.categoriaId">
                                                        <input type="hidden" name="servicio_id[]"
                                                            x-model="detalle.servicioId">
                                                        <input type="hidden" name="plan_id[]"
                                                            x-model="detalle.planId">
                                                        <input type="hidden" name="estado"
                                                            x-model="estadoContrato">
                                                        <input type="hidden" name="precio[]"
                                                            x-model="detalle.precio">

                                                        <!-- No necesitas los campos de texto -->
                                                        <td class="px-4 py-3 hidden" x-text="detalle.id"></td>
                                                        <td class="px-4 py-3 hidden" x-text="detalle.categoria"></td>
                                                        <td class="px-4 py-3" x-text="detalle.servicio"></td>
                                                        <td class="px-4 py-3" x-text="detalle.plan"></td>
                                                        <td class="px-4 py-3 text-right" x-text="detalle.precio"></td>
                                                    </tr>
                                                </template>
                                            </tbody>

                                        </table>
                                    </div>
                                    <div
                                        class="grid px-4 py-3 text-xs font-semibold tracking-wide rounded-b text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                                        <span
                                            class="col-span-5 sm:col-span-4 sm:col-start-6 flex justify-end text-right text-sm font-semibold text-gray-600 dark:text-gray-400">
                                            Total: $ <span x-text="total"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrar
                        Contrato</button>
                    <button data-modal-hide="contrato-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('contractForm').addEventListener('submit', function(e) {
        const clienteInput = document.getElementById('selected-client');
        if (!clienteInput.value.trim()) {
            e.preventDefault();

            const alertCliente = document.getElementById('alert-cliente');
            const alertMessage = document.getElementById('alert-cliente-message');

            if (alertCliente && alertMessage) {
                alertMessage.textContent = 'Por favor, seleccione un cliente.';

                const alpineData = Alpine.$data(alertCliente);
                alpineData.showAlert = true;

                setTimeout(() => {
                    alpineData.showAlert = false;
                }, 2500);
            }
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleDropdownButton = document.getElementById('toggleDropdown');
        const dropdown = document.getElementById('dropdown');
        const searchInput = document.getElementById('searchInput');
        const clientList = document.getElementById('clientList');
        const selectedClientInput = document.getElementById('selected-client');
        const selectedClientIdInput = document.getElementById('selected-client-id');
        const clearClientButton = document.getElementById('clearClient');

        // Mostrar/ocultar el menú desplegable
        toggleDropdownButton.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
            searchInput.value = '';
            resetClientList();
        });

        document.addEventListener('click', (event) => {
            if (!dropdown.contains(event.target) && !toggleDropdownButton.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Filtrar clientes en tiempo real
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.toLowerCase();
            const items = clientList.getElementsByClassName('client-item');
            Array.from(items).forEach(item => {
                const nombres = item.dataset.nombres.toLowerCase();
                const apellidos = item.dataset.apellidos.toLowerCase();
                const isVisible = nombres.includes(query) || apellidos.includes(query);
                item.style.display = isVisible ? '' : 'none';
            });
        });

        clientList.addEventListener('click', (event) => {
            const target = event.target.closest('.client-item');
            if (target) {
                const nombres = target.dataset.nombres;
                const apellidos = target.dataset.apellidos;
                const clientId = target.dataset.id;

                const radioButton = target.querySelector('input[type="radio"]');
                if (radioButton) {
                    radioButton.checked = true;
                }

                selectedClientInput.value = `${nombres} ${apellidos}`;
                selectedClientIdInput.value = clientId;
            }
        });

        clearClientButton.addEventListener('click', (event) => {
            event.preventDefault();

            selectedClientInput.value = '';
            selectedClientIdInput.value = '';

            const radioButtons = clientList.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(radio => {
                radio.checked = false;
            });
        });

        // Restablecer la lista de clientes
        function resetClientList() {
            const items = clientList.getElementsByClassName('client-item');
            Array.from(items).forEach(item => {
                item.style.display = '';
            });
        }
    });
</script>

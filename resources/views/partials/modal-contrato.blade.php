<!-- Main modal -->
<div id="contrato-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 py-20 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    @if (!auth()->user()->checkModuloAcceso('contracts', 'guardar'))
        <!-- Toast de error -->
        <div id="contrato-modal"
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
                data-modal-hide="contrato-modal" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @else
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
                            <div class="w-full md:w-1/3 px-3 mb-0 md:mb-0">
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
                            mostrarModalIp: false,
                            ip: '',
                            observaciones: '',
                        
                            validarIP(event) {
                                this.ip = event.target.value.replace(/[^0-9.]/g, '');
                            },
                        
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
                        
                            verificarServicio() {
                                const servicioSeleccionado = this.serviciosDisponibles.find(s => s.id == this.servicioId);
                                if (servicioSeleccionado && servicioSeleccionado.nombre.toLowerCase() === 'internet') {
                                    this.mostrarModalIp = true;
                                }
                            },
                        
                            agregarDetalle() {
                                if (!this.validarCampos()) return;
                        
                                const categoria = this.categorias.find(c => c.id == this.categoriaId);
                                const servicio = this.serviciosDisponibles.find(s => s.id == this.servicioId);
                                const plan = this.planesDisponibles.find(p => p.id == this.planId);
                        
                                if (categoria && servicio && plan) {
                                    // Verificar si ya existe el mismo servicio y plan
                                    const existeDuplicado = this.detalles.some(detalle => 
                                        detalle.servicioId === servicio.id && detalle.planId === plan.id
                                    );

                                    if (existeDuplicado) {
                                        this.mostrarAlerta('Duplicado: servicio y plan ya agregados.');
                                        return;
                                    }

                                    const nuevoDetalle = {
                                        id: Date.now(),
                                        categoriaId: categoria.id,
                                        categoria: categoria.nombre,
                                        servicioId: servicio.id,
                                        servicio: servicio.nombre,
                                        planId: plan.id,
                                        plan: plan.nombre,
                                        estado: this.estadoContrato,
                                        precio: this.precioPlan,
                                        ip: this.ip
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
                                this.ip = '';
                            },
                        
                            eliminarDetalle(id) {
                                this.detalles = this.detalles.filter(detalle => detalle.id !== id);
                                this.actualizarTotal();
                            }
                        }">

                            <!-- ====== Categoría - Servicio - Plan Section Start -->
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
                                        <select x-model="servicioId" @change="fetchPlanes(); verificarServicio()"
                                            class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                                            <option value="">Seleccionar</option>
                                            <template x-for="servicio in serviciosDisponibles" :key="servicio.id">
                                                <option :value="servicio.id" x-text="servicio.nombre"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>

                                <!-- Modal de IP -->
                                <div x-show="mostrarModalIp"
                                    class="fixed z-50 inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                                    <div
                                        class="bg-zinc-50 rounded-lg shadow-md border dark:border-gray-600 w-80 dark:bg-gray-700">
                                        <div class="p-3 border-b border-gray-200 dark:border-gray-600">
                                            <h2 class="text-base font-semibold text-gray-800 dark:text-gray-200">Dirección
                                                IP</h2>
                                            <button type="button" @click="mostrarModalIp = false"
                                                class="absolute top-2 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                                <i class="fas fa-times text-lg"></i>
                                            </button>
                                        </div>
                                        <div class="p-2">
                                            <label for="ipInput" class="sr-only">Dirección IP</label>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <i
                                                        class="fas fa-network-wired w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                                                </div>
                                                <input type="text" id="ipInput" x-model="ip"
                                                    placeholder="192.168.1.1" pattern="[0-9.]*"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    @input="validarIP($event)" />
                                            </div>
                                        </div>
                                        <div
                                            class="p-2 border-t border-gray-200 bg-gray-50 dark:border-gray-600 dark:bg-gray-700 rounded-b-lg">
                                            <div class="flex justify-end space-x-2">
                                                <button type="button" @click="mostrarModalIp = false"
                                                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                                    Aceptar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Plan -->
                                <div class="w-full md:w-1/3 px-3 mb-0 md:mb-0">
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
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <span class="text-gray-500 dark:text-gray-400">S/</span>
                                        </div>
                                        <input x-model="precioPlan"
                                            class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 pl-8 pr-2 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
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
                                        <select name="estado" x-model="estadoContrato"
                                            class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800 cursor-not-allowed"
                                            disabled>
                                            <option value="activo">Activo</option>
                                        </select>
                                        <input type="hidden" name="estado" x-model="estadoContrato" value="activo">
                                    </div>
                                </div>
                            </div>

                            <!-- ====== Observaciones y Botón Agregar Section Start -->
                            <div class="flex flex-wrap -mx-3 mb-4">
                                <!-- Campo observaciones -->
                                <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                                        Observaciones
                                    </label>
                                    <div class="relative flex items-center">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <i class="fas fa-file-alt text-gray-500 dark:text-gray-400"></i>
                                        </div>
                                        <input type="text" name="observaciones" x-model="observaciones"
                                            placeholder="Ingrese observaciones"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                            required />
                                    </div>
                                </div>

                                <!-- Botón Agregar -->
                                <div class="w-full md:w-1/3 px-3 md:mb-0 flex items-end">
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

                            <!-- Alerta Datos-->
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

                            <!-- ====== Tabla de Detalles Section Start -->
                            <main class="h-full overflow-y-auto">
                                <div class="mt-4">
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
                                                        <th class="px-4 py-3 whitespace-nowrap">Dirección IP</th>
                                                        <th class="px-4 py-3">Estado</th>
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
                                                            <!-- Campos ocultos para enviar los datos al controlador -->
                                                            <input type="hidden" name="categoria_id[]"
                                                                x-model="detalle.categoriaId">
                                                            <input type="hidden" name="servicio_id[]"
                                                                x-model="detalle.servicioId">
                                                            <input type="hidden" name="plan_id[]"
                                                                x-model="detalle.planId">
                                                            <input type="hidden" name="ip_servicio[]"
                                                                x-model="detalle.ip">
                                                            <input type="hidden" name="precio[]"
                                                                x-model="detalle.precio">
                                                            <!-- Campos visibles -->
                                                            <td class="px-4 py-3 hidden" x-text="detalle.categoria"></td>
                                                            <td class="px-4 py-3" x-text="detalle.servicio"></td>
                                                            <td class="px-4 py-3" x-text="detalle.plan"></td>
                                                            <td class="px-4 py-3" x-text="detalle.ip"></td>
                                                            <td class="px-4 py-3 text-xs">
                                                                <button type="button"
                                                                    class="px-2 py-1 font-semibold leading-tight rounded-full flex items-center gap-1 whitespace-nowrap text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>Activo</span>
                                                                </button>
                                                            </td>
                                                            <td class="px-4 py-3 text-right">S/ <span x-text="Number(detalle.precio).toFixed(2)"></span></td>
                                                        </tr>
                                                    </template>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div
                                            class="grid px-4 py-3 text-xs font-semibold tracking-wide rounded-b text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                                            <span
                                                class="col-span-5 sm:col-span-4 sm:col-start-6 flex justify-end text-right text-sm font-semibold text-gray-600 dark:text-gray-400">
                                                Total: S/  <span x-text="Number(total).toFixed(2)"></span>
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
                        dropdown.classList.add('hidden');
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
    @endif
</div>

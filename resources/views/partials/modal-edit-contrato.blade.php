<div id="modificar-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 py-20 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <form id="editContractForm" action="{{ route('contracts.update', ['id' => '__ID__']) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="contrato_id" id="contrato-id">
            <input type="hidden" name="cliente_id" id="cliente-id">
            <input type="hidden" name="detalles_json" id="detalles-json">

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
                <div class="p-4 md:p-5 space-y-4" x-data="contratoEditor()" x-init="init()">
                    <!-- Datos del Cliente -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                                Datos del Cliente
                            </label>
                            <input type="text" id="modal-input-cliente"
                                class="bg-gray-100 border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                readonly disabled>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                                Identificación
                            </label>
                            <input type="text" id="client-identification"
                                class="bg-gray-100 border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                readonly disabled>
                        </div>
                    </div>

                    <!-- Selectores de Servicio -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <!-- Categoría -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Categoría</label>
                            <select x-model="categoriaId" @change="cargarServicios()"
                                class="block appearance-none w-full bg-gray-100 dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-900 dark:text-gray-300 text-sm py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                                <option value="">Seleccionar</option>
                                <template x-for="categoria in categorias" :key="categoria.id">
                                    <option :value="categoria.id" x-text="categoria.nombre"></option>
                                </template>
                            </select>
                        </div>

                        <!-- Servicio -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Servicio</label>
                            <select x-model="servicioId" @change="cargarPlanes(); verificarServicio()"
                                class="block appearance-none w-full bg-gray-100 dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-900 dark:text-gray-300 text-sm py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                                <option value="">Seleccionar</option>
                                <template x-for="servicio in servicios" :key="servicio.id">
                                    <option :value="servicio.id" x-text="servicio.nombre"></option>
                                </template>
                            </select>
                        </div>

                        <!-- Plan -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Plan</label>
                            <select x-model="planId" @change="actualizarPrecio()"
                                class="block appearance-none w-full bg-gray-100 dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-900 dark:text-gray-300 text-sm py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                                <option value="">Seleccionar</option>
                                <template x-for="plan in planes" :key="plan.id">
                                    <option :value="plan.id" x-text="plan.nombre"></option>
                                </template>
                            </select>
                        </div>
                    </div>

                    <!-- Modal de IP -->
                    <div x-show="mostrarModalIp"
                        class="fixed z-50 inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                        <div class="bg-zinc-50 rounded-lg shadow-md border dark:border-gray-600 w-80 dark:bg-gray-700">
                            <div class="p-3 border-b border-gray-200 dark:border-gray-600">
                                <h2 class="text-base font-semibold text-gray-800 dark:text-gray-200">Dirección IP</h2>
                                <button type="button" @click="mostrarModalIp = false"
                                    class="absolute top-2 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                    <i class="fas fa-times text-lg"></i>
                                </button>
                            </div>
                            <div class="p-2">
                                <label for="ipInput" class="sr-only">Dirección IP</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <i class="fas fa-network-wired w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                                    </div>
                                    <input type="text" id="ipInput" x-model="ip" placeholder="192.168.1.1"
                                        pattern="[0-9.]*"
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

                    <!-- Información del Contrato -->
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <!-- Precio -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Precio</label>
                            <input x-model="precio"
                                class="block appearance-none w-full bg-gray-100 border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 py-3 px-4 pr-2 leading-tight focus:outline-none focus:bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:bg-gray-800"
                                disabled>
                        </div>

                        <!-- Fecha -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Fecha</label>
                            <input type="date" name="fecha" x-model="fecha"
                                class="appearance-none block w-full bg-gray-100 border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 py-3 px-4 leading-tight focus:outline-none focus:bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:bg-gray-800"
                                required>
                        </div>

                        <!-- Estado -->
                        <div class="w-full md:w-1/3 px-3 mb-2 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Estado</label>
                            <select name="estado" x-model="estado"
                                class="block appearance-none w-full bg-gray-100 border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:bg-gray-800"
                                required>
                                <option value="activo">Activo</option>
                                <option value="suspendido">Suspendido</option>
                            </select>
                        </div>
                    </div>

                    <!-- Observaciones y Botón -->
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Observaciones</label>
                            <input type="text" name="observaciones" x-model="observaciones"
                                class="bg-gray-100 border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Ingrese observaciones">
                        </div>
                        <div class="w-full md:w-1/3 px-3 md:mb-0 flex items-end">
                            <button type="button" @click="agregarServicio"
                                class="w-full bg-slate-500 dark:bg-slate-900 border border-slate-500 dark:border-slate-700 text-white dark:text-gray-300 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-slate-600 dark:focus:bg-slate-800 flex items-center justify-center">
                                <i class="fa fa-plus text-sm mr-2"></i> Agregar
                            </button>
                        </div>
                    </div>

                    <!-- Alerta Datos-->
                    <div id="modal-edit-alert" x-data="{ showAlert: false }">
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
                                    <span id="alert-edit-message">Por favor, complete todos los campos
                                        requeridos.</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de Detalles -->
                    <div class="mb-4">
                        <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300 mb-4">Detalles</h4>
                        <div class="w-full overflow-hidden rounded-lg shadow-xs">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full whitespace-no-wrap">
                                    <thead>
                                        <tr
                                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3 w-16">Acción</th>
                                            <th class="px-4 py-3">Servicio</th>
                                            <th class="px-4 py-3">Plan</th>
                                            <th class="px-4 py-3 w-40">IP</th>
                                            <th class="px-4 py-3">Estado</th>
                                            <th class="px-4 py-3 text-right w-28">Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        <template x-for="(detalle, index) in detalles" :key="index">
                                            <tr class="text-gray-700 dark:text-gray-400"
                                                :class="{ 'opacity-50 line-through': detalle.paraEliminar }">
                                                <td class="px-4 py-3">
                                                    <button @click="eliminarDetalle(index, $event)"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                <td class="px-4 py-3 text-sm" x-text="detalle.servicio_nombre"></td>
                                                <td class="px-4 py-3 text-sm" x-text="detalle.plan_nombre"></td>
                                                <td class="px-4 py-3">
                                                    <input type="text" x-model="detalle.ip"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </td>
                                                <td class="px-4 py-3 text-xs">
                                                    <button type="button"
                                                        @click="detalle.estado = detalle.estado === 'activo' ? 'suspendido' : 'activo'"
                                                        class="px-2 py-1 font-semibold leading-tight rounded-full"
                                                        :class="detalle.estado === 'activo' ?
                                                            'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' :
                                                            'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100'">
                                                        <span
                                                            x-text="detalle.estado.charAt(0).toUpperCase() + detalle.estado.slice(1)"></span>
                                                    </button>
                                                </td>
                                                <td class="px-4 py-3 text-sm text-right">
                                                    S/ <span x-text="parseFloat(detalle.precio).toFixed(2)"></span>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                                <span
                                    class="col-span-5 sm:col-span-4 sm:col-start-6 flex justify-end text-right text-sm font-semibold text-gray-600 dark:text-gray-400">
                                    Total: S/ <span x-text="total.toFixed(2)"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Guardar Cambios
                    </button>
                    <button type="button" data-modal-hide="modificar-modal"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Cancelar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('contratoEditor', () => ({
            categorias: @json($categorias),
            servicios: [],
            planes: [],
            detalles: [],
            serviciosAEliminar: [],
            categoriaId: '',
            servicioId: '',
            planId: '',
            precio: '0.00',
            fecha: '',
            estado: 'activo',
            observaciones: '',
            total: 0,
            mostrarModalIp: false,
            ip: '',

            init() {
                // Configurar fecha por defecto
                this.fecha = new Date().toISOString().split('T')[0];

                // Escuchar eventos para abrir el modal
                document.querySelectorAll('.open-modal-edit').forEach(button => {
                    button.addEventListener('click', () => {
                        const contratoId = button.getAttribute('data-id');
                        const clienteNombre = button.getAttribute('data-cliente');
                        const clienteIdentificacion = button.getAttribute(
                            'data-identificacion');
                        const clienteId = button.getAttribute('data-cliente-id');
                        const detalles = JSON.parse(button.getAttribute(
                            'data-detalles'));

                        // Actualizar formulario
                        document.getElementById('contrato-id').value = contratoId;
                        document.getElementById('cliente-id').value = clienteId;
                        document.getElementById('modal-input-cliente').value =
                            clienteNombre;
                        document.getElementById('client-identification').value =
                            clienteIdentificacion;

                        // Actualizar datos del contrato
                        this.fecha = button.getAttribute('data-fecha') || this
                        .fecha;
                        this.estado = button.getAttribute('data-estado') ||
                        'activo';
                        this.observaciones = button.getAttribute(
                            'data-observaciones') || '';

                        // Cargar detalles existentes
                        this.detalles = detalles.map(detalle => ({
                            id: detalle.id,
                            categoria_id: detalle.categoria_id,
                            servicio_id: detalle.servicio_id,
                            servicio_nombre: detalle.nombre,
                            plan_id: detalle.plan_id,
                            plan_nombre: detalle.plan,
                            precio: detalle.precio,
                            ip: detalle.ip_servicio || '',
                            estado: detalle.estado || 'activo'
                        }));

                        this.calcularTotal();

                        // Actualizar acción del formulario
                        const form = document.getElementById('editContractForm');
                        form.action = form.action.replace('__ID__', contratoId);
                    });
                });
            },

            cargarServicios() {
                const categoria = this.categorias.find(c => c.id == this.categoriaId);
                this.servicios = categoria ? categoria.servicios.filter(s => s.estado_servicio ===
                    'activo') : [];
                this.servicioId = '';
                this.planes = [];
                this.planId = '';
                this.precio = '0.00';
            },

            cargarPlanes() {
                const servicio = this.servicios.find(s => s.id == this.servicioId);
                this.planes = servicio ? servicio.planes : [];
                this.planId = '';
                this.precio = '0.00';
            },

            verificarServicio() {
                const servicio = this.servicios.find(s => s.id == this.servicioId);
                if (servicio && servicio.nombre.toLowerCase() === 'internet') {
                    this.mostrarModalIp = true;
                }
            },

            validarIP(event) {
                this.ip = event.target.value.replace(/[^0-9.]/g, '');
            },

            actualizarPrecio() {
                const plan = this.planes.find(p => p.id == this.planId);
                this.precio = plan ? plan.precio : '0.00';
            },

            agregarServicio() {
                if (!this.validarCampos()) return;

                const categoria = this.categorias.find(c => c.id == this.categoriaId);
                const servicio = this.servicios.find(s => s.id == this.servicioId);
                const plan = this.planes.find(p => p.id == this.planId);

                // Verificar si el servicio ya existe y está activo
                const servicioExistente = this.detalles.find(d =>
                    d.servicio_id == this.servicioId &&
                    d.plan_id == this.planId &&
                    d.estado === 'activo'
                );

                // Si el servicio existe y está activo, no permitir agregarlo
                if (servicioExistente) {
                    this.mostrarAlerta('Este servicio ya está agregado y activo');
                    return;
                }

                // Crear el nuevo detalle con todos los campos necesarios
                const nuevoDetalle = {
                    categoria_id: this.categoriaId,
                    servicio_id: this.servicioId,
                    servicio_nombre: servicio.nombre,
                    plan_id: this.planId,
                    plan_nombre: plan.nombre,
                    precio: this.precio || '0.00',
                    ip: this.ip || '',
                    estado: 'activo' // Siempre se agrega como activo
                };

                // Agregar el nuevo detalle
                this.detalles.push(nuevoDetalle);

                // Actualizar el total
                this.calcularTotal();

                // Limpiar la selección
                this.limpiarSeleccion();

                // Actualizar el JSON de detalles
                this.prepararEnvio();
            },

            eliminarDetalle(index, event) {
                if (event) {
                    event.preventDefault(); // Prevenir cualquier comportamiento por defecto
                    event.stopPropagation(); // Detener la propagación del evento
                }

                const detalle = this.detalles[index];
                if (detalle.id) {
                    // Marcar el servicio para eliminación
                    detalle.paraEliminar = !detalle.paraEliminar; // Alternar estado

                    // Actualizar la lista de servicios a eliminar
                    if (detalle.paraEliminar) {
                        if (!this.serviciosAEliminar.includes(detalle.id)) {
                            this.serviciosAEliminar.push(detalle.id);
                        }
                    } else {
                        this.serviciosAEliminar = this.serviciosAEliminar.filter(id => id !==
                            detalle.id);
                    }
                } else {
                    // Si no tiene ID (es un nuevo servicio), simplemente lo eliminamos del array
                    this.detalles.splice(index, 1);
                }

                this.calcularTotal();
                this.prepararEnvio();
            },

            calcularTotal() {
                this.total = this.detalles.reduce((sum, detalle) => {
                    // Solo sumar si el servicio está activo y no está marcado para eliminación
                    if (detalle.estado === 'activo' && !detalle.paraEliminar) {
                        return sum + parseFloat(detalle.precio || 0);
                    }
                    return sum;
                }, 0);
            },

            limpiarSeleccion() {
                this.categoriaId = '';
                this.servicioId = '';
                this.planId = '';
                this.precio = '0.00';
                this.servicios = [];
                this.planes = [];
                this.ip = '';
                this.mostrarModalIp = false;
            },

            validarCampos() {
                if (!this.categoriaId) {
                    this.mostrarAlerta('Seleccione una categoría');
                    return false;
                }
                if (!this.servicioId) {
                    this.mostrarAlerta('Seleccione un servicio');
                    return false;
                }
                if (!this.planId) {
                    this.mostrarAlerta('Seleccione un plan');
                    return false;
                }
                if (!this.precio) {
                    this.mostrarAlerta('El precio no puede estar vacío');
                    return false;
                }
                return true;
            },

            mostrarAlerta(mensaje) {
                const alertEdit = document.getElementById('modal-edit-alert');
                const alertMessage = document.getElementById('alert-edit-message');

                if (alertEdit && alertMessage) {
                    alertMessage.textContent = mensaje;
                    const alpineAlertData = Alpine.$data(alertEdit);
                    alpineAlertData.showAlert = true;

                    setTimeout(() => {
                        alpineAlertData.showAlert = false;
                    }, 3000);
                }
            },

            prepararEnvio() {
                // Preparar los detalles para enviar al servidor, excluyendo los marcados para eliminación
                const detallesParaEnviar = this.detalles
                    .filter(detalle => !detalle.paraEliminar)
                    .map(detalle => ({
                        id: detalle.id,
                        categoria_id: detalle.categoria_id,
                        servicio_id: detalle.servicio_id,
                        plan_id: detalle.plan_id,
                        ip_servicio: detalle.ip_servicio || detalle.ip || '', // Priorizar ip_servicio sobre ip
                        estado: detalle.estado || 'activo',
                        precio: detalle.precio || '0.00',
                        fecha_suspension_servicio: detalle.estado === 'suspendido' ? new Date().toISOString().split('T')[0] : null
                    }));

                // Agregar los IDs de servicios a eliminar al JSON
                const datosParaEnviar = {
                    detalles: detallesParaEnviar,
                    serviciosAEliminar: this.serviciosAEliminar
                };

                // Actualizar el campo oculto con los detalles
                document.getElementById('detalles-json').value = JSON.stringify(datosParaEnviar);
                
                // Log para debugging
                console.log('Datos a enviar:', datosParaEnviar);
                
                return this.detalles.length > 0;
            }
        }));
    });

    // Manejar envío del formulario
    document.getElementById('editContractForm').addEventListener('submit', function(e) {
        const alpineData = Alpine.$data(document.querySelector('[x-data="contratoEditor()"]'));

        if (!alpineData.prepararEnvio()) {
            e.preventDefault();
            alpineData.mostrarAlerta('Debe agregar al menos un servicio al contrato');
        }
    });
</script>

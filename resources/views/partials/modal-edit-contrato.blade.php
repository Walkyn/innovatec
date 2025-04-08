<!-- Main modal -->
<div id="modificar-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 py-20 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <form id="editContractForm" action="" method="POST">
            @csrf
            @method('PUT')
            <!-- Campos ocultos para datos principales del contrato -->
            <input type="hidden" name="contrato_id" id="contrato-id">
            <input type="hidden" name="cliente_id" id="cliente-id">
            <input type="hidden" name="fecha" id="fecha-input">
            <input type="hidden" name="estado" id="estado-input">
            <input type="hidden" name="observaciones" id="observaciones-input">
            <input type="hidden" name="form_url" id="form-url">

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
                    <!-- ====== Datos del Cliente Section Start -->
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
                                <input type="text" id="modal-input-cliente" value=""
                                    class="bg-gray-100 border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    readonly disabled />
                            </div>
                        </div>

                        <!-- Campo de Identificación -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="client-identification">
                                Identificación
                            </label>
                            <div class="relative">
                                <input type="text" id="client-identification" value=""
                                    class="bg-gray-100 border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    readonly disabled />
                            </div>
                        </div>
                    </div>
                    <!-- ====== Datos del Cliente Section End -->

                    <div x-data="editarContratoData()" @click.away="if (mostrarModalIp) mostrarModalIp = false">
                        <!-- ====== Categoría - Servicio - Plan Section Start -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <!-- Categoría -->
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Categoría</label>
                                <div class="relative">
                                    <select x-model="categoriaId" @change="fetchServicios()"
                                        class="block appearance-none w-full bg-gray-100 dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-900 dark:text-gray-300 text-sm py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                        >
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
                                        class="block appearance-none w-full bg-gray-100 dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-900 dark:text-gray-300 text-sm py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                        >
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
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Plan</label>
                                <div class="relative">
                                    <select x-model="planId" @change="actualizarPrecio()"
                                        class="block appearance-none w-full bg-gray-100 dark:bg-gray-700 border border-gray-100 dark:border-gray-600 text-gray-900 dark:text-gray-300 text-sm py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                        >
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
                                        class="block appearance-none w-full bg-gray-100 border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 py-3 px-4 pr-2 leading-tight focus:outline-none focus:bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:bg-gray-800"
                                        placeholder="0.00" disabled>
                                </div>
                            </div>

                            <!-- Campo de Fecha -->
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0" x-init="init()">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">Fecha</label>
                                <input type="date" id="fecha-contrato" x-model="fecha"
                                    class="appearance-none block w-full bg-gray-100 border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 py-3 px-4 leading-tight focus:outline-none focus:bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:bg-gray-800"
                                    required>
                            </div>

                            <!-- Campo de Estado -->
                            <div class="w-full md:w-1/3 px-3 mb-2 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                                    Estado
                                </label>
                                <div class="relative">
                                    <select id="estado-contrato" x-model="estadoContrato"
                                        class="block appearance-none w-full bg-gray-100 border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 py-3 px-4 pr-8 leading-tight focus:outline-none focus:bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:focus:bg-gray-800"
                                        required>
                                        <option value="activo">Activo</option>
                                        <option value="suspendido">Suspendido</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- ====== Observaciones y Botón Agregar Section Start -->
                        <div class="flex flex-wrap -mx-3 mb-4">
                            <!-- Campo de observaciones -->
                            <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                                    Observaciones
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <i class="fa fa-align-left text-gray-500 dark:text-gray-400"></i>
                                    </div>
                                    <input type="text" id="observaciones" x-model="observaciones"
                                        class="bg-gray-100 border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Ingrese observaciones" required>
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

                        <!-- Alerta Datos-->
                        <div id="modal-edit-alert" x-data="{ showAlert: false }">
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
                                        <span id="alert-edit-message">Por favor, complete todos los campos
                                            requeridos.</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- ====== Tabla de Detalles Section Start -->
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
                                                    <th class="px-4 py-3 w-16">Acción</th>
                                                    <th class="px-4 py-3">Servicio</th>
                                                    <th class="px-4 py-3">Plan</th>
                                                    <th class="px-4 py-3 w-40">Dirección IP</th>
                                                    <th class="px-4 py-3">Fecha</th>
                                                    <th class="px-4 py-3 w-40">Estado</th>
                                                    <th class="px-4 py-3 text-right w-28">Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody id="detalle-contrato-edit"
                                                class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                                <template x-for="detalle in detalles" :key="detalle.id">
                                                    <tr class="text-gray-700 dark:text-gray-400">
                                                        <td class="px-4 py-3">
                                                            <div class="flex items-center space-x-4 text-sm">
                                                                <button @click="eliminarDetalle(detalle.id)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Eliminar">
                                                                    <i class="fas fa-trash-alt w-5 h-5"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <!-- Campos ocultos para enviar los datos al controlador -->
                                                        <input type="hidden" name="detalles[]" :value="JSON.stringify({
                                                            categoria_id: detalle.categoriaId,
                                                            servicio_id: detalle.servicioId,
                                                            plan_id: detalle.planId,
                                                            ip_servicio: detalle.ip,
                                                            precio: detalle.precio,
                                                            estado: detalle.estado
                                                        })">
                                                        <!-- Campos visibles -->
                                                        <td class="px-4 py-3 text-sm" x-text="detalle.servicio"></td>
                                                        <td class="px-4 py-3 text-sm" x-text="detalle.plan"></td>
                                                        <td class="px-4 py-3">
                                                            <div class="relative inline-block text-left w-full">
                                                                <input type="text" 
                                                                    x-model="detalle.ip" 
                                                                    placeholder="Ingrese IP"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                    style="min-width: 80px; width: auto;">
                                                            </div>
                                                        </td>
                                                        <td class="px-4 py-3 text-sm" style="white-space: nowrap;" x-text="fecha"></td>
                                                        <td class="px-4 py-3 text-xs">
                                                            <div class="relative inline-block text-left w-full">
                                                                <div>
                                                                    <button type="button" 
                                                                        @click="detalle.estado = detalle.estado === 'activo' ? 'suspendido' : 'activo'"
                                                                        class="px-2 py-1 font-semibold leading-tight rounded-full"
                                                                        :class="detalle.estado === 'activo' ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100'"
                                                                        style="min-width: 80px; white-space: nowrap; display: inline-flex; align-items: center; justify-content: center;">
                                                                        <span x-text="detalle.estado.charAt(0).toUpperCase() + detalle.estado.slice(1)"></span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-4 py-3 text-sm text-right" style="white-space: nowrap;">
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
                                            Total: S/ <span x-text="total.toFixed(2)">0.00</span>
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
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Modificar Contrato</button>
                    <button data-modal-hide="modificar-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('modificar-modal');
        const modal = new Modal(modalEl, {
            backdrop: 'static',
            closable: true,
            onShow: () => {
                console.log('Modal mostrado');
            },
            onHide: () => {
                console.log('Modal ocultado');
                // Asegurarse de que el overlay se elimine
                const overlay = document.querySelector('.modal-backdrop');
                if (overlay) {
                    overlay.remove();
                }
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            }
        });

        // Agregar manejadores para los botones de cerrar
        document.querySelectorAll('[data-modal-hide="modificar-modal"]').forEach(button => {
            button.addEventListener('click', () => {
                modal.hide();
                // Asegurarse de que el overlay se elimine
                const overlay = document.querySelector('.modal-backdrop');
                if (overlay) {
                    overlay.remove();
                }
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        });

        document.querySelectorAll('.open-modal-edit').forEach(button => {
            button.addEventListener('click', function() {
                try {
                    // Obtener el ID del contrato del botón
                    const contratoId = this.getAttribute('data-id');
                    console.log("ID del contrato (raw):", contratoId);
                    console.log("Tipo de ID del contrato:", typeof contratoId);
                    
                    // Verificar todos los atributos del botón
                    console.log("Todos los atributos del botón:", {
                        'data-id': this.getAttribute('data-id'),
                        'data-cliente': this.getAttribute('data-cliente'),
                        'data-cliente-id': this.getAttribute('data-cliente-id'),
                        'data-observaciones': this.getAttribute('data-observaciones'),
                        'data-estado': this.getAttribute('data-estado'),
                        'data-fecha': this.getAttribute('data-fecha')
                    });
                    
                    if (!contratoId) {
                        console.error("No se encontró el ID del contrato");
                        return;
                    }
                    
                    // Establecer el ID del contrato en el campo oculto
                    document.getElementById('contrato-id').value = contratoId;
                    console.log("Valor establecido en campo oculto:", document.getElementById('contrato-id').value);
                    
                    // Establecer la URL del formulario con el ID del contrato
                    const form = document.getElementById('editContractForm');
                    const formUrl = `/contracts/${contratoId}/update`;
                    form.action = formUrl;
                    console.log("URL del formulario (actual):", form.action);
                    console.log("URL relativa esperada:", formUrl);
                    
                    // Verificar que la URL del formulario termine con la ruta esperada
                    if (!form.action.endsWith(formUrl)) {
                        console.log("Corrigiendo URL del formulario");
                        form.action = formUrl;
                        console.log("URL del formulario corregida:", form.action);
                    }
                    
                    const detalles = JSON.parse(this.getAttribute('data-detalles'));
                    console.log("Detalles completos:", detalles);

                    // Obtener la instancia de Alpine.js
                    const alpineData = Alpine.$data(document.querySelector('[x-data="editarContratoData()"]'));
                    
                    // Limpiar los detalles existentes
                    alpineData.detalles = [];
                    
                    // Agregar los nuevos detalles
                    detalles.forEach(detalle => {
                        alpineData.detalles.push({
                            id: Date.now() + Math.random(),
                            categoriaId: parseInt(detalle.categoria_id),
                            categoria: detalle.categoria,
                            servicioId: parseInt(detalle.servicio_id),
                            servicio: detalle.nombre,
                            planId: parseInt(detalle.plan_id),
                            plan: detalle.plan,
                            estado: detalle.estado,
                            precio: detalle.precio,
                            ip: detalle.ip_servicio || ''
                        });
                    });
                    
                    // Actualizar el total
                    alpineData.actualizarTotal();

                    // Cargar datos del cliente y observaciones
                    document.getElementById('modal-input-cliente').value = this.getAttribute('data-cliente');
                    document.getElementById('client-identification').value = this.getAttribute('data-identificacion');
                    document.getElementById('cliente-id').value = this.getAttribute('data-cliente-id');

                    // Cargar observaciones en el input
                    const observaciones = this.getAttribute('data-observaciones');
                    document.getElementById('observaciones').value = observaciones || '';
                    alpineData.observaciones = observaciones || '';

                    // Cargar estado del contrato en el select
                    const estadoContrato = this.getAttribute('data-estado');
                    document.getElementById('estado-contrato').value = estadoContrato || 'activo';
                    alpineData.estadoContrato = estadoContrato || 'activo';

                    // Cargar fecha del contrato en el input
                    const fechaContrato = this.getAttribute('data-fecha');
                    const fechaInput = document.getElementById('fecha-contrato');
                    if (fechaInput) {
                        fechaInput.value = fechaContrato || '';
                        alpineData.fecha = fechaContrato || '';
                    }

                    // Mostrar el modal
                    modal.show();
                } catch (error) {
                    console.error('Error al procesar los datos:', error);
                }
            });
        });
        
        // Agregar un manejador para el envío del formulario
        document.getElementById('editContractForm').addEventListener('submit', function(e) {
            const contratoId = document.getElementById('contrato-id').value;
            console.log("ID del contrato al enviar el formulario:", contratoId);
            console.log("Tipo de ID del contrato al enviar:", typeof contratoId);
            console.log("URL del formulario antes del envío:", this.action);
            
            if (!contratoId) {
                e.preventDefault();
                console.error("Error: No se encontró el ID del contrato al enviar el formulario");
                return;
            }
            
            // Asegurarse de que la URL del formulario sea correcta
            const formUrl = `/contracts/${contratoId}/update`;
            if (!this.action.endsWith(formUrl)) {
                console.log("Corrigiendo URL del formulario de:", this.action, "a:", formUrl);
                this.action = formUrl;
            }
            
            // Validación del formulario de edición
            const alpineData = Alpine.$data(document.querySelector('[x-data="editarContratoData()"]'));
            
            if (alpineData.detalles.length === 0) {
                e.preventDefault();
                
                const alertEdit = document.getElementById('modal-edit-alert');
                const alertMessage = document.getElementById('alert-edit-message');

                if (alertEdit && alertMessage) {
                    alertMessage.textContent = 'Por favor, agregue al menos un detalle al contrato.';

                    const alpineAlertData = Alpine.$data(alertEdit);
                    alpineAlertData.showAlert = true;

                    setTimeout(() => {
                        alpineAlertData.showAlert = false;
                    }, 2500);
                }
            } else {
                // Actualizar los campos ocultos con los valores de Alpine.js
                document.getElementById('fecha-input').value = alpineData.fecha;
                document.getElementById('estado-input').value = alpineData.estadoContrato;
                document.getElementById('observaciones-input').value = alpineData.observaciones;
            }
        });
    });

    function editarContratoData() {
        return {
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

            init() {
                const fechaInput = document.getElementById('fecha-contrato');
                if (fechaInput && fechaInput.value) {
                    this.fecha = fechaInput.value;
                }
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

            validarIP(event) {
                this.ip = event.target.value.replace(/[^0-9.]/g, '');
            },

            agregarDetalle() {
                if (!this.validarCampos()) return;
        
                const categoria = this.categorias.find(c => c.id == this.categoriaId);
                const servicio = this.serviciosDisponibles.find(s => s.id == this.servicioId);
                const plan = this.planesDisponibles.find(p => p.id == this.planId);
        
                if (categoria && servicio && plan) {
                    // Verificar si existe el mismo servicio y plan
                    const servicioExistente = this.detalles.find(detalle => 
                        detalle.servicio.toLowerCase() === servicio.nombre.toLowerCase() && 
                        detalle.plan.toLowerCase() === plan.nombre.toLowerCase()
                    );

                    if (servicioExistente) {
                        // Si el servicio existe y está activo, no permitir agregarlo
                        if (servicioExistente.estado === 'activo') {
                            this.mostrarAlerta('Este servicio ya existe y está activo en el contrato. No se puede agregar nuevamente.');
                            return;
                        }
                        // Si está suspendido, permitir agregarlo
                        if (servicioExistente.estado === 'suspendido') {
                            console.log('Servicio existente suspendido, permitiendo agregar uno nuevo');
                        }
                    }

                    const nuevoDetalle = {
                        id: Date.now(),
                        categoriaId: parseInt(categoria.id),
                        categoria: categoria.nombre,
                        servicioId: parseInt(servicio.id),
                        servicio: servicio.nombre,
                        planId: parseInt(plan.id),
                        plan: plan.nombre,
                        estado: 'activo',
                        precio: this.precioPlan,
                        ip: this.ip
                    };

                    console.log('Agregando nuevo detalle:', {
                        servicio: nuevoDetalle.servicio,
                        plan: nuevoDetalle.plan,
                        estado: nuevoDetalle.estado
                    });
        
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
                const alertEdit = document.getElementById('modal-edit-alert');
                if (alertEdit) {
                    const alpineData = Alpine.$data(alertEdit);
                    alpineData.showAlert = true;
        
                    const alertMessage = document.getElementById('alert-edit-message');
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
        }
    }
</script>
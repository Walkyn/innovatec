<!-- Meses Modal -->
<div id="meses-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    x-data="mesesModal()">
    <div class="relative p-4 w-full max-w-2xl max-h-full mx-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Información del cliente
                </h3>
                <button type="button" @click="closeModal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="space-y-4">

                <main class="profile-page">

                    <div class="relative flex flex-col min-w-0 break-words bg-white dark:bg-gray-800 w-full">
                        <div class="px-5">
                            <!-- Información del cliente -->
                            <div class="flex flex-col items-center py-4">
                                <!-- Sección de perfil-->
                                <div class="flex flex-col items-center py-6">
                                    <div class="relative group mb-4">
                                        <div
                                            class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center shadow-lg transition-transform duration-300 group-hover:scale-105">
                                            <span class="text-2xl font-bold text-white" data-field="iniciales">--</span>
                                        </div>

                                        <!-- Indicador de estado (activo) -->
                                        <div
                                            class="absolute bottom-0 right-0 w-5 h-5 bg-green-500 rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center"
                                            data-field="estado-indicator">
                                            <i class="fas fa-check-circle text-white text-xs"></i>
                                        </div>
                                    </div>

                                    <!-- Nombre y detalles -->
                                    <div class="text-center">
                                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-1"
                                            data-field="nombre">Cargando...</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center justify-center"
                                            data-field="fecha-inicio">
                                            <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                            Cargando...
                                        </p>
                                    </div>
                                </div>

                                <!-- Información de contacto y ubicación -->
                                <div
                                    class="w-full grid grid-cols-1 md:grid-cols-2 gap-6 mb-4 bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <!-- 1. Identificación -->
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                            <i class="fas fa-id-card text-blue-500 dark:text-blue-300"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Identificación</p>
                                            <p class="text-gray-800 text-sm dark:text-white font-medium"
                                                data-field="identificacion">--</p>
                                        </div>
                                    </div>

                                    <!-- 2. Teléfono -->
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                            <i class="fas fa-phone text-blue-500 dark:text-blue-300"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Teléfono</p>
                                            <p class="text-gray-800 dark:text-white font-medium text-sm"
                                                data-field="telefono">
                                                --</p>
                                        </div>
                                    </div>

                                    <!-- 3. Fecha de Instalación -->
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                            <i class="fas fa-calendar-alt text-blue-500 dark:text-blue-300"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Instalación</p>
                                            <p class="text-gray-800 dark:text-white font-medium text-sm"
                                                data-field="fecha-instalacion">--</p>
                                        </div>
                                    </div>

                                    <!-- 4. Ubicación GPS -->
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                            <i class="fas fa-map-marker-alt text-blue-500 dark:text-blue-300"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Ubicación</p>
                                            <p class="text-gray-800 dark:text-white font-medium text-sm"
                                                data-field="gps">--</p>
                                        </div>
                                    </div>

                                    <!-- 5. Región -->
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                                            <i class="fas fa-map text-purple-500 dark:text-purple-300"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Región</p>
                                            <p class="text-gray-800 dark:text-white font-medium text-sm"
                                                data-field="region">--
                                            </p>
                                        </div>
                                    </div>

                                    <!-- 6. Provincia -->
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                                            <i class="fas fa-city text-purple-500 dark:text-purple-300"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Provincia</p>
                                            <p class="text-gray-800 dark:text-white font-medium text-sm"
                                                data-field="provincia">
                                                --</p>
                                        </div>
                                    </div>

                                    <!-- 7. Distrito -->
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                                            <i class="fas fa-map-marked-alt text-purple-500 dark:text-purple-300"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Distrito</p>
                                            <p class="text-gray-800 dark:text-white font-medium text-sm"
                                                data-field="distrito">
                                                --</p>
                                        </div>
                                    </div>

                                    <!-- 8. Centro Poblado -->
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                                            <i class="fas fa-map-pin text-purple-500 dark:text-purple-300"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Zona</p>
                                            <p class="text-gray-800 dark:text-white font-medium text-sm"
                                                data-field="pueblo">--
                                            </p>
                                        </div>
                                    </div>

                                    <!-- 9. Dirección -->
                                    <div class="md:col-span-2 flex items-center space-x-3">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                                            <i class="fas fa-home text-purple-500 dark:text-purple-300"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Dirección Completa</p>
                                            <p class="text-gray-800 dark:text-white font-medium text-sm"
                                                data-field="direccion">
                                                --</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Plan y detalles -->
                                <div class="w-full bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                                                <i class="fas fa-wifi text-green-500 dark:text-green-300"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400" data-field="plan">
                                                    --</p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400" data-field="servicio">
                                                    --</p>
                                                <p class="text-lg font-bold text-gray-800 dark:text-white"
                                                    data-field="precio">--</p>
                                            </div>
                                        </div>
                                        <div class="h-12 w-px bg-gray-200 dark:bg-gray-600"></div>
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                                                <i class="fas fa-check-circle text-green-500 dark:text-green-300" data-field="estado-icon"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Estado</p>
                                                <p class="text-sm font-semibold text-green-600 dark:text-green-400"
                                                    data-field="estado">--</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Inputs en grid -->
                            <div x-data="mesesData()" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Input para seleccionar el contrato -->
                                <div>
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                                        Contrato
                                    </label>
                                    <div class="relative">
                                        <select x-model="contratoSeleccionado" @change="cargarServicios"
                                            class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                                            <option value="">Seleccione un contrato</option>
                                            <template x-for="contrato in contratos" :key="contrato.id">
                                                <option :value="contrato.id" x-text="contrato.numero"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>

                                <!-- Input para seleccionar el servicio -->
                                <div>
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                                        Servicio
                                    </label>
                                    <div class="relative">
                                        <select x-model="servicioSeleccionado" @change="ajustarAnio"
                                            class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                                            <option value="">Seleccione un servicio</option>
                                            <template x-for="servicio in servicios" :key="servicio.id">
                                                <option :value="servicio.id" x-text="servicio.nombre"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                                        Año
                                    </label>
                                    <div class="relative">
                                        <select x-model="anioSeleccionado" @change="cargarMeses"
                                            class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                                            <template x-for="anio in anios" :key="anio">
                                                <option :value="anio" x-text="anio"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Calendario de meses -->
                            <div x-data="mesesData()" class="py-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Estado de Pagos
                                    </h3>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-32 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                            <div class="bg-green-600 h-2.5 rounded-full"
                                                :style="'width: ' + porcentajeCompletado + '%'"></div>
                                        </div>
                                        <span class="text-sm text-gray-600 dark:text-gray-300"
                                            x-text="porcentajeCompletado + '% completado'"></span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-4">
                                    <template x-for="(mes, index) in meses" :key="index">
                                        <div class="p-4 rounded-lg transition-all duration-200 hover:shadow-md"
                                            :class="{
                                                'bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800/50': mes
                                                    .estado === 'pagado',
                                                'bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-100 dark:border-yellow-800/50': mes
                                                    .estado === 'pendiente',
                                                'bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800/50': mes
                                                    .estado === 'falta',
                                                'bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600': mes
                                                    .estado === 'no-aplica'
                                            }">

                                            <!-- Barra de progreso del mes -->
                                            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3 dark:bg-gray-600">
                                                <div class="h-1.5 rounded-full transition-all duration-300"
                                                    :class="{
                                                        'bg-green-500': mes.estado === 'pagado',
                                                        'bg-yellow-500': mes.estado === 'pendiente',
                                                        'bg-red-500': mes.estado === 'falta',
                                                        'bg-gray-300 dark:bg-gray-500': mes.estado === 'no-aplica'
                                                    }"
                                                    :style="'width: ' + (mes.estado === 'pagado' ? '100%' : (mes
                                                        .estado === 'pendiente' ? '50%' : '0%'))">
                                                </div>
                                            </div>

                                            <div class="flex justify-between items-start">
                                                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200"
                                                    x-text="mes.nombre"></h4>
                                                <span class="text-xs font-medium px-2 py-1 rounded-full"
                                                    :class="{
                                                        'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100': mes
                                                            .estado === 'pagado',
                                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100': mes
                                                            .estado === 'pendiente',
                                                        'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100': mes
                                                            .estado === 'falta',
                                                        'bg-gray-200 text-gray-600 dark:bg-gray-600 dark:text-gray-200': mes
                                                            .estado === 'no-aplica'
                                                    }"
                                                    x-text="mes.estado === 'pagado' ? 'Pagado' : (mes.estado === 'pendiente' ? 'Pendiente' : (mes.estado === 'falta' ? 'Falta' : 'No aplica'))">
                                                </span>
                                            </div>

                                            <template x-if="mes.estado !== 'no-aplica'">
                                                <div class="mt-3 flex items-center justify-between text-xs">
                                                    <span class="text-gray-500 dark:text-gray-400"
                                                        x-text="'Vence: ' + mes.vencimiento"></span>
                                                    <template x-if="mes.estado === 'pagado'">
                                                        <span class="text-green-600 dark:text-green-400 font-medium"
                                                            x-text="'S/ ' + mes.monto"></span>
                                                    </template>
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </div>

                        </div>
                    </div>
                </main>

            </div>
            <!-- Modal footer -->
            <div
                class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                <button @click="closeModal" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aceptar</button>
                <button @click="closeModal" type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('mesesModal', () => ({
            init() {
                window.addEventListener('open-meses-modal', () => {
                    this.openModal();
                });
            },

            openModal() {
                const modal = document.getElementById('meses-modal');
                const modalInstance = new Modal(modal, {
                    backdrop: 'static',
                    keyboard: false
                });
                modalInstance.show();
            },

            closeModal() {
                const modal = document.getElementById('meses-modal');
                const modalInstance = new Modal(modal);
                modalInstance.hide();
            }
        }));
    });

    function mesesData() {
        return {
            contratoSeleccionado: '',
            servicioSeleccionado: '',
            anioSeleccionado: new Date().getFullYear(),
            porcentajeCompletado: 0,
            contratos: [{
                    id: 1,
                    numero: 'CON-001'
                },
                {
                    id: 2,
                    numero: 'CON-002'
                },
                {
                    id: 3,
                    numero: 'CON-003'
                }
            ],
            servicios: [],
            anios: Array.from({
                length: 5
            }, (_, i) => new Date().getFullYear() - i),
            meses: [{
                    nombre: 'Enero',
                    estado: 'pagado',
                    vencimiento: '05/01',
                    monto: '50.00'
                },
                {
                    nombre: 'Febrero',
                    estado: 'pendiente',
                    vencimiento: '05/02',
                    monto: '50.00'
                },
                {
                    nombre: 'Marzo',
                    estado: 'falta',
                    vencimiento: '05/03',
                    monto: '50.00'
                },
                {
                    nombre: 'Abril',
                    estado: 'pagado',
                    vencimiento: '05/04',
                    monto: '50.00'
                },
                {
                    nombre: 'Mayo',
                    estado: 'no-aplica',
                    vencimiento: '05/05',
                    monto: '50.00'
                },
                {
                    nombre: 'Junio',
                    estado: 'pagado',
                    vencimiento: '05/06',
                    monto: '50.00'
                },
                {
                    nombre: 'Julio',
                    estado: 'pendiente',
                    vencimiento: '05/07',
                    monto: '50.00'
                },
                {
                    nombre: 'Agosto',
                    estado: 'falta',
                    vencimiento: '05/08',
                    monto: '50.00'
                },
                {
                    nombre: 'Septiembre',
                    estado: 'no-aplica',
                    vencimiento: '05/09',
                    monto: '50.00'
                },
                {
                    nombre: 'Octubre',
                    estado: 'pagado',
                    vencimiento: '05/10',
                    monto: '50.00'
                },
                {
                    nombre: 'Noviembre',
                    estado: 'pendiente',
                    vencimiento: '05/11',
                    monto: '50.00'
                },
                {
                    nombre: 'Diciembre',
                    estado: 'pagado',
                    vencimiento: '05/12',
                    monto: '50.00'
                }
            ],
            cargarServicios() {
                // Simulación de carga de servicios
                this.servicios = [{
                        id: 1,
                        nombre: 'Internet Básico',
                        fechaInicio: '2023-01-01'
                    },
                    {
                        id: 2,
                        nombre: 'Internet Premium',
                        fechaInicio: '2023-06-01'
                    },
                    {
                        id: 3,
                        nombre: 'Internet Empresarial',
                        fechaInicio: '2023-03-01'
                    }
                ];
            },
            ajustarAnio() {
                const servicio = this.servicios.find(s => s.id === this.servicioSeleccionado);
                if (servicio) {
                    this.anioSeleccionado = new Date(servicio.fechaInicio).getFullYear();
                    this.cargarMeses();
                }
            },
            cargarMeses() {
                // Simulación de carga de meses según el año seleccionado
                this.actualizarPorcentajeCompletado();
            },
            actualizarPorcentajeCompletado() {
                const totalMeses = this.meses.length;
                const mesesCompletados = this.meses.filter(mes => mes.estado === 'pagado').length;
                this.porcentajeCompletado = Math.round((mesesCompletados / totalMeses) * 100);
            }
        }
    }
</script>

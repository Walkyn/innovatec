<!-- Meses Modal -->
<div id="meses-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    x-data="mesesModal()">
    <div class="relative p-4 w-full max-w-3xl max-h-full mx-auto">
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
                                        <div class="absolute bottom-0 right-0 w-5 h-5 bg-green-500 rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center"
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
                                            <a :href="'tel:' + telefono"
                                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium text-sm"
                                                data-field="telefono" x-text="telefono || '--'">
                                            </a>
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
                                            <template x-if="gpsCoordinates && gpsCoordinates !== '--'">
                                                <a :href="getGoogleMapsUrl(gpsCoordinates)" target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium text-sm"
                                                    data-field="gps" x-text="gpsCoordinates"></a>
                                            </template>
                                            <template x-if="!gpsCoordinates || gpsCoordinates === '--'">
                                                <span class="text-gray-800 dark:text-white font-medium text-sm"
                                                    data-field="gps">--</span>
                                            </template>
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
                                                <div class="flex items-center space-x-1">
                                                    <p class="text-sm text-gray-500 dark:text-gray-400"
                                                        data-field="servicio">
                                                        --</p>
                                                </div>
                                                <p class="text-lg font-bold text-gray-800 dark:text-white"
                                                    data-field="precio">--</p>
                                            </div>
                                        </div>
                                        <div class="h-12 w-px bg-gray-200 dark:bg-gray-600"></div>
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                                                <i class="fas fa-check-circle text-green-500 dark:text-green-300"
                                                    data-field="estado-icon"></i>
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

                            <!-- Sección de Meses -->
                            <div class="py-6" x-data="{ 
                                open: true, 
                                openServiceId: null,
                                openYear: null,
                                toggleYear(serviceId, year) {
                                    this.openYear = this.openYear === `${serviceId}-${year}` ? null : `${serviceId}-${year}`;
                                }
                            }">
                                <div id="modal-content">
                                    <div class="text-center text-gray-500 dark:text-gray-400 py-4">
                                        Cargando información del cliente...
                                    </div>
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
            telefono: '',
            gpsCoordinates: '',
            init() {
                // Ya no necesitamos escuchar el evento open-meses-modal
                // porque abrimos el modal directamente desde verDetallesCliente
            },

            closeModal() {
                const modal = document.getElementById('meses-modal');
                const modalInstance = new Modal(modal);
                modalInstance.hide();
            },

            getGoogleMapsUrl(coordinates) {
                if (!coordinates || coordinates === '--') {
                    return 'javascript:void(0)';
                }

                // Limpiamos la cadena de coordenadas
                coordinates = coordinates.trim();
                
                // Separamos por '/'
                const [lat, lng] = coordinates.split('/').map(coord => coord.trim());
                
                // Verificamos que tengamos ambas coordenadas
                if (!lat || !lng) {
                    return 'javascript:void(0)';
                }

                // Convertimos a números
                const latitude = parseFloat(lat);
                const longitude = parseFloat(lng);

                // Verificamos que sean números válidos
                if (isNaN(latitude) || isNaN(longitude)) {
                    return 'javascript:void(0)';
                }

                // Retornamos la URL de Google Maps
                return `https://www.google.com/maps?q=${latitude},${longitude}`;
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

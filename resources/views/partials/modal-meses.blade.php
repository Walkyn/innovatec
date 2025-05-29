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

                                <!-- Detalles -->
                                <div class="w-full bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                                                <i class="fas fa-wifi text-green-500 dark:text-green-300"></i>
                                            </div>
                                            <div>
                                                <p class="text-lg font-bold text-gray-500 dark:text-white">Servicios
                                                    Contratos</p>
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
                // Inicialización
            },

            closeModal() {
                const modal = document.getElementById('meses-modal');
                const modalInstance = new Modal(modal);
                modalInstance.hide();
            },

            getGoogleMapsUrl(coordinates) {
                if (!coordinates || coordinates === '--') return '#';

                const [lat, lng] = coordinates.split('/').map(coord => coord.trim());
                if (!lat || !lng) return '#';

                const latitude = parseFloat(lat);
                const longitude = parseFloat(lng);

                if (isNaN(latitude) || isNaN(longitude)) return '#';

                return `https://www.google.com/maps?q=${latitude},${longitude}`;
            }
        }));
    });
</script>

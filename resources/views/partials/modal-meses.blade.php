<!-- Meses Modal -->
<div id="meses-modal" tabindex="-1" data-modal-backdrop="static"
    class="fixed top-0 py-24 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Información del cliente
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="meses-modal">
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

                    <div class="relative flex flex-col min-w-0 break-words bg-white  dark:bg-gray-800 w-full">
                        <div class="px-5">
                            <div class="flex flex-wrap justify-center items-center">
                                <div class="w-full lg:w-4/12 px-4 lg:order-1">
                                    <div class="flex justify-center py-4 lg:pt-4 pt-4">
                                        <!-- Plan -->
                                        <div class="mr-4 p-3 text-center">
                                            <span
                                                class="text-xs font-bold block uppercase tracking-wide text-blueGray-600">{{ '50.00' }}</span>
                                            <span class="text-xs text-blueGray-400">PLAN</span>
                                        </div>
                                        <!-- Instalación -->
                                        <div class="mr-4 p-3 text-center">
                                            <span
                                                class="text-xs font-bold block uppercase tracking-wide text-blueGray-600">{{ '10-12-2023' }}</span>
                                            <span class="text-xs text-blueGray-400">INSTALACION</span>
                                        </div>
                                        <!-- DNI -->
                                        <div class="lg:mr-4 p-3 text-center">
                                            <span
                                                class="text-xs font-bold block uppercase tracking-wide text-blueGray-600">{{ '63371697' }}</span>
                                            <span class="text-xs text-blueGray-400">IDENTIFICACIÓN</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="text-2xl font-semibold leading-normal mb-4 text-blueGray-500">
                                    {{ 'Brayan Capa Medina' }}
                                </h3>
                                <div class="text-sm leading-normal mt-2 mb-2 text-blueGray-400 font-bold uppercase">
                                    <i class="fas fa-map-marker-alt mr-2 text-sm text-blueGray-400"></i>
                                    {{ 'Ubicación' }}
                                </div>
                                <div class="mb-2 text-blueGray-600 mt-2">
                                    <i class="fas fa-briefcase mr-2 text-sm text-blueGray-400"></i>{{ 'Dirección' }}
                                </div>
                                <div class="mb-2 text-blueGray-600">
                                    <i class="fas fa-phone mr-2 text-sm text-blueGray-400"></i>{{ 'Teléfono' }}
                                </div>
                            </div>

                            <div class="flex">
                                <!-- Campo de selección de fecha -->
                                <input type="date" id="datepicker"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full max-w-xs p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Seleccionar fecha">
                            </div>

                            <!-- Calendario de meses -->
                            <div class="mt-4 py-6 border-t dark:border-gray-600">

                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                    @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $mes)
                                        <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg shadow-md">
                                            <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">{{ $mes }}</h4>
                                            <span class="block text-xs font-semibold text-green-700 bg-green-100 rounded-full px-2 py-1 mt-2 dark:bg-green-700 dark:text-green-100">
                                                Pagado
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </main>

            </div>
            <!-- Modal footer -->
            <div
                class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="meses-modal" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aceptar</button>
                <button data-modal-hide="meses-modal" type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
            </div>
        </div>
    </div>
</div>

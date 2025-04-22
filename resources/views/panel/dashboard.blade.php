@extends('layouts.app-cliente')
@section('title', 'Nexus - Mis Pagos')

@section('content')

    <!--Start Content -->
    <div class="relative p-6 w-full max-h-full mx-auto">

        <!-- Modal content -->
        <div class="relative bg-white rounded-md shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Mi Información
                </h3>
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
                                            class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center shadow-lg">
                                            <span class="text-2xl font-bold text-white">JL</span>
                                        </div>

                                        <!-- Indicador de estado (activo) -->
                                        <div
                                            class="absolute bottom-0 right-0 w-5 h-5 bg-green-500 rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center">
                                            <i class="fas fa-check-circle text-white text-xs"></i>
                                        </div>
                                    </div>

                                    <!-- Nombre y detalles -->
                                    <div class="text-center">
                                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-1">Juan López Martínez
                                        </h3>
                                        <p
                                            class="text-sm text-gray-500 dark:text-gray-400 flex items-center justify-center">
                                            <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                            Activo desde 15 de Marzo de 2022
                                        </p>
                                    </div>
                                </div>

                                <!-- Información de contacto y ubicación -->
                                <div
                                    class="w-full grid grid-cols-1 md:grid-cols-3 gap-6 mb-4 bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                    <!-- 1. Identificación -->
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                            <i class="fas fa-id-card text-blue-500 dark:text-blue-300"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Identificación</p>
                                            <p class="text-gray-800 text-sm dark:text-white font-medium">DNI 75849632</p>
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
                                            <a href="tel:987654321"
                                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium text-sm">
                                                987 654 321
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
                                            <p class="text-gray-800 dark:text-white font-medium text-sm">15/03/2022</p>
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
                                            <a href="https://www.google.com/maps?q=-12.123456,-77.123456" target="_blank"
                                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium text-sm">
                                                -12.123456, -77.123456
                                            </a>
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
                                            <p class="text-gray-800 dark:text-white font-medium text-sm">
                                                Lima
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
                                            <p class="text-gray-800 dark:text-white font-medium text-sm">
                                                Lima
                                            </p>
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
                                            <p class="text-gray-800 dark:text-white font-medium text-sm">
                                                San Isidro
                                            </p>
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
                                            <p class="text-gray-800 dark:text-white font-medium text-sm">
                                                Zona Comercial
                                            </p>
                                        </div>
                                    </div>

                                    <!-- 9. Dirección -->
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                                            <i class="fas fa-home text-purple-500 dark:text-purple-300"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Dirección Completa</p>
                                            <p class="text-gray-800 dark:text-white font-medium text-sm">
                                                Av. Los Incas 123, 2do piso, San Isidro
                                            </p>
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
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        Internet Fibra Óptica
                                                    </p>
                                                </div>
                                                <p class="text-lg font-bold text-gray-800 dark:text-white">
                                                    S/ 120.00
                                                </p>
                                            </div>
                                        </div>
                                        <div class="h-12 w-px bg-gray-200 dark:bg-gray-600"></div>
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                                                <i class="fas fa-check-circle text-green-500 dark:text-green-300"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">Estado</p>
                                                <p class="text-sm font-semibold text-green-600 dark:text-green-400">
                                                    Activo
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

                                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                                    <div class="flex justify-between mb-6">
                                        <div>
                                            <div class="flex items-center mb-1">
                                                <div class="text-2xl font-semibold">2</div>
                                            </div>
                                            <div class="text-sm font-medium text-gray-400">Contratos Activos</div>
                                        </div>
                                    </div>

                                    <a href="/gebruikers"
                                        class="text-[#f84525] font-medium text-sm hover:text-red-800">Ver</a>
                                </div>

                                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                                    <div class="flex justify-between mb-6">
                                        <div>
                                            <div class="flex items-center mb-1">
                                                <div class="text-2xl font-semibold">2</div>
                                            </div>
                                            <div class="text-sm font-medium text-gray-400">Servicios Activos</div>
                                        </div>
                                    </div>

                                    <a href="/gebruikers"
                                        class="text-[#f84525] font-medium text-sm hover:text-red-800">Ver</a>
                                </div>
                                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                                    <div class="flex justify-between mb-4">
                                        <div>
                                            <div class="flex items-center mb-1">
                                                <div class="text-2xl font-semibold">100</div>
                                                <div
                                                    class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2">
                                                    +30%</div>
                                            </div>
                                            <div class="text-sm font-medium text-gray-400">Meses pendientes</div>
                                        </div>
                                    </div>
                                    <a href="/dierenartsen"
                                        class="text-[#f84525] font-medium text-sm hover:text-red-800">Ver</a>
                                </div>
                                <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                                    <div class="flex justify-between mb-6">
                                        <div>
                                            <div class="text-2xl font-semibold mb-1">100</div>
                                            <div class="text-sm font-medium text-gray-400">Total pendiente</div>
                                        </div>
                                    </div>
                                    <a href=""
                                        class="text-[#f84525] font-medium text-sm hover:text-red-800">Ver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <!-- End Content -->

@endsection

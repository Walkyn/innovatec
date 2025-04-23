@extends('layouts.app-cliente')
@section('title', 'Nexus - Mi Perfil')

@section('content')

    <!-- Contenido principal -->
    <div class="container mx-auto p-4">
        <!-- Tarjeta principal -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <!-- Encabezado -->
            <div class="border-b border-gray-100 px-6 py-4">
                <h3 class="text-xl font-semibold text-gray-800">Perfil del Cliente</h3>
            </div>

            <!-- Contenido -->
            <div class="p-6">
<!-- Sección superior: Información personal -->
<div class="flex flex-col md:flex-row gap-6 mb-8 items-stretch">
    <!-- Avatar y datos básicos -->
    <div class="flex-1 bg-white p-5 rounded-lg border border-gray-100 shadow-xs">
        <div class="flex items-start gap-5 h-full">
            <!-- Avatar -->
            <div class="relative flex-shrink-0">
                <div class="w-18 h-18 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-sm">
                    <span class="text-xl font-bold text-white">JL</span>
                </div>
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
            </div>

            <!-- Información básica -->
            <div class="flex flex-col justify-between h-full">
                <div>
                    <h2 class="text-xl font-light text-gray-900 mb-1">Juan López Martínez</h2>
                    <div class="flex items-center text-xs text-gray-500 mb-2 ml-1">
                        Registrado el 15/03/2022
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 mt-2">
                    <span class="px-2.5 py-0.5 bg-blue-50 text-blue-600 text-xs rounded-full">75849632</span>
                    <span class="px-2.5 py-0.5 bg-gray-50 text-gray-600 text-xs rounded-full">Lima, San Isidro</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Estado del servicio - Versión ajustada -->
    <div class="bg-white p-5 rounded-lg border border-gray-100 shadow-xs flex-1">
        <div class="flex items-start space-x-3 h-full">
            <!-- Icono minimalista -->
            <div class="mt-0.5 text-green-500 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>
                </svg>
            </div>

            <!-- Contenido -->
            <div class="flex flex-col justify-between flex-1 h-full">
                <div>
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-xs font-medium text-gray-500 tracking-wider">SERVICIO ACTIVO</span>
                        <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded-full">● Activo</span>
                    </div>
                    <h3 class="text-base font-normal text-gray-800 mt-1.5">Internet Básico</h3>
                </div>
                <div class="flex justify-between items-baseline mt-2">
                    <span class="text-sm text-gray-500">Precio Mensual</span>
                    <span class="text-base font-medium text-gray-900">S/120.00</span>
                </div>
            </div>
        </div>
    </div>
</div>

                <!-- Información de contacto y ubicación -->
                <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-6 mb-4 bg-gray-50 dark:bg-gray-700 rounded-lg p-4">

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
                    <div class="flex w-full items-center space-x-3 md:col-span-2">
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
                                        Internet Basico
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

                <!-- Historial de servicios -->
                <div class="border-t border-gray-100 pt-6">
                    <h4 class="text-lg font-medium text-gray-800 mb-4">Servicios Contratados</h4>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Servicio</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Plan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha Inicio</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Estado</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Internet</div>
                                                <div class="text-sm text-gray-500">Fibra Óptica</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">200 Mbps</div>
                                        <div class="text-sm text-gray-500">S/120.00 mensual</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        15/03/2022
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Activo
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Detalles</a>
                                        <a href="#" class="text-blue-600 hover:text-blue-900">Renovar</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Televisión</div>
                                                <div class="text-sm text-gray-500">Cable Digital</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">150 canales</div>
                                        <div class="text-sm text-gray-500">S/80.00 mensual</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        15/03/2022
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Activo
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Detalles</a>
                                        <a href="#" class="text-blue-600 hover:text-blue-900">Renovar</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

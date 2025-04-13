<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark text-bodydark bg-boxdark-2': darkMode === true }">

    <!-- ===== Preloader Start ===== -->
    @include('partials/preloader')
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">

        <!-- ===== Sidebar Start ===== -->
        @include('partials.sidebar')
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- ===== Header Start ===== -->
            @include('partials.header')
            <!-- ===== Header End ===== -->
            <section>
                @yield('content')
                @yield('scripts')
            </section>
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->

    <!-- Modal de Solicitud de Permisos de Ubicación -->
    <div id="locationPermissionModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/50 dark:bg-gray-900/75 transition-opacity" aria-hidden="true"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/20 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white" id="modal-title">
                                    Permisos de Ubicación
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Para mejorar tu experiencia y proporcionar una ubicación más precisa, necesitamos acceso a tu ubicación. ¿Deseas permitir el acceso?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" id="allowLocationBtn" class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                            Permitir
                        </button>
                        <button type="button" id="denyLocationBtn" class="mt-3 inline-flex w-full justify-center rounded-md bg-white dark:bg-gray-600 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-500 hover:bg-gray-50 dark:hover:bg-gray-500 sm:mt-0 sm:w-auto">
                            Denegar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para verificar el estado del permiso de ubicación
        async function checkLocationPermission() {
            // Verificar si ya se solicitó el permiso anteriormente
            const permissionRequested = localStorage.getItem('locationPermissionRequested');
            
            if (permissionRequested) {
                console.log('El permiso ya fue solicitado anteriormente');
                return;
            }

            try {
                // Verificar el estado actual del permiso
                const permissionStatus = await navigator.permissions.query({ name: 'geolocation' });
                
                if (permissionStatus.state === 'granted') {
                    // Si ya tiene permiso, actualizar ubicación sin mostrar modal
                    getCurrentPosition();
                    localStorage.setItem('locationPermissionRequested', 'true');
                } else if (permissionStatus.state === 'prompt') {
                    // Si aún no se ha solicitado, mostrar el modal
                    requestLocationPermission();
                }
                // Si está denegado (denied), no hacemos nada
            } catch (error) {
                console.error('Error al verificar permisos:', error);
            }
        }

        // Función para obtener la posición actual
        function getCurrentPosition() {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const coords = {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude
                        };
                        console.log('Coordenadas obtenidas:', coords);

                        // Enviar las coordenadas al servidor
                        updateServerLocation(coords);
                    },
                    (error) => {
                        console.error('Error al obtener la ubicación:', error);
                        handleLocationError(error);
                    }
                );
            }
        }

        // Función para actualizar la ubicación en el servidor
        function updateServerLocation(coords) {
            fetch('{{ route("api.update-location") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(coords)
            })
            .then(response => {
                console.log('Respuesta del servidor:', response.status);
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.message || 'Error en la respuesta del servidor');
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Datos del servidor:', data);
                if (!data.success) {
                    throw new Error(data.message || 'Error al actualizar la ubicación');
                }
                // Marcar que el permiso fue solicitado exitosamente
                localStorage.setItem('locationPermissionRequested', 'true');
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Función para manejar errores de geolocalización
        function handleLocationError(error) {
            let errorMessage;
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage = 'Permiso de ubicación denegado';
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage = 'La información de ubicación no está disponible';
                    break;
                case error.TIMEOUT:
                    errorMessage = 'La solicitud de ubicación expiró';
                    break;
                default:
                    errorMessage = 'Error desconocido al obtener la ubicación';
            }
            console.error(errorMessage);
        }

        // Función para solicitar permisos de ubicación
        function requestLocationPermission() {
            const modal = document.getElementById('locationPermissionModal');
            const allowBtn = document.getElementById('allowLocationBtn');
            const denyBtn = document.getElementById('denyLocationBtn');

            // Mostrar el modal
            modal.classList.remove('hidden');

            // Manejar la respuesta del usuario
            allowBtn.addEventListener('click', () => {
                getCurrentPosition();
                modal.classList.add('hidden');
            });

            denyBtn.addEventListener('click', () => {
                localStorage.setItem('locationPermissionRequested', 'true');
                modal.classList.add('hidden');
            });
        }

        // Verificar si es un inicio de sesión exitoso
        document.addEventListener('DOMContentLoaded', () => {
            @if(session()->has('login_successful'))
                // Esperar un momento para asegurar que la página esté completamente cargada
                setTimeout(() => {
                    checkLocationPermission();
                }, 1500);
            @endif
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</body>

</html>

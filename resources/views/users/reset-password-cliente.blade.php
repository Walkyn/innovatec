@extends('layouts.app')
@section('title', 'Nexus - Restablecer contraseña')

@section('content')
    <div class="relative p-4 w-full max-h-full mx-auto">
        <!-- Tarjeta principal -->
        <div class="bg-white dark:bg-boxdark rounded shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <!-- Encabezado -->
            <div class="border-b border-gray-100 dark:border-gray-700 px-6 py-4">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Restablecer Contraseña</h3>
            </div>

            <!-- Contenido -->
            <div class="p-6">
                <!-- ====== Alerts Start -->
                @include('partials.alerts')
                <!-- ====== Alerts End -->

                <!-- Formulario de búsqueda de cliente -->
                <div class="bg-white dark:bg-boxdark dark:border-gray-700 shadow-xs mb-6">
                    <form id="searchClientForm" action="{{ url('/search-cliente-workaround') }}" method="GET">
                        <div class="mb-4">
                            <label class="mb-2.5 block font-medium text-black dark:text-gray-200">Identificación del Cliente</label>
                            <div class="relative">
                                <input type="text" id="identificacion" name="identificacion" 
                                    placeholder="Ingrese la identificación del cliente"
                                    required
                                    class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-transparent dark:bg-gray-700 py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none text-gray-700 dark:text-gray-300 transition-colors" />
                                <span class="absolute right-4 top-4 text-gray-400">
                                    <i class="fas fa-id-card"></i>
                                </span>
                            </div>
                        </div>

                        <div>
                            <button type="submit" 
                                class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90">
                                Buscar Cliente
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Información del usuario (visible solo cuando se encuentra un cliente) -->
                @if(isset($user))
                <div class="flex flex-col md:flex-row gap-6 mb-8">
                    <div class="flex-1 bg-white dark:bg-gray-800 p-5 rounded-lg border border-gray-100 dark:border-gray-700 shadow-xs">
                        <div class="flex items-start gap-5">
                            <!-- Avatar -->
                            <div class="relative flex-shrink-0 hidden md:block">
                                <div class="w-18 h-18 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-sm">
                                    <span class="text-xl font-bold text-white">{{ $initials }}</span>
                                </div>
                            </div>

                            <!-- Información básica -->
                            <div class="flex flex-col">
                                <h2 class="text-xl font-light text-gray-900 dark:text-white mb-1">{{ $user->nombres }} {{ $user->apellidos }}</h2>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <span class="px-2.5 py-0.5 bg-blue-50 dark:bg-blue-900 text-blue-600 dark:text-blue-300 text-xs rounded-full">{{ $user->identificacion }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulario de cambio de contraseña -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg border border-gray-100 dark:border-gray-700 shadow-xs">
                    <form id="resetPasswordForm" action="{{ route('users.updatePasswordCliente') }}" method="POST">
                        @csrf
                        <input type="hidden" name="cliente_id" value="{{ $user->id }}">

                        <!-- Contraseñas -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="mb-2.5 block font-medium text-black dark:text-white">Nueva Contraseña</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" 
                                        placeholder="Nueva contraseña"
                                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-transparent dark:bg-gray-700 py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none text-gray-700 dark:text-gray-300 transition-colors" />
                                    <span class="absolute right-4 top-4 text-gray-400">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <p id="passwordError" class="text-red-500 mt-2 text-xs italic hidden"></p>
                            </div>

                            <div>
                                <label class="mb-2.5 block font-medium text-black dark:text-white">Confirmar Contraseña</label>
                                <div class="relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        placeholder="Confirmar contraseña"
                                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-transparent dark:bg-gray-700 py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none text-gray-700 dark:text-gray-300 transition-colors" />
                                    <span class="absolute right-4 top-4 text-gray-400">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Botón de actualización -->
                        <div class="mt-6">
                            <button type="submit" 
                                class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90">
                                Restablecer Contraseña
                            </button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('searchClientForm');
            
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    // Verifica que se está enviando como POST
                    console.log('Enviando formulario con método: ' + searchForm.method);
                    
                    // No previene el envío por defecto, solo lo muestra en consola
                });
            }
            
            // Verificar si el formulario existe en esta página
            const resetForm = document.getElementById('resetPasswordForm');
            if (resetForm) {
                const password = document.getElementById('password');
                const passwordConfirmation = document.getElementById('password_confirmation');
                const passwordError = document.getElementById('passwordError');

                // Validar contraseña principal
                function validateMainPassword() {
                    const passwordValue = password.value;
                    
                    if (passwordValue.length >= 8) {
                        passwordError.classList.add('hidden');
                        password.classList.remove('border-red-500', 'border-gray-300', 'dark:border-gray-600');
                        password.classList.add('border-green-500');
                        return true;
                    } else {
                        if (passwordValue.length > 0) {
                            passwordError.textContent = 'La contraseña debe tener al menos 8 caracteres';
                            passwordError.classList.remove('hidden');
                            password.classList.remove('border-green-500', 'border-gray-300', 'dark:border-gray-600');
                            password.classList.add('border-red-500');
                        } else {
                            password.classList.remove('border-red-500', 'border-green-500');
                            password.classList.add('border-gray-300', 'dark:border-gray-600');
                            passwordError.classList.add('hidden');
                        }
                        return false;
                    }
                }

                // Validar confirmación de contraseña
                function validateConfirmation() {
                    const passwordValue = password.value;
                    const confirmValue = passwordConfirmation.value;

                    if (confirmValue.length > 0) {
                        if (passwordValue === confirmValue && passwordValue.length >= 8) {
                            passwordError.classList.add('hidden');
                            passwordConfirmation.classList.remove('border-red-500', 'border-gray-300', 'dark:border-gray-600');
                            passwordConfirmation.classList.add('border-green-500');
                            return true;
                        } else {
                            passwordError.textContent = 'Las contraseñas no coinciden';
                            passwordError.classList.remove('hidden');
                            passwordConfirmation.classList.remove('border-green-500', 'border-gray-300', 'dark:border-gray-600');
                            passwordConfirmation.classList.add('border-red-500');
                            return false;
                        }
                    } else {
                        passwordConfirmation.classList.remove('border-red-500', 'border-green-500');
                        passwordConfirmation.classList.add('border-gray-300', 'dark:border-gray-600');
                        return false;
                    }
                }

                // Validar en tiempo real
                password.addEventListener('input', function() {
                    validateMainPassword();
                    if (passwordConfirmation.value.length > 0) {
                        validateConfirmation();
                    }
                });

                passwordConfirmation.addEventListener('input', validateConfirmation);

                // Validar antes de enviar
                resetForm.addEventListener('submit', function(e) {
                    const isMainValid = validateMainPassword();
                    const isConfirmValid = validateConfirmation();

                    if (!isMainValid || !isConfirmValid) {
                        e.preventDefault();
                    }
                });
            }
        });
    </script>
@endsection


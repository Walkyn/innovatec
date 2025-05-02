@extends('layouts.app-cliente')
@section('title', 'Nexus - Cambiar contraseña')

@section('content')
    <div class="relative p-4 w-full max-h-full mx-auto">
        <!-- Tarjeta principal -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <!-- Encabezado -->
            <div class="border-b border-gray-100 px-6 py-4">
                <h3 class="text-xl font-semibold text-gray-800">Cambiar Contraseña</h3>
            </div>

            <!-- Contenido -->
            <div class="p-6">
                <!-- Información del usuario -->
                <div class="flex flex-col md:flex-row gap-6 mb-8">
                    <div class="flex-1 bg-white p-5 rounded-lg border border-gray-100 shadow-xs">
                        <div class="flex items-start gap-5">
                            <!-- Avatar -->
                            <div class="relative flex-shrink-0 hidden md:block">
                                <div class="w-18 h-18 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-sm">
                                    <span class="text-xl font-bold text-white">{{ $initials }}</span>
                                </div>
                            </div>

                            <!-- Información básica -->
                            <div class="flex flex-col">
                                <h2 class="text-xl font-light text-gray-900 mb-1">{{ $user->nombres }} {{ $user->apellidos }}</h2>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <span class="px-2.5 py-0.5 bg-blue-50 text-blue-600 text-xs rounded-full">{{ $user->identificacion }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Agregar mensaje de éxito -->
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Formulario de cambio de contraseña -->
                <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-xs">
                    <form id="changePasswordForm" action="{{ route('panel.update-password') }}" method="POST">
                        @csrf

                        <!-- Contraseñas -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="mb-2.5 block font-medium text-black dark:text-white">Nueva Contraseña</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" 
                                        placeholder="Nueva contraseña"
                                        class="w-full rounded-lg border border-gray-300 bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input transition-colors" />
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
                                        class="w-full rounded-lg border border-gray-300 bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input transition-colors" />
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
                                Actualizar Contraseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('changePasswordForm');
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');
            const passwordError = document.getElementById('passwordError');

            // Validar contraseña principal
            function validateMainPassword() {
                const passwordValue = password.value;
                
                if (passwordValue.length >= 8) {
                    passwordError.classList.add('hidden');
                    password.classList.remove('border-red-500', 'border-gray-300');
                    password.classList.add('border-green-500');
                    return true;
                } else {
                    if (passwordValue.length > 0) {
                        passwordError.textContent = 'La contraseña debe tener al menos 8 caracteres';
                        passwordError.classList.remove('hidden');
                        password.classList.remove('border-green-500');
                        password.classList.add('border-red-500');
                    } else {
                        password.classList.remove('border-red-500', 'border-green-500');
                        password.classList.add('border-gray-300');
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
                        passwordConfirmation.classList.remove('border-red-500', 'border-gray-300');
                        passwordConfirmation.classList.add('border-green-500');
                        return true;
                    } else {
                        passwordError.textContent = 'Las contraseñas no coinciden';
                        passwordError.classList.remove('hidden');
                        passwordConfirmation.classList.remove('border-green-500', 'border-gray-300');
                        passwordConfirmation.classList.add('border-red-500');
                        return false;
                    }
                } else {
                    passwordConfirmation.classList.remove('border-red-500', 'border-green-500');
                    passwordConfirmation.classList.add('border-gray-300');
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
            form.addEventListener('submit', function(e) {
                const isMainValid = validateMainPassword();
                const isConfirmValid = validateConfirmation();

                if (!isMainValid || !isConfirmValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection


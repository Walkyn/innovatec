@extends('layouts.app')
@section('title', 'Nexus - Restablecer Contraseña')

@section('content')
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Restablecer Contraseña
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="index.html">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Restablecer</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Alerts Start -->
            @include('partials.alerts')
            <!-- ====== Alerts End -->

            <!-- ====== Forms Section Start -->
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex flex-wrap items-center">
                    <div class="hidden w-full xl:block xl:w-1/2">
                        <div class="px-26 py-17.5 text-center">
                            <a class="mb-5.5 justify-center flex items-center gap-2" href="#">
                                <img class="h-10" src="{{ asset('images/logo/logo.png') }}" alt="Logo">
                                <span class="text-xl font-bold text-gray-900 dark:text-white">Nexus Telecom E.I.R.L.</span>
                            </a>

                            <p class="font-medium 2xl:px-20">
                                Restablece tu cuenta para registrar, gestionar pagos, y administrar tus servicios de manera
                                eficiente.
                            </p>

                            <span class="mt-15 inline-block">
                                <img src="{{ asset('images/illustration/illustration-03.svg') }}" alt="illustration" />
                            </span>
                        </div>
                    </div>
                    <div class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
                        <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                            <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                                Restablecer contraseña
                            </h2>

                            <form id="resetPasswordForm" action="{{ route('users.updatePassword') }}" method="POST">
                                @csrf

                                <p class="font-medium pb-4">
                                    Introduzca su dirección de correo electrónico para continuar con el restablecimiento de su
                                    contraseña.
                                </p>
                                <div class="mb-4">
                                    <label class="mb-2.5 block font-medium text-black dark:text-white">Email</label>
                                    <div class="relative">
                                        <input type="email" id="email" name="email"
                                            placeholder="Introduce tu correo electrónico" value="{{ old('email') }}"
                                            class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                        <span class="absolute right-4 top-4">
                                            <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g opacity="0.5">
                                                    <path
                                                        d="M19.2516 3.30005H2.75156C1.58281 3.30005 0.585938 4.26255 0.585938 5.46567V16.6032C0.585938 17.7719 1.54844 18.7688 2.75156 18.7688H19.2516C20.4203 18.7688 21.4172 17.8063 21.4172 16.6032V5.4313C21.4172 4.26255 20.4203 3.30005 19.2516 3.30005ZM19.2516 4.84692C19.2859 4.84692 19.3203 4.84692 19.3547 4.84692L11.0016 10.2094L2.64844 4.84692C2.68281 4.84692 2.71719 4.84692 2.75156 4.84692H19.2516ZM19.2516 17.1532H2.75156C2.40781 17.1532 2.13281 16.8782 2.13281 16.5344V6.35942L10.1766 11.5157C10.4172 11.6875 10.6922 11.7563 10.9672 11.7563C11.2422 11.7563 11.5172 11.6875 11.7578 11.5157L19.8016 6.35942V16.5688C19.8703 16.9125 19.5953 17.1532 19.2516 17.1532Z"
                                                        fill="" />
                                                </g>
                                            </svg>
                                        </span>
                                        <!-- Mensaje de error o éxito -->
                                        <p id="emailMessage" class="text-xs italic mt-2"></p>
                                        @error('email')
                                            <p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <button type="button" id="verifyEmailButton"
                                        class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90">
                                        Verificar correo
                                    </button>
                                </div>

                                <!-- Password -->
                                <div id="passwordFields" class="hidden opacity-0 transition-opacity duration-500">
                                    <div class="flex flex-col md:flex-row gap-4 mb-4">
                                        <div class="w-full md:w-1/2">
                                            <label
                                                class="mb-2.5 block font-medium text-black dark:text-white">Contraseña</label>
                                            <div class="relative">
                                                <input type="password" id="password" name="password"
                                                    placeholder="Introduce tu contraseña"
                                                    class="w-full rounded-lg border border-gray-300 bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary transition-colors" />
                                                <span class="absolute right-4 top-4">
                                                    <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g opacity="0.5">
                                                            <path
                                                                d="M16.1547 6.80626V5.91251C16.1547 3.16251 14.0922 0.825009 11.4797 0.618759C10.0359 0.481259 8.59219 0.996884 7.52656 1.95938C6.46094 2.92188 5.84219 4.29688 5.84219 5.70626V6.80626C3.84844 7.18438 2.33594 8.93751 2.33594 11.0688V17.2906C2.33594 19.5594 4.19219 21.3813 6.42656 21.3813H15.5016C17.7703 21.3813 19.6266 19.525 19.6266 17.2563V11C19.6609 8.93751 18.1484 7.21876 16.1547 6.80626ZM8.55781 3.09376C9.31406 2.40626 10.3109 2.06251 11.3422 2.16563C13.1641 2.33751 14.6078 3.98751 14.6078 5.91251V6.70313H7.38906V5.67188C7.38906 4.70938 7.80156 3.78126 8.55781 3.09376ZM18.1141 17.2906C18.1141 18.7 16.9453 19.8688 15.5359 19.8688H6.46094C5.05156 19.8688 3.91719 18.7344 3.91719 17.325V11.0688C3.91719 9.52189 5.15469 8.28438 6.70156 8.28438H15.2953C16.8422 8.28438 18.1141 9.52188 18.1141 11V17.2906Z"
                                                                fill="" />
                                                            <path
                                                                d="M10.9977 11.8594C10.5852 11.8594 10.207 12.2031 10.207 12.65V16.2594C10.207 16.6719 10.5508 17.05 10.9977 17.05C11.4102 17.05 11.7883 16.7063 11.7883 16.2594V12.6156C11.7883 12.2031 11.4102 11.8594 10.9977 11.8594Z"
                                                                fill="" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <p id="passwordError" class="text-red-500 mt-2 text-xs italic hidden"></p>
                                                @error('password')
                                                    <p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="w-full md:w-1/2">
                                            <label class="mb-2.5 block font-medium text-black dark:text-white">Repetir
                                                contraseña</label>
                                            <div class="relative">
                                                <input type="password" id="password_confirmation"
                                                    name="password_confirmation" placeholder=""
                                                    class="w-full rounded-lg border border-gray-300 bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary transition-colors" />
                                                <span class="absolute right-4 top-4">
                                                    <svg class="fill-current" width="22" height="22"
                                                        viewBox="0 0 22 22" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g opacity="0.5">
                                                            <path
                                                                d="M16.1547 6.80626V5.91251C16.1547 3.16251 14.0922 0.825009 11.4797 0.618759C10.0359 0.481259 8.59219 0.996884 7.52656 1.95938C6.46094 2.92188 5.84219 4.29688 5.84219 5.70626V6.80626C3.84844 7.18438 2.33594 8.93751 2.33594 11.0688V17.2906C2.33594 19.5594 4.19219 21.3813 6.42656 21.3813H15.5016C17.7703 21.3813 19.6266 19.525 19.6266 17.2563V11C19.6609 8.93751 18.1484 7.21876 16.1547 6.80626ZM8.55781 3.09376C9.31406 2.40626 10.3109 2.06251 11.3422 2.16563C13.1641 2.33751 14.6078 3.98751 14.6078 5.91251V6.70313H7.38906V5.67188C7.38906 4.70938 7.80156 3.78126 8.55781 3.09376ZM18.1141 17.2906C18.1141 18.7 16.9453 19.8688 15.5359 19.8688H6.46094C5.05156 19.8688 3.91719 18.7344 3.91719 17.325V11.0688C3.91719 9.52189 5.15469 8.28438 6.70156 8.28438H15.2953C16.8422 8.28438 18.1141 9.52188 18.1141 11V17.2906Z"
                                                                fill="" />
                                                            <path
                                                                d="M10.9977 11.8594C10.5852 11.8594 10.207 12.2031 10.207 12.65V16.2594C10.207 16.6719 10.5508 17.05 10.9977 17.05C11.4102 17.05 11.7883 16.7063 11.7883 16.2594V12.6156C11.7883 12.2031 11.4102 11.8594 10.9977 11.8594Z"
                                                                fill="" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" id="userId" name="id">

                                    <!-- Botón -->
                                    <div class="flex gap-4">
                                        <input type="submit" value="Actualizar contraseña"
                                            class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ====== Forms Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

    <!-- ===== Scripts ===== -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const verifyEmailButton = document.getElementById('verifyEmailButton');
            const emailInput = document.getElementById('email');
            const passwordFields = document.getElementById('passwordFields');
            const userIdInput = document.getElementById('userId');
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');
            const passwordError = document.getElementById('passwordError');
            const resetPasswordForm = document.getElementById('resetPasswordForm');
            const emailMessage = document.getElementById('emailMessage');
    
            // Verificar correo
            verifyEmailButton.addEventListener('click', function () {
                const email = emailInput.value;
    
                if (!email) {
                    emailMessage.textContent = 'Por favor, introduce un correo electrónico.';
                    emailMessage.classList.remove('text-green-500');
                    emailMessage.classList.add('text-red-500');
                    emailInput.classList.add('border-red-500');
                    emailInput.classList.remove('border-green-500');
                    // Asegurarse de que los campos de contraseña estén ocultos
                    passwordFields.classList.add('hidden');
                    passwordFields.classList.add('opacity-0');
                    return;
                }
    
                fetch('{{ route("users.verifyEmail") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        emailMessage.textContent = data.error;
                        emailMessage.classList.remove('text-green-500');
                        emailMessage.classList.add('text-red-500');
                        emailInput.classList.add('border-red-500');
                        emailInput.classList.remove('border-green-500');
                        // Ocultar los campos de contraseña si hay un error
                        passwordFields.classList.add('hidden');
                        passwordFields.classList.add('opacity-0');
                    } else if (data.id) {
                        emailMessage.textContent = `Usuario encontrado: ${data.name}`;
                        emailMessage.classList.remove('text-red-500');
                        emailMessage.classList.add('text-green-500');
                        emailInput.classList.remove('border-red-500');
                        emailInput.classList.add('border-green-500');
                        // Mostrar los campos de contraseña si el correo es válido
                        passwordFields.classList.remove('hidden');
                        setTimeout(() => {
                            passwordFields.classList.remove('opacity-0');
                        }, 10);
                        userIdInput.value = data.id;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    emailMessage.textContent = 'Hubo un error al verificar el correo.';
                    emailMessage.classList.remove('text-green-500');
                    emailMessage.classList.add('text-red-500');
                    emailInput.classList.add('border-red-500');
                    emailInput.classList.remove('border-green-500');
                    // Ocultar los campos de contraseña si hay un error
                    passwordFields.classList.add('hidden');
                    passwordFields.classList.add('opacity-0');
                });
            });
    
            // Validar contraseñas
            function validatePasswords() {
                const passwordValue = password.value;
                const confirmPasswordValue = passwordConfirmation.value;
    
                if (passwordValue.length < 8) {
                    passwordError.textContent = 'La contraseña debe tener al menos 8 caracteres';
                    passwordError.classList.remove('hidden');
                    password.classList.add('border-red-500');
                    password.classList.remove('border-green-500');
                    return false;
                }
    
                if (passwordValue && confirmPasswordValue) {
                    if (passwordValue !== confirmPasswordValue) {
                        passwordError.textContent = 'Las contraseñas no coinciden';
                        passwordError.classList.remove('hidden');
                        password.classList.add('border-red-500');
                        passwordConfirmation.classList.add('border-red-500');
                        password.classList.remove('border-green-500');
                        passwordConfirmation.classList.remove('border-green-500');
                        return false;
                    } else {
                        passwordError.textContent = '';
                        passwordError.classList.add('hidden');
                        password.classList.remove('border-red-500');
                        passwordConfirmation.classList.remove('border-red-500');
                        password.classList.add('border-green-500');
                        passwordConfirmation.classList.add('border-green-500');
                        return true;
                    }
                } else {
                    passwordError.textContent = '';
                    passwordError.classList.add('hidden');
                    password.classList.remove('border-red-500');
                    passwordConfirmation.classList.remove('border-red-500');
                    password.classList.remove('border-green-500');
                    passwordConfirmation.classList.remove('border-green-500');
                    return false;
                }
            }
    
            // Evitar envío del formulario si las contraseñas no son válidas
            resetPasswordForm.addEventListener('submit', function (event) {
                if (!validatePasswords()) {
                    event.preventDefault();
                }
            });
    
            // Validar contraseñas en tiempo real
            password.addEventListener('input', validatePasswords);
            passwordConfirmation.addEventListener('input', validatePasswords);
        });
    </script>
@endsection
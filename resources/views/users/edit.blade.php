@extends('layouts.app')

@section('title', 'Nexus - Editar Usuario')

@section('content')
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Modificar Usuario
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="index.html">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Modificar usuario</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Alerts Start ====== -->
            @include('partials.alerts')
            <!-- ====== Alerts End -->

            <!-- ====== Forms Section Start ====== -->
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex flex-wrap items-center">
                    <div class="hidden w-full xl:block xl:w-1/2">
                        <div class="px-26 py-17.5 text-center">
                            <a class="mb-5.5 justify-center flex items-center gap-2" href="#">
                                <img class="h-10" src="{{ asset('images/logo/logo.png') }}" alt="Logo">
                                <span class="text-xl font-bold text-gray-900 dark:text-white">Business Manager</span>
                            </a>

                            <p class="font-medium 2xl:px-20">
                                Edita la información del usuario para actualizar sus datos, roles y permisos.
                            </p>

                            <span class="mt-15 inline-block">
                                <img src="{{ asset('images/illustration/illustration-03.svg') }}" alt="illustration" />
                            </span>
                        </div>
                    </div>
                    <div class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
                        <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                            <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                                Editar Usuario
                            </h2>

                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="flex flex-col md:flex-row gap-4 mb-4">
                                    <div class="w-full md:w-1/2">
                                        <label class="mb-2.5 block font-medium text-black dark:text-white">Nombre</label>
                                        <div class="relative">
                                            <input type="text" name="name" placeholder="Nombres completos"
                                                value="{{ old('name', $user->name) }}"
                                                class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                            <span class="absolute right-4 top-4">
                                                <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.5">
                                                        <path
                                                            d="M11.0008 9.52185C13.5445 9.52185 15.607 7.5281 15.607 5.0531C15.607 2.5781 13.5445 0.584351 11.0008 0.584351C8.45703 0.584351 6.39453 2.5781 6.39453 5.0531C6.39453 7.5281 8.45703 9.52185 11.0008 9.52185ZM11.0008 2.1656C12.6852 2.1656 14.0602 3.47185 14.0602 5.08748C14.0602 6.7031 12.6852 8.00935 11.0008 8.00935C9.31641 8.00935 7.94141 6.7031 7.94141 5.08748C7.94141 3.47185 9.31641 2.1656 11.0008 2.1656Z"
                                                            fill="" />
                                                        <path
                                                            d="M13.2352 11.0687H8.76641C5.08828 11.0687 2.09766 14.0937 2.09766 17.7719V20.625C2.09766 21.0375 2.44141 21.4156 2.88828 21.4156C3.33516 21.4156 3.67891 21.0719 3.67891 20.625V17.7719C3.67891 14.9531 5.98203 12.6156 8.83516 12.6156H13.2695C16.0883 12.6156 18.4258 14.9187 18.4258 17.7719V20.625C18.4258 21.0375 18.7695 21.4156 19.2164 21.4156C19.6633 21.4156 20.007 21.0719 20.007 20.625V17.7719C19.9039 14.0937 16.9133 11.0687 13.2352 11.0687Z"
                                                            fill="" />
                                                    </g>
                                                </svg>
                                            </span>
                                            @error('name')
                                                <p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="w-full md:w-1/2">
                                        <label class="mb-2.5 block font-medium text-black dark:text-white">Teléfono</label>
                                        <div class="relative">
                                            <input type="tel" id="phone_display_edit" placeholder="Introduce tu número"
                                                value="{{ old('phone', $user->phone) }}"
                                                class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                            <input type="hidden" id="phone_edit" name="phone"
                                                value="{{ old('phone', $user->phone) }}" />
                                            <span class="absolute right-4 top-4">
                                                <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.5">
                                                        <path
                                                            d="M19.5556 15.1528C18.3333 15.1528 17.1528 14.9306 16.0417 14.5417C15.7639 14.4444 15.4583 14.5139 15.2361 14.7083L13.1667 16.3889C10.3056 14.9028 7.97222 12.6111 6.51389 9.75L8.22222 7.65278C8.44444 7.40278 8.51389 7.06944 8.41667 6.76389C8.02778 5.65278 7.80556 4.47222 7.80556 3.25C7.80556 2.72222 7.375 2.29167 6.84722 2.29167H3.25C2.72222 2.29167 2.29167 2.72222 2.29167 3.25C2.29167 12.4306 9.56944 19.7083 18.75 19.7083C19.2778 19.7083 19.7083 19.2778 19.7083 18.75V15.1528C19.7083 14.625 19.2778 14.1944 18.75 14.1944H19.5556V15.1528Z"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" fill="none" />
                                                    </g>
                                                </svg>
                                            </span>
                                            <!-- Mensaje de error -->
                                            @error('phone')
                                                <p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="mb-2.5 block font-medium text-black dark:text-white">Email</label>
                                    <div class="relative">
                                        <input type="email" name="email" placeholder="Introduce tu correo electrónico"
                                            value="{{ old('email', $user->email) }}"
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
                                        @error('email')
                                            <p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Selección de Rol -->
                                <div x-data="app">
                                    <div
                                        class="rounded-sm border mb-4 border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                                        <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                                            <h3 class="font-medium text-black dark:text-white">Seleccionar Rol</h3>
                                        </div>
                                        <div class="flex flex-col gap-5.5 p-6.5">
                                            @error('role')
                                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                            @enderror
                                            <div class="space-y-4">
                                                <!-- Rol Administrador -->
                                                <label class="flex items-center justify-between cursor-pointer">
                                                    <span class="text-black dark:text-white">Administrador</span>
                                                    <div class="relative">
                                                        <input type="radio" name="role" value="admin"
                                                            class="sr-only" @click="selectedRole = 'admin'"
                                                            :checked="selectedRole === 'admin' ||
                                                                {{ $user->id_rol === 1 ? 'true' : 'false' }}" />
                                                        <div
                                                            class="block h-8 w-14 rounded-full bg-meta-9 dark:bg-[#5A616B]">
                                                        </div>
                                                        <div :class="selectedRole === 'admin' &&
                                                            '!right-1 !translate-x-full !bg-primary dark:!bg-white'"
                                                            class="dot absolute left-1 top-1 flex h-6 w-6 items-center justify-center rounded-full bg-white transition">
                                                            <span :class="selectedRole === 'admin' && '!block'"
                                                                class="hidden text-white dark:text-bodydark">
                                                                <svg class="fill-current stroke-current" width="11"
                                                                    height="8" viewBox="0 0 11 8" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972Z"
                                                                        fill="" stroke="" stroke-width="0.4">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </label>

                                                <!-- Rol Empleado -->
                                                <label class="flex items-center justify-between cursor-pointer">
                                                    <span class="text-black dark:text-white">Empleado</span>
                                                    <div class="relative">
                                                        <input type="radio" name="role" value="empleado"
                                                            class="sr-only" @click="selectedRole = 'empleado'"
                                                            :checked="selectedRole === 'empleado' ||
                                                                {{ $user->id_rol === 2 ? 'true' : 'false' }}" />
                                                        <div
                                                            class="block h-8 w-14 rounded-full bg-meta-9 dark:bg-[#5A616B]">
                                                        </div>
                                                        <div :class="selectedRole === 'empleado' &&
                                                            '!right-1 !translate-x-full !bg-primary dark:!bg-white'"
                                                            class="dot absolute left-1 top-1 flex h-6 w-6 items-center justify-center rounded-full bg-white transition">
                                                            <span :class="selectedRole === 'empleado' && '!block'"
                                                                class="hidden text-white dark:text-bodydark">
                                                                <svg class="fill-current stroke-current" width="11"
                                                                    height="8" viewBox="0 0 11 8" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972Z"
                                                                        fill="" stroke="" stroke-width="0.4">
                                                                    </path>
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Permisos (solo para empleados) -->
                                    <div x-show="selectedRole === 'empleado'"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="rounded-sm border mb-4 border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                                        <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                                            <h3 class="font-medium text-black dark:text-white">Seleccionar Permisos</h3>
                                        </div>
                                        <div
                                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 2xl:grid-cols-4 gap-5.5 p-6.5">
                                            <!-- Módulos Dinámicos -->
                                            <template x-for="(module, index) in modules" :key="module.id">
                                                <div x-data="{ moduleToggle: module.active, actions: module.actions }">
                                                    <!-- Checkbox del módulo -->
                                                    <label :for="'checkbox' + module.id"
                                                        class="flex cursor-pointer select-none items-center text-sm font-medium">
                                                        <div class="relative">
                                                            <input type="checkbox" :id="'checkbox' + module.id"
                                                                class="sr-only" x-model="module.active"
                                                                :name="'modules[' + index + '][id]'"
                                                                :value="module.id" />
                                                            <div :class="module.active &&
                                                                'border-primary bg-gray dark:bg-transparent'"
                                                                class="mr-4 flex h-5 w-5 items-center justify-center rounded border">
                                                                <span :class="module.active && '!opacity-100'"
                                                                    class="opacity-0">
                                                                    <i class="fas fa-check text-primary text-xs"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <span x-text="module.name"></span>
                                                    </label>
                                                    <!-- Acciones específicas del módulo -->
                                                    <div x-show="module.active" class="ml-8 mt-2 space-y-2">
                                                        <template x-for="action in actionsList" :key="action.id">
                                                            <label :for="action.id + module.id"
                                                                class="flex cursor-pointer select-none items-center text-sm font-medium">
                                                                <div class="relative">
                                                                    <input type="checkbox" :id="action.id + module.id"
                                                                        class="sr-only"
                                                                        x-model="module.actions[action.id]"
                                                                        :name="'modules[' + index + '][actions][' + action.id +
                                                                            ']'"
                                                                        :value="action.id" />
                                                                    <div :class="module.actions[action.id] &&
                                                                        'border-primary bg-gray dark:bg-transparent'"
                                                                        class="mr-4 flex h-5 w-5 items-center justify-center rounded border">
                                                                        <span
                                                                            :class="module.actions[action.id] && '!opacity-100'"
                                                                            class="opacity-0">
                                                                            <i
                                                                                class="fas fa-check text-primary text-xs"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <span x-text="action.name"></span>
                                                            </label>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botón -->
                                <div class="flex gap-4">
                                    <input type="submit" value="Actualizar Usuario"
                                        class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90" />
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
    
@endsection

<!-- ===== Scritps ===== -->
@section('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('app', () => ({
                selectedRole: '{{ $user->id_rol === 1 ? 'admin' : 'empleado' }}',
                modules: {!! json_encode(
                    $allModulos->map(function ($modulo) use ($userModulos, $userPermisos) {
                        return [
                            'id' => $modulo->id_modulo,
                            'name' => $modulo->nombre_modulo,
                            'active' => in_array($modulo->id_modulo, $userModulos),
                            'actions' => $userPermisos[$modulo->id_modulo] ?? [
                                'eliminar' => false,
                                'actualizar' => false,
                                'guardar' => false,
                            ],
                        ];
                    }),
                ) !!},
                actionsList: [{
                        id: 'eliminar',
                        name: 'Eliminar'
                    },
                    {
                        id: 'actualizar',
                        name: 'Actualizar'
                    },
                    {
                        id: 'guardar',
                        name: 'Guardar'
                    }
                ],
                toggleModule(module) {
                    module.active = !module.active;
                    if (!module.active) {
                        module.actions = {
                            'eliminar': false,
                            'actualizar': false,
                            'guardar': false,
                        };
                    }
                },
                toggleAction(module, action) {
                    module.actions[action] = !module.actions[action];
                }
            }));
        });
    </script>

    <script>
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');
        const passwordError = document.getElementById('passwordError');

        function validatePasswords() {
            const passwordValue = password.value;
            const confirmPasswordValue = passwordConfirmation.value;

            if (passwordValue.length < 8) {
                passwordError.textContent = 'La contraseña debe tener al menos 8 caracteres';
                passwordError.classList.remove('hidden');
                password.classList.add('border-red-500');
                password.classList.remove('border-green-500');
                return;
            }

            if (passwordValue && confirmPasswordValue) {
                if (passwordValue !== confirmPasswordValue) {
                    passwordError.textContent = 'Las contraseñas no coinciden';
                    passwordError.classList.remove('hidden');
                    password.classList.add('border-red-500');
                    passwordConfirmation.classList.add('border-red-500');
                    password.classList.remove('border-green-500');
                    passwordConfirmation.classList.remove('border-green-500');
                } else {
                    passwordError.textContent = '';
                    passwordError.classList.add('hidden');
                    password.classList.remove('border-red-500');
                    passwordConfirmation.classList.remove('border-red-500');
                    password.classList.add('border-green-500');
                    passwordConfirmation.classList.add('border-green-500');
                }
            } else {
                passwordError.textContent = '';
                passwordError.classList.add('hidden');
                password.classList.remove('border-red-500');
                passwordConfirmation.classList.remove('border-red-500');
                password.classList.remove('border-green-500');
                passwordConfirmation.classList.remove('border-green-500');
            }
        }

        password.addEventListener('input', validatePasswords);
        passwordConfirmation.addEventListener('input', validatePasswords);
    </script>

    <!-- intlTelInput -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const phoneDisplayCreate = document.querySelector("#phone_display");
            const phoneInputCreate = document.querySelector("#phone");

            const phoneDisplayEdit = document.querySelector("#phone_display_edit");
            const phoneInputEdit = document.querySelector("#phone_edit");

            const initializePhoneField = (phoneDisplay, phoneInput) => {
                if (phoneDisplay && phoneInput) {
                    const iti = window.intlTelInput(phoneDisplay, {
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                        separateDialCode: true,
                        preferredCountries: ['pe', 'mx', 'es'],
                        initialCountry: "auto",
                        geoIpLookup: function(callback) {
                            fetch("https://ipapi.co/json")
                                .then(response => response.json())
                                .then(data => callback(data.country_code))
                                .catch(() => callback("pe"));
                        },
                        formatOnDisplay: true,
                        nationalMode: false,
                    });

                    const formatPhoneNumber = (number) => {
                        const cleaned = number.replace(/\D/g, "");
                        const match = cleaned.match(/^(\d{0,3})(\d{0,3})(\d{0,4})$/);
                        if (match) {
                            return `${match[1]}${match[2] ? " " + match[2] : ""}${match[3] ? " " + match[3] : ""}`;
                        }
                        return number;
                    };

                    const limitDigitsByCountry = (countryCode) => {
                        const digitLimits = {
                            pe: 9,
                            mx: 10,
                            es: 9,
                        };
                        return digitLimits[countryCode] || 10;
                    };

                    phoneDisplay.addEventListener("input", function() {
                        const countryData = iti.getSelectedCountryData();
                        const countryCode = countryData.iso2;
                        const digitLimit = limitDigitsByCountry(countryCode);

                        let currentValue = phoneDisplay.value.replace(/\D/g, "");
                        if (currentValue.length > digitLimit) {
                            currentValue = currentValue.slice(0, digitLimit);
                        }

                        phoneDisplay.value = formatPhoneNumber(currentValue);

                        if (iti.isValidNumber()) {
                            phoneInput.value = iti.getNumber();
                        }
                    });

                    if (phoneInput.value) {
                        iti.setNumber(phoneInput.value);
                    }
                }
            };

            initializePhoneField(phoneDisplayCreate, phoneInputCreate);
            initializePhoneField(phoneDisplayEdit, phoneInputEdit);
        });
    </script>
@endsection
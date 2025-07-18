@extends('layouts.app')
@section('title', 'Nexus - Registrar')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Registrar
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="index.html">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Registrar</li>
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
                                <span class="text-xl font-bold text-gray-900 dark:text-white">Business Manager</span>
                            </a>


                            <p class="font-medium 2xl:px-20">
                                Crea tu cuenta para registrar, gestionar pagos, y administrar tus servicios de manera
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
                                Registrar usuario
                            </h2>

                            <form action="{{ route('users.store') }}" method="POST" id="userForm">
                                @csrf
                                <div class="flex flex-col md:flex-row gap-4 mb-4">
                                    <div class="w-full md:w-1/2">
                                        <label class="mb-2.5 block font-medium text-black dark:text-white">Nombre</label>
                                        <div class="relative">
                                            <input type="text" name="name" id="name" placeholder="Nombres completos"
                                                value="{{ old('name') }}"
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
                                            <p id="nameError" class="text-red-500 mt-2 text-xs italic hidden"></p>
                                            @error('name')
                                                <p class="text-red-500 mt-2 text-xs italic">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="w-full md:w-1/2">
                                        <label class="mb-2.5 block font-medium text-black dark:text-white">Teléfono</label>
                                        <div class="relative">
                                            <input type="tel" id="phone_display" placeholder="Introduce tu número"
                                                value="{{ old('phone') }}"
                                                class="w-full rounded-lg border border-stroke bg-transparent py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                            <input type="hidden" id="phone" name="phone"
                                                value="{{ old('phone') }}" />
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
                                            <p id="phone-error" class="text-red-500 mt-2 text-xs italic hidden"></p>
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
                                            value="{{ old('email') }}"
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

                                <div class="flex flex-col md:flex-row gap-4 mb-4">
                                    <div class="w-full md:w-1/2">
                                        <label
                                            class="mb-2.5 block font-medium text-black dark:text-white">Contraseña</label>
                                        <div class="relative">
                                            <input type="password" id="password" name="password"
                                                placeholder="Introduce tu contraseña" value="{{ old('password') }}"
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
                                                value="{{ old('password_confirmation') }}"
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
                                                            :checked="selectedRole === 'admin'" />
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
                                                            :checked="selectedRole === 'empleado'" />
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
                                                <div x-data="{ moduleToggle: false, actions: { eliminar: false, actualizar: false, guardar: false } }"
                                                    x-transition:enter="transition ease-out duration-300"
                                                    x-transition:enter-start="opacity-0 translate-y-4"
                                                    x-transition:enter-end="opacity-100 translate-y-0"
                                                    x-transition:leave="transition ease-in duration-200"
                                                    x-transition:leave-start="opacity-100 translate-y-0"
                                                    x-transition:leave-end="opacity-0 translate-y-4">
                                                    <!-- Checkbox del módulo -->
                                                    <label :for="'checkbox' + module.id"
                                                        class="flex cursor-pointer select-none items-center text-sm font-medium">
                                                        <div class="relative">
                                                            <input type="checkbox" :id="'checkbox' + module.id"
                                                                class="sr-only" @change="moduleToggle = !moduleToggle"
                                                                :name="'modules[' + index + '][id]'"
                                                                :value="module.id" />
                                                            <div :class="moduleToggle && 'border-primary bg-gray dark:bg-transparent'"
                                                                class="mr-4 flex h-5 w-5 items-center justify-center rounded border">
                                                                <span :class="moduleToggle && '!opacity-100'"
                                                                    class="opacity-0">
                                                                    <i class="fas fa-check text-primary text-xs"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <span x-text="module.name"></span>
                                                    </label>
                                                    <!-- Acciones específicas del módulo -->
                                                    <div x-show="moduleToggle"
                                                        x-transition:enter="transition ease-out duration-300"
                                                        x-transition:enter-start="opacity-0 translate-y-4"
                                                        x-transition:enter-end="opacity-100 translate-y-0"
                                                        x-transition:leave="transition ease-in duration-200"
                                                        x-transition:leave-start="opacity-100 translate-y-0"
                                                        x-transition:leave-end="opacity-0 translate-y-4"
                                                        class="ml-8 mt-2 space-y-2">
                                                        <template x-for="action in actionsList" :key="action.id">
                                                            <label :for="action.id + module.id"
                                                                class="flex cursor-pointer select-none items-center text-sm font-medium">
                                                                <div class="relative">
                                                                    <input type="checkbox" :id="action.id + module.id"
                                                                        class="sr-only" x-model="actions[action.id]"
                                                                        :name="'modules[' + index + '][actions][' + action.id +
                                                                            ']'"
                                                                        :value="action.id" />
                                                                    <div :class="actions[action.id] &&
                                                                        'border-primary bg-gray dark:bg-transparent'"
                                                                        class="mr-4 flex h-5 w-5 items-center justify-center rounded border">
                                                                        <span :class="actions[action.id] && '!opacity-100'"
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
                                    <input type="submit" value="Crear cuenta"
                                        class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90" />
                                </div>
                            </form>

                            <script>
                                document.addEventListener('alpine:init', () => {
                                    Alpine.data('app', () => ({
                                        selectedRole: null,
                                        modules: [{
                                                id: 1,
                                                name: 'Inicio'
                                            },
                                            {
                                                id: 2,
                                                name: 'Clientes'
                                            },
                                            {
                                                id: 3,
                                                name: 'Administrar'
                                            },
                                            {
                                                id: 4,
                                                name: 'Cobranzas'
                                            },
                                            {
                                                id: 5,
                                                name: 'Calendario'
                                            },
                                            {
                                                id: 6,
                                                name: 'Perfil'
                                            },
                                            {
                                                id: 7,
                                                name: 'Configuración'
                                            },
                                            {
                                                id: 8,
                                                name: 'Reportes'
                                            },
                                            {
                                                id: 9,
                                                name: 'Database'
                                            },
                                            {
                                                id: 10,
                                                name: 'Autenticación'
                                            }
                                        ],
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
                                        ]
                                    }));
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
            <!-- ====== Forms Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

@endsection
@section('scripts')
    <!-- ===== Scritps ===== -->
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
            const phoneDisplay = document.querySelector("#phone_display");
            const phoneInput = document.querySelector("#phone");
            const phoneError = document.querySelector("#phone-error");

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

                const updateValidationMessage = (countryCode, currentLength, requiredLength) => {
                    if (currentLength === 0) {
                        phoneError.classList.add('hidden');
                        return;
                    }

                    const countryNames = {
                        pe: 'Perú',
                        mx: 'México',
                        es: 'España'
                    };

                    const countryName = countryNames[countryCode] || 'este país';
                    
                    if (currentLength < requiredLength) {
                        phoneError.textContent = `Por favor, ingrese ${requiredLength} dígitos para ${countryName}. Te faltan ${requiredLength - currentLength} dígitos.`;
                        phoneError.classList.remove('hidden');
                    } else if (currentLength > requiredLength) {
                        phoneError.textContent = `El número telefónico para ${countryName} debe tener ${requiredLength} dígitos. Tienes ${currentLength - requiredLength} dígitos extra.`;
                        phoneError.classList.remove('hidden');
                    } else {
                        phoneError.classList.add('hidden');
                    }
                };

                phoneDisplay.addEventListener("input", function() {
                    const countryData = iti.getSelectedCountryData();
                    const countryCode = countryData.iso2;
                    const digitLimit = limitDigitsByCountry(countryCode);

                    let currentValue = phoneDisplay.value.replace(/\D/g, "");
                    const currentLength = currentValue.length;

                    if (currentValue.length > digitLimit) {
                        currentValue = currentValue.slice(0, digitLimit);
                    }

                    phoneDisplay.value = formatPhoneNumber(currentValue);
                    updateValidationMessage(countryCode, currentLength, digitLimit);

                    if (iti.isValidNumber()) {
                        phoneInput.value = iti.getNumber();
                        phoneDisplay.classList.remove('border-red-500');
                        phoneDisplay.classList.add('border-green-500');
                    } else {
                        phoneDisplay.classList.remove('border-green-500');
                        phoneDisplay.classList.add('border-red-500');
                    }
                });

                // También actualizamos el mensaje cuando cambia el país
                phoneDisplay.addEventListener("countrychange", function() {
                    const countryData = iti.getSelectedCountryData();
                    const countryCode = countryData.iso2;
                    const digitLimit = limitDigitsByCountry(countryCode);
                    const currentLength = phoneDisplay.value.replace(/\D/g, "").length;
                    
                    updateValidationMessage(countryCode, currentLength, digitLimit);
                });

                const form = document.querySelector("form");

                if (form) {
                    form.addEventListener("submit", function(event) {
                        if (iti.isValidNumber()) {
                            phoneInput.value = iti.getNumber();
                        } else {
                            event.preventDefault();
                            alert("Por favor, ingresa un número de teléfono válido.");
                        }
                    });
                }

                if (phoneInput.value) {
                    iti.setNumber(phoneInput.value);
                    phoneDisplay.value = phoneInput.value;
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('userForm');
            
            // Función para limpiar todos los mensajes de error
            function clearAllErrors() {
                // Limpiar mensajes de error existentes
                const existingErrors = document.querySelectorAll('.error-message');
                existingErrors.forEach(error => error.remove());
                
                // Limpiar clases de error de los inputs
                const inputs = form.querySelectorAll('input');
                inputs.forEach(input => {
                    input.classList.remove('border-red-500');
                });
                
                // Limpiar mensajes de error específicos
                const errorElements = document.querySelectorAll('[id$="Error"]');
                errorElements.forEach(el => {
                    el.classList.add('hidden');
                    el.textContent = '';
                });
            }
            
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                
                // Limpiar todos los errores anteriores
                clearAllErrors();
                
                let hasErrors = false;
                
                // Validar nombre
                const name = document.getElementById('name');
                if (!name.value.trim()) {
                    document.getElementById('nameError').textContent = 'Por favor ingrese su nombre';
                    document.getElementById('nameError').classList.remove('hidden');
                    name.classList.add('border-red-500');
                    hasErrors = true;
                }
                
                // Validar email
                const email = document.querySelector('input[name="email"]');
                if (!email.value.trim()) {
                    const emailError = document.createElement('p');
                    emailError.className = 'text-red-500 mt-2 text-xs italic error-message';
                    emailError.textContent = 'Por favor ingrese su correo electrónico';
                    email.parentNode.appendChild(emailError);
                    email.classList.add('border-red-500');
                    hasErrors = true;
                }
                
                // Validar teléfono
                const phoneDisplay = document.getElementById('phone_display');
                if (!phoneDisplay.value.trim()) {
                    document.getElementById('phone-error').textContent = 'Por favor ingrese su número de teléfono';
                    document.getElementById('phone-error').classList.remove('hidden');
                    phoneDisplay.classList.add('border-red-500');
                    hasErrors = true;
                }
                
                // Validar contraseña
                const password = document.getElementById('password');
                if (!password.value.trim()) {
                    document.getElementById('passwordError').textContent = 'Por favor ingrese una contraseña';
                    document.getElementById('passwordError').classList.remove('hidden');
                    password.classList.add('border-red-500');
                    hasErrors = true;
                }
                
                // Validar confirmación de contraseña
                const passwordConfirmation = document.getElementById('password_confirmation');
                if (!passwordConfirmation.value.trim()) {
                    const confirmError = document.createElement('p');
                    confirmError.className = 'text-red-500 mt-2 text-xs italic error-message';
                    confirmError.textContent = 'Por favor confirme su contraseña';
                    passwordConfirmation.parentNode.appendChild(confirmError);
                    passwordConfirmation.classList.add('border-red-500');
                    hasErrors = true;
                }
                
                // Validar rol
                const role = document.querySelector('input[name="role"]:checked');
                if (!role) {
                    const roleError = document.createElement('p');
                    roleError.className = 'text-red-500 mt-2 text-xs italic error-message';
                    roleError.textContent = 'Por favor seleccione un rol';
                    document.querySelector('.space-y-4').appendChild(roleError);
                    hasErrors = true;
                }
                
                if (!hasErrors) {
                    form.submit();
                }
            });
        });
    </script>
@endsection

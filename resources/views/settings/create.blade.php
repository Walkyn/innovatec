@extends('layouts.app')
@section('title', 'Nexus - Configuración')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div class="mx-auto max-w-full">
                <!-- Breadcrumb Start -->
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-title-md2 font-bold text-black dark:text-white">
                        Página de configuración
                    </h2>

                    <nav>
                        <ol class="flex items-center gap-2">
                            <li>
                                <a class="font-medium" href="{{ route('home.index') }}">Panel /</a>
                            </li>
                            <li class="font-medium text-primary">Configuración</li>
                        </ol>
                    </nav>
                </div>
                <!-- Breadcrumb End -->

                <!-- ====== Alerts Start -->
                @include('partials.alerts')
                <!-- ====== Alerts End -->

                <!-- ====== Settings Section Start -->
                <div class="grid grid-cols-5 gap-8">
                    <!-- ====== Formulario Informacion Empresa Start -->
                    <div class="col-span-5 xl:col-span-3">
                        <div
                            class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                            <div
                                class="border-b border-stroke px-7 py-4 dark:border-strokedark">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                    <h3 class="font-medium text-black dark:text-white">
                                        Información de la empresa
                                    </h3>
                                    <!-- Modal toggle -->
                                    <button data-modal-target="modal-medios-pago" data-modal-toggle="modal-medios-pago"
                                        class="block text-white bg-primary hover:bg-opacity-90 focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded text-sm px-5 py-2.5 text-center dark:bg-primary dark:hover:bg-opacity-90 dark:focus:ring-primary"
                                        type="button">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.5 12.5C19.5 11.12 20.62 10 22 10V9C22 5 21 4 17 4H7C3 4 2 5 2 9V9.5C3.38 9.5 4.5 10.62 4.5 12C4.5 13.38 3.38 14.5 2 14.5V15C2 19 3 20 7 20H17C21 20 22 19 22 15C20.62 15 19.5 13.88 19.5 12.5Z"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M9 14.75L15 8.75" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M14.995 14.75H15.004" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M8.995 9.25H9.004" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            Medios de Pago
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <div class="p-7">
                                <form action="{{ route('settings.store') }}" method="POST">
                                    @csrf

                                    <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                                        <div class="w-full sm:w-1/2">
                                            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
                                                for="nombre">
                                                Nombre de la Empresa <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <span class="absolute left-4.5 top-4">
                                                    <svg class="fill-none stroke-current" width="20" height="20"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <g opacity="0.8" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M3 7V17H17V7" />
                                                            <path
                                                                d="M7 7V4C7 3.44772 7.44772 3 8 3H12C12.5523 3 13 3.44772 13 4V7" />
                                                            <path d="M8 10H12V14H8V10Z" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <input type="hidden" name="id" value="{{ $configuracion->id ?? '' }}">
                                                <input
                                                    class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                                    type="text" name="nombre" id="nombre" placeholder=""
                                                    value="{{ $configuracion->nombre ?? '' }}">
                                            </div>
                                        </div>

                                        <div class="w-full sm:w-1/2">
                                            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
                                                for="ruc">
                                                RUC <span class="text-red-500">*</span>
                                            </label>
                                            <input
                                                class="w-full rounded border border-stroke bg-gray px-4.5 py-3 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                                type="text" name="ruc" id="ruc" placeholder=""
                                                value="{{ $configuracion->ruc ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                                        <div class="w-full sm:w-1/2">
                                            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
                                                for="correo">Email</label>
                                            <div class="relative">
                                                <span class="absolute left-4.5 top-4">
                                                    <svg class="fill-current" width="20" height="20"
                                                        viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g opacity="0.8">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M3.33301 4.16667C2.87658 4.16667 2.49967 4.54357 2.49967 5V15C2.49967 15.4564 2.87658 15.8333 3.33301 15.8333H16.6663C17.1228 15.8333 17.4997 15.4564 17.4997 15V5C17.4997 4.54357 17.1228 4.16667 16.6663 4.16667H3.33301ZM0.833008 5C0.833008 3.6231 1.9561 2.5 3.33301 2.5H16.6663C18.0432 2.5 19.1663 3.6231 19.1663 5V15C19.1663 16.3769 18.0432 17.5 16.6663 17.5H3.33301C1.9561 17.5 0.833008 16.3769 0.833008 15V5Z"
                                                                fill="" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M0.983719 4.52215C1.24765 4.1451 1.76726 4.05341 2.1443 4.31734L9.99975 9.81615L17.8552 4.31734C18.2322 4.05341 18.7518 4.1451 19.0158 4.52215C19.2797 4.89919 19.188 5.4188 18.811 5.68272L10.4776 11.5161C10.1907 11.7169 9.80879 11.7169 9.52186 11.5161L1.18853 5.68272C0.811486 5.4188 0.719791 4.89919 0.983719 4.52215Z"
                                                                fill="" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <input
                                                    class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                                    type="email" name="correo" id="correo" placeholder=""
                                                    value="{{ $configuracion->correo ?? '' }}" />
                                            </div>
                                        </div>

                                        <div class="w-full sm:w-1/2">
                                            <label class="mb-3 block text-sm font-medium text-black dark:text-white"
                                                for="telefono">Teléfono</label>
                                            <input
                                                class="w-full rounded border border-stroke bg-gray px-4.5 py-3 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                                type="text" name="telefono" id="telefono" placeholder=""
                                                value="{{ $configuracion->telefono ?? '' }}" />
                                        </div>
                                    </div>

                                    <div class="mb-5.5">
                                        <label class="mb-3 block text-sm font-medium text-black dark:text-white"
                                            for="direccion">Dirección</label>
                                        <div class="relative">
                                            <span class="absolute left-4.5 top-4">
                                                <svg class="fill-none stroke-current" width="20" height="20"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.8" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path
                                                            d="M10 10.8333C11.3807 10.8333 12.5 9.71396 12.5 8.33329C12.5 6.95262 11.3807 5.83329 10 5.83329C8.61929 5.83329 7.5 6.95262 7.5 8.33329C7.5 9.71396 8.61929 10.8333 10 10.8333Z" />
                                                        <path
                                                            d="M16.6667 8.33329C16.6667 14.1666 10 17.5 10 17.5C10 17.5 3.33333 14.1666 3.33333 8.33329C3.33333 6.56518 4.03571 4.86953 5.28595 3.61929C6.53619 2.36905 8.23184 1.66663 10 1.66663C11.7681 1.66663 13.4638 2.36905 14.714 3.61929C15.9643 4.86953 16.6667 6.56518 16.6667 8.33329Z" />
                                                    </g>
                                                </svg>
                                            </span>
                                            <input
                                                class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                                type="text" name="direccion" id="direccion" placeholder=""
                                                value="{{ $configuracion->direccion ?? '' }}" />
                                        </div>
                                    </div>

                                    <div class="mb-5.5">
                                        <label class="mb-3 block text-sm font-medium text-black dark:text-white"
                                            for="descripcion">Descripción</label>
                                        <div class="relative">
                                            <span class="absolute left-4.5 top-4">
                                                <svg class="fill-current" width="20" height="20"
                                                    viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g opacity="0.8" clip-path="url(#clip0_88_10224)">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M1.56524 3.23223C2.03408 2.76339 2.66997 2.5 3.33301 2.5H9.16634C9.62658 2.5 9.99967 2.8731 9.99967 3.33333C9.99967 3.79357 9.62658 4.16667 9.16634 4.16667H3.33301C3.11199 4.16667 2.90003 4.25446 2.74375 4.41074C2.58747 4.56702 2.49967 4.77899 2.49967 5V16.6667C2.49967 16.8877 2.58747 17.0996 2.74375 17.2559C2.90003 17.4122 3.11199 17.5 3.33301 17.5H14.9997C15.2207 17.5 15.4326 17.4122 15.5889 17.2559C15.7452 17.0996 15.833 16.8877 15.833 16.6667V10.8333C15.833 10.3731 16.2061 10 16.6663 10C17.1266 10 17.4997 10.3731 17.4997 10.8333V16.6667C17.4997 17.3297 17.2363 17.9656 16.7674 18.4344C16.2986 18.9033 15.6627 19.1667 14.9997 19.1667H3.33301C2.66997 19.1667 2.03408 18.9033 1.56524 18.4344C1.0964 17.9656 0.833008 17.3297 0.833008 16.6667V5C0.833008 4.33696 1.0964 3.70107 1.56524 3.23223Z"
                                                            fill="" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M16.6664 2.39884C16.4185 2.39884 16.1809 2.49729 16.0056 2.67253L8.25216 10.426L7.81167 12.188L9.57365 11.7475L17.3271 3.99402C17.5023 3.81878 17.6008 3.5811 17.6008 3.33328C17.6008 3.08545 17.5023 2.84777 17.3271 2.67253C17.1519 2.49729 16.9142 2.39884 16.6664 2.39884ZM14.8271 1.49402C15.3149 1.00622 15.9765 0.732178 16.6664 0.732178C17.3562 0.732178 18.0178 1.00622 18.5056 1.49402C18.9934 1.98182 19.2675 2.64342 19.2675 3.33328C19.2675 4.02313 18.9934 4.68473 18.5056 5.17253L10.5889 13.0892C10.4821 13.196 10.3483 13.2718 10.2018 13.3084L6.86847 14.1417C6.58449 14.2127 6.28409 14.1295 6.0771 13.9225C5.87012 13.7156 5.78691 13.4151 5.85791 13.1312L6.69124 9.79783C6.72787 9.65131 6.80364 9.51749 6.91044 9.41069L14.8271 1.49402Z"
                                                            fill="" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_88_10224">
                                                            <rect width="20" height="20" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            <textarea
                                                class="w-full rounded border border-stroke bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                                name="descripcion" id="descripcion" rows="6" placeholder="">{{ $configuracion->descripcion ?? '' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="flex justify-end gap-4.5">
                                        <button onclick="window.location.href='{{ route('settings.index') }}'"
                                            class="flex justify-center rounded border border-stroke px-6 py-2 font-medium text-black hover:shadow-1 dark:border-strokedark dark:text-white"
                                            type="button">
                                            Cancelar
                                        </button>
                                        <button
                                            class="flex justify-center rounded bg-primary px-6 py-2 font-medium text-gray hover:bg-opacity-90"
                                            type="submit">
                                            Guardar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- ====== Formulario Redes Sociales Start -->
                    <div class="col-span-5 xl:col-span-2">
                        <div
                            class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                            <div class="border-b border-stroke px-7 py-4 dark:border-strokedark">
                                <h3 class="font-medium text-black dark:text-white">
                                    Redes Sociales
                                </h3>
                            </div>
                            <div class="p-7">
                                <form action="{{ route('settings.storeRedesSociales') }}" method="POST">
                                    @csrf
                                    <!-- Campo oculto para el ID -->
                                    <input type="hidden" name="id" value="{{ $configuracion->id ?? '' }}">

                                    <!-- Campo para Facebook -->
                                    <div class="mb-5.5">
                                        <label for="facebook"
                                            class="block mb-2 text-sm font-medium text-black dark:text-white">
                                            Facebook
                                        </label>
                                        <div class="relative">
                                            <span class="absolute left-4.5 top-1/2 transform -translate-y-1/2">
                                                <i class="fab fa-facebook-square text-xl text-blue-600"></i>
                                            </span>
                                            <input type="url" name="facebook" id="facebook"
                                                class="w-full rounded border {{ $errors->has('facebook') ? 'border-red-500' : 'border-stroke' }} bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                                placeholder="" value="{{ old('facebook', $configuracion->facebook ?? '') }}">
                                        </div>
                                        @error('facebook')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Campo para WhatsApp -->
                                    <div class="mb-5.5">
                                        <label for="whatsapp"
                                            class="block mb-2 text-sm font-medium text-black dark:text-white">
                                            WhatsApp
                                        </label>
                                        <div class="relative">
                                            <span class="absolute left-4.5 top-1/2 transform -translate-y-1/2">
                                                <i class="fab fa-whatsapp-square text-xl text-green-600"></i>
                                            </span>
                                            <input type="text" name="whatsapp" id="whatsapp"
                                                class="w-full rounded border {{ $errors->has('whatsapp') ? 'border-red-500' : 'border-stroke' }} bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                                placeholder="" value="{{ old('whatsapp', $configuracion->whatsapp ?? '') }}">
                                        </div>
                                        @error('whatsapp')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Campo para LinkedIn -->
                                    <div class="mb-5.5">
                                        <label for="linkedin"
                                            class="block mb-2 text-sm font-medium text-black dark:text-white">
                                            LinkedIn
                                        </label>
                                        <div class="relative">
                                            <span class="absolute left-4.5 top-1/2 transform -translate-y-1/2">
                                                <i class="fab fa-linkedin text-xl text-blue-500"></i>
                                            </span>
                                            <input type="url" name="linkedin" id="linkedin"
                                                class="w-full rounded border {{ $errors->has('linkedin') ? 'border-red-500' : 'border-stroke' }} bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                                placeholder="" value="{{ old('linkedin', $configuracion->linkedin ?? '') }}">
                                        </div>
                                        @error('linkedin')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Campo para Sitio Web -->
                                    <div class="mb-5.5">
                                        <label for="website"
                                            class="block mb-2 text-sm font-medium text-black dark:text-white">
                                            Sitio Web
                                        </label>
                                        <div class="relative">
                                            <span class="absolute left-4.5 top-1/2 transform -translate-y-1/2">
                                                <i class="fas fa-globe-americas text-xl text-green-500"></i>
                                            </span>
                                            <input type="url" name="website" id="website"
                                                class="w-full rounded border {{ $errors->has('website') ? 'border-red-500' : 'border-stroke' }} bg-gray py-3 pl-11.5 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary"
                                                placeholder="" value="{{ old('website', $configuracion->website ?? '') }}">
                                        </div>
                                        @error('website')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Botones de acción -->
                                    <div class="flex justify-end gap-4.5">
                                        <button onclick="window.location.href='{{ route('settings.index') }}'"
                                            class="flex justify-center rounded border border-stroke px-6 py-2 font-medium text-black hover:shadow-1 dark:border-strokedark dark:text-white"
                                            type="button">
                                            Cancelar
                                        </button>
                                        <button type="submit"
                                            class="flex justify-center rounded bg-primary px-6 py-2 font-medium text-gray hover:bg-opacity-90"
                                            type="submit">
                                            Guardar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Main modal -->
                    <div id="modal-medios-pago" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 py-20 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-3xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Agregar medios de Pago
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="modal-medios-pago">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Cerrar modal</span>
                                    </button>
                                </div>

                                <!-- Modal body -->
                                <div class="p-4 md:p-5">
                                    @if(session('success'))
                                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if(session('error'))
                                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    
                                    <!-- Formulario para agregar medio de pago -->
                                    <form action="{{ route('settings.storeMedioPago') }}" method="POST" class="mb-6" 
                                        x-data="{
                                            paymentType: '',
                                            accountNumber: '',
                                            errorMessage: '',
                                            validateNumber() {
                                                this.errorMessage = '';
                                                
                                                if (!this.accountNumber) return;
                                                
                                                if (this.paymentType === 'YAPE' || this.paymentType === 'PLIN') {
                                                    if (!/^9\d{8}$/.test(this.accountNumber)) {
                                                        this.errorMessage = 'El número de teléfono debe empezar con 9 y tener 9 dígitos';
                                                    }
                                                } else if (this.paymentType === 'BCP') {
                                                    // Validar cuenta BCP (14 dígitos)
                                                    if (!/^\d{14}$/.test(this.accountNumber)) {
                                                        this.errorMessage = 'El número de cuenta debe tener 14 dígitos';
                                                    }
                                                } else if (this.paymentType === 'BBVA') {
                                                    // Validar cuenta BBVA (20 dígitos)
                                                    if (!/^\d{20}$/.test(this.accountNumber)) {
                                                        this.errorMessage = 'El número de cuenta debe tener 20 dígitos';
                                                    }
                                                }
                                            }
                                        }">
                                        @csrf
                                        <div class="grid grid-cols-2 gap-4 mb-4">
                                            <!-- Tipo de Medio de Pago -->
                                            <div>
                                                <label for="payment_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Medio de Pago
                                                </label>
                                                <select id="payment_type" name="payment_type" required
                                                    x-model="paymentType"
                                                    @change="accountNumber = ''; errorMessage = '';"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                    <option value="">Seleccionar</option>
                                                    <option value="BCP">BCP</option>
                                                    <option value="BBVA">BBVA</option>
                                                    <option value="BN">Banco de la Nación</option>
                                                    <option value="CAJA_PIURA">Caja Piura</option>
                                                    <option value="YAPE">Yape</option>
                                                    <option value="PLIN">Plin</option>
                                                </select>
                                                <!-- Campo oculto para guardar el texto del medio de pago -->
                                                <input type="hidden" name="payment_type_text" id="payment_type_text">
                                            </div>

                                            <!-- Número de Cuenta/Teléfono -->
                                            <div>
                                                <label for="account_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    <span x-text="paymentType === 'YAPE' || paymentType === 'PLIN' ? 'Nº Teléfono' : 'Nº Cuenta'"></span>
                                                </label>
                                                <input type="text" name="account_number" id="account_number" required
                                                    x-model="accountNumber"
                                                    @input="validateNumber"
                                                    :placeholder="paymentType === 'YAPE' || paymentType === 'PLIN' ? 'Ingrese el número de teléfono' : 'Ingrese el número de cuenta'"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    :class="{'border-red-500': errorMessage}">
                                                <!-- Mensaje de error -->
                                                <p x-show="errorMessage" x-text="errorMessage" class="mt-2 text-sm text-red-600 dark:text-red-500"></p>
                                            </div>

                                            <!-- Titular -->
                                            <div class="col-span-2">
                                                <label for="holder_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Titular
                                                </label>
                                                <input type="text" name="holder_name" id="holder_name" required
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                                    placeholder="Ingrese el nombre del titular">
                                            </div>
                                        </div>

                                        <!-- Botón Agregar -->
                                        <button type="submit"
                                            :disabled="errorMessage !== ''"
                                            :class="{'opacity-50 cursor-not-allowed': errorMessage !== ''}"
                                            class="text-white inline-flex items-center bg-primary hover:bg-primary/90 focus:ring-4 focus:outline-none focus:ring-primary/30 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Agregar Medio de Pago
                                        </button>
                                    </form>

                                    <!-- Tabla de medios de pago -->
                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                        Medio de Pago
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                        Nº Cuenta/Teléfono
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                        Titular
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                                        Acciones
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($mediosPago as $medioPago)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="px-6 py-4">
                                                            <div class="flex items-center">
                                                                <div class="w-8 h-8 rounded-full mr-3 overflow-hidden">
                                                                    <img src="{{ asset('images/paymethods/' . strtolower($medioPago->tipo_pago) . '.png') }}" 
                                                                         alt="{{ $medioPago->nombre_tipo_pago }}" 
                                                                         class="w-full h-full object-cover">
                                                                </div>
                                                                <span>{{ $medioPago->nombre_tipo_pago }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            {{ $medioPago->numero_cuenta }}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            {{ $medioPago->titular }}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <button type="button" 
                                                                data-modal-target="modal-eliminar-{{ $medioPago->id }}"
                                                                data-modal-toggle="modal-eliminar-{{ $medioPago->id }}"
                                                                class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                                                Eliminar
                                                            </button>
                                                            
                                                            <!-- Modal de confirmación para este medio de pago específico -->
                                                            <div id="modal-eliminar-{{ $medioPago->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                <div class="relative w-full max-w-md max-h-full">
                                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-eliminar-{{ $medioPago->id }}">
                                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                            </svg>
                                                                            <span class="sr-only">Cerrar modal</span>
                                                                        </button>
                                                                        <div class="p-6 text-center">
                                                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                                            </svg>
                                                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Está seguro que desea eliminar este medio de pago?</h3>
                                                                            <form action="{{ route('settings.deleteMedioPago', $medioPago->id) }}" method="POST" class="inline">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                                                    Sí, eliminar
                                                                                </button>
                                                                            </form>
                                                                            <button data-modal-hide="modal-eliminar-{{ $medioPago->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancelar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                            No hay medios de pago registrados
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- ====== Settings Section End -->
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

    <!-- Agrega este script antes del cierre del main -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectPaymentType = document.getElementById('payment_type');
            const inputPaymentTypeText = document.getElementById('payment_type_text');
            
            selectPaymentType.addEventListener('change', function() {
                if (this.value) {
                    inputPaymentTypeText.value = this.options[this.selectedIndex].text;
                } else {
                    inputPaymentTypeText.value = '';
                }
            });
        });
    </script>

@endsection

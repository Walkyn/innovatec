@extends('layouts.app')
@section('title', 'Nexus - Registrar cliente')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Registrar cliente
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{ route('home.index') }}">Panel /</a>
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
            <div class="rounded-sm border dark:bg-gray-800 border-stroke bg-white shadow-default dark:border-strokedark">
                <div class="flex flex-wrap items-center">
                    <div class="hidden w-full xl:block xl:w-1/2">
                        <div class="px-26 py-17.5 text-center">
                            <a class="mb-5.5 inline-flex items-center" href="index.html">
                                <!-- Logo para modo oscuro -->
                                <img class="hidden dark:block h-10" src="{{ asset('logo.png') }}" alt="Logo" />
                                <!-- Logo para modo claro -->
                                <img class="dark:hidden h-10" src="{{ asset('logo.png') }}" alt="Logo" />
                                <!-- Texto al lado del logo -->
                                <span class="ml-3 text-lg font-semibold text-gray-700 dark:text-gray-300">Business
                                    Manager</span>
                            </a>

                            <p class="font-medium 2xl:px-20">
                                Registre nuevos clientes para acceder a nuestros planes de internet de alta velocidad y
                                soporte personalizado.
                            </p>

                            <span class="mt-15 inline-block">
                                <img src="{{ asset('images/illustration/illustration-03.svg') }}" alt="illustration" />
                            </span>
                        </div>
                    </div>

                    <div class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
                        <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                            <form action="{{ route('clients.store') }}" method="POST" class="dark:text-white">
                                @csrf

                                <!-- ====== Nombre - Apellido Section Start -->
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                            for="nombres">
                                            Nombres
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                            id="nombres" type="text" placeholder="" name="nombres"
                                            value="{{ old('nombres') }}">
                                        @if ($errors->has('nombres'))
                                            <p class="text-red-500 text-xs italic">{{ $errors->first('nombres') }}</p>
                                        @endif
                                    </div>
                                    <div class="w-full md:w-1/2 px-3">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                            for="apellidos">
                                            Apellidos
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                            id="apellidos" type="text" placeholder="" name="apellidos"
                                            value="{{ old('apellidos') }}">
                                        @if ($errors->has('apellidos'))
                                            <p class="text-red-500 text-xs italic">{{ $errors->first('apellidos') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <!-- ====== Nombre - Apellido Section End -->

                                <!-- ====== DNI - Telefono Section Start -->
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                            for="identificacion">
                                            Identificación
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border {{ $errors->has('identificacion') ? 'border-red-500' : 'border-gray-200' }} dark:border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                            id="identificacion" type="text" placeholder="" name="identificacion"
                                            value="{{ old('identificacion') }}">
                                        @if ($errors->has('identificacion'))
                                            <p class="text-red-500 text-xs italic">{{ $errors->first('identificacion') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="w-full md:w-1/2 px-3">
                                        <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2" for="telefono">
                                            Teléfono
                                        </label>
                                        <div class="relative">
                                            <input type="tel" id="phone_display" placeholder="917 319 939"
                                                class="appearance-none block w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600 rounded py-3 pl-[6.5rem] px-4 leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800" />
                                            <input type="hidden" id="phone" name="telefono" value="{{ old('telefono') }}" />
                                            <p id="phone-error" class="text-red-500 mt-2 text-xs italic hidden"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- ====== DNI - Telefono Section End -->

                                <!-- ====== Region - Provincia Section Start -->
                                <div class="flex flex-wrap -mx-3 mb-4">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                            for="region_id">
                                            Región
                                        </label>
                                        <div class="relative">
                                            <select id="region_id" name="region_id"
                                                class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border {{ $errors->has('region_id') ? 'border-red-500' : 'border-gray-200' }} dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                                required>
                                                <option value="" disabled selected>Seleccionar región</option>
                                                @foreach ($regiones as $region)
                                                    <option value="{{ $region->id }}"
                                                        {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                                        {{ $region->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                            for="provincia_id">
                                            Provincia
                                        </label>
                                        <div class="relative">
                                            <select id="provincia_id" name="provincia_id"
                                                class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border {{ $errors->has('provincia_id') ? 'border-red-500' : 'border-gray-200' }} dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                                required>
                                                <option value="" disabled selected>Seleccionar provincia</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- ====== Region - Provincia Section End -->

                                <!-- ====== Distrito - Pueblo Start -->
                                <div class="flex flex-wrap -mx-3 mb-4">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                            for="distrito_id">
                                            Distrito
                                        </label>
                                        <div class="relative">
                                            <select id="distrito_id" name="distrito_id"
                                                class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border {{ $errors->has('distrito_id') ? 'border-red-500' : 'border-gray-200' }} dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                                required>
                                                <option value="" disabled selected>Seleccionar</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                            for="pueblo">
                                            Zona
                                        </label>
                                        <div class="relative">
                                            <input list="pueblos_list"
                                                class="appearance-none block w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border {{ $errors->has('pueblo') ? 'border-red-500' : 'border-gray-200' }} dark:border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                                id="pueblo" name="pueblo"
                                                placeholder="Escribe o selecciona una zona" required
                                                value="{{ old('pueblo') }}"
                                                oninput="this.value = this.value.toUpperCase()">
                                            <datalist id="pueblos_list"></datalist>
                                        </div>
                                    </div>


                                </div>
                                <!-- ====== Distrito - Pueblo Section End -->

                                <!-- ====== Direccion - GPS Section Start -->
                                <div class="flex flex-wrap -mx-3 mb-2">
                                    <div class="w-full md:w-1/2 px-3">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                            for="direccion">
                                            Dirección
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border {{ $errors->has('direccion') ? 'border-red-500' : 'border-gray-200' }} dark:border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                            id="direccion" type="text" placeholder="" name="direccion"
                                            value="{{ old('direccion') }}">
                                        @if ($errors->has('direccion'))
                                            <p class="text-red-500 text-xs italic">{{ $errors->first('direccion') }}</p>
                                        @endif
                                    </div>

                                    <div class="w-full md:w-1/2 px-3 mb-2">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                            for="coordenadas">
                                            Coordenadas GPS
                                        </label>
                                        <div class="relative">
                                            <input type="text" id="gps" name="gps" placeholder="lat, lon"
                                                class="appearance-none block w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border {{ $errors->has('gps') ? 'border-red-500' : 'border-gray-200' }} dark:border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                                value="{{ old('gps') }}">
                                            @if ($errors->has('coordenadas'))
                                                <p class="text-red-500 text-xs italic">{{ $errors->first('coordenadas') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Campo de Estado -->
                                    <div class="hidden w-full md:w-1/3 px-3 mb-4 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                                            Estado
                                        </label>
                                        <div class="relative">
                                            <select name="estado_cliente"
                                                class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                                                <option value="activo"
                                                    {{ old('estado_cliente', 'activo') == 'activo' ? 'selected' : '' }}>
                                                    Activo</option>
                                                <option value="inactivo"
                                                    {{ old('estado_cliente') == 'inactivo' ? 'selected' : '' }}>Inactivo
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- ====== Direccion - GPS Section End -->

                                <div class="mb-5">
                                    <input type="submit" value="Registrar cliente"
                                        class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-3 font-medium text-white transition hover:bg-opacity-90" />
                                </div>
                                <div class="">
                                    <button type="button" onclick="window.location.href='{{ route('clients.index') }}'"
                                        class="w-full cursor-pointer rounded-lg border border-gray-500 bg-white p-3 font-medium text-gray-800 transition hover:bg-opacity-90">
                                        Cancelar
                                    </button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const regiones = @json($regiones);
            const regionSelect = document.getElementById('region_id');
            const provinciaSelect = document.getElementById('provincia_id');
            const distritoSelect = document.getElementById('distrito_id');
            const puebloInput = document.getElementById('pueblo');
            const pueblosList = document.getElementById('pueblos_list');

            let provincias = [];
            let distritos = [];
            let pueblos = [];

            // Inicializar el formulario si hay valores antiguos
            if ('{{ old('region_id') }}') {
                fetchProvincias('{{ old('region_id') }}', '{{ old('provincia_id') }}',
                    '{{ old('distrito_id') }}');
            }

            // Evento para cargar provincias cuando se selecciona una región
            regionSelect.addEventListener('change', function() {
                const regionId = this.value;
                fetchProvincias(regionId);
            });

            // Evento para cargar distritos cuando se selecciona una provincia
            provinciaSelect.addEventListener('change', function() {
                const provinciaId = this.value;
                fetchDistritos(provinciaId);
            });

            // Evento para cargar pueblos cuando se selecciona un distrito
            distritoSelect.addEventListener('change', function() {
                const distritoId = this.value;
                fetchPueblos(distritoId);
            });

            function fetchProvincias(regionId, provinciaId = null, distritoId = null) {
                const region = regiones.find(r => r.id == regionId);
                provincias = region ? region.provincias : [];
                provinciaSelect.innerHTML = '<option value="" disabled selected>Seleccionar provincia</option>';
                provincias.forEach(provincia => {
                    const option = document.createElement('option');
                    option.value = provincia.id;
                    option.textContent = provincia.nombre;
                    if (provinciaId && provincia.id == provinciaId) {
                        option.selected = true;
                    }
                    provinciaSelect.appendChild(option);
                });

                if (provinciaId) {
                    fetchDistritos(provinciaId, distritoId);
                } else {
                    distritoSelect.innerHTML = '<option value="" disabled selected>Seleccionar distrito</option>';
                    puebloInput.value = '';
                    pueblosList.innerHTML = '';
                }
            }

            function fetchDistritos(provinciaId, distritoId = null) {
                const provincia = provincias.find(p => p.id == provinciaId);
                distritos = provincia ? provincia.distritos : [];
                distritoSelect.innerHTML = '<option value="" disabled selected>Seleccionar distrito</option>';
                distritos.forEach(distrito => {
                    const option = document.createElement('option');
                    option.value = distrito.id;
                    option.textContent = distrito.nombre;
                    if (distritoId && distrito.id == distritoId) {
                        option.selected = true;
                    }
                    distritoSelect.appendChild(option);
                });

                if (distritoId) {
                    fetchPueblos(distritoId);
                } else {
                    puebloInput.value = '';
                    pueblosList.innerHTML = '';
                }
            }

            function fetchPueblos(distritoId) {
                const distrito = distritos.find(d => d.id == distritoId);
                pueblos = distrito ? distrito.pueblos : [];
                puebloInput.value = '{{ old('pueblo') }}';
                pueblosList.innerHTML = '';
                pueblos.forEach(pueblo => {
                    const option = document.createElement('option');
                    option.value = pueblo.nombre;
                    option.textContent = pueblo.nombre;
                    pueblosList.appendChild(option);
                });
            }
        });
    </script>

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
                    initialCountry: "pe",
                    formatOnDisplay: false,
                    nationalMode: false,
                    autoPlaceholder: 'off'
                });

                const formatPhoneNumber = (number) => {
                    const cleaned = number.replace(/\D/g, "");
                    const match = cleaned.match(/^(\d{0,3})(\d{0,3})(\d{0,3})$/);
                    if (match) {
                        return match.slice(1).filter(Boolean).join(" ");
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

                phoneDisplay.addEventListener("input", function(e) {
                    let phoneNumberOnly = this.value.replace(/\D/g, "");
                    const countryData = iti.getSelectedCountryData();
                    const countryCode = countryData.iso2;
                    const digitLimit = limitDigitsByCountry(countryCode);

                    // Limitar la longitud
                    if (phoneNumberOnly.length > digitLimit) {
                        phoneNumberOnly = phoneNumberOnly.slice(0, digitLimit);
                    }

                    // Formatear para mostrar en el input
                    this.value = formatPhoneNumber(phoneNumberOnly);

                    // Guardar el número completo con código de país en el input oculto
                    const fullNumber = "+" + countryData.dialCode + phoneNumberOnly;
                    phoneInput.value = fullNumber;

                    // Validación y mensajes de error
                    const actualLength = phoneNumberOnly.length;
                    if (actualLength < digitLimit) {
                        phoneError.textContent = `Por favor, ingrese ${digitLimit} dígitos para ${countryData.name}. Te faltan ${digitLimit - actualLength} dígitos.`;
                        phoneError.classList.remove('hidden');
                        phoneDisplay.classList.add('border-red-500');
                        phoneDisplay.classList.remove('border-green-500');
                    } else if (actualLength === digitLimit) {
                        phoneError.classList.add('hidden');
                        phoneDisplay.classList.remove('border-red-500');
                        phoneDisplay.classList.add('border-green-500');
                    }
                });

                phoneDisplay.addEventListener("countrychange", function() {
                    const countryData = iti.getSelectedCountryData();
                    const phoneNumberOnly = this.value.replace(/\D/g, "");
                    const fullNumber = "+" + countryData.dialCode + phoneNumberOnly;
                    phoneInput.value = fullNumber;
                    
                    // Disparar el evento input para actualizar la validación
                    this.dispatchEvent(new Event('input'));
                });

                // Inicializar con valor existente si hay uno
                if (phoneInput.value) {
                    iti.setNumber(phoneInput.value);
                    const countryData = iti.getSelectedCountryData();
                    const nationalNumber = iti.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
                    phoneDisplay.value = nationalNumber.replace(/[^\d]/g, "").replace(/(\d{3})(\d{3})(\d{3})/, "$1 $2 $3").trim();
                }
            }
        });
    </script>

    <style>
        /* Mantenemos solo los estilos base de iti que no se pueden replicar con Tailwind */
        .iti {
            @apply w-full;
        }
        .iti__country-list {
            @apply w-[360px] max-h-[300px];
        }
        .iti__country {
            @apply flex items-center p-2;
        }
        .iti__country-name {
            @apply ml-2.5 text-sm;
        }
        .iti__dial-code {
            @apply text-gray-500 text-sm;
        }
        .iti__flag-container {
            @apply p-0;
        }
        .iti--separate-dial-code .iti__selected-flag {
            @apply bg-white dark:bg-gray-800 border-0 rounded-l-lg w-[65px];
        }
        .dark .iti--separate-dial-code .iti__selected-flag {
            @apply bg-gray-800 border border-gray-600;
        }
        .iti--separate-dial-code input {
            @apply pl-[75px] border border-gray-200 dark:border-gray-600 rounded-lg h-[45px] text-sm shadow-sm;
        }
        .iti--separate-dial-code .iti__selected-dial-code {
            @apply ml-1 text-gray-700 dark:text-gray-300;
        }
        .iti--separate-dial-code input:hover,
        .iti--separate-dial-code input:focus {
            @apply border-gray-300 dark:border-gray-500 outline-none;
        }
        .iti {
            @apply flex items-stretch;
        }
    </style>

@endsection

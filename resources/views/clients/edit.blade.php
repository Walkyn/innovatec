@extends('layouts.app')
@section('title', 'Nexus - Modificar cliente')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Modificar cliente
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{ route('home.index') }}">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Modificar</li>
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
                                Actualiza los datos de tus clientes para acceder a nuestros planes de internet de alta
                                velocidad y
                                soporte personalizado.
                            </p>

                            <span class="mt-15 inline-block">
                                <img src="{{ asset('images/illustration/illustration-03.svg') }}" alt="illustration" />
                            </span>
                        </div>
                    </div>

                    <div class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
                        <div class="w-full p-4 sm:p-12.5 xl:p-17.5">
                            <form action="{{ route('clients.update', $cliente->id) }}" method="POST"
                                class="dark:text-white">
                                @csrf
                                @method('PUT')

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
                                            value="{{ old('nombres', $cliente->nombres) }}">
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
                                            value="{{ old('apellidos', $cliente->apellidos) }}">
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
                                            value="{{ old('identificacion', $cliente->identificacion) }}">
                                        @if ($errors->has('identificacion'))
                                            <p class="text-red-500 text-xs italic">{{ $errors->first('identificacion') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="w-full md:w-1/2 px-3">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                            for="telefono">
                                            Telefono
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border {{ $errors->has('telefono') ? 'border-red-500' : 'border-gray-200' }} dark:border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                            id="telefono" type="text" placeholder="" name="telefono"
                                            value="{{ old('telefono', $cliente->telefono) }}">
                                        @if ($errors->has('telefono'))
                                            <p class="text-red-500 text-xs italic">{{ $errors->first('telefono') }}</p>
                                        @endif
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
                                                <option value="" disabled>Seleccionar región</option>
                                                @foreach ($regiones as $region)
                                                    <option value="{{ $region->id }}"
                                                        {{ old('region_id', $cliente->region_id) == $region->id ? 'selected' : '' }}>
                                                        {{ $region->nombre }}
                                                    </option>
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
                                                data-selected="{{ $cliente->provincia_id }}"
                                                class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border {{ $errors->has('provincia_id') ? 'border-red-500' : 'border-gray-200' }} dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                                required>
                                                <option value="" disabled>Seleccionar provincia</option>
                                                @if ($cliente->region)
                                                    @foreach ($cliente->region->provincias as $provincia)
                                                        <option value="{{ $provincia->id }}"
                                                            {{ old('provincia_id', $cliente->provincia_id) == $provincia->id ? 'selected' : '' }}>
                                                            {{ $provincia->nombre }}
                                                        </option>
                                                    @endforeach
                                                @endif
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
                                                data-selected="{{ $cliente->distrito_id }}"
                                                class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border {{ $errors->has('distrito_id') ? 'border-red-500' : 'border-gray-200' }} dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                                required>
                                                <option value="" disabled>Seleccionar distrito</option>
                                                @if ($cliente->provincia)
                                                    @foreach ($cliente->provincia->distritos as $distrito)
                                                        <option value="{{ $distrito->id }}"
                                                            {{ old('distrito_id', $cliente->distrito_id) == $distrito->id ? 'selected' : '' }}>
                                                            {{ $distrito->nombre }}
                                                        </option>
                                                    @endforeach
                                                @endif
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
                                                value="{{ old('pueblo', $cliente->pueblo->nombre ?? '') }}"
                                                oninput="this.value = this.value.toUpperCase()">
                                            <datalist id="pueblos_list">
                                                @if ($cliente->distrito)
                                                    @foreach ($cliente->distrito->pueblos as $pueblo)
                                                        <option value="{{ $pueblo->nombre }}">
                                                    @endforeach
                                                @endif
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                                <!-- ====== Distrito - Pueblo Section End -->

                                <!-- ====== Dirección Start -->
                                <div class="flex flex-wrap -mx-3 mb-2">

                                    <div class="w-full md:w-full px-3">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                            for="direccion">
                                            Dirección
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border {{ $errors->has('direccion') ? 'border-red-500' : 'border-gray-200' }} dark:border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                            id="direccion" type="text" placeholder="" name="direccion"
                                            value="{{ old('direccion', $cliente->direccion) }}">
                                        @if ($errors->has('direccion'))
                                            <p class="text-red-500 text-xs italic">{{ $errors->first('direccion') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <!-- ====== Dirección End -->

                                <!-- ====== Direccion - GPS Section Start -->
                                <div class="flex flex-wrap -mx-3 mb-6">

                                    <!-- Coordenadas GPS -->
                                    <div class="w-full md:w-1/2 px-3 mb-2">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                            for="coordenadas">
                                            Coordenadas GPS
                                        </label>
                                        <div class="relative">
                                            <input type="text" id="gps" name="gps" placeholder="lat, lon"
                                                class="appearance-none block w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border {{ $errors->has('gps') ? 'border-red-500' : 'border-gray-200' }} dark:border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                                value="{{ old('gps', $cliente->gps) }}">
                                            @if ($errors->has('coordenadas'))
                                                <p class="text-red-500 text-xs italic">{{ $errors->first('coordenadas') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Campo de Estado -->
                                    <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                                            Estado
                                        </label>
                                        <div class="relative">
                                            <select name="estado_cliente"
                                                class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                                                <option value="activo"
                                                    {{ old('estado_cliente', $cliente->estado_cliente) == 'activo' ? 'selected' : '' }}>
                                                    Activo</option>
                                                <option value="inactivo"
                                                    {{ old('estado_cliente', $cliente->estado_cliente) == 'inactivo' ? 'selected' : '' }}>
                                                    Inactivo</option>
                                                    <option value="suspendido"
                                                    {{ old('estado_cliente', $cliente->estado_cliente) == 'suspendido' ? 'selected' : '' }}>
                                                    Suspendido</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- ====== Direccion - GPS Section End -->

                                <!-- Botones -->
                                <div class="mb-5">
                                    <input type="submit" value="Actualizar cliente"
                                        class="w-full cursor-pointer rounded-lg border border-primary bg-primary p-3 font-medium text-white transition hover:bg-opacity-90" />
                                </div>
                                <div class="">
                                    <button type="button" onclick="window.location.href='{{ route('clients.index') }}'"
                                        class="w-full cursor-pointer rounded-lg border border-gray-500 bg-white p-3 font-medium text-gray-800 transition hover:bg-opacity-90">
                                        Cancelar
                                    </button>
                                </div>
                            </form>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const regionSelect = document.getElementById('region_id');
                                    const provinciaSelect = document.getElementById('provincia_id');
                                    const distritoSelect = document.getElementById('distrito_id');
                                    const puebloInput = document.getElementById('pueblo');
                                    const pueblosList = document.getElementById('pueblos_list');

                                    // Función para cargar provincias
                                    function cargarProvincias(regionId) {
                                        fetch(`/regiones/${regionId}/provincias`)
                                            .then(response => response.json())
                                            .then(data => {
                                                provinciaSelect.innerHTML = '<option value="" disabled>Seleccionar provincia</option>';
                                                data.forEach(provincia => {
                                                    const option = document.createElement('option');
                                                    option.value = provincia.id;
                                                    option.textContent = provincia.nombre;
                                                    if (provincia.id == provinciaSelect.dataset.selected) {
                                                        option.selected = true;
                                                    }
                                                    provinciaSelect.appendChild(option);
                                                });
                                                provinciaSelect.disabled = false;
                                            });
                                    }

                                    // Función para cargar distritos
                                    function cargarDistritos(provinciaId) {
                                        fetch(`/provincias/${provinciaId}/distritos`)
                                            .then(response => response.json())
                                            .then(data => {
                                                distritoSelect.innerHTML = '<option value="" disabled>Seleccionar distrito</option>';
                                                data.forEach(distrito => {
                                                    const option = document.createElement('option');
                                                    option.value = distrito.id;
                                                    option.textContent = distrito.nombre;
                                                    if (distrito.id == distritoSelect.dataset.selected) {
                                                        option.selected = true;
                                                    }
                                                    distritoSelect.appendChild(option);
                                                });
                                                distritoSelect.disabled = false;
                                            });
                                    }

                                    // Función para cargar pueblos
                                    function cargarPueblos(distritoId) {
                                        fetch(`/distritos/${distritoId}/pueblos`)
                                            .then(response => response.json())
                                            .then(data => {
                                                pueblosList.innerHTML = '';
                                                data.forEach(pueblo => {
                                                    const option = document.createElement('option');
                                                    option.value = pueblo.nombre;
                                                    pueblosList.appendChild(option);
                                                });
                                            });
                                    }

                                    // Cargar provincias cuando se selecciona una región
                                    regionSelect.addEventListener('change', function() {
                                        const regionId = this.value;
                                        cargarProvincias(regionId);
                                    });

                                    // Cargar distritos cuando se selecciona una provincia
                                    provinciaSelect.addEventListener('change', function() {
                                        const provinciaId = this.value;
                                        cargarDistritos(provinciaId);
                                    });

                                    // Cargar pueblos cuando se selecciona un distrito
                                    distritoSelect.addEventListener('change', function() {
                                        const distritoId = this.value;
                                        cargarPueblos(distritoId);
                                    });

                                    // Cargar datos iniciales si hay valores seleccionados
                                    if (regionSelect.value) {
                                        cargarProvincias(regionSelect.value);
                                    }
                                    if (provinciaSelect.value) {
                                        cargarDistritos(provinciaSelect.value);
                                    }
                                    if (distritoSelect.value) {
                                        cargarPueblos(distritoSelect.value);
                                    }
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

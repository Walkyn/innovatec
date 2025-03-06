<!-- Main modal -->
<div id="edit-client-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 py-20 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <form>
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Actualizar Cliente
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="edit-client-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="{{ route('clients.store') }}" method="POST" class="dark:text-white">
                    @csrf
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">


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
                                    <p class="text-red-500 text-xs italic">
                                        {{ $errors->first('nombres') }}</p>
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
                                    <p class="text-red-500 text-xs italic">
                                        {{ $errors->first('apellidos') }}</p>
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
                                    <p class="text-red-500 text-xs italic">
                                        {{ $errors->first('identificacion') }}
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
                                    value="{{ old('telefono') }}">
                                @if ($errors->has('telefono'))
                                    <p class="text-red-500 text-xs italic">
                                        {{ $errors->first('telefono') }}</p>
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
                                        <option value="" disabled selected>Seleccionar
                                            región</option>
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
                                        <option value="" disabled selected>Seleccionar
                                            provincia</option>
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
                                        <option value="" disabled selected>Seleccionar
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                    for="pueblo">
                                    Pueblo
                                </label>
                                <div class="relative">
                                    <input list="pueblos_list"
                                        class="appearance-none block w-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border {{ $errors->has('pueblo') ? 'border-red-500' : 'border-gray-200' }} dark:border-gray-600 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                                        id="pueblo" name="pueblo" placeholder="Escribe o selecciona un pueblo"
                                        required value="{{ old('pueblo') }}"
                                        oninput="this.value = this.value.toUpperCase()">
                                    <datalist id="pueblos_list"></datalist>
                                </div>
                            </div>


                        </div>
                        <!-- ====== Distrito - Pueblo Section End -->

                        <!-- ====== Direccion - GPS Section Start -->
                        <div class="flex flex-wrap -mx-3 mb-2">
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
                                        <p class="text-red-500 text-xs italic">
                                            {{ $errors->first('coordenadas') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

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
                                    <p class="text-red-500 text-xs italic">
                                        {{ $errors->first('direccion') }}</p>
                                @endif
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
                                            {{ old('estado_cliente') == 'inactivo' ? 'selected' : '' }}>
                                            Inactivo
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- ====== Direccion - GPS Section End -->
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="edit-client-modal" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Modificar
                            Cliente</button>
                        <button data-modal-hide="edit-client-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
                    </div>
                </form>
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
            </div>
    </div>
</div>

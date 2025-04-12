<main class="h-full pb-16 overflow-y-auto">
    <div>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 mt-2">
            <!-- Título -->
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300 mb-4 md:mb-0">
                Lista de cobranzas
            </h4>

            <!-- Botones de Acción -->
            <div class="w-full md:w-auto flex flex-col space-y-2 md:space-y-0 md:flex-row md:space-x-3">
                <!-- Botón de Opciones -->
                <button id="optionsDropdownButton" data-dropdown-toggle="optionsDropdown"
                    class="w-full md:w-auto flex items-center justify-center py-2 px-8 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded shadow-sm border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    type="button">
                    Opciones
                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </button>
                <div id="optionsDropdown"
                    class="z-10 hidden w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="optionsDropdownButton">
                        <li>
                            <button type="button" id="btn-hoy"
                                class="w-full text-left block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                Hoy
                            </button>
                        </li>
                        <li>
                            <button type="button" id="btn-todos"
                                class="w-full text-left block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                Todos
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Botón de Filtros -->
                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                    class="w-full md:w-auto flex items-center justify-center py-2 px-8 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded shadow-sm border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                        class="h-4 w-4 mr-1.5 -ml-1 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                            clip-rule="evenodd" />
                    </svg>
                    Filtrar
                    <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </button>

                <div id="filterDropdown"
                    class="z-10 hidden px-3 pt-1 bg-white rounded-lg shadow w-80 dark:bg-gray-700 right-0">
                    <div class="flex items-center justify-between pt-2">
                        <h6 class="text-sm font-medium text-black dark:text-white">Filtros</h6>
                        <div class="flex items-center space-x-3">
                            <button type="button" id="limpiar-filtros"
                                class="flex items-center text-sm font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                Limpiar filtros
                            </button>
                        </div>
                    </div>
                    <div id="accordion-flush" data-accordion="collapse" data-active-classes="text-black dark:text-white"
                        data-inactive-classes="text-gray-500 dark:text-gray-400">
                        <!-- Fecha -->
                        <h2 id="fecha-heading">
                            <button type="button"
                                class="flex items-center justify-between w-full py-2 px-1.5 text-sm font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700"
                                data-accordion-target="#fecha-body" aria-expanded="true" aria-controls="fecha-body">
                                <span>Fecha</span>
                                <svg aria-hidden="true" data-accordion-icon="" class="w-5 h-5 rotate-180 shrink-0"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                        </h2>
                        <div id="fecha-body" class="hidden" aria-labelledby="fecha-heading">
                            <div class="py-2 font-light border-b border-gray-200 dark:border-gray-600">
                                <div class="space-y-2">
                                    <div>
                                        <label for="fecha_inicio"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha
                                            Inicio</label>
                                        <input type="date" id="fecha_inicio" name="fecha_inicio"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label for="fecha_fin"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha
                                            Fin</label>
                                        <input type="date" id="fecha_fin" name="fecha_fin"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tipo de Pago -->
                        <h2 id="tipo-pago-heading">
                            <button type="button"
                                class="flex items-center justify-between w-full py-2 px-1.5 text-sm font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700"
                                data-accordion-target="#tipo-pago-body" aria-expanded="true"
                                aria-controls="tipo-pago-body">
                                <span>Tipo de Pago</span>
                                <svg aria-hidden="true" data-accordion-icon="" class="w-5 h-5 rotate-180 shrink-0"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                        </h2>
                        <div id="tipo-pago-body" class="hidden" aria-labelledby="tipo-pago-heading">
                            <div class="py-2 font-light border-b border-gray-200 dark:border-gray-600">
                                <ul class="space-y-2">
                                    <li class="flex items-center">
                                        <input id="efectivo" type="checkbox" name="tipo_pago" value="efectivo"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="efectivo"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Efectivo</label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="deposito" type="checkbox" name="tipo_pago" value="deposito"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="deposito"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Depósito</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Estado de Pago -->
                        <h2 id="estado-pago-heading">
                            <button type="button"
                                class="flex items-center justify-between w-full py-2 px-1.5 text-sm font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700"
                                data-accordion-target="#estado-pago-body" aria-expanded="true"
                                aria-controls="estado-pago-body">
                                <span>Estado de Pago</span>
                                <svg aria-hidden="true" data-accordion-icon="" class="w-5 h-5 rotate-180 shrink-0"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                        </h2>
                        <div id="estado-pago-body" class="hidden" aria-labelledby="estado-pago-heading">
                            <div class="py-2 font-light border-b border-gray-200 dark:border-gray-600">
                                <ul class="space-y-2">
                                    <li class="flex items-center">
                                        <input id="emitido" type="checkbox" name="estado_pago" value="emitido"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="emitido"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Emitido</label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="anulado" type="checkbox" name="estado_pago" value="anulado"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="anulado"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Anulado</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Usuario -->
                        <h2 id="usuario-heading">
                            <button type="button"
                                class="flex items-center justify-between w-full py-2 px-1.5 text-sm font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700"
                                data-accordion-target="#usuario-body" aria-expanded="true"
                                aria-controls="usuario-body">
                                <span>Usuario</span>
                                <svg aria-hidden="true" data-accordion-icon="" class="w-5 h-5 rotate-180 shrink-0"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                        </h2>
                        <div id="usuario-body" class="hidden" aria-labelledby="usuario-heading">
                            <div class="py-2 font-light border-b border-gray-200 dark:border-gray-600">
                                <ul class="space-y-2">
                                    @foreach ($usuarios ?? [] as $usuario)
                                        <li class="flex items-center">
                                            <input id="usuario-{{ $usuario->id }}" type="checkbox" name="usuario"
                                                value="{{ $usuario->id }}"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="usuario-{{ $usuario->id }}"
                                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $usuario->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <button data-modal-target="cobro-modal" data-modal-toggle="cobro-modal" type="button"
                    class="w-full md:w-auto flex items-center justify-center px-6 py-2 text-sm font-medium leading-5 text-white bg-green-600 rounded shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-hand-holding-usd mr-2"></i>
                    Nuevo Cobro
                </button>
            </div>
        </div>

        <!-- Buscador -->
        <div class="mb-4">
            <form action="{{ route('payments.index') }}" method="GET" class="w-full">
                <label for="search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                        @if (request('search'))
                            <a href="{{ route('payments.index') }}"
                                class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 cursor-pointer">
                                <i class="fas fa-times"></i>
                            </a>
                        @else
                            <div class="pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <input type="search" id="search" name="search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar por boleta, nombre o apellido..." value="{{ request('search') }}"
                        required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                </div>
            </form>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <div class="max-h-[500px] overflow-y-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead class="sticky top-0 bg-gray-50 dark:bg-gray-800">
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 dark:text-gray-400">
                                <th class="px-4 py-3">Boleta</th>
                                <th class="px-4 py-3">Cliente</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3">Fecha</th>
                                <th class="px-4 py-3">Pago</th>
                                <th class="px-4 py-3">Estado</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @forelse($cobranzas as $cobranza)
                                <tr class="text-gray-700 dark:text-gray-400"
                                    data-usuario-id="{{ $cobranza->usuario_id }}">
                                    <td class="px-4 py-3 text-sm">B{{ $cobranza->numero_boleta }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p class="font-semibold">{{ $cobranza->cliente->nombres }}
                                                {{ $cobranza->cliente->apellidos }}</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if ($cobranza->estado_cobro === 'anulado')
                                            <span class="line-through text-gray-500">S/
                                                {{ number_format($cobranza->monto_total, 2) }}</span>
                                        @else
                                            <span class="whitespace-nowrap">S/
                                                {{ number_format($cobranza->monto_total, 2) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $cobranza->fecha_cobro->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3 text-sm">{{ ucfirst($cobranza->tipo_pago) }}</td>
                                    <td class="px-4 py-3 text-xs">
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight rounded-full flex items-center {{ $cobranza->estado_cobro === 'emitido' ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100' }}">
                                            <i
                                                class="fas {{ $cobranza->estado_cobro === 'emitido' ? 'fa-check-circle mr-2' : 'fa-times-circle mr-2' }}"></i>
                                            {{ ucfirst($cobranza->estado_cobro) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-2 text-sm">
                                            <!-- Botón Imprimir -->
                                            <button
                                                class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-md hover:bg-green-100 focus:outline-none focus:ring-1 focus:ring-green-300 focus:ring-offset-1 dark:text-green-200 dark:bg-green-900 dark:border-green-700 dark:hover:bg-green-800 dark:focus:ring-green-600"
                                                aria-label="Imprimir">
                                                <i class="fas fa-print"></i>
                                            </button>

                                            <!-- Botón Exportar a PDF -->
                                            <a href="{{ route('payments.pdf', $cobranza->id) }}" target="_blank"
                                                class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-purple-600 bg-purple-50 border border-purple-200 rounded-md hover:bg-purple-100 focus:outline-none focus:ring-1 focus:ring-purple-300 focus:ring-offset-1 dark:text-purple-200 dark:bg-purple-900 dark:border-purple-700 dark:hover:bg-purple-800 dark:focus:ring-purple-600"
                                                aria-label="Exportar a PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>

                                            <!-- Botón Ver -->
                                            <button data-modal-target="ver-cobro-modal"
                                                data-modal-toggle="ver-cobro-modal" type="button"
                                                data-cobranza-id="{{ $cobranza->id }}"
                                                class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-md hover:bg-blue-100 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-offset-1 dark:text-blue-200 dark:bg-blue-900 dark:border-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-600"
                                                aria-label="Ver">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <!-- Botón Anular -->
                                            @if ($cobranza->estado_cobro !== 'anulado')
                                                <button data-cobranza-id="{{ $cobranza->id }}"
                                                    class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-yellow-600 bg-yellow-50 border border-yellow-200 rounded-md hover:bg-yellow-100 focus:outline-none focus:ring-1 focus:ring-yellow-300 focus:ring-offset-1 dark:text-yellow-200 dark:bg-yellow-900 dark:border-yellow-700 dark:hover:bg-yellow-800 dark:focus:ring-yellow-600 btn-anular"
                                                    aria-label="Anular">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7"
                                        class="px-4 py-3 text-sm text-center text-gray-500 dark:text-gray-400">
                                        No hay cobranzas registradas
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Botones de filtro
        document.getElementById('btn-hoy').addEventListener('click', function() {
            const url = new URL(window.location.href);
            url.searchParams.delete('todos');
            url.searchParams.set('fecha_inicio', '{{ now()->format('Y-m-d') }}');
            window.location.href = url.toString();
        });

        document.getElementById('btn-todos').addEventListener('click', function() {
            const url = new URL(window.location.href);
            // Limpiar todos los parámetros de fecha
            url.searchParams.delete('fecha_inicio');
            url.searchParams.delete('fecha_fin');
            url.searchParams.set('todos', '1');
            window.location.href = url.toString();
        });

        // Si no hay ningún parámetro en la URL, mostrar los cobros de hoy por defecto
        const urlParams = new URLSearchParams(window.location.search);
        if (!urlParams.has('fecha_inicio') && !urlParams.has('fecha_fin') && !urlParams.has('search') && !
            urlParams.has('todos')) {
            const url = new URL(window.location.href);
            url.searchParams.set('fecha_inicio', '{{ now()->format('Y-m-d') }}');
            window.location.href = url.toString();
        }

        // Función para mostrar el modal de confirmación de anulación
        const mostrarConfirmacionAnulacion = (cobranzaId) => {
            const modal = document.createElement('div');
            modal.className = 'relative z-[100]';
            modal.setAttribute('aria-labelledby', 'modal-title');
            modal.setAttribute('role', 'dialog');
            modal.setAttribute('aria-modal', 'true');

            modal.innerHTML = `
                <div class="fixed inset-0 bg-gray-900/75 dark:bg-gray-900/90 transition-opacity"></div>
                <div class="fixed inset-0 z-[100] w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-700 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <div class="bg-white dark:bg-gray-700 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900 sm:mx-0 sm:h-10 sm:w-10">
                                        <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-200"></i>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white" id="modal-title">
                                            Confirmar anulación
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500 dark:text-gray-300">
                                                ¿Está seguro que desea anular este cobro? Esta acción no se puede deshacer.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-600 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="button" id="confirmar-anulacion"
                                    class="inline-flex w-full justify-center rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-500 sm:ml-3 sm:w-auto">
                                    Confirmar
                                </button>
                                <button type="button" id="cancelar-anulacion"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);

            // Manejar la confirmación
            document.getElementById('confirmar-anulacion').addEventListener('click', async () => {
                try {
                    // Verificar permisos antes de hacer la petición
                    const tienePermisos = <?php echo json_encode(auth()->user()->checkModuloAcceso('payments', 'actualizar')); ?>;
                    
                    if (!tienePermisos) {
                        // Mostrar toast de error centrado con overlay
                        const toastError = document.createElement('div');
                        toastError.className = 'fixed inset-0 flex items-center justify-center z-50';
                        toastError.innerHTML = `
                            <div class="fixed inset-0 bg-gray-900/75 dark:bg-gray-900/90 transition-opacity"></div>
                            <div class="relative z-[60] flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800" role="alert">
                                <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                                    </svg>
                                    <span class="sr-only">Error icon</span>
                                </div>
                                <div class="ms-3 text-sm font-normal">Sin permisos para anular cobros.</div>
                                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" onclick="this.parentElement.parentElement.remove()" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                </button>
                            </div>
                        `;
                        document.body.appendChild(toastError);
                        setTimeout(() => {
                            toastError.remove();
                        }, 3000);
                        return;
                    }

                    const response = await fetch(`/payments/${cobranzaId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        document.body.removeChild(modal);
                        // Mostrar mensaje de éxito
                        const successModal = document.createElement('div');
                        successModal.innerHTML = `
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                    <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                        <div class="bg-white dark:bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                                    <i class="fas fa-check text-green-600"></i>
                                                </div>
                                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                    <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white" id="modal-title">Éxito</h3>
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-500 dark:text-gray-400">${data.message}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                            <button type="button" id="aceptar-anulacion" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">Aceptar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        document.body.appendChild(successModal);

                        // Manejar el botón de aceptar
                        document.getElementById('aceptar-anulacion').addEventListener('click', () => {
                            document.body.removeChild(successModal);
                            window.location.reload();
                        });
                    } else {
                        throw new Error(data.message);
                    }
                } catch (error) {
                    document.body.removeChild(modal);
                    alert(error.message);
                }
            });

            // Manejar la cancelación
            document.getElementById('cancelar-anulacion').addEventListener('click', () => {
                document.body.removeChild(modal);
            });
        };

        // Agregar evento a los botones de anular
        document.querySelectorAll('.btn-anular').forEach(button => {
            button.addEventListener('click', () => {
                const tienePermisos = <?php echo json_encode(auth()->user()->checkModuloAcceso('payments', 'eliminar')); ?>;
                
                if (!tienePermisos) {
                    // Mostrar toast de error centrado con overlay
                    const toastError = document.createElement('div');
                    toastError.className = 'fixed inset-0 flex items-center justify-center z-50';
                    toastError.innerHTML = `
                        <div class="fixed inset-0 bg-gray-900/75 dark:bg-gray-900/90 transition-opacity"></div>
                        <div class="relative z-[60] flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800" role="alert">
                            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                                </svg>
                                <span class="sr-only">Error icon</span>
                            </div>
                            <div class="ms-3 text-sm font-normal">Sin permisos para anular cobros.</div>
                            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" onclick="this.parentElement.parentElement.remove()" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>
                    `;
                    document.body.appendChild(toastError);
                    setTimeout(() => {
                        toastError.remove();
                    }, 3000);
                    return;
                }

                const cobranzaId = button.dataset.cobranzaId;
                mostrarConfirmacionAnulacion(cobranzaId);
            });
        });

        // Función para filtrar la tabla
        function filtrarTabla() {
            const tiposPagoSeleccionados = Array.from(document.querySelectorAll(
                'input[name="tipo_pago"]:checked')).map(cb => cb.value);
            const estadosPagoSeleccionados = Array.from(document.querySelectorAll(
                'input[name="estado_pago"]:checked')).map(cb => cb.value);
            const usuariosSeleccionados = Array.from(document.querySelectorAll('input[name="usuario"]:checked'))
                .map(cb => cb.value);
            const fechaInicio = document.getElementById('fecha_inicio').value;
            const fechaFin = document.getElementById('fecha_fin').value;

            const filas = document.querySelectorAll('tbody tr');

            filas.forEach(fila => {
                if (fila.querySelector('td')) {
                    const tipoPagoCelda = fila.querySelector('td:nth-child(5)')?.textContent.trim()
                        .toLowerCase();
                    const estadoPagoCelda = fila.querySelector('td:nth-child(6) span')?.textContent
                        .trim().toLowerCase();
                    const usuarioId = fila.dataset.usuarioId;
                    const fechaCelda = fila.querySelector('td:nth-child(4)')?.textContent.trim();

                    let mostrarPorTipoPago = tiposPagoSeleccionados.length === 0 ||
                        tiposPagoSeleccionados.includes(tipoPagoCelda);
                    let mostrarPorEstado = estadosPagoSeleccionados.length === 0 ||
                        estadosPagoSeleccionados.includes(estadoPagoCelda);
                    let mostrarPorUsuario = usuariosSeleccionados.length === 0 || usuariosSeleccionados
                        .includes(usuarioId);

                    // Convertir fechas para comparación
                    const fechaCeldaObj = new Date(fechaCelda.split('/').reverse().join('-'));
                    const fechaInicioObj = fechaInicio ? new Date(fechaInicio) : null;
                    const fechaFinObj = fechaFin ? new Date(fechaFin) : null;

                    let mostrarPorFecha = true;
                    if (fechaInicioObj && fechaFinObj) {
                        mostrarPorFecha = fechaCeldaObj >= fechaInicioObj && fechaCeldaObj <=
                            fechaFinObj;
                    }

                    // Mostrar la fila solo si cumple con todos los filtros
                    fila.style.display = (mostrarPorTipoPago && mostrarPorEstado && mostrarPorUsuario &&
                        mostrarPorFecha) ? '' : 'none';
                }
            });
        }

        // Agregar eventos a los checkboxes de tipo de pago
        document.querySelectorAll('input[name="tipo_pago"]').forEach(checkbox => {
            checkbox.addEventListener('change', filtrarTabla);
        });

        // Agregar eventos a los checkboxes de estado de pago
        document.querySelectorAll('input[name="estado_pago"]').forEach(checkbox => {
            checkbox.addEventListener('change', filtrarTabla);
        });

        // Agregar eventos a los checkboxes de usuario
        document.querySelectorAll('input[name="usuario"]').forEach(checkbox => {
            checkbox.addEventListener('change', filtrarTabla);
        });

        // Agregar eventos a los inputs de fecha
        document.getElementById('fecha_inicio').addEventListener('change', filtrarTabla);
        document.getElementById('fecha_fin').addEventListener('change', filtrarTabla);

        // Función para limpiar filtros
        function limpiarFiltros() {
            // Limpiar tipo de pago
            document.querySelectorAll('input[name="tipo_pago"]').forEach(checkbox => {
                checkbox.checked = false;
            });

            // Limpiar estado de pago
            document.querySelectorAll('input[name="estado_pago"]').forEach(checkbox => {
                checkbox.checked = false;
            });

            // Limpiar usuarios
            document.querySelectorAll('input[name="usuario"]').forEach(checkbox => {
                checkbox.checked = false;
            });

            // Limpiar fechas
            document.getElementById('fecha_inicio').value = '';
            document.getElementById('fecha_fin').value = '';

            // Mostrar todas las filas
            document.querySelectorAll('tbody tr').forEach(fila => {
                fila.style.display = '';
            });

            // Cerrar el dropdown
            const filterDropdown = document.getElementById('filterDropdown');
            if (filterDropdown) {
                filterDropdown.classList.add('hidden');
            }
        }

        // Agregar evento al botón de limpiar filtros
        const botonLimpiar = document.getElementById('limpiar-filtros');
        if (botonLimpiar) {
            botonLimpiar.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                limpiarFiltros();
            });
        }

        // Función para manejar el dropdown de opciones
        const optionsDropdownButton = document.getElementById('optionsDropdownButton');
        const optionsDropdown = document.getElementById('optionsDropdown');

        if (optionsDropdownButton && optionsDropdown) {
            optionsDropdownButton.addEventListener('click', function() {
                optionsDropdown.classList.toggle('hidden');
            });

            // Cerrar el dropdown al hacer clic fuera
            document.addEventListener('click', function(event) {
                if (!optionsDropdownButton.contains(event.target) && !optionsDropdown.contains(event
                        .target)) {
                    optionsDropdown.classList.add('hidden');
                }
            });
        }
    });
</script>

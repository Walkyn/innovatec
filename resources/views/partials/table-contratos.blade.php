<main class="h-full pb-16 overflow-y-auto">
    <div>
        <div class="flex justify-between items-center mb-4">
            <!-- Título -->
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                Lista de Contratos
            </h4>

            <!-- Botones -->
            <div class="flex space-x-4">
                <button data-modal-target="contrato-modal" data-modal-toggle="contrato-modal" type="button"
                    class="flex items-center px-8 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    <i class="fas fa-plus mr-2"></i>
                    Nuevo
                </button>
            </div>
        </div>

        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0 md:space-x-4 mb-4">
            <!-- Item Buscador Start -->
            <form class="w-full md:w-2/3">
                <label for="default-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar Contratos, Clientes..." required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                </div>
            </form>
            <!-- Item Buscador End -->

            <!-- Campo de Estado Servicio -->
            <div class="w-full md:w-1/3">
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-4 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                        id="servicio">
                        <option>Activo</option>
                        <option>Inactivo</option>
                        <option>Suspendido</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Código</th>
                            <th class="px-4 py-3">Cliente</th>
                            <th class="px-4 py-3">Servicios</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Fecha</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($contratos as $contrato)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm font-mono">
                                    {{ 'CTR-' . str_pad($contrato->id, 6, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <p class="font-semibold">{{ $contrato->cliente->nombres }}
                                        {{ $contrato->cliente->apellidos }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        {{ $contrato->cliente->identificacion ?? 'N/A' }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $contrato->totalServicios() }}</td>
                                <td class="px-4 py-3 text-sm">{{ number_format($contrato->totalPago(), 2) }}</td>
                                <td class="px-4 py-3 text-sm w-32 whitespace-nowrap">
                                    {{ $contrato->fecha_contrato ? $contrato->fecha_contrato->format('d-m-Y') : 'N/A' }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @php
                                        $estadoClase = [
                                            'activo' =>
                                                'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100',
                                            'suspendido' => 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100',
                                        ];
                                    @endphp

                                    <span
                                        class="px-2 py-1 font-semibold leading-tight rounded-full 
                                        {{ $estadoClase[$contrato->estado_contrato] ?? 'text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100' }}">
                                        {{ ucfirst($contrato->estado_contrato) }}
                                    </span>
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <button data-modal-target="modificar-modal" data-modal-toggle="modificar-modal"
                                            class="px-2 py-2 text-yellow-600">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button data-modal-target="ver-contrato" data-modal-toggle="ver-contrato"
                                            data-id="{{ $contrato->id }}"
                                            data-cliente="{{ $contrato->cliente->nombres }} {{ $contrato->cliente->apellidos }}"
                                            data-servicios="{{ implode(',', $contrato->servicios->pluck('nombre')->toArray()) }}"
                                            data-detalles='@json($contrato->detalles_servicios)'
                                            class="px-2 py-2 text-blue-600 open-modal">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <button class="px-2 py-2 text-green-600">
                                            <i class="fas fa-print"></i>
                                        </button>
                                        <form action="{{ route('contratos.destroy', $contrato->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-2 text-red-600">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Paginación -->
            <div>
                {{ $contratos->links() }}
            </div>
        </div>

    </div>
</main>

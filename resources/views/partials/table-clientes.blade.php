<main class="h-full pb-16 overflow-y-auto">
    <div>

        <div class="flex justify-between items-center mb-4">
            <!-- Título -->
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                Lista de Clientes
            </h4>

            <!-- Botón -->
            <a href="{{ route('clients.create') }}"
                class="flex items-center px-8 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <i class="fas fa-user-plus mr-2"></i>
                Registrar
            </a>

        </div>

        <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4 mb-4">
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
                        placeholder="Buscar Clientes..." required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                </div>
            </form>
            <!-- Item Buscador End -->

            <!-- Campo de Estado Servicio -->
            <div class="w-full md:w-1/3">
                <div class="relative">
                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-white dark:bg-form-input">
                        <select
                            class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3.5 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                            :class="isOptionSelected && 'text-black dark:text-white'" @change="isOptionSelected = true">
                            <option value="" class="text-body">Activo</option>
                            <option value="" class="text-body">Inactivo</option>
                            <option value="" class="text-body">Suspendido</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Clientes</th>
                            <th class="px-4 py-3">Instalación</th>
                            <th class="px-4 py-3">Telefono</th>
                            <th class="px-4 py-3">Dirección</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Contrato</th>
                            <th class="px-4 py-3">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($clientes as $cliente)
                            @php
                                $iniciales = substr($cliente->nombres, 0, 1) . substr($cliente->apellidos, 0, 1);
                                $avatarUrl =
                                    'https://ui-avatars.com/api/?name=' .
                                    urlencode($iniciales) .
                                    '&size=64&background=374151&color=fff&rounded=true';
                                $contrato = $cliente->contratos->first();
                            @endphp
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <!-- Avatar (oculto en móviles) -->
                                        <div class="hidden md:flex items-center px-2 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-10 h-10 rounded-full object-cover" src="{{ $avatarUrl }}"
                                                alt="{{ $cliente->nombres }} {{ $cliente->apellidos }}"
                                                loading="lazy" />
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{ $cliente->nombres }} {{ $cliente->apellidos }}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $cliente->identificacion }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $cliente->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $cliente->telefono }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $cliente->direccion }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @php
                                        $estadoClase = [
                                            'activo' =>
                                                'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100',
                                            'inactivo' =>
                                                'text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100',
                                            'suspendido' =>
                                                'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100',
                                        ];
                                    @endphp
                
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight rounded-full {{ $estadoClase[$cliente->estado_cliente] ?? 'text-gray-700 bg-gray-100' }}">
                                        {{ ucfirst($cliente->estado_cliente) }}
                                    </span>
                                </td>
                
                                <td class="px-4 py-3 text-sm">
                                    <button data-modal-target="meses-modal" data-modal-toggle="meses-modal"
                                        class="fas fa-eye flex items-center justify-between px-2 py-2 text-sm font-bold leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray w-5 h-5"></button>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <!-- Botón Editar -->
                                        <a href="{{ route('clients.edit', $cliente->id) }}"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <i class="fas fa-edit w-5 h-5"></i>
                                        </a>
                
                                        <!-- Botón Eliminar -->
                                        <button
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Delete">
                                            <i class="fas fa-trash-alt w-5 h-5"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!-- Paginación -->
            <div>
                {{ $clientes->links() }}
            </div>
        </div>

    </div>
</main>

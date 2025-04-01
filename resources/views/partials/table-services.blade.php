<main class="h-full pb-16 overflow-y-auto">
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">

        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-2">
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300 w-full md:w-2/3">
                Lista de Servicios
            </h4>
            <div class="flex items-center space-x-3 w-full md:w-1/3 py-2">
                <div class="w-1/2">
                    <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                        class="w-full flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        type="button">
                        Agregar
                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </button>
                    <div id="actionsDropdown"
                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="actionsDropdownButton">
                            <li>
                                <button data-modal-target="category-modal" data-modal-toggle="category-modal"
                                    class="w-full text-left block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <i class="fas fa-plus mr-2"></i> Categorías
                                </button>
                            </li>
                            <li>
                                <button data-modal-target="service-modal" data-modal-toggle="service-modal"
                                    class="w-full text-left block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <i class="fas fa-plus mr-2"></i> Servicios
                                </button>
                            </li>
                            <li>
                                <button data-modal-target="plan-modal" data-modal-toggle="plan-modal"
                                    class="w-full text-left block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <i class="fas fa-plus mr-2"></i> Planes
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="w-1/2">
                    <button id="modifyDropdownButton" data-dropdown-toggle="modifyDropdown"
                        class="w-full flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        type="button">
                        Modificar
                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </button>
                    <div id="modifyDropdown"
                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="modifyDropdownButton">
                            <li>
                                <button @click="$dispatch('open-list-modal')"
                                    class="w-full text-left block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <i class="fas fa-edit mr-2"></i> Categorías
                                </button>
                            </li>
                            <li>
                                <button @click="$dispatch('open-services-modal')"
                                    class="w-full text-left block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <i class="fas fa-edit mr-2"></i> Servicios
                                </button>
                            </li>
                            <li>
                                <button @click="$dispatch('open-plans-modal')"
                                    class="w-full text-left block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <i class="fas fa-edit mr-2"></i> Planes
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between md:space-y-0 gap-4 mb-4">
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
                        placeholder="Buscar Servicios, Categorias..." required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Buscar
                    </button>
                </div>
            </form>

            <div class="w-full md:w-1/3">
                <div class="relative">
                    <select
                        class="block appearance-none w-full p-4 pr-8 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
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
                <table x-data="{ openDropdown: null }" class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Servicio</th>
                            <th class="px-4 py-3">Categoría</th>
                            <th class="px-4 py-3 min-w-[150px]">Plan</th>
                            <th class="px-4 py-3">Clientes</th>
                            <th class="px-4 py-3">Descripción</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($servicios as $servicio)
                            <tr class="text-gray-700 dark:text-gray-400 {{ $servicio->estado_servicio == 'eliminado' ? 'opacity-50 pointer-events-none' : '' }}"
                                data-id="{{ $servicio->id }}">
                                <td class="px-4 py-3 text-sm">
                                    {{ $servicio->nombre }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $servicio->categoria->nombre ?? 'Sin categoría' }}
                                </td>
                                <td class="px-4 py-3 text-sm relative">
                                    @if ($servicio->planes->isEmpty())
                                        <span class="text-gray-500 dark:text-gray-400">Sin planes</span>
                                    @else
                                        @if ($servicio->planes->count() == 1)
                                            {{ $servicio->planes->first()->nombre }} -
                                            ${{ number_format($servicio->planes->first()->precio, 2, '.', ',') }}
                                        @else
                                            <div class="relative inline-block">
                                                <!-- Botón para mostrar/ocultar el desplegable -->
                                                <button
                                                    @click="openDropdown === {{ $servicio->id }} ? openDropdown = null : openDropdown = {{ $servicio->id }}"
                                                    class="inline-flex items-center text-sm dark:text-white"
                                                    {{ $servicio->estado_servicio == 'eliminado' ? 'disabled' : '' }}>
                                                    <i
                                                        :class="openDropdown === {{ $servicio->id }} ?
                                                            'fas fa-chevron-up mr-2 text-xs' :
                                                            'fas fa-chevron-down mr-2 text-xs'"></i>
                                                    <span class="transition-colors duration-200"
                                                        :class="openDropdown === {{ $servicio->id }} ?
                                                            'text-blue-500' : ''">Ver
                                                        planes</span>
                                                </button>

                                                <!-- Desplegable de planes -->
                                                <div x-show="openDropdown === {{ $servicio->id }}" x-transition
                                                    class="fixed z-50 mt-2 bg-zinc-100 divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600"
                                                    x-ref="dropdown{{ $servicio->id }}" style="display: none;">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                        @foreach ($servicio->planes as $plan)
                                                            <li>
                                                                <a href="#"
                                                                    class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                    {{ $plan->nombre }} -
                                                                    ${{ number_format($plan->precio, 2, '.', ',') }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @php
                                        $contratoServicios = $servicio->contratoServicios ?? collect();
                                        $contratoIds = $contratoServicios->pluck('contrato_id');

                                        $totalClientes = \App\Models\Contrato::whereIn('id', $contratoIds)
                                            ->distinct()
                                            ->count('cliente_id');
                                    @endphp

                                    {{ $totalClientes }}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    {{ $servicio->descripcion }}
                                </td>
                                <td class="px-4 py-3 text-xs estado-servicio">
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight 
                                            {{ $servicio->estado_servicio == 'activo' ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : ($servicio->estado_servicio == 'inactivo' ? 'text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100' : 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100') }} 
                                            rounded-full">
                                        {{ ucfirst($servicio->estado_servicio) }}
                                    </span>
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <!-- Botón Editar -->
                                        <button data-modal-target="edit-service-modal"
                                            data-modal-toggle="edit-service-modal"
                                            class="px-2 py-2 text-sm font-medium {{ $servicio->estado_servicio == 'eliminado' ? 'text-gray-400' : 'text-blue-600' }} dark:text-gray-400"
                                            {{ $servicio->estado_servicio == 'eliminado' ? 'disabled' : '' }}>
                                            <i class="fas fa-edit w-5 h-5"></i>
                                        </button>

                                        <!-- Botón Eliminar -->
                                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                            onclick="setServicioId({{ $servicio->id }})"
                                            class="px-2 py-2 text-sm font-medium {{ $servicio->estado_servicio == 'eliminado' ? 'text-gray-400' : 'text-red-600' }} dark:text-gray-400"
                                            {{ $servicio->estado_servicio == 'eliminado' ? 'disabled' : '' }}>
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
                {{ $servicios->links() }}
            </div>
        </div>

    </div>

</main>

<!-- Modal de Confirmación -->
<div id="popup-modal" tabindex="-1" data-modal-target="popup-modal"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Cerrar modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Estás seguro de
                    eliminar este servicio?</h3>
                <button data-modal-hide="popup-modal" type="button" onclick="confirmarEliminacion()"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Sí, estoy seguro
                </button>
                <button data-modal-hide="popup-modal" type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                    cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    let servicioIdAEliminar = null;

    function setServicioId(id) {
        servicioIdAEliminar = id;
    }

    function confirmarEliminacion() {
        if (servicioIdAEliminar === null) return;

        eliminarServicio(servicioIdAEliminar);
    }

    function eliminarServicio(servicioId) {
        fetch(`/services/${servicioId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al eliminar el servicio.');
            });
    }
</script>

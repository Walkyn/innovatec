<main class="h-full pb-16 overflow-y-auto">
    <div>
        <div class="flex flex-col md:flex-row justify-between items-center mb-4">
            <!-- Título -->
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300 w-full">
                Lista de copias de seguridad
            </h4>


        </div>

        <!-- Start block -->
        <section class="dark:bg-gray-900 antialiased">
            <div class="max-w-screen-2xl">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div
                        class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/4">
                            <form class="flex items-center" id="searchForm">
                                <label for="simple-search" class="sr-only">Buscar por fecha</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-auto">
                                        <!-- Icono de lupa (visible por defecto) -->
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 search-icon" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        <!-- Icono X (inicialmente oculto) -->
                                        <button type="button"
                                            class="w-5 h-5 text-red-500 hover:text-red-700 hidden clear-search-button"
                                            onclick="clearSearch()">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <input type="date" id="simple-search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Seleccionar fecha">
                                </div>
                            </form>
                        </div>



                        <!-- Botones -->
                        <div class="flex flex-row justify-end space-x-3 md:space-x-3 w-full md:w-auto">
                            <button data-modal-target="modal-backup" data-modal-toggle="modal-backup" type="button"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-8 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <i class="fas fa-database mr-2 text-gray-400"></i>
                                Backup
                            </button>

                            <button data-modal-target="modal-restore" data-modal-toggle="modal-restore"
                                type="button"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-8 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <i class="fas fa-upload mr-2 text-gray-400"></i>
                                Restaurar
                            </button>
                        </div>

                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all" type="checkbox"
                                                class="w-4 h-4 text-primary-600 bg-gray-100 rounded border-gray-300 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all" class="sr-only">checkbox</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="p-4">Nombre</th>
                                    <th scope="col" class="p-4 whitespace-nowrap">Tamaño</th>
                                    <th scope="col" class="p-4 whitespace-nowrap">Fecha de Creación</th>
                                    <th scope="col" class="p-4">Estado</th>
                                    <th scope="col" class="p-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($backups as $backup)
                                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="p-4 w-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-{{ $backup->id }}" type="checkbox"
                                                    onclick="event.stopPropagation()"
                                                    class="w-4 h-4 text-primary-600 bg-gray-100 rounded border-gray-300 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-{{ $backup->id }}"
                                                    class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $backup->nombre }}
                                        </th>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $backup->tamanio }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            {{ $backup->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="px-4 py-3 text-xs">
                                            @php
                                                $estadoClase = [
                                                    'Completado' =>
                                                        'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100',
                                                    'Parcial' =>
                                                        'text-yellow-700 bg-yellow-100 dark:bg-yellow-700 dark:text-yellow-100',
                                                    'Error' =>
                                                        'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100',
                                                ];

                                                $iconoClase = [
                                                    'Completado' => 'fa-check-circle',
                                                    'Parcial' => 'fa-exclamation-circle',
                                                    'Error' => 'fa-times-circle',
                                                ];
                                            @endphp

                                            <span
                                                class="px-2 py-1 font-semibold leading-tight rounded-full {{ $estadoClase[$backup->estado] ?? 'text-gray-700 bg-gray-100' }} flex items-center gap-1 whitespace-nowrap w-fit">
                                                <i
                                                    class="fas {{ $iconoClase[$backup->estado] ?? 'fa-question-circle' }} text-xs"></i>
                                                <span class="text-xs">{{ $backup->estado }}</span>
                                            </span>
                                        </td>
                                        <td
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex items-center space-x-4">
                                                <!-- Botón de Descargar -->
                                                <button type="button"
                                                    onclick="verificarPermisosYDescargar('{{ route('backup.descargar', $backup->id) }}')"
                                                    class="flex items-center text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-900 {{ !auth()->user()->checkModuloAcceso('database', 'guardar') ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                    {{ !auth()->user()->checkModuloAcceso('database', 'guardar') ? 'disabled' : '' }}>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Descargar
                                                </button>
                                                <!-- Botón de Eliminar -->
                                                <button type="button" data-modal-target="delete-modal"
                                                    data-modal-toggle="delete-modal"
                                                    onclick="setBackupIdToDelete({{ $backup->id }})"
                                                    class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                            No hay copias de seguridad disponibles
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                        aria-label="Table navigation">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                            Mostrando
                            <span
                                class="font-semibold text-gray-900 dark:text-white">{{ $backups->firstItem() ?? 0 }}</span>
                            -
                            <span
                                class="font-semibold text-gray-900 dark:text-white">{{ $backups->lastItem() ?? 0 }}</span>
                            de
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $backups->total() }}</span>
                        </span>

                        <ul class="inline-flex items-stretch -space-x-px">
                            {{-- Botón Previous --}}
                            <li>
                                <a href="{{ $backups->previousPageUrl() }}"
                                    class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ !$backups->onFirstPage() ?: 'opacity-50 cursor-not-allowed' }}">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>

                            {{-- Números de página --}}
                            @foreach ($backups->getUrlRange(1, $backups->lastPage()) as $page => $url)
                                <li>
                                    <a href="{{ $url }}"
                                        class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $backups->currentPage() == $page ? 'bg-blue-50 text-blue-600 border-blue-300' : '' }}">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endforeach

                            {{-- Botón Next --}}
                            <li>
                                <a href="{{ $backups->nextPageUrl() }}"
                                    class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white {{ $backups->hasMorePages() ? '' : 'opacity-50 cursor-not-allowed' }}">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </section>

        <!-- Delete Modal -->
        <div id="delete-modal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            @if (!auth()->user()->checkModuloAcceso('database', 'eliminar'))
                <!-- Toast de error -->
                <div id="delete-modal"
                    class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800"
                    role="alert">
                    <div
                        class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                        </svg>
                        <span class="sr-only">Error icon</span>
                    </div>
                    <div class="ms-3 text-sm font-normal">Sin permisos para esta acción.</div>
                    <!-- Botón de cierre del toast y modal -->
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                        data-modal-hide="delete-modal" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @else
                <div class="relative w-full h-auto max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                            data-modal-hide="delete-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Cerrar modal</span>
                        </button>
                        <div class="p-6 text-center">
                            <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                                fill="none" stroke="currentColor" viewbox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Está seguro que
                                desea
                                eliminar esta copia de seguridad?</h3>
                            <button id="confirm-delete" type="button"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Sí, eliminar
                            </button>
                            <button type="button" data-modal-hide="delete-modal"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Modal de Error -->
        <div id="error-modal" tabindex="-1" data-modal-target="error-modal" data-modal-backdrop="static"
            class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="error-modal" onclick="closeErrorModal()">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-red-500 w-12 h-12" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Error al descargar el
                            archivo</h3>
                        <p id="error-message" class="mb-5 text-sm text-gray-500 dark:text-gray-400"></p>
                        <button type="button" onclick="closeErrorModal()"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<script>
    let backupIdToDelete = null;

    function setBackupIdToDelete(id) {
        backupIdToDelete = id;
    }

    document.getElementById('confirm-delete').addEventListener('click', function() {
        if (backupIdToDelete) {
            const formData = new FormData();
            formData.append('_method', 'DELETE');
            formData.append('_token', '{{ csrf_token() }}');

            fetch(`/backup/eliminar/${backupIdToDelete}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Cerrar el modal usando Flowbite
                        const targetEl = document.getElementById('delete-modal');
                        const modal = new Modal(targetEl);
                        modal.hide();

                        // Crear el overlay
                        const overlay = document.createElement('div');
                        overlay.className = 'fixed inset-0 bg-gray-900 bg-opacity-50 z-40';

                        // Crear el contenedor del toast centrado
                        const toastContainer = document.createElement('div');
                        toastContainer.className = 'fixed inset-0 flex items-center justify-center z-50';

                        // Crear el toast
                        const toast = document.createElement('div');
                        toast.className =
                            'flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800';
                        toast.innerHTML = `
                        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="sr-only">Check icon</span>
                        </div>
                        <div class="ms-3 text-sm font-normal">Backup eliminado correctamente.</div>
                    `;

                        // Agregar el toast al contenedor
                        toastContainer.appendChild(toast);

                        // Agregar overlay y contenedor al body
                        document.body.appendChild(overlay);
                        document.body.appendChild(toastContainer);

                        // Eliminar la notificación y overlay después de 2 segundos
                        setTimeout(() => {
                            overlay.remove();
                            toastContainer.remove();
                            // Recargar la página
                            window.location.reload();
                        }, 2000);
                    } else {
                        alert('Error al eliminar el backup: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al eliminar el backup');
                });
        }
    });

    document.getElementById('delete-modal').addEventListener('hidden.bs.modal', function() {
        backupIdToDelete = null;
    });

    document.addEventListener('DOMContentLoaded', function() {
        const targetEl = document.getElementById('delete-modal');
        const modal = new Modal(targetEl);
    });

    let errorModal;

    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar todos los modales
        const targetEl = document.getElementById('delete-modal');
        const modal = new Modal(targetEl);

        // Inicializar el modal de error
        errorModal = new Modal(document.getElementById('error-modal'), {
            backdrop: 'static',
            closable: true,
        });
    });

    function closeErrorModal() {
        if (errorModal) {
            errorModal.hide();
        }
    }

    function verificarPermisosYDescargar(url) {
        @if (auth()->user()->checkModuloAcceso('database', 'guardar'))
            descargarBackup(url);
        @endif
    }

    function descargarBackup(url) {
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor: ' + response.status);
                }
                // Obtener el nombre del archivo del header Content-Disposition si existe
                const contentDisposition = response.headers.get('Content-Disposition');
                const fileName = contentDisposition ?
                    contentDisposition.split('filename=')[1].replace(/"/g, '') :
                    'backup.sql';

                // Convertir la respuesta a blob
                return response.blob().then(blob => {
                    // Crear URL del blob
                    const url = window.URL.createObjectURL(blob);
                    // Crear enlace temporal
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = fileName;
                    // Agregar al documento y hacer clic
                    document.body.appendChild(link);
                    link.click();
                    // Limpiar
                    document.body.removeChild(link);
                    window.URL.revokeObjectURL(url);
                });
            })
            .catch(error => {
                console.error('Error en la descarga:', error);
                const errorMessage = document.getElementById('error-message');
                errorMessage.textContent =
                    'Ha ocurrido un error al intentar descargar el archivo. Por favor, verifica que el archivo exista.';
                if (errorModal) {
                    errorModal.show();
                }
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('simple-search');
        const clearButton = document.querySelector('.clear-search-button');
        const searchIcon = document.querySelector('.search-icon');

        if (searchInput) {
            searchInput.addEventListener('change', function(e) {
                if (e.target.value) {
                    // Mostrar X y ocultar lupa
                    clearButton.classList.remove('hidden');
                    searchIcon.classList.add('hidden');
                    buscarBackups(e.target.value);
                } else {
                    // Mostrar lupa y ocultar X
                    clearButton.classList.add('hidden');
                    searchIcon.classList.remove('hidden');
                }
            });
        }
    });

    function clearSearch() {
        const searchInput = document.getElementById('simple-search');
        const clearButton = document.querySelector('.clear-search-button');
        const searchIcon = document.querySelector('.search-icon');

        // Limpiar el input
        searchInput.value = '';

        // Mostrar lupa y ocultar X
        clearButton.classList.add('hidden');
        searchIcon.classList.remove('hidden');

        // Mostrar indicador de carga en la tabla
        const tableBody = document.querySelector('tbody');
        tableBody.innerHTML = `
            <tr>
                <td colspan="6" class="px-4 py-3 text-center">
                    <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-primary-600 border-r-transparent align-[-0.125em]" role="status">
                        <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Cargando...</span>
                    </div>
                </td>
            </tr>
        `;

        // Recargar la página usando window.location.href
        window.location.href = '{{ route("database.index") }}';
    }

    function buscarBackups(fecha = '') {
        // Mostrar indicador de carga
        const tableBody = document.querySelector('tbody');
        tableBody.innerHTML = `
            <tr>
                <td colspan="6" class="px-4 py-3 text-center">
                    <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-primary-600 border-r-transparent align-[-0.125em]" role="status">
                        <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Cargando...</span>
                    </div>
                </td>
            </tr>
        `;

        fetch(`{{ route('database.index') }}?fecha=${fecha}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Actualizar el contenido de tbody
                    tableBody.innerHTML = data.html;

                    // Reinicializar los modales después de actualizar el contenido
                    reinicializarModales();
                } else {
                    throw new Error(data.message || 'Error al cargar los datos');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                tableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-4 py-3 text-center text-red-500">
                        ${error.message || 'Error al cargar los datos. Por favor, intente nuevamente.'}
                    </td>
                </tr>
            `;
            });
    }

    // Función para reinicializar los modales
    function reinicializarModales() {
        // Reinicializar el modal de eliminación
        const deleteModalElement = document.getElementById('delete-modal');
        const deleteModal = new Modal(deleteModalElement);

        // Reinicializar los botones de eliminar
        document.querySelectorAll('[data-modal-toggle="delete-modal"]').forEach(button => {
            button.addEventListener('click', function() {
                deleteModal.show();
            });
        });

        // Reinicializar los botones de cerrar modal
        document.querySelectorAll('[data-modal-hide="delete-modal"]').forEach(button => {
            button.addEventListener('click', function() {
                deleteModal.hide();
            });
        });
    }

    // Inicialización inicial de modales
    document.addEventListener('DOMContentLoaded', function() {
        reinicializarModales();
    });

    // Prevenir envío del formulario
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();
    });
</script>

<!-- Modal para listar categorías -->
<div id="list-categories-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Categorías</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="list-categories-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div class="relative mb-4">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i class="fas fa-search w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                    </div>
                    <input type="text" id="searchCategoryInput"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar categoría" />
                </div>
                <ul id="categoryList" class="divide-y divide-gray-200 dark:divide-gray-700 max-h-60 overflow-y-auto">
                    @foreach ($categorias as $categoria)
                        <li class="flex items-center justify-between p-0 text-sm text-gray-700 dark:text-gray-200">
                            <div
                                class="flex items-center justify-between w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rounded">
                                <span data-modal-hide="list-categories-modal" data-modal-target="edit-category-modal"
                                    data-modal-toggle="edit-category-modal" class="cursor-pointer p-2 w-full rounded"
                                    onclick="openEditCategoryModal({{ $categoria->id }})">
                                    {{ $categoria->nombre }}
                                </span>
                                <button type="button" onclick="deleteCategory({{ $categoria->id }})"
                                    class="text-red-600 hover:text-red-800 dark:text-red-500 pl-4 pr-2 dark:hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar categoría -->
<div id="edit-category-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Modificar Categoría</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="edit-category-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="edit-category-form" method="POST" class="p-4 md:p-5">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-category-id">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="edit-nombre"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de la
                            Categoría</label>
                        <input type="text" name="nombre" id="edit-nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Escriba un nombre" required>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="text-white flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fas fa-check text-sm"></i> Actualizar
                    </button>
                    <button data-modal-hide="edit-category-modal" type="button"
                        data-modal-target="list-categories-modal" data-modal-toggle="list-categories-modal"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Volver</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de éxito/error -->
<div id="messageModal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 dark:bg-gray-900/75 transition-opacity" aria-hidden="true"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div id="modalIcon"
                            class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/20 sm:mx-0 sm:size-10">
                            <svg id="modalIconSvg" class="size-6 text-red-600 dark:text-red-500" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 id="modalTitle" class="text-base font-semibold text-gray-900 dark:text-white">Error
                            </h3>
                            <div class="mt-2">
                                <p id="modalMessage" class="text-sm text-gray-500 dark:text-gray-400"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button id="modalOkButton" type="button"
                        class="inline-flex w-full justify-center rounded-md bg-green-600 dark:bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 dark:hover:bg-green-600 sm:ml-3 sm:w-auto">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showMessageModal(isSuccess, message) {
        const modal = document.getElementById('messageModal');
        const modalIcon = document.getElementById('modalIcon');
        const modalIconSvg = document.getElementById('modalIconSvg');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');

        modalIcon.classList.toggle('bg-red-100', !isSuccess);
        modalIcon.classList.toggle('dark:bg-red-900/20', !isSuccess);
        modalIcon.classList.toggle('bg-green-100', isSuccess);
        modalIcon.classList.toggle('dark:bg-green-900/20', isSuccess);
        modalIconSvg.classList.toggle('text-red-600', !isSuccess);
        modalIconSvg.classList.toggle('dark:text-red-500', !isSuccess);
        modalIconSvg.classList.toggle('text-green-600', isSuccess);
        modalIconSvg.classList.toggle('dark:text-green-500', isSuccess);
        modalTitle.textContent = isSuccess ? 'Éxito' : 'Error';
        modalMessage.textContent = message;
        modal.classList.remove('hidden');

        document.getElementById('modalOkButton').addEventListener('click', () => {
            modal.classList.add('hidden');
            if (isSuccess) location.reload();
        }, {
            once: true
        });
    }

    async function openEditCategoryModal(categoryId) {
        const response = await fetch(`/categorias/${categoryId}/edit`);
        const categoria = await response.json();
        document.getElementById('edit-category-id').value = categoria.id;
        document.getElementById('edit-nombre').value = categoria.nombre;
        document.getElementById('edit-category-trigger').click();
    }

    document.getElementById('edit-category-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const id = document.getElementById('edit-category-id').value;

        fetch(`/categorias/${id}/update`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-HTTP-Method-Override': 'PUT'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => showMessageModal(data.success, data.message))
            .catch(() => showMessageModal(false, 'Hubo un problema al actualizar la categoría.'));
    });

    async function deleteCategory(categoryId) {
        try {
            const response = await fetch(`/categorias/${categoryId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('La respuesta del servidor no es válida.');
            }

            const data = await response.json();

            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Error al eliminar la categoría.');
            }

            showMessageModal(true, data.message);
            location.reload();
        } catch (error) {
            console.error('Error al eliminar la categoría:', error);
            showMessageModal(false, error.message || 'Hubo un problema al eliminar la categoría.');
        }
    }

    document.getElementById('searchCategoryInput').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('#categoryList li').forEach(item => {
            item.style.display = item.textContent.toLowerCase().includes(query) ? '' : 'none';
        });
    });
</script>

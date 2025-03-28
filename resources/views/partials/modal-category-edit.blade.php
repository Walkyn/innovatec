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
                    <button type="button" data-modal-hide="edit-category-modal"
                        data-modal-target="list-categories-modal" data-modal-toggle="list-categories-modal"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Volver</button>
                </div>
            </form>
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

    const swalWithTailwindButtons = Swal.mixin({
        customClass: {
            confirmButton: "bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-400",
            cancelButton: "bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400",
            actions: "flex justify-center gap-4"
        },
        buttonsStyling: false
    });

    async function deleteCategory(categoryId) {
        const result = await swalWithTailwindButtons.fire({
            title: "¿Estás seguro?",
            text: "Se eliminarán todos los servicios asociados",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "No, cancelar",
            reverseButtons: true
        });

        if (result.isConfirmed) {
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

                swalWithTailwindButtons.fire({
                    title: "¡Eliminado!",
                    text: data.message || "La categoría ha sido eliminada.",
                    icon: "success"
                }).then(() => {
                    location.reload();
                });
            } catch (error) {
                console.error('Error al eliminar la categoría:', error);

                swalWithTailwindButtons.fire({
                    title: "Error",
                    text: error.message || "Hubo un problema al eliminar la categoría.",
                    icon: "error"
                });
            }
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithTailwindButtons.fire({
                title: "Cancelado",
                text: "La categoría no ha sido eliminada.",
                icon: "error"
            });
        }
    }

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
            if (isSuccess) {
                location.reload();
            }
        }, {
            once: true
        });
    }

    document.getElementById('searchCategoryInput').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('#categoryList li').forEach(item => {
            item.style.display = item.textContent.toLowerCase().includes(query) ? '' : 'none';
        });
    });
</script>

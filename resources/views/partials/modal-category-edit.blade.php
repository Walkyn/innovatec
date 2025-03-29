<!-- Modal para listar categorías -->
<div id="list-categories-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    x-data="categoryList()">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Categorías</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    @click="closeListModal">
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
                    <input type="text" 
                        x-model="searchQuery"
                        @input="filterCategories()"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar categoría"/>
                </div>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700 max-h-60 overflow-y-auto">
                    <template x-for="categoria in filteredCategories" :key="categoria.id">
                        <li class="flex items-center justify-between p-0 text-sm text-gray-700 dark:text-gray-200">
                            <div class="flex items-center justify-between w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rounded">
                                <span @click="prepareEdit(categoria)" 
                                    class="cursor-pointer p-2 w-full rounded"
                                    x-text="categoria.nombre"></span>
                                <button type="button" 
                                    @click="confirmDelete(categoria.id)"
                                    class="text-red-600 hover:text-red-800 dark:text-red-500 pl-4 pr-2 dark:hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar categoría -->
<div id="edit-category-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    x-data="editCategory()">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Modificar Categoría</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    @click="closeEditModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form @submit.prevent="updateCategory" class="p-4 md:p-5">
                @csrf
                @method('PUT')
                <input type="hidden" x-model="formData.id">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="edit-nombre"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de la
                            Categoría</label>
                        <input type="text" 
                            id="edit-nombre"
                            x-model="formData.nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Escriba un nombre" required>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="text-white flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fas fa-check text-sm"></i> Actualizar
                    </button>
                    <button type="button" 
                        @click="goBackToList"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Volver
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('categoryList', () => ({
        categories: @json($categorias),
        filteredCategories: @json($categorias),
        searchQuery: '',
        hasDeletions: false,
        
        init() {
            this.$watch('searchQuery', () => this.filterCategories());

            window.addEventListener('open-list-modal', () => {
                this.openListModal();
            });
        },
        
        filterCategories() {
            if (!this.searchQuery) {
                this.filteredCategories = [...this.categories];
                return;
            }
            
            const query = this.searchQuery.toLowerCase();
            this.filteredCategories = this.categories.filter(cat => 
                cat.nombre.toLowerCase().includes(query)
            );
        },
        
        openListModal() {
            const modal = document.getElementById('list-categories-modal');
            const modalInstance = new Modal(modal, {
                backdrop: 'static',
                keyboard: false
            });
            modalInstance.show();
        },
        
        closeListModal() {
            const modal = document.getElementById('list-categories-modal');
            const modalInstance = new Modal(modal);
            modalInstance.hide();
            
            if (this.hasDeletions) {
                location.reload();
            }
        },
        
        async prepareEdit(categoria) {
            try {
                const response = await fetch(`/categorias/${categoria.id}/edit`);
                const data = await response.json();

                const event = new CustomEvent('edit-category', {
                    detail: data
                });
                document.dispatchEvent(event);

                this.closeListModal();
                window.dispatchEvent(new CustomEvent('open-edit-modal'));
            } catch (error) {
                console.error('Error:', error);
                alert('Error al cargar los datos de la categoría');
            }
        },
        
        async confirmDelete(id) {
            const result = await Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción eliminará la categoría permanentemente",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "No, cancelar",
                reverseButtons: true,
                customClass: {
                    confirmButton: "bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-400",
                    cancelButton: "bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400",
                    actions: "flex justify-center gap-4"
                },
                buttonsStyling: false
            });

            if (result.isConfirmed) {
                try {
                    const response = await fetch(`/categorias/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (!response.ok) {
                        throw new Error(data.message || 'Error al eliminar');
                    }

                    this.categories = this.categories.filter(cat => cat.id !== id);
                    this.filteredCategories = this.filteredCategories.filter(cat => cat.id !== id);
                    
                    this.hasDeletions = true;
                    
                    await Swal.fire({
                        title: "¡Eliminado!",
                        text: data.message || "La categoría ha sido eliminada.",
                        icon: "success",
                        customClass: {
                            confirmButton: "bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-400"
                        },
                        buttonsStyling: false
                    });

                } catch (error) {
                    console.error('Error al eliminar la categoría:', error);
                    Swal.fire({
                        title: "Error",
                        text: error.message || "Hubo un problema al eliminar la categoría.",
                        icon: "error",
                        customClass: {
                            confirmButton: "bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400"
                        },
                        buttonsStyling: false
                    });
                }
            }
        }
    }));

    Alpine.data('editCategory', () => ({
        formData: {
            id: '',
            nombre: ''
        },
        
        init() {
            document.addEventListener('edit-category', (event) => {
                this.formData = { ...event.detail };
            });
            
            window.addEventListener('open-edit-modal', () => {
                this.openEditModal();
            });
        },
        
        openEditModal() {
            const modal = document.getElementById('edit-category-modal');
            const modalInstance = new Modal(modal, {
                backdrop: 'static',
                keyboard: false
            });
            modalInstance.show();
        },
        
        closeEditModal() {
            const modal = document.getElementById('edit-category-modal');
            const modalInstance = new Modal(modal);
            modalInstance.hide();
        },
        
        goBackToList() {
            this.closeEditModal();
            window.dispatchEvent(new CustomEvent('open-list-modal'));
        },
        
        async updateCategory() {
            try {
                if (!this.formData.nombre || this.formData.nombre.trim() === '') {
                    await Swal.fire({
                        title: "Error",
                        text: "El nombre de la categoría es requerido.",
                        icon: "error",
                        customClass: {
                            confirmButton: "bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400"
                        },
                        buttonsStyling: false
                    });
                    return;
                }

                const response = await fetch(`/categorias/${this.formData.id}/update`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nombre: this.formData.nombre.trim()
                    })
                });
                
                const data = await response.json();
                
                if (!response.ok) {
                    throw new Error(data.message || 'Error al actualizar');
                }
                
                await Swal.fire({
                    title: "¡Actualizado!",
                    text: data.message || "La categoría ha sido actualizada.",
                    icon: "success",
                    customClass: {
                        confirmButton: "bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-400"
                    },
                    buttonsStyling: false
                });

                location.reload();
            } catch (error) {
                console.error('Error al actualizar la categoría:', error);
                Swal.fire({
                    title: "Error",
                    text: error.message || "Hubo un problema al actualizar la categoría.",
                    icon: "error",
                    customClass: {
                        confirmButton: "bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400"
                    },
                    buttonsStyling: false
                });
            }
        }
    }));
});
</script>

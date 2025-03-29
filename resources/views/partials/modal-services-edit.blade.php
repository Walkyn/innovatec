<!-- Modal para listar categorías y servicios -->
<div id="list-services-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    x-data="serviceList()">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Servicios</h3>
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
                        placeholder="Buscar categoría o servicio"/>
                </div>
                <!-- Categories list with nested services -->
                <ul class="divide-y divide-gray-200 dark:divide-gray-700 max-h-96 overflow-y-auto">
                    <template x-for="categoria in filteredCategories" :key="categoria.id">
                        <li class="category-item">
                            <div class="flex items-center justify-between p-0 text-sm text-gray-700 dark:text-gray-200">
                                <div class="flex items-center justify-between w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rounded">
                                    <button type="button" 
                                        class="cursor-pointer p-2 w-full rounded text-left"
                                        @click="toggleServices(categoria.id)">
                                        <div class="flex items-center justify-between w-full">
                                            <span x-text="categoria.nombre"></span>
                                            <i class="fas fa-chevron-down text-xs ml-2 transition-transform duration-200"
                                               :class="{ 'transform rotate-180': openCategory === categoria.id }"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <!-- Services container with animation -->
                            <div x-show="openCategory === categoria.id"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                                 class="overflow-hidden">
                                <ul class="services-list pl-6 divide-y divide-gray-200 dark:divide-gray-700">
                                    <template x-for="servicio in getServicesForCategory(categoria.id)" :key="servicio.id">
                                        <li class="flex items-center justify-between py-2 text-sm text-gray-700 dark:text-gray-200">
                                            <div class="flex items-center justify-between w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rounded">
                                                <span @click="prepareEdit(servicio)" 
                                                    class="cursor-pointer p-2 w-full rounded"
                                                    x-text="servicio.nombre"></span>
                                                <button type="button" 
                                                    @click="confirmDeleteService(servicio.id)"
                                                    class="text-red-600 hover:text-red-800 dark:text-red-500 pl-4 pr-2 dark:hover:text-red-700">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </li>
                                    </template>
                                    <template x-if="!getServicesForCategory(categoria.id).length">
                                        <li class="py-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                                            No hay servicios en esta categoría
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar servicio -->
<div id="edit-service-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    x-data="editService()">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Modificar Servicio</h3>
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
            <form @submit.prevent="updateService" class="p-4 md:p-5">
                @csrf
                @method('PUT')
                <input type="hidden" x-model="formData.id">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del Servicio</label>
                        <input type="text" 
                            x-model="formData.nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
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
    Alpine.data('serviceList', () => ({
        categories: @json($categorias),
        filteredCategories: @json($categorias),
        services: [],
        openCategory: null,
        searchQuery: '',
        hasDeletions: false,
        
        init() {
            this.$watch('searchQuery', () => this.filterCategories());
            
            window.addEventListener('open-services-modal', () => {
                this.openListModal();
            });
            
            // Cargar todos los servicios al inicio
            this.loadAllServices();
        },
        
        async loadAllServices() {
            try {
                const response = await fetch('/servicios/all');
                if (!response.ok) {
                    throw new Error('Error al cargar los servicios');
                }
                this.services = await response.json();
            } catch (error) {
                console.error('Error:', error);
                this.showMessage(false, 'Hubo un error al cargar los servicios.');
            }
        },
        
        getServicesForCategory(categoriaId) {
            return this.services.filter(servicio => servicio.categoria_id == categoriaId);
        },
        
        filterCategories() {
            if (!this.searchQuery) {
                this.filteredCategories = [...this.categories];
                return;
            }
            
            const query = this.searchQuery.toLowerCase();
            this.filteredCategories = this.categories.filter(cat => {
                const categoryMatch = cat.nombre.toLowerCase().includes(query);
                const servicesMatch = this.getServicesForCategory(cat.id).some(serv => 
                    serv.nombre.toLowerCase().includes(query)
                );
                return categoryMatch || servicesMatch;
            });
        },
        
        openListModal() {
            const modal = document.getElementById('list-services-modal');
            const modalInstance = new Modal(modal, {
                backdrop: 'static',
                keyboard: false
            });
            modalInstance.show();
        },
        
        closeListModal() {
            const modal = document.getElementById('list-services-modal');
            const modalInstance = new Modal(modal);
            modalInstance.hide();
            
            if (this.hasDeletions) {
                location.reload();
            }
        },
        
        toggleServices(categoriaId) {
            if (this.openCategory === categoriaId) {
                this.openCategory = null;
                return;
            }

            if (this.openCategory !== null) {
                setTimeout(() => {
                    this.loadServicesForCategory(categoriaId).then(() => {
                        this.openCategory = categoriaId;
                    });
                }, 300);
            } else {
                this.loadServicesForCategory(categoriaId).then(() => {
                    this.openCategory = categoriaId;
                });
            }
        },
        
        async loadServicesForCategory(categoriaId) {
            try {
                const response = await fetch(`/categorias/${categoriaId}/servicios`);
                if (!response.ok) {
                    throw new Error('Error al cargar los servicios');
                }
                const nuevosServicios = await response.json();
                
                // Actualizar los servicios manteniendo los de otras categorías
                this.services = [
                    ...this.services.filter(s => s.categoria_id != categoriaId),
                    ...nuevosServicios
                ];
            } catch (error) {
                console.error('Error:', error);
                this.showMessage(false, 'Error al cargar los servicios para esta categoría');
            }
        },
        
        prepareEdit(servicio) {
            const event = new CustomEvent('edit-service', {
                detail: servicio
            });
            document.dispatchEvent(event);
            
            this.closeListModal();
            window.dispatchEvent(new CustomEvent('open-edit-service-modal'));
        },
        
        async confirmDeleteService(id) {
            const result = await Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción eliminará el servicio permanentemente",
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
                    const response = await fetch(`/servicios/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(data.message || 'Error al eliminar el servicio');
                    }

                    await Swal.fire({
                        title: "¡Eliminado!",
                        text: data.message || "El servicio ha sido eliminado.",
                        icon: "success",
                        customClass: {
                            confirmButton: "bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-400"
                        },
                        buttonsStyling: false
                    });

                    this.services = this.services.filter(serv => serv.id !== id);
                    
                    this.hasDeletions = true;
                    
                    if (this.openCategory) {
                        const currentCategory = this.openCategory;
                        this.openCategory = null;
                        this.$nextTick(() => {
                            this.openCategory = currentCategory;
                        });
                    }

                } catch (error) {
                    console.error('Error al eliminar el servicio:', error);
                    Swal.fire({
                        title: "Error",
                        text: error.message || "Hubo un problema al eliminar el servicio.",
                        icon: "error",
                        customClass: {
                            confirmButton: "bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400"
                        },
                        buttonsStyling: false
                    });
                }
            }
        },
        
        showMessage(isSuccess, message) {
            const title = isSuccess ? 'Éxito' : 'Error';
            const icon = isSuccess ? 'success' : 'error';
            
            Swal.fire({
                title: title,
                text: message,
                icon: icon,
                customClass: {
                    confirmButton: isSuccess 
                        ? "bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-400"
                        : "bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400"
                },
                buttonsStyling: false
            });
        }
    }));

    Alpine.data('editService', () => ({
        formData: {
            id: '',
            nombre: ''
        },
        
        init() {
            document.addEventListener('edit-service', (event) => {
                this.formData = { ...event.detail };
            });
            
            window.addEventListener('open-edit-service-modal', () => {
                this.openEditModal();
            });
        },
        
        openEditModal() {
            const modal = document.getElementById('edit-service-modal');
            const modalInstance = new Modal(modal, {
                backdrop: 'static',
                keyboard: false
            });
            modalInstance.show();
        },
        
        closeEditModal() {
            const modal = document.getElementById('edit-service-modal');
            const modalInstance = new Modal(modal);
            modalInstance.hide();
        },
        
        goBackToList() {
            this.closeEditModal();
            window.dispatchEvent(new CustomEvent('open-services-modal'));
        },
        
        async updateService() {
            try {
                const response = await fetch(`/servicios/${this.formData.id}/update`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-HTTP-Method-Override': 'PUT',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(this.formData)
                });
                
                const data = await response.json();
                
                if (!response.ok) {
                    throw new Error(data.message || 'Error al actualizar el servicio');
                }
                
                await Swal.fire({
                    title: "¡Actualizado!",
                    text: data.message || "El servicio ha sido actualizado.",
                    icon: "success",
                    customClass: {
                        confirmButton: "bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-400"
                    },
                    buttonsStyling: false
                });

                // Recargar la página después de actualizar
                location.reload();
            } catch (error) {
                this.showMessage(false, error.message || 'Error al actualizar el servicio');
            }
        },
        
        showMessage(isSuccess, message) {
            const title = isSuccess ? 'Éxito' : 'Error';
            const icon = isSuccess ? 'success' : 'error';
            
            Swal.fire({
                title: title,
                text: message,
                icon: icon,
                customClass: {
                    confirmButton: isSuccess 
                        ? "bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-400"
                        : "bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400"
                },
                buttonsStyling: false
            });
        }
    }));
});
</script>
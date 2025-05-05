<!-- Modal para editar todos los datos del servicio -->
<div id="edit-all-service-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
    x-data="editAllService()">
    @if (!auth()->user()->checkModuloAcceso('manage', 'actualizar'))
        <!-- Toast de error -->
        <div class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div
                class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">Sin permisos para esta acción.</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                @click="closeEditModal" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @else
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
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
                            <label for="edit-nombre"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del
                                Servicio</label>
                            <input type="text" id="edit-nombre" x-model="formData.nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="edit-descripcion"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                            <textarea id="edit-descripcion" x-model="formData.descripcion" rows="4"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"></textarea>
                        </div>
                        <div class="col-span-2">
                            <label for="edit-categoria"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría</label>
                            <select id="edit-categoria" x-model="formData.categoria_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                                <option value="">Seleccione una categoría</option>
                                <template x-for="categoria in categorias" :key="categoria.id">
                                    <option :value="categoria.id" x-text="categoria.nombre"></option>
                                </template>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="edit-estado"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                            <select id="edit-estado" x-model="formData.estado_servicio"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                                <option value="suspendido">Suspendido</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="submit"
                            class="text-white flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <i class="fas fa-check text-sm"></i> Actualizar
                        </button>
                        <button type="button" @click="closeEditModal"
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('editAllService', () => ({
            formData: {
                id: '',
                nombre: '',
                descripcion: '',
                categoria_id: '',
                estado_servicio: 'activo'
            },
            categorias: @json($categorias),

            init() {
                // Escuchar el evento para abrir el modal
                window.addEventListener('open-edit-all-service-modal', (event) => {
                    this.formData = {
                        ...event.detail
                    };
                    this.openEditModal();
                });
            },

            openEditModal() {
                const modal = document.getElementById('edit-all-service-modal');
                const modalInstance = new Modal(modal, {
                    backdrop: 'static',
                    keyboard: false
                });
                modalInstance.show();
            },

            closeEditModal() {
                const modal = document.getElementById('edit-all-service-modal');
                const modalInstance = new Modal(modal);
                modalInstance.hide();
            },

            async updateService() {
                try {
                    if (!this.formData.nombre || !this.formData.categoria_id || !this.formData
                        .estado_servicio) {
                        throw new Error('Todos los campos obligatorios deben estar completos');
                    }

                    const response = await fetch(`/servicios/${this.formData.id}/update-all`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content,
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
                    console.error('Error al actualizar el servicio:', error);
                    Swal.fire({
                        title: "Error",
                        text: error.message ||
                            "Hubo un problema al actualizar el servicio.",
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

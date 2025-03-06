<!-- Main modal -->
<div id="plan-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-4 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Registrar Plan
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="plan-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('services.storePlan') }}" method="POST" x-data="{
                categorias: @js($categorias),
                serviciosDisponibles: [],
                categoriaId: '',
                servicioId: '',
                nombre: '',
                precio: '',
                init() {
                    this.categoriaId = '{{ old('category') }}';
                    this.servicioId = '{{ old('servicio') }}';
                    this.fetchServicios();
                },
                fetchServicios() {
                    this.serviciosDisponibles = this.categorias.find(c => c.id == this.categoriaId)?.servicios || [];
                    this.servicioId = ''; // Resetear el servicio cuando cambia la categoría
                }
            }">
                @csrf
                <div class="p-4 md:p-5">
                    <div class="grid gap-4 grid-cols-2">
                        <!-- Categoría -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría</label>
                            <select id="category" x-model="categoriaId" name="category" @change="fetchServicios()"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                <option value="">Seleccionar</option>
                                <template x-for="categoria in categorias" :key="categoria.id">
                                    <option :value="categoria.id" x-text="categoria.nombre"></option>
                                </template>
                            </select>
                        </div>

                        <!-- Servicio -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="servicio"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Servicio</label>
                            <select id="servicio" x-model="servicioId" name="servicio_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                <option value="">Seleccionar</option>
                                <template x-for="servicio in serviciosDisponibles" :key="servicio.id">
                                    <option :value="servicio.id" x-text="servicio.nombre"></option>
                                </template>
                            </select>
                        </div>

                        <!-- Plan -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Plan</label>
                            <input type="text" name="nombre" id="nombre" x-model="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="" required>
                        </div>

                        <!-- Precio -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="precio"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                            <input type="number" name="precio" id="precio" x-model="precio"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="" required>
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-between p-4 md:p-5 border-t rounded-b dark:border-gray-600 border-gray-200">
                    <button type="submit"
                        class="text-white flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fas fa-check text-sm"></i>
                        Registrar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

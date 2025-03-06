<!-- Main modal -->
<div id="service-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Registrar Sevicio
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="service-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            @if(!auth()->user()->checkModuloAcceso('manage', 'guardar'))
              No tiene los permisos para realizar esta accion!
            @else
            <form action="{{ route('services.store') }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <!-- Servicio -->
                    <div class="col-span-2">
                        <label for="servicio"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Servicio</label>
                        <input type="text" name="servicio" id="servicio"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Escriba un servicio" required>
                    </div>

                    <!-- Estado -->
                    <div class="col-span-2 sm:col-span-1">
                        <label for="estado"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                        <select id="estado" name="estado"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>

                    <!-- Categoría -->
                    <div class="col-span-2 sm:col-span-1">
                        <label for="categoria"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría</label>
                        <input list="categorias" id="categoria" name="categoria"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Escriba o seleccione una categoría" required>

                        <datalist id="categorias">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->nombre }}"></option>
                            @endforeach
                        </datalist>
                    </div>

                    <!-- Descripción -->
                    <div class="col-span-2">
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Escribe aquí la descripción del servicio."></textarea>
                    </div>
                </div>

                <!-- Botón -->
                <button type="submit"
                class="text-white flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="fas fa-check text-sm"></i>
                  Registrar
                </button>
            </form>
            @endif
        </div>
    </div>
</div>

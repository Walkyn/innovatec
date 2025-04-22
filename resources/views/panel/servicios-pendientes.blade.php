<!-- Inputs en grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <!-- Input para seleccionar el contrato -->
    <div>
        <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
            Contrato
        </label>
        <div class="relative">
            <select
                class="block appearance-none w-full bg-gray-50 dark:bg-gray-700 border border-gray-50 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                <option value="">Seleccione un contrato</option>
                <option value="1" selected>CONTR-2022-001</option>
                <option value="2">CONTR-2023-002</option>
            </select>
        </div>
    </div>

    <!-- Input para seleccionar el servicio -->
    <div>
        <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
            Servicio
        </label>
        <div class="relative">
            <select
                class="block appearance-none w-full bg-gray-50 dark:bg-gray-700 border border-gray-50 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                <option value="">Seleccione un servicio</option>
                <option value="1" selected>Internet Fibra Óptica</option>
                <option value="2">Televisión HD</option>
            </select>
        </div>
    </div>

    <div>
        <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
            Año
        </label>
        <div class="relative">
            <select
                class="block appearance-none w-full bg-gray-50 dark:bg-gray-700 border border-gray-50 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024" selected>2024</option>
            </select>
        </div>
    </div>
</div>

<!-- Calendario de meses -->
<div class="py-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Estado de Pagos
        </h3>
        <div class="flex items-center space-x-2">
            <div class="w-32 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-green-600 h-2.5 rounded-full" style="width: 75%"></div>
            </div>
            <span class="text-sm text-gray-600 dark:text-gray-300">75% completado</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        <!-- Enero -->
        <div class="p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800/50">
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3 dark:bg-gray-600">
                <div class="h-1.5 rounded-full bg-green-500" style="width: 100%"></div>
            </div>
            <div class="flex justify-between items-start">
                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">Enero
                </h4>
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">Pagado</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-xs">
                <span class="text-gray-500 dark:text-gray-400">Vence: 10/01/2024</span>
                <span class="text-green-600 dark:text-green-400 font-medium">S/
                    120.00</span>
            </div>
        </div>

        <!-- Febrero -->
        <div class="p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800/50">
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3 dark:bg-gray-600">
                <div class="h-1.5 rounded-full bg-green-500" style="width: 100%"></div>
            </div>
            <div class="flex justify-between items-start">
                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">Febrero
                </h4>
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">Pagado</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-xs">
                <span class="text-gray-500 dark:text-gray-400">Vence: 10/02/2024</span>
                <span class="text-green-600 dark:text-green-400 font-medium">S/
                    120.00</span>
            </div>
        </div>

        <!-- Marzo -->
        <div class="p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800/50">
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3 dark:bg-gray-600">
                <div class="h-1.5 rounded-full bg-green-500" style="width: 100%"></div>
            </div>
            <div class="flex justify-between items-start">
                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">Marzo
                </h4>
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">Pagado</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-xs">
                <span class="text-gray-500 dark:text-gray-400">Vence: 10/03/2024</span>
                <span class="text-green-600 dark:text-green-400 font-medium">S/
                    120.00</span>
            </div>
        </div>

        <!-- Abril -->
        <div class="p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800/50">
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3 dark:bg-gray-600">
                <div class="h-1.5 rounded-full bg-green-500" style="width: 100%"></div>
            </div>
            <div class="flex justify-between items-start">
                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">Abril
                </h4>
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">Pagado</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-xs">
                <span class="text-gray-500 dark:text-gray-400">Vence: 10/04/2024</span>
                <span class="text-green-600 dark:text-green-400 font-medium">S/
                    120.00</span>
            </div>
        </div>

        <!-- Mayo -->
        <div class="p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800/50">
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3 dark:bg-gray-600">
                <div class="h-1.5 rounded-full bg-green-500" style="width: 100%"></div>
            </div>
            <div class="flex justify-between items-start">
                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">Mayo</h4>
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">Pagado</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-xs">
                <span class="text-gray-500 dark:text-gray-400">Vence: 10/05/2024</span>
                <span class="text-green-600 dark:text-green-400 font-medium">S/
                    120.00</span>
            </div>
        </div>

        <!-- Junio -->
        <div class="p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800/50">
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3 dark:bg-gray-600">
                <div class="h-1.5 rounded-full bg-green-500" style="width: 100%"></div>
            </div>
            <div class="flex justify-between items-start">
                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">Junio
                </h4>
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">Pagado</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-xs">
                <span class="text-gray-500 dark:text-gray-400">Vence: 10/06/2024</span>
                <span class="text-green-600 dark:text-green-400 font-medium">S/
                    120.00</span>
            </div>
        </div>

        <!-- Julio -->
        <div
            class="p-4 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-100 dark:border-yellow-800/50">
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3 dark:bg-gray-600">
                <div class="h-1.5 rounded-full bg-yellow-500" style="width: 50%"></div>
            </div>
            <div class="flex justify-between items-start">
                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">Julio
                </h4>
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">Pendiente</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-xs">
                <span class="text-gray-500 dark:text-gray-400">Vence: 10/07/2024</span>
            </div>
        </div>

        <!-- Agosto -->
        <div class="p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800/50">
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3 dark:bg-gray-600">
                <div class="h-1.5 rounded-full bg-red-500" style="width: 0%"></div>
            </div>
            <div class="flex justify-between items-start">
                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">Agosto
                </h4>
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">Falta</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-xs">
                <span class="text-gray-500 dark:text-gray-400">Vence: 10/08/2024</span>
            </div>
        </div>

        <!-- Septiembre a Diciembre (No aplica) -->
        <div class="p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3 dark:bg-gray-600">
                <div class="h-1.5 rounded-full bg-gray-300 dark:bg-gray-500" style="width: 0%"></div>
            </div>
            <div class="flex justify-between items-start">
                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">
                    Septiembre</h4>
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full bg-gray-200 text-gray-600 dark:bg-gray-600 dark:text-gray-200">No
                    aplica</span>
            </div>
        </div>

        <div class="p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3 dark:bg-gray-600">
                <div class="h-1.5 rounded-full bg-gray-300 dark:bg-gray-500" style="width: 0%"></div>
            </div>
            <div class="flex justify-between items-start">
                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">Octubre
                </h4>
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full bg-gray-200 text-gray-600 dark:bg-gray-600 dark:text-gray-200">No
                    aplica</span>
            </div>
        </div>

        <div class="p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3 dark:bg-gray-600">
                <div class="h-1.5 rounded-full bg-gray-300 dark:bg-gray-500" style="width: 0%"></div>
            </div>
            <div class="flex justify-between items-start">
                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">
                    Noviembre</h4>
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full bg-gray-200 text-gray-600 dark:bg-gray-600 dark:text-gray-200">No
                    aplica</span>
            </div>
        </div>

        <div class="p-4 rounded-lg bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-3 dark:bg-gray-600">
                <div class="h-1.5 rounded-full bg-gray-300 dark:bg-gray-500" style="width: 0%"></div>
            </div>
            <div class="flex justify-between items-start">
                <h4 class="text-sm font-bold text-gray-700 dark:text-gray-200">
                    Diciembre</h4>
                <span
                    class="text-xs font-medium px-2 py-1 rounded-full bg-gray-200 text-gray-600 dark:bg-gray-600 dark:text-gray-200">No
                    aplica</span>
            </div>
        </div>
    </div>
</div>

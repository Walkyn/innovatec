@extends('layouts.app')
@section('title', 'Nexus - Direcciones IP')

@section('content')
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Gestión de Direcciones IP
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="/">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Direcciones IP</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Alerts Start -->
            @include('partials.alerts')
            <!-- ====== Alerts End -->
            
            <!-- ====== Controls Section Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <!-- Botones para acciones principales -->
                <div class="flex flex-row space-x-3 md:space-x-3">
                    <button data-modal-target="create-ip-modal" data-modal-toggle="create-ip-modal" type="button"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-8 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <i class="fas fa-plus-circle mr-2 text-gray-400"></i>
                        Nueva IP
                    </button>

                    <!-- Nuevo botón para filtrar por rango -->
                    <button data-modal-target="filter-range-modal" data-modal-toggle="filter-range-modal" type="button"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-8 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <i class="fas fa-filter mr-2 text-gray-400"></i>
                        Filtrar
                    </button>
                </div>
                
                <div class="relative">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <select id="search-type" class="rounded-l-lg border border-stroke bg-white py-2 px-3 outline-none focus:border-primary dark:border-strokedark dark:bg-boxdark dark:focus:border-primary">
                                <option value="all">Todos</option>
                                <option value="ip">IP</option>
                                <option value="client">Cliente</option>
                            </select>
                        </div>
                        <div class="flex-grow relative">
                            <input 
                                type="text" 
                                placeholder="Buscar IP o cliente" 
                                class="w-full rounded-r-lg border border-stroke border-l-0 bg-white py-2 pl-10 pr-6 outline-none focus:border-primary dark:border-strokedark dark:bg-boxdark dark:focus:border-primary"
                                id="ip-search"
                            >
                            <span class="absolute left-3 top-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-body" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                            <button id="clear-search" class="absolute right-2 top-2.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" style="display: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div id="search-count" class="mt-1 text-xs text-gray-500 dark:text-gray-400 hidden">
                        Mostrando <span id="count-results">0</span> resultados
                    </div>
                </div>
            </div>
            <!-- ====== Controls Section End -->

            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">
                <!-- Tabla de IPs con nuevo diseño -->
                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <!-- Cambia la altura máxima a 720px para 15 filas -->
                        <div style="max-height: 720px; overflow-y: auto;">
                            <table class="w-full whitespace-no-wrap">
                                <thead style="position: sticky; top: 0; z-index: 2; background: inherit;">
                                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3 sticky top-0 z-10 bg-gray-50 dark:bg-gray-800">Dirección IP</th>
                                        <th class="px-4 py-3 sticky top-0 z-10 bg-gray-50 dark:bg-gray-800">Cliente</th>
                                        <th class="px-4 py-3 sticky top-0 z-10 bg-gray-50 dark:bg-gray-800">Estado</th>
                                        <th class="px-4 py-3 sticky top-0 z-10 bg-gray-50 dark:bg-gray-800">Fecha</th>
                                        <th class="px-4 py-3 sticky top-0 z-10 bg-gray-50 dark:bg-gray-800">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @forelse($ips as $ip)
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm space-x-2">
                                                    <div>
                                                        <button 
                                                            class="font-semibold text-primary hover:underline ping-ip-btn"
                                                            data-ip="{{ $ip->ip_address }}"
                                                            type="button"
                                                            id="ip-{{ $ip->id }}"
                                                        >
                                                            {{ $ip->ip_address }}
                                                        </button>
                                                    </div>
                                                    <button 
                                                        type="button"
                                                        class="copy-ip-btn text-gray-400 hover:text-primary focus:outline-none"
                                                        data-ip="{{ $ip->ip_address }}"
                                                        title="Copiar IP"
                                                    >
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                @if($ip->contratoServicio && $ip->contratoServicio->contrato && $ip->contratoServicio->contrato->cliente)
                                                    {{ $ip->contratoServicio->contrato->cliente->nombres . ' ' . $ip->contratoServicio->contrato->cliente->apellidos }}
                                                @else
                                                    Sin asignar
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-xs">
                                                @if($ip->contratoServicio)
                                                    <span class="px-2 py-1 font-semibold leading-tight rounded-full text-yellow-700 bg-yellow-100 dark:bg-yellow-700 dark:text-yellow-100 flex items-center gap-1 whitespace-nowrap w-fit">
                                                        <i class="fas fa-check-circle text-xs"></i>
                                                        <span class="text-xs">En uso</span>
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 font-semibold leading-tight rounded-full text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100 flex items-center gap-1 whitespace-nowrap w-fit">
                                                        <i class="fas fa-circle text-xs"></i>
                                                        <span class="text-xs">Libre</span>
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $ip->created_at ? $ip->created_at->format('d/m/Y') : '' }}
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center space-x-4 text-sm">
                                                    <!-- Botón Eliminar -->
                                                    <button 
                                                        data-ip-id="{{ $ip->id }}"
                                                        data-modal-target="delete-ip-modal"
                                                        data-modal-toggle="delete-ip-modal"
                                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                        aria-label="Delete">
                                                        <i class="fas fa-trash-alt w-5 h-5"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">No hay direcciones IP registradas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ====== Table Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

    <!-- Modal Crear IP -->
    <div id="create-ip-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-boxdark">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="create-ip-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Gestión de Direcciones IP</h3>
                    
                    <!-- Tabs para IP Individual y Rango -->
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="ipTabs" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="ip-individual-tab" data-tabs-target="#ip-individual" type="button" role="tab" aria-controls="ip-individual" aria-selected="true">IP Individual</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="ip-range-tab" data-tabs-target="#ip-range" type="button" role="tab" aria-controls="ip-range" aria-selected="false">Rango de IPs</button>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Contenido de los tabs -->
                    <div id="ipTabContent">
                        <!-- Tab IP Individual -->
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="ip-individual" role="tabpanel" aria-labelledby="ip-individual-tab">
                            <form class="space-y-6" action="#" method="POST">
                                @csrf
                                <div>
                                    <label for="ip_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección IP</label>
                                    <input type="text" name="ip_address" id="ip_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="192.168.1.1" required>
                                    <div id="ip_address_error" class="text-red-600 text-xs mt-1" style="display:none"></div>
                                </div>
                                <div class="flex items-center">
                                    <input checked id="status_libre" type="checkbox" name="status" value="0" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary dark:focus:ring-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" disabled>
                                    <label for="status_libre" class="ml-2 text-sm font-medium text-gray-900 dark:text-white">Libre</label>
                                    <input type="hidden" name="status" value="0">
                                </div>
                                <button type="submit" class="w-full text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center">Guardar</button>
                            </form>
                        </div>
                        
                        <!-- Tab Rango de IPs -->
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="ip-range" role="tabpanel" aria-labelledby="ip-range-tab">
                            <form class="space-y-6" id="ip-range-form" method="POST" action="#">
                                @csrf
                                <div>
                                    <label for="ip_start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IP Inicial</label>
                                    <input type="text" name="ip_start" id="ip_start" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="192.168.1.1" required>
                                    <div id="ip_start_error" class="text-red-600 text-xs mt-1" style="display:none"></div>
                                </div>
                                <div>
                                    <label for="ip_end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IP Final</label>
                                    <input type="text" name="ip_end" id="ip_end" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="192.168.1.254" required>
                                    <div id="ip_end_error" class="text-red-600 text-xs mt-1" style="display:none"></div>
                                </div>
                                <div class="flex items-center">
                                    <input checked id="range_status_libre" type="checkbox" name="range_status" value="0" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary dark:focus:ring-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" disabled>
                                    <label for="range_status_libre" class="ml-2 text-sm font-medium text-gray-900 dark:text-white">Libre</label>
                                    <input type="hidden" name="range_status" value="0">
                                </div>
                                <button type="submit" class="w-full text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center">Generar IPs</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar IP -->
    <div id="delete-ip-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-boxdark">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-ip-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Eliminar Dirección IP</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">¿Estás seguro de que deseas eliminar esta dirección IP? Esta acción no se puede deshacer.</p>
                    <form class="space-y-6" id="delete-ip-form" method="POST" action="#">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-end space-x-3">
                            <button type="button" data-modal-hide="delete-ip-modal" class="text-gray-500 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg text-sm font-medium px-5 py-2.5">Cancelar</button>
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar el resultado del ping -->
    <div id="ping-modal" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black bg-opacity-40">
        <div class="relative w-full max-w-lg max-h-full mx-auto mt-20">
            <div class="relative bg-white rounded-lg shadow dark:bg-boxdark p-6">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Resultado del Ping</h3>
                <div id="ping-modal-status" class="mb-2 text-sm"></div>
                <pre id="ping-modal-output" class="bg-gray-100 dark:bg-gray-900 p-3 rounded text-xs overflow-x-auto" style="max-height: 300px;"></pre>
                <div class="flex justify-end mt-4 space-x-2">
                    <button type="button" id="open-ip-btn"
                        class="flex items-center text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 rounded-lg text-sm font-medium px-5 py-2.5">
                        <i class="fas fa-external-link-alt mr-2"></i> Abrir en navegador
                    </button>
                    <button type="button" onclick="cerrarPingModal()"
                        class="text-gray-500 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-lg text-sm font-medium px-5 py-2.5">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Filtrar por Rango de IPs -->
    <div id="filter-range-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-boxdark">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="filter-range-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Filtrar IPs</h3>
                    <div class="space-y-6">
                        <div>
                            <label for="ip_range_select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rango de IP</label>
                            <select id="ip_range_select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                <option value="all">Todos los rangos</option>
                            </select>
                        </div>
                        
                        <!-- Nuevo filtro por estado -->
                        <div>
                            <label for="ip_status_select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                            <select id="ip_status_select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                <option value="all">Todos los estados</option>
                                <option value="free">Libre</option>
                                <option value="used">En uso</option>
                            </select>
                        </div>
                        
                        <div class="flex space-x-3">
                            <button type="button" id="apply-range-filter" data-modal-hide="filter-range-modal" class="flex-1 text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center">Aplicar Filtro</button>
                            <button type="button" id="clear-range-filter" data-modal-hide="filter-range-modal" class="flex-1 text-center text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Ver Todas</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para funcionalidad de modales y tabs -->
    <script>
        let currentIp = null;
        let abortController = null;

        // Variables para almacenar las selecciones actuales
        let currentRangeFilter = 'all';
        let currentStatusFilter = 'all';

        // Variables para el buscador
        let currentSearchType = 'all';
        let currentSearchText = '';

        function cerrarPingModal() {
            document.getElementById('ping-modal').classList.add('hidden');
            // Si hay alguna solicitud activa, la cancelamos
            if (abortController) {
                abortController.abort();
                abortController = null;
            }
            currentIp = null;
        }

        function formatearPing(pingRaw) {
            // Resalta líneas importantes
            if (!pingRaw) return '';
            let html = pingRaw
                .replace(/(Tiempo de espera agotado para esta solicitud)/gi, '<span class="font-bold text-red-600">$1</span>')
                .replace(/(Host de destino inaccesible)/gi, '<span class="font-bold text-red-600">$1</span>')
                .replace(/(Paquetes: enviados = \d+, recibidos = \d+, perdidos = \d+)/gi, '<span class="font-bold text-blue-700">$1</span>')
                .replace(/(\d+% perdidos)/gi, '<span class="font-bold text-red-600">$1</span>')
                .replace(/(Respuesta desde [^\n]+)/gi, '<span class="text-green-700">$1</span>')
                .replace(/(Tiempo.*milisegundos:)/gi, '<span class="font-bold text-blue-700">$1</span>')
                .replace(/(Estad[íi]sticas de ping[^\n]*)/gi, '<span class="font-bold text-gray-700">$1</span>');

            html = html.replace(/\?/g, 'í');
            return html;
        }

        function hacerPing() {
            if (!currentIp) return;
            
            // Cancelar cualquier solicitud anterior
            if (abortController) {
                abortController.abort();
            }
            
            // Crear un nuevo controlador para esta solicitud
            abortController = new AbortController();
            
            document.getElementById('ping-modal-status').textContent = "Realizando ping a " + currentIp + "...";
            
            fetch('{{ route('ips.ping') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ ip: currentIp }),
                signal: abortController.signal
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('ping-modal-status').textContent = "Resultado del ping a " + currentIp;
                document.getElementById('ping-modal-output').innerHTML = formatearPing(data.output || 'No se pudo obtener respuesta del ping.');
            })
            .catch(err => {
                // Solo mostrar errores que no sean por cancelación
                if (err.name !== 'AbortError') {
                    document.getElementById('ping-modal-output').textContent = 'Error al realizar el ping.';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.ping-ip-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    if (abortController) {
                        abortController.abort();
                        abortController = null;
                    }
                    
                    // Configurar nueva IP
                    currentIp = this.getAttribute('data-ip');
                    document.getElementById('ping-modal').classList.remove('hidden');
                    document.getElementById('ping-modal-status').textContent = "Iniciando ping a " + currentIp + "...";
                    document.getElementById('ping-modal-output').innerHTML = '';
                    
                    // Hacer un único ping
                    hacerPing();
                });
            });

            // Código para inicializar las pestañas
            const tabs = document.querySelectorAll('[data-tabs-target]');
            const tabContents = document.querySelectorAll('[role="tabpanel"]');
            
            // Por defecto, mostrar la primera pestaña
            document.getElementById('ip-individual').classList.remove('hidden');
            document.getElementById('ip-individual-tab').classList.add('text-primary', 'border-primary');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const target = document.querySelector(this.getAttribute('data-tabs-target'));
                    
                    // Ocultar todos los contenidos de pestañas
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    
                    // Quitar estilos activos de todas las pestañas
                    tabs.forEach(t => {
                        t.classList.remove('text-primary', 'border-primary');
                        t.classList.add('border-transparent');
                    });
                    
                    // Mostrar el contenido de la pestaña seleccionada
                    target.classList.remove('hidden');
                    
                    // Aplicar estilos activos a la pestaña seleccionada
                    this.classList.add('text-primary', 'border-primary');
                    this.classList.remove('border-transparent');
                });
            });

            // Código para configurar el modal de eliminación
            const deleteButtons = document.querySelectorAll('[data-modal-target="delete-ip-modal"]');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const ipId = this.getAttribute('data-ip-id');
                    const form = document.getElementById('delete-ip-form');
                    form.action = `/ips/${ipId}`;
                });
            });

            function mostrarToastCopiado() {
                const toast = document.getElementById('toast-success');
                toast.style.display = 'flex';
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 1500);
            }

            document.querySelectorAll('.copy-ip-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const ip = this.getAttribute('data-ip');
                    if (navigator.clipboard) {
                        navigator.clipboard.writeText(ip).then(() => {
                            mostrarToastCopiado();
                        });
                    } else {
                        // Fallback para navegadores antiguos
                        const tempInput = document.createElement('input');
                        tempInput.value = ip;
                        document.body.appendChild(tempInput);
                        tempInput.select();
                        document.execCommand('copy');
                        document.body.removeChild(tempInput);
                        mostrarToastCopiado();
                    }
                });
            });

            function esIPValidaClaseABC(ip) {
                const partes = ip.split('.');
                if (partes.length !== 4) return false;
                // Validar que todos los octetos sean números entre 0 y 255
                for (let i = 0; i < 4; i++) {
                    const num = parseInt(partes[i], 10);
                    if (isNaN(num) || num < 0 || num > 255) return false;
                }
                const primerOcteto = parseInt(partes[0], 10);
                // Clase A: 1-126, Clase B: 128-191, Clase C: 192-223
                if (
                    (primerOcteto >= 1 && primerOcteto <= 126) ||
                    (primerOcteto >= 128 && primerOcteto <= 191) ||
                    (primerOcteto >= 192 && primerOcteto <= 223)
                ) {
                    return true;
                }
                return false;
            }

            function mostrarError(input, mensaje) {
                input.classList.add('border-red-500');
                const errorDiv = document.getElementById(input.id + '_error');
                if (errorDiv) {
                    errorDiv.textContent = mensaje;
                    errorDiv.style.display = 'block';
                }
            }

            function limpiarError(input) {
                input.classList.remove('border-red-500');
                const errorDiv = document.getElementById(input.id + '_error');
                if (errorDiv) {
                    errorDiv.textContent = '';
                    errorDiv.style.display = 'none';
                }
            }

            // Validación en tiempo real para IP Inicial y Final
            const ipStartInput = document.getElementById('ip_start');
            const ipEndInput = document.getElementById('ip_end');

            [ipStartInput, ipEndInput].forEach(function(input) {
                input.addEventListener('input', function() {
                    const valor = input.value.trim();
                    if (valor.length === 0) {
                        limpiarError(input);
                        return;
                    }
                    if (!esIPValidaClaseABC(valor)) {
                        mostrarError(input, 'La IP debe ser válida.');
                        return;
                    }
                    limpiarError(input);
                });
            });

            document.getElementById('ip-range-form').addEventListener('submit', function(e) {
                const ipStart = document.getElementById('ip_start').value.trim();
                const ipEnd = document.getElementById('ip_end').value.trim();

                if (!esIPValidaClaseABC(ipStart)) {
                    alert('La IP inicial no es válida.');
                    e.preventDefault();
                    return false;
                }
                if (!esIPValidaClaseABC(ipEnd)) {
                    alert('La IP final no es válida.');
                    e.preventDefault();
                    return false;
                }
                // Validar que la IP final sea mayor o igual a la inicial
                function ipToNumber(ip) {
                    return ip.split('.').reduce((acc, oct) => acc * 256 + parseInt(oct, 10), 0);
                }
                if (ipToNumber(ipEnd) < ipToNumber(ipStart)) {
                    alert('La IP final debe ser mayor o igual a la IP inicial.');
                    e.preventDefault();
                    return false;
                }
            });

            // Validación en tiempo real para IP Individual
            const ipAddressInput = document.getElementById('ip_address');
            if (ipAddressInput) {
                ipAddressInput.addEventListener('input', function() {
                    const valor = ipAddressInput.value.trim();
                    if (valor.length === 0) {
                        limpiarError(ipAddressInput);
                        return;
                    }
                    if (!esIPValidaClaseABC(valor)) {
                        mostrarError(ipAddressInput, 'La IP debe ser válida.');
                        return;
                    }
                    limpiarError(ipAddressInput);
                });
            }

            const ipIndividualForm = document.querySelector('#ip-individual form');
            if (ipIndividualForm) {
                ipIndividualForm.addEventListener('submit', function(e) {
                    const valor = ipAddressInput.value.trim();
                    if (!esIPValidaClaseABC(valor)) {
                        mostrarError(ipAddressInput, 'La IP debe ser válida.');
                        e.preventDefault();
                        return false;
                    }
                    limpiarError(ipAddressInput);
                });
            }

            document.getElementById('open-ip-btn').onclick = function() {
                if (currentIp) {
                    window.open('http://' + currentIp, '_blank');
                }
            };

            // Asegurarse de que el botón de cerrar llama a cerrarPingModal
            document.querySelector('[onclick="cerrarPingModal()"]').addEventListener('click', cerrarPingModal);
            
            // Opcional: Cerrar el modal con la tecla ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !document.getElementById('ping-modal').classList.contains('hidden')) {
                    cerrarPingModal();
                }
            });

            // Función para extraer el rango de una IP (primeros 3 octetos)
            function obtenerRangoDeIP(ip) {
                return ip.split('.').slice(0, 3).join('.');
            }
            
            // Función para cargar dinámicamente los rangos disponibles
            function cargarRangosDisponibles() {
                const ips = [];
                document.querySelectorAll('.ping-ip-btn').forEach(function(btn) {
                    ips.push(btn.getAttribute('data-ip'));
                });
                
                // Extraer rangos únicos
                const rangosUnicos = [...new Set(ips.map(ip => obtenerRangoDeIP(ip)))];
                rangosUnicos.sort(); // Ordenar alfabéticamente
                
                // Cargar los rangos en el selector
                const rangeSelect = document.getElementById('ip_range_select');
                // Mantener la opción "Todos los rangos"
                rangeSelect.innerHTML = '<option value="all">Todos los rangos</option>';
                
                // Agregar cada rango como una opción
                rangosUnicos.forEach(rango => {
                    const option = document.createElement('option');
                    option.value = rango;
                    option.textContent = rango + '.x';
                    rangeSelect.appendChild(option);
                });
            }
            
            // Método seguro para cerrar el modal
            function cerrarModalRango() {
                const modal = document.getElementById('filter-range-modal');
                modal.classList.add('hidden');
                
                // Remover cualquier overlay
                document.querySelectorAll('[modal-backdrop]').forEach(el => {
                    el.remove();
                });
                
                // Remover la clase que bloquea el scroll
                document.body.classList.remove('overflow-hidden');
            }
            
            // Cargar los rangos cuando se abre el modal
            const btnAbrirModalRango = document.querySelector('[data-modal-target="filter-range-modal"]');
            if (btnAbrirModalRango) {
                btnAbrirModalRango.addEventListener('click', function() {
                    cargarRangosDisponibles();
                    
                    // Restaurar las selecciones previas
                    const rangeSelect = document.getElementById('ip_range_select');
                    const statusSelect = document.getElementById('ip_status_select');
                    
                    // Establecer valores seleccionados
                    if (rangeSelect.querySelector(`option[value="${currentRangeFilter}"]`)) {
                        rangeSelect.value = currentRangeFilter;
                    }
                    
                    statusSelect.value = currentStatusFilter;
                    
                    // Mostrar el modal
                    document.getElementById('filter-range-modal').classList.remove('hidden');
                });
            }
            
            // Filtrar las IPs cuando se aplica el filtro
            const btnAplicarFiltro = document.getElementById('apply-range-filter');
            if (btnAplicarFiltro) {
                btnAplicarFiltro.addEventListener('click', function() {
                    const rangeSelect = document.getElementById('ip_range_select');
                    const statusSelect = document.getElementById('ip_status_select');
                    
                    // Guardar las selecciones actuales
                    currentRangeFilter = rangeSelect.value;
                    currentStatusFilter = statusSelect.value;
                    
                    // Cerrar el modal de forma segura
                    cerrarModalRango();
                    
                    // Realizar la búsqueda integrada con los filtros
                    if (typeof performSearch === 'function') {
                        performSearch();
                    } else {
                        document.querySelectorAll('tbody tr').forEach(tr => {
                            const ipBtn = tr.querySelector('.ping-ip-btn');
                            if (!ipBtn) return;
                            
                            // Verificar el rango
                            let mostrarPorRango = true;
                            if (currentRangeFilter !== 'all') {
                                const ip = ipBtn.getAttribute('data-ip');
                                const ipRange = obtenerRangoDeIP(ip);
                                mostrarPorRango = (ipRange === currentRangeFilter);
                            }
                            
                            // Verificar el estado
                            let mostrarPorEstado = true;
                            if (currentStatusFilter !== 'all') {
                                const estadoElement = tr.querySelector('td:nth-child(3) span');
                                if (estadoElement) {
                                    const estadoTexto = estadoElement.textContent.trim();
                                    if (currentStatusFilter === 'free' && !estadoTexto.includes('Libre')) {
                                        mostrarPorEstado = false;
                                    } else if (currentStatusFilter === 'used' && !estadoTexto.includes('En uso')) {
                                        mostrarPorEstado = false;
                                    }
                                }
                            }
                            
                            // Mostrar u ocultar la fila según ambos filtros
                            if (mostrarPorRango && mostrarPorEstado) {
                                tr.style.display = '';
                            } else {
                                tr.style.display = 'none';
                            }
                        });
                    }
                });
            }
            
            const btnVerTodas = document.getElementById('clear-range-filter');
            if (btnVerTodas) {
                btnVerTodas.addEventListener('click', function() {
                    currentRangeFilter = 'all';
                    currentStatusFilter = 'all';
                    
                    document.querySelectorAll('tbody tr').forEach(tr => {
                        tr.style.display = '';
                    });
                    
                    cerrarModalRango();
                });
            }
            
            const btnCerrarModal = document.querySelector('#filter-range-modal [data-modal-hide="filter-range-modal"]');
            if (btnCerrarModal) {
                btnCerrarModal.addEventListener('click', cerrarModalRango);
            }

            // Agregar filtrado por búsqueda de texto
            const ipSearchInput = document.getElementById('ip-search');
            const searchTypeSelect = document.getElementById('search-type');
            const clearSearchBtn = document.getElementById('clear-search');
            const searchCountDiv = document.getElementById('search-count');
            const countResultsSpan = document.getElementById('count-results');

            if (ipSearchInput && searchTypeSelect) {
                // Función para realizar la búsqueda
                function performSearch() {
                    const searchText = ipSearchInput.value.toLowerCase().trim();
                    const searchType = searchTypeSelect.value;
                    
                    // Guardar valores actuales para restaurar en el futuro
                    currentSearchText = searchText;
                    currentSearchType = searchType;
                    
                    // Mostrar/ocultar botón de limpiar
                    clearSearchBtn.style.display = searchText ? 'block' : 'none';
                    
                    let count = 0;
                    
                    document.querySelectorAll('tbody tr').forEach(tr => {
                        // No filtrar si ya está oculto por otros filtros
                        if (tr.style.display === 'none' && !searchText) return;
                        
                        const ipText = tr.querySelector('.ping-ip-btn')?.textContent.toLowerCase() || '';
                        const clientText = tr.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                        
                        let matches = false;
                        
                        if (searchText === '') {
                            // Si no hay texto de búsqueda, mostrar todo
                            matches = true;
                        } else if (searchType === 'all') {
                            // Buscar en ambos campos
                            matches = ipText.includes(searchText) || clientText.includes(searchText);
                        } else if (searchType === 'ip') {
                            // Buscar solo en IP
                            matches = ipText.includes(searchText);
                        } else if (searchType === 'client') {
                            // Buscar solo en cliente
                            matches = clientText.includes(searchText);
                        }
                        
                        // Verificar también los filtros actuales de rango y estado
                        let pasaFiltros = true;
                        
                        // Verificar filtro de rango
                        if (currentRangeFilter !== 'all') {
                            const ipBtn = tr.querySelector('.ping-ip-btn');
                            if (ipBtn) {
                                const ip = ipBtn.getAttribute('data-ip');
                                const ipRange = obtenerRangoDeIP(ip);
                                if (ipRange !== currentRangeFilter) {
                                    pasaFiltros = false;
                                }
                            }
                        }
                        
                        // Verificar filtro de estado
                        if (currentStatusFilter !== 'all' && pasaFiltros) {
                            const estadoElement = tr.querySelector('td:nth-child(3) span');
                            if (estadoElement) {
                                const estadoTexto = estadoElement.textContent.trim();
                                if (currentStatusFilter === 'free' && !estadoTexto.includes('Libre')) {
                                    pasaFiltros = false;
                                } else if (currentStatusFilter === 'used' && !estadoTexto.includes('En uso')) {
                                    pasaFiltros = false;
                                }
                            }
                        }
                        
                        // Aplicar resultados
                        if (matches && pasaFiltros) {
                            tr.style.display = '';
                            count++;
                        } else {
                            tr.style.display = 'none';
                        }
                    });
                    
                    // Actualizar contador de resultados
                    countResultsSpan.textContent = count;
                    searchCountDiv.classList.toggle('hidden', !searchText);
                    
                    // Agregar clase de "sin resultados" a la tabla si no hay coincidencias
                    const tbody = document.querySelector('tbody');
                    if (count === 0 && searchText) {
                        // Si no existe una fila de "no hay resultados", crearla
                        if (!document.getElementById('no-results-row')) {
                            const noResultsRow = document.createElement('tr');
                            noResultsRow.id = 'no-results-row';
                            noResultsRow.innerHTML = `
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-lg font-semibold">No se encontraron resultados</p>
                                        <p class="text-sm">Intenta cambiar los criterios de búsqueda</p>
                                    </div>
                                </td>
                            `;
                            tbody.appendChild(noResultsRow);
                        } else {
                            document.getElementById('no-results-row').style.display = '';
                        }
                    } else if (document.getElementById('no-results-row')) {
                        document.getElementById('no-results-row').style.display = 'none';
                    }
                }
                
                // Eventos para los controles de búsqueda
                ipSearchInput.addEventListener('input', performSearch);
                
                searchTypeSelect.addEventListener('change', function() {
                    actualizarPlaceholder();
                    performSearch();
                });
                
                actualizarPlaceholder();
                
                clearSearchBtn.addEventListener('click', function() {
                    ipSearchInput.value = '';
                    currentSearchText = '';
                    performSearch();
                    ipSearchInput.focus();
                });
                
                btnAplicarFiltro.addEventListener('click', function() {
                    setTimeout(performSearch, 100);
                });
                
                btnVerTodas.addEventListener('click', function() {
                    setTimeout(performSearch, 100);
                });
            }
        });

        function actualizarPlaceholder() {
            const searchType = document.getElementById('search-type').value;
            const searchInput = document.getElementById('ip-search');
            
            switch(searchType) {
                case 'ip':
                    searchInput.placeholder = "Buscar por dirección IP";
                    break;
                case 'client':
                    searchInput.placeholder = "Buscar por nombre de cliente";
                    break;
                default:
                    searchInput.placeholder = "Buscar por IP o cliente";
                    break;
            }
        }
    </script>

    <div id="toast-copiado" style="display:none; position:fixed; bottom:30px; left:50%; transform:translateX(-50%); z-index:9999;"
        class="bg-green-600 text-white px-4 py-2 rounded shadow-lg text-sm">
        ¡IP copiada al portapapeles!
    </div>

    <div id="toast-success" style="display:none; position:fixed; bottom:30px; left:50%; transform:translateX(-50%); z-index:9999;"
        class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 dark:bg-white bg-gray-800 text-white rounded-lg shadow-sm dark:text-gray-800 dark:bg-gray-800"
        role="alert">
        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal" id="toast-success-msg">¡IP copiada al portapapeles!</div>
        <button type="button" onclick="document.getElementById('toast-success').style.display='none';"
            class="ms-auto -mx-1.5 -my-1.5 dark:bg-white bg-gray-800 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-700 inline-flex items-center hover:text-gray-200 justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-gray-500 dark:bg-gray-800 dark:hover:bg-gray-200"
            aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
@endsection

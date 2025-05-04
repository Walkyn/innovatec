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
                <!-- Botones para acciones principales (sin importar/exportar) -->
                <div class="flex flex-row space-x-3 md:space-x-3">
                    <button data-modal-target="create-ip-modal" data-modal-toggle="create-ip-modal" type="button"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-8 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <i class="fas fa-plus-circle mr-2 text-gray-400"></i>
                        Nueva IP
                    </button>

                    <button data-modal-target="filter-ip-modal" data-modal-toggle="filter-ip-modal" type="button"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-8 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <i class="fas fa-filter mr-2 text-gray-400"></i>
                        Filtrar
                    </button>
                </div>
                
                <div class="relative">
                    <input 
                        type="text" 
                        placeholder="Buscar IP..." 
                        class="w-full rounded-lg border border-stroke bg-white py-2 pl-10 pr-6 outline-none focus:border-primary dark:border-strokedark dark:bg-boxdark dark:focus:border-primary"
                        id="ip-search"
                    >
                    <span class="absolute left-3 top-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-body" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                </div>
            </div>
            <!-- ====== Controls Section End -->

            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">
                <!-- Tabla de IPs con nuevo diseño -->
                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">Dirección IP</th>
                                    <th class="px-4 py-3">Cliente</th>
                                    <th class="px-4 py-3">Estado</th>
                                    <th class="px-4 py-3">Fecha</th>
                                    <th class="px-4 py-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @forelse($ips as $ip)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm space-x-2">
                                                <div>
                                                    <p class="font-semibold" id="ip-{{ $ip->id }}">{{ $ip->ip_address }}</p>
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
                                                <span class="px-2 py-1 font-semibold leading-tight rounded-full text-blue-700 bg-blue-100 dark:bg-blue-700 dark:text-blue-100 flex items-center gap-1 whitespace-nowrap w-fit">
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
                    
                    <!-- Paginación (simple para ejemplo) -->
                    <div>
                        {{ $ips->links() }}
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

    <!-- Modal Filtrar IPs por Rango (sin campo 'asignadas a') -->
    <div id="filter-ip-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-boxdark">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="filter-ip-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Filtrar IPs</h3>
                    <form class="space-y-6" action="#" method="GET">
                        <div class="border-b border-gray-200 pb-4 dark:border-gray-700">

                            <div>
                                <label for="filter_ip_start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IP Inicial</label>
                                <input type="text" name="filter_ip_start" id="filter_ip_start" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="192.168.1.1">
                            </div>
                            <div class="mt-4">
                                <label for="filter_ip_end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IP Final</label>
                                <input type="text" name="filter_ip_end" id="filter_ip_end" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="192.168.1.254">
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="mb-2 text-md font-medium text-gray-900 dark:text-white">Estado</h4>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input id="filter_status_all" type="radio" name="filter_status" value="" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary dark:focus:ring-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                                    <label for="filter_status_all" class="ml-2 text-sm font-medium text-gray-900 dark:text-white">Todos</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="filter_status_en_uso" type="radio" name="filter_status" value="1" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary dark:focus:ring-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="filter_status_en_uso" class="ml-2 text-sm font-medium text-gray-900 dark:text-white">En uso</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="filter_status_libre" type="radio" name="filter_status" value="0" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary dark:focus:ring-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="filter_status_libre" class="ml-2 text-sm font-medium text-gray-900 dark:text-white">Libre</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex space-x-3">
                            <button type="submit" class="flex-1 text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center">Aplicar Filtros</button>
                            <button type="reset" class="flex-1 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Limpiar</button>
                        </div>
                    </form>
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

    <!-- JavaScript para funcionalidad de modales y tabs -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                    // Cambia el action del formulario para que apunte a /ips/{id}
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
                        mostrarError(ipAddressInput, 'La IP debe ser válida y de clase A, B o C.');
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
                        mostrarError(ipAddressInput, 'La IP debe ser válida y de clase A, B o C.');
                        e.preventDefault();
                        return false;
                    }
                    limpiarError(ipAddressInput);
                });
            }
        });
    </script>

    <div id="toast-copiado" style="display:none; position:fixed; bottom:30px; left:50%; transform:translateX(-50%); z-index:9999;"
        class="bg-green-600 text-white px-4 py-2 rounded shadow-lg text-sm">
        ¡IP copiada al portapapeles!
    </div>

    <div id="toast-success" style="display:none; position:fixed; bottom:30px; left:50%; transform:translateX(-50%); z-index:9999;"
        class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800"
        role="alert">
        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal" id="toast-success-msg">¡IP copiada al portapapeles!</div>
        <button type="button" onclick="document.getElementById('toast-success').style.display='none';"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
@endsection

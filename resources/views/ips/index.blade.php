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
                                    <th class="px-4 py-3">Asignada a</th>
                                    <th class="px-4 py-3">Estado</th>
                                    <th class="px-4 py-3">Fecha creación</th>
                                    <th class="px-4 py-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @forelse($ips ?? [] as $ip)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-semibold">{{ $ip->address }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $ip->assigned_to ?? 'Sin asignar' }}
                                        </td>
                                        <td class="px-4 py-3 text-xs">
                                            @php
                                                $estadoClase = [
                                                    '1' => 'text-blue-700 bg-blue-100 dark:bg-blue-700 dark:text-blue-100',
                                                    '0' => 'text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100',
                                                ];
                                            @endphp

                                            <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $estadoClase[$ip->status ? '1' : '0'] }} flex items-center gap-1 whitespace-nowrap w-fit">
                                                <i class="fas {{ $ip->status ? 'fa-check-circle' : 'fa-circle' }} text-xs"></i>
                                                <span class="text-xs">{{ $ip->status ? 'En uso' : 'Sin usar' }}</span>
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $ip->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">
                                                <!-- Botón Editar -->
                                                <button
                                                    data-ip-id="{{ $ip->id }}"
                                                    data-modal-target="edit-ip-modal"
                                                    data-modal-toggle="edit-ip-modal"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                    aria-label="Edit">
                                                    <i class="fas fa-edit w-5 h-5"></i>
                                                </button>

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
                                        <td colspan="5" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                            No hay direcciones IP registradas
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Paginación -->
                    @if(isset($ips) && $ips->hasPages())
                    <div>
                        {{ $ips->links() }}
                    </div>
                    @endif
                </div>
            </div>
            <!-- ====== Table Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

    <!-- Modal Crear IP (sin campo 'asignada a') -->
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
                                </div>
                                <div class="flex items-center">
                                    <input checked id="status" type="checkbox" name="status" value="1" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary dark:focus:ring-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="status" class="ml-2 text-sm font-medium text-gray-900 dark:text-white">En uso</label>
                                </div>
                                <button type="submit" class="w-full text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center">Guardar</button>
                            </form>
                        </div>
                        
                        <!-- Tab Rango de IPs -->
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="ip-range" role="tabpanel" aria-labelledby="ip-range-tab">
                            <form class="space-y-6" action="#" method="POST">
                                @csrf
                                <div>
                                    <label for="ip_start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IP Inicial</label>
                                    <input type="text" name="ip_start" id="ip_start" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="192.168.1.1" required>
                                </div>
                                <div>
                                    <label for="ip_end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IP Final</label>
                                    <input type="text" name="ip_end" id="ip_end" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="192.168.1.254" required>
                                </div>
                                <div class="flex items-center">
                                    <input checked id="range_status" type="checkbox" name="range_status" value="1" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary dark:focus:ring-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="range_status" class="ml-2 text-sm font-medium text-gray-900 dark:text-white">En uso</label>
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
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Filtrar IPs por Rango</h3>
                    <form class="space-y-6" action="#" method="GET">
                        <div>
                            <label for="filter_ip_start" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IP Inicial</label>
                            <input type="text" name="filter_ip_start" id="filter_ip_start" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="192.168.1.1">
                        </div>
                        <div>
                            <label for="filter_ip_end" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IP Final</label>
                            <input type="text" name="filter_ip_end" id="filter_ip_end" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="192.168.1.254">
                        </div>
                        <div>
                            <label for="filter_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                            <select name="filter_status" id="filter_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                <option value="">Todos</option>
                                <option value="1">En uso</option>
                                <option value="0">Sin usar</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center">Aplicar Filtros</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar IP (sin campo 'asignada a') -->
    <div id="edit-ip-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-boxdark">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-ip-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Editar Dirección IP</h3>
                    <form class="space-y-6" id="edit-ip-form" method="POST" action="#">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="edit_ip_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección IP</label>
                            <input type="text" name="ip_address" id="edit_ip_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div class="flex items-center">
                            <input id="edit_status" type="checkbox" name="status" value="1" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary dark:focus:ring-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="edit_status" class="ml-2 text-sm font-medium text-gray-900 dark:text-white">En uso</label>
                        </div>
                        <button type="submit" class="w-full text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center">Actualizar</button>
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
                        <input type="hidden" id="delete_ip_id" name="ip_id">
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

            // Código para cargar datos en el modal de edición
            const editButtons = document.querySelectorAll('[data-modal-target="edit-ip-modal"]');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const ipId = this.getAttribute('data-ip-id');
                    // Por ahora solo muestra el modal, sin lógica real
                    console.log("Editar IP:", ipId);
                });
            });

            // Código para configurar el modal de eliminación
            const deleteButtons = document.querySelectorAll('[data-modal-target="delete-ip-modal"]');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const ipId = this.getAttribute('data-ip-id');
                    // Por ahora solo muestra el modal, sin lógica real
                    console.log("Eliminar IP:", ipId);
                });
            });
        });
    </script>
@endsection

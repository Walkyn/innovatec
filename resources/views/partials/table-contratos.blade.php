<main class="h-full pb-16 overflow-y-auto">
    <div>
        <div class="flex justify-between items-center mb-4">
            <!-- Título -->
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                Lista de Contratos
            </h4>

            <!-- Botones -->
            <div class="flex space-x-4">
                <button data-modal-target="contrato-modal" data-modal-toggle="contrato-modal" type="button"
                    class="flex items-center px-8 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-md active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    <i class="fas fa-plus mr-2"></i>
                    Nuevo
                </button>
            </div>
        </div>

        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0 md:space-x-4 mb-4">
            <!-- Item Buscador Start -->
            <form class="w-full md:w-2/3">
                <label for="default-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar Contratos, Clientes..." required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                </div>
            </form>
            <!-- Item Buscador End -->

            <!-- Campo de Estado Servicio -->
            <div class="w-full md:w-1/3">
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-4 px-4 pr-8 rounded-md leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800"
                        id="servicio">
                        <option>Activo</option>
                        <option>Inactivo</option>
                        <option>Suspendido</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table x-data="{ openDropdown: null }" class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Código</th>
                            <th class="px-4 py-3">Cliente</th>
                            <th class="px-4 py-3">Servicios</th>
                            <th class="px-4 py-3">IPs</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Fecha</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($contratos as $contrato)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm font-mono">
                                    {{ 'CTR-' . str_pad($contrato->id, 6, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <p class="font-semibold">{{ $contrato->cliente->nombres }}
                                        {{ $contrato->cliente->apellidos }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        {{ $contrato->cliente->identificacion ?? 'N/A' }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm text-center">{{ $contrato->totalServicios() }}</td>
                                <td class="px-4 py-3 text-sm relative">
                                    @php
                                        $ips = $contrato->contratoServicios->pluck('ip_servicio')->filter()->unique();
                                    @endphp
                                    @if ($ips->isEmpty())
                                        <span class="text-gray-500 dark:text-gray-400">No disponible</span>
                                    @elseif ($ips->count() == 1)
                                        <a href="http://{{ $ips->first() }}" target="_blank"
                                            onclick="event.preventDefault(); window.open('http://{{ $ips->first() }}', '_blank'); showToast('{{ $ips->first() }}');"
                                            class="text-blue-500 hover:underline">
                                            {{ $ips->first() }}
                                        </a>
                                    @else
                                        <div class="relative inline-block">
                                            <!-- Botón para mostrar/ocultar el desplegable de IPs -->
                                            <button
                                                @click="openDropdown === {{ $contrato->id }} ? openDropdown = null : openDropdown = {{ $contrato->id }}"
                                                class="inline-flex items-center text-sm dark:text-white">
                                                <i
                                                    :class="openDropdown === {{ $contrato->id }} ?
                                                        'fas fa-chevron-up mr-2 text-xs' :
                                                        'fas fa-chevron-down mr-2 text-xs'"></i>
                                                <span class="transition-colors duration-200"
                                                    :class="openDropdown === {{ $contrato->id }} ? 'text-blue-500' : ''">Ver
                                                    IPs</span>
                                            </button>

                                            <!-- Desplegable de IPs -->
                                            <div x-show="openDropdown === {{ $contrato->id }}" x-transition
                                                class="fixed z-50 mt-2 bg-zinc-100 divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600"
                                                style="display: none;">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                                    @foreach ($ips as $ip)
                                                        <li>
                                                            <a href="http://{{ $ip }}" target="_blank"
                                                                onclick="event.preventDefault(); window.open('http://{{ $ip }}', '_blank'); showToast('{{ $ip }}');"
                                                                class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                {{ $ip }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">{{ number_format($contrato->totalPago(), 2) }}</td>
                                <td class="px-4 py-3 text-sm w-32 whitespace-nowrap">
                                    {{ $contrato->fecha_contrato ? $contrato->fecha_contrato->format('d-m-Y') : 'N/A' }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @php
                                        $estadoClase = [
                                            'activo' =>
                                                'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100',
                                            'suspendido' => 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100',
                                        ];
                                    @endphp
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight rounded-full {{ $estadoClase[$contrato->estado_contrato] ?? 'text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100' }}">
                                        {{ ucfirst($contrato->estado_contrato) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <button data-modal-target="modificar-modal" data-modal-toggle="modificar-modal"
                                            data-id="{{ $contrato->id }}"
                                            data-cliente="{{ $contrato->cliente->nombres }} {{ $contrato->cliente->apellidos }}"
                                            data-identificacion="{{ $contrato->cliente->identificacion }}"
                                            data-cliente-id="{{ $contrato->cliente->id }}"
                                            data-observaciones="{{ $contrato->observaciones }}"
                                            data-estado="{{ $contrato->estado_contrato }}"
                                            data-fecha="{{ $contrato->fecha_contrato->format('Y-m-d') }}"
                                            data-servicios="{{ implode(',', $contrato->servicios->pluck('nombre')->toArray()) }}"
                                            data-detalles='<?php echo json_encode($contrato->contratoServicios->map(function($cs) {
                                                $fecha = $cs->fecha_servicio;
                                                $fechaObj = $fecha ? \Carbon\Carbon::parse($fecha) : null;
                                                return [
                                                    'nombre' => $cs->servicio->nombre,
                                                    'plan' => $cs->plan ? $cs->plan->nombre : 'N/A',
                                                    'ip_servicio' => $cs->ip_servicio,
                                                    'fecha' => $fechaObj ? $fechaObj->format('d-m-Y') : null,
                                                    'mes' => $fechaObj ? $fechaObj->format('F') : null,
                                                    'estado' => $cs->estado_servicio_cliente,
                                                    'precio' => $cs->plan ? $cs->plan->precio : 0
                                                ];
                                            })); ?>'
                                            class="px-2 py-2 text-yellow-600 open-modal-edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button data-modal-target="ver-contrato" data-modal-toggle="ver-contrato"
                                            data-id="{{ $contrato->id }}"
                                            data-cliente="{{ $contrato->cliente->nombres }} {{ $contrato->cliente->apellidos }}"
                                            data-identificacion="{{ $contrato->cliente->identificacion }}"
                                            data-observaciones="{{ $contrato->observaciones }}"
                                            data-servicios="{{ implode(',', $contrato->servicios->pluck('nombre')->toArray()) }}"
                                            data-detalles='@json($contrato->detalles_servicios)'
                                            class="px-2 py-2 text-blue-600 open-modal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('contratos.pdf', $contrato->id) }}" 
                                           class="px-2 py-2 text-green-600"
                                           target="_blank">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                            onclick="setContratoId({{ $contrato->id }})"
                                            class="px-2 py-2 text-red-600">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Paginación -->
            <div>
                {{ $contratos->links() }}
            </div>
        </div>

    </div>
</main>

<!-- Modal de Confirmación -->
<div id="popup-modal" tabindex="-1" data-modal-target="popup-modal"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Cerrar modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Está seguro de eliminar este contrato?</h3>
                <button data-modal-hide="popup-modal" type="button" onclick="confirmarEliminacionContrato()"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Sí, eliminar
                </button>
                <button data-modal-hide="popup-modal" type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                    cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    let contratoIdAEliminar = null;

    function setContratoId(id) {
        contratoIdAEliminar = id;
    }

    function confirmarEliminacionContrato() {
        if (contratoIdAEliminar === null) return;

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/contratos/${contratoIdAEliminar}`;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }

    if (typeof window.pendingToast === 'undefined') {
        window.pendingToast = null;
    }

    function showToast(ip) {
        // Guardar la IP para mostrar el toast cuando regrese
        window.pendingToast = ip;

        // Abrir la IP en una nueva ventana
        window.open(`http://${ip}`, '_blank');

        // Agregar evento focus a la ventana
        window.addEventListener('focus', function showToastOnFocus() {
            if (window.pendingToast) {
                const currentIp = window.pendingToast;

                fetch(`http://${currentIp}`, {
                        method: 'HEAD',
                        mode: 'no-cors'
                    })
                    .then(() => {
                        // Si la IP responde, mostrar toast de éxito
                        const toast = document.createElement('div');
                        toast.className =
                            'fixed bottom-4 right-4 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800 transform translate-y-full opacity-0 transition-all duration-300 z-50';
                        toast.innerHTML = `
                        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="sr-only">Check icon</span>
                        </div>
                        <div class="ms-3 text-sm font-normal">Conexión exitosa con ${currentIp}</div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" onclick="this.parentElement.remove()">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    `;
                        document.body.appendChild(toast);

                        // Animar entrada
                        setTimeout(() => {
                            toast.classList.remove('translate-y-full', 'opacity-0');
                        }, 100);

                        // Animar salida y eliminar
                        setTimeout(() => {
                            toast.classList.add('translate-y-full', 'opacity-0');
                            setTimeout(() => {
                                document.body.removeChild(toast);
                            }, 300);
                        }, 5000);
                    })
                    .catch(() => {
                        // Si la IP no responde, mostrar toast de error
                        const toast = document.createElement('div');
                        toast.className =
                            'fixed bottom-4 right-4 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800 transform translate-y-full opacity-0 transition-all duration-300 z-50';
                        toast.innerHTML = `
                        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                            </svg>
                            <span class="sr-only">Error icon</span>
                        </div>
                        <div class="ms-3 text-sm font-normal">No se pudo establecer conexión con ${currentIp}</div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" onclick="this.parentElement.remove()">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    `;
                        document.body.appendChild(toast);

                        // Animar entrada
                        setTimeout(() => {
                            toast.classList.remove('translate-y-full', 'opacity-0');
                        }, 100);

                        // Animar salida y eliminar
                        setTimeout(() => {
                            toast.classList.add('translate-y-full', 'opacity-0');
                            setTimeout(() => {
                                document.body.removeChild(toast);
                            }, 300);
                        }, 5000);
                    });

                // Limpiar el toast
                setTimeout(() => {
                    window.pendingToast = null;
                    window.removeEventListener('focus', showToastOnFocus);
                }, 5000);
            }
        });
    }
</script>

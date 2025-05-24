<main class="h-full pb-16 overflow-y-auto">
    <div>

        <div class="flex justify-between items-center mb-4">
            <!-- Título -->
            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                Lista de Clientes
            </h4>

            <!-- Botón -->
            <a href="{{ route('clients.create') }}"
                class="flex items-center px-8 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <i class="fas fa-user-plus mr-2"></i>
                Registrar
            </a>

        </div>

        <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4 mb-4">
            <!-- Item Buscador Start -->
            <form action="{{ route('clients.index') }}" method="GET" class="w-full md:w-2/3">
                <label for="search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                        @if (request('search'))
                            <a href="{{ route('clients.index') }}"
                                class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 cursor-pointer">
                                <i class="fas fa-times"></i>
                            </a>
                        @else
                            <div class="pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <input type="search" id="search" name="search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar por nombre, apellido o identificación..." value="{{ request('search') }}"
                        required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                </div>
            </form>
            <!-- Item Buscador End -->

            <!-- Campo de Estado -->
            <div class="w-full md:w-1/3">
                <div class="relative">
                    <form action="{{ route('clients.index') }}" method="GET" class="w-full">
                        @if (request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if (request('pueblo_id'))
                            <input type="hidden" name="pueblo_id" value="{{ request('pueblo_id') }}">
                        @endif
                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-white dark:bg-form-input">
                            <select name="estado"
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3.5 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                                :class="isOptionSelected && 'text-black dark:text-white'"
                                @change="isOptionSelected = true; $el.form.submit()">
                                <option value="">Todos los clientes</option>
                                <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo
                                </option>
                                <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>
                                    Inactivo</option>
                                <option value="suspendido" {{ request('estado') == 'suspendido' ? 'selected' : '' }}>
                                    Suspendido</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Campo de Pueblo -->
            <div class="w-full md:w-1/3">
                <div class="relative">
                    <form action="{{ route('clients.index') }}" method="GET" class="w-full">
                        @if (request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if (request('estado'))
                            <input type="hidden" name="estado" value="{{ request('estado') }}">
                        @endif
                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-white dark:bg-form-input">
                            <select name="pueblo_id"
                                class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3.5 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
                                :class="isOptionSelected && 'text-black dark:text-white'"
                                @change="isOptionSelected = true; $el.form.submit()">
                                <option value="">Todas las zonas</option>
                                @foreach ($regiones as $region)
                                    @foreach ($region->provincias as $provincia)
                                        @foreach ($provincia->distritos as $distrito)
                                            @foreach ($distrito->pueblos as $pueblo)
                                                <option value="{{ $pueblo->id }}"
                                                    {{ request('pueblo_id') == $pueblo->id ? 'selected' : '' }}>
                                                    {{ $pueblo->nombre }} ({{ $distrito->nombre }})
                                                </option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Clientes</th>
                            <th class="px-4 py-3">Instalación</th>
                            <th class="px-4 py-3">Telefono</th>
                            <th class="px-4 py-3">Dirección</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3 text-center">Info</th>
                            <th class="px-4 py-3">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($clientes as $cliente)
                            @php
                                $iniciales = substr($cliente->nombres, 0, 1) . substr($cliente->apellidos, 0, 1);
                                $avatarUrl =
                                    'https://ui-avatars.com/api/?name=' .
                                    urlencode($iniciales) .
                                    '&size=64&background=374151&color=fff&rounded=true';
                                $contrato = $cliente->contratos->first();
                            @endphp
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <!-- Avatar (oculto en móviles) -->
                                        <div
                                            class="hidden md:flex items-center px-2 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <img class="w-10 h-10 rounded-full object-cover" src="{{ $avatarUrl }}"
                                                alt="{{ $cliente->nombres }} {{ $cliente->apellidos }}"
                                                loading="lazy" />
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{ $cliente->nombres }} {{ $cliente->apellidos }}
                                            </p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $cliente->identificacion }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-center">
                                    {{ $cliente->created_at ? $cliente->created_at->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    <a href="tel:{{ $cliente->telefono }}"
                                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        {{ $cliente->telefono }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $cliente->direccion }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @php
                                        $estadoClase = [
                                            'activo' =>
                                                'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100',
                                            'inactivo' =>
                                                'text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100',
                                            'suspendido' => 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100',
                                        ];
                                    @endphp

                                    <span
                                        class="px-2 py-1 font-semibold leading-tight rounded-full {{ $estadoClase[$cliente->estado_cliente] ?? 'text-gray-700 bg-gray-100' }} flex items-center gap-1 whitespace-nowrap w-fit">
                                        <i
                                            class="fas {{ $cliente->estado_cliente === 'activo' ? 'fa-check-circle' : ($cliente->estado_cliente === 'inactivo' ? 'fa-minus-circle' : 'fa-times-circle') }} text-xs"></i>
                                        <span class="text-xs">{{ ucfirst($cliente->estado_cliente) }}</span>
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-sm text-center">
                                    <button type="button" data-modal-target="meses-modal"
                                        onclick="verDetallesCliente({{ $cliente->id }})"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <!-- Botón Editar -->
                                        <a href="{{ route('clients.edit', $cliente->id) }}"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <i class="fas fa-edit w-5 h-5"></i>
                                        </a>

                                        <!-- Botón Eliminar -->
                                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                            onclick="setClienteId({{ $cliente->id }})"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Delete">
                                            <i class="fas fa-trash-alt w-5 h-5"></i>
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
                {{ $clientes->links() }}
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
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Está seguro de eliminar este
                    cliente?
                    <p class="text-base text-gray-500 dark:text-gray-400">
                        Se perderá toda su información.
                    </p>
                </h3>
                <button data-modal-hide="popup-modal" type="button" onclick="confirmarEliminacionCliente()"
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
    let clienteIdAEliminar = null;

    function setClienteId(id) {
        clienteIdAEliminar = id;
    }

    function confirmarEliminacionCliente() {
        if (clienteIdAEliminar === null) return;

        fetch(`/clients/${clienteIdAEliminar}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                } else {
                    return response.json().then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: data.errorDetails,
                                icon: "error",
                                customClass: {
                                    confirmButton: "bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400"
                                },
                                buttonsStyling: false
                            });
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: "Error",
                    text: "Hubo un problema al eliminar el cliente.",
                    icon: "error",
                    customClass: {
                        confirmButton: "bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400"
                    },
                    buttonsStyling: false
                });
            });
    }

    function verDetallesCliente(clienteId) {
        if (!clienteId) return;

        // Primero abrimos el modal
        const modal = document.getElementById('meses-modal');
        if (modal) {
            const modalInstance = new Modal(modal, {
                backdrop: 'static',
                keyboard: false
            });
            modalInstance.show();
        }

        // Cargar los detalles del cliente
        fetch(`/clients/${clienteId}/details`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cliente = data.cliente;

                    // Actualizar la información del cliente en el modal
                    // Actualizar las iniciales en el avatar
                    document.querySelector('#meses-modal .text-2xl').textContent =
                        `${cliente.nombres.charAt(0)}${cliente.apellidos.charAt(0)}`;

                    // Actualizar el nombre completo
                    document.querySelector('#meses-modal [data-field="nombre"]').textContent =
                        `${cliente.nombres} ${cliente.apellidos}`;

                    // Actualizar información de contacto
                    document.querySelector('#meses-modal [data-field="identificacion"]').textContent = cliente
                        .identificacion;
                    document.querySelector('#meses-modal [data-field="telefono"]').textContent = cliente.telefono;
                    document.querySelector('#meses-modal [data-field="gps"]').textContent = cliente.gps ||
                        'No especificado';

                    // Actualizar información de ubicación
                    document.querySelector('#meses-modal [data-field="region"]').textContent = cliente.region ||
                        'No especificado';
                    document.querySelector('#meses-modal [data-field="provincia"]').textContent = cliente
                        .provincia || 'No especificado';
                    document.querySelector('#meses-modal [data-field="distrito"]').textContent = cliente.distrito ||
                        'No especificado';
                    document.querySelector('#meses-modal [data-field="pueblo"]').textContent = cliente.pueblo ||
                        'No especificado';
                    document.querySelector('#meses-modal [data-field="direccion"]').textContent = cliente.direccion;

                    // === ESTADO DEL CLIENTE (perfil/avatar) ===
                    const estadoCliente = cliente.estado_cliente;
                    const estadoIndicator = document.querySelector('#meses-modal [data-field="estado-indicator"]');
                    const estadoPerfil = document.querySelector('#meses-modal [data-field="fecha-inicio"]');

                    let indicatorBg = '';
                    let indicatorIcon = '';
                    let estadoPerfilTexto = '';
                    switch (estadoCliente) {
                        case 'activo':
                            indicatorBg = 'bg-green-500';
                            indicatorIcon = 'fa-check-circle';
                            estadoPerfilTexto = 'Cliente activo';
                            break;
                        case 'suspendido':
                            indicatorBg = 'bg-yellow-500';
                            indicatorIcon = 'fa-exclamation-circle';
                            estadoPerfilTexto = 'Cliente suspendido';
                            break;
                        case 'inactivo':
                            indicatorBg = 'bg-gray-400';
                            indicatorIcon = 'fa-times-circle';
                            estadoPerfilTexto = 'Cliente inactivo';
                            break;
                        default:
                            indicatorBg = 'bg-gray-400';
                            indicatorIcon = 'fa-question-circle';
                            estadoPerfilTexto = 'Estado desconocido';
                    }
                    if (estadoIndicator) {
                        estadoIndicator.className =
                            `absolute bottom-0 right-0 w-5 h-5 ${indicatorBg} rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center`;
                        estadoIndicator.querySelector('i').className = `fas ${indicatorIcon} text-white text-xs`;
                    }
                    if (estadoPerfil) {

                    }

                    // === ESTADO DEL SERVICIO/PLAN (sección plan) ===
                    const servicioMostrar = cliente.servicio_mostrar;
                    const planMostrar = cliente.plan_mostrar;
                    const precioMostrar = cliente.precio_mostrar;
                    const estadoMostrar = cliente.estado_mostrar;

                    document.querySelector('#meses-modal [data-field="servicio"]').textContent =
                        servicioMostrar ? (planMostrar ? `${servicioMostrar} ${planMostrar}` : servicioMostrar) :
                        'Sin servicio';

                    document.querySelector('#meses-modal [data-field="precio"]').textContent =
                        precioMostrar ? `S/. ${Number(precioMostrar).toFixed(2)}` : 'S/. 0.00';

                    // Estado visual (badge, color, ícono)
                    const estadoElement = document.querySelector('#meses-modal [data-field="estado"]');
                    const estadoIconPlan = document.querySelector('#meses-modal [data-field="estado-icon"]');
                    const estadoIconContainer = estadoIconPlan.parentElement;
                    const estadoIndicatorPlan = document.querySelector(
                        '#meses-modal [data-field="estado-indicator-plan"]');

                    let estadoTexto = '';
                    let estadoColor = '';
                    let icono = '';
                    let iconoColor = '';
                    let bgIcono = '';

                    switch (estadoMostrar) {
                        case 'activo':
                            estadoTexto = 'Activo';
                            estadoColor = 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100';
                            icono = 'fa-check-circle';
                            iconoColor = 'text-green-500 dark:text-green-300';
                            bgIcono = 'bg-green-100 dark:bg-green-900';
                            break;
                        case 'suspendido':
                            estadoTexto = 'Suspendido';
                            estadoColor = 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100';
                            icono = 'fa-times-circle';
                            iconoColor = 'text-red-500 dark:text-red-300';
                            bgIcono = 'bg-red-100 dark:bg-red-900';
                            break;
                        case 'cancelado':
                            estadoTexto = 'Cancelado';
                            estadoColor = 'text-gray-600 dark:text-gray-400';
                            icono = 'fa-times-circle';
                            iconoColor = 'text-gray-500 dark:text-gray-300';
                            bgIcono = 'bg-gray-100 dark:bg-gray-900';
                            break;
                        default:
                            estadoTexto = 'Sin servicios';
                            estadoColor = 'text-gray-400';
                            icono = 'fa-question-circle';
                            iconoColor = 'text-gray-400';
                            bgIcono = 'bg-gray-100 dark:bg-gray-700';
                    }

                    if (estadoElement) {
                        estadoElement.textContent = estadoTexto;
                        estadoElement.className = `text-sm font-semibold ${estadoColor}`;
                    }
                    if (estadoIconPlan && estadoIconContainer) {
                        estadoIconPlan.className = `fas ${icono} ${iconoColor}`;
                        estadoIconContainer.className =
                            `flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center ${bgIcono}`;
                    }
                    if (estadoIndicatorPlan) {
                        // Indicador pequeño en el avatar
                        let indicatorBgPlan = '';
                        let indicatorIconPlan = '';
                        switch (estadoMostrar) {
                            case 'activo':
                                indicatorBgPlan = 'bg-green-500';
                                indicatorIconPlan = 'fa-check-circle';
                                break;
                            case 'suspendido':
                                indicatorBgPlan = 'bg-red-500';
                                indicatorIconPlan = 'fa-times-circle';
                                break;
                            case 'cancelado':
                                indicatorBgPlan = 'bg-gray-500';
                                indicatorIconPlan = 'fa-times-circle';
                                break;
                            default:
                                indicatorBgPlan = 'bg-gray-400';
                                indicatorIconPlan = 'fa-question-circle';
                        }
                        estadoIndicatorPlan.className =
                            `absolute bottom-0 right-0 w-5 h-5 ${indicatorBgPlan} rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center`;
                        estadoIndicatorPlan.querySelector('i').className =
                            `fas ${indicatorIconPlan} text-white text-xs`;
                    }

                    // Actualizar fecha de inicio y fecha de instalación
                    const fechaInicioElement = document.querySelector('#meses-modal [data-field="fecha-inicio"]');
                    const fechaInstalacionElement = document.querySelector(
                        '#meses-modal [data-field="fecha-instalacion"]');

                    if (fechaInicioElement) {
                        let fechaFormateada = 'No especificada';
                        if (cliente.created_at) {

                            let fechaStr = cliente.created_at.split('T')[0];
                            const [anio, mes, dia] = fechaStr.split('-');
                            // Mes en español
                            const meses = [
                                'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
                                'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
                            ];
                            const mesNombre = meses[parseInt(mes, 10) - 1];
                            fechaFormateada =
                                `Cliente registrado el ${parseInt(dia, 10)} de ${mesNombre} de ${anio}`;
                        }
                        fechaInicioElement.innerHTML = `
                            <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                            ${fechaFormateada}
                        `;
                    }

                    if (fechaInstalacionElement) {
                        let fechaInstalacionFormateada = 'No especificada';
                        if (cliente.created_at) {
                            let fechaStr = cliente.created_at.split('T')[0];
                            const [anio, mes, dia] = fechaStr.split('-');
                            fechaInstalacionFormateada = `${dia.padStart(2, '0')}-${mes.padStart(2, '0')}-${anio}`;
                        }
                        fechaInstalacionElement.textContent = fechaInstalacionFormateada;
                    }

                    // Cargar los contratos
                    return fetch(`/clients/${clienteId}/contracts`);
                }
                throw new Error(data.errorDetails || 'Error al cargar los detalles del cliente');
            })
            .then(response => response.json())
            .then(contractsData => {
                if (contractsData.success) {
                    document.getElementById('modal-content').innerHTML = contractsData.html;
                } else {
                    throw new Error(contractsData.errorDetails || 'Error al cargar los contratos');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('modal-content').innerHTML = `
                    <div class="text-center text-red-500 dark:text-red-400 py-4">
                        Error al cargar la información: ${error.message}
                    </div>
                `;
            });
    }
</script>

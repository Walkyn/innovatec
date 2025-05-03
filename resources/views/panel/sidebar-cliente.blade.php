<!--sidenav -->
<div class="fixed left-0 top-0 w-64 h-full bg-gray-800 p-4 z-50 sidebar-menu transition-transform">
    <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">

        <h2 class="font-bold text-2xl text-white">NEXUS <span class="bg-red-500 text-white px-2 rounded-md">PERU</span>
        </h2>
    </a>
    <ul class="mt-4">
        <span class="text-gray-400 font-bold">DASHBOARD</span>
        <li class="mb-1 group {{ request()->routeIs('panel.dashboard') ? 'active' : '' }}">
            <a href="{{ route('panel.dashboard') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-gray-100 transition-colors duration-200">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">Inicio</span>
            </a>
        </li>
        <li class="mb-1 group {{ request()->routeIs('panel.mi-perfil') ? 'active' : '' }}">
            <a href="{{ route('panel.mi-perfil') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-gray-100 transition-colors duration-200">
                <i class='bx bx-user mr-3 text-lg'></i>
                <span class="text-sm">Mi Perfil</span>
            </a>
        </li>
        <li class="mb-1 group {{ request()->routeIs('panel.historial-servicios') ? 'active' : '' }}">
            <a href="{{ route('panel.historial-servicios') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-gray-100 group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class='bx bx-server mr-3 text-lg'></i>
                <span class="text-sm">Historial de servicios</span>
            </a>
        </li>
        <li class="mb-1 group {{ request()->routeIs('panel.meses-pendientes') ? 'active' : '' }}">
            <a href="{{ route('panel.meses-pendientes') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-gray-100 group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class='bx bx-calendar-exclamation mr-3 text-lg'></i>
                <span class="text-sm">Meses pendientes</span>
            </a>
        </li>
        <span class="text-gray-400 font-bold">PAGOS</span>
        <li class="mb-1 group {{ request()->routeIs('panel.realizar-pago') || request()->routeIs('panel.historial-pagos') ? 'active' : '' }}">
            <a href=""
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-gray-100 group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <i class='bx bxl-blogger mr-3 text-lg'></i>
                <span class="text-sm">Mis pagos</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                <li class="mb-4">
                    <a href="{{ route('panel.realizar-pago') }}"
                        class="text-gray-200 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Realizar
                        pago</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('panel.historial-pagos') }}"
                        class="text-gray-200 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Historial
                        de pagos</a>
                </li>
            </ul>
        </li>
        <li class="mb-1 group {{ request()->routeIs('panel.comprobantes') ? 'active' : '' }}">
            <a href="{{ route('panel.comprobantes') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-gray-100 group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class='bx bx-archive mr-3 text-lg'></i>
                <span class="text-sm">Comprobantes</span>
            </a>
        </li>
        <span class="text-gray-400 font-bold">PERSONAL</span>
        <li class="mb-1 group {{ request()->routeIs('panel.cambiar-password') ? 'active' : '' }}">
            <a href="{{ route('panel.cambiar-password') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-gray-100 group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class='bx bx-lock mr-3 text-lg'></i>
                <span class="text-sm">Cambiar contraseña</span>
            </a>
        </li>
        <li class="mb-1 group {{ request()->routeIs('panel.mensajes') ? 'active' : '' }}">
            <a href="{{ route('panel.mensajes') }}" id="sidebar-mensajes-link"
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-600 group-[.active]:text-gray-100 group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class='bx bx-envelope mr-3 text-lg'></i>
                <span class="text-sm">Mensajes</span>
                <span id="nuevos-mensajes-badge"
                    class="md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-green-600 bg-green-200 rounded-full hidden">
                    0 Nuevos
                </span>
            </a>
        </li>
        <li class="mb-1 group">
            <button type="button" 
                onclick="openLogoutModal()"
                class="w-full flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md">
                <i class='bx bx-log-out mr-3 text-lg'></i>
                <span class="text-sm">Salir</span>
            </button>
        </li>
    </ul>
</div>

<!-- Modal de confirmación de cierre de sesión -->
<div id="logoutModal" 
    class="fixed inset-0 bg-black/50 z-50 hidden backdrop-blur-sm"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    
    <div class="min-h-screen px-4 flex items-center justify-center">
        <div class="bg-white rounded-2xl p-6 w-full max-w-sm transform transition-all duration-300 scale-100 opacity-100"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90">
            
            <!-- Icono y título -->
            <div class="text-center mb-6">
                <div class="inline-flex p-3 bg-red-50 rounded-full mb-4">
                    <i class='bx bx-log-out text-3xl text-red-500'></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900">¿Cerrar sesión?</h3>
                <p class="mt-2 text-sm text-gray-500">Se cerrará tu sesión actual</p>
            </div>

            <!-- Botones -->
            <div class="flex gap-3">
                <button type="button"
                    onclick="closeLogoutModal()" 
                    class="flex-1 px-4 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-800 text-sm font-medium rounded-lg transition-colors duration-200">
                    Cancelar
                </button>
                <form method="POST" action="{{ route('panel.cerrar-sesion') }}" class="flex-1" id="logoutForm">
                    @csrf
                    <button type="submit" 
                        id="logoutButton"
                        class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                        <span class="button-text">Cerrar Sesión</span>
                        <div class="spinner hidden">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Reemplazar el script actual por este -->
<script>
const modal = document.getElementById('logoutModal');
const logoutForm = document.getElementById('logoutForm');
const logoutButton = document.getElementById('logoutButton');

function openLogoutModal() {
    modal.classList.remove('hidden');
    modal.querySelector('.bg-white').classList.add('scale-100', 'opacity-100');
    document.body.style.overflow = 'hidden';
}

function closeLogoutModal() {
    const modalContent = modal.querySelector('.bg-white');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modalContent.classList.remove('scale-95', 'opacity-0');
        document.body.style.overflow = 'auto';
        
        // Resetear el estado del botón si se cierra el modal
        resetLogoutButton();
    }, 200);
}

function resetLogoutButton() {
    logoutButton.disabled = false;
    logoutButton.querySelector('.button-text').classList.remove('hidden');
    logoutButton.querySelector('.spinner').classList.add('hidden');
}

// Manejar el envío del formulario
logoutForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Mostrar spinner y deshabilitar botón
    logoutButton.disabled = true;
    logoutButton.querySelector('.button-text').classList.add('hidden');
    logoutButton.querySelector('.spinner').classList.remove('hidden');
    
    // Enviar el formulario después de un pequeño delay para mostrar la animación
    setTimeout(() => {
        this.submit();
    }, 100);
});

// Cerrar modal al hacer clic fuera
modal.addEventListener('click', function(e) {
    if (e.target === this) {
        closeLogoutModal();
    }
});

// Cerrar con ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeLogoutModal();
    }
});
</script>

<script>
// Script completamente nuevo para gestionar el contador de notificaciones
document.addEventListener('DOMContentLoaded', function() {
    const badgeElement = document.getElementById('nuevos-mensajes-badge');
    const mensajesLink = document.getElementById('sidebar-mensajes-link');
    
    // Función para actualizar el estado de las notificaciones
    function actualizarNotificaciones() {
        // Obtener los IDs de los pagos del cliente actual
        @php
        $cliente_id = Auth::id();
        $pagos = DB::table('pagos')
            ->where('cliente_id', $cliente_id)
            ->orderBy('updated_at', 'desc')
            ->get();
            
        $pagoIds = $pagos->pluck('id')->toArray();
        @endphp
        
        // Array de IDs de pagos como string para comparar
        const pagoIdsString = "{{ implode(',', $pagoIds) }}";
        
        // Si no hay pagos, ocultar el badge y salir
        if (pagoIdsString === "") {
            badgeElement.classList.add('hidden');
            return;
        }
        
        // Estamos en la página de mensajes?
        const enPaginaMensajes = window.location.pathname.includes('{{ route("panel.mensajes", [], false) }}');
        
        // Si estamos en la página de mensajes, marcar todas las notificaciones como vistas
        if (enPaginaMensajes) {
            localStorage.setItem('pagos_vistos', pagoIdsString);
            badgeElement.classList.add('hidden');
            return;
        }
        
        // Obtener los pagos que ya hemos visto
        const pagosVistos = localStorage.getItem('pagos_vistos') || "";
        
        // Si los pagos actuales son iguales a los que ya vimos, no hay notificaciones nuevas
        if (pagosVistos === pagoIdsString) {
            badgeElement.classList.add('hidden');
            return;
        }
        
        // Calcular cuántos pagos no hemos visto
        const pagosVistosArray = pagosVistos ? pagosVistos.split(',') : [];
        const pagosActualesArray = pagoIdsString ? pagoIdsString.split(',') : [];
        
        let pagosSinVer = 0;
        
        // Si no hay pagos vistos anteriormente, todos son nuevos
        if (pagosVistosArray.length === 0) {
            pagosSinVer = pagosActualesArray.length;
        } else {
            // Calcular pagos sin ver comparando los arrays
            pagosSinVer = pagosActualesArray.filter(id => !pagosVistosArray.includes(id)).length;
        }
        
        // Actualizar el badge según corresponda
        if (pagosSinVer > 0) {
            badgeElement.textContent = pagosSinVer + (pagosSinVer === 1 ? ' Nuevo' : ' Nuevos');
            badgeElement.classList.remove('hidden');
        } else {
            badgeElement.classList.add('hidden');
        }
    }
    
    // Inicializar el contador al cargar la página
    actualizarNotificaciones();
    
    // Escuchar eventos de cambio en localStorage para actualizaciones en otras pestañas
    window.addEventListener('storage', function(e) {
        if (e.key === 'pagos_vistos') {
            actualizarNotificaciones();
        }
    });
    
    // Agregar evento al enlace de mensajes para marcar notificaciones como vistas
    mensajesLink.addEventListener('click', function() {
        @php
        $cliente_id = Auth::id();
        $pagos = DB::table('pagos')
            ->where('cliente_id', $cliente_id)
            ->orderBy('updated_at', 'desc')
            ->get();
            
        $pagoIds = $pagos->pluck('id')->toArray();
        @endphp
        
        localStorage.setItem('pagos_vistos', "{{ implode(',', $pagoIds) }}");
        badgeElement.classList.add('hidden');
    });
});
</script>
<!-- end sidenav -->

<!--sidenav -->
<div class="fixed left-0 top-0 w-64 h-full bg-gray-800 p-4 z-50 sidebar-menu transition-transform">
    <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">

        <h2 class="font-bold text-2xl text-white">NEXUS <span class="bg-red-500 text-white px-2 rounded-md">PERU</span>
        </h2>
    </a>
    <ul class="mt-4">
        <span class="text-gray-400 font-bold">DASHBOARD</span>
        <li class="mb-1 group">
            <a href="{{ route('panel.dashboard') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">Inicio</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="{{ route('panel.mi-perfil') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class='bx bx-user mr-3 text-lg'></i>
                <span class="text-sm">Mi Perfil</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="#"
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <i class='bx bx-server mr-3 text-base'></i>
                <span class="text-sm">Servicios</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
            <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                <li class="mb-4">
                    <a href="#"
                        class="text-gray-200 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Internet
                        Basico</a>
                </li>
                <li class="mb-4">
                    <a href="#"
                        class="text-gray-200 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Netflix
                        Basico</a>
                </li>
            </ul>
        </li>
        <li class="mb-1 group">
            <a href="{{ route('panel.meses-pendientes') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class='bx bx-calendar-exclamation mr-3 text-lg'></i>
                <span class="text-sm">Meses pendientes</span>
            </a>
        </li>
        <span class="text-gray-400 font-bold">PAGOS</span>
        <li class="mb-1 group">
            <a href=""
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
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
        <li class="mb-1 group">
            <a href="{{ route('panel.comprobantes') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class='bx bx-archive mr-3 text-lg'></i>
                <span class="text-sm">Comprobantes</span>
            </a>
        </li>
        <span class="text-gray-400 font-bold">PERSONAL</span>
        <li class="mb-1 group">
            <a href="{{ route('panel.mensajes') }}"
                class="flex font-semibold items-center py-2 px-4 text-gray-200 hover:bg-gray-600 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-600 group-[.selected]:text-gray-100">
                <i class='bx bx-envelope mr-3 text-lg'></i>
                <span class="text-sm">Mensajes</span>
                <span
                    class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-green-600 bg-green-200 rounded-full">2
                    Nuevos</span>
            </a>
        </li>
    </ul>
</div>
<!-- end sidenav -->

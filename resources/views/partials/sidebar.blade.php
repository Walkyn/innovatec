<aside
    :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-0 z-40 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark 2xl:static 2xl:translate-x-0"
    @click.outside="sidebarToggle = false"
>
    <!-- SIDEBAR HEADER -->
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
        <a href="index.html">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-10" />
            <a class="mr-6 text-lg font-semibold text-gray-300" href="#"> B-MANAGER </a>
        </a>

        <button class="block lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
            <svg class="fill-current" width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                    fill=""
                />
            </svg>
        </button>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <!-- Sidebar Menu -->
        <nav class="mt-5 px-4 py-4 lg:mt-9 lg:px-6" x-data="{ selected: localStorage.getItem('selected') || '', submenuSelected: localStorage.getItem('submenuSelected') || '', subSelected: localStorage.getItem('subSelected') || '' }">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Menu</h3>

                <ul class="mb-6 flex flex-col gap-1.5">
                    @php
                        $user = Auth::user();
                        if ($user) {
                            $modulos = $user->modulos->pluck('nombre_modulo')->toArray();
                        } else {
                            $modulos = [];
                        }
                    @endphp

                    <!-- Menú Inicio -->
                    @if ($user && ($user->id_rol === 1 || in_array('home', $modulos)))
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="{{ route('home.index') }}"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'home' }"
                                @click="selected = 'home'; localStorage.setItem('selected', selected);"
                            >
                                <i class="fas fa-home"></i>
                                Inicio
                            </a>
                        </li>
                    @endif

                    <!-- Menú Clientes -->
                    @if ($user && ($user->id_rol === 1 || in_array('clients', $modulos)))
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="{{ route('clients.index') }}"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'clients' }"
                                @click="selected = 'clients'; localStorage.setItem('selected', selected);"
                            >
                                <i class="fas fa-users-cog"></i>
                                Clientes
                            </a>
                        </li>
                    @endif

                    <!-- Menú Administrar -->
                    @if ($user && ($user->id_rol === 1 || in_array('manage', $modulos)))
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="#"
                                :class="{ 'bg-graydark dark:bg-meta-4': submenuSelected === 'manage' }"
                                @click="submenuSelected = (submenuSelected === 'manage' ? '' : 'manage'); localStorage.setItem('submenuSelected', submenuSelected);"
                            >
                                <i class="fas fa-folder"></i>
                                Administrar
                                <i
                                    class="fas fa-chevron-down text-xs absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                    :class="{ 'rotate-180': submenuSelected === 'manage' }"
                                    aria-hidden="true"
                                ></i>
                            </a>
                            <div class="translate transform overflow-hidden" :class="submenuSelected === 'manage' ? 'block' : 'hidden'">
                                <ul class="mb-3 mt-4 flex flex-col gap-2 pl-6">
                                    <li>
                                        <a
                                            class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('services.index') }}"
                                            :class="{ 'text-white': subSelected === 'services' }"
                                            @click="subSelected = 'services'; localStorage.setItem('subSelected', subSelected);"
                                        >
                                            <i class="fas fa-tools"></i> Servicios
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('contracts.index') }}"
                                            :class="{ 'text-white': subSelected === 'contracts' }"
                                            @click="subSelected = 'contracts'; localStorage.setItem('subSelected', subSelected);"
                                        >
                                            <i class="fas fa-file-contract"></i> Contratos
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('months.index') }}"
                                            :class="{ 'text-white': subSelected === 'months' }"
                                            @click="subSelected = 'months'; localStorage.setItem('subSelected', subSelected);"
                                        >
                                            <i class="fas fa-calendar-alt"></i> Gestión de Meses
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    <!-- Menú Cobranzas -->
                    @if ($user && ($user->id_rol === 1 || in_array('payments', $modulos)))
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="{{ route('payments.index') }}"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'payments' }"
                                @click="selected = 'payments'; localStorage.setItem('selected', selected);"
                            >
                                <i class="fas fa-credit-card"></i>
                                Cobranzas
                            </a>
                        </li>
                    @endif

                    <!-- Menú Calendario -->
                    @if ($user && ($user->id_rol === 1 || in_array('calendar', $modulos)))
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="{{ route('calendar.index') }}"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'calendar' }"
                                @click="selected = 'calendar'; localStorage.setItem('selected', selected);"
                            >
                                <i class="fas fa-calendar-alt"></i>
                                Calendario
                            </a>
                        </li>
                    @endif

                    <!-- Menú Perfil -->
                    @if ($user && ($user->id_rol === 1 || in_array('profile', $modulos)))
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="{{ route('profile.index') }}"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'profile' }"
                                @click="selected = 'profile'; localStorage.setItem('selected', selected);"
                            >
                                <i class="fas fa-user"></i>
                                Perfil
                            </a>
                        </li>
                    @endif

                    <!-- Menú Configuración -->
                    @if ($user && ($user->id_rol === 1 || in_array('settings', $modulos)))
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="{{ route('settings.index') }}"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'settings' }"
                                @click="selected = 'settings'; localStorage.setItem('selected', selected);"
                            >
                                <i :class="selected === 'settings' ? 'fas fa-cogs' : 'fas fa-wrench'"></i>
                                Configuración
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- Others Group -->
            <div>
                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Más</h3>

                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menú Gráficos -->
                    @if ($user && ($user->id_rol === 1 || in_array('charts', $modulos)))
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="{{ route('charts.index') }}"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'charts' }"
                                @click="selected = 'charts'; localStorage.setItem('selected', selected);"
                            >
                                <i class="fas fa-chart-pie"></i>
                                Gráficos
                            </a>
                        </li>
                    @endif

                    <!-- Menú Database -->
                    @if ($user && ($user->id_rol === 1 || in_array('database', $modulos)))
                        <li>
                            <a
                                class="group relative flex items-center gap-3.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="{{ route('database.index') }}"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'database' }"
                                @click="selected = 'database'; localStorage.setItem('selected', selected);"
                            >
                                <i class="fa fa-database"></i>
                                Database
                            </a>
                        </li>
                    @endif

                    <!-- Menú Usuarios -->
                    @if ($user && ($user->id_rol === 1 || in_array('users', $modulos)))
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                href="#"
                                :class="{ 'bg-graydark dark:bg-meta-4': submenuSelected === 'users' }"
                                @click="submenuSelected = (submenuSelected === 'users' ? '' : 'users'); localStorage.setItem('submenuSelected', submenuSelected);"
                            >
                                <i class="fa fa-user-shield"></i>
                                Autenticación
                                <i
                                    class="fa fa-chevron-down text-xs absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                    :class="{ 'rotate-180': submenuSelected === 'users' }"
                                    aria-hidden="true"
                                ></i>
                            </a>
                            <!-- Dropdown Menu Start -->
                            <div class="translate transform overflow-hidden" :class="submenuSelected === 'users' ? 'block' : 'hidden'">
                                <ul class="mb-3 mt-4 flex flex-col gap-2 pl-8">
                                    <li>
                                        <a
                                            class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('users.index') }}"
                                            :class="{ 'text-white': subSelected === 'users.index' }"
                                            @click="subSelected = 'users.index'; localStorage.setItem('subSelected', subSelected);"
                                        >
                                            Usuarios
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('users.create') }}"
                                            :class="{ 'text-white': subSelected === 'users.create' }"
                                            @click="subSelected = 'users.create'; localStorage.setItem('subSelected', subSelected);"
                                        >
                                            Registrar
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                            href="{{ route('password.reset') }}"
                                            :class="{ 'text-white': subSelected === 'password.reset' }"
                                            @click="subSelected = 'password.reset'; localStorage.setItem('subSelected', subSelected);"
                                        >
                                            Restablecer contraseña
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Dropdown Menu End -->
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>
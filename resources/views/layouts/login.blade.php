<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{
    page: 'ecommerce',
    loaded: true,
    darkMode: window.matchMedia('(prefers-color-scheme: dark)').matches,
    stickyMenu: false,
    sidebarToggle: false,
    scrollTop: false
}" x-init="window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => darkMode = event.matches)" :class="{ 'dark text-bodydark bg-boxdark-2': darkMode }">

    <!-- ===== Preloader Start ===== -->
    @include('partials/preloader')
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">

            <section>
                @yield('content')
            </section>
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
</body>

</html>

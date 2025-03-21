@extends('layouts.app')
@section('title', 'Business Manager - Inicio')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>

        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Clientes
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{ route('home.index') }}">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Clientes</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Alerts Start -->
            @include('partials.alerts')
            <!-- ====== Alerts End -->

            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">

                <!-- ====== Table Clientes Start -->
                @include('partials.table-clientes')
                <!-- ====== Table Clientes End -->

                <!-- ====== Table Meses End -->
                @include('partials.modal-meses')
                <!-- ====== Table Meses End -->

            </div>
            <!-- ====== Table Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

@endsection

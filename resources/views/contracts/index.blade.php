@extends('layouts.app')
@section('title', 'Nexus - Contratos')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Gestión de Contratos
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="index.html">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Contratos</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Alerts Start -->
            @include('partials.alerts')
            <!-- ====== Alerts End -->

            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">

                <!-- ====== Table Contratos Start -->
                @include('partials.table-contratos')
                <!-- ====== Table Contratos End -->

                <!-- ====== Modal Contrato End -->
                @include('partials.modal-contrato')
                <!-- ====== Modal Contrato End -->

                <!-- ====== Modal Edit Contrato End -->
                @include('partials.modal-edit-contrato')
                <!-- ====== Modal Edit Contrato End -->

                <!-- ====== Modal Ver Contrato End -->
                @include('partials.modal-ver-contrato')
                <!-- ====== Modal Ver Contrato End -->

            </div>
            <!-- ====== Table Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
@endsection

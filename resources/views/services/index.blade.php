@extends('layouts.app')
@section('title', 'Business Manager - Servicios')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Gestión de Servicios
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{ route('home.index') }}">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Servicios</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Alerts Start -->
            @include('partials.alerts')
            <!-- ====== Alerts End -->

            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">

                <!-- ====== Modal Category Start -->
                @include('partials.modal-category')
                <!-- ====== Modal Category End -->

                <!-- ====== Modal Category Edit Start -->
                @include('partials.modal-category-edit')
                <!-- ====== Modal Category Edit End -->

                <!-- ====== Modal Services Edit Start -->
                @include('partials.modal-services-edit')
                <!-- ====== Modal Services Edit End -->

                <!-- ====== Table Services Start -->
                @include('partials.table-services')
                <!-- ====== Table Services End -->

                <!-- ====== Modal Services End -->
                @include('partials.modal-services')
                <!-- ====== Modal Services End -->

                <!-- ====== Edit Modal Services End -->
                @include('partials.modal-edit-services')
                <!-- ====== Edit Modal Services End -->

                <!-- ====== Edit Modal Planes End -->
                @include('partials.modal-planes')
                <!-- ====== Edit Modal Planes End -->

            </div>
            <!-- ====== Table Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

@endsection

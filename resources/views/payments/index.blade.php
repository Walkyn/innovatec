@extends('layouts.app')
@section('title', 'Nexus - Pagos')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Gestión de pagos
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="index.html">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Pagos</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">

                <!-- ====== Table Payments Start -->
                @include('partials.table-payments')
                <!-- ====== Table Payments End -->

                <!-- ====== Modal Payments End -->
                @include('partials.modal-payments')
                <!-- ====== Modal Payments End -->

                <!-- ====== Modal Ver Payments End -->
                @include('partials.modal-ver-payments')
                <!-- ====== Modal Ver Payments End -->


            </div>
            <!-- ====== Table Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

@endsection

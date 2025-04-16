@extends('layouts.app')
@section('title', 'Business Manager - Database')


@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>

        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Base de datos
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{ route('home.index') }}">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Database</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Alerts Start -->
            @include('partials.alerts')
            <!-- ====== Alerts End -->

            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">

                <!-- ====== Table Database Start -->
                @include('partials.table-database')
                <!-- ====== Table Database End -->

            </div>
            <!-- ====== Table Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

    <!-- ===== Restore Start ===== -->
    @include('partials.modal-restore')
    <!-- ===== Restore End ===== -->

    <!-- ===== Restore Start ===== -->
    @include('partials.modal-restore-database')
    <!-- ===== Restore End ===== -->

    <!-- ===== Backup Start ===== -->
    @include('partials.modal-backup')
    <!-- ===== Backup End ===== -->

    <!-- ===== Backup Excel Start ===== -->
    @include('partials.modal-restore-excel')
    <!-- ===== Backup Excel End ===== -->
@endsection

@section('scripts')

@endsection

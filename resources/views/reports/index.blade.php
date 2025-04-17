@extends('layouts.app')
@section('title', 'Nexus - Reportes')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Reportes
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="index.html">Dashboard /</a>
                        </li>
                        <li class="font-medium text-primary">Reportes</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <div class="grid grid-cols-12 gap-4 md:gap-6 2xl:gap-7.5">
                <!-- ====== Chart Four Start -->
                <div class="col-span-12">
                    @include('partials.chart-04')
                </div>
                <!-- ====== Chart Four End -->

                <!-- ====== Chart Two Start -->
                @include('partials.chart-02')
                <!-- ====== Chart Two End -->

                <!-- ====== Chart Three Start -->
                @include('partials.chart-03')
                <!-- ====== Chart Three End -->

            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

@endsection

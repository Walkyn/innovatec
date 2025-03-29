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

            <!-- Success/Error message modal Index -->
            <div id="messageModal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-900/50 dark:bg-gray-900/75 transition-opacity" aria-hidden="true"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div
                            class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div id="modalIcon"
                                        class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/20 sm:mx-0 sm:size-10">
                                        <svg id="modalIconSvg" class="size-6 text-red-600 dark:text-red-500" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                            data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 id="modalTitle" class="text-base font-semibold text-gray-900 dark:text-white">
                                            Error
                                        </h3>
                                        <div class="mt-2">
                                            <p id="modalMessage" class="text-sm text-gray-500 dark:text-gray-400"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button id="modalOkButton" type="button"
                                    class="inline-flex w-full justify-center rounded-md bg-green-600 dark:bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 dark:hover:bg-green-600 sm:ml-3 sm:w-auto">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

                <!-- ====== Modal Plans Edit Start -->
                @include('partials.modal-plans-edit')
                <!-- ====== Modal Plans Edit End -->

                <!-- ====== Table Services Start -->
                @include('partials.table-services')
                <!-- ====== Table Services End -->

                <!-- ====== Modal Services End -->
                @include('partials.modal-services')
                <!-- ====== Modal Services End -->

                <!-- ====== Edit Modal Planes End -->
                @include('partials.modal-planes')
                <!-- ====== Edit Modal Planes End -->

            </div>
            <!-- ====== Table Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

@endsection

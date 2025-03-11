@extends('layouts.login')
@section('title', 'Create Symlink')

@section('content')
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10 flex items-center justify-center min-h-screen">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            </div>
            <!-- Breadcrumb End -->

            <section>
                @php
                    $symlinkPath = public_path('storage');

                    if (is_link($symlinkPath) && file_exists($symlinkPath)) {
                        header('Location: /');
                        exit;
                    } else {
                        $basePath = base_path();
                        $artisanPath = $basePath . '/artisan';

                        $output = [];
                        $return_var = 0;
                        exec('php ' . $artisanPath . ' storage:link 2>&1', $output, $return_var);

                        if ($return_var === 0) {
                            // Mensaje de éxito
                            $toast = '
                            <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800" role="alert">
                                <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                                    <i class="fas fa-check-circle text-lg"></i>
                                </div>
                                <div class="ms-3 text-sm font-normal">Enlace simbólico creado correctamente.</div>
                                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close" onclick="redirectToHome()">
                                    <i class="fas fa-times text-sm"></i>
                                </button>
                            </div>';
                        } else {
                            // Mensaje de error
                            $errorMessage = implode('<br>', $output);
                            $toast = '
                            <div id="toast-danger" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800" role="alert">
                                <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                                    <i class="fas fa-times-circle text-lg"></i>
                                </div>
                                <div class="ms-3 text-sm font-normal">Error: ' . $errorMessage . '</div>
                                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close" onclick="redirectToHome()">
                                    <i class="fas fa-times text-sm"></i>
                                </button>
                            </div>';
                        }
                    }
                @endphp

                <!-- Mostrar el toast -->
                {!! $toast ?? '' !!}
            </section>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

    <script>
        function redirectToHome() {
            window.location.href = '/';
        }
    </script>
@endsection
@extends('layouts.app')
@section('title', 'Nexus - Meses')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Gestionar Meses
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="index.html">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Gestión de meses</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Alerts Start -->
            @include('partials.alerts')
            <!-- ====== Alerts End -->

            <button data-modal-target="modal-gestion-meses" data-modal-toggle="modal-gestion-meses" type="button"
                class="group relative flex items-center gap-2.5 rounded-md px-6 py-2 font-medium text-white bg-[#374151] hover:bg-[#2f3949] duration-300 ease-in-out shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#34a1d3] focus:ring-opacity-50 mb-4">
                <i class="fas fa-calendar-alt"></i> Generar
            </button>

            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">

                <div class="w-full overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3 text-center">Año</th>
                                    <th colspan="12" class="px-4 py-3 text-center">Meses</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide -y dark:divide-gray-700 dark:bg-gray-800">
                                @foreach ($meses->sortByDesc('anio') as $anio)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm text-center font-bold">{{ $anio->anio }}</td>

                                        @php
                                            $mesesPorAnio = \App\Models\Mes::where('anio', $anio->anio)
                                                ->orderBy('numero')
                                                ->get();
                                        @endphp

                                        @foreach (range(1, 12) as $num)
                                            @php
                                                $mes = $mesesPorAnio->firstWhere('numero', $num);
                                            @endphp
                                            <td class="px-4 py-3 text-sm text-center">
                                                @if ($mes)
                                                    {{ $mes->nombre }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Paginación -->
                    <div class="mt-0">
                        {{ $meses->links() }}
                    </div>
                </div>

                <!-- Main modal -->
                <div id="modal-gestion-meses" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
                    class="hidden overflow-y-auto overflow-x-hidden fixed py-20 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Generar Meses de Pago
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-toggle="modal-gestion-meses">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5">

                                @php
                                    // 1) Año que mostramos: sesión o año corriente
                                    $anioSeleccionado = session('anioGenerado', $anioActual);
                                    // 2) Consulta de meses generados para ese año
                                    $mesesDelAnioSeleccionado = \App\Models\Mes::where('anio', $anioSeleccionado)
                                        ->orderBy('numero')
                                        ->get();
                                @endphp

                                <ol class="relative border-s border-gray-200 dark:border-gray-600 ms-3.5 mb-4 md:mb-5">
                                    <!-- 1) Regenerar el año seleccionado -->
                                    <li class="mb-10 ms-8">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Año Seleccionado: <span class="ml-2">{{ $anioSeleccionado }}</span>
                                        </h3>
                                        <time class="block mb-3 text-sm text-gray-500 dark:text-gray-400">
                                            Regenerar todos los meses de este año.
                                        </time>

                                        <form action="{{ route('months.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="anio" value="{{ $anioSeleccionado }}">
                                            <button type="submit"
                                                class="py-2 px-3 inline-flex items-center text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
                                                <i class="fas fa-calendar-alt me-1.5"></i>
                                                Regenerar Meses
                                            </button>
                                        </form>
                                    </li>

                                    <!-- 2) Generar para otro año -->
                                    <li class="mb-10 ms-8">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Generar Año Personalizado
                                        </h3>
                                        <time class="block mb-3 text-sm text-gray-500 dark:text-gray-400">
                                            <p>Puede ser anterior o futuro.</p>
                                        </time>

                                        <form action="{{ route('months.store') }}" method="POST">
                                            @csrf

                                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Año
                                            </label>
                                            <div class="flex gap-2 mt-1">
                                                <input
                                                    type="number"
                                                    name="anio"
                                                    value="{{ $anioSeleccionado }}"
                                                    min="2000"
                                                    max="2100"
                                                    step="1"
                                                    required
                                                    class="w-40 p-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-900 text-sm 
                                                           focus:ring-blue-500 focus:border-blue-500 
                                                           dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                                >
                                                <button type="submit"
                                                    class="py-2 px-3 w-1/2 inline-flex items-center text-sm font-medium text-gray-900 bg-white rounded-lg 
                                                           border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100 
                                                           dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white">
                                                    <i class="fas fa-calendar-alt me-1.5"></i>
                                                    Generar
                                                </button>
                                            </div>
                                        </form>
                                    </li>

                                    <!-- 3) Lista de meses generados para el año -->
                                    <li class="mb-4 ms-8">
                                        <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                            Meses de año actual: {{ $anioSeleccionado }}
                                        </h3>

                                        @if($mesesDelAnioSeleccionado->isNotEmpty())
                                            <ul class="list-disc list-inside text-sm text-gray-500 dark:text-gray-400">
                                                @foreach(range(1,12) as $num)
                                                    @php
                                                        $mes = $mesesDelAnioSeleccionado->firstWhere('numero', $num);
                                                    @endphp
                                                    <li>{{ $mes ? $mes->nombre : '-' }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p class="text-gray-500 dark:text-gray-400 text-sm">
                                                No hay meses generados para el año {{ $anioSeleccionado }}.
                                            </p>
                                        @endif
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ====== Table Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
@endsection

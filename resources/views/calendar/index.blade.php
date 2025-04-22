@extends('layouts.app')
@section('title', 'Business Manager - Calendario')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div class="mx-auto max-w-full">
                <!-- Breadcrumb Start -->
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-title-md2 font-bold text-black dark:text-white">
                        Calendario
                    </h2>

                    <nav>
                        <ol class="flex items-center gap-2">
                            <li>
                                <a class="font-medium" href="{{ route('home.index') }}">Panel /</a>
                            </li>
                            <li class="text-primary">Calendario</li>
                        </ol>
                    </nav>
                </div>
                <!-- Breadcrumb End -->

                <!-- ====== Calendar Section Start -->
                @include('partials.calendar-event-modal')

                <!-- Encabezado con botones -->
                <div class="flex flex-col gap-4 sm:flex-row items-center justify-between pb-4 border-b border-stroke dark:border-strokedark">
                    <!-- Botón "Add Event +" -->
                    <button onclick="openModal(new Date().toISOString().split('T')[0])"
                        class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                        Agregar Evento +
                    </button>

                    <!-- Título del mes y año -->
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white order-first sm:order-none">
                        Marzo 2025
                    </h2>

                    <!-- Botones de vista (mes, semana, día) -->
                    <div class="flex flex-wrap gap-2 w-full sm:w-auto justify-center">
                        <button
                            class="flex-1 sm:flex-none px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                            Mes
                        </button>
                        <button
                            class="flex-1 sm:flex-none px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                            Semana
                        </button>
                        <button
                            class="flex-1 sm:flex-none px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
                            Día
                        </button>
                    </div>
                </div>
                <div
                    class="w-full max-w-full rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                    <table class="w-full">
                        <thead>
                            <tr class="grid grid-cols-7 rounded-t-sm bg-primary text-white">
                                <th
                                    class="flex h-15 items-center justify-center rounded-tl-sm p-1 text-xs font-semibold sm:text-base xl:p-5">
                                    <span class="hidden lg:block"> Sunday </span>
                                    <span class="block lg:hidden"> Sun </span>
                                </th>
                                <th
                                    class="flex h-15 items-center justify-center p-1 text-xs font-semibold sm:text-base xl:p-5">
                                    <span class="hidden lg:block"> Monday </span>
                                    <span class="block lg:hidden"> Mon </span>
                                </th>
                                <th
                                    class="flex h-15 items-center justify-center p-1 text-xs font-semibold sm:text-base xl:p-5">
                                    <span class="hidden lg:block"> Tuesday </span>
                                    <span class="block lg:hidden"> Tue </span>
                                </th>
                                <th
                                    class="flex h-15 items-center justify-center p-1 text-xs font-semibold sm:text-base xl:p-5">
                                    <span class="hidden lg:block"> Wednesday </span>
                                    <span class="block lg:hidden"> Wed </span>
                                </th>
                                <th
                                    class="flex h-15 items-center justify-center p-1 text-xs font-semibold sm:text-base xl:p-5">
                                    <span class="hidden lg:block"> Thursday </span>
                                    <span class="block lg:hidden"> Thur </span>
                                </th>
                                <th
                                    class="flex h-15 items-center justify-center p-1 text-xs font-semibold sm:text-base xl:p-5">
                                    <span class="hidden lg:block"> Friday </span>
                                    <span class="block lg:hidden"> Fri </span>
                                </th>
                                <th
                                    class="flex h-15 items-center justify-center rounded-tr-sm p-1 text-xs font-semibold sm:text-base xl:p-5">
                                    <span class="hidden lg:block"> Saturday </span>
                                    <span class="block lg:hidden"> Sat </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Line 1 -->
                            <tr class="grid grid-cols-7">
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">1</span>
                                    <div class="group h-16 w-full flex-grow cursor-pointer py-1 md:h-30">
                                        <span class="group-hover:text-primary md:hidden">
                                            More
                                        </span>
                                        <div
                                            class="event invisible absolute left-2 z-30 mb-1 flex w-[200%] flex-col rounded-sm border-l-[3px] border-primary bg-gray px-3 py-1 text-left opacity-0 group-hover:visible group-hover:opacity-100 dark:bg-meta-4 md:visible md:w-[190%] md:opacity-100">
                                            <span class="event-name text-sm font-semibold text-black dark:text-white">
                                                Redesign Website
                                            </span>
                                            <span class="time text-sm font-medium text-black dark:text-white">
                                                1 Dec - 2 Dec
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">2</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">3</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">4</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">5</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">6</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">7</span>
                                </td>
                            </tr>
                            <!-- Line 1 -->
                            <!-- Line 2 -->
                            <tr class="grid grid-cols-7">
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">8</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">9</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">10</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">11</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">12</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">13</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">14</span>
                                </td>
                            </tr>
                            <!-- Line 2 -->
                            <!-- Line 3 -->
                            <tr class="grid grid-cols-7">
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">15</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">16</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">17</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">18</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">19</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">20</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">21</span>
                                </td>
                            </tr>
                            <!-- Line 3 -->
                            <!-- Line 4 -->
                            <tr class="grid grid-cols-7">
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">22</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">23</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">24</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">25</span>
                                    <div class="group h-16 w-full flex-grow cursor-pointer py-1 md:h-30">
                                        <span class="group-hover:text-primary md:hidden">
                                            More
                                        </span>
                                        <div
                                            class="event invisible absolute left-2 z-30 mb-1 flex w-[300%] flex-col rounded-sm border-l-[3px] border-primary bg-gray px-3 py-1 text-left opacity-0 group-hover:visible group-hover:opacity-100 dark:bg-meta-4 md:visible md:w-[290%] md:opacity-100">
                                            <span class="event-name text-sm font-semibold text-black dark:text-white">
                                                App Design
                                            </span>
                                            <span class="time text-sm font-medium text-black dark:text-white">
                                                25 Dec - 27 Dec
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">26</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">27</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">28</span>
                                </td>
                            </tr>
                            <!-- Line 4 -->
                            <!-- Line 5 -->
                            <tr class="grid grid-cols-7">
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">29</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">30</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">31</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">1</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">2</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">3</span>
                                </td>
                                <td
                                    class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                                    <span class="font-medium text-black dark:text-white">4</span>
                                </td>
                            </tr>
                            <!-- Line 5 -->
                        </tbody>
                    </table>
                </div>
                <!-- ====== Calendar Section End -->
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
    <!-- Script para manejar el modal -->
<script>
    // Función para abrir el modal
    function openModal(date) {
        const modal = document.getElementById('eventModal');
        modal.classList.remove('hidden');
        document.getElementById('event-start-date').value = date;
    }

    // Función para cerrar el modal
    document.querySelectorAll('.modal-close-btn').forEach(button => {
        button.addEventListener('click', () => {
            const modal = document.getElementById('eventModal');
            modal.classList.add('hidden');
        });
    });
</script>
    <!-- ===== Main Content End ===== -->
@endsection

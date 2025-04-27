@extends('layouts.app-cliente')
@section('title', 'Nexus - Comprobantes')

@section('content')

    <!-- Contenido principal -->
    <div class="relative p-4 w-full max-h-full mx-auto">

        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium text-lg">Comprobantes de pago</div>
            </div>

            <!-- Buscador -->
            <div class="mb-4">
                <form action="{{ route('payments.index') }}" method="GET" class="w-full">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                            @if (request('search'))
                                <a href="{{ route('payments.index') }}"
                                    class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 cursor-pointer">
                                    <i class="fas fa-times"></i>
                                </a>
                            @else
                                <div class="pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <input type="search" id="search" name="search"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-200 rounded-md bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Buscar Boleta..." value="{{ request('search') }}" required />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                    </div>
                </form>
            </div>

            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <div class="max-h-[500px] overflow-y-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead class="sticky top-0 bg-gray-50 dark:bg-gray-800">
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 dark:text-gray-400">
                                    <th class="px-4 py-3">Boleta</th>
                                    <th class="px-4 py-3">Cliente</th>
                                    <th class="px-4 py-3">Total</th>
                                    <th class="px-4 py-3">Fecha</th>
                                    <th class="px-4 py-3">Pago</th>
                                    <th class="px-4 py-3">Estado</th>
                                    <th class="px-4 py-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                <!-- Cobranza 1 -->
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">B001-0001</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p class="font-semibold">Juan Pérez</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="whitespace-nowrap">S/ 150.00</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">15/04/2023</td>
                                    <td class="px-4 py-3 text-sm">Efectivo</td>
                                    <td class="px-4 py-3 text-xs">
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight rounded-full flex items-center text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100">
                                            <i class="fas fa-check-circle mr-2"></i>
                                            emitido
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-2 text-sm">
                                            <button
                                                class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-purple-600 bg-purple-50 border border-purple-200 rounded-md hover:bg-purple-100 focus:outline-none focus:ring-1 focus:ring-purple-300 focus:ring-offset-1 dark:text-purple-200 dark:bg-purple-900 dark:border-purple-700 dark:hover:bg-purple-800 dark:focus:ring-purple-600"
                                                aria-label="Exportar a PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </button>
                                            <button
                                                class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-md hover:bg-blue-100 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-offset-1 dark:text-blue-200 dark:bg-blue-900 dark:border-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-600"
                                                aria-label="Ver">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Cobranza 2 -->
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">B001-0002</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p class="font-semibold">Juan Pérez</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="line-through text-gray-500">S/ 250.00</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">16/04/2023</td>
                                    <td class="px-4 py-3 text-sm">Depósito</td>
                                    <td class="px-4 py-3 text-xs">
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight rounded-full flex items-center text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100">
                                            <i class="fas fa-times-circle mr-2"></i>
                                            anulado
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-2 text-sm">
                                            <button
                                                class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-purple-600 bg-purple-50 border border-purple-200 rounded-md hover:bg-purple-100 focus:outline-none focus:ring-1 focus:ring-purple-300 focus:ring-offset-1 dark:text-purple-200 dark:bg-purple-900 dark:border-purple-700 dark:hover:bg-purple-800 dark:focus:ring-purple-600"
                                                aria-label="Exportar a PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </button>
                                            <button
                                                class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-md hover:bg-blue-100 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-offset-1 dark:text-blue-200 dark:bg-blue-900 dark:border-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-600"
                                                aria-label="Ver">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Cobranza 3 -->
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3 text-sm">B001-0003</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <p class="font-semibold">Juan Pérez</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="whitespace-nowrap">S/ 180.50</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">17/04/2023</td>
                                    <td class="px-4 py-3 text-sm">Depósito</td>
                                    <td class="px-4 py-3 text-xs">
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight rounded-full flex items-center text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100">
                                            <i class="fas fa-check-circle mr-2"></i>
                                            emitido
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-2 text-sm">
                                            <button
                                                class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-purple-600 bg-purple-50 border border-purple-200 rounded-md hover:bg-purple-100 focus:outline-none focus:ring-1 focus:ring-purple-300 focus:ring-offset-1 dark:text-purple-200 dark:bg-purple-900 dark:border-purple-700 dark:hover:bg-purple-800 dark:focus:ring-purple-600"
                                                aria-label="Exportar a PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </button>
                                            <button
                                                class="flex transition-all items-center justify-center px-2 py-1 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-md hover:bg-blue-100 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-offset-1 dark:text-blue-200 dark:bg-blue-900 dark:border-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-600"
                                                aria-label="Ver">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Total de cobros -->
                    <div
                        class="flex items-center justify-between py-3 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 sm:px-4">
                        <div class="flex items-center">
                            paginate
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.app-cliente')
@section('title', 'Nexus - Historial de Pagos')

@section('content')

    <!--Start Content -->
    <div class="relative p-4 w-full max-h-full mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Estado de Pagos</div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">

                    <div class="rounded-md border border-dashed border-gray-200 p-4">
                        <div class="flex items-center mb-0.5">
                            <div class="text-xl font-semibold">50</div>
                            <span
                                class="p-1 rounded text-[12px] font-semibold bg-emerald-500/10 text-emerald-500 leading-none ml-1">+$469</span>
                        </div>
                        <span class="text-gray-400 text-sm">Completado</span>
                    </div>
                    <div class="rounded-md border border-dashed border-gray-200 p-4">
                        <div class="flex items-center mb-0.5">
                            <div class="text-xl font-semibold">10</div>
                            <span
                                class="p-1 rounded text-[12px] font-semibold bg-blue-500/10 text-blue-500 leading-none ml-1">$80</span>
                        </div>
                        <span class="text-gray-400 text-sm">Pendiente</span>
                    </div>
                    <div class="rounded-md border border-dashed border-gray-200 p-4">
                        <div class="flex items-center mb-0.5">
                            <div class="text-xl font-semibold">4</div>
                            <span
                                class="p-1 rounded text-[12px] font-semibold bg-rose-500/10 text-rose-500 leading-none ml-1">-$130</span>
                        </div>
                        <span class="text-gray-400 text-sm">Rechazado</span>
                    </div>
                </div>

                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Historial de Pagos</div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[460px]">
                        <thead>
                            <tr>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">
                                    Medio de Pago</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Servicio</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Monto</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md">
                                    Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/paymethods/yape.png') }}" alt="yape"
                                            class="w-8 h-8 rounded object-cover block">
                                        <a href="#"
                                            class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">Yape</a>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-500">Internet Basico</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-emerald-500">S/. 235</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span
                                        class="inline-block p-1 rounded bg-emerald-500/10 text-emerald-500 font-medium text-[12px] leading-none">Completado</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/paymethods/bbva.png') }}" alt="bbva"
                                            class="w-8 h-8 rounded object-cover block">
                                        <a href="#"
                                            class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">BBVA</a>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-500">Internet Basico</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-emerald-500">S/. 235</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span
                                        class="inline-block p-1 rounded bg-rose-500/10 text-rose-500 font-medium text-[12px] leading-none">Rechazado</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--End Content -->
@endsection

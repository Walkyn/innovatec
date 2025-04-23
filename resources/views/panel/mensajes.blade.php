@extends('layouts.app-cliente')
@section('title', 'Nexus - Mensajes y Notificaciones')

@section('content')
    <!--Start Content -->
    <div class="relative p-4 w-full max-h-full mx-auto">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <!-- Encabezado -->
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium text-lg flex items-center gap-2">
                    <i class="fas fa-bell text-gray-600"></i>
                    Mensajes y Notificaciones
                </div>
            </div>

            <!-- Lista de Notificaciones -->
            <div class="space-y-4">
                <!-- Notificación de Pago Aceptado -->
                <div class="flex items-start gap-4 p-4 bg-green-50 border border-green-100 rounded-lg hover:shadow-md transition-all duration-200">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/paymethods/yape.png') }}" alt="yape" class="w-10 h-10 rounded-full border-2 border-green-200">
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-medium text-emerald-600 bg-emerald-100/60 px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <i class="fas fa-check-circle"></i>
                                    Aceptado
                                </span>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <i class="far fa-clock"></i>
                                <span>Hace 2 horas</span>
                            </div>
                        </div>
                        <div class="mt-3 text-sm text-gray-600">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex items-center gap-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Servicio</span>
                                        <p class="font-medium">Internet Básico</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Período</span>
                                        <p class="font-medium">Julio 2023</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Monto</span>
                                        <p class="font-medium">S/ 120.00</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Medio de pago</span>
                                        <p class="font-medium">Yape</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notificación de Pago en Revisión -->
                <div class="flex items-start gap-4 p-4 bg-yellow-50 border border-yellow-100 rounded-lg hover:shadow-md transition-all duration-200">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/paymethods/bbva.png') }}" alt="bbva" class="w-10 h-10 rounded-full border-2 border-yellow-200">
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="whitespace-nowrap text-xs font-medium text-yellow-600 bg-yellow-100/60 px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <i class="fas fa-clock"></i>
                                    En Revisión
                                </span>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <i class="far fa-clock"></i>
                                <span>Hace 1 día</span>
                            </div>
                        </div>
                        <div class="mt-3 text-sm text-gray-600">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex items-center gap-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Servicio</span>
                                        <p class="font-medium">Internet Básico</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Período</span>
                                        <p class="font-medium">Ago, Sep 2023</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Monto</span>
                                        <p class="font-medium">S/ 240.00</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Medio de pago</span>
                                        <p class="font-medium">BBVA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notificación de Pago Rechazado -->
                <div class="flex items-start gap-4 p-4 bg-red-50 border border-red-100 rounded-lg hover:shadow-md transition-all duration-200">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('images/paymethods/bcp.png') }}" alt="bcp" class="w-10 h-10 rounded-full border-2 border-red-200">
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-medium text-rose-600 bg-rose-100/60 px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <i class="fas fa-times-circle"></i>
                                    Rechazado
                                </span>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <i class="far fa-clock"></i>
                                <span>Hace 3 días</span>
                            </div>
                        </div>
                        <div class="mt-3 text-sm text-gray-600">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex items-center gap-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Servicio</span>
                                        <p class="font-medium">Internet Básico</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Período</span>
                                        <p class="font-medium">Junio 2023</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">

                                    <div>
                                        <span class="text-xs text-gray-500">Monto</span>
                                        <p class="font-medium">S/ 120.00</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div>
                                        <span class="text-xs text-gray-500">Medio de pago</span>
                                        <p class="font-medium">BCP</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 flex items-center gap-2 text-rose-600 bg-rose-50 p-2 rounded-md">
                                <i class="fas fa-exclamation-circle"></i>
                                <span class="text-xs">Motivo del rechazo: Comprobante ilegible</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Content -->
@endsection


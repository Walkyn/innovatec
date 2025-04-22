@extends('layouts.app-cliente')
@section('title', 'Nexus - Realizar Pago')

@section('content')

    <!--Start Content -->
    <div class="relative p-4 w-full max-h-full mx-auto">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium text-lg">Realizar Pagos</div>
            </div>

            <!-- Selectores para realizar el pago -->
            <div class="grid grid-cols-1 gap-4 mb-6">
                <!-- Selector de contrato -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contrato</label>
                        <select
                            class="w-full border border-gray-200 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Seleccione un contrato</option>
                            <option value="1">CONTR-2023-001</option>
                            <option value="2">CONTR-2023-002</option>
                        </select>
                    </div>

                    <!-- Selector de servicio -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                        <select
                            class="w-full border border-gray-200 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Seleccione un servicio</option>
                            <option value="1">Internet Fibra Óptica (S/ 120.00)</option>
                            <option value="2">Televisión HD (S/ 80.00)</option>
                        </select>
                    </div>
                </div>

                <!-- Selector de meses mejorado -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meses a pagar</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-2">
                        <!-- Mes 1 (Pagado) -->
                        <div class="relative">
                            <input type="checkbox" id="month-1" class="hidden peer" disabled>
                            <label for="month-1"
                                class="flex items-center justify-between p-2 border-2 border-green-200 rounded-lg cursor-not-allowed bg-green-50">
                                <span class="text-sm font-medium text-gray-700">Ene</span>
                                <span class="text-xs text-green-600 ml-2">S/120</span>
                                <span
                                    class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                            </label>
                        </div>

                        <!-- Mes 2 (Pagado) -->
                        <div class="relative">
                            <input type="checkbox" id="month-2" class="hidden peer" disabled>
                            <label for="month-2"
                                class="flex items-center justify-between p-2 border-2 border-green-200 rounded-lg cursor-not-allowed bg-green-50">
                                <span class="text-sm font-medium text-gray-700">Feb</span>
                                <span class="text-xs text-green-600 ml-2">S/120</span>
                                <span
                                    class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                            </label>
                        </div>

                        <!-- Mes 3 (Pagado) -->
                        <div class="relative">
                            <input type="checkbox" id="month-3" class="hidden peer" disabled>
                            <label for="month-3"
                                class="flex items-center justify-between p-2 border-2 border-green-200 rounded-lg cursor-not-allowed bg-green-50">
                                <span class="text-sm font-medium text-gray-700">Mar</span>
                                <span class="text-xs text-green-600 ml-2">S/120</span>
                                <span
                                    class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                            </label>
                        </div>

                        <!-- Mes 4 (Pagado) -->
                        <div class="relative">
                            <input type="checkbox" id="month-4" class="hidden peer" disabled>
                            <label for="month-4"
                                class="flex items-center justify-between p-2 border-2 border-green-200 rounded-lg cursor-not-allowed bg-green-50">
                                <span class="text-sm font-medium text-gray-700">Abr</span>
                                <span class="text-xs text-green-600 ml-2">S/120</span>
                                <span
                                    class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                            </label>
                        </div>

                        <!-- Mes 5 (Pagado) -->
                        <div class="relative">
                            <input type="checkbox" id="month-5" class="hidden peer" disabled>
                            <label for="month-5"
                                class="flex items-center justify-between p-2 border-2 border-green-200 rounded-lg cursor-not-allowed bg-green-50">
                                <span class="text-sm font-medium text-gray-700">May</span>
                                <span class="text-xs text-green-600 ml-2">S/120</span>
                                <span
                                    class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                            </label>
                        </div>

                        <!-- Mes 6 (Pagado) -->
                        <div class="relative">
                            <input type="checkbox" id="month-6" class="hidden peer" disabled>
                            <label for="month-6"
                                class="flex items-center justify-between p-2 border-2 border-green-200 rounded-lg cursor-not-allowed bg-green-50">
                                <span class="text-sm font-medium text-gray-700">Jun</span>
                                <span class="text-xs text-green-600 ml-2">S/120</span>
                                <span
                                    class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                            </label>
                        </div>

                        <!-- Mes 7 (Pendiente) -->
                        <div class="relative">
                            <input type="checkbox" id="month-7" class="hidden peer">
                            <label for="month-7"
                                class="flex items-center justify-between p-2 border-2 border-red-200 rounded-lg cursor-pointer hover:bg-red-50 peer-checked:border-red-500 peer-checked:bg-red-100">
                                <span class="text-sm font-medium text-gray-700">Jul</span>
                                <span class="text-xs text-red-600 ml-2">S/120</span>
                                <span
                                    class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>
                            </label>
                        </div>

                        <!-- Mes 8 (Pendiente) -->
                        <div class="relative">
                            <input type="checkbox" id="month-8" class="hidden peer">
                            <label for="month-8"
                                class="flex items-center justify-between p-2 border-2 border-red-200 rounded-lg cursor-pointer hover:bg-red-50 peer-checked:border-red-500 peer-checked:bg-red-100">
                                <span class="text-sm font-medium text-gray-700">Ago</span>
                                <span class="text-xs text-red-600 ml-2">S/120</span>
                                <span
                                    class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>
                            </label>
                        </div>

                        <!-- Mes 9 (No disponible) -->
                        <div class="relative">
                            <input type="checkbox" id="month-9" class="hidden peer" disabled>
                            <label for="month-9"
                                class="flex items-center justify-between p-2 border-2 border-gray-200 rounded-lg cursor-not-allowed bg-gray-50">
                                <span class="text-sm font-medium text-gray-400">Sep</span>
                                <span class="text-xs text-gray-400 ml-2">S/120</span>
                                <span
                                    class="absolute -top-1 -right-1 w-3 h-3 bg-gray-400 rounded-full border-2 border-white"></span>
                            </label>
                        </div>

                        <!-- Mes 10 (No disponible) -->
                        <div class="relative">
                            <input type="checkbox" id="month-10" class="hidden peer" disabled>
                            <label for="month-10"
                                class="flex items-center justify-between p-2 border-2 border-gray-200 rounded-lg cursor-not-allowed bg-gray-50">
                                <span class="text-sm font-medium text-gray-400">Oct</span>
                                <span class="text-xs text-gray-400 ml-2">S/120</span>
                                <span
                                    class="absolute -top-1 -right-1 w-3 h-3 bg-gray-400 rounded-full border-2 border-white"></span>
                            </label>
                        </div>

                        <!-- Mes 11 (No disponible) -->
                        <div class="relative">
                            <input type="checkbox" id="month-11" class="hidden peer" disabled>
                            <label for="month-11"
                                class="flex items-center justify-between p-2 border-2 border-gray-200 rounded-lg cursor-not-allowed bg-gray-50">
                                <span class="text-sm font-medium text-gray-400">Nov</span>
                                <span class="text-xs text-gray-400 ml-2">S/120</span>
                                <span
                                    class="absolute -top-1 -right-1 w-3 h-3 bg-gray-400 rounded-full border-2 border-white"></span>
                            </label>
                        </div>

                        <!-- Mes 12 (No disponible) -->
                        <div class="relative">
                            <input type="checkbox" id="month-12" class="hidden peer" disabled>
                            <label for="month-12"
                                class="flex items-center justify-between p-2 border-2 border-gray-200 rounded-lg cursor-not-allowed bg-gray-50">
                                <span class="text-sm font-medium text-gray-400">Dic</span>
                                <span class="text-xs text-gray-400 ml-2">S/120</span>
                                <span
                                    class="absolute -top-1 -right-1 w-3 h-3 bg-gray-400 rounded-full border-2 border-white"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón Agregar -->
            <div class="flex justify-center mb-6">
                <button
                    class="bg-gray-600 hover:bg-gray-700 text-white text-sm py-3 px-4 items-center justify-center font-medium lg:w-1/2 xl:w-1/3 w-full rounded-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    AGREGAR
                </button>
            </div>

            <!-- Tabla de detalles -->
            <div class="mb-6">
                <div class="font-medium mb-2">Detalles del Pago</div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[460px]">
                        <thead>
                            <tr>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">
                                    Accion</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">
                                    Servicio</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Precio/mes</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                    Meses</th>
                                <th
                                    class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tr-md rounded-br-md text-right">
                                    Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded bg-red-100 flex items-center justify-center">
                                            <i class="fas fa-trash text-red-500 text-sm"></i>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded bg-blue-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <span class="text-gray-600 text-sm font-medium ml-2">Internet Fibra Óptica</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-600">S/ 120.00</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-600">Enero, Febrero</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50 text-right">
                                    <span class="text-[13px] font-medium text-emerald-500">S/ 240.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded bg-red-100 flex items-center justify-center">
                                            <i class="fas fa-trash text-red-500 text-sm"></i>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded bg-purple-100 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-gray-600 text-sm font-medium ml-2">Televisión HD</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-600">S/ 80.00</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50">
                                    <span class="text-[13px] font-medium text-gray-600">Marzo</span>
                                </td>
                                <td class="py-2 px-4 border-b border-b-gray-50 text-right">
                                    <span class="text-[13px] font-medium text-emerald-500">S/ 80.00</span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"
                                    class="py-2 px-4 border-b border-b-gray-50 text-right font-medium text-gray-600">
                                    Total a pagar:</td>
                                <td class="py-2 px-4 border-b border-b-gray-50 font-bold text-emerald-500 text-right">S/
                                    320.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Selección de medio de pago -->
            <div x-data="{
                selectedMethod: '',
                copyToClipboard(text) {
                    navigator.clipboard.writeText(text)
                        .then(() => alert('Información copiada al portapapeles'))
                        .catch(err => console.error('Error al copiar:', err));
                }
            }" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Medio de Pago</label>
                    <select x-model="selectedMethod"
                        class="w-full border border-gray-200 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Seleccione medio de pago</option>
                        <option value="bcp">BCP</option>
                        <option value="bbva">BBVA</option>
                        <option value="nacion">Banco de la Nación</option>
                        <option value="yape">Yape</option>
                        <option value="plin">Plin</option>
                    </select>
                </div>

                <!-- Información de pago dinámica -->
                <div class="relative">
                    <!-- Tarjeta por defecto -->
                    <div x-show="!selectedMethod"
                        class="w-full h-46 bg-gray-100 rounded-xl relative text-gray-600 shadow-md transition-all">
                        <div class="w-full px-6 absolute top-6">
                            <div class="flex items-center justify-center h-34">
                                <p class="text-sm font-medium">Seleccione un medio de pago para ver los detalles</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta BCP -->
                    <div x-show="selectedMethod === 'bcp'" x-transition
                        class="w-full h-46 bg-[#0038A7] rounded-xl relative text-white shadow-md transition-all duration-300 transform hover:scale-105 overflow-hidden">
                        <div class="absolute top-3 right-3">
                            <button class="text-white/80 hover:text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16m-7 6h7" />
                                </svg>
                            </button>
                        </div>
                        <div class="w-full px-6 pt-4">
                            <div class="flex flex-col space-y-3">
                                <div>
                                    <p class="text-xs font-light text-white/80">Banco</p>
                                    <p class="text-lg font-semibold tracking-wide">Banco de Crédito BCP</p>
                                </div>
                                <div>
                                    <p class="text-xs font-light text-white/80">Cuenta Corriente</p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-lg font-medium tracking-wider">193-1234567-0-89</p>
                                        <button @click="copyToClipboard('193-1234567-0-89')"
                                            class="bg-white/10 hover:bg-white/20 rounded-full p-1 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                                <path
                                                    d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs font-light text-white/80">Titular</p>
                                    <p class="text-sm font-medium">NEXUS TELECOM S.A.C</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta BBVA -->
                    <div x-show="selectedMethod === 'bbva'" x-transition
                        class="w-full h-48 bg-[#072146] rounded-xl relative text-white shadow-md transition-all duration-300 transform hover:scale-105 overflow-hidden">
                        <div class="absolute top-3 right-3">
                            <button class="text-white/80 hover:text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16m-7 6h7" />
                                </svg>
                            </button>
                        </div>
                        <div class="w-full px-6 pt-4">
                            <div class="flex flex-col space-y-3">
                                <div>
                                    <p class="text-xs font-light text-white/80">Banco</p>
                                    <p class="text-lg font-semibold tracking-wide">BBVA</p>
                                </div>
                                <div>
                                    <p class="text-xs font-light text-white/80">Cuenta Corriente</p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-lg font-medium tracking-wider">0011-0123-0123456789</p>
                                        <button @click="copyToClipboard('0011-0123-0123456789')"
                                            class="bg-white/10 hover:bg-white/20 rounded-full p-1 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                                <path
                                                    d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs font-light text-white/80">Titular</p>
                                    <p class="text-sm font-medium">NEXUS TELECOM S.A.C</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta Yape -->
                    <div x-show="selectedMethod === 'yape'" x-transition
                        class="w-full h-46 bg-[#742284] rounded-xl relative text-white shadow-md transition-all duration-300 transform hover:scale-105 overflow-hidden">
                        <div class="absolute top-3 right-3">
                            <button class="text-white/80 hover:text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16m-7 6h7" />
                                </svg>
                            </button>
                        </div>
                        <div class="w-full px-6 pt-4">
                            <div class="flex flex-col space-y-3">
                                <div>
                                    <p class="text-xs font-light text-white/80">Método de Pago</p>
                                    <p class="text-lg font-semibold tracking-wide">Yape</p>
                                </div>
                                <div>
                                    <p class="text-xs font-light text-white/80">Número de Teléfono</p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-lg font-medium tracking-wider">987 654 321</p>
                                        <button @click="copyToClipboard('987654321')"
                                            class="bg-white/10 hover:bg-white/20 rounded-full p-1 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                                <path
                                                    d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs font-light text-white/80">Titular</p>
                                    <p class="text-sm font-medium">Juan Pérez</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta Plin -->
                    <div x-show="selectedMethod === 'plin'" x-transition
                        class="w-full h-46 bg-[#00A94E] rounded-xl relative text-white shadow-md transition-all duration-300 transform hover:scale-105 overflow-hidden">
                        <div class="absolute top-3 right-3">
                            <button class="text-white/80 hover:text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16m-7 6h7" />
                                </svg>
                            </button>
                        </div>
                        <div class="w-full px-6 pt-4">
                            <div class="flex flex-col space-y-3">
                                <div>
                                    <p class="text-xs font-light text-white/80">Método de Pago</p>
                                    <p class="text-lg font-semibold tracking-wide">Plin</p>
                                </div>
                                <div>
                                    <p class="text-xs font-light text-white/80">Número de Teléfono</p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-lg font-medium tracking-wider">999 888 777</p>
                                        <button @click="copyToClipboard('999888777')"
                                            class="bg-white/10 hover:bg-white/20 rounded-full p-1 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
                                                <path
                                                    d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs font-light text-white/80">Titular</p>
                                    <p class="text-sm font-medium">Juan Pérez</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmación de pago -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Confirmación de Pago</label>
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="confirm-payment"
                        class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                    <label for="confirm-payment" class="ml-2 text-sm text-gray-700">Confirmo que he realizado el
                        depósito/transferencia</label>
                </div>

                <!-- Subir comprobante -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subir comprobante</label>
                    <div class="flex items-center">
                        <label
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click para subir</span>
                                    o arrastrar</p>
                                <p class="text-xs text-gray-500">PNG, JPG o PDF (MAX. 5MB)</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" />
                        </label>
                    </div>
                </div>
            </div>

            <!-- Botón Enviar Pago -->
            <div class="flex justify-end">
                <button class="bg-emerald-600 hover:bg-emerald-700 text-white py-2 md:w-1/4 w-full px-6 justify-center rounded-md flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Enviar Pago
                </button>
            </div>
        </div>
    </div>
    <!--End Content -->

    <!-- Agregar este script al final del archivo o en la sección de scripts -->
    @push('scripts')
        <script>
            // Agregar función de clipboard personalizada
            document.addEventListener('alpine:init', () => {
                Alpine.magic('clipboard', () => {
                    return (text) => {
                        navigator.clipboard.writeText(text).then(() => {
                            alert('Información copiada al portapapeles');
                        }).catch(err => {
                            console.error('Error al copiar:', err);
                        });
                    }
                })
            })
        </script>
    @endpush

@endsection

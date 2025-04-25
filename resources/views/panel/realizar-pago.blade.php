@extends('layouts.app-cliente')
@section('title', 'Nexus - Realizar Pago')

@section('content')

    <!--Start Content -->
    <div class="relative p-4 w-full max-h-full mx-auto">
        <!-- Toast notification centrado -->
        <div x-data="{ 
            show: false,
            message: '',
            progress: 0,
            progressInterval: null,
            showToast(msg) {
                this.message = msg;
                this.show = true;
                this.progress = 0;
                
                if (this.progressInterval) clearInterval(this.progressInterval);
                
                const startTime = Date.now();
                const duration = 3000; // 3 segundos
                
                this.progressInterval = setInterval(() => {
                    const elapsed = Date.now() - startTime;
                    this.progress = (elapsed / duration) * 100;
                    
                    if (this.progress >= 100) {
                        this.show = false;
                        clearInterval(this.progressInterval);
                    }
                }, 10);
                
                setTimeout(() => {
                    this.show = false;
                    clearInterval(this.progressInterval);
                }, duration);
            }
        }" 
        @notify.window="showToast($event.detail.message)"
        class="fixed inset-0 flex items-center justify-center pointer-events-none z-50">
            <div x-show="show" 
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="max-w-sm w-full mx-4 bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900" x-text="message"></p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="show = false" class="rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none">
                                <span class="sr-only">Cerrar</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mt-3 w-full bg-gray-200 rounded-full h-1">
                        <div class="bg-green-500 h-1 rounded-full transition-all duration-10 ease-linear"
                            :style="'width: ' + progress + '%'">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium text-lg">Realizar Pagos</div>
            </div>

            <!-- Selectores para realizar el pago -->
            <div class="grid grid-cols-1 mb-6">
                <!-- Selector de contrato -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contrato</label>
                        <select
                            class="w-full border border-gray-200 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="">Seleccione un contrato</option>
                            <option value="1">CONTR-2023-001</option>
                            <option value="2">CONTR-2023-002</option>
                        </select>
                    </div>

                    <!-- Selector de servicio -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                        <select
                            class="w-full border border-gray-200 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
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
                                    <span class="text-gray-600 text-sm font-medium ml-2">Internet Basico</span>
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
                                    <span class="text-gray-600 text-sm font-medium ml-2">Netflix Basico</span>
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

            <!-- Selección de medio de pago mejorada -->
            <div x-data="{
                selectedMethod: '',
                copyToClipboard(text) {
                    navigator.clipboard.writeText(text)
                        .then(() => {
                            window.dispatchEvent(new CustomEvent('notify', {
                                detail: {
                                    message: 'Información copiada al portapapeles'
                                }
                            }));
                        })
                        .catch(err => {
                            window.dispatchEvent(new CustomEvent('notify', {
                                detail: {
                                    message: 'Error al copiar la información'
                                }
                            }));
                        });
                }
            }" class="mb-6">
                <div class="font-medium mb-4">Seleccione un método de pago</div>
                
                <!-- Selector de método de pago -->
                <div class="mb-4">
                    <select x-model="selectedMethod" class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4 border border-gray-200 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <option value="">Seleccione medio de pago</option>
                        <option value="bcp">BCP</option>
                        <option value="bbva">BBVA</option>
                        <option value="nacion">Banco de la Nación</option>
                        <option value="piura">Caja Piura</option>
                        <option value="yape">Yape</option>
                        <option value="plin">Plin</option>
                    </select>
                </div>

                <!-- Contenedor de tarjetas -->
                <div class="relative">
                    <!-- Contenedor con altura fija -->
                    <div class="relative h-[200px]">
                        <!-- Mensaje cuando no hay método seleccionado -->
                        <div x-show="!selectedMethod" 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            class="absolute inset-0 bg-gray-50 rounded-xl p-4 border-2 border-dashed border-gray-300 flex flex-col items-center justify-center text-center sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4 w-full">
                            <div class="mb-2">
                                <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600 font-medium">Seleccione un método de pago</p>
                            <p class="text-gray-400 text-sm">Para ver los detalles de la cuenta</p>
                        </div>

                        <!-- Tarjeta BCP -->
                        <div x-show="selectedMethod === 'bcp'" 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute inset-0 bg-[#005696] rounded-xl p-4 text-white shadow-md sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4 w-full">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-lg font-semibold">BCP</p>
                                <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                    <img src="{{ asset('images/paymethods/bcp.png') }}" alt="BCP" class="w-10 h-10">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-xs text-white/80">Cuenta Corriente</p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm font-medium">193-1234567-0-89</p>
                                        <button @click="copyToClipboard('193-1234567-0-89')" 
                                            class="text-white/80 hover:text-white">
                                            <i class="fas fa-copy text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-white/80">Titular</p>
                                    <p class="text-sm">NEXUS TELECOM S.A.C</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta BBVA -->
                        <div x-show="selectedMethod === 'bbva'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute inset-0 bg-[#00427F] rounded-xl p-4 text-white shadow-md sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4 w-full">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-lg font-semibold">BBVA</p>
                                <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                    <img src="{{ asset('images/paymethods/bbva.png') }}" alt="BBVA" class="w-10 h-10">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-xs text-white/80">Cuenta Corriente</p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm font-medium">0011-0123-0123456789</p>
                                        <button @click="copyToClipboard('0011-0123-0123456789')"
                                            class="text-white/80 hover:text-white">
                                            <i class="fas fa-copy text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-white/80">Titular</p>
                                    <p class="text-sm">NEXUS TELECOM S.A.C</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta Banco de la Nación -->
                        <div x-show="selectedMethod === 'nacion'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute inset-0 bg-[#D12C1F] rounded-xl p-4 text-white shadow-md sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4 w-full">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-lg font-semibold no-wrap">Banco de la Nación</p>
                                </div>
                                <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                    <img src="{{ asset('images/paymethods/bcn.png') }}" alt="Banco de la Nación" class="w-10 h-10">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-xs text-white/80">Cuenta Corriente</p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm font-medium">04-074-875432</p>
                                        <button @click="copyToClipboard('04074875432')"
                                            class="text-white/80 hover:text-white">
                                            <i class="fas fa-copy text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-white/80">Titular</p>
                                    <p class="text-sm">NEXUS TELECOM S.A.C</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta Caja Piura -->
                        <div x-show="selectedMethod === 'piura'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute inset-0 bg-gradient-to-r from-[#003C7F] to-[#0056B3] rounded-xl p-4 text-white shadow-md sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4 w-full">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-lg font-semibold no-wrap">Caja Piura</p>
                                </div>
                                <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                    <img src="{{ asset('images/paymethods/piura.png') }}" alt="Caja Piura" class="w-10 h-10">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-xs text-white/80">Cuenta de Ahorros</p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm font-medium">110-01-2345678</p>
                                        <button @click="copyToClipboard('110012345678')"
                                            class="text-white/80 hover:text-white">
                                            <i class="fas fa-copy text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-white/80">Titular</p>
                                    <p class="text-sm">NEXUS TELECOM S.A.C</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta Yape -->
                        <div x-show="selectedMethod === 'yape'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute inset-0 bg-[#742284] rounded-xl p-4 text-white shadow-md sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4 w-full">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-lg font-semibold">Yape</p>
                                <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                    <img src="{{ asset('images/paymethods/yape.png') }}" alt="Yape" class="w-10 h-10">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-xs text-white/80">Número de Teléfono</p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm font-medium">987 654 321</p>
                                        <button @click="copyToClipboard('987654321')"
                                            class="text-white/80 hover:text-white">
                                            <i class="fas fa-copy text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-white/80">Titular</p>
                                    <p class="text-sm">Juan Pérez</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta Plin -->
                        <div x-show="selectedMethod === 'plin'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute inset-0 bg-[#6AB4E0] rounded-xl p-4 text-white shadow-md sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/4 w-full">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-lg font-semibold">Plin</p>
                                <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                                    <img src="{{ asset('images/paymethods/plin.png') }}" alt="Plin" class="w-10 h-10">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-xs text-white/80">Número de Teléfono</p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm font-medium">999 888 777</p>
                                        <button @click="copyToClipboard('999888777')"
                                            class="text-white/80 hover:text-white">
                                            <i class="fas fa-copy text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-white/80">Titular</p>
                                    <p class="text-sm">Juan Pérez</p>
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

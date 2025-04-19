@extends('layouts.app')
@section('title', 'Innovatec - Mensajes')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>

        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Mensajes
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{ route('home.index') }}">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Mensajes</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Alerts Start -->
            @include('partials.alerts')
            <!-- ====== Alerts End -->

            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">

                <div class="flex h-screen">
                    <!-- Sidebar con conversaciones -->
                    <div class="w-1/4 bg-white dark:bg-boxdark border-r border-gray-200 dark:border-strokedark">
                        <!-- Header del sidebar sin borde inferior -->
                        <div class="p-6">
                            <h1 class="text-xl font-semibold text-black dark:text-white flex justify-between">Mensajes <span class="bg-gray-100 dark:bg-meta-4 text-sm px-2 py-1 rounded-md">7</span></h1>
                        </div>

                        <!-- Buscador con borde superior alineado con el header del chat -->
                        <div class="border-t border-gray-200 dark:border-strokedark">
                            <div class="p-4">
                                <div class="relative">
                                    <input type="text" placeholder="Search..." class="w-full p-2 pl-8 rounded-lg border border-gray-200 dark:border-strokedark dark:bg-meta-4 dark:text-white focus:outline-none">
                                    <svg class="w-4 h-4 absolute left-2.5 top-3.5 text-gray-400 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-y-auto p-4">
                            <!-- Lista de conversaciones -->
                            <div class="flex items-center mb-2 p-2 hover:bg-gray-50 dark:hover:bg-meta-4 cursor-pointer">
                                <div class="relative">
                                    <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                        HD
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white dark:border-boxdark"></div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="font-semibold text-black dark:text-white">Henry Dholi</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">I came across your profile and...</p>
                                </div>
                            </div>
                
                            <div class="flex items-center mb-2 p-2 hover:bg-gray-50 dark:hover:bg-meta-4 cursor-pointer">
                                <div class="relative">
                                    <div class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center text-white font-semibold">
                                        MD
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white dark:border-boxdark"></div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="font-semibold text-black dark:text-white">Mariya Dasoja</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">I like your confidence 😊</p>
                                </div>
                            </div>
                
                            <div class="flex items-center mb-2 p-2 hover:bg-gray-50 dark:hover:bg-meta-4 cursor-pointer">
                                <div class="relative">
                                    <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white font-semibold">
                                        RJ
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white dark:border-boxdark"></div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="font-semibold text-black dark:text-white">Robert Jhon</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">Can you share your offer?</p>
                                </div>
                            </div>
            
                        </div>
                    </div>
                
                    <!-- Área de chat principal -->
                    <div class="flex-1 flex flex-col bg-gray-50 dark:bg-boxdark-2">
                        <!-- Encabezado del chat con borde inferior -->
                        <div class="border-b border-gray-200 dark:border-strokedark">
                            <div class="p-4 flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                        HD
                                    </div>
                                    <div class="ml-3">
                                        <h2 class="text-lg font-semibold text-black dark:text-white">Henry Dholi</h2>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Reply to message</p>
                                    </div>
                                </div>
                                <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                
                        <!-- Mensajes del chat -->
                        <div class="flex-1 overflow-y-auto p-4 space-y-4">
                            <!-- Mensaje recibido -->
                            <div class="flex justify-start">
                                <div class="bg-white dark:bg-boxdark p-3 rounded-lg max-w-xs">
                                    <p class="text-black dark:text-white">I can across your profile and...</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 text-right mt-1">1:56pm</p>
                                </div>
                            </div>
                
                            <!-- Mensaje enviado -->
                            <div class="flex justify-end">
                                <div class="bg-blue-500 text-white p-3 rounded-lg max-w-xs">
                                    <p>You are welcome!</p>
                                    <p class="text-xs text-blue-100 text-right mt-1">1:56pm</p>
                                </div>
                            </div>
                
                            <!-- Nueva conversación con Andri Thomas -->
                            <div class="mt-8">
                                <div class="flex justify-start">
                                    <div class="bg-white dark:bg-boxdark p-3 rounded-lg max-w-xs">
                                        <p class="font-semibold text-black dark:text-white">Andri Thomas</p>
                                        <p>I want to make an appointment tomorrow from 2:00 to 5:00pm?</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 text-right mt-1">1:56pm</p>
                                    </div>
                                </div>
                
                                <div class="flex justify-end mt-2">
                                    <div class="bg-blue-500 text-white p-3 rounded-lg max-w-xs">
                                        <p>Hello, Thomas! I will check the schedule and inform you</p>
                                        <p class="text-xs text-blue-100 text-right mt-1">1:56pm</p>
                                    </div>
                                </div>
                
                                <div class="flex justify-start mt-2">
                                    <div class="bg-white dark:bg-boxdark p-3 rounded-lg max-w-xs">
                                        <p class="font-semibold text-black dark:text-white">Andri Thomas</p>
                                        <p>Ok, Thanks for your reply.</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 text-right mt-1">1:56pm</p>
                                    </div>
                                </div>
                
                                <div class="flex justify-end mt-2">
                                    <div class="bg-blue-500 text-white p-3 rounded-lg max-w-xs">
                                        <p>You are welcome!</p>
                                        <p class="text-xs text-blue-100 text-right mt-1">1:56pm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <!-- Área de escritura -->
                        <div class="p-4 bg-white dark:bg-boxdark border-t border-gray-200 dark:border-strokedark">
                            <div class="flex items-center bg-gray-50 dark:bg-meta-4 rounded-lg p-2">
                                <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 mx-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                    </svg>
                                </button>
                                <input type="text" placeholder="Type something here" class="flex-1 bg-transparent focus:outline-none text-black dark:text-white">
                                <button class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 mx-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                                <button class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                </button>
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







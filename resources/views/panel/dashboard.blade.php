@extends('layouts.app-cliente')
@section('title', 'Nexus - Panel Principal')

@section('content')

    <!-- Contenido principal -->
    <div class="relative p-4 w-full max-h-full mx-auto">
        <!-- Portada de la empresa -->
        <div class="relative z-20 h-35 md:h-65">

            <img id="companyCoverPreview"
                src="{{ isset($company) && $company->portada ? asset('storage/covers/' . $company->portada) : './images/portada.jpg' }}"
                alt="company cover" class="h-full w-full rounded-tl-sm rounded-tr-sm object-cover object-center" />

            <!-- Botón de "Mas" -->
            <div class="absolute top-1 left-1 z-10 xsm:top-4 xsm:left-4">
                <a href="#"
                    class="flex transition-all cursor-pointer items-center justify-center gap-2 rounded bg-primary px-2 py-1 text-sm font-medium text-white hover:bg-opacity-80">
                    <span class="flex-shrink-0">
                        <svg class="fill-white" width="14" height="14" viewBox="0 0 14 14" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.0007 1.16663C4.23737 1.16663 1.16737 4.23663 1.16737 6.99996C1.16737 9.76329 4.23737 12.8333 7.0007 12.8333C9.76403 12.8333 12.834 9.76329 12.834 6.99996C12.834 4.23663 9.76403 1.16663 7.0007 1.16663ZM7.58403 9.91663H6.41737V8.74996H7.58403V9.91663ZM7.58403 7.58329H6.41737V4.08329H7.58403V7.58329Z"
                                fill="white" />
                        </svg>
                    </span>
                    <span>
                        Mas Información
                    </span>
                </a>
            </div>
        </div>

        <!-- Tarjeta de información principal -->
        <div class="bg-white rounded-b-lg shadow-sm border border-gray-100 p-6 mb-8">
            <!-- Encabezado -->
            <div class="flex items-center space-x-4 mb-6">
                <div class="hidden md:flex w-24 h-24 rounded-lg bg-gray-100 items-center justify-center">
                    <img src="{{ isset($company) && $company->logo ? asset('storage/logos/' . $company->logo) : './images/user/profile.png' }}"
                        alt="Logo Empresa" class="w-22 h-22 object-contain">
                </div>

                <div class="flex-1">
                    <h1 class="text-2xl md:text-3xl font-light text-gray-900">Nexus Telecom Peru</h1>
                    <p class="text-gray-500 font-light">Soluciones en telecomunicaciones</p>
                </div>
            </div>

            <!-- Sobre Nosotros -->
            <div class="mb-8">
                <h3 class="text-lg font-light text-gray-800 border-b pb-2 mb-4">Sobre Nosotros</h3>
                <div class="prose max-w-none text-gray-600">
                    <p>Nexus Telecom Peru es una empresa líder en el sector de telecomunicaciones, fundada en 2008 con la
                        misión de conectar a las personas y negocios a través de soluciones tecnológicas innovadoras.</p>

                    <p>Hemos sido reconocidos por tres años consecutivos como la empresa de telecomunicaciones con mayor
                        crecimiento en la región, gracias a nuestra capacidad de adaptación y a nuestra constante inversión
                        en tecnología de vanguardia.</p>
                </div>
            </div>

            <!-- Estadísticas clave -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <!-- Años de experiencia -->
                <div class="p-4 border-l-2 border-blue-500">
                    <p class="text-sm text-gray-500 mb-1">Experiencia</p>
                    <p class="text-2xl font-light text-gray-800">15+ años</p>
                </div>

                <!-- Clientes -->
                <div class="p-4 border-l-2 border-green-500">
                    <p class="text-sm text-gray-500 mb-1">Clientes</p>
                    <p class="text-2xl font-light text-gray-800">10k+</p>
                </div>

                <!-- Soporte -->
                <div class="p-4 border-l-2 border-purple-500">
                    <p class="text-sm text-gray-500 mb-1">Soporte</p>
                    <p class="text-2xl font-light text-gray-800">24/7</p>
                </div>
            </div>

            <!-- Información de contacto -->
            <div class="space-y-6">
                <h3 class="text-lg font-light text-gray-800 border-b pb-2">Información de contacto</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Teléfono -->
                    <div class="flex items-start space-x-3">
                        <div class="mt-1 flex-shrink-0 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Teléfono</p>
                            <a href="tel:+51123456789" class="text-gray-700 hover:text-blue-600">+51 123 456 789</a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start space-x-3">
                        <div class="mt-1 flex-shrink-0 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <a href="mailto:contacto@nexus.com"
                                class="text-gray-700 hover:text-blue-600">contacto@nexus.com</a>
                        </div>
                    </div>

                    <!-- Dirección -->
                    <div class="flex items-start space-x-3">
                        <div class="mt-1 flex-shrink-0 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Dirección</p>
                            <p class="text-gray-700">Av. Principal 123, Lima</p>
                        </div>
                    </div>

                    <!-- Website -->
                    <div class="flex items-start space-x-3">
                        <div class="mt-1 flex-shrink-0 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Sitio web</p>
                            <a href="https://www.nexus.com" target="_blank"
                                class="text-gray-700 hover:text-blue-600">www.nexus.com</a>
                        </div>
                    </div>

                    <!-- Facebook -->
                    <div class="flex items-start space-x-3">
                        <div class="mt-1 flex-shrink-0 text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Facebook</p>
                            <a href="https://www.facebook.com/nexus.com" target="_blank"
                                class="text-gray-700 hover:text-blue-600">www.facebook.com/nexus.com</a>
                        </div>
                    </div>


                    <!-- Instagram -->
                    <div class="flex items-start space-x-3">
                        <div class="mt-1 flex-shrink-0 text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Instagram</p>
                            <a href="https://www.instagram.com/nexus.com" target="_blank"
                                class="text-gray-700 hover:text-blue-600">www.instagram.com/nexus.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

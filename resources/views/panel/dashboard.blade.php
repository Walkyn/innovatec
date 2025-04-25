@extends('layouts.app-cliente')
@section('title', 'Nexus - Panel Principal')

@section('content')

    <!-- Contenido principal -->
    <div class="relative p-4 w-full max-h-full mx-auto">
        <!-- Portada de la empresa -->
        <div class="relative z-20 h-35 md:h-65">

            <img id="companyCoverPreview"
                src="{{ isset($configuracion) && $configuracion->portada ? asset('storage/covers/' . $configuracion->portada) : './images/portada.jpg' }}"
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
            <div class="flex items-center gap-4 mb-6">
                <div class="hidden md:flex w-30 h-20 rounded-lg bg-gray-50 items-center justify-center">
                    <img src="{{ $configuracion->logo ? asset('storage/logos/' . $configuracion->logo) : asset('images/logo/logo.png') }}"
                        alt="Logo Empresa" class="w-30 h-20 object-contain">
                </div>

                <div class="flex-1">
                    <h1 class="text-2xl md:text-3xl font-light text-gray-900">{{ $configuracion->nombre ?? 'Nombre de la empresa' }}</h1>
                </div>
            </div>

            <!-- Sobre Nosotros -->
            <div class="mb-8">
                <h3 class="text-lg font-light text-gray-800 border-b pb-2 mb-4">Sobre Nosotros</h3>
                <div class="prose max-w-none text-gray-600">
                    {!! $configuracion->descripcion !!}
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

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Teléfono -->
                    <div class="flex items-start space-x-3 overflow-hidden">
                        <div class="mt-1 flex-shrink-0 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm text-gray-500">Teléfono</p>
                            <a href="tel:+{{ $configuracion->telefono ?? '51123456789' }}"
                                class="text-gray-700 hover:text-blue-600 truncate block">
                                +{{ $configuracion->telefono ?? '51 123 456 789' }}
                            </a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start space-x-3 overflow-hidden">
                        <div class="mt-1 flex-shrink-0 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm text-gray-500">Email</p>
                            <a href="mailto:{{ $configuracion->correo ?? 'contacto@nexus.com' }}"
                                class="text-gray-700 hover:text-blue-600 truncate block">
                                {{ $configuracion->correo ?? 'contacto@nexus.com' }}
                            </a>
                        </div>
                    </div>

                    <!-- Dirección -->
                    <div class="flex items-start space-x-3 overflow-hidden">
                        <div class="mt-1 flex-shrink-0 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm text-gray-500">Dirección</p>
                            <p class="text-gray-700 truncate">{{ $configuracion->direccion ?? 'Av. Principal 123, Lima' }}</p>
                        </div>
                    </div>

                    <!-- Website -->
                    <div class="flex items-start space-x-3 overflow-hidden">
                        <div class="mt-1 flex-shrink-0 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm text-gray-500">Sitio web</p>
                            <a href="{{ $configuracion->website ?? 'https://www.nexus.com' }}" target="_blank"
                                class="text-gray-700 hover:text-blue-600 truncate block">
                                {{ $configuracion->website ?? 'www.nexus.com' }}
                            </a>
                        </div>
                    </div>

                    <!-- Facebook -->
                    <div class="flex items-start space-x-3 overflow-hidden">
                        <div class="mt-1 flex-shrink-0 text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm text-gray-500">Facebook</p>
                            <a href="{{ $configuracion->facebook ?? 'https://www.facebook.com/nexus.com' }}" target="_blank"
                                class="text-gray-700 hover:text-blue-600 truncate block">
                                {{ $configuracion->facebook ?? 'www.facebook.com/nexus.com' }}
                            </a>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="flex items-start space-x-3 overflow-hidden">
                        <div class="mt-1 flex-shrink-0 text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm text-gray-500">WhatsApp</p>
                            <a href="https://wa.me/{{ trim(str_replace(['https://wa.me/', '+', ' '], '', $configuracion->whatsapp ?? '51917319939')) }}" 
                                target="_blank"
                                class="text-gray-700 hover:text-blue-600 block">
                                +{{ trim(str_replace(['https://wa.me/', '+', ' '], '', $configuracion->whatsapp ?? '51917319939')) }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

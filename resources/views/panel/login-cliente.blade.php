@extends('layouts.login')
@section('title', 'Nexus - Iniciar Sesión')

@section('content')

    <!-- ====== Forms Section Start -->
    <section class="bg-gray-1 dark:bg-gray-900 py-20 lg:py-[120px] p-4">

        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full px-4">
                    <div
                        class="relative mx-auto max-w-[525px] overflow-hidden rounded-lg bg-white py-16 px-6 text-center sm:px-12 md:px-[60px] dark:bg-gray-900">
                        <div class="mb-10 text-center md:mb-16">

                            <a href="javascript:void(0)" class="mx-auto inline-block max-w-[460px]">
                                <img class="h-18 w-full"
                                    src="{{ $configuracion->logo ? asset('storage/logos/' . $configuracion->logo) : asset('images/logo/logo.png') }}"
                                    alt="Logo">
                            </a>

                        </div>

                        <form method="POST" action="{{ route('panel.login') }}">
                            @csrf
                            <div class="mb-6">
                                <input type="text" name="identificacion" placeholder="Ingrese DNI o RUC"
                                    value="{{ old('identificacion') }}"
                                    class="w-full px-5 py-3 text-base bg-transparent border rounded-md outline-none border-stroke text-body-color dark:text-white dark:border-dark-3 focus:border-primary focus-visible:shadow-none @error('identificacion') border-[#F87171] @enderror" />
                                @error('identificacion')
                                    <div class="flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle text-[#F87171] mr-2"></i>
                                        <span class="text-sm text-[#F87171]">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <input type="password" name="clave_acceso" placeholder="Ingrese su contraseña"
                                    class="w-full px-5 py-3 text-base bg-transparent border rounded-md outline-none border-stroke text-body-color dark:text-white dark:border-dark-3 focus:border-primary focus-visible:shadow-none @error('clave_acceso') border-[#F87171] @enderror" />
                                @error('clave_acceso')
                                    <div class="flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle text-[#F87171] mr-2"></i>
                                        <span class="text-sm text-[#F87171]">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <button type="submit"
                                    class="w-full px-5 py-3 text-base font-medium text-white transition border rounded-md cursor-pointer border-primary bg-primary hover:bg-opacity-90">
                                    Iniciar Sesión
                                </button>
                            </div>

                            @if (session('error'))
                                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </form>

                        <!-- ====== Alerts Start -->
                        @include('partials.alerts')
                        <!-- ====== Alerts End -->

                        <a href="javascript:void(0)"
                            class="inline-block mb-2 text-base text-gray-500 dark:text-gray-200 hover:text-primary hover:underline">
                            Olvidaste tu contraseña?
                        </a>
                        <p class="text-base text-body-color dark:text-dark-6">
                            <span class="pr-0.5">Contáctenos</span>
                            <a href="javascript:void(0)" class="text-primary hover:underline">
                                Aquí
                            </a>
                        </p>
                        <div>
                            <span class="absolute top-1 right-1">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="1.39737" cy="38.6026" r="1.39737"
                                        transform="rotate(-90 1.39737 38.6026)" fill="#3056D3" />
                                    <circle cx="1.39737" cy="1.99122" r="1.39737"
                                        transform="rotate(-90 1.39737 1.99122)" fill="#3056D3" />
                                    <circle cx="13.6943" cy="38.6026" r="1.39737"
                                        transform="rotate(-90 13.6943 38.6026)" fill="#3056D3" />
                                    <circle cx="13.6943" cy="1.99122" r="1.39737"
                                        transform="rotate(-90 13.6943 1.99122)" fill="#3056D3" />
                                    <circle cx="25.9911" cy="38.6026" r="1.39737"
                                        transform="rotate(-90 25.9911 38.6026)" fill="#3056D3" />
                                    <circle cx="25.9911" cy="1.99122" r="1.39737"
                                        transform="rotate(-90 25.9911 1.99122)" fill="#3056D3" />
                                    <circle cx="38.288" cy="38.6026" r="1.39737" transform="rotate(-90 38.288 38.6026)"
                                        fill="#3056D3" />
                                    <circle cx="38.288" cy="1.99122" r="1.39737" transform="rotate(-90 38.288 1.99122)"
                                        fill="#3056D3" />
                                    <circle cx="1.39737" cy="26.3057" r="1.39737"
                                        transform="rotate(-90 1.39737 26.3057)" fill="#3056D3" />
                                    <circle cx="13.6943" cy="26.3057" r="1.39737"
                                        transform="rotate(-90 13.6943 26.3057)" fill="#3056D3" />
                                    <circle cx="25.9911" cy="26.3057" r="1.39737"
                                        transform="rotate(-90 25.9911 26.3057)" fill="#3056D3" />
                                    <circle cx="38.288" cy="26.3057" r="1.39737" transform="rotate(-90 38.288 26.3057)"
                                        fill="#3056D3" />
                                    <circle cx="1.39737" cy="14.0086" r="1.39737"
                                        transform="rotate(-90 1.39737 14.0086)" fill="#3056D3" />
                                    <circle cx="13.6943" cy="14.0086" r="1.39737"
                                        transform="rotate(-90 13.6943 14.0086)" fill="#3056D3" />
                                    <circle cx="25.9911" cy="14.0086" r="1.39737"
                                        transform="rotate(-90 25.9911 14.0086)" fill="#3056D3" />
                                    <circle cx="38.288" cy="14.0086" r="1.39737"
                                        transform="rotate(-90 38.288 14.0086)" fill="#3056D3" />
                                </svg>
                            </span>
                            <span class="absolute left-1 bottom-1">
                                <svg width="29" height="40" viewBox="0 0 29 40" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="2.288" cy="25.9912" r="1.39737"
                                        transform="rotate(-90 2.288 25.9912)" fill="#3056D3" />
                                    <circle cx="14.5849" cy="25.9911" r="1.39737"
                                        transform="rotate(-90 14.5849 25.9911)" fill="#3056D3" />
                                    <circle cx="26.7216" cy="25.9911" r="1.39737"
                                        transform="rotate(-90 26.7216 25.9911)" fill="#3056D3" />
                                    <circle cx="2.288" cy="13.6944" r="1.39737"
                                        transform="rotate(-90 2.288 13.6944)" fill="#3056D3" />
                                    <circle cx="14.5849" cy="13.6943" r="1.39737"
                                        transform="rotate(-90 14.5849 13.6943)" fill="#3056D3" />
                                    <circle cx="26.7216" cy="13.6943" r="1.39737"
                                        transform="rotate(-90 26.7216 13.6943)" fill="#3056D3" />
                                    <circle cx="2.288" cy="38.0087" r="1.39737"
                                        transform="rotate(-90 2.288 38.0087)" fill="#3056D3" />
                                    <circle cx="2.288" cy="1.39739" r="1.39737"
                                        transform="rotate(-90 2.288 1.39739)" fill="#3056D3" />
                                    <circle cx="14.5849" cy="38.0089" r="1.39737"
                                        transform="rotate(-90 14.5849 38.0089)" fill="#3056D3" />
                                    <circle cx="26.7216" cy="38.0089" r="1.39737"
                                        transform="rotate(-90 26.7216 38.0089)" fill="#3056D3" />
                                    <circle cx="14.5849" cy="1.39761" r="1.39737"
                                        transform="rotate(-90 14.5849 1.39761)" fill="#3056D3" />
                                    <circle cx="26.7216" cy="1.39761" r="1.39737"
                                        transform="rotate(-90 26.7216 1.39761)" fill="#3056D3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Forms Section End -->

@endsection

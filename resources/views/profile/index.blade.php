@extends('layouts.app')
@section('title', 'Business Manager - Perfil')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div class="mx-auto max-w-full">
                <!-- Breadcrumb Start -->
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-title-md2 font-bold text-black dark:text-white">
                        Perfil
                    </h2>

                    <nav>
                        <ol class="flex items-center gap-2">
                            <li>
                                <a class="font-medium" href="index.html">Panel /</a>
                            </li>
                            <li class="text-primary">Perfil</li>
                        </ol>
                    </nav>
                </div>
                <!-- Breadcrumb End -->

                <!-- ====== Alerts Start -->
                @include('partials.alerts')
                <!-- ====== Alerts End -->

                <!-- ====== Profile Section Start -->
                <div
                    class="overflow-hidden rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                    <form id="coverPhotoForm" action="{{ route('profile.update.cover') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="relative z-20 h-35 md:h-65">
                            <img id="coverPhotoPreview"
                                src="{{ auth()->user()->cover_photo ? asset('storage/covers/' . auth()->user()->cover_photo) : './images/cover/cover-01.png' }}"
                                alt="profile cover"
                                class="h-full w-full rounded-tl-sm rounded-tr-sm object-cover object-center" />
                            <div class="absolute bottom-1 right-1 z-10 xsm:bottom-4 xsm:right-4">
                                <label for="coverPhotoInput"
                                    class="flex cursor-pointer items-center justify-center gap-2 rounded bg-primary px-2 py-1 text-sm font-medium text-white hover:bg-opacity-80 xsm:px-4">
                                    <input type="file" name="cover_photo" id="coverPhotoInput" class="sr-only" />
                                    <span>
                                        <!-- Icono SVG -->
                                        <svg class="fill-current" width="14" height="14" viewBox="0 0 14 14"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M4.76464 1.42638C4.87283 1.2641 5.05496 1.16663 5.25 1.16663H8.75C8.94504 1.16663 9.12717 1.2641 9.23536 1.42638L10.2289 2.91663H12.25C12.7141 2.91663 13.1592 3.101 13.4874 3.42919C13.8156 3.75738 14 4.2025 14 4.66663V11.0833C14 11.5474 13.8156 11.9925 13.4874 12.3207C13.1592 12.6489 12.7141 12.8333 12.25 12.8333H1.75C1.28587 12.8333 0.840752 12.6489 0.512563 12.3207C0.184375 11.9925 0 11.5474 0 11.0833V4.66663C0 4.2025 0.184374 3.75738 0.512563 3.42919C0.840752 3.101 1.28587 2.91663 1.75 2.91663H3.77114L4.76464 1.42638ZM5.56219 2.33329L4.5687 3.82353C4.46051 3.98582 4.27837 4.08329 4.08333 4.08329H1.75C1.59529 4.08329 1.44692 4.14475 1.33752 4.25415C1.22812 4.36354 1.16667 4.51192 1.16667 4.66663V11.0833C1.16667 11.238 1.22812 11.3864 1.33752 11.4958C1.44692 11.6052 1.59529 11.6666 1.75 11.6666H12.25C12.4047 11.6666 12.5531 11.6052 12.6625 11.4958C12.7719 11.3864 12.8333 11.238 12.8333 11.0833V4.66663C12.8333 4.51192 12.7719 4.36354 12.6625 4.25415C12.5531 4.14475 12.4047 4.08329 12.25 4.08329H9.91667C9.72163 4.08329 9.53949 3.98582 9.4313 3.82353L8.43781 2.33329H5.56219Z"
                                                fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6.99992 5.83329C6.03342 5.83329 5.24992 6.61679 5.24992 7.58329C5.24992 8.54979 6.03342 9.33329 6.99992 9.33329C7.96642 9.33329 8.74992 8.54979 8.74992 7.58329C8.74992 6.61679 7.96642 5.83329 6.99992 5.83329ZM4.08325 7.58329C4.08325 5.97246 5.38909 4.66663 6.99992 4.66663C8.61075 4.66663 9.91659 5.97246 9.91659 7.58329C9.91659 9.19412 8.61075 10.5 6.99992 10.5C5.38909 10.5 4.08325 9.19412 4.08325 7.58329Z"
                                                fill="white" />
                                        </svg>
                                    </span>
                                    <span>Editar</span>
                                </label>
                            </div>
                        </div>
                    </form>

                    <!-- Modal de errores y éxito -->
                    <div id="errorModal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog"
                        aria-modal="true">
                        <!-- Fondo oscuro -->
                        <div class="fixed inset-0 bg-gray-900/50 dark:bg-gray-900/75 transition-opacity" aria-hidden="true">
                        </div>

                        <!-- Contenedor del modal -->
                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <!-- Panel del modal -->
                                <div
                                    class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <!-- Ícono de error o éxito -->
                                            <div id="modalIcon"
                                                class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/20 sm:mx-0 sm:size-10">
                                                <svg id="modalIconSvg" class="size-6 text-red-600 dark:text-red-500"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" aria-hidden="true" data-slot="icon">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                                </svg>
                                            </div>
                                            <!-- Contenido del modal -->
                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                <h3 id="modalTitle"
                                                    class="text-base font-semibold text-gray-900 dark:text-white">Error</h3>
                                                <div class="mt-2">
                                                    <p id="modalMessage" class="text-sm text-gray-500 dark:text-gray-400">
                                                        Hubo un problema al
                                                        actualizar la foto de portada.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Botón OK -->
                                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                        <button id="modalOkButton" type="button"
                                            class="inline-flex w-full justify-center rounded-md bg-red-600 dark:bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 dark:hover:bg-red-600 sm:ml-3 sm:w-auto">
                                            OK
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 pb-6 text-center lg:pb-8 xl:pb-11.5">
                        <form id="profilePhotoForm" action="{{ route('profile.update.photo') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div
                                class="relative z-30 mx-auto -mt-22 h-30 w-30 rounded-full bg-white/20 p-1 backdrop-blur sm:h-44 sm:w-44 sm:p-3">
                                <div class="relative h-full w-full rounded-full overflow-hidden">
                                    <img id="profilePhotoPreview"
                                        src="{{ auth()->user()->profile_photo ? asset('storage/profiles/' . auth()->user()->profile_photo) : './images/user/profile.png' }}"
                                        alt="profile" class="w-full h-full object-cover" />
                                </div>
                                <label for="profilePhotoInput"
                                    class="absolute bottom-0 right-0 flex h-8.5 w-8.5 cursor-pointer items-center justify-center rounded-full bg-primary text-white hover:bg-opacity-90 sm:bottom-2 sm:right-2">
                                    <svg class="fill-current" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.76464 1.42638C4.87283 1.2641 5.05496 1.16663 5.25 1.16663H8.75C8.94504 1.16663 9.12717 1.2641 9.23536 1.42638L10.2289 2.91663H12.25C12.7141 2.91663 13.1592 3.101 13.4874 3.42919C13.8156 3.75738 14 4.2025 14 4.66663V11.0833C14 11.5474 13.8156 11.9925 13.4874 12.3207C13.1592 12.6489 12.7141 12.8333 12.25 12.8333H1.75C1.28587 12.8333 0.840752 12.6489 0.512563 12.3207C0.184375 11.9925 0 11.5474 0 11.0833V4.66663C0 4.2025 0.184374 3.75738 0.512563 3.42919C0.840752 3.101 1.28587 2.91663 1.75 2.91663H3.77114L4.76464 1.42638ZM5.56219 2.33329L4.5687 3.82353C4.46051 3.98582 4.27837 4.08329 4.08333 4.08329H1.75C1.59529 4.08329 1.44692 4.14475 1.33752 4.25415C1.22812 4.36354 1.16667 4.51192 1.16667 4.66663V11.0833C1.16667 11.238 1.22812 11.3864 1.33752 11.4958C1.44692 11.6052 1.59529 11.6666 1.75 11.6666H12.25C12.4047 11.6666 12.5531 11.6052 12.6625 11.4958C12.7719 11.3864 12.8333 11.238 12.8333 11.0833V4.66663C12.8333 4.51192 12.7719 4.36354 12.6625 4.25415C12.5531 4.14475 12.4047 4.08329 12.25 4.08329H9.91667C9.72163 4.08329 9.53949 3.98582 9.4313 3.82353L8.43781 2.33329H5.56219Z"
                                            fill="" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.00004 5.83329C6.03354 5.83329 5.25004 6.61679 5.25004 7.58329C5.25004 8.54979 6.03354 9.33329 7.00004 9.33329C7.96654 9.33329 8.75004 8.54979 8.75004 7.58329C8.75004 6.61679 7.96654 5.83329 7.00004 5.83329ZM4.08337 7.58329C4.08337 5.97246 5.38921 4.66663 7.00004 4.66663C8.61087 4.66663 9.91671 5.97246 9.91671 7.58329C9.91671 9.19412 8.61087 10.5 7.00004 10.5C5.38921 10.5 4.08337 9.19412 4.08337 7.58329Z"
                                            fill="" />
                                    </svg>
                                    <input type="file" name="profile_photo" id="profilePhotoInput" class="sr-only" />
                                </label>
                            </div>
                        </form>

                        <div class="mt-4">
                            @auth
                                @php
                                    $user = Auth::user();
                                    $rol = $user->rol;
                                @endphp
                                <h3 class="mb-1.5 text-2xl font-medium text-black dark:text-white">
                                    {{ $user->name }}
                                </h3>
                                <p class="font-medium">{{ $rol->nombre_rol }}</p>
                            @endauth
                            <div
                                class="mx-auto mb-5.5 mt-4.5 grid max-w-94 grid-cols-3 rounded-md border border-stroke py-2.5 shadow-1 dark:border-strokedark dark:bg-[#37404F]">
                                <div
                                    class="flex flex-col items-center justify-center gap-1 border-r border-stroke px-4 dark:border-strokedark xsm:flex-row">
                                    <span class="font-semibold text-black dark:text-white">259</span>
                                    <span class="text-sm">Clientes</span>
                                </div>
                                <div
                                    class="flex flex-col items-center justify-center gap-1 border-r border-stroke px-4 dark:border-strokedark xsm:flex-row">
                                    <span class="font-semibold text-black dark:text-white">100</span>
                                    <span class="text-sm">Cobrados</span>
                                </div>
                                <div class="flex flex-col items-center justify-center gap-1 px-4 xsm:flex-row">
                                    <span class="font-semibold text-black dark:text-white">5K</span>
                                    <span class="text-sm">Total</span>
                                </div>
                            </div>

                            <div class="mx-auto max-w-180">
                                <h4 class="font-medium text-black dark:text-white">
                                    Acerca de mí
                                </h4>
                                <p class="mt-4.5 text-sm font-normal">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Pellentesque posuere fermentum urna, eu condimentum
                                    mauris tempus ut. Donec fermentum blandit aliquet. Etiam
                                    dictum dapibus ultricies. Sed vel aliquet libero. Nunc a
                                    augue fermentum, pharetra ligula sed, aliquam lacus.
                                </p>
                            </div>

                            <div class="mt-6.5">
                                <h4 class="mb-3.5 font-medium text-black dark:text-white">
                                    Mis redes
                                </h4>
                                <div class="flex items-center justify-center gap-3.5">
                                    <a href="#" class="hover:text-primary" name="social-icon"
                                        aria-label="Facebook">
                                        <i class="fab fa-facebook-square text-2xl"></i>
                                    </a>
                                    <a href="#" class="hover:text-primary" name="social-icon"
                                        aria-label="Twitter">
                                        <i class="fab fa-twitter-square text-2xl"></i>
                                    </a>
                                    <a href="#" class="hover:text-primary" name="social-icon"
                                        aria-label="Instagram">
                                        <i class="fab fa-instagram-square text-2xl"></i>
                                    </a>
                                    <a href="#" class="hover:text-primary" name="social-icon"
                                        aria-label="LinkedIn">
                                        <i class="fab fa-linkedin text-2xl"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- ====== Profile Section End -->
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

@endsection

@section('scripts')
    <!-- ===== Script Cover Photo Upload ===== -->
    <script>
        document.getElementById('coverPhotoInput').addEventListener('change', function() {
            const form = document.getElementById('coverPhotoForm');
            const modal = document.getElementById('errorModal');
            const modalIcon = document.getElementById('modalIcon');
            const modalIconSvg = document.getElementById('modalIconSvg');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const modalOkButton = document.getElementById('modalOkButton');

            @if (!auth()->user()->checkModuloAcceso('profile', 'actualizar'))

                modalTitle.textContent = 'Error';
                modalMessage.textContent = 'No tienes permisos para actualizar la foto de portada.';
                modalIcon.classList.replace('bg-green-100', 'bg-red-100');
                modalIconSvg.classList.replace('text-green-600', 'text-red-600');
                modalOkButton.classList.replace('bg-green-600', 'bg-red-600');
                modalOkButton.classList.replace('hover:bg-green-500', 'hover:bg-red-500');

                modal.classList.remove('hidden');
            @else

                const formData = new FormData(form);

                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                });

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => {
                                throw err;
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {

                            document.getElementById('coverPhotoPreview').src = data.cover_url;

                            modalTitle.textContent = 'Éxito';
                            modalMessage.textContent = 'Foto de portada actualizada correctamente.';
                            modalIcon.classList.replace('bg-red-100', 'bg-green-100');
                            modalIconSvg.classList.replace('text-red-600', 'text-green-600');
                            modalOkButton.classList.replace('bg-red-600', 'bg-green-600');
                            modalOkButton.classList.replace('hover:bg-red-500', 'hover:bg-green-500');
                        } else {

                            modalTitle.textContent = 'Error';
                            modalMessage.textContent = 'Error: ' + data.message;
                            modalIcon.classList.replace('bg-green-100', 'bg-red-100');
                            modalIconSvg.classList.replace('text-green-600', 'text-red-600');
                            modalOkButton.classList.replace('bg-green-600', 'bg-red-600');
                            modalOkButton.classList.replace('hover:bg-green-500', 'hover:bg-red-500');
                        }

                        modal.classList.remove('hidden');
                    })
                    .catch(error => {
                        modalTitle.textContent = 'Error';
                        modalMessage.textContent = 'Error: ' + (error.message ||
                            'No se pudo actualizar la foto de portada.');
                        modalIcon.classList.replace('bg-green-100', 'bg-red-100');
                        modalIconSvg.classList.replace('text-green-600', 'text-red-600');
                        modalOkButton.classList.replace('bg-green-600', 'bg-red-600');
                        modalOkButton.classList.replace('hover:bg-green-500', 'hover:bg-red-500');

                        modal.classList.remove('hidden');
                    });
            @endif

            modalOkButton.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>

    <!-- ===== Script Profile Photo Upload ===== -->
    <script>
        document.getElementById('profilePhotoInput').addEventListener('change', function() {
            const form = document.getElementById('profilePhotoForm');
            const modal = document.getElementById('errorModal');
            const modalIcon = document.getElementById('modalIcon');
            const modalIconSvg = document.getElementById('modalIconSvg');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const modalOkButton = document.getElementById('modalOkButton');

            // Verificar permisos antes de enviar el formulario
            @if (!auth()->user()->checkModuloAcceso('profile', 'actualizar'))
                modalTitle.textContent = 'Error';
                modalMessage.textContent = 'No tienes permisos para actualizar la foto de perfil.';
                modalIcon.classList.replace('bg-green-100', 'bg-red-100');
                modalIconSvg.classList.replace('text-green-600', 'text-red-600');
                modalOkButton.classList.replace('bg-green-600', 'bg-red-600');
                modalOkButton.classList.replace('hover:bg-green-500', 'hover:bg-red-500');

                modal.classList.remove('hidden');
            @else
                const formData = new FormData(form);

                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                });

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => {
                                throw err;
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            document.getElementById('profilePhotoPreview').src = data.photo_url;
                            modalTitle.textContent = 'Éxito';
                            modalMessage.textContent = 'Foto de perfil actualizada correctamente.';
                            modalIcon.classList.replace('bg-red-100', 'bg-green-100');
                            modalIconSvg.classList.replace('text-red-600', 'text-green-600');
                            modalOkButton.classList.replace('bg-red-600', 'bg-green-600');
                            modalOkButton.classList.replace('hover:bg-red-500', 'hover:bg-green-500');
                        } else {
                            modalTitle.textContent = 'Error';
                            modalMessage.textContent = 'Error: ' + data.message;
                            modalIcon.classList.replace('bg-green-100', 'bg-red-100');
                            modalIconSvg.classList.replace('text-green-600', 'text-red-600');
                            modalOkButton.classList.replace('bg-green-600', 'bg-red-600');
                            modalOkButton.classList.replace('hover:bg-green-500', 'hover:bg-red-500');
                        }
                        modal.classList.remove('hidden');
                    })
                    .catch(error => {
                        modalTitle.textContent = 'Error';
                        modalMessage.textContent = 'Error: ' + (error.message ||
                            'No se pudo actualizar la foto de perfil.');
                        modalIcon.classList.replace('bg-green-100', 'bg-red-100');
                        modalIconSvg.classList.replace('text-green-600', 'text-red-600');
                        modalOkButton.classList.replace('bg-green-600', 'bg-red-600');
                        modalOkButton.classList.replace('hover:bg-green-500', 'hover:bg-red-500');
                        modal.classList.remove('hidden');
                    });
            @endif

            modalOkButton.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
@endsection

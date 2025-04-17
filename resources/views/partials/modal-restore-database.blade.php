<!-- Modal Restaurar Base de Datos -->
<div id="modal-restore-database" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden py-20 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    @if (!auth()->user()->checkModuloAcceso('database', 'actualizar'))
        <!-- Toast de error -->
        <div id="modal-restore-database"
            class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div
                class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                </svg>
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">Sin permisos para esta acción.</div>
            <!-- Botón de cierre del toast y modal -->
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-modal-hide="modal-restore-database" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @else
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Configuración de Restauración
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="modal-restore-database">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="restoreForm" action="{{ route('database.restore') }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="backup_file"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                <i class="fas fa-file-upload me-2"></i>Seleccionar archivo de respaldo (.sql)
                            </label>
                            <input type="file" name="backup_file" id="backup_file"
                                accept=".sql,.txt,application/sql,text/plain,application/x-sql"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                required>
                        </div>

                        <div class="">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                                Datos de conexión
                            </h4>

                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="host"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            <i class="fas fa-server me-2"></i>Host
                                        </label>
                                        <input type="text" name="host" id="host" 
                                               value="{{ config('database.connections.mysql.host') }}"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                               required>
                                    </div>
                                    <div>
                                        <label for="port"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            <i class="fas fa-network-wired me-2"></i>Puerto
                                        </label>
                                        <input type="number" name="port" id="port" value="3306"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                            required>
                                    </div>
                                </div>
                                <div>
                                    <label for="database"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        <i class="fas fa-database me-2"></i>Base de Datos
                                    </label>
                                    <input type="text" name="database" id="database"
                                           value="{{ config('database.connections.mysql.database') }}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                           required>
                                </div>
                                <div>
                                    <label for="username"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        <i class="fas fa-user me-2"></i>Usuario
                                    </label>
                                    <input type="text" name="username" id="username"
                                           value="{{ config('database.connections.mysql.username') }}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                           required>
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        <i class="fas fa-key me-2"></i>Contraseña
                                    </label>
                                    <input type="password" name="password" id="password"
                                           value="{{ config('database.connections.mysql.password') }}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between space-x-3 border-t pt-4 mt-4">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <i class="fas fa-upload me-2"></i>
                            Restaurar
                        </button>
                        <button type="button" data-modal-hide="modal-restore-database"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

<!-- Modal de Éxito -->
<div id="modal-restore-success" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-xl dark:bg-gray-700">
            <!-- Contenido más simple y minimalista -->
            <div class="p-5">
                <div class="flex items-start space-x-4">
                    <!-- Icono de check más simple -->
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    <!-- Mensaje más simple -->
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Restauración completada
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Por seguridad, deberá iniciar sesión
                            nuevamente.</p>
                    </div>
                </div>

                <!-- Barra de progreso -->
                <div class="w-full bg-gray-100 rounded-full h-1.5 my-4 dark:bg-gray-600">
                    <div id="progress-bar" class="bg-green-500 h-1.5 rounded-full transition-all duration-500"
                        style="width: 0%">
                    </div>
                </div>

                <!-- Botón más simple -->
                <button id="btn-success-accept" type="button" disabled
                    class="w-full mt-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                    <div class="flex items-center justify-center">
                        <div class="progress-circle mr-2"></div>
                        <span>Procesando...</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Agregar este modal de error después de los otros modales -->
<div id="modal-restore-error" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-xl dark:bg-gray-700">
            <div class="p-5">
                <div class="flex items-start space-x-4">
                    <!-- Icono de error -->
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                    <!-- Mensaje de error -->
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Error de restauración</h3>
                        <p id="error-message" class="text-sm text-gray-500 dark:text-gray-400"></p>
                        <div id="error-details"
                            class="mt-3 text-sm text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-gray-800 p-3 rounded-lg hidden">
                        </div>
                    </div>
                </div>

                <!-- Botón para cerrar -->
                <button type="button" id="btn-error-close"
                    class="w-full mt-4 text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800 transition-all duration-300">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .progress-circle {
        width: 16px;
        height: 16px;
        border: 2px solid #ffffff;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const restoreForm = document.getElementById('restoreForm');
        const modalSuccess = document.getElementById('modal-restore-success');
        const btnSuccessAccept = document.getElementById('btn-success-accept');
        const progressBar = document.getElementById('progress-bar');
        const modalError = document.getElementById('modal-restore-error');
        const btnErrorClose = document.getElementById('btn-error-close');

        if (restoreForm) {
            restoreForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Obtener el botón de submit
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;

                // Mostrar animación de carga en el botón
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1.5"></i> Restaurando...';
                submitBtn.disabled = true;

                const formData = new FormData(this);

                fetch(this.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Cerrar modal de restauración
                            const modalRestore = document.getElementById('modal-restore-database');
                            modalRestore.classList.add('hidden');

                            // Mostrar modal de éxito
                            modalSuccess.classList.remove('hidden');
                            modalSuccess.classList.add('flex');

                            // Animar la barra de progreso
                            let progress = 0;
                            const interval = setInterval(() => {
                                progress += 2;
                                progressBar.style.width = `${progress}%`;

                                if (progress >= 100) {
                                    clearInterval(interval);
                                    // Habilitar botón después de completar la barra
                                    btnSuccessAccept.innerHTML =
                                        '<span class="inline-flex items-center">Aceptar <i class="fas fa-check ml-2"></i></span>';
                                    btnSuccessAccept.disabled = false;
                                    btnSuccessAccept.classList.remove('opacity-50',
                                        'cursor-not-allowed');
                                    btnSuccessAccept.classList.add('button-success');
                                }
                            }, 60);

                            // Disparar evento de actualización
                            const event = new CustomEvent('importacionCompletada', {
                                detail: {
                                    fecha: data.fecha
                                }
                            });
                            document.dispatchEvent(event);
                        } else {
                            throw new Error(data.message || 'Error desconocido');
                        }
                    })
                    .catch(error => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;

                        // Mostrar modal de error
                        const modalRestore = document.getElementById('modal-restore-database');
                        modalRestore.classList.add('hidden');

                        const errorMessage = document.getElementById('error-message');
                        const errorDetails = document.getElementById('error-details');

                        // Procesar los mensajes de error
                        let messages = [];
                        if (error.message.includes('\n')) {
                            messages = error.message.split('\n');
                        } else {
                            messages = [error.message];
                        }

                        // Mostrar el primer mensaje como mensaje principal
                        errorMessage.textContent = messages[0];

                        // Si hay más mensajes, mostrarlos en los detalles
                        if (messages.length > 1) {
                            errorDetails.innerHTML = messages.slice(1).map(msg => `• ${msg}`).join(
                                '<br>');
                            errorDetails.classList.remove('hidden');
                        } else {
                            errorDetails.classList.add('hidden');
                        }

                        modalError.classList.remove('hidden');
                        modalError.classList.add('flex');
                    });
            });
        }

        // Manejar cierre del modal
        if (btnSuccessAccept) {
            btnSuccessAccept.addEventListener('click', function() {
                window.location.href = '{{ route('login') }}';
            });
        }

        // Manejar cierre del modal de error
        if (btnErrorClose) {
            btnErrorClose.addEventListener('click', function() {
                modalError.classList.remove('flex');
                modalError.classList.add('hidden');

                // Mostrar nuevamente el modal de restauración
                const modalRestore = document.getElementById('modal-restore-database');
                modalRestore.classList.remove('hidden');
            });
        }
    });
</script>

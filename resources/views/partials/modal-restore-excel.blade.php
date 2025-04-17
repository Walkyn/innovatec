<!-- Main modal -->
<style>
    @keyframes fade-in-up {
        0% {
            opacity: 0;
            transform: translateY(10px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(-5%);
            animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
        }

        50% {
            transform: translateY(0);
            animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.5s ease-out forwards;
    }

    .animate-bounce {
        animation: bounce 1s infinite;
    }
</style>
<div id="modal-restore-excel" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed py-22 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    @if (!auth()->user()->checkModuloAcceso('database', 'actualizar'))
        <!-- Toast de error -->
        <div id="modal-restore-excel"
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
                data-modal-hide="modal-restore-excel" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @else
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Importar Excel
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="modal-restore-excel">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Alerts Item Warning -->
                <div id="warning-message" class="hidden">
                    <div
                        class="flex w-full border-l-6 border-[#D0915C] bg-[#D0915C] bg-opacity-[15%] px-7 py-4 shadow-md dark:bg-[#1F2937] dark:bg-opacity-30 md:p-4 animate-fade-in-up">
                        <div
                            class="mr-5 flex h-9 w-9 items-center justify-center rounded-lg bg-[#D0915C] bg-opacity-30">
                            <i class="fas fa-exclamation-triangle text-[#D0915C]"></i>
                        </div>
                        <div class="w-full">
                            <p id="warning-text" class="text-base dark:text-[#D0915C] pt-1 leading-relaxed text-body">
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Alerts Item Success -->
                <div id="success-message" class="hidden">
                    <div
                        class="flex w-full border-l-6 border-[#34D399] bg-[#34D399] bg-opacity-[15%] px-7 py-4 shadow-md dark:bg-[#1F2937] dark:bg-opacity-30 md:p-4 animate-fade-in-up">
                        <div
                            class="mr-5 flex h-9 w-9 items-center justify-center rounded-lg bg-[#34D399] bg-opacity-30">
                            <i class="fas fa-check-circle text-[#34D399]"></i>
                        </div>
                        <div class="w-full">
                            <p id="success-text" class="text-base dark:text-[#34D399] pt-1 leading-relaxed text-body">
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Alerts Item Error -->
                <div id="error-message" class="hidden">
                    <div
                        class="flex w-full border-l-6 border-[#F87171] bg-[#F87171] bg-opacity-[15%] px-7 py-4 shadow-md dark:bg-[#1F2937] dark:bg-opacity-30 md:p-4 animate-fade-in-up">
                        <div
                            class="mr-5 flex h-9 w-9 items-center justify-center rounded-lg bg-[#F87171] bg-opacity-30">
                            <i class="fas fa-times-circle text-[#F87171]"></i>
                        </div>
                        <div class="w-full">
                            <p id="error-text" class="text-base dark:text-[#F87171] pt-1 leading-relaxed text-body">
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Clientes Ignorados Section -->
                <div id="ignored-clients-section"
                    class="hidden p-4 md:p-4 border-t border-gray-200 dark:border-gray-600">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Clientes Ignorados</h4>
                    <div id="ignored-clients-list" class="max-h-60 overflow-y-auto">
                        <!-- La lista de clientes ignorados se insertará aquí -->
                    </div>
                </div>

                <!-- Modal body -->
                <div class="p-4 md:p-4">

                    <form action="{{ route('import.clientes') }}" method="POST" enctype="multipart/form-data"
                        class="bg-white" id="import-form">
                        @csrf
                        <div class="">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-30 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-800 dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500">
                                <div id="dropzone-content" class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400" id="file-name-display">
                                        <span class="font-semibold">Subir archivo</span>
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400" id="file-size-display">Peso
                                        máximo: 50MB</p>
                                </div>
                                <input id="dropzone-file" type="file" name="archivo" class="hidden"
                                    accept=".xlsx,.xls" required />
                            </label>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button id="import-button" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Importar</button>
                    <button id="close-modal" type="button" data-modal-hide="modal-restore-excel"
                        data-modal-target="modal-restore" data-modal-toggle="modal-restore"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Volver</button>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropzoneContent = document.getElementById('file-name-display');
        const fileSizeDisplay = document.getElementById('file-size-display');
        const warningMessage = document.getElementById('warning-message');
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');
        const importForm = document.getElementById('import-form');
        const importButton = document.getElementById('import-button');
        const fileInput = document.getElementById('dropzone-file');

        fileInput.addEventListener('change', function() {
            if (this.files.length) {
                const file = this.files[0];
                const fileSize = (file.size / (1024 * 1024)).toFixed(2); // Convertir a MB
                dropzoneContent.innerHTML =
                    `<span class="font-semibold">Archivo seleccionado:</span> ${file.name}`;
                fileSizeDisplay.innerHTML = `Peso del archivo: ${fileSize} MB`;
                warningMessage.classList.add('hidden');
            } else {
                dropzoneContent.innerHTML = `<span class="font-semibold">Subir archivo</span>`;
                fileSizeDisplay.innerHTML = 'Peso máximo: 50MB';
            }
        });

        function displayIgnoredClients(ignoredClients) {
            const ignoredSection = document.getElementById('ignored-clients-section');
            const ignoredList = document.getElementById('ignored-clients-list');

            if (ignoredClients && ignoredClients.length > 0) {
                // Agregar contador de clientes ignorados
                ignoredList.innerHTML = `
                    <div class="mb-4 p-2 bg-yellow-50 dark:bg-yellow-900 rounded">
                        <p class="text-sm text-yellow-800 dark:text-yellow-200">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Total de clientes ignorados: ${ignoredClients.length}
                        </p>
                    </div>
                `;

                // Agregar cada cliente ignorado
                ignoredList.innerHTML += ignoredClients.map(client => `
                    <div class="mb-2 p-3 bg-gray-50 dark:bg-gray-600 rounded border border-gray-200 dark:border-gray-500">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-slash text-gray-400 dark:text-gray-300"></i>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                    <strong>Hoja:</strong> ${client.hoja || 'No especificado'}<br>
                                    <strong>Fila:</strong> ${client.fila || 'No especificado'}<br>
                                    <strong>Cliente:</strong> ${client.nombre || 'No especificado'}<br>
                                    <strong>Razón:</strong> <span class="text-red-600 dark:text-red-400">${client.razon}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                `).join('');

                ignoredSection.classList.remove('hidden');
            } else {
                ignoredSection.classList.add('hidden');
            }
        }

        importButton.addEventListener('click', function(event) {
            event.preventDefault();

            if (!fileInput.files.length) {
                warningMessage.classList.remove('hidden');
                document.getElementById('warning-text').innerText =
                    "Por favor, seleccione un archivo antes de continuar.";
                return;
            }

            const formData = new FormData(importForm);

            // Ocultar todos los mensajes
            warningMessage.classList.add('hidden');
            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');
            document.getElementById('ignored-clients-section').classList.add('hidden');

            // Deshabilitar el botón durante la importación
            importButton.disabled = true;
            importButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Importando...';

            fetch(importForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Mostrar mensaje de éxito con el total de clientes importados
                        successMessage.classList.remove('hidden');
                        document.getElementById('success-text').innerText =
                            `Se importaron ${data.total_importados} clientes exitosamente.`;

                        // Mostrar clientes ignorados si existen
                        if (data.clientes_ignorados && data.clientes_ignorados.length > 0) {
                            displayIgnoredClients(data.clientes_ignorados);
                        }

                        // Limpiar el formulario
                        importForm.reset();
                        dropzoneContent.innerHTML =
                            `<span class="font-semibold">Subir archivo</span>`;
                        fileSizeDisplay.innerHTML = 'Peso máximo: 50MB';

                        // Disparar evento para actualizar la fecha en el modal principal
                        if (data.ultima_importacion) {
                            const event = new CustomEvent('importacionCompletada', {
                                detail: {
                                    fecha: data.ultima_importacion.fecha
                                }
                            });
                            document.dispatchEvent(event);
                        }
                    } else {
                        errorMessage.classList.remove('hidden');
                        document.getElementById('error-text').innerText = data.message;
                    }
                })
                .catch(error => {
                    errorMessage.classList.remove('hidden');
                    document.getElementById('error-text').innerText =
                        "Error al procesar la importación: " + error.message;
                })
                .finally(() => {
                    // Rehabilitar el botón
                    importButton.disabled = false;
                    importButton.innerHTML = 'Importar';
                });
        });
    });
</script>

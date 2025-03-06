<!-- Main modal -->
<div id="modal-restore-excel" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
            <div id="warning-message"
                class="flex w-full border-l-6 hidden border-warning bg-warning bg-opacity-[15%] px-7 py-4 shadow-md dark:bg-[#1B1B24] dark:bg-opacity-30 md:p-4">
                <div class="mr-5 flex h-9 w-9 items-center justify-center rounded-lg bg-warning bg-opacity-30">
                    <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                </div>
                <div class="w-full">
                    <p id="warning-text" class="pt-1 leading-relaxed text-[#D0915C]">
                    </p>
                </div>
            </div>

            <!-- Alerts Item Success -->
            <div id="success-message"
                class="flex w-full border-l-6 hidden border-[#34D399] bg-[#34D399] bg-opacity-[15%] px-7 py-4 shadow-md dark:bg-[#1B1B24] dark:bg-opacity-30 md:p-4">
                <div class="mr-5 flex h-9 w-9 items-center justify-center rounded-lg bg-[#34D399] bg-opacity-30">
                    <i class="fas fa-check-circle text-[#34D399]"></i>
                </div>
                <div class="w-full">
                    <p id="success-text" class="pt-1 leading-relaxed text-[#34D399]">
                    </p>
                </div>
            </div>

            <!-- Alerts Item Error -->
            <div id="error-message"
                class="flex w-full border-l-6 hidden border-[#F87171] bg-[#F87171] bg-opacity-[15%] px-7 py-4 shadow-md dark:bg-[#1B1B24] dark:bg-opacity-30 md:p-4">
                <div class="mr-5 flex h-9 w-9 items-center justify-center rounded-lg bg-[#F87171] bg-opacity-30">
                    <i class="fas fa-times-circle text-[#F87171]"></i>
                </div>
                <div class="w-full">
                    <p id="error-text" class="pt-1 leading-relaxed text-[#CD5D5D]">
                    </p>
                </div>
            </div>

            <!-- Modal body -->
            <div class="p-4 md:p-4">


                <form action="#" method="#" enctype="multipart/form-data" class="bg-white" id="import-form">

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
                                <p class="text-xs text-gray-500 dark:text-gray-400">Peso: 50mb</p>
                            </div>
                            <input id="dropzone-file" type="file" name="archivo" class="hidden" required />
                        </label>
                    </div>
                </form>

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button id="import-button" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Importar</button>
                <button data-modal-hide="modal-restore-excel" type="button" data-modal-target="modal-restore"
                    data-modal-toggle="modal-restore"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Volver</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('dropzone-file').addEventListener('change', function() {
        const dropzoneContent = document.getElementById('file-name-display');
        const warningMessage = document.getElementById('warning-message');

        if (this.files.length) {
            dropzoneContent.innerHTML =
                `<span class="font-semibold">Archivo seleccionado:</span> ${this.files[0].name}`;
            warningMessage.classList.add('hidden');
        } else {
            dropzoneContent.innerHTML = `<span class="font-semibold">Subir archivo</span>`;
        }
    });

    document.getElementById('import-button').addEventListener('click', function(event) {
        const fileInput = document.getElementById('dropzone-file');
        const warningMessage = document.getElementById('warning-message');

        if (!fileInput.files.length) {
            event.preventDefault();
            warningMessage.classList.remove('hidden');
            document.getElementById('warning-text').innerText =
                "Por favor, seleccione un archivo antes de continuar.";
        } else {
            warningMessage.classList.add('hidden');
        }
    });
</script>

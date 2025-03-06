<!-- Main modal -->
<div id="ver-contrato" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 py-20 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Ver Contrato
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="ver-contrato">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div id="ver-contrato" class="p-4 md:p-5 space-y-4">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <!-- Campo de Datos del Cliente -->
                    <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                        <label
                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                            Datos del Cliente
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <i class="fa fa-user text-gray-500 dark:text-gray-400"></i>
                            </div>
                            <input type="text" id="modal-input-cliente"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                disabled />
                        </div>
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label
                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                            Servicio
                        </label>
                        <div class="relative">
                            <select id="servicio-seleccionado"
                                class="block appearance-none w-full bg-gray-200 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-800">
                            </select>
                        </div>
                    </div>
                </div>

                <main class="h-full overflow-y-auto">
                    <div>
                        <div class="flex justify-start items-center mb-4">
                            <!-- Título -->
                            <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-300">
                                Detalle de Servicios
                            </h4>
                        </div>

                        <div class="w-full overflow-hidden rounded-lg shadow-xs">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full whitespace-no-wrap">
                                    <thead>
                                        <tr
                                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3">Item</th>
                                            <th class="px-4 py-3">Servicio</th>
                                            <th class="px-4 py-3">Plan</th>
                                            <th class="px-4 py-3">Fecha</th>
                                            <th class="px-4 py-3">Estado</th>
                                            <th class="px-4 py-3 text-right">Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalle-contrato"
                                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        <!-- Obtener datos -->
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                document.querySelectorAll(".open-modal").forEach(button => {
                                                    button.addEventListener("click", function() {
                                                        const cliente = this.getAttribute("data-cliente");
                                                        const servicios = this.getAttribute("data-servicios").split(",");
                                                        const detalles = JSON.parse(this.getAttribute("data-detalles"));

                                                        document.getElementById("modal-input-cliente").value = cliente;

                                                        const selectServicio = document.getElementById("servicio-seleccionado");
                                                        selectServicio.innerHTML = "";
                                                        servicios.forEach(servicio => {
                                                            let option = document.createElement("option");
                                                            option.textContent = servicio;
                                                            selectServicio.appendChild(option);
                                                        });

                                                        const tbody = document.querySelector("#detalle-contrato");
                                                        tbody.innerHTML = "";
                                                        let total = 0;

                                                        const estadoClase = {
                                                            "activo": "text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100",
                                                            "suspendido": "text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100"
                                                        };

                                                        detalles.forEach((detalle, index) => {
                                                            const precio = parseFloat(detalle.precio) || 0;
                                                            total += precio;

                                                            let estadoClaseAplicada = estadoClase[detalle.estado] ||
                                                                "text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100";

                                                            let row = document.createElement("tr");
                                                            row.innerHTML = `
                                                                <td class="px-4 py-3">${index + 1}</td>
                                                                <td class="px-4 py-3">${detalle.nombre}</td>
                                                                <td class="px-4 py-3 text-sm">${detalle.plan || "N/A"}</td>
                                                                <td class="px-4 py-3 text-sm">${detalle.fecha || "N/A"}</td>
                                                                <td class="px-4 py-3 text-xs">
                                                                    <span class="px-2 py-1 font-semibold leading-tight rounded-full ${estadoClaseAplicada}">
                                                                        ${detalle.estado.charAt(0).toUpperCase() + detalle.estado.slice(1)}
                                                                    </span>
                                                                </td>
                                                                <td class="px-4 py-3 text-sm text-right" style="white-space: nowrap;">
                                                                    S/ ${precio.toFixed(2)}
                                                                </td>
                                                            `;
                                                            tbody.appendChild(row);
                                                        });

                                                        document.getElementById("total-contrato").textContent =
                                                            `Total: S/ ${total.toFixed(2)}`;
                                                    });
                                                });
                                            });
                                        </script>
                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                                <span id="total-contrato"
                                    class="col-span-5 sm:col-span-4 sm:col-start-6 flex justify-end text-right text-sm font-semibold text-gray-600 dark:text-gray-400">
                                    Total: $ 0.00
                                </span>
                            </div>
                        </div>
                    </div>
                </main>

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="ver-contrato" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    OK</button>
            </div>
        </div>
    </div>
</div>

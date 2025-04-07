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

                    <!-- ====== Datos del Cliente Section Start -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <!-- Campo de Datos del Cliente -->
                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="ver-modal-input-cliente">
                                Datos del Cliente
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <i class="fa fa-user text-gray-500 dark:text-gray-400"></i>
                                </div>
                                <input type="text" id="ver-modal-input-cliente" value=""
                                    class="border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full ps-10 p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    readonly disabled />
                            </div>
                        </div>

                        <!-- Campo de Identificación -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2"
                                for="ver-client-identification">
                                Identificación
                            </label>
                            <div class="relative">
                                <input type="text" id="ver-client-identification" value=""
                                    class="border border-gray-100 text-gray-900 text-sm rounded focus:ring-0 focus:border-gray-300 block w-full p-3 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    readonly disabled />
                            </div>
                        </div>
                    </div>
                    <!-- ====== Datos del Cliente Section End -->
                <div class="flex flex-wrap -mx-3">


                    <div class="w-full px-3">
                        <label
                            class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2">
                            Observaciones
                        </label>
                        <div class="relative">
                            <div class="absolute top-2.5 left-2 flex items-start ps-1 pointer-events-none">
                                <i class="fa fa-align-left text-gray-500 dark:text-gray-400"></i>
                            </div>
                            <textarea id="ver-input-observaciones" name="ver-input-observaciones" rows="3"
                                class="block p-2.5 w-full text-sm border border-gray-100 text-gray-900 rounded border focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500 pl-8 resize-none"
                                disabled></textarea>
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
                                            <th class="px-4 py-3">IP</th>
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
                                                console.log("DOMContentLoaded - Modal Ver Contrato");
                                                document.querySelectorAll(".open-modal").forEach(button => {
                                                    console.log("Botón encontrado:", button);
                                                    button.addEventListener("click", function() {
                                                        console.log("Click en botón open-modal");
                                                        const cliente = this.getAttribute("data-cliente");
                                                        const identificacion = this.getAttribute("data-identificacion");
                                                        const servicios = this.getAttribute("data-servicios").split(",");
                                                        const detalles = JSON.parse(this.getAttribute("data-detalles"));
                                                        const observaciones = this.getAttribute("data-observaciones");

                                                        console.log("Datos recibidos:", {
                                                            cliente: cliente,
                                                            identificacion: identificacion,
                                                            servicios: servicios,
                                                            observaciones: observaciones,
                                                            detalles: detalles
                                                        });

                                                        document.getElementById("ver-modal-input-cliente").value = cliente;
                                                        document.getElementById("ver-client-identification").value = identificacion;
                                                        document.getElementById("ver-input-observaciones").value = observaciones || '';

                                                        console.log("Valores asignados a los campos:", {
                                                            "ver-modal-input-cliente": document.getElementById("ver-modal-input-cliente").value,
                                                            "ver-client-identification": document.getElementById("ver-client-identification").value,
                                                            "ver-input-observaciones": document.getElementById("ver-input-observaciones").value
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
                                                            const ipCell = document.createElement("td");
                                                            ipCell.className = "px-4 py-3 text-sm";

                                                            if (detalle.ip_servicio) {
                                                                const ipLink = document.createElement("a");
                                                                ipLink.href = `http://${detalle.ip_servicio}`;
                                                                ipLink.target = "_blank";
                                                                ipLink.className = "text-blue-500 hover:underline";
                                                                ipLink.textContent = detalle.ip_servicio;
                                                                ipLink.onclick = function(e) {
                                                                    e.preventDefault();
                                                                    window.open(`http://${detalle.ip_servicio}`, '_blank');
                                                                    showToast(detalle.ip_servicio);
                                                                };
                                                                ipCell.appendChild(ipLink);
                                                            } else {
                                                                ipCell.textContent = 'N/A';
                                                            }

                                                            row.innerHTML = `
                                                                <td class="px-4 py-3">${index + 1}</td>
                                                                <td class="px-4 py-3">${detalle.nombre}</td>
                                                                <td class="px-4 py-3 text-sm">${detalle.plan || "N/A"}</td>
                                                                <td class="px-4 py-3 text-sm"></td>
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

                                                            // Reemplazar el td vacío con el td que contiene el enlace
                                                            row.children[3].replaceWith(ipCell);

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

<script>
    // Definir la variable global si no existe
    if (typeof window.pendingToast === 'undefined') {
        window.pendingToast = null;
    }

    function showToast(ip) {
        // Guardar la IP para mostrar el toast cuando regrese
        window.pendingToast = ip;
        
        // Abrir la IP en una nueva ventana
        window.open(`http://${ip}`, '_blank');
        
        // Agregar evento focus a la ventana
        window.addEventListener('focus', function showToastOnFocus() {
            if (window.pendingToast) {
                const currentIp = window.pendingToast; // Guardar la IP actual
                
                // Intentar hacer una petición HEAD a la IP
                fetch(`http://${currentIp}`, {
                    method: 'HEAD',
                    mode: 'no-cors'
                })
                .then(() => {
                    // Si la IP responde, mostrar toast de éxito
                    const toast = document.createElement('div');
                    toast.className = 'fixed bottom-4 right-4 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800 transform translate-y-full opacity-0 transition-all duration-300 z-50';
                    toast.innerHTML = `
                        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="sr-only">Check icon</span>
                        </div>
                        <div class="ms-3 text-sm font-normal">Conexión exitosa con ${currentIp}</div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" onclick="this.parentElement.remove()">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    `;
                    document.body.appendChild(toast);
                    
                    // Animar entrada
                    setTimeout(() => {
                        toast.classList.remove('translate-y-full', 'opacity-0');
                    }, 100);
                    
                    // Animar salida y eliminar
                    setTimeout(() => {
                        toast.classList.add('translate-y-full', 'opacity-0');
                        setTimeout(() => {
                            document.body.removeChild(toast);
                        }, 300);
                    }, 5000);
                })
                .catch(() => {
                    // Si la IP no responde, mostrar toast de error
                    const toast = document.createElement('div');
                    toast.className = 'fixed bottom-4 right-4 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800 transform translate-y-full opacity-0 transition-all duration-300 z-50';
                    toast.innerHTML = `
                        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                            </svg>
                            <span class="sr-only">Error icon</span>
                        </div>
                        <div class="ms-3 text-sm font-normal">No se pudo establecer conexión con ${currentIp}</div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" onclick="this.parentElement.remove()">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    `;
                    document.body.appendChild(toast);
                    
                    // Animar entrada
                    setTimeout(() => {
                        toast.classList.remove('translate-y-full', 'opacity-0');
                    }, 100);
                    
                    // Animar salida y eliminar
                    setTimeout(() => {
                        toast.classList.add('translate-y-full', 'opacity-0');
                        setTimeout(() => {
                            document.body.removeChild(toast);
                        }, 300);
                    }, 5000);
                });

                // Limpiar el toast pendiente y remover el evento después de mostrar el mensaje
                setTimeout(() => {
                    window.pendingToast = null;
                    window.removeEventListener('focus', showToastOnFocus);
                }, 5000);
            }
        });
    }
</script>

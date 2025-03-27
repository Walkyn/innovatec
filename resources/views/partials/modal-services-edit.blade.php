<!-- Modal for listing categories and services -->
<div id="list-services-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="modalServicesTitle">Servicios</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="list-services-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div class="relative mb-4">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i class="fas fa-search w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                    </div>
                    <input type="text" id="searchInput"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar categoría o servicio" />
                </div>
                <!-- Categories list with nested services -->
                <ul id="categoryList" class="divide-y divide-gray-200 dark:divide-gray-700 max-h-96 overflow-y-auto">
                    @foreach ($categorias as $categoria)
                        <li class="category-item" data-category-id="{{ $categoria->id }}">
                            <div class="flex items-center justify-between p-0 text-sm text-gray-700 dark:text-gray-200">
                                <div class="flex items-center justify-between w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rounded">
                                    <button type="button" class="cursor-pointer p-2 w-full rounded text-left category-toggle"
                                        onclick="toggleServices({{ $categoria->id }}, this)">
                                        <div class="flex items-center justify-between w-full">
                                            <span>{{ $categoria->nombre }}</span>
                                            <i class="fas fa-chevron-down text-xs ml-2 transition-transform duration-200"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <!-- Services container (hidden by default) -->
                            <ul id="services-{{ $categoria->id }}" class="services-list pl-6 hidden divide-y divide-gray-200 dark:divide-gray-700">
                                <!-- Services will be loaded here dynamically -->
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing service -->
<div id="edit-service-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Modificar Servicio</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="edit-service-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="edit-service-form" method="POST" class="p-4 md:p-5">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-service-id">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="edit-service-nombre"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del
                            Servicio</label>
                        <input type="text" name="nombre" id="edit-service-nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="text-white flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fas fa-check text-sm"></i> Actualizar
                    </button>
                    <button type="button" data-modal-toggle="edit-service-modal"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Volver
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success/Error message modal -->
<div id="messageModal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 dark:bg-gray-900/75 transition-opacity" aria-hidden="true"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div id="modalIcon"
                            class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/20 sm:mx-0 sm:size-10">
                            <svg id="modalIconSvg" class="size-6 text-red-600 dark:text-red-500" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 id="modalTitle" class="text-base font-semibold text-gray-900 dark:text-white">Error
                            </h3>
                            <div class="mt-2">
                                <p id="modalMessage" class="text-sm text-gray-500 dark:text-gray-400"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button id="modalOkButton" type="button"
                        class="inline-flex w-full justify-center rounded-md bg-green-600 dark:bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 dark:hover:bg-green-600 sm:ml-3 sm:w-auto">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Track currently open category
    let currentlyOpenCategory = null;

    async function toggleServices(categoriaId, buttonElement) {
        const servicesList = document.getElementById(`services-${categoriaId}`);
        const icon = buttonElement.querySelector('i');

        if (currentlyOpenCategory && currentlyOpenCategory !== categoriaId) {
            const prevList = document.getElementById(`services-${currentlyOpenCategory}`);
            const prevButton = document.querySelector(`[onclick="toggleServices(${currentlyOpenCategory}, this)"]`);
            const prevIcon = prevButton?.querySelector('i');
            
            if (prevList && !prevList.classList.contains('hidden')) {
                await animateCollapse(prevList);
                prevList.classList.add('hidden');
                if (prevIcon) {
                    prevIcon.classList.replace('fa-chevron-up', 'fa-chevron-down');
                }
            }
        }

        // Toggle current category
        if (servicesList.classList.contains('hidden')) {
            if (servicesList.children.length === 0) {
                await loadServices(categoriaId, servicesList);
            }
            servicesList.classList.remove('hidden');
            await animateExpand(servicesList);
            icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
            currentlyOpenCategory = categoriaId;
        } else {
            await animateCollapse(servicesList);
            servicesList.classList.add('hidden');
            icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
            currentlyOpenCategory = null;
        }
    }

    // Animation functions
    async function animateExpand(element) {
        element.style.maxHeight = '0';
        element.style.overflow = 'hidden';
        element.style.transition = 'max-height 0.3s ease-out';
        
        // Trigger reflow
        await new Promise(resolve => requestAnimationFrame(resolve));
        
        element.style.maxHeight = `${element.scrollHeight}px`;
        
        await new Promise(resolve => setTimeout(resolve, 300));
        element.style.maxHeight = '';
        element.style.overflow = '';
        element.style.transition = '';
    }

    async function animateCollapse(element) {
        element.style.maxHeight = `${element.scrollHeight}px`;
        element.style.overflow = 'hidden';
        element.style.transition = 'max-height 0.3s ease-out';
        
        // Trigger reflow
        await new Promise(resolve => requestAnimationFrame(resolve));
        
        element.style.maxHeight = '0';
        
        await new Promise(resolve => setTimeout(resolve, 300));
    }

    // Function to load services for a category
    async function loadServices(categoriaId, servicesContainer) {
        try {
            const response = await fetch(`/categorias/${categoriaId}/servicios`);
            if (!response.ok) {
                throw new Error('Error al cargar los servicios');
            }
            const servicios = await response.json();

            servicesContainer.innerHTML = servicios.map(servicio => `
                <li class="flex items-center justify-between py-2 text-sm text-gray-700 dark:text-gray-200">
                    <div class="flex items-center justify-between w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rounded">
                        <button type="button" class="cursor-pointer p-2 w-full rounded text-left"
                            onclick="setEditFormData(${servicio.id}, '${servicio.nombre.replace(/'/g, "\\'")}')">
                            ${servicio.nombre}
                        </button>
                        <button type="button" 
                            onclick="confirmDeleteService(${servicio.id})"
                            class="text-red-600 hover:text-red-800 dark:text-red-500 pl-4 pr-2 dark:hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </li>
            `).join('');
        } catch (error) {
            console.error('Error:', error);
            showMessageModal(false, 'Hubo un error al cargar los servicios.');
        }
    }

    // Update search
    document.getElementById('searchInput').addEventListener('input', async function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const categoryItems = document.querySelectorAll('#categoryList .category-item');

        for (const item of categoryItems) {
            const categoryName = item.querySelector('.category-toggle').textContent.toLowerCase();
            const servicesList = item.querySelector('.services-list');
            let hasVisibleServices = false;

            if (servicesList) {
                const isExpanded = !servicesList.classList.contains('hidden');
                const serviceItems = servicesList.querySelectorAll('li');
                let serviceVisible = false;
                
                for (const service of serviceItems) {
                    const serviceName = service.textContent.toLowerCase();
                    if (serviceName.includes(searchTerm)) {
                        service.style.display = 'flex';
                        serviceVisible = true;
                        hasVisibleServices = true;
                    } else {
                        service.style.display = 'none';
                    }
                }

                if (!serviceVisible && categoryName.includes(searchTerm)) {
                    hasVisibleServices = true;
                }

                if (searchTerm.length > 0 && hasVisibleServices && isExpanded) {
                    await animateCollapse(servicesList);
                    servicesList.classList.add('hidden');
                    const icon = item.querySelector('.category-toggle i');
                    if (icon) icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
                }
            }

            if (categoryName.includes(searchTerm) || hasVisibleServices) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        }
    });

    // Function to set edit form data
    function setEditFormData(id, nombre) {
        document.getElementById('edit-service-id').value = id;
        document.getElementById('edit-service-nombre').value = nombre;

        const listModalEl = document.getElementById('list-services-modal');
        const editModalEl = document.getElementById('edit-service-modal');

        const listModal = new Modal(listModalEl);
        const editModal = new Modal(editModalEl);

        listModal.hide();
        editModal.show();
    }

    // Function to confirm service deletion
    async function confirmDeleteService(serviceId) {
        const result = await Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción eliminará el servicio permanentemente",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "No, cancelar",
            reverseButtons: true,
            customClass: {
                confirmButton: "bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-400",
                cancelButton: "bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400",
                actions: "flex justify-center gap-4"
            },
            buttonsStyling: false
        });

        if (result.isConfirmed) {
            try {
                const response = await fetch(`/servicios/${serviceId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    throw new Error(data.message || 'Error al eliminar el servicio');
                }

                await Swal.fire({
                    title: "¡Eliminado!",
                    text: data.message || "El servicio ha sido eliminado.",
                    icon: "success",
                    customClass: {
                        confirmButton: "bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-400"
                    },
                    buttonsStyling: false
                });

                location.reload();

            } catch (error) {
                console.error('Error al eliminar el servicio:', error);
                Swal.fire({
                    title: "Error",
                    text: error.message || "Hubo un problema al eliminar el servicio.",
                    icon: "error",
                    customClass: {
                        confirmButton: "bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400"
                    },
                    buttonsStyling: false
                });
            }
        }
    }

    // Set up edit form
    document.getElementById('edit-service-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const id = document.getElementById('edit-service-id').value;
        const nombre = document.getElementById('edit-service-nombre').value;

        try {
            const response = await fetch(`/servicios/${id}/update`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    nombre: nombre
                }),
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Error al actualizar el servicio');
            }

            if (data.success) {
                showMessageModal(true, data.message, true);

                const editModal = new Modal(document.getElementById('edit-service-modal'));
                editModal.hide();

            } else {
                throw new Error(data.message || 'Error al actualizar el servicio');
            }

        } catch (error) {
            console.error('Error:', error);
            showMessageModal(false, error.message || 'Hubo un error al actualizar el servicio.');
        }
    });

    function showMessageModal(isSuccess, message, shouldReload = false) {
        const modal = document.getElementById('messageModal');
        const icon = document.getElementById('modalIcon');
        const iconSvg = document.getElementById('modalIconSvg');
        const title = document.getElementById('modalTitle');
        const msg = document.getElementById('modalMessage');

        if (isSuccess) {
            icon.classList.remove('bg-red-100', 'dark:bg-red-900/20');
            icon.classList.add('bg-green-100', 'dark:bg-green-900/20');
            iconSvg.classList.remove('text-red-600', 'dark:text-red-500');
            iconSvg.classList.add('text-green-600', 'dark:text-green-500');
            title.textContent = 'Éxito';
        } else {
            icon.classList.remove('bg-green-100', 'dark:bg-green-900/20');
            icon.classList.add('bg-red-100', 'dark:bg-red-900/20');
            iconSvg.classList.remove('text-green-600', 'dark:text-green-500');
            iconSvg.classList.add('text-red-600', 'dark:text-red-500');
            title.textContent = 'Error';
        }

        msg.textContent = message;

        const messageModal = new Modal(modal);
        messageModal.show();

        const okButton = document.getElementById('modalOkButton');
        okButton.onclick = function() {
            messageModal.hide();
            if (isSuccess && shouldReload) {
                location.reload();
            }
        };
    }

    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const categoryItems = document.querySelectorAll('#categoryList .category-item');

        categoryItems.forEach(item => {
            const categoryName = item.querySelector('.category-toggle').textContent.toLowerCase();
            const servicesList = item.querySelector('.services-list');
            let hasVisibleServices = false;

            if (servicesList && !servicesList.classList.contains('hidden')) {
                const serviceItems = servicesList.querySelectorAll('li');
                let serviceVisible = false;
                
                serviceItems.forEach(service => {
                    const serviceName = service.textContent.toLowerCase();
                    if (serviceName.includes(searchTerm)) {
                        service.style.display = 'flex';
                        serviceVisible = true;
                        hasVisibleServices = true;
                    } else {
                        service.style.display = 'none';
                    }
                });

                if (!serviceVisible && categoryName.includes(searchTerm)) {
                    hasVisibleServices = true;
                }
            }
            
            if (categoryName.includes(searchTerm) || hasVisibleServices) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Make functions available globally
    window.toggleServices = toggleServices;
    window.loadServices = loadServices;
    window.setEditFormData = setEditFormData;
    window.confirmDeleteService = confirmDeleteService;
</script>
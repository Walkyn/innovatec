<!-- Modal for listing categories, services and plans -->
<div id="list-plans-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="modalPlansTitle">Planes por Servicio</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="list-plans-modal">
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
                    <input type="text" id="searchPlansInput"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar categoría, servicio o plan" />
                </div>
                <ul id="plans-categoryList" class="divide-y divide-gray-200 dark:divide-gray-700 max-h-96 overflow-y-auto">
                    @foreach ($categorias as $categoria)
                        <li class="plans-category-item" data-category-id="{{ $categoria->id }}">
                            <div class="flex items-center justify-between p-0 text-sm text-gray-700 dark:text-gray-200">
                                <div class="flex items-center justify-between w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rounded">
                                    <button type="button" class="cursor-pointer p-2 w-full rounded text-left plans-category-toggle"
                                        onclick="togglePlansServices({{ $categoria->id }}, this)">
                                        <div class="flex items-center justify-between w-full">
                                            <span>{{ $categoria->nombre }}</span>
                                            <i class="fas fa-chevron-down text-xs ml-2 transition-transform duration-200"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <ul id="plans-services-{{ $categoria->id }}" class="plans-services-list pl-6 hidden divide-y divide-gray-200 dark:divide-gray-700">
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing plan -->
<div id="edit-plan-modal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static" data-modal-target="edit-plan-modal"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 py-20 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Modificar Plan</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="edit-plan-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="edit-plan-form" method="POST" class="p-4 md:p-5">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-plan-id">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="edit-plan-nombre"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre del Plan</label>
                        <input type="text" name="nombre" id="edit-plan-nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                    </div>
                    <div class="col-span-2">
                        <label for="edit-plan-precio"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                        <input type="number" step="0.01" name="precio" id="edit-plan-precio"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit"
                        class="text-white flex items-center justify-center gap-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <i class="fas fa-check text-sm"></i> Actualizar
                    </button>
                    <button type="button" data-modal-hide="edit-plan-modal" data-modal-toggle="list-plans-modal" data-modal-toggle="list-plans-modal"
                        class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Volver
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let openPlansCategoryId = null;
    let openPlansServiceId = null;

    async function togglePlansServices(categoriaId, buttonElement) {
        const servicesList = document.getElementById(`plans-services-${categoriaId}`);
        const icon = buttonElement.querySelector('i');

        if (openPlansCategoryId && openPlansCategoryId !== categoriaId) {
            const prevList = document.getElementById(`plans-services-${openPlansCategoryId}`);
            const prevButton = document.querySelector(`[onclick="togglePlansServices(${openPlansCategoryId}, this)"]`);
            const prevIcon = prevButton?.querySelector('i');
            
            if (prevList && !prevList.classList.contains('hidden')) {
                await animateCollapse(prevList);
                prevList.classList.add('hidden');
                if (prevIcon) {
                    prevIcon.classList.replace('fa-chevron-up', 'fa-chevron-down');
                }
            }
        }

        if (servicesList.classList.contains('hidden')) {
            try {
                const response = await fetch(`/categorias/${categoriaId}/servicios`);
                if (!response.ok) throw new Error('Error al cargar servicios');
                
                const servicios = await response.json();
                servicesList.innerHTML = servicios.map(servicio => `
                    <li class="plans-service-item" data-service-id="${servicio.id}">
                        <div class="flex items-center justify-between p-0 text-sm text-gray-700 dark:text-gray-200">
                            <div class="flex items-center justify-between w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white rounded">
                                <button type="button" class="cursor-pointer p-2 w-full rounded text-left plans-service-toggle"
                                    onclick="togglePlansList(${servicio.id}, this)">
                                    <div class="flex items-center justify-between w-full">
                                        <span>${servicio.nombre}</span>
                                        <i class="fas fa-chevron-down text-xs ml-2 transition-transform duration-200"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <!-- Plans container -->
                        <ul id="plans-list-${servicio.id}" class="plans-list-container pl-6 hidden divide-y divide-gray-200 dark:divide-gray-700"></ul>
                    </li>
                `).join('');
                
                servicesList.classList.remove('hidden');
                await animateExpand(servicesList);
                icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
                openPlansCategoryId = categoriaId;
            } catch (error) {
                console.error('Error:', error);
                showPlansMessageModal(false, 'Error al cargar servicios');
            }
        } else {
            await animateCollapse(servicesList);
            servicesList.classList.add('hidden');
            icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
            openPlansCategoryId = null;
        }
    }

    async function togglePlansList(servicioId, buttonElement) {
        const plansList = document.getElementById(`plans-list-${servicioId}`);
        const icon = buttonElement.querySelector('i');

        if (openPlansServiceId && openPlansServiceId !== servicioId) {
            const prevList = document.getElementById(`plans-list-${openPlansServiceId}`);
            const prevButton = document.querySelector(`[onclick="togglePlansList(${openPlansServiceId}, this)"]`);
            const prevIcon = prevButton?.querySelector('i');
            
            if (prevList && !prevList.classList.contains('hidden')) {
                await animateCollapse(prevList);
                prevList.classList.add('hidden');
                if (prevIcon) {
                    prevIcon.classList.replace('fa-chevron-up', 'fa-chevron-down');
                }
            }
        }

        if (plansList.classList.contains('hidden')) {
            try {
                const response = await fetch(`/servicios/${servicioId}/planes`);
                if (!response.ok) throw new Error('Error al cargar planes');
                
                const planes = await response.json();
                plansList.innerHTML = planes.map(plan => {
                    const precio = parseFloat(plan.precio) || 0;
                    const precioFormateado = precio.toFixed ? precio.toFixed(2) : '0.00';
                    
                    return `
                        <li class="flex items-center justify-between py-2 px-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 rounded">
                            <div class="flex items-center justify-between w-full">
                                <div>
                                    <span class="font-medium">${plan.nombre}</span>
                                    <span class="text-gray-500 dark:text-gray-400 ml-2">- $${precioFormateado}</span>
                                </div>
                                <div class="flex gap-2">
                                    <button type="button" 
                                        onclick="setEditPlanFormData(${plan.id}, '${plan.nombre.replace(/'/g, "\\'")}', ${precio})"
                                        class="text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" 
                                        onclick="confirmDeletePlan(${plan.id})"
                                        class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                    `;
                }).join('');
                
                plansList.classList.remove('hidden');
                await animateExpand(plansList);
                icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
                openPlansServiceId = servicioId;
            } catch (error) {
                console.error('Error:', error);
                showPlansMessageModal(false, 'Error al cargar planes');
            }
        } else {
            await animateCollapse(plansList);
            plansList.classList.add('hidden');
            icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
            openPlansServiceId = null;
        }
    }

    // Function to set edit plan form data
    function setEditPlanFormData(id, nombre, precio) {
        document.getElementById('edit-plan-id').value = id;
        document.getElementById('edit-plan-nombre').value = nombre;
        document.getElementById('edit-plan-precio').value = precio;

        const listModalEl = document.getElementById('list-plans-modal');
        const editModalEl = document.getElementById('edit-plan-modal');

        const listModal = new Modal(listModalEl);
        const editModal = new Modal(editModalEl);

        listModal.hide();
        editModal.show();
    }

    // Function to confirm plan deletion
    async function confirmDeletePlan(planId) {
        const result = await Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción eliminará el plan permanentemente",
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
                const response = await fetch(`/planes/${planId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    throw new Error(data.message || 'Error al eliminar el plan');
                }

                await Swal.fire({
                    title: "¡Eliminado!",
                    text: data.message || "El plan ha sido eliminado.",
                    icon: "success",
                    customClass: {
                        confirmButton: "bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-400"
                    },
                    buttonsStyling: false
                });

                location.reload();

            } catch (error) {
                console.error('Error al eliminar el plan:', error);
                Swal.fire({
                    title: "Error",
                    text: error.message || "Hubo un problema al eliminar el plan.",
                    icon: "error",
                    customClass: {
                        confirmButton: "bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400"
                    },
                    buttonsStyling: false
                });
            }
        }
    }

    // Set up edit plan form
    document.getElementById('edit-plan-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const id = document.getElementById('edit-plan-id').value;
        const nombre = document.getElementById('edit-plan-nombre').value;
        const precio = document.getElementById('edit-plan-precio').value;

        try {
            const response = await fetch(`/planes/${id}/update`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    nombre: nombre,
                    precio: precio
                }),
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Error al actualizar el plan');
            }

            if (data.success) {
                showPlansMessageModal(true, data.message, true);
                const editModal = new Modal(document.getElementById('edit-plan-modal'));
                editModal.hide();
            } else {
                throw new Error(data.message || 'Error al actualizar el plan');
            }

        } catch (error) {
            console.error('Error:', error);
            showPlansMessageModal(false, error.message || 'Hubo un error al actualizar el plan.');
        }
    });

    // Search functionality for plans modal
    document.getElementById('searchPlansInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const categoryItems = document.querySelectorAll('#plans-categoryList .plans-category-item');

        categoryItems.forEach(item => {
            const categoryName = item.querySelector('.plans-category-toggle').textContent.toLowerCase();
            const servicesList = item.querySelector('.plans-services-list');
            let hasVisibleContent = false;

            if (servicesList) {
                const serviceItems = servicesList.querySelectorAll('.plans-service-item');
                let serviceVisible = false;
                
                serviceItems.forEach(service => {
                    const serviceName = service.querySelector('.plans-service-toggle').textContent.toLowerCase();
                    const plansList = service.querySelector('.plans-list-container');
                    let planVisible = false;

                    if (plansList && !plansList.classList.contains('hidden')) {
                        const planItems = plansList.querySelectorAll('li');
                        
                        planItems.forEach(plan => {
                            const planText = plan.textContent.toLowerCase();
                            if (planText.includes(searchTerm)) {
                                plan.style.display = 'flex';
                                planVisible = true;
                                hasVisibleContent = true;
                            } else {
                                plan.style.display = 'none';
                            }
                        });
                    }

                    if (serviceName.includes(searchTerm) || planVisible) {
                        service.style.display = 'block';
                        serviceVisible = true;
                        hasVisibleContent = true;
                    } else {
                        service.style.display = 'none';
                    }
                });

                if (!serviceVisible && categoryName.includes(searchTerm)) {
                    hasVisibleContent = true;
                }
            }
            
            if (categoryName.includes(searchTerm) || hasVisibleContent) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Show message modal function for plans
    function showPlansMessageModal(isSuccess, message, shouldReload = false) {
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

    // Animation functions
    async function animateExpand(element) {
        element.style.maxHeight = '0';
        element.style.overflow = 'hidden';
        element.style.transition = 'max-height 0.3s ease-out';
        
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
        
        await new Promise(resolve => requestAnimationFrame(resolve));
        element.style.maxHeight = '0';
        
        await new Promise(resolve => setTimeout(resolve, 300));
    }

    // Make functions available globally
    window.togglePlansServices = togglePlansServices;
    window.togglePlansList = togglePlansList;
    window.setEditPlanFormData = setEditPlanFormData;
    window.confirmDeletePlan = confirmDeletePlan;
</script>
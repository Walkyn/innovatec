<div class="fixed top-0 py-24 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
    id="eventModal">
    <!-- Fondo oscuro -->
    <div class="fixed inset-0 bg-gray-400/50 backdrop-blur modal-close-btn"></div>

    <!-- Contenedor del modal -->
    <div class="relative w-full max-w-[700px] mx-auto bg-white rounded-3xl shadow-lg dark:bg-gray-900 p-6 lg:p-11">
        <!-- Botón de cierre -->
        <button
            class="modal-close-btn transition-color absolute right-5 top-5 z-999 flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300 sm:h-11 sm:w-11">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z"
                    fill="" />
            </svg>
        </button>

        <!-- Contenido del modal -->
        <div class="flex flex-col px-2 overflow-y-auto modal-content custom-scrollbar">
            <div class="modal-header">
                <h5 class="mb-2 font-semibold text-gray-800 modal-title text-theme-xl dark:text-white/90 lg:text-2xl"
                    id="eventModalLabel">
                    Agregar / Editar Evento de Soporte
                </h5>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Programa o edita actividades de soporte técnico para mantener el seguimiento
                </p>
            </div>
            
            <form id="eventoForm" method="POST" action="/calendario/eventos">
                @csrf
                <input type="hidden" name="_method" id="eventoMethod" value="POST">
                <input type="hidden" name="evento_id" id="eventoId" value="">
                
                <div class="mt-8 modal-body">
                    <div>
                        <div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Título del Evento
                                </label>
                                <input id="event-title" name="titulo" type="text" required
                                    class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                            </div>
                        </div>
                        
                        <!-- Campo de Descripción (NUEVO) -->
                        <div class="mt-6">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Descripción
                                </label>
                                <textarea id="event-description" name="descripcion" rows="3"
                                    class="dark:bg-dark-900 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                                    placeholder="Detalles adicionales sobre este evento..."></textarea>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <div>
                                <label class="block mb-4 text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Estado del Soporte
                                </label>
                            </div>
                            
                            <!-- Contenedor de opciones de estado -->
                            <div class="flex flex-wrap gap-4 items-center">
                                <!-- Pendiente (Rojo) -->
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <div class="relative">
                                        <input type="radio" name="estado" value="pendiente" id="modalPendiente" class="peer sr-only" checked />
                                        <div class="w-5 h-5 border-2 border-red-500 rounded-full"></div>
                                        <div class="absolute hidden w-3 h-3 bg-red-500 rounded-full top-1 left-1 peer-checked:block"></div>
                                    </div>
                                    <span class="text-sm text-red-600 dark:text-red-400">Pendiente</span>
                                </label>
                                
                                <!-- Visitar (Naranja) -->
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <div class="relative">
                                        <input type="radio" name="estado" value="visitar" id="modalVisitar" class="peer sr-only" />
                                        <div class="w-5 h-5 border-2 border-yellow-500 rounded-full"></div>
                                        <div class="absolute hidden w-3 h-3 bg-yellow-500 rounded-full top-1 left-1 peer-checked:block"></div>
                                    </div>
                                    <span class="text-sm text-yellow-600 dark:text-yellow-400">Visitar</span>
                                </label>
                                
                                <!-- Solucionado (Verde) -->
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <div class="relative">
                                        <input type="radio" name="estado" value="solucionado" id="modalSolucionado" class="peer sr-only" />
                                        <div class="w-5 h-5 border-2 border-green-500 rounded-full"></div>
                                        <div class="absolute hidden w-3 h-3 bg-green-500 rounded-full top-1 left-1 peer-checked:block"></div>
                                    </div>
                                    <span class="text-sm text-green-600 dark:text-green-400">Solucionado</span>
                                </label>
                                
                                <!-- Para Cobrar (Azul) -->
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <div class="relative">
                                        <input type="radio" name="estado" value="cobrar" id="modalCobrar" class="peer sr-only" />
                                        <div class="w-5 h-5 border-2 border-blue-500 rounded-full"></div>
                                        <div class="absolute hidden w-3 h-3 bg-blue-500 rounded-full top-1 left-1 peer-checked:block"></div>
                                    </div>
                                    <span class="text-sm text-blue-600 dark:text-blue-400">Para Cobrar</span>
                                </label>
                            </div>
                        </div>

                        <div class="mt-6">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Fecha de Inicio
                                </label>
                                <div class="relative">
                                    <input id="event-start-date" name="fecha_inicio" type="date" required
                                        class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                                        onclick="this.showPicker()" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Fecha de Finalización
                                </label>
                                <div class="relative">
                                    <input id="event-end-date" name="fecha_fin" type="date"
                                        class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pl-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                                        onclick="this.showPicker()" />
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="todo_dia" value="1">
                    </div>
                </div>
                <div class="flex items-center gap-3 mt-6 modal-footer sm:justify-end">
                    <button type="button"
                        class="btn modal-close-btn bg-danger-subtle text-danger flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                        Cerrar
                    </button>
                    <button type="button" id="update-btn"
                        class="btn btn-success btn-update-event flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                        Actualizar Cambios
                    </button>
                    <button type="button" id="add-btn"
                        class="btn btn-primary btn-add-event flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                        Agregar Evento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Éxito -->
<div class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
    id="successModal">
    <!-- Fondo oscuro -->
    <div class="fixed inset-0 bg-gray-400/50 backdrop-blur"></div>

    <!-- Contenedor del modal de éxito -->
    <div class="relative w-full max-w-md mx-auto mt-32 bg-white rounded-3xl shadow-lg dark:bg-gray-900 p-6">
        <div class="text-center">
            <!-- Icono de Éxito -->
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                <svg class="h-10 w-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <!-- Título del Modal -->
            <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2" id="successModalTitle">
                ¡Operación Exitosa!
            </h3>
            
            <!-- Mensaje del Modal -->
            <div class="mt-4 mb-6">
                <p class="text-sm text-gray-500 dark:text-gray-400" id="successModalMessage">
                    El evento ha sido guardado correctamente en el calendario.
                </p>
            </div>
            
            <!-- Botón para Cerrar el Modal -->
            <div class="mt-5">
                <button type="button" id="closeSuccessModal"
                    class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:w-auto sm:text-sm">
                    Entendido
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('eventoForm');
    const updateBtn = document.getElementById('update-btn');
    const addBtn = document.getElementById('add-btn');
    const successModal = document.getElementById('successModal');
    const successModalTitle = document.getElementById('successModalTitle');
    const successModalMessage = document.getElementById('successModalMessage');
    const closeSuccessModal = document.getElementById('closeSuccessModal');
    
    // Función para mostrar el modal de éxito
    function showSuccessModal(title, message) {
        successModalTitle.textContent = title;
        successModalMessage.textContent = message;
        successModal.classList.remove('hidden');
        
        // Eliminamos el temporizador automático para que solo se cierre cuando el usuario haga clic
    }
    
    // Cerrar el modal de éxito al hacer clic en el botón
    closeSuccessModal.addEventListener('click', function() {
        successModal.classList.add('hidden');
        window.location.reload(); // Recarga solo cuando el usuario hace clic en "Entendido"
    });
    
    // Procesar la creación de un nuevo evento
    addBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Validaciones básicas
        const title = document.getElementById('event-title').value;
        const startDate = document.getElementById('event-start-date').value;
        
        if (!title) {
            alert('Por favor ingrese un título para el evento');
            return;
        }
        
        if (!startDate) {
            alert('Por favor seleccione una fecha de inicio');
            return;
        }
        
        // Asegurar que la fecha de fin tenga valor
        const fechaFin = document.getElementById('event-end-date');
        if (!fechaFin.value) {
            fechaFin.value = startDate;
        }
        
        // Preparar los datos para enviar
        const formData = new FormData(form);
        
        // Enviar mediante fetch
        fetch('/calendario/eventos', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log('Respuesta:', data);
            if (data.success) {
                // Cerrar el modal de evento
                document.getElementById('eventModal').style.display = 'none';
                
                // Mostrar modal de éxito
                showSuccessModal('¡Evento Creado!', 'El evento ha sido agregado correctamente al calendario.');
                
                // Limpiar el formulario
                form.reset();
            } else {
                alert('Error: ' + (data.message || 'No se pudo guardar el evento'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al guardar el evento: ' + error.message);
        });
    });
    
    // Actualizar un evento existente
    updateBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        const eventoId = document.getElementById('eventoId').value;
        
        // Validaciones básicas
        const title = document.getElementById('event-title').value;
        const startDate = document.getElementById('event-start-date').value;
        
        if (!title) {
            alert('Por favor ingrese un título para el evento');
            return;
        }
        
        if (!startDate) {
            alert('Por favor seleccione una fecha de inicio');
            return;
        }
        
        // Asegurar que la fecha de fin tenga valor
        const fechaFin = document.getElementById('event-end-date');
        if (!fechaFin.value) {
            fechaFin.value = startDate;
        }
        
        // Preparar los datos para enviar
        const formData = new FormData(form);
        formData.append('_method', 'PUT'); // Para simular PUT
        
        // Enviar mediante fetch
        fetch(`/calendario/eventos/${eventoId}`, {
            method: 'POST', // Usando POST con _method=PUT
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log('Respuesta actualización:', data);
            if (data.success) {
                // Cerrar el modal de evento
                document.getElementById('eventModal').style.display = 'none';
                
                // Mostrar modal de éxito
                showSuccessModal('¡Evento Actualizado!', 'El evento ha sido actualizado correctamente en el calendario.');
                
                // Limpiar el formulario
                form.reset();
            } else {
                alert('Error: ' + (data.message || 'No se pudo actualizar el evento'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al actualizar el evento: ' + error.message);
        });
    });
});
</script>

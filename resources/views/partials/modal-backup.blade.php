  <!-- Main modal -->
  <div id="modal-backup" tabindex="-1" aria-hidden="true" data-modal-backdrop="static" data-modal-target="modal-backup"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Realizar Copia de Seguridad
                  </h3>
                  <button type="button"
                      class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                      data-modal-toggle="modal-backup">
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
                  <ol class="relative border-s border-gray-200 dark:border-gray-600 ms-3.5 mb-4 md:mb-5">
                      <li class="mb-10 ms-8">
                          <span
                              class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -start-3.5 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                              <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                  <path fill="currentColor"
                                      d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z" />
                              </svg>
                          </span>
                          <h3 class="flex items-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                              Base de Datos
                          </h3>
                          <time
                              class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">
                              Ultima copia
                              <span id="ultima-copia-fecha">
                                  @php
                                      $ultimaExportacion = App\Models\ExportLogDB::ultimaExportacion('database');
                                      $fecha = 'Sin copias de seguridad';
                                      
                                      if ($ultimaExportacion) {
                                          setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain.1252');
                                          $fecha = strtolower(
                                              \Carbon\Carbon::parse($ultimaExportacion->created_at)
                                                  ->locale('es')
                                                  ->isoFormat('D [de] MMMM [del] YYYY [a las] H:mm')
                                          );
                                      }
                                  @endphp
                                  {{ $fecha }}
                              </span>
                          </time>
                          <button
                              type="button"
                              onclick="realizarBackup()"
                              class="py-2 px-3 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 {{ !auth()->user()->checkModuloAcceso('database', 'guardar') ? 'opacity-50 cursor-not-allowed' : '' }}"
                              {{ !auth()->user()->checkModuloAcceso('database', 'guardar') ? 'disabled' : '' }}>
                              <i class="fas fa-database me-1.5"></i>
                              Backup
                          </button>

                      </li>

                      <li class="mb-4 ms-8">
                          <span
                              class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -start-3.5 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                              <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                  <path fill="currentColor"
                                      d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z" />
                              </svg>
                          </span>
                          <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Exportar archivo Excel
                          </h3>
                          <time
                              class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">
                              Última exportación <span id="ultima-exportacion-fecha">
                                  @php
                                      $ultimaExportacion = App\Models\ExportLogExcel::ultimaExportacion('excel');
                                      $fecha = 'Sin exportaciones';
                                      
                                      if ($ultimaExportacion) {
                                          setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain.1252');
                                          $fecha = strtolower(
                                              \Carbon\Carbon::parse($ultimaExportacion->created_at)
                                                  ->locale('es')
                                                  ->isoFormat('D [de] MMMM [del] YYYY [a las] H:mm')
                                          );
                                      }
                                  @endphp
                                  {{ $fecha }}
                              </span>
                          </time>
                          <button type="button"
                              onclick="exportarExcel()"
                              class="py-2 px-3 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 {{ !auth()->user()->checkModuloAcceso('database', 'guardar') ? 'opacity-50 cursor-not-allowed' : '' }}"
                              {{ !auth()->user()->checkModuloAcceso('database', 'guardar') ? 'disabled' : '' }}>
                              <i class="fa fa-file-excel w-3 h-3 me-1.5" aria-hidden="true"></i>
                              Exportar
                          </button>

                      </li>
                  </ol>
              </div>
          </div>
      </div>
  </div>

<script>
    document.addEventListener('exportacionCompletada', function(e) {
        const fechaExportacion = e.detail.fecha;
        const fecha = new Date(fechaExportacion);
        
        const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
        const dia = fecha.getDate();
        const mes = meses[fecha.getMonth()];
        const anio = fecha.getFullYear();
        const hora = fecha.getHours().toString().padStart(2, '0');
        const minutos = fecha.getMinutes().toString().padStart(2, '0');
        
        const fechaFormateada = `${dia} de ${mes} del ${anio} a las ${hora}:${minutos}`;
        document.getElementById('ultima-exportacion-fecha').textContent = fechaFormateada;
    });

    function realizarBackup() {
        // Obtener el botón y guardar su estado original
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        const originalClasses = button.className;
        
        // Agregar clase de transición si no la tiene
        if (!button.classList.contains('transition-all')) {
            button.classList.add('transition-all', 'duration-300');
        }
        
        // Mostrar indicador de carga
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-1.5"></i> Exportando...';
        button.disabled = true;

        // Realizar la petición AJAX
        fetch('{{ route("backup.database") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                button.innerHTML = '<i class="fas fa-check me-1.5"></i> Exportación exitosa';
                button.classList.add('text-green-700', 'bg-green-50', 'hover:bg-green-100', 'hover:text-green-700', 'border-green-200');
                
                // Actualizar la fecha del último backup con el nuevo formato
                const fecha = new Date();
                const dia = fecha.getDate();
                const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
                const mes = meses[fecha.getMonth()];
                const anio = fecha.getFullYear();
                const hora = fecha.getHours().toString().padStart(2, '0');
                const minutos = fecha.getMinutes().toString().padStart(2, '0');
                
                const fechaFormateada = `${dia} de ${mes} del ${anio} a las ${hora}:${minutos}`;
                document.getElementById('ultima-copia-fecha').textContent = fechaFormateada;
                
                // Recargar la página después de 2 segundos
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                throw new Error(data.message);
            }
        })
        .catch(error => {
            // Mostrar error en el botón
            button.innerHTML = '<i class="fas fa-times me-1.5"></i> Error al exportar';
            button.classList.add('text-red-700', 'bg-red-50', 'hover:bg-red-100', 'hover:text-red-700', 'border-red-200');
            
            // Restaurar el botón después de 3 segundos
            setTimeout(() => {
                button.innerHTML = originalText;
                button.className = originalClasses + ' transition-all duration-300';
                button.disabled = false;
            }, 3000);
        });
    }

    function exportarExcel() {
        // Obtener el botón y guardar su estado original
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        const originalClasses = button.className;
        
        // Agregar clase de transición
        if (!button.classList.contains('transition-all')) {
            button.classList.add('transition-all', 'duration-300');
        }
        
        // Mostrar indicador de carga con animación
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-1.5"></i> Exportando...';
        button.disabled = true;
        button.classList.add('animate-pulse');

        // Mostrar mensaje de éxito después de un momento
        setTimeout(() => {
            button.classList.remove('animate-pulse');
            button.innerHTML = '<i class="fas fa-check me-1.5"></i> Exportación exitosa';
            button.classList.add('text-green-700', 'bg-green-50', 'hover:bg-green-100', 'hover:text-green-700', 'border-green-200');
            
            // Actualizar la fecha
            const fecha = new Date();
            const dia = fecha.getDate();
            const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
            const mes = meses[fecha.getMonth()];
            const anio = fecha.getFullYear();
            const hora = fecha.getHours().toString().padStart(2, '0');
            const minutos = fecha.getMinutes().toString().padStart(2, '0');
            
            const fechaFormateada = `${dia} de ${mes} del ${anio} a las ${hora}:${minutos}`;
            document.getElementById('ultima-exportacion-fecha').textContent = fechaFormateada;

            // Iniciar la descarga después del mensaje de éxito (0.1 segundos)
            setTimeout(() => {
                const downloadLink = document.createElement('a');
                downloadLink.href = '{{ route("exportar.clientes") }}';
                downloadLink.style.display = 'none';
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }, 100); // Cambiado de 500 a 100 (0.1 segundos)

            // Restaurar el botón después de mostrar el éxito
            setTimeout(() => {
                button.innerHTML = originalText;
                button.className = originalClasses + ' transition-all duration-300';
                button.disabled = false;
            }, 2000);
        }, 1000);
    }
</script>
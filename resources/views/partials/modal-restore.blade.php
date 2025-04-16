  <!-- Main modal -->
  <div id="modal-restore" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Restaurar Copia de Seguridad
                  </h3>
                  <button type="button"
                      class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                      data-modal-toggle="modal-restore">
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
                          <time class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">
                              Última restauración: 
                              @php
                                  $ultimaRestauracion = DB::table('database_restore_logs')
                                      ->where('success', true)
                                      ->latest()
                                      ->first();
                                  
                                  $fecha = 'Sin restauraciones';
                                  
                                  if ($ultimaRestauracion) {
                                      setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain.1252');
                                      $fecha = ucfirst(\Carbon\Carbon::parse($ultimaRestauracion->created_at)->locale('es')->isoFormat('D [de] MMMM [del] YYYY [a las] H:mm'));
                                  }
                              @endphp
                              {{ $fecha }}
                          </time>
                          <button type="button"
                              data-modal-target="modal-restore-database"
                              data-modal-toggle="modal-restore-database"
                              data-modal-hide="modal-restore"
                              class="py-2 px-3 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                              <i class="fas fa-database me-1.5"></i>
                              Restaurar
                          </button>

                      </li>

                      <li class="mb-10 ms-8">
                          <span
                              class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 rounded-full -start-3.5 ring-8 ring-white dark:ring-gray-700 dark:bg-gray-600">
                              <svg class="w-2.5 h-2.5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                  <path fill="currentColor"
                                      d="M6 1a1 1 0 0 0-2 0h2ZM4 4a1 1 0 0 0 2 0H4Zm7-3a1 1 0 1 0-2 0h2ZM9 4a1 1 0 1 0 2 0H9Zm7-3a1 1 0 1 0-2 0h2Zm-2 3a1 1 0 1 0 2 0h-2ZM1 6a1 1 0 0 0 0 2V6Zm18 2a1 1 0 1 0 0-2v2ZM5 11v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 11v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM10 15v-1H9v1h1Zm0 .01H9v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 15v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM15 11v-1h-1v1h1Zm0 .01h-1v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM5 15v-1H4v1h1Zm0 .01H4v1h1v-1Zm.01 0v1h1v-1h-1Zm0-.01h1v-1h-1v1ZM2 4h16V2H2v2Zm16 0h2a2 2 0 0 0-2-2v2Zm0 0v14h2V4h-2Zm0 14v2a2 2 0 0 0 2-2h-2Zm0 0H2v2h16v-2ZM2 18H0a2 2 0 0 0 2 2v-2Zm0 0V4H0v14h2ZM2 4V2a2 2 0 0 0-2 2h2Zm2-3v3h2V1H4Zm5 0v3h2V1H9Zm5 0v3h2V1h-2ZM1 8h18V6H1v2Zm3 3v.01h2V11H4Zm1 1.01h.01v-2H5v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H5v2h.01v-2ZM9 11v.01h2V11H9Zm1 1.01h.01v-2H10v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM9 15v.01h2V15H9Zm1 1.01h.01v-2H10v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H10v2h.01v-2ZM14 15v.01h2V15h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM14 11v.01h2V11h-2Zm1 1.01h.01v-2H15v2Zm1.01-1V11h-2v.01h2Zm-1-1.01H15v2h.01v-2ZM4 15v.01h2V15H4Zm1 1.01h.01v-2H5v2Zm1.01-1V15h-2v.01h2Zm-1-1.01H5v2h.01v-2Z" />
                              </svg>
                          </span>
                          <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Importar archivo Excel
                          </h3>
                          <time
                              class="block mb-3 text-sm font-normal leading-none text-gray-500 dark:text-gray-400">
                              Última importación: <span id="ultima-importacion-fecha">
                                @php
                                    $ultimaImportacion = App\Models\ImportLog::ultimaImportacion('excel');
                                    $fecha = 'Sin importaciones';
                                    
                                    if ($ultimaImportacion) {
                                        setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain.1252');
                                        $fecha = ucfirst(\Carbon\Carbon::parse($ultimaImportacion->created_at)->locale('es')->isoFormat('D [de] MMMM [del] YYYY [a las] H:mm'));
                                    }
                                @endphp
                                {{ $fecha }}
                              </span>
                          </time>
                          <button data-modal-target="modal-restore-excel"
                              data-modal-toggle="modal-restore-excel"
                              data-modal-hide="modal-restore"
                              type="button"
                              class="py-2 px-3 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                              <i class="fa fa-file-excel w-3 h-3 me-1.5" aria-hidden="true"></i>
                              Importar
                          </button>

                      </li>
                  </ol>
                  <button type="button"
                      data-modal-target="modal-plantilla-excel"
                      data-modal-toggle="modal-plantilla-excel"
                      data-modal-hide="modal-restore"
                      class="text-white inline-flex items-center justify-center w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                      <i class="fas fa-eye mx-2"></i>
                      Ver plantilla Excel
                  </button>
              </div>
          </div>
      </div>
  </div>

  <script>
      // Actualizar el script para formatear la fecha cuando se recibe una nueva importación
      document.addEventListener('importacionCompletada', function(e) {
          const fechaImportacion = e.detail.fecha;
          const fecha = new Date(fechaImportacion);
          
          const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
          const dia = fecha.getDate();
          const mes = meses[fecha.getMonth()];
          const anio = fecha.getFullYear();
          const hora = fecha.getHours().toString().padStart(2, '0');
          const minutos = fecha.getMinutes().toString().padStart(2, '0');
          
          const fechaFormateada = `${dia} de ${mes} del ${anio} a las ${hora}:${minutos}`;
          document.getElementById('ultima-importacion-fecha').textContent = fechaFormateada;
      });
  </script>

  <!-- Modal Vista Previa Excel -->
  <div id="modal-plantilla-excel" tabindex="-1" aria-hidden="true" data-modal-backdrop="static"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-4xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Plantilla Excel - Formato Requerido
                  </h3>
                  <button type="button"
                      class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                      data-modal-hide="modal-plantilla-excel">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                      </svg>
                      <span class="sr-only">Cerrar modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5 space-y-4">
                  <div class="overflow-x-auto">
                      <table class="w-full text-sm text-left">
                          <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700">
                              <tr>
                                  <th scope="col" class="px-6 py-3 font-medium text-gray-900 dark:text-white border dark:border-gray-600">
                                      APELLIDOS Y NOMBRES
                                  </th>
                                  <th scope="col" class="px-6 py-3 font-medium text-gray-900 dark:text-white border dark:border-gray-600">
                                      DNI
                                  </th>
                                  <th scope="col" class="px-6 py-3 font-medium text-gray-900 dark:text-white border dark:border-gray-600">
                                      DIRECCION O REFERENCIA
                                  </th>
                                  <th scope="col" class="px-6 py-3 font-medium text-gray-900 dark:text-white border dark:border-gray-600">
                                      PLAN CONTRATADO
                                  </th>
                                  <th scope="col" class="px-6 py-3 font-medium text-gray-900 dark:text-white border dark:border-gray-600">
                                      FECHA DE INST.
                                  </th>
                                  <th scope="col" class="px-6 py-3 font-medium text-gray-900 dark:text-white border dark:border-gray-600">
                                      N° CELULAR
                                  </th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr class="bg-white dark:bg-gray-800">
                                  <td class="px-6 py-4 border dark:border-gray-600">JUAN PÉREZ GONZÁLEZ</td>
                                  <td class="px-6 py-4 border dark:border-gray-600">12345678</td>
                                  <td class="px-6 py-4 border dark:border-gray-600">AV. LOS JAZMINES 123</td>
                                  <td class="px-6 py-4 border dark:border-gray-600">PLAN 100MB</td>
                                  <td class="px-6 py-4 border dark:border-gray-600">15/01/2024</td>
                                  <td class="px-6 py-4 border dark:border-gray-600">987654321</td>
                              </tr>
                              <tr class="bg-white dark:bg-gray-800">
                                  <td class="px-6 py-4 border dark:border-gray-600">MARÍA LÓPEZ SÁNCHEZ</td>
                                  <td class="px-6 py-4 border dark:border-gray-600">87654321</td>
                                  <td class="px-6 py-4 border dark:border-gray-600">JR. LAS ORQUÍDEAS 456</td>
                                  <td class="px-6 py-4 border dark:border-gray-600">PLAN 200MB</td>
                                  <td class="px-6 py-4 border dark:border-gray-600">20/01/2024</td>
                                  <td class="px-6 py-4 border dark:border-gray-600">912345678</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                  <div class="mt-4">
                      <p class="text-sm text-gray-500 dark:text-gray-400">
                          <i class="fas fa-info-circle mr-2"></i>
                          Este es el formato requerido para importar clientes. Asegúrese de que su archivo Excel siga exactamente esta estructura.
                      </p>
                  </div>
              </div>
              <!-- Modal footer -->
              <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                  <a href="{{ route('descargar.plantilla.excel') }}" 
                     class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-3">
                      <i class="fas fa-download mr-2"></i>
                      Descargar plantilla
                  </a>
                  <button type="button"
                      data-modal-target="modal-restore"
                      data-modal-toggle="modal-restore"
                      class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                      data-modal-hide="modal-plantilla-excel">
                      <i class="fas fa-arrow-left mr-2"></i>
                      Volver
                  </button>
              </div>
          </div>
      </div>
  </div>

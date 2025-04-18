<div
  class="col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:col-span-12"
>
  <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
    <div class="flex w-full flex-wrap gap-3 sm:gap-5">
      <div class="flex min-w-47.5">
        <span
          class="mr-2 mt-1 flex h-4 w-full max-w-4 items-center justify-center rounded-full border border-primary"
        >
          <span
            class="block h-2.5 w-full max-w-2.5 rounded-full bg-primary"
          ></span>
        </span>
        <div class="w-full">
          <p class="font-semibold text-primary">Clientes Cobrados</p>
          <p class="text-sm font-medium clientes-cobrados">{{ $clientesCobrados }} clientes</p>
        </div>
      </div>
      <div class="flex min-w-47.5">
        <span
          class="mr-2 mt-1 flex h-4 w-full max-w-4 items-center justify-center rounded-full border border-secondary"
        >
          <span
            class="block h-2.5 w-full max-w-2.5 rounded-full bg-secondary"
          ></span>
        </span>
        <div class="w-full">
          <p class="font-semibold text-secondary">Total Cobros</p>
          <p class="text-sm font-medium total-cobrado">S/. {{ number_format($totalCobrado, 2) }}</p>
        </div>
      </div>
    </div>
    <div class="flex w-full max-w-45 justify-end">
      <div
        class="inline-flex items-center rounded-md bg-whiter p-1.5 dark:bg-meta-4"
      >
        <button
          type="button"
          data-periodo="dia"
          class="periodo-btn rounded px-3 py-1 text-xs font-medium text-black hover:bg-white hover:shadow-card dark:text-white dark:hover:bg-boxdark {{ $periodo == 'dia' ? 'bg-white shadow-card dark:bg-boxdark' : '' }}"
        >
          Día
        </button>
        <button
          type="button"
          data-periodo="semana"
          class="periodo-btn rounded px-3 py-1 text-xs font-medium text-black hover:bg-white hover:shadow-card dark:text-white dark:hover:bg-boxdark {{ $periodo == 'semana' ? 'bg-white shadow-card dark:bg-boxdark' : '' }}"
        >
          Semana
        </button>
        <button
          type="button"
          data-periodo="mes"
          class="periodo-btn rounded px-3 py-1 text-xs font-medium text-black hover:bg-white hover:shadow-card dark:text-white dark:hover:bg-boxdark {{ $periodo == 'mes' ? 'bg-white shadow-card dark:bg-boxdark' : '' }}"
        >
          Mes
        </button>
      </div>
    </div>
  </div>
  <div>
    <div id="chartOne" class="-ml-5"></div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const botonesPeriodo = document.querySelectorAll('.periodo-btn');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    botonesPeriodo.forEach(boton => {
        boton.addEventListener('click', async function() {
            // Remover clase activa de todos los botones
            botonesPeriodo.forEach(b => {
                b.classList.remove('bg-white', 'shadow-card', 'dark:bg-boxdark');
            });
            
            // Agregar clase activa al botón clickeado
            this.classList.add('bg-white', 'shadow-card', 'dark:bg-boxdark');
            
            try {
                const periodo = this.getAttribute('data-periodo');
                const response = await fetch(`/obtener-datos-periodo?periodo=${periodo}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    credentials: 'same-origin'
                });

                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }

                const data = await response.json();
                
                // Actualizar los valores en la vista
                const clientesCobradosElement = document.querySelector('.clientes-cobrados');
                const totalCobradoElement = document.querySelector('.total-cobrado');

                if (clientesCobradosElement && totalCobradoElement) {
                    clientesCobradosElement.textContent = `${data.clientesCobrados} clientes`;
                    totalCobradoElement.textContent = `S/. ${data.totalCobrado}`;
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Hubo un error al obtener los datos');
            }
        });
    });
});
</script>

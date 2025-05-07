@extends('layouts.app')
@section('title', 'Business Manager - Calendario')

@section('content')
    @php
        // Función auxiliar para capitalizar la primera letra de los meses
        function mesCapitalizado($fecha, $formato = 'F') {
            return ucfirst($fecha->locale('es')->translatedFormat($formato));
        }
    @endphp

    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <div class="mx-auto max-w-full">
                <!-- Breadcrumb Start -->
                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-title-md2 font-bold text-black dark:text-white">
                        Calendario
                    </h2>

                    <nav>
                        <ol class="flex items-center gap-2">
                            <li>
                                <a class="font-medium" href="{{ route('home.index') }}">Panel /</a>
                            </li>
                            <li class="text-primary">Calendario</li>
                        </ol>
                    </nav>
                </div>
                <!-- Breadcrumb End -->

                <!-- ====== Calendar Section Start -->
                @include('partials.calendar-event-modal')

                <!-- Encabezado con botones -->
                <div class="mb-6 flex flex-col gap-y-4 sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-title-lg2 font-semibold text-black dark:text-white">
                        Soporte Técnico - {{ mesCapitalizado($date) }} {{ $year }}
                    </h2>
                    
                    <div class="flex items-center gap-2">
                        <button id="prev-month" type="button" 
                                class="flex items-center justify-center rounded-lg border border-stroke bg-white p-2 hover:bg-gray-100 dark:border-strokedark dark:bg-boxdark dark:hover:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        
                        <!-- Selector de mes y año -->
                        <div class="relative">
                            <form id="month-selector" action="{{ route('calendar.index') }}" method="GET" class="flex gap-2">
                                <select name="month" id="select-month" class="w-32 rounded-lg border border-stroke bg-white px-3 py-2 text-sm dark:border-strokedark dark:bg-boxdark">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>
                                            {{ mesCapitalizado(\Carbon\Carbon::createFromDate(null, $i, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                                
                                <select name="year" id="select-year" class="w-24 rounded-lg border border-stroke bg-white px-3 py-2 text-sm dark:border-strokedark dark:bg-boxdark">
                                    @for ($i = $year - 5; $i <= $year + 5; $i++)
                                        <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                
                                <button type="submit" class="hidden">Ir</button>
                            </form>
                        </div>
                        
                        <button id="today-btn" type="button" 
                                class="flex items-center justify-center rounded-lg border border-stroke bg-white px-4 py-2 hover:bg-gray-100 dark:border-strokedark dark:bg-boxdark dark:hover:bg-gray-800">
                            Hoy
                        </button>
                        
                        <button id="next-month" type="button" 
                                class="flex items-center justify-center rounded-lg border border-stroke bg-white p-2 hover:bg-gray-100 dark:border-strokedark dark:bg-boxdark dark:hover:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                        
                        <button id="add-event-btn" type="button" 
                                class="flex items-center justify-center rounded-lg bg-primary px-4 py-2 text-white hover:bg-opacity-90"
                                onclick="openModal('{{ now()->format('Y-m-d') }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Nuevo Evento
                        </button>
                    </div>
                </div>
                <div
                    class="w-full max-w-full rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                    <div class="grid grid-cols-7 border-b border-stroke dark:border-strokedark">
                        <div class="bg-primary py-5 text-center text-sm font-medium uppercase text-white">
                            <span class="hidden sm:inline">Lunes</span>
                            <span class="sm:hidden">L</span>
                        </div>
                        <div class="bg-primary py-5 text-center text-sm font-medium uppercase text-white">
                            <span class="hidden sm:inline">Martes</span>
                            <span class="sm:hidden">M</span>
                        </div>
                        <div class="bg-primary py-5 text-center text-sm font-medium uppercase text-white">
                            <span class="hidden sm:inline">Miércoles</span>
                            <span class="sm:hidden">X</span>
                        </div>
                        <div class="bg-primary py-5 text-center text-sm font-medium uppercase text-white">
                            <span class="hidden sm:inline">Jueves</span>
                            <span class="sm:hidden">J</span>
                        </div>
                        <div class="bg-primary py-5 text-center text-sm font-medium uppercase text-white">
                            <span class="hidden sm:inline">Viernes</span>
                            <span class="sm:hidden">V</span>
                        </div>
                        <div class="bg-primary py-5 text-center text-sm font-medium uppercase text-white">
                            <span class="hidden sm:inline">Sábado</span>
                            <span class="sm:hidden">S</span>
                        </div>
                        <div class="bg-primary py-5 text-center text-sm font-medium uppercase text-white">
                            <span class="hidden sm:inline">Domingo</span>
                            <span class="sm:hidden">D</span>
                        </div>
                    </div>

                    <!-- Contenido del calendario -->
                    @php
                        function generarCalendario($date) {
                            $mes = $date->month;
                            $anio = $date->year;
                            
                            $primerDia = $date->copy()->startOfMonth();
                            $ultimoDia = $date->copy()->endOfMonth();
                            
                            // Configurar para que la semana comience en lunes (1)
                            $inicioCalendario = $primerDia->copy()->startOfWeek(Carbon\Carbon::MONDAY);
                            $finCalendario = $ultimoDia->copy()->endOfWeek(Carbon\Carbon::MONDAY);
                            
                            $calendario = [];
                            $semanaActual = [];
                            $diaActual = $inicioCalendario->copy();
                            
                            while ($diaActual <= $finCalendario) {
                                $esOtroMes = $diaActual->month !== $mes;
                                $esHoy = $diaActual->isToday();
                                
                                $semanaActual[] = [
                                    'fecha' => $diaActual->copy(),
                                    'dia' => $diaActual->day,
                                    'es_otro_mes' => $esOtroMes,
                                    'es_hoy' => $esHoy,
                                ];
                                
                                // Cambiar la condición para que termine en domingo (0)
                                if ($diaActual->dayOfWeek === Carbon\Carbon::SUNDAY) {
                                    $calendario[] = $semanaActual;
                                    $semanaActual = [];
                                }
                                
                                $diaActual->addDay();
                            }
                            
                            if (!empty($semanaActual)) {
                                $calendario[] = $semanaActual;
                            }
                            
                            return $calendario;
                        }

                        $calendario = generarCalendario($date);
                    @endphp

                    <!-- Contenido del calendario por semanas -->
                    @foreach ($calendario as $semana)
                        <div class="grid grid-cols-7">
                            @foreach ($semana as $dia)
                                @php
                                    $eventosDia = $eventos->filter(function($evento) use ($dia) {
                                        return $dia['fecha']->between(
                                            $evento->fecha_inicio, 
                                            $evento->fecha_fin ? $evento->fecha_fin : $evento->fecha_inicio
                                        );
                                    });
                                @endphp
                                
                                <div class="relative h-30 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray-50 dark:border-strokedark dark:hover:bg-gray-800
                                     {{ $dia['es_hoy'] ? 'bg-gray-100 dark:bg-gray-800' : 'bg-white dark:bg-boxdark' }}
                                     {{ $dia['es_otro_mes'] ? 'text-gray-400 dark:text-gray-600' : '' }}"
                                     onclick="openModal('{{ $dia['fecha']->format('Y-m-d') }}')">
                                    
                                    <span class="font-medium {{ $dia['es_hoy'] ? 'text-primary dark:text-white' : 'text-black dark:text-white' }}">
                                        {{ $dia['dia'] }}
                                    </span>
                                    
                                    <!-- Eventos del día -->
                                    <div class="mt-2 space-y-1 overflow-y-auto max-h-24">
                                        @foreach ($eventosDia as $evento)
                                            @php
                                                $colorClase = '';
                                                switch($evento->estado) {
                                                    case 'pendiente': $colorClase = 'border-l-4 border-red-500 bg-red-50 dark:bg-red-900/20'; break;
                                                    case 'visitar': $colorClase = 'border-l-4 border-yellow-500 bg-yellow-50 dark:bg-yellow-900/20'; break;
                                                    case 'solucionado': $colorClase = 'border-l-4 border-green-500 bg-green-50 dark:bg-green-900/20'; break;
                                                    case 'cobrar': $colorClase = 'border-l-4 border-blue-500 bg-blue-50 dark:bg-blue-900/20'; break;
                                                }
                                            @endphp
                                            
                                            <div class="p-1 text-xs rounded {{ $colorClase }}" 
                                                 onclick="editarEvento({{ $evento->id }}); event.stopPropagation();">
                                                <div class="font-semibold">{{ $evento->titulo }}</div>
                                                <div class="text-xs text-gray-600 dark:text-gray-400">
                                                    {{ $evento->fecha_inicio->locale('es')->day }} {{ mesCapitalizado($evento->fecha_inicio, 'M') }} - 
                                                    {{ $evento->fecha_fin ? $evento->fecha_fin->locale('es')->day . ' ' . mesCapitalizado($evento->fecha_fin, 'M') : $evento->fecha_inicio->locale('es')->day . ' ' . mesCapitalizado($evento->fecha_inicio, 'M') }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <!-- ====== Calendar Section End -->
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->
    
    <!-- Script para manejar el modal -->
    <script>
        // Variables para controlar el mes y año actual del calendario
        let currentMonth = {{ $month }};
        let currentYear = {{ $year }};
        
        // Function para cargar un mes específico
        function loadMonth(month, year) {
            window.location.href = `{{ route('calendar.index') }}?month=${month}&year=${year}`;
        }
        
        // Evento para el botón "Anterior"
        document.getElementById('prev-month').addEventListener('click', function() {
            let prevMonth = currentMonth - 1;
            let prevYear = currentYear;
            
            if (prevMonth < 1) {
                prevMonth = 12;
                prevYear--;
            }
            
            loadMonth(prevMonth, prevYear);
        });
        
        // Evento para el botón "Siguiente"
        document.getElementById('next-month').addEventListener('click', function() {
            let nextMonth = currentMonth + 1;
            let nextYear = currentYear;
            
            if (nextMonth > 12) {
                nextMonth = 1;
                nextYear++;
            }
            
            loadMonth(nextMonth, nextYear);
        });
        
        // Evento para el botón "Hoy"
        document.getElementById('today-btn').addEventListener('click', function() {
            loadMonth({{ now()->month }}, {{ now()->year }});
        });
        
        // Evento para los selectores de mes y año
        document.getElementById('select-month').addEventListener('change', function() {
            document.getElementById('month-selector').submit();
        });
        
        document.getElementById('select-year').addEventListener('change', function() {
            document.getElementById('month-selector').submit();
        });
        
        // Modificar esta parte para que el modal solo se abra cuando sea solicitado
        document.addEventListener('DOMContentLoaded', function() {
            // Solo abrir el modal si hay un evento seleccionado explícitamente y se debe abrir
            @if($eventoSeleccionado && $shouldOpenModal)
                fetch(`/api/eventos/{{ $eventoSeleccionado->id }}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const evento = data.evento;
                            
                            // Establecer método PUT y ID del evento
                            document.getElementById('eventoMethod').value = 'PUT';
                            document.getElementById('eventoId').value = evento.id;
                            
                            // Llenar el formulario con los datos del evento
                            document.getElementById('event-title').value = evento.titulo;
                            document.getElementById('event-description').value = evento.descripcion || '';
                            document.getElementById('event-client').value = evento.cliente_nombre || '';
                            document.getElementById('event-start-date').value = evento.fecha_inicio;
                            document.getElementById('event-end-date').value = evento.fecha_fin || evento.fecha_inicio;
                            
                            // Mostrar la opción "Solucionado" al editar
                            document.getElementById('opcion-solucionado').style.display = 'flex';
                            
                            // Seleccionar el estado correcto
                            document.querySelector(`input[name="estado"][value="${evento.estado}"]`).checked = true;
                            
                            // Mostrar el botón de actualizar y ocultar el de agregar
                            document.getElementById('add-btn').style.display = 'none';
                            document.getElementById('update-btn').style.display = 'block';
                            
                            // Abrir el modal
                            document.getElementById('eventModal').classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener el evento:', error);
                    });
            @endif
            
            // No hay más código aquí que pueda abrir el modal automáticamente
        });
        
        // Función para abrir el modal para crear un nuevo evento - No debería ejecutarse automáticamente
        function openModal(date) {
            // Limpiar el formulario completamente
            document.getElementById('eventoForm').reset();
            
            // Restablecer campos ocultos
            document.getElementById('eventoId').value = '';
            document.getElementById('eventoMethod').value = 'POST';
            
            // Establecer la fecha seleccionada
            document.getElementById('event-start-date').value = date;
            
            // Seleccionar "Pendiente" como estado predeterminado
            document.getElementById('modalPendiente').checked = true;
            
            // Ocultar la opción "Solucionado" para nuevos eventos
            document.getElementById('opcion-solucionado').style.display = 'none';
            
            // Mostrar el botón de agregar y ocultar el de actualizar
            document.getElementById('add-btn').style.display = 'block';
            document.getElementById('update-btn').style.display = 'none';
            
            // Mostrar el modal
            document.getElementById('eventModal').classList.remove('hidden');
        }

        // Función para editar un evento existente
        function editarEvento(eventoId) {
            fetch(`/api/eventos/${eventoId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const evento = data.evento;
                        
                        // Establecer método PUT y ID del evento
                        document.getElementById('eventoMethod').value = 'PUT';
                        document.getElementById('eventoId').value = evento.id;
                        
                        // Llenar el formulario con los datos del evento
                        document.getElementById('event-title').value = evento.titulo;
                        document.getElementById('event-description').value = evento.descripcion || '';
                        document.getElementById('event-client').value = evento.cliente_nombre || '';
                        document.getElementById('event-start-date').value = evento.fecha_inicio;
                        document.getElementById('event-end-date').value = evento.fecha_fin || evento.fecha_inicio;
                        
                        // Mostrar la opción "Solucionado" al editar
                        document.getElementById('opcion-solucionado').style.display = 'flex';
                        
                        // Seleccionar el estado correcto
                        document.querySelector(`input[name="estado"][value="${evento.estado}"]`).checked = true;
                        
                        // Mostrar el botón de actualizar y ocultar el de agregar
                        document.getElementById('add-btn').style.display = 'none';
                        document.getElementById('update-btn').style.display = 'block';
                        
                        // Abrir el modal
                        document.getElementById('eventModal').classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error al obtener el evento:', error);
                    alert('No se pudo cargar la información del evento.');
                });
        }

        // Cerrar modales
        document.querySelectorAll('.modal-close-btn').forEach(button => {
            button.addEventListener('click', () => {
                const modal = document.getElementById('eventModal');
                modal.classList.add('hidden');
                
                // Resetear el formulario
                document.getElementById('eventoForm').reset();
                
                // Eliminar el parámetro 'event' de la URL sin recargar la página
                if (window.location.href.includes('event=')) {
                    const url = new URL(window.location);
                    url.searchParams.delete('event');
                    window.history.replaceState({}, '', url);
                }
            });
        });
    </script>
    
    <!-- Estilos para el calendario -->
    <style>
        /* Estilos para los eventos en el calendario */
        .fc-event {
            cursor: pointer;
            border-radius: 4px;
            padding: 2px 4px;
            margin: 1px 0;
            border-left-width: 3px !important;
        }
        
        /* Colores específicos para cada tipo de evento */
        .fc-bg-danger {
            border-left-color: #ef4444 !important;
            background-color: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }
        
        .fc-bg-warning {
            border-left-color: #f97316 !important;
            background-color: rgba(249, 115, 22, 0.15);
            color: #f97316;
        }
        
        .fc-bg-success {
            border-left-color: #22c55e !important;
            background-color: rgba(34, 197, 94, 0.15);
            color: #22c55e;
        }
        
        .fc-bg-primary {
            border-left-color: #3b82f6 !important;
            background-color: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
        }
        
        /* Estilo cuando se pasa el cursor por encima */
        .fc-event:hover {
            filter: brightness(90%);
        }
        
        /* Estilos para los radio buttons personalizados */
        input[type="radio"].peer:checked + div {
            border-width: 2px;
        }
    </style>
@endsection

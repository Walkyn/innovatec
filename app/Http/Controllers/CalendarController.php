<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventoSoporte;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('es');
        
        $month = $request->query('month', now()->month);
        $year = $request->query('year', now()->year);
        
        // Validar los parámetros
        $month = min(max(1, (int) $month), 12);
        $year = min(max(2000, (int) $year), 2100);
    
        $date = Carbon::createFromDate($year, $month, 1)->locale('es');
    
        $startDate = $date->copy()->startOfMonth()->subWeek();
        $endDate = $date->copy()->endOfMonth()->addWeek();
        
        // Obtener todos los eventos sin filtrar
        $eventos = EventoSoporte::where(function($query) use ($startDate, $endDate) {
                $query->where(function($q) use ($startDate, $endDate) {
                    $q->whereBetween('fecha_inicio', [$startDate, $endDate]);
                })->orWhere(function($q) use ($startDate, $endDate) {
                    $q->whereBetween('fecha_fin', [$startDate, $endDate]);
                })->orWhere(function($q) use ($startDate, $endDate) {
                    $q->where('fecha_inicio', '<', $startDate)
                      ->where('fecha_fin', '>', $endDate);
                });
            })
            ->orderBy('fecha_inicio')
            ->get();
        
        // Verificar si se solicitó abrir un evento específico
        $eventoSeleccionado = null;
        $shouldOpenModal = $request->has('openEvent') && $request->has('event');
    
        if ($shouldOpenModal && $request->has('event')) {
            $eventoId = $request->query('event');
            $eventoSeleccionado = EventoSoporte::where('id', $eventoId)->first();

            if ($eventoSeleccionado) {
                $mesEvento = Carbon::parse($eventoSeleccionado->fecha_inicio)->month;
                $añoEvento = Carbon::parse($eventoSeleccionado->fecha_inicio)->year;
                
                if ($mesEvento != $month || $añoEvento != $year) {
                    return redirect()->route('calendar.index', [
                        'month' => $mesEvento,
                        'year' => $añoEvento,
                        'event' => $eventoId,
                        'openEvent' => 'true'
                    ]);
                }
            }
        }
    
        $openModal = $request->query('openModal', false);
        
        // Pasar el mes y año actuales y el evento seleccionado a la vista
        return view('calendar.index', compact('eventos', 'month', 'year', 'date', 'eventoSeleccionado', 'shouldOpenModal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,visitar,solucionado,cobrar',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'descripcion' => 'nullable|string',
            'cliente_nombre' => 'nullable|string|max:255',
            'todo_dia' => 'boolean'
        ]);

        $evento = EventoSoporte::create([
            'titulo' => $validated['titulo'],
            'estado' => $validated['estado'],
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_fin' => $validated['fecha_fin'] ?? null,
            'descripcion' => $validated['descripcion'] ?? null,
            'tecnico_id' => Auth::id(),
            'cliente_nombre' => $validated['cliente_nombre'] ?? null,
            'todo_dia' => $validated['todo_dia'] ?? true,
        ]);

        return response()->json([
            'success' => true,
            'evento' => [
                'id' => $evento->id,
                'title' => $evento->titulo,
                'start' => $evento->fecha_inicio->format('Y-m-d'),
                'end' => $evento->fecha_fin ? $evento->fecha_fin->format('Y-m-d') : null,
                'extendedProps' => [
                    'calendar' => $this->mapEstadoToCalendar($evento->estado),
                ],
                'allDay' => $evento->todo_dia,
            ]
        ]);
    }

    public function update(Request $request, EventoSoporte $evento)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,visitar,solucionado,cobrar',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'descripcion' => 'nullable|string',
            'cliente_nombre' => 'nullable|string|max:255',
            'todo_dia' => 'boolean'
        ]);

        $evento->update($validated);

        return response()->json([
            'success' => true,
            'evento' => [
                'id' => $evento->id,
                'title' => $evento->titulo,
                'start' => $evento->fecha_inicio->format('Y-m-d'),
                'end' => $evento->fecha_fin ? $evento->fecha_fin->format('Y-m-d') : null,
                'extendedProps' => [
                    'calendar' => $this->mapEstadoToCalendar($evento->estado),
                ],
                'allDay' => $evento->todo_dia,
            ]
        ]);
    }

    public function destroy(EventoSoporte $evento)
    {
        $evento->delete();
        return response()->json(['success' => true]);
    }

    public function getEvento(EventoSoporte $evento)
    {
        return response()->json([
            'success' => true,
            'evento' => [
                'id' => $evento->id,
                'titulo' => $evento->titulo,
                'descripcion' => $evento->descripcion,
                'estado' => $evento->estado,
                'fecha_inicio' => $evento->fecha_inicio->format('Y-m-d'),
                'fecha_fin' => $evento->fecha_fin ? $evento->fecha_fin->format('Y-m-d') : null,
                'cliente_nombre' => $evento->cliente_nombre,
                'todo_dia' => $evento->todo_dia,
                'tecnico_id' => $evento->tecnico_id
            ]
        ]);
    }

    // Mapear estados a los valores que usa el calendario
    protected function mapEstadoToCalendar($estado)
    {
        switch ($estado) {
            case 'pendiente': return 'Danger';
            case 'visitar': return 'Warning';
            case 'solucionado': return 'Success';
            case 'cobrar': return 'Primary';
            default: return 'Danger';
        }
    }

    /**
     * Obtiene los eventos programados para el día actual.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEventosHoy()
    {
        // Establecer el locale de Carbon a español
        Carbon::setLocale('es');
        
        // Obtener la fecha actual
        $today = Carbon::today();
        
        // Buscar eventos que ocurran hoy
        $eventos = EventoSoporte::where('tecnico_id', Auth::id())
            ->where(function($query) use ($today) {
                $query->whereDate('fecha_inicio', '=', $today)
                    ->orWhere(function($q) use ($today) {
                        // Eventos que abarcan hoy (comenzaron antes y terminan después)
                        $q->whereDate('fecha_inicio', '<=', $today)
                          ->whereDate('fecha_fin', '>=', $today);
                    });
            })
            ->orderBy('fecha_inicio')
            ->get();
        
        return response()->json([
            'success' => true,
            'eventos' => $eventos
        ]);
    }
}

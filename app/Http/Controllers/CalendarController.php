<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventoSoporte;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,visitar,solucionado,cobrar',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'descripcion' => 'nullable|string',
            'cliente_id' => 'nullable|exists:clientes,id',
            'todo_dia' => 'boolean'
        ]);

        $evento = EventoSoporte::create([
            'titulo' => $validated['titulo'],
            'estado' => $validated['estado'],
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_fin' => $validated['fecha_fin'] ?? null,
            'descripcion' => $validated['descripcion'] ?? null,
            'tecnico_id' => Auth::id(),
            'cliente_id' => $validated['cliente_id'] ?? null,
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
            'cliente_id' => 'nullable|exists:clientes,id',
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
}

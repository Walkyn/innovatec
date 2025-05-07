<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\EventoSoporte;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Cambiar de Bootstrap a Tailwind
        // Paginator::useBootstrap(); // Comentar o eliminar esta línea
        
        // Usar Tailwind para la paginación
        Paginator::defaultView('pagination::tailwind');
        Paginator::defaultSimpleView('pagination::simple-tailwind');

        View::composer('partials.header', function ($view) {
            if (Auth::check()) {
                $hoy = Carbon::today();
                $eventosHoy = EventoSoporte::where('tecnico_id', Auth::id())
                    ->where(function($query) use ($hoy) {
                        $query->whereDate('fecha_inicio', $hoy)
                            ->orWhere(function($q) use ($hoy) {
                                $q->whereDate('fecha_inicio', '<=', $hoy)
                                    ->whereDate('fecha_fin', '>=', $hoy);
                            });
                    })
                    ->orderBy('estado')
                    ->orderBy('fecha_inicio')
                    ->get();
                
                $view->with('eventosHoy', $eventosHoy);
            } else {
                $view->with('eventosHoy', collect([]));
            }
        });
    }
}

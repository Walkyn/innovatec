<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\MesController;
use App\Http\Controllers\UserController;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Pueblo;
use App\Models\Contrato;
use App\Models\ContratoServicio;
use App\Http\Controllers\DatabaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ContratoPDFController;
use App\Http\Controllers\PaymentPDFController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PanelController;
use App\Models\Mes;
use Carbon\Carbon;
// Rutas de autenticación
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');

    Route::post('login', 'login')->name('login.post');
    Route::post('logout', 'logout')->name('logout');
});

// Ruta para crear el enlace simbólico
Route::get('link', function () {
    $symlinkPath = public_path('storage');

    if (is_link($symlinkPath) && file_exists($symlinkPath)) {
        return redirect('/');
    }
    return view('link');
});

Route::get('forbidden', function () {
    return view('errors.forbidden');
})->name('forbidden');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Home
    Route::get('home', [HomeController::class, 'index'])->middleware('check.permissions:home,all')->name('home.index');

    // Users
    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->middleware('check.permissions:users,all')->name('users.index');
        Route::get('users.create', 'create')->middleware('check.permissions:users,all')->name('users.create');
        Route::post('store-user', 'store')->middleware('check.permissions:users,guardar')->name('users.store');
        Route::get('users/{user}/edit', 'edit')->middleware('check.permissions:users,actualizar')->name('users.edit');
        Route::put('users/{user}', 'update')->middleware('check.permissions:users,actualizar')->name('users.update');
        Route::delete('users/{user}', 'destroy')->middleware('check.permissions:users,eliminar')->name('users.destroy');

        Route::get('reset-password', 'passwordReset')->middleware('check.permissions:users,all')->name('password.reset');
        Route::post('verify-email', 'verifyEmail')->name('users.verifyEmail');
        Route::post('update-password', 'updatePassword')->middleware('check.permissions:users,actualizar')->name('users.updatePassword');
    });

    // Clients
    Route::controller(ClientController::class)->group(function () {
        Route::get('clients', 'index')->middleware('check.permissions:clients,all')->name('clients.index');
        Route::get('clients.create', 'create')->middleware('check.permissions:clients,guardar')->name('clients.create');
        Route::post('clients', 'store')->middleware('check.permissions:clients,guardar')->name('clients.store');
        Route::get('clients.assign-service', 'assignService')->name('clients.assign_service');
        Route::get('clients/{id}/edit', 'edit')->middleware('check.permissions:clients,actualizar')->name('clients.edit');
        Route::put('clients/{id}', 'update')->middleware('check.permissions:clients,actualizar')->name('clients.update');
        Route::delete('clients/{id}', 'destroy')->middleware('check.permissions:clients,eliminar')->name('clients.destroy');
        Route::get('clients/{id}/details', 'getDetails')->name('clients.details');
    });

    // Import Routes
    Route::post('import/clientes', [ImportController::class, 'importClientes'])->name('import.clientes');
    Route::get('descargar-plantilla-excel', [ImportController::class, 'descargarPlantilla'])->name('descargar.plantilla.excel');

    // Ruta temporal para generar la imagen de la plantilla
    Route::get('generar-imagen-plantilla', function () {
        return view('templates.excel-template-preview');
    });

    // Calendar
    Route::get('calendar', [CalendarController::class, 'index'])->middleware('check.permissions:calendar,all')->name('calendar.index');

    // Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'index')->middleware('check.permissions:profile,all')->name('profile.index');
        Route::put('/profile.photo', 'updatePhoto')->middleware('check.permissions:profile,actualizar')->name('profile.update.photo');
        Route::post('/profile.update-cover', 'updateCover')->middleware('check.permissions:profile,actualizar')->name('profile.update.cover');
    });

    // Settings
    Route::controller(SettingsController::class)->group(function () {
        Route::get('settings', 'index')->middleware('check.permissions:settings,all')->name('settings.index');
        Route::get('settings.create', 'create')->name('settings.create');
        Route::post('settings.store', 'store')->middleware('check.permissions:settings,guardar')->name('settings.store');
        Route::post('settings.redes-sociales', 'storeRedesSociales')->middleware('check.permissions:settings,guardar')->name('settings.storeRedesSociales');

        Route::put('/company/update-cover', 'updateCover')->middleware('check.permissions:settings,actualizar')->name('company.update.cover');
        Route::put('/company/update-logo', 'updateLogo')->middleware('check.permissions:settings,actualizar')->name('company.update.logo');
        Route::post('/settings/medio-pago', 'storeMedioPago')->middleware('check.permissions:settings,guardar')->name('settings.storeMedioPago');
        Route::delete('/settings/medio-pago/{id}', [SettingsController::class, 'deleteMedioPago'])->name('settings.deleteMedioPago');
    });

    // Messages
    Route::controller(MessageController::class)->group(function () {
        Route::get('messages', 'index')->middleware('check.permissions:messages,all')->name('messages.index');
    });

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->middleware('check.permissions:reports,all')->name('reports.index');

    // Payments
    Route::controller(PaymentController::class)->group(function () {
        Route::get('payments', 'index')->middleware('check.permissions:payments,all')->name('payments.index');
        Route::post('payments', 'store')->middleware('check.permissions:payments,guardar')->name('payments.store');
        Route::get('payments/{id}', 'show')->middleware('check.permissions:payments,all')->name('payments.show');
        Route::put('payments/{id}', 'update')->middleware('check.permissions:payments,actualizar')->name('payments.update');
        Route::get('payments/{id}/pdf', [PaymentPDFController::class, 'generatePDF'])
            ->middleware('check.permissions:payments,all')
            ->name('payments.pdf');
    });

    // Services
    Route::controller(ServiceController::class)->group(function () {
        Route::get('services', 'index')->middleware('check.permissions:manage,all')->name('services.index');
        Route::get('services/activos', 'getServiciosActivos')->middleware('check.permissions:manage,all');
        Route::post('services', 'store')->middleware('check.permissions:manage,guardar')->name('services.store');
        Route::post('services.store-plan', 'storePlan')->middleware('check.permissions:manage,guardar')->name('services.storePlan');
        Route::delete('services/{servicio}', 'destroy')->middleware('check.permissions:manage,eliminar')->name('services.destroy');
        Route::post('/category/store', 'storeCategory')->middleware('check.permissions:manage,guardar')->name('category.store');
        Route::get('/categorias/{id}/edit', 'editCategory')->middleware('check.permissions:manage,actualizar')->name('categorias.edit');
        Route::put('/categorias/{id}/update', 'updateCategory')->middleware('check.permissions:manage,actualizar')->name('categorias.update');
        Route::delete('/categorias/{id}', 'destroyCategory')->middleware('check.permissions:manage,eliminar')->name('categorias.destroy');
        Route::get('/categorias/{id}/servicios', 'getServiciosByCategoria')->middleware('check.permissions:manage,all');
        Route::get('/servicios/{id}/edit', 'editServicio')->middleware('check.permissions:manage,actualizar');
        Route::put('/servicios/{id}/update', 'updateServicio')->middleware('check.permissions:manage,actualizar');
        Route::put('/servicios/{id}/update-all', 'updateAllServicio')->middleware('check.permissions:manage,actualizar');
        Route::delete('/servicios/{servicio}', 'destroyServices')->middleware('check.permissions:manage,eliminar')->name('servicios.destroy');
        Route::get('/categorias/{categoria}/servicios', 'getServicios')->middleware('check.permissions:manage,all');
        // Rutas para Planes
        Route::get('/servicios/{servicio}/planes', 'getPlanes')->middleware('check.permissions:manage,all');
        Route::get('/planes/{id}/edit', 'editPlan')->middleware('check.permissions:manage,actualizar');
        Route::put('/planes/{id}/update', 'updatePlan')->middleware('check.permissions:manage,actualizar');
        Route::delete('/planes/{plan}', 'destroyPlan')->middleware('check.permissions:manage,eliminar')->name('planes.destroy');
        Route::get('/servicios/{id}/edit', 'edit')->middleware('check.permissions:manage,actualizar')->name('servicios.edit');
        Route::post('/servicios/{id}/update', 'update')->middleware('check.permissions:manage,actualizar')->name('servicios.update');
    });

    // Contracts
    Route::controller(ContractController::class)->group(function () {
        Route::get('contracts', 'index')->middleware('check.permissions:manage,all')->name('contracts.index');
        Route::post('contracts', 'store')->middleware('check.permissions:manage,guardar')->name('contracts.store');
        Route::put('contracts/{id}/update', 'update')->middleware('check.permissions:manage,actualizar')->name('contracts.update');
        Route::delete('contratos/{id}', 'destroy')->middleware('check.permissions:manage,eliminar')->name('contratos.destroy');
        Route::get('/categorias', 'getCategorias')->middleware('check.permissions:manage,all');
        Route::get('/servicios/{categoriaId}', 'getServicios')->middleware('check.permissions:manage,all');
        Route::get('/planes/{servicioId}', 'getPlanes')->middleware('check.permissions:manage,all');
    });

    // Contrato PDF
    Route::get('contratos/{id}/pdf', [ContratoPDFController::class, 'generatePDF'])
        ->middleware('check.permissions:manage,all')
        ->name('contratos.pdf');

    // Months
    Route::controller(MesController::class)->group(function () {
        Route::get('months', 'index')->middleware('check.permissions:manage,all')->name('months.index');
        Route::post('months.store', 'store')->middleware('check.permissions:manage,guardar')->name('months.store');
    });

    // Database
    Route::controller(DatabaseController::class)->group(function () {
        Route::get('/database', 'index')->middleware('check.permissions:database,all')->name('database.index');
        Route::get('/exportar-clientes', 'exportarClientes')->middleware('check.permissions:database,guardar')->name('exportar.clientes');
        Route::get('/backup/descargar/{id}', 'descargar')->middleware('check.permissions:database,guardar')->name('backup.descargar');
        Route::delete('/backup/eliminar/{id}', 'destroy')->middleware('check.permissions:database,eliminar')->name('backup.eliminar');
        Route::post('/database/restore', 'restore')->middleware('check.permissions:database,actualizar')->name('database.restore');
    });

    // Rutas de datos protegidas
    Route::get('/contratos/{clientId}', function ($clientId) {
        return response()->json(
            Contrato::where('cliente_id', $clientId)
                ->where('estado_contrato', 'activo')
                ->get()
        );
    })->middleware('check.permissions:manage,all');

    Route::get('/meses-pendientes/{contratoServicioId}', function ($contratoServicioId) {
        // 1) Buscamos el contrato-servicio
        $cs = ContratoServicio::findOrFail($contratoServicioId);

        // 2) Fecha real de inicio y verificación de suspensión
        $fechaInicio = Carbon::parse($cs->fecha_servicio);
        $fechaSuspension = $cs->estado_servicio_cliente === 'suspendido' && $cs->fecha_suspension_servicio
            ? Carbon::parse($cs->fecha_suspension_servicio)
            : null;
        
        $diaInstalacion = (int) $fechaInicio->format('j');
        $ultimoDiaMesInstalacion = (int) $fechaInicio->copy()->endOfMonth()->format('j');
        
        // Variables para el cálculo proporcional
        $mesInicioId = null;
        $montoProporcional = 0;
        
        // 3) Traemos todos los Meses desde ese año/mes en adelante
        $anioInicio = $fechaInicio->year;
        $mesInicio = $fechaInicio->month;
        
        $meses = Mes::where(function($q) use ($anioInicio, $mesInicio) {
                    $q->where('anio', '>', $anioInicio)
                      ->orWhere(function($q2) use ($anioInicio, $mesInicio) {
                          $q2->where('anio', $anioInicio)
                             ->where('numero', '>=', $mesInicio);
                      });
                })
                ->orderBy('anio')
                ->orderBy('numero')
                ->get();
        
        // 4) Excluir meses cuyo estado sea 'pagado' o 'no_aplica'
        $excluidos = DB::table('cobranza_contratoservicio')
                    ->where('contrato_servicio_id', $contratoServicioId)
                    ->whereIn('estado_pago', ['pagado','no_aplica'])
                    ->pluck('mes_id')
                    ->toArray();
        
        // 5) Calcular precio proporcional para el primer mes
        foreach ($meses as $index => $mes) {
            if ($mes->anio == $anioInicio && $mes->numero == $mesInicio) {
                $mesInicioId = $mes->id;
                
                $fechaInicioMes = Carbon::parse($mes->fecha_inicio);
                $fechaFinMes = Carbon::parse($mes->fecha_fin);
                $restantes = $ultimoDiaMesInstalacion - $diaInstalacion;
                
                // Calcular el monto proporcional solo si no está en los excluidos
                if (!in_array($mes->id, $excluidos)) {
                    if ($restantes < 5) {
                        // Si quedan menos de 5 días, no se cobra este mes
                        $excluidos[] = $mes->id; // Agregamos a excluidos
                    } else {
                        if ($diaInstalacion <= 5) {
                            // Si es en los primeros 5 días, se cobra el mes completo
                            $montoProporcional = $cs->plan->precio;
                        } else {
                            // Si no, se cobra proporcional a los días restantes
                            $totales = $fechaInicioMes->diffInDays($fechaFinMes) + 1;
                            $servicioDias = $fechaInicio->diffInDays($fechaFinMes) + 1;
                            $montoProporcional = ($cs->plan->precio / $totales) * $servicioDias;
                            $montoProporcional = round($montoProporcional, 2, PHP_ROUND_HALF_UP);
                        }
                    }
                }
                break;
            }
        }
        
        // 6) Filtrar meses posteriores a suspensión y ajustar precio para meses incluidos
        $mesesConPrecio = [];
        
        foreach ($meses as $mes) {
            // Omitir meses excluidos o posteriores a la suspensión
            if (in_array($mes->id, $excluidos)) {
                continue;
            }
            
            // Si hay suspensión, omitir meses posteriores
            if ($fechaSuspension) {
                if (($mes->anio == $fechaSuspension->year && $mes->numero > $fechaSuspension->month) ||
                    ($mes->anio > $fechaSuspension->year)) {
                    continue;
                }
            }
            
            $precio = $cs->plan->precio;
            
            // Si es mes de suspensión, calcular precio proporcional
            if ($fechaSuspension && 
                $mes->anio == $fechaSuspension->year && 
                $mes->numero == $fechaSuspension->month) {
                
                $fechaInicioMes = Carbon::parse($mes->fecha_inicio);
                $fechaFinMes = Carbon::parse($mes->fecha_fin);
                
                // Estos cálculos deben coincidir exactamente con los de meses-pendientes.blade.php
                $diasTotales = $fechaInicioMes->diffInDays($fechaFinMes) + 1;
                $diaSuspension = (int) $fechaSuspension->format('j'); // Día del mes en que se suspendió
                $diasHastaSusp = $diaSuspension; // Contamos hasta el día de suspensión inclusive
                
                $precio = ($cs->plan->precio / $diasTotales) * $diasHastaSusp;
                $precio = round($precio, 2, PHP_ROUND_HALF_UP);
            }
            
            $mes->precio_proporcional = $precio;
            $mesesConPrecio[] = $mes;
        }
        
        // 7) Preparamos la respuesta JSON
        return response()->json([
            'success' => true,
            'meses_pendientes' => $mesesConPrecio,
            'precio_plan' => $cs->plan->precio,
            'monto_proporcional' => $montoProporcional,
            'mes_inicio_id' => $mesInicioId
        ]);
    })->middleware('check.permissions:manage,all');

    // Esta es la función que proporciona los servicios para el modal de pagos
    Route::get('/contratos/{id}/servicios', function ($id) {
        // Recoger todos los servicios activos - estos siempre se incluyen
        $serviciosActivos = ContratoServicio::where('contrato_id', $id)
            ->where('estado_servicio_cliente', 'activo')
            ->with(['servicio', 'plan'])
            ->get();
        
        // Recoger servicios suspendidos, pero solo los procesaremos si tienen meses pendientes
        $serviciosSuspendidos = ContratoServicio::where('contrato_id', $id)
            ->where('estado_servicio_cliente', 'suspendido')
            ->with(['servicio', 'plan'])
            ->get();
        
        // Filtramos los servicios suspendidos que tienen meses pendientes
        $serviciosSuspendidosConPendientes = $serviciosSuspendidos->filter(function ($cs) {
            // Fecha de servicio y suspensión
            $fechaInicio = \Carbon\Carbon::parse($cs->fecha_servicio);
            $fechaSuspension = $cs->fecha_suspension_servicio 
                ? \Carbon\Carbon::parse($cs->fecha_suspension_servicio) 
                : null;
            
            // Si no hay fecha de suspensión válida, excluimos
            if (!$fechaSuspension) {
                return false;
            }
            
            // Buscar todos los meses en el rango de fechas (desde inicio hasta suspensión)
            $meses = \App\Models\Mes::where(function($q) use ($fechaInicio, $fechaSuspension) {
                // Mismo año
                if ($fechaInicio->year == $fechaSuspension->year) {
                    $q->where('anio', $fechaInicio->year)
                      ->where('numero', '>=', $fechaInicio->month)
                      ->where('numero', '<=', $fechaSuspension->month);
                } else {
                    // Años diferentes
                    $q->where(function($q1) use ($fechaInicio) {
                        // Meses del primer año
                        $q1->where('anio', $fechaInicio->year)
                           ->where('numero', '>=', $fechaInicio->month);
                    })->orWhere(function($q2) use ($fechaSuspension) {
                        // Meses del último año
                        $q2->where('anio', $fechaSuspension->year)
                           ->where('numero', '<=', $fechaSuspension->month);
                    })->orWhere(function($q3) use ($fechaInicio, $fechaSuspension) {
                        // Años intermedios
                        $q3->where('anio', '>', $fechaInicio->year)
                           ->where('anio', '<', $fechaSuspension->year);
                    });
                }
            })->get();
            
            // Meses ya pagados o marcados como no_aplica
            $mesesExcluidos = \Illuminate\Support\Facades\DB::table('cobranza_contratoservicio')
                ->where('contrato_servicio_id', $cs->id)
                ->whereIn('estado_pago', ['pagado', 'no_aplica'])
                ->pluck('mes_id')
                ->toArray();
            
            // Verificar si el primer mes debe excluirse (menos de 5 días)
            foreach ($meses as $mes) {
                if ($mes->anio == $fechaInicio->year && $mes->numero == $fechaInicio->month) {
                    $fechaFinMes = \Carbon\Carbon::parse($mes->fecha_fin);
                    $diaInicio = (int) $fechaInicio->format('j');
                    $ultimoDia = (int) $fechaFinMes->format('j');
                    $diasRestantes = $ultimoDia - $diaInicio;
                    
                    if ($diasRestantes < 5) {
                        $mesesExcluidos[] = $mes->id;
                    }
                    break;
                }
            }
            
            // Verificar si hay meses pendientes
            $tienePendientes = false;
            foreach ($meses as $mes) {
                if (!in_array($mes->id, $mesesExcluidos)) {
                    $tienePendientes = true;
                    break;
                }
            }
            
            // DEBUG - registra información para diagnóstico
            \Illuminate\Support\Facades\Log::info('Servicio suspendido ID: ' . $cs->id, [
                'fecha_inicio' => $fechaInicio->toDateString(),
                'fecha_suspension' => $fechaSuspension->toDateString(),
                'meses_totales' => $meses->count(),
                'meses_excluidos' => count($mesesExcluidos),
                'tiene_pendientes' => $tienePendientes
            ]);
            
            return $tienePendientes;
        });
        
        // Combinar servicios activos y suspendidos con pendientes
        $serviciosFiltrados = $serviciosActivos->concat($serviciosSuspendidosConPendientes);
        
        // Formatear respuesta
        $resultados = $serviciosFiltrados->map(function ($cs) {
            return [
                'contrato_servicio_id' => $cs->id,
                'id' => $cs->servicio->id,
                'nombre' => $cs->servicio->nombre,
                'plan_nombre' => $cs->plan ? $cs->plan->nombre : 'Sin Plan',
                'fecha_servicio' => $cs->fecha_servicio,
                'estado_servicio' => $cs->estado_servicio_cliente,
                'fecha_suspension' => $cs->fecha_suspension_servicio
            ];
        });
        
        return response()->json($resultados);
    });

    // Rutas de ubicación protegidas
    Route::get('/provincias/{regionId}', function ($regionId) {
        return response()->json(Provincia::where('region_id', $regionId)->get());
    })->middleware('check.permissions:manage,all');

    Route::get('/distritos/{provinciaId}', function ($provinciaId) {
        return response()->json(Distrito::where('provincia_id', $provinciaId)->get());
    })->middleware('check.permissions:manage,all');

    Route::get('/pueblos/{distritoId}', function ($distritoId) {
        return response()->json(Pueblo::where('distrito_id', $distritoId)->get());
    })->middleware('check.permissions:manage,all');

    Route::get('/regiones/{regionId}/provincias', function ($regionId) {
        return response()->json(Provincia::where('region_id', $regionId)->get());
    })->middleware('check.permissions:manage,all');

    Route::get('/provincias/{provinciaId}/distritos', function ($provinciaId) {
        return response()->json(Distrito::where('provincia_id', $provinciaId)->get());
    })->middleware('check.permissions:manage,all');

    Route::get('/distritos/{distritoId}/pueblos', function ($distritoId) {
        return response()->json(Pueblo::where('distrito_id', $distritoId)->get());
    })->middleware('check.permissions:manage,all');

    Route::post('/api/update-location', [LocationController::class, 'updateLocation'])->name('api.update-location');

    Route::get('/obtener-datos-periodo', [HomeController::class, 'obtenerDatosPeriodo'])
        ->name('obtener.datos.periodo');

    Route::get('/obtener-datos-chart02', [ChartController::class, 'obtenerDatosChart02'])->name('obtener.datos.chart02');

    Route::post('/panel/update-password', [PanelController::class, 'updatePassword'])
        ->name('panel.update-password');

    Route::post('/panel/login', [PanelController::class, 'login'])->name('panel.login');

    Route::get('/panel/historial-servicios', function () {
        return view('panel.historial-servicios');
    })->name('panel.historial-servicios');

    // Ruta para guardar el pago
    Route::post('/panel/guardar-pago', [App\Http\Controllers\PanelController::class, 'guardarPago'])->name('panel.guardar-pago');

    // Ruta para ver lista de pagos
    Route::get('/panel/pagos', [App\Http\Controllers\PanelController::class, 'listarPagos'])->name('panel.pagos');

    // Ruta para ver historial de pagos
    Route::get('/panel/historial-pago', [App\Http\Controllers\PanelController::class, 'historialPago'])->name('panel.historial-pago');
});

// Rutas que devuelven datos

Route::get('/categorias', [ContractController::class, 'getCategorias']);
Route::get('/servicios/{categoriaId}', [ContractController::class, 'getServicios']);
Route::get('/planes/{servicioId}', [ContractController::class, 'getPlanes']);

Route::get('/contratos/{clientId}', function ($clientId) {
    return response()->json(
        Contrato::where('cliente_id', $clientId)
            ->where('estado_contrato', 'activo')
            ->get()
    );
});

Route::get('/contratos/{id}/servicios', function ($id) {
    // Recoger todos los servicios activos - estos siempre se incluyen
    $serviciosActivos = ContratoServicio::where('contrato_id', $id)
        ->where('estado_servicio_cliente', 'activo')
        ->with(['servicio', 'plan'])
        ->get();
    
    // Recoger servicios suspendidos, pero solo los procesaremos si tienen meses pendientes
    $serviciosSuspendidos = ContratoServicio::where('contrato_id', $id)
        ->where('estado_servicio_cliente', 'suspendido')
        ->with(['servicio', 'plan'])
        ->get();
    
    // Filtramos los servicios suspendidos que tienen meses pendientes
    $serviciosSuspendidosConPendientes = $serviciosSuspendidos->filter(function ($cs) {
        // Fecha de servicio y suspensión
        $fechaInicio = \Carbon\Carbon::parse($cs->fecha_servicio);
        $fechaSuspension = $cs->fecha_suspension_servicio 
            ? \Carbon\Carbon::parse($cs->fecha_suspension_servicio) 
            : null;
        
        // Si no hay fecha de suspensión válida, excluimos
        if (!$fechaSuspension) {
            return false;
        }
        
        // Buscar todos los meses en el rango de fechas (desde inicio hasta suspensión)
        $meses = \App\Models\Mes::where(function($q) use ($fechaInicio, $fechaSuspension) {
            // Mismo año
            if ($fechaInicio->year == $fechaSuspension->year) {
                $q->where('anio', $fechaInicio->year)
                  ->where('numero', '>=', $fechaInicio->month)
                  ->where('numero', '<=', $fechaSuspension->month);
            } else {
                // Años diferentes
                $q->where(function($q1) use ($fechaInicio) {
                    // Meses del primer año
                    $q1->where('anio', $fechaInicio->year)
                       ->where('numero', '>=', $fechaInicio->month);
                })->orWhere(function($q2) use ($fechaSuspension) {
                    // Meses del último año
                    $q2->where('anio', $fechaSuspension->year)
                       ->where('numero', '<=', $fechaSuspension->month);
                })->orWhere(function($q3) use ($fechaInicio, $fechaSuspension) {
                    // Años intermedios
                    $q3->where('anio', '>', $fechaInicio->year)
                       ->where('anio', '<', $fechaSuspension->year);
                });
            }
        })->get();
        
        // Meses ya pagados o marcados como no_aplica
        $mesesExcluidos = \Illuminate\Support\Facades\DB::table('cobranza_contratoservicio')
            ->where('contrato_servicio_id', $cs->id)
            ->whereIn('estado_pago', ['pagado', 'no_aplica'])
            ->pluck('mes_id')
            ->toArray();
        
        // Verificar si el primer mes debe excluirse (menos de 5 días)
        foreach ($meses as $mes) {
            if ($mes->anio == $fechaInicio->year && $mes->numero == $fechaInicio->month) {
                $fechaFinMes = \Carbon\Carbon::parse($mes->fecha_fin);
                $diaInicio = (int) $fechaInicio->format('j');
                $ultimoDia = (int) $fechaFinMes->format('j');
                $diasRestantes = $ultimoDia - $diaInicio;
                
                if ($diasRestantes < 5) {
                    $mesesExcluidos[] = $mes->id;
                }
                break;
            }
        }
        
        // Verificar si hay meses pendientes
        $tienePendientes = false;
        foreach ($meses as $mes) {
            if (!in_array($mes->id, $mesesExcluidos)) {
                $tienePendientes = true;
                break;
            }
        }
        
        return $tienePendientes;
    });
    
    // Combinar servicios activos y suspendidos con pendientes
    $serviciosFiltrados = $serviciosActivos->concat($serviciosSuspendidosConPendientes);
    
    // Formatear respuesta
    $resultados = $serviciosFiltrados->map(function ($cs) {
        return [
            'contrato_servicio_id' => $cs->id,
            'id' => $cs->servicio->id,
            'nombre' => $cs->servicio->nombre,
            'plan_nombre' => $cs->plan ? $cs->plan->nombre : 'Sin Plan',
            'fecha_servicio' => $cs->fecha_servicio,
            'estado_servicio' => $cs->estado_servicio_cliente,
            'fecha_suspension' => $cs->fecha_suspension_servicio
        ];
    });
    
    return response()->json($resultados);
});

//Rutas para la Vista de Creación Cliente
Route::get('/provincias/{regionId}', function ($regionId) {
    return response()->json(Provincia::where('region_id', $regionId)->get());
});

Route::get('/distritos/{provinciaId}', function ($provinciaId) {
    return response()->json(Distrito::where('provincia_id', $provinciaId)->get());
});

Route::get('/pueblos/{distritoId}', function ($distritoId) {
    return response()->json(Pueblo::where('distrito_id', $distritoId)->get());
});

//Rutas para la Vista de Edición Cliente
Route::get('/regiones/{regionId}/provincias', function ($regionId) {
    return response()->json(Provincia::where('region_id', $regionId)->get());
});

Route::get('/provincias/{provinciaId}/distritos', function ($provinciaId) {
    return response()->json(Distrito::where('provincia_id', $provinciaId)->get());
});

Route::get('/distritos/{distritoId}/pueblos', function ($distritoId) {
    return response()->json(Pueblo::where('distrito_id', $distritoId)->get());
});

Route::post('/backup/database', [BackupController::class, 'backupDatabase'])->name('backup.database');

// Rutas públicas del panel
Route::get('/mis-pagos', [PanelController::class, 'index'])->name('login-cliente');
Route::post('/panel/login', [PanelController::class, 'login'])->name('panel.login');

// Rutas protegidas del panel
Route::middleware(['auth.cliente'])->group(function () {
    Route::get('/dashboard', [PanelController::class, 'dashboard'])->name('panel.dashboard');
    Route::get('/historial-pagos', [PanelController::class, 'historialPagos'])->name('panel.historial-pagos');
    Route::get('/realizar-pago', [PanelController::class, 'realizarPago'])->name('panel.realizar-pago');
    Route::get('/mi-perfil', [PanelController::class, 'miPerfil'])->name('panel.mi-perfil');
    Route::get('/comprobantes', [PanelController::class, 'comprobantes'])->name('panel.comprobantes');
    Route::get('/meses-pendientes', [PanelController::class, 'mesesPendientes'])->name('panel.meses-pendientes');
    Route::get('/mensajes', [PanelController::class, 'mensajes'])->name('panel.mensajes');
    Route::get('/cambiar-password', [PanelController::class, 'cambiarPassword'])->name('panel.cambiar-password');
    Route::post('/panel/cerrar-sesion', [PanelController::class, 'logout'])->name('panel.cerrar-sesion');
    Route::get('/historial-servicios', [PanelController::class, 'historialServicios'])->name('panel.historial-servicios');
});
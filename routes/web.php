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
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ContratoPDFController;
use App\Http\Controllers\PaymentPDFController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\BackupController;

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
        Route::post('settings.info-ticket/store', 'storeInfoTicket')->middleware('check.permissions:settings,guardar')->name('settings.storeInfoTicket');
        Route::put('/company/update-cover', 'updateCover')->middleware('check.permissions:settings,actualizar')->name('company.update.cover');
        Route::put('/company/update-logo', 'updateLogo')->middleware('check.permissions:settings,actualizar')->name('company.update.logo');
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
        Route::get('/exportar-clientes', 'exportarClientes')->name('exportar.clientes');
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
        $contratoServicio = DB::table('contrato_servicio')->find($contratoServicioId);

        if (!$contratoServicio) {
            return response()->json([
                'success' => false,
                'message' => 'Contrato de servicio no encontrado',
                'meses_pendientes' => [],
                'precio_plan' => 0,
                'monto_proporcional' => 0
            ]);
        }

        $fechaInicioServicio = $contratoServicio->fecha_servicio;
        $fechaSuspension = $contratoServicio->fecha_suspension_servicio;
        $estadoServicio = $contratoServicio->estado_servicio_cliente;
        $planId = $contratoServicio->plan_id;
        $precioPlan = DB::table('planes')->where('id', $planId)->value('precio') ?? 0;

        // Verificar si existe la tabla meses
        $tablaMesesExiste = Schema::hasTable('meses');

        if (!$tablaMesesExiste) {
            return response()->json([
                'success' => false,
                'message' => 'Tabla de meses no existe en la base de datos',
                'meses_pendientes' => [],
                'precio_plan' => $precioPlan,
                'monto_proporcional' => 0
            ]);
        }

        // Obtener el mes de inicio del servicio
        $mesInicioServicio = DB::table('meses')
            ->where('fecha_inicio', '<=', $fechaInicioServicio)
            ->where('fecha_fin', '>=', $fechaInicioServicio)
            ->first();

        if (!$mesInicioServicio) {
            return response()->json([
                'success' => false,
                'message' => 'No hay meses generados para el cálculo',
                'meses_pendientes' => [],
                'precio_plan' => $precioPlan,
                'monto_proporcional' => 0
            ]);
        }

        // Obtener el mes de suspensión si existe
        $mesSuspension = null;
        if ($estadoServicio === 'suspendido' && $fechaSuspension) {
            $mesSuspension = DB::table('meses')
                ->where('fecha_inicio', '<=', $fechaSuspension)
                ->where('fecha_fin', '>=', $fechaSuspension)
                ->first();
        }

        // Construir la consulta base para obtener meses pendientes
        $query = DB::table('meses')
            ->where('id', '>=', $mesInicioServicio->id)
            ->whereNotIn('id', function ($query) use ($contratoServicioId) {
                $query->select('mes_id')
                    ->from('cobranza_contratoservicio')
                    ->where('contrato_servicio_id', $contratoServicioId)
                    ->whereIn('estado_pago', ['pagado', 'no_aplica']);
            });

        // Si el servicio está suspendido, solo incluir meses hasta la fecha de suspensión
        if ($estadoServicio === 'suspendido' && $mesSuspension) {
            $query->where('id', '<=', $mesSuspension->id);
        }

        // Obtener los meses pendientes ordenados
        $mesesPendientes = $query->orderBy('anio')
            ->orderBy('numero')
            ->get();

        // Convertir a colección de Laravel
        $mesesPendientes = collect($mesesPendientes);

        // Calcular montos proporcionales
        $montoProporcional = 0;
        if ($mesesPendientes->isNotEmpty()) {
            $primerMes = $mesesPendientes->first();
            $ultimoMes = $mesesPendientes->last();

            // Cálculo para el primer mes (mes de inicio)
            if ($primerMes->id == $mesInicioServicio->id) {
                $diasTotalesMes = (strtotime($mesInicioServicio->fecha_fin) - strtotime($mesInicioServicio->fecha_inicio)) / (60 * 60 * 24) + 1;
                $diaInstalacion = date('j', strtotime($fechaInicioServicio));
                $ultimosDiasMes = date('j', strtotime($mesInicioServicio->fecha_fin));
                $diasRestantesMes = $ultimosDiasMes - $diaInstalacion;

                // Si la instalación fue en los últimos 5 días del mes, no se cobra este mes
                if ($diasRestantesMes < 5) {
                    // Eliminar el primer mes de la colección si la instalación fue en los últimos 5 días
                    $mesesPendientes = $mesesPendientes->filter(function ($mes) use ($mesInicioServicio) {
                        return $mes->id !== $mesInicioServicio->id;
                    })->values(); // Agregar values() para reindexar la colección
                    $montoProporcional = 0;
                } else {
                    if ($diaInstalacion <= 5) {
                        $montoProporcional = $precioPlan;
                    } else {
                        $diasRestantes = (strtotime($mesInicioServicio->fecha_fin) - strtotime($fechaInicioServicio)) / (60 * 60 * 24) + 1;
                        $montoProporcional = ($precioPlan / $diasTotalesMes) * $diasRestantes;
                    }
                }
            }

            // Cálculo para el último mes si es el mes de suspensión
            if ($mesSuspension && $ultimoMes->id == $mesSuspension->id) {
                $diasTotalesMes = (strtotime($mesSuspension->fecha_fin) - strtotime($mesSuspension->fecha_inicio)) / (60 * 60 * 24) + 1;
                $diasHastaSuspension = (strtotime($fechaSuspension) - strtotime($mesSuspension->fecha_inicio)) / (60 * 60 * 24) + 1;

                // Si es el mismo mes que el de inicio, mantener el cálculo anterior
                if ($mesSuspension->id == $mesInicioServicio->id) {
                    $diasHastaSuspension = (strtotime($fechaSuspension) - strtotime($fechaInicioServicio)) / (60 * 60 * 24) + 1;
                    $montoProporcional = ($precioPlan / $diasTotalesMes) * $diasHastaSuspension;
                } else {
                    // Calcular el precio proporcional para el mes de suspensión
                    $precioMesSuspension = ($precioPlan / $diasTotalesMes) * $diasHastaSuspension;

                    // Actualizar el precio del último mes en la colección
                    $mesesPendientes = $mesesPendientes->map(function ($mes) use ($mesSuspension, $precioMesSuspension, $precioPlan) {
                        if ($mes->id == $mesSuspension->id) {
                            $precioRedondeado = round($precioMesSuspension, 2);
                            $mes->precio_proporcional = $precioRedondeado;
                            $mes->monto = $precioRedondeado;
                        } else {
                            $mes->precio_proporcional = $precioPlan;
                            $mes->monto = $precioPlan;
                        }
                        return $mes;
                    });
                }
            } else {
                // Si no hay mes de suspensión, asignar el precio completo a todos los meses
                $mesesPendientes = $mesesPendientes->map(function ($mes) use ($precioPlan) {
                    $mes->precio_proporcional = $precioPlan;
                    $mes->monto = $precioPlan;
                    return $mes;
                });
            }
        }

        return response()->json([
            'success' => true,
            'meses_pendientes' => $mesesPendientes,
            'precio_plan' => $precioPlan,
            'monto_proporcional' => round($montoProporcional, 2)
        ]);
    })->middleware('check.permissions:manage,all');

    Route::get('/contratos/{id}/servicios', function ($id) {
        return response()->json(
            ContratoServicio::where('contrato_id', $id)
                ->whereIn('estado_servicio_cliente', ['activo', 'suspendido'])
                ->with(['servicio', 'plan'])
                ->get()
                ->map(function ($contratoServicio) {
                    $nombreServicio = $contratoServicio->servicio->nombre;
                    $nombrePlan = $contratoServicio->plan ? $contratoServicio->plan->nombre : 'Sin Plan';

                    return [
                        'contrato_servicio_id' => $contratoServicio->id,
                        'id' => $contratoServicio->servicio->id,
                        'nombre' => $nombreServicio,
                        'plan_nombre' => $nombrePlan,
                        'fecha_servicio' => $contratoServicio->fecha_servicio,
                        'estado_servicio' => $contratoServicio->estado_servicio_cliente,
                        'fecha_suspension' => $contratoServicio->fecha_suspension_servicio
                    ];
                })
        );
    })->middleware('check.permissions:manage,all');

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
    return response()->json(
        ContratoServicio::where('contrato_id', $id)
            ->whereIn('estado_servicio_cliente', ['activo', 'suspendido'])
            ->with(['servicio', 'plan'])
            ->get()
            ->map(function ($contratoServicio) {
                $nombreServicio = $contratoServicio->servicio->nombre;
                $nombrePlan = $contratoServicio->plan ? $contratoServicio->plan->nombre : 'Sin Plan';

                return [
                    'contrato_servicio_id' => $contratoServicio->id,
                    'id' => $contratoServicio->servicio->id,
                    'nombre' => $nombreServicio,
                    'plan_nombre' => $nombrePlan,
                    'fecha_servicio' => $contratoServicio->fecha_servicio,
                    'estado_servicio' => $contratoServicio->estado_servicio_cliente,
                    'fecha_suspension' => $contratoServicio->fecha_suspension_servicio
                ];
            })
    );
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

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ChartController;
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

// Rutas de autenticación
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');

    Route::post('login', 'login')->name('login.post');
    Route::post('logout', 'logout')->name('logout');
});

Route::get('sin-permisos', function () {
    return view('errors.sin-permisos');
})->name('sin-permisos');

// Rutas protegidas por autenticación
Route::middleware('auth', 'check.permissions')->group(function () {
    // Home
    Route::get('home', [HomeController::class, 'index'])->name('home.index');

    // Users
    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->name('users.index');
        Route::get('users.create', 'create')->name('users.create');
        Route::post('store-user', 'store')->name('users.store');
    });

    // Clients
    Route::controller(ClientController::class)->group(function () {
        Route::get('clients', 'index')->name('clients.index');
        Route::get('clients.create', 'create')->name('clients.create');
        Route::post('clients', 'store')->name('clients.store');
        Route::get('clients.assign-service', 'assignService')->name('clients.assign_service');
        // Ruta para mostrar el formulario de edición
        Route::get('clients/{id}/edit', 'edit')->name('clients.edit');

        // Ruta para procesar la actualización del cliente
        Route::put('clients/{id}', 'update')->name('clients.update');
    });

    // Calendar
    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');

    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');

    // Settings
    Route::controller(SettingsController::class)->group(function () {
        Route::get('settings', 'index')->name('settings.index');
        Route::get('settings.create', 'create')->name('settings.create');
        Route::post('settings.store', 'store')->name('settings.store');
        Route::post('settings.redes-sociales', 'storeRedesSociales')->name('settings.storeRedesSociales');
        Route::post('settings.info-ticket/store', 'storeInfoTicket')->name('settings.storeInfoTicket');
    });

    // Charts
    Route::get('charts', [ChartController::class, 'index'])->name('charts.index');

    // Payments
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');

    // Services
    Route::controller(ServiceController::class)->group(function () {
        Route::get('services', 'index')->name('services.index');
        Route::post('services', 'store')->name('services.store');
        Route::post('services.store-plan', 'storePlan')->name('services.storePlan');
        Route::delete('services/{servicio}', 'destroy')->name('services.destroy');
    });

    // Contracts
    Route::controller(ContractController::class)->group(function () {
        Route::get('contracts', 'index')->name('contracts.index');
        Route::post('contracts', 'store')->name('contracts.store');
        Route::delete('contratos/{id}', 'destroy')->name('contratos.destroy');
    });

    // Months
    Route::controller(MesController::class)->group(function () {
        Route::get('months', 'index')->name('months.index');
        Route::post('months/store', 'store')->name('months.store');
    });

    // Database
    Route::get('/database', [DatabaseController::class, 'index'])->name('database.index');
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

Route::get('/meses-pendientes/{contratoServicioId}', function ($contratoServicioId) {
    $contratoServicio = DB::table('contrato_servicio')->find($contratoServicioId);

    if (!$contratoServicio) {
        return response()->json([]);
    }

    $fechaInicioServicio = $contratoServicio->fecha_servicio;
    $planId = $contratoServicio->plan_id;
    $precioPlan = DB::table('planes')->where('id', $planId)->value('precio') ?? 0;

    $ultimaFechaPagada = DB::table('cobranza_contratoservicio')
        ->where('contrato_servicio_id', $contratoServicioId)
        ->max('mes_id');

    $mesInicioDeuda = $ultimaFechaPagada
        ? $ultimaFechaPagada + 1
        : DB::table('meses')
        ->where('fecha_inicio', '<=', $fechaInicioServicio)
        ->where('fecha_fin', '>=', $fechaInicioServicio)
        ->value('id');

    if (!$mesInicioDeuda) {
        return response()->json([]);
    }

    $mes = DB::table('meses')->find($mesInicioDeuda);
    $montoProporcional = 0;

    if ($mes && $fechaInicioServicio <= date('Y-m-d', strtotime($mes->fecha_fin . ' -5 days'))) {
        $diasRestantes = (strtotime($mes->fecha_fin) - strtotime($fechaInicioServicio)) / (60 * 60 * 24) + 1;
        $diasTotalesMes = (strtotime($mes->fecha_fin) - strtotime($mes->fecha_inicio)) / (60 * 60 * 24) + 1;
        $montoProporcional = ($precioPlan / $diasTotalesMes) * $diasRestantes;
    }

    $mesesPendientes = DB::table('meses')
        ->where('id', '>=', $mesInicioDeuda)
        ->whereNotIn('id', function ($query) use ($contratoServicioId) {
            $query->select('mes_id')
                ->from('cobranza_contratoservicio')
                ->where('contrato_servicio_id', $contratoServicioId);
        })
        ->orderBy('anio')
        ->orderBy('numero')
        ->get();

    return response()->json([
        'meses_pendientes' => $mesesPendientes,
        'precio_plan' => (float) $precioPlan,
        'monto_proporcional' => (float) $montoProporcional,
    ]);
});

Route::get('/contratos/{id}/servicios', function ($id) {
    return response()->json(
        ContratoServicio::where('contrato_id', $id)
            ->with(['servicio', 'plan'])
            ->get()
            ->map(function ($contratoServicio) {
                return [
                    'contrato_servicio_id' => $contratoServicio->id,
                    'id' => $contratoServicio->servicio->id,
                    'nombre' => $contratoServicio->servicio->nombre . ' - ' . $contratoServicio->plan->nombre,
                    'fecha_servicio' => $contratoServicio->fecha_servicio,
                ];
            })
    );
});

//Rutas para la Vista de Creación
Route::get('/provincias/{regionId}', function ($regionId) {
    return response()->json(Provincia::where('region_id', $regionId)->get());
});

Route::get('/distritos/{provinciaId}', function ($provinciaId) {
    return response()->json(Distrito::where('provincia_id', $provinciaId)->get());
});

Route::get('/pueblos/{distritoId}', function ($distritoId) {
    return response()->json(Pueblo::where('distrito_id', $distritoId)->get());
});

//Rutas para la Vista de Edición
Route::get('/regiones/{regionId}/provincias', function ($regionId) {
    return response()->json(Provincia::where('region_id', $regionId)->get());
});

Route::get('/provincias/{provinciaId}/distritos', function ($provinciaId) {
    return response()->json(Distrito::where('provincia_id', $provinciaId)->get());
});

Route::get('/distritos/{distritoId}/pueblos', function ($distritoId) {
    return response()->json(Pueblo::where('distrito_id', $distritoId)->get());
});

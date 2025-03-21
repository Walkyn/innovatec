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

    // Charts
    Route::get('charts', [ChartController::class, 'index'])->middleware('check.permissions:charts,all')->name('charts.index');

    // Payments
    Route::get('payments', [PaymentController::class, 'index'])->middleware('check.permissions:payments,all')->name('payments.index');

    // Services
    Route::controller(ServiceController::class)->group(function () {
        Route::get('services', 'index')->middleware('check.permissions:manage,all')->name('services.index');
        Route::post('services', 'store')->middleware('check.permissions:manage,guardar')->name('services.store');
        Route::post('services.store-plan', 'storePlan')->middleware('check.permissions:manage,guardar')->name('services.storePlan');
        Route::delete('services/{servicio}', 'destroy')->middleware('check.permissions:manage,eliminar')->name('services.destroy');
        Route::post('/category/store', 'storeCategory')->middleware('check.permissions:manage,guardar')->name('category.store');
        Route::get('/categorias/{id}/edit', 'edit')->middleware('check.permissions:manage,actualizar')->name('categorias.edit');
        Route::put('/categorias/{id}/update', 'updateCategory')->middleware('check.permissions:manage,actualizar')->name('categorias.update');
        Route::delete('/categorias/{id}', 'destroyCategory')->middleware('check.permissions:manage,eliminar')->name('categorias.destroy');
    });
    Route::delete('/categorias/{id}', [ServiceController::class, 'destroyCategory'])
    ->middleware('check.permissions:manage,eliminar')
    ->name('categorias.destroy');
    // Contracts
    Route::controller(ContractController::class)->group(function () {
        Route::get('contracts', 'index')->middleware('check.permissions:manage,all')->name('contracts.index');
        Route::post('contracts', 'store')->middleware('check.permissions:manage,guardar')->name('contracts.store');
        Route::delete('contratos/{id}', 'destroy')->middleware('check.permissions:manage,eliminar')->name('contratos.destroy');
    });

    // Months
    Route::controller(MesController::class)->group(function () {
        Route::get('months', 'index')->middleware('check.permissions:manage,all')->name('months.index');
        Route::post('months.store', 'store')->middleware('check.permissions:manage,guardar')->name('months.store');
    });

    // Database
    Route::get('/database', [DatabaseController::class, 'index'])->middleware('check.permissions:database,all')->name('database.index');
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

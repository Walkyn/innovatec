<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Session;
use App\Models\HistorySession;
// use hisorange\BrowserDetect\Parser as Browser; // hisorange/browser-detect a veces puede dar problemas de dependencias
use WhichBrowser\Parser;
use App\Models\ConfiguracionEmpresa;
use Illuminate\Validation\ValidationException; // Importar la excepción de validación
use Illuminate\Support\Facades\Route; // Importar el Facade Route si lo usas para verificar rutas

class AuthController extends Controller
{
    public function index()
    {
        $configuracion = ConfiguracionEmpresa::first();
        return view('auth.login', compact('configuracion'));
    }

    public function login(Request $request)
    {
        // Usamos try-catch para capturar ValidationException
        // aunque $request->validate() ya lo maneja, puede ayudar a debug
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ], [
                // Mensajes personalizados si quieres anular los de resources/lang/es/validation.php
                'email.required' => 'El correo electrónico es obligatorio.',
                'email.email' => 'El formato del correo electrónico no es válido.',
                'password.required' => 'La contraseña es obligatoria.',
            ]);

            // Si la validación pasa, intentamos autenticar
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                
                // Registrar la sesión exitosa
                // Asegúrate de que esta función NO LANZA un error relacionado con traducciones o tipos inválidos
                $this->registerSuccessfulLogin($request, $user);

                // Establecer la variable de sesión para mostrar el modal de ubicación
                // Corregir el uso de flash en la sesión
                $request->session()->flash('login_successful', true); 
                // Si necesitas que persista más allá de la siguiente petición, usa put:
                // $request->session()->put('login_successful', true);


                // Verificar si el usuario es administrador o empleado
                if ($user->id_rol === 1) {
                    return redirect()->route('home.index');
                } else {
                    $modulos = $user->modulos;

                    if ($modulos->isEmpty()) {
                        Auth::logout();
                         // Asegúrate de que la ruta 'forbidden' existe
                        return redirect()->route('forbidden');
                    }

                    // Redirigir al primer módulo que tenga asignado
                    // Asegúrate de que el modelo User tenga la relación 'modulos'
                    // y que cada módulo tenga el atributo 'nombre_modulo'
                    $primerModulo = $modulos->first();

                    if ($primerModulo->nombre_modulo === 'manage') {
                        return redirect()->route('services.index');
                    }

                    // Redirigir al módulo correspondiente si la ruta existe
                     if (Route::has($primerModulo->nombre_modulo . '.index')) {
                         return redirect()->route($primerModulo->nombre_modulo . '.index');
                     } else {
                         // Fallback si la ruta del primer módulo no existe
                         return redirect()->route('home.index');
                     }
                }
            }

            // Si Auth::attempt falla (credenciales incorrectas)
            // Registrar intento fallido de login si el email existe
            // Asegúrate de que esta función NO LANZA un error relacionado con traducciones o tipos inválidos
            $this->registerFailedLoginAttempt($request);

            // Redirigir de vuelta con un error general para la alerta
            // Usamos una clave diferente, por ejemplo 'general_error', para que no pise los errores de validación
            // y también agregamos los errores de validación al mismo redirect si es necesario,
            // pero en este punto ($request->validate() ya pasó o fue capturado) solo necesitamos el error de credenciales.
            // Asignaremos este error a una clave específica ('login_error') o lo manejaremos en la alerta.
            // Si quieres que aparezca en tu alerta existente que usa 'errorDetails':
             return redirect()->route('login')->with([
                 'errorDetails' => 'Credenciales incorrectas, por favor intenta otra vez',
             ])->withInput(); // Mantener los datos ingresados

        } catch (ValidationException $e) {
            // Si la validación falla (campos vacíos, email inválido, etc.)
            // Laravel ya redirigió con los errores ($e->errors()) y el input anterior.
            // No necesitas hacer nada más aquí si confías en el manejo automático de Laravel.
            // Sin embargo, si el error del traductor ocurre *dentro* de $request->validate(),
            // este catch no lo capturará porque el TypeError es a nivel de PHP antes de la excepción de Laravel.
            // La solución principal sigue siendo limpiar caché y verificar archivos de idioma/config.

            // Si AUN ASÍ quieres intentar redirigir manualmente con los errores, podrías hacerlo así:
             return redirect()->back()
                 ->withErrors($e->errors()) // Pasar los mensajes de error específicos del validador
                 ->withInput(); // Mantener los datos ingresados

        } catch (\Exception $e) {
            // Capturar otros errores inesperados
            \Log::error("Error durante el login: " . $e->getMessage(), ['exception' => $e]);
            // Redirigir con un error general
            return redirect()->route('login')
                ->with(['errorDetails' => 'Ha ocurrido un error inesperado al intentar iniciar sesión.']) // Usar la misma clave para la alerta general
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        // Registrar el cierre de sesión
        $this->registerLogout($request);
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Registra un inicio de sesión exitoso
     */
    protected function registerSuccessfulLogin(Request $request, $user)
    {
        $request->session()->start();
        $sessionId = $request->session()->getId();
        
        if (!$sessionId) {
            $sessionId = uniqid('sess_', true);
        }

        $deviceInfo = $this->getDeviceDetails($request);

        Session::updateOrCreate(
            ['id' => $sessionId],
            [
                'id' => $sessionId,
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'device' => $deviceInfo['device'],
                'browser' => $deviceInfo['browser'],
                'platform' => $deviceInfo['platform'],
                'location' => $this->getLocation($request->ip()),
                'login_successful' => true,
                'login_at' => now(),
                'last_activity' => now()->timestamp,
                'payload' => serialize($request->session()->all())
            ]
        );

        // Registrar en la tabla history_sessions (historial)
        HistorySession::create([
            'user_id' => $user->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'device' => $deviceInfo['device'],
            'browser' => $deviceInfo['browser'],
            'platform' => $deviceInfo['platform'],
            'location' => $this->getLocation($request->ip()),
            'login_successful' => true,
            'login_at' => now()
        ]);
        
        $user->update(['last_activity' => now()]);
    }
    
    protected function registerFailedLoginAttempt(Request $request)
    {
        $user = \App\Models\User::where('email', $request->email)->first();
        
        if ($user) {
            $request->session()->start();
            $sessionId = session()->getId();
            
            if (!$sessionId) {
                $sessionId = uniqid('sess_', true);
            }

            // Obtener información detallada del dispositivo
            $deviceInfo = $this->getDeviceDetails($request);
            
            // Registrar en la tabla sessions (sesión actual)
            Session::updateOrCreate(
                ['id' => $sessionId],
                [
                    'id' => $sessionId,
                    'user_id' => $user->id,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                    'device' => $deviceInfo['device'],
                    'browser' => $deviceInfo['browser'],
                    'platform' => $deviceInfo['platform'],
                    'location' => $this->getLocation($request->ip()),
                    'login_successful' => false,
                    'login_at' => now(),
                    'last_activity' => now()->timestamp,
                    'payload' => serialize($request->session()->all())
                ]
            );

            // Registrar en la tabla history_sessions (historial)
            HistorySession::create([
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'device' => $deviceInfo['device'],
                'browser' => $deviceInfo['browser'],
                'platform' => $deviceInfo['platform'],
                'location' => $this->getLocation($request->ip()),
                'login_successful' => false,
                'login_at' => now()
            ]);
        }
    }

    /**
     * Registra el cierre de sesión
     */
    protected function registerLogout(Request $request)
    {
        $sessionId = $request->session()->getId();
        
        // Actualizar la sesión actual
        Session::where('id', $sessionId)->update([
            'logout_at' => now()
        ]);

        // Actualizar el último registro en el historial
        HistorySession::where('user_id', Auth::id())
            ->whereNull('logout_at')
            ->latest()
            ->first()
            ?->update(['logout_at' => now()]);
    }

    /**
     * Obtiene la ubicación aproximada basada en la IP
     */
    protected function getLocation($ip)
    {
        // Si es localhost o IP privada
        if ($ip == '127.0.0.1' || substr($ip, 0, 3) === '10.' || 
            substr($ip, 0, 8) === '192.168.') {
            return 'Local/Red Privada';
        }
        
        // Si está en un entorno de pruebas con IPs conocidas
        if (in_array($ip, ['::1', 'localhost'])) {
            return 'Entorno de Pruebas';
        }
    
        // Usar un servicio más confiable en producción
        try {
            if (config('app.env') === 'production') {
                // Opción 1: Usar ip-api con límite de 45 requests/minuto
                $response = file_get_contents("http://ip-api.com/json/{$ip}?fields=status,message,country,city");
                $data = json_decode($response);
                
                if ($data && $data->status == 'success') {
                    return "{$data->city}, {$data->country}";
                }
                
                // Opción 2: Usar un servicio alternativo si el primero falla
                $response = file_get_contents("https://ipinfo.io/{$ip}/json?token=TU_TOKEN_AQUI");
                $data = json_decode($response);
                
                if (isset($data->city) && isset($data->country)) {
                    return "{$data->city}, {$data->country}";
                }
            }
        } catch (\Exception $e) {

        }
        
        return 'Ubicación no disponible';
    }

    protected function getDeviceDetails(Request $request)
    {
        $result = new Parser($request->header('User-Agent'));
        $deviceInfo = [];

        // Obtener información del dispositivo
        if ($result->device->type) {
            $deviceInfo['type'] = ucfirst($result->device->type);
        }
        
        if ($result->device->manufacturer) {
            $deviceInfo['manufacturer'] = $result->device->manufacturer;
        }
        
        if ($result->device->model) {
            $deviceInfo['model'] = $result->device->model;
        }

        // Construir la cadena del dispositivo
        $device = [];
        if (!empty($deviceInfo['manufacturer'])) {
            $device[] = $deviceInfo['manufacturer'];
        }
        if (!empty($deviceInfo['model'])) {
            $device[] = $deviceInfo['model'];
        }
        if (!empty($deviceInfo['type']) && empty($device)) {
            $device[] = $deviceInfo['type'];
        }

        // Obtener información del navegador
        $browser = $result->browser->name . ' ' . $result->browser->version->toString();

        // Obtener información detallada del sistema operativo
        $platform = [];
        if ($result->os->name) {
            $platform[] = $result->os->name;
        }
        if ($result->os->version) {
            $platform[] = $result->os->version->toString();
        }

        return [
            'device' => !empty($device) ? implode(' ', $device) : 'Dispositivo desconocido',
            'browser' => $browser ?: 'Navegador desconocido',
            'platform' => !empty($platform) ? implode(' ', $platform) : 'Sistema operativo desconocido'
        ];
    }
}
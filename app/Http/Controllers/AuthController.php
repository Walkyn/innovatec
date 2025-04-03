<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Session;
use App\Models\HistorySession;
use hisorange\BrowserDetect\Parser as Browser;
use WhichBrowser\Parser;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Debe ingresar su correo electrónico.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'password.required' => 'Debe ingresar su contraseña.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Registrar la sesión exitosa
            $this->registerSuccessfulLogin($request, $user);

            // Establecer la variable de sesión para mostrar el modal de ubicación
            $request->session()->flash('login_successful', true);

            // Verificar si el usuario es administrador o empleado
            if ($user->id_rol === 1) {
                return redirect()->route('home.index');
            } else {
                $modulos = $user->modulos;

                if ($modulos->isEmpty()) {
                    Auth::logout();
                    return redirect()->route('forbidden');
                }

                // Redirigir al primer módulo que tenga asignado
                $primerModulo = $modulos->first();

                if ($primerModulo->nombre_modulo === 'manage') {
                    return redirect()->route('services.index');
                }

                // Redirigir al módulo correspondiente
                return redirect()->route($primerModulo->nombre_modulo . '.index');
            }
        }

        // Registrar intento fallido de login si el email existe
        $this->registerFailedLoginAttempt($request);

        return redirect()->route('login')->with([
            'errorDetails' => 'Credenciales incorrectas, por favor intenta otra vez',
        ])->withInput();
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
        $request->session()->start(); // Asegurar que la sesión esté iniciada
        $sessionId = $request->session()->getId();
        
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
            $request->session()->start(); // Asegurar que la sesión esté iniciada
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
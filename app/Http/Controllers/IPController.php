<?php

namespace App\Http\Controllers;

use App\Models\Ip;
use Illuminate\Http\Request;

class IpController extends Controller
{
    public function index(Request $request)
    {
        $query = Ip::with('contratoServicio.contrato.cliente');
        
        // Filtrar por rango de IP específico si se proporciona
        if ($request->filled('ip_range')) {
            $ipRange = $request->ip_range;
            $query->where('ip_address', 'like', $ipRange . '.%');
        }
        
        // Obtener las IPs y ordenarlas
        $ips = $query->get()->sortBy(function ($ip) {
            return ip2long($ip->ip_address);
        });
        
        return view('ips.index', compact('ips'));
    }

    public function store(Request $request)
    {
        // IP individual
        if ($request->filled('ip_address')) {
            try {
                $request->validate([
                    'ip_address' => 'required|ip|unique:ips,ip_address',
                ]);
            
                \App\Models\Ip::create([
                    'ip_address' => $request->ip_address,
                ]);
            
                return redirect()->route('ips.index')->with([
                    'successMessage' => 'Éxito',
                    'successDetails' => 'IP guardada correctamente.',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Capturar específicamente errores de validación
                return redirect()->route('ips.index')->with([
                    'errorMessage' => 'Error',
                    'errorDetails' => 'La IP ' . $request->ip_address . ' ya existe en la base de datos.',
                ]);
            }
        }
    
        // Rango de IPs
        if ($request->filled('ip_start') && $request->filled('ip_end')) {
            try {
                $request->validate([
                    'ip_start' => 'required|ip',
                    'ip_end' => 'required|ip',
                ]);
            
                $ips = $this->generateIpRange($request->ip_start, $request->ip_end);
            
                $nuevas = 0;
                $existentes = 0;
                foreach ($ips as $ip) {
                    if (!\App\Models\Ip::where('ip_address', $ip)->exists()) {
                        \App\Models\Ip::create([
                            'ip_address' => $ip,
                        ]);
                        $nuevas++;
                    } else {
                        $existentes++;
                    }
                }
            
                if ($nuevas > 0) {
                    $mensaje = "$nuevas IPs generadas correctamente.";
                    if ($existentes > 0) {
                        $mensaje .= " $existentes ya existen y no se agregaron.";
                    }
                    return redirect()->route('ips.index')->with([
                        'successMessage' => 'Éxito',
                        'successDetails' => $mensaje,
                    ]);
                } else {
                    return redirect()->route('ips.index')->with([
                        'errorMessage' => 'Error',
                        'errorDetails' => 'Todas las IPs del rango ya existen en la base de datos.',
                    ]);
                }
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Capturar errores de validación
                return redirect()->route('ips.index')->with([
                    'errorMessage' => 'Error',
                    'errorDetails' => 'Error de validación: ' . implode(', ', $e->errors()['ip_start'] ?? $e->errors()['ip_end'] ?? ['Formato de IP incorrecto']),
                ]);
            }
        }

        return redirect()->route('ips.index')->with([
            'errorMessage' => 'Error',
            'errorDetails' => 'Debe proporcionar una dirección IP o un rango de IPs.',
        ]);
    }

    private function generateIpRange($startIp, $endIp)
    {
        $start = ip2long($startIp);
        $end = ip2long($endIp);

        if ($start === false || $end === false || $start > $end) {
            return [];
        }

        $ips = [];
        for ($ip = $start; $ip <= $end; $ip++) {
            $ips[] = long2ip($ip);
        }
        return $ips;
    }

    public function destroy($id)
    {
        $ip = \App\Models\Ip::findOrFail($id);
        $ip->delete();

        return redirect()->route('ips.index')->with([
            'successMessage' => 'Éxito',
            'successDetails' => 'IP eliminada correctamente.',
        ]);
    }

    public function ping(Request $request)
    {
        try {
            $request->validate([
                'ip' => 'required|ip'
            ]);

            $ip = $request->ip;

            // Detecta el sistema operativo para el comando correcto
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $cmd = "ping -n 2 " . escapeshellarg($ip);
            } else {
                $cmd = "ping -c 2 " . escapeshellarg($ip);
            }

            $output = shell_exec($cmd);

            // Validar que $output sea una cadena no vacía y contenga caracteres imprimibles
            if (!is_string($output) || trim($output) === '') {
                return response()->json([
                    'output' => 'No se pudo obtener respuesta del ping. (¿Está habilitado el comando ping en el servidor?)'
                ]);
            }

            // Si ya está en UTF-8, no hace falta convertir
            if (!mb_detect_encoding($output, 'UTF-8', true)) {
                $output = mb_convert_encoding($output, 'UTF-8');
            }

            return response()->json([
                'output' => $output
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'output' => 'Error interno al realizar el ping: ' . $e->getMessage()
            ], 500);
        }
    }

} 
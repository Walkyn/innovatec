<?php

namespace App\Http\Controllers;

use App\Models\Ip;
use Illuminate\Http\Request;

class IpController extends Controller
{
    public function index()
    {
        $ips = \App\Models\Ip::with('contratoServicio.contrato.cliente')->paginate(10);
        return view('ips.index', compact('ips'));
    }

    public function store(Request $request)
    {
        // IP individual
        if ($request->filled('ip_address')) {
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
        }
    
        // Rango de IPs
        if ($request->filled('ip_start') && $request->filled('ip_end')) {
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
                    $mensaje .= " $existentes ya existían y no se agregaron.";
                }
                return redirect()->route('ips.index')->with([
                    'successMessage' => 'Éxito',
                    'successDetails' => $mensaje,
                ]);
            } else {
                return redirect()->route('ips.index')->with([
                    'warningMessage' => 'Advertencia',
                    'warningDetails' => 'Todas las IPs del rango ya existían en la base de datos.',
                ]);
            }
        }

        return redirect()->route('ips.index')->with([
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

    // Aquí puedes agregar los métodos store, update, destroy, etc.
} 
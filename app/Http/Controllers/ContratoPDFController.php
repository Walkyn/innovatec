<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\ConfiguracionEmpresa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ContratoPDFController extends Controller
{
    public function generatePDF($id)
    {
        $contrato = Contrato::with(['cliente', 'servicios.planes', 'contratoServicios'])->findOrFail($id);
        $configuracion = ConfiguracionEmpresa::first();

        // Obtener los detalles de los servicios con sus fechas de suspensión
        $detallesServicios = $contrato->contratoServicios->map(function ($servicio) {
            return [
                'nombre' => $servicio->servicio->nombre,
                'plan' => $servicio->plan ? $servicio->plan->nombre : 'N/A',
                'ip_servicio' => $servicio->ip_servicio,
                'fecha_servicio' => $servicio->fecha_servicio ? \Carbon\Carbon::parse($servicio->fecha_servicio)->format('d/m/Y') : 'N/A',
                'fecha_suspension_servicio' => $servicio->fecha_suspension_servicio ? \Carbon\Carbon::parse($servicio->fecha_suspension_servicio)->format('d/m/Y') : 'N/A',
                'estado' => $servicio->estado_servicio_cliente,
                'precio' => $servicio->plan ? $servicio->plan->precio : 0
            ];
        });

        $data = [
            'contrato' => $contrato,
            'configuracion' => $configuracion ?? new ConfiguracionEmpresa(),
            'fecha_actual' => now()->format('d/m/Y'),
            'detallesServicios' => $detallesServicios,
            'total' => $contrato->contratoServicios
                ->where('estado_servicio_cliente', 'activo')
                ->sum(function ($servicio) {
                    return $servicio->plan ? $servicio->plan->precio : 0;
                })
        ];

        $pdf = PDF::loadView('pdf.contrato', $data);
        
        $codigoContrato = 'CTR-' . str_pad($contrato->id, 5, '0', STR_PAD_LEFT);
        $nombreCliente = strtoupper($contrato->cliente->nombres . ' ' . $contrato->cliente->apellidos);
        $nombreArchivo = $codigoContrato . ' - ' . $nombreCliente . '.pdf';
        
        return $pdf->stream($nombreArchivo);
    }
} 
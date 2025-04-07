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

        $data = [
            'contrato' => $contrato,
            'configuracion' => $configuracion ?? new ConfiguracionEmpresa(),
            'fecha_actual' => now()->format('d/m/Y'),
        ];

        $pdf = PDF::loadView('pdf.contrato', $data);
        
        $codigoContrato = 'CTR-' . str_pad($contrato->id, 5, '0', STR_PAD_LEFT);
        $nombreCliente = strtoupper($contrato->cliente->nombres . ' ' . $contrato->cliente->apellidos);
        $nombreArchivo = $codigoContrato . ' - ' . $nombreCliente . '.pdf';
        
        return $pdf->stream($nombreArchivo);
    }
} 
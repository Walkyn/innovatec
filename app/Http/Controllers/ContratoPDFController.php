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
        
        return $pdf->stream('contrato-' . $contrato->id . '.pdf');
    }
} 
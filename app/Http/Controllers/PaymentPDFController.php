<?php

namespace App\Http\Controllers;

use App\Models\Cobranza;
use App\Models\ConfiguracionEmpresa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PaymentPDFController extends Controller
{
    public function generatePDF($id)
    {
        $cobranza = Cobranza::with([
            'cliente',
            'cobranzaContratoServicios.contratoServicio.servicio',
            'cobranzaContratoServicios.contratoServicio.plan',
            'cobranzaContratoServicios.mes'
        ])->findOrFail($id);

        $configuracion = ConfiguracionEmpresa::first();

        // Obtener los detalles de los servicios cobrados
        $detallesServicios = $cobranza->cobranzaContratoServicios->map(function ($cobranzaServicio) {
            return [
                'nombre' => $cobranzaServicio->contratoServicio->servicio->nombre,
                'plan' => $cobranzaServicio->contratoServicio->plan ? $cobranzaServicio->contratoServicio->plan->nombre : 'N/A',
                'mes' => $cobranzaServicio->mes->nombre . ' ' . $cobranzaServicio->mes->anio,
                'estado' => $cobranzaServicio->estado_pago,
                'precio' => $cobranzaServicio->monto_pagado
            ];
        });

        $data = [
            'cobranza' => $cobranza,
            'configuracion' => $configuracion ?? new ConfiguracionEmpresa(),
            'fecha_actual' => now()->format('d/m/Y'),
            'detallesServicios' => $detallesServicios,
            'total' => $cobranza->monto_total
        ];

        $pdf = PDF::loadView('pdf.factura', $data);
        
        $numeroBoleta = 'B' . str_pad($cobranza->numero_boleta, 5, '0', STR_PAD_LEFT);
        $nombreCliente = strtoupper($cobranza->cliente->nombres . ' ' . $cobranza->cliente->apellidos);
        $nombreArchivo = $numeroBoleta . ' - ' . $nombreCliente . '.pdf';
        
        return $pdf->stream($nombreArchivo);
    }
} 
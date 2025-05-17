<?php

namespace App\Http\Controllers;

use App\Models\Cobranza;
use App\Models\ConfiguracionEmpresa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\Result\ResultInterface;

class TicketController extends Controller
{
    public function generateTicket($id)
    {
        $cobranza = Cobranza::with([
            'cliente',
            'cobranzaContratoServicios.contratoServicio.servicio',
            'cobranzaContratoServicios.contratoServicio.plan',
            'cobranzaContratoServicios.mes'
        ])->findOrFail($id);

        $configuracion = ConfiguracionEmpresa::first();
        $ticketUrl = route('payments.ticket', $cobranza->id);

        $qrCode = new QrCode($ticketUrl);
        $writer = new PngWriter();
        $result = $writer->write($qrCode, null, null, [
             'size' => 80,
             'margin' => 1,
        ]);

        $qrCodeBase64 = $result->getDataUri();

        $logoUrl = ($configuracion && $configuracion->logo)
                   ? asset('storage/logos/' . $configuracion->logo)
                   : null;

        return view('tickets.payment', compact('cobranza', 'logoUrl', 'configuracion', 'qrCodeBase64'));
    }
}
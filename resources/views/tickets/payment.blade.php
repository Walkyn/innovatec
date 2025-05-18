<!DOCTYPE html>
<html>
<head>
    <title>Ticket de Pago #{{ $cobranza->numero_boleta }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            width: 80mm;
            margin: 0 auto;
            padding: 0;
            font-size: 11px;
            line-height: 1.4;
            color: #000;
            background-color: #fff;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .ticket-container {
            padding: 5mm;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 12px;
        }
        .header p {
            margin: 0;
            font-size: 10px;
        }
        .logo {
            max-width: 40mm;
            height: auto;
            margin: 0 auto 5px auto;
            display: block;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }
        .info-section {
            margin-bottom: 10px;
        }
        .info-section p {
             margin: 2px 0;
        }
        .info-section strong {
            display: inline-block;
            min-width: 25mm;
            font-weight: bold;
        }
        .items-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 10px;
            border-radius: 4px;
            overflow: hidden;
        }
        .items-table th, .items-table td {
            padding: 4px 2px;
            text-align: left;
            word-break: break-word;
            border-bottom: 1px solid #e5e7eb;
        }
        .items-table th {
            font-weight: 600;
            font-size: 10px;
            background-color: #111827;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 6px 2px;
        }
        .items-table td {
            font-size: 11px;
            background-color: #fff;
        }
        .items-table tr:last-child td {
            border-bottom: none;
        }
        .items-table th:nth-child(1), .items-table td:nth-child(1) { 
            width: 5%; 
            padding-left: 4px;
        }
        .items-table th:nth-child(2), .items-table td:nth-child(2) { 
            width: 45%; 
            padding-left: 4px;
        }
        .items-table th:nth-child(3), .items-table td:nth-child(3) { 
            width: 25%; 
            text-align: center; 
        }
        .items-table th:nth-child(4), .items-table td:nth-child(4) { 
            width: 25%; 
            text-align: right;
            padding-right: 4px;
        }
        .items-table tbody tr:hover td {
            background-color: #f9fafb;
        }
        .totals {
            text-align: right;
            margin-top: 5px;
        }
        .totals p {
            margin: 2px 0;
        }
        .totals strong {
             display: inline-block;
             min-width: 20mm;
             font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 10px;
        }
        .glosa {
            margin-top: 10px;
            font-size: 10px;
        }
        .glosa p {
            margin: 0;
        }
        .qr-code {
            text-align: center;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .qr-code p {
             font-size: 9px;
             margin-bottom: 5px;
        }
        .qr-code img {
            display: block;
            margin: 0 auto;
            max-width: 40mm;
            height: auto;
        }
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                margin: 0;
                padding: 0;
                print-optimization: text;
            }
            .ticket-container {
                padding: 0 5mm;
            }
             @page {
                 margin: 0;
                 size: 80mm auto;
             }
             * {
                 box-sizing: border-box;
             }
             table, img {
                 max-width: 100%;
                 page-break-inside: auto;
             }
             tr, td, th {
                 page-break-inside: avoid;
                 page-break-after: auto;
             }
             thead {
                 display: table-header-group;
             }
             tfoot {
                 display: table-footer-group;
             }
             body {
                 color: #000 !important;
                 background-color: #fff !important;
             }
             p, span, div, table, th, td, h2 {
                 -webkit-font-smoothing: none !important;
                 -moz-osx-font-smoothing: none !important;
                 text-rendering: optimizeSpeed !important;
             }
              .qr-code img {
                 max-width: 25mm !important;
                 image-rendering: optimizeSpeed;
             }
             .items-table {
                 border-collapse: collapse;
             }
             .items-table th {
                 background-color: #111827 !important;
                 -webkit-print-color-adjust: exact !important;
                 print-color-adjust: exact !important;
                 color: #fff !important;
                 border-bottom: 1px solid #374151 !important;
             }
             .items-table td {
                 border-bottom: 1px solid #e5e7eb !important;
             }
             .items-table tbody tr:hover td {
                 background-color: transparent !important;
             }
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="header">
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="Logo Empresa" class="logo">
            @endif

            <h2>{{ $configuracion->nombre ?? 'Nombre de la Empresa' }}</h2>
            <div class="divider"></div>
            <p style="font-size: 11px; font-weight: bold;">TICKET DE VENTA</p>
            <div class="divider"></div>
        </div>

        <div class="info-section">
            <p><strong>N° Boleta:</strong> B{{ $cobranza->numero_boleta }}</p>
            <p><strong>Fecha:</strong> {{ $cobranza->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Tipo de Pago:</strong> {{ $cobranza->tipo_pago ? ucfirst($cobranza->tipo_pago) : 'N/A' }}</p>
            <p><strong>Estado:</strong> {{ $cobranza->estado_cobro ? ucfirst($cobranza->estado_cobro) : 'N/A' }}</p>
        </div>

        <div class="divider"></div>

        <div class="info-section">
            <p><strong>Cliente:</strong> {{ $cobranza->cliente->nombres ?? '' }} {{ $cobranza->cliente->apellidos ?? '' }}</p>
            <p><strong>{{
                ($cobranza->cliente->identificacion ? (strlen($cobranza->cliente->identificacion) === 8 ? 'DNI' : (preg_match('/^(10|20)/', $cobranza->cliente->identificacion) ? 'RUC' : 'Identificación')) : 'Identificación')
            }}:</strong> {{ $cobranza->cliente->identificacion ?? 'N/A' }}</p>
            <p><strong>Teléfono:</strong> {{ $cobranza->cliente->telefono ?? 'N/A' }}</p>
            <p><strong>Dirección:</strong> {{ $cobranza->cliente->direccion ?? 'N/A' }}</p>
        </div>

         <div class="divider"></div>
         <p style="text-align:center; margin-bottom: 5px; font-weight: bold;">DETALLES DE SERVICIOS</p>
         <div class="divider"></div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descripción</th>
                    <th style="text-align: center;">Mes</th>
                    <th style="text-align: right;">Monto</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cobranza->cobranzaContratoServicios as $index => $ccs)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ ($ccs->contratoServicio->servicio->nombre ?? '') . ($ccs->contratoServicio->plan->nombre ? ' - ' . $ccs->contratoServicio->plan->nombre : '') }}</td>
                        <td style="text-align: center;">
                            @if($ccs->mes)
                                 {{ \Carbon\Carbon::createFromDate($ccs->mes->año, $ccs->mes->numero, 1)->translatedFormat('F Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                         <td style="text-align: right;">S/. {{ number_format($ccs->monto_pagado ?? $ccs->contratoServicio->precio_acordado ?? 0, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">No hay servicios facturados en esta cobranza.</td>
                        </tr>
                @endforelse
            </tbody>
        </table>

         <div class="divider"></div>

        <div class="totals">
             <p style="font-size: 14px;"><strong>Total:</strong> S/. {{ number_format($cobranza->monto_total, 2) }}</p>
        </div>

         <div class="divider"></div>

         <div class="glosa">
             <p style="font-weight: bold;">Glosa:</p>
             <p>{{ $cobranza->glosa ?? 'Sin notas adicionales.' }}</p>
         </div>



        <div class="qr-code">
             <p>Escanear para ver ticket</p>
             <img src="{{ $qrCodeBase64 ?? '' }}" alt="QR Code Ticket">
         </div>



        <div class="footer">
            @if($configuracion)
                 <p>{{ $configuracion->direccion ?? '' }}</p>
                 <p>Tel: {{ $configuracion->telefono ?? '' }} | RUC: {{ $configuracion->ruc ?? '' }}</p>
                 <p>{{ $configuracion->web ?? '' }}</p>
            @endif
            <p>Documento generado el {{ date('d/m/Y H:i') }}</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
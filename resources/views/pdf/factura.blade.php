<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Boleta de Venta {{ $cobranza->numero_boleta }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        .invoice-header {
            padding: 20px;
            position: relative;
            height: 120px;
            border-bottom: 2px solid #1a1a1a;
        }

        .invoice-title {
            font-size: 32px;
            font-weight: bold;
            position: absolute;
            top: 20px;
            left: 20px;
            color: #1a1a1a;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            position: absolute;
            top: 70px;
            left: 20px;
            color: #1a1a1a;
        }

        .company-logo {
            position: absolute;
            top: 20px;
            right: 20px;
            max-width: 150px;
        }

        .invoice-body {
            padding: 20px;
        }

        .company-info {
            text-align: right;
            margin-bottom: 20px;
            color: #1a1a1a;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .invoice-details {
            float: left;
            width: 45%;
        }

        .invoice-to {
            float: right;
            width: 45%;
        }

        .section-title {
            color: #1a1a1a;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 2px solid #1a1a1a;
            padding-bottom: 5px;
        }

        .services-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            clear: both;
        }

        .services-table th {
            background-color: #1a1a1a;
            color: white;
            padding: 10px;
            text-align: left;
        }

        .services-table th.text-right {
            text-align: right;
            padding-right: 20px;
        }

        .services-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            vertical-align: top;
            color: #1a1a1a;
        }

        .services-table .text-right {
            text-align: right;
            padding-right: 20px;
        }

        .totals {
            float: right;
            width: 35%;
            margin-top: 20px;
        }

        .totals table {
            width: 100%;
        }

        .totals td {
            padding: 5px;
            color: #1a1a1a;
        }

        .totals td:last-child {
            text-align: right;
            padding-right: 20px;
        }

        .totals .total-line {
            border-top: 2px solid #1a1a1a;
            font-weight: bold;
        }

        .payment-info {
            clear: both;
            padding-top: 20px;
            margin-bottom: 60px;
            color: #1a1a1a;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #e4b87c;
            height: 30px;
            text-align: center;
            padding-top: 10px;
            font-size: 10px;
            color: #1a1a1a;
            border-top: none;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <div class="invoice-title">BOLETA DE VENTA</div>
        <div class="company-name">{{ $configuracion->nombre ?? 'Nombre de la Empresa' }}</div>
        @if ($configuracion->logo)
            <img src="{{ public_path('storage/logos/' . $configuracion->logo) }}" alt="Logo" class="company-logo">
        @else
            <img src="{{ public_path('images/logo/logo.png') }}" alt="Logo por defecto" class="company-logo">
        @endif
    </div>

    <div class="invoice-body">
        <div class="company-info">
            <p>{{ $configuracion->direccion ?? 'Dirección de la Empresa' }}</p>
            <p>Tel: {{ $configuracion->telefono ?? 'Teléfono' }} | RUC: {{ $configuracion->ruc ?? 'RUC' }}</p>
        </div>

        <div class="clearfix">
            <div class="invoice-details">
                <div class="section-title">INFORMACIÓN DE LA BOLETA</div>
                <p><strong>N° Boleta:</strong> B{{ str_pad($cobranza->numero_boleta, 5, '0', STR_PAD_LEFT) }}</p>
                <p><strong>Fecha:</strong> {{ $cobranza->fecha_cobro->format('d-m-Y') }}</p>
                <p><strong>Tipo de Pago:</strong> {{ ucfirst($cobranza->tipo_pago) }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($cobranza->estado_cobro) }}</p>
            </div>
            <div class="invoice-to">
                <div class="section-title">DATOS DEL CLIENTE</div>
                <p><strong>Nombre:</strong> {{ $cobranza->cliente->nombres }} {{ $cobranza->cliente->apellidos }}</p>
                <p><strong>{{ 
                    strlen($cobranza->cliente->identificacion) === 8 ? 'DNI' : 
                    (preg_match('/^(10|20)/', $cobranza->cliente->identificacion) ? 'RUC' : 'DNI') 
                }}:</strong> {{ $cobranza->cliente->identificacion }}</p>
                <p><strong>Teléfono:</strong> {{ $cobranza->cliente->telefono }}</p>
                <p><strong>Dirección:</strong> {{ $cobranza->cliente->direccion }}</p>
            </div>
        </div>

        <div class="section-title">SERVICIOS FACTURADOS</div>
        <table class="services-table">
            <thead>
                <tr>
                    <th style="width: 5%;">Item</th>
                    <th style="width: 45%;">Descripción</th>
                    <th style="width: 20%;">Mes</th>
                    <th style="width: 15%;">Estado</th>
                    <th style="width: 15%;" class="text-right">Monto</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cobranza->cobranzaContratoServicios as $index => $detalle)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detalle->contratoServicio->servicio->nombre }} - {{ $detalle->contratoServicio->plan->nombre }}</td>
                    <td>{{ $detalle->mes->nombre }} {{ $detalle->mes->anio }}</td>
                    <td>{{ ucfirst($detalle->estado_pago) }}</td>
                    <td class="text-right">S/. {{ number_format($detalle->monto_pagado, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>S/. {{ number_format($cobranza->monto_total, 2) }}</td>
                </tr>
                <tr class="total-line">
                    <td><strong>Total</strong></td>
                    <td><strong>S/. {{ number_format($cobranza->monto_total, 2) }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="payment-info">
            <div class="section-title">OBSERVACIONES</div>
            <p>{{ $cobranza->glosa ?? 'Sin observaciones' }}</p>
        </div>
    </div>

    <div class="footer">
        {{ $configuracion->nombre ?? 'Nombre de la Empresa' }} |
        Tel: {{ $configuracion->telefono ?? 'Teléfono' }} |
        RUC: {{ $configuracion->ruc ?? 'RUC' }} |
        Documento generado el {{ now()->format('d/m/Y') }}
    </div>
</body>
</html> 
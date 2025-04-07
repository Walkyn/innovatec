<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <title>Contrato de Servicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        .invoice-header {
            baolor: #e4b87c;
            padding: 20px;
            position: relative;
            height: 120px;
        }

        .invoice-title {
            font-size: 32px;
            font-weight: bold;
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            position: absolute;
            top: 70px;
            left: 20px;
            color: #1A222C
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
            color: #4a4a4a;
        }

        .invoice-info {
            margin-bottom: 30px;
        }

        .invoice-to {
            float: right;
            width: 45%;
        }

        .invoice-details {
            float: left;
            width: 45%;
        }

        .services-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            clear: both;
        }

        .services-table th {
            background-color: #4a4a4a;
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
        }

        .totals td:last-child {
            text-align: right;
            padding-right: 20px;
        }

        .totals .total-line {
            border-top: 2px solid #4a4a4a;
            font-weight: bold;
        }

        .payment-info {
            clear: both;
            padding-top: 30px;
        }

        .signature-section {
            margin-top: 50px;
            page-break-inside: avoid;
            width: 45%;
        }

        .signature-box {
            margin-bottom: 30px;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 100%;
            margin-bottom: 5px;
        }

        .signature-title {
            margin-bottom: 2px;
            font-weight: normal;
        }

        .signature-name {
            margin-bottom: 2px;
        }

        .signature-id {
            color: #4a4a4a;
            font-size: 11px;
            margin-bottom: 20px;
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
            color: #4a4a4a;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .section-title {
            color: #4a4a4a;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 2px solid #e4b87c;
            padding-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <div class="invoice-title">CONTRATO DE SERVICIO</div>
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
                <div class="section-title">INFORMACIÓN DEL CONTRATO</div>
                <p><strong>N° Contrato:</strong> CTR-{{ str_pad($contrato->id, 6, '0', STR_PAD_LEFT) }}</p>
                <p><strong>Fecha:</strong> {{ $contrato->fecha_contrato ? $contrato->fecha_contrato->format('d-m-Y') : 'N/A' }}</p>
            </div>
            <div class="invoice-to">
                <div class="section-title">DATOS DEL CLIENTE</div>
                <p><strong>Nombre:</strong> {{ $contrato->cliente->nombres }} {{ $contrato->cliente->apellidos }}</p>
                <p><strong>DNI:</strong> {{ $contrato->cliente->identificacion }}</p>
                <p><strong>Teléfono:</strong> {{ $contrato->cliente->telefono }}</p>
                <p><strong>Dirección:</strong> {{ $contrato->cliente->direccion }}</p>
            </div>
        </div>

        <div class="section-title">SERVICIOS CONTRATADOS</div>
        <table class="services-table">
            <thead>
                <tr>
                    <th style="width: 5%;">Item</th>
                    <th style="width: 25%;">Servicio</th>
                    <th style="width: 20%;">Plan</th>
                    <th style="width: 15%;">Fecha</th>
                    <th style="width: 15%;">Estado</th>
                    <th style="width: 20%;" class="text-right">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contrato->contratoServicios as $index => $contratoServicio)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $contratoServicio->servicio->nombre }}</td>
                        <td>{{ $contratoServicio->plan->nombre }}</td>
                        <td>{{ $contratoServicio->fecha_servicio ? \Carbon\Carbon::parse($contratoServicio->fecha_servicio)->format('d-m-Y') : 'N/A' }}</td>
                        <td>{{ ucfirst($contratoServicio->estado_servicio_cliente) }}</td>
                        <td class="text-right">S/. {{ number_format($contratoServicio->plan->precio, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>S/. {{ number_format($contrato->totalPago(), 2) }}</td>
                </tr>
                <tr class="total-line">
                    <td><strong>Total</strong></td>
                    <td><strong>S/. {{ number_format($contrato->totalPago(), 2) }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="payment-info">
            <div class="section-title">OBSERVACIONES</div>
            <p>{{ $contrato->observaciones ?? 'Sin observaciones' }}</p>
        </div>

        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-title">Cliente</div>
                <div class="signature-name">{{ $contrato->cliente->nombres }} {{ $contrato->cliente->apellidos }}
                </div>
                <div class="signature-id">DNI: {{ $contrato->cliente->identificacion }}</div>
            </div>
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-title">Representante Legal</div>
                <div class="signature-name">{{ $configuracion->nombre ?? 'Nombre de la Empresa' }}</div>
                <div class="signature-id">RUC: {{ $configuracion->ruc ?? 'RUC' }}</div>
            </div>
        </div>
    </div>

    <div class="footer">
        {{ $configuracion->nombre ?? 'Nombre de la Empresa' }} |
        Tel: {{ $configuracion->telefono ?? 'Teléfono' }} |
        RUC: {{ $configuracion->ruc ?? 'RUC' }} |
        Documento generado el {{ $fecha_actual }}
    </div>
</body>

</html>

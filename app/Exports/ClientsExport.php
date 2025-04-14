<?php

namespace App\Exports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ClientsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Cliente::with(['contratos.contratoServicios.plan', 'contratos.servicios'])->get();
    }

    public function headings(): array
    {
        return [
            'APELLIDOS Y NOMBRES',
            'DNI',
            'DIRECCION O REFERENCIA',
            'PLAN CONTRATADO',
            'FECHA DE INST.',
            'N° CELULAR',
            'CONTRATOS Y SERVICIOS',
            'ESTADO CLIENTE',
            'REGIÓN',
            'PROVINCIA',
            'DISTRITO',
            'PUEBLO'
        ];
    }

    public function map($cliente): array
    {
        $contratoActivo = $cliente->contratos
            ->where('estado_contrato', 'ACTIVO')
            ->sortByDesc('fecha_contrato')
            ->first();

        $planInfo = '';
        if ($contratoActivo && $contratoActivo->contratoServicios->first()) {
            $contratoServicio = $contratoActivo->contratoServicios->first();
            $servicioNombre = $contratoServicio->servicio->nombre ?? 'Sin servicio';
            $planNombre = $contratoServicio->plan->nombre ?? 'Sin plan';
            $precio = $contratoServicio->plan->precio ?? '0';
            
            $planInfo = sprintf(
                "%s - %s (S/. %s)",
                $servicioNombre,
                $planNombre,
                $precio
            );
        }

        $contratosInfo = [];
        foreach ($cliente->contratos as $contrato) {
            $serviciosDeContrato = [];
            foreach ($contrato->contratoServicios as $contratoServicio) {
                $servicioNombre = $contratoServicio->servicio->nombre ?? 'Sin servicio';
                $planNombre = $contratoServicio->plan->nombre ?? 'Sin plan';
                $precio = $contratoServicio->plan->precio ?? '0';
                
                $serviciosDeContrato[] = sprintf(
                    "%s - %s (S/. %s) [%s]",
                    $servicioNombre,
                    $planNombre,
                    $precio,
                    $contratoServicio->estado_servicio_cliente
                );
            }
            
            $codigoContrato = sprintf("CTR-%05d", $contrato->id);
            
            $contratosInfo[] = sprintf(
                "%s: %s | Estado: %s | IP: %s",
                $codigoContrato,
                implode(' + ', $serviciosDeContrato),
                $contrato->estado_contrato,
                $contrato->contratoServicios->first()->ip_servicio ?? 'N/A'
            );
        }

        // Manejo seguro de la fecha
        $fechaInstalacion = '';
        if ($cliente->created_at) {
            if (is_string($cliente->created_at)) {
                $fechaInstalacion = \Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y');
            } else {
                $fechaInstalacion = $cliente->created_at->format('d/m/Y');
            }
        }

        // Obtener todos los planes activos
        $planesContratados = [];
        foreach ($cliente->contratos as $contrato) {
            foreach ($contrato->contratoServicios as $contratoServicio) {
                $planNombre = $contratoServicio->plan->nombre ?? 'Sin plan';
                $precio = $contratoServicio->plan->precio ?? '0';
                $planesContratados[] = sprintf("%s (S/. %s)", $planNombre, $precio);
            }
        }

        return [
            strtoupper($cliente->apellidos . ' ' . $cliente->nombres),
            $cliente->identificacion,
            strtoupper($cliente->direccion),
            implode("\n", $planesContratados),  // Todos los planes en líneas separadas
            $fechaInstalacion,
            $cliente->telefono,
            implode("\n", $contratosInfo),
            $cliente->estado_cliente,
            $cliente->region->nombre ?? '',
            $cliente->provincia->nombre ?? '',
            $cliente->distrito->nombre ?? '',
            $cliente->pueblo->nombre ?? ''
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->applyFromArray([
            'font' => [
                'bold' => true
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F3F4F6']
            ]
        ]);

        $sheet->getStyle($sheet->calculateWorksheetDimension())->applyFromArray([
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ]
        ]);

        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(12);
        $sheet->getColumnDimension('C')->setWidth(35);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(12);
        $sheet->getColumnDimension('G')->setWidth(100);

        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        $sheet->getDefaultRowDimension()->setRowHeight(20);
        $sheet->getRowDimension(1)->setRowHeight(25);

        $sheet->getStyle('G1:G'.$lastRow)->getAlignment()->setWrapText(true);

        // Añadir wrap text para la columna de planes contratados
        $sheet->getStyle('D1:D'.$lastRow)->getAlignment()->setWrapText(true);

        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F3F4F6']
                ]
            ],
        ];
    }
} 
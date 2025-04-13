<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ClientesImport;
use App\Models\ImportLog;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    public function descargarPlantilla()
    {
        // Crear un nuevo libro de Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establecer los encabezados
        $headers = [
            'A1' => 'APELLIDOS Y NOMBRES',
            'B1' => 'DNI',
            'C1' => 'DIRECCION O REFERENCIA',
            'D1' => 'PLAN CONTRATADO',
            'E1' => 'FECHA DE INST.',
            'F1' => 'N° CELULAR'
        ];

        // Aplicar los encabezados y estilo
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }

        // Agregar datos de ejemplo
        $exampleData = [
            [
                'ANACELI RUIZ CORONEL',
                '23529183',
                'ALUMNA DE ROOSEVELT',
                'PLAN DE 50',
                '06/07/22',
                '929 015 049'
            ]
        ];

        // Insertar datos de ejemplo
        $sheet->fromArray($exampleData, null, 'A2');

        // Ajustar el ancho de las columnas automáticamente
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Crear el archivo Excel
        $writer = new Xlsx($spreadsheet);
        
        // Configurar las cabeceras para la descarga
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="plantilla_clientes.xlsx"');
        header('Cache-Control: max-age=0');

        // Guardar el archivo directamente en la salida
        $writer->save('php://output');
        exit;
    }

    public function importClientes(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'archivo' => 'required|mimes:xlsx,xls|max:50000'
            ]);

            $import = new ClientesImport();
            Excel::import($import, $request->file('archivo'));

            $totalImportados = $import->getTotalImportados();
            $totalIgnorados = $import->getTotalIgnorados();
            $clientesIgnorados = $import->getClientesIgnorados();

            // Registrar la importación
            $importLog = ImportLog::registrarImportacion(
                'excel',
                $totalImportados,
                $totalIgnorados,
                $request->file('archivo')->getClientOriginalName()
            );

            $mensaje = "Se importaron {$totalImportados} clientes exitosamente.";
            
            if ($totalIgnorados > 0) {
                $mensaje .= "\n\nClientes ignorados:\n";
                $mensaje .= "==================\n";
                
                foreach ($clientesIgnorados as $cliente) {
                    $mensaje .= "\nHoja: {$cliente['hoja']}\n";
                    $mensaje .= "Fila: {$cliente['fila']}\n";
                    $mensaje .= "Cliente: {$cliente['nombre']}\n";
                    $mensaje .= "Razón: {$cliente['razon']}\n";
                    $mensaje .= "------------------\n";
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $mensaje,
                'total_importados' => $totalImportados,
                'total_ignorados' => $totalIgnorados,
                'clientes_ignorados' => $clientesIgnorados,
                'ultima_importacion' => [
                    'fecha' => $importLog->created_at->format('d/m/Y H:i'),
                    'registros' => $totalImportados
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al importar: ' . $e->getMessage()
            ], 500);
        }
    }
} 
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ClientesImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importClientes(Request $request)
    {
        try {
            $request->validate([
                'archivo' => 'required|mimes:xlsx,xls|max:50000'
            ]);

            $import = new ClientesImport();
            Excel::import($import, $request->file('archivo'));

            $totalImportados = $import->getTotalImportados();
            $totalIgnorados = $import->getTotalIgnorados();
            $clientesIgnorados = $import->getClientesIgnorados();

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

            return response()->json([
                'success' => true,
                'message' => $mensaje,
                'total_importados' => $totalImportados,
                'total_ignorados' => $totalIgnorados,
                'clientes_ignorados' => $clientesIgnorados
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al importar: ' . $e->getMessage()
            ], 500);
        }
    }
} 
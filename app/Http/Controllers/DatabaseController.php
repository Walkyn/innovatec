<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ExportLogExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientsExport;

class DatabaseController extends Controller
{
    public function index()
    {
        return view('database.index');
    }

    public function exportarClientes()
    {
        $fecha = now()->format('d-m-Y');
        
        // Guardar el registro de exportación
        ExportLogExcel::create([
            'type' => 'excel'
        ]);

        // Disparar evento para actualizar la fecha en el frontend
        event(new \Illuminate\Support\Facades\Event([
            'fecha' => now()
        ]));

        return Excel::download(new ClientsExport, "CLIENTES_EXPORT_{$fecha}.xlsx");
    }
}

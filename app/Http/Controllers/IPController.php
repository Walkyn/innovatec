<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IP;

class IPController extends Controller
{
    public function index()
    {
        return view('ips.index');
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'ip_address' => 'required|ip',
            'estado' => 'required|in:disponible,asignada,reservada',
        ]);

        // Guardar la IP en la base de datos
        IP::create([
            'ip_address' => $request->ip_address,
            'estado' => $request->estado,
        ]);

        return redirect()->route('ips.index')->with('success', 'IP agregada correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();
        $totalUsuarios = User::count();
        $totalUsuariosActivos = User::where('last_activity', '>=', now()->subMinutes(5)->timestamp)->count();
        $cantidadClientesActivos = Cliente::where('estado_cliente', 'activo')->count();
        
        // Calcular porcentajes
        $porcentajeClientesActivos = $totalClientes > 0 ? round(($cantidadClientesActivos / $totalClientes) * 100, 2) : 0;
        $porcentajeUsuariosActivos = $totalUsuarios > 0 ? round(($totalUsuariosActivos / $totalUsuarios) * 100, 2) : 0;
        
        return view('home.index', compact(
            'totalClientes',
            'totalUsuariosActivos',
            'cantidadClientesActivos',
            'porcentajeClientesActivos',
            'porcentajeUsuariosActivos'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{

    public function index()
    {
        return view('panel.login-cliente');
    }

    public function dashboard()
    {
        return view('panel.dashboard');
    }

    public function miPerfil()
    {
        return view('panel.mi-perfil');
    }

    public function realizarPago()
    {
        return view('panel.realizar-pago');
    }

    public function historialPagos()
    {
        return view('panel.historial-pago');
    }

    public function comprobantes()
    {
        return view('panel.comprobantes');
    }

    public function mesesPendientes()
    {
        return view('panel.meses-pendientes');
    }

    public function mensajes()
    {
        return view('panel.mensajes');
    }

    public function misPagos()
    {
        return view('panel.mis-pagos');
    }
}

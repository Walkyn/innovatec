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

    public function misPagos()
    {
        return view('panel.mis-pagos');
    }
}

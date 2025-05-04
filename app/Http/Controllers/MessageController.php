<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pago;

class MessageController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('cliente')->orderBy('created_at', 'desc')->get()->map(function($pago) {
            return $pago->toArray();
        });

        return view('messages.index', compact('pagos'));
    }

    public function actualizarPago(Request $request)
    {
        $request->validate([
            'pago_id' => 'required|exists:pagos,id',
            'estado' => 'required|in:en_revision,Aprobado,Rechazado',
            'observaciones' => 'nullable|string'
        ]);
        $pago = \App\Models\Pago::find($request->pago_id);
        $pago->estado = $request->estado;
        $pago->observaciones = $request->observaciones;
        $pago->save();

        return response()->json(['success' => true]);
    }
}
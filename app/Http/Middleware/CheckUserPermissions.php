<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckUserPermissions
{
  public function handle(Request $request, Closure $next, string $modulo, string $accion)
  {
    $user = Auth::user();

    if (!$user) {
      return redirect()->route('login');
    }

    if ($user->id_rol === 1) {
      return $next($request);
    }

    // si no recivo modulo 
    if ($modulo == 'all') return $next($request);

    // query 

    $usuarioModulo = DB::table('permisos as p')
      ->join('modulos as m', 'm.id_modulo', '=', 'p.id_modulo')
      ->select('p.id_permiso', 'p.eliminar', 'p.actualizar', 'p.guardar')
      ->where('p.id_usuario', $user->id)
      ->where('m.nombre_modulo', $modulo)
      ->get()->first();

    if (!$usuarioModulo) {
      return redirect()->route('sin-permisos');
    }

    if ($accion == 'all') return $next($request);

    $acces = false;

    if ($accion === 'eliminar') $acces = !!$usuarioModulo->eliminar;
    else if ($accion === 'actualizar') $acces = !!$usuarioModulo->actualizar;
    else if ($accion === 'guardar') $acces = !!$usuarioModulo->guardar;

    if (!$acces) {
      return redirect()->back()->with('errorDetails', 'Error: Usted no tiene permisos para realizar esta accion!');
    }
    return $next($request);
  }
}

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
      if ($modulo=='all') return $next($request);
      
      
      // query 

      $usuarioModulo = DB::table('permisos as p')
      ->join('modulos as m', 'm.id_modulo', '=', 'p.id_modulo')
      ->select('p.id_permiso', 'p.eliminar', 'p.actualizar', 'p.guardar')
      ->where('p.id_usuario', $user->id)
      ->where('m.nombre_modulo', $modulo)
      ->get()->first();

      if(!$usuarioModulo){
        // Auth::logout();
        return redirect()->route('sin-permisos');
      }

      if($accion == 'all') return $next($request);
      
      $acces = false;
      
      if($accion === 'eliminar') $acces = !!$usuarioModulo->eliminar;
      else if ($accion === 'actualizar') $acces = !!$usuarioModulo->actualizar;
      else if ($accion === 'guardar') $acces = !!$usuarioModulo->guardar;

      if (!$acces) {
        return redirect()->back()->with('errorDetails', 'Error: Usted no tiene permisos para hacer esta accion!');
      }


      // ------------------------------
        

        // $routeName = $request->route()->getName();

        // if ($user->id_rol === 1) {
        //     return $next($request);
        // }

        // Obtener los módulos del usuario
        // $modulos = $user->modulos->pluck('nombre_modulo')->toArray();

        // $allowed = false;

        // if (in_array('manage', $modulos)) {
        //     $allowedRoutes = ['services', 'contracts', 'months'];
        //     foreach ($allowedRoutes as $routePrefix) {
        //         if (str_starts_with($routeName, $routePrefix)) {
        //             $allowed = true;
        //             break;
        //         }
        //     }
        // }

        // if (!$allowed) {
        //     foreach ($modulos as $modulo) {
        //         if (str_starts_with($routeName, $modulo)) {
        //             $allowed = true;
        //             break;
        //         }
        //     }
        // }

        // if (!$allowed) {
        //     Auth::logout();
        //     return redirect()->route('sin-permisos');
        // }

        return $next($request);
    }
}
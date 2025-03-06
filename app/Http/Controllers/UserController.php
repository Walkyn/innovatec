<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Modulo;
use App\Models\Permiso;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('rol')->get();
        return view('users.index', compact('users'));
    }

    public function profile()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Pasar los datos a la vista
        return view('profile', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,empleado',
        ];
    
        $messages = [
            'name.required' => 'Por favor, ingrese el nombre completo.',
            'phone.required' => 'Por favor, ingrese el número de teléfono.',
            'email.required' => 'Por favor, ingrese el correo electrónico.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'Por favor, ingrese una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'role.required' => 'Por favor, seleccione un rol.',
            'role.in' => 'El rol seleccionado no es válido.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return redirect()->route('users.create')
                ->withErrors($validator)
                ->withInput();
        }
    
        try {
            // Crear el usuario
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_rol' => $request->role === 'admin' ? 1 : 2,
            ]);
    
            // Si el rol es 'admin', asignar todos los permisos
            if ($request->role === 'admin') {
                $modules = Modulo::all();
                foreach ($modules as $module) {
                    // Guardar en usuario_modulo
                    DB::table('usuario_modulo')->insert([
                        'id_usuario' => $user->id,
                        'id_modulo' => $module->id_modulo,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
    
                    // Guardar en permisos
                    Permiso::create([
                        'id_usuario' => $user->id,
                        'id_modulo' => $module->id_modulo,
                        'eliminar' => true,
                        'actualizar' => true,
                        'guardar' => true,
                    ]);
                }
            }
            // Si el rol es 'empleado', asignar los permisos seleccionados
            elseif ($request->role === 'empleado') {
                $modules = $request->input('modules', []);
    
                foreach ($modules as $module) {
                    $modulo = Modulo::find($module['id']);
                    if ($modulo) {
                        $actions = $module['actions'] ?? [];
    
                        // Guardar en usuario_modulo
                        DB::table('usuario_modulo')->insert([
                            'id_usuario' => $user->id,
                            'id_modulo' => $modulo->id_modulo,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
    
                        // Guardar en permisos
                        Permiso::create([
                            'id_usuario' => $user->id,
                            'id_modulo' => $modulo->id_modulo,
                            'eliminar' => in_array('eliminar', $actions),
                            'actualizar' => in_array('actualizar', $actions),
                            'guardar' => in_array('guardar', $actions),
                        ]);
                    }
                }
            }
    
            return redirect()->route('users.create')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Usuario registrado con éxito',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('users.create')->with([
                'errorDetails' => 'Ocurrió un error al crear el usuario.',
            ]);
        }
    }
}

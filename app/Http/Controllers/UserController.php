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

    public function passwordReset()
    {
        return view('users.reset-password');
    }

    public function verifyEmail(Request $request)
    {
        try {
            $email = $request->input('email');

            if (empty($email)) {
                return response()->json([
                    'error' => 'El campo de correo electrónico es obligatorio.',
                ], 400);
            }

            $user = User::where('email', $email)->first();

            if (!$user) {
                return response()->json([
                    'error' => 'Correo no encontrado.',
                ], 404);
            }

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Correo no encontrado.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'password' => 'required|confirmed|min:8',
        ]);

        try {
            $user = User::findOrFail($request->id);
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('password.reset')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Contraseña actualizado con éxito',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('password.reset')->with([
                'errorMessage' => 'Error',
                'errorDetails' => 'No se pudo actualizar la contraseña. Inténtalo de nuevo.',
            ]);
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();

            return redirect()->route('users.index')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Usuario eliminado correctamente.',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with([
                'errorMessage' => 'Error',
                'errorDetails' => 'No se pudo eliminar el usuario.',
            ]);
        }
    }

    public function edit($id)
    {
        // Consulta para obtener usuario, rol, módulos y permisos
        $userData = DB::table('users as u')
            ->leftJoin('roles as r', 'u.id_rol', '=', 'r.id_rol')
            ->leftJoin('permisos as p', 'u.id', '=', 'p.id_usuario')
            ->leftJoin('modulos as m', 'p.id_modulo', '=', 'm.id_modulo')
            ->select(
                'u.id as user_id',
                'u.name as user_name',
                'u.email',
                'u.phone',
                'r.id_rol',
                'r.nombre_rol',
                'm.id_modulo',
                'm.nombre_modulo',
                'p.eliminar',
                'p.actualizar',
                'p.guardar'
            )
            ->where('u.id', $id)
            ->get();

        // Si el usuario no tiene permisos, devolver error 404
        if ($userData->isEmpty()) {
            abort(404, 'Usuario no encontrado.');
        }

        $allModulos = Modulo::all();

        // Traducciones de módulos
        $moduloTranslations = [
            'home' => 'Inicio',
            'clients' => 'Clientes',
            'manage' => 'Administrar',
            'payments' => 'Cobranzas',
            'calendar' => 'Calendario',
            'profile' => 'Perfil',
            'settings' => 'Configuración',
            'charts' => 'Gráficos',
            'database' => 'Base de Datos',
            'users' => 'Usuarios'
        ];

        // Organizar datos para la vista
        $user = (object) [
            'id' => $userData->first()->user_id,
            'name' => $userData->first()->user_name,
            'email' => $userData->first()->email,
            'phone' => $userData->first()->phone,
            'id_rol' => $userData->first()->id_rol,
            'rol' => $userData->first()->nombre_rol
        ];

        $userModulos = $userData->pluck('id_modulo')->toArray();

        $userPermisos = [];
        foreach ($userData as $permiso) {
            if ($permiso->id_modulo) {
                $userPermisos[$permiso->id_modulo] = [
                    'eliminar' => (bool) $permiso->eliminar,
                    'actualizar' => (bool) $permiso->actualizar,
                    'guardar' => (bool) $permiso->guardar,
                ];
            }
        }

        return view('users.edit', compact('user', 'allModulos', 'userModulos', 'userPermisos', 'moduloTranslations'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,empleado',
        ];

        $messages = [
            'name.required' => 'Por favor, ingrese el nombre completo.',
            'phone.required' => 'Por favor, ingrese el número de teléfono.',
            'email.required' => 'Por favor, ingrese el correo electrónico.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'role.required' => 'Por favor, seleccione un rol.',
            'role.in' => 'El rol seleccionado no es válido.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Actualizar el usuario
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'id_rol' => $request->role === 'admin' ? 1 : 2,
            ]);

            // Eliminar permisos y módulos anteriores
            DB::table('usuario_modulo')->where('id_usuario', $user->id)->delete();
            DB::table('permisos')->where('id_usuario', $user->id)->delete();

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
                    // Solo procesar módulos que estén activos
                    if (isset($module['active']) && $module['active']) {
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
            }

            return redirect()->route('users.index', $id)->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Usuario actualizado con éxito',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('users.index', $id)->with([
                'errorDetails' => 'Ocurrió un error al actualizar el usuario.',
            ]);
        }
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
            'phone_display.required' => 'Por favor, ingrese el número de teléfono.',
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfiguracionEmpresa;
use Illuminate\Support\Facades\Validator;
use App\Models\Cliente;
use Illuminate\Support\Facades\Storage;
use App\Models\MedioPago;

class SettingsController extends Controller
{
    public function index()
    {
        $company = ConfiguracionEmpresa::first();
        $cantidadClientesActivos = Cliente::where('estado_cliente', 'activo')->count();
        return view('settings.index', compact('company', 'cantidadClientesActivos'));
    }

    public function updateCover(Request $request)
    {
        try {
            // Validar la imagen
            $request->validate([
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Obtener la configuración de la empresa
            $company = ConfiguracionEmpresa::first();

            if (!$company) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró la configuración de la empresa.',
                ], 404);
            }

            // Eliminar la portada anterior si existe
            if ($company->portada) {
                $oldCoverPath = 'public/covers/' . $company->portada;
                if (Storage::exists($oldCoverPath)) {
                    Storage::delete($oldCoverPath);
                }
            }

            // Guardar la nueva portada
            $coverPath = $request->file('cover')->store('covers', 'public');
            $company->portada = basename($coverPath);
            $company->save();

            // Respuesta JSON para actualizar la vista
            return response()->json([
                'success' => true,
                'cover_url' => asset('storage/covers/' . $company->portada),
            ]);
        } catch (\Exception $e) {
            // Manejar errores
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la portada de la empresa: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateLogo(Request $request)
    {
        try {
            // Validar la imagen
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Obtener la configuración de la empresa
            $company = ConfiguracionEmpresa::first();

            if (!$company) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró la configuración de la empresa.',
                ], 404);
            }

            // Obtener el nombre del logo actual
            $currentLogo = $company->logo;

            // Eliminar el logo anterior si existe
            if ($currentLogo) {
                $oldLogoPath = public_path('storage/logos/' . $currentLogo);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath); // Eliminar el archivo
                }
            }

            // Guardar el nuevo logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            $company->logo = basename($logoPath);
            $company->save();

            // Respuesta JSON para actualizar la vista
            return response()->json([
                'success' => true,
                'logo_url' => asset('storage/logos/' . $company->logo),
            ]);
        } catch (\Exception $e) {
            // Manejar errores y devolver una respuesta JSON
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el logo de la empresa: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function create()
    {
        $mediosPago = MedioPago::all();
        
        // Mapeo de códigos a nombres completos
        $nombresMediosPago = [
            'BCP' => 'BCP',
            'BBVA' => 'BBVA',
            'BN' => 'Banco de la Nación',
            'CAJA_PIURA' => 'Caja Piura',
            'YAPE' => 'Yape',
            'PLIN' => 'Plin',
        ];
        
        // Agregar el nombre legible a cada medio de pago
        foreach ($mediosPago as $medioPago) {
            $medioPago->nombre_tipo_pago = $nombresMediosPago[$medioPago->tipo_pago] ?? $medioPago->tipo_pago;
        }
        
        $configuracion = ConfiguracionEmpresa::first();
        return view('settings.create', compact('configuracion', 'mediosPago'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:100',
                'ruc' => 'nullable|string|max:20|unique:configuracion_empresa,ruc,' . ($request->id ?? 'NULL'),
                'correo' => 'nullable|email|max:100',
                'telefono' => 'nullable|string|max:20',
                'direccion' => 'nullable|string|max:255',
                'descripcion' => 'nullable|string',
                'facebook' => 'nullable|url|max:255',
                'whatsapp' => 'nullable|string|max:50',
                'linkedin' => 'nullable|url|max:255',
                'website' => 'nullable|url|max:255',
            ]);

            $configuracion = ConfiguracionEmpresa::updateOrCreate(
                ['id' => $request->id],
                $request->all()
            );

            return redirect()->route('settings.create')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Información actualizada',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('settings.create')
                ->withInput()
                ->with('errorDetails', 'Por favor, complete todos los campos requeridos antes de guardar.');
        }
    }

    public function storeMedioPago(Request $request)
    {
        $rules = [
            'payment_type' => 'required|in:BCP,BBVA,BN,CAJA_PIURA,YAPE,PLIN',
            'account_number' => [
                'required',
                'string',
                'max:50',
                function ($attribute, $value, $fail) use ($request) {
                    // Verificar si ya existe la combinación de tipo de pago y número de cuenta
                    $exists = MedioPago::where('tipo_pago', $request->payment_type)
                        ->where('numero_cuenta', $value)
                        ->exists();

                    if ($exists) {
                        if (in_array($request->payment_type, ['YAPE', 'PLIN'])) {
                            $fail('Este número de teléfono ya está registrado para ' . $request->payment_type);
                        } else {
                            $fail('Este número de cuenta ya está registrado para ' . $request->payment_type);
                        }
                    }
                },
            ],
            'holder_name' => 'required|string|max:255',
            'payment_type_text' => 'required|string|max:50',
        ];

        $messages = [
            'payment_type.required' => 'Por favor, seleccione un medio de pago',
            'payment_type.in' => 'El medio de pago seleccionado no es válido',
            'account_number.required' => 'Por favor ingrese el número de cuenta o teléfono',
            'account_number.max' => 'El número de cuenta o teléfono no debe exceder los 50 caracteres',
            'holder_name.required' => 'Por favor ingrese el nombre del titular',
            'holder_name.max' => 'El nombre del titular no debe exceder los 255 caracteres',
        ];

        // Validaciones específicas según el tipo de pago
        if (in_array($request->payment_type, ['YAPE', 'PLIN'])) {
            $rules['account_number'] = array_merge($rules['account_number'], [
                'regex:/^9\d{8}$/'
            ]);
            $messages['account_number.regex'] = 'El número de teléfono debe empezar con 9 y tener 9 dígitos';
        } elseif ($request->payment_type === 'BCP') {
            $rules['account_number'] = array_merge($rules['account_number'], [
                'regex:/^\d{14}$/'
            ]);
            $messages['account_number.regex'] = 'El número de cuenta debe tener 14 dígitos';
        } elseif ($request->payment_type === 'BBVA') {
            $rules['account_number'] = array_merge($rules['account_number'], [
                'regex:/^\d{20}$/'
            ]);
            $messages['account_number.regex'] = 'El número de cuenta debe tener 20 dígitos';
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('errorDetails', $validator->errors()->first());
        }

        try {
            MedioPago::create([
                'tipo_pago' => $request->payment_type,
                'numero_cuenta' => $request->account_number,
                'titular' => $request->holder_name,
            ]);

            return redirect()->route('settings.create')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Medio de pago agregado correctamente',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('settings.create')
                ->withInput()
                ->with('errorDetails', 'Error al agregar el medio de pago: ' . $e->getMessage());
        }
    }

    // Método para eliminar medio de pago
    public function deleteMedioPago($id)
    {
        try {
            $medioPago = MedioPago::findOrFail($id);
            $medioPago->delete();

            return redirect()->route('settings.create')
                ->with('successMessage', 'Éxito')
                ->with('successDetails', 'Medio de pago eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('settings.create')
                ->with('errorDetails', 'Error al eliminar el medio de pago');
        }
    }

    public function storeRedesSociales(Request $request)
    {
        try {
            $request->validate([
                'facebook' => 'nullable|url|max:255',
                'whatsapp' => 'nullable|string|max:50',
                'linkedin' => 'nullable|url|max:255',
                'website' => 'nullable|url|max:255',
            ]);

            $configuracion = ConfiguracionEmpresa::updateOrCreate(
                ['id' => $request->id],
                [
                    'facebook' => $request->facebook,
                    'whatsapp' => $request->whatsapp,
                    'linkedin' => $request->linkedin,
                    'website' => $request->website,
                ]
            );

            return redirect()->route('settings.create')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Redes sociales actualizadas correctamente',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('settings.create')
                ->withInput()
                ->with('errorDetails', 'Error al actualizar las redes sociales.');
        }
    }
}

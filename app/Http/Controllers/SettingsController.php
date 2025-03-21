<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfiguracionEmpresa;
use App\Models\InfoTicket;
use Illuminate\Support\Facades\Validator;
use App\Models\Cliente;
use Illuminate\Support\Facades\Storage;

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
        $configuracion = ConfiguracionEmpresa::first();
        $infoTicket = InfoTicket::first();

        return view('settings.create', compact('configuracion', 'infoTicket'));
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
                'instagram' => 'nullable|url|max:255',
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

    public function storeRedesSociales(Request $request)
    {
        try {
            $request->validate([
                'facebook' => 'nullable|url|max:255',
                'instagram' => 'nullable|url|max:255',
                'linkedin' => 'nullable|url|max:255',
                'website' => 'nullable|url|max:255',
            ]);

            $configuracion = ConfiguracionEmpresa::updateOrCreate(
                ['id' => $request->id],
                [
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'linkedin' => $request->linkedin,
                    'website' => $request->website,
                ]
            );

            return redirect()->route('settings.create')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Redes sociales actualizados con éxito',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('settings.create')
                ->withInput()
                ->with('errorDetails', 'Complete los campos antes de guardar');
        }
    }

    public function storeInfoTicket(Request $request)
    {
        $rules = [
            'companyName' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'ruc' => 'required|string|max:20|unique:info_ticket,ruc,' . ($request->id ?? 'NULL'),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'thankYouMessage' => 'nullable|string',
            'website' => ['nullable', 'max:255', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'],
        ];

        $messages = [
            'companyName.required' => 'Por favor, ingrese el nombre de la empresa',
            'ruc.required' => 'Por favor ingrese el RUC',
            'ruc.unique' => 'El RUC ya está en uso.',
            'website.regex' => 'La URL del sitio web no es válida. Por favor, ingresa una URL válida.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();

            return redirect()->route('settings.create')
                ->with('errorDetails', $errorMessage)
                ->withInput();
        }

        try {
            $website = $request->website;
            if ($website && !preg_match('/^https?:\/\//i', $website)) {
                $website = 'http://' . $website;
            }

            $infoTicket = InfoTicket::updateOrCreate(
                ['id' => $request->id],
                [
                    'nombre_empresa' => $request->companyName,
                    'eslogan_empresa' => $request->slogan,
                    'ruc' => $request->ruc,
                    'telefono' => $request->phone,
                    'direccion' => $request->address,
                    'agradecimiento' => $request->thankYouMessage,
                    'sitio_web' => $website,
                ]
            );

            return redirect()->route('settings.create')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Información del ticket guardada correctamente.',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('settings.create')->with([
                'errorDetails' => 'Ocurrió un error al guardar la información del ticket.',
            ]);
        }
    }
}

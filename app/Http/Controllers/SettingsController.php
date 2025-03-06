<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfiguracionEmpresa;
use App\Models\InfoTicket;
use Illuminate\Support\Facades\Validator;
use App\Models\Cliente;

class SettingsController extends Controller
{
    public function index()
    {
        $configuracion = ConfiguracionEmpresa::first();
        $cantidadClientesActivos = Cliente::where('estado_cliente', 'activo')->count();
        return view('settings.index', compact('configuracion','cantidadClientesActivos'));
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

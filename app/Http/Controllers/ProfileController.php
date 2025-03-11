<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function updateCover(Request $request)
    {
        try {
            // Validar la imagen
            $request->validate([
                'cover_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Obtener el usuario autenticado
            $user = Auth::user();
    
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no autenticado.',
                ], 401);
            }
    
            // Eliminar la foto de portada anterior si existe
            if ($user->cover_photo) {
                $oldCoverPath = 'public/covers/' . $user->cover_photo;
                if (Storage::exists($oldCoverPath)) {
                    Storage::delete($oldCoverPath);
                }
            }
    
            // Guardar la nueva foto de portada
            $coverPath = $request->file('cover_photo')->store('covers', 'public');
            $user->cover_photo = basename($coverPath);
            $user->save();
    
            // Respuesta JSON para actualizar la vista
            return response()->json([
                'success' => true,
                'cover_url' => asset('storage/covers/' . $user->cover_photo),
            ]);
        } catch (\Exception $e) {
            // Manejar errores
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la foto de portada: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updatePhoto(Request $request)
    {
        try {
            // Validar la imagen
            $request->validate([
                'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Obtener el usuario autenticado
            $user = Auth::user();
    
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no autenticado.',
                ], 401);
            }
    
            // Obtener el nombre de la foto actual
            $currentPhoto = $user->profile_photo;
    
            // Eliminar la foto de perfil anterior si existe
            if ($currentPhoto) {
                $oldPhotoPath = public_path('storage/profiles/' . $currentPhoto); // Ruta completa al archivo
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath); // Eliminar el archivo
                }
            }
    
            // Guardar la nueva foto de perfil
            $photoPath = $request->file('profile_photo')->store('profiles', 'public');
            $user->profile_photo = basename($photoPath);
            $user->save();
    
            // Respuesta JSON para actualizar la vista
            return response()->json([
                'success' => true,
                'photo_url' => asset('storage/profiles/' . $user->profile_photo),
                'debug_url' => 'storage/profiles/' . $user->profile_photo,
            ]);
        } catch (\Exception $e) {
            // Manejar errores y devolver una respuesta JSON
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la foto de perfil: ' . $e->getMessage(),
            ], 500);
        }
    }
}

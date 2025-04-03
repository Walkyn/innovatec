<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Session;
use App\Models\HistorySession;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    private function getLocationDetails($latitude, $longitude)
    {
        try {
            Log::info("Intentando obtener ubicación para coordenadas: {$latitude}, {$longitude}");

            $response = Http::withHeaders([
                'User-Agent' => 'Innovatec Location Service'
            ])->get("https://nominatim.openstreetmap.org/reverse", [
                'format' => 'json',
                'lat' => $latitude,
                'lon' => $longitude,
                'zoom' => 16, // Ajustado para más precisión
                'addressdetails' => 1,
                'accept-language' => 'es'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                Log::info("Respuesta de Nominatim: " . json_encode($data));

                if (!isset($data['address'])) {
                    Log::error("No se encontró información de dirección en la respuesta");
                    return 'Ubicación no disponible';
                }

                $address = $data['address'];
                $location = [];

                // Intentar obtener el nombre del lugar más específico primero
                if (!empty($address['suburb'])) {
                    $location[] = $address['suburb'];
                } elseif (!empty($address['neighbourhood'])) {
                    $location[] = $address['neighbourhood'];
                } elseif (!empty($address['residential'])) {
                    $location[] = $address['residential'];
                }

                // Agregar ciudad/pueblo/municipio
                if (!empty($address['city'])) {
                    $location[] = $address['city'];
                } elseif (!empty($address['town'])) {
                    $location[] = $address['town'];
                } elseif (!empty($address['municipality'])) {
                    $location[] = $address['municipality'];
                } elseif (!empty($address['city_district'])) {
                    $location[] = $address['city_district'];
                } elseif (!empty($address['village'])) {
                    $location[] = $address['village'];
                }

                // Agregar distrito/condado si existe
                if (!empty($address['county'])) {
                    $location[] = $address['county'];
                } elseif (!empty($address['district'])) {
                    $location[] = $address['district'];
                }
                
                // Agregar estado/provincia/región
                if (!empty($address['state'])) {
                    $location[] = $address['state'];
                } elseif (!empty($address['region'])) {
                    $location[] = $address['region'];
                }
                
                // Agregar país
                if (!empty($address['country'])) {
                    $location[] = $address['country'];
                }

                // Filtrar duplicados y valores vacíos
                $location = array_filter(array_unique($location));
                
                if (empty($location)) {
                    Log::warning("No se pudo extraer información de ubicación de la respuesta");
                    return 'Ubicación no disponible';
                }

                $locationString = implode(', ', $location);
                Log::info("Ubicación construida: {$locationString}");
                return $locationString;
            }
            
            Log::error("Error en la respuesta de Nominatim: " . $response->status());
            return 'Ubicación no disponible';
        } catch (\Exception $e) {
            Log::error('Error al obtener detalles de ubicación: ' . $e->getMessage());
            return 'Ubicación no disponible';
        }
    }

    public function updateLocation(Request $request)
    {
        try {
            Log::info("Recibida solicitud de actualización de ubicación: " . json_encode($request->all()));
            
            // Validar los datos de entrada
            $validated = $request->validate([
                'latitude' => 'required|numeric|between:-90,90',
                'longitude' => 'required|numeric|between:-180,180',
            ]);

            $user = Auth::user();
            if (!$user) {
                Log::error('Usuario no autenticado al actualizar ubicación');
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no autenticado'
                ], 401);
            }

            $sessionId = session()->getId();
            if (!$sessionId) {
                Log::error('No se encontró ID de sesión al actualizar ubicación');
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró la sesión actual'
                ], 400);
            }

            // Obtener la ubicación detallada basada en las coordenadas
            $locationDetails = $this->getLocationDetails($validated['latitude'], $validated['longitude']);

            Log::info('Actualizando ubicación para sesión: ' . $sessionId);

            // Actualizar la sesión actual
            $session = Session::where('id', $sessionId)->first();
            if (!$session) {
                Log::error('No se encontró registro de sesión para ID: ' . $sessionId);
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró el registro de sesión'
                ], 404);
            }

            // Actualizar la sesión actual
            $session->latitude = $validated['latitude'];
            $session->longitude = $validated['longitude'];
            $session->location = $locationDetails;
            $session->save();

            Log::info('Sesión actualizada con coordenadas y ubicación: ' . $validated['latitude'] . ', ' . $validated['longitude'] . ' - ' . $locationDetails);

            // Actualizar el último registro en el historial
            $historySession = HistorySession::where('user_id', $user->id)
                ->whereNull('logout_at')
                ->latest()
                ->first();

            if ($historySession) {
                $historySession->latitude = $validated['latitude'];
                $historySession->longitude = $validated['longitude'];
                $historySession->location = $locationDetails;
                $historySession->save();

                Log::info('Historial de sesión actualizado con coordenadas y ubicación');
            } else {
                Log::warning('No se encontró registro de historial de sesión para actualizar');
            }

            return response()->json([
                'success' => true,
                'message' => 'Ubicación actualizada correctamente'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación al actualizar ubicación: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Datos de ubicación inválidos',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error al actualizar ubicación: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la ubicación: ' . $e->getMessage()
            ], 500);
        }
    }
} 
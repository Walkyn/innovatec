@extends('layouts.login')
@section('title', 'Acceso Denegado - Business Manager')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-gray-100 to-gray-300">
        <div class="text-center">
            <h1 class="mb-4 text-6xl font-semibold text-red-500">403</h1>
            <p class="mb-4 text-lg text-gray-600">¡Ups! No tienes permisos para acceder a esta página</p>
            <div class="animate-bounce">
              <svg class="mx-auto h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
              </svg>
            </div>
            <p class="mt-4 text-gray-600">Vamos a llevarte de vuelta <a href="{{ route('login') }}" class="text-blue-500">home</a>.</p>
          </div>
        </div>
    </div>
@endsection

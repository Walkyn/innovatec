<form method="POST" action="{{ route('panel.cerrar-sesion') }}" class="w-full">
    @csrf
    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
        <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
    </button>
</form> 
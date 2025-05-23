<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use App\Models\Session;
use App\Models\HistorySession;
use App\Models\Cobranza;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'id_rol',
        'last_activity'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id_rol' => 'integer',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_activity' => 'datetime',
        ];
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function modulos()
    {
        return $this->belongsToMany(Modulo::class, 'usuario_modulo', 'id_usuario', 'id_modulo');
    }

    /**
     * Obtener los permisos del usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permisos()
    {
        return $this->hasMany(Permiso::class, 'id_modulo', 'id_usuario');
    }

    public function isOnline()
    {
        return $this->last_activity && $this->last_activity->diffInMinutes(now()) < 5;
    }

    /**
     * Verifica si el usuario tiene un rol específico.
     *
     * @param string $role Nombre del rol a verificar
     * @return bool
     */
    public function hasRole($role)
    {
        if (!$this->rol) return false;
        
        // Convertir ambos a minúsculas para comparación sin importar mayúsculas/minúsculas
        $userRole = strtolower($this->rol->nombre_rol);
        $checkRole = strtolower($role);
        
        return $userRole === $checkRole;
    }

    public function checkModuloAcceso(string $modulo, string $accion)
    {

        if ($this->id_rol === 1) {
            return true;
        }

        // si no recivo modulo 
        if ($modulo == 'all') return true;

        $usuarioModulo = DB::table('permisos as p')
            ->join('modulos as m', 'm.id_modulo', '=', 'p.id_modulo')
            ->select('p.id_permiso', 'p.eliminar', 'p.actualizar', 'p.guardar')
            ->where('p.id_usuario', $this->id)
            ->where('m.nombre_modulo', $modulo)
            ->get()->first();

        if (!$usuarioModulo) {
            return false;
        }

        if ($accion == 'all') return true;

        $acces = false;

        if ($accion === 'eliminar') $acces = !!$usuarioModulo->eliminar;
        else if ($accion === 'actualizar') $acces = !!$usuarioModulo->actualizar;
        else if ($accion === 'guardar') $acces = !!$usuarioModulo->guardar;

        return $acces;
    }
    
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function historySessions()
    {
        return $this->hasMany(HistorySession::class);
    }

    public function cobranzas()
    {
        return $this->hasMany(Cobranza::class, 'usuario_id');
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'user_id');
    }
}

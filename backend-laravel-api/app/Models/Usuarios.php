<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Usuarios extends Authenticatable implements JWTSubject
{
    protected $table = 'Usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'nom_usuario',
        'dsc_email',
        'pws_senha',
        'id_perfil'
    ];

    protected $hidden = ['pws_senha'];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'id_perfil');
    }

    public function unidadeUsuario() {
        return $this->hasOne(UnidadeServico::class, 'id_unidade', 'id_unidade')->withTrashed();
    }

    // JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'perfil' => $this->id_perfil
        ];
    }

    // Campo senha customizado
    public function getAuthPassword()
    {
        return $this->pws_senha;
    }

    /*
    |--------------------------------------------------------------------------
    | Ignore remember_token
    |--------------------------------------------------------------------------
    */

    public function setAttribute($key, $value)
    {
        if ($key !== $this->getRememberTokenName()) {
            parent::setAttribute($key, $value);
        }
    }
    
}


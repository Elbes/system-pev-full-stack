<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Permissao;
use App\Models\Usuarios;

class Perfil extends Model
{
    use HasFactory, SoftDeletes, Notifiable;
	
    protected $table = 'Perfil';
    protected $primaryKey = 'id_perfil';

    protected $fillable = [];
    protected $hidden = [];
    protected $softDelete = true;

    const CREATED_AT = 'dhs_cadastro';
    const UPDATED_AT = 'dhs_atualizacao';
    const DELETED_AT = 'dhs_exclusao';

    public function usuarios()
    {
        return $this->hasMany(Usuarios::class, 'id_perfil');
    }

    public function permissoes()
    {
    	return $this->belongsToMany(Permissao::class, 'PerfilPermissao', 'id_perfil', 'id_permissao')->withTimestamps();
    }
}

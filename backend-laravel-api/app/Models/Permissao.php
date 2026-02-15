<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\Menu;
use App\Models\Perfil;

class Permissao extends Model
{
    use HasFactory;
    use SoftDeletes;
	use Notifiable;
	
    protected $table = 'Permissao';
    
    protected $primaryKey = 'id_permissao';

    protected $fillable = [];
    protected $hidden = [];
    protected $softDelete = true;

    const CREATED_AT = 'dhs_cadastro';
    const UPDATED_AT = 'dhs_atualizacao';
    const DELETED_AT = 'dhs_exclusao';
    
 
    public function perfis()
    {
    	return $this->belongsToMany(Perfil::class, 'PerfilPermissao', 'id_perfil', 'id_permissao')->withTimestamps();
    	
    }
    
    public function menu()
    {
        return $this->hasMany(Menu::class, 'id_permissao', 'id_permissao');
        
    }

    public function getPermissoes(){
        $objDefault = Permissao::withTrashed()
        ->get();

        return $objDefault;
    }
}

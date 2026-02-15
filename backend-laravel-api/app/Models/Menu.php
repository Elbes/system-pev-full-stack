<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Permissao;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;
	use Notifiable;
	
    protected $table = 'Menu';
    protected $primaryKey = 'id_menu';

    protected $fillable = [];
    protected $hidden = [];
    protected $softDelete = true;

    const CREATED_AT = 'dhs_cadastro';
    const UPDATED_AT = 'dhs_atualizacao';
    const DELETED_AT = 'dhs_exclusao';

    public function permissao_acesso()
    {
        return $this->belongsTo(Permissao::class, 'id_permissao', 'id_permissao');
    }

    public function getSubMenu()
    {
        return $this->hasMany(Menu::class, 'id_menu_referencia')->where('flg_ativo','1')->orderBy('num_ordem','ASC');
    }

    public function getPai()
    {
        return $this->belongsTo(Menu::class, 'id_menu_referencia')->where('flg_ativo','1');
    }

    public function getPaiPai()
    {
        return $this->belongsTo(Menu::class, 'id_menu_referencia');
    }

    public function getMenus(){
        $objDefault = Menu::withTrashed()
        ->get();

        return $objDefault;
    }

    public function filhos()
    {
        return $this->hasMany(Menu::class, 'id_menu_referencia')
            ->where('flg_ativo', 1)
            ->orderBy('num_ordem', 'ASC');
    }

    public function pai()
    {
        return $this->belongsTo(Menu::class, 'id_menu_referencia');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\Entradas;

class RegiaoAdministrativa extends Model
{
    use HasFactory;
    use SoftDeletes;
	use Notifiable;
	
    protected $table = 'RegiaoAdministrativa';
    protected $primaryKey = 'id_ra';

    protected $fillable = [];
    protected $hidden = [];
    protected $softDelete = true;

    const CREATED_AT = 'dhs_cadastro';
    const UPDATED_AT = 'dhs_atualizacao';
    const DELETED_AT = 'dhs_exclusao';

    public function regiaoEntrada()
    {
        return $this->hasMany(Entradas::class, 'id_ra', 'id_ra');
    }
}

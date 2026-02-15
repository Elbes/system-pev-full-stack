<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RegiaoAdministrativa;

class UnidadeServico extends Model
{
    use HasFactory;
    use SoftDeletes;
	use Notifiable;
	
    protected $table = 'UnidadeServico';
    protected $primaryKey = 'id_unidade';

    protected $fillable = ['id_unidade'];
    protected $softDelete = true;

    const CREATED_AT = 'dhs_cadastro';
    const UPDATED_AT = 'dhs_atualizacao';
    const DELETED_AT = 'dhs_exclusao';

    public function regiaoUnidade() {
        return $this->hasOne(RegiaoAdministrativa::class, 'id_ra', 'id_ra')->withTrashed();
    }

    public function getUnidades(){
        $objDefault = $this::with('regiaoUnidade')->withTrashed()
        ->get();

        return $objDefault;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\Fotos;
use App\Models\RegiaoAdministrativa;
use App\Models\TipoResiduo;
use App\Models\UnidadeServico;

class Entradas extends Model
{
    use HasFactory;
    use SoftDeletes;
	use Notifiable;
	
    protected $table = 'Entradas';
    protected $primaryKey = 'id_entrada';

    protected $fillable = ['id_entrada', 'placa_veiculo', 'id_ra', 'id_unidade', 'alerta_irregularidade',
                            'id_usuario', 'dhs_cadastro', 'dhs_atualizacao', 'dhs_exclusao'];
    protected $hidden = [];
    protected $softDelete = true;

    const CREATED_AT = 'dhs_cadastro';
    const UPDATED_AT = 'dhs_atualizacao';
    const DELETED_AT = 'dhs_exclusao';

    public function fotoEntrada()
    {
        return $this->hasMany(Fotos::class, 'id_entrada');
    }

    public function regiaoAdministrativa()
    {
        return $this->belongsTo(RegiaoAdministrativa::class, 'id_ra', 'id_ra');
    }

    public function residudoEntrada()
    {
    	return $this->belongsToMany(TipoResiduo::class, 'ResiduoEntrada', 'id_entrada', 'id_residuo');
    }

    public function entradaUnidade()
    {
        return $this->belongsTo(UnidadeServico::class, 'id_unidade', 'id_unidade');
    }

    public function getTotalUnidae(){

        $total= null;

        $total = DB::table('Entradas as t1')
           ->select('t1.id_unidade', 't2.nome', DB::raw('count(*) as count'))
           ->join('UnidadeServico as t2', 't1.id_unidade', '=', 't2.id_unidade')
            ->groupBy('t1.id_unidade','t2.nome')
            ->get();

        return $total;

    }

    public function getTotalUnidaeId($id_unidade){

        $total= null;

        $total = DB::table('Entradas as t1')
           ->select('t1.id_unidade')
           ->where('t1.id_unidade', $id_unidade)
            ->count();

        return $total;

    }
}

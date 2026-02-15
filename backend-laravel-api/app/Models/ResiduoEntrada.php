<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ResiduoEntrada extends Model
{
    use HasFactory;
    use SoftDeletes;
	use Notifiable;
	
    protected $table = 'ResiduoEntrada';
    protected $primaryKey = 'id_residuo_entrada';

    protected $fillable = [];
    protected $hidden = [];
    protected $softDelete = true;

    const CREATED_AT = 'dhs_cadastro';
    const UPDATED_AT = 'dhs_atualizacao';
    const DELETED_AT = 'dhs_exclusao';

    public function getTotalTipoResiduo($id_residuo){

        $total= null;

        $total = DB::table('ResiduoEntrada as t1')
           ->select('t1.id_residuo')
           ->join('TipoResiduo as t2', 't1.id_residuo', '=', 't2.id_residuo')
            ->where('t2.id_residuo', $id_residuo)
            //->whereRaw('EXTRACT(YEAR FROM t1.dhs_cadastro) = '.$anoSelect)
            ->count();

        return $total;

    }

    public function getResiduosAno($ano, $id_residuo){

        $total = null;
        $total['janeiro'] = 0;
        $total['fevereiro'] = 0;
        $total['marco'] = 0;
        $total['abril'] = 0;
        $total['maio'] = 0;
        $total['junho'] = 0;
        $total['julho'] = 0;
        $total['agosto'] = 0;
        $total['setembro'] = 0;
        $total['outubro'] = 0;
        $total['novembro'] = 0;
        $total['dezembro'] = 0;
  

        $data = DB::table('views_prod_mes_ano')
                 ->select('nome_residuo', 'total', 'mes', 'ano')
                 ->where('ano',"=",$ano)
                 ->where('id_residuo',"=",$id_residuo)
                 ->groupBy('nome_residuo', 'ano', 'mes', 'total')
                 ->get();

        foreach($data as $value){
            if($value->mes == 1){
                if($value->total != null && $value->total != 0){
                    $total['janeiro'] = $value->total;
                }else{
                    $total['janeiro'] = 0;
                }
            }
            if($value->mes == 2){
                if($value->total != null && $value->total != 0){
                    $total['fevereiro'] = $value->total;
                }else{
                    $total['fevereiro'] = 0;
                }
            }
            if($value->mes == 3){
                if($value->total =! null && $value->total != 0){
                    $tota['marco'] = $value->total;
                }else{
                    $total['marco'] = 0;
                }
            }
            if($value->mes == 4){
                if($value->total != null && $value->total != 0){
                    $total['abril'] = $value->total;
                }else{
                    $total['abril'] = 0;
                }
            }
            if($value->mes == 5){
                if($value->total != null && $value->total != 0){
                    $total['maio'] = $value->total;
                }else{
                    $total['maio'] = 0;
                }
            }
            if($value->mes == 6){
                if($value->total != null && $value->total != 0){
                    $total['junho'] = $value->total;
                }else{
                    $total['junho']= 0;
                }
            }
            if($value->mes == 7){
                if($value->total != null && $value->total!= 0){
                    $total['julho'] = $value->total;
                }else{
                    $total['julho'] = 0;
                }
            }
            if($value->mes == 8){
                if($value->total != null && $value->total != 0){
                    $total['agosto'] = $value->total;
                }else{
                    $total['agosto'] = 0;
                }
            }
            if($value->mes == 9){
                if($value->total != null && $value->total!= 0){
                    $total['setembro'] = $value->total;
                }else{
                    $total['setembro'] = 0;
                }
            }
            if($value->mes == 10){
                if($value->total != null && $value->total != 0){
                    $total['outubro'] = $value->total;
                }else{
                    $total['outubro'] = 0;
                }
            }
            if($value->mes == 11){
                if($value->total != null && $value->total != 0){
                    $total['novembro'] = $value->total;
                }else{
                    $total['novembro'] = 0;
                }
            }
            if($value->mes == 12){
                if($value->total != null && $value->total != 0){
                    $total['dezembro'] = $value->total;
                }else{
                    $total['dezembro'] = 0;
                }
            }
            
        }

        return $total;

    }
    
}

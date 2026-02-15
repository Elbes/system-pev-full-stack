<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\Entradas;
use App\Models\TipoResiduo;
use App\Models\Fotos;
use App\Models\ResiduoEntrada;
use App\Models\RegiaoAdministrativa;
use App\Models\UnidadeServico;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        // Definir a zona geográfica padrão.
        date_default_timezone_set("America/Sao_Paulo");

        $objReturn = null;
        $residuoEntrada = new ResiduoEntrada();
        $entrada = new Entradas();
        $objReturn['regiao-administrativa'] = RegiaoAdministrativa::All();
        $objReturn['unidades'] = UnidadeServico::All();
        $objReturn['residuos'] = TipoResiduo::All();
        $ano = date('Y');

        if ($request->input('select-ano')) {
            $anoSelect = $request->input('select-ano');
        }else{
            $anoSelect = $ano;
        }
        //dd($anoSelect);

        // Pegar o último dia.
        $primeirodia_mes = date("Y-m-01");
        $ultimodia_mes = date("Y-m-t");

        $keys = range($ano, 2023);
        $array_anos = array_combine($keys , $keys);

        $mes_atual = date('m');

        $objReturn['mes_atual'] = $mes_atual;
        $objReturn['meses'] = $this->getMeses();
        $objReturn['ano_atual'] = $ano;
        $objReturn['array_anos'] = $array_anos;

        $objReturn['entradas-todas'] = Entradas::All();

        $objReturn['entradas-total'] = $objReturn['entradas-todas']->count();

        $objReturn['entradas-mes'] = Entradas::whereBetween('dhs_cadastro', [$primeirodia_mes, $ultimodia_mes] )->count();

        $objReturn['entradas-dia'] = Entradas::whereDate('dhs_cadastro', today() )->count();

        $objReturn['irregularidades'] = Entradas::where('alerta_irregularidade', 1)->count();

        //TOTAL DE CADA RESÍDUO
        $data['data-rcc'] = $residuoEntrada->getTotalTipoResiduo(1);
        $data['data-podas'] = $residuoEntrada->getTotalTipoResiduo(2);
        $data['data-volumosos'] = $residuoEntrada->getTotalTipoResiduo(3);
        $data['data-reciclaveis'] = $residuoEntrada->getTotalTipoResiduo(4);

        //TOTAL POR ANO, SEPARADO POR MÊS
        $data['cont-rcc'] = $residuoEntrada->getResiduosAno($anoSelect, 1);
        $data['cont-podas'] = $residuoEntrada->getResiduosAno($anoSelect, 2);
        $data['cont-volumosos'] = $residuoEntrada->getResiduosAno($anoSelect, 3);
        $data['cont-reciclaveis'] = $residuoEntrada->getResiduosAno($anoSelect, 4);

        //ENTRADAS POR PEV
        $data['total-unidade'] = $entrada->getTotalUnidae();

        $data['title'] = "Entradas por PRODUTO";
        $data['ano'] = $anoSelect;

        return view('home', ['objReturn' => $objReturn ],['data'=>$data]);
    }

    public function getMeses(){

		$arr_meses = array(
		  '1' => 'Janeiro',
          '2' => 'Fevereiro',
          '3' => 'Março',
          '4' => 'Abril',
          '5' => 'Maio',
          '6' => 'Junho',
          '7' => 'Julho',
          '8' => 'Agosto',
          '9' => 'Setembro',
          '10' => 'Outubro',
          '11' => 'Novembro',
          '12' => 'Dezembro'
		);

		return $arr_meses;
	}
}

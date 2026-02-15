<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use App\Models\UnidadeServico;
use App\Models\RegiaoAdministrativa;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class UnidadeServicoController extends Controller
{
    public function getUnidades()
    {
        $objReturn = null;
        $unidades = new UnidadeServico;
        $objReturn['unidades'] = $unidades->getUnidades();
        $objReturn['regiao-administrativa'] = RegiaoAdministrativa::All();
		
        return view('unidade-servico.lista-unidade', ['objReturn' => $objReturn ]);
        
    }

    public function inserir(Request $request)
    {
    	$objReturn = null;
        $unidade = new UnidadeServico;
        $objReturn['unidades'] = $unidade->getUnidades();
        $objReturn['regiao-administrativa'] = RegiaoAdministrativa::All();

    	$dados = $request->All();
        try{
            DB::BeginTransaction();

            $unidade->nome         = strtoupper($dados['nome']);
            $unidade->id_ra        = $dados['id_ra'];
            $unidade->endereco     = $dados['endereco'];            
           
            if($unidade->save()){
                toastr()->success('Dados salvos com Sucesso!');
                DB::commit();
            }
                
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->error('Erro ao tentar realizar operação! Erro: '. $e->getMessage());
        }
        
        return Redirect::to ( '/lista-unidade' );
	}

    public function getAlterarUnidade($id_unidade)
    {
        $objReturn = null;
        $objReturn['unidade'] = UnidadeServico::withTrashed()->find($id_unidade);
        $objReturn['regiao-administrativa'] = RegiaoAdministrativa::All();

        return view('unidade-servico.form-editar-unidade', ['objReturn' => $objReturn ]);
        
    }

    public function editarUnidade(Request $request)
    {

        $objReturn = null;
        $unidades = new UnidadeServico;
        $objReturn['unidades'] = $unidades->getUnidades();
        $objReturn['regiao-administrativa'] = RegiaoAdministrativa::All();
        $unidade = UnidadeServico::where('id_unidade', $request['id_unidade'])->get()->first();
        try{
            DB::BeginTransaction();

            $unidade->nome       = $request['nome'];
            $unidade->id_ra      = $request['id_ra'];
            $unidade->endereco   = $request['endereco'];
            
            if($unidade->save()){
                toastr()->success('Dados salvos com Sucesso!');

                DB::commit();
            }
                
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->error('Erro ao tentar realizar operação! Erro: '. $e->getMessage());
        }
        
        return Redirect::to ( '/lista-unidade' );
	}

    public function inativarUnidade($id_unidade) {
        $unidade = UnidadeServico::where ( 'id_unidade', $id_unidade );
        
        if ($unidade->delete ()) {
            toastr()->success('Desativado com sucesso!');
        } else {
            toastr()->error('Erro ao tentar realizar operação!');
        }
        return Redirect::to ( '/lista-unidade' );
    }
    
    public function ativarUnidade($id_unidade) {
        $unidade = UnidadeServico::where ( 'id_unidade', $id_unidade );
        
        if ($unidade->restore ()) {
            toastr()->success('Ativado com Sucesso!');
        } else {
            toastr()->error('Erro ao tentar realizar operação!');
        }
        return Redirect::to ( '/lista-unidade' );
    }
}

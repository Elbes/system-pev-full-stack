<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permissao;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class PermissaoController extends Controller
{
    public function getPermissoes()
    {
        $objReturn = null;
        $permissoes = new Permissao();
        $objReturn['permissoes'] = $permissoes->getPermissoes();
        
        return view('permissao.lista-permissao', ['objReturn' => $objReturn ]);
        
    }

    public function inserir(Request $request)
    {
    	$objReturn = null;
        $permissao = new Permissao;
        $objReturn['permissoes'] = Permissao::All();

    	$dados = $request->All();
        try{
            DB::BeginTransaction();

            $permissao->nome_permissao    = $dados['nome_permissao'];
            $permissao->dsc_permissao     = $dados['dsc_permissao'];
           
            if($permissao->save()){
                toastr()->success('Dados salvos com Sucesso!');
                DB::commit();
            }
                
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->error('Erro ao tentar realizar operação! Erro: '. $e->getMessage());
        }
        
        return Redirect::to('/lista-permissao');
	}

    public function inativarPermissao($id_permissao) {
        $permissao = Permissao::where ( 'id_permissao', $id_permissao );
        
        if ($permissao->delete ()) {
            toastr()->success('Desativado com sucesso!');
        } else {
            toastr()->error('Erro ao tentar realizar operação!');
        }
        return Redirect::to ( '/lista-permissao' );
    }
    
    public function ativarPermissao($id_permissao) {
        $permissao = Permissao::where ( 'id_permissao', $id_permissao );
        
        if ($permissao->restore ()) {
            toastr()->success('Ativado com Sucesso!');
        } else {
            toastr()->error('Erro ao tentar realizar operação!');
        }
        return Redirect::to ( '/lista-permissao' );
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Permissao;
use App\Models\PerfilPermissao;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Usuarios;

class PerfilController extends Controller
{
    
    public function getPerfis()
    {
        $objReturn = null;
        $perfil = new Perfil();
        $objReturn['perfis']= $perfil->getPerfis();

        $all_permissoes = Permissao::pluck('nome_permissao', 'id_permissao')->toArray();

        $objReturn['all_permissoes'] = $all_permissoes;

        $objReturn['permissoes'] = Permissao::All();
        
        return view('perfil.lista-perfil', ['objReturn' => $objReturn ]);
        
    }

    public function inserir(Request $request){
        $objReturn = null;
        $input = $request->All();
        $perfil = new Perfil();
        $objReturn['perfis']= $perfil->getPerfis();

        $permissoes_post = $input['id_permissao'];

        DB::beginTransaction();

        $perfil->tipo_perfil    = $input['tipo_perfil'];
        $perfil->nome_perfil    = $input['nome_perfil'];
        $perfil->dsc_perfil      = $input['dsc_perfil'];

        if($perfil->save()){
            
		// Tratando as permissoes e salvando
			foreach ($permissoes_post as $key => $value){
			
				$permissoes[]= $value;
				$perfil->permissoes()->attach($value);
			}
            DB::commit();
            toastr()->success('Cadastro realizado  com sucesso!');
        }else{
            toastr()->error('Erro ao tentar realizar operação!');
        }

        return Redirect::to ( '/lista-perfil' );

    }

    public function getAlterarPerfil($id_perfil)
    {
        $objReturn = null;
        
        $objReturn['perfil'] = Perfil::withTrashed()->find($id_perfil);

        $objReturn['selected_permissoes'] = $objReturn['perfil']->permissoes()->pluck('PerfilPermissao.id_permissao')->toArray();
       
        $objReturn['all_permissoes']  = Permissao::pluck('nome_permissao', 'id_permissao')->toArray();

        return view('perfil.form-editar-perfil', ['objReturn' => $objReturn ]);
        
    }

    public function editarPerfil(Request $request)
    {
        $input = $request->All();
        $objReturn = null;


        $perfil =  Perfil::withTrashed()->find($request['id_perfil']);
        try{

            $permissoes_post = $input['id_permissao'];
            
            DB::beginTransaction();

            $perfil->tipo_perfil    = $input['tipo_perfil'];
            $perfil->nome_perfil    = $input['nome_perfil'];
            $perfil->dsc_perfil     = $input['dsc_perfil'];
            //dd($perfil);
            if($perfil->save()){

                $perfil->permissoes()->detach();

                foreach ($permissoes_post as $key => $value){
                    $permissoes[]= $value;
                    $perfil->permissoes()->attach($value);
                }

                DB::commit();

                toastr()->success('Dados salvos com Sucesso!');
            }
                
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->error('Erro ao tentar realizar operação! Erro: '. $e->getMessage());
        }
        
        return Redirect::to ( '/lista-perfil' );
	}

    public function inativarPerfil($id_perfil) {
        $perfil = Perfil::where( 'id_perfil', $id_perfil );
        
        if ($perfil->delete()) {
            toastr()->success('Desativado com sucesso!');
        } else {
            toastr()->error('Erro ao tentar realizar operação!');
        }
        return Redirect::to ( '/lista-perfil' );
    }
    
    public function ativarPerfil($id_perfil) {
        $perfil = Perfil::where ( 'id_perfil', $id_perfil );
        
        if ($perfil->restore ()) {
            toastr()->success('Ativado com Sucesso!');
        } else {
            toastr()->error('Erro ao tentar realizar operação!');
        }
        return Redirect::to ( '/lista-perfil' );
    }

    public function excluir($id_perfil){

        $countPerfilUsuario = Usuarios::where('id_perfil', $id_perfil)->withTrashed()->count();
        $countPerfilPermissao = PerfilPermissao::where('id_perfil', $id_perfil)->count();

        if($countPerfilUsuario > 0 ||  $countPerfilPermissao > 0){
              toastr()->warning('Este perfil já está vinculado a algum usuário e/ou permissão. Impossível realizar a exclusão.');
        }else{
            $perfil = Perfil::find($id_perfil);
            if($perfil->tipo_perfil=='ADMG'){
                toastr()->warning('O perfil de Administrador Geral não pode ser excluído!');

            }else{
                try{
                    DB::BeginTransaction();
        
                    // EXCLUI OS DADOS
                    if($perfil->forcedelete()){
                        toastr()->success('Excluído com sucesso!' );
                    }
                        
                    DB::commit();
        
                    }catch(\Exception $e){
                        DB::rollBack();
                         toastr()->error('Erro ao tentar realizar exclusão!Tente Novamente. Erro: '. $e->getMessage() );
                    }
            }
        }
            return Redirect::to ( '/lista-perfil' );
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Controllers\Controller;
use App\Models\Entradas;
use App\Models\Usuarios;
use App\Models\UnidadeServico;


class UsuariosController extends Controller
{
    public function getCadastro()
    {
        $objReturn = null;
        $objReturn['unidade'] = UnidadeServico::All();

        return view('auth.register', ['objReturn' => $objReturn ]);

    }

     public function inserir(Request $request)
    {
    	$usuario = new Usuarios;
    	$dados = $request->All();
        try{
            DB::BeginTransaction();

            $usuario->nom_usuario   = $dados['nom_usuario'];
            $usuario->num_cpf       = $dados['num_cpf'];
            $usuario->dat_nascimento       = $dados['dat_nascimento'];
            $usuario->id_unidade       = $dados['id_unidade'];
            $usuario->dsc_email       = $dados['dsc_email'];
            $usuario->pws_senha = Hash::make ( $dados['pws_senha']);
            $usuario->dhs_exclusao = Carbon::now();
              
            if($usuario->save()){
                toastr()->success('Cadastro realizado com sucesso. Aguarde liberação do gestor!!');
                DB::commit();
            }
                
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->error('Erro ao tentar realizar o cadastro! Erro: '. $e->getMessage() );
        }
        
		return Redirect::to ( '/cadastro-usuario' );
	}

    public function getUsuarios()
    {
        $objReturn = null;
        $usuario = new Usuarios;
        $objReturn['usuarios'] = $usuario->All();

       return response()->json($objReturn['usuarios']);
        
    }

     public function getEditarUsuario($id_usuario)
    {
        $objReturn = null;

        $objReturn['usuario'] = Usuarios::withTrashed()->find($id_usuario);
        $objReturn['unidade'] = UnidadeServico::All();
        $objReturn['perfil'] = Perfil::All();

        return view('usuarios.form-editar-usuario', ['objReturn' => $objReturn ]);
        
    }

    
    public function editarUsuario(Request $request)
    {

        //$dados = $request->All();
        $objReturn = null;
        $usuario = new Usuarios;
        $objReturn['usuarios'] = $usuario->getUsuarios();
    	//$usuario = Usuarios::find($request['id_usuario'])->withTrashed()->first();
       $usuario = Usuarios::where('id_usuario', $request['id_usuario'])->get()->first();
        try{
            DB::BeginTransaction();

            $usuario->nom_usuario      = $request['nom_usuario'];
            $usuario->num_cpf          = $request['num_cpf'];
            $usuario->dat_nascimento   = Controller::date_format_to_en($request['dat_nascimento']);
            $usuario->id_unidade       = $request['id_unidade'];
            $usuario->id_perfil        = $request['id_perfil'];
            $usuario->dsc_email        = $request['dsc_email'];
            
            if($usuario->save()){
                toastr()->success('Dados salvos com Sucesso!');

                DB::commit();
            }
                
        }catch(\Exception $e){
            DB::rollBack();
            toastr()->error('Erro ao tentar realizar operação! Erro: '. $e->getMessage());
        }
        
        return Redirect::to ( '/lista-usuarios' );
	}

     public function inativarUsuario($id_usuario) {
        $usuario = Usuarios::where ( 'id_usuario', $id_usuario );
        
        if ($usuario->delete ()) {
            toastr()->success('Desativado com sucesso!');
        } else {
            toastr()->error('Erro ao tentar realizar operação!');
        }
        return Redirect::to ( '/lista-usuarios' );
    }
    
    public function ativarUsuario($id_usuario) {
        $usuario = Usuarios::where ( 'id_usuario', $id_usuario );
        
        if ($usuario->restore ()) {
            toastr()->success('Ativado com Sucesso!');
        } else {
            toastr()->error('Erro ao tentar realizar operação!');
        }
        return Redirect::to ( '/lista-usuarios' );
    }

    //VIEW ALTERAR SENHA USUÁRIO LOGADO
	public function getAlterarSenha()
	{
		$objReturn['usuario'] = null;
		$objReturn['usuario'] = Usuarios::find(Auth::user()->id_usuario);

        if ($objReturn['usuario'] == null) {
			toastr()->warning('Usuário não encontrado!');
			return Redirect::back();
		}else{
			return view('usuarios.altera-senha', ['objReturn' => $objReturn ] );
		}
	}
	
	//FUNÇÃO PARA ALTERA SENHA DO USUARIO LOGADO
	public function alterarSenha(Request $request){
			
		/* $this->validate($request, [
				'nova_senha'              => 'required|min:6',
				'confirme_senha' => 'required|confirmed'
		]); */
		
		$usuario = Usuarios::find($request->input('id_usuario'));
		$senha_atual = $request->input('senha_atual');
		$nova_senha = $request->input('pws_senha');
		$confirme_senha = $request->input('pws_senha_confirmar');
        
		if (Hash::check($senha_atual,$usuario->pws_senha)){
			
			if ($nova_senha == $confirme_senha){
				$usuario->pws_senha = Hash::make ($nova_senha);
				if ($usuario->save ()){
                    toastr()->success('Senha alterada com sucesso!');
				}else {
                    toastr()->error('Erro ao tenatar salvar altera a senha!Tente Novamente.');
				}
			}else{
                toastr()->warning('Nova senha e confirmação não conferem!');
			}
		 }else{
            toastr()->warning('Senha atual não confere com o usuário logado!');
		 }
		return Redirect::back();
	}

    public function excluir($id_usuario){

        $countUsuarioEntrada = Entradas::where('id_usuario', $id_usuario)->withTrashed()->count();

        if($countUsuarioEntrada > 0){
              toastr()->warning('Este usuário já está vinculado a alguma entrada. Impossível realizar a exclusão.');
        }else{
            $usuario = Usuarios::withTrashed()->find($id_usuario);

        try{
            DB::BeginTransaction();

            // EXCLUI OS DADOS
            if($usuario->forcedelete()){
                toastr()->success('Excluído com sucesso!' );
            }
                
            DB::commit();

            }catch(\Exception $e){
                DB::rollBack();
                 toastr()->error('Erro ao tentar realizar exclusão!Tente Novamente. Erro: '. $e->getMessage() );
            }
        }
            return Redirect::to ( '/lista-usuarios' );
    }

    

}

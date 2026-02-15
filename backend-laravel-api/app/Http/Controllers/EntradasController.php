<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entradas;
use App\Models\TipoResiduo;
use App\Models\Fotos;
use App\Models\RegiaoAdministrativa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;
use Carbon\Carbon;


class EntradasController extends Controller
{
    public function getEntradas()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Não autenticado'], 401);
        }

        $id_unidade = $user->unidadeUsuario->id_unidade;

        $ultimas = Entradas::where('id_unidade', $id_unidade)
            ->orderBy('dhs_cadastro', 'desc')
            ->take(5)
            ->get();

        return response()->json([
            'tipos_residuo' => TipoResiduo::all(),
            'ras' => RegiaoAdministrativa::all(),
            'ultimas' => $ultimas
        ]);
    }

    public function store(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $user = Auth::user();

        $alturaIMG = 650;
        $larguraIMG = 500;

        $request->validate([
            'placa' => 'nullable|string|max:10',
            'id_ra' => 'required|integer',
            'residuos' => 'required|array',
            'residuos.*' => 'integer',
            //'irregularidade' => 'nullable|boolean',
            'foto' => 'nullable|image|max:5000'
        ]);

        $mensagem = null;

        try{
            DB::BeginTransaction();

            $entrada = new Entradas();
            $entrada->id_unidade = $user->unidadeUsuario->id_unidade;
            $entrada->placa_veiculo = $request->placa;
            $entrada->id_ra = $request->id_ra;
            $entrada->alerta_irregularidade = $request->irregularidade ?? 0;
            //$entrada->dhs_cadastro = Carbon::now();
            $entrada->id_usuario = $user->id_usuario;

            // Upload da foto e salvar resíduos da entrada- após salvar entrada
            if($entrada->save()){
                if($request->hasfile('foto')){

                    $file = $request->file('foto');
                    $imagem = new Fotos();
                    $name = time().'_'.str_replace(' ', '_',$file->getClientOriginalName());
                    $destinationPath = public_path('entradas');

                    $img = Image::read($file->getRealPath());
                    $data['nome'] = $name;
                    $imagem->nome_foto = $data['nome'];
                    $imagem->id_entrada = $entrada->id_entrada;

                    if($imagem->save()){
                        $img->resize($larguraIMG, $alturaIMG)->save($destinationPath . '/' . $data['nome']);
                    }

                }
                
                // Salvar resíduos (pivot)
                $entrada->residudoEntrada()->sync($request->residuos);

                DB::commit();
                $mensagem = 'Dados salvos com Sucesso!';
            }
        }catch(\Exception $e){
            DB::rollBack();
            $mensagem = 'Erro ao tentar realizar operação! Erro: '. $e->getMessage();
        }

        return response()->json([
            'message' =>  $mensagem
        ]);
    }

    public function detalhesEntrada($id){

        $enttrada = Entradas::with('fotoEntrada')->findOrFail($id);

		return response()->json([
            'entrada' => $enttrada 
        ]);

    }
}

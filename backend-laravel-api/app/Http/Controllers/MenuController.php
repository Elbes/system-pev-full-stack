<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Permissao;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


class MenuController extends Controller
{

public function getMenusUsuario()
    {
        $user = Auth::user();

        // IDs de permissões do perfil
        $permissoesIds = $user->perfil
            ->permissoes()
            ->pluck('id_permissao');

        // Menus permitidos
        $menus = Menu::whereIn('id_permissao', $permissoesIds)
            ->whereNull('id_menu_referencia')
            ->with('filhos')
            ->get();

        return response()->json($menus);
    }
    
    public function getMenus()
    {
        $objReturn = null;
        $menus = new Menu();
        $objReturn['menus']= $menus->getMenus();
        $objReturn['permissoes'] = Permissao::All();
        
        return view('menu.lista-menu', ['objReturn' => $objReturn ]);
        
    }

    public function inativarMenu($id_menu) {
        $menu = Menu::where ( 'id_menu', $id_menu );
        
        if ($menu->delete ()) {
            toastr()->success('Desativado com sucesso!');
        } else {
            toastr()->error('Erro ao tentar realizar operação!');
        }
        return Redirect::to ( '/lista-menu' );
    }
    
    public function ativarMenu($id_menu) {
        $menu = Menu::where ( 'id_menu', $id_menu );
        
        if ($menu->restore ()) {
            toastr()->success('Ativado com Sucesso!');
        } else {
            toastr()->error('Erro ao tentar realizar operação!');
        }
        return Redirect::to ( '/lista-menu' );
    }
}

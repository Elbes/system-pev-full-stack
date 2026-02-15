<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Menu;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'dsc_email' => $request->email,
            'password' => $request->password
        ];

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'message' => 'Email ou senha inválidos'
            ], 401);
        }

        $user = auth('api')->user();

        // Permissões do perfil
        $permissoesIds = $user->perfil
        ->permissoes()
        ->pluck('Permissao.id_permissao');

        // Menus do usuário
        $menus = Menu::whereIn('id_permissao', $permissoesIds)
            ->whereNull('id_menu_referencia')
            ->whereNotNull('dhs_exclusao')
            ->with(['getSubMenu' => function ($q) use ($permissoesIds) {
                $q->whereIn('id_permissao', $permissoesIds)
                ->whereNotNull('dhs_exclusao');
            }])
            ->orderBy('num_ordem')
            ->get();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user,
            'menus' => $menus
        ]);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissao
{
    public function handle($request, Closure $next, $permissao)
    {
        $user = auth()->user();

        $temPermissao = $user->perfil
            ->permissoes()
            ->where('nome_permissao', $permissao)
            ->exists();

        if (!$temPermissao) {
            return response()->json([
                'message' => 'Sem permissão'
            ], 403);
        }

        return $next($request);
    }
}

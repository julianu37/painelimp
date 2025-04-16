<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{
    /**
     * Adiciona um like a um comentário pelo usuário autenticado.
     *
     * @param Comentario $comentario O comentário a ser curtido (Route Model Binding)
     * @return RedirectResponse
     */
    public function like(Comentario $comentario): RedirectResponse
    {
        $user = Auth::user();

        // Verifica se o usuário já curtiu para evitar duplicatas (embora a chave primária evite)
        // Usamos syncWithoutDetaching que adiciona se não existir, sem remover outros
        // Acessa o relacionamento a partir do usuário logado
        $user->likedComments()->syncWithoutDetaching([$comentario->id]);

        // Redireciona de volta para a página anterior com mensagem de sucesso
        // Poderia retornar JSON se fosse uma requisição AJAX
        return back()->with('success', 'Comentário curtido!');
    }

    /**
     * Remove o like de um comentário pelo usuário autenticado.
     *
     * @param Comentario $comentario O comentário a ser descurtido (Route Model Binding)
     * @return RedirectResponse
     */
    public function unlike(Comentario $comentario): RedirectResponse
    {
        $user = Auth::user();

        // Remove o like da tabela pivot usando o relacionamento do usuário
        $user->likedComments()->detach($comentario->id);

        // Redireciona de volta
        return back()->with('success', 'Curtida removida.');
    }
}

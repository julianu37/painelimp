<?php

namespace App\Policies;

use App\Models\Comentario;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ComentarioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Todos os usuários logados podem ver comentários (a lógica de quais comentários
        // são visíveis está nos controllers/views)
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Comentario $comentario): bool
    {
        // Todos os usuários logados podem ver um comentário específico
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Qualquer usuário logado pode criar comentários
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comentario $comentario): bool
    {
        // Permite atualizar se o usuário for o dono do comentário OU se for admin
        return $user->id === $comentario->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comentario $comentario): bool
    {
        // Permite excluir se o usuário for o dono do comentário OU se for admin
        return $user->id === $comentario->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Comentario $comentario): bool
    {
        // Implementar se usar SoftDeletes
        return $user->isAdmin(); // Ex: Apenas admin pode restaurar
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Comentario $comentario): bool
    {
        // Implementar se usar SoftDeletes
        return $user->isAdmin(); // Ex: Apenas admin pode excluir permanentemente
    }
}

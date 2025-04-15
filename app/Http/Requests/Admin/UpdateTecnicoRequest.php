<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateTecnicoRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        // Apenas admin pode editar técnicos
        return $this->user()->isAdmin();
    }

    /**
     * Retorna as regras de validação que se aplicam à requisição.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Pega o ID do técnico sendo editado da rota
        $tecnicoId = $this->route('tecnico')->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            // Email deve ser único, ignorando o próprio técnico sendo editado
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($tecnicoId)],
            // Senha é opcional na atualização, mas se fornecida, deve ser confirmada e seguir as regras
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role' => ['required', 'string', Rule::in(['tecnico'])],
            // 'avatar' => ['nullable', 'image', 'max:1024'],
            // 'remover_avatar' => ['sometimes', 'boolean'], // Para o checkbox de remover avatar
        ];
    }
}

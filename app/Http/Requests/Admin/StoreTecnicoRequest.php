<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use App\Models\User; // Para Rule::unique
use Illuminate\Validation\Rule;

class StoreTecnicoRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     * Assumimos que apenas admins acessam esta rota (controlado pelo middleware na rota).
     */
    public function authorize(): bool
    {
        // Garante que o usuário logado é admin (já protegido pela rota, mas boa prática)
        return $this->user()->isAdmin();
    }

    /**
     * Retorna as regras de validação que se aplicam à requisição.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)],
            'password' => ['required', 'confirmed', Password::defaults()], // Exige confirmação e regras de senha padrão do Laravel
            'role' => ['required', 'string', Rule::in(['tecnico'])], // Garante que a role seja 'tecnico'
            // 'avatar' => ['nullable', 'image', 'max:1024'], // Validação para avatar (se implementado)
        ];
    }
}

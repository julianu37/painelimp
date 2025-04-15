<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMarcaRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Apenas usuários autenticados com a role 'admin' podem criar marcas
        return Auth::check() && Auth::user()->role === 'admin';
    }

    /**
     * Obtém as regras de validação que se aplicam à requisição.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            // O nome é obrigatório, deve ser uma string, ter no máximo 255 caracteres
            // e ser único na tabela 'marcas', coluna 'nome'
            'nome' => 'required|string|max:255|unique:marcas,nome',
        ];
    }

    /**
     * Obtém as mensagens de erro personalizadas para as regras de validação.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome da marca é obrigatório.',
            'nome.string'   => 'O nome da marca deve ser um texto.',
            'nome.max'      => 'O nome da marca não pode ter mais que 255 caracteres.',
            'nome.unique'   => 'Esta marca já está cadastrada.',
        ];
    }
} 
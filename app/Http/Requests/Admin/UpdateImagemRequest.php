<?php

namespace App\Http\Requests\Admin;

// use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// Não precisa herdar de StoreMediaRequest, pois não validamos attachable na edição
// mas ainda precisa de FormRequest
use Illuminate\Foundation\Http\FormRequest;

class UpdateImagemRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Retorna as regras de validação que se aplicam à requisição.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            // Arquivo é opcional na atualização
            'arquivo' => ['nullable', 'image', 'mimes:jpeg,png,gif,webp', 'max:2048'],
            // Não validamos attachable_type/id na atualização por aqui
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O título da imagem é obrigatório.',
            'arquivo.image' => 'O arquivo deve ser uma imagem válida.',
            'arquivo.mimes' => 'A imagem deve ser do tipo: jpeg, png, gif ou webp.',
            'arquivo.max' => 'A imagem não pode ser maior que 2MB.',
        ];
    }
}

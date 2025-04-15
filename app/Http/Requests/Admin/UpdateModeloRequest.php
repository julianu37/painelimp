<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateModeloRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Assume admin pode editar
    }

    public function rules(): array
    {
        $modeloId = $this->route('modelo')->id; // Pega o ID do modelo da rota

        return [
            'marca_id' => ['required', 'integer', Rule::exists('marcas', 'id')],
            'nome' => [
                'required',
                'string',
                'max:255',
                // Garante que o nome seja único PARA AQUELA MARCA, IGNORANDO o modelo atual
                Rule::unique('modelos')->where(function ($query) {
                    return $query->where('marca_id', $this->input('marca_id'));
                })->ignore($modeloId)
            ],
        ];
    }

    public function messages(): array
    {
         return [
            'marca_id.required' => 'É obrigatório selecionar a marca.',
            'marca_id.exists' => 'A marca selecionada é inválida.',
            'nome.required' => 'O nome do modelo é obrigatório.',
            'nome.unique' => 'Já existe um modelo com este nome para esta marca.',
            'nome.max' => 'O nome do modelo não pode ter mais que 255 caracteres.',
        ];
    }
} 
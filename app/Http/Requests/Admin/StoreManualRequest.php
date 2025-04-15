<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreManualRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true; // Assume admin pode criar
    }

    /**
     * Retorna as regras de validação que se aplicam à requisição.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            // modelo_id é opcional, mas se fornecido, deve existir na tabela modelos
            'modelo_id' => ['nullable', 'integer', Rule::exists('modelos', 'id')],
            'descricao' => ['nullable', 'string'],
            'equipamentos' => ['nullable', 'string', 'max:255'],
            // Arquivo é obrigatório na criação, PDF, máx 128MB (131072 KB)
            'arquivo' => ['required', 'file', 'mimes:pdf', 'max:131072'],
            'publico' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * Prepara os dados para validação.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'publico' => $this->boolean('publico'),
        ]);
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do manual é obrigatório.',
            'modelo_id.exists' => 'O modelo selecionado é inválido.',
            'arquivo.required' => 'O arquivo PDF é obrigatório.',
            'arquivo.mimes' => 'O arquivo deve ser do tipo PDF.',
            'arquivo.max' => 'O arquivo PDF não pode ser maior que 128MB.',
        ];
    }
}

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
            // modelos é obrigatório e deve ser um array
            'modelos' => ['required', 'array'],
            // Cada item em modelos deve ser um inteiro e existir na tabela modelos
            'modelos.*' => ['integer', Rule::exists('modelos', 'id')],
            'descricao' => ['nullable', 'string'],
            // 'equipamentos' => ['nullable', 'string', 'max:255'], // Removido
            'arquivo' => ['required', 'file', 'mimes:pdf', 'max:131072'], // Mantido limite 128MB
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
            'modelos.required' => 'Selecione pelo menos um modelo.',
            'modelos.array' => 'A seleção de modelos é inválida.',
            'modelos.*.integer' => 'Um dos modelos selecionados é inválido.',
            'modelos.*.exists' => 'Um dos modelos selecionados não existe.',
            'arquivo.required' => 'O arquivo PDF é obrigatório.',
            'arquivo.mimes' => 'O arquivo deve ser do tipo PDF.',
            'arquivo.max' => 'O arquivo PDF não pode ser maior que 128MB.',
        ];
    }
}

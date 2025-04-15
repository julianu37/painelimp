<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateManualRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
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
            'nome' => ['required', 'string', 'max:255'],
            'modelo_id' => ['nullable', 'integer', Rule::exists('modelos', 'id')],
            'descricao' => ['nullable', 'string'],
            'equipamentos' => ['nullable', 'string', 'max:255'],
            // Arquivo é opcional na atualização, mas se enviado, deve ser PDF, máx 128MB
            'arquivo' => ['nullable', 'file', 'mimes:pdf', 'max:131072'],
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
            'arquivo.mimes' => 'O arquivo deve ser do tipo PDF.',
            'arquivo.max' => 'O arquivo PDF não pode ser maior que 128MB.',
        ];
    }
}

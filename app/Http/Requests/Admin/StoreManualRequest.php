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
            'publico' => ['nullable', 'boolean'],
            'tipo' => ['required', Rule::in(['pdf', 'html'])],
            'arquivo' => [
                Rule::requiredIf(fn () => $this->input('tipo') === 'pdf'),
                'nullable',
                'file',
                'mimes:pdf',
                'max:131072'
            ],
            'caminho_html' => [
                Rule::requiredIf(fn () => $this->input('tipo') === 'html'),
                'nullable',
                'string',
                'max:255'
            ],
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
            'tipo.required' => 'Selecione o tipo de manual (PDF ou HTML).',
            'tipo.in' => 'Tipo de manual inválido.',
            'arquivo.required' => 'O upload do arquivo PDF é obrigatório para manuais do tipo PDF.',
            'arquivo.mimes' => 'O arquivo deve ser do tipo PDF.',
            'arquivo.max' => 'O arquivo PDF não pode ser maior que 128MB.',
            'caminho_html.required' => 'O caminho relativo para o index.html é obrigatório para manuais do tipo HTML.',
            'caminho_html.string' => 'O caminho HTML deve ser um texto.',
            'caminho_html.max' => 'O caminho HTML não pode ter mais que 255 caracteres.',
        ];
    }
}

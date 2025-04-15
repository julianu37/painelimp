<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCodigoErroRequest extends FormRequest
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
            'codigo' => ['required', 'string', 'max:50', Rule::unique('codigos_erro')],
            'descricao' => ['required', 'string'],
            // Validação para o array de modelos (opcional)
            'modelos' => ['nullable', 'array'],
            // Valida cada ID dentro do array 'modelos'
            'modelos.*' => ['integer', Rule::exists('modelos', 'id')],
            'publico' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.required' => 'O código do erro é obrigatório.',
            'codigo.unique' => 'Este código de erro já está cadastrado.',
            'descricao.required' => 'A descrição do erro é obrigatória.',
            'modelos.*.exists' => 'Um dos modelos selecionados é inválido.',
        ];
    }

    /**
     * Prepara os dados para validação.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        // Garante que o campo 'publico' seja boolean (0 ou 1)
        // Se o checkbox 'publico' não for enviado (desmarcado), define como false (0)
        $this->merge([
            'publico' => $this->boolean('publico'),
        ]);
    }
}

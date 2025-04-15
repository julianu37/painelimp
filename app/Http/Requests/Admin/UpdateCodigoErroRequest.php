<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCodigoErroRequest extends FormRequest
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
        $codigoErroId = $this->route('codigoErro')->id;

        return [
            'codigo' => ['required', 'string', 'max:50', Rule::unique('codigos_erro')->ignore($codigoErroId)],
            'descricao' => ['required', 'string'],
            'modelos' => ['nullable', 'array'],
            'modelos.*' => ['integer', Rule::exists('modelos', 'id')],
            'publico' => ['boolean'],
        ];
    }

    /**
     * Prepara os dados para validação.
     *
     * @return void
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
            'codigo.required' => 'O código do erro é obrigatório.',
            'codigo.unique' => 'Este código de erro já está cadastrado.',
            'descricao.required' => 'A descrição do erro é obrigatória.',
            'modelos.*.exists' => 'Um dos modelos selecionados é inválido.',
        ];
    }
}

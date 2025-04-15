<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // Necessário para Rule::exists

class StoreSolucaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Assumindo que qualquer admin autenticado pode criar
        // Poderia adicionar lógica de permissão mais específica aqui se necessário
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // codigo_erro_id é obrigatório e deve existir na tabela codigos_erro
            'codigo_erro_id' => ['required', 'integer', Rule::exists('codigos_erro', 'id')],
            // título é obrigatório, string, máximo 255 caracteres
            'titulo' => ['required', 'string', 'max:255'],
            // descrição é opcional, mas se presente, deve ser string
            'descricao' => ['nullable', 'string'],
            // TODO: Adicionar validação para upload de imagens/vídeos se for feito junto
        ];
    }

    /**
     * Define mensagens de erro personalizadas para as regras de validação.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'codigo_erro_id.required' => 'É obrigatório associar a solução a um código de erro.',
            'codigo_erro_id.exists' => 'O código de erro selecionado é inválido.',
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.max' => 'O título não pode ter mais que 255 caracteres.',
        ];
    }
}

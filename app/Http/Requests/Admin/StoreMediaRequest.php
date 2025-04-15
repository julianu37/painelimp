<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMediaRequest extends FormRequest
{
    /**
     * Valida os campos comuns para Imagem e Vídeo, incluindo associação.
     */
    protected function commonRules(): array
    {
        // Define os tipos de modelos permitidos para associação
        $allowedTypes = [
            \App\Models\Marca::class,
            \App\Models\Modelo::class,
            \App\Models\CodigoErro::class,
            \App\Models\Solucao::class,
            \App\Models\Manual::class,
            \App\Models\Comentario::class,
        ];

        return [
            'titulo' => ['nullable', 'string', 'max:255'], // Título opcional para ambos
            // Valida o tipo de modelo associado
            'attachable_type' => ['required', 'string', Rule::in($allowedTypes)],
            // Valida se o ID do modelo associado existe na tabela correta
            // A tabela é determinada dinamicamente com base no attachable_type
            'attachable_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    $type = $this->input('attachable_type');
                    if ($type && class_exists($type)) {
                        // Tenta encontrar o registro na tabela correspondente
                        if (! $type::find($value)) {
                            $fail("O item selecionado para associação não foi encontrado.");
                        }
                    } else {
                        $fail("Tipo de associação inválido.");
                    }
                },
            ],
        ];
    }

     /**
     * Mensagens comuns
     */
    protected function commonMessages(): array
    {
         return [
            'attachable_type.required' => 'O tipo de associação é obrigatório.',
            'attachable_type.in' => 'O tipo de associação é inválido.',
            'attachable_id.required' => 'O ID de associação é obrigatório.',
            'attachable_id.integer' => 'O ID de associação deve ser um número.',
            // Mensagem para a validação customizada (closure) será a string passada em $fail
        ];
    }

    // Os métodos authorize(), rules(), e messages() serão implementados
    // nas classes filhas (StoreImagemRequest, StoreVideoRequest)
    // que chamarão commonRules() e commonMessages() e adicionarão
    // suas próprias regras específicas (arquivo, tipo de vídeo, etc.)
}
 
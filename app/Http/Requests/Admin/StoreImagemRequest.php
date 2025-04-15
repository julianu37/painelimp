<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // Para validação de MorphTo
use App\Models\CodigoErro; // Para validar tipo
use App\Models\Solucao;    // Para validar tipo

// Não precisa mais de FormRequest diretamente, herda de StoreMediaRequest
// use Illuminate\Validation\Rule; // Remover import duplicado

// Herda da classe base que criamos
class StoreImagemRequest extends StoreMediaRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true; // Assume admin
    }

    /**
     * Combina as regras comuns da classe pai com as regras específicas de imagem.
     */
    public function rules(): array
    {
        // Define as regras específicas para o arquivo de imagem
        $imageRules = [
            'arquivo' => ['required', 'image', 'mimes:jpeg,png,gif,webp', 'max:2048'],
            // Validação para relacionamento polimórfico
            'imageable_id' => ['required', 'integer'],
            'imageable_type' => [
                'required',
                'string',
                // Garante que o tipo seja um dos modelos permitidos
                Rule::in([CodigoErro::class, Solucao::class])
            ],
        ];

        // Mescla as regras comuns (attachable_type, attachable_id, titulo) com as de imagem
        return array_merge(parent::commonRules(), $imageRules);
    }

    /**
     * Combina as mensagens comuns da classe pai com as específicas de imagem.
     */
    public function messages(): array
    {
        // Define mensagens específicas para o arquivo de imagem
         return array_merge(parent::commonMessages(), [
            'arquivo.required' => 'O arquivo de imagem é obrigatório.',
            'arquivo.image' => 'O arquivo deve ser uma imagem válida.',
            'arquivo.mimes' => 'A imagem deve ser do tipo: jpeg, png, gif ou webp.',
            'arquivo.max' => 'A imagem não pode ser maior que 2MB.',
        ]);
    }

    /**
     * Adiciona validação after para garantir que o ID existe para o TIPO especificado.
     */
    public function after(): array
    {
        return [
            function (\Illuminate\Validation\Validator $validator) {
                $type = $this->input('imageable_type');
                $id = $this->input('imageable_id');

                if ($type && $id) {
                    // Verifica se o tipo é válido e se o ID correspondente existe na tabela correta
                    if ($type === CodigoErro::class) {
                        if (!CodigoErro::where('id', $id)->exists()) {
                            $validator->errors()->add('imageable_id', 'O Código de Erro selecionado não existe.');
                        }
                    } elseif ($type === Solucao::class) {
                        if (!Solucao::where('id', $id)->exists()) {
                            $validator->errors()->add('imageable_id', 'A Solução selecionada não existe.');
                        }
                    } else {
                        // Caso o Rule::in falhe por algum motivo ou novos tipos sejam adicionados sem atualizar a regra
                        $validator->errors()->add('imageable_type', 'Tipo de associação inválido.');
                    }
                }
            }
        ];
    }
}

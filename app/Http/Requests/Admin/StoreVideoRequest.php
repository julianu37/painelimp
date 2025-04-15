<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\CodigoErro;
use App\Models\Solucao;

class StoreVideoRequest extends StoreMediaRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true; // Assume admin
    }

    /**
     * Combina regras comuns com as específicas de vídeo.
     */
    public function rules(): array
    {
        $videoRules = [
            'tipo' => ['required', Rule::in(['upload', 'link'])],
            // Regras condicionais baseadas no tipo
            'video_upload' => [
                Rule::requiredIf($this->input('tipo') === 'upload'), // Obrigatório se for upload
                'nullable', // Permite ser nulo se for link
                'file',
                'mimes:mp4,webm,ogg', // Mimes permitidos
                'max:51200' // Máx 50MB (51200 KB)
            ],
            'url_ou_path' => [
                Rule::requiredIf($this->input('tipo') === 'link'), // Obrigatório se for link
                'nullable', // Permite ser nulo se for upload
                'url', // Valida se é uma URL válida
                'max:1024'
            ],
            // Validação polimórfica
            'videoable_id' => ['required', 'integer'],
            'videoable_type' => [
                'required',
                'string',
                Rule::in([CodigoErro::class, Solucao::class])
            ],
        ];
        // Mescla com as regras comuns (titulo, attachable_type, attachable_id)
        return array_merge(parent::commonRules(), $videoRules);
    }

    /**
     * Adiciona validação after para garantir que o ID polimórfico existe para o TIPO.
     */
    public function after(): array
    {
        return [
            function (\Illuminate\Validation\Validator $validator) {
                $type = $this->input('videoable_type');
                $id = $this->input('videoable_id');

                if ($type && $id) {
                    if ($type === CodigoErro::class) {
                        if (!CodigoErro::where('id', $id)->exists()) {
                            $validator->errors()->add('videoable_id', 'O Código de Erro selecionado não existe.');
                        }
                    } elseif ($type === Solucao::class) {
                        if (!Solucao::where('id', $id)->exists()) {
                            $validator->errors()->add('videoable_id', 'A Solução selecionada não existe.');
                        }
                    } else {
                        $validator->errors()->add('videoable_type', 'Tipo de associação inválido.');
                    }
                }
            }
        ];
    }

    /**
     * Combina mensagens comuns com as específicas de vídeo.
     */
    public function messages(): array
    {
        $videoMessages = [
            'tipo.required' => 'É obrigatório selecionar o tipo de vídeo (Upload ou Link).',
            'tipo.in' => 'Tipo de vídeo inválido.',
            'video_upload.required' => 'O arquivo de vídeo é obrigatório para o tipo Upload.',
            'video_upload.mimes' => 'O arquivo de vídeo deve ser do tipo: mp4, webm ou ogg.',
            'video_upload.max' => 'O arquivo de vídeo não pode ser maior que 50MB.',
            'url_ou_path.required' => 'A URL do vídeo é obrigatória para o tipo Link.',
            'url_ou_path.url' => 'Por favor, insira uma URL válida.',
        ];
        // Mescla com as mensagens comuns
        return array_merge(parent::commonMessages(), $videoMessages);
    }
}

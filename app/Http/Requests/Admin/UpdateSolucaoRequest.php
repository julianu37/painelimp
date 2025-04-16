<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // Necessário para Rule::exists

class UpdateSolucaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Assumindo que qualquer admin autenticado pode atualizar
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Pega a solução que está sendo atualizada a partir da rota
        // $solucao = $this->route('solucao');

        return [
            // \'codigo_erro_id\' => \'required|exists:codigos_erro,id\', // Removido
            'codigos_erro'   => 'sometimes|required|array|min:1', // Se presente, deve ser array com pelo menos 1
            'codigos_erro.*' => 'sometimes|required|integer|exists:codigos_erro,id', // Cada ID deve existir
            'titulo'         => 'sometimes|required|string|max:255',
            'descricao'      => 'nullable|string',
            // Validações para uploads (opcional)
            'imagens'        => 'nullable|array',
            'imagens.*'      => 'nullable|image|mimes:jpeg,png,gif,webp|max:10240',
            'videos'         => 'nullable|array',
            'videos.*'       => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv|max:51200',
            'youtube_link'   => 'nullable|url|regex:/^(https?:\/\/)?(www\\.)?(youtube\\.com|youtu\\.be)\/.+$/',
            // Validações para remoção de mídias existentes
            'remover_imagens' => 'nullable|array',
            'remover_imagens.*' => 'integer|exists:imagens,id',
            'remover_videos' => 'nullable|array',
            'remover_videos.*' => 'integer|exists:videos,id',
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
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.max' => 'O título não pode ter mais que 255 caracteres.',

            // Mensagens para imagens
            'imagens.*.image' => 'O arquivo enviado em imagens deve ser uma imagem válida.',
            'imagens.*.mimes' => 'A imagem deve ser de um dos tipos: jpeg, png, jpg, gif, webp.',
            'imagens.*.max' => 'Cada imagem não pode ter mais que 10MB.',

            // Mensagens para vídeos
            'videos.*.file' => 'O arquivo enviado em vídeos deve ser um arquivo válido.',
            'videos.*.mimetypes' => 'O vídeo deve ser de um dos tipos: mp4, mov, avi, wmv.',
            'videos.*.max' => 'Cada vídeo não pode ter mais que 50MB.',

            // Mensagens para link do YouTube
            'youtube_link.url' => 'O link do YouTube deve ser uma URL válida.',
        ];
    }
}

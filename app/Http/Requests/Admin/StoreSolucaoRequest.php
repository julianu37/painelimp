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
            // \'codigo_erro_id\' => \'required|exists:codigos_erro,id\', // Removido
            'codigos_erro'   => 'required|array|min:1', // Pelo menos um código deve ser selecionado
            'codigos_erro.*' => 'required|integer|exists:codigos_erro,id', // Cada ID no array deve existir
            'titulo'         => 'required|string|max:255',
            'descricao'      => 'nullable|string',
            // Validações para uploads (opcional, podem ficar como estão)
            'imagens'        => 'nullable|array',
            'imagens.*'      => 'nullable|image|mimes:jpeg,png,gif,webp|max:10240', // Max 10MB
            'videos'         => 'nullable|array',
            'videos.*'       => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv|max:51200', // Max 50MB
            'youtube_link'   => 'nullable|url|regex:/^(https?:\/\/)?(www\\.)?(youtube\\.com|youtu\\.be)\/.+$/',
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

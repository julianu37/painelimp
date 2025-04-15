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
            // codigo_erro_id não é validado na atualização, pois não permitimos alterar pelo form principal
            // 'codigo_erro_id' => ['required', 'integer', Rule::exists('codigos_erro', 'id')],

            // título é obrigatório, string, máximo 255 caracteres
            'titulo' => ['required', 'string', 'max:255'],

            // descrição é opcional, mas se presente, deve ser string
            'descricao' => ['nullable', 'string'],

            // Validação para imagens (array, cada item é imagem, max 10MB)
            'imagens' => ['nullable', 'array'],
            'imagens.*' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:10240'],

            // Validação para vídeos (array, cada item é vídeo, max 50MB)
            'videos' => ['nullable', 'array'],
            'videos.*' => ['file', 'mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv', 'max:51200'],

            // Validação para link do YouTube (opcional, URL válida do youtube)
            'youtube_link' => ['nullable', 'string', 'url', function ($attribute, $value, $fail) {
                if ($value && !preg_match('/^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_\-]+)/i', $value)) {
                    $fail('O campo :attribute deve ser um link válido do YouTube (youtube.com ou youtu.be).');
                }
            }],

            // TODO: Adicionar validação para exclusão de mídias existentes (ex: array de IDs a remover)
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

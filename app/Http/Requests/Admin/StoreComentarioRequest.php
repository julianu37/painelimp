<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreComentarioRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     * Apenas usuários autenticados (admin ou tecnico) podem comentar.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Obtém as regras de validação que se aplicam à requisição.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Conteúdo do comentário é obrigatório
            'conteudo' => ['required', 'string'],
            // Mídias são opcionais, mas se enviadas, devem ser um array
            'midias' => ['nullable', 'array'],
            // Validação para cada arquivo dentro do array 'midias'
            'midias.*' => [
                'file',
                // Tipos MIME permitidos: imagens (jpeg, png, gif, webp), pdf, video mp4
                'mimes:jpeg,png,gif,webp,pdf,mp4',
                // Tamanho máximo: 10MB (ajuste conforme necessário)
                'max:10240' // 10MB = 10 * 1024 KB
            ],
            // Link do YouTube é opcional, mas se enviado, deve ser uma URL válida do YouTube
            'youtube_link' => [
                'nullable',
                'url',
                // Regex para validar URLs de embed ou watch do YouTube
                'regex:/^(https?:\/\/)?(www\.)?(youtube\.com\/(embed\/|watch\?v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/'
            ],
        ];
    }

    /**
     * Obtém as mensagens de erro personalizadas.
     */
    public function messages(): array
    {
        return [
            'conteudo.required' => 'O conteúdo do comentário é obrigatório.',
            'midias.array' => 'O campo de mídias deve ser um conjunto de arquivos.',
            'midias.*.file' => 'Cada mídia deve ser um arquivo válido.',
            'midias.*.mimes' => 'Tipo de arquivo inválido. Permitidos: JPG, PNG, GIF, WebP, PDF, MP4.',
            'midias.*.max' => 'Cada arquivo não pode exceder 10MB.',
            'youtube_link.url' => 'O link do YouTube deve ser uma URL válida.',
            'youtube_link.regex' => 'O link fornecido não parece ser um link válido do YouTube.',
        ];
    }
}

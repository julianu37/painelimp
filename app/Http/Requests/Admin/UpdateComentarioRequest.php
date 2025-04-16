<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth; // Para verificar a role se necessário
use App\Rules\MaxTotalFileSize; // Assumindo que criaremos esta regra
use App\Rules\MaxTotalFiles; // Assumindo que criaremos esta regra

class UpdateComentarioRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        // A autorização principal é feita no controller usando a Policy.
        // Aqui, garantimos que o usuário esteja pelo menos logado.
        return Auth::check();
    }

    /**
     * Retorna as regras de validação que se aplicam à requisição.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Valida apenas o conteúdo, pois não permitiremos edição de mídias aqui
            'conteudo' => ['required', 'string', 'max:5000'], // Ajuste o max se necessário
            // Validação para novas mídias
            // Limites: Máx 10 arquivos, 1280MB (1.25GB) total
            'midias' => ['nullable', 'array', new MaxTotalFiles(10), new MaxTotalFileSize(1280 * 1024)],
            'midias.*' => [
                'file',
                'mimes:jpg,jpeg,png,gif,webp,pdf,mp4,mov,avi,wmv',
                'max:' . (128 * 1024) // Max 128MB por arquivo individual
            ],
            'youtube_link' => ['nullable', 'url', 'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/'],
            // Validação para IDs de mídia a serem removidos
            'remover_midias' => ['nullable', 'array'],
            'remover_midias.*' => ['integer', 'exists:midia_comentarios,id'], // Garante que os IDs existam na tabela
        ];
    }

    /**
     * Mensagens de erro personalizadas.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'conteudo.required' => 'O conteúdo do comentário não pode ficar vazio.',
            'conteudo.string' => 'O conteúdo do comentário deve ser um texto.',
            'conteudo.max' => 'O conteúdo do comentário é muito longo.',
            'midias.*.mimes' => 'Um dos arquivos anexados possui um formato não suportado.',
            'midias.*.max' => 'Um dos arquivos anexados excede o limite de 128MB.',
            'youtube_link.url' => 'O link do YouTube deve ser uma URL válida.',
            'youtube_link.regex' => 'O link fornecido não parece ser um link válido do YouTube.',
            'remover_midias.*.exists' => 'Uma das mídias marcadas para remoção não foi encontrada.',
        ];
    }
}

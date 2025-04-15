<?php

namespace App\Http\Requests\Admin;

// use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// Não precisa herdar de StoreMediaRequest
use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Retorna as regras de validação que se aplicam à requisição.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => ['nullable', 'string', 'max:255'],
            'tipo' => ['required', Rule::in(['upload', 'link'])],
            // Regras condicionais - upload não é obrigatório na edição
            'video_upload' => [
                'nullable', // Não obrigatório na edição
                'file',
                'mimes:mp4,webm,ogg',
                'max:51200' // Máx 50MB
            ],
            // URL é obrigatória apenas se tipo for link
            'url_ou_path' => [
                Rule::requiredIf($this->input('tipo') === 'link'),
                'nullable',
                'url',
                'max:1024'
            ],
        ];
    }

    /**
     * Mensagens de erro customizadas (opcional).
     */
    public function messages(): array
    {
        return [
            'tipo.required' => 'É obrigatório selecionar o tipo de vídeo (Upload ou Link).',
            'tipo.in' => 'Tipo de vídeo inválido.',
            'video_upload.mimes' => 'O arquivo de vídeo deve ser do tipo: mp4, webm ou ogg.',
            'video_upload.max' => 'O arquivo de vídeo não pode ser maior que 50MB.',
            'url_ou_path.required' => 'A URL do vídeo é obrigatória para o tipo Link.',
            'url_ou_path.url' => 'Por favor, insira uma URL válida.',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class MidiaComentario extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'comentario_id',
        'tipo',
        'caminho',
        'nome_original',
        'tamanho',
    ];

    /**
     * Obtém o comentário ao qual esta mídia pertence.
     */
    public function comentario(): BelongsTo
    {
        return $this->belongsTo(Comentario::class);
    }

    /**
     * Acessor para obter a URL completa do arquivo (se for armazenado localmente).
     * Considera diferentes tipos de mídia.
     */
    public function getUrlAttribute(): ?string
    {
        if ($this->tipo === 'video_youtube') {
            // Retorna a URL de embed do YouTube
            // Espera-se que 'caminho' contenha o ID do vídeo
            return "https://www.youtube.com/embed/{$this->caminho}";
        } elseif (in_array($this->tipo, ['imagem', 'video_mp4', 'pdf']) && $this->caminho && Storage::disk('public')->exists($this->caminho)) {
            // Retorna a URL para arquivos armazenados no disco 'public'
            return Storage::disk('public')->url($this->caminho);
        }

        return null; // Retorna null se o tipo for desconhecido ou o arquivo não existir
    }

    /**
     * Acessor para verificar se a mídia é uma imagem.
     */
    public function getIsImagemAttribute(): bool
    {
        return $this->tipo === 'imagem';
    }

    /**
     * Acessor para verificar se a mídia é um vídeo MP4.
     */
    public function getIsVideoMp4Attribute(): bool
    {
        return $this->tipo === 'video_mp4';
    }

    /**
     * Acessor para verificar se a mídia é um vídeo do YouTube.
     */
    public function getIsVideoYoutubeAttribute(): bool
    {
        return $this->tipo === 'video_youtube';
    }

    /**
     * Acessor para verificar se a mídia é um PDF.
     */
    public function getIsPdfAttribute(): bool
    {
        return $this->tipo === 'pdf';
    }
}

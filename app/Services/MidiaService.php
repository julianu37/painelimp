<?php

namespace App\Services;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MidiaService
{
    /**
     * Processa uploads de arquivos e links do YouTube para um comentário.
     *
     * @param Request $request
     * @param Comentario $comentario
     * @return void
     */
    public function handleUploads(Request $request, Comentario $comentario): void
    {
        // Lógica para lidar com uploads de arquivos (midias[])
        if ($request->hasFile('midias')) {
            foreach ($request->file('midias') as $arquivo) {
                try {
                    $tipo = $this->getTipoMidia($arquivo->getMimeType());
                    if (!$tipo) {
                        Log::warning("Tipo de arquivo não suportado pulado: " . $arquivo->getClientOriginalName() . " (" . $arquivo->getMimeType() . ")");
                        continue; // Pula se o tipo não for reconhecido
                    }

                    // Salva o arquivo no storage público
                    // Caminho: comentarios/{comentario_id}/hash_nome.ext
                    $path = $arquivo->store("comentarios/{$comentario->id}", 'public');

                    $comentario->midias()->create([
                        'tipo' => $tipo,
                        'caminho' => $path,
                        'nome_original' => $arquivo->getClientOriginalName(),
                        'tamanho' => $arquivo->getSize(),
                    ]);
                } catch (\Exception $e) {
                    Log::error("Erro ao processar upload de arquivo para comentário ID {$comentario->id}: " . $e->getMessage());
                    // Considerar continuar ou parar o loop dependendo da criticidade
                }
            }
        }

        // Lógica para lidar com link do YouTube (youtube_link)
        if ($request->filled('youtube_link')) {
            try {
                $youtubeId = $this->extractYouTubeId($request->input('youtube_link'));
                if ($youtubeId) {
                    // Remove links de youtube anteriores para este comentário, se houver
                    $comentario->midias()->where('tipo', 'video_youtube')->delete();
                    // Adiciona o novo link
                    $comentario->midias()->create([
                        'tipo' => 'video_youtube',
                        'caminho' => $youtubeId, // Armazena apenas o ID
                        'nome_original' => 'YouTube Video',
                    ]);
                }
            } catch (\Exception $e) {
                Log::error("Erro ao processar link do YouTube para comentário ID {$comentario->id}: " . $e->getMessage());
            }
        }
    }

    /**
     * Determina o tipo de mídia com base no MIME Type.
     *
     * @param string $mimeType
     * @return string|null
     */
    private function getTipoMidia(string $mimeType): ?string
    {
        if (Str::startsWith($mimeType, 'image/')) return 'imagem';
        if ($mimeType === 'application/pdf') return 'pdf';
        if ($mimeType === 'video/mp4') return 'video_mp4'; // Adicionar outros tipos de vídeo se necessário
        // Adicionar mais tipos conforme necessário (ex: 'video/quicktime', 'video/webm')
        return null;
    }

    /**
     * Extrai o ID de um vídeo do YouTube de uma URL.
     *
     * @param string $url
     * @return string|null
     */
    private function extractYouTubeId(string $url): ?string
    {
        // Regex melhorado para diferentes formatos de URL do YouTube
        preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }

    /**
     * Exclui os arquivos de mídia associados a um comentário.
     *
     * @param Comentario $comentario
     * @return void
     */
    public function deleteAssociatedFiles(Comentario $comentario): void
    {
        // Exclui o diretório de mídia do comentário no storage 'public'
        $directory = "comentarios/{$comentario->id}";
        if (Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->deleteDirectory($directory);
            Log::info("Diretório de mídia excluído para comentário ID {$comentario->id}: public/{$directory}");
        }
        // Nota: Links do YouTube não têm arquivos físicos para excluir.
    }

    /**
     * Exclui um único arquivo de mídia física associado a um registro MidiaComentario.
     *
     * @param \App\Models\MidiaComentario $midia
     * @return bool True se o arquivo foi excluído ou não existia, False em caso de erro.
     */
    public function deleteSingleMediaFile(\App\Models\MidiaComentario $midia): bool
    {
        // Não exclui arquivos para links do YouTube
        if ($midia->tipo === 'video_youtube') {
            return true;
        }

        // Verifica se o caminho existe e tenta excluir
        if ($midia->caminho && Storage::disk('public')->exists($midia->caminho)) {
            try {
                if (Storage::disk('public')->delete($midia->caminho)) {
                    Log::info("Arquivo de mídia excluído: public/{$midia->caminho}");
                    return true;
                } else {
                    Log::warning("Falha ao excluir arquivo de mídia (Storage::delete retornou false): public/{$midia->caminho}");
                    return false;
                }
            } catch (\Exception $e) {
                Log::error("Erro ao excluir arquivo de mídia public/{$midia->caminho}: " . $e->getMessage());
                return false;
            }
        } elseif ($midia->caminho) {
            Log::info("Arquivo de mídia não encontrado para exclusão: public/{$midia->caminho}");
        }

        // Retorna true se o caminho não foi definido ou o arquivo não existia
        return true;
    }
} 
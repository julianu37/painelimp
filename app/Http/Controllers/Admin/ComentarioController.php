<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreComentarioRequest;
use App\Models\Comentario;
use App\Models\MidiaComentario;
use App\Models\CodigoErro; // Importa o modelo CodigoErro
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Para usar transações
use Illuminate\Support\Facades\Log; // Para logs de erro
use Illuminate\Support\Facades\Storage; // Para manipulação de arquivos
use Illuminate\Support\Str; // Para extrair ID do YouTube

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComentarioRequest $request, string $comentavel_type, int $comentavel_id): RedirectResponse
    {
        $validated = $request->validated();
        $user = Auth::user();

        // Determina o namespace completo do modelo comentavel
        // Por enquanto, só suportamos CodigoErro
        if ($comentavel_type !== 'codigo_erro') {
            Log::warning("Tentativa de comentar em tipo não suportado: {$comentavel_type}");
            return back()->with('error', 'Tipo de item a ser comentado não suportado.');
        }
        $modelClass = 'App\\Models\\CodigoErro'; // Ajustar se precisar de mais tipos

        // Encontra o modelo pai (ex: CodigoErro)
        $comentavel = $modelClass::find($comentavel_id);

        if (!$comentavel) {
            Log::error("Modelo comentavel não encontrado: {$modelClass} com ID {$comentavel_id}");
            return back()->with('error', 'Item a ser comentado não encontrado.');
        }

        DB::beginTransaction();
        try {
            // 1. Cria o comentário
            $comentario = $comentavel->comentarios()->create([
                'user_id' => $user->id,
                'conteudo' => $validated['conteudo'],
            ]);

            // 2. Processa e salva as mídias (arquivos)
            if ($request->hasFile('midias')) {
                foreach ($request->file('midias') as $arquivo) {
                    $tipo = $this->getTipoMidia($arquivo->getMimeType());
                    if (!$tipo) continue; // Pula se o tipo não for reconhecido

                    // Salva o arquivo no storage público
                    // Caminho: comentarios/{comentario_id}/nome_arquivo.ext
                    $path = $arquivo->store("comentarios/{$comentario->id}", 'public');

                    $comentario->midias()->create([
                        'tipo' => $tipo,
                        'caminho' => $path,
                        'nome_original' => $arquivo->getClientOriginalName(),
                        'tamanho' => $arquivo->getSize(),
                    ]);
                }
            }

            // 3. Processa o link do YouTube
            if (!empty($validated['youtube_link'])) {
                $youtubeId = $this->extractYouTubeId($validated['youtube_link']);
                if ($youtubeId) {
                    $comentario->midias()->create([
                        'tipo' => 'video_youtube',
                        'caminho' => $youtubeId, // Armazena apenas o ID
                        'nome_original' => 'YouTube Video',
                    ]);
                }
            }

            DB::commit();
            return back()->with('success', 'Comentário adicionado com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Erro ao salvar comentário para {$modelClass} ID {$comentavel_id}: " . $e->getMessage());
            // Tentar excluir arquivos órfãos que podem ter sido salvos antes do erro
            Storage::disk('public')->deleteDirectory("comentarios/{$comentario->id}");

            return back()->with('error', 'Erro ao salvar comentário. Por favor, tente novamente.');
        }
    }

    /**
     * Determina o tipo de mídia com base no MIME Type.
     */
    private function getTipoMidia(string $mimeType): ?string
    {
        if (Str::startsWith($mimeType, 'image/')) return 'imagem';
        if ($mimeType === 'application/pdf') return 'pdf';
        if ($mimeType === 'video/mp4') return 'video_mp4';
        return null;
    }

    /**
     * Extrai o ID de um vídeo do YouTube de uma URL.
     */
    private function extractYouTubeId(string $url): ?string
    {
        // Regex para extrair o ID de diferentes formatos de URL do YouTube
        preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }

    /**
     * Display the specified resource.
     */
    public function show(Comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comentario $comentario)
    {
        //
    }

    /**
     * Remove o comentário especificado do banco de dados.
     */
    public function destroy(Comentario $comentario): RedirectResponse
    {
        try {
            $codigoErroSlug = $comentario->codigoErro->slug; // Pega o slug antes de deletar
            $comentario->delete();

            // Tenta redirecionar de volta para a página do código de erro
            // Ou para uma lista de comentários do admin se existir
            // Por simplicidade, vamos tentar voltar à página anterior ou dashboard admin
            return back()->with('success', 'Comentário excluído com sucesso!');
            // Alternativa: return redirect()->route('admin.codigos.show', $codigoErroSlug)->with(...) se tiver essa view

        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir comentário: ' . $e->getMessage());
        }
    }
}

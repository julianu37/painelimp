<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Solucao;
use App\Models\CodigoErro;
use App\Http\Requests\Admin\StoreSolucaoRequest;
use App\Http\Requests\Admin\UpdateSolucaoRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Imagem;
use App\Models\Video;

class SolucaoController extends Controller
{
    /**
     * Exibe uma lista paginada das soluções.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $solucoes = Solucao::with('codigoErro')->orderBy('titulo')->paginate(15);

        return view('admin.solucoes.index', compact('solucoes'));
    }

    /**
     * Mostra o formulário para criar uma nova solução.
     * Recebe opcionalmente o ID do código de erro via query string.
     */
    public function create(Request $request): View
    {
        $codigosErro = CodigoErro::orderBy('codigo')->pluck('codigo', 'id');
        // Pega o ID do código de erro da query string, se existir
        $selectedCodigoErroId = $request->query('codigo_erro_id');
        return view('admin.solucoes.create', compact('codigosErro', 'selectedCodigoErroId'));
    }

    /**
     * Salva uma nova solução no banco de dados.
     *
     * @param \App\Http\Requests\Admin\StoreSolucaoRequest $formRequest
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSolucaoRequest $formRequest, Request $request): RedirectResponse
    {
        $validatedData = $formRequest->validated();

        try {
            // Cria a solução primeiro para obter o ID
            $solucao = Solucao::create($validatedData);

            // Processa e salva imagens
            if ($request->hasFile('imagens')) {
                foreach ($request->file('imagens') as $imagemFile) {
                    $nomeOriginal = $imagemFile->getClientOriginalName();
                    $path = $imagemFile->store('solucoes/' . $solucao->id . '/imagens', 'public');
                    $solucao->imagens()->create([
                        'path' => $path,
                        'url' => Storage::disk('public')->url($path),
                        'nome_original' => $nomeOriginal,
                        'titulo' => Str::beforeLast($nomeOriginal, '.') // Usa nome original como título padrão
                    ]);
                }
            }

            // Processa e salva vídeos (upload)
            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $videoFile) {
                    $nomeOriginal = $videoFile->getClientOriginalName();
                    $path = $videoFile->store('solucoes/' . $solucao->id . '/videos', 'public');
                    $solucao->videos()->create([
                        'tipo' => 'upload',
                        'path' => $path,
                        'url_ou_path' => Storage::disk('public')->url($path),
                        'nome_original' => $nomeOriginal,
                        'titulo' => Str::beforeLast($nomeOriginal, '.')
                    ]);
                }
            }

            // Processa link do YouTube
            if ($request->filled('youtube_link')) {
                $solucao->videos()->create([
                    'tipo' => 'link',
                    'url_ou_path' => $request->input('youtube_link'),
                    'titulo' => 'Vídeo YouTube' // Título padrão para link
                ]);
            }

            return redirect()->route('admin.solucoes.index')->with('success', 'Solução criada com sucesso!');
        } catch (\Exception $e) {
            // Se deu erro, tenta remover a solução criada (se houver ID)
            if (isset($solucao) && $solucao->id) {
                // Tentar remover diretório e a própria solução
                Storage::disk('public')->deleteDirectory('solucoes/' . $solucao->id);
                $solucao->delete();
            }
            return back()->with('error', 'Erro ao criar solução: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Exibe os detalhes de uma solução específica.
     * Eager load dos relacionamentos para mostrar na view.
     *
     * @param \App\Models\Solucao $solucao Route Model Binding
     * @return \Illuminate\View\View
     */
    public function show(Solucao $solucao): View
    {
        $solucao->load('codigoErro', 'imagens', 'videos');

        return view('admin.solucoes.show', compact('solucao'));
    }

    /**
     * Mostra o formulário para editar uma solução existente.
     *
     * @param \App\Models\Solucao $solucao Route Model Binding
     * @return \Illuminate\View\View
     */
    public function edit(Solucao $solucao): View
    {
        return view('admin.solucoes.edit', compact('solucao'));
    }

    /**
     * Atualiza uma solução existente no banco de dados.
     *
     * @param \App\Http\Requests\Admin\UpdateSolucaoRequest $request
     * @param \App\Models\Solucao $solucao Route Model Binding
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSolucaoRequest $formRequest, Request $request, Solucao $solucao): RedirectResponse
    {
        $validatedData = $formRequest->validated();

        try {
            // 1. Remover mídias marcadas para exclusão
            $imagensParaRemover = $request->input('remover_imagens', []);
            if (!empty($imagensParaRemover)) {
                $imagens = Imagem::whereIn('id', $imagensParaRemover)
                                ->where('imageable_id', $solucao->id)
                                ->where('imageable_type', Solucao::class)
                                ->get();
                foreach ($imagens as $imagem) {
                    Storage::disk('public')->delete($imagem->path);
                    $imagem->delete();
                }
            }

            $videosParaRemover = $request->input('remover_videos', []);
            if (!empty($videosParaRemover)) {
                $videos = Video::whereIn('id', $videosParaRemover)
                               ->where('videoable_id', $solucao->id)
                               ->where('videoable_type', Solucao::class)
                               ->get();
                foreach ($videos as $video) {
                    if ($video->tipo === 'upload') {
                        Storage::disk('public')->delete($video->path);
                    }
                    $video->delete();
                }
            }

            // 2. Atualizar dados da solução
            $solucao->update($validatedData);

            // 3. Processar e salvar novas imagens (mesma lógica do store)
            if ($request->hasFile('imagens')) {
                foreach ($request->file('imagens') as $imagemFile) {
                    $nomeOriginal = $imagemFile->getClientOriginalName();
                    $path = $imagemFile->store('solucoes/' . $solucao->id . '/imagens', 'public');
                    $solucao->imagens()->create([
                        'path' => $path,
                        'url' => Storage::disk('public')->url($path),
                        'nome_original' => $nomeOriginal,
                        'titulo' => Str::beforeLast($nomeOriginal, '.')
                    ]);
                }
            }

            // 4. Processar e salvar novos vídeos (upload - mesma lógica do store)
            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $videoFile) {
                    $nomeOriginal = $videoFile->getClientOriginalName();
                    $path = $videoFile->store('solucoes/' . $solucao->id . '/videos', 'public');
                    $solucao->videos()->create([
                        'tipo' => 'upload',
                        'path' => $path,
                        'url_ou_path' => Storage::disk('public')->url($path),
                        'nome_original' => $nomeOriginal,
                        'titulo' => Str::beforeLast($nomeOriginal, '.')
                    ]);
                }
            }

            // 5. Processar link do YouTube (sobrescreve/cria novo - mesma lógica do store)
            //    -> Poderia refinar para atualizar o link existente se já houver um
            if ($request->filled('youtube_link')) {
                 // Remove link antigo, se existir e se um novo link for fornecido
                 $solucao->videos()->where('tipo', 'link')->delete();

                 // Cria o novo link
                 $solucao->videos()->create([
                    'tipo' => 'link',
                    'url_ou_path' => $request->input('youtube_link'),
                    'titulo' => 'Vídeo YouTube'
                ]);
            } elseif ($request->has('youtube_link') && $request->input('youtube_link') === null) {
                 // Se o campo foi enviado como vazio/null, remove o link existente
                 $solucao->videos()->where('tipo', 'link')->delete();
            }
            // Se o campo youtube_link não for enviado no request, não faz nada com links existentes.

            return redirect()->route('admin.solucoes.index')->with('success', 'Solução atualizada com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar solução: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove uma solução do banco de dados.
     * NOTA: As imagens e vídeos associados NÃO são excluídos automaticamente aqui.
     * Isso teria que ser feito manualmente ou através de listeners de evento no Model.
     *
     * @param \App\Models\Solucao $solucao Route Model Binding
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Solucao $solucao): RedirectResponse
    {
        try {
             // 1. Excluir imagens associadas (arquivo e registro)
            foreach ($solucao->imagens as $imagem) {
                Storage::disk('public')->delete($imagem->path);
                $imagem->delete();
            }

            // 2. Excluir vídeos associados (arquivo e registro - apenas tipo 'upload')
            foreach ($solucao->videos as $video) {
                if ($video->tipo === 'upload') {
                    Storage::disk('public')->delete($video->path);
                }
                $video->delete();
            }

            // 3. Excluir diretório da solução no storage
            Storage::disk('public')->deleteDirectory('solucoes/' . $solucao->id);

            // 4. Excluir a própria solução
            $solucao->delete();

            return redirect()->route('admin.solucoes.index')->with('success', 'Solução e mídias associadas excluídas com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.solucoes.index')->with('error', 'Erro ao excluir solução: ' . $e->getMessage());
        }
    }
}

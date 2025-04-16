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
        $solucoes = Solucao::withCount('codigosErro')->orderBy('titulo')->paginate(15);

        return view('admin.solucoes.index', compact('solucoes'));
    }

    /**
     * Mostra o formulário para criar uma nova solução.
     */
    public function create(Request $request): View
    {
        $codigosErro = CodigoErro::orderBy('codigo')->get(['id', 'codigo']);
        $selectedCodigosErroIds = old('codigos_erro', []);
        return view('admin.solucoes.create', compact('codigosErro', 'selectedCodigosErroIds'));
    }

    /**
     * Salva uma nova solução e sincroniza os códigos de erro associados.
     */
    public function store(StoreSolucaoRequest $formRequest): RedirectResponse
    {
        $validatedData = $formRequest->validated();
        $codigosErroIds = $validatedData['codigos_erro'] ?? [];
        unset($validatedData['codigos_erro']);

        try {
            $solucao = Solucao::create($validatedData);

            $solucao->codigosErro()->sync($codigosErroIds);

            if ($formRequest->hasFile('imagens')) {
                foreach ($formRequest->file('imagens') as $imagemFile) {
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

            if ($formRequest->hasFile('videos')) {
                foreach ($formRequest->file('videos') as $videoFile) {
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

            if ($formRequest->filled('youtube_link')) {
                $solucao->videos()->create([
                    'tipo' => 'link',
                    'url_ou_path' => $formRequest->input('youtube_link'),
                    'titulo' => 'Vídeo YouTube'
                ]);
            }

            return redirect()->route('admin.solucoes.index')->with('success', 'Solução criada com sucesso!');
        } catch (\Exception $e) {
            if (isset($solucao) && $solucao->id) {
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
        $solucao->load('codigosErro', 'imagens', 'videos');

        return view('admin.solucoes.show', compact('solucao'));
    }

    /**
     * Mostra o formulário para editar uma solução existente.
     */
    public function edit(Solucao $solucao): View
    {
        $codigosErro = CodigoErro::orderBy('codigo')->get(['id', 'codigo']);
        $solucao->load('codigosErro:id');
        $selectedCodigosErroIds = old('codigos_erro', $solucao->codigosErro->pluck('id')->toArray());

        return view('admin.solucoes.edit', compact('solucao', 'codigosErro', 'selectedCodigosErroIds'));
    }

    /**
     * Atualiza uma solução existente e sincroniza os códigos de erro.
     */
    public function update(UpdateSolucaoRequest $formRequest, Solucao $solucao): RedirectResponse
    {
        $validatedData = $formRequest->validated();
        $codigosErroIds = $validatedData['codigos_erro'] ?? null;
        if (array_key_exists('codigos_erro', $validatedData)) {
             unset($validatedData['codigos_erro']);
        }

        try {
            $imagensParaRemover = $formRequest->input('remover_imagens', []);
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

            $videosParaRemover = $formRequest->input('remover_videos', []);
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

            $solucao->update($validatedData);

            if ($codigosErroIds !== null) {
                $solucao->codigosErro()->sync($codigosErroIds);
            }

            if ($formRequest->hasFile('imagens')) {
                foreach ($formRequest->file('imagens') as $imagemFile) {
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

            if ($formRequest->hasFile('videos')) {
                foreach ($formRequest->file('videos') as $videoFile) {
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

            if ($formRequest->filled('youtube_link')) {
                $solucao->videos()->where('tipo', 'link')->delete();
                $solucao->videos()->create([
                    'tipo' => 'link',
                    'url_ou_path' => $formRequest->input('youtube_link'),
                    'titulo' => 'Vídeo YouTube'
                ]);
            } elseif ($formRequest->has('youtube_link') && $formRequest->input('youtube_link') === null) {
                $solucao->videos()->where('tipo', 'link')->delete();
            }

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
            foreach ($solucao->imagens as $imagem) {
                Storage::disk('public')->delete($imagem->path);
                $imagem->delete();
            }

            foreach ($solucao->videos as $video) {
                if ($video->tipo === 'upload') {
                    Storage::disk('public')->delete($video->path);
                }
                $video->delete();
            }

            Storage::disk('public')->deleteDirectory('solucoes/' . $solucao->id);

            $solucao->delete();

            return redirect()->route('admin.solucoes.index')->with('success', 'Solução e mídias associadas excluídas com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.solucoes.index')->with('error', 'Erro ao excluir solução: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use App\Models\CodigoErro;
use App\Models\Solucao;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVideoRequest;
use App\Http\Requests\Admin\UpdateVideoRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class VideoController extends Controller
{
    /**
     * Diretório para uploads de vídeos.
     */
    private string $uploadPath = 'videos';

    /**
     * Exibe uma lista dos vídeos.
     */
    public function index(): View
    {
        $videos = Video::with('videoable')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Mostra o formulário para criar um novo vídeo.
     */
    public function create(): View
    {
        // Busca associações possíveis (similar ao ImagemController)
        $codigosErro = CodigoErro::orderBy('codigo')->get(['id', 'codigo']);
        $solucoes = Solucao::with('codigoErro:id,codigo')->orderBy('codigo_erro_id')->get(['id', 'titulo', 'codigo_erro_id']);
        $associacoes = [
            'Códigos de Erro' => $codigosErro->mapWithKeys(fn($item) => [CodigoErro::class.'-'.$item->id => $item->codigo])->all(),
            'Soluções' => $solucoes->mapWithKeys(fn($item) => [Solucao::class.'-'.$item->id => $item->codigoErro->codigo . ' > ' . $item->titulo])->all(),
        ];
        return view('admin.videos.create', compact('associacoes'));
    }

    /**
     * Salva um novo vídeo (link ou upload) e o associa ao modelo pai.
     */
    public function store(StoreVideoRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $dataToSave = [
            'titulo' => $validated['titulo'] ?? null,
            'tipo' => $validated['tipo'],
            'videoable_id' => $validated['attachable_id'],
            'videoable_type' => $validated['attachable_type'],
            'url_ou_path' => null, // Inicializa como null
        ];
        $uploadedPath = null; // Para possível deleção em caso de erro

        try {
            if ($validated['tipo'] === 'upload') {
                $uploadedPath = $request->file('video_upload')->store($this->uploadPath, 'public');
                $dataToSave['url_ou_path'] = $uploadedPath;
            } else { // tipo === 'link'
                $dataToSave['url_ou_path'] = $validated['url_ou_path'];
            }

            Video::create($dataToSave);

            $redirectRoute = $this->getAttachableShowRoute($validated['attachable_type'], $validated['attachable_id']);

            return redirect($redirectRoute ?? route('admin.videos.index'))
                   ->with('success', 'Vídeo adicionado com sucesso!');

        } catch (\Exception $e) {
            // Se fez upload e deu erro no DB, remove o arquivo
            if ($uploadedPath && Storage::disk('public')->exists($uploadedPath)) {
                Storage::disk('public')->delete($uploadedPath);
            }
            return back()->with('error', 'Erro ao criar vídeo: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Helper para obter a rota show do item associado.
     * (Igual ao do ImagemController - pode ser movido para Trait/BaseController)
     */
    private function getAttachableShowRoute(string $type, int $id): ?string
    {
        $modelShortName = strtolower(class_basename($type));
        $routeBase = 'admin.' . Str::plural($modelShortName);

        if ($modelShortName === 'codigoerro') {
            $modelInstance = \App\Models\CodigoErro::find($id);
            return $modelInstance ? route($routeBase . '.show', $modelInstance) : null;
        }
        if (Route::has($routeBase . '.show')) {
            return route($routeBase . '.show', $id);
        }
        return null;
    }

    /**
     * Exibe os detalhes de um vídeo específico.
     */
    public function show(Video $video): View
    {
        $video->load('videoable');
        return view('admin.videos.show', compact('video'));
    }

    /**
     * Mostra o formulário para editar um vídeo existente.
     */
    public function edit(Video $video): View
    {
        $video->load('videoable');
        return view('admin.videos.edit', compact('video'));
    }

    /**
     * Atualiza um vídeo existente.
     */
    public function update(UpdateVideoRequest $request, Video $video): RedirectResponse
    {
        $validated = $request->validated();
        $oldFilePath = ($video->tipo === 'arquivo') ? $video->url_ou_path : null;
        $newPath = null;

        try {
            $dataToUpdate = $validated;

            // Se for tipo arquivo e um novo arquivo foi enviado
            if ($video->tipo === 'arquivo' && $request->hasFile('url_ou_path')) {
                $newPath = $request->file('url_ou_path')->store($this->uploadPath, 'public');
                $dataToUpdate['url_ou_path'] = $newPath;

                // Apaga arquivo antigo se upload deu certo
                if ($oldFilePath && Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }
            } elseif ($video->tipo === 'link') {
                 // Se for link, apenas atualiza a URL (já validada)
                 $dataToUpdate['url_ou_path'] = $validated['url_ou_path'];
            } else {
                 // Se for arquivo mas não enviou novo, mantém o path antigo
                 // e remove a chave do request para não sobrescrever com null
                 unset($dataToUpdate['url_ou_path']);
            }

            $video->update($dataToUpdate);

            return redirect()->route('admin.videos.index')->with('success', 'Vídeo atualizado com sucesso!');
        } catch (\Exception $e) {
            // Se deu erro após upload do novo, remove-o
            if ($newPath && Storage::disk('public')->exists($newPath)) {
                Storage::disk('public')->delete($newPath);
            }
            return back()->with('error', 'Erro ao atualizar vídeo: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove um vídeo do banco de dados e seu arquivo (se existir).
     */
    public function destroy(Video $video): RedirectResponse
    {
        try {
            $filePath = ($video->tipo === 'arquivo') ? $video->url_ou_path : null;
            $video->delete();

            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return redirect()->route('admin.videos.index')->with('success', 'Vídeo excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.videos.index')->with('error', 'Erro ao excluir vídeo: ' . $e->getMessage());
        }
    }
}

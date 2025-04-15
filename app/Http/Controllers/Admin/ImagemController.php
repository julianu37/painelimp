<?php

namespace App\Http\Controllers\Admin;

use App\Models\Imagem;
use App\Models\CodigoErro;
use App\Models\Solucao;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreImagemRequest;
use App\Http\Requests\Admin\UpdateImagemRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class ImagemController extends Controller
{
    /**
     * Diretório para uploads de imagens.
     */
    private string $uploadPath = 'imagens';

    /**
     * Exibe uma lista das imagens.
     */
    public function index(): View
    {
        // Carrega o relacionamento polimórfico para saber a qual item pertence
        $imagens = Imagem::with('imageable')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.imagens.index', compact('imagens'));
    }

    /**
     * Mostra o formulário para criar uma nova imagem.
     */
    public function create(): View
    {
        // Busca Códigos e Soluções para o select de associação
        $codigosErro = CodigoErro::orderBy('codigo')->get(['id', 'codigo']);
        $solucoes = Solucao::with('codigoErro:id,codigo')->orderBy('codigo_erro_id')->get(['id', 'titulo', 'codigo_erro_id']);

        // Formata os dados para um select agrupado ou selects separados na view
        $associacoes = [
            'Códigos de Erro' => $codigosErro->mapWithKeys(fn($item) => [CodigoErro::class.'-'.$item->id => $item->codigo])->all(),
            'Soluções' => $solucoes->mapWithKeys(fn($item) => [Solucao::class.'-'.$item->id => $item->codigoErro->codigo . ' > ' . $item->titulo])->all(),
        ];

        return view('admin.imagens.create', compact('associacoes'));
    }

    /**
     * Salva uma nova imagem no banco de dados e faz o upload,
     * associando-a ao modelo pai (Marca, Modelo, CodigoErro, etc.).
     */
    public function store(StoreImagemRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $path = $request->file('arquivo')->store($this->uploadPath, 'public');

            // Prepara dados para salvar, incluindo associação polimórfica
            $dataToSave = [
                'titulo' => $validated['titulo'] ?? null,
                'path' => $path,
                'imageable_id' => $validated['attachable_id'],
                'imageable_type' => $validated['attachable_type'],
            ];

            Imagem::create($dataToSave);

            // Tenta redirecionar de volta para a página do item associado
            // (Isso assume que temos uma rota 'show' para todos os tipos associáveis)
            $redirectRoute = $this->getAttachableShowRoute($validated['attachable_type'], $validated['attachable_id']);

            return redirect($redirectRoute ?? route('admin.imagens.index'))
                   ->with('success', 'Imagem adicionada com sucesso!');

        } catch (\Exception $e) {
            if (isset($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            return back()->with('error', 'Erro ao criar imagem: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Helper para obter a rota show do item associado.
     */
    private function getAttachableShowRoute(string $type, int $id): ?string
    {
        $modelShortName = strtolower(class_basename($type)); // ex: 'marca', 'codigoerro'
        $routeBase = 'admin.' . Str::plural($modelShortName); // ex: 'admin.marcas', 'admin.codigos'

        // Caso especial para CodigoErro que usa slug
        if ($modelShortName === 'codigoerro') {
            $modelInstance = \App\Models\CodigoErro::find($id);
            return $modelInstance ? route($routeBase . '.show', $modelInstance) : null;
        }

        // Para outros modelos que usam ID na rota
        if (Route::has($routeBase . '.show')) {
            return route($routeBase . '.show', $id);
        }

        return null;
    }

    /**
     * Exibe os detalhes de uma imagem específica.
     */
    public function show(Imagem $imagem): View
    {
        $imagem->load('imageable');
        return view('admin.imagens.show', compact('imagem'));
    }

    /**
     * Mostra o formulário para editar uma imagem existente.
     */
    public function edit(Imagem $imagem): View
    {
        $imagem->load('imageable');
        // Não precisa carregar associações aqui pois não permitimos alterar
        return view('admin.imagens.edit', compact('imagem'));
    }

    /**
     * Atualiza uma imagem existente.
     */
    public function update(UpdateImagemRequest $request, Imagem $imagem): RedirectResponse
    {
        $validated = $request->validated();
        $oldFilePath = $imagem->path;

        try {
            $dataToUpdate = $validated;

            if ($request->hasFile('arquivo')) {
                $path = $request->file('arquivo')->store($this->uploadPath, 'public');
                $dataToUpdate['path'] = $path;

                if ($oldFilePath && Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }
            }
            unset($dataToUpdate['arquivo']);

            $imagem->update($dataToUpdate);

            return redirect()->route('admin.imagens.index')->with('success', 'Imagem atualizada com sucesso!');
        } catch (\Exception $e) {
            if (isset($path) && $path !== $oldFilePath && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            return back()->with('error', 'Erro ao atualizar imagem: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove uma imagem do banco de dados e do storage.
     */
    public function destroy(Imagem $imagem): RedirectResponse
    {
        try {
            $filePath = $imagem->path;
            $imagem->delete();

            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return redirect()->route('admin.imagens.index')->with('success', 'Imagem excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.imagens.index')->with('error', 'Erro ao excluir imagem: ' . $e->getMessage());
        }
    }
}

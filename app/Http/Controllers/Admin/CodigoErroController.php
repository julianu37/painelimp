<?php

namespace App\Http\Controllers\Admin;

use App\Models\CodigoErro;
use App\Models\Modelo;
use App\Models\Marca;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCodigoErroRequest;
use App\Http\Requests\Admin\UpdateCodigoErroRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CodigoErroController extends Controller
{
    /**
     * Prepara os modelos agrupados por marca para o select.
     * Reutilizado do ManualController, poderia ir para um Trait ou BaseController.
     */
    private function getModelosAgrupados(): array
    {
        return Modelo::with('marca:id,nome')
            ->orderBy('marca_id')->orderBy('nome')
            ->get()
            ->groupBy('marca.nome')
            ->map(function ($modelos) {
                return $modelos->pluck('nome', 'id');
            })
            ->all();
    }

    /**
     * Exibe uma lista dos códigos de erro para administração.
     */
    public function index(): View
    {
        $codigosErro = CodigoErro::withCount('solucoes', 'modelos')
                        ->orderBy('codigo')->paginate(15);
        return view('admin.codigos.index', compact('codigosErro'));
    }

    /**
     * Mostra o formulário para criar um novo código de erro.
     */
    public function create(): View
    {
        $modelosAgrupados = $this->getModelosAgrupados();
        $selectedModelosIds = [];
        return view('admin.codigos.create', compact('modelosAgrupados', 'selectedModelosIds'));
    }

    /**
     * Salva um novo código de erro e sincroniza os modelos associados.
     */
    public function store(StoreCodigoErroRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $modelosIds = $validated['modelos'] ?? [];
        unset($validated['modelos']);

        try {
            $codigoErro = CodigoErro::create($validated);
            $codigoErro->modelos()->sync($modelosIds);

            return redirect()->route('admin.codigos.index')->with('success', 'Código de erro criado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar código de erro: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Exibe os detalhes de um código de erro, incluindo soluções, imagens, vídeos e comentários.
     */
    public function show(CodigoErro $codigo): View
    {
        // Carrega os relacionamentos necessários:
        // - solucoes: Soluções associadas
        // - imagens: Imagens associadas diretamente ao código
        // - videos: Vídeos associados diretamente ao código
        // - comentarios: Comentários associados
        // - comentarios.user: O usuário que fez cada comentário
        // - comentarios.midias: As mídias (arquivos/youtube) de cada comentário
        $codigo->load([
            'solucoes',
            'imagens',
            'videos',
            'comentarios' => function ($query) {
                $query->with(['user', 'midias'])->orderBy('created_at', 'desc'); // Carrega user e midias, ordena por mais recentes
            }
        ]);
        return view('admin.codigos_erro.show', compact('codigo'));
    }

    /**
     * Mostra o formulário para editar um código de erro existente.
     */
    public function edit(CodigoErro $codigoErro): View
    {
        $modelosAgrupados = $this->getModelosAgrupados();
        $codigoErro->load('modelos:id');
        return view('admin.codigos.edit', compact('codigoErro', 'modelosAgrupados'));
    }

    /**
     * Atualiza um código de erro existente e sincroniza os modelos.
     */
    public function update(UpdateCodigoErroRequest $request, CodigoErro $codigoErro): RedirectResponse
    {
        $validated = $request->validated();
        $modelosIds = $validated['modelos'] ?? [];
        unset($validated['modelos']);

        try {
            $codigoErro->update($validated);
            $codigoErro->modelos()->sync($modelosIds);

            return redirect()->route('admin.codigos.index')->with('success', 'Código de erro atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar código de erro: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove um código de erro do banco de dados.
     * Associações na tabela pivot serão removidas automaticamente (cascade).
     */
    public function destroy(CodigoErro $codigoErro): RedirectResponse
    {
        try {
            $codigoErro->delete();
            return redirect()->route('admin.codigos.index')->with('success', 'Código de erro excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.codigos.index')->with('error', 'Erro ao excluir código de erro: ' . $e->getMessage());
        }
    }
}

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
     * @param \App\Http\Requests\Admin\StoreSolucaoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSolucaoRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        try {
            Solucao::create($validatedData);

            return redirect()->route('admin.solucoes.index')->with('success', 'Solução criada com sucesso!');
        } catch (\Exception $e) {
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
    public function update(UpdateSolucaoRequest $request, Solucao $solucao): RedirectResponse
    {
        $validatedData = $request->validated();

        try {
            $solucao->update($validatedData);

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
            $solucao->delete();

            return redirect()->route('admin.solucoes.index')->with('success', 'Solução excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.solucoes.index')->with('error', 'Erro ao excluir solução: ' . $e->getMessage());
        }
    }
}

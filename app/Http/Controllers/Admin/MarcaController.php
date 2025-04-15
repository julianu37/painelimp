<?php

namespace App\Http\Controllers\Admin;

use App\Models\Marca;
use App\Http\Controllers\Controller;
// Importa os FormRequests específicos para validação
use App\Http\Requests\Admin\StoreMarcaRequest;
use App\Http\Requests\Admin\UpdateMarcaRequest;
use Illuminate\Http\Request; // Usaremos Request simples por enquanto
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MarcaController extends Controller
{
    /**
     * Exibe uma lista paginada das marcas.
     */
    public function index(): View
    {
        $marcas = Marca::withCount('modelos')->orderBy('nome')->paginate(15);
        return view('admin.marcas.index', compact('marcas'));
    }

    /**
     * Mostra o formulário para criar uma nova marca.
     */
    public function create(): View
    {
        return view('admin.marcas.create');
    }

    /**
     * Salva uma nova marca no banco de dados.
     * Usa StoreMarcaRequest para validação.
     */
    public function store(StoreMarcaRequest $request): RedirectResponse
    {
        // A validação é feita automaticamente pelo StoreMarcaRequest
        // Obtém os dados validados
        $validated = $request->validated();

        try {
            Marca::create($validated);
            return redirect()->route('admin.marcas.index')->with('success', 'Marca criada com sucesso!');
        } catch (\Exception $e) {
            // Log do erro pode ser útil aqui
            // Log::error("Erro ao criar marca: " . $e->getMessage());
            return back()->with('error', 'Erro ao criar marca. Por favor, tente novamente.')->withInput(); // Mensagem mais genérica para o usuário
        }
    }

    /**
     * Exibe os detalhes de uma marca (útil para ver modelos e mídias associadas).
     */
    public function show(Marca $marca): View
    {
        $marca->load('modelos', 'imagens', 'videos'); // Carrega relacionamentos
        return view('admin.marcas.show', compact('marca'));
    }

    /**
     * Mostra o formulário para editar uma marca existente.
     */
    public function edit(Marca $marca): View
    {
        return view('admin.marcas.edit', compact('marca'));
    }

    /**
     * Atualiza uma marca existente no banco de dados.
     * Usa UpdateMarcaRequest para validação.
     */
    public function update(UpdateMarcaRequest $request, Marca $marca): RedirectResponse
    {
        // A validação é feita automaticamente pelo UpdateMarcaRequest
        // Obtém os dados validados
        $validated = $request->validated();

        try {
            $marca->update($validated);
            return redirect()->route('admin.marcas.index')->with('success', 'Marca atualizada com sucesso!');
        } catch (\Exception $e) {
            // Log do erro pode ser útil aqui
            // Log::error("Erro ao atualizar marca {$marca->id}: " . $e->getMessage());
            return back()->with('error', 'Erro ao atualizar marca. Por favor, tente novamente.')->withInput(); // Mensagem mais genérica
        }
    }

    /**
     * Remove uma marca do banco de dados.
     * ATENÇÃO: Modelos associados serão excluídos (cascadeOnDelete na migration).
     * Mídias associadas (imagens/vídeos) NÃO serão excluídas automaticamente.
     */
    public function destroy(Marca $marca): RedirectResponse
    {
        try {
            // TODO: Lógica opcional para excluir mídias associadas à marca
            $marca->delete();
            return redirect()->route('admin.marcas.index')->with('success', 'Marca e seus modelos associados foram excluídos com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.marcas.index')->with('error', 'Erro ao excluir marca: ' . $e->getMessage());
        }
    }
}

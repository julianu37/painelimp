<?php

namespace App\Http\Controllers\Admin;

use App\Models\Modelo;
use App\Models\Marca;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreModeloRequest;
use App\Http\Requests\Admin\UpdateModeloRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ModeloController extends Controller
{
    /**
     * Exibe uma lista paginada dos modelos, com suas marcas.
     */
    public function index(Request $request): View
    {
        $query = Modelo::with('marca');

        if ($marcaId = $request->query('marca_id')) {
            $query->where('marca_id', $marcaId);
        }

        $modelos = $query->orderBy('marca_id')->orderBy('nome')->paginate(15);
        $marcas = Marca::orderBy('nome')->pluck('nome', 'id');

        return view('admin.modelos.index', compact('modelos', 'marcas'));
    }

    /**
     * Mostra o formulário para criar um novo modelo.
     * Recebe opcionalmente o ID da marca via query string.
     */
    public function create(Request $request): View
    {
        $marcas = Marca::orderBy('nome')->pluck('nome', 'id');
        // Pega o ID da marca da query string, se existir
        $selectedMarcaId = $request->query('marca_id');
        return view('admin.modelos.create', compact('marcas', 'selectedMarcaId'));
    }

    /**
     * Salva um novo modelo no banco de dados.
     */
    public function store(StoreModeloRequest $request): RedirectResponse
    {
        try {
            Modelo::create($request->validated());
            return redirect()->route('admin.modelos.index', ['marca_id' => $request->input('marca_id')])
                           ->with('success', 'Modelo criado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar modelo: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Exibe os detalhes de um modelo (mostrando manuais, códigos, mídias).
     */
    public function show(Modelo $modelo): View
    {
        $modelo->load('marca', 'manuais', 'codigosErro', 'imagens', 'videos');
        return view('admin.modelos.show', compact('modelo'));
    }

    /**
     * Mostra o formulário para editar um modelo existente.
     */
    public function edit(Modelo $modelo): View
    {
        $marcas = Marca::orderBy('nome')->pluck('nome', 'id');
        return view('admin.modelos.edit', compact('modelo', 'marcas'));
    }

    /**
     * Atualiza um modelo existente no banco de dados.
     */
    public function update(UpdateModeloRequest $request, Modelo $modelo): RedirectResponse
    {
        try {
            $modelo->update($request->validated());
            return redirect()->route('admin.modelos.index', ['marca_id' => $request->input('marca_id')])
                           ->with('success', 'Modelo atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar modelo: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove um modelo do banco de dados.
     * Manuais terão modelo_id setado para null (definido na migration).
     * Associações com CodigoErro serão removidas (cascadeOnDelete na pivot).
     * Mídias associadas NÃO serão excluídas.
     */
    public function destroy(Modelo $modelo): RedirectResponse
    {
        try {
            $modelo->delete();
            return redirect()->route('admin.modelos.index')->with('success', 'Modelo excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.modelos.index')->with('error', 'Erro ao excluir modelo: ' . $e->getMessage());
        }
    }
}

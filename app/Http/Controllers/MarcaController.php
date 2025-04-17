<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarcaController extends Controller
{
    /**
     * Exibe a lista de marcas com contagem de modelos, busca e paginação.
     */
    public function index(Request $request): View
    {
        $query = Marca::withCount('modelos'); // Conta quantos modelos cada marca tem

        // Obtém o termo de busca, se houver
        $busca = $request->input('busca_marca');

        // Se houver termo de busca, aplica o filtro no nome
        if ($busca) {
            $query->where('nome', 'LIKE', "%{$busca}%");
        }

        // Executa a query com ordenação e paginação
        $marcas = $query->orderBy('nome')
                       ->paginate(20)
                       ->appends($request->query()); // Anexa busca à paginação

        return view('public.marcas.index', compact('marcas'));
    }

    /**
     * Exibe os detalhes públicos de uma marca específica e seus modelos.
     * Assume que o Model Binding usa o ID ou o slug (se getRouteKeyName estiver definido no Model).
     */
    public function show(Marca $marca): View
    {
        // Carrega os modelos associados, ordenados por nome
        $marca->load(['modelos' => function ($query) {
            $query->orderBy('nome');
        }]);

        return view('public.marcas.show', compact('marca'));
    }
}

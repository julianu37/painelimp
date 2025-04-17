<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModeloController extends Controller
{
    /**
     * Exibe a lista de modelos com busca e paginação.
     */
    public function index(Request $request): View
    {
        $query = Modelo::with('marca:id,nome'); // Carrega a marca associada (apenas id e nome)

        // Obtém o termo de busca, se houver
        $busca = $request->input('busca_modelo');

        // Se houver termo de busca, aplica o filtro no nome do modelo
        if ($busca) {
            $query->where('nome', 'LIKE', "%{$busca}%");
        }

        // Executa a query com ordenação e paginação
        $modelos = $query->orderBy(function ($q) {
                            // Ordena pelo nome da marca relacionada
                            $q->select('nome')
                              ->from('marcas')
                              ->whereColumn('marcas.id', 'modelos.marca_id')
                              ->limit(1);
                        })
                        ->orderBy('nome') // Depois ordena pelo nome do modelo
                        ->paginate(20)
                        ->appends($request->query()); // Anexa busca à paginação

        return view('public.modelos.index', compact('modelos'));
    }

    /**
     * Exibe os detalhes públicos de um modelo específico.
     * Assume que o Model Binding usa o ID ou o slug (se getRouteKeyName estiver definido no Model).
     */
    public function show(Modelo $modelo): View
    {
        // Carrega a marca, códigos de erro públicos e manuais associados
        $modelo->load([
            'marca',
            'codigosErro' => function ($query) {
                $query->where('publico', true)->orderBy('codigo'); // Apenas públicos
            },
            'manuais' // Carrega manuais
        ]);

        return view('public.modelos.show', compact('modelo'));
    }
}

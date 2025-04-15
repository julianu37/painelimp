<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarcaController extends Controller
{
    /**
     * Exibe uma lista pública de todas as marcas.
     */
    public function index(): View
    {
        $marcas = Marca::withCount('modelos') // Conta quantos modelos cada marca tem
                       ->orderBy('nome')
                       ->paginate(20); // Paginação

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

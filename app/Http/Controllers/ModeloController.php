<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModeloController extends Controller
{
    /**
     * Exibe uma lista pública de todos os modelos, com suas marcas.
     */
    public function index(): View
    {
        $modelos = Modelo::with('marca:id,nome') // Carrega a marca associada (apenas id e nome)
                         ->orderBy('marca_id') // Ordena primeiro por marca
                         ->orderBy('nome')      // Depois por nome do modelo
                         ->paginate(20);

        // Poderia agrupar por marca na view se desejado
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

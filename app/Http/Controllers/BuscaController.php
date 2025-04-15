<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\CodigoErro;
use App\Models\Manual;
use Illuminate\Support\Str;

class BuscaController extends Controller
{
    /**
     * Processa a busca e exibe os resultados.
     */
    public function index(Request $request): View
    {
        // Valida e sanitiza o termo de busca
        $query = trim($request->input('q'));

        // Inicializa coleções vazias
        $codigosErro = collect();
        $manuais = collect();

        // Só executa a busca se o termo não estiver vazio
        if (!empty($query)) {
            // Prepara o termo para a busca LIKE
            $searchTerm = '%' . $query . '%';

            // Busca em Códigos de Erro (apenas públicos)
            $codigosErro = CodigoErro::where('publico', true)
                ->where(function ($q) use ($searchTerm) {
                    $q->where('codigo', 'LIKE', $searchTerm)
                      ->orWhere('descricao', 'LIKE', $searchTerm);
                })
                ->orderBy('codigo') // Ordena por código
                ->get();

            // Busca em Manuais (todos, a view decide se mostra link de download)
            $manuais = Manual::where('nome', 'LIKE', $searchTerm)
                        // Poderia buscar na descrição também se relevante:
                        // ->orWhere('descricao', 'LIKE', $searchTerm)
                        ->orderBy('nome') // Ordena por nome
                        ->get();
        }

        // Passa os resultados e o termo de busca para a view
        return view('public.busca.index', compact('codigosErro', 'manuais', 'query'));
    }
}

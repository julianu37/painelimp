<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
// use App\Models\CodigoErro; // Removido
use App\Models\Manual;
// use App\Models\Marca; // Removido
use App\Models\Modelo;
use App\Models\ManualPaginaReferencia;
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
        // $codigosErro = collect(); // Removido
        $manuais = collect();
        // $marcas = collect(); // Removido
        $modelos = collect();
        $referenciasPdf = collect();

        // Só executa a busca se o termo não estiver vazio
        if (!empty($query)) {
            // Prepara o termo para a busca LIKE
            $searchTerm = '%' . $query . '%';
            $codigoBusca = strtoupper($query); // Para busca exata de código SC

            // REMOVIDO: Busca em Códigos de Erro
            // $codigosErro = CodigoErro::where('publico', true)
            //     ->where(function ($q) use ($searchTerm) {
            //         $q->where('codigo', 'LIKE', $searchTerm)
            //           ->orWhere('descricao', 'LIKE', $searchTerm);
            //     })
            //     ->with('modelos:id,slug,nome')
            //     ->orderBy('codigo') // Ordena por código
            //     ->get();

            // Busca em Manuais (todos, a view decide se mostra link de download)
            $manuais = Manual::where('nome', 'LIKE', $searchTerm)
                        // Poderia buscar na descrição também se relevante:
                        // ->orWhere('descricao', 'LIKE', $searchTerm)
                        ->orderBy('nome') // Ordena por nome
                        ->get();

            // REMOVIDO: Busca em Marcas
            // $marcas = Marca::where('nome', 'LIKE', $searchTerm)
            //             ->orderBy('nome')
            //             ->get();

            // Busca em Modelos (pelo nome)
            $modelos = Modelo::with('marca:id,nome') // Carrega a marca para exibir na view
                        ->where('nome', 'LIKE', $searchTerm)
                        ->orderBy('nome')
                        ->get();

            // --- Nova Busca: Códigos Indexados nos PDFs ---
            // Removemos a condição preg_match, buscamos sempre que houver query.
            // Alteramos para usar LIKE para busca parcial.
            $referenciasPdf = ManualPaginaReferencia::where('codigo_encontrado', 'LIKE', '%' . $query . '%')
                                    ->with('manual:id,slug,nome') // Carrega dados do manual
                                    ->orderBy('manual_id') // Agrupa por manual
                                    ->orderBy('numero_pagina') // Ordena por página
                                    ->get();

            // Comentário removido: A busca acima agora é feita independentemente do formato do código.
            // if (preg_match('/^SC\d{3}(-\d{2})?$/i', $codigoBusca)) {
            //     $referenciasPdf = ManualPaginaReferencia::where('codigo_encontrado', $codigoBusca)
            //                             ->with('manual:id,slug,nome') // Carrega dados do manual
            //                             ->orderBy('manual_id') // Agrupa por manual
            //                             ->orderBy('numero_pagina') // Ordena por página
            //                             ->get();
            // }
        }

        // Passa os resultados e o termo de busca para a view
        // Remove $codigosErro e $marcas do compact()
        return view('public.busca.index', compact('manuais', 'modelos', 'referenciasPdf', 'query'));
    }
}

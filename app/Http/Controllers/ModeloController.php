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
     * Exibe os detalhes públicos de um modelo específico (página principal do modelo).
     */
    public function show(Modelo $modelo): View
    {
        // Carrega a marca e as contagens de códigos de erro públicos e manuais
        $modelo->load('marca'); // Carrega a marca completa
        $modelo->loadCount([
            'codigoErros' => fn($q) => $q->where('publico', true), // Conta apenas públicos
            'manuais' // Conta manuais (assumindo que são todos públicos ou lógica de acesso está na rota/view)
        ]);

        return view('public.modelos.show', compact('modelo'));
    }

    /**
     * Exibe a lista de códigos de erro públicos para um modelo específico.
     */
    public function showCodigos(Modelo $modelo, Request $request): View
    {
        // Carrega a marca para exibir no título da página
        $modelo->load('marca:id,nome,slug');

        // Obtém o termo de busca, se houver
        $buscaCodigo = $request->input('busca_codigo');

        // Query base para os códigos de erro públicos do modelo
        $query = $modelo->codigoErros()->where('publico', true);

        // Se houver termo de busca, aplica o filtro no código ou descrição
        if ($buscaCodigo) {
            $query->where(function ($q) use ($buscaCodigo) {
                $q->where('codigo', 'LIKE', "%{$buscaCodigo}%")
                  ->orWhere('descricao', 'LIKE', "%{$buscaCodigo}%");
            });
        }

        // Executa a query com ordenação e paginação
        $codigosErro = $query->orderBy('codigo')
                             ->paginate(15, ['*'], 'codigos_page')
                             ->appends($request->query()); // Anexa query string atual (incluindo busca_codigo) à paginação

        // Passa o termo de busca para a view também, para preencher o campo
        return view('public.modelos.show_codigos', compact('modelo', 'codigosErro', 'buscaCodigo'));
    }

    /**
     * Exibe a lista de manuais para um modelo específico.
     */
    public function showManuais(Modelo $modelo): View
    {
         // Carrega a marca para exibir no título da página
         $modelo->load('marca:id,nome,slug');

        // Busca os manuais associados a este modelo, paginados
        $manuais = $modelo->manuais()
                           ->orderBy('nome')
                           ->paginate(15, ['*'], 'manuais_page'); // Nomeia a página

        return view('public.modelos.show_manuais', compact('modelo', 'manuais'));
    }
}

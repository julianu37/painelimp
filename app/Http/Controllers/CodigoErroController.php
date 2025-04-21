<?php

namespace App\Http\Controllers;

use App\Models\CodigoErro;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth; // Para verificar se usuário é admin
use Illuminate\Support\Str;

class CodigoErroController extends Controller
{
    /**
     * Exibe a lista de códigos de erro públicos, com busca.
     */
    public function index(Request $request): View
    {
        // Cria a query base para códigos públicos
        $query = CodigoErro::where('publico', true);

        // Obtém o termo de busca, se houver
        $busca = $request->input('busca_codigo');

        // Se houver termo de busca, aplica o filtro
        if ($busca) {
            $query->where(function ($q) use ($busca) {
                $q->where('codigo', 'LIKE', "%{$busca}%")
                  ->orWhere('descricao', 'LIKE', "%{$busca}%");
            });
        }

        // Executa a query com ordenação e paginação
        // Adiciona with() para carregar os modelos necessários para o link
        $codigos = $query->with('modelos:id,slug,nome') // Carrega modelos
                        ->orderBy('codigo')->paginate(15)->appends($request->query());

        // Retorna a view da listagem pública
        return view('public.codigos.index', compact('codigos'));
    }

    /**
     * Exibe os detalhes de um código de erro específico, dentro do contexto de um modelo.
     * O route model binding com scopeBindings garante que o código pertence ao modelo.
     */
    public function show(Modelo $modelo, CodigoErro $codigoErro): View
    {
        // A verificação de publico/admin não é mais necessária aqui, 
        // pois o acesso é feito via /modelos/{modelo}/codigos que já filtra públicos
        // e o scopeBindings garante a relação modelo <-> codigo.

        // Carrega os relacionamentos necessários para exibição
        // O relacionamento 'modelos' pode ser desnecessário agora que temos $modelo,
        // mas manter não prejudica e pode ser útil se um código pertence a múltiplos modelos (o que não parece ser o caso aqui).
        $codigoErro->load([
            'modelos', // Mantém por segurança, mas $modelo já está disponível
            'imagens', // Carrega imagens do código
            'videos', // Carrega vídeos do código
            'comentarios' => function ($query) { // Carrega comentários
                $query->with(['user', 'midias']) // Com usuário e mídias
                      ->withCount('likers') // Adiciona contagem de likes
                      ->orderByDesc('likers_count') // Ordena por likes
                      ->orderByDesc('created_at'); // Depois por data
            }
        ]);

        // Retorna a view de detalhes pública, passando o modelo também
        return view('public.codigos.show', compact('modelo', 'codigoErro'));
    }

    // Os métodos create, store, edit, update, destroy serão tratados
    // pelo Admin\CodigoErroController.
    // Mantemos os stubs aqui apenas para referência, mas não serão usados pelas rotas públicas.

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Não usado publicamente
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Não usado publicamente
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CodigoErro $codigoErro)
    {
        // Não usado publicamente
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CodigoErro $codigoErro)
    {
        // Não usado publicamente
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CodigoErro $codigoErro)
    {
        // Não usado publicamente
    }
}

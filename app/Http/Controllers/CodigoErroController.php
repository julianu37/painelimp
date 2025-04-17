<?php

namespace App\Http\Controllers;

use App\Models\CodigoErro;
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
        // Anexa os parâmetros da query atual aos links de paginação
        $codigos = $query->orderBy('codigo')->paginate(15)->appends($request->query());

        // Retorna a view da listagem pública
        return view('public.codigos.index', compact('codigos'));
    }

    /**
     * Exibe os detalhes de um código de erro específico.
     * O model binding usa o slug automaticamente (definido no Model).
     */
    public function show(CodigoErro $codigoErro): View|RedirectResponse
    {
        // Verifica se o código é público ou se o usuário logado é admin
        if (!$codigoErro->publico && (!Auth::check() || !Auth::user()->isAdmin())) {
            // Se não for público e o usuário não for admin, redireciona ou mostra erro
            // Poderia abortar com 404 ou 403, ou redirecionar para a lista
            return redirect()->route('codigos.index')->with('error', 'Código de erro não encontrado ou não é público.');
        }

        // Carrega os relacionamentos necessários para exibição
        $codigoErro->load([
            'solucoes' => fn($q) => $q->with(['imagens', 'videos']), // Carrega mídias das soluções
            'modelos', // Carrega modelos associados ao código
            'imagens', // Carrega imagens do código
            'videos', // Carrega vídeos do código
            'comentarios' => function ($query) { // Carrega comentários
                $query->with(['user', 'midias']) // Com usuário e mídias
                      ->withCount('likers') // Adiciona contagem de likes
                      ->orderByDesc('likers_count') // Ordena por likes
                      ->orderByDesc('created_at'); // Depois por data
            }
        ]);

        // Retorna a view de detalhes pública (precisará ser criada)
        return view('public.codigos.show', compact('codigoErro'));
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

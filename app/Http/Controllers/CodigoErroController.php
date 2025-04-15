<?php

namespace App\Http\Controllers;

use App\Models\CodigoErro;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth; // Para verificar se usuário é admin

class CodigoErroController extends Controller
{
    /**
     * Exibe uma lista dos códigos de erro públicos.
     */
    public function index(): View
    {
        // Busca apenas os códigos marcados como publico, ordenados pelo código
        $codigos = CodigoErro::where('publico', true)
                             ->orderBy('codigo')
                             ->paginate(15); // Adiciona paginação

        // Retorna a view da listagem pública (precisará ser criada)
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
            'solucoes' => function ($query) {
                // Carrega imagens e vídeos de cada solução
                $query->with(['imagens', 'videos']);
            },
            'comentarios' => function ($query) {
                // Carrega o usuário de cada comentário e ordena pelos mais recentes
                $query->with(['user', 'midias'])->orderBy('created_at', 'desc');
            },
            'imagens', // Imagens diretamente associadas ao código de erro
            'videos' // Vídeos diretamente associados ao código de erro
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

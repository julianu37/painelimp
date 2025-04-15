<?php

namespace App\Http\Controllers;

use App\Models\Manual;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage; // Para interagir com o Storage
use Symfony\Component\HttpFoundation\StreamedResponse; // Para download
use Symfony\Component\HttpFoundation\RedirectResponse; // Para redirecionamento

class ManualController extends Controller
{
    /**
     * Exibe uma lista dos manuais públicos.
     */
    public function index(): View
    {
        // Busca apenas os manuais públicos, ordenados pelo nome
        $manuais = Manual::where('publico', true)
                         ->orderBy('nome')
                         ->paginate(15);

        // Retorna a view da listagem pública (precisará ser criada)
        return view('public.manuais.index', compact('manuais'));
    }

    /**
     * Permite o download do arquivo de um manual para usuários autenticados.
     */
    public function download(Manual $manual): StreamedResponse|RedirectResponse
    {
        // Verifica se o arquivo existe no storage
        if (!Storage::disk('public')->exists($manual->arquivo_path)) {
            // Se não existir, redireciona de volta com erro
            // Idealmente, voltar para a página anterior ou para a lista de manuais
            return back()->with('error', 'Arquivo do manual não encontrado.');
        }

        // Retorna o download do arquivo
        // Usa o nome original do arquivo se disponível, senão um nome genérico
        $nomeArquivoDownload = $manual->arquivo_nome_original ?? basename($manual->arquivo_path);

        return Storage::disk('public')->download($manual->arquivo_path, $nomeArquivoDownload);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Não usado publicamente ou por técnicos
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Não usado publicamente ou por técnicos
    }

    /**
     * Display the specified resource.
     */
    public function show(Manual $manual)
    {
        // A visualização pública é feita pela listagem (index).
        // Detalhes poderiam ser implementados aqui se necessário.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manual $manual)
    {
        // Não usado publicamente ou por técnicos
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manual $manual)
    {
        // Não usado publicamente ou por técnicos
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manual $manual)
    {
        // Não usado publicamente ou por técnicos
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Manual;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage; // Para interagir com o Storage
use Symfony\Component\HttpFoundation\StreamedResponse; // Para download
use Symfony\Component\HttpFoundation\BinaryFileResponse; // Para view
use Symfony\Component\HttpFoundation\RedirectResponse; // Para redirecionamento
use Illuminate\Support\Facades\Auth; // Para checar auth no download

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
     * Exibe uma view com o visualizador PDF.js embutido.
     * Acessível publicamente.
     */
    public function viewPdf(Manual $manual): View|RedirectResponse
    {
        // Verifica se o arquivo existe no storage público
        if (!Storage::disk('public')->exists($manual->arquivo_path)) {
            return back()->with('error', 'Arquivo do manual não encontrado.');
        }

        // Obtém a URL pública do arquivo PDF
        $pdfUrl = Storage::disk('public')->url($manual->arquivo_path);

        // Retorna a view do visualizador, passando a URL e o nome do manual
        return view('public.manuais.viewer', [
            'manual' => $manual,      // Para exibir o nome, etc.
            'pdfUrl' => $pdfUrl, // URL para o PDF.js carregar
        ]);
    }

    /**
     * Força o download do arquivo do manual.
     * Protegido pelo middleware 'auth' na rota.
     */
    public function download(Manual $manual): StreamedResponse|RedirectResponse
    {
        // Verifica se o arquivo existe no storage público
        if (!Storage::disk('public')->exists($manual->arquivo_path)) {
            // Log::error("Arquivo PDF do manual não encontrado para download: ID {$manual->id}, Path: {$manual->arquivo_path}");
            return back()->with('error', 'Arquivo do manual não encontrado.'); // Ou abort(404)
        }

        // Usa o método download do Storage para forçar o download
        // Passa o nome original do arquivo para o navegador
        return Storage::disk('public')->download($manual->arquivo_path, $manual->arquivo_nome_original);
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

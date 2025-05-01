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
     * Exibe a lista de manuais públicos com busca e paginação.
     */
    public function index(Request $request): View
    {
        $query = Manual::where('publico', true);

        // Obtém o termo de busca, se houver
        $busca = $request->input('busca_manual');

        // Se houver termo de busca, aplica o filtro
        if ($busca) {
            $query->where(function ($q) use ($busca) {
                $q->where('nome', 'LIKE', "%{$busca}%")
                  ->orWhere('arquivo_nome_original', 'LIKE', "%{$busca}%")
                  // Busca em modelos relacionados (JOIN necessário para performance ideal,
                  // mas orWhereHas funciona e é mais simples para começar)
                  ->orWhereHas('modelos', function($qModelo) use ($busca) {
                      $qModelo->where('nome', 'LIKE', "%{$busca}%");
                  });
            });
        }

        // Carrega os modelos (incluindo slug) e suas marcas (incluindo slug) para exibição na lista
        $query->with('modelos:id,nome,marca_id,slug', 'modelos.marca:id,nome,slug');

        // Executa a query com ordenação e paginação
        $manuais = $query->orderBy('nome')
                         ->paginate(15)
                         ->appends($request->query()); // Anexa busca à paginação

        return view('public.manuais.index', compact('manuais'));
    }

    /**
     * Exibe uma view com o visualizador PDF.js embutido.
     * Acessível publicamente.
     */
    public function viewPdf(Request $request, Manual $manual): View|RedirectResponse
    {
        // Verifica se o arquivo existe no storage público
        if (!Storage::disk('public')->exists($manual->arquivo_path)) {
            return back()->with('error', 'Arquivo do manual não encontrado.');
        }

        // Obtém a URL pública do arquivo PDF
        $pdfUrl = Storage::disk('public')->url($manual->arquivo_path);

        // Obtém o número da página da query string, padrão 1
        $initialPage = max(1, intval($request->input('page', 1)));

        // Retorna a view do visualizador, passando a URL e o nome do manual
        return view('public.manuais.viewer', [
            'manual' => $manual,      // Para exibir o nome, etc.
            'pdfUrl' => $pdfUrl, // URL para o PDF.js carregar
            'initialPage' => $initialPage // <-- Passa a página inicial para a view
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
     * Redireciona para o index.html público do manual HTML.
     * Acessível publicamente.
     */
    public function viewHtml(Manual $manual): RedirectResponse
    {
        // Garante que só manuais do tipo HTML e com caminho definido acessem esta rota
        if ($manual->tipo !== 'html' || empty($manual->caminho_html)) {
            abort(404);
        }

        // Gera a URL pública para o arquivo index.html usando asset()
        $publicHtmlUrl = asset($manual->caminho_html);

        // Redireciona o navegador do usuário para a URL do manual HTML
        return redirect()->away($publicHtmlUrl);
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

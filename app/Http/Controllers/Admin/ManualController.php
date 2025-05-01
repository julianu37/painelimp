<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manual;
use App\Models\Modelo;
// use App\Models\Marca; // Não mais necessário para agrupamento aqui
use App\Http\Requests\Admin\StoreManualRequest;
use App\Http\Requests\Admin\UpdateManualRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage; // Para lidar com arquivos
use Illuminate\Support\Facades\DB; // Para transações
use App\Jobs\IndexarManualPdf; // Importa o Job
use Illuminate\Support\Facades\Log; // Adicionado para log de erro

class ManualController extends Controller
{
    /**
     * Define o diretório base para os uploads de manuais no storage público.
     */
    private string $uploadPath = 'manuais';

    /**
     * Exibe uma lista dos manuais para administração.
     */
    public function index(): View
    {
        // Carrega os modelos associados (eager load)
        $manuais = Manual::with('modelos') // Mudou de modelo para modelos
                    ->orderBy('nome')->paginate(15);
        return view('admin.manuais.index', compact('manuais'));
    }

    /**
     * Mostra o formulário para criar um novo manual.
     */
    public function create(Request $request): View
    {
        // Passa todos os modelos ordenados por nome
        $modelos = Modelo::orderBy('nome')->get();
        $selectedModelosIds = $request->old('modelos', []); // Para repopular em caso de erro
        if ($request->has('modelo_id')) { // Mantem compatibilidade com link de "Add Manual" do modelo
            $selectedModelosIds[] = $request->query('modelo_id');
        }
        return view('admin.manuais.create', compact('modelos', 'selectedModelosIds'));
    }

    /**
     * Salva um novo manual (PDF ou HTML) no banco de dados.
     */
    public function store(StoreManualRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $pathPdf = null;
        $caminhoHtml = null;
        $nomeOriginal = null;
        $tipo = $validated['tipo'];

        DB::beginTransaction();
        try {
            $dataToSave = [
                'nome' => $validated['nome'],
                'descricao' => $validated['descricao'] ?? null,
                'tipo' => $tipo,
                'publico' => $request->boolean('publico'),
                // Slug será gerado automaticamente
                'arquivo_path' => null, // Inicia nulo
                'caminho_html' => null, // Inicia nulo
                'arquivo_nome_original' => null, // Inicia nulo
                'indexing_status' => 'pending', // Define como pendente
            ];

            if ($tipo === 'pdf' && $request->hasFile('arquivo')) {
                $pathPdf = $request->file('arquivo')->store($this->uploadPath, 'public');
                $nomeOriginal = $request->file('arquivo')->getClientOriginalName();
                $dataToSave['arquivo_path'] = $pathPdf;
                $dataToSave['arquivo_nome_original'] = $nomeOriginal;
            } elseif ($tipo === 'html' && !empty($validated['caminho_html'])) {
                $caminhoHtml = $validated['caminho_html'];
                $dataToSave['caminho_html'] = $caminhoHtml;
                $dataToSave['indexing_status'] = 'n/a'; // Indexação não se aplica a HTML
            } else {
                // Se tipo for PDF, arquivo é obrigatório (já validado no Request)
                // Se tipo for HTML, caminho é obrigatório (já validado no Request)
                // Esta condição não deve ser atingida devido à validação, mas é uma segurança
                 throw new \Exception("Dados inválidos para o tipo de manual selecionado.");
            }

            $manual = Manual::create($dataToSave);

            // Sincroniza os modelos selecionados
            if (!empty($validated['modelos'])) {
                $manual->modelos()->sync($validated['modelos']);
            }

            DB::commit();

            // Dispara o job apenas se for PDF
            if ($tipo === 'pdf') {
                IndexarManualPdf::dispatch($manual);
                return redirect()->route('admin.manuais.index')->with('success', 'Manual PDF criado com sucesso! Indexação iniciada.');
            } else {
                return redirect()->route('admin.manuais.index')->with('success', 'Manual HTML criado com sucesso!');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            if ($pathPdf && Storage::disk('public')->exists($pathPdf)) {
                 Storage::disk('public')->delete($pathPdf);
            }
            Log::error("Erro ao criar manual: Arquivo: {$e->getFile()}, Linha: {$e->getLine()}, Mensagem: " . $e->getMessage());
            return back()->with('error', 'Erro ao criar manual. Verifique os dados e tente novamente.')
                     ->withInput();
        }
    }

    /**
     * Exibe os detalhes de um manual específico.
     */
    public function show(Manual $manual): View
    {
         // Carrega modelos, imagens e vídeos associados
         $manual->load('modelos', 'imagens', 'videos'); // Mudou de modelo para modelos
        return view('admin.manuais.show', compact('manual'));
    }

    /**
     * Mostra o formulário para editar um manual existente.
     */
    public function edit(Manual $manual): View
    {
        // Passa todos os modelos ordenados por nome
        $modelos = Modelo::orderBy('nome')->get();
        // Carrega os IDs dos modelos já associados para pre-selecionar
        $selectedModelosIds = $manual->modelos()->pluck('modelo_id')->toArray();
        return view('admin.manuais.edit', compact('manual', 'modelos', 'selectedModelosIds'));
    }

    /**
     * Atualiza um manual existente (PDF ou HTML).
     */
    public function update(UpdateManualRequest $request, Manual $manual): RedirectResponse
    {
        $validated = $request->validated();
        $oldFilePath = $manual->arquivo_path;
        $newPathPdf = null;
        $newCaminhoHtml = null;
        $arquivoAlterado = false;
        $tipo = $validated['tipo'];

        DB::beginTransaction();
        try {
            $dataToUpdate = [
                'nome' => $validated['nome'],
                'descricao' => $validated['descricao'] ?? null,
                'tipo' => $tipo,
                'publico' => $request->boolean('publico'),
                // Slug será atualizado automaticamente
            ];

            // Lógica condicional para PDF vs HTML
            if ($tipo === 'pdf') {
                $dataToUpdate['caminho_html'] = null; // Limpa o campo HTML
                $dataToUpdate['indexing_status'] = $manual->indexing_status ?? 'pending'; // Mantém ou define como pendente

                if ($request->hasFile('arquivo')) {
                    $newPathPdf = $request->file('arquivo')->store($this->uploadPath, 'public');
                    $dataToUpdate['arquivo_path'] = $newPathPdf;
                    $dataToUpdate['arquivo_nome_original'] = $request->file('arquivo')->getClientOriginalName();
                    $arquivoAlterado = true;
                     $dataToUpdate['indexing_status'] = 'pending'; // Marca para reindexar
                } else {
                    // Mantém o arquivo PDF existente se nenhum novo foi enviado
                    $dataToUpdate['arquivo_path'] = $manual->arquivo_path;
                    $dataToUpdate['arquivo_nome_original'] = $manual->arquivo_nome_original;
                }
            } elseif ($tipo === 'html') {
                $dataToUpdate['arquivo_path'] = null; // Limpa o campo PDF
                $dataToUpdate['arquivo_nome_original'] = null;
                $dataToUpdate['indexing_status'] = 'n/a'; // Indexação não aplicável

                // Validação garante que caminho_html não está vazio se tipo for HTML
                $newCaminhoHtml = $validated['caminho_html'];
                $dataToUpdate['caminho_html'] = $newCaminhoHtml;

                // Verifica se o caminho HTML mudou (para evitar apagar PDF desnecessariamente)
                if($manual->tipo === 'pdf' || $manual->caminho_html !== $newCaminhoHtml){
                    $arquivoAlterado = true; // Considera alterado se mudou de PDF para HTML ou se o caminho HTML mudou
                }
            }

            $manual->update($dataToUpdate);

            // Sincroniza os modelos selecionados
            $manual->modelos()->sync($validated['modelos'] ?? []);

            // Se mudou de tipo (HTML para PDF, ou vice-versa), ou se um novo PDF foi salvo,
            // remove o arquivo antigo (se era PDF)
            if ($arquivoAlterado && $oldFilePath && Storage::disk('public')->exists($oldFilePath)) {
                 // Remove o PDF antigo apenas se o novo tipo é HTML ou se um novo PDF foi enviado
                 if($tipo === 'html' || $newPathPdf){
                     Storage::disk('public')->delete($oldFilePath);
                 }
            }

            DB::commit();

            // Dispara o job apenas se for PDF e o arquivo foi alterado
            if ($tipo === 'pdf' && $arquivoAlterado) {
                IndexarManualPdf::dispatch($manual);
                 return redirect()->route('admin.manuais.index')->with('success', 'Manual PDF atualizado! Reindexação iniciada.');
            } else {
                 return redirect()->route('admin.manuais.index')->with('success', 'Manual atualizado com sucesso!');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            // Se um novo arquivo PDF foi salvo, mas houve erro depois, remove-o
            if ($newPathPdf && Storage::disk('public')->exists($newPathPdf)) {
                 Storage::disk('public')->delete($newPathPdf);
            }
            Log::error("Erro ao atualizar manual ID {$manual->id}: Arquivo: {$e->getFile()}, Linha: {$e->getLine()}, Mensagem: " . $e->getMessage());
            return back()->with('error', 'Erro ao atualizar manual. Verifique os dados e tente novamente.')
                     ->withInput();
        }
    }

    /**
     * Remove um manual do banco de dados e seu arquivo/pasta associado.
     */
    public function destroy(Manual $manual): RedirectResponse
    {
        try {
            $filePath = $manual->arquivo_path;
            // A pasta HTML não é removida automaticamente, apenas o registro no DB

            $manual->delete();

            // Remove o arquivo PDF se existir
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return redirect()->route('admin.manuais.index')->with('success', 'Manual excluído com sucesso!');
        } catch (\Exception $e) {
            Log::error("Erro ao excluir manual ID {$manual->id}: Arquivo: {$e->getFile()}, Linha: {$e->getLine()}, Mensagem: " . $e->getMessage());
            return redirect()->route('admin.manuais.index')->with('error', 'Erro ao excluir manual.');
        }
    }

    /**
     * Permite o download do arquivo do manual.
     */
    public function download(Manual $manual)
    {
        if (!Storage::disk('public')->exists($manual->arquivo_path)) {
            abort(404, 'Arquivo não encontrado.');
        }

        return Storage::disk('public')->download($manual->arquivo_path, $manual->arquivo_nome_original ?? basename($manual->arquivo_path));
    }
}

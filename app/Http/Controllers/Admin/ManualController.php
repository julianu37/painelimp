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
     * Salva um novo manual no banco de dados, incluindo o upload do arquivo
     * e sincroniza os modelos associados.
     */
    public function store(StoreManualRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $path = null;

        DB::beginTransaction();
        try {
            if ($request->hasFile('arquivo')) {
                $path = $request->file('arquivo')->store($this->uploadPath, 'public');
            }

            $dataToSave = [
                'nome' => $validated['nome'],
                'descricao' => $validated['descricao'] ?? null,
                'arquivo_path' => $path,
                'arquivo_nome_original' => $request->file('arquivo') ? $request->file('arquivo')->getClientOriginalName() : null,
                'publico' => $request->boolean('publico'),
                // Slug será gerado automaticamente pelo Sluggable
            ];

            $manual = Manual::create($dataToSave);

            // Sincroniza os modelos selecionados
            if (!empty($validated['modelos'])) {
                $manual->modelos()->sync($validated['modelos']);
            }

            DB::commit();
            return redirect()->route('admin.manuais.index')->with('success', 'Manual criado com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();
            if ($path && Storage::disk('public')->exists($path)) {
                 Storage::disk('public')->delete($path);
            }
            // Log::error("Erro ao criar manual: ". $e->getMessage()); // Boa prática: logar o erro
            return back()->with('error', 'Erro ao criar manual. Verifique os dados e tente novamente.')
                     ->withInput(); // Mantém os dados do formulário
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
     * Atualiza um manual existente, incluindo o arquivo (se enviado)
     * e sincroniza os modelos associados.
     */
    public function update(UpdateManualRequest $request, Manual $manual): RedirectResponse
    {
        $validated = $request->validated();
        $oldFilePath = $manual->arquivo_path;
        $newPath = null;

        DB::beginTransaction();
        try {
            $dataToUpdate = [
                 'nome' => $validated['nome'],
                'descricao' => $validated['descricao'] ?? null,
                'publico' => $request->boolean('publico'),
                // Slug será atualizado automaticamente se o nome mudar
            ];

            if ($request->hasFile('arquivo')) {
                $newPath = $request->file('arquivo')->store($this->uploadPath, 'public');
                $dataToUpdate['arquivo_path'] = $newPath;
                $dataToUpdate['arquivo_nome_original'] = $request->file('arquivo')->getClientOriginalName();
            }

            $manual->update($dataToUpdate);

            // Sincroniza os modelos selecionados
            // Usa sync() que adiciona/remove conforme necessário
            $manual->modelos()->sync($validated['modelos'] ?? []);

            // Se um novo arquivo foi salvo com sucesso, remove o antigo
            if ($newPath && $oldFilePath && Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }

            DB::commit();
            return redirect()->route('admin.manuais.index')->with('success', 'Manual atualizado com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();
            // Se um novo arquivo foi salvo, mas houve erro depois, remove o novo arquivo
            if ($newPath && Storage::disk('public')->exists($newPath)) {
                 Storage::disk('public')->delete($newPath);
            }
            // Log::error("Erro ao atualizar manual: ". $e->getMessage()); // Boa prática: logar o erro
            return back()->with('error', 'Erro ao atualizar manual. Verifique os dados e tente novamente.')
                     ->withInput();
        }
    }

    /**
     * Remove um manual do banco de dados e seu arquivo associado do storage.
     * A tabela pivô é tratada pelo onDelete('cascade').
     */
    public function destroy(Manual $manual): RedirectResponse
    {
        try {
            $filePath = $manual->arquivo_path;
            $manual->delete(); // O relacionamento na tabela pivô é removido em cascata

            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return redirect()->route('admin.manuais.index')->with('success', 'Manual excluído com sucesso!');
        } catch (\Exception $e) {
            // Log::error("Erro ao excluir manual: ". $e->getMessage()); // Boa prática: logar o erro
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

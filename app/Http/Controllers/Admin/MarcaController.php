<?php

namespace App\Http\Controllers\Admin;

use App\Models\Marca;
use App\Http\Controllers\Controller;
// Importa os FormRequests específicos para validação
use App\Http\Requests\Admin\StoreMarcaRequest;
use App\Http\Requests\Admin\UpdateMarcaRequest;
use Illuminate\Http\Request; // Usaremos Request simples por enquanto
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MarcaController extends Controller
{
    private string $logoStoragePath = 'logos/marcas';

    /**
     * Exibe uma lista paginada das marcas.
     */
    public function index(): View
    {
        $marcas = Marca::withCount('modelos')->orderBy('nome')->paginate(15);
        return view('admin.marcas.index', compact('marcas'));
    }

    /**
     * Mostra o formulário para criar uma nova marca.
     */
    public function create(): View
    {
        return view('admin.marcas.create');
    }

    /**
     * Salva uma nova marca, incluindo o logo se enviado.
     */
    public function store(StoreMarcaRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $logoPath = null;

        try {
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store($this->logoStoragePath, 'public');
            }

            Marca::create([
                'nome' => $validated['nome'],
                'logo_path' => $logoPath,
                // Slug será gerado automaticamente
            ]);

            return redirect()->route('admin.marcas.index')->with('success', 'Marca criada com sucesso!');
        } catch (\Exception $e) {
            // Remove o logo se o DB falhar
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                 Storage::disk('public')->delete($logoPath);
            }
            Log::error("Erro ao criar marca: " . $e->getMessage());
            return back()->with('error', 'Erro ao criar marca. Por favor, tente novamente.')->withInput();
        }
    }

    /**
     * Exibe os detalhes de uma marca (útil para ver modelos e mídias associadas).
     */
    public function show(Marca $marca): View
    {
        $marca->load('modelos', 'imagens', 'videos'); // Carrega relacionamentos
        return view('admin.marcas.show', compact('marca'));
    }

    /**
     * Mostra o formulário para editar uma marca existente.
     */
    public function edit(Marca $marca): View
    {
        return view('admin.marcas.edit', compact('marca'));
    }

    /**
     * Atualiza uma marca existente, incluindo o logo se enviado.
     */
    public function update(UpdateMarcaRequest $request, Marca $marca): RedirectResponse
    {
        $validated = $request->validated();
        $oldLogoPath = $marca->logo_path;
        $newLogoPath = null;

        try {
            $dataToUpdate = [
                'nome' => $validated['nome'],
                // Slug será atualizado automaticamente se o nome mudar
            ];

            if ($request->hasFile('logo')) {
                $newLogoPath = $request->file('logo')->store($this->logoStoragePath, 'public');
                $dataToUpdate['logo_path'] = $newLogoPath;
            } else {
                 // Se nenhum novo logo foi enviado, mantém o antigo
                 // Não precisa incluir logo_path em $dataToUpdate
            }

            $marca->update($dataToUpdate);

            // Se um novo logo foi salvo com sucesso E existia um antigo, remove o antigo
            if ($newLogoPath && $oldLogoPath && Storage::disk('public')->exists($oldLogoPath)) {
                Storage::disk('public')->delete($oldLogoPath);
            }

            return redirect()->route('admin.marcas.index')->with('success', 'Marca atualizada com sucesso!');
        } catch (\Exception $e) {
            // Remove o novo logo se o DB falhar
            if ($newLogoPath && Storage::disk('public')->exists($newLogoPath)) {
                 Storage::disk('public')->delete($newLogoPath);
            }
            Log::error("Erro ao atualizar marca {$marca->id}: " . $e->getMessage());
            return back()->with('error', 'Erro ao atualizar marca. Por favor, tente novamente.')->withInput();
        }
    }

    /**
     * Remove uma marca e seu logo associado.
     */
    public function destroy(Marca $marca): RedirectResponse
    {
        try {
            $logoPath = $marca->logo_path;
            $marca->delete(); // Modelos associados são excluídos por cascade

            // Remove o arquivo do logo se existir
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }

            return redirect()->route('admin.marcas.index')->with('success', 'Marca e seus modelos associados foram excluídos com sucesso!');
        } catch (\Exception $e) {
             Log::error("Erro ao excluir marca {$marca->id}: " . $e->getMessage());
            return redirect()->route('admin.marcas.index')->with('error', 'Erro ao excluir marca.');
        }
    }
}

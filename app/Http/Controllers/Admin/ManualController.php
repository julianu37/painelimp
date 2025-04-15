<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manual;
use App\Models\Modelo;
use App\Models\Marca;
use App\Http\Requests\Admin\StoreManualRequest;
use App\Http\Requests\Admin\UpdateManualRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage; // Para lidar com arquivos

class ManualController extends Controller
{
    /**
     * Define o diretório base para os uploads de manuais no storage público.
     */
    private string $uploadPath = 'manuais';

    /**
     * Prepara os modelos agrupados por marca para o select.
     */
    private function getModelosAgrupados(): array
    {
        return Modelo::with('marca:id,nome')
            ->orderBy('marca_id')->orderBy('nome')
            ->get()
            ->groupBy('marca.nome')
            ->map(function ($modelos) {
                return $modelos->pluck('nome', 'id');
            })
            ->all();
    }

    /**
     * Exibe uma lista dos manuais para administração.
     */
    public function index(): View
    {
        $manuais = Manual::with('modelo.marca')
                    ->orderBy('nome')->paginate(15);
        return view('admin.manuais.index', compact('manuais'));
    }

    /**
     * Mostra o formulário para criar um novo manual.
     */
    public function create(Request $request): View
    {
        $modelosAgrupados = $this->getModelosAgrupados();
        $selectedModeloId = $request->query('modelo_id');
        return view('admin.manuais.create', compact('modelosAgrupados', 'selectedModeloId'));
    }

    /**
     * Salva um novo manual no banco de dados, incluindo o upload do arquivo.
     */
    public function store(StoreManualRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $path = $request->file('arquivo')->store($this->uploadPath, 'public');
            $dataToSave = $validated;
            $dataToSave['arquivo_path'] = $path;
            $dataToSave['arquivo_nome_original'] = $request->file('arquivo')->getClientOriginalName();
            $dataToSave['publico'] = $request->has('publico');
            unset($dataToSave['arquivo']);

            Manual::create($dataToSave);

            return redirect()->route('admin.manuais.index')->with('success', 'Manual criado com sucesso!');
        } catch (\Exception $e) {
            if (isset($path) && Storage::disk('public')->exists($path)) {
                 Storage::disk('public')->delete($path);
            }
            return back()->with('error', 'Erro ao criar manual: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Exibe os detalhes de um manual específico.
     */
    public function show(Manual $manual): View
    {
         $manual->load('modelo.marca', 'imagens', 'videos');
        return view('admin.manuais.show', compact('manual'));
    }

    /**
     * Mostra o formulário para editar um manual existente.
     */
    public function edit(Manual $manual): View
    {
        $modelosAgrupados = $this->getModelosAgrupados();
        return view('admin.manuais.edit', compact('manual', 'modelosAgrupados'));
    }

    /**
     * Atualiza um manual existente, substituindo o arquivo se um novo for enviado.
     */
    public function update(UpdateManualRequest $request, Manual $manual): RedirectResponse
    {
        $validated = $request->validated();
        $oldFilePath = $manual->arquivo_path;

        try {
            $dataToUpdate = $validated;
            $dataToUpdate['publico'] = $request->has('publico');

            if ($request->hasFile('arquivo')) {
                $path = $request->file('arquivo')->store($this->uploadPath, 'public');
                $dataToUpdate['arquivo_path'] = $path;
                $dataToUpdate['arquivo_nome_original'] = $request->file('arquivo')->getClientOriginalName();

                if ($oldFilePath && Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }
            }
            unset($dataToUpdate['arquivo']);

            $manual->update($dataToUpdate);

            return redirect()->route('admin.manuais.index')->with('success', 'Manual atualizado com sucesso!');
        } catch (\Exception $e) {
            if (isset($path) && $path !== $oldFilePath && Storage::disk('public')->exists($path)) {
                 Storage::disk('public')->delete($path);
            }
            return back()->with('error', 'Erro ao atualizar manual: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove um manual do banco de dados e seu arquivo associado do storage.
     */
    public function destroy(Manual $manual): RedirectResponse
    {
        try {
            $filePath = $manual->arquivo_path;
            $manual->delete();

            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return redirect()->route('admin.manuais.index')->with('success', 'Manual excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.manuais.index')->with('error', 'Erro ao excluir manual: ' . $e->getMessage());
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

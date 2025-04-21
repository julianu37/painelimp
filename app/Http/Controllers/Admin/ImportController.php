<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\CodigoImportService;
use Illuminate\Support\Facades\Log;
use Throwable;

class ImportController extends Controller
{
    /**
     * Mostra o formulário para selecionar modelos e iniciar a importação.
     */
    public function create(): View
    {
        // Busca modelos com suas marcas para exibição no formulário
        $modelos = Modelo::with('marca:id,nome')->orderBy('nome')->get();
        return view('admin.import.codigos_form', compact('modelos'));
    }

    /**
     * Processa a importação dos códigos de erro para os modelos selecionados.
     */
    public function store(Request $request, CodigoImportService $importService): RedirectResponse
    {
        // Validar a requisição
        $validated = $request->validate([
            'modelo_ids' => 'required|array|min:1', // Pelo menos um ID deve ser enviado
            'modelo_ids.*' => 'required|integer|exists:modelos,id', // Cada ID deve existir na tabela modelos
        ],[
            'modelo_ids.required' => 'Selecione pelo menos um modelo.',
            'modelo_ids.array' => 'Formato inválido para seleção de modelos.',
            'modelo_ids.min' => 'Selecione pelo menos um modelo.',
            'modelo_ids.*.exists' => 'Um dos modelos selecionados não é válido.',
        ]);

        $modeloIds = $validated['modelo_ids'];

        try {
            // Chama o serviço para realizar a importação
            $resultado = $importService->importarParaModelos($modeloIds);

            // Monta mensagem de sucesso
            $mensagem = "Importação concluída. {$resultado['importados']} novos códigos importados.";
            if ($resultado['associados_existentes'] > 0) {
                 $mensagem .= " {$resultado['associados_existentes']} códigos existentes foram associados.";
            }
             if ($resultado['ignorados'] > 0) {
                 $mensagem .= " {$resultado['ignorados']} códigos foram ignorados (já associados, vazios ou erro). Consulte os logs para detalhes sobre erros.";
            }

            return redirect()->route('admin.import.codigos.form')->with('success', $mensagem);

        } catch (Throwable $e) {
            Log::error("Erro GERAL na importação de códigos", [
                'modelo_ids' => $modeloIds,
                'exception' => $e
            ]);
            // Retorna para o formulário, mantendo os inputs e mostrando erro
            return back()->withInput()->with('error', 'Ocorreu um erro inesperado durante a importação: ' . $e->getMessage() . '. Verifique os logs.');
        }
    }
}

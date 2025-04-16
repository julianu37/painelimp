<?php

namespace App\Http\Controllers\Admin;

use App\Models\CodigoErro;
use App\Models\Modelo;
use App\Models\Marca;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCodigoErroRequest;
use App\Http\Requests\Admin\UpdateCodigoErroRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class CodigoErroController extends Controller
{
    /**
     * Prepara os modelos agrupados por marca para o select.
     * Reutilizado do ManualController, poderia ir para um Trait ou BaseController.
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
     * Exibe uma lista dos códigos de erro para administração.
     */
    public function index(): View
    {
        $codigosErro = CodigoErro::withCount('solucoes', 'modelos')
                        ->orderBy('codigo')->paginate(15);
        return view('admin.codigos.index', compact('codigosErro'));
    }

    /**
     * Mostra o formulário para criar um novo código de erro.
     */
    public function create(): View
    {
        $modelosAgrupados = $this->getModelosAgrupados();
        $selectedModelosIds = [];
        return view('admin.codigos.create', compact('modelosAgrupados', 'selectedModelosIds'));
    }

    /**
     * Salva um novo código de erro e sincroniza os modelos associados.
     */
    public function store(StoreCodigoErroRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $modelosIds = $validated['modelos'] ?? [];
        unset($validated['modelos']);

        try {
            $codigoErro = CodigoErro::create($validated);
            $codigoErro->modelos()->sync($modelosIds);

            return redirect()->route('admin.codigos.index')->with('success', 'Código de erro criado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar código de erro: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Exibe os detalhes de um código de erro, incluindo soluções, imagens, vídeos e comentários.
     */
    public function show(CodigoErro $codigo): View
    {
        // Carrega os relacionamentos necessários:
        // - solucoes: Soluções associadas
        // - imagens: Imagens associadas diretamente ao código
        // - videos: Vídeos associados diretamente ao código
        // - comentarios: Comentários associados
        // - comentarios.user: O usuário que fez cada comentário
        // - comentarios.midias: As mídias (arquivos/youtube) de cada comentário
        $codigo->load([
            'solucoes',
            'imagens',
            'videos',
            'comentarios' => function ($query) {
                $query->with(['user', 'midias'])->orderBy('created_at', 'desc'); // Carrega user e midias, ordena por mais recentes
            }
        ]);
        return view('admin.codigos_erro.show', compact('codigo'));
    }

    /**
     * Mostra o formulário para editar um código de erro existente.
     */
    public function edit(CodigoErro $codigoErro): View
    {
        $modelosAgrupados = $this->getModelosAgrupados();
        $codigoErro->load('modelos:id');

        return view('admin.codigos.edit', compact('codigoErro', 'modelosAgrupados'));
    }

    /**
     * Atualiza um código de erro existente e sincroniza os modelos.
     */
    public function update(UpdateCodigoErroRequest $request, CodigoErro $codigoErro): RedirectResponse
    {
        $validated = $request->validated();
        $modelosIds = $validated['modelos'] ?? [];
        unset($validated['modelos']);

        try {
            $codigoErro->update($validated);
            $codigoErro->modelos()->sync($modelosIds);

            return redirect()->route('admin.codigos.index')->with('success', 'Código de erro atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar código de erro: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove um código de erro do banco de dados.
     * Usa o ID diretamente da rota e Query Builder para bypassar problemas de binding.
     * @param \Illuminate\Http\Request $request
     * @param int|string $codigo O parâmetro da rota (contém o ID agora)
     * @return RedirectResponse
     */
    public function destroy(Request $request, $codigo): RedirectResponse
    {
        // O parâmetro $codigo agora contém o ID, pois getRouteKeyName foi comentado
        $codigoErroId = $codigo;

        Log::info("[Direct ID Param] Tentando excluir Código de Erro com ID da rota: {$codigoErroId}");

        // Validação básica do ID recebido
        if (!$codigoErroId || !is_numeric($codigoErroId)) {
             Log::error("[Direct ID Param] ID da rota inválido ou não numérico: " . print_r($codigoErroId, true));
             return redirect()->route('admin.codigos.index')->with('error', 'Erro: ID inválido fornecido para exclusão.');
        }

        try {
            // Tenta deletar diretamente via Query Builder usando o ID da rota
            $numLinhasAfetadas = DB::table('codigos_erro')->where('id', $codigoErroId)->delete();

            Log::debug("[Direct ID Param] Resultado de DB::table(...)->delete(): {$numLinhasAfetadas} linha(s) afetada(s).");

            if ($numLinhasAfetadas > 0) {
                Log::info("[Direct ID Param] Exclusão bem-sucedida via Query Builder para ID: {$codigoErroId}");
                return redirect()->route('admin.codigos.index')->with('success', 'Código de erro excluído com sucesso!');
            } else {
                 // Se 0 linhas foram afetadas, o ID não existia no momento do DELETE
                 Log::error("[Direct ID Param] Exclusão via Query Builder não afetou linhas para ID: {$codigoErroId}. O registro pode não existir mais.");
                return redirect()->route('admin.codigos.index')->with('error', 'Falha ao excluir o código de erro (nenhuma linha afetada no DB, verificado por ID da rota).');
            }

        } catch (QueryException $e) {
             Log::error("[Direct ID Param] Erro de Query ao excluir Código de Erro ID: {$codigoErroId}. SQLSTATE: {$e->getCode()}. Mensagem: " . $e->getMessage(), ['exception' => $e]);
             if (str_contains($e->getMessage(), 'constraint violation')) {
                 return redirect()->route('admin.codigos.index')->with('error', 'Erro: Não é possível excluir este código de erro pois ele está sendo referenciado em outro lugar (ex: Soluções). Verifique as associações.');
             }
            return redirect()->route('admin.codigos.index')->with('error', 'Erro de banco de dados ao excluir código de erro: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error("[Direct ID Param] Erro geral ao excluir Código de Erro ID: {$codigoErroId}. Mensagem: " . $e->getMessage(), ['exception' => $e]);
            return redirect()->route('admin.codigos.index')->with('error', 'Erro inesperado ao excluir código de erro: ' . $e->getMessage());
        }
    }
}

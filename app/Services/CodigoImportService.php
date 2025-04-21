<?php

namespace App\Services;

use App\Models\CodigoErro;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class CodigoImportService
{
    // ** Nome da tabela de origem configurado **
    protected string $nomeTabelaOrigem = 'codigos_erro'; // Tabela de origem conforme especificado
    protected string $nomeConexaoOrigem = 'mysql_import';

    /**
     * Retorna o nome da tabela de origem configurado.
     * Útil para exibir na view.
     */
    public function getNomeTabelaOrigem(): string
    {
        return $this->nomeTabelaOrigem;
    }

    /**
     * Importa códigos de erro da base de origem e associa aos IDs de modelo fornecidos.
     *
     * @param array $modeloIds Array de IDs de Modelos de destino.
     * @return array Resultado com contagens ['importados', 'associados_existentes', 'ignorados', 'tabela_origem'].
     * @throws \Exception Se a conexão com o DB de origem falhar.
     */
    public function importarParaModelos(array $modeloIds): array
    {
        $contadorImportados = 0;
        $contadorAssociadosExistentes = 0;
        $contadorIgnorados = 0;

        // 1. Buscar dados da origem
        try {
            $codigosOrigem = DB::connection($this->nomeConexaoOrigem)
                              ->table($this->nomeTabelaOrigem)
                              ->select('codigo', 'descricao') // Colunas conforme especificado
                              ->whereNotNull('codigo')
                              ->where('codigo', '!=', '')
                              ->distinct()
                              ->get();
        } catch (Throwable $e) {
            Log::error("Falha na importação de códigos - conexão DB origem ({$this->nomeConexaoOrigem})", ['exception' => $e]);
            throw new \Exception("Não foi possível conectar ou buscar dados da base de origem '{$this->nomeConexaoOrigem}'. Verifique a configuração e os logs.");
        }

        if ($codigosOrigem->isEmpty()) {
             Log::info("Nenhum código válido encontrado na origem para importação.");
             return [
                'importados' => 0,
                'associados_existentes' => 0,
                'ignorados' => 0,
                'tabela_origem' => $this->nomeTabelaOrigem
            ];
        }

        // 2. Processar cada código
        foreach ($codigosOrigem as $codigoOrigem) {
            DB::beginTransaction();
            try {
                // 2.1. Busca ou Cria o Código de Erro localmente
                $codigoAtual = CodigoErro::firstOrCreate(
                    ['codigo' => $codigoOrigem->codigo],
                    [
                        'descricao' => $codigoOrigem->descricao ?? 'Descrição não fornecida',
                        'publico' => true, // Padrão
                    ]
                );

                $foiCriado = $codigoAtual->wasRecentlyCreated;
                if ($foiCriado) {
                    $contadorImportados++;
                }

                // 2.2. Associa aos modelos selecionados (se ainda não associado)
                $modelosParaAssociar = [];
                $modelosJaAssociadosIgnorados = 0;
                foreach ($modeloIds as $modeloId) {
                    if (!$codigoAtual->modelos()->where('modelo_id', $modeloId)->exists()) {
                        $modelosParaAssociar[] = $modeloId;
                    } else {
                         // Se já existe a associação E o código não foi recém criado, conta como ignorado
                         if(!$foiCriado) {
                            $modelosJaAssociadosIgnorados++;
                         }
                    }
                }

                // Associa aos modelos que ainda não estavam associados
                if (!empty($modelosParaAssociar)) {
                    $codigoAtual->modelos()->attach($modelosParaAssociar);
                    // Se o código já existia, contamos as *novas* associações feitas
                    if(!$foiCriado){
                         $contadorAssociadosExistentes += count($modelosParaAssociar);
                    }
                }
                // Se o código não foi criado agora E todas as associações já existiam, ignora 1 vez
                if (!$foiCriado && empty($modelosParaAssociar) && $modelosJaAssociadosIgnorados > 0) {
                    $contadorIgnorados++;
                }

                DB::commit();

            } catch (Throwable $e) {
                DB::rollBack();
                $contadorIgnorados++;
                Log::error("Falha ao processar código de importação '{$codigoOrigem->codigo}'", [
                    'modelo_ids' => $modeloIds,
                    'exception' => $e
                ]);
            }
        } // Fim do loop foreach

        return [
            'importados' => $contadorImportados,
            'associados_existentes' => $contadorAssociadosExistentes,
            'ignorados' => $contadorIgnorados,
            'tabela_origem' => $this->nomeTabelaOrigem
        ];
    }
} 
<?php

namespace App\Jobs;

use App\Models\Manual;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToText\Pdf;

class IndexarManualPdf implements ShouldQueue
{
    use InteractsWithQueue, Dispatchable;

    /**
     * O modelo Manual a ser indexado.
     *
     * @var \App\Models\Manual
     */
    protected $manual;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\Manual $manual
     * @return void
     */
    public function __construct(Manual $manual)
    {
        $this->manual = $manual;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        // Atualiza status para processando
        $this->manual->updateQuietly(['indexing_status' => 'processing']); // updateQuietly para não disparar eventos
        Log::info("Iniciando indexação do manual ID: {$this->manual->id} - {$this->manual->arquivo_path}");

        // 1. Verifica se o arquivo PDF existe no storage PÚBLICO
        if (!$this->manual->arquivo_path || !Storage::disk('public')->exists($this->manual->arquivo_path)) {
            Log::error("Arquivo PDF não encontrado no disco 'public' para o manual ID: {$this->manual->id} no path: {$this->manual->arquivo_path}");
            // Podemos falhar o job aqui ou apenas logar e sair
            $this->fail("Arquivo PDF não encontrado no disco 'public' para o manual ID: {$this->manual->id}");
            return;
        }

        $pdfPath = Storage::disk('public')->path($this->manual->arquivo_path);

        try {
            // 2. Define o caminho para o pdftotext (prioriza config, depois tenta PATH)
            $binPathToUse = null; // Default: usa o PATH do sistema
            $popplerPathFromConfig = config('pdf-to-text.pdftotext_path'); // Espera o caminho COMPLETO para o executável

            if ($popplerPathFromConfig && file_exists($popplerPathFromConfig) && is_executable($popplerPathFromConfig)) {
                $binPathToUse = $popplerPathFromConfig; // Usa o caminho do config se válido
                Log::debug("Usando pdftotext do config: {$binPathToUse}");
            } else {
                 Log::warning("pdftotext não encontrado/inválido no config (`pdf-to-text.pdftotext_path`). Tentando usar o PATH do sistema. Garanta que o diretório bin do poppler esteja no PATH do sistema Windows.");
                 // $binPathToUse permanece null, biblioteca tentará o PATH
            }

            // 5. Limpa referências antigas deste manual (opcional, mas recomendado)
            DB::table('manual_pagina_referencias')->where('manual_id', $this->manual->id)->delete();
            Log::info("Referências antigas limpas para o manual ID: {$this->manual->id}");

            // 6. Itera pelas páginas
            // Workaround: Tentar extrair texto da página 1 para verificar se pdftotext funciona
             try {
                 // Passa o $binPathToUse (caminho do executável ou null) como segundo argumento
                 Pdf::getText($pdfPath, $binPathToUse, ['f 1', 'l 1']); // Testa a página 1
             } catch (\Exception $pageCheckError) {
                 Log::error("Erro ao tentar acessar PDF ou executar pdftotext para manual ID {$this->manual->id}: " . $pageCheckError->getMessage());
                 $this->fail("Erro pdftotext: " . $pageCheckError->getMessage());
                 return;
             }

            $referenciasParaInserir = [];
            $numeroPagina = 1;
            $totalReferenciasEncontradas = 0;

            while (true) {
                try {
                    $textoPagina = Pdf::getText($pdfPath, $binPathToUse, ["f {$numeroPagina}", "l {$numeroPagina}"]);

                    if (!empty(trim($textoPagina))) {
                        // Encontra TODOS os códigos SCXXX ou SCXXX-XX na página
                        // Regex: \b(SC\d{3}(-\d{2})?)\b
                        //   \b : word boundary
                        //   SC : literal "SC"
                        //   \d{3} : exatamente 3 dígitos
                        //   (-\d{2})? : opcionalmente, um hífen seguido por 2 dígitos
                        //   Parênteses externos capturam o código completo encontrado (ex: "SC101", "SC670-01")
                        if (preg_match_all('/\b(SC\d{3}(-\d{2})?)\b/i', $textoPagina, $matches)) {
                            // $matches[1] contém todos os códigos encontrados na página
                            $codigosNestaPagina = array_unique(array_map('strtoupper', $matches[1])); // Pega apenas códigos únicos e em maiúsculas

                            foreach ($codigosNestaPagina as $codigoEncontrado) {
                                $referenciasParaInserir[] = [
                                    'manual_id' => $this->manual->id,
                                    'codigo_encontrado' => $codigoEncontrado,
                                    'numero_pagina' => $numeroPagina
                                ];
                                // Log::debug("Encontrado código {$codigoEncontrado} na página {$numeroPagina} do manual {$this->manual->id}");
                            }
                        }
                    }

                    $numeroPagina++;
                    if ($numeroPagina > 5000) { // Limite de segurança
                         Log::warning("Limite de 5000 páginas atingido para manual ID {$this->manual->id}. Interrompendo.");
                         break;
                    }

                } catch (\Spatie\PdfToText\Exceptions\CouldNotExtractText $e) {
                    // Assumir que página não existe mais
                    Log::info("Fim do manual ID {$this->manual->id} detectado na página {$numeroPagina} (exceção: {$e->getMessage()}).");
                    break;
                } catch (\Exception $e) {
                    Log::error("Erro ao processar página {$numeroPagina} do manual ID {$this->manual->id}: " . $e->getMessage());
                    // Decide se continua ou falha o job
                    // $this->fail($e); // Descomente para falhar o job em caso de erro na página
                    break; // Para de processar este manual
                }
            }

            // 7. Insere as referências encontradas no banco de dados
            if (!empty($referenciasParaInserir)) {
                DB::table('manual_pagina_referencias')->insert($referenciasParaInserir); // Não precisa de insertOrIgnore aqui
                $totalReferenciasEncontradas = count($referenciasParaInserir);
                Log::info($totalReferenciasEncontradas . " referências encontradas e inseridas para o manual ID: {$this->manual->id}");
            } else {
                 Log::info("Nenhuma referência de código SC encontrada no manual ID: {$this->manual->id}");
            }

            // Atualiza status para concluído SE NENHUM ERRO OCORREU
            $this->manual->updateQuietly(['indexing_status' => 'completed']);
            Log::info("Indexação concluída com sucesso para o manual ID: {$this->manual->id}");

        } catch (\Exception $e) {
            // Atualiza status para falha
            $this->manual->updateQuietly(['indexing_status' => 'failed']);
            Log::error("Erro geral ao indexar manual ID {$this->manual->id}: Arquivo: {$e->getFile()}, Linha: {$e->getLine()}, Mensagem: " . $e->getMessage());
            $this->fail($e); // Falha o job (para a fila saber)
        }
    }

    /**
     * Lida com a falha do job.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(\Throwable $exception): void
    {
        // Garante que o status seja atualizado para falha mesmo se o erro
        // ocorrer antes do bloco try principal ou após a atualização para completed.
        $this->manual->updateQuietly(['indexing_status' => 'failed']);
        Log::critical("Falha CRÍTICA no job IndexarManualPdf para manual ID {$this->manual->id}: " . $exception->getMessage());
    }
}

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

class MaxTotalFileSize implements ValidationRule
{
    protected $maxSizeInKB;

    /**
     * Cria uma nova instância da regra.
     *
     * @param int $maxSizeInKB O tamanho máximo total permitido em kilobytes.
     */
    public function __construct(int $maxSizeInKB)
    {
        $this->maxSizeInKB = $maxSizeInKB;
    }

    /**
     * Executa a regra de validação.
     *
     * @param  string  $attribute
     * @param  mixed  $value O valor do atributo (deve ser um array de arquivos).
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Se o valor não for um array ou estiver vazio, passa
        if (!is_array($value) || empty($value)) {
            return;
        }

        $totalSize = collect($value)
            ->filter(fn ($file) => $file instanceof UploadedFile) // Considera apenas arquivos válidos
            ->sum(fn (UploadedFile $file) => $file->getSize()); // Soma o tamanho em bytes

        // Converte o tamanho total para KB e compara com o limite
        if (($totalSize / 1024) > $this->maxSizeInKB) {
            $maxSizeInMB = round($this->maxSizeInKB / 1024, 1); // Converte para MB para a mensagem
            $fail("O tamanho total dos arquivos não pode exceder :max MB.")->translate(['max' => $maxSizeInMB]);
        }
    }
}

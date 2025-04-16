<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

class MaxTotalFiles implements ValidationRule
{
    protected $maxFiles;

    /**
     * Cria uma nova instância da regra.
     *
     * @param int $maxFiles O número máximo de arquivos permitido.
     */
    public function __construct(int $maxFiles)
    {
        $this->maxFiles = $maxFiles;
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
        // Se o valor não for um array ou estiver vazio (nullable já foi tratado), passa
        if (!is_array($value) || empty($value)) {
            return;
        }

        // Filtra para garantir que estamos contando apenas instâncias de UploadedFile
        $fileCount = collect($value)->filter(fn ($file) => $file instanceof UploadedFile)->count();

        if ($fileCount > $this->maxFiles) {
            $fail("O número máximo de arquivos que podem ser enviados é :max.")->translate(['max' => $this->maxFiles]);
        }
    }
}

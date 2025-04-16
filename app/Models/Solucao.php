<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
// Importa os modelos relacionados
use App\Models\CodigoErro;
use App\Models\Imagem;
use App\Models\Video;

class Solucao extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'solucoes'; // Especifica o nome correto da tabela

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'descricao',
    ];

    /**
     * Define o relacionamento muitos-para-muitos com códigos de erro.
     */
    public function codigosErro(): BelongsToMany
    {
        // Laravel deduz o nome da tabela pivot 'codigo_erro_solucao' (ordem alfabética)
        return $this->belongsToMany(CodigoErro::class);
    }

    /**
     * Define o relacionamento polimórfico para imagens associadas a esta solução.
     */
    public function imagens(): MorphMany
    {
        return $this->morphMany(Imagem::class, 'imageable');
    }

    /**
     * Define o relacionamento polimórfico para vídeos associados a esta solução.
     */
    public function videos(): MorphMany
    {
        return $this->morphMany(Video::class, 'videoable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Modelo extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'marca_id',
        'nome',
    ];

    /**
     * Define o relacionamento onde um modelo pertence a uma marca.
     */
    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }

    /**
     * Define o relacionamento onde um modelo pode ter muitos manuais.
     */
    public function manuais(): HasMany
    {
        return $this->hasMany(Manual::class);
    }

    /**
     * Define o relacionamento N:N com codigos_erro.
     */
    public function codigosErro(): BelongsToMany
    {
        // O nome da tabela pivot é deduzido como 'codigo_erro_modelo' (ordem alfabética)
        return $this->belongsToMany(CodigoErro::class);
    }

    /**
     * Define o relacionamento polimórfico para imagens associadas a este modelo.
     */
    public function imagens(): MorphMany
    {
        return $this->morphMany(Imagem::class, 'imageable');
    }

    /**
     * Define o relacionamento polimórfico para vídeos associados a este modelo.
     */
    public function videos(): MorphMany
    {
        return $this->morphMany(Video::class, 'videoable');
    }
}

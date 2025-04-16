<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Cviebrock\EloquentSluggable\Sluggable;

class Modelo extends Model
{
    use HasFactory, Sluggable;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'marca_id',
        'nome',
        'slug',
    ];

    /**
     * Configuração para o Sluggable.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nome'
            ]
        ];
    }

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
    public function manuais(): BelongsToMany
    {
        return $this->belongsToMany(Manual::class, 'manual_modelo');
    }

    /**
     * Define o relacionamento N:N com codigos_erro.
     */
    public function codigosErro(): BelongsToMany
    {
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

    /**
     * Obtém o nome da chave de rota para o modelo.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

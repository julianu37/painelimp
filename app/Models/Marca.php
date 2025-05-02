<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Cviebrock\EloquentSluggable\Sluggable;

class Marca extends Model
{
    use HasFactory, Sluggable;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'slug',
        'logo_path',
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
     * Define o relacionamento onde uma marca tem muitos modelos.
     */
    public function modelos(): HasMany
    {
        return $this->hasMany(Modelo::class);
    }

    /**
     * Define o relacionamento polimórfico para imagens associadas a esta marca.
     */
    public function imagens(): MorphMany
    {
        return $this->morphMany(Imagem::class, 'imageable');
    }

    /**
     * Define o relacionamento polimórfico para vídeos associados a esta marca.
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

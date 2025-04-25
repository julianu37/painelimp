<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Cviebrock\EloquentSluggable\Sluggable;

class Manual extends Model
{
    use HasFactory, Sluggable;

    /**
     * O nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'manuais';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'descricao',
        'arquivo_path',
        'arquivo_nome_original',
        'publico',
        'slug',
        'indexing_status',
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publico' => 'boolean',
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
     * Os modelos aos quais este manual pertence (Muitos-para-Muitos).
     */
    public function modelos(): BelongsToMany
    {
        return $this->belongsToMany(Modelo::class, 'manual_modelo');
    }

    /**
     * Define o relacionamento polimórfico para imagens associadas a este manual.
     */
    public function imagens(): MorphMany
    {
        return $this->morphMany(Imagem::class, 'imageable');
    }

    /**
     * Define o relacionamento polimórfico para vídeos associados a este manual.
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

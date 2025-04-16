<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Cviebrock\EloquentSluggable\Sluggable;
// Importa os modelos relacionados
use App\Models\Solucao;
use App\Models\Comentario;
use App\Models\Imagem;
use App\Models\Video;
use Illuminate\Support\Str;

class CodigoErro extends Model
{
    use HasFactory, Sluggable;

    /**
     * O nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'codigos_erro'; // Especifica o nome correto da tabela

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo',
        'descricao',
        'publicado',
        'slug',
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'publicado' => 'boolean',
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
                'source' => 'codigo' // Gera o slug a partir do campo código
            ]
        ];
    }

    /**
     * Define o relacionamento N:N com modelos.
     */
    public function modelos(): BelongsToMany
    {
        // O nome da tabela pivot é deduzido como 'codigo_erro_modelo' (ordem alfabética)
        return $this->belongsToMany(Modelo::class);
    }

    /**
     * Define o relacionamento muitos-para-muitos com soluções.
     */
    public function solucoes(): BelongsToMany
    {
        return $this->belongsToMany(Solucao::class);
    }

    /**
     * Define o relacionamento polimórfico onde um Código de Erro pode ter muitos comentários.
     */
    public function comentarios(): MorphMany
    {
        // 'comentavel' é o nome usado no método morphs() na migration de comentarios
        return $this->morphMany(Comentario::class, 'comentavel');
    }

    /**
     * Define o relacionamento polimórfico para imagens associadas a este código.
     */
    public function imagens(): MorphMany
    {
        return $this->morphMany(Imagem::class, 'imageable');
    }

    /**
     * Define o relacionamento polimórfico para vídeos associados a este código.
     */
    public function videos(): MorphMany
    {
        return $this->morphMany(Video::class, 'videoable');
    }

    /**
     * Gera o slug automaticamente ao definir o atributo 'codigo'.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($codigoErro) {
            $codigoErro->slug = Str::slug($codigoErro->codigo);
        });

        static::updating(function ($codigoErro) {
            // Atualiza o slug apenas se o código foi alterado
            if ($codigoErro->isDirty('codigo')) {
                $codigoErro->slug = Str::slug($codigoErro->codigo);
            }
        });
    }

    // Descomentado para usar 'codigo' como chave de rota
    public function getRouteKeyName(): string
    {
        return 'codigo'; // Usa a coluna 'codigo' para binding
    }
}

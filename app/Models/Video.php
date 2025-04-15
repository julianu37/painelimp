<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Video extends Model
{
    use HasFactory;

    /**
     * Define o nome da tabela explicitamente.
     *
     * @var string
     */
    protected $table = 'videos';

    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'tipo', // 'link' ou 'upload'
        'url_ou_path',
        'videoable_id',
        'videoable_type',
    ];

    /**
     * Define o relacionamento polimórfico inverso.
     * Um vídeo pode pertencer a um CodigoErro ou a uma Solucao.
     */
    public function videoable(): MorphTo
    {
        return $this->morphTo();
    }
}

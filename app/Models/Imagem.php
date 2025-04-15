<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Imagem extends Model
{
    use HasFactory;

    /**
     * Define o nome da tabela explicitamente.
     *
     * @var string
     */
    protected $table = 'imagens';

    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'path',
        'descricao',
        'imageable_id',
        'imageable_type',
    ];

    /**
     * Define o relacionamento polimórfico inverso.
     * Uma imagem pode pertencer a um CodigoErro ou a uma Solucao.
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}

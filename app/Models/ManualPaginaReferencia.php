<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Pode ser útil no futuro

/**
 * Representa uma referência a um código encontrado em uma página de manual.
 */
class ManualPaginaReferencia extends Model
{
    // Descomente se usar factories
    // use HasFactory;

    /**
     * A tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'manual_pagina_referencias';

    /**
     * Indica se o modelo deve ter timestamps (created_at, updated_at).
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * A chave primária para o modelo.
     * Como é composta, definimos como um array.
     *
     * @var array
     */
    protected $primaryKey = ['manual_id', 'codigo_encontrado', 'numero_pagina'];

    /**
     * Indica se as IDs são auto-incremento.
     * Como a chave é composta, não é auto-incremento.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Os atributos que podem ser atribuídos em massa.
     * Protegido por padrão, mas bom definir explicitamente se necessário.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'manual_id',
        'codigo_encontrado',
        'numero_pagina',
    ];

    /**
     * Obtém o manual ao qual esta referência pertence.
     */
    public function manual(): BelongsTo
    {
        return $this->belongsTo(Manual::class, 'manual_id');
    }
}

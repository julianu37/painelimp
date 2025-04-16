<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth; // Importar a facade Auth
// Importa os modelos relacionados
use App\Models\User;
use App\Models\CodigoErro;

class Comentario extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'comentarios';

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'comentavel_id',
        'comentavel_type',
        'conteudo',
    ];

    /**
     * Define o relacionamento onde um comentário pertence a um usuário (técnico).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define o relacionamento onde um comentário pertence a um código de erro.
     */
    public function codigoErro(): BelongsTo
    {
        return $this->belongsTo(CodigoErro::class);
    }

    /**
     * Define o relacionamento polimórfico para imagens associadas a este comentário.
     */
    public function imagens(): MorphMany
    {
        return $this->morphMany(Imagem::class, 'imageable');
    }

    /**
     * Define o relacionamento polimórfico para vídeos associados a este comentário.
     */
    public function videos(): MorphMany
    {
        return $this->morphMany(Video::class, 'videoable');
    }

    /**
     * Obtém o modelo pai do comentário (ex: OrdemServico, Chamado).
     */
    public function comentavel(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Obtém todas as mídias associadas a este comentário.
     */
    public function midias(): HasMany
    {
        return $this->hasMany(MidiaComentario::class);
    }

    /**
     * Define o relacionamento com os usuários que curtiram o comentário.
     *
     * @return BelongsToMany
     */
    public function likers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'comentario_user_likes')
            ->withTimestamps();
    }

    /**
     * Verifica se o usuário autenticado atualmente curtiu este comentário.
     *
     * @return bool
     */
    public function isLikedByAuthUser(): bool
    {
        // Verifica se há um usuário autenticado
        if (!Auth::check()) {
            return false;
        }

        // Verifica se a relação 'likers' já foi carregada com o ID do usuário autenticado
        // Ou faz uma consulta para verificar se o like existe na tabela pivot
        return $this->relationLoaded('likers')
            ? $this->likers->contains(Auth::user())
            : $this->likers()->where('user_id', Auth::id())->exists();
    }
}

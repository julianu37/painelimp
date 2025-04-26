<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use App\Models\Comentario; // REMOVIDO
// use App\Policies\ComentarioPolicy; // REMOVIDO

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Mapeia o modelo Comentario para a sua Policy
        // Comentario::class => ComentarioPolicy::class, // REMOVIDO
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
} 
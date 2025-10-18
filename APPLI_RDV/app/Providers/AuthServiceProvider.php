<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // \App\Models\Model::class => \App\Policies\ModelPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        /*
         |----------------------------------------------------------------------
         | Super-admin (optionnel)
         |   -> autorise tout si l'email correspond
         |   -> supprime/commmente ce bloc si tu ne le veux pas
         |----------------------------------------------------------------------
         */
        Gate::before(function ($user, string $ability) {
            $superAdmins = [
                'admin@medilink.test',
                // ajoute d’autres emails si nécessaire
            ];
            return in_array($user->email ?? '', $superAdmins, true) ? true : null;
        });

        /*
         |----------------------------------------------------------------------
         | Gates par rôle (users.role)
         |----------------------------------------------------------------------
         */
        Gate::define('access-admin', function ($user) {
            return ($user->role ?? null) === 'admin';
        });

        Gate::define('access-medecin', function ($user) {
            return ($user->role ?? null) === 'medecin';
        });

        Gate::define('access-patient', function ($user) {
            return ($user->role ?? null) === 'patient';
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('Desenvolvedor', function($user){
            return strtoupper(Auth::user()->getPrivilegio->nivel) == strtoupper('Desenvolvedor');
        });

        $gate->define('Administrador', function($user){
            return strtoupper(Auth::user()->getPrivilegio->nivel) == strtoupper('Administrador');
        });

        $gate->define('Gerente', function($user){
            return strtoupper(Auth::user()->getPrivilegio->nivel) == strtoupper('Gerente');
        });

        $gate->define('Consulta', function($user){
            return strtoupper(Auth::user()->getPrivilegio->nivel) == strtoupper('Consulta');
        });

        $gate->define('Atendimento', function($user){
            return strtoupper(Auth::user()->getPrivilegio->nivel) == strtoupper('Atendimento');
        });


      
    }


}

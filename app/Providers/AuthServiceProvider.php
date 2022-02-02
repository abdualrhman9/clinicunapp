<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\AttachmentPolicy;
use App\Policies\DashbordPolicy;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\User' => 'App\Policies\AttachmentPolicy', 
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('show:dashboard',[DashbordPolicy::class,'show']);
        Gate::define('attached:doctor',[AttachmentPolicy::class,'canAttach']);
    }
}

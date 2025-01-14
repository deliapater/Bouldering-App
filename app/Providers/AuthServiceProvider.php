<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Technique;
use App\Models\Gear;
use App\Models\Location;
use App\Policies\TechniquePolicy;
use App\Policies\GearPolicy;
use App\Policies\LocationPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Technique::class => TechniquePolicy::class,
        Gear::class => GearPolicy::class,
        Locations::class => LocationPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}

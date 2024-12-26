<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Technique;
use App\Models\Gear;
use App\Models\Location;
use App\Policies\TechniquePolicy;
use App\Policies\GearPolicy;
use App\Policies\LocationPolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Technique::class => TechniquePolicy::class,
        Gear::class => GearPolicy::class,
        Locations::class => LocationPolicy::class
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

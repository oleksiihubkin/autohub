<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Review;
use App\Policies\ReviewPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Model → Policy mappings.
     * This tells Laravel which policy governs which model.
     */
    protected $policies = [
        Review::class => ReviewPolicy::class,
    ];

    /**
     * Register authorization services.
     * Called during the bootstrapping process.
     */
    public function boot(): void
    {
        // Registers all policies defined in $policies
        $this->registerPolicies();
    }
}

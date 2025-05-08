<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use App\Models\SubjectPerformance;
use App\Models\TeachingAssignment;
use Illuminate\Support\ServiceProvider;
use App\Observers\SubjectPerformanceObserver;
use App\Observers\TeachingAssignmentObserver;

class AppServiceProvider extends ServiceProvider
{
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
        SubjectPerformance::observe(SubjectPerformanceObserver::class);
        User::observe(UserObserver::class);
        TeachingAssignment::observe(TeachingAssignmentObserver::class);
    }
}

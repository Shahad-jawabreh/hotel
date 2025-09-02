<?php

namespace App\Providers;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    public function boot()
{
    Activity::saving(function (Activity $activity) {
        $activity->ip_address = request()->ip();
        $activity->user_agent = request()->header('User-Agent');
    });
}
}

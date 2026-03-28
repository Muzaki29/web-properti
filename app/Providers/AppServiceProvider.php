<?php

namespace App\Providers;

use App\Events\InquirySubmitted;
use App\Listeners\NotifyAdminOfInquiry;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Policies\PropertyImagePolicy;
use App\Policies\PropertyPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

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
        Gate::policy(Property::class, PropertyPolicy::class);
        Gate::policy(PropertyImage::class, PropertyImagePolicy::class);

        RateLimiter::for('inquiries', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        Event::listen(InquirySubmitted::class, [NotifyAdminOfInquiry::class, 'handle']);
    }
}

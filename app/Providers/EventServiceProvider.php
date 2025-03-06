<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Models\UserActivity;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\ProductAttribute;
use App\Models\Setting;
use App\Models\StockOpname;
use App\Models\Supplier;
use App\Observers\UserActivityObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        Event::listen(Login::class, function ($event) {
            UserActivity::create([
                'user_id' => $event->user->id,
                'activity' => 'User logged in',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        });

        Event::listen(Logout::class, function ($event) {
            UserActivity::create([
                'user_id' => $event->user->id,
                'activity' => 'User logged out',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        });

        Category::observe(UserActivityObserver::class);
        Product::observe(UserActivityObserver::class);
        StockTransaction::observe(UserActivityObserver::class);
        ProductAttribute::observe(UserActivityObserver::class);
        Supplier::observe(UserActivityObserver::class);
        Setting::observe(UserActivityObserver::class);
        StockOpname::observe(UserActivityObserver::class);
    }
    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

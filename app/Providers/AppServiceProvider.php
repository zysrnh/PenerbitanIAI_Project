<?php

namespace App\Providers;

use App\Models\ContactMessage;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
        // Force HTTPS URL generation in production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Strict model behavior
        Model::preventLazyLoading(!app()->isProduction());
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());

        // View Composer for Admin Layout (Universal Notification Data)
        View::composer('admin.layouts.app', function ($view) {
            try {
                $unreadMessagesCount = ContactMessage::where('status', 'pending')->count();
                $pendingOrdersCount = Order::whereIn('payment_status', ['paid'])->where('shipping_status', 'pending')->count();
                $latestMessages = ContactMessage::latest()->take(5)->get();
                $latestOrders = Order::whereIn('payment_status', ['paid', 'completed'])->latest()->take(5)->get();

                $view->with([
                    'unreadMessagesCount' => $unreadMessagesCount,
                    'pendingOrdersCount'  => $pendingOrdersCount,
                    'totalNotifCount'     => $unreadMessagesCount + $pendingOrdersCount,
                    'latestMessages'      => $latestMessages,
                    'latestOrders'        => $latestOrders,
                ]);
            } catch (\Throwable $e) {
                $view->with([
                    'unreadMessagesCount' => 0,
                    'pendingOrdersCount'  => 0,
                    'totalNotifCount'     => 0,
                    'latestMessages'      => collect(),
                    'latestOrders'        => collect(),
                ]);
            }
        });
    }
}

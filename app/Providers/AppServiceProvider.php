<?php

namespace App\Providers;

use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\OrderMessage;
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
        // View Composer for Member Portal (Universal Member Notification Data)
        View::composer(['member.dashboard', 'member.orders', 'member.profile'], function ($view) {
            try {
                $user = auth()->user();
                if ($user) {
                    $memberOrders = Order::where('user_id', $user->id)
                        ->orWhere('customer_email', $user->email)
                        ->latest()
                        ->take(5)
                        ->get();

                    $memberActiveNotifCount = Order::where(function ($q) use ($user) {
                            $q->where('user_id', $user->id)
                              ->orWhere('customer_email', $user->email);
                        })
                        ->where(function ($q) {
                            $q->where('payment_status', 'pending')
                              ->orWhereIn('shipping_status', ['menunggu_proses', 'diproses', 'dikirim']);
                        })
                        ->count();

                    $view->with([
                        'memberNotifOrders'      => $memberOrders,
                        'memberActiveNotifCount' => $memberActiveNotifCount,
                    ]);
                } else {
                    $view->with([
                        'memberNotifOrders'      => collect(),
                        'memberActiveNotifCount' => 0,
                    ]);
                }
            } catch (\Throwable $e) {
                $view->with([
                    'memberNotifOrders'      => collect(),
                    'memberActiveNotifCount' => 0,
                ]);
            }
        });

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
                $pendingOrdersCount = Order::where('payment_status', 'completed')->where('shipping_status', 'menunggu_proses')->count();
                $unreadOrderMessagesCount = OrderMessage::where('sender_type', 'customer')->where('is_read_by_admin', false)->count();
                $latestOrderMessages = OrderMessage::where('sender_type', 'customer')->latest()->take(5)->get();
                $latestMessages = ContactMessage::latest()->take(5)->get();
                $latestOrders = Order::whereIn('payment_status', ['paid', 'completed'])->latest()->take(5)->get();

                $view->with([
                    'unreadMessagesCount'      => $unreadMessagesCount,
                    'pendingOrdersCount'       => $pendingOrdersCount,
                    'unreadOrderMessagesCount' => $unreadOrderMessagesCount,
                    'totalUnreadChatCount'     => $unreadMessagesCount + $unreadOrderMessagesCount,
                    'totalNotifCount'          => $unreadMessagesCount + $pendingOrdersCount + $unreadOrderMessagesCount,
                    'latestOrderMessages'      => $latestOrderMessages,
                    'latestMessages'           => $latestMessages,
                    'latestOrders'             => $latestOrders,
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

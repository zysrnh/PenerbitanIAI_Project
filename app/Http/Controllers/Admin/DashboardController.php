<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalBooks = Book::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'completed')->sum('total_amount');
        
        $recentOrders = Order::latest()->take(6)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        // Funnel counts for realtime management
        $countPending = Order::where('payment_status', 'pending')->count();
        $countProcessing = Order::where('payment_status', 'completed')->whereIn('shipping_status', ['menunggu_proses', 'diproses'])->count();
        $countShipping = Order::where('payment_status', 'completed')->where('shipping_status', 'dikirim')->count();
        $countCompleted = Order::where('shipping_status', 'selesai')->count();
        $unreadMessagesCount = ContactMessage::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalBooks', 
            'totalOrders', 
            'totalRevenue', 
            'recentOrders', 
            'recentMessages',
            'countPending',
            'countProcessing',
            'countShipping',
            'countCompleted',
            'unreadMessagesCount'
        ));
    }
}

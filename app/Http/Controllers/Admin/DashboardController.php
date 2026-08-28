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
        $recentOrders = Order::latest()->take(5)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalBooks', 
            'totalOrders', 
            'totalRevenue', 
            'recentOrders', 
            'recentMessages'
        ));
    }
}

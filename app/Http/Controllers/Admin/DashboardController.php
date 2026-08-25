<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalSuperAdmins = User::where('role', 'super_admin')->count();
        $totalAdmins = User::where('role', 'admin')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalSuperAdmins', 'totalAdmins'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\Order;
use App\Models\SiteSetting;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalBooks = Book::count();
        $recentBooks = Book::latest()->take(6)->get();
        $contactWa = SiteSetting::get('contact_whatsapp', '6282116116133');
        $contactEmail = SiteSetting::get('contact_email', 'info@penerbitpersis.com');

        $userOrders = Order::where('user_id', $user->id)
            ->orWhere('customer_email', $user->email)
            ->latest()
            ->get();
        
        $totalUserOrders = $userOrders->count();
        $paidOrdersCount = $userOrders->where('payment_status', 'completed')->count();
        $latestOrder = $userOrders->first();

        $countPending = $userOrders->where('payment_status', 'pending')->count();
        $countProcessing = $userOrders->where('payment_status', 'completed')->whereIn('shipping_status', ['menunggu_proses', 'diproses'])->count();
        $countShipping = $userOrders->where('payment_status', 'completed')->where('shipping_status', 'dikirim')->count();
        $countCompleted = $userOrders->where('shipping_status', 'selesai')->count();

        return view('member.dashboard', compact(
            'user', 
            'totalBooks', 
            'recentBooks', 
            'contactWa', 
            'contactEmail',
            'totalUserOrders',
            'paidOrdersCount',
            'latestOrder',
            'countPending',
            'countProcessing',
            'countShipping',
            'countCompleted'
        ));
    }

    public function orders(Request $request)
    {
        $user = Auth::user();
        $contactWa = SiteSetting::get('contact_whatsapp', '6282116116133');
        $statusFilter = $request->query('status');

        $query = Order::where(function ($q) use ($user) {
            $q->where('user_id', $user->id)
              ->orWhere('customer_email', $user->email);
        })->latest();

        if ($statusFilter === 'pending') {
            $query->where('payment_status', 'pending');
        } elseif ($statusFilter === 'diproses') {
            $query->where('payment_status', 'completed')
                  ->whereIn('shipping_status', ['menunggu_proses', 'diproses']);
        } elseif ($statusFilter === 'dikirim') {
            $query->where('payment_status', 'completed')
                  ->where('shipping_status', 'dikirim');
        } elseif ($statusFilter === 'selesai') {
            $query->where('shipping_status', 'selesai');
        }

        $orders = $query->paginate(10)->withQueryString();

        $allOrders = Order::where('user_id', $user->id)->orWhere('customer_email', $user->email)->get();
        $countAll = $allOrders->count();
        $countPending = $allOrders->where('payment_status', 'pending')->count();
        $countProcessing = $allOrders->where('payment_status', 'completed')->whereIn('shipping_status', ['menunggu_proses', 'diproses'])->count();
        $countShipping = $allOrders->where('payment_status', 'completed')->where('shipping_status', 'dikirim')->count();
        $countCompleted = $allOrders->where('shipping_status', 'selesai')->count();

        return view('member.orders', compact(
            'user',
            'orders',
            'statusFilter',
            'countAll',
            'countPending',
            'countProcessing',
            'countShipping',
            'countCompleted',
            'contactWa'
        ));
    }

    public function confirmReceived($orderNumber)
    {
        $user = Auth::user();
        $order = Order::where('order_number', $orderNumber)
            ->where(function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhere('customer_email', $user->email);
            })
            ->firstOrFail();

        if ($order->shipping_status !== 'dikirim') {
            return redirect()->back()->with('error', 'Status pesanan tidak valid untuk dikonfirmasi.');
        }

        $order->update([
            'shipping_status' => 'selesai'
        ]);

        return redirect()->route('member.orders')->with('success', 'Terima kasih! Pesanan #' . $order->order_number . ' telah dikonfirmasi diterima.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('member.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:25',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:3072',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.max' => 'Ukuran gambar maksimal 3MB.',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return back()->with('success', 'Profil dan foto Anda berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Kata sandi akun Anda berhasil diperbarui.');
    }
}

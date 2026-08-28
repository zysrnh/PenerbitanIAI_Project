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
        $recentBooks = Book::latest()->take(4)->get();
        $contactWa = SiteSetting::get('contact_whatsapp', '6282116116133');
        $contactEmail = SiteSetting::get('contact_email', 'penerbitan@iaipibandung.ac.id');

        $userOrders = Order::where('user_id', $user->id)
            ->orWhere('customer_email', $user->email)
            ->latest()
            ->get();
        $totalUserOrders = $userOrders->count();
        $paidOrdersCount = $userOrders->where('payment_status', 'completed')->count();

        return view('member.dashboard', compact(
            'user', 
            'totalBooks', 
            'recentBooks', 
            'contactWa', 
            'contactEmail',
            'totalUserOrders',
            'paidOrdersCount'
        ));
    }

    public function orders(Request $request)
    {
        $user = Auth::user();
        $contactWa = SiteSetting::get('contact_whatsapp', '6282116116133');
        $statusFilter = $request->query('status'); // all, pending, diproses, dikirim, selesai

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

        // Status counts for tabs
        $allOrders = Order::where('user_id', $user->id)->orWhere('customer_email', $user->email)->get();
        $countAll = $allOrders->count();
        $countPending = $allOrders->where('payment_status', 'pending')->count();
        $countProcessing = $allOrders->where('payment_status', 'completed')->whereIn('shipping_status', ['menunggu_proses', 'diproses'])->count();
        $countShipping = $allOrders->where('payment_status', 'completed')->where('shipping_status', 'dikirim')->count();
        $countCompleted = $allOrders->where('shipping_status', 'selesai')->count();

        return view('member.orders', compact(
            'user',
            'orders',
            'contactWa',
            'statusFilter',
            'countAll',
            'countPending',
            'countProcessing',
            'countShipping',
            'countCompleted'
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

        $order->update([
            'shipping_status' => 'selesai',
        ]);

        return back()->with('success', 'Alhamdulillah! Pesanan #' . $orderNumber . ' telah berhasil Anda konfirmasi diterima. Terima kasih telah berbelanja di PERSIS PERS!');
    }

    public function profile()
    {
        $user = Auth::user();
        $contactWa = SiteSetting::get('contact_whatsapp', '6282116116133');
        return view('member.profile', compact('user', 'contactWa'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:100'],
            'phone'  => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:3072'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'avatar.image'  => 'Berkas avatar harus berupa gambar.',
            'avatar.mimes'  => 'Format gambar yang didukung: JPG, PNG, WEBP, atau SVG.',
            'avatar.max'    => 'Ukuran gambar maksimal 3MB.',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        $user->update($validated);

        return back()->with('success', 'Profil dan foto profil Anda berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password'      => ['required'],
            'password'              => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ], [
            'password.min'       => 'Kata sandi baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak benar.']);
        }

        $user->update(['password' => Hash::make($validated['password'])]);

        return back()->with('success', 'Kata sandi Anda berhasil diperbarui.');
    }
}

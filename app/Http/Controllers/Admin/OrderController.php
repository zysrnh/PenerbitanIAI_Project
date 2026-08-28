<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('q');
        $search = $search ? str_replace(['%', '_'], ['\%', '\_'], $search) : null;

        $query = Order::latest();

        if ($status) {
            $query->where('payment_status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(15)->withQueryString();

        $totalRevenue = Order::where('payment_status', 'completed')->sum('total_amount');
        $totalCompleted = Order::where('payment_status', 'completed')->count();
        $totalPending = Order::where('payment_status', 'pending')->count();
        $totalOrders = Order::count();

        return view('admin.orders.index', compact(
            'orders',
            'totalRevenue',
            'totalCompleted',
            'totalPending',
            'totalOrders',
            'status',
            'search'
        ));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function printShippingLabel($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.shipping_label', compact('order'));
    }

    public function updateShipping(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'shipping_status' => ['required', 'string', 'in:menunggu_proses,diproses,dikirim,selesai'],
            'tracking_number' => ['nullable', 'string', 'max:100'],
            'notes'           => ['nullable', 'string', 'max:500'],
        ]);

        $order->update($validated);

        return back()->with('success', 'Status pengiriman pesanan #' . $order->order_number . ' berhasil diperbarui.');
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'payment_status' => ['required', 'string', 'in:pending,completed,failed,expired'],
        ]);

        if ($validated['payment_status'] === 'completed' && !$order->paid_at) {
            $order->paid_at = now();
        }

        $order->payment_status = $validated['payment_status'];
        $order->save();

        return back()->with('success', 'Status pembayaran pesanan #' . $order->order_number . ' berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $orderNum = $order->order_number;
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan #' . $orderNum . ' berhasil dihapus.');
    }
}

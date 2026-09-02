<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Mail\ShippingNotificationCustomerMail;
use App\Mail\OrderMessageNotificationMail;
use App\Models\OrderMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
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

        // Send Shipping Notification Email to Customer when status is 'dikirim' or tracking number is provided
        if (!empty($order->customer_email) && filter_var($order->customer_email, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($order->customer_email)->send(new ShippingNotificationCustomerMail($order));
            } catch (\Throwable $e) {
                Log::warning('Failed sending shipping notification email: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Status pengiriman pesanan #' . $order->order_number . ' berhasil diperbarui dan notifikasi email telah dikirimkan ke pembeli.');
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

    
    /**
     * Send message from Admin to Customer
     */
    public function sendOrderMessage(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'message'                => 'required|string|max:3000',
            'share_shipping_status'  => 'nullable|string|in:menunggu_proses,diproses,dikirim,selesai',
            'share_tracking_number'  => 'nullable|string|max:100',
        ]);

        $sharedStatus = $request->input('share_shipping_status');
        $sharedResi = $request->input('share_tracking_number');

        // Optional shipping status update
        if ($sharedStatus) {
            $order->shipping_status = $sharedStatus;
            if ($sharedResi) {
                $order->tracking_number = $sharedResi;
            }
            $order->save();
        }

        $orderMsg = OrderMessage::create([
            'order_id'               => $order->id,
            'user_id'                => Auth::id(),
            'sender_type'            => 'admin',
            'sender_name'            => Auth::user() ? (Auth::user()->name . (Auth::user()->role === 'super_admin' ? ' (Super Admin)' : ' (Admin Redaksi)')) : 'Admin Redaksi PERSIS PERS',
            'message'                => $request->input('message'),
            'shared_shipping_status' => $sharedStatus,
            'shared_tracking_number' => $sharedResi,
            'is_read_by_admin'       => true,
            'is_read_by_customer'    => false,
        ]);

        // Mark previous customer messages as read
        $order->messages()->where('sender_type', 'customer')->update(['is_read_by_admin' => true]);

        // Send email notification to Customer
        if (!empty($order->customer_email) && filter_var($order->customer_email, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($order->customer_email)->send(new OrderMessageNotificationMail($order, $orderMsg, 'customer'));
            } catch (\Throwable $e) {
                Log::warning('Failed sending order message email to customer: ' . $e->getMessage());
            }
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim ke pembeli.',
                'data'    => $orderMsg
            ]);
        }

        return back()->with('success', 'Pesan berhasil dikirimkan ke pembeli.');
    }

    
    /**
     * Get Order details and messages stream JSON for Admin drawer chat
     */
    public function getOrderMessagesApi($id)
    {
        $order = Order::findOrFail($id);

        // Mark customer messages as read by admin
        $order->messages()->where('sender_type', 'customer')->update(['is_read_by_admin' => true]);

        $items = is_array($order->items_json) ? $order->items_json : json_decode($order->items_json ?? '[]', true);
        $formattedItems = [];
        foreach ($items as $it) {
            $cover = $it['cover_image'] ?? null;
            if (!$cover && !empty($it['book_id'])) {
                $b = \App\Models\Book::find($it['book_id']);
                $cover = $b ? $b->cover_image : null;
            }
            $hasCover = $cover && (file_exists(public_path('storage/' . $cover)) || file_exists(public_path('images/' . $cover)));
            $coverUrl = $hasCover ? (file_exists(public_path('storage/' . $cover)) ? asset('storage/' . $cover) : asset('images/' . $cover)) : null;

            $formattedItems[] = [
                'title'           => $it['title'] ?? 'Buku PERSIS PERS',
                'author'          => $it['author'] ?? 'Penulis PERSIS',
                'quantity'        => (int)($it['quantity'] ?? ($it['qty'] ?? 1)),
                'formatted_price' => $it['formatted_price'] ?? ('Rp ' . number_format($it['price'] ?? 0, 0, ',', '.')),
                'cover_url'       => $coverUrl,
            ];
        }

        $messages = $order->messages()->get()->map(function($msg) {
            return [
                'id'                     => $msg->id,
                'sender_type'            => $msg->sender_type,
                'sender_name'            => $msg->sender_name,
                'message'                => $msg->message,
                'shared_shipping_status' => $msg->shared_shipping_status,
                'shared_tracking_number' => $msg->shared_tracking_number,
                'created_at_formatted'   => $msg->created_at->format('d M Y, H:i') . ' WIB',
                'is_admin'               => $msg->sender_type === 'admin',
            ];
        });

        return response()->json([
            'success'  => true,
            'order'    => [
                'id'                 => $order->id,
                'order_number'       => $order->order_number,
                'customer_name'      => $order->customer_name,
                'customer_phone'     => $order->customer_phone,
                'shipping_status'    => $order->shipping_status,
                'tracking_number'    => $order->tracking_number,
                'formatted_payment'  => $order->formatted_payment,
                'items'              => $formattedItems,
            ],
            'messages' => $messages
        ]);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $orderNum = $order->order_number;
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan #' . $orderNum . ' berhasil dihapus.');
    }
}

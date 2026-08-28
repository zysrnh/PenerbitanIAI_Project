<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactReplyMail;
use App\Models\ContactMessage;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $search = $search ? str_replace(['%', '_'], ['\%', '\_'], $search) : null;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('service')) {
            $query->where('service_category', $request->service);
        }

        $messages = $query->latest()->paginate(10)->withQueryString();
        $pendingCount = ContactMessage::where('status', 'pending')->count();

        return view('admin.messages.index', compact('messages', 'pendingCount'));
    }

    public function show(ContactMessage $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    public function update(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,contacted,completed'],
            'notes' => ['nullable', 'string'],
        ]);

        $message->update($validated);

        return back()->with('success', 'Status pesan pengajuan berhasil diperbarui.');
    }

    /**
     * Send direct official email reply to the message sender.
     */
    public function reply(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'reply_message' => ['required', 'string', 'max:5000'],
        ]);

        if (empty($message->email) || !filter_var($message->email, FILTER_VALIDATE_EMAIL)) {
            return back()->with('error', 'Alamat email pengirim tidak valid.');
        }

        $adminName = Auth::user() ? Auth::user()->name : 'Admin Redaksi PERSIS PERS';

        try {
            Mail::to($message->email)->send(new ContactReplyMail(
                $message,
                $validated['subject'],
                $validated['reply_message'],
                $adminName
            ));

            // Automatically update status to 'contacted'
            $timestamp = now()->format('d/m/Y H:i');
            $logEntry = "[{$timestamp} WIB] Balasan email dikirim oleh {$adminName}:\n\"" . Str::limit($validated['reply_message'], 150) . "\"";
            
            $updatedNotes = $message->notes ? $message->notes . "\n\n" . $logEntry : $logEntry;

            $message->update([
                'status' => 'contacted',
                'notes'  => $updatedNotes,
            ]);

            return back()->with('success', 'Balasan email berhasil dikirim ke ' . $message->email . ' dan status otomatis diperbarui menjadi Sudah Dihubungi.');
        } catch (\Throwable $e) {
            Log::error('Failed sending email reply: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    /**
     * Live Polling API endpoint for real-time notifications in admin header.
     */
    public function liveNotifications()
    {
        $unreadMessagesCount = ContactMessage::where('status', 'pending')->count();
        $pendingOrdersCount = Order::whereIn('payment_status', ['paid'])->where('shipping_status', 'pending')->count();
        $totalBadge = $unreadMessagesCount + $pendingOrdersCount;

        $latestMessages = ContactMessage::latest()->take(5)->get()->map(function ($msg) {
            return [
                'id'         => $msg->id,
                'type'       => 'message',
                'name'       => $msg->name,
                'category'   => $msg->service_category ?? 'Konsultasi',
                'subject'    => $msg->subject ?: Str::limit($msg->message, 40),
                'is_pending' => $msg->status === 'pending',
                'time_ago'   => $msg->created_at->diffForHumans(),
                'url'        => route('admin.messages.show', $msg),
            ];
        });

        $latestOrders = Order::whereIn('payment_status', ['paid', 'completed'])->latest()->take(5)->get()->map(function ($ord) {
            return [
                'id'              => $ord->id,
                'type'            => 'order',
                'order_number'    => $ord->order_number,
                'customer_name'   => $ord->customer_name,
                'total_amount'    => 'Rp ' . number_format($ord->total_amount, 0, ',', '.'),
                'shipping_status' => $ord->shipping_status_label,
                'time_ago'        => $ord->created_at->diffForHumans(),
                'url'             => route('admin.orders.show', $ord->id),
            ];
        });

        return response()->json([
            'unread_messages_count' => $unreadMessagesCount,
            'pending_orders_count'  => $pendingOrdersCount,
            'total_badge'           => $totalBadge,
            'messages'              => $latestMessages,
            'orders'                => $latestOrders,
        ]);
    }

    /**
     * Mark all pending messages as contacted.
     */
    public function markAllRead()
    {
        ContactMessage::where('status', 'pending')->update(['status' => 'contacted']);
        return response()->json(['status' => 'success']);
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil dihapus.');
    }
}

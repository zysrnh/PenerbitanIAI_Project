<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\SiteSetting;
use App\Mail\NewOrderAdminMail;
use App\Mail\PaymentSuccessCustomerMail;
use App\Mail\PaymentSuccessAdminMail;
use Illuminate\Support\Facades\Mail;
use App\Models\CartItem;
use App\Models\Book;

class PaymentController extends Controller
{
    /**
     * Create QRIS transaction via Pakasir API
     */
    public function createQrisPayment(Request $request)
    {
        $request->validate([
            'customer_name'    => ['required', 'string', 'max:150'],
            'customer_phone'   => ['required', 'string', 'max:25'],
            'customer_address' => ['required', 'string', 'max:500'],
            'customer_email'   => ['nullable', 'email', 'max:150'],
            'notes'            => ['nullable', 'string', 'max:500'],
        ]);

        $userId = Auth::id();
        $cartItems = CartItem::with('book')
            ->where('user_id', $userId)
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang belanja Anda masih kosong.',
            ], 422);
        }

        // Calculate total and prepare item snapshots
        $totalAmount = 0;
        $itemsSnapshot = [];

        foreach ($cartItems as $item) {
            if (!$item->book) continue;
            $subtotal = $item->subtotal;
            $totalAmount += $subtotal;

            $itemsSnapshot[] = [
                'book_id'            => $item->book_id,
                'title'              => $item->book->title,
                'author'             => $item->book->author,
                'category'           => $item->book->category ?? 'Buku Ajar',
                'cover_image'        => $item->book->cover_image,
                'quantity'           => (int)$item->quantity,
                'unit_price'         => $item->numeric_price,
                'formatted_price'    => $item->formatted_price,
                'subtotal'           => $subtotal,
                'formatted_subtotal' => $item->formatted_subtotal,
            ];
        }

        if ($totalAmount <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Total pembayaran tidak valid.',
            ], 422);
        }

        // Generate unique Order Number
        $orderNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        // Pakasir Credentials
        $projectSlug = env('PAKASIR_PROJECT', 'payment-gateway-penerbit-pers');
        $apiKey = env('PAKASIR_API_KEY', 'Dh71KlS9BiHSQ7FeunxXKGeh3rX1O39d');

        try {
            // Call Pakasir QRIS API
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Content-Type' => 'application/json',
            ])->post('https://app.pakasir.com/api/transactioncreate/qris', [
                'project'  => $projectSlug,
                'order_id' => $orderNumber,
                'amount'   => (int)$totalAmount,
                'api_key'  => $apiKey,
            ]);

            if (!$response->successful()) {
                Log::error('Pakasir Create QRIS Failed', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Gagal membuat tagihan QRIS. Silakan gunakan pemesanan via WhatsApp atau coba beberapa saat lagi.',
                ], 500);
            }

            $resData = $response->json();
            $paymentData = $resData['payment'] ?? [];

            $totalPayment = (float)($paymentData['total_payment'] ?? $totalAmount);
            $fee = (float)($paymentData['fee'] ?? ($totalPayment - $totalAmount));
            $qrString = $paymentData['payment_number'] ?? '';
            $expiredAt = isset($paymentData['expired_at']) ? date('Y-m-d H:i:s', strtotime($paymentData['expired_at'])) : now()->addMinutes(15);

            // Save Order to Database
            $order = Order::create([
                'order_number'      => $orderNumber,
                'user_id'           => $userId,
                'customer_name'     => $request->input('customer_name'),
                'customer_email'    => $request->input('customer_email', Auth::user()->email ?? null),
                'customer_phone'    => $request->input('customer_phone'),
                'customer_address'  => $request->input('customer_address'),
                'total_amount'      => $totalAmount,
                'fee'               => $fee,
                'total_payment'     => $totalPayment,
                'payment_method'    => 'qris',
                'payment_status'    => 'pending',
                'gateway_project'   => $projectSlug,
                'payment_qr_string' => $qrString,
                'expired_at'        => $expiredAt,
                'items_json'        => $itemsSnapshot,
                'notes'             => $request->input('notes'),
                'shipping_status'   => 'menunggu_proses',
            ]);

            // Clear Cart
            CartItem::where('user_id', $userId)->delete();

            // Send Order Notification Email to Admin
            try {
                $recipientEmail = SiteSetting::get('notification_recipient_email', 'info@penerbitpersis.com');
                if (!empty($recipientEmail)) {
                    Mail::to($recipientEmail)->send(new NewOrderAdminMail($order));
                }
            } catch (\Throwable $mailErr) {
                Log::warning('Order notification email failed: ' . $mailErr->getMessage());
            }

            // Generate QR Image URL
            $qrImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&margin=10&data=' . urlencode($qrString);

            return response()->json([
                'success'           => true,
                'order_id'          => $order->id,
                'order_number'      => $orderNumber,
                'total_amount'      => $totalAmount,
                'formatted_amount'  => 'Rp ' . number_format($totalAmount, 0, ',', '.'),
                'fee'               => $fee,
                'formatted_fee'     => 'Rp ' . number_format($fee, 0, ',', '.'),
                'total_payment'     => $totalPayment,
                'formatted_total'   => 'Rp ' . number_format($totalPayment, 0, ',', '.'),
                'qr_string'         => $qrString,
                'qr_image_url'      => $qrImageUrl,
                'expired_at'        => $expiredAt,
                'invoice_url'       => route('order.invoice', $orderNumber),
            ]);

        } catch (\Exception $e) {
            Log::error('Pakasir Exception: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem saat memproses QRIS: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Check real-time payment status
     */
    public function checkStatus($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan.',
            ], 404);
        }

        // If already marked completed in database
        if ($order->payment_status === 'completed') {
            return response()->json([
                'success'        => true,
                'payment_status' => 'completed',
                'paid_at'        => $order->paid_at ? $order->paid_at->format('d M Y H:i') : null,
                'invoice_url'    => route('order.invoice', $orderNumber),
            ]);
        }

        // Active check to Pakasir API
        $projectSlug = env('PAKASIR_PROJECT', 'payment-gateway-penerbit-pers');
        $apiKey = env('PAKASIR_API_KEY', 'Dh71KlS9BiHSQ7FeunxXKGeh3rX1O39d');

        try {
            $apiUrl = "https://app.pakasir.com/api/transactiondetail?project={$projectSlug}&order_id={$orderNumber}&amount=" . (int)$order->total_amount . "&api_key={$apiKey}";
            
            $res = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            ])->get($apiUrl);

            if ($res->successful()) {
                $tx = $res->json()['transaction'] ?? [];
                $status = $tx['status'] ?? 'pending';

                if ($status === 'completed' || $status === 'success') {
                    $this->handlePaymentSuccess($order);

                    return response()->json([
                        'success'        => true,
                        'payment_status' => 'completed',
                        'paid_at'        => now()->format('d M Y H:i'),
                        'invoice_url'    => route('order.invoice', $orderNumber),
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::warning('Pakasir active check failed: ' . $e->getMessage());
        }

        return response()->json([
            'success'        => true,
            'payment_status' => $order->payment_status,
            'invoice_url'    => route('order.invoice', $orderNumber),
        ]);
    }

    /**
     * Webhook Handler for Pakasir
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();
        Log::info('Pakasir Webhook Received', [
            'ip'      => $request->ip(),
            'payload' => $payload,
        ]);

        // Webhook signature / API key verification
        $webhookSecret = config('services.pakasir.webhook_secret', env('PAKASIR_WEBHOOK_SECRET'));
        if ($webhookSecret) {
            $providedKey = $request->input('api_key') ?? $request->header('X-Webhook-Secret');
            if (!$providedKey || !hash_equals($webhookSecret, $providedKey)) {
                Log::warning('Pakasir Webhook: Invalid signature/key', ['ip' => $request->ip()]);
                return response()->json(['message' => 'Unauthorized'], 403);
            }
        }

        $orderNumber = $request->input('order_id');
        $status = $request->input('status');
        $amount = $request->input('amount');
        $project = $request->input('project');

        // Validate required fields
        if (empty($orderNumber) || empty($status)) {
            return response()->json(['message' => 'Missing required fields'], 400);
        }

        $expectedProject = config('services.pakasir.project', env('PAKASIR_PROJECT', 'payment-gateway-penerbit-pers'));

        if ($project && $project !== $expectedProject) {
            Log::warning("Pakasir Webhook: Project mismatch", ['received' => $project, 'expected' => $expectedProject]);
            return response()->json(['message' => 'Invalid project'], 400);
        }

        $order = Order::where('order_number', $orderNumber)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Prevent re-processing already completed orders
        if ($order->payment_status === 'completed') {
            return response()->json(['status' => 'already_processed']);
        }

        // Amount verification – reject if amount doesn't match
        if ($amount && abs((float)$amount - (float)$order->total_amount) > 1) {
            Log::warning("Pakasir Webhook: Amount mismatch", [
                'order'    => $orderNumber,
                'expected' => $order->total_amount,
                'received' => $amount,
            ]);
            return response()->json(['message' => 'Amount mismatch'], 400);
        }

        // Only accept known valid status transitions
        $validStatuses = ['completed', 'success', 'failed', 'expired'];
        if (!in_array($status, $validStatuses)) {
            return response()->json(['message' => 'Invalid status'], 400);
        }

        if ($status === 'completed' || $status === 'success') {
            $this->handlePaymentSuccess($order);

            Log::info("Order {$orderNumber} successfully marked as completed via Pakasir Webhook.");
        } elseif ($status === 'failed' || $status === 'expired') {
            $order->update([
                'payment_status' => $status,
            ]);
        }

        return response()->json(['status' => 'ok']);
    }

    /**
     * Show Order Invoice Page
     */
    
    /**
     * Process Payment Success actions (Update DB & Send Confirmation Emails)
     */
    protected function handlePaymentSuccess(Order $order)
    {
        $order->update([
            'payment_status' => 'completed',
            'paid_at'        => now(),
        ]);

        // 1. Send confirmation email to Customer
        try {
            if (!empty($order->customer_email) && filter_var($order->customer_email, FILTER_VALIDATE_EMAIL)) {
                Mail::to($order->customer_email)->send(new PaymentSuccessCustomerMail($order));
            }
        } catch (\Throwable $e) {
            Log::warning('Customer payment success email failed: ' . $e->getMessage());
        }

        // 2. Send notification email to Admin
        try {
            $adminEmail = SiteSetting::get('notification_recipient_email', 'info@penerbitpersis.com');
            if (!empty($adminEmail)) {
                Mail::to($adminEmail)->send(new PaymentSuccessAdminMail($order));
            }
        } catch (\Throwable $e) {
            Log::warning('Admin payment success email failed: ' . $e->getMessage());
        }
    }

    public function showInvoice($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        return view('order.invoice', compact('order'));
    }
}

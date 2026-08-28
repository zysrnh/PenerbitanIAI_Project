<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewOrderAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📦 Pesanan Buku Baru: #' . $this->order->order_number . ' - ' . $this->order->customer_name . ' (Rp ' . number_format($this->order->total_amount, 0, ',', '.') . ')',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

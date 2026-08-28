<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\OrderMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMessageNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Order $order,
        public OrderMessage $orderMessage,
        public string $recipientType = 'customer' // 'customer' or 'admin'
    ) {
    }

    public function envelope(): Envelope
    {
        $sender = $this->orderMessage->sender_name ?: ($this->orderMessage->sender_type === 'admin' ? 'Admin PERSIS PERS' : 'Pembeli');
        return new Envelope(
            subject: '💬 Pesan Baru untuk Pesanan #' . $this->order->order_number . ' dari ' . $sender . ' - PERSIS PERS',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_message_notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

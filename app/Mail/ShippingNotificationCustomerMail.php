<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ShippingNotificationCustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order)
    {
    }

    public function envelope(): Envelope
    {
        $resi = $this->order->tracking_number ? ' (Resi: ' . $this->order->tracking_number . ')' : '';
        return new Envelope(
            subject: '🚚 Pesanan Anda Telah Dikirim: #' . $this->order->order_number . $resi . ' - PERSIS PERS',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.shipping_notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderCompletedCustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉 Terima Kasih! Paket Pesanan #' . $this->order->order_number . ' Telah Selesai - PERSIS PERS',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_completed_customer',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

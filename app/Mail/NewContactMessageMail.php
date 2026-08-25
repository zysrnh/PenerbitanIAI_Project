<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactMessage $contactMessage)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🔔 Pesan Baru: ' . ($this->contactMessage->service_category ?? 'Konsultasi Naskah') . ' - ' . $this->contactMessage->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

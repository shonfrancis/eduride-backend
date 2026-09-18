<?php

namespace App\Mail;

use App\Models\Advertisement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendAdContactDetailsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Advertisement $ad)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Information for Ad: ' . $this->ad->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-details',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OutOfStockProducts extends Mailable
{
    use Queueable, SerializesModels;
    public $emailContent = [];

    /**
     * Create a new message instance and receive data.
     */
    public function __construct(array $messageText)
    {
        $this->emailContent = $messageText;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Out Of Stock Products',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'outofstockpage',
            with: [
                'emailMessage' => $this->emailContent,
            ]
        );

    }
}

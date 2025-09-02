<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendPaymentLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Personalized Quotation is Ready – Review & Pay Online!',
            // subject: '['. $this->data->order_code .']' .' Your Personalized Quotation is Ready – Review & Pay Online!',
            // subject: 'Thank You for Choosing Us - Final Payment Details for Order ID ' . $this->data['order_code'],
            // subject: 'Payment Reminder - Booking ID:' . $this->data['book_id'] . ' - Order ID:' . $this->data['order_code'],
        );
    }

    

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.book.paymentLinkMail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

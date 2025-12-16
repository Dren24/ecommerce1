<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Placed - KannCommerce'
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.orders.placed',
            with: [
                'order' => $this->order,
                'url'   => url('/myorders/' . $this->order->id), // ✅ FIXED
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

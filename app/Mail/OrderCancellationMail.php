<?php

namespace App\Mail;

use App\Models\Company;
use App\Models\Order;
use App\Models\Service;
use App\Models\SubPackage;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderCancellationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Order $order, public Company $company, public User $user, public Service $service, public SubPackage $package)
    {
        $this->order = $order;
        $this->company = $company;
        $this->user = $user;
        $this->service = $service;
        $this->package = $package;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Important Update: Order Cancellation and Refund Process',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.orderCancellationMail',
            with: [
                'order' => $this->order,
                'company' => $this->company,
                'user' => $this->user,
                'service' => $this->service,
                'package' => $this->package,
            ]
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

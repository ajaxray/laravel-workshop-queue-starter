<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\AccountApplication;

class AccountApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $trackingNumber;

    /**
     * Create a new message instance.
     */
    public function __construct(AccountApplication $application)
    {
        $this->application = $application;
        $this->trackingNumber = $application->tracking_id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Account Application Submitted',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.account_application_submitted',
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

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Account Application Submission')
            ->markdown('emails.account_application_submitted')
            ->with([
                'application' => $this->application,
                'trackingNumber' => $this->trackingNumber,
            ]);
    }
}

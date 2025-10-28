<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // Useful if emails need to be queued later
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address; // For specifying 'from' name and email


class ContactFormMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The contact form data.
     *
     * @var array
     */
    public $data;

    /**
     * Create a new message instance.
     *
     * @param array $data The validated data from the contact form.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // 'from' address uses .env MAIL_FROM_ADDRESS/NAME by default
        return new Envelope(
            // Use the sender's email from the form as the reply-to address
            replyTo: [
                new Address($this->data['user_email'], $this->data['user_name']),
            ],
            // Subject line for the email
            subject: 'New Contact Message from ' . config('app.name', 'Your Website'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-form', // Renders our Markdown Blade view
            with: ['data' => $this->data],   // Pass the $data array to the view
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
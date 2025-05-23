<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $appointment;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $appointment)
    {
        $this->user = $user;
        $this->appointment = $appointment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Success',
        );
    }

    public function build()
    {
        return $this->subject('Appointment Successfully Booked')
                    ->view('emails.appointment-success');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.appointment-success',
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

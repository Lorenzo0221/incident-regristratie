<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Incident;


class IncidentCreated extends Mailable
{
    use Queueable, SerializesModels;

    public Incident $incident;

    /**
     * Create a new message instance.
     */
    public function __construct(Incident $incident)
    {
        $this->incident = $incident;
    }

    public function build()
    {
        return $this->subject('Nieuwe incidentmelding')
            ->view('emails.incident-created');
    }

    // Optioneel: verwijder envelope/content/attachments als je alleen build() gebruikt
}

<?php

namespace App\Notifications;

use App\Models\Incident;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewIncidentNotification extends Notification
{
    use Queueable;

    public function __construct(public Incident $incident)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('🚨 Nieuwe incidentmelding')
            ->greeting('Hallo,')
            ->line('Er is een nieuwe incidentmelding aangemaakt.')
            ->line('Titel: ' . $this->incident->title)
            ->line('Locatie: ' . $this->incident->location)
            ->action(
                'Bekijk incident',
                route('incidents.show', $this->incident)
            )
            ->line('Reageer zo snel mogelijk.');
    }
}

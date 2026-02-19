<?php

namespace App\Notifications;

use App\Models\Incident;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IncidentStatusChanged extends Notification
{
    use Queueable;

    public function __construct(
        public Incident $incident,
        public string $oldStatus,
        public string $newStatus
    ) {}

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Status gewijzigd: ' . $this->incident->title)
            ->greeting('Hallo ' . ($notifiable->name ?? ''))
            ->line('De status van het incident is gewijzigd.')
            ->line('Incident: ' . $this->incident->title)
            ->line('Van: ' . $this->oldStatus)
            ->line('Naar: ' . $this->newStatus)
            ->action('Bekijk incident', route('incidents.show', $this->incident));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'incident_id' => $this->incident->id,
            'incident_title' => $this->incident->title,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
        ];
    }
}

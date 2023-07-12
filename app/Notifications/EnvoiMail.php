<?php

namespace App\Notifications;

use App\Models\Evenement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnvoiMail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $sexe = "Mr";
    public function __construct(protected Evenement $evenement, protected $infosEleve)
    {
        //
        if($this->infosEleve->sexe == "feminin")
        {
            $this->sexe = "Mme";
        }

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("Rappel d'événement")
                    ->greeting("Bonjour {$this->sexe} ")
                    ->line("Nous vous informons que l'évenement {$this->evenement->date_evenement} aura lieu le {$this->evenement->date_evenement}")
                    ->line("Pour plus d'informations , veuillez contacter le directeur de l'établissement")
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

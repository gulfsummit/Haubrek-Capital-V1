<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\CareerApplication;

class CareerApplicationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected CareerApplication $careerApplication)
    {
        //
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
                    ->subject('New Career Application - ' . $this->careerApplication->name)
                    ->line('A new career application has been submitted.')
                    ->line('**Applicant Details:**')
                    ->line('Name: ' . $this->careerApplication->name)
                    ->line('Mobile: ' . $this->careerApplication->mobile)
                    ->line('CV: ' . $this->careerApplication->cv_path)
                    ->line('')
                    ->line('Please review the application and CV attachment.')
                    ->attach(storage_path('app/public/' . $this->careerApplication->cv_path));
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
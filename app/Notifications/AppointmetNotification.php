<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Appointment;

class AppointmetNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Appointment $appointment)
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
                    ->subject('New Appointment Booking')
                    ->line('A new appointment has been booked.')
                    ->line('**Appointment Details:**')
                    ->line('Name: ' . $this->appointment->full_name)
                    ->line('Email: ' . $this->appointment->email)
                    ->line('Phone: ' . $this->appointment->phone)
                    ->line('Company Name: ' . $this->appointment->company_name)
                    ->line('User Type: ' . $this->appointment->user_type)
                    ->line('Message: ' . $this->appointment->message)
                    ->line('Selected Date: ' . $this->appointment->selected_date)
                    ->line('Selected Time: ' . $this->appointment->selected_time);
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

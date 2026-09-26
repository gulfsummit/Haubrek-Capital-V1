<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\MeetingRequest;

class MeetingRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected MeetingRequest $meetingRequest)
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
                    ->subject('New Meeting Request Form Submission - Not Eligible for Appointment')
                    ->line('A new meeting request form has been submitted by a user who is not eligible for an appointment.')
                    ->line('**User Details:**')
                    ->line('Name: ' . $this->meetingRequest->name)
                    ->line('Email: ' . $this->meetingRequest->email)
                    ->line('Phone: ' . $this->meetingRequest->phone)
                    ->line('')
                    ->line('**Assessment Details:**')
                    ->line('Percentage of assets for higher-risk investments: ' . $this->meetingRequest->percentage)
                    ->line('Age Group: ' . $this->meetingRequest->age_group)
                    ->line('Investment Experience: ' . $this->meetingRequest->investment_experience)
                    ->line('Wealth Size: ' . $this->meetingRequest->wealth_size)
                    ->line('Investment Goal: ' . implode(', ', $this->meetingRequest->investment_goal))
                    ->line('Investment Horizon: ' . $this->meetingRequest->investment_horizon)
                    ->line('Investment Reaction: ' . implode(', ', $this->meetingRequest->investment_reaction))
                    ->line('Income Source: ' . implode(', ', $this->meetingRequest->income_source))
                    ->line('Investment Style: ' . implode(', ', $this->meetingRequest->investment_style))
                    ->line('Asset Allocation: ' . implode(', ', $this->meetingRequest->asset_allocation))
                    ->line('')
                    ->line('This user did not meet the eligibility criteria for an appointment and has been thanked for their interest.');
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
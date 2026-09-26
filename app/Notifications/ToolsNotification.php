<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Question;

class ToolsNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Question $question)
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
        $mailMessage = (new MailMessage)
            ->subject('New Risk Assessment Form Submission')
            ->line('A new risk assessment form has been submitted.')
            ->line('**User Details:**')
            ->line('Name: ' . ($this->question->name ?? 'N/A'))
            ->line('Email: ' . ($this->question->email ?? 'N/A'))
            ->line('Phone: ' . ($this->question->phone ?? 'N/A'))
            ->line('')
            ->line('**Assessment Details:**');
        
        // Dynamically add all form field responses
        if ($this->question->percentage) {
            $mailMessage->line('Percentage of assets for higher-risk investments: ' . $this->question->percentage);
        }
        if ($this->question->age_group) {
            $mailMessage->line('Age Group: ' . $this->question->age_group);
        }
        if ($this->question->investment_experience) {
            $mailMessage->line('Investment Experience: ' . $this->question->investment_experience);
        }
        if ($this->question->wealth_size) {
            $mailMessage->line('Wealth Size: ' . $this->question->wealth_size);
        }
        if ($this->question->investment_goal) {
            $mailMessage->line('Investment Goal: ' . (is_array($this->question->investment_goal) ? implode(', ', $this->question->investment_goal) : $this->question->investment_goal));
        }
        if ($this->question->investment_horizon) {
            $mailMessage->line('Investment Horizon: ' . $this->question->investment_horizon);
        }
        if ($this->question->investment_reaction) {
            $mailMessage->line('Investment Reaction: ' . (is_array($this->question->investment_reaction) ? implode(', ', $this->question->investment_reaction) : $this->question->investment_reaction));
        }
        if ($this->question->income_source) {
            $mailMessage->line('Income Source: ' . (is_array($this->question->income_source) ? implode(', ', $this->question->income_source) : $this->question->income_source));
        }
        if ($this->question->investment_style) {
            $mailMessage->line('Investment Style: ' . (is_array($this->question->investment_style) ? implode(', ', $this->question->investment_style) : $this->question->investment_style));
        }
        if ($this->question->asset_allocation) {
            $mailMessage->line('Asset Allocation: ' . (is_array($this->question->asset_allocation) ? implode(', ', $this->question->asset_allocation) : $this->question->asset_allocation));
        }
        
        $mailMessage->line('')
            ->line('Thank you for your interest.');
        
        return $mailMessage;
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

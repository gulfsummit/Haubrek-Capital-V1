<?php

namespace App\Filament\Admin\Resources\NewsletterSubscriptionResource\Pages;

use App\Filament\Admin\Resources\NewsletterSubscriptionResource;
use App\Models\NewsletterSubscription;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;

class ListNewsletterSubscriptions extends ListRecords
{
    protected static string $resource = NewsletterSubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('exportSubscribers')
                ->label('Export Subscribers')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    $subscriptions = NewsletterSubscription::orderBy('created_at')->get(['email', 'status', 'created_at']);

                    if ($subscriptions->isEmpty()) {
                        Notification::make()
                            ->title('No subscribers found')
                            ->body('There are no newsletter subscribers to export yet.')
                            ->warning()
                            ->send();

                        return;
                    }

                    $fileName = 'newsletter-subscribers-' . now()->format('Y-m-d_H-i-s') . '.csv';

                    return response()->streamDownload(function () use ($subscriptions) {
                        $handle = fopen('php://output', 'w');
                        fputcsv($handle, ['Email', 'Status', 'Subscribed At']);

                        foreach ($subscriptions as $subscription) {
                            fputcsv($handle, [
                                $subscription->email,
                                Str::headline($subscription->status ?? ''),
                                optional($subscription->created_at)->format('Y-m-d H:i:s'),
                            ]);
                        }

                        fclose($handle);
                    }, $fileName);
                }),
        ];
    }
}

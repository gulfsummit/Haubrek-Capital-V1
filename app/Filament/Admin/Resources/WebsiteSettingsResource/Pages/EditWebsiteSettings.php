<?php

namespace App\Filament\Admin\Resources\WebsiteSettingsResource\Pages;

use App\Filament\Admin\Resources\WebsiteSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebsiteSettings extends EditRecord
{
    protected static string $resource = WebsiteSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['footer_settings'] = $this->mergeNestedSettings(
            $this->defaultFooterSettings(),
            $data['footer_settings'] ?? []
        );

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $incomingFooterSettings = $data['footer_settings'] ?? [];

        $data['footer_settings'] = $this->mergeNestedSettings(
            $this->record->footer_settings ?? [],
            $incomingFooterSettings
        );

        foreach (['regulation_text', 'regulation_text_ar'] as $clearableField) {
            if (array_key_exists($clearableField, $incomingFooterSettings) && blank($incomingFooterSettings[$clearableField])) {
                $data['footer_settings'][$clearableField] = '';
            }
        }

        return $data;
    }

    protected function mergeNestedSettings(array $existing, array $incoming): array
    {
        foreach ($existing as $key => $value) {
            if (! array_key_exists($key, $incoming)) {
                $incoming[$key] = $value;
                continue;
            }

            if (is_array($value) && is_array($incoming[$key]) && $this->isAssociativeArray($value) && $this->isAssociativeArray($incoming[$key])) {
                $incoming[$key] = $this->mergeNestedSettings($value, $incoming[$key]);
                continue;
            }

            if ($incoming[$key] === null) {
                $incoming[$key] = $value;
            }
        }

        return $incoming;
    }

    protected function isAssociativeArray(array $value): bool
    {
        return array_keys($value) !== range(0, count($value) - 1);
    }

    protected function defaultFooterSettings(): array
    {
        return [
            'show_app_download' => true,
            'app_download_text_en' => 'Download App',
            'app_download_text_ar' => 'تحميل التطبيق',
            'ios_app_link' => '#',
            'android_app_link' => '#',
            'show_current_year' => true,
            'company_name' => 'Hauberk Capital',
            'regulation_text' => '',
            'regulation_text_ar' => '',
            'privacy_policy_text_en' => 'Privacy Policy',
            'privacy_policy_text_ar' => 'سياسة الخصوصية',
            'privacy_policy_url' => 'privacy-policy.html',
            'terms_conditions_text_en' => 'Terms & Conditions',
            'terms_conditions_text_ar' => 'الشروط والأحكام',
            'terms_conditions_url' => 'terms-conditions.html',
            'cookie_policy_text_en' => 'Cookie Policy',
            'cookie_policy_text_ar' => 'سياسة ملفات تعريف الارتباط',
            'cookie_policy_url' => 'cookie-policy.html',
            'newsletter_placeholder_en' => 'Subscribe to Our Newsletter',
            'newsletter_placeholder_ar' => 'اشترك في نشرتنا الإخبارية',
            'newsletter_button_text_en' => 'Subscribe',
            'newsletter_button_text_ar' => 'اشترك',
        ];
    }
}

<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Forms\Components\SeoForm;
use App\Models\About;
use App\Models\App as AppModel;
use App\Models\AppointmentPage;
use App\Models\CioServices;
use App\Models\Concerns\HasSeoMeta;
use App\Models\ContactUs;
use App\Models\GovernanceServices;
use App\Models\Home;
use App\Models\InvestmentServices;
use App\Models\Page as ContentPage;
use App\Models\ResourceCenter;
use App\Models\Services;
use App\Models\Teams;
use App\Models\Tools;
use App\Models\WebsiteSettings;
use App\Models\WealthServices;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Model;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Models\Careers;

class MarketingSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationLabel = 'Marketing';

    protected static ?string $navigationGroup = 'Marketing';

    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'Marketing';

    protected static string $view = 'filament.admin.pages.marketing-settings';

    public array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->getInitialFormState());
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->makeForm()
                ->schema([
                    Forms\Components\Tabs::make('Marketing')
                        ->tabs([
                            Forms\Components\Tabs\Tab::make('Home')
                                ->schema(SeoForm::make('home')),
                            Forms\Components\Tabs\Tab::make('About')
                                ->schema(SeoForm::make('about')),
                            Forms\Components\Tabs\Tab::make('Team')
                                ->schema(SeoForm::make('team')),
                            Forms\Components\Tabs\Tab::make('App')
                                ->schema(SeoForm::make('app')),
                            Forms\Components\Tabs\Tab::make('Services')
                                ->schema(SeoForm::make('services')),
                            Forms\Components\Tabs\Tab::make('Governance')
                                ->schema(SeoForm::make('governance')),
                            Forms\Components\Tabs\Tab::make('Wealth')
                                ->schema(SeoForm::make('wealth')),
                            Forms\Components\Tabs\Tab::make('Investment')
                                ->schema(SeoForm::make('investment')),
                            Forms\Components\Tabs\Tab::make('CIO Office')
                                ->schema(SeoForm::make('cio')),
                            Forms\Components\Tabs\Tab::make('Tools')
                                ->schema(SeoForm::make('tools')),
                            Forms\Components\Tabs\Tab::make('Resource Center')
                                ->schema(SeoForm::make('resource_center')),
                            Forms\Components\Tabs\Tab::make('Blog')
                                ->schema(SeoForm::make('blog')),
                            Forms\Components\Tabs\Tab::make('Case Studies')
                                ->schema(SeoForm::make('case_studies')),
                            Forms\Components\Tabs\Tab::make('FAQ')
                                ->schema(SeoForm::make('faq')),
                            Forms\Components\Tabs\Tab::make('Request Meeting')
                                ->schema(SeoForm::make('request_meeting')),
                            Forms\Components\Tabs\Tab::make('Contact Us')
                                ->schema(SeoForm::make('contact')),
                            Forms\Components\Tabs\Tab::make('Appointment')
                                ->schema(SeoForm::make('appointment')),
                            Forms\Components\Tabs\Tab::make('Careers')
                                ->schema(SeoForm::make('careers')),
                            Forms\Components\Tabs\Tab::make('Site Defaults')
                                ->schema(SeoForm::make('site_defaults')),
                        ]),
                ])
                ->statePath('data'),
        ];
    }

    public function submit(): void
    {
        $state = $this->form->getState();

        $this->persistSeo(Home::first(), $state['home'] ?? []);
        $this->persistSeo(About::first(), $state['about'] ?? []);
        $this->persistSeo(Teams::first(), $state['team'] ?? []);
        $this->persistSeo(AppModel::first(), $state['app'] ?? []);
        $this->persistSeo(Services::first(), $state['services'] ?? []);
        $this->persistSeo(GovernanceServices::first(), $state['governance'] ?? []);
        $this->persistSeo(WealthServices::first(), $state['wealth'] ?? []);
        $this->persistSeo(InvestmentServices::first(), $state['investment'] ?? []);
        $this->persistSeo(CioServices::first(), $state['cio'] ?? []);
        $this->persistSeo(Tools::first(), $state['tools'] ?? []);
        $this->persistSeo(ResourceCenter::first(), $state['resource_center'] ?? []);
        $this->persistSeo($this->pageBySlug('blog-list'), $state['blog'] ?? []);
        $this->persistSeo($this->pageBySlug('case-studies-list'), $state['case_studies'] ?? []);
        $this->persistSeo($this->pageBySlug('faq'), $state['faq'] ?? []);
        $this->persistSeo($this->pageBySlug('request-meeting'), $state['request_meeting'] ?? []);
        $this->persistSeo(ContactUs::where('is_active', true)->first() ?? ContactUs::first(), $state['contact'] ?? []);
        $this->persistSeo(AppointmentPage::first(), $state['appointment'] ?? []);
        $this->persistSeo(Careers::where('is_active', true)->first() ?? Careers::first(), $state['careers'] ?? []);
        $this->persistSeo(WebsiteSettings::getSettings(), $state['site_defaults'] ?? []);

        Notification::make()
            ->title('Marketing settings updated.')
            ->success()
            ->send();
    }

    protected function getInitialFormState(): array
    {
        return [
            'home' => $this->seoState(Home::first()),
            'about' => $this->seoState(About::first()),
            'team' => $this->seoState(Teams::first()),
            'app' => $this->seoState(AppModel::first()),
            'services' => $this->seoState(Services::first()),
            'governance' => $this->seoState(GovernanceServices::first()),
            'wealth' => $this->seoState(WealthServices::first()),
            'investment' => $this->seoState(InvestmentServices::first()),
            'cio' => $this->seoState(CioServices::first()),
            'tools' => $this->seoState(Tools::first()),
            'resource_center' => $this->seoState(ResourceCenter::first()),
            'blog' => $this->seoState($this->pageBySlug('blog-list')),
            'case_studies' => $this->seoState($this->pageBySlug('case-studies-list')),
            'faq' => $this->seoState($this->pageBySlug('faq')),
            'request_meeting' => $this->seoState($this->pageBySlug('request-meeting')),
            'contact' => $this->seoState(ContactUs::where('is_active', true)->first() ?? ContactUs::first()),
            'appointment' => $this->seoState(AppointmentPage::first()),
            'careers' => $this->seoState(Careers::where('is_active', true)->first() ?? Careers::first()),
            'site_defaults' => $this->seoState(WebsiteSettings::getSettings()),
        ];
    }

    protected function seoState(?Model $model): array
    {
        if (! $model) {
            return [];
        }

        if (! method_exists($model, 'seoMeta')) {
            return [];
        }

        $seo = $model->seoMeta;

        if (! $seo) {
            return [];
        }

        return [
            'meta_title_en' => $seo->meta_title_en,
            'meta_title_ar' => $seo->meta_title_ar,
            'meta_description_en' => $seo->meta_description_en,
            'meta_description_ar' => $seo->meta_description_ar,
            'h1_en' => $seo->h1_en,
            'h1_ar' => $seo->h1_ar,
            'meta_keywords_en' => $seo->meta_keywords_en,
            'meta_keywords_ar' => $seo->meta_keywords_ar,
            'canonical_url' => $seo->canonical_url,
            'og_title_en' => $seo->og_title_en,
            'og_title_ar' => $seo->og_title_ar,
            'og_description_en' => $seo->og_description_en,
            'og_description_ar' => $seo->og_description_ar,
            'og_image' => $seo->og_image,
            'og_image_alt_en' => $seo->og_image_alt_en,
            'og_image_alt_ar' => $seo->og_image_alt_ar,
        ];
    }

    protected function persistSeo(?Model $model, array $state): void
    {
        if (! $model || ! method_exists($model, 'seoMeta')) {
            return;
        }

        /** @var HasSeoMeta $model */
        $seo = $model->seoMeta()->firstOrNew();

        $file = $state['og_image'] ?? null;

        if ($file instanceof TemporaryUploadedFile) {
            $seo->og_image = $file->store('seo/og', 'public');
        } elseif (is_string($file) && $file !== '') {
            $seo->og_image = $file;
        } elseif (array_key_exists('og_image', $state) && $state['og_image'] === null) {
            $seo->og_image = null;
        }

        foreach ([
            'meta_title_en',
            'meta_title_ar',
            'meta_description_en',
            'meta_description_ar',
            'h1_en',
            'h1_ar',
            'meta_keywords_en',
            'meta_keywords_ar',
            'canonical_url',
            'og_title_en',
            'og_title_ar',
            'og_description_en',
            'og_description_ar',
            'og_image_alt_en',
            'og_image_alt_ar',
        ] as $attribute) {
            if (array_key_exists($attribute, $state)) {
                $seo->{$attribute} = $state[$attribute];
            }
        }

        $seo->save();
    }

    protected function pageBySlug(string $slug): ?ContentPage
    {
        return ContentPage::query()->where('slug', $slug)->first();
    }
}


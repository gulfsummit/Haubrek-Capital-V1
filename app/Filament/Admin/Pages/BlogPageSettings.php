<?php

namespace App\Filament\Admin\Pages;

use App\Forms\Components\CustomRichEditor;
use App\Models\Page as PageModel;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BlogPageSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Blog Page';

    protected static ?string $navigationGroup = 'Page Builder';

    protected static ?int $navigationSort = 19;

    protected static ?string $title = 'Blog Page';

    protected static string $view = 'filament.admin.pages.blog-page-settings';

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
                    Forms\Components\Tabs::make('Blog Page Content')
                        ->tabs([
                            Forms\Components\Tabs\Tab::make('Main Page')
                                ->schema([
                                    Forms\Components\Section::make('Hero Images')
                                        ->schema([
                                            Forms\Components\FileUpload::make('list.hero_desktop_image')
                                                ->label('Hero Image (Desktop)')
                                                ->image()
                                                ->directory('pages/hero')
                                                ->imageEditor(),
                                            Forms\Components\TextInput::make('list.hero_desktop_image_alt_en')
                                                ->label('Desktop Image Alt (English)'),
                                            Forms\Components\TextInput::make('list.hero_desktop_image_alt_ar')
                                                ->label('Desktop Image Alt (Arabic)'),
                                            Forms\Components\FileUpload::make('list.hero_mobile_image')
                                                ->label('Hero Image (Mobile)')
                                                ->image()
                                                ->directory('pages/hero')
                                                ->imageEditor(),
                                            Forms\Components\TextInput::make('list.hero_mobile_image_alt_en')
                                                ->label('Mobile Image Alt (English)'),
                                            Forms\Components\TextInput::make('list.hero_mobile_image_alt_ar')
                                                ->label('Mobile Image Alt (Arabic)'),
                                        ])
                                        ->columns(2),
                                    Forms\Components\Section::make('Hero Copy')
                                        ->schema([
                                            Forms\Components\TextInput::make('list.title_en')
                                                ->label('Hero Title (English)')
                                                ->required(),
                                            Forms\Components\TextInput::make('list.title_ar')
                                                ->label('Hero Title (Arabic)')
                                                ->required(),
                                            CustomRichEditor::make('list.subtitle_en')
                                                ->label('Hero Subtitle (English)')
                                                ->simple(),
                                            CustomRichEditor::make('list.subtitle_ar')
                                                ->label('Hero Subtitle (Arabic)')
                                                ->simple(),
                                            Forms\Components\TextInput::make('list.primary_button_text_en')
                                                ->label('Primary Button Text (English)'),
                                            Forms\Components\TextInput::make('list.primary_button_text_ar')
                                                ->label('Primary Button Text (Arabic)'),
                                            Forms\Components\TextInput::make('list.primary_button_url')
                                                ->label('Primary Button URL')
                                                ->columnSpanFull(),
                                            Forms\Components\TextInput::make('list.secondary_button_text_en')
                                                ->label('Secondary Button Text (English)'),
                                            Forms\Components\TextInput::make('list.secondary_button_text_ar')
                                                ->label('Secondary Button Text (Arabic)'),
                                            Forms\Components\TextInput::make('list.secondary_button_url')
                                                ->label('Secondary Button URL')
                                                ->columnSpanFull(),
                                        ])
                                        ->columns(2),
                                    Forms\Components\Section::make('CTA Section')
                                        ->schema([
                                            Forms\Components\FileUpload::make('list.cta_background_image')
                                                ->label('CTA Background Image')
                                                ->image()
                                                ->directory('pages/cta')
                                                ->imageEditor(),
                                            Forms\Components\TextInput::make('list.cta_background_image_alt_en')
                                                ->label('CTA Background Alt (English)'),
                                            Forms\Components\TextInput::make('list.cta_background_image_alt_ar')
                                                ->label('CTA Background Alt (Arabic)'),
                                            Forms\Components\TextInput::make('list.cta_title_en')
                                                ->label('CTA Title (English)'),
                                            Forms\Components\TextInput::make('list.cta_title_ar')
                                                ->label('CTA Title (Arabic)'),
                                            CustomRichEditor::make('list.cta_description_en')
                                                ->label('CTA Description (English)')
                                                ->simple(),
                                            CustomRichEditor::make('list.cta_description_ar')
                                                ->label('CTA Description (Arabic)')
                                                ->simple(),
                                            Forms\Components\TextInput::make('list.cta_button_1_text_en')
                                                ->label('CTA Primary Button Text (English)'),
                                            Forms\Components\TextInput::make('list.cta_button_1_text_ar')
                                                ->label('CTA Primary Button Text (Arabic)'),
                                            Forms\Components\TextInput::make('list.cta_button_1_url')
                                                ->label('CTA Primary Button URL')
                                                ->columnSpanFull(),
                                            Forms\Components\TextInput::make('list.cta_button_2_text_en')
                                                ->label('CTA Secondary Button Text (English)'),
                                            Forms\Components\TextInput::make('list.cta_button_2_text_ar')
                                                ->label('CTA Secondary Button Text (Arabic)'),
                                            Forms\Components\TextInput::make('list.cta_button_2_url')
                                                ->label('CTA Secondary Button URL')
                                                ->columnSpanFull(),
                                        ])
                                        ->columns(2),
                                ]),
                        ]),
                ])
                ->statePath('data'),
        ];
    }

    public function submit(): void
    {
        $state = $this->form->getState();

        $this->persistPage(
            PageModel::query()->firstOrCreate(
                ['slug' => 'blog-list'],
                ['title_en' => 'BLOG', 'title_ar' => 'المدونة', 'content_en' => '', 'content_ar' => '', 'is_active' => true]
            ),
            $state['list'] ?? []
        );

        Notification::make()
            ->title('Blog page updated.')
            ->success()
            ->send();
    }

    protected function getInitialFormState(): array
    {
        return [
            'list' => $this->pageState('blog-list'),
        ];
    }

    protected function pageState(string $slug): array
    {
        $page = PageModel::query()->where('slug', $slug)->first();

        return $page?->toArray() ?? [];
    }

    protected function persistPage(PageModel $page, array $state): void
    {
        $fileDirectories = [
            'hero_desktop_image' => 'pages/hero',
            'hero_mobile_image' => 'pages/hero',
            'body_background_image' => 'pages/body',
            'cta_background_image' => 'pages/cta',
        ];

        foreach ($fileDirectories as $field => $directory) {
            if (! array_key_exists($field, $state)) {
                continue;
            }

            $value = $state[$field];

            if ($value instanceof TemporaryUploadedFile) {
                $state[$field] = $value->store($directory, 'public');
            } elseif ($value === null || is_string($value)) {
                $state[$field] = $value;
            } else {
                unset($state[$field]);
            }
        }

        $page->fill($state);
        $page->is_active = $state['is_active'] ?? $page->is_active ?? true;
        $page->save();
    }
}

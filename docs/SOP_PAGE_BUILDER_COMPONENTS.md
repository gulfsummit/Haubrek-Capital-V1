# ** STANDARD OPERATING PROCEDURE (SOP)**
# **Creating Dynamic Page Builder Components in Laravel Filament**

---

## **🎯 Overview**
This SOP outlines the complete process for creating dynamic page builder components that allow content editors to manage website content through the Filament admin panel, with real-time updates on the frontend.

---

## **📚 Prerequisites**
- Laravel project with Filament 3.x installed
- Basic understanding of Laravel MVC architecture
- Access to terminal/command line
- Database access

---

## **🔧 Phase 1: Database & Model Setup**

### **Step 1.1: Create Model**
```bash
php artisan make:model NewHome
```

### **Step 1.2: Create Migration**
```bash
php artisan make:migration create_new_homes_table
```

**Migration Structure:**
```php
public function up(): void
{
    Schema::create('new_homes', function (Blueprint $table) {
        $table->id();

        // Hero Section
        $table->string('hero_slide_1_title_en')->nullable();
        $table->string('hero_slide_1_title_ar')->nullable();
        $table->text('hero_slide_1_subtitle_en')->nullable();
        $table->text('hero_slide_1_subtitle_ar')->nullable();
        $table->string('hero_slide_1_image')->nullable();
        $table->string('hero_slide_1_button_text_en')->nullable();
        $table->string('hero_slide_1_button_text_ar')->nullable();
        $table->string('hero_slide_1_button_link')->nullable();

        // Additional slides...
        $table->string('hero_slide_2_title_en')->nullable();
        // ... repeat for slide 3

        // Content Sections
        $table->string('assist_title_en')->nullable();
        $table->string('assist_title_ar')->nullable();
        $table->longText('assist_description_en')->nullable();
        $table->longText('assist_description_ar')->nullable();
        $table->string('assist_image')->nullable();

        // Repeater Fields (JSON)
        $table->json('services')->nullable();
        $table->json('directors')->nullable();
        $table->json('track_record_metrics')->nullable();
        $table->json('roadmap_steps')->nullable();
        $table->json('insights_sections')->nullable();

        $table->timestamps();
    });
}
```

### **Step 1.3: Configure Model**
```php
// app/Models/NewHome.php
class NewHome extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_slide_1_title_en', 'hero_slide_1_title_ar',
        'hero_slide_1_subtitle_en', 'hero_slide_1_subtitle_ar',
        'hero_slide_1_image', 'hero_slide_1_button_text_en',
        'hero_slide_1_button_text_ar', 'hero_slide_1_button_link',
        // ... all other fields
    ];

    protected $casts = [
        'services' => 'array',
        'directors' => 'array',
        'track_record_metrics' => 'array',
        'roadmap_steps' => 'array',
        'insights_sections' => 'array',
    ];
}
```

### **Step 1.4: Create Seeder**
```bash
php artisan make:seeder NewHomeSeeder
```

**Seeder Content:**
```php
public function run(): void
{
    NewHome::create([
        'hero_slide_1_title_en' => 'YOUR WEALTH JOURNEY PARTNERS',
        'hero_slide_1_subtitle_en' => 'Invest smartly, grow steadily, and live confidently...',
        'hero_slide_1_button_text_en' => 'LEARN MORE',
        'hero_slide_1_button_link' => 'about-us.html#who-we-are-section',
        // ... populate all required fields with default content
    ]);
}
```

### **Step 1.5: Run Migration & Seeder**
```bash
php artisan migrate
php artisan db:seed --class=NewHomeSeeder
```

---

## **🎨 Phase 2: Filament Resource Creation**

### **Step 2.1: Create Resource**
```bash
php artisan make:filament-resource NewHome --generate
```

### **Step 2.2: Configure Resource Navigation**
```php
// app/Filament/Admin/Resources/NewHomeResource.php
class NewHomeResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Page Builder';
    protected static ?string $navigationLabel = 'New Home Page';
    protected static ?string $modelLabel = 'New Home Page';
    protected static ?string $pluralModelLabel = 'New Home Pages';
}
```

### **Step 2.3: Build Form Schema**
```php
public static function form(Form $form): Form
{
    return $form->schema([
        Tabs::make('Home Page Content')
            ->tabs([
                // Hero Section Tab
                Tabs\Tab::make('Hero Section')
                    ->schema([
                        Section::make('Slide 1')
                            ->schema([
                                TextInput::make('hero_slide_1_title_en')
                                    ->label('Title (English)')
                                    ->default('YOUR WEALTH JOURNEY PARTNERS')
                                    ->required(),
                                TextInput::make('hero_slide_1_title_ar')
                                    ->label('Title (Arabic)'),
                                Textarea::make('hero_slide_1_subtitle_en')
                                    ->label('Subtitle (English)')
                                    ->required(),
                                FileUpload::make('hero_slide_1_image')
                                    ->label('Background Image')
                                    ->directory('new-home/hero')
                                    ->image()
                                    ->imageEditor()
                                    ->required(),
                                TextInput::make('hero_slide_1_button_text_en')
                                    ->label('Button Text (English)')
                                    ->default('LEARN MORE')
                                    ->required(),
                                TextInput::make('hero_slide_1_button_link')
                                    ->label('Button Link')
                                    ->required(),
                            ])
                            ->columns(2),

                        // Repeat for slides 2 and 3
                    ]),

                // Content Sections Tabs
                Tabs\Tab::make('How We Can Assist')
                    ->schema([
                        Section::make('Section Content')
                            ->schema([
                                TextInput::make('assist_title_en')
                                    ->label('Title (English)')
                                    ->default('HOW WE CAN ASSIST')
                                    ->required(),
                                RichEditor::make('assist_description_en')
                                    ->label('Description (English)')
                                    ->required(),
                                FileUpload::make('assist_image')
                                    ->label('Section Image')
                                    ->directory('new-home/assist')
                                    ->image()
                                    ->imageEditor(),
                            ])
                            ->columns(2),

                        Section::make('Services')
                            ->schema([
                                Repeater::make('services')
                                    ->label('Services')
                                    ->schema([
                                        TextInput::make('title_en')
                                            ->label('Service Title (English)')
                                            ->required(),
                                        TextInput::make('title_ar')
                                            ->label('Service Title (Arabic)')
                                            ->required(),
                                        TextInput::make('link')
                                            ->label('Service Link'),
                                    ])
                                    ->columns(3)
                                    ->defaultItems(4)
                                    ->addActionLabel('Add Service'),
                            ]),
                    ]),

                // Additional tabs for other sections...
                Tabs\Tab::make('Diversified Programs'),
                Tabs\Tab::make('Board of Directors'),
                Tabs\Tab::make('Proven Track Record'),
                Tabs\Tab::make('Road Map'),
                Tabs\Tab::make('Insights'),
                Tabs\Tab::make('Ready To Start Growing'),
            ])
            ->columnSpanFull(),
    ]);
}
```

### **Step 2.4: Configure Table Display**
```php
public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('hero_slide_1_title_en')
                ->label('Hero Slide 1 Title')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('assist_title_en')
                ->label('Assist Title')
                ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Created')
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Updated')
                ->dateTime()
                ->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}
```

---

## **🌐 Phase 3: Frontend Integration**

### **Step 3.1: Create HTTP Resource (Optional)**
```bash
php artisan make:resource NewHomeResource
```

**Resource Content:**
```php
public function toArray($request): array
{
    return [
        'id' => $this->id,
        'hero_slide_1_title_en' => $this->hero_slide_1_title_en,
        'hero_slide_1_title_ar' => $this->hero_slide_1_title_ar,
        // ... all other fields
        'services' => $this->services,
        'directors' => $this->directors,
        'track_record_metrics' => $this->track_record_metrics,
        'roadmap_steps' => $this->roadmap_steps,
        'insights_sections' => $this->insights_sections,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
    ];
}
```

### **Step 3.2: Create Controller Method**
```php
// app/Http/Controllers/Admin/FrontendController.php
public function newHome()
{
    $homeData = NewHome::first();
    return view('homePage.newhome', [
        'homeData' => $homeData,
    ]);
}
```

### **Step 3.3: Add Route**
```php
// routes/web.php
Route::get('/', [FrontendController::class, 'newHome'])->name('new_home');
```

---

## **🎭 Phase 4: Blade Template Creation**

### **Step 4.1: Create Blade Template Structure**
```blade
{{-- resources/views/homePage/newhome.blade.php --}}
@extends('app')

@section('content')
    <!-- Hero Section -->
    <section class="bg-navy-900 text-white h-screen relative">
        <div class="relative overflow-hidden h-full">
            <div class="flex flex-col h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full" id="slider">
                    <!-- Slide 1 -->
                    <div class="w-full flex-shrink-0 relative">
                        <div class="absolute inset-0">
                            @if($homeData && $homeData->hero_slide_1_image)
                                <img src="{{ asset('storage/' . $homeData->hero_slide_1_image) }}" alt="Hero" class="w-full h-full object-cover"/>
                            @else
                                <img src="{{ asset('design/images/hero1.png') }}" alt="Hero" class="w-full h-full object-cover"/>
                            @endif
                        </div>
                        <div class="absolute inset-0 slide-overlay"></div>
                        <div class="relative h-full flex items-center justify-center">
                            <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto text-center">
                                <h1 class="text-[35px] xl:text-[70px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">
                                    {{ $homeData->hero_slide_1_title_en ?? 'YOUR WEALTH JOURNEY PARTNERS' }}
                                    @if($homeData && $homeData->hero_slide_1_title_ar)
                                        <br/>{{ $homeData->hero_slide_1_title_ar }}
                                    @endif
                                </h1>
                                <p class="mb-8 text-[17px] xl:text-[18px] text-[#FFFFFF] opacity-70 font-['Poppins'] font-regular">
                                    {{ $homeData->hero_slide_1_subtitle_en ?? 'Default subtitle...' }}
                                    @if($homeData && $homeData->hero_slide_1_subtitle_ar)
                                        <br class="hidden sm:block"/> {{ $homeData->hero_slide_1_subtitle_ar }}
                                    @endif
                                </p>
                                <a href="{{ $homeData->hero_slide_1_button_link ?? '#' }}" class="bg-[#D4AF37] px-6 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">
                                    {{ $homeData->hero_slide_1_button_text_en ?? 'LEARN MORE' }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Repeat for slides 2 and 3 -->
                </div>

                <!-- Navigation Dots and Arrows -->
            </div>
        </div>
    </section>

    <!-- Additional sections following the same pattern -->

    <!-- JavaScript Integration -->
    <script>
        // Pass home data to JavaScript
        window.homeData = @json($homeData);
    </script>
    <script src="{{ asset('js/index.js') }}"></script>
@endsection
```

### **Step 4.2: Dynamic Content Integration**
**Key Patterns to Follow:**
```blade
{{-- Text Fields --}}
{{ $homeData->field_name ?? 'Default Value' }}

{{-- Conditional Arabic Content --}}
@if($homeData && $homeData->field_name_ar)
    <br/>{{ $homeData->field_name_ar }}
@endif

{{-- Rich Text Content --}}
{!! $homeData->rich_field_name ?? 'Default content' !!}

{{-- Image Fields --}}
@if($homeData && $homeData->image_field)
    <img src="{{ asset('storage/' . $homeData->image_field) }}" alt="Image" />
@else
    <img src="{{ asset('design/images/default.png') }}" alt="Default" />
@endif

{{-- Repeater Fields --}}
@if($homeData && $homeData->repeater_field)
    @foreach($homeData->repeater_field as $index => $item)
        <div class="item">
            {{ $item['title_en'] ?? 'Default Title' }}
            @if($item['title_ar'])
                <br/>{{ $item['title_ar'] }}
            @endif
        </div>
    @endforeach
@endif
```

---

## **⚡ Phase 5: JavaScript Integration**

### **Step 5.1: Create JavaScript File**
```javascript
// public/js/index.js

// Access home data from Blade template
const homeData = window.homeData || {};

// Slider functionality
let currentSlide = 0;
const slides = document.querySelectorAll('#slider > div');
const totalSlides = slides.length;

function goToSlide(index) {
    currentSlide = index;
    const offset = -index * 100;
    document.getElementById('slider').style.transform = `translateX(${offset}%)`;

    // Update navigation dots
    updateNavigationDots(index);
}

function moveSlide(direction) {
    currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
    goToSlide(currentSlide);
}

// Auto-advance slides
setInterval(() => {
    currentSlide = (currentSlide + 1) % totalSlides;
    goToSlide(currentSlide);
}, 5000);

// Service content updates
function updateServiceContent(index) {
    const serviceContent = document.getElementById('serviceContent');
    if (!serviceContent || !homeData.services) return;

    const service = homeData.services[index] || homeData.services[0];

    serviceContent.innerHTML = `
        <div class="relative w-full h-full overflow-hidden rounded-lg">
            <img src="${service.image || 'design/images/default.png'}" alt="${service.title_en || 'Service'}" class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6">
                <h3 class="text-2xl font-neue-bold mb-3 text-white">${service.title_en || 'Service'}</h3>
                <p class="text-white text-lg mb-4 opacity-90">${service.description_en || 'Service description'}</p>
                <a href="${service.link || '#'}" class="text-[#D4AF37] font-neue-bold text-lg hover:underline">Read More</a>
            </div>
        </div>
    `;
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    if (slides.length > 0) {
        goToSlide(0);
    }

    // Initialize service content
    if (homeData.services && homeData.services.length > 0) {
        updateServiceContent(0);
    }
});
```

---

## **🔧 Phase 6: Admin Panel Setup**

### **Step 6.1: Create Admin User**
```bash
php artisan tinker
```

```php
App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password'),
    'is_admin' => 1
]);
```

### **Step 6.2: Verify Panel Configuration**
```php
// app/Providers/Filament/DashboardPanelProvider.php
public function panel(Panel $panel): Panel
{
    return $panel
        ->id('dashboard')
        ->path('dashboard')
        ->login(Login::class)
        ->colors(['primary' => Color::Amber])
        ->brandName('YOUR COMPANY')
        ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
        ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
        ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
        ->pages([Pages\Dashboard::class])
        ->widgets([Widgets\AccountWidget::class])
        ->middleware([
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
        ])
        ->authMiddleware([Authenticate::class]);
}
```

---

## **✅ Phase 7: Testing & Verification**

### **Step 7.1: Test Admin Panel Access**
1. Navigate to `http://localhost/dashboard/login`
2. Login with admin credentials
3. Verify NewHomeResource appears in navigation
4. Test create, edit, and delete operations

### **Step 7.2: Test Frontend Display**
1. Navigate to `http://localhost/`
2. Verify page loads without errors
3. Check that dynamic content displays correctly
4. Test responsive design on different devices

### **Step 7.3: Test Content Updates**
1. Edit content in admin panel
2. Save changes
3. Refresh frontend page
4. Verify changes appear immediately

---

## **📋 Checklist Summary**

- [ ] **Database**: Model, Migration, Seeder created and run
- [ ] **Filament**: Resource, Pages, Form schema configured
- [ ] **Frontend**: Controller method, Route, Blade template created
- [ ] **JavaScript**: Interactive functionality implemented
- [ ] **Admin**: User account created, Panel configured
- [ ] **Testing**: Admin panel and frontend verified working
- [ ] **Content**: Dynamic data integration completed

---

## **🚀 Result**
A fully functional dynamic page builder component that allows content editors to:
- Manage all page content through a user-friendly admin interface
- Upload and edit images with built-in image editor
- Use bilingual fields for multilingual content
- Add/remove dynamic content using repeaters
- See changes immediately on the frontend
- Maintain consistent design and functionality

---

## **📚 Additional Resources**
- [Filament Documentation](https://filamentphp.com/docs)
- [Laravel Blade Templates](https://laravel.com/docs/blade)
- [Laravel Migrations](https://laravel.com/docs/migrations)
- [Laravel Seeders](https://laravel.com/docs/seeders)

---

**Document Version**: 1.0
**Last Updated**: September 2025
**Created By**: AI Assistant
**Review Cycle**: Quarterly

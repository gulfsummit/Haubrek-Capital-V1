<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AppointmentPageResource\Pages;
use App\Filament\Forms\Components\ImageWithAlt;
use App\Filament\Support\SectionVisibility;
use App\Models\AppointmentPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AppointmentPageResource extends Resource
{
    protected static ?string $model = AppointmentPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Appointment Page';

    protected static ?string $modelLabel = 'Appointment Page';

    protected static ?string $pluralModelLabel = 'Appointment Page';

    protected static ?string $navigationGroup = 'Page Builder';

    protected static ?int $navigationSort = 16;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SectionVisibility::section([
                    'hero' => 'Hero Section',
                    'form' => 'Booking Form Section',
                    'cta' => 'Ready To Start Growing Section',
                ]),
                Forms\Components\Section::make('Hero Section')
                    ->schema([
                        Forms\Components\TextInput::make('hero_title')
                            ->label('Hero Heading (English)')
                            ->helperText('You can use HTML such as <br> to control line breaks.')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('hero_title_ar')
                            ->label('Hero Heading (Arabic)')
                            ->helperText('يمكنك استخدام HTML مثل <br> للتحكم في فواصل الأسطر.')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('hero_subtitle')
                            ->label('Hero Subheading (English)')
                            ->rows(2)
                            ->maxLength(500),
                        Forms\Components\Textarea::make('hero_subtitle_ar')
                            ->label('Hero Subheading (Arabic)')
                            ->rows(2)
                            ->maxLength(500),
                        ...ImageWithAlt::make('hero_background_desktop', 'Hero Background (Desktop)', fn ($component) => $component->directory('appointment/hero')->columnSpan(1)),
                        ...ImageWithAlt::make('hero_background_mobile', 'Hero Background (Mobile)', fn ($component) => $component->directory('appointment/hero')->columnSpan(1)),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Form Section')
                    ->schema([
                        Forms\Components\TextInput::make('information_title_en')
                            ->label('Form Heading (English)')
                            ->default('Tell us about yourself'),
                        Forms\Components\TextInput::make('information_title_ar')
                            ->label('Form Heading (Arabic)')
                            ->default('أخبرنا عن نفسك'),
                        Forms\Components\Textarea::make('information_subtitle_en')
                            ->label('Form Subheading (English)')
                            ->rows(2)
                            ->default('So our team can reach out to you on time'),
                        Forms\Components\Textarea::make('information_subtitle_ar')
                            ->label('Form Subheading (Arabic)')
                            ->rows(2)
                            ->default('حتى يتمكن فريقنا من التواصل معك في الوقت المناسب'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Progress Steps')
                    ->schema([
                        Forms\Components\TextInput::make('step_one_label_en')
                            ->label('Step 1 Label (English)')
                            ->default('Information'),
                        Forms\Components\TextInput::make('step_one_label_ar')
                            ->label('Step 1 Label (Arabic)')
                            ->default('المعلومات'),
                        Forms\Components\TextInput::make('step_two_label_en')
                            ->label('Step 2 Label (English)')
                            ->default('Date & Time'),
                        Forms\Components\TextInput::make('step_two_label_ar')
                            ->label('Step 2 Label (Arabic)')
                            ->default('التاريخ والوقت'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Information Step Fields')
                    ->schema([
                        Forms\Components\TextInput::make('full_name_label_en')
                            ->label('Full Name Label (English)')
                            ->default('Full Name*'),
                        Forms\Components\TextInput::make('full_name_label_ar')
                            ->label('Full Name Label (Arabic)')
                            ->default('الاسم الكامل*'),
                        Forms\Components\TextInput::make('full_name_placeholder_en')
                            ->label('Full Name Placeholder (English)')
                            ->default('eg: John Doe'),
                        Forms\Components\TextInput::make('full_name_placeholder_ar')
                            ->label('Full Name Placeholder (Arabic)')
                            ->default('مثال: جون دو'),
                        Forms\Components\TextInput::make('email_label_en')
                            ->label('Email Label (English)')
                            ->default('Email*'),
                        Forms\Components\TextInput::make('email_label_ar')
                            ->label('Email Label (Arabic)')
                            ->default('البريد الإلكتروني*'),
                        Forms\Components\TextInput::make('email_placeholder_en')
                            ->label('Email Placeholder (English)')
                            ->default('eg: john@email.com'),
                        Forms\Components\TextInput::make('email_placeholder_ar')
                            ->label('Email Placeholder (Arabic)')
                            ->default('مثال: john@email.com'),
                        Forms\Components\TextInput::make('company_name_label_en')
                            ->label('Company Name Label (English)')
                            ->default('Company name (Optional)'),
                        Forms\Components\TextInput::make('company_name_label_ar')
                            ->label('Company Name Label (Arabic)')
                            ->default('اسم الشركة (اختياري)'),
                        Forms\Components\TextInput::make('company_name_placeholder_en')
                            ->label('Company Name Placeholder (English)'),
                        Forms\Components\TextInput::make('company_name_placeholder_ar')
                            ->label('Company Name Placeholder (Arabic)'),
                        Forms\Components\TextInput::make('user_type_label_en')
                            ->label('User Type Label (English)')
                            ->default('Your Type*'),
                        Forms\Components\TextInput::make('user_type_label_ar')
                            ->label('User Type Label (Arabic)')
                            ->default('نوعك*'),
                        Forms\Components\TextInput::make('user_type_placeholder_en')
                            ->label('User Type Placeholder (English)')
                            ->default('Select type'),
                        Forms\Components\TextInput::make('user_type_placeholder_ar')
                            ->label('User Type Placeholder (Arabic)')
                            ->default('اختر النوع'),
                        Forms\Components\Repeater::make('user_type_options')
                            ->label('User Type Options')
                            ->schema([
                                Forms\Components\TextInput::make('value')
                                    ->label('Submitted Value')
                                    ->required(),
                                Forms\Components\TextInput::make('label_en')
                                    ->label('Label (English)')
                                    ->required(),
                                Forms\Components\TextInput::make('label_ar')
                                    ->label('Label (Arabic)')
                                    ->required(),
                            ])
                            ->default([
                                ['value' => 'Family office', 'label_en' => 'Family office', 'label_ar' => 'المكتب العائلي'],
                                ['value' => 'Individual / HNWI', 'label_en' => 'Individual / HNWI', 'label_ar' => 'فرد / عميل عالي الثروة'],
                                ['value' => 'Endowment', 'label_en' => 'Endowment', 'label_ar' => 'وقف'],
                                ['value' => 'Corporate', 'label_en' => 'Corporate', 'label_ar' => 'شركة'],
                                ['value' => 'Others', 'label_en' => 'Others', 'label_ar' => 'أخرى'],
                            ])
                            ->columns(3)
                            ->columnSpanFull()
                            ->addActionLabel('Add User Type'),
                        Forms\Components\TextInput::make('country_code_label_en')
                            ->label('Country Code Label (English)')
                            ->default('Country Code*'),
                        Forms\Components\TextInput::make('country_code_label_ar')
                            ->label('Country Code Label (Arabic)')
                            ->default('رمز الدولة*'),
                        Forms\Components\TextInput::make('phone_label_en')
                            ->label('Phone Label (English)')
                            ->default('Phone Number*'),
                        Forms\Components\TextInput::make('phone_label_ar')
                            ->label('Phone Label (Arabic)')
                            ->default('رقم الهاتف*'),
                        Forms\Components\TextInput::make('phone_placeholder_en')
                            ->label('Phone Placeholder (English)')
                            ->default('Enter phone number'),
                        Forms\Components\TextInput::make('phone_placeholder_ar')
                            ->label('Phone Placeholder (Arabic)')
                            ->default('أدخل رقم الهاتف'),
                        Forms\Components\TextInput::make('message_label_en')
                            ->label('Message Label (English)')
                            ->default('Message (Optional)'),
                        Forms\Components\TextInput::make('message_label_ar')
                            ->label('Message Label (Arabic)')
                            ->default('الرسالة (اختياري)'),
                        Forms\Components\Textarea::make('message_placeholder_en')
                            ->label('Message Placeholder (English)')
                            ->rows(2)
                            ->default('Please share anything that will help prepare for our meeting.'),
                        Forms\Components\Textarea::make('message_placeholder_ar')
                            ->label('Message Placeholder (Arabic)')
                            ->rows(2)
                            ->default('يرجى مشاركة أي شيء يساعدنا في التحضير للاجتماع.'),
                        Forms\Components\TextInput::make('continue_button_text_en')
                            ->label('Continue Button Text (English)')
                            ->default('Continue to Date & Time'),
                        Forms\Components\TextInput::make('continue_button_text_ar')
                            ->label('Continue Button Text (Arabic)')
                            ->default('المتابعة إلى التاريخ والوقت'),
                        Forms\Components\TextInput::make('validation_alert_en')
                            ->label('Validation Alert (English)')
                            ->default('Please fill in all required fields.'),
                        Forms\Components\TextInput::make('validation_alert_ar')
                            ->label('Validation Alert (Arabic)')
                            ->default('يرجى تعبئة جميع الحقول المطلوبة.'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Date & Time Step')
                    ->schema([
                        Forms\Components\TextInput::make('date_time_title_en')
                            ->label('Step 2 Heading (English)')
                            ->default('Select your preferred date & time'),
                        Forms\Components\TextInput::make('date_time_title_ar')
                            ->label('Step 2 Heading (Arabic)')
                            ->default('اختر التاريخ والوقت المناسبين'),
                        Forms\Components\Textarea::make('date_time_subtitle_en')
                            ->label('Step 2 Subheading (English)')
                            ->rows(2)
                            ->default("Choose when you'd like to have your appointment"),
                        Forms\Components\Textarea::make('date_time_subtitle_ar')
                            ->label('Step 2 Subheading (Arabic)')
                            ->rows(2)
                            ->default('اختر الوقت الذي تود عقد موعدك فيه'),
                        Forms\Components\TextInput::make('appointment_for_label_en')
                            ->label('Summary Label (English)')
                            ->default('Appointment for:'),
                        Forms\Components\TextInput::make('appointment_for_label_ar')
                            ->label('Summary Label (Arabic)')
                            ->default('الموعد لـ:'),
                        Forms\Components\TextInput::make('select_date_label_en')
                            ->label('Select Date Label (English)')
                            ->default('Select Date'),
                        Forms\Components\TextInput::make('select_date_label_ar')
                            ->label('Select Date Label (Arabic)')
                            ->default('اختر التاريخ'),
                        Forms\Components\TextInput::make('select_time_label_en')
                            ->label('Select Time Label (English)')
                            ->default('Select Time'),
                        Forms\Components\TextInput::make('select_time_label_ar')
                            ->label('Select Time Label (Arabic)')
                            ->default('اختر الوقت'),
                        Forms\Components\TextInput::make('no_date_selected_label_en')
                            ->label('No Date Selected Label (English)')
                            ->default('No date selected'),
                        Forms\Components\TextInput::make('no_date_selected_label_ar')
                            ->label('No Date Selected Label (Arabic)')
                            ->default('لم يتم اختيار تاريخ'),
                        Forms\Components\TextInput::make('selected_date_prefix_en')
                            ->label('Selected Date Prefix (English)')
                            ->default('Selected:'),
                        Forms\Components\TextInput::make('selected_date_prefix_ar')
                            ->label('Selected Date Prefix (Arabic)')
                            ->default('التاريخ المختار:'),
                        Forms\Components\TextInput::make('back_button_text_en')
                            ->label('Back Button Text (English)')
                            ->default('Back to Information'),
                        Forms\Components\TextInput::make('back_button_text_ar')
                            ->label('Back Button Text (Arabic)')
                            ->default('العودة إلى المعلومات'),
                        Forms\Components\TextInput::make('book_button_text_en')
                            ->label('Book Button Text (English)')
                            ->default('Book Appointment'),
                        Forms\Components\TextInput::make('book_button_text_ar')
                            ->label('Book Button Text (Arabic)')
                            ->default('احجز الموعد'),
                        Forms\Components\TextInput::make('no_available_time_slots_text_en')
                            ->label('No Available Slots Message (English)')
                            ->default('No available time slots for this date'),
                        Forms\Components\TextInput::make('no_available_time_slots_text_ar')
                            ->label('No Available Slots Message (Arabic)')
                            ->default('لا توجد أوقات متاحة لهذا اليوم'),
                        Forms\Components\TextInput::make('loading_time_slots_text_en')
                            ->label('Loading Slots Message (English)')
                            ->default('Loading available time slots...'),
                        Forms\Components\TextInput::make('loading_time_slots_text_ar')
                            ->label('Loading Slots Message (Arabic)')
                            ->default('جارٍ تحميل الأوقات المتاحة...'),
                        Forms\Components\TextInput::make('availability_load_error_text_en')
                            ->label('Availability Error Message (English)')
                            ->default('Unable to load available time slots. Please try again.'),
                        Forms\Components\TextInput::make('availability_load_error_text_ar')
                            ->label('Availability Error Message (Arabic)')
                            ->default('تعذر تحميل الأوقات المتاحة. حاول مرة أخرى.'),
                        Forms\Components\TextInput::make('past_date_validation_message_en')
                            ->label('Past Date Validation (English)')
                            ->default('Please select today or a future date.'),
                        Forms\Components\TextInput::make('past_date_validation_message_ar')
                            ->label('Past Date Validation (Arabic)')
                            ->default('يرجى اختيار تاريخ اليوم أو تاريخاً مستقبلياً.'),
                        Forms\Components\TextInput::make('weekend_validation_message_en')
                            ->label('Weekend Validation (English)')
                            ->default('Appointments are only available from Monday to Friday.'),
                        Forms\Components\TextInput::make('weekend_validation_message_ar')
                            ->label('Weekend Validation (Arabic)')
                            ->default('المواعيد متاحة فقط من الاثنين إلى الجمعة.'),
                        Forms\Components\TextInput::make('slot_unavailable_message_en')
                            ->label('Slot Unavailable Message (English)')
                            ->default('This appointment slot is no longer available. Please choose another time.'),
                        Forms\Components\TextInput::make('slot_unavailable_message_ar')
                            ->label('Slot Unavailable Message (Arabic)')
                            ->default('هذا الموعد لم يعد متاحاً. يرجى اختيار وقت آخر.'),
                        Forms\Components\Repeater::make('weekday_labels_en')
                            ->label('Weekday Labels (English)')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->required(),
                            ])
                            ->default([
                                ['label' => 'Sun'],
                                ['label' => 'Mon'],
                                ['label' => 'Tue'],
                                ['label' => 'Wed'],
                                ['label' => 'Thu'],
                                ['label' => 'Fri'],
                                ['label' => 'Sat'],
                            ])
                            ->columnSpanFull()
                            ->addActionLabel('Add Day'),
                        Forms\Components\Repeater::make('weekday_labels_ar')
                            ->label('Weekday Labels (Arabic)')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->label('Label')
                                    ->required(),
                            ])
                            ->default([
                                ['label' => 'الأحد'],
                                ['label' => 'الاثنين'],
                                ['label' => 'الثلاثاء'],
                                ['label' => 'الأربعاء'],
                                ['label' => 'الخميس'],
                                ['label' => 'الجمعة'],
                                ['label' => 'السبت'],
                            ])
                            ->columnSpanFull()
                            ->addActionLabel('Add Day'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Submission Messages')
                    ->schema([
                        Forms\Components\TextInput::make('success_message_en')
                            ->label('Success Message (English)')
                            ->default('Appointment booked successfully! We will contact you soon.'),
                        Forms\Components\TextInput::make('success_message_ar')
                            ->label('Success Message (Arabic)')
                            ->default('تم حجز الموعد بنجاح! سنتواصل معك قريباً.'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Ready To Start Growing Section')
                    ->schema([
                        Forms\Components\Textarea::make('ready_title')
                            ->label('Heading (English)')
                            ->rows(2)
                            ->helperText('You can use HTML such as <br> for line breaks.')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('ready_title_ar')
                            ->label('Heading (Arabic)')
                            ->rows(2)
                            ->helperText('يمكنك استخدام HTML مثل <br> للتحكم في فواصل الأسطر.')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('ready_description')
                            ->label('Subheading (English)')
                            ->rows(3)
                            ->maxLength(1000),
                        Forms\Components\Textarea::make('ready_description_ar')
                            ->label('Subheading (Arabic)')
                            ->rows(3)
                            ->maxLength(1000),
                        ...ImageWithAlt::make('ready_background_image', 'Background Image', fn ($component) => $component->directory('appointment/ready')),
                        Forms\Components\TextInput::make('ready_primary_label')
                            ->label('Primary Button Label (English)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('ready_primary_label_ar')
                            ->label('Primary Button Label (Arabic)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('ready_primary_url')
                            ->label('Primary Button URL')
                            ->helperText('You can paste a full URL or a relative path (e.g. /contact-us).')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('ready_secondary_label')
                            ->label('Secondary Button Label (English)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('ready_secondary_label_ar')
                            ->label('Secondary Button Label (Arabic)')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('ready_secondary_url')
                            ->label('Secondary Button URL')
                            ->helperText('You can paste a full URL or a relative path (e.g. /request-meeting).')
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title')
                    ->label('Hero Title')
                    ->wrap(),
                Tables\Columns\TextColumn::make('ready_title')
                    ->label('Ready Title')
                    ->wrap(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn ($record): string => static::getUrl('edit', ['record' => $record])),
            ])
            ->bulkActions([
                //
            ])
            ->defaultSort('id');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointmentPages::route('/'),
            'edit' => Pages\EditAppointmentPage::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }
}


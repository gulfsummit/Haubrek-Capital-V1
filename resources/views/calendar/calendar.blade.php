
@extends('app')

@section('content')
@php
    $isArabic = app()->getLocale() === 'ar';
    $localize = $localize ?? function ($en, $ar) use ($isArabic) {
        return $isArabic ? ($ar ?: $en) : ($en ?: $ar);
    };
    $heroDesktop = $appointmentPage?->hero_background_desktop
        ? asset('storage/' . $appointmentPage->hero_background_desktop)
        : asset('design/images/request-a-meeting-hero.png');
    $heroMobile = $appointmentPage?->hero_background_mobile
        ? asset('storage/' . $appointmentPage->hero_background_mobile)
        : asset('design/images/request-a-meeting-hero.png');
    $heroDesktopAlt = $localize($appointmentPage?->hero_background_desktop_alt_en, $appointmentPage?->hero_background_desktop_alt_ar) ?: 'Appointment hero';
    $heroMobileAlt = $localize($appointmentPage?->hero_background_mobile_alt_en, $appointmentPage?->hero_background_mobile_alt_ar) ?: $heroDesktopAlt;
    $readyBackground = $appointmentPage?->ready_background_image
        ? asset('storage/' . $appointmentPage->ready_background_image)
        : asset('design/images/meeting-bg.png');
    $heroTitle = $localize($appointmentPage?->hero_title, $appointmentPage?->hero_title_ar)
        ?: (isset($seoMeta) ? $localize($seoMeta->h1_en ?? null, $seoMeta->h1_ar ?? null) : null)
        ?: 'BOOK YOUR PLATINUM<br> SESSION';
    $heroSubtitle = $localize($appointmentPage?->hero_subtitle, $appointmentPage?->hero_subtitle_ar) ?: 'Your Path to Financial Success';
    $readyTitle = $localize($appointmentPage?->ready_title, $appointmentPage?->ready_title_ar) ?: "READY TO<br/>START GROWING?!";
    $readyDescription = $localize($appointmentPage?->ready_description, $appointmentPage?->ready_description_ar) ?: 'Unlock the full potential of your wealth';
    $readyPrimaryLabel = $localize($appointmentPage?->ready_primary_label, $appointmentPage?->ready_primary_label_ar) ?: 'JOIN OUR MAILING LIST';
    $readyPrimaryUrl = $appointmentPage?->ready_primary_url ?: route('contact-us');
    $readySecondaryLabel = $localize($appointmentPage?->ready_secondary_label, $appointmentPage?->ready_secondary_label_ar) ?: 'REQUEST A MEETING';
    $readySecondaryUrl = $appointmentPage?->ready_secondary_url ?: route('request-meeting');
    $readyBackgroundAlt = $localize($appointmentPage?->ready_background_image_alt_en, $appointmentPage?->ready_background_image_alt_ar) ?: strip_tags($readyTitle);

    $normalizeLink = function ($url) {
        if (empty($url)) {
            return '#';
        }

        if (\Illuminate\Support\Str::startsWith($url, ['http://', 'https://', 'mailto:', 'tel:', '#'])) {
            return $url;
        }

        return url($url);
    };

    $readyPrimaryUrl = $normalizeLink($readyPrimaryUrl);
    $readySecondaryUrl = $normalizeLink($readySecondaryUrl);
    $stepOneLabel = $localize($appointmentPage?->step_one_label_en, $appointmentPage?->step_one_label_ar) ?: 'Information';
    $stepTwoLabel = $localize($appointmentPage?->step_two_label_en, $appointmentPage?->step_two_label_ar) ?: 'Date & Time';
    $informationTitle = $localize($appointmentPage?->information_title_en, $appointmentPage?->information_title_ar) ?: 'Tell us about yourself';
    $informationSubtitle = $localize($appointmentPage?->information_subtitle_en, $appointmentPage?->information_subtitle_ar) ?: 'So our team can reach out to you on time';
    $dateTimeTitle = $localize($appointmentPage?->date_time_title_en, $appointmentPage?->date_time_title_ar) ?: 'Select your preferred date & time';
    $dateTimeSubtitle = $localize($appointmentPage?->date_time_subtitle_en, $appointmentPage?->date_time_subtitle_ar) ?: "Choose when you'd like to have your appointment";
    $appointmentForLabel = $localize($appointmentPage?->appointment_for_label_en, $appointmentPage?->appointment_for_label_ar) ?: 'Appointment for:';
    $selectDateLabel = $localize($appointmentPage?->select_date_label_en, $appointmentPage?->select_date_label_ar) ?: 'Select Date';
    $selectTimeLabel = $localize($appointmentPage?->select_time_label_en, $appointmentPage?->select_time_label_ar) ?: 'Select Time';
    $noDateSelectedLabel = $localize($appointmentPage?->no_date_selected_label_en, $appointmentPage?->no_date_selected_label_ar) ?: 'No date selected';
    $fullNameLabel = $localize($appointmentPage?->full_name_label_en, $appointmentPage?->full_name_label_ar) ?: 'Full Name*';
    $fullNamePlaceholder = $localize($appointmentPage?->full_name_placeholder_en, $appointmentPage?->full_name_placeholder_ar) ?: 'eg: John Doe';
    $emailLabel = $localize($appointmentPage?->email_label_en, $appointmentPage?->email_label_ar) ?: 'Email*';
    $emailPlaceholder = $localize($appointmentPage?->email_placeholder_en, $appointmentPage?->email_placeholder_ar) ?: 'eg: john@email.com';
    $companyNameLabel = $localize($appointmentPage?->company_name_label_en, $appointmentPage?->company_name_label_ar) ?: 'Company name (Optional)';
    $companyNamePlaceholder = $localize($appointmentPage?->company_name_placeholder_en, $appointmentPage?->company_name_placeholder_ar) ?: '';
    $userTypeLabel = $localize($appointmentPage?->user_type_label_en, $appointmentPage?->user_type_label_ar) ?: 'Your Type*';
    $userTypePlaceholder = $localize($appointmentPage?->user_type_placeholder_en, $appointmentPage?->user_type_placeholder_ar) ?: 'Select type';
    $countryCodeLabel = $localize($appointmentPage?->country_code_label_en, $appointmentPage?->country_code_label_ar) ?: 'Country Code*';
    $phoneLabel = $localize($appointmentPage?->phone_label_en, $appointmentPage?->phone_label_ar) ?: 'Phone Number*';
    $phonePlaceholder = $localize($appointmentPage?->phone_placeholder_en, $appointmentPage?->phone_placeholder_ar) ?: 'Enter phone number';
    $messageLabel = $localize($appointmentPage?->message_label_en, $appointmentPage?->message_label_ar) ?: 'Message (Optional)';
    $messagePlaceholder = $localize($appointmentPage?->message_placeholder_en, $appointmentPage?->message_placeholder_ar) ?: 'Please share anything that will help prepare for our meeting.';
    $continueButtonText = $localize($appointmentPage?->continue_button_text_en, $appointmentPage?->continue_button_text_ar) ?: 'Continue to Date & Time';
    $backButtonText = $localize($appointmentPage?->back_button_text_en, $appointmentPage?->back_button_text_ar) ?: 'Back to Information';
    $bookButtonText = $localize($appointmentPage?->book_button_text_en, $appointmentPage?->book_button_text_ar) ?: 'Book Appointment';
    $validationAlertText = $localize($appointmentPage?->validation_alert_en, $appointmentPage?->validation_alert_ar) ?: 'Please fill in all required fields.';
    $userTypeOptions = $appointmentPage?->user_type_options ?: [
        ['value' => 'Family office', 'label_en' => 'Family office', 'label_ar' => 'المكتب العائلي'],
        ['value' => 'Individual / HNWI', 'label_en' => 'Individual / HNWI', 'label_ar' => 'فرد / عميل عالي الثروة'],
        ['value' => 'Endowment', 'label_en' => 'Endowment', 'label_ar' => 'وقف'],
        ['value' => 'Corporate', 'label_en' => 'Corporate', 'label_ar' => 'شركة'],
        ['value' => 'Others', 'label_en' => 'Others', 'label_ar' => 'أخرى'],
    ];
    $weekdayLabels = collect($isArabic ? ($appointmentPage?->weekday_labels_ar ?: []) : ($appointmentPage?->weekday_labels_en ?: []))
        ->pluck('label')
        ->filter()
        ->values()
        ->all();
    if (count($weekdayLabels) !== 7) {
        $weekdayLabels = $isArabic ? ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'] : ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    }
    $selectedDatePrefix = $localize($appointmentPage?->selected_date_prefix_en, $appointmentPage?->selected_date_prefix_ar) ?: ($isArabic ? 'التاريخ المختار:' : 'Selected:');
    $noAvailableTimeSlotsText = $localize($appointmentPage?->no_available_time_slots_text_en, $appointmentPage?->no_available_time_slots_text_ar) ?: ($isArabic ? 'لا توجد أوقات متاحة لهذا اليوم' : 'No available time slots for this date');
    $loadingTimeSlotsText = $localize($appointmentPage?->loading_time_slots_text_en, $appointmentPage?->loading_time_slots_text_ar) ?: ($isArabic ? 'جارٍ تحميل الأوقات المتاحة...' : 'Loading available time slots...');
    $availabilityLoadErrorText = $localize($appointmentPage?->availability_load_error_text_en, $appointmentPage?->availability_load_error_text_ar) ?: ($isArabic ? 'تعذر تحميل الأوقات المتاحة. حاول مرة أخرى.' : 'Unable to load available time slots. Please try again.');
    $fieldLabelAlignment = $isArabic ? 'text-right' : 'text-left';
    $fieldInputAlignment = $isArabic ? 'text-right placeholder:text-right' : 'text-left placeholder:text-left';
    $fieldDirection = $isArabic ? 'rtl' : 'ltr';
    $selectIconPositionClass = $isArabic ? 'left-0 pl-2' : 'right-0 pr-2';
    $selectPaddingClass = $isArabic ? 'pl-8 pr-3' : 'pr-8 pl-3';
    $stepOneOrderClass = $isArabic ? 'order-3' : 'order-1';
    $stepperLineOrderClass = 'order-2';
    $stepTwoOrderClass = $isArabic ? 'order-1' : 'order-3';
@endphp

@if($appointmentPage?->isSectionVisible('hero') ?? true)
<section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
        <div class="relative overflow-hidden h-full">
            <div class="flex flex-col h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full">
                    <div class="w-full flex-shrink-0 relative">
                        <!-- Desktop background -->
                        <div class="absolute inset-0 hidden md:block">
                    <img loading="lazy" src="{{ $heroDesktop }}" alt="{{ $heroDesktopAlt }}" class="w-full h-full object-cover"/>
                        </div>
                        <!-- Mobile background -->
                        <div class="absolute inset-0 block md:hidden">
                    <img loading="lazy" src="{{ $heroMobile }}" alt="{{ $heroMobileAlt }}" class="w-full h-full object-cover"/>
                        </div>
                        <div class="absolute inset-0 "></div>
                        <div class="relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                            <div class="container mx-auto text-center">
                                <h1 class="text-[45px] xl:text-[78px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">{!! $heroTitle !!}</h1>
                                <div class="font-['Poppins'] text-[18px] text-white"><p>{{ $heroSubtitle }}</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

    @if($appointmentPage?->isSectionVisible('form') ?? true)
    <!-- Appointment Booking Section -->
    <section class="bg-[#0A1733] py-12">
        <div class="container mx-auto flex justify-center items-start max-w-4xl w-full px-4">

            <!-- Multi-step Form Container -->
            <div class="bg-white rounded-2xl shadow-xl p-10 w-full max-w-4xl mx-auto">
                <!-- Progress Steps -->
                <div class="flex items-center justify-center mb-12">
                    <div class="flex items-center w-full max-w-md">
                        <!-- Step 1 -->
                        <div class="flex flex-col items-center text-[#D4AF37] {{ $stepOneOrderClass }}" id="step1-indicator">
                            <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 flex items-center justify-center border-2 border-[#D4AF37] bg-[#D4AF37] text-white">
                                <span class="text-sm font-bold">1</span>
                            </div>
                            <div class="text-xs font-medium uppercase text-[#D4AF37] mt-2 text-center">{{ $stepOneLabel }}</div>
                        </div>

                        <!-- Progress Line -->
                        <div class="flex-1 border-t-2 transition duration-500 ease-in-out border-gray-300 mx-4 {{ $stepperLineOrderClass }}" id="progress-line"></div>

                        <!-- Step 2 -->
                        <div class="flex flex-col items-center text-gray-500 {{ $stepTwoOrderClass }}" id="step2-indicator">
                            <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 flex items-center justify-center border-2 border-gray-300 text-gray-500">
                                <span class="text-sm font-bold">2</span>
                            </div>
                            <div class="text-xs font-medium uppercase text-gray-500 mt-2 text-center">{{ $stepTwoLabel }}</div>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Step 1: Information Form -->
                <div id="step1" class="step-content">
                    <h2 class="text-2xl font-neue-extrabold mb-2 text-[#0A1733] text-center">{{ $informationTitle }}</h2>
                    <div class="text-gray-500 mb-6 text-sm text-center"><p>{{ $informationSubtitle }}</p></div>

                    <form id="info-form" class="space-y-4" dir="{{ $fieldDirection }}">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-700 mb-1 {{ $fieldLabelAlignment }}">{{ $fullNameLabel }}</label>
                                <input type="text" id="full_name" value="{{ old('full_name') }}" dir="{{ $fieldDirection }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] {{ $fieldInputAlignment }}" placeholder="{{ $fullNamePlaceholder }}" required>
                            </div>
                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-700 mb-1 {{ $fieldLabelAlignment }}">{{ $emailLabel }}</label>
                                <input type="email" id="email" value="{{ old('email') }}" dir="{{ $fieldDirection }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] {{ $fieldInputAlignment }}" placeholder="{{ $emailPlaceholder }}" required>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-700 mb-1 {{ $fieldLabelAlignment }}">{{ $companyNameLabel }}</label>
                                <input type="text" id="company_name" value="{{ old('company_name') }}" dir="{{ $fieldDirection }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] {{ $fieldInputAlignment }}" placeholder="{{ $companyNamePlaceholder }}">
                            </div>
                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-700 mb-1 {{ $fieldLabelAlignment }}">{{ $userTypeLabel }}</label>
                                <div class="relative">
                                    <select id="user_type" dir="{{ $fieldDirection }}" class="w-full border rounded-lg py-2 bg-white text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-[#D4AF37] {{ $fieldInputAlignment }} {{ $selectPaddingClass }}" required>
                                        <option value="">{{ $userTypePlaceholder }}</option>
                                        @foreach($userTypeOptions as $option)
                                            @php
                                                $userTypeLabelValue = $localize($option['label_en'] ?? null, $option['label_ar'] ?? null) ?: ($option['value'] ?? '');
                                            @endphp
                                            <option value="{{ $option['value'] }}" {{ old('user_type') == ($option['value'] ?? null) ? 'selected' : '' }}>{{ $userTypeLabelValue }}</option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 flex items-center text-gray-700 {{ $selectIconPositionClass }}">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="w-full md:w-1/2">
                                <label class="block text-sm font-medium text-gray-700 mb-1 {{ $fieldLabelAlignment }}">{{ $countryCodeLabel }}</label>
                                <div class="relative">
                                    <select id="country_code" dir="{{ $fieldDirection }}" class="w-full border rounded-lg py-2 bg-white text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-[#D4AF37] {{ $fieldInputAlignment }} {{ $selectPaddingClass }}">
                                        @php
                                            $countryCodePath = resource_path('views/calendar/country-codes.json');
                                            $countryCodeContent = file_get_contents($countryCodePath);

                                            if ($countryCodeContent !== false) {
                                                $countries = json_decode($countryCodeContent, true);
                                                if (is_array($countries)) {
                                                    // Sort countries alphabetically by name
                                                    usort($countries, function($a, $b) {
                                                        return strcmp($a['name'], $b['name']);
                                                    });
                                                } else {
                                                    $countries = [];
                                                }
                                            } else {
                                                $countries = [];
                                            }
                                        @endphp
                                        @foreach($countries as $country)
                                            <option value="{{ $country['dial_code'] }}"
                                                    data-country="{{ $country['code'] }}"
                                                    data-placeholder="{{ $phonePlaceholder }}"
                                                    data-pattern="##########"
                                                    {{ (old('country_code') == $country['dial_code'] || (empty(old('country_code')) && $country['code'] == 'AE')) ? 'selected' : '' }}>
                                                {{ $country['name'] }} {{ $country['dial_code'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 flex items-center text-gray-700 {{ $selectIconPositionClass }}">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <label class="block text-sm font-medium text-gray-700 mb-1 {{ $fieldLabelAlignment }}">{{ $phoneLabel }}</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" dir="{{ $fieldDirection }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] {{ $fieldInputAlignment }}" placeholder="{{ $phonePlaceholder }}" data-pattern="" required>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-700 mb-1 {{ $fieldLabelAlignment }}">{{ $messageLabel }}</label>
                                <textarea id="message" dir="{{ $fieldDirection }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#D4AF37] {{ $fieldInputAlignment }}" rows="3" placeholder="{{ $messagePlaceholder }}">{{ old('message') }}</textarea>
                            </div>
                        </div>
                        <div class="flex justify-center mt-6">
                            <button type="button" id="nextToCalendar" class="bg-[#D4AF37] text-white font-bold py-3 px-8 rounded-lg hover:bg-[#bfa14e] transition flex items-center justify-center">
                                {{ $continueButtonText }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Step 2: Calendar and Time Selection -->
                <div id="step2" class="step-content hidden">
                    <h2 class="text-2xl font-neue-extrabold mb-2 text-[#0A1733] text-center">{{ $dateTimeTitle }}</h2>
                    <div class="text-gray-500 mb-6 text-sm text-center"><p>{{ $dateTimeSubtitle }}</p></div>

                    <!-- User Info Summary -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h3 class="font-medium text-gray-700 mb-2">{{ $appointmentForLabel }}</h3>
                        <div class="text-sm text-gray-600" id="userSummary"></div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-4xl mx-auto">
                        <!-- Calendar -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 shadow-sm border border-gray-200" id="calendar-section">
                            <h3 class="text-lg font-bold text-[#0A1733] mb-4 text-center">{{ $selectDateLabel }}</h3>
                            <div class="flex justify-between items-center mb-4">
                                <button type="button" id="prevMonth" class="p-2 rounded-full hover:bg-white hover:shadow-md transition-all text-gray-400 hover:text-[#D4AF37]">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <span id="calendarMonth" class="font-bold text-lg text-[#0A1733]"></span>
                                <button type="button" id="nextMonth" class="p-2 rounded-full hover:bg-white hover:shadow-md transition-all text-gray-400 hover:text-[#D4AF37]">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                            <div class="grid grid-cols-7 gap-1 text-center text-xs text-gray-500 mb-2 font-medium">
                                @foreach($weekdayLabels as $weekdayLabel)
                                    <span>{{ $weekdayLabel }}</span>
                                @endforeach
                            </div>
                            <div id="calendarDays" class="grid grid-cols-7 gap-1 text-center text-sm"></div>
                            <div class="mt-4 flex items-center justify-center gap-2 text-gray-600">
                                <i class="fas fa-globe text-[#D4AF37]"></i>
                                <span class="text-xs" id="timezone"></span>
                            </div>
                            <div class="mt-2 text-center">
                                <span class="text-sm text-[#D4AF37] font-medium" id="selected-date-display">{{ $noDateSelectedLabel }}</span>
                            </div>
                        </div>

                        <!-- Time Slots -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 shadow-sm border border-gray-200" id="time-section">
                            <h3 class="text-lg font-bold text-[#0A1733] mb-4 text-center">{{ $selectTimeLabel }}</h3>
                            <div class="max-h-[400px] overflow-y-auto">
                                <div id="timeSlots" class="grid grid-cols-2 gap-2 pr-2">
                                    <!-- Time slots will be populated by JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-end gap-6 mt-8">
                        <button type="button" id="backToInfo" class="w-[260px] whitespace-nowrap bg-gray-500 text-white font-bold py-3 px-8 rounded-lg hover:bg-gray-600 transition flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            {{ $backButtonText }}
                        </button>

                        <!-- Final Form Submission -->
                        <form method="POST" action="{{ route('appointment.submit') }}" id="final-form" class="flex flex-col items-end">
                            @csrf
                            <input type="hidden" name="full_name" id="final_full_name">
                            <input type="hidden" name="email" id="final_email">
                            <input type="hidden" name="phone" id="final_phone">
                            <input type="hidden" name="company_name" id="final_company_name">
                            <input type="hidden" name="user_type" id="final_user_type">
                            <input type="hidden" name="message" id="final_message">
                            <input type="hidden" name="selected_date" id="selected_date" value="{{ old('selected_date') }}">
                            <input type="hidden" name="selected_time" id="selected_time" value="{{ old('selected_time') }}">

                            <div class="flex justify-center mt-6 mb-6">
                                <x-recaptcha action="appointment_booking" />
                            </div>

                            <button type="submit" id="bookAppointment" class="w-[260px] whitespace-nowrap bg-[#D4AF37] text-white font-bold py-3 px-8 rounded-lg hover:bg-[#bfa14e] transition flex items-center justify-center" disabled>
                                {{ $bookButtonText }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Global function to check if booking is ready
                            window.checkBookingReady = function() {
                                const selectedDate = document.getElementById('selected_date').value;
                                const selectedTime = document.getElementById('selected_time').value;
                                const bookAppointmentBtn = document.getElementById('bookAppointment');

                                if (selectedDate && selectedTime) {
                                    bookAppointmentBtn.disabled = false;
                                    bookAppointmentBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                                } else {
                                    bookAppointmentBtn.disabled = true;
                                    bookAppointmentBtn.classList.add('opacity-50', 'cursor-not-allowed');
                                }
                            };

                            // Multi-step form navigation
                            const step1 = document.getElementById('step1');
                            const step2 = document.getElementById('step2');
                            const nextToCalendarBtn = document.getElementById('nextToCalendar');
                            const backToInfoBtn = document.getElementById('backToInfo');
                            const bookAppointmentBtn = document.getElementById('bookAppointment');
                            const progressLine = document.getElementById('progress-line');
                            const step1Indicator = document.getElementById('step1-indicator');
                            const step2Indicator = document.getElementById('step2-indicator');
                            const userSummary = document.getElementById('userSummary');

                            // Form validation for step 1
                            function validateStep1() {
                                const requiredFields = ['full_name', 'user_type', 'email', 'phone'];
                                let isValid = true;

                                requiredFields.forEach(fieldId => {
                                    const field = document.getElementById(fieldId);
                                    if (!field.value.trim()) {
                                        field.classList.add('border-red-500');
                                        isValid = false;
                                    } else {
                                        field.classList.remove('border-red-500');
                                    }
                                });

                                return isValid;
                            }

                            // Move to step 2
                            nextToCalendarBtn.addEventListener('click', function() {
                                if (validateStep1()) {
                                    // Update progress indicator
                                    progressLine.classList.remove('border-gray-300');
                                    progressLine.classList.add('border-[#D4AF37]');
                                    step2Indicator.classList.remove('text-gray-500');
                                    step2Indicator.classList.add('text-[#D4AF37]');
                                    const step2Circle = step2Indicator.querySelector('div:first-child');
                                    step2Circle.classList.remove('border-gray-300', 'text-gray-500');
                                    step2Circle.classList.add('border-[#D4AF37]', 'bg-[#D4AF37]', 'text-white');
                                    const step2Label = step2Indicator.querySelector('div:last-child');
                                    step2Label.classList.remove('text-gray-500');
                                    step2Label.classList.add('text-[#D4AF37]');

                                    // Show step 2, hide step 1
                                    step1.classList.add('hidden');
                                    step2.classList.remove('hidden');

                                    // Update user summary
                                    const fullName = document.getElementById('full_name').value;
                                    const email = document.getElementById('email').value;
                                    const userType = document.getElementById('user_type').value;
                                    const company = document.getElementById('company_name').value;

                                    userSummary.innerHTML = `
                                        <strong>${fullName}</strong> (${userType})<br>
                                        ${email}<br>
                                        ${company}
                                    `;

                                    // Copy form data to hidden inputs
                                    document.getElementById('final_full_name').value = fullName;
                                    document.getElementById('final_email').value = email;
                                    document.getElementById('final_user_type').value = userType;
                                    document.getElementById('final_company_name').value = company;

                                    // Combine country code and phone number, removing formatting
                                    const countryCode = document.getElementById('country_code').value;
                                    const phoneNumber = document.getElementById('phone').value.replace(/\D/g, ''); // Remove all non-digits
                                    document.getElementById('final_phone').value = countryCode + phoneNumber;

                                    document.getElementById('final_message').value = document.getElementById('message').value;
                                } else {
                                    alert(@js($validationAlertText));
                                }
                            });

                            // Move back to step 1
                            backToInfoBtn.addEventListener('click', function() {
                                // Update progress indicator
                                progressLine.classList.add('border-gray-300');
                                progressLine.classList.remove('border-[#D4AF37]');
                                step2Indicator.classList.add('text-gray-500');
                                step2Indicator.classList.remove('text-[#D4AF37]');
                                const step2Circle = step2Indicator.querySelector('div:first-child');
                                step2Circle.classList.add('border-gray-300', 'text-gray-500');
                                step2Circle.classList.remove('border-[#D4AF37]', 'bg-[#D4AF37]', 'text-white');
                                const step2Label = step2Indicator.querySelector('div:last-child');
                                step2Label.classList.add('text-gray-500');
                                step2Label.classList.remove('text-[#D4AF37]');

                                // Show step 1, hide step 2
                                step2.classList.add('hidden');
                                step1.classList.remove('hidden');
                            });


                            // Initialize booking button state
                            bookAppointmentBtn.classList.add('opacity-50', 'cursor-not-allowed');

                            // Dynamic phone number functionality
                            const countrySelect = document.getElementById('country_code');
                            const phoneInput = document.getElementById('phone');

                            if (countrySelect && phoneInput) {
                                // Initialize country display and phone formatting on page load
                                function updatePhoneFormat() {
                                    const selectedOption = countrySelect.options[countrySelect.selectedIndex];
                                    const placeholder = selectedOption.getAttribute('data-placeholder');
                                    const pattern = selectedOption.getAttribute('data-pattern');

                                    // Update phone input placeholder
                                    if (placeholder) {
                                        phoneInput.placeholder = placeholder;
                                    }

                                    // Store pattern for formatting
                                    phoneInput.setAttribute('data-pattern', pattern || '');

                                    // Set default placeholder if none specified
                                    if (!placeholder) {
                                        phoneInput.placeholder = @js($phonePlaceholder);
                                    }
                                }

                                // Phone number formatting function
                                function formatPhoneNumber(value, pattern) {
                                    if (!pattern) return value;

                                    // Remove all non-numeric characters
                                    const numbers = value.replace(/\D/g, '');

                                    // Apply pattern
                                    let formatted = '';
                                    let numberIndex = 0;

                                    for (let i = 0; i < pattern.length && numberIndex < numbers.length; i++) {
                                        if (pattern[i] === '#') {
                                            formatted += numbers[numberIndex];
                                            numberIndex++;
                                        } else {
                                            formatted += pattern[i];
                                        }
                                    }

                                    return formatted;
                                }

                                // Add input event listener for real-time formatting and validation
                                phoneInput.addEventListener('input', function(e) {
                                    const pattern = this.getAttribute('data-pattern');
                                    if (pattern) {
                                        const cursorPosition = this.selectionStart;
                                        const oldValue = this.value;
                                        const newValue = formatPhoneNumber(this.value, pattern);

                                        this.value = newValue;

                                        // Adjust cursor position
                                        if (newValue.length > oldValue.length) {
                                            this.setSelectionRange(cursorPosition + 1, cursorPosition + 1);
                                        } else {
                                            this.setSelectionRange(cursorPosition, cursorPosition);
                                        }
                                    }

                                    // Validate phone number format
                                    validatePhoneNumber(this);
                                });

                                // Phone number validation function
                                function validatePhoneNumber(input) {
                                    const selectedCountry = countrySelect.value;
                                    const countryCode = countrySelect.options[countrySelect.selectedIndex].getAttribute('data-country');

                                    // Get validation rules based on country
                                    const validationRules = getPhoneValidationRules(countryCode);
                                    const isValid = validationRules.regex.test(input.value);

                                    if (input.value && !isValid) {
                                        input.setCustomValidity(validationRules.message);
                                        input.classList.add('border-red-500');
                                        input.classList.remove('border-gray-300');
                                    } else {
                                        input.setCustomValidity('');
                                        input.classList.remove('border-red-500');
                                        input.classList.add('border-gray-300');
                                    }
                                }

                                // Get phone validation rules based on country code
                                function getPhoneValidationRules(countryCode) {
                                    const rules = {
                                        'EG': { // Egypt
                                            regex: /^[0-9]{10,11}$/,
                                            message: 'Please enter a valid Egyptian phone number (10-11 digits)'
                                        },
                                        'AE': { // UAE
                                            regex: /^[0-9]{9,10}$/,
                                            message: 'Please enter a valid UAE phone number (9-10 digits)'
                                        },
                                        'SA': { // Saudi Arabia
                                            regex: /^[0-9]{9,10}$/,
                                            message: 'Please enter a valid Saudi phone number (9-10 digits)'
                                        },
                                        'US': { // United States
                                            regex: /^[0-9]{10}$/,
                                            message: 'Please enter a valid US phone number (10 digits)'
                                        },
                                        'GB': { // United Kingdom
                                            regex: /^[0-9]{10,11}$/,
                                            message: 'Please enter a valid UK phone number (10-11 digits)'
                                        },
                                        'IN': { // India
                                            regex: /^[0-9]{10}$/,
                                            message: 'Please enter a valid Indian phone number (10 digits)'
                                        },
                                        'DE': { // Germany
                                            regex: /^[0-9]{10,12}$/,
                                            message: 'Please enter a valid German phone number (10-12 digits)'
                                        },
                                        'FR': { // France
                                            regex: /^[0-9]{10}$/,
                                            message: 'Please enter a valid French phone number (10 digits)'
                                        },
                                        'CA': { // Canada
                                            regex: /^[0-9]{10}$/,
                                            message: 'Please enter a valid Canadian phone number (10 digits)'
                                        },
                                        'AU': { // Australia
                                            regex: /^[0-9]{9,10}$/,
                                            message: 'Please enter a valid Australian phone number (9-10 digits)'
                                        }
                                    };

                                    // Default validation for other countries
                                    return rules[countryCode] || {
                                        regex: /^[0-9+\-\s\(\)]{7,20}$/,
                                        message: 'Please enter a valid phone number (7-20 digits)'
                                    };
                                }

                                // Add keydown event listener for better UX
                                phoneInput.addEventListener('keydown', function(e) {
                                    // Allow backspace, delete, tab, escape, enter
                                    if ([8, 9, 27, 13, 46].indexOf(e.keyCode) !== -1 ||
                                        // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                                        (e.keyCode === 65 && e.ctrlKey === true) ||
                                        (e.keyCode === 67 && e.ctrlKey === true) ||
                                        (e.keyCode === 86 && e.ctrlKey === true) ||
                                        (e.keyCode === 88 && e.ctrlKey === true) ||
                                        // Allow home, end, left, right
                                        (e.keyCode >= 35 && e.keyCode <= 39)) {
                                        return;
                                    }
                                    // Ensure that it is a number and stop the keypress
                                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                        e.preventDefault();
                                    }
                                });

                                // Set initial phone format
                                updatePhoneFormat();

                                // Update phone format when country selection changes
                                countrySelect.addEventListener('change', function() {
                                    updatePhoneFormat();
                                    // Clear the phone input when country changes
                                    phoneInput.value = '';
                                    // Re-validate the phone input with new country rules
                                    validatePhoneNumber(phoneInput);
                                });
                            }
                            const timeSlots = document.getElementById('timeSlots');
                            const selectedTimeInput = document.getElementById('selected_time');
                            const availabilityEndpoint = @js($appointmentAvailabilityUrl);
                            const noAvailableTimeSlotsText = @js($noAvailableTimeSlotsText);
                            const loadingTimeSlotsText = @js($loadingTimeSlotsText);
                            const availabilityLoadErrorText = @js($availabilityLoadErrorText);

                            function normalizeTimeValue(value) {
                                return (value || '').toLowerCase().replace(/\s+/g, '');
                            }

                            function formatTimeLabel(value) {
                                const match = normalizeTimeValue(value).match(/^(\d{1,2}):(\d{2})(am|pm)$/);

                                if (!match) {
                                    return value;
                                }

                                return `${match[1]}:${match[2]} ${match[3].toUpperCase()}`;
                            }

                            function setNoSlotsMessage(message) {
                                timeSlots.innerHTML = '';
                                const noSlotsMsg = document.createElement('div');
                                noSlotsMsg.className = 'col-span-2 text-center text-gray-500 py-4';
                                noSlotsMsg.textContent = message;
                                timeSlots.appendChild(noSlotsMsg);
                            }

                            async function fetchAvailability(date) {
                                const response = await fetch(`${availabilityEndpoint}?date=${encodeURIComponent(date)}`, {
                                    cache: 'no-store',
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'application/json',
                                    },
                                });

                                if (!response.ok) {
                                    throw new Error('Unable to load appointment availability.');
                                }

                                return response.json();
                            }

                            // Function to generate time slots based on selected date
                            window.generateTimeSlots = async function() {
                                const selectedDate = document.getElementById('selected_date').value;

                                if (!selectedDate) {
                                    selectedTimeInput.value = '';
                                    setNoSlotsMessage(noAvailableTimeSlotsText);
                                    if (window.checkBookingReady) window.checkBookingReady();
                                    return;
                                }

                                setNoSlotsMessage(loadingTimeSlotsText);

                                try {
                                    const availability = await fetchAvailability(selectedDate);
                                    const slots = availability.available_slots || [];
                                    const currentSelectedTime = normalizeTimeValue(selectedTimeInput.value);

                                    timeSlots.innerHTML = '';

                                    slots.forEach(time => {
                                        const canonicalTime = normalizeTimeValue(time);
                                        const button = document.createElement('button');
                                        button.type = 'button';
                                        button.className = 'w-full border-2 border-[#D4AF37] rounded-lg px-3 py-2 text-[#D4AF37] text-sm font-medium hover:bg-[#D4AF37] hover:text-white transition-all duration-200 hover:shadow-md';
                                        button.textContent = formatTimeLabel(canonicalTime);
                                        button.dataset.time = canonicalTime;

                                        if (canonicalTime === currentSelectedTime) {
                                            button.classList.remove('border-[#D4AF37]', 'text-[#D4AF37]');
                                            button.classList.add('bg-[#D4AF37]', 'text-white');
                                        }

                                        button.addEventListener('click', function() {
                                            document.querySelectorAll('#timeSlots button').forEach(btn => {
                                                btn.classList.remove('bg-[#D4AF37]', 'text-white');
                                                btn.classList.add('border-[#D4AF37]', 'text-[#D4AF37]');
                                            });

                                            this.classList.remove('border-[#D4AF37]', 'text-[#D4AF37]');
                                            this.classList.add('bg-[#D4AF37]', 'text-white');
                                            selectedTimeInput.value = canonicalTime;

                                            if (window.checkBookingReady) window.checkBookingReady();
                                        });

                                        timeSlots.appendChild(button);
                                    });

                                    if (slots.length === 0) {
                                        selectedTimeInput.value = '';
                                        setNoSlotsMessage(noAvailableTimeSlotsText);
                                    } else if (! slots.some(slot => normalizeTimeValue(slot) === currentSelectedTime)) {
                                        selectedTimeInput.value = '';
                                    }
                                } catch (error) {
                                    selectedTimeInput.value = '';
                                    setNoSlotsMessage(availabilityLoadErrorText);
                                }

                                if (window.checkBookingReady) window.checkBookingReady();
                            };

                            if (document.getElementById('selected_date').value) {
                                window.generateTimeSlots();
                            } else {
                                setNoSlotsMessage(noAvailableTimeSlotsText);
                            }
                        });
                    </script>
                </div>
            </div>
        </div>

        <script>
            /* Calendar Logic */
            const calendarMonth = document.getElementById('calendarMonth');
            const calendarDays = document.getElementById('calendarDays');
            const prevMonthBtn = document.getElementById('prevMonth');
            const nextMonthBtn = document.getElementById('nextMonth');
            const selectedDateInput = document.getElementById('selected_date');
            const timezoneSpan = document.getElementById('timezone');
            const appointmentTimezone = @js($appointmentTimezone);
            const appointmentBusinessDays = @js($appointmentBusinessDays);
            const selectedDatePrefix = @js($selectedDatePrefix);

            function getDubaiTodayString() {
                try {
                    return new Intl.DateTimeFormat('en-CA', {
                        timeZone: appointmentTimezone,
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                    }).format(new Date());
                } catch (error) {
                    return @js($appointmentTodayDubai);
                }
            }

            let today = getDubaiTodayString();
            const todayParts = today.split('-').map(Number);
            let currentMonth = todayParts[1] - 1;
            let currentYear = todayParts[0];
            let selectedDate = document.getElementById('selected_date').value || null;

            function renderCalendar(month, year) {
                // Use the correct month and year for the header
                const displayMonth = new Date(year, month, 1).toLocaleString('default', { month: 'long' });
                calendarMonth.textContent = `${displayMonth} ${year}`;
                calendarDays.innerHTML = '';
                let firstDay = new Date(year, month, 1).getDay();
                let daysInMonth = new Date(year, month + 1, 0).getDate();

                // Fill blanks for first week
                for (let i = 0; i < firstDay; i++) {
                    calendarDays.innerHTML += `<span></span>`;
                }

                // Fill days
                for (let day = 1; day <= daysInMonth; day++) {
                    let dateObj = new Date(year, month, day);
                    let dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    let isPast = dateStr < today;
                    let isBusinessDay = appointmentBusinessDays.includes(dateObj.getDay());
                    let isSelected = selectedDate === dateStr;
                    const dayButton = document.createElement('button');
                    dayButton.type = 'button';
                    dayButton.className = `rounded-full w-8 h-8 mx-auto font-medium ${isSelected ? 'bg-[#D4AF37] text-white shadow-md scale-105' : (isPast || !isBusinessDay) ? 'text-gray-300 cursor-not-allowed bg-gray-100' : 'hover:bg-[#D4AF37] hover:text-white hover:shadow-md hover:scale-105 transition-all duration-200'}`;
                    dayButton.textContent = day;
                    dayButton.dataset.date = dateStr;
                    if (isPast || !isBusinessDay) {
                        dayButton.disabled = true;
                    } else {
                        dayButton.addEventListener('click', async function(e) {
                            e.preventDefault();
                            selectedDate = this.getAttribute('data-date');
                            selectedDateInput.value = selectedDate;
                            document.getElementById('selected_time').value = '';

                            // Add visual feedback
                            const dateDisplay = document.getElementById('selected-date-display');
                            if (dateDisplay) {
                                dateDisplay.textContent = `${selectedDatePrefix} ${selectedDate}`;
                            }

                            // Regenerate time slots for the selected date
                            if (window.generateTimeSlots) {
                                await window.generateTimeSlots();
                            }

                            if (window.checkBookingReady) window.checkBookingReady();
                            renderCalendar(currentMonth, currentYear);
                        });
                    }
                    calendarDays.appendChild(dayButton);
                }
            }

            prevMonthBtn.addEventListener('click', () => {
                if (currentMonth === 0) {
                    currentMonth = 11;
                    currentYear--;
                } else {
                    currentMonth--;
                }
                renderCalendar(currentMonth, currentYear);
            });
            nextMonthBtn.addEventListener('click', () => {
                if (currentMonth === 11) {
                    currentMonth = 0;
                    currentYear++;
                } else {
                    currentMonth++;
                }
                renderCalendar(currentMonth, currentYear);
            });

            // Set timezone
            function updateTimezone() {
                const timeLabel = new Intl.DateTimeFormat('en-US', {
                    timeZone: appointmentTimezone,
                    hour: '2-digit',
                    minute: '2-digit',
                }).format(new Date());

                timezoneSpan.textContent = `${appointmentTimezone} (${timeLabel})`;
            }
            updateTimezone();

            // Initialize calendar to show the correct month if there's a selected date
            if (selectedDate) {
                const [selectedYear, selectedMonth] = selectedDate.split('-').map(Number);
                currentMonth = selectedMonth - 1;
                currentYear = selectedYear;
                const dateDisplay = document.getElementById('selected-date-display');
                if (dateDisplay) {
                    dateDisplay.textContent = `${selectedDatePrefix} ${selectedDate}`;
                }
            }

            // Initial render
            renderCalendar(currentMonth, currentYear);

            // Initialize from old values if present (for validation errors)
            if (document.getElementById('selected_date').value && document.getElementById('selected_time').value) {
                if (window.checkBookingReady) window.checkBookingReady();
            }

            </script>
    </section>
    @endif

    @if($appointmentPage?->isSectionVisible('cta') ?? true)
    @include('partials.cta-section', [
        'backgroundImage' => $readyBackground,
        'backgroundAlt' => $readyBackgroundAlt,
        'titleHtml' => $readyTitle,
        'descriptionHtml' => '<p>' . e($readyDescription) . '</p>',
        'buttonOneText' => $readyPrimaryLabel,
        'buttonOneUrl' => $readyPrimaryUrl,
        'buttonTwoText' => $readySecondaryLabel,
        'buttonTwoUrl' => $readySecondaryUrl,
    ])
    @endif


<script src="{{ asset('design/js/index.js') }}"></script>

    <script>


            // Run initial setup
            setupCarousel();

            prevBtn.addEventListener('click', function() {
                if (window.innerWidth < 768 && currentIndex > 0) {
                    currentIndex--;
                    setupCarousel();
                }
            });

            nextBtn.addEventListener('click', function() {
                if (window.innerWidth < 768 && currentIndex < totalItems - 1) {
                    currentIndex++;
                    setupCarousel();
                }
            });

            // Update carousel on window resize
            window.addEventListener('resize', setupCarousel);

            // NEW: Steps Carousel Functionality - Simplified
            const stepsPrevBtn = document.getElementById('steps-prev-btn');
            const stepsNextBtn = document.getElementById('steps-next-btn');
            const stepsItems = document.querySelectorAll('.steps-item');

            let currentStepIndex = 0;
            const totalSteps = stepsItems.length;

            // Add CSS styles for the carousel
            const style = document.createElement('style');
            style.textContent = `
                .steps-item {
                    transition: all 0.3s ease-in-out;
                }
                .number-badge {
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }
            `;
            document.head.appendChild(style);

            // Function to update the carousel display
            function updateStepsCarousel() {
                // For mobile view (one card at a time)
                if (window.innerWidth < 768) {
                    stepsItems.forEach((item, index) => {
                        // Only show the current step on mobile
                        if (index === currentStepIndex) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    });
                }
                // For desktop view (three cards at a time)
                else {
                    stepsItems.forEach((item, index) => {
                        // Show first three items on desktop
                        if (index >= currentStepIndex && index < currentStepIndex + 3) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    });
                }

                // Update the navigation buttons
                stepsPrevBtn.style.opacity = currentStepIndex === 0 ? '0.5' : '1';
                stepsPrevBtn.style.cursor = currentStepIndex === 0 ? 'default' : 'pointer';

                const maxIndex = window.innerWidth < 768 ? totalSteps - 1 : totalSteps - 3;
                stepsNextBtn.style.opacity = currentStepIndex >= maxIndex ? '0.5' : '1';
                stepsNextBtn.style.cursor = currentStepIndex >= maxIndex ? 'default' : 'pointer';
            }

            // Initialize the carousel
            updateStepsCarousel();

            // Handle previous button click
            stepsPrevBtn.addEventListener('click', function() {
                if (currentStepIndex > 0) {
                    currentStepIndex--;
                    updateStepsCarousel();
                }
            });

            // Handle next button click
            stepsNextBtn.addEventListener('click', function() {
                const maxIndex = window.innerWidth < 768 ? totalSteps - 1 : totalSteps - 3;
                if (currentStepIndex < maxIndex) {
                    currentStepIndex++;
                    updateStepsCarousel();
                }
            });

            // Update on window resize
            window.addEventListener('resize', function() {
                // Reset the index if needed
                const maxIndex = window.innerWidth < 768 ? totalSteps - 1 : totalSteps - 3;
                if (currentStepIndex > maxIndex) {
                    currentStepIndex = maxIndex;
                }
                updateStepsCarousel();
            });
        });
    </script>

@endsection

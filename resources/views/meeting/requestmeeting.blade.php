@extends('app')

@section('content')
@php
    $locale = app()->getLocale();
    $isArabic = $locale === 'ar';
    $localize = function ($en, $ar) use ($isArabic) {
        return $isArabic ? ($ar ?: $en) : ($en ?: $ar);
    };
    $normalizeHeroTitle = function (?string $value, string $fallback) {
        if (blank($value)) {
            return $fallback;
        }

        $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $value = preg_replace('/<\/p>\s*<p>/i', '<br>', $value);
        $value = preg_replace('/<p[^>]*>/i', '', $value);
        $value = preg_replace('/<\/p>/i', '', $value);

        return trim(strip_tags($value, '<br>')) ?: $fallback;
    };

    $heroDesktop = $pageContent?->hero_desktop_image ? asset('storage/' . $pageContent->hero_desktop_image) : asset('design/images/resource-bg.png');
    $heroMobile = $pageContent?->hero_mobile_image ? asset('storage/' . $pageContent->hero_mobile_image) : $heroDesktop;
    $heroTitle = $normalizeHeroTitle(
        $localize($pageContent?->title_en, $pageContent?->title_ar),
        'REQUEST A MEETING'
    );
    $heroSubtitle = $localize($pageContent?->subtitle_en, $pageContent?->subtitle_ar)
        ?: ($isArabic ? 'شاركنا بعض التفاصيل حتى يتمكن فريقنا من مراجعة طلبك والتواصل معك.' : 'Share a few details so our team can review your request and get back to you.');
    $heroDesktopAlt = $localize($pageContent?->hero_desktop_image_alt_en, $pageContent?->hero_desktop_image_alt_ar) ?: $heroTitle;
    $heroMobileAlt = $localize($pageContent?->hero_mobile_image_alt_en, $pageContent?->hero_mobile_image_alt_ar) ?: $heroDesktopAlt;
    $formBackground = $pageContent?->body_background_image ? asset('storage/' . $pageContent->body_background_image) : asset('design/images/risk-bg.png');
    $formTitle = $localize($pageContent?->form_title_en, $pageContent?->form_title_ar) ?: 'REQUEST YOUR CONSULTATION';
    $warningText = $localize($pageContent?->form_warning_text_en, $pageContent?->form_warning_text_ar) ?: 'Back to request of meeting form';
    $submitText = $localize($pageContent?->form_button_text_en, $pageContent?->form_button_text_ar) ?: 'SEND MESSAGE';

    $defaultFields = [
        ['field_name' => 'name', 'field_type' => 'text', 'label_en' => 'Name *', 'label_ar' => 'الاسم *', 'placeholder_en' => 'Your name', 'placeholder_ar' => 'اسمك'],
        ['field_name' => 'email', 'field_type' => 'email', 'label_en' => 'Email *', 'label_ar' => 'البريد الإلكتروني *', 'placeholder_en' => 'example@company.com', 'placeholder_ar' => 'example@company.com'],
        ['field_name' => 'phone', 'field_type' => 'tel', 'label_en' => 'Phone Number *', 'label_ar' => 'رقم الهاتف *', 'placeholder_en' => '+11 000 000 000', 'placeholder_ar' => '+11 000 000 000'],
        ['field_name' => 'percentage', 'field_type' => 'radio', 'label_en' => 'What percentage of your total assets are you willing to invest in higher-risk investments?', 'label_ar' => 'ما النسبة من إجمالي أصولك التي ترغب في استثمارها في استثمارات عالية المخاطر؟', 'options' => [['value' => 'Less than 25%', 'label_en' => 'Less than 25%', 'label_ar' => 'أقل من 25%'], ['value' => '25-50%', 'label_en' => '25-50%', 'label_ar' => '25-50%'], ['value' => '50-75%', 'label_en' => '50-75%', 'label_ar' => '50-75%'], ['value' => 'More than 75%', 'label_en' => 'More than 75%', 'label_ar' => 'أكثر من 75%']]],
        ['field_name' => 'age_group', 'field_type' => 'radio', 'label_en' => 'What is your age group?', 'label_ar' => 'ما هي فئتك العمرية؟', 'options' => [['value' => 'Under 30', 'label_en' => 'Under 30', 'label_ar' => 'أقل من 30'], ['value' => '30-45', 'label_en' => '30-45', 'label_ar' => '30-45'], ['value' => '46-60', 'label_en' => '46-60', 'label_ar' => '46-60'], ['value' => 'Over 60', 'label_en' => 'Over 60', 'label_ar' => 'أكثر من 60']]],
        ['field_name' => 'investment_experience', 'field_type' => 'radio', 'label_en' => 'How much investment experience do you have?', 'label_ar' => 'ما مقدار خبرتك الاستثمارية؟', 'options' => [['value' => 'None', 'label_en' => 'None', 'label_ar' => 'لا يوجد'], ['value' => 'Limited', 'label_en' => 'Limited', 'label_ar' => 'محدودة'], ['value' => 'Moderate', 'label_en' => 'Moderate', 'label_ar' => 'متوسطة'], ['value' => 'Extensive', 'label_en' => 'Extensive', 'label_ar' => 'كبيرة']]],
        ['field_name' => 'wealth_size', 'field_type' => 'radio', 'label_en' => 'What is the size of your total wealth?', 'label_ar' => 'ما حجم إجمالي ثروتك؟', 'options' => [['value' => 'Less than USD 1 million', 'label_en' => 'Less than USD 1 million', 'label_ar' => 'أقل من مليون دولار'], ['value' => 'USD 1 million - USD 10 million', 'label_en' => 'USD 1 million - USD 10 million', 'label_ar' => '1 - 10 ملايين دولار'], ['value' => 'USD 10 million - USD 50 million', 'label_en' => 'USD 10 million - USD 50 million', 'label_ar' => '10 - 50 مليون دولار'], ['value' => 'USD 50 million - USD 500 million', 'label_en' => 'USD 50 million - USD 500 million', 'label_ar' => '50 - 500 مليون دولار']]],
        ['field_name' => 'investment_goal', 'field_type' => 'checkbox', 'label_en' => 'What is your investment goal?', 'label_ar' => 'ما هو هدفك الاستثماري؟', 'options' => [['value' => 'Capital Preservation', 'label_en' => 'Capital Preservation', 'label_ar' => 'الحفاظ على رأس المال'], ['value' => 'Income Generation', 'label_en' => 'Income Generation', 'label_ar' => 'توليد الدخل'], ['value' => 'Capital Growth', 'label_en' => 'Capital Growth', 'label_ar' => 'نمو رأس المال']]],
        ['field_name' => 'investment_horizon', 'field_type' => 'radio', 'label_en' => 'What is your investment horizon?', 'label_ar' => 'ما هو أفقك الاستثماري؟', 'options' => [['value' => 'Less than 3 years', 'label_en' => 'Less than 3 years', 'label_ar' => 'أقل من 3 سنوات'], ['value' => '3-5 years', 'label_en' => '3-5 years', 'label_ar' => '3-5 سنوات'], ['value' => 'More than 5 years', 'label_en' => 'More than 5 years', 'label_ar' => 'أكثر من 5 سنوات']]],
        ['field_name' => 'investment_reaction', 'field_type' => 'checkbox', 'label_en' => 'How would you react if your investment portfolio lost 10% in a month?', 'label_ar' => 'كيف ستتصرف إذا خسرت محفظتك الاستثمارية 10% في شهر واحد؟', 'options' => [['value' => 'Sell all investments', 'label_en' => 'Sell all investments', 'label_ar' => 'بيع جميع الاستثمارات'], ['value' => 'Sell some investments', 'label_en' => 'Sell some investments', 'label_ar' => 'بيع بعض الاستثمارات'], ['value' => 'Do nothing', 'label_en' => 'Do nothing', 'label_ar' => 'عدم القيام بأي شيء'], ['value' => 'Buy more investments', 'label_en' => 'Buy more investments', 'label_ar' => 'شراء المزيد من الاستثمارات']]],
        ['field_name' => 'income_source', 'field_type' => 'checkbox', 'label_en' => 'What is your primary source of income?', 'label_ar' => 'ما هو مصدر دخلك الأساسي؟', 'options' => [['value' => 'Salary', 'label_en' => 'Salary', 'label_ar' => 'راتب'], ['value' => 'Business Income', 'label_en' => 'Business Income', 'label_ar' => 'دخل الأعمال'], ['value' => 'Investment Income', 'label_en' => 'Investment Income', 'label_ar' => 'دخل استثماري']]],
        ['field_name' => 'investment_style', 'field_type' => 'checkbox', 'label_en' => 'What is your preferred investment style?', 'label_ar' => 'ما هو أسلوبك الاستثماري المفضل؟', 'options' => [['value' => 'Conservative (low risk, lower returns)', 'label_en' => 'Conservative (low risk, lower returns)', 'label_ar' => 'محافظ (مخاطر منخفضة وعوائد أقل)'], ['value' => 'Balanced (moderate risk, moderate returns)', 'label_en' => 'Balanced (moderate risk, moderate returns)', 'label_ar' => 'متوازن (مخاطر وعوائد متوسطة)'], ['value' => 'Aggressive (high risk, higher returns)', 'label_en' => 'Aggressive (high risk, higher returns)', 'label_ar' => 'هجومي (مخاطر عالية وعوائد أعلى)']]],
        ['field_name' => 'asset_allocation', 'field_type' => 'checkbox', 'label_en' => 'How is your current asset allocation divided?', 'label_ar' => 'كيف يتم توزيع أصولك الحالية؟', 'options' => [['value' => 'Equities', 'label_en' => 'Equities', 'label_ar' => 'الأسهم'], ['value' => 'Bonds', 'label_en' => 'Bonds', 'label_ar' => 'السندات'], ['value' => 'Real Estate', 'label_en' => 'Real Estate', 'label_ar' => 'العقارات'], ['value' => 'Cash', 'label_en' => 'Cash', 'label_ar' => 'النقد'], ['value' => 'Family Business', 'label_en' => 'Family Business', 'label_ar' => 'الأعمال العائلية'], ['value' => 'Other Investments', 'label_en' => 'Other Investments', 'label_ar' => 'استثمارات أخرى']]],
    ];
    $formFields = $pageContent?->form_fields ?: $defaultFields;
    $halfCount = (int) ceil(count($formFields) / 2);
    $firstHalf = array_slice($formFields, 0, $halfCount);
    $secondHalf = array_slice($formFields, $halfCount);
    $fieldDirection = $isArabic ? 'rtl' : 'ltr';
    $fieldLabelAlignment = $isArabic ? 'text-right' : 'text-left';
    $fieldInputAlignment = $isArabic ? 'text-right placeholder:text-right' : 'text-left placeholder:text-left';
    $choiceLabelAlignment = $isArabic ? 'text-right flex flex-row-reverse items-start justify-between gap-3' : '';
    $choiceInputSpacing = $isArabic ? 'ml-2 mr-0' : 'mr-2';
@endphp

@if($pageContent?->isSectionVisible('hero') ?? true)
<section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
    <div class="relative overflow-hidden h-full">
        <div class="flex flex-col h-full">
            <div class="flex transition-transform duration-500 ease-in-out h-full">
                <div class="w-full flex-shrink-0 relative">
                    <div class="absolute inset-0 hidden md:block">
                        <img loading="lazy" src="{{ $heroDesktop }}" alt="{{ $heroDesktopAlt }}" class="w-full h-full object-cover"/>
                    </div>
                    <div class="absolute inset-0 block md:hidden">
                        <img loading="lazy" src="{{ $heroMobile }}" alt="{{ $heroMobileAlt }}" class="w-full h-full object-cover"/>
                    </div>
                    <div class="relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                        <div class="container mx-auto text-center">
                            <h1 class="text-[45px] xl:text-[78px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">{!! $heroTitle !!}</h1>
                            <div class="mb-8 text-[17px] xl:text-[18px] text-[#FFFFFF]/70 font-['Poppins'] font-regular max-w-3xl mx-auto">
                                <p>{!! $heroSubtitle !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if($pageContent?->isSectionVisible('form') ?? true)
<section class="min-h-screen bg-[#051C45] bg-opacity-90 flex items-center justify-center px-4 py-12" style="background-image: url('{{ $formBackground }}'); background-size: cover;">
    <div class="container w-full bg-transparent xl:max-w-[1300px] md:max-w-[950px] mx-auto">
        <h2 class="text-2xl sm:text-3xl md:text-[48px] md:leading-[58px] font-bold text-center text-white mb-6 sm:mb-10">{!! $formTitle !!}</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="bg-yellow-600 text-white p-4 rounded-lg mb-6 text-center">
                <span class="text-white font-bold">{{ $warningText }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('meeting.submit') }}" class="grid bg-transparent grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 bg-black bg-opacity-50 p-4 sm:p-8 rounded-lg" dir="{{ $fieldDirection }}">
            @csrf

            @foreach([$firstHalf, $secondHalf] as $columnIndex => $columnFields)
                <div class="{{ $columnIndex === 0 ? 'space-y-8 sm:space-y-16' : 'space-y-8 sm:space-y-20' }}">
                    @foreach($columnFields as $field)
                        @php
                            $isContactField = in_array($field['field_name'], ['name', 'email', 'phone'], true);
                            $label = $localize($field['label_en'] ?? null, $field['label_ar'] ?? null);
                            $placeholder = $localize($field['placeholder_en'] ?? null, $field['placeholder_ar'] ?? null);
                            $fieldOptions = $field['options'] ?? [];
                            $wrapperClass = $isContactField && $columnIndex === 0
                                ? 'p-4 sm:p-10 rounded-xl bg-black -ml-2 sm:-ml-4 md:-ml-8 mr-4 sm:mr-20 transform md:translate-x-[-2%]'
                                : '';
                        @endphp
                        <div class="{{ $wrapperClass }}">
                            <label class="block {{ $isContactField && $columnIndex === 0 ? 'text-[#B9C2CB]' : 'text-white' }} {{ $fieldLabelAlignment }} mb-3 sm:mb-4 font-['Poppins'] text-base sm:text-lg md:text-[21.32px]">{{ $label }}</label>

                            @if(in_array($field['field_type'], ['text', 'email', 'tel'], true))
                                <input
                                    type="{{ $field['field_type'] }}"
                                    name="{{ $field['field_name'] }}"
                                    value="{{ old($field['field_name']) }}"
                                    dir="{{ $fieldDirection }}"
                                    placeholder="{{ $placeholder }}"
                                    class="w-full p-2 sm:p-3 rounded bg-white text-gray-900 placeholder-gray-400 focus:outline-none font-['Poppins'] text-base sm:text-lg md:text-[21.32px] {{ $fieldInputAlignment }}"
                                    required
                                />
                            @elseif($field['field_type'] === 'textarea')
                                <textarea
                                    name="{{ $field['field_name'] }}"
                                    rows="4"
                                    dir="{{ $fieldDirection }}"
                                    placeholder="{{ $placeholder }}"
                                    class="w-full p-2 sm:p-3 rounded bg-white text-gray-900 placeholder-gray-400 focus:outline-none font-['Poppins'] text-base sm:text-lg md:text-[21.32px] {{ $fieldInputAlignment }}"
                                >{{ old($field['field_name']) }}</textarea>
                            @elseif(in_array($field['field_type'], ['radio', 'checkbox'], true))
                                <div class="space-y-1 sm:space-y-2 text-white">
                                    @foreach($fieldOptions as $option)
                                        @php
                                            $optionLabel = $localize($option['label_en'] ?? null, $option['label_ar'] ?? null) ?: ($option['value'] ?? '');
                                            $optionValue = $option['value'] ?? $optionLabel;
                                            $oldValue = old($field['field_name'], $field['field_type'] === 'checkbox' ? [] : null);
                                            $isChecked = $field['field_type'] === 'checkbox'
                                                ? in_array($optionValue, (array) $oldValue, true)
                                                : $oldValue === $optionValue;
                                        @endphp
                                        <label class="block font-['Poppins'] text-base sm:text-lg md:text-[21.32px] {{ $choiceLabelAlignment }}" dir="{{ $fieldDirection }}">
                                            <input
                                                type="{{ $field['field_type'] }}"
                                                name="{{ $field['field_name'] }}{{ $field['field_type'] === 'checkbox' ? '[]' : '' }}"
                                                value="{{ $optionValue }}"
                                                class="{{ $choiceInputSpacing }} w-4 sm:w-5 h-4 sm:h-5 shrink-0"
                                                {{ $isChecked ? 'checked' : '' }}
                                                {{ $field['field_type'] === 'radio' ? 'required' : '' }}
                                            >
                                            {{ $optionLabel }}
                                        </label>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach

            <div class="col-span-1 md:col-span-2 flex justify-center mt-6">
                <x-recaptcha action="meeting_request" />
            </div>
            <div class="col-span-1 md:col-span-2 flex justify-center mt-6">
                <button type="submit" class="bg-[#D4AF37] text-[#F1F3F5] px-6 sm:px-20 md:px-40 py-3 sm:py-4 rounded-lg text-base sm:text-[19px] font-neue-bold w-full sm:w-auto">
                    {{ $submitText }}
                </button>
            </div>
        </form>
    </div>
</section>
@endif
@endsection

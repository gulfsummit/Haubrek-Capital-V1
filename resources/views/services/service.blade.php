@extends('app')

@section('content')
@php
    $localize = $localize ?? function ($en, $ar) {
        return app()->getLocale() === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
    };
    $normalizeLink = function ($value, $fallback = '#') {
        if (blank($value)) {
            return $fallback;
        }

        if (
            str_starts_with($value, 'http://') ||
            str_starts_with($value, 'https://') ||
            str_starts_with($value, '/') ||
            str_starts_with($value, '#') ||
            str_starts_with($value, 'mailto:') ||
            str_starts_with($value, 'tel:')
        ) {
            return $value;
        }

        if (\Illuminate\Support\Facades\Route::has($value)) {
            return route($value);
        }

        return '/' . ltrim($value, '/');
    };
    $toArabicNumerals = function ($value) {
        return strtr((string) $value, [
            '0' => '٠',
            '1' => '١',
            '2' => '٢',
            '3' => '٣',
            '4' => '٤',
            '5' => '٥',
            '6' => '٦',
            '7' => '٧',
            '8' => '٨',
            '9' => '٩',
        ]);
    };
    $defaultHeroTitle = app()->getLocale() == 'ar'
        ? ($serviceData['hero_title_ar'] ?? 'SERVICES')
        : ($serviceData['hero_title_en'] ?? 'SERVICES');
    $pageH1 = isset($seoMeta)
        ? ($localize($seoMeta->h1_en ?? null, $seoMeta->h1_ar ?? null) ?? $defaultHeroTitle)
        : $defaultHeroTitle;

    $isArabic = app()->getLocale() === 'ar';
    $pageDirection = $isArabic ? 'rtl' : 'ltr';
    $mdTextAlignment = $isArabic ? 'md:text-right' : 'md:text-left';
    $textAlignment = $isArabic ? 'text-right' : 'text-left';
    $primaryHeadingAlignment = "text-center {$mdTextAlignment}";
    $primaryParagraphAlignment = "text-center {$mdTextAlignment}";
    $flexDirectionClass = $isArabic ? 'md:flex-row-reverse' : 'md:flex-row';
    $mainHorizontalMargin = $isArabic ? 'mr-4' : 'ml-4';
    $mainColumnPadding = $isArabic ? 'md:pl-8' : 'md:pr-8';
    $listNumberSpacing = $isArabic ? 'ml-8' : 'mr-8';
    $listItemDirection = $isArabic ? 'flex-row-reverse' : '';
    $servicesListRowClass = $isArabic ? 'flex-row text-right' : 'flex-row text-left';
    $servicesListNumberClass = $isArabic ? 'mr-10 shrink-0 text-right' : 'mr-8 shrink-0 text-left';
    $servicesListContentClass = $isArabic ? 'pt-4 text-right flex-1' : 'pt-4 text-left flex-1';
    $sectionColumnPadding = $isArabic ? 'md:pl-24' : 'md:pr-24';
    $sectionColumnAccentPadding = $isArabic ? 'md:pl-12' : 'md:pr-12';
    $imageJustifyClass = $isArabic ? 'md:justify-start' : 'md:justify-end';
    $ctaLayoutDirection = $isArabic ? 'md:flex-row-reverse' : 'md:flex-row';
    $ctaTextAlignment = $isArabic ? 'text-right md:text-right' : 'text-left md:text-left';
    $ctaButtonsDirection = $isArabic ? 'sm:flex-row-reverse' : 'sm:flex-row';
    $mainDescriptionTextOrder = $isArabic ? 'md:order-2' : 'md:order-1';
    $mainDescriptionBoxesOrder = $isArabic ? 'md:order-1' : 'md:order-2';

    $getContent = function (string $key, ?string $defaultEn = null, ?string $defaultAr = null) use ($serviceData, $localize) {
        $defaultAr = $defaultAr ?? $defaultEn;
        $valueEn = is_array($serviceData) ? ($serviceData[$key . '_en'] ?? $defaultEn) : $defaultEn;
        $valueAr = is_array($serviceData) ? ($serviceData[$key . '_ar'] ?? $defaultAr) : $defaultAr;
        return $localize($valueEn, $valueAr);
    };
@endphp

@include('services.partials.responsive-styles')

<div dir="{{ $pageDirection }}" class="services-responsive {{ $isArabic ? 'rtl' : 'ltr' }}">
<!-- Hero Section -->
@if($servicesPage?->isSectionVisible('hero') ?? true)
<section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
    <div class="relative overflow-hidden h-full">
        <div class="flex flex-col h-full">
            <div class="flex transition-transform duration-500 ease-in-out h-full">
                <div class="w-full flex-shrink-0 relative">
                    <!-- Desktop background -->
                    <div class="absolute inset-0 hidden md:block">
                        @if(isset($serviceData['hero_background_image']) && $serviceData['hero_background_image'])
                            <img loading="eager" src="{{ asset('storage/' . $serviceData['hero_background_image']) }}" alt="Wealth Management" class="w-full h-full object-cover"/>
                        @else
                            <img loading="eager" src="{{ asset('design/images/services-hero.png') }}" alt="Wealth Management" class="w-full h-full object-cover"/>
                        @endif
                    </div>
                    <!-- Mobile background -->
                    <div class="absolute inset-0 block md:hidden">
                        @if(isset($serviceData['hero_mobile_background_image']) && $serviceData['hero_mobile_background_image'])
                            <img loading="eager" src="{{ asset('storage/' . $serviceData['hero_mobile_background_image']) }}" alt="Wealth Management Mobile" class="w-full h-full object-cover"/>
                        @else
                            <img loading="eager" src="{{ asset('design/images/mobile-services-hero.png') }}" alt="Wealth Management Mobile" class="w-full h-full object-cover"/>
                        @endif
                    </div>
                    <div class="absolute inset-0"></div>
                    <div class="relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                        <div class="container mx-auto text-center">
                            <h1 class="text-[45px] xl:text-[78px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">
                                {{ $pageH1 }}
                            </h1>
                            <p class="mb-8 text-[17px] xl:text-[18px] text-[#FFFFFF]/70 font-['Poppins'] font-regular">
                                {!! $getContent(
                                    'hero_subtitle',
                                    'Discover comprehensive financial services designed to meet your unique needs.',
                                    'اكتشف خدمات مالية شاملة مصممة لتلبية احتياجاتك الفريدة.'
                                ) !!}
                            </p>
                            <a href="{{ $normalizeLink($serviceData['hero_button_link'] ?? null, '/calendar') }}" class="bg-[#D4AF37] px-6 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">
                                {{ app()->getLocale() == 'ar' ? ($serviceData['hero_button_text_ar'] ?? 'طلب اجتماع') : ($serviceData['hero_button_text_en'] ?? 'REQUEST A MEETING') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Main Description Section -->
@if(($servicesPage?->isSectionVisible('description') ?? true) || ($servicesPage?->isSectionVisible('services_list') ?? true))
<section class="bg-[#041B44] px-4 text-white py-16 md:py-32">
    <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto">
        <div class="flex {{ $mainHorizontalMargin }} flex-col md:flex-row gap-40" dir="ltr">
            <!-- Left Column - Text -->
            @if($servicesPage?->isSectionVisible('description') ?? true)
            <div class="pr-0 md:w-[50%] {{ $mainColumnPadding }} {{ $mainDescriptionTextOrder }}" dir="{{ $pageDirection }}">
                <h4 class="text-[20px] md:text-[30px] font-neue-extrabold mb-12 {{ $primaryHeadingAlignment }}">
                    {{ $getContent('description_title', 'OPTIMIZING WEALTH MANAGEMENT FOR HNWI, FAMILY OFFICES & ENDOWMENTS', 'تعزيز إدارة الثروات للأفراد ذوي الملاءة العالية والمكاتب العائلية والوقفية') }}
                </h4>
                
                <div class="text-base md:text-lg mb-6 text-[#F2E4D4]/70 {{ $primaryParagraphAlignment }}">
                    {!! $getContent(
                        'description',
                        'As liquid assets grow, so do the challenges of managing them effectively. We establish dedicated investment offices and endowment funds to ensure sustainability, capital growth, and governance.<br><br>A high-performing investment office goes beyond wealth management, driving asset diversification, governance, and performance monitoring. Depending on asset value, management can be insourced or outsourced.<br><br>We provide comprehensive financial solutions to reduce costs, enhance governance, and optimize asset allocation—ensuring long-term financial success.',
                        'مع نمو الأصول السائلة تزداد تحديات إدارتها بكفاءة. نقوم بإنشاء مكاتب استثمارية وصناديق وقفية مخصصة لضمان الاستدامة ونمو رأس المال وتعزيز الحوكمة.<br><br>يتجاوز المكتب الاستثماري عالي الأداء مجرد إدارة الثروة، إذ يقود تنويع الأصول والحوكمة ومراقبة الأداء. وبحسب حجم الأصول يمكن إدارة العمليات داخلياً أو الاستعانة بمصادر خارجية.<br><br>نقدم حلولاً مالية شاملة لتقليل التكاليف وتعزيز الحوكمة وتحسين توزيع الأصول، بما يضمن النجاح المالي على المدى الطويل.'
                    ) !!}
                </div>
            </div>
            @endif
            
            <!-- Right Column - Services -->
            @if($servicesPage?->isSectionVisible('services_list') ?? true)
            <div class="space-y-12 mt-8 md:mt-0 {{ $mainDescriptionBoxesOrder }}" dir="{{ $pageDirection }}">
                @if(isset($serviceData['services_list']) && is_array($serviceData['services_list']))
                    @foreach($serviceData['services_list'] as $index => $service)
                        <div class="flex items-start w-full {{ $servicesListRowClass }}">
                            <div class="{{ $servicesListNumberClass }}">
                                @php
                                    $serviceNumber = $service['number'] ?? ($isArabic ? (string) ($index + 1) : str_pad($index + 1, 2, '0', STR_PAD_LEFT));
                                    if ($isArabic) {
                                        $serviceNumber = $toArabicNumerals((int) $serviceNumber);
                                    }
                                @endphp
                                <h1 class="text-[71px] opacity-70 leading-none font-neue-extrabold text-[#FFFFFF]">
                                    {{ $serviceNumber }}
                                </h1>
                            </div>
                            <div class="{{ $servicesListContentClass }}">
                                <h4 class="text-xl font-neue-bold mb-1 {{ $textAlignment }}">
                                    @php
                                        $linkText = app()->getLocale() == 'ar' 
                                            ? ($service['link_text_ar'] ?? $service['title_ar'] ?? 'SERVICE ' . ($index + 1))
                                            : ($service['link_text_en'] ?? $service['title_en'] ?? 'SERVICE ' . ($index + 1));
                                        
                                        $linkUrl = $service['link_url'] ?? '#' . ($service['section_id'] ?? 'section-' . ($index + 1));
                                        
                                        // Handle different URL types
                                        if (str_starts_with($linkUrl, '#')) {
                                            $finalUrl = $linkUrl;
                                        } elseif (str_starts_with($linkUrl, 'http')) {
                                            $finalUrl = $linkUrl;
                                        } elseif (str_starts_with($linkUrl, '/')) {
                                            $finalUrl = $linkUrl;
                                        } else {
                                            $finalUrl = '#' . $linkUrl;
                                        }
                                    @endphp
                                    <a href="{{ $finalUrl }}" class="hover:text-[#D4AF37] transition-colors scroll-to-section">
                                        {{ $linkText }}
                                    </a>
                                </h4>
                                <p class="text-[#F2E4D4]/70 {{ $textAlignment }}">
                                    {{ app()->getLocale() == 'ar' ? ($service['description_ar'] ?? 'Service description') : ($service['description_en'] ?? 'Service description') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            @endif
        </div>
    </div>
</section>
@endif

<!-- Governance Advisory Section -->
@if($servicesPage?->isSectionVisible('governance') ?? true)
<section id="section-1" class="relative py-16">
    <!-- Background image -->
    <div class="absolute inset-0">
        <!-- Desktop background -->
        @if(isset($serviceData['governance_background']) && $serviceData['governance_background'])
            <img loading="lazy" src="{{ asset('storage/' . $serviceData['governance_background']) }}" alt="Governance Advisory Background" class="hidden md:block w-full h-full object-cover">
        @else
            <img loading="lazy" src="{{ asset('design/images/governance-bg.png') }}" alt="Governance Advisory Background" class="hidden md:block w-full h-full object-cover">
        @endif
        <!-- Mobile background -->
        @if(isset($serviceData['governance_mobile_background']) && $serviceData['governance_mobile_background'])
            <img loading="lazy" src="{{ asset('storage/' . $serviceData['governance_mobile_background']) }}" alt="Governance Advisory Background Mobile" class="block md:hidden w-full h-full object-cover">
        @else
            <img loading="lazy" src="{{ asset('design/images/governance-bg.png') }}" alt="Governance Advisory Background Mobile" class="block md:hidden w-full h-full object-cover">
        @endif
    </div>
    <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto md:px-4 relative flex flex-col {{ $flexDirectionClass }} items-center gap-8">
        <div class="w-full pr-0 {{ $sectionColumnPadding }} md:pt-12">
            <h2 class="text-3xl md:text-[48px] md:leading-[62px] font-neue-extrabold text-[#041B44] mb-3 {{ $primaryHeadingAlignment }}">
                {!! $getContent('governance_title', 'GOVERNANCE ADVISORY', 'الاستشارات الحوكمية') !!}
            </h2>
            <div class="governance-description px-[10px] md:px-0 text-[18px] md:mt-6 mb-12 mt-10 font-['Poppins'] font-regular md:max-w-[80%] mx-auto md:mx-0 {{ $primaryParagraphAlignment }}" style="color: #041B44 !important;">
                {!! $getContent(
                    'governance_description',
                    'We help establish strong governance frameworks to ensure compliance, risk management, and long-term sustainability; enabling better decision-making and control over asset diversification.',
                    'نساعدك على إنشاء أطر حوكمة قوية تضمن الامتثال وإدارة المخاطر والاستدامة على المدى الطويل، بما يمكّن من اتخاذ قرارات أفضل والتحكم في تنويع الأصول.'
                ) !!}
            </div>
            <!-- Mobile image placeholder moved under the paragraph -->
            <div class="block px-4 md:hidden mt-4">
                @if(isset($serviceData['governance_mobile_image']) && $serviceData['governance_mobile_image'])
                    <img loading="lazy" src="{{ asset('storage/' . $serviceData['governance_mobile_image']) }}" alt="Governance Advisory Mobile" class="w-full h-auto rounded-lg" />
                @elseif(isset($serviceData['governance_image']) && $serviceData['governance_image'])
                    <img loading="lazy" src="{{ asset('storage/' . $serviceData['governance_image']) }}" alt="Governance Advisory Mobile" class="w-full h-auto rounded-lg" />
                @else
                    <img loading="lazy" src="{{ asset('design/images/governance.png') }}" alt="Governance Advisory Mobile" class="w-full h-auto rounded-lg" />
                @endif
            </div>
            <div class="hidden md:block {{ $textAlignment }}">
                <a href="{{ $normalizeLink($serviceData['governance_link'] ?? null, '/governance-services') }}" class="bg-[#D4AF37] mt-6 text-white px-12 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">
                    {{ $localize($serviceData['governance_read_more_text_en'] ?? 'READ MORE', $serviceData['governance_read_more_text_ar'] ?? 'اقرأ المزيد') }}
                </a>
            </div>
        </div>
        
        <!-- Right side - Image -->
        <div class="w-full md:w-1/2 flex justify-center {{ $imageJustifyClass }} hidden md:block">
            @if(isset($serviceData['governance_image']) && $serviceData['governance_image'])
                <img loading="lazy" src="{{ asset('storage/' . $serviceData['governance_image']) }}" alt="Governance Advisory" class="w-full max-w-md">
            @else
                <img loading="lazy" src="{{ asset('design/images/governance.png') }}" alt="Governance Advisory" class="w-full max-w-md">
            @endif
        </div>
    </div>
    
    <!-- Mobile button at the bottom -->
    <div class="w-full flex justify-center md:hidden mt-8 mb-8 px-4 relative z-10">
        <a href="{{ $normalizeLink($serviceData['governance_link'] ?? null, '/governance-services') }}" class="bg-[#D4AF37] text-white px-12 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">
            {{ $localize($serviceData['governance_read_more_text_en'] ?? 'READ MORE', $serviceData['governance_read_more_text_ar'] ?? 'اقرأ المزيد') }}
        </a>
    </div>
</section>
@endif

<!-- Wealth Planning Section -->
@if($servicesPage?->isSectionVisible('wealth') ?? true)
<section id="section-2" class="relative py-16">
    <!-- Background image -->
    <div class="absolute inset-0">
        <!-- Desktop background -->
        @if(isset($serviceData['wealth_background']) && $serviceData['wealth_background'])
            <img loading="lazy" src="{{ asset('storage/' . $serviceData['wealth_background']) }}" alt="Wealth Planning Background" class="hidden md:block w-full h-full object-cover">
        @else
            <img loading="lazy" src="{{ asset('design/images/wealth-bg.png') }}" alt="Wealth Planning Background" class="hidden md:block w-full h-full object-cover">
        @endif
        <!-- Mobile background -->
        @if(isset($serviceData['wealth_background_mobile']) && $serviceData['wealth_background_mobile'])
            <img loading="lazy" src="{{ asset('storage/' . $serviceData['wealth_background_mobile']) }}" alt="Wealth Planning Background Mobile" class="block md:hidden w-full h-full object-cover">
        @else
            <img loading="lazy" src="{{ asset('design/images/mobile-wealth-bg.png') }}" alt="Wealth Planning Background Mobile" class="block md:hidden w-full h-full object-cover">
        @endif
    </div>
    <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto md:px-4 relative flex flex-col {{ $flexDirectionClass }} items-center gap-8">
        <div class="w-full md:w-[70%] relative hidden md:block">
            <!-- Desktop image placeholder -->
            <div class="hidden md:block">
                @if(isset($serviceData['wealth_image']) && $serviceData['wealth_image'])
                    <img loading="lazy" src="{{ asset('storage/' . $serviceData['wealth_image']) }}" alt="Wealth Planning" class="w-[350px] max-w-full h-auto rounded-lg" />
                @else
                    <img loading="lazy" src="{{ asset('design/images/wealth-planning.png') }}" alt="Wealth Planning" class="w-[350px] max-w-full h-auto rounded-lg" />
                @endif
            </div>
        </div>
        <div class="w-full pr-0 {{ $sectionColumnPadding }} md:pt-12">
            <h2 class="text-3xl md:text-[48px] md:leading-[62px] font-neue-extrabold text-[#E9E9E9] mb-3 {{ $primaryHeadingAlignment }}">
                {{ $getContent('wealth_title', 'WEALTH PLANNING', 'تخطيط الثروات') }}
            </h2>
            <div class="wealth-description px-[10px] md:px-0 text-[18px] md:mt-6 mb-12 mt-10 font-['Poppins'] font-regular md:max-w-[80%] mx-auto md:mx-0 {{ $primaryParagraphAlignment }}" style="color: #FFFFFF !important;">
                {!! $getContent(
                    'wealth_description',
                    'Our strategic wealth planning solutions are designed to protect, grow, and transfer wealth efficiently, ensuring financial security for future generations while optimizing tax and investment structures.',
                    'تم تصميم حلولنا الاستراتيجية لتخطيط الثروات لحماية الأصول وتنميتها ونقلها بكفاءة، وضمان الأمان المالي للأجيال القادمة مع تحسين الهياكل الاستثمارية والضريبية.'
                ) !!}
            </div>
            <!-- Mobile image placeholder moved under the paragraph -->
            <div class="block px-4 md:hidden mt-4">
                @if(isset($serviceData['wealth_mobile_image']) && $serviceData['wealth_mobile_image'])
                    <img loading="lazy" src="{{ asset('storage/' . $serviceData['wealth_mobile_image']) }}" alt="Wealth Planning Mobile" class="w-full h-auto rounded-lg" />
                @elseif(isset($serviceData['wealth_image']) && $serviceData['wealth_image'])
                    <img loading="lazy" src="{{ asset('storage/' . $serviceData['wealth_image']) }}" alt="Wealth Planning Mobile" class="w-full h-auto rounded-lg" />
                @else
                    <img loading="lazy" src="{{ asset('design/images/wealth-planning.png') }}" alt="Wealth Planning Mobile" class="w-full h-auto rounded-lg" />
                @endif
            </div>
            <div class="hidden md:block {{ $textAlignment }}">
                <a href="{{ $normalizeLink($serviceData['wealth_link'] ?? null, '/wealth-planning-services') }}" class="bg-[#D4AF37] mt-6 text-white px-12 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">
                    {{ $localize($serviceData['wealth_read_more_text_en'] ?? 'READ MORE', $serviceData['wealth_read_more_text_ar'] ?? 'اقرأ المزيد') }}
                </a>
            </div>
        </div>
        <!-- Mobile button at the bottom -->
        <div class="w-full flex justify-center md:hidden mt-6">
            <a href="{{ $normalizeLink($serviceData['wealth_link'] ?? null, '/wealth-planning-services') }}" class="bg-[#D4AF37] text-white px-12 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">
                {{ $localize($serviceData['wealth_read_more_text_en'] ?? 'READ MORE', $serviceData['wealth_read_more_text_ar'] ?? 'اقرأ المزيد') }}
            </a>
        </div>
    </div>
</section>
@endif

<!-- Strategic Investment Advisory Section -->
@if($servicesPage?->isSectionVisible('investment') ?? true)
<section id="section-3" class="relative py-16">
    <!-- Background image -->
    <div class="absolute inset-0">
        <!-- Desktop background -->
        @if(isset($serviceData['investment_background']) && $serviceData['investment_background'])
            <img loading="lazy" src="{{ asset('storage/' . $serviceData['investment_background']) }}" alt="Investment Advisory Background" class="hidden md:block w-full h-full object-cover">
        @else
            <img loading="lazy" src="{{ asset('design/images/investment-bg.png') }}" alt="Investment Advisory Background" class="hidden md:block w-full h-full object-cover">
        @endif
        <!-- Mobile background -->
        @if(isset($serviceData['investment_mobile_background']) && $serviceData['investment_mobile_background'])
            <img loading="lazy" src="{{ asset('storage/' . $serviceData['investment_mobile_background']) }}" alt="Investment Advisory Background Mobile" class="block md:hidden w-full h-full object-cover">
        @else
            <img loading="lazy" src="{{ asset('design/images/investment-bg.png') }}" alt="Investment Advisory Background Mobile" class="block md:hidden w-full h-full object-cover">
        @endif
    </div>
    <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto md:px-4 relative flex flex-col {{ $flexDirectionClass }} items-center gap-8">
        <div class="w-full pr-0 {{ $sectionColumnPadding }} md:pt-12">
            <h2 class="text-3xl md:text-[48px] md:leading-[62px] font-neue-extrabold text-[#041B44] mb-3 {{ $primaryHeadingAlignment }}">
                {!! $getContent('investment_title', 'STRATEGIC INVESTMENT ADVISORY', 'الاستشارات الاستثمارية الاستراتيجية') !!}
            </h2>
            <div class="investment-description px-[10px] md:px-0 text-[18px] md:mt-6 mb-12 mt-10 font-['Poppins'] font-regular md:max-w-[80%] mx-auto md:mx-0 {{ $primaryParagraphAlignment }}" style="color: #041B44 !important;">
                {!! $getContent(
                    'investment_description',
                    'We provide data-driven investment strategies that align with your long-term goals, ensuring optimal asset allocation, risk management, and performance tracking for sustainable capital growth.',
                    'نقدم استراتيجيات استثمارية قائمة على البيانات تتماشى مع أهدافك طويلة المدى، وتضمن توزيعاً مثالياً للأصول وإدارة فعالة للمخاطر ومراقبة مستمرة للأداء لتحقيق نمو مستدام في رأس المال.'
                ) !!}
            </div>
            <!-- Mobile image placeholder moved under the paragraph -->
            <div class="block px-4 md:hidden mt-4">
                @if(isset($serviceData['investment_mobile_image']) && $serviceData['investment_mobile_image'])
                    <img loading="lazy" src="{{ asset('storage/' . $serviceData['investment_mobile_image']) }}" alt="Investment Advisory Mobile" class="w-full h-auto rounded-lg" />
                @elseif(isset($serviceData['investment_image']) && $serviceData['investment_image'])
                    <img loading="lazy" src="{{ asset('storage/' . $serviceData['investment_image']) }}" alt="Investment Advisory Mobile" class="w-full h-auto rounded-lg" />
                @else
                    <img loading="lazy" src="{{ asset('design/images/stratigic.png') }}" alt="Investment Advisory Mobile" class="w-full h-auto rounded-lg" />
                @endif
            </div>
            <div class="hidden md:block {{ $textAlignment }}">
                <a href="{{ $normalizeLink($serviceData['investment_link'] ?? null, '/investment-services') }}" class="bg-[#D4AF37] mt-6 text-white px-12 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">
                    {{ $localize($serviceData['investment_read_more_text_en'] ?? 'READ MORE', $serviceData['investment_read_more_text_ar'] ?? 'اقرأ المزيد') }}
                </a>
            </div>
        </div>
        
        <!-- Right side - Image -->
        <div class="w-full md:w-1/2 flex justify-center {{ $imageJustifyClass }} hidden md:block">
            @if(isset($serviceData['investment_image']) && $serviceData['investment_image'])
                <img loading="lazy" src="{{ asset('storage/' . $serviceData['investment_image']) }}" alt="Investment Advisory" class="w-full max-w-md">
            @else
                <img loading="lazy" src="{{ asset('design/images/stratigic.png') }}" alt="Investment Advisory" class="w-full max-w-md">
            @endif
        </div>
    </div>
    
    <!-- Mobile button at the bottom -->
    <div class="w-full flex justify-center md:hidden mt-8 mb-8 px-4 relative z-10">
        <a href="{{ $normalizeLink($serviceData['investment_link'] ?? null, '/investment-services') }}" class="bg-[#D4AF37] text-white px-12 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">
            {{ $localize($serviceData['investment_read_more_text_en'] ?? 'READ MORE', $serviceData['investment_read_more_text_ar'] ?? 'اقرأ المزيد') }}
        </a>
    </div>
</section>
@endif

<!-- CIO Office Services Section -->
@if($servicesPage?->isSectionVisible('cio') ?? true)
<section id="section-4" class="relative py-16">
    <!-- Background image -->
    <div class="absolute inset-0">
        <!-- Desktop background -->
        @if(isset($serviceData['cio_background']) && $serviceData['cio_background'])
            <img loading="lazy" src="{{ asset('storage/' . $serviceData['cio_background']) }}" alt="Governance Advisory Background" class="hidden md:block w-full h-full object-cover">
        @else
            <img loading="lazy" src="{{ asset('design/images/wealth-bg.png') }}" alt="Governance Advisory Background" class="hidden md:block w-full h-full object-cover">
        @endif
        <!-- Mobile background -->
        @if(isset($serviceData['cio_mobile_background']) && $serviceData['cio_mobile_background'])
            <img loading="lazy" src="{{ asset('storage/' . $serviceData['cio_mobile_background']) }}" alt="Governance Advisory Background Mobile" class="block md:hidden w-full h-full object-cover">
        @else
            <img loading="lazy" src="{{ asset('design/images/mobile-wealth-bg.png') }}" alt="Governance Advisory Background Mobile" class="block md:hidden w-full h-full object-cover">
        @endif
    </div>
    <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto md:px-4 relative flex flex-col {{ $flexDirectionClass }} items-center gap-8">
        <div class="w-full md:w-[70%] relative hidden md:block">
            <!-- Desktop image placeholder -->
            <div class="hidden md:block">
                @if(isset($serviceData['cio_image']) && $serviceData['cio_image'])
                    <img loading="lazy" src="{{ asset('storage/' . $serviceData['cio_image']) }}" alt="Senior Advisor" class="w-[350px] max-w-full h-auto rounded-lg" />
                @else
                    <img loading="lazy" src="{{ asset('design/images/cio.png') }}" alt="Senior Advisor" class="w-[350px] max-w-full h-auto rounded-lg" />
                @endif
            </div>
        </div>
        <div class="w-full pr-0 {{ $sectionColumnPadding }} md:pt-12">
            <h2 class="text-3xl md:text-[48px] md:leading-[62px] font-neue-extrabold text-[#E9E9E9] mb-3 {{ $primaryHeadingAlignment }}">
                {{ $getContent('cio_title', 'CIO OFFICE SERVICES', 'خدمات مكتب الاستثمار الرئيسي') }}
            </h2>
            <div class="cio-description px-[10px] md:px-0 text-[18px] md:mt-6 mb-12 mt-10 font-['Poppins'] font-regular md:max-w-[80%] mx-auto md:mx-0 {{ $primaryParagraphAlignment }}" style="color: #FFFFFF !important;">
                {!! $getContent(
                    'cio_description',
                    'Our outsourced CIO services offer institutional-grade portfolio management, helping organizations enhance efficiency, maintain governance, and implement robust performance monitoring frameworks.',
                    'توفر خدمات مكتب الاستثمار الرئيسي المخصصة لدينا إدارة محافظ بمستوى مؤسسي، وتساعد المؤسسات على تعزيز الكفاءة والحفاظ على الحوكمة وتطبيق أطر متقدمة لمراقبة الأداء.'
                ) !!}
            </div>
            <!-- Mobile image placeholder moved under the paragraph -->
            <div class="block px-4 md:hidden mt-4">
                @if(isset($serviceData['cio_mobile_image']) && $serviceData['cio_mobile_image'])
                    <img loading="lazy" src="{{ asset('storage/' . $serviceData['cio_mobile_image']) }}" alt="Senior Advisor Mobile" class="w-full h-auto rounded-lg" />
                @elseif(isset($serviceData['cio_image']) && $serviceData['cio_image'])
                    <img loading="lazy" src="{{ asset('storage/' . $serviceData['cio_image']) }}" alt="Senior Advisor Mobile" class="w-full h-auto rounded-lg" />
                @else
                    <img loading="lazy" src="{{ asset('design/images/cio.png') }}" alt="Senior Advisor Mobile" class="w-full h-auto rounded-lg" />
                @endif
            </div>
            <div class="hidden md:block {{ $textAlignment }}">
                <a href="{{ $normalizeLink($serviceData['cio_link'] ?? null, '/cio-services') }}" class="bg-[#D4AF37] mt-6 text-white px-12 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">
                    {{ $localize($serviceData['cio_read_more_text_en'] ?? 'READ MORE', $serviceData['cio_read_more_text_ar'] ?? 'اقرأ المزيد') }}
                </a>
            </div>
        </div>
        <!-- Mobile button at the bottom -->
        <div class="w-full flex justify-center md:hidden mt-6">
        <a href="{{ $normalizeLink($serviceData['cio_link'] ?? null, '/cio-services') }}" class="bg-[#D4AF37] text-white px-12 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">
            {{ $localize($serviceData['cio_read_more_text_en'] ?? 'READ MORE', $serviceData['cio_read_more_text_ar'] ?? 'اقرأ المزيد') }}
        </a>
        </div>
    </div>
</section> 
@endif

<!-- Roadmap Section -->
@if(($servicesPage?->isSectionVisible('roadmap') ?? true) && (isset($serviceData['roadmap_title_en']) || isset($serviceData['roadmap_steps'])))
<section class="bg-[#E9E9E9] text-center md:py-[100px] p-10">
    <h2 class="text-[25px] md:text-[48px] font-neue-extrabold md:leading-[62px] text-[#041B44] mb-16 md:mb-32 leading-[48px]">
        {{ $getContent('roadmap_title', "CLIENT'S ROAD MAP", 'خارطة طريق العميل') }}
    </h2>
    
    <!-- Desktop version - hidden on mobile -->
    <div class="hidden md:grid w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto grid-cols-4 lg:grid-cols-8 gap-y-2 gap-x-2 justify-items-center">
        @if(isset($serviceData['roadmap_steps']) && is_array($serviceData['roadmap_steps']))
            @foreach($serviceData['roadmap_steps'] as $index => $step)
                <div class="flex flex-col items-center">
                    <div class="bg-blue-900 text-white rounded-full w-32 h-[110px] flex items-center justify-center mb-4">
                        @if(isset($step['icon']) && $step['icon'])
                            <img loading="lazy" src="{{ asset('storage/' . $step['icon']) }}" alt="icon" class="" />
                        @else
                            <img loading="lazy" src="{{ asset('design/images/journey-logo' . ($index + 1) . '.svg') }}" alt="icon" class="" />
                        @endif
                    </div>
                    <div class="h-[{{ $index % 2 == 0 ? '73' : '183' }}px] w-[2px] bg-[#041B44] mb-2"></div>
                    <p class="text-[25px] text-[#041B44] text-center font-['Poppins'] font-medium leading-[34px] whitespace-wrap">
                        {!! $localize($step['title_en'] ?? null, $step['title_ar'] ?? null) ?? $localize('Step ' . ($index + 1), 'الخطوة ' . ($index + 1)) !!}
                    </p>
                </div>
            @endforeach
        @else
            <!-- Fallback steps with exact styling from your code -->
            <div class="flex flex-col items-center">
                <div class="bg-blue-900 text-white rounded-full w-32 h-[110px] flex items-center justify-center mb-4">
                    <img loading="lazy" src="{{ asset('design/images/journey-logo1.svg') }}" alt="icon" class="" />
                </div>
                <div class="h-[73px] w-[2px] bg-[#041B44] mb-2"></div>
                <p class="text-[25px] text-gray-800 text-center font-['Poppins'] font-medium leading-[34px] whitespace-wrap">Strategic <br/> Decision</p>
            </div>
        
            <div class="flex flex-col items-center">
                <div class="bg-blue-900 text-white rounded-full w-32 h-[110px] flex items-center justify-center mb-4">
                    <img loading="lazy" src="{{ asset('design/images/journey-logo2.svg') }}" alt="icon" class="" />
                </div>
                <div class="h-[183px] w-[2px] bg-[#041B44] mb-2"></div>
                <p class="text-[25px] text-[#041B44] text-center font-['Poppins'] font-medium leading-[34px] whitespace-wrap">Governance</p>
            </div>
        
            <div class="flex flex-col items-center">
                <div class="bg-blue-900 text-white rounded-full w-32 h-[110px] flex items-center justify-center mb-4">
                    <img loading="lazy" src="{{ asset('design/images/journey-logo3.svg') }}" alt="icon" class="" />
                </div>
                <div class="h-[73px] w-[2px] bg-[#041B44] mb-2"></div>
                <p class="text-[25px] text-[#041B44] text-center font-['Poppins'] font-medium leading-[34px] whitespace-wrap">Current portfolio<br/>analysis</p>
            </div>
        
            <div class="flex flex-col items-center">
                <div class="bg-blue-900 text-white rounded-full w-32 h-[110px] flex items-center justify-center mb-4">
                    <img loading="lazy" src="{{ asset('design/images/journey-logo4.svg') }}" alt="icon" class="" />
                </div>
                <div class="h-[183px] w-[2px] bg-[#041B44] mb-2"></div>
                <p class="text-[25px] text-[#041B44] text-center font-['Poppins'] font-medium leading-[34px] whitespace-wrap">Investment Policy<br/> Statement</p>
            </div>
        
            <div class="flex flex-col items-center">
                <div class="bg-blue-900 text-white rounded-full w-32 h-[110px] flex items-center justify-center mb-4">
                    <img loading="lazy" src="{{ asset('design/images/journey-logo5.svg') }}" alt="icon" class="" />
                </div>
                <div class="h-[73px] w-[2px] bg-[#041B44] mb-2"></div>
                <p class="text-[25px] text-[#041B44] text-center font-['Poppins'] font-medium leading-[34px] whitespace-wrap">Investment<br/>Implementation</p>
            </div>
        
            <div class="flex flex-col items-center">
                <div class="bg-blue-900 text-white rounded-full w-32 h-[110px] flex items-center justify-center mb-4">
                    <img loading="lazy" src="{{ asset('design/images/journey-logo6.svg') }}" alt="icon" class="" />
                </div>
                <div class="h-[183px] w-[2px] bg-[#041B44] mb-2"></div>
                <p class="text-[25px] text-[#041B44] text-center font-['Poppins'] font-medium leading-[34px] whitespace-wrap">Investment<br/>Structure</p>
            </div>
        
            <div class="flex flex-col items-center">
                <div class="bg-blue-900 text-white rounded-full w-32 h-[110px] flex items-center justify-center mb-4">
                    <img loading="lazy" src="{{ asset('design/images/journey-logo7.svg') }}" alt="icon" class="" />
                </div>
                <div class="h-[73px] w-[2px] bg-[#041B44] mb-2"></div>
                <p class="text-[25px] text-[#041B44] text-center font-['Poppins'] font-medium leading-[34px] whitespace-wrap">Mangers Search<br/>& Selection</p>
            </div>
        
            <div class="flex flex-col items-center">
                <div class="bg-blue-900 text-white rounded-full w-32 h-[110px] flex items-center justify-center mb-4">
                    <img loading="lazy" src="{{ asset('design/images/journey-logo8.svg') }}" alt="icon" class="" />
                </div>
                <div class="h-[183px] w-[2px] bg-[#041B44] mb-2"></div>
                <p class="text-[25px] text-[#041B44] text-center font-['Poppins'] font-medium leading-[34px] whitespace-wrap">Monitoring<br/>Performance</p>
            </div>
        @endif
    </div>
    
    <!-- Mobile version - only shows image -->
    <div class="md:hidden mx-auto mb-8">
        @if(isset($serviceData['roadmap_mobile_image']) && $serviceData['roadmap_mobile_image'])
            <img loading="lazy" src="{{ asset('storage/' . $serviceData['roadmap_mobile_image']) }}" alt="Journey Map" class="w-full mx-auto" />
        @else
            <img loading="lazy" src="{{ asset('design/images/mobile.map.jpg') }}" alt="Journey Map" class="w-full mx-auto" />
        @endif
    </div>
</section>
@endif

<!-- CTA Section -->
@if($servicesPage?->isSectionVisible('cta') ?? true)
@include('partials.cta-section', [
    'backgroundImage' => isset($serviceData['cta_background_image']) && $serviceData['cta_background_image']
        ? asset('storage/' . $serviceData['cta_background_image'])
        : asset('design/images/meeting-bg.png'),
    'backgroundAlt' => strip_tags($getContent('cta_title', 'READY TO START GROWING?!', 'هل أنت مستعد للبدء في النمو؟')),
    'titleHtml' => $getContent('cta_title', 'READY TO<br/>START GROWING?!', 'هل أنت مستعد للبدء في النمو؟'),
    'descriptionHtml' => $getContent('cta_subtitle', 'Unlock the full potential of your wealth', 'اطلق العنان للإمكانات الكاملة لثروتك'),
    'buttonOneText' => $getContent('cta_button_1_text', 'JOIN OUR MAILING LIST', 'انضم إلى قائمتنا البريدية'),
    'buttonOneUrl' => isset($serviceData['cta_button_1_url']) ? $serviceData['cta_button_1_url'] : '#',
    'buttonTwoText' => $getContent('cta_button_2_text', 'REQUEST A MEETING', 'اطلب اجتماعاً'),
    'buttonTwoUrl' => isset($serviceData['cta_button_2_url']) ? $serviceData['cta_button_2_url'] : '#',
])
@endif

<!-- Custom CSS for Text Color Fix -->
<style>
.wealth-description, .cio-description {
    color: #FFFFFF !important;
}

.governance-description, .investment-description {
    color: #041B44 !important;
}

.wealth-description *, .cio-description * {
    color: #FFFFFF !important;
}

.governance-description *, .investment-description * {
    color: #041B44 !important;
}

.wealth-description p, .cio-description p {
    color: #FFFFFF !important;
    margin: 0 !important;
    padding: 0 !important;
}

.governance-description p, .investment-description p {
    color: #041B44 !important;
    margin: 0 !important;
    padding: 0 !important;
}
</style>

<!-- Smooth Scrolling JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle smooth scrolling for section links
    const scrollLinks = document.querySelectorAll('.scroll-to-section');
    
    scrollLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            
            if (targetSection) {
                // Calculate offset to account for fixed header
                const headerHeight = 80; // Adjust this value based on your header height
                const targetPosition = targetSection.offsetTop - headerHeight;
                
                // Smooth scroll to target section
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>
</div>
@endsection
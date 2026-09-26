@extends('app')

@section('content')
    @php
        $localize = $localize ?? function ($en, $ar) {
            return app()->getLocale() === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
        };
        $isArabic = app()->getLocale() === 'ar';
        $normalizeLink = $normalizeLink ?? function ($value, $fallback = '#') {
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

            return '/' . ltrim($value, '/');
        };
        $defaultHeroSlides = [
            [
                'title_en' => 'YOUR WEALTH JOURNEY PARTNERS',
                'title_ar' => null,
                'subtitle_en' => 'Invest smartly, grow steadily, and live confidently. Learn more about how we can help you achieve financial success.',
                'subtitle_ar' => null,
                'button_text_en' => 'LEARN MORE',
                'button_text_ar' => null,
                'button_link' => 'about-us#who-we-are-section',
                'image' => null,
                'image_alt_en' => 'Hero slide 1 background',
                'image_alt_ar' => 'خلفية الشريحة الأولى',
                'fallback_image' => 'design/images/hero1.png',
            ],
            [
                'title_en' => 'TAILORED PROGRAM FOR GROWING YOUR WEALTH',
                'title_ar' => null,
                'subtitle_en' => 'Invest smartly, grow steadily, and live confidently. Learn more about how we can help you succeed.',
                'subtitle_ar' => null,
                'button_text_en' => 'LEARN MORE',
                'button_text_ar' => null,
                'button_link' => 'resource-center',
                'image' => null,
                'image_alt_en' => 'Hero slide 2 background',
                'image_alt_ar' => 'خلفية الشريحة الثانية',
                'fallback_image' => 'design/images/hero2.png',
            ],
            [
                'title_en' => 'SECURE AND EXPAND YOUR WEALTH',
                'title_ar' => null,
                'subtitle_en' => 'Invest smartly, grow steadily, and live confidently. Learn more about how we can help you achieve financial success.',
                'subtitle_ar' => null,
                'button_text_en' => 'LEARN MORE',
                'button_text_ar' => null,
                'button_link' => 'services',
                'image' => null,
                'image_alt_en' => 'Hero slide 3 background',
                'image_alt_ar' => 'خلفية الشريحة الثالثة',
                'fallback_image' => 'design/images/hero3.png',
            ],
        ];
        $legacyHeroSlides = collect([1, 2, 3])->map(function ($index) use ($homeData) {
            if (! $homeData) {
                return null;
            }

            return [
                'title_en' => $homeData->{"hero_slide_{$index}_title_en"} ?? null,
                'title_ar' => $homeData->{"hero_slide_{$index}_title_ar"} ?? null,
                'subtitle_en' => $homeData->{"hero_slide_{$index}_subtitle_en"} ?? null,
                'subtitle_ar' => $homeData->{"hero_slide_{$index}_subtitle_ar"} ?? null,
                'button_text_en' => $homeData->{"hero_slide_{$index}_button_text_en"} ?? null,
                'button_text_ar' => $homeData->{"hero_slide_{$index}_button_text_ar"} ?? null,
                'button_link' => $homeData->{"hero_slide_{$index}_button_link"} ?? null,
                'image' => $homeData->{"hero_slide_{$index}_image"} ?? null,
                'image_alt_en' => $homeData->{"hero_slide_{$index}_image_alt_en"} ?? null,
                'image_alt_ar' => $homeData->{"hero_slide_{$index}_image_alt_ar"} ?? null,
            ];
        })->filter(function ($slide) {
            return $slide && collect($slide)->filter(fn ($value) => filled($value))->isNotEmpty();
        })->values();
        $heroSlides = collect($homeData?->hero_slides ?? [])
            ->filter(fn ($slide) => is_array($slide) && collect($slide)->filter(fn ($value) => filled($value))->isNotEmpty())
            ->values();

        if ($heroSlides->isEmpty()) {
            $heroSlides = $legacyHeroSlides;
        }

        if ($heroSlides->isEmpty()) {
            $heroSlides = collect($defaultHeroSlides);
        }

        $heroSlideCount = max($heroSlides->count(), 1);
    @endphp

    <style>
        .home-responsive .home-insights [role="img"] {
            width: 100%;
            background-size: contain !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
        }

        @media (max-width: 767px) {
            .home-responsive section {
                padding-top: 4rem !important;
                padding-bottom: 4rem !important;
            }

            .home-responsive .home-hero {
                height: 82vh !important;
                min-height: 560px;
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }

            .home-responsive .home-hero h1 {
                font-size: 2.75rem !important;
                line-height: 1.08 !important;
            }

            .home-responsive .home-hero [class*="text-[1.0625rem]"] {
                font-size: 1rem !important;
                line-height: 1.6 !important;
            }

            .home-responsive h2 {
                font-size: 2rem !important;
                line-height: 1.2 !important;
            }

            .home-responsive p,
            .home-responsive [class*="Poppins"] {
                line-height: 1.65;
            }

            .home-responsive .service-btn {
                min-height: 6rem !important;
                height: auto !important;
                padding: 1rem !important;
                font-size: 0.95rem !important;
            }

            .home-responsive [id="mobileServiceContent"] > div {
                height: 16rem !important;
            }

            .home-responsive .home-diversified {
                height: auto !important;
                min-height: 0 !important;
            }

            .home-responsive .home-diversified [class*="lg:hidden"].grid {
                gap: 0.75rem !important;
            }

            .home-responsive .home-diversified [class*="lg:hidden"].grid > div {
                padding: 0.75rem !important;
            }

            .home-responsive .home-directors [class*="w-[15rem]"] {
                width: 13rem !important;
                height: 17rem !important;
            }

            .home-responsive #metrics-slider [class*="w-[9.375rem]"] {
                width: 7rem !important;
                height: 7rem !important;
            }

            .home-responsive .home-roadmap h2 {
                margin-bottom: 2.5rem !important;
            }

            .home-responsive .home-cta {
                min-height: 520px;
                align-items: center !important;
            }

            .home-responsive .home-cta .flex {
                gap: 1.25rem !important;
            }
        }

        @media (min-width: 768px) and (max-width: 1023px) {
            .home-responsive [class*="md:max-w-[950px]"],
            .home-responsive [class*="md:max-w-[1000px]"] {
                max-width: 720px !important;
                padding-left: 1.5rem !important;
                padding-right: 1.5rem !important;
            }

            .home-responsive section {
                padding-top: 4.5rem !important;
                padding-bottom: 4.5rem !important;
            }

            .home-responsive .home-hero {
                height: 72vh !important;
                min-height: 560px;
                max-height: 700px;
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }

            .home-responsive .home-hero h1 {
                font-size: 3.5rem !important;
                line-height: 1.08 !important;
            }

            .home-responsive .home-hero .hero-slide > div:last-child {
                padding-inline: 1.5rem;
            }

            .home-responsive h2 {
                font-size: 2.625rem !important;
                line-height: 1.15 !important;
            }

            .home-responsive .service-btn {
                min-height: 7rem !important;
                height: auto !important;
                padding: 1.25rem !important;
                font-size: 1.05rem !important;
            }

            .home-responsive [id="mobileServiceContent"] > div {
                height: 22rem !important;
            }

            .home-responsive .home-diversified {
                height: auto !important;
                min-height: 0 !important;
            }

            .home-responsive .home-diversified > div > div {
                gap: 2.5rem !important;
            }

            .home-responsive .home-diversified [class*="lg:hidden"].grid {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 1rem !important;
            }

            .home-responsive .home-diversified [class*="lg:hidden"].grid > div {
                padding: 1rem !important;
            }

            .home-responsive .home-diversified [class*="lg:hidden"].grid h3 {
                font-size: 1rem !important;
                line-height: 1.35 !important;
            }

            .home-responsive .home-directors [class*="md:grid-cols-3"] {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 2rem !important;
            }

            .home-responsive .home-directors [class*="w-[17.5rem]"] {
                width: 14rem !important;
                height: 19rem !important;
            }

            .home-responsive .home-track-record {
                padding-top: 5rem !important;
            }

            .home-responsive #metrics-slider [class*="md:w-1/4"] {
                width: 33.333% !important;
            }

            .home-responsive #metrics-slider [class*="w-[9.375rem]"] {
                width: 7.5rem !important;
                height: 7.5rem !important;
            }

            .home-responsive #metrics-slider [class*="text-[1.24rem]"] {
                font-size: 0.95rem !important;
                line-height: 1.35 !important;
            }

            .home-responsive .home-roadmap h2 {
                margin-bottom: 3rem !important;
            }

            .home-responsive .home-roadmap .hidden.md\:grid {
                grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
                row-gap: 2rem !important;
            }

            .home-responsive .home-roadmap .hidden.md\:grid [class*="w-32"] {
                width: 5.5rem !important;
            }

            .home-responsive .home-roadmap .hidden.md\:grid [class*="text-[1.5625rem]"] {
                font-size: 1rem !important;
                line-height: 1.35 !important;
            }

            .home-responsive .home-roadmap .hidden.md\:grid [class*="h-[11.4375rem]"] {
                height: 6rem !important;
            }

            .home-responsive .home-roadmap .hidden.md\:grid [class*="h-[4.5625rem]"] {
                height: 4rem !important;
            }

            .home-responsive .home-insights .grid {
                gap: 2rem !important;
                padding-inline: 0 !important;
            }

            .home-responsive .home-insights [class*="min-h-[360px]"] {
                min-height: 300px !important;
            }

            .home-responsive .home-cta {
                min-height: 520px;
                height: auto !important;
                align-items: center !important;
            }

            .home-responsive .home-cta h2 {
                font-size: 2.75rem !important;
            }

            .home-responsive .home-cta a {
                font-size: 0.95rem !important;
                padding: 0.875rem 1.5rem !important;
            }
        }

        @media (min-width: 1024px) and (max-width: 1279px) {
            .home-responsive [class*="md:max-w-[950px]"],
            .home-responsive [class*="md:max-w-[1000px]"] {
                max-width: 980px !important;
                padding-left: 2rem !important;
                padding-right: 2rem !important;
            }

            .home-responsive .home-hero {
                height: 74vh !important;
                min-height: 600px;
                max-height: 780px;
            }

            .home-responsive .home-hero h1 {
                font-size: 4rem !important;
                line-height: 1.08 !important;
            }

            .home-responsive section {
                padding-top: 5rem !important;
                padding-bottom: 5rem !important;
            }

            .home-responsive h2 {
                font-size: 2.75rem !important;
                line-height: 1.18 !important;
            }

            .home-responsive .service-btn {
                min-height: 8rem !important;
                height: auto !important;
                padding: 1.5rem !important;
                font-size: 1.15rem !important;
            }

            .home-responsive [id="serviceContent"] {
                height: 34rem !important;
            }

            .home-responsive .home-diversified {
                height: auto !important;
                min-height: 720px;
            }

            .home-responsive .home-diversified [class*="w-[4rem]"] {
                width: 3rem !important;
                height: 3rem !important;
            }

            .home-responsive .home-diversified span {
                font-size: 1rem !important;
            }

            .home-responsive .home-directors [class*="w-[17.5rem]"] {
                width: 13.5rem !important;
                height: 18.5rem !important;
            }

            .home-responsive #metrics-slider [class*="w-[9.375rem]"] {
                width: 8rem !important;
                height: 8rem !important;
            }

            .home-responsive #metrics-slider [class*="text-[1.24rem]"] {
                font-size: 1rem !important;
            }

            .home-responsive .home-roadmap .hidden.md\:grid [class*="w-32"] {
                width: 6rem !important;
            }

            .home-responsive .home-roadmap .hidden.md\:grid [class*="text-[1.5625rem]"] {
                font-size: 1.05rem !important;
                line-height: 1.35 !important;
            }

            .home-responsive .home-cta {
                min-height: 520px;
                height: auto !important;
            }

            .home-responsive .home-cta a {
                font-size: 1rem !important;
                padding: 0.9rem 2rem !important;
            }
        }
    </style>

    <div class="home-responsive">
    @if($homeData?->isSectionVisible('hero') ?? true)
    <!-- Hero Section -->
    <section class="home-hero bg-navy-900 text-white h-screen relative">
        <!-- Slider container -->
        <div class="relative overflow-hidden h-full">
            <!-- Slide content wrapper -->
            <div class="flex flex-col h-full">
                <!-- Slides -->
                <div class="flex transition-transform duration-500 ease-in-out h-full" id="slider" style="width: {{ $heroSlideCount * 100 }}%;">
                    @foreach($heroSlides as $index => $slide)
                        @php
                            $defaultSlide = $defaultHeroSlides[$index % count($defaultHeroSlides)];
                            $slideTitle = $localize($slide['title_en'] ?? null, $slide['title_ar'] ?? null) ?? $defaultSlide['title_en'];
                            $slideSubtitle = $localize($slide['subtitle_en'] ?? null, $slide['subtitle_ar'] ?? null) ?? $defaultSlide['subtitle_en'];
                            $slideButtonText = $localize($slide['button_text_en'] ?? null, $slide['button_text_ar'] ?? null) ?? $defaultSlide['button_text_en'];
                            $slideImage = ! empty($slide['image'])
                                ? asset('storage/' . $slide['image'])
                                : asset($defaultSlide['fallback_image']);
                            $slideImageAlt = $localize($slide['image_alt_en'] ?? null, $slide['image_alt_ar'] ?? null) ?? $defaultSlide['image_alt_en'];
                            $slideButtonLink = $normalizeLink($slide['button_link'] ?? null, $normalizeLink($defaultSlide['button_link'] ?? null, '#'));
                        @endphp
                        <div class="hero-slide flex-shrink-0 relative" style="width: {{ 100 / $heroSlideCount }}%;">
                            <div class="absolute inset-0">
                                <img src="{{ $slideImage }}" alt="{{ $slideImageAlt }}" class="w-full h-full object-cover"/>
                            </div>
                            <div class="absolute inset-0 "></div>
                            <div class="relative h-full flex items-center justify-center">
                                <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto text-center" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
                                    <h1 class="text-[2.1875rem] xl:text-[4.375rem] leading-[3.35625rem] xl:leading-[5.4375rem] font-neue-extrabold mb-4">
                                        {{ $slideTitle }}
                                    </h1>
                                    <div class="mb-8 text-[1.0625rem] xl:text-[1.125rem] text-[#FFFFFF] opacity-70 font-['Poppins'] font-regular">
                                        {!! $slideSubtitle !!}
                                    </div>
                                    <a href="{{ $slideButtonLink }}" class="bg-[#D4AF37] px-6 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[1.125rem] inline-block">
                                        {{ $slideButtonText }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Mobile Navigation (Dots and Arrows) -->
                <div class="lg:hidden absolute px-4 pb-10 bottom-8 w-full">
                    <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4 flex items-center justify-between desktop-reverse-flex">
                        <!-- Dots on the left -->
                        <div class="flex space-x-2 desktop-reverse-flex">
                            @foreach($heroSlides as $index => $slide)
                                <button class="mobile-dot w-4 h-4 rounded-full bg-gray-400 hover:bg-[#D4AF37]" onclick="goToSlide({{ $index }})"></button>
                            @endforeach
                        </div>
                        <!-- Arrows on the right -->
                        <div class="flex items-center space-x-6 desktop-reverse-flex">
                            <button class="hover:opacity-75" onclick="moveSlide(-1)">
                                <i class="fas fa-chevron-left text-[#FFFFFF] text-3xl"></i>
                            </button>
                            <button class="hover:opacity-75" onclick="moveSlide(1)">
                                <i class="fas fa-chevron-right text-[#FFFFFF] text-3xl"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:block">
                    <!-- Navigation Buttons -->
                    <button class="absolute left-8 top-1/2 transform -translate-y-1/2 p-3 hover:opacity-75" onclick="moveSlide(-1)">
                        <i class="fas fa-chevron-left text-white text-3xl"></i>
                    </button>
                    <button class="absolute right-8 top-1/2 transform -translate-y-1/2 p-3 hover:opacity-75" onclick="moveSlide(1)">
                        <i class="fas fa-chevron-right text-white text-3xl"></i>
                    </button>

                    <!-- Dots -->
                    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2">
                        @foreach($heroSlides as $index => $slide)
                            <button class="desktop-dot w-3 h-3 rounded-full bg-gray-400 hover:bg-[#D4AF37]" onclick="goToSlide({{ $index }})"></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($homeData?->isSectionVisible('assist') ?? true)
    <!-- How We Can Assist Section -->
    <section class="home-assist bg-white py-8 md:py-24">
        <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4">
            <div class="flex flex-col lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16 desktop-reverse-grid">
                <!-- Left Side: Text and Service Buttons -->
                <div class="mb-8 lg:mb-0">
                    <h2 class="text-[1.875rem] xl:text-[3rem] font-neue-extrabold text-[#041B44] mb-3 md:mb-4 text-center lg:text-left leading-[2.00625rem] xl:leading-[3.875rem]">
                        {{ app()->getLocale() == 'ar' ? ($homeData->assist_title_ar ?? 'HOW WE CAN ASSIST') : ($homeData->assist_title_en ?? 'HOW WE CAN ASSIST') }}
                    </h2>
                    <div class="text-[#041B44] lg:pr-10 mb-6 md:mb-8 font-['Poppins'] tracking-[0] xl:text-[1.125rem] text-[1rem] opacity-60 text-center lg:text-left mx-auto lg:mx-0">
                        {!! app()->getLocale() == 'ar' ? ($homeData->assist_description_ar ?? 'Our services are designed to help you achieve your goals and enrich your investment journey, supported by our professionals who serve as your dedicated investment office.') : ($homeData->assist_description_en ?? 'Our services are designed to help you achieve your goals and enrich your investment journey, supported by our professionals who serve as your dedicated investment office.') !!}
                    </div>

                    <!-- Our Services Button (desktop only) -->
                    <button onclick="window.location.href='{{ $homeData->assist_button_link ? (str_starts_with($homeData->assist_button_link, 'http') ? $homeData->assist_button_link : route($homeData->assist_button_link)) : route('services') }}'" class="hidden lg:block bg-[#D4AF37] text-white px-6 md:px-8 py-2 md:py-3 rounded-lg mb-8 md:py-3 rounded-lg mb-8 md:mb-12 font-neue-extrabold xl:text-[1.125rem] btn-rtl-align">
                        {{ app()->getLocale() == 'ar' ? ($homeData->assist_button_text_ar ?? 'خدماتنا') : ($homeData->assist_button_text_en ?? 'OUR SERVICES') }}
                    </button>

                    <!-- Mobile Image (shown only on mobile) -->
                    <div class="block lg:hidden mb-6" id="mobileServiceContent">
                        @if($homeData && $homeData->services && count($homeData->services) > 0)
                            @php $firstService = $homeData->services[0]; @endphp
                            <div class="relative w-full h-[17.5rem] rounded-[1.25rem] overflow-hidden">
                                <img id="mobile-service-image" src="{{ isset($firstService['image']) && $firstService['image'] ? asset('storage/' . $firstService['image']) : asset('design/images/assist1.png') }}" alt="{{ $firstService['title_en'] ?? 'Service' }}" class="w-full h-full object-cover"/>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <div class="flex flex-col">
                                        <div>
                                            <h3 id="mobile-service-title" class="text-lg font-neue-bold mb-2 text-white">{{ app()->getLocale() == 'ar' ? ($firstService['title_ar'] ?? $firstService['title_en'] ?? 'SERVICE') : ($firstService['title_en'] ?? 'SERVICE') }}</h3>
                                            <div id="mobile-service-description" class="text-[0.8125rem] xl:text-[1.125rem] font-['Poppins'] mb-2 text-white">{!! app()->getLocale() == 'ar' ? ($firstService['description_ar'] ?? $firstService['description_en'] ?? 'Service description') : ($firstService['description_en'] ?? 'Service description') !!}</div>
                                        </div>
                                        <div class="flex justify-end">
                                            <a id="mobile-service-link" href="{{ $firstService['link'] ?? '#' }}" class="text-[#D4AF37] font-neue-bold text-sm">{{ app()->getLocale() == 'ar' ? ($firstService['read_more_text_ar'] ?? 'اقرأ المزيد') : ($firstService['read_more_text_en'] ?? 'Read More') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="relative w-full h-[17.5rem] rounded-[1.25rem] overflow-hidden">
                                <img id="mobile-service-image" src="{{ asset('design/images/assist1.png') }}" alt="Governance Advisory" class="w-full h-full object-cover"/>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <div class="flex flex-col">
                                        <div>
                                            <h3 id="mobile-service-title" class="text-lg font-neue-bold mb-2 text-white">GOVERNANCE ADVISORY</h3>
                                            <div id="mobile-service-description" class="text-[0.8125rem] xl:text-[1.125rem] font-['Poppins'] mb-2 text-white">The investment offices and Endowment funds for HNWI, Family Offices, and Endowments</div>
                                        </div>
                                        <div class="flex justify-end">
                                            <a id="mobile-service-link" href="{{ route('governance-services') }}" class="text-[#D4AF37] font-neue-bold text-sm">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Service Buttons -->
                    <div class="grid grid-cols-2 gap-3 lg:grid-cols-2 lg:gap-4 md:gap-6 xl:gap-8 desktop-reverse-grid">
                        @if($homeData && $homeData->services)
                            @foreach($homeData->services as $index => $service)
                                <button class="service-btn bg-{{ $index === 0 ? '[#D4AF37]' : '[#1a1f2e]' }} text-white font-neue-bold p-4 lg:p-6 md:p-8 xl:p-8 rounded-lg hover:opacity-90 transition-all text-center text-[0.97125rem] lg:text-base md:text-lg xl:text-[1.875rem] h-[6.25rem] lg:h-[10rem] xl:h-[10rem] flex items-center justify-center leading-[1.2] lg:leading-[1.1]" data-index="{{ $index }}">
                                    <span>{{ app()->getLocale() == 'ar' ? ($service['title_ar'] ?? $service['title_en'] ?? 'Service ' . ($index + 1)) : ($service['title_en'] ?? 'Service ' . ($index + 1)) }}</span>
                                </button>
                            @endforeach
                        @else
                            <button class="service-btn bg-[#D4AF37] text-white font-neue-bold p-4 lg:p-6 md:p-8 xl:p-8 rounded-lg hover:opacity-90 transition-all text-center text-[0.97125rem] lg:text-base md:text-lg xl:text-[1.875rem] h-[6.25rem] lg:h-[10rem] xl:h-[10rem] flex items-center justify-center leading-[1.2] lg:leading-[1.1]" data-index="0">
                                <span>GOVERNANCE<br/>ADVISORY</span>
                            </button>
                            <button class="service-btn bg-[#1a1f2e] text-white font-neue-bold p-4 lg:p-6 md:p-8 xl:p-8 rounded-lg hover:opacity-90 transition-all text-center text-[0.97125rem] lg:text-base md:text-lg xl:text-[1.875rem] h-[6.25rem] lg:h-[10rem] xl:h-[10rem] flex items-center justify-center leading-[1.2] lg:leading-[1.1]" data-index="1">
                                <span>WEALTH<br/>PLANNING</span>
                            </button>
                            <button class="service-btn bg-[#1a1f2e] text-white font-neue-bold p-4 lg:p-6 md:p-8 xl:p-8 rounded-lg hover:opacity-90 transition-all text-center text-[0.97125rem] lg:text-base md:text-lg xl:text-[1.875rem] h-[6.25rem] lg:h-[10rem] xl:h-[10rem] flex items-center justify-center leading-[1.2] lg:leading-[1.1]" data-index="2">
                                <span>STRATEGIC<br/>INVESTMENT<br/>ADVISORY</span>
                            </button>
                            <button class="service-btn bg-[#1a1f2e] text-white font-neue-bold p-4 lg:p-6 md:p-8 xl:p-8 rounded-lg hover:opacity-90 transition-all text-center text-[0.97125rem] lg:text-base md:text-lg xl:text-[1.875rem] h-[6.25rem] lg:h-[10rem] xl:h-[10rem] flex items-center justify-center leading-[1.2] lg:leading-[1.1]" data-index="3">
                                <span>CIO OFFICE<br/>SERVICES</span>
                            </button>
                        @endif
                    </div>

                    <!-- Our Services Button (mobile only) -->
                    <button onclick="window.location.href='{{ $homeData->assist_button_link ? (str_starts_with($homeData->assist_button_link, 'http') ? $homeData->assist_button_link : route($homeData->assist_button_link)) : route('services') }}'" class="block lg:hidden bg-[#D4AF37] md:text-[1.125rem] text-white px-6 py-3 rounded-lg font-neue-extrabold text-[0.6425rem] mt-6 mx-auto">
                        {{ app()->getLocale() == 'ar' ? ($homeData->assist_button_text_ar ?? 'خدماتنا') : ($homeData->assist_button_text_en ?? 'OUR SERVICES') }}
                    </button>
                </div>

                <!-- Right Side: Image and Description -->
                <div class="hidden lg:block relative w-full h-[31.25rem] xl:h-[44.6875rem] overflow-hidden lg:mt-[-2.8125rem]" id="serviceContent">
                    <!-- Content will be dynamically inserted here by JavaScript -->
                </div>
            </div>
        </div>
    </section>
    @endif


    @if($homeData?->isSectionVisible('diversified') ?? true)
    <!-- Diversified Programs Section -->
    <section class="home-diversified bg-[#041B44] h-[150vh] md:h-[180vh] lg:h-[100vh] relative overflow-hidden flex items-center">
        <!-- Background Image -->
        <div class="absolute inset-0 hidden lg:block">
            <img src="{{ $homeData->diversified_desktop_image ? asset('storage/' . $homeData->diversified_desktop_image) : asset('design/images/diversified-bg.png') }}" alt="Pattern Background" class="w-full h-full object-cover"/>
        </div>

        <!-- Mobile Background Image -->
        <div class="absolute inset-0 block lg:hidden">
            <img src="{{ $homeData->diversified_mobile_image ? asset('storage/' . $homeData->diversified_mobile_image) : asset('design/images/mobile-diversified-bg.png') }}" alt="Pattern Background" class="w-full h-full object-cover"/>
        </div>

        <!-- Content Container -->
        <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4 relative" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
            @php
                $diversifiedHeadingAlign = $isArabic ? 'text-center lg:text-right' : 'text-center lg:text-left';
                $diversifiedBodyAlign = $isArabic ? 'text-center lg:text-right' : 'text-center lg:text-left';
                $diversifiedDesktopRow = 'flex items-center gap-4 p-4';
                $diversifiedMobileRow = 'flex items-center gap-3 p-3';
                $diversifiedButtonWrapper = $isArabic ? 'hidden lg:block w-full text-right' : 'hidden lg:block w-full text-left';
                $diversifiedButtonMobile = $isArabic ? 'block lg:hidden bg-[#D4AF37] text-[0.814375rem] text-white px-8 py-3 rounded-lg font-neue-extrabold hover:opacity-90 transition-all mt-6 ml-auto w-max' : 'block lg:hidden bg-[#D4AF37] text-[0.814375rem] text-white px-8 py-3 rounded-lg font-neue-extrabold hover:opacity-90 transition-all mt-6 mx-auto text-center';
            @endphp
            <div class="flex flex-col lg:flex-row items-center gap-8 {{ $isArabic ? 'lg:flex-row' : '' }}">
                <!-- Left Side: Text and Icons -->
                <div class="lg:w-1/2 text-white flex flex-col items-center {{ $isArabic ? 'lg:items-end' : 'lg:items-start' }}">
                    <h2 class="text-[1.25rem] md:text-[3rem] font-neue-extrabold md:leading-[3rem] mb-6 tracking-[0rem] leading-[1.99375rem] lg:leading-[3.875rem] {{ $diversifiedHeadingAlign }}">
                        {{ app()->getLocale() == 'ar' ? ($homeData->diversified_title_ar ?? 'DIVERSIFIED PROGRAMS FOR AN IDEAL PORTFOLIO') : ($homeData->diversified_title_en ?? 'DIVERSIFIED PROGRAMS FOR AN IDEAL PORTFOLIO') }}
                    </h2>
                    <div class="text-[1rem] lg:text-[1.0625rem] font-['Poppins'] tracking-[0rem] opacity-70 text-white mb-8 {{ $diversifiedBodyAlign }}">
                        {!! app()->getLocale() == 'ar' ? ($homeData->diversified_description_ar ?? 'Unlock the full potential of your wealth with our diversified programs, tailored to your unique needs. Safeguard your assets, maximize charitable impact, simplify financial complexities, and align with your values. Discover how our expertise can enhance your financial strategy and secure your future.') : ($homeData->diversified_description_en ?? 'Unlock the full potential of your wealth with our diversified programs, tailored to your unique needs. Safeguard your assets, maximize charitable impact, simplify financial complexities, and align with your values. Discover how our expertise can enhance your financial strategy and secure your future.') !!}
                    </div>

                    <!-- Button (desktop only) -->
                    <div class="{{ $diversifiedButtonWrapper }}">
                        <a href="{{ $homeData->diversified_button_link ?? 'contact-us.html' }}" class="inline-block bg-[#D4AF37] text-[1.125rem] text-white px-6 py-3 rounded-lg font-neue-extrabold hover:opacity-90 transition-all">
                            {{ app()->getLocale() == 'ar' ? ($homeData->diversified_button_text_ar ?? 'تحقق من برامجنا') : ($homeData->diversified_button_text_en ?? 'CHECK OUR PROGRAMS') }}
                        </a>
                    </div>
                </div>

                <!-- Right Side: Services Grid -->
                <div class="lg:w-1/2">
                    @if($homeData && $homeData->diversified_services && count($homeData->diversified_services) > 0)
                        <!-- Desktop Services Grid -->
                        <div class="hidden lg:grid lg:grid-cols-2 gap-6">
                            @foreach($homeData->diversified_services as $service)
                                <div class="{{ $diversifiedDesktopRow }}">
                                    <div class="flex-shrink-0">
                                        @if(isset($service['icon']) && $service['icon'])
                                            <img src="{{ asset('storage/' . $service['icon']) }}" alt="{{ $service['title_en'] ?? 'Service' }}" class="w-[4rem] h-[4rem] object-contain"/>
                                        @else
                                            <div class="w-12 h-12 bg-[#D4AF37] rounded-full flex items-center justify-center">
                                                <i class="fas fa-star text-white text-xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 {{ $isArabic ? 'text-right' : 'text-left' }}">
                                        <span class="block text-white font-['Poppins'] font-bold text-lg {{ $isArabic ? 'text-right' : 'text-left' }}">
                                            {{ app()->getLocale() == 'ar' ? ($service['title_ar'] ?? $service['title_en'] ?? 'Service') : ($service['title_en'] ?? 'Service') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Mobile Services Grid -->
                        <div class="block lg:hidden grid grid-cols-1 gap-4 mb-6">
                            @foreach($homeData->diversified_services as $service)
                                <div class="{{ $diversifiedMobileRow }}">
                                    <div class="flex-shrink-0">
                                        @if(isset($service['icon']) && $service['icon'])
                                            <img src="{{ asset('storage/' . $service['icon']) }}" alt="{{ $service['title_en'] ?? 'Service' }}" class="w-8 h-8 object-contain"/>
                                        @else
                                            <div class="w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center">
                                                <i class="fas fa-star text-white text-sm"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 {{ $isArabic ? 'text-right' : 'text-left' }}">
                                        <h3 class="text-white font-neue-bold text-sm {{ $isArabic ? 'text-right' : 'text-left' }}">
                                            {{ app()->getLocale() == 'ar' ? ($service['title_ar'] ?? $service['title_en'] ?? 'Service') : ($service['title_en'] ?? 'Service') }}
                                        </h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Fallback to original image if no services data -->
                        <div class="hidden lg:block">
                            <img src="{{ $homeData->diversified_content_desktop_image ? asset('storage/' . $homeData->diversified_content_desktop_image) : asset('design/images/diversified.png') }}" alt="Diversified Programs" class="w-full h-auto rounded-lg"/>
                        </div>
                        <div class="block lg:hidden">
                            <img src="{{ $homeData->diversified_content_mobile_image ? asset('storage/' . $homeData->diversified_content_mobile_image) : asset('design/images/mobile-diversified.png') }}" alt="Diversified Programs" class="w-full h-auto rounded-lg"/>
                        </div>
                    @endif

                    <!-- Button (mobile only) -->
                    <a href="{{ $homeData->diversified_button_link ?? 'contact-us.html' }}" class="{{ $diversifiedButtonMobile }}">
                        {{ app()->getLocale() == 'ar' ? ($homeData->diversified_button_text_ar ?? 'تحقق من برامجنا') : ($homeData->diversified_button_text_en ?? 'CHECK OUR PROGRAMS') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($homeData?->isSectionVisible('directors') ?? true)
    <!-- Board of Directors Section -->
    <section class="home-directors py-16 relative overflow-hidden bg-[#f5f5f5]">
        <!-- Background Pattern -->
        <div class="absolute inset-0">
            <img src="{{ asset('design/images/directors-bg.png') }}" alt="Pattern Background" class="w-full h-full object-cover"/>
        </div>

        <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4 relative">
            <h2 class="text-[2rem] leading-[2.09375rem] md:text-4xl xl:text-[3rem] xl:leading-[3.875rem] font-neue-extrabold text-[#041B44] mb-4 text-center md:text-center">
                {{ app()->getLocale() == 'ar' ? ($homeData->directors_title_ar ?? 'BOARD OF DIRECTORS') : ($homeData->directors_title_en ?? 'BOARD OF DIRECTORS') }}
            </h2>

            <div class="text-[#041B44] text-[1rem] md:text-[1.125rem] font-['Poppins'] tracking-[0] opacity-60 mb-12 mx-auto text-center md:text-start md:px-0">
                {!! app()->getLocale() == 'ar' ? ($homeData->directors_description_ar ?? 'Hauberk Capital offers top-tier wealth advisory services for High-Net-Worth Individuals, Family Offices, and Endowments. Our comprehensive approach encompasses governance of wealth structure, thorough planning, in-depth analysis, and development of investment policies tailored to client objectives and risk profiles. Additionally, we provide CIO office outsourcing services, acting as a dedicated investment department. We handle strategy manager selection, portfolio performance monitoring, periodic reporting, and execute rebalancing based on macroeconomic conditions, ensuring clients\' wealth journeys thrive.') : ($homeData->directors_description_en ?? 'Hauberk Capital offers top-tier wealth advisory services for High-Net-Worth Individuals, Family Offices, and Endowments. Our comprehensive approach encompasses governance of wealth structure, thorough planning, in-depth analysis, and development of investment policies tailored to client objectives and risk profiles. Additionally, we provide CIO office outsourcing services, acting as a dedicated investment department. We handle strategy manager selection, portfolio performance monitoring, periodic reporting, and execute rebalancing based on macroeconomic conditions, ensuring clients\' wealth journeys thrive.') !!}
            </div>

            <!-- Desktop View - Grid -->
            <div class="hidden md:grid md:grid-cols-3 gap-8 mt-12 desktop-reverse-grid">
                @if(isset($homeData->directors) && is_array($homeData->directors))
                    @foreach($homeData->directors as $director)
                        <div class="text-center">
                            <div class="bg-white rounded-lg overflow-hidden w-[17.5rem] h-[23.75rem] mx-auto mb-4">
                                @if(isset($director['image']) && $director['image'])
                                    <img src="{{ asset('storage/' . $director['image']) }}" alt="{{ app()->getLocale() == 'ar' ? ($director['name_ar'] ?? 'Director') : ($director['name_en'] ?? 'Director') }}" class="w-full h-full object-cover object-center">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400 text-6xl"></i>
                                    </div>
                                @endif
                            </div>
                            <p class="text-[#041B44] font-neue-bold text-xl mt-3">
                                {{ app()->getLocale() == 'ar' ? ($director['name_ar'] ?? 'Director') : ($director['name_en'] ?? 'Director') }}
                            </p>
                            <div class="text-[#041B44] opacity-70 font-['Poppins']">
                                {{ app()->getLocale() == 'ar' ? ($director['position_ar'] ?? 'Position') : ($director['position_en'] ?? 'Position') }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback to default directors if no data -->
                    <div class="text-center">
                        <div class="bg-white rounded-lg overflow-hidden w-[17.5rem] h-[23.75rem] mx-auto mb-4">
                            <img src="{{ asset('design/images/wael.png') }}" alt="Wael Fawzi" class="w-full h-full object-cover object-center">
                        </div>
                        <p class="text-[#041B44] font-neue-bold text-xl mt-3">Wael Fawzi</p>
                        <div class="text-[#041B44] opacity-70 font-['Poppins']">Managing Director</div>
                    </div>
                    <div class="text-center">
                        <div class="bg-white rounded-lg overflow-hidden w-[17.5rem] h-[23.75rem] mx-auto mb-4">
                            <img src="{{ asset('design/images/natalia.png') }}" alt="Natalia Biryukova" class="w-full h-full object-cover object-center">
                        </div>
                        <p class="text-[#041B44] font-neue-bold text-xl mt-3">Natalia Biryukova</p>
                        <div class="text-[#041B44] opacity-70 font-['Poppins']">Director</div>
                    </div>
                    <div class="text-center">
                        <div class="bg-white rounded-lg overflow-hidden w-[17.5rem] h-[23.75rem] mx-auto mb-4">
                            <img src="{{ asset('design/images/motasem.png') }}" alt="Motesm Aggad" class="w-full h-full object-cover object-center">
                        </div>
                        <p class="text-[#041B44] font-neue-bold text-xl mt-3">Motesm Aggad</p>
                        <div class="text-[#041B44] opacity-70 font-['Poppins']">Director</div>
                    </div>
                @endif
            </div>
            <!-- Mobile View - Slider -->
            <div class="md:hidden relative mt-8">
                <div class="overflow-hidden">
                    <div id="directors-slider" class="flex transition-transform duration-300 desktop-reverse-flex">
                        @if(isset($homeData->directors) && is_array($homeData->directors))
                            @foreach($homeData->directors as $index => $director)
                                <div class="min-w-full px-4">
                                    <div class="flex flex-col items-center desktop-reverse-flex">
                                        <div class="bg-white rounded-lg overflow-hidden w-[15rem] h-[20rem] mb-4">
                                            @if(isset($director['image']) && $director['image'])
                                                <img src="{{ asset('storage/' . $director['image']) }}" alt="{{ app()->getLocale() == 'ar' ? ($director['name_ar'] ?? 'Director') : ($director['name_en'] ?? 'Director') }}" class="w-full h-full object-cover object-center">
                                            @else
                                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-400 text-4xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="text-[#041B44] font-neue-bold text-xl mt-2">
                                            {{ app()->getLocale() == 'ar' ? ($director['name_ar'] ?? 'Director') : ($director['name_en'] ?? 'Director') }}
                                        </p>
                                        <div class="text-[#041B44] opacity-70 font-['Poppins'] text-sm">
                                            {{ app()->getLocale() == 'ar' ? ($director['position_ar'] ?? 'Position') : ($director['position_en'] ?? 'Position') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Fallback to default directors if no data -->
                            <div class="min-w-full px-4">
                                <div class="flex flex-col items-center">
                                    <div class="bg-white rounded-lg overflow-hidden w-[15rem] h-[20rem] mb-4">
                                        <img src="{{ asset('design/images/wael.png') }}" alt="Wael Fawzi" class="w-full h-full object-cover object-center">
                                    </div>
                                    <p class="text-[#041B44] font-neue-bold text-xl mt-2">Wael Fawzi</p>
                                    <div class="text-[#041B44] opacity-70 font-['Poppins'] text-sm">Managing Director</div>
                                </div>
                            </div>
                            <div class="min-w-full px-4">
                                <div class="flex flex-col items-center">
                                    <div class="bg-white rounded-lg overflow-hidden w-[15rem] h-[20rem] mb-4">
                                        <img src="{{ asset('design/images/natalia.png') }}" alt="Natalia Biryukova" class="w-full h-full object-cover object-center">
                                    </div>
                                    <p class="text-[#041B44] font-neue-bold text-xl mt-2">Natalia Biryukova</p>
                                    <div class="text-[#041B44] opacity-70 font-['Poppins'] text-sm">Director</div>
                                </div>
                            </div>
                            <div class="min-w-full px-4">
                                <div class="flex flex-col items-center">
                                    <div class="bg-white rounded-lg overflow-hidden w-[15rem] h-[20rem] mb-4">
                                        <img src="{{ asset('design/images/motasem.png') }}" alt="Motesm Aggad" class="w-full h-full object-cover object-center">
                                    </div>
                                    <p class="text-[#041B44] font-neue-bold text-xl mt-2">Motesm Aggad</p>
                                    <div class="text-[#041B44] opacity-70 font-['Poppins'] text-sm">Director</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <button class="absolute left-0 top-1/2 transform -translate-y-1/2  rounded-full p-2 " onclick="moveDirectorsSlide(-1)">
                    <i class="fas fa-chevron-left text-[#041B44] text-xl"></i>
                </button>
                <button class="absolute right-0 top-1/2 transform -translate-y-1/2  rounded-full p-2 " onclick="moveDirectorsSlide(1)">
                    <i class="fas fa-chevron-right text-[#041B44] text-xl"></i>
                </button>

                <!-- Dots -->
                <div class="flex justify-center mt-6 space-x-2 desktop-reverse-flex">
                    @if(isset($homeData->directors) && is_array($homeData->directors))
                        @foreach($homeData->directors as $index => $director)
                            <button class="director-dot w-3 h-3 rounded-full {{ $index === 0 ? 'bg-[#D4AF37]' : 'bg-[#041B44]' }}" onclick="goToDirectorSlide({{ $index }})"></button>
                        @endforeach
                    @else
                        <button class="director-dot w-3 h-3 rounded-full bg-[#D4AF37]" onclick="goToDirectorSlide(0)"></button>
                        <button class="director-dot w-3 h-3 rounded-full bg-[#041B44]" onclick="goToDirectorSlide(1)"></button>
                        <button class="director-dot w-3 h-3 rounded-full bg-[#041B44]" onclick="goToDirectorSlide(2)"></button>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($homeData?->isSectionVisible('track_record') ?? true)
    <!-- Proven Track Record Section -->
    <section class="home-track-record pt-[120px] pb-16 bg-[#041B44] text-white relative overflow-hidden">
        <!-- Background Pattern (optional) -->
        <div class="absolute inset-0 opacity-20">
            <img src="{{ $homeData->track_record_background_image ? asset('storage/' . $homeData->track_record_background_image) : asset('design/images/record-bg.png') }}" alt="Pattern Background" class="w-full h-full object-cover"/>
        </div>

        <div class="w-full xl:max-w-[1300px] md:max-w-[1000px] mx-auto px-4 relative">
            <h2 class=" text-[2rem] md:text-4xl xl:text-[3.375rem] mt-[-3.125rem] md:mt-0 md:pl-0 md:pr-0 font-neue-extrabold xl:mb-10 text-white remove-max-width text-center md:text-left">
                {{ app()->getLocale() == 'ar' ? ($homeData->track_record_title_ar ?? 'PROVEN TRACK RECORD') : ($homeData->track_record_title_en ?? 'PROVEN TRACK RECORD') }}
            </h2>

            <div class="text-[1rem] md:text-[1.125rem] xl:text-[1.05125rem] font-['Poppins'] tracking-[0] mb-10 max-w-3xl remove-max-width text-center md:text-left">
                {!! app()->getLocale() == 'ar' ? ($homeData->track_record_description_ar ?? 'Since 2019, we\'ve been dedicated to sculpting success stories, navigating markets, and securing brighter futures for our clients. Trust in our proven track record as we pave the way to financial prosperity together.') : ($homeData->track_record_description_en ?? 'Since 2019, we\'ve been dedicated to sculpting success stories, navigating markets, and securing brighter futures for our clients. Trust in our proven track record as we pave the way to financial prosperity together.') !!}
            </div>

            <!-- Mobile-only view (3 in a row with black text) -->
            <div class="sm:hidden flex flex-col items-center mb-8 ">
                <!-- Metrics slider container -->
                <div class="overflow-hidden w-full relative">
                    <div class="flex transition-transform duration-500 ease-in-out " id="mobile-metrics-slider" style="width: 300%;">
                        @if($homeData && $homeData->track_record_metrics && count($homeData->track_record_metrics) > 0)
                            @php
                                $metrics = $homeData->track_record_metrics;
                                $metricsPerSlide = 3;
                                $totalSlides = ceil(count($metrics) / $metricsPerSlide);
                            @endphp

                            @for($slide = 0; $slide < $totalSlides; $slide++)
                                <div class="w-1/3 flex-shrink-0 flex justify-center flex-wrap gap-4 " data-slide="{{ $slide }}">
                                    @for($i = 0; $i < $metricsPerSlide; $i++)
                                        @php $metricIndex = $slide * $metricsPerSlide + $i; @endphp
                                        @if($metricIndex < count($metrics))
                                            @php $metric = $metrics[$metricIndex]; @endphp
                                            <div class="flex flex-col items-center w-[7.5rem] max-w-[7.5rem] transition-opacity duration-300 ">
                                                <div class="relative w-[6.25rem] h-[6.25rem] mb-2">
                                                    <img src="{{ $homeData->track_record_icon ? asset('storage/' . $homeData->track_record_icon) : asset('design/images/record.svg') }}" alt="Record Icon" class="w-full h-full"/>
                                                    <div class="absolute inset-0 flex items-center justify-center px-2">
                                                        <span class="text-[0.8125rem] leading-tight text-center break-words text-[#041B44] font-['Poppins'] font-bold">{{ $metric['number'] ?? '' }}</span>
                                                    </div>
                                                </div>
                                                <div class="text-center text-[#FFFFFF] font-['Poppins'] text-[0.6875rem] leading-tight tracking-[0] break-words px-1 w-full">
                                                    {{ app()->getLocale() == 'ar' ? ($metric['label_ar'] ?? $metric['label_en'] ?? '') : ($metric['label_en'] ?? '') }}
                                                </div>
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>

                <!-- Mobile dots (aligned left) - larger and interactive -->
                <div class="w-full flex justify-start pl-4 mt-8 ">
                    <div class="flex space-x-4 ">
                        @if($homeData && $homeData->track_record_metrics && count($homeData->track_record_metrics) > 0)
                            @php
                                $metrics = $homeData->track_record_metrics;
                                $metricsPerSlide = 3;
                                $totalSlides = ceil(count($metrics) / $metricsPerSlide);
                            @endphp
                            @for($slide = 0; $slide < $totalSlides; $slide++)
                                <button class="mobile-metrics-dot w-4 h-4 rounded-full {{ $slide === 0 ? 'bg-[#D4AF37]' : 'bg-white opacity-30' }} cursor-pointer transition-all duration-300" onclick="goToMobileMetricsSlide({{ $slide }})"></button>
                            @endfor
                        @else
                            <button class="mobile-metrics-dot w-4 h-4 rounded-full bg-[#D4AF37] cursor-pointer transition-all duration-300" onclick="goToMobileMetricsSlide(0)"></button>
                            <button class="mobile-metrics-dot w-4 h-4 rounded-full bg-white opacity-30 cursor-pointer transition-all duration-300" onclick="goToMobileMetricsSlide(1)"></button>
                            <button class="mobile-metrics-dot w-4 h-4 rounded-full bg-white opacity-30 cursor-pointer transition-all duration-300" onclick="goToMobileMetricsSlide(2)"></button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Desktop/Tablet Metrics Slider (unchanged) -->
            <div class="hidden sm:block relative mt-12">
                <!-- Left Arrow -->
                <button class="absolute left-0 top-1/3 transform -translate-y-1/2 z-10 text-white" onclick="moveMetricsSlide(-1)">
                    <i class="fas fa-chevron-left text-3xl"></i>
                </button>

                <!-- Right Arrow -->
                <button class="absolute right-0 top-1/3 transform -translate-y-1/2 z-10 text-white" onclick="moveMetricsSlide(1)">
                    <i class="fas fa-chevron-right text-3xl"></i>
                </button>

                <!-- Slider Container -->
                <div class="overflow-hidden mx-12">
                    <div id="metrics-slider" class="flex transition-transform duration-500 ease-in-out ">
                        @if($homeData && $homeData->track_record_metrics && count($homeData->track_record_metrics) > 0)
                            @php
                                $metrics = $homeData->track_record_metrics;
                                $metricsPerSlide = 3; // Desktop shows 4 metrics per slide
                                $totalSlides = ceil(count($metrics) / $metricsPerSlide);
                            @endphp

                            @for($slide = 0; $slide < $totalSlides; $slide++)
                                <div class="min-w-full flex-shrink-0 flex flex-wrap justify-center ">
                                    @for($i = 0; $i < $metricsPerSlide; $i++)
                                        @php $metricIndex = $slide * $metricsPerSlide + $i; @endphp
                                        @if($metricIndex < count($metrics))
                                            @php $metric = $metrics[$metricIndex]; @endphp
                                            <div class="w-full sm:w-1/2 md:w-1/4 px-4 flex flex-col items-center mb-8 ">
                                                <div class="relative w-[9.375rem] h-[9.375rem] mb-4">
                                                    <img src="{{ $homeData->track_record_icon ? asset('storage/' . $homeData->track_record_icon) : asset('design/images/record.svg') }}" alt="Record Icon" class="w-full h-full"/>
                                                    <div class="absolute inset-0 flex items-center justify-center">
                                                        <span class="text-[1.25rem] text-[#041B44] font-['Poppins'] font-bold">{{ $metric['number'] ?? '' }}</span>
                                                    </div>
                                                </div>
                                                <div class="text-center text-[#FFFFFF] font-['Poppins'] font-regular text-[1.24rem] tracking-[0]">
                                                    {{ app()->getLocale() == 'ar' ? ($metric['label_ar'] ?? $metric['label_en'] ?? '') : ($metric['label_en'] ?? '') }}
                                                </div>
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            @endfor
                        @else
                            <!-- Fallback to original hardcoded metrics -->
                            <!-- SLIDE 1 -->
                            <div class="min-w-full flex-shrink-0 flex flex-wrap justify-center">
                                <div class="w-full sm:w-1/2 md:w-1/4 px-4 flex flex-col items-center mb-8">
                                    <div class="relative w-[9.375rem] h-[9.375rem] mb-4">
                                        <img src="{{ asset("design/images/record.svg") }}" alt="Record Icon" class="w-full h-full"/>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <span class="text-[1.25rem] text-[#041B44] font-['Poppins'] font-bold">650.0 M$</span>
                                        </div>
                                    </div>
                                    <p class="text-center text-[#FFFFFF] font-['Poppins'] font-regular text-[1.24rem] tracking-[0]">Assets Under<br/>Advisory</p>
                                </div>
                                <div class="w-full sm:w-1/2 md:w-1/4 px-4 flex flex-col items-center mb-8">
                                    <div class="relative w-[9.375rem] h-[9.375rem] mb-4">
                                        <img src="{{ asset("design/images/record.svg") }}" alt="Record Icon" class="w-full h-full"/>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <span class="text-[1.25rem] text-[#041B44] font-['Poppins'] font-bold">1,300.0</span>
                                        </div>
                                    </div>
                                    <p class="text-center text-[#FFFFFF] font-['Poppins'] font-regular text-[1.24rem] tracking-[0]">The average client's<br/>portfolio return</p>
                                </div>
                                <div class="w-full sm:w-1/2 md:w-1/4 px-4 flex flex-col items-center mb-8">
                                    <div class="relative w-[9.375rem] h-[9.375rem] mb-4">
                                        <img src="{{ asset("design/images/record.svg") }}" alt="Record Icon" class="w-full h-full"/>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <span class="text-[1.25rem] text-[#041B44] font-['Poppins'] font-bold">8.0</span>
                                        </div>
                                    </div>
                                    <p class="text-center text-[#FFFFFF] font-['Poppins'] font-regular text-[1.24rem] tracking-[0]">Family<br/>Constitutions</p>
                                </div>
                                <div class="w-full sm:w-1/2 md:w-1/4 px-4 flex flex-col items-center mb-8">
                                    <div class="relative w-[9.375rem] h-[9.375rem] mb-4">
                                        <img src="{{ asset("design/images/record.svg") }}" alt="Record Icon" class="w-full h-full"/>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <span class="text-[1.25rem] text-[#041B44] font-['Poppins'] font-bold">10.2%</span>
                                        </div>
                                    </div>
                                    <p class="text-center text-[#FFFFFF] font-['Poppins'] font-regular text-[1.24rem] tracking-[0]">Global Investment<br/>Managers</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Slider Dots -->
                <div class="flex justify-center mt-8 space-x-2 ">
                    @if($homeData && $homeData->track_record_metrics && count($homeData->track_record_metrics) > 0)
                        @php
                            $metrics = $homeData->track_record_metrics;
                            $metricsPerSlide = 3;
                            $totalSlides = ceil(count($metrics) / $metricsPerSlide);
                        @endphp
                        @for($slide = 0; $slide < $totalSlides; $slide++)
                            <button class="metrics-dot w-3 h-3 rounded-full {{ $slide === 0 ? 'bg-[#D4AF37]' : 'bg-gray-400' }}" onclick="goToMetricsSlide({{ $slide }})"></button>
                        @endfor
                    @else
                        <button class="metrics-dot w-3 h-3 rounded-full bg-[#D4AF37]" onclick="goToMetricsSlide(0)"></button>
                        <button class="metrics-dot w-3 h-3 rounded-full bg-gray-400" onclick="goToMetricsSlide(1)"></button>
                        <button class="metrics-dot w-3 h-3 rounded-full bg-gray-400" onclick="goToMetricsSlide(2)"></button>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($homeData?->isSectionVisible('roadmap') ?? true)
    <!-- Road Map Section -->
    <section class="home-roadmap bg-[#E9E9E9] text-center py-10">
        <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4">
            <h2 class="text-[1.5625rem] md:text-[3rem] font-geometos-neue font-extrabold md:leading-[3.875rem] text-[#041B44] mb-16 md:mb-32 leading-[3rem]">
                {{ app()->getLocale() == 'ar' ? ($homeData->roadmap_title_ar ?? 'HOW CAN WE START OUR JOURNEY TOGETHER?') : ($homeData->roadmap_title_en ?? 'HOW CAN WE START OUR JOURNEY TOGETHER?') }}
            </h2>

            <!-- Desktop version - hidden on mobile -->
            <div class="hidden md:grid grid-cols-4 lg:grid-cols-8 gap-y-2 gap-x-2 justify-items-center desktop-reverse-grid">
          @if(isset($homeData->roadmap_steps) && is_array($homeData->roadmap_steps))
            @foreach($homeData->roadmap_steps as $index => $step)
              <div class="flex flex-col items-center">
                <div class="rounded-full w-32 mb-4 overflow-hidden">
                  @if(isset($step['icon']) && $step['icon'])
                    <img src="{{ asset('storage/' . $step['icon']) }}" alt="{{ app()->getLocale() == 'ar' ? ($step['step_ar'] ?? 'Step') : ($step['step_en'] ?? 'Step') }}" class="w-full h-full " />
                  @else
                    <div class="bg-blue-900 text-white rounded-full w-full h-full flex items-center justify-center">
                      <i class="fas fa-circle text-white text-4xl"></i>
                    </div>
                  @endif
                </div>
                <div class="h-[{{ $index % 2 == 0 ? '73' : '183' }}px] w-[2px] bg-[#041B44] mb-2"></div>
                <div class="text-[1.5625rem] {{ $index === 0 ? 'text-gray-800' : 'text-[#041B44]' }} text-center font-['Poppins'] font-medium leading-[2.125rem] whitespace-wrap">
                  {{ app()->getLocale() == 'ar' ? ($step['step_ar'] ?? 'Step ' . ($index + 1)) : ($step['step_en'] ?? 'Step ' . ($index + 1)) }}
                </div>
              </div>
            @endforeach
          @else
            <!-- Fallback to default steps if no data -->
            <div class="flex flex-col items-center">
              <div class="rounded-full w-32  mb-4 overflow-hidden">
                <img src="{{ asset("design/images/journey-logo1.svg") }}" alt="icon" class="w-full h-full " />
              </div>
              <div class="h-[4.5625rem] w-[2px] bg-[#041B44] mb-2"></div>
              <div class="text-[1.5625rem] text-gray-800 text-center font-['Poppins'] font-medium leading-[2.125rem] whitespace-wrap">Strategic <br/> Decision</div>
            </div>

            <div class="flex flex-col items-center">
              <div class="rounded-full w-32  mb-4 overflow-hidden">
                <img src="{{ asset("design/images/journey-logo2.svg") }}" alt="icon" class="w-full h-full " />
              </div>
              <div class="h-[11.4375rem] w-[2px] bg-[#041B44] mb-2"></div>
              <div class="text-[1.5625rem] text-[#041B44] text-center font-['Poppins'] font-medium leading-[2.125rem] whitespace-wrap">Governance</div>
            </div>

            <div class="flex flex-col items-center">
              <div class="rounded-full w-32  mb-4 overflow-hidden">
                <img src="{{ asset("design/images/journey-logo3.svg") }}" alt="icon" class="w-full h-full " />
              </div>
              <div class="h-[4.5625rem] w-[2px] bg-[#041B44] mb-2"></div>
              <div class="text-[1.5625rem] text-[#041B44] text-center font-['Poppins'] font-medium leading-[2.125rem] whitespace-wrap">Current portfolio<br/>analysis</div>
            </div>

            <div class="flex flex-col items-center">
              <div class="rounded-full w-32  mb-4 overflow-hidden">
                <img src="{{ asset("design/images/journey-logo4.svg") }}" alt="icon" class="w-full h-full " />
              </div>
              <div class="h-[11.4375rem] w-[2px] bg-[#041B44] mb-2"></div>
              <div class="text-[1.5625rem] text-[#041B44] text-center font-['Poppins'] font-medium leading-[2.125rem] whitespace-wrap">Investment Policy<br/> Statement</div>
            </div>

            <div class="flex flex-col items-center">
              <div class="rounded-full w-32  mb-4 overflow-hidden">
                <img src="{{ asset("design/images/journey-logo5.svg") }}" alt="icon" class="w-full h-full " />
              </div>
              <div class="h-[4.5625rem] w-[2px] bg-[#041B44] mb-2"></div>
              <div class="text-[1.5625rem] text-[#041B44] text-center font-['Poppins'] font-medium leading-[2.125rem] whitespace-wrap">Investment<br/>Implementation</div>
            </div>

            <div class="flex flex-col items-center">
              <div class="rounded-full w-32  mb-4 overflow-hidden">
                <img src="{{ asset("design/images/journey-logo6.svg") }}" alt="icon" class="w-full h-full " />
              </div>
              <div class="h-[11.4375rem] w-[2px] bg-[#041B44] mb-2"></div>
              <div class="text-[1.5625rem] text-[#041B44] text-center font-['Poppins'] font-medium leading-[2.125rem] whitespace-wrap">Investment<br/>Structure</div>
            </div>

            <div class="flex flex-col items-center">
              <div class="rounded-full w-32  mb-4 overflow-hidden">
                <img src="{{ asset("design/images/journey-logo7.svg") }}" alt="icon" class="w-full h-full " />
              </div>
              <div class="h-[4.5625rem] w-[2px] bg-[#041B44] mb-2"></div>
              <div class="text-[1.5625rem] text-[#041B44] text-center font-['Poppins'] font-medium leading-[2.125rem] whitespace-wrap">Mangers Search<br/>& Selection</div>
            </div>

            <div class="flex flex-col items-center">
              <div class="rounded-full w-32  mb-4 overflow-hidden">
                <img src="{{ asset("design/images/journey-logo8.svg") }}" alt="icon" class="w-full h-full" />
              </div>
              <div class="h-[11.4375rem] w-[2px] bg-[#041B44] mb-2"></div>
              <div class="text-[1.5625rem] text-[#041B44] text-center font-['Poppins'] font-medium leading-[2.125rem] whitespace-wrap">Monitoring<br/>Performance</div>
            </div>
          @endif
        </div>

            <!-- Mobile version - only shows image -->
            <div class="md:hidden mx-auto mb-8">
              @if(isset($homeData->roadmap_mobile_image) && $homeData->roadmap_mobile_image)
                <img src="{{ asset('storage/' . $homeData->roadmap_mobile_image) }}" alt="Journey Map" class="w-full mx-auto" />
              @else
                <img src="{{ asset("design/images/mobile.map.jpg") }}" alt="Journey Map" class="w-full mx-auto" />
              @endif
            </div>

            <div class="mt-16">
              <a href="{{ $homeData->roadmap_button_link ? (str_starts_with($homeData->roadmap_button_link, 'http') ? $homeData->roadmap_button_link : route($homeData->roadmap_button_link)) : 'https://www.hauberkcapital.com/request-meeting' }}" class="bg-[#D4AF37] hover:bg-[#041B44] text-[#E9E9E9] font-geometos-neue font-extrabold text-[1.11375rem] py-3 px-6 rounded-xl inline-block">
                {{ app()->getLocale() == 'ar' ? ($homeData->roadmap_button_text_ar ?? 'REQUEST A MEETING') : ($homeData->roadmap_button_text_en ?? 'REQUEST A MEETING') }}
              </a>
            </div>
        </div>
    </section>
    @endif

    @if($homeData?->isSectionVisible('insights') ?? true)
    <!-- Insights Section -->
    <section class="home-insights py-16 bg-[#041B44] text-white">
        <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4">
            <h2 class="text-[2rem] xl:text-[3.375rem] xl:font-neue-bold font-neue-extrabold text-center mb-16">
                {{ app()->getLocale() == 'ar' ? ($homeData->insights_title_ar ?? 'رؤيتنا') : ($homeData->insights_title_en ?? 'OUR INSIGHTS') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-14 px-6 md:px-0 desktop-reverse-grid">
                @php
                    $isArabic = app()->getLocale() === 'ar';
                    $learnMoreLabel = $isArabic ? 'اطلع على المزيد...' : 'Learn More...';
                    $fallbackDescriptions = [
                        'default' => [
                            'en' => 'Unlock the full potential of your wealth with our diversified programs, tailored to your unique.',
                            'ar' => 'أطلق العنان للإمكانات الكاملة لثروتك من خلال برامجنا المتنوعة المصممة لتناسب احتياجاتك الخاصة.',
                        ],
                    ];
                    $textAlignmentClass = $isArabic ? 'text-right md:text-right' : 'text-left md:text-left';
                    $insightItems = collect($insightItems ?? []);
                @endphp

                @forelse($insightItems as $insightItem)
                    @php
                        $insightTitle = $localize($insightItem['title_en'] ?? null, $insightItem['title_ar'] ?? null);
                        $insightDescription = $localize($insightItem['description_en'] ?? null, $insightItem['description_ar'] ?? null);
                        $insightImage = $insightItem['image_url'] ?? asset('design/images/blog.png');
                        $insightButtonLabel = $localize($insightItem['button_text_en'] ?? null, $insightItem['button_text_ar'] ?? null) ?: $learnMoreLabel;
                    @endphp
                    <div class="flex flex-col h-full {{ $textAlignmentClass }}">
                        <div class="bg-[#041B44] rounded-lg overflow-hidden mb-6 flex flex-col h-full min-h-[360px]">
                            <div
                                class="w-full min-h-[180px] h-[180px] md:min-h-[200px] md:h-[200px] bg-contain bg-center bg-no-repeat rounded-lg"
                                style="background-image: url('{{ $insightImage }}');"
                                role="img"
                                aria-label="{{ $insightTitle }}"
                            ></div>
                            <div class="pt-4 flex flex-col flex-1">
                                <div class="text-white xl:text-[0.941875rem] font-['Poppins'] text-base mb-4 flex-1 {{ $textAlignmentClass }}">
                                    {{ \Illuminate\Support\Str::limit($insightDescription, 120) }}
                                </div>
                                <a href="{{ $insightItem['url'] ?? route('blog') }}" class="text-[#D4AF37] font-neue-bold text-sm hover:underline {{ $textAlignmentClass }}">
                                    {{ $insightButtonLabel }}
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback content if no blogs are available -->
                    <div class="flex flex-col h-full {{ $textAlignmentClass }}">
                        <div class="bg-[#041B44] rounded-lg overflow-hidden mb-6 flex flex-col h-full min-h-[360px]">
                            <div
                                class="w-full min-h-[180px] h-[180px] md:min-h-[200px] md:h-[200px] bg-contain bg-center bg-no-repeat rounded-lg"
                                style="background-image: url('{{ asset("design/images/blog.png") }}');"
                                role="img"
                                aria-label="{{ $isArabic ? 'رؤيتنا' : 'Insights' }}"
                            ></div>
                            <div class="pt-4 flex flex-col flex-1">
                                <div class="text-white xl:text-[0.941875rem] font-['Poppins'] text-base mb-4 flex-1 {{ $textAlignmentClass }}">
                                    {{ $isArabic ? $fallbackDescriptions['default']['ar'] : $fallbackDescriptions['default']['en'] }}
                                </div>
                                <a href="{{ route('blog') }}" class="text-[#D4AF37] font-neue-bold text-sm hover:underline {{ $textAlignmentClass }}">{{ $learnMoreLabel }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col h-full {{ $textAlignmentClass }}">
                        <div class="bg-[#041B44] rounded-lg overflow-hidden mb-6 flex flex-col h-full min-h-[360px]">
                            <div
                                class="w-full min-h-[180px] h-[180px] md:min-h-[200px] md:h-[200px] bg-contain bg-center bg-no-repeat rounded-lg"
                                style="background-image: url('{{ asset("design/images/investor.png") }}');"
                                role="img"
                                aria-label="{{ $isArabic ? 'رؤيتنا' : 'Insights' }}"
                            ></div>
                            <div class="pt-4 flex flex-col flex-1">
                                <div class="text-white xl:text-[0.941875rem] font-['Poppins'] text-base mb-4 flex-1 {{ $textAlignmentClass }}">
                                    {{ $isArabic ? $fallbackDescriptions['default']['ar'] : $fallbackDescriptions['default']['en'] }}
                                </div>
                                <a href="{{ route('blog') }}" class="text-[#D4AF37] font-neue-bold text-sm hover:underline {{ $textAlignmentClass }}">{{ $learnMoreLabel }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col h-full {{ $textAlignmentClass }}">
                        <div class="bg-[#041B44] rounded-lg overflow-hidden mb-6 flex flex-col h-full min-h-[360px]">
                            <div
                                class="w-full min-h-[180px] h-[180px] md:min-h-[200px] md:h-[200px] bg-contain bg-center bg-no-repeat rounded-lg"
                                style="background-image: url('{{ asset("design/images/blog.png") }}');"
                                role="img"
                                aria-label="{{ $isArabic ? 'رؤيتنا' : 'Insights' }}"
                            ></div>
                            <div class="pt-4 flex flex-col flex-1">
                                <div class="text-white xl:text-[0.941875rem] font-['Poppins'] text-base mb-4 flex-1 {{ $textAlignmentClass }}">
                                    {{ $isArabic ? $fallbackDescriptions['default']['ar'] : $fallbackDescriptions['default']['en'] }}
                                </div>
                                <a href="{{ route('blog') }}" class="text-[#D4AF37] font-neue-bold text-sm hover:underline {{ $textAlignmentClass }}">{{ $learnMoreLabel }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col h-full {{ $textAlignmentClass }}">
                        <div class="bg-[#041B44] rounded-lg overflow-hidden mb-6 flex flex-col h-full min-h-[360px]">
                            <div
                                class="w-full min-h-[180px] h-[180px] md:min-h-[200px] md:h-[200px] bg-contain bg-center bg-no-repeat rounded-lg"
                                style="background-image: url('{{ asset("design/images/blog.png") }}');"
                                role="img"
                                aria-label="{{ $isArabic ? 'رؤيتنا' : 'Insights' }}"
                            ></div>
                            <div class="pt-4 flex flex-col flex-1">
                                <div class="text-white xl:text-[0.941875rem] font-['Poppins'] text-base mb-4 flex-1 {{ $textAlignmentClass }}">
                                    {{ $isArabic ? $fallbackDescriptions['default']['ar'] : $fallbackDescriptions['default']['en'] }}
                                </div>
                                <a href="{{ route('blog') }}" class="text-[#D4AF37] font-neue-bold text-sm hover:underline {{ $textAlignmentClass }}">{{ $learnMoreLabel }}</a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif

    <!-- Ready To Start Growing Section -->
    @if(($homeData->cta_section_enabled ?? true))
        <section class="home-cta relative md:h-[100vh] md:max-h-[557px] text-white overflow-hidden z-0 flex items-end">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset("design/images/meeting-bg.png") }}" alt="NYC Skyline" class="w-full h-full object-cover object-center"/>
            </div>

            <!-- Content Container -->
            <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4 relative z-10 w-full py-16">
                <div class="flex flex-col md:flex-row items-center mx-auto desktop-reverse-flex">
                    <!-- Left Content -->
                    <div class="mb-10 md:mb-0 w-full">
                        <h2 class="text-[2.19125rem] md:text-[3.18875rem] leading-[1.1] font-neue-extrabold text-white mb-6">
                            {{ app()->getLocale() == 'ar' ? ($homeData->cta_title_ar ?? 'READY TO BUILD YOUR FINANCIAL LEGACY?') : ($homeData->cta_title_en ?? 'READY TO BUILD YOUR FINANCIAL LEGACY?') }}
                        </h2>
                        <div style="font-size:0.81875rem; line-height:1.175rem;" class="md:text-[1.19125rem] md:leading-[1.7125rem] font-['Poppins'] remove-max-width opacity-90 mb-8 max-w-md">
                            {!! app()->getLocale() == 'ar' ? ($homeData->cta_description_ar ?? 'Unlock the full potential of your wealth') : ($homeData->cta_description_en ?? 'Unlock the full potential of your wealth') !!}
                        </div>

                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-10 desktop-reverse-flex">
                            <a href="{{ $homeData->cta_button_1_link ?? 'contact-us.html' }}" class="inline-block bg-transparent leading-[1.56875rem] border-[1px] border-white text-white text-center xl:text-[1.1875rem] font-neue-extrabold px-[1.875rem] py-[0.9375rem] md:text-[0.6875rem] md:px-[1.875rem] md:py-[0.85625rem] xl:px-[4.40625rem] xl:py-[1.048125rem] rounded-md hover:bg-white/10 transition-all duration-300 sm:w-auto">
                                {{ app()->getLocale() == 'ar' ? ($homeData->cta_button_1_text_ar ?? 'JOIN OUR MAILING LIST') : ($homeData->cta_button_1_text_en ?? 'JOIN OUR MAILING LIST') }}
                            </a>

                            <a href="{{ $homeData->cta_button_2_link ?? 'request-a-meeting.html' }}" class="inline-block bg-transparent leading-[1.56875rem] border-[1px] border-white text-white text-center xl:text-[1.1875rem] font-neue-extrabold px-[1.875rem] py-[0.9375rem] md:text-[0.6875rem] md:px-[1.875rem] md:py-[0.85625rem] xl:px-[4.40625rem] xl:py-[1.048125rem] rounded-md hover:bg-white/10 transition-all duration-300 sm:w-auto">
                                {{ app()->getLocale() == 'ar' ? ($homeData->cta_button_2_text_ar ?? 'REQUEST A MEETING') : ($homeData->cta_button_2_text_en ?? 'REQUEST A MEETING') }}
                            </a>
                        </div>
                    </div>

                    <!-- Right Side is empty but takes up space -->
                    <div class="w-full md:w-1/2">
                        <!-- Empty space to balance layout -->
                    </div>
                </div>
            </div>
        </section>
    @endif
    </div>
<script>
    // Pass home data to JavaScript
    window.homeData = @json($homeData);

    // Prepare service data for JavaScript
    @if($homeData && $homeData->services)
        window.serviceData = [
            @foreach($homeData->services as $index => $service)
            {
                title: "{{ app()->getLocale() == 'ar' ? ($service['title_ar'] ?? $service['title_en'] ?? 'Service') : ($service['title_en'] ?? 'Service') }}",
                description: "{{ app()->getLocale() == 'ar' ? ($service['description_ar'] ?? $service['description_en'] ?? '') : ($service['description_en'] ?? '') }}",
                image: "{{ isset($service['image']) && $service['image'] ? asset('storage/' . $service['image']) : asset('design/images/assist1.png') }}",
                link: "{{ $service['link'] ?? '#' }}",
                url: "{{ $service['link'] ?? '#' }}",
                readMoreText: "{{ app()->getLocale() == 'ar' ? ($service['read_more_text_ar'] ?? 'اقرأ المزيد') : ($service['read_more_text_en'] ?? 'Read More') }}"
            }{{ $index < count($homeData->services) - 1 ? ',' : '' }}
            @endforeach
        ];
    @else
        window.serviceData = [];
    @endif

</script>
<script src="{{ asset('design/js/index.js') }}"></script>
@endsection


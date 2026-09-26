@extends('app')
@section('content')

@php
    $about = $faqs ?? []; // The about data is passed as 'faqs' from the controller

    // Debug: Let's see what we're getting
    // dd('About data:', $about);
    $localize = $localize ?? function ($en, $ar) {
        return app()->getLocale() === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
    };
    // Ensure all expected keys exist with default values
    $about = array_merge([
        'hero_title_en' => 'ABOUT US',
        'hero_title_ar' => '',
        'hero_subtitle_en' => 'Uncover the story behind Hauberk Capital for Wealth Advisory',
        'hero_subtitle_ar' => '',
        'hero_button_text_en' => 'REQUEST A MEETING',
        'hero_button_text_ar' => 'طلب اجتماع',
        'hero_button_link' => 'request-a-meeting',
        'hero_desktop_image' => null,
        'hero_mobile_image' => null,
        'who_we_are_title_en' => 'WHO WE ARE',
        'who_we_are_title_ar' => '',
        'who_we_are_description_1_en' => '',
        'who_we_are_description_1_ar' => '',
        'who_we_are_description_2_en' => '',
        'who_we_are_description_2_ar' => '',
        'who_we_are_description_3_en' => '',
        'who_we_are_description_3_ar' => '',
        'who_we_are_desktop_bg' => null,
        'who_we_are_mobile_bg' => null,
        'concept_title_en' => 'HAUBERK CAPITAL AS A CONCEPT',
        'concept_title_ar' => '',
        'concept_intro_en' => '',
        'concept_intro_ar' => '',
        'yield_title_en' => 'Yield',
        'yield_title_ar' => 'العائد',
        'yield_description_en' => '',
        'yield_description_ar' => '',
        'defence_title_en' => 'Defence',
        'defence_title_ar' => 'الدفاع',
        'defence_description_en' => '',
        'defence_description_ar' => '',
        'appreciation_title_en' => 'Appreciation',
        'appreciation_title_ar' => 'التقدير',
        'appreciation_description_en' => '',
        'appreciation_description_ar' => '',
        'liquidity_title_en' => 'Liquidity',
        'liquidity_title_ar' => 'السيولة',
        'liquidity_description_en' => '',
        'liquidity_description_ar' => '',
        'concept_diagram_image' => null,
        'concept_diagram_image_ar' => null,
        'concept_diagram_mobile_image' => null,
        'concept_diagram_mobile_image_ar' => null,
        'concept_bg_image' => null,
        'concept_bg_mobile_image' => null,
        'mission_title_en' => 'MISSION',
        'mission_title_ar' => 'المهمة',
        'mission_text_en' => 'Develop HNWI, Family Offices and Endowment\'s investment experience.',
        'mission_text_ar' => '',
        'vision_title_en' => 'VISION',
        'vision_title_ar' => 'الرؤية',
        'vision_text_en' => 'To provide outstanding, cohesive & sustainable investment approach.',
        'vision_text_ar' => '',
        'mission_icon' => null,
        'vision_icon' => null,
        'values_title_en' => 'OUR VALUES',
        'values_title_ar' => '',
        'values' => [],
        'approach_title_en' => 'OUR APPROACH',
        'approach_title_ar' => '',
        'approach_description_1_en' => '',
        'approach_description_1_ar' => '',
        'approach_description_2_en' => '',
        'approach_description_2_ar' => '',
        'approach_items' => [],
        'approach_bg_image' => null,
    ], $about);
    $isArabic = app()->getLocale() === 'ar';
@endphp

<style>
    @media (min-width: 768px) and (max-width: 1023px) {
        .about-hero {
            height: 72vh !important;
            min-height: 540px;
            max-height: 680px;
        }

        .about-hero-content {
            height: 100% !important;
            padding-inline: 1.5rem;
        }

        .about-hero-title {
            font-size: 3.5rem !important;
            line-height: 1.08 !important;
        }

        .about-container {
            max-width: 720px !important;
        }

        .about-section-y {
            padding-top: 4.5rem !important;
            padding-bottom: 4.5rem !important;
        }

        .about-section-title {
            font-size: 2.625rem !important;
            line-height: 1.15 !important;
            margin-bottom: 2rem !important;
        }

        .about-copy {
            font-size: 1rem !important;
            line-height: 1.75 !important;
        }

        .about-concept-diagram {
            max-width: 640px;
        }

        .about-mission-vision-row {
            gap: 4rem !important;
        }

        .about-mission-vision-title {
            font-size: 2.25rem !important;
        }

        .about-mission-vision-copy {
            max-width: 18rem !important;
            padding-inline-start: 3.5rem !important;
            font-size: 1rem !important;
        }

        .about-values-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }

        .about-values-grid > .about-value-card:last-child:nth-child(odd) {
            grid-column: 1 / -1;
        }

        .about-value-card {
            padding: 2rem !important;
        }

        .about-value-title,
        .about-accordion-title {
            font-size: 1.5rem !important;
            line-height: 1.25 !important;
        }

        .about-value-copy {
            padding-inline-start: 3.25rem !important;
            font-size: 0.9375rem !important;
        }

        .about-approach-section {
            padding-top: 6rem !important;
            padding-bottom: 6rem !important;
        }

        .about-approach-copy {
            margin-bottom: 4rem !important;
        }
    }

    @media (min-width: 1024px) and (max-width: 1279px) {
        .about-hero {
            height: 74vh !important;
            min-height: 560px;
            max-height: 760px;
        }

        .about-hero-content {
            height: 100% !important;
            padding-inline: 2rem;
        }

        .about-hero-title {
            font-size: 4rem !important;
            line-height: 1.08 !important;
        }

        .about-container {
            max-width: 980px !important;
            padding-inline: 2rem !important;
        }

        .about-section-y {
            padding-top: 5rem !important;
            padding-bottom: 5rem !important;
        }

        .about-section-title {
            font-size: 2.75rem !important;
            line-height: 1.18 !important;
        }

        .about-mission-vision-row {
            gap: 6rem !important;
        }

        .about-mission-vision-title {
            font-size: 2.5rem !important;
        }

        .about-value-card {
            padding: 2.25rem !important;
        }

        .about-values-grid {
            grid-template-columns: repeat(6, minmax(0, 1fr)) !important;
        }

        .about-values-grid > .about-value-card {
            grid-column: span 2 / span 2;
        }

        .about-values-grid > .about-value-card:nth-last-child(2):nth-child(4) {
            grid-column-start: 2;
        }

        .about-value-title,
        .about-accordion-title {
            font-size: 1.5rem !important;
            line-height: 1.25 !important;
        }

        .about-value-copy {
            padding-inline-start: 3.5rem !important;
            font-size: 0.9375rem !important;
        }

        .about-approach-section {
            padding-top: 7rem !important;
            padding-bottom: 7rem !important;
        }
    }

    @media (min-width: 1280px) {
        .about-values-grid {
            grid-template-columns: repeat(6, minmax(0, 1fr)) !important;
        }

        .about-values-grid > .about-value-card {
            grid-column: span 2 / span 2;
        }

        .about-values-grid > .about-value-card:nth-last-child(2):nth-child(4) {
            grid-column-start: 2;
        }
    }
</style>

    @if($aboutModel?->isSectionVisible('hero') ?? true)
    <section class="about-hero bg-navy-900 text-white h-screen md:h-[70vh] relative ">
        <div class="relative overflow-hidden h-full">
            <div class="flex flex-col h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full">
                    <div class="w-full flex-shrink-0 relative">
                        <div class="absolute inset-0">
                            <!-- Desktop background -->
                            <img src="{{ isset($about['hero_desktop_image']) && $about['hero_desktop_image'] ? asset('storage/' . $about['hero_desktop_image']) : asset('design') . '/images/about-us-hero.png' }}" alt="Wealth Management" class="hidden md:block w-full h-full object-cover"/>
                            <!-- Mobile background -->
                            <img src="{{ isset($about['hero_mobile_image']) && $about['hero_mobile_image'] ? asset('storage/' . $about['hero_mobile_image']) : asset('design') . '/images/mobile-about-us-hero.png' }}" alt="Wealth Management" class="block md:hidden w-full h-full object-cover"/>
                        </div>
                        <div class="absolute inset-0 "></div>
                        <div class="about-hero-content relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                            <div class="container mx-auto text-center">
                                <h1 class="about-hero-title text-[45px] xl:text-[78px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">{{ isset($seoMeta) ? ($localize($seoMeta->h1_en ?? null, $seoMeta->h1_ar ?? null) ?? (app()->getLocale() == 'ar' ? ($about['hero_title_ar'] ?? 'ABOUT US') : ($about['hero_title_en'] ?? 'ABOUT US'))) : (app()->getLocale() == 'ar' ? ($about['hero_title_ar'] ?? 'ABOUT US') : ($about['hero_title_en'] ?? 'ABOUT US')) }}</h1>
                                <div class="mb-8 text-[17px] xl:text-[18px] text-[#FFFFFF]/70 font-['Poppins'] font-regular">{!! app()->getLocale() == 'ar' ? ($about['hero_subtitle_ar'] ?? 'Uncover the story behind Hauberk Capital for Wealth Advisory') : ($about['hero_subtitle_en'] ?? 'Uncover the story behind Hauberk Capital for Wealth Advisory') !!}</div>
                                <a href="{{ $about['hero_button_link'] ?? 'request-a-meeting' }}" class="bg-[#D4AF37] px-6 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">{{ app()->getLocale() == 'ar' ? ($about['hero_button_text_ar'] ?? 'طلب اجتماع') : ($about['hero_button_text_en'] ?? 'REQUEST A MEETING') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($aboutModel?->isSectionVisible('who_we_are') ?? true)
    <section id="who-we-are-section" class="relative">
        <div class="absolute inset-0">
            <img src="{{ isset($about['who_we_are_mobile_bg']) && $about['who_we_are_mobile_bg'] ? asset('storage/' . $about['who_we_are_mobile_bg']) : asset('design') . '/images/mobile-about-who-we-are-bg.png' }}" alt="Background" class="w-full h-full object-cover md:hidden"/>
            <img src="{{ isset($about['who_we_are_desktop_bg']) && $about['who_we_are_desktop_bg'] ? asset('storage/' . $about['who_we_are_desktop_bg']) : asset('design') . '/images/about-who-we-are-bg.png' }}" alt="Background" class="hidden md:block w-full h-full object-cover"/>
        </div>
        <div class="about-container about-section-y container mx-auto px-4 py-16 md:py-24 relative w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto">
            <div class="flex flex-col lg:flex-row">
                <div class="w-full lg:w-[60%] pr-0 lg:pr-12">
                    <h2 class="about-section-title text-[40px] md:text-[54px] font-neue-extrabold text-[#041B44] mb-10 text-center md:text-left">{{ app()->getLocale() == 'ar' ? ($about['who_we_are_title_ar'] ?? 'WHO WE ARE') : ($about['who_we_are_title_en'] ?? 'WHO WE ARE') }}</h2>

                    @if($about['who_we_are_description_1_en'] || $about['who_we_are_description_1_ar'])
                    <div class="about-copy text-[#041B44] font-sf-pro-regular text-lg mb-8 leading-relaxed">
                        {!! app()->getLocale() == 'ar' ? ($about['who_we_are_description_1_ar'] ?? '') : ($about['who_we_are_description_1_en'] ?? '') !!}
                    </div>
                    @endif

                    @if($about['who_we_are_description_2_en'] || $about['who_we_are_description_2_ar'])
                    <div class="about-copy text-[#041B44] font-sf-pro-regular text-lg mb-8 leading-relaxed">
                        {!! app()->getLocale() == 'ar' ? ($about['who_we_are_description_2_ar'] ?? '') : ($about['who_we_are_description_2_en'] ?? '') !!}
                    </div>
                    @endif

                    @if($about['who_we_are_description_3_en'] || $about['who_we_are_description_3_ar'])
                    <div class="about-copy text-[#041B44] font-sf-pro-regular text-lg leading-relaxed">
                        {!! app()->getLocale() == 'ar' ? ($about['who_we_are_description_3_ar'] ?? '') : ($about['who_we_are_description_3_en'] ?? '') !!}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    @php
        $isArabicConcept = app()->getLocale() === 'ar';
        $localizeConcept = function ($en, $ar, $fallback = '') use ($isArabicConcept) {
            return $isArabicConcept ? ($ar ?: $en ?: $fallback) : ($en ?: $ar ?: $fallback);
        };
        $conceptField = function ($key, $default = null) use ($about, $aboutModel) {
            return $about[$key] ?? $aboutModel?->{$key} ?? $default;
        };

        $defaultConceptBackground = asset('design/images/concept-bg.png');
        $defaultConceptDiagram = asset('design/images/concept-diagram.png');

        $conceptBackgroundDesktop = $conceptField('concept_bg_image')
            ? asset('storage/' . $conceptField('concept_bg_image'))
            : $defaultConceptBackground;
        $conceptBackgroundMobile = $conceptField('concept_bg_mobile_image')
            ? asset('storage/' . $conceptField('concept_bg_mobile_image'))
            : $conceptBackgroundDesktop;

        $conceptDiagramDesktop = $isArabicConcept
            ? ($conceptField('concept_diagram_image_ar')
                ? asset('storage/' . $conceptField('concept_diagram_image_ar'))
                : ($conceptField('concept_diagram_image')
                    ? asset('storage/' . $conceptField('concept_diagram_image'))
                    : $defaultConceptDiagram))
            : ($conceptField('concept_diagram_image')
                ? asset('storage/' . $conceptField('concept_diagram_image'))
                : $defaultConceptDiagram);

        $conceptDiagramMobile = $isArabicConcept
            ? ($conceptField('concept_diagram_mobile_image_ar')
                ? asset('storage/' . $conceptField('concept_diagram_mobile_image_ar'))
                : ($conceptField('concept_diagram_mobile_image')
                    ? asset('storage/' . $conceptField('concept_diagram_mobile_image'))
                    : $conceptDiagramDesktop))
            : ($conceptField('concept_diagram_mobile_image')
                ? asset('storage/' . $conceptField('concept_diagram_mobile_image'))
                : $conceptDiagramDesktop);

        $conceptDiagramAlt = $isArabicConcept
            ? $localizeConcept($conceptField('concept_diagram_image_ar_alt_en'), $conceptField('concept_diagram_image_ar_alt_ar'), 'Hauberk Capital Concept')
            : $localizeConcept($conceptField('concept_diagram_image_alt_en'), $conceptField('concept_diagram_image_alt_ar'), 'Hauberk Capital Concept');

        $conceptSectionTitle = $localizeConcept($conceptField('concept_title_en'), $conceptField('concept_title_ar'), 'HAUBERK CAPITAL AS A CONCEPT');
        $conceptIntro = $localizeConcept($conceptField('concept_intro_en'), $conceptField('concept_intro_ar'));
        $conceptRowDirection = 'lg:flex-row';
        $conceptTextAlignment = $isArabicConcept ? 'text-right lg:pl-12' : 'text-left lg:pr-12';
        $conceptTextDirection = $isArabicConcept ? 'rtl' : 'ltr';
        $conceptTitleAlignment = $isArabicConcept ? 'text-right' : 'text-center';
        $conceptTextOrder = $isArabicConcept ? 'lg:order-2' : 'lg:order-1';
        $conceptImageOrder = $isArabicConcept ? 'lg:order-1' : 'lg:order-2';
        $conceptPillars = [
            [
                'title' => $localizeConcept($conceptField('yield_title_en'), $conceptField('yield_title_ar'), 'Yield'),
                'description' => $localizeConcept($conceptField('yield_description_en'), $conceptField('yield_description_ar')),
            ],
            [
                'title' => $localizeConcept($conceptField('defence_title_en'), $conceptField('defence_title_ar'), 'Defence'),
                'description' => $localizeConcept($conceptField('defence_description_en'), $conceptField('defence_description_ar')),
            ],
            [
                'title' => $localizeConcept($conceptField('appreciation_title_en'), $conceptField('appreciation_title_ar'), 'Appreciation'),
                'description' => $localizeConcept($conceptField('appreciation_description_en'), $conceptField('appreciation_description_ar')),
            ],
            [
                'title' => $localizeConcept($conceptField('liquidity_title_en'), $conceptField('liquidity_title_ar'), 'Liquidity'),
                'description' => $localizeConcept($conceptField('liquidity_description_en'), $conceptField('liquidity_description_ar')),
            ],
        ];
    @endphp

    @if($aboutModel?->isSectionVisible('concept') ?? true)
    <section class="about-section-y bg-[#041B44] text-white py-16 md:py-24 z-0 relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ $conceptBackgroundDesktop }}" alt="" class="hidden md:block w-full h-full object-cover">
            <img src="{{ $conceptBackgroundMobile }}" alt="" class="block md:hidden w-full h-full object-cover">
        </div>

        <div class="about-container container mx-auto px-4 relative z-10 w-full xl:max-w-[1300px] md:max-w-[950px]">
            <div class="{{ $conceptTitleAlignment }} mb-12">
                <h2 class="about-section-title text-[32px] md:text-[40px] xl:text-[48px] leading-[40px] xl:leading-[62px] font-neue-extrabold text-white">
                    {{ $conceptSectionTitle }}
                </h2>
            </div>

            <div class="flex flex-col {{ $conceptRowDirection }} items-center gap-10 lg:gap-0" dir="ltr">
                <div class="w-full lg:w-1/2 {{ $conceptTextAlignment }} {{ $conceptTextOrder }} mb-10 lg:mb-0" dir="{{ $conceptTextDirection }}">
                    @if($conceptIntro)
                        <div class="mb-8">
                            <div class="about-copy font-poppins text-[17px] leading-relaxed opacity-70">
                                {!! $conceptIntro !!}
                            </div>
                        </div>
                    @endif

                    @foreach($conceptPillars as $pillar)
                        @if($pillar['description'])
                            <div class="mb-8">
                                <div class="about-copy font-poppins text-[17px] leading-relaxed opacity-70">
                                    <span class="text-[#D4AF37] font-neue-bold text-xl mb-2">{{ $pillar['title'] }}:</span>
                                    {{ $pillar['description'] }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="w-full lg:w-1/2 flex justify-center items-center {{ $conceptImageOrder }}" dir="ltr">
                    <img src="{{ $conceptDiagramDesktop }}" alt="{{ $conceptDiagramAlt }}" class="about-concept-diagram hidden md:block w-full">
                    <img src="{{ $conceptDiagramMobile }}" alt="{{ $conceptDiagramAlt }}" class="about-concept-diagram block md:hidden w-full">
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(($aboutModel?->isSectionVisible('mission_vision') ?? true) || ($aboutModel?->isSectionVisible('values') ?? true))
    <section class="about-section-y bg-[#041B44] text-white py-16 md:py-24">
        <div class="about-container container mx-auto px-4">
            @php
                $missionVisionRowClass = $isArabic ? 'md:flex-row-reverse' : 'md:flex-row';
                $missionVisionBlockAlign = $isArabic ? 'md:items-end text-center md:text-right' : 'md:items-start text-center md:text-start';
                $missionVisionHeaderRow = $isArabic ? 'md:flex-row-reverse' : 'md:flex-row';
                $missionVisionIconMargin = $isArabic ? 'md:ml-4' : 'md:mr-4';
                $missionVisionHeaderGap = $isArabic ? 'md:gap-4' : '';
                $missionVisionBodyPaddingMission = $isArabic ? 'md:pr-[70px]' : 'md:pl-[70px]';
                $missionVisionBodyPaddingVision = $isArabic ? 'md:pr-[80px]' : 'md:pl-[80px]';
                $missionVisionTextAlign = $isArabic ? 'md:text-right' : 'md:text-left';
                $missionVisionDirection = $isArabic ? 'rtl' : 'ltr';
            @endphp
            @if($aboutModel?->isSectionVisible('mission_vision') ?? true)
            <!-- Mission and Vision Row - Centered -->
            <div class="about-mission-vision-row flex flex-row {{ $missionVisionRowClass }} justify-center items-center md:items-start gap-12 md:gap-[350px] mb-16">
                <!-- Mission Section -->
                <div class="flex flex-col items-center {{ $missionVisionBlockAlign }}">
                    <div class="flex flex-col md:flex {{ $missionVisionHeaderRow }} {{ $missionVisionHeaderGap }} items-center">
                        <img src="{{ isset($about['mission_icon']) && $about['mission_icon'] ? asset('storage/' . $about['mission_icon']) : asset('design') . '/images/mission.svg' }}" alt="Mission" class="mb-2 md:mb-0 mr-0 {{ $missionVisionIconMargin }} w-12 md:w-auto">
                        <h2 class="about-mission-vision-title text-[22px] md:text-[48px] font-neue-extrabold text-white">{{ app()->getLocale() == 'ar' ? ($about['mission_title_ar'] ?? 'المهمة') : ($about['mission_title_en'] ?? 'MISSION') }}</h2>
                    </div>
                    <div class="about-mission-vision-copy text-white {{ $missionVisionBodyPaddingMission }} opacity-70 font-['Poppins'] font-bold text-[10.79px] md:text-[18px] leading-relaxed md:max-w-md {{ $missionVisionTextAlign }}" dir="{{ $missionVisionDirection }}">
                        {{ app()->getLocale() == 'ar' ? ($about['mission_text_ar'] ?? 'Develop HNWI, Family Offices and Endowment\'s investment experience.') : ($about['mission_text_en'] ?? 'Develop HNWI, Family Offices and Endowment\'s investment experience.') }}
                    </div>
                </div>

                <!-- Vision Section -->
                <div class="flex flex-col items-center {{ $missionVisionBlockAlign }}">
                    <div class="flex flex-col md:flex {{ $missionVisionHeaderRow }} {{ $missionVisionHeaderGap }} items-center">
                        <img src="{{ isset($about['vision_icon']) && $about['vision_icon'] ? asset('storage/' . $about['vision_icon']) : asset('design') . '/images/vision.svg' }}" alt="Vision" class="mb-2 md:mb-0 mr-0 {{ $missionVisionIconMargin }} w-12 md:w-auto">
                        <h2 class="about-mission-vision-title text-[22px] md:text-[48px] font-neue-extrabold text-white">{{ app()->getLocale() == 'ar' ? ($about['vision_title_ar'] ?? 'الرؤية') : ($about['vision_title_en'] ?? 'VISION') }}</h2>
                    </div>
                    <div class="about-mission-vision-copy text-white {{ $missionVisionBodyPaddingVision }} opacity-70 font-['Poppins'] font-bold text-[10.79px] md:text-[18px] leading-relaxed md:max-w-md {{ $missionVisionTextAlign }}" dir="{{ $missionVisionDirection }}">
                        {{ app()->getLocale() == 'ar' ? ($about['vision_text_ar'] ?? 'To provide outstanding, cohesive & sustainable investment approach.') : ($about['vision_text_en'] ?? 'To provide outstanding, cohesive & sustainable investment approach.') }}
                    </div>
                </div>
            </div>
            @endif

            @if($aboutModel?->isSectionVisible('values') ?? true)
            <!-- Our Values Section -->
            <div class="text-center mb-12">
                <h2 class="about-section-title text-[32px] md:text-[40px] xl:text-[48px] font-neue-extrabold text-white">{{ app()->getLocale() == 'ar' ? ($about['values_title_ar'] ?? 'OUR VALUES') : ($about['values_title_en'] ?? 'OUR VALUES') }}</h2>
            </div>

            @php
                $valuesRowClass = $isArabic ? 'flex-row-reverse' : '';
                $valuesIconMargin = $isArabic ? 'ml-4' : 'mr-4';
                $valuesHeaderGap = $isArabic ? 'gap-4' : '';
                $valuesHeadingAlign = $isArabic ? 'text-right' : '';
                $valuesBodyPaddingLarge = $isArabic ? 'pr-[75px]' : 'pl-[75px]';
                $valuesBodyPaddingSmall = $isArabic ? 'pr-[70px]' : 'pl-[70px]';
                $valuesTextAlign = $isArabic ? 'text-right' : '';
                $valuesDirection = $isArabic ? 'rtl' : 'ltr';
            @endphp

            @if(isset($about['values']) && is_array($about['values']) && count($about['values']) > 0)
                @php
                    $values = $about['values'];
                @endphp

                <div class="about-values-grid grid grid-cols-1 md:grid-cols-3 gap-6 w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto">
                    @foreach($values as $value)
                    <div class="about-value-card bg-[#041B44] border border-[#1A2F57] rounded-lg p-8 md:p-14 hover:border-[#D4AF37] transition-colors">
                        <div class="flex items-start mb-2 {{ $valuesRowClass }} {{ $valuesHeaderGap }}">
                            <img src="{{ isset($value['icon']) && $value['icon'] ? asset('storage/' . $value['icon']) : asset('design') . '/images/integrity.svg' }}" alt="{{ app()->getLocale() == 'ar' ? $value['title_ar'] : $value['title_en'] }}" class="{{ $valuesIconMargin }}">
                            <h3 class="about-value-title text-[28px] font-['Poppins'] font-bold text-white {{ $valuesHeadingAlign }}">{{ app()->getLocale() == 'ar' ? $value['title_ar'] : $value['title_en'] }}</h3>
                        </div>
                        <div class="about-value-copy text-white opacity-70 {{ $valuesBodyPaddingLarge }} font-['Poppins'] text-[16px] leading-relaxed {{ $valuesTextAlign }}" dir="{{ $valuesDirection }}">
                            {!! app()->getLocale() == 'ar' ? $value['description_ar'] : $value['description_en'] !!}
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback to default values if no dynamic values are set -->
                <div class="about-values-grid grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="about-value-card bg-[#041B44] border border-[#1A2F57] rounded-lg p-8 md:p-14 hover:border-[#D4AF37] transition-colors">
                        <div class="flex items-start mb-2 {{ $valuesRowClass }} {{ $valuesHeaderGap }}">
                            <img src="{{asset('design')}}/images/integrity.svg" alt="Integrity" class="{{ $valuesIconMargin }}">
                            <h3 class="about-value-title text-[28px] font-['Poppins'] font-bold text-white {{ $valuesHeadingAlign }}">Integrity</h3>
                        </div>
                        <div class="about-value-copy text-white opacity-70 {{ $valuesBodyPaddingLarge }} font-['Poppins'] text-[16px] leading-relaxed {{ $valuesTextAlign }}" dir="{{ $valuesDirection }}">
                            Integrity is our philosophy for developing and building a relationship of trust and friendship with our clients.
                        </div>
                    </div>

                    <div class="about-value-card bg-[#041B44] border border-[#1A2F57] rounded-lg p-8 md:p-14 hover:border-[#D4AF37] transition-colors">
                        <div class="flex items-start mb-2 {{ $valuesRowClass }} {{ $valuesHeaderGap }}">
                            <img src="{{asset('design')}}/images/commitment.svg" alt="Commitment" class="{{ $valuesIconMargin }}">
                            <h3 class="about-value-title text-[28px] font-['Poppins'] font-bold text-white {{ $valuesHeadingAlign }}">Commitment</h3>
                        </div>
                        <div class="about-value-copy text-white opacity-70 {{ $valuesBodyPaddingLarge }} font-['Poppins'] text-[16px] leading-relaxed {{ $valuesTextAlign }}" dir="{{ $valuesDirection }}">
                            We commit to our investors with fully managed, high-yield investment products catering to all levels of risk appetite.
                        </div>
                    </div>

                    <div class="about-value-card bg-[#041B44] border border-[#1A2F57] rounded-lg p-8 md:p-14 hover:border-[#D4AF37] transition-colors">
                        <div class="flex items-start mb-2 {{ $valuesRowClass }} {{ $valuesHeaderGap }}">
                            <img src="{{asset('design')}}/images/passion.svg" alt="Passion" class="{{ $valuesIconMargin }}">
                            <h3 class="about-value-title text-[28px] font-['Poppins'] font-bold text-white {{ $valuesHeadingAlign }}">Passion</h3>
                        </div>
                        <div class="about-value-copy text-white opacity-70 {{ $valuesBodyPaddingLarge }} font-['Poppins'] text-[16px] leading-relaxed {{ $valuesTextAlign }}" dir="{{ $valuesDirection }}">
                            Our genuine desire is to help you achieve your goals, dreams and aspirations. And to help you build, preserve and protect your wealth in support of these.
                        </div>
                    </div>
                    <div class="about-value-card bg-[#041B44] border border-[#1A2F57] rounded-lg p-8 md:p-14 hover:border-[#D4AF37] transition-colors">
                        <div class="flex items-start {{ $valuesRowClass }} {{ $valuesHeaderGap }}">
                            <img src="{{asset('design')}}/images/accountability.svg" alt="Accountability" class="{{ $valuesIconMargin }}">
                            <h3 class="about-value-title text-[28px] font-['Poppins'] font-bold text-white {{ $valuesHeadingAlign }}">Accountability</h3>
                        </div>
                        <div class="about-value-copy text-white opacity-70 {{ $valuesBodyPaddingSmall }} font-['Poppins'] text-[16px] leading-relaxed {{ $valuesTextAlign }}" dir="{{ $valuesDirection }}">
                            We are responsible for helping our client achieve their financial goals. At Hauberk, we believe that a successful relationship is built on our capacity to help get our clients to their desired destinations.
                        </div>
                    </div>

                    <div class="about-value-card bg-[#041B44] border border-[#1A2F57] rounded-lg p-8 md:p-14 hover:border-[#D4AF37] transition-colors">
                        <div class="flex items-start {{ $valuesRowClass }} {{ $valuesHeaderGap }}">
                            <img src="{{asset('design')}}/images/sustainability.svg" alt="Sustainability" class="{{ $valuesIconMargin }}">
                            <h3 class="about-value-title text-[28px] font-['Poppins'] font-bold text-white {{ $valuesHeadingAlign }}">Sustainability</h3>
                        </div>
                        <div class="about-value-copy text-white opacity-70 {{ $valuesBodyPaddingSmall }} font-['Poppins'] text-[16px] leading-relaxed {{ $valuesTextAlign }}" dir="{{ $valuesDirection }}">
                            To meet the needs of the present generation without compromising the ability of future generation to meet their own needs. It involve the responsible use of natural resources.
                        </div>
                    </div>
                </div>
            @endif
            @endif
        </div>
    </section>
    @endif

    @if($aboutModel?->isSectionVisible('approach') ?? true)
    <section class="about-approach-section bg-[#041B44] text-white py-16 px-6 md:py-40 bg-cover bg-center bg-no-repeat relative">
        <!-- Desktop Background -->
        <div class="absolute inset-0 hidden md:block">
            @if(isset($about['approach_bg_image']) && $about['approach_bg_image'])
                <img src="{{ asset('storage/' . $about['approach_bg_image']) }}" alt="Approach Background" class="w-full h-full object-cover">
            @else
                <img src="{{ asset('design/images/approach-bg.png') }}" alt="Approach Background" class="w-full h-full object-cover">
            @endif
        </div>
        <!-- Mobile Background -->
        <div class="absolute inset-0 block md:hidden">
            @if(isset($about['approach_mobile_bg_image']) && $about['approach_mobile_bg_image'])
                <img src="{{ asset('storage/' . $about['approach_mobile_bg_image']) }}" alt="Approach Background Mobile" class="w-full h-full object-cover">
            @elseif(isset($about['approach_bg_image']) && $about['approach_bg_image'])
                <img src="{{ asset('storage/' . $about['approach_bg_image']) }}" alt="Approach Background" class="w-full h-full object-cover">
            @else
                <img src="{{ asset('design/images/approach-bg.png') }}" alt="Approach Background" class="w-full h-full object-cover">
            @endif
        </div>
        <div class="about-container container mx-auto px-4 relative z-10">
            <!-- Section Title -->
            <div class="text-center mb-12">
                <h2 class="about-section-title text-[32px] md:text-[40px] xl:text-[48px] font-neue-extrabold text-white">{{ app()->getLocale() == 'ar' ? ($about['approach_title_ar'] ?? 'OUR APPROACH') : ($about['approach_title_en'] ?? 'OUR APPROACH') }}</h2>
            </div>

            <!-- Approach Description -->
            <div class="about-approach-copy max-w-5xl mx-auto text-center mb-24">
                @if($about['approach_description_1_en'] || $about['approach_description_1_ar'])
                <div class="about-copy text-white opacity-70 font-['Poppins'] font-regular text-[21.28px] leading-relaxed mb-6">
                    {!! app()->getLocale() == 'ar' ? ($about['approach_description_1_ar'] ?? '') : ($about['approach_description_1_en'] ?? '') !!}
                </div>
                @endif
                @if($about['approach_description_2_en'] || $about['approach_description_2_ar'])
                <div class="about-copy text-white opacity-70 font-['Poppins'] font-regular text-[21.28px] leading-relaxed">
                    {!! app()->getLocale() == 'ar' ? ($about['approach_description_2_ar'] ?? '') : ($about['approach_description_2_en'] ?? '') !!}
                </div>
                @endif
            </div>

            @php
                $accordionRowClass = $isArabic ? 'flex-row-reverse' : '';
                $accordionHeadingAlign = $isArabic ? 'text-right' : '';
                $accordionContentAlign = $isArabic ? 'text-right' : '';
                $accordionContentDir = $isArabic ? 'rtl' : 'ltr';
            @endphp

            @if(isset($about['approach_items']) && is_array($about['approach_items']) && count($about['approach_items']) > 0)
                @php
                    $approachItems = $about['approach_items'];
                    $chunks = array_chunk($approachItems, 2); // Split into chunks of 2 for grid layout
                @endphp

                @foreach($chunks as $chunkIndex => $chunk)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 {{ $chunkIndex > 0 ? 'mt-6' : 'mb-6' }} w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto">
                    @foreach($chunk as $index => $item)
                        @php
                            $itemId = 'approach-item-' . ($chunkIndex * 2 + $index);
                            $isFirst = $chunkIndex === 0 && $index === 0;
                        @endphp
                        <div class="border-b border-[#808080] pb-6">
                            <div class="flex items-center justify-between {{ $accordionRowClass }}">
                                <h3 class="about-accordion-title text-[28px] font-['Poppins'] font-bold text-white {{ $accordionHeadingAlign }}">{{ app()->getLocale() == 'ar' ? $item['title_ar'] : $item['title_en'] }}</h3>
                                <button class="text-[#D4AF37] toggle-content" data-id="{{ $itemId }}">
                                    <i class="fas fa-chevron-down text-[25px]"></i>
                </button>
                            </div>
                            <div class="mt-4 content-section hidden {{ $accordionContentAlign }}" dir="{{ $accordionContentDir }}" id="{{ $itemId }}">
                                <div class="text-white font-['Poppins'] font-regular text-[18px] {{ $accordionContentAlign }}">
                                    {!! app()->getLocale() == 'ar' ? $item['description_ar'] : $item['description_en'] !!}
                </div>
            </div>
        </div>
    @endforeach
</div>
                @endforeach
            @else
                <!-- Fallback to default approach items if no dynamic items are set -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mb-6">
                    <div class="border-b border-[#808080] pb-6">
                        <div class="flex items-center justify-between {{ $accordionRowClass }}">
                                <h3 class="about-accordion-title text-[28px] font-['Poppins'] font-bold text-white {{ $accordionHeadingAlign }}">Client-Centric Focus</h3>
                            <button class="text-[#D4AF37] toggle-content" data-id="client-centric">
                                <i class="fas fa-chevron-down transform text-[25px]"></i>
                            </button>
                        </div>
                        <div class="mt-4 content-section hidden {{ $accordionContentAlign }}" dir="{{ $accordionContentDir }}" id="client-centric">
                            <p class="text-white font-['Poppins'] font-regular text-[18px] {{ $accordionContentAlign }}">
                                Our top priority is meeting our clients' objectives and evolving needs.</br>
                                - We align our services with the core values of our philosophy.
                            </p>
                        </div>
                    </div>

                    <div class="border-b border-[#808080] pb-6">
                        <div class="flex items-center justify-between {{ $accordionRowClass }}">
                            <h3 class="about-accordion-title text-[28px] font-['Poppins'] font-bold text-white {{ $accordionHeadingAlign }}">Trusted Relationships</h3>
                            <button class="text-[#D4AF37] toggle-content" data-id="trusted-relationships">
                                <i class="fas fa-chevron-down text-[25px]"></i>
                            </button>
                        </div>
                        <div class="mt-4 content-section hidden {{ $accordionContentAlign }}" dir="{{ $accordionContentDir }}" id="trusted-relationships">
                            <p class="text-white font-['Poppins'] font-regular text-[18px] {{ $accordionContentAlign }}">
                                Our long-term relationships with clients and partners are built on trust and mutual respect.</br>
                                - We consistently provide reliable, cost-effective solutions.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mb-6">
                    <div class="border-b border-[#808080] pb-6">
                        <div class="flex items-center justify-between {{ $accordionRowClass }}">
                            <h3 class="about-accordion-title text-[28px] font-['Poppins'] font-bold text-white {{ $accordionHeadingAlign }}">Professional & Adaptive</h3>
                            <button class="text-[#D4AF37] toggle-content" data-id="professional-adaptive">
                                <i class="fas fa-chevron-down text-[25px]"></i>
                            </button>
                        </div>
                        <div class="mt-4 content-section hidden {{ $accordionContentAlign }}" dir="{{ $accordionContentDir }}" id="professional-adaptive">
                            <p class="text-white font-['Poppins'] font-regular text-[18px] {{ $accordionContentAlign }}">
                                We are a professional organization that quickly adjusts to future investor demands.</br>
                                - Our strategies are based on market analysis, inflation tracking, and defensive approaches.
                            </p>
                        </div>
                    </div>

                    <div class="border-b border-[#808080] pb-6">
                        <div class="flex items-center justify-between {{ $accordionRowClass }}">
                            <h3 class="about-accordion-title text-[28px] font-['Poppins'] font-bold text-white {{ $accordionHeadingAlign }}">Technological Innovation</h3>
                            <button class="text-[#D4AF37] toggle-content" data-id="technological-innovation">
                                <i class="fas fa-chevron-down text-[25px]"></i>
                            </button>
                        </div>
                        <div class="mt-4 content-section hidden {{ $accordionContentAlign }}" dir="{{ $accordionContentDir }}" id="technological-innovation">
                            <p class="text-white font-['Poppins'] font-regular text-[18px] {{ $accordionContentAlign }}">
                                Our advanced technological capabilities enable us to develop customized solutions.</br>
                                - We stay at the forefront of technological advancements through continuous research and development.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                    <div class="border-b border-[#808080] pb-6">
                        <div class="flex items-center justify-between {{ $accordionRowClass }}">
                            <h3 class="about-accordion-title text-[28px] font-['Poppins'] font-bold text-white {{ $accordionHeadingAlign }}">Culture of Growth and Innovation</h3>
                            <button class="text-[#D4AF37] toggle-content" data-id="culture-growth">
                                <i class="fas fa-chevron-down text-[25px]"></i>
                            </button>
                        </div>
                        <div class="mt-4 content-section hidden {{ $accordionContentAlign }}" dir="{{ $accordionContentDir }}" id="culture-growth">
                            <p class="text-white font-['Poppins'] font-regular text-[18px] {{ $accordionContentAlign }}">
                                We foster a culture that encourages continuous learning, innovation, and growth for both our team and clients.</br>
                                - We are committed to staying ahead of market trends and evolving investor needs.
                            </p>
                        </div>
                    </div>

                    <div class="border-b border-[#808080] pb-6">
                        <div class="flex items-center justify-between {{ $accordionRowClass }}">
                            <h3 class="about-accordion-title text-[28px] font-['Poppins'] font-bold text-white {{ $accordionHeadingAlign }}">Investment &Growth Opportunities</h3>
                            <button class="text-[#D4AF37] toggle-content" data-id="investment-growth">
                                <i class="fas fa-chevron-down text-[25px]"></i>
                            </button>
                        </div>
                        <div class="mt-4 content-section hidden {{ $accordionContentAlign }}" dir="{{ $accordionContentDir }}" id="investment-growth">
                            <p class="text-white font-['Poppins'] font-regular text-[18px] {{ $accordionContentAlign }}">
                                We identify and capitalize on investment opportunities that align with our clients' goals and risk tolerance.</br>
                                - We seek new investment opportunities, navigate economic fluctuations, and maximize returns through balanced, diversified portfolios.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mt-6">
                    <div class="border-b border-[#808080] pb-6">
                        <div class="flex items-center justify-between {{ $accordionRowClass }}">
                            <h3 class="about-accordion-title text-[28px] font-['Poppins'] font-bold text-white {{ $accordionHeadingAlign }}">Expert Financial Team</h3>
                            <button class="text-[#D4AF37] toggle-content" data-id="expert-team">
                                <i class="fas fa-chevron-down text-[25px]"></i>
                            </button>
                        </div>
                        <div class="mt-4 content-section hidden {{ $accordionContentAlign }}" dir="{{ $accordionContentDir }}" id="expert-team">
                            <p class="text-white font-['Poppins'] font-regular text-[18px] {{ $accordionContentAlign }}">
                                Our team consists of experienced financial professionals dedicated to providing expert guidance and solutions.</br>
                                - We are committed to staying ahead of market trends and evolving investor needs.
                            </p>
                        </div>
                    </div>

                    <div class="border-b border-[#808080] pb-6">
                        <div class="flex items-center justify-between {{ $accordionRowClass }}">
                            <h3 class="about-accordion-title text-[28px] font-['Poppins'] font-bold text-white {{ $accordionHeadingAlign }}">Balanced Portfolio</h3>
                            <button class="text-[#D4AF37] toggle-content" data-id="balanced-portfolio">
                                <i class="fas fa-chevron-down text-[25px]"></i>
                            </button>
                        </div>
                        <div class="mt-4 content-section hidden {{ $accordionContentAlign }}" dir="{{ $accordionContentDir }}" id="balanced-portfolio">
                            <p class="text-white font-['Poppins'] font-regular text-[18px] {{ $accordionContentAlign }}">
                                We create diversified portfolios that balance risk and return to help our clients achieve their financial objectives.</br>
                                - We seek new investment opportunities, navigate economic fluctuations, and maximize returns through balanced, diversified portfolios.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
      </div>

      <script>
            function toggleContent(button) {
                const contentId = button.getAttribute('data-id');
                const contentSection = document.getElementById(contentId);
                const icon = button.querySelector('i');

                // Close all sections first
                document.querySelectorAll('.content-section').forEach(section => {
                    if (section.id !== contentId) {
                        // Add smooth transition for closing
                        if (!section.classList.contains('hidden')) {
                            section.style.maxHeight = section.scrollHeight + 'px';
                            setTimeout(() => {
                                section.style.maxHeight = '0px';
                                section.style.opacity = '0';
                            }, 10);

                            setTimeout(() => {
                                section.classList.add('hidden');
                                section.style.maxHeight = '';
                                section.style.opacity = '';
                            }, 300);
                        }

                        const sectionButton = document.querySelector(`[data-id="${section.id}"]`);
                        if (sectionButton) {
                            sectionButton.querySelector('i').classList.remove('rotate-180');
                        }
                    }
                });

                // Toggle the clicked section with smooth animation
                if (contentSection.classList.contains('hidden')) {
                    // Opening the section
                    contentSection.classList.remove('hidden');
                    contentSection.style.maxHeight = '0px';
                    contentSection.style.opacity = '0';

                    setTimeout(() => {
                        contentSection.style.maxHeight = contentSection.scrollHeight + 'px';
                        contentSection.style.opacity = '1';
                    }, 10);

                    setTimeout(() => {
                        contentSection.style.maxHeight = '';
                    }, 300);

                    icon.classList.add('rotate-180');
                } else {
                    // Closing the section
                    contentSection.style.maxHeight = contentSection.scrollHeight + 'px';

                    setTimeout(() => {
                        contentSection.style.maxHeight = '0px';
                        contentSection.style.opacity = '0';
                    }, 10);

                    setTimeout(() => {
                        contentSection.classList.add('hidden');
                        contentSection.style.maxHeight = '';
                        contentSection.style.opacity = '';
                    }, 300);

                    icon.classList.remove('rotate-180');
                }
            }

            // Add event listeners to all toggle buttons
        document.addEventListener('DOMContentLoaded', function() {
                // Add CSS for smooth transitions
          const style = document.createElement('style');
          style.textContent = `
                    .content-section {
                        transition: max-height 0.3s ease-out, opacity 0.3s ease-out;
              overflow: hidden;
              opacity: 1;
                    }
                    .rotate-180 {
                        transition: transform 0.3s ease;
              transform: rotate(180deg);
            }
                    i.fas {
                        transition: transform 0.3s ease;
                    }
          `;
          document.head.appendChild(style);

                document.querySelectorAll('.toggle-content').forEach(button => {
            button.addEventListener('click', function() {
                        toggleContent(this);
            });
          });
        });
      </script>
    </section>
    @endif

@endsection

@extends('app')

@section('content')
    @php
        $localize = $localize ?? function ($en, $ar) {
            return app()->getLocale() === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
        };
        $defaultHeroTitle = app()->getLocale() === 'ar'
            ? ($teamsData['hero_title_ar'] ?? 'BOARD OF DIRECTORS')
            : ($teamsData['hero_title_en'] ?? 'BOARD OF DIRECTORS');
        $pageH1 = isset($seoMeta)
            ? ($localize($seoMeta->h1_en ?? null, $seoMeta->h1_ar ?? null) ?? $defaultHeroTitle)
            : $defaultHeroTitle;
        $isArabic = app()->getLocale() === 'ar';
    @endphp
    <style>
        /* Ensure directors section description text stays white */
        .directors-section-description,
        .directors-section-description *,
        .directors-section-description p,
        .directors-section-description div,
        .directors-section-description span {
            color: white !important;
        }

        /* Override any RichEditor inline styles */
        .directors-section-description [style*="color"] {
            color: white !important;
        }
    </style>

    @if($teamsData?->isSectionVisible('hero') ?? true)
    <!-- Hero Section -->
    <section class="bg-navy-900 text-white h-screen md:h-[70vh] relative ">
        <div class="relative overflow-hidden h-full">
            <div class="flex flex-col h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full">
                    <div class="w-full flex-shrink-0 relative">
                        <div class="absolute inset-0">
                            <!-- Desktop background -->
                            @if($teamsData && $teamsData->hero_desktop_image)
                                <img src="{{ asset('storage/' . $teamsData->hero_desktop_image) }}" alt="Wealth Management" class="hidden md:block w-full h-full object-cover"/>
                            @else
                                <img src="{{ asset('design/images/board-hero.png') }}" alt="Wealth Management" class="hidden md:block w-full h-full object-cover"/>
                            @endif
                            <!-- Mobile background -->
                            @if($teamsData && $teamsData->hero_mobile_image)
                                <img src="{{ asset('storage/' . $teamsData->hero_mobile_image) }}" alt="Wealth Management" class="block md:hidden w-full h-full object-cover"/>
                            @else
                                <img src="{{ asset('design/images/mobile-board-hero.png') }}" alt="Wealth Management" class="block md:hidden w-full h-full object-cover"/>
                            @endif
                        </div>
                        <div class="absolute inset-0 "></div>
                        <div class="relative h-[120vh] md:h-[90vh] flex items-center justify-center w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto">
                            <div class="container mx-auto text-center">
                                <h1 class="text-[45px] xl:text-[78px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">
                                    {{ $pageH1 }}
                                </h1>
                                <div class="mb-8 text-[17px] xl:text-[18px] text-[#FFFFFF]/70 font-['Poppins'] font-regular">
                                    @php
                                        $heroSubtitle = app()->getLocale() == 'ar'
                                            ? (is_string($teamsData->hero_subtitle_ar ?? '') ? $teamsData->hero_subtitle_ar : 'اكتشف القادة الرؤيويين الذين يقودون هوبيرك كابيتال نحو آفاق جديدة')
                                            : (is_string($teamsData->hero_subtitle_en ?? '') ? $teamsData->hero_subtitle_en : 'Discover the visionary leaders steering Hauberk Capital towards new heights');
                                    @endphp
                                    {!! $heroSubtitle !!}
                                </div>
                                <a href="{{ $teamsData->hero_button_link ?? 'request-a-meeting' }}" class="bg-[#D4AF37] px-6 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">
                                    @php
                                        $heroButton = app()->getLocale() == 'ar'
                                            ? (is_string($teamsData->hero_button_text_ar ?? '') ? $teamsData->hero_button_text_ar : 'طلب اجتماع')
                                            : (is_string($teamsData->hero_button_text_en ?? '') ? $teamsData->hero_button_text_en : 'REQUEST A MEETING');
                                    @endphp
                                    {{ $heroButton }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(($teamsData?->isSectionVisible('leadership') ?? true) || ($teamsData?->isSectionVisible('directors') ?? true))
    <!-- Leadership Section -->
    <section class="relative py-16 md:py-24 md:overflow-hidden">
        <!-- Background image -->
        <div class="absolute inset-0 hidden md:block">
            @if($teamsData && $teamsData->leadership_background_image)
                <img src="{{ asset('storage/' . $teamsData->leadership_background_image) }}" alt="Leadership Background" class="w-full h-full object-cover">
            @else
                <img src="{{ asset('design/images/board-leadership-bg.png') }}" alt="Leadership Background" class="w-full h-full object-cover">
            @endif
        </div>

        <!-- Mobile Background image -->
        <div class="absolute inset-0 block md:hidden">
            @if($teamsData && $teamsData->leadership_mobile_background_image)
                <img src="{{ asset('storage/' . $teamsData->leadership_mobile_background_image) }}" alt="Leadership Background Mobile" class="w-full h-full object-cover">
            @else
                <img src="{{ asset('design/images/mobile-board-leadership-bg.png') }}" alt="Leadership Background Mobile" class="w-full h-full object-cover">
            @endif
        </div>

        <div class="container mx-auto px-4 relative w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto">
            @if($teamsData?->isSectionVisible('leadership') ?? true)
            <!-- Leadership Heading and Text -->
            <div class="mb-12 md:mb-16 md:w-[70%]">
                <h2 class="text-[36px] md:text-[48px] font-neue-extrabold text-white leading-[48px] md:leading-[62px] mb-6 text-center md:text-left">
                    @php
                        $sectionTitle = app()->getLocale() == 'ar'
                            ? (is_string($teamsData->directors_section_title_ar ?? '') ? $teamsData->directors_section_title_ar : 'القيادة الرؤيوية، التأثير الدائم')
                            : (is_string($teamsData->directors_section_title_en ?? '') ? $teamsData->directors_section_title_en : 'VISIONARY LEADERSHIP, LASTING IMPACT');
                    @endphp
                    {{ $sectionTitle }}
                </h2>
                <div class="directors-section-description text-white opacity-70 font-['Poppins'] text-[18px] leading-relaxed text-center md:text-left" style="color: white !important;">
                    {!! app()->getLocale() == 'ar' ? ($teamsData->directors_section_description_ar ?? 'At Hauberk Capital, our Board of Directors brings unparalleled global expertise in investment and wealth management. With strategic foresight and governance excellence, they drive sustainable growth, ensuring strong risk management and long-term value for all stakeholders.') : ($teamsData->directors_section_description_en ?? 'At Hauberk Capital, our Board of Directors brings unparalleled global expertise in investment and wealth management. With strategic foresight and governance excellence, they drive sustainable growth, ensuring strong risk management and long-term value for all stakeholders.') !!}
                </div>
            </div>
            @endif

            @if($teamsData?->isSectionVisible('directors') ?? true)
            <!-- Team Member Slider -->
            <div class="relative">
                <!-- Navigation Arrows - Desktop -->
                @php
                    $showNavigation = false;
                    if($teamsData && $teamsData->directors) {
                        $totalDirectors = count($teamsData->directors);
                        $showNavigation = $totalDirectors > 3;
                    }
                @endphp

                <button id="prev-slide" class="hidden md:block absolute left-0 top-1/2 -translate-y-1/2 -ml-8 z-10 bg-[#041B44]/30 rounded-full p-2 text-white hover:bg-[#041B44]/50 transition-all {{ !$showNavigation ? 'opacity-50 cursor-not-allowed' : '' }}" {{ !$showNavigation ? 'disabled' : '' }}>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <button id="next-slide" class="hidden md:block absolute right-0 top-1/2 -translate-y-1/2 -mr-8 z-10 bg-[#041B44]/30 rounded-full p-2 text-white hover:bg-[#041B44]/50 transition-all {{ !$showNavigation ? 'opacity-50 cursor-not-allowed' : '' }}" {{ !$showNavigation ? 'disabled' : '' }}>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Team Members Grid -->
                <!-- Desktop View - Grid -->
                <div id="directors-grid" class="hidden overflow-hidden md:block mt-12">
                    <div id="directors-slider" class="">
                        <div class="flex transition-transform duration-500 ease-in-out">
                            @if($teamsData && $teamsData->directors)
                                @php
                                    $directors = $teamsData->directors;
                                    $directorsPerSlide = 3;
                                    $totalSlides = ceil(count($directors) / $directorsPerSlide);
                                @endphp

                                @for($slide = 0; $slide < $totalSlides; $slide++)
                                    <div class="min-w-full flex-shrink-0 flex justify-around gap-8">
                                        @for($i = 0; $i < $directorsPerSlide; $i++)
                                            @php $directorIndex = $slide * $directorsPerSlide + $i; @endphp
                                            @if($directorIndex < count($directors))
                                                @php $director = $directors[$directorIndex]; @endphp
                                                <div class="text-center director-slide" data-slide="{{ $slide }}">
                                                    <div class="bg-white rounded-lg overflow-hidden w-[280px] h-[380px] mb-4 cursor-pointer director-image" data-director="{{ strtolower(str_replace(' ', '-', is_string($director['name_en'] ?? '') ? $director['name_en'] : '')) }}">
                                                        @if($director['image'])
                                                            <img src="{{ asset('storage/' . $director['image']) }}" alt="{{ is_string($director['name_en'] ?? '') ? $director['name_en'] : 'Director' }}" class="w-full h-full object-cover object-center">
                                                        @else
                                                            <img src="{{ asset('design/images/wael.png') }}" alt="{{ is_string($director['name_en'] ?? '') ? $director['name_en'] : 'Director' }}" class="w-full h-full object-cover object-center">
                                                        @endif
                                                    </div>
                                                    <p class="text-[#FFFFFF] font-neue-bold text-xl mt-3">
                                                        @php
                                                            $directorName = app()->getLocale() == 'ar'
                                                                ? (is_string($director['name_ar'] ?? '') ? $director['name_ar'] : (is_string($director['name_en'] ?? '') ? $director['name_en'] : 'عضو مجلس الإدارة'))
                                                                : (is_string($director['name_en'] ?? '') ? $director['name_en'] : 'Board Member');
                                                        @endphp
                                                        {{ $directorName }}
                                                    </p>
                                                    <div class="text-[#FFFFFF] opacity-70 font-['Poppins']">
                                                        @php
                                                            $directorPosition = app()->getLocale() == 'ar'
                                                                ? (is_string($director['position_ar'] ?? '') ? $director['position_ar'] : (is_string($director['position_en'] ?? '') ? $director['position_en'] : 'منصب'))
                                                                : (is_string($director['position_en'] ?? '') ? $director['position_en'] : 'Position');
                                                        @endphp
                                                        {{ $directorPosition }}
                                                    </div>
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                @endfor
                            @else
                                <!-- Fallback directors -->
                                <div class="min-w-full flex-shrink-0 flex justify-center gap-8">
                                    <div class="text-center director-slide" data-slide="0">
                                        <div class="bg-white rounded-lg overflow-hidden w-[280px] h-[380px] mb-4 cursor-pointer director-image" data-director="wael">
                                            <img src="{{ asset('design/images/wael.png') }}" alt="Wael Fawzi" class="w-full h-full object-cover object-center">
                                        </div>
                                        <p class="text-[#FFFFFF] font-neue-bold text-xl mt-3">Wael Fawzi</p>
                                        <p class="text-[#FFFFFF] opacity-70 font-['Poppins']">Managing Director</p>
                                    </div>

                                    <div class="text-center director-slide" data-slide="0">
                                        <div class="bg-white rounded-lg overflow-hidden w-[280px] h-[380px] mb-4 cursor-pointer director-image" data-director="natalia">
                                            <img src="{{ asset('design/images/natalia.png') }}" alt="Natalia Biryukova" class="w-full h-full object-cover object-center">
                                        </div>
                                        <p class="text-white font-neue-bold text-xl mt-3">Natalia Biryukova</p>
                                        <div class="text-white opacity-70 font-['Poppins']">Director</div>
                                    </div>

                                    <div class="text-center director-slide" data-slide="0">
                                        <div class="bg-white rounded-lg overflow-hidden w-[280px] h-[380px] mb-4 cursor-pointer director-image" data-director="motesm">
                                            <img src="{{ asset('design/images/motasem.png') }}" alt="Motesm Aggad" class="w-full h-full object-cover object-center">
                                        </div>
                                        <p class="text-white font-neue-bold text-xl mt-3">Motesm Aggad</p>
                                        <div class="text-white opacity-70 font-['Poppins']">Director</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Mobile View - Carousel -->
                <div id="directors-carousel" class="md:hidden relative mt-8">
                    <!-- Mobile Navigation Arrows -->
                    <button id="mobile-prev-slide" class="absolute left-2 top-1/2 -translate-y-1/2 z-10 bg-[#041B44]/50 rounded-full p-2 text-white hover:bg-[#041B44]/70 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <button id="mobile-next-slide" class="absolute right-2 top-1/2 -translate-y-1/2 z-10 bg-[#041B44]/50 rounded-full p-2 text-white hover:bg-[#041B44]/70 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div class="overflow-hidden">
                        <div id="mobile-slider" class="flex transition-transform duration-300 ease-in-out">
                            @if($teamsData && $teamsData->directors)
                                @foreach($teamsData->directors as $index => $director)
                                    <div class="min-w-full px-4 mobile-slide" data-slide="{{ $index }}">
                                        <div class="flex flex-col items-center">
                                            <div class="bg-white rounded-lg overflow-hidden w-[240px] h-[320px] mb-4 cursor-pointer director-image" data-director="{{ strtolower(str_replace(' ', '-', is_string($director['name_en'] ?? '') ? $director['name_en'] : '')) }}">
                                                @if($director['image'])
                                                    <img src="{{ asset('storage/' . $director['image']) }}" alt="{{ is_string($director['name_en'] ?? '') ? $director['name_en'] : 'Director' }}" class="w-full h-full object-cover object-center">
                                                @else
                                                    <img src="{{ asset('design/images/wael.png') }}" alt="{{ is_string($director['name_en'] ?? '') ? $director['name_en'] : 'Director' }}" class="w-full h-full object-cover object-center">
                                                @endif
                                            </div>
                                            <p class="text-white font-neue-bold text-xl mt-2">
                                                @php
                                                    $mobileDirectorName = app()->getLocale() == 'ar'
                                                        ? (is_string($director['name_ar'] ?? '') ? $director['name_ar'] : (is_string($director['name_en'] ?? '') ? $director['name_en'] : 'عضو مجلس الإدارة'))
                                                        : (is_string($director['name_en'] ?? '') ? $director['name_en'] : 'Board Member');
                                                @endphp
                                                {{ $mobileDirectorName }}
                                            </p>
                                            <div class="text-white opacity-70 font-['Poppins'] text-sm">
                                                @php
                                                    $mobileDirectorPosition = app()->getLocale() == 'ar'
                                                        ? (is_string($director['position_ar'] ?? '') ? $director['position_ar'] : (is_string($director['position_en'] ?? '') ? $director['position_en'] : 'منصب'))
                                                        : (is_string($director['position_en'] ?? '') ? $director['position_en'] : 'Position');
                                                @endphp
                                                {{ $mobileDirectorPosition }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Fallback directors for mobile -->
                                <div class="min-w-full px-4 mobile-slide" data-slide="0">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-white rounded-lg overflow-hidden w-[240px] h-[320px] mb-4 cursor-pointer director-image" data-director="wael">
                                            <img src="{{ asset('design/images/wael.png') }}" alt="Wael Fawzi" class="w-full h-full object-cover object-center">
                                        </div>
                                        <p class="text-white font-neue-bold text-xl mt-2">Wael Fawzi</p>
                                        <p class="text-white opacity-70 font-['Poppins'] text-sm">Managing Director</p>
                                    </div>
                                </div>

                                <div class="min-w-full px-4 mobile-slide" data-slide="1">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-white rounded-lg overflow-hidden w-[240px] h-[320px] mb-4 cursor-pointer director-image" data-director="natalia">
                                            <img src="{{ asset('design/images/natalia.png') }}" alt="Natalia Biryukova" class="w-full h-full object-cover object-center">
                                        </div>
                                        <p class="text-white font-neue-bold text-xl mt-2">Natalia Biryukova</p>
                                        <p class="text-white opacity-70 font-['Poppins'] text-sm">Director</p>
                                    </div>
                                </div>

                                <div class="min-w-full px-4 mobile-slide" data-slide="2">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-white rounded-lg overflow-hidden w-[240px] h-[320px] mb-4 cursor-pointer director-image" data-director="motesm">
                                            <img src="{{ asset('design/images/motasem.png') }}" alt="Motesm Aggad" class="w-full h-full object-cover object-center">
                                        </div>
                                        <p class="text-white font-neue-bold text-xl mt-2">Motesm Aggad</p>
                                        <p class="text-white opacity-70 font-['Poppins'] text-sm">Director</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Pagination Dots (Mobile Only) -->
                @if($teamsData && $teamsData->directors && count($teamsData->directors) > 1)
                    <div class="justify-center mt-8 space-x-2 md:flex" id="teams-pagination-dots">
                        @foreach($teamsData->directors as $index => $director)
                            <span class="w-3 h-3 {{ $index === 0 ? 'bg-[#D4AF37]' : 'bg-white/30' }} rounded-full cursor-pointer pagination-dot" data-director="{{ $index }}"></span>
                        @endforeach
                    </div>
                @endif

                <!-- Director Bio Popups -->
                @if($teamsData && $teamsData->directors)
                    @foreach($teamsData->directors as $index => $director)
                        <div id="teams-director-popup-{{ strtolower(str_replace(' ', '-', is_string($director['name_en'] ?? '') ? $director['name_en'] : 'director')) }}" class="fixed inset-0 bg-black/80 z-50 hidden overflow-y-auto">
                            <div class="bg-[#020711] text-white p-6 rounded-lg max-w-6xl mx-4 my-8 relative">
                                <button class="absolute top-4 right-4 text-white teams-close-popup">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                <div class="flex flex-col md:flex-row gap-8">
                                    <div class="hidden md:block md:w-1/2 flex flex-col justify-center space-y-4">
                                        <h2 class="text-[35px] font-neue-extrabold text-white text-center">
                                            {{ app()->getLocale() == 'ar' ? (is_string($director['name_ar'] ?? '') ? $director['name_ar'] : (is_string($director['name_en'] ?? '') ? $director['name_en'] : 'Director')) : (is_string($director['name_en'] ?? '') ? $director['name_en'] : 'Director') }}
                                        </h2>
                                        @if($director['popup_image'])
                                            <img src="{{ asset('storage/' . $director['popup_image']) }}" alt="{{ is_string($director['name_en'] ?? '') ? $director['name_en'] : 'Director' }}" class="w-full rounded-lg">
                                        @else
                                            <img src="{{ asset('design/images/wael.png') }}" alt="{{ is_string($director['name_en'] ?? '') ? $director['name_en'] : 'Director' }}" class="w-full rounded-lg">
                                        @endif
                                    </div>
                                    <div class="md:w-2/3">
                                        <div class="mt-20">
                                            <div class="text-sm leading-relaxed">
                                                @if(isset($director['bio_ar']) && app()->getLocale() == 'ar')
                                                    {!! $director['bio_ar'] !!}
                                                @elseif(isset($director['bio']))
                                                    {!! $director['bio'] !!}
                                                @else
                                                    Experienced professional with deep expertise in financial services and wealth management.
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback popups for default directors -->
                    <div id="teams-director-popup-wael" class="fixed inset-0 bg-black/80 z-50 hidden overflow-y-auto">
                        <div class="bg-[#020711] text-white p-6 rounded-lg max-w-6xl mx-4 my-8 relative">
                            <button class="absolute top-4 right-4 text-white teams-close-popup">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <div class="flex flex-col md:flex-row gap-8">
                                <div class="hidden md:block md:w-1/2 flex flex-col justify-center space-y-4">
                                    <h2 class="text-[35px] font-neue-extrabold text-white text-center">WAEL FAWZI</h2>
                                    <img src="{{ asset('design/images/wael.png') }}" alt="Wael Fawzi" class="w-full rounded-lg">
                                </div>
                                <div class="md:w-2/3">
                                    <div class="mt-20">
                                        <div class="text-sm leading-relaxed">
                                            Wael Fawzi is a visionary leader with over 25 years of experience in global financial markets. As the founder and CEO of Hauberk Capital, he has built the firm into a premier wealth advisory platform. Former Head of Investment Banking at major regional bank, he is an expert in family office structuring and governance. He holds an MBA from Harvard Business School and is a Chartered Financial Analyst (CFA).
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="teams-director-popup-natalia" class="fixed inset-0 bg-black/80 z-50 hidden overflow-y-auto">
                        <div class="bg-[#020711] text-white p-6 rounded-lg max-w-6xl mx-4 my-8 relative">
                            <button class="absolute top-4 right-4 text-white teams-close-popup">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <div class="flex flex-col md:flex-row gap-8">
                                <div class="hidden md:block md:w-1/2 flex flex-col justify-center space-y-4">
                                    <h2 class="text-[35px] font-neue-extrabold text-white text-center">NATALIA BIRYUKOVA</h2>
                                    <img src="{{ asset('design/images/natalia.png') }}" alt="Natalia Biryukova" class="w-full rounded-lg">
                                </div>
                                <div class="md:w-2/3">
                                    <div class="mt-20">
                                        <div class="text-sm leading-relaxed">
                                            Natalia Biryukova brings over two decades of institutional investment expertise to Hauberk Capital. As Director of Investment Strategy, she leads the development of sophisticated investment solutions. Former Portfolio Manager at major asset management firm, she is an expert in alternative investments and hedge funds. She holds a Master of Science in Finance from London School of Economics and is a Chartered Alternative Investment Analyst (CAIA).
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="teams-director-popup-motesm" class="fixed inset-0 bg-black/80 z-50 hidden overflow-y-auto">
                        <div class="bg-[#020711] text-white p-6 rounded-lg max-w-6xl mx-4 my-8 relative">
                            <button class="absolute top-4 right-4 text-white teams-close-popup">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <div class="flex flex-col md:flex-row gap-8">
                                <div class="hidden md:block md:w-1/2 flex flex-col justify-center space-y-4">
                                    <h2 class="text-[35px] font-neue-extrabold text-white text-center">MOTESM AGGAD</h2>
                                    <img src="{{ asset('design/images/motasem.png') }}" alt="Motesm Aggad" class="w-full rounded-lg">
                                </div>
                                <div class="md:w-2/3">
                                    <div class="mt-20">
                                        <div class="text-sm leading-relaxed">
                                            Motesm Aggad is a distinguished client relations expert with nearly two decades of experience serving high-net-worth individuals and family offices. As Director of Client Relations at Hauberk Capital, he brings 18+ years in private banking and client services. Former Relationship Manager at Swiss private bank, he is an expert in family office services and succession planning. He holds a Master of Business Administration from INSEAD and is a Certified Financial Planner (CFP).
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @endif
        </div>
    </section>
    @endif

    @if(($teamsData?->isSectionVisible('departments') ?? true) || ($teamsData?->isSectionVisible('department_details') ?? true))
    <!-- Departments Section -->
    <section id="departments-section" class="bg-[#041B44] text-white py-16 md:py-24 bg-cover bg-center bg-no-repeat"
             style="background-image: url('{{ $teamsData && $teamsData->departments_mobile_background_image ? asset('storage/' . $teamsData->departments_mobile_background_image) : asset('images/mobile-departments-bg.png') }}');">
        <style>
            @media (min-width: 768px) {
                #departments-section {
                    background-image: url('{{ $teamsData && $teamsData->departments_background_image ? asset('storage/' . $teamsData->departments_background_image) : asset('images/departments-bg.png') }}') !important;
                }
            }
        </style>
        <div class="container mx-auto px-4">
            @if($teamsData?->isSectionVisible('departments') ?? true)
            <!-- Section Title -->
            <div class="text-center mb-6">
                <h2 class="text-[32px] md:text-[48px] font-neue-extrabold text-white">
                    {{ app()->getLocale() == 'ar' ? ($teamsData->departments_title_ar ?? 'HAUBERK DEPARTMENTS') : ($teamsData->departments_title_en ?? 'HAUBERK DEPARTMENTS') }}
                </h2>
            </div>

            <!-- Section Description -->
            <div class="text-center mb-12 max-w-3xl mx-auto">
                <div class="text-white opacity-70 font-poppins text-[18px] md:text-[18px]" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
                    {{ app()->getLocale() == 'ar' ? ($teamsData->departments_description_ar ?? 'Explore the dynamic teams that drive our innovation and expertise, each dedicated to optimizing your wealth advisory experience.') : ($teamsData->departments_description_en ?? 'Explore the dynamic teams that drive our innovation and expertise, each dedicated to optimizing your wealth advisory experience.') }}
                </div>
            </div>
            @endif

            @php
                $departmentsTabsDirection = $isArabic ? 'flex-row-reverse' : '';
                $departmentsContentDirection = $isArabic ? 'md:flex-row-reverse' : 'md:flex-row';
                $departmentsTextAlign = $isArabic ? 'text-right md:text-right' : 'text-left md:text-left';
                $departmentsDir = $isArabic ? 'rtl' : 'ltr';
            @endphp

            <!-- Department Tabs -->
            <div class="max-w-6xl mx-auto">
                @if($teamsData?->isSectionVisible('departments') ?? true)
                <!-- Tab Navigation -->
                <div class="flex flex-wrap justify-center max-w-[95%] bg-[#D4AF37] rounded-t-lg overflow-hidden {{ $departmentsTabsDirection }}" style="justify-self: center;">
                    <button class="tab-button bg-white text-[#041B44] py-3 px-2 md:px-6 font-neue-bold text-[0.30rem] md:text-base border-b-2 border-[#D4AF37] flex-1 min-w-0 relative" data-tab="investment">
                        <div class="text-center leading-tight">
                            {{ app()->getLocale() == 'ar' ? ($teamsData->investment_advisory_title_ar ?? 'الاستشارات الاستثمارية') : ($teamsData->investment_advisory_title_en ?? 'INVESTMENT<br>ADVISORY') }}
                        </div>
                    </button>
                    <button class="tab-button bg-[#D4AF37] text-white py-3 px-2 md:px-6 font-neue-bold text-[0.30rem] md:text-base border-b-2 border-transparent flex-1 min-w-0" data-tab="financial">
                        <div class="text-center leading-tight">
                            {{ app()->getLocale() == 'ar' ? ($teamsData->financial_planning_title_ar ?? 'التخطيط المالي') : ($teamsData->financial_planning_title_en ?? 'FINANCIAL<br>PLANNING') }}
                        </div>
                    </button>
                    <button class="tab-button bg-[#D4AF37] text-white py-3 px-2 md:px-6 font-neue-bold text-[0.30rem] md:text-base border-b-2 border-transparent flex-1 min-w-0" data-tab="research">
                        <div class="text-center leading-tight">
                            {{ app()->getLocale() == 'ar' ? ($teamsData->research_analysis_title_ar ?? 'البحث والتحليل') : ($teamsData->research_analysis_title_en ?? 'RESEARCH<br>&ANALYSIS') }}
                        </div>
                    </button>
                    <button class="tab-button bg-[#D4AF37] text-white py-3 px-2 md:px-6 font-neue-bold text-[0.30rem] md:text-base border-b-2 border-transparent flex-1 min-w-0" data-tab="client">
                        <div class="text-center leading-tight">
                            {{ app()->getLocale() == 'ar' ? ($teamsData->client_relations_title_ar ?? 'علاقات العملاء') : ($teamsData->client_relations_title_en ?? 'CLIENT<br>RELATIONS') }}
                        </div>
                    </button>
                    <button class="tab-button bg-[#D4AF37] text-white py-3 px-2 md:px-6 font-neue-bold text-[0.30rem] md:text-base border-b-2 border-transparent flex-1 min-w-0" data-tab="compliance">
                        <div class="text-center leading-tight">
                            {{ app()->getLocale() == 'ar' ? ($teamsData->compliance_legal_title_ar ?? 'الامتثال والقانونية') : ($teamsData->compliance_legal_title_en ?? 'COMPLIANCE<br>AND LEGAL') }}
                        </div>
                    </button>
                    <button class="tab-button bg-[#D4AF37] text-white py-3 px-2 md:px-6 font-neue-bold text-[0.30rem] md:text-base border-b-2 border-transparent flex-1 min-w-0" data-tab="operations">
                        <div class="text-center leading-tight">
                            {{ app()->getLocale() == 'ar' ? ($teamsData->operations_admin_title_ar ?? 'العمليات والإدارة') : ($teamsData->operations_admin_title_en ?? 'OPERATIONS &<br>ADMINISTRATION') }}
                        </div>
                    </button>
                </div>
                @endif

                @if($teamsData?->isSectionVisible('department_details') ?? true)
                <!-- Tab Content -->
                <div class="bg-white rounded-[20px] overflow-hidden">
                    <!-- Investment Advisory Content -->
                    <div class="tab-content" id="investment-content">
                        <div class="flex flex-col {{ $departmentsContentDirection }}">
                            <div class="w-full md:w-1/3 p-6 md:p-8">
                                @if($teamsData && $teamsData->investment_advisory_image)
                                    <img src="{{ asset('storage/' . $teamsData->investment_advisory_image) }}" alt="Investment Advisory" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('design/images/placeholder.png') }}" alt="Investment Advisory" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="w-full md:w-2/3 p-6 md:p-8 {{ $departmentsTextAlign }}" dir="{{ $departmentsDir }}">
                                <div class="text-[#D4AF37] text-sm mb-2">{{ app()->getLocale() == 'ar' ? ($teamsData->departments_subtitle_ar ?? 'اعرف هوبيرك') : ($teamsData->departments_subtitle_en ?? 'Know Hauberk') }}</div>
                                <h4 class="text-xl md:text-2xl font-neue-bold text-[#041B44] mb-4">
                                    {{ app()->getLocale() == 'ar' ? ($teamsData->investment_advisory_title_ar ?? 'الاستشارات الاستثمارية') : ($teamsData->investment_advisory_title_en ?? 'INVESTMENT ADVISORY') }}
                                </h4>
                                <div class="text-[#041B44] opacity-70 font-sf-pro-regular leading-relaxed mb-6">
                                    {!! app()->getLocale() == 'ar' ? ($teamsData->investment_advisory_description_ar ?? 'Our Investment Advisory team creates personalized investment strategies aligned with your financial goals and risk tolerance. They continuously monitor market trends to optimize your portfolio performance.') : ($teamsData->investment_advisory_description_en ?? 'Our Investment Advisory team creates personalized investment strategies aligned with your financial goals and risk tolerance. They continuously monitor market trends to optimize your portfolio performance.') !!}
                                </div>
                                <a href="{{ $teamsData->investment_advisory_url ?? '#' }}" class="text-[#D4AF37] font-poppins text-[12.56px] md:text-[15.07px] font-normal hover:underline md:mt-14 inline-block">
                                    {{ app()->getLocale() == 'ar' ? ($teamsData->investment_advisory_link_ar ?? 'تواصل مع فريق الاستشارات الاستثمارية') : ($teamsData->investment_advisory_link_en ?? 'Contact Hauberk Investment Advisory team') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Research & Analysis Content -->
                    <div class="tab-content hidden" id="research-content">
                        <div class="flex flex-col {{ $departmentsContentDirection }}">
                            <div class="w-full md:w-1/3 p-6 md:p-8">
                                @if($teamsData && $teamsData->research_analysis_image)
                                    <img src="{{ asset('storage/' . $teamsData->research_analysis_image) }}" alt="Research & Analysis" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('design/images/research.png') }}" alt="Research & Analysis" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="w-full md:w-2/3 p-6 md:p-8 {{ $departmentsTextAlign }}" dir="{{ $departmentsDir }}">
                                <div class="text-[#D4AF37] text-sm mb-2">{{ app()->getLocale() == 'ar' ? ($teamsData->departments_subtitle_ar ?? 'اعرف هوبيرك') : ($teamsData->departments_subtitle_en ?? 'Know Hauberk') }}</div>
                                <h4 class="text-xl md:text-2xl font-neue-bold text-[#041B44] mb-4">
                                    {{ app()->getLocale() == 'ar' ? ($teamsData->research_analysis_title_ar ?? 'البحث والتحليل') : ($teamsData->research_analysis_title_en ?? 'RESEARCH &ANALYSIS') }}
                                </h4>
                                <div class="text-[#041B44] opacity-70 font-sf-pro-regular leading-relaxed mb-6">
                                    {!! app()->getLocale() == 'ar' ? ($teamsData->research_analysis_description_ar ?? 'The Research and Analysis team conducts in-depth analysis of financial markets, economic trends, and specific investment opportunities. Their insights and reports support the Investment Management team in making informed investment decisions.') : ($teamsData->research_analysis_description_en ?? 'The Research and Analysis team conducts in-depth analysis of financial markets, economic trends, and specific investment opportunities. Their insights and reports support the Investment Management team in making informed investment decisions.') !!}
                                </div>
                                <a href="{{ $teamsData->research_analysis_url ?? '#' }}" class="text-[#D4AF37] font-poppins text-[12.56px] md:text-[15.07px] font-normal hover:underline md:mt-14 inline-block">
                                    {{ app()->getLocale() == 'ar' ? ($teamsData->research_analysis_link_ar ?? 'تواصل مع فريق البحث والتحليل') : ($teamsData->research_analysis_link_en ?? 'Contact Hauberk Research & Analysis team') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Financial Planning Content -->
                    <div class="tab-content hidden" id="financial-content">
                        <div class="flex flex-col {{ $departmentsContentDirection }}">
                            <div class="w-full md:w-1/3 p-6 md:p-8">
                                @if($teamsData && $teamsData->financial_planning_image)
                                    <img src="{{ asset('storage/' . $teamsData->financial_planning_image) }}" alt="Financial Planning" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('design/images/placeholder.png') }}" alt="Financial Planning" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="w-full md:w-2/3 p-6 md:p-8 {{ $departmentsTextAlign }}" dir="{{ $departmentsDir }}">
                                <div class="text-[#D4AF37] text-sm mb-2">{{ app()->getLocale() == 'ar' ? ($teamsData->departments_subtitle_ar ?? 'اعرف هوبيرك') : ($teamsData->departments_subtitle_en ?? 'Know Hauberk') }}</div>
                                <h4 class="text-xl md:text-2xl font-neue-bold text-[#041B44] mb-4">
                                    {{ app()->getLocale() == 'ar' ? ($teamsData->financial_planning_title_ar ?? 'التخطيط المالي') : ($teamsData->financial_planning_title_en ?? 'FINANCIAL PLANNING') }}
                                </h4>
                                <div class="text-[#041B44] opacity-70 font-sf-pro-regular leading-relaxed mb-6">
                                    {!! app()->getLocale() == 'ar' ? ($teamsData->financial_planning_description_ar ?? 'Our Financial Planning team helps clients develop comprehensive strategies for wealth preservation, tax efficiency, retirement planning, and estate planning to ensure long-term financial security.') : ($teamsData->financial_planning_description_en ?? 'Our Financial Planning team helps clients develop comprehensive strategies for wealth preservation, tax efficiency, retirement planning, and estate planning to ensure long-term financial security.') !!}
                                </div>
                                <a href="{{ $teamsData->financial_planning_url ?? '#' }}" class="text-[#D4AF37] font-poppins text-[12.56px] md:text-[15.07px] font-normal hover:underline md:mt-14 inline-block">
                                    {{ app()->getLocale() == 'ar' ? ($teamsData->financial_planning_link_ar ?? 'تواصل مع فريق التخطيط المالي') : ($teamsData->financial_planning_link_en ?? 'Contact Hauberk Financial Planning team') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Client Relations Content -->
                    <div class="tab-content hidden" id="client-content">
                        <div class="flex flex-col {{ $departmentsContentDirection }}">
                            <div class="w-full md:w-1/3 p-6 md:p-8">
                                @if($teamsData && $teamsData->client_relations_image)
                                    <img src="{{ asset('storage/' . $teamsData->client_relations_image) }}" alt="Client Relations" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('design/images/placeholder.png') }}" alt="Client Relations" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="w-full md:w-2/3 p-6 md:p-8 {{ $departmentsTextAlign }}" dir="{{ $departmentsDir }}">
                                <div class="text-[#D4AF37] text-sm mb-2">{{ app()->getLocale() == 'ar' ? ($teamsData->departments_subtitle_ar ?? 'اعرف هوبيرك') : ($teamsData->departments_subtitle_en ?? 'Know Hauberk') }}</div>
                                <h4 class="text-xl md:text-2xl font-neue-bold text-[#041B44] mb-4">
                                    {{ app()->getLocale() == 'ar' ? ($teamsData->client_relations_title_ar ?? 'علاقات العملاء') : ($teamsData->client_relations_title_en ?? 'CLIENT RELATIONS') }}
                                </h4>
                                <div class="text-[#041B44] opacity-70 font-sf-pro-regular leading-relaxed mb-6">
                                    {!! app()->getLocale() == 'ar' ? ($teamsData->client_relations_description_ar ?? 'Our Client Relations team serves as your dedicated point of contact, ensuring prompt communication and personalized service. They work closely with all departments to address your needs efficiently.') : ($teamsData->client_relations_description_en ?? 'Our Client Relations team serves as your dedicated point of contact, ensuring prompt communication and personalized service. They work closely with all departments to address your needs efficiently.') !!}
                                </div>
                                <a href="{{ $teamsData->client_relations_url ?? '#' }}" class="text-[#D4AF37] font-poppins text-[12.56px] md:text-[15.07px] font-normal hover:underline md:mt-14 inline-block">
                                    {{ app()->getLocale() == 'ar' ? ($teamsData->client_relations_link_ar ?? 'تواصل مع فريق علاقات العملاء') : ($teamsData->client_relations_link_en ?? 'Contact Hauberk Client Relations team') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Compliance & Legal Content -->
                    <div class="tab-content hidden" id="compliance-content">
                        <div class="flex flex-col {{ $departmentsContentDirection }}">
                            <div class="w-full md:w-1/3 p-6 md:p-8">
                                @if($teamsData && $teamsData->compliance_legal_image)
                                    <img src="{{ asset('storage/' . $teamsData->compliance_legal_image) }}" alt="Compliance & Legal" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('design/images/placeholder.png') }}" alt="Compliance & Legal" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="w-full md:w-2/3 p-6 md:p-8 {{ $departmentsTextAlign }}" dir="{{ $departmentsDir }}">
                                <div class="text-[#D4AF37] text-sm mb-2">{{ app()->getLocale() == 'ar' ? ($teamsData->departments_subtitle_ar ?? 'اعرف هوبيرك') : ($teamsData->departments_subtitle_en ?? 'Know Hauberk') }}</div>
                                <h4 class="text-xl md:text-2xl font-neue-bold text-[#041B44] mb-4">
                                    {{ app()->getLocale() == 'ar' ? ($teamsData->compliance_legal_title_ar ?? 'الامتثال والقانونية') : ($teamsData->compliance_legal_title_en ?? 'COMPLIANCE & LEGAL') }}
                                </h4>
                                <div class="text-[#041B44] opacity-70 font-sf-pro-regular leading-relaxed mb-6">
                                    {!! app()->getLocale() == 'ar' ? ($teamsData->compliance_legal_description_ar ?? 'Our Compliance and Legal team ensures all activities adhere to regulatory requirements and best practices. They provide guidance on legal matters and risk management to protect client interests.') : ($teamsData->compliance_legal_description_en ?? 'Our Compliance and Legal team ensures all activities adhere to regulatory requirements and best practices. They provide guidance on legal matters and risk management to protect client interests.') !!}
                                </div>
                                <a href="{{ $teamsData->compliance_legal_url ?? '#' }}" class="text-[#D4AF37] font-poppins text-[12.56px] md:text-[15.07px] font-normal hover:underline md:mt-14 inline-block">
                                    {{ app()->getLocale() == 'ar' ? ($teamsData->compliance_legal_link_ar ?? 'تواصل مع فريق الامتثال والقانونية') : ($teamsData->compliance_legal_link_en ?? 'Contact Hauberk Compliance & Legal team') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Operations & Administration Content -->
                    <div class="tab-content hidden" id="operations-content">
                        <div class="flex flex-col {{ $departmentsContentDirection }}">
                            <div class="w-full md:w-1/3 p-6 md:p-8">
                                @if($teamsData && $teamsData->operations_admin_image)
                                    <img src="{{ asset('storage/' . $teamsData->operations_admin_image) }}" alt="Operations & Administration" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('design/images/placeholder.png') }}" alt="Operations & Administration" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="w-full md:w-2/3 p-6 md:p-8 {{ $departmentsTextAlign }}" dir="{{ $departmentsDir }}">
                                <div class="text-[#D4AF37] text-sm mb-2">{{ app()->getLocale() == 'ar' ? ($teamsData->departments_subtitle_ar ?? 'اعرف هوبيرك') : ($teamsData->departments_subtitle_en ?? 'Know Hauberk') }}</div>
                                <h4 class="text-xl md:text-2xl font-neue-bold text-[#041B44] mb-4">
                                    {{ app()->getLocale() == 'ar' ? ($teamsData->operations_admin_title_ar ?? 'العمليات والإدارة') : ($teamsData->operations_admin_title_en ?? 'OPERATIONS & ADMINISTRATION') }}
                                </h4>
                                <div class="text-[#041B44] opacity-70 font-sf-pro-regular leading-relaxed mb-6">
                                    {!! app()->getLocale() == 'ar' ? ($teamsData->operations_admin_description_ar ?? 'The Operations & Administration team manages the day-to-day processes that support our advisory services. They handle account administration, reporting, and technology infrastructure to ensure seamless client experiences.') : ($teamsData->operations_admin_description_en ?? 'The Operations & Administration team manages the day-to-day processes that support our advisory services. They handle account administration, reporting, and technology infrastructure to ensure seamless client experiences.') !!}
                                </div>
                                <a href="{{ $teamsData->operations_admin_url ?? '#' }}" class="text-[#D4AF37] font-poppins text-[12.56px] md:text-[15.07px] font-normal hover:underline md:mt-14 inline-block">
                                    {{ app()->getLocale() == 'ar' ? ($teamsData->operations_admin_link_ar ?? 'تواصل مع فريق العمليات والإدارة') : ($teamsData->operations_admin_link_en ?? 'Contact Hauberk Operations & Administration team') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- JavaScript for Tabs -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Get all tab buttons and content
                const tabButtons = document.querySelectorAll('.tab-button');
                const tabContents = document.querySelectorAll('.tab-content');

                // Function to activate tab
                function activateTab(tabName) {
                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });

                    // Reset all tab buttons
                    tabButtons.forEach(button => {
                        button.classList.remove('bg-white');
                        button.classList.remove('text-[#041B44]');
                        button.classList.add('bg-[#D4AF37]');
                        button.classList.add('text-white');
                        button.classList.remove('border-[#D4AF37]');
                        button.classList.add('border-transparent');
                    });

                    // Show the selected tab content
                    const selectedTab = document.getElementById(`${tabName}-content`);
                    if (selectedTab) {
                        selectedTab.classList.remove('hidden');
                    }

                    // Highlight the active tab button
                    const activeButton = document.querySelector(`.tab-button[data-tab="${tabName}"]`);
                    if (activeButton) {
                        activeButton.classList.remove('bg-[#D4AF37]');
                        activeButton.classList.remove('text-white');
                        activeButton.classList.add('bg-white');
                        activeButton.classList.add('text-[#041B44]');
                        activeButton.classList.remove('border-transparent');
                        activeButton.classList.add('border-[#D4AF37]');
                    }
                }

                // Add click event to tab buttons
                tabButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const tabName = this.getAttribute('data-tab');
                        activateTab(tabName);
                    });
                });

                // Initialize with Investment Advisory tab active (first tab)
                activateTab('investment');
            });
        </script>
    </section>
    @endif

         <!-- JavaScript for Teams -->
     <script>
         // Pass teams data to JavaScript
         window.teamsData = @json($teamsData);

         // Enhanced Directors Carousel and Popup Functionality
         document.addEventListener('DOMContentLoaded', function() {
             const dots = document.querySelectorAll('.pagination-dot');
             const slides = document.querySelectorAll('.director-slide');
             const mobileSlides = document.querySelectorAll('.mobile-slide');
             const mobileSlider = document.getElementById('mobile-slider');
             const prevButton = document.getElementById('prev-slide');
             const nextButton = document.getElementById('next-slide');
             const mobilePrevButton = document.getElementById('mobile-prev-slide');
             const mobileNextButton = document.getElementById('mobile-next-slide');
             let currentSlide = 2; // Start with the third slide active (index 2)

             // Function to update the active slide
             function updateSlide(index) {
                 // Update dots
                 dots.forEach(dot => {
                     dot.classList.remove('bg-[#D4AF37]');
                     dot.classList.add('bg-white/30');
                     dot.classList.remove('active');
                 });
                 dots[index].classList.remove('bg-white/30');
                 dots[index].classList.add('bg-[#D4AF37]');
                 dots[index].classList.add('active');

                 // Update mobile slider position
                 if (mobileSlider) {
                     mobileSlider.style.transform = `translateX(-${index * 100}%)`;
                 }

                 // Update current slide index
                 currentSlide = index;
             }

             // Add click event to dots
             dots.forEach(dot => {
                 dot.addEventListener('click', function() {
                     const slideIndex = parseInt(this.getAttribute('data-slide'));
                     updateSlide(slideIndex);
                 });
             });

             // Desktop Previous slide button
             if (prevButton) {
                 prevButton.addEventListener('click', function() {
                     let newIndex = currentSlide - 1;
                     if (newIndex < 0) {
                         newIndex = dots.length - 1;
                     }
                     updateSlide(newIndex);
                 });
             }

             // Desktop Next slide button
             if (nextButton) {
                 nextButton.addEventListener('click', function() {
                     let newIndex = currentSlide + 1;
                     if (newIndex >= dots.length) {
                         newIndex = 0;
                     }
                     updateSlide(newIndex);
                 });
             }

             // Mobile Previous slide button
             if (mobilePrevButton) {
                 mobilePrevButton.addEventListener('click', function() {
                     let newIndex = currentSlide - 1;
                     if (newIndex < 0) {
                         newIndex = dots.length - 1;
                     }
                     updateSlide(newIndex);
                 });
             }

             // Mobile Next slide button
             if (mobileNextButton) {
                 mobileNextButton.addEventListener('click', function() {
                     let newIndex = currentSlide + 1;
                     if (newIndex >= dots.length) {
                         newIndex = 0;
                     }
                     updateSlide(newIndex);
                 });
             }

             // Initialize with the third slide active
             updateSlide(currentSlide);

                         // Director popup functionality
            const directorImages = document.querySelectorAll('.director-image');
            const closeButtons = document.querySelectorAll('.teams-close-popup');

            // Open popup when clicking on director image
            directorImages.forEach(image => {
                image.addEventListener('click', function() {
                    const directorName = this.getAttribute('data-director');
                    const popup = document.getElementById(`teams-director-popup-${directorName}`);
                    if (popup) {
                        popup.classList.remove('hidden');
                        // Add flex and centering classes on desktop (md and above)
                        if (window.innerWidth >= 768) {
                            popup.classList.add('flex', 'items-start', 'justify-center');
                        }
                        document.body.style.overflow = 'hidden'; // Prevent scrolling
                    }
                });
            });

            // Close popup when clicking on close button
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const popup = this.closest('[id^="teams-director-popup-"]');
                    if (popup) {
                        popup.classList.add('hidden');
                        popup.classList.remove('flex', 'items-center', 'justify-center');
                        document.body.style.overflow = ''; // Restore scrolling
                    }
                });
            });

            // Close popup when clicking outside the content
            document.querySelectorAll('[id^="teams-director-popup-"]').forEach(popup => {
                popup.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.add('hidden');
                        this.classList.remove('flex', 'items-center', 'justify-center');
                        document.body.style.overflow = ''; // Restore scrolling
                    }
                });
            });

            // Close popup with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('[id^="teams-director-popup-"]').forEach(popup => {
                        if (!popup.classList.contains('hidden')) {
                            popup.classList.add('hidden');
                            popup.classList.remove('flex', 'items-center', 'justify-center');
                            document.body.style.overflow = ''; // Restore scrolling
                        }
                    });
                }
            });

            // Handle window resize to maintain proper popup display
            window.addEventListener('resize', function() {
                document.querySelectorAll('[id^="teams-director-popup-"]').forEach(popup => {
                    if (!popup.classList.contains('hidden')) {
                        if (window.innerWidth >= 768) {
                            popup.classList.add('flex', 'items-center', 'justify-center');
                        } else {
                            popup.classList.remove('flex', 'items-center', 'justify-center');
                        }
                    }
                });
            });
         });
     </script>

@endsection
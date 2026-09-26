@extends('app')

@section('content')
<x-page-background pageName="governance-services">
    @php
        $governance = $governanceServices ?? new \App\Models\GovernanceServices();
        $locale = app()->getLocale();
        $localize = function ($en, $ar) use ($locale) {
            return $locale === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
        };
        
        // Helper function to get localized content
        function getLocalizedContent($data, $field, $locale, $default = '') {
            $key = $field . '_' . $locale;
            return $data->$key ?? $default;
        }
        
        // Get current language content
        $heroTitle = getLocalizedContent($governance, 'hero_title', $locale, 'GOVERNANCE SERVICES');
        if(isset($seoMeta)) {
            $seoTitle = $locale === 'ar' ? ($seoMeta->h1_ar ?? null) : ($seoMeta->h1_en ?? null);
            if($seoTitle) {
                $heroTitle = $seoTitle;
            }
        }
        $heroSubtitle = getLocalizedContent($governance, 'hero_subtitle', $locale, 'Tailored Governance for Lasting Prosperity');
        $heroButtonText = getLocalizedContent($governance, 'hero_button_text', $locale, 'REQUEST A MEETING');
        
        $servicesTitle = getLocalizedContent($governance, 'services_title', $locale, 'GOVERNANCE SERVICES');
        $servicesDescription = getLocalizedContent($governance, 'services_description', $locale, 'In today\'s complex financial landscape, managing and safeguarding wealth requires addressing several critical challenges:');
        
        $approachTitle = getLocalizedContent($governance, 'approach_title', $locale, 'GOVERNANCE APPROACH');
        $approachDescription = getLocalizedContent($governance, 'approach_description', $locale, 'At Hauberk Capital, we differentiate ourselves through an innovative approach to wealth governance that prioritizes customization, strategic alignment, and sustainable outcomes.');
        
        $stepsTitle = getLocalizedContent($governance, 'steps_title', $locale, 'STEPS TO START');
        $stepsSubtitle = getLocalizedContent($governance, 'steps_subtitle', $locale, 'Your Wealth Governance');
        
        $whyChooseTitle = getLocalizedContent($governance, 'why_choose_title', $locale, 'WHY CHOOSE US');
        
        $ctaTitle = getLocalizedContent($governance, 'cta_title', $locale, 'READY TO START GROWING?!');
        $ctaDescription = getLocalizedContent($governance, 'cta_description', $locale, 'Unlock the full potential of your wealth');
        $ctaButton1Text = getLocalizedContent($governance, 'cta_button_1_text', $locale, 'JOIN OUR MAILING LIST');
        $ctaButton2Text = getLocalizedContent($governance, 'cta_button_2_text', $locale, 'REQUEST A MEETING');

        $isArabic = $locale === 'ar';
        $pageDirection = $isArabic ? 'rtl' : 'ltr';
        $overviewLayoutClasses = $isArabic
            ? 'flex flex-col md:flex-row-reverse lg:flex-col xl:flex-row-reverse md:items-center lg:items-start xl:items-center mb-10'
            : 'flex flex-col md:flex-row lg:flex-col xl:flex-row md:items-center lg:items-start xl:items-center mb-10';
        $overviewTextAlignment = $isArabic
            ? 'text-center md:text-right lg:text-right xl:text-right'
            : 'text-center md:text-left lg:text-left xl:text-left';
        $overviewDescriptionAlignment = $isArabic ? 'text-right' : 'text-left';
        $accordionRowClass = $isArabic ? 'flex-row-reverse' : '';
        $accordionHeadingAlign = $isArabic ? 'text-right' : '';
        $accordionContentAlign = $isArabic ? 'text-right' : '';
        $accordionContentDir = $isArabic ? 'rtl' : 'ltr';
        $stepsNumberPosition = $isArabic ? '-right-4 left-auto' : '-left-4';
        $stepsNavigationPrevPosition = $isArabic ? 'right-0' : 'left-0';
        $stepsNavigationNextPosition = $isArabic ? 'left-0' : 'right-0';
        $stepsNavigationPrevIcon = $isArabic ? 'fa-chevron-right' : 'fa-chevron-left';
        $stepsNavigationNextIcon = $isArabic ? 'fa-chevron-left' : 'fa-chevron-right';
        $carouselPrevPosition = $isArabic ? 'right-0' : 'left-0';
        $carouselNextPosition = $isArabic ? 'left-0' : 'right-0';
        $carouselPrevIcon = $isArabic ? 'fa-chevron-right' : 'fa-chevron-left';
        $carouselNextIcon = $isArabic ? 'fa-chevron-left' : 'fa-chevron-right';
        $ctaTextAlignment = $isArabic ? 'text-right md:text-right' : 'text-left md:text-left';
        $overviewTextOrder = $isArabic ? 'md:order-2' : 'md:order-1';
        $overviewCardsOrder = $isArabic ? 'md:order-1' : 'md:order-2';
    @endphp

    @include('services.partials.responsive-styles')

    <div dir="{{ $pageDirection }}" class="services-responsive {{ $isArabic ? 'rtl' : 'ltr' }}">

    @if($governance?->isSectionVisible('hero') ?? true)
    <!-- Hero Section -->
    <section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
        <div class="relative overflow-hidden h-full">
            <div class="flex flex-col h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full">
                    <div class="w-full flex-shrink-0 relative">
                        <!-- Desktop background -->
                        <div class="absolute inset-0 hidden md:block">
                            @if($governance->hero_desktop_image && file_exists(storage_path('app/public/' . $governance->hero_desktop_image)))
                                <img src="{{ asset('storage/' . $governance->hero_desktop_image) }}" alt="{{ $heroTitle }}" class="w-full h-full object-cover"/>
                            @else
                                <img src="{{ asset('design/images/governance-innerpage-pg.png') }}" alt="{{ $heroTitle }}" class="w-full h-full object-cover"/>
                            @endif
                        </div>
                        <!-- Mobile background -->
                        <div class="absolute inset-0 block md:hidden">
                            @if($governance->hero_mobile_image && file_exists(storage_path('app/public/' . $governance->hero_mobile_image)))
                                <img src="{{ asset('storage/' . $governance->hero_mobile_image) }}" alt="{{ $heroTitle }} Mobile" class="w-full h-full object-cover"/>
                            @else
                                <img src="{{ asset('design/images/mobile-governance-innerpage-pg.png') }}" alt="{{ $heroTitle }} Mobile" class="w-full h-full object-cover"/>
                            @endif
                        </div>
                        <div class="absolute inset-0"></div>
                        <div class="relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                            <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto text-center">
                                <h1 class="text-[45px] xl:text-[78px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">{{ $heroTitle }}</h1>
                                <div class="mb-8 text-[17px] xl:text-[18px] text-[#FFFFFF]/70 font-['Poppins'] font-regular">{!! $heroSubtitle !!}</div>
                                <a href="{{ $governance->hero_button_url ?? 'request-a-meeting' }}" class="bg-[#D4AF37] px-6 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">{{ $heroButtonText }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($governance?->isSectionVisible('overview') ?? true)
    <!-- Services Overview Section -->
    <section class="py-16 bg-white">
        <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-center lg:items-start xl:items-center mb-10" dir="ltr">
                <div class="w-full md:w-2/5 lg:w-full xl:w-2/5 mb-8 md:mb-0 lg:mb-8 xl:mb-0 {{ $overviewTextAlignment }} {{ $overviewTextOrder }}" dir="{{ $pageDirection }}">
                    <h2 class="text-[#041B44] text-4xl md:text-[48px] lg:text-[48px] xl:text-[48px] md:leading-[62px] lg:leading-[62px] xl:leading-[62px] font-neue-extrabold mb-4">{{ $servicesTitle }}</h2>
                    <div class="text-[#041B44]/70 font-['Poppins'] text-[18px] font-regular {{ $overviewDescriptionAlignment }}" dir="{{ $pageDirection }}">{!! $servicesDescription !!}</div>
                </div>

                <div class="w-full md:w-3/5 lg:w-full xl:w-3/5 relative overflow-hidden px-14 {{ $overviewCardsOrder }}" dir="{{ $pageDirection }}">
                    <!-- Carousel Container -->
                    <div id="carousel-container" class="overflow-hidden flex gap-6 w-full transition-transform duration-500">
                        @if($governance->services_cards && is_array($governance->services_cards))
                            @foreach($governance->services_cards as $index => $card)
                                <div class="carousel-item flex-shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(50%-12px)] xl:w-[calc(50%-12px)] bg-[#041B44] text-white p-8 rounded-none {{ $overviewDescriptionAlignment }}" dir="{{ $pageDirection }}">
                                    <h4 class="text-2xl md:text-[26px] lg:text-[26px] xl:text-[26px] font-neue-bold mb-6 uppercase">
                                        {{ $locale == 'ar' ? ($card['title_ar'] ?? $card['title_en']) : $card['title_en'] }}
                                    </h4>
                                    <div class="font-sf-pro-regular text-[#FFFFFF]/70 text-[16px] leading-relaxed">
                                        {!! $locale == 'ar' ? ($card['description_ar'] ?? $card['description_en']) : $card['description_en'] !!}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- Carousel Navigation -->
                    <button id="prev-btn" class="absolute {{ $carouselPrevPosition }} top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center z-10 text-[#353E5C]">
                        <i class="fas {{ $carouselPrevIcon }} text-xl"></i>
                    </button>
                    <button id="next-btn" class="absolute {{ $carouselNextPosition }} top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center z-10 text-[#353E5C]">
                        <i class="fas {{ $carouselNextIcon }} text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($governance?->isSectionVisible('approach') ?? true)
    <!-- Approach Section -->
    <section class="bg-[#041B44] text-white py-16 px-6 md:py-40 bg-cover bg-center bg-no-repeat relative">
        <!-- Desktop Background -->
        <div class="absolute inset-0 hidden md:block">
            @if($governance->approach_background_image && file_exists(storage_path('app/public/' . $governance->approach_background_image)))
                <img src="{{ asset('storage/' . $governance->approach_background_image) }}" alt="Approach Background" class="w-full h-full object-cover">
            @else
                <img src="{{ asset('design/images/approach-bg.png') }}" alt="Approach Background" class="w-full h-full object-cover">
            @endif
        </div>
        <!-- Mobile Background -->
        <div class="absolute inset-0 block md:hidden">
            @if($governance->approach_mobile_background_image && file_exists(storage_path('app/public/' . $governance->approach_mobile_background_image)))
                <img src="{{ asset('storage/' . $governance->approach_mobile_background_image) }}" alt="Approach Background Mobile" class="w-full h-full object-cover">
            @elseif($governance->approach_background_image && file_exists(storage_path('app/public/' . $governance->approach_background_image)))
                <img src="{{ asset('storage/' . $governance->approach_background_image) }}" alt="Approach Background" class="w-full h-full object-cover">
            @else
                <img src="{{ asset('design/images/approach-bg.png') }}" alt="Approach Background" class="w-full h-full object-cover">
            @endif
        </div>
        <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4 relative z-10">
            <!-- Section Title -->
            <div class="text-center mb-12">
                <h2 class="text-[32px] md:text-[40px] xl:text-[48px] font-neue-extrabold text-white">{{ $approachTitle }}</h2>
            </div>
            <!-- Approach Description -->
            <div class="max-w-6xl mx-auto text-center mb-24">
                <div class="text-white opacity-70 font-['Poppins'] font-regular text-[21.28px] leading-relaxed">
                    {!! $approachDescription !!}
                </div>
            </div>
            <!-- Approach Items -->
            @if($governance->approach_items && is_array($governance->approach_items))
                @php $itemCount = count($governance->approach_items); @endphp
                @for($row = 0; $row < ceil($itemCount / 2); $row++)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mb-6">
                        @for($col = 0; $col < 2; $col++)
                            @php $index = $row * 2 + $col; @endphp
                            @if($index < $itemCount)
                                @php $item = $governance->approach_items[$index]; @endphp
                                <div class="border-b border-[#808080] pb-6">
                                    <div class="flex items-center justify-between {{ $accordionRowClass }}" dir="ltr">
                                        <h3 class="text-[28px] font-['Poppins'] font-bold text-white {{ $accordionHeadingAlign }}">
                                            {{ $locale == 'ar' ? ($item['title_ar'] ?? $item['title_en']) : $item['title_en'] }}
                                        </h3>
                                        <button class="text-[#D4AF37] toggle-content" data-id="approach-{{ $index }}">
                                            <i class="fas fa-chevron-down {{ isset($item['is_expanded']) && $item['is_expanded'] ? 'rotate-180' : '' }} text-[25px]"></i>
                                        </button>
                                    </div>
                                    <div class="mt-4 content-section {{ isset($item['is_expanded']) && $item['is_expanded'] ? '' : 'hidden' }} {{ $accordionContentAlign }}" id="approach-{{ $index }}" dir="{{ $accordionContentDir }}">
                                        <div class="text-white font-['Poppins'] font-regular text-[18px] {{ $accordionContentAlign }}">
                                            {!! $locale == 'ar' ? ($item['content_ar'] ?? $item['content_en']) : $item['content_en'] !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>
                @endfor
            @endif
        </div>
    </section>
    @endif

    @if($governance?->isSectionVisible('steps') ?? true)
    <!-- Steps Section -->
    <section class="bg-white text-[#041B44] z-0 py-16 md:py-24 overflow-hidden">
        <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4">
            <!-- Section Title -->
            <div class="text-center mb-12">
                <h2 class="text-[32px] md:text-[40px] xl:text-[48px] font-neue-extrabold">{{ $stepsTitle }}</h2>
                <div class="text-[18px] font-['Poppins'] text-[#041B44]/70 mt-2">{{ $stepsSubtitle }}</div>
            </div>

            <!-- Steps Carousel -->
            <div class="relative z-0 max-w-7xl mx-auto px-10">
                <!-- Carousel Navigation -->
                <button id="steps-prev-btn" class="absolute md:{{ $stepsNavigationPrevPosition === 'right-0' ? 'right-[-2%]' : 'left-[-2%]' }} {{ $stepsNavigationPrevPosition }} top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center z-10 text-[#353E5C]">
                    <i class="fas {{ $stepsNavigationPrevIcon }} text-2xl"></i>
                </button>
                <button id="steps-next-btn" class="absolute md:{{ $stepsNavigationNextPosition === 'left-0' ? 'left-[-2%]' : 'right-[-2%]' }} {{ $stepsNavigationNextPosition }} top-1/2 -translate-y-1/2 w-10 h-10 flex items-center justify-center z-10 text-[#353E5C]">
                    <i class="fas {{ $stepsNavigationNextIcon }} text-2xl"></i>
                </button>

                <!-- Carousel Container -->
                <div id="steps-carousel" class="flex flex-wrap md:flex-nowrap gap-12 w-full transition-all duration-500">
                    @php
                        $stepsItems = $governance->steps_items ?? [
                            ['title_en' => 'INITIAL CONSULTATION', 'title_ar' => 'الاستشارة الأولية', 'description_en' => 'Comprehensive assessment of your governance needs and objectives.', 'description_ar' => 'تقييم شامل لاحتياجاتك وأهدافك في الحوكمة.'],
                            ['title_en' => 'DEVELOPMENT OF CUSTOMIZED GOVERNANCE STRATEGY', 'title_ar' => 'تطوير استراتيجية حوكمة مخصصة', 'description_en' => 'Creation of tailored governance strategy aligned with your goals.', 'description_ar' => 'إنشاء استراتيجية حوكمة مصممة خصيصًا لتتماشى مع أهدافك.'],
                            ['title_en' => 'DAY-TO-DAY GOVERNANCE MANAGEMENT', 'title_ar' => 'إدارة الحوكمة اليومية', 'description_en' => 'Ongoing governance management and oversight.', 'description_ar' => 'إدارة الحوكمة المستمرة والإشراف عليها.'],
                            ['title_en' => 'GOAL SETTING AND OBJECTIVE DEFINITION', 'title_ar' => 'تحديد الأهداف وتعريف الغايات', 'description_en' => 'Clear definition of governance goals and success metrics.', 'description_ar' => 'تعريف واضح لأهداف الحوكمة ومقاييس النجاح.'],
                            ['title_en' => 'PERFORMANCE MONITORING', 'title_ar' => 'مراقبة الأداء', 'description_en' => 'Continuous monitoring and evaluation of governance performance.', 'description_ar' => 'المراقبة والتقييم المستمر لأداء الحوكمة.'],
                            ['title_en' => 'STRATEGIC REVIEW AND OPTIMIZATION', 'title_ar' => 'المراجعة الاستراتيجية والتحسين', 'description_en' => 'Regular strategic reviews and governance optimization.', 'description_ar' => 'مراجعات استراتيجية منتظمة وتحسين الحوكمة.']
                        ];
                        $stepChunks = array_chunk($stepsItems, 3);
                    @endphp
                    @if(is_array($stepsItems) && count($stepsItems) > 0)
                        @foreach($stepChunks as $chunkIndex => $chunk)
                            @foreach($chunk as $index => $step)
                                <div class="steps-item w-full md:w-1/3 relative mb-8 {{ $chunkIndex > 0 ? 'hidden' : '' }}">
                                    <div class="number-badge absolute -top-4 {{ $stepsNumberPosition }} w-10 h-10 rounded-full bg-[#D4AF37] flex items-center justify-center text-white font-neue-bold text-lg z-20 shadow-md">{{ $chunkIndex * 3 + $index + 1 }}</div>
                                    <div class="bg-[#041B44] text-white p-8 pt-24 pb-24 h-40 flex items-center justify-center">
                                        <h4 class="text-2xl md:text-[24px] font-neue-bold text-center">{{ strtoupper($step['title_' . $locale] ?? $step['title_en'] ?? 'STEP ' . ($chunkIndex * 3 + $index + 1)) }}</h4>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($governance?->isSectionVisible('why_choose') ?? true)
    <!-- Why Choose Us Section -->
    <section class="py-16 bg-[#041B44] text-white">
        <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4">
            <h2 class="text-[32px] xl:text-[54px] xl:font-neue-bold font-neue-extrabold text-center mb-16">{{ $whyChooseTitle }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-14 px-6 md:px-0">
                @if($governance->why_choose_items && is_array($governance->why_choose_items))
                    @foreach($governance->why_choose_items as $item)
                        <div class="flex flex-col">
                            <div class="bg-[#041B44] rounded-lg overflow-hidden mb-6">
                                @if(isset($item['image']) && $item['image'])
                                    @if(isset($item['image']) && $item['image'] && file_exists(storage_path('app/public/' . $item['image'])))
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $locale == 'ar' ? ($item['title_ar'] ?? $item['title_en']) : $item['title_en'] }}" class="w-[250px] h-auto mx-auto">
                                    @elseif(isset($item['image']) && $item['image'])
                                        <img src="{{ asset('design/' . $item['image']) }}" alt="{{ $locale == 'ar' ? ($item['title_ar'] ?? $item['title_en']) : $item['title_en'] }}" class="w-[250px] h-auto mx-auto">
                                    @endif
                                @else
                                    <img src="{{ asset('design/images/wcu-1.png') }}" alt="{{ $locale == 'ar' ? ($item['title_ar'] ?? $item['title_en']) : $item['title_en'] }}" class="w-[250px] h-auto mx-auto">
                                @endif
                                <div class="pt-4">
                                    <h3 class="text-[#FFFFFF] text-[28px] font-neue-extrabold mb-6 text-center">
                                        {{ $locale == 'ar' ? ($item['title_ar'] ?? $item['title_en']) : $item['title_en'] }}
                                    </h3>
                                    <div class="max-w-[300px] text-white/70 xl:text-[15.07px] font-['Poppins'] mx-auto text-bold mb-4 text-center">
                                        {!! $locale == 'ar' ? ($item['description_ar'] ?? $item['description_en']) : $item['description_en'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section> 
    @endif

    @if($governance?->isSectionVisible('cta') ?? true)
    <!-- CTA Section -->
    @include('partials.cta-section', [
        'backgroundImage' => $governance->cta_background_image && file_exists(storage_path('app/public/' . $governance->cta_background_image))
            ? asset('storage/' . $governance->cta_background_image)
            : asset('design/images/meeting-bg.png'),
        'backgroundAlt' => $localize($governance->cta_background_image_alt_en ?? null, $governance->cta_background_image_alt_ar ?? null) ?: strip_tags($ctaTitle),
        'titleHtml' => nl2br(e($ctaTitle)),
        'descriptionHtml' => $ctaDescription,
        'buttonOneText' => $ctaButton1Text,
        'buttonOneUrl' => $governance->cta_button_1_url ?? 'contact-us',
        'buttonTwoText' => $ctaButton2Text,
        'buttonTwoUrl' => $governance->cta_button_2_url ?? 'request-a-meeting',
    ])
    @endif

    <!-- JavaScript for interactive functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle content functionality for approach section
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
                .steps-item {
                    transition: all 0.3s ease-in-out;
                }
                .number-badge {
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }
            `;
            document.head.appendChild(style);
            
            // Add event listeners to all toggle buttons
            document.querySelectorAll('.toggle-content').forEach(button => {
                button.addEventListener('click', function() {
                    toggleContent(this);
                });
            });

            // Carousel functionality
            const carouselContainer = document.getElementById('carousel-container');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const carouselItems = document.querySelectorAll('.carousel-item');
            
            if (carouselContainer && prevBtn && nextBtn && carouselItems.length > 0) {
                let currentIndex = 0;
                const totalItems = carouselItems.length;
                const itemsPerView = window.innerWidth < 768 ? 1 : 2;
                
                // Initial setup
                function setupCarousel() {
                    // On mobile, show only one item
                    if (window.innerWidth < 768) {
                        carouselItems.forEach((item, index) => {
                            item.style.display = index === currentIndex ? 'block' : 'none';
                        });
                    } else {
                        // On desktop, show two items
                        carouselItems.forEach((item, index) => {
                            item.style.display = (index >= currentIndex && index < currentIndex + 2) ? 'block' : 'none';
                        });
                    }
                    updateNavigationButtons();
                }
                
                function updateNavigationButtons() {
                    prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
                    nextBtn.style.opacity = currentIndex >= totalItems - itemsPerView ? '0.5' : '1';
                }
                
                function moveCarousel(direction) {
                    if (direction === 'next' && currentIndex < totalItems - itemsPerView) {
                        currentIndex++;
                    } else if (direction === 'prev' && currentIndex > 0) {
                        currentIndex--;
                    }
                    setupCarousel();
                }
                
                // Event listeners for navigation buttons
                prevBtn.addEventListener('click', () => moveCarousel('prev'));
                nextBtn.addEventListener('click', () => moveCarousel('next'));
                
                // Handle window resize
                window.addEventListener('resize', () => {
                    const newItemsPerView = window.innerWidth < 768 ? 1 : 2;
                    if (newItemsPerView !== itemsPerView) {
                        currentIndex = 0;
                        setupCarousel();
                    }
                });
                
                // Run initial setup
                setupCarousel();
            }

            // Steps carousel functionality
            const stepsCarousel = document.getElementById('steps-carousel');
            const stepsPrevBtn = document.getElementById('steps-prev-btn');
            const stepsNextBtn = document.getElementById('steps-next-btn');
            const stepsItems = stepsCarousel.querySelectorAll('.steps-item');
            
            if (stepsItems.length > 0) {
                let stepsCurrentIndex = 0;

                function getStepsPerView() {
                    return window.innerWidth >= 768 ? 3 : 1; // Show 1 on mobile, 3 on desktop
                }

                function updateStepsCarousel() {
                    const stepsPerView = getStepsPerView();
                    const stepsMaxIndex = Math.ceil(stepsItems.length / stepsPerView) - 1;
                    
                    stepsItems.forEach((item, index) => {
                        const startIndex = stepsCurrentIndex * stepsPerView;
                        const endIndex = startIndex + stepsPerView;
                        
                        if (index >= startIndex && index < endIndex) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    });
                    
                    stepsPrevBtn.style.opacity = stepsCurrentIndex === 0 ? '0.5' : '1';
                    stepsNextBtn.style.opacity = stepsCurrentIndex >= stepsMaxIndex ? '0.5' : '1';
                }

                stepsPrevBtn.addEventListener('click', () => {
                    const stepsPerView = getStepsPerView();
                    const stepsMaxIndex = Math.ceil(stepsItems.length / stepsPerView) - 1;
                    if (stepsCurrentIndex > 0) {
                        stepsCurrentIndex--;
                        updateStepsCarousel();
                    }
                });

                stepsNextBtn.addEventListener('click', () => {
                    const stepsPerView = getStepsPerView();
                    const stepsMaxIndex = Math.ceil(stepsItems.length / stepsPerView) - 1;
                    if (stepsCurrentIndex < stepsMaxIndex) {
                        stepsCurrentIndex++;
                        updateStepsCarousel();
                    }
                });

                // Handle window resize
                window.addEventListener('resize', () => {
                    stepsCurrentIndex = 0; // Reset to first slide on resize
                    updateStepsCarousel();
                });

                // Initialize the carousel
                updateStepsCarousel();
            }
        });
    </script>
    </div>
</x-page-background>
@endsection
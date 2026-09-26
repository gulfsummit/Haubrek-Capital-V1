@extends('app')

@section('content')
<x-page-background pageName="investment-services">
    @php
        $investmentData = $investmentServices ?? new \App\Models\InvestmentServices();
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
        $heroTitle = getLocalizedContent($investmentData, 'hero_title', $locale, 'INVESTMENT SERVICES');
        if(isset($seoMeta)) {
            $seoTitle = $locale === 'ar' ? ($seoMeta->h1_ar ?? null) : ($seoMeta->h1_en ?? null);
            if($seoTitle) {
                $heroTitle = $seoTitle;
            }
        }
        $heroSubtitle = getLocalizedContent($investmentData, 'hero_subtitle', $locale, 'Strategic Investment Solutions for Sustainable Growth');
        $heroButtonText = getLocalizedContent($investmentData, 'hero_button_text', $locale, 'REQUEST A MEETING');
        
        $servicesTitle = getLocalizedContent($investmentData, 'overview_title', $locale, 'INVESTMENT SERVICES');
        $servicesDescription = getLocalizedContent($investmentData, 'overview_description', $locale, 'We offer tailored Investment Services for High-Net-Worth Individuals, Family Offices, and Endowments, providing comprehensive investment advisory solutions. Our services include relationship management, asset allocation monitoring, manager oversight, compliance, reporting, and performance evaluation.');
        
        $approachTitle = getLocalizedContent($investmentData, 'approach_title', $locale, 'INVESTMENT APPROACH');
        $approachDescription = getLocalizedContent($investmentData, 'approach_description', $locale, 'Our Investment Services provide a comprehensive outsourcing solution for High-Net-Worth Individuals (HNWIs), Family Offices, and Endowments, encompassing all aspects of managing an investment office.');
        $approachDescription2 = getLocalizedContent($investmentData, 'approach_description_2', $locale, 'We recognize that each client presents unique challenges and aspirations. Therefore, our approach is designed to deliver tailored solutions that maximize efficiency and effectiveness across all investment management dimensions.');
        
        $stepsTitle = getLocalizedContent($investmentData, 'steps_title', $locale, 'STEPS TO START');
        $stepsSubtitle = getLocalizedContent($investmentData, 'steps_subtitle', $locale, 'Your Investment Journey');
        
        $whyChooseTitle = getLocalizedContent($investmentData, 'why_choose_title', $locale, 'WHY CHOOSE US');
        
        $ctaTitle = getLocalizedContent($investmentData, 'cta_title', $locale, 'READY TO START GROWING?!');
        $ctaDescription = getLocalizedContent($investmentData, 'cta_description', $locale, 'Unlock the full potential of your wealth');
        $ctaButton1Text = getLocalizedContent($investmentData, 'cta_button_1_text', $locale, 'JOIN OUR MAILING LIST');
        $ctaButton2Text = getLocalizedContent($investmentData, 'cta_button_2_text', $locale, 'REQUEST A MEETING');

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

    @if($investmentData?->isSectionVisible('hero') ?? true)
    <!-- Hero Section -->
    <section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
        <div class="relative overflow-hidden h-full">
            <div class="flex flex-col h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full">
                    <div class="w-full flex-shrink-0 relative">
                        <!-- Desktop background -->
                        <div class="absolute inset-0 hidden md:block">
                            @if($investmentData->hero_desktop_image && file_exists(storage_path('app/public/' . $investmentData->hero_desktop_image)))
                                <img src="{{ asset('storage/' . $investmentData->hero_desktop_image) }}" alt="{{ $heroTitle }}" class="w-full h-full object-cover"/>
                            @else
                                <img src="{{ asset('design/images/investment-innerpage-bg.png') }}" alt="{{ $heroTitle }}" class="w-full h-full object-cover"/>
                            @endif
                        </div>
                        <!-- Mobile background -->
                        <div class="absolute inset-0 block md:hidden">
                            @if($investmentData->hero_mobile_image && file_exists(storage_path('app/public/' . $investmentData->hero_mobile_image)))
                                <img src="{{ asset('storage/' . $investmentData->hero_mobile_image) }}" alt="{{ $heroTitle }}" class="w-full h-full object-cover"/>
                            @else
                                <img src="{{ asset('design/images/services-mob.png') }}" alt="{{ $heroTitle }}" class="w-full h-full object-cover"/>
                            @endif
                        </div>
                        <div class="absolute inset-0 "></div>
                        <div class="relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                            <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto text-center">
                                <h1 class="text-[45px] xl:text-[50px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">{!! $heroTitle !!}</h1>
                                <div class="mb-8 text-[17px] xl:text-[18px] text-[#FFFFFF]/70 font-['Poppins'] font-regular">{!! $heroSubtitle !!}</div>
                                <a href="{{ $investmentData->hero_button_url ?? '#' }}" class="bg-[#D4AF37] px-6 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">{{ $heroButtonText }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($investmentData?->isSectionVisible('overview') ?? true)
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
                    <div id="carousel-container" class="overflow-hidden flex gap-6 w-full">
                        @php
                            $overviewItems = $investmentData->overview_items ?? [
                                ['title_en' => 'PORTFOLIO MANAGEMENT', 'title_ar' => 'إدارة المحافظ', 'description_en' => 'Comprehensive portfolio management services tailored to your investment objectives and risk tolerance.', 'description_ar' => 'خدمات إدارة المحافظ الشاملة المصممة خصيصًا لأهدافك الاستثمارية وتحملك للمخاطر.'],
                                ['title_en' => 'INVESTMENT RESEARCH', 'title_ar' => 'البحوث الاستثمارية', 'description_en' => 'In-depth market research and analysis to identify optimal investment opportunities across various asset classes.', 'description_ar' => 'بحوث وتحليلات السوق المتعمقة لتحديد الفرص الاستثمارية المثلى عبر فئات الأصول المختلفة.'],
                                ['title_en' => 'RISK MANAGEMENT', 'title_ar' => 'إدارة المخاطر', 'description_en' => 'Advanced risk management strategies to protect your investments while maximizing potential returns.', 'description_ar' => 'استراتيجيات إدارة المخاطر المتقدمة لحماية استثماراتك مع تعظيم العوائد المحتملة.']
                            ];
                        @endphp
                        @if(is_array($overviewItems) && count($overviewItems) > 0)
                            @foreach($overviewItems as $index => $item)
                                <div class="carousel-item flex-shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(50%-12px)] xl:w-[calc(50%-12px)] bg-[#041B44] text-white p-8 rounded-none {{ $overviewDescriptionAlignment }}" dir="{{ $pageDirection }}">
                                    <h4 class="text-2xl md:text-[26px] lg:text-[26px] xl:text-[26px] font-neue-bold mb-6 uppercase">
                                        {{ $item['title_' . $locale] ?? $item['title_en'] ?? 'Service ' . ($index + 1) }}
                                    </h4>
                                    <div class="font-sf-pro-regular text-[#FFFFFF]/70 text-[16px] leading-relaxed">
                                        {!! $item['description_' . $locale] ?? $item['description_en'] ?? 'Service description' !!}
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

    @if($investmentData?->isSectionVisible('approach') ?? true)
    <!-- Approach Section -->
    <section class="bg-[#041B44] text-white py-16 px-6 md:py-40 bg-cover bg-center bg-no-repeat relative">
        <!-- Desktop Background -->
        <div class="absolute inset-0 hidden md:block">
            @if($investmentData->approach_background_image && file_exists(storage_path('app/public/' . $investmentData->approach_background_image)))
                <img src="{{ asset('storage/' . $investmentData->approach_background_image) }}" alt="Approach Background" class="w-full h-full object-cover">
            @else
                <img src="{{ asset('design/images/approach-bg.png') }}" alt="Approach Background" class="w-full h-full object-cover">
            @endif
        </div>
        <!-- Mobile Background -->
        <div class="absolute inset-0 block md:hidden">
            @if($investmentData->approach_mobile_background_image && file_exists(storage_path('app/public/' . $investmentData->approach_mobile_background_image)))
                <img src="{{ asset('storage/' . $investmentData->approach_mobile_background_image) }}" alt="Approach Background Mobile" class="w-full h-full object-cover">
            @elseif($investmentData->approach_background_image && file_exists(storage_path('app/public/' . $investmentData->approach_background_image)))
                <img src="{{ asset('storage/' . $investmentData->approach_background_image) }}" alt="Approach Background" class="w-full h-full object-cover">
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
                <div class="text-white opacity-70 font-['Poppins'] font-regular text-[21.28px] leading-relaxed mb-6">{!! $approachDescription !!}</div>
            </div>
            <!-- Research Process Grid -->
            @php
                $approachItems = $investmentData->approach_items ?? [
                    ['title_en' => 'Strategic Investment Planning', 'title_ar' => 'التخطيط الاستثماري الاستراتيجي', 'description_en' => 'Our strategic investment planning approach focuses on long-term wealth creation through diversified portfolio construction and disciplined risk management.', 'description_ar' => 'يركز نهجنا في التخطيط الاستثماري الاستراتيجي على خلق الثروة طويلة المدى من خلال بناء محافظ متنوعة وإدارة المخاطر المنضبطة.'],
                    ['title_en' => 'Market Analysis and Research', 'title_ar' => 'تحليل السوق والبحوث', 'description_en' => 'We conduct comprehensive market analysis and research to identify emerging trends and investment opportunities across global markets.', 'description_ar' => 'نقوم بإجراء تحليل شامل للسوق وأبحاث لتحديد الاتجاهات الناشئة والفرص الاستثمارية عبر الأسواق العالمية.'],
                    ['title_en' => 'Active Portfolio Management', 'title_ar' => 'إدارة المحافظ النشطة', 'description_en' => 'Our active portfolio management approach ensures optimal asset allocation and timely rebalancing to maximize returns while managing risk.', 'description_ar' => 'يضمن نهجنا في إدارة المحافظ النشطة التوزيع الأمثل للأصول وإعادة التوازن في الوقت المناسب لتعظيم العوائد مع إدارة المخاطر.'],
                    ['title_en' => 'Performance Monitoring', 'title_ar' => 'مراقبة الأداء', 'description_en' => 'Continuous performance monitoring and evaluation ensures that your investments remain aligned with your financial objectives and market conditions.', 'description_ar' => 'المراقبة والتقييم المستمر للأداء يضمن بقاء استثماراتك متماشية مع أهدافك المالية وظروف السوق.']
                ];
            @endphp
            @if(is_array($approachItems) && count($approachItems) > 0)
                @php
                    $approachChunks = array_chunk($approachItems, 2);
                @endphp
                @foreach($approachChunks as $chunkIndex => $chunk)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 {{ $chunkIndex === 0 ? 'mb-6' : 'mt-6' }}">
                        @foreach($chunk as $index => $item)
                            @php
                                $globalIndex = $chunkIndex * 2 + $index;
                                $itemId = 'approach-item-' . $globalIndex;
                                $isExpanded = isset($item['is_expanded']) && $item['is_expanded'];
                            @endphp
                            <div class="border-b border-[#808080] pb-6">
                                <div class="flex items-center justify-between {{ $accordionRowClass }}" dir="ltr">
                                    <h3 class="text-[28px] font-['Poppins'] font-bold text-white {{ $accordionHeadingAlign }}">{{ $item['title_' . $locale] ?? $item['title_en'] ?? 'Approach ' . ($globalIndex + 1) }}</h3>
                                    <button class="text-[#D4AF37] toggle-content" data-id="{{ $itemId }}">
                                        <i class="fas fa-chevron-down {{ $isExpanded ? 'rotate-180' : '' }} text-[25px]"></i>
                                    </button>
                                </div>
                                <div class="mt-4 content-section {{ $isExpanded ? '' : 'hidden' }} {{ $accordionContentAlign }}" id="{{ $itemId }}" dir="{{ $accordionContentDir }}">
                                    <div class="text-white font-['Poppins'] font-regular text-[18px] {{ $accordionContentAlign }}">
                                        {!! $item['description_' . $locale] ?? $item['description_en'] ?? 'Approach description' !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
        
        <script>
            function toggleContent(button) {
                const contentId = button.getAttribute('data-id');
                const contentSection = document.getElementById(contentId);
                const icon = button.querySelector('i');

                document.querySelectorAll('.content-section').forEach(section => {
                    if (section.id !== contentId && !section.classList.contains('hidden')) {
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

                        const sectionButton = document.querySelector(`[data-id="${section.id}"]`);
                        if (sectionButton) {
                            sectionButton.querySelector('i').classList.remove('rotate-180');
                        }
                    }
                });

                if (contentSection.classList.contains('hidden')) {
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

            document.addEventListener('DOMContentLoaded', function() {
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

    @if($investmentData?->isSectionVisible('steps') ?? true)
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
                        $stepsItems = $investmentData->steps_items ?? [
                            ['title_en' => 'INITIAL CONSULTATION', 'title_ar' => 'الاستشارة الأولية', 'description_en' => 'Comprehensive assessment of your investment needs and objectives.', 'description_ar' => 'تقييم شامل لاحتياجاتك وأهدافك الاستثمارية.'],
                            ['title_en' => 'DEVELOPMENT OF CUSTOMIZED INVESTMENT STRATEGY', 'title_ar' => 'تطوير استراتيجية استثمارية مخصصة', 'description_en' => 'Creation of tailored investment strategy aligned with your goals.', 'description_ar' => 'إنشاء استراتيجية استثمارية مصممة خصيصًا لتتماشى مع أهدافك.'],
                            ['title_en' => 'DAY-TO-DAY RELATIONSHIP MANAGEMENT', 'title_ar' => 'إدارة العلاقات اليومية', 'description_en' => 'Ongoing relationship management and investment oversight.', 'description_ar' => 'إدارة العلاقات المستمرة والإشراف على الاستثمارات.'],
                            ['title_en' => 'GOAL SETTING AND OBJECTIVE DEFINITION', 'title_ar' => 'تحديد الأهداف وتعريف الغايات', 'description_en' => 'Clear definition of investment goals and success metrics.', 'description_ar' => 'تعريف واضح لأهداف الاستثمار ومقاييس النجاح.'],
                            ['title_en' => 'PERFORMANCE MONITORING', 'title_ar' => 'مراقبة الأداء', 'description_en' => 'Continuous monitoring and evaluation of investment performance.', 'description_ar' => 'المراقبة والتقييم المستمر لأداء الاستثمارات.'],
                            ['title_en' => 'STRATEGIC REVIEW AND OPTIMIZATION', 'title_ar' => 'المراجعة الاستراتيجية والتحسين', 'description_en' => 'Regular strategic reviews and portfolio optimization.', 'description_ar' => 'مراجعات استراتيجية منتظمة وتحسين المحفظة.']
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

    @if($investmentData?->isSectionVisible('why_choose') ?? true)
    <!-- Why Choose Us Section -->
    <section class="py-16 bg-[#041B44] text-white">
        <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4">
            <h2 class="text-[32px] xl:text-[54px] xl:font-neue-bold font-neue-extrabold text-center mb-16">{{ $whyChooseTitle }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-14 px-6 md:px-0">
                @php
                    $whyChooseItems = $investmentData->why_choose_items ?? [
                        ['title_en' => 'EXPERT ADVISORS', 'title_ar' => 'مستشارون خبراء', 'description_en' => 'Our team comprises seasoned professionals with extensive experience in wealth management, legal advisory, and investment management.', 'description_ar' => 'يتكون فريقنا من محترفين ذوي خبرة واسعة في إدارة الثروات والاستشارات القانونية وإدارة الاستثمارات.', 'image' => null],
                        ['title_en' => 'HOLISTIC APPROACH', 'title_ar' => 'نهج شمولي', 'description_en' => 'Our integrated approach considers all aspects of investment management, from strategic planning to day-to-day operations and compliance.', 'description_ar' => 'يأخذ نهجنا المتكامل في الاعتبار جميع جوانب إدارة الاستثمارات، من التخطيط الاستراتيجي إلى العمليات اليومية والامتثال.', 'image' => null],
                        ['title_en' => 'TAILORED SOLUTIONS', 'title_ar' => 'حلول مخصصة', 'description_en' => 'We understand that every client is unique, and we tailor our services to meet your specific needs and goals with highest standards of ethics & transparency.', 'description_ar' => 'نحن نفهم أن كل عميل فريد، ونقوم بتخصيص خدماتنا لتلبية احتياجاتك وأهدافك المحددة بأعلى معايير الأخلاق والشفافية.', 'image' => null]
                    ];
                @endphp
                @if(is_array($whyChooseItems) && count($whyChooseItems) > 0)
                    @foreach($whyChooseItems as $index => $item)
                        <div class="flex flex-col">
                            <div class="bg-[#041B44] rounded-lg overflow-hidden mb-6">
                                @if(isset($item['image']) && $item['image'] && file_exists(storage_path('app/public/' . $item['image'])))
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="Why Choose Us" class="w-[250px] h-auto mx-auto">
                                @else
                                    <img src="{{ asset('design/images/wcu-' . ($index % 3 + 1) . '.png') }}" alt="Why Choose Us" class="w-[250px] h-auto mx-auto">
                                @endif
                                <div class="pt-4">
                                    <h3 class="text-[#FFFFFF] text-[28px] font-neue-extrabold mb-6 text-center">{{ strtoupper($item['title_' . $locale] ?? $item['title_en'] ?? 'BENEFIT ' . ($index + 1)) }}</h3>
                                    <div class="max-w-[300px] text-white/70 xl:text-[15.07px] font-['Poppins'] mx-auto text-bold mb-4 text-center">{!! $item['description_' . $locale] ?? $item['description_en'] ?? 'Benefit description' !!}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    @endif

    @if($investmentData?->isSectionVisible('cta') ?? true)
    <!-- CTA Section -->
    @include('partials.cta-section', [
        'backgroundImage' => $investmentData->cta_background_image && file_exists(storage_path('app/public/' . $investmentData->cta_background_image))
            ? asset('storage/' . $investmentData->cta_background_image)
            : asset('design/images/meeting-bg.png'),
        'backgroundAlt' => $localize($investmentData->cta_background_image_alt_en ?? null, $investmentData->cta_background_image_alt_ar ?? null) ?: strip_tags($ctaTitle),
        'titleHtml' => e($ctaTitle),
        'descriptionHtml' => $ctaDescription,
        'buttonOneText' => $ctaButton1Text,
        'buttonOneUrl' => $investmentData->cta_button_1_url ?? '/contact',
        'buttonTwoText' => $ctaButton2Text,
        'buttonTwoUrl' => $investmentData->cta_button_2_url ?? '/request-meeting',
    ])
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add CSS for smooth transitions
            const style = document.createElement('style');
            style.textContent = `
                .carousel-item {
                    transition: opacity 0.3s ease-in-out;
                }
            `;
            document.head.appendChild(style);
            
            // Carousel functionality
            const carousel = document.getElementById('carousel-container');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const items = carousel.querySelectorAll('.carousel-item');
            
            if (items.length > 0) {
                let currentIndex = 0;
                const totalItems = items.length;
                
                // Initial setup
                function setupCarousel() {
                    // On mobile, show only one item
                    if (window.innerWidth < 768) {
                        items.forEach((item, index) => {
                            item.style.display = index === currentIndex ? 'block' : 'none';
                        });
                    } else {
                        // On desktop, show two items
                        items.forEach((item, index) => {
                            item.style.display = (index >= currentIndex && index < currentIndex + 2) ? 'block' : 'none';
                        });
                    }
                    updateNavigationButtons();
                }
                
                function updateNavigationButtons() {
                    const itemsPerView = window.innerWidth < 768 ? 1 : 2;
                    prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
                    nextBtn.style.opacity = currentIndex >= totalItems - itemsPerView ? '0.5' : '1';
                    prevBtn.style.cursor = currentIndex === 0 ? 'default' : 'pointer';
                    nextBtn.style.cursor = currentIndex >= totalItems - itemsPerView ? 'default' : 'pointer';
                }
                
                function moveCarousel(direction) {
                    const itemsPerView = window.innerWidth < 768 ? 1 : 2;
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
                    const itemsPerView = window.innerWidth < 768 ? 1 : 2;
                    if (currentIndex >= totalItems - itemsPerView) {
                        currentIndex = Math.max(0, totalItems - itemsPerView);
                    }
                    setupCarousel();
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

                updateStepsCarousel();
            }
        });
    </script>
    </div>
</x-page-background>
@endsection

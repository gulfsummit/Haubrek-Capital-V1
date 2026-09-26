
@extends('app')

@section('content')
@php
    $localize = $localize ?? function ($en, $ar) {
        return app()->getLocale() === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
    };
    $isArabic = app()->getLocale() === 'ar';
    $normalizeLink = function (?string $value) {
        if (blank($value)) {
            return null;
        }

        if (\Illuminate\Support\Str::startsWith($value, ['http://', 'https://', 'mailto:', 'tel:', '#'])) {
            return $value;
        }

        return url($value);
    };

    $heroButtonUrl = null;
    if ($resourceCenter) {
        if (app()->getLocale() === 'ar') {
            $heroButtonUrl = $normalizeLink($resourceCenter->hero_button_url_ar ?? $resourceCenter->hero_button_url_en);
        } else {
            $heroButtonUrl = $normalizeLink($resourceCenter->hero_button_url_en ?? $resourceCenter->hero_button_url_ar);
        }
    }

    $heroButtonUrl = $heroButtonUrl ?: route('request-meeting');
    $heroDesktopAlt = $localize($resourceCenter?->hero_desktop_image_alt_en, $resourceCenter?->hero_desktop_image_alt_ar)
        ?: ($resourceCenter ? $localize($resourceCenter->hero_title_en, $resourceCenter->hero_title_ar) : 'Resource Center');
    $heroMobileAlt = $localize($resourceCenter?->hero_mobile_image_alt_en, $resourceCenter?->hero_mobile_image_alt_ar)
        ?: $heroDesktopAlt;
    $blogCardAlt = $localize($resourceCenter?->blog_card_image_alt_en, $resourceCenter?->blog_card_image_alt_ar)
        ?: $localize($resourceCenter?->blog_card_title_en, $resourceCenter?->blog_card_title_ar)
        ?: 'Articles';
    $caseStudiesCardAlt = $localize($resourceCenter?->case_studies_card_image_alt_en, $resourceCenter?->case_studies_card_image_alt_ar)
        ?: $localize($resourceCenter?->case_studies_card_title_en, $resourceCenter?->case_studies_card_title_ar)
        ?: 'Case Studies';
    $toolsCardAlt = $localize($resourceCenter?->tools_card_image_alt_en, $resourceCenter?->tools_card_image_alt_ar)
        ?: $localize($resourceCenter?->tools_card_title_en, $resourceCenter?->tools_card_title_ar)
        ?: 'Tools';

    $ctaButton1Url = null;
    $ctaButton2Url = null;

    if ($resourceCenter) {
        if (app()->getLocale() === 'ar') {
            $ctaButton1Url = $normalizeLink($resourceCenter->cta_button_1_url_ar ?? $resourceCenter->cta_button_1_url_en);
            $ctaButton2Url = $normalizeLink($resourceCenter->cta_button_2_url_ar ?? $resourceCenter->cta_button_2_url_en);
        } else {
            $ctaButton1Url = $normalizeLink($resourceCenter->cta_button_1_url_en ?? $resourceCenter->cta_button_1_url_ar);
            $ctaButton2Url = $normalizeLink($resourceCenter->cta_button_2_url_en ?? $resourceCenter->cta_button_2_url_ar);
        }
    }

    $ctaButton1Url = $ctaButton1Url ?: '#newsletter-popup';
    $ctaButton2Url = $ctaButton2Url ?: route('request-meeting');
    $heroSubtitle = $resourceCenter
        ? $localize($resourceCenter->hero_subtitle_en, $resourceCenter->hero_subtitle_ar)
        : 'Your gateway to expert insights, strategic investment knowledge, and exclusive financial tools-designed to empower investors and businesses alike.';
    $sectionSubtitle = $resourceCenter
        ? $localize($resourceCenter->section_subtitle_en, $resourceCenter->section_subtitle_ar)
        : 'Explore the dynamic teams that drive our innovation and expertise, each dedicated to optimizing your wealth advisory experience.';
@endphp
@if($resourceCenter?->isSectionVisible('hero') ?? true)
<section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
        <div class="relative overflow-hidden h-full">
            <div class="flex flex-col h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full">
                    <div class="w-full flex-shrink-0 relative">
                        <!-- Desktop background -->
                        <div class="absolute inset-0 hidden md:block">
                            <img src="{{ $resourceCenter && $resourceCenter->hero_desktop_image ? asset('storage/' . $resourceCenter->hero_desktop_image) : asset('design/images/resource-bg.png') }}" alt="{{ $heroDesktopAlt }}" class="w-full h-full object-cover"/>
                        </div>
                        <!-- Mobile background -->
                        <div class="absolute inset-0 block md:hidden">
                            <img src="{{ $resourceCenter && $resourceCenter->hero_mobile_image ? asset('storage/' . $resourceCenter->hero_mobile_image) : asset('design/images/resource-bg.png') }}" alt="{{ $heroMobileAlt }}" class="w-full h-full object-cover"/>
                        </div>
                        <div class="absolute inset-0 "></div>
                        <div class="relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                            <div class="container mx-auto text-center">
                                @php
                                    $pageH1 = isset($seoMeta) ? ($localize($seoMeta->h1_en ?? null, $seoMeta->h1_ar ?? null) ?? ($resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->hero_title_ar : $resourceCenter->hero_title_en) : (app()->getLocale() === 'ar' ? 'مركز الموارد' : 'RESOURCE CENTER'))) : ($resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->hero_title_ar : $resourceCenter->hero_title_en) : (app()->getLocale() === 'ar' ? 'مركز الموارد' : 'RESOURCE CENTER'));
                                @endphp
                                <h1 class="text-[45px] xl:text-[78px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">{{ $pageH1 }}</h1>
                                <div
                                    class="mb-8 text-[17px] xl:text-[18px] text-[#FFFFFF]/70 font-['Poppins'] font-regular text-center"
                                    dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
                                    style="unicode-bidi: plaintext;"
                                >
                                    {!! $heroSubtitle !!}
                                </div>
                                <a href="{{ $heroButtonUrl }}" class="bg-[#D4AF37] px-6 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">{{ $resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->hero_button_text_ar : $resourceCenter->hero_button_text_en) : 'REQUEST A MEETING' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@if(($resourceCenter?->isSectionVisible('main') ?? true) || ($resourceCenter?->isSectionVisible('cards') ?? true))
    <section class="relative py-12 md:py-24 bg-[#041B44] z-0 bg-[url('{{ asset('design/images/approach-bg.png') }}')] bg-cover bg-center">
        <div class="max-w-6xl z-0 mx-auto px-4 text-center">
            @if($resourceCenter?->isSectionVisible('main') ?? true)
                <h2 class="text-[32px] sm:text-[40px] md:text-[48px] font-neue-extrabold text-white mb-2">{{ $resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->section_title_ar : $resourceCenter->section_title_en) : 'EXPLORE OUR KEY RESOURCES' }}</h2>
                <div
                    class="text-base md:text-lg text-white/70 mb-8 md:mb-10 max-w-2xl mx-auto px-4 text-center"
                    dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
                    style="unicode-bidi: plaintext;"
                >
                    {!! $sectionSubtitle !!}
                </div>
            @endif
            <!-- Tabs -->
            <!-- <div class="grid grid-cols-2 md:flex md:flex-nowrap justify-center relative z-0">
                <button class="resource-tab w-full md:w-auto px-4 sm:px-6 md:px-8 py-2 md:py-3 font-neue-bold text-[#041B44] bg-white md:rounded-tl-xl shadow tab-active" data-tab="blog">BLOG</button>
                <button class="resource-tab w-full md:w-auto px-4 sm:px-6 md:px-8 py-2 md:py-3 font-neue-bold text-white bg-[#D4AF37]" data-tab="manuals">HAUBERK<span class="hidden md:inline"><br></span> MANUALS</button>
                <button class="resource-tab w-full md:w-auto px-4 sm:px-6 md:px-8 py-2 md:py-3 font-neue-bold text-white bg-[#D4AF37]" data-tab="news">NEWS &<span class="hidden md:inline"><br></span> EVENTS</button>
                <button class="resource-tab w-full md:w-auto px-4 sm:px-6 md:px-8 py-2 md:py-3 font-neue-bold text-white bg-[#D4AF37] md:rounded-tr-xl" data-tab="tools">INVESTOR<span class="hidden md:inline"><br></span> TOOLS</button>
            </div> -->
            <!-- Content Box -->
            @if($resourceCenter?->isSectionVisible('cards') ?? true)
            <div class="bg-white md:rounded-2xl shadow-xl px-4 sm:px-6 md:px-12 py-8 md:py-10 mt-0 max-w-full mx-auto -mt-2 relative z-0">
                <!-- BLOG TAB -->
                @php
                    $blogLink = $normalizeLink(optional($resourceCenter)->blog_card_link ?? route('blog'));
                    $caseStudyLink = $normalizeLink(optional($resourceCenter)->case_studies_card_link ?? route('case-studies'));
                    $toolsLink = $normalizeLink(optional($resourceCenter)->tools_card_link ?? route('tools'));

                    $blogEnabled = optional($resourceCenter)->blog_card_enabled;
                    $caseEnabled = optional($resourceCenter)->case_studies_card_enabled;
                    $toolsEnabled = optional($resourceCenter)->tools_card_enabled;

                    $blogEnabled = is_null($blogEnabled) ? true : $blogEnabled;
                    $caseEnabled = is_null($caseEnabled) ? true : $caseEnabled;
                    $toolsEnabled = is_null($toolsEnabled) ? true : $toolsEnabled;
                @endphp
                <div class="resource-tab-content" id="tab-blog">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-8 justify-center">
                        <div class="bg-[#F6F6F6] rounded-xl overflow-hidden flex flex-col items-center h-[180px] sm:h-[200px] md:h-[220px]">
                            @if($blogEnabled && $blogLink)
                                <a href="{{ $blogLink }}" class="relative w-full h-full group">
                                    <img src="{{ $resourceCenter && $resourceCenter->blog_card_image ? asset('storage/' . $resourceCenter->blog_card_image) : asset('design/images/articles.png') }}" alt="{{ $blogCardAlt }}" class="w-full h-full object-cover rounded-lg transition group-hover:scale-105 duration-300">
                                    <span class="absolute inset-0 flex items-center justify-center text-xl sm:text-2xl font-neue-extrabold text-[#041B44] drop-shadow-lg">{{ $resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->blog_card_title_ar : $resourceCenter->blog_card_title_en) : 'Blogs / News' }}</span>
                                </a>
                            @else
                                <div class="relative w-full h-full pointer-events-none opacity-60">
                                    <img src="{{ $resourceCenter && $resourceCenter->blog_card_image ? asset('storage/' . $resourceCenter->blog_card_image) : asset('design/images/articles.png') }}" alt="{{ $blogCardAlt }}" class="w-full h-full object-cover rounded-lg">
                                    <span class="absolute inset-0 flex items-center justify-center text-xl sm:text-2xl font-neue-extrabold text-[#041B44] drop-shadow-lg">{{ $resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->blog_card_title_ar : $resourceCenter->blog_card_title_en) : 'Blogs / News' }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="bg-[#F6F6F6] rounded-xl overflow-hidden flex flex-col items-center h-[180px] sm:h-[200px] md:h-[220px]">
                            @if($caseEnabled && $caseStudyLink)
                                <a href="{{ $caseStudyLink }}" class="relative w-full h-full group">
                                    <img src="{{ $resourceCenter && $resourceCenter->case_studies_card_image ? asset('storage/' . $resourceCenter->case_studies_card_image) : asset('design/images/e-book.png') }}" alt="{{ $caseStudiesCardAlt }}" class="w-full h-full object-cover rounded-lg transition group-hover:scale-105 duration-300">
                                    <span class="absolute inset-0 flex items-center justify-center text-xl sm:text-2xl font-neue-extrabold text-[#041B44] drop-shadow-lg">{{ $resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->case_studies_card_title_ar : $resourceCenter->case_studies_card_title_en) : 'Case Studies' }}</span>
                                </a>
                            @else
                                <div class="relative w-full h-full pointer-events-none opacity-60">
                                    <img src="{{ $resourceCenter && $resourceCenter->case_studies_card_image ? asset('storage/' . $resourceCenter->case_studies_card_image) : asset('design/images/e-book.png') }}" alt="{{ $caseStudiesCardAlt }}" class="w-full h-full object-cover rounded-lg">
                                    <span class="absolute inset-0 flex items-center justify-center text-xl sm:text-2xl font-neue-extrabold text-[#041B44] drop-shadow-lg">{{ $resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->case_studies_card_title_ar : $resourceCenter->case_studies_card_title_en) : 'Case Studies' }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="bg-[#F6F6F6] rounded-xl overflow-hidden flex flex-col items-center h-[180px] sm:h-[200px] md:h-[220px] sm:col-span-2 md:col-span-1">
                            @if($toolsEnabled && $toolsLink)
                                <a href="{{ $toolsLink }}" class="relative w-full h-full group">
                                    <img src="{{ $resourceCenter && $resourceCenter->tools_card_image ? asset('storage/' . $resourceCenter->tools_card_image) : asset('design/images/glossary.png') }}" alt="{{ $toolsCardAlt }}" class="w-full h-full object-cover rounded-lg transition group-hover:scale-105 duration-300">
                                    <span class="absolute inset-0 flex items-center justify-center text-xl sm:text-2xl font-neue-extrabold text-[#041B44] drop-shadow-lg">{{ $resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->tools_card_title_ar : $resourceCenter->tools_card_title_en) : 'Tools' }}</span>
                                </a>
                            @else
                                <div class="relative w-full h-full pointer-events-none opacity-60">
                                    <img src="{{ $resourceCenter && $resourceCenter->tools_card_image ? asset('storage/' . $resourceCenter->tools_card_image) : asset('design/images/glossary.png') }}" alt="{{ $toolsCardAlt }}" class="w-full h-full object-cover rounded-lg">
                                    <span class="absolute inset-0 flex items-center justify-center text-xl sm:text-2xl font-neue-extrabold text-[#041B44] drop-shadow-lg">{{ $resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->tools_card_title_ar : $resourceCenter->tools_card_title_en) : 'Tools' }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- MANUALS TAB -->
                <div class="resource-tab-content hidden" id="tab-manuals">
                    <div class="py-8 md:py-12 text-[#223057] text-lg md:text-xl font-neue-bold text-center">Hauberk Manuals content goes here.</div>
                </div>
                <!-- NEWS TAB -->
                <div class="resource-tab-content hidden" id="tab-news">
                    <div class="py-8 md:py-12 text-[#223057] text-lg md:text-xl font-neue-bold text-center">News & Events content goes here.</div>
                </div>
                <!-- TOOLS TAB -->
                <div class="resource-tab-content hidden" id="tab-tools">
                    <div class="py-8 md:py-12 text-[#223057] text-lg md:text-xl font-neue-bold text-center">Investor Tools content goes here.</div>
                </div>
            </div>
            @endif
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tabs = document.querySelectorAll('.resource-tab');
                const tabContents = document.querySelectorAll('.resource-tab-content');

                // Fix for mobile layout - ensure tabs are properly aligned in rows
                if (window.innerWidth < 768) {
                    const tabsContainer = document.querySelector('.resource-tab').parentElement;
                    tabsContainer.classList.add('grid', 'grid-cols-2');
                }

                tabs.forEach(tab => {
                    tab.addEventListener('click', function() {
                        // Remove active styles
                        tabs.forEach(t => t.classList.remove('tab-active', 'bg-white', 'text-[#041B44]'));
                        tabs.forEach(t => t.classList.add('bg-[#D4AF37]', 'text-white'));
                        this.classList.add('tab-active', 'bg-white', 'text-[#041B44]');
                        this.classList.remove('bg-[#D4AF37]', 'text-white');
                        // Show correct tab
                        tabContents.forEach(tc => tc.classList.add('hidden'));
                        document.getElementById('tab-' + this.dataset.tab).classList.remove('hidden');
                    });
                });

                // Handle window resize for responsive layout
                window.addEventListener('resize', function() {
                    const tabsContainer = document.querySelector('.resource-tab').parentElement;
                    if (window.innerWidth < 768) {
                        tabsContainer.classList.add('grid', 'grid-cols-2');
                    } else {
                        tabsContainer.classList.remove('grid', 'grid-cols-2');
                    }
                });
            });
        </script>
    </section>
@endif

@if($resourceCenter?->isSectionVisible('cta') ?? true)
    @include('partials.cta-section', [
        'backgroundImage' => $resourceCenter && $resourceCenter->cta_background_image ? asset('storage/' . $resourceCenter->cta_background_image) : asset('design/images/meeting-bg.png'),
        'backgroundAlt' => $localize($resourceCenter?->cta_background_image_alt_en, $resourceCenter?->cta_background_image_alt_ar)
            ?: strip_tags($resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->cta_title_ar : $resourceCenter->cta_title_en) : 'READY TO START GROWING?!'),
        'titleHtml' => $resourceCenter ? nl2br(e(app()->getLocale() === 'ar' ? $resourceCenter->cta_title_ar : $resourceCenter->cta_title_en)) : 'READY TO<br/>START GROWING?!',
        'descriptionHtml' => '<p>' . e($resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->cta_subtitle_ar : $resourceCenter->cta_subtitle_en) : 'Unlock the full potential of your wealth') . '</p>',
        'buttonOneText' => $resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->cta_button_1_text_ar : $resourceCenter->cta_button_1_text_en) : 'JOIN OUR MAILING LIST',
        'buttonOneUrl' => $ctaButton1Url,
        'buttonTwoText' => $resourceCenter ? (app()->getLocale() === 'ar' ? $resourceCenter->cta_button_2_text_ar : $resourceCenter->cta_button_2_text_en) : 'REQUEST A MEETING',
        'buttonTwoUrl' => $ctaButton2Url,
    ])
@endif

<script src="index.js"></script>

@endsection
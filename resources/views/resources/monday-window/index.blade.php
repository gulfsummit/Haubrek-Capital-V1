@extends('app')

@section('content')
@php
    $locale = app()->getLocale();
    $isArabic = $locale === 'ar';
    $localize = $localize ?? function ($en, $ar) use ($locale) {
        return $locale === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
    };
    $pageDirection  = $isArabic ? 'rtl' : 'ltr';
    $alignmentClass = $isArabic ? 'text-right' : 'text-left';
    $normalizeLink  = function ($url) {
        if (empty($url)) return '#';
        if (\Illuminate\Support\Str::startsWith($url, ['http://', 'https://', 'mailto:', 'tel:', '#'])) return $url;
        return url($url);
    };

    $heroTitle      = $localize($pageContent?->title_en, $pageContent?->title_ar) ?: ($isArabic ? 'نافذة الاثنين' : 'MONDAY WINDOW');
    $heroSubtitle   = $localize($pageContent?->subtitle_en, $pageContent?->subtitle_ar) ?: ($isArabic ? 'تحليل أسبوعي لأبرز ما يشهده السوق.' : 'Weekly analysis of key market developments.');
    $heroDesktop    = $pageContent?->hero_desktop_image ? asset('storage/' . $pageContent->hero_desktop_image) : asset('design/images/resource-bg.png');
    $heroMobile     = $pageContent?->hero_mobile_image  ? asset('storage/' . $pageContent->hero_mobile_image)  : $heroDesktop;
    $learnMoreLabel = $localize($pageContent?->learn_more_label_en, $pageContent?->learn_more_label_ar) ?: ($isArabic ? 'اقرأ المزيد' : 'Read More');
    $noItemsLabel   = $localize($pageContent?->empty_state_title_en, $pageContent?->empty_state_title_ar) ?: ($isArabic ? 'لا توجد إصدارات حالياً.' : 'No editions available yet.');
    $checkBackLabel = $localize($pageContent?->empty_state_description_en, $pageContent?->empty_state_description_ar) ?: ($isArabic ? 'تابعنا للاطلاع على محتوى جديد.' : 'Check back later for new content.');
    $ctaBackground  = $pageContent?->cta_background_image ? asset('storage/' . $pageContent->cta_background_image) : asset('design/images/meeting-bg.png');
    $ctaTitle       = $localize($pageContent?->cta_title_en, $pageContent?->cta_title_ar) ?: ($isArabic ? 'مستعد لبدء النمو؟' : 'READY TO START GROWING?!');
    $ctaDescription = $localize($pageContent?->cta_description_en, $pageContent?->cta_description_ar) ?: ($isArabic ? 'أطلق العنان للإمكانات الكاملة لثروتك' : 'Unlock the full potential of your wealth');
    $ctaButton1Text = $localize($pageContent?->cta_button_1_text_en, $pageContent?->cta_button_1_text_ar) ?: ($isArabic ? 'انضم إلى قائمتنا البريدية' : 'JOIN OUR MAILING LIST');
    $ctaButton2Text = $localize($pageContent?->cta_button_2_text_en, $pageContent?->cta_button_2_text_ar) ?: ($isArabic ? 'اطلب اجتماعاً' : 'REQUEST A MEETING');
    $ctaButton1Url  = $normalizeLink($pageContent?->cta_button_1_url ?: '#newsletter-popup');
    $ctaButton2Url  = $normalizeLink($pageContent?->cta_button_2_url ?: route('request-meeting'));
@endphp

{{-- Hero --}}
<section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
    <div class="relative overflow-hidden h-full">
        <div class="w-full h-full relative">
            <div class="absolute inset-0 hidden md:block"><img src="{{ $heroDesktop }}" alt="" class="w-full h-full object-cover"/></div>
            <div class="absolute inset-0 block md:hidden"><img src="{{ $heroMobile }}" alt="" class="w-full h-full object-cover"/></div>
            <div class="absolute inset-0 bg-navy-900/40"></div>
            <div class="relative h-full flex items-center justify-center">
                <div class="container mx-auto text-center px-4">
                    <h1 class="text-[45px] xl:text-[78px] leading-tight font-neue-extrabold mb-4">{{ $heroTitle }}</h1>
                    <p class="font-['Poppins'] text-[18px] text-white/80 max-w-3xl mx-auto">{!! $heroSubtitle !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Search --}}
<section class="bg-[#041B44] py-10" dir="{{ $pageDirection }}">
    <div class="container mx-auto px-4 flex flex-col items-center gap-3">
        <p class="text-white/60 text-sm font-semibold uppercase tracking-widest">
            {{ $isArabic ? 'ابحث في الإصدارات' : 'Search Monday Window' }}
        </p>
        <form method="GET" action="{{ route('monday-window') }}" class="flex w-full max-w-2xl gap-0 rounded-xl overflow-hidden shadow-lg ring-1 ring-white/10">
            <input
                type="text"
                name="search"
                value="{{ $searchTerm }}"
                placeholder="{{ $isArabic ? 'بحث...' : 'Search Monday Window...' }}"
                class="flex-1 bg-white/10 text-white placeholder-white/40 px-5 py-3 text-sm focus:outline-none focus:bg-white/15 transition"
            />
            <button type="submit" class="bg-[#D4AF37] text-white px-6 py-3 text-sm font-semibold hover:bg-[#b8962e] transition whitespace-nowrap">
                {{ $isArabic ? 'بحث' : 'Search' }}
            </button>
            @if($searchTerm)
                <a href="{{ route('monday-window') }}" class="bg-white/10 text-white/70 px-5 py-3 text-sm hover:bg-white/20 transition whitespace-nowrap">
                    {{ $isArabic ? 'مسح' : 'Clear' }}
                </a>
            @endif
        </form>
    </div>
</section>

{{-- Editions --}}
<section class="py-12 bg-gray-50 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('design/images/blog-bg.png') }}');" dir="{{ $pageDirection }}">
    <div class="container mx-auto px-4">
        @if($editions->isEmpty())
            <div class="text-center py-20">
                <p class="text-2xl font-semibold text-gray-700 mb-2">{{ $noItemsLabel }}</p>
                <p class="text-gray-500">{{ $checkBackLabel }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($editions as $edition)
                @php
                    $edTitle   = $localize($edition->title_en, $edition->title_ar);
                    $edSummary = $localize($edition->short_summary_en, $edition->short_summary_ar);
                    $edImage   = $edition->featured_image ? asset('storage/' . $edition->featured_image) : asset('design/images/blog.png');
                    $edAlt     = $localize($edition->featured_image_alt_en, $edition->featured_image_alt_ar) ?: $edTitle;
                @endphp
                <article class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow group">
                    <a href="{{ route('monday-window.show', $edition->slug) }}" class="block">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ $edImage }}" alt="{{ $edAlt }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                        </div>
                    </a>
                    <div class="p-5" dir="{{ $pageDirection }}">
                        {{-- Week Date Badge --}}
                        @if($edition->week_date)
                            <div class="flex items-center gap-1 text-xs text-[#D4AF37] font-semibold mb-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $edition->week_date->format('d M Y') }}
                            </div>
                        @endif
                        {{-- Market Topics --}}
                        @if(!empty($edition->market_topics))
                            <div class="flex flex-wrap gap-1 mb-2">
                                @foreach(array_slice($edition->market_topics, 0, 2) as $topic)
                                    <span class="text-xs bg-[#D4AF37]/10 text-[#b8962e] px-2 py-0.5 rounded">{{ $topic }}</span>
                                @endforeach
                            </div>
                        @endif
                        <h2 class="text-base font-bold text-gray-900 mb-2 line-clamp-2 min-h-[3rem] {{ $alignmentClass }}">
                            <a href="{{ route('monday-window.show', $edition->slug) }}" class="hover:text-[#D4AF37] transition-colors">{{ $edTitle }}</a>
                        </h2>
                        @if($edSummary)
                            <p class="text-gray-500 text-sm mb-3 line-clamp-3 {{ $alignmentClass }}">{!! strip_tags($edSummary) !!}</p>
                        @endif
                        <a href="{{ route('monday-window.show', $edition->slug) }}"
                           class="inline-flex items-center text-sm font-semibold text-[#D4AF37] hover:text-[#b8962e] transition-colors">
                            {{ $learnMoreLabel }}
                            <svg class="w-4 h-4 {{ $isArabic ? 'mr-1 rotate-180' : 'ml-1' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="relative py-20 text-white overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ $ctaBackground }}" alt="" class="w-full h-full object-cover" aria-hidden="true"/>
        <div class="absolute inset-0 bg-navy-900/70"></div>
    </div>
    <div class="relative container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-5xl font-neue-extrabold mb-4">{!! $ctaTitle !!}</h2>
        <p class="text-white/80 text-lg mb-8 max-w-2xl mx-auto">{!! $ctaDescription !!}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ $ctaButton1Url }}" class="bg-[#D4AF37] text-white px-8 py-3 rounded font-semibold hover:bg-[#b8962e] transition">{{ $ctaButton1Text }}</a>
            <a href="{{ $ctaButton2Url }}" class="border border-white text-white px-8 py-3 rounded font-semibold hover:bg-white hover:text-navy-900 transition">{{ $ctaButton2Text }}</a>
        </div>
    </div>
</section>

@endsection

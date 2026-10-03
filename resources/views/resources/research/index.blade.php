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

    $heroTitle      = $localize($pageContent?->title_en, $pageContent?->title_ar) ?: ($isArabic ? 'الأبحاث' : 'RESEARCH');
    $heroSubtitle   = $localize($pageContent?->subtitle_en, $pageContent?->subtitle_ar) ?: ($isArabic ? 'أبحاث وتقارير متعمقة تدعم قراراتك الاستثمارية.' : 'In-depth research and reports to support your investment decisions.');
    $heroDesktop    = $pageContent?->hero_desktop_image ? asset('storage/' . $pageContent->hero_desktop_image) : asset('design/images/resource-bg.png');
    $heroMobile     = $pageContent?->hero_mobile_image  ? asset('storage/' . $pageContent->hero_mobile_image)  : $heroDesktop;
    $learnMoreLabel = $localize($pageContent?->learn_more_label_en, $pageContent?->learn_more_label_ar) ?: ($isArabic ? 'عرض البحث' : 'View Research');
    $downloadLabel  = $isArabic ? 'تحميل PDF' : 'Download PDF';
    $noItemsLabel   = $localize($pageContent?->empty_state_title_en, $pageContent?->empty_state_title_ar) ?: ($isArabic ? 'لا توجد أبحاث حالياً.' : 'No research available yet.');
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
        <div class="flex flex-col h-full">
            <div class="w-full flex-shrink-0 relative h-full">
                <div class="absolute inset-0 hidden md:block">
                    <img loading="lazy" src="{{ $heroDesktop }}" alt="{{ $heroTitle }}" class="w-full h-full object-cover"/>
                </div>
                <div class="absolute inset-0 block md:hidden">
                    <img loading="lazy" src="{{ $heroMobile }}" alt="{{ $heroTitle }}" class="w-full h-full object-cover"/>
                </div>
                <div class="absolute inset-0 bg-navy-900/40"></div>
                <div class="relative h-full flex items-center justify-center">
                    <div class="container mx-auto text-center px-4">
                        <h1 class="text-[45px] xl:text-[78px] leading-tight font-neue-extrabold mb-4">{{ $heroTitle }}</h1>
                        <p class="font-['Poppins'] text-[18px] text-white/80 max-w-3xl mx-auto">{!! $heroSubtitle !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Search --}}
<section class="bg-[#041B44] py-10" dir="{{ $pageDirection }}">
    <div class="container mx-auto px-4 flex flex-col items-center gap-3">
        <p class="text-white/60 text-sm font-semibold uppercase tracking-widest">
            {{ $isArabic ? 'ابحث في الأبحاث' : 'Search Research' }}
        </p>
        <form method="GET" action="{{ route('research') }}" class="flex w-full max-w-2xl gap-0 rounded-xl overflow-hidden shadow-lg ring-1 ring-white/10">
            <input
                type="text"
                name="search"
                value="{{ $searchTerm }}"
                placeholder="{{ $isArabic ? 'بحث في الأبحاث...' : 'Search research...' }}"
                class="flex-1 bg-white/10 text-white placeholder-white/40 px-5 py-3 text-sm focus:outline-none focus:bg-white/15 transition"
            />
            <button type="submit" class="bg-[#D4AF37] text-white px-6 py-3 text-sm font-semibold hover:bg-[#b8962e] transition whitespace-nowrap">
                {{ $isArabic ? 'بحث' : 'Search' }}
            </button>
            @if($searchTerm)
                <a href="{{ route('research') }}" class="bg-white/10 text-white/70 px-5 py-3 text-sm hover:bg-white/20 transition whitespace-nowrap">
                    {{ $isArabic ? 'مسح' : 'Clear' }}
                </a>
            @endif
        </form>
    </div>
</section>

{{-- Search + Research Grid --}}
<section class="pt-32 pb-16 sm:pt-36 sm:pb-20 md:pt-40 md:pb-24 lg:pt-[5em] lg:pb-32 bg-white bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('design/images/blog-bg.png') }}');" dir="{{ $pageDirection }}">
    {{-- Research Grid --}}
    <div class="container mx-auto px-4">
        @if($researchItems->isEmpty())
            <div class="text-center py-20">
                <p class="text-2xl font-semibold text-white mb-2">{{ $noItemsLabel }}</p>
                <p class="text-white/70">{{ $checkBackLabel }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10 w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto">
                @foreach($researchItems as $item)
                @php
                    $rTitle  = $localize($item->title_en, $item->title_ar);
                    $rDesc   = $localize($item->short_description_en, $item->short_description_ar);
                    $rType   = $localize($item->research_type_en, $item->research_type_ar);
                    $rAuthor = $localize($item->author_en, $item->author_ar);
                    $rImage  = $item->cover_image ? asset('storage/' . $item->cover_image) : asset('design/images/blog.png');
                    $rAlt    = $localize($item->cover_image_alt_en, $item->cover_image_alt_ar) ?: $rTitle;
                @endphp
                <article class="rounded-lg overflow-hidden hover:opacity-90 transition-opacity group flex flex-col">
                    <a href="{{ route('research.show', $item->slug) }}" class="block">
                        <div class="h-52 overflow-hidden relative">
                            <img loading="lazy" src="{{ $rImage }}" alt="{{ $rAlt }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                            @if($item->form_required)
                                <div class="absolute top-3 {{ $isArabic ? 'left-3' : 'right-3' }} bg-navy-900/80 text-white text-xs px-2 py-1 rounded flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-8 0v4h8z"/></svg>
                                    {{ $isArabic ? 'يتطلب تسجيل' : 'Registration Required' }}
                                </div>
                            @endif
                        </div>
                    </a>
                    <div class="pt-6 flex flex-col flex-1" dir="{{ $pageDirection }}">
                        @if($rType)
                            <span class="inline-block text-xs font-semibold text-[#b8962e] bg-[#D4AF37]/10 px-2 py-1 rounded mb-2">{{ $rType }}</span>
                        @endif
                        @if(!empty($item->topics))
                            <div class="flex flex-wrap gap-1 mb-2">
                                @foreach(array_slice($item->topics, 0, 2) as $topic)
                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded">{{ $topic }}</span>
                                @endforeach
                            </div>
                        @endif
                        <p class="text-base font-bold text-white mb-2 leading-snug line-clamp-2 min-h-[3rem] {{ $alignmentClass }}">
                            <a href="{{ route('research.show', $item->slug) }}" class="hover:text-[#D4AF37] transition-colors">{{ $rTitle }}</a>
                        </p>
                        @if($rDesc)
                            <p class="text-white/70 text-sm mb-3 line-clamp-3 {{ $alignmentClass }}">{{ strip_tags($rDesc) }}</p>
                        @endif
                        <div class="flex items-center justify-between text-xs text-white/50 mt-auto">
                            @if($rAuthor) <span>{{ $rAuthor }}</span> @endif
                            @if($item->publication_date) <span>{{ $item->publication_date->format('M Y') }}</span> @endif
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('research.show', $item->slug) }}"
                               class="inline-flex items-center gap-1 mt-2 px-4 py-2 text-sm font-semibold bg-[#D4AF37] hover:bg-[#b8962e] text-white rounded transition-colors">
                                {{ $learnMoreLabel }}
                                <svg class="w-4 h-4 {{ $isArabic ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
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
        <img loading="lazy" src="{{ $ctaBackground }}" alt="" class="w-full h-full object-cover" aria-hidden="true"/>
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

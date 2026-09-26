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

    $heroTitle      = $localize($pageContent?->title_en, $pageContent?->title_ar) ?: ($isArabic ? 'CIO Flash' : 'CIO FLASH');
    $heroSubtitle   = $localize($pageContent?->subtitle_en, $pageContent?->subtitle_ar) ?: ($isArabic ? 'رؤى صوتية شهرية من فريق الاستثمار لدينا.' : 'Monthly audio insights from our investment team.');
    $heroDesktop    = $pageContent?->hero_desktop_image ? asset('storage/' . $pageContent->hero_desktop_image) : asset('design/images/resource-bg.png');
    $heroMobile     = $pageContent?->hero_mobile_image  ? asset('storage/' . $pageContent->hero_mobile_image)  : $heroDesktop;
    $learnMoreLabel = $localize($pageContent?->learn_more_label_en, $pageContent?->learn_more_label_ar) ?: ($isArabic ? 'استمع الآن' : 'Listen Now');
    $noItemsLabel   = $localize($pageContent?->empty_state_title_en, $pageContent?->empty_state_title_ar) ?: ($isArabic ? 'لا توجد حلقات حالياً.' : 'No episodes available yet.');
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
<section class="bg-white py-8" dir="{{ $pageDirection }}">
    <div class="container mx-auto px-4">
        <form method="GET" action="{{ route('cio-flash') }}" class="flex gap-2 max-w-xl">
            <input type="text" name="search" value="{{ $searchTerm }}"
                placeholder="{{ $isArabic ? 'بحث في الحلقات...' : 'Search episodes...' }}"
                class="flex-1 border border-gray-300 rounded px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#D4AF37]"/>
            <button type="submit" class="bg-[#D4AF37] text-white px-5 py-2 rounded text-sm font-semibold hover:bg-[#b8962e] transition">
                {{ $isArabic ? 'بحث' : 'Search' }}
            </button>
            @if($searchTerm)
                <a href="{{ route('cio-flash') }}" class="border border-gray-300 text-gray-600 px-4 py-2 rounded text-sm hover:bg-gray-50 transition">{{ $isArabic ? 'مسح' : 'Clear' }}</a>
            @endif
        </form>
    </div>
</section>

{{-- Episodes Grid --}}
<section class="py-12 bg-gray-50" dir="{{ $pageDirection }}">
    <div class="container mx-auto px-4">
        @if($episodes->isEmpty())
            <div class="text-center py-20">
                <p class="text-2xl font-semibold text-gray-700 mb-2">{{ $noItemsLabel }}</p>
                <p class="text-gray-500">{{ $checkBackLabel }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($episodes as $episode)
                @php
                    $epTitle   = $localize($episode->episode_title_en, $episode->episode_title_ar);
                    $epDesc    = $localize($episode->description_en, $episode->description_ar);
                    $epSpeaker = $localize($episode->speaker_en, $episode->speaker_ar);
                    $epPos     = $localize($episode->speaker_position_en, $episode->speaker_position_ar);
                    $epImage   = $episode->featured_image ? asset('storage/' . $episode->featured_image) : asset('design/images/blog.png');
                    $epAlt     = $localize($episode->featured_image_alt_en, $episode->featured_image_alt_ar) ?: $epTitle;
                @endphp
                <article class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow group">
                    <a href="{{ route('cio-flash.show', $episode->slug) }}" class="block relative">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ $epImage }}" alt="{{ $epAlt }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                        </div>
                        {{-- Play Icon Overlay --}}
                        <div class="absolute inset-0 bg-navy-900/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="w-14 h-14 bg-[#D4AF37] rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                        @if($episode->episode_number)
                            <span class="absolute top-3 {{ $isArabic ? 'right-3' : 'left-3' }} bg-[#D4AF37] text-white text-xs font-bold px-2 py-1 rounded">
                                EP. {{ $episode->episode_number }}
                            </span>
                        @endif
                    </a>
                    <div class="p-5" dir="{{ $pageDirection }}">
                        <h2 class="text-base font-bold text-gray-900 mb-2 {{ $alignmentClass }}">
                            <a href="{{ route('cio-flash.show', $episode->slug) }}" class="hover:text-[#D4AF37] transition-colors">{{ $epTitle }}</a>
                        </h2>
                        @if($epDesc)
                            <p class="text-gray-500 text-sm mb-3 line-clamp-2 {{ $alignmentClass }}">{!! strip_tags($epDesc) !!}</p>
                        @endif
                        <div class="flex items-center justify-between text-xs text-gray-400">
                            <div>
                                @if($epSpeaker) <span class="font-medium text-gray-600">{{ $epSpeaker }}</span> @endif
                                @if($epPos) <span class="block text-gray-400">{{ $epPos }}</span> @endif
                            </div>
                            @if($episode->duration)
                                <span class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $episode->duration }}
                                </span>
                            @endif
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('cio-flash.show', $episode->slug) }}"
                               class="inline-flex items-center text-sm font-semibold text-[#D4AF37] hover:text-[#b8962e] transition-colors">
                                {{ $learnMoreLabel }}
                                <svg class="w-4 h-4 {{ $isArabic ? 'mr-1 rotate-180' : 'ml-1' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

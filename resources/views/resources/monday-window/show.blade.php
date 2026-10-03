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

    $title          = $localize($edition->title_en, $edition->title_ar);
    $summary        = $localize($edition->short_summary_en, $edition->short_summary_ar);
    $content        = $localize($edition->content_en, $edition->content_ar);
    $image          = $edition->featured_image ? asset('storage/' . $edition->featured_image) : asset('design/images/blog.png');
    $imageAlt       = $localize($edition->featured_image_alt_en, $edition->featured_image_alt_ar) ?: $title;
    $breadcrumbSep  = $isArabic ? '<span class="text-gray-400 mx-2">/</span>' : '<span class="text-gray-400 mx-2">></span>';
    $homeLabel      = $isArabic ? 'الرئيسية' : 'Home';
    $listLabel      = $isArabic ? 'نافذة الاثنين' : 'Monday Window';
    $backLabel      = $isArabic ? 'العودة إلى نافذة الاثنين' : 'Back to Monday Window';
    $latestLabel    = $isArabic ? 'إصدارات أخرى' : 'OTHER EDITIONS';
    $learnMoreLabel = $isArabic ? 'اقرأ المزيد' : 'Read More';
@endphp

{{-- Breadcrumb --}}
<section class="bg-white pt-32 pb-4">
    <div class="container mx-auto px-4" dir="{{ $pageDirection }}">
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-[#D4AF37] transition-colors">{{ $homeLabel }}</a>
            {!! $breadcrumbSep !!}
            <a href="{{ route('monday-window') }}" class="text-gray-500 hover:text-[#D4AF37] transition-colors">{{ $listLabel }}</a>
            {!! $breadcrumbSep !!}
            <span class="text-[#20B2AA] font-medium">{{ Str::limit($title, 40) }}</span>
        </nav>
    </div>
</section>

{{-- Main --}}
<section class="w-full bg-white pt-8" dir="{{ $pageDirection }}"><div class="container mx-auto">
    <div class="px-4">
        <img
            src="{{ $image }}"
            alt="{{ $imageAlt }}"
            class="rounded w-full object-cover mb-6 max-h-[500px] h-auto"
            loading="eager"
        />
    </div>
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-10 {{ $isArabic ? 'lg:flex-row-reverse' : '' }}">
            <main class="flex-1 min-w-0">
                {{-- Week Date --}}
                @if($edition->week_date)
                    <div class="flex items-center gap-2 text-sm text-[#D4AF37] font-semibold mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ $isArabic ? 'أسبوع' : 'Week of' }} {{ $edition->week_date->format('d M Y') }}</span>
                    </div>
                @endif

                <h1 class="article-title font-neue-extrabold text-gray-900 mb-4 {{ $alignmentClass }}">{{ $title }}</h1>

                {{-- Market Topics --}}
                @if(!empty($edition->market_topics))
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($edition->market_topics as $topic)
                            <span class="text-xs bg-[#D4AF37]/10 text-[#b8962e] px-3 py-1 rounded-full">{{ $topic }}</span>
                        @endforeach
                    </div>
                @endif

                {{-- Summary --}}
                @if($summary)
                    <div class="text-lg text-gray-600 leading-relaxed mb-8 {{ $alignmentClass }}">{!! $summary !!}</div>
                @endif

                {{-- Full Content --}}
                @if($content)
                    <div class="prose prose-lg max-w-none {{ $alignmentClass }}">{!! $content !!}</div>
                @endif

                {{-- External Sources --}}
                @if(!empty($edition->external_sources))
                    <div class="mt-8 p-5 bg-gray-50 rounded-lg border border-gray-100">
                        <h3 class="text-base font-bold text-gray-800 mb-3 {{ $alignmentClass }}">{{ $isArabic ? 'المصادر الخارجية' : 'External Sources' }}</h3>
                        <ul class="space-y-2">
                            @foreach($edition->external_sources as $source)
                                @if(!empty($source['url']))
                                    <li class="flex items-center gap-2 text-sm">
                                        <svg class="w-3 h-3 text-[#D4AF37] shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        <a href="{{ $source['url'] }}" target="_blank" rel="noopener"
                                           class="text-[#D4AF37] hover:text-[#b8962e] hover:underline transition-colors">
                                            {{ $localize($source['label_en'] ?? null, $source['label_ar'] ?? null) ?: $source['url'] }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Related Articles --}}
                @if(!empty($edition->related_articles))
                    <div class="mt-6 p-5 bg-gray-50 rounded-lg border border-gray-100">
                        <h3 class="text-base font-bold text-gray-800 mb-3 {{ $alignmentClass }}">{{ $isArabic ? 'مقالات ذات صلة' : 'Related Articles' }}</h3>
                        <ul class="space-y-2">
                            @foreach($edition->related_articles as $article)
                                @if(!empty($article['url']))
                                    <li>
                                        <a href="{{ $article['url'] }}" target="_blank" rel="noopener"
                                           class="text-sm text-[#D4AF37] hover:text-[#b8962e] hover:underline transition-colors">
                                            {{ $localize($article['label_en'] ?? null, $article['label_ar'] ?? null) ?: $article['url'] }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Back --}}
                <div class="mt-10">
                    <a href="{{ route('monday-window') }}" class="inline-flex items-center gap-2 text-[#D4AF37] font-semibold hover:text-[#b8962e] transition">
                        <svg class="w-4 h-4 {{ $isArabic ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        {{ $backLabel }}
                    </a>
                </div>
            </main>

            {{-- Sidebar --}}
            @if($latestItems->isNotEmpty())
            <aside class="lg:w-80 shrink-0">
                <h3 class="text-lg font-bold text-gray-900 mb-4 {{ $alignmentClass }}">{{ $latestLabel }}</h3>
                <div class="space-y-4">
                    @foreach($latestItems as $item)
                    @php
                        $iTitle = $localize($item->title_en, $item->title_ar);
                        $iImg   = $item->featured_image ? asset('storage/' . $item->featured_image) : asset('design/images/blog.png');
                    @endphp
                    <a href="{{ route('monday-window.show', $item->slug) }}" class="flex gap-3 group">
                        <div class="w-20 h-16 shrink-0 rounded overflow-hidden">
                            <img loading="lazy" src="{{ $iImg }}" alt="{{ $iTitle }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform"/>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 group-hover:text-[#D4AF37] transition line-clamp-2 {{ $alignmentClass }}">{{ $iTitle }}</p>
                            @if($item->week_date)
                                <p class="text-xs text-gray-400 mt-1">{{ $item->week_date->format('d M Y') }}</p>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </aside>
            @endif
        </div>
    </div>
</section>


<style>
h1.article-title {
    font-size: 1.75rem !important;
    line-height: 1.4 !important;
    font-weight: 700 !important;
}
@media (min-width: 768px) {
    h1.article-title { font-size: 2rem !important; }
}
@media (min-width: 1024px) {
    h1.article-title { font-size: 2.25rem !important; }
}
</style>

@endsection

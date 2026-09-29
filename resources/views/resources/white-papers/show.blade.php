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

    $title           = $localize($whitePaper->title_en, $whitePaper->title_ar);
    $shortDesc       = $localize($whitePaper->short_description_en, $whitePaper->short_description_ar);
    $executiveSummary= $localize($whitePaper->executive_summary_en, $whitePaper->executive_summary_ar);
    $author          = $localize($whitePaper->author_en, $whitePaper->author_ar);
    $coverImage      = $whitePaper->cover_image   ? asset('storage/' . $whitePaper->cover_image)   : null;
    $featuredImage   = $whitePaper->featured_image ? asset('storage/' . $whitePaper->featured_image) : asset('design/images/blog.png');
    $heroImage       = $coverImage ?: $featuredImage;
    $heroImageAlt    = $localize($whitePaper->cover_image_alt_en, $whitePaper->cover_image_alt_ar) ?: $title;
    $breadcrumbSep   = $isArabic ? '<span class="text-gray-400 mx-2">/</span>' : '<span class="text-gray-400 mx-2">></span>';
    $homeLabel       = $localize($pageContent?->home_breadcrumb_label_en, $pageContent?->home_breadcrumb_label_ar) ?: ($isArabic ? 'الرئيسية' : 'Home');
    $listLabel       = $isArabic ? 'الأوراق البيضاء' : 'White Papers';
    $backLabel       = $localize($pageContent?->back_button_text_en, $pageContent?->back_button_text_ar) ?: ($isArabic ? 'العودة إلى الأوراق البيضاء' : 'Back to White Papers');
    $downloadLabel   = $isArabic ? 'تحميل PDF' : 'Download PDF';
    $latestLabel     = $localize($pageContent?->latest_section_title_en, $pageContent?->latest_section_title_ar) ?: ($isArabic ? 'أحدث الأوراق البيضاء' : 'LATEST WHITE PAPERS');
    $learnMoreLabel  = $localize($pageContent?->learn_more_label_en, $pageContent?->learn_more_label_ar) ?: ($isArabic ? 'اقرأ المزيد' : 'Read More');
@endphp

{{-- Breadcrumb --}}
<section class="bg-white pt-32 pb-4">
    <div class="container mx-auto px-4" dir="{{ $pageDirection }}">
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-[#D4AF37] transition-colors">{{ $homeLabel }}</a>
            {!! $breadcrumbSep !!}
            <a href="{{ route('white-papers') }}" class="text-gray-500 hover:text-[#D4AF37] transition-colors">{{ $listLabel }}</a>
            {!! $breadcrumbSep !!}
            <span class="text-[#20B2AA] font-medium">{{ Str::limit($title, 40) }}</span>
        </nav>
    </div>
</section>

{{-- Main Content --}}
<section class="container mx-auto bg-white pt-8" dir="{{ $pageDirection }}">
    <div class="px-4">
        <div
            class="rounded w-full h-[500px] bg-contain bg-center bg-no-repeat mb-6"
            style="background-image: url('{{ $heroImage }}');"
            role="img"
            aria-label="{{ $heroImageAlt }}"
        ></div>
    </div>
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-10 {{ $isArabic ? 'lg:flex-row-reverse' : '' }}">
            {{-- Main Article --}}
            <main class="flex-1 min-w-0">
                {{-- Topics --}}
                @if(!empty($whitePaper->topics))
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($whitePaper->topics as $topic)
                            <span class="text-xs bg-[#D4AF37]/10 text-[#b8962e] px-3 py-1 rounded-full">{{ $topic }}</span>
                        @endforeach
                    </div>
                @endif

                <h1 class="text-3xl md:text-4xl font-neue-extrabold text-gray-900 mb-4 {{ $alignmentClass }}">{{ $title }}</h1>

                {{-- Meta --}}
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-6 {{ $alignmentClass }}">
                    @if($author)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $author }}
                        </span>
                    @endif
                    @if($whitePaper->publication_date)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $whitePaper->publication_date->format('d M Y') }}
                        </span>
                    @endif
                </div>

                {{-- Short Description --}}
                @if($shortDesc)
                    <div class="text-lg text-gray-600 mb-8 leading-relaxed {{ $alignmentClass }}">{!! $shortDesc !!}</div>
                @endif

                {{-- PDF Download Button --}}
                @if($whitePaper->pdf_file)
                    <div class="my-8">
                        <a href="{{ asset('storage/' . $whitePaper->pdf_file) }}"
                           target="_blank"
                           download
                           class="inline-flex items-center gap-2 bg-[#D4AF37] text-white px-6 py-3 rounded font-semibold hover:bg-[#b8962e] transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            {{ $downloadLabel }}
                        </a>
                    </div>
                @endif

                {{-- Executive Summary --}}
                @if($executiveSummary)
                    <div class="prose prose-lg max-w-none {{ $alignmentClass }} mt-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $isArabic ? 'الملخص التنفيذي' : 'Executive Summary' }}</h2>
                        {!! $executiveSummary !!}
                    </div>
                @endif

                {{-- Tags --}}
                @if(!empty($whitePaper->tags))
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <p class="text-sm font-semibold text-gray-600 mb-2">{{ $isArabic ? 'الوسوم:' : 'Tags:' }}</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($whitePaper->tags as $tag)
                                <span class="text-xs bg-gray-100 text-gray-600 px-3 py-1 rounded-full">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Back Button --}}
                <div class="mt-10">
                    <a href="{{ route('white-papers') }}" class="inline-flex items-center gap-2 text-[#D4AF37] font-semibold hover:text-[#b8962e] transition">
                        <svg class="w-4 h-4 {{ $isArabic ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        {{ $backLabel }}
                    </a>
                </div>
            </main>

            {{-- Sidebar: Latest White Papers --}}
            @if($latestItems->isNotEmpty())
            <aside class="lg:w-80 shrink-0">
                <h3 class="text-lg font-bold text-gray-900 mb-4 {{ $alignmentClass }}">{{ $latestLabel }}</h3>
                <div class="space-y-4">
                    @foreach($latestItems as $item)
                    @php
                        $itemTitle = $localize($item->title_en, $item->title_ar);
                        $itemImage = $item->featured_image ? asset('storage/' . $item->featured_image) : asset('design/images/blog.png');
                        $itemAlt   = $localize($item->featured_image_alt_en, $item->featured_image_alt_ar) ?: $itemTitle;
                    @endphp
                    <a href="{{ route('white-papers.show', $item->slug) }}" class="flex gap-3 group">
                        <div class="w-20 h-16 shrink-0 rounded overflow-hidden">
                            <img src="{{ $itemImage }}" alt="{{ $itemAlt }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform"/>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 group-hover:text-[#D4AF37] transition line-clamp-2 {{ $alignmentClass }}">{{ $itemTitle }}</p>
                            @if($item->publication_date)
                                <p class="text-xs text-gray-400 mt-1">{{ $item->publication_date->format('M Y') }}</p>
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

@endsection

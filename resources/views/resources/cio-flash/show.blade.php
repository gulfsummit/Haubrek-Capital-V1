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

    $title          = $localize($episode->episode_title_en, $episode->episode_title_ar);
    $description    = $localize($episode->description_en, $episode->description_ar);
    $speaker        = $localize($episode->speaker_en, $episode->speaker_ar);
    $speakerPos     = $localize($episode->speaker_position_en, $episode->speaker_position_ar);
    $transcript     = $localize($episode->transcript_en, $episode->transcript_ar);
    $image          = $episode->featured_image ? asset('storage/' . $episode->featured_image) : asset('design/images/blog.png');
    $imageAlt       = $localize($episode->featured_image_alt_en, $episode->featured_image_alt_ar) ?: $title;
    $breadcrumbSep  = $isArabic ? '<span class="text-gray-400 mx-2">/</span>' : '<span class="text-gray-400 mx-2">></span>';
    $homeLabel      = $isArabic ? 'الرئيسية' : 'Home';
    $listLabel      = 'CIO Flash';
    $backLabel      = $isArabic ? 'العودة إلى CIO Flash' : 'Back to CIO Flash';
    $latestLabel    = $isArabic ? 'حلقات أخرى' : 'OTHER EPISODES';
    $learnMoreLabel = $isArabic ? 'استمع الآن' : 'Listen Now';
    $transcriptLabel= $isArabic ? 'نص الحلقة' : 'Episode Transcript';
@endphp

{{-- Breadcrumb --}}
<section class="bg-white pt-32 pb-4">
    <div class="container mx-auto px-4" dir="{{ $pageDirection }}">
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-[#D4AF37] transition-colors">{{ $homeLabel }}</a>
            {!! $breadcrumbSep !!}
            <a href="{{ route('cio-flash') }}" class="text-gray-500 hover:text-[#D4AF37] transition-colors">{{ $listLabel }}</a>
            {!! $breadcrumbSep !!}
            <span class="text-[#20B2AA] font-medium">{{ Str::limit($title, 40) }}</span>
        </nav>
    </div>
</section>

{{-- Main --}}
<section class="container mx-auto bg-white pt-8" dir="{{ $pageDirection }}">
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
                {{-- Episode badge --}}
                @if($episode->episode_number)
                    <span class="inline-block bg-[#D4AF37] text-white text-xs font-bold px-3 py-1 rounded mb-4">
                        {{ $isArabic ? 'الحلقة' : 'Episode' }} {{ $episode->episode_number }}
                    </span>
                @endif

                <h1 class="text-xl sm:text-2xl md:text-3xl font-neue-extrabold text-gray-900 mb-4 {{ $alignmentClass }}">{{ $title }}</h1>

                {{-- Speaker --}}
                @if($speaker)
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-[#D4AF37]/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">{{ $speaker }}</p>
                            @if($speakerPos) <p class="text-xs text-gray-500">{{ $speakerPos }}</p> @endif
                        </div>
                        @if($episode->duration)
                            <span class="ml-auto text-xs text-gray-400 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $episode->duration }}
                            </span>
                        @endif
                    </div>
                @endif

                {{-- Audio Player --}}
                @if($episode->audio_file)
                    <div class="bg-gray-50 rounded-xl p-5 mb-8 border border-gray-100">
                        <audio controls class="w-full" aria-label="{{ $title }}">
                            <source src="{{ asset('storage/' . $episode->audio_file) }}" type="audio/mpeg">
                            {{ $isArabic ? 'متصفحك لا يدعم مشغّل الصوت.' : 'Your browser does not support the audio element.' }}
                        </audio>
                    </div>
                @endif

                {{-- Description --}}
                @if($description)
                    <div class="text-gray-600 leading-relaxed mb-6 {{ $alignmentClass }}">{!! $description !!}</div>
                @endif

                {{-- Key Topics --}}
                @if(!empty($episode->key_topics))
                    <div class="my-6">
                        <p class="text-sm font-semibold text-gray-700 mb-2">{{ $isArabic ? 'المواضيع الرئيسية:' : 'Key Topics:' }}</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($episode->key_topics as $topic)
                                <span class="text-xs bg-[#D4AF37]/10 text-[#b8962e] px-3 py-1 rounded-full">{{ $topic }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Related Articles --}}
                @if(!empty($episode->related_articles))
                    <div class="my-8 p-5 bg-gray-50 rounded-lg border border-gray-100">
                        <h3 class="text-base font-bold text-gray-800 mb-3 {{ $alignmentClass }}">{{ $isArabic ? 'مقالات ذات صلة' : 'Related Articles' }}</h3>
                        <ul class="space-y-2">
                            @foreach($episode->related_articles as $article)
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

                {{-- Transcript --}}
                @if($transcript)
                    <div class="mt-10 pt-8 border-t border-gray-100">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 {{ $alignmentClass }}">{{ $transcriptLabel }}</h2>
                        <div class="prose prose-sm max-w-none text-gray-600 {{ $alignmentClass }}">{!! $transcript !!}</div>
                    </div>
                @endif

                {{-- Back --}}
                <div class="mt-10">
                    <a href="{{ route('cio-flash') }}" class="inline-flex items-center gap-2 text-[#D4AF37] font-semibold hover:text-[#b8962e] transition">
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
                        $iTitle = $localize($item->episode_title_en, $item->episode_title_ar);
                        $iImg   = $item->featured_image ? asset('storage/' . $item->featured_image) : asset('design/images/blog.png');
                    @endphp
                    <a href="{{ route('cio-flash.show', $item->slug) }}" class="flex gap-3 group">
                        <div class="w-20 h-16 shrink-0 rounded overflow-hidden relative">
                            <img loading="lazy" src="{{ $iImg }}" alt="{{ $iTitle }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform"/>
                            <div class="absolute inset-0 flex items-center justify-center bg-navy-900/20 group-hover:bg-navy-900/40 transition">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 group-hover:text-[#D4AF37] transition line-clamp-2 {{ $alignmentClass }}">{{ $iTitle }}</p>
                            @if($item->episode_number)
                                <p class="text-xs text-gray-400 mt-1">{{ $isArabic ? 'الحلقة' : 'Ep.' }} {{ $item->episode_number }}</p>
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

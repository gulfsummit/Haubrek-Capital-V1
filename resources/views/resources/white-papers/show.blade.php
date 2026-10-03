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
        <img
            src="{{ $heroImage }}"
            alt="{{ $heroImageAlt }}"
            class="rounded w-full object-cover mb-6 max-h-[500px] h-auto"
            loading="eager"
        />
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

                <h1 class="font-neue-extrabold text-gray-900 mb-4 {{ $alignmentClass }}" style="font-size: clamp(1rem, 2.5vw, 1.4rem); line-height: 1.3;">{{ $title }}</h1>

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

                {{-- PDF Download Button — at end of article, opens modal --}}
                @if($whitePaper->pdf_file)
                    <div class="mt-10 pt-6 border-t border-gray-100">
                        <p class="text-sm text-gray-500 mb-3 {{ $alignmentClass }}">
                            {{ $isArabic ? 'يُرجى ملء نموذج بسيط للوصول إلى هذا التقرير.' : 'Complete a short form to download this white paper.' }}
                        </p>
                        <button type="button" id="open-wp-download-modal"
                                class="inline-flex items-center gap-2 bg-[#D4AF37] text-white px-6 py-3 rounded font-semibold hover:bg-[#b8962e] transition text-base">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            {{ $downloadLabel }}
                        </button>
                    </div>
                @endif

                {{-- Back Button --}}
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
                            <img loading="lazy" src="{{ $itemImage }}" alt="{{ $itemAlt }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform"/>
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

@if($whitePaper->pdf_file)
{{-- ============================================================
     WHITE PAPER DOWNLOAD GATE MODAL
     PDF URL never in page source — only returned after form saved.
============================================================ --}}
<div id="wp-download-modal" role="dialog" aria-modal="true" aria-labelledby="wp-modal-title"
     class="fixed inset-0 z-50 hidden items-center justify-center p-4"
     dir="{{ $pageDirection }}">

    <div id="wp-modal-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

    <div class="relative w-full max-w-xl bg-white rounded-2xl shadow-2xl overflow-hidden max-h-[92vh] flex flex-col">

        {{-- ── FORM STATE ── --}}
        <div id="wp-modal-form-state" class="flex flex-col min-h-0">

            {{-- Gold accent bar --}}
            <div class="h-1 w-full bg-gradient-to-r from-[#D4AF37] to-[#b8962e] shrink-0"></div>

            {{-- Header --}}
            <div class="flex items-start justify-between gap-4 px-7 pt-6 pb-5 shrink-0">
                <div class="flex items-start gap-4">
                    <div class="shrink-0 w-11 h-11 rounded-xl bg-[#D4AF37]/10 flex items-center justify-center mt-0.5">
                        <svg class="w-5 h-5 text-[#b8962e]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 id="wp-modal-title" class="text-xl font-bold text-gray-900 leading-tight">
                            {{ $isArabic ? 'تحميل الورقة البيضاء' : 'Download White Paper' }}
                        </h2>
                        <p class="text-sm text-gray-500 mt-1.5 leading-relaxed">
                            {{ $isArabic ? 'يُرجى ملء النموذج أدناه للوصول إلى هذا التقرير.' : 'Please fill in the form below to access this white paper.' }}
                        </p>
                    </div>
                </div>
                <button type="button" id="close-wp-download-modal"
                        aria-label="{{ $isArabic ? 'إغلاق' : 'Close' }}"
                        class="shrink-0 w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="h-px bg-gray-100 mx-7 shrink-0"></div>

            {{-- Scrollable body --}}
            <div class="overflow-y-auto px-7 py-6 flex-1">
                {{-- Error box --}}
                <div id="wp-modal-errors" class="hidden bg-red-50 border border-red-200 rounded-xl p-4 mb-6 flex gap-3">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-red-700 mb-1">{{ $isArabic ? 'يُرجى تصحيح الأخطاء التالية:' : 'Please fix the following:' }}</p>
                        <ul id="wp-modal-error-list" class="text-sm text-red-600 space-y-0.5 list-disc list-inside"></ul>
                    </div>
                </div>

                <form id="wp-modal-form" action="{{ route('white-papers.download', $whitePaper->slug) }}" method="POST" novalidate>
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-5">

                        {{-- First Name * --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">{{ $isArabic ? 'الاسم الأول' : 'First Name' }} <span class="text-[#D4AF37]" aria-hidden="true">*</span></label>
                            <input type="text" name="first_name" autocomplete="given-name" required
                                   placeholder="{{ $isArabic ? 'أدخل اسمك الأول' : 'e.g. John' }}"
                                   class="wp-modal-field w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition"/>
                            <p class="wp-modal-field-error hidden text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <span></span>
                            </p>
                        </div>

                        {{-- Last Name * --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">{{ $isArabic ? 'اسم العائلة' : 'Last Name' }} <span class="text-[#D4AF37]" aria-hidden="true">*</span></label>
                            <input type="text" name="last_name" autocomplete="family-name" required
                                   placeholder="{{ $isArabic ? 'أدخل اسم العائلة' : 'e.g. Smith' }}"
                                   class="wp-modal-field w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition"/>
                            <p class="wp-modal-field-error hidden text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <span></span>
                            </p>
                        </div>

                        {{-- Email * --}}
                        <div class="sm:col-span-2 flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">{{ $isArabic ? 'البريد الإلكتروني' : 'Email' }} <span class="text-[#D4AF37]" aria-hidden="true">*</span></label>
                            <input type="email" name="business_email" autocomplete="email" required
                                   placeholder="{{ $isArabic ? 'example@company.com' : 'you@company.com' }}"
                                   class="wp-modal-field w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition"/>
                            <p class="wp-modal-field-error hidden text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <span></span>
                            </p>
                        </div>

                        {{-- Phone * --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">{{ $isArabic ? 'رقم الهاتف' : 'Phone Number' }} <span class="text-[#D4AF37]" aria-hidden="true">*</span></label>
                            <input type="tel" name="phone_number" autocomplete="tel" required
                                   placeholder="{{ $isArabic ? '+966 5X XXX XXXX' : '+1 555 000 0000' }}"
                                   class="wp-modal-field w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition"/>
                            <p class="wp-modal-field-error hidden text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <span></span>
                            </p>
                        </div>

                        {{-- Job Title * --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">{{ $isArabic ? 'المسمى الوظيفي' : 'Job Title' }} <span class="text-[#D4AF37]" aria-hidden="true">*</span></label>
                            <input type="text" name="job_title" autocomplete="organization-title" required
                                   placeholder="{{ $isArabic ? 'مثال: مدير مالي' : 'e.g. CFO, Analyst' }}"
                                   class="wp-modal-field w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition"/>
                            <p class="wp-modal-field-error hidden text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <span></span>
                            </p>
                        </div>

                        {{-- Company (optional) --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">
                                {{ $isArabic ? 'الشركة' : 'Company' }}
                                <span class="text-xs font-normal text-gray-400 ml-1">({{ $isArabic ? 'اختياري' : 'Optional' }})</span>
                            </label>
                            <input type="text" name="company" autocomplete="organization"
                                   placeholder="{{ $isArabic ? 'اسم الشركة' : 'Your company name' }}"
                                   class="w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition"/>
                        </div>

                        {{-- Country (optional) --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">
                                {{ $isArabic ? 'الدولة' : 'Country' }}
                                <span class="text-xs font-normal text-gray-400 ml-1">({{ $isArabic ? 'اختياري' : 'Optional' }})</span>
                            </label>
                            @php
                                $wpCountries = ['Afghanistan','Albania','Algeria','Andorra','Angola','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahrain','Bangladesh','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Canada','Chad','Chile','China','Colombia','Congo','Costa Rica','Croatia','Cuba','Cyprus','Czech Republic','Denmark','Dominican Republic','Ecuador','Egypt','El Salvador','Estonia','Ethiopia','Finland','France','Gabon','Gambia','Georgia','Germany','Ghana','Greece','Guatemala','Guinea','Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Ivory Coast','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Libya','Lithuania','Luxembourg','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Mauritania','Mauritius','Mexico','Moldova','Monaco','Mongolia','Morocco','Mozambique','Myanmar','Namibia','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','North Korea','Norway','Oman','Pakistan','Palestine','Panama','Paraguay','Peru','Philippines','Poland','Portugal','Qatar','Romania','Russia','Rwanda','Saudi Arabia','Senegal','Serbia','Sierra Leone','Singapore','Slovakia','Slovenia','Somalia','South Africa','South Korea','South Sudan','Spain','Sri Lanka','Sudan','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Togo','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe'];
                            @endphp
                            <select name="country"
                                    class="w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition">
                                <option value="">{{ $isArabic ? 'اختر الدولة' : 'Select your country' }}</option>
                                @foreach($wpCountries as $c)
                                    <option value="{{ $c }}">{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <div class="shrink-0 h-px bg-gray-100 mx-7"></div>
            <div class="shrink-0 px-7 py-4 flex items-center justify-between gap-4">
                <p class="text-xs text-gray-400"><span class="text-[#D4AF37] font-semibold">*</span> {{ $isArabic ? 'الحقول الإلزامية' : 'Required fields' }}</p>
                <button type="submit" form="wp-modal-form" id="wp-modal-submit"
                        class="inline-flex items-center gap-2 bg-[#D4AF37] text-white px-6 py-2.5 rounded-lg font-semibold text-sm hover:bg-[#b8962e] active:scale-95 transition disabled:opacity-60 disabled:cursor-not-allowed shadow-sm">
                    <span id="wp-modal-btn-label" class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        {{ $downloadLabel }}
                    </span>
                    <span id="wp-modal-spinner" class="hidden items-center gap-2">
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                        </svg>
                        {{ $isArabic ? 'جارٍ الإرسال...' : 'Submitting…' }}
                    </span>
                </button>
            </div>
        </div>{{-- /form state --}}

        {{-- ── SUCCESS STATE ── --}}
        <div id="wp-modal-success-state" class="hidden p-8 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $isArabic ? 'الملف جاهز للتحميل!' : 'Your file is ready!' }}</h3>
            <p class="text-sm text-gray-500 mb-6">{{ $isArabic ? 'سيبدأ التحميل تلقائياً. إذا لم يبدأ، انقر على الزر أدناه.' : 'Download should start automatically. If not, click below.' }}</p>
            <a id="wp-modal-manual-link" href="#" target="_blank" download
               class="inline-flex items-center gap-2 bg-[#D4AF37] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#b8962e] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                {{ $downloadLabel }}
            </a>
            <div class="mt-6">
                <button type="button" id="close-wp-modal-success" class="text-sm text-gray-400 hover:text-gray-600 transition">
                    {{ $isArabic ? 'إغلاق' : 'Close' }}
                </button>
            </div>
        </div>

    </div>{{-- /panel --}}
</div>{{-- /modal --}}

<script>
(() => {
    const modal        = document.getElementById('wp-download-modal');
    const backdrop     = document.getElementById('wp-modal-backdrop');
    const openBtn      = document.getElementById('open-wp-download-modal');
    const closeBtn     = document.getElementById('close-wp-download-modal');
    const closeBtnOk   = document.getElementById('close-wp-modal-success');
    const form         = document.getElementById('wp-modal-form');
    const submitBtn    = document.getElementById('wp-modal-submit');
    const btnLabel     = document.getElementById('wp-modal-btn-label');
    const spinner      = document.getElementById('wp-modal-spinner');
    const errorBox     = document.getElementById('wp-modal-errors');
    const errorList    = document.getElementById('wp-modal-error-list');
    const formState    = document.getElementById('wp-modal-form-state');
    const successState = document.getElementById('wp-modal-success-state');
    const manualLink   = document.getElementById('wp-modal-manual-link');

    if (!modal || !openBtn) return;

    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        const first = form.querySelector('input, select');
        if (first) setTimeout(() => first.focus(), 60);
    }
    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    closeBtnOk.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal(); });

    function clearErrors() {
        form.querySelectorAll('.wp-modal-field').forEach(el => el.classList.remove('border-red-400', '!bg-red-50'));
        form.querySelectorAll('.wp-modal-field-error').forEach(el => { el.querySelector('span').textContent = ''; el.classList.add('hidden'); });
        errorBox.classList.add('hidden');
        errorList.innerHTML = '';
    }

    function showErrors(errors) {
        const msgs = [];
        Object.entries(errors).forEach(([field, messages]) => {
            const msg = Array.isArray(messages) ? messages[0] : messages;
            msgs.push(msg);
            const input = form.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('border-red-400', '!bg-red-50');
                const errEl = input.closest('div')?.querySelector('.wp-modal-field-error');
                if (errEl) { errEl.querySelector('span').textContent = msg; errEl.classList.remove('hidden'); }
            }
        });
        errorList.innerHTML = msgs.map(m => `<li>${m}</li>`).join('');
        errorBox.classList.remove('hidden');
        errorBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function setSubmitting(on) {
        submitBtn.disabled = on;
        btnLabel.classList.toggle('hidden', on);
        btnLabel.classList.toggle('flex', !on);
        spinner.classList.toggle('hidden', !on);
        spinner.classList.toggle('flex', on);
    }

    form.addEventListener('submit', async e => {
        e.preventDefault();
        clearErrors();
        setSubmitting(true);

        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const headers  = { 'X-Requested-With': 'XMLHttpRequest' };
        if (csrfMeta) headers['X-CSRF-TOKEN'] = csrfMeta.getAttribute('content');

        try {
            const response = await fetch(form.action, { method: 'POST', headers, body: new FormData(form) });
            const json     = await response.json();

            if (!response.ok) {
                if (response.status === 422 && json.errors) showErrors(json.errors);
                else { errorList.innerHTML = `<li>{{ $isArabic ? 'حدث خطأ. يُرجى المحاولة مرة أخرى.' : 'An error occurred. Please try again.' }}</li>`; errorBox.classList.remove('hidden'); }
                setSubmitting(false);
                return;
            }

            if (json.pdf_url) {
                manualLink.href = json.pdf_url;
                const a = document.createElement('a');
                a.href = json.pdf_url; a.download = ''; a.target = '_blank';
                document.body.appendChild(a); a.click(); document.body.removeChild(a);
            }

            formState.classList.add('hidden');
            successState.classList.remove('hidden');

        } catch {
            errorList.innerHTML = `<li>{{ $isArabic ? 'تعذّر الاتصال بالخادم.' : 'Could not reach the server.' }}</li>`;
            errorBox.classList.remove('hidden');
            setSubmitting(false);
        }
    });

    form.querySelectorAll('.wp-modal-field').forEach(el => {
        el.addEventListener('input', () => {
            el.classList.remove('border-red-400', '!bg-red-50');
            const errEl = el.closest('div')?.querySelector('.wp-modal-field-error');
            if (errEl) { errEl.querySelector('span').textContent = ''; errEl.classList.add('hidden'); }
        });
    });
})();
</script>
@endif

@endsection

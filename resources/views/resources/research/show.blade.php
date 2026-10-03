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

    $title       = $localize($research->title_en, $research->title_ar);
    $description = $localize($research->short_description_en, $research->short_description_ar);
    $resType     = $localize($research->research_type_en, $research->research_type_ar);
    $author      = $localize($research->author_en, $research->author_ar);
    $image       = $research->cover_image ? asset('storage/' . $research->cover_image) : asset('design/images/blog.png');
    $imageAlt    = $localize($research->cover_image_alt_en, $research->cover_image_alt_ar) ?: $title;
    $breadcrumbSep = $isArabic ? '<span class="text-gray-400 mx-2">/</span>' : '<span class="text-gray-400 mx-2">></span>';
    $homeLabel   = $isArabic ? 'الرئيسية' : 'Home';
    $listLabel   = $isArabic ? 'الأبحاث' : 'Research';
    $backLabel   = $isArabic ? 'العودة إلى الأبحاث' : 'Back to Research';
    $latestLabel = $isArabic ? 'أبحاث أخرى' : 'OTHER RESEARCH';
    $downloadLabel = $isArabic ? 'تحميل التقرير' : 'Download Report';
    $downloadFormTitle = $isArabic ? 'تحميل تقرير البحث' : 'Download Research Report';
    $downloadFormSubtitle = $isArabic ? 'يُرجى ملء النموذج أدناه للوصول إلى تقرير البحث.' : 'Please fill in the form below to access the research report.';
    $countries = ['Afghanistan','Albania','Algeria','Andorra','Angola','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahrain','Bangladesh','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Canada','Chad','Chile','China','Colombia','Congo','Costa Rica','Croatia','Cuba','Cyprus','Czech Republic','Denmark','Dominican Republic','Ecuador','Egypt','El Salvador','Estonia','Ethiopia','Finland','France','Gabon','Gambia','Georgia','Germany','Ghana','Greece','Guatemala','Guinea','Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Ivory Coast','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Libya','Lithuania','Luxembourg','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Mauritania','Mauritius','Mexico','Moldova','Monaco','Mongolia','Morocco','Mozambique','Myanmar','Namibia','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','North Korea','Norway','Oman','Pakistan','Palestine','Panama','Paraguay','Peru','Philippines','Poland','Portugal','Qatar','Romania','Russia','Rwanda','Saudi Arabia','Senegal','Serbia','Sierra Leone','Singapore','Slovakia','Slovenia','Somalia','South Africa','South Korea','South Sudan','Spain','Sri Lanka','Sudan','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Togo','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe'];
@endphp

{{-- Breadcrumb --}}
<section class="bg-white pt-32 pb-4">
    <div class="container mx-auto px-4" dir="{{ $pageDirection }}">
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-[#D4AF37] transition-colors">{{ $homeLabel }}</a>
            {!! $breadcrumbSep !!}
            <a href="{{ route('research') }}" class="text-gray-500 hover:text-[#D4AF37] transition-colors">{{ $listLabel }}</a>
            {!! $breadcrumbSep !!}
            <span class="text-[#20B2AA] font-medium">{{ Str::limit($title, 40) }}</span>
        </nav>
    </div>
</section>

<section class="container mx-auto bg-white pt-8" dir="{{ $pageDirection }}">
    <div class="px-4">
        <div
            class="rounded w-full h-[500px] bg-contain bg-center bg-no-repeat mb-6"
            style="background-image: url('{{ $image }}');"
            role="img"
            aria-label="{{ $imageAlt }}"
        ></div>
    </div>
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-10 {{ $isArabic ? 'lg:flex-row-reverse' : '' }}">
            <main class="flex-1 min-w-0">
                @if($resType)
                    <span class="inline-block text-xs font-semibold text-[#b8962e] bg-[#D4AF37]/10 px-3 py-1 rounded mb-3">{{ $resType }}</span>
                @endif

                <h1 class="text-3xl md:text-4xl font-neue-extrabold text-gray-900 mb-4 {{ $alignmentClass }}">{{ $title }}</h1>

                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-6">
                    @if($author)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $author }}
                        </span>
                    @endif
                    @if($research->publication_date)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $research->publication_date->format('d M Y') }}
                        </span>
                    @endif
                </div>

                @if($description)
                    <div class="text-gray-600 leading-relaxed mb-8 {{ $alignmentClass }}">{{ $description }}</div>
                @endif

                @if(!empty($research->topics))
                    <div class="flex flex-wrap gap-2 mb-8">
                        @foreach($research->topics as $topic)
                            <span class="text-xs bg-[#D4AF37]/10 text-[#b8962e] px-3 py-1 rounded-full">{{ $topic }}</span>
                        @endforeach
                    </div>
                @endif

                {{-- Download Section — at end of article, always visible as an option --}}
                @if($research->pdf_file)
                    <div class="mt-10 pt-6 border-t border-gray-100">
                        @if(!$research->form_required)
                            <a href="{{ asset('storage/' . $research->pdf_file) }}" target="_blank" download
                               class="inline-flex items-center gap-2 bg-[#D4AF37] text-white px-6 py-3 rounded font-semibold hover:bg-[#b8962e] transition text-base">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ $downloadLabel }}
                            </a>
                        @else
                            <p class="text-sm text-gray-500 mb-3 {{ $alignmentClass }}">
                                {{ $isArabic ? 'يُرجى ملء نموذج بسيط للوصول إلى هذا التقرير.' : 'Complete a short form to download this report.' }}
                            </p>
                            <button type="button" id="open-download-modal"
                                    class="inline-flex items-center gap-2 bg-[#D4AF37] text-white px-6 py-3 rounded font-semibold hover:bg-[#b8962e] transition text-base">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ $downloadLabel }}
                            </button>
                        @endif
                    </div>
                @endif

                {{-- Back --}}
                <div class="mt-10">
                    <a href="{{ route('research') }}" class="inline-flex items-center gap-2 text-[#D4AF37] font-semibold hover:text-[#b8962e] transition">
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
                        $iImg   = $item->cover_image ? asset('storage/' . $item->cover_image) : asset('design/images/blog.png');
                        $iType  = $localize($item->research_type_en, $item->research_type_ar);
                    @endphp
                    <a href="{{ route('research.show', $item->slug) }}" class="flex gap-3 group">
                        <div class="w-20 h-16 shrink-0 rounded overflow-hidden">
                            <img loading="lazy" src="{{ $iImg }}" alt="{{ $iTitle }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform"/>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 group-hover:text-[#D4AF37] transition line-clamp-2 {{ $alignmentClass }}">{{ $iTitle }}</p>
                            @if($iType) <p class="text-xs text-gray-400 mt-1">{{ $iType }}</p> @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </aside>
            @endif
        </div>
    </div>
</section>

@if($research->pdf_file && $research->form_required)
{{-- ============================================================
     DOWNLOAD GATE MODAL
     Only rendered when form_required = true and a PDF exists.
     The PDF URL is never exposed in the page source — it only
     arrives in the AJAX success response after the form is saved.
============================================================ --}}
<div
    id="download-modal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="download-modal-title"
    class="fixed inset-0 z-50 hidden items-center justify-center p-4"
    dir="{{ $pageDirection }}"
>
    {{-- Backdrop --}}
    <div id="download-modal-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

    {{-- Panel --}}
    <div class="relative w-full max-w-xl bg-white rounded-2xl shadow-2xl overflow-hidden max-h-[92vh] flex flex-col">

        {{-- ── FORM STATE ── --}}
        <div id="download-modal-form-state" class="flex flex-col min-h-0">

            {{-- Gold accent top bar --}}
            <div class="h-1 w-full bg-gradient-to-r from-[#D4AF37] to-[#b8962e] shrink-0"></div>

            {{-- Header --}}
            <div class="flex items-start justify-between gap-4 px-7 pt-6 pb-5 shrink-0">
                <div class="flex items-start gap-4">
                    {{-- Icon --}}
                    <div class="shrink-0 w-11 h-11 rounded-xl bg-[#D4AF37]/10 flex items-center justify-center mt-0.5">
                        <svg class="w-5 h-5 text-[#b8962e]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 id="download-modal-title" class="text-xl font-bold text-gray-900 leading-tight">{{ $downloadFormTitle }}</h2>
                        <p class="text-sm text-gray-500 mt-1.5 leading-relaxed">{{ $downloadFormSubtitle }}</p>
                    </div>
                </div>
                <button type="button" id="close-download-modal" aria-label="{{ $isArabic ? 'إغلاق' : 'Close' }}"
                        class="shrink-0 w-8 h-8 flex items-center justify-center rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Divider --}}
            <div class="h-px bg-gray-100 mx-7 shrink-0"></div>

            {{-- Scrollable body --}}
            <div class="overflow-y-auto px-7 py-6 flex-1">
                {{-- Inline error box (shown on AJAX 422) --}}
                <div id="download-modal-errors" class="hidden bg-red-50 border border-red-200 rounded-xl p-4 mb-6 flex gap-3">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-red-700 mb-1">
                            {{ $isArabic ? 'يُرجى تصحيح الأخطاء التالية:' : 'Please fix the following:' }}
                        </p>
                        <ul id="download-modal-error-list" class="text-sm text-red-600 space-y-0.5 list-disc list-inside"></ul>
                    </div>
                </div>

                <form id="download-modal-form"
                      action="{{ route('research.download', $research->slug) }}"
                      method="POST"
                      novalidate>
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-5">

                        {{-- First Name --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">
                                {{ $isArabic ? 'الاسم الأول' : 'First Name' }}
                                <span class="text-[#D4AF37] ml-0.5" aria-hidden="true">*</span>
                            </label>
                            <input type="text" name="first_name" autocomplete="given-name" required
                                   placeholder="{{ $isArabic ? 'أدخل اسمك الأول' : 'e.g. John' }}"
                                   class="modal-field w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition"/>
                            <p class="modal-field-error hidden text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <span></span>
                            </p>
                        </div>

                        {{-- Last Name --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">
                                {{ $isArabic ? 'اسم العائلة' : 'Last Name' }}
                                <span class="text-[#D4AF37] ml-0.5" aria-hidden="true">*</span>
                            </label>
                            <input type="text" name="last_name" autocomplete="family-name" required
                                   placeholder="{{ $isArabic ? 'أدخل اسم العائلة' : 'e.g. Smith' }}"
                                   class="modal-field w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition"/>
                            <p class="modal-field-error hidden text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <span></span>
                            </p>
                        </div>

                        {{-- Business Email --}}
                        <div class="sm:col-span-2 flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">
                                {{ $isArabic ? 'البريد الإلكتروني' : 'Email' }}
                                <span class="text-[#D4AF37] ml-0.5" aria-hidden="true">*</span>
                            </label>
                            <input type="email" name="business_email" autocomplete="email" required
                                   placeholder="{{ $isArabic ? 'example@company.com' : 'you@company.com' }}"
                                   class="modal-field w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition"/>
                            <p class="modal-field-error hidden text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <span></span>
                            </p>
                        </div>

                        {{-- Phone Number — REQUIRED --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">
                                {{ $isArabic ? 'رقم الهاتف' : 'Phone Number' }}
                                <span class="text-[#D4AF37] ml-0.5" aria-hidden="true">*</span>
                            </label>
                            <input type="tel" name="phone_number" autocomplete="tel" required
                                   placeholder="{{ $isArabic ? '+966 5X XXX XXXX' : '+1 555 000 0000' }}"
                                   class="modal-field w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition"/>
                            <p class="modal-field-error hidden text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <span></span>
                            </p>
                        </div>

                        {{-- Job Title — REQUIRED --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">
                                {{ $isArabic ? 'المسمى الوظيفي' : 'Job Title' }}
                                <span class="text-[#D4AF37] ml-0.5" aria-hidden="true">*</span>
                            </label>
                            <input type="text" name="job_title" autocomplete="organization-title" required
                                   placeholder="{{ $isArabic ? 'مثال: مدير مالي' : 'e.g. CFO, Analyst' }}"
                                   class="modal-field w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition"/>
                            <p class="modal-field-error hidden text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                <span></span>
                            </p>
                        </div>

                        {{-- Company — OPTIONAL --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">
                                {{ $isArabic ? 'الشركة' : 'Company' }}
                                <span class="text-xs font-normal text-gray-400 ml-1">({{ $isArabic ? 'اختياري' : 'Optional' }})</span>
                            </label>
                            <input type="text" name="company" autocomplete="organization"
                                   placeholder="{{ $isArabic ? 'اسم الشركة' : 'Your company name' }}"
                                   class="w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition"/>
                        </div>

                        {{-- Country — OPTIONAL --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-semibold text-gray-700">
                                {{ $isArabic ? 'الدولة' : 'Country' }}
                                <span class="text-xs font-normal text-gray-400 ml-1">({{ $isArabic ? 'اختياري' : 'Optional' }})</span>
                            </label>
                            <select name="country"
                                    class="w-full border border-gray-200 bg-gray-50 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:bg-white focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 transition">
                                <option value="">{{ $isArabic ? 'اختر الدولة' : 'Select your country' }}</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <div class="shrink-0 h-px bg-gray-100 mx-7"></div>
            <div class="shrink-0 px-7 py-4 flex items-center justify-between gap-4">
                <p class="text-xs text-gray-400 leading-relaxed">
                    <span class="text-[#D4AF37] font-semibold">*</span>
                    {{ $isArabic ? 'الحقول الإلزامية' : 'Required fields' }}
                </p>
                <button
                    type="submit"
                    form="download-modal-form"
                    id="download-modal-submit"
                    class="inline-flex items-center gap-2 bg-[#D4AF37] text-white px-6 py-2.5 rounded-lg font-semibold text-sm hover:bg-[#b8962e] active:scale-95 transition disabled:opacity-60 disabled:cursor-not-allowed shadow-sm"
                >
                    <span id="download-modal-btn-label" class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        {{ $downloadLabel }}
                    </span>
                    <span id="download-modal-spinner" class="hidden items-center gap-2">
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                        </svg>
                        {{ $isArabic ? 'جارٍ الإرسال...' : 'Submitting…' }}
                    </span>
                </button>
            </div>
        </div>{{-- /form state --}}

        {{-- ── SUCCESS STATE (hidden until AJAX succeeds) ── --}}
        <div id="download-modal-success-state" class="hidden p-8 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">
                {{ $isArabic ? 'تقرير البحث جاهز!' : 'Your report is ready!' }}
            </h3>
            <p class="text-sm text-gray-500 mb-6">
                {{ $isArabic ? 'سيبدأ التحميل تلقائياً. إذا لم يبدأ، انقر على الزر أدناه.' : 'Your download should start automatically. If not, click below.' }}
            </p>
            <a id="download-modal-manual-link" href="#" target="_blank" download
               class="inline-flex items-center gap-2 bg-[#D4AF37] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#b8962e] transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                {{ $isArabic ? 'تحميل التقرير' : 'Download Report' }}
            </a>
            <div class="mt-6">
                <button type="button" id="close-download-modal-success"
                        class="text-sm text-gray-400 hover:text-gray-600 transition">
                    {{ $isArabic ? 'إغلاق' : 'Close' }}
                </button>
            </div>
        </div>{{-- /success state --}}

    </div>{{-- /panel --}}
</div>{{-- /modal --}}

<script>
(() => {
    const modal        = document.getElementById('download-modal');
    const backdrop     = document.getElementById('download-modal-backdrop');
    const openBtn      = document.getElementById('open-download-modal');
    const closeBtn     = document.getElementById('close-download-modal');
    const closeBtnOk   = document.getElementById('close-download-modal-success');
    const form         = document.getElementById('download-modal-form');
    const submitBtn    = document.getElementById('download-modal-submit');
    const btnLabel     = document.getElementById('download-modal-btn-label');
    const spinner      = document.getElementById('download-modal-spinner');
    const errorBox     = document.getElementById('download-modal-errors');
    const errorList    = document.getElementById('download-modal-error-list');
    const formState    = document.getElementById('download-modal-form-state');
    const successState = document.getElementById('download-modal-success-state');
    const manualLink   = document.getElementById('download-modal-manual-link');

    if (!modal || !openBtn) return;

    // ── open / close ────────────────────────────────────────────
    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        // Focus first input
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

    // ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
    });

    // ── field-level error helpers ────────────────────────────────
    function clearFieldErrors() {
        form.querySelectorAll('.modal-field').forEach(el => {
            el.classList.remove('border-red-400', '!bg-red-50');
        });
        form.querySelectorAll('.modal-field-error').forEach(el => {
            const span = el.querySelector('span') || el;
            span.textContent = '';
            el.classList.add('hidden');
        });
        errorBox.classList.add('hidden');
        errorList.innerHTML = '';
    }

    function showFieldErrors(errors) {
        const allMessages = [];

        Object.entries(errors).forEach(([field, messages]) => {
            const msg = Array.isArray(messages) ? messages[0] : messages;
            allMessages.push(msg);

            const input = form.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('border-red-400', '!bg-red-50');
                const errEl = input.closest('div')?.querySelector('.modal-field-error');
                if (errEl) {
                    const span = errEl.querySelector('span') || errEl;
                    span.textContent = msg;
                    errEl.classList.remove('hidden');
                }
            }
        });

        errorList.innerHTML = allMessages.map(m => `<li>${m}</li>`).join('');
        errorBox.classList.remove('hidden');
        errorBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    // ── submitting state helpers ─────────────────────────────────
    function setSubmitting(on) {
        submitBtn.disabled = on;
        btnLabel.classList.toggle('hidden', on);
        btnLabel.classList.toggle('flex', !on);
        spinner.classList.toggle('hidden', !on);
        spinner.classList.toggle('flex', on);
    }

    // ── AJAX submit ──────────────────────────────────────────────
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        clearFieldErrors();
        setSubmitting(true);

        const data     = new FormData(form);
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const headers  = { 'X-Requested-With': 'XMLHttpRequest' };
        if (csrfMeta) headers['X-CSRF-TOKEN'] = csrfMeta.getAttribute('content');

        try {
            const response = await fetch(form.action, {
                method:  'POST',
                headers: headers,
                body:    data,
            });

            const json = await response.json();

            if (!response.ok) {
                // 422 validation errors
                if (response.status === 422 && json.errors) {
                    showFieldErrors(json.errors);
                } else {
                    // Unexpected server error
                    errorList.innerHTML = `<li>{{ $isArabic ? 'حدث خطأ. يُرجى المحاولة مرة أخرى.' : 'An error occurred. Please try again.' }}</li>`;
                    errorBox.classList.remove('hidden');
                }
                setSubmitting(false);
                return;
            }

            // ── success ──────────────────────────────────────────
            if (json.pdf_url) {
                manualLink.href = json.pdf_url;

                // Trigger automatic download via a temporary anchor
                const a = document.createElement('a');
                a.href     = json.pdf_url;
                a.download = '';
                a.target   = '_blank';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            }

            // Swap to success state
            formState.classList.add('hidden');
            successState.classList.remove('hidden');

        } catch (err) {
            errorList.innerHTML = `<li>{{ $isArabic ? 'تعذّر الاتصال بالخادم.' : 'Could not reach the server.' }}</li>`;
            errorBox.classList.remove('hidden');
            setSubmitting(false);
        }
    });

    // Clear field errors when user starts typing again
    form.querySelectorAll('.modal-field').forEach(el => {
        el.addEventListener('input', () => {
            el.classList.remove('border-red-400', '!bg-red-50');
            const errEl = el.closest('div')?.querySelector('.modal-field-error');
            if (errEl) {
                const span = errEl.querySelector('span') || errEl;
                span.textContent = '';
                errEl.classList.add('hidden');
            }
        });
    });
})();
</script>
@endif

@endsection

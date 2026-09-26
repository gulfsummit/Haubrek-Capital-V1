@extends('app')

@section('content')
@php
    $locale = app()->getLocale();
    $isArabic = $locale === 'ar';
    $localize = $localize ?? function ($en, $ar) use ($locale) {
        return $locale === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
    };
    $pageDirection  = $isArabic ? 'rtl' : 'ltr';
    $alignmentClass = $isArabic ? 'text-center' : 'text-center';

    $title       = $localize($research->title_en, $research->title_ar);
    $pdfUrl      = $research->pdf_file ? asset('storage/' . $research->pdf_file) : null;
    $image       = $research->cover_image ? asset('storage/' . $research->cover_image) : asset('design/images/blog.png');
    $imageAlt    = $localize($research->cover_image_alt_en, $research->cover_image_alt_ar) ?: $title;
@endphp

{{-- Thank You Section --}}
<section class="min-h-screen bg-gray-50 flex items-center justify-center py-20" dir="{{ $pageDirection }}">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-10 text-center">
            {{-- Success Icon --}}
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h1 class="text-3xl font-neue-extrabold text-gray-900 mb-3">
                {{ $isArabic ? 'تقرير البحث جاهز' : 'Your research report is ready.' }}
            </h1>

            <p class="text-gray-500 text-base mb-2">
                {{ $isArabic ? 'شكراً لاهتمامك بـ' : 'Thank you for your interest in' }}
            </p>
            <p class="text-lg font-semibold text-gray-800 mb-8">{{ $title }}</p>

            {{-- Cover Image --}}
            <div class="w-40 mx-auto mb-8 rounded-lg overflow-hidden shadow">
                <img src="{{ $image }}" alt="{{ $imageAlt }}" class="w-full h-auto"/>
            </div>

            {{-- Download Button --}}
            @if($pdfUrl)
                <a href="{{ $pdfUrl }}" target="_blank" download
                   class="inline-flex items-center gap-3 bg-[#D4AF37] text-white px-8 py-4 rounded-lg font-semibold text-base hover:bg-[#b8962e] transition shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    {{ $isArabic ? 'تحميل التقرير' : 'Download Report' }}
                </a>
            @endif

            {{-- Navigation Links --}}
            <div class="mt-10 pt-8 border-t border-gray-100 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('research') }}" class="text-sm text-[#D4AF37] font-semibold hover:text-[#b8962e] transition">
                    {{ $isArabic ? 'العودة إلى الأبحاث' : '← Back to Research' }}
                </a>
                <span class="hidden sm:block text-gray-300">|</span>
                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">
                    {{ $isArabic ? 'الصفحة الرئيسية' : 'Go to Homepage' }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

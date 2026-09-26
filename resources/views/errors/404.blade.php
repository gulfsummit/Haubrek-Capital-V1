@extends('app')

@section('content')
@php
    $isArabic = app()->getLocale() === 'ar';
    $title = $isArabic ? 'الصفحة غير موجودة' : 'Page Not Found';
    $description = $isArabic
        ? 'عذراً، الرابط الذي طلبته غير موجود أو تم نقله.'
        : 'The page you requested does not exist or has been moved.';
    $homeLabel = $isArabic ? 'العودة إلى الرئيسية' : 'Back to Home';
    $contactLabel = $isArabic ? 'اتصل بنا' : 'Contact Us';
@endphp

<section class="min-h-screen bg-[#041B44] text-white flex items-center justify-center px-6 py-24">
    <div class="max-w-2xl text-center">
        <p class="text-[#D4AF37] font-neue-extrabold text-[5rem] leading-none mb-6">404</p>
        <h1 class="text-[2.25rem] md:text-[3.5rem] font-neue-extrabold mb-6">{{ $title }}</h1>
        <p class="text-white/75 mb-10">{{ $description }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="inline-block bg-[#D4AF37] text-white px-8 py-4 rounded-md font-neue-extrabold">
                {{ $homeLabel }}
            </a>
            <a href="{{ route('contact-us') }}" class="inline-block border border-white text-white px-8 py-4 rounded-md font-neue-extrabold">
                {{ $contactLabel }}
            </a>
        </div>
    </div>
</section>
@endsection

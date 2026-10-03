@extends('app')

@section('content')
<x-page-background pageName="cookie-policy">
    @php
        $page = $cookiePolicy ?? new \App\Models\CookiePolicy();
        $locale = app()->getLocale();
        $pageTitle = $locale === 'ar' ? ($page->title_ar ?? 'سياسة ملفات تعريف الارتباط') : ($page->title_en ?? 'Cookie Policy');
        $pageContent = $locale === 'ar' ? ($page->content_ar ?? '') : ($page->content_en ?? '');
        
        // Default images if not set
        $defaultDesktopImage = asset('design/images/governance-innerpage-pg.png');
        $defaultMobileImage = asset('design/images/mobile-governance-innerpage-pg.png');
        
        // Get hero images or use defaults
        $heroDesktopImage = $page->hero_desktop_image 
            ? (file_exists(storage_path('app/public/' . $page->hero_desktop_image)) 
                ? asset('storage/' . $page->hero_desktop_image) 
                : $defaultDesktopImage)
            : $defaultDesktopImage;
            
        $heroMobileImage = $page->hero_mobile_image 
            ? (file_exists(storage_path('app/public/' . $page->hero_mobile_image)) 
                ? asset('storage/' . $page->hero_mobile_image) 
                : $defaultMobileImage)
            : $defaultMobileImage;
    @endphp

    <!-- Hero Section -->
    <section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
        <div class="relative overflow-hidden h-full">
            <div class="flex flex-col h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full">
                    <div class="w-full flex-shrink-0 relative">
                        <!-- Desktop background -->
                        <div class="absolute inset-0 hidden md:block">
                            <img loading="lazy" src="{{ $heroDesktopImage }}" alt="{{ $pageTitle }}" class="w-full h-full object-cover"/>
                        </div>
                        <!-- Mobile background -->
                        <div class="absolute inset-0 block md:hidden">
                            <img loading="lazy" src="{{ $heroMobileImage }}" alt="{{ $pageTitle }} Mobile" class="w-full h-full object-cover"/>
                        </div>
                        <div class="absolute inset-0"></div>
                        <div class="relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                            <div class="container mx-auto text-center px-4">
                                <h1 class="text-[45px] xl:text-[78px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">{{ $pageTitle }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb Navigation -->
    <section class="bg-white pt-8 pb-4">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-[#D4AF37] transition-colors">
                    {{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}
                </a>
                <span class="text-gray-400">></span>
                <span class="text-[#20B2AA] font-medium">{{ $pageTitle }}</span>
            </nav>
        </div>
    </section>

    <!-- Main Content Area -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                
                <!-- Page Content -->
                <div class="prose prose-lg max-w-none text-[#041B44] font-['Poppins'] text-[16px] leading-relaxed legal-content">
                    {!! $pageContent !!}
                </div>
                
                <!-- Last Updated -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <p class="text-sm text-gray-500">
                        {{ app()->getLocale() === 'ar' ? 'آخر تحديث:' : 'Last Updated:' }} 
                        {{ $page->updated_at ? $page->updated_at->format('F j, Y') : date('F j, Y') }}
                    </p>
                </div>
                
                <!-- Back to Home Button -->
                <div class="mt-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center bg-[#D4AF37] text-white px-8 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] hover:bg-[#B8941F] transition-colors">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-2 rotate-180' : 'mr-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ app()->getLocale() === 'ar' ? 'العودة للرئيسية' : 'Back to Home' }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-page-background>

<style>
.legal-content ul,
.legal-content ol {
    margin: 1.5rem 0;
    padding-left: 2rem;
}

.legal-content ul li {
    list-style-type: disc;
    margin: 0.5rem 0;
    padding-left: 0.5rem;
}

.legal-content ol li {
    list-style-type: decimal;
    margin: 0.5rem 0;
    padding-left: 0.5rem;
}

.legal-content ul ul li {
    list-style-type: circle;
}

.legal-content ul ul ul li {
    list-style-type: square;
}

.legal-content h1,
.legal-content h2,
.legal-content h3 {
    color: #041B44;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.legal-content h1 {
    font-size: 2rem;
}

.legal-content h2 {
    font-size: 1.5rem;
}

.legal-content h3 {
    font-size: 1.25rem;
}

.legal-content p {
    margin: 1rem 0;
    line-height: 1.7;
}

.legal-content a {
    color: #D4AF37;
    text-decoration: underline;
}

.legal-content a:hover {
    color: #B8941F;
}

.legal-content blockquote {
    border-left: 4px solid #D4AF37;
    background-color: #F8F9FA;
    padding: 1rem 1.5rem;
    margin: 1.5rem 0;
    font-style: italic;
}

.legal-content strong {
    font-weight: 700;
}

.legal-content em {
    font-style: italic;
}
</style>
@endsection


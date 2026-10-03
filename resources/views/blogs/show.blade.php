@extends('app')

@section('content')
@php
    $locale = app()->getLocale();
    $isArabic = $locale === 'ar';
    $localize = $localize ?? function ($en, $ar) use ($locale) {
        return $locale === 'ar'
            ? ($ar ?: $en)
            : ($en ?: $ar);
    };
    $pageDirection = $isArabic ? 'rtl' : 'ltr';
    $containerDirectionClass = $isArabic ? 'rtl' : 'ltr';
    $alignmentClass = $isArabic ? 'text-right md:text-right' : 'text-left md:text-left';
    $reverseFlexClass = $isArabic ? 'flex-row-reverse' : '';
    $breadcrumbSeparator = $isArabic ? '<span class="text-gray-400 mx-2">/</span>' : '<span class="text-gray-400">></span>';
    $normalizeLink = function ($url) {
        if (empty($url)) {
            return '#';
        }

        if (\Illuminate\Support\Str::startsWith($url, ['http://', 'https://', 'mailto:', 'tel:', '#'])) {
            return $url;
        }

        return url($url);
    };
    $homeLabel = $localize($pageContent?->home_breadcrumb_label_en, $pageContent?->home_breadcrumb_label_ar) ?: ($isArabic ? 'الرئيسية' : 'Home');
    $blogLabel = $localize($pageContent?->listing_breadcrumb_label_en, $pageContent?->listing_breadcrumb_label_ar) ?: ($isArabic ? 'المدونة' : 'Blogs');
    $shareLabel = $localize($pageContent?->share_label_en, $pageContent?->share_label_ar) ?: ($isArabic ? 'شارك' : 'Share');
    $backLabel = $localize($pageContent?->back_button_text_en, $pageContent?->back_button_text_ar) ?: ($isArabic ? 'العودة إلى المدونة' : 'Back to Blog');
    $searchLabel = $localize($pageContent?->search_title_en, $pageContent?->search_title_ar) ?: ($isArabic ? 'بحث' : 'Search');
    $searchPlaceholder = $localize($pageContent?->search_placeholder_en, $pageContent?->search_placeholder_ar) ?: ($isArabic ? 'كلمة البحث' : 'Search term');
    $searchButtonLabel = $localize($pageContent?->search_button_text_en, $pageContent?->search_button_text_ar) ?: ($isArabic ? 'بحث' : 'Search');
    $servicesLabel = $localize($pageContent?->services_title_en, $pageContent?->services_title_ar) ?: ($isArabic ? 'خدماتنا' : 'Services');
    $serviceLinks = $pageContent?->service_links ?: [
        ['url' => route('governance-services'), 'label_en' => 'Governance Advisory', 'label_ar' => 'الاستشارات الحوكمية'],
        ['url' => route('wealth-services'), 'label_en' => 'Wealth Planning', 'label_ar' => 'تخطيط الثروات'],
        ['url' => route('investment-services'), 'label_en' => 'Investment Advisory', 'label_ar' => 'الاستشارات الاستثمارية'],
        ['url' => route('cio-services'), 'label_en' => 'CIO Office Services', 'label_ar' => 'خدمات مكتب الاستثمار الرئيسي'],
    ];
    $subscribeLabel = $localize($pageContent?->subscribe_title_en, $pageContent?->subscribe_title_ar) ?: ($isArabic ? 'اشترك' : 'Subscribe');
    $subscribeButtonLabel = $localize($pageContent?->subscribe_button_text_en, $pageContent?->subscribe_button_text_ar) ?: ($isArabic ? 'اشترك' : 'Subscribe');
    $categoriesLabel = $localize($pageContent?->categories_title_en, $pageContent?->categories_title_ar) ?: ($isArabic ? 'التصنيفات' : 'Categories');
    $allPostsLabel = $localize($pageContent?->all_categories_label_en, $pageContent?->all_categories_label_ar) ?: ($isArabic ? 'جميع المقالات' : 'All Posts');
    $latestTopicsLabel = $localize($pageContent?->latest_section_title_en, $pageContent?->latest_section_title_ar) ?: ($isArabic ? 'أحدث المواضيع' : 'LATEST TOPICS');
    $learnMoreLabel = $localize($pageContent?->learn_more_label_en, $pageContent?->learn_more_label_ar) ?: ($isArabic ? 'اطلع على المزيد...' : 'Learn More...');
    $backIconClasses = $isArabic ? 'w-5 h-5 ml-2 transform rotate-180' : 'w-5 h-5 mr-2';
@endphp
<!-- Breadcrumb Navigation -->
<section class="bg-white pt-32 pb-4">
    <div class="container mx-auto px-4" dir="{{ $pageDirection }}">
        <nav class="flex items-center {{ $reverseFlexClass }} gap-2 text-sm {{ $containerDirectionClass }}">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-[#D4AF37] transition-colors {{ $alignmentClass }}">{{ $homeLabel }}</a>
            {!! $breadcrumbSeparator !!}
            <a href="{{ route('blog') }}" class="text-gray-500 hover:text-[#D4AF37] transition-colors {{ $alignmentClass }}">{{ $blogLabel }}</a>
            {!! $breadcrumbSeparator !!}
            <span class="text-[#20B2AA] font-medium {{ $alignmentClass }}">{{ Str::limit($localize($blog->title_en ?? null, $blog->title_ar ?? null) ?? $blog->title, 30) }}</span>
        </nav>
    </div>
</section>

<!-- Main Content Area -->
<section class="container mx-auto bg-white pt-8" dir="{{ $pageDirection }}">
    @php
        $featuredAlt = $localize($blog->featured_image_alt_en ?? null, $blog->featured_image_alt_ar ?? null) ?? strip_tags($blog->title);
        $pageH1 = isset($seoMeta) ? ($localize($seoMeta->h1_en ?? null, $seoMeta->h1_ar ?? null) ?? strip_tags($blog->title)) : strip_tags($blog->title);
        $heroImage = $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('design/images/articles-inner-hero.png');
        $heroImageAlt = $blog->featured_image ? $featuredAlt : $blog->title;
    @endphp
    <div class="px-4">
        <img
            src="{{ $heroImage }}"
            alt="{{ $heroImageAlt }}"
            class="rounded w-full object-cover mb-6 max-h-[500px] h-auto"
            loading="eager"
        />
    </div>
    
    <div class="container mx-auto px-4 flex flex-col lg:flex-row gap-8 {{ $reverseFlexClass }}">
        <!-- Article Content -->
        <div class="w-full lg:w-8/12">
            <div class="text-[25px] text-[#041B44] leading-[74px] font-['Poppins'] {{ $alignmentClass }}">
                {{ $blog->created_at->translatedFormat($isArabic ? 'j F Y' : 'F j, Y') }}
            </div>
            <h1 class="text-sm sm:text-base md:text-lg lg:text-xl leading-[1.3] font-['Poppins'] font-bold text-[#041B44] mb-8 {{ $alignmentClass }}">{{ $pageH1 }}</h1>
            <div class="prose max-w-none text-gray-800 mb-8 {{ $alignmentClass }}" dir="{{ $pageDirection }}">
                <div class="text-[#041B44] font-['Poppins'] text-[15px] leading-relaxed">{!! $localize($blog->content_en ?? null, $blog->content_ar ?? null) ?? $blog->content !!}</div>
            </div>
            
            <!-- Share Buttons -->
            @php
                $currentUrl = urlencode(url()->current());
                $blogTitle = urlencode(strip_tags($blog->title));
            @endphp
            <div class="flex flex-col lg:items-center items-center text-center gap-4 py-24 {{ $isArabic ? 'lg:flex-row-reverse' : '' }}">
                <span class="text-[#D4AF37] font-semibold lg:mx-12 mb-2 {{ $alignmentClass }}">{{ $shareLabel }}</span>
                <div class="flex gap-4 {{ $reverseFlexClass }}">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}" target="_blank" rel="noopener noreferrer" class="text-[#041B44] hover:text-[#D4AF37] transition-colors" title="{{ $isArabic ? 'شارك على فيسبوك' : 'Share on Facebook' }}">
                        <img loading="lazy" src="{{ asset('design/images/blue-fb.svg') }}" class="w-8 h-8 inline" alt="Facebook icon">
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ $currentUrl }}&text={{ $blogTitle }}" target="_blank" rel="noopener noreferrer" class="text-[#041B44] hover:text-[#D4AF37] transition-colors" title="{{ $isArabic ? 'شارك على إكس (تويتر)' : 'Share on X (Twitter)' }}">
                        <img loading="lazy" src="{{ asset('design/images/blue-x.svg') }}" class="w-8 h-8 inline" alt="X (Twitter) icon">
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $currentUrl }}" target="_blank" rel="noopener noreferrer" class="text-[#041B44] hover:text-[#D4AF37] transition-colors" title="{{ $isArabic ? 'شارك على لينكدإن' : 'Share on LinkedIn' }}">
                        <img loading="lazy" src="{{ asset('design/images/blue-in.svg') }}" class="w-8 h-8 inline" alt="LinkedIn icon">
                    </a>
                </div>
            </div>
            
            <!-- Back to Blog -->
            <div class="mb-8 {{ $alignmentClass }}">
                <a href="{{ route('blog') }}" class="inline-flex items-center bg-[#D4AF37] text-white px-8 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] hover:bg-[#B8941F] transition-colors {{ $isArabic ? 'flex-row-reverse' : '' }}">
                    <svg class="{{ $backIconClasses }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ $backLabel }}
                </a>
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="w-full lg:w-4/12 flex flex-col gap-8 {{ $reverseFlexClass }}" dir="{{ $pageDirection }}">
            <!-- Search -->
            <div class="bg-white rounded-lg shadow p-6 mb-4">
                <h3 class="font-neue-bold text-lg mb-4 {{ $alignmentClass }}">{{ $searchLabel }}</h3>
                <form class="flex {{ $reverseFlexClass }}" action="{{ route('blog') }}" method="GET">
                    <input type="text" name="search" placeholder="{{ $searchPlaceholder }}" class="flex-1 border border-gray-300 {{ $isArabic ? 'rounded-r' : 'rounded-l' }} px-3 py-2 focus:outline-none {{ $alignmentClass }}" value="{{ request('search') }}">
                    <button type="submit" class="bg-[#D4AF37] text-white px-4 py-2 {{ $isArabic ? 'rounded-l' : 'rounded-r' }}">{{ $searchButtonLabel }}</button>
                </form>
            </div>
            
            <!-- Services -->
            <div class="bg-white rounded-lg shadow p-6 mb-4">
                <h3 class="font-neue-bold text-lg mb-4 {{ $alignmentClass }}">{{ $servicesLabel }}</h3>
                <ul class="flex flex-col gap-2">
                    @foreach($serviceLinks as $service)
                        @php
                            $serviceLabel = $isArabic ? ($service['label_ar'] ?? $service['label_en']) : $service['label_en'];
                        @endphp
                        <li>
                            <a href="{{ $normalizeLink($service['url'] ?? '#') }}" class="w-full bg-gray-100 rounded px-3 py-2 block hover:bg-[#D4AF37] hover:text-white transition-colors {{ $alignmentClass }}">
                                {{ $serviceLabel }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Subscribe -->
            <div class="bg-white rounded-lg shadow p-6 mb-4">
                <h3 class="font-neue-bold text-lg mb-4 {{ $alignmentClass }}">{{ $subscribeLabel }}</h3>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('popup') }}" class="bg-[#D4AF37] text-white px-4 py-2 rounded text-center">
                        {{ $subscribeButtonLabel }}
                    </a>
                </div>
            </div>
            
            <!-- Categories -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-neue-bold text-lg mb-4 {{ $alignmentClass }}">{{ $categoriesLabel }}</h3>
                <ul class="flex flex-col gap-2">
                    <li>
                        <a href="{{ route('blog', ['category' => 'all']) }}" class="w-full bg-gray-100 rounded px-3 py-2 block hover:bg-[#D4AF37] hover:text-white transition-colors {{ $alignmentClass }}">
                            {{ $allPostsLabel }}
                        </a>
                    </li>
                    @foreach($categories as $category)
                        @php
                            $categoryLabel = $localize($category['label_en'] ?? null, $category['label_ar'] ?? null) ?? $category['label'];
                        @endphp
                        <li>
                            <a href="{{ route('blog', ['category' => $category['slug']]) }}" class="w-full bg-gray-100 rounded px-3 py-2 block hover:bg-[#D4AF37] hover:text-white transition-colors {{ $alignmentClass }}">
                                {{ $categoryLabel }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>
    
    <!-- Latest Topics -->
    @if($latestBlogs->count() > 0)
        <h2 class="text-[48px] leading-[62px] font-neue-extrabold mb-6 mt-16 {{ $alignmentClass }}">{{ $latestTopicsLabel }}</h2>
        <div class="grid md:grid-cols-3 pb-24 gap-6 {{ $isArabic ? 'rtl' : '' }}">
            @foreach($latestBlogs as $latestBlog)
                @php
                    $latestTitle = $localize($latestBlog->title_en ?? null, $latestBlog->title_ar ?? null) ?? $latestBlog->title;
                    $latestThumbnailAlt = $localize($latestBlog->thumbnail_image_alt_en ?? null, $latestBlog->thumbnail_image_alt_ar ?? null) ?? $latestTitle;
                    $latestFeaturedAlt = $localize($latestBlog->featured_image_alt_en ?? null, $latestBlog->featured_image_alt_ar ?? null) ?? $latestTitle;
                    $latestDescription = $localize($latestBlog->description_en ?? null, $latestBlog->description_ar ?? null) ?? $latestBlog->description;
                    $latestButtonLabel = $localize($latestBlog->button_text_en ?? null, $latestBlog->button_text_ar ?? null) ?: $learnMoreLabel;
                    $latestImage = $latestBlog->thumbnail_image
                        ? asset('storage/' . $latestBlog->thumbnail_image)
                        : ($latestBlog->featured_image ? asset('storage/' . $latestBlog->featured_image) : asset('design/images/blog.png'));
                    $latestImageAlt = $latestBlog->thumbnail_image ? $latestThumbnailAlt : ($latestBlog->featured_image ? $latestFeaturedAlt : $latestTitle);
                @endphp
                <div class="bg-white rounded-lg shadow p-4 flex flex-col overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div
                        class="w-full h-48 sm:h-56 md:h-64 bg-contain bg-center bg-no-repeat"
                        style="background-image: url('{{ $latestImage }}');"
                        role="img"
                        aria-label="{{ $latestImageAlt }}"
                    ></div>
                    <div class="lg:pt-4">
                        <div class="text-[14px] sm:text-[15px] font-['Poppins'] text-[#041B44] mb-3 sm:mb-4 {{ $alignmentClass }}">
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($latestDescription), 100) }}</p>
                        </div>
                        <a href="{{ route('blog.show', $latestBlog->slug) }}" class="text-[#D4AF37] text-[14px] sm:text-[15.07px] font-['Poppins'] font-regular hover:underline {{ $alignmentClass }}">{{ $latestButtonLabel }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
<!-- End Main Content Area -->

<style>
.prose {
    color: #041B44;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #041B44;
    font-family: 'Neue Haas Grotesk Display', sans-serif;
    font-weight: 700;
}

.prose p {
    color: #041B44;
    font-family: 'Poppins', sans-serif;
    line-height: 1.7;
}

.prose a {
    color: #D4AF37;
    text-decoration: underline;
}

.prose a:hover {
    color: #B8941F;
}

.prose ul, .prose ol {
    color: #041B44;
}

.prose li {
    color: #041B44;
    font-family: 'Poppins', sans-serif;
}

.prose blockquote {
    border-left: 4px solid #D4AF37;
    background-color: #F8F9FA;
    padding: 1rem 1.5rem;
    margin: 1.5rem 0;
    font-style: italic;
}

.prose img {
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>

<script src="{{ asset('design/js/index.js') }}"></script>
@endsection
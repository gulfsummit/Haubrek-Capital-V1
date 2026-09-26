@extends('app')

@section('content')
@php
    $localize = $localize ?? function ($en, $ar) {
        return app()->getLocale() === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
    };
    $isArabic = app()->getLocale() === 'ar';
    $normalizeLink = function ($url) {
        if (empty($url)) {
            return '#';
        }

        if (\Illuminate\Support\Str::startsWith($url, ['http://', 'https://', 'mailto:', 'tel:', '#'])) {
            return $url;
        }

        return url($url);
    };
    $heroTitle = isset($seoMeta)
        ? ($localize($seoMeta->h1_en ?? null, $seoMeta->h1_ar ?? null) ?? ($localize($pageContent?->title_en, $pageContent?->title_ar) ?: ($isArabic ? 'دراسات الحالة' : 'Case Studies')))
        : ($localize($pageContent?->title_en, $pageContent?->title_ar) ?: ($isArabic ? 'دراسات الحالة' : 'Case Studies'));
    $heroSubtitle = $localize($pageContent?->subtitle_en, $pageContent?->subtitle_ar)
        ?: ($isArabic ? 'استكشف دراسات الحالة التي تبرز نهجنا ونتائجنا وخبراتنا الاستشارية.' : 'Explore case studies that highlight our approach, outcomes, and advisory expertise.');
    $heroDesktop = $pageContent?->hero_desktop_image ? asset('storage/' . $pageContent->hero_desktop_image) : asset('design/images/resource-bg.png');
    $heroMobile = $pageContent?->hero_mobile_image ? asset('storage/' . $pageContent->hero_mobile_image) : $heroDesktop;
    $heroDesktopAlt = $localize($pageContent?->hero_desktop_image_alt_en, $pageContent?->hero_desktop_image_alt_ar) ?: $heroTitle;
    $heroMobileAlt = $localize($pageContent?->hero_mobile_image_alt_en, $pageContent?->hero_mobile_image_alt_ar) ?: $heroDesktopAlt;
    $bodyBackground = $pageContent?->body_background_image ? asset('storage/' . $pageContent->body_background_image) : asset('design/images/blog-bg.png');
    $searchResultLabel = $localize($pageContent?->search_results_label_en, $pageContent?->search_results_label_ar) ?: ($isArabic ? 'نتائج البحث عن:' : 'Search results for:');
    $clearSearchLabel = $localize($pageContent?->clear_search_label_en, $pageContent?->clear_search_label_ar) ?: ($isArabic ? 'مسح البحث' : 'Clear search');
    $allLabel = $localize($pageContent?->all_items_label_en, $pageContent?->all_items_label_ar) ?: ($isArabic ? 'الكل' : 'All');
    $learnMoreLabel = $localize($pageContent?->learn_more_label_en, $pageContent?->learn_more_label_ar) ?: ($isArabic ? 'اطلع على المزيد...' : 'Learn More...');
    $emptyStateTitle = $localize($pageContent?->empty_state_title_en, $pageContent?->empty_state_title_ar) ?: ($isArabic ? 'لا توجد دراسات حالة حالياً.' : 'No case studies available yet.');
    $emptyStateDescription = $localize($pageContent?->empty_state_description_en, $pageContent?->empty_state_description_ar) ?: ($isArabic ? 'عد لاحقاً للاطلاع على محتوى جديد!' : 'Check back later for new insights!');
    $ctaBackground = $pageContent?->cta_background_image ? asset('storage/' . $pageContent->cta_background_image) : asset('design/images/meeting-bg.png');
    $ctaTitle = $localize($pageContent?->cta_title_en, $pageContent?->cta_title_ar) ?: ($isArabic ? 'مستعد لبدء النمو؟' : 'READY TO START GROWING?!');
    $ctaDescription = $localize($pageContent?->cta_description_en, $pageContent?->cta_description_ar) ?: ($isArabic ? 'أطلق العنان للإمكانات الكاملة لثروتك' : 'Unlock the full potential of your wealth');
    $ctaButtonOneText = $localize($pageContent?->cta_button_1_text_en, $pageContent?->cta_button_1_text_ar) ?: ($isArabic ? 'انضم إلى قائمتنا البريدية' : 'JOIN OUR MAILING LIST');
    $ctaButtonTwoText = $localize($pageContent?->cta_button_2_text_en, $pageContent?->cta_button_2_text_ar) ?: ($isArabic ? 'اطلب اجتماعاً' : 'REQUEST A MEETING');
    $ctaButtonOneUrl = $normalizeLink($pageContent?->cta_button_1_url ?: route('contact-us'));
    $ctaButtonTwoUrl = $normalizeLink($pageContent?->cta_button_2_url ?: route('request-meeting'));
    $ctaBackgroundAlt = $localize($pageContent?->cta_background_image_alt_en, $pageContent?->cta_background_image_alt_ar) ?: strip_tags($ctaTitle);
@endphp
@if($pageContent?->isSectionVisible('hero') ?? true)
<section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
    <div class="relative overflow-hidden h-full">
        <div class="flex flex-col h-full">
            <div class="flex transition-transform duration-500 ease-in-out h-full">
                <div class="w-full flex-shrink-0 relative">
                    <div class="absolute inset-0 hidden md:block">
                        <img src="{{ $heroDesktop }}" alt="{{ $heroDesktopAlt }}" class="w-full h-full object-cover"/>
                    </div>
                    <div class="absolute inset-0 block md:hidden">
                        <img src="{{ $heroMobile }}" alt="{{ $heroMobileAlt }}" class="w-full h-full object-cover"/>
                    </div>
                    <div class="absolute inset-0 "></div>
                    <div class="relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                        <div class="container mx-auto text-center">
                            <h1 class="text-[45px] xl:text-[78px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">{{ $heroTitle }}</h1>
                            <div class="font-['Poppins'] text-[18px] text-white/80 max-w-3xl mx-auto">
                                <p>{!! $heroSubtitle !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if(($pageContent?->isSectionVisible('tabs') ?? true) || ($pageContent?->isSectionVisible('listing') ?? true))
<section class="pt-32 pb-16 sm:pt-36 sm:pb-20 md:pt-40 md:pb-24 lg:pt-[5em] lg:pb-32 bg-white bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $bodyBackground }}');">
    <div class="container mx-auto px-4">
        @if(!empty($searchTerm))
            <div class="mb-8 text-center">
                <p class="text-white text-lg">{{ $searchResultLabel }} <strong>"{{ $searchTerm }}"</strong></p>
                <a href="{{ route('case-studies') }}" class="text-[#D4AF37] hover:underline">{{ $clearSearchLabel }}</a>
            </div>
        @endif

        @if($pageContent?->isSectionVisible('tabs') ?? true)
        <div id="articles-tabs" class="flex flex-wrap justify-center sm:justify-center gap-2 sm:gap-4 mb-8 sm:mb-[5em] overflow-x-auto">
            <button type="button" data-tab="all" class="tab-btn-articles {{ $currentCategory === 'all' ? 'bg-[#D4AF37] text-white' : 'bg-white text-[#041B44]' }} font-['Poppins'] font-bold text-[19px] px-6 sm:px-10 py-3 sm:py-4 rounded-t border-b-4 border-[#D4AF37] shadow focus:outline-none whitespace-nowrap">{{ $allLabel }}</button>
            @foreach($categories as $category)
                @php
                    $categoryLabel = $localize($category['label_en'] ?? null, $category['label_ar'] ?? null) ?? $category['label'];
                @endphp
                <button
                    type="button"
                    data-tab="{{ $category['slug'] }}"
                    class="tab-btn-articles {{ $currentCategory === $category['slug'] ? 'bg-[#D4AF37] text-white' : 'bg-white text-[#041B44]' }} font-['Poppins'] font-bold text-[19px] px-6 sm:px-10 py-3 sm:py-4 rounded-t border-b-4 border-[#D4AF37] shadow focus:outline-none whitespace-nowrap"
                >
                    {{ $categoryLabel }}
                </button>
            @endforeach
        </div>
        @endif

        @if($pageContent?->isSectionVisible('listing') ?? true)
        <div id="articles-cards" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10 w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto">
            @forelse($caseStudies as $caseStudy)
                @php
                    $caseStudyTitle = $localize($caseStudy->title_en ?? null, $caseStudy->title_ar ?? null) ?? $caseStudy->title;
                    $thumbnailAlt = $localize($caseStudy->thumbnail_image_alt_en ?? null, $caseStudy->thumbnail_image_alt_ar ?? null) ?? $caseStudyTitle;
                    $featuredAlt = $localize($caseStudy->featured_image_alt_en ?? null, $caseStudy->featured_image_alt_ar ?? null) ?? $caseStudyTitle;
                    $postButtonLabel = $localize($caseStudy->button_text_en ?? null, $caseStudy->button_text_ar ?? null) ?: $learnMoreLabel;
                    $cardImage = $caseStudy->thumbnail_image
                        ? asset('storage/' . $caseStudy->thumbnail_image)
                        : ($caseStudy->featured_image ? asset('storage/' . $caseStudy->featured_image) : asset('design/images/blog.png'));
                    $cardImageAlt = $caseStudy->thumbnail_image ? $thumbnailAlt : ($caseStudy->featured_image ? $featuredAlt : $caseStudyTitle);
                @endphp
                <div class="article-card-articles" data-category="{{ \Illuminate\Support\Str::slug($caseStudy->category ?? 'uncategorized') }}">
                    <div class="overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 rounded-lg">
                        <div
                            class="w-full h-48 sm:h-56 md:h-64 bg-contain bg-center bg-no-repeat"
                            style="background-image: url('{{ $cardImage }}');"
                            role="img"
                            aria-label="{{ $cardImageAlt }}"
                        ></div>
                        <div class="pt-5">
                            <p class="text-[14px] sm:text-[15px] font-['Poppins'] text-[#fff] mb-3 sm:mb-4">
                                {!! Str::limit(strip_tags($caseStudy->description), 100) !!}
                            </p>
                            <a href="{{ route('case-studies.show', $caseStudy->slug) }}" class="text-[#D4AF37] text-[14px] sm:text-[15.07px] font-['Poppins'] font-regular hover:underline mt-10 inline-block">{{ $postButtonLabel }}</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-white text-lg">{{ $emptyStateTitle }}</p>
                    <p class="text-white/70 text-sm mt-2">{{ $emptyStateDescription }}</p>
                </div>
            @endforelse
        </div>
        @endif
    </div>
</section>
@endif

@if($pageContent?->isSectionVisible('cta') ?? true)
@include('partials.cta-section', [
    'backgroundImage' => $ctaBackground,
    'backgroundAlt' => $ctaBackgroundAlt,
    'titleHtml' => e($ctaTitle),
    'descriptionHtml' => $ctaDescription,
    'buttonOneText' => $ctaButtonOneText,
    'buttonOneUrl' => $ctaButtonOneUrl,
    'buttonTwoText' => $ctaButtonTwoText,
    'buttonTwoUrl' => $ctaButtonTwoUrl,
])
@endif
<script src="{{ asset('design/js/index.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.ArticlesFilter) {
            window.ArticlesFilter.activeTab = '{{ $currentCategory }}';
            window.ArticlesFilter.updateTabs('{{ $currentCategory }}');
        }
    });
</script>
@endsection


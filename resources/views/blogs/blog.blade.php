
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
    $alignmentClass = $isArabic ? 'text-right md:text-right' : 'text-left md:text-left';
    $flexButtonsDirection = $isArabic ? 'sm:flex-row-reverse' : 'sm:flex-row';
    $tabsFlexDirection = $isArabic ? 'flex-row-reverse' : '';
    $normalizeLink = function ($url) {
        if (empty($url)) {
            return '#';
        }

        if (\Illuminate\Support\Str::startsWith($url, ['http://', 'https://', 'mailto:', 'tel:', '#'])) {
            return $url;
        }

        return url($url);
    };
    $heroTitle = $localize($pageContent?->title_en, $pageContent?->title_ar)
        ?: (isset($seoMeta) ? $localize($seoMeta->h1_en ?? null, $seoMeta->h1_ar ?? null) : null)
        ?: ($isArabic ? 'المدونة' : 'BLOG');
    $heroSubtitle = $localize($pageContent?->subtitle_en, $pageContent?->subtitle_ar)
        ?: ($isArabic ? 'اكتشف أحدث الرؤى والقصص والأفكار من هاوبرك كابيتال.' : 'Discover the latest insights, stories, and ideas from Hauberk Capital.');
    $heroDesktop = $pageContent?->hero_desktop_image ? asset('storage/' . $pageContent->hero_desktop_image) : asset('design/images/resource-bg.png');
    $heroMobile = $pageContent?->hero_mobile_image ? asset('storage/' . $pageContent->hero_mobile_image) : $heroDesktop;
    $heroDesktopAlt = $localize($pageContent?->hero_desktop_image_alt_en, $pageContent?->hero_desktop_image_alt_ar) ?: $heroTitle;
    $heroMobileAlt = $localize($pageContent?->hero_mobile_image_alt_en, $pageContent?->hero_mobile_image_alt_ar) ?: $heroDesktopAlt;
    $bodyBackground = $pageContent?->body_background_image ? asset('storage/' . $pageContent->body_background_image) : asset('design/images/blog-bg.png');
    $searchResultLabel = $localize($pageContent?->search_results_label_en, $pageContent?->search_results_label_ar) ?: ($isArabic ? 'نتائج البحث عن:' : 'Search results for:');
    $clearSearchLabel = $localize($pageContent?->clear_search_label_en, $pageContent?->clear_search_label_ar) ?: ($isArabic ? 'مسح البحث' : 'Clear search');
    $allLabel = $localize($pageContent?->all_items_label_en, $pageContent?->all_items_label_ar) ?: ($isArabic ? 'الكل' : 'All');
    $learnMoreLabel = $localize($pageContent?->learn_more_label_en, $pageContent?->learn_more_label_ar) ?: ($isArabic ? 'اطلع على المزيد...' : 'Learn More...');
    $noPostsLabel = $localize($pageContent?->empty_state_title_en, $pageContent?->empty_state_title_ar) ?: ($isArabic ? 'لا توجد منشورات حالياً.' : 'No blog posts available yet.');
    $checkBackLabel = $localize($pageContent?->empty_state_description_en, $pageContent?->empty_state_description_ar) ?: ($isArabic ? 'عد لاحقاً للاطلاع على محتوى جديد!' : 'Check back later for new content!');
    $ctaBackground = $pageContent?->cta_background_image ? asset('storage/' . $pageContent->cta_background_image) : asset('design/images/meeting-bg.png');
    $ctaTitle = $localize($pageContent?->cta_title_en, $pageContent?->cta_title_ar) ?: ($isArabic ? 'مستعد لبدء النمو؟' : 'READY TO START GROWING?!');
    $ctaDescription = $localize($pageContent?->cta_description_en, $pageContent?->cta_description_ar) ?: ($isArabic ? 'أطلق العنان للإمكانات الكاملة لثروتك' : 'Unlock the full potential of your wealth');
    $ctaButtonFirst = $localize($pageContent?->cta_button_1_text_en, $pageContent?->cta_button_1_text_ar) ?: ($isArabic ? 'انضم إلى قائمتنا البريدية' : 'JOIN OUR MAILING LIST');
    $ctaButtonSecond = $localize($pageContent?->cta_button_2_text_en, $pageContent?->cta_button_2_text_ar) ?: ($isArabic ? 'اطلب اجتماعاً' : 'REQUEST A MEETING');
    $ctaButtonFirstUrl = $normalizeLink($pageContent?->cta_button_1_url ?: route('contact-us'));
    $ctaButtonSecondUrl = $normalizeLink($pageContent?->cta_button_2_url ?: route('request-meeting'));
    $ctaBackgroundAlt = $localize($pageContent?->cta_background_image_alt_en, $pageContent?->cta_background_image_alt_ar) ?: strip_tags($ctaTitle);
@endphp
@if($pageContent?->isSectionVisible('hero') ?? true)
<section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
        <div class="relative overflow-hidden h-full">
            <div class="flex flex-col h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full">
                    <div class="w-full flex-shrink-0 relative">
                        <!-- Desktop background -->
                        <div class="absolute inset-0 hidden md:block">
                            <img src="{{ $heroDesktop }}" alt="{{ $heroDesktopAlt }}" class="w-full h-full object-cover"/>
                        </div>
                        <!-- Mobile background -->
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

    {{-- Search --}}
    <section class="bg-[#041B44] py-10" dir="{{ $pageDirection }}">
        <div class="container mx-auto px-4 flex flex-col items-center gap-3">
            <p class="text-white/60 text-sm font-semibold uppercase tracking-widest">
                {{ $isArabic ? 'ابحث في المقالات' : 'Search Articles' }}
            </p>
            <form method="GET" action="{{ route('blog') }}" class="flex w-full max-w-2xl gap-0 rounded-xl overflow-hidden shadow-lg ring-1 ring-white/10">
                <input
                    type="text"
                    name="search"
                    value="{{ $searchTerm ?? '' }}"
                    placeholder="{{ $isArabic ? 'ابحث في المدونة...' : 'Search the blog...' }}"
                    class="flex-1 bg-white/10 text-white placeholder-white/40 px-5 py-3 text-sm focus:outline-none focus:bg-white/15 transition"
                />
                <button type="submit" class="bg-[#D4AF37] text-white px-6 py-3 text-sm font-semibold hover:bg-[#b8962e] transition whitespace-nowrap">
                    {{ $isArabic ? 'بحث' : 'Search' }}
                </button>
                @if(!empty($searchTerm))
                    <a href="{{ route('blog') }}" class="bg-white/10 text-white/70 px-5 py-3 text-sm hover:bg-white/20 transition whitespace-nowrap">
                        {{ $isArabic ? 'مسح' : 'Clear' }}
                    </a>
                @endif
            </form>
        </div>
    </section>

    <section class="pt-32 pb-16 sm:pt-36 sm:pb-20 md:pt-40 md:pb-24 lg:pt-[5em] lg:pb-32 bg-white bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $bodyBackground }}');">
        <div dir="{{ $pageDirection }}" class="{{ $isArabic ? 'rtl' : 'ltr' }}">
        <div class="container mx-auto px-4">
            <!-- Search Bar -->
            @if(!empty($searchTerm))
                <div class="mb-8">
                    <p class="text-white text-lg {{ $alignmentClass }}">{{ $searchResultLabel }} <strong>"{{ $searchTerm }}"</strong></p>
                    <a href="{{ route('blog') }}" class="text-[#D4AF37] hover:underline {{ $alignmentClass }} block">{{ $clearSearchLabel }}</a>
                </div>
            @endif

            @if($pageContent?->isSectionVisible('tabs') ?? true)
            <!-- Tabs -->
            <div id="articles-tabs" class="flex flex-wrap {{ $tabsFlexDirection }} justify-center sm:justify-center gap-2 sm:gap-4 mb-8 sm:mb-[5em] overflow-x-auto" dir="{{ $pageDirection }}">
                <button type="button" data-tab="all" class="tab-btn-articles {{ $currentCategory === 'all' ? 'bg-[#D4AF37] text-white' : 'bg-white text-[#041B44]' }} font-['Poppins'] font-bold text-[19px] px-6 sm:px-10 py-3 sm:py-4 rounded-t border-b-4 border-[#D4AF37] shadow focus:outline-none whitespace-nowrap">{{ $allLabel }}</button>
                @foreach($categories as $category)
                    @php
                        $categorySlug = $category['slug'] ?? \Illuminate\Support\Str::slug($category['label'] ?? '');
                        $translationKey = 'blog.categories.' . $categorySlug;
                        $translatedLabel = __($translationKey);
                        if ($translatedLabel === $translationKey) {
                            $translatedLabel = null;
                        }
                        $categoryLabel = $localize(
                            $category['label_en'] ?? null,
                            $category['label_ar'] ?? null
                        ) ?? $translatedLabel ?? ($isArabic
                            ? ($category['label_ar'] ?? $category['label'] ?? '')
                            : ($category['label_en'] ?? $category['label'] ?? '')
                        );
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
            <!-- Cards Grid -->

            @if($pageContent?->isSectionVisible('listing') ?? true)
            <div id="articles-cards" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10 w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto" dir="{{ $pageDirection }}">
                @forelse($blogs as $blog)
                    @php
                        $blogTitle = $localize($blog->title_en ?? null, $blog->title_ar ?? null) ?? $blog->title;
                        $thumbnailAlt = $localize($blog->thumbnail_image_alt_en ?? null, $blog->thumbnail_image_alt_ar ?? null) ?? $blogTitle;
                        $featuredAlt = $localize($blog->featured_image_alt_en ?? null, $blog->featured_image_alt_ar ?? null) ?? $blogTitle;
                        $rawDescription = $localize($blog->description_en ?? null, $blog->description_ar ?? null) ?? ($blog->description ?? '');
                        $trimmedDescription = \Illuminate\Support\Str::limit(strip_tags($rawDescription), 100);
                        $postButtonLabel = $localize($blog->button_text_en ?? null, $blog->button_text_ar ?? null) ?: $learnMoreLabel;
                        $cardImage = $blog->thumbnail_image
                            ? asset('storage/' . $blog->thumbnail_image)
                            : ($blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('design/images/blog.png'));
                        $cardImageAlt = $blog->thumbnail_image ? $thumbnailAlt : ($blog->featured_image ? $featuredAlt : $blogTitle);
                    @endphp
                    <div class="article-card-articles" data-category="{{ \Illuminate\Support\Str::slug($blog->category ?? 'uncategorized') }}" dir="{{ $pageDirection }}">
                        <div class="overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 rounded-lg">
                            <div
                                class="w-full h-48 sm:h-56 md:h-64 bg-contain bg-center bg-no-repeat"
                                style="background-image: url('{{ $cardImage }}');"
                                role="img"
                                aria-label="{{ $cardImageAlt }}"
                            ></div>
                            <div class="pt-5">
                                <p class="text-[14px] sm:text-[15px] font-['Poppins'] text-[#fff] mb-3 sm:mb-4 {{ $alignmentClass }}">
                                    {!! $trimmedDescription !!}
                                </p>
                                <a href="{{ route('blog.show', $blog->slug) }}" class="text-[#D4AF37] text-[14px] sm:text-[15.07px] font-['Poppins'] font-regular hover:underline mt-10 inline-block {{ $alignmentClass }}">{{ $postButtonLabel }}</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12" dir="{{ $pageDirection }}">
                        <p class="text-white text-lg {{ $alignmentClass }}">{{ $noPostsLabel }}</p>
                        <p class="text-white/70 text-sm mt-2 {{ $alignmentClass }}">{{ $checkBackLabel }}</p>
                    </div>
                @endforelse
            </div>
            @endif
        </div>
        </div>
    </section>
    @endif

        @if($pageContent?->isSectionVisible('cta') ?? true)
        @include('partials.cta-section', [
            'backgroundImage' => $ctaBackground,
            'backgroundAlt' => $ctaBackgroundAlt,
            'titleHtml' => e($ctaTitle),
            'descriptionHtml' => $ctaDescription,
            'buttonOneText' => $ctaButtonFirst,
            'buttonOneUrl' => $ctaButtonFirstUrl,
            'buttonTwoText' => $ctaButtonSecond,
            'buttonTwoUrl' => $ctaButtonSecondUrl,
        ])
        @endif
    <script src="{{ asset('design/js/index.js') }}"></script>
    <script>
        // Set initial active tab based on current category
        document.addEventListener('DOMContentLoaded', function() {
            if (window.ArticlesFilter) {
                window.ArticlesFilter.activeTab = '{{ $currentCategory }}';
                window.ArticlesFilter.updateTabs('{{ $currentCategory }}');
            }
        });
    </script>
@endsection
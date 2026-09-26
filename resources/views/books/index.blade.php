@extends('app')

@section('content')
@php
    $locale = app()->getLocale();
    $isArabic = $locale === 'ar';
    $localize = function ($en, $ar) use ($isArabic) {
        return $isArabic ? ($ar ?: $en) : ($en ?: $ar);
    };
    $normalizeLink = function ($url) {
        if (empty($url)) {
            return '#';
        }

        if (\Illuminate\Support\Str::startsWith($url, ['http://', 'https://', 'mailto:', 'tel:', '#'])) {
            return $url;
        }

        return url($url);
    };

    $heroTitle = $localize($pageContent?->title_en, $pageContent?->title_ar) ?: ($isArabic ? 'الكتب' : 'BOOKS');
    $heroDesktop = $pageContent?->hero_desktop_image ? asset('storage/' . $pageContent->hero_desktop_image) : asset('design/images/resource-bg.png');
    $heroMobile = $pageContent?->hero_mobile_image ? asset('storage/' . $pageContent->hero_mobile_image) : $heroDesktop;
    $introTitle = $localize($pageContent?->intro_title_en, $pageContent?->intro_title_ar) ?: ($isArabic ? 'اكتشف جميع المواضيع...' : 'DISCOVER ALL TOPICS...');
    $bodyBackground = $pageContent?->body_background_image ? asset('storage/' . $pageContent->body_background_image) : asset('design/images/blog-bg.png');
    $allLabel = $localize($pageContent?->all_items_label_en, $pageContent?->all_items_label_ar) ?: ($isArabic ? 'الكل' : 'All');
    $learnMoreLabel = $localize($pageContent?->learn_more_label_en, $pageContent?->learn_more_label_ar) ?: ($isArabic ? 'اطلع على المزيد...' : 'Learn More...');
    $emptyTitle = $localize($pageContent?->empty_state_title_en, $pageContent?->empty_state_title_ar) ?: ($isArabic ? 'لا توجد كتب حالياً.' : 'No books available yet.');
    $emptyDescription = $localize($pageContent?->empty_state_description_en, $pageContent?->empty_state_description_ar) ?: ($isArabic ? 'عد لاحقاً للاطلاع على محتوى جديد!' : 'Check back later for new content!');
    $ctaBackground = $pageContent?->cta_background_image ? asset('storage/' . $pageContent->cta_background_image) : asset('design/images/meeting-bg.png');
    $ctaTitle = $localize($pageContent?->cta_title_en, $pageContent?->cta_title_ar) ?: ($isArabic ? 'مستعد لبدء النمو؟' : 'READY TO START GROWING?!');
    $ctaDescription = $localize($pageContent?->cta_description_en, $pageContent?->cta_description_ar) ?: ($isArabic ? 'أطلق العنان للإمكانات الكاملة لثروتك' : 'Unlock the full potential of your wealth');
    $ctaButtonOneText = $localize($pageContent?->cta_button_1_text_en, $pageContent?->cta_button_1_text_ar) ?: ($isArabic ? 'انضم إلى قائمتنا البريدية' : 'JOIN OUR MAILING LIST');
    $ctaButtonTwoText = $localize($pageContent?->cta_button_2_text_en, $pageContent?->cta_button_2_text_ar) ?: ($isArabic ? 'اطلب اجتماعاً' : 'REQUEST A MEETING');
    $ctaButtonOneUrl = $normalizeLink($pageContent?->cta_button_1_url ?: route('contact-us'));
    $ctaButtonTwoUrl = $normalizeLink($pageContent?->cta_button_2_url ?: route('request-meeting'));
    $categoryMap = $categories->keyBy('id');
@endphp

<section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
    <div class="relative overflow-hidden h-full">
        <div class="flex flex-col h-full">
            <div class="flex transition-transform duration-500 ease-in-out h-full">
                <div class="w-full flex-shrink-0 relative">
                    <div class="absolute inset-0 hidden md:block">
                        <img src="{{ $heroDesktop }}" alt="{{ $heroTitle }}" class="w-full h-full object-cover"/>
                    </div>
                    <div class="absolute inset-0 block md:hidden">
                        <img src="{{ $heroMobile }}" alt="{{ $heroTitle }}" class="w-full h-full object-cover"/>
                    </div>
                    <div class="relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                        <div class="container mx-auto text-center">
                            <h1 class="text-[45px] xl:text-[78px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">{{ $heroTitle }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-32 pb-16 sm:pt-36 sm:pb-20 md:pt-40 md:pb-24 lg:pt-[5em] lg:pb-32 bg-white bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $bodyBackground }}');">
    <div class="container mx-auto px-4">
        <h2 class="text-[32px] sm:text-[50px] md:text-[60px] lg:text-[48px] leading-[1.1] font-neue-extrabold text-left mb-6 sm:mb-10 lg:mb-12 text-[#fff] tracking-wide">{{ $introTitle }}</h2>

        <div id="articles-tabs" class="flex flex-wrap justify-center sm:justify-center gap-2 sm:gap-4 mb-8 sm:mb-[5em] overflow-x-auto">
            <button type="button" data-tab="all" class="tab-btn-articles bg-[#D4AF37] text-white font-['Poppins'] font-bold text-[19px] px-6 sm:px-10 py-3 sm:py-4 rounded-t border-b-4 border-[#D4AF37] shadow focus:outline-none whitespace-nowrap">{{ $allLabel }}</button>
            @foreach($categories as $category)
                <button type="button" data-tab="{{ $category->id }}" class="tab-btn-articles bg-white text-[#041B44] font-['Poppins'] font-bold text-[19px] px-6 sm:px-10 py-3 sm:py-4 rounded-t border-b-4 border-[#D4AF37] shadow focus:outline-none whitespace-nowrap">
                    {{ $localize($category->name_en ?? null, $category->name_ar ?? null) }}
                </button>
            @endforeach
        </div>

        <div id="articles-cards" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10 w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto">
            @forelse($books as $book)
                @php
                    $category = $categoryMap->get($book['category_id']);
                    $bookTitle = $localize($book['title_en'] ?? null, $book['title_ar'] ?? null);
                    $bookDescription = $localize($book['description_en'] ?? null, $book['description_ar'] ?? null);
                @endphp
                <div class="article-card-articles" data-category="{{ $book['category_id'] }}">
                    <div class="overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 rounded-lg">
                        <img src="{{ $book['main_image_book']->first() ?? asset('images/default.jpg') }}" alt="{{ $bookTitle }}" class="w-full h-48 sm:h-56 md:h-64 object-cover">
                        <div class="pt-5">
                            @if($category)
                                <p class="text-[#D4AF37] text-sm mb-2">{{ $localize($category->name_en ?? null, $category->name_ar ?? null) }}</p>
                            @endif
                            <div class="text-[14px] sm:text-[15px] font-['Poppins'] text-[#fff] mb-3 sm:mb-4"><p>{{ \Illuminate\Support\Str::limit(strip_tags($bookDescription), 200) }}</p></div>
                            <a href="{{ route('book.show', $book['id']) }}" class="text-[#D4AF37] hover:underline mt-10 inline-block">{{ $learnMoreLabel }}</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-white text-lg">{{ $emptyTitle }}</p>
                    <p class="text-white/70 text-sm mt-2">{{ $emptyDescription }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@include('partials.cta-section', [
    'backgroundImage' => $ctaBackground,
    'backgroundAlt' => strip_tags($ctaTitle),
    'titleHtml' => e($ctaTitle),
    'descriptionHtml' => '<p>' . e($ctaDescription) . '</p>',
    'buttonOneText' => $ctaButtonOneText,
    'buttonOneUrl' => $ctaButtonOneUrl,
    'buttonTwoText' => $ctaButtonTwoText,
    'buttonTwoUrl' => $ctaButtonTwoUrl,
])

<script src="{{ asset('design/js/index.js') }}"></script>
@endsection

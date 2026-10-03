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

    $heroDesktop = $pageContent?->hero_desktop_image ? asset('storage/' . $pageContent->hero_desktop_image) : asset('design/images/resource-bg.png');
    $heroMobile = $pageContent?->hero_mobile_image ? asset('storage/' . $pageContent->hero_mobile_image) : $heroDesktop;
    $heroTitle = $localize($pageContent?->title_en, $pageContent?->title_ar) ?: 'Q&A';
    $heroDesktopAlt = $localize($pageContent?->hero_desktop_image_alt_en, $pageContent?->hero_desktop_image_alt_ar) ?: $heroTitle;
    $heroMobileAlt = $localize($pageContent?->hero_mobile_image_alt_en, $pageContent?->hero_mobile_image_alt_ar) ?: $heroDesktopAlt;
    $heroSubtitle = $localize($pageContent?->subtitle_en, $pageContent?->subtitle_ar) ?: 'Explore our comprehensive Q&A for all your wealth advisory questions.';
    $heroButtonText = $localize($pageContent?->primary_button_text_en, $pageContent?->primary_button_text_ar) ?: 'REQUEST A MEETING';
    $heroButtonUrl = $normalizeLink($pageContent?->primary_button_url ?: route('request-meeting'));

    $sectionBackground = $pageContent?->body_background_image ? asset('storage/' . $pageContent->body_background_image) : asset('images/faq-bg.png');
    $sectionTitle = $localize($pageContent?->intro_title_en, $pageContent?->intro_title_ar) ?: 'FREQUENTLY ASKED QUESTIONS';
    $sectionSubtitle = $localize($pageContent?->intro_subtitle_en, $pageContent?->intro_subtitle_ar) ?: 'Answers to Common Inquiries About Our Services';

    $defaultFaqItems = [
        ['question_en' => 'What is Hauberk Capital Wealth Advisory?', 'question_ar' => 'ما هي استشارات الثروات في هاوبرك كابيتال؟', 'answer_en' => '<p>Hauberk Capital Wealth Advisory is a premier financial advisory service that provides personalized wealth management solutions.</p>', 'answer_ar' => '<p>تقدم هاوبرك كابيتال خدمات استشارية مالية متخصصة وحلولاً مخصصة لإدارة الثروات.</p>'],
        ['question_en' => 'What types of accounts does Hauberk Capital manage?', 'question_ar' => 'ما أنواع الحسابات التي تديرها هاوبرك كابيتال؟', 'answer_en' => '<p>We manage individual, joint, retirement, trust, corporate, and family office accounts tailored to client goals.</p>', 'answer_ar' => '<p>ندير الحسابات الفردية والمشتركة والتقاعدية والائتمانية والشركات والمكاتب العائلية حسب أهداف العميل.</p>'],
        ['question_en' => 'How does Hauberk Capital protect my personal information?', 'question_ar' => 'كيف تحمي هاوبرك كابيتال معلوماتي الشخصية؟', 'answer_en' => '<p>We employ encryption, secure infrastructure, and strict access controls to protect client information.</p>', 'answer_ar' => '<p>نستخدم التشفير والبنية الآمنة وضوابط الوصول الصارمة لحماية معلومات العملاء.</p>'],
        ['question_en' => 'How often will I receive updates on my investments?', 'question_ar' => 'كم مرة سأحصل على تحديثات حول استثماراتي؟', 'answer_en' => '<p>Clients receive regular performance reports and can access portfolio information through secure digital channels.</p>', 'answer_ar' => '<p>يتلقى العملاء تقارير أداء دورية ويمكنهم الوصول إلى معلومات المحافظ عبر قنوات رقمية آمنة.</p>'],
        ['question_en' => 'What are the fees for Hauberk Capital services?', 'question_ar' => 'ما هي رسوم خدمات هاوبرك كابيتال؟', 'answer_en' => '<p>Fees are transparent and generally based on assets under management, depending on complexity and portfolio size.</p>', 'answer_ar' => '<p>الرسوم واضحة وتعتمد غالباً على حجم الأصول المدارة وتعقيد الخدمة.</p>'],
        ['question_en' => 'How do I get started with Hauberk Capital?', 'question_ar' => 'كيف أبدأ مع هاوبرك كابيتال؟', 'answer_en' => '<p>Start by requesting an initial consultation so we can understand your goals and recommend the best path forward.</p>', 'answer_ar' => '<p>ابدأ بطلب استشارة أولية حتى نفهم أهدافك ونوصي بالمسار الأنسب لك.</p>'],
    ];
    $faqItems = $pageContent?->faq_items ?: $defaultFaqItems;
    $faqColumns = array_chunk($faqItems, (int) ceil(max(count($faqItems), 1) / 2));

    $ctaBackground = $pageContent?->cta_background_image ? asset('storage/' . $pageContent->cta_background_image) : asset('design/images/meeting-bg.png');
    $ctaTitle = $localize($pageContent?->cta_title_en, $pageContent?->cta_title_ar) ?: 'READY TO START GROWING?!';
    $ctaDescription = $localize($pageContent?->cta_description_en, $pageContent?->cta_description_ar) ?: 'Unlock the full potential of your wealth';
    $ctaButtonOneText = $localize($pageContent?->cta_button_1_text_en, $pageContent?->cta_button_1_text_ar) ?: 'JOIN OUR MAILING LIST';
    $ctaButtonOneUrl = $normalizeLink($pageContent?->cta_button_1_url ?: route('contact-us'));
    $ctaButtonTwoText = $localize($pageContent?->cta_button_2_text_en, $pageContent?->cta_button_2_text_ar) ?: 'REQUEST A MEETING';
    $ctaButtonTwoUrl = $normalizeLink($pageContent?->cta_button_2_url ?: route('request-meeting'));
    $ctaBackgroundAlt = $localize($pageContent?->cta_background_image_alt_en, $pageContent?->cta_background_image_alt_ar) ?: strip_tags($ctaTitle);
    $accordionQuestionAlignClass = $isArabic ? 'text-right' : 'text-left';
@endphp

@if($pageContent?->isSectionVisible('hero') ?? true)
<section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
    <div class="relative overflow-hidden h-full">
        <div class="flex flex-col h-full">
            <div class="flex transition-transform duration-500 ease-in-out h-full">
                <div class="w-full flex-shrink-0 relative">
                    <div class="absolute inset-0">
                        <img loading="lazy" src="{{ $heroDesktop }}" alt="{{ $heroDesktopAlt }}" class="hidden md:block w-full h-full object-cover"/>
                        <img loading="lazy" src="{{ $heroMobile }}" alt="{{ $heroMobileAlt }}" class="block md:hidden w-full h-full object-cover"/>
                    </div>
                    <div class="relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                        <div class="container mx-auto text-center">
                            <h1 class="text-[45px] xl:text-[78px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">{{ $heroTitle }}</h1>
                            <div class="mb-8 text-[17px] xl:text-[18px] text-[#FFFFFF]/70 font-['Poppins'] font-regular">
                                <p>{!! $heroSubtitle !!}</p>
                            </div>
                            <a href="{{ $heroButtonUrl }}" class="inline-block bg-[#D4AF37] px-6 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px]">
                                {{ $heroButtonText }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if(($pageContent?->isSectionVisible('intro') ?? true) || ($pageContent?->isSectionVisible('faq') ?? true))
<section class="bg-[#041B44] text-white py-20 px-4 min-h-screen flex items-center" style="background: url('{{ $sectionBackground }}') center/cover no-repeat;">
    <div class="max-w-5xl mx-auto w-full">
        @if($pageContent?->isSectionVisible('intro') ?? true)
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-neue-extrabold mb-2 tracking-wide">{{ $sectionTitle }}</h2>
            <div class="text-white/70 text-lg leading-relaxed"><p>{!! $sectionSubtitle !!}</p></div>
        </div>
        @endif

        @if($pageContent?->isSectionVisible('faq') ?? true)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-16 [&>div]:space-y-10">
            @foreach($faqColumns as $column)
                <div>
                    @foreach($column as $item)
                        <div class="mb-6">
                            <button class="w-full flex items-center justify-between py-4 border-b border-white/50 group focus:outline-none accordion-btn" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
                                <span class="{{ $accordionQuestionAlignClass }} text-base font-medium flex-1">{{ $localize($item['question_en'] ?? null, $item['question_ar'] ?? null) }}</span>
                                <span class="text-[#D4AF37] group-hover:scale-125 transition-transform plus-icon {{ $isArabic ? 'mr-3' : 'ml-3' }}">
                                    <svg width="20" height="20" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.7816 1.39233V23.8071M23.989 12.5997L1.57422 12.5997" stroke="#D4AF37" stroke-width="2.10139" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </button>
                            <div class="accordion-content hidden px-4 pt-2 pb-4 text-white/80">
                                {!! $localize($item['answer_en'] ?? null, $item['answer_ar'] ?? null) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const accordionButtons = document.querySelectorAll('.accordion-btn');

    const style = document.createElement('style');
    style.textContent = `
        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1), padding 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            padding-top: 0;
            padding-bottom: 0;
        }
        .accordion-content.active {
            max-height: 500px;
            opacity: 1;
            padding-top: 0.5rem;
            padding-bottom: 1rem;
        }
        .plus-icon svg {
            transition: transform 0.4s ease;
        }
        .accordion-btn.active .plus-icon svg {
            transform: rotate(180deg);
        }
    `;
    document.head.appendChild(style);

    document.querySelectorAll('.accordion-content').forEach(content => {
        content.classList.remove('hidden');
        content.style.paddingLeft = '1rem';
        content.style.paddingRight = '1rem';
    });

    accordionButtons.forEach(button => {
        button.addEventListener('click', function () {
            const content = this.nextElementSibling;

            document.querySelectorAll('.accordion-content.active').forEach(item => {
                if (item !== content) {
                    item.classList.remove('active');
                    item.previousElementSibling.classList.remove('active');
                    item.previousElementSibling.querySelector('.plus-icon svg path').setAttribute('d', 'M12.7816 1.39233V23.8071M23.989 12.5997L1.57422 12.5997');
                }
            });

            if (!content.classList.contains('active')) {
                content.classList.add('active');
                this.classList.add('active');
                this.querySelector('.plus-icon svg path').setAttribute('d', 'M23.989 12.5997L1.57422 12.5997');
            } else {
                content.classList.remove('active');
                this.classList.remove('active');
                this.querySelector('.plus-icon svg path').setAttribute('d', 'M12.7816 1.39233V23.8071M23.989 12.5997L1.57422 12.5997');
            }
        });
    });
});
</script>
@endsection

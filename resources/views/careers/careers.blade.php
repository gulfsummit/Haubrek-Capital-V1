
@extends('app')

@section('content')
@php
    $localize = $localize ?? function ($en, $ar) {
        return app()->getLocale() === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
    };
    $normalizeLink = $normalizeLink ?? function ($value, $fallback) {
        if (blank($value)) {
            return $fallback;
        }

        if (
            str_starts_with($value, 'http://') ||
            str_starts_with($value, 'https://') ||
            str_starts_with($value, '/') ||
            str_starts_with($value, '#') ||
            str_starts_with($value, 'mailto:') ||
            str_starts_with($value, 'tel:')
        ) {
            return $value;
        }

        return '/' . ltrim($value, '/');
    };
    $heroDesktopAlt = $localize($careers?->hero_desktop_image_alt_en, $careers?->hero_desktop_image_alt_ar)
        ?: ($careers ? $localize($careers->hero_title_en, $careers->hero_title_ar) : 'Careers');
    $heroMobileAlt = $localize($careers?->hero_mobile_image_alt_en, $careers?->hero_mobile_image_alt_ar)
        ?: $heroDesktopAlt;
    $whyWorkBackgroundAlt = $localize($careers?->why_work_bg_image_alt_en, $careers?->why_work_bg_image_alt_ar)
        ?: ($careers ? $localize($careers->why_work_title_en, $careers->why_work_title_ar) : 'Why Work at Hauberk Capital');
    $ctaBackgroundAlt = $localize($careers?->cta_background_image_alt_en, $careers?->cta_background_image_alt_ar)
        ?: strip_tags($careers ? (app()->getLocale() === 'ar' ? $careers->cta_title_ar : $careers->cta_title_en) : 'READY TO START GROWING?!');
@endphp
@if($careers?->isSectionVisible('hero') ?? true)
<section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
        <div class="relative overflow-hidden h-full">
            <div class="flex flex-col h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full">
                    <div class="w-full flex-shrink-0 relative">
                        <!-- Desktop background -->
                        <div class="absolute inset-0 hidden md:block">
                            <img loading="lazy" src="{{ $careers && $careers->hero_desktop_image ? asset('storage/' . $careers->hero_desktop_image) : asset('design/images/careers-hero.png') }}" alt="{{ $heroDesktopAlt }}" class="w-full h-full object-cover"/>
                        </div>
                        <!-- Mobile background -->
                        <div class="absolute inset-0 block md:hidden">
                            <img loading="lazy" src="{{ $careers && $careers->hero_mobile_image ? asset('storage/' . $careers->hero_mobile_image) : asset('design/images/careers-hero-mob.png') }}" alt="{{ $heroMobileAlt }}" class="w-full h-full object-cover"/>
                        </div>
                        <div class="absolute inset-0 "></div>
                        <div class="relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                            <div class="container mx-auto text-center">
                                <h1 class="text-[45px] xl:text-[50px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">{{ isset($seoMeta) ? ($localize($seoMeta->h1_en ?? null, $seoMeta->h1_ar ?? null) ?? ($careers ? (app()->getLocale() === 'ar' ? $careers->hero_title_ar : $careers->hero_title_en) : (app()->getLocale() === 'ar' ? 'انضم إلى فريقنا' : 'JOIN OUR TEAM'))) : ($careers ? (app()->getLocale() === 'ar' ? $careers->hero_title_ar : $careers->hero_title_en) : (app()->getLocale() === 'ar' ? 'انضم إلى فريقنا' : 'JOIN OUR TEAM')) }}</h1>
                                <div class="mb-8 text-[17px] xl:text-[18px] text-[#FFFFFF]/70 font-['Poppins'] font-regular">{!! $careers ? (app()->getLocale() === 'ar' ? $careers->hero_subtitle_ar : $careers->hero_subtitle_en) : '<p>Careers that Drive your Success</p>' !!}</div>
                                <a href="{{ $careers && $careers->hero_button_link ? $careers->hero_button_link : '/about-us' }}" class="bg-[#D4AF37] px-6 py-3 font-neue-extrabold rounded-lg font-neue-bold text-[18px] inline-block">{{ $careers ? (app()->getLocale() === 'ar' ? $careers->hero_button_text_ar : $careers->hero_button_text_en) : 'MORE ABOUT US' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

    @if($careers?->isSectionVisible('why_work') ?? true)
    <!-- WHY WORK AT HAUBERK CAPITAL? Carousel Section (EXACT MATCH) -->
    <section class="relative z-0 bg-[#0B1633] py-16 md:py-32 overflow-hidden">
        <!-- Patterned Background -->
        <div class="absolute inset-0 z-0">
            <img loading="lazy" src="{{ $careers && $careers->why_work_bg_image ? asset('storage/' . $careers->why_work_bg_image) : asset('design/images/team-bg.png') }}" alt="{{ $whyWorkBackgroundAlt }}" class="w-full h-full object-cover"/>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <h2 class="text-center text-[28px] md:text-[36px] font-neue-extrabold uppercase mb-2 text-white tracking-wide">{{ $careers ? (app()->getLocale() === 'ar' ? $careers->why_work_title_ar : $careers->why_work_title_en) : 'WHY WORK AT HAUBERK CAPITAL?' }}</h2>
            <div class="text-center text-[16px] md:text-[18px] text-white/80 mb-8 md:mb-12 font-['Poppins'] max-w-2xl mx-auto">{!! $careers ? (app()->getLocale() === 'ar' ? $careers->why_work_subtitle_ar : $careers->why_work_subtitle_en) : '<p>Working at Hauberk Capital means being part of a vibrant and inclusive community. Our team enjoys</p>' !!}</div>

            <!-- Carousel: Why Work at Hauberk Capital -->
            @php
                $isArabic = app()->getLocale() === 'ar';
                $cards = $careers && $careers->why_work_cards ? $careers->why_work_cards : [
                    [
                        'title_en' => 'A COLLABORATIVE ENVIRONMENT',
                        'title_ar' => 'بيئة تعاونية',
                        'content_en' => '<p>Our team-oriented culture fosters collaboration and innovation. We believe in the power of teamwork to achieve great results.</p>',
                        'content_ar' => '<p>ثقافتنا الموجهة نحو الفريق تعزز التعاون والابتكار. نؤمن بقوة العمل الجماعي لتحقيق نتائج عظيمة.</p>'
                    ],
                    [
                        'title_en' => 'PROFESSIONAL GROWTH',
                        'title_ar' => 'النمو المهني',
                        'content_en' => '<p>We are committed to your career development. From continuous learning opportunities to career advancement programs, we invest in our employees\' growth.</p>',
                        'content_ar' => '<p>نحن ملتزمون بتطوير حياتك المهنية. من فرص التعلم المستمر إلى برامج التقدم الوظيفي ، نستثمر في نمو موظفينا.</p>'
                    ],
                    [
                        'title_en' => 'COMPETITIVE BENEFITS',
                        'title_ar' => 'مزايا تنافسية',
                        'content_en' => '<p>Our comprehensive benefits package includes health insurance, retirement plans, performance bonuses, and more to reward your contributions.</p>',
                        'content_ar' => '<p>تتضمن حزمة المزايا الشاملة لدينا التأمين الصحي وخطط التقاعد ومكافآت الأداء والمزيد لمكافأة مساهماتك.</p>'
                    ]
                ];
                $cards = $isArabic ? collect($cards)->reverse()->values()->all() : $cards;
                // Keep RTL direction for Arabic, but center-align the card text.
                $whyWorkCardAlign = 'text-center';
                $whyWorkCardDirection = $isArabic ? 'rtl' : 'ltr';
            @endphp

            <div class="relative mt-6">
                <div class="overflow-hidden w-full" dir="ltr">
                    <div id="whywork-slider" class="flex transition-transform duration-500 ease-in-out select-none cursor-grab" dir="ltr">
                        @foreach($cards as $card)
                            <div class="carousel-item flex-shrink-0" style="width: 100%;">
                                <div class="px-4 lg:px-8 py-6 lg:py-8 {{ $whyWorkCardAlign }}" dir="{{ $whyWorkCardDirection }}">
                                    <h3 class="font-neue-bold text-[20px] md:text-[24px] lg:text-[28px] uppercase mb-4 leading-[30px] lg:leading-[35px] text-white {{ $whyWorkCardAlign }}">
                                        {!! app()->getLocale() === 'ar' ? nl2br(e($card['title_ar'] ?? '')) : nl2br(e($card['title_en'] ?? '')) !!}
                                    </h3>
                                    <div class="text-[15px] md:text-[16px] lg:text-[18px] text-white/70 font-['Poppins'] leading-relaxed {{ $whyWorkCardAlign }}">
                                        {!! app()->getLocale() === 'ar' ? ($card['content_ar'] ?? '') : ($card['content_en'] ?? '') !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="whywork-dots" class="flex justify-center mt-6 gap-2"></div>
            </div>
        </div>
        <script>
        // WHY WORK AT HAUBERK CAPITAL Carousel
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('whywork-slider');
            if (!slider) {
                return;
            }

            const items = Array.from(slider.querySelectorAll('.carousel-item'));
            const dotsContainer = document.getElementById('whywork-dots');

            let currentPage = 0;
            let itemsPerPage = 3; // Changed from 1 to 3 for desktop
            let totalPages = 1;
            let dots = [];
            let autoplay = null;
            const autoplayDelay = 8000;
            let isDragging = false;
            let dragStartX = 0;
            let dragCurrentX = 0;

            function createDots() {
                dotsContainer.innerHTML = '';
                dots = [];
                for (let i = 0; i < totalPages; i++) {
                    const dot = document.createElement('button');
                    dot.classList.add('whywork-dot', 'w-3', 'h-3', 'rounded-full', 'transition-all', 'duration-300');
                    dot.dataset.index = i;
                    dot.addEventListener('click', () => {
                        currentPage = i;
                        updateSlider();
                    });
                    dotsContainer.appendChild(dot);
                    dots.push(dot);
                }
            }

            function setSlideWidths() {
                if (window.innerWidth < 768) {
                    itemsPerPage = 1;
                } else if (window.innerWidth < 1280) {
                    itemsPerPage = 2;
                } else {
                    itemsPerPage = 3;
                }

                totalPages = Math.max(1, Math.ceil(items.length / itemsPerPage));
                const itemWidth = 100 / itemsPerPage;
                items.forEach(item => {
                    item.style.width = itemWidth + '%';
                });

                currentPage = Math.min(currentPage, totalPages - 1);
                createDots();
                updateSlider();
            }

            function updateSlider() {
                slider.style.transform = `translateX(-${currentPage * 100}%)`;

                dots.forEach((dot, idx) => {
                    if (idx === currentPage) {
                        dot.classList.add('bg-[#D4AF37]');
                        dot.classList.remove('bg-gray-400');
                    } else {
                        dot.classList.remove('bg-[#D4AF37]');
                        dot.classList.add('bg-gray-400');
                    }
                });
            }

            setSlideWidths();
            window.addEventListener('resize', setSlideWidths);

            function startAutoplay() {
                stopAutoplay();
                autoplay = setInterval(() => {
                    currentPage = (currentPage + 1) % totalPages;
                    updateSlider();
                }, autoplayDelay);
            }

            function stopAutoplay() {
                if (autoplay) {
                    clearInterval(autoplay);
                    autoplay = null;
                }
            }

            startAutoplay();

            slider.addEventListener('mouseenter', stopAutoplay);
            slider.addEventListener('mouseleave', () => {
                if (!isDragging) {
                    startAutoplay();
                }
            });

            let touchStartX = 0;
            slider.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
                stopAutoplay();
            }, false);

            slider.addEventListener('touchend', function(e) {
                const touchEndX = e.changedTouches[0].screenX;
                if (touchEndX < touchStartX - 50) {
                    currentPage = (currentPage + 1) % totalPages;
                    updateSlider();
                } else if (touchEndX > touchStartX + 50) {
                    currentPage = (currentPage - 1 + totalPages) % totalPages;
                    updateSlider();
                }
                startAutoplay();
            }, false);

            slider.addEventListener('mousedown', function(e) {
                isDragging = true;
                dragStartX = e.clientX;
                dragCurrentX = dragStartX;
                slider.classList.add('cursor-grabbing');
                stopAutoplay();
            });

            slider.addEventListener('mousemove', function(e) {
                if (!isDragging) return;
                dragCurrentX = e.clientX;
            });

            function endDesktopDrag() {
                if (!isDragging) return;
                isDragging = false;
                slider.classList.remove('cursor-grabbing');
                const diff = dragCurrentX - dragStartX;
                if (Math.abs(diff) > 60) {
                    if (diff < 0) {
                        currentPage = (currentPage + 1) % totalPages;
                    } else {
                        currentPage = (currentPage - 1 + totalPages) % totalPages;
                    }
                    updateSlider();
                }
                startAutoplay();
            }

            slider.addEventListener('mouseup', endDesktopDrag);
            slider.addEventListener('mouseleave', endDesktopDrag);
        });
        </script>
    </section>
    @endif

    <!-- HOW TO APPLY Section -->
    @php
              $isArabic = app()->getLocale() === 'ar';
              $nameLabel = $isArabic ? 'الاسم *' : 'Name *';
              $namePlaceholder = $isArabic ? 'اسمك' : 'Your name';
              $mobileLabel = $isArabic ? 'رقم الجوال*' : 'Mobile*';
              $mobilePlaceholder = $isArabic ? '+٩٧٠ 000 000 000' : '+11 000 000 000';
              $cvLabel = $isArabic ? 'أرفق سيرتك الذاتية*' : 'Attach your CV*';
              $chooseFileText = $isArabic ? 'اختر ملفاً' : 'Choose file';
              $submitText = $isArabic ? 'إرسال' : 'SUBMIT';
              $applyTextAlign = $isArabic ? 'text-right' : 'text-left';
    @endphp
    @if($careers?->isSectionVisible('how_to_apply') ?? true)
    <section class="w-full bg-[#0B1633] flex justify-center items-center py-12 md:py-20">
        <div class="w-full max-w-6xl mx-auto bg-[#020B1C] rounded-2xl shadow-lg flex flex-col {{ $isArabic ? 'md:flex-row-reverse' : 'md:flex-row' }} p-4 sm:p-6 md:p-12 gap-6 md:gap-8">
          <!-- Left: Instructions -->
          <div class="flex-1 mb-6 md:mb-0 md:p-4 lg:p-8 {{ $applyTextAlign }}" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
            <h3 class="font-neue-bold text-white text-[20px] sm:text-[22px] md:text-[26px] lg:text-[30px] leading-tight md:leading-[42px] mb-3 md:mb-4 {{ $applyTextAlign }}">{{ $careers ? (app()->getLocale() === 'ar' ? $careers->how_to_apply_title_ar : $careers->how_to_apply_title_en) : 'HOW TO APPLY' }}</h3>
            <div class="text-white/70 text-[16px] sm:text-[17px] md:text-[18px] mb-2 font-['Poppins'] font-regular {{ $applyTextAlign }}">{!! $careers ? (app()->getLocale() === 'ar' ? str_replace('careers@hauberkcapital.com', ($careers->apply_email ?? 'careers@hauberkcapital.com'), $careers->how_to_apply_text1_ar) : str_replace('careers@hauberkcapital.com', ($careers->apply_email ?? 'careers@hauberkcapital.com'), $careers->how_to_apply_text1_en)) : '<p>To apply, please send your CV and cover letter to <a href="mailto:careers@hauberkcapital.com" class="text-[#D4AF37] underline hover:text-[#bfa14e] transition-colors">careers@hauberkcapital.com</a>.<br class="hidden sm:block">Or fill out this form. Our HR team will contact you after reviewing your application.</p>' !!}</div>
            <div class="my-3 md:my-4"></div>
            <div class="text-white/70 text-[16px] sm:text-[17px] md:text-[18px] mb-4 font-['Poppins'] font-regular {{ $applyTextAlign }}">{!! $careers ? (app()->getLocale() === 'ar' ? $careers->how_to_apply_text2_ar : $careers->how_to_apply_text2_en) : '<p>We believe that diversity drives innovation and strengthens our company.<br class="hidden sm:block">At Hauberk Capital, we are committed to creating an inclusive workplace where everyone feels valued and respected.</p>' !!}</div>
          </div>
          <!-- Right: Form -->
          <div class="flex-1 flex flex-col gap-3 md:gap-4">
            @if(session('success'))
              <div class="bg-green-500 text-white p-4 rounded-lg mb-4 text-center">
                {{ session('success') }}
              </div>
            @endif

            @if($errors->any())
              <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                <ul class="list-disc list-inside">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('careers.submit') }}" class="flex flex-col gap-3 md:gap-4" enctype="multipart/form-data" autocomplete="off" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
            @csrf
            <label class="text-white/80 text-[14px] sm:text-[15px] font-['Poppins'] mb-0.5 md:mb-1 {{ $isArabic ? 'text-right' : 'text-left' }}">{{ $nameLabel }}</label>
            <input
              type="text"
              name="name"
              required
              placeholder="{{ $namePlaceholder }}"
              class="rounded-md px-3 sm:px-4 py-2 bg-[#fff] text-black border-none outline-none focus:ring-2 focus:ring-[#D4AF37] placeholder-black/40 text-[14px] sm:text-[15px]"
              dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
              style="{{ $isArabic ? 'text-align:right;direction:rtl;' : 'text-align:left;direction:ltr;' }}"
            />

            <label class="text-white/80 text-[14px] sm:text-[15px] font-['Poppins'] mb-0.5 md:mb-1 mt-1 sm:mt-2 {{ $isArabic ? 'text-right' : 'text-left' }}">{{ $mobileLabel }}</label>
            <input
              type="tel"
              name="mobile"
              required
              placeholder="{{ $mobilePlaceholder }}"
              class="rounded-md px-3 sm:px-4 py-2 bg-[#fff] text-black border-none outline-none focus:ring-2 focus:ring-[#D4AF37] placeholder-black/40 text-[14px] sm:text-[15px]"
              dir="ltr"
              style="{{ $isArabic ? 'text-align:right;' : 'text-align:left;' }}"
            />

            <label class="text-white/80 text-[14px] sm:text-[15px] font-['Poppins'] mb-0.5 md:mb-1 mt-1 sm:mt-2 {{ $isArabic ? 'text-right' : 'text-left' }}">{{ $cvLabel }}</label>
            <div class="relative">
              <input type="file" name="cv" required id="cv-upload" accept=".pdf,.doc,.docx" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10" />
              <div
                id="file-display"
                data-default-text="{{ $chooseFileText }}"
                class="rounded-md px-3 sm:px-4 py-2 bg-[#fff] text-black border-none outline-none text-[14px] sm:text-[15px] h-[38px] sm:h-[42px] flex items-center text-black/40"
                dir="{{ $isArabic ? 'rtl' : 'ltr' }}"
              ><span id="file-display-text" class="block w-full" style="{{ $isArabic ? 'text-align:right;' : 'text-align:left;' }}">{{ $chooseFileText }}</span></div>
            </div>

            <div class="flex justify-center mt-3">
              <x-recaptcha action="career_application" />
            </div>

            <button type="submit" class="mt-3 md:mt-4 bg-[#D4AF37] text-white font-neue-bold rounded-md py-3 md:py-4 text-[16px] sm:text-[18px] md:text-[19px] tracking-wide transition-all hover:bg-[#bfa14e] focus:ring-2 focus:ring-offset-2 focus:ring-[#D4AF37] focus:outline-none">{{ $submitText }}</button>
            </form>
          </div>
        </div>
      </section>
    @endif

      @if($careers?->isSectionVisible('cta') ?? true)
      @include('partials.cta-section', [
        'backgroundImage' => $careers && $careers->cta_background_image ? asset('storage/' . $careers->cta_background_image) : asset('design/images/meeting-bg.png'),
        'backgroundAlt' => $ctaBackgroundAlt,
        'titleHtml' => $careers ? nl2br(e(app()->getLocale() === 'ar' ? $careers->cta_title_ar : $careers->cta_title_en)) : 'READY TO<br/>START GROWING?!',
        'descriptionHtml' => $careers ? (app()->getLocale() === 'ar' ? $careers->cta_subtitle_ar : $careers->cta_subtitle_en) : '<p>Unlock the full potential of your wealth</p>',
        'buttonOneText' => $careers ? (app()->getLocale() === 'ar' ? $careers->cta_button_1_text_ar : $careers->cta_button_1_text_en) : 'JOIN OUR MAILING LIST',
        'buttonOneUrl' => $normalizeLink($careers->cta_button_1_url ?? null, route('contact-us')),
        'buttonTwoText' => $careers ? (app()->getLocale() === 'ar' ? $careers->cta_button_2_text_ar : $careers->cta_button_2_text_en) : 'REQUEST A MEETING',
        'buttonTwoUrl' => $normalizeLink($careers->cta_button_2_url ?? null, route('request-meeting')),
      ])
      @endif

<script src="{{ asset('design/js/index.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('cv-upload');
    const fileDisplay = document.getElementById('file-display');
    const fileDisplayText = document.getElementById('file-display-text');

    if (fileInput && fileDisplay && fileDisplayText) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const defaultText = fileDisplay.dataset.defaultText || 'Choose file';

            if (file) {
                fileDisplayText.textContent = file.name;
                fileDisplay.style.color = '#000000';

                const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Please select a valid file type (PDF, DOC, or DOCX)');
                    fileInput.value = '';
                    fileDisplayText.textContent = defaultText;
                    fileDisplay.style.color = 'rgba(0, 0, 0, 0.4)';
                    return;
                }

                const maxSize = 10 * 1024 * 1024;
                if (file.size > maxSize) {
                    alert('File size must be less than 10MB');
                    fileInput.value = '';
                    fileDisplayText.textContent = defaultText;
                    fileDisplay.style.color = 'rgba(0, 0, 0, 0.4)';
                    return;
                }
            } else {
                fileDisplayText.textContent = defaultText;
                fileDisplay.style.color = 'rgba(0, 0, 0, 0.4)';
            }
        });
    }
});
</script>
@endsection

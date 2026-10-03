@extends('app')
@section('content')
    @php
        $locale = app()->getLocale();
        $localize = $localize ?? function ($en, $ar) {
            return app()->getLocale() === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
        };
        $defaultHeroTitle = $locale == 'ar' ? ($appData->hero_title_ar ?? 'تطبيق هوبيرك كابيتال') : ($appData->hero_title_en ?? 'HAUBERK CAPITAL APP');
        $heroTitle = isset($seoMeta) ? ($localize($seoMeta->h1_en ?? null, $seoMeta->h1_ar ?? null) ?? $defaultHeroTitle) : $defaultHeroTitle;
        $heroSubtitle = $locale == 'ar' ? ($appData->hero_subtitle_ar ?? 'محفظتك في جيبك') : ($appData->hero_subtitle_en ?? 'Your Portfolio in Your Pocket');
        $heroBackgroundImage = $appData->hero_background_image ? asset('storage/' . $appData->hero_background_image) : asset('design/images/app-bg-1.png');
        $heroMobileBackgroundImage = $appData->hero_mobile_background_image ? asset('storage/' . $appData->hero_mobile_background_image) : asset('design/images/app-bg-1.png');
    @endphp

    @if($appData?->isSectionVisible('hero') ?? true)
    <section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
        <div class="relative overflow-hidden h-full">
            <div class="flex flex-col h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full">
                    <div class="w-full flex-shrink-0 relative">
                        <!-- Desktop background -->
                        <div class="absolute inset-0 hidden md:block">
                            <img loading="lazy" src="{{ $heroBackgroundImage }}" alt="Wealth Management" class="w-full h-full object-cover"/>
                        </div>
                        <!-- Mobile background -->
                        <div class="absolute inset-0 block md:hidden">
                            <img loading="lazy" src="{{ $heroMobileBackgroundImage }}" alt="Wealth Management Mobile" class="w-full h-full object-cover"/>
                        </div>
                        <div class="absolute inset-0 "></div>
                        <div class="relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                            <div class="container mx-auto text-center" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
                                <h1 class="text-[45px] xl:text-[50px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">{{ $heroTitle }}</h1>
                                <div class="mb-8 text-[17px] xl:text-[18px] text-[#FFFFFF]/70 font-['Poppins'] font-regular">
                                    {!! $heroSubtitle !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @php
        $promoTitle = $locale == 'ar' ? ($appData->promo_title_ar ?? 'الاستثمار مبسط في تطبيق واحد، تحكم كامل') : ($appData->promo_title_en ?? 'INVESTMENT MADE SIMPLE ONE APP, TOTAL CONTROL');
        $promoDescription = $locale == 'ar' ? ($appData->promo_description_ar ?? 'تحكم كامل في استثماراتك مع تطبيق هوبيرك كابيتال المحمول—رفيقك المالي الأمثل المصمم للكفاءة والأمان واتخاذ القرارات في الوقت الفعلي.') : ($appData->promo_description_en ?? 'Take full control of your investments with the Hauberk Capital mobile app—your ultimate financial companion designed for efficiency, security, and real-time decision-making.');
        $promoBackgroundImage = $appData->promo_background_image ? asset('storage/' . $appData->promo_background_image) : asset('design/images/app-bg-1.png');
        $promoMobile1Image = $appData->promo_mobile_1_image ? asset('storage/' . $appData->promo_mobile_1_image) : asset('design/images/mobile-1.png');
    @endphp

    @if($appData?->isSectionVisible('promo') ?? true)
    <!-- Investment App Promo Section (matches provided image) -->
    <section class="relative bg-[#000000] py-0 text-white overflow-hidden">
      <!-- Top Half -->
      <div class="relative z-10 w-full" style="background-image: url('{{ $promoBackgroundImage }}'); background-size: cover; background-repeat: no-repeat; ">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between px-6 pt-16 pb-10">
          <!-- Left: Text -->
          <div class="w-full mb-10 md:mb-0" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
            <h2 class="text-3xl md:text-[45.47px] font-neue-extrabold mb-2 leading-[55.8px]">
                {{ $promoTitle }}
            </h2>
            <div class="text-base md:text-lg text-white/70 mt-4">
                {!! $promoDescription !!}
            </div>
          </div>
          <!-- Right: Two Phones -->
          <div class="md:w-[70%] flex justify-center md:justify-end relative">
            <img loading="lazy" src="{{ $promoMobile1Image }}" alt="App Screenshot 1" class="rounded-2xl z-20 absolute md:relative" style="z-index: 100; transform: translateY(250px) translateX(-50%); left: 50%;">
          </div>
        </div>
      </div>
      @if($appData?->isSectionVisible('bottom') ?? true)
      <!-- Bottom Half -->
      @php
        $bottomTitle = $locale == 'ar' ? ($appData->bottom_title_ar ?? 'راقب استثماراتك بسهولة') : ($appData->bottom_title_en ?? 'EFFORTLESSLY MONITOR YOUR INVESTMENTS');
        $bottomSubtitle = $locale == 'ar' ? ($appData->bottom_subtitle_ar ?? 'إدارة المحفظة، متاحة دائماً') : ($appData->bottom_subtitle_en ?? 'Managing Portfolio, Always Accessible');
        $bottomBulletPoints = $locale == 'ar' ? ($appData->bottom_bullet_points_ar ?? [
            ['point' => 'وصول 24/7 للحساب لإدارة ثروتك بسلاسة.'],
            ['point' => 'رؤى المحفظة في الوقت الفعلي مع لوحات تفاعلية.'],
            ['point' => 'تحليلات الأداء لمساعدتك في اتخاذ قرارات مدروسة.']
        ]) : ($appData->bottom_bullet_points_en ?? [
            ['point' => '24/7 account access to manage your wealth seamlessly.'],
            ['point' => 'Real-time portfolio insights with interactive dashboards.'],
            ['point' => 'Performance analytics to help you make informed decisions.']
        ]);
        $bottomBackgroundImage = $appData->bottom_background_image ? asset('storage/' . $appData->bottom_background_image) : asset('design/images/app-bg-2.png');
        $bottomMobileImage = $appData->bottom_mobile_image ? asset('storage/' . $appData->bottom_mobile_image) : ($appData->promo_mobile_3_image ? asset('storage/' . $appData->promo_mobile_3_image) : asset('design/images/mobile-3.png'));
      @endphp
      <div class="relative w-full" style="background-image: url('{{ $bottomBackgroundImage }}'); background-size: cover; background-repeat: no-repeat; ">
        <div class="max-w-7xl mx-auto flex z-10 flex-col md:flex-row items-center justify-between px-6 pt-[200px] pb-[100px]">
          <!-- Left: Single Phone -->
          <div class="md:w-1/2 flex justify-center md:justify-start mb-10 md:mb-0">
            <img loading="lazy" src="{{ $bottomMobileImage }}" alt="App Screenshot 3" class="w-40 md:w-56 rounded-2xl shadow-2xl" style="z-index: 101;">
          </div>
          <!-- Right: Text and Bullets -->
          <div class="relative z-20" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
            <p class="text-[21px] md:text-[19px] mb-2 text-white font-['Poppins'] font-regular">
              {{ $bottomTitle }}
            </p>
            <div class="text-[48px] leading-[62px] md:text-3xl font-neue-extrabold mb-2">
                <h2 class="text-3xl md:text-[45.47px] font-neue-extrabold mb-2 uppercase leading-[55.8px]">
                    {{ $bottomSubtitle }}
                </h2>
            </div>
            <ol class="list-disc ps-6 text-white space-y-2 mt-4" style="color: white; opacity: 70%; font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 400;">
              @foreach($bottomBulletPoints as $bulletPoint)
                <li class="visible">{{ $bulletPoint['point'] }}</li>
              @endforeach
            </ol>
          </div>
        </div>
      </div>
      @endif
    </section>
    @endif

    <!-- Connect With Your Investment Experts Section -->
    @php
        $connectSubtitle = $locale == 'ar' ? ($appData->connect_subtitle_ar ?? 'تواصل مباشرة مع فريقنا') : ($appData->connect_subtitle_en ?? 'ENGAGE DIRECTLY WITH OUR TEAM');
        $connectTitle = $locale == 'ar' ? ($appData->connect_title_ar ?? 'تواصل مع خبراء الاستثمار لديك') : ($appData->connect_title_en ?? 'Connect with Your Investment Experts');
        $connectBulletPoints = $locale == 'ar' ? ($appData->connect_bullet_points_ar ?? [
            ['point' => 'دردشة فورية ومكالمات فيديو مع مدير الاستثمار المخصص لك.'],
            ['point' => 'احصل على توصيات خبيرة مخصصة لأهدافك المالية.'],
            ['point' => 'انضم إلى مناقشات حصرية حول اتجاهات السوق والاستراتيجيات.']
        ]) : ($appData->connect_bullet_points_en ?? [
            ['point' => 'Instant chat & video calls with your dedicated investment manager.'],
            ['point' => 'Access expert recommendations tailored to your financial goals.'],
            ['point' => 'Join exclusive discussions on market trends and strategies.']
        ]);
        $connectBackgroundImage = $appData->connect_background_image ? asset('storage/' . $appData->connect_background_image) : asset('design/images/app-bg-3.png');
        $connectMobileImage = $appData->connect_mobile_image ? asset('storage/' . $appData->connect_mobile_image) : asset('design/images/mobile-2.png');
    @endphp
    @if($appData?->isSectionVisible('connect') ?? true)
    <section class="relative bg-[#0B1222] py-20 text-white overflow-hidden" style="background-image: url({{ $connectBackgroundImage }}); background-repeat: no-repeat; background-size: cover;">
      <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between px-6">
        <!-- Right: Phone Image -->
        <div class="md:w-1/3 flex justify-center md:justify-end mb-12 md:mb-0 order-1 md:order-2">
          <img loading="lazy" src="{{ $connectMobileImage }}" alt="Chat App Screenshot" class="w-64 md:w-80 rounded-2xl shadow-2xl">
        </div>
        <!-- Left: Text -->
        <div class="md:w-2/3 order-2 md:order-1" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
          <div class="text-[21px] md:text-[19px] mb-2 text-white font-['Poppins'] font-regular">{{ $connectSubtitle }}</div>
          <h2 class="text-3xl md:text-[45.47px] font-neue-extrabold mb-2 uppercase leading-[55.8px]">
            {{ $connectTitle }}
          </h2>
          <ul class="list-disc ps-6 text-white/80 text-base md:text-lg space-y-2">
            @foreach($connectBulletPoints as $bulletPoint)
              <li>{{ $bulletPoint['point'] }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </section>
    @endif

    <!-- Secure & Smart Documentation Section -->
    @php
        $docsSubtitle = $locale == 'ar' ? ($appData->docs_subtitle_ar ?? 'أدر جميع مستنداتك المالية') : ($appData->docs_subtitle_en ?? 'Manage all your financial documents');
        $docsTitle = $locale == 'ar' ? ($appData->docs_title_ar ?? 'توثيق آمن وذكي') : ($appData->docs_title_en ?? 'Secure & Smart Documentation');
        $docsBulletPoints = $locale == 'ar' ? ($appData->docs_bullet_points_ar ?? [
            ['point' => 'دعم التوقيع الإلكتروني للموافقات السريعة.'],
            ['point' => 'أرشيف رقمي آمن للمستندات القانونية والاستثمارية.'],
            ['point' => 'التحقق من الهوية والامتثال التنظيمي عبر الإنترنت—سريع وخالي من المتاعب.']
        ]) : ($appData->docs_bullet_points_en ?? [
            ['point' => 'E-signature support for quick approvals.'],
            ['point' => 'Safe digital archive for legal and investment documents.'],
            ['point' => 'Online KYC & regulatory compliance—fast and hassle-free.']
        ]);
        $docsBackgroundImage = $appData->docs_background_image ? asset('storage/' . $appData->docs_background_image) : asset('design/images/app-bg-4.png');
        $docsMobileImage = $appData->docs_mobile_image ? asset('storage/' . $appData->docs_mobile_image) : asset('design/images/mobile-4.png');
    @endphp
    @if($appData?->isSectionVisible('documentation') ?? true)
    <section class="relative bg-[#0B1222] py-20 text-white overflow-hidden" style="background-image: url({{ $docsBackgroundImage }}); background-repeat: no-repeat; background-size: cover;">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between px-6">
          <!-- Left: Two Phones -->
          <div class="md:w-1/2 flex justify-center md:justify-start mb-10 md:mb-0 gap-6">
            <img loading="lazy" src="{{ $docsMobileImage }}" alt="Documentation App Screenshot 2" class=" z-10 relative">
          </div>
          <!-- Right: Text -->
          <div class="md:w-1/2" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
              <p class="text-[21px] md:text-[19px] uppercase mb-2 text-white font-['Poppins'] font-regular">
                  {{ $docsSubtitle }}
              </p>
            <h2 class="text-3xl md:text-[45.47px] font-neue-extrabold mb-2 uppercase leading-[55.8px]">
              {{ $docsTitle }}
            </h2>
            <ul class="list-disc ps-6 text-white/80 text-base md:text-lg space-y-2">
              @foreach($docsBulletPoints as $bulletPoint)
                <li>{{ $bulletPoint['point'] }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </section>
    @endif

      @php
        $knowledgeSubtitle = $locale == 'ar' ? ($appData->knowledge_subtitle_ar ?? 'الوصول إلى التعليم المالي المميز والخبرة الصناعية.') : ($appData->knowledge_subtitle_en ?? 'access to premium financial education and industry expertise.');
        $knowledgeTitle = $locale == 'ar' ? ($appData->knowledge_title_ar ?? 'معرفة حصرية ورؤى استثمارية') : ($appData->knowledge_title_en ?? 'Exclusive Knowledge & Investment Insights');
        $knowledgeBulletPoints = $locale == 'ar' ? ($appData->knowledge_bullet_points_ar ?? [
            ['point' => 'ندوات عبر الإنترنت مباشرة ومسجلة مع قادة السوق.'],
            ['point' => 'دوائر تعليمية تفاعلية تغطي استراتيجيات الاستثمار.'],
            ['point' => 'تحديثات السوق المخصصة لمحفظتك.']
        ]) : ($appData->knowledge_bullet_points_en ?? [
            ['point' => 'Live & recorded webinars with market leaders.'],
            ['point' => 'Interactive learning circles covering investment strategies.'],
            ['point' => 'Personalized market updates tailored to your portfolio.']
        ]);
        $knowledgeBackgroundImage = $appData->knowledge_background_image ? asset('storage/' . $appData->knowledge_background_image) : asset('design/images/app-bg-5.png');
        $knowledgeMobileImage = $appData->knowledge_mobile_image ? asset('storage/' . $appData->knowledge_mobile_image) : asset('design/images/mobile-3.png');
      @endphp
    @if($appData?->isSectionVisible('knowledge') ?? true)
      <section class="relative bg-[#0B1222] py-20 text-white overflow-hidden" style="background-image: url({{ $knowledgeBackgroundImage }}); background-repeat: no-repeat; background-size: cover;">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between px-6">
          <!-- Right: Phone Image -->
          <div class="md:w-1/3 flex justify-center md:justify-end mb-12 md:mb-0 order-1 md:order-2">
            <img loading="lazy" src="{{ $knowledgeMobileImage }}" alt="Chat App Screenshot" class="w-64 md:w-80 rounded-2xl shadow-2xl">
          </div>
          <!-- Left: Text -->
          <div class="md:w-2/3 order-2 md:order-1" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
            <div class="text-[21px] md:text-[19px] uppercase mb-2 text-white font-['Poppins'] font-regular">{{ $knowledgeSubtitle }}</div>
            <h2 class="text-3xl md:text-[45.47px] font-neue-extrabold mb-2 uppercase leading-[55.8px]">
                {{ $knowledgeTitle }}
            </h2>
            <ul class="list-disc ps-6 text-white/80 text-base md:text-lg space-y-2">
              @foreach($knowledgeBulletPoints as $bulletPoint)
                <li>{{ $bulletPoint['point'] }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </section>
    @endif

      @php
        $securitySubtitle = $locale == 'ar' ? ($appData->security_subtitle_ar ?? 'مع التشفير المتقدم وبروتوكولات الأمان متعددة الطبقات.') : ($appData->security_subtitle_en ?? 'with advanced encryption and multi-layered security protocols.');
        $securityTitle = $locale == 'ar' ? ($appData->security_title_ar ?? 'أمان يمكنك الوثوق به') : ($appData->security_title_en ?? 'Security You Can Trust');
        $securityBulletPoints = $locale == 'ar' ? ($appData->security_bullet_points_ar ?? [
            ['point' => 'المصادقة البيومترية لتسجيلات الدخول الآمنة.'],
            ['point' => 'كشف الاحتيال في الوقت الفعلي والتنبيهات.']
        ]) : ($appData->security_bullet_points_en ?? [
            ['point' => 'Biometric authentication for secure logins.'],
            ['point' => 'Real-time fraud detection & alerts.']
        ]);
        $securityBackgroundImage = $appData->security_background_image ? asset('storage/' . $appData->security_background_image) : asset('design/images/app-bg-6.png');
        $securityMobileImage = $appData->security_mobile_image ? asset('storage/' . $appData->security_mobile_image) : asset('design/images/mobile-5.png');
      @endphp
    @if($appData?->isSectionVisible('security') ?? true)
      <section class="relative bg-[#0B1222] py-20 text-white overflow-hidden" style="background-image: url({{ $securityBackgroundImage }}); background-repeat: no-repeat; background-size: cover;">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between px-6">
          <!-- Left: Two Phones -->
          <div class="md:w-1/2 flex justify-center md:justify-start mb-10 md:mb-0 gap-6">
            <img loading="lazy" src="{{ $securityMobileImage }}" alt="Documentation App Screenshot 2" class=" z-10 relative">
          </div>
          <!-- Right: Text -->
          <div dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
              <p class="text-[21px] md:text-[19px] uppercase mb-2 text-white font-['Poppins'] font-regular">
                {{ $securitySubtitle }}
              </p>
            <h2 class="text-3xl md:text-[45.47px] font-neue-extrabold mb-2 uppercase leading-[55.8px]">
                {{ $securityTitle }}
            </h2>
            <ul class="list-disc ps-6 text-white/80 text-base md:text-lg space-y-2">
              @foreach($securityBulletPoints as $bulletPoint)
                <li>{{ $bulletPoint['point'] }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </section>
    @endif

      @php
        $ctaTitle = $locale == 'ar' ? ($appData->cta_title_ar ?? 'مستعد لبدء النمو؟!') : ($appData->cta_title_en ?? 'READY TO START GROWING?!');
        $ctaSubtitle = $locale == 'ar' ? ($appData->cta_subtitle_ar ?? 'أطلق العنان لإمكانات ثروتك الكاملة') : ($appData->cta_subtitle_en ?? 'Unlock the full potential of your wealth');
        $ctaButton1Text = $locale == 'ar' ? ($appData->cta_button_1_text_ar ?? 'انضم إلى قائمة البريد الإلكتروني') : ($appData->cta_button_1_text_en ?? 'JOIN OUR MAILING LIST');
        $ctaButton1Url = $appData->cta_button_1_url ?? route('contact-us');
        $ctaButton2Text = $locale == 'ar' ? ($appData->cta_button_2_text_ar ?? 'اطلب اجتماعاً') : ($appData->cta_button_2_text_en ?? 'REQUEST A MEETING');
        $ctaButton2Url = $appData->cta_button_2_url ?? '/request-meeting';
        $ctaBackgroundImage = $appData->cta_background_image ? asset('storage/' . $appData->cta_background_image) : asset('design/images/meeting-bg.png');
      @endphp
    @if($appData?->isSectionVisible('cta') ?? true)
      @include('partials.cta-section', [
        'backgroundImage' => $ctaBackgroundImage,
        'backgroundAlt' => $locale == 'ar'
            ? ($appData->cta_background_image_alt_ar ?? $appData->cta_background_image_alt_en ?? strip_tags($ctaTitle))
            : ($appData->cta_background_image_alt_en ?? $appData->cta_background_image_alt_ar ?? strip_tags($ctaTitle)),
        'titleHtml' => nl2br(e($ctaTitle)),
        'descriptionHtml' => $ctaSubtitle,
        'buttonOneText' => $ctaButton1Text,
        'buttonOneUrl' => $ctaButton1Url,
        'buttonTwoText' => $ctaButton2Text,
        'buttonTwoUrl' => $ctaButton2Url,
      ])
    @endif

    @endsection
@php
    $websiteSettings = \App\Models\WebsiteSettings::getSettings();
    $currentLocale = app()->getLocale();
    $websiteTitle = $currentLocale === 'ar' ? $websiteSettings->website_title_ar : $websiteSettings->website_title_en;
    $seoMeta = $seoMeta ?? null;
    $localize = function ($en, $ar) use ($currentLocale) {
        return $currentLocale === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
    };
    $seoMetaTitle = $seoMeta ? $localize($seoMeta->meta_title_en, $seoMeta->meta_title_ar) : null;
    $seoOgTitle = $seoMeta ? $localize($seoMeta->og_title_en, $seoMeta->og_title_ar) : null;
    $seoH1Title = $seoMeta ? $localize($seoMeta->h1_en, $seoMeta->h1_ar) : null;
    $metaTitle = $seoMetaTitle ?: $seoOgTitle ?: $seoH1Title ?: $websiteTitle;
    $metaDescription = $seoMeta ? $localize($seoMeta->meta_description_en, $seoMeta->meta_description_ar) : null;
    $metaKeywords = $seoMeta ? $localize($seoMeta->meta_keywords_en, $seoMeta->meta_keywords_ar) : null;
    // Canonical reflects the current language version (includes /ar/ prefix for Arabic routes)
    $canonicalUrl = $seoMeta && $seoMeta->canonical_url ? $seoMeta->canonical_url : url()->current();
    $ogTitle = $seoOgTitle ?: $metaTitle;
    $ogDescription = $seoMeta ? $localize($seoMeta->og_description_en, $seoMeta->og_description_ar) : $metaDescription;
    $ogImagePath = $seoMeta && $seoMeta->og_image ? asset('storage/' . $seoMeta->og_image) : ($websiteSettings->favicon ? asset('storage/' . $websiteSettings->favicon) : asset('design/images/browser.svg'));
    $ogImageAlt = $seoMeta ? $localize($seoMeta->og_image_alt_en, $seoMeta->og_image_alt_ar) : $websiteTitle;
    $cleanText = function ($value) {
        return trim(preg_replace('/\s+/u', ' ', strip_tags((string) $value)));
    };


    $localBusiness =Spatie\SchemaOrg\Schema::localBusiness()
        ->name($websiteTitle)
        ->email('info@hauberkcapital.com')
        ->contactPoint(Spatie\SchemaOrg\Schema::contactPoint()->areaServed('Worldwide'));
            $schemaBlocks[] = $localBusiness->toScript();

    $filterSchema = function (array $schema) use (&$filterSchema) {
        $filtered = [];

        foreach ($schema as $key => $value) {
            if (is_array($value)) {
                if (array_is_list($value)) {
                    $items = [];

                    foreach ($value as $item) {
                        $items[] = is_array($item) ? $filterSchema($item) : $item;
                    }

                    $items = array_values(array_filter($items, fn ($item) => $item !== null && $item !== '' && $item !== []));

                    if ($items !== []) {
                        $filtered[$key] = $items;
                    }

                    continue;
                }

                $nested = $filterSchema($value);

                if ($nested !== []) {
                    $filtered[$key] = $nested;
                }

                continue;
            }

            if ($value !== null && $value !== '') {
                $filtered[$key] = $value;
            }
        }

        return $filtered;
    };
    $footerSettings = $websiteSettings->footer_settings ?? [];
    $logoUrl = $websiteSettings->header_logo ? asset('storage/' . $websiteSettings->header_logo) : asset('design/images/logo.svg');
    $socialUrls = collect($footerSettings['social_items'] ?? [])
        ->pluck('url')
        ->filter()
        ->values()
        ->all();
    $organizationReference = [
        '@type' => 'Organization',
        'name' => $websiteTitle ?: 'Hauberk Capital',
        'url' => url('/'),
    ];
    $schemaBlocks = [];
    $schemaBlocks[] = $filterSchema([
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $websiteTitle ?: 'Hauberk Capital',
        'url' => url('/'),
        'logo' => [
            '@type' => 'ImageObject',
            'url' => $logoUrl,
        ],
        'sameAs' => $socialUrls,
        'description' => $cleanText($metaDescription ?: $websiteTitle),
    ]);
    $schemaBlocks[] = $filterSchema([
        '@context' => 'https://schema.org',
        '@type' => request()->routeIs('home') ? 'WebSite' : 'WebPage',
        'name' => $metaTitle,
        'url' => $canonicalUrl,
        'description' => $cleanText($metaDescription),
        'inLanguage' => $currentLocale,
        'publisher' => $organizationReference,
    ]);

    $segments = request()->segments();
    if ($segments !== []) {
        $breadcrumbItems = [[
            '@type' => 'ListItem',
            'position' => 1,
            'name' => $websiteTitle ?: 'Home',
            'item' => route('home'),
        ]];
        $pathAccumulator = [];

        foreach ($segments as $index => $segment) {
            $pathAccumulator[] = $segment;
            $breadcrumbItems[] = [
                '@type' => 'ListItem',
                'position' => $index + 2,
                'name' => \Illuminate\Support\Str::of($segment)->replace(['-', '_'], ' ')->title()->toString(),
                'item' => url('/' . implode('/', $pathAccumulator)),
            ];
        }

        $schemaBlocks[] = $filterSchema([
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $breadcrumbItems,
        ]);
    }

    if (isset($blog)) {
        $schemaBlocks[] = $filterSchema([
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $localize($blog->title_en ?? null, $blog->title_ar ?? null) ?: $metaTitle,
            'description' => $cleanText($localize($blog->description_en ?? null, $blog->description_ar ?? null)),
            'image' => $blog->featured_image ? asset('storage/' . $blog->featured_image) : null,
            'datePublished' => optional($blog->created_at)->toAtomString(),
            'dateModified' => optional($blog->updated_at)->toAtomString(),
            'mainEntityOfPage' => $canonicalUrl,
            'author' => $organizationReference,
            'publisher' => array_merge($organizationReference, [
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $logoUrl,
                ],
            ]),
            'inLanguage' => $currentLocale,
        ]);
    }

    if (isset($caseStudy)) {
        $schemaBlocks[] = $filterSchema([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $localize($caseStudy->title_en ?? null, $caseStudy->title_ar ?? null) ?: $metaTitle,
            'description' => $cleanText($localize($caseStudy->description_en ?? null, $caseStudy->description_ar ?? null)),
            'image' => $caseStudy->featured_image ? asset('storage/' . $caseStudy->featured_image) : null,
            'datePublished' => optional($caseStudy->created_at)->toAtomString(),
            'dateModified' => optional($caseStudy->updated_at)->toAtomString(),
            'mainEntityOfPage' => $canonicalUrl,
            'author' => $organizationReference,
            'publisher' => array_merge($organizationReference, [
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $logoUrl,
                ],
            ]),
            'inLanguage' => $currentLocale,
        ]);
    }

    if (isset($article)) {
        $schemaBlocks[] = $filterSchema([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $localize($article['title_en'] ?? null, $article['title_ar'] ?? null) ?: $metaTitle,
            'description' => $cleanText($localize($article['description_en'] ?? null, $article['description_ar'] ?? null)),
            'image' => collect($article['main_image_article'] ?? [])->first(),
            'datePublished' => $article['created_at'] ?? null,
            'dateModified' => $article['updated_at'] ?? null,
            'mainEntityOfPage' => $canonicalUrl,
            'author' => $organizationReference,
            'publisher' => array_merge($organizationReference, [
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $logoUrl,
                ],
            ]),
            'inLanguage' => $currentLocale,
        ]);
    }

    if (isset($book)) {
        $schemaBlocks[] = $filterSchema([
            '@context' => 'https://schema.org',
            '@type' => 'Book',
            'name' => $localize($book['title_en'] ?? null, $book['title_ar'] ?? null) ?: $metaTitle,
            'description' => $cleanText($localize($book['description_en'] ?? null, $book['description_ar'] ?? null)),
            'image' => collect($book['main_image_book'] ?? [])->first(),
            'datePublished' => $book['created_at'] ?? null,
            'dateModified' => $book['updated_at'] ?? null,
            'url' => $canonicalUrl,
            'author' => $organizationReference,
            'inLanguage' => $currentLocale,
        ]);
    }

    if (isset($glossary)) {
        $schemaBlocks[] = $filterSchema([
            '@context' => 'https://schema.org',
            '@type' => 'DefinedTerm',
            'name' => $localize($glossary['title_en'] ?? null, $glossary['title_ar'] ?? null) ?: $metaTitle,
            'description' => $cleanText($localize($glossary['description_en'] ?? null, $glossary['description_ar'] ?? null)),
            'url' => $canonicalUrl,
            'inLanguage' => $currentLocale,
        ]);
    }
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $metaTitle }}</title>
    @if($metaDescription)
        <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($metaDescription), 160) }}">
    @endif
    @if($metaKeywords)
        <meta name="keywords" content="{{ $metaKeywords }}">
    @endif
    <link rel="canonical" href="{{ $canonicalUrl }}">
    @php
        $hreflangRouteName = Route::currentRouteName() ?? 'home';
        $hreflangIsArabic = str_starts_with($hreflangRouteName, 'ar.');
        $hreflangBase = $hreflangIsArabic ? substr($hreflangRouteName, 3) : $hreflangRouteName;
        $hreflangParams = request()->route() ? request()->route()->parameters() : [];
        try {
            $hreflangEn = route($hreflangBase, $hreflangParams);
        } catch (\Exception $e) {
            $hreflangEn = url('/');
        }
        try {
            $hreflangAr = route('ar.' . $hreflangBase, $hreflangParams);
        } catch (\Exception $e) {
            $hreflangAr = url('/ar');
        }
    @endphp
    <link rel="alternate" hreflang="en" href="{{$hreflangEn}}">
    <link rel="alternate" hreflang="ar" href="{{$hreflangAr}}">
    <link rel="alternate" hreflang="x-default" href="{{$hreflangEn}}">
    <meta property="og:title" content="{{ $ogTitle }}">
    @if($ogDescription)
        <meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($ogDescription), 200) }}">
    @endif
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $ogImagePath }}">
    <meta property="og:image:alt" content="{{ $ogImageAlt }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    @if($ogDescription)
        <meta name="twitter:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($ogDescription), 200) }}">
    @endif
    <meta name="twitter:image" content="{{ $ogImagePath }}">
    @if($websiteSettings->search_console_verification)
        <meta name="google-site-verification" content="{{ $websiteSettings->search_console_verification }}">
    @endif
    @foreach($schemaBlocks as $schemaBlock)
        <script type="application/ld+json">{!! json_encode($schemaBlock, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
    @endforeach

    @if($websiteSettings->gtm_id)
        <script>
            (function(w,d,s,l,i){
                w[l]=w[l]||[];
                w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});
                var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),
                    dl=l!='dataLayer'?'&l='+l:'';
                j.async=true;
                j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
                f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ $websiteSettings->gtm_id }}');
        </script>
    @endif

    @if($websiteSettings->google_analytics_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $websiteSettings->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $websiteSettings->google_analytics_id }}');
        </script>
    @endif

    @if($websiteSettings->facebook_pixel_id)
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $websiteSettings->facebook_pixel_id }}');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img loading="lazy" height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ $websiteSettings->facebook_pixel_id }}&ev=PageView&noscript=1" />
        </noscript>
    @endif

    @if($websiteSettings->twitter_pixel_id)
        <script>
            !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
            },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
            a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
            twq('config','{{ $websiteSettings->twitter_pixel_id }}');
        </script>
    @endif

    @if($websiteSettings->linkedin_pixel_id)
        <script type="text/javascript">
            _linkedin_partner_id = "{{ $websiteSettings->linkedin_pixel_id }}";
            window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
            window._linkedin_data_partner_ids.push(_linkedin_partner_id);
        </script>
        <script type="text/javascript">
            (function(){var s = document.getElementsByTagName('script')[0];
            var b = document.createElement('script');
            b.type = 'text/javascript';b.async = true;
            b.src = 'https://snap.licdn.com/li.lms-analytics/insight.min.js';
            s.parentNode.insertBefore(b, s);})();
        </script>
        <noscript>
            <img loading="lazy" height="1" width="1" style="display:none;" alt=""
                 src="https://px.ads.linkedin.com/collect/?pid={{ $websiteSettings->linkedin_pixel_id }}&fmt=gif" />
        </noscript>
    @endif

    @if($websiteSettings->tiktok_pixel_id)
        <script>
            !function (w, d, t) {
                w.TiktokAnalyticsObject = t;
                var ttq = w[t] = w[t] || [];
                ttq.methods = ['page','track','identify','instances','debug','on','off','once','ready','alias','group','enableCookie','disableCookie'];
                ttq.setAndDefer = function (t, e) {
                    t[e] = function () {
                        t.push([e].concat(Array.prototype.slice.call(arguments, 0)))
                    }
                };
                for (var i = 0; i < ttq.methods.length; i++)
                    ttq.setAndDefer(ttq, ttq.methods[i]);
                ttq.instance = function (t) {
                    var e = ttq._i[t] || [];
                    for (var n = 0; n < ttq.methods.length; n++)
                        ttq.setAndDefer(e, ttq.methods[n]);
                    return e
                };
                ttq.load = function (e, n) {
                    var i = 'https://analytics.tiktok.com/i18n/pixel/events.js';
                    ttq._i = ttq._i || {};
                    ttq._i[e] = [];
                    ttq._i[e]._u = i;
                    ttq._t = ttq._t || {};
                    ttq._t[e] = +new Date;
                    ttq._o = ttq._o || {};
                    ttq._o[e] = n || {};
                    var o = document.createElement('script');
                    o.type = 'text/javascript';
                    o.async = true;
                    o.src = i + '?sdkid=' + e + '&lib=' + t;
                    var a = document.getElementsByTagName('script')[0];
                    a.parentNode.insertBefore(o, a);
                };
                ttq.load('{{ $websiteSettings->tiktok_pixel_id }}');
                ttq.page();
            }(window, document, 'ttq');
        </script>
    @endif

    @if($websiteSettings->additional_head_scripts)
        {!! $websiteSettings->additional_head_scripts !!}
    @endif

    <!-- Favicon for all browsers -->
    @if($websiteSettings->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $websiteSettings->favicon) }}">
        <link rel="apple-touch-icon" href="{{ asset('storage/' . $websiteSettings->favicon) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="{{asset('design/images/browser.svg')}}">
        <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
        <link rel="apple-touch-icon" href="{{asset('design/images/browser.svg')}}">
    @endif

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Add Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'neue-bold': ['Neue-Bold'],
                        'neue-extrabold': ['Neue-ExtraBold'],
                    },
                },
            },
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Google reCAPTCHA v3 -->
    @php
        $recaptchaService = app(\App\Services\RecaptchaService::class);
        $siteKey = $recaptchaService->getSiteKey();
    @endphp
    @if($siteKey)
        <script src="https://www.google.com/recaptcha/api.js?render={{ $siteKey }}"></script>
    @endif
    <style>
        .grecaptcha-badge {
            visibility: hidden !important;
        }

        /* Global Typography Styles - with !important to override Tailwind utilities */
        p {
            font-family: 'Poppins', sans-serif !important;
            font-weight: 400;
            line-height: 1.7;
            font-size: 1.19125rem; /* 16px */
        }

        h1, h4, h5, h6 {
            font-family: 'Neue-Bold', 'Neue Haas Grotesk Display', sans-serif !important;
            font-weight: 800 !important;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        h1 {
                font-family: 'Neue-ExtraBold', 'Neue Haas Grotesk Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
                font-size: 3.25rem !important;
                font-weight: 800 !important;
                line-height: 5.438rem !important;
            }
            h2 {
                font-family: 'Neue-ExtraBold', 'Neue Haas Grotesk Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
                font-size: 2.5rem !important;
                font-weight: 700 !important;
            }
            h3 {
                font-family: 'Neue-ExtraBold', 'Neue Haas Grotesk Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
                font-size: 1.875rem !important;
                font-weight: 600 !important;
            }


        h4 {
            font-size: 1.5rem !important; /* 24px */
            font-weight: 600 !important;
        }

        h5 {
            font-size: 1.125rem !important; /* 20px */
            font-weight: 600 !important;
            font-family: 'Poppins', sans-serif !important;
        }

        h6 {
            font-size: 1rem !important; /* 18px */
            font-weight: 600 !important;
        }

        /* Responsive Typography */
        @media (max-width: 768px) {
            p {
                font-size: 1.0625rem; /* 17px */
            }
            h1 {
                font-size: 3rem !important; /* 48px */
                line-height: 1.35 !important;
            }
            h2 {
                line-height: 1.35 !important;
            }
            h3 {
                line-height: 1.3 !important;
            }

        }


        /* Custom font classes for easier use */
        .font-neue-bold {
            font-family: 'Neue-Bold', sans-serif !important;
            font-weight: bold;
        }

        .font-neue-extrabold {
            font-family: 'Neue-ExtraBold', sans-serif !important;
            font-weight: 800;
        }

        .bg-navy-900 {
            background-color: #1a1f2e;
        }
        .bg-navy-800 {
            background-color: #2a2f3e;
        }

        .font-sf-pro {
            font-family: 'SF Pro Display', sans-serif;
        }

        .font-sf-pro-medium {
            font-family: 'SF Pro Display', sans-serif;
            font-weight: 500;
        }

        .font-sf-pro-regular {
            font-family: 'SF Pro Display', sans-serif;
            font-weight: 400;
        }

        /* Preserve inline font sizes from RichEditor */
        span[style*="font-size"] {
            display: inline !important;
        }

        /* List Styles - Re-enable bullets and numbers (disabled by Tailwind) */


        ol {
            list-style-type: decimal;
            padding-left: 1.5em;
            margin-bottom: 1em;
            font-family: 'Poppins', sans-serif;
        }

        ul li, ol li {
            margin-bottom: 0.5em;
            padding-left: 0.25em;
        }

        /* Link Styles */
        a:hover {
            text-decoration: underline;
        }

        /* Blockquote */
        blockquote {
            border-left: 3px solid #D4AF37;
            padding-left: 1em;
            margin-left: 0;
            font-style: italic;
            opacity: 0.8;
        }

        /* Desktop-only Global Classes for Layout Reversal - Only for Arabic/RTL */

        /* Desktop-only Grid Row Reversal - Only when Arabic is active */
        @media (min-width: 1024px) {
            [lang="ar"] .desktop-reverse-grid {
                direction: rtl !important;
                text-align: right !important;
            }

            [lang="ar"] .desktop-reverse-grid > * {
                direction: ltr !important;
            }
        }

        /* Desktop-only RTL Flex Layout - Only when Arabic is active */
        @media (min-width: 1024px) {
            [lang="ar"] .desktop-reverse-flex {
                direction: rtl !important;
                text-align: right !important;
            }

            [lang="ar"] .desktop-reverse-flex > * {
                direction: ltr !important;
            }
        }

        /* Desktop-only Text Direction (Left to Right) - Only when Arabic is active */
        @media (min-width: 1024px) {
            [lang="ar"] .desktop-text-ltr {
                direction: ltr !important;
                text-align: left !important;
            }
        }

        /* Navigation Header Specific - Flex Row Reverse for Arabic Only */
        @media (min-width: 1024px) {
            [lang="ar"] .nav-header-reverse {
                flex-direction: row-reverse !important;
            }
        }

        /* Navigation Header Flex Elements - RTL Direction for Arabic Only */
        @media (min-width: 1024px) {
            [lang="ar"] .nav-header-flex {
                flex-direction: row-reverse !important;
            }

            [lang="ar"] .nav-header-flex > * {
                flex-direction: row-reverse !important;
            }
        }

        /* Override Tailwind lg:text-left to text-right for Arabic */
        @media (min-width: 1024px) {
            [lang="ar"] .md\:text-left,
            [lang="ar"] .md\:text-start,
            [lang="ar"] .lg\:text-left,
            [lang="ar"] .lg\:text-start {
                align-self: flex-end !important;
                text-align: right !important;
            }
        }


        /* Swap Tailwind Spacing Classes for Arabic */
        @media (min-width: 1024px) {
            /* All elements with pl- classes get padding-right instead of padding-left */
            [lang="ar"] [class*="pl-"] {
                padding-left: 0 !important;
            }

            /* All elements with pr- classes get padding-right instead of padding-left */
            [lang="ar"] [class*="pr-"] {
                padding-right: 0 !important;
            }

            /* All elements with ml- classes get margin-right instead of margin-left */
            [lang="ar"] [class*="ml-"] {
                margin-left: 0 !important;
            }

            /* All elements with mr- classes get margin-left instead of margin-right */
            [lang="ar"] [class*="mr-"] {
                margin-right: 0 !important;
            }
        }

        /* Remove Max Width for Arabic - Specific Class */
        @media (min-width: 1024px) {
            [lang="ar"] .remove-max-width {
                max-width: none !important;
            }
        }

        /* Align Specific Buttons to Right for Arabic */
        @media (min-width: 1024px) {
            [lang="ar"] .btn-rtl-align {
                justify-self: end !important;
            }
        }

    </style>
</head>
@php
    // Detail/article pages use a white page background like the blog inner template.
    $hasWhitePageBackground = request()->routeIs([
        'blog.show',
        'case-studies.show',
        'article.show',
        'book.show',
        'glossary.show',
        'white-papers.show',
        'cio-flash.show',
        'monday-window.show',
        'research.show',
        'ar.blog.show',
        'ar.case-studies.show',
        'ar.white-papers.show',
        'ar.cio-flash.show',
        'ar.monday-window.show',
        'ar.research.show',
    ]);
@endphp
<body class="{{ $hasWhitePageBackground ? 'bg-white' : 'bg-[#041B44]' }}">
@if($websiteSettings->gtm_id)
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $websiteSettings->gtm_id }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
@endif
@if($websiteSettings->additional_body_scripts)
    {!! $websiteSettings->additional_body_scripts !!}
@endif
    <!-- Navigation -->
    @include('layouts.nav')

    <!-- Main Content -->
    @yield('content')

    <!-- Disclaimer - Resource Center pages only -->
    @if(request()->routeIs([
        'blog', 'blog.show',
        'white-papers', 'white-papers.show',
        'cio-flash', 'cio-flash.show',
        'monday-window', 'monday-window.show',
        'research', 'research.show',
        'ar.blog', 'ar.blog.show',
        'ar.white-papers', 'ar.white-papers.show',
        'ar.cio-flash', 'ar.cio-flash.show',
        'ar.monday-window', 'ar.monday-window.show',
        'ar.research', 'ar.research.show',
    ]))
        @include('partials.disclaimer')
    @endif

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Newsletter Popup -->
    @include('components.newsletter-popup')
</body>
</html>

@php
    $websiteSettings = \App\Models\WebsiteSettings::getSettings();
    $currentLocale = app()->getLocale();
    $websiteTitle = $currentLocale === 'ar' ? $websiteSettings->website_title_ar : $websiteSettings->website_title_en;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $websiteTitle }}</title>

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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
    <style>
        /* Custom font classes for easier use */
        .font-neue-bold {
            font-family: 'Neue-Bold', sans-serif !important;
            font-weight: bold;
        }

        .font-neue-extrabold {
            font-family: 'Neue-ExtraBold', sans-serif !important;
            font-weight: 800;
        }

        .slide-1 { background-image: url('path/to/image1.jpg'); }
        .slide-2 { background-image: url('path/to/image2.jpg'); }
        .slide-3 { background-image: url('path/to/image3.jpg'); }
        .slide-overlay {
            background: rgba(26, 31, 46, 0.7);
        }
        .bg-navy-900 {
            background-color: #1a1f2e;
        }
        .bg-navy-800 {
            background-color: #2a2f3e;
        }
        /* Utility classes for easy application */
        .font-neue-bold {
            font-family: 'Neue-Bold', sans-serif;
        }

        .font-neue-extrabold {
            font-family: 'Neue-ExtraBold', sans-serif;
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
    </style>
</head>
<body class="bg-[#041B44]">


    <!-- Navigation -->
     @if($services != null)
    @include('layouts.nav', ['services' => $services])
    @endif
    <!-- Hero Section -->
    @if($element != null)

      <!-- @dump($element['sliders']);    -->
     @include('homePage.sliderSection', ['sliders' => $element['sliders']])

    @endif
    <!-- How We Can Assist services Section -->
     @if($services != null)

   @include('homePage.serviceSection', ['services' => $services])
   @endif
    <!-- Diversified Programs Section   DIVERSIFIED PROGRAMS FOR AN IDEAL PORTFOLIO-->
    @include('homePage.portofolioSection')
    <!-- Board of Directors Section -->
     @if($teams != null)

     @include('homePage.directorsSection', ['teams' => $teams])
     @endif
    <!-- Proven Track Record Section (ACHVIMENT) -->
     @if($achivements != null)

     @include('homePage.achvimentSection', ['achivements' => $achivements])
     @endif

    <!-- Road Map Section -->
     @if($element != null)

    @include('homePage.roadSection', ['element' => $element])
     @endif
    <!-- Insights Blogs Section -->
     @if($articles != null)
     <!-- @dump($articles); -->
     @include('homePage.InsightsSection', ['articles' => $articles])
     @endif
    <!-- Ready To Start Growing Section -->
    @include('homePage.growingSection')
    <!-- Footer -->
    @if($settings != null)


   @include('layouts.footer',[
    'settings' => $settings
    ])
 @endif


</body>
</html>

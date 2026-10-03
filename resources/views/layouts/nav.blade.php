<style>
    @media (max-width: 1023px) {
        .site-nav {
            padding: 0.75rem 1rem !important;
        }

        .site-header-bar {
            justify-content: space-between !important;
            gap: 1rem !important;
        }

        .site-logo {
            height: 2.25rem !important;
            max-width: 11rem;
            object-fit: contain;
        }

        #burger-menu {
            width: 2.75rem;
            height: 2.75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
        }

        #burger-menu i {
            font-size: 1.375rem !important;
        }

        #mobile-menu {
            margin-top: 0.75rem !important;
            padding: 0.875rem 1rem !important;
            max-height: calc(100vh - 5rem);
            overflow-y: auto;
        }

        #mobile-menu ul > :not([hidden]) ~ :not([hidden]) {
            margin-top: 0.75rem !important;
        }

        #mobile-menu a,
        #mobile-menu .site-mobile-lang {
            font-size: 0.9375rem !important;
            line-height: 1.4 !important;
        }

        #mobile-menu .site-mobile-dropdown a {
            font-size: 0.875rem !important;
            line-height: 1.35 !important;
            padding-top: 0.375rem !important;
            padding-bottom: 0.375rem !important;
        }
    }

    @media (min-width: 768px) and (max-width: 1023px) {
        .site-nav {
            padding: 1rem 2rem !important;
        }

        .site-logo {
            height: 2.75rem !important;
            max-width: 13rem;
        }

        #mobile-menu {
            padding: 1rem 1.25rem !important;
            max-width: 28rem;
            margin-left: auto;
        }

        #mobile-menu a,
        #mobile-menu .site-mobile-lang {
            font-size: 1rem !important;
        }
    }

    @media (min-width: 1024px) and (max-width: 1279px) {
        .site-nav {
            padding-inline: 1.25rem !important;
        }

        .site-header-bar {
            gap: 2rem !important;
        }

        .site-desktop-menu > ul {
            gap: 1rem !important;
        }

        .site-desktop-menu a {
            font-size: 0.75rem !important;
        }

        .site-logo {
            max-width: 10rem;
            object-fit: contain;
        }
    }

    @media (min-width: 1280px) {
        .site-nav {
            padding-inline: clamp(2rem, 4vw, 4rem) !important;
        }

        .site-header-bar {
            gap: clamp(2.5rem, 6vw, 7.5rem) !important;
            max-width: 1440px;
        }

        .site-desktop-menu > ul {
            gap: clamp(1rem, 1.6vw, 1.5rem) !important;
        }

        .site-desktop-menu a {
            font-size: clamp(0.82rem, 0.8vw, 0.973rem) !important;
            line-height: 1.35 !important;
        }

        .site-desktop-menu .group > a {
            white-space: nowrap;
        }

        .site-logo {
            max-width: clamp(10rem, 13vw, 14rem);
            object-fit: contain;
        }
    }
</style>

<header class="site-header fixed w-full z-50 ">
        <nav class="site-nav
        @if(
            Request::routeIs('books') ||
            Request::routeIs('articles') ||
            Request::routeIs('glossaries') ||
            Request::routeIs('blog.show') ||
            Request::routeIs('case-studies.show') ||
            Request::routeIs('article.show') ||
            Request::routeIs('book.show') ||
            Request::routeIs('glossary.show') ||
            Request::routeIs('white-papers.show') ||
            Request::routeIs('cio-flash.show') ||
            Request::routeIs('monday-window.show') ||
            Request::routeIs('research.show')
        )
            bg-[#041B44]
        @else
            @if(isset($websiteSettings))
                @php
                    $currentPage = 'homepage'; // Default
                    if (Request::routeIs('home')) $currentPage = 'homepage';
                    elseif (Request::routeIs('about-us')) $currentPage = 'about_us';
                    elseif (Request::routeIs('services')) $currentPage = 'services';
                    elseif (Request::routeIs('app')) $currentPage = 'app';
                    elseif (Request::routeIs('teams.*')) $currentPage = 'teams';
                    elseif (Request::routeIs('articles.*')) $currentPage = 'articles';
                    elseif (Request::routeIs('books.*')) $currentPage = 'books';
                    elseif (Request::routeIs('glossaries.*')) $currentPage = 'glossaries';
                    elseif (Request::routeIs('tools.*')) $currentPage = 'tools';
                    elseif (Request::routeIs('faq')) $currentPage = 'faq';
                    elseif (Request::routeIs('contact-us')) $currentPage = 'contact_us';
                    elseif (Request::routeIs('resource-center')) $currentPage = 'resource_center';
                @endphp
                {{ $websiteSettings->getPageHeaderBackgroundClasses($currentPage) }}
            @else
                bg-black/20
            @endif
        @endif
        @if(isset($websiteSettings) && $websiteSettings->header_backdrop_blur)
            backdrop-blur-sm
        @endif
        text-white py-4 px-6">
            <p class="w-full mx-auto">
                <!-- Desktop and Mobile header -->
                <div class="site-header-bar flex justify-center gap-[10em] items-center w-full mx-auto nav-header-reverse">
                    <div>
                        <a href="/">
                            @if(isset($websiteSettings) && $websiteSettings->header_logo)
                                <img loading="eager" src="{{ asset('storage/' . $websiteSettings->header_logo) }}" alt="{{ app()->getLocale() == 'ar' ? $websiteSettings->website_title_ar : $websiteSettings->website_title_en }}" class="site-logo h-8 sm:h-10 md:h-12 lg:h-full">
                            @else
                                <img loading="eager" src="{{asset('design')}}/images/logo.svg" alt="{{ app()->getLocale() == 'ar' ? $websiteSettings->website_title_ar : $websiteSettings->website_title_en }}" class="site-logo h-8 sm:h-10 md:h-12 lg:h-full">
                            @endif
                        </a>
                    </div>
                    <!-- Burger Menu Button -->
                    <button id="burger-menu" class="lg:hidden text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                    <!-- Desktop Menu -->
                    <div class="site-desktop-menu hidden lg:flex items-center space-x-6 nav-header-flex">
                        <ul class="flex items-center gap-[1.5rem] nav-header-reverse">
                            @if(isset($websiteSettings) && $websiteSettings->navigation_links)
                                @foreach($websiteSettings->navigation_links as $navItem)
                                    @php
                                        $dropdownItems = collect($navItem['dropdown_items'] ?? [])
                                            ->filter(fn($d) => !empty($d['route']))
                                            ->values();
                                        $hasDropdown = ($navItem['has_dropdown'] ?? false) && $dropdownItems->isNotEmpty();
                                    @endphp
                                    <li class="group relative nav-header-flex desktop-text-ltr">
                                        <a href="{{ route($navItem['route']) }}" class="text-[0.8rem] xl:text-[0.973rem] hover:text-gray-300 flex items-center gap-3 font-['Poppins'] nav-header-flex desktop-text-ltr">
                                            {{ app()->getLocale() == 'ar' ? ($navItem['title_ar'] ?? $navItem['title_en']) : $navItem['title_en'] }}
                                            @if($hasDropdown)
                                                <i class="fas fa-caret-down text-[0.9375rem] transition-transform duration-200 group-hover:rotate-180 flex items-center nav-header-flex"></i>
                                            @endif
                                        </a>
                                        @if($hasDropdown)
                                            <div class="absolute top-full left-0 hidden group-hover:block bg-[#1a1f2e] min-w-[200px] py-2 z-50 shadow-lg">
                                                @foreach($dropdownItems as $dropdownItem)
                                                    <a href="{{ route($dropdownItem['route']) }}" class="block px-4 py-2 text-[0.8rem] hover:bg-[#D4AF37] hover:text-white font-['Poppins']">
                                                        {{ app()->getLocale() == 'ar' ? ($dropdownItem['title_ar'] ?? $dropdownItem['title_en']) : $dropdownItem['title_en'] }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <!-- Fallback navigation if no settings -->
                                <li class="group relative nav-header-flex desktop-text-ltr">
                                    <a href="{{route('home')}}" class="text-[0.8rem] xl:text-[0.973rem] hover:text-gray-300 flex items-center gap-3 font-['Poppins'] nav-header-flex desktop-text-ltr">
                                        Home
                                    </a>
                                </li>
                                <li class="group relative desktop-reverse-flex desktop-text-ltr">
                                    <a href="{{route('about-us')}}" class="text-[0.8rem] xl:text-[0.973rem] hover:text-gray-300 flex items-center gap-3 font-['Poppins'] nav-header-flex desktop-text-ltr">
                                        About us
                                        <i class="fas fa-caret-down text-[0.9375rem] transition-transform duration-200 group-hover:rotate-180 flex items-center nav-header-flex"></i>
                                    </a>
                                    <div class="absolute top-full left-0 hidden group-hover:block bg-[#1a1f2e] min-w-[200px] py-2 z-50 shadow-lg">
                                        <a href="{{route('teams')}}" class="block px-4 py-2 text-[0.8rem] hover:bg-[#D4AF37] hover:text-white font-['Poppins']">Board of Directors</a>
                                        <a href="{{route('app')}}" class="block px-4 py-2 text-[0.8rem] hover:bg-[#D4AF37] hover:text-white font-['Poppins']">App</a>
                                    </div>
                                </li>
                                <li class="group relative nav-header-flex desktop-text-ltr">
                                    <a href="{{route('services')}}" class="text-[0.8rem] xl:text-[0.973rem] hover:text-gray-300 flex items-center gap-3 font-['Poppins'] nav-header-flex desktop-text-ltr">
                                        Services
                                        <i class="fas fa-caret-down text-[0.9375rem] transition-transform duration-200 group-hover:rotate-180 flex items-center nav-header-flex"></i>
                                    </a>
                                    <div class="absolute top-full left-0 hidden group-hover:block bg-[#1a1f2e] min-w-[200px] py-2 z-50 shadow-lg">
                                        <a href="{{route('governance-services')}}" class="block px-4 py-2 text-[0.8rem] hover:bg-[#D4AF37] hover:text-white font-['Poppins']">
                                            Governance Services
                                        </a>
                                        @isset($services)
                                            @foreach($services as $service)
                                                <a href="{{route('services')}}" class="block px-4 py-2 text-[0.8rem] hover:bg-[#D4AF37] hover:text-white font-['Poppins']">
                                                    {!! $service['title_en'] !!}
                                                </a>
                                            @endforeach
                                        @endisset
                                    </p>
                                </li>
                                <li class="group relative nav-header-flex desktop-text-ltr">
                                    <a href="{{route('resources-center')}}" class="text-[0.8rem] xl:text-[0.973rem] hover:text-gray-300 flex items-center gap-3 font-['Poppins'] nav-header-flex desktop-text-ltr">
                                        Resources Center
                                        <i class="fas fa-caret-down text-[0.9375rem] transition-transform duration-200 group-hover:rotate-180 flex items-center nav-header-flex"></i>
                                    </a>
                                    <div class="absolute top-full left-0 hidden group-hover:block bg-[#1a1f2e] min-w-[200px] py-2 z-50 shadow-lg">
                                        <a href="{{route('blog')}}" class="block px-4 py-2 text-[0.8rem] hover:bg-[#D4AF37] hover:text-white font-['Poppins']">{{ app()->getLocale() == 'ar' ? 'المدونة' : 'Blog / News' }}</a>
                                        <a href="{{route('white-papers')}}" class="block px-4 py-2 text-[0.8rem] hover:bg-[#D4AF37] hover:text-white font-['Poppins']">{{ app()->getLocale() == 'ar' ? 'الأوراق البيضاء' : 'White Papers' }}</a>
                                        <a href="{{route('cio-flash')}}" class="block px-4 py-2 text-[0.8rem] hover:bg-[#D4AF37] hover:text-white font-['Poppins']">CIO Flash</a>
                                        <a href="{{route('monday-window')}}" class="block px-4 py-2 text-[0.8rem] hover:bg-[#D4AF37] hover:text-white font-['Poppins']">{{ app()->getLocale() == 'ar' ? 'نافذة الاثنين' : 'Monday Window' }}</a>
                                        <a href="{{route('research')}}" class="block px-4 py-2 text-[0.8rem] hover:bg-[#D4AF37] hover:text-white font-['Poppins']">{{ app()->getLocale() == 'ar' ? 'الأبحاث' : 'Research' }}</a>
                                    </div>
                                </li>
                                <li class="group relative nav-header-flex desktop-text-ltr">
                                    <a href="{{route('contact-us')}}" class="text-[0.8rem] xl:text-[0.973rem] hover:text-gray-300 flex items-center gap-3 font-['Poppins'] nav-header-flex desktop-text-ltr">
                                        Contact Us
                                    </a>
                                </li>
                            @endif

                            @if(isset($websiteSettings) && $websiteSettings->show_language_switcher)
                            @php
                                $currentRouteName = Route::currentRouteName() ?? 'home';
                                $isArabic = str_starts_with($currentRouteName, 'ar.');
                                $baseRouteName = $isArabic ? substr($currentRouteName, 3) : $currentRouteName;
                                $routeParams = request()->route() ? request()->route()->parameters() : [];
                                try {
                                    $enUrl = route($baseRouteName, $routeParams);
                                } catch (\Exception $e) {
                                    $enUrl = url('/');
                                }
                                try {
                                    $arUrl = route('ar.' . $baseRouteName, $routeParams);
                                } catch (\Exception $e) {
                                    $arUrl = url('/ar');
                                }
                            @endphp
                            <div class="flex items-center space-x-2 ml-6 pl-6 text-[0.75rem] sm:text-[0.875rem] font-['Poppins']">
                                <a href="{{$enUrl}}"
                                   class="{{!$isArabic ? 'text-white' : 'text-[#BF9874]'}} hover:text-white transition-colors duration-200">EN</a>
                                <span class="text-[#BF9874]">|</span>
                                <a href="{{$arUrl}}"
                                   class="{{$isArabic ? 'text-white' : 'text-[#BF9874]'}} hover:text-white transition-colors duration-200">AR</a>
                            </div>
                            @endif


                        </ul>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div id="mobile-menu" class="lg:hidden hidden mt-4 p-4 rounded" style="background-color: {{ (isset($websiteSettings) && $websiteSettings->mobile_menu_background_color) ? $websiteSettings->mobile_menu_background_color : '#1a1f2e' }};">
                    <ul class="flex flex-col space-y-4 desktop-reverse-flex">
                        @if(isset($websiteSettings) && $websiteSettings->navigation_links)
                            @foreach($websiteSettings->navigation_links as $navItem)
                                @php
                                    $mobileDropdownItems = collect($navItem['dropdown_items'] ?? [])
                                        ->filter(fn($d) => !empty($d['route']))
                                        ->values();
                                    $mobileHasDropdown = ($navItem['has_dropdown'] ?? false) && $mobileDropdownItems->isNotEmpty();
                                @endphp
                                <li class="group">
                                    @if($mobileHasDropdown)
                                        <div class="flex items-center justify-between desktop-reverse-flex">
                                            <a href="{{ route($navItem['route']) }}" class="text-base hover:text-gray-300 font-['Poppins'] desktop-text-ltr">
                                                {{ app()->getLocale() == 'ar' ? ($navItem['title_ar'] ?? $navItem['title_en']) : $navItem['title_en'] }}
                                            </a>
                                            <i class="fas fa-caret-down text-[0.9375rem] transition-transform duration-200 cursor-pointer desktop-reverse-flex" onclick="toggleDropdown(this)"></i>
                                        </div>
                                        <div class="site-mobile-dropdown hidden pl-4 mt-2">
                                            @foreach($mobileDropdownItems as $dropdownItem)
                                                <a href="{{ route($dropdownItem['route']) }}" class="block py-2 text-[0.8rem] hover:text-[#D4AF37] font-['Poppins']">
                                                    {{ app()->getLocale() == 'ar' ? ($dropdownItem['title_ar'] ?? $dropdownItem['title_en']) : $dropdownItem['title_en'] }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <a href="{{ route($navItem['route']) }}" class="text-base hover:text-gray-300 flex items-center justify-between font-['Poppins'] desktop-reverse-flex desktop-text-ltr">
                                            {{ app()->getLocale() == 'ar' ? ($navItem['title_ar'] ?? $navItem['title_en']) : $navItem['title_en'] }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        @else
                            <!-- Fallback mobile navigation -->
                            <li class="group">
                                <a href="{{route('home')}}" class="text-base hover:text-gray-300 flex items-center justify-between font-['Poppins'] desktop-reverse-flex desktop-text-ltr">
                                    Home
                                </a>
                            </li>
                            <li class="group">
                                <div class="flex items-center justify-between desktop-reverse-flex">
                                    <a href="{{route('about-us')}}" class="text-base hover:text-gray-300 font-['Poppins'] desktop-text-ltr">About us</a>
                                    <i class="fas fa-caret-down text-[0.9375rem] transition-transform duration-200 cursor-pointer desktop-reverse-flex" onclick="toggleDropdown(this)"></i>
                                </div>
                                <div class="site-mobile-dropdown hidden pl-4 mt-2">
                                    <a href="{{route('teams')}}" class="block py-2 text-[0.8rem] hover:text-[#D4AF37] font-['Poppins']">Board of Directors</a>
                                    <a href="{{route('app')}}" class="block py-2 text-[0.8rem] hover:text-[#D4AF37] font-['Poppins']">App</a>
                                </div>
                            </li>
                            <li class="group">
                                <div class="flex items-center justify-between desktop-reverse-flex">
                                    <a href="{{route('services')}}" class="text-base hover:text-gray-300 font-['Poppins'] desktop-text-ltr">Services</a>
                                    <i class="fas fa-caret-down text-[0.9375rem] transition-transform duration-200 cursor-pointer desktop-reverse-flex" onclick="toggleDropdown(this)"></i>
                                </div>
                                <div class="site-mobile-dropdown hidden pl-4 mt-2">
                                    <a href="{{route('governance-services')}}" class="block py-2 text-[0.8rem] hover:text-[#D4AF37] font-['Poppins']">Governance Services</a>
                                    @isset($services)
                                        @foreach($services as $service)
                                            <a href="{{route('services')}}" class="block py-2 text-[0.8rem] hover:text-[#D4AF37] font-['Poppins']">{{$service['title_en']}}</a>
                                        @endforeach
                                    @endisset
                                </div>
                            </li>
                            <li class="group">
                                <div class="flex items-center justify-between desktop-reverse-flex">
                                    <a href="{{route('resources-center')}}" class="text-base hover:text-gray-300 font-['Poppins'] desktop-text-ltr">Resources Center</a>
                                    <i class="fas fa-caret-down text-[0.9375rem] transition-transform duration-200 cursor-pointer desktop-reverse-flex" onclick="toggleDropdown(this)"></i>
                                </div>
                                <div class="site-mobile-dropdown hidden pl-4 mt-2">
                                    <a href="{{route('blog')}}" class="block py-2 text-[0.8rem] hover:text-[#D4AF37] font-['Poppins']">{{ app()->getLocale() == 'ar' ? 'المدونة' : 'Blog / News' }}</a>
                                    <a href="{{route('white-papers')}}" class="block py-2 text-[0.8rem] hover:text-[#D4AF37] font-['Poppins']">{{ app()->getLocale() == 'ar' ? 'الأوراق البيضاء' : 'White Papers' }}</a>
                                    <a href="{{route('cio-flash')}}" class="block py-2 text-[0.8rem] hover:text-[#D4AF37] font-['Poppins']">CIO Flash</a>
                                    <a href="{{route('monday-window')}}" class="block py-2 text-[0.8rem] hover:text-[#D4AF37] font-['Poppins']">{{ app()->getLocale() == 'ar' ? 'نافذة الاثنين' : 'Monday Window' }}</a>
                                    <a href="{{route('research')}}" class="block py-2 text-[0.8rem] hover:text-[#D4AF37] font-['Poppins']">{{ app()->getLocale() == 'ar' ? 'الأبحاث' : 'Research' }}</a>
                                </div>
                            </li>
                            <li class="group">
                                <a href="{{route('contact-us')}}" class="text-base hover:text-gray-300 flex items-center justify-between font-['Poppins'] desktop-reverse-flex desktop-text-ltr">
                                    Contact Us
                                </a>
                            </li>
                        @endif

                        @if(isset($websiteSettings) && $websiteSettings->show_language_switcher)
                        @php
                            $currentRouteNameMobile = Route::currentRouteName() ?? 'home';
                            $isArabicMobile = str_starts_with($currentRouteNameMobile, 'ar.');
                            $baseRouteNameMobile = $isArabicMobile ? substr($currentRouteNameMobile, 3) : $currentRouteNameMobile;
                            $routeParamsMobile = request()->route() ? request()->route()->parameters() : [];
                            try {
                                $enUrlMobile = route($baseRouteNameMobile, $routeParamsMobile);
                            } catch (\Exception $e) {
                                $enUrlMobile = url('/');
                            }
                            try {
                                $arUrlMobile = route('ar.' . $baseRouteNameMobile, $routeParamsMobile);
                            } catch (\Exception $e) {
                                $arUrlMobile = url('/ar');
                            }
                        @endphp
                        <div class="site-mobile-lang flex items-center space-x-2 py-2 text-base font-['Poppins'] desktop-reverse-flex">
                            <a href="{{$enUrlMobile}}"
                               class="{{!$isArabicMobile ? 'text-white' : 'text-[#BF9874]'}} hover:text-[#FFFFFF] desktop-text-ltr transition-colors duration-200">EN</a>
                            <span class="text-[#BF9874]">|</span>
                            <a href="{{$arUrlMobile}}"
                               class="{{$isArabicMobile ? 'text-white' : 'text-[#BF9874]'}} hover:text-[#FFFFFF] desktop-text-ltr transition-colors duration-200">AR</a>
                        </div>
                        @endif


                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <script>
    // Mobile menu functionality is handled by the main index.js file
    // Optional: handle dropdowns inside mobile menu
    function toggleDropdown(icon) {
        const dropdown = icon.parentElement.nextElementSibling;
        dropdown.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>

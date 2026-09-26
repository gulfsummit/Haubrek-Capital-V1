@if(isset($websiteSettings) && $websiteSettings->footer_settings)
    @php
        $footer = $websiteSettings->footer_settings;
        $isArabic = app()->getLocale() === 'ar';

        // Ensure default values are set if not provided
        $footer['background_color'] = $footer['background_color'] ?? '#041B44';
        $footer['text_color'] = $footer['text_color'] ?? '#FFFFFF';
        $footer['accent_color'] = $footer['accent_color'] ?? '#D4AF37';
        $footer['show_logo_mobile'] = $footer['show_logo_mobile'] ?? true;
        $footer['show_services_dynamically'] = $footer['show_services_dynamically'] ?? true;
        $footer['show_app_download'] = $footer['show_app_download'] ?? true;
        $footer['show_newsletter'] = $footer['show_newsletter'] ?? true;
        $footer['show_current_year'] = $footer['show_current_year'] ?? true;

        // Social section - no defaults, only use if provided
        $footer['facebook'] = $footer['facebook'] ?? '#';
        $footer['instagram'] = $footer['instagram'] ?? '#';
        $footer['linkedin'] = $footer['linkedin'] ?? '#';
        $footer['twitter'] = $footer['twitter'] ?? '#';
        $footer['youtube'] = $footer['youtube'] ?? '#';

        // App download defaults
        $footer['app_download_text_en'] = $footer['app_download_text_en'] ?? 'Download App';
        $footer['app_download_text_ar'] = $footer['app_download_text_ar'] ?? 'تحميل التطبيق';
        $footer['ios_app_link'] = $footer['ios_app_link'] ?? '#';
        $footer['android_app_link'] = $footer['android_app_link'] ?? '#';

        // Newsletter defaults
        $footer['newsletter_placeholder_en'] = $footer['newsletter_placeholder_en'] ?? 'Subscribe to Our Newsletter';
        $footer['newsletter_placeholder_ar'] = $footer['newsletter_placeholder_ar'] ?? 'اشترك في نشرتنا الإخبارية';
        $footer['newsletter_button_text_en'] = $footer['newsletter_button_text_en'] ?? 'Subscribe';
        $footer['newsletter_button_text_ar'] = $footer['newsletter_button_text_ar'] ?? 'اشترك';

        // Copyright defaults
        $footer['company_name'] = $footer['company_name'] ?? 'Hauberk Capital';
        $footer['regulation_text'] = $footer['regulation_text'] ?? '';
        $footer['regulation_text_ar'] = $footer['regulation_text_ar'] ?? '';

        // Policy links defaults
        $footer['privacy_policy_text_en'] = $footer['privacy_policy_text_en'] ?? 'Privacy Policy';
        $footer['privacy_policy_text_ar'] = $footer['privacy_policy_text_ar'] ?? 'سياسة الخصوصية';
        $footer['privacy_policy_url'] = $footer['privacy_policy_url'] ?? 'privacy-policy.html';
        $footer['terms_conditions_text_en'] = $footer['terms_conditions_text_en'] ?? 'Terms & Conditions';
        $footer['terms_conditions_text_ar'] = $footer['terms_conditions_text_ar'] ?? 'الشروط والأحكام';
        $footer['terms_conditions_url'] = $footer['terms_conditions_url'] ?? 'terms-conditions.html';
        $footer['cookie_policy_text_en'] = $footer['cookie_policy_text_en'] ?? 'Cookie Policy';
        $footer['cookie_policy_text_ar'] = $footer['cookie_policy_text_ar'] ?? 'سياسة ملفات تعريف الارتباط';
        $footer['cookie_policy_url'] = $footer['cookie_policy_url'] ?? 'cookie-policy.html';

        $copyrightText = "© " . ($footer['show_current_year'] ? '<script>document.write(new Date().getFullYear())</script>' : '') . " " . ($footer['company_name'] ?? 'Company') . ", All rights reserved.";
        $regulationText = $isArabic
            ? ($footer['regulation_text_ar'] ?? '')
            : ($footer['regulation_text'] ?? '');
    @endphp

    <style>
        @media (max-width: 767px) {
            .site-footer {
                padding-top: 1.75rem !important;
                padding-bottom: 1.75rem !important;
            }

            .site-footer-container {
                padding-inline: 1.25rem !important;
            }

            .site-footer-logo {
                margin-bottom: 1.25rem !important;
            }

            .site-footer-logo img {
                max-width: 10.5rem;
                max-height: 2.75rem;
                object-fit: contain;
            }

            .site-footer-mobile-accordion .border-b > .flex {
                padding-top: 0.875rem !important;
                padding-bottom: 0.875rem !important;
            }

            .site-footer-mobile-accordion p {
                margin-bottom: 0 !important;
                font-size: 1rem !important;
                line-height: 1.3 !important;
            }

            .site-footer-mobile-accordion .dropdown-content {
                padding-bottom: 0.875rem !important;
            }

            .site-footer-mobile-accordion .dropdown-content a,
            .site-footer-mobile-accordion .dropdown-content span {
                font-size: 0.9375rem !important;
                line-height: 1.45 !important;
            }

            .site-footer-mobile-accordion .dropdown-content ul {
                gap: 0.5rem !important;
            }

            .site-footer-app-download {
                width: 10rem !important;
                height: 3rem !important;
            }

            .site-footer-app-download img {
                width: 2rem !important;
                height: 2rem !important;
            }

            .site-footer-policy-links {
                padding-top: 1.25rem !important;
                margin-bottom: 1.5rem !important;
            }

            .site-footer-policy-links a,
            .site-footer-policy-links span {
                font-size: 0.8125rem !important;
                line-height: 1.5 !important;
            }

            .site-footer-newsletter {
                margin-top: 1.5rem !important;
                margin-bottom: 1.75rem !important;
            }

            .site-footer-newsletter input,
            .site-footer-newsletter a {
                font-size: 0.875rem !important;
            }

            .site-footer-copyright {
                font-size: 0.8125rem !important;
                line-height: 1.55 !important;
            }
        }

        @media (min-width: 768px) and (max-width: 1023px) {
            .site-footer-container {
                max-width: 720px !important;
                padding-inline: 2rem !important;
            }

            .site-footer-desktop {
                gap: 2rem !important;
                margin-bottom: 2.5rem !important;
            }

            .site-footer-desktop p {
                margin-bottom: 0 !important;
                font-size: 1rem !important;
                line-height: 1.35 !important;
            }

            .site-footer-desktop ul {
                gap: 0.5rem !important;
            }

            .site-footer-desktop a,
            .site-footer-desktop span {
                font-size: 0.875rem !important;
                line-height: 1.45 !important;
            }

            .site-footer-newsletter {
                width: 70% !important;
            }

            .site-footer-bottom {
                align-items: flex-start !important;
                gap: 1rem !important;
                font-size: 0.8125rem !important;
            }

            .site-footer-bottom > * {
                min-width: 0 !important;
            }
        }

        @media (min-width: 1024px) and (max-width: 1279px) {
            .site-footer-container {
                max-width: 980px !important;
                padding-inline: 2rem !important;
            }

            .site-footer-desktop {
                gap: 2rem !important;
            }

            .site-footer-desktop p {
                font-size: 1rem !important;
            }

            .site-footer-bottom {
                gap: 1.25rem !important;
                font-size: 0.8125rem !important;
            }

            .site-footer-bottom > * {
                min-width: 0 !important;
            }

            .site-footer-policy-desktop {
                gap: 0.75rem !important;
            }
        }

        @media (min-width: 1280px) {
            .site-footer-container {
                max-width: 1300px !important;
                padding-inline: clamp(2rem, 3vw, 3rem) !important;
            }

            .site-footer-desktop {
                gap: clamp(2rem, 3vw, 3rem) !important;
            }

            .site-footer-desktop p {
                font-size: 1.0625rem !important;
                line-height: 1.35 !important;
            }

            .site-footer-bottom {
                gap: 1.5rem !important;
                font-size: 0.875rem !important;
            }

            .site-footer-bottom > * {
                min-width: 0 !important;
            }

            .site-footer-policy-desktop {
                flex-wrap: wrap;
                gap: 0.75rem !important;
            }
        }
    </style>

    <footer class="site-footer py-8" style="background-color: {{ $footer['background_color'] }}; color: {{ $footer['text_color'] }};" dir="{{ $isArabic ? 'rtl' : 'ltr' }}">
        <div class="site-footer-container w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-8 lg:px-0">
            <!-- Logo for mobile -->
            @if($footer['show_logo_mobile'])
            <div class="site-footer-logo block md:hidden mb-6">
                @if(isset($footer['logo_image']) && $footer['logo_image'])
                    <img src="{{ asset('storage/' . $footer['logo_image']) }}" alt="{{ $footer['company_name'] ?? 'Company' }}" class="">
                @else
                    <img src="{{asset('design')}}/images/logo.svg" alt="{{ $footer['company_name'] ?? 'Company' }}" class="">
                @endif
            </div>
            @endif

            <!-- Mobile navigation accordion -->
            <div class="site-footer-mobile-accordion md:hidden">
                <!-- Home dropdown -->
                @if((isset($footer['home_section_title_en']) && $footer['home_section_title_en']) || (isset($footer['home_section_title_ar']) && $footer['home_section_title_ar']) || (isset($footer['home_items']) && is_array($footer['home_items']) && count($footer['home_items']) > 0))
                <div class="border-b border-[#1A2F57]">
                    <div class="flex justify-between items-center py-4">
                        <div class="text-[20.96px] font-sf-pro-medium"><p style="color: {{ $footer['accent_color'] }};">
                            {{ app()->getLocale() == 'ar' ? ($footer['home_section_title_ar'] ?? 'الرئيسية') : ($footer['home_section_title_en'] ?? 'Home') }}
                        </p></div>
                        <button class="text-white dropdown-toggle">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    <ul class="hidden dropdown-content pb-4 space-y-3 text-sm">
                        @if(isset($footer['home_items']) && is_array($footer['home_items']))
                            @foreach($footer['home_items'] as $item)
                                @if(isset($item['title_en']) && $item['title_en'])
                                <li><a href="{{ route($item['url']) }}" class="text-white text-xl font-sf-pro-regular">
                                    {{ app()->getLocale() == 'ar' ? ($item['title_ar'] ?? $item['title_en']) : $item['title_en'] }}
                                </a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
                @endif

                <!-- Services & Programs dropdown -->
                @if((isset($footer['services_section_title_en']) && $footer['services_section_title_en']) || (isset($footer['services_section_title_ar']) && $footer['services_section_title_ar']) || (isset($footer['services_items']) && is_array($footer['services_items']) && count($footer['services_items']) > 0))
                <div class="border-b border-[#1A2F57]">
                    <div class="flex justify-between items-center py-4">
                        <div class="text-[20.96px] font-sf-pro-medium"><p style="color: {{ $footer['accent_color'] }};">
                            {{ app()->getLocale() == 'ar' ? ($footer['services_section_title_ar'] ?? 'الخدمات والبرامج') : ($footer['services_section_title_en'] ?? 'Services & Programs') }}
                        </p></div>
                        <button class="text-white dropdown-toggle">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    <ul class="hidden dropdown-content pb-4 space-y-3 text-sm">
                        @if(isset($footer['services_items']) && is_array($footer['services_items']))
                            @foreach($footer['services_items'] as $item)
                                @if(isset($item['title_en']) && $item['title_en'])
                                <li><a href="{{ route($item['url']) }}" class="text-white text-xl font-sf-pro-regular">
                                    {{ app()->getLocale() == 'ar' ? ($item['title_ar'] ?? $item['title_en']) : $item['title_en'] }}
                                </a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
                @endif

                <!-- Contact Us dropdown -->
                @if(isset($footer['phone']) && $footer['phone'] || isset($footer['email']) && $footer['email'] || isset($footer['address']) && $footer['address'])
                <div class="border-b border-[#1A2F57]">
                    <div class="flex justify-between items-center py-4">
                        <div class="text-[20.96px] font-sf-pro-medium"><p style="color: {{ $footer['accent_color'] }};">
                            {{ app()->getLocale() == 'ar' ? ($footer['contact_section_title_ar'] ?? 'اتصل بنا') : ($footer['contact_section_title_en'] ?? 'Contact Us') }}
                        </p></div>
                        <button class="text-white dropdown-toggle">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    <ul class="hidden dropdown-content pb-4 space-y-3 text-xl {{ $isArabic ? 'text-right' : '' }}">
                        @if(isset($footer['phone']) && $footer['phone'])
                        <li class="flex items-start gap-2">
                            <img src="{{asset('design')}}/images/phone.svg" class="w-6 h-6 mt-1" alt="Phone icon">
                            <span class="font-sf-pro-regular {{ $isArabic ? 'text-right' : '' }}" @if($isArabic) dir="ltr" style="unicode-bidi: plaintext;" @endif>{{ $footer['phone'] }}</span>
                        </li>
                        @endif
                        @if(isset($footer['email']) && $footer['email'])
                        <li class="flex items-start gap-2">
                            <img src="{{asset('design')}}/images/mail.svg" class="w-6 h-6 mt-1" alt="Email icon">
                            <span class="font-sf-pro-regular {{ $isArabic ? 'text-right' : '' }}" @if($isArabic) dir="ltr" style="unicode-bidi: plaintext;" @endif>{{ $footer['email'] }}</span>
                        </li>
                        @endif
                        @php
                            $hasAddress = ($footer['address'] ?? null) || ($footer['address_ar'] ?? null);
                        @endphp
                        @if($hasAddress)
                        <li class="flex items-start gap-2 {{ $isArabic ? 'text-right' : '' }}">
                            <img src="{{asset('design')}}/images/location.svg" class="w-6 h-6 mt-1" alt="Location icon">
                            <span class="font-sf-pro-regular {{ $isArabic ? 'text-right' : '' }}" @if($isArabic) dir="auto" style="unicode-bidi: plaintext;" @endif>{!! app()->getLocale() == 'ar'
                                ? ($footer['address_ar'] ?? $footer['address'] ?? '')
                                : ($footer['address'] ?? $footer['address_ar'] ?? '') !!}</span>
                        </li>
                        @endif
                    </ul>
                </div>
                @endif

                <!-- Follow Us dropdown -->
                @if((isset($footer['social_section_title_en']) && $footer['social_section_title_en']) || (isset($footer['social_section_title_ar']) && $footer['social_section_title_ar']) || (isset($footer['social_items']) && is_array($footer['social_items']) && count($footer['social_items']) > 0))
                <div class="border-b border-[#1A2F57]">
                    <div class="flex justify-between items-center py-4">
                        <div class="text-xl font-sf-pro-medium"><p style="color: {{ $footer['accent_color'] }};">
                            {{ app()->getLocale() == 'ar' ? ($footer['social_section_title_ar'] ?? 'تابعنا') : ($footer['social_section_title_en'] ?? 'Follow Us') }}
                        </p></div>
                        <button class="text-white dropdown-toggle">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    <div class="hidden dropdown-content pb-4">
                        <div class="flex space-x-4 mb-6 pt-2">
                            @if(isset($footer['social_items']) && is_array($footer['social_items']))
                                @foreach($footer['social_items'] as $item)
                                    @if(isset($item['name']) && $item['name'] && isset($item['url']) && $item['url'])
                                    <a href="{{ $item['url'] }}" class="text-white" title="{{ $item['name'] }}" target="_blank" rel="noopener noreferrer">
                                        @if(isset($item['icon']) && $item['icon'])
                                            <img src="{{ asset('storage/' . $item['icon']) }}" class="w-10 h-10" alt="{{ $item['name'] }} icon">
                                        @else
                                            @php
                                                // Default icons based on platform name
                                                $defaultIcon = 'design/images/social-default.svg';
                                                if(stripos($item['name'], 'facebook') !== false) $defaultIcon = 'design/images/fb.svg';
                                                elseif(stripos($item['name'], 'instagram') !== false) $defaultIcon = 'design/images/in.svg';
                                                elseif(stripos($item['name'], 'linkedin') !== false) $defaultIcon = 'design/images/linkedin.svg';
                                                elseif(stripos($item['name'], 'twitter') !== false || stripos($item['name'], 'x') !== false) $defaultIcon = 'design/images/x.svg';
                                                elseif(stripos($item['name'], 'youtube') !== false) $defaultIcon = 'design/images/yt.svg';
                                            @endphp
                                            <img src="{{ asset($defaultIcon) }}" class="w-10 h-10" alt="{{ $item['name'] }} icon">
                                        @endif
                                    </a>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Download App dropdown - Mobile Only -->
                @if($footer['show_app_download'])
                <div class="border-b border-[#1A2F57]">
                    <div class="flex justify-between items-center py-4">
                        <div class="text-xl font-sf-pro-medium"><p style="color: {{ $footer['accent_color'] }};">
                            {{ app()->getLocale() == 'ar' ? ($footer['app_download_text_ar'] ?? 'تحميل التطبيق') : ($footer['app_download_text_en'] ?? 'Download App') }}
                        </p></div>
                        <button class="text-white dropdown-toggle">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    <div class="hidden dropdown-content pb-4">
                        <div class="site-footer-app-download flex items-center justify-center rounded-[10px] w-[180px] h-[56px]" style="background-color: {{ $footer['accent_color'] }};">
                            <a href="{{ $footer['ios_app_link'] ?? '#' }}" class="flex-1 flex items-center justify-center" target="_blank" rel="noopener noreferrer">
                                @if(isset($footer['ios_app_icon']) && $footer['ios_app_icon'])
                                    <img src="{{ asset('storage/' . $footer['ios_app_icon']) }}" alt="Apple" class="w-10 h-10" />
                                @else
                                    <img src="{{asset('design')}}/images/ios.svg" alt="Apple" class="w-10 h-10" />
                                @endif
                            </a>
                            <div class="w-px h-8 bg-white/60 mx-2"></div>
                            <a href="{{ $footer['android_app_link'] ?? '#' }}" class="flex-1 flex items-center justify-center" target="_blank" rel="noopener noreferrer">
                                @if(isset($footer['android_app_icon']) && $footer['android_app_icon'])
                                    <img src="{{ asset('storage/' . $footer['android_app_icon']) }}" alt="Android" class="w-10 h-10" />
                                @else
                                    <img src="{{asset('design')}}/images/android.svg" alt="Android" class="w-10 h-10" />
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Desktop footer -->
            <div class="site-footer-desktop hidden md:grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Column 1: Home -->
                @if((isset($footer['home_section_title_en']) && $footer['home_section_title_en']) || (isset($footer['home_section_title_ar']) && $footer['home_section_title_ar']) || (isset($footer['home_items']) && is_array($footer['home_items']) && count($footer['home_items']) > 0))
                <div>
                    <div class="text-xl mb-6 font-sf-pro-medium"><p style="color: {{ $footer['accent_color'] }};">
                        {{ app()->getLocale() == 'ar' ? ($footer['home_section_title_ar'] ?? 'الرئيسية') : ($footer['home_section_title_en'] ?? 'Home') }}
                    </p></div>
                    <ul class="space-y-3 text-sm">
                        @if(isset($footer['home_items']) && is_array($footer['home_items']))
                            @foreach($footer['home_items'] as $item)
                                @if(isset($item['title_en']) && $item['title_en'])
                                <li><a href="{{ route($item['url']) }}" class="hover:text-[{{ $footer['accent_color'] }}] transition-colors font-sf-pro-regular">
                                    {{ app()->getLocale() == 'ar' ? ($item['title_ar'] ?? $item['title_en']) : $item['title_en'] }}
                                </a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
                @endif

                <!-- Column 2: Services & Programs -->
                @if((isset($footer['services_section_title_en']) && $footer['services_section_title_en']) || (isset($footer['services_section_title_ar']) && $footer['services_section_title_ar']) || (isset($footer['services_items']) && is_array($footer['services_items']) && count($footer['services_items']) > 0))
                <div>
                    <div class="text-xl mb-6 font-sf-pro-medium"><p style="color: {{ $footer['accent_color'] }};">
                        {{ app()->getLocale() == 'ar' ? ($footer['services_section_title_ar'] ?? 'الخدمات والبرامج') : ($footer['services_section_title_en'] ?? 'Services & Programs') }}
                    </p></div>
                    <ul class="space-y-3 text-sm">
                        @if(isset($footer['services_items']) && is_array($footer['services_items']))
                            @foreach($footer['services_items'] as $item)
                                @if(isset($item['title_en']) && $item['title_en'])
                                <li><a href="{{ route($item['url']) }}" class="hover:text-[{{ $footer['accent_color'] }}] transition-colors font-sf-pro-regular">
                                    {{ app()->getLocale() == 'ar' ? ($item['title_ar'] ?? $item['title_en']) : $item['title_en'] }}
                                </a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
                @endif

                <!-- Column 3: Contact Us -->
                @if(isset($footer['phone']) && $footer['phone'] || isset($footer['email']) && $footer['email'] || isset($footer['address']) && $footer['address'])
                <div>
                    <div class="text-xl mb-6 font-sf-pro-medium"><p style="color: {{ $footer['accent_color'] }};">
                        {{ app()->getLocale() == 'ar' ? ($footer['contact_section_title_ar'] ?? 'اتصل بنا') : ($footer['contact_section_title_en'] ?? 'Contact Us') }}
                    </p></div>
                    <ul class="space-y-3 text-sm {{ $isArabic ? 'text-right' : '' }}">
                        @if(isset($footer['phone']) && $footer['phone'])
                        <li class="flex items-start gap-2">
                            <img src="{{asset('design')}}/images/phone.svg" class="w-4 h-4 mt-1" alt="Phone icon">
                            <span class="font-sf-pro-regular {{ $isArabic ? 'text-right' : '' }}" @if($isArabic) dir="ltr" style="unicode-bidi: plaintext;" @endif>{{ $footer['phone'] }}</span>
                        </li>
                        @endif
                        @if(isset($footer['email']) && $footer['email'])
                        <li class="flex items-start gap-2">
                            <img src="{{asset('design')}}/images/mail.svg" class="w-4 h-4 mt-1" alt="Email icon">
                            <span class="font-sf-pro-regular {{ $isArabic ? 'text-right' : '' }}" @if($isArabic) dir="ltr" style="unicode-bidi: plaintext;" @endif>{{ $footer['email'] }}</span>
                        </li>
                        @endif
                        @php
                            $hasAddress = ($footer['address'] ?? null) || ($footer['address_ar'] ?? null);
                        @endphp
                        @if($hasAddress)
                        <li class="flex items-start gap-2 max-w-[250px] {{ $isArabic ? 'text-right' : '' }}">
                            <img src="{{asset('design')}}/images/location.svg" class="w-4 h-4 mt-1 flex-shrink-0" alt="Location icon">
                            <span class="font-sf-pro-regular text-sm {{ $isArabic ? 'text-right' : '' }}" @if($isArabic) dir="auto" style="unicode-bidi: plaintext;" @endif>{!! app()->getLocale() == 'ar'
                                ? ($footer['address_ar'] ?? $footer['address'] ?? '')
                                : ($footer['address'] ?? $footer['address_ar'] ?? '') !!}</span>
                        </li>
                        @endif
                    </ul>
                </div>
                @endif

                <!-- Column 4: Follow Us -->
                @if((isset($footer['social_section_title_en']) && $footer['social_section_title_en']) || (isset($footer['social_section_title_ar']) && $footer['social_section_title_ar']) || (isset($footer['social_items']) && is_array($footer['social_items']) && count($footer['social_items']) > 0))
                <div>
                    <div class="text-xl mb-6 font-sf-pro-medium"><p style="color: {{ $footer['accent_color'] }};">
                        {{ app()->getLocale() == 'ar' ? ($footer['social_section_title_ar'] ?? 'تابعنا') : ($footer['social_section_title_en'] ?? 'Follow Us') }}
                    </p></div>
                    <div class="flex {{ $isArabic ? 'space-x-reverse' : '' }} space-x-4 mb-6">
                        @if(isset($footer['social_items']) && is_array($footer['social_items']))
                            @foreach($footer['social_items'] as $item)
                                @if(isset($item['name']) && $item['name'] && isset($item['url']) && $item['url'])
                                <a href="{{ $item['url'] }}" class="text-white hover:text-[{{ $footer['accent_color'] }}]" title="{{ $item['name'] }}" target="_blank" rel="noopener noreferrer">
                                    @if(isset($item['icon']) && $item['icon'])
                                        <img src="{{ asset('storage/' . $item['icon']) }}" class="w-5 h-5" alt="{{ $item['name'] }} icon">
                                    @else
                                        @php
                                            // Default icons based on platform name
                                            $defaultIcon = 'design/images/social-default.svg';
                                            if(stripos($item['name'], 'facebook') !== false) $defaultIcon = 'design/images/fb.svg';
                                            elseif(stripos($item['name'], 'instagram') !== false) $defaultIcon = 'design/images/in.svg';
                                            elseif(stripos($item['name'], 'linkedin') !== false) $defaultIcon = 'design/images/linkedin.svg';
                                            elseif(stripos($item['name'], 'twitter') !== false || stripos($item['name'], 'x') !== false) $defaultIcon = 'design/images/x.svg';
                                            elseif(stripos($item['name'], 'youtube') !== false) $defaultIcon = 'design/images/yt.svg';
                                        @endphp
                                        <img src="{{ asset($defaultIcon) }}" class="w-5 h-5" alt="{{ $item['name'] }} icon">
                                    @endif
                                </a>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <!-- Download App Section -->
                    @if($footer['show_app_download'])
                    <div class="mb-2">
                        <div class="text-base font-sf-pro-medium mb-2" style="color: {{ $footer['accent_color'] }};">
                            {{ app()->getLocale() == 'ar' ? ($footer['app_download_text_ar'] ?? 'تحميل التطبيق') : ($footer['app_download_text_en'] ?? 'Download App') }}
                        </div>
                        <div class="site-footer-app-download flex items-center justify-center rounded-[10px] w-[180px] h-[56px]" style="background-color: {{ $footer['accent_color'] }};">
                            <a href="{{ $footer['ios_app_link'] ?? '#' }}" class="flex-1 flex items-center justify-center" target="_blank" rel="noopener noreferrer">
                                @if(isset($footer['ios_app_icon']) && $footer['ios_app_icon'])
                                    <img src="{{ asset('storage/' . $footer['ios_app_icon']) }}" alt="Apple" class="w-10 h-10" />
                                @else
                                    <img src="{{asset('design')}}/images/ios.svg" alt="Apple" class="w-10 h-10" />
                                @endif
                            </a>
                            <div class="w-px h-8 bg-white/60 mx-2"></div>
                            <a href="{{ $footer['android_app_link'] ?? '#' }}" class="flex-1 flex items-center justify-center" target="_blank" rel="noopener noreferrer">
                                @if(isset($footer['android_app_icon']) && $footer['android_app_icon'])
                                    <img src="{{ asset('storage/' . $footer['android_app_icon']) }}" alt="Android" class="w-10 h-10" />
                                @else
                                    <img src="{{asset('design')}}/images/android.svg" alt="Android" class="w-10 h-10" />
                                @endif
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- Policy links on mobile -->
            <div class="site-footer-policy-links md:hidden pt-6 border-t border-gray-700 mb-8">
                <div class="flex flex-wrap justify-center space-x-2 mb-6">
                    <a href="{{ route('privacy-policy') }}" class="text-white font-sf-pro-medium">
                        {{ app()->getLocale() == 'ar' ? ($footer['privacy_policy_text_ar'] ?? 'سياسة الخصوصية') : ($footer['privacy_policy_text_en'] ?? 'Privacy Policy') }}
                    </a>
                    <span class="text-white">|</span>
                    <a href="{{ route('terms-conditions') }}" class="text-white font-sf-pro-medium">
                        {{ app()->getLocale() == 'ar' ? ($footer['terms_conditions_text_ar'] ?? 'الشروط والأحكام') : ($footer['terms_conditions_text_en'] ?? 'Terms & Conditions') }}
                    </a>
                    <span class="text-white">|</span>
                    <a href="{{ route('cookie-policy') }}" class="text-white font-sf-pro-medium">
                        {{ app()->getLocale() == 'ar' ? ($footer['cookie_policy_text_ar'] ?? 'سياسة ملفات تعريف الارتباط') : ($footer['cookie_policy_text_en'] ?? 'Cookie Policy') }}
                    </a>
                </div>
            </div>

            <!-- Newsletter subscribe -->
            @if($footer['show_newsletter'])
            <div class="site-footer-newsletter mt-6 mb-10 md:w-[50%]">
                <div class="flex flex-col md:flex-row gap-2">
                    <input
                        type="email"
                        placeholder="{{ app()->getLocale() == 'ar' ? ($footer['newsletter_placeholder_ar'] ?? 'اشترك في نشرتنا الإخبارية') : ($footer['newsletter_placeholder_en'] ?? 'Subscribe to Our Newsletter') }}"
                        class="flex-1 bg-transparent border border-gray-600 rounded py-3 md:py-2 pl-[20px] pr-[40px] text-base md:text-sm focus:outline-none mb-2 md:mb-0"
                        style="color: {{ $footer['text_color'] }}; border-color: {{ $footer['accent_color'] }};"
                        readonly
                    >
                    <a href="/popup" class="uppercase text-white px-[8px] py-[10px] md:py-[10px] rounded-lg text-[13px] xl:text-[13px] font-neue-extrabold w-full md:w-auto text-center" style="background-color: {{ $footer['accent_color'] }};">
                        {{ app()->getLocale() == 'ar' ? ($footer['newsletter_button_text_ar'] ?? 'اشترك') : ($footer['newsletter_button_text_en'] ?? 'Subscribe') }}
                    </a>
                </div>
            </div>
            @endif

            <!-- Copyright info for mobile -->
            <div class="site-footer-copyright md:hidden text-center text-[13.77px] text-white font-sf-pro-regular">
                {{ $regulationText }}
            </div>
            <div class="site-footer-copyright md:hidden text-center text-[13.77px] text-white mb-4 font-sf-pro-regular" dir="ltr" style="unicode-bidi: plaintext;">
                {!! $copyrightText !!}
            </div>
            <!-- Footer Bottom / Copyright - DESKTOP ONLY -->
            <div class="site-footer-bottom hidden md:flex pt-8 border-t border-gray-700 flex-col md:flex-row justify-between items-center text-sm">
                <div class="mb-4 md:mb-0 text-white text-center md:text-left font-sf-pro-regular md:min-w-[360px]">
                    {{ $regulationText }}
                </div>
                <div class="text-white mb-4 md:mb-0 text-center font-sf-pro-medium md:flex-1" dir="ltr" style="unicode-bidi: plaintext;">
                    {!! $copyrightText !!}
                </div>
                <div class="site-footer-policy-desktop flex space-x-2 md:space-x-6 mt-4 md:mt-0 justify-center md:min-w-[360px] md:justify-end">
                    <a href="{{ route('privacy-policy') }}" class="text-white hover:text-[{{ $footer['accent_color'] }}] font-sf-pro-medium">
                        {{ app()->getLocale() == 'ar' ? ($footer['privacy_policy_text_ar'] ?? 'سياسة الخصوصية') : ($footer['privacy_policy_text_en'] ?? 'Privacy Policy') }}
                    </a>
                    <span class="text-white">|</span>
                    <a href="{{ route('terms-conditions') }}" class="text-white hover:text-[{{ $footer['accent_color'] }}] font-sf-pro-medium">
                        {{ app()->getLocale() == 'ar' ? ($footer['terms_conditions_text_ar'] ?? 'الشروط والأحكام') : ($footer['terms_conditions_text_en'] ?? 'Terms & Conditions') }}
                    </a>
                    <span class="text-white">|</span>
                    <a href="{{ route('cookie-policy') }}" class="text-white hover:text-[{{ $footer['accent_color'] }}] font-sf-pro-medium">
                        {{ app()->getLocale() == 'ar' ? ($footer['cookie_policy_text_ar'] ?? 'سياسة ملفات تعريف الارتباط') : ($footer['cookie_policy_text_en'] ?? 'Cookie Policy') }}
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Include the JavaScript directly in the footer -->
    @php
    // Check if $services variable exists and is not empty
    $servicesData = [];
    if (isset($services) && !empty($services)) {
        $servicesData = collect($services)->map(function ($service) {
            // Safe handling of image collection
            $image = $service['image'];

            if ($image instanceof \Illuminate\Support\Collection && $image->isNotEmpty()) {
                $image = $image->first();
            } elseif (is_array($image) && !empty($image)) {
                $image = $image[0];
            } else {
                $image = asset('design/images/assist1.png'); // fallback if image is null or empty
            }

            return [
                'id' => $service['id'],
                'title' => strip_tags($service['title_en'] ?? ''),
                'description' => $service['description_en'] ?? '',
                'image' => $image,
                'url' => route('services'),
            ];
        });
    }
    @endphp

    <script>
        window.appData = {
            services: <?php echo json_encode($servicesData); ?>,
        };
    </script>

    <script src="{{asset('design/js')}}/index.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu functionality is handled by the main index.js file

            // Footer dropdown functionality is handled by the main MobileNavigation module in index.js

            // Carousel functionality
            const carouselContainer = document.getElementById('carousel-container');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const carouselItems = document.querySelectorAll('.carousel-item');

            if (carouselContainer && prevBtn && nextBtn && carouselItems.length > 0) {
                let currentIndex = 0;
                const totalItems = carouselItems.length;
                const itemsPerView = window.innerWidth < 768 ? 1 : 2;

                // Initial setup
                function setupCarousel() {
                    // On mobile, show only one item
                    if (window.innerWidth < 768) {
                        carouselItems.forEach((item, index) => {
                            item.style.display = index === currentIndex ? 'block' : 'none';
                        });
                    } else {
                        // On desktop, show two items
                        carouselItems.forEach((item, index) => {
                            item.style.display = (index >= currentIndex && index < currentIndex + 2) ? 'block' : 'none';
                        });
                    }
                    updateNavigationButtons();
                }

                function updateNavigationButtons() {
                    prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
                    nextBtn.style.opacity = currentIndex >= totalItems - itemsPerView ? '0.5' : '1';
                }

                function moveCarousel(direction) {
                    if (direction === 'next' && currentIndex < totalItems - itemsPerView) {
                        currentIndex++;
                    } else if (direction === 'prev' && currentIndex > 0) {
                        currentIndex--;
                    }
                    setupCarousel();
                }

                // Event listeners for navigation buttons
                prevBtn.addEventListener('click', () => moveCarousel('prev'));
                nextBtn.addEventListener('click', () => moveCarousel('next'));

                // Handle window resize
                window.addEventListener('resize', () => {
                    const newItemsPerView = window.innerWidth < 768 ? 1 : 2;
                    if (newItemsPerView !== itemsPerView) {
                        currentIndex = 0;
                        setupCarousel();
                    }
                });

                // Run initial setup
                setupCarousel();
            }

            // Steps Carousel Functionality
            const stepsPrevBtn = document.getElementById('steps-prev-btn');
            const stepsNextBtn = document.getElementById('steps-next-btn');
            const stepsSlides = document.querySelectorAll('.steps-slide');

            // Only initialize carousel if navigation buttons exist (more than 3 cards)
            if (stepsPrevBtn && stepsNextBtn && stepsSlides.length > 0) {
                let currentSlideIndex = 0;
                const totalSlides = stepsSlides.length;

                // Add CSS styles for the carousel
                const style = document.createElement('style');
                style.textContent = `
                    .steps-slide {
                        transition: all 0.3s ease-in-out;
                    }
                    .number-badge {
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    }
                `;
                document.head.appendChild(style);

                // Function to update the carousel display
                function updateStepsCarousel() {
                    stepsSlides.forEach((slide, index) => {
                        if (index === currentSlideIndex) {
                            slide.classList.remove('hidden');
                        } else {
                            slide.classList.add('hidden');
                        }
                    });

                    // Update the navigation buttons
                    stepsPrevBtn.style.opacity = currentSlideIndex === 0 ? '0.5' : '1';
                    stepsPrevBtn.style.cursor = currentSlideIndex === 0 ? 'default' : 'pointer';

                    stepsNextBtn.style.opacity = currentSlideIndex >= totalSlides - 1 ? '0.5' : '1';
                    stepsNextBtn.style.cursor = currentSlideIndex >= totalSlides - 1 ? 'default' : 'pointer';
                }

                // Initialize the carousel
                updateStepsCarousel();

                // Handle previous button click
                stepsPrevBtn.addEventListener('click', function() {
                    if (currentSlideIndex > 0) {
                        currentSlideIndex--;
                        updateStepsCarousel();
                    }
                });

                // Handle next button click
                stepsNextBtn.addEventListener('click', function() {
                    if (currentSlideIndex < totalSlides - 1) {
                        currentSlideIndex++;
                        updateStepsCarousel();
                    }
                });

                // Update on window resize
                window.addEventListener('resize', function() {
                    // Reset the index if needed
                    if (currentSlideIndex >= totalSlides) {
                        currentSlideIndex = totalSlides - 1;
                    }
                    updateStepsCarousel();
                });
            }
        });
    </script>

@else
    <!-- Fallback to original footer if no settings -->
    @include('layouts.footer-original')
@endif
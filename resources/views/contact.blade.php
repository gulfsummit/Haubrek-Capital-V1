@extends('app')

@section('content')
    @php
        $isArabic = app()->getLocale() === 'ar';
        $localize = $localize ?? function ($en, $ar) use ($isArabic) {
            return $isArabic ? ($ar ?: $en) : ($en ?: $ar);
        };
        $formTextAlign = $isArabic ? 'text-right' : 'text-left';
        $formDirection = $isArabic ? 'rtl' : 'ltr';
        $detailsTextAlign = $isArabic ? 'text-right' : 'text-left';
        $detailsDirection = $isArabic ? 'rtl' : 'ltr';
        $detailsRowDirection = '';
        $detailsIconSpacing = $isArabic ? 'md:ml-5' : 'md:mr-5';
        $detailsInfoOrder = $isArabic ? 'order-1' : 'order-2';
        $detailsIconOrder = $isArabic ? 'order-2' : 'order-1';
        $socialJustify = $isArabic ? 'md:justify-end' : 'md:justify-start';
        $heroTitle = isset($seoMeta)
            ? ($localize($seoMeta->h1_en ?? null, $seoMeta->h1_ar ?? null) ?? ($contactUs ? (app()->getLocale() === 'ar' ? ($contactUs->hero_title_ar ?? 'اتصل بنا') : ($contactUs->hero_title_en ?? 'CONTACT US')) : (app()->getLocale() === 'ar' ? 'اتصل بنا' : 'CONTACT US')))
            : ($contactUs ? (app()->getLocale() === 'ar' ? ($contactUs->hero_title_ar ?? 'اتصل بنا') : ($contactUs->hero_title_en ?? 'CONTACT US')) : (app()->getLocale() === 'ar' ? 'اتصل بنا' : 'CONTACT US'));
        $heroDesktopAlt = $localize($contactUs?->hero_desktop_image_alt_en, $contactUs?->hero_desktop_image_alt_ar) ?: $heroTitle;
        $heroMobileAlt = $localize($contactUs?->hero_mobile_image_alt_en, $contactUs?->hero_mobile_image_alt_ar) ?: $heroDesktopAlt;
    @endphp

    <style>
        @media (max-width: 767px) {
            .contact-hero {
                height: 82vh !important;
                min-height: 520px;
            }

            .contact-hero-content {
                height: 100% !important;
                padding-inline: 1.25rem;
            }

            .contact-hero-title {
                font-size: 2.75rem !important;
                line-height: 1.08 !important;
            }

            .contact-hero-subtitle {
                font-size: 1rem !important;
                line-height: 1.6 !important;
            }

            .contact-main {
                min-height: auto !important;
                padding: 4rem 1.25rem !important;
            }

            .contact-grid {
                gap: 2.5rem !important;
            }

            .contact-form-card {
                width: 100% !important;
                margin-inline: 0 !important;
                padding: 1.5rem !important;
                border-radius: 1rem !important;
            }

            .contact-form-title {
                font-size: 1.625rem !important;
                line-height: 1.25 !important;
                margin-bottom: 1.5rem !important;
            }

            .contact-form-card form {
                gap: 1rem !important;
            }

            .contact-form-card label,
            .contact-form-card button {
                font-size: 1rem !important;
            }

            .contact-form-card input,
            .contact-form-card textarea {
                padding: 0.8rem !important;
                font-size: 0.95rem !important;
            }

            .contact-details {
                margin-top: 0 !important;
                gap: 1.5rem !important;
            }

            .contact-details h4 {
                font-size: 1.125rem !important;
                line-height: 1.35 !important;
            }

            .contact-details div,
            .contact-details a {
                font-size: 0.95rem !important;
                line-height: 1.55 !important;
            }

            .contact-details img {
                width: 1.75rem;
                height: 1.75rem;
                flex-shrink: 0;
            }

            .contact-social img {
                width: 1.75rem !important;
                height: 1.75rem !important;
            }

            .contact-map iframe {
                height: 340px !important;
            }
        }

        @media (min-width: 768px) and (max-width: 1023px) {
            .contact-hero {
                height: 72vh !important;
                min-height: 540px;
                max-height: 680px;
            }

            .contact-hero-content {
                height: 100% !important;
                padding-inline: 1.5rem;
            }

            .contact-hero-title {
                font-size: 3.5rem !important;
                line-height: 1.08 !important;
            }

            .contact-main {
                min-height: auto !important;
                padding: 4.5rem 1.5rem !important;
            }

            .contact-grid {
                grid-template-columns: 1fr !important;
                max-width: 720px !important;
                gap: 3rem !important;
            }

            .contact-form-card {
                padding: 2rem !important;
                width: 100% !important;
                margin-inline: 0 !important;
            }

            .contact-form-title {
                font-size: 1.875rem !important;
                line-height: 1.3 !important;
                margin-bottom: 1.75rem !important;
            }

            .contact-form-card label,
            .contact-form-card button {
                font-size: 1rem !important;
            }

            .contact-form-card form {
                gap: 1.25rem !important;
            }

            .contact-details {
                margin-top: 0 !important;
                gap: 1.75rem !important;
            }

            .contact-details h4 {
                font-size: 1.25rem !important;
                line-height: 1.35 !important;
            }

            .contact-details div,
            .contact-details a {
                font-size: 1rem !important;
                line-height: 1.6 !important;
            }

            .contact-map iframe {
                height: 420px !important;
            }
        }

        @media (min-width: 1024px) and (max-width: 1279px) {
            .contact-hero {
                height: 74vh !important;
                min-height: 560px;
                max-height: 760px;
            }

            .contact-hero-content {
                height: 100% !important;
                padding-inline: 2rem;
            }

            .contact-hero-title {
                font-size: 4rem !important;
                line-height: 1.08 !important;
            }

            .contact-main {
                min-height: auto !important;
                padding: 5rem 2rem !important;
            }

            .contact-grid {
                max-width: 980px !important;
                gap: 3.5rem !important;
            }

            .contact-form-card {
                padding: 2rem !important;
            }

            .contact-form-title {
                font-size: 1.875rem !important;
                line-height: 1.3 !important;
            }

            .contact-form-card label,
            .contact-form-card button,
            .contact-details div,
            .contact-details a {
                font-size: 1rem !important;
            }

            .contact-details h4 {
                font-size: 1.25rem !important;
            }
        }
    </style>

    @if($contactUs?->isSectionVisible('hero') ?? true)
    <section class="contact-hero bg-navy-900 text-white h-screen md:h-[70vh] relative">
        <div class="relative overflow-hidden h-full">
            <div class="flex flex-col h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full">
                    <div class="w-full flex-shrink-0 relative">
                        <!-- Desktop background -->
                        <div class="absolute inset-0 hidden md:block">
                            <img src="{{ $contactUs && $contactUs->hero_desktop_image ? asset('storage/' . $contactUs->hero_desktop_image) : asset('design/images/contact-us.png') }}" alt="{{ $heroDesktopAlt }}" class="w-full h-full object-cover"/>
                        </div>
                        <!-- Mobile background -->
                        <div class="absolute inset-0 block md:hidden">
                            <img src="{{ $contactUs && $contactUs->hero_mobile_image ? asset('storage/' . $contactUs->hero_mobile_image) : asset('design/images/contact-us.png') }}" alt="{{ $heroMobileAlt }}" class="w-full h-full object-cover"/>
                        </div>
                        <div class="absolute inset-0 "></div>
                        <div class="contact-hero-content relative h-[120vh] md:h-[90vh] flex items-center justify-center">
                            <div class="container mx-auto text-center">
                                <h1 class="contact-hero-title text-[45px] xl:text-[78px] leading-[53.7px] xl:leading-[87px] font-neue-extrabold mb-4">{{ $heroTitle }}</h1>
                                <div class="contact-hero-subtitle font-['Poppins'] text-[18px] text-white">{!! $contactUs ? (app()->getLocale() === 'ar' ? $contactUs->hero_subtitle_ar : $contactUs->hero_subtitle_en) : '<p>Your journey to financial success starts with a simple conversation</p>' !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif


    @if(($contactUs?->isSectionVisible('form') ?? true) || ($contactUs?->isSectionVisible('contact_info') ?? true))
    <section class="contact-main min-h-screen bg-[#031849] flex items-center justify-center px-6 py-12">
        <div class="contact-grid max-w-7xl w-full grid grid-cols-1 md:grid-cols-2 gap-20">


          @if($contactUs?->isSectionVisible('form') ?? true)
          <!-- Left Form -->
          <div class="contact-form-card bg-[#030b17] p-8 rounded-2xl shadow-lg w-screen md:w-full mx-[-1.5rem] md:mx-0 {{ $isArabic ? 'md:order-2' : 'md:order-1' }}" dir="{{ $formDirection }}">

            <h2 class="contact-form-title text-[30px] leading-[42px] font-neue-bold text-white mb-8 {{ $formTextAlign }}">{{ $contactUs ? (app()->getLocale() === 'ar' ? $contactUs->form_title_ar : $contactUs->form_title_en) : 'GET IN TOUCH WITH US' }}</h2>
            @if(session('success'))
              <div class="bg-green-500 text-white p-4 rounded-lg">
                Form submitted successfully!
              </div>
            @endif
            @if ($errors->any())
              <div class="bg-red-600 text-white p-4 rounded-lg">
                {{ $localize('Please correct the highlighted fields and try again.', 'يرجى تصحيح الحقول المظللة والمحاولة مرة أخرى.') }}
              </div>
            @endif
            <form class="space-y-6 {{ $formTextAlign }}" method="post" action="{{route('contact.submit')}}">
                @csrf
              <div>
                <label for="contact-name" class="block text-white mb-2 font-sf text-[19px] {{ $formTextAlign }}">
                    {{ $contactUs ? (app()->getLocale() === 'ar' ? ($contactUs->name_label_ar ?? 'الاسم') : ($contactUs->name_label_en ?? 'Name')) : 'Name' }} *
                </label>
                <input
                       id="contact-name"
                       type="text"
                       name="name"
                       value="{{old('name')}}" 
                       placeholder="{{ $contactUs ? (app()->getLocale() === 'ar' ? ($contactUs->name_placeholder_ar ?? 'اسمك') : ($contactUs->name_placeholder_en ?? 'Your name')) : 'Your name' }}" 
                       class="w-full p-3 rounded bg-gray-100 text-gray-800 placeholder-gray-400 {{ $formTextAlign }} focus:outline-none focus:border-yellow-500 border-2 border-transparent transition @error('name') border-red-500 focus:border-red-500 @enderror"
                       aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                       @if($errors->has('name')) aria-describedby="contact-name-error" @endif
                       required
                />
                @error('name')
                  <p id="contact-name-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <label for="contact-email" class="block text-white mb-2 font-sf text-[19px] {{ $formTextAlign }}">
                    {{ $contactUs ? (app()->getLocale() === 'ar' ? ($contactUs->email_label_ar ?? 'البريد الإلكتروني') : ($contactUs->email_label_en ?? 'Email')) : 'Email' }} *
                </label>
                <input
                       id="contact-email"
                       type="email"
                       name="email"
                       value="{{old('email')}}" 
                       placeholder="{{ $contactUs ? (app()->getLocale() === 'ar' ? ($contactUs->email_placeholder_ar ?? 'example@company.com') : ($contactUs->email_placeholder_en ?? 'example@company.com')) : 'example@company.com' }}" 
                       class="w-full p-3 rounded bg-gray-100 text-gray-800 placeholder-gray-400 {{ $formTextAlign }} focus:outline-none focus:border-yellow-500 border-2 border-transparent transition @error('email') border-red-500 focus:border-red-500 @enderror"
                       aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                       @if($errors->has('email')) aria-describedby="contact-email-error" @endif
                       required
                />
                @error('email')
                  <p id="contact-email-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <label for="contact-phone" class="block text-white mb-2 font-sf text-[19px] {{ $formTextAlign }}">
                    {{ $contactUs ? (app()->getLocale() === 'ar' ? ($contactUs->phone_label_ar ?? 'رقم الهاتف') : ($contactUs->phone_label_en ?? 'Phone Number')) : 'Phone Number' }} *
                </label>
                <input
                       id="contact-phone"
                       type="tel"
                       name="phone"
                       value="{{old('phone')}}" 
                       placeholder="{{ $contactUs ? (app()->getLocale() === 'ar' ? ($contactUs->phone_placeholder_ar ?? '+11 000 000 000') : ($contactUs->phone_placeholder_en ?? '+11 000 000 000')) : '+11 000 000 000' }}" 
                       class="w-full p-3 rounded bg-gray-100 text-gray-800 placeholder-gray-400 {{ $formTextAlign }} focus:outline-none focus:border-yellow-500 border-2 border-transparent transition @error('phone') border-red-500 focus:border-red-500 @enderror"
                       aria-invalid="{{ $errors->has('phone') ? 'true' : 'false' }}"
                       @if($errors->has('phone')) aria-describedby="contact-phone-error" @endif
                       required
                />
                @error('phone')
                  <p id="contact-phone-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <label for="contact-message" class="block text-white mb-2 font-sf text-[19px] {{ $formTextAlign }}">
                    {{ $contactUs ? (app()->getLocale() === 'ar' ? ($contactUs->message_label_ar ?? 'الرسالة') : ($contactUs->message_label_en ?? 'Message')) : 'Message' }} *
                </label>
                <textarea
                          id="contact-message"
                          name="message"
                          placeholder="{{ $contactUs ? (app()->getLocale() === 'ar' ? ($contactUs->message_placeholder_ar ?? 'اترك لنا رسالة') : ($contactUs->message_placeholder_en ?? 'Leave us a Message')) : 'Leave us a Message' }}" 
                          rows="4"
                          class="w-full p-3 rounded bg-gray-100 text-gray-800 placeholder-gray-400 {{ $formTextAlign }} focus:outline-none focus:border-yellow-500 border-2 border-transparent transition @error('message') border-red-500 focus:border-red-500 @enderror"
                          aria-invalid="{{ $errors->has('message') ? 'true' : 'false' }}"
                          @if($errors->has('message')) aria-describedby="contact-message-error" @endif
                          required
                >{{ old('message') }}</textarea>
                @error('message')
                  <p id="contact-message-error" class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
              </div>
              <div class="flex justify-center">
                <x-recaptcha action="contact_form" />
              </div>
              @error('g-recaptcha-response')
                <p class="text-center text-sm text-red-400">{{ $message }}</p>
              @enderror
              <div>
                <button type="submit" name="submit" value="submit" class="w-full bg-yellow-500 hover:bg-[#D4AF37] text-white font-semibold py-3 rounded-lg transition font-sf text-[19px]">
                  {{ $contactUs ? (app()->getLocale() === 'ar' ? $contactUs->form_button_text_ar : $contactUs->form_button_text_en) : 'SEND MESSAGE' }}
                </button>
              </div>
            </form>
          </div>
          @endif

          @if($contactUs?->isSectionVisible('contact_info') ?? true)
          <!-- Right Contact Info -->
          <div class="contact-details flex flex-col justify-start text-white space-y-8 mt-8 md:mt-0 {{ $isArabic ? 'md:order-1' : 'md:order-2' }}" dir="{{ $detailsDirection }}">
            <div class="space-y-4">
              <div class="flex items-start gap-5 {{ $detailsRowDirection }}" dir="{{ $isArabic ? 'ltr' : 'ltr' }}">
                <div class="flex-1 {{ $detailsTextAlign }} {{ $detailsInfoOrder }}" dir="{{ $detailsDirection }}">
                  <h4 class="font-sf text-[21px] leading-[33.6px] font-bold {{ $detailsTextAlign }}">{{ $contactUs ? (app()->getLocale() === 'ar' ? $contactUs->phone_title_ar : $contactUs->phone_title_en) : 'Call Us' }}</h4>
                  <div class="font-sf font-regular text-[17px] leading-[25px] {{ $detailsTextAlign }}">{!! $contactUs ? (app()->getLocale() === 'ar' ? $contactUs->phone_subtitle_ar : $contactUs->phone_subtitle_en) : '<p>'.$settings[0]['timing'].'</p>' !!}</div>
                  <a href="tel:{{ $contactUs && $contactUs->phone_number ? str_replace([' ', '/'], '', $contactUs->phone_number) : '+97145182591' }}" class="text-[#D4AF37] hover:underline font-sf font-regular text-[17px] leading-[30px] block {{ $detailsTextAlign }}">{{ $contactUs && $contactUs->phone_number ? $contactUs->phone_number : $settings[0]['phone'] }}</a>
                </div>
                <img src="{{asset('design/images/contact-us-phone.svg')}}" alt="Phone" class="mt-1 text-[#D4AF37] {{ $detailsIconSpacing }} {{ $detailsIconOrder }}">
              </div>
            </div>

            <div class="border-t border-gray-600 pt-6 space-y-4">
              <div class="flex items-start gap-5 {{ $detailsRowDirection }}" dir="ltr">
                <div class="flex-1 {{ $detailsTextAlign }} {{ $detailsInfoOrder }}" dir="{{ $detailsDirection }}">
                  <h4 class="font-sf text-[21px] leading-[33.6px] font-bold {{ $detailsTextAlign }}">{{ $contactUs ? (app()->getLocale() === 'ar' ? $contactUs->email_title_ar : $contactUs->email_title_en) : 'Email Support' }}</h4>
                  <div class="font-sf font-regular text-[17px] leading-[25px] {{ $detailsTextAlign }}">{!! $contactUs ? (app()->getLocale() === 'ar' ? $contactUs->email_subtitle_ar : $contactUs->email_subtitle_en) : '<p>Email us &amp; we will get back to you within 24 hours</p>' !!}</div>
                  <a href="mailto:{{ $contactUs && $contactUs->email_address ? $contactUs->email_address : 'info@hauberkcapital.com' }}" class="text-[#D4AF37] hover:underline font-sf font-regular text-[17px] leading-[30px] block {{ $detailsTextAlign }}">{{ $contactUs && $contactUs->email_address ? $contactUs->email_address : $settings[0]['email'] }}</a>
                </div>
                <img src="{{asset('design/images/contact-us-mail.svg')}}" alt="Email" class="mt-1 text-#D4AF37 {{ $detailsIconSpacing }} {{ $detailsIconOrder }}">
              </div>
            </div>

            <div class="border-t border-gray-600 pt-6 space-y-4">
              <div class="flex items-start gap-5 {{ $detailsRowDirection }}" dir="ltr">
                <div class="flex-1 {{ $detailsTextAlign }} {{ $detailsInfoOrder }}" dir="{{ $detailsDirection }}">
                  <h4 class="font-sf text-[21px] leading-[33.6px] font-bold {{ $detailsTextAlign }}">{{ $contactUs ? (app()->getLocale() === 'ar' ? $contactUs->address_title_ar : $contactUs->address_title_en) : 'ADDRESS' }}</h4>
                  <div class="font-sf font-regular text-[17px] leading-[25px] {{ $detailsTextAlign }}">{!! $contactUs ? (app()->getLocale() === 'ar'
                        ? ($contactUs->address_text_ar ?? $settings[0]['address'])
                        : ($contactUs->address_text_en ?? $settings[0]['address']))
                        : $settings[0]['address'] !!}</div>
                </div>
                <img src="{{asset('design')}}/images/contact-us-address.svg" alt="Address" class="mt-1 text-#D4AF37 {{ $detailsIconSpacing }} {{ $detailsIconOrder }}">
              </div>
            </div>
            <div class="border-t border-gray-600 pt-6"></div>

            <!-- Social Media Icons -->
            <div class="contact-social flex gap-4 {{ $socialJustify }} justify-center {{ $isArabic ? 'flex-row-reverse' : '' }}">
                @if(isset($contactUs['social_items']) && is_array($contactUs['social_items']))
                    @foreach($contactUs['social_items'] as $item)
                        @if(isset($item['name']) && $item['name'] && isset($item['url']) && $item['url'])
                            <a href="{{ $item['url'] }}" class="text-white hover:text-[#D4AF37]" title="{{ $item['name'] }}" target="_blank" rel="noopener noreferrer">
                                @if(isset($item['icon']) && $item['icon'])
                                    <img src="{{ asset('storage/' . $item['icon']) }}" class="h-8 w-8" alt="{{ $item['name'] }} icon">
                                @else
                                    @php
                                        // Default icons based on platform name
                                        $defaultIcon = 'design/images/social-default.svg';
                                        if(stripos($item['name'], 'facebook') !== false) $defaultIcon = 'design/images/facebook.svg';
                                        elseif(stripos($item['name'], 'instagram') !== false) $defaultIcon = 'design/images/insta.svg';
                                        elseif(stripos($item['name'], 'linkedin') !== false) $defaultIcon = 'design/images/linkedin-contact.svg';
                                        elseif(stripos($item['name'], 'twitter') !== false || stripos($item['name'], 'x') !== false) $defaultIcon = 'design/images/twitter.svg';
                                        elseif(stripos($item['name'], 'youtube') !== false) $defaultIcon = 'design/images/youtube.svg';
                                    @endphp
                                    <img src="{{ asset($defaultIcon) }}" class="h-8 w-8" alt="{{ $item['name'] }} icon">
                                @endif
                            </a>
                        @endif
                    @endforeach
                @else
                    <!-- Fallback to old hardcoded social media if new structure is not available -->
                    <a href="{{$settings[0]['facebook']}}" class="text-white hover:text-[#D4AF37]">
                        <img src="{{asset('design')}}/images/facebook.svg" alt="Facebook" class="h-8 w-8">
                    </a>
                    <a href="{{$settings[0]['instagram']}}" class="text-white hover:text-[#D4AF37]">
                        <img src="{{asset('design')}}/images/insta.svg" alt="Instagram" class="h-8 w-8">
                    </a>
                    <a href="{{$settings[0]['linkedin']}}" class="text-white hover:text-[#D4AF37]">
                        <img src="{{asset('design')}}/images/linkedin-contact.svg" alt="LinkedIn" class="h-8 w-8">
                    </a>
                    <a href="{{$settings[0]['twitter']}}" class="text-white hover:text-[#D4AF37]">
                        <img src="{{asset('design')}}/images/twitter.svg" alt="Twitter" class="h-8 w-8">
                    </a>
                    <a href="{{$settings[0]['youtube']}}" class="text-white hover:text-[#D4AF37]">
                        <img src="{{asset('design')}}/images/youtube.svg" alt="YouTube" class="h-8 w-8">
                    </a>
                @endif
            </div>
          </div>
          @endif

        </div>
      </section>
    @endif

    @if($contactUs?->isSectionVisible('map') ?? true)
    <section class="contact-map w-full bg-[#031849] flex justify-center items-center py-0 md:py-6">
      <div class="w-full overflow-hidden shadow-lg">
        <iframe
          src="{{ $contactUs && $contactUs->map_iframe_url ? $contactUs->map_iframe_url : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3630.566941357565!2d54.38588827535931!3d24.50045737816608!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e665491ecc069%3A0x9d9d3d9987c47f20!2sAl%20Sila%20Tower%20-%208%20Abu%20Dhabi%20Global%20Market%20-%20First%20St%20-%20Al%20Maryah%20Island%20-%20MI1%20-%20Abu%20Dhabi%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2seg!4v1756117133980!5m2!1sen!2seg' }}"
          width="100%"
          height="550"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="w-full h-[350px] md:h-[600px] border-0"
          title="Al Sila Tower - Abu Dhabi Location"
        ></iframe>
      </div>
    </section>
    @endif

    @endsection
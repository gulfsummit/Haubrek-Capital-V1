
@extends('app')

@section('content')
@php
    $localize = $localize ?? function ($en, $ar) {
        return app()->getLocale() === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
    };
    $defaultHeroTitle = $tools ? (app()->getLocale() === 'ar' ? ($tools->hero_title_ar ?? 'INVESTOR RISK-RETURN PROFILING TOOL') : ($tools->hero_title_en ?? 'INVESTOR RISK-RETURN PROFILING TOOL')) : 'INVESTOR RISK-RETURN PROFILING TOOL';
    $heroTitle = isset($seoMeta) ? ($localize($seoMeta->h1_en ?? null, $seoMeta->h1_ar ?? null) ?? $defaultHeroTitle) : $defaultHeroTitle;
    $heroDesktopAlt = $localize($tools?->hero_desktop_image_alt_en, $tools?->hero_desktop_image_alt_ar) ?: $heroTitle;
    $heroMobileAlt = $localize($tools?->hero_mobile_image_alt_en, $tools?->hero_mobile_image_alt_ar) ?: $heroDesktopAlt;
    $profileImageAlt = $localize($tools?->profile_image_alt_en, $tools?->profile_image_alt_ar)
        ?: $localize($tools?->profile_title_en, $tools?->profile_title_ar)
        ?: 'Investment Profile';
@endphp
<section class="bg-navy-900 text-white h-screen md:h-[70vh] relative">
        <div class="relative overflow-hidden h-full">
            <div class="flex flex-col h-full">
                <div class="flex transition-transform duration-500 ease-in-out h-full">
                    <div class="w-full flex-shrink-0 relative">
                        <!-- Desktop background -->
                        <div class="absolute inset-0 hidden md:block">
                            <img src="{{ $tools && $tools->hero_desktop_image ? asset('storage/' . $tools->hero_desktop_image) : asset('design/images/resource-bg.png') }}" alt="{{ $heroDesktopAlt }}" class="w-full h-full object-cover"/>
                        </div>
                        <!-- Mobile background -->
                        <div class="absolute inset-0 block md:hidden">
                            <img src="{{ $tools && $tools->hero_mobile_image ? asset('storage/' . $tools->hero_mobile_image) : asset('design/images/resource-bg.png') }}" alt="{{ $heroMobileAlt }}" class="w-full h-full object-cover"/>
                        </div>
                        <div class="absolute inset-0 "></div>
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

    <!-- Investment Profile Section -->
    <section class="bg-[#0B1C3A] py-12 md:py-20 flex items-center justify-center">
      <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row bg-[#11224A] rounded-xl justify-between shadow-lg border border-[#fff]/40">
          <!-- Image (first on mobile) -->
          <div class="w-full md:w-1/2 flex items-center justify-center bg-[#1A2747] order-first md:order-last">
            <img src="{{ $tools && $tools->profile_image ? asset('storage/' . $tools->profile_image) : asset('design/images/tools-investment.png') }}" alt="{{ $profileImageAlt }}" class="object-cover w-full h-64 sm:h-80 md:h-full rounded-t-xl md:rounded-t-none md:rounded-r-xl" />
          </div>
          <!-- Text (second on mobile) -->
          <div class="w-full md:w-[40%] p-6 sm:p-8 md:p-12 lg:p-16 xl:p-24 flex flex-col order-last md:order-first">
            <h2 class="text-white text-2xl md:text-[28px] font-neue-bold mb-4">{!! $tools ? (app()->getLocale() === 'ar' ? $tools->profile_title_ar : $tools->profile_title_en) : 'DISCOVER YOUR<br>INVESTMENT PROFILE' !!}</h2>
            <div class="text-white/70 text-[15px] leading-relaxed font-['Poppins']">
                {!! $tools ? (app()->getLocale() === 'ar' ? $tools->profile_description_ar : $tools->profile_description_en) : '<p>Understanding your risk tolerance is crucial for developing an investment strategy that aligns with your financial goals. Our Investor Risk-Return Profiling Tool helps you assess your risk appetite and provides personalized recommendations for your investment portfolio.</p>' !!}
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Key Features Section -->
    <section class="bg-[#0B1C3A] py-10 sm:py-12 md:py-16 px-4 sm:px-6 md:px-8 lg:px-2 bg-[url('{{ $tools && $tools->features_background_image ? asset('storage/' . $tools->features_background_image) : asset('design/images/key-features.png') }}')] bg-cover bg-center bg-no-repeat">
      <div class="max-w-[1500px] mx-auto flex flex-col md:flex-row items-center justify-between relative rounded-xl overflow-hidden">
        <!-- Left: Title with gradient pattern background -->
        <div class="w-full md:w-2/5 flex items-center justify-center md:justify-start h-full relative z-10 min-h-[180px] sm:min-h-[200px] md:min-h-[220px] mb-6 md:mb-0">
          <div class="absolute inset-0 left-0 w-full h-full md:w-[110%] bg-[url('{{ asset('design/images/wealth-bg.png') }}')] bg-cover bg-left opacity-20 pointer-events-none rounded-xl"></div>
          <h2 class="relative z-10 text-white text-2xl sm:text-3xl md:text-4xl lg:text-[48px] font-neue-extrabold md:ml-6 lg:ml-12 text-center md:text-left px-4 md:px-0">{{ $tools ? (app()->getLocale() === 'ar' ? $tools->features_title_ar : $tools->features_title_en) : 'KEY FEATURES' }}</h2>
        </div>
        <!-- Right: Features List -->
        <div class="w-full md:w-3/6 mt-4 sm:mt-6 md:mt-0 md:pl-6 lg:pl-12 px-4 sm:px-6 md:px-0">
          <ul class="text-white/70 text-sm sm:text-base md:text-lg font-['Poppins'] list-disc space-y-2 sm:space-y-3">
            @if($tools && $tools->features_list_en)
              @php
                $features = app()->getLocale() === 'ar' ? $tools->features_list_ar : $tools->features_list_en;
              @endphp
              @foreach($features ?? [] as $feature)
                <li class="pl-2"><span class="font-medium text-white/70">{{ $feature['title'] }}</span> {{ $feature['description'] }}</li>
              @endforeach
            @else
              <li class="pl-2"><span class="font-medium text-white/70">Risk Assessment Questionnaire</span> Answer a series of questions to determine your risk tolerance level.</li>
              <li class="pl-2"><span class="font-medium text-white/70">Personalized Risk Profile</span> Receive a detailed risk profile based on your responses.</li>
              <li class="pl-2"><span class="font-medium text-white/70">Investment Recommendations</span> Get tailored investment recommendations that match your risk profile.</li>
              <li class="pl-2"><span class="font-medium text-white/70">Scenario Analysis</span> See how different market conditions might impact your investment returns.</li>
              <li class="pl-2"><span class="font-medium text-white/70">Progress Tracking</span> Monitor your risk tolerance and investment performance over time.</li>
            @endif
          </ul>
        </div>
      </div>
    </section>

    <!-- How It Works Section -->
    <section class="bg-[#0B1C3A] py-12 px-4 sm:px-8 md:px-12">
      <div class="max-w-[1500px] mx-auto flex flex-col md:flex-row items-center justify-between min-h-[260px]">
        <!-- Heading (first on mobile) -->
        <div class="w-full md:w-2/5 flex items-center justify-center md:justify-end mb-8 md:mb-0 order-first md:order-last">
          <h2 class="text-white text-2xl sm:text-3xl md:text-4xl font-neue-extrabold text-center md:text-right">{{ $tools ? (app()->getLocale() === 'ar' ? $tools->how_it_works_title_ar : $tools->how_it_works_title_en) : 'HOW IT WORKS:' }}</h2>
        </div>
        <!-- Numbered Steps (second on mobile) -->
        <div class="w-full md:w-3/6 order-last md:order-first">
          <ol class="list-decimal list-inside text-white/70 text-sm sm:text-base md:text-lg font-['Poppins'] space-y-3 pl-2">
            @if($tools && $tools->how_it_works_steps_en)
              @php
                $steps = app()->getLocale() === 'ar' ? $tools->how_it_works_steps_ar : $tools->how_it_works_steps_en;
              @endphp
              @foreach($steps ?? [] as $step)
                <li>{{ $step['step'] }}</li>
              @endforeach
            @else
              <li>Start the Assessment Click the "Start Assessment" button to begin the questionnaire.</li>
              <li>Answer the Questions Complete a series of questions about your financial situation, investment goals, and risk tolerance.</li>
              <li>Review Your Risk Profile View your personalized risk profile and understand your risk tolerance level.</li>
              <li>Get Investment Recommendations Receive investment suggestions tailored to your risk profile.</li>
              <li>Explore Scenario Analysis Analyze how your portfolio might perform under different market conditions.</li>
              <li>Track Your Progress Regularly update your profile and monitor your investment performance.</li>
            @endif
          </ol>
        </div>
      </div>
    </section>

        <!-- Risk-Return Assessment Section -->
        <section class="min-h-screen bg-[#051C45] bg-opacity-90 flex items-center justify-center px-4 py-12" style="background-image: url('{{ $tools && $tools->form_background_image ? asset('storage/' . $tools->form_background_image) : asset('design/images/risk-bg.png') }}'); background-size: cover;">
            <div class="container w-full bg-transparent">
              <h2 class="text-2xl sm:text-3xl md:text-[48px] md:leading-[58px] font-bold text-center text-white mb-6 sm:mb-10">{!! $tools ? (app()->getLocale() === 'ar' ? $tools->form_title_ar : $tools->form_title_en) : 'START YOUR RISK-<br>RETURN ASSESSMENT' !!}</h2>
              
              @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6 text-center">
                  {{ session('success') }}
                </div>
              @endif

              @if($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                  <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              
              <form method="POST" action="{{ route('risk.submit') }}" class="grid bg-transparent grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 bg-black bg-opacity-50 p-4 sm:p-8 rounded-lg">
                @csrf
                
                @php
                  $locale = app()->getLocale();
                  $halfCount = ceil($formFields->count() / 2);
                  $firstHalf = $formFields->take($halfCount);
                  $secondHalf = $formFields->slice($halfCount);
                @endphp
                
                <!-- First Column -->
                <div class="space-y-8 sm:space-y-16">
                  @foreach($firstHalf as $field)
                    <div class="{{ $field->field_name === 'name' || $field->field_name === 'email' || $field->field_name === 'phone' ? 'p-4 sm:p-10 rounded-xl bg-black -ml-2 sm:-ml-4 md:-ml-8 mr-4 sm:mr-20 transform md:translate-x-[-2%]' : '' }}">
                      <label class="block {{ $field->field_name === 'name' || $field->field_name === 'email' || $field->field_name === 'phone' ? 'text-[#B9C2CB]' : 'text-white' }} mb-3 sm:mb-4 font-['Poppins'] text-base sm:text-lg md:text-[21.32px]">
                        {{ $locale === 'ar' && $field->label_ar ? $field->label_ar : $field->label_en }}
                        @if($field->is_required) * @endif
                      </label>
                      
                      @if($field->field_type === 'text' || $field->field_type === 'email' || $field->field_type === 'tel' || $field->field_type === 'number')
                        <input type="{{ $field->field_type }}" 
                               name="{{ $field->field_name }}" 
                               placeholder="{{ $locale === 'ar' && $field->placeholder_ar ? $field->placeholder_ar : $field->placeholder_en }}" 
                               class="w-full p-2 sm:p-3 rounded bg-white text-{{ $field->field_name === 'name' || $field->field_name === 'email' || $field->field_name === 'phone' ? 'gray-900' : 'white' }} placeholder-gray-400 focus:outline-none font-['Poppins'] text-base sm:text-lg md:text-[21.32px]" 
                               {{ $field->is_required ? 'required' : '' }} />
                      
                      @elseif($field->field_type === 'textarea')
                        <textarea name="{{ $field->field_name }}" 
                                  placeholder="{{ $locale === 'ar' && $field->placeholder_ar ? $field->placeholder_ar : $field->placeholder_en }}" 
                                  rows="4" 
                                  class="w-full p-2 sm:p-3 rounded bg-white text-gray-900 placeholder-gray-400 focus:outline-none font-['Poppins'] text-base sm:text-lg md:text-[21.32px]" 
                                  {{ $field->is_required ? 'required' : '' }}></textarea>
                      
                      @elseif($field->field_type === 'radio')
                        <div class="space-y-1 sm:space-y-2 text-white">
                          @php
                            $options = $locale === 'ar' && $field->options_ar ? $field->options_ar : $field->options_en;
                          @endphp
                          @foreach($options ?? [] as $option)
                            <label class="block font-['Poppins'] text-base sm:text-lg md:text-[21.32px]">
                              <input type="radio" name="{{ $field->field_name }}" value="{{ $option['value'] }}" class="mr-2 w-4 sm:w-5 h-4 sm:h-5" {{ $field->is_required ? 'required' : '' }}>
                              {{ $option['value'] }}
                            </label>
                          @endforeach
                        </div>
                      
                      @elseif($field->field_type === 'checkbox')
                        <div class="space-y-1 sm:space-y-2 text-white">
                          @php
                            $options = $locale === 'ar' && $field->options_ar ? $field->options_ar : $field->options_en;
                          @endphp
                          @foreach($options ?? [] as $option)
                            <label class="block font-['Poppins'] text-base sm:text-lg md:text-[21.32px]">
                              <input type="checkbox" name="{{ $field->field_name }}[]" value="{{ $option['value'] }}" class="mr-2 w-4 sm:w-5 h-4 sm:h-5">
                              {{ $option['value'] }}
                            </label>
                          @endforeach
                        </div>
                      
                      @elseif($field->field_type === 'select')
                        <select name="{{ $field->field_name }}" 
                                class="w-full p-2 sm:p-3 rounded bg-white text-gray-900 focus:outline-none font-['Poppins'] text-base sm:text-lg md:text-[21.32px]" 
                                {{ $field->is_required ? 'required' : '' }}>
                          <option value="">{{ $locale === 'ar' && $field->placeholder_ar ? $field->placeholder_ar : ($field->placeholder_en ?: ($locale === 'ar' ? 'اختر خيار' : 'Select an option')) }}</option>
                          @php
                            $options = $locale === 'ar' && $field->options_ar ? $field->options_ar : $field->options_en;
                          @endphp
                          @foreach($options ?? [] as $option)
                            <option value="{{ $option['value'] }}">{{ $option['value'] }}</option>
                          @endforeach
                        </select>
                      @endif
                    </div>
                  @endforeach
                </div>
                
                <!-- Second Column -->
                <div class="space-y-8 sm:space-y-20">
                  @foreach($secondHalf as $field)
                    <div>
                      <label class="block text-white mb-3 sm:mb-4 font-['Poppins'] text-base sm:text-lg md:text-[21.32px]">
                        {{ $locale === 'ar' && $field->label_ar ? $field->label_ar : $field->label_en }}
                        @if($field->is_required) * @endif
                      </label>
                      
                      @if($field->field_type === 'text' || $field->field_type === 'email' || $field->field_type === 'tel' || $field->field_type === 'number')
                        <input type="{{ $field->field_type }}" 
                               name="{{ $field->field_name }}" 
                               placeholder="{{ $locale === 'ar' && $field->placeholder_ar ? $field->placeholder_ar : $field->placeholder_en }}" 
                               class="w-full p-2 sm:p-3 rounded bg-white text-gray-900 placeholder-gray-400 focus:outline-none font-['Poppins'] text-base sm:text-lg md:text-[21.32px]" 
                               {{ $field->is_required ? 'required' : '' }} />
                      
                      @elseif($field->field_type === 'textarea')
                        <textarea name="{{ $field->field_name }}" 
                                  placeholder="{{ $locale === 'ar' && $field->placeholder_ar ? $field->placeholder_ar : $field->placeholder_en }}" 
                                  rows="4" 
                                  class="w-full p-2 sm:p-3 rounded bg-white text-gray-900 placeholder-gray-400 focus:outline-none font-['Poppins'] text-base sm:text-lg md:text-[21.32px]" 
                                  {{ $field->is_required ? 'required' : '' }}></textarea>
                      
                      @elseif($field->field_type === 'radio')
                        <div class="space-y-1 sm:space-y-2 text-white">
                          @php
                            $options = $locale === 'ar' && $field->options_ar ? $field->options_ar : $field->options_en;
                          @endphp
                          @foreach($options ?? [] as $option)
                            <label class="block font-['Poppins'] text-base sm:text-lg md:text-[21.32px]">
                              <input type="radio" name="{{ $field->field_name }}" value="{{ $option['value'] }}" class="mr-2 w-4 sm:w-5 h-4 sm:h-5" {{ $field->is_required ? 'required' : '' }}>
                              {{ $option['value'] }}
                            </label>
                          @endforeach
                        </div>
                      
                      @elseif($field->field_type === 'checkbox')
                        <div class="space-y-1 sm:space-y-2 text-white">
                          @php
                            $options = $locale === 'ar' && $field->options_ar ? $field->options_ar : $field->options_en;
                          @endphp
                          @foreach($options ?? [] as $option)
                            <label class="block font-['Poppins'] text-base sm:text-lg md:text-[21.32px]">
                              <input type="checkbox" name="{{ $field->field_name }}[]" value="{{ $option['value'] }}" class="mr-2 w-4 sm:w-5 h-4 sm:h-5">
                              {{ $option['value'] }}
                            </label>
                          @endforeach
                        </div>
                      
                      @elseif($field->field_type === 'select')
                        <select name="{{ $field->field_name }}" 
                                class="w-full p-2 sm:p-3 rounded bg-white text-gray-900 focus:outline-none font-['Poppins'] text-base sm:text-lg md:text-[21.32px]" 
                                {{ $field->is_required ? 'required' : '' }}>
                          <option value="">{{ $locale === 'ar' && $field->placeholder_ar ? $field->placeholder_ar : ($field->placeholder_en ?: ($locale === 'ar' ? 'اختر خيار' : 'Select an option')) }}</option>
                          @php
                            $options = $locale === 'ar' && $field->options_ar ? $field->options_ar : $field->options_en;
                          @endphp
                          @foreach($options ?? [] as $option)
                            <option value="{{ $option['value'] }}">{{ $option['value'] }}</option>
                          @endforeach
                        </select>
                      @endif
                    </div>
                  @endforeach
                </div>
          
                <div class="col-span-1 md:col-span-2 flex justify-center mt-6">
                  <x-recaptcha action="risk_assessment" />
                </div>
                <div class="col-span-1 md:col-span-2 flex justify-center mt-6">
                  <button type="submit" class="bg-[#D4AF37] text-[#F1F3F5] px-6 sm:px-20 md:px-40 py-3 sm:py-4 rounded-lg text-base sm:text-[19px] font-neue-bold w-full sm:w-auto">
                    {{ $tools ? (app()->getLocale() === 'ar' ? $tools->form_button_text_ar : $tools->form_button_text_en) : 'SEND MESSAGE' }}
                  </button>
                </div>
              </form>
            </div>
          </section>
@endsection

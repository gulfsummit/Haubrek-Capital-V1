@php
    $backgroundImage = $backgroundImage ?? asset('design/images/meeting-bg.png');
    $backgroundAlt = $backgroundAlt ?? trim(strip_tags($titleHtml ?? 'CTA Background'));
    $titleHtml = $titleHtml ?? 'READY TO<br/>START GROWING?!';
    $descriptionHtml = $descriptionHtml ?? 'Unlock the full potential of your wealth';
    $buttonOneText = $buttonOneText ?? 'JOIN OUR MAILING LIST';
    $buttonOneUrl = $buttonOneUrl ?? '#';
    $buttonTwoText = $buttonTwoText ?? 'REQUEST A MEETING';
    $buttonTwoUrl = $buttonTwoUrl ?? '#';
@endphp

<section class="relative md:h-[100vh] md:max-h-[557px] text-white overflow-hidden z-0 flex items-end">
    <div class="absolute inset-0 z-0">
        <img loading="lazy" src="{{ $backgroundImage }}" alt="{{ $backgroundAlt }}" class="w-full h-full object-cover object-center"/>
    </div>

    <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4 relative z-10 w-full py-16">
        <div class="flex flex-col md:flex-row items-center mx-auto desktop-reverse-flex">
            <div class="mb-10 md:mb-0 w-full">
                <h2 class="text-[2.19125rem] md:text-[3.18875rem] leading-[1.1] font-neue-extrabold text-white mb-6">
                    {!! $titleHtml !!}
                </h2>
                <div style="font-size:0.81875rem; line-height:1.175rem;" class="md:text-[1.19125rem] md:leading-[1.7125rem] font-['Poppins'] remove-max-width opacity-90 mb-8 max-w-md">
                    {!! $descriptionHtml !!}
                </div>

                <div class="flex flex-col sm:flex-row gap-10 desktop-reverse-flex">
                    <a href="{{ $buttonOneUrl }}" class="inline-block bg-transparent leading-[25.1px] border-[1px] border-white text-white text-center xl:text-[19px] font-neue-extrabold px-[30px] py-[15px] md:text-[11px] md:px-[30px] md:py-[13.7px] xl:px-[70.5px] xl:py-[16.77px] rounded-md hover:bg-white/10 transition-all duration-300 sm:w-auto">
                        {{ $buttonOneText }}
                    </a>

                    <a href="{{ $buttonTwoUrl }}" class="inline-block bg-transparent leading-[25.1px] border-[1px] border-white text-white text-center xl:text-[19px] font-neue-extrabold px-[30px] py-[15px] md:text-[11px] md:px-[30px] md:py-[13.7px] xl:px-[70.5px] xl:py-[16.77px] rounded-md hover:bg-white/10 transition-all duration-300 sm:w-auto">
                        {{ $buttonTwoText }}
                    </a>
                </div>
            </div>

            <div class="w-full md:w-1/2"></div>
        </div>
    </div>
</section>

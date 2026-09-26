 <section class="bg-white py-8 md:py-24">
        <div class="w-full xl:max-w-[1300px] md:max-w-[950px] mx-auto px-4">
            <div class="flex flex-col lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <!-- Left Side: Text and Service Buttons -->
                <div class="mb-8 lg:mb-0">
                    <h2 class="text-[30px] xl:text-[48px] font-neue-extrabold text-[#041B44] mb-3 md:mb-4 text-center lg:text-left leading-[32.1px] xl:leading-[62px]">HOW WE CAN<br class="lg:hidden"/> ASSIST</h2>
                    <p class="text-[#041B44] lg:pr-10 mb-6 md:mb-8 max-w-xl font-['Poppins'] tracking-[0] xl:text-[18px] text-[1rem] opacity-60 text-center lg:text-left mx-auto lg:mx-0">
                        Our services are designed to help you achieve your goals and enrich your investment journey, supported by our professionals who serve as your dedicated investment office.
                    </p>

                    <!-- Our Services Button (desktop only) -->
                    <button onclick="window.location.href='services.html'" class="hidden lg:block bg-[#D4AF37] text-white px-6 md:px-8 py-2 md:py-3 rounded-lg mb-8 md:mb-12 font-neue-extrabold xl:text-[18px]">OUR SERVICES</button>

                    <!-- Mobile Image (shown only on mobile) -->
                    <div class="block lg:hidden mb-6">
                        <div class="relative w-full h-[280px] rounded-[20px] overflow-hidden">
                            <img src="{{asset('design')}}/images/assist1.png" alt="Governance Advisory" class="w-full h-full object-cover"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <div class="flex flex-col">
                                    <div>
                                        <h3 class="text-lg font-neue-bold mb-2 text-white">GOVERNANCE ADVISORY</h3>
                                        <p class="text-[13px] xl:text-[18px] font-['Poppins'] mb-2 text-white">The investment offices and Endowment funds for HNWI, Family Offices, and Endowments</p>
                                    </div>
                                    <div class="flex justify-end">
                                        <a href="governance-services.html" class="text-[#D4AF37] font-neue-bold text-sm">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<div class="grid grid-cols-2 gap-3 lg:grid-cols-2 lg:gap-4 md:gap-6 xl:gap-8">
    @foreach($services as $index => $service)
        <a href="{{route('service.show', ['id' => $service['id']])}}" type="button"
            class="service-btn {{ ($service['highlight'] ?? false) ? 'bg-[#D4AF37]' : 'bg-[#1a1f2e]' }} text-white font-neue-bold p-4 lg:p-6 md:p-8 xl:p-8 rounded-lg hover:opacity-90 transition-all text-center text-[15.54px] lg:text-base md:text-lg xl:text-[30px] h-[100px] lg:h-[160px] xl:h-[160px] flex items-center justify-center leading-[1.2] lg:leading-[1.1]"
            data-index="{{ $index }}"
        >
            <span>{!! $service['title_en'] !!}</span>
        </a href="">
    @endforeach
</div>

                    <!-- Our Services Button (mobile only) -->
                    <button class="block lg:hidden bg-[#D4AF37] md:text-[18px] text-white px-6 py-3 rounded-lg font-neue-extrabold text-[10.28px] mt-6 mx-auto">OUR SERVICES</button>
                </div>

                <!-- Right Side: Image and Description -->
                <div class="hidden lg:block relative w-full h-[500px] xl:h-[715px] overflow-hidden lg:mt-[-45px]" id="serviceContent">
                    <!-- Content will be dynamically inserted here by JavaScript -->
                </div>
            </div>
        </div>
    </section>
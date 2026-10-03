@php
    $isArabic = app()->getLocale() === 'ar';
@endphp

<section class="bg-[#F5F5F0] border-t border-gray-200">
    <div class="xl:max-w-[1300px] md:max-w-[950px] mx-auto px-6 lg:px-8 py-6">
        <p class="text-[#041B44] text-sm leading-relaxed font-['Poppins']" dir="{{ $isArabic ? 'rtl' : 'ltr' }}" style="font-size: 0.8125rem !important; line-height: 1.6 !important;">
            @if($isArabic)
                <span class="font-semibold">إخلاء مسؤولية هوبرك:</span>
                تُقدَّم هذه المادة لأغراض المعلومات العامة والنقاش فحسب. ولا تُشكّل نصيحةً استثمارية، ولا عرضاً، ولا توصيةً بشراء أو بيع أي أداة مالية. ينبغي للمستثمرين الحصول على المشورة المهنية المناسبة بناءً على ظروفهم الفردية.
            @else
                <span class="font-semibold">Hauberk Disclaimer:</span>
                This material is provided for general information and discussion purposes only. It does not constitute investment advice, an offer, or a recommendation to buy or sell any financial instrument. Investors should obtain appropriate professional advice based on their individual circumstances.
            @endif
        </p>
    </div>
</section>

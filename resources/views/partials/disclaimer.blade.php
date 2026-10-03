@php
    $isArabic = app()->getLocale() === 'ar';
@endphp

<div style="background-color: #F5F5F0; border-top: 1px solid #e5e7eb; width: 100%; box-sizing: border-box;">
    <div style="max-width: 1300px; margin: 0 auto; padding: 1.25rem 2rem; box-sizing: border-box;">
        <p style="
            font-family: 'Poppins', sans-serif !important;
            font-size: 0.8125rem !important;
            line-height: 1.6 !important;
            color: #041B44;
            margin: 0;
            direction: {{ $isArabic ? 'rtl' : 'ltr' }};
            text-align: {{ $isArabic ? 'right' : 'left' }};
            unicode-bidi: plaintext;
        ">
            @if($isArabic)
                <strong>إخلاء مسؤولية هوبرك:</strong>
                تُقدَّم هذه المادة لأغراض المعلومات العامة والنقاش فحسب. ولا تُشكّل نصيحةً استثمارية، ولا عرضاً، ولا توصيةً بشراء أو بيع أي أداة مالية. ينبغي للمستثمرين الحصول على المشورة المهنية المناسبة بناءً على ظروفهم الفردية.
            @else
                <strong>Hauberk Disclaimer:</strong>
                This material is provided for general information and discussion purposes only. It does not constitute investment advice, an offer, or a recommendation to buy or sell any financial instrument. Investors should obtain appropriate professional advice based on their individual circumstances.
            @endif
        </p>
    </div>
</div>

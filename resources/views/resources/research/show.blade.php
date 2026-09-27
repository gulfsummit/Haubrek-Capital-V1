@extends('app')

@section('content')
@php
    $locale = app()->getLocale();
    $isArabic = $locale === 'ar';
    $localize = $localize ?? function ($en, $ar) use ($locale) {
        return $locale === 'ar' ? ($ar ?: $en) : ($en ?: $ar);
    };
    $pageDirection  = $isArabic ? 'rtl' : 'ltr';
    $alignmentClass = $isArabic ? 'text-right' : 'text-left';

    $title       = $localize($research->title_en, $research->title_ar);
    $description = $localize($research->short_description_en, $research->short_description_ar);
    $resType     = $localize($research->research_type_en, $research->research_type_ar);
    $author      = $localize($research->author_en, $research->author_ar);
    $image       = $research->cover_image ? asset('storage/' . $research->cover_image) : asset('design/images/blog.png');
    $imageAlt    = $localize($research->cover_image_alt_en, $research->cover_image_alt_ar) ?: $title;
    $breadcrumbSep = $isArabic ? '<span class="text-gray-400 mx-2">/</span>' : '<span class="text-gray-400 mx-2">></span>';
    $homeLabel   = $isArabic ? 'الرئيسية' : 'Home';
    $listLabel   = $isArabic ? 'الأبحاث' : 'Research';
    $backLabel   = $isArabic ? 'العودة إلى الأبحاث' : 'Back to Research';
    $latestLabel = $isArabic ? 'أبحاث أخرى' : 'OTHER RESEARCH';
    $downloadLabel = $isArabic ? 'تحميل التقرير' : 'Download Report';
    $downloadFormTitle = $isArabic ? 'تحميل تقرير البحث' : 'Download Research Report';
    $downloadFormSubtitle = $isArabic ? 'يُرجى ملء النموذج أدناه للوصول إلى تقرير البحث.' : 'Please fill in the form below to access the research report.';
    $countries = ['Afghanistan','Albania','Algeria','Andorra','Angola','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahrain','Bangladesh','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Canada','Chad','Chile','China','Colombia','Congo','Costa Rica','Croatia','Cuba','Cyprus','Czech Republic','Denmark','Dominican Republic','Ecuador','Egypt','El Salvador','Estonia','Ethiopia','Finland','France','Gabon','Gambia','Georgia','Germany','Ghana','Greece','Guatemala','Guinea','Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Ivory Coast','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Libya','Lithuania','Luxembourg','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Mauritania','Mauritius','Mexico','Moldova','Monaco','Mongolia','Morocco','Mozambique','Myanmar','Namibia','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','North Korea','Norway','Oman','Pakistan','Palestine','Panama','Paraguay','Peru','Philippines','Poland','Portugal','Qatar','Romania','Russia','Rwanda','Saudi Arabia','Senegal','Serbia','Sierra Leone','Singapore','Slovakia','Slovenia','Somalia','South Africa','South Korea','South Sudan','Spain','Sri Lanka','Sudan','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Togo','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe'];
@endphp

{{-- Breadcrumb --}}
<section class="bg-[#041B44] pt-32 pb-4">
    <div class="container mx-auto px-4" dir="{{ $pageDirection }}">
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-white/60 hover:text-[#D4AF37] transition-colors">{{ $homeLabel }}</a>
            {!! $breadcrumbSep !!}
            <a href="{{ route('research') }}" class="text-white/60 hover:text-[#D4AF37] transition-colors">{{ $listLabel }}</a>
            {!! $breadcrumbSep !!}
            <span class="text-[#D4AF37] font-medium">{{ Str::limit($title, 40) }}</span>
        </nav>
    </div>
</section>

<section class="py-8 bg-white" dir="{{ $pageDirection }}">
    <div class="container mx-auto px-4">
        {{-- Cover Image --}}
        <div class="rounded-lg overflow-hidden mb-8 max-h-[450px]">
            <img src="{{ $image }}" alt="{{ $imageAlt }}" class="w-full h-full object-cover"/>
        </div>

        <div class="flex flex-col lg:flex-row gap-10 {{ $isArabic ? 'lg:flex-row-reverse' : '' }}">
            <main class="flex-1 min-w-0">
                @if($resType)
                    <span class="inline-block text-xs font-semibold text-[#b8962e] bg-[#D4AF37]/10 px-3 py-1 rounded mb-3">{{ $resType }}</span>
                @endif

                <h1 class="text-3xl md:text-4xl font-neue-extrabold text-gray-900 mb-4 {{ $alignmentClass }}">{{ $title }}</h1>

                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-6">
                    @if($author)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $author }}
                        </span>
                    @endif
                    @if($research->publication_date)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $research->publication_date->format('d M Y') }}
                        </span>
                    @endif
                </div>

                @if($description)
                    <div class="text-gray-600 leading-relaxed mb-8 {{ $alignmentClass }}">{{ $description }}</div>
                @endif

                @if(!empty($research->topics))
                    <div class="flex flex-wrap gap-2 mb-8">
                        @foreach($research->topics as $topic)
                            <span class="text-xs bg-[#D4AF37]/10 text-[#b8962e] px-3 py-1 rounded-full">{{ $topic }}</span>
                        @endforeach
                    </div>
                @endif

                {{-- Download Section --}}
                @if($research->pdf_file)
                    @if(!$research->form_required)
                        {{-- Free download: direct link --}}
                        <div class="my-8 p-6 bg-gray-50 rounded-xl border border-gray-100">
                            <a href="{{ asset('storage/' . $research->pdf_file) }}" target="_blank" download
                               class="inline-flex items-center gap-2 bg-[#D4AF37] text-white px-6 py-3 rounded font-semibold hover:bg-[#b8962e] transition text-base">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ $downloadLabel }}
                            </a>
                        </div>
                    @else
                        {{-- Form required: show download form --}}
                        <div class="my-8 p-6 bg-gray-50 rounded-xl border border-gray-100" id="download-form">
                            <h2 class="text-xl font-bold text-gray-800 mb-1 {{ $alignmentClass }}">{{ $downloadFormTitle }}</h2>
                            <p class="text-gray-500 text-sm mb-6 {{ $alignmentClass }}">{{ $downloadFormSubtitle }}</p>

                            @if($errors->any())
                                <div class="bg-red-50 border border-red-200 rounded p-4 mb-4">
                                    <ul class="text-sm text-red-600 space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li>• {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('research.download', $research->slug) }}" method="POST" dir="{{ $pageDirection }}">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1 {{ $alignmentClass }}">
                                            {{ $isArabic ? 'الاسم الأول' : 'First Name' }} <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="first_name" value="{{ old('first_name') }}" required
                                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#D4AF37] @error('first_name') border-red-400 @enderror"/>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1 {{ $alignmentClass }}">
                                            {{ $isArabic ? 'اسم العائلة' : 'Last Name' }} <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="last_name" value="{{ old('last_name') }}" required
                                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#D4AF37] @error('last_name') border-red-400 @enderror"/>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1 {{ $alignmentClass }}">
                                            {{ $isArabic ? 'البريد الإلكتروني المهني' : 'Business Email' }} <span class="text-red-500">*</span>
                                        </label>
                                        <input type="email" name="business_email" value="{{ old('business_email') }}" required
                                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#D4AF37] @error('business_email') border-red-400 @enderror"/>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1 {{ $alignmentClass }}">
                                            {{ $isArabic ? 'الشركة' : 'Company' }} <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="company" value="{{ old('company') }}" required
                                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#D4AF37] @error('company') border-red-400 @enderror"/>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1 {{ $alignmentClass }}">
                                            {{ $isArabic ? 'المسمى الوظيفي' : 'Job Title' }} <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="job_title" value="{{ old('job_title') }}" required
                                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#D4AF37] @error('job_title') border-red-400 @enderror"/>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1 {{ $alignmentClass }}">
                                            {{ $isArabic ? 'الدولة' : 'Country' }} <span class="text-red-500">*</span>
                                        </label>
                                        <select name="country" required
                                                class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#D4AF37] @error('country') border-red-400 @enderror">
                                            <option value="">{{ $isArabic ? 'اختر الدولة' : 'Select Country' }}</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country }}" {{ old('country') === $country ? 'selected' : '' }}>{{ $country }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1 {{ $alignmentClass }}">
                                            {{ $isArabic ? 'رقم الهاتف (اختياري)' : 'Phone Number (Optional)' }}
                                        </label>
                                        <input type="tel" name="phone_number" value="{{ old('phone_number') }}"
                                               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#D4AF37]"/>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit"
                                            class="w-full md:w-auto inline-flex items-center justify-center gap-2 bg-[#D4AF37] text-white px-8 py-3 rounded font-semibold hover:bg-[#b8962e] transition text-base">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        {{ $downloadLabel }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                @endif

                {{-- Back --}}
                <div class="mt-10">
                    <a href="{{ route('research') }}" class="inline-flex items-center gap-2 text-[#D4AF37] font-semibold hover:text-[#b8962e] transition">
                        <svg class="w-4 h-4 {{ $isArabic ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        {{ $backLabel }}
                    </a>
                </div>
            </main>

            {{-- Sidebar --}}
            @if($latestItems->isNotEmpty())
            <aside class="lg:w-80 shrink-0">
                <h3 class="text-lg font-bold text-gray-900 mb-4 {{ $alignmentClass }}">{{ $latestLabel }}</h3>
                <div class="space-y-4">
                    @foreach($latestItems as $item)
                    @php
                        $iTitle = $localize($item->title_en, $item->title_ar);
                        $iImg   = $item->cover_image ? asset('storage/' . $item->cover_image) : asset('design/images/blog.png');
                        $iType  = $localize($item->research_type_en, $item->research_type_ar);
                    @endphp
                    <a href="{{ route('research.show', $item->slug) }}" class="flex gap-3 group">
                        <div class="w-20 h-16 shrink-0 rounded overflow-hidden">
                            <img src="{{ $iImg }}" alt="{{ $iTitle }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform"/>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 group-hover:text-[#D4AF37] transition line-clamp-2 {{ $alignmentClass }}">{{ $iTitle }}</p>
                            @if($iType) <p class="text-xs text-gray-400 mt-1">{{ $iType }}</p> @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </aside>
            @endif
        </div>
    </div>
</section>

@endsection

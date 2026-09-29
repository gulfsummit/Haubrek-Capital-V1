{{--
    Resource card partial.
    Variables:
      $enabled     – bool: whether the card is active
      $link        – string|null: resolved URL
      $image       – string|null: storage path (used with asset('storage/...'))
      $fallback    – string: fallback asset path, e.g. 'design/images/articles.png'
      $alt         – string: image alt text
      $label       – string: overlay label text
      $textSize    – (optional) Tailwind text size classes, defaults to 'text-xl sm:text-2xl md:text-2xl'
      $heightClass – (optional) Tailwind height classes, defaults to 'h-[180px] sm:h-[200px] md:h-[220px]'
--}}
@php
    $textSize    = $textSize    ?? 'text-xl sm:text-2xl md:text-2xl';
    $heightClass = $heightClass ?? 'h-[180px] sm:h-[200px] md:h-[220px]';
    $extraClass  = $extraClass  ?? '';
    $widthClass  = $widthClass  ?? 'w-full';
@endphp

<div class="bg-transparent rounded-xl overflow-hidden flex flex-col items-center {{ $widthClass }} {{ $heightClass }} {{ $extraClass }}">
    @if($enabled && $link)
        <a href="{{ $link }}" class="relative w-full h-full group">
            <img
                src="{{ $image ? asset('storage/' . $image) : asset($fallback) }}"
                alt="{{ $alt }}"
                class="w-full h-full object-cover rounded-lg transition group-hover:scale-105 duration-300"
            >
            {{-- dark overlay so the label is always readable --}}
            <span class="absolute inset-0 bg-[#041B44]/50 rounded-lg transition group-hover:bg-[#041B44]/60 duration-300"></span>
            <span class="absolute inset-0 flex items-center justify-center {{ $textSize }} font-neue-extrabold text-white drop-shadow-lg text-center leading-tight px-2">
                {{ $label }}
            </span>
        </a>
    @else
        <div class="relative w-full h-full pointer-events-none opacity-60">
            <img
                src="{{ $image ? asset('storage/' . $image) : asset($fallback) }}"
                alt="{{ $alt }}"
                class="w-full h-full object-cover rounded-lg"
            >
            <span class="absolute inset-0 bg-[#041B44]/50 rounded-lg"></span>
            <span class="absolute inset-0 flex items-center justify-center {{ $textSize }} font-neue-extrabold text-white drop-shadow-lg text-center leading-tight px-2">
                {{ $label }}
            </span>
        </div>
    @endif
</div>

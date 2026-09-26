@props(['pageName'])

@if(isset($websiteSettings) && $websiteSettings->page_backgrounds)
    @php
        $pageBackgrounds = $websiteSettings->page_backgrounds;
        $currentPage = null;
        
        // Find the current page background settings
        foreach ($pageBackgrounds as $background) {
            if (isset($background['page']) && $background['page'] === $pageName) {
                $currentPage = $background;
                break;
            }
        }
        
        // Get background classes and styles
        $backgroundClasses = 'min-h-screen';
        $backgroundStyles = '';
        
        if ($currentPage && isset($currentPage['type'])) {
            switch ($currentPage['type']) {
                case 'transparent':
                    $backgroundClasses .= ' bg-transparent';
                    break;
                case 'solid':
                    if (isset($currentPage['color']) && $currentPage['color']) {
                        $backgroundClasses .= " bg-[{$currentPage['color']}]";
                    } else {
                        $backgroundClasses .= ' bg-transparent';
                    }
                    break;
                case 'gradient':
                    if (isset($currentPage['gradient_start']) && isset($currentPage['gradient_end']) && 
                        $currentPage['gradient_start'] && $currentPage['gradient_end']) {
                        $backgroundClasses .= " bg-gradient-to-r from-[{$currentPage['gradient_start']}] to-[{$currentPage['gradient_end']}]";
                    } else {
                        $backgroundClasses .= ' bg-transparent';
                    }
                    break;
                case 'image':
                    if (isset($currentPage['image']) && $currentPage['image']) {
                        $backgroundClasses .= ' bg-cover bg-center bg-no-repeat';
                        $backgroundStyles = "background-image: url('" . asset('storage/' . $currentPage['image']) . "');";
                    } else {
                        $backgroundClasses .= ' bg-transparent';
                    }
                    break;
                default:
                    $backgroundClasses .= ' bg-transparent';
                    break;
            }
        } else {
            $backgroundClasses .= ' bg-transparent';
        }
    @endphp
    
    <div class="{{ $backgroundClasses }}" style="{{ $backgroundStyles }}">
        {{ $slot }}
    </div>
@else
    <div class="min-h-screen">
        {{ $slot }}
    </div>
@endif

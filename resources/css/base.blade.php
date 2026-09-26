@props([
    'livewire' => null,
])

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
    @class([
        'fi min-h-screen',
        'dark' => filament()->hasDarkModeForced(),
    ])
>

    <head>
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::HEAD_START, scopes: $livewire->getRenderHookScopes()) }}

        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        @if ($favicon = filament()->getFavicon())
            <link rel="icon" href="{{ $favicon }}" />
        @endif

        @php
            $title = trim(strip_tags(($livewire ?? null)?->getTitle() ?? ''));
            $brandName = trim(strip_tags(filament()->getBrandName()));
        @endphp

        <title>
            {{ filled($title) ? "{$title} - " : null }} {{ $brandName }}
        </title>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::STYLES_BEFORE, scopes: $livewire->getRenderHookScopes()) }}

        <style>
            [x-cloak=''],
            [x-cloak='x-cloak'],
            [x-cloak='1'] {
                display: none !important;
            }

            @media (max-width: 1023px) {
                [x-cloak='-lg'] {
                    display: none !important;
                }
            }

            @media (min-width: 1024px) {
                [x-cloak='lg'] {
                    display: none !important;
                }
            }

            /* Rich Editor Text Wrapping Fix */
            .ProseMirror {
                white-space: normal !important;
                word-wrap: break-word !important;
                overflow-wrap: break-word !important;
                word-break: break-word !important;
                hyphens: auto !important;
                overflow-x: hidden !important;
                width: 100% !important;
                max-width: 100% !important;
                box-sizing: border-box !important;
                height: auto !important;
                max-height: none !important;
            }

            .ProseMirror * {
                white-space: normal !important;
                word-wrap: break-word !important;
                overflow-wrap: break-word !important;
                word-break: break-word !important;
                max-width: 100% !important;
                box-sizing: border-box !important;
            }

            [data-field-wrapper-type="rich-editor"] .ProseMirror,
            .fi-fo-rich-editor .ProseMirror,
            .tiptap.ProseMirror {
                white-space: normal !important;
                word-wrap: break-word !important;
                overflow-wrap: break-word !important;
                word-break: break-word !important;
                overflow-x: hidden !important;
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                max-height: none !important;
            }
        </style>

        @filamentStyles

        {{ filament()->getTheme()->getHtml() }}
        {{ filament()->getFontHtml() }}

        <style>
            :root {
                --font-family: '{!! filament()->getFontFamily() !!}';
                --sidebar-width: {{ filament()->getSidebarWidth() }};
                --collapsed-sidebar-width: {{ filament()->getCollapsedSidebarWidth() }};
                --default-theme-mode: {{ filament()->getDefaultThemeMode()->value }};
            }
        </style>

        @stack('styles')

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <style>
            /* Global Typography Styles - with !important to override inline styles */
            p {
                font-family: 'Poppins', sans-serif !important;
            }

            h1, h4, h5, h6 {
                font-family: 'Neue-Bold', 'Neue Haas Grotesk Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
                font-weight: 700 !important;
                line-height: 1.2;
                margin-bottom: 1rem;
            }

            h1 {
                font-family: 'Neue-ExtraBold', 'Neue Haas Grotesk Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
                font-size: 3.125rem !important;
                font-weight: 800 !important;
                line-height: 5.438rem !important;
            }

            h4 {
                font-size: 1.5rem !important;
                font-weight: 600 !important;
            }

            h5 {
                font-size: 1.25rem !important;
                font-weight: 600 !important;
            }

            h6 {
                font-size: 1.125rem !important;
                font-weight: 600 !important;
            }

            /* RichEditor content styles */
            .tiptap.ProseMirror p,
            .ProseMirror p {
                font-family: 'Poppins', sans-serif !important;
                font-weight: 400;
                line-height: 1.7;
                margin-bottom: 0.5em;
            }

            .tiptap.ProseMirror h1,
            .tiptap.ProseMirror h4,
            .tiptap.ProseMirror h5,
            .tiptap.ProseMirror h6,
            .ProseMirror h1,
            .ProseMirror h4,
            .ProseMirror h5,
            .ProseMirror h6 {
                font-family: 'Neue-Bold', 'Neue Haas Grotesk Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
                font-weight: 700 !important;
                margin-top: 0.5em;
                margin-bottom: 0.5em;
            }

            /* Preserve inline font sizes from custom RichEditor */
            .tiptap.ProseMirror span[style*="font-size"],
            .ProseMirror span[style*="font-size"] {
                display: inline !important;
            }

            /* Font size control for RichEditor */
            .fi-fo-rich-editor-font-control {
                margin-bottom: 0.5rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.5rem 0.75rem;
                background-color: rgb(249 250 251);
                border: 1px solid rgb(209 213 219);
                border-radius: 0.5rem;
            }

            .dark .fi-fo-rich-editor-font-control {
                background-color: rgb(31 41 55);
                border-color: rgb(75 85 99);
            }

            .fi-fo-rich-editor-font-control label {
                margin: 0;
                font-size: 0.875rem;
                font-weight: 500;
                color: rgb(55 65 81);
            }

            .dark .fi-fo-rich-editor-font-control label {
                color: rgb(209 213 219);
            }

            .fi-fo-rich-editor-font-control select {
                min-width: 120px;
                padding: 0.375rem 0.5rem;
                border: 1px solid rgb(209 213 219);
                border-radius: 0.375rem;
                font-size: 0.875rem;
                background-color: white;
            }

            .dark .fi-fo-rich-editor-font-control select {
                background-color: rgb(55 65 81);
                border-color: rgb(75 85 99);
                color: rgb(249 250 251);
            }

            .fi-fo-rich-editor-font-control .hint {
                font-size: 0.75rem;
                color: rgb(107 114 128);
                margin-left: auto;
            }
        </style>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::STYLES_AFTER, scopes: $livewire->getRenderHookScopes()) }}

        @if (! filament()->hasDarkMode())
            <script>
                localStorage.setItem('theme', 'light')
            </script>
        @elseif (filament()->hasDarkModeForced())
            <script>
                localStorage.setItem('theme', 'dark')
            </script>
        @else
            <script>
                const loadDarkMode = () => {
                    window.theme = localStorage.getItem('theme') ?? @js(filament()->getDefaultThemeMode()->value)

                    if (
                        window.theme === 'dark' ||
                        (window.theme === 'system' &&
                            window.matchMedia('(prefers-color-scheme: dark)')
                                .matches)
                    ) {
                        document.documentElement.classList.add('dark')
                    }
                }

                loadDarkMode()

                document.addEventListener('livewire:navigated', loadDarkMode)
            </script>
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::HEAD_END, scopes: $livewire->getRenderHookScopes()) }}
    </head>

    <body
        {{ $attributes
                ->merge(($livewire ?? null)?->getExtraBodyAttributes() ?? [], escape: false)
                ->class([
                    'fi-body',
                    'fi-panel-' . filament()->getId(),
                    'min-h-screen bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white',
                ]) }}
    >
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::BODY_START, scopes: $livewire->getRenderHookScopes()) }}

        {{ $slot }}

        @livewire(Filament\Livewire\Notifications::class)

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SCRIPTS_BEFORE, scopes: $livewire->getRenderHookScopes()) }}

        @filamentScripts(withCore: true)

        @if (filament()->hasBroadcasting() && config('filament.broadcasting.echo'))
            <script data-navigate-once>
                window.Echo = new window.EchoFactory(@js(config('filament.broadcasting.echo')))

                window.dispatchEvent(new CustomEvent('EchoLoaded'))
            </script>
        @endif

        @if (filament()->hasDarkMode() && (! filament()->hasDarkModeForced()))
            <script>
                loadDarkMode()
            </script>
        @endif

        @stack('scripts')

        <script>
            // Font size control for RichEditors
            (function() {
                function initFontSizeControls() {
                    document.querySelectorAll('.tiptap.ProseMirror').forEach(editor => {
                        const container = editor.closest('[wire\\:ignore]');
                        if (!container || container.querySelector('.fi-fo-rich-editor-font-control')) return;

                        const control = document.createElement('div');
                        control.className = 'fi-fo-rich-editor-font-control';
                        control.innerHTML = `
                            <label>Font Size:</label>
                            <select>
                                <option value="">Select...</option>
                                <option value="8">8px</option>
                                <option value="10">10px</option>
                                <option value="12">12px</option>
                                <option value="14">14px</option>
                                <option value="16">16px</option>
                                <option value="18">18px</option>
                                <option value="20">20px</option>
                                <option value="24">24px</option>
                                <option value="28">28px</option>
                                <option value="32">32px</option>
                                <option value="36">36px</option>
                                <option value="48">48px</option>
                                <option value="60">60px</option>
                                <option value="72">72px</option>
                            </select>
                            <span class="hint">↑ Select text first</span>
                        `;

                        editor.parentNode.insertBefore(control, editor);

                        control.querySelector('select').addEventListener('change', function(e) {
                            const size = e.target.value;
                            if (!size) return;

                            editor.focus();
                            const selection = window.getSelection();
                            if (!selection.rangeCount || !selection.toString()) {
                                alert('Please select some text first');
                                e.target.value = '';
                                return;
                            }

                            const range = selection.getRangeAt(0);
                            const span = document.createElement('span');
                            span.style.fontSize = size + 'px';
                            span.appendChild(range.extractContents());
                            range.insertNode(span);

                            editor.dispatchEvent(new Event('input', { bubbles: true }));
                            e.target.value = '';
                        });
                    });
                }

                // Initialize on page load
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', () => {
                        setTimeout(initFontSizeControls, 500);
                    });
                } else {
                    setTimeout(initFontSizeControls, 500);
                }

                // Re-initialize on Livewire events
                document.addEventListener('livewire:navigated', () => setTimeout(initFontSizeControls, 500));

                if (window.Livewire) {
                    Livewire.hook('morph.updated', () => setTimeout(initFontSizeControls, 300));
                }

                // Watch for dynamically added editors
                const observer = new MutationObserver(() => setTimeout(initFontSizeControls, 200));
                observer.observe(document.body, { childList: true, subtree: true });
            })();
        </script>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SCRIPTS_AFTER, scopes: $livewire->getRenderHookScopes()) }}

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::BODY_END, scopes: $livewire->getRenderHookScopes()) }}
    </body>
</html>

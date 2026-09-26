<style>
/* Custom styles for Rich Editor with font size control */
.font-size-control-wrapper {
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    background-color: #f9fafb;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
}

.dark .font-size-control-wrapper {
    background-color: #1f2937;
    border-color: #4b5563;
}

.font-size-control-wrapper label {
    margin: 0;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    white-space: nowrap;
}

.dark .font-size-control-wrapper label {
    color: #d1d5db;
}

.font-size-selector {
    min-width: 120px;
    padding: 0.375rem 0.5rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    background-color: white;
    color: #111827;
}

.dark .font-size-selector {
    background-color: #374151;
    border-color: #4b5563;
    color: #f9fafb;
}

.font-size-control-hint {
    font-size: 0.75rem;
    color: #6b7280;
    margin-left: auto;
}

.dark .font-size-control-hint {
    color: #9ca3af;
}

/* Ensure inline font sizes are preserved in editor */
.tiptap.ProseMirror span[style*="font-size"] {
    display: inline !important;
}
</style>

<script>
// Add font size control to all Filament Rich Editors
(function() {
    'use strict';
    
    console.log('Font size control script loaded');
    
    function addFontSizeControl(container) {
        // Check if already has control
        if (container.querySelector('.font-size-control-wrapper')) {
            return;
        }

        // Find the ProseMirror editor
        const editor = container.querySelector('.tiptap.ProseMirror');
        if (!editor) {
            console.log('No ProseMirror editor found in container');
            return;
        }

        console.log('Adding font size control to editor');

        // Create control wrapper
        const controlWrapper = document.createElement('div');
        controlWrapper.className = 'font-size-control-wrapper';
        controlWrapper.innerHTML = `
            <label for="font-size-${Date.now()}">Font Size:</label>
            <select class="font-size-selector" id="font-size-${Date.now()}">
                <option value="">Select size...</option>
                <option value="8">8px (Tiny)</option>
                <option value="10">10px (Very Small)</option>
                <option value="12">12px (Small)</option>
                <option value="14">14px (Normal)</option>
                <option value="16">16px (Medium)</option>
                <option value="18">18px (Large)</option>
                <option value="20">20px (Larger)</option>
                <option value="24">24px (Extra Large)</option>
                <option value="28">28px (Huge)</option>
                <option value="32">32px (Extra Huge)</option>
                <option value="36">36px</option>
                <option value="48">48px</option>
                <option value="60">60px</option>
                <option value="72">72px</option>
            </select>
            <span class="font-size-control-hint">↑ Select text first, then choose size</span>
        `;

        // Insert before editor
        editor.parentNode.insertBefore(controlWrapper, editor);

        // Add change event listener
        const select = controlWrapper.querySelector('.font-size-selector');
        select.addEventListener('change', function(e) {
            const size = e.target.value;
            
            if (!size) return;

            console.log('Applying font size:', size);
            
            // Focus the editor
            editor.focus();

            // Save selection
            const selection = window.getSelection();
            if (!selection.rangeCount) {
                alert('Please select some text first');
                e.target.value = '';
                return;
            }

            const range = selection.getRangeAt(0);
            const selectedText = range.toString();

            if (!selectedText) {
                alert('Please select some text first');
                e.target.value = '';
                return;
            }

            // Create span with font size
            const span = document.createElement('span');
            span.style.fontSize = size + 'px';
            
            try {
                // Extract contents and wrap in span
                const contents = range.extractContents();
                span.appendChild(contents);
                range.insertNode(span);
                
                // Trigger input event for Livewire
                const inputEvent = new Event('input', { bubbles: true });
                editor.dispatchEvent(inputEvent);
                
                console.log('Font size applied successfully');
            } catch (error) {
                console.error('Error applying font size:', error);
            }

            // Reset select
            e.target.value = '';
        });
    }

    function initAllRichEditors() {
        console.log('Initializing rich editors...');
        
        // Find all rich editor fields - try multiple selectors
        const selectors = [
            '[data-field-wrapper] [x-data*="richEditor"]',
            '.fi-fo-rich-editor',
            '[wire\\:ignore] .tiptap.ProseMirror'
        ];

        let editorsFound = 0;
        
        selectors.forEach(selector => {
            document.querySelectorAll(selector).forEach(element => {
                // Find the closest container with the editor
                let container = element;
                if (!element.querySelector('.tiptap.ProseMirror')) {
                    container = element.closest('[wire\\:ignore]') || element.closest('.fi-fo-field-wrp') || element;
                }
                
                if (container && container.querySelector('.tiptap.ProseMirror')) {
                    addFontSizeControl(container);
                    editorsFound++;
                }
            });
        });

        // Also try finding ProseMirror editors directly
        document.querySelectorAll('.tiptap.ProseMirror').forEach(editor => {
            const container = editor.closest('[wire\\:ignore]') || editor.closest('.fi-fo-field-wrp') || editor.parentElement;
            if (container) {
                addFontSizeControl(container);
                editorsFound++;
            }
        });

        console.log('Total editors found and initialized:', editorsFound);
    }

    // Initialize on different events
    function init() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAllRichEditors);
        } else {
            initAllRichEditors();
        }

        // Re-init after short delay (for dynamically loaded content)
        setTimeout(initAllRichEditors, 500);
        setTimeout(initAllRichEditors, 1000);
        setTimeout(initAllRichEditors, 2000);
    }

    // Run initialization
    init();

    // Listen for Livewire events
    document.addEventListener('livewire:navigated', function() {
        console.log('Livewire navigated, re-initializing...');
        setTimeout(initAllRichEditors, 100);
    });

    // Listen for Livewire updates
    if (window.Livewire) {
        Livewire.hook('morph.updated', ({ el, component }) => {
            console.log('Livewire morph updated, re-initializing...');
            setTimeout(initAllRichEditors, 100);
        });

        Livewire.hook('commit', ({ component, commit, respond }) => {
            setTimeout(initAllRichEditors, 200);
        });
    }

    // Mutation observer for dynamic content
    const observer = new MutationObserver(function(mutations) {
        let shouldReinit = false;
        mutations.forEach(function(mutation) {
            if (mutation.addedNodes.length) {
                mutation.addedNodes.forEach(node => {
                    if (node.nodeType === 1) { // Element node
                        if (node.querySelector && (
                            node.querySelector('.tiptap.ProseMirror') ||
                            node.classList.contains('ProseMirror')
                        )) {
                            shouldReinit = true;
                        }
                    }
                });
            }
        });
        
        if (shouldReinit) {
            console.log('New editor detected via mutation observer');
            setTimeout(initAllRichEditors, 100);
        }
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    console.log('Font size control initialization complete');
})();
</script>

// Add font size control to Filament Rich Editor
document.addEventListener('DOMContentLoaded', function() {
    // Wait for Filament to load
    setTimeout(initFontSizeControls, 1000);
});

function initFontSizeControls() {
    // Find all rich editor containers
    const richEditors = document.querySelectorAll('[data-field-wrapper-type="rich-editor"]');
    
    richEditors.forEach(editorWrapper => {
        // Check if font size control already added
        if (editorWrapper.querySelector('.font-size-control')) {
            return;
        }

        // Find the editor toolbar
        const toolbar = editorWrapper.querySelector('.tiptap-toolbar, [class*="toolbar"]');
        const editor = editorWrapper.querySelector('.ProseMirror');
        
        if (!editor) return;

        // Create font size control
        const fontSizeControl = document.createElement('div');
        fontSizeControl.className = 'font-size-control inline-flex items-center gap-2 px-2 py-1 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded';
        
        fontSizeControl.innerHTML = `
            <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Size:</label>
            <select class="font-size-selector text-xs border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded px-2 py-1 focus:border-primary-500 focus:ring-primary-500">
                <option value="">Default</option>
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
        `;

        // Insert before the editor or at the top
        if (toolbar) {
            toolbar.appendChild(fontSizeControl);
        } else {
            editor.parentElement.insertBefore(fontSizeControl, editor);
        }

        // Add event listener
        const selector = fontSizeControl.querySelector('.font-size-selector');
        selector.addEventListener('change', function(e) {
            const size = e.target.value;
            
            if (size) {
                // Apply font size to selection or insert point
                document.execCommand('fontSize', false, '7'); // Use temporary size
                
                // Replace font tags with span tags with inline style
                const fontElements = editor.querySelectorAll('font[size="7"]');
                fontElements.forEach(font => {
                    const span = document.createElement('span');
                    span.style.fontSize = size + 'px';
                    span.innerHTML = font.innerHTML;
                    font.parentNode.replaceChild(span, font);
                });
            }
            
            // Trigger input event to update Livewire state
            editor.dispatchEvent(new Event('input', { bubbles: true }));
            
            // Reset selector
            e.target.value = '';
        });
    });
}

// Re-run when Livewire updates
document.addEventListener('livewire:navigated', initFontSizeControls);
if (window.Livewire) {
    window.Livewire.hook('message.processed', () => {
        setTimeout(initFontSizeControls, 100);
    });
}


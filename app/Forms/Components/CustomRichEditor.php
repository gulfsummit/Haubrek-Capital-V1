<?php

namespace App\Forms\Components;

use Filament\Forms\Components\RichEditor;

class CustomRichEditor extends RichEditor
{
    protected function setUp(): void
    {
        parent::setUp();

        // Set default toolbar buttons without H2, H3, H4
        // Font size control is handled by the JavaScript in the base layout

        // Clean up HTML-encoded content inside <pre> tags before saving
        $this->dehydrateStateUsing(function ($state) {
            if (empty($state)) {
                return $state;
            }

            // Remove <pre> tags and decode HTML entities inside them
            $state = preg_replace_callback('/<pre>(.*?)<\/pre>/s', function ($matches) {
                return html_entity_decode($matches[1]);
            }, $state);

            return $state;
        });
    }

    /**
     * Create a custom RichEditor with standard toolbar
     */
    public static function make(string $name): static
    {
        $component = parent::make($name);

        return $component;
    }

    /**
     * Set toolbar for simple editors (without codeBlock)
     */
    public function simple(): static
    {

        return $this;
    }

    /**
     * Set toolbar for full-featured editors (with codeBlock)
     */
    public function full(): static
    {

        return $this;
    }

    /**
     * Set toolbar for minimal editors (basic formatting only)
     */
    public function minimal(): static
    {

        return $this;
    }
}


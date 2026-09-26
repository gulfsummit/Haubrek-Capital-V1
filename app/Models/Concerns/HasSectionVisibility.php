<?php

namespace App\Models\Concerns;

trait HasSectionVisibility
{
    public function isSectionVisible(string $section, bool $default = true): bool
    {
        $visibility = $this->section_visibility ?? [];

        if (is_array($visibility) && array_key_exists($section, $visibility)) {
            return (bool) $visibility[$section];
        }

        $legacyField = "{$section}_section_enabled";

        if (isset($this->{$legacyField})) {
            return (bool) $this->{$legacyField};
        }

        return $default;
    }
}

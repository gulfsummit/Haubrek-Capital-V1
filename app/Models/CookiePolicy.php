<?php

namespace App\Models;

use App\Models\Concerns\HasSectionVisibility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookiePolicy extends Model
{
    use HasFactory;
    use HasSectionVisibility;

    protected $fillable = [
        'title_en',
        'title_ar',
        'hero_desktop_image',
        'hero_desktop_image_alt_en',
        'hero_desktop_image_alt_ar',
        'hero_mobile_image',
        'hero_mobile_image_alt_en',
        'hero_mobile_image_alt_ar',
        'content_en',
        'content_ar',
        'section_visibility',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'section_visibility' => 'array',
    ];
}

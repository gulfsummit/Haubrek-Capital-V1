<?php

namespace App\Models;

use App\Models\Concerns\HasSeoMeta;
use App\Models\Concerns\HasSectionVisibility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Careers extends Model
{
    use HasFactory;
    use HasSeoMeta;
    use HasSectionVisibility;

    protected $fillable = [
        // Hero Section
        'hero_title_en',
        'hero_title_ar',
        'hero_subtitle_en',
        'hero_subtitle_ar',
        'hero_button_text_en',
        'hero_button_text_ar',
        'hero_button_link',
        'hero_desktop_image',
        'hero_desktop_image_alt_en','hero_desktop_image_alt_ar',
        'hero_mobile_image',
        'hero_mobile_image_alt_en','hero_mobile_image_alt_ar',
        
        // Why Work Section
        'why_work_title_en',
        'why_work_title_ar',
        'why_work_subtitle_en',
        'why_work_subtitle_ar',
        'why_work_bg_image','why_work_bg_image_alt_en','why_work_bg_image_alt_ar',
        
        // Why Work Cards
        'why_work_cards',
        
        // How to Apply Section
        'how_to_apply_title_en',
        'how_to_apply_title_ar',
        'how_to_apply_text1_en',
        'how_to_apply_text1_ar',
        'how_to_apply_text2_en',
        'how_to_apply_text2_ar',
        'apply_email',
        
        
        // CTA Section
        'cta_title_en',
        'cta_title_ar',
        'cta_subtitle_en',
        'cta_subtitle_ar',
        'cta_button_1_text_en',
        'cta_button_1_text_ar',
        'cta_button_1_url',
        'cta_button_2_text_en',
        'cta_button_2_text_ar',
        'cta_button_2_url',
        'cta_background_image','cta_background_image_alt_en','cta_background_image_alt_ar',
        
        'section_visibility',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'why_work_cards' => 'array',
        'section_visibility' => 'array',
    ];
}


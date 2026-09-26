<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSeoMeta;
use App\Models\Concerns\HasSectionVisibility;

class GovernanceServices extends Model
{
    use HasFactory;
    use HasSeoMeta;
    use HasSectionVisibility;

    protected $fillable = [
        // Hero Section
        'hero_desktop_image',
        'hero_desktop_image_alt_en','hero_desktop_image_alt_ar',
        'hero_mobile_image',
        'hero_mobile_image_alt_en','hero_mobile_image_alt_ar',
        'hero_title_en',
        'hero_title_ar',
        'hero_subtitle_en',
        'hero_subtitle_ar',
        'hero_button_text_en',
        'hero_button_text_ar',
        'hero_button_url',
        
        // Services Overview Section
        'services_title_en',
        'services_title_ar',
        'services_description_en',
        'services_description_ar',
        'services_cards',
        
        // Approach Section
        'approach_background_image','approach_background_image_alt_en','approach_background_image_alt_ar',
        'approach_mobile_background_image','approach_mobile_background_image_alt_en','approach_mobile_background_image_alt_ar',
        'approach_title_en',
        'approach_title_ar',
        'approach_description_en',
        'approach_description_ar',
        'approach_items',
        
        // Steps Section
        'steps_title_en',
        'steps_title_ar',
        'steps_subtitle_en',
        'steps_subtitle_ar',
        'steps_items',
        
        // Why Choose Us Section
        'why_choose_title_en',
        'why_choose_title_ar',
        'why_choose_items',
        
        // CTA Section
        'cta_background_image','cta_background_image_alt_en','cta_background_image_alt_ar',
        'cta_title_en',
        'cta_title_ar',
        'cta_description_en',
        'cta_description_ar',
        'cta_button_1_text_en',
        'cta_button_1_text_ar',
        'cta_button_1_url',
        'cta_button_2_text_en',
        'cta_button_2_text_ar',
        'cta_button_2_url',
        'section_visibility',
    ];

    protected $casts = [
        'services_cards' => 'array',
        'approach_items' => 'array',
        'steps_items' => 'array',
        'why_choose_items' => 'array',
        'section_visibility' => 'array',
    ];

    /**
     * Get the first (and should be only) governance services record
     */
    public static function getContent()
    {
        return static::first() ?? new static();
    }
}

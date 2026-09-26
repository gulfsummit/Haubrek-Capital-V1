<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSeoMeta;
use App\Models\Concerns\HasSectionVisibility;

class Home extends Model
{
    use HasFactory;
    use HasSeoMeta;
    use HasSectionVisibility;

    protected $fillable = [
        // Hero Section
        'hero_slides',
        'hero_slide_1_title_en', 'hero_slide_1_title_ar',
        'hero_slide_1_subtitle_en', 'hero_slide_1_subtitle_ar',
        'hero_slide_1_image', 'hero_slide_1_button_text_en', 'hero_slide_1_button_text_ar',
        'hero_slide_1_image_alt_en', 'hero_slide_1_image_alt_ar',
        'hero_slide_1_button_link',
        
        'hero_slide_2_title_en', 'hero_slide_2_title_ar',
        'hero_slide_2_subtitle_en', 'hero_slide_2_subtitle_ar',
        'hero_slide_2_image', 'hero_slide_2_image_alt_en', 'hero_slide_2_image_alt_ar', 'hero_slide_2_button_text_en', 'hero_slide_2_button_text_ar',
        'hero_slide_2_button_link',
        
        'hero_slide_3_title_en', 'hero_slide_3_title_ar',
        'hero_slide_3_subtitle_en', 'hero_slide_3_subtitle_ar',
        'hero_slide_3_image', 'hero_slide_3_image_alt_en', 'hero_slide_3_image_alt_ar', 'hero_slide_3_button_text_en', 'hero_slide_3_button_text_ar',
        'hero_slide_3_button_link',
        
        // How We Can Assist Section
        'assist_title_en', 'assist_title_ar',
        'assist_description_en', 'assist_description_ar',
        'assist_image', 'assist_image_alt_en', 'assist_image_alt_ar',
        'assist_button_text_en', 'assist_button_text_ar',
        'assist_button_link',
        
        // Services
        'services',
        
        // Diversified Programs Section
        'diversified_title_en', 'diversified_title_ar',
        'diversified_description_en', 'diversified_description_ar',
        'diversified_desktop_image', 'diversified_desktop_image_alt_en', 'diversified_desktop_image_alt_ar', 'diversified_mobile_image', 'diversified_mobile_image_alt_en', 'diversified_mobile_image_alt_ar',
        'diversified_content_desktop_image', 'diversified_content_mobile_image',
        'diversified_content_desktop_image_alt_en', 'diversified_content_desktop_image_alt_ar',
        'diversified_content_mobile_image_alt_en', 'diversified_content_mobile_image_alt_ar',
        'diversified_button_text_en', 'diversified_button_text_ar',
        'diversified_button_link', 'diversified_services',
        
        // Board of Directors Section
        'directors_title_en', 'directors_title_ar',
        'directors_description_en', 'directors_description_ar',
        'directors_background_image', 'directors_background_image_alt_en', 'directors_background_image_alt_ar', 'directors',
        
        // Proven Track Record Section
        'track_record_title_en', 'track_record_title_ar',
        'track_record_description_en', 'track_record_description_ar',
        'track_record_background_image', 'track_record_background_image_alt_en', 'track_record_background_image_alt_ar',
        'track_record_icon', 'track_record_icon_alt_en', 'track_record_icon_alt_ar', 'track_record_metrics',
        
        // Road Map Section
        'roadmap_title_en', 'roadmap_title_ar',
        'roadmap_steps', 'roadmap_mobile_image', 'roadmap_mobile_image_alt_en', 'roadmap_mobile_image_alt_ar',
        'roadmap_button_text_en', 'roadmap_button_text_ar',
        'roadmap_button_link',
        
        // Insights Section
        'insights_title_en', 'insights_title_ar',
        'insights_sections',
        'section_visibility',
        
        // Ready To Start Growing Section
        'cta_section_enabled',
        'cta_title_en', 'cta_title_ar',
        'cta_description_en', 'cta_description_ar',
        'cta_background_image', 'cta_background_image_alt_en', 'cta_background_image_alt_ar',
        'cta_button_1_text_en', 'cta_button_1_text_ar', 'cta_button_1_link',
        'cta_button_2_text_en', 'cta_button_2_text_ar', 'cta_button_2_link',
    ];

    protected $casts = [
        'hero_slides' => 'array',
        'services' => 'array',
        'directors' => 'array',
        'track_record_metrics' => 'array',
        'roadmap_steps' => 'array',
        'insights_sections' => 'array',
        'diversified_services' => 'array',
        'section_visibility' => 'array',
        'cta_section_enabled' => 'boolean',
    ];
}

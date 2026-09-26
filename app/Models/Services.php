<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSeoMeta;
use App\Models\Concerns\HasSectionVisibility;

class Services extends Model
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
        'hero_background_image',
        'hero_background_image_alt_en', 'hero_background_image_alt_ar',
        'hero_mobile_background_image',
        'hero_mobile_background_image_alt_en', 'hero_mobile_background_image_alt_ar',
        'hero_button_text_en',
        'hero_button_text_ar',
        'hero_button_link',
        
        // Main Description Section
        'description_title_en',
        'description_title_ar',
        'description_en',
        'description_ar',
        
        // Services List Section
        'services_list',
        
        // Governance Advisory Section
        'governance_title_en',
        'governance_title_ar',
        'governance_description_en',
        'governance_description_ar',
        'governance_background', 'governance_background_alt_en', 'governance_background_alt_ar',
        'governance_mobile_background', 'governance_mobile_background_alt_en', 'governance_mobile_background_alt_ar',
        'governance_image', 'governance_image_alt_en', 'governance_image_alt_ar',
        'governance_mobile_image', 'governance_mobile_image_alt_en', 'governance_mobile_image_alt_ar',
        'governance_read_more_text_en',
        'governance_read_more_text_ar',
        'governance_link',
        
        // Wealth Planning Section
        'wealth_title_en',
        'wealth_title_ar',
        'wealth_description_en',
        'wealth_description_ar',
        'wealth_background', 'wealth_background_alt_en', 'wealth_background_alt_ar',
        'wealth_mobile_background_image', 'wealth_mobile_background_image_alt_en', 'wealth_mobile_background_image_alt_ar',
        'wealth_image', 'wealth_image_alt_en', 'wealth_image_alt_ar',
        'wealth_mobile_image', 'wealth_mobile_image_alt_en', 'wealth_mobile_image_alt_ar',
        'wealth_read_more_text_en',
        'wealth_read_more_text_ar',
        'wealth_link',
        
        // Strategic Investment Advisory Section
        'investment_title_en',
        'investment_title_ar',
        'investment_description_en',
        'investment_description_ar',
        'investment_background', 'investment_background_alt_en', 'investment_background_alt_ar',
        'investment_mobile_background', 'investment_mobile_background_alt_en', 'investment_mobile_background_alt_ar',
        'investment_image', 'investment_image_alt_en', 'investment_image_alt_ar',
        'investment_mobile_image', 'investment_mobile_image_alt_en', 'investment_mobile_image_alt_ar',
        'investment_read_more_text_en',
        'investment_read_more_text_ar',
        'investment_link',
        
        // CIO Office Services Section
        'cio_title_en',
        'cio_title_ar',
        'cio_description_en',
        'cio_description_ar',
        'cio_background', 'cio_background_alt_en', 'cio_background_alt_ar',
        'cio_mobile_background_image', 'cio_mobile_background_image_alt_en', 'cio_mobile_background_image_alt_ar',
        'cio_image', 'cio_image_alt_en', 'cio_image_alt_ar',
        'cio_mobile_image', 'cio_mobile_image_alt_en', 'cio_mobile_image_alt_ar',
        'cio_read_more_text_en',
        'cio_read_more_text_ar',
        'cio_link',
        
        // Roadmap Section
        'roadmap_title_en',
        'roadmap_title_ar',
        'roadmap_mobile_image', 'roadmap_mobile_image_alt_en', 'roadmap_mobile_image_alt_ar',
        'roadmap_steps',
        
        // CTA Section
        'cta_title_en',
        'cta_title_ar',
        'cta_subtitle_en',
        'cta_subtitle_ar',
        'cta_background_image', 'cta_background_image_alt_en', 'cta_background_image_alt_ar',
        'cta_button_1_text_en',
        'cta_button_1_text_ar',
        'cta_button_1_url',
        'cta_button_2_text_en',
        'cta_button_2_text_ar',
        'cta_button_2_url',
        'section_visibility',
    ];

    protected $casts = [
        'services_list' => 'array',
        'roadmap_steps' => 'array',
        'section_visibility' => 'array',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSeoMeta;
use App\Models\Concerns\HasSectionVisibility;

class App extends Model
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
        
        // Investment App Promo Section
        'promo_title_en',
        'promo_title_ar',
        'promo_description_en',
        'promo_description_ar',
        'promo_background_image', 'promo_background_image_alt_en', 'promo_background_image_alt_ar',
        'promo_mobile_background_image', 'promo_mobile_background_image_alt_en', 'promo_mobile_background_image_alt_ar',
        'promo_mobile_1_image', 'promo_mobile_1_image_alt_en', 'promo_mobile_1_image_alt_ar',
        'promo_mobile_2_image', 'promo_mobile_2_image_alt_en', 'promo_mobile_2_image_alt_ar',
        'promo_mobile_3_image', 'promo_mobile_3_image_alt_en', 'promo_mobile_3_image_alt_ar',
        
        // Bottom Half Section
        'bottom_title_en',
        'bottom_title_ar',
        'bottom_subtitle_en',
        'bottom_subtitle_ar',
        'bottom_background_image', 'bottom_background_image_alt_en', 'bottom_background_image_alt_ar',
        'bottom_mobile_background_image', 'bottom_mobile_background_image_alt_en', 'bottom_mobile_background_image_alt_ar',
        'bottom_mobile_image', 'bottom_mobile_image_alt_en', 'bottom_mobile_image_alt_ar',
        'bottom_bullet_points_en',
        'bottom_bullet_points_ar',
        
        // Connect Section
        'connect_subtitle_en',
        'connect_subtitle_ar',
        'connect_title_en',
        'connect_title_ar',
        'connect_bullet_points_en',
        'connect_bullet_points_ar',
        'connect_background_image', 'connect_background_image_alt_en', 'connect_background_image_alt_ar',
        'connect_mobile_background_image', 'connect_mobile_background_image_alt_en', 'connect_mobile_background_image_alt_ar',
        'connect_mobile_image', 'connect_mobile_image_alt_en', 'connect_mobile_image_alt_ar',
        
        // Documentation Section
        'docs_subtitle_en',
        'docs_subtitle_ar',
        'docs_title_en',
        'docs_title_ar',
        'docs_bullet_points_en',
        'docs_bullet_points_ar',
        'docs_background_image', 'docs_background_image_alt_en', 'docs_background_image_alt_ar',
        'docs_mobile_background_image', 'docs_mobile_background_image_alt_en', 'docs_mobile_background_image_alt_ar',
        'docs_mobile_image', 'docs_mobile_image_alt_en', 'docs_mobile_image_alt_ar',
        
        // Knowledge Section
        'knowledge_subtitle_en',
        'knowledge_subtitle_ar',
        'knowledge_title_en',
        'knowledge_title_ar',
        'knowledge_bullet_points_en',
        'knowledge_bullet_points_ar',
        'knowledge_background_image', 'knowledge_background_image_alt_en', 'knowledge_background_image_alt_ar',
        'knowledge_mobile_background_image', 'knowledge_mobile_background_image_alt_en', 'knowledge_mobile_background_image_alt_ar',
        'knowledge_mobile_image', 'knowledge_mobile_image_alt_en', 'knowledge_mobile_image_alt_ar',
        
        // Security Section
        'security_subtitle_en',
        'security_subtitle_ar',
        'security_title_en',
        'security_title_ar',
        'security_bullet_points_en',
        'security_bullet_points_ar',
        'security_background_image', 'security_background_image_alt_en', 'security_background_image_alt_ar',
        'security_mobile_background_image', 'security_mobile_background_image_alt_en', 'security_mobile_background_image_alt_ar',
        'security_mobile_image', 'security_mobile_image_alt_en', 'security_mobile_image_alt_ar',
        
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
        'bottom_bullet_points_en' => 'array',
        'bottom_bullet_points_ar' => 'array',
        'connect_bullet_points_en' => 'array',
        'connect_bullet_points_ar' => 'array',
        'docs_bullet_points_en' => 'array',
        'docs_bullet_points_ar' => 'array',
        'knowledge_bullet_points_en' => 'array',
        'knowledge_bullet_points_ar' => 'array',
        'security_bullet_points_en' => 'array',
        'security_bullet_points_ar' => 'array',
        'section_visibility' => 'array',
    ];
}

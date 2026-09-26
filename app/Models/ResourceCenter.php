<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSeoMeta;
use App\Models\Concerns\HasSectionVisibility;

class ResourceCenter extends Model
{
    use HasFactory;
    use HasSeoMeta;
    use HasSectionVisibility;

    protected $fillable = [
        'hero_title_en',
        'hero_title_ar',
        'hero_subtitle_en',
        'hero_subtitle_ar',
        'hero_button_text_en',
        'hero_button_text_ar',
        'hero_button_url_en',
        'hero_button_url_ar',
        'hero_desktop_image',
        'hero_desktop_image_alt_en','hero_desktop_image_alt_ar',
        'hero_mobile_image',
        'hero_mobile_image_alt_en','hero_mobile_image_alt_ar',
        'section_title_en',
        'section_title_ar',
        'section_subtitle_en',
        'section_subtitle_ar',
        'blog_card_title_en',
        'blog_card_title_ar',
        'blog_card_image','blog_card_image_alt_en','blog_card_image_alt_ar',
        'blog_card_link',
        'blog_card_enabled',
        'case_studies_card_title_en',
        'case_studies_card_title_ar',
        'case_studies_card_image','case_studies_card_image_alt_en','case_studies_card_image_alt_ar',
        'case_studies_card_link',
        'case_studies_card_enabled',
        'tools_card_title_en',
        'tools_card_title_ar',
        'tools_card_image','tools_card_image_alt_en','tools_card_image_alt_ar',
        'tools_card_link',
        'tools_card_enabled',
        // New content type cards
        'white_papers_card_title_en',
        'white_papers_card_title_ar',
        'white_papers_card_image','white_papers_card_image_alt_en','white_papers_card_image_alt_ar',
        'white_papers_card_link',
        'white_papers_card_enabled',
        'cio_flash_card_title_en',
        'cio_flash_card_title_ar',
        'cio_flash_card_image','cio_flash_card_image_alt_en','cio_flash_card_image_alt_ar',
        'cio_flash_card_link',
        'cio_flash_card_enabled',
        'monday_window_card_title_en',
        'monday_window_card_title_ar',
        'monday_window_card_image','monday_window_card_image_alt_en','monday_window_card_image_alt_ar',
        'monday_window_card_link',
        'monday_window_card_enabled',
        'research_card_title_en',
        'research_card_title_ar',
        'research_card_image','research_card_image_alt_en','research_card_image_alt_ar',
        'research_card_link',
        'research_card_enabled',
        'cta_title_en',
        'cta_title_ar',
        'cta_subtitle_en',
        'cta_subtitle_ar',
        'cta_button_1_text_en',
        'cta_button_1_text_ar',
        'cta_button_1_url_en',
        'cta_button_1_url_ar',
        'cta_button_2_text_en',
        'cta_button_2_text_ar',
        'cta_button_2_url_en',
        'cta_button_2_url_ar',
        'cta_background_image','cta_background_image_alt_en','cta_background_image_alt_ar',
        'section_visibility',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'blog_card_enabled' => 'boolean',
        'case_studies_card_enabled' => 'boolean',
        'tools_card_enabled' => 'boolean',
        'white_papers_card_enabled' => 'boolean',
        'cio_flash_card_enabled' => 'boolean',
        'monday_window_card_enabled' => 'boolean',
        'research_card_enabled' => 'boolean',
        'section_visibility' => 'array',
    ];
}


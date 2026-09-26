<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSeoMeta;
use App\Models\Concerns\HasSectionVisibility;

class About extends Model
{
    use HasFactory;
    use HasSeoMeta;
    use HasSectionVisibility;

     protected $fillable = [
        'questions',
        // Hero Section
        'hero_title_en', 'hero_title_ar', 'hero_subtitle_en', 'hero_subtitle_ar',
        'hero_button_text_en', 'hero_button_text_ar', 'hero_button_link',
        'hero_desktop_image', 'hero_desktop_image_alt_en','hero_desktop_image_alt_ar',
        'hero_mobile_image', 'hero_mobile_image_alt_en','hero_mobile_image_alt_ar',
        // Who We Are Section
        'who_we_are_title_en', 'who_we_are_title_ar',
        'who_we_are_description_1_en', 'who_we_are_description_1_ar',
        'who_we_are_description_2_en', 'who_we_are_description_2_ar',
        'who_we_are_description_3_en', 'who_we_are_description_3_ar',
        'who_we_are_desktop_bg', 'who_we_are_desktop_bg_alt_en', 'who_we_are_desktop_bg_alt_ar',
        'who_we_are_mobile_bg', 'who_we_are_mobile_bg_alt_en', 'who_we_are_mobile_bg_alt_ar',
        // Concept Section
        'concept_title_en', 'concept_title_ar', 'concept_intro_en', 'concept_intro_ar',
        'yield_title_en', 'yield_title_ar', 'yield_description_en', 'yield_description_ar',
        'defence_title_en', 'defence_title_ar', 'defence_description_en', 'defence_description_ar',
        'appreciation_title_en', 'appreciation_title_ar', 'appreciation_description_en', 'appreciation_description_ar',
        'liquidity_title_en', 'liquidity_title_ar', 'liquidity_description_en', 'liquidity_description_ar',
        'concept_diagram_image', 'concept_diagram_image_alt_en', 'concept_diagram_image_alt_ar', 'concept_diagram_image_ar',
        'concept_diagram_image_ar_alt_en', 'concept_diagram_image_ar_alt_ar',
        'concept_diagram_mobile_image', 'concept_diagram_mobile_image_alt_en', 'concept_diagram_mobile_image_alt_ar',
        'concept_diagram_mobile_image_ar', 'concept_diagram_mobile_image_ar_alt_en', 'concept_diagram_mobile_image_ar_alt_ar',
        'concept_bg_image', 'concept_bg_image_alt_en', 'concept_bg_image_alt_ar',
        'concept_bg_mobile_image', 'concept_bg_mobile_image_alt_en', 'concept_bg_mobile_image_alt_ar',
        // Mission & Vision
        'mission_title_en', 'mission_title_ar', 'mission_text_en', 'mission_text_ar',
        'vision_title_en', 'vision_title_ar', 'vision_text_en', 'vision_text_ar',
        'mission_icon', 'vision_icon',
        // Values & Approach
        'values_title_en', 'values_title_ar', 'values',
        'approach_title_en', 'approach_title_ar',
        'approach_description_1_en', 'approach_description_1_ar',
        'approach_description_2_en', 'approach_description_2_ar',
        'approach_items', 'approach_bg_image', 'approach_bg_image_alt_en', 'approach_bg_image_alt_ar', 'approach_mobile_bg_image', 'approach_mobile_bg_image_alt_en', 'approach_mobile_bg_image_alt_ar',
        'section_visibility',
    ];



    protected $casts = [
        'questions' => 'array',
        'values' => 'array',
        'approach_items' => 'array',
        'section_visibility' => 'array',
    ];
}

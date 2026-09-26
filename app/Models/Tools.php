<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSeoMeta;
use App\Models\Concerns\HasSectionVisibility;

class Tools extends Model
{
    use HasFactory;
    use HasSeoMeta;
    use HasSectionVisibility;

    protected $fillable = [
        // Hero Section
        'hero_title_en',
        'hero_title_ar',
        'hero_desktop_image',
        'hero_desktop_image_alt_en','hero_desktop_image_alt_ar',
        'hero_mobile_image',
        'hero_mobile_image_alt_en','hero_mobile_image_alt_ar',
        
        // Investment Profile Section
        'profile_title_en',
        'profile_title_ar',
        'profile_description_en',
        'profile_description_ar',
        'profile_image','profile_image_alt_en','profile_image_alt_ar',
        
        // Key Features Section
        'features_title_en',
        'features_title_ar',
        'features_list_en',
        'features_list_ar',
        'features_background_image','features_background_image_alt_en','features_background_image_alt_ar',
        
        // How It Works Section
        'how_it_works_title_en',
        'how_it_works_title_ar',
        'how_it_works_steps_en',
        'how_it_works_steps_ar',
        
        // Form Section
        'form_title_en',
        'form_title_ar',
        'form_background_image','form_background_image_alt_en','form_background_image_alt_ar',
        'form_button_text_en',
        'form_button_text_ar',
        'section_visibility',
    ];

    protected $casts = [
        'features_list_en' => 'array',
        'features_list_ar' => 'array',
        'how_it_works_steps_en' => 'array',
        'how_it_works_steps_ar' => 'array',
        'section_visibility' => 'array',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSeoMeta;
use App\Models\Concerns\HasSectionVisibility;

class ContactUs extends Model
{
    use HasFactory;
    use HasSeoMeta;
    use HasSectionVisibility;

    protected $table = 'contact_us';

    protected $fillable = [
        // Hero Section
        'hero_title_en',
        'hero_title_ar',
        'hero_subtitle_en',
        'hero_subtitle_ar',
        'hero_desktop_image','hero_desktop_image_alt_en','hero_desktop_image_alt_ar',
        'hero_mobile_image','hero_mobile_image_alt_en','hero_mobile_image_alt_ar',
        
        // Form Section
        'form_title_en',
        'form_title_ar',
        'form_button_text_en',
        'form_button_text_ar',
        
        // Form Fields (English)
        'name_label_en',
        'name_placeholder_en',
        'email_label_en',
        'email_placeholder_en',
        'phone_label_en',
        'phone_placeholder_en',
        'message_label_en',
        'message_placeholder_en',
        
        // Form Fields (Arabic)
        'name_label_ar',
        'name_placeholder_ar',
        'email_label_ar',
        'email_placeholder_ar',
        'phone_label_ar',
        'phone_placeholder_ar',
        'message_label_ar',
        'message_placeholder_ar',
        
        // Contact Info Titles
        'phone_title_en',
        'phone_title_ar',
        'phone_subtitle_en',
        'phone_subtitle_ar',
        'phone_number',
        
        'email_title_en',
        'email_title_ar',
        'email_subtitle_en',
        'email_subtitle_ar',
        'email_address',
        
        'address_title_en',
        'address_title_ar',
        'address_text_en',
        'address_text_ar',
        
        // Map
        'map_iframe_url',
        
        // Social Media
        'social_section_title_en',
        'social_section_title_ar',
        'social_items',
        
        'section_visibility',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'social_items' => 'array',
        'section_visibility' => 'array',
    ];
}


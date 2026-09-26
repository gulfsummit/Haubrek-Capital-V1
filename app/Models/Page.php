<?php

namespace App\Models;

use App\Models\Concerns\HasSeoMeta;
use App\Models\Concerns\HasSectionVisibility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    use HasSeoMeta;
    use HasSectionVisibility;

    protected $fillable = [
        'slug',
        'hero_desktop_image',
        'hero_mobile_image',
        'hero_desktop_image_alt_en',
        'hero_desktop_image_alt_ar',
        'hero_mobile_image_alt_en',
        'hero_mobile_image_alt_ar',
        'title_en',
        'title_ar',
        'subtitle_en',
        'subtitle_ar',
        'content_en',
        'content_ar',
        'body_background_image',
        'body_background_image_alt_en',
        'body_background_image_alt_ar',
        'primary_button_text_en',
        'primary_button_text_ar',
        'primary_button_url',
        'secondary_button_text_en',
        'secondary_button_text_ar',
        'secondary_button_url',
        'intro_title_en',
        'intro_title_ar',
        'intro_subtitle_en',
        'intro_subtitle_ar',
        'search_results_label_en',
        'search_results_label_ar',
        'clear_search_label_en',
        'clear_search_label_ar',
        'all_items_label_en',
        'all_items_label_ar',
        'learn_more_label_en',
        'learn_more_label_ar',
        'empty_state_title_en',
        'empty_state_title_ar',
        'empty_state_description_en',
        'empty_state_description_ar',
        'latest_section_title_en',
        'latest_section_title_ar',
        'home_breadcrumb_label_en',
        'home_breadcrumb_label_ar',
        'listing_breadcrumb_label_en',
        'listing_breadcrumb_label_ar',
        'share_label_en',
        'share_label_ar',
        'back_button_text_en',
        'back_button_text_ar',
        'search_title_en',
        'search_title_ar',
        'search_placeholder_en',
        'search_placeholder_ar',
        'search_button_text_en',
        'search_button_text_ar',
        'services_title_en',
        'services_title_ar',
        'service_links',
        'subscribe_title_en',
        'subscribe_title_ar',
        'subscribe_button_text_en',
        'subscribe_button_text_ar',
        'categories_title_en',
        'categories_title_ar',
        'all_categories_label_en',
        'all_categories_label_ar',
        'faq_items',
        'form_fields',
        'form_title_en',
        'form_title_ar',
        'form_button_text_en',
        'form_button_text_ar',
        'form_warning_text_en',
        'form_warning_text_ar',
        'cta_background_image',
        'cta_background_image_alt_en',
        'cta_background_image_alt_ar',
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
        'meta_description_en',
        'meta_description_ar',
        'section_visibility',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'service_links' => 'array',
        'faq_items' => 'array',
        'form_fields' => 'array',
        'section_visibility' => 'array',
    ];

    public static function forSlug(string $slug): ?self
    {
        return static::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : $this->title_en;
    }

    public function getContentAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->content_ar : $this->content_en;
    }

    public function getMetaDescriptionAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->meta_description_ar : $this->meta_description_en;
    }
}

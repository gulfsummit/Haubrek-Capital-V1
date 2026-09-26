<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->text('hero_desktop_image_alt_en')->nullable()->after('hero_mobile_image');
            $table->text('hero_desktop_image_alt_ar')->nullable()->after('hero_desktop_image_alt_en');
            $table->text('hero_mobile_image_alt_en')->nullable()->after('hero_desktop_image_alt_ar');
            $table->text('hero_mobile_image_alt_ar')->nullable()->after('hero_mobile_image_alt_en');

            $table->text('subtitle_en')->nullable()->after('title_ar');
            $table->text('subtitle_ar')->nullable()->after('subtitle_en');
            $table->text('body_background_image')->nullable()->after('content_ar');
            $table->text('body_background_image_alt_en')->nullable()->after('body_background_image');
            $table->text('body_background_image_alt_ar')->nullable()->after('body_background_image_alt_en');

            $table->text('primary_button_text_en')->nullable()->after('body_background_image_alt_ar');
            $table->text('primary_button_text_ar')->nullable()->after('primary_button_text_en');
            $table->text('primary_button_url')->nullable()->after('primary_button_text_ar');
            $table->text('secondary_button_text_en')->nullable()->after('primary_button_url');
            $table->text('secondary_button_text_ar')->nullable()->after('secondary_button_text_en');
            $table->text('secondary_button_url')->nullable()->after('secondary_button_text_ar');

            $table->text('intro_title_en')->nullable()->after('secondary_button_url');
            $table->text('intro_title_ar')->nullable()->after('intro_title_en');
            $table->text('intro_subtitle_en')->nullable()->after('intro_title_ar');
            $table->text('intro_subtitle_ar')->nullable()->after('intro_subtitle_en');

            $table->text('search_results_label_en')->nullable()->after('intro_subtitle_ar');
            $table->text('search_results_label_ar')->nullable()->after('search_results_label_en');
            $table->text('clear_search_label_en')->nullable()->after('search_results_label_ar');
            $table->text('clear_search_label_ar')->nullable()->after('clear_search_label_en');
            $table->text('all_items_label_en')->nullable()->after('clear_search_label_ar');
            $table->text('all_items_label_ar')->nullable()->after('all_items_label_en');
            $table->text('learn_more_label_en')->nullable()->after('all_items_label_ar');
            $table->text('learn_more_label_ar')->nullable()->after('learn_more_label_en');
            $table->text('empty_state_title_en')->nullable()->after('learn_more_label_ar');
            $table->text('empty_state_title_ar')->nullable()->after('empty_state_title_en');
            $table->text('empty_state_description_en')->nullable()->after('empty_state_title_ar');
            $table->text('empty_state_description_ar')->nullable()->after('empty_state_description_en');
            $table->text('latest_section_title_en')->nullable()->after('empty_state_description_ar');
            $table->text('latest_section_title_ar')->nullable()->after('latest_section_title_en');

            $table->text('home_breadcrumb_label_en')->nullable()->after('latest_section_title_ar');
            $table->text('home_breadcrumb_label_ar')->nullable()->after('home_breadcrumb_label_en');
            $table->text('listing_breadcrumb_label_en')->nullable()->after('home_breadcrumb_label_ar');
            $table->text('listing_breadcrumb_label_ar')->nullable()->after('listing_breadcrumb_label_en');
            $table->text('share_label_en')->nullable()->after('listing_breadcrumb_label_ar');
            $table->text('share_label_ar')->nullable()->after('share_label_en');
            $table->text('back_button_text_en')->nullable()->after('share_label_ar');
            $table->text('back_button_text_ar')->nullable()->after('back_button_text_en');

            $table->text('search_title_en')->nullable()->after('back_button_text_ar');
            $table->text('search_title_ar')->nullable()->after('search_title_en');
            $table->text('search_placeholder_en')->nullable()->after('search_title_ar');
            $table->text('search_placeholder_ar')->nullable()->after('search_placeholder_en');
            $table->text('search_button_text_en')->nullable()->after('search_placeholder_ar');
            $table->text('search_button_text_ar')->nullable()->after('search_button_text_en');

            $table->text('services_title_en')->nullable()->after('search_button_text_ar');
            $table->text('services_title_ar')->nullable()->after('services_title_en');
            $table->json('service_links')->nullable()->after('services_title_ar');
            $table->text('subscribe_title_en')->nullable()->after('service_links');
            $table->text('subscribe_title_ar')->nullable()->after('subscribe_title_en');
            $table->text('subscribe_button_text_en')->nullable()->after('subscribe_title_ar');
            $table->text('subscribe_button_text_ar')->nullable()->after('subscribe_button_text_en');
            $table->text('categories_title_en')->nullable()->after('subscribe_button_text_ar');
            $table->text('categories_title_ar')->nullable()->after('categories_title_en');
            $table->text('all_categories_label_en')->nullable()->after('categories_title_ar');
            $table->text('all_categories_label_ar')->nullable()->after('all_categories_label_en');

            $table->json('faq_items')->nullable()->after('all_categories_label_ar');
            $table->json('form_fields')->nullable()->after('faq_items');
            $table->text('form_title_en')->nullable()->after('form_fields');
            $table->text('form_title_ar')->nullable()->after('form_title_en');
            $table->text('form_button_text_en')->nullable()->after('form_title_ar');
            $table->text('form_button_text_ar')->nullable()->after('form_button_text_en');
            $table->text('form_warning_text_en')->nullable()->after('form_button_text_ar');
            $table->text('form_warning_text_ar')->nullable()->after('form_warning_text_en');

            $table->text('cta_background_image')->nullable()->after('form_warning_text_ar');
            $table->text('cta_background_image_alt_en')->nullable()->after('cta_background_image');
            $table->text('cta_background_image_alt_ar')->nullable()->after('cta_background_image_alt_en');
            $table->text('cta_title_en')->nullable()->after('cta_background_image_alt_ar');
            $table->text('cta_title_ar')->nullable()->after('cta_title_en');
            $table->text('cta_description_en')->nullable()->after('cta_title_ar');
            $table->text('cta_description_ar')->nullable()->after('cta_description_en');
            $table->text('cta_button_1_text_en')->nullable()->after('cta_description_ar');
            $table->text('cta_button_1_text_ar')->nullable()->after('cta_button_1_text_en');
            $table->text('cta_button_1_url')->nullable()->after('cta_button_1_text_ar');
            $table->text('cta_button_2_text_en')->nullable()->after('cta_button_1_url');
            $table->text('cta_button_2_text_ar')->nullable()->after('cta_button_2_text_en');
            $table->text('cta_button_2_url')->nullable()->after('cta_button_2_text_ar');
        });

        $defaults = [
            ['slug' => 'faq', 'title_en' => 'Q&A', 'title_ar' => 'الأسئلة الشائعة'],
            ['slug' => 'request-meeting', 'title_en' => 'REQUEST A MEETING', 'title_ar' => 'اطلب اجتماعاً'],
            ['slug' => 'blog-list', 'title_en' => 'BLOG', 'title_ar' => 'المدونة'],
            ['slug' => 'blog-detail', 'title_en' => 'BLOG DETAILS', 'title_ar' => 'تفاصيل المدونة'],
            ['slug' => 'case-studies-list', 'title_en' => 'CASE STUDIES', 'title_ar' => 'دراسات الحالة'],
            ['slug' => 'case-studies-detail', 'title_en' => 'CASE STUDY DETAILS', 'title_ar' => 'تفاصيل دراسة الحالة'],
            ['slug' => 'articles-list', 'title_en' => 'ARTICLES', 'title_ar' => 'المقالات'],
            ['slug' => 'articles-detail', 'title_en' => 'ARTICLE DETAILS', 'title_ar' => 'تفاصيل المقال'],
            ['slug' => 'books-list', 'title_en' => 'BOOKS', 'title_ar' => 'الكتب'],
            ['slug' => 'books-detail', 'title_en' => 'BOOK DETAILS', 'title_ar' => 'تفاصيل الكتاب'],
            ['slug' => 'glossaries-list', 'title_en' => 'GLOSSARIES', 'title_ar' => 'المصطلحات'],
            ['slug' => 'glossaries-detail', 'title_en' => 'GLOSSARY DETAILS', 'title_ar' => 'تفاصيل المصطلح'],
        ];

        foreach ($defaults as $default) {
            $existing = DB::table('pages')->where('slug', $default['slug'])->exists();

            if ($existing) {
                DB::table('pages')
                    ->where('slug', $default['slug'])
                    ->update([
                        'title_en' => $default['title_en'],
                        'title_ar' => $default['title_ar'],
                        'is_active' => true,
                        'updated_at' => now(),
                    ]);
            } else {
                DB::table('pages')->insert([
                    'slug' => $default['slug'],
                    'title_en' => $default['title_en'],
                    'title_ar' => $default['title_ar'],
                    'content_en' => '',
                    'content_ar' => '',
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'hero_desktop_image_alt_en',
                'hero_desktop_image_alt_ar',
                'hero_mobile_image_alt_en',
                'hero_mobile_image_alt_ar',
                'subtitle_en',
                'subtitle_ar',
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
            ]);
        });
    }
};

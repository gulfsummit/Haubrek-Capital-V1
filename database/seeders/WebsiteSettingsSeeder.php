<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WebsiteSettings;

class WebsiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsiteSettings::create([
            'header_logo' => null,
            'header_background_type' => 'transparent',
            'header_background_color' => null,
            'header_background_gradient_start' => null,
            'header_background_gradient_end' => null,
            'header_backdrop_blur' => true,
            'navigation_links' => [
                [
                    'title_en' => 'Home',
                    'title_ar' => 'الرئيسية',
                    'route' => 'home',
                    'has_dropdown' => false,
                    'dropdown_items' => []
                ],
                [
                    'title_en' => 'About us',
                    'title_ar' => 'من نحن',
                    'route' => 'about-us',
                    'has_dropdown' => true,
                    'dropdown_items' => [
                        [
                            'title_en' => 'Board of Directors',
                            'title_ar' => 'مجلس الإدارة',
                            'route' => 'teams'
                        ],
                        [
                            'title_en' => 'App',
                            'title_ar' => 'التطبيق',
                            'route' => 'app'
                        ]
                    ]
                ],
                [
                    'title_en' => 'Services',
                    'title_ar' => 'الخدمات',
                    'route' => 'services',
                    'has_dropdown' => true,
                    'dropdown_items' => []
                ],
                [
                    'title_en' => 'Resources Center',
                    'title_ar' => 'مركز الموارد',
                    'route' => 'resource-center',
                    'has_dropdown' => true,
                    'dropdown_items' => [
                        [
                            'title_en' => 'Articles',
                            'title_ar' => 'المقالات',
                            'route' => 'articles'
                        ],
                        [
                            'title_en' => 'E-Books',
                            'title_ar' => 'الكتب الإلكترونية',
                            'route' => 'books'
                        ],
                        [
                            'title_en' => 'Glossary',
                            'title_ar' => 'المعجم',
                            'route' => 'glossaries'
                        ],
                        [
                            'title_en' => 'Tools',
                            'title_ar' => 'الأدوات',
                            'route' => 'tools'
                        ],
                        [
                            'title_en' => 'FAQ\'s',
                            'title_ar' => 'الأسئلة الشائعة',
                            'route' => 'faq'
                        ]
                    ]
                ],
                [
                    'title_en' => 'Contact Us',
                    'title_ar' => 'اتصل بنا',
                    'route' => 'contact-us',
                    'has_dropdown' => false,
                    'dropdown_items' => []
                ]
            ],
            'header_cta_text' => 'CLIENT\'S HUB',
            'header_cta_url' => 'https://hauberkcapital.moxo.com/web/910',
            'header_cta_background_color' => '#D4AF37',
            'header_cta_text_color' => '#FFFFFF',
            'default_language' => 'en',
            'show_language_switcher' => true,
            'show_mobile_menu' => true,
            'mobile_menu_background_color' => '#1a1f2e',
        ]);
    }
}

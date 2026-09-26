<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSeoMeta;

class WebsiteSettings extends Model
{
    use HasFactory;
    use HasSeoMeta;

    protected $fillable = [
        'header_logo',
        'header_background_type',
        'header_background_color',
        'header_background_gradient_start',
        'header_background_gradient_end',
        'header_backdrop_blur',
        'navigation_links',
        'header_cta_text',
        'header_cta_text_ar',
        'header_cta_url',
        'header_cta_background_color',
        'header_cta_text_color',
        'default_language',
        'show_language_switcher',
        'show_mobile_menu',
        'mobile_menu_background_color',
        'page_backgrounds',
        'footer_settings',
        // Contact Page Settings
        'contact_social_section_title_en',
        'contact_social_section_title_ar',
        'contact_social_items',
        // General Settings
        'website_title_en',
        'website_title_ar',
        'favicon',
        'gtm_id',
        'google_analytics_id',
        'search_console_verification',
        'facebook_pixel_id',
        'twitter_pixel_id',
        'linkedin_pixel_id',
        'tiktok_pixel_id',
        'additional_head_scripts',
        'additional_body_scripts',
    ];

    protected $casts = [
        'navigation_links' => 'array',
        'page_backgrounds' => 'array',
        'footer_settings' => 'array',
        'contact_social_items' => 'array',
        'header_backdrop_blur' => 'boolean',
        'show_language_switcher' => 'boolean',
        'show_mobile_menu' => 'boolean',
    ];

    // Get the first (and only) website settings record
    public static function getSettings()
    {
        return static::first() ?? static::create([
            // General Settings
            'website_title_en' => 'Hauberk Capital',
            'website_title_ar' => 'هاوبيرك كابيتال',
            'favicon' => null,
            // Header Settings
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
            'header_cta_text_ar' => 'مركز العملاء',
            'header_cta_url' => 'https://hauberkcapital.moxo.com/web/910',
            'header_cta_background_color' => '#D4AF37',
            'header_cta_text_color' => '#FFFFFF',
            'default_language' => 'en',
            'show_language_switcher' => true,
            'show_mobile_menu' => true,
            'mobile_menu_background_color' => '#1a1f2e',
            'page_backgrounds' => [
                'homepage' => [
                    'type' => 'default',
                    'color' => null,
                    'gradient_start' => null,
                    'gradient_end' => null,
                    'image' => null,
                    'header_background_type' => 'inherit',
                    'header_background_color' => null,
                    'header_gradient_start' => null,
                    'header_gradient_end' => null,
                ],
                'about_us' => [
                    'type' => 'default',
                    'color' => null,
                    'gradient_start' => null,
                    'gradient_end' => null,
                    'image' => null,
                    'header_background_type' => 'inherit',
                    'header_background_color' => null,
                    'header_gradient_start' => null,
                    'header_gradient_end' => null,
                ],
                'services' => [
                    'type' => 'default',
                    'color' => null,
                    'gradient_start' => null,
                    'gradient_end' => null,
                    'image' => null,
                    'header_background_type' => 'inherit',
                    'header_background_color' => null,
                    'header_gradient_start' => null,
                    'header_gradient_end' => null,
                ],
                'app' => [
                    'type' => 'default',
                    'color' => null,
                    'gradient_start' => null,
                    'gradient_end' => null,
                    'image' => null,
                    'header_background_type' => 'inherit',
                    'header_background_color' => null,
                    'header_gradient_start' => null,
                    'header_gradient_end' => null,
                ],
                'teams' => [
                    'type' => 'default',
                    'color' => null,
                    'gradient_start' => null,
                    'gradient_end' => null,
                    'image' => null,
                    'header_background_type' => 'inherit',
                    'header_background_color' => null,
                    'header_gradient_start' => null,
                    'header_gradient_end' => null,
                ],
                'articles' => [
                    'type' => 'default',
                    'color' => null,
                    'gradient_start' => null,
                    'gradient_end' => null,
                    'image' => null,
                    'header_background_type' => 'inherit',
                    'header_background_color' => null,
                    'header_gradient_start' => null,
                    'header_gradient_end' => null,
                ],
                'books' => [
                    'type' => 'default',
                    'color' => null,
                    'gradient_start' => null,
                    'gradient_end' => null,
                    'image' => null,
                    'header_background_type' => 'inherit',
                    'header_background_color' => null,
                    'header_gradient_start' => null,
                    'header_gradient_end' => null,
                ],
                'glossaries' => [
                    'type' => 'default',
                    'color' => null,
                    'gradient_start' => null,
                    'gradient_end' => null,
                    'image' => null,
                    'header_background_type' => 'inherit',
                    'header_background_color' => null,
                    'header_gradient_start' => null,
                    'header_gradient_end' => null,
                ],
                'tools' => [
                    'type' => 'default',
                    'color' => null,
                    'gradient_start' => null,
                    'gradient_end' => null,
                    'image' => null,
                    'header_background_type' => 'inherit',
                    'header_background_color' => null,
                    'header_gradient_start' => null,
                    'header_gradient_end' => null,
                ],
                'faq' => [
                    'type' => 'default',
                    'color' => null,
                    'gradient_start' => null,
                    'gradient_end' => null,
                    'image' => null,
                    'header_background_type' => 'inherit',
                    'header_background_color' => null,
                    'header_gradient_start' => null,
                    'header_gradient_end' => null,
                ],
                'contact_us' => [
                    'type' => 'default',
                    'color' => null,
                    'gradient_start' => null,
                    'gradient_end' => null,
                    'image' => null,
                    'header_background_type' => 'inherit',
                    'header_background_color' => null,
                    'header_gradient_start' => null,
                    'header_gradient_end' => null,
                ],
                'resource_center' => [
                    'type' => 'default',
                    'color' => null,
                    'gradient_start' => null,
                    'gradient_end' => null,
                    'image' => null,
                    'header_background_type' => 'inherit',
                    'header_background_color' => null,
                    'header_gradient_start' => null,
                    'header_gradient_end' => null,
                ],
            ],
            'footer_settings' => [
                // Design Settings
                'background_color' => '#041B44',
                'text_color' => '#FFFFFF',
                'accent_color' => '#D4AF37',
                'logo_image' => null,
                'show_logo_mobile' => true,
                
                // Home Section Links
                'home_section_title_en' => 'Home',
                'home_section_title_ar' => 'الرئيسية',
                'about_us_text_en' => 'About Us',
                'about_us_text_ar' => 'من نحن',
                'about_us_url' => 'about-us',
                'resource_center_text_en' => 'Resource Center',
                'resource_center_text_ar' => 'مركز الموارد',
                'resource_center_url' => 'resource-center',
                'faq_text_en' => 'FAQ\'s',
                'faq_text_ar' => 'الأسئلة الشائعة',
                'faq_url' => 'faq',
                'board_directors_text_en' => 'Board of Directors',
                'board_directors_text_ar' => 'مجلس الإدارة',
                'board_directors_url' => 'teams',
                'careers_text_en' => 'Careers',
                'careers_text_ar' => 'الوظائف',
                'careers_url' => '#',
                
                // Services Section
                'services_section_title_en' => 'Services & Programs',
                'services_section_title_ar' => 'الخدمات والبرامج',
                            'service_1_text_en' => 'Governance Services',
            'service_1_text_ar' => 'خدمات الحوكمة',
            'service_1_url' => 'governance-services',
            'service_2_text_en' => 'Investment Advisory',
            'service_2_text_ar' => 'الاستشارات الاستثمارية',
            'service_2_url' => 'services',
            'service_3_text_en' => 'Wealth Management',
            'service_3_text_ar' => 'إدارة الثروات',
            'service_3_url' => 'services',
            'service_4_text_en' => 'Financial Planning',
            'service_4_text_ar' => 'التخطيط المالي',
            'service_4_url' => 'services',
                
                // Contact Section
                'contact_section_title_en' => 'Contact Us',
                'contact_section_title_ar' => 'اتصل بنا',
                'phone' => '+971 4 5182591 / 2',
                'email' => 'info@hauberkcapital.com',
                'address' => 'Al Sila Tower, ADGM Square, Al Maryah Island, Abu Dhabi, United Arab Emirates',
                
                // Social Media Section
                'social_section_title_en' => 'Follow Us',
                'social_section_title_ar' => 'تابعنا',
                'facebook' => '#',
                'facebook_icon' => null,
                'instagram' => '#',
                'instagram_icon' => null,
                'linkedin' => '#',
                'linkedin_icon' => null,
                'twitter' => '#',
                'twitter_icon' => null,
                'youtube' => '#',
                'youtube_icon' => null,
                
                // App Download
                'show_app_download' => true,
                'app_download_text_en' => 'Download App',
                'app_download_text_ar' => 'تحميل التطبيق',
                'ios_app_link' => '#',
                'ios_app_icon' => null,
                'android_app_link' => '#',
                'android_app_icon' => null,
                
                // Newsletter
                'show_newsletter' => true,
                'newsletter_placeholder_en' => 'Subscribe to Our Newsletter',
                'newsletter_placeholder_ar' => 'اشترك في نشرتنا الإخبارية',
                'newsletter_button_text_en' => 'Subscribe',
                'newsletter_button_text_ar' => 'اشترك',
                
                // Copyright & Legal
                'company_name' => 'Hauberk Capital',
                'regulation_text' => '',
                'regulation_text_ar' => '',
                'show_current_year' => true,
                'privacy_policy_text_en' => 'Privacy Policy',
                'privacy_policy_text_ar' => 'سياسة الخصوصية',
                'privacy_policy_url' => 'privacy-policy.html',
                'terms_conditions_text_en' => 'Terms & Conditions',
                'terms_conditions_text_ar' => 'الشروط والأحكام',
                'terms_conditions_url' => 'terms-conditions.html',
                'cookie_policy_text_en' => 'Cookie Policy',
                'cookie_policy_text_ar' => 'سياسة ملفات تعريف الارتباط',
                'cookie_policy_url' => 'cookie-policy.html',
            ],
        ]);
    }

    // Get background settings for a specific page
    public function getPageBackground($pageName)
    {
        if (!$this->page_backgrounds || !isset($this->page_backgrounds[$pageName])) {
            return [
                'type' => 'default',
                'color' => null,
                'gradient_start' => null,
                'gradient_end' => null,
                'image' => null,
                'header_background_type' => 'inherit',
                'header_background_color' => null,
                'header_gradient_start' => null,
                'header_gradient_end' => null,
            ];
        }

        return $this->page_backgrounds[$pageName];
    }

    // Get CSS classes for page background
    public function getPageBackgroundClasses($pageName)
    {
        $background = $this->getPageBackground($pageName);
        
        switch ($background['type']) {
            case 'transparent':
                return 'bg-transparent';
            case 'solid':
                return $background['color'] ? "bg-[{$background['color']}]" : 'bg-transparent';
            case 'gradient':
                if ($background['gradient_start'] && $background['gradient_end']) {
                    return "bg-gradient-to-r from-[{$background['gradient_start']}] to-[{$background['gradient_end']}]";
                }
                return 'bg-transparent';
            case 'image':
                return $background['image'] ? 'bg-cover bg-center bg-no-repeat' : 'bg-transparent';
            default:
                return 'bg-transparent';
        }
    }

    // Get inline styles for page background
    public function getPageBackgroundStyles($pageName)
    {
        $background = $this->getPageBackground($pageName);
        
        if ($background['type'] === 'image' && $background['image']) {
            return "background-image: url('" . asset('storage/' . $background['image']) . "');";
        }
        
        return '';
    }

    // Get header background for a specific page
    public function getPageHeaderBackground($pageName)
    {
        if (!$this->page_backgrounds || !isset($this->page_backgrounds[$pageName])) {
            return [
                'type' => 'inherit',
                'color' => null,
                'gradient_start' => null,
                'gradient_end' => null,
            ];
        }

        $pageSettings = $this->page_backgrounds[$pageName];
        
        return [
            'type' => $pageSettings['header_background_type'] ?? 'inherit',
            'color' => $pageSettings['header_background_color'] ?? null,
            'gradient_start' => $pageSettings['header_gradient_start'] ?? null,
            'gradient_end' => $pageSettings['header_gradient_end'] ?? null,
        ];
    }

    // Get header background classes for a specific page
    public function getPageHeaderBackgroundClasses($pageName)
    {
        $headerBackground = $this->getPageHeaderBackground($pageName);
        
        if ($headerBackground['type'] === 'inherit') {
            // Use global header background settings
            if ($this->header_background_type === 'solid' && $this->header_background_color) {
                return "bg-[{$this->header_background_color}]";
            } elseif ($this->header_background_type === 'gradient' && $this->header_background_gradient_start && $this->header_background_gradient_end) {
                return "bg-gradient-to-r from-[{$this->header_background_gradient_start}] to-[{$this->header_background_gradient_end}]";
            } else {
                return 'bg-black/20'; // Default
            }
        } elseif ($headerBackground['type'] === 'solid' && $headerBackground['color']) {
            return "bg-[{$headerBackground['color']}]";
        } elseif ($headerBackground['type'] === 'gradient' && $headerBackground['gradient_start'] && $headerBackground['gradient_end']) {
            return "bg-gradient-to-r from-[{$headerBackground['gradient_start']}] to-[{$headerBackground['gradient_end']}]";
        } elseif ($headerBackground['type'] === 'transparent') {
            return 'bg-transparent';
        }
        
        return 'bg-black/20'; // Default fallback
    }
}

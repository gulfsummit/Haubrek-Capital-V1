<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Home;

class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Home::create([
            // Hero Section
            'hero_slide_1_title_en' => 'YOUR WEALTH JOURNEY PARTNERS',
            'hero_slide_1_title_ar' => '',
            'hero_slide_1_subtitle_en' => 'Invest smartly, grow steadily, and live confidently. Learn more about how we can help you achieve financial success.',
            'hero_slide_1_subtitle_ar' => '',
            'hero_slide_1_image' => 'images/hero1.png',
            'hero_slide_1_button_text_en' => 'LEARN MORE',
            'hero_slide_1_button_text_ar' => '',
            'hero_slide_1_button_link' => 'about-us.html#who-we-are-section',
            
            'hero_slide_2_title_en' => 'TAILORED PROGRAM FOR GROWING YOUR WEALTH',
            'hero_slide_2_title_ar' => '',
            'hero_slide_2_subtitle_en' => 'Invest smartly, grow steadily, and live confidently. Learn more about how we can help you succeed.',
            'hero_slide_2_subtitle_ar' => '',
            'hero_slide_2_image' => 'images/hero2.png',
            'hero_slide_2_button_text_en' => 'LEARN MORE',
            'hero_slide_2_button_text_ar' => '',
            'hero_slide_2_button_link' => 'resource-center.html',
            
            'hero_slide_3_title_en' => 'SECURE AND EXPAND YOUR WEALTH',
            'hero_slide_3_title_ar' => '',
            'hero_slide_3_subtitle_en' => 'Invest smartly, grow steadily, and live confidently. Learn more about how we can help you achieve financial success.',
            'hero_slide_3_subtitle_ar' => '',
            'hero_slide_3_image' => 'images/hero3.png',
            'hero_slide_3_button_text_en' => 'LEARN MORE',
            'hero_slide_3_button_text_ar' => '',
            'hero_slide_3_button_link' => '/services/show/1',
            
            // How We Can Assist Section
            'assist_title_en' => 'HOW WE CAN ASSIST',
            'assist_title_ar' => '',
            'assist_description_en' => 'Our services are designed to help you achieve your goals and enrich your investment journey, supported by our professionals who serve as your dedicated investment office.',
            'assist_description_ar' => '',
            'assist_image' => 'images/assist1.png',
            'services' => [
                ['title_en' => 'GOVERNANCE ADVISORY', 'title_ar' => '', 'link' => '/governance-services'],
                ['title_en' => 'WEALTH PLANNING', 'title_ar' => '', 'link' => ''],
                ['title_en' => 'STRATEGIC INVESTMENT ADVISORY', 'title_ar' => '', 'link' => ''],
                ['title_en' => 'CIO OFFICE SERVICES', 'title_ar' => '', 'link' => ''],
            ],
            
            // Diversified Programs Section
            'diversified_title_en' => 'DIVERSIFIED PROGRAMS FOR AN IDEAL PORTFOLIO',
            'diversified_title_ar' => '',
            'diversified_description_en' => 'Unlock the full potential of your wealth with our diversified programs, tailored to your unique needs. Safeguard your assets, maximize charitable impact, simplify financial complexities, and align with your values.',
            'diversified_description_ar' => '',
            'diversified_desktop_image' => 'images/diversified.png',
            'diversified_mobile_image' => 'images/mobile-diversified.png',
            'diversified_button_text_en' => 'CHECK OUR PROGRAMS',
            'diversified_button_text_ar' => '',
            'diversified_button_link' => 'contact-us.html',
            'diversified_services' => [
                [
                    'icon' => 'design/images/diversified-service-1.svg',
                    'title_en' => 'TAILOR-MADE INVESTMENT',
                    'title_ar' => '',
                    'link' => ''
                ],
                [
                    'icon' => 'design/images/diversified-service-2.svg',
                    'title_en' => 'SHARIAA COMPLIANCE',
                    'title_ar' => '',
                    'link' => ''
                ],
                [
                    'icon' => 'design/images/diversified-service-3.svg',
                    'title_en' => 'FAMILY OFFICE',
                    'title_ar' => '',
                    'link' => ''
                ],
                [
                    'icon' => 'design/images/diversified-service-4.svg',
                    'title_en' => 'ENDOWMENTS',
                    'title_ar' => '',
                    'link' => ''
                ],
                [
                    'icon' => 'design/images/diversified-service-5.svg',
                    'title_en' => 'HNWI ADVISORY',
                    'title_ar' => '',
                    'link' => ''
                ],
                [
                    'icon' => 'design/images/diversified-service-6.svg',
                    'title_en' => 'VIRTUAL CIO',
                    'title_ar' => '',
                    'link' => ''
                ]
            ],
            
            // Board of Directors Section
            'directors_title_en' => 'BOARD OF DIRECTORS',
            'directors_title_ar' => '',
            'directors_description_en' => 'Hauberk Capital offers top-tier wealth advisory services for High-Net-Worth Individuals, Family Offices, and Endowments.',
            'directors_description_ar' => '',
            'directors_background_image' => 'images/directors-bg.png',
            'directors' => [
                ['name_en' => 'Wael Fawzi', 'name_ar' => '', 'position_en' => 'Managing Director', 'position_ar' => '', 'image' => 'images/wael.png'],
                ['name_en' => 'Natalia Biryukova', 'name_ar' => '', 'position_en' => 'Director', 'position_ar' => '', 'image' => 'images/natalia.png'],
                ['name_en' => 'Motesm Aggad', 'name_ar' => '', 'position_en' => 'Director', 'position_ar' => '', 'image' => 'images/motasem.png'],
            ],
            
            // Proven Track Record Section
            'track_record_title_en' => 'PROVEN TRACK RECORD',
            'track_record_title_ar' => '',
            'track_record_description_en' => 'Since 2019, we\'ve been dedicated to sculpting success stories, navigating markets, and securing brighter futures for our clients.',
            'track_record_description_ar' => '',
            'track_record_background_image' => 'images/record-bg.png',
            'track_record_metrics' => [
                ['value' => '650.0 M$', 'label_en' => 'Assets Under Advisory', 'label_ar' => ''],
                ['value' => '1,300.0', 'label_en' => 'The average client\'s portfolio return', 'label_ar' => ''],
                ['value' => '8.0', 'label_en' => 'Family Constitutions', 'label_ar' => ''],
                ['value' => '10.2%', 'label_en' => 'Global Investment Managers', 'label_ar' => ''],
                ['value' => '16.0', 'label_en' => 'Investment Policy Statement', 'label_ar' => ''],
                ['value' => '24.7%', 'label_en' => 'Annual Growth Rate', 'label_ar' => ''],
                ['value' => '42', 'label_en' => 'Satisfied Clients', 'label_ar' => ''],
                ['value' => '15+', 'label_en' => 'Years of Experience', 'label_ar' => ''],
                ['value' => '28', 'label_en' => 'Investment Professionals', 'label_ar' => ''],
                ['value' => '12.5M', 'label_en' => 'Average Portfolio Size', 'label_ar' => ''],
                ['value' => '5', 'label_en' => 'Global Offices', 'label_ar' => ''],
                ['value' => '97%', 'label_en' => 'Client Retention', 'label_ar' => ''],
                ['value' => '25+', 'label_en' => 'Industry Awards', 'label_ar' => ''],
                ['value' => '130+', 'label_en' => 'Investment Strategies', 'label_ar' => ''],
                ['value' => '18%', 'label_en' => 'Risk-Adjusted Returns', 'label_ar' => ''],
            ],
            
            // Road Map Section
            'roadmap_title_en' => 'HOW CAN WE START OUR JOURNEY TOGETHER?',
            'roadmap_title_ar' => '',
            'roadmap_steps' => [
                ['title_en' => 'Strategic Decision', 'title_ar' => '', 'icon' => 'images/journey-logo1.svg'],
                ['title_en' => 'Governance', 'title_ar' => '', 'icon' => 'images/journey-logo2.svg'],
                ['title_en' => 'Current portfolio analysis', 'title_ar' => '', 'icon' => 'images/journey-logo3.svg'],
                ['title_en' => 'Investment Policy Statement', 'title_ar' => '', 'icon' => 'images/journey-logo4.svg'],
                ['title_en' => 'Investment Implementation', 'title_ar' => '', 'icon' => 'images/journey-logo5.svg'],
                ['title_en' => 'Investment Structure', 'title_ar' => '', 'icon' => 'images/journey-logo6.svg'],
                ['title_en' => 'Mangers Search & Selection', 'title_ar' => '', 'icon' => 'images/journey-logo7.svg'],
                ['title_en' => 'Monitoring Performance', 'title_ar' => '', 'icon' => 'images/journey-logo8.svg'],
            ],
            'roadmap_mobile_image' => 'images/mobile.map.jpg',
            'roadmap_button_text_en' => 'REQUEST A MEETING',
            'roadmap_button_text_ar' => '',
            'roadmap_button_link' => 'request-a-meeting.html',
            
            // Insights Section
            'insights_title_en' => 'OUR INSIGHTS',
            'insights_title_ar' => '',
            'insights_sections' => [
                ['title_en' => 'Blogs', 'title_ar' => '', 'description_en' => 'Unlock the full potential of your wealth with our diversified programs, tailored to your unique.', 'description_ar' => '', 'image' => 'images/blog.png', 'link' => 'blog.html'],
                ['title_en' => 'Investor Library', 'title_ar' => '', 'description_en' => 'Unlock the full potential of your wealth with our diversified programs, tailored to your unique.', 'description_ar' => '', 'image' => 'images/investor.png', 'link' => 'blog2.html'],
                ['title_en' => 'News & Events', 'title_ar' => '', 'description_en' => 'Unlock the full potential of your wealth with our diversified programs, tailored to your unique.', 'description_ar' => '', 'image' => 'images/blog.png', 'link' => 'blog-3.html'],
                ['title_en' => 'Case Studies', 'title_ar' => '', 'description_en' => 'Unlock the full potential of your wealth with our diversified programs, tailored to your unique.', 'description_ar' => '', 'image' => 'images/blog4.png', 'link' => 'blog-4.html'],
            ],
            
            // Ready To Start Growing Section
            'cta_title_en' => 'READY TO START GROWING?!',
            'cta_title_ar' => '',
            'cta_description_en' => 'Unlock the full potential of your wealth',
            'cta_description_ar' => '',
            'cta_background_image' => 'images/meeting-bg.png',
            'cta_button_1_text_en' => 'JOIN OUR MAILING LIST',
            'cta_button_1_text_ar' => '',
            'cta_button_1_link' => 'contact-us.html',
            'cta_button_2_text_en' => 'REQUEST A MEETING',
            'cta_button_2_text_ar' => '',
            'cta_button_2_link' => 'request-a-meeting.html',
        ]);
    }
}

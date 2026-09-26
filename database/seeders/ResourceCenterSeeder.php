<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ResourceCenter;

class ResourceCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ResourceCenter::create([
            // Hero Section
            'hero_title_en' => 'RESOURCE CENTER',
            'hero_title_ar' => 'مركز الموارد',
            'hero_subtitle_en' => 'Your gateway to expert insights, strategic investment knowledge, and exclusive financial tools—designed to empower investors and businesses alike.',
            'hero_subtitle_ar' => 'بوابتك إلى رؤى الخبراء والمعرفة الاستثمارية الاستراتيجية والأدوات المالية الحصرية - المصممة لتمكين المستثمرين والشركات على حد سواء.',
            'hero_button_text_en' => 'REQUEST A MEETING',
            'hero_button_text_ar' => 'طلب اجتماع',
            
            // Main Section
            'section_title_en' => 'EXPLORE OUR KEY RESOURCES',
            'section_title_ar' => 'استكشف مواردنا الرئيسية',
            'section_subtitle_en' => 'Explore the dynamic teams that drive our innovation and expertise, each dedicated to optimizing your wealth advisory experience.',
            'section_subtitle_ar' => 'استكشف الفرق الديناميكية التي تقود ابتكارنا وخبرتنا ، كل منها مكرس لتحسين تجربة استشارات الثروة الخاصة بك.',
            
            // Card 1: Blog/News
            'blog_card_title_en' => 'Blogs / News',
            'blog_card_title_ar' => 'المدونات / الأخبار',
            'blog_card_link' => '/blog',
            
            // Card 2: Case Studies
            'case_studies_card_title_en' => 'Case Studies',
            'case_studies_card_title_ar' => 'دراسات الحالة',
            'case_studies_card_link' => '/blog',
            
            // Card 3: Tools
            'tools_card_title_en' => 'Tools',
            'tools_card_title_ar' => 'الأدوات',
            'tools_card_link' => '/blog',
            
            // CTA Section
            'cta_title_en' => "READY TO\nSTART GROWING?!",
            'cta_title_ar' => "هل أنت مستعد\nللبدء في النمو؟!",
            'cta_subtitle_en' => 'Unlock the full potential of your wealth',
            'cta_subtitle_ar' => 'أطلق العنان للإمكانات الكاملة لثروتك',
            'cta_button_1_text_en' => 'JOIN OUR MAILING LIST',
            'cta_button_1_text_ar' => 'انضم إلى قائمتنا البريدية',
            'cta_button_2_text_en' => 'REQUEST A MEETING',
            'cta_button_2_text_ar' => 'طلب اجتماع',
            
            'is_active' => true,
        ]);
    }
}

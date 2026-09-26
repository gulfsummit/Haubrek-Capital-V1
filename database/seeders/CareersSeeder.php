<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Careers;

class CareersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Careers::create([
            // Hero Section
            'hero_title_en' => 'JOIN OUR TEAM',
            'hero_title_ar' => 'انضم إلى فريقنا',
            'hero_subtitle_en' => '<p>Careers that Drive your Success</p>',
            'hero_subtitle_ar' => '<p>وظائف تقود نجاحك</p>',
            'hero_button_text_en' => 'MORE ABOUT US',
            'hero_button_text_ar' => 'المزيد عنا',
            'hero_button_link' => '/about-us',
            
            // Why Work Section
            'why_work_title_en' => 'WHY WORK AT HAUBERK CAPITAL?',
            'why_work_title_ar' => 'لماذا تعمل في هوبيرك كابيتال؟',
            'why_work_subtitle_en' => '<p>Working at Hauberk Capital means being part of a vibrant and inclusive community. Our team enjoys</p>',
            'why_work_subtitle_ar' => '<p>العمل في هوبيرك كابيتال يعني أن تكون جزءًا من مجتمع نابض بالحياة وشامل. يستمتع فريقنا</p>',
            
            // Card 1
            'card1_title_en' => 'A COLLABORATIVE ENVIRONMENT',
            'card1_title_ar' => 'بيئة تعاونية',
            'card1_content_en' => '<p>Our team-oriented culture fosters collaboration and innovation. We believe in the power of teamwork to achieve great results.</p>',
            'card1_content_ar' => '<p>ثقافتنا الموجهة نحو الفريق تعزز التعاون والابتكار. نؤمن بقوة العمل الجماعي لتحقيق نتائج عظيمة.</p>',
            
            // Card 2
            'card2_title_en' => "PROFESSIONAL \nGROWTH",
            'card2_title_ar' => 'النمو المهني',
            'card2_content_en' => '<p>We are committed to your career development. From continuous learning opportunities to career advancement programs, we invest in our employees\' growth.</p>',
            'card2_content_ar' => '<p>نحن ملتزمون بتطوير حياتك المهنية. من فرص التعلم المستمر إلى برامج التقدم الوظيفي ، نستثمر في نمو موظفينا.</p>',
            
            // Card 3
            'card3_title_en' => "COMPETITIVE \nBENEFITS",
            'card3_title_ar' => 'مزايا تنافسية',
            'card3_content_en' => '<p>Our comprehensive benefits package includes health insurance, retirement plans, performance bonuses, and more to reward your contributions.</p>',
            'card3_content_ar' => '<p>تتضمن حزمة المزايا الشاملة لدينا التأمين الصحي وخطط التقاعد ومكافآت الأداء والمزيد لمكافأة مساهماتك.</p>',
            
            // How to Apply Section
            'how_to_apply_title_en' => 'HOW TO APPLY',
            'how_to_apply_title_ar' => 'كيفية التقديم',
            'how_to_apply_text1_en' => '<p>To apply, please send your CV and cover letter to <a href="mailto:careers@hauberkcapital.com" class="text-[#D4AF37] underline hover:text-[#bfa14e] transition-colors">careers@hauberkcapital.com</a>.<br class="hidden sm:block">Or fill out this form. Our HR team will contact you after reviewing your application.</p>',
            'how_to_apply_text1_ar' => '<p>للتقديم ، يرجى إرسال سيرتك الذاتية وخطاب التغطية إلى <a href="mailto:careers@hauberkcapital.com" class="text-[#D4AF37] underline hover:text-[#bfa14e] transition-colors">careers@hauberkcapital.com</a>.<br class="hidden sm:block">أو املأ هذا النموذج. سيتصل بك فريق الموارد البشرية لدينا بعد مراجعة طلبك.</p>',
            'how_to_apply_text2_en' => '<p>We believe that diversity drives innovation and strengthens our company.<br class="hidden sm:block">At Hauberk Capital, we are committed to creating an inclusive workplace where everyone feels valued and respected.</p>',
            'how_to_apply_text2_ar' => '<p>نعتقد أن التنوع يدفع الابتكار ويعزز شركتنا.<br class="hidden sm:block">في هوبيرك كابيتال ، نحن ملتزمون بخلق مكان عمل شامل حيث يشعر الجميع بالتقدير والاحترام.</p>',
            'apply_email' => 'careers@hauberkcapital.com',
            
            // CTA Section
            'cta_title_en' => "READY TO\nSTART GROWING?!",
            'cta_title_ar' => "هل أنت مستعد\nللبدء في النمو؟!",
            'cta_subtitle_en' => '<p>Unlock the full potential of your wealth</p>',
            'cta_subtitle_ar' => '<p>أطلق العنان للإمكانات الكاملة لثروتك</p>',
            'cta_button_1_text_en' => 'JOIN OUR MAILING LIST',
            'cta_button_1_text_ar' => 'انضم إلى قائمتنا البريدية',
            'cta_button_2_text_en' => 'REQUEST A MEETING',
            'cta_button_2_text_ar' => 'طلب اجتماع',
            
            'is_active' => true,
        ]);
    }
}

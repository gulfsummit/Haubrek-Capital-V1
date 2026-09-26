<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tools;

class ToolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tools::create([
            // Hero Section
            'hero_title_en' => 'INVESTOR RISK-RETURN PROFILING TOOL',
            'hero_title_ar' => 'أداة تحليل المخاطر والعوائد للمستثمرين',
            'hero_desktop_image' => null,
            'hero_mobile_image' => null,
            
            // Investment Profile Section
            'profile_title_en' => 'DISCOVER YOUR<br>INVESTMENT PROFILE',
            'profile_title_ar' => 'اكتشف ملف<br>الاستثمار الخاص بك',
            'profile_description_en' => '<p>Understanding your risk tolerance is crucial for developing an investment strategy that aligns with your financial goals. Our Investor Risk-Return Profiling Tool helps you assess your risk appetite and provides personalized recommendations for your investment portfolio.</p>',
            'profile_description_ar' => '<p>يعد فهم قدرتك على تحمل المخاطر أمرًا بالغ الأهمية لتطوير استراتيجية استثمارية تتماشى مع أهدافك المالية. تساعدك أداة تحليل المخاطر والعوائد الخاصة بنا في تقييم شهيتك للمخاطرة وتوفر توصيات مخصصة لمحفظتك الاستثمارية.</p>',
            'profile_image' => null,
            
            // Key Features Section
            'features_title_en' => 'KEY FEATURES',
            'features_title_ar' => 'الميزات الرئيسية',
            'features_list_en' => [
                ['title' => 'Risk Assessment Questionnaire', 'description' => 'Answer a series of questions to determine your risk tolerance level.'],
                ['title' => 'Personalized Risk Profile', 'description' => 'Receive a detailed risk profile based on your responses.'],
                ['title' => 'Investment Recommendations', 'description' => 'Get tailored investment recommendations that match your risk profile.'],
                ['title' => 'Scenario Analysis', 'description' => 'See how different market conditions might impact your investment returns.'],
                ['title' => 'Progress Tracking', 'description' => 'Monitor your risk tolerance and investment performance over time.'],
            ],
            'features_list_ar' => [
                ['title' => 'استبيان تقييم المخاطر', 'description' => 'أجب عن سلسلة من الأسئلة لتحديد مستوى تحمل المخاطر الخاص بك.'],
                ['title' => 'ملف المخاطر الشخصي', 'description' => 'احصل على ملف مخاطر مفصل بناءً على إجاباتك.'],
                ['title' => 'توصيات الاستثمار', 'description' => 'احصل على توصيات استثمارية مخصصة تتناسب مع ملف المخاطر الخاص بك.'],
                ['title' => 'تحليل السيناريو', 'description' => 'انظر كيف يمكن أن تؤثر ظروف السوق المختلفة على عوائد الاستثمار الخاصة بك.'],
                ['title' => 'تتبع التقدم', 'description' => 'راقب قدرتك على تحمل المخاطر وأداء استثمارك بمرور الوقت.'],
            ],
            'features_background_image' => null,
            
            // How It Works Section
            'how_it_works_title_en' => 'HOW IT WORKS:',
            'how_it_works_title_ar' => 'كيف يعمل:',
            'how_it_works_steps_en' => [
                ['step' => 'Start the Assessment Click the "Start Assessment" button to begin the questionnaire.'],
                ['step' => 'Answer the Questions Complete a series of questions about your financial situation, investment goals, and risk tolerance.'],
                ['step' => 'Review Your Risk Profile View your personalized risk profile and understand your risk tolerance level.'],
                ['step' => 'Get Investment Recommendations Receive investment suggestions tailored to your risk profile.'],
                ['step' => 'Explore Scenario Analysis Analyze how your portfolio might perform under different market conditions.'],
                ['step' => 'Track Your Progress Regularly update your profile and monitor your investment performance.'],
            ],
            'how_it_works_steps_ar' => [
                ['step' => 'ابدأ التقييم انقر على زر "بدء التقييم" لبدء الاستبيان.'],
                ['step' => 'أجب عن الأسئلة أكمل سلسلة من الأسئلة حول وضعك المالي وأهداف استثمارك وقدرتك على تحمل المخاطر.'],
                ['step' => 'راجع ملف المخاطر الخاص بك اعرض ملف المخاطر الشخصي الخاص بك وفهم مستوى تحمل المخاطر الخاص بك.'],
                ['step' => 'احصل على توصيات الاستثمار احصل على اقتراحات استثمارية مصممة خصيصًا لملف المخاطر الخاص بك.'],
                ['step' => 'استكشف تحليل السيناريو حلل كيف يمكن أن تؤدي محفظتك في ظروف السوق المختلفة.'],
                ['step' => 'تتبع تقدمك حدِّث ملفك الشخصي بانتظام وراقب أداء استثمارك.'],
            ],
            
            // Form Section
            'form_title_en' => 'START YOUR RISK-<br>RETURN ASSESSMENT',
            'form_title_ar' => 'ابدأ تقييم<br>المخاطر والعوائد',
            'form_background_image' => null,
            'form_button_text_en' => 'SEND MESSAGE',
            'form_button_text_ar' => 'إرسال الرسالة',
        ]);
    }
}

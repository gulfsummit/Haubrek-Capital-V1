<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\App;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        App::create([
            // Hero Section
            'hero_title_en' => 'HAUBERK CAPITAL APP',
            'hero_title_ar' => 'تطبيق هوبيرك كابيتال',
            'hero_subtitle_en' => 'Your Portfolio in Your Pocket',
            'hero_subtitle_ar' => 'محفظتك في جيبك',
            'hero_background_image' => null,
            'hero_mobile_background_image' => null,
            
            // Investment App Promo Section
            'promo_title_en' => 'INVESTMENT MADE SIMPLE ONE APP, TOTAL CONTROL',
            'promo_title_ar' => 'الاستثمار مبسط في تطبيق واحد، تحكم كامل',
            'promo_description_en' => 'Take full control of your investments with the Hauberk Capital mobile app—your ultimate financial companion designed for efficiency, security, and real-time decision-making.',
            'promo_description_ar' => 'تحكم كامل في استثماراتك مع تطبيق هوبيرك كابيتال المحمول—رفيقك المالي الأمثل المصمم للكفاءة والأمان واتخاذ القرارات في الوقت الفعلي.',
            'promo_background_image' => null,
            'promo_mobile_1_image' => null,
            'promo_mobile_2_image' => null,
            'promo_mobile_3_image' => null,
            
            // Bottom Half Section
            'bottom_title_en' => 'EFFORTLESSLY MONITOR YOUR INVESTMENTS',
            'bottom_title_ar' => 'راقب استثماراتك بسهولة',
            'bottom_subtitle_en' => 'Managing Portfolio, Always Accessible',
            'bottom_subtitle_ar' => 'إدارة المحفظة، متاحة دائماً',
            'bottom_background_image' => null,
            'bottom_bullet_points_en' => [
                ['point' => '24/7 account access to manage your wealth seamlessly.'],
                ['point' => 'Real-time portfolio insights with interactive dashboards.'],
                ['point' => 'Performance analytics to help you make informed decisions.']
            ],
            'bottom_bullet_points_ar' => [
                ['point' => 'وصول 24/7 للحساب لإدارة ثروتك بسلاسة.'],
                ['point' => 'رؤى المحفظة في الوقت الفعلي مع لوحات تفاعلية.'],
                ['point' => 'تحليلات الأداء لمساعدتك في اتخاذ قرارات مدروسة.']
            ],
            
            // Connect Section
            'connect_subtitle_en' => 'ENGAGE DIRECTLY WITH OUR TEAM',
            'connect_subtitle_ar' => 'تواصل مباشرة مع فريقنا',
            'connect_title_en' => 'Connect with Your Investment Experts',
            'connect_title_ar' => 'تواصل مع خبراء الاستثمار لديك',
            'connect_bullet_points_en' => [
                ['point' => 'Instant chat & video calls with your dedicated investment manager.'],
                ['point' => 'Access expert recommendations tailored to your financial goals.'],
                ['point' => 'Join exclusive discussions on market trends and strategies.']
            ],
            'connect_bullet_points_ar' => [
                ['point' => 'دردشة فورية ومكالمات فيديو مع مدير الاستثمار المخصص لك.'],
                ['point' => 'احصل على توصيات خبيرة مخصصة لأهدافك المالية.'],
                ['point' => 'انضم إلى مناقشات حصرية حول اتجاهات السوق والاستراتيجيات.']
            ],
            'connect_background_image' => null,
            'connect_mobile_image' => null,
            
            // Documentation Section
            'docs_subtitle_en' => 'Manage all your financial documents',
            'docs_subtitle_ar' => 'أدر جميع مستنداتك المالية',
            'docs_title_en' => 'Secure & Smart Documentation',
            'docs_title_ar' => 'توثيق آمن وذكي',
            'docs_bullet_points_en' => [
                ['point' => 'E-signature support for quick approvals.'],
                ['point' => 'Safe digital archive for legal and investment documents.'],
                ['point' => 'Online KYC & regulatory compliance—fast and hassle-free.']
            ],
            'docs_bullet_points_ar' => [
                ['point' => 'دعم التوقيع الإلكتروني للموافقات السريعة.'],
                ['point' => 'أرشيف رقمي آمن للمستندات القانونية والاستثمارية.'],
                ['point' => 'التحقق من الهوية والامتثال التنظيمي عبر الإنترنت—سريع وخالي من المتاعب.']
            ],
            'docs_background_image' => null,
            'docs_mobile_image' => null,
            
            // Knowledge Section
            'knowledge_subtitle_en' => 'access to premium financial education and industry expertise.',
            'knowledge_subtitle_ar' => 'الوصول إلى التعليم المالي المميز والخبرة الصناعية.',
            'knowledge_title_en' => 'Exclusive Knowledge & Investment Insights',
            'knowledge_title_ar' => 'معرفة حصرية ورؤى استثمارية',
            'knowledge_bullet_points_en' => [
                ['point' => 'Live & recorded webinars with market leaders.'],
                ['point' => 'Interactive learning circles covering investment strategies.'],
                ['point' => 'Personalized market updates tailored to your portfolio.']
            ],
            'knowledge_bullet_points_ar' => [
                ['point' => 'ندوات عبر الإنترنت مباشرة ومسجلة مع قادة السوق.'],
                ['point' => 'دوائر تعليمية تفاعلية تغطي استراتيجيات الاستثمار.'],
                ['point' => 'تحديثات السوق المخصصة لمحفظتك.']
            ],
            'knowledge_background_image' => null,
            'knowledge_mobile_image' => null,
            
            // Security Section
            'security_subtitle_en' => 'with advanced encryption and multi-layered security protocols.',
            'security_subtitle_ar' => 'مع التشفير المتقدم وبروتوكولات الأمان متعددة الطبقات.',
            'security_title_en' => 'Security You Can Trust',
            'security_title_ar' => 'أمان يمكنك الوثوق به',
            'security_bullet_points_en' => [
                ['point' => 'Biometric authentication for secure logins.'],
                ['point' => 'Real-time fraud detection & alerts.']
            ],
            'security_bullet_points_ar' => [
                ['point' => 'المصادقة البيومترية لتسجيلات الدخول الآمنة.'],
                ['point' => 'كشف الاحتيال في الوقت الفعلي والتنبيهات.']
            ],
            'security_background_image' => null,
            'security_mobile_image' => null,
            
            // CTA Section
            'cta_title_en' => 'READY TO START GROWING?!',
            'cta_title_ar' => 'مستعد لبدء النمو؟!',
            'cta_subtitle_en' => 'Unlock the full potential of your wealth',
            'cta_subtitle_ar' => 'أطلق العنان لإمكانات ثروتك الكاملة',
            'cta_background_image' => null,
            'cta_button_1_text_en' => 'JOIN OUR MAILING LIST',
            'cta_button_1_text_ar' => 'انضم إلى قائمة البريد الإلكتروني',
            'cta_button_1_url' => '/contact-us',
            'cta_button_2_text_en' => 'REQUEST A MEETING',
            'cta_button_2_text_ar' => 'اطلب اجتماعاً',
            'cta_button_2_url' => '/request-meeting',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GovernanceServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\GovernanceServices::create([
            // Hero Section
            'hero_desktop_image' => 'images/governance-innerpage-pg.png',
            'hero_mobile_image' => 'images/mobile-governance-innerpage-pg.png',
            'hero_title_en' => 'GOVERNANCE SERVICES',
            'hero_title_ar' => 'خدمات الحوكمة',
            'hero_subtitle_en' => 'Tailored Governance for Lasting Prosperity',
            'hero_subtitle_ar' => 'حوكمة مخصصة للازدهار الدائم',
            'hero_button_text_en' => 'REQUEST A MEETING',
            'hero_button_text_ar' => 'اطلب اجتماع',
            'hero_button_url' => 'request-a-meeting',
            
            // Services Overview Section
            'services_title_en' => 'GOVERNANCE SERVICES',
            'services_title_ar' => 'خدمات الحوكمة',
            'services_description_en' => 'In today\'s complex financial landscape, managing and safeguarding wealth requires addressing several critical challenges:',
            'services_description_ar' => 'في المشهد المالي المعقد اليوم، تتطلب إدارة الثروة وحمايتها معالجة عدة تحديات حاسمة:',
            'services_cards' => [
                [
                    'title_en' => 'SETUP OF FAMILY CONSTITUTIONS',
                    'title_ar' => 'إعداد دساتير الأسرة',
                    'description_en' => 'Setup up a new investment and legal structure or strengthen an existing one for protecting and governing the current wealth.',
                    'description_ar' => 'إعداد هيكل استثماري وقانوني جديد أو تعزيز الهيكل الموجود لحماية وإدارة الثروة الحالية.',
                ],
                [
                    'title_en' => 'SETUP OF ENDOWMENTS',
                    'title_ar' => 'إعداد الأوقاف',
                    'description_en' => 'Setup of Endowments and foundation deeds. Design the investment office and Endowment fund organization structure.',
                    'description_ar' => 'إعداد الأوقاف وصكوك المؤسسات. تصميم مكتب الاستثمار وهيكل تنظيم صندوق الوقف.',
                ],
                [
                    'title_en' => 'FAMILY OFFICE SETUP',
                    'title_ar' => 'إعداد المكتب العائلي',
                    'description_en' => 'Comprehensive family office establishment including governance frameworks, operational structures, and succession planning protocols.',
                    'description_ar' => 'إنشاء مكتب عائلي شامل يتضمن أطر الحوكمة والهياكل التشغيلية وبروتوكولات التخطيط للخلافة.',
                ],
                [
                    'title_en' => 'WEALTH TRANSFER PLANNING',
                    'title_ar' => 'تخطيط نقل الثروة',
                    'description_en' => 'Strategic planning for intergenerational wealth transfer with focus on tax efficiency, legal compliance, and preservation of family values.',
                    'description_ar' => 'التخطيط الاستراتيجي لنقل الثروة بين الأجيال مع التركيز على الكفاءة الضريبية والامتثال القانوني والحفاظ على القيم الأسرية.',
                ],
                [
                    'title_en' => 'GOVERNANCE AUDITS',
                    'title_ar' => 'مراجعات الحوكمة',
                    'description_en' => 'Comprehensive assessment of existing governance structures with actionable recommendations for optimization and risk mitigation.',
                    'description_ar' => 'تقييم شامل لهياكل الحوكمة الحالية مع توصيات قابلة للتنفيذ للتحسين وتخفيف المخاطر.',
                ],
                [
                    'title_en' => 'REGULATORY COMPLIANCE',
                    'title_ar' => 'الامتثال التنظيمي',
                    'description_en' => 'Expert guidance on navigating complex regulatory environments across multiple jurisdictions to ensure full compliance and risk management.',
                    'description_ar' => 'إرشاد خبير للتنقل في البيئات التنظيمية المعقدة عبر ولايات قضائية متعددة لضمان الامتثال الكامل وإدارة المخاطر.',
                ],
            ],
            
            // Approach Section
            'approach_background_image' => 'images/approach-bg.png',
            'approach_title_en' => 'GOVERNANCE APPROACH',
            'approach_title_ar' => 'نهج الحوكمة',
            'approach_description_en' => 'At Hauberk Capital, we differentiate ourselves through an innovative approach to wealth governance that prioritizes customization, strategic alignment, and sustainable outcomes.',
            'approach_description_ar' => 'في هوبرك كابيتال، نميز أنفسنا من خلال نهج مبتكر لحوكمة الثروة يعطي الأولوية للتخصيص والتوافق الاستراتيجي والنتائج المستدامة.',
            'approach_description_2_en' => 'We recognize that each client, whether an HNWI, Family Office, or Endowment, presents unique challenges and aspirations. Therefore, our approach is designed to deliver tailored solutions that maximize efficiency and effectiveness across the following dimensions:',
            'approach_description_2_ar' => 'ندرك أن كل عميل، سواء كان من أصحاب الثروات العالية أو المكاتب العائلية أو الأوقاف، يواجه تحديات وتطلعات فريدة. لذلك، تم تصميم نهجنا لتقديم حلول مخصصة تزيد من الكفاءة والفعالية عبر الأبعاد التالية:',
            'approach_items' => [
                [
                    'title_en' => 'Personalization and Customization',
                    'title_ar' => 'التخصيص والتخصيص',
                    'content_en' => 'Our top priority is meeting our clients\' objectives and evolving needs - We align our services with the core values of our philosophy.',
                    'content_ar' => 'أولويتنا القصوى هي تلبية أهداف عملائنا واحتياجاتهم المتطورة - نحن نوائم خدماتنا مع القيم الأساسية لفلسفتنا.',
                    'is_expanded' => true,
                ],
                [
                    'title_en' => 'Integrated Expertise',
                    'title_ar' => 'الخبرة المتكاملة',
                    'content_en' => 'Our long-term relationships with clients and partners are built on trust and mutual respect. - We consistently provide reliable, cost-effective solutions.',
                    'content_ar' => 'علاقاتنا طويلة المدى مع العملاء والشركاء مبنية على الثقة والاحترام المتبادل. - نقدم باستمرار حلولاً موثوقة وفعالة من حيث التكلفة.',
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Strategic Frameworks',
                    'title_ar' => 'الأطر الاستراتيجية',
                    'content_en' => 'Our long-term relationships with clients and partners are built on trust and mutual respect. - We consistently provide reliable, cost-effective solutions.',
                    'content_ar' => 'علاقاتنا طويلة المدى مع العملاء والشركاء مبنية على الثقة والاحترام المتبادل. - نقدم باستمرار حلولاً موثوقة وفعالة من حيث التكلفة.',
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Continuous Innovation',
                    'title_ar' => 'الابتكار المستمر',
                    'content_en' => 'We stay at the forefront of technological advancements through continuous research and development. - We are committed to staying ahead of market trends and evolving investor needs.',
                    'content_ar' => 'نبقى في المقدمة في التطورات التكنولوجية من خلال البحث والتطوير المستمر. - نحن ملتزمون بالبقاء في المقدمة في اتجاهات السوق واحتياجات المستثمرين المتطورة.',
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Collaborative Partnership',
                    'title_ar' => 'الشراكة التعاونية',
                    'content_en' => 'We stay at the forefront of technological advancements through continuous research and development. - We are committed to staying ahead of market trends and evolving investor needs.',
                    'content_ar' => 'نبقى في المقدمة في التطورات التكنولوجية من خلال البحث والتطوير المستمر. - نحن ملتزمون بالبقاء في المقدمة في اتجاهات السوق واحتياجات المستثمرين المتطورة.',
                    'is_expanded' => false,
                ],
            ],
            
            // Steps Section
            'steps_title_en' => 'STEPS TO START',
            'steps_title_ar' => 'خطوات البدء',
            'steps_subtitle_en' => 'Your Wealth Governance',
            'steps_subtitle_ar' => 'حوكمة ثروتك',
            'steps_items' => [
                [
                    'number' => 1,
                    'title_en' => 'INITIAL CONSULTATION',
                    'title_ar' => 'الاستشارة الأولية',
                ],
                [
                    'number' => 2,
                    'title_en' => 'STRATEGIC PLANNING AND FRAMEWORK DEVELOPMENT',
                    'title_ar' => 'التخطيط الاستراتيجي وتطوير الإطار',
                ],
                [
                    'number' => 3,
                    'title_en' => 'IMPLEMENTATION OF GOVERNANCE STRUCTURES',
                    'title_ar' => 'تنفيذ هياكل الحوكمة',
                ],
                [
                    'number' => 4,
                    'title_en' => 'ONGOING MONITORING AND OPTIMIZATION',
                    'title_ar' => 'المراقبة والتحسين المستمر',
                ],
            ],
            
            // Why Choose Us Section
            'why_choose_title_en' => 'WHY CHOOSE US',
            'why_choose_title_ar' => 'لماذا تختارنا',
            'why_choose_items' => [
                [
                    'image' => 'images/wcu-1.png',
                    'title_en' => 'EXPERT ADVISORS',
                    'title_ar' => 'مستشارون خبراء',
                    'description_en' => 'Our team comprises seasoned professionals with extensive experience in wealth management, legal advisory, and family governance.',
                    'description_ar' => 'يتألف فريقنا من محترفين ذوي خبرة واسعة في إدارة الثروات والاستشارات القانونية وحوكمة الأسرة.',
                ],
                [
                    'image' => 'images/wcu-2.png',
                    'title_en' => 'HOLISTIC APPROACH',
                    'title_ar' => 'نهج شمولي',
                    'description_en' => 'Our integrated approach considers all aspects of wealth governance, from financial advisory to legal compliance and family dynamics.',
                    'description_ar' => 'نهجنا المتكامل يأخذ في الاعتبار جميع جوانب حوكمة الثروة، من الاستشارات المالية إلى الامتثال القانوني وديناميكيات الأسرة.',
                ],
                [
                    'image' => 'images/wcu-3.png',
                    'title_en' => 'TAILORED SOLUTIONS',
                    'title_ar' => 'حلول مخصصة',
                    'description_en' => 'We understand that every client is unique, and we tailor our services to meet your specific needs and goals with highest standards of ethics & transparency.',
                    'description_ar' => 'نحن نفهم أن كل عميل فريد، ونخصص خدماتنا لتلبية احتياجاتك وأهدافك المحددة بأعلى معايير الأخلاق والشفافية.',
                ],
            ],
            
            // CTA Section
            'cta_background_image' => 'images/meeting-bg.png',
            'cta_title_en' => 'READY TO START GROWING?!',
            'cta_title_ar' => 'مستعد لبدء النمو؟!',
            'cta_description_en' => 'Unlock the full potential of your wealth',
            'cta_description_ar' => 'اطلق العنان للإمكانات الكاملة لثروتك',
            'cta_button_1_text_en' => 'JOIN OUR MAILING LIST',
            'cta_button_1_text_ar' => 'انضم لقائمتنا البريدية',
            'cta_button_1_url' => 'contact-us',
            'cta_button_2_text_en' => 'REQUEST A MEETING',
            'cta_button_2_text_ar' => 'اطلب اجتماع',
            'cta_button_2_url' => 'request-a-meeting',
        ]);
    }
}

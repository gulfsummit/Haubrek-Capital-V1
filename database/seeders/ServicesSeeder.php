<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Services;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Services::create([
            // Hero Section
            'hero_title_en' => 'SERVICES',
            'hero_title_ar' => 'الخدمات',
            'hero_subtitle_en' => 'Discover our comprehensive wealth management solutions',
            'hero_subtitle_ar' => 'اكتشف حلول إدارة الثروات الشاملة لدينا',
            'hero_background_image' => null,
            'hero_mobile_background_image' => null,
            'hero_button_text_en' => 'REQUEST A MEETING',
            'hero_button_text_ar' => 'اطلب اجتماعاً',
            'hero_button_link' => '/request-meeting',
            
            // Main Description Section
            'description_title_en' => 'OPTIMIZING WEALTH MANAGEMENT FOR HNWI, FAMILY OFFICES & ENDOWMENTS',
            'description_title_ar' => 'تحسين إدارة الثروات للأفراد ذوي الملاءة العالية ومكاتب العائلة والهبات',
            'description_en' => 'As liquid assets grow, so do the challenges of managing them effectively. We establish dedicated investment offices and endowment funds to ensure sustainability, capital growth, and governance.<br><br>A high-performing investment office goes beyond wealth management, driving asset diversification, governance, and performance monitoring. Depending on asset value, management can be insourced or outsourced.<br><br>At Hauberk Capital, we provide outsourced wealth management solutions to reduce costs, enhance governance, and optimize asset allocation—ensuring long-term financial success.',
            'description_ar' => 'مع نمو الأصول السائلة، تنمو أيضًا تحديات إدارتها بفعالية. نقوم بإنشاء مكاتب استثمارية مخصصة وصناديق هبات لضمان الاستدامة والنمو الرأسمالي والحوكمة.<br><br>مكتب الاستثمار عالي الأداء يتجاوز إدارة الثروات، ويقود تنويع الأصول والحوكمة ومراقبة الأداء. اعتمادًا على قيمة الأصول، يمكن أن تكون الإدارة داخلية أو خارجية.<br><br>في هوبيرك كابيتال، نقدم حلول إدارة الثروات الخارجية لتقليل التكاليف وتعزيز الحوكمة وتحسين تخصيص الأصول—ضمان النجاح المالي طويل المدى.',
            
            // Services List Section
            'services_list' => [
                [
                    'title_en' => 'GOVERNANCE ADVISORY',
                    'title_ar' => 'الاستشارات الحوكمية',
                    'description_en' => 'Strengthening structures for sustainable success.',
                    'description_ar' => 'تعزيز الهياكل للنجاح المستدام.',
                    'link' => '/governance-services',
                ],
                [
                    'title_en' => 'WEALTH PLANNING',
                    'title_ar' => 'تخطيط الثروات',
                    'description_en' => 'Strategic planning to protect and grow your wealth.',
                    'description_ar' => 'تخطيط استراتيجي لحماية ونمو ثروتك.',
                    'link' => '/wealth-planning-services',
                ],
                [
                    'title_en' => 'STRATEGIC INVESTMENT ADVISORY',
                    'title_ar' => 'الاستشارات الاستثمارية الاستراتيجية',
                    'description_en' => 'Data-driven insights for smarter investments.',
                    'description_ar' => 'رؤى مدفوعة بالبيانات لاستثمارات أكثر ذكاءً.',
                    'link' => '/investment-services',
                ],
                [
                    'title_en' => 'CIO OFFICE SERVICES',
                    'title_ar' => 'خدمات مكتب المدير التنفيذي للاستثمار',
                    'description_en' => 'Enhancing portfolio management efficiency.',
                    'description_ar' => 'تعزيز كفاءة إدارة المحفظة.',
                    'link' => '/cio-services',
                ],
            ],
            
            // Additional fields that exist in the table
            'sliders_card' => null,
            'approaches_tool' => null,
            'steps_start_card' => null,
            
            // Governance Advisory Section
            'governance_title_en' => 'GOVERNANCE ADVISORY',
            'governance_title_ar' => 'الاستشارات الحوكمية',
            'governance_description_en' => 'We help establish strong governance frameworks to ensure compliance, risk management, and long-term sustainability, enabling better decision-making and control over asset diversification.',
            'governance_description_ar' => 'نساعد في إنشاء أطر حوكمية قوية لضمان الامتثال وإدارة المخاطر والاستدامة طويلة المدى، مما يتيح اتخاذ قرارات أفضل والتحكم في تنويع الأصول.',
            'governance_background' => null,
            'governance_image' => null,
            'governance_link' => '/governance-services',
            
            // Wealth Planning Section
            'wealth_title_en' => 'WEALTH PLANNING',
            'wealth_title_ar' => 'تخطيط الثروات',
            'wealth_description_en' => 'Our strategic wealth planning solutions are designed to protect, grow, and transfer wealth efficiently, ensuring financial security for future generations while optimizing tax and investment structures.',
            'wealth_description_ar' => 'تم تصميم حلول تخطيط الثروات الاستراتيجية لدينا لحماية ونمو ونقل الثروات بكفاءة، مما يضمن الأمان المالي للأجيال القادمة مع تحسين الهياكل الضريبية والاستثمارية.',
            'wealth_background' => null,
            'wealth_mobile_background_image' => null,
            'wealth_image' => null,
            'wealth_link' => '/wealth-planning-services',
            
            // Strategic Investment Advisory Section
            'investment_title_en' => 'STRATEGIC INVESTMENT ADVISORY',
            'investment_title_ar' => 'الاستشارات الاستثمارية الاستراتيجية',
            'investment_description_en' => 'We provide data-driven investment strategies that align with your long-term goals, ensuring optimal asset allocation, risk management, and performance tracking for sustainable capital growth.',
            'investment_description_ar' => 'نقدم استراتيجيات استثمارية مدفوعة بالبيانات تتوافق مع أهدافك طويلة المدى، مما يضمن التخصيص الأمثل للأصول وإدارة المخاطر وتتبع الأداء للنمو الرأسمالي المستدام.',
            'investment_background' => null,
            'investment_image' => null,
            'investment_link' => '/investment-services',
            
            // CIO Office Services Section
            'cio_title_en' => 'CIO OFFICE SERVICES',
            'cio_title_ar' => 'خدمات مكتب المدير التنفيذي للاستثمار',
            'cio_description_en' => 'Our outsourced CIO services offer institutional-grade portfolio management, helping organizations enhance efficiency, maintain governance, and implement robust performance monitoring frameworks.',
            'cio_description_ar' => 'تقدم خدمات المدير التنفيذي للاستثمار الخارجية لدينا إدارة محافظ من المستوى المؤسسي، مما يساعد المؤسسات على تعزيز الكفاءة والحفاظ على الحوكمة وتنفيذ أطر مراقبة الأداء القوية.',
            'cio_background' => null,
            'cio_mobile_background_image' => null,
            'cio_image' => null,
            'cio_link' => '/cio-services',
            
            // Roadmap Section
            'roadmap_title_en' => 'CLIENT\'S ROAD MAP',
            'roadmap_title_ar' => 'خريطة طريق العميل',
            'roadmap_mobile_image' => null,
            'roadmap_steps' => [
                ['title_en' => 'Strategic Decision', 'title_ar' => 'قرار استراتيجي'],
                ['title_en' => 'Governance', 'title_ar' => 'الحوكمة'],
                ['title_en' => 'Current portfolio analysis', 'title_ar' => 'تحليل المحفظة الحالية'],
                ['title_en' => 'Investment Policy Statement', 'title_ar' => 'بيان السياسة الاستثمارية'],
                ['title_en' => 'Investment Implementation', 'title_ar' => 'تنفيذ الاستثمار'],
                ['title_en' => 'Investment Structure', 'title_ar' => 'هيكل الاستثمار'],
                ['title_en' => 'Managers Search & Selection', 'title_ar' => 'البحث عن المديرين والاختيار'],
                ['title_en' => 'Monitoring Performance', 'title_ar' => 'مراقبة الأداء'],
            ],
            
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

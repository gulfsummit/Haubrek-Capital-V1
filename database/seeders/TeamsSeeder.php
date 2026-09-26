<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teams;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teams::create([
            // Hero Section
            'hero_title_en' => 'BOARD OF DIRECTORS',
            'hero_title_ar' => 'مجلس الإدارة',
            'hero_subtitle_en' => 'Meet the visionary leaders who guide Hauberk Capital towards excellence, bringing decades of global expertise and strategic insight to every investment decision.',
            'hero_subtitle_ar' => 'تعرف على القادة الرؤيويين الذين يوجهون هوبيرك كابيتال نحو التميز، ويجلبون عقود من الخبرة العالمية والرؤية الاستراتيجية لكل قرار استثماري.',
            'hero_desktop_image' => null,
            'hero_mobile_image' => null,
            'hero_button_text_en' => 'REQUEST A MEETING',
            'hero_button_text_ar' => 'طلب اجتماع',
            'hero_button_link' => '#contact',

            // Leadership Section
            'leadership_background_image' => null,
            'leadership_mobile_background_image' => null,

            // Directors Section
            'directors_section_title_en' => 'VISIONARY LEADERSHIP, LASTING IMPACT',
            'directors_section_title_ar' => 'قيادة رؤيوية، تأثير دائم',
            'directors_section_description_en' => 'At Hauberk Capital, our Board of Directors brings unparalleled global expertise in investment and wealth management. With strategic foresight and governance excellence, they drive sustainable growth, ensuring strong risk management and long-term value for all stakeholders.',
            'directors_section_description_ar' => 'في هوبيرك كابيتال، يجلب مجلس إدارتنا خبرة عالمية لا مثيل لها في الاستثمار وإدارة الثروات. مع البصيرة الاستراتيجية والتميز في الحوكمة، يقودون النمو المستدام، ويضمنون إدارة قوية للمخاطر والقيمة طويلة المدى لجميع أصحاب المصلحة.',

            // Directors Popup Content
            'directors_popup_experience_title_en' => 'Experience',
            'directors_popup_experience_title_ar' => 'الخبرة',
            'directors_popup_current_title_en' => 'Current',
            'directors_popup_current_title_ar' => 'الحالي',
            'directors_popup_previous_title_en' => 'Previous Roles',
            'directors_popup_previous_title_ar' => 'المناصب السابقة',
            'directors_popup_education_title_en' => 'Education',
            'directors_popup_education_title_ar' => 'التعليم',

            // Directors
            'directors' => [
                [
                    'name_en' => 'Wael Fawzi',
                    'name_ar' => 'وائل فوزي',
                    'position_en' => 'Managing Director & CEO',
                    'position_ar' => 'المدير التنفيذي والرئيس التنفيذي',
                    'image' => null,
                    'popup_image' => null,
                    'experience' => [
                        ['item' => '25+ years in global financial markets'],
                        ['item' => 'Former Head of Investment Banking at major regional bank'],
                        ['item' => 'Expert in family office structuring and governance'],
                        ['item' => 'Specialized in cross-border investment strategies']
                    ],
                    'current' => [
                        ['item' => 'Managing Director & CEO at Hauberk Capital'],
                        ['item' => 'Board Member of multiple family offices'],
                        ['item' => 'Advisor to sovereign wealth funds'],
                        ['item' => 'Member of MENA Investment Council']
                    ],
                    'previous_roles' => [
                        ['item' => 'Head of Investment Banking - Regional Bank'],
                        ['item' => 'Managing Director - Private Equity Firm'],
                        ['item' => 'Senior Advisor - International Investment House'],
                        ['item' => 'Board Member - Technology Startups']
                    ],
                    'education' => [
                        ['item' => 'MBA - Harvard Business School'],
                        ['item' => 'Bachelor of Finance - American University of Beirut'],
                        ['item' => 'Chartered Financial Analyst (CFA)'],
                        ['item' => 'Certified Private Wealth Advisor (CPWA)']
                    ],
                    'bio' => 'Wael Fawzi is a visionary leader with over 25 years of experience in global financial markets. As the founder and CEO of Hauberk Capital, he has built the firm into a premier wealth advisory platform serving high-net-worth individuals and family offices across the MENA region. His expertise spans investment banking, private equity, and family office management, with a particular focus on cross-border investment strategies and governance structures.',
                    'bio_ar' => 'وائل فوزي هو قائد رؤيوي يتمتع بأكثر من 25 عاماً من الخبرة في الأسواق المالية العالمية. كمؤسس والرئيس التنفيذي لهوبيرك كابيتال، بنى الشركة لتصبح منصة استشارات ثروات رائدة تخدم الأفراد ذوي الملاءة المالية العالية والمكاتب العائلية في جميع أنحاء منطقة الشرق الأوسط وشمال أفريقيا. تمتد خبرته في الخدمات المصرفية الاستثمارية ورأس المال الخاص وإدارة المكاتب العائلية، مع التركيز بشكل خاص على استراتيجيات الاستثمار عبر الحدود وهياكل الحوكمة.'
                ],
                [
                    'name_en' => 'Natalia Biryukova',
                    'name_ar' => 'ناتاليا بيريوكوفا',
                    'position_en' => 'Director of Investment Strategy',
                    'position_ar' => 'مديرة الاستراتيجية الاستثمارية',
                    'image' => null,
                    'popup_image' => null,
                    'experience' => [
                        ['item' => '20+ years in institutional investment management'],
                        ['item' => 'Former Portfolio Manager at major asset management firm'],
                        ['item' => 'Expert in alternative investments and hedge funds'],
                        ['item' => 'Specialized in risk management and portfolio optimization']
                    ],
                    'current' => [
                        ['item' => 'Director of Investment Strategy at Hauberk Capital'],
                        ['item' => 'Lead Portfolio Manager for institutional clients'],
                        ['item' => 'Member of Investment Committee'],
                        ['item' => 'Advisor to family office investment programs']
                    ],
                    'previous_roles' => [
                        ['item' => 'Senior Portfolio Manager - Global Asset Management'],
                        ['item' => 'Head of Alternative Investments - Investment Bank'],
                        ['item' => 'Risk Manager - Hedge Fund'],
                        ['item' => 'Investment Analyst - Sovereign Wealth Fund']
                    ],
                    'education' => [
                        ['item' => 'Master of Science in Finance - London School of Economics'],
                        ['item' => 'Bachelor of Economics - Moscow State University'],
                        ['item' => 'Chartered Alternative Investment Analyst (CAIA)'],
                        ['item' => 'Financial Risk Manager (FRM)']
                    ],
                    'bio' => 'Natalia Biryukova brings over two decades of institutional investment expertise to Hauberk Capital. As Director of Investment Strategy, she leads the development of sophisticated investment solutions for high-net-worth clients and family offices. Her deep understanding of global markets, alternative investments, and risk management enables her to create robust, diversified portfolios that align with client objectives while managing downside risk.',
                    'bio_ar' => 'تجلب ناتاليا بيريوكوفا أكثر من عقدين من الخبرة الاستثمارية المؤسسية إلى هوبيرك كابيتال. كمديرة للاستراتيجية الاستثمارية، تقود تطوير حلول استثمارية متطورة للعملاء ذوي الملاءة المالية العالية والمكاتب العائلية. فهمها العميق للأسواق العالمية والاستثمارات البديلة وإدارة المخاطر يمكّنها من إنشاء محافظ قوية ومتنوعة تتماشى مع أهداف العملاء مع إدارة مخاطر الانخفاض.'
                ],
                [
                    'name_en' => 'Motesm Aggad',
                    'name_ar' => 'متمم عقد',
                    'position_en' => 'Director of Client Relations',
                    'position_ar' => 'مدير علاقات العملاء',
                    'image' => null,
                    'popup_image' => null,
                    'experience' => [
                        ['item' => '18+ years in private banking and client services'],
                        ['item' => 'Former Relationship Manager at Swiss private bank'],
                        ['item' => 'Expert in family office services and succession planning'],
                        ['item' => 'Specialized in Middle Eastern client relationships']
                    ],
                    'current' => [
                        ['item' => 'Director of Client Relations at Hauberk Capital'],
                        ['item' => 'Lead Relationship Manager for VIP clients'],
                        ['item' => 'Head of Family Office Services'],
                        ['item' => 'Member of Client Advisory Board']
                    ],
                    'previous_roles' => [
                        ['item' => 'Senior Relationship Manager - Swiss Private Bank'],
                        ['item' => 'Head of Middle East Client Services - International Bank'],
                        ['item' => 'Family Office Advisor - Wealth Management Firm'],
                        ['item' => 'Succession Planning Specialist - Advisory Practice']
                    ],
                    'education' => [
                        ['item' => 'Master of Business Administration - INSEAD'],
                        ['item' => 'Bachelor of International Relations - American University'],
                        ['item' => 'Certified Financial Planner (CFP)'],
                        ['item' => 'Family Business Advisor Certification']
                    ],
                    'bio' => 'Motesm Aggad is a distinguished client relations expert with nearly two decades of experience serving high-net-worth individuals and family offices. As Director of Client Relations, he ensures that every client receives personalized attention and bespoke solutions tailored to their unique needs. His deep understanding of Middle Eastern business culture and family dynamics enables him to build lasting relationships and provide exceptional service.',
                    'bio_ar' => 'متمم عقد هو خبير علاقات عملاء متميز يتمتع بما يقرب من عقدين من الخبرة في خدمة الأفراد ذوي الملاءة المالية العالية والمكاتب العائلية. كمدير لعلاقات العملاء، يضمن أن كل عميل يحصل على اهتمام شخصي وحلول مخصصة تناسب احتياجاتهم الفريدة. فهمه العميق لثقافة الأعمال الشرق أوسطية وديناميكيات العائلة يمكّنه من بناء علاقات دائمة وتقديم خدمة استثنائية.'
                ]
            ],

            // Departments Section
            'departments_title_en' => 'HAUBERK DEPARTMENTS',
            'departments_title_ar' => 'أقسام هوبيرك',
            'departments_description_en' => 'Explore the dynamic teams that drive our innovation and expertise, each dedicated to optimizing your wealth advisory experience. Our specialized departments work seamlessly together to provide comprehensive solutions that address every aspect of your financial journey.',
            'departments_description_ar' => 'اكتشف الفرق الديناميكية التي تقود ابتكارنا وخبرتنا، كل منها مكرس لتحسين تجربة استشارات الثروات الخاصة بك. تعمل أقسامنا المتخصصة معاً بسلاسة لتقديم حلول شاملة تعالج كل جانب من رحلتك المالية.',
            'departments_background_image' => null,
            'departments_mobile_background_image' => null,

            // Investment Advisory
            'investment_advisory_title_en' => 'INVESTMENT ADVISORY',
            'investment_advisory_title_ar' => 'الاستشارات الاستثمارية',
            'investment_advisory_description_en' => 'Our Investment Advisory team creates personalized investment strategies that align with your financial goals and risk tolerance. We leverage deep market insights, advanced analytics, and global opportunities to optimize your portfolio performance while maintaining appropriate risk management.',
            'investment_advisory_description_ar' => 'ينشئ فريق الاستشارات الاستثمارية لدينا استراتيجيات استثمارية مخصصة تتماشى مع أهدافك المالية وتحمل المخاطر. نستفيد من الرؤى العميقة للسوق والتحليلات المتقدمة والفرص العالمية لتحسين أداء محفظتك مع الحفاظ على إدارة المخاطر المناسبة.',
            'investment_advisory_image' => null,
            'investment_advisory_link_en' => 'Contact Investment Advisory Team',
            'investment_advisory_link_ar' => 'تواصل مع فريق الاستشارات الاستثمارية',
            'investment_advisory_url' => '#',

            // Financial Planning
            'financial_planning_title_en' => 'FINANCIAL PLANNING',
            'financial_planning_title_ar' => 'التخطيط المالي',
            'financial_planning_description_en' => 'Our Financial Planning experts develop comprehensive wealth management strategies that encompass retirement planning, tax optimization, estate planning, and legacy preservation. We work closely with you to create a roadmap for achieving your long-term financial objectives.',
            'financial_planning_description_ar' => 'يطور خبراء التخطيط المالي لدينا استراتيجيات شاملة لإدارة الثروات تشمل التخطيط للتقاعد وتحسين الضرائب والتخطيط العقاري والحفاظ على الإرث. نعمل معك عن كثب لإنشاء خارطة طريق لتحقيق أهدافك المالية طويلة المدى.',
            'financial_planning_image' => null,
            'financial_planning_link_en' => 'Contact Financial Planning Team',
            'financial_planning_link_ar' => 'تواصل مع فريق التخطيط المالي',
            'financial_planning_url' => '#',

            // Research & Analysis
            'research_analysis_title_en' => 'RESEARCH & ANALYSIS',
            'research_analysis_title_ar' => 'البحث والتحليل',
            'research_analysis_description_en' => 'Our Research & Analysis team provides cutting-edge market intelligence, economic insights, and investment opportunities. Through rigorous analysis and proprietary models, we identify trends and opportunities that give our clients a competitive advantage in global markets.',
            'research_analysis_description_ar' => 'يوفر فريق البحث والتحليل لدينا ذكاء السوق المتقدم والرؤى الاقتصادية والفرص الاستثمارية. من خلال التحليل الدقيق والنماذج الحصرية، نحدد الاتجاهات والفرص التي تمنح عملائنا ميزة تنافسية في الأسواق العالمية.',
            'research_analysis_image' => null,
            'research_analysis_link_en' => 'Contact Research & Analysis Team',
            'research_analysis_link_ar' => 'تواصل مع فريق البحث والتحليل',
            'research_analysis_url' => '#',

            // Client Relations
            'client_relations_title_en' => 'CLIENT RELATIONS',
            'client_relations_title_ar' => 'علاقات العملاء',
            'client_relations_description_en' => 'Our Client Relations team ensures exceptional service delivery and maintains strong relationships with our valued clients. We provide personalized attention, regular portfolio reviews, and proactive communication to keep you informed about your investments and market developments.',
            'client_relations_description_ar' => 'يضمن فريق علاقات العملاء لدينا تقديم خدمة استثنائية والحفاظ على علاقات قوية مع عملائنا القيمين. نقدم اهتماماً شخصياً ومراجعات منتظمة للمحفظة وتواصل استباقي لإبقائك على اطلاع باستثماراتك وتطورات السوق.',
            'client_relations_image' => null,
            'client_relations_link_en' => 'Contact Client Relations Team',
            'client_relations_link_ar' => 'تواصل مع فريق علاقات العملاء',
            'client_relations_url' => '#',

            // Compliance and Legal
            'compliance_legal_title_en' => 'COMPLIANCE AND LEGAL',
            'compliance_legal_title_ar' => 'الامتثال والقانونية',
            'compliance_legal_description_en' => 'Our Compliance and Legal team ensures that all our operations adhere to regulatory requirements and best practices. We maintain the highest standards of integrity, transparency, and regulatory compliance to protect our clients and maintain our reputation in the financial industry.',
            'compliance_legal_description_ar' => 'يضمن فريق الامتثال والقانونية لدينا أن جميع عملياتنا تلتزم بالمتطلبات التنظيمية وأفضل الممارسات. نحافظ على أعلى معايير النزاهة والشفافية والامتثال التنظيمي لحماية عملائنا والحفاظ على سمعتنا في الصناعة المالية.',
            'compliance_legal_image' => null,
            'compliance_legal_link_en' => 'Contact Compliance & Legal Team',
            'compliance_legal_link_ar' => 'تواصل مع فريق الامتثال والقانونية',
            'compliance_legal_url' => '#',

            // Operations & Administration
            'operations_admin_title_en' => 'OPERATIONS & ADMINISTRATION',
            'operations_admin_title_ar' => 'العمليات والإدارة',
            'operations_admin_description_en' => 'Our Operations & Administration team provides the infrastructure and support services that enable our advisory teams to deliver exceptional results. From technology systems to operational processes, we ensure seamless service delivery and maintain the highest standards of operational excellence.',
            'operations_admin_description_ar' => 'يوفر فريق العمليات والإدارة لدينا البنية التحتية وخدمات الدعم التي تمكن فرق الاستشارات لدينا من تقديم نتائج استثنائية. من الأنظمة التقنية إلى العمليات التشغيلية، نضمن تقديم خدمة سلسة والحفاظ على أعلى معايير التميز التشغيلي.',
            'operations_admin_image' => null,
            'operations_admin_link_en' => 'Contact Operations & Administration Team',
            'operations_admin_link_ar' => 'تواصل مع فريق العمليات والإدارة',
            'operations_admin_url' => '#'
        ]);
    }
}

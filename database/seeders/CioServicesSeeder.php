<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CioServices;

class CioServicesSeeder extends Seeder
{
    public function run(): void
    {
        CioServices::truncate();

        CioServices::create([
            // Hero Section
            'hero_desktop_image' => 'images/cio-innerpage-bg.png',
            'hero_mobile_image' => 'images/services-mob.png',
            'hero_title_en' => 'CIO OFFICE SERVICES',
            'hero_title_ar' => null,
            'hero_subtitle_en' => 'Empowering Your Wealth, Elevating Your Future with our Strategic Investment Advisory Services',
            'hero_subtitle_ar' => null,
            'hero_button_text_en' => 'REQUEST A MEETING',
            'hero_button_text_ar' => null,
            'hero_button_url' => '#',

            // Services Overview Section
            'overview_title_en' => 'CIO Office Services',
            'overview_title_ar' => null,
            'overview_description_en' => 'At Hauberk Capital, we offer tailored CIO Office Services for High-Net-Worth Individuals, Family Offices, and Endowments, providing comprehensive investment advisory solutions. Our services include relationship management, asset allocation monitoring, manager oversight, compliance, reporting, and performance evaluation. We also handle investment banking transactions, manage global banking relationships, and provide market insights. By leveraging our expertise, you gain a dedicated team committed to optimizing your investment performance and achieving your financial objectives through strategic and customized solutions.',
            'overview_description_ar' => null,
            'overview_items' => [
                [
                    'title_en' => 'DAY TO DAY RELATIONSHIP',
                    'title_ar' => null,
                    'description_en' => 'Setup up a new investment and legal structure or strengthen an existing one for protecting and governing the current wealth.',
                    'description_ar' => null,
                ],
                [
                    'title_en' => 'RECOMMEND ASSET ALLOCATION',
                    'title_ar' => null,
                    'description_en' => 'Setup of Endowments and foundation deeds. Design the investment office and Endowment fund organization structure.',
                    'description_ar' => null,
                ],
                [
                    'title_en' => 'FAMILY OFFICE SETUP',
                    'title_ar' => null,
                    'description_en' => 'Comprehensive family office establishment including governance frameworks, operational structures, and succession planning protocols.',
                    'description_ar' => null,
                ],
                [
                    'title_en' => 'WEALTH TRANSFER PLANNING',
                    'title_ar' => null,
                    'description_en' => 'Strategic planning for intergenerational wealth transfer with focus on tax efficiency, legal compliance, and preservation of family values.',
                    'description_ar' => null,
                ],
                [
                    'title_en' => 'GOVERNANCE AUDITS',
                    'title_ar' => null,
                    'description_en' => 'Comprehensive assessment of existing governance structures with actionable recommendations for optimization and risk mitigation.',
                    'description_ar' => null,
                ],
                [
                    'title_en' => 'REGULATORY COMPLIANCE',
                    'title_ar' => null,
                    'description_en' => 'Expert guidance on navigating complex regulatory environments across multiple jurisdictions to ensure full compliance and risk management.',
                    'description_ar' => null,
                ],
            ],

            // Approach Section
            'approach_background_image' => 'images/approach-bg.png',
            'approach_title_en' => 'CIO OFFICE APPROACH',
            'approach_title_ar' => null,
            'approach_description_en' => "Hauberk Capital's CIO Office Services provide a comprehensive outsourcing solution for High-Net-Worth Individuals (HNWIs), Family Offices, and Endowments, encompassing all aspects of managing an investment office.",
            'approach_description_ar' => null,
            'approach_items' => [
                [
                    'title_en' => "Hauberk's 12-Step Systematic Approach",
                    'title_ar' => null,
                    'description_en' => "Hauberk Capital's CIO Office Services offer a meticulously designed 12-step approach to investment management. This comprehensive program starts by understanding your unique financial goals and crafting a personalized strategy. Hauberk then takes care of day-to-day operations, facilitates communication between your team and investment managers, and continuously monitors your portfolio for optimal performance. They provide insightful reports, support your investment committee, and proactively seek ways to improve your investment program. Additionally, they can manage complex financial transactions and ensure adherence to regulations, all while offering expert recommendations on asset allocation and manager selection.",
                    'description_ar' => null,
                    'is_expanded' => true,
                ],
                [
                    'title_en' => 'Addressing the Gap in Digital Leadership',
                    'title_ar' => null,
                    'description_en' => 'Hauberk Capital addresses the critical gap in digital leadership by providing expert guidance in navigating the increasingly complex digital investment landscape. Our team combines traditional financial expertise with cutting-edge technological understanding to help clients leverage digital tools, platforms, and strategies for optimal investment outcomes.',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Delivering Strategic Digital Transformation',
                    'title_ar' => null,
                    'description_en' => 'Our research spans across all major asset classes, sectors, and global markets to ensure we capture the full spectrum of investment opportunities.',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Benefits of Hauberk CIO Office Services',
                    'title_ar' => null,
                    'description_en' => 'Our expert committee conducts rigorous evaluations of investment managers, assessing their strategies, performance, risk management, and alignment with client objectives.',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
            ],

            // Steps Section
            'steps_title_en' => 'STEPS TO START',
            'steps_title_ar' => null,
            'steps_subtitle_en' => 'Your Wealth Governance',
            'steps_subtitle_ar' => null,
            'steps_items' => [
                [
                    'title_en' => 'INITIAL CONSULTATION',
                    'title_ar' => null,
                ],
                [
                    'title_en' => 'DEVELOPMENT OF CUSTOMIZED INVESTMENT STRATEGY',
                    'title_ar' => null,
                ],
                [
                    'title_en' => 'DAY-TO-DAY RELATIONSHIP MANAGEMENT',
                    'title_ar' => null,
                ],
                [
                    'title_en' => 'GOAL SETTING AND OBJECTIVE DEFINITION',
                    'title_ar' => null,
                ],
            ],

            // Why Choose Us Section
            'why_choose_title_en' => 'WHY CHOOSE US',
            'why_choose_title_ar' => null,
            'why_choose_items' => [
                [
                    'image' => 'images/wcu-1.png',
                    'title_en' => 'EXPERT ADVISORS',
                    'title_ar' => null,
                    'description_en' => 'Our team comprises seasoned professionals with extensive experience in wealth management, legal advisory, and family governance.',
                    'description_ar' => null,
                ],
                [
                    'image' => 'images/wcu-2.png',
                    'title_en' => 'HOLISTIC APPROACH',
                    'title_ar' => null,
                    'description_en' => 'Our integrated approach considers all aspects of wealth governance, from financial advisory to legal compliance and family dynamics.',
                    'description_ar' => null,
                ],
                [
                    'image' => 'images/wcu-3.png',
                    'title_en' => 'TAILORED SOLUTIONS',
                    'title_ar' => null,
                    'description_en' => 'We understand that every client is unique, and we tailor our services to meet your specific needs and goals with highest standards of ethics & transparency.',
                    'description_ar' => null,
                ],
            ],

            // CTA Section
            'cta_title_en' => 'READY TO START GROWING?!',
            'cta_title_ar' => null,
            'cta_description_en' => 'Unlock the full potential of your wealth',
            'cta_description_ar' => null,
            'cta_button_1_text_en' => 'JOIN OUR MAILING LIST',
            'cta_button_1_text_ar' => null,
            'cta_button_1_url' => 'contact-us.html',
            'cta_button_2_text_en' => 'REQUEST A MEETING',
            'cta_button_2_text_ar' => null,
            'cta_button_2_url' => 'request-a-meeting.html',
            'cta_background_image' => 'images/meeting-bg.png',
        ]);
    }
}
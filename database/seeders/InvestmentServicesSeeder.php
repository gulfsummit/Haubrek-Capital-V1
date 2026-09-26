<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InvestmentServices;

class InvestmentServicesSeeder extends Seeder
{
    public function run(): void
    {
        InvestmentServices::truncate();

        InvestmentServices::create([
            // Hero Section
            'hero_desktop_image' => 'images/investment-innerpage-bg.png',
            'hero_mobile_image' => 'images/services-mob.png',
            'hero_title_en' => 'INVESTMENT MANAGERS SEARCH & SELECTION SERVICES',
            'hero_title_ar' => null,
            'hero_subtitle_en' => 'Empowering Your Wealth, Elevating Your Future with our Strategic Investment Advisory Services',
            'hero_subtitle_ar' => null,
            'hero_button_text_en' => 'REQUEST A MEETING',
            'hero_button_text_ar' => null,
            'hero_button_url' => '#',

            // Services Overview Section
            'overview_title_en' => 'Investment Managers Search',
            'overview_title_ar' => null,
            'overview_description_en' => "Hauberk's Investment Managers Search and Selection services cater to institutional investors, high net worth individuals, and financial advisors by facilitating the identification and selection of optimal investment managers aligned with their specific financial goals.",
            'overview_description_ar' => null,
            'overview_items' => [
                [
                    'title_en' => 'IDENTIFYING INVESTMENT',
                    'title_ar' => null,
                    'description_en' => 'Setup up a new investment and legal structure or strengthen an existing one for protecting and governing the current wealth.',
                    'description_ar' => null,
                ],
                [
                    'title_en' => 'ASSIST WITH SHORT LISTING',
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
            'approach_title_en' => 'MANAGER SELECTION APPROACH',
            'approach_title_ar' => null,
            'approach_description_en' => "Hauberk Capital's approach to selecting investment managers is rooted in a meticulous process tailored to meet client investment policy statements and asset class objectives. We focus on identifying managers capable of efficiently managing strategies within a reasonable cost structure, ensuring optimal alignment with client goals.",
            'approach_description_ar' => null,
            'approach_items' => [
                [
                    'title_en' => 'Customized Approach',
                    'title_ar' => null,
                    'description_en' => 'Our experts perform a meticulous review of your current financial status to identify strengths, weaknesses, opportunities, and threats.',
                    'description_ar' => null,
                    'is_expanded' => true,
                ],
                [
                    'title_en' => 'Proprietary Database and Research',
                    'title_ar' => null,
                    'description_en' => 'We maintain an extensive proprietary database of investment opportunities and conduct original research to identify unique opportunities and potential risks.',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Comprehensive Coverage',
                    'title_ar' => null,
                    'description_en' => 'Our research spans across all major asset classes, sectors, and global markets to ensure we capture the full spectrum of investment opportunities.',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Manager Review Committee (MARC)',
                    'title_ar' => null,
                    'description_en' => 'Our expert committee conducts rigorous evaluations of investment managers, assessing their strategies, performance, risk management, and alignment with client objectives.',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Qualitative & Quantitative Evaluation',
                    'title_ar' => null,
                    'description_en' => 'We combine qualitative assessments of investment thesis and management with sophisticated quantitative analysis of performance metrics and risk characteristics.',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Ongoing Due Diligence and Monitoring',
                    'title_ar' => null,
                    'description_en' => 'We maintain continuous oversight of all investments, conducting regular reviews and updates to ensure continued alignment with client objectives and market conditions.',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Promotion of Fair Competition',
                    'title_ar' => null,
                    'description_en' => 'We maintain an open architecture approach that ensures unbiased selection of investment opportunities based solely on merit and client suitability.',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Conflict-Free Advice',
                    'title_ar' => null,
                    'description_en' => 'We operate with complete independence, providing recommendations free from conflicts of interest, ensuring our clients\' needs always come first.',
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
                    'title_en' => 'FIDUCIARY DUTY',
                    'title_ar' => null,
                ],
                [
                    'title_en' => 'TRANSPARENCY',
                    'title_ar' => null,
                ],
                [
                    'title_en' => 'COMMUNICATION',
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
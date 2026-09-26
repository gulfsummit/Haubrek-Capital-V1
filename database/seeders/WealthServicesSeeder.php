<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WealthServices;

class WealthServicesSeeder extends Seeder
{
    public function run(): void
    {
        WealthServices::truncate();

        WealthServices::create([
            // Hero Section
            'hero_desktop_image' => 'images/wealth-innerpage-bg.png',
            'hero_mobile_image' => 'images/mobile-wealth-innerpage-bg.png',
            'hero_title_en' => 'WEALTH PLANNING SERVICES',
            'hero_title_ar' => null,
            'hero_subtitle_en' => 'Secure Your Future with Expert Financial Guidance',
            'hero_subtitle_ar' => null,
            'hero_button_text_en' => 'REQUEST A MEETING',
            'hero_button_text_ar' => null,
            'hero_button_url' => '#',

            // Services Overview Section
            'overview_title_en' => 'WEALTH PLANNING SERVICES',
            'overview_title_ar' => null,
            'overview_description_en' => 'At Hauberk Capital, we understand that your financial journey is unique. Our Wealth Planning Services are designed to provide you with personalized and comprehensive financial strategies to secure your future and achieve your goals. With our expert advisors by your side, you can navigate the complexities of wealth management with confidence.',
            'overview_description_ar' => null,
            'overview_items' => [
                [
                    'title_en' => 'EVALUATION OF OVERALL',
                    'title_ar' => null,
                    'description_en' => 'Setup up a new investment and legal structure or strengthen an existing one for protecting and governing the current wealth.',
                    'description_ar' => null,
                ],
                [
                    'title_en' => 'DEVELOPMENT OF INVESTMENT',
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
            'approach_title_en' => 'INVESTMENT ANALYSIS',
            'approach_title_ar' => null,
            'approach_description_en' => 'Our experts perform a meticulous review of your current financial status to identify strengths, weaknesses, opportunities, and gaps in your investment portfolio. We use data-driven analysis to make informed decisions and develop strategies tailored to your unique situation.',
            'approach_description_ar' => null,
            'approach_items' => [
                [
                    'title_en' => 'Detailed Current Situation Analysis',
                    'title_ar' => null,
                    'description_en' => 'Our experts perform a meticulous review of your current financial status to identify strengths, weaknesses, opportunities, and gaps in your investment portfolio. - Comprehensive assessment of your entire financial landscape - Identification of potential risks and inefficiencies - Analysis of current performance against benchmarks',
                    'description_ar' => null,
                    'is_expanded' => true,
                ],
                [
                    'title_en' => 'Clear Investment Objectives and Philosophy',
                    'title_ar' => null,
                    'description_en' => 'We help you define clear, measurable investment objectives and develop a coherent investment philosophy aligned with your values and goals. - Creation of personalized investment statements - Alignment of investment activities with personal values - Establishment of realistic, time-bound financial goals',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Risk Profile and Investment Horizon Assessment',
                    'title_ar' => null,
                    'description_en' => 'We conduct a thorough assessment of your risk tolerance, capacity, and time horizon to ensure your investment strategy matches your comfort level and life stage. - Sophisticated risk profiling tools and methodologies - Time horizon mapping for different financial goals - Regular reassessment as life circumstances change',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Strategic Asset Allocation',
                    'title_ar' => null,
                    'description_en' => 'We develop a strategic asset allocation tailored to your risk profile, investment objectives, and market outlook. - Diversification across asset classes, sectors, and geographies - Optimization for risk-adjusted returns - Tactical adjustments based on market conditions',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Customized Investment Policy Statement',
                    'title_ar' => null,
                    'description_en' => 'We create a comprehensive investment policy statement that serves as a roadmap for your investment decisions and portfolio management. - Clear guidelines for investment selection and portfolio construction - Defined roles and responsibilities - Benchmarks and performance evaluation criteria',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Ongoing Business and Portfolio Analysis',
                    'title_ar' => null,
                    'description_en' => 'We provide continuous monitoring and analysis of your investments, making adjustments as market conditions and your personal circumstances evolve. - Regular performance reviews and reporting - Proactive identification of opportunities and risks - Adjustment recommendations based on changing conditions',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Prudent Diversification Recommendations',
                    'title_ar' => null,
                    'description_en' => 'We develop diversification strategies that spread risk across different asset classes, sectors, geographies, and investment styles. - Advanced portfolio construction techniques - Correlation analysis to minimize overall portfolio risk - Alternative investment considerations for further diversification',
                    'description_ar' => null,
                    'is_expanded' => false,
                ],
                [
                    'title_en' => 'Sustainable Wealth Growth Plans',
                    'title_ar' => null,
                    'description_en' => 'We create long-term wealth growth plans focused on sustainability and consistent returns over market cycles. - Strategies for different life stages and goals - Tax-efficient investment approaches - Wealth preservation and transfer considerations',
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
                    'title_en' => 'COMPREHENSIVE FINANCIAL EVALUATION',
                    'title_ar' => null,
                ],
                [
                    'title_en' => 'GOAL SETTING AND OBJECTIVE DEFINITION',
                    'title_ar' => null,
                ],
                [
                    'title_en' => 'ONGOING MONITORING AND OPTIMIZATION',
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
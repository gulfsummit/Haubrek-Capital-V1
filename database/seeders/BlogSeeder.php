<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title_en' => 'Strategic Investment Planning for High-Net-Worth Individuals',
                'title_ar' => 'التخطيط الاستثماري الاستراتيجي للأفراد ذوي الثروات العالية',
                'description_en' => 'Discover how strategic investment planning can help high-net-worth individuals maximize their wealth while managing risk effectively.',
                'description_ar' => 'اكتشف كيف يمكن للتخطيط الاستثماري الاستراتيجي أن يساعد الأفراد ذوي الثروات العالية على تعظيم ثرواتهم مع إدارة المخاطر بفعالية.',
                'content_en' => '<h2>Understanding Strategic Investment Planning</h2><p>Strategic investment planning is a comprehensive approach to wealth management that goes beyond simple portfolio diversification. It involves creating a long-term roadmap that aligns with your financial goals, risk tolerance, and life circumstances.</p><h3>Key Components of Strategic Investment Planning</h3><ul><li><strong>Asset Allocation:</strong> Determining the optimal mix of asset classes based on your risk profile and investment horizon.</li><li><strong>Risk Management:</strong> Implementing strategies to protect your wealth from market volatility and unexpected events.</li><li><strong>Tax Optimization:</strong> Structuring investments to minimize tax liabilities while maximizing after-tax returns.</li><li><strong>Estate Planning:</strong> Ensuring your wealth is transferred efficiently to future generations.</li></ul><p>Our team of experienced advisors works closely with high-net-worth individuals to develop customized investment strategies that address their unique needs and objectives.</p>',
                'content_ar' => '<h2>فهم التخطيط الاستثماري الاستراتيجي</h2><p>التخطيط الاستثماري الاستراتيجي هو نهج شامل لإدارة الثروات يتجاوز التنويع البسيط للمحفظة. يتضمن إنشاء خارطة طريق طويلة المدى تتماشى مع أهدافك المالية وتحمل المخاطر وظروف حياتك.</p>',
                'category' => 'articles',
                'slug' => 'strategic-investment-planning-high-net-worth',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title_en' => 'Market Analysis: Q4 2024 Economic Outlook',
                'title_ar' => 'تحليل السوق: التوقعات الاقتصادية للربع الرابع 2024',
                'description_en' => 'Our latest market analysis provides insights into the economic outlook for Q4 2024 and its implications for investment strategies.',
                'description_ar' => 'تحليلنا الأخير للسوق يقدم رؤى حول التوقعات الاقتصادية للربع الرابع 2024 وتأثيراتها على الاستراتيجيات الاستثمارية.',
                'content_en' => '<h2>Q4 2024 Economic Outlook</h2><p>As we enter the final quarter of 2024, several key economic indicators suggest continued growth with some areas of concern that investors should monitor closely.</p><h3>Key Economic Indicators</h3><ul><li><strong>GDP Growth:</strong> Projected to remain positive but moderate compared to previous quarters.</li><li><strong>Inflation:</strong> Expected to stabilize within target ranges for most developed economies.</li><li><strong>Interest Rates:</strong> Central banks likely to maintain current policies with potential for gradual adjustments.</li><li><strong>Employment:</strong> Labor markets showing resilience with continued job creation.</li></ul><h3>Investment Implications</h3><p>Based on our analysis, we recommend a balanced approach to portfolio allocation with emphasis on quality assets and defensive positioning in certain sectors.</p>',
                'content_ar' => '<h2>التوقعات الاقتصادية للربع الرابع 2024</h2><p>مع دخولنا الربع الأخير من عام 2024، تشير عدة مؤشرات اقتصادية رئيسية إلى استمرار النمو مع بعض المجالات التي تستدعي القلق والتي يجب على المستثمرين مراقبتها عن كثب.</p>',
                'category' => 'news',
                'slug' => 'market-analysis-q4-2024-economic-outlook',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title_en' => 'Wealth Preservation Strategies in Volatile Markets',
                'title_ar' => 'استراتيجيات الحفاظ على الثروة في الأسواق المتقلبة',
                'description_en' => 'Learn effective wealth preservation strategies that can help protect your assets during periods of market volatility and economic uncertainty.',
                'description_ar' => 'تعلم استراتيجيات الحفاظ على الثروة الفعالة التي يمكن أن تساعد في حماية أصولك خلال فترات تقلبات السوق وعدم اليقين الاقتصادي.',
                'content_en' => '<h2>Understanding Market Volatility</h2><p>Market volatility is an inherent part of investing, but with the right strategies, you can protect and even grow your wealth during uncertain times.</p><h3>Core Wealth Preservation Strategies</h3><ul><li><strong>Diversification:</strong> Spreading investments across different asset classes, sectors, and geographic regions.</li><li><strong>Quality Assets:</strong> Focusing on high-quality, fundamentally sound investments with strong balance sheets.</li><li><strong>Defensive Positioning:</strong> Allocating a portion of your portfolio to defensive assets like bonds and dividend-paying stocks.</li><li><strong>Regular Rebalancing:</strong> Adjusting your portfolio allocation to maintain your target risk profile.</li></ul><h3>Advanced Strategies</h3><p>For sophisticated investors, we also recommend considering alternative investments, hedging strategies, and structured products that can provide additional protection during market downturns.</p>',
                'content_ar' => '<h2>فهم تقلبات السوق</h2><p>تقلبات السوق هي جزء متأصل من الاستثمار، ولكن بالاستراتيجيات الصحيحة، يمكنك حماية وحتى نمو ثروتك خلال الأوقات غير المؤكدة.</p>',
                'category' => 'articles',
                'slug' => 'wealth-preservation-strategies-volatile-markets',
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title_en' => 'New Regulatory Changes Impacting Investment Management',
                'title_ar' => 'التغييرات التنظيمية الجديدة المؤثرة على إدارة الاستثمارات',
                'description_en' => 'Stay informed about the latest regulatory changes that could impact your investment management strategies and portfolio performance.',
                'description_ar' => 'ابق على اطلاع بأحدث التغييرات التنظيمية التي قد تؤثر على استراتيجيات إدارة الاستثمارات وأداء المحفظة.',
                'content_en' => '<h2>Recent Regulatory Updates</h2><p>The investment management landscape continues to evolve with new regulations designed to enhance transparency, protect investors, and promote market stability.</p><h3>Key Regulatory Changes</h3><ul><li><strong>Enhanced Disclosure Requirements:</strong> New rules requiring more detailed reporting on investment strategies and risk factors.</li><li><strong>ESG Integration:</strong> Mandatory consideration of environmental, social, and governance factors in investment decisions.</li><li><strong>Technology Compliance:</strong> Updated requirements for digital platforms and automated investment services.</li><li><strong>Cross-Border Regulations:</strong> Harmonized standards for international investment activities.</li></ul><h3>Impact on Investors</h3><p>These regulatory changes are generally positive for investors, providing greater transparency and protection while ensuring that investment managers maintain high standards of conduct.</p>',
                'content_ar' => '<h2>التحديثات التنظيمية الأخيرة</h2><p>مشهد إدارة الاستثمارات يستمر في التطور مع لوائح جديدة مصممة لتعزيز الشفافية وحماية المستثمرين وتعزيز استقرار السوق.</p>',
                'category' => 'news',
                'slug' => 'regulatory-changes-investment-management',
                'is_published' => true,
                'sort_order' => 4,
            ],
            [
                'title_en' => 'Estate Planning: Protecting Your Legacy',
                'title_ar' => 'تخطيط التركة: حماية إرثك',
                'description_en' => 'Comprehensive guide to estate planning strategies that ensure your wealth is preserved and transferred according to your wishes.',
                'description_ar' => 'دليل شامل لاستراتيجيات تخطيط التركة التي تضمن الحفاظ على ثروتك ونقلها وفقاً لرغباتك.',
                'content_en' => '<h2>The Importance of Estate Planning</h2><p>Estate planning is not just for the wealthy—it\'s a crucial process that ensures your assets are distributed according to your wishes while minimizing taxes and legal complications.</p><h3>Essential Estate Planning Components</h3><ul><li><strong>Will and Testament:</strong> The foundation of any estate plan, clearly stating your wishes for asset distribution.</li><li><strong>Trusts:</strong> Flexible tools that can provide tax benefits and control over asset distribution.</li><li><strong>Power of Attorney:</strong> Legal documents that allow trusted individuals to make decisions on your behalf.</li><li><strong>Healthcare Directives:</strong> Instructions for medical care and end-of-life decisions.</li></ul><h3>Advanced Strategies</h3><p>For high-net-worth individuals, advanced strategies such as family limited partnerships, charitable remainder trusts, and generation-skipping trusts can provide additional benefits and flexibility.</p>',
                'content_ar' => '<h2>أهمية تخطيط التركة</h2><p>تخطيط التركة ليس فقط للأثرياء—إنه عملية حاسمة تضمن توزيع أصولك وفقاً لرغباتك مع تقليل الضرائب والمشاكل القانونية.</p>',
                'category' => 'articles',
                'slug' => 'estate-planning-protecting-legacy',
                'is_published' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($blogs as $blogData) {
            Blog::create($blogData);
        }
    }
}
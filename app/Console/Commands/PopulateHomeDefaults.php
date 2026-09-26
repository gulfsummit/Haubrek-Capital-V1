<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Home;

class PopulateHomeDefaults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'home:populate-defaults';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the Home record with default content';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Populating Home record with default content...');

        $home = Home::first();
        
        if (!$home) {
            $this->error('No Home record found. Please create one first.');
            return 1;
        }

        // Default services
        $defaultServices = [
            [
                'title_en' => 'Governance Advisory',
                'title_ar' => 'الاستشارات الحوكمية',
                'description_en' => 'Comprehensive governance advisory services to help organizations establish effective governance frameworks and policies.',
                'description_ar' => 'خدمات استشارية شاملة في مجال الحوكمة لمساعدة المنظمات على إنشاء أطر وسياسات حوكمة فعالة.',
                'link' => 'governance-services',
                'image' => null,
            ],
            [
                'title_en' => 'Wealth Planning',
                'title_ar' => 'تخطيط الثروة',
                'description_en' => 'Strategic wealth planning services designed to help clients achieve their long-term financial goals and objectives.',
                'description_ar' => 'خدمات تخطيط الثروة الاستراتيجية المصممة لمساعدة العملاء على تحقيق أهدافهم المالية طويلة المدى.',
                'link' => 'wealth-services',
                'image' => null,
            ],
            [
                'title_en' => 'Strategic Investment Advisory',
                'title_ar' => 'الاستشارات الاستثمارية الاستراتيجية',
                'description_en' => 'Expert investment advisory services providing strategic guidance for optimal portfolio management and growth.',
                'description_ar' => 'خدمات استشارية استثمارية متخصصة تقدم التوجيه الاستراتيجي لإدارة المحافظ المثلى والنمو.',
                'link' => 'investment-services',
                'image' => null,
            ],
            [
                'title_en' => 'CIO Office Services',
                'title_ar' => 'خدمات مكتب المدير التنفيذي للاستثمار',
                'description_en' => 'Comprehensive CIO office services including investment oversight, risk management, and strategic planning.',
                'description_ar' => 'خدمات شاملة لمكتب المدير التنفيذي للاستثمار تشمل الإشراف على الاستثمار وإدارة المخاطر والتخطيط الاستراتيجي.',
                'link' => 'cio-services',
                'image' => null,
            ],
        ];

        // Default directors
        $defaultDirectors = [
            [
                'name_en' => 'Wael Fawzi',
                'name_ar' => 'وائل فوزي',
                'position_en' => 'Managing Director',
                'position_ar' => 'المدير التنفيذي',
                'image' => null,
            ],
            [
                'name_en' => 'Natalia Biryukova',
                'name_ar' => 'ناتاليا بيريوكوفا',
                'position_en' => 'Director',
                'position_ar' => 'مدير',
                'image' => null,
            ],
            [
                'name_en' => 'Motesm Aggad',
                'name_ar' => 'متمم عقد',
                'position_en' => 'Director',
                'position_ar' => 'مدير',
                'image' => null,
            ],
        ];

        // Default roadmap steps
        $defaultRoadmapSteps = [
            [
                'step_en' => 'Strategic Decision',
                'step_ar' => 'قرار استراتيجي',
                'description_en' => 'Strategic decision making process',
                'description_ar' => 'عملية اتخاذ القرارات الاستراتيجية',
                'icon' => null,
            ],
            [
                'step_en' => 'Governance',
                'step_ar' => 'الحوكمة',
                'description_en' => 'Governance structure and policies',
                'description_ar' => 'هيكل وسياسات الحوكمة',
                'icon' => null,
            ],
            [
                'step_en' => 'Current portfolio analysis',
                'step_ar' => 'تحليل المحفظة الحالية',
                'description_en' => 'Analysis of current investment portfolio',
                'description_ar' => 'تحليل محفظة الاستثمار الحالية',
                'icon' => null,
            ],
            [
                'step_en' => 'Investment Policy Statement',
                'step_ar' => 'بيان سياسة الاستثمار',
                'description_en' => 'Investment policy and guidelines',
                'description_ar' => 'سياسة ومبادئ الاستثمار',
                'icon' => null,
            ],
            [
                'step_en' => 'Investment Implementation',
                'step_ar' => 'تنفيذ الاستثمار',
                'description_en' => 'Implementation of investment strategy',
                'description_ar' => 'تنفيذ استراتيجية الاستثمار',
                'icon' => null,
            ],
            [
                'step_en' => 'Investment Structure',
                'step_ar' => 'هيكل الاستثمار',
                'description_en' => 'Investment structure and framework',
                'description_ar' => 'هيكل وإطار الاستثمار',
                'icon' => null,
            ],
            [
                'step_en' => 'Managers Search & Selection',
                'step_ar' => 'البحث عن المديرين والاختيار',
                'description_en' => 'Search and selection of investment managers',
                'description_ar' => 'البحث عن مديري الاستثمار واختيارهم',
                'icon' => null,
            ],
            [
                'step_en' => 'Monitoring Performance',
                'step_ar' => 'مراقبة الأداء',
                'description_en' => 'Performance monitoring and reporting',
                'description_ar' => 'مراقبة الأداء والتقرير',
                'icon' => null,
            ],
        ];

        // Update the home record
        $home->update([
            'services' => $defaultServices,
            'directors' => $defaultDirectors,
            'roadmap_steps' => $defaultRoadmapSteps,
        ]);

        $this->info('✅ Home record updated successfully!');
        $this->info('📊 Services: ' . count($defaultServices) . ' items');
        $this->info('👥 Directors: ' . count($defaultDirectors) . ' items');
        $this->info('🗺️ Roadmap Steps: ' . count($defaultRoadmapSteps) . ' items');

        return 0;
    }
}
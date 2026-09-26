<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ToolsFormField;

class ToolsFormFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            // Contact Information Fields (First Column)
            [
                'label_en' => 'Name',
                'label_ar' => 'الاسم',
                'field_name' => 'name',
                'field_type' => 'text',
                'placeholder_en' => 'Your name',
                'placeholder_ar' => 'اسمك',
                'is_required' => true,
                'order' => 1,
            ],
            [
                'label_en' => 'Email',
                'label_ar' => 'البريد الإلكتروني',
                'field_name' => 'email',
                'field_type' => 'email',
                'placeholder_en' => 'example@company.com',
                'placeholder_ar' => 'example@company.com',
                'is_required' => true,
                'order' => 2,
            ],
            [
                'label_en' => 'Phone Number',
                'label_ar' => 'رقم الهاتف',
                'field_name' => 'phone',
                'field_type' => 'tel',
                'placeholder_en' => '+11 000 000 000',
                'placeholder_ar' => '+11 000 000 000',
                'is_required' => true,
                'order' => 3,
            ],
            
            // Investment Questions (First Column)
            [
                'label_en' => 'What percentage of your total assets are you willing to invest in higher-risk investments?',
                'label_ar' => 'ما النسبة المئوية من إجمالي أصولك التي ترغب في استثمارها في استثمارات عالية المخاطر؟',
                'field_name' => 'percentage',
                'field_type' => 'radio',
                'options_en' => [
                    ['value' => 'Less than 25%'],
                    ['value' => '25-50%'],
                    ['value' => '50-75%'],
                    ['value' => 'More than 75%'],
                ],
                'options_ar' => [
                    ['value' => 'أقل من 25%'],
                    ['value' => '25-50%'],
                    ['value' => '50-75%'],
                    ['value' => 'أكثر من 75%'],
                ],
                'is_required' => true,
                'order' => 4,
            ],
            [
                'label_en' => 'What is your age group?',
                'label_ar' => 'ما هي فئتك العمرية؟',
                'field_name' => 'age_group',
                'field_type' => 'radio',
                'options_en' => [
                    ['value' => 'Under 30'],
                    ['value' => '30-45'],
                    ['value' => '46-60'],
                    ['value' => 'Over 60'],
                ],
                'options_ar' => [
                    ['value' => 'أقل من 30'],
                    ['value' => '30-45'],
                    ['value' => '46-60'],
                    ['value' => 'أكثر من 60'],
                ],
                'is_required' => true,
                'order' => 5,
            ],
            [
                'label_en' => 'How much investment experience do you have?',
                'label_ar' => 'كم لديك من خبرة في الاستثمار؟',
                'field_name' => 'investment_experience',
                'field_type' => 'radio',
                'options_en' => [
                    ['value' => 'None'],
                    ['value' => 'Limited'],
                    ['value' => 'Moderate'],
                    ['value' => 'Extensive'],
                ],
                'options_ar' => [
                    ['value' => 'لا يوجد'],
                    ['value' => 'محدودة'],
                    ['value' => 'متوسطة'],
                    ['value' => 'واسعة'],
                ],
                'is_required' => true,
                'order' => 6,
            ],
            [
                'label_en' => 'What is the size of your total wealth?',
                'label_ar' => 'ما حجم ثروتك الإجمالية؟',
                'field_name' => 'wealth_size',
                'field_type' => 'radio',
                'options_en' => [
                    ['value' => 'Less than USD 1 million'],
                    ['value' => 'USD 1 million - USD 10 million'],
                    ['value' => 'USD 10 million - USD 50 million'],
                    ['value' => 'USD 50 million - USD 500 million'],
                ],
                'options_ar' => [
                    ['value' => 'أقل من مليون دولار أمريكي'],
                    ['value' => 'مليون دولار أمريكي - 10 ملايين دولار أمريكي'],
                    ['value' => '10 ملايين دولار أمريكي - 50 مليون دولار أمريكي'],
                    ['value' => '50 مليون دولار أمريكي - 500 مليون دولار أمريكي'],
                ],
                'is_required' => true,
                'order' => 7,
            ],
            
            // Second Column Fields
            [
                'label_en' => 'What is your investment goal?',
                'label_ar' => 'ما هو هدف استثمارك؟',
                'field_name' => 'investment_goal',
                'field_type' => 'checkbox',
                'options_en' => [
                    ['value' => 'Capital Preservation'],
                    ['value' => 'Income Generation'],
                    ['value' => 'Capital Growth'],
                ],
                'options_ar' => [
                    ['value' => 'الحفاظ على رأس المال'],
                    ['value' => 'توليد الدخل'],
                    ['value' => 'نمو رأس المال'],
                ],
                'is_required' => true,
                'order' => 8,
            ],
            [
                'label_en' => 'What is your investment horizon?',
                'label_ar' => 'ما هو أفق الاستثمار الخاص بك؟',
                'field_name' => 'investment_horizon',
                'field_type' => 'radio',
                'options_en' => [
                    ['value' => 'Less than 3 years'],
                    ['value' => '3-5 years'],
                    ['value' => 'More than 5 years'],
                ],
                'options_ar' => [
                    ['value' => 'أقل من 3 سنوات'],
                    ['value' => '3-5 سنوات'],
                    ['value' => 'أكثر من 5 سنوات'],
                ],
                'is_required' => true,
                'order' => 9,
            ],
            [
                'label_en' => 'How would you react if your investment portfolio lost 10% in a month?',
                'label_ar' => 'كيف سترد إذا خسرت محفظة استثمارك 10% في شهر؟',
                'field_name' => 'investment_reaction',
                'field_type' => 'checkbox',
                'options_en' => [
                    ['value' => 'Sell all investments'],
                    ['value' => 'Sell some investments'],
                    ['value' => 'Do nothing'],
                    ['value' => 'Buy more investments'],
                ],
                'options_ar' => [
                    ['value' => 'بيع جميع الاستثمارات'],
                    ['value' => 'بيع بعض الاستثمارات'],
                    ['value' => 'لا تفعل شيئًا'],
                    ['value' => 'شراء المزيد من الاستثمارات'],
                ],
                'is_required' => true,
                'order' => 10,
            ],
            [
                'label_en' => 'What is your primary source of income?',
                'label_ar' => 'ما هو مصدر دخلك الأساسي؟',
                'field_name' => 'income_source',
                'field_type' => 'checkbox',
                'options_en' => [
                    ['value' => 'Salary'],
                    ['value' => 'Business Income'],
                    ['value' => 'Investment Income'],
                ],
                'options_ar' => [
                    ['value' => 'الراتب'],
                    ['value' => 'دخل العمل'],
                    ['value' => 'دخل الاستثمار'],
                ],
                'is_required' => true,
                'order' => 11,
            ],
            [
                'label_en' => 'What is your preferred investment style?',
                'label_ar' => 'ما هو أسلوب الاستثمار المفضل لديك؟',
                'field_name' => 'investment_style',
                'field_type' => 'checkbox',
                'options_en' => [
                    ['value' => 'Conservative (low risk, lower returns)'],
                    ['value' => 'Balanced (moderate risk, moderate returns)'],
                    ['value' => 'Aggressive (high risk, higher returns)'],
                ],
                'options_ar' => [
                    ['value' => 'محافظ (مخاطر منخفضة، عوائد أقل)'],
                    ['value' => 'متوازن (مخاطر معتدلة، عوائد معتدلة)'],
                    ['value' => 'عدواني (مخاطر عالية، عوائد أعلى)'],
                ],
                'is_required' => true,
                'order' => 12,
            ],
            [
                'label_en' => 'How is your current asset allocation divided?',
                'label_ar' => 'كيف يتم تقسيم توزيع أصولك الحالية؟',
                'field_name' => 'asset_allocation',
                'field_type' => 'checkbox',
                'options_en' => [
                    ['value' => 'Equities'],
                    ['value' => 'Bonds'],
                    ['value' => 'Real Estate'],
                    ['value' => 'Cash'],
                    ['value' => 'Family Business'],
                    ['value' => 'Other Investments'],
                ],
                'options_ar' => [
                    ['value' => 'الأسهم'],
                    ['value' => 'السندات'],
                    ['value' => 'العقارات'],
                    ['value' => 'النقد'],
                    ['value' => 'الأعمال العائلية'],
                    ['value' => 'استثمارات أخرى'],
                ],
                'is_required' => true,
                'order' => 13,
            ],
        ];
        
        foreach ($fields as $field) {
            ToolsFormField::create($field);
        }
    }
}

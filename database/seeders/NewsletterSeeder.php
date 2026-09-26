<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Newsletter;

class NewsletterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Newsletter::create([
            'tag_en' => 'WHAT WE DO',
            'tag_ar' => 'ما نفعله',
            'title_en' => 'OUR NEWSLETTER',
            'title_ar' => 'نشرتنا الإخبارية',
            'description_en' => 'Invest smartly, grow steadily, and live confidently. Learn more about how we can help you achieve financial success.',
            'description_ar' => 'استثمر بذكاء، وانمُ بثبات، وعش بثقة. تعرف على المزيد حول كيف يمكننا مساعدتك في تحقيق النجاح المالي.',
            'button_text_en' => 'SUBSCRIBE',
            'button_text_ar' => 'اشترك',
            'placeholder_en' => 'Subscribe to Our Newsletter',
            'placeholder_ar' => 'اشترك في نشرتنا الإخبارية',
            'popup_image' => null,
            'is_active' => true,
        ]);
    }
}

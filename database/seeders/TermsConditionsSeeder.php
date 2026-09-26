<?php

namespace Database\Seeders;

use App\Models\TermsConditions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermsConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TermsConditions::updateOrCreate(
            ['id' => 1],
            [
                'title_en' => 'Terms & Conditions',
                'title_ar' => 'الشروط والأحكام',
                'hero_desktop_image' => null,
                'hero_mobile_image' => null,
                'content_en' => '<h2>Agreement to Terms</h2><p>By accessing and using our website and services, you agree to be bound by these Terms and Conditions. If you do not agree with any part of these terms, please do not use our services.</p><h2>Use of Service</h2><p>You agree to use our services only for lawful purposes and in accordance with these terms. You must not use our services:</p><ul><li>In any way that violates any applicable law or regulation</li><li>To transmit any unlawful, threatening, or offensive material</li><li>To impersonate any person or entity</li><li>To interfere with or disrupt our services</li></ul><h2>Intellectual Property</h2><p>All content on this website, including text, graphics, logos, and images, is the property of our company and is protected by copyright, trademark, and other intellectual property laws.</p><h2>Limitation of Liability</h2><p>We shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of our services.</p><h2>Governing Law</h2><p>These terms shall be governed by and construed in accordance with the laws of Abu Dhabi Global Market (ADGM).</p><h2>Changes to Terms</h2><p>We reserve the right to modify these terms at any time. We will notify you of any changes by posting the new terms on this page.</p>',
                'content_ar' => '<h2>الموافقة على الشروط</h2><p>من خلال الوصول إلى موقعنا الإلكتروني واستخدام خدماتنا، فإنك توافق على الالتزام بهذه الشروط والأحكام. إذا كنت لا توافق على أي جزء من هذه الشروط، يرجى عدم استخدام خدماتنا.</p><h2>استخدام الخدمة</h2><p>توافق على استخدام خدماتنا فقط للأغراض القانونية ووفقًا لهذه الشروط. يجب ألا تستخدم خدماتنا:</p><ul><li>بأي طريقة تنتهك أي قانون أو لائحة معمول بها</li><li>لنقل أي مواد غير قانونية أو مهددة أو مسيئة</li><li>لانتحال شخصية أي شخص أو كيان</li><li>للتدخل في خدماتنا أو تعطيلها</li></ul><h2>الملكية الفكرية</h2><p>جميع المحتويات الموجودة على هذا الموقع، بما في ذلك النصوص والرسومات والشعارات والصور، هي ملك لشركتنا ومحمية بموجب حقوق الطبع والنشر والعلامات التجارية وقوانين الملكية الفكرية الأخرى.</p><h2>تحديد المسؤولية</h2><p>لن نكون مسؤولين عن أي أضرار غير مباشرة أو عرضية أو خاصة أو تبعية أو عقابية ناتجة عن استخدامك لخدماتنا.</p><h2>القانون الحاكم</h2><p>تخضع هذه الشروط وتُفسر وفقًا لقوانين سوق أبوظبي العالمي (ADGM).</p><h2>التغييرات على الشروط</h2><p>نحتفظ بالحق في تعديل هذه الشروط في أي وقت. سنخطرك بأي تغييرات من خلال نشر الشروط الجديدة على هذه الصفحة.</p>',
                'is_active' => true,
            ]
        );
    }
}

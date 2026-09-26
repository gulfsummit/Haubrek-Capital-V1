<?php

namespace Database\Seeders;

use App\Models\CookiePolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CookiePolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CookiePolicy::updateOrCreate(
            ['id' => 1],
            [
                'title_en' => 'Cookie Policy',
                'title_ar' => 'سياسة ملفات تعريف الارتباط',
                'hero_desktop_image' => null,
                'hero_mobile_image' => null,
                'content_en' => '<h2>What Are Cookies</h2><p>Cookies are small text files that are stored on your device when you visit our website. They help us provide you with a better browsing experience and analyze how you use our site.</p><h2>How We Use Cookies</h2><p>We use cookies for various purposes:</p><ul><li>To remember your preferences and settings</li><li>To understand how you use our website</li><li>To improve our website performance</li><li>To provide personalized content and advertisements</li><li>To analyze site traffic and usage patterns</li></ul><h2>Types of Cookies We Use</h2><p>We use the following types of cookies:</p><ul><li><strong>Essential Cookies:</strong> Necessary for the website to function properly</li><li><strong>Performance Cookies:</strong> Help us improve our website by collecting anonymous usage data</li><li><strong>Functional Cookies:</strong> Remember your preferences and enhance your experience</li><li><strong>Targeting Cookies:</strong> Used to deliver relevant advertisements</li></ul><h2>Managing Cookies</h2><p>You can control and delete cookies through your browser settings. However, please note that disabling cookies may affect the functionality of our website.</p><h2>Third-Party Cookies</h2><p>We may also use third-party cookies from trusted partners to help us analyze website usage and improve our services.</p>',
                'content_ar' => '<h2>ما هي ملفات تعريف الارتباط</h2><p>ملفات تعريف الارتباط هي ملفات نصية صغيرة يتم تخزينها على جهازك عند زيارة موقعنا الإلكتروني. إنها تساعدنا في تزويدك بتجربة تصفح أفضل وتحليل كيفية استخدامك لموقعنا.</p><h2>كيفية استخدام ملفات تعريف الارتباط</h2><p>نستخدم ملفات تعريف الارتباط لأغراض مختلفة:</p><ul><li>لتذكر تفضيلاتك وإعداداتك</li><li>لفهم كيفية استخدامك لموقعنا الإلكتروني</li><li>لتحسين أداء موقعنا</li><li>لتقديم محتوى وإعلانات مخصصة</li><li>لتحليل حركة المرور على الموقع وأنماط الاستخدام</li></ul><h2>أنواع ملفات تعريف الارتباط التي نستخدمها</h2><p>نستخدم الأنواع التالية من ملفات تعريف الارتباط:</p><ul><li><strong>ملفات تعريف الارتباط الأساسية:</strong> ضرورية لعمل الموقع بشكل صحيح</li><li><strong>ملفات تعريف ارتباط الأداء:</strong> تساعدنا على تحسين موقعنا من خلال جمع بيانات الاستخدام المجهولة</li><li><strong>ملفات تعريف الارتباط الوظيفية:</strong> تذكر تفضيلاتك وتعزز تجربتك</li><li><strong>ملفات تعريف الارتباط المستهدفة:</strong> تُستخدم لتقديم إعلانات ذات صلة</li></ul><h2>إدارة ملفات تعريف الارتباط</h2><p>يمكنك التحكم في ملفات تعريف الارتباط وحذفها من خلال إعدادات المتصفح الخاص بك. ومع ذلك، يرجى ملاحظة أن تعطيل ملفات تعريف الارتباط قد يؤثر على وظائف موقعنا.</p><h2>ملفات تعريف الارتباط من طرف ثالث</h2><p>قد نستخدم أيضًا ملفات تعريف ارتباط من جهات خارجية موثوقة لمساعدتنا في تحليل استخدام الموقع وتحسين خدماتنا.</p>',
                'is_active' => true,
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PrivacyPolicy::updateOrCreate(
            ['id' => 1],
            [
                'title_en' => 'Privacy Policy',
                'title_ar' => 'سياسة الخصوصية',
                'hero_desktop_image' => null,
                'hero_mobile_image' => null,
                'content_en' => '<h2>Introduction</h2><p>This Privacy Policy describes how we collect, use, and protect your personal information when you use our services.</p><h2>Information We Collect</h2><p>We collect information that you provide directly to us, including your name, email address, phone number, and other contact details when you interact with our website or services.</p><h2>How We Use Your Information</h2><p>We use the information we collect to:</p><ul><li>Provide, maintain, and improve our services</li><li>Communicate with you about our products and services</li><li>Respond to your inquiries and support requests</li><li>Send you updates and marketing communications</li><li>Comply with legal obligations</li></ul><h2>Data Security</h2><p>We implement appropriate security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction.</p><h2>Your Rights</h2><p>You have the right to access, correct, or delete your personal information at any time. Please contact us if you wish to exercise these rights.</p><h2>Contact Us</h2><p>If you have any questions about this Privacy Policy, please contact us.</p>',
                'content_ar' => '<h2>مقدمة</h2><p>توضح سياسة الخصوصية هذه كيفية جمع معلوماتك الشخصية واستخدامها وحمايتها عند استخدام خدماتنا.</p><h2>المعلومات التي نجمعها</h2><p>نقوم بجمع المعلومات التي تقدمها لنا مباشرة، بما في ذلك اسمك وعنوان بريدك الإلكتروني ورقم هاتفك وتفاصيل الاتصال الأخرى عند تفاعلك مع موقعنا أو خدماتنا.</p><h2>كيفية استخدام معلوماتك</h2><p>نستخدم المعلومات التي نجمعها من أجل:</p><ul><li>تقديم خدماتنا والحفاظ عليها وتحسينها</li><li>التواصل معك بشأن منتجاتنا وخدماتنا</li><li>الرد على استفساراتك وطلبات الدعم الخاصة بك</li><li>إرسال التحديثات والاتصالات التسويقية إليك</li><li>الامتثال للالتزامات القانونية</li></ul><h2>أمن البيانات</h2><p>نطبق تدابير أمنية مناسبة لحماية معلوماتك الشخصية من الوصول غير المصرح به أو التعديل أو الإفصاح أو الإتلاف.</p><h2>حقوقك</h2><p>لديك الحق في الوصول إلى معلوماتك الشخصية أو تصحيحها أو حذفها في أي وقت. يرجى الاتصال بنا إذا كنت ترغب في ممارسة هذه الحقوق.</p><h2>اتصل بنا</h2><p>إذا كان لديك أي أسئلة حول سياسة الخصوصية هذه، يرجى الاتصال بنا.</p>',
                'is_active' => true,
            ]
        );
    }
}

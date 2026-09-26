<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactUs;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactUs::create([
            // Hero Section
            'hero_title_en' => 'CONTACT US',
            'hero_title_ar' => 'اتصل بنا',
            'hero_subtitle_en' => '<p>Your journey to financial success starts with a simple conversation</p>',
            'hero_subtitle_ar' => '<p>تبدأ رحلتك نحو النجاح المالي بمحادثة بسيطة</p>',
            
            // Form Section
            'form_title_en' => 'GET IN TOUCH WITH US',
            'form_title_ar' => 'تواصل معنا',
            'form_button_text_en' => 'SEND MESSAGE',
            'form_button_text_ar' => 'إرسال الرسالة',
            
            // Contact Info - Phone
            'phone_title_en' => 'Call Us',
            'phone_title_ar' => 'اتصل بنا',
            'phone_subtitle_en' => '<p>Mon - Fri: 9am - 6pm</p>',
            'phone_subtitle_ar' => '<p>الإثنين - الجمعة: 9 صباحًا - 6 مساءً</p>',
            'phone_number' => '+971 4 5182591 / 2',
            
            // Contact Info - Email
            'email_title_en' => 'Email Support',
            'email_title_ar' => 'دعم البريد الإلكتروني',
            'email_subtitle_en' => '<p>Email us & we will get back to you within 24 hours</p>',
            'email_subtitle_ar' => '<p>راسلنا عبر البريد الإلكتروني وسنرد عليك خلال 24 ساعة</p>',
            'email_address' => 'info@hauberkcapital.com',
            
            // Contact Info - Address
            'address_title_en' => 'ADDRESS',
            'address_title_ar' => 'العنوان',
            
            // Map
            'map_iframe_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3630.566941357565!2d54.38588827535931!3d24.50045737816608!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e665491ecc069%3A0x9d9d3d9987c47f20!2sAl%20Sila%20Tower%20-%208%20Abu%20Dhabi%20Global%20Market%20-%20First%20St%20-%20Al%20Maryah%20Island%20-%20MI1%20-%20Abu%20Dhabi%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2seg!4v1756117133980!5m2!1sen!2seg',
            
            'is_active' => true,
        ]);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            // Form Fields (English)
            $table->string('name_label_en')->nullable()->after('form_button_text_ar');
            $table->string('name_placeholder_en')->nullable()->after('name_label_en');
            $table->string('email_label_en')->nullable()->after('name_placeholder_en');
            $table->string('email_placeholder_en')->nullable()->after('email_label_en');
            $table->string('phone_label_en')->nullable()->after('email_placeholder_en');
            $table->string('phone_placeholder_en')->nullable()->after('phone_label_en');
            $table->string('message_label_en')->nullable()->after('phone_placeholder_en');
            $table->string('message_placeholder_en')->nullable()->after('message_label_en');
            
            // Form Fields (Arabic)
            $table->string('name_label_ar')->nullable()->after('message_placeholder_en');
            $table->string('name_placeholder_ar')->nullable()->after('name_label_ar');
            $table->string('email_label_ar')->nullable()->after('name_placeholder_ar');
            $table->string('email_placeholder_ar')->nullable()->after('email_label_ar');
            $table->string('phone_label_ar')->nullable()->after('email_placeholder_ar');
            $table->string('phone_placeholder_ar')->nullable()->after('phone_label_ar');
            $table->string('message_label_ar')->nullable()->after('phone_placeholder_ar');
            $table->string('message_placeholder_ar')->nullable()->after('message_label_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->dropColumn([
                'name_label_en',
                'name_placeholder_en',
                'email_label_en',
                'email_placeholder_en',
                'phone_label_en',
                'phone_placeholder_en',
                'message_label_en',
                'message_placeholder_en',
                'name_label_ar',
                'name_placeholder_ar',
                'email_label_ar',
                'email_placeholder_ar',
                'phone_label_ar',
                'phone_placeholder_ar',
                'message_label_ar',
                'message_placeholder_ar',
            ]);
        });
    }
};
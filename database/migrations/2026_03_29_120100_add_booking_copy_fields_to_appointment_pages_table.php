<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointment_pages', function (Blueprint $table) {
            $table->string('step_one_label_en')->nullable()->after('ready_background_image');
            $table->string('step_one_label_ar')->nullable()->after('step_one_label_en');
            $table->string('step_two_label_en')->nullable()->after('step_one_label_ar');
            $table->string('step_two_label_ar')->nullable()->after('step_two_label_en');

            $table->string('information_title_en')->nullable()->after('step_two_label_ar');
            $table->string('information_title_ar')->nullable()->after('information_title_en');
            $table->text('information_subtitle_en')->nullable()->after('information_title_ar');
            $table->text('information_subtitle_ar')->nullable()->after('information_subtitle_en');

            $table->string('date_time_title_en')->nullable()->after('information_subtitle_ar');
            $table->string('date_time_title_ar')->nullable()->after('date_time_title_en');
            $table->text('date_time_subtitle_en')->nullable()->after('date_time_title_ar');
            $table->text('date_time_subtitle_ar')->nullable()->after('date_time_subtitle_en');

            $table->string('appointment_for_label_en')->nullable()->after('date_time_subtitle_ar');
            $table->string('appointment_for_label_ar')->nullable()->after('appointment_for_label_en');
            $table->string('select_date_label_en')->nullable()->after('appointment_for_label_ar');
            $table->string('select_date_label_ar')->nullable()->after('select_date_label_en');
            $table->string('select_time_label_en')->nullable()->after('select_date_label_ar');
            $table->string('select_time_label_ar')->nullable()->after('select_time_label_en');
            $table->string('no_date_selected_label_en')->nullable()->after('select_time_label_ar');
            $table->string('no_date_selected_label_ar')->nullable()->after('no_date_selected_label_en');

            $table->string('full_name_label_en')->nullable()->after('no_date_selected_label_ar');
            $table->string('full_name_label_ar')->nullable()->after('full_name_label_en');
            $table->string('full_name_placeholder_en')->nullable()->after('full_name_label_ar');
            $table->string('full_name_placeholder_ar')->nullable()->after('full_name_placeholder_en');

            $table->string('email_label_en')->nullable()->after('full_name_placeholder_ar');
            $table->string('email_label_ar')->nullable()->after('email_label_en');
            $table->string('email_placeholder_en')->nullable()->after('email_label_ar');
            $table->string('email_placeholder_ar')->nullable()->after('email_placeholder_en');

            $table->string('company_name_label_en')->nullable()->after('email_placeholder_ar');
            $table->string('company_name_label_ar')->nullable()->after('company_name_label_en');
            $table->string('company_name_placeholder_en')->nullable()->after('company_name_label_ar');
            $table->string('company_name_placeholder_ar')->nullable()->after('company_name_placeholder_en');

            $table->string('user_type_label_en')->nullable()->after('company_name_placeholder_ar');
            $table->string('user_type_label_ar')->nullable()->after('user_type_label_en');
            $table->string('user_type_placeholder_en')->nullable()->after('user_type_label_ar');
            $table->string('user_type_placeholder_ar')->nullable()->after('user_type_placeholder_en');
            $table->json('user_type_options')->nullable()->after('user_type_placeholder_ar');

            $table->string('country_code_label_en')->nullable()->after('user_type_options');
            $table->string('country_code_label_ar')->nullable()->after('country_code_label_en');

            $table->string('phone_label_en')->nullable()->after('country_code_label_ar');
            $table->string('phone_label_ar')->nullable()->after('phone_label_en');
            $table->string('phone_placeholder_en')->nullable()->after('phone_label_ar');
            $table->string('phone_placeholder_ar')->nullable()->after('phone_placeholder_en');

            $table->string('message_label_en')->nullable()->after('phone_placeholder_ar');
            $table->string('message_label_ar')->nullable()->after('message_label_en');
            $table->string('message_placeholder_en')->nullable()->after('message_label_ar');
            $table->string('message_placeholder_ar')->nullable()->after('message_placeholder_en');

            $table->string('continue_button_text_en')->nullable()->after('message_placeholder_ar');
            $table->string('continue_button_text_ar')->nullable()->after('continue_button_text_en');
            $table->string('back_button_text_en')->nullable()->after('continue_button_text_ar');
            $table->string('back_button_text_ar')->nullable()->after('back_button_text_en');
            $table->string('book_button_text_en')->nullable()->after('back_button_text_ar');
            $table->string('book_button_text_ar')->nullable()->after('book_button_text_en');
            $table->string('validation_alert_en')->nullable()->after('book_button_text_ar');
            $table->string('validation_alert_ar')->nullable()->after('validation_alert_en');

            $table->json('weekday_labels_en')->nullable()->after('validation_alert_ar');
            $table->json('weekday_labels_ar')->nullable()->after('weekday_labels_en');
        });
    }

    public function down(): void
    {
        Schema::table('appointment_pages', function (Blueprint $table) {
            $table->dropColumn([
                'step_one_label_en',
                'step_one_label_ar',
                'step_two_label_en',
                'step_two_label_ar',
                'information_title_en',
                'information_title_ar',
                'information_subtitle_en',
                'information_subtitle_ar',
                'date_time_title_en',
                'date_time_title_ar',
                'date_time_subtitle_en',
                'date_time_subtitle_ar',
                'appointment_for_label_en',
                'appointment_for_label_ar',
                'select_date_label_en',
                'select_date_label_ar',
                'select_time_label_en',
                'select_time_label_ar',
                'no_date_selected_label_en',
                'no_date_selected_label_ar',
                'full_name_label_en',
                'full_name_label_ar',
                'full_name_placeholder_en',
                'full_name_placeholder_ar',
                'email_label_en',
                'email_label_ar',
                'email_placeholder_en',
                'email_placeholder_ar',
                'company_name_label_en',
                'company_name_label_ar',
                'company_name_placeholder_en',
                'company_name_placeholder_ar',
                'user_type_label_en',
                'user_type_label_ar',
                'user_type_placeholder_en',
                'user_type_placeholder_ar',
                'user_type_options',
                'country_code_label_en',
                'country_code_label_ar',
                'phone_label_en',
                'phone_label_ar',
                'phone_placeholder_en',
                'phone_placeholder_ar',
                'message_label_en',
                'message_label_ar',
                'message_placeholder_en',
                'message_placeholder_ar',
                'continue_button_text_en',
                'continue_button_text_ar',
                'back_button_text_en',
                'back_button_text_ar',
                'book_button_text_en',
                'book_button_text_ar',
                'validation_alert_en',
                'validation_alert_ar',
                'weekday_labels_en',
                'weekday_labels_ar',
            ]);
        });
    }
};

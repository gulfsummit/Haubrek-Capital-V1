<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointment_pages', function (Blueprint $table) {
            $table->text('selected_date_prefix_en')->nullable()->after('validation_alert_ar');
            $table->text('selected_date_prefix_ar')->nullable()->after('selected_date_prefix_en');
            $table->text('no_available_time_slots_text_en')->nullable()->after('selected_date_prefix_ar');
            $table->text('no_available_time_slots_text_ar')->nullable()->after('no_available_time_slots_text_en');
            $table->text('loading_time_slots_text_en')->nullable()->after('no_available_time_slots_text_ar');
            $table->text('loading_time_slots_text_ar')->nullable()->after('loading_time_slots_text_en');
            $table->text('availability_load_error_text_en')->nullable()->after('loading_time_slots_text_ar');
            $table->text('availability_load_error_text_ar')->nullable()->after('availability_load_error_text_en');
            $table->text('past_date_validation_message_en')->nullable()->after('availability_load_error_text_ar');
            $table->text('past_date_validation_message_ar')->nullable()->after('past_date_validation_message_en');
            $table->text('weekend_validation_message_en')->nullable()->after('past_date_validation_message_ar');
            $table->text('weekend_validation_message_ar')->nullable()->after('weekend_validation_message_en');
            $table->text('slot_unavailable_message_en')->nullable()->after('weekend_validation_message_ar');
            $table->text('slot_unavailable_message_ar')->nullable()->after('slot_unavailable_message_en');
            $table->text('success_message_en')->nullable()->after('slot_unavailable_message_ar');
            $table->text('success_message_ar')->nullable()->after('success_message_en');
        });
    }

    public function down(): void
    {
        Schema::table('appointment_pages', function (Blueprint $table) {
            $table->dropColumn([
                'selected_date_prefix_en',
                'selected_date_prefix_ar',
                'no_available_time_slots_text_en',
                'no_available_time_slots_text_ar',
                'loading_time_slots_text_en',
                'loading_time_slots_text_ar',
                'availability_load_error_text_en',
                'availability_load_error_text_ar',
                'past_date_validation_message_en',
                'past_date_validation_message_ar',
                'weekend_validation_message_en',
                'weekend_validation_message_ar',
                'slot_unavailable_message_en',
                'slot_unavailable_message_ar',
                'success_message_en',
                'success_message_ar',
            ]);
        });
    }
};

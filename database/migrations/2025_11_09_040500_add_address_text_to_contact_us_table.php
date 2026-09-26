<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->text('address_text_en')->nullable()->after('address_title_ar');
            $table->text('address_text_ar')->nullable()->after('address_text_en');
        });
    }

    public function down(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->dropColumn(['address_text_en', 'address_text_ar']);
        });
    }
};


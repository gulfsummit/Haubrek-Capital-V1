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
        Schema::create('tools_form_fields', function (Blueprint $table) {
            $table->id();
            $table->string('label_en');
            $table->string('label_ar')->nullable();
            $table->string('field_name'); // unique name for the field (e.g., 'name', 'email', 'age_group')
            $table->enum('field_type', ['text', 'email', 'tel', 'number', 'textarea', 'radio', 'checkbox', 'select'])->default('text');
            $table->text('options_en')->nullable(); // JSON array for radio/checkbox/select options
            $table->text('options_ar')->nullable();
            $table->string('placeholder_en')->nullable();
            $table->string('placeholder_ar')->nullable();
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(0); // for sorting
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools_form_fields');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research_downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_id')->constrained('research')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('business_email');
            $table->string('company');
            $table->string('job_title');
            $table->string('country');
            $table->string('phone_number')->nullable();
            $table->timestamp('downloaded_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research_downloads');
    }
};

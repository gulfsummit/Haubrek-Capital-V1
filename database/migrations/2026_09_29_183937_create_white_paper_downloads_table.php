<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('white_paper_downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('white_paper_id')->constrained('white_papers')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('business_email');
            $table->string('phone_number');
            $table->string('job_title');
            $table->string('company')->nullable();
            $table->string('country')->nullable();
            $table->timestamp('downloaded_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('white_paper_downloads');
    }
};

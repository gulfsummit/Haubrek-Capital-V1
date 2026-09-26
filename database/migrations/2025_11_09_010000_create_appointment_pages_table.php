<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointment_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_background_desktop')->nullable();
            $table->string('hero_background_mobile')->nullable();
            $table->string('ready_title')->nullable();
            $table->text('ready_description')->nullable();
            $table->string('ready_primary_label')->nullable();
            $table->string('ready_primary_url')->nullable();
            $table->string('ready_secondary_label')->nullable();
            $table->string('ready_secondary_url')->nullable();
            $table->string('ready_background_image')->nullable();
            $table->timestamps();
        });

        DB::table('appointment_pages')->insert([
            'hero_title' => 'BOOK YOUR PLATINUM<br> SESSION',
            'hero_subtitle' => 'Your Path to Financial Success',
            'ready_title' => "READY TO<br>START GROWING?!",
            'ready_description' => 'Unlock the full potential of your wealth',
            'ready_primary_label' => 'JOIN OUR MAILING LIST',
            'ready_primary_url' => '/contact-us',
            'ready_secondary_label' => 'REQUEST A MEETING',
            'ready_secondary_url' => '/request-meeting',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_pages');
    }
};


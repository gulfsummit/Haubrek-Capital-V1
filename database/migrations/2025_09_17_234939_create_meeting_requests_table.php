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
        Schema::create('meeting_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('percentage');
            $table->string('age_group');
            $table->string('investment_experience');
            $table->string('wealth_size');
            $table->json('investment_goal');
            $table->string('investment_horizon');
            $table->json('investment_reaction');
            $table->json('income_source');
            $table->json('investment_style');
            $table->json('asset_allocation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_requests');
    }
};

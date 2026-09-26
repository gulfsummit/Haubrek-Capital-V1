<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, add the new why_work_cards column
        Schema::table('careers', function (Blueprint $table) {
            $table->json('why_work_cards')->nullable()->after('why_work_bg_image');
        });

        // Migrate existing data from individual card fields to the array
        $careers = DB::table('careers')->get();
        
        foreach ($careers as $career) {
            $cards = [];
            
            // Migrate card 1 if it exists
            if ($career->card1_title_en || $career->card1_title_ar) {
                $cards[] = [
                    'title_en' => $career->card1_title_en ?? '',
                    'title_ar' => $career->card1_title_ar ?? '',
                    'content_en' => $career->card1_content_en ?? '',
                    'content_ar' => $career->card1_content_ar ?? '',
                ];
            }
            
            // Migrate card 2 if it exists
            if ($career->card2_title_en || $career->card2_title_ar) {
                $cards[] = [
                    'title_en' => $career->card2_title_en ?? '',
                    'title_ar' => $career->card2_title_ar ?? '',
                    'content_en' => $career->card2_content_en ?? '',
                    'content_ar' => $career->card2_content_ar ?? '',
                ];
            }
            
            // Migrate card 3 if it exists
            if ($career->card3_title_en || $career->card3_title_ar) {
                $cards[] = [
                    'title_en' => $career->card3_title_en ?? '',
                    'title_ar' => $career->card3_title_ar ?? '',
                    'content_en' => $career->card3_content_en ?? '',
                    'content_ar' => $career->card3_content_ar ?? '',
                ];
            }
            
            // Update the record with the new cards array
            DB::table('careers')
                ->where('id', $career->id)
                ->update(['why_work_cards' => json_encode($cards)]);
        }

        // Now drop the old individual card columns
        Schema::table('careers', function (Blueprint $table) {
            $table->dropColumn([
                'card1_title_en',
                'card1_title_ar',
                'card1_content_en',
                'card1_content_ar',
                'card2_title_en',
                'card2_title_ar',
                'card2_content_en',
                'card2_content_ar',
                'card3_title_en',
                'card3_title_ar',
                'card3_content_en',
                'card3_content_ar',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back the individual card columns
        Schema::table('careers', function (Blueprint $table) {
            $table->string('card1_title_en')->nullable();
            $table->string('card1_title_ar')->nullable();
            $table->text('card1_content_en')->nullable();
            $table->text('card1_content_ar')->nullable();
            $table->string('card2_title_en')->nullable();
            $table->string('card2_title_ar')->nullable();
            $table->text('card2_content_en')->nullable();
            $table->text('card2_content_ar')->nullable();
            $table->string('card3_title_en')->nullable();
            $table->string('card3_title_ar')->nullable();
            $table->text('card3_content_en')->nullable();
            $table->text('card3_content_ar')->nullable();
        });

        // Migrate data back from array to individual fields
        $careers = DB::table('careers')->get();
        
        foreach ($careers as $career) {
            if ($career->why_work_cards) {
                $cards = json_decode($career->why_work_cards, true);
                
                $updateData = [];
                
                if (isset($cards[0])) {
                    $updateData['card1_title_en'] = $cards[0]['title_en'] ?? '';
                    $updateData['card1_title_ar'] = $cards[0]['title_ar'] ?? '';
                    $updateData['card1_content_en'] = $cards[0]['content_en'] ?? '';
                    $updateData['card1_content_ar'] = $cards[0]['content_ar'] ?? '';
                }
                
                if (isset($cards[1])) {
                    $updateData['card2_title_en'] = $cards[1]['title_en'] ?? '';
                    $updateData['card2_title_ar'] = $cards[1]['title_ar'] ?? '';
                    $updateData['card2_content_en'] = $cards[1]['content_en'] ?? '';
                    $updateData['card2_content_ar'] = $cards[1]['content_ar'] ?? '';
                }
                
                if (isset($cards[2])) {
                    $updateData['card3_title_en'] = $cards[2]['title_en'] ?? '';
                    $updateData['card3_title_ar'] = $cards[2]['title_ar'] ?? '';
                    $updateData['card3_content_en'] = $cards[2]['content_en'] ?? '';
                    $updateData['card3_content_ar'] = $cards[2]['content_ar'] ?? '';
                }
                
                DB::table('careers')
                    ->where('id', $career->id)
                    ->update($updateData);
            }
        }

        // Drop the why_work_cards column
        Schema::table('careers', function (Blueprint $table) {
            $table->dropColumn('why_work_cards');
        });
    }
};
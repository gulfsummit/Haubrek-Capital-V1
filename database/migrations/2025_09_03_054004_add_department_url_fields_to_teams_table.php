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
        Schema::table('teams', function (Blueprint $table) {
            // Investment Advisory URL
            $table->string('investment_advisory_url')->nullable()->after('investment_advisory_link_ar');
            
            // Financial Planning URL
            $table->string('financial_planning_url')->nullable()->after('financial_planning_link_ar');
            
            // Research & Analysis URL
            $table->string('research_analysis_url')->nullable()->after('research_analysis_link_ar');
            
            // Client Relations URL
            $table->string('client_relations_url')->nullable()->after('client_relations_link_ar');
            
            // Compliance & Legal URL
            $table->string('compliance_legal_url')->nullable()->after('compliance_legal_link_ar');
            
            // Operations & Administration URL
            $table->string('operations_admin_url')->nullable()->after('operations_admin_link_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn([
                'investment_advisory_url',
                'financial_planning_url',
                'research_analysis_url',
                'client_relations_url',
                'compliance_legal_url',
                'operations_admin_url',
            ]);
        });
    }
};

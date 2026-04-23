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
       Schema::create('parent_engagement_reports', function (Blueprint $table) {
            $table->id();

            $table->string('district')->comment('District Name');
            $table->string('school_name')->comment('School Name');

            $table->integer('ptm_conducted_count')
                  ->comment('PTMs Conducted last academic year');

            $table->integer('parents_invited_last_ptm')
                  ->comment('Total Parents Invited (Last 2 PTMs)');

            $table->integer('parents_attended_last_ptm')
                  ->comment('Total Parents who Attended PTMs (Last 2 PTMs)');

            $table->integer('progress_reports_shared')
                  ->comment('Total number of progress reports shared with parents in last academic year');

            $table->integer('grievances_received')
                  ->comment('Total grievances/complaints received from parents');

            $table->integer('grievances_resolved')
                  ->comment('Number of grievances resolved');

            $table->boolean('committee_active')
                  ->comment('Community Monitoring Committee Active (Yes/No)');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_engagement_reports');
    }
};

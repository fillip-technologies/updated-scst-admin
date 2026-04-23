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
        Schema::create('district_finance_reports', function (Blueprint $table) {
            $table->id();

            $table->string('district')->comment('District Name');

            $table->decimal('budget_allocated', 15, 2)
                  ->comment('Total Budget Allocated (Rs)');

            $table->decimal('budget_utilised', 15, 2)
                  ->comment('Total Budget Utilised (Rs)');

            $table->enum('audit_status', ['compliant', 'pending', 'non_compliant'])
                  ->comment('Audit Compliance Status');

            $table->integer('reports_due')
                  ->comment('Reports Due This Period');

            $table->integer('reports_submitted_on_time')
                  ->comment('Reports Submitted on Time');

            $table->date('last_submission_date')
                  ->comment('Last Report Submission Date');

            $table->boolean('dashboard_updated')
                  ->comment('Digital Dashboard Updated (Yes/No)');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('district_finance_reports');
    }
};

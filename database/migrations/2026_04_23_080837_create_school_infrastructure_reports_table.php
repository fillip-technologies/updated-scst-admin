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

            Schema::create('school_infrastructure_reports', function (Blueprint $table) {
                $table->id();

                $table->string('district')->comment('District Name');
                $table->string('school_name')->comment('School Name');

                $table->boolean('adequate_classrooms')
                    ->comment('Adequate Classrooms (Yes/No)');

                $table->boolean('functional_hostel_rooms')
                    ->comment('Functional Hostel Rooms (Yes/No)');

                $table->integer('functional_toilets')
                    ->comment('Total Functional Toilets (Count)');

                $table->boolean('functional_kitchen')
                    ->comment('Functional Kitchen (Yes/No)');

                $table->boolean('dining_hall_available')
                    ->comment('Dining Hall Available (Yes/No)');

                $table->boolean('safe_drinking_water')
                    ->comment('Safe Drinking Water / Purifier Available (Yes/No)');

                $table->boolean('electricity_backup')
                    ->comment('Electricity Backup Available (Yes/No)');

                $table->decimal('avg_electricity_hours', 4, 2)
                    ->comment('Average Electricity Hours Per Day');

                $table->boolean('library_functional')
                    ->comment('Library Functional (Yes/No)');

                $table->boolean('playground_available')
                    ->comment('Playground Available (Yes/No)');

                $table->boolean('boundary_wall_intact')
                    ->comment('Boundary Wall Intact (Yes/No)');

                $table->boolean('cctv_functional')
                    ->comment('CCTV Functional (Yes/No)');

                $table->boolean('internet_available')
                    ->comment('Internet / Wi-Fi Available (Yes/No)');

                $table->boolean('smart_classroom_operational')
                    ->comment('Smart Classroom Operational (Yes/No)');

                $table->boolean('infrastructure_audit_completed')
                    ->comment('Annual Infrastructure Audit Completed (Yes/No)');

                $table->timestamps();
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_infrastructure_reports');
    }
};

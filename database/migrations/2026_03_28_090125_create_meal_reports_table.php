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
        Schema::create('meal_reports', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('report_image');
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            $table->string('reportname');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_reports');
    }
};

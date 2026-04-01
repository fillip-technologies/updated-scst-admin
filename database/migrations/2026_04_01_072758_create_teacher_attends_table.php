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
        Schema::create('teacher_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')
                  ->constrained('schools')
                  ->cascadeOnDelete();
            $table->foreignId('teacher_id')
                  ->constrained('teachers')
                  ->cascadeOnDelete();
            $table->enum('status', ['present', 'absent', 'leave'])->default('present');
            $table->string('leave_type')->nullable();
            $table->text('reasion')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_attends');
    }
};

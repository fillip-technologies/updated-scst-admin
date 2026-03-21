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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
             $table->string('complaint_id')->unique();
            $table->string('student_name');
            $table->string('mobile', 10)->index();
            $table->string('school_name')->index();
            $table->string('issue_category')->index();
            $table->text('description');
            $table->enum('status', ['open', 'in_progress', 'resolved', 'rejected'])
                  ->default('open')
                  ->index();
            $table->ipAddress('ip_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};

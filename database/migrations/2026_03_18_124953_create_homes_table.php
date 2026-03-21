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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            $table->json('hero')->nullable();
            $table->json('gallery')->nullable();
            $table->json('about')->nullable();
            $table->json('activities')->nullable();
            $table->json('school_at_a_glance')->nullable();
            $table->json('infrasture')->nullable();
            $table->json('quiz')->nullable();
            $table->json('alumni')->nullable();
            $table->json('faq')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homes');
    }
};

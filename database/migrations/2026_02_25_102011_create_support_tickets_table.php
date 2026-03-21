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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
             $table->string('ticket_id')->unique();
            $table->string('student_name');
            $table->string('mobile', 10)->index();
            $table->string('school_name')->index();
            $table->text('reason');
            $table->enum('status', ['open', 'assigned', 'in_progress', 'resolved'])
                  ->default('open')
                  ->index();
            $table->string('assigned_officer')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('club_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->string('venue');
            $table->date('event_date')->index();
            $table->time('start_time');
            $table->time('end_time');
            $table->date('registration_deadline')->nullable()->index();
            $table->unsignedInteger('maximum_participants')->nullable();
            $table->string('banner')->nullable();
            $table->string('status', 20)->default('upcoming')->index();
            $table->timestamps();

            $table->index(['club_id', 'status']);
            $table->index(['event_date', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
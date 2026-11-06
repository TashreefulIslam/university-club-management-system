<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('event_registration_id')->constrained('event_registrations')->cascadeOnDelete();
            $table->foreignId('marked_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status', 20)->default('absent')->index();
            $table->timestamp('marked_at')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->unique('event_registration_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
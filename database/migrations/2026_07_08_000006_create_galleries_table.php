<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('club_id')->constrained()->cascadeOnDelete();
            $table->foreignId('event_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('uploaded_by')->constrained('users')->cascadeOnDelete();
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->date('upload_date')->index();
            $table->timestamps();

            $table->index(['club_id', 'event_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
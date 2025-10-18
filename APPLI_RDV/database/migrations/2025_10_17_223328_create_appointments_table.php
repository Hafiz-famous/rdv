<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();             // patient (users.id)
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete();  // doctors.id
            $table->dateTime('scheduled_at')->index();
            $table->string('status', 20)->default('pending')->index(); // pending|confirmed|cancelled
            $table->text('reason')->nullable();
            $table->timestamps();

            // Évite un doublon patient au même créneau (optionnel)
            $table->unique(['user_id', 'scheduled_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

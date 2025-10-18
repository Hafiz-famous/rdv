<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('phone')->nullable();
            $table->string('cabinet')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
        });

        Schema::create('specialty_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialty_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unique(['specialty_id','user_id']);
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('scheduled_at');
            $table->unsignedSmallInteger('duration_minutes')->default(20);
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->string('motif')->nullable();
            $table->timestamps();

            $table->index(['doctor_id','scheduled_at']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('specialty_user');
        Schema::dropIfExists('doctor_profiles');
        Schema::dropIfExists('specialties');
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('specialite');
            $table->string('numero_ordre')->nullable();
            $table->string('cabinet')->nullable();
            $table->string('pays')->nullable();
            $table->string('ville')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('doctor_profiles'); }
};

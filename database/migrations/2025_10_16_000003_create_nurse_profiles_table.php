<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('nurse_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('grade')->nullable();
            $table->string('service')->nullable();
            $table->string('pays')->nullable();
            $table->string('ville')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('nurse_profiles'); }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // string court, indexable. Default 'patient' pour ne pas casser l'app
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role', 30)->default('patient')->after('password');
                $table->index('role');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Le dropColumn passe avec SQLite récent; sinon laisser vide en dev
            if (Schema::hasColumn('users', 'role')) {
                $table->dropIndex(['role']);
                $table->dropColumn('role');
            }
        });
    }
};

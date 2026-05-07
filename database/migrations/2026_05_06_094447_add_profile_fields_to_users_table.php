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
        Schema::table('users', function (Blueprint $table) {
            $table->string('department')->nullable()->after('matric_no');
            $table->string('faculty')->nullable()->after('department');
            $table->string('phone')->nullable()->after('faculty');
            $table->string('level')->nullable()->after('phone'); // 100, 200, 300 etc
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['department', 'faculty', 'phone', 'level']);
        });
    }
};

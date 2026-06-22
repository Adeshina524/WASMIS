<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stress_records', function (Blueprint $table) {
            $table->integer('general_stress_score')->nullable()->after('user_id');
            $table->integer('tension_score')->nullable()->after('general_stress_score');
            $table->integer('academic_stress_score')->nullable()->after('tension_score');
        });
    }

    public function down(): void
    {
        Schema::table('stress_records', function (Blueprint $table) {
            $table->dropColumn(['general_stress_score', 'tension_score', 'academic_stress_score']);
        });
    }
};

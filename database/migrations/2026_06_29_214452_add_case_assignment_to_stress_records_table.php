<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stress_records', function (Blueprint $table) {
            $table->foreignId('assigned_counselor_id')->nullable()->after('stress_level')
                ->constrained('users')->onDelete('set null');
            $table->timestamp('assigned_at')->nullable()->after('assigned_counselor_id');
        });
    }

    public function down(): void
    {
        Schema::table('stress_records', function (Blueprint $table) {
            $table->dropForeign(['assigned_counselor_id']);
            $table->dropColumn(['assigned_counselor_id', 'assigned_at']);
        });
    }
};

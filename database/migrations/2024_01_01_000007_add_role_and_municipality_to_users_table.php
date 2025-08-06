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
            $table->foreignId('role_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('municipality_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('user_type', ['super_admin', 'admin', 'palika_user', 'viewer'])->default('viewer');
            
            $table->index('role_id');
            $table->index('municipality_id');
            $table->index('user_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['municipality_id']);
            $table->dropColumn(['role_id', 'municipality_id', 'user_type']);
        });
    }
};
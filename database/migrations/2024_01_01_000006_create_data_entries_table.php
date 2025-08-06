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
        Schema::create('data_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('municipality_id')->constrained()->onDelete('cascade');
            $table->text('budget_headline');
            $table->decimal('amount', 12, 2);
            $table->year('fiscal_year');
            $table->date('entry_date');
            $table->json('tag_ids')->nullable();
            $table->json('sector_ids')->nullable();
            $table->json('category_ids')->nullable();
            $table->timestamps();
            
            $table->index(['municipality_id', 'fiscal_year']);
            $table->index(['user_id', 'fiscal_year']);
            $table->index('entry_date');
            $table->index('fiscal_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_entries');
    }
};
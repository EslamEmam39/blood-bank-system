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
        Schema::create('article_client', function (Blueprint $table) {
            $table->foreignId('client_id')->constrained();
            $table->foreignId('article_id')->constrained();
            $table->timestamps();
        
            $table->primary(['client_id', 'article_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_client');
    }
};

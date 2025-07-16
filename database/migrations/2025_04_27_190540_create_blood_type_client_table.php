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
        Schema::create('blood_type_client', function (Blueprint $table) {
            $table->foreignId('blood_type_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->timestamps();
            
            $table->primary(['blood_type_id', 'client_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_type_client');
    }
};

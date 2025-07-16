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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
	        $table->string('name');
			$table->string('email');
			$table->date('birth_date');
			$table->integer('city_id');
			$table->string('phone');
			$table->date('donation_last_date');
			$table->string('password');
			$table->integer('blood_type_id');
			$table->boolean('is_active')->default(true);
			$table->string('api_token',60)->unique()->nullable();
            $table->string('pin_code')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};

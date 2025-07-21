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
     Schema::table('notifications', function (Blueprint $table) {
      $table->dropForeign(['client_id']);

        // ثم احذف العمود نفسه
        $table->dropColumn('client_id');    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
          // ترجع العمود في حالة rollback
        $table->unsignedBigInteger('client_id')->nullable();

        // ترجع الـ foreign key
        $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
    });
    }
};

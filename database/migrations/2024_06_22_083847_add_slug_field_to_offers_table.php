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
        Schema::table('offers', function (Blueprint $table) {
            //
            $table->string('slug')->unique()->nullable();
            $table->string('SKU');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            //
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
            $table->dropColumn('SKU');
        });
    }
};

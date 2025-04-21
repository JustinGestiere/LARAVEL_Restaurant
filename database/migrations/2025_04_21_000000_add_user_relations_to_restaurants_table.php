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
        Schema::table('restaurants', function (Blueprint $table) {
            $table->foreignId('restaurateur_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('employe_id')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropForeign(['restaurateur_id']);
            $table->dropForeign(['employe_id']);
            $table->dropColumn(['restaurateur_id', 'employe_id']);
        });
    }
};

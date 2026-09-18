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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('image')->nullable()->after('slug');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->string('image')->nullable()->after('slug');
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
            $table->string('country')->nullable()->change();
            $table->string('city')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
};

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
        Schema::table('social_media_links', function (Blueprint $table) {
            $table->string('platform')->nullable()->change();
            $table->string('url')->nullable()->change();
            $table->string('phone')->nullable()->after('id');
            $table->string('alt_phone')->nullable()->after('phone');
            $table->string('whatsapp')->nullable()->after('alt_phone');
            $table->string('email')->nullable()->after('whatsapp');
            $table->string('alt_email')->nullable()->after('email');
            $table->text('address')->nullable()->after('alt_email');
            $table->string('instagram')->nullable()->after('address');
            $table->string('facebook')->nullable()->after('instagram');
            $table->string('x')->nullable()->after('facebook');
            $table->string('linkedin')->nullable()->after('x');
            $table->string('youtube')->nullable()->after('linkedin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_media_links', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'alt_phone',
                'whatsapp',
                'email',
                'alt_email',
                'address',
                'instagram',
                'facebook',
                'x',
                'linkedin',
                'youtube',
            ]);
        });
    }
};

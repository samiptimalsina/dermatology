<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seo_meta', function (Blueprint $table) {
            $table->longText('content')->nullable()->after('meta_description');
            $table->string('menu_label')->nullable()->after('content');
            $table->string('menu_icon', 50)->nullable()->after('menu_label');
        });
    }

    public function down(): void
    {
        Schema::table('seo_meta', function (Blueprint $table) {
            $table->dropColumn(['content', 'menu_label', 'menu_icon']);
        });
    }
};
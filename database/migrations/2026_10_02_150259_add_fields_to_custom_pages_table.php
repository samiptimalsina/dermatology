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
        Schema::table('custom_pages', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->string('slug')->unique()->after('title');
            $table->longText('content');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('no_index')->default(false);
            $table->boolean('is_published')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_pages', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn([
                'title',
                'slug',
                'content',
                'meta_title',
                'meta_description',
                'no_index',
                'is_published',
            ]);
        });
    }
};

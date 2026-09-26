<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Insert the hero_video setting only if it doesn't already exist.
        DB::table('site_settings')->insertOrIgnore([
            'key'        => 'hero_video',
            'value'      => '',
            'type'       => 'text',
            'group'      => 'hero',
            'label'      => 'Hero Video URL (YouTube / Vimeo — doctor speaking)',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('site_settings')->where('key', 'hero_video')->delete();
    }
};

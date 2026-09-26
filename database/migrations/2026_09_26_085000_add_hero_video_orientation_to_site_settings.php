<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('site_settings')->insertOrIgnore([
            'key'        => 'hero_video_orientation',
            'value'      => 'landscape',   // 'landscape' | 'portrait'
            'type'       => 'text',
            'group'      => 'hero',
            'label'      => 'Hero Video Orientation (landscape or portrait)',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('site_settings')->where('key', 'hero_video_orientation')->delete();
    }
};

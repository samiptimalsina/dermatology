<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('site_settings')->insertOrIgnore([
            'key' => 'contact_map_image',
            'value' => '',
            'type' => 'image',
            'group' => 'contact',
            'label' => 'Clinic Map Image',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('site_settings')->where('key', 'contact_map_image')->delete();
    }
};

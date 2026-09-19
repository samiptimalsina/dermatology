<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            ['key' => 'header_logo', 'value' => '', 'type' => 'image', 'group' => 'general', 'label' => 'Header Logo'],
            ['key' => 'footer_logo', 'value' => '', 'type' => 'image', 'group' => 'general', 'label' => 'Footer Logo'],
            ['key' => 'show_header_logo', 'value' => '1', 'type' => 'boolean', 'group' => 'general', 'label' => 'Show Header Logo'],
            ['key' => 'show_footer_logo', 'value' => '1', 'type' => 'boolean', 'group' => 'general', 'label' => 'Show Footer Logo'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }

    public function down(): void
    {
        SiteSetting::whereIn('key', [
            'header_logo',
            'footer_logo',
            'show_header_logo',
            'show_footer_logo',
        ])->delete();
    }
};

<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        foreach ([
            ['key' => 'header_logo_path', 'label' => 'Selected Header Logo'],
            ['key' => 'footer_logo_path', 'label' => 'Selected Footer Logo'],
        ] as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => '', 'type' => 'text', 'group' => 'general', 'label' => $setting['label']]
            );
        }
    }

    public function down(): void
    {
        SiteSetting::whereIn('key', ['header_logo_path', 'footer_logo_path'])->delete();
    }
};

<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        SiteSetting::updateOrCreate(
            ['key' => 'site_logos'],
            [
                'value' => '[]',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Uploaded Logos',
            ]
        );
    }

    public function down(): void
    {
        SiteSetting::where('key', 'site_logos')->delete();
    }
};

<?php

namespace Tests\Feature;

use App\Models\Service;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\ServiceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeder_replaces_existing_content_and_preserves_every_document_paragraph(): void
    {
        $existingService = Service::query()->create([
            'title' => 'Outdated Acne Service',
            'slug' => 'acne-and-acne-scar-removal',
            'category' => 'general',
            'short_description' => 'Old summary',
            'full_description' => 'Old article content',
            'meta_title' => 'Old SEO title',
            'meta_description' => 'Old SEO description',
            'is_active' => false,
        ]);

        $expectedHashes = [
            'acne-and-acne-scar-removal' => '8549c1cdad8fd211d63dacb4f66296828311a5d543559a49eb5625db9e29173d',
            'asian-eyelid-surgery-or-blepharoplasty' => 'a86058f773f125f0026246201f533081432c4f481e330456d412e18053eff747',
            'black-doll-laser' => '7e1d9959acc0eb56d560af77229fb7731664ec30d47c3c1c0ef2ee6297dd3040',
            'botox-injection' => '8cf3d14fc40ec097781dbd737ca412dc5fa872b216a37ead991be57239ea9444',
            'chemical-peeling' => 'e3f7f5e48e0e962b34fe20589ee4628f353bce3ff9f19746974533b941f05b46',
            'diode-laser-hair-removal' => '2e00be330520a8ee2e4a92a4240e9ecbb5edee45469bb656ea7296840956d6c1',
            'hair-transplant' => '36c60d1a4d8aa5027503e6159fe239651f8087ab5c27cfd052e10ed21fb32323',
            'hydra-facial' => '3550fd660b609563d4712a47b6590dbb70886ea1f2c6a6cf21f42fb488ebec18',
            'laser-hair-reduction' => 'f2ece93f19d36feb8f3958749878e97fcd3cc58938fa3231898abfed9334e267',
            'laser-tattoo-removal' => '6c516947b0c7253ae2fec023e6155321a01a8ac918fb31127fd331239a17b5d3',
            'prp-therapy' => '9ac3e5f86be0d45bb46ebf2e65282412e5bf6951b70af11d92a124a41a082c20',
            'scar-revision-surgery' => 'bbd518a529214647f57a0b3daaa03d153ac5efc8de0a2d70a48173c532d2f823',
            'skin-and-dermatology-consultation' => '697fb7519c64ea55668ccafbcc1c9d99be872a6a9403445e1cbed296d61387d6',
            'skin-problems' => '4d5b0f21a0183499c07f6eb22a5babce85e9de9959f04490ef4cf1ea82ad6668',
            'ultherapy-facelift' => '3f0f3406ac262ae828e392240deb259822e2fadac9474975510ec3fc243358e5',
            'wrinkle-reduction' => '1a3a18740ab8d5242bbb1d30b95c7eedcc70693a1fd2ecb74d1429334b415d4b',
        ];

        $this->seed(ServiceSeeder::class);

        $services = Service::query()->whereIn('slug', array_keys($expectedHashes))->get()->keyBy('slug');
        $this->assertCount(16, $services);
        $this->assertSame($existingService->id, $services['acne-and-acne-scar-removal']->id);
        $this->assertSame('Acne and Acne Scar Removal', $services['acne-and-acne-scar-removal']->title);

        foreach ($expectedHashes as $slug => $expectedHash) {
            $article = preg_replace('/<\/p>/i', ' ', $services[$slug]->full_description);
            $article = html_entity_decode(strip_tags($article), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $article = preg_replace('/\s+/u', ' ', trim($article));

            $this->assertSame($expectedHash, hash('sha256', $article), "Document content changed for {$slug}.");
        }

        $serviceCount = Service::query()->count();
        $this->seed(ServiceSeeder::class);

        $this->assertSame($serviceCount, Service::query()->count());
    }

    public function test_database_seeder_applies_docx_content_after_the_clinic_import(): void
    {
        $this->seed(DatabaseSeeder::class);

        $service = Service::query()->where('slug', 'acne-and-acne-scar-removal')->firstOrFail();

        $this->assertStringContainsString('In Nepal, we often know acne as pimples.', $service->full_description);
        $this->assertStringNotContainsString('Acne develops when hair follicles become blocked', $service->full_description);
    }
}

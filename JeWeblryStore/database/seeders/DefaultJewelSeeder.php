<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Jewel;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DefaultJewelSeeder extends Seeder
{
    /**
     * Jewels that must always exist, backed by real images shipped in public/images.
     */
    private const DEFAULT_JEWELS = [
        [
            'name' => 'Pulsera de plata refinada.',
            'price' => 1250.00,
            'description' => 'Pulsera de plata refinada.',
            'material' => 'Oro Blanco',
            'stock' => 15,
            'source_image' => 'jewel-seed-1.jpg',
        ],
        [
            'name' => 'Anillo de esmeraldas solitario',
            'price' => 980.00,
            'description' => 'Anillo de esmeraldas solitario',
            'material' => 'Oro',
            'stock' => 12,
            'source_image' => 'jewel-seed-2.jpg',
        ],
        [
            'name' => 'Par de anillos dorado de diseño elegante para toda ocasión.',
            'price' => 430.00,
            'description' => 'Par de anillos dorado de diseño elegante para toda ocasión.',
            'material' => 'Plata',
            'stock' => 20,
            'source_image' => 'jewel-seed-3.jpg',
        ],
    ];

    public function run(): void
    {
        $status = Status::where('name', 'Active')->first() ?? Status::firstOrCreate(['name' => 'Active']);
        $category = Category::query()->first();

        if ($category === null) {
            throw new \RuntimeException('A category must exist before seeding default jewels.');
        }

        foreach (self::DEFAULT_JEWELS as $data) {
            Jewel::firstOrCreate(
                ['name' => $data['name']],
                [
                    'price' => $data['price'],
                    'description' => $data['description'],
                    'status_id' => $status->getId(),
                    'stock' => $data['stock'],
                    'material' => $data['material'],
                    'image' => $this->publishImage($data['source_image']),
                    'category_id' => $category->getId(),
                ]
            );
        }
    }

    /**
     * Copy the bundled seed image into the public disk so it survives fresh installs.
     */
    private function publishImage(string $fileName): string
    {
        $targetPath = 'jewels/'.$fileName;

        if (! Storage::disk('public')->exists($targetPath)) {
            Storage::disk('public')->put($targetPath, File::get(public_path('images/'.$fileName)));
        }

        return $targetPath;
    }
}

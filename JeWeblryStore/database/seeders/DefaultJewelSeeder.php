<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Jewel;
use App\Models\Status;
use Database\Factories\JewelFactory;
use Illuminate\Database\Seeder;

class DefaultJewelSeeder extends Seeder
{
    private const DEFAULT_JEWELS = [
        [
            'name' => 'Muzo Imperial Emerald Solitaire Ring',
            'price' => 3850.00,
            'description' => 'Cathedral-set Colombian emerald solitaire flanked by tapered diamond baguettes in hand-polished 18k yellow gold.',
            'material' => '18k Yellow Gold',
            'stock' => 9,
            'source_image' => 'jewel-seed-2.jpg',
            'category_slug' => 'colombian-emerald-collection',
        ],
        [
            'name' => 'Aurelia Pavé Tennis Bracelet',
            'price' => 2450.00,
            'description' => 'Articulated box-clasp bracelet set with sixty brilliant-cut diamonds in luminous 18k white gold.',
            'material' => '18k White Gold',
            'stock' => 14,
            'source_image' => 'jewel-seed-1.jpg',
            'category_slug' => 'bracelets-bangles',
        ],
        [
            'name' => 'Verona Interlocking Wedding Band Duo',
            'price' => 1620.00,
            'description' => 'Matched pair of comfort-fit ceremonial bands with subtle milgrain edges crafted in warm 18k yellow gold.',
            'material' => '18k Yellow Gold',
            'stock' => 18,
            'source_image' => 'jewel-seed-3.jpg',
            'category_slug' => 'wedding-eternity-bands',
        ],
        [
            'name' => 'Celestial Diamond Halo Engagement Ring',
            'price' => 4290.00,
            'description' => 'Round brilliant center stone encircled by a micro-pavé diamond halo on a slender 950 platinum band.',
            'material' => '950 Platinum',
            'stock' => 7,
            'source_image' => 'jewel1.jpg',
            'category_slug' => 'engagement-rings',
        ],
        [
            'name' => 'Riviera Ceylon Sapphire Pendant Necklace',
            'price' => 2890.00,
            'description' => 'Velvety royal-blue sapphire oval suspended from an adjustable diamond-cut cable chain in 18k white gold.',
            'material' => '18k White Gold',
            'stock' => 11,
            'source_image' => 'jewel2.jpg',
            'category_slug' => 'fine-necklaces-pendants',
        ],
        [
            'name' => 'Seraphina South Sea Pearl Drop Earrings',
            'price' => 1780.00,
            'description' => 'Lustrous golden South Sea pearls suspended beneath marquise diamond clusters in 18k rose gold.',
            'material' => '18k Rose Gold',
            'stock' => 12,
            'source_image' => 'jewel3.jpg',
            'category_slug' => 'diamond-gemstone-earrings',
        ],
        [
            'name' => 'Sovereign Tourbillon Dress Timepiece',
            'price' => 6400.00,
            'description' => 'Ultra-thin mechanical dress watch featuring a sunray guilloché dial, sapphire caseback, and 18k rose gold bezel.',
            'material' => '18k Rose Gold',
            'stock' => 5,
            'source_image' => 'jewel4.jpg',
            'category_slug' => 'luxury-timepieces',
        ],
    ];

    /**
     * Publish all bundled showcase images and seed flagship jewels.
     */
    public function run(): void
    {
        foreach (JewelFactory::BUNDLED_IMAGES as $fileName) {
            JewelFactory::publishBundledImage($fileName);
        }

        $status = Status::where('name', 'Active')->first() ?? Status::firstOrCreate(['name' => 'Active']);
        $fallbackCategory = Category::query()->first();

        if ($fallbackCategory === null) {
            throw new \RuntimeException('A category must exist before seeding default jewels.');
        }

        $totalDefaults = count(self::DEFAULT_JEWELS);

        foreach (self::DEFAULT_JEWELS as $index => $jewelData) {
            $category = Category::where('slug', $jewelData['category_slug'])->first() ?? $fallbackCategory;
            $timestamp = now()->subMinutes($totalDefaults - $index);

            Jewel::updateOrCreate(
                ['name' => $jewelData['name']],
                [
                    'price' => $jewelData['price'],
                    'description' => $jewelData['description'],
                    'status_id' => $status->getId(),
                    'stock' => $jewelData['stock'],
                    'material' => $jewelData['material'],
                    'image' => JewelFactory::publishBundledImage($jewelData['source_image']),
                    'category_id' => $category->getId(),
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]
            );
        }
    }
}

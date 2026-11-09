<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Status;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private const CATEGORIES = [
        [
            'name' => 'Engagement Rings',
            'slug' => 'engagement-rings',
            'description' => 'Hand-set solitaire, halo, and three-stone rings crafted to celebrate lifelong milestones.',
            'status' => 'Active',
        ],
        [
            'name' => 'Wedding & Eternity Bands',
            'slug' => 'wedding-eternity-bands',
            'description' => 'Timeless precious-metal bands and diamond eternity rings designed for everyday elegance.',
            'status' => 'Active',
        ],
        [
            'name' => 'Fine Necklaces & Pendants',
            'slug' => 'fine-necklaces-pendants',
            'description' => 'Delicate chains, gemstone medallions, and heirloom collar necklaces in noble metals.',
            'status' => 'Active',
        ],
        [
            'name' => 'Bracelets & Bangles',
            'slug' => 'bracelets-bangles',
            'description' => 'Artisanal tennis bracelets, sculpted cuffs, and hinged bangles with refined clasps.',
            'status' => 'Active',
        ],
        [
            'name' => 'Diamond & Gemstone Earrings',
            'slug' => 'diamond-gemstone-earrings',
            'description' => 'Luminous studs, chandelier drops, and classic hoops set with ethically sourced stones.',
            'status' => 'Active',
        ],
        [
            'name' => 'Colombian Emerald Collection',
            'slug' => 'colombian-emerald-collection',
            'description' => 'Signature pieces showcasing vivid Muzo and Chivor emeralds in 18k gold settings.',
            'status' => 'Active',
        ],
        [
            'name' => 'Luxury Timepieces',
            'slug' => 'luxury-timepieces',
            'description' => 'Swiss-movement dress watches finished with sapphire crystal and precious-metal cases.',
            'status' => 'Active',
        ],
        [
            'name' => 'Signet & Cocktail Rings',
            'slug' => 'signet-cocktail-rings',
            'description' => 'Bold architectural silhouettes and hand-engraved signets with vibrant center stones.',
            'status' => 'Active',
        ],
        [
            'name' => 'Pearl & Bridal Suite',
            'slug' => 'pearl-bridal-suite',
            'description' => 'South Sea and Akoya cultured pearl creations tailored for ceremonies and black-tie galas.',
            'status' => 'Active',
        ],
        [
            'name' => 'Brooches & Lapel Pins',
            'slug' => 'brooches-lapel-pins',
            'description' => 'Sculptural botanical and geometric pins crafted to elevate tailored outerwear.',
            'status' => 'Active',
        ],
        [
            'name' => 'Men\'s Fine Jewelry',
            'slug' => 'mens-fine-jewelry',
            'description' => 'Minimalist chains, onyx signet rings, and precious cufflinks with brushed finishes.',
            'status' => 'Active',
        ],
        [
            'name' => 'Bespoke Archive Pieces',
            'slug' => 'bespoke-archive-pieces',
            'description' => 'Limited-edition atelier creations and collector commissions preserved in our vault.',
            'status' => 'Inactive',
        ],
    ];

    /**
     * Seed the curated jewelry categories including active and archive collections.
     */
    public function run(): void
    {
        $activeStatus = Status::where('name', 'Active')->first() ?? Status::firstOrCreate(['name' => 'Active']);
        $inactiveStatus = Status::where('name', 'Inactive')->first() ?? Status::firstOrCreate(['name' => 'Inactive']);

        foreach (self::CATEGORIES as $categoryData) {
            $statusId = $categoryData['status'] === 'Active'
                ? $activeStatus->getId()
                : $inactiveStatus->getId();

            Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                [
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'],
                    'status_id' => $statusId,
                ]
            );
        }
    }
}

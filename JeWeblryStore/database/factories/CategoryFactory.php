<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    private const CATALOG_CATEGORIES = [
        'Engagement Rings' => 'Hand-set solitaire, halo, and three-stone rings crafted to celebrate lifelong milestones.',
        'Wedding & Eternity Bands' => 'Timeless precious-metal bands and diamond eternity rings designed for everyday elegance.',
        'Fine Necklaces & Pendants' => 'Delicate chains, gemstone medallions, and heirloom collar necklaces in noble metals.',
        'Bracelets & Bangles' => 'Artisanal tennis bracelets, sculpted cuffs, and hinged bangles with refined clasps.',
        'Diamond & Gemstone Earrings' => 'Luminous studs, chandelier drops, and classic hoops set with ethically sourced stones.',
        'Colombian Emerald Collection' => 'Signature pieces showcasing vivid Muzo and Chivor emeralds in 18k gold settings.',
        'Luxury Timepieces' => 'Swiss-movement dress watches finished with sapphire crystal and precious-metal cases.',
        'Signet & Cocktail Rings' => 'Bold architectural silhouettes and hand-engraved signets with vibrant center stones.',
        'Pearl & Bridal Suite' => 'South Sea and Akoya cultured pearl creations tailored for ceremonies and black-tie galas.',
        'Brooches & Lapel Pins' => 'Sculptural botanical and geometric pins crafted to elevate tailored outerwear.',
        'Men\'s Fine Jewelry' => 'Minimalist chains, onyx signet rings, and precious cufflinks with brushed finishes.',
        'Bespoke Archive Pieces' => 'Limited-edition atelier creations and collector commissions preserved in our vault.',
        'Choker & Collar Necklaces' => 'Structured gold collars and graduated gemstone chokers that frame the neckline.',
        'Gemstone Solitaires' => 'Single-origin sapphires, rubies, and tourmalines mounted to maximize natural brilliance.',
        'Stackable Rings' => 'Slender pavé, milgrain, and twisted bands crafted for effortless personal layering.',
        'Anklets & Body Chains' => 'Featherlight diamond-cut chains in 18k gold designed for warm-weather sophistication.',
    ];

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $names = array_keys(self::CATALOG_CATEGORIES);
        $baseName = fake()->randomElement($names);
        $uniqueSuffix = fake()->unique()->numberBetween(1, 9999);
        $existingSlug = Str::slug($baseName);

        $name = Category::where('slug', $existingSlug)->exists()
            ? $baseName.' '.$uniqueSuffix
            : $baseName;

        return [
            'name' => $name,
            'description' => self::CATALOG_CATEGORIES[$baseName],
            'slug' => Str::slug($name),
            'status_id' => fn (): int => Status::where('name', 'Active')->first()?->getId()
                ?? Status::firstOrCreate(['name' => 'Active'])->getId(),
        ];
    }

    /**
     * Indicate that the category should be created with an inactive status.
     */
    public function inactive(): static
    {
        return $this->state(fn (): array => [
            'status_id' => Status::where('name', 'Inactive')->first()?->getId()
                ?? Status::firstOrCreate(['name' => 'Inactive'])->getId(),
        ]);
    }
}

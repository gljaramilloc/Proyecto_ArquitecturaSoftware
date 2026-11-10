<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Jewel;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends Factory<Jewel>
 */
class JewelFactory extends Factory
{
    public const BUNDLED_IMAGES = [
        'jewel-seed-1.jpg',
        'jewel-seed-2.jpg',
        'jewel-seed-3.jpg',
        'jewel1.jpg',
        'jewel2.jpg',
        'jewel3.jpg',
        'jewel4.jpg',
    ];

    private const COLLECTIONS = [
        'Imperial',
        'Celestial',
        'Aurelia',
        'Verona',
        'Solstice',
        'Riviera',
        'Lumiere',
        'Sovereign',
        'Seraphina',
        'Mirage',
        'Valencian',
        'Heritage',
    ];

    private const GEMSTONES = [
        'Colombian Emerald',
        'Ceylon Sapphire',
        'Brilliant Diamond',
        'Burmese Ruby',
        'South Sea Pearl',
        'Aquamarine',
        'Morganite',
        'Black Onyx',
        'London Blue Topaz',
        'Fire Opal',
    ];

    private const PIECE_TYPES = [
        'Solitaire Ring',
        'Halo Ring',
        'Pendant Necklace',
        'Tennis Bracelet',
        'Drop Earrings',
        'Signet Ring',
        'Cuff Bracelet',
        'Eternity Band',
        'Stud Earrings',
        'Collar Necklace',
    ];

    private const MATERIALS = [
        '18k Yellow Gold',
        '18k White Gold',
        '18k Rose Gold',
        '950 Platinum',
        '925 Sterling Silver',
        '24k Gold Vermeil',
    ];

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $collection = fake()->randomElement(self::COLLECTIONS);
        $gemstone = fake()->randomElement(self::GEMSTONES);
        $pieceType = fake()->randomElement(self::PIECE_TYPES);
        $material = fake()->randomElement(self::MATERIALS);
        $sourceImage = fake()->randomElement(self::BUNDLED_IMAGES);

        return [
            'name' => "{$collection} {$gemstone} {$pieceType}",
            'price' => fake()->randomFloat(2, 240, 5800),
            'description' => "Handcrafted {$pieceType} featuring ethically sourced {$gemstone} accents set in polished {$material} with atelier hallmarking.",
            'status_id' => fn (): int => Status::where('name', 'Active')->first()?->getId()
                ?? Status::firstOrCreate(['name' => 'Active'])->getId(),
            'stock' => fake()->numberBetween(4, 30),
            'material' => $material,
            'image' => self::publishBundledImage($sourceImage),
            'category_id' => fn (): int => Category::inRandomOrder()->first()?->getId()
                ?? Category::factory()->create()->getId(),
        ];
    }

    /**
     * Indicate that the jewel is currently out of stock.
     */
    public function outOfStock(): static
    {
        return $this->state(fn (): array => [
            'stock' => 0,
        ]);
    }

    /**
     * Indicate that the jewel has an inactive status.
     */
    public function inactive(): static
    {
        return $this->state(fn (): array => [
            'status_id' => Status::where('name', 'Inactive')->first()?->getId()
                ?? Status::firstOrCreate(['name' => 'Inactive'])->getId(),
        ]);
    }

    /**
     * Ensure a bundled image from public/images is copied to the public storage disk.
     */
    public static function publishBundledImage(string $fileName): string
    {
        $targetPath = 'jewels/'.$fileName;
        $sourcePath = public_path('images/'.$fileName);

        if (File::exists($sourcePath) && ! Storage::disk('public')->exists($targetPath)) {
            Storage::disk('public')->put($targetPath, File::get($sourcePath));
        }

        return $targetPath;
    }
}

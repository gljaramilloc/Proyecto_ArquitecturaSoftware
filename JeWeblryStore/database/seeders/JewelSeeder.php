<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Jewel;
use App\Models\Status;
use Database\Factories\JewelFactory;
use Illuminate\Database\Seeder;

class JewelSeeder extends Seeder
{
    private const CURATED_JEWELS = [
        // Engagement Rings (+11 active so Engagement Rings has 12 total -> 2 pages on /categories/{id})
        ['name' => 'Solstice Oval Diamond Solitaire Ring', 'price' => 3490.00, 'material' => '950 Platinum', 'stock' => 8, 'image' => 'jewel-seed-2.jpg', 'category_slug' => 'engagement-rings', 'status' => 'Active', 'description' => 'Elongated oval-cut diamond held in sleek claw prongs atop a whisper-thin platinum shank.'],
        ['name' => 'Lumiere Three-Stone Sapphire Engagement Ring', 'price' => 3920.00, 'material' => '18k White Gold', 'stock' => 6, 'image' => 'jewel1.jpg', 'category_slug' => 'engagement-rings', 'status' => 'Active', 'description' => 'Cushion-cut cornflower sapphire framed by matching pear-shaped white diamonds.'],
        ['name' => 'Elysian Cushion Morganite Halo Ring', 'price' => 2180.00, 'material' => '18k Rose Gold', 'stock' => 10, 'image' => 'jewel3.jpg', 'category_slug' => 'engagement-rings', 'status' => 'Active', 'description' => 'Blush-pink morganite center stone surrounded by a delicate diamond halo in warm rose gold.'],
        ['name' => 'Marquise Vintage Milgrain Engagement Ring', 'price' => 3150.00, 'material' => '18k Yellow Gold', 'stock' => 5, 'image' => 'jewel-seed-3.jpg', 'category_slug' => 'engagement-rings', 'status' => 'Active', 'description' => 'Art-Deco inspired marquise diamond setting finished with hand-engraved botanical filigree.'],
        ['name' => 'Valencian Emerald-Cut Diamond Ring', 'price' => 4750.00, 'material' => '950 Platinum', 'stock' => 4, 'image' => 'jewel2.jpg', 'category_slug' => 'engagement-rings', 'status' => 'Active', 'description' => 'Step-cut emerald diamond prized for hall-of-mirrors clarity in a minimalist bezel mount.'],
        ['name' => 'Heritage Cathedral Ruby Solitaire Ring', 'price' => 3640.00, 'material' => '18k Yellow Gold', 'stock' => 7, 'image' => 'jewel4.jpg', 'category_slug' => 'engagement-rings', 'status' => 'Active', 'description' => 'Pigeon-blood Burmese ruby elevated by sculpted cathedral shoulders and diamond accents.'],
        ['name' => 'Mirage Pear-Cut Aquamarine Ring', 'price' => 1950.00, 'material' => '18k White Gold', 'stock' => 13, 'image' => 'jewel-seed-1.jpg', 'category_slug' => 'engagement-rings', 'status' => 'Active', 'description' => 'Crystal-clear Santa Maria aquamarine set on a pavé split-shank white gold band.'],
        ['name' => 'Aria Twisted Pavé Solitaire Ring', 'price' => 2790.00, 'material' => '18k Rose Gold', 'stock' => 9, 'image' => 'jewel1.jpg', 'category_slug' => 'engagement-rings', 'status' => 'Active', 'description' => 'Intertwined ribbons of polished rose gold and micro-set diamonds leading to a brilliant center gem.'],
        ['name' => 'Capri Radiant Yellow Diamond Ring', 'price' => 5390.00, 'material' => '18k Yellow Gold', 'stock' => 3, 'image' => 'jewel-seed-2.jpg', 'category_slug' => 'engagement-rings', 'status' => 'Active', 'description' => 'Natural fancy-yellow radiant diamond set in an 18k yellow gold basket for intense warmth.'],
        ['name' => 'camellia Petite Bezel Diamond Ring', 'price' => 1890.00, 'material' => '18k White Gold', 'stock' => 15, 'image' => 'jewel-seed-3.jpg', 'category_slug' => 'engagement-rings', 'status' => 'Active', 'description' => 'Low-profile modern bezel solitaire engineered for effortless daily wear and brilliance.'],
        ['name' => 'Bellagio Asscher-Cut Collector Ring', 'price' => 5890.00, 'material' => '950 Platinum', 'stock' => 0, 'image' => 'jewel2.jpg', 'category_slug' => 'engagement-rings', 'status' => 'Active', 'description' => 'Architectural octagonal Asscher-cut diamond balanced by french-pavé platinum shoulders.'],

        // Wedding & Eternity Bands
        ['name' => 'Infinity Full-Circle Diamond Eternity Band', 'price' => 2350.00, 'material' => '950 Platinum', 'stock' => 11, 'image' => 'jewel-seed-3.jpg', 'category_slug' => 'wedding-eternity-bands', 'status' => 'Active', 'description' => 'Continuous shared-prong circle of matched brilliant diamonds in hypoallergenic platinum.'],
        ['name' => 'Palazzo Brushed Gold Chevron Band', 'price' => 890.00, 'material' => '18k Rose Gold', 'stock' => 22, 'image' => 'jewel1.jpg', 'category_slug' => 'wedding-eternity-bands', 'status' => 'Active', 'description' => 'Contoured V-shaped stacking band combining satin-brushed texture with high-polish bevels.'],

        // Fine Necklaces & Pendants
        ['name' => 'Solstice Compass Medallion Necklace', 'price' => 1180.00, 'material' => '18k Yellow Gold', 'stock' => 16, 'image' => 'jewel2.jpg', 'category_slug' => 'fine-necklaces-pendants', 'status' => 'Active', 'description' => 'Octagonal gold talisman centered with a star-set diamond on an 18-inch belcher chain.'],
        ['name' => 'Lumina Graduated Diamond Riviera Collar', 'price' => 4980.00, 'material' => '18k White Gold', 'stock' => 4, 'image' => 'jewel-seed-1.jpg', 'category_slug' => 'fine-necklaces-pendants', 'status' => 'Active', 'description' => 'Fluid gala necklace draped with seamlessly graduated bezel-set diamonds.'],

        // Bracelets & Bangles
        ['name' => 'florentine Hinged Gold Cuff Bangle', 'price' => 1740.00, 'material' => '18k Yellow Gold', 'stock' => 10, 'image' => 'jewel4.jpg', 'category_slug' => 'bracelets-bangles', 'status' => 'Active', 'description' => 'Hand-textured Italian silk-finish gold bangle with concealed push-button safety clasp.'],
        ['name' => 'Andean Emerald Station Chain Bracelet', 'price' => 1420.00, 'material' => '18k Yellow Gold', 'stock' => 12, 'image' => 'jewel-seed-2.jpg', 'category_slug' => 'bracelets-bangles', 'status' => 'Active', 'description' => 'Five bezel-set Colombian emeralds spaced evenly along a delicate double-link gold chain.'],

        // Diamond & Gemstone Earrings
        ['name' => 'Classic Four-Prong Diamond Stud Earrings', 'price' => 1560.00, 'material' => '950 Platinum', 'stock' => 19, 'image' => 'jewel3.jpg', 'category_slug' => 'diamond-gemstone-earrings', 'status' => 'Active', 'description' => 'Matched pair of fiery round-brilliant diamonds secured with screw-back platinum posts.'],
        ['name' => 'Alhambra Ruby Chandelier Drop Earrings', 'price' => 2680.00, 'material' => '18k Yellow Gold', 'stock' => 6, 'image' => 'jewel4.jpg', 'category_slug' => 'diamond-gemstone-earrings', 'status' => 'Active', 'description' => 'Articulated openwork gold drops set with faceted rubies that catch light with every movement.'],

        // Colombian Emerald Collection
        ['name' => 'Chivor Jardin Emerald Pendant', 'price' => 3120.00, 'material' => '18k Yellow Gold', 'stock' => 7, 'image' => 'jewel-seed-2.jpg', 'category_slug' => 'colombian-emerald-collection', 'status' => 'Active', 'description' => 'Deep bluish-green Chivor emerald rectangular step-cut framed in warm 18k yellow gold.'],
        ['name' => 'Cartagena Emerald & Diamond Ear Climbers', 'price' => 1980.00, 'material' => '18k White Gold', 'stock' => 0, 'image' => 'jewel-seed-1.jpg', 'category_slug' => 'colombian-emerald-collection', 'status' => 'Active', 'description' => 'Botanical leaf silhouette sweeping up the ear with alternating marquise emeralds and diamonds.'],

        // Luxury Timepieces
        ['name' => 'Geneve Moonphase Mother-of-Pearl Watch', 'price' => 5450.00, 'material' => '18k White Gold', 'stock' => 5, 'image' => 'jewel4.jpg', 'category_slug' => 'luxury-timepieces', 'status' => 'Active', 'description' => 'Iridescent mother-of-pearl dial with diamond hour markers and astronomical moonphase aperture.'],

        // Signet & Cocktail Rings
        ['name' => 'Medici Lapis Lazuli Cocktail Ring', 'price' => 1690.00, 'material' => '18k Yellow Gold', 'stock' => 8, 'image' => 'jewel1.jpg', 'category_slug' => 'signet-cocktail-rings', 'status' => 'Active', 'description' => 'Cabochon royal-blue lapis lazuli tablet mounted in a bold ribbed 18k gold cocktail setting.'],
        ['name' => 'Cannes London Blue Topaz Statement Ring', 'price' => 1340.00, 'material' => '925 Sterling Silver', 'stock' => 14, 'image' => 'jewel2.jpg', 'category_slug' => 'signet-cocktail-rings', 'status' => 'Active', 'description' => 'Oversized emerald-cut London Blue topaz set in rhodium-plated 925 sterling silver.'],

        // Pearl & Bridal Suite
        ['name' => 'Akoya Cultured Pearl Strand Necklace', 'price' => 2240.00, 'material' => '18k White Gold', 'stock' => 9, 'image' => 'jewel3.jpg', 'category_slug' => 'pearl-bridal-suite', 'status' => 'Active', 'description' => 'Hand-knotted silk strand of matched Japanese Akoya pearls finished with a filigree diamond clasp.'],
        ['name' => 'Bridal Marquise Tiara Hair Comb', 'price' => 1490.00, 'material' => '925 Sterling Silver', 'stock' => 11, 'image' => 'jewel-seed-1.jpg', 'category_slug' => 'pearl-bridal-suite', 'status' => 'Active', 'description' => 'Heirloom bridal comb adorned with freshwater pearls and marquise-cut crystal blossoms.'],

        // Brooches & Lapel Pins
        ['name' => 'Orchid Pavé Botanical Brooch', 'price' => 1260.00, 'material' => '24k Gold Vermeil', 'stock' => 10, 'image' => 'jewel2.jpg', 'category_slug' => 'brooches-lapel-pins', 'status' => 'Active', 'description' => 'Sculpted Cattleya orchid brooch celebrating Colombian flora in satin 24k gold vermeil.'],
        ['name' => 'Art Deco Onyx & Diamond Bar Pin', 'price' => 1580.00, 'material' => '18k White Gold', 'stock' => 7, 'image' => 'jewel-seed-3.jpg', 'category_slug' => 'brooches-lapel-pins', 'status' => 'Active', 'description' => 'Geometric calibre-cut black onyx and diamond lapel pin with locking trombone clasp.'],

        // Men's Fine Jewelry
        ['name' => 'Obsidian Black Onyx Cushion Signet Ring', 'price' => 1120.00, 'material' => '18k Yellow Gold', 'stock' => 13, 'image' => 'jewel4.jpg', 'category_slug' => 'mens-fine-jewelry', 'status' => 'Active', 'description' => 'Flush-set matte black onyx signet tailored with tapered satin-finished gold shoulders.'],

        // Inactive / Archive Jewels (4 total -> brings total jewels to 40 = 4 full pages in /admin/jewels)
        ['name' => 'Imperial Archive Emerald Tiara Study', 'price' => 8900.00, 'material' => '18k Yellow Gold', 'stock' => 1, 'image' => 'jewel-seed-2.jpg', 'category_slug' => 'bespoke-archive-pieces', 'status' => 'Inactive', 'description' => 'One-of-a-kind exhibition diadem preserved in the private atelier archive.'],
        ['name' => 'Bespoke Platinum Chronograph Prototype', 'price' => 9500.00, 'material' => '950 Platinum', 'stock' => 1, 'image' => 'jewel4.jpg', 'category_slug' => 'bespoke-archive-pieces', 'status' => 'Inactive', 'description' => 'Numbered horological commission awaiting private client delivery.'],
        ['name' => 'Vault Pink Diamond Collector Solitaire', 'price' => 7600.00, 'material' => '18k Rose Gold', 'stock' => 2, 'image' => 'jewel3.jpg', 'category_slug' => 'engagement-rings', 'status' => 'Inactive', 'description' => 'Seasonal high-jewelry capsule ring currently reserved for private trunk shows.'],
        ['name' => 'Royal Heritage Baroque Pearl Sautoir', 'price' => 4100.00, 'material' => '18k Yellow Gold', 'stock' => 3, 'image' => 'jewel2.jpg', 'category_slug' => 'pearl-bridal-suite', 'status' => 'Inactive', 'description' => 'Opera-length baroque pearl rope temporarily retired for clasp restoration.'],
    ];

    /**
     * Seed the storefront and administration catalog with curated jewelry pieces.
     */
    public function run(): void
    {
        $activeStatus = Status::where('name', 'Active')->first() ?? Status::firstOrCreate(['name' => 'Active']);
        $inactiveStatus = Status::where('name', 'Inactive')->first() ?? Status::firstOrCreate(['name' => 'Inactive']);
        $fallbackCategory = Category::query()->first() ?? Category::factory()->create();

        foreach (self::CURATED_JEWELS as $index => $jewelData) {
            $category = Category::where('slug', $jewelData['category_slug'])->first() ?? $fallbackCategory;
            $statusId = $jewelData['status'] === 'Active'
                ? $activeStatus->getId()
                : $inactiveStatus->getId();

            $name = ucfirst($jewelData['name']);
            $timestamp = now()->subHours($index + 1);

            Jewel::updateOrCreate(
                ['name' => $name],
                [
                    'price' => $jewelData['price'],
                    'description' => $jewelData['description'],
                    'status_id' => $statusId,
                    'stock' => $jewelData['stock'],
                    'material' => $jewelData['material'],
                    'image' => JewelFactory::publishBundledImage($jewelData['image']),
                    'category_id' => $category->getId(),
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]
            );
        }
    }
}

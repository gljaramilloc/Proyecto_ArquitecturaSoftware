-- JeWeblryStore Seed Data Export
-- Synchronized with Laravel migrations, factories, and seeders

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Active', '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(2, 'Inactive', '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(3, 'Pending', '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(4, 'Approved', '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(5, 'Rejected', '2026-11-09 03:51:38', '2026-11-09 03:51:38');

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `slug`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'Engagement Rings', 'Hand-set solitaire, halo, and three-stone rings crafted to celebrate lifelong milestones.', 'engagement-rings', 1, '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(2, 'Wedding & Eternity Bands', 'Timeless precious-metal bands and diamond eternity rings designed for everyday elegance.', 'wedding-eternity-bands', 1, '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(3, 'Fine Necklaces & Pendants', 'Delicate chains, gemstone medallions, and heirloom collar necklaces in noble metals.', 'fine-necklaces-pendants', 1, '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(4, 'Bracelets & Bangles', 'Artisanal tennis bracelets, sculpted cuffs, and hinged bangles with refined clasps.', 'bracelets-bangles', 1, '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(5, 'Diamond & Gemstone Earrings', 'Luminous studs, chandelier drops, and classic hoops set with ethically sourced stones.', 'diamond-gemstone-earrings', 1, '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(6, 'Colombian Emerald Collection', 'Signature pieces showcasing vivid Muzo and Chivor emeralds in 18k gold settings.', 'colombian-emerald-collection', 1, '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(7, 'Luxury Timepieces', 'Swiss-movement dress watches finished with sapphire crystal and precious-metal cases.', 'luxury-timepieces', 1, '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(8, 'Signet & Cocktail Rings', 'Bold architectural silhouettes and hand-engraved signets with vibrant center stones.', 'signet-cocktail-rings', 1, '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(9, 'Pearl & Bridal Suite', 'South Sea and Akoya cultured pearl creations tailored for ceremonies and black-tie galas.', 'pearl-bridal-suite', 1, '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(10, 'Brooches & Lapel Pins', 'Sculptural botanical and geometric pins crafted to elevate tailored outerwear.', 'brooches-lapel-pins', 1, '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(11, 'Men''s Fine Jewelry', 'Minimalist chains, onyx signet rings, and precious cufflinks with brushed finishes.', 'mens-fine-jewelry', 1, '2026-11-09 03:51:38', '2026-11-09 03:51:38'),
(12, 'Bespoke Archive Pieces', 'Limited-edition atelier creations and collector commissions preserved in our vault.', 'bespoke-archive-pieces', 2, '2026-11-09 03:51:38', '2026-11-09 03:51:38');

--
-- Dumping data for table `jewels`
--

INSERT INTO `jewels` (`id`, `name`, `price`, `description`, `status_id`, `stock`, `material`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Muzo Imperial Emerald Solitaire Ring', 3850, 'Cathedral-set Colombian emerald solitaire flanked by tapered diamond baguettes in hand-polished 18k yellow gold.', 1, 9, '18k Yellow Gold', 'jewels/jewel-seed-2.jpg', 6, '2026-11-09 03:44:43', '2026-11-09 03:44:43'),
(2, 'Aurelia Pavé Tennis Bracelet', 2450, 'Articulated box-clasp bracelet set with sixty brilliant-cut diamonds in luminous 18k white gold.', 1, 14, '18k White Gold', 'jewels/jewel-seed-1.jpg', 4, '2026-11-09 03:45:43', '2026-11-09 03:45:43'),
(3, 'Verona Interlocking Wedding Band Duo', 1620, 'Matched pair of comfort-fit ceremonial bands with subtle milgrain edges crafted in warm 18k yellow gold.', 1, 18, '18k Yellow Gold', 'jewels/jewel-seed-3.jpg', 2, '2026-11-09 03:46:43', '2026-11-09 03:46:43'),
(4, 'Celestial Diamond Halo Engagement Ring', 4290, 'Round brilliant center stone encircled by a micro-pavé diamond halo on a slender 950 platinum band.', 1, 7, '950 Platinum', 'jewels/jewel1.jpg', 1, '2026-11-09 03:47:43', '2026-11-09 03:47:43'),
(5, 'Riviera Ceylon Sapphire Pendant Necklace', 2890, 'Velvety royal-blue sapphire oval suspended from an adjustable diamond-cut cable chain in 18k white gold.', 1, 11, '18k White Gold', 'jewels/jewel2.jpg', 3, '2026-11-09 03:48:43', '2026-11-09 03:48:43'),
(6, 'Seraphina South Sea Pearl Drop Earrings', 1780, 'Lustrous golden South Sea pearls suspended beneath marquise diamond clusters in 18k rose gold.', 1, 12, '18k Rose Gold', 'jewels/jewel3.jpg', 5, '2026-11-09 03:49:43', '2026-11-09 03:49:43'),
(7, 'Sovereign Tourbillon Dress Timepiece', 6400, 'Ultra-thin mechanical dress watch featuring a sunray guilloché dial, sapphire caseback, and 18k rose gold bezel.', 1, 5, '18k Rose Gold', 'jewels/jewel4.jpg', 7, '2026-11-09 03:50:43', '2026-11-09 03:50:43'),
(8, 'Solstice Oval Diamond Solitaire Ring', 3490, 'Elongated oval-cut diamond held in sleek claw prongs atop a whisper-thin platinum shank.', 1, 8, '950 Platinum', 'jewels/jewel-seed-2.jpg', 1, '2026-11-09 02:51:43', '2026-11-09 02:51:43'),
(9, 'Lumiere Three-Stone Sapphire Engagement Ring', 3920, 'Cushion-cut cornflower sapphire framed by matching pear-shaped white diamonds.', 1, 6, '18k White Gold', 'jewels/jewel1.jpg', 1, '2026-11-09 01:51:43', '2026-11-09 01:51:43'),
(10, 'Elysian Cushion Morganite Halo Ring', 2180, 'Blush-pink morganite center stone surrounded by a delicate diamond halo in warm rose gold.', 1, 10, '18k Rose Gold', 'jewels/jewel3.jpg', 1, '2026-11-09 00:51:43', '2026-11-09 00:51:43'),
(11, 'Marquise Vintage Milgrain Engagement Ring', 3150, 'Art-Deco inspired marquise diamond setting finished with hand-engraved botanical filigree.', 1, 5, '18k Yellow Gold', 'jewels/jewel-seed-3.jpg', 1, '2026-11-08 23:51:43', '2026-11-08 23:51:43'),
(12, 'Valencian Emerald-Cut Diamond Ring', 4750, 'Step-cut emerald diamond prized for hall-of-mirrors clarity in a minimalist bezel mount.', 1, 4, '950 Platinum', 'jewels/jewel2.jpg', 1, '2026-11-08 22:51:43', '2026-11-08 22:51:43'),
(13, 'Heritage Cathedral Ruby Solitaire Ring', 3640, 'Pigeon-blood Burmese ruby elevated by sculpted cathedral shoulders and diamond accents.', 1, 7, '18k Yellow Gold', 'jewels/jewel4.jpg', 1, '2026-11-08 21:51:43', '2026-11-08 21:51:43'),
(14, 'Mirage Pear-Cut Aquamarine Ring', 1950, 'Crystal-clear Santa Maria aquamarine set on a pavé split-shank white gold band.', 1, 13, '18k White Gold', 'jewels/jewel-seed-1.jpg', 1, '2026-11-08 20:51:43', '2026-11-08 20:51:43'),
(15, 'Aria Twisted Pavé Solitaire Ring', 2790, 'Intertwined ribbons of polished rose gold and micro-set diamonds leading to a brilliant center gem.', 1, 9, '18k Rose Gold', 'jewels/jewel1.jpg', 1, '2026-11-08 19:51:43', '2026-11-08 19:51:43'),
(16, 'Capri Radiant Yellow Diamond Ring', 5390, 'Natural fancy-yellow radiant diamond set in an 18k yellow gold basket for intense warmth.', 1, 3, '18k Yellow Gold', 'jewels/jewel-seed-2.jpg', 1, '2026-11-08 18:51:43', '2026-11-08 18:51:43'),
(17, 'Camellia Petite Bezel Diamond Ring', 1890, 'Low-profile modern bezel solitaire engineered for effortless daily wear and brilliance.', 1, 15, '18k White Gold', 'jewels/jewel-seed-3.jpg', 1, '2026-11-08 17:51:43', '2026-11-08 17:51:43'),
(18, 'Bellagio Asscher-Cut Collector Ring', 5890, 'Architectural octagonal Asscher-cut diamond balanced by french-pavé platinum shoulders.', 1, 0, '950 Platinum', 'jewels/jewel2.jpg', 1, '2026-11-08 16:51:43', '2026-11-08 16:51:43'),
(19, 'Infinity Full-Circle Diamond Eternity Band', 2350, 'Continuous shared-prong circle of matched brilliant diamonds in hypoallergenic platinum.', 1, 11, '950 Platinum', 'jewels/jewel-seed-3.jpg', 2, '2026-11-08 15:51:43', '2026-11-08 15:51:43'),
(20, 'Palazzo Brushed Gold Chevron Band', 890, 'Contoured V-shaped stacking band combining satin-brushed texture with high-polish bevels.', 1, 22, '18k Rose Gold', 'jewels/jewel1.jpg', 2, '2026-11-08 14:51:43', '2026-11-08 14:51:43'),
(21, 'Solstice Compass Medallion Necklace', 1180, 'Octagonal gold talisman centered with a star-set diamond on an 18-inch belcher chain.', 1, 16, '18k Yellow Gold', 'jewels/jewel2.jpg', 3, '2026-11-08 13:51:43', '2026-11-08 13:51:43'),
(22, 'Lumina Graduated Diamond Riviera Collar', 4980, 'Fluid gala necklace draped with seamlessly graduated bezel-set diamonds.', 1, 4, '18k White Gold', 'jewels/jewel-seed-1.jpg', 3, '2026-11-08 12:51:43', '2026-11-08 12:51:43'),
(23, 'Florentine Hinged Gold Cuff Bangle', 1740, 'Hand-textured Italian silk-finish gold bangle with concealed push-button safety clasp.', 1, 10, '18k Yellow Gold', 'jewels/jewel4.jpg', 4, '2026-11-08 11:51:43', '2026-11-08 11:51:43'),
(24, 'Andean Emerald Station Chain Bracelet', 1420, 'Five bezel-set Colombian emeralds spaced evenly along a delicate double-link gold chain.', 1, 12, '18k Yellow Gold', 'jewels/jewel-seed-2.jpg', 4, '2026-11-08 10:51:43', '2026-11-08 10:51:43'),
(25, 'Classic Four-Prong Diamond Stud Earrings', 1560, 'Matched pair of fiery round-brilliant diamonds secured with screw-back platinum posts.', 1, 19, '950 Platinum', 'jewels/jewel3.jpg', 5, '2026-11-08 09:51:43', '2026-11-08 09:51:43'),
(26, 'Alhambra Ruby Chandelier Drop Earrings', 2680, 'Articulated openwork gold drops set with faceted rubies that catch light with every movement.', 1, 6, '18k Yellow Gold', 'jewels/jewel4.jpg', 5, '2026-11-08 08:51:43', '2026-11-08 08:51:43'),
(27, 'Chivor Jardin Emerald Pendant', 3120, 'Deep bluish-green Chivor emerald rectangular step-cut framed in warm 18k yellow gold.', 1, 7, '18k Yellow Gold', 'jewels/jewel-seed-2.jpg', 6, '2026-11-08 07:51:43', '2026-11-08 07:51:43'),
(28, 'Cartagena Emerald & Diamond Ear Climbers', 1980, 'Botanical leaf silhouette sweeping up the ear with alternating marquise emeralds and diamonds.', 1, 0, '18k White Gold', 'jewels/jewel-seed-1.jpg', 6, '2026-11-08 06:51:43', '2026-11-08 06:51:43'),
(29, 'Geneve Moonphase Mother-of-Pearl Watch', 5450, 'Iridescent mother-of-pearl dial with diamond hour markers and astronomical moonphase aperture.', 1, 5, '18k White Gold', 'jewels/jewel4.jpg', 7, '2026-11-08 05:51:43', '2026-11-08 05:51:43'),
(30, 'Medici Lapis Lazuli Cocktail Ring', 1690, 'Cabochon royal-blue lapis lazuli tablet mounted in a bold ribbed 18k gold cocktail setting.', 1, 8, '18k Yellow Gold', 'jewels/jewel1.jpg', 8, '2026-11-08 04:51:43', '2026-11-08 04:51:43'),
(31, 'Cannes London Blue Topaz Statement Ring', 1340, 'Oversized emerald-cut London Blue topaz set in rhodium-plated 925 sterling silver.', 1, 14, '925 Sterling Silver', 'jewels/jewel2.jpg', 8, '2026-11-08 03:51:43', '2026-11-08 03:51:43'),
(32, 'Akoya Cultured Pearl Strand Necklace', 2240, 'Hand-knotted silk strand of matched Japanese Akoya pearls finished with a filigree diamond clasp.', 1, 9, '18k White Gold', 'jewels/jewel3.jpg', 9, '2026-11-08 02:51:43', '2026-11-08 02:51:43'),
(33, 'Bridal Marquise Tiara Hair Comb', 1490, 'Heirloom bridal comb adorned with freshwater pearls and marquise-cut crystal blossoms.', 1, 11, '925 Sterling Silver', 'jewels/jewel-seed-1.jpg', 9, '2026-11-08 01:51:43', '2026-11-08 01:51:43'),
(34, 'Orchid Pavé Botanical Brooch', 1260, 'Sculpted Cattleya orchid brooch celebrating Colombian flora in satin 24k gold vermeil.', 1, 10, '24k Gold Vermeil', 'jewels/jewel2.jpg', 10, '2026-11-08 00:51:43', '2026-11-08 00:51:43'),
(35, 'Art Deco Onyx & Diamond Bar Pin', 1580, 'Geometric calibre-cut black onyx and diamond lapel pin with locking trombone clasp.', 1, 7, '18k White Gold', 'jewels/jewel-seed-3.jpg', 10, '2026-11-07 23:51:43', '2026-11-07 23:51:43'),
(36, 'Obsidian Black Onyx Cushion Signet Ring', 1120, 'Flush-set matte black onyx signet tailored with tapered satin-finished gold shoulders.', 1, 13, '18k Yellow Gold', 'jewels/jewel4.jpg', 11, '2026-11-07 22:51:43', '2026-11-07 22:51:43'),
(37, 'Imperial Archive Emerald Tiara Study', 8900, 'One-of-a-kind exhibition diadem preserved in the private atelier archive.', 2, 1, '18k Yellow Gold', 'jewels/jewel-seed-2.jpg', 12, '2026-11-07 21:51:43', '2026-11-07 21:51:43'),
(38, 'Bespoke Platinum Chronograph Prototype', 9500, 'Numbered horological commission awaiting private client delivery.', 2, 1, '950 Platinum', 'jewels/jewel4.jpg', 12, '2026-11-07 20:51:43', '2026-11-07 20:51:43'),
(39, 'Vault Pink Diamond Collector Solitaire', 7600, 'Seasonal high-jewelry capsule ring currently reserved for private trunk shows.', 2, 2, '18k Rose Gold', 'jewels/jewel3.jpg', 1, '2026-11-07 19:51:43', '2026-11-07 19:51:43'),
(40, 'Royal Heritage Baroque Pearl Sautoir', 4100, 'Opera-length baroque pearl rope temporarily retired for clasp restoration.', 2, 3, '18k Yellow Gold', 'jewels/jewel2.jpg', 9, '2026-11-07 18:51:43', '2026-11-07 18:51:43');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastNames`, `email`, `phoneNumber`, `address`, `status_id`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `balance`) VALUES
(1, 'Admin', 'Atelier Director', 'admin@jeweblrystore.com', '+57 300 410 5248', 'Carrera 35 #8A-19, El Poblado, Medellin', 1, 'admin', '2026-11-09 03:51:43', '$2y$12$WNP8HfrP9DFEkle26qNLcewsj0M05PiGJgqrkgsRj/qCT6nPDMQue', NULL, '2026-11-09 03:51:39', '2026-11-09 03:51:43', 25000),
(2, 'Valentina', 'Montoya Restrepo', 'customer@jeweblrystore.com', '+57 310 684 2190', 'Transversal Superior #12-45, El Poblado, Medellin', 1, 'customer', '2026-11-09 03:51:43', '$2y$12$viIso/GGRzO7zqk6YB60xejx4VXBiQceLkF0I5oJShrDUBG6EIK76', NULL, '2026-11-09 03:51:39', '2026-11-09 03:51:44', 18500),
(3, 'Jan', 'Rascón Marín', 'azelaya@example.net', '+57 334 205 8791', 'Ronda Vaca, 117, 16º D, Bocagrande, Cartagena', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', 'TG2WkgH0F2', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 6394.15),
(4, 'Inmaculada', 'Leiva De la Torre', 'garay.juanjose@example.net', '+57 352 525 7924', 'Praza Nayara, 438, 35º D, Chapinero Alto, Bogota', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', '20JPsxohAS', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 9763.35),
(5, 'Juan', 'Tapia Heredia', 'julia.cintron@example.net', '+57 398 780 6286', 'Plaza Treviño, 920, 1º, Envigado, Antioquia', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', 'xnGFlJCQPG', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 11349.65),
(6, 'Francisca', 'Bustos Sevilla', 'silva.nicolas@example.com', '+57 376 104 6517', 'Camiño Saucedo, 199, 2º D, El Poblado, Medellin', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', 'BdSu7nw2UV', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 2545.68),
(7, 'Nicolás', 'Carrero Orellana', 'bvelasquez@example.org', '+57 311 186 2346', 'Camiño Nahia, 3, 7º B, Laureles, Medellin', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', 'FETQ3zLQNR', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 11647.33),
(8, 'Ismael', 'Griego Segovia', 'aleix12@example.org', '+57 379 457 3095', 'Ronda Manuela, 262, 06º D, El Poblado, Medellin', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', 'x7RciOPT2p', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 7190.05),
(9, 'Andrés', 'Lorenzo Farías', 'berta.nieves@example.org', '+57 329 935 5310', 'Plaza Limón, 399, 69º B, Ciudad Jardin, Cali', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', '9f9MpUASp7', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 5239.72),
(10, 'Leire', 'Delafuente Santamaría', 'chavarria.marcos@example.org', '+57 372 923 8840', 'Travessera María, 35, 10º A, Ciudad Jardin, Cali', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', 'az8Ig3bF0n', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 6586.67),
(11, 'Cristian', 'Esparza Valle', 'pablo.asensio@example.com', '+57 305 411 7092', 'Travessera Fajardo, 34, Ático 5º, Bocagrande, Cartagena', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', 'mwNHbASClP', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 7313.95),
(12, 'Emilia', 'Jimínez Estrada', 'cuellar.alejandra@example.com', '+57 303 715 4208', 'Carrer Victoria, 5, 5º 8º, Envigado, Antioquia', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', 'oTra5C2aHH', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 11430.41),
(13, 'Marina', 'Naranjo Laboy', 'leire81@example.org', '+57 382 525 4136', 'Ruela Izan, 1, Ático 1º, Envigado, Antioquia', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', 'dYCASS2S9k', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 3440),
(14, 'Margarita', 'Vicente Barrera', 'faguayo@example.org', '+57 312 356 4381', 'Ruela Berta, 69, 6º, Ciudad Jardin, Cali', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', 'Vpc9kYF0nR', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 8048.46),
(15, 'Rubén', 'Zambrano Miranda', 'cesar05@example.net', '+57 366 597 2996', 'Rúa Marcos, 755, 79º D, Ciudad Jardin, Cali', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', 'oXiCpl8tyt', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 8863.4),
(16, 'Laura', 'Villar Oliver', 'clara.sanchez@example.org', '+57 322 903 3336', 'Praza Beatriz, 35, 0º, Envigado, Antioquia', 1, 'customer', '2026-11-09 03:51:39', '$2y$12$qz0tcfVo8CG8Kk5ZPbeIbevptZv97t.kZtnjJGlezmYAmQ8Um/XeW', 'tYXQ0ZEsSg', '2026-11-09 03:51:39', '2026-11-09 03:51:39', 4067.72);

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status_id`, `total`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 16070, 2, '2026-10-12 03:51:39', '2026-11-09 03:51:40'),
(2, 3, 4590, 2, '2026-10-24 03:51:39', '2026-11-09 03:51:40'),
(3, 3, 10410, 2, '2026-11-02 03:51:39', '2026-11-09 03:51:40'),
(4, 3, 11860, 2, '2026-11-07 03:51:39', '2026-11-09 03:51:40'),
(5, 3, 5200, 9, '2026-10-21 07:08:06', '2026-11-09 03:51:40'),
(6, 3, 16940, 5, '2026-09-10 19:46:21', '2026-11-09 03:51:40'),
(7, 4, 5390, 15, '2026-10-05 11:04:09', '2026-11-09 03:51:41'),
(8, 4, 27500, 16, '2026-09-19 21:45:51', '2026-11-09 03:51:41'),
(9, 4, 11150, 11, '2026-11-06 02:31:59', '2026-11-09 03:51:42'),
(10, 4, 3160, 8, '2026-11-07 00:38:01', '2026-11-09 03:51:42'),
(11, 4, 8580, 14, '2026-09-22 12:09:59', '2026-11-09 03:51:41'),
(12, 3, 11130, 15, '2026-10-23 18:54:41', '2026-11-09 03:51:40'),
(13, 4, 8410, 16, '2026-09-23 05:28:39', '2026-11-09 03:51:41'),
(14, 4, 1420, 14, '2026-09-15 00:20:35', '2026-11-09 03:51:41'),
(15, 4, 3560, 10, '2026-10-09 07:54:42', '2026-11-09 03:51:42'),
(16, 3, 12800, 8, '2026-10-15 22:03:04', '2026-11-09 03:51:40'),
(17, 3, 4480, 7, '2026-10-17 05:42:20', '2026-11-09 03:51:40'),
(18, 3, 10580, 8, '2026-09-08 23:07:43', '2026-11-09 03:51:40'),
(19, 3, 1580, 16, '2026-10-29 06:56:41', '2026-11-09 03:51:40'),
(20, 4, 3490, 13, '2026-09-26 10:42:25', '2026-11-09 03:51:41');

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `quantity`, `unit_price`, `jewel_id`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 2, 6400, 7, 1, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(2, 1, 1690, 30, 1, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(3, 1, 1580, 35, 1, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(4, 1, 2350, 19, 2, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(5, 2, 1120, 36, 2, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(6, 1, 6400, 7, 3, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(7, 1, 890, 20, 3, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(8, 1, 3120, 27, 3, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(9, 2, 3120, 27, 4, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(10, 2, 1690, 30, 4, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(11, 1, 2240, 32, 4, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(12, 2, 1340, 31, 5, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(13, 2, 1260, 34, 5, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(14, 2, 3490, 8, 6, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(15, 2, 4980, 22, 6, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(16, 2, 1180, 21, 7, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(17, 1, 1690, 30, 7, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(18, 1, 1340, 31, 7, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(19, 2, 6400, 7, 8, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(20, 1, 3920, 9, 8, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(21, 2, 5390, 16, 8, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(22, 1, 6400, 7, 9, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(23, 1, 4750, 12, 9, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(24, 2, 1580, 35, 10, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(25, 2, 4290, 4, 11, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(26, 1, 3850, 1, 12, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(27, 2, 3640, 13, 12, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(28, 1, 2350, 19, 13, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(29, 2, 2240, 32, 13, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(30, 1, 1580, 35, 13, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(31, 1, 1420, 24, 14, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(32, 2, 1780, 6, 15, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(33, 2, 6400, 7, 16, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(34, 2, 890, 20, 17, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(35, 1, 1580, 35, 17, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(36, 1, 1120, 36, 17, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(37, 2, 1620, 3, 18, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(38, 1, 1950, 14, 18, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(39, 1, 5390, 16, 18, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(40, 1, 1580, 35, 19, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(41, 1, 3490, 8, 20, '2026-11-09 03:51:40', '2026-11-09 03:51:40');

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `method`, `status_id`, `date`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 16070, 'balance', 4, '2026-10-12', 1, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(2, 4590, 'cheque', 3, '2026-10-24', 2, '2026-11-09 03:51:40', '2026-11-09 03:51:40'),
(3, 5200, 'cheque', 3, '2026-10-21', 5, '2026-11-09 03:51:41', '2026-11-09 03:51:41'),
(4, 5390, 'balance', 4, '2026-10-05', 7, '2026-11-09 03:51:41', '2026-11-09 03:51:41'),
(5, 27500, 'balance', 4, '2026-09-19', 8, '2026-11-09 03:51:41', '2026-11-09 03:51:41'),
(6, 3490, 'balance', 4, '2026-09-26', 20, '2026-11-09 03:51:41', '2026-11-09 03:51:41'),
(7, 16940, 'cheque', 3, '2026-09-10', 6, '2026-11-09 03:51:41', '2026-11-09 03:51:41'),
(8, 8410, 'balance', 4, '2026-09-23', 13, '2026-11-09 03:51:41', '2026-11-09 03:51:41'),
(9, 1420, 'balance', 4, '2026-09-15', 14, '2026-11-09 03:51:41', '2026-11-09 03:51:41'),
(10, 8580, 'balance', 4, '2026-09-22', 11, '2026-11-09 03:51:41', '2026-11-09 03:51:41'),
(11, 12800, 'cheque', 3, '2026-10-15', 16, '2026-11-09 03:51:41', '2026-11-09 03:51:41'),
(12, 3160, 'balance', 4, '2026-11-07', 10, '2026-11-09 03:51:42', '2026-11-09 03:51:42'),
(13, 3560, 'balance', 4, '2026-10-09', 15, '2026-11-09 03:51:42', '2026-11-09 03:51:42'),
(14, 11150, 'balance', 4, '2026-11-06', 9, '2026-11-09 03:51:42', '2026-11-09 03:51:42');

COMMIT;

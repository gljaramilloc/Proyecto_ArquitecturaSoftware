-- JeWeblryStore Seed Data Export
-- Synchronized with Laravel migrations, factories, and seeders

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Active', '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(2, 'Inactive', '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(3, 'Pending', '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(4, 'Approved', '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(5, 'Rejected', '2026-11-08 23:50:22', '2026-11-08 23:50:22');

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `slug`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'Engagement Rings', 'Hand-set solitaire, halo, and three-stone rings crafted to celebrate lifelong milestones.', 'engagement-rings', 1, '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(2, 'Wedding & Eternity Bands', 'Timeless precious-metal bands and diamond eternity rings designed for everyday elegance.', 'wedding-eternity-bands', 1, '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(3, 'Fine Necklaces & Pendants', 'Delicate chains, gemstone medallions, and heirloom collar necklaces in noble metals.', 'fine-necklaces-pendants', 1, '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(4, 'Bracelets & Bangles', 'Artisanal tennis bracelets, sculpted cuffs, and hinged bangles with refined clasps.', 'bracelets-bangles', 1, '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(5, 'Diamond & Gemstone Earrings', 'Luminous studs, chandelier drops, and classic hoops set with ethically sourced stones.', 'diamond-gemstone-earrings', 1, '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(6, 'Colombian Emerald Collection', 'Signature pieces showcasing vivid Muzo and Chivor emeralds in 18k gold settings.', 'colombian-emerald-collection', 1, '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(7, 'Luxury Timepieces', 'Swiss-movement dress watches finished with sapphire crystal and precious-metal cases.', 'luxury-timepieces', 1, '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(8, 'Signet & Cocktail Rings', 'Bold architectural silhouettes and hand-engraved signets with vibrant center stones.', 'signet-cocktail-rings', 1, '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(9, 'Pearl & Bridal Suite', 'South Sea and Akoya cultured pearl creations tailored for ceremonies and black-tie galas.', 'pearl-bridal-suite', 1, '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(10, 'Brooches & Lapel Pins', 'Sculptural botanical and geometric pins crafted to elevate tailored outerwear.', 'brooches-lapel-pins', 1, '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(11, 'Men''s Fine Jewelry', 'Minimalist chains, onyx signet rings, and precious cufflinks with brushed finishes.', 'mens-fine-jewelry', 1, '2026-11-08 23:50:22', '2026-11-08 23:50:22'),
(12, 'Bespoke Archive Pieces', 'Limited-edition atelier creations and collector commissions preserved in our vault.', 'bespoke-archive-pieces', 2, '2026-11-08 23:50:22', '2026-11-08 23:50:22');

--
-- Dumping data for table `jewels`
--

INSERT INTO `jewels` (`id`, `name`, `price`, `description`, `status_id`, `stock`, `material`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Muzo Imperial Emerald Solitaire Ring', 3850, 'Cathedral-set Colombian emerald solitaire flanked by tapered diamond baguettes in hand-polished 18k yellow gold.', 1, 9, '18k Yellow Gold', 'jewels/jewel-seed-2.jpg', 6, '2026-11-08 23:43:25', '2026-11-08 23:43:25'),
(2, 'Aurelia Pavé Tennis Bracelet', 2450, 'Articulated box-clasp bracelet set with sixty brilliant-cut diamonds in luminous 18k white gold.', 1, 14, '18k White Gold', 'jewels/jewel-seed-1.jpg', 4, '2026-11-08 23:44:25', '2026-11-08 23:44:25'),
(3, 'Verona Interlocking Wedding Band Duo', 1620, 'Matched pair of comfort-fit ceremonial bands with subtle milgrain edges crafted in warm 18k yellow gold.', 1, 18, '18k Yellow Gold', 'jewels/jewel-seed-3.jpg', 2, '2026-11-08 23:45:25', '2026-11-08 23:45:25'),
(4, 'Celestial Diamond Halo Engagement Ring', 4290, 'Round brilliant center stone encircled by a micro-pavé diamond halo on a slender 950 platinum band.', 1, 7, '950 Platinum', 'jewels/jewel1.jpg', 1, '2026-11-08 23:46:25', '2026-11-08 23:46:25'),
(5, 'Riviera Ceylon Sapphire Pendant Necklace', 2890, 'Velvety royal-blue sapphire oval suspended from an adjustable diamond-cut cable chain in 18k white gold.', 1, 11, '18k White Gold', 'jewels/jewel2.jpg', 3, '2026-11-08 23:47:25', '2026-11-08 23:47:25'),
(6, 'Seraphina South Sea Pearl Drop Earrings', 1780, 'Lustrous golden South Sea pearls suspended beneath marquise diamond clusters in 18k rose gold.', 1, 12, '18k Rose Gold', 'jewels/jewel3.jpg', 5, '2026-11-08 23:48:25', '2026-11-08 23:48:25'),
(7, 'Sovereign Tourbillon Dress Timepiece', 6400, 'Ultra-thin mechanical dress watch featuring a sunray guilloché dial, sapphire caseback, and 18k rose gold bezel.', 1, 5, '18k Rose Gold', 'jewels/jewel4.jpg', 7, '2026-11-08 23:49:25', '2026-11-08 23:49:25'),
(8, 'Solstice Oval Diamond Solitaire Ring', 3490, 'Elongated oval-cut diamond held in sleek claw prongs atop a whisper-thin platinum shank.', 1, 8, '950 Platinum', 'jewels/jewel-seed-2.jpg', 1, '2026-11-08 22:50:25', '2026-11-08 22:50:25'),
(9, 'Lumiere Three-Stone Sapphire Engagement Ring', 3920, 'Cushion-cut cornflower sapphire framed by matching pear-shaped white diamonds.', 1, 6, '18k White Gold', 'jewels/jewel1.jpg', 1, '2026-11-08 21:50:25', '2026-11-08 21:50:25'),
(10, 'Elysian Cushion Morganite Halo Ring', 2180, 'Blush-pink morganite center stone surrounded by a delicate diamond halo in warm rose gold.', 1, 10, '18k Rose Gold', 'jewels/jewel3.jpg', 1, '2026-11-08 20:50:25', '2026-11-08 20:50:25'),
(11, 'Marquise Vintage Milgrain Engagement Ring', 3150, 'Art-Deco inspired marquise diamond setting finished with hand-engraved botanical filigree.', 1, 5, '18k Yellow Gold', 'jewels/jewel-seed-3.jpg', 1, '2026-11-08 19:50:25', '2026-11-08 19:50:25'),
(12, 'Valencian Emerald-Cut Diamond Ring', 4750, 'Step-cut emerald diamond prized for hall-of-mirrors clarity in a minimalist bezel mount.', 1, 4, '950 Platinum', 'jewels/jewel2.jpg', 1, '2026-11-08 18:50:25', '2026-11-08 18:50:25'),
(13, 'Heritage Cathedral Ruby Solitaire Ring', 3640, 'Pigeon-blood Burmese ruby elevated by sculpted cathedral shoulders and diamond accents.', 1, 7, '18k Yellow Gold', 'jewels/jewel4.jpg', 1, '2026-11-08 17:50:25', '2026-11-08 17:50:25'),
(14, 'Mirage Pear-Cut Aquamarine Ring', 1950, 'Crystal-clear Santa Maria aquamarine set on a pavé split-shank white gold band.', 1, 13, '18k White Gold', 'jewels/jewel-seed-1.jpg', 1, '2026-11-08 16:50:25', '2026-11-08 16:50:25'),
(15, 'Aria Twisted Pavé Solitaire Ring', 2790, 'Intertwined ribbons of polished rose gold and micro-set diamonds leading to a brilliant center gem.', 1, 9, '18k Rose Gold', 'jewels/jewel1.jpg', 1, '2026-11-08 15:50:25', '2026-11-08 15:50:25'),
(16, 'Capri Radiant Yellow Diamond Ring', 5390, 'Natural fancy-yellow radiant diamond set in an 18k yellow gold basket for intense warmth.', 1, 3, '18k Yellow Gold', 'jewels/jewel-seed-2.jpg', 1, '2026-11-08 14:50:25', '2026-11-08 14:50:25'),
(17, 'Camellia Petite Bezel Diamond Ring', 1890, 'Low-profile modern bezel solitaire engineered for effortless daily wear and brilliance.', 1, 15, '18k White Gold', 'jewels/jewel-seed-3.jpg', 1, '2026-11-08 13:50:26', '2026-11-08 13:50:26'),
(18, 'Bellagio Asscher-Cut Collector Ring', 5890, 'Architectural octagonal Asscher-cut diamond balanced by french-pavé platinum shoulders.', 1, 0, '950 Platinum', 'jewels/jewel2.jpg', 1, '2026-11-08 12:50:26', '2026-11-08 12:50:26'),
(19, 'Infinity Full-Circle Diamond Eternity Band', 2350, 'Continuous shared-prong circle of matched brilliant diamonds in hypoallergenic platinum.', 1, 11, '950 Platinum', 'jewels/jewel-seed-3.jpg', 2, '2026-11-08 11:50:26', '2026-11-08 11:50:26'),
(20, 'Palazzo Brushed Gold Chevron Band', 890, 'Contoured V-shaped stacking band combining satin-brushed texture with high-polish bevels.', 1, 22, '18k Rose Gold', 'jewels/jewel1.jpg', 2, '2026-11-08 10:50:26', '2026-11-08 10:50:26'),
(21, 'Solstice Compass Medallion Necklace', 1180, 'Octagonal gold talisman centered with a star-set diamond on an 18-inch belcher chain.', 1, 16, '18k Yellow Gold', 'jewels/jewel2.jpg', 3, '2026-11-08 09:50:26', '2026-11-08 09:50:26'),
(22, 'Lumina Graduated Diamond Riviera Collar', 4980, 'Fluid gala necklace draped with seamlessly graduated bezel-set diamonds.', 1, 4, '18k White Gold', 'jewels/jewel-seed-1.jpg', 3, '2026-11-08 08:50:26', '2026-11-08 08:50:26'),
(23, 'Florentine Hinged Gold Cuff Bangle', 1740, 'Hand-textured Italian silk-finish gold bangle with concealed push-button safety clasp.', 1, 10, '18k Yellow Gold', 'jewels/jewel4.jpg', 4, '2026-11-08 07:50:26', '2026-11-08 07:50:26'),
(24, 'Andean Emerald Station Chain Bracelet', 1420, 'Five bezel-set Colombian emeralds spaced evenly along a delicate double-link gold chain.', 1, 12, '18k Yellow Gold', 'jewels/jewel-seed-2.jpg', 4, '2026-11-08 06:50:26', '2026-11-08 06:50:26'),
(25, 'Classic Four-Prong Diamond Stud Earrings', 1560, 'Matched pair of fiery round-brilliant diamonds secured with screw-back platinum posts.', 1, 19, '950 Platinum', 'jewels/jewel3.jpg', 5, '2026-11-08 05:50:26', '2026-11-08 05:50:26'),
(26, 'Alhambra Ruby Chandelier Drop Earrings', 2680, 'Articulated openwork gold drops set with faceted rubies that catch light with every movement.', 1, 6, '18k Yellow Gold', 'jewels/jewel4.jpg', 5, '2026-11-08 04:50:26', '2026-11-08 04:50:26'),
(27, 'Chivor Jardin Emerald Pendant', 3120, 'Deep bluish-green Chivor emerald rectangular step-cut framed in warm 18k yellow gold.', 1, 7, '18k Yellow Gold', 'jewels/jewel-seed-2.jpg', 6, '2026-11-08 03:50:26', '2026-11-08 03:50:26'),
(28, 'Cartagena Emerald & Diamond Ear Climbers', 1980, 'Botanical leaf silhouette sweeping up the ear with alternating marquise emeralds and diamonds.', 1, 0, '18k White Gold', 'jewels/jewel-seed-1.jpg', 6, '2026-11-08 02:50:26', '2026-11-08 02:50:26'),
(29, 'Geneve Moonphase Mother-of-Pearl Watch', 5450, 'Iridescent mother-of-pearl dial with diamond hour markers and astronomical moonphase aperture.', 1, 5, '18k White Gold', 'jewels/jewel4.jpg', 7, '2026-11-08 01:50:26', '2026-11-08 01:50:26'),
(30, 'Medici Lapis Lazuli Cocktail Ring', 1690, 'Cabochon royal-blue lapis lazuli tablet mounted in a bold ribbed 18k gold cocktail setting.', 1, 8, '18k Yellow Gold', 'jewels/jewel1.jpg', 8, '2026-11-08 00:50:26', '2026-11-08 00:50:26'),
(31, 'Cannes London Blue Topaz Statement Ring', 1340, 'Oversized emerald-cut London Blue topaz set in rhodium-plated 925 sterling silver.', 1, 14, '925 Sterling Silver', 'jewels/jewel2.jpg', 8, '2026-11-07 23:50:26', '2026-11-07 23:50:26'),
(32, 'Akoya Cultured Pearl Strand Necklace', 2240, 'Hand-knotted silk strand of matched Japanese Akoya pearls finished with a filigree diamond clasp.', 1, 9, '18k White Gold', 'jewels/jewel3.jpg', 9, '2026-11-07 22:50:26', '2026-11-07 22:50:26'),
(33, 'Bridal Marquise Tiara Hair Comb', 1490, 'Heirloom bridal comb adorned with freshwater pearls and marquise-cut crystal blossoms.', 1, 11, '925 Sterling Silver', 'jewels/jewel-seed-1.jpg', 9, '2026-11-07 21:50:26', '2026-11-07 21:50:26'),
(34, 'Orchid Pavé Botanical Brooch', 1260, 'Sculpted Cattleya orchid brooch celebrating Colombian flora in satin 24k gold vermeil.', 1, 10, '24k Gold Vermeil', 'jewels/jewel2.jpg', 10, '2026-11-07 20:50:26', '2026-11-07 20:50:26'),
(35, 'Art Deco Onyx & Diamond Bar Pin', 1580, 'Geometric calibre-cut black onyx and diamond lapel pin with locking trombone clasp.', 1, 7, '18k White Gold', 'jewels/jewel-seed-3.jpg', 10, '2026-11-07 19:50:26', '2026-11-07 19:50:26'),
(36, 'Obsidian Black Onyx Cushion Signet Ring', 1120, 'Flush-set matte black onyx signet tailored with tapered satin-finished gold shoulders.', 1, 13, '18k Yellow Gold', 'jewels/jewel4.jpg', 11, '2026-11-07 18:50:26', '2026-11-07 18:50:26'),
(37, 'Imperial Archive Emerald Tiara Study', 8900, 'One-of-a-kind exhibition diadem preserved in the private atelier archive.', 2, 1, '18k Yellow Gold', 'jewels/jewel-seed-2.jpg', 12, '2026-11-07 17:50:26', '2026-11-07 17:50:26'),
(38, 'Bespoke Platinum Chronograph Prototype', 9500, 'Numbered horological commission awaiting private client delivery.', 2, 1, '950 Platinum', 'jewels/jewel4.jpg', 12, '2026-11-07 16:50:26', '2026-11-07 16:50:26'),
(39, 'Vault Pink Diamond Collector Solitaire', 7600, 'Seasonal high-jewelry capsule ring currently reserved for private trunk shows.', 2, 2, '18k Rose Gold', 'jewels/jewel3.jpg', 1, '2026-11-07 15:50:26', '2026-11-07 15:50:26'),
(40, 'Royal Heritage Baroque Pearl Sautoir', 4100, 'Opera-length baroque pearl rope temporarily retired for clasp restoration.', 2, 3, '18k Yellow Gold', 'jewels/jewel2.jpg', 9, '2026-11-07 14:50:26', '2026-11-07 14:50:26');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastNames`, `email`, `phoneNumber`, `address`, `status_id`, `role`, `balance`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Atelier Director', 'admin@jeweblrystore.com', '+57 300 410 5248', 'Carrera 35 #8A-19, El Poblado, Medellin', 1, 'admin', 25000, '2026-11-08 23:50:26', '$2y$12$ntoU8V.R2SvD.bwIKpqMuea.KZKEmOztgZruMreY.AueZHHPyqIna', NULL, '2026-11-08 23:50:22', '2026-11-08 23:50:26'),
(2, 'Valentina', 'Montoya Restrepo', 'customer@jeweblrystore.com', '+57 310 684 2190', 'Transversal Superior #12-45, El Poblado, Medellin', 1, 'customer', 18500, '2026-11-08 23:50:26', '$2y$12$vD4VcJObaunDb.X2xfwOceLKnqyqWsyq.j9.ljUosM3Hjmh8YEzWy', NULL, '2026-11-08 23:50:23', '2026-11-08 23:50:26'),
(3, 'Jorge', 'Domínquez Blasco', 'pablo.bermejo@example.com', '+57 379 590 2534', 'Plaça Jorge, 19, Bajo 8º, Usaquen, Bogota', 1, 'customer', 9427.98, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', 'iFgrSob0B5', '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(4, 'María Pilar', 'Cano Moral', 'polanco.anamaria@example.com', '+57 347 662 9119', 'Carrer Mar, 3, 2º, Chapinero Alto, Bogota', 1, 'customer', 3536.95, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', '26oRCxAdBC', '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(5, 'Joel', 'Canales Menéndez', 'guerrero.victor@example.net', '+57 393 753 4964', 'Camiño Quintana, 24, 0º 2º, El Poblado, Medellin', 1, 'customer', 4847.74, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', '0By9QYVGms', '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(6, 'Miguel Ángel', 'Fuentes Domenech', 'collado.aina@example.net', '+57 354 053 5864', 'Rúa Hurtado, 191, 3º A, Laureles, Medellin', 1, 'customer', 10969.43, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', 'QjgTl6m0ZG', '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(7, 'Lucía', 'Soria Serrato', 'gfrias@example.net', '+57 332 898 2885', 'Carrer Abreu, 81, Bajo 7º, Chapinero Alto, Bogota', 1, 'customer', 2527.5, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', 'AeZVErjzQB', '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(8, 'Claudia', 'Malave Torres', 'ariadna.ortiz@example.org', '+57 335 072 5633', 'Rúa Pau, 986, Ático 9º, Laureles, Medellin', 1, 'customer', 10174.8, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', 'dQvE39P9B6', '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(9, 'Beatriz', 'Domenech Carranza', 'leo46@example.com', '+57 337 208 8497', 'Travesía Cristina, 4, 67º 1º, Laureles, Medellin', 1, 'customer', 11757.49, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', 'DtN8fyNHij', '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(10, 'Elena', 'Pardo Rincón', 'adam68@example.com', '+57 384 834 4183', 'Avenida Bonilla, 33, 65º A, Chapinero Alto, Bogota', 1, 'customer', 6180.55, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', 'zD5lhxRG1L', '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(11, 'Andrea', 'Monroy Montañez', 'vera.diego@example.com', '+57 336 360 0432', 'Camino Juan, 7, 39º A, El Poblado, Medellin', 1, 'customer', 2472.19, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', 'bMtzPiTAke', '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(12, 'Eva', 'Requena Muro', 'alexia.beltran@example.org', '+57 354 556 4554', 'Camiño Raquel, 1, 47º F, Usaquen, Bogota', 1, 'customer', 7304.03, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', 'elbelsEeZI', '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(13, 'Asier', 'Conde Tejeda', 'zamora.jorge@example.org', '+57 384 326 9323', 'Carrer Almaráz, 164, 6º A, Envigado, Antioquia', 1, 'customer', 9461.81, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', '8LtRTKCAwm', '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(14, 'Rosario', 'Morán Gómez', 'beatriz95@example.org', '+57 366 690 7344', 'Plaza José Antonio, 1, Entre suelo 8º, El Poblado, Medellin', 1, 'customer', 9014.06, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', 'DxamLqjpYg', '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(15, 'Abril', 'Arriaga Vásquez', 'gpereira@example.com', '+57 345 000 0125', 'Ronda Delgadillo, 7, Ático 5º, Envigado, Antioquia', 1, 'customer', 9963.12, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', 'dGVNsv9UKD', '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(16, 'Alba', 'Rolón Marrero', 'aguado.zoe@example.net', '+57 362 422 4793', 'Rúa Valdés, 7, 50º A, Bocagrande, Cartagena', 1, 'customer', 11901.77, '2026-11-08 23:50:23', '$2y$12$vozVFUfPFew2Vwys8dVPk.lwnig.nGeHch0aT0BDmjhnWzxdze70.', 'v3KaS1EJ8w', '2026-11-08 23:50:23', '2026-11-08 23:50:23');

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status_id`, `total`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 8900, 2, '2026-10-11 23:50:23', '2026-11-08 23:50:24'),
(2, 3, 14830, 2, '2026-10-23 23:50:23', '2026-11-08 23:50:23'),
(3, 3, 6220, 2, '2026-11-01 23:50:23', '2026-11-08 23:50:23'),
(4, 3, 7900, 2, '2026-11-06 23:50:23', '2026-11-08 23:50:23'),
(5, 3, 13250, 5, '2026-11-07 22:18:45', '2026-11-08 23:50:23'),
(6, 4, 4900, 7, '2026-10-26 04:16:20', '2026-11-08 23:50:24'),
(7, 4, 5360, 9, '2026-10-26 20:40:33', '2026-11-08 23:50:24'),
(8, 4, 8260, 10, '2026-10-21 10:44:31', '2026-11-08 23:50:24'),
(9, 4, 3240, 8, '2026-10-01 21:11:09', '2026-11-08 23:50:24'),
(10, 3, 12480, 16, '2026-09-03 11:14:26', '2026-11-08 23:50:24'),
(11, 4, 7840, 4, '2026-09-06 23:28:59', '2026-11-08 23:50:24'),
(12, 3, 6240, 11, '2026-09-12 15:24:10', '2026-11-08 23:50:24'),
(13, 4, 4480, 4, '2026-09-08 11:34:39', '2026-11-08 23:50:24'),
(14, 4, 5830, 7, '2026-09-19 15:06:32', '2026-11-08 23:50:24'),
(15, 4, 5230, 7, '2026-10-18 13:40:11', '2026-11-08 23:50:24'),
(16, 4, 6380, 4, '2026-11-03 16:11:58', '2026-11-08 23:50:24'),
(17, 4, 1740, 2, '2026-10-14 05:43:44', '2026-11-08 23:50:24'),
(18, 4, 2240, 5, '2026-09-08 10:15:01', '2026-11-08 23:50:24'),
(19, 4, 3660, 7, '2026-09-27 18:39:26', '2026-11-08 23:50:24'),
(20, 4, 10570, 7, '2026-10-18 06:38:43', '2026-11-08 23:50:24');

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `quantity`, `unit_price`, `jewel_id`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1620, 3, 1, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(2, 2, 3640, 13, 1, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(3, 2, 4290, 4, 2, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(4, 1, 890, 20, 2, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(5, 2, 2680, 26, 2, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(6, 1, 1740, 23, 3, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(7, 2, 2240, 32, 3, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(8, 1, 3150, 11, 4, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(9, 1, 4750, 12, 4, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(10, 1, 2350, 19, 5, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(11, 2, 5450, 29, 5, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(12, 2, 2450, 2, 6, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(13, 2, 2680, 26, 7, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(14, 2, 1890, 17, 8, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(15, 2, 2240, 32, 8, '2026-11-08 23:50:23', '2026-11-08 23:50:23'),
(16, 2, 1620, 3, 9, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(17, 2, 3490, 8, 10, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(18, 2, 1490, 33, 10, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(19, 2, 1260, 34, 10, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(20, 2, 3920, 9, 11, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(21, 1, 4290, 4, 12, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(22, 1, 1950, 14, 12, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(23, 2, 2240, 32, 13, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(24, 1, 3150, 11, 14, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(25, 2, 1340, 31, 14, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(26, 1, 3490, 8, 15, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(27, 1, 1740, 23, 15, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(28, 1, 3150, 11, 16, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(29, 1, 1740, 23, 16, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(30, 1, 1490, 33, 16, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(31, 1, 1740, 23, 17, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(32, 2, 1120, 36, 18, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(33, 1, 1420, 24, 19, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(34, 1, 2240, 32, 19, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(35, 2, 1780, 6, 20, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(36, 1, 1560, 25, 20, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(37, 1, 5450, 29, 20, '2026-11-08 23:50:24', '2026-11-08 23:50:24');

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `method`, `status_id`, `date`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 8900, 'balance', 4, '2026-09-29', 1, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(2, 1740, 'balance', 4, '2026-10-04', 17, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(3, 10570, 'balance', 4, '2026-10-02', 20, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(4, 7840, 'credit_card', 4, '2026-11-07', 11, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(5, 4900, 'balance', 4, '2026-10-01', 6, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(6, 3660, 'paypal', 4, '2026-10-28', 19, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(7, 4480, 'paypal', 4, '2026-09-12', 13, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(8, 8260, 'paypal', 4, '2026-10-13', 8, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(9, 2240, 'balance', 4, '2026-09-20', 18, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(10, 3240, 'credit_card', 4, '2026-10-07', 9, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(11, 5830, 'credit_card', 4, '2026-10-10', 14, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(12, 5230, 'paypal', 4, '2026-10-03', 15, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(13, 6380, 'debit_card', 4, '2026-10-12', 16, '2026-11-08 23:50:24', '2026-11-08 23:50:24'),
(14, 5360, 'credit_card', 4, '2026-10-08', 7, '2026-11-08 23:50:24', '2026-11-08 23:50:24');

COMMIT;

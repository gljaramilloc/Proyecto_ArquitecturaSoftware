-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 15, 2026 at 03:07 PM
-- Server version: 8.0.44
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Activo', '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(2, 'Inactivo', '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(3, 'Pendiente', '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(4, 'Aprobado', '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(5, 'Rechazado', '2026-09-15 19:49:16', '2026-09-15 19:49:16');

--

-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `slug`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 'Distinctio ipsa', 'Quis non qui optio ut et autem asperiores.', 'distinctio-ipsa', 1, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(2, 'Sed pariatur', 'Itaque dicta sed sunt quis alias eum.', 'sed-pariatur', 1, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(3, 'Facere earum', 'Earum deserunt temporibus in sit sed nemo.', 'facere-earum', 1, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(4, 'Officia eos', 'Maiores possimus libero provident qui qui aut occaecati.', 'officia-eos', 1, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(5, 'Sequi quas', 'Nostrum ullam a officiis libero.', 'sequi-quas', 1, '2026-09-15 19:49:16', '2026-09-15 19:49:16');

--

-- Dumping data for table `jewels`
--

INSERT INTO `jewels` (`id`, `name`, `price`, `description`, `status_id`, `stock`, `material`, `image`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'non sit beatae', 83.90, 'Repellat inventore deleniti provident quam.', 1, 23, 'Gold', 'placeholder.jpg', 3, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(2, 'laudantium id autem', 1564.39, 'Quisquam voluptatibus quibusdam neque ut aut quibusdam voluptatibus.', 1, 35, 'Gold', 'placeholder.jpg', 3, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(3, 'quae qui ratione', 965.23, 'Labore sed est molestias repellat sunt voluptas.', 1, 30, 'Gold', 'placeholder.jpg', 5, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(4, 'voluptatem modi similique', 752.48, 'Suscipit inventore porro odit perferendis ut ut.', 1, 0, 'Gold', 'placeholder.jpg', 2, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(5, 'iusto eligendi et', 839.72, 'Ut dolor tenetur esse vel aperiam libero dolor aut.', 1, 4, 'Platinum', 'placeholder.jpg', 1, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(6, 'rerum quisquam delectus', 186.56, 'Maiores sed odit sunt et asperiores libero.', 1, 8, 'Rose Gold', 'placeholder.jpg', 3, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(7, 'et voluptas in', 1060.95, 'Ipsum reiciendis sed dolore recusandae recusandae.', 1, 47, 'Platinum', 'placeholder.jpg', 3, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(8, 'animi autem ullam', 1843.43, 'Quisquam explicabo tempore odio voluptatem.', 1, 39, 'Gold', 'placeholder.jpg', 1, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(9, 'voluptatem sit et', 1610.24, 'Nulla consequatur ut laborum autem voluptate.', 1, 2, 'Silver', 'placeholder.jpg', 2, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(10, 'dolore rerum nisi', 391.24, 'Aut suscipit cum iure.', 1, 8, 'Rose Gold', 'placeholder.jpg', 4, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(11, 'accusamus quisquam qui', 658.18, 'Illum fugit assumenda aut porro recusandae.', 1, 8, 'Platinum', 'placeholder.jpg', 1, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(12, 'explicabo architecto et', 1473.57, 'Adipisci non minus voluptatem quo enim ut.', 1, 41, 'Gold', 'placeholder.jpg', 3, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(13, 'qui ipsum deserunt', 1154.49, 'Perferendis ea tempore a officiis.', 1, 24, 'Silver', 'placeholder.jpg', 5, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(14, 'fugit numquam et', 1309.95, 'Deleniti dignissimos quasi a totam rem quae.', 1, 32, 'Platinum', 'placeholder.jpg', 4, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(15, 'qui corrupti molestiae', 1472.20, 'Maxime eligendi eos esse officia voluptas ipsam accusamus.', 1, 10, 'Rose Gold', 'placeholder.jpg', 5, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(16, 'fuga dolorum atque', 1042.60, 'Inventore quos maxime provident non reprehenderit in ut eveniet.', 1, 26, 'Platinum', 'placeholder.jpg', 5, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(17, 'consequuntur ut perspiciatis', 1449.87, 'Eum et aliquam et.', 1, 20, 'Platinum', 'placeholder.jpg', 2, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(18, 'rerum in soluta', 235.41, 'Error eius possimus voluptatum perferendis occaecati est.', 1, 40, 'Silver', 'placeholder.jpg', 4, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(19, 'architecto rerum rem', 573.41, 'Aut aspernatur officiis quia aut sint.', 1, 3, 'Gold', 'placeholder.jpg', 3, '2026-09-15 19:49:16', '2026-09-15 19:49:16'),
(20, 'voluptas quis deleniti', 1297.70, 'Perferendis explicabo ea error qui ut aliquam.', 1, 31, 'Silver', 'placeholder.jpg', 2, '2026-09-15 19:49:16', '2026-09-15 19:49:16');

--

-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastNames`, `email`, `phoneNumber`, `address`, `status_id`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Eula', 'Kihn', 'thegmann@example.com', '(801) 402-2367', '9595 Arno River Suite 972\nEast Jovaniview, AL 65691-6983', 1, 'customer', '2026-09-15 19:49:16', '$2y$12$JSQbo1DapmqPZmYbQDzEYOJXBM39YpfC24cf3BGetSc7i.zKpkJCq', 'EWgEVP0Yr9', '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(2, 'Dominic', 'Bradtke', 'jeanne.bernhard@example.com', '984.553.8508', '5668 Keara Crest Suite 186\nErnestostad, TX 87409-4079', 1, 'customer', '2026-09-15 19:49:17', '$2y$12$JSQbo1DapmqPZmYbQDzEYOJXBM39YpfC24cf3BGetSc7i.zKpkJCq', 'OQG9ZAHruM', '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(3, 'Mona', 'Kuhn', 'vickie.cummings@example.com', '1-949-957-1271', '676 Donavon Island Apt. 056\nNorth Christop, IN 22394-3681', 1, 'customer', '2026-09-15 19:49:17', '$2y$12$JSQbo1DapmqPZmYbQDzEYOJXBM39YpfC24cf3BGetSc7i.zKpkJCq', '07XV0EiXEs', '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(4, 'Dallin', 'Romaguera', 'klein.oscar@example.org', '+1 (385) 236-9991', '73997 Bins Neck Apt. 435\nEast Ima, GA 88090', 1, 'customer', '2026-09-15 19:49:17', '$2y$12$JSQbo1DapmqPZmYbQDzEYOJXBM39YpfC24cf3BGetSc7i.zKpkJCq', 'GvlR5AEbLI', '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(5, 'Janick', 'Bartoletti', 'colin.king@example.com', '(929) 760-3351', '2781 Toy Gardens\nEast Romanmouth, KS 97018-8238', 1, 'customer', '2026-09-15 19:49:17', '$2y$12$JSQbo1DapmqPZmYbQDzEYOJXBM39YpfC24cf3BGetSc7i.zKpkJCq', 'LPWaV7Rj1O', '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(6, 'Lenore', 'Okuneva', 'maritza.oconnell@example.com', '+1.531.395.3459', '753 Jamie Stravenue Suite 986\nNorth Rod, DE 10638-5809', 1, 'customer', '2026-09-15 19:49:17', '$2y$12$JSQbo1DapmqPZmYbQDzEYOJXBM39YpfC24cf3BGetSc7i.zKpkJCq', 'QrFB5aNHCu', '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(7, 'Bertha', 'Schuster', 'dandre19@example.com', '(872) 838-3030', '399 Turcotte Corner Apt. 106\nLake Richmondmouth, AZ 59651-5963', 1, 'customer', '2026-09-15 19:49:17', '$2y$12$JSQbo1DapmqPZmYbQDzEYOJXBM39YpfC24cf3BGetSc7i.zKpkJCq', 'lXw3DD3WtA', '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(8, 'London', 'Eichmann', 'qoconnell@example.net', '+1.878.500.7355', '4874 Brown Groves\nLake Geoffrey, SD 20551-0811', 1, 'customer', '2026-09-15 19:49:17', '$2y$12$JSQbo1DapmqPZmYbQDzEYOJXBM39YpfC24cf3BGetSc7i.zKpkJCq', 'fRSYLuJGWx', '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(9, 'Millie', 'Hamill', 'sydnie.frami@example.com', '(463) 945-9887', '68619 Norene Way Apt. 903\nLake Ninaton, WI 87230', 1, 'customer', '2026-09-15 19:49:17', '$2y$12$JSQbo1DapmqPZmYbQDzEYOJXBM39YpfC24cf3BGetSc7i.zKpkJCq', 'toLZVgeTwc', '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(10, 'Brenda', 'Reilly', 'asha.hintz@example.net', '1-463-973-9796', '925 Fisher Prairie\nWest Deshawnfurt, TX 02981', 1, 'customer', '2026-09-15 19:49:17', '$2y$12$JSQbo1DapmqPZmYbQDzEYOJXBM39YpfC24cf3BGetSc7i.zKpkJCq', 'siq67n4FKu', '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(11, 'Admin', 'Test', 'admin@jeweblrystore.com', '1-404-410-5248', '98495 Dicki Ports Apt. 148\nAlfredview, WI 97691-4039', 1, 'admin', '2026-09-15 19:49:17', '$2y$12$JSQbo1DapmqPZmYbQDzEYOJXBM39YpfC24cf3BGetSc7i.zKpkJCq', 'EbJzofJJm2hUnEpnOmBDiDSyfM0QTHmRkBnKUoYUnqqav1jt2nEcgUOLb52V', '2026-09-15 19:49:17', '2026-09-15 19:49:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_status_id_foreign` (`status_id`);

--
-- Indexes for table `jewels`
--
ALTER TABLE `jewels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jewels_status_id_foreign` (`status_id`),
  ADD KEY `jewels_category_id_foreign` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_status_id_foreign` (`status_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_jewel_id_foreign` (`jewel_id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_order_id_unique` (`order_id`),
  ADD KEY `payments_status_id_foreign` (`status_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `statuses_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_status_id_foreign` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jewels`
--
ALTER TABLE `jewels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `jewels`
--
ALTER TABLE `jewels`
  ADD CONSTRAINT `jewels_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `jewels_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_jewel_id_foreign` FOREIGN KEY (`jewel_id`) REFERENCES `jewels` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status_id`, `total`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3686.86, 5, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(2, 1, 1146.82, 3, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(3, 1, 5614.33, 11, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(4, 1, 6194.48, 9, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(5, 1, 19214.71, 9, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(6, 1, 13618.47, 5, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(7, 1, 3762.40, 8, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(8, 1, 1309.95, 8, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(9, 1, 12990.71, 3, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(10, 1, 3762.40, 4, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(11, 1, 1900.67, 1, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(12, 1, 7728.65, 11, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(13, 1, 470.82, 8, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(14, 1, 3822.68, 6, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(15, 1, 573.41, 7, '2026-09-15 19:49:17', '2026-09-15 19:49:17');

--

-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `quantity`, `unitPrice`, `jewel_id`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1843.43, 8, 1, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(2, 2, 573.41, 19, 2, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(3, 1, 1473.57, 12, 3, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(4, 2, 1610.24, 9, 3, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(5, 1, 752.48, 4, 3, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(6, 2, 83.90, 1, 3, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(7, 1, 1042.60, 16, 4, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(8, 3, 839.72, 5, 4, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(9, 4, 658.18, 11, 4, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(10, 5, 1472.20, 15, 5, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(11, 5, 1449.87, 17, 5, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(12, 2, 1042.60, 16, 5, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(13, 3, 839.72, 5, 5, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(14, 5, 83.90, 1, 6, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(15, 3, 1472.20, 15, 6, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(16, 5, 1154.49, 13, 6, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(17, 4, 752.48, 4, 6, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(18, 5, 752.48, 4, 7, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(19, 1, 1309.95, 14, 8, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(20, 5, 1309.95, 14, 9, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(21, 4, 1610.24, 9, 9, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(22, 5, 752.48, 4, 10, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(23, 1, 1060.95, 7, 11, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(24, 1, 839.72, 5, 11, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(25, 5, 1154.49, 13, 12, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(26, 5, 391.24, 10, 12, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(27, 2, 235.41, 18, 13, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(28, 2, 1060.95, 7, 14, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(29, 1, 658.18, 11, 14, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(30, 1, 1042.60, 16, 14, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(31, 1, 573.41, 19, 15, '2026-09-15 19:49:17', '2026-09-15 19:49:17');

--

-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `method`, `status_id`, `date`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 1146.82, 'paypal', 1, '2026-08-10', 2, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(2, 3762.40, 'paypal', 1, '2026-09-15', 10, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(3, 470.82, 'credit_card', 1, '2026-08-29', 13, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(4, 6194.48, 'paypal', 1, '2026-08-07', 4, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(5, 19214.71, 'paypal', 1, '2026-07-28', 5, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(6, 3686.86, 'paypal', 1, '2026-08-17', 1, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(7, 12990.71, 'credit_card', 1, '2026-09-15', 9, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(8, 3762.40, 'credit_card', 1, '2026-08-08', 7, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(9, 13618.47, 'debit_card', 1, '2026-08-31', 6, '2026-09-15 19:49:17', '2026-09-15 19:49:17'),
(10, 573.41, 'credit_card', 1, '2026-06-28', 15, '2026-09-15 19:49:17', '2026-09-15 19:49:17');

--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2022 at 09:58 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afrib_design`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `country`, `city`, `state`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Ghana (+233)', 'Sint nulla ex non c', 'Aut consequuntur inv', NULL, '2022-02-28 05:56:11', '2022-02-28 05:56:11'),
(2, 'Monaco (+377)', 'Minima tempore duis', 'Non totam dolore fac', NULL, '2022-02-26 11:02:32', '2022-02-26 11:02:32'),
(3, 'Argentina (+54)', 'Consectetur rerum i', 'Impedit deserunt de', NULL, '2022-02-26 11:02:37', '2022-02-26 11:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `story` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_draft` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `title`, `category_id`, `location_id`, `story`, `user_id`, `status`, `slug`, `is_draft`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Swimming on the Islands', '2', '3', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit, tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam recusandae alias error harum maxime adipisci amet laborum. Perspiciatis minima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit</p>', 6, 1, 'swimming-on-the-islands', 0, 'storage/property/A0Mq7XoKg1KSpOiudPcxJYBl3Wb1WftfgSL78aOZ.png', '2022-02-26 08:45:40', '2022-03-02 03:30:23'),
(4, 'Anim eum voluptatem', '1', '2', '<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam eius ullam odit asperiores cupiditate commodi eaque saepe rem, omnis esse debitis tenetur consequuntur, labore exercitationem adipisci beatae maxime necessitatibus quos!</p>\r\n\r\n<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam eius ullam odit asperiores cupiditate commodi eaque saepe rem, omnis esse debitis tenetur consequuntur, labore exercitationem adipisci beatae maxime necessitatibus quos!</p>', 6, 1, 'anim-eum-voluptatem', 0, 'storage/story_images/RiErHKsjSgrgFzQjKNog48J7a7YKoGvHq0Dl5QPm.jpg', '2022-03-09 00:10:34', '2022-03-09 06:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `story_categories`
--

CREATE TABLE `story_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `story_categories`
--

INSERT INTO `story_categories` (`id`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Brock Hicks', 'Doloribus qui dolore', 'brock-hicks', '2022-02-26 09:21:48', '2022-02-26 09:21:48'),
(2, 'Duncan Mcfarland', 'Beatae voluptate seq', 'duncan-mcfarland', '2022-02-26 09:22:00', '2022-02-26 09:22:00'),
(3, 'Nina Flynn', 'Laboriosam officiis', 'nina-flynn', '2022-02-26 09:22:07', '2022-02-26 09:22:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `role`, `link`, `image`, `created_at`) VALUES
(1, 'Keelie Wilcox', 'wilcox662', 'keelie@mailinator.com', '$2y$10$H73qGw/Cebto6BMJBIQgxO/bwOYegbpBu9Vvt1Qxr32MbXnrtqNy6', 0, 'http://127.0.0.1:8000/account/access/wilcox-662', 'storage/profile/JBCkjVlW0EloXvxZHhSCljGMT2LtIKIvnhKQh152.png', '2022-02-26 07:29:28'),
(3, 'Admin User', 'user391', 'admin@admin.com', '$2y$10$QJfoR/KUe7g0QvBpJSFhAOk/faYcqcRpO5gQX.oP8BGmxyTNn1oZ6', 1, 'http://127.0.0.1:8000/account/access/user-391', NULL, '2022-03-02 02:45:38'),
(4, 'Jaime Wheeler', 'wheeler647', 'medabam@mailinator.com', '$2y$10$giSHL92Q1N1ypPG14pmpLe2jD1O7L.lN.u81k2l1DUPdJ3BdjASfO', 0, 'http://127.0.0.1:8000/account/access/wheeler-647', NULL, '2022-03-09 06:46:14'),
(5, 'Naomi Ruiz', 'naomi-801', 'qabydi@mailinator.com', '$2y$10$2VrU7d6H6uKcGuc6BKD.O.fi0EB6N1QS/E5mKqC0ptbCrKW2zWWSe', 0, 'http://localhost:8080?page=user-dashboard&access=naomi801', NULL, '2022-03-26 23:00:00'),
(6, 'Xantha Rowland', 'xantha982', 'tosopiwu@mailinator.com', '$2y$10$F3bDJWzZK4zAfdUPKcUcSO3zg9C8hrau2LY4SSlx9kYt59BO9hxES', 0, 'http://localhost:8080?page=user_dashboard&access=xantha982', NULL, '2022-03-26 23:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `story_categories`
--
ALTER TABLE `story_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `story_categories`
--
ALTER TABLE `story_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

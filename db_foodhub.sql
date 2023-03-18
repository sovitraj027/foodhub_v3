-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2023 at 04:49 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_foodhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `category_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Snacks', 'snacks', '1678151868.jfif', 1, '2023-03-06 19:20:40', '2023-03-06 19:20:40'),
(2, 'Breakfast', 'breakfast', '1678161428.jpg', 1, '2023-03-06 19:20:40', '2023-03-06 19:20:40'),
(3, 'Lunch', 'lunch', '1678151413.jpeg', 1, '2023-03-06 19:20:40', '2023-03-06 19:20:40'),
(4, 'Momo', 'momo', '1678151426.jfif', 1, '2023-03-06 19:20:40', '2023-03-06 19:20:40'),
(5, 'Pizza', 'pizza', '1678153724.jpeg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_orders`
--

CREATE TABLE `delivery_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `delivery_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_time` time NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_status` tinyint(4) NOT NULL,
  `esewa_status` tinyint(4) NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `product_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_orders`
--

INSERT INTO `delivery_orders` (`id`, `user_id`, `delivery_location`, `delivery_time`, `type`, `status`, `paid_status`, `esewa_status`, `quantity`, `price`, `package_id`, `item_id`, `product_id`, `created_at`, `updated_at`) VALUES
(17, 5, 'NHv3gg8sAA', '12:05:00', 'package', 'Processing', 0, 0, '1', '300', 2, NULL, NULL, '2023-03-16 11:30:50', '2023-03-16 11:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Vegetarian',
  `menu_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `menu_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_name`, `menu_type`, `menu_description`, `price`, `menu_image`, `category_id`, `status`) VALUES
(1, 'Sandwich', 'Vegetarian', 'Veg Sandwich', 100, '1678153023.jpeg', 2, 1),
(2, 'Loaded Pancake Tacos', 'Non Vegetarian', 'Loaded Pancake Tacos', 120, '1678152750.jpg', 2, 1),
(3, 'Fluffy Pancakes', 'Non Vegetarian', 'Fluffy Pancakes', 120, '1678152579.jpg', 2, 1),
(4, 'Roasted Hash and Jammy Eggs', 'Non Vegetarian', 'Roasted Hash and Jammy Eggs', 130, '1678152883.jpg', 2, 1),
(7, 'Veg Momo', 'Vegetarian', 'Veg Momo', 140, '1678153044.jpg', 4, 1),
(8, 'Veg thali', 'Vegetarian', 'Veg thali includes rice, veggies, lentils, and cutneys', 240, '1678153081.jpg', 3, 1),
(10, 'Mushroom Kebab', 'Vegan', 'Fresh Japanese Mushrooms', 520, '1678152836.jpg', 1, 1),
(11, 'Fruit Salad', 'Vegan', 'Varieties of seasonal fruits', 160, '1678152707.jpg', 1, 1),
(12, 'Buff Momo', 'Non Vegetarian', 'Buff Momo', 130, '1678152099.jfif', 4, 1),
(13, 'Chicken Momo', 'Non Vegetarian', 'Chicken Momo', 140, '1678152182.jpg', 4, 1),
(14, 'Chicken thali', 'Non Vegetarian', 'Chicken thali includes rice, veggies, chicken, lentils, and cutneys', 320, '1678152278.jpeg', 3, 1),
(15, 'chiken pizza', 'Non Vegetarian', 'chiken pizza', 500, '1678153777.jpeg', 5, 0),
(16, 'Mushroom Pizza', 'Vegetarian', 'mushroom pizza', 350, '1678153840.png', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_package`
--

CREATE TABLE `menu_package` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_package`
--

INSERT INTO `menu_package` (`id`, `menu_id`, `package_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(3, 7, 1, NULL, NULL),
(4, 2, 2, NULL, NULL),
(5, 4, 2, NULL, NULL),
(10, 10, 3, NULL, NULL),
(11, 11, 3, NULL, NULL),
(13, 13, 4, NULL, NULL),
(14, 14, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_01_016_050539_create_categories_table', 1),
(3, '2023_01_01_051949_create_restaurant_order_table', 1),
(4, '2023_01_01_052459_create_restaurant_review_table', 1),
(5, '2023_01_01_053529_create_widgets_table', 1),
(6, '2023_01_06_052824_create_restaurant_types_table', 1),
(7, '2023_02_01_051123_create_restaurants_table', 1),
(8, '2023_02_01_053018_create_settings_table', 1),
(9, '2023_02_01_100000_create_password_resets_table', 1),
(10, '2023_02_06_045158_create_cart_table', 1),
(11, '2023_02_09_050801_create_menus_table', 1),
(12, '2023_02_18_040732_create_packages_table', 1),
(13, '2023_02_18_060908_create_subscriptions_table', 1),
(14, '2023_02_18_112319_create_menu_package_table', 1),
(15, '2023_02_25_115928_add_column_to_subscriptions', 1),
(16, '2023_03_02_154313_create_delivery_orders_table', 1),
(17, '2023_03_04_141124_add_column_to_delivery_order_table', 1),
(18, '2023_2_12_000000_create_users_table', 1),
(19, '2023_03_07_083930_add_column_to_settings_table', 2),
(20, '2023_03_07_084138_add_column_to_users_table', 2),
(21, '2023_03_16_164759_add_days_column_in_subscription_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Vegetarian',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `image`, `type`, `status`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Veg Platter', 'This is a veg snacks package', '1678153632.jpg', 'Vegetarian', 1, 200.00, '2023-03-06 19:20:40', '2023-03-06 20:02:12'),
(2, 'Non Veg Platter', 'This is a non veg package', '1678153375.jpg', 'Non Vegetarian', 1, 300.00, '2023-03-06 19:20:40', '2023-03-06 19:57:55'),
(3, 'Vegan Platter', 'This is a vegan snacks package', '1678153673.jpg', 'Vegan', 1, 100.00, '2023-03-06 19:20:40', '2023-03-06 20:02:53'),
(4, 'Non Veg Khaja Set', 'This is set includes newari khaja items', '1678153610.jfif', 'Non Vegetarian', 1, 250.00, '2023-03-06 19:20:40', '2023-03-06 20:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_type` int(11) NOT NULL,
  `restaurant_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restaurant_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_charge` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restaurant_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `restaurant_bg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_monday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_tuesday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_wednesday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_thursday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_friday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_saturday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_sunday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_avg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_order`
--

CREATE TABLE `restaurant_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `esewa_status` tinyint(100) NOT NULL DEFAULT 0,
  `cash_status` tinyint(100) NOT NULL DEFAULT 0,
  `product_id` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_order`
--

INSERT INTO `restaurant_order` (`id`, `user_id`, `item_id`, `item_name`, `item_price`, `quantity`, `created_date`, `status`, `esewa_status`, `cash_status`, `product_id`) VALUES
(71, 1, 1, 'Sandwich', 100, 1, 1678126500, 'Pending', 1, 0, '6406ae9f403a5'),
(72, 1, 8, 'Veg thali', 240, 1, 1678126500, 'Pending', 1, 0, '6406b59207c16'),
(73, 1, 8, 'Veg thali', 240, 1, 1678126500, 'Pending', 0, 1, '6406c0527a8ac'),
(74, 1, 8, 'Veg thali', 240, 1, 1678126500, 'Pending', 0, 1, '640706525cb04'),
(75, 1, 1, 'Sandwich', 100, 1, 1678126500, 'Pending', 0, 1, '6407119302479'),
(76, 1, 8, 'Veg thali', 240, 1, 1678126500, 'Pending', 0, 1, '64071196320d4'),
(77, 5, 1, 'Sandwich', 100, 1, 1678126500, 'Pending', 0, 1, '64077206a4a57');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_review`
--

CREATE TABLE `restaurant_review` (
  `id` int(10) UNSIGNED NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `food_quality` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `punctuality` int(11) NOT NULL,
  `courtesy` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_types`
--

CREATE TABLE `restaurant_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_favicon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_header_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_footer_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_copyright` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addthis_share_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disqus_comment_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_comment_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_slide_image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_slide_image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_slide_image3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_bg_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_restaurant` int(11) DEFAULT NULL,
  `total_people_served` int(11) DEFAULT NULL,
  `total_registered_users` int(11) DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `currency_symbol`, `site_email`, `site_logo`, `site_favicon`, `site_description`, `site_header_code`, `site_footer_code`, `site_copyright`, `addthis_share_code`, `disqus_comment_code`, `facebook_comment_code`, `home_slide_image1`, `home_slide_image2`, `home_slide_image3`, `page_bg_image`, `total_restaurant`, `total_people_served`, `total_registered_users`, `longitude`, `latitude`) VALUES
(1, 'Cloud Kitchen', 'Rs', 'admin@admin.com', 'logo.png', 'favicon.png', 'Cloud Kitchen - Food Delivery Script Cloud Kitchen - Food Delivery is an laravel script for Delivery Restaurants', NULL, NULL, 'Copyright © 2023 Cloud Kitchen - Food Delivery Script. All Rights Reserved.', NULL, NULL, NULL, 'home_slide_image1.png', 'home_slide_image2.png', 'home_slide_image3.png', 'page_bg_image.png', 2550, 5355, 12454, '85.342049', '27.69152');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscription_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Weekly',
  `subscribed_from` date NOT NULL DEFAULT '2023-03-07',
  `subscribed_to` date DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `days` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `subscription_type`, `subscribed_from`, `subscribed_to`, `is_paid`, `user_id`, `package_id`, `delivery_time`, `created_at`, `updated_at`, `days`) VALUES
(10, 'Weekly', '2023-03-15', '2023-03-22', 0, 5, 2, '12:05:00', '2023-03-16 11:30:50', '2023-03-16 11:31:44', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `usertype` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `first_name`, `last_name`, `email`, `password`, `image_icon`, `mobile`, `address`, `city`, `postal_code`, `remember_token`, `created_at`, `updated_at`, `longitude`, `latitude`) VALUES
(1, 'Admin', 'Gaurav', 'Pandey', 'developer.ultrabyte@gmail.com', '$2y$10$aTOgauPm91o/.CkKsA12ZO0qXF75xfoC0rKHBvUu1txv97MkI2vr.', '1678158434.jpg', '981100232', 'afaffa', 'dfdsf', 'afadsff', NULL, '2023-03-06 19:20:39', '2023-03-07 03:16:06', '85.353674', '27.71678'),
(2, 'User', 'sovit', 'rajbanshi', 'rajbanshisovit027@gmail.com', '$2y$10$dbHKPJwr2ZiReDjGMATMAu7ApEjRWm8lB/Kb2GYGtbhJYWJ1VAkkW', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-07 02:19:23', '2023-03-07 02:19:23', '27.06', '87.06'),
(3, 'delivery_staff', 'test', 'raj', 'test@mail.com', '$2y$10$Tps.dQHIvH0If1rosRG.8u429r77x4HpiUCPCZXHuG4X6RJ6HVj0i', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-07 03:33:54', '2023-03-11 04:35:33', '85.322984', '27.703731'),
(5, 'User', 'sovit', 'Rajbanshi', 'sovit@mail.com', '$2y$10$m6k8q4gjgEGEMG8wiiVPjuahebFPsREsqprQ3E.ZLN.G1ZoIiqsG.', NULL, '9816397027', 'NHv3gg8sAA', 'VCSLuvEyRp', 'GRfU2khuvz', NULL, '2023-03-07 04:10:42', '2023-03-07 04:10:42', '27.06', '87.06');

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `id` int(10) UNSIGNED NOT NULL,
  `footer_widget1_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget1_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget2_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget2_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget3_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget3_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget3_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_widget3_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_google` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_pinterest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_vimeo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `need_help_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `need_help_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `need_help_time` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_advertise` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `footer_widget1_title`, `footer_widget1_desc`, `footer_widget2_title`, `footer_widget2_desc`, `footer_widget3_title`, `footer_widget3_address`, `footer_widget3_phone`, `footer_widget3_email`, `about_title`, `about_desc`, `social_facebook`, `social_twitter`, `social_google`, `social_instagram`, `social_pinterest`, `social_vimeo`, `social_youtube`, `need_help_title`, `need_help_phone`, `need_help_time`, `sidebar_advertise`) VALUES
(1, 'About Restaurant', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Recent Tweets', '', 'Contact Info', 'Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing', '+01 123 456 78', 'demo@example.com', 'About Us', 'Aenean ultricies mi vitae est. Mauris placerat eleifend leosit amet est.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Need Help?', '+61 3 8376 6284', 'Monday to Friday 9.00am - 7.30pm', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_orders`
--
ALTER TABLE `delivery_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_package`
--
ALTER TABLE `menu_package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_package_menu_id_foreign` (`menu_id`),
  ADD KEY `menu_package_package_id_foreign` (`package_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_order`
--
ALTER TABLE `restaurant_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_review`
--
ALTER TABLE `restaurant_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_types`
--
ALTER TABLE `restaurant_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `delivery_orders`
--
ALTER TABLE `delivery_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menu_package`
--
ALTER TABLE `menu_package`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant_order`
--
ALTER TABLE `restaurant_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `restaurant_review`
--
ALTER TABLE `restaurant_review`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant_types`
--
ALTER TABLE `restaurant_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_package`
--
ALTER TABLE `menu_package`
  ADD CONSTRAINT `menu_package_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_package_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

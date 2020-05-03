-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 02, 2020 at 03:50 PM
-- Server version: 5.7.29-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-27+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Bosla`
--

-- --------------------------------------------------------

--
-- Table structure for table `building_types`
--

CREATE TABLE `building_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `building_types`
--

INSERT INTO `building_types` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'مبنى 1', 'Building 1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_ar` longtext COLLATE utf8mb4_unicode_ci,
  `desc_en` longtext COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `name_ar`, `name_en`, `desc_ar`, `desc_en`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 'uploads/categroies/20200407085622-image.jpeg', 'قسم جديدs', 'new cats', 'قسم جديدقسم جديدقسم جديد', 'new catnew catnew cat', 0, '2020-04-07 05:45:23', '2020-04-07 07:04:26'),
(2, 'uploads/categroies/20200407090614-image.jpeg', 'Egypt', 'eded', '$request->is_featured = \'on\' ? 1 : 0;', '$request->is_featured = \'on\' ? 1 : 0;', 1, '2020-04-07 07:06:14', '2020-04-07 07:17:51');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 1, 'الدمام', 'Dammam', '2020-03-08 12:43:45', '2020-03-08 12:43:45'),
(2, 2, 'Egypt', 'Egypt', '2020-03-09 10:13:18', '2020-03-09 10:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avg_rate` int(11) NOT NULL DEFAULT '0',
  `device_token` longtext COLLATE utf8mb4_unicode_ci,
  `mobile_verify_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `mobile`, `mobile_code`, `password`, `country_id`, `city_id`, `address`, `lat`, `lng`, `image`, `avg_rate`, `device_token`, `mobile_verify_at`, `created_at`, `updated_at`) VALUES
(2, 'New Client Name', '00110011', '86563', '$2y$10$boEm9NvWRKibNoInUQyG6eXemg0VZg/PaFXsNPYAYJQfFB4PN9mH6', 2, 2, 'Cairo', '10', '10', 'uploads/clients/20200501190829-image2.jpeg', 0, NULL, NULL, '2020-05-01 17:08:29', '2020-05-01 17:08:29');

-- --------------------------------------------------------

--
-- Table structure for table `clients_messages`
--

CREATE TABLE `clients_messages` (
  `id` int(11) NOT NULL,
  `message_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client_ratings`
--

CREATE TABLE `client_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `review` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name_ar`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'السعودية', 'KSA', '2020-03-08 12:43:45', '2020-03-08 12:43:45'),
(2, 'مصر', 'Egypt', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `custmor_supports`
--

CREATE TABLE `custmor_supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` enum('client','provider') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `from_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `to_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `favable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_03_01_134620_create_countries_table', 1),
(4, '2020_03_01_135352_create_cities_table', 1),
(5, '2020_03_01_141859_create_categories_table', 1),
(6, '2020_03_02_134620_create_clients_table', 1),
(7, '2020_03_02_140706_create_news_table', 1),
(8, '2020_03_02_140823_create_settings_table', 1),
(9, '2020_03_02_141428_create_providers_table', 1),
(10, '2020_03_02_142549_create_client_ratings_table', 1),
(11, '2020_03_02_142821_create_provider_ratings_table', 1),
(12, '2020_03_02_142927_create_services_table', 1),
(13, '2020_03_02_143115_create_sub_services_table', 1),
(14, '2020_03_02_143152_create_products_table', 1),
(15, '2020_03_02_143529_create_service_providers_table', 1),
(16, '2020_03_02_144015_create_favourites_table', 1),
(17, '2020_03_02_144706_create_bulding_types_table', 1),
(18, '2020_03_02_144755_create_orders_table', 1),
(19, '2020_03_02_145128_create_images_table', 1),
(20, '2020_03_02_145258_create_time_periods_table', 1),
(21, '2020_03_02_145441_create_order_comments_table', 1),
(22, '2020_03_02_145722_create_custmor_supports_table', 1),
(23, '2020_03_02_145845_create_packages_table', 1),
(24, '2020_03_03_073831_create_package_payments_table', 1),
(25, '2020_03_03_074113_create_payments_table', 1),
(26, '2020_03_03_074531_create_transactions_table', 1),
(27, '2020_03_03_074654_create_promocodes_table', 1),
(28, '2020_03_04_121154_create_providers_branches_table', 1),
(29, '2020_03_16_092411_create_user_notifications_table', 2),
(30, '2020_03_16_113616_add_number_of_branches_to_providers_table', 2),
(31, '2020_03_17_124709_add_column_is_confirmed_transactions_table', 2),
(32, '2020_03_17_130458_edit_column_promocode_id_package_payments_table', 2),
(33, '2020_03_18_121226_add_column_total_orders_table', 3),
(34, '2020_03_18_123434_edit_column_product_id_orders_table', 3),
(35, '2020_03_18_130501_add_column_client_id_orders_table', 3),
(39, '2020_03_18_133945_add_columns_cancel_orders_table', 4),
(40, '2020_03_19_113424_add_columns_parent_id_customer_support', 4),
(41, '2020_04_05_134910_add_columns_order_comments_table', 4),
(42, '2020_04_09_112624_add_columns_image_users_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_ar` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_en` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `image`, `title_ar`, `title_en`, `desc_ar`, `desc_en`, `created_at`, `updated_at`) VALUES
(1, 'uploads/news/20200316085556-image.jpeg', 'ergerg', 'ergerg', 'sdbsdbsb', 'gbdsgb', '2020-03-16 06:55:41', '2020-03-16 06:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `sub_service_id` int(10) UNSIGNED NOT NULL,
  `building_type_id` int(10) UNSIGNED DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_period_id` int(10) UNSIGNED NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `tax` double NOT NULL DEFAULT '0',
  `delivery` double NOT NULL DEFAULT '0',
  `status` enum('new','priced','accepted','working','done','rejected','canceled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `reject_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total` double NOT NULL DEFAULT '0',
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `client_id` int(10) NOT NULL,
  `canceled_by` int(10) UNSIGNED DEFAULT NULL,
  `canceled_by_type` enum('provider','client') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'provider'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `provider_id`, `sub_service_id`, `building_type_id`, `desc`, `address`, `lat`, `lng`, `time_period_id`, `price`, `tax`, `delivery`, `status`, `payment_type`, `reject_reason`, `created_at`, `updated_at`, `total`, `product_id`, `client_id`, `canceled_by`, `canceled_by_type`) VALUES
(8, 4, 1, NULL, 'صصصص', 'القاهرة', 'ص', '22', 14, 1, 20, 7, 'new', 'cash', NULL, '2020-04-09 07:14:39', '2020-04-09 07:14:39', 0, 7, 1, NULL, 'provider');

-- --------------------------------------------------------

--
-- Table structure for table `order_comments`
--

CREATE TABLE `order_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `from_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `to_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `from_type` enum('provider','client') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'provider',
  `to_type` enum('provider','client') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'provider'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_comments`
--

INSERT INTO `order_comments` (`id`, `order_id`, `from_id`, `to_id`, `message`, `is_read`, `read_at`, `created_at`, `updated_at`, `from_type`, `to_type`) VALUES
(8, 4, 1, 1, 'first message', 0, NULL, '2020-03-24 06:32:00', '2020-03-24 06:32:00', 'provider', 'provider'),
(9, 4, 1, 1, 'second message', 0, NULL, '2020-03-24 06:32:09', '2020-03-24 06:32:09', 'provider', 'provider'),
(10, 5, 1, 1, 'first  message order 2', 0, NULL, '2020-03-24 06:32:32', '2020-03-24 06:32:32', 'provider', 'provider'),
(11, 5, 1, 1, 'second  message order 2', 0, NULL, '2020-03-24 06:32:40', '2020-03-24 06:32:40', 'provider', 'provider'),
(12, 4, 1, 1, 'xxsxsx', 0, NULL, '2020-04-01 12:00:33', '2020-04-01 12:00:33', 'provider', 'provider'),
(13, 4, 1, 1, 'ttttttttttttttt', 0, NULL, '2020-04-01 12:00:38', '2020-04-01 12:00:38', 'provider', 'provider'),
(14, 4, 1, 1, 'sxaxsxsx', 0, NULL, '2020-04-01 12:00:41', '2020-04-01 12:00:41', 'provider', 'provider'),
(15, 4, 1, 1, 'sxscscsc', 0, NULL, '2020-04-01 12:00:45', '2020-04-01 12:00:45', 'provider', 'provider'),
(16, 4, 1, 1, 'scscsc', 0, NULL, '2020-04-01 12:00:49', '2020-04-01 12:00:49', 'provider', 'provider'),
(17, 4, 1, 1, 'scscsc', 0, NULL, '2020-04-01 12:00:52', '2020-04-01 12:00:52', 'provider', 'provider'),
(18, 4, 1, 1, 'scscscsswwwwwwwwwwwwwww', 0, NULL, '2020-04-01 12:01:00', '2020-04-01 12:01:00', 'provider', 'provider'),
(19, 8, 1, 4, 'hi customer', 0, NULL, '2020-04-09 07:33:07', '2020-04-09 07:33:07', 'provider', 'provider');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_en` text COLLATE utf8mb4_unicode_ci,
  `desc_ar` text COLLATE utf8mb4_unicode_ci,
  `price` double NOT NULL,
  `period` int(10) UNSIGNED NOT NULL,
  `type` enum('day','week','month','year') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'month',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name_ar`, `name_en`, `desc_en`, `desc_ar`, `price`, `period`, `type`, `image`, `created_at`, `updated_at`) VALUES
(4, 'adawegawrg', 'package', 'wergwrg', 'wdfwaf', 33, 343, 'month', 'uploads/packages/20200406113224-Screenshot from 2020-03-31 12-04-13.png', '2020-03-11 10:06:44', '2020-04-06 09:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `package_payments`
--

CREATE TABLE `package_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` enum('cash','online') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'online',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `promocode_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_payments`
--

INSERT INTO `package_payments` (`id`, `package_id`, `provider_id`, `payment_id`, `payment_type`, `created_at`, `updated_at`, `promocode_id`) VALUES
(2, 4, 1, 0, 'online', '2020-03-18 20:14:32', '2020-03-18 20:14:32', 1),
(5, 4, 1, 0, 'online', '2020-03-18 20:22:31', '2020-03-19 04:51:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','paid','unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `type` enum('payment','refund') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'payment',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `package_id`, `provider_id`, `status`, `type`, `created_at`, `updated_at`) VALUES
(3, 10, 4, 1, 'pending', 'payment', '2020-03-18 19:16:50', '2020-03-18 19:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_service_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_ar` longtext COLLATE utf8mb4_unicode_ci,
  `desc_en` longtext COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sub_service_id`, `image`, `name_ar`, `name_en`, `desc_ar`, `desc_en`, `is_featured`, `created_at`, `updated_at`) VALUES
(7, 14, 'uploads/products/20200407105748-image.jpeg', 'Egypt', 'Egypt', 'sub_service', 'sub_service', 1, '2020-04-07 08:57:48', '2020-04-07 08:57:48'),
(8, 1, 'uploads/products/20200408104210-2.png', 'Egyptor', 'Egyptor', 'ثققثق', 'error', 1, '2020-04-08 08:42:10', '2020-04-08 08:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `promocodes`
--

CREATE TABLE `promocodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expired_at` date NOT NULL,
  `activate_at` date NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `used_number` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promocodes`
--

INSERT INTO `promocodes` (`id`, `expired_at`, `activate_at`, `code`, `amount`, `used_number`, `created_at`, `updated_at`) VALUES
(1, '2020-03-01', '2020-03-10', '3030', 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_code` int(11) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `workday_from` enum('sat','sun','mon','tue','wed','thu','fri') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sun',
  `workday_to` enum('sat','sun','mon','tue','wed','thu','fri') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sun',
  `trading_license` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avg_rate` int(11) NOT NULL DEFAULT '0',
  `device_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_verify_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `branch_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `name_ar`, `name_en`, `mobile`, `mobile_code`, `password`, `cat_id`, `workday_from`, `workday_to`, `trading_license`, `image`, `avg_rate`, `device_token`, `mobile_verify_at`, `created_at`, `updated_at`, `branch_no`) VALUES
(4, 'مصطفى عادل', 'Mustafa Adel', '01100968183', 77981, '$2y$10$5UeaXGM3O9.67lEJFUnoq.MH5errCLQyf7YejkzvwBTB7.H9p3NQe', 2, 'sun', 'thu', '212', 'uploads/providers/20200409085613-232.png', 0, NULL, NULL, '2020-04-09 06:56:01', '2020-04-09 06:56:13', 0),
(6, 'provider Egypt', 'provider Egypt', '01100968486', 61500, '$2y$10$JMg8tXmjqTNHOE4BKrUJv.tueivlKAzex1d20DBuSBITJsAfepNZu', 2, 'sat', 'sat', '1111', 'uploads/providers/20200409090435-2.png', 0, NULL, NULL, '2020-04-09 07:04:35', '2020-04-09 07:04:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `providers_branches`
--

CREATE TABLE `providers_branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `providers_branches`
--

INSERT INTO `providers_branches` (`id`, `provider_id`, `country_id`, `city_id`, `address`, `lat`, `lng`, `mobile`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 2, 'القاهرة', '2323', '2222', '01100968486', '2020-03-17 05:47:52', '2020-03-17 05:47:52'),
(3, 2, 1, 2, 'القاهرة 15 مايو', '44', '44', '01100968486', '2020-03-17 08:55:47', '2020-03-17 08:55:47'),
(4, 1, 1, 1, 'qwrgwrg', 'regre', 'gergerg', 'erg', '2020-03-17 10:37:07', '2020-03-17 10:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `provider_ratings`
--

CREATE TABLE `provider_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `review` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_ar` longtext COLLATE utf8mb4_unicode_ci,
  `desc_en` longtext COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `cat_id`, `image`, `name_ar`, `name_en`, `desc_ar`, `desc_en`, `is_featured`, `created_at`, `updated_at`) VALUES
(34, 2, 'uploads/services/20200315123044-image.jpeg', 'ألنجارة', 'Carpentry', 'ألنجارةألنجارةألنجارةألنجارة', 'CarpentryCarpentryCarpentryCarpentry', 1, '2020-03-15 10:30:44', '2020-03-15 10:30:44'),
(35, 1, 'uploads/services/20200315134204-image.jpeg', 'الكهرباء', 'الكهرباء', 'الكهرباءالكهرباءالكهرباء', 'الكهرباءالكهرباءالكهرباء', 1, '2020-03-15 11:42:04', '2020-03-15 11:42:04'),
(36, 1, 'uploads/services/20200407085749-image.jpeg', 'التوصيل المنزلى', 'التوصيل المنزلى', 'التوصيل المنزلىالتوصيل المنزلى', 'التوصيل المنزلىالتوصيل المنزلى', 0, '2020-04-07 06:57:49', '2020-04-07 07:16:14'),
(37, 1, 'uploads/services/20200407090511-image2.jpeg', 'Egypt', '$request->is_featured = \'on\' ? 1 : 0;Carpentry', '$request->is_featured = \'on\' ? 1 : 0;', '$request->is_featured = \'on\' ? 1 : 0;', 1, '2020-04-07 07:05:11', '2020-04-07 07:15:51'),
(38, 1, 'uploads/services/20200407091633-image2.jpeg', '[][][][]', '[][][][]', '[][][][][][][][]', '[][][][][][][][]', 0, '2020-04-07 07:16:33', '2020-04-07 07:16:39');

-- --------------------------------------------------------

--
-- Table structure for table `service_providers`
--

CREATE TABLE `service_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `provider_branch_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `sub_service_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('text','number','email','textarea','map','select','file') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_services`
--

CREATE TABLE `sub_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_ar` longtext COLLATE utf8mb4_unicode_ci,
  `desc_en` longtext COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_services`
--

INSERT INTO `sub_services` (`id`, `service_id`, `image`, `name_ar`, `name_en`, `desc_ar`, `desc_en`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 36, 'uploads/sub_services/20200408104142-2.png', 'السباكة', 'السباكة', 'السباكةالسباكة', 'السباكةالسباكةالسباكة', 1, '2020-04-08 08:41:42', '2020-04-08 08:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `time_periods`
--

CREATE TABLE `time_periods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `provider_branch_id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_periods`
--

INSERT INTO `time_periods` (`id`, `provider_id`, `provider_branch_id`, `from`, `to`, `desc_ar`, `desc_en`, `created_at`, `updated_at`) VALUES
(14, 3, 3, '3:22 PM', '10:22 PM', 'ttttt', 'tttttttttt', '2020-04-06 08:59:33', '2020-04-06 08:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `package_id`, `provider_id`, `image`, `notes`, `created_at`, `updated_at`, `is_confirmed`) VALUES
(1, 4, 1, 'uploads/services/20200317075650-image2.jpeg', 'qefqefqewfqewf', '2020-03-16 12:32:35', '2020-03-19 07:20:54', 0),
(3, 4, 1, 'uploads/package_transaction/20200317080153-image2.jpeg', 'sfefsf', '2020-03-17 06:01:53', '2020-03-19 07:20:50', 0),
(4, 4, 1, 'uploads/package_transaction/20200317080617-image2.jpeg', NULL, '2020-03-17 06:06:17', '2020-03-19 07:20:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Mustafa Adel', 'admin@email.com', '2020-03-08 12:43:46', '$2y$10$ETMZ2wFfnw0wmrGTRGs/YeMfba7XTPFjrcV749M8YP3D.7xxZWNm.', 'GwV5PSbx2fUAs81phKLwFSUoVw9bp6oaxO1inptilhM5lOLsMGLfiXStQowu', '2020-03-08 12:43:46', '2020-04-09 12:19:15', 'uploads/users/20200409120219-image2.jpeg'),
(2, 'mustafa', 'admin@email2.com', NULL, '$2y$10$jgxXtTGYtWC0UWXed9jv9OffCIrDyUtNPcufxl2d7Nc6CHiTHJOsa', NULL, NULL, NULL, NULL),
(3, 'ali', 'ali@gmail.com', NULL, 'rgewtg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notifiable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` enum('client','provider') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`id`, `type`, `message`, `notifiable_type`, `notifiable_id`, `user_id`, `user_type`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 1, 1, 'client', 0, NULL, '2020-03-18 16:27:26', '2020-03-18 16:27:26'),
(2, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 2, 1, 'client', 0, NULL, '2020-03-18 16:27:31', '2020-03-18 16:27:31'),
(3, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 3, 1, 'client', 0, NULL, '2020-03-18 16:35:26', '2020-03-18 16:35:26'),
(4, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 4, 1, 'client', 0, '2020-04-08 10:41:28', '2020-03-18 16:35:29', '2020-04-08 10:41:28'),
(5, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 5, 1, 'client', 0, '2020-03-24 06:32:40', '2020-03-19 06:16:15', '2020-03-24 06:32:40'),
(6, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 6, 1, 'client', 0, NULL, '2020-03-19 06:35:25', '2020-03-19 06:35:25'),
(7, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 7, 1, 'client', 0, NULL, '2020-03-21 07:01:56', '2020-03-21 07:01:56'),
(8, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 8, 1, 'client', 0, '2020-04-28 11:19:45', '2020-03-24 06:32:00', '2020-04-28 11:19:45'),
(9, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 9, 1, 'client', 0, NULL, '2020-03-24 06:32:10', '2020-03-24 06:32:10'),
(10, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 10, 1, 'client', 0, NULL, '2020-03-24 06:32:32', '2020-03-24 06:32:32'),
(11, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 11, 1, 'client', 0, NULL, '2020-03-24 06:32:40', '2020-03-24 06:32:40'),
(12, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 12, 1, 'client', 0, NULL, '2020-04-01 12:00:33', '2020-04-01 12:00:33'),
(13, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 13, 1, 'client', 0, NULL, '2020-04-01 12:00:38', '2020-04-01 12:00:38'),
(14, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 14, 1, 'client', 0, NULL, '2020-04-01 12:00:41', '2020-04-01 12:00:41'),
(15, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 15, 1, 'client', 0, NULL, '2020-04-01 12:00:46', '2020-04-01 12:00:46'),
(16, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 16, 1, 'client', 0, NULL, '2020-04-01 12:00:49', '2020-04-01 12:00:49'),
(17, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 17, 1, 'client', 0, NULL, '2020-04-01 12:00:52', '2020-04-01 12:00:52'),
(18, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 18, 1, 'client', 0, NULL, '2020-04-01 12:01:00', '2020-04-01 12:01:00'),
(19, 'new_message', 'لديك رسالة جديدة', 'App\\Models\\OrderComment', 19, 4, 'client', 0, NULL, '2020-04-09 07:33:07', '2020-04-09 07:33:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building_types`
--
ALTER TABLE `building_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bulding_types_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `bulding_types_name_en_unique` (`name_en`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `categories_name_en_unique` (`name_en`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cities_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `cities_name_en_unique` (`name_en`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_messages`
--
ALTER TABLE `clients_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_ratings`
--
ALTER TABLE `client_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `countries_name_en_unique` (`name_en`);

--
-- Indexes for table `custmor_supports`
--
ALTER TABLE `custmor_supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourites_favable_type_favable_id_index` (`favable_type`,`favable_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_imagable_type_imagable_id_index` (`imagable_type`,`imagable_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_comments`
--
ALTER TABLE `order_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_payments`
--
ALTER TABLE `package_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `products_name_en_unique` (`name_en`);

--
-- Indexes for table `promocodes`
--
ALTER TABLE `promocodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `providers_branches`
--
ALTER TABLE `providers_branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_ratings`
--
ALTER TABLE `provider_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `services_name_en_unique` (`name_en`);

--
-- Indexes for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_services`
--
ALTER TABLE `sub_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_services_name_ar_unique` (`name_ar`),
  ADD UNIQUE KEY `sub_services_name_en_unique` (`name_en`);

--
-- Indexes for table `time_periods`
--
ALTER TABLE `time_periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building_types`
--
ALTER TABLE `building_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `clients_messages`
--
ALTER TABLE `clients_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client_ratings`
--
ALTER TABLE `client_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `custmor_supports`
--
ALTER TABLE `custmor_supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `order_comments`
--
ALTER TABLE `order_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `package_payments`
--
ALTER TABLE `package_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `promocodes`
--
ALTER TABLE `promocodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `providers_branches`
--
ALTER TABLE `providers_branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `provider_ratings`
--
ALTER TABLE `provider_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_services`
--
ALTER TABLE `sub_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `time_periods`
--
ALTER TABLE `time_periods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

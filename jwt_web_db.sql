-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2025 at 12:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jwt_web_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'category First', '2025-08-17 00:05:16', '2025-08-17 00:05:16'),
(2, 'category 2nd', '2025-08-17 00:06:08', '2025-08-17 00:06:08'),
(3, 'category 3rd', '2025-08-17 00:06:16', '2025-08-17 00:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `customer_id`, `order_id`, `user_id`, `invoice_number`, `invoice_date`, `total_amount`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 1, 'INV2025081768a173989e746', '2025-08-17', 950.00, 'Customer Id is 3', 'pending', '2025-08-17 00:15:52', '2025-08-17 00:15:52'),
(2, 3, NULL, 2, 'INV-2025082368a94dcb820d0', '2025-08-23', 370.00, NULL, 'Pending', '2025-08-22 23:12:43', '2025-08-22 23:12:43'),
(3, 3, NULL, 2, 'INV-2025082368a94dda7b2eb', '2025-08-23', 80.00, NULL, 'Pending', '2025-08-22 23:12:58', '2025-08-22 23:12:58'),
(4, 3, NULL, 2, 'INV-2025082368a9541ae920c', '2025-08-23', 80.00, NULL, 'Pending', '2025-08-22 23:39:38', '2025-08-22 23:39:38'),
(5, 3, NULL, 2, 'INV-2025082368a956637053b', '2025-08-23', 370.00, NULL, 'Pending', '2025-08-22 23:49:23', '2025-08-22 23:49:23'),
(6, 3, NULL, 2, 'INV-2025082368a9578944ce9', '2025-08-23', 370.00, NULL, 'Pending', '2025-08-22 23:54:17', '2025-08-22 23:54:17'),
(7, 3, NULL, 2, 'INV-2025082368a9585512f5e', '2025-08-23', 80.00, NULL, 'Pending', '2025-08-22 23:57:41', '2025-08-22 23:57:41'),
(8, 3, NULL, 2, 'INV-2025082368a9585b0e2ea', '2025-08-23', 80.00, NULL, 'Pending', '2025-08-22 23:57:47', '2025-08-22 23:57:47'),
(9, 3, NULL, 2, 'INV-2025082368a958693c9d9', '2025-08-23', 80.00, NULL, 'Pending', '2025-08-22 23:58:01', '2025-08-22 23:58:01'),
(10, 3, NULL, 2, 'INV-2025082368a95c637cb0c', '2025-08-23', 80.00, NULL, 'Pending', '2025-08-23 00:14:59', '2025-08-23 00:14:59'),
(11, 3, NULL, 2, 'INV-2025082368a95d36dde6c', '2025-08-23', 370.00, NULL, 'Pending', '2025-08-23 00:18:30', '2025-08-23 00:18:30'),
(12, 3, 8, 2, 'INV-2025082368a95e55945fd', '2025-08-23', 370.00, NULL, 'Pending', '2025-08-23 00:23:17', '2025-08-23 00:23:17'),
(13, 1, 10, 2, 'INV-20250823-559298', '2025-08-23', 80.00, NULL, 'Pending', '2025-08-23 06:34:24', '2025-08-23 06:34:24'),
(14, 1, 9, 2, 'INV-20250823-968875', '2025-08-23', 370.00, NULL, 'Pending', '2025-08-23 06:36:54', '2025-08-23 06:36:54'),
(15, 1, 11, 2, 'INV-20250823-685739', '2025-08-23', 80.00, NULL, 'Pending', '2025-08-23 06:37:48', '2025-08-23 06:37:48'),
(16, 1, 13, 2, 'INV-20250823-386201', '2025-08-23', 80.00, NULL, 'Pending', '2025-08-23 06:43:49', '2025-08-23 06:43:49'),
(17, 2, 12, 2, 'INV-20250823-207873', '2025-08-23', 80.00, NULL, 'Pending', '2025-08-23 06:43:53', '2025-08-23 06:43:53'),
(18, 1, 14, 2, 'INV-20250823-220081', '2025-08-23', 80.00, NULL, 'Paid', '2025-08-23 06:55:23', '2025-08-23 06:55:23'),
(19, 1, 15, 2, 'INV-20250823-921200', '2025-08-23', 370.00, NULL, 'Paid', '2025-08-23 06:59:00', '2025-08-23 06:59:00'),
(20, 1, 16, 2, 'INV-20250823-433590', '2025-08-23', 80.00, NULL, 'Paid', '2025-08-23 07:06:11', '2025-08-23 07:06:11'),
(21, 1, 17, 2, 'INV-20250823-947736', '2025-08-23', 370.00, NULL, 'Paid', '2025-08-23 07:08:50', '2025-08-23 07:08:50'),
(22, 1, 19, 2, 'INV-20250823-972331', '2025-08-23', 80.00, NULL, 'Paid', '2025-08-23 07:16:24', '2025-08-23 07:16:24'),
(23, 1, 18, 2, 'INV-20250823-434010', '2025-08-23', 370.00, NULL, 'Paid', '2025-08-23 07:16:27', '2025-08-23 07:16:27'),
(24, 1, 21, 2, 'INV-20250823-395419', '2025-08-23', 80.00, NULL, 'Paid', '2025-08-23 12:02:59', '2025-08-23 12:02:59'),
(25, 1, 20, 2, 'INV-20250823-144505', '2025-08-23', 370.00, NULL, 'Paid', '2025-08-23 12:03:04', '2025-08-23 12:03:04'),
(26, 1, 22, 2, 'INV-20250823-133442', '2025-08-23', 370.00, NULL, 'Paid', '2025-08-23 13:06:26', '2025-08-23 13:06:26'),
(27, 7, 23, 2, 'INV-20250824-948364', '2025-08-24', 370.00, NULL, 'Paid', '2025-08-24 07:42:14', '2025-08-24 07:42:14'),
(28, 8, 24, 2, 'INV-20250824-731299', '2025-08-24', 370.00, NULL, 'Paid', '2025-08-24 08:16:36', '2025-08-24 08:16:37'),
(29, 9, 25, 2, 'INV-20250824-311116', '2025-08-24', 370.00, NULL, 'Paid', '2025-08-24 08:25:11', '2025-08-24 08:25:11'),
(30, 10, 26, 2, 'INV-20250824-988958', '2025-08-24', 370.00, NULL, 'Paid', '2025-08-24 08:56:19', '2025-08-24 08:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `product_id`, `quantity`, `amount`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 70.00, 350.00, '2025-08-17 00:15:52', '2025-08-17 00:15:52'),
(2, 1, 3, 3, 200.00, 600.00, '2025-08-17 00:15:52', '2025-08-17 00:15:52'),
(3, 2, 1, 1, 370.00, 370.00, '2025-08-22 23:12:43', '2025-08-22 23:12:43'),
(4, 3, 2, 1, 80.00, 80.00, '2025-08-22 23:12:58', '2025-08-22 23:12:58'),
(5, 4, 3, 1, 80.00, 80.00, '2025-08-22 23:39:38', '2025-08-22 23:39:38'),
(6, 5, 1, 1, 370.00, 370.00, '2025-08-22 23:49:23', '2025-08-22 23:49:23'),
(7, 6, 1, 1, 370.00, 370.00, '2025-08-22 23:54:17', '2025-08-22 23:54:17'),
(8, 7, 2, 1, 80.00, 80.00, '2025-08-22 23:57:41', '2025-08-22 23:57:41'),
(9, 8, 2, 1, 80.00, 80.00, '2025-08-22 23:57:47', '2025-08-22 23:57:47'),
(10, 9, 2, 1, 80.00, 80.00, '2025-08-22 23:58:01', '2025-08-22 23:58:01'),
(11, 10, 3, 1, 80.00, 80.00, '2025-08-23 00:14:59', '2025-08-23 00:14:59'),
(12, 11, 1, 1, 370.00, 370.00, '2025-08-23 00:18:30', '2025-08-23 00:18:30'),
(13, 12, 1, 1, 370.00, 370.00, '2025-08-23 00:23:17', '2025-08-23 00:23:17'),
(14, 13, 2, 1, 80.00, 80.00, '2025-08-23 06:34:24', '2025-08-23 06:34:24'),
(15, 14, 1, 1, 370.00, 370.00, '2025-08-23 06:36:54', '2025-08-23 06:36:54'),
(16, 15, 3, 1, 80.00, 80.00, '2025-08-23 06:37:48', '2025-08-23 06:37:48'),
(17, 16, 2, 1, 80.00, 80.00, '2025-08-23 06:43:49', '2025-08-23 06:43:49'),
(18, 17, 3, 1, 80.00, 80.00, '2025-08-23 06:43:53', '2025-08-23 06:43:53'),
(19, 18, 3, 1, 80.00, 80.00, '2025-08-23 06:55:23', '2025-08-23 06:55:23'),
(20, 19, 1, 1, 370.00, 370.00, '2025-08-23 06:59:00', '2025-08-23 06:59:00'),
(21, 20, 2, 1, 80.00, 80.00, '2025-08-23 07:06:11', '2025-08-23 07:06:11'),
(22, 21, 1, 1, 370.00, 370.00, '2025-08-23 07:08:50', '2025-08-23 07:08:50'),
(23, 22, 2, 1, 80.00, 80.00, '2025-08-23 07:16:24', '2025-08-23 07:16:24'),
(24, 23, 1, 1, 370.00, 370.00, '2025-08-23 07:16:27', '2025-08-23 07:16:27'),
(25, 24, 2, 1, 80.00, 80.00, '2025-08-23 12:02:59', '2025-08-23 12:02:59'),
(26, 25, 1, 1, 370.00, 370.00, '2025-08-23 12:03:04', '2025-08-23 12:03:04'),
(27, 26, 1, 1, 370.00, 370.00, '2025-08-23 13:06:26', '2025-08-23 13:06:26'),
(28, 27, 1, 1, 370.00, 370.00, '2025-08-24 07:42:14', '2025-08-24 07:42:14'),
(29, 28, 1, 1, 370.00, 370.00, '2025-08-24 08:16:37', '2025-08-24 08:16:37'),
(30, 29, 1, 1, 370.00, 370.00, '2025-08-24 08:25:11', '2025-08-24 08:25:11'),
(31, 30, 1, 1, 370.00, 370.00, '2025-08-24 08:56:19', '2025-08-24 08:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_11_064811_create_otps_table', 1),
(5, '2025_08_11_065715_create_personal_access_tokens_table', 1),
(6, '2025_08_12_193316_add_roles_into_users_table', 1),
(7, '2025_08_12_193837_create_profiles_table', 1),
(8, '2025_08_14_173034_create_categories_table', 1),
(9, '2025_08_14_175648_create_products_table', 1),
(10, '2025_08_15_103301_create_invoices_table', 1),
(11, '2025_08_15_103340_create_invoice_details_table', 1),
(12, '2025_08_22_141833_create_orders_table', 2),
(13, '2025_08_22_141851_create_order_details_table', 2),
(14, '2025_08_22_141858_add_order_id_to_invoices_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `total`, `created_at`, `updated_at`) VALUES
(1, 3, 'confirmed', 80.00, '2025-08-22 12:31:02', '2025-08-22 23:12:58'),
(2, 3, 'confirmed', 370.00, '2025-08-22 12:31:12', '2025-08-22 23:12:43'),
(3, 3, 'confirmed', 80.00, '2025-08-22 23:39:04', '2025-08-22 23:39:38'),
(4, 3, 'confirmed', 370.00, '2025-08-22 23:48:48', '2025-08-22 23:54:17'),
(5, 3, 'confirmed', 80.00, '2025-08-22 23:57:11', '2025-08-22 23:57:41'),
(6, 3, 'confirmed', 80.00, '2025-08-23 00:08:40', '2025-08-23 00:14:59'),
(7, 3, 'confirmed', 370.00, '2025-08-23 00:18:22', '2025-08-23 00:18:30'),
(8, 3, 'confirmed', 370.00, '2025-08-23 00:22:40', '2025-08-23 00:23:17'),
(9, 1, 'confirmed', 370.00, '2025-08-23 06:33:55', '2025-08-23 06:36:54'),
(10, 1, 'confirmed', 80.00, '2025-08-23 06:34:04', '2025-08-23 06:34:24'),
(11, 1, 'confirmed', 80.00, '2025-08-23 06:37:19', '2025-08-23 06:37:48'),
(12, 2, 'confirmed', 80.00, '2025-08-23 06:38:44', '2025-08-23 06:43:53'),
(13, 1, 'confirmed', 80.00, '2025-08-23 06:43:30', '2025-08-23 06:43:49'),
(14, 1, 'confirmed', 80.00, '2025-08-23 06:53:21', '2025-08-23 06:55:23'),
(15, 1, 'confirmed', 370.00, '2025-08-23 06:58:48', '2025-08-23 06:59:00'),
(16, 1, 'confirmed', 80.00, '2025-08-23 07:05:25', '2025-08-23 07:06:11'),
(17, 1, 'confirmed', 370.00, '2025-08-23 07:08:00', '2025-08-23 07:08:50'),
(18, 1, 'confirmed', 370.00, '2025-08-23 07:15:36', '2025-08-23 07:16:27'),
(19, 1, 'confirmed', 80.00, '2025-08-23 07:15:49', '2025-08-23 07:16:24'),
(20, 1, 'confirmed', 370.00, '2025-08-23 12:02:03', '2025-08-23 12:03:04'),
(21, 1, 'confirmed', 80.00, '2025-08-23 12:02:13', '2025-08-23 12:02:59'),
(22, 1, 'confirmed', 370.00, '2025-08-23 13:05:11', '2025-08-23 13:06:26'),
(23, 7, 'confirmed', 370.00, '2025-08-24 07:41:41', '2025-08-24 07:42:14'),
(24, 8, 'confirmed', 370.00, '2025-08-24 08:15:45', '2025-08-24 08:16:37'),
(25, 9, 'confirmed', 370.00, '2025-08-24 08:24:22', '2025-08-24 08:25:11'),
(26, 10, 'confirmed', 370.00, '2025-08-24 08:55:48', '2025-08-24 08:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 80.00, '2025-08-22 12:31:02', '2025-08-22 12:31:02'),
(2, 2, 1, 1, 370.00, '2025-08-22 12:31:12', '2025-08-22 12:31:12'),
(3, 3, 3, 1, 80.00, '2025-08-22 23:39:04', '2025-08-22 23:39:04'),
(4, 4, 1, 1, 370.00, '2025-08-22 23:48:48', '2025-08-22 23:48:48'),
(5, 5, 2, 1, 80.00, '2025-08-22 23:57:11', '2025-08-22 23:57:11'),
(6, 6, 3, 1, 80.00, '2025-08-23 00:08:40', '2025-08-23 00:08:40'),
(7, 7, 1, 1, 370.00, '2025-08-23 00:18:22', '2025-08-23 00:18:22'),
(8, 8, 1, 1, 370.00, '2025-08-23 00:22:40', '2025-08-23 00:22:40'),
(9, 9, 1, 1, 370.00, '2025-08-23 06:33:55', '2025-08-23 06:33:55'),
(10, 10, 2, 1, 80.00, '2025-08-23 06:34:04', '2025-08-23 06:34:04'),
(11, 11, 3, 1, 80.00, '2025-08-23 06:37:19', '2025-08-23 06:37:19'),
(12, 12, 3, 1, 80.00, '2025-08-23 06:38:44', '2025-08-23 06:38:44'),
(13, 13, 2, 1, 80.00, '2025-08-23 06:43:30', '2025-08-23 06:43:30'),
(14, 14, 3, 1, 80.00, '2025-08-23 06:53:21', '2025-08-23 06:53:21'),
(15, 15, 1, 1, 370.00, '2025-08-23 06:58:48', '2025-08-23 06:58:48'),
(16, 16, 2, 1, 80.00, '2025-08-23 07:05:25', '2025-08-23 07:05:25'),
(17, 17, 1, 1, 370.00, '2025-08-23 07:08:00', '2025-08-23 07:08:00'),
(18, 18, 1, 1, 370.00, '2025-08-23 07:15:36', '2025-08-23 07:15:36'),
(19, 19, 2, 1, 80.00, '2025-08-23 07:15:49', '2025-08-23 07:15:49'),
(20, 20, 1, 1, 370.00, '2025-08-23 12:02:03', '2025-08-23 12:02:03'),
(21, 21, 2, 1, 80.00, '2025-08-23 12:02:13', '2025-08-23 12:02:13'),
(22, 22, 1, 1, 370.00, '2025-08-23 13:05:11', '2025-08-23 13:05:11'),
(23, 23, 1, 1, 370.00, '2025-08-24 07:41:41', '2025-08-24 07:41:41'),
(24, 24, 1, 1, 370.00, '2025-08-24 08:15:45', '2025-08-24 08:15:45'),
(25, 25, 1, 1, 370.00, '2025-08-24 08:24:22', '2025-08-24 08:24:22'),
(26, 26, 1, 1, 370.00, '2025-08-24 08:55:48', '2025-08-24 08:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `email`, `otp`, `status`, `created_at`, `updated_at`) VALUES
(1, 'newaz@gmail.com', '111025', 0, '2025-08-19 11:18:15', '2025-08-19 11:18:15'),
(2, 'newaz@gmail.com', '309784', 0, '2025-08-19 11:19:53', '2025-08-19 11:19:53'),
(3, 'newaz@gmail.com', '778235', 0, '2025-08-19 11:36:46', '2025-08-19 11:36:46'),
(4, 'newaz@gmail.com', '929820', 0, '2025-08-19 11:41:14', '2025-08-19 11:41:14'),
(5, 'tahsin@gmail.com', '654473', 0, '2025-08-19 11:43:48', '2025-08-19 11:43:48'),
(6, 'tahsin@gmail.com', '690960', 0, '2025-08-19 11:45:22', '2025-08-19 11:45:22'),
(7, 'newaz@gmail.com', '656490', 0, '2025-08-19 11:50:17', '2025-08-19 11:50:17'),
(8, 'tahsin@gmail.com', '936008', 0, '2025-08-19 12:20:05', '2025-08-19 12:20:05'),
(9, 'newaz@gmail.com', '686865', 0, '2025-08-19 12:22:19', '2025-08-19 12:22:19'),
(10, 'tahsin@gmail.com', '894399', 0, '2025-08-19 12:23:23', '2025-08-19 12:23:23'),
(11, 'tahsin@gmail.com', '549190', 0, '2025-08-19 12:24:35', '2025-08-19 12:24:35'),
(12, 'tahsin@gmail.com', '722282', 0, '2025-08-19 12:31:33', '2025-08-19 12:31:33'),
(13, 'newaz@gmail.com', '192618', 1, '2025-08-19 12:32:46', '2025-08-19 12:33:27'),
(14, 'tahsin@gmail.com', '977072', 1, '2025-08-19 13:12:02', '2025-08-19 13:12:25'),
(15, 'tahsin@gmail.com', '613687', 0, '2025-08-19 13:13:52', '2025-08-19 13:13:52'),
(16, 'tahsin@gmail.com', '338053', 1, '2025-08-19 13:14:49', '2025-08-19 13:15:04'),
(17, 'tahsin@gmail.com', '862732', 1, '2025-08-19 13:18:14', '2025-08-19 13:18:33'),
(18, 'tahsin@gmail.com', '543792', 1, '2025-08-23 07:34:46', '2025-08-23 07:35:19'),
(19, 'karim@email.com', '429100', 1, '2025-08-24 08:22:15', '2025-08-24 08:23:08'),
(20, 'rahim@email.com', '593564', 1, '2025-08-24 08:52:46', '2025-08-24 08:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `quantity`, `image`, `created_at`, `updated_at`) VALUES
(1, 3, 'Soyabean Oil', '5Litre Bottle', 370.00, 7, 'products/GxWBNadI09YrVrFOJpndnFNQvg1k6CzhPChqIK5Y.jpg', '2025-08-17 00:07:18', '2025-08-24 08:56:19'),
(2, 1, 'Rice', '1kg', 80.00, 23, 'products/dzX52nINKMHoNDT7T0IQ6mEZ12YktJtFKY49YV5w.jpg', '2025-08-17 00:09:23', '2025-08-23 12:02:59'),
(3, 2, 'Flour', '1kg', 80.00, 35, 'products/axJ8OHnjkrETV2byysnNjmR4GkajbGRKgvCOQj3r.jpg', '2025-08-17 00:11:50', '2025-08-23 06:55:23'),
(4, 3, 'Mustard Oil', '5KG Mustard Oil Bottle', 1150.00, 20, 'products/bYNpyy1OeHUXHHJoDHCzI6wjDtt2KxYWgT157S03.jpg', '2025-08-24 06:14:20', '2025-08-24 06:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `phone`, `address`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 1, '019383887', 'chattogram', 'avatars/OhIl0SirEm0I4w1RuhmyTcH77La2KR2VyE0XAPWn.jpg', '2025-08-17 00:12:33', '2025-08-23 07:03:16'),
(2, 2, '01927379917', 'chittagong', 'public/avatars/JdAZjCHhcGn7yO5BESr56mw2q9HJbPWAQGjyowtz.jpg', '2025-08-17 00:13:29', '2025-08-23 13:27:05'),
(3, 3, '0193838676', 'chattogram', 'public/avatars/FD3hkvTfiyqQk9XzcnbB03EVymqa6QN6zIebcsuW.jpg', '2025-08-17 00:14:13', '2025-08-17 00:14:13'),
(4, 4, '1341244', 'sdvsvs', 'public/avatars/iFpDCDXzbWOwsNdhk6IeaJpfdcN4qCCjWGK9n0wR.jpg', '2025-08-17 06:54:14', '2025-08-17 06:54:14'),
(5, 5, '669008789', 'dhaka', 'public/avatars/NNKAlBPbNnLyWDYqumiSt4dBaIztJf9zF5Sbzx5B.png', '2025-08-18 07:42:57', '2025-08-18 07:42:57'),
(6, 6, '018786688', 'ctg', 'public/avatars/fkpEy9PG8MW956FXzpeutT6LtSDlEXFse4vsUbFK.jpg', '2025-08-18 14:46:49', '2025-08-18 14:46:49'),
(7, 7, '122345646', 'Rajshahi', 'public/avatars/3EiQA7u2NaHhehfG3IrwJzLhhkyBqIZomOhMDNJD.jpg', '2025-08-24 07:40:47', '2025-08-24 07:40:47'),
(8, 8, '09272282288', 'Dhaka', 'avatars/wcxyuDVJlJkgtfKXH6Kr9RnSmCRy4vWoRSEkqRyc.webp', '2025-08-24 08:14:06', '2025-08-24 08:15:28'),
(9, 9, '1244588999', 'dhaka', 'avatars/QZTl8yPnTr61NOukfyGr0slr9zxUSiUNbpBaTuQS.jpg', '2025-08-24 08:21:18', '2025-08-24 08:24:07'),
(10, 10, '79793956', 'CTG', 'avatars/N4mAeUDfvA9aG4UarPodnpoGA67ZV9kVDkC0MFyA.webp', '2025-08-24 08:52:15', '2025-08-24 08:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0LAg2ePROL6L6eksirKaj2ZUAXNw4E6AJJygmjRu', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmlPU0FsckNyQWlCQ3VqekFjRjkwYVV6cmlHeUJIRXU2amozY3FCeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZXBvcnRzL2Rvd25sb2FkP2VuZF9kYXRlPTIwMjUtMDgtMjQmc3RhcnRfZGF0ZT0yMDI1LTA4LTIyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1756026108);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','manager','staff','customer') NOT NULL DEFAULT 'customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Eyshrat Tahsin', 'tahsin@gmail.com', 'staff', NULL, '$2y$12$IvNJ9Fwk6dw8iBhKXcxgd.HR85v5pfEvCc9iG2Blom3M4FYPZ8o7e', NULL, '2025-08-17 00:12:33', '2025-08-23 07:35:26'),
(2, 'Shaznuz', 'shaznuz@gmail.com', 'admin', NULL, '$2y$12$TPEeh3YB11naCCvmC5wMFel4.KaAILipWQF3D58665sSj4V23nZXG', NULL, '2025-08-17 00:13:29', '2025-08-17 00:13:29'),
(3, 'Newaz', 'newaz@gmail.com', 'customer', NULL, '$2y$12$0lAB7DpUKuyTu3AfLqtLVux3d8vu2MqZd8ACyKSp1Cqz8GXdF8BBy', NULL, '2025-08-17 00:14:13', '2025-08-17 00:14:13'),
(4, 'scac', 'dcc@eamil.com', 'customer', NULL, '$2y$12$YALsghgm7dpLTlMJA1WaaOBPXe4MDN.iF77VFzoc54pHSdYHD/kHi', NULL, '2025-08-17 06:54:12', '2025-08-17 06:54:12'),
(5, 'Ismail', 'Ismail@email.com', 'customer', NULL, '$2y$12$y5Hk8gxJhcIVYRAm7GOSo.mGfd2fqRsPxrjCAPJeSElLUm7zxrSKy', NULL, '2025-08-18 07:42:56', '2025-08-18 07:42:56'),
(6, 'Wife', 'wife@gmail.com', 'customer', NULL, '$2y$12$yUdCpOps9blGA38Z0XwdZeZHDm6recCJBe2Hynd/8wbzUehI9QE2W', NULL, '2025-08-18 20:52:48', '2025-08-18 14:46:48'),
(7, 'MD Rahim', 'rahim@gmail.com', 'customer', NULL, '$2y$12$r1OFbKO9VJQGsraAVTFizeNWiTa00ua34o4gwZFHakwazdsoXqBEC', NULL, '2025-08-24 07:40:47', '2025-08-24 07:40:47'),
(8, 'Shaznuz Newaz', 'shaznuznewaz@email.com', 'customer', NULL, '$2y$12$Xod.q0iuOFfVhr5mSSobDum9LUpLlrADL9eyMdq1QcCIqe4JApNbm', NULL, '2025-08-24 08:14:04', '2025-08-24 08:14:04'),
(9, 'Md Karim khan', 'karim@email.com', 'customer', NULL, '$2y$12$laKiwAqLr7Opu7IrIPxV0uXeRTMFq93PNS6ZEGym4HmlLgcxvAj5O', NULL, '2025-08-24 08:21:18', '2025-08-24 08:24:07'),
(10, 'MD Rahim khan', 'rahim@email.com', 'customer', NULL, '$2y$12$XPv2Cb.n6Gp025FFGIKB4Onbavt5kJ.matC1of/jq1kU4/D5qO9j6', NULL, '2025-08-24 08:52:15', '2025-08-24 08:54:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_customer_id_foreign` (`customer_id`),
  ADD KEY `invoices_user_id_foreign` (`user_id`),
  ADD KEY `invoices_order_id_foreign` (`order_id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_details_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `invoices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

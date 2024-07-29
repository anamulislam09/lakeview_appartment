-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2024 at 11:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lakecity_concord_appartment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `mobile`, `email`, `password`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'superadmin', '01847309892', 'admin@gmail.com', '$2y$10$sLT4XpcGIsjPdTQMVNy2NuXD1coNesLepBVsuv36oVu5ob5X1IQKi', 'admin-1722149428.jpg', '1', NULL, '2024-07-28 06:50:28'),
(2, 'Anam', '2', '01847309892', 'anam@gmail.com', '$2y$10$nKW0tHQx3o5iDYqmrgA82uBGwzo7b6IJ1zYfI/fpRdS.PRg3AFNdW', NULL, '1', '2024-07-29 04:58:04', '2024-07-29 04:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `appartments`
--

CREATE TABLE `appartments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `building_id` tinyint(4) DEFAULT NULL,
  `appartment_name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_date` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appartments`
--

INSERT INTO `appartments` (`id`, `building_id`, `appartment_name`, `location`, `status`, `created_date`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 2, 'A1', NULL, '1', '2024-07-29', '1', '2024-07-29 09:17:27', '2024-07-29 09:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `basic_infos`
--

CREATE TABLE `basic_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `moto` varchar(255) NOT NULL,
  `phone1` varchar(15) NOT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `logo` varchar(30) NOT NULL,
  `favIcon` varchar(30) NOT NULL,
  `currency_code` varchar(30) NOT NULL,
  `currency_symbol` varchar(30) NOT NULL,
  `acceptPaymentType` varchar(30) NOT NULL,
  `copyRightName` varchar(500) NOT NULL,
  `copyRightLink` varchar(255) NOT NULL DEFAULT '#',
  `mapLink` varchar(255) NOT NULL DEFAULT '#',
  `facebook` varchar(255) NOT NULL DEFAULT '#',
  `instagram` varchar(255) NOT NULL DEFAULT '#',
  `twitter` varchar(255) NOT NULL DEFAULT '#',
  `pinterest` varchar(255) NOT NULL DEFAULT '#',
  `linkedIn` varchar(255) NOT NULL DEFAULT '#',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `building_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_date` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `building_name`, `status`, `created_date`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'Sarnalota', '1', '2024-07-29', '1', '2024-07-29 08:27:03', '2024-07-29 08:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `main_cat_id` tinyint(4) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `family_members`
--

CREATE TABLE `family_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `building_id` tinyint(4) DEFAULT NULL,
  `member_id` tinyint(4) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `relation` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_date` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appartment_id` tinyint(4) DEFAULT NULL,
  `building_id` tinyint(4) DEFAULT NULL,
  `member_name` varchar(255) DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `intercome_no` varchar(255) DEFAULT NULL,
  `land_phone` varchar(255) DEFAULT NULL,
  `mobile_phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `car_no` varchar(255) DEFAULT NULL,
  `nid_no` varchar(255) DEFAULT NULL,
  `nid` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `flat_reg_document` varchar(255) DEFAULT NULL,
  `garage_no` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `institute_name` varchar(255) DEFAULT NULL,
  `institute_addres` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_date` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `child_id` int(11) NOT NULL DEFAULT 0,
  `menu_name` varchar(255) NOT NULL,
  `route` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `child_id`, `menu_name`, `route`, `created_at`, `updated_at`) VALUES
(1, 0, -1, 'Dashboard', 'dashboard.index', NULL, NULL),
(3, 1, -1, 'Total Building', NULL, NULL, NULL),
(4, 1, -1, 'Total Appartment', NULL, NULL, NULL),
(7, 1, -1, 'Total Members', NULL, NULL, NULL),
(11, 1, -1, 'Latest Orders', NULL, NULL, NULL),
(12, 0, -1, 'Basic Info Manage', 'basic-infos.index', NULL, NULL),
(13, 12, 0, 'Edit', 'basic-infos.edit', NULL, NULL),
(14, 0, -1, 'Admin', NULL, NULL, NULL),
(15, 14, 0, 'Role Manage', 'roles.index', NULL, NULL),
(16, -1, 15, 'Add', 'roles.create', NULL, NULL),
(17, -1, 15, 'Edit', 'roles.edit', NULL, NULL),
(18, -1, 15, 'Delete', 'roles.destroy', NULL, NULL),
(19, 14, 0, 'Admin Manage', 'admins.index', NULL, NULL),
(20, -1, 19, 'Add', 'admins.create', NULL, NULL),
(21, -1, 19, 'Edit', 'admins.edit', NULL, NULL),
(22, -1, 19, 'Delete', 'admins.destroy', NULL, NULL),
(23, 0, -1, 'Settings', NULL, NULL, NULL),
(26, 23, -1, 'Update Password', 'admins.update.password', NULL, NULL),
(27, 23, -1, 'Update Details', 'admins.update.details', NULL, NULL),
(28, 0, -1, 'Building Manage', NULL, NULL, NULL),
(29, 28, -1, 'Building', 'building.index', NULL, NULL),
(30, -1, 29, 'Add', 'building.create', NULL, NULL),
(31, -1, 29, 'Edit', 'building.edit', NULL, NULL),
(32, -1, 29, 'Delete', 'building.destroy', NULL, NULL),
(42, 28, -1, 'Appartment', 'appartment.index', NULL, NULL),
(43, -1, 42, 'Add', 'appartment.create', NULL, NULL),
(44, -1, 42, 'Edit', 'appartment.edit', NULL, NULL),
(45, -1, 42, 'Delete', 'appartment.destroy', NULL, NULL),
(46, 28, -1, 'Members', 'members.index', NULL, NULL),
(47, -1, 46, 'Add', 'members.create', NULL, NULL),
(48, -1, 46, 'Edit', 'members.edit', NULL, NULL),
(49, -1, 46, 'Delete', 'members.destroy', NULL, NULL),
(50, 0, -1, 'Family Member', 'family-members.index', NULL, NULL),
(51, 50, -1, 'Add', 'family-members.create', NULL, NULL),
(52, 50, -1, 'Edit', 'family-members.edit', NULL, NULL),
(53, 50, -1, 'Delete', 'family-members.destroy', NULL, NULL),
(54, 0, -1, 'Today\'s Deal Manage', 'deals.index', NULL, NULL),
(55, 54, 0, 'Add', 'deals.create', NULL, NULL),
(56, 54, 0, 'Edit', 'deals.edit', NULL, NULL),
(57, 54, 0, 'Delete', 'deals.destroy', NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_21_001204_create_basic_infos_table', 1),
(6, '2023_12_13_144516_create_categories_table', 1),
(7, '2023_12_26_114309_create_admins_table', 1),
(8, '2024_01_30_123321_create_roles_table', 1),
(9, '2024_01_30_123933_create_privileges_table', 1),
(10, '2024_01_30_140322_create_menus_table', 1),
(11, '2024_07_27_143545_create_buildings_table', 1),
(12, '2024_07_27_143621_create_appartments_table', 1),
(13, '2024_07_27_143649_create_members_table', 1),
(14, '2024_07_27_143708_create_family_members_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(458, 4, 28, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(459, 4, 29, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(460, 4, 30, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(461, 4, 31, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(462, 4, 32, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(463, 4, 33, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(464, 4, 34, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(465, 4, 35, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(466, 4, 36, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(467, 4, 38, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(468, 4, 39, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(469, 4, 40, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(470, 4, 41, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(471, 4, 42, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(472, 4, 43, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(473, 4, 44, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(474, 4, 45, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(475, 4, 46, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(476, 4, 47, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(477, 4, 48, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(478, 4, 49, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(479, 4, 1, '2024-01-31 13:03:26', '2024-01-31 13:03:26'),
(513, 5, 1, '2024-01-31 13:16:03', '2024-01-31 13:16:03'),
(514, 5, 23, '2024-01-31 13:16:03', '2024-01-31 13:16:03'),
(515, 5, 26, '2024-01-31 13:16:03', '2024-01-31 13:16:03'),
(516, 5, 27, '2024-01-31 13:16:03', '2024-01-31 13:16:03'),
(517, 5, 28, '2024-01-31 13:16:03', '2024-01-31 13:16:03'),
(518, 5, 46, '2024-01-31 13:16:03', '2024-01-31 13:16:03'),
(519, 5, 47, '2024-01-31 13:16:03', '2024-01-31 13:16:03'),
(520, 5, 48, '2024-01-31 13:16:03', '2024-01-31 13:16:03'),
(521, 5, 49, '2024-01-31 13:16:03', '2024-01-31 13:16:03'),
(689, 1, 1, '2024-07-29 04:56:49', '2024-07-29 04:56:49'),
(690, 1, 3, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(691, 1, 4, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(692, 1, 7, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(693, 1, 11, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(694, 1, 12, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(695, 1, 13, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(696, 1, 14, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(697, 1, 15, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(698, 1, 16, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(699, 1, 17, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(700, 1, 18, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(701, 1, 19, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(702, 1, 20, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(703, 1, 21, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(704, 1, 22, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(705, 1, 23, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(706, 1, 26, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(707, 1, 27, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(708, 1, 28, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(709, 1, 29, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(710, 1, 30, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(711, 1, 31, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(712, 1, 32, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(713, 1, 42, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(714, 1, 43, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(715, 1, 44, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(716, 1, 45, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(717, 1, 46, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(718, 1, 47, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(719, 1, 48, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(720, 1, 49, '2024-07-29 04:56:50', '2024-07-29 04:56:50'),
(721, 1, 50, '2024-07-29 04:56:51', '2024-07-29 04:56:51'),
(722, 1, 51, '2024-07-29 04:56:51', '2024-07-29 04:56:51'),
(723, 1, 52, '2024-07-29 04:56:51', '2024-07-29 04:56:51'),
(724, 1, 53, '2024-07-29 04:56:51', '2024-07-29 04:56:51'),
(725, 1, 54, '2024-07-29 04:56:51', '2024-07-29 04:56:51'),
(726, 1, 55, '2024-07-29 04:56:51', '2024-07-29 04:56:51'),
(727, 1, 56, '2024-07-29 04:56:51', '2024-07-29 04:56:51'),
(728, 1, 57, '2024-07-29 04:56:51', '2024-07-29 04:56:51'),
(729, 2, 1, '2024-07-29 04:57:13', '2024-07-29 04:57:13'),
(730, 2, 3, '2024-07-29 04:57:13', '2024-07-29 04:57:13'),
(731, 2, 4, '2024-07-29 04:57:13', '2024-07-29 04:57:13'),
(732, 2, 7, '2024-07-29 04:57:13', '2024-07-29 04:57:13'),
(733, 2, 11, '2024-07-29 04:57:13', '2024-07-29 04:57:13'),
(734, 2, 12, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(735, 2, 13, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(736, 2, 14, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(737, 2, 15, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(738, 2, 16, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(739, 2, 17, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(740, 2, 18, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(741, 2, 19, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(742, 2, 20, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(743, 2, 21, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(744, 2, 22, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(745, 2, 23, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(746, 2, 26, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(747, 2, 27, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(748, 2, 28, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(749, 2, 29, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(750, 2, 30, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(751, 2, 31, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(752, 2, 32, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(753, 2, 42, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(754, 2, 43, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(755, 2, 44, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(756, 2, 45, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(757, 2, 46, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(758, 2, 47, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(759, 2, 48, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(760, 2, 49, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(761, 2, 50, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(762, 2, 51, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(763, 2, 52, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(764, 2, 53, '2024-07-29 04:57:14', '2024-07-29 04:57:14'),
(765, 2, 54, '2024-07-29 04:57:15', '2024-07-29 04:57:15'),
(766, 2, 55, '2024-07-29 04:57:15', '2024-07-29 04:57:15'),
(767, 2, 56, '2024-07-29 04:57:15', '2024-07-29 04:57:15'),
(768, 2, 57, '2024-07-29 04:57:15', '2024-07-29 04:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `created_by`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', '2024-07-28 08:46:04', '2024-07-29 04:56:49'),
(2, 1, 'Manager', '2024-07-29 04:57:13', '2024-07-29 04:57:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `default_address` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `appartments`
--
ALTER TABLE `appartments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basic_infos`
--
ALTER TABLE `basic_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `family_members`
--
ALTER TABLE `family_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appartments`
--
ALTER TABLE `appartments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `basic_infos`
--
ALTER TABLE `basic_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family_members`
--
ALTER TABLE `family_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=769;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

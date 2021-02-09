-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2021 at 09:07 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codejsne_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `centers`
--

CREATE TABLE `centers` (
  `id` int(10) UNSIGNED NOT NULL,
  `library_id` int(10) UNSIGNED NOT NULL,
  `name_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `centers`
--

INSERT INTO `centers` (`id`, `library_id`, `name_si`, `name_ta`, `name_en`, `address1_si`, `address1_ta`, `address1_en`, `address2_si`, `address2_ta`, `address2_en`, `telephone`, `fax`, `email`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'ප්‍රාදේශීය සභා මහජන පුස්ථකාලය', 'பிரதேச சபா பொது நூலகம்', 'Pradeshiya Sabha Public Library', 'ප්‍රාදේශීය සභාව', 'பிரதேச சபா', 'Pradeshiya Sabha', 'බුලත්කොහුපිටිය', 'புலத்கோஹுபிட்டி', 'Bulathkohupitiya', '0362247575', '0362247575', NULL, NULL, '2021-02-06 14:33:11', '2021-02-06 14:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designetions`
--

CREATE TABLE `designetions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designetion_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designetion_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designetion_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lendings`
--

CREATE TABLE `lendings` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED DEFAULT NULL,
  `description_si` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ta` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lending_details`
--

CREATE TABLE `lending_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `lending_id` int(10) UNSIGNED DEFAULT NULL,
  `issue_date` date NOT NULL DEFAULT '2021-02-06',
  `return_date` date NOT NULL,
  `fine_amount` double(4,2) NOT NULL,
  `remark_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `libraries`
--

CREATE TABLE `libraries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `libraries`
--

INSERT INTO `libraries` (`id`, `name_si`, `name_ta`, `name_en`, `address1_si`, `address1_ta`, `address1_en`, `address2_si`, `address2_ta`, `address2_en`, `telephone`, `fax`, `email`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'ප්‍රාදේශීය සභා මහජන පුස්ථකාලය', 'பிரதேச சபா பொது நூலகம்', 'Pradeshiya Sabha Public Library', 'ප්‍රාදේශීය සභාව', 'பிரதேச சபா', 'Pradeshiya Sabha', 'බුලත්කොහුපිටිය', 'புலத்கோஹுபிட்டி', 'Bulathkohupitiya', '0362247575', '0362247575', NULL, NULL, NULL, '2021-02-06 14:33:11', '2021-02-06 14:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoryid` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `name_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regdate` date NOT NULL DEFAULT '2021-02-06',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_cats`
--

CREATE TABLE `member_cats` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, '001_create_libraries_table', 1),
(2, '002_create_centers_table', 1),
(3, '003_create_designetions_table', 1),
(4, '004_create_staff_table', 1),
(5, '005_create_users_table', 1),
(6, '006_create_password_resets_table', 1),
(7, '007_create_failed_jobs_table', 1),
(8, '008_create_permission_tables', 1),
(9, '009_create_settings_table', 1),
(10, '010_create_resource_categories_table', 1),
(11, '011_create_resource_types_table', 1),
(12, '012_create_resource_dd_classes_table', 1),
(13, '013_create_resource_dd_divisions_table', 1),
(14, '014_create_resource_dd_sections_table', 1),
(15, '015_create_resource_creators_table', 1),
(16, '016_create_resource_languages_table', 1),
(17, '017_create_resource_publishers_table', 1),
(18, '018_create_resources_table', 1),
(19, '019_create_resource_places_table', 1),
(20, '020_create_resource_donates_table', 1),
(21, '021_create_member_cats_table', 1),
(22, '022_create_members_table', 1),
(23, '023_create_lendings_table', 1),
(24, '024_create_lending_details_table', 1),
(25, '025_create_code_table', 1),
(26, '026_create_survey_suggestions_table', 1),
(27, '027_create_surveys_table', 1),
(28, '028_create_survey_detail_temps_table', 1),
(29, '029_create_survey_details_table', 1),
(30, '030_create_survey_boards_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `category`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '1', NULL, NULL),
(2, 'role-create', 'web', '1', NULL, NULL),
(3, 'role-edit', 'web', '1', NULL, NULL),
(4, 'role-delete', 'web', '1', NULL, NULL),
(5, 'product-list', 'web', '2', NULL, NULL),
(6, 'product-create', 'web', '2', NULL, NULL),
(7, 'product-edit', 'web', '2', NULL, NULL),
(8, 'product-delete', 'web', '2', NULL, NULL),
(9, 'resource-list', 'web', '3', NULL, NULL),
(10, 'resource-create', 'web', '3', NULL, NULL),
(11, 'resource-edit', 'web', '3', NULL, NULL),
(12, 'resource-delete', 'web', '3', NULL, NULL),
(13, 'member-list', 'web', '4', NULL, NULL),
(14, 'member-create', 'web', '4', NULL, NULL),
(15, 'member-edit', 'web', '4', NULL, NULL),
(16, 'member-delete', 'web', '4', NULL, NULL),
(17, 'support_data-list', 'web', '5', NULL, NULL),
(18, 'support_data-create', 'web', '5', NULL, NULL),
(19, 'support_data-edit', 'web', '5', NULL, NULL),
(20, 'support_data-delete', 'web', '5', NULL, NULL),
(21, 'survey-list', 'web', '7', NULL, NULL),
(22, 'survey-create', 'web', '7', NULL, NULL),
(23, 'survey-edit', 'web', '7', NULL, NULL),
(24, 'survey-delete', 'web', '7', NULL, NULL),
(25, 'lenging-list', 'web', '8', NULL, NULL),
(26, 'lenging-create', 'web', '8', NULL, NULL),
(27, 'lenging-edit', 'web', '8', NULL, NULL),
(28, 'lenging-delete', 'web', '8', NULL, NULL),
(29, 'data-import', 'web', '9', NULL, NULL),
(30, 'data-export', 'web', '9', NULL, NULL),
(31, 'code-genarate', 'web', '9', NULL, NULL),
(32, 'setting-list', 'web', '10', NULL, NULL),
(33, 'setting-create', 'web', '10', NULL, NULL),
(34, 'setting-edit', 'web', '10', NULL, NULL),
(35, 'setting-delete', 'web', '10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(10) UNSIGNED NOT NULL,
  `accessionNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `standard_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cretor_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dd_class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dd_devision_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dd_section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ddc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `language_id` bigint(20) UNSIGNED DEFAULT NULL,
  `publisher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_date` date NOT NULL DEFAULT '2021-02-06',
  `edition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(4,2) NOT NULL,
  `publishyear` year(4) DEFAULT NULL,
  `phydetails` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `br_qr_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_categories`
--

CREATE TABLE `resource_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_creators`
--

CREATE TABLE `resource_creators` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_dd_classes`
--

CREATE TABLE `resource_dd_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_dd_divisions`
--

CREATE TABLE `resource_dd_divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dd_class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `devision_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devision_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devision_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devision_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_dd_sections`
--

CREATE TABLE `resource_dd_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dd_class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dd_devision_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_donates`
--

CREATE TABLE `resource_donates` (
  `id` int(10) UNSIGNED NOT NULL,
  `resource_id` int(10) UNSIGNED DEFAULT NULL,
  `doner_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doner_name_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doner_name_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doner_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doner_address1_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doner_address1_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doner_address1_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doner_address2_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doner_address2_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doner_address2_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doner_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doner_gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donete_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donate_date` date NOT NULL DEFAULT '2021-02-06',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_languages`
--

CREATE TABLE `resource_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_places`
--

CREATE TABLE `resource_places` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resource_id` int(10) UNSIGNED DEFAULT NULL,
  `rack` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_publishers`
--

CREATE TABLE `resource_publishers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publisher_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_types`
--

CREATE TABLE `resource_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `type_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2021-02-06 14:31:13', '2021-02-06 14:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Setting` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'lms',
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `Detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `Setting`, `category`, `value`, `Detail`, `created_at`, `updated_at`) VALUES
(1, 'locale_db', '1', '0', 'db details show according to locale', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `center_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designetion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regdate` date NOT NULL DEFAULT '2021-02-06',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `center_id`, `title`, `name_si`, `name_ta`, `name_en`, `address1_si`, `address1_ta`, `address1_en`, `address2_si`, `address2_ta`, `address2_en`, `designetion_id`, `nic`, `mobile`, `birthday`, `gender`, `description`, `regdate`, `image`, `created_at`, `updated_at`) VALUES
(1, 0, 'Mr', 'ඒ.එම්.එන් ශානුක අලහකෝන්', NULL, 'A.M.N.S Alahakoon', 'ගැටියමුල්ල', NULL, 'Getiyamulla', 'අලවතුර', NULL, 'Alawathura', 0, '910053094V', '94715151050', '2021-02-05', 'Male', NULL, '2021-02-01', '', '2021-02-06 14:33:12', '2021-02-06 14:33:12');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL DEFAULT '2021-02-06',
  `total_resources` int(11) DEFAULT NULL,
  `removed_resources` int(11) DEFAULT NULL,
  `lending_resources` int(11) DEFAULT NULL,
  `survey_resources` int(11) DEFAULT NULL,
  `non_survey_resources` int(11) DEFAULT NULL,
  `finalize_date` date DEFAULT NULL,
  `create_by` bigint(20) UNSIGNED DEFAULT NULL,
  `remark_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_boards`
--

CREATE TABLE `survey_boards` (
  `id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `survey_designetion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_details`
--

CREATE TABLE `survey_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED DEFAULT NULL,
  `resource_id` int(10) UNSIGNED DEFAULT NULL,
  `accessionNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `standard_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cretor_id` int(11) DEFAULT NULL,
  `cretor_name_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cretor_name_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cretor_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `type_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center_id` int(11) NOT NULL DEFAULT 1,
  `center_name_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center_name_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date NOT NULL DEFAULT '2021-02-06',
  `edition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(4,2) NOT NULL,
  `phydetails` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `lend` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `survey` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `suggestion_id` int(11) DEFAULT NULL,
  `suggestion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_detail_temps`
--

CREATE TABLE `survey_detail_temps` (
  `id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED DEFAULT NULL,
  `resource_id` int(10) UNSIGNED DEFAULT NULL,
  `survey` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `suggestion_id` int(10) UNSIGNED DEFAULT NULL,
  `check_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_suggestions`
--

CREATE TABLE `survey_suggestions` (
  `id` int(10) UNSIGNED NOT NULL,
  `suggestion_si` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suggestion_ta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suggestion_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `username`, `password`, `staff_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'shanuka.pvt@gmail.com', NULL, 'shanuka', '$2y$10$60FaX3f8FPhGbbK2ASdkNuYq/rcVazd8wCoSEklHyiNvjb8VqVHEm', 1, NULL, '2021-02-06 14:33:12', '2021-02-06 14:33:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `centers_library_id_foreign` (`library_id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designetions`
--
ALTER TABLE `designetions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lendings`
--
ALTER TABLE `lendings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lendings_member_id_foreign` (`member_id`);

--
-- Indexes for table `lending_details`
--
ALTER TABLE `lending_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lending_details_lending_id_foreign` (`lending_id`);

--
-- Indexes for table `libraries`
--
ALTER TABLE `libraries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `members_categoryid_foreign` (`categoryid`);

--
-- Indexes for table `member_cats`
--
ALTER TABLE `member_cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resources_cretor_id_foreign` (`cretor_id`),
  ADD KEY `resources_category_id_foreign` (`category_id`),
  ADD KEY `resources_type_id_foreign` (`type_id`),
  ADD KEY `resources_dd_class_id_foreign` (`dd_class_id`),
  ADD KEY `resources_dd_devision_id_foreign` (`dd_devision_id`),
  ADD KEY `resources_dd_section_id_foreign` (`dd_section_id`),
  ADD KEY `resources_center_id_foreign` (`center_id`),
  ADD KEY `resources_language_id_foreign` (`language_id`),
  ADD KEY `resources_publisher_id_foreign` (`publisher_id`);

--
-- Indexes for table `resource_categories`
--
ALTER TABLE `resource_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource_creators`
--
ALTER TABLE `resource_creators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource_dd_classes`
--
ALTER TABLE `resource_dd_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource_dd_divisions`
--
ALTER TABLE `resource_dd_divisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_dd_divisions_dd_class_id_foreign` (`dd_class_id`);

--
-- Indexes for table `resource_dd_sections`
--
ALTER TABLE `resource_dd_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_dd_sections_dd_class_id_foreign` (`dd_class_id`),
  ADD KEY `resource_dd_sections_dd_devision_id_foreign` (`dd_devision_id`);

--
-- Indexes for table `resource_donates`
--
ALTER TABLE `resource_donates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_donates_resource_id_foreign` (`resource_id`);

--
-- Indexes for table `resource_languages`
--
ALTER TABLE `resource_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource_places`
--
ALTER TABLE `resource_places`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_places_resource_id_foreign` (`resource_id`);

--
-- Indexes for table `resource_publishers`
--
ALTER TABLE `resource_publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource_types`
--
ALTER TABLE `resource_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_types_category_id_foreign` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_center_id_foreign` (`center_id`),
  ADD KEY `staff_designetion_id_foreign` (`designetion_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surveys_create_by_foreign` (`create_by`);

--
-- Indexes for table `survey_boards`
--
ALTER TABLE `survey_boards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_boards_survey_id_foreign` (`survey_id`);

--
-- Indexes for table `survey_details`
--
ALTER TABLE `survey_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_details_survey_id_foreign` (`survey_id`),
  ADD KEY `survey_details_resource_id_foreign` (`resource_id`);

--
-- Indexes for table `survey_detail_temps`
--
ALTER TABLE `survey_detail_temps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_detail_temps_survey_id_foreign` (`survey_id`),
  ADD KEY `survey_detail_temps_resource_id_foreign` (`resource_id`),
  ADD KEY `survey_detail_temps_suggestion_id_foreign` (`suggestion_id`),
  ADD KEY `survey_detail_temps_check_by_foreign` (`check_by`);

--
-- Indexes for table `survey_suggestions`
--
ALTER TABLE `survey_suggestions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_staff_id_foreign` (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designetions`
--
ALTER TABLE `designetions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lendings`
--
ALTER TABLE `lendings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lending_details`
--
ALTER TABLE `lending_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `libraries`
--
ALTER TABLE `libraries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_cats`
--
ALTER TABLE `member_cats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_categories`
--
ALTER TABLE `resource_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_creators`
--
ALTER TABLE `resource_creators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_dd_classes`
--
ALTER TABLE `resource_dd_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_dd_divisions`
--
ALTER TABLE `resource_dd_divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_dd_sections`
--
ALTER TABLE `resource_dd_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_donates`
--
ALTER TABLE `resource_donates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_languages`
--
ALTER TABLE `resource_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_places`
--
ALTER TABLE `resource_places`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_publishers`
--
ALTER TABLE `resource_publishers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_types`
--
ALTER TABLE `resource_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_boards`
--
ALTER TABLE `survey_boards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_details`
--
ALTER TABLE `survey_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_detail_temps`
--
ALTER TABLE `survey_detail_temps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_suggestions`
--
ALTER TABLE `survey_suggestions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `centers`
--
ALTER TABLE `centers`
  ADD CONSTRAINT `centers_library_id_foreign` FOREIGN KEY (`library_id`) REFERENCES `libraries` (`id`);

--
-- Constraints for table `lendings`
--
ALTER TABLE `lendings`
  ADD CONSTRAINT `lendings_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `lending_details`
--
ALTER TABLE `lending_details`
  ADD CONSTRAINT `lending_details_lending_id_foreign` FOREIGN KEY (`lending_id`) REFERENCES `lendings` (`id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_categoryid_foreign` FOREIGN KEY (`categoryid`) REFERENCES `member_cats` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `resource_categories` (`id`),
  ADD CONSTRAINT `resources_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`),
  ADD CONSTRAINT `resources_cretor_id_foreign` FOREIGN KEY (`cretor_id`) REFERENCES `resource_creators` (`id`),
  ADD CONSTRAINT `resources_dd_class_id_foreign` FOREIGN KEY (`dd_class_id`) REFERENCES `resource_dd_classes` (`id`),
  ADD CONSTRAINT `resources_dd_devision_id_foreign` FOREIGN KEY (`dd_devision_id`) REFERENCES `resource_dd_divisions` (`id`),
  ADD CONSTRAINT `resources_dd_section_id_foreign` FOREIGN KEY (`dd_section_id`) REFERENCES `resource_dd_sections` (`id`),
  ADD CONSTRAINT `resources_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `resource_languages` (`id`),
  ADD CONSTRAINT `resources_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `resource_publishers` (`id`),
  ADD CONSTRAINT `resources_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `resource_types` (`id`);

--
-- Constraints for table `resource_dd_divisions`
--
ALTER TABLE `resource_dd_divisions`
  ADD CONSTRAINT `resource_dd_divisions_dd_class_id_foreign` FOREIGN KEY (`dd_class_id`) REFERENCES `resource_dd_classes` (`id`);

--
-- Constraints for table `resource_dd_sections`
--
ALTER TABLE `resource_dd_sections`
  ADD CONSTRAINT `resource_dd_sections_dd_class_id_foreign` FOREIGN KEY (`dd_class_id`) REFERENCES `resource_dd_classes` (`id`),
  ADD CONSTRAINT `resource_dd_sections_dd_devision_id_foreign` FOREIGN KEY (`dd_devision_id`) REFERENCES `resource_dd_divisions` (`id`);

--
-- Constraints for table `resource_donates`
--
ALTER TABLE `resource_donates`
  ADD CONSTRAINT `resource_donates_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`);

--
-- Constraints for table `resource_places`
--
ALTER TABLE `resource_places`
  ADD CONSTRAINT `resource_places_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`);

--
-- Constraints for table `resource_types`
--
ALTER TABLE `resource_types`
  ADD CONSTRAINT `resource_types_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `resource_categories` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`),
  ADD CONSTRAINT `staff_designetion_id_foreign` FOREIGN KEY (`designetion_id`) REFERENCES `designetions` (`id`);

--
-- Constraints for table `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `surveys_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `survey_boards`
--
ALTER TABLE `survey_boards`
  ADD CONSTRAINT `survey_boards_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`);

--
-- Constraints for table `survey_details`
--
ALTER TABLE `survey_details`
  ADD CONSTRAINT `survey_details_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`),
  ADD CONSTRAINT `survey_details_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`);

--
-- Constraints for table `survey_detail_temps`
--
ALTER TABLE `survey_detail_temps`
  ADD CONSTRAINT `survey_detail_temps_check_by_foreign` FOREIGN KEY (`check_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `survey_detail_temps_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`),
  ADD CONSTRAINT `survey_detail_temps_suggestion_id_foreign` FOREIGN KEY (`suggestion_id`) REFERENCES `survey_suggestions` (`id`),
  ADD CONSTRAINT `survey_detail_temps_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

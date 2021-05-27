-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 07:39 PM
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
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `causer_type`, `causer_id`, `properties`, `created_at`, `updated_at`) VALUES
(1, 'default', 'created', 'App\\Models\\User', 1, 'App\\Models\\User', 1, '[]', '2021-05-27 17:37:52', '2021-05-27 17:37:52');

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
(1, 1, 'ප්‍රාදේශීය සභා මහජන පුස්ථකාලය', 'பிரதேச சபா பொது நூலகம்', 'Pradeshiya Sabha Public Library', 'ප්‍රාදේශීය සභාව', 'பிரதேச சபா', 'Pradeshiya Sabha', 'බුලත්කොහුපිටිය', 'புலத்கோஹுபிட்டி', 'Bulathkohupitiya', '0362247575', '0362247575', 'bulathps@gmail.com', NULL, '2021-05-27 17:37:50', '2021-05-27 17:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `center_allocations`
--

CREATE TABLE `center_allocations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `center_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `fine_settles`
--

CREATE TABLE `fine_settles` (
  `id` int(10) UNSIGNED NOT NULL,
  `lending_detail_id` int(10) UNSIGNED DEFAULT NULL,
  `settlement_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settlement_date` date NOT NULL DEFAULT '2021-05-27',
  `receipt_id` int(11) DEFAULT NULL,
  `description_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` int(10) UNSIGNED NOT NULL,
  `gender_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lending_configs`
--

CREATE TABLE `lending_configs` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoryid` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `lending_limit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lending_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lending_details`
--

CREATE TABLE `lending_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `lending_issue_id` int(10) UNSIGNED DEFAULT NULL,
  `lending_return_id` int(10) UNSIGNED DEFAULT NULL,
  `member_id` int(10) UNSIGNED DEFAULT NULL,
  `resource_id` int(10) UNSIGNED DEFAULT NULL,
  `issue_date` date NOT NULL DEFAULT '2021-05-27',
  `return` int(11) NOT NULL DEFAULT 0,
  `return_date` date DEFAULT NULL,
  `fine_amount` double(8,2) DEFAULT NULL,
  `remark_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_by` bigint(20) UNSIGNED DEFAULT NULL,
  `return_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lending_issues`
--

CREATE TABLE `lending_issues` (
  `id` int(10) UNSIGNED NOT NULL,
  `lending_date` date NOT NULL DEFAULT '2021-05-27',
  `member_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lending_returns`
--

CREATE TABLE `lending_returns` (
  `id` int(10) UNSIGNED NOT NULL,
  `lending_date` date NOT NULL DEFAULT '2021-05-27',
  `member_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, 'ප්‍රාදේශීය සභා මහජන පුස්ථකාලය', 'பிரதேச சபா பொது நூலகம்', 'Pradeshiya Sabha Public Library', 'ප්‍රාදේශීය සභාව', 'பிரதேச சபா', 'Pradeshiya Sabha', 'බුලත්කොහුපිටිය', 'புலத்கோஹுபிட்டி', 'Bulathkohupitiya', '0362247575', '0362247575', 'bulathps@gmail.com', NULL, NULL, '2021-05-27 17:37:50', '2021-05-27 17:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `titleid` int(10) UNSIGNED NOT NULL DEFAULT 1,
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
  `genderid` int(10) UNSIGNED DEFAULT NULL,
  `occupation_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Workplace_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Workplace_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Workplace_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regdate` date NOT NULL DEFAULT '2021-05-27',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_id` int(10) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
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
-- Table structure for table `member_guarantors`
--

CREATE TABLE `member_guarantors` (
  `id` int(10) UNSIGNED NOT NULL,
  `titleid` int(10) UNSIGNED NOT NULL DEFAULT 1,
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
  `genderid` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
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
(3, '003_create_genders_table', 1),
(4, '003_create_titles_table', 1),
(5, '004_create_designetions_table', 1),
(6, '005_create_staff_table', 1),
(7, '006_create_center_allocations_table', 1),
(8, '007_create_users_table', 1),
(9, '008_create_password_resets_table', 1),
(10, '009_create_failed_jobs_table', 1),
(11, '010_create_activity_log_table', 1),
(12, '010_create_permission_tables', 1),
(13, '011_create_settings_table', 1),
(14, '012_create_resource_categories_table', 1),
(15, '013_create_resource_types_table', 1),
(16, '014_create_resource_dd_classes_table', 1),
(17, '015_create_resource_dd_divisions_table', 1),
(18, '016_create_resource_dd_sections_table', 1),
(19, '017_create_resource_creators_table', 1),
(20, '018_create_resource_languages_table', 1),
(21, '019_create_resource_publishers_table', 1),
(22, '020_create_resource_racks_table', 1),
(23, '021_create_resource_floors_table', 1),
(24, '022_create_resources_table', 1),
(25, '023_create_resource_donates_table', 1),
(26, '023_create_resource_placements_table', 1),
(27, '024_create_member_cats_table', 1),
(28, '025_create_lending_configs_table', 1),
(29, '026_create_member_guarantors_table', 1),
(30, '027_create_members_table', 1),
(31, '028_create_lending_issues_table', 1),
(32, '028_create_lending_returns_table', 1),
(33, '029_create_lending_details_table', 1),
(34, '030_create_receipts_table', 1),
(35, '031_create_receipt_details_table', 1),
(36, '032_create_fine_settles_table', 1),
(37, '033_create_survey_suggestions_table', 1),
(38, '034_create_surveys_table', 1),
(39, '035_create_survey_detail_temps_table', 1),
(40, '036_create_survey_details_table', 1),
(41, '037_create_survey_boards_table', 1),
(42, '038_create_themes_table', 1),
(43, '039_create_code_table', 1),
(44, '102_create_resource_view', 1),
(45, '103_create_resource_view_all', 1),
(46, '104_create_lending_view', 1),
(47, '104_create_lending_view_all', 1),
(48, '105_create_survey_view', 1),
(49, '106_create_member_view', 1),
(50, '107_create_staff_view', 1),
(51, '108_create_usermember_view', 1),
(52, '108_create_userstaff_view', 1),
(53, '109_create_creator_view', 1);

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
(1, 'user-list', 'web', 'User', NULL, NULL),
(2, 'user-create', 'web', 'User', NULL, NULL),
(3, 'user-edit', 'web', 'User', NULL, NULL),
(4, 'user-delete', 'web', 'User', NULL, NULL),
(5, 'role-list', 'web', 'Role', NULL, NULL),
(6, 'role-create', 'web', 'Role', NULL, NULL),
(7, 'role-edit', 'web', 'Role', NULL, NULL),
(8, 'role-delete', 'web', 'Role', NULL, NULL),
(9, 'resource-list', 'web', 'Resource', NULL, NULL),
(10, 'resource-catalogue', 'web', 'Resource', NULL, NULL),
(11, 'resource-create', 'web', 'Resource', NULL, NULL),
(12, 'resource-edit', 'web', 'Resource', NULL, NULL),
(13, 'resource-delete', 'web', 'Resource', NULL, NULL),
(14, 'resource-import', 'web', 'Resource', NULL, NULL),
(15, 'member-list', 'web', 'Member', NULL, NULL),
(16, 'member-create', 'web', 'Member', NULL, NULL),
(17, 'member-edit', 'web', 'Member', NULL, NULL),
(18, 'member-delete', 'web', 'Member', NULL, NULL),
(19, 'member-import', 'web', 'Member', NULL, NULL),
(20, 'staff-list', 'web', 'Staff', NULL, NULL),
(21, 'staff-create', 'web', 'Staff', NULL, NULL),
(22, 'staff-edit', 'web', 'Staff', NULL, NULL),
(23, 'staff-delete', 'web', 'Staff', NULL, NULL),
(24, 'staff-import', 'web', 'Staff', NULL, NULL),
(25, 'library_support_data-list', 'web', 'Support Data', NULL, NULL),
(26, 'library_support_data-create', 'web', 'Support Data', NULL, NULL),
(27, 'library_support_data-edit', 'web', 'Support Data', NULL, NULL),
(28, 'library_support_data-delete', 'web', 'Support Data', NULL, NULL),
(29, 'library_support_data-import', 'web', 'Support Data', NULL, NULL),
(30, 'member_support_data-list', 'web', 'Support Data', NULL, NULL),
(31, 'member_support_data-create', 'web', 'Support Data', NULL, NULL),
(32, 'member_support_data-edit', 'web', 'Support Data', NULL, NULL),
(33, 'member_support_data-delete', 'web', 'Support Data', NULL, NULL),
(34, 'member_support_data-import', 'web', 'Support Data', NULL, NULL),
(35, 'staff_support_data-list', 'web', 'Support Data', NULL, NULL),
(36, 'staff_support_data-create', 'web', 'Support Data', NULL, NULL),
(37, 'staff_support_data-edit', 'web', 'Support Data', NULL, NULL),
(38, 'staff_support_data-delete', 'web', 'Support Data', NULL, NULL),
(39, 'staff_support_data-import', 'web', 'Support Data', NULL, NULL),
(40, 'resource_support_data-list', 'web', 'Support Data', NULL, NULL),
(41, 'resource_support_data-create', 'web', 'Support Data', NULL, NULL),
(42, 'resource_support_data-edit', 'web', 'Support Data', NULL, NULL),
(43, 'resource_support_data-delete', 'web', 'Support Data', NULL, NULL),
(44, 'resource_support_data-import', 'web', 'Support Data', NULL, NULL),
(45, 'survey_support_data-list', 'web', 'Support Data', NULL, NULL),
(46, 'survey_support_data-create', 'web', 'Support Data', NULL, NULL),
(47, 'survey_support_data-edit', 'web', 'Support Data', NULL, NULL),
(48, 'survey_support_data-delete', 'web', 'Support Data', NULL, NULL),
(49, 'survey_support_data-import', 'web', 'Support Data', NULL, NULL),
(50, 'survey-list', 'web', 'Survey', NULL, NULL),
(51, 'survey-create', 'web', 'Survey', NULL, NULL),
(52, 'survey-edit', 'web', 'Survey', NULL, NULL),
(53, 'survey-finalize', 'web', 'Survey', NULL, NULL),
(54, 'survey-unfinalize', 'web', 'Survey', NULL, NULL),
(55, 'survey-delete', 'web', 'Survey', NULL, NULL),
(56, 'Lenging-issue', 'web', 'Lenging', NULL, NULL),
(57, 'Lenging-return', 'web', 'Lenging', NULL, NULL),
(58, 'lenging-list', 'web', 'Lenging', NULL, NULL),
(59, 'lenging-delete', 'web', 'Lenging', NULL, NULL),
(60, 'date-change', 'web', 'Lenging', NULL, NULL),
(61, 'receipt-list', 'web', 'Receipt', NULL, NULL),
(62, 'receipt-create', 'web', 'Receipt', NULL, NULL),
(63, 'receipt-edit', 'web', 'Receipt', NULL, NULL),
(64, 'receipt-delete', 'web', 'Receipt', NULL, NULL),
(65, 'center-list', 'web', 'Center', NULL, NULL),
(66, 'center-create', 'web', 'Center', NULL, NULL),
(67, 'center-edit', 'web', 'Center', NULL, NULL),
(68, 'center-delete', 'web', 'Center', NULL, NULL),
(69, 'basic_setting-list', 'web', 'Setting', NULL, NULL),
(70, 'basic_setting-edit', 'web', 'Setting', NULL, NULL),
(71, 'lms_setting-list', 'web', 'Setting', NULL, NULL),
(72, 'lms_setting-edit', 'web', 'Setting', NULL, NULL),
(73, 'notification_setting-list', 'web', 'Setting', NULL, NULL),
(74, 'notification_setting-edit', 'web', 'Setting', NULL, NULL),
(75, 'lending_setting-list', 'web', 'Setting', NULL, NULL),
(76, 'lending_setting-edit', 'web', 'Setting', NULL, NULL),
(77, 'resource-report', 'web', 'report', NULL, NULL),
(78, 'member-report', 'web', 'report', NULL, NULL),
(79, 'satff-report', 'web', 'report', NULL, NULL),
(80, 'lending-report', 'web', 'report', NULL, NULL),
(81, 'resource_support_data-report', 'web', 'report', NULL, NULL),
(82, 'member_support_data-report', 'web', 'report', NULL, NULL),
(83, 'staff_support_data-report', 'web', 'report', NULL, NULL),
(84, 'library_support_data-report', 'web', 'report', NULL, NULL),
(85, 'receipt-report', 'web', 'report', NULL, NULL),
(86, 'survey-report', 'web', 'report', NULL, NULL),
(87, 'user-report', 'web', 'report', NULL, NULL),
(88, 'log-report', 'web', 'report', NULL, NULL),
(89, 'activity-log', 'web', 'Activity log', NULL, NULL),
(90, 'code-genarate', 'web', 'Code Genarate', NULL, NULL),
(91, 'dashboard', 'web', 'Dashboard', NULL, NULL),
(92, 'backup', 'web', 'backup', NULL, NULL),
(93, 'restore', 'web', 'backup', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(10) UNSIGNED NOT NULL,
  `receipt_date` date NOT NULL DEFAULT '2021-05-27',
  `member_id` int(10) UNSIGNED DEFAULT NULL,
  `receipts` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `tax` double(8,2) DEFAULT NULL,
  `Payment_methord` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment` double(8,2) DEFAULT NULL,
  `balance` double(8,2) DEFAULT NULL,
  `description_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receipt_details`
--

CREATE TABLE `receipt_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `receipt_id` int(10) UNSIGNED DEFAULT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quentity` double(6,2) DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `note_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `cretor2_id` int(10) UNSIGNED DEFAULT NULL,
  `cretor3_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dd_class_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dd_devision_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dd_section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ddc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `language_id` bigint(20) UNSIGNED DEFAULT NULL,
  `publisher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_date` date NOT NULL DEFAULT '2021-05-27',
  `edition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `publishyear` year(4) DEFAULT NULL,
  `phydetails` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `br_qr_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `titleid` int(10) UNSIGNED DEFAULT NULL,
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
  `genderid` int(10) UNSIGNED DEFAULT NULL,
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
  `titleid` int(10) UNSIGNED DEFAULT NULL,
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
  `genderid` int(10) UNSIGNED DEFAULT NULL,
  `donete_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donate_date` date NOT NULL DEFAULT '2021-05-27',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_floors`
--

CREATE TABLE `resource_floors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `floor_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- Table structure for table `resource_placements`
--

CREATE TABLE `resource_placements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resource_id` int(10) UNSIGNED DEFAULT NULL,
  `rack_id` bigint(20) UNSIGNED DEFAULT NULL,
  `floor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `placement_index` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- Table structure for table `resource_racks`
--

CREATE TABLE `resource_racks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rack_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rack_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rack_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_types`
--

CREATE TABLE `resource_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
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
(1, 'Admin', 'web', '2021-05-27 17:36:13', '2021-05-27 17:36:13');

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
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1);

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
(1, 'locale_db', '1', '0', 'db details show according to locale', NULL, NULL),
(2, 'locale', '1', 'si', 'display Language', NULL, NULL),
(3, 'lending_period', '2', '14', 'Number Of Days to Return Resource', NULL, NULL),
(4, 'fine_rate', '2', '2.00', 'fine rate per Day', NULL, NULL),
(5, 'lending_count', '2', '2', 'Limit of tha Resources lending in one Job', NULL, NULL),
(6, 'default_password', '3', 'code-js', 'Default Password For user Account', NULL, NULL),
(7, 'sms_member_create', '4', '1', 'Send SMS on Member Add', NULL, NULL),
(8, 'sms_user_create', '4', '1', 'Send SMS on User Add', NULL, NULL),
(9, 'sms_issue', '4', '1', 'Send SMS on Resuorce Issue', NULL, NULL),
(10, 'sms_return', '4', '1', 'Send SMS on Resource Return', NULL, NULL),
(11, 'email_user_create', '5', '1', 'Send email on User Add', NULL, NULL),
(12, 'email_member_create', '5', '1', 'Send email on Member Add', NULL, NULL),
(13, 'email_issue', '5', '1', 'Send email on Resuorce Issue', NULL, NULL),
(14, 'email_return', '5', '1', 'Send email on Resource Return', NULL, NULL),
(15, 'default_theme', '6', 'js-blue-dark', 'Defalut Active Theme', NULL, NULL),
(16, 'reminder_msg_si', '7', 'බැහැර දුන් කාළසීමාව අවසන් වී ඇත, කරුණාකර පුස්ථකාල සම්පත් නැවත භාර දීමට කටයුතු කරන්න. ස්තූතියි!', 'Reminder massage for sms and email', NULL, NULL),
(17, 'reminder_msg_ta', '7', '', 'Reminder massage for sms and email', NULL, NULL),
(18, 'reminder_msg_en', '7', 'lending Periode end Plese Return Resources. Thank you!', 'Reminder massage for sms and email', NULL, NULL),
(19, 'email_backup', '8', '1', 'Send backup zip file with email on create backup', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `titleid` int(10) UNSIGNED DEFAULT NULL,
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
  `genderid` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regdate` date NOT NULL DEFAULT '2021-05-27',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `titleid`, `name_si`, `name_ta`, `name_en`, `address1_si`, `address1_ta`, `address1_en`, `address2_si`, `address2_ta`, `address2_en`, `designetion_id`, `nic`, `mobile`, `birthday`, `genderid`, `description`, `regdate`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'ඒ.එම්.එන්.එස් අලහකෝන්', 'ஏ.எம்.என் சானுகா அலககூன்', 'A.M.N.Shanuka Alahakoon', 'ගැටියමුල්ල', 'பிரதேச சபா', 'Getiyamulla', 'අලවතුර', NULL, 'Alawathura', NULL, '910053094V', '94715151050', '1991-01-05', NULL, NULL, '2021-05-01', NULL, '1', '2021-05-27 17:37:51', '2021-05-27 17:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL DEFAULT '2021-05-27',
  `description_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_resources` int(11) DEFAULT NULL,
  `lending_resources` int(11) DEFAULT NULL,
  `survey_resources` int(11) DEFAULT NULL,
  `non_survey_resources` int(11) DEFAULT NULL,
  `finalize` int(11) NOT NULL DEFAULT 0,
  `finalize_date` date DEFAULT NULL,
  `create_by` bigint(20) UNSIGNED DEFAULT NULL,
  `finalize_by` bigint(20) UNSIGNED DEFAULT NULL,
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
  `staff_id` int(10) UNSIGNED DEFAULT NULL,
  `survey_designetion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `center_id` int(11) DEFAULT NULL,
  `center_name_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center_name_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `center_name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `edition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `phydetails` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lend` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `survey` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `suggestion_id` int(11) DEFAULT NULL,
  `suggestion_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suggestion_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suggestion_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_by_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_by_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `survey` int(11) NOT NULL DEFAULT 0,
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
  `suggestion_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suggestion_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suggestion_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_si` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `email`, `email_verified_at`, `username`, `password`, `detail_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'staff', 'shanuka.pvt@gmail.com', NULL, 'shanuka', '$2y$10$5BdLxPhrTIRhBvE/u3VoSuhRsEE5ga8qyo9FWuE80GwVJyqWL2M7.', 1, '1', NULL, '2021-05-27 17:37:52', '2021-05-27 17:37:52');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_creator_data`
-- (See below for the actual view)
--
CREATE TABLE `view_creator_data` (
`id` int(10) unsigned
,`titleid` int(10) unsigned
,`name_si` varchar(255)
,`name_ta` varchar(255)
,`name_en` varchar(255)
,`address1_si` varchar(255)
,`address1_ta` varchar(255)
,`address1_en` varchar(255)
,`address2_si` varchar(255)
,`address2_ta` varchar(255)
,`address2_en` varchar(255)
,`mobile` varchar(255)
,`genderid` int(10) unsigned
,`description` varchar(255)
,`image` varchar(255)
,`created_at` timestamp
,`updated_at` timestamp
,`title_si` varchar(255)
,`title_ta` varchar(255)
,`title_en` varchar(255)
,`gender_si` varchar(255)
,`gender_ta` varchar(255)
,`gender_en` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_lending_data`
-- (See below for the actual view)
--
CREATE TABLE `view_lending_data` (
`id` int(10) unsigned
,`lending_issue_id` int(10) unsigned
,`lending_return_id` int(10) unsigned
,`member_id` int(10) unsigned
,`resource_id` int(10) unsigned
,`issue_date` date
,`return` int(11)
,`return_date` date
,`fine_amount` double(8,2)
,`remark_si` varchar(255)
,`remark_ta` varchar(255)
,`remark_en` varchar(255)
,`issue_by` bigint(20) unsigned
,`return_by` bigint(20) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`accessionNo` varchar(255)
,`standard_number` varchar(255)
,`title_si` varchar(255)
,`title_ta` varchar(255)
,`title_en` varchar(255)
,`category_id` bigint(20) unsigned
,`type_id` bigint(20) unsigned
,`image` varchar(255)
,`center_id` int(10) unsigned
,`member_categoryid` int(10) unsigned
,`member_si` varchar(255)
,`member_ta` varchar(255)
,`member_en` varchar(255)
,`address1_si` varchar(255)
,`address1_ta` varchar(255)
,`address1_en` varchar(255)
,`address2_si` varchar(255)
,`address2_ta` varchar(255)
,`address2_en` varchar(255)
,`mobile` varchar(255)
,`nic` varchar(255)
,`member_category_si` varchar(255)
,`member_category_ta` varchar(255)
,`member_category_en` varchar(255)
,`category_si` varchar(255)
,`category_ta` varchar(255)
,`category_en` varchar(255)
,`type_si` varchar(255)
,`type_ta` varchar(255)
,`type_en` varchar(255)
,`center_si` varchar(255)
,`center_ta` varchar(255)
,`center_en` varchar(255)
,`fine_settle` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_lending_data_all`
-- (See below for the actual view)
--
CREATE TABLE `view_lending_data_all` (
`id` int(10) unsigned
,`lending_issue_id` int(10) unsigned
,`lending_return_id` int(10) unsigned
,`member_id` int(10) unsigned
,`resource_id` int(10) unsigned
,`issue_date` date
,`return` int(11)
,`return_date` date
,`fine_amount` double(8,2)
,`remark_si` varchar(255)
,`remark_ta` varchar(255)
,`remark_en` varchar(255)
,`issue_by` bigint(20) unsigned
,`return_by` bigint(20) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`accessionNo` varchar(255)
,`standard_number` varchar(255)
,`title_si` varchar(255)
,`title_ta` varchar(255)
,`title_en` varchar(255)
,`category_id` bigint(20) unsigned
,`type_id` bigint(20) unsigned
,`image` varchar(255)
,`center_id` int(10) unsigned
,`member_categoryid` int(10) unsigned
,`member_si` varchar(255)
,`member_ta` varchar(255)
,`member_en` varchar(255)
,`address1_si` varchar(255)
,`address1_ta` varchar(255)
,`address1_en` varchar(255)
,`address2_si` varchar(255)
,`address2_ta` varchar(255)
,`address2_en` varchar(255)
,`mobile` varchar(255)
,`nic` varchar(255)
,`member_category_si` varchar(255)
,`member_category_ta` varchar(255)
,`member_category_en` varchar(255)
,`lending_period` varchar(255)
,`category_si` varchar(255)
,`category_ta` varchar(255)
,`category_en` varchar(255)
,`type_si` varchar(255)
,`type_ta` varchar(255)
,`type_en` varchar(255)
,`center_si` varchar(255)
,`center_ta` varchar(255)
,`center_en` varchar(255)
,`fine_settle` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_member_data`
-- (See below for the actual view)
--
CREATE TABLE `view_member_data` (
`id` int(10) unsigned
,`titleid` int(10) unsigned
,`categoryid` int(10) unsigned
,`name_si` varchar(255)
,`name_ta` varchar(255)
,`name_en` varchar(255)
,`address1_si` varchar(255)
,`address1_ta` varchar(255)
,`address1_en` varchar(255)
,`address2_si` varchar(255)
,`address2_ta` varchar(255)
,`address2_en` varchar(255)
,`nic` varchar(255)
,`mobile` varchar(255)
,`birthday` date
,`genderid` int(10) unsigned
,`occupation_si` varchar(255)
,`occupation_ta` varchar(255)
,`occupation_en` varchar(255)
,`Workplace_si` varchar(255)
,`Workplace_ta` varchar(255)
,`Workplace_en` varchar(255)
,`email` varchar(255)
,`description_si` varchar(255)
,`description_ta` varchar(255)
,`description_en` varchar(255)
,`regdate` date
,`image` varchar(255)
,`guarantor_id` int(10) unsigned
,`status` varchar(255)
,`created_at` timestamp
,`updated_at` timestamp
,`category_si` varchar(255)
,`category_ta` varchar(255)
,`category_en` varchar(255)
,`title_si` varchar(255)
,`title_ta` varchar(255)
,`title_en` varchar(255)
,`gender_si` varchar(255)
,`gender_ta` varchar(255)
,`gender_en` varchar(255)
,`guarantor_si` varchar(255)
,`guarantor_ta` varchar(255)
,`guarantor_en` varchar(255)
,`guarantor_nic` varchar(255)
,`guarantor_mobile` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_resource_data`
-- (See below for the actual view)
--
CREATE TABLE `view_resource_data` (
`id` int(10) unsigned
,`accessionNo` varchar(255)
,`standard_number` varchar(255)
,`category_id` bigint(20) unsigned
,`type_id` bigint(20) unsigned
,`cretor_id` int(10) unsigned
,`cretor2_id` int(10) unsigned
,`cretor3_id` int(10) unsigned
,`center_id` int(10) unsigned
,`publisher_id` bigint(20) unsigned
,`image` varchar(255)
,`title_si` varchar(255)
,`title_ta` varchar(255)
,`title_en` varchar(255)
,`ddc` varchar(255)
,`price` double(8,2)
,`phydetails` varchar(255)
,`status` varchar(255)
,`category_si` varchar(255)
,`category_ta` varchar(255)
,`category_en` varchar(255)
,`type_si` varchar(255)
,`type_ta` varchar(255)
,`type_en` varchar(255)
,`name_si` varchar(255)
,`name_ta` varchar(255)
,`name_en` varchar(255)
,`name2_si` varchar(255)
,`name2_ta` varchar(255)
,`name2_en` varchar(255)
,`name3_si` varchar(255)
,`name3_ta` varchar(255)
,`name3_en` varchar(255)
,`publisher_si` varchar(255)
,`publisher_ta` varchar(255)
,`publisher_en` varchar(255)
,`center_si` varchar(255)
,`center_ta` varchar(255)
,`center_en` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_resource_data_all`
-- (See below for the actual view)
--
CREATE TABLE `view_resource_data_all` (
`id` int(10) unsigned
,`accessionNo` varchar(255)
,`standard_number` varchar(255)
,`title_si` varchar(255)
,`title_ta` varchar(255)
,`title_en` varchar(255)
,`cretor_id` int(10) unsigned
,`cretor2_id` int(10) unsigned
,`cretor3_id` int(10) unsigned
,`category_id` bigint(20) unsigned
,`type_id` bigint(20) unsigned
,`dd_class_id` bigint(20) unsigned
,`dd_devision_id` bigint(20) unsigned
,`dd_section_id` bigint(20) unsigned
,`ddc` varchar(255)
,`center_id` int(10) unsigned
,`language_id` bigint(20) unsigned
,`publisher_id` bigint(20) unsigned
,`purchase_date` date
,`edition` varchar(255)
,`price` double(8,2)
,`publishyear` year(4)
,`phydetails` varchar(255)
,`note_si` varchar(255)
,`note_ta` varchar(255)
,`note_en` varchar(255)
,`status` varchar(255)
,`br_qr_code` varchar(255)
,`image` varchar(255)
,`received_type` varchar(255)
,`created_at` timestamp
,`updated_at` timestamp
,`category_si` varchar(255)
,`category_ta` varchar(255)
,`category_en` varchar(255)
,`type_si` varchar(255)
,`type_ta` varchar(255)
,`type_en` varchar(255)
,`name_si` varchar(255)
,`name_ta` varchar(255)
,`name_en` varchar(255)
,`name2_si` varchar(255)
,`name2_ta` varchar(255)
,`name2_en` varchar(255)
,`name3_si` varchar(255)
,`name3_ta` varchar(255)
,`name3_en` varchar(255)
,`publisher_si` varchar(255)
,`publisher_ta` varchar(255)
,`publisher_en` varchar(255)
,`language_si` varchar(255)
,`language_ta` varchar(255)
,`language_en` varchar(255)
,`center_si` varchar(255)
,`center_ta` varchar(255)
,`center_en` varchar(255)
,`class_si` varchar(255)
,`class_ta` varchar(255)
,`class_en` varchar(255)
,`class_code` varchar(255)
,`devision_si` varchar(255)
,`devision_ta` varchar(255)
,`devision_en` varchar(255)
,`devision_code` varchar(255)
,`section_si` varchar(255)
,`section_ta` varchar(255)
,`section_en` varchar(255)
,`section_code` varchar(255)
,`rack_id` bigint(20) unsigned
,`floor_id` bigint(20) unsigned
,`placement_index` varchar(255)
,`rack_si` varchar(255)
,`rack_ta` varchar(255)
,`rack_en` varchar(255)
,`floor_si` varchar(255)
,`floor_ta` varchar(255)
,`floor_en` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_staff_data`
-- (See below for the actual view)
--
CREATE TABLE `view_staff_data` (
`id` int(10) unsigned
,`titleid` int(10) unsigned
,`name_si` varchar(255)
,`name_ta` varchar(255)
,`name_en` varchar(255)
,`address1_si` varchar(255)
,`address1_ta` varchar(255)
,`address1_en` varchar(255)
,`address2_si` varchar(255)
,`address2_ta` varchar(255)
,`address2_en` varchar(255)
,`designetion_id` bigint(20) unsigned
,`nic` varchar(255)
,`mobile` varchar(255)
,`birthday` date
,`genderid` int(10) unsigned
,`description` varchar(255)
,`regdate` date
,`image` varchar(255)
,`status` varchar(255)
,`created_at` timestamp
,`updated_at` timestamp
,`designetion_si` varchar(255)
,`designetion_ta` varchar(255)
,`designetion_en` varchar(255)
,`title_si` varchar(255)
,`title_ta` varchar(255)
,`title_en` varchar(255)
,`gender_si` varchar(255)
,`gender_ta` varchar(255)
,`gender_en` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_survey`
-- (See below for the actual view)
--
CREATE TABLE `view_survey` (
`id` int(10) unsigned
,`survey_id` int(10) unsigned
,`resource_id` int(10) unsigned
,`survey` int(11)
,`suggestion_id` int(10) unsigned
,`check_by` bigint(20) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`accessionNo` varchar(255)
,`standard_number` varchar(255)
,`category_id` bigint(20) unsigned
,`type_id` bigint(20) unsigned
,`center_id` int(10) unsigned
,`publisher_id` bigint(20) unsigned
,`image` varchar(255)
,`title_si` varchar(255)
,`title_ta` varchar(255)
,`title_en` varchar(255)
,`ddc` varchar(255)
,`price` double(8,2)
,`phydetails` varchar(255)
,`suggestion_si` varchar(255)
,`suggestion_ta` varchar(255)
,`suggestion_en` varchar(255)
,`category_si` varchar(255)
,`category_ta` varchar(255)
,`category_en` varchar(255)
,`type_si` varchar(255)
,`type_ta` varchar(255)
,`type_en` varchar(255)
,`name_si` varchar(255)
,`name_ta` varchar(255)
,`name_en` varchar(255)
,`name2_si` varchar(255)
,`name2_ta` varchar(255)
,`name2_en` varchar(255)
,`name3_si` varchar(255)
,`name3_ta` varchar(255)
,`name3_en` varchar(255)
,`publisher_si` varchar(255)
,`publisher_ta` varchar(255)
,`publisher_en` varchar(255)
,`center_si` varchar(255)
,`center_ta` varchar(255)
,`center_en` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_usermember_data`
-- (See below for the actual view)
--
CREATE TABLE `view_usermember_data` (
`id` bigint(20) unsigned
,`user_type` varchar(255)
,`email` varchar(255)
,`email_verified_at` timestamp
,`username` varchar(255)
,`password` varchar(255)
,`detail_id` int(11)
,`status` varchar(255)
,`remember_token` varchar(100)
,`created_at` timestamp
,`updated_at` timestamp
,`name_si` varchar(255)
,`name_ta` varchar(255)
,`name_en` varchar(255)
,`address1_si` varchar(255)
,`address1_ta` varchar(255)
,`address1_en` varchar(255)
,`address2_si` varchar(255)
,`address2_ta` varchar(255)
,`address2_en` varchar(255)
,`nic` varchar(255)
,`mobile` varchar(255)
,`image` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_userstaff_data`
-- (See below for the actual view)
--
CREATE TABLE `view_userstaff_data` (
`id` bigint(20) unsigned
,`user_type` varchar(255)
,`email` varchar(255)
,`email_verified_at` timestamp
,`username` varchar(255)
,`password` varchar(255)
,`detail_id` int(11)
,`status` varchar(255)
,`remember_token` varchar(100)
,`created_at` timestamp
,`updated_at` timestamp
,`name_si` varchar(255)
,`name_ta` varchar(255)
,`name_en` varchar(255)
,`address1_si` varchar(255)
,`address1_ta` varchar(255)
,`address1_en` varchar(255)
,`address2_si` varchar(255)
,`address2_ta` varchar(255)
,`address2_en` varchar(255)
,`designetion_id` bigint(20) unsigned
,`nic` varchar(255)
,`mobile` varchar(255)
,`image` varchar(255)
,`designetion_si` varchar(255)
,`designetion_ta` varchar(255)
,`designetion_en` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `view_creator_data`
--
DROP TABLE IF EXISTS `view_creator_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`codejsne_shanuka`@`localhost` SQL SECURITY DEFINER VIEW `view_creator_data`  AS  select `resource_creators`.`id` AS `id`,`resource_creators`.`titleid` AS `titleid`,`resource_creators`.`name_si` AS `name_si`,`resource_creators`.`name_ta` AS `name_ta`,`resource_creators`.`name_en` AS `name_en`,`resource_creators`.`address1_si` AS `address1_si`,`resource_creators`.`address1_ta` AS `address1_ta`,`resource_creators`.`address1_en` AS `address1_en`,`resource_creators`.`address2_si` AS `address2_si`,`resource_creators`.`address2_ta` AS `address2_ta`,`resource_creators`.`address2_en` AS `address2_en`,`resource_creators`.`mobile` AS `mobile`,`resource_creators`.`genderid` AS `genderid`,`resource_creators`.`description` AS `description`,`resource_creators`.`image` AS `image`,`resource_creators`.`created_at` AS `created_at`,`resource_creators`.`updated_at` AS `updated_at`,`titles`.`title_si` AS `title_si`,`titles`.`title_ta` AS `title_ta`,`titles`.`title_en` AS `title_en`,`genders`.`gender_si` AS `gender_si`,`genders`.`gender_ta` AS `gender_ta`,`genders`.`gender_en` AS `gender_en` from ((`resource_creators` left join `titles` on(`resource_creators`.`titleid` = `titles`.`id`)) left join `genders` on(`resource_creators`.`genderid` = `genders`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_lending_data`
--
DROP TABLE IF EXISTS `view_lending_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`codejsne_shanuka`@`localhost` SQL SECURITY DEFINER VIEW `view_lending_data`  AS  select `lending_details`.`id` AS `id`,`lending_details`.`lending_issue_id` AS `lending_issue_id`,`lending_details`.`lending_return_id` AS `lending_return_id`,`lending_details`.`member_id` AS `member_id`,`lending_details`.`resource_id` AS `resource_id`,`lending_details`.`issue_date` AS `issue_date`,`lending_details`.`return` AS `return`,`lending_details`.`return_date` AS `return_date`,`lending_details`.`fine_amount` AS `fine_amount`,`lending_details`.`remark_si` AS `remark_si`,`lending_details`.`remark_ta` AS `remark_ta`,`lending_details`.`remark_en` AS `remark_en`,`lending_details`.`issue_by` AS `issue_by`,`lending_details`.`return_by` AS `return_by`,`lending_details`.`created_at` AS `created_at`,`lending_details`.`updated_at` AS `updated_at`,`resources`.`accessionNo` AS `accessionNo`,`resources`.`standard_number` AS `standard_number`,`resources`.`title_si` AS `title_si`,`resources`.`title_ta` AS `title_ta`,`resources`.`title_en` AS `title_en`,`resources`.`category_id` AS `category_id`,`resources`.`type_id` AS `type_id`,`resources`.`image` AS `image`,`resources`.`center_id` AS `center_id`,`members`.`categoryid` AS `member_categoryid`,`members`.`name_si` AS `member_si`,`members`.`name_ta` AS `member_ta`,`members`.`name_en` AS `member_en`,`members`.`address1_si` AS `address1_si`,`members`.`address1_ta` AS `address1_ta`,`members`.`address1_en` AS `address1_en`,`members`.`address2_si` AS `address2_si`,`members`.`address2_ta` AS `address2_ta`,`members`.`address2_en` AS `address2_en`,`members`.`mobile` AS `mobile`,`members`.`nic` AS `nic`,`member_cats`.`category_si` AS `member_category_si`,`member_cats`.`category_ta` AS `member_category_ta`,`member_cats`.`category_en` AS `member_category_en`,`resource_categories`.`category_si` AS `category_si`,`resource_categories`.`category_ta` AS `category_ta`,`resource_categories`.`category_en` AS `category_en`,`resource_types`.`type_si` AS `type_si`,`resource_types`.`type_ta` AS `type_ta`,`resource_types`.`type_en` AS `type_en`,`centers`.`name_si` AS `center_si`,`centers`.`name_ta` AS `center_ta`,`centers`.`name_en` AS `center_en`,`fine_settles`.`id` AS `fine_settle` from (((((((`lending_details` left join `resources` on(`lending_details`.`resource_id` = `resources`.`id`)) left join `members` on(`lending_details`.`member_id` = `members`.`id`)) left join `member_cats` on(`members`.`categoryid` = `member_cats`.`id`)) left join `resource_categories` on(`resources`.`category_id` = `resource_categories`.`id`)) left join `resource_types` on(`resources`.`type_id` = `resource_types`.`id`)) left join `centers` on(`resources`.`center_id` = `centers`.`id`)) left join `fine_settles` on(`lending_details`.`id` = `fine_settles`.`lending_detail_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_lending_data_all`
--
DROP TABLE IF EXISTS `view_lending_data_all`;

CREATE ALGORITHM=UNDEFINED DEFINER=`codejsne_shanuka`@`localhost` SQL SECURITY DEFINER VIEW `view_lending_data_all`  AS  select `lending_details`.`id` AS `id`,`lending_details`.`lending_issue_id` AS `lending_issue_id`,`lending_details`.`lending_return_id` AS `lending_return_id`,`lending_details`.`member_id` AS `member_id`,`lending_details`.`resource_id` AS `resource_id`,`lending_details`.`issue_date` AS `issue_date`,`lending_details`.`return` AS `return`,`lending_details`.`return_date` AS `return_date`,`lending_details`.`fine_amount` AS `fine_amount`,`lending_details`.`remark_si` AS `remark_si`,`lending_details`.`remark_ta` AS `remark_ta`,`lending_details`.`remark_en` AS `remark_en`,`lending_details`.`issue_by` AS `issue_by`,`lending_details`.`return_by` AS `return_by`,`lending_details`.`created_at` AS `created_at`,`lending_details`.`updated_at` AS `updated_at`,`resources`.`accessionNo` AS `accessionNo`,`resources`.`standard_number` AS `standard_number`,`resources`.`title_si` AS `title_si`,`resources`.`title_ta` AS `title_ta`,`resources`.`title_en` AS `title_en`,`resources`.`category_id` AS `category_id`,`resources`.`type_id` AS `type_id`,`resources`.`image` AS `image`,`resources`.`center_id` AS `center_id`,`members`.`categoryid` AS `member_categoryid`,`members`.`name_si` AS `member_si`,`members`.`name_ta` AS `member_ta`,`members`.`name_en` AS `member_en`,`members`.`address1_si` AS `address1_si`,`members`.`address1_ta` AS `address1_ta`,`members`.`address1_en` AS `address1_en`,`members`.`address2_si` AS `address2_si`,`members`.`address2_ta` AS `address2_ta`,`members`.`address2_en` AS `address2_en`,`members`.`mobile` AS `mobile`,`members`.`nic` AS `nic`,`member_cats`.`category_si` AS `member_category_si`,`member_cats`.`category_ta` AS `member_category_ta`,`member_cats`.`category_en` AS `member_category_en`,`lending_configs`.`lending_period` AS `lending_period`,`resource_categories`.`category_si` AS `category_si`,`resource_categories`.`category_ta` AS `category_ta`,`resource_categories`.`category_en` AS `category_en`,`resource_types`.`type_si` AS `type_si`,`resource_types`.`type_ta` AS `type_ta`,`resource_types`.`type_en` AS `type_en`,`centers`.`name_si` AS `center_si`,`centers`.`name_ta` AS `center_ta`,`centers`.`name_en` AS `center_en`,`fine_settles`.`id` AS `fine_settle` from ((((((((`lending_details` left join `resources` on(`lending_details`.`resource_id` = `resources`.`id`)) left join `members` on(`lending_details`.`member_id` = `members`.`id`)) left join `member_cats` on(`members`.`categoryid` = `member_cats`.`id`)) left join `lending_configs` on(`members`.`categoryid` = `lending_configs`.`categoryid`)) left join `resource_categories` on(`resources`.`category_id` = `resource_categories`.`id`)) left join `resource_types` on(`resources`.`type_id` = `resource_types`.`id`)) left join `centers` on(`resources`.`center_id` = `centers`.`id`)) left join `fine_settles` on(`lending_details`.`id` = `fine_settles`.`lending_detail_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_member_data`
--
DROP TABLE IF EXISTS `view_member_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`codejsne_shanuka`@`localhost` SQL SECURITY DEFINER VIEW `view_member_data`  AS  select `members`.`id` AS `id`,`members`.`titleid` AS `titleid`,`members`.`categoryid` AS `categoryid`,`members`.`name_si` AS `name_si`,`members`.`name_ta` AS `name_ta`,`members`.`name_en` AS `name_en`,`members`.`address1_si` AS `address1_si`,`members`.`address1_ta` AS `address1_ta`,`members`.`address1_en` AS `address1_en`,`members`.`address2_si` AS `address2_si`,`members`.`address2_ta` AS `address2_ta`,`members`.`address2_en` AS `address2_en`,`members`.`nic` AS `nic`,`members`.`mobile` AS `mobile`,`members`.`birthday` AS `birthday`,`members`.`genderid` AS `genderid`,`members`.`occupation_si` AS `occupation_si`,`members`.`occupation_ta` AS `occupation_ta`,`members`.`occupation_en` AS `occupation_en`,`members`.`Workplace_si` AS `Workplace_si`,`members`.`Workplace_ta` AS `Workplace_ta`,`members`.`Workplace_en` AS `Workplace_en`,`members`.`email` AS `email`,`members`.`description_si` AS `description_si`,`members`.`description_ta` AS `description_ta`,`members`.`description_en` AS `description_en`,`members`.`regdate` AS `regdate`,`members`.`image` AS `image`,`members`.`guarantor_id` AS `guarantor_id`,`members`.`status` AS `status`,`members`.`created_at` AS `created_at`,`members`.`updated_at` AS `updated_at`,`member_cats`.`category_si` AS `category_si`,`member_cats`.`category_ta` AS `category_ta`,`member_cats`.`category_en` AS `category_en`,`titles`.`title_si` AS `title_si`,`titles`.`title_ta` AS `title_ta`,`titles`.`title_en` AS `title_en`,`genders`.`gender_si` AS `gender_si`,`genders`.`gender_ta` AS `gender_ta`,`genders`.`gender_en` AS `gender_en`,`member_guarantors`.`name_si` AS `guarantor_si`,`member_guarantors`.`name_ta` AS `guarantor_ta`,`member_guarantors`.`name_en` AS `guarantor_en`,`member_guarantors`.`nic` AS `guarantor_nic`,`member_guarantors`.`mobile` AS `guarantor_mobile` from ((((`members` left join `member_cats` on(`members`.`categoryid` = `member_cats`.`id`)) left join `titles` on(`members`.`titleid` = `titles`.`id`)) left join `genders` on(`members`.`genderid` = `genders`.`id`)) left join `member_guarantors` on(`members`.`guarantor_id` = `member_guarantors`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_resource_data`
--
DROP TABLE IF EXISTS `view_resource_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`codejsne_shanuka`@`localhost` SQL SECURITY DEFINER VIEW `view_resource_data`  AS  select `resources`.`id` AS `id`,`resources`.`accessionNo` AS `accessionNo`,`resources`.`standard_number` AS `standard_number`,`resources`.`category_id` AS `category_id`,`resources`.`type_id` AS `type_id`,`resources`.`cretor_id` AS `cretor_id`,`resources`.`cretor2_id` AS `cretor2_id`,`resources`.`cretor3_id` AS `cretor3_id`,`resources`.`center_id` AS `center_id`,`resources`.`publisher_id` AS `publisher_id`,`resources`.`image` AS `image`,`resources`.`title_si` AS `title_si`,`resources`.`title_ta` AS `title_ta`,`resources`.`title_en` AS `title_en`,`resources`.`ddc` AS `ddc`,`resources`.`price` AS `price`,`resources`.`phydetails` AS `phydetails`,`resources`.`status` AS `status`,`resource_categories`.`category_si` AS `category_si`,`resource_categories`.`category_ta` AS `category_ta`,`resource_categories`.`category_en` AS `category_en`,`resource_types`.`type_si` AS `type_si`,`resource_types`.`type_ta` AS `type_ta`,`resource_types`.`type_en` AS `type_en`,`creator1`.`name_si` AS `name_si`,`creator1`.`name_ta` AS `name_ta`,`creator1`.`name_en` AS `name_en`,`creator2`.`name_si` AS `name2_si`,`creator2`.`name_ta` AS `name2_ta`,`creator2`.`name_en` AS `name2_en`,`creator3`.`name_si` AS `name3_si`,`creator3`.`name_ta` AS `name3_ta`,`creator3`.`name_en` AS `name3_en`,`resource_publishers`.`publisher_si` AS `publisher_si`,`resource_publishers`.`publisher_ta` AS `publisher_ta`,`resource_publishers`.`publisher_en` AS `publisher_en`,`centers`.`name_si` AS `center_si`,`centers`.`name_ta` AS `center_ta`,`centers`.`name_en` AS `center_en` from (((((((`resources` left join `resource_categories` on(`resources`.`category_id` = `resource_categories`.`id`)) left join `resource_types` on(`resources`.`type_id` = `resource_types`.`id`)) left join `resource_creators` `creator1` on(`resources`.`cretor_id` = `creator1`.`id`)) left join `resource_creators` `creator2` on(`resources`.`cretor2_id` = `creator2`.`id`)) left join `resource_creators` `creator3` on(`resources`.`cretor3_id` = `creator3`.`id`)) left join `resource_publishers` on(`resources`.`publisher_id` = `resource_publishers`.`id`)) left join `centers` on(`resources`.`center_id` = `centers`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_resource_data_all`
--
DROP TABLE IF EXISTS `view_resource_data_all`;

CREATE ALGORITHM=UNDEFINED DEFINER=`codejsne_shanuka`@`localhost` SQL SECURITY DEFINER VIEW `view_resource_data_all`  AS  select `resources`.`id` AS `id`,`resources`.`accessionNo` AS `accessionNo`,`resources`.`standard_number` AS `standard_number`,`resources`.`title_si` AS `title_si`,`resources`.`title_ta` AS `title_ta`,`resources`.`title_en` AS `title_en`,`resources`.`cretor_id` AS `cretor_id`,`resources`.`cretor2_id` AS `cretor2_id`,`resources`.`cretor3_id` AS `cretor3_id`,`resources`.`category_id` AS `category_id`,`resources`.`type_id` AS `type_id`,`resources`.`dd_class_id` AS `dd_class_id`,`resources`.`dd_devision_id` AS `dd_devision_id`,`resources`.`dd_section_id` AS `dd_section_id`,`resources`.`ddc` AS `ddc`,`resources`.`center_id` AS `center_id`,`resources`.`language_id` AS `language_id`,`resources`.`publisher_id` AS `publisher_id`,`resources`.`purchase_date` AS `purchase_date`,`resources`.`edition` AS `edition`,`resources`.`price` AS `price`,`resources`.`publishyear` AS `publishyear`,`resources`.`phydetails` AS `phydetails`,`resources`.`note_si` AS `note_si`,`resources`.`note_ta` AS `note_ta`,`resources`.`note_en` AS `note_en`,`resources`.`status` AS `status`,`resources`.`br_qr_code` AS `br_qr_code`,`resources`.`image` AS `image`,`resources`.`received_type` AS `received_type`,`resources`.`created_at` AS `created_at`,`resources`.`updated_at` AS `updated_at`,`resource_categories`.`category_si` AS `category_si`,`resource_categories`.`category_ta` AS `category_ta`,`resource_categories`.`category_en` AS `category_en`,`resource_types`.`type_si` AS `type_si`,`resource_types`.`type_ta` AS `type_ta`,`resource_types`.`type_en` AS `type_en`,`creator1`.`name_si` AS `name_si`,`creator1`.`name_ta` AS `name_ta`,`creator1`.`name_en` AS `name_en`,`creator2`.`name_si` AS `name2_si`,`creator2`.`name_ta` AS `name2_ta`,`creator2`.`name_en` AS `name2_en`,`creator3`.`name_si` AS `name3_si`,`creator3`.`name_ta` AS `name3_ta`,`creator3`.`name_en` AS `name3_en`,`resource_publishers`.`publisher_si` AS `publisher_si`,`resource_publishers`.`publisher_ta` AS `publisher_ta`,`resource_publishers`.`publisher_en` AS `publisher_en`,`resource_languages`.`language_si` AS `language_si`,`resource_languages`.`language_ta` AS `language_ta`,`resource_languages`.`language_en` AS `language_en`,`centers`.`name_si` AS `center_si`,`centers`.`name_ta` AS `center_ta`,`centers`.`name_en` AS `center_en`,`resource_dd_classes`.`class_si` AS `class_si`,`resource_dd_classes`.`class_ta` AS `class_ta`,`resource_dd_classes`.`class_en` AS `class_en`,`resource_dd_classes`.`class_code` AS `class_code`,`resource_dd_divisions`.`devision_si` AS `devision_si`,`resource_dd_divisions`.`devision_ta` AS `devision_ta`,`resource_dd_divisions`.`devision_en` AS `devision_en`,`resource_dd_divisions`.`devision_code` AS `devision_code`,`resource_dd_sections`.`section_si` AS `section_si`,`resource_dd_sections`.`section_ta` AS `section_ta`,`resource_dd_sections`.`section_en` AS `section_en`,`resource_dd_sections`.`section_code` AS `section_code`,`resource_placements`.`rack_id` AS `rack_id`,`resource_placements`.`floor_id` AS `floor_id`,`resource_placements`.`placement_index` AS `placement_index`,`resource_racks`.`rack_si` AS `rack_si`,`resource_racks`.`rack_ta` AS `rack_ta`,`resource_racks`.`rack_en` AS `rack_en`,`resource_floors`.`floor_si` AS `floor_si`,`resource_floors`.`floor_ta` AS `floor_ta`,`resource_floors`.`floor_en` AS `floor_en` from ((((((((((((((`resources` left join `resource_categories` on(`resources`.`category_id` = `resource_categories`.`id`)) left join `resource_types` on(`resources`.`type_id` = `resource_types`.`id`)) left join `resource_creators` `creator1` on(`resources`.`cretor_id` = `creator1`.`id`)) left join `resource_creators` `creator2` on(`resources`.`cretor2_id` = `creator2`.`id`)) left join `resource_creators` `creator3` on(`resources`.`cretor3_id` = `creator3`.`id`)) left join `resource_publishers` on(`resources`.`publisher_id` = `resource_publishers`.`id`)) left join `centers` on(`resources`.`center_id` = `centers`.`id`)) left join `resource_languages` on(`resources`.`language_id` = `resource_languages`.`id`)) left join `resource_dd_classes` on(`resources`.`dd_class_id` = `resource_dd_classes`.`id`)) left join `resource_dd_divisions` on(`resources`.`dd_devision_id` = `resource_dd_divisions`.`id`)) left join `resource_dd_sections` on(`resources`.`dd_section_id` = `resource_dd_sections`.`id`)) left join `resource_placements` on(`resources`.`id` = `resource_placements`.`resource_id`)) left join `resource_racks` on(`resource_placements`.`rack_id` = `resource_racks`.`id`)) left join `resource_floors` on(`resource_placements`.`floor_id` = `resource_floors`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_staff_data`
--
DROP TABLE IF EXISTS `view_staff_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`codejsne_shanuka`@`localhost` SQL SECURITY DEFINER VIEW `view_staff_data`  AS  select `staff`.`id` AS `id`,`staff`.`titleid` AS `titleid`,`staff`.`name_si` AS `name_si`,`staff`.`name_ta` AS `name_ta`,`staff`.`name_en` AS `name_en`,`staff`.`address1_si` AS `address1_si`,`staff`.`address1_ta` AS `address1_ta`,`staff`.`address1_en` AS `address1_en`,`staff`.`address2_si` AS `address2_si`,`staff`.`address2_ta` AS `address2_ta`,`staff`.`address2_en` AS `address2_en`,`staff`.`designetion_id` AS `designetion_id`,`staff`.`nic` AS `nic`,`staff`.`mobile` AS `mobile`,`staff`.`birthday` AS `birthday`,`staff`.`genderid` AS `genderid`,`staff`.`description` AS `description`,`staff`.`regdate` AS `regdate`,`staff`.`image` AS `image`,`staff`.`status` AS `status`,`staff`.`created_at` AS `created_at`,`staff`.`updated_at` AS `updated_at`,`designetions`.`designetion_si` AS `designetion_si`,`designetions`.`designetion_ta` AS `designetion_ta`,`designetions`.`designetion_en` AS `designetion_en`,`titles`.`title_si` AS `title_si`,`titles`.`title_ta` AS `title_ta`,`titles`.`title_en` AS `title_en`,`genders`.`gender_si` AS `gender_si`,`genders`.`gender_ta` AS `gender_ta`,`genders`.`gender_en` AS `gender_en` from (((`staff` left join `designetions` on(`staff`.`designetion_id` = `designetions`.`id`)) left join `titles` on(`staff`.`titleid` = `titles`.`id`)) left join `genders` on(`staff`.`genderid` = `genders`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_survey`
--
DROP TABLE IF EXISTS `view_survey`;

CREATE ALGORITHM=UNDEFINED DEFINER=`codejsne_shanuka`@`localhost` SQL SECURITY DEFINER VIEW `view_survey`  AS  select `survey_detail_temps`.`id` AS `id`,`survey_detail_temps`.`survey_id` AS `survey_id`,`survey_detail_temps`.`resource_id` AS `resource_id`,`survey_detail_temps`.`survey` AS `survey`,`survey_detail_temps`.`suggestion_id` AS `suggestion_id`,`survey_detail_temps`.`check_by` AS `check_by`,`survey_detail_temps`.`created_at` AS `created_at`,`survey_detail_temps`.`updated_at` AS `updated_at`,`resources`.`accessionNo` AS `accessionNo`,`resources`.`standard_number` AS `standard_number`,`resources`.`category_id` AS `category_id`,`resources`.`type_id` AS `type_id`,`resources`.`center_id` AS `center_id`,`resources`.`publisher_id` AS `publisher_id`,`resources`.`image` AS `image`,`resources`.`title_si` AS `title_si`,`resources`.`title_ta` AS `title_ta`,`resources`.`title_en` AS `title_en`,`resources`.`ddc` AS `ddc`,`resources`.`price` AS `price`,`resources`.`phydetails` AS `phydetails`,`survey_suggestions`.`suggestion_si` AS `suggestion_si`,`survey_suggestions`.`suggestion_ta` AS `suggestion_ta`,`survey_suggestions`.`suggestion_en` AS `suggestion_en`,`resource_categories`.`category_si` AS `category_si`,`resource_categories`.`category_ta` AS `category_ta`,`resource_categories`.`category_en` AS `category_en`,`resource_types`.`type_si` AS `type_si`,`resource_types`.`type_ta` AS `type_ta`,`resource_types`.`type_en` AS `type_en`,`creator1`.`name_si` AS `name_si`,`creator1`.`name_ta` AS `name_ta`,`creator1`.`name_en` AS `name_en`,`creator2`.`name_si` AS `name2_si`,`creator2`.`name_ta` AS `name2_ta`,`creator2`.`name_en` AS `name2_en`,`creator3`.`name_si` AS `name3_si`,`creator3`.`name_ta` AS `name3_ta`,`creator3`.`name_en` AS `name3_en`,`resource_publishers`.`publisher_si` AS `publisher_si`,`resource_publishers`.`publisher_ta` AS `publisher_ta`,`resource_publishers`.`publisher_en` AS `publisher_en`,`centers`.`name_si` AS `center_si`,`centers`.`name_ta` AS `center_ta`,`centers`.`name_en` AS `center_en` from (((((((((`survey_detail_temps` left join `resources` on(`survey_detail_temps`.`resource_id` = `resources`.`id`)) left join `survey_suggestions` on(`survey_detail_temps`.`suggestion_id` = `survey_suggestions`.`id`)) left join `resource_categories` on(`resources`.`category_id` = `resource_categories`.`id`)) left join `resource_types` on(`resources`.`type_id` = `resource_types`.`id`)) left join `resource_creators` `creator1` on(`resources`.`cretor_id` = `creator1`.`id`)) left join `resource_creators` `creator2` on(`resources`.`cretor2_id` = `creator2`.`id`)) left join `resource_creators` `creator3` on(`resources`.`cretor3_id` = `creator3`.`id`)) left join `resource_publishers` on(`resources`.`publisher_id` = `resource_publishers`.`id`)) left join `centers` on(`resources`.`center_id` = `centers`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_usermember_data`
--
DROP TABLE IF EXISTS `view_usermember_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`codejsne_shanuka`@`localhost` SQL SECURITY DEFINER VIEW `view_usermember_data`  AS  select `users`.`id` AS `id`,`users`.`user_type` AS `user_type`,`users`.`email` AS `email`,`users`.`email_verified_at` AS `email_verified_at`,`users`.`username` AS `username`,`users`.`password` AS `password`,`users`.`detail_id` AS `detail_id`,`users`.`status` AS `status`,`users`.`remember_token` AS `remember_token`,`users`.`created_at` AS `created_at`,`users`.`updated_at` AS `updated_at`,`members`.`name_si` AS `name_si`,`members`.`name_ta` AS `name_ta`,`members`.`name_en` AS `name_en`,`members`.`address1_si` AS `address1_si`,`members`.`address1_ta` AS `address1_ta`,`members`.`address1_en` AS `address1_en`,`members`.`address2_si` AS `address2_si`,`members`.`address2_ta` AS `address2_ta`,`members`.`address2_en` AS `address2_en`,`members`.`nic` AS `nic`,`members`.`mobile` AS `mobile`,`members`.`image` AS `image` from (`users` left join `members` on(`users`.`detail_id` = `members`.`id`)) where `users`.`user_type` = 'member' ;

-- --------------------------------------------------------

--
-- Structure for view `view_userstaff_data`
--
DROP TABLE IF EXISTS `view_userstaff_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`codejsne_shanuka`@`localhost` SQL SECURITY DEFINER VIEW `view_userstaff_data`  AS  select `users`.`id` AS `id`,`users`.`user_type` AS `user_type`,`users`.`email` AS `email`,`users`.`email_verified_at` AS `email_verified_at`,`users`.`username` AS `username`,`users`.`password` AS `password`,`users`.`detail_id` AS `detail_id`,`users`.`status` AS `status`,`users`.`remember_token` AS `remember_token`,`users`.`created_at` AS `created_at`,`users`.`updated_at` AS `updated_at`,`staff`.`name_si` AS `name_si`,`staff`.`name_ta` AS `name_ta`,`staff`.`name_en` AS `name_en`,`staff`.`address1_si` AS `address1_si`,`staff`.`address1_ta` AS `address1_ta`,`staff`.`address1_en` AS `address1_en`,`staff`.`address2_si` AS `address2_si`,`staff`.`address2_ta` AS `address2_ta`,`staff`.`address2_en` AS `address2_en`,`staff`.`designetion_id` AS `designetion_id`,`staff`.`nic` AS `nic`,`staff`.`mobile` AS `mobile`,`staff`.`image` AS `image`,`designetions`.`designetion_si` AS `designetion_si`,`designetions`.`designetion_ta` AS `designetion_ta`,`designetions`.`designetion_en` AS `designetion_en` from ((`users` left join `staff` on(`users`.`detail_id` = `staff`.`id`)) left join `designetions` on(`staff`.`designetion_id` = `designetions`.`id`)) where `users`.`user_type` = 'staff' ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `centers_library_id_foreign` (`library_id`);

--
-- Indexes for table `center_allocations`
--
ALTER TABLE `center_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `center_allocations_staff_id_foreign` (`staff_id`),
  ADD KEY `center_allocations_center_id_foreign` (`center_id`);

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
-- Indexes for table `fine_settles`
--
ALTER TABLE `fine_settles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fine_settles_lending_detail_id_foreign` (`lending_detail_id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lending_configs`
--
ALTER TABLE `lending_configs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lending_configs_categoryid_foreign` (`categoryid`);

--
-- Indexes for table `lending_details`
--
ALTER TABLE `lending_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lending_details_lending_issue_id_foreign` (`lending_issue_id`),
  ADD KEY `lending_details_lending_return_id_foreign` (`lending_return_id`),
  ADD KEY `lending_details_member_id_foreign` (`member_id`),
  ADD KEY `lending_details_resource_id_foreign` (`resource_id`),
  ADD KEY `lending_details_issue_by_foreign` (`issue_by`),
  ADD KEY `lending_details_return_by_foreign` (`return_by`);

--
-- Indexes for table `lending_issues`
--
ALTER TABLE `lending_issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lending_issues_member_id_foreign` (`member_id`);

--
-- Indexes for table `lending_returns`
--
ALTER TABLE `lending_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lending_returns_member_id_foreign` (`member_id`);

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
  ADD UNIQUE KEY `members_email_unique` (`email`),
  ADD KEY `members_titleid_foreign` (`titleid`),
  ADD KEY `members_categoryid_foreign` (`categoryid`),
  ADD KEY `members_genderid_foreign` (`genderid`),
  ADD KEY `members_guarantor_id_foreign` (`guarantor_id`);

--
-- Indexes for table `member_cats`
--
ALTER TABLE `member_cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_guarantors`
--
ALTER TABLE `member_guarantors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_guarantors_titleid_foreign` (`titleid`),
  ADD KEY `member_guarantors_genderid_foreign` (`genderid`);

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
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipts_member_id_foreign` (`member_id`),
  ADD KEY `receipts_user_id_foreign` (`user_id`);

--
-- Indexes for table `receipt_details`
--
ALTER TABLE `receipt_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipt_details_receipt_id_foreign` (`receipt_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resources_cretor_id_foreign` (`cretor_id`),
  ADD KEY `resources_cretor2_id_foreign` (`cretor2_id`),
  ADD KEY `resources_cretor3_id_foreign` (`cretor3_id`),
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_creators_titleid_foreign` (`titleid`),
  ADD KEY `resource_creators_genderid_foreign` (`genderid`);

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
  ADD KEY `resource_donates_resource_id_foreign` (`resource_id`),
  ADD KEY `resource_donates_titleid_foreign` (`titleid`),
  ADD KEY `resource_donates_genderid_foreign` (`genderid`);

--
-- Indexes for table `resource_floors`
--
ALTER TABLE `resource_floors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_floors_rack_id_foreign` (`rack_id`);

--
-- Indexes for table `resource_languages`
--
ALTER TABLE `resource_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource_placements`
--
ALTER TABLE `resource_placements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_placements_resource_id_foreign` (`resource_id`),
  ADD KEY `resource_placements_rack_id_foreign` (`rack_id`),
  ADD KEY `resource_placements_floor_id_foreign` (`floor_id`);

--
-- Indexes for table `resource_publishers`
--
ALTER TABLE `resource_publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource_racks`
--
ALTER TABLE `resource_racks`
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
  ADD KEY `staff_titleid_foreign` (`titleid`),
  ADD KEY `staff_designetion_id_foreign` (`designetion_id`),
  ADD KEY `staff_genderid_foreign` (`genderid`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surveys_create_by_foreign` (`create_by`),
  ADD KEY `surveys_finalize_by_foreign` (`finalize_by`);

--
-- Indexes for table `survey_boards`
--
ALTER TABLE `survey_boards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_boards_survey_id_foreign` (`survey_id`),
  ADD KEY `survey_boards_staff_id_foreign` (`staff_id`);

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
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `themes_user_id_foreign` (`user_id`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
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
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `center_allocations`
--
ALTER TABLE `center_allocations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `fine_settles`
--
ALTER TABLE `fine_settles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lending_configs`
--
ALTER TABLE `lending_configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lending_details`
--
ALTER TABLE `lending_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lending_issues`
--
ALTER TABLE `lending_issues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lending_returns`
--
ALTER TABLE `lending_returns`
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
-- AUTO_INCREMENT for table `member_guarantors`
--
ALTER TABLE `member_guarantors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt_details`
--
ALTER TABLE `receipt_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `resource_floors`
--
ALTER TABLE `resource_floors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_languages`
--
ALTER TABLE `resource_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_placements`
--
ALTER TABLE `resource_placements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_publishers`
--
ALTER TABLE `resource_publishers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_racks`
--
ALTER TABLE `resource_racks`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
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
-- Constraints for table `center_allocations`
--
ALTER TABLE `center_allocations`
  ADD CONSTRAINT `center_allocations_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`),
  ADD CONSTRAINT `center_allocations_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`);

--
-- Constraints for table `fine_settles`
--
ALTER TABLE `fine_settles`
  ADD CONSTRAINT `fine_settles_lending_detail_id_foreign` FOREIGN KEY (`lending_detail_id`) REFERENCES `lending_details` (`id`);

--
-- Constraints for table `lending_configs`
--
ALTER TABLE `lending_configs`
  ADD CONSTRAINT `lending_configs_categoryid_foreign` FOREIGN KEY (`categoryid`) REFERENCES `member_cats` (`id`);

--
-- Constraints for table `lending_details`
--
ALTER TABLE `lending_details`
  ADD CONSTRAINT `lending_details_issue_by_foreign` FOREIGN KEY (`issue_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `lending_details_lending_issue_id_foreign` FOREIGN KEY (`lending_issue_id`) REFERENCES `lending_issues` (`id`),
  ADD CONSTRAINT `lending_details_lending_return_id_foreign` FOREIGN KEY (`lending_return_id`) REFERENCES `lending_returns` (`id`),
  ADD CONSTRAINT `lending_details_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `lending_details_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`),
  ADD CONSTRAINT `lending_details_return_by_foreign` FOREIGN KEY (`return_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `lending_issues`
--
ALTER TABLE `lending_issues`
  ADD CONSTRAINT `lending_issues_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `lending_returns`
--
ALTER TABLE `lending_returns`
  ADD CONSTRAINT `lending_returns_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_categoryid_foreign` FOREIGN KEY (`categoryid`) REFERENCES `member_cats` (`id`),
  ADD CONSTRAINT `members_genderid_foreign` FOREIGN KEY (`genderid`) REFERENCES `genders` (`id`),
  ADD CONSTRAINT `members_guarantor_id_foreign` FOREIGN KEY (`guarantor_id`) REFERENCES `member_guarantors` (`id`),
  ADD CONSTRAINT `members_titleid_foreign` FOREIGN KEY (`titleid`) REFERENCES `titles` (`id`);

--
-- Constraints for table `member_guarantors`
--
ALTER TABLE `member_guarantors`
  ADD CONSTRAINT `member_guarantors_genderid_foreign` FOREIGN KEY (`genderid`) REFERENCES `genders` (`id`),
  ADD CONSTRAINT `member_guarantors_titleid_foreign` FOREIGN KEY (`titleid`) REFERENCES `titles` (`id`);

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
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `receipts_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `receipts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `receipt_details`
--
ALTER TABLE `receipt_details`
  ADD CONSTRAINT `receipt_details_receipt_id_foreign` FOREIGN KEY (`receipt_id`) REFERENCES `receipts` (`id`);

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `resource_categories` (`id`),
  ADD CONSTRAINT `resources_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`),
  ADD CONSTRAINT `resources_cretor2_id_foreign` FOREIGN KEY (`cretor2_id`) REFERENCES `resource_creators` (`id`),
  ADD CONSTRAINT `resources_cretor3_id_foreign` FOREIGN KEY (`cretor3_id`) REFERENCES `resource_creators` (`id`),
  ADD CONSTRAINT `resources_cretor_id_foreign` FOREIGN KEY (`cretor_id`) REFERENCES `resource_creators` (`id`),
  ADD CONSTRAINT `resources_dd_class_id_foreign` FOREIGN KEY (`dd_class_id`) REFERENCES `resource_dd_classes` (`id`),
  ADD CONSTRAINT `resources_dd_devision_id_foreign` FOREIGN KEY (`dd_devision_id`) REFERENCES `resource_dd_divisions` (`id`),
  ADD CONSTRAINT `resources_dd_section_id_foreign` FOREIGN KEY (`dd_section_id`) REFERENCES `resource_dd_sections` (`id`),
  ADD CONSTRAINT `resources_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `resource_languages` (`id`),
  ADD CONSTRAINT `resources_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `resource_publishers` (`id`),
  ADD CONSTRAINT `resources_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `resource_types` (`id`);

--
-- Constraints for table `resource_creators`
--
ALTER TABLE `resource_creators`
  ADD CONSTRAINT `resource_creators_genderid_foreign` FOREIGN KEY (`genderid`) REFERENCES `genders` (`id`),
  ADD CONSTRAINT `resource_creators_titleid_foreign` FOREIGN KEY (`titleid`) REFERENCES `titles` (`id`);

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
  ADD CONSTRAINT `resource_donates_genderid_foreign` FOREIGN KEY (`genderid`) REFERENCES `genders` (`id`),
  ADD CONSTRAINT `resource_donates_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`),
  ADD CONSTRAINT `resource_donates_titleid_foreign` FOREIGN KEY (`titleid`) REFERENCES `titles` (`id`);

--
-- Constraints for table `resource_floors`
--
ALTER TABLE `resource_floors`
  ADD CONSTRAINT `resource_floors_rack_id_foreign` FOREIGN KEY (`rack_id`) REFERENCES `resource_racks` (`id`);

--
-- Constraints for table `resource_placements`
--
ALTER TABLE `resource_placements`
  ADD CONSTRAINT `resource_placements_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `resource_floors` (`id`),
  ADD CONSTRAINT `resource_placements_rack_id_foreign` FOREIGN KEY (`rack_id`) REFERENCES `resource_racks` (`id`),
  ADD CONSTRAINT `resource_placements_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`);

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
  ADD CONSTRAINT `staff_designetion_id_foreign` FOREIGN KEY (`designetion_id`) REFERENCES `designetions` (`id`),
  ADD CONSTRAINT `staff_genderid_foreign` FOREIGN KEY (`genderid`) REFERENCES `genders` (`id`),
  ADD CONSTRAINT `staff_titleid_foreign` FOREIGN KEY (`titleid`) REFERENCES `titles` (`id`);

--
-- Constraints for table `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `surveys_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `surveys_finalize_by_foreign` FOREIGN KEY (`finalize_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `survey_boards`
--
ALTER TABLE `survey_boards`
  ADD CONSTRAINT `survey_boards_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`),
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
-- Constraints for table `themes`
--
ALTER TABLE `themes`
  ADD CONSTRAINT `themes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

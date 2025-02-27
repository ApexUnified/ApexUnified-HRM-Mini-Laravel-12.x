-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2025 at 10:09 AM
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
-- Database: `apex_unified_hrm_mini`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_salaries`
--

CREATE TABLE `advance_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `advance_salary_reason` longtext NOT NULL,
  `advance_salary_date` date NOT NULL,
  `advance_salary_amount` decimal(20,2) NOT NULL,
  `advance_salary_status` enum('Pending','Approved','Rejected','Disbused','Settled') NOT NULL DEFAULT 'Pending',
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE `allowances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `allowance_type` varchar(255) NOT NULL,
  `frequency` enum('Daily','Monthly','Quarterly','Annually') NOT NULL DEFAULT 'Monthly',
  `eligibility` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`eligibility`)),
  `description` longtext DEFAULT NULL,
  `allowance_amount` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allowances`
--

INSERT INTO `allowances` (`id`, `allowance_type`, `frequency`, `eligibility`, `description`, `allowance_amount`, `created_at`, `updated_at`) VALUES
(1, 'Attendance Allowance', 'Monthly', NULL, NULL, 2222.00, '2025-02-27 08:42:16', '2025-02-27 08:45:07');

-- --------------------------------------------------------

--
-- Table structure for table `allowance_types`
--

CREATE TABLE `allowance_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `allowance_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allowance_types`
--

INSERT INTO `allowance_types` (`id`, `allowance_type`, `created_at`, `updated_at`) VALUES
(1, 'Attendance Allowance', '2025-02-27 08:04:08', '2025-02-27 08:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `attendance_date` varchar(255) NOT NULL,
  `attendance_checkin` varchar(255) NOT NULL,
  `attendance_checkout` varchar(255) DEFAULT NULL,
  `hours_worked` varchar(255) NOT NULL,
  `attendance_status` varchar(255) NOT NULL,
  `leave_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `attendance_date`, `attendance_checkin`, `attendance_checkout`, `hours_worked`, `attendance_status`, `leave_type`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-02-27', '10:00', '16:00', '360', 'Late', NULL, '2025-02-27 08:15:23', '2025-02-27 08:15:23'),
(2, 1, '2025-02-25', 'Employee Is Not Present', 'Employee Is Not Present', '0', 'Employee Is Not Present', 'Absent', '2025-02-27 08:15:55', '2025-02-27 08:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `bonuses`
--

CREATE TABLE `bonuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bonus_type` varchar(255) NOT NULL,
  `frequency` enum('Daily','Monthly','Quarterly','Annually') NOT NULL DEFAULT 'Monthly',
  `description` longtext DEFAULT NULL,
  `bonus_amount` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` decimal(20,3) NOT NULL,
  `longtitude` decimal(20,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `address`, `latitude`, `longtitude`, `created_at`, `updated_at`) VALUES
(1, 'Default Branch', '854 Ullrich Points Apt. 505\nPort Trisha, DE 80533-4867', 53.911, -14.561, '2025-02-27 08:04:08', '2025-02-27 08:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:3:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";}s:11:\"permissions\";a:27:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"Dashboard View\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:15:\"Attendance View\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:17:\"Attendance Create\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:15:\"Attendance Edit\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:17:\"Attendance Delete\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"Department View\";s:1:\"c\";s:3:\"web\";}i:6;a:3:{s:1:\"a\";i:7;s:1:\"b\";s:17:\"Department Create\";s:1:\"c\";s:3:\"web\";}i:7;a:3:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"Department Edit\";s:1:\"c\";s:3:\"web\";}i:8;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:17:\"Department Delete\";s:1:\"c\";s:3:\"web\";}i:9;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"Employee View\";s:1:\"c\";s:3:\"web\";}i:10;a:3:{s:1:\"a\";i:11;s:1:\"b\";s:15:\"Employee Create\";s:1:\"c\";s:3:\"web\";}i:11;a:3:{s:1:\"a\";i:12;s:1:\"b\";s:13:\"Employee Edit\";s:1:\"c\";s:3:\"web\";}i:12;a:3:{s:1:\"a\";i:13;s:1:\"b\";s:15:\"Employee Delete\";s:1:\"c\";s:3:\"web\";}i:13;a:3:{s:1:\"a\";i:14;s:1:\"b\";s:13:\"Schedule View\";s:1:\"c\";s:3:\"web\";}i:14;a:3:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"Schedule Create\";s:1:\"c\";s:3:\"web\";}i:15;a:3:{s:1:\"a\";i:16;s:1:\"b\";s:13:\"Schedule Edit\";s:1:\"c\";s:3:\"web\";}i:16;a:3:{s:1:\"a\";i:17;s:1:\"b\";s:15:\"Schedule Delete\";s:1:\"c\";s:3:\"web\";}i:17;a:3:{s:1:\"a\";i:18;s:1:\"b\";s:11:\"Device View\";s:1:\"c\";s:3:\"web\";}i:18;a:3:{s:1:\"a\";i:19;s:1:\"b\";s:13:\"Device Create\";s:1:\"c\";s:3:\"web\";}i:19;a:3:{s:1:\"a\";i:20;s:1:\"b\";s:11:\"Device Edit\";s:1:\"c\";s:3:\"web\";}i:20;a:3:{s:1:\"a\";i:21;s:1:\"b\";s:13:\"Device Delete\";s:1:\"c\";s:3:\"web\";}i:21;a:3:{s:1:\"a\";i:22;s:1:\"b\";s:12:\"Reports View\";s:1:\"c\";s:3:\"web\";}i:22;a:3:{s:1:\"a\";i:23;s:1:\"b\";s:13:\"Settings View\";s:1:\"c\";s:3:\"web\";}i:23;a:3:{s:1:\"a\";i:24;s:1:\"b\";s:9:\"User View\";s:1:\"c\";s:3:\"web\";}i:24;a:3:{s:1:\"a\";i:25;s:1:\"b\";s:11:\"User Create\";s:1:\"c\";s:3:\"web\";}i:25;a:3:{s:1:\"a\";i:26;s:1:\"b\";s:9:\"User Edit\";s:1:\"c\";s:3:\"web\";}i:26;a:3:{s:1:\"a\";i:27;s:1:\"b\";s:11:\"User Delete\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:0:{}}', 1740733691);

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
-- Table structure for table `cash_advances`
--

CREATE TABLE `cash_advances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `advance_date` date NOT NULL,
  `advance_type` varchar(255) NOT NULL,
  `advance_amount` decimal(20,2) NOT NULL,
  `advance_status` enum('Pending','Approved','Rejected','Disbused','Settled') NOT NULL DEFAULT 'Pending',
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_name` varchar(255) NOT NULL,
  `currency_symbol` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_name`, `currency_symbol`, `created_at`, `updated_at`) VALUES
(1, 'PKR', 'Rs', '2025-02-27 08:04:07', '2025-02-27 08:04:07');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deduction_type` varchar(255) NOT NULL,
  `deduction_amount` decimal(20,2) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Default Department', 1, '2025-02-27 08:04:08', '2025-02-27 08:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `employee_dob` varchar(255) NOT NULL,
  `date_of_hiring` varchar(255) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `employee_schedule` varchar(255) NOT NULL,
  `device_id` longtext NOT NULL,
  `device_user_id` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `employee_name`, `father_name`, `employee_dob`, `date_of_hiring`, `department_id`, `employee_schedule`, `device_id`, `device_user_id`, `designation`, `created_at`, `updated_at`) VALUES
(1, 1388045561, 'Abdullah', 'Akhter Hussain', '2025-02-27', '2025-02-18', 1, '1', '[\"1\"]', 2, 'Developer', '2025-02-27 08:12:47', '2025-02-27 08:13:14');

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
-- Table structure for table `jobnatures`
--

CREATE TABLE `jobnatures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_nature_type` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `job_nature_types`
--

CREATE TABLE `job_nature_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jobnature_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_nature_types`
--

INSERT INTO `job_nature_types` (`id`, `jobnature_type`, `created_at`, `updated_at`) VALUES
(1, 'Permanent', '2025-02-27 08:04:08', '2025-02-27 08:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `loan_date` date NOT NULL,
  `loan_type` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `loan_amount` decimal(20,2) NOT NULL,
  `loan_deduction_amount` decimal(20,2) NOT NULL,
  `remeaning_loan` decimal(20,2) DEFAULT NULL,
  `repayment_date` date NOT NULL,
  `status` enum('Active','Completed') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_logs`
--

CREATE TABLE `mail_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_sent` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_settings`
--

CREATE TABLE `mail_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_mailer` varchar(255) NOT NULL,
  `mail_host` varchar(255) NOT NULL,
  `mail_port` varchar(255) NOT NULL,
  `mail_username` varchar(255) NOT NULL,
  `mail_password` varchar(255) NOT NULL,
  `mail_encryption` varchar(255) NOT NULL,
  `mail_from` varchar(255) NOT NULL,
  `mail_from_name` varchar(255) NOT NULL,
  `mail_to` varchar(255) NOT NULL,
  `mail_sent_time` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_settings`
--

INSERT INTO `mail_settings` (`id`, `mail_mailer`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `mail_from`, `mail_from_name`, `mail_to`, `mail_sent_time`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'smtp.gmail.com', '587', 'abdullahsheikhmuhammad21@gmail.com', 'mrrzavnqumkgdixq', 'tls', 'abdullahsheikhmuhammad21@gmail.com', 'Apex Unified HRM Mini', 'abdullahsheikhmuhammad21@gmail.com', '00:00', '2025-02-27 09:04:17', '2025-02-27 09:04:17');

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
(193, '0001_01_01_000000_create_users_table', 1),
(194, '0001_01_01_000001_create_cache_table', 1),
(195, '0001_01_01_000002_create_jobs_table', 1),
(196, '2024_10_31_093632_create_departments_table', 1),
(197, '2024_10_31_093910_create_employees_table', 1),
(198, '2024_10_31_094252_create_attendances_table', 1),
(199, '2024_10_31_110100_create_permission_tables', 1),
(200, '2024_11_01_032030_create_schedules_table', 1),
(201, '2024_11_04_113503_create_settings_table', 1),
(202, '2024_12_08_121120_create_zkteco_devices_table', 1),
(203, '2024_12_08_135729_update_employees_table', 1),
(204, '2024_12_09_042339_create_mail_settings_table', 1),
(205, '2024_12_09_151450_create_mail_logs_table', 1),
(206, '2025_02_11_103320_create_branches_table', 1),
(207, '2025_02_18_135451_create_jobnatures_table', 1),
(208, '2025_02_19_093230_create_positions_table', 1),
(209, '2025_02_19_115201_create_allowances_table', 1),
(210, '2025_02_21_091811_create_currencies_table', 1),
(211, '2025_02_21_094558_create_bonuses_table', 1),
(212, '2025_02_21_113300_create_loans_table', 1),
(213, '2025_02_21_145449_create_deductions_table', 1),
(214, '2025_02_21_153210_create_tax_deductions_table', 1),
(215, '2025_02_23_115722_create_cash_advances_table', 1),
(216, '2025_02_23_150410_create_advance_salaries_table', 1),
(217, '2025_02_25_093346_update_departments_table', 1),
(218, '2025_02_26_180724_create_job_nature_types_table', 1),
(219, '2025_02_26_183826_create_position_levels_table', 1),
(220, '2025_02_26_202732_create_allowance_types_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard View', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(2, 'Attendance View', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(3, 'Attendance Create', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(4, 'Attendance Edit', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(5, 'Attendance Delete', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(6, 'Department View', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(7, 'Department Create', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(8, 'Department Edit', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(9, 'Department Delete', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(10, 'Employee View', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(11, 'Employee Create', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(12, 'Employee Edit', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(13, 'Employee Delete', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(14, 'Schedule View', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(15, 'Schedule Create', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(16, 'Schedule Edit', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(17, 'Schedule Delete', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(18, 'Device View', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(19, 'Device Create', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(20, 'Device Edit', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(21, 'Device Delete', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(22, 'Reports View', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(23, 'Settings View', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(24, 'User View', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(25, 'User Create', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(26, 'User Edit', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17'),
(27, 'User Delete', 'web', '2025-02-27 09:04:17', '2025-02-27 09:04:17');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `jobnature_id` bigint(20) UNSIGNED NOT NULL,
  `position_level` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position_levels`
--

CREATE TABLE `position_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_level` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `position_levels`
--

INSERT INTO `position_levels` (`id`, `position_level`, `created_at`, `updated_at`) VALUES
(1, 'Senior', '2025-02-27 08:04:08', '2025-02-27 08:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-02-27 09:04:16', '2025-02-27 09:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `checkin` varchar(255) NOT NULL,
  `checkout` varchar(255) NOT NULL,
  `days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`days`)),
  `num_of_min_before_checkin` int(11) NOT NULL,
  `shift_start_time` int(11) NOT NULL,
  `shift_end_time` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `name`, `checkin`, `checkout`, `days`, `num_of_min_before_checkin`, `shift_start_time`, `shift_end_time`, `created_at`, `updated_at`) VALUES
(1, 'Test Schedule', '09:00', '17:00', '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\",\"Saturday\",\"Sunday\"]', 30, 60, 60, '2025-02-27 08:09:06', '2025-02-27 08:09:06');

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
('yrLsjDfltP8VhG5R6M9fhcBx33pLxijAkF8g3beQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRnlkTkluMVVRQVFacGJpcVZGanFXRmt3Sk5CWXBycE15TmJUdm5SSSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1740647291);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_title` varchar(255) DEFAULT NULL,
  `system_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `auth_logo` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `time_zone` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `developed_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_title`, `system_logo`, `favicon`, `auth_logo`, `company_name`, `time_zone`, `currency`, `developed_by`, `created_at`, `updated_at`) VALUES
(1, 'ApexUnified HRM Mini', 'SystemLogo.png', 'Favicon.png', 'Auth_logo.png', 'ApexUnified', NULL, 'Rs', 'Sheikh Abdullah', '2025-02-27 08:04:07', '2025-02-27 08:04:07');

-- --------------------------------------------------------

--
-- Table structure for table `tax_deductions`
--

CREATE TABLE `tax_deductions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_type` varchar(255) NOT NULL,
  `tax_percentage` decimal(20,2) NOT NULL,
  `tax_amount` decimal(8,2) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abdullah', 'admin@gmail.com', NULL, NULL, '$2y$12$U7E.oGu67I12wcPhN8uss.Fb32DKvZh/lqsNiclLRGkSHQsYmF/6W', '2S3cjXRQESldk9m35lw5MCD1GvBaZVNUx7WW1QNy5IeWfSUSuLzM4AEqKG5p', '2025-02-27 09:04:16', '2025-02-27 09:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `zkteco_devices`
--

CREATE TABLE `zkteco_devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zkteco_devices`
--

INSERT INTO `zkteco_devices` (`id`, `name`, `ip_address`, `port`, `created_at`, `updated_at`) VALUES
(1, 'Tets', '192.100.102.12', '43333', '2025-02-27 08:11:38', '2025-02-27 08:11:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advance_salaries`
--
ALTER TABLE `advance_salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advance_salaries_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `allowances`
--
ALTER TABLE `allowances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allowance_types`
--
ALTER TABLE `allowance_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `bonuses`
--
ALTER TABLE `bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `cash_advances`
--
ALTER TABLE `cash_advances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_advances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_department_id_foreign` (`department_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobnatures`
--
ALTER TABLE `jobnatures`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `job_nature_types`
--
ALTER TABLE `job_nature_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `mail_logs`
--
ALTER TABLE `mail_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail_logs_mail_sent_unique` (`mail_sent`);

--
-- Indexes for table `mail_settings`
--
ALTER TABLE `mail_settings`
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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `positions_jobnature_id_foreign` (`jobnature_id`);

--
-- Indexes for table `position_levels`
--
ALTER TABLE `position_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_deductions`
--
ALTER TABLE `tax_deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `zkteco_devices`
--
ALTER TABLE `zkteco_devices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance_salaries`
--
ALTER TABLE `advance_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `allowances`
--
ALTER TABLE `allowances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `allowance_types`
--
ALTER TABLE `allowance_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bonuses`
--
ALTER TABLE `bonuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cash_advances`
--
ALTER TABLE `cash_advances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobnatures`
--
ALTER TABLE `jobnatures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_nature_types`
--
ALTER TABLE `job_nature_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail_logs`
--
ALTER TABLE `mail_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail_settings`
--
ALTER TABLE `mail_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `position_levels`
--
ALTER TABLE `position_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tax_deductions`
--
ALTER TABLE `tax_deductions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zkteco_devices`
--
ALTER TABLE `zkteco_devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advance_salaries`
--
ALTER TABLE `advance_salaries`
  ADD CONSTRAINT `advance_salaries_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cash_advances`
--
ALTER TABLE `cash_advances`
  ADD CONSTRAINT `cash_advances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_jobnature_id_foreign` FOREIGN KEY (`jobnature_id`) REFERENCES `jobnatures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 20, 2025 at 03:34 PM
-- Server version: 8.0.41-0ubuntu0.24.04.1
-- PHP Version: 8.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apexunified_hrm_mini`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_salaries`
--

CREATE TABLE `advance_salaries` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `advance_salary_reason` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `advance_salary_date` date NOT NULL,
  `advance_salary_amount` decimal(20,2) NOT NULL,
  `advance_salary_status` enum('Pending','Approved','Rejected','Disbused','Settled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE `allowances` (
  `id` bigint UNSIGNED NOT NULL,
  `allowance_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frequency` enum('Daily','Monthly','Quarterly','Annually') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Monthly',
  `eligibility` json DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `allowance_amount` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `allowance_types`
--

CREATE TABLE `allowance_types` (
  `id` bigint UNSIGNED NOT NULL,
  `allowance_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allowance_types`
--

INSERT INTO `allowance_types` (`id`, `allowance_type`, `created_at`, `updated_at`) VALUES
(1, 'Attendance Allowance', '2025-03-20 09:50:00', '2025-03-20 09:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `attendance_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attendance_checkin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attendance_checkout` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hours_worked` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attendance_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_pay_deductions`
--

CREATE TABLE `attendance_pay_deductions` (
  `id` bigint UNSIGNED NOT NULL,
  `late_count` int NOT NULL,
  `days` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_pay_deductions`
--

INSERT INTO `attendance_pay_deductions` (`id`, `late_count`, `days`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2025-03-20 10:51:20', '2025-03-20 10:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `bonuses`
--

CREATE TABLE `bonuses` (
  `id` bigint UNSIGNED NOT NULL,
  `bonus_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frequency` enum('Daily','Monthly','Quarterly','Annually') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Monthly',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `bonus_amount` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(20,10) NOT NULL,
  `longtitude` decimal(20,10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `address`, `latitude`, `longtitude`, `created_at`, `updated_at`) VALUES
(1, 'Default Branch', 'Default Addresss', 24.8991789000, 67.1874781000, '2025-03-20 09:50:00', '2025-03-20 09:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:3:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";}s:11:\"permissions\";a:77:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"Dashboard View\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:15:\"Attendance View\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:17:\"Attendance Create\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:15:\"Attendance Edit\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:17:\"Attendance Delete\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"Department View\";s:1:\"c\";s:3:\"web\";}i:6;a:3:{s:1:\"a\";i:7;s:1:\"b\";s:17:\"Department Create\";s:1:\"c\";s:3:\"web\";}i:7;a:3:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"Department Edit\";s:1:\"c\";s:3:\"web\";}i:8;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:17:\"Department Delete\";s:1:\"c\";s:3:\"web\";}i:9;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"Employee View\";s:1:\"c\";s:3:\"web\";}i:10;a:3:{s:1:\"a\";i:11;s:1:\"b\";s:15:\"Employee Create\";s:1:\"c\";s:3:\"web\";}i:11;a:3:{s:1:\"a\";i:12;s:1:\"b\";s:13:\"Employee Show\";s:1:\"c\";s:3:\"web\";}i:12;a:3:{s:1:\"a\";i:13;s:1:\"b\";s:13:\"Employee Edit\";s:1:\"c\";s:3:\"web\";}i:13;a:3:{s:1:\"a\";i:14;s:1:\"b\";s:15:\"Employee Delete\";s:1:\"c\";s:3:\"web\";}i:14;a:3:{s:1:\"a\";i:15;s:1:\"b\";s:13:\"Schedule View\";s:1:\"c\";s:3:\"web\";}i:15;a:3:{s:1:\"a\";i:16;s:1:\"b\";s:15:\"Schedule Create\";s:1:\"c\";s:3:\"web\";}i:16;a:3:{s:1:\"a\";i:17;s:1:\"b\";s:13:\"Schedule Edit\";s:1:\"c\";s:3:\"web\";}i:17;a:3:{s:1:\"a\";i:18;s:1:\"b\";s:15:\"Schedule Delete\";s:1:\"c\";s:3:\"web\";}i:18;a:3:{s:1:\"a\";i:19;s:1:\"b\";s:11:\"Device View\";s:1:\"c\";s:3:\"web\";}i:19;a:3:{s:1:\"a\";i:20;s:1:\"b\";s:13:\"Device Create\";s:1:\"c\";s:3:\"web\";}i:20;a:3:{s:1:\"a\";i:21;s:1:\"b\";s:11:\"Device Edit\";s:1:\"c\";s:3:\"web\";}i:21;a:3:{s:1:\"a\";i:22;s:1:\"b\";s:13:\"Device Delete\";s:1:\"c\";s:3:\"web\";}i:22;a:3:{s:1:\"a\";i:23;s:1:\"b\";s:12:\"Reports View\";s:1:\"c\";s:3:\"web\";}i:23;a:3:{s:1:\"a\";i:24;s:1:\"b\";s:13:\"Settings View\";s:1:\"c\";s:3:\"web\";}i:24;a:3:{s:1:\"a\";i:25;s:1:\"b\";s:9:\"User View\";s:1:\"c\";s:3:\"web\";}i:25;a:3:{s:1:\"a\";i:26;s:1:\"b\";s:11:\"User Create\";s:1:\"c\";s:3:\"web\";}i:26;a:3:{s:1:\"a\";i:27;s:1:\"b\";s:9:\"User Edit\";s:1:\"c\";s:3:\"web\";}i:27;a:3:{s:1:\"a\";i:28;s:1:\"b\";s:11:\"User Delete\";s:1:\"c\";s:3:\"web\";}i:28;a:3:{s:1:\"a\";i:29;s:1:\"b\";s:15:\"Job Nature View\";s:1:\"c\";s:3:\"web\";}i:29;a:3:{s:1:\"a\";i:30;s:1:\"b\";s:17:\"Job Nature Create\";s:1:\"c\";s:3:\"web\";}i:30;a:3:{s:1:\"a\";i:31;s:1:\"b\";s:15:\"Job Nature Edit\";s:1:\"c\";s:3:\"web\";}i:31;a:3:{s:1:\"a\";i:32;s:1:\"b\";s:17:\"Job Nature Delete\";s:1:\"c\";s:3:\"web\";}i:32;a:3:{s:1:\"a\";i:33;s:1:\"b\";s:13:\"Position View\";s:1:\"c\";s:3:\"web\";}i:33;a:3:{s:1:\"a\";i:34;s:1:\"b\";s:15:\"Position Create\";s:1:\"c\";s:3:\"web\";}i:34;a:3:{s:1:\"a\";i:35;s:1:\"b\";s:13:\"Position Edit\";s:1:\"c\";s:3:\"web\";}i:35;a:3:{s:1:\"a\";i:36;s:1:\"b\";s:15:\"Position Delete\";s:1:\"c\";s:3:\"web\";}i:36;a:3:{s:1:\"a\";i:37;s:1:\"b\";s:14:\"Allowance View\";s:1:\"c\";s:3:\"web\";}i:37;a:3:{s:1:\"a\";i:38;s:1:\"b\";s:16:\"Allowance Create\";s:1:\"c\";s:3:\"web\";}i:38;a:3:{s:1:\"a\";i:39;s:1:\"b\";s:14:\"Allowance Edit\";s:1:\"c\";s:3:\"web\";}i:39;a:3:{s:1:\"a\";i:40;s:1:\"b\";s:16:\"Allowance Delete\";s:1:\"c\";s:3:\"web\";}i:40;a:3:{s:1:\"a\";i:41;s:1:\"b\";s:10:\"Bonus View\";s:1:\"c\";s:3:\"web\";}i:41;a:3:{s:1:\"a\";i:42;s:1:\"b\";s:12:\"Bonus Create\";s:1:\"c\";s:3:\"web\";}i:42;a:3:{s:1:\"a\";i:43;s:1:\"b\";s:10:\"Bonus Edit\";s:1:\"c\";s:3:\"web\";}i:43;a:3:{s:1:\"a\";i:44;s:1:\"b\";s:12:\"Bonus Delete\";s:1:\"c\";s:3:\"web\";}i:44;a:3:{s:1:\"a\";i:45;s:1:\"b\";s:9:\"Loan View\";s:1:\"c\";s:3:\"web\";}i:45;a:3:{s:1:\"a\";i:46;s:1:\"b\";s:11:\"Loan Create\";s:1:\"c\";s:3:\"web\";}i:46;a:3:{s:1:\"a\";i:47;s:1:\"b\";s:9:\"Loan Edit\";s:1:\"c\";s:3:\"web\";}i:47;a:3:{s:1:\"a\";i:48;s:1:\"b\";s:11:\"Loan Delete\";s:1:\"c\";s:3:\"web\";}i:48;a:3:{s:1:\"a\";i:49;s:1:\"b\";s:14:\"Deduction View\";s:1:\"c\";s:3:\"web\";}i:49;a:3:{s:1:\"a\";i:50;s:1:\"b\";s:16:\"Deduction Create\";s:1:\"c\";s:3:\"web\";}i:50;a:3:{s:1:\"a\";i:51;s:1:\"b\";s:14:\"Deduction Edit\";s:1:\"c\";s:3:\"web\";}i:51;a:3:{s:1:\"a\";i:52;s:1:\"b\";s:16:\"Deduction Delete\";s:1:\"c\";s:3:\"web\";}i:52;a:3:{s:1:\"a\";i:53;s:1:\"b\";s:18:\"Tax Deduction View\";s:1:\"c\";s:3:\"web\";}i:53;a:3:{s:1:\"a\";i:54;s:1:\"b\";s:20:\"Tax Deduction Create\";s:1:\"c\";s:3:\"web\";}i:54;a:3:{s:1:\"a\";i:55;s:1:\"b\";s:18:\"Tax Deduction Edit\";s:1:\"c\";s:3:\"web\";}i:55;a:3:{s:1:\"a\";i:56;s:1:\"b\";s:20:\"Tax Deduction Delete\";s:1:\"c\";s:3:\"web\";}i:56;a:3:{s:1:\"a\";i:57;s:1:\"b\";s:17:\"Cash Advance View\";s:1:\"c\";s:3:\"web\";}i:57;a:3:{s:1:\"a\";i:58;s:1:\"b\";s:19:\"Cash Advance Create\";s:1:\"c\";s:3:\"web\";}i:58;a:3:{s:1:\"a\";i:59;s:1:\"b\";s:17:\"Cash Advance Edit\";s:1:\"c\";s:3:\"web\";}i:59;a:3:{s:1:\"a\";i:60;s:1:\"b\";s:19:\"Cash Advance Delete\";s:1:\"c\";s:3:\"web\";}i:60;a:3:{s:1:\"a\";i:61;s:1:\"b\";s:19:\"Advance Salary View\";s:1:\"c\";s:3:\"web\";}i:61;a:3:{s:1:\"a\";i:62;s:1:\"b\";s:21:\"Advance Salary Create\";s:1:\"c\";s:3:\"web\";}i:62;a:3:{s:1:\"a\";i:63;s:1:\"b\";s:19:\"Advance Salary Edit\";s:1:\"c\";s:3:\"web\";}i:63;a:3:{s:1:\"a\";i:64;s:1:\"b\";s:21:\"Advance Salary Delete\";s:1:\"c\";s:3:\"web\";}i:64;a:3:{s:1:\"a\";i:65;s:1:\"b\";s:12:\"Holiday View\";s:1:\"c\";s:3:\"web\";}i:65;a:3:{s:1:\"a\";i:66;s:1:\"b\";s:14:\"Holiday Create\";s:1:\"c\";s:3:\"web\";}i:66;a:3:{s:1:\"a\";i:67;s:1:\"b\";s:12:\"Holiday Edit\";s:1:\"c\";s:3:\"web\";}i:67;a:3:{s:1:\"a\";i:68;s:1:\"b\";s:14:\"Holiday Delete\";s:1:\"c\";s:3:\"web\";}i:68;a:3:{s:1:\"a\";i:69;s:1:\"b\";s:13:\"Overtime View\";s:1:\"c\";s:3:\"web\";}i:69;a:3:{s:1:\"a\";i:70;s:1:\"b\";s:15:\"Overtime Create\";s:1:\"c\";s:3:\"web\";}i:70;a:3:{s:1:\"a\";i:71;s:1:\"b\";s:13:\"Overtime Edit\";s:1:\"c\";s:3:\"web\";}i:71;a:3:{s:1:\"a\";i:72;s:1:\"b\";s:15:\"Overtime Delete\";s:1:\"c\";s:3:\"web\";}i:72;a:3:{s:1:\"a\";i:73;s:1:\"b\";s:12:\"Payroll View\";s:1:\"c\";s:3:\"web\";}i:73;a:3:{s:1:\"a\";i:74;s:1:\"b\";s:14:\"Payroll Create\";s:1:\"c\";s:3:\"web\";}i:74;a:3:{s:1:\"a\";i:75;s:1:\"b\";s:12:\"Payroll Edit\";s:1:\"c\";s:3:\"web\";}i:75;a:3:{s:1:\"a\";i:76;s:1:\"b\";s:14:\"Payroll Delete\";s:1:\"c\";s:3:\"web\";}i:76;a:3:{s:1:\"a\";i:77;s:1:\"b\";s:24:\"Payroll Invoice Generate\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:0:{}}', 1742571045);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_advances`
--

CREATE TABLE `cash_advances` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `advance_date` date NOT NULL,
  `advance_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advance_amount` decimal(20,2) NOT NULL,
  `advance_status` enum('Pending','Approved','Rejected','Disbused','Settled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `currency_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_name`, `currency_symbol`, `created_at`, `updated_at`) VALUES
(1, 'PKR', 'Rs', '2025-03-20 09:50:00', '2025-03-20 09:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` bigint UNSIGNED NOT NULL,
  `deduction_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deduction_amount` decimal(20,2) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Default Department', 1, '2025-03-20 09:50:00', '2025-03-20 09:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_hiring` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `employee_schedule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_user_id` int NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female','Other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position_id` bigint UNSIGNED DEFAULT NULL,
  `joining_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` enum('Single','Married','Divorced','Widowed','Separated') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_address` longtext COLLATE utf8mb4_unicode_ci,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eobi_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sessi_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` decimal(8,2) DEFAULT NULL,
  `blood_group` enum('A+','A-','B+','B-','O+','O-','AB+','AB-') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact_details` longtext COLLATE utf8mb4_unicode_ci,
  `emergency_contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family_member_details` json DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_letter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic` json DEFAULT NULL,
  `others` json DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `employee_name`, `parent_name`, `employee_dob`, `date_of_hiring`, `department_id`, `employee_schedule`, `device_id`, `device_user_id`, `designation`, `gender`, `position_id`, `joining_date`, `religion`, `marital_status`, `home_address`, `contact_number`, `email`, `cnic_number`, `eobi_number`, `sessi_number`, `salary`, `blood_group`, `qualification`, `emergency_contact_details`, `emergency_contact_number`, `family_member_details`, `remarks`, `resume`, `joining_letter`, `cnic`, `others`, `profile`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'EMP-6128490', 'Abdullaj', 'aaaaaaa', '2025-03-13', '2025-03-20', 1, '1', '[\"1\"]', 1, 'aaaaaaa', 'Male', 1, '2025-03-20', '111', 'Single', 'ddssadsadsa', '5555555555', 'abdullahsheikhmuhammad21@gmail.com', '42207-1234567-1', '1234567890', '1234567890', 800000.00, 'A+', 'KKAKKAKA', 'dsadsadsadad', '1234578', '{\"age\": null, \"email\": null, \"address\": null, \"relation\": null, \"full_name\": null, \"contact_number\": null}', NULL, NULL, NULL, NULL, NULL, NULL, 'Abdullah', '2025-03-20 10:45:58', '2025-03-20 10:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint UNSIGNED NOT NULL,
  `holiday_date` date NOT NULL,
  `holiday_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobnatures`
--

CREATE TABLE `jobnatures` (
  `id` bigint UNSIGNED NOT NULL,
  `job_nature_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobnatures`
--

INSERT INTO `jobnatures` (`id`, `job_nature_type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Permanent', NULL, '2025-03-20 10:34:15', '2025-03-20 10:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_nature_types`
--

CREATE TABLE `job_nature_types` (
  `id` bigint UNSIGNED NOT NULL,
  `jobnature_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_nature_types`
--

INSERT INTO `job_nature_types` (`id`, `jobnature_type`, `created_at`, `updated_at`) VALUES
(1, 'Permanent', '2025-03-20 09:50:00', '2025-03-20 09:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `loan_date` date NOT NULL,
  `loan_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `loan_amount` decimal(20,2) NOT NULL,
  `loan_deduction_amount` decimal(20,2) NOT NULL,
  `remeaning_loan` decimal(20,2) DEFAULT NULL,
  `repayment_date` date NOT NULL,
  `status` enum('Active','Completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_payments`
--

CREATE TABLE `loan_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `loan_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_amount` decimal(20,2) NOT NULL,
  `loan_deduction_amount` decimal(20,2) NOT NULL,
  `remeaning_loan` decimal(20,2) DEFAULT NULL,
  `status` enum('Active','Completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_logs`
--

CREATE TABLE `mail_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `mail_sent` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail_settings`
--

CREATE TABLE `mail_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `mail_mailer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_host` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_port` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_encryption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_from_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_sent_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_settings`
--

INSERT INTO `mail_settings` (`id`, `mail_mailer`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `mail_from`, `mail_from_name`, `mail_to`, `mail_sent_time`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'smtp.gmail.com', '587', 'abdullahsheikhmuhammad21@gmail.com', 'mrrzavnqumkgdixq', 'tls', 'abdullahsheikhmuhammad21@gmail.com', 'Apex Unified HRM Mini', 'abdullahsheikhmuhammad21@gmail.com', '06:00', '2025-03-20 09:50:00', '2025-03-20 10:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_31_093632_create_departments_table', 1),
(5, '2024_10_31_093910_create_employees_table', 1),
(6, '2024_10_31_094252_create_attendances_table', 1),
(7, '2024_10_31_110100_create_permission_tables', 1),
(8, '2024_11_01_032030_create_schedules_table', 1),
(9, '2024_11_04_113503_create_settings_table', 1),
(10, '2024_12_08_121120_create_zkteco_devices_table', 1),
(11, '2024_12_08_135729_update_employees_table', 1),
(12, '2024_12_09_042339_create_mail_settings_table', 1),
(13, '2024_12_09_151450_create_mail_logs_table', 1),
(14, '2025_02_11_103320_create_branches_table', 1),
(15, '2025_02_18_135451_create_jobnatures_table', 1),
(16, '2025_02_19_093230_create_positions_table', 1),
(17, '2025_02_19_115201_create_allowances_table', 1),
(18, '2025_02_21_091811_create_currencies_table', 1),
(19, '2025_02_21_094558_create_bonuses_table', 1),
(20, '2025_02_21_113300_create_loans_table', 1),
(21, '2025_02_21_145449_create_deductions_table', 1),
(22, '2025_02_21_153210_create_tax_deductions_table', 1),
(23, '2025_02_23_115722_create_cash_advances_table', 1),
(24, '2025_02_23_150410_create_advance_salaries_table', 1),
(25, '2025_02_25_093346_update_departments_table', 1),
(26, '2025_02_26_180724_create_job_nature_types_table', 1),
(27, '2025_02_26_183826_create_position_levels_table', 1),
(28, '2025_02_26_202732_create_allowance_types_table', 1),
(29, '2025_03_01_113115_update_employees_table', 1),
(30, '2025_03_11_142425_create_holidays_table', 1),
(31, '2025_03_13_164647_create_overtime_pays_table', 1),
(32, '2025_03_13_171301_create_attendance_pay_deductions_table', 1),
(33, '2025_03_13_175441_create_overtimes_table', 1),
(34, '2025_03_14_144008_create_loan_payments_table', 1),
(35, '2025_03_15_145838_create_payslips_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `overtimes`
--

CREATE TABLE `overtimes` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `hours_worked` decimal(20,2) NOT NULL,
  `rate_per_hour` decimal(20,2) NOT NULL,
  `total_overtime_pay` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `overtimes`
--

INSERT INTO `overtimes` (`id`, `employee_id`, `hours_worked`, `rate_per_hour`, `total_overtime_pay`, `created_at`, `updated_at`) VALUES
(1, 1, 4.00, 100.00, 400.00, '2025-03-20 10:46:19', '2025-03-20 10:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `overtime_pays`
--

CREATE TABLE `overtime_pays` (
  `id` bigint UNSIGNED NOT NULL,
  `overtime_pay` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `overtime_pays`
--

INSERT INTO `overtime_pays` (`id`, `overtime_pay`, `created_at`, `updated_at`) VALUES
(1, 100.00, '2025-03-20 10:40:10', '2025-03-20 10:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('abdullahsheikhmuhammad21@gmail.com', '$2y$12$JjrlRwWEcwZKKuKI7a5RPeR41kqHrJB4sojx.yBgv3LN9OMd92guK', '2025-03-20 15:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `payslips`
--

CREATE TABLE `payslips` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `base_salary` decimal(20,2) NOT NULL,
  `overtime` decimal(20,2) DEFAULT NULL,
  `allowance` decimal(20,2) DEFAULT NULL,
  `bonus` decimal(20,2) DEFAULT NULL,
  `deduction` decimal(20,2) DEFAULT NULL,
  `tax_deduction` decimal(20,2) DEFAULT NULL,
  `loan_deduction` decimal(20,2) DEFAULT NULL,
  `attendance_deduction` decimal(20,2) DEFAULT NULL,
  `net_salary` decimal(20,2) NOT NULL,
  `status` enum('Pending','Approved','Paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payslips`
--

INSERT INTO `payslips` (`id`, `employee_id`, `base_salary`, `overtime`, `allowance`, `bonus`, `deduction`, `tax_deduction`, `loan_deduction`, `attendance_deduction`, `net_salary`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 800000.00, 400.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 800400.00, 'Pending', '2025-03-20 10:47:27', '2025-03-20 10:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard View', 'web', '2025-03-20 09:49:49', '2025-03-20 09:49:49'),
(2, 'Attendance View', 'web', '2025-03-20 09:49:49', '2025-03-20 09:49:49'),
(3, 'Attendance Create', 'web', '2025-03-20 09:49:49', '2025-03-20 09:49:49'),
(4, 'Attendance Edit', 'web', '2025-03-20 09:49:50', '2025-03-20 09:49:50'),
(5, 'Attendance Delete', 'web', '2025-03-20 09:49:50', '2025-03-20 09:49:50'),
(6, 'Department View', 'web', '2025-03-20 09:49:50', '2025-03-20 09:49:50'),
(7, 'Department Create', 'web', '2025-03-20 09:49:50', '2025-03-20 09:49:50'),
(8, 'Department Edit', 'web', '2025-03-20 09:49:50', '2025-03-20 09:49:50'),
(9, 'Department Delete', 'web', '2025-03-20 09:49:51', '2025-03-20 09:49:51'),
(10, 'Employee View', 'web', '2025-03-20 09:49:51', '2025-03-20 09:49:51'),
(11, 'Employee Create', 'web', '2025-03-20 09:49:51', '2025-03-20 09:49:51'),
(12, 'Employee Show', 'web', '2025-03-20 09:49:51', '2025-03-20 09:49:51'),
(13, 'Employee Edit', 'web', '2025-03-20 09:49:51', '2025-03-20 09:49:51'),
(14, 'Employee Delete', 'web', '2025-03-20 09:49:51', '2025-03-20 09:49:51'),
(15, 'Schedule View', 'web', '2025-03-20 09:49:52', '2025-03-20 09:49:52'),
(16, 'Schedule Create', 'web', '2025-03-20 09:49:52', '2025-03-20 09:49:52'),
(17, 'Schedule Edit', 'web', '2025-03-20 09:49:52', '2025-03-20 09:49:52'),
(18, 'Schedule Delete', 'web', '2025-03-20 09:49:52', '2025-03-20 09:49:52'),
(19, 'Device View', 'web', '2025-03-20 09:49:52', '2025-03-20 09:49:52'),
(20, 'Device Create', 'web', '2025-03-20 09:49:52', '2025-03-20 09:49:52'),
(21, 'Device Edit', 'web', '2025-03-20 09:49:52', '2025-03-20 09:49:52'),
(22, 'Device Delete', 'web', '2025-03-20 09:49:52', '2025-03-20 09:49:52'),
(23, 'Reports View', 'web', '2025-03-20 09:49:53', '2025-03-20 09:49:53'),
(24, 'Settings View', 'web', '2025-03-20 09:49:53', '2025-03-20 09:49:53'),
(25, 'User View', 'web', '2025-03-20 09:49:53', '2025-03-20 09:49:53'),
(26, 'User Create', 'web', '2025-03-20 09:49:53', '2025-03-20 09:49:53'),
(27, 'User Edit', 'web', '2025-03-20 09:49:53', '2025-03-20 09:49:53'),
(28, 'User Delete', 'web', '2025-03-20 09:49:53', '2025-03-20 09:49:53'),
(29, 'Job Nature View', 'web', '2025-03-20 09:49:53', '2025-03-20 09:49:53'),
(30, 'Job Nature Create', 'web', '2025-03-20 09:49:53', '2025-03-20 09:49:53'),
(31, 'Job Nature Edit', 'web', '2025-03-20 09:49:54', '2025-03-20 09:49:54'),
(32, 'Job Nature Delete', 'web', '2025-03-20 09:49:54', '2025-03-20 09:49:54'),
(33, 'Position View', 'web', '2025-03-20 09:49:54', '2025-03-20 09:49:54'),
(34, 'Position Create', 'web', '2025-03-20 09:49:54', '2025-03-20 09:49:54'),
(35, 'Position Edit', 'web', '2025-03-20 09:49:54', '2025-03-20 09:49:54'),
(36, 'Position Delete', 'web', '2025-03-20 09:49:54', '2025-03-20 09:49:54'),
(37, 'Allowance View', 'web', '2025-03-20 09:49:54', '2025-03-20 09:49:54'),
(38, 'Allowance Create', 'web', '2025-03-20 09:49:54', '2025-03-20 09:49:54'),
(39, 'Allowance Edit', 'web', '2025-03-20 09:49:55', '2025-03-20 09:49:55'),
(40, 'Allowance Delete', 'web', '2025-03-20 09:49:55', '2025-03-20 09:49:55'),
(41, 'Bonus View', 'web', '2025-03-20 09:49:55', '2025-03-20 09:49:55'),
(42, 'Bonus Create', 'web', '2025-03-20 09:49:55', '2025-03-20 09:49:55'),
(43, 'Bonus Edit', 'web', '2025-03-20 09:49:55', '2025-03-20 09:49:55'),
(44, 'Bonus Delete', 'web', '2025-03-20 09:49:55', '2025-03-20 09:49:55'),
(45, 'Loan View', 'web', '2025-03-20 09:49:55', '2025-03-20 09:49:55'),
(46, 'Loan Create', 'web', '2025-03-20 09:49:55', '2025-03-20 09:49:55'),
(47, 'Loan Edit', 'web', '2025-03-20 09:49:56', '2025-03-20 09:49:56'),
(48, 'Loan Delete', 'web', '2025-03-20 09:49:56', '2025-03-20 09:49:56'),
(49, 'Deduction View', 'web', '2025-03-20 09:49:56', '2025-03-20 09:49:56'),
(50, 'Deduction Create', 'web', '2025-03-20 09:49:56', '2025-03-20 09:49:56'),
(51, 'Deduction Edit', 'web', '2025-03-20 09:49:56', '2025-03-20 09:49:56'),
(52, 'Deduction Delete', 'web', '2025-03-20 09:49:56', '2025-03-20 09:49:56'),
(53, 'Tax Deduction View', 'web', '2025-03-20 09:49:56', '2025-03-20 09:49:56'),
(54, 'Tax Deduction Create', 'web', '2025-03-20 09:49:56', '2025-03-20 09:49:56'),
(55, 'Tax Deduction Edit', 'web', '2025-03-20 09:49:56', '2025-03-20 09:49:56'),
(56, 'Tax Deduction Delete', 'web', '2025-03-20 09:49:57', '2025-03-20 09:49:57'),
(57, 'Cash Advance View', 'web', '2025-03-20 09:49:57', '2025-03-20 09:49:57'),
(58, 'Cash Advance Create', 'web', '2025-03-20 09:49:57', '2025-03-20 09:49:57'),
(59, 'Cash Advance Edit', 'web', '2025-03-20 09:49:57', '2025-03-20 09:49:57'),
(60, 'Cash Advance Delete', 'web', '2025-03-20 09:49:57', '2025-03-20 09:49:57'),
(61, 'Advance Salary View', 'web', '2025-03-20 09:49:57', '2025-03-20 09:49:57'),
(62, 'Advance Salary Create', 'web', '2025-03-20 09:49:58', '2025-03-20 09:49:58'),
(63, 'Advance Salary Edit', 'web', '2025-03-20 09:49:58', '2025-03-20 09:49:58'),
(64, 'Advance Salary Delete', 'web', '2025-03-20 09:49:58', '2025-03-20 09:49:58'),
(65, 'Holiday View', 'web', '2025-03-20 09:49:58', '2025-03-20 09:49:58'),
(66, 'Holiday Create', 'web', '2025-03-20 09:49:58', '2025-03-20 09:49:58'),
(67, 'Holiday Edit', 'web', '2025-03-20 09:49:58', '2025-03-20 09:49:58'),
(68, 'Holiday Delete', 'web', '2025-03-20 09:49:58', '2025-03-20 09:49:58'),
(69, 'Overtime View', 'web', '2025-03-20 09:49:58', '2025-03-20 09:49:58'),
(70, 'Overtime Create', 'web', '2025-03-20 09:49:58', '2025-03-20 09:49:58'),
(71, 'Overtime Edit', 'web', '2025-03-20 09:49:59', '2025-03-20 09:49:59'),
(72, 'Overtime Delete', 'web', '2025-03-20 09:49:59', '2025-03-20 09:49:59'),
(73, 'Payroll View', 'web', '2025-03-20 09:49:59', '2025-03-20 09:49:59'),
(74, 'Payroll Create', 'web', '2025-03-20 09:49:59', '2025-03-20 09:49:59'),
(75, 'Payroll Edit', 'web', '2025-03-20 09:49:59', '2025-03-20 09:49:59'),
(76, 'Payroll Delete', 'web', '2025-03-20 09:49:59', '2025-03-20 09:49:59'),
(77, 'Payroll Invoice Generate', 'web', '2025-03-20 09:49:59', '2025-03-20 09:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint UNSIGNED NOT NULL,
  `position_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobnature_id` bigint UNSIGNED NOT NULL,
  `position_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position_name`, `jobnature_id`, `position_level`, `created_at`, `updated_at`) VALUES
(1, 'Demo Position', 1, 'Senior', '2025-03-20 10:34:29', '2025-03-20 10:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `position_levels`
--

CREATE TABLE `position_levels` (
  `id` bigint UNSIGNED NOT NULL,
  `position_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `position_levels`
--

INSERT INTO `position_levels` (`id`, `position_level`, `created_at`, `updated_at`) VALUES
(1, 'Senior', '2025-03-20 09:50:01', '2025-03-20 09:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-03-20 09:49:48', '2025-03-20 09:49:48'),
(2, 'employee', 'web', '2025-03-20 09:49:48', '2025-03-20 09:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` json NOT NULL,
  `num_of_min_before_checkin` int NOT NULL,
  `shift_start_time` int NOT NULL,
  `shift_end_time` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `name`, `checkin`, `checkout`, `days`, `num_of_min_before_checkin`, `shift_start_time`, `shift_end_time`, `created_at`, `updated_at`) VALUES
(1, 'Test', '04:00', '17:00', '[\"Monday\", \"Tuesday\", \"Wednesday\", \"Thursday\", \"Friday\", \"Saturday\", \"Sunday\"]', 15, 60, 60, '2025-03-20 10:39:09', '2025-03-20 10:39:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('rM3tDRKfW3d8OnR0N8DkaZDiZSArxDV3D5gzwUfr', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiaG8xeWVqVGVhRHRva2szb0JEVGIxNGhkYk5ISkRjcEhkVWJ6ekJrUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1742483749),
('RsQUaHQZCUzIMepgtg8sP8J9cimYwnYkYtfIU4wM', 2, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTWQ3S3F3T2l0VDVUMmZrUEJOS2VwcjBtSEtRNUh3ODlHd1NmRlMzViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wYXlzbGlwLzEiO31zOjM6InVybCI7YTowOnt9czoxODoiZmxhc2hlcjo6ZW52ZWxvcGVzIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1742484731);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `system_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_zone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `developed_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_title`, `system_logo`, `favicon`, `auth_logo`, `company_name`, `time_zone`, `currency`, `developed_by`, `created_at`, `updated_at`) VALUES
(1, 'ApexUnified HRM Mini', '174246774167dbf29d64ad9.png', '174246774167dbf29d65769.png', '174246774167dbf29d662c2.png', 'ApexUnified', 'Asia/Karachi', 'Rs', 'Sheikh Abdullah', '2025-03-20 09:50:00', '2025-03-20 10:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `tax_deductions`
--

CREATE TABLE `tax_deductions` (
  `id` bigint UNSIGNED NOT NULL,
  `tax_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_percentage` decimal(20,2) NOT NULL,
  `tax_amount` decimal(8,2) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abdullah', 'admin@gmail.com', NULL, NULL, '$2y$12$9NtO3BFw.LLP2UA8aIs4qOh1f8pjrM3MOTAQpMw/P8C2cNjdcauky', NULL, '2025-03-20 09:49:48', '2025-03-20 09:49:48'),
(2, 'Abdullah', 'abdullahsheikhmuhammad21@gmail.com', NULL, NULL, '$2y$12$P1KMIibxz0.pDyhAkZjz4u0pO1.1L3eRgQ2tXVFDW3.l0Ft3QaDR2', 'ISWOe5btxzpCkJAMfmGBle9HuDQmgNJNuofpj1PogT9iUD2kHPmvMUvdL4J9', '2025-03-20 15:25:21', '2025-03-20 15:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `zkteco_devices`
--

CREATE TABLE `zkteco_devices` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `port` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zkteco_devices`
--

INSERT INTO `zkteco_devices` (`id`, `name`, `ip_address`, `port`, `created_at`, `updated_at`) VALUES
(1, 'DDDD', '127.0.0.1', '5555', '2025-03-20 10:44:47', '2025-03-20 10:44:47');

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
-- Indexes for table `attendance_pay_deductions`
--
ALTER TABLE `attendance_pay_deductions`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `employees_department_id_foreign` (`department_id`),
  ADD KEY `employees_position_id_foreign` (`position_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `loan_payments`
--
ALTER TABLE `loan_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_payments_employee_id_foreign` (`employee_id`);

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
-- Indexes for table `overtimes`
--
ALTER TABLE `overtimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `overtimes_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `overtime_pays`
--
ALTER TABLE `overtime_pays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payslips`
--
ALTER TABLE `payslips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payslips_employee_id_foreign` (`employee_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `allowances`
--
ALTER TABLE `allowances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `allowance_types`
--
ALTER TABLE `allowance_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_pay_deductions`
--
ALTER TABLE `attendance_pay_deductions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bonuses`
--
ALTER TABLE `bonuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cash_advances`
--
ALTER TABLE `cash_advances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobnatures`
--
ALTER TABLE `jobnatures`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `job_nature_types`
--
ALTER TABLE `job_nature_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_payments`
--
ALTER TABLE `loan_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail_logs`
--
ALTER TABLE `mail_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail_settings`
--
ALTER TABLE `mail_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `overtimes`
--
ALTER TABLE `overtimes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `overtime_pays`
--
ALTER TABLE `overtime_pays`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payslips`
--
ALTER TABLE `payslips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `position_levels`
--
ALTER TABLE `position_levels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tax_deductions`
--
ALTER TABLE `tax_deductions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zkteco_devices`
--
ALTER TABLE `zkteco_devices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loan_payments`
--
ALTER TABLE `loan_payments`
  ADD CONSTRAINT `loan_payments_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `overtimes`
--
ALTER TABLE `overtimes`
  ADD CONSTRAINT `overtimes_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payslips`
--
ALTER TABLE `payslips`
  ADD CONSTRAINT `payslips_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

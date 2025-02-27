-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 09:34 PM
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
-- Database: `hrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE `allowances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `accommodation_allowance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `medical_allowance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `conveyance_allowance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `mobile_allowance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `fuel_allowance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_allowance` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `hours_worked` varchar(255) DEFAULT NULL,
  `attendance_status` varchar(255) NOT NULL,
  `leave_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `attendance_date`, `attendance_checkin`, `attendance_checkout`, `hours_worked`, `attendance_status`, `leave_type`, `created_at`, `updated_at`) VALUES
(82, 2388, '2025-01-06', '10:00', '5', '480', 'On-Time', NULL, '2025-01-06 05:22:41', '2025-01-06 05:22:41');

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
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:71:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:15:\"view attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:17:\"create attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:15:\"edit attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:17:\"delete attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:10:\"view leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:12:\"create leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:10:\"edit leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:12:\"delete leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"view department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:17:\"create department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:15:\"edit department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:17:\"delete department\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:13:\"view employee\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:15:\"create employee\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:13:\"edit employee\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:15:\"delete employee\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:13:\"view overtime\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:15:\"create overtime\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:13:\"edit overtime\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:15:\"delete overtime\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:9:\"view loan\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:11:\"create loan\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:9:\"edit loan\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:11:\"delete loan\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:17:\"view cash advance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:19:\"create cash advance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:17:\"edit cash advance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:19:\"delete cash advance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:22:\"view employee schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:29;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:22:\"edit employee schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:30;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:13:\"view position\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:31;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:15:\"create position\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:32;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:13:\"edit position\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:33;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:15:\"delete position\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:34;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:15:\"view job nature\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:35;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:17:\"create job nature\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:36;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:15:\"edit job nature\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:37;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:17:\"delete job nature\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:38;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:14:\"view deduction\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:39;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:16:\"create deduction\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:40;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:14:\"edit deduction\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:41;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:16:\"delete deduction\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:42;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:20:\"view general setting\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:43;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:9:\"view role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:44;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:11:\"create role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:45;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:11:\"delete role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:46;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:17:\"change permission\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:23:\"view salary calculation\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:48;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:25:\"create salary calculation\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:49;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:23:\"edit salary calculation\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:50;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:25:\"delete salary calculation\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:51;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:12:\"view payslip\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:52;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:14:\"create payslip\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:53;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:12:\"edit payslip\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:54;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:14:\"delete payslip\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:55;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:13:\"view schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:56;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:15:\"create schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:57;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:13:\"edit schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:58;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:15:\"delete schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:59;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:9:\"view user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:60;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:12:\"create  user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:61;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:9:\"edit user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:62;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:11:\"delete user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:63;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:14:\"view allowance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:64;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:16:\"create allowance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:65;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:14:\"edit allowance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:66;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:16:\"delete allowance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:67;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:14:\"view employees\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:68;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:13:\"view payrolls\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:69;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:13:\"view settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:70;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:12:\"view reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:8:\"employee\";s:1:\"c\";s:3:\"web\";}}}', 1737405107);

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
  `amount` decimal(15,2) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `tax_deduction` decimal(15,2) NOT NULL DEFAULT 0.00,
  `loan_deduction` decimal(15,2) NOT NULL DEFAULT 0.00,
  `other_deduction` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_deduction` decimal(15,2) NOT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `created_at`, `updated_at`) VALUES
(1, 'Default Department', '2024-12-27 20:33:31', '2024-12-27 20:33:31');

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
  `designation` varchar(255) NOT NULL,
  `device_id` longtext NOT NULL,
  `device_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `employee_name`, `father_name`, `employee_dob`, `date_of_hiring`, `department_id`, `employee_schedule`, `designation`, `device_id`, `device_user_id`, `created_at`, `updated_at`) VALUES
(2388, 9566509966, 'Abdullah', 'Akhter Hussain', '2024-12-30', '2025-01-06', 1, '8', 'Aut iure est rerum s', '[\"1\"]', 1, '2025-01-06 05:22:19', '2025-01-06 05:22:19');

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
-- Table structure for table `job_natures`
--

CREATE TABLE `job_natures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_nature_title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_natures`
--

INSERT INTO `job_natures` (`id`, `job_nature_title`, `created_at`, `updated_at`) VALUES
(1, 'Permanent', '2024-11-03 05:41:10', '2024-11-03 05:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `leave_start_date` varchar(255) NOT NULL,
  `leave_end_date` varchar(255) NOT NULL,
  `leave_days` int(11) NOT NULL,
  `leave_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `opening_balance` decimal(15,2) NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `deduction_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `closing_balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `loan_status` varchar(255) NOT NULL,
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
(1, 'smtp', 'smtp.gmail.com', '587', 'asadsasoli8@gmail.com', 'ynybcouswupxlhfa', 'tls', 'asadsasoli8@gmail.com', 'HRM', 'abdullahsheikhmuhammad21@gmail.com', '18:15', '2024-12-08 23:56:59', '2024-12-19 13:12:18');

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
(4, '2024_10_31_093632_create_departments_table', 1),
(5, '2024_10_31_093910_create_employees_table', 1),
(6, '2024_10_31_094252_create_attendances_table', 1),
(7, '2024_10_31_094550_create_leaves_table', 1),
(8, '2024_10_31_094926_create_payrolls_table', 1),
(9, '2024_10_31_095554_create_allowances_table', 1),
(10, '2024_10_31_100841_create_deductions_table', 1),
(11, '2024_10_31_101101_create_over_times_table', 1),
(12, '2024_10_31_101538_create_loans_table', 1),
(13, '2024_10_31_104150_create_payslips_table', 1),
(14, '2024_10_31_110100_create_permission_tables', 1),
(15, '2024_11_01_032030_create_schedules_table', 1),
(16, '2024_11_01_075209_create_positions_table', 1),
(17, '2024_11_01_110710_create_cash_advances_table', 1),
(18, '2024_11_02_051032_create_job_natures_table', 1),
(21, '2024_11_04_113503_create_settings_table', 2),
(26, '2024_11_06_124450_create_salary_calculations_table', 3),
(28, '2024_12_07_014707_create_attendance_checkers_table', 4),
(30, '2024_12_08_121120_create_zkteco_devices_table', 5),
(31, '2024_12_08_135729_update_employees_table', 6),
(32, '2024_12_09_042339_create_mail_settings_table', 7),
(33, '2024_12_09_151450_create_mail_logs_table', 8);

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
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 11),
(4, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `over_times`
--

CREATE TABLE `over_times` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `hourly_rate` decimal(15,2) NOT NULL,
  `total_overtime_hours` decimal(15,2) DEFAULT NULL,
  `total_overtime_pay` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `employee_dob` varchar(255) NOT NULL,
  `date_of_hiring` varchar(255) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `employee_position` varchar(255) NOT NULL,
  `employee_salary` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payslips`
--

CREATE TABLE `payslips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `salary_month` varchar(255) NOT NULL,
  `base_salary` decimal(15,2) NOT NULL,
  `total_allowance` int(11) NOT NULL,
  `total_deduction` int(11) NOT NULL,
  `net_pay` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, 'view attendance', 'web', '2024-11-05 10:32:20', '2024-11-05 10:32:20'),
(2, 'create attendance', 'web', '2024-11-05 10:32:38', '2024-11-05 10:32:38'),
(3, 'edit attendance', 'web', '2024-11-05 10:32:52', '2024-11-05 10:32:52'),
(4, 'delete attendance', 'web', '2024-11-05 10:33:06', '2024-11-05 10:33:06'),
(5, 'view leave', 'web', '2024-11-05 10:36:24', '2024-11-05 10:36:24'),
(6, 'create leave', 'web', '2024-11-05 10:36:39', '2024-11-05 10:36:39'),
(7, 'edit leave', 'web', '2024-11-05 10:36:51', '2024-11-05 10:36:51'),
(8, 'delete leave', 'web', '2024-11-05 10:37:04', '2024-11-05 10:37:04'),
(9, 'view department', 'web', '2024-11-05 10:37:48', '2024-11-05 10:37:48'),
(10, 'create department', 'web', '2024-11-05 10:38:04', '2024-11-05 10:38:04'),
(11, 'edit department', 'web', '2024-11-05 10:38:19', '2024-11-05 10:38:19'),
(12, 'delete department', 'web', '2024-11-05 10:38:33', '2024-11-05 10:38:33'),
(13, 'view employee', 'web', '2024-11-05 10:45:25', '2024-11-05 10:45:25'),
(14, 'create employee', 'web', '2024-11-05 10:45:39', '2024-11-05 10:45:39'),
(15, 'edit employee', 'web', '2024-11-05 10:45:53', '2024-11-05 10:45:53'),
(16, 'delete employee', 'web', '2024-11-05 10:46:10', '2024-11-05 10:46:10'),
(17, 'view overtime', 'web', '2024-11-05 10:46:23', '2024-11-05 10:46:23'),
(18, 'create overtime', 'web', '2024-11-05 10:46:37', '2024-11-05 10:46:37'),
(19, 'edit overtime', 'web', '2024-11-05 10:46:54', '2024-11-05 10:46:54'),
(20, 'delete overtime', 'web', '2024-11-05 10:47:12', '2024-11-05 10:47:12'),
(21, 'view loan', 'web', '2024-11-05 10:47:33', '2024-11-05 10:47:33'),
(22, 'create loan', 'web', '2024-11-05 10:47:50', '2024-11-05 10:47:50'),
(23, 'edit loan', 'web', '2024-11-05 10:48:08', '2024-11-05 10:48:08'),
(24, 'delete loan', 'web', '2024-11-05 10:48:21', '2024-11-05 10:48:21'),
(25, 'view cash advance', 'web', '2024-11-05 10:48:47', '2024-11-05 10:48:47'),
(26, 'create cash advance', 'web', '2024-11-05 10:49:12', '2024-11-05 10:49:12'),
(27, 'edit cash advance', 'web', '2024-11-05 10:49:45', '2024-11-05 10:49:45'),
(28, 'delete cash advance', 'web', '2024-11-05 10:49:56', '2024-11-05 10:49:56'),
(29, 'view employee schedule', 'web', '2024-11-05 10:50:19', '2024-11-05 10:50:19'),
(31, 'edit employee schedule', 'web', '2024-11-05 10:50:46', '2024-11-05 10:50:46'),
(33, 'view position', 'web', '2024-11-05 10:51:06', '2024-11-05 10:51:06'),
(34, 'create position', 'web', '2024-11-05 10:51:16', '2024-11-05 10:51:16'),
(35, 'edit position', 'web', '2024-11-05 10:51:41', '2024-11-05 10:51:41'),
(36, 'delete position', 'web', '2024-11-05 10:51:51', '2024-11-05 10:51:51'),
(37, 'view job nature', 'web', '2024-11-05 10:52:04', '2024-11-05 10:52:04'),
(38, 'create job nature', 'web', '2024-11-05 10:52:15', '2024-11-05 10:52:15'),
(39, 'edit job nature', 'web', '2024-11-05 10:52:25', '2024-11-05 10:52:25'),
(40, 'delete job nature', 'web', '2024-11-05 10:52:36', '2024-11-05 10:52:36'),
(41, 'view deduction', 'web', '2024-11-05 10:52:46', '2024-11-05 10:52:46'),
(42, 'create deduction', 'web', '2024-11-05 10:53:01', '2024-11-05 10:53:01'),
(43, 'edit deduction', 'web', '2024-11-05 10:53:10', '2024-11-05 10:53:10'),
(44, 'delete deduction', 'web', '2024-11-05 10:53:21', '2024-11-05 10:53:21'),
(45, 'view general setting', 'web', '2024-11-05 10:53:35', '2024-11-05 10:53:35'),
(46, 'view role', 'web', '2024-11-05 10:53:44', '2024-11-05 10:53:44'),
(47, 'create role', 'web', '2024-11-05 10:53:53', '2024-11-05 10:53:53'),
(49, 'delete role', 'web', '2024-11-05 10:54:15', '2024-11-05 10:54:15'),
(50, 'change permission', 'web', '2024-11-05 10:54:26', '2024-11-05 10:54:26'),
(54, 'view salary calculation', 'web', '2024-11-07 10:32:09', '2024-11-07 10:32:09'),
(55, 'create salary calculation', 'web', '2024-11-07 10:32:26', '2024-11-07 10:32:26'),
(56, 'edit salary calculation', 'web', '2024-11-07 10:32:36', '2024-11-07 10:32:36'),
(57, 'delete salary calculation', 'web', '2024-11-07 10:32:50', '2024-11-07 10:32:50'),
(58, 'view payslip', 'web', '2024-11-07 10:33:03', '2024-11-07 10:33:03'),
(59, 'create payslip', 'web', '2024-11-07 10:33:53', '2024-11-07 10:33:53'),
(60, 'edit payslip', 'web', '2024-11-07 10:34:04', '2024-11-07 10:34:04'),
(61, 'delete payslip', 'web', '2024-11-07 10:34:15', '2024-11-07 10:34:15'),
(62, 'view schedule', 'web', '2024-11-07 11:18:14', '2024-11-07 11:18:14'),
(63, 'create schedule', 'web', '2024-11-07 11:18:23', '2024-11-07 11:18:23'),
(64, 'edit schedule', 'web', '2024-11-07 11:18:32', '2024-11-07 11:18:32'),
(65, 'delete schedule', 'web', '2024-11-07 11:18:42', '2024-11-07 11:18:42'),
(66, 'view user', 'web', '2024-11-07 11:27:40', '2024-11-07 11:27:40'),
(67, 'create  user', 'web', '2024-11-07 11:27:50', '2024-11-07 11:27:50'),
(68, 'edit user', 'web', '2024-11-07 11:28:05', '2024-11-07 11:28:05'),
(69, 'delete user', 'web', '2024-11-07 11:28:14', '2024-11-07 11:28:14'),
(70, 'view allowance', 'web', '2024-11-07 11:29:40', '2024-11-07 11:29:40'),
(71, 'create allowance', 'web', '2024-11-07 11:29:50', '2024-11-07 11:29:50'),
(72, 'edit allowance', 'web', '2024-11-07 11:29:59', '2024-11-07 11:29:59'),
(73, 'delete allowance', 'web', '2024-11-07 11:30:09', '2024-11-07 11:30:09'),
(74, 'view employees', 'web', NULL, NULL),
(75, 'view payrolls', 'web', NULL, NULL),
(76, 'view settings', 'web', NULL, NULL),
(77, 'view reports', 'web', '2024-11-09 07:08:07', '2024-11-09 07:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_name` varchar(255) NOT NULL,
  `rate_per_hour` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position_name`, `rate_per_hour`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 50.00, '2024-11-03 05:41:03', '2024-11-03 05:41:03');

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
(1, 'admin', 'web', '2024-11-05 10:03:43', NULL),
(4, 'employee', 'web', '2024-11-05 10:22:57', '2024-11-05 10:22:57'),
(5, 'hr', 'web', '2024-11-05 11:34:09', '2024-11-05 11:34:09');

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
(1, 4),
(2, 1),
(2, 4),
(3, 1),
(3, 4),
(4, 1),
(4, 4),
(5, 1),
(5, 4),
(6, 1),
(6, 4),
(7, 1),
(7, 4),
(8, 1),
(8, 4),
(9, 1),
(9, 4),
(10, 1),
(10, 4),
(11, 1),
(11, 4),
(12, 1),
(12, 4),
(13, 1),
(13, 4),
(14, 1),
(14, 4),
(15, 1),
(15, 4),
(16, 1),
(16, 4),
(17, 1),
(17, 4),
(18, 1),
(18, 4),
(19, 1),
(19, 4),
(20, 1),
(20, 4),
(21, 1),
(21, 4),
(22, 1),
(22, 4),
(23, 1),
(23, 4),
(24, 1),
(24, 4),
(25, 1),
(25, 4),
(26, 1),
(26, 4),
(27, 1),
(27, 4),
(28, 1),
(28, 4),
(29, 1),
(29, 4),
(31, 1),
(31, 4),
(33, 1),
(33, 4),
(34, 1),
(34, 4),
(35, 1),
(35, 4),
(36, 1),
(36, 4),
(37, 1),
(37, 4),
(38, 1),
(38, 4),
(39, 1),
(39, 4),
(40, 1),
(40, 4),
(41, 1),
(41, 4),
(42, 1),
(42, 4),
(43, 1),
(43, 4),
(44, 1),
(44, 4),
(45, 1),
(46, 1),
(46, 4),
(47, 1),
(47, 4),
(49, 1),
(49, 4),
(50, 1),
(54, 1),
(54, 4),
(55, 1),
(55, 4),
(56, 1),
(56, 4),
(57, 1),
(57, 4),
(58, 1),
(58, 4),
(59, 1),
(59, 4),
(60, 1),
(60, 4),
(61, 1),
(61, 4),
(62, 1),
(62, 4),
(63, 1),
(63, 4),
(64, 1),
(64, 4),
(65, 1),
(65, 4),
(66, 1),
(66, 4),
(67, 1),
(67, 4),
(68, 1),
(68, 4),
(69, 1),
(69, 4),
(70, 1),
(70, 4),
(71, 1),
(71, 4),
(72, 1),
(72, 4),
(73, 1),
(73, 4),
(74, 1),
(74, 4),
(75, 1),
(75, 4),
(76, 1),
(76, 4),
(77, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salary_calculations`
--

CREATE TABLE `salary_calculations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `base_salary` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_allowance` int(11) DEFAULT NULL,
  `total_deduction` int(11) DEFAULT NULL,
  `net_salary` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `days` longtext NOT NULL,
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
(8, 'Schedule 1', '10:00', '17:00', '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\",\"Saturday\",\"Sunday\"]', 30, 60, 60, '2025-01-06 05:21:51', '2025-01-06 05:21:51');

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

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_title` varchar(255) DEFAULT NULL,
  `system_logo` varchar(255) DEFAULT NULL,
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

INSERT INTO `settings` (`id`, `system_title`, `system_logo`, `company_name`, `time_zone`, `currency`, `developed_by`, `created_at`, `updated_at`) VALUES
(1, 'HRM', '1737230524678c08bcbd365.png', 'Apex Unified', 'Asia/Karachi', 'Rs:', 'Sheikh Abdullah', '2024-11-04 09:52:22', '2025-01-18 20:31:46');

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
(1, 'admin', 'admin@gmail.com', '1737222126678be7ee212db.png', NULL, '$2y$12$5jheeamsJuzsTeCfC19.HumdPVSgVHJHEwSjXp69HtE1RfvWxHBCa', 'f4cpbdB2A9lOEHixu1UzZ1HOC5dULlSf2yhwAn7AOUilZQa6Gj2wpcj4QB7e', '2024-11-03 05:38:00', '2025-01-18 17:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `zkteco_devices`
--

CREATE TABLE `zkteco_devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `device_time` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zkteco_devices`
--

INSERT INTO `zkteco_devices` (`id`, `name`, `ip_address`, `port`, `device_time`, `created_at`, `updated_at`) VALUES
(1, '[value-2]', '[value-3]', '[value-4]', '[value-5]', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowances`
--
ALTER TABLE `allowances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `allowances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_employee_id_foreign` (`employee_id`);

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
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deductions_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_department_id_foreign` (`department_id`),
  ADD KEY `employees_device_id_foreign` (`device_id`(768));

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `job_natures`
--
ALTER TABLE `job_natures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leaves_employee_id_foreign` (`employee_id`);

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
-- Indexes for table `over_times`
--
ALTER TABLE `over_times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `over_times_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payrolls_department_id_foreign` (`department_id`);

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
-- Indexes for table `salary_calculations`
--
ALTER TABLE `salary_calculations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salary_calculations_employee_id_foreign` (`employee_id`);

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
-- AUTO_INCREMENT for table `allowances`
--
ALTER TABLE `allowances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `cash_advances`
--
ALTER TABLE `cash_advances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2389;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_natures`
--
ALTER TABLE `job_natures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `over_times`
--
ALTER TABLE `over_times`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payslips`
--
ALTER TABLE `payslips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salary_calculations`
--
ALTER TABLE `salary_calculations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `zkteco_devices`
--
ALTER TABLE `zkteco_devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allowances`
--
ALTER TABLE `allowances`
  ADD CONSTRAINT `allowances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cash_advances`
--
ALTER TABLE `cash_advances`
  ADD CONSTRAINT `cash_advances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deductions`
--
ALTER TABLE `deductions`
  ADD CONSTRAINT `deductions_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `over_times`
--
ALTER TABLE `over_times`
  ADD CONSTRAINT `over_times_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD CONSTRAINT `payrolls_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payslips`
--
ALTER TABLE `payslips`
  ADD CONSTRAINT `payslips_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salary_calculations`
--
ALTER TABLE `salary_calculations`
  ADD CONSTRAINT `salary_calculations_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

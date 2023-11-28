-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 14, 2023 at 01:45 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_flycatcher`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `type` enum('rider','merchant','admin') NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `debit` double(15,2) DEFAULT NULL,
  `credit` double(8,2) DEFAULT NULL,
  `balance` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `isActive` tinyint NOT NULL DEFAULT '1',
  `collection` enum('1','0') NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `hub_id`, `name`, `email`, `email_verified_at`, `password`, `mobile`, `isActive`, `collection`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', 'super@gmail.com', NULL, '$2y$10$1fy42MSUdNtdBeHuQksT5uEkFIZRdBwMZDKDint2UxfpTiUd4bTmO', NULL, 1, '0', NULL, NULL, NULL, NULL),
(2, 1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$iLHpxAusc1yb0A2FB8ON7uQJssoGjU.5fMGerhmm8W.AFDOuZOFuK', NULL, 1, '0', NULL, NULL, NULL, NULL),
(3, 1, 'Accounts', 'accounts@gmail.com', NULL, '$2y$10$GFw46Pqv8yNCbcYErNNYaedT7P21nSB1RYpkwyYxdYoeWIoPoDiJm', '01725848515', 1, '0', NULL, NULL, NULL, '2022-10-16 00:06:31'),
(4, 1, 'Incharge', 'incharge@gmail.com', NULL, '$2y$10$EUOS/h6m5YY.5XToMl4UQONrovcMp5//YBV4UBQZAyL9Wx9AXas2q', NULL, 1, '1', NULL, NULL, NULL, NULL),
(5, 1, 'Merketing', 'merketing@gmail.com', NULL, '$2y$10$njxu0VtPha/4XSb9p2ZeuuFoUbVnQgpIX6E0j6MBHXlF9xMctOXay', NULL, 1, '0', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `advances`
--

CREATE TABLE `advances` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `advance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_advance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `adjust` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_adjust` decimal(10,2) NOT NULL DEFAULT '0.00',
  `receivable` decimal(10,2) NOT NULL DEFAULT '0.00',
  `note` text,
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `guard_name` enum('admin','rider') NOT NULL DEFAULT 'admin',
  `created_for_admin` bigint UNSIGNED DEFAULT NULL,
  `created_for_rider` bigint UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint UNSIGNED NOT NULL,
  `city_type_id` bigint UNSIGNED NOT NULL,
  `district_id` bigint UNSIGNED NOT NULL,
  `upazila_id` bigint UNSIGNED DEFAULT NULL,
  `area_name` varchar(191) NOT NULL,
  `area_code` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `city_type_id`, `district_id`, `upazila_id`, `area_name`, `area_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 47, NULL, 'Mirpur', '1', 'active', '2022-07-23 11:31:38', '2022-07-23 11:31:38'),
(2, 1, 47, NULL, 'Khilgaon', '1219', 'active', '2022-10-11 22:44:16', '2022-10-11 22:45:30'),
(3, 1, 47, NULL, 'Shantinagar', '1217', 'active', '2022-10-11 23:39:50', '2022-10-11 23:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `assign_areas`
--

CREATE TABLE `assign_areas` (
  `id` bigint UNSIGNED NOT NULL,
  `area_id` bigint UNSIGNED DEFAULT NULL,
  `sub_area_id` bigint UNSIGNED DEFAULT NULL,
  `assignable_id` bigint UNSIGNED NOT NULL,
  `assignable_type` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `assign_areas`
--

INSERT INTO `assign_areas` (`id`, `area_id`, `sub_area_id`, `assignable_id`, `assignable_type`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, 'App\\Models\\Admin\\Rider', '2022-07-23 11:34:44', '2022-07-23 11:34:44'),
(2, NULL, 2, 2, 'App\\Models\\Admin\\Rider', '2022-10-11 22:46:45', '2022-10-11 22:46:45'),
(5, NULL, 5, 4, 'App\\Models\\Admin\\Rider', '2022-10-11 23:50:46', '2022-10-11 23:50:46'),
(6, NULL, 3, 3, 'App\\Models\\Admin\\Rider', '2022-10-12 00:53:03', '2022-10-12 00:53:03');

-- --------------------------------------------------------

--
-- Table structure for table `bad_debts`
--

CREATE TABLE `bad_debts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `receivable_amount` decimal(10,2) NOT NULL,
  `note` longtext,
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `bad_debt_adjusts`
--

CREATE TABLE `bad_debt_adjusts` (
  `id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `note` longtext,
  `bad_debt_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint UNSIGNED NOT NULL,
  `payment_method_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `category` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `payment_method_id`, `name`, `category`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bangladesh Bank', 'Central Bank', 'active', NULL, NULL),
(2, 1, 'Sonali Bank', 'State-owned Commercial', 'active', NULL, NULL),
(3, 1, 'Agrani Bank', 'State-owned Commercial', 'active', NULL, NULL),
(4, 1, 'Rupali Bank', 'State-owned Commercial', 'active', NULL, NULL),
(5, 1, 'Janata Bank', 'State-owned Commercial', 'active', NULL, NULL),
(6, 1, 'BRAC Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(7, 1, 'Dutch Bangla Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(8, 1, 'Eastern Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(9, 1, 'United Commercial Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(10, 1, 'Mutual Trust Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(11, 1, 'Dhaka Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(12, 1, 'Islami Bank Bangladesh Ltd', 'Private Commercial', 'active', NULL, NULL),
(13, 1, 'Uttara Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(14, 1, 'Pubali Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(15, 1, 'IFIC Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(16, 1, 'National Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(17, 1, 'The City Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(18, 1, 'NCC Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(19, 1, 'Mercantile Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(20, 1, 'Southeast Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(21, 1, 'Prime Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(22, 1, 'Social Islami Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(23, 1, 'Standard Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(24, 1, 'Al-Arafah Islami Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(25, 1, 'One Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(26, 1, 'Exim Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(27, 1, 'First Security Islami Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(28, 1, 'Bank Asia Limited', 'Private Commercial', 'active', NULL, NULL),
(29, 1, 'The Premier Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(30, 1, 'Bangladesh Commerce Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(31, 1, 'Trust Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(32, 1, 'Jamuna Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(33, 1, 'Shahjalal Islami Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(34, 1, 'ICB Islamic Bank', 'Private Commercial', 'active', NULL, NULL),
(35, 1, 'AB Bank', 'Private Commercial', 'active', NULL, NULL),
(36, 1, 'Jubilee Bank Limited', 'Private Commercial', 'active', NULL, NULL),
(37, 1, 'Karmasangsthan Bank', 'Specialized Development', 'active', NULL, NULL),
(38, 1, 'Bangladesh Krishi Bank', 'Specialized Development', 'active', NULL, NULL),
(39, 1, 'Progoti Bank', '', 'active', NULL, NULL),
(40, 1, 'Rajshahi Krishi Unnayan Bank', 'Specialized Development', 'active', NULL, NULL),
(41, 1, 'BangladeshDevelopment Bank Ltd', 'Specialized Development', 'active', NULL, NULL),
(42, 1, 'Bangladesh Somobay Bank Limited', 'Specialized Development', 'active', NULL, NULL),
(43, 1, 'Grameen Bank', 'Specialized Development', 'active', NULL, NULL),
(44, 1, 'BASIC Bank Limited', 'Specialized Development', 'active', NULL, NULL),
(45, 1, 'Ansar VDP Unnyan Bank', 'Specialized Development', 'active', NULL, NULL),
(46, 1, 'The Dhaka Mercantile Co-operative Bank Limited(DMCBL)', 'Specialized Development', 'active', NULL, NULL),
(47, 1, 'Citibank', 'Foreign Commercial', 'active', NULL, NULL),
(48, 1, 'HSBC', 'Foreign Commercial', 'active', NULL, NULL),
(49, 1, 'Standard Chartered Bank', 'Foreign Commercial', 'active', NULL, NULL),
(50, 1, 'CommercialBank of Ceylon', 'Foreign Commercial', 'active', NULL, NULL),
(51, 1, 'State Bank of India', 'Foreign Commercial', 'active', NULL, NULL),
(52, 1, 'WooriBank', 'Foreign Commercial', 'active', NULL, NULL),
(53, 1, 'Bank Alfalah', 'Foreign Commercial', 'active', NULL, NULL),
(54, 1, 'National Bank of Pakistan', 'Foreign Commercial', 'active', NULL, NULL),
(55, 1, 'ICICI Bank', 'Foreign Commercial', 'active', NULL, NULL),
(56, 1, 'Habib Bank Limited', 'Foreign Commercial', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cancle_invoices`
--

CREATE TABLE `cancle_invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_number` varchar(20) NOT NULL,
  `total_parcel_price` double(15,2) NOT NULL,
  `total_collection_amount` double(15,2) NOT NULL,
  `total_cod` double(8,2) DEFAULT NULL,
  `total_delivery_charge` double(15,2) NOT NULL,
  `total_payable` double(15,2) NOT NULL,
  `status` enum('pending','transfer','received') NOT NULL DEFAULT 'pending',
  `date` datetime DEFAULT NULL,
  `note` longtext,
  `created_by` bigint UNSIGNED NOT NULL,
  `merchant_id` bigint UNSIGNED DEFAULT NULL,
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `cancle_invoice_items`
--

CREATE TABLE `cancle_invoice_items` (
  `id` bigint UNSIGNED NOT NULL,
  `parcel_id` bigint UNSIGNED NOT NULL,
  `cancle_invoice_id` bigint UNSIGNED NOT NULL,
  `status` enum('full_cancle','partial_cancle') NOT NULL DEFAULT 'full_cancle',
  `collection_amount` double(8,2) NOT NULL,
  `cancle_amount` double(8,2) NOT NULL,
  `delivery_charge` double(8,2) NOT NULL,
  `cod_charge` double(8,2) NOT NULL,
  `net_payable` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `city_types`
--

CREATE TABLE `city_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `city_types`
--

INSERT INTO `city_types` (`id`, `name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Inside City', 'active', NULL, NULL, NULL),
(2, 'Sub City', 'active', NULL, NULL, NULL),
(3, 'Outside City', 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` bigint UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `collection_amount` decimal(8,2) DEFAULT NULL,
  `delivery_charge` decimal(8,2) NOT NULL,
  `cod_charge` decimal(8,2) NOT NULL,
  `net_payable` decimal(8,2) NOT NULL,
  `cancle_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `merchant_id` bigint UNSIGNED DEFAULT NULL,
  `parcel_id` bigint UNSIGNED NOT NULL,
  `tracking_id` bigint UNSIGNED DEFAULT NULL,
  `rider_collected_by` bigint UNSIGNED DEFAULT NULL,
  `rider_collected_time` datetime DEFAULT NULL,
  `rider_collected_status` enum('collected','transfer_request','transferred') NOT NULL DEFAULT 'collected',
  `rider_transfer_request_time` datetime DEFAULT NULL,
  `incharge_collected_by` bigint UNSIGNED DEFAULT NULL,
  `incharge_collected_time` datetime DEFAULT NULL,
  `incharge_collected_status` enum('collected','transfer_request','transferred') DEFAULT NULL,
  `incharge_transfer_request_time` datetime DEFAULT NULL,
  `accounts_collected_by` bigint UNSIGNED DEFAULT NULL,
  `accounts_collected_time` datetime DEFAULT NULL,
  `accounts_collected_status` enum('collected') DEFAULT NULL,
  `merchant_paid` enum('paid','unpaid','received') NOT NULL DEFAULT 'unpaid',
  `merchant_paid_time` datetime DEFAULT NULL,
  `note` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rider_collection_transfer_for` bigint UNSIGNED DEFAULT NULL,
  `incharge_collection_transfer_for` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `amount`, `collection_amount`, `delivery_charge`, `cod_charge`, `net_payable`, `cancle_amount`, `merchant_id`, `parcel_id`, `tracking_id`, `rider_collected_by`, `rider_collected_time`, `rider_collected_status`, `rider_transfer_request_time`, `incharge_collected_by`, `incharge_collected_time`, `incharge_collected_status`, `incharge_transfer_request_time`, `accounts_collected_by`, `accounts_collected_time`, `accounts_collected_status`, `merchant_paid`, `merchant_paid_time`, `note`, `created_at`, `updated_at`, `rider_collection_transfer_for`, `incharge_collection_transfer_for`) VALUES
(1, '500.00', '500.00', '20.00', '0.00', '480.00', '0.00', 1, 1, NULL, 1, '2022-07-23 17:38:43', 'transferred', '2022-07-23 17:40:14', 4, '2022-07-23 17:42:35', 'transferred', '2022-07-23 17:48:43', 3, '2022-07-23 17:49:26', 'collected', 'received', '2022-07-23 17:50:03', NULL, '2022-07-23 11:38:43', '2022-10-11 03:04:29', 4, NULL),
(2, '50.00', '50.00', '20.00', '0.00', '30.00', '0.00', 3, 4, NULL, 2, '2022-10-11 17:53:49', 'transferred', '2022-10-15 18:05:32', 4, '2022-10-15 18:44:25', 'transferred', '2022-10-15 19:04:54', 3, '2022-10-15 19:07:03', 'collected', 'unpaid', NULL, NULL, '2022-10-11 22:53:49', '2022-10-16 00:07:03', 4, NULL),
(3, '500.00', '500.00', '20.00', '0.00', '480.00', '0.00', 3, 5, NULL, 4, '2022-10-14 17:02:35', 'transferred', '2022-10-15 18:05:52', 4, '2022-10-15 18:44:21', 'transferred', '2022-10-15 19:04:54', 3, '2022-10-15 19:07:03', 'collected', 'unpaid', NULL, NULL, '2022-10-14 22:02:35', '2022-10-16 00:07:03', 4, NULL),
(4, '15000.00', '15000.00', '20.00', '0.00', '14980.00', '0.00', 3, 8, NULL, 3, '2022-10-14 17:06:11', 'transferred', '2022-10-14 17:10:55', 4, '2022-10-15 18:44:18', 'transferred', '2022-10-15 19:04:54', 3, '2022-10-15 19:07:03', 'collected', 'unpaid', NULL, NULL, '2022-10-14 22:06:11', '2022-10-16 00:07:03', 4, NULL),
(5, '12000.00', '12000.00', '20.00', '0.00', '11980.00', '0.00', 1, 3, NULL, 1, '2022-10-14 18:51:52', 'transferred', '2022-10-14 18:52:56', 4, '2022-10-15 18:44:16', 'transferred', '2022-10-15 19:04:54', 3, '2022-10-15 19:07:03', 'collected', 'unpaid', NULL, NULL, '2022-10-14 23:51:52', '2022-10-16 00:07:03', 4, NULL),
(6, '500.00', '500.00', '20.00', '0.00', '480.00', '0.00', 1, 2, NULL, 1, '2022-10-14 18:52:03', 'transferred', '2022-10-14 18:52:56', 4, '2022-10-15 18:44:16', 'transferred', '2022-10-15 19:04:54', 3, '2022-10-15 19:07:03', 'collected', 'unpaid', NULL, NULL, '2022-10-14 23:52:03', '2022-10-16 00:07:03', 4, NULL),
(7, '500.00', '500.00', '20.00', '0.00', '480.00', '0.00', 1, 9, NULL, 2, '2022-10-22 14:46:41', 'transfer_request', '2022-10-22 14:49:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'unpaid', NULL, NULL, '2022-10-22 08:46:41', '2022-10-22 08:49:03', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint UNSIGNED NOT NULL,
  `description` text,
  `reply` text,
  `merchant_id` bigint UNSIGNED NOT NULL,
  `status` enum('seen','unseen') NOT NULL DEFAULT 'unseen',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_charges`
--

CREATE TABLE `delivery_charges` (
  `id` bigint UNSIGNED NOT NULL,
  `merchant_id` bigint UNSIGNED DEFAULT NULL,
  `city_type_id` bigint UNSIGNED NOT NULL,
  `weight_range_id` bigint UNSIGNED NOT NULL,
  `delivery_charge` decimal(10,2) NOT NULL,
  `cod` decimal(10,2) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `is_global` enum('yes','no') NOT NULL DEFAULT 'yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `delivery_charges`
--

INSERT INTO `delivery_charges` (`id`, `merchant_id`, `city_type_id`, `weight_range_id`, `delivery_charge`, `cod`, `status`, `is_global`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 1, 1, '20.00', '0.00', 'active', 'yes', '2022-07-23 11:33:44', '2022-07-23 11:33:44', NULL),
(2, NULL, 1, 2, '30.00', '0.00', 'active', 'yes', '2022-10-15 22:34:21', '2022-10-15 22:34:21', NULL),
(3, NULL, 1, 3, '50.00', '0.00', 'active', 'yes', '2022-10-15 22:34:39', '2022-10-15 22:34:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint UNSIGNED NOT NULL,
  `division_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `lat` varchar(191) DEFAULT NULL,
  `lon` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `lat`, `lon`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Comilla', 'কুমিল্লা', '23.4682747', '91.1788135', 'www.comilla.gov.bd', NULL, NULL),
(2, 1, 'Feni', 'ফেনী', '23.023231', '91.3840844', 'www.feni.gov.bd', NULL, NULL),
(3, 1, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', '23.9570904', '91.1119286', 'www.brahmanbaria.gov.bd', NULL, NULL),
(4, 1, 'Rangamati', 'রাঙ্গামাটি', NULL, NULL, 'www.rangamati.gov.bd', NULL, NULL),
(5, 1, 'Noakhali', 'নোয়াখালী', '22.869563', '91.099398', 'www.noakhali.gov.bd', NULL, NULL),
(6, 1, 'Chandpur', 'চাঁদপুর', '23.2332585', '90.6712912', 'www.chandpur.gov.bd', NULL, NULL),
(7, 1, 'Lakshmipur', 'লক্ষ্মীপুর', '22.942477', '90.841184', 'www.lakshmipur.gov.bd', NULL, NULL),
(8, 1, 'Chattogram', 'চট্টগ্রাম', '22.335109', '91.834073', 'www.chittagong.gov.bd', NULL, NULL),
(9, 1, 'Coxsbazar', 'কক্সবাজার', NULL, NULL, 'www.coxsbazar.gov.bd', NULL, NULL),
(10, 1, 'Khagrachhari', 'খাগড়াছড়ি', '23.119285', '91.984663', 'www.khagrachhari.gov.bd', NULL, NULL),
(11, 1, 'Bandarban', 'বান্দরবান', '22.1953275', '92.2183773', 'www.bandarban.gov.bd', NULL, NULL),
(12, 2, 'Sirajganj', 'সিরাজগঞ্জ', '24.4533978', '89.7006815', 'www.sirajganj.gov.bd', NULL, NULL),
(13, 2, 'Pabna', 'পাবনা', '23.998524', '89.233645', 'www.pabna.gov.bd', NULL, NULL),
(14, 2, 'Bogura', 'বগুড়া', '24.8465228', '89.377755', 'www.bogra.gov.bd', NULL, NULL),
(15, 2, 'Rajshahi', 'রাজশাহী', NULL, NULL, 'www.rajshahi.gov.bd', NULL, NULL),
(16, 2, 'Natore', 'নাটোর', '24.420556', '89.000282', 'www.natore.gov.bd', NULL, NULL),
(17, 2, 'Joypurhat', 'জয়পুরহাট', NULL, NULL, 'www.joypurhat.gov.bd', NULL, NULL),
(18, 2, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ', '24.5965034', '88.2775122', 'www.chapainawabganj.gov.bd', NULL, NULL),
(19, 2, 'Naogaon', 'নওগাঁ', NULL, NULL, 'www.naogaon.gov.bd', NULL, NULL),
(20, 3, 'Jashore', 'যশোর', '23.16643', '89.2081126', 'www.jessore.gov.bd', NULL, NULL),
(21, 3, 'Satkhira', 'সাতক্ষীরা', NULL, NULL, 'www.satkhira.gov.bd', NULL, NULL),
(22, 3, 'Meherpur', 'মেহেরপুর', '23.762213', '88.631821', 'www.meherpur.gov.bd', NULL, NULL),
(23, 3, 'Narail', 'নড়াইল', '23.172534', '89.512672', 'www.narail.gov.bd', NULL, NULL),
(24, 3, 'Chuadanga', 'চুয়াডাঙ্গা', '23.6401961', '88.841841', 'www.chuadanga.gov.bd', NULL, NULL),
(25, 3, 'Kushtia', 'কুষ্টিয়া', '23.901258', '89.120482', 'www.kushtia.gov.bd', NULL, NULL),
(26, 3, 'Magura', 'মাগুরা', '23.487337', '89.419956', 'www.magura.gov.bd', NULL, NULL),
(27, 3, 'Khulna', 'খুলনা', '22.815774', '89.568679', 'www.khulna.gov.bd', NULL, NULL),
(28, 3, 'Bagerhat', 'বাগেরহাট', '22.651568', '89.785938', 'www.bagerhat.gov.bd', NULL, NULL),
(29, 3, 'Jhenaidah', 'ঝিনাইদহ', '23.5448176', '89.1539213', 'www.jhenaidah.gov.bd', NULL, NULL),
(30, 4, 'Jhalakathi', 'ঝালকাঠি', NULL, NULL, 'www.jhalakathi.gov.bd', NULL, NULL),
(31, 4, 'Patuakhali', 'পটুয়াখালী', '22.3596316', '90.3298712', 'www.patuakhali.gov.bd', NULL, NULL),
(32, 4, 'Pirojpur', 'পিরোজপুর', NULL, NULL, 'www.pirojpur.gov.bd', NULL, NULL),
(33, 4, 'Barisal', 'বরিশাল', NULL, NULL, 'www.barisal.gov.bd', NULL, NULL),
(34, 4, 'Bhola', 'ভোলা', '22.685923', '90.648179', 'www.bhola.gov.bd', NULL, NULL),
(35, 4, 'Barguna', 'বরগুনা', NULL, NULL, 'www.barguna.gov.bd', NULL, NULL),
(36, 5, 'Sylhet', 'সিলেট', '24.8897956', '91.8697894', 'www.sylhet.gov.bd', NULL, NULL),
(37, 5, 'Moulvibazar', 'মৌলভীবাজার', '24.482934', '91.777417', 'www.moulvibazar.gov.bd', NULL, NULL),
(38, 5, 'Habiganj', 'হবিগঞ্জ', '24.374945', '91.41553', 'www.habiganj.gov.bd', NULL, NULL),
(39, 5, 'Sunamganj', 'সুনামগঞ্জ', '25.0658042', '91.3950115', 'www.sunamganj.gov.bd', NULL, NULL),
(40, 6, 'Narsingdi', 'নরসিংদী', '23.932233', '90.71541', 'www.narsingdi.gov.bd', NULL, NULL),
(41, 6, 'Gazipur', 'গাজীপুর', '24.0022858', '90.4264283', 'www.gazipur.gov.bd', NULL, NULL),
(42, 6, 'Shariatpur', 'শরীয়তপুর', NULL, NULL, 'www.shariatpur.gov.bd', NULL, NULL),
(43, 6, 'Narayanganj', 'নারায়ণগঞ্জ', '23.63366', '90.496482', 'www.narayanganj.gov.bd', NULL, NULL),
(44, 6, 'Tangail', 'টাঙ্গাইল', NULL, NULL, 'www.tangail.gov.bd', NULL, NULL),
(45, 6, 'Kishoreganj', 'কিশোরগঞ্জ', '24.444937', '90.776575', 'www.kishoreganj.gov.bd', NULL, NULL),
(46, 6, 'Manikganj', 'মানিকগঞ্জ', NULL, NULL, 'www.manikganj.gov.bd', NULL, NULL),
(47, 6, 'Dhaka', 'ঢাকা', '23.7115253', '90.4111451', 'www.dhaka.gov.bd', NULL, NULL),
(48, 6, 'Munshiganj', 'মুন্সিগঞ্জ', NULL, NULL, 'www.munshiganj.gov.bd', NULL, NULL),
(49, 6, 'Rajbari', 'রাজবাড়ী', '23.7574305', '89.6444665', 'www.rajbari.gov.bd', NULL, NULL),
(50, 6, 'Madaripur', 'মাদারীপুর', '23.164102', '90.1896805', 'www.madaripur.gov.bd', NULL, NULL),
(51, 6, 'Gopalganj', 'গোপালগঞ্জ', '23.0050857', '89.8266059', 'www.gopalganj.gov.bd', NULL, NULL),
(52, 6, 'Faridpur', 'ফরিদপুর', '23.6070822', '89.8429406', 'www.faridpur.gov.bd', NULL, NULL),
(53, 7, 'Panchagarh', 'পঞ্চগড়', '26.3411', '88.5541606', 'www.panchagarh.gov.bd', NULL, NULL),
(54, 7, 'Dinajpur', 'দিনাজপুর', '25.6217061', '88.6354504', 'www.dinajpur.gov.bd', NULL, NULL),
(55, 7, 'Lalmonirhat', 'লালমনিরহাট', NULL, NULL, 'www.lalmonirhat.gov.bd', NULL, NULL),
(56, 7, 'Nilphamari', 'নীলফামারী', '25.931794', '88.856006', 'www.nilphamari.gov.bd', NULL, NULL),
(57, 7, 'Gaibandha', 'গাইবান্ধা', '25.328751', '89.528088', 'www.gaibandha.gov.bd', NULL, NULL),
(58, 7, 'Thakurgaon', 'ঠাকুরগাঁও', '26.0336945', '88.4616834', 'www.thakurgaon.gov.bd', NULL, NULL),
(59, 7, 'Rangpur', 'রংপুর', '25.7558096', '89.244462', 'www.rangpur.gov.bd', NULL, NULL),
(60, 7, 'Kurigram', 'কুড়িগ্রাম', '25.805445', '89.636174', 'www.kurigram.gov.bd', NULL, NULL),
(61, 8, 'Sherpur', 'শেরপুর', '25.0204933', '90.0152966', 'www.sherpur.gov.bd', NULL, NULL),
(62, 8, 'Mymensingh', 'ময়মনসিংহ', NULL, NULL, 'www.mymensingh.gov.bd', NULL, NULL),
(63, 8, 'Jamalpur', 'জামালপুর', '24.937533', '89.937775', 'www.jamalpur.gov.bd', NULL, NULL),
(64, 8, 'Netrokona', 'নেত্রকোণা', '24.870955', '90.727887', 'www.netrokona.gov.bd', NULL, NULL),
(65, 6, 'Dhaka Metro', 'ঢাকা মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', NULL, NULL),
(66, 1, 'Chittagang Metro', 'চট্রগ্রাম মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', NULL, NULL),
(67, 2, 'Rajshahi Metro', 'রাজশাহী মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', NULL, NULL),
(68, 3, 'Khulna Metro', 'খুলনা মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', NULL, NULL),
(69, 4, 'Barishal Metro', 'বরিশাল মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', NULL, NULL),
(70, 5, 'Sylhet Metro', 'সিলেট মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', NULL, NULL),
(71, 7, 'Rangpur Metro', 'রংপুর মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', NULL, NULL),
(72, 6, 'Gazipur Metro', 'গাজীপুর মেট্রো', '23.4682747', '91.1788135', 'www.aa.gov.bd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`, `url`, `created_at`, `updated_at`) VALUES
(1, 'Chattagram', 'চট্টগ্রাম', 'www.chittagongdiv.gov.bd', NULL, NULL),
(2, 'Rajshahi', 'রাজশাহী', 'www.rajshahidiv.gov.bd', NULL, NULL),
(3, 'Khulna', 'খুলনা', 'www.khulnadiv.gov.bd', NULL, NULL),
(4, 'Barisal', 'বরিশাল', 'www.barisaldiv.gov.bd', NULL, NULL),
(5, 'Sylhet', 'সিলেট', 'www.sylhetdiv.gov.bd', NULL, NULL),
(6, 'Dhaka', 'ঢাকা', 'www.dhakadiv.gov.bd', NULL, NULL),
(7, 'Rangpur', 'রংপুর', 'www.rangpurdiv.gov.bd', NULL, NULL),
(8, 'Mymensingh', 'ময়মনসিংহ', 'www.mymensinghdiv.gov.bd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `expense_head_id` bigint UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `note` text,
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_head_id`, `amount`, `note`, `hub_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 5, '300.00', NULL, NULL, 1, NULL, NULL, '2022-10-14 22:07:19', '2022-10-14 22:07:19');

-- --------------------------------------------------------

--
-- Table structure for table `expense_heads`
--

CREATE TABLE `expense_heads` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `note` text,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `expense_heads`
--

INSERT INTO `expense_heads` (`id`, `title`, `note`, `status`, `hub_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Entertaintment', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Printinig & Stationary', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Convence', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Fuel', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Computer', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Funiture', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'House Rent', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Hardware & Cookwarise', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Miscellaneous', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Electric', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Salary', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Mobile Bill', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Dhaka Trade', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Mobile Parcel', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Tips', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Bicycle', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Courier', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Internet Bill', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Overtime', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'House Rent', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Sports', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Accessories', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint UNSIGNED NOT NULL,
  `file_id` bigint UNSIGNED NOT NULL,
  `file_type` varchar(191) NOT NULL,
  `file_name` varchar(191) NOT NULL,
  `file_path` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `hubs`
--

CREATE TABLE `hubs` (
  `id` bigint UNSIGNED NOT NULL,
  `area_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `hub_code` varchar(191) NOT NULL,
  `hub_type` enum('central','general') NOT NULL DEFAULT 'general',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `hubs`
--

INSERT INTO `hubs` (`id`, `area_id`, `name`, `hub_code`, `hub_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Central Hub', '1216', 'central', 'active', NULL, '2022-10-15 23:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `note` longtext,
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `invoice_type` varchar(191) NOT NULL,
  `prepare_for_id` bigint UNSIGNED NOT NULL,
  `prepare_for_type` varchar(191) NOT NULL,
  `invoice_number` varchar(20) NOT NULL,
  `total_collection_amount` double(15,2) NOT NULL,
  `total_cod` double(8,2) DEFAULT NULL,
  `total_delivery_charge` double(15,2) NOT NULL,
  `date` datetime DEFAULT NULL,
  `note` text,
  `status` enum('pending','accepted') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(191) NOT NULL DEFAULT 'cash',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `hub_id`, `invoice_id`, `invoice_type`, `prepare_for_id`, `prepare_for_type`, `invoice_number`, `total_collection_amount`, `total_cod`, `total_delivery_charge`, `date`, `note`, `status`, `payment_method`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'App\\Models\\Admin\\Rider', 4, 'App\\Models\\Admin', 'INV_202207001', 500.00, 0.00, 20.00, '2022-07-23 17:42:35', NULL, 'accepted', 'cash', NULL, '2022-07-23 11:42:35', '2022-07-23 11:42:35'),
(2, NULL, 4, 'App\\Models\\Admin', 3, 'App\\Models\\Admin', 'INV_202207002', 500.00, 0.00, 20.00, '2022-07-23 17:48:43', NULL, 'accepted', 'cash', NULL, '2022-07-23 11:48:43', '2022-07-23 11:48:43'),
(3, NULL, 3, 'App\\Models\\Admin', 1, 'App\\Models\\Merchant', 'INV_202207003', 500.00, 0.00, 20.00, '2022-07-23 00:00:00', NULL, 'accepted', 'cash', NULL, '2022-07-23 11:50:03', '2022-10-11 03:04:29'),
(4, NULL, 1, 'App\\Models\\Admin\\Rider', 4, 'App\\Models\\Admin', 'INV_202210001', 12500.00, 0.00, 40.00, '2022-10-15 18:44:16', NULL, 'accepted', 'cash', NULL, '2022-10-15 23:44:16', '2022-10-15 23:44:16'),
(5, NULL, 3, 'App\\Models\\Admin\\Rider', 4, 'App\\Models\\Admin', 'INV_202210002', 15000.00, 0.00, 20.00, '2022-10-15 18:44:18', NULL, 'accepted', 'cash', NULL, '2022-10-15 23:44:18', '2022-10-15 23:44:18'),
(6, NULL, 4, 'App\\Models\\Admin\\Rider', 4, 'App\\Models\\Admin', 'INV_202210003', 500.00, 0.00, 20.00, '2022-10-15 18:44:21', NULL, 'accepted', 'cash', NULL, '2022-10-15 23:44:21', '2022-10-15 23:44:21'),
(7, NULL, 2, 'App\\Models\\Admin\\Rider', 4, 'App\\Models\\Admin', 'INV_202210004', 50.00, 0.00, 20.00, '2022-10-15 18:44:25', NULL, 'accepted', 'cash', NULL, '2022-10-15 23:44:25', '2022-10-15 23:44:25'),
(8, NULL, 4, 'App\\Models\\Admin', 3, 'App\\Models\\Admin', 'INV_202210005', 28050.00, 0.00, 100.00, '2022-10-15 19:04:54', NULL, 'accepted', 'cash', NULL, '2022-10-16 00:04:54', '2022-10-16 00:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint UNSIGNED NOT NULL,
  `parcel_id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `collection_amount` decimal(8,2) NOT NULL,
  `delivery_charge` decimal(8,2) NOT NULL,
  `cod_charge` decimal(8,2) NOT NULL,
  `net_payable` decimal(8,2) NOT NULL,
  `note` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `parcel_id`, `invoice_id`, `collection_amount`, `delivery_charge`, `cod_charge`, `net_payable`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '500.00', '20.00', '0.00', '480.00', NULL, '2022-07-23 11:42:35', '2022-07-23 11:42:35'),
(2, 1, 2, '500.00', '20.00', '0.00', '480.00', NULL, '2022-07-23 11:48:43', '2022-07-23 11:48:43'),
(3, 1, 3, '500.00', '20.00', '0.00', '480.00', NULL, '2022-07-23 11:50:03', '2022-07-23 11:50:03'),
(4, 3, 4, '12000.00', '20.00', '0.00', '11980.00', NULL, '2022-10-15 23:44:16', '2022-10-15 23:44:16'),
(5, 2, 4, '500.00', '20.00', '0.00', '480.00', NULL, '2022-10-15 23:44:16', '2022-10-15 23:44:16'),
(6, 8, 5, '15000.00', '20.00', '0.00', '14980.00', NULL, '2022-10-15 23:44:18', '2022-10-15 23:44:18'),
(7, 5, 6, '500.00', '20.00', '0.00', '480.00', NULL, '2022-10-15 23:44:21', '2022-10-15 23:44:21'),
(8, 4, 7, '50.00', '20.00', '0.00', '30.00', NULL, '2022-10-15 23:44:25', '2022-10-15 23:44:25'),
(9, 4, 8, '50.00', '20.00', '0.00', '30.00', NULL, '2022-10-16 00:04:54', '2022-10-16 00:04:54'),
(10, 5, 8, '500.00', '20.00', '0.00', '480.00', NULL, '2022-10-16 00:04:54', '2022-10-16 00:04:54'),
(11, 8, 8, '15000.00', '20.00', '0.00', '14980.00', NULL, '2022-10-16 00:04:54', '2022-10-16 00:04:54'),
(12, 3, 8, '12000.00', '20.00', '0.00', '11980.00', NULL, '2022-10-16 00:04:54', '2022-10-16 00:04:54'),
(13, 2, 8, '500.00', '20.00', '0.00', '480.00', NULL, '2022-10-16 00:04:54', '2022-10-16 00:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `current_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `note` longtext,
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `title`, `amount`, `current_amount`, `note`, `hub_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Test', '5000.00', '5000.00', 'test', NULL, 1, NULL, NULL, '2022-10-15 23:12:58', '2022-10-15 23:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `loan_adjustments`
--

CREATE TABLE `loan_adjustments` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_id` bigint UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `note` longtext,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `loan_adjustments`
--

INSERT INTO `loan_adjustments` (`id`, `loan_id`, `amount`, `note`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, NULL, '5000.00', 'test', 1, NULL, '2022-10-15 23:12:12', '2022-10-15 23:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` bigint UNSIGNED NOT NULL,
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `company_name` varchar(191) NOT NULL,
  `area_id` bigint UNSIGNED DEFAULT NULL,
  `mobile` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `website_url` varchar(191) DEFAULT NULL,
  `prefix` varchar(191) DEFAULT NULL,
  `facebook_page` varchar(191) DEFAULT NULL,
  `address` longtext,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `status` enum('pending','active','inactive') NOT NULL DEFAULT 'pending',
  `isActive` enum('1','0') NOT NULL DEFAULT '0',
  `isSend` enum('1','0') NOT NULL DEFAULT '0',
  `isReturnCharge` enum('apply','not_apply') NOT NULL DEFAULT 'not_apply',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `hub_id`, `name`, `company_name`, `area_id`, `mobile`, `email`, `website_url`, `prefix`, `facebook_page`, `address`, `email_verified_at`, `password`, `status`, `isActive`, `isSend`, `isReturnCharge`, `created_by`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test', 'test', 1, '01717528335', 'test@gmail.com', NULL, '1234', NULL, NULL, NULL, '$2y$10$1fy42MSUdNtdBeHuQksT5uEkFIZRdBwMZDKDint2UxfpTiUd4bTmO', 'active', '1', '0', 'not_apply', 1, NULL, NULL, '2022-07-23 11:32:39', '2022-07-23 11:32:39'),
(2, NULL, 'Md Hasib', 'Test Company', 2, '01810000000', 'hasib@gmail.com', NULL, 'HAS', NULL, NULL, NULL, '$2y$10$pc64BzLDq1oBjJVshfZ7VuETkeDgtUsQw6oVGLFSoKc5/PRg5a5hu', 'active', '1', '', 'not_apply', NULL, NULL, NULL, '2022-10-11 22:13:58', '2022-10-12 00:07:00'),
(3, NULL, 'Tanvir Parvej', 'Test', 1, '01959261524', 'tanvir@gmail.com', NULL, 'TAN', NULL, NULL, NULL, '$2y$10$mnLIS3PrRVX9V9LnnKORIew2Igz4a.ZlUe9KRJ3wnuPr9ThY2HrEm', 'active', '1', '', 'not_apply', NULL, '8htpOuXtxFGQxDof151IguI9gWuWjiYQLdzYJvn9pAeDskYviUGQzv2gq8Cm', NULL, '2022-10-11 22:15:56', '2022-10-16 00:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_bank_accounts`
--

CREATE TABLE `merchant_bank_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `merchant_id` bigint UNSIGNED NOT NULL,
  `bank_id` bigint UNSIGNED DEFAULT NULL,
  `branch_name` varchar(191) DEFAULT NULL,
  `routing_number` varchar(191) DEFAULT NULL,
  `account_name` varchar(191) DEFAULT NULL,
  `account_number` varchar(191) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `merchant_mobile_bankings`
--

CREATE TABLE `merchant_mobile_bankings` (
  `id` bigint UNSIGNED NOT NULL,
  `merchant_id` bigint UNSIGNED NOT NULL,
  `mobile_banking_id` bigint UNSIGNED NOT NULL,
  `mobile_number` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `merchant_payment_methods`
--

CREATE TABLE `merchant_payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `merchant_id` bigint UNSIGNED NOT NULL,
  `payment_method_id` bigint UNSIGNED DEFAULT NULL,
  `withdraw_type` enum('daily','as_per_request') NOT NULL DEFAULT 'as_per_request',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `merchant_payment_methods`
--

INSERT INTO `merchant_payment_methods` (`id`, `merchant_id`, `payment_method_id`, `withdraw_type`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'as_per_request', 'active', NULL, '2022-07-23 11:32:39', '2022-07-23 11:32:39'),
(2, 2, NULL, 'as_per_request', 'active', NULL, '2022-10-11 22:13:58', '2022-10-11 22:13:58'),
(3, 3, NULL, 'as_per_request', 'active', NULL, '2022-10-11 22:15:56', '2022-10-11 22:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_pickup_methods`
--

CREATE TABLE `merchant_pickup_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `hub_id` bigint UNSIGNED NOT NULL,
  `merchant_id` bigint UNSIGNED NOT NULL,
  `pickup_type` enum('daily','as_per_request') NOT NULL DEFAULT 'as_per_request',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2020_02_03_171256_create_divisions_table', 1),
(11, '2020_02_03_171257_create_districts_table', 1),
(12, '2020_02_03_171258_create_upazilas_table', 1),
(13, '2020_02_03_171266_create_city_types_table', 1),
(14, '2020_02_03_182256_create_areas_table', 1),
(15, '2020_02_03_182356_create_sub_areas_table', 1),
(16, '2020_02_03_182446_create_hubs_table', 1),
(17, '2020_02_03_182456_create_admins_table', 1),
(18, '2021_09_02_201521_create_permission_tables', 1),
(19, '2021_09_03_180249_create_merchants_table', 1),
(20, '2021_09_06_100421_create_weight_ranges_table', 1),
(21, '2021_09_06_112225_create_parcel_types_table', 1),
(22, '2021_09_07_045510_create_delivery_charges_table', 1),
(23, '2021_09_08_053015_create_riders_table', 1),
(24, '2021_09_08_053016_create_parcels_table', 1),
(25, '2021_09_08_053017_create_pickup_requests_table', 1),
(26, '2021_09_13_065417_create_payment_methods_table', 1),
(27, '2021_09_14_065306_create_merchant_pickup_methods_table', 1),
(28, '2021_09_15_054150_create_banks_table', 1),
(29, '2021_09_15_060622_create_merchant_bank_accounts_table', 1),
(30, '2021_09_15_074809_create_merchant_payment_methods_table', 1),
(31, '2021_09_15_092429_create_mobile_bankings_table', 1),
(32, '2021_09_16_063927_create_payment_requests_table', 1),
(33, '2021_09_16_075740_create_reason_types_table', 1),
(34, '2021_09_16_075751_create_reasons_table', 1),
(35, '2021_09_20_114908_create_expense_heads_table', 1),
(36, '2021_09_20_114910_create_expenses_table', 1),
(37, '2021_09_23_112036_create_rider_transactions_table', 1),
(38, '2021_09_24_040604_create_accounts_table', 1),
(39, '2021_09_24_041230_create_invoices_table', 1),
(40, '2021_09_24_041353_create_invoice_items_table', 1),
(41, '2021_09_24_045719_create_rider_collections_table', 1),
(42, '2021_09_26_100354_create_collections_table', 1),
(43, '2021_10_03_050416_create_assign_areas_table', 1),
(44, '2021_10_19_121326_add_guard_name_added_by_admin_added_by_merchant_to_parcels_table', 1),
(45, '2021_10_24_164649_create_merchant_mobile_bankings_table', 1),
(46, '2021_10_26_134849_create_mobile_banking_collections_table', 1),
(47, '2021_10_31_102208_create_parcel_times_table', 1),
(48, '2021_11_02_144636_add_rider_transfer_request_for_incharge_tranfer_request_for_to_collections', 1),
(49, '2021_11_10_095134_create_files_table', 1),
(50, '2021_11_15_094637_create_parcel_transfers_table', 1),
(51, '2021_12_07_114233_create_advances_table', 1),
(52, '2021_12_19_150731_create_parcel_notes_table', 1),
(53, '2022_01_06_182137_create_loans_table', 1),
(54, '2022_01_10_175509_create_investments_table', 1),
(55, '2022_01_23_174626_create_bad_debts_table', 1),
(56, '2022_01_24_105514_create_loan_adjustments_table', 1),
(57, '2022_01_26_102403_create_bad_debt_adjusts_table', 1),
(58, '2022_01_27_151703_create_status_meanings_table', 1),
(59, '2022_03_02_135819_create_cancle_invoices_table', 1),
(60, '2022_03_02_155102_create_cancle_invoice_items_table', 1),
(61, '2022_05_15_173008_create_print_parcels_table', 1),
(62, '2022_05_15_173347_create_print_parcel_items_table', 1),
(63, '2022_06_06_155013_create_sms_settings_table', 1),
(64, '2022_06_07_183246_create_parcel_reassigns_table', 1),
(65, '2022_06_09_120700_create_otps_table', 1),
(66, '2022_06_17_181205_create_sms_configures_table', 1),
(67, '2022_07_02_104130_create_complaints_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_bankings`
--

CREATE TABLE `mobile_bankings` (
  `id` bigint UNSIGNED NOT NULL,
  `payment_method_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `mobile_bankings`
--

INSERT INTO `mobile_bankings` (`id`, `payment_method_id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Bkash', 'active', NULL, NULL, NULL),
(2, 2, 'Rocket', 'active', NULL, NULL, NULL),
(3, 2, 'MCash', 'active', NULL, NULL, NULL),
(4, 2, 'SureCash', 'active', NULL, NULL, NULL),
(5, 2, 'Ucash', 'active', NULL, NULL, NULL),
(6, 2, 'Nagad-নগদ', 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_banking_collections`
--

CREATE TABLE `mobile_banking_collections` (
  `id` bigint UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `parcel_id` bigint UNSIGNED NOT NULL,
  `mobile_banking_id` bigint UNSIGNED DEFAULT NULL,
  `merchant_mobile_banking_id` bigint UNSIGNED DEFAULT NULL,
  `customer_mobile_number` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(2, 'App\\Models\\Admin', 2),
(3, 'App\\Models\\Admin', 3),
(4, 'App\\Models\\Admin', 4),
(5, 'App\\Models\\Admin', 5);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(191) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint UNSIGNED NOT NULL,
  `parcel_id` bigint UNSIGNED NOT NULL,
  `otp` int DEFAULT NULL,
  `type` enum('cancelled','delivered') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` bigint UNSIGNED NOT NULL,
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `city_type_id` bigint UNSIGNED DEFAULT NULL,
  `area_id` bigint UNSIGNED DEFAULT NULL,
  `sub_area_id` bigint UNSIGNED DEFAULT NULL,
  `merchant_id` bigint UNSIGNED DEFAULT NULL,
  `weight_range_id` bigint UNSIGNED DEFAULT NULL,
  `parcel_type_id` bigint UNSIGNED DEFAULT NULL,
  `tracking_id` varchar(191) DEFAULT NULL,
  `invoice_id` varchar(191) DEFAULT NULL,
  `payment_status` enum('paid','unpaid','partial') NOT NULL DEFAULT 'unpaid',
  `payment_type` enum('not_payment_yet','cash_on_delivery','mobile_banking') NOT NULL DEFAULT 'not_payment_yet',
  `note` text,
  `assigned_by` bigint UNSIGNED DEFAULT NULL,
  `assigning_by` bigint UNSIGNED DEFAULT NULL,
  `customer_name` varchar(191) DEFAULT NULL,
  `customer_address` text,
  `customer_mobile` varchar(191) DEFAULT NULL,
  `customer_another_mobile` varchar(191) DEFAULT NULL,
  `collection_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `delivery_charge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cod_percentage` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cod` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payable` decimal(10,2) NOT NULL DEFAULT '0.00',
  `return_product` int UNSIGNED NOT NULL DEFAULT '0',
  `is_transfer` enum('yes','no') NOT NULL DEFAULT 'no',
  `status` enum('wait_for_pickup','received_at_office','processing','pending','transit','transfer','delivered','partial','partial_accept_by_incharge','partial_accept_by_merchant','hold','hold_accept_by_incharge','exchange','exchange_accept_by_incharge','exchange_accept_by_merchant','cancelled','cancel_accept_by_incharge','cancel_accept_by_merchant') NOT NULL DEFAULT 'pending',
  `delivery_status` enum('processing','delivered','partial','partial_accept_by_incharge','partial_accept_by_merchant','hold','hold_accept_by_incharge','exchange','exchange_accept_by_incharge','exchange_accept_by_merchant','cancelled','cancel_accept_by_incharge','cancel_accept_by_merchant') NOT NULL DEFAULT 'processing',
  `transit_count` int NOT NULL DEFAULT '0',
  `added_date` date NOT NULL,
  `cancle_partial_invoice` enum('no','yes') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `guard_name` enum('admin','merchant') NOT NULL DEFAULT 'admin',
  `added_by_admin` bigint UNSIGNED DEFAULT NULL,
  `added_by_merchant` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `hub_id`, `city_type_id`, `area_id`, `sub_area_id`, `merchant_id`, `weight_range_id`, `parcel_type_id`, `tracking_id`, `invoice_id`, `payment_status`, `payment_type`, `note`, `assigned_by`, `assigning_by`, `customer_name`, `customer_address`, `customer_mobile`, `customer_another_mobile`, `collection_amount`, `delivery_charge`, `cod_percentage`, `cod`, `payable`, `return_product`, `is_transfer`, `status`, `delivery_status`, `transit_count`, `added_date`, `cancle_partial_invoice`, `created_at`, `updated_at`, `deleted_at`, `guard_name`, `added_by_admin`, `added_by_merchant`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, '07588872', '1234-423', 'paid', 'cash_on_delivery', NULL, NULL, 1, 'f', 'asdf', '01725848515', NULL, '500.00', '20.00', '0.00', '0.00', '480.00', 0, 'no', 'delivered', 'delivered', 1, '2022-07-23', NULL, '2022-07-23 11:35:34', '2022-07-23 11:38:43', NULL, 'admin', 1, NULL),
(2, 1, 1, 1, 1, 1, 1, 1, '07401019', '1234-324', 'paid', 'cash_on_delivery', 'f', NULL, 1, 'sdf', 'fd', '01725848515', NULL, '500.00', '20.00', '0.00', '0.00', '480.00', 0, 'no', 'delivered', 'delivered', 1, '2022-07-24', NULL, '2022-07-24 06:17:30', '2022-10-14 23:52:03', NULL, 'admin', 1, NULL),
(3, 1, 1, 1, 1, 1, 1, 1, '10882733', '1234-234', 'paid', 'cash_on_delivery', NULL, NULL, 1, 'Rjamil', 'Banasree', '01717552288', NULL, '12000.00', '20.00', '0.00', '0.00', '11980.00', 0, 'no', 'delivered', 'delivered', 1, '2022-10-11', NULL, '2022-10-11 03:01:56', '2022-10-14 23:51:52', NULL, 'merchant', NULL, 1),
(4, 1, 1, 2, 2, 3, 1, 1, '10253459', 'PS-123123', 'paid', 'cash_on_delivery', 'test', NULL, 2, 'Hasib', 'Banasree', '01940197130', NULL, '50.00', '20.00', '0.00', '0.00', '30.00', 0, 'no', 'delivered', 'delivered', 1, '2022-10-11', NULL, '2022-10-11 22:49:37', '2022-10-11 22:53:49', NULL, 'merchant', NULL, 3),
(5, 1, 1, 2, 5, 3, 1, 1, '10314569', 'TAN-2115641', 'paid', 'cash_on_delivery', '*****', NULL, 4, 'testName', 'testAddress', '01945687685', NULL, '500.00', '20.00', '0.00', '0.00', '480.00', 0, 'no', 'delivered', 'delivered', 1, '2022-10-12', NULL, '2022-10-12 00:01:49', '2022-10-14 22:02:35', NULL, 'merchant', NULL, 3),
(8, 1, 1, 2, 3, 3, 1, 3, '10546738', 'TAN-423.42334', 'paid', 'cash_on_delivery', NULL, NULL, 3, 'Hasib', 'Goran', '01940197130', NULL, '15000.00', '20.00', '0.00', '0.00', '14980.00', 0, 'no', 'delivered', 'delivered', 1, '2022-10-14', NULL, '2022-10-14 21:58:19', '2022-10-14 22:06:11', NULL, 'merchant', NULL, 3),
(9, 1, 1, 2, 2, 1, 1, 1, '10727436', '1234-10', 'paid', 'cash_on_delivery', 'sdfg', NULL, 2, 'Test', 'sdfg', '01725848515', NULL, '500.00', '20.00', '0.00', '0.00', '480.00', 0, 'no', 'delivered', 'delivered', 1, '2022-10-22', NULL, '2022-10-22 08:34:38', '2022-10-22 08:46:41', NULL, 'merchant', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `parcel_notes`
--

CREATE TABLE `parcel_notes` (
  `id` bigint UNSIGNED NOT NULL,
  `guard_name` enum('admin','merchant','rider') NOT NULL DEFAULT 'admin',
  `parcel_id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED DEFAULT NULL,
  `merchant_id` bigint UNSIGNED DEFAULT NULL,
  `rider_id` bigint UNSIGNED DEFAULT NULL,
  `note` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `parcel_notes`
--

INSERT INTO `parcel_notes` (`id`, `guard_name`, `parcel_id`, `admin_id`, `merchant_id`, `rider_id`, `note`, `created_at`, `updated_at`) VALUES
(1, 'admin', 2, 1, NULL, NULL, 'f', '2022-07-24 06:17:30', '2022-07-24 06:17:30'),
(2, 'merchant', 4, NULL, 3, NULL, 'test', '2022-10-11 22:49:37', '2022-10-11 22:49:37'),
(3, 'merchant', 5, NULL, 3, NULL, '*****', '2022-10-12 00:01:49', '2022-10-12 00:01:49'),
(4, 'merchant', 9, NULL, 1, NULL, 'sdfg', '2022-10-22 08:34:38', '2022-10-22 08:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_reassigns`
--

CREATE TABLE `parcel_reassigns` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `parcel_times`
--

CREATE TABLE `parcel_times` (
  `id` bigint UNSIGNED NOT NULL,
  `parcel_id` bigint UNSIGNED NOT NULL,
  `time_type` enum('wait_for_pickup','received_at_office','pending','delivered','partial','partial_accept_by_incharge','partial_accept_by_merchant','hold','transit','undo','return','cancelled','hold_accept_by_incharge','hold_parcel_transfer_to_rider','cancel_accept_by_incharge','cancel_accept_by_merchant','transfer_create','transfer_accept','transfer_decline','exchange','exchange_accept_by_incharge','exchange_accept_by_merchant') NOT NULL DEFAULT 'pending',
  `time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `parcel_times`
--

INSERT INTO `parcel_times` (`id`, `parcel_id`, `time_type`, `time`, `created_at`, `updated_at`) VALUES
(1, 1, 'transit', '2022-07-23 17:37:08', '2022-07-23 11:37:08', '2022-07-23 11:37:08'),
(2, 1, 'delivered', '2022-07-23 17:38:43', '2022-07-23 11:38:43', '2022-07-23 11:38:43'),
(3, 4, 'transit', '2022-10-11 17:53:13', '2022-10-11 22:53:13', '2022-10-11 22:53:13'),
(4, 4, 'delivered', '2022-10-11 17:53:49', '2022-10-11 22:53:49', '2022-10-11 22:53:49'),
(5, 5, 'transit', '2022-10-14 17:01:30', '2022-10-14 22:01:30', '2022-10-14 22:01:30'),
(6, 5, 'delivered', '2022-10-14 17:02:35', '2022-10-14 22:02:35', '2022-10-14 22:02:35'),
(7, 8, 'transit', '2022-10-14 17:05:39', '2022-10-14 22:05:39', '2022-10-14 22:05:39'),
(8, 8, 'delivered', '2022-10-14 17:06:11', '2022-10-14 22:06:11', '2022-10-14 22:06:11'),
(9, 3, 'transit', '2022-10-14 18:51:12', '2022-10-14 23:51:12', '2022-10-14 23:51:12'),
(10, 2, 'transit', '2022-10-14 18:51:15', '2022-10-14 23:51:15', '2022-10-14 23:51:15'),
(11, 3, 'delivered', '2022-10-14 18:51:52', '2022-10-14 23:51:52', '2022-10-14 23:51:52'),
(12, 2, 'delivered', '2022-10-14 18:52:03', '2022-10-14 23:52:03', '2022-10-14 23:52:03'),
(13, 9, 'transit', '2022-10-22 14:43:13', '2022-10-22 08:43:13', '2022-10-22 08:43:13'),
(14, 9, 'delivered', '2022-10-22 14:46:41', '2022-10-22 08:46:41', '2022-10-22 08:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_transfers`
--

CREATE TABLE `parcel_transfers` (
  `id` bigint UNSIGNED NOT NULL,
  `parcel_id` bigint UNSIGNED NOT NULL,
  `transfer_by` bigint UNSIGNED NOT NULL,
  `transfer_for` bigint UNSIGNED NOT NULL,
  `transfer_sub_area` bigint UNSIGNED DEFAULT NULL,
  `status` enum('pending','accept','reject') NOT NULL DEFAULT 'pending',
  `accept_or_reject_by` bigint UNSIGNED DEFAULT NULL,
  `accept_time` datetime DEFAULT NULL,
  `reject_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `parcel_types`
--

CREATE TABLE `parcel_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `parcel_types`
--

INSERT INTO `parcel_types` (`id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cloths', 'active', NULL, NULL, NULL),
(2, 'Electronics', 'active', NULL, NULL, NULL),
(3, 'Cosmetics ', 'active', NULL, NULL, NULL),
(4, 'Paper', 'active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bank', 'active', NULL, NULL),
(2, 'Mobile Banking', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_requests`
--

CREATE TABLE `payment_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `merchant_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','processing','cancelled','completed') NOT NULL DEFAULT 'pending',
  `completed_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `group_name` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'admin', 'dashboard', NULL, NULL),
(2, 'admin-list', 'admin', 'admin', NULL, NULL),
(3, 'admin-create', 'admin', 'admin', NULL, NULL),
(4, 'admin-show', 'admin', 'admin', NULL, NULL),
(5, 'admin-edit', 'admin', 'admin', NULL, NULL),
(6, 'admin-delete', 'admin', 'admin', NULL, NULL),
(7, 'role-list', 'admin', 'role', NULL, NULL),
(8, 'role-create', 'admin', 'role', NULL, NULL),
(9, 'role-show', 'admin', 'role', NULL, NULL),
(10, 'role-edit', 'admin', 'role', NULL, NULL),
(11, 'role-delete', 'admin', 'role', NULL, NULL),
(12, 'permission-list', 'admin', 'permission', NULL, NULL),
(13, 'permission-create', 'admin', 'permission', NULL, NULL),
(14, 'permission-show', 'admin', 'permission', NULL, NULL),
(15, 'permission-edit', 'admin', 'permission', NULL, NULL),
(16, 'permission-delete', 'admin', 'permission', NULL, NULL),
(17, 'hub-list', 'admin', 'hub', NULL, NULL),
(18, 'hub-create', 'admin', 'hub', NULL, NULL),
(19, 'hub-show', 'admin', 'hub', NULL, NULL),
(20, 'hub-edit', 'admin', 'hub', NULL, NULL),
(21, 'hub-delete', 'admin', 'hub', NULL, NULL),
(22, 'division-list', 'admin', 'division', NULL, NULL),
(23, 'division-create', 'admin', 'division', NULL, NULL),
(24, 'division-show', 'admin', 'division', NULL, NULL),
(25, 'division-edit', 'admin', 'division', NULL, NULL),
(26, 'division-delete', 'admin', 'division', NULL, NULL),
(27, 'district-list', 'admin', 'district', NULL, NULL),
(28, 'district-create', 'admin', 'district', NULL, NULL),
(29, 'district-show', 'admin', 'district', NULL, NULL),
(30, 'district-edit', 'admin', 'district', NULL, NULL),
(31, 'district-delete', 'admin', 'district', NULL, NULL),
(32, 'upazila-list', 'admin', 'upazila', NULL, NULL),
(33, 'upazila-create', 'admin', 'upazila', NULL, NULL),
(34, 'upazila-show', 'admin', 'upazila', NULL, NULL),
(35, 'upazila-edit', 'admin', 'upazila', NULL, NULL),
(36, 'upazila-delete', 'admin', 'upazila', NULL, NULL),
(37, 'area-list', 'admin', 'area', NULL, NULL),
(38, 'area-create', 'admin', 'area', NULL, NULL),
(39, 'area-show', 'admin', 'area', NULL, NULL),
(40, 'area-edit', 'admin', 'area', NULL, NULL),
(41, 'area-delete', 'admin', 'area', NULL, NULL),
(42, 'rider-list', 'admin', 'rider', NULL, NULL),
(43, 'rider-create', 'admin', 'rider', NULL, NULL),
(44, 'rider-show', 'admin', 'rider', NULL, NULL),
(45, 'rider-edit', 'admin', 'rider', NULL, NULL),
(46, 'rider-delete', 'admin', 'rider', NULL, NULL),
(47, 'weight-range-list', 'admin', 'weight-range', NULL, NULL),
(48, 'weight-range-create', 'admin', 'weight-range', NULL, NULL),
(49, 'weight-range-show', 'admin', 'weight-range', NULL, NULL),
(50, 'weight-range-edit', 'admin', 'weight-range', NULL, NULL),
(51, 'weight-range-delete', 'admin', 'weight-range', NULL, NULL),
(52, 'merchant-list', 'admin', 'merchant', NULL, NULL),
(53, 'merchant-create', 'admin', 'merchant', NULL, NULL),
(54, 'merchant-show', 'admin', 'merchant', NULL, NULL),
(55, 'merchant-edit', 'admin', 'merchant', NULL, NULL),
(56, 'merchant-delete', 'admin', 'merchant', NULL, NULL),
(57, 'delivery-charge-list', 'admin', 'delivery-charge', NULL, NULL),
(58, 'delivery-charge-create', 'admin', 'delivery-charge', NULL, NULL),
(59, 'delivery-charge-show', 'admin', 'delivery-charge', NULL, NULL),
(60, 'delivery-charge-edit', 'admin', 'delivery-charge', NULL, NULL),
(61, 'delivery-charge-delete', 'admin', 'delivery-charge', NULL, NULL),
(62, 'parcel-type-list', 'admin', 'parcel-type', NULL, NULL),
(63, 'parcel-type-create', 'admin', 'parcel-type', NULL, NULL),
(64, 'parcel-type-show', 'admin', 'parcel-type', NULL, NULL),
(65, 'parcel-type-edit', 'admin', 'parcel-type', NULL, NULL),
(66, 'parcel-type-delete', 'admin', 'parcel-type', NULL, NULL),
(67, 'pickup-request-list', 'admin', 'pickup-request', NULL, NULL),
(68, 'pickup-request-create', 'admin', 'pickup-request', NULL, NULL),
(69, 'pickup-request-show', 'admin', 'pickup-request', NULL, NULL),
(70, 'pickup-request-edit', 'admin', 'pickup-request', NULL, NULL),
(71, 'pickup-request-delete', 'admin', 'pickup-request', NULL, NULL),
(72, 'parcel-list', 'admin', 'parcel', NULL, NULL),
(73, 'parcel-create', 'admin', 'parcel', NULL, NULL),
(74, 'parcel-show', 'admin', 'parcel', NULL, NULL),
(75, 'parcel-edit', 'admin', 'parcel', NULL, NULL),
(76, 'parcel-delete', 'admin', 'parcel', NULL, NULL),
(77, 'expense-list', 'admin', 'expense', NULL, NULL),
(78, 'expense-create', 'admin', 'expense', NULL, NULL),
(79, 'expense-show', 'admin', 'expense', NULL, NULL),
(80, 'expense-edit', 'admin', 'expense', NULL, NULL),
(81, 'expense-delete', 'admin', 'expense', NULL, NULL),
(82, 'invoice-list', 'admin', 'invoice', NULL, NULL),
(83, 'invoice-create', 'admin', 'invoice', NULL, NULL),
(84, 'invoice-show', 'admin', 'invoice', NULL, NULL),
(85, 'invoice-edit', 'admin', 'invoice', NULL, NULL),
(86, 'invoice-delete', 'admin', 'invoice', NULL, NULL),
(87, 'env-dynamic', 'admin', 'env-dynamic', NULL, NULL),
(88, 'reason', 'admin', 'reason', NULL, NULL),
(89, 'form-batch-upload', 'admin', 'batch-upload', NULL, NULL),
(90, 'expense-head-list', 'admin', 'expense-head', NULL, NULL),
(91, 'collection-report', 'admin', 'report', NULL, NULL),
(92, 'merchant-wise-parcel', 'admin', 'report', NULL, NULL),
(93, 'date -wise-parcel', 'admin', 'report', NULL, NULL),
(94, 'total-parcel-rider-wise', 'admin', 'report', NULL, NULL),
(95, 'parcel-summary', 'admin', 'report', NULL, NULL),
(96, 'merchant-parcel-summary', 'admin', 'report', NULL, NULL),
(97, 'parcel-summary-in-merchant-wise', 'admin', 'report', NULL, NULL),
(98, 'parcel-summary-in-rider-wise', 'admin', 'report', NULL, NULL),
(99, 'cash-summary-report', 'admin', 'report', NULL, NULL),
(100, 'rider-wise-parcel', 'admin', 'report', NULL, NULL),
(101, 'due-list', 'admin', 'due list', NULL, NULL),
(102, 'collection-summary', 'admin', 'Collection Summary', NULL, NULL),
(103, 'advance-list', 'admin', 'advance', NULL, NULL),
(104, 'advance-create', 'admin', 'advance', NULL, NULL),
(105, 'area-wise-parcel', 'admin', 'report', NULL, NULL),
(106, 'set-delivery-charge', 'admin', 'delivery-charge ', NULL, NULL),
(107, 'edit-set-delivery-charge', 'admin', 'delivery-charge ', NULL, NULL),
(108, 'loan-list', 'admin', 'loan', NULL, NULL),
(109, 'loan-create', 'admin', 'loan', NULL, NULL),
(110, 'loan-show', 'admin', 'loan', NULL, NULL),
(111, 'loan-edit', 'admin', 'loan', NULL, NULL),
(112, 'loan-delete', 'admin', 'loan', NULL, NULL),
(113, 'bad-debt-list', 'admin', 'bad-debt', NULL, NULL),
(114, 'bad-debt-create', 'admin', 'bad-debt', NULL, NULL),
(115, 'bad-debt-show', 'admin', 'bad-debt', NULL, NULL),
(116, 'bad-debt-edit', 'admin', 'bad-debt', NULL, NULL),
(117, 'bad-debt-delete', 'admin', 'bad-debt', NULL, NULL),
(118, 'balance-sheet', 'admin', 'balance-sheet', NULL, NULL),
(119, 'goto-dashboard-rider', 'admin', 'dashboard', NULL, NULL),
(120, 'goto-dashboard-merchant', 'admin', 'dashboard', NULL, NULL),
(121, 'reset-rider-password', 'admin', 'password', NULL, NULL),
(122, 'reason-list', 'admin', 'reason', NULL, NULL),
(123, 'reason-create', 'admin', 'reason', NULL, NULL),
(124, 'reason-show', 'admin', 'reason', NULL, NULL),
(125, 'reason-edit', 'admin', 'reason', NULL, NULL),
(126, 'reason-delete', 'admin', 'reason', NULL, NULL),
(127, 'attendance-list', 'admin', 'attendance', NULL, NULL),
(128, 'attendance-create', 'admin', 'attendance', NULL, NULL),
(129, 'attendance-show', 'admin', 'attendance', NULL, NULL),
(130, 'attendance-edit', 'admin', 'attendance', NULL, NULL),
(131, 'attendance-delete', 'admin', 'attendance', NULL, NULL),
(132, 'payroll-list', 'admin', 'payroll', NULL, NULL),
(133, 'payroll-create', 'admin', 'payroll', NULL, NULL),
(134, 'payroll-show', 'admin', 'payroll', NULL, NULL),
(135, 'payroll-edit', 'admin', 'payroll', NULL, NULL),
(136, 'payroll-delete', 'admin', 'payroll', NULL, NULL),
(137, 'leave-type-list', 'admin', 'leave-type', NULL, NULL),
(138, 'leave-type-create', 'admin', 'leave-type', NULL, NULL),
(139, 'leave-type-show', 'admin', 'leave-type', NULL, NULL),
(140, 'leave-type-edit', 'admin', 'leave-type', NULL, NULL),
(141, 'leave-type-delete', 'admin', 'leave-type', NULL, NULL),
(142, 'accounts-collection', 'admin', 'collection', NULL, NULL),
(143, 'accounts-collection-history', 'admin', 'collection', NULL, NULL),
(144, 'incharge-collection', 'admin', 'collection', NULL, NULL),
(145, 'incharge-collection-history', 'admin', 'collection', NULL, NULL),
(146, 'advance-edit', 'admin', 'advance', NULL, NULL),
(147, 'advance-show', 'admin', 'advance', NULL, NULL),
(148, 'advance-delete', 'admin', 'advance', NULL, NULL),
(149, 'direct-batch-upload', 'admin', 'batch-upload', NULL, NULL),
(150, 'investment-list', 'admin', 'investment', NULL, NULL),
(151, 'investment-create', 'admin', 'investment', NULL, NULL),
(152, 'investment-show', 'admin', 'investment', NULL, NULL),
(153, 'investment-edit', 'admin', 'investment', NULL, NULL),
(154, 'investment-delete', 'admin', 'investment', NULL, NULL),
(155, 'cancle-invoice-list', 'admin', 'cancle-invoice', NULL, NULL),
(156, 'cancle-invoice-create', 'admin', 'cancle-invoice', NULL, NULL),
(157, 'customer-export', 'admin', 'customer-export', NULL, NULL),
(158, 'incharge-invoice-list', 'admin', 'incharge-invoice', NULL, NULL),
(159, 'incharge-invoice-create', 'admin', 'incharge-invoice', NULL, NULL),
(160, 'print-parcel', 'admin', 'print-parcel', NULL, NULL),
(161, 'date-adjust', 'admin', 'date-adjust', NULL, NULL),
(162, 'rider-invoice-list', 'admin', 'rider-invoice', NULL, NULL),
(163, 'expense-head-create', 'admin', 'expense-head', NULL, NULL),
(164, 'expense-head-show', 'admin', 'expense-head', NULL, NULL),
(165, 'expense-head-edit', 'admin', 'expense-head', NULL, NULL),
(166, 'expense-head-delete', 'admin', 'expense-head', NULL, NULL),
(167, 'assign-parcel', 'admin', 'assign', NULL, NULL),
(168, 'reassign-parcel', 'admin', 'assign', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `pickup_requests`
--

CREATE TABLE `pickup_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `merchant_id` bigint UNSIGNED NOT NULL,
  `service_type_id` bigint UNSIGNED DEFAULT NULL,
  `assigned_by` bigint UNSIGNED DEFAULT NULL,
  `assigning_by` bigint UNSIGNED DEFAULT NULL,
  `assigning_time` datetime DEFAULT NULL,
  `picked_time` datetime DEFAULT NULL,
  `accepted_time` datetime DEFAULT NULL,
  `cancel_time` datetime DEFAULT NULL,
  `status` enum('pending','processing','assigned','accepted','picked','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pickup_requests`
--

INSERT INTO `pickup_requests` (`id`, `hub_id`, `merchant_id`, `service_type_id`, `assigned_by`, `assigning_by`, `assigning_time`, `picked_time`, `accepted_time`, `cancel_time`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, 1, 4, '2022-10-12 15:00:55', '2022-10-14 16:32:07', '2022-10-14 16:31:30', NULL, 'picked', '2022-10-11 02:59:48', '2022-10-14 21:32:07'),
(2, NULL, 3, NULL, 1, 4, '2022-10-12 15:00:47', '2022-10-14 16:32:02', '2022-10-14 16:31:23', NULL, 'picked', '2022-10-11 23:57:05', '2022-10-14 21:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `print_parcels`
--

CREATE TABLE `print_parcels` (
  `id` bigint UNSIGNED NOT NULL,
  `rider_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `accepted_by` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `print_parcel_items`
--

CREATE TABLE `print_parcel_items` (
  `id` bigint UNSIGNED NOT NULL,
  `print_parcel_id` bigint UNSIGNED NOT NULL,
  `parcel_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `id` bigint UNSIGNED NOT NULL,
  `reasonable_id` bigint UNSIGNED NOT NULL,
  `reasonable_type` varchar(191) NOT NULL,
  `reason_type_id` bigint UNSIGNED DEFAULT NULL,
  `other_reason` text,
  `type` enum('hold','cancel') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `reason_types`
--

CREATE TABLE `reason_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `reason_type` enum('hold','cancel','both') NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `reason_types`
--

INSERT INTO `reason_types` (`id`, `name`, `reason_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Corrupti provident totam suscipit et sint nulla molestiae.', 'both', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(2, 'Aperiam molestiae laborum dolores quod dolores qui.', 'cancel', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(3, 'Libero omnis soluta qui qui aliquam saepe sit.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(4, 'Facilis perferendis dolorem laudantium.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(5, 'Alias voluptate repellat expedita consequuntur libero dolore.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(6, 'Sunt ducimus saepe eveniet.', 'both', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(7, 'Quo optio ut doloremque.', 'both', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(8, 'Mollitia totam necessitatibus autem iusto error nulla.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(9, 'Sapiente incidunt voluptatum deleniti modi.', 'cancel', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(10, 'Neque iure unde cumque non.', 'cancel', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(11, 'Aut numquam aut ex.', 'cancel', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(12, 'Quae eos id id illo quisquam.', 'both', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(13, 'Maiores et consequuntur consequatur et blanditiis excepturi et et.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(14, 'Atque dignissimos et culpa nihil est eligendi qui.', 'both', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(15, 'Ut mollitia consequatur est reprehenderit veniam sit molestiae totam.', 'cancel', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(16, 'Nihil eaque eaque accusantium quia.', 'cancel', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(17, 'Earum et quisquam nisi accusamus aut.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(18, 'Explicabo quisquam aut natus corrupti veniam totam voluptas.', 'both', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(19, 'Repudiandae sunt corrupti ipsum quia.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(20, 'Maxime velit sequi suscipit nulla et qui.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(21, 'Est omnis nisi eaque eveniet.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(22, 'Eum modi possimus delectus nemo id tempora rerum.', 'cancel', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(23, 'Doloribus explicabo sunt cupiditate omnis pariatur cum.', 'cancel', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(24, 'Voluptas rem consequuntur veniam ut aut sit.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(25, 'Qui enim ut mollitia et est perspiciatis mollitia.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(26, 'Dicta quis sed quisquam numquam a quia ut.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(27, 'Excepturi architecto sed sint voluptatem sed.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(28, 'Dolorem neque vel commodi expedita et voluptatibus officiis.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(29, 'Qui expedita laudantium sunt ex voluptatem.', 'cancel', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10'),
(30, 'Ratione quidem provident architecto consequatur repellat.', 'hold', 'active', '2022-07-23 11:29:10', '2022-07-23 11:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE `riders` (
  `id` bigint UNSIGNED NOT NULL,
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `area_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `rider_code` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `mobile` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nid` varchar(191) DEFAULT NULL,
  `present_address` text,
  `permanent_address` text,
  `avatar` varchar(191) DEFAULT NULL,
  `salary_type` enum('commission','fixed') NOT NULL DEFAULT 'fixed',
  `commission_type` enum('percentage','fixed') DEFAULT NULL,
  `commission_rate` decimal(10,2) DEFAULT NULL,
  `isActive` enum('1','0') NOT NULL DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`id`, `hub_id`, `area_id`, `name`, `rider_code`, `email`, `mobile`, `password`, `nid`, `present_address`, `permanent_address`, `avatar`, `salary_type`, `commission_type`, `commission_rate`, `isActive`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'rider test', 'PSRI-190050', 'rider@gmail.com', '01717528335', '$2y$10$1fy42MSUdNtdBeHuQksT5uEkFIZRdBwMZDKDint2UxfpTiUd4bTmO', '1225', 'asdf', 'asdf', NULL, 'fixed', NULL, NULL, '0', 'active', NULL, '2022-07-23 11:34:44', '2022-07-23 11:34:44'),
(2, 1, NULL, 'Joton Sutradhar', 'PSRI-926780', 'jotonsutradharjoy@gmail.com', '01768237023', '$2y$10$/IJ1chShszxW2t4ZwWLCqeAm6Aq.U95NUZD11YjroxLwSi7Vmeph.', '7781173807', 'Banasree', 'B-baria', NULL, 'fixed', NULL, NULL, '0', 'active', NULL, '2022-10-11 22:46:45', '2022-10-11 22:46:45'),
(3, 1, NULL, 'Ibrahim', 'PSRI-668947', 'ibrahimpu@gmail.com', '01727437086', '$2y$10$8Vlgwk70EcFbiLD6cVfvPOs2wGFE42yen6Dhf4LX9zxc2s0v97lvu', '7781173451', 'Dhaka', 'dhaka', NULL, 'fixed', NULL, NULL, '0', 'active', NULL, '2022-10-11 23:47:30', '2022-10-12 00:53:03'),
(4, 1, NULL, 'Md Sajib', 'PSRI-369540', 'sajib@gmail.com', '01952023477', '$2y$10$vYYoTaG7QTWcFoR2F2GaW.WA9feddNpAh2glzzKJRddx0MhZzmqH6', '7781173487', 'Dhaka', 'Dhaka', NULL, 'fixed', NULL, NULL, '0', 'active', NULL, '2022-10-11 23:48:34', '2022-10-11 23:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `rider_collections`
--

CREATE TABLE `rider_collections` (
  `id` bigint UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `collection_amount` decimal(8,2) DEFAULT NULL,
  `delivery_charge` decimal(8,2) NOT NULL,
  `cod_charge` decimal(8,2) NOT NULL,
  `net_payable` decimal(8,2) NOT NULL,
  `cancle_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `merchant_id` bigint UNSIGNED DEFAULT NULL,
  `parcel_id` bigint UNSIGNED NOT NULL,
  `tracking_id` bigint UNSIGNED DEFAULT NULL,
  `rider_collected_by` bigint UNSIGNED DEFAULT NULL,
  `rider_collected_time` datetime DEFAULT NULL,
  `rider_collected_status` enum('collected','transfer_request','transferred') NOT NULL DEFAULT 'collected',
  `rider_transfer_request_time` datetime DEFAULT NULL,
  `incharge_collected_by` bigint UNSIGNED DEFAULT NULL,
  `incharge_collected_time` datetime DEFAULT NULL,
  `incharge_collected_status` enum('collected','transfer_request','transferred') DEFAULT NULL,
  `incharge_transfer_request_time` datetime DEFAULT NULL,
  `accounts_collected_by` bigint UNSIGNED DEFAULT NULL,
  `accounts_collected_time` datetime DEFAULT NULL,
  `accounts_collected_status` enum('collected') DEFAULT NULL,
  `merchant_paid` enum('paid','unpaid','received') NOT NULL DEFAULT 'unpaid',
  `merchant_paid_time` datetime DEFAULT NULL,
  `note` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `rider_transactions`
--

CREATE TABLE `rider_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', NULL, NULL),
(2, 'Admin', 'admin', NULL, NULL),
(3, 'Accountant', 'admin', NULL, '2022-07-23 11:48:24'),
(4, 'Incharge', 'admin', NULL, NULL),
(5, 'Marketing', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(158, 1),
(159, 1),
(160, 1),
(161, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1),
(166, 1),
(167, 1),
(168, 1),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(40, 3),
(41, 3),
(42, 3),
(43, 3),
(44, 3),
(45, 3),
(46, 3),
(47, 3),
(48, 3),
(49, 3),
(50, 3),
(51, 3),
(52, 3),
(53, 3),
(54, 3),
(55, 3),
(56, 3),
(57, 3),
(58, 3),
(59, 3),
(60, 3),
(61, 3),
(62, 3),
(63, 3),
(64, 3),
(65, 3),
(66, 3),
(67, 3),
(68, 3),
(69, 3),
(70, 3),
(71, 3),
(72, 3),
(73, 3),
(74, 3),
(75, 3),
(76, 3),
(77, 3),
(78, 3),
(79, 3),
(80, 3),
(81, 3),
(82, 3),
(83, 3),
(84, 3),
(85, 3),
(86, 3),
(87, 3),
(88, 3),
(89, 3),
(90, 3),
(91, 3),
(92, 3),
(93, 3),
(94, 3),
(95, 3),
(96, 3),
(97, 3),
(98, 3),
(99, 3),
(100, 3),
(101, 3),
(102, 3),
(103, 3),
(104, 3),
(105, 3),
(106, 3),
(107, 3),
(108, 3),
(109, 3),
(110, 3),
(111, 3),
(112, 3),
(113, 3),
(114, 3),
(115, 3),
(116, 3),
(117, 3),
(118, 3),
(119, 3),
(120, 3),
(121, 3),
(122, 3),
(123, 3),
(124, 3),
(125, 3),
(126, 3),
(127, 3),
(128, 3),
(129, 3),
(130, 3),
(131, 3),
(132, 3),
(133, 3),
(134, 3),
(135, 3),
(136, 3),
(137, 3),
(138, 3),
(139, 3),
(140, 3),
(141, 3),
(142, 3),
(143, 3),
(144, 3),
(145, 3),
(146, 3),
(147, 3),
(148, 3),
(149, 3),
(150, 3),
(151, 3),
(152, 3),
(153, 3),
(154, 3),
(155, 3),
(156, 3),
(157, 3),
(158, 3),
(159, 3),
(160, 3),
(161, 3),
(162, 3),
(163, 3),
(164, 3),
(165, 3),
(166, 3),
(167, 3),
(168, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4),
(32, 4),
(33, 4),
(34, 4),
(35, 4),
(36, 4),
(37, 4),
(38, 4),
(39, 4),
(40, 4),
(41, 4),
(42, 4),
(43, 4),
(44, 4),
(45, 4),
(46, 4),
(47, 4),
(48, 4),
(49, 4),
(50, 4),
(51, 4),
(52, 4),
(53, 4),
(54, 4),
(55, 4),
(56, 4),
(57, 4),
(58, 4),
(59, 4),
(60, 4),
(61, 4),
(62, 4),
(63, 4),
(64, 4),
(65, 4),
(66, 4),
(67, 4),
(68, 4),
(69, 4),
(70, 4),
(71, 4),
(72, 4),
(73, 4),
(74, 4),
(75, 4),
(76, 4),
(77, 4),
(78, 4),
(79, 4),
(80, 4),
(81, 4),
(82, 4),
(83, 4),
(84, 4),
(85, 4),
(86, 4),
(87, 4),
(88, 4),
(89, 4),
(90, 4),
(91, 4),
(92, 4),
(93, 4),
(94, 4),
(95, 4),
(96, 4),
(97, 4),
(98, 4),
(99, 4),
(100, 4),
(101, 4),
(102, 4),
(103, 4),
(104, 4),
(105, 4),
(106, 4),
(107, 4),
(108, 4),
(109, 4),
(110, 4),
(111, 4),
(112, 4),
(113, 4),
(114, 4),
(115, 4),
(116, 4),
(117, 4),
(118, 4),
(119, 4),
(120, 4),
(121, 4),
(122, 4),
(123, 4),
(124, 4),
(125, 4),
(126, 4),
(127, 4),
(128, 4),
(129, 4),
(130, 4),
(131, 4),
(132, 4),
(133, 4),
(134, 4),
(135, 4),
(136, 4),
(137, 4),
(138, 4),
(139, 4),
(140, 4),
(141, 4),
(142, 4),
(143, 4),
(144, 4),
(145, 4),
(146, 4),
(147, 4),
(148, 4),
(149, 4),
(150, 4),
(151, 4),
(152, 4),
(153, 4),
(154, 4),
(155, 4),
(156, 4),
(157, 4),
(158, 4),
(159, 4),
(160, 4),
(161, 4),
(162, 4),
(163, 4),
(164, 4),
(165, 4),
(166, 4),
(167, 4),
(168, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sms_configures`
--

CREATE TABLE `sms_configures` (
  `id` bigint UNSIGNED NOT NULL,
  `hub_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `apiKey` varchar(191) DEFAULT NULL,
  `senderId` varchar(191) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1=Active,0=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `sms_settings`
--

CREATE TABLE `sms_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `mobile` varchar(191) DEFAULT NULL,
  `ofc_send` enum('yes','no') DEFAULT NULL,
  `merchant_send` enum('yes','no') DEFAULT NULL,
  `customer_send` enum('yes','no') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `status_meanings`
--

CREATE TABLE `status_meanings` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` longtext NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `sub_areas`
--

CREATE TABLE `sub_areas` (
  `id` bigint UNSIGNED NOT NULL,
  `area_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `sub_areas`
--

INSERT INTO `sub_areas` (`id`, `area_id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pallabi', '1', 'active', '2022-07-23 11:31:59', '2022-07-23 11:31:59'),
(2, 2, 'Banasree', '1219', 'active', '2022-10-11 22:45:59', '2022-10-11 22:45:59'),
(3, 2, 'Goran', '01', 'active', '2022-10-11 23:41:09', '2022-10-11 23:41:09'),
(4, 2, 'Sipahibaag', '02', 'active', '2022-10-11 23:41:24', '2022-10-11 23:41:24'),
(5, 2, 'Taltola', '03', 'active', '2022-10-11 23:41:38', '2022-10-11 23:41:38'),
(6, 2, 'Shahjahanpur', '04', 'active', '2022-10-11 23:41:58', '2022-10-11 23:41:58');

-- --------------------------------------------------------

--
-- Table structure for table `upazilas`
--

CREATE TABLE `upazilas` (
  `id` bigint UNSIGNED NOT NULL,
  `district_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `upazilas`
--

INSERT INTO `upazilas` (`id`, `district_id`, `name`, `bn_name`, `url`, `created_at`, `updated_at`) VALUES
(1, 1, 'Debidwar', 'দেবিদ্বার', 'debidwar.comilla.gov.bd', NULL, NULL),
(2, 1, 'Barura', 'বরুড়া', 'barura.comilla.gov.bd', NULL, NULL),
(3, 1, 'Brahmanpara', 'ব্রাহ্মণপাড়া', 'brahmanpara.comilla.gov.bd', NULL, NULL),
(4, 1, 'Chandina', 'চান্দিনা', 'chandina.comilla.gov.bd', NULL, NULL),
(5, 1, 'Chauddagram', 'চৌদ্দগ্রাম', 'chauddagram.comilla.gov.bd', NULL, NULL),
(6, 1, 'Daudkandi', 'দাউদকান্দি', 'daudkandi.comilla.gov.bd', NULL, NULL),
(7, 1, 'Homna', 'হোমনা', 'homna.comilla.gov.bd', NULL, NULL),
(8, 1, 'Laksam', 'লাকসাম', 'laksam.comilla.gov.bd', NULL, NULL),
(9, 1, 'Muradnagar', 'মুরাদনগর', 'muradnagar.comilla.gov.bd', NULL, NULL),
(10, 1, 'Nangalkot', 'নাঙ্গলকোট', 'nangalkot.comilla.gov.bd', NULL, NULL),
(11, 1, 'Comilla Sadar', 'কুমিল্লা সদর', 'comillasadar.comilla.gov.bd', NULL, NULL),
(12, 1, 'Meghna', 'মেঘনা', 'meghna.comilla.gov.bd', NULL, NULL),
(13, 1, 'Monohargonj', 'মনোহরগঞ্জ', 'monohargonj.comilla.gov.bd', NULL, NULL),
(14, 1, 'Sadarsouth', 'সদর দক্ষিণ', 'sadarsouth.comilla.gov.bd', NULL, NULL),
(15, 1, 'Titas', 'তিতাস', 'titas.comilla.gov.bd', NULL, NULL),
(16, 1, 'Burichang', 'বুড়িচং', 'burichang.comilla.gov.bd', NULL, NULL),
(17, 1, 'Lalmai', 'লালমাই', 'lalmai.comilla.gov.bd', NULL, NULL),
(18, 2, 'Chhagalnaiya', 'ছাগলনাইয়া', 'chhagalnaiya.feni.gov.bd', NULL, NULL),
(19, 2, 'Feni Sadar', 'ফেনী সদর', 'sadar.feni.gov.bd', NULL, NULL),
(20, 2, 'Sonagazi', 'সোনাগাজী', 'sonagazi.feni.gov.bd', NULL, NULL),
(21, 2, 'Fulgazi', 'ফুলগাজী', 'fulgazi.feni.gov.bd', NULL, NULL),
(22, 2, 'Parshuram', 'পরশুরাম', 'parshuram.feni.gov.bd', NULL, NULL),
(23, 2, 'Daganbhuiyan', 'দাগনভূঞা', 'daganbhuiyan.feni.gov.bd', NULL, NULL),
(24, 3, 'Brahmanbaria Sadar', 'ব্রাহ্মণবাড়িয়া সদর', 'sadar.brahmanbaria.gov.bd', NULL, NULL),
(25, 3, 'Kasba', 'কসবা', 'kasba.brahmanbaria.gov.bd', NULL, NULL),
(26, 3, 'Nasirnagar', 'নাসিরনগর', 'nasirnagar.brahmanbaria.gov.bd', NULL, NULL),
(27, 3, 'Sarail', 'সরাইল', 'sarail.brahmanbaria.gov.bd', NULL, NULL),
(28, 3, 'Ashuganj', 'আশুগঞ্জ', 'ashuganj.brahmanbaria.gov.bd', NULL, NULL),
(29, 3, 'Akhaura', 'আখাউড়া', 'akhaura.brahmanbaria.gov.bd', NULL, NULL),
(30, 3, 'Nabinagar', 'নবীনগর', 'nabinagar.brahmanbaria.gov.bd', NULL, NULL),
(31, 3, 'Bancharampur', 'বাঞ্ছারামপুর', 'bancharampur.brahmanbaria.gov.bd', NULL, NULL),
(32, 3, 'Bijoynagar', 'বিজয়নগর', 'bijoynagar.brahmanbaria.gov.bd    ', NULL, NULL),
(33, 4, 'Rangamati Sadar', 'রাঙ্গামাটি সদর', 'sadar.rangamati.gov.bd', NULL, NULL),
(34, 4, 'Kaptai', 'কাপ্তাই', 'kaptai.rangamati.gov.bd', NULL, NULL),
(35, 4, 'Kawkhali', 'কাউখালী', 'kawkhali.rangamati.gov.bd', NULL, NULL),
(36, 4, 'Baghaichari', 'বাঘাইছড়ি', 'baghaichari.rangamati.gov.bd', NULL, NULL),
(37, 4, 'Barkal', 'বরকল', 'barkal.rangamati.gov.bd', NULL, NULL),
(38, 4, 'Langadu', 'লংগদু', 'langadu.rangamati.gov.bd', NULL, NULL),
(39, 4, 'Rajasthali', 'রাজস্থলী', 'rajasthali.rangamati.gov.bd', NULL, NULL),
(40, 4, 'Belaichari', 'বিলাইছড়ি', 'belaichari.rangamati.gov.bd', NULL, NULL),
(41, 4, 'Juraichari', 'জুরাছড়ি', 'juraichari.rangamati.gov.bd', NULL, NULL),
(42, 4, 'Naniarchar', 'নানিয়ারচর', 'naniarchar.rangamati.gov.bd', NULL, NULL),
(43, 5, 'Noakhali Sadar', 'নোয়াখালী সদর', 'sadar.noakhali.gov.bd', NULL, NULL),
(44, 5, 'Companiganj', 'কোম্পানীগঞ্জ', 'companiganj.noakhali.gov.bd', NULL, NULL),
(45, 5, 'Begumganj', 'বেগমগঞ্জ', 'begumganj.noakhali.gov.bd', NULL, NULL),
(46, 5, 'Hatia', 'হাতিয়া', 'hatia.noakhali.gov.bd', NULL, NULL),
(47, 5, 'Subarnachar', 'সুবর্ণচর', 'subarnachar.noakhali.gov.bd', NULL, NULL),
(48, 5, 'Kabirhat', 'কবিরহাট', 'kabirhat.noakhali.gov.bd', NULL, NULL),
(49, 5, 'Senbug', 'সেনবাগ', 'senbug.noakhali.gov.bd', NULL, NULL),
(50, 5, 'Chatkhil', 'চাটখিল', 'chatkhil.noakhali.gov.bd', NULL, NULL),
(51, 5, 'Sonaimori', 'সোনাইমুড়ী', 'sonaimori.noakhali.gov.bd', NULL, NULL),
(52, 6, 'Haimchar', 'হাইমচর', 'haimchar.chandpur.gov.bd', NULL, NULL),
(53, 6, 'Kachua', 'কচুয়া', 'kachua.chandpur.gov.bd', NULL, NULL),
(54, 6, 'Shahrasti', 'শাহরাস্তি	', 'shahrasti.chandpur.gov.bd', NULL, NULL),
(55, 6, 'Chandpur Sadar', 'চাঁদপুর সদর', 'sadar.chandpur.gov.bd', NULL, NULL),
(56, 6, 'Matlab South', 'মতলব দক্ষিণ', 'matlabsouth.chandpur.gov.bd', NULL, NULL),
(57, 6, 'Hajiganj', 'হাজীগঞ্জ', 'hajiganj.chandpur.gov.bd', NULL, NULL),
(58, 6, 'Matlab North', 'মতলব উত্তর', 'matlabnorth.chandpur.gov.bd', NULL, NULL),
(59, 6, 'Faridgonj', 'ফরিদগঞ্জ', 'faridgonj.chandpur.gov.bd', NULL, NULL),
(60, 7, 'Lakshmipur Sadar', 'লক্ষ্মীপুর সদর', 'sadar.lakshmipur.gov.bd', NULL, NULL),
(61, 7, 'Kamalnagar', 'কমলনগর', 'kamalnagar.lakshmipur.gov.bd', NULL, NULL),
(62, 7, 'Raipur', 'রায়পুর', 'raipur.lakshmipur.gov.bd', NULL, NULL),
(63, 7, 'Ramgati', 'রামগতি', 'ramgati.lakshmipur.gov.bd', NULL, NULL),
(64, 7, 'Ramganj', 'রামগঞ্জ', 'ramganj.lakshmipur.gov.bd', NULL, NULL),
(65, 8, 'Rangunia', 'রাঙ্গুনিয়া', 'rangunia.chittagong.gov.bd', NULL, NULL),
(66, 8, 'Sitakunda', 'সীতাকুন্ড', 'sitakunda.chittagong.gov.bd', NULL, NULL),
(67, 8, 'Mirsharai', 'মীরসরাই', 'mirsharai.chittagong.gov.bd', NULL, NULL),
(68, 8, 'Patiya', 'পটিয়া', 'patiya.chittagong.gov.bd', NULL, NULL),
(69, 8, 'Sandwip', 'সন্দ্বীপ', 'sandwip.chittagong.gov.bd', NULL, NULL),
(70, 8, 'Banshkhali', 'বাঁশখালী', 'banshkhali.chittagong.gov.bd', NULL, NULL),
(71, 8, 'Boalkhali', 'বোয়ালখালী', 'boalkhali.chittagong.gov.bd', NULL, NULL),
(72, 8, 'Anwara', 'আনোয়ারা', 'anwara.chittagong.gov.bd', NULL, NULL),
(73, 8, 'Chandanaish', 'চন্দনাইশ', 'chandanaish.chittagong.gov.bd', NULL, NULL),
(74, 8, 'Satkania', 'সাতকানিয়া', 'satkania.chittagong.gov.bd', NULL, NULL),
(75, 8, 'Lohagara', 'লোহাগাড়া', 'lohagara.chittagong.gov.bd', NULL, NULL),
(76, 8, 'Hathazari', 'হাটহাজারী', 'hathazari.chittagong.gov.bd', NULL, NULL),
(77, 8, 'Fatikchhari', 'ফটিকছড়ি', 'fatikchhari.chittagong.gov.bd', NULL, NULL),
(78, 8, 'Raozan', 'রাউজান', 'raozan.chittagong.gov.bd', NULL, NULL),
(79, 8, 'Karnafuli', 'কর্ণফুলী', 'karnafuli.chittagong.gov.bd', NULL, NULL),
(80, 9, 'Coxsbazar Sadar', 'কক্সবাজার সদর', 'sadar.coxsbazar.gov.bd', NULL, NULL),
(81, 9, 'Chakaria', 'চকরিয়া', 'chakaria.coxsbazar.gov.bd', NULL, NULL),
(82, 9, 'Kutubdia', 'কুতুবদিয়া', 'kutubdia.coxsbazar.gov.bd', NULL, NULL),
(83, 9, 'Ukhiya', 'উখিয়া', 'ukhiya.coxsbazar.gov.bd', NULL, NULL),
(84, 9, 'Moheshkhali', 'মহেশখালী', 'moheshkhali.coxsbazar.gov.bd', NULL, NULL),
(85, 9, 'Pekua', 'পেকুয়া', 'pekua.coxsbazar.gov.bd', NULL, NULL),
(86, 9, 'Ramu', 'রামু', 'ramu.coxsbazar.gov.bd', NULL, NULL),
(87, 9, 'Teknaf', 'টেকনাফ', 'teknaf.coxsbazar.gov.bd', NULL, NULL),
(88, 10, 'Khagrachhari Sadar', 'খাগড়াছড়ি সদর', 'sadar.khagrachhari.gov.bd', NULL, NULL),
(89, 10, 'Dighinala', 'দিঘীনালা', 'dighinala.khagrachhari.gov.bd', NULL, NULL),
(90, 10, 'Panchari', 'পানছড়ি', 'panchari.khagrachhari.gov.bd', NULL, NULL),
(91, 10, 'Laxmichhari', 'লক্ষীছড়ি', 'laxmichhari.khagrachhari.gov.bd', NULL, NULL),
(92, 10, 'Mohalchari', 'মহালছড়ি', 'mohalchari.khagrachhari.gov.bd', NULL, NULL),
(93, 10, 'Manikchari', 'মানিকছড়ি', 'manikchari.khagrachhari.gov.bd', NULL, NULL),
(94, 10, 'Ramgarh', 'রামগড়', 'ramgarh.khagrachhari.gov.bd', NULL, NULL),
(95, 10, 'Matiranga', 'মাটিরাঙ্গা', 'matiranga.khagrachhari.gov.bd', NULL, NULL),
(96, 10, 'Guimara', 'গুইমারা', 'guimara.khagrachhari.gov.bd', NULL, NULL),
(97, 11, 'Bandarban Sadar', 'বান্দরবান সদর', 'sadar.bandarban.gov.bd', NULL, NULL),
(98, 11, 'Alikadam', 'আলীকদম', 'alikadam.bandarban.gov.bd', NULL, NULL),
(99, 11, 'Naikhongchhari', 'নাইক্ষ্যংছড়ি', 'naikhongchhari.bandarban.gov.bd', NULL, NULL),
(100, 11, 'Rowangchhari', 'রোয়াংছড়ি', 'rowangchhari.bandarban.gov.bd', NULL, NULL),
(101, 11, 'Lama', 'লামা', 'lama.bandarban.gov.bd', NULL, NULL),
(102, 11, 'Ruma', 'রুমা', 'ruma.bandarban.gov.bd', NULL, NULL),
(103, 11, 'Thanchi', 'থানচি', 'thanchi.bandarban.gov.bd', NULL, NULL),
(104, 12, 'Belkuchi', 'বেলকুচি', 'belkuchi.sirajganj.gov.bd', NULL, NULL),
(105, 12, 'Chauhali', 'চৌহালি', 'chauhali.sirajganj.gov.bd', NULL, NULL),
(106, 12, 'Kamarkhand', 'কামারখন্দ', 'kamarkhand.sirajganj.gov.bd', NULL, NULL),
(107, 12, 'Kazipur', 'কাজীপুর', 'kazipur.sirajganj.gov.bd', NULL, NULL),
(108, 12, 'Raigonj', 'রায়গঞ্জ', 'raigonj.sirajganj.gov.bd', NULL, NULL),
(109, 12, 'Shahjadpur', 'শাহজাদপুর', 'shahjadpur.sirajganj.gov.bd', NULL, NULL),
(110, 12, 'Sirajganj Sadar', 'সিরাজগঞ্জ সদর', 'sirajganjsadar.sirajganj.gov.bd', NULL, NULL),
(111, 12, 'Tarash', 'তাড়াশ', 'tarash.sirajganj.gov.bd', NULL, NULL),
(112, 12, 'Ullapara', 'উল্লাপাড়া', 'ullapara.sirajganj.gov.bd', NULL, NULL),
(113, 13, 'Sujanagar', 'সুজানগর', 'sujanagar.pabna.gov.bd', NULL, NULL),
(114, 13, 'Ishurdi', 'ঈশ্বরদী', 'ishurdi.pabna.gov.bd', NULL, NULL),
(115, 13, 'Bhangura', 'ভাঙ্গুড়া', 'bhangura.pabna.gov.bd', NULL, NULL),
(116, 13, 'Pabna Sadar', 'পাবনা সদর', 'pabnasadar.pabna.gov.bd', NULL, NULL),
(117, 13, 'Bera', 'বেড়া', 'bera.pabna.gov.bd', NULL, NULL),
(118, 13, 'Atghoria', 'আটঘরিয়া', 'atghoria.pabna.gov.bd', NULL, NULL),
(119, 13, 'Chatmohar', 'চাটমোহর', 'chatmohar.pabna.gov.bd', NULL, NULL),
(120, 13, 'Santhia', 'সাঁথিয়া', 'santhia.pabna.gov.bd', NULL, NULL),
(121, 13, 'Faridpur', 'ফরিদপুর', 'faridpur.pabna.gov.bd', NULL, NULL),
(122, 14, 'Kahaloo', 'কাহালু', 'kahaloo.bogra.gov.bd', NULL, NULL),
(123, 14, 'Bogra Sadar', 'বগুড়া সদর', 'sadar.bogra.gov.bd', NULL, NULL),
(124, 14, 'Shariakandi', 'সারিয়াকান্দি', 'shariakandi.bogra.gov.bd', NULL, NULL),
(125, 14, 'Shajahanpur', 'শাজাহানপুর', 'shajahanpur.bogra.gov.bd', NULL, NULL),
(126, 14, 'Dupchanchia', 'দুপচাচিঁয়া', 'dupchanchia.bogra.gov.bd', NULL, NULL),
(127, 14, 'Adamdighi', 'আদমদিঘি', 'adamdighi.bogra.gov.bd', NULL, NULL),
(128, 14, 'Nondigram', 'নন্দিগ্রাম', 'nondigram.bogra.gov.bd', NULL, NULL),
(129, 14, 'Sonatala', 'সোনাতলা', 'sonatala.bogra.gov.bd', NULL, NULL),
(130, 14, 'Dhunot', 'ধুনট', 'dhunot.bogra.gov.bd', NULL, NULL),
(131, 14, 'Gabtali', 'গাবতলী', 'gabtali.bogra.gov.bd', NULL, NULL),
(132, 14, 'Sherpur', 'শেরপুর', 'sherpur.bogra.gov.bd', NULL, NULL),
(133, 14, 'Shibganj', 'শিবগঞ্জ', 'shibganj.bogra.gov.bd', NULL, NULL),
(134, 15, 'Paba', 'পবা', 'paba.rajshahi.gov.bd', NULL, NULL),
(135, 15, 'Durgapur', 'দুর্গাপুর', 'durgapur.rajshahi.gov.bd', NULL, NULL),
(136, 15, 'Mohonpur', 'মোহনপুর', 'mohonpur.rajshahi.gov.bd', NULL, NULL),
(137, 15, 'Charghat', 'চারঘাট', 'charghat.rajshahi.gov.bd', NULL, NULL),
(138, 15, 'Puthia', 'পুঠিয়া', 'puthia.rajshahi.gov.bd', NULL, NULL),
(139, 15, 'Bagha', 'বাঘা', 'bagha.rajshahi.gov.bd', NULL, NULL),
(140, 15, 'Godagari', 'গোদাগাড়ী', 'godagari.rajshahi.gov.bd', NULL, NULL),
(141, 15, 'Tanore', 'তানোর', 'tanore.rajshahi.gov.bd', NULL, NULL),
(142, 15, 'Bagmara', 'বাগমারা', 'bagmara.rajshahi.gov.bd', NULL, NULL),
(143, 16, 'Natore Sadar', 'নাটোর সদর', 'natoresadar.natore.gov.bd', NULL, NULL),
(144, 16, 'Singra', 'সিংড়া', 'singra.natore.gov.bd', NULL, NULL),
(145, 16, 'Baraigram', 'বড়াইগ্রাম', 'baraigram.natore.gov.bd', NULL, NULL),
(146, 16, 'Bagatipara', 'বাগাতিপাড়া', 'bagatipara.natore.gov.bd', NULL, NULL),
(147, 16, 'Lalpur', 'লালপুর', 'lalpur.natore.gov.bd', NULL, NULL),
(148, 16, 'Gurudaspur', 'গুরুদাসপুর', 'gurudaspur.natore.gov.bd', NULL, NULL),
(149, 16, 'Naldanga', 'নলডাঙ্গা', 'naldanga.natore.gov.bd', NULL, NULL),
(150, 17, 'Akkelpur', 'আক্কেলপুর', 'akkelpur.joypurhat.gov.bd', NULL, NULL),
(151, 17, 'Kalai', 'কালাই', 'kalai.joypurhat.gov.bd', NULL, NULL),
(152, 17, 'Khetlal', 'ক্ষেতলাল', 'khetlal.joypurhat.gov.bd', NULL, NULL),
(153, 17, 'Panchbibi', 'পাঁচবিবি', 'panchbibi.joypurhat.gov.bd', NULL, NULL),
(154, 17, 'Joypurhat Sadar', 'জয়পুরহাট সদর', 'joypurhatsadar.joypurhat.gov.bd', NULL, NULL),
(155, 18, 'Chapainawabganj Sadar', 'চাঁপাইনবাবগঞ্জ সদর', 'chapainawabganjsadar.chapainawabganj.gov.bd', NULL, NULL),
(156, 18, 'Gomostapur', 'গোমস্তাপুর', 'gomostapur.chapainawabganj.gov.bd', NULL, NULL),
(157, 18, 'Nachol', 'নাচোল', 'nachol.chapainawabganj.gov.bd', NULL, NULL),
(158, 18, 'Bholahat', 'ভোলাহাট', 'bholahat.chapainawabganj.gov.bd', NULL, NULL),
(159, 18, 'Shibganj', 'শিবগঞ্জ', 'shibganj.chapainawabganj.gov.bd', NULL, NULL),
(160, 19, 'Mohadevpur', 'মহাদেবপুর', 'mohadevpur.naogaon.gov.bd', NULL, NULL),
(161, 19, 'Badalgachi', 'বদলগাছী', 'badalgachi.naogaon.gov.bd', NULL, NULL),
(162, 19, 'Patnitala', 'পত্নিতলা', 'patnitala.naogaon.gov.bd', NULL, NULL),
(163, 19, 'Dhamoirhat', 'ধামইরহাট', 'dhamoirhat.naogaon.gov.bd', NULL, NULL),
(164, 19, 'Niamatpur', 'নিয়ামতপুর', 'niamatpur.naogaon.gov.bd', NULL, NULL),
(165, 19, 'Manda', 'মান্দা', 'manda.naogaon.gov.bd', NULL, NULL),
(166, 19, 'Atrai', 'আত্রাই', 'atrai.naogaon.gov.bd', NULL, NULL),
(167, 19, 'Raninagar', 'রাণীনগর', 'raninagar.naogaon.gov.bd', NULL, NULL),
(168, 19, 'Naogaon Sadar', 'নওগাঁ সদর', 'naogaonsadar.naogaon.gov.bd', NULL, NULL),
(169, 19, 'Porsha', 'পোরশা', 'porsha.naogaon.gov.bd', NULL, NULL),
(170, 19, 'Sapahar', 'সাপাহার', 'sapahar.naogaon.gov.bd', NULL, NULL),
(171, 20, 'Manirampur', 'মণিরামপুর', 'manirampur.jessore.gov.bd', NULL, NULL),
(172, 20, 'Abhaynagar', 'অভয়নগর', 'abhaynagar.jessore.gov.bd', NULL, NULL),
(173, 20, 'Bagherpara', 'বাঘারপাড়া', 'bagherpara.jessore.gov.bd', NULL, NULL),
(174, 20, 'Chougachha', 'চৌগাছা', 'chougachha.jessore.gov.bd', NULL, NULL),
(175, 20, 'Jhikargacha', 'ঝিকরগাছা', 'jhikargacha.jessore.gov.bd', NULL, NULL),
(176, 20, 'Keshabpur', 'কেশবপুর', 'keshabpur.jessore.gov.bd', NULL, NULL),
(177, 20, 'Jessore Sadar', 'যশোর সদর', 'sadar.jessore.gov.bd', NULL, NULL),
(178, 20, 'Sharsha', 'শার্শা', 'sharsha.jessore.gov.bd', NULL, NULL),
(179, 21, 'Assasuni', 'আশাশুনি', 'assasuni.satkhira.gov.bd', NULL, NULL),
(180, 21, 'Debhata', 'দেবহাটা', 'debhata.satkhira.gov.bd', NULL, NULL),
(181, 21, 'Kalaroa', 'কলারোয়া', 'kalaroa.satkhira.gov.bd', NULL, NULL),
(182, 21, 'Satkhira Sadar', 'সাতক্ষীরা সদর', 'satkhirasadar.satkhira.gov.bd', NULL, NULL),
(183, 21, 'Shyamnagar', 'শ্যামনগর', 'shyamnagar.satkhira.gov.bd', NULL, NULL),
(184, 21, 'Tala', 'তালা', 'tala.satkhira.gov.bd', NULL, NULL),
(185, 21, 'Kaliganj', 'কালিগঞ্জ', 'kaliganj.satkhira.gov.bd', NULL, NULL),
(186, 22, 'Mujibnagar', 'মুজিবনগর', 'mujibnagar.meherpur.gov.bd', NULL, NULL),
(187, 22, 'Meherpur Sadar', 'মেহেরপুর সদর', 'meherpursadar.meherpur.gov.bd', NULL, NULL),
(188, 22, 'Gangni', 'গাংনী', 'gangni.meherpur.gov.bd', NULL, NULL),
(189, 23, 'Narail Sadar', 'নড়াইল সদর', 'narailsadar.narail.gov.bd', NULL, NULL),
(190, 23, 'Lohagara', 'লোহাগড়া', 'lohagara.narail.gov.bd', NULL, NULL),
(191, 23, 'Kalia', 'কালিয়া', 'kalia.narail.gov.bd', NULL, NULL),
(192, 24, 'Chuadanga Sadar', 'চুয়াডাঙ্গা সদর', 'chuadangasadar.chuadanga.gov.bd', NULL, NULL),
(193, 24, 'Alamdanga', 'আলমডাঙ্গা', 'alamdanga.chuadanga.gov.bd', NULL, NULL),
(194, 24, 'Damurhuda', 'দামুড়হুদা', 'damurhuda.chuadanga.gov.bd', NULL, NULL),
(195, 24, 'Jibannagar', 'জীবননগর', 'jibannagar.chuadanga.gov.bd', NULL, NULL),
(196, 25, 'Kushtia Sadar', 'কুষ্টিয়া সদর', 'kushtiasadar.kushtia.gov.bd', NULL, NULL),
(197, 25, 'Kumarkhali', 'কুমারখালী', 'kumarkhali.kushtia.gov.bd', NULL, NULL),
(198, 25, 'Khoksa', 'খোকসা', 'khoksa.kushtia.gov.bd', NULL, NULL),
(199, 25, 'Mirpur', 'মিরপুর', 'mirpurkushtia.kushtia.gov.bd', NULL, NULL),
(200, 25, 'Daulatpur', 'দৌলতপুর', 'daulatpur.kushtia.gov.bd', NULL, NULL),
(201, 25, 'Bheramara', 'ভেড়ামারা', 'bheramara.kushtia.gov.bd', NULL, NULL),
(202, 26, 'Shalikha', 'শালিখা', 'shalikha.magura.gov.bd', NULL, NULL),
(203, 26, 'Sreepur', 'শ্রীপুর', 'sreepur.magura.gov.bd', NULL, NULL),
(204, 26, 'Magura Sadar', 'মাগুরা সদর', 'magurasadar.magura.gov.bd', NULL, NULL),
(205, 26, 'Mohammadpur', 'মহম্মদপুর', 'mohammadpur.magura.gov.bd', NULL, NULL),
(206, 27, 'Paikgasa', 'পাইকগাছা', 'paikgasa.khulna.gov.bd', NULL, NULL),
(207, 27, 'Fultola', 'ফুলতলা', 'fultola.khulna.gov.bd', NULL, NULL),
(208, 27, 'Digholia', 'দিঘলিয়া', 'digholia.khulna.gov.bd', NULL, NULL),
(209, 27, 'Rupsha', 'রূপসা', 'rupsha.khulna.gov.bd', NULL, NULL),
(210, 27, 'Terokhada', 'তেরখাদা', 'terokhada.khulna.gov.bd', NULL, NULL),
(211, 27, 'Dumuria', 'ডুমুরিয়া', 'dumuria.khulna.gov.bd', NULL, NULL),
(212, 27, 'Botiaghata', 'বটিয়াঘাটা', 'botiaghata.khulna.gov.bd', NULL, NULL),
(213, 27, 'Dakop', 'দাকোপ', 'dakop.khulna.gov.bd', NULL, NULL),
(214, 27, 'Koyra', 'কয়রা', 'koyra.khulna.gov.bd', NULL, NULL),
(215, 28, 'Fakirhat', 'ফকিরহাট', 'fakirhat.bagerhat.gov.bd', NULL, NULL),
(216, 28, 'Bagerhat Sadar', 'বাগেরহাট সদর', 'sadar.bagerhat.gov.bd', NULL, NULL),
(217, 28, 'Mollahat', 'মোল্লাহাট', 'mollahat.bagerhat.gov.bd', NULL, NULL),
(218, 28, 'Sarankhola', 'শরণখোলা', 'sarankhola.bagerhat.gov.bd', NULL, NULL),
(219, 28, 'Rampal', 'রামপাল', 'rampal.bagerhat.gov.bd', NULL, NULL),
(220, 28, 'Morrelganj', 'মোড়েলগঞ্জ', 'morrelganj.bagerhat.gov.bd', NULL, NULL),
(221, 28, 'Kachua', 'কচুয়া', 'kachua.bagerhat.gov.bd', NULL, NULL),
(222, 28, 'Mongla', 'মোংলা', 'mongla.bagerhat.gov.bd', NULL, NULL),
(223, 28, 'Chitalmari', 'চিতলমারী', 'chitalmari.bagerhat.gov.bd', NULL, NULL),
(224, 29, 'Jhenaidah Sadar', 'ঝিনাইদহ সদর', 'sadar.jhenaidah.gov.bd', NULL, NULL),
(225, 29, 'Shailkupa', 'শৈলকুপা', 'shailkupa.jhenaidah.gov.bd', NULL, NULL),
(226, 29, 'Harinakundu', 'হরিণাকুন্ডু', 'harinakundu.jhenaidah.gov.bd', NULL, NULL),
(227, 29, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.jhenaidah.gov.bd', NULL, NULL),
(228, 29, 'Kotchandpur', 'কোটচাঁদপুর', 'kotchandpur.jhenaidah.gov.bd', NULL, NULL),
(229, 29, 'Moheshpur', 'মহেশপুর', 'moheshpur.jhenaidah.gov.bd', NULL, NULL),
(230, 30, 'Jhalakathi Sadar', 'ঝালকাঠি সদর', 'sadar.jhalakathi.gov.bd', NULL, NULL),
(231, 30, 'Kathalia', 'কাঠালিয়া', 'kathalia.jhalakathi.gov.bd', NULL, NULL),
(232, 30, 'Nalchity', 'নলছিটি', 'nalchity.jhalakathi.gov.bd', NULL, NULL),
(233, 30, 'Rajapur', 'রাজাপুর', 'rajapur.jhalakathi.gov.bd', NULL, NULL),
(234, 31, 'Bauphal', 'বাউফল', 'bauphal.patuakhali.gov.bd', NULL, NULL),
(235, 31, 'Patuakhali Sadar', 'পটুয়াখালী সদর', 'sadar.patuakhali.gov.bd', NULL, NULL),
(236, 31, 'Dumki', 'দুমকি', 'dumki.patuakhali.gov.bd', NULL, NULL),
(237, 31, 'Dashmina', 'দশমিনা', 'dashmina.patuakhali.gov.bd', NULL, NULL),
(238, 31, 'Kalapara', 'কলাপাড়া', 'kalapara.patuakhali.gov.bd', NULL, NULL),
(239, 31, 'Mirzaganj', 'মির্জাগঞ্জ', 'mirzaganj.patuakhali.gov.bd', NULL, NULL),
(240, 31, 'Galachipa', 'গলাচিপা', 'galachipa.patuakhali.gov.bd', NULL, NULL),
(241, 31, 'Rangabali', 'রাঙ্গাবালী', 'rangabali.patuakhali.gov.bd', NULL, NULL),
(242, 32, 'Pirojpur Sadar', 'পিরোজপুর সদর', 'sadar.pirojpur.gov.bd', NULL, NULL),
(243, 32, 'Nazirpur', 'নাজিরপুর', 'nazirpur.pirojpur.gov.bd', NULL, NULL),
(244, 32, 'Kawkhali', 'কাউখালী', 'kawkhali.pirojpur.gov.bd', NULL, NULL),
(245, 32, 'Zianagar', 'জিয়ানগর', 'zianagar.pirojpur.gov.bd', NULL, NULL),
(246, 32, 'Bhandaria', 'ভান্ডারিয়া', 'bhandaria.pirojpur.gov.bd', NULL, NULL),
(247, 32, 'Mathbaria', 'মঠবাড়ীয়া', 'mathbaria.pirojpur.gov.bd', NULL, NULL),
(248, 32, 'Nesarabad', 'নেছারাবাদ', 'nesarabad.pirojpur.gov.bd', NULL, NULL),
(249, 33, 'Barisal Sadar', 'বরিশাল সদর', 'barisalsadar.barisal.gov.bd', NULL, NULL),
(250, 33, 'Bakerganj', 'বাকেরগঞ্জ', 'bakerganj.barisal.gov.bd', NULL, NULL),
(251, 33, 'Babuganj', 'বাবুগঞ্জ', 'babuganj.barisal.gov.bd', NULL, NULL),
(252, 33, 'Wazirpur', 'উজিরপুর', 'wazirpur.barisal.gov.bd', NULL, NULL),
(253, 33, 'Banaripara', 'বানারীপাড়া', 'banaripara.barisal.gov.bd', NULL, NULL),
(254, 33, 'Gournadi', 'গৌরনদী', 'gournadi.barisal.gov.bd', NULL, NULL),
(255, 33, 'Agailjhara', 'আগৈলঝাড়া', 'agailjhara.barisal.gov.bd', NULL, NULL),
(256, 33, 'Mehendiganj', 'মেহেন্দিগঞ্জ', 'mehendiganj.barisal.gov.bd', NULL, NULL),
(257, 33, 'Muladi', 'মুলাদী', 'muladi.barisal.gov.bd', NULL, NULL),
(258, 33, 'Hizla', 'হিজলা', 'hizla.barisal.gov.bd', NULL, NULL),
(259, 34, 'Bhola Sadar', 'ভোলা সদর', 'sadar.bhola.gov.bd', NULL, NULL),
(260, 34, 'Borhan Sddin', 'বোরহান উদ্দিন', 'borhanuddin.bhola.gov.bd', NULL, NULL),
(261, 34, 'Charfesson', 'চরফ্যাশন', 'charfesson.bhola.gov.bd', NULL, NULL),
(262, 34, 'Doulatkhan', 'দৌলতখান', 'doulatkhan.bhola.gov.bd', NULL, NULL),
(263, 34, 'Monpura', 'মনপুরা', 'monpura.bhola.gov.bd', NULL, NULL),
(264, 34, 'Tazumuddin', 'তজুমদ্দিন', 'tazumuddin.bhola.gov.bd', NULL, NULL),
(265, 34, 'Lalmohan', 'লালমোহন', 'lalmohan.bhola.gov.bd', NULL, NULL),
(266, 35, 'Amtali', 'আমতলী', 'amtali.barguna.gov.bd', NULL, NULL),
(267, 35, 'Barguna Sadar', 'বরগুনা সদর', 'sadar.barguna.gov.bd', NULL, NULL),
(268, 35, 'Betagi', 'বেতাগী', 'betagi.barguna.gov.bd', NULL, NULL),
(269, 35, 'Bamna', 'বামনা', 'bamna.barguna.gov.bd', NULL, NULL),
(270, 35, 'Pathorghata', 'পাথরঘাটা', 'pathorghata.barguna.gov.bd', NULL, NULL),
(271, 35, 'Taltali', 'তালতলি', 'taltali.barguna.gov.bd', NULL, NULL),
(272, 36, 'Balaganj', 'বালাগঞ্জ', 'balaganj.sylhet.gov.bd', NULL, NULL),
(273, 36, 'Beanibazar', 'বিয়ানীবাজার', 'beanibazar.sylhet.gov.bd', NULL, NULL),
(274, 36, 'Bishwanath', 'বিশ্বনাথ', 'bishwanath.sylhet.gov.bd', NULL, NULL),
(275, 36, 'Companiganj', 'কোম্পানীগঞ্জ', 'companiganj.sylhet.gov.bd', NULL, NULL),
(276, 36, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', 'fenchuganj.sylhet.gov.bd', NULL, NULL),
(277, 36, 'Golapganj', 'গোলাপগঞ্জ', 'golapganj.sylhet.gov.bd', NULL, NULL),
(278, 36, 'Gowainghat', 'গোয়াইনঘাট', 'gowainghat.sylhet.gov.bd', NULL, NULL),
(279, 36, 'Jaintiapur', 'জৈন্তাপুর', 'jaintiapur.sylhet.gov.bd', NULL, NULL),
(280, 36, 'Kanaighat', 'কানাইঘাট', 'kanaighat.sylhet.gov.bd', NULL, NULL),
(281, 36, 'Sylhet Sadar', 'সিলেট সদর', 'sylhetsadar.sylhet.gov.bd', NULL, NULL),
(282, 36, 'Zakiganj', 'জকিগঞ্জ', 'zakiganj.sylhet.gov.bd', NULL, NULL),
(283, 36, 'Dakshinsurma', 'দক্ষিণ সুরমা', 'dakshinsurma.sylhet.gov.bd', NULL, NULL),
(284, 36, 'Osmaninagar', 'ওসমানী নগর', 'osmaninagar.sylhet.gov.bd', NULL, NULL),
(285, 37, 'Barlekha', 'বড়লেখা', 'barlekha.moulvibazar.gov.bd', NULL, NULL),
(286, 37, 'Kamolganj', 'কমলগঞ্জ', 'kamolganj.moulvibazar.gov.bd', NULL, NULL),
(287, 37, 'Kulaura', 'কুলাউড়া', 'kulaura.moulvibazar.gov.bd', NULL, NULL),
(288, 37, 'Moulvibazar Sadar', 'মৌলভীবাজার সদর', 'moulvibazarsadar.moulvibazar.gov.bd', NULL, NULL),
(289, 37, 'Rajnagar', 'রাজনগর', 'rajnagar.moulvibazar.gov.bd', NULL, NULL),
(290, 37, 'Sreemangal', 'শ্রীমঙ্গল', 'sreemangal.moulvibazar.gov.bd', NULL, NULL),
(291, 37, 'Juri', 'জুড়ী', 'juri.moulvibazar.gov.bd', NULL, NULL),
(292, 38, 'Nabiganj', 'নবীগঞ্জ', 'nabiganj.habiganj.gov.bd', NULL, NULL),
(293, 38, 'Bahubal', 'বাহুবল', 'bahubal.habiganj.gov.bd', NULL, NULL),
(294, 38, 'Ajmiriganj', 'আজমিরীগঞ্জ', 'ajmiriganj.habiganj.gov.bd', NULL, NULL),
(295, 38, 'Baniachong', 'বানিয়াচং', 'baniachong.habiganj.gov.bd', NULL, NULL),
(296, 38, 'Lakhai', 'লাখাই', 'lakhai.habiganj.gov.bd', NULL, NULL),
(297, 38, 'Chunarughat', 'চুনারুঘাট', 'chunarughat.habiganj.gov.bd', NULL, NULL),
(298, 38, 'Habiganj Sadar', 'হবিগঞ্জ সদর', 'habiganjsadar.habiganj.gov.bd', NULL, NULL),
(299, 38, 'Madhabpur', 'মাধবপুর', 'madhabpur.habiganj.gov.bd', NULL, NULL),
(300, 39, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', 'sadar.sunamganj.gov.bd', NULL, NULL),
(301, 39, 'South Sunamganj', 'দক্ষিণ সুনামগঞ্জ', 'southsunamganj.sunamganj.gov.bd', NULL, NULL),
(302, 39, 'Bishwambarpur', 'বিশ্বম্ভরপুর', 'bishwambarpur.sunamganj.gov.bd', NULL, NULL),
(303, 39, 'Chhatak', 'ছাতক', 'chhatak.sunamganj.gov.bd', NULL, NULL),
(304, 39, 'Jagannathpur', 'জগন্নাথপুর', 'jagannathpur.sunamganj.gov.bd', NULL, NULL),
(305, 39, 'Dowarabazar', 'দোয়ারাবাজার', 'dowarabazar.sunamganj.gov.bd', NULL, NULL),
(306, 39, 'Tahirpur', 'তাহিরপুর', 'tahirpur.sunamganj.gov.bd', NULL, NULL),
(307, 39, 'Dharmapasha', 'ধর্মপাশা', 'dharmapasha.sunamganj.gov.bd', NULL, NULL),
(308, 39, 'Jamalganj', 'জামালগঞ্জ', 'jamalganj.sunamganj.gov.bd', NULL, NULL),
(309, 39, 'Shalla', 'শাল্লা', 'shalla.sunamganj.gov.bd', NULL, NULL),
(310, 39, 'Derai', 'দিরাই', 'derai.sunamganj.gov.bd', NULL, NULL),
(311, 40, 'Belabo', 'বেলাবো', 'belabo.narsingdi.gov.bd', NULL, NULL),
(312, 40, 'Monohardi', 'মনোহরদী', 'monohardi.narsingdi.gov.bd', NULL, NULL),
(313, 40, 'Narsingdi Sadar', 'নরসিংদী সদর', 'narsingdisadar.narsingdi.gov.bd', NULL, NULL),
(314, 40, 'Palash', 'পলাশ', 'palash.narsingdi.gov.bd', NULL, NULL),
(315, 40, 'Raipura', 'রায়পুরা', 'raipura.narsingdi.gov.bd', NULL, NULL),
(316, 40, 'Shibpur', 'শিবপুর', 'shibpur.narsingdi.gov.bd', NULL, NULL),
(317, 41, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.gazipur.gov.bd', NULL, NULL),
(318, 41, 'Kaliakair', 'কালিয়াকৈর', 'kaliakair.gazipur.gov.bd', NULL, NULL),
(319, 41, 'Kapasia', 'কাপাসিয়া', 'kapasia.gazipur.gov.bd', NULL, NULL),
(320, 41, 'Gazipur Sadar', 'গাজীপুর সদর', 'sadar.gazipur.gov.bd', NULL, NULL),
(321, 41, 'Sreepur', 'শ্রীপুর', 'sreepur.gazipur.gov.bd', NULL, NULL),
(322, 42, 'Shariatpur Sadar', 'শরিয়তপুর সদর', 'sadar.shariatpur.gov.bd', NULL, NULL),
(323, 42, 'Naria', 'নড়িয়া', 'naria.shariatpur.gov.bd', NULL, NULL),
(324, 42, 'Zajira', 'জাজিরা', 'zajira.shariatpur.gov.bd', NULL, NULL),
(325, 42, 'Gosairhat', 'গোসাইরহাট', 'gosairhat.shariatpur.gov.bd', NULL, NULL),
(326, 42, 'Bhedarganj', 'ভেদরগঞ্জ', 'bhedarganj.shariatpur.gov.bd', NULL, NULL),
(327, 42, 'Damudya', 'ডামুড্যা', 'damudya.shariatpur.gov.bd', NULL, NULL),
(328, 43, 'Araihazar', 'আড়াইহাজার', 'araihazar.narayanganj.gov.bd', NULL, NULL),
(329, 43, 'Bandar', 'বন্দর', 'bandar.narayanganj.gov.bd', NULL, NULL),
(330, 43, 'Narayanganj Sadar', 'নারায়নগঞ্জ সদর', 'narayanganjsadar.narayanganj.gov.bd', NULL, NULL),
(331, 43, 'Rupganj', 'রূপগঞ্জ', 'rupganj.narayanganj.gov.bd', NULL, NULL),
(332, 43, 'Sonargaon', 'সোনারগাঁ', 'sonargaon.narayanganj.gov.bd', NULL, NULL),
(333, 44, 'Basail', 'বাসাইল', 'basail.tangail.gov.bd', NULL, NULL),
(334, 44, 'Bhuapur', 'ভুয়াপুর', 'bhuapur.tangail.gov.bd', NULL, NULL),
(335, 44, 'Delduar', 'দেলদুয়ার', 'delduar.tangail.gov.bd', NULL, NULL),
(336, 44, 'Ghatail', 'ঘাটাইল', 'ghatail.tangail.gov.bd', NULL, NULL),
(337, 44, 'Gopalpur', 'গোপালপুর', 'gopalpur.tangail.gov.bd', NULL, NULL),
(338, 44, 'Madhupur', 'মধুপুর', 'madhupur.tangail.gov.bd', NULL, NULL),
(339, 44, 'Mirzapur', 'মির্জাপুর', 'mirzapur.tangail.gov.bd', NULL, NULL),
(340, 44, 'Nagarpur', 'নাগরপুর', 'nagarpur.tangail.gov.bd', NULL, NULL),
(341, 44, 'Sakhipur', 'সখিপুর', 'sakhipur.tangail.gov.bd', NULL, NULL),
(342, 44, 'Tangail Sadar', 'টাঙ্গাইল সদর', 'tangailsadar.tangail.gov.bd', NULL, NULL),
(343, 44, 'Kalihati', 'কালিহাতী', 'kalihati.tangail.gov.bd', NULL, NULL),
(344, 44, 'Dhanbari', 'ধনবাড়ী', 'dhanbari.tangail.gov.bd', NULL, NULL),
(345, 45, 'Itna', 'ইটনা', 'itna.kishoreganj.gov.bd', NULL, NULL),
(346, 45, 'Katiadi', 'কটিয়াদী', 'katiadi.kishoreganj.gov.bd', NULL, NULL),
(347, 45, 'Bhairab', 'ভৈরব', 'bhairab.kishoreganj.gov.bd', NULL, NULL),
(348, 45, 'Tarail', 'তাড়াইল', 'tarail.kishoreganj.gov.bd', NULL, NULL),
(349, 45, 'Hossainpur', 'হোসেনপুর', 'hossainpur.kishoreganj.gov.bd', NULL, NULL),
(350, 45, 'Pakundia', 'পাকুন্দিয়া', 'pakundia.kishoreganj.gov.bd', NULL, NULL),
(351, 45, 'Kuliarchar', 'কুলিয়ারচর', 'kuliarchar.kishoreganj.gov.bd', NULL, NULL),
(352, 45, 'Kishoreganj Sadar', 'কিশোরগঞ্জ সদর', 'kishoreganjsadar.kishoreganj.gov.bd', NULL, NULL),
(353, 45, 'Karimgonj', 'করিমগঞ্জ', 'karimgonj.kishoreganj.gov.bd', NULL, NULL),
(354, 45, 'Bajitpur', 'বাজিতপুর', 'bajitpur.kishoreganj.gov.bd', NULL, NULL),
(355, 45, 'Austagram', 'অষ্টগ্রাম', 'austagram.kishoreganj.gov.bd', NULL, NULL),
(356, 45, 'Mithamoin', 'মিঠামইন', 'mithamoin.kishoreganj.gov.bd', NULL, NULL),
(357, 45, 'Nikli', 'নিকলী', 'nikli.kishoreganj.gov.bd', NULL, NULL),
(358, 46, 'Harirampur', 'হরিরামপুর', 'harirampur.manikganj.gov.bd', NULL, NULL),
(359, 46, 'Saturia', 'সাটুরিয়া', 'saturia.manikganj.gov.bd', NULL, NULL),
(360, 46, 'Manikganj Sadar', 'মানিকগঞ্জ সদর', 'sadar.manikganj.gov.bd', NULL, NULL),
(361, 46, 'Gior', 'ঘিওর', 'gior.manikganj.gov.bd', NULL, NULL),
(362, 46, 'Shibaloy', 'শিবালয়', 'shibaloy.manikganj.gov.bd', NULL, NULL),
(363, 46, 'Doulatpur', 'দৌলতপুর', 'doulatpur.manikganj.gov.bd', NULL, NULL),
(364, 46, 'Singiar', 'সিংগাইর', 'singiar.manikganj.gov.bd', NULL, NULL),
(365, 47, 'Savar', 'সাভার', 'savar.dhaka.gov.bd', NULL, NULL),
(366, 47, 'Dhamrai', 'ধামরাই', 'dhamrai.dhaka.gov.bd', NULL, NULL),
(367, 47, 'Keraniganj', 'কেরাণীগঞ্জ', 'keraniganj.dhaka.gov.bd', NULL, NULL),
(368, 47, 'Nawabganj', 'নবাবগঞ্জ', 'nawabganj.dhaka.gov.bd', NULL, NULL),
(369, 47, 'Dohar', 'দোহার', 'dohar.dhaka.gov.bd', NULL, NULL),
(370, 48, 'Munshiganj Sadar', 'মুন্সিগঞ্জ সদর', 'sadar.munshiganj.gov.bd', NULL, NULL),
(371, 48, 'Sreenagar', 'শ্রীনগর', 'sreenagar.munshiganj.gov.bd', NULL, NULL),
(372, 48, 'Sirajdikhan', 'সিরাজদিখান', 'sirajdikhan.munshiganj.gov.bd', NULL, NULL),
(373, 48, 'Louhajanj', 'লৌহজং', 'louhajanj.munshiganj.gov.bd', NULL, NULL),
(374, 48, 'Gajaria', 'গজারিয়া', 'gajaria.munshiganj.gov.bd', NULL, NULL),
(375, 48, 'Tongibari', 'টংগীবাড়ি', 'tongibari.munshiganj.gov.bd', NULL, NULL),
(376, 49, 'Rajbari Sadar', 'রাজবাড়ী সদর', 'sadar.rajbari.gov.bd', NULL, NULL),
(377, 49, 'Goalanda', 'গোয়ালন্দ', 'goalanda.rajbari.gov.bd', NULL, NULL),
(378, 49, 'Pangsa', 'পাংশা', 'pangsa.rajbari.gov.bd', NULL, NULL),
(379, 49, 'Baliakandi', 'বালিয়াকান্দি', 'baliakandi.rajbari.gov.bd', NULL, NULL),
(380, 49, 'Kalukhali', 'কালুখালী', 'kalukhali.rajbari.gov.bd', NULL, NULL),
(381, 50, 'Madaripur Sadar', 'মাদারীপুর সদর', 'sadar.madaripur.gov.bd', NULL, NULL),
(382, 50, 'Shibchar', 'শিবচর', 'shibchar.madaripur.gov.bd', NULL, NULL),
(383, 50, 'Kalkini', 'কালকিনি', 'kalkini.madaripur.gov.bd', NULL, NULL),
(384, 50, 'Rajoir', 'রাজৈর', 'rajoir.madaripur.gov.bd', NULL, NULL),
(385, 51, 'Gopalganj Sadar', 'গোপালগঞ্জ সদর', 'sadar.gopalganj.gov.bd', NULL, NULL),
(386, 51, 'Kashiani', 'কাশিয়ানী', 'kashiani.gopalganj.gov.bd', NULL, NULL),
(387, 51, 'Tungipara', 'টুংগীপাড়া', 'tungipara.gopalganj.gov.bd', NULL, NULL),
(388, 51, 'Kotalipara', 'কোটালীপাড়া', 'kotalipara.gopalganj.gov.bd', NULL, NULL),
(389, 51, 'Muksudpur', 'মুকসুদপুর', 'muksudpur.gopalganj.gov.bd', NULL, NULL),
(390, 52, 'Faridpur Sadar', 'ফরিদপুর সদর', 'sadar.faridpur.gov.bd', NULL, NULL),
(391, 52, 'Alfadanga', 'আলফাডাঙ্গা', 'alfadanga.faridpur.gov.bd', NULL, NULL),
(392, 52, 'Boalmari', 'বোয়ালমারী', 'boalmari.faridpur.gov.bd', NULL, NULL),
(393, 52, 'Sadarpur', 'সদরপুর', 'sadarpur.faridpur.gov.bd', NULL, NULL),
(394, 52, 'Nagarkanda', 'নগরকান্দা', 'nagarkanda.faridpur.gov.bd', NULL, NULL),
(395, 52, 'Bhanga', 'ভাঙ্গা', 'bhanga.faridpur.gov.bd', NULL, NULL),
(396, 52, 'Charbhadrasan', 'চরভদ্রাসন', 'charbhadrasan.faridpur.gov.bd', NULL, NULL),
(397, 52, 'Madhukhali', 'মধুখালী', 'madhukhali.faridpur.gov.bd', NULL, NULL),
(398, 52, 'Saltha', 'সালথা', 'saltha.faridpur.gov.bd', NULL, NULL),
(399, 53, 'Panchagarh Sadar', 'পঞ্চগড় সদর', 'panchagarhsadar.panchagarh.gov.bd', NULL, NULL),
(400, 53, 'Debiganj', 'দেবীগঞ্জ', 'debiganj.panchagarh.gov.bd', NULL, NULL),
(401, 53, 'Boda', 'বোদা', 'boda.panchagarh.gov.bd', NULL, NULL),
(402, 53, 'Atwari', 'আটোয়ারী', 'atwari.panchagarh.gov.bd', NULL, NULL),
(403, 53, 'Tetulia', 'তেতুলিয়া', 'tetulia.panchagarh.gov.bd', NULL, NULL),
(404, 54, 'Nawabganj', 'নবাবগঞ্জ', 'nawabganj.dinajpur.gov.bd', NULL, NULL),
(405, 54, 'Birganj', 'বীরগঞ্জ', 'birganj.dinajpur.gov.bd', NULL, NULL),
(406, 54, 'Ghoraghat', 'ঘোড়াঘাট', 'ghoraghat.dinajpur.gov.bd', NULL, NULL),
(407, 54, 'Birampur', 'বিরামপুর', 'birampur.dinajpur.gov.bd', NULL, NULL),
(408, 54, 'Parbatipur', 'পার্বতীপুর', 'parbatipur.dinajpur.gov.bd', NULL, NULL),
(409, 54, 'Bochaganj', 'বোচাগঞ্জ', 'bochaganj.dinajpur.gov.bd', NULL, NULL),
(410, 54, 'Kaharol', 'কাহারোল', 'kaharol.dinajpur.gov.bd', NULL, NULL),
(411, 54, 'Fulbari', 'ফুলবাড়ী', 'fulbari.dinajpur.gov.bd', NULL, NULL),
(412, 54, 'Dinajpur Sadar', 'দিনাজপুর সদর', 'dinajpursadar.dinajpur.gov.bd', NULL, NULL),
(413, 54, 'Hakimpur', 'হাকিমপুর', 'hakimpur.dinajpur.gov.bd', NULL, NULL),
(414, 54, 'Khansama', 'খানসামা', 'khansama.dinajpur.gov.bd', NULL, NULL),
(415, 54, 'Birol', 'বিরল', 'birol.dinajpur.gov.bd', NULL, NULL),
(416, 54, 'Chirirbandar', 'চিরিরবন্দর', 'chirirbandar.dinajpur.gov.bd', NULL, NULL),
(417, 55, 'Lalmonirhat Sadar', 'লালমনিরহাট সদর', 'sadar.lalmonirhat.gov.bd', NULL, NULL),
(418, 55, 'Kaliganj', 'কালীগঞ্জ', 'kaliganj.lalmonirhat.gov.bd', NULL, NULL),
(419, 55, 'Hatibandha', 'হাতীবান্ধা', 'hatibandha.lalmonirhat.gov.bd', NULL, NULL),
(420, 55, 'Patgram', 'পাটগ্রাম', 'patgram.lalmonirhat.gov.bd', NULL, NULL),
(421, 55, 'Aditmari', 'আদিতমারী', 'aditmari.lalmonirhat.gov.bd', NULL, NULL),
(422, 56, 'Syedpur', 'সৈয়দপুর', 'syedpur.nilphamari.gov.bd', NULL, NULL),
(423, 56, 'Domar', 'ডোমার', 'domar.nilphamari.gov.bd', NULL, NULL),
(424, 56, 'Dimla', 'ডিমলা', 'dimla.nilphamari.gov.bd', NULL, NULL),
(425, 56, 'Jaldhaka', 'জলঢাকা', 'jaldhaka.nilphamari.gov.bd', NULL, NULL),
(426, 56, 'Kishorganj', 'কিশোরগঞ্জ', 'kishorganj.nilphamari.gov.bd', NULL, NULL),
(427, 56, 'Nilphamari Sadar', 'নীলফামারী সদর', 'nilphamarisadar.nilphamari.gov.bd', NULL, NULL),
(428, 57, 'Sadullapur', 'সাদুল্লাপুর', 'sadullapur.gaibandha.gov.bd', NULL, NULL),
(429, 57, 'Gaibandha Sadar', 'গাইবান্ধা সদর', 'gaibandhasadar.gaibandha.gov.bd', NULL, NULL),
(430, 57, 'Palashbari', 'পলাশবাড়ী', 'palashbari.gaibandha.gov.bd', NULL, NULL),
(431, 57, 'Saghata', 'সাঘাটা', 'saghata.gaibandha.gov.bd', NULL, NULL),
(432, 57, 'Gobindaganj', 'গোবিন্দগঞ্জ', 'gobindaganj.gaibandha.gov.bd', NULL, NULL),
(433, 57, 'Sundarganj', 'সুন্দরগঞ্জ', 'sundarganj.gaibandha.gov.bd', NULL, NULL),
(434, 57, 'Phulchari', 'ফুলছড়ি', 'phulchari.gaibandha.gov.bd', NULL, NULL),
(435, 58, 'Thakurgaon Sadar', 'ঠাকুরগাঁও সদর', 'thakurgaonsadar.thakurgaon.gov.bd', NULL, NULL),
(436, 58, 'Pirganj', 'পীরগঞ্জ', 'pirganj.thakurgaon.gov.bd', NULL, NULL),
(437, 58, 'Ranisankail', 'রাণীশংকৈল', 'ranisankail.thakurgaon.gov.bd', NULL, NULL),
(438, 58, 'Haripur', 'হরিপুর', 'haripur.thakurgaon.gov.bd', NULL, NULL),
(439, 58, 'Baliadangi', 'বালিয়াডাঙ্গী', 'baliadangi.thakurgaon.gov.bd', NULL, NULL),
(440, 59, 'Rangpur Sadar', 'রংপুর সদর', 'rangpursadar.rangpur.gov.bd', NULL, NULL),
(441, 59, 'Gangachara', 'গংগাচড়া', 'gangachara.rangpur.gov.bd', NULL, NULL),
(442, 59, 'Taragonj', 'তারাগঞ্জ', 'taragonj.rangpur.gov.bd', NULL, NULL),
(443, 59, 'Badargonj', 'বদরগঞ্জ', 'badargonj.rangpur.gov.bd', NULL, NULL),
(444, 59, 'Mithapukur', 'মিঠাপুকুর', 'mithapukur.rangpur.gov.bd', NULL, NULL),
(445, 59, 'Pirgonj', 'পীরগঞ্জ', 'pirgonj.rangpur.gov.bd', NULL, NULL),
(446, 59, 'Kaunia', 'কাউনিয়া', 'kaunia.rangpur.gov.bd', NULL, NULL),
(447, 59, 'Pirgacha', 'পীরগাছা', 'pirgacha.rangpur.gov.bd', NULL, NULL),
(448, 60, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', 'kurigramsadar.kurigram.gov.bd', NULL, NULL),
(449, 60, 'Nageshwari', 'নাগেশ্বরী', 'nageshwari.kurigram.gov.bd', NULL, NULL),
(450, 60, 'Bhurungamari', 'ভুরুঙ্গামারী', 'bhurungamari.kurigram.gov.bd', NULL, NULL),
(451, 60, 'Phulbari', 'ফুলবাড়ী', 'phulbari.kurigram.gov.bd', NULL, NULL),
(452, 60, 'Rajarhat', 'রাজারহাট', 'rajarhat.kurigram.gov.bd', NULL, NULL),
(453, 60, 'Ulipur', 'উলিপুর', 'ulipur.kurigram.gov.bd', NULL, NULL),
(454, 60, 'Chilmari', 'চিলমারী', 'chilmari.kurigram.gov.bd', NULL, NULL),
(455, 60, 'Rowmari', 'রৌমারী', 'rowmari.kurigram.gov.bd', NULL, NULL),
(456, 60, 'Charrajibpur', 'চর রাজিবপুর', 'charrajibpur.kurigram.gov.bd', NULL, NULL),
(457, 61, 'Sherpur Sadar', 'শেরপুর সদর', 'sherpursadar.sherpur.gov.bd', NULL, NULL),
(458, 61, 'Nalitabari', 'নালিতাবাড়ী', 'nalitabari.sherpur.gov.bd', NULL, NULL),
(459, 61, 'Sreebordi', 'শ্রীবরদী', 'sreebordi.sherpur.gov.bd', NULL, NULL),
(460, 61, 'Nokla', 'নকলা', 'nokla.sherpur.gov.bd', NULL, NULL),
(461, 61, 'Jhenaigati', 'ঝিনাইগাতী', 'jhenaigati.sherpur.gov.bd', NULL, NULL),
(462, 62, 'Fulbaria', 'ফুলবাড়ীয়া', 'fulbaria.mymensingh.gov.bd', NULL, NULL),
(463, 62, 'Trishal', 'ত্রিশাল', 'trishal.mymensingh.gov.bd', NULL, NULL),
(464, 62, 'Bhaluka', 'ভালুকা', 'bhaluka.mymensingh.gov.bd', NULL, NULL),
(465, 62, 'Muktagacha', 'মুক্তাগাছা', 'muktagacha.mymensingh.gov.bd', NULL, NULL),
(466, 62, 'Mymensingh Sadar', 'ময়মনসিংহ সদর', 'mymensinghsadar.mymensingh.gov.bd', NULL, NULL),
(467, 62, 'Dhobaura', 'ধোবাউড়া', 'dhobaura.mymensingh.gov.bd', NULL, NULL),
(468, 62, 'Phulpur', 'ফুলপুর', 'phulpur.mymensingh.gov.bd', NULL, NULL),
(469, 62, 'Haluaghat', 'হালুয়াঘাট', 'haluaghat.mymensingh.gov.bd', NULL, NULL),
(470, 62, 'Gouripur', 'গৌরীপুর', 'gouripur.mymensingh.gov.bd', NULL, NULL),
(471, 62, 'Gafargaon', 'গফরগাঁও', 'gafargaon.mymensingh.gov.bd', NULL, NULL),
(472, 62, 'Iswarganj', 'ঈশ্বরগঞ্জ', 'iswarganj.mymensingh.gov.bd', NULL, NULL),
(473, 62, 'Nandail', 'নান্দাইল', 'nandail.mymensingh.gov.bd', NULL, NULL),
(474, 62, 'Tarakanda', 'তারাকান্দা', 'tarakanda.mymensingh.gov.bd', NULL, NULL),
(475, 63, 'Jamalpur Sadar', 'জামালপুর সদর', 'jamalpursadar.jamalpur.gov.bd', NULL, NULL),
(476, 63, 'Melandah', 'মেলান্দহ', 'melandah.jamalpur.gov.bd', NULL, NULL),
(477, 63, 'Islampur', 'ইসলামপুর', 'islampur.jamalpur.gov.bd', NULL, NULL),
(478, 63, 'Dewangonj', 'দেওয়ানগঞ্জ', 'dewangonj.jamalpur.gov.bd', NULL, NULL),
(479, 63, 'Sarishabari', 'সরিষাবাড়ী', 'sarishabari.jamalpur.gov.bd', NULL, NULL),
(480, 63, 'Madarganj', 'মাদারগঞ্জ', 'madarganj.jamalpur.gov.bd', NULL, NULL),
(481, 63, 'Bokshiganj', 'বকশীগঞ্জ', 'bokshiganj.jamalpur.gov.bd', NULL, NULL),
(482, 64, 'Barhatta', 'বারহাট্টা', 'barhatta.netrokona.gov.bd', NULL, NULL),
(483, 64, 'Durgapur', 'দুর্গাপুর', 'durgapur.netrokona.gov.bd', NULL, NULL),
(484, 64, 'Kendua', 'কেন্দুয়া', 'kendua.netrokona.gov.bd', NULL, NULL),
(485, 64, 'Atpara', 'আটপাড়া', 'atpara.netrokona.gov.bd', NULL, NULL),
(486, 64, 'Madan', 'মদন', 'madan.netrokona.gov.bd', NULL, NULL),
(487, 64, 'Khaliajuri', 'খালিয়াজুরী', 'khaliajuri.netrokona.gov.bd', NULL, NULL),
(488, 64, 'Kalmakanda', 'কলমাকান্দা', 'kalmakanda.netrokona.gov.bd', NULL, NULL),
(489, 64, 'Mohongonj', 'মোহনগঞ্জ', 'mohongonj.netrokona.gov.bd', NULL, NULL),
(490, 64, 'Purbadhala', 'পূর্বধলা', 'purbadhala.netrokona.gov.bd', NULL, NULL),
(491, 64, 'Netrokona Sadar', 'নেত্রকোণা সদর', 'netrokonasadar.netrokona.gov.bd', NULL, NULL),
(492, 65, 'Adabar Thana', 'আদাবর থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(493, 65, 'Azampur Thana', 'আজমপুর থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(494, 65, 'Badda Thana', 'বাড্ডা থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(495, 65, 'Bangsal Thana', 'বংশাল থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(496, 65, 'Bimanbandar Thana (Dhaka)', 'বিমানবন্দর থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(497, 65, 'Cantonment Thana', 'ক্যান্টনমেন্ট থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(498, 65, 'Chowkbazar Thana', 'চকবাজার থানা ', 'debidwar.comilla.gov.bd', NULL, NULL),
(499, 65, 'Darus Salam Thana', 'দারুস সালাম থানা ', 'debidwar.comilla.gov.bd', NULL, NULL),
(500, 65, 'Demra Thana', 'ডেমরা থানা ', 'debidwar.comilla.gov.bd', NULL, NULL),
(501, 65, 'Dhanmondi Thana', 'ধানমন্ডি থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(502, 65, 'Gendaria Thana', 'গেন্ডারিয়া থানা ', 'debidwar.comilla.gov.bd', NULL, NULL),
(503, 65, 'Hazaribagh Thana', 'হাজারিবাঘ থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(504, 65, 'Kadamtali Thana', 'কদমতলি থানা ', 'debidwar.comilla.gov.bd', NULL, NULL),
(505, 65, 'Kafrul Thana', 'কাফরুল থানা ', 'debidwar.comilla.gov.bd', NULL, NULL),
(506, 65, 'Kalabagan Thana', 'কলাবাগান থানা ', 'debidwar.comilla.gov.bd', NULL, NULL),
(507, 65, 'Kamrangirchar Thana', 'কামরাংগিচর থানা ', 'debidwar.comilla.gov.bd', NULL, NULL),
(508, 65, 'Khilgaon Thana', 'খিলগাঁ থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(509, 65, 'Khilkhet Thana', 'খিলখেত থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(510, 65, 'Kotwali Thana (Dhaka)', 'কতোয়াখালি থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(511, 65, 'Lalbagh Thana', 'লালবাঘ থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(512, 65, 'Mirpur Model Thana', 'মিরপুর থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(513, 65, 'Mohammadpur Thana', 'মুহাম্মাদপুর থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(514, 65, 'Motijheel Thana', 'মতিঝিল থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(515, 65, 'New Market Thana', 'নিউ মার্কেট থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(516, 65, 'Pallabi Thana', 'পল্লবি থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(517, 65, 'Paltan Thana', 'পল্টন থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(518, 65, 'Panthapath Thana', 'পান্থপথ থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(519, 65, 'Ramna Thana', 'রমনা থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(520, 65, 'Rampura Thana', 'রামপুরা থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(521, 65, 'Sabujbagh Thana', 'সবুজবাঘ থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(522, 65, 'Shah Ali Thana', 'সাহ্‌ আলী থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(523, 65, 'Shahbag Thana', 'শাহ্‌বাগ থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(524, 65, 'Sher-e-Bangla Nagar', 'শেরে-ই-বাংলা নগর থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(525, 65, 'Shyampur Thana', 'শ্যামপুর থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(526, 65, 'Sutrapur Thana', 'সুত্রাপুর থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(527, 65, 'Tejgaon Industrial Area Thana', 'তেজগাঁও ইন্ডাস্ট্রিয়াল থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(528, 65, 'Tejgaon Thana', 'তেজগাঁও থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(529, 65, 'Turag Thana', 'তুরাগ থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(530, 65, 'Uttar Khan Thana', 'উত্তর খান থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(531, 65, 'Uttara West Thana', 'উত্তরা পশ্চিম থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(532, 65, 'Vatara Thana', 'ভাটারা থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(533, 65, 'Wari Thana', 'ওয়ারি থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(534, 65, 'Uttara East Thana', 'উত্তরা পূর্ব থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(535, 65, 'Dakshinkhan Thana', 'দক্ষিনখান থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(536, 66, 'Akbarshah Thana', 'আকবরশাহ থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(537, 66, 'Bakoliya Thana', 'বাকোলিয়া থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(538, 66, 'Bandar Thana', 'বন্দর থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(539, 66, 'Bayazid Thana', 'বায়জিদ থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(540, 66, 'Bhujpur Thana', 'ভুজপুর থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(541, 66, 'Chandgaon Thana', 'চন্দগন থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(542, 66, 'Chaowkbazar Thana', 'চকবাজার থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(543, 66, 'Chittagong Kotwali Thana', 'চিটাগাং থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(544, 66, 'Double Mooring Thana', 'ডাবল মর্নিং থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(545, 66, 'EPZ Thana Thana', 'ইপিজেড থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(546, 66, 'Halishahar Thana', 'হালিশাহার থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(547, 66, 'Karnaphuli Thana', 'কর্ণফুলি থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(548, 66, 'Khulshi Thana', 'খুলসি থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(549, 66, 'Kotwali Thana (Chittagong)', 'কতোয়াখালি থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(550, 66, 'Pahartali Thana', 'পাহারতলি থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(551, 66, 'Panchlaish Thana', 'পাঞ্চলাইস থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(552, 66, 'Patenga Thana', 'পতেংগা থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(553, 65, 'Gulshan Thana', 'গুলশান থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(554, 65, 'Banani Thana', 'বনানী থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(555, 72, 'Sadar Thana', 'সদর/জয়দেবপুর থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(556, 72, 'Bason Thana', 'বাসন থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(557, 72, 'Konabari Thana', 'কোনাবাড়ী থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(558, 72, 'Kashimpur Thana', 'কাশিমপুর থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(559, 72, 'Gacha Thana', 'গাছা থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(560, 72, 'Pubail Thana', 'পূবাইল থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(561, 72, 'Tongi West Thana', 'টঙ্গী পশ্চিম থানা', 'debidwar.comilla.gov.bd', NULL, NULL),
(562, 72, 'Tongi East Thana', 'টঙ্গী পূর্ব থানা', 'debidwar.comilla.gov.bd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `weight_ranges`
--

CREATE TABLE `weight_ranges` (
  `id` bigint UNSIGNED NOT NULL,
  `min_weight` varchar(191) NOT NULL,
  `max_weight` varchar(191) NOT NULL,
  `code` int DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `weight_ranges`
--

INSERT INTO `weight_ranges` (`id`, `min_weight`, `max_weight`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, '0', '1', 1, 'active', NULL, NULL),
(2, '1', '2', 2, 'active', NULL, NULL),
(3, '2', '5', 3, 'active', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_mobile_unique` (`mobile`),
  ADD KEY `admins_hub_id_foreign` (`hub_id`);

--
-- Indexes for table `advances`
--
ALTER TABLE `advances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advances_hub_id_foreign` (`hub_id`),
  ADD KEY `advances_created_for_admin_foreign` (`created_for_admin`),
  ADD KEY `advances_created_for_rider_foreign` (`created_for_rider`),
  ADD KEY `advances_created_by_foreign` (`created_by`),
  ADD KEY `advances_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `areas_area_code_unique` (`area_code`),
  ADD KEY `areas_city_type_id_foreign` (`city_type_id`),
  ADD KEY `areas_district_id_foreign` (`district_id`),
  ADD KEY `areas_upazila_id_foreign` (`upazila_id`);

--
-- Indexes for table `assign_areas`
--
ALTER TABLE `assign_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_areas_area_id_foreign` (`area_id`),
  ADD KEY `assign_areas_sub_area_id_foreign` (`sub_area_id`);

--
-- Indexes for table `bad_debts`
--
ALTER TABLE `bad_debts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bad_debts_hub_id_foreign` (`hub_id`),
  ADD KEY `bad_debts_created_by_foreign` (`created_by`),
  ADD KEY `bad_debts_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `bad_debt_adjusts`
--
ALTER TABLE `bad_debt_adjusts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bad_debt_adjusts_bad_debt_id_foreign` (`bad_debt_id`),
  ADD KEY `bad_debt_adjusts_created_by_foreign` (`created_by`),
  ADD KEY `bad_debt_adjusts_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banks_name_unique` (`name`),
  ADD KEY `banks_payment_method_id_foreign` (`payment_method_id`);

--
-- Indexes for table `cancle_invoices`
--
ALTER TABLE `cancle_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cancle_invoices_merchant_id_foreign` (`merchant_id`),
  ADD KEY `cancle_invoices_hub_id_foreign` (`hub_id`);

--
-- Indexes for table `cancle_invoice_items`
--
ALTER TABLE `cancle_invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cancle_invoice_items_parcel_id_foreign` (`parcel_id`),
  ADD KEY `cancle_invoice_items_cancle_invoice_id_foreign` (`cancle_invoice_id`);

--
-- Indexes for table `city_types`
--
ALTER TABLE `city_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `city_types_name_unique` (`name`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `collections_parcel_id_unique` (`parcel_id`),
  ADD KEY `collections_merchant_id_foreign` (`merchant_id`),
  ADD KEY `collections_tracking_id_foreign` (`tracking_id`),
  ADD KEY `collections_rider_collected_by_foreign` (`rider_collected_by`),
  ADD KEY `collections_incharge_collected_by_foreign` (`incharge_collected_by`),
  ADD KEY `collections_accounts_collected_by_foreign` (`accounts_collected_by`),
  ADD KEY `collections_rider_collection_transfer_for_foreign` (`rider_collection_transfer_for`),
  ADD KEY `collections_incharge_collection_transfer_for_foreign` (`incharge_collection_transfer_for`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaints_merchant_id_foreign` (`merchant_id`);

--
-- Indexes for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_charges_merchant_id_foreign` (`merchant_id`),
  ADD KEY `delivery_charges_city_type_id_foreign` (`city_type_id`),
  ADD KEY `delivery_charges_weight_range_id_foreign` (`weight_range_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expense_head_id_foreign` (`expense_head_id`),
  ADD KEY `expenses_hub_id_foreign` (`hub_id`),
  ADD KEY `expenses_created_by_foreign` (`created_by`),
  ADD KEY `expenses_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `expense_heads`
--
ALTER TABLE `expense_heads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_heads_hub_id_foreign` (`hub_id`),
  ADD KEY `expense_heads_created_by_foreign` (`created_by`),
  ADD KEY `expense_heads_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hubs`
--
ALTER TABLE `hubs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hubs_hub_code_unique` (`hub_code`),
  ADD KEY `hubs_area_id_foreign` (`area_id`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investments_hub_id_foreign` (`hub_id`),
  ADD KEY `investments_created_by_foreign` (`created_by`),
  ADD KEY `investments_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_hub_id_foreign` (`hub_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_parcel_id_foreign` (`parcel_id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_hub_id_foreign` (`hub_id`),
  ADD KEY `loans_created_by_foreign` (`created_by`),
  ADD KEY `loans_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `loan_adjustments`
--
ALTER TABLE `loan_adjustments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_adjustments_loan_id_foreign` (`loan_id`),
  ADD KEY `loan_adjustments_created_by_foreign` (`created_by`),
  ADD KEY `loan_adjustments_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `merchants_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `merchants_email_unique` (`email`),
  ADD UNIQUE KEY `merchants_website_url_unique` (`website_url`),
  ADD UNIQUE KEY `merchants_prefix_unique` (`prefix`),
  ADD UNIQUE KEY `merchants_facebook_page_unique` (`facebook_page`),
  ADD KEY `merchants_hub_id_foreign` (`hub_id`),
  ADD KEY `merchants_area_id_foreign` (`area_id`),
  ADD KEY `merchants_created_by_foreign` (`created_by`);

--
-- Indexes for table `merchant_bank_accounts`
--
ALTER TABLE `merchant_bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `merchant_bank_accounts_merchant_id_foreign` (`merchant_id`),
  ADD KEY `merchant_bank_accounts_bank_id_foreign` (`bank_id`);

--
-- Indexes for table `merchant_mobile_bankings`
--
ALTER TABLE `merchant_mobile_bankings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `merchant_mobile_bankings_merchant_id_foreign` (`merchant_id`),
  ADD KEY `merchant_mobile_bankings_mobile_banking_id_foreign` (`mobile_banking_id`);

--
-- Indexes for table `merchant_payment_methods`
--
ALTER TABLE `merchant_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `merchant_payment_methods_merchant_id_foreign` (`merchant_id`),
  ADD KEY `merchant_payment_methods_payment_method_id_foreign` (`payment_method_id`);

--
-- Indexes for table `merchant_pickup_methods`
--
ALTER TABLE `merchant_pickup_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `merchant_pickup_methods_hub_id_foreign` (`hub_id`),
  ADD KEY `merchant_pickup_methods_merchant_id_foreign` (`merchant_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_bankings`
--
ALTER TABLE `mobile_bankings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile_bankings_name_unique` (`name`),
  ADD KEY `mobile_bankings_payment_method_id_foreign` (`payment_method_id`);

--
-- Indexes for table `mobile_banking_collections`
--
ALTER TABLE `mobile_banking_collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mobile_banking_collections_parcel_id_foreign` (`parcel_id`),
  ADD KEY `mobile_banking_collections_mobile_banking_id_foreign` (`mobile_banking_id`),
  ADD KEY `mobile_banking_collections_merchant_mobile_banking_id_foreign` (`merchant_mobile_banking_id`);

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
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `otps_parcel_id_unique` (`parcel_id`);

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parcels_tracking_id_unique` (`tracking_id`),
  ADD KEY `parcels_hub_id_foreign` (`hub_id`),
  ADD KEY `parcels_city_type_id_foreign` (`city_type_id`),
  ADD KEY `parcels_area_id_foreign` (`area_id`),
  ADD KEY `parcels_sub_area_id_foreign` (`sub_area_id`),
  ADD KEY `parcels_merchant_id_foreign` (`merchant_id`),
  ADD KEY `parcels_weight_range_id_foreign` (`weight_range_id`),
  ADD KEY `parcels_parcel_type_id_foreign` (`parcel_type_id`),
  ADD KEY `parcels_assigning_by_foreign` (`assigning_by`),
  ADD KEY `parcels_added_by_admin_foreign` (`added_by_admin`),
  ADD KEY `parcels_added_by_merchant_foreign` (`added_by_merchant`);

--
-- Indexes for table `parcel_notes`
--
ALTER TABLE `parcel_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcel_notes_parcel_id_foreign` (`parcel_id`),
  ADD KEY `parcel_notes_admin_id_foreign` (`admin_id`),
  ADD KEY `parcel_notes_merchant_id_foreign` (`merchant_id`),
  ADD KEY `parcel_notes_rider_id_foreign` (`rider_id`);

--
-- Indexes for table `parcel_reassigns`
--
ALTER TABLE `parcel_reassigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcel_times`
--
ALTER TABLE `parcel_times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcel_times_parcel_id_foreign` (`parcel_id`);

--
-- Indexes for table `parcel_transfers`
--
ALTER TABLE `parcel_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcel_transfers_parcel_id_foreign` (`parcel_id`),
  ADD KEY `parcel_transfers_transfer_by_foreign` (`transfer_by`),
  ADD KEY `parcel_transfers_transfer_for_foreign` (`transfer_for`),
  ADD KEY `parcel_transfers_transfer_sub_area_foreign` (`transfer_sub_area`),
  ADD KEY `parcel_transfers_accept_or_reject_by_foreign` (`accept_or_reject_by`);

--
-- Indexes for table `parcel_types`
--
ALTER TABLE `parcel_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parcel_types_name_unique` (`name`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_methods_name_unique` (`name`);

--
-- Indexes for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_requests_merchant_id_foreign` (`merchant_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pickup_requests_hub_id_foreign` (`hub_id`),
  ADD KEY `pickup_requests_merchant_id_foreign` (`merchant_id`),
  ADD KEY `pickup_requests_assigning_by_foreign` (`assigning_by`);

--
-- Indexes for table `print_parcels`
--
ALTER TABLE `print_parcels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `print_parcels_rider_id_foreign` (`rider_id`);

--
-- Indexes for table `print_parcel_items`
--
ALTER TABLE `print_parcel_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `print_parcel_items_print_parcel_id_foreign` (`print_parcel_id`),
  ADD KEY `print_parcel_items_parcel_id_foreign` (`parcel_id`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reasons_reason_type_id_foreign` (`reason_type_id`);

--
-- Indexes for table `reason_types`
--
ALTER TABLE `reason_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riders`
--
ALTER TABLE `riders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `riders_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `riders_rider_code_unique` (`rider_code`),
  ADD UNIQUE KEY `riders_email_unique` (`email`),
  ADD UNIQUE KEY `riders_nid_unique` (`nid`),
  ADD KEY `riders_hub_id_foreign` (`hub_id`),
  ADD KEY `riders_area_id_foreign` (`area_id`);

--
-- Indexes for table `rider_collections`
--
ALTER TABLE `rider_collections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rider_collections_parcel_id_unique` (`parcel_id`),
  ADD KEY `rider_collections_merchant_id_foreign` (`merchant_id`),
  ADD KEY `rider_collections_tracking_id_foreign` (`tracking_id`),
  ADD KEY `rider_collections_rider_collected_by_foreign` (`rider_collected_by`),
  ADD KEY `rider_collections_incharge_collected_by_foreign` (`incharge_collected_by`),
  ADD KEY `rider_collections_accounts_collected_by_foreign` (`accounts_collected_by`);

--
-- Indexes for table `rider_transactions`
--
ALTER TABLE `rider_transactions`
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
-- Indexes for table `sms_configures`
--
ALTER TABLE `sms_configures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sms_configures_hub_id_foreign` (`hub_id`);

--
-- Indexes for table `sms_settings`
--
ALTER TABLE `sms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_meanings`
--
ALTER TABLE `status_meanings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_areas`
--
ALTER TABLE `sub_areas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_areas_code_unique` (`code`),
  ADD KEY `sub_areas_area_id_foreign` (`area_id`);

--
-- Indexes for table `upazilas`
--
ALTER TABLE `upazilas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `weight_ranges`
--
ALTER TABLE `weight_ranges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `weight_ranges_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `advances`
--
ALTER TABLE `advances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assign_areas`
--
ALTER TABLE `assign_areas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bad_debts`
--
ALTER TABLE `bad_debts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bad_debt_adjusts`
--
ALTER TABLE `bad_debt_adjusts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `cancle_invoices`
--
ALTER TABLE `cancle_invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cancle_invoice_items`
--
ALTER TABLE `cancle_invoice_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `city_types`
--
ALTER TABLE `city_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_heads`
--
ALTER TABLE `expense_heads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hubs`
--
ALTER TABLE `hubs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loan_adjustments`
--
ALTER TABLE `loan_adjustments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `merchant_bank_accounts`
--
ALTER TABLE `merchant_bank_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merchant_mobile_bankings`
--
ALTER TABLE `merchant_mobile_bankings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merchant_payment_methods`
--
ALTER TABLE `merchant_payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `merchant_pickup_methods`
--
ALTER TABLE `merchant_pickup_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `mobile_bankings`
--
ALTER TABLE `mobile_bankings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mobile_banking_collections`
--
ALTER TABLE `mobile_banking_collections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `parcel_notes`
--
ALTER TABLE `parcel_notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parcel_reassigns`
--
ALTER TABLE `parcel_reassigns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parcel_times`
--
ALTER TABLE `parcel_times`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `parcel_transfers`
--
ALTER TABLE `parcel_transfers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parcel_types`
--
ALTER TABLE `parcel_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_requests`
--
ALTER TABLE `payment_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `print_parcels`
--
ALTER TABLE `print_parcels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `print_parcel_items`
--
ALTER TABLE `print_parcel_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reason_types`
--
ALTER TABLE `reason_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `riders`
--
ALTER TABLE `riders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rider_collections`
--
ALTER TABLE `rider_collections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rider_transactions`
--
ALTER TABLE `rider_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sms_configures`
--
ALTER TABLE `sms_configures`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_settings`
--
ALTER TABLE `sms_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_meanings`
--
ALTER TABLE `status_meanings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_areas`
--
ALTER TABLE `sub_areas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `upazilas`
--
ALTER TABLE `upazilas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=563;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weight_ranges`
--
ALTER TABLE `weight_ranges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `advances`
--
ALTER TABLE `advances`
  ADD CONSTRAINT `advances_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `advances_created_for_admin_foreign` FOREIGN KEY (`created_for_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `advances_created_for_rider_foreign` FOREIGN KEY (`created_for_rider`) REFERENCES `merchants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `advances_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `advances_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_city_type_id_foreign` FOREIGN KEY (`city_type_id`) REFERENCES `city_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `areas_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `areas_upazila_id_foreign` FOREIGN KEY (`upazila_id`) REFERENCES `upazilas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assign_areas`
--
ALTER TABLE `assign_areas`
  ADD CONSTRAINT `assign_areas_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `assign_areas_sub_area_id_foreign` FOREIGN KEY (`sub_area_id`) REFERENCES `sub_areas` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `bad_debts`
--
ALTER TABLE `bad_debts`
  ADD CONSTRAINT `bad_debts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bad_debts_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bad_debts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `bad_debt_adjusts`
--
ALTER TABLE `bad_debt_adjusts`
  ADD CONSTRAINT `bad_debt_adjusts_bad_debt_id_foreign` FOREIGN KEY (`bad_debt_id`) REFERENCES `bad_debts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bad_debt_adjusts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bad_debt_adjusts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `banks`
--
ALTER TABLE `banks`
  ADD CONSTRAINT `banks_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cancle_invoices`
--
ALTER TABLE `cancle_invoices`
  ADD CONSTRAINT `cancle_invoices_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cancle_invoices_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cancle_invoice_items`
--
ALTER TABLE `cancle_invoice_items`
  ADD CONSTRAINT `cancle_invoice_items_cancle_invoice_id_foreign` FOREIGN KEY (`cancle_invoice_id`) REFERENCES `cancle_invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cancle_invoice_items_parcel_id_foreign` FOREIGN KEY (`parcel_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_accounts_collected_by_foreign` FOREIGN KEY (`accounts_collected_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `collections_incharge_collected_by_foreign` FOREIGN KEY (`incharge_collected_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `collections_incharge_collection_transfer_for_foreign` FOREIGN KEY (`incharge_collection_transfer_for`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `collections_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `collections_parcel_id_foreign` FOREIGN KEY (`parcel_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `collections_rider_collected_by_foreign` FOREIGN KEY (`rider_collected_by`) REFERENCES `riders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `collections_rider_collection_transfer_for_foreign` FOREIGN KEY (`rider_collection_transfer_for`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `collections_tracking_id_foreign` FOREIGN KEY (`tracking_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  ADD CONSTRAINT `delivery_charges_city_type_id_foreign` FOREIGN KEY (`city_type_id`) REFERENCES `city_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_charges_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_charges_weight_range_id_foreign` FOREIGN KEY (`weight_range_id`) REFERENCES `weight_ranges` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `expenses_expense_head_id_foreign` FOREIGN KEY (`expense_head_id`) REFERENCES `expense_heads` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `expenses_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `expenses_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `expense_heads`
--
ALTER TABLE `expense_heads`
  ADD CONSTRAINT `expense_heads_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `expense_heads_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `expense_heads_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `hubs`
--
ALTER TABLE `hubs`
  ADD CONSTRAINT `hubs_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `investments`
--
ALTER TABLE `investments`
  ADD CONSTRAINT `investments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `investments_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `investments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_items_parcel_id_foreign` FOREIGN KEY (`parcel_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loans_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loans_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `loan_adjustments`
--
ALTER TABLE `loan_adjustments`
  ADD CONSTRAINT `loan_adjustments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loan_adjustments_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loan_adjustments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `merchants`
--
ALTER TABLE `merchants`
  ADD CONSTRAINT `merchants_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `merchants_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `merchants_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `merchant_bank_accounts`
--
ALTER TABLE `merchant_bank_accounts`
  ADD CONSTRAINT `merchant_bank_accounts_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `merchant_bank_accounts_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `merchant_mobile_bankings`
--
ALTER TABLE `merchant_mobile_bankings`
  ADD CONSTRAINT `merchant_mobile_bankings_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `merchant_mobile_bankings_mobile_banking_id_foreign` FOREIGN KEY (`mobile_banking_id`) REFERENCES `mobile_bankings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `merchant_payment_methods`
--
ALTER TABLE `merchant_payment_methods`
  ADD CONSTRAINT `merchant_payment_methods_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `merchant_payment_methods_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `merchant_pickup_methods`
--
ALTER TABLE `merchant_pickup_methods`
  ADD CONSTRAINT `merchant_pickup_methods_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `merchant_pickup_methods_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mobile_bankings`
--
ALTER TABLE `mobile_bankings`
  ADD CONSTRAINT `mobile_bankings_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mobile_banking_collections`
--
ALTER TABLE `mobile_banking_collections`
  ADD CONSTRAINT `mobile_banking_collections_merchant_mobile_banking_id_foreign` FOREIGN KEY (`merchant_mobile_banking_id`) REFERENCES `merchant_mobile_bankings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `mobile_banking_collections_mobile_banking_id_foreign` FOREIGN KEY (`mobile_banking_id`) REFERENCES `mobile_bankings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `mobile_banking_collections_parcel_id_foreign` FOREIGN KEY (`parcel_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `otps`
--
ALTER TABLE `otps`
  ADD CONSTRAINT `otps_parcel_id_foreign` FOREIGN KEY (`parcel_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parcels`
--
ALTER TABLE `parcels`
  ADD CONSTRAINT `parcels_added_by_admin_foreign` FOREIGN KEY (`added_by_admin`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `parcels_added_by_merchant_foreign` FOREIGN KEY (`added_by_merchant`) REFERENCES `merchants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `parcels_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parcels_assigning_by_foreign` FOREIGN KEY (`assigning_by`) REFERENCES `riders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `parcels_city_type_id_foreign` FOREIGN KEY (`city_type_id`) REFERENCES `city_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `parcels_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parcels_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `parcels_parcel_type_id_foreign` FOREIGN KEY (`parcel_type_id`) REFERENCES `parcel_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `parcels_sub_area_id_foreign` FOREIGN KEY (`sub_area_id`) REFERENCES `sub_areas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parcels_weight_range_id_foreign` FOREIGN KEY (`weight_range_id`) REFERENCES `weight_ranges` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `parcel_notes`
--
ALTER TABLE `parcel_notes`
  ADD CONSTRAINT `parcel_notes_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `parcel_notes_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `parcel_notes_parcel_id_foreign` FOREIGN KEY (`parcel_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parcel_notes_rider_id_foreign` FOREIGN KEY (`rider_id`) REFERENCES `riders` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `parcel_times`
--
ALTER TABLE `parcel_times`
  ADD CONSTRAINT `parcel_times_parcel_id_foreign` FOREIGN KEY (`parcel_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parcel_transfers`
--
ALTER TABLE `parcel_transfers`
  ADD CONSTRAINT `parcel_transfers_accept_or_reject_by_foreign` FOREIGN KEY (`accept_or_reject_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `parcel_transfers_parcel_id_foreign` FOREIGN KEY (`parcel_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parcel_transfers_transfer_by_foreign` FOREIGN KEY (`transfer_by`) REFERENCES `riders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parcel_transfers_transfer_for_foreign` FOREIGN KEY (`transfer_for`) REFERENCES `riders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parcel_transfers_transfer_sub_area_foreign` FOREIGN KEY (`transfer_sub_area`) REFERENCES `sub_areas` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD CONSTRAINT `payment_requests_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pickup_requests`
--
ALTER TABLE `pickup_requests`
  ADD CONSTRAINT `pickup_requests_assigning_by_foreign` FOREIGN KEY (`assigning_by`) REFERENCES `riders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pickup_requests_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pickup_requests_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `print_parcels`
--
ALTER TABLE `print_parcels`
  ADD CONSTRAINT `print_parcels_rider_id_foreign` FOREIGN KEY (`rider_id`) REFERENCES `riders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `print_parcel_items`
--
ALTER TABLE `print_parcel_items`
  ADD CONSTRAINT `print_parcel_items_parcel_id_foreign` FOREIGN KEY (`parcel_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `print_parcel_items_print_parcel_id_foreign` FOREIGN KEY (`print_parcel_id`) REFERENCES `print_parcels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reasons`
--
ALTER TABLE `reasons`
  ADD CONSTRAINT `reasons_reason_type_id_foreign` FOREIGN KEY (`reason_type_id`) REFERENCES `reason_types` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `riders`
--
ALTER TABLE `riders`
  ADD CONSTRAINT `riders_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `riders_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `rider_collections`
--
ALTER TABLE `rider_collections`
  ADD CONSTRAINT `rider_collections_accounts_collected_by_foreign` FOREIGN KEY (`accounts_collected_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `rider_collections_incharge_collected_by_foreign` FOREIGN KEY (`incharge_collected_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `rider_collections_merchant_id_foreign` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `rider_collections_parcel_id_foreign` FOREIGN KEY (`parcel_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rider_collections_rider_collected_by_foreign` FOREIGN KEY (`rider_collected_by`) REFERENCES `riders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `rider_collections_tracking_id_foreign` FOREIGN KEY (`tracking_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sms_configures`
--
ALTER TABLE `sms_configures`
  ADD CONSTRAINT `sms_configures_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_areas`
--
ALTER TABLE `sub_areas`
  ADD CONSTRAINT `sub_areas_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

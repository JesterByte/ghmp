-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2025 at 09:03 AM
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
-- Database: `ghmp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `backup_settings`
--

CREATE TABLE `backup_settings` (
  `id` int(11) NOT NULL,
  `backup_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `backup_settings`
--

INSERT INTO `backup_settings` (`id`, `backup_time`) VALUES
(1, '20:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `suffix_name` varchar(10) DEFAULT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `relationship_to_customer` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`id`, `customer_id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `contact_number`, `email_address`, `relationship_to_customer`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mary', 'C.', 'Doe', NULL, '1122334455', 'mary.doe@example.com', 'Spouse', '2025-01-26 16:55:33', '2025-01-26 16:55:33'),
(2, 1, 'James', NULL, 'Doe', NULL, '5566778899', NULL, 'Son', '2025-01-26 16:55:33', '2025-01-26 16:55:33'),
(3, 2, 'Robert', 'D.', 'Smith', NULL, '6677889900', 'robert.smith@example.com', 'Brother', '2025-01-26 16:55:33', '2025-01-26 16:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `cash_sales`
--

CREATE TABLE `cash_sales` (
  `id` int(11) NOT NULL,
  `lot_id` varchar(255) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `payment_status` enum('Pending','Paid','Overdue') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_sale_due_dates`
--

CREATE TABLE `cash_sale_due_dates` (
  `id` int(11) NOT NULL,
  `lot_id` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `suffix_name` varchar(10) DEFAULT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password_hashed` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `contact_number`, `email_address`, `password_hashed`, `created_at`, `updated_at`) VALUES
(1, 'John', 'A.', 'Doe', NULL, '1234567890', 'john.doe@example.com', 'hashed_password_1', '2025-01-26 16:55:27', '2025-01-26 16:55:27'),
(2, 'Jane', 'B.', 'Smith', 'Jr.', '0987654321', 'jane.smith@example.com', 'hashed_password_2', '2025-01-26 16:55:27', '2025-01-26 16:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `estates`
--

CREATE TABLE `estates` (
  `id` int(11) NOT NULL,
  `estate_id` varchar(10) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `latitude_start` decimal(10,7) NOT NULL,
  `longitude_start` decimal(10,7) NOT NULL,
  `latitude_end` decimal(10,7) NOT NULL,
  `longitude_end` decimal(10,7) NOT NULL,
  `status` enum('Available','Reserved','Sold','Sold and Occupied') NOT NULL DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estates`
--

INSERT INTO `estates` (`id`, `estate_id`, `owner_id`, `latitude_start`, `longitude_start`, `latitude_end`, `longitude_end`, `status`, `created_at`, `updated_at`) VALUES
(28, 'E-C1', NULL, 14.8715127, 120.9769721, 14.8715487, 120.9770081, 'Available', '2025-02-01 05:45:47', '2025-02-02 05:32:15'),
(29, 'E-B1', NULL, 14.8714647, 120.9769721, 14.8715097, 120.9770036, 'Available', '2025-02-01 05:45:47', '2025-02-01 05:45:47'),
(30, 'E-A1', NULL, 14.8714167, 120.9769721, 14.8714617, 120.9770081, 'Available', '2025-02-01 05:45:47', '2025-02-01 14:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `estate_cash_sales`
--

CREATE TABLE `estate_cash_sales` (
  `id` int(11) NOT NULL,
  `estate_id` varchar(10) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_status` enum('Paid','Failed','Pending','Overdue') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estate_cash_sale_due_dates`
--

CREATE TABLE `estate_cash_sale_due_dates` (
  `id` int(11) NOT NULL,
  `estate_id` varchar(10) NOT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estate_installments`
--

CREATE TABLE `estate_installments` (
  `id` int(11) NOT NULL,
  `estate_id` varchar(10) NOT NULL,
  `term_years` int(11) NOT NULL,
  `down_payment` decimal(10,2) NOT NULL,
  `down_payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `down_payment_date` date DEFAULT NULL,
  `down_payment_due_date` date NOT NULL,
  `next_due_date` date NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `monthly_payment` decimal(10,2) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `payment_status` enum('Pending','Ongoing','Completed') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estate_installment_payments`
--

CREATE TABLE `estate_installment_payments` (
  `id` int(11) NOT NULL,
  `installment_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estate_pricing`
--

CREATE TABLE `estate_pricing` (
  `id` int(11) NOT NULL,
  `estate` varchar(50) DEFAULT NULL,
  `sqm` decimal(10,2) DEFAULT NULL,
  `number_of_lots` int(11) DEFAULT NULL,
  `lot_price` decimal(15,2) DEFAULT NULL,
  `vat` decimal(5,2) NOT NULL DEFAULT 0.12,
  `memorial_care_fee` decimal(10,2) NOT NULL DEFAULT 10000.00,
  `total_purchase_price` decimal(15,2) DEFAULT NULL,
  `cash_sale` decimal(15,2) DEFAULT NULL,
  `cash_sale_discount` decimal(5,2) NOT NULL DEFAULT 0.10,
  `six_months` decimal(15,2) DEFAULT NULL,
  `six_months_discount` decimal(5,2) NOT NULL DEFAULT 0.05,
  `down_payment` decimal(15,2) DEFAULT NULL,
  `down_payment_rate` decimal(5,2) NOT NULL DEFAULT 0.20,
  `balance` decimal(15,2) DEFAULT NULL,
  `monthly_amortization_one_year` decimal(15,2) DEFAULT NULL,
  `one_year_interest_rate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `monthly_amortization_two_years` decimal(15,2) DEFAULT NULL,
  `two_years_interest_rate` decimal(5,2) NOT NULL DEFAULT 0.10,
  `monthly_amortization_three_years` decimal(15,2) DEFAULT NULL,
  `three_years_interest_rate` decimal(5,2) NOT NULL DEFAULT 0.15,
  `monthly_amortization_four_years` decimal(15,2) DEFAULT NULL,
  `four_years_interest_rate` decimal(5,2) NOT NULL DEFAULT 0.20,
  `monthly_amortization_five_years` decimal(15,2) DEFAULT NULL,
  `five_years_interest_rate` decimal(5,2) NOT NULL DEFAULT 0.25
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estate_pricing`
--

INSERT INTO `estate_pricing` (`id`, `estate`, `sqm`, `number_of_lots`, `lot_price`, `vat`, `memorial_care_fee`, `total_purchase_price`, `cash_sale`, `cash_sale_discount`, `six_months`, `six_months_discount`, `down_payment`, `down_payment_rate`, `balance`, `monthly_amortization_one_year`, `one_year_interest_rate`, `monthly_amortization_two_years`, `two_years_interest_rate`, `monthly_amortization_three_years`, `three_years_interest_rate`, `monthly_amortization_four_years`, `four_years_interest_rate`, `monthly_amortization_five_years`, `five_years_interest_rate`) VALUES
(1, 'Estate A', 20.00, 8, 531016.00, 0.12, 10000.00, 605937.92, 545344.13, 0.10, 575641.02, 0.05, 131187.58, 0.20, 474750.34, 39562.53, 0.00, 21907.32, 0.10, 16457.38, 0.15, 14446.82, 0.20, 13934.55, 0.25),
(2, 'Estate B', 17.50, 7, 449134.00, 0.12, 10000.00, 573030.08, 522727.00, 0.10, 547879.00, 0.05, 170606.00, 0.20, 402424.06, 33535.34, 0.00, 18444.42, 0.10, 12855.21, 0.15, 10060.60, 0.20, 8383.83, 0.25),
(3, 'Estate C', 16.00, 6, 406342.40, 0.12, 10000.00, 519103.49, 473593.00, 0.10, 496348.00, 0.05, 155021.00, 0.20, 364082.79, 30340.23, 0.00, 16687.13, 0.10, 11630.42, 0.15, 9102.07, 0.20, 7585.06, 0.25);

-- --------------------------------------------------------

--
-- Table structure for table `estate_reservations`
--

CREATE TABLE `estate_reservations` (
  `id` int(11) NOT NULL,
  `estate_id` varchar(10) NOT NULL,
  `reservee_id` int(11) NOT NULL,
  `estate_type` enum('A','B','C') NOT NULL,
  `payment_option` enum('Cash Sale','6 Months','Installment: 1 Year','Installment: 2 Years','Installment: 3 Years','Installment: 4 Years','Installment: 5 Years','Pending') NOT NULL DEFAULT 'Pending',
  `reservation_status` enum('Pending','Confirmed','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estate_six_months`
--

CREATE TABLE `estate_six_months` (
  `id` int(11) NOT NULL,
  `estate_id` varchar(10) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_status` enum('Paid','Failed','Pending','Overdue') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estate_six_months_due_dates`
--

CREATE TABLE `estate_six_months_due_dates` (
  `id` int(11) NOT NULL,
  `estate_id` varchar(10) NOT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `installments`
--

CREATE TABLE `installments` (
  `id` int(11) NOT NULL,
  `lot_id` varchar(255) NOT NULL,
  `term_years` int(11) NOT NULL,
  `down_payment` decimal(10,2) NOT NULL,
  `down_payment_status` enum('Pending','Paid') DEFAULT 'Pending',
  `down_payment_date` date DEFAULT NULL,
  `down_payment_due_date` date NOT NULL,
  `next_due_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `monthly_payment` decimal(10,2) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `payment_status` enum('Pending','Ongoing','Completed') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `installments`
--

INSERT INTO `installments` (`id`, `lot_id`, `term_years`, `down_payment`, `down_payment_status`, `down_payment_date`, `down_payment_due_date`, `next_due_date`, `total_amount`, `monthly_payment`, `interest_rate`, `payment_status`, `created_at`, `updated_at`) VALUES
(10, '1C1-3', 1, 27108.45, 'Pending', NULL, '2025-03-04', NULL, 58433.76, 4869.48, 0.00, 'Pending', '2025-02-02 04:01:03', '2025-02-02 04:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `installment_payments`
--

CREATE TABLE `installment_payments` (
  `id` int(11) NOT NULL,
  `installment_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` datetime DEFAULT current_timestamp(),
  `payment_status` enum('Pending','Paid') DEFAULT 'Paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lots`
--

CREATE TABLE `lots` (
  `id` int(11) NOT NULL,
  `lot_id` varchar(50) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `latitude_start` decimal(10,8) NOT NULL,
  `longitude_start` decimal(11,8) NOT NULL,
  `latitude_end` decimal(10,8) NOT NULL,
  `longitude_end` decimal(11,8) NOT NULL,
  `status` enum('Available','Reserved','Sold','Sold and Occupied') DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lots`
--

INSERT INTO `lots` (`id`, `lot_id`, `owner_id`, `latitude_start`, `longitude_start`, `latitude_end`, `longitude_end`, `status`, `created_at`, `updated_at`) VALUES
(2228, '1C1-1', NULL, 14.87157650, 120.97704960, 14.87159450, 120.97705860, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2229, '1C1-2', NULL, 14.87159950, 120.97704960, 14.87161750, 120.97705860, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2230, '1C1-3', NULL, 14.87162250, 120.97704960, 14.87164050, 120.97705860, 'Reserved', '2025-01-26 03:36:58', '2025-02-02 04:01:03'),
(2231, '1C1-4', NULL, 14.87164550, 120.97704960, 14.87166350, 120.97705860, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2232, '1C1-5', NULL, 14.87166850, 120.97704960, 14.87168650, 120.97705860, 'Available', '2025-01-26 03:36:58', '2025-01-29 05:21:53'),
(2233, '1C1-6', NULL, 14.87169150, 120.97704960, 14.87170950, 120.97705860, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2234, '1C6-1', NULL, 14.87140650, 120.97711710, 14.87142450, 120.97712610, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2235, '1C6-2', NULL, 14.87142950, 120.97711710, 14.87144750, 120.97712610, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2236, '1C6-3', NULL, 14.87145250, 120.97711710, 14.87147050, 120.97712610, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2237, '1C6-4', NULL, 14.87147550, 120.97711710, 14.87149350, 120.97712610, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2238, '1C6-5', NULL, 14.87149850, 120.97711710, 14.87151650, 120.97712610, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2239, '1C6-6', NULL, 14.87152150, 120.97711710, 14.87153950, 120.97712610, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2240, '1C6-7', NULL, 14.87154450, 120.97711710, 14.87156250, 120.97712610, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2241, '1C6-8', NULL, 14.87156750, 120.97711710, 14.87158550, 120.97712610, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2242, '1C6-9', NULL, 14.87159050, 120.97711710, 14.87160850, 120.97712610, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2243, '1C6-10', NULL, 14.87161350, 120.97711710, 14.87163150, 120.97712610, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2244, '1C6-11', NULL, 14.87163650, 120.97711710, 14.87165450, 120.97712610, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2245, '1C6-12', NULL, 14.87165950, 120.97711710, 14.87167750, 120.97712610, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2246, '1C6-13', NULL, 14.87168250, 120.97711710, 14.87170050, 120.97712610, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2247, '1C6-14', NULL, 14.87170550, 120.97711710, 14.87172350, 120.97712610, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2248, '1C2-1', NULL, 14.87141950, 120.97706310, 14.87143750, 120.97707210, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2249, '1C2-2', NULL, 14.87144250, 120.97706310, 14.87146050, 120.97707210, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2250, '1C2-3', NULL, 14.87146550, 120.97706310, 14.87148350, 120.97707210, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2251, '1C2-4', NULL, 14.87148850, 120.97706310, 14.87150650, 120.97707210, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2252, '1C2-5', NULL, 14.87151150, 120.97706310, 14.87152950, 120.97707210, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2253, '1C2-6', NULL, 14.87153450, 120.97706310, 14.87155250, 120.97707210, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2254, '1C2-7', NULL, 14.87155750, 120.97706310, 14.87157550, 120.97707210, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2255, '1C2-8', NULL, 14.87158050, 120.97706310, 14.87159850, 120.97707210, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2256, '1C2-9', NULL, 14.87160350, 120.97706310, 14.87162150, 120.97707210, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2257, '1C2-10', NULL, 14.87162650, 120.97706310, 14.87164450, 120.97707210, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2258, '1C2-11', NULL, 14.87164950, 120.97706310, 14.87166750, 120.97707210, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2259, '1C2-12', NULL, 14.87167250, 120.97706310, 14.87169050, 120.97707210, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2260, '1C2-13', NULL, 14.87169550, 120.97706310, 14.87171350, 120.97707210, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2261, '1C3-1', NULL, 14.87141850, 120.97707660, 14.87143650, 120.97708560, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2262, '1C3-2', NULL, 14.87144150, 120.97707660, 14.87145950, 120.97708560, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2263, '1C3-3', NULL, 14.87146450, 120.97707660, 14.87148250, 120.97708560, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2264, '1C3-4', NULL, 14.87148750, 120.97707660, 14.87150550, 120.97708560, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2265, '1C3-5', NULL, 14.87151050, 120.97707660, 14.87152850, 120.97708560, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2266, '1C3-6', NULL, 14.87153350, 120.97707660, 14.87155150, 120.97708560, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2267, '1C3-7', NULL, 14.87155650, 120.97707660, 14.87157450, 120.97708560, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2268, '1C3-8', NULL, 14.87157950, 120.97707660, 14.87159750, 120.97708560, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2269, '1C3-9', NULL, 14.87160250, 120.97707660, 14.87162050, 120.97708560, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2270, '1C3-10', NULL, 14.87162550, 120.97707660, 14.87164350, 120.97708560, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2271, '1C3-11', NULL, 14.87164850, 120.97707660, 14.87166650, 120.97708560, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2272, '1C3-12', NULL, 14.87167150, 120.97707660, 14.87168950, 120.97708560, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2273, '1C3-13', NULL, 14.87169450, 120.97707660, 14.87171250, 120.97708560, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2274, '1C4-1', NULL, 14.87141450, 120.97709010, 14.87143250, 120.97709910, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2275, '1C4-2', NULL, 14.87143750, 120.97709010, 14.87145550, 120.97709910, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2276, '1C4-3', NULL, 14.87146050, 120.97709010, 14.87147850, 120.97709910, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2277, '1C4-4', NULL, 14.87148350, 120.97709010, 14.87150150, 120.97709910, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2278, '1C4-5', NULL, 14.87150650, 120.97709010, 14.87152450, 120.97709910, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2279, '1C4-6', NULL, 14.87152950, 120.97709010, 14.87154750, 120.97709910, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2280, '1C4-7', NULL, 14.87155250, 120.97709010, 14.87157050, 120.97709910, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2281, '1C4-8', NULL, 14.87157550, 120.97709010, 14.87159350, 120.97709910, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2282, '1C4-9', NULL, 14.87159850, 120.97709010, 14.87161650, 120.97709910, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2283, '1C4-10', NULL, 14.87162150, 120.97709010, 14.87163950, 120.97709910, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2284, '1C4-11', NULL, 14.87164450, 120.97709010, 14.87166250, 120.97709910, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2285, '1C4-12', NULL, 14.87166750, 120.97709010, 14.87168550, 120.97709910, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2286, '1C4-13', NULL, 14.87169050, 120.97709010, 14.87170850, 120.97709910, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2287, '1C5-1', NULL, 14.87141150, 120.97710360, 14.87142950, 120.97711260, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2288, '1C5-2', NULL, 14.87143450, 120.97710360, 14.87145250, 120.97711260, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2289, '1C5-3', NULL, 14.87145750, 120.97710360, 14.87147550, 120.97711260, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2290, '1C5-4', NULL, 14.87148050, 120.97710360, 14.87149850, 120.97711260, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2291, '1C5-5', NULL, 14.87150350, 120.97710360, 14.87152150, 120.97711260, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2292, '1C5-6', NULL, 14.87152650, 120.97710360, 14.87154450, 120.97711260, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2293, '1C5-7', NULL, 14.87154950, 120.97710360, 14.87156750, 120.97711260, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2294, '1C5-8', NULL, 14.87157250, 120.97710360, 14.87159050, 120.97711260, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2295, '1C5-9', NULL, 14.87159550, 120.97710360, 14.87161350, 120.97711260, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2296, '1C5-10', NULL, 14.87161850, 120.97710360, 14.87163650, 120.97711260, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2297, '1C5-11', NULL, 14.87164150, 120.97710360, 14.87165950, 120.97711260, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2298, '1C5-12', NULL, 14.87166450, 120.97710360, 14.87168250, 120.97711260, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2299, '1C5-13', NULL, 14.87168750, 120.97710360, 14.87170550, 120.97711260, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2300, '1C5-14', NULL, 14.87171050, 120.97710360, 14.87172850, 120.97711260, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2301, '1C7-1', NULL, 14.87140650, 120.97713060, 14.87142450, 120.97713960, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2302, '1C7-2', NULL, 14.87142950, 120.97713060, 14.87144750, 120.97713960, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2303, '1C7-3', NULL, 14.87145250, 120.97713060, 14.87147050, 120.97713960, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2304, '1C7-4', NULL, 14.87147550, 120.97713060, 14.87149350, 120.97713960, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2305, '1C7-5', NULL, 14.87149850, 120.97713060, 14.87151650, 120.97713960, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2306, '1C7-6', NULL, 14.87152150, 120.97713060, 14.87153950, 120.97713960, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2307, '1C7-7', NULL, 14.87154450, 120.97713060, 14.87156250, 120.97713960, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2308, '1C7-8', NULL, 14.87156750, 120.97713060, 14.87158550, 120.97713960, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2309, '1C7-9', NULL, 14.87159050, 120.97713060, 14.87160850, 120.97713960, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2310, '1C7-10', NULL, 14.87161350, 120.97713060, 14.87163150, 120.97713960, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2311, '1C7-11', NULL, 14.87163650, 120.97713060, 14.87165450, 120.97713960, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2312, '1C7-12', NULL, 14.87165950, 120.97713060, 14.87167750, 120.97713960, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2313, '1C7-13', NULL, 14.87168250, 120.97713060, 14.87170050, 120.97713960, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2314, '1C7-14', NULL, 14.87170550, 120.97713060, 14.87172350, 120.97713960, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2315, '1C8-1', NULL, 14.87140650, 120.97714410, 14.87142450, 120.97715310, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2316, '1C8-2', NULL, 14.87142950, 120.97714410, 14.87144750, 120.97715310, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2317, '1C8-3', NULL, 14.87145250, 120.97714410, 14.87147050, 120.97715310, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2318, '1C8-4', NULL, 14.87147550, 120.97714410, 14.87149350, 120.97715310, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2319, '1C8-5', NULL, 14.87149850, 120.97714410, 14.87151650, 120.97715310, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2320, '1C8-6', NULL, 14.87152150, 120.97714410, 14.87153950, 120.97715310, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2321, '1C8-7', NULL, 14.87154450, 120.97714410, 14.87156250, 120.97715310, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2322, '1C8-8', NULL, 14.87156750, 120.97714410, 14.87158550, 120.97715310, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2323, '1C8-9', NULL, 14.87159050, 120.97714410, 14.87160850, 120.97715310, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2324, '1C8-10', NULL, 14.87161350, 120.97714410, 14.87163150, 120.97715310, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2325, '1C8-11', NULL, 14.87163650, 120.97714410, 14.87165450, 120.97715310, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2326, '1C8-12', NULL, 14.87165950, 120.97714410, 14.87167750, 120.97715310, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2327, '1C8-13', NULL, 14.87168250, 120.97714410, 14.87170050, 120.97715310, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2328, '1C8-14', NULL, 14.87170550, 120.97714410, 14.87172350, 120.97715310, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2329, '1C9-1', NULL, 14.87140000, 120.97715760, 14.87141800, 120.97716660, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2330, '1C9-2', NULL, 14.87142300, 120.97715760, 14.87144100, 120.97716660, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2331, '1C9-3', NULL, 14.87144600, 120.97715760, 14.87146400, 120.97716660, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2332, '1C9-4', NULL, 14.87146900, 120.97715760, 14.87148700, 120.97716660, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2333, '1C9-5', NULL, 14.87149200, 120.97715760, 14.87151000, 120.97716660, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2334, '1C9-6', NULL, 14.87151500, 120.97715760, 14.87153300, 120.97716660, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2335, '1C9-7', NULL, 14.87153800, 120.97715760, 14.87155600, 120.97716660, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2336, '1C9-8', NULL, 14.87156100, 120.97715760, 14.87157900, 120.97716660, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2337, '1C9-9', NULL, 14.87158400, 120.97715760, 14.87160200, 120.97716660, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2338, '1C9-10', NULL, 14.87160700, 120.97715760, 14.87162500, 120.97716660, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2339, '1C9-11', NULL, 14.87163000, 120.97715760, 14.87164800, 120.97716660, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2340, '1C9-12', NULL, 14.87165300, 120.97715760, 14.87167100, 120.97716660, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2341, '1C9-13', NULL, 14.87167600, 120.97715760, 14.87169400, 120.97716660, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2342, '1C9-14', NULL, 14.87169900, 120.97715760, 14.87171700, 120.97716660, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2343, '1C9-15', NULL, 14.87172200, 120.97715760, 14.87174000, 120.97716660, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2344, '1C10-1', NULL, 14.87140000, 120.97717110, 14.87141800, 120.97718010, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2345, '1C10-2', NULL, 14.87142300, 120.97717110, 14.87144100, 120.97718010, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2346, '1C10-3', NULL, 14.87144600, 120.97717110, 14.87146400, 120.97718010, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2347, '1C10-4', NULL, 14.87146900, 120.97717110, 14.87148700, 120.97718010, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2348, '1C10-5', NULL, 14.87149200, 120.97717110, 14.87151000, 120.97718010, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2349, '1C10-6', NULL, 14.87151500, 120.97717110, 14.87153300, 120.97718010, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2350, '1C10-7', NULL, 14.87153800, 120.97717110, 14.87155600, 120.97718010, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2351, '1C10-8', NULL, 14.87156100, 120.97717110, 14.87157900, 120.97718010, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2352, '1C10-9', NULL, 14.87158400, 120.97717110, 14.87160200, 120.97718010, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2353, '1C10-10', NULL, 14.87160700, 120.97717110, 14.87162500, 120.97718010, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2354, '1C10-11', NULL, 14.87163000, 120.97717110, 14.87164800, 120.97718010, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2355, '1C10-12', NULL, 14.87165300, 120.97717110, 14.87167100, 120.97718010, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2356, '1C10-13', NULL, 14.87167600, 120.97717110, 14.87169400, 120.97718010, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2357, '1C10-14', NULL, 14.87169900, 120.97717110, 14.87171700, 120.97718010, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2358, '1C10-15', NULL, 14.87172200, 120.97717110, 14.87174000, 120.97718010, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2359, '1C11-1', NULL, 14.87140000, 120.97718460, 14.87141800, 120.97719360, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2360, '1C11-2', NULL, 14.87142300, 120.97718460, 14.87144100, 120.97719360, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2361, '1C11-3', NULL, 14.87144600, 120.97718460, 14.87146400, 120.97719360, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2362, '1C11-4', NULL, 14.87146900, 120.97718460, 14.87148700, 120.97719360, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2363, '1C11-5', NULL, 14.87149200, 120.97718460, 14.87151000, 120.97719360, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2364, '1C11-6', NULL, 14.87151500, 120.97718460, 14.87153300, 120.97719360, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2365, '1C11-7', NULL, 14.87153800, 120.97718460, 14.87155600, 120.97719360, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2366, '1C11-8', NULL, 14.87156100, 120.97718460, 14.87157900, 120.97719360, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2367, '1C11-9', NULL, 14.87158400, 120.97718460, 14.87160200, 120.97719360, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2368, '1C11-10', NULL, 14.87160700, 120.97718460, 14.87162500, 120.97719360, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2369, '1C11-11', NULL, 14.87163000, 120.97718460, 14.87164800, 120.97719360, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2370, '1C11-12', NULL, 14.87165300, 120.97718460, 14.87167100, 120.97719360, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2371, '1C11-13', NULL, 14.87167600, 120.97718460, 14.87169400, 120.97719360, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2372, '1C11-14', NULL, 14.87169900, 120.97718460, 14.87171700, 120.97719360, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2373, '1C11-15', NULL, 14.87172200, 120.97718460, 14.87174000, 120.97719360, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2374, '1C12-1', NULL, 14.87140300, 120.97719810, 14.87142100, 120.97720710, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2375, '1C12-2', NULL, 14.87142600, 120.97719810, 14.87144400, 120.97720710, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2376, '1C12-3', NULL, 14.87144900, 120.97719810, 14.87146700, 120.97720710, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2377, '1C12-4', NULL, 14.87147200, 120.97719810, 14.87149000, 120.97720710, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2378, '1C12-5', NULL, 14.87149500, 120.97719810, 14.87151300, 120.97720710, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2379, '1C12-6', NULL, 14.87151800, 120.97719810, 14.87153600, 120.97720710, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2380, '1C12-7', NULL, 14.87154100, 120.97719810, 14.87155900, 120.97720710, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2381, '1C12-8', NULL, 14.87156400, 120.97719810, 14.87158200, 120.97720710, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2382, '1C12-9', NULL, 14.87158700, 120.97719810, 14.87160500, 120.97720710, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2383, '1C12-10', NULL, 14.87161000, 120.97719810, 14.87162800, 120.97720710, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2384, '1C12-11', NULL, 14.87163300, 120.97719810, 14.87165100, 120.97720710, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2385, '1C12-12', NULL, 14.87165600, 120.97719810, 14.87167400, 120.97720710, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2386, '1C12-13', NULL, 14.87167900, 120.97719810, 14.87169700, 120.97720710, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2387, '1C12-14', NULL, 14.87170200, 120.97719810, 14.87172000, 120.97720710, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2388, '1C12-15', NULL, 14.87172500, 120.97719810, 14.87174300, 120.97720710, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2389, '1C13-1', NULL, 14.87140300, 120.97721160, 14.87142100, 120.97722060, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2390, '1C13-2', NULL, 14.87142600, 120.97721160, 14.87144400, 120.97722060, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2391, '1C13-3', NULL, 14.87144900, 120.97721160, 14.87146700, 120.97722060, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2392, '1C13-4', NULL, 14.87147200, 120.97721160, 14.87149000, 120.97722060, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2393, '1C13-5', NULL, 14.87149500, 120.97721160, 14.87151300, 120.97722060, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2394, '1C13-6', NULL, 14.87151800, 120.97721160, 14.87153600, 120.97722060, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2395, '1C13-7', NULL, 14.87154100, 120.97721160, 14.87155900, 120.97722060, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2396, '1C13-8', NULL, 14.87156400, 120.97721160, 14.87158200, 120.97722060, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2397, '1C13-9', NULL, 14.87158700, 120.97721160, 14.87160500, 120.97722060, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2398, '1C13-10', NULL, 14.87161000, 120.97721160, 14.87162800, 120.97722060, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2399, '1C13-11', NULL, 14.87163300, 120.97721160, 14.87165100, 120.97722060, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2400, '1C13-12', NULL, 14.87165600, 120.97721160, 14.87167400, 120.97722060, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2401, '1C13-13', NULL, 14.87167900, 120.97721160, 14.87169700, 120.97722060, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2402, '1C13-14', NULL, 14.87170200, 120.97721160, 14.87172000, 120.97722060, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2403, '1C13-15', NULL, 14.87172500, 120.97721160, 14.87174300, 120.97722060, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2404, '1C16-1', NULL, 14.87140100, 120.97725210, 14.87141900, 120.97726110, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2405, '1C16-2', NULL, 14.87142400, 120.97725210, 14.87144200, 120.97726110, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2406, '1C16-3', NULL, 14.87144700, 120.97725210, 14.87146500, 120.97726110, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2407, '1C16-4', NULL, 14.87147000, 120.97725210, 14.87148800, 120.97726110, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2408, '1C16-5', NULL, 14.87149300, 120.97725210, 14.87151100, 120.97726110, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2409, '1C16-6', NULL, 14.87151600, 120.97725210, 14.87153400, 120.97726110, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2410, '1C16-7', NULL, 14.87153900, 120.97725210, 14.87155700, 120.97726110, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2411, '1C16-8', NULL, 14.87156200, 120.97725210, 14.87158000, 120.97726110, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2412, '1C16-9', NULL, 14.87158500, 120.97725210, 14.87160300, 120.97726110, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2413, '1C16-10', NULL, 14.87160800, 120.97725210, 14.87162600, 120.97726110, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2414, '1C16-11', NULL, 14.87163100, 120.97725210, 14.87164900, 120.97726110, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2415, '1C16-12', NULL, 14.87165400, 120.97725210, 14.87167200, 120.97726110, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2416, '1C16-13', NULL, 14.87167700, 120.97725210, 14.87169500, 120.97726110, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2417, '1C16-14', NULL, 14.87170000, 120.97725210, 14.87171800, 120.97726110, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2418, '1C16-15', NULL, 14.87172300, 120.97725210, 14.87174100, 120.97726110, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2419, '1C17-1', NULL, 14.87140100, 120.97726560, 14.87141900, 120.97727460, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2420, '1C17-2', NULL, 14.87142400, 120.97726560, 14.87144200, 120.97727460, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2421, '1C17-3', NULL, 14.87144700, 120.97726560, 14.87146500, 120.97727460, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2422, '1C17-4', NULL, 14.87147000, 120.97726560, 14.87148800, 120.97727460, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2423, '1C17-5', NULL, 14.87149300, 120.97726560, 14.87151100, 120.97727460, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2424, '1C17-6', NULL, 14.87151600, 120.97726560, 14.87153400, 120.97727460, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2425, '1C17-7', NULL, 14.87153900, 120.97726560, 14.87155700, 120.97727460, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2426, '1C17-8', NULL, 14.87156200, 120.97726560, 14.87158000, 120.97727460, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2427, '1C17-9', NULL, 14.87158500, 120.97726560, 14.87160300, 120.97727460, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2428, '1C17-10', NULL, 14.87160800, 120.97726560, 14.87162600, 120.97727460, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2429, '1C17-11', NULL, 14.87163100, 120.97726560, 14.87164900, 120.97727460, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2430, '1C17-12', NULL, 14.87165400, 120.97726560, 14.87167200, 120.97727460, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2431, '1C17-13', NULL, 14.87167700, 120.97726560, 14.87169500, 120.97727460, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2432, '1C17-14', NULL, 14.87170000, 120.97726560, 14.87171800, 120.97727460, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2433, '1C17-15', NULL, 14.87172300, 120.97726560, 14.87174100, 120.97727460, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2434, '1C18-1', NULL, 14.87140100, 120.97727910, 14.87141900, 120.97728810, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2435, '1C18-2', NULL, 14.87142400, 120.97727910, 14.87144200, 120.97728810, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2436, '1C18-3', NULL, 14.87144700, 120.97727910, 14.87146500, 120.97728810, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2437, '1C18-4', NULL, 14.87147000, 120.97727910, 14.87148800, 120.97728810, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2438, '1C18-5', NULL, 14.87149300, 120.97727910, 14.87151100, 120.97728810, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2439, '1C18-6', NULL, 14.87151600, 120.97727910, 14.87153400, 120.97728810, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2440, '1C18-7', NULL, 14.87153900, 120.97727910, 14.87155700, 120.97728810, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2441, '1C18-8', NULL, 14.87156200, 120.97727910, 14.87158000, 120.97728810, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2442, '1C18-9', NULL, 14.87158500, 120.97727910, 14.87160300, 120.97728810, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2443, '1C18-10', NULL, 14.87160800, 120.97727910, 14.87162600, 120.97728810, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2444, '1C18-11', NULL, 14.87163100, 120.97727910, 14.87164900, 120.97728810, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2445, '1C18-12', NULL, 14.87165400, 120.97727910, 14.87167200, 120.97728810, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2446, '1C18-13', NULL, 14.87167700, 120.97727910, 14.87169500, 120.97728810, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2447, '1C18-14', NULL, 14.87170000, 120.97727910, 14.87171800, 120.97728810, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2448, '1C18-15', NULL, 14.87172300, 120.97727910, 14.87174100, 120.97728810, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2449, '1C14-1', NULL, 14.87140100, 120.97722510, 14.87141900, 120.97723410, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2450, '1C14-2', NULL, 14.87142400, 120.97722510, 14.87144200, 120.97723410, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2451, '1C14-3', NULL, 14.87144700, 120.97722510, 14.87146500, 120.97723410, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2452, '1C14-4', NULL, 14.87147000, 120.97722510, 14.87148800, 120.97723410, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2453, '1C14-5', NULL, 14.87149300, 120.97722510, 14.87151100, 120.97723410, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2454, '1C14-6', NULL, 14.87151600, 120.97722510, 14.87153400, 120.97723410, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2455, '1C14-7', NULL, 14.87153900, 120.97722510, 14.87155700, 120.97723410, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2456, '1C14-8', NULL, 14.87156200, 120.97722510, 14.87158000, 120.97723410, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2457, '1C14-9', NULL, 14.87158500, 120.97722510, 14.87160300, 120.97723410, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2458, '1C14-10', NULL, 14.87160800, 120.97722510, 14.87162600, 120.97723410, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2459, '1C14-11', NULL, 14.87163100, 120.97722510, 14.87164900, 120.97723410, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2460, '1C14-12', NULL, 14.87165400, 120.97722510, 14.87167200, 120.97723410, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2461, '1C14-13', NULL, 14.87167700, 120.97722510, 14.87169500, 120.97723410, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2462, '1C14-14', NULL, 14.87170000, 120.97722510, 14.87171800, 120.97723410, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2463, '1C14-15', NULL, 14.87172300, 120.97722510, 14.87174100, 120.97723410, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2464, '1C19-1', NULL, 14.87140100, 120.97729260, 14.87141900, 120.97730160, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2465, '1C19-2', NULL, 14.87142400, 120.97729260, 14.87144200, 120.97730160, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2466, '1C19-3', NULL, 14.87144700, 120.97729260, 14.87146500, 120.97730160, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2467, '1C19-4', NULL, 14.87147000, 120.97729260, 14.87148800, 120.97730160, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2468, '1C19-5', NULL, 14.87149300, 120.97729260, 14.87151100, 120.97730160, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2469, '1C19-6', NULL, 14.87151600, 120.97729260, 14.87153400, 120.97730160, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2470, '1C19-7', NULL, 14.87153900, 120.97729260, 14.87155700, 120.97730160, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2471, '1C19-8', NULL, 14.87156200, 120.97729260, 14.87158000, 120.97730160, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2472, '1C19-9', NULL, 14.87158500, 120.97729260, 14.87160300, 120.97730160, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2473, '1C19-10', NULL, 14.87160800, 120.97729260, 14.87162600, 120.97730160, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2474, '1C19-11', NULL, 14.87163100, 120.97729260, 14.87164900, 120.97730160, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2475, '1C19-12', NULL, 14.87165400, 120.97729260, 14.87167200, 120.97730160, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2476, '1C19-13', NULL, 14.87167700, 120.97729260, 14.87169500, 120.97730160, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2477, '1C19-14', NULL, 14.87170000, 120.97729260, 14.87171800, 120.97730160, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2478, '1C19-15', NULL, 14.87172300, 120.97729260, 14.87174100, 120.97730160, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2479, '1C21-1', NULL, 14.87140100, 120.97731960, 14.87141900, 120.97732860, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2480, '1C21-2', NULL, 14.87142400, 120.97731960, 14.87144200, 120.97732860, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2481, '1C21-3', NULL, 14.87144700, 120.97731960, 14.87146500, 120.97732860, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2482, '1C21-4', NULL, 14.87147000, 120.97731960, 14.87148800, 120.97732860, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2483, '1C21-5', NULL, 14.87149300, 120.97731960, 14.87151100, 120.97732860, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2484, '1C21-6', NULL, 14.87151600, 120.97731960, 14.87153400, 120.97732860, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2485, '1C21-7', NULL, 14.87153900, 120.97731960, 14.87155700, 120.97732860, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2486, '1C21-8', NULL, 14.87156200, 120.97731960, 14.87158000, 120.97732860, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2487, '1C21-9', NULL, 14.87158500, 120.97731960, 14.87160300, 120.97732860, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2488, '1C21-10', NULL, 14.87160800, 120.97731960, 14.87162600, 120.97732860, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2489, '1C21-11', NULL, 14.87163100, 120.97731960, 14.87164900, 120.97732860, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2490, '1C21-12', NULL, 14.87165400, 120.97731960, 14.87167200, 120.97732860, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2491, '1C21-13', NULL, 14.87167700, 120.97731960, 14.87169500, 120.97732860, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2492, '1C21-14', NULL, 14.87170000, 120.97731960, 14.87171800, 120.97732860, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2493, '1C21-15', NULL, 14.87172300, 120.97731960, 14.87174100, 120.97732860, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2494, '1C22-1', NULL, 14.87140100, 120.97733310, 14.87141900, 120.97734210, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2495, '1C22-2', NULL, 14.87142400, 120.97733310, 14.87144200, 120.97734210, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2496, '1C22-3', NULL, 14.87144700, 120.97733310, 14.87146500, 120.97734210, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2497, '1C22-4', NULL, 14.87147000, 120.97733310, 14.87148800, 120.97734210, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2498, '1C22-5', NULL, 14.87149300, 120.97733310, 14.87151100, 120.97734210, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2499, '1C22-6', NULL, 14.87151600, 120.97733310, 14.87153400, 120.97734210, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2500, '1C22-7', NULL, 14.87153900, 120.97733310, 14.87155700, 120.97734210, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2501, '1C22-8', NULL, 14.87156200, 120.97733310, 14.87158000, 120.97734210, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2502, '1C22-9', NULL, 14.87158500, 120.97733310, 14.87160300, 120.97734210, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2503, '1C22-10', NULL, 14.87160800, 120.97733310, 14.87162600, 120.97734210, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2504, '1C22-11', NULL, 14.87163100, 120.97733310, 14.87164900, 120.97734210, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2505, '1C22-12', NULL, 14.87165400, 120.97733310, 14.87167200, 120.97734210, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2506, '1C22-13', NULL, 14.87167700, 120.97733310, 14.87169500, 120.97734210, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2507, '1C22-14', NULL, 14.87170000, 120.97733310, 14.87171800, 120.97734210, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2508, '1C22-15', NULL, 14.87172300, 120.97733310, 14.87174100, 120.97734210, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2509, '1C22-16', NULL, 14.87174600, 120.97733310, 14.87176400, 120.97734210, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2510, '1C15-1', NULL, 14.87140100, 120.97723860, 14.87141900, 120.97724760, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2511, '1C15-2', NULL, 14.87142400, 120.97723860, 14.87144200, 120.97724760, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2512, '1C15-3', NULL, 14.87144700, 120.97723860, 14.87146500, 120.97724760, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2513, '1C15-4', NULL, 14.87147000, 120.97723860, 14.87148800, 120.97724760, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2514, '1C15-5', NULL, 14.87149300, 120.97723860, 14.87151100, 120.97724760, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2515, '1C15-6', NULL, 14.87151600, 120.97723860, 14.87153400, 120.97724760, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2516, '1C15-7', NULL, 14.87153900, 120.97723860, 14.87155700, 120.97724760, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2517, '1C15-8', NULL, 14.87156200, 120.97723860, 14.87158000, 120.97724760, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2518, '1C15-9', NULL, 14.87158500, 120.97723860, 14.87160300, 120.97724760, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2519, '1C15-10', NULL, 14.87160800, 120.97723860, 14.87162600, 120.97724760, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2520, '1C15-11', NULL, 14.87163100, 120.97723860, 14.87164900, 120.97724760, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2521, '1C15-12', NULL, 14.87165400, 120.97723860, 14.87167200, 120.97724760, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2522, '1C15-13', NULL, 14.87167700, 120.97723860, 14.87169500, 120.97724760, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2523, '1C15-14', NULL, 14.87170000, 120.97723860, 14.87171800, 120.97724760, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2524, '1C15-15', NULL, 14.87172300, 120.97723860, 14.87174100, 120.97724760, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2525, '1C24-1', NULL, 14.87140100, 120.97736010, 14.87141900, 120.97736910, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2526, '1C24-2', NULL, 14.87142400, 120.97736010, 14.87144200, 120.97736910, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2527, '1C24-3', NULL, 14.87144700, 120.97736010, 14.87146500, 120.97736910, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2528, '1C24-4', NULL, 14.87147000, 120.97736010, 14.87148800, 120.97736910, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2529, '1C24-5', NULL, 14.87149300, 120.97736010, 14.87151100, 120.97736910, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2530, '1C24-6', NULL, 14.87151600, 120.97736010, 14.87153400, 120.97736910, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2531, '1C24-7', NULL, 14.87153900, 120.97736010, 14.87155700, 120.97736910, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2532, '1C24-8', NULL, 14.87156200, 120.97736010, 14.87158000, 120.97736910, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2533, '1C24-9', NULL, 14.87158500, 120.97736010, 14.87160300, 120.97736910, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2534, '1C24-10', NULL, 14.87160800, 120.97736010, 14.87162600, 120.97736910, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2535, '1C24-11', NULL, 14.87163100, 120.97736010, 14.87164900, 120.97736910, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2536, '1C24-12', NULL, 14.87165400, 120.97736010, 14.87167200, 120.97736910, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2537, '1C24-13', NULL, 14.87167700, 120.97736010, 14.87169500, 120.97736910, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2538, '1C24-14', NULL, 14.87170000, 120.97736010, 14.87171800, 120.97736910, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2539, '1C24-15', NULL, 14.87172300, 120.97736010, 14.87174100, 120.97736910, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2540, '1C24-16', NULL, 14.87174600, 120.97736010, 14.87176400, 120.97736910, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2541, '1C25-1', NULL, 14.87140100, 120.97737360, 14.87141900, 120.97738260, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2542, '1C25-2', NULL, 14.87142400, 120.97737360, 14.87144200, 120.97738260, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2543, '1C25-3', NULL, 14.87144700, 120.97737360, 14.87146500, 120.97738260, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2544, '1C25-4', NULL, 14.87147000, 120.97737360, 14.87148800, 120.97738260, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2545, '1C25-5', NULL, 14.87149300, 120.97737360, 14.87151100, 120.97738260, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2546, '1C25-6', NULL, 14.87151600, 120.97737360, 14.87153400, 120.97738260, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2547, '1C25-7', NULL, 14.87153900, 120.97737360, 14.87155700, 120.97738260, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2548, '1C25-8', NULL, 14.87156200, 120.97737360, 14.87158000, 120.97738260, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2549, '1C25-9', NULL, 14.87158500, 120.97737360, 14.87160300, 120.97738260, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2550, '1C25-10', NULL, 14.87160800, 120.97737360, 14.87162600, 120.97738260, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2551, '1C25-11', NULL, 14.87163100, 120.97737360, 14.87164900, 120.97738260, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2552, '1C25-12', NULL, 14.87165400, 120.97737360, 14.87167200, 120.97738260, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2553, '1C25-13', NULL, 14.87167700, 120.97737360, 14.87169500, 120.97738260, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2554, '1C25-14', NULL, 14.87170000, 120.97737360, 14.87171800, 120.97738260, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2555, '1C25-15', NULL, 14.87172300, 120.97737360, 14.87174100, 120.97738260, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2556, '1C25-16', NULL, 14.87174600, 120.97737360, 14.87176400, 120.97738260, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2557, '1C26-1', NULL, 14.87140100, 120.97738710, 14.87141900, 120.97739610, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2558, '1C26-2', NULL, 14.87142400, 120.97738710, 14.87144200, 120.97739610, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2559, '1C26-3', NULL, 14.87144700, 120.97738710, 14.87146500, 120.97739610, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2560, '1C26-4', NULL, 14.87147000, 120.97738710, 14.87148800, 120.97739610, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2561, '1C26-5', NULL, 14.87149300, 120.97738710, 14.87151100, 120.97739610, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2562, '1C26-6', NULL, 14.87151600, 120.97738710, 14.87153400, 120.97739610, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2563, '1C26-7', NULL, 14.87153900, 120.97738710, 14.87155700, 120.97739610, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2564, '1C26-8', NULL, 14.87156200, 120.97738710, 14.87158000, 120.97739610, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2565, '1C26-9', NULL, 14.87158500, 120.97738710, 14.87160300, 120.97739610, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2566, '1C26-10', NULL, 14.87160800, 120.97738710, 14.87162600, 120.97739610, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2567, '1C26-11', NULL, 14.87163100, 120.97738710, 14.87164900, 120.97739610, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2568, '1C26-12', NULL, 14.87165400, 120.97738710, 14.87167200, 120.97739610, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2569, '1C26-13', NULL, 14.87167700, 120.97738710, 14.87169500, 120.97739610, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2570, '1C26-14', NULL, 14.87170000, 120.97738710, 14.87171800, 120.97739610, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2571, '1C26-15', NULL, 14.87172300, 120.97738710, 14.87174100, 120.97739610, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2572, '1C26-16', NULL, 14.87174600, 120.97738710, 14.87176400, 120.97739610, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2573, '1C27-1', NULL, 14.87140100, 120.97740060, 14.87141900, 120.97740960, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2574, '1C27-2', NULL, 14.87142400, 120.97740060, 14.87144200, 120.97740960, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2575, '1C27-3', NULL, 14.87144700, 120.97740060, 14.87146500, 120.97740960, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2576, '1C27-4', NULL, 14.87147000, 120.97740060, 14.87148800, 120.97740960, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2577, '1C27-5', NULL, 14.87149300, 120.97740060, 14.87151100, 120.97740960, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2578, '1C27-6', NULL, 14.87151600, 120.97740060, 14.87153400, 120.97740960, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2579, '1C27-7', NULL, 14.87153900, 120.97740060, 14.87155700, 120.97740960, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2580, '1C27-8', NULL, 14.87156200, 120.97740060, 14.87158000, 120.97740960, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2581, '1C27-9', NULL, 14.87158500, 120.97740060, 14.87160300, 120.97740960, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2582, '1C27-10', NULL, 14.87160800, 120.97740060, 14.87162600, 120.97740960, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2583, '1C27-11', NULL, 14.87163100, 120.97740060, 14.87164900, 120.97740960, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2584, '1C27-12', NULL, 14.87165400, 120.97740060, 14.87167200, 120.97740960, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2585, '1C27-13', NULL, 14.87167700, 120.97740060, 14.87169500, 120.97740960, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2586, '1C27-14', NULL, 14.87170000, 120.97740060, 14.87171800, 120.97740960, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2587, '1C27-15', NULL, 14.87172300, 120.97740060, 14.87174100, 120.97740960, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2588, '1C27-16', NULL, 14.87174600, 120.97740060, 14.87176400, 120.97740960, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2589, '1C23-1', NULL, 14.87140100, 120.97734660, 14.87141900, 120.97735560, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2590, '1C23-2', NULL, 14.87142400, 120.97734660, 14.87144200, 120.97735560, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2591, '1C23-3', NULL, 14.87144700, 120.97734660, 14.87146500, 120.97735560, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2592, '1C23-4', NULL, 14.87147000, 120.97734660, 14.87148800, 120.97735560, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2593, '1C23-5', NULL, 14.87149300, 120.97734660, 14.87151100, 120.97735560, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2594, '1C23-6', NULL, 14.87151600, 120.97734660, 14.87153400, 120.97735560, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59');
INSERT INTO `lots` (`id`, `lot_id`, `owner_id`, `latitude_start`, `longitude_start`, `latitude_end`, `longitude_end`, `status`, `created_at`, `updated_at`) VALUES
(2595, '1C23-7', NULL, 14.87153900, 120.97734660, 14.87155700, 120.97735560, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2596, '1C23-8', NULL, 14.87156200, 120.97734660, 14.87158000, 120.97735560, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2597, '1C23-9', NULL, 14.87158500, 120.97734660, 14.87160300, 120.97735560, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2598, '1C23-10', NULL, 14.87160800, 120.97734660, 14.87162600, 120.97735560, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2599, '1C23-11', NULL, 14.87163100, 120.97734660, 14.87164900, 120.97735560, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2600, '1C23-12', NULL, 14.87165400, 120.97734660, 14.87167200, 120.97735560, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2601, '1C23-13', NULL, 14.87167700, 120.97734660, 14.87169500, 120.97735560, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2602, '1C23-14', NULL, 14.87170000, 120.97734660, 14.87171800, 120.97735560, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2603, '1C23-15', NULL, 14.87172300, 120.97734660, 14.87174100, 120.97735560, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2604, '1C23-16', NULL, 14.87174600, 120.97734660, 14.87176400, 120.97735560, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2605, '1C30-1', NULL, 14.87140100, 120.97744110, 14.87141900, 120.97745010, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2606, '1C30-2', NULL, 14.87142400, 120.97744110, 14.87144200, 120.97745010, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2607, '1C30-3', NULL, 14.87144700, 120.97744110, 14.87146500, 120.97745010, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2608, '1C30-4', NULL, 14.87147000, 120.97744110, 14.87148800, 120.97745010, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2609, '1C30-5', NULL, 14.87149300, 120.97744110, 14.87151100, 120.97745010, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2610, '1C30-6', NULL, 14.87151600, 120.97744110, 14.87153400, 120.97745010, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2611, '1C30-7', NULL, 14.87153900, 120.97744110, 14.87155700, 120.97745010, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2612, '1C30-8', NULL, 14.87156200, 120.97744110, 14.87158000, 120.97745010, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2613, '1C30-9', NULL, 14.87158500, 120.97744110, 14.87160300, 120.97745010, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2614, '1C30-10', NULL, 14.87160800, 120.97744110, 14.87162600, 120.97745010, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2615, '1C30-11', NULL, 14.87163100, 120.97744110, 14.87164900, 120.97745010, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2616, '1C30-12', NULL, 14.87165400, 120.97744110, 14.87167200, 120.97745010, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2617, '1C30-13', NULL, 14.87167700, 120.97744110, 14.87169500, 120.97745010, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2618, '1C30-14', NULL, 14.87170000, 120.97744110, 14.87171800, 120.97745010, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2619, '1C30-15', NULL, 14.87172300, 120.97744110, 14.87174100, 120.97745010, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2620, '1C30-16', NULL, 14.87174600, 120.97744110, 14.87176400, 120.97745010, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2621, '1C28-1', NULL, 14.87140100, 120.97741410, 14.87141900, 120.97742310, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2622, '1C28-2', NULL, 14.87142400, 120.97741410, 14.87144200, 120.97742310, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2623, '1C28-3', NULL, 14.87144700, 120.97741410, 14.87146500, 120.97742310, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2624, '1C28-4', NULL, 14.87147000, 120.97741410, 14.87148800, 120.97742310, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2625, '1C28-5', NULL, 14.87149300, 120.97741410, 14.87151100, 120.97742310, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2626, '1C28-6', NULL, 14.87151600, 120.97741410, 14.87153400, 120.97742310, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2627, '1C28-7', NULL, 14.87153900, 120.97741410, 14.87155700, 120.97742310, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2628, '1C28-8', NULL, 14.87156200, 120.97741410, 14.87158000, 120.97742310, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2629, '1C28-9', NULL, 14.87158500, 120.97741410, 14.87160300, 120.97742310, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2630, '1C28-10', NULL, 14.87160800, 120.97741410, 14.87162600, 120.97742310, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2631, '1C28-11', NULL, 14.87163100, 120.97741410, 14.87164900, 120.97742310, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2632, '1C28-12', NULL, 14.87165400, 120.97741410, 14.87167200, 120.97742310, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2633, '1C28-13', NULL, 14.87167700, 120.97741410, 14.87169500, 120.97742310, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2634, '1C28-14', NULL, 14.87170000, 120.97741410, 14.87171800, 120.97742310, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2635, '1C28-15', NULL, 14.87172300, 120.97741410, 14.87174100, 120.97742310, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2636, '1C28-16', NULL, 14.87174600, 120.97741410, 14.87176400, 120.97742310, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2637, '1C29-1', NULL, 14.87140100, 120.97742760, 14.87141900, 120.97743660, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2638, '1C29-2', NULL, 14.87142400, 120.97742760, 14.87144200, 120.97743660, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2639, '1C29-3', NULL, 14.87144700, 120.97742760, 14.87146500, 120.97743660, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2640, '1C29-4', NULL, 14.87147000, 120.97742760, 14.87148800, 120.97743660, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2641, '1C29-5', NULL, 14.87149300, 120.97742760, 14.87151100, 120.97743660, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2642, '1C29-6', NULL, 14.87151600, 120.97742760, 14.87153400, 120.97743660, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2643, '1C29-7', NULL, 14.87153900, 120.97742760, 14.87155700, 120.97743660, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2644, '1C29-8', NULL, 14.87156200, 120.97742760, 14.87158000, 120.97743660, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2645, '1C29-9', NULL, 14.87158500, 120.97742760, 14.87160300, 120.97743660, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2646, '1C29-10', NULL, 14.87160800, 120.97742760, 14.87162600, 120.97743660, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2647, '1C29-11', NULL, 14.87163100, 120.97742760, 14.87164900, 120.97743660, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2648, '1C29-12', NULL, 14.87165400, 120.97742760, 14.87167200, 120.97743660, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2649, '1C29-13', NULL, 14.87167700, 120.97742760, 14.87169500, 120.97743660, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2650, '1C29-14', NULL, 14.87170000, 120.97742760, 14.87171800, 120.97743660, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2651, '1C29-15', NULL, 14.87172300, 120.97742760, 14.87174100, 120.97743660, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2652, '1C29-16', NULL, 14.87174600, 120.97742760, 14.87176400, 120.97743660, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2653, '1C20-1', NULL, 14.87140100, 120.97730610, 14.87141900, 120.97731510, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2654, '1C20-2', NULL, 14.87142400, 120.97730610, 14.87144200, 120.97731510, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2655, '1C20-3', NULL, 14.87144700, 120.97730610, 14.87146500, 120.97731510, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2656, '1C20-4', NULL, 14.87147000, 120.97730610, 14.87148800, 120.97731510, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2657, '1C20-5', NULL, 14.87149300, 120.97730610, 14.87151100, 120.97731510, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2658, '1C20-6', NULL, 14.87151600, 120.97730610, 14.87153400, 120.97731510, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2659, '1C20-7', NULL, 14.87153900, 120.97730610, 14.87155700, 120.97731510, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2660, '1C20-8', NULL, 14.87156200, 120.97730610, 14.87158000, 120.97731510, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2661, '1C20-9', NULL, 14.87158500, 120.97730610, 14.87160300, 120.97731510, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2662, '1C20-10', NULL, 14.87160800, 120.97730610, 14.87162600, 120.97731510, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2663, '1C20-11', NULL, 14.87163100, 120.97730610, 14.87164900, 120.97731510, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2664, '1C20-12', NULL, 14.87165400, 120.97730610, 14.87167200, 120.97731510, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2665, '1C20-13', NULL, 14.87167700, 120.97730610, 14.87169500, 120.97731510, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2666, '1C20-14', NULL, 14.87170000, 120.97730610, 14.87171800, 120.97731510, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2667, '1C20-15', NULL, 14.87172300, 120.97730610, 14.87174100, 120.97731510, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2668, '1C31-1', NULL, 14.87157100, 120.97745460, 14.87158900, 120.97746360, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2669, '1C31-2', NULL, 14.87159400, 120.97745460, 14.87161200, 120.97746360, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2670, '1C31-3', NULL, 14.87161700, 120.97745460, 14.87163500, 120.97746360, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2671, '1C31-4', NULL, 14.87164000, 120.97745460, 14.87165800, 120.97746360, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2672, '1C31-5', NULL, 14.87166300, 120.97745460, 14.87168100, 120.97746360, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2673, '1C31-6', NULL, 14.87168600, 120.97745460, 14.87170400, 120.97746360, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2674, '1C31-7', NULL, 14.87170900, 120.97745460, 14.87172700, 120.97746360, 'Available', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2675, '1C31-8', NULL, 14.87173200, 120.97745460, 14.87175000, 120.97746360, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2676, '1C31-9', NULL, 14.87175500, 120.97745460, 14.87177300, 120.97746360, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `lot_reservations`
--

CREATE TABLE `lot_reservations` (
  `id` int(11) NOT NULL,
  `lot_id` varchar(255) NOT NULL,
  `reservee_id` int(11) NOT NULL,
  `lot_type` enum('Supreme','Special','Standard','Pending') NOT NULL,
  `payment_option` enum('Cash Sale','6 Months','Installment: 1 Year','Installment: 2 Years','Installment: 3 Years','Installment: 4 Years','Installment: 5 Years','Pending') NOT NULL,
  `reservation_status` enum('Pending','Confirmed','Cancelled','Completed') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lot_reservations`
--

INSERT INTO `lot_reservations` (`id`, `lot_id`, `reservee_id`, `lot_type`, `payment_option`, `reservation_status`, `created_at`, `updated_at`) VALUES
(39, '1C1-3', 1, 'Supreme', 'Installment: 1 Year', 'Confirmed', '2025-02-02 04:01:03', '2025-02-02 04:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `phase_pricing`
--

CREATE TABLE `phase_pricing` (
  `id` int(11) NOT NULL,
  `phase` varchar(10) NOT NULL,
  `lot_type` varchar(50) NOT NULL,
  `number_of_lots` int(11) NOT NULL DEFAULT 1,
  `lot_price` decimal(10,2) NOT NULL,
  `vat` decimal(5,2) DEFAULT 12.00,
  `memorial_care_fee` decimal(10,2) DEFAULT 10000.00,
  `total_purchase_price` decimal(10,2) NOT NULL,
  `cash_sale` decimal(10,2) NOT NULL,
  `cash_sale_discount` decimal(5,2) DEFAULT 10.00,
  `six_months` decimal(10,2) NOT NULL,
  `six_months_discount` decimal(5,2) DEFAULT 5.00,
  `down_payment` decimal(10,2) NOT NULL,
  `down_payment_rate` decimal(5,2) DEFAULT 20.00,
  `balance` decimal(10,2) NOT NULL,
  `monthly_amortization_one_year` decimal(10,2) NOT NULL,
  `one_year_interest_rate` decimal(5,2) DEFAULT 0.00,
  `monthly_amortization_two_years` decimal(10,2) NOT NULL,
  `two_years_interest_rate` decimal(5,2) DEFAULT 10.00,
  `monthly_amortization_three_years` decimal(10,2) NOT NULL,
  `three_years_interest_rate` decimal(5,2) DEFAULT 15.00,
  `monthly_amortization_four_years` decimal(10,2) NOT NULL,
  `four_years_interest_rate` decimal(5,2) DEFAULT 20.00,
  `monthly_amortization_five_years` decimal(10,2) NOT NULL,
  `five_years_interest_rate` decimal(5,2) DEFAULT 25.00,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phase_pricing`
--

INSERT INTO `phase_pricing` (`id`, `phase`, `lot_type`, `number_of_lots`, `lot_price`, `vat`, `memorial_care_fee`, `total_purchase_price`, `cash_sale`, `cash_sale_discount`, `six_months`, `six_months_discount`, `down_payment`, `down_payment_rate`, `balance`, `monthly_amortization_one_year`, `one_year_interest_rate`, `monthly_amortization_two_years`, `two_years_interest_rate`, `monthly_amortization_three_years`, `three_years_interest_rate`, `monthly_amortization_four_years`, `four_years_interest_rate`, `monthly_amortization_five_years`, `five_years_interest_rate`, `updated_at`) VALUES
(1, 'Phase 1', 'Supreme', 1, 66377.00, 0.12, 10000.00, 85542.24, 76988.02, 0.10, 81265.13, 0.05, 27108.45, 0.20, 58433.79, 4869.48, 0.00, 2696.42, 0.10, 2025.63, 0.15, 1626.26, 0.15, 1715.11, 0.25, '2025-01-24 12:18:33'),
(2, 'Phase 1', 'Special', 1, 64162.00, 0.12, 10000.00, 81861.44, 74675.30, 0.10, 78268.37, 0.05, 24372.29, 0.20, 57489.15, 4790.76, 0.00, 2634.92, 0.10, 1836.46, 0.15, 1437.23, 0.15, 1197.69, 0.25, '2025-01-24 12:18:33'),
(3, 'Phase 1', 'Standard', 1, 61945.00, 0.12, 10000.00, 79378.40, 72441.00, 0.10, 75909.00, 0.05, 23786.00, 0.20, 55503.00, 4625.23, 0.00, 2543.87, 0.10, 1773.00, 0.15, 1387.57, 0.15, 1156.31, 0.25, '2025-01-24 12:18:33'),
(4, 'Phase 2', 'Supreme', 1, 64162.00, 0.12, 10000.00, 81861.44, 74675.30, 0.10, 78268.37, 0.05, 24372.29, 0.20, 57489.15, 4790.76, 0.00, 2634.92, 0.10, 1836.46, 0.15, 1437.23, 0.15, 1197.69, 0.25, '2025-01-24 12:18:33'),
(5, 'Phase 2', 'Standard', 1, 61945.00, 0.12, 10000.00, 79378.40, 72441.00, 0.10, 75909.00, 0.05, 23786.00, 0.20, 55503.00, 4625.23, 0.00, 2543.87, 0.10, 1773.00, 0.15, 1387.57, 0.15, 1156.31, 0.25, '2025-01-24 12:18:33'),
(6, 'Phase 3', 'Supreme', 1, 63491.00, 0.12, 10000.00, 81109.92, 73999.00, 0.10, 77554.00, 0.05, 24222.00, 0.20, 56888.00, 4740.66, 0.00, 2607.36, 0.10, 1817.25, 0.15, 1422.20, 0.15, 1185.17, 0.25, '2025-01-24 12:18:33'),
(7, 'Phase 3', 'Special', 1, 61372.00, 0.12, 10000.00, 78736.64, 71863.00, 0.10, 75300.00, 0.05, 23747.00, 0.20, 54989.00, 4582.44, 0.00, 2520.34, 0.10, 1756.60, 0.15, 1374.73, 0.15, 1145.61, 0.25, '2025-01-24 12:18:33'),
(8, 'Phase 3', 'Standard', 1, 59256.00, 0.12, 10000.00, 76366.72, 69730.00, 0.10, 73048.00, 0.05, 23273.00, 0.20, 53093.00, 4424.45, 0.00, 2433.45, 0.10, 1696.04, 0.15, 1327.33, 0.15, 1106.11, 0.25, '2025-01-24 12:18:33'),
(9, 'Phase 4', 'Supreme', 1, 63491.00, 0.12, 10000.00, 81109.92, 73999.00, 0.10, 77554.00, 0.05, 24222.00, 0.20, 56888.00, 4740.66, 0.00, 2607.36, 0.10, 1817.25, 0.15, 1422.20, 0.15, 1185.17, 0.25, '2025-01-24 12:18:33'),
(10, 'Phase 4', 'Special', 1, 61372.00, 0.12, 10000.00, 78736.64, 71863.00, 0.10, 75300.00, 0.05, 23747.00, 0.20, 54989.00, 4582.44, 0.00, 2520.34, 0.10, 1756.60, 0.15, 1374.73, 0.15, 1145.61, 0.25, '2025-01-24 12:18:33'),
(11, 'Phase 4', 'Standard', 1, 59256.00, 0.12, 10000.00, 76366.72, 69730.00, 0.10, 73048.00, 0.05, 23273.00, 0.20, 53093.00, 4424.45, 0.00, 2433.45, 0.10, 1696.04, 0.15, 1327.33, 0.15, 1106.11, 0.25, '2025-01-24 12:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `six_months`
--

CREATE TABLE `six_months` (
  `id` int(11) NOT NULL,
  `lot_id` varchar(255) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_status` enum('Pending','Paid','Overdue') DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `six_months_due_dates`
--

CREATE TABLE `six_months_due_dates` (
  `id` int(11) NOT NULL,
  `lot_id` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `created_at`) VALUES
(1, 'admin@mail.com', '$2b$12$CXsdriK0Qd2Qd3GCHEf.Zey4jvnoxSPWxwkyYDTE3.DLbj0M6YGrC', '2025-01-22 09:09:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backup_settings`
--
ALTER TABLE `backup_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `cash_sales`
--
ALTER TABLE `cash_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lot_id` (`lot_id`);

--
-- Indexes for table `cash_sale_due_dates`
--
ALTER TABLE `cash_sale_due_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lot_reservation_id` (`lot_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`);

--
-- Indexes for table `estates`
--
ALTER TABLE `estates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estate_id` (`estate_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `estate_cash_sales`
--
ALTER TABLE `estate_cash_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estate_id` (`estate_id`);

--
-- Indexes for table `estate_cash_sale_due_dates`
--
ALTER TABLE `estate_cash_sale_due_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estate_id` (`estate_id`);

--
-- Indexes for table `estate_installments`
--
ALTER TABLE `estate_installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estate_id` (`estate_id`);

--
-- Indexes for table `estate_installment_payments`
--
ALTER TABLE `estate_installment_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `installment_id` (`installment_id`);

--
-- Indexes for table `estate_pricing`
--
ALTER TABLE `estate_pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estate_reservations`
--
ALTER TABLE `estate_reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estate_id` (`estate_id`),
  ADD KEY `reservee_id` (`reservee_id`);

--
-- Indexes for table `estate_six_months`
--
ALTER TABLE `estate_six_months`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estate_id` (`estate_id`);

--
-- Indexes for table `estate_six_months_due_dates`
--
ALTER TABLE `estate_six_months_due_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estate_id` (`estate_id`);

--
-- Indexes for table `installments`
--
ALTER TABLE `installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lot_id` (`lot_id`);

--
-- Indexes for table `installment_payments`
--
ALTER TABLE `installment_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `installment_id` (`installment_id`);

--
-- Indexes for table `lots`
--
ALTER TABLE `lots`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lot_id` (`lot_id`) USING BTREE,
  ADD KEY `fk_customer_id` (`owner_id`);

--
-- Indexes for table `lot_reservations`
--
ALTER TABLE `lot_reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lot_id` (`lot_id`);

--
-- Indexes for table `phase_pricing`
--
ALTER TABLE `phase_pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `six_months`
--
ALTER TABLE `six_months`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lot_id` (`lot_id`);

--
-- Indexes for table `six_months_due_dates`
--
ALTER TABLE `six_months_due_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lot_reservation_id` (`lot_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backup_settings`
--
ALTER TABLE `backup_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cash_sales`
--
ALTER TABLE `cash_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cash_sale_due_dates`
--
ALTER TABLE `cash_sale_due_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `estates`
--
ALTER TABLE `estates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `estate_cash_sales`
--
ALTER TABLE `estate_cash_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `estate_cash_sale_due_dates`
--
ALTER TABLE `estate_cash_sale_due_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `estate_installments`
--
ALTER TABLE `estate_installments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `estate_installment_payments`
--
ALTER TABLE `estate_installment_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `estate_pricing`
--
ALTER TABLE `estate_pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `estate_reservations`
--
ALTER TABLE `estate_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `estate_six_months`
--
ALTER TABLE `estate_six_months`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `estate_six_months_due_dates`
--
ALTER TABLE `estate_six_months_due_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `installments`
--
ALTER TABLE `installments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `installment_payments`
--
ALTER TABLE `installment_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `lots`
--
ALTER TABLE `lots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2677;

--
-- AUTO_INCREMENT for table `lot_reservations`
--
ALTER TABLE `lot_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `phase_pricing`
--
ALTER TABLE `phase_pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `six_months`
--
ALTER TABLE `six_months`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `six_months_due_dates`
--
ALTER TABLE `six_months_due_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD CONSTRAINT `beneficiaries_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cash_sales`
--
ALTER TABLE `cash_sales`
  ADD CONSTRAINT `cash_sales_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lot_reservations` (`lot_id`);

--
-- Constraints for table `cash_sale_due_dates`
--
ALTER TABLE `cash_sale_due_dates`
  ADD CONSTRAINT `cash_sale_due_dates_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lot_reservations` (`lot_id`) ON DELETE CASCADE;

--
-- Constraints for table `estates`
--
ALTER TABLE `estates`
  ADD CONSTRAINT `estates_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `estate_cash_sales`
--
ALTER TABLE `estate_cash_sales`
  ADD CONSTRAINT `estate_cash_sales_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE;

--
-- Constraints for table `estate_cash_sale_due_dates`
--
ALTER TABLE `estate_cash_sale_due_dates`
  ADD CONSTRAINT `estate_cash_sale_due_dates_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE;

--
-- Constraints for table `estate_installments`
--
ALTER TABLE `estate_installments`
  ADD CONSTRAINT `estate_installments_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE;

--
-- Constraints for table `estate_installment_payments`
--
ALTER TABLE `estate_installment_payments`
  ADD CONSTRAINT `estate_installment_payments_ibfk_1` FOREIGN KEY (`installment_id`) REFERENCES `estate_installments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `estate_reservations`
--
ALTER TABLE `estate_reservations`
  ADD CONSTRAINT `estate_reservations_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `estate_reservations_ibfk_2` FOREIGN KEY (`reservee_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `estate_six_months`
--
ALTER TABLE `estate_six_months`
  ADD CONSTRAINT `estate_six_months_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE;

--
-- Constraints for table `estate_six_months_due_dates`
--
ALTER TABLE `estate_six_months_due_dates`
  ADD CONSTRAINT `estate_six_months_due_dates_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE;

--
-- Constraints for table `installments`
--
ALTER TABLE `installments`
  ADD CONSTRAINT `installments_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lot_reservations` (`lot_id`) ON DELETE CASCADE;

--
-- Constraints for table `installment_payments`
--
ALTER TABLE `installment_payments`
  ADD CONSTRAINT `installment_payments_ibfk_1` FOREIGN KEY (`installment_id`) REFERENCES `installments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lot_reservations`
--
ALTER TABLE `lot_reservations`
  ADD CONSTRAINT `lot_reservations_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lots` (`lot_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `six_months`
--
ALTER TABLE `six_months`
  ADD CONSTRAINT `six_months_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lot_reservations` (`lot_id`) ON DELETE CASCADE;

--
-- Constraints for table `six_months_due_dates`
--
ALTER TABLE `six_months_due_dates`
  ADD CONSTRAINT `six_months_due_dates_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lot_reservations` (`lot_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

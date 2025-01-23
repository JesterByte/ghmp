-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 02:19 PM
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
-- Table structure for table `estate_pricing`
--

CREATE TABLE `estate_pricing` (
  `id` int(11) NOT NULL,
  `estate` varchar(50) DEFAULT NULL,
  `sqm` decimal(10,2) DEFAULT NULL,
  `number_of_lots` int(11) DEFAULT NULL,
  `lot_price` decimal(15,2) DEFAULT NULL,
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

INSERT INTO `estate_pricing` (`id`, `estate`, `sqm`, `number_of_lots`, `lot_price`, `total_purchase_price`, `cash_sale`, `cash_sale_discount`, `six_months`, `six_months_discount`, `down_payment`, `down_payment_rate`, `balance`, `monthly_amortization_one_year`, `one_year_interest_rate`, `monthly_amortization_two_years`, `two_years_interest_rate`, `monthly_amortization_three_years`, `three_years_interest_rate`, `monthly_amortization_four_years`, `four_years_interest_rate`, `monthly_amortization_five_years`, `five_years_interest_rate`) VALUES
(1, 'Estate A', 20.00, 8, 500.00, 80560.00, 80504.00, 0.10, 80532.00, 0.05, 80112.00, 0.20, 448.00, 37.33, 0.00, 20.53, 0.10, 14.31, 0.15, 11.20, 0.20, 9.33, 0.25),
(2, 'Estate B', 17.50, 7, 449134.00, 573030.08, 522727.00, 0.10, 547879.00, 0.05, 170606.00, 0.20, 402424.06, 33535.34, 0.00, 18444.42, 0.10, 12855.21, 0.15, 10060.60, 0.20, 8383.83, 0.25),
(3, 'Estate C', 16.00, 6, 406342.40, 519103.49, 473593.00, 0.10, 496348.00, 0.05, 155021.00, 0.20, 364082.79, 30340.23, 0.00, 16687.13, 0.10, 11630.42, 0.15, 9102.07, 0.20, 7585.06, 0.25);

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
(1, 'Phase 1', 'Supreme', 1, 66377.00, 0.12, 10000.00, 85542.24, 76988.02, 0.10, 81265.13, 0.05, 27108.45, 0.20, 58433.79, 4869.48, 0.00, 2696.42, 0.10, 2025.63, 0.15, 1626.26, 0.15, 1715.11, 0.25, '2025-01-23 11:21:36'),
(2, 'Phase 1', 'Special', 1, 64162.00, 0.12, 10000.00, 81861.44, 74675.30, 0.10, 78268.37, 0.05, 24372.29, 0.20, 57489.15, 4790.76, 0.00, 2634.92, 0.10, 1836.46, 0.15, 1437.23, 0.15, 1197.69, 0.25, '2025-01-23 11:17:24'),
(3, 'Phase 1', 'Standard', 1, 61945.00, 0.12, 10000.00, 79378.40, 72441.00, 0.10, 75909.00, 0.05, 23786.00, 0.20, 55503.00, 4625.23, 0.00, 2543.87, 0.10, 1773.00, 0.15, 1387.57, 0.15, 1156.31, 0.25, '2025-01-23 11:17:24'),
(4, 'Phase 2', 'Supreme', 1, 64162.00, 0.12, 10000.00, 81861.44, 74675.30, 0.10, 78268.37, 0.05, 24372.29, 0.20, 57489.15, 4790.76, 0.00, 2634.92, 0.10, 1836.46, 0.15, 1437.23, 0.15, 1197.69, 0.25, '2025-01-23 11:17:24'),
(5, 'Phase 2', 'Standard', 1, 61945.00, 0.12, 10000.00, 79378.40, 72441.00, 0.10, 75909.00, 0.05, 23786.00, 0.20, 55503.00, 4625.23, 0.00, 2543.87, 0.10, 1773.00, 0.15, 1387.57, 0.15, 1156.31, 0.25, '2025-01-23 11:17:24'),
(6, 'Phase 3', 'Supreme', 1, 63491.00, 0.12, 10000.00, 81109.92, 73999.00, 0.10, 77554.00, 0.05, 24222.00, 0.20, 56888.00, 4740.66, 0.00, 2607.36, 0.10, 1817.25, 0.15, 1422.20, 0.15, 1185.17, 0.25, '2025-01-23 11:17:24'),
(7, 'Phase 3', 'Special', 1, 61372.00, 0.12, 10000.00, 78736.64, 71863.00, 0.10, 75300.00, 0.05, 23747.00, 0.20, 54989.00, 4582.44, 0.00, 2520.34, 0.10, 1756.60, 0.15, 1374.73, 0.15, 1145.61, 0.25, '2025-01-23 11:17:24'),
(8, 'Phase 3', 'Standard', 1, 59256.00, 0.12, 10000.00, 76366.72, 69730.00, 0.10, 73048.00, 0.05, 23273.00, 0.20, 53093.00, 4424.45, 0.00, 2433.45, 0.10, 1696.04, 0.15, 1327.33, 0.15, 1106.11, 0.25, '2025-01-23 11:17:24'),
(9, 'Phase 4', 'Supreme', 1, 63491.00, 0.12, 10000.00, 81109.92, 73999.00, 0.10, 77554.00, 0.05, 24222.00, 0.20, 56888.00, 4740.66, 0.00, 2607.36, 0.10, 1817.25, 0.15, 1422.20, 0.15, 1185.17, 0.25, '2025-01-23 11:17:24'),
(10, 'Phase 4', 'Special', 1, 61372.00, 0.12, 10000.00, 78736.64, 71863.00, 0.10, 75300.00, 0.05, 23747.00, 0.20, 54989.00, 4582.44, 0.00, 2520.34, 0.10, 1756.60, 0.15, 1374.73, 0.15, 1145.61, 0.25, '2025-01-23 11:17:24'),
(11, 'Phase 4', 'Standard', 1, 59256.00, 0.12, 10000.00, 76366.72, 69730.00, 0.10, 73048.00, 0.05, 23273.00, 0.20, 53093.00, 4424.45, 0.00, 2433.45, 0.10, 1696.04, 0.15, 1327.33, 0.15, 1106.11, 0.25, '2025-01-23 11:17:24');

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
-- Indexes for table `estate_pricing`
--
ALTER TABLE `estate_pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phase_pricing`
--
ALTER TABLE `phase_pricing`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `estate_pricing`
--
ALTER TABLE `estate_pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `phase_pricing`
--
ALTER TABLE `phase_pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

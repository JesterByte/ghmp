-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 28, 2025 at 01:02 PM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u714551035_ghmp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `admin_id`, `message`, `link`, `is_read`, `created_at`) VALUES
(17, 1, 'A new customer, John Louric Dacutanan, has registered.', 'customers', 0, '2025-03-28 13:13:48'),
(18, 1, 'A new customer, Ramon Paguia, has registered.', 'customers', 0, '2025-03-28 13:13:48'),
(19, 1, 'A new customer, Justine Jay Ibañez, has registered.', 'customers', 0, '2025-03-28 13:14:31'),
(20, 1, 'A new customer, Wally Bayola, has registered.', 'customers', 0, '2025-03-28 13:14:40'),
(21, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 5 - Lot 1.', 'lot-reservations', 0, '2025-03-28 13:14:44'),
(22, 1, 'A new customer, Jiwao Tabancay, has registered.', 'customers', 0, '2025-03-28 13:14:50'),
(23, NULL, 'John Louric Dacutanan has updated their profile.', 'customers', 0, '2025-03-28 13:14:58'),
(24, 1, 'A new customer, Ann Cathlyn Ydio, has registered.', 'customers', 0, '2025-03-28 13:15:14'),
(25, NULL, 'John Louric Dacutanan has updated their profile.', 'customers', 0, '2025-03-28 13:15:27'),
(26, NULL, 'John Louric Dacutanan has changed their password.', 'customers', 0, '2025-03-28 13:16:11'),
(27, 1, 'A new customer, Miguel Aeh, has registered.', 'customers', 0, '2025-03-28 13:16:33'),
(28, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 21 - Lot 1.', 'lot-reservations', 0, '2025-03-28 13:16:49'),
(29, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 5 - Lot 11.', 'lot-reservations', 0, '2025-03-28 13:17:19'),
(30, 1, 'A new customer, Quando Tabancay, has registered.', 'customers', 0, '2025-03-28 13:17:43'),
(31, NULL, 'A new estate reservation has been made for Estate ID: Estate C #1.', 'estate-reservations', 0, '2025-03-28 13:17:58'),
(32, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 1 - Lot 3.', 'lot-reservations', 0, '2025-03-28 13:18:03'),
(33, 1, 'A new customer, Rhyver Gasacao, has registered.', 'customers', 0, '2025-03-28 13:18:04'),
(34, 1, 'A new customer, Gusion Tabancay, has registered.', 'customers', 0, '2025-03-28 13:18:11'),
(35, 1, 'A new customer, Iris Christine Balasbas, has registered.', 'customers', 0, '2025-03-28 13:18:52'),
(36, 1, 'A new customer, Bombardino Tabancay, has registered.', 'customers', 0, '2025-03-28 13:19:08'),
(37, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 12 - Lot 14.', 'lot-reservations', 0, '2025-03-28 13:19:09'),
(38, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 20 - Lot 10.', 'lot-reservations', 0, '2025-03-28 13:19:12'),
(39, NULL, 'A new estate reservation has been made for Estate ID: Estate A #1.', 'estate-reservations', 0, '2025-03-28 13:19:14'),
(40, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 12 - Lot 8.', 'lot-reservations', 0, '2025-03-28 13:19:17'),
(41, NULL, 'A new estate reservation has been made for Estate ID: Estate B #1.', 'estate-reservations', 0, '2025-03-28 13:19:19'),
(42, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 31 - Lot 1.', 'lot-reservations', 0, '2025-03-28 13:19:19'),
(43, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 28 - Lot 6.', 'lot-reservations', 0, '2025-03-28 13:19:35'),
(44, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 26 - Lot 1.', 'lot-reservations', 0, '2025-03-28 13:19:38'),
(45, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 26 - Lot 2.', 'lot-reservations', 0, '2025-03-28 13:19:46'),
(46, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 31 - Lot 7.', 'lot-reservations', 0, '2025-03-28 13:20:09'),
(47, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 27 - Lot 10.', 'lot-reservations', 0, '2025-03-28 13:20:19'),
(48, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 17 - Lot 9.', 'lot-reservations', 0, '2025-03-28 13:20:25'),
(49, 1, 'A new customer, Justinpaul Nocete, has registered.', 'customers', 0, '2025-03-28 13:20:26'),
(50, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 29 - Lot 15.', 'lot-reservations', 0, '2025-03-28 13:20:29'),
(51, 1, 'A new customer, Arnold Nitor, has registered.', 'customers', 0, '2025-03-28 13:20:40'),
(52, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 28 - Lot 15.', 'lot-reservations', 0, '2025-03-28 13:20:45'),
(53, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 27 - Lot 3.', 'lot-reservations', 0, '2025-03-28 13:21:12'),
(54, 1, 'A new customer, Ash Consultado, has registered.', 'customers', 0, '2025-03-28 13:21:12'),
(55, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 13 - Lot 15.', 'lot-reservations', 0, '2025-03-28 13:21:15'),
(56, 1, 'A new customer, Shirwen Rabago, has registered.', 'customers', 0, '2025-03-28 13:21:16'),
(57, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 8 - Lot 10.', 'lot-reservations', 0, '2025-03-28 13:21:18'),
(58, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 22 - Lot 2.', 'lot-reservations', 0, '2025-03-28 13:21:30'),
(59, NULL, 'Bombardino Crocodilo Tabancay has updated their profile.', 'customers', 0, '2025-03-28 13:23:07'),
(60, NULL, 'Quando Quando Tabancay, Jr. has updated their profile.', 'customers', 0, '2025-03-28 13:23:08'),
(61, NULL, 'Bombardino Crocodilo Tabancay has updated their profile.', 'customers', 0, '2025-03-28 13:23:24'),
(62, NULL, 'Quando Quando Tabancay, Jr. has updated their profile.', 'customers', 0, '2025-03-28 13:23:29'),
(63, 1, 'A new customer, Manny Err, has registered.', 'customers', 0, '2025-03-28 13:24:00'),
(64, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 26 - Lot 5.', 'lot-reservations', 0, '2025-03-28 13:24:33'),
(65, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 23 - Lot 7.', 'lot-reservations', 0, '2025-03-28 13:24:36'),
(66, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 5 - Lot 14.', 'lot-reservations', 0, '2025-03-28 13:25:12'),
(67, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 6 - Lot 14.', 'lot-reservations', 0, '2025-03-28 13:25:16'),
(68, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 26 - Lot 16.', 'lot-reservations', 0, '2025-03-28 13:25:20'),
(69, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 24 - Lot 16.', 'lot-reservations', 0, '2025-03-28 13:25:25'),
(70, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 26 - Lot 6.', 'lot-reservations', 0, '2025-03-28 13:25:30'),
(71, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 3 - Lot 8.', 'lot-reservations', 0, '2025-03-28 13:25:35'),
(72, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 12 - Lot 2.', 'lot-reservations', 0, '2025-03-28 13:25:39'),
(73, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 17 - Lot 1.', 'lot-reservations', 0, '2025-03-28 13:25:44'),
(74, 1, 'A new customer, Ash Consultado, has registered.', 'customers', 0, '2025-03-28 13:25:56'),
(75, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 3 - Lot 13.', 'lot-reservations', 0, '2025-03-28 13:26:15'),
(76, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 9 - Lot 1.', 'lot-reservations', 0, '2025-03-28 13:26:36'),
(77, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 6 - Lot 2.', 'lot-reservations', 0, '2025-03-28 13:26:43'),
(78, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 2 - Lot 12.', 'lot-reservations', 0, '2025-03-28 13:26:52'),
(79, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 26 - Lot 16.', 'lot-reservations', 0, '2025-03-28 13:27:00'),
(80, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 22 - Lot 3.', 'lot-reservations', 0, '2025-03-28 13:27:12'),
(81, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 12 - Lot 6.', 'lot-reservations', 0, '2025-03-28 13:27:38'),
(82, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 15 - Lot 4.', 'lot-reservations', 0, '2025-03-28 13:27:42'),
(83, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 19 - Lot 11.', 'lot-reservations', 0, '2025-03-28 13:27:46'),
(84, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 25 - Lot 15.', 'lot-reservations', 0, '2025-03-28 13:27:52'),
(85, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 25 - Lot 14.', 'lot-reservations', 0, '2025-03-28 13:27:57'),
(86, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 24 - Lot 14.', 'lot-reservations', 0, '2025-03-28 13:28:02'),
(87, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 17 - Lot 15.', 'lot-reservations', 0, '2025-03-28 13:28:06'),
(88, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 12 - Lot 15.', 'lot-reservations', 0, '2025-03-28 13:28:10'),
(89, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 1 - Lot 5.', 'lot-reservations', 0, '2025-03-28 13:28:13'),
(90, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 3 - Lot 13.', 'lot-reservations', 0, '2025-03-28 13:28:22'),
(91, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 1 - Lot 4.', 'lot-reservations', 0, '2025-03-28 13:28:30'),
(92, 1, 'A new customer, Iris Christine Balasbas, has registered.', 'customers', 0, '2025-03-28 13:28:49'),
(93, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 6 - Lot 10.', 'lot-reservations', 0, '2025-03-28 13:30:41'),
(94, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 20 - Lot 2.', 'lot-reservations', 0, '2025-03-28 13:31:10'),
(95, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 17 - Lot 2.', 'lot-reservations', 0, '2025-03-28 13:31:15'),
(96, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 3 - Lot 8.', 'lot-reservations', 0, '2025-03-28 13:31:16'),
(97, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 19 - Lot 2.', 'lot-reservations', 0, '2025-03-28 13:31:20'),
(98, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 5 - Lot 10.', 'lot-reservations', 0, '2025-03-28 13:31:20'),
(99, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 5 - Lot 8.', 'lot-reservations', 0, '2025-03-28 13:31:26'),
(100, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 18 - Lot 1.', 'lot-reservations', 0, '2025-03-28 13:31:26'),
(101, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 17 - Lot 1.', 'lot-reservations', 0, '2025-03-28 13:31:31'),
(102, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 8 - Lot 8.', 'lot-reservations', 0, '2025-03-28 13:31:31'),
(103, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 16 - Lot 1.', 'lot-reservations', 0, '2025-03-28 13:31:35'),
(104, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 26 - Lot 6.', 'lot-reservations', 0, '2025-03-28 13:31:36'),
(105, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 12 - Lot 1.', 'lot-reservations', 0, '2025-03-28 13:31:40'),
(106, 1, 'A new customer, Feb Boromeo, has registered.', 'customers', 0, '2025-03-28 13:39:57'),
(107, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 18 - Lot 14.', 'lot-reservations', 0, '2025-03-28 13:42:00'),
(108, 1, 'A new customer, Christine Abiog, has registered.', 'customers', 0, '2025-03-28 14:05:06'),
(109, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 27 - Lot 11.', 'lot-reservations', 0, '2025-03-28 14:07:02'),
(110, NULL, 'A new burial reservation has been made for Asset ID: Phase 1 Lawn C Row 27 - Lot 11.', 'burial-reservations', 0, '2025-03-28 14:13:46'),
(111, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 16 - Lot 7.', 'lot-reservations', 0, '2025-03-28 14:29:36'),
(112, 1, 'A new customer, Roy Abad, has registered.', 'customers', 0, '2025-03-28 14:50:31'),
(113, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 22 - Lot 3.', 'lot-reservations', 0, '2025-03-28 14:51:38'),
(114, NULL, 'A new burial reservation has been made for Asset ID: Phase 1 Lawn C Row 22 - Lot 3.', 'burial-reservations', 0, '2025-03-28 15:00:39'),
(115, 1, 'A new customer, Dy An Amay, has registered.', 'customers', 0, '2025-03-28 15:12:10'),
(116, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 1 - Lot 5.', 'lot-reservations', 0, '2025-03-28 15:13:37'),
(117, 1, 'A new customer, Dy An Amay, has registered.', 'customers', 0, '2025-03-28 16:11:32'),
(118, NULL, 'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 1 - Lot 4.', 'lot-reservations', 0, '2025-03-28 16:12:15');

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
(1, '17:49:00');

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
  `password_hashed` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Inactive',
  `relationship_to_customer` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`id`, `customer_id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `contact_number`, `email_address`, `password_hashed`, `status`, `relationship_to_customer`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mary', 'C.', 'Doe', NULL, '1122334455', 'ejjose94@gmail.com', '$2y$10$aU9ShBiq4jS1ZR4ljTJAS.XFKJwwjwpsfpCQUBxkftYA89pw0Zr7e', 'Active', 'Spouse', '2025-01-26 16:55:33', '2025-03-28 08:51:00'),
(2, 1, 'James', NULL, 'Doe', NULL, '5566778899', NULL, NULL, 'Inactive', 'Son', '2025-01-26 16:55:33', '2025-01-26 16:55:33'),
(3, 2, 'Robert', 'D.', 'Smith', NULL, '6677889900', 'robert.smith@example.com', NULL, 'Inactive', 'Brother', '2025-01-26 16:55:33', '2025-01-26 16:55:33'),
(4, 3, 'Test2', 'Test2', 'Test2', 'Jr.', '09123456789', 'test2@gmail.com', NULL, 'Inactive', 'Parent', '2025-03-28 08:30:02', '2025-03-28 08:30:02'),
(5, 4, 'Joanna', '', 'Villanueva', '', '09121231234', 'joannavillanueva@gmail.com', NULL, 'Inactive', 'Spouse', '2025-03-28 08:56:34', '2025-03-28 08:56:34'),
(6, 5, 'Dorinel', 'D.', 'Naligo', '', '09614121453', 'ecgwinimarquez@gmail.com', NULL, 'Inactive', 'Friend', '2025-03-28 11:51:20', '2025-03-28 11:51:20'),
(7, 6, 'Professor', 'X', 'Men', '', '09144351823', 'professorxmen@gmail.com', NULL, 'Inactive', 'Other', '2025-03-28 13:10:25', '2025-03-28 13:10:25'),
(8, 7, 'Jaymar', 'P', 'Alindahao', 'II', '09709391271', 'jaysogood1425@gmail.com', NULL, 'Inactive', 'Sibling', '2025-03-28 13:10:48', '2025-03-28 13:10:48'),
(9, 8, 'Magneto', '', 'X', '', '09922476360', 'magneto1243@gmail.com', NULL, 'Inactive', 'Other', '2025-03-28 13:13:48', '2025-03-28 13:13:48'),
(10, 9, 'Petpet', 'Patpat', 'Potpot', '', '09207619254', 'ramonbongpaguia@gmail.com', NULL, 'Inactive', 'Friend', '2025-03-28 13:13:48', '2025-03-28 13:13:48'),
(11, 10, 'Julieta Ibañez', '', 'Miparanum', '', '09071899220', 'ibanezjustinejay4@gmail.com', NULL, 'Inactive', 'Parent', '2025-03-28 13:14:31', '2025-03-28 13:14:31'),
(12, 11, 'Nino', '', 'Barzaga', 'Sr.', '09050404444', 'kalasd@gmail.com', NULL, 'Inactive', 'Spouse', '2025-03-28 13:14:40', '2025-03-28 13:14:40'),
(13, 12, 'Beetlejuice', '', 'Juicy', 'Jr.', '09945823951', 'bagaysayolods@gmail.com', NULL, 'Inactive', 'Friend', '2025-03-28 13:14:50', '2025-03-28 13:14:50'),
(14, 13, 'Khel', '', 'Ydio', '', '09268338870', 'john.ydio@gmail.com', NULL, 'Inactive', 'Spouse', '2025-03-28 13:15:14', '2025-03-28 13:15:14'),
(15, 14, 'Nig', 'L', 'Ger', '', '09324569887', 'endnaaa223@gmail.com', NULL, 'Inactive', 'Child', '2025-03-28 13:16:33', '2025-03-28 13:16:33'),
(16, 20, 'Robbie', '', 'Tabancay', 'Sr.', '09087769645', 'robbietabancay23@gmail.com', NULL, 'Inactive', 'Parent', '2025-03-28 13:17:43', '2025-03-28 13:17:43'),
(17, 23, 'Khaleed', 'Dela Cruz', 'Gasacao', '', '09996895178', 'khaleedg@gmail.com', NULL, 'Inactive', 'Child', '2025-03-28 13:18:04', '2025-03-28 13:18:04'),
(18, 24, 'Gusion', '', 'Tabancay', 'Jr.', '09603913057', 'ttqmalaki@gmail.com', NULL, 'Inactive', 'Other', '2025-03-28 13:18:11', '2025-03-28 13:18:11'),
(19, 25, 'Shan Cai', '', 'Loyola', '', '09542382883', 'sloyola739@gmail.com', NULL, 'Inactive', 'Friend', '2025-03-28 13:18:52', '2025-03-28 13:18:52'),
(20, 26, 'Robbie', '', 'Tabancay', 'Sr.', '09234543423', 'gdharrenz@gmail.com', NULL, 'Inactive', 'Parent', '2025-03-28 13:19:08', '2025-03-28 13:19:08'),
(21, 29, 'Rhyver', 'Tadeo', 'Gasacao', 'Jr.', '09074508119', 'ikawlangsapatna143@gmail.com', NULL, 'Inactive', 'Other', '2025-03-28 13:20:26', '2025-03-28 13:20:26'),
(22, 30, 'Ann', 'P', 'Catlyn', 'V', '09491626522', 'jpiarnitor@gmail.com', NULL, 'Inactive', 'Parent', '2025-03-28 13:20:40', '2025-03-28 13:20:40'),
(23, 32, 'Shirwen', 'Elisio', 'Rabago', '', '09675964640', 'rabagosherwin235@gmail.com', NULL, 'Inactive', 'Friend', '2025-03-28 13:21:12', '2025-03-28 13:21:12'),
(24, 34, 'Ash', 'Viray', 'Consultado', '', '09874563211', 'ashashcutie@gmail.com', NULL, 'Inactive', 'Friend', '2025-03-28 13:21:16', '2025-03-28 13:21:16'),
(25, 40, 'Niel', 'G', 'Err', 'Sr.', '09745234118', 'jgorupogi@gmail.com', NULL, 'Inactive', 'Other', '2025-03-28 13:24:00', '2025-03-28 13:24:00'),
(26, 42, 'Shirwen', 'Elisio', 'Rabago', '', '09874563211', 'rabagoshirwen@gmail.com', NULL, 'Inactive', 'Friend', '2025-03-28 13:25:56', '2025-03-28 13:25:56'),
(27, 43, 'Shan Cai', '', 'Loyola', '', '09542382883', 'sloyola739@gmail.com', NULL, 'Inactive', 'Friend', '2025-03-28 13:28:49', '2025-03-28 13:28:49'),
(28, 44, 'Rex', '', 'Formentera', '', '09813833477', 'rexformentera004@gmail.com', NULL, 'Inactive', 'Friend', '2025-03-28 13:39:57', '2025-03-28 13:39:57'),
(29, 45, 'Jm', 'Alberto', 'Balangue', '', '09307805806', 'jmbalangue@gmail.com', NULL, 'Inactive', 'Friend', '2025-03-28 14:05:06', '2025-03-28 14:05:06'),
(30, 46, 'Nathan', '', 'Tagle', '', '09753850346', 'abadroy27@gmail.com', NULL, 'Inactive', 'Friend', '2025-03-28 14:50:31', '2025-03-28 14:50:31'),
(31, 47, 'Christine', '', 'Abiog', '', '09059150013', 'judyanneflorespuno@gmail.com', NULL, 'Inactive', 'Friend', '2025-03-28 15:12:10', '2025-03-28 15:12:10'),
(32, 48, 'Christine', '', 'Abiog', '', '09059150013', 'judyanne@gmail.com', NULL, 'Inactive', 'Friend', '2025-03-28 16:11:32', '2025-03-28 16:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `burial_pricing`
--

CREATE TABLE `burial_pricing` (
  `id` int(11) NOT NULL,
  `category` enum('Lot','Estate') NOT NULL,
  `burial_type` enum('Standard','Cremation','Mausoleum','Bone Transfer') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `burial_pricing`
--

INSERT INTO `burial_pricing` (`id`, `category`, `burial_type`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Lot', 'Standard', 50000.00, '2025-02-27 00:17:52', '2025-03-09 08:59:38'),
(2, 'Lot', 'Cremation', 30000.00, '2025-02-27 00:17:52', '2025-02-27 00:17:52'),
(3, 'Lot', 'Bone Transfer', 20000.00, '2025-02-27 00:17:52', '2025-02-27 00:17:52'),
(4, 'Estate', 'Standard', 100000.00, '2025-02-27 00:17:52', '2025-03-01 11:05:52'),
(5, 'Estate', 'Mausoleum', 200000.00, '2025-02-27 00:17:52', '2025-02-27 00:17:52'),
(6, 'Estate', 'Bone Transfer', 50000.00, '2025-02-27 00:17:52', '2025-02-27 00:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `burial_reservations`
--

CREATE TABLE `burial_reservations` (
  `id` int(11) NOT NULL,
  `reservee_id` int(11) NOT NULL,
  `asset_id` varchar(50) NOT NULL,
  `burial_type` enum('Standard','Cremation','Mausoleum','Bone Transfer') NOT NULL,
  `relationship` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `suffix` enum('Sr.','Jr.','I','II','III','IV','V','') DEFAULT '',
  `date_of_birth` date NOT NULL,
  `date_of_death` date NOT NULL,
  `obituary` text NOT NULL,
  `date_time` datetime NOT NULL,
  `status` enum('Pending','Approved','Completed','Cancelled') DEFAULT 'Pending',
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('Pending','Paid','Overdue','') NOT NULL DEFAULT 'Pending',
  `reference_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `burial_reservations`
--

INSERT INTO `burial_reservations` (`id`, `reservee_id`, `asset_id`, `burial_type`, `relationship`, `first_name`, `middle_name`, `last_name`, `suffix`, `date_of_birth`, `date_of_death`, `obituary`, `date_time`, `status`, `payment_amount`, `payment_status`, `reference_number`, `created_at`) VALUES
(27, 45, '1C27-11', 'Cremation', 'Students', 'Mj Pj Eugene', '', 'Aclc', '', '2000-03-28', '2025-03-28', 'nsjsjs', '2025-03-28 14:13:00', 'Approved', 30000.00, 'Paid', '', '2025-03-28 06:13:46'),
(28, 46, '1C22-3', 'Standard', 'Child', 'Rey', '', 'Tagle', '', '2000-01-15', '2025-03-28', 'aschadjkcbklchhqlkscbas,.cn', '2025-03-28 13:00:00', 'Pending', 50000.00, 'Pending', '', '2025-03-28 07:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `cash_sales`
--

CREATE TABLE `cash_sales` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `lot_id` varchar(255) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `receipt_path` varchar(255) DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `payment_status` enum('Pending','Paid','Overdue') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cash_sales`
--

INSERT INTO `cash_sales` (`id`, `reservation_id`, `lot_id`, `payment_amount`, `receipt_path`, `payment_date`, `payment_status`, `created_at`, `updated_at`) VALUES
(16, 50, '1C5-1', 74675.30, NULL, NULL, 'Paid', '2025-03-28 05:16:20', '2025-03-28 05:19:41'),
(17, 51, '1C21-1', 76988.02, NULL, NULL, 'Paid', '2025-03-28 05:17:39', '2025-03-28 05:22:33'),
(18, 64, '1C29-15', 76988.02, NULL, NULL, 'Pending', '2025-03-28 05:23:18', '2025-03-28 05:23:18'),
(19, 59, '1C26-1', 74675.30, NULL, NULL, 'Pending', '2025-03-28 05:23:49', '2025-03-28 05:23:49'),
(20, 110, '1C18-14', 76988.02, NULL, NULL, 'Pending', '2025-03-28 05:44:39', '2025-03-28 05:44:39'),
(21, 111, '1C27-11', 76988.02, NULL, NULL, 'Paid', '2025-03-28 06:08:02', '2025-03-28 06:09:26'),
(22, 113, '1C22-3', 76988.02, NULL, NULL, 'Paid', '2025-03-28 06:54:47', '2025-03-28 06:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `cash_sale_due_dates`
--

CREATE TABLE `cash_sale_due_dates` (
  `id` int(11) NOT NULL,
  `cash_sale_id` int(11) DEFAULT NULL,
  `lot_id` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cash_sale_due_dates`
--

INSERT INTO `cash_sale_due_dates` (`id`, `cash_sale_id`, `lot_id`, `due_date`, `created_at`, `updated_at`) VALUES
(11, 16, '1C5-1', '2025-04-04', '2025-03-28 05:16:20', '2025-03-28 05:16:20'),
(12, 17, '1C21-1', '2025-04-04', '2025-03-28 05:17:39', '2025-03-28 05:17:39'),
(13, 18, '1C29-15', '2025-04-04', '2025-03-28 05:23:18', '2025-03-28 05:23:18'),
(14, 19, '1C26-1', '2025-04-04', '2025-03-28 05:23:49', '2025-03-28 05:23:49'),
(15, 20, '1C18-14', '2025-04-04', '2025-03-28 05:44:39', '2025-03-28 05:44:39'),
(16, 21, '1C27-11', '2025-04-04', '2025-03-28 06:08:02', '2025-03-28 06:08:02'),
(17, 22, '1C22-3', '2025-04-04', '2025-03-28 06:54:47', '2025-03-28 06:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `suffix_name` enum('','Sr.','Jr.','I','II','III','IV','V') DEFAULT '',
  `contact_number` varchar(15) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password_hashed` varchar(255) NOT NULL,
  `active_beneficiary` int(11) DEFAULT NULL,
  `status` enum('Active','Transferred Ownership','Deactivated') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `contact_number`, `email_address`, `password_hashed`, `active_beneficiary`, `status`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Smith', 'Doe', NULL, '1234567890', 'johndoe@mail.com', '123', 1, 'Transferred Ownership', '2025-01-26 16:55:27', '2025-03-28 08:51:00'),
(2, 'Jane', NULL, 'Smith', 'Jr.', '0987654321', 'jane.smith@example.com', 'hashed_password_2', NULL, 'Active', '2025-01-26 16:55:27', '2025-03-24 23:08:33'),
(3, 'Test1', 'Test1', 'Test1', 'Sr.', '09123457896', 'test1@gmail.com', '$2y$10$VaXZxlMaiYnc2CceTln4Auir1TAB82uZzHfh72rKF.EsgRqv3ONm2', NULL, 'Active', '2025-03-28 08:30:02', '2025-03-28 08:30:02'),
(4, 'Jhon Mark', '', 'Villanueva', '', '09121231234', 'jhonmarkvillanueva79@gmail.com', '$2y$10$KPBPpTexFkEvNRv6lkAk0Ohwsxvk3gCCvoFeoBMl5RO5j3D0mApIe', NULL, 'Active', '2025-03-28 08:56:34', '2025-03-28 08:56:34'),
(5, 'Winilyn', 'Dela Cruz', 'Marquez', '', '09430980097', 'marquezwinilyn@gmail.com', '$2y$10$ttTEytX9AQWGN96fShE9jelFGX7idTgZC213g7HLmp1R75iQH17Fe', NULL, 'Active', '2025-03-28 11:51:20', '2025-03-28 11:51:20'),
(6, 'Edren', 'Sabalboro', 'Gamboa', '', '09945371415', 'edren.gamboa@gmail.com', '$2y$10$AacpMEVcBqeeS2Sg7ngXTOmMp/o484VrDvKf3IoSZvassNvivG6ae', NULL, 'Active', '2025-03-28 13:10:25', '2025-03-28 13:10:25'),
(7, 'Jayr', 'P', 'Alindahao', 'Jr.', '09709391271', 'jayralindahao15@gmail.com', '$2y$10$Ud8121YQK/JfC/8yiIglnug4vp33I3reEcZdzSl.WXbb59Bd7dqyy', NULL, 'Active', '2025-03-28 13:10:48', '2025-03-28 13:10:48'),
(8, 'Sung', 'Jin', 'Woo', '', '094343537553', 'sungjinwoo123@gmail.com', '$2y$10$8iMPm7Xya9D.X3UdDDQrtOrg9WG.je87PA9d9KvELe7PqfsMMZ7Fi', NULL, 'Active', '2025-03-28 13:13:48', '2025-03-28 13:16:11'),
(9, 'Ramon', 'Manalo', 'Paguia', '', '09207619254', 'ramonbongpaguia@gmail.com', '$2y$10$gHeJ99zJMjDS0.ILhEUWNO3whb4EptqI2cqqB2UFNSHEgpl3v3mmy', NULL, 'Active', '2025-03-28 13:13:48', '2025-03-28 13:13:48'),
(10, 'Justine Jay', 'Miparanum', 'Ibañez', '', '09071899220', 'ibanezjustinejay4@gmail.com', '$2y$10$gl0Gei3a9Qmm.Mqib6uI.eMymosVBsziEKN99Gllh1MO1LKTjvAby', NULL, 'Active', '2025-03-28 13:14:31', '2025-03-28 13:14:31'),
(11, 'Wally', 'Tabancay', 'Bayola', 'Jr.', '09224787775', 'cjcastillo0305@gmail.com', '$2y$10$Y27oMhSPy3.AThPFjoSiVugg.0qTswUzNQ9cCZdJkWfLMKIOalBp.', NULL, 'Active', '2025-03-28 13:14:40', '2025-03-28 13:14:40'),
(12, 'Jiwao', '', 'Tabancay', '', '09945391034', 'jiwaotabancay@gmail.com', '$2y$10$eCbRZlXvyC5EihNBHqxQ7OBdZyoxFt5/FOPjmUrWzz5b7X6Kq1Olm', NULL, 'Active', '2025-03-28 13:14:50', '2025-03-28 13:14:50'),
(13, 'Ann Cathlyn', '', 'Ydio', '', '09061688870', 'anncathlyn.ydio@gmail.com', '$2y$10$iGJCvUIOAupU9bDS4wZvU.Y3tIxL2t.qdxo2d5WW07x.chg8Eaiyi', NULL, 'Active', '2025-03-28 13:15:14', '2025-03-28 13:15:14'),
(14, 'Miguel', 'Dimat', 'Aeh', '', '09478149699', 'endagad0908@gmail.com', '$2y$10$7yfP1URl5gfbiC537INrWeGx5Xl2p1d2fDir2rtxWJJHxam/K25Tu', NULL, 'Active', '2025-03-28 13:16:33', '2025-03-28 13:16:33'),
(20, 'Quando', 'Quando', 'Tabancay', 'Jr.', '09152724587', 'Quandotabancay@gmail.com', '$2y$10$4Z432JQ4KPUrRlqGur04J.ozXH0UMnTaDlq056sbqorDC1fYSzrpi', NULL, 'Active', '2025-03-28 13:17:43', '2025-03-28 13:23:29'),
(23, 'Rhyver', 'Tadeo', 'Gasacao', '', '09093214591', 'rhyvertototo@gmail.com', '$2y$10$Rlg8SXuIHmWDddHI.z0ac.F1gvwW7lguWDPGaMMMvMobFCCvt6Qwa', NULL, 'Active', '2025-03-28 13:18:04', '2025-03-28 13:18:04'),
(24, 'Gusion', '', 'Tabancay', 'Jr.', '09603913057', 'ttqmalaki@gmail.com', '$2y$10$lm52WwlpJE4UdNmK7jovfO4cgUZ/oa0PL9H8xt0eyKKRIPr06oKLK', NULL, 'Active', '2025-03-28 13:18:11', '2025-03-28 13:18:11'),
(25, 'Iris Christine', 'Moñez', 'Balasbas', '', '09380003326', 'icmontezamonez@gmail.com', '$2y$10$ifsOHgIfnT6KODA0QUNp.OSubmTUhBi4zfnirIKapsJQAFxCNAKIy', NULL, 'Active', '2025-03-28 13:18:52', '2025-03-28 13:18:52'),
(26, 'Bombardino', 'Crocodilo', 'Tabancay', '', '09056738321', 'bombardinocrocodilo@gmail.com', '$2y$10$OGbUk69uO6ST370CCFGOROkxWwz2xL2PyDqt4yX8WnSsftwEoeO3O', NULL, 'Active', '2025-03-28 13:19:08', '2025-03-28 13:23:24'),
(29, 'Justinpaul', 'Leaño', 'Nocete', '', '09971704012', 'justinpaulleano00@gmail.com', '$2y$10$fJgnPURMY4KEHcDLo1xJfuF/hwXkjeGBZj/N9ooT39Eq807qH8O6W', NULL, 'Active', '2025-03-28 13:20:26', '2025-03-28 13:20:26'),
(30, 'Arnold', 'S', 'Nitor', 'Jr.', '09491626522', 'hambogngsagpro@gmail.com', '$2y$10$yaLBDbbuqptjdMxWbEEqwOXeYG4Ag38pvZrcVGb0WdsRFVKW0/q.W', NULL, 'Active', '2025-03-28 13:20:40', '2025-03-28 13:20:40'),
(32, 'Ash', 'Viray', 'Consultado', '', '09876543211', 'ashashcutie@gmail.com', '$2y$10$4rmvjCWvKvxz/uKN6dVksurM/rs0pYFkhBpVODKItmMYMRm4VVSwq', NULL, 'Active', '2025-03-28 13:21:12', '2025-03-28 13:21:12'),
(34, 'Shirwen', 'Elisio', 'Rabago', '', '09675964640', 'rabagosherwin235@gmail.com', '$2y$10$srNvjAC7pBTwVw2/TouX8e.iMyLgc/EbiNOvloKJhmNT.giYOPPq.', NULL, 'Active', '2025-03-28 13:21:16', '2025-03-28 13:21:16'),
(40, 'Manny', 'G.', 'Err', 'Jr.', '09239871775', 'iuwygrwdwd@gmail.com', '$2y$10$Aah3L5uYBafaPd4IwamsNe3MLW.hbr1gExNnIXobWtB0zm3Di1dx2', NULL, 'Active', '2025-03-28 13:24:00', '2025-03-28 13:24:00'),
(42, 'Ash', 'Viray', 'Consultado', '', '09874563211', 'ashconsultado@gmail.com', '$2y$10$bB92LywzJGsehdunTb035.rPnIHqHDEXA1DBV3X5T9Tq/YNdtwgc6', NULL, 'Active', '2025-03-28 13:25:56', '2025-03-28 13:25:56'),
(43, 'Iris Christine', 'Moñez', 'Balasbas', '', '09380003326', 'icmontezampnez@gmail.com', '$2y$10$aO7kkAVuAwXmJqaUDJHwtOUd3WX8/sS4zcoYUvaxf8x8RS4xZMuzq', NULL, 'Active', '2025-03-28 13:28:49', '2025-03-28 13:28:49'),
(44, 'Feb', '', 'Boromeo', '', '09455619446', 'boromeofeb07@gmail.com', '$2y$10$9gUyYvt3EkCRqtSsPt1tzOFw7NCapNxKgThmgvvBCIBm7pSryzoW6', NULL, 'Active', '2025-03-28 13:39:57', '2025-03-28 13:39:57'),
(45, 'Christine', 'Dimaculangan', 'Abiog', '', '09307805806', 'abiogchristine210@gmail.com', '$2y$10$wVDqxZJlfte6mFvEJ8XZv.2xYP2c.mo9T5CtnmICwEKR5yny4hlJy', NULL, 'Active', '2025-03-28 14:05:06', '2025-03-28 14:05:06'),
(46, 'Roy', '', 'Abad', '', '09216103996', 'abadroy82@gmail.com', '$2y$10$QMoDhE26NdCO8Jz.g2yEGewJ2fV12fx2VgHewfdGxa/0u88xqLVZq', NULL, 'Active', '2025-03-28 14:50:31', '2025-03-28 14:50:31'),
(47, 'Dy An', '', 'Amay', '', '09059150013', 'judyanneflorespuno@gmail.com', '$2y$10$.3XgeGSjMAL3yFGqtt4mDuRkz6HROZGg2g4FE8IXur/jFkIXzImfa', NULL, 'Active', '2025-03-28 15:12:10', '2025-03-28 15:12:10'),
(48, 'Dy An', '', 'Amay', '', '09059150013', 'judyanne@gmail.com', '$2y$10$RKgH0harQ98AwHVYddqzt.90BcwuprPbYxDxAL4aU91dwxehd2bqy', NULL, 'Active', '2025-03-28 16:11:32', '2025-03-28 16:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `deceased`
--

CREATE TABLE `deceased` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `death_date` date DEFAULT NULL,
  `burial_date` date DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deceased`
--

INSERT INTO `deceased` (`id`, `full_name`, `first_name`, `middle_name`, `last_name`, `suffix`, `birth_date`, `death_date`, `burial_date`, `location`, `created_at`, `updated_at`) VALUES
(1, 'John A. Doe', 'John', 'A.', 'Doe', NULL, '1950-01-15', '2023-10-01', '2023-10-05', '1C1-4', '2025-01-20 11:05:58', '2025-03-15 01:23:39'),
(2, 'Jane B. Smith', 'Jane', 'B.', 'Smith', NULL, '1965-06-20', '2022-12-15', '2022-12-20', '1C6-1', '2025-01-20 11:05:58', '2025-03-15 01:23:47'),
(3, 'Robert C. Johnson', 'Robert', 'C.', 'Johnson', 'Sr.', '1942-03-10', '2021-05-12', '2021-05-18', '1C6-4', '2025-01-20 11:05:58', '2025-03-15 01:23:54'),
(4, 'Emily D. Davis', 'Emily', 'D.', 'Davis', NULL, '1980-09-25', '2023-03-10', '2023-03-15', '1C6-8', '2025-01-20 11:05:58', '2025-03-15 01:24:01'),
(5, 'Michael E. Brown', 'Michael', 'E.', 'Brown', 'Jr.', '1975-02-14', '2020-08-25', '2020-08-30', '1C2-3', '2025-01-20 11:05:58', '2025-03-15 01:24:08');

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
  `occupancy` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estates`
--

INSERT INTO `estates` (`id`, `estate_id`, `owner_id`, `latitude_start`, `longitude_start`, `latitude_end`, `longitude_end`, `status`, `occupancy`, `capacity`, `created_at`, `updated_at`) VALUES
(28, 'E-C1', NULL, 14.8715127, 120.9769721, 14.8715487, 120.9770081, 'Reserved', 0, 6, '2025-02-01 05:45:47', '2025-03-28 05:17:58'),
(29, 'E-B1', NULL, 14.8714647, 120.9769721, 14.8715097, 120.9770036, 'Available', 0, 7, '2025-02-01 05:45:47', '2025-03-28 06:36:47'),
(30, 'E-A1', NULL, 14.8714167, 120.9769721, 14.8714617, 120.9770081, 'Available', 0, 8, '2025-02-01 05:45:47', '2025-03-28 06:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `estate_cash_sales`
--

CREATE TABLE `estate_cash_sales` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `estate_id` varchar(10) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `receipt_path` varchar(255) NOT NULL,
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
  `cash_sale_id` int(11) DEFAULT NULL,
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
  `reservation_id` int(11) DEFAULT NULL,
  `estate_id` varchar(10) NOT NULL,
  `term_years` int(11) NOT NULL,
  `down_payment` decimal(10,2) NOT NULL,
  `down_payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `down_payment_date` date DEFAULT NULL,
  `down_payment_due_date` date NOT NULL,
  `down_reference_number` varchar(255) NOT NULL,
  `next_due_date` date NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `monthly_payment` decimal(10,2) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
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
  `receipt_path` varchar(255) NOT NULL,
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
(1, 'Estate A', 20.00, 8, 400.00, 0.12, 10000.00, 11648.00, 10483.20, 0.10, 11065.60, 0.05, 12329.60, 0.20, -681.60, -56.80, 0.00, -31.45, 0.10, -23.63, 0.15, -20.74, 0.20, -20.01, 0.25),
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
  `reference_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estate_reservations`
--

INSERT INTO `estate_reservations` (`id`, `estate_id`, `reservee_id`, `estate_type`, `payment_option`, `reservation_status`, `reference_number`, `created_at`, `updated_at`) VALUES
(17, 'E-C1', 8, 'C', 'Pending', 'Confirmed', '', '2025-03-28 13:17:58', '2025-03-28 05:18:42'),
(18, 'E-A1', 7, 'A', 'Pending', 'Cancelled', '', '2025-03-28 13:19:14', '2025-03-28 06:36:45'),
(19, 'E-B1', 7, 'B', 'Pending', 'Cancelled', '', '2025-03-28 13:19:19', '2025-03-28 06:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `estate_six_months`
--

CREATE TABLE `estate_six_months` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `estate_id` varchar(10) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `receipt_path` varchar(255) NOT NULL,
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
  `six_months_id` int(11) DEFAULT NULL,
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
  `reservation_id` int(11) DEFAULT NULL,
  `lot_id` varchar(255) NOT NULL,
  `term_years` int(11) NOT NULL,
  `down_payment` decimal(10,2) NOT NULL,
  `down_payment_status` enum('Pending','Paid') DEFAULT 'Pending',
  `down_payment_date` date DEFAULT NULL,
  `down_payment_due_date` date NOT NULL,
  `down_reference_number` varchar(255) NOT NULL,
  `next_due_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `monthly_payment` decimal(10,2) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `payment_status` enum('Pending','Ongoing','Completed') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `installments`
--

INSERT INTO `installments` (`id`, `reservation_id`, `lot_id`, `term_years`, `down_payment`, `down_payment_status`, `down_payment_date`, `down_payment_due_date`, `down_reference_number`, `next_due_date`, `total_amount`, `monthly_payment`, `reference_number`, `interest_rate`, `payment_status`, `created_at`, `updated_at`) VALUES
(12, 53, '1C1-3', 0, 27108.45, 'Pending', NULL, '2025-04-27', 'x784pdY', NULL, 58433.79, 4869.48, '', 0.00, 'Pending', '2025-03-28 05:18:36', '2025-03-28 05:25:03'),
(13, 60, '1C26-2', 0, 23786.00, 'Pending', NULL, '2025-04-27', 'ookkqp5', NULL, 55503.00, 4625.23, '', 0.00, 'Pending', '2025-03-28 05:20:44', '2025-03-28 05:20:44'),
(14, 58, '1C28-6', 0, 23786.00, 'Pending', NULL, '2025-04-27', 'QCjpyCd', NULL, 55503.00, 4625.23, '', 0.00, 'Pending', '2025-03-28 05:21:06', '2025-03-28 05:21:08'),
(15, 58, '1C28-6', 0, 23786.00, 'Pending', NULL, '2025-04-27', 'QCjpyCd', NULL, 55503.00, 4625.23, '', 0.00, 'Pending', '2025-03-28 05:21:07', '2025-03-28 05:21:08'),
(16, 69, '1C22-2', 0, 24372.29, 'Pending', NULL, '2025-04-27', 'QZdSL2C', NULL, 57489.15, 4790.76, '', 0.00, 'Pending', '2025-03-28 05:24:00', '2025-03-28 05:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `installment_payments`
--

CREATE TABLE `installment_payments` (
  `id` int(11) NOT NULL,
  `installment_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `receipt_path` varchar(255) DEFAULT NULL,
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
(2230, '1C1-3', NULL, 14.87162250, 120.97704960, 14.87164050, 120.97705860, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 05:18:03'),
(2231, '1C1-4', 48, 14.87164550, 120.97704960, 14.87166350, 120.97705860, 'Sold', '2025-01-26 03:36:58', '2025-03-28 08:24:14'),
(2232, '1C1-5', NULL, 14.87166850, 120.97704960, 14.87168650, 120.97705860, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 07:13:37'),
(2233, '1C1-6', NULL, 14.87169150, 120.97704960, 14.87170950, 120.97705860, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2234, '1C6-1', NULL, 14.87140650, 120.97711710, 14.87142450, 120.97712610, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2235, '1C6-2', NULL, 14.87142950, 120.97711710, 14.87144750, 120.97712610, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:37:53'),
(2236, '1C6-3', NULL, 14.87145250, 120.97711710, 14.87147050, 120.97712610, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2237, '1C6-4', NULL, 14.87147550, 120.97711710, 14.87149350, 120.97712610, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2238, '1C6-5', NULL, 14.87149850, 120.97711710, 14.87151650, 120.97712610, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2239, '1C6-6', NULL, 14.87152150, 120.97711710, 14.87153950, 120.97712610, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2240, '1C6-7', NULL, 14.87154450, 120.97711710, 14.87156250, 120.97712610, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2241, '1C6-8', NULL, 14.87156750, 120.97711710, 14.87158550, 120.97712610, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2242, '1C6-9', NULL, 14.87159050, 120.97711710, 14.87160850, 120.97712610, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2243, '1C6-10', NULL, 14.87161350, 120.97711710, 14.87163150, 120.97712610, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:41:56'),
(2244, '1C6-11', NULL, 14.87163650, 120.97711710, 14.87165450, 120.97712610, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2245, '1C6-12', NULL, 14.87165950, 120.97711710, 14.87167750, 120.97712610, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2246, '1C6-13', NULL, 14.87168250, 120.97711710, 14.87170050, 120.97712610, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2247, '1C6-14', NULL, 14.87170550, 120.97711710, 14.87172350, 120.97712610, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 05:25:16'),
(2248, '1C2-1', NULL, 14.87141950, 120.97706310, 14.87143750, 120.97707210, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2249, '1C2-2', NULL, 14.87144250, 120.97706310, 14.87146050, 120.97707210, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 03:56:25'),
(2250, '1C2-3', NULL, 14.87146550, 120.97706310, 14.87148350, 120.97707210, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2251, '1C2-4', NULL, 14.87148850, 120.97706310, 14.87150650, 120.97707210, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2252, '1C2-5', NULL, 14.87151150, 120.97706310, 14.87152950, 120.97707210, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2253, '1C2-6', NULL, 14.87153450, 120.97706310, 14.87155250, 120.97707210, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2254, '1C2-7', NULL, 14.87155750, 120.97706310, 14.87157550, 120.97707210, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2255, '1C2-8', NULL, 14.87158050, 120.97706310, 14.87159850, 120.97707210, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2256, '1C2-9', NULL, 14.87160350, 120.97706310, 14.87162150, 120.97707210, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 02:42:24'),
(2257, '1C2-10', NULL, 14.87162650, 120.97706310, 14.87164450, 120.97707210, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2258, '1C2-11', NULL, 14.87164950, 120.97706310, 14.87166750, 120.97707210, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2259, '1C2-12', NULL, 14.87167250, 120.97706310, 14.87169050, 120.97707210, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:37:55'),
(2260, '1C2-13', NULL, 14.87169550, 120.97706310, 14.87171350, 120.97707210, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2261, '1C3-1', NULL, 14.87141850, 120.97707660, 14.87143650, 120.97708560, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2262, '1C3-2', NULL, 14.87144150, 120.97707660, 14.87145950, 120.97708560, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2263, '1C3-3', NULL, 14.87146450, 120.97707660, 14.87148250, 120.97708560, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2264, '1C3-4', NULL, 14.87148750, 120.97707660, 14.87150550, 120.97708560, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2265, '1C3-5', NULL, 14.87151050, 120.97707660, 14.87152850, 120.97708560, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2266, '1C3-6', NULL, 14.87153350, 120.97707660, 14.87155150, 120.97708560, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2267, '1C3-7', NULL, 14.87155650, 120.97707660, 14.87157450, 120.97708560, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2268, '1C3-8', NULL, 14.87157950, 120.97707660, 14.87159750, 120.97708560, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:41:48'),
(2269, '1C3-9', NULL, 14.87160250, 120.97707660, 14.87162050, 120.97708560, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2270, '1C3-10', NULL, 14.87162550, 120.97707660, 14.87164350, 120.97708560, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2271, '1C3-11', NULL, 14.87164850, 120.97707660, 14.87166650, 120.97708560, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2272, '1C3-12', NULL, 14.87167150, 120.97707660, 14.87168950, 120.97708560, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2273, '1C3-13', NULL, 14.87169450, 120.97707660, 14.87171250, 120.97708560, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:39:00'),
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
(2287, '1C5-1', NULL, 14.87141150, 120.97710360, 14.87142950, 120.97711260, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 05:14:44'),
(2288, '1C5-2', NULL, 14.87143450, 120.97710360, 14.87145250, 120.97711260, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2289, '1C5-3', NULL, 14.87145750, 120.97710360, 14.87147550, 120.97711260, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2290, '1C5-4', NULL, 14.87148050, 120.97710360, 14.87149850, 120.97711260, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2291, '1C5-5', NULL, 14.87150350, 120.97710360, 14.87152150, 120.97711260, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2292, '1C5-6', NULL, 14.87152650, 120.97710360, 14.87154450, 120.97711260, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2293, '1C5-7', NULL, 14.87154950, 120.97710360, 14.87156750, 120.97711260, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2294, '1C5-8', NULL, 14.87157250, 120.97710360, 14.87159050, 120.97711260, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:41:40'),
(2295, '1C5-9', NULL, 14.87159550, 120.97710360, 14.87161350, 120.97711260, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2296, '1C5-10', NULL, 14.87161850, 120.97710360, 14.87163650, 120.97711260, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:41:43'),
(2297, '1C5-11', NULL, 14.87164150, 120.97710360, 14.87165950, 120.97711260, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 05:17:19'),
(2298, '1C5-12', NULL, 14.87166450, 120.97710360, 14.87168250, 120.97711260, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2299, '1C5-13', NULL, 14.87168750, 120.97710360, 14.87170550, 120.97711260, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2300, '1C5-14', NULL, 14.87171050, 120.97710360, 14.87172850, 120.97711260, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 05:25:12'),
(2301, '1C7-1', NULL, 14.87140650, 120.97713060, 14.87142450, 120.97713960, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2302, '1C7-2', NULL, 14.87142950, 120.97713060, 14.87144750, 120.97713960, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2303, '1C7-3', NULL, 14.87145250, 120.97713060, 14.87147050, 120.97713960, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2304, '1C7-4', NULL, 14.87147550, 120.97713060, 14.87149350, 120.97713960, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2305, '1C7-5', NULL, 14.87149850, 120.97713060, 14.87151650, 120.97713960, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2306, '1C7-6', NULL, 14.87152150, 120.97713060, 14.87153950, 120.97713960, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2307, '1C7-7', NULL, 14.87154450, 120.97713060, 14.87156250, 120.97713960, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2308, '1C7-8', NULL, 14.87156750, 120.97713060, 14.87158550, 120.97713960, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2309, '1C7-9', NULL, 14.87159050, 120.97713060, 14.87160850, 120.97713960, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2310, '1C7-10', NULL, 14.87161350, 120.97713060, 14.87163150, 120.97713960, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 00:32:24'),
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
(2322, '1C8-8', NULL, 14.87156750, 120.97714410, 14.87158550, 120.97715310, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:41:24'),
(2323, '1C8-9', NULL, 14.87159050, 120.97714410, 14.87160850, 120.97715310, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2324, '1C8-10', NULL, 14.87161350, 120.97714410, 14.87163150, 120.97715310, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 05:21:18'),
(2325, '1C8-11', NULL, 14.87163650, 120.97714410, 14.87165450, 120.97715310, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2326, '1C8-12', NULL, 14.87165950, 120.97714410, 14.87167750, 120.97715310, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2327, '1C8-13', NULL, 14.87168250, 120.97714410, 14.87170050, 120.97715310, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2328, '1C8-14', NULL, 14.87170550, 120.97714410, 14.87172350, 120.97715310, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2329, '1C9-1', NULL, 14.87140000, 120.97715760, 14.87141800, 120.97716660, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:37:51'),
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
(2374, '1C12-1', NULL, 14.87140300, 120.97719810, 14.87142100, 120.97720710, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:41:33'),
(2375, '1C12-2', NULL, 14.87142600, 120.97719810, 14.87144400, 120.97720710, 'Available', '2025-01-26 03:36:58', '2025-03-28 05:26:18'),
(2376, '1C12-3', NULL, 14.87144900, 120.97719810, 14.87146700, 120.97720710, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2377, '1C12-4', NULL, 14.87147200, 120.97719810, 14.87149000, 120.97720710, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2378, '1C12-5', NULL, 14.87149500, 120.97719810, 14.87151300, 120.97720710, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2379, '1C12-6', NULL, 14.87151800, 120.97719810, 14.87153600, 120.97720710, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:38:42'),
(2380, '1C12-7', NULL, 14.87154100, 120.97719810, 14.87155900, 120.97720710, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2381, '1C12-8', NULL, 14.87156400, 120.97719810, 14.87158200, 120.97720710, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 05:19:17'),
(2382, '1C12-9', NULL, 14.87158700, 120.97719810, 14.87160500, 120.97720710, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2383, '1C12-10', NULL, 14.87161000, 120.97719810, 14.87162800, 120.97720710, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2384, '1C12-11', NULL, 14.87163300, 120.97719810, 14.87165100, 120.97720710, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2385, '1C12-12', NULL, 14.87165600, 120.97719810, 14.87167400, 120.97720710, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2386, '1C12-13', NULL, 14.87167900, 120.97719810, 14.87169700, 120.97720710, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2387, '1C12-14', NULL, 14.87170200, 120.97719810, 14.87172000, 120.97720710, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 05:19:09'),
(2388, '1C12-15', NULL, 14.87172500, 120.97719810, 14.87174300, 120.97720710, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:38:56'),
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
(2403, '1C13-15', NULL, 14.87172500, 120.97721160, 14.87174300, 120.97722060, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 05:21:15'),
(2404, '1C16-1', NULL, 14.87140100, 120.97725210, 14.87141900, 120.97726110, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:41:27'),
(2405, '1C16-2', NULL, 14.87142400, 120.97725210, 14.87144200, 120.97726110, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2406, '1C16-3', NULL, 14.87144700, 120.97725210, 14.87146500, 120.97726110, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2407, '1C16-4', NULL, 14.87147000, 120.97725210, 14.87148800, 120.97726110, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2408, '1C16-5', NULL, 14.87149300, 120.97725210, 14.87151100, 120.97726110, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2409, '1C16-6', NULL, 14.87151600, 120.97725210, 14.87153400, 120.97726110, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2410, '1C16-7', NULL, 14.87153900, 120.97725210, 14.87155700, 120.97726110, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:41:37'),
(2411, '1C16-8', NULL, 14.87156200, 120.97725210, 14.87158000, 120.97726110, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2412, '1C16-9', NULL, 14.87158500, 120.97725210, 14.87160300, 120.97726110, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2413, '1C16-10', NULL, 14.87160800, 120.97725210, 14.87162600, 120.97726110, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2414, '1C16-11', NULL, 14.87163100, 120.97725210, 14.87164900, 120.97726110, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2415, '1C16-12', NULL, 14.87165400, 120.97725210, 14.87167200, 120.97726110, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2416, '1C16-13', NULL, 14.87167700, 120.97725210, 14.87169500, 120.97726110, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2417, '1C16-14', NULL, 14.87170000, 120.97725210, 14.87171800, 120.97726110, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2418, '1C16-15', NULL, 14.87172300, 120.97725210, 14.87174100, 120.97726110, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2419, '1C17-1', NULL, 14.87140100, 120.97726560, 14.87141900, 120.97727460, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:41:21'),
(2420, '1C17-2', NULL, 14.87142400, 120.97726560, 14.87144200, 120.97727460, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:41:51'),
(2421, '1C17-3', NULL, 14.87144700, 120.97726560, 14.87146500, 120.97727460, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2422, '1C17-4', NULL, 14.87147000, 120.97726560, 14.87148800, 120.97727460, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2423, '1C17-5', NULL, 14.87149300, 120.97726560, 14.87151100, 120.97727460, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2424, '1C17-6', NULL, 14.87151600, 120.97726560, 14.87153400, 120.97727460, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2425, '1C17-7', NULL, 14.87153900, 120.97726560, 14.87155700, 120.97727460, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2426, '1C17-8', NULL, 14.87156200, 120.97726560, 14.87158000, 120.97727460, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2427, '1C17-9', NULL, 14.87158500, 120.97726560, 14.87160300, 120.97727460, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 05:20:25'),
(2428, '1C17-10', NULL, 14.87160800, 120.97726560, 14.87162600, 120.97727460, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2429, '1C17-11', NULL, 14.87163100, 120.97726560, 14.87164900, 120.97727460, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2430, '1C17-12', NULL, 14.87165400, 120.97726560, 14.87167200, 120.97727460, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2431, '1C17-13', NULL, 14.87167700, 120.97726560, 14.87169500, 120.97727460, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2432, '1C17-14', NULL, 14.87170000, 120.97726560, 14.87171800, 120.97727460, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2433, '1C17-15', NULL, 14.87172300, 120.97726560, 14.87174100, 120.97727460, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:38:54'),
(2434, '1C18-1', NULL, 14.87140100, 120.97727910, 14.87141900, 120.97728810, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:41:16'),
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
(2447, '1C18-14', NULL, 14.87170000, 120.97727910, 14.87171800, 120.97728810, 'Reserved', '2025-01-26 03:36:58', '2025-03-28 05:42:00'),
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
(2465, '1C19-2', NULL, 14.87142400, 120.97729260, 14.87144200, 120.97730160, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:41:46'),
(2466, '1C19-3', NULL, 14.87144700, 120.97729260, 14.87146500, 120.97730160, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2467, '1C19-4', NULL, 14.87147000, 120.97729260, 14.87148800, 120.97730160, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2468, '1C19-5', NULL, 14.87149300, 120.97729260, 14.87151100, 120.97730160, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2469, '1C19-6', NULL, 14.87151600, 120.97729260, 14.87153400, 120.97730160, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2470, '1C19-7', NULL, 14.87153900, 120.97729260, 14.87155700, 120.97730160, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2471, '1C19-8', NULL, 14.87156200, 120.97729260, 14.87158000, 120.97730160, 'Available', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2472, '1C19-9', NULL, 14.87158500, 120.97729260, 14.87160300, 120.97730160, 'Reserved', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2473, '1C19-10', NULL, 14.87160800, 120.97729260, 14.87162600, 120.97730160, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2474, '1C19-11', NULL, 14.87163100, 120.97729260, 14.87164900, 120.97730160, 'Available', '2025-01-26 03:36:58', '2025-03-28 06:38:46'),
(2475, '1C19-12', NULL, 14.87165400, 120.97729260, 14.87167200, 120.97730160, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2476, '1C19-13', NULL, 14.87167700, 120.97729260, 14.87169500, 120.97730160, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2477, '1C19-14', NULL, 14.87170000, 120.97729260, 14.87171800, 120.97730160, 'Sold', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2478, '1C19-15', NULL, 14.87172300, 120.97729260, 14.87174100, 120.97730160, 'Sold and Occupied', '2025-01-26 03:36:58', '2025-01-26 03:36:58'),
(2479, '1C21-1', NULL, 14.87140100, 120.97731960, 14.87141900, 120.97732860, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:16:49'),
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
(2495, '1C22-2', NULL, 14.87142400, 120.97733310, 14.87144200, 120.97734210, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:21:30'),
(2496, '1C22-3', 46, 14.87144700, 120.97733310, 14.87146500, 120.97734210, 'Sold', '2025-01-26 03:36:59', '2025-03-28 06:56:31'),
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
(2513, '1C15-4', NULL, 14.87147000, 120.97723860, 14.87148800, 120.97724760, 'Available', '2025-01-26 03:36:59', '2025-03-28 06:38:44'),
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
(2538, '1C24-14', NULL, 14.87170000, 120.97736010, 14.87171800, 120.97736910, 'Available', '2025-01-26 03:36:59', '2025-03-28 06:38:52'),
(2539, '1C24-15', NULL, 14.87172300, 120.97736010, 14.87174100, 120.97736910, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2540, '1C24-16', NULL, 14.87174600, 120.97736010, 14.87176400, 120.97736910, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:25:25'),
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
(2554, '1C25-14', NULL, 14.87170000, 120.97737360, 14.87171800, 120.97738260, 'Available', '2025-01-26 03:36:59', '2025-03-28 06:38:50'),
(2555, '1C25-15', NULL, 14.87172300, 120.97737360, 14.87174100, 120.97738260, 'Available', '2025-01-26 03:36:59', '2025-03-28 06:38:48'),
(2556, '1C25-16', NULL, 14.87174600, 120.97737360, 14.87176400, 120.97738260, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2557, '1C26-1', NULL, 14.87140100, 120.97738710, 14.87141900, 120.97739610, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:19:38'),
(2558, '1C26-2', NULL, 14.87142400, 120.97738710, 14.87144200, 120.97739610, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:19:46'),
(2559, '1C26-3', NULL, 14.87144700, 120.97738710, 14.87146500, 120.97739610, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2560, '1C26-4', NULL, 14.87147000, 120.97738710, 14.87148800, 120.97739610, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2561, '1C26-5', NULL, 14.87149300, 120.97738710, 14.87151100, 120.97739610, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:24:33'),
(2562, '1C26-6', NULL, 14.87151600, 120.97738710, 14.87153400, 120.97739610, 'Available', '2025-01-26 03:36:59', '2025-03-28 06:41:30'),
(2563, '1C26-7', NULL, 14.87153900, 120.97738710, 14.87155700, 120.97739610, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2564, '1C26-8', NULL, 14.87156200, 120.97738710, 14.87158000, 120.97739610, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2565, '1C26-9', NULL, 14.87158500, 120.97738710, 14.87160300, 120.97739610, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2566, '1C26-10', NULL, 14.87160800, 120.97738710, 14.87162600, 120.97739610, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2567, '1C26-11', NULL, 14.87163100, 120.97738710, 14.87164900, 120.97739610, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2568, '1C26-12', NULL, 14.87165400, 120.97738710, 14.87167200, 120.97739610, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2569, '1C26-13', NULL, 14.87167700, 120.97738710, 14.87169500, 120.97739610, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2570, '1C26-14', NULL, 14.87170000, 120.97738710, 14.87171800, 120.97739610, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2571, '1C26-15', NULL, 14.87172300, 120.97738710, 14.87174100, 120.97739610, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2572, '1C26-16', NULL, 14.87174600, 120.97738710, 14.87176400, 120.97739610, 'Available', '2025-01-26 03:36:59', '2025-03-28 06:37:58'),
(2573, '1C27-1', NULL, 14.87140100, 120.97740060, 14.87141900, 120.97740960, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2574, '1C27-2', NULL, 14.87142400, 120.97740060, 14.87144200, 120.97740960, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2575, '1C27-3', NULL, 14.87144700, 120.97740060, 14.87146500, 120.97740960, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:21:12'),
(2576, '1C27-4', NULL, 14.87147000, 120.97740060, 14.87148800, 120.97740960, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2577, '1C27-5', NULL, 14.87149300, 120.97740060, 14.87151100, 120.97740960, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2578, '1C27-6', NULL, 14.87151600, 120.97740060, 14.87153400, 120.97740960, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2579, '1C27-7', NULL, 14.87153900, 120.97740060, 14.87155700, 120.97740960, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2580, '1C27-8', NULL, 14.87156200, 120.97740060, 14.87158000, 120.97740960, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2581, '1C27-9', NULL, 14.87158500, 120.97740060, 14.87160300, 120.97740960, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2582, '1C27-10', NULL, 14.87160800, 120.97740060, 14.87162600, 120.97740960, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:20:19'),
(2583, '1C27-11', 45, 14.87163100, 120.97740060, 14.87164900, 120.97740960, 'Sold', '2025-01-26 03:36:59', '2025-03-28 06:10:11'),
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
(2595, '1C23-7', NULL, 14.87153900, 120.97734660, 14.87155700, 120.97735560, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:24:36'),
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
(2626, '1C28-6', NULL, 14.87151600, 120.97741410, 14.87153400, 120.97742310, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:19:35'),
(2627, '1C28-7', NULL, 14.87153900, 120.97741410, 14.87155700, 120.97742310, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2628, '1C28-8', NULL, 14.87156200, 120.97741410, 14.87158000, 120.97742310, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2629, '1C28-9', NULL, 14.87158500, 120.97741410, 14.87160300, 120.97742310, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2630, '1C28-10', NULL, 14.87160800, 120.97741410, 14.87162600, 120.97742310, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2631, '1C28-11', NULL, 14.87163100, 120.97741410, 14.87164900, 120.97742310, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2632, '1C28-12', NULL, 14.87165400, 120.97741410, 14.87167200, 120.97742310, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2633, '1C28-13', NULL, 14.87167700, 120.97741410, 14.87169500, 120.97742310, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2634, '1C28-14', NULL, 14.87170000, 120.97741410, 14.87171800, 120.97742310, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2635, '1C28-15', NULL, 14.87172300, 120.97741410, 14.87174100, 120.97742310, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:20:45'),
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
(2651, '1C29-15', NULL, 14.87172300, 120.97742760, 14.87174100, 120.97743660, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:20:29'),
(2652, '1C29-16', NULL, 14.87174600, 120.97742760, 14.87176400, 120.97743660, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2653, '1C20-1', NULL, 14.87140100, 120.97730610, 14.87141900, 120.97731510, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2654, '1C20-2', NULL, 14.87142400, 120.97730610, 14.87144200, 120.97731510, 'Available', '2025-01-26 03:36:59', '2025-03-28 06:41:53'),
(2655, '1C20-3', NULL, 14.87144700, 120.97730610, 14.87146500, 120.97731510, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2656, '1C20-4', NULL, 14.87147000, 120.97730610, 14.87148800, 120.97731510, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2657, '1C20-5', NULL, 14.87149300, 120.97730610, 14.87151100, 120.97731510, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2658, '1C20-6', NULL, 14.87151600, 120.97730610, 14.87153400, 120.97731510, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2659, '1C20-7', NULL, 14.87153900, 120.97730610, 14.87155700, 120.97731510, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2660, '1C20-8', NULL, 14.87156200, 120.97730610, 14.87158000, 120.97731510, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2661, '1C20-9', NULL, 14.87158500, 120.97730610, 14.87160300, 120.97731510, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2662, '1C20-10', NULL, 14.87160800, 120.97730610, 14.87162600, 120.97731510, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:19:12'),
(2663, '1C20-11', NULL, 14.87163100, 120.97730610, 14.87164900, 120.97731510, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2664, '1C20-12', NULL, 14.87165400, 120.97730610, 14.87167200, 120.97731510, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2665, '1C20-13', NULL, 14.87167700, 120.97730610, 14.87169500, 120.97731510, 'Reserved', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2666, '1C20-14', NULL, 14.87170000, 120.97730610, 14.87171800, 120.97731510, 'Sold and Occupied', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2667, '1C20-15', NULL, 14.87172300, 120.97730610, 14.87174100, 120.97731510, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2668, '1C31-1', NULL, 14.87157100, 120.97745460, 14.87158900, 120.97746360, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:19:19'),
(2669, '1C31-2', NULL, 14.87159400, 120.97745460, 14.87161200, 120.97746360, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2670, '1C31-3', NULL, 14.87161700, 120.97745460, 14.87163500, 120.97746360, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2671, '1C31-4', NULL, 14.87164000, 120.97745460, 14.87165800, 120.97746360, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2672, '1C31-5', NULL, 14.87166300, 120.97745460, 14.87168100, 120.97746360, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2673, '1C31-6', NULL, 14.87168600, 120.97745460, 14.87170400, 120.97746360, 'Sold', '2025-01-26 03:36:59', '2025-01-26 03:36:59'),
(2674, '1C31-7', NULL, 14.87170900, 120.97745460, 14.87172700, 120.97746360, 'Reserved', '2025-01-26 03:36:59', '2025-03-28 05:20:09'),
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
  `lot_type` enum('Supreme','Special','Standard','Pending') NOT NULL DEFAULT 'Pending',
  `payment_option` enum('Cash Sale','6 Months','Installment: 1 Year','Installment: 2 Years','Installment: 3 Years','Installment: 4 Years','Installment: 5 Years','Pending') NOT NULL DEFAULT 'Pending',
  `reservation_status` enum('Pending','Confirmed','Cancelled','Completed') NOT NULL DEFAULT 'Pending',
  `reference_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lot_reservations`
--

INSERT INTO `lot_reservations` (`id`, `lot_id`, `reservee_id`, `lot_type`, `payment_option`, `reservation_status`, `reference_number`, `created_at`, `updated_at`) VALUES
(50, '1C5-1', 9, 'Special', 'Cash Sale', 'Confirmed', 'dtp3Td9', '2025-03-28 13:14:44', '2025-03-28 05:28:12'),
(51, '1C21-1', 13, 'Supreme', 'Cash Sale', 'Confirmed', 'aiMLF3u', '2025-03-28 13:16:49', '2025-03-28 05:23:27'),
(52, '1C5-11', 8, 'Standard', 'Pending', 'Confirmed', '', '2025-03-28 13:17:19', '2025-03-28 05:17:31'),
(53, '1C1-3', 10, 'Supreme', 'Installment: 1 Year', 'Confirmed', 'x784pdY', '2025-03-28 13:18:03', '2025-03-28 05:25:03'),
(54, '1C12-14', 8, 'Supreme', '6 Months', 'Confirmed', 'hbDrJsw', '2025-03-28 13:19:09', '2025-03-28 05:35:09'),
(55, '1C20-10', 8, 'Special', 'Pending', 'Confirmed', '', '2025-03-28 13:19:12', '2025-03-28 05:20:03'),
(56, '1C12-8', 8, 'Standard', 'Pending', 'Confirmed', '', '2025-03-28 13:19:17', '2025-03-28 05:20:08'),
(57, '1C31-1', 12, 'Supreme', 'Pending', 'Confirmed', '', '2025-03-28 13:19:19', '2025-03-28 05:20:14'),
(58, '1C28-6', 12, 'Standard', 'Installment: 1 Year', 'Confirmed', 'QCjpyCd', '2025-03-28 13:19:35', '2025-03-28 05:21:08'),
(59, '1C26-1', 20, 'Special', 'Cash Sale', 'Confirmed', '8Rbsyyx', '2025-03-28 13:19:38', '2025-03-28 05:26:49'),
(60, '1C26-2', 11, 'Standard', 'Installment: 1 Year', 'Confirmed', 'ookkqp5', '2025-03-28 13:19:46', '2025-03-28 05:20:44'),
(61, '1C31-7', 8, 'Supreme', 'Pending', 'Confirmed', '', '2025-03-28 13:20:09', '2025-03-28 05:20:32'),
(62, '1C27-10', 24, 'Standard', '6 Months', 'Confirmed', 'rjj9otz', '2025-03-28 13:20:19', '2025-03-28 05:22:15'),
(63, '1C17-9', 11, 'Special', 'Pending', 'Confirmed', '', '2025-03-28 13:20:25', '2025-03-28 05:20:45'),
(64, '1C29-15', 7, 'Supreme', 'Cash Sale', 'Confirmed', '7yNzvk3', '2025-03-28 13:20:29', '2025-03-28 05:26:06'),
(65, '1C28-15', 8, 'Standard', 'Pending', 'Confirmed', '', '2025-03-28 13:20:45', '2025-03-28 05:20:50'),
(66, '1C27-3', 7, 'Special', 'Pending', 'Confirmed', '', '2025-03-28 13:21:12', '2025-03-28 05:21:29'),
(67, '1C13-15', 7, 'Standard', 'Pending', 'Confirmed', '', '2025-03-28 13:21:15', '2025-03-28 05:21:36'),
(68, '1C8-10', 7, 'Special', 'Pending', 'Confirmed', '', '2025-03-28 13:21:18', '2025-03-28 05:21:53'),
(69, '1C22-2', 26, 'Special', 'Installment: 1 Year', 'Confirmed', 'QZdSL2C', '2025-03-28 13:21:30', '2025-03-28 05:45:57'),
(70, '1C26-5', 40, 'Standard', 'Pending', 'Confirmed', '', '2025-03-28 13:24:33', '2025-03-28 05:25:11'),
(71, '1C23-7', 40, 'Supreme', 'Pending', 'Confirmed', '', '2025-03-28 13:24:36', '2025-03-28 05:25:14'),
(72, '1C5-14', 40, 'Standard', 'Pending', 'Confirmed', '', '2025-03-28 13:25:12', '2025-03-28 05:25:22'),
(73, '1C6-14', 40, 'Special', 'Pending', 'Confirmed', '', '2025-03-28 13:25:16', '2025-03-28 05:25:27'),
(74, '1C26-16', 40, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:25:20', '2025-03-28 05:26:06'),
(75, '1C24-16', 40, 'Special', 'Pending', 'Confirmed', '', '2025-03-28 13:25:25', '2025-03-28 05:25:38'),
(76, '1C26-6', 40, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:25:30', '2025-03-28 05:26:11'),
(77, '1C3-8', 40, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:25:35', '2025-03-28 05:26:14'),
(78, '1C12-2', 40, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:25:39', '2025-03-28 05:26:18'),
(79, '1C17-1', 40, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:25:44', '2025-03-28 05:26:21'),
(80, '1C3-13', 23, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:26:15', '2025-03-28 05:26:25'),
(81, '1C9-1', 9, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:26:36', '2025-03-28 06:37:51'),
(82, '1C6-2', 9, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:26:43', '2025-03-28 06:37:53'),
(83, '1C2-12', 29, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:26:52', '2025-03-28 06:37:55'),
(84, '1C26-16', 8, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:27:00', '2025-03-28 06:37:58'),
(85, '1C22-3', 30, 'Pending', 'Pending', 'Cancelled', 'uEELXzo', '2025-03-28 13:27:12', '2025-03-28 06:54:48'),
(86, '1C12-6', 9, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:27:38', '2025-03-28 06:38:42'),
(87, '1C15-4', 9, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:27:42', '2025-03-28 06:38:44'),
(88, '1C19-11', 9, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:27:46', '2025-03-28 06:38:46'),
(89, '1C25-15', 9, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:27:52', '2025-03-28 06:38:48'),
(90, '1C25-14', 9, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:27:57', '2025-03-28 06:38:50'),
(91, '1C24-14', 9, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:28:02', '2025-03-28 06:38:52'),
(92, '1C17-15', 9, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:28:06', '2025-03-28 06:38:54'),
(93, '1C12-15', 9, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:28:10', '2025-03-28 06:38:56'),
(94, '1C1-5', 42, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:28:13', '2025-03-28 06:38:58'),
(95, '1C3-13', 23, 'Pending', 'Pending', 'Pending', '', '2025-03-28 13:28:22', '2025-03-28 13:28:22'),
(96, '1C1-4', 34, 'Pending', 'Pending', 'Cancelled', 'qiSaSNY', '2025-03-28 13:28:30', '2025-03-28 08:22:33'),
(97, '1C6-10', 30, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:30:41', '2025-03-28 06:41:56'),
(98, '1C20-2', 29, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:31:10', '2025-03-28 06:41:53'),
(99, '1C17-2', 29, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:31:15', '2025-03-28 06:41:51'),
(100, '1C3-8', 23, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:31:16', '2025-03-28 06:41:48'),
(101, '1C19-2', 29, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:31:20', '2025-03-28 06:41:46'),
(102, '1C5-10', 23, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:31:20', '2025-03-28 06:41:43'),
(103, '1C5-8', 23, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:31:26', '2025-03-28 06:41:40'),
(104, '1C18-1', 29, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:31:26', '2025-03-28 06:41:16'),
(105, '1C17-1', 29, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:31:31', '2025-03-28 06:41:21'),
(106, '1C8-8', 23, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:31:31', '2025-03-28 06:41:24'),
(107, '1C16-1', 29, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:31:35', '2025-03-28 06:41:27'),
(108, '1C26-6', 42, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:31:36', '2025-03-28 06:41:30'),
(109, '1C12-1', 29, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 13:31:40', '2025-03-28 06:41:33'),
(110, '1C18-14', 44, 'Supreme', 'Cash Sale', 'Confirmed', 'RGtEkHJ', '2025-03-28 13:42:00', '2025-03-28 05:53:45'),
(111, '1C27-11', 45, 'Supreme', 'Cash Sale', 'Completed', 'br6w4ws', '2025-03-28 14:07:02', '2025-03-28 06:09:42'),
(112, '1C16-7', 45, 'Pending', 'Pending', 'Cancelled', '', '2025-03-28 14:29:36', '2025-03-28 06:41:37'),
(113, '1C22-3', 46, 'Supreme', 'Cash Sale', 'Completed', 'uEELXzo', '2025-03-28 14:51:38', '2025-03-28 06:55:38'),
(114, '1C1-5', 47, 'Supreme', 'Pending', 'Confirmed', '', '2025-03-28 15:13:37', '2025-03-28 08:13:23'),
(115, '1C1-4', 48, 'Supreme', '6 Months', 'Completed', 'qiSaSNY', '2025-03-28 16:12:15', '2025-03-28 08:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ownership_transfer_requests`
--

CREATE TABLE `ownership_transfer_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `new_owner_email` varchar(255) NOT NULL,
  `otp_code` varchar(10) DEFAULT NULL,
  `otp_expires_at` datetime DEFAULT NULL,
  `status` enum('Pending','Verified','Completed','Expired') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `reservation_id` int(11) DEFAULT NULL,
  `lot_id` varchar(255) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `receipt_path` varchar(255) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_status` enum('Pending','Paid','Overdue') DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `six_months`
--

INSERT INTO `six_months` (`id`, `reservation_id`, `lot_id`, `payment_amount`, `receipt_path`, `payment_date`, `payment_status`, `created_at`, `updated_at`) VALUES
(4, 62, '1C27-10', 72441.00, NULL, NULL, 'Pending', '2025-03-28 05:21:57', '2025-03-28 05:21:57'),
(5, 54, '1C12-14', 76988.02, NULL, NULL, 'Pending', '2025-03-28 05:22:38', '2025-03-28 05:22:38'),
(6, 115, '1C1-4', 76988.02, NULL, '2025-03-28 00:00:00', 'Paid', '2025-03-28 08:19:52', '2025-03-28 08:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `six_months_due_dates`
--

CREATE TABLE `six_months_due_dates` (
  `id` int(11) NOT NULL,
  `six_months_id` int(11) DEFAULT NULL,
  `lot_id` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `six_months_due_dates`
--

INSERT INTO `six_months_due_dates` (`id`, `six_months_id`, `lot_id`, `due_date`, `created_at`, `updated_at`) VALUES
(3, 4, '1C27-10', '2025-09-28', '2025-03-28 05:21:57', '2025-03-28 05:21:57'),
(4, 5, '1C12-14', '2025-09-28', '2025-03-28 05:22:38', '2025-03-28 05:22:38'),
(5, 6, '1C1-4', '2025-09-28', '2025-03-28 08:19:52', '2025-03-28 08:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix_name` enum('Sr.','Jr.','I','II','III','IV','V','') NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `email`, `password_hash`, `created_at`) VALUES
(1, 'John', 'Cena', 'Doe', '', 'admin@mail.com', '$2b$12$CXsdriK0Qd2Qd3GCHEf.Zey4jvnoxSPWxwkyYDTE3.DLbj0M6YGrC', '2025-01-22 09:09:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

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
-- Indexes for table `burial_pricing`
--
ALTER TABLE `burial_pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `burial_reservations`
--
ALTER TABLE `burial_reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservee_id` (`reservee_id`);

--
-- Indexes for table `cash_sales`
--
ALTER TABLE `cash_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lot_id` (`lot_id`),
  ADD KEY `fk_cash_sales_reservation_id` (`reservation_id`);

--
-- Indexes for table `cash_sale_due_dates`
--
ALTER TABLE `cash_sale_due_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lot_reservation_id` (`lot_id`),
  ADD KEY `fk_cash_sale_due_dates_cash_sale_id` (`cash_sale_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`),
  ADD KEY `fk_active_beneficiary` (`active_beneficiary`);

--
-- Indexes for table `deceased`
--
ALTER TABLE `deceased`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grave_id` (`location`);

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
  ADD KEY `estate_id` (`estate_id`),
  ADD KEY `fk_estate_case_sales_reservation_id` (`reservation_id`);

--
-- Indexes for table `estate_cash_sale_due_dates`
--
ALTER TABLE `estate_cash_sale_due_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estate_id` (`estate_id`),
  ADD KEY `fk_estate_cash_sale_due_dates_cash_sale_id` (`cash_sale_id`);

--
-- Indexes for table `estate_installments`
--
ALTER TABLE `estate_installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estate_id` (`estate_id`),
  ADD KEY `fk_estate_installments_reservation_id` (`reservation_id`);

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
  ADD KEY `estate_id` (`estate_id`),
  ADD KEY `fk_estate_six_months_reservation_id` (`reservation_id`);

--
-- Indexes for table `estate_six_months_due_dates`
--
ALTER TABLE `estate_six_months_due_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estate_id` (`estate_id`),
  ADD KEY `fk_estate_six_months_due_dates_six_months_id` (`six_months_id`);

--
-- Indexes for table `installments`
--
ALTER TABLE `installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lot_id` (`lot_id`),
  ADD KEY `fk_installments_reservation_id` (`reservation_id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `ownership_transfer_requests`
--
ALTER TABLE `ownership_transfer_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD KEY `lot_id` (`lot_id`),
  ADD KEY `fk_six_months_reservation_id` (`reservation_id`);

--
-- Indexes for table `six_months_due_dates`
--
ALTER TABLE `six_months_due_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lot_reservation_id` (`lot_id`),
  ADD KEY `fk_six_months_due_dates_six_month_id` (`six_months_id`);

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
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `backup_settings`
--
ALTER TABLE `backup_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `burial_pricing`
--
ALTER TABLE `burial_pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `burial_reservations`
--
ALTER TABLE `burial_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `cash_sales`
--
ALTER TABLE `cash_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `cash_sale_due_dates`
--
ALTER TABLE `cash_sale_due_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `deceased`
--
ALTER TABLE `deceased`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `estates`
--
ALTER TABLE `estates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `estate_cash_sales`
--
ALTER TABLE `estate_cash_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `estate_cash_sale_due_dates`
--
ALTER TABLE `estate_cash_sale_due_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `estate_six_months`
--
ALTER TABLE `estate_six_months`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `estate_six_months_due_dates`
--
ALTER TABLE `estate_six_months_due_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `installments`
--
ALTER TABLE `installments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `ownership_transfer_requests`
--
ALTER TABLE `ownership_transfer_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `phase_pricing`
--
ALTER TABLE `phase_pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `six_months`
--
ALTER TABLE `six_months`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `six_months_due_dates`
--
ALTER TABLE `six_months_due_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD CONSTRAINT `admin_notifications_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD CONSTRAINT `beneficiaries_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `burial_reservations`
--
ALTER TABLE `burial_reservations`
  ADD CONSTRAINT `burial_reservations_ibfk_1` FOREIGN KEY (`reservee_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cash_sales`
--
ALTER TABLE `cash_sales`
  ADD CONSTRAINT `cash_sales_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lot_reservations` (`lot_id`),
  ADD CONSTRAINT `fk_cash_sales_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `lot_reservations` (`id`);

--
-- Constraints for table `cash_sale_due_dates`
--
ALTER TABLE `cash_sale_due_dates`
  ADD CONSTRAINT `cash_sale_due_dates_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lot_reservations` (`lot_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cash_sale_due_dates_cash_sale_id` FOREIGN KEY (`cash_sale_id`) REFERENCES `cash_sales` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_active_beneficiary` FOREIGN KEY (`active_beneficiary`) REFERENCES `beneficiaries` (`id`);

--
-- Constraints for table `estates`
--
ALTER TABLE `estates`
  ADD CONSTRAINT `estates_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `estate_cash_sales`
--
ALTER TABLE `estate_cash_sales`
  ADD CONSTRAINT `estate_cash_sales_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_estate_case_sales_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `estate_reservations` (`id`);

--
-- Constraints for table `estate_cash_sale_due_dates`
--
ALTER TABLE `estate_cash_sale_due_dates`
  ADD CONSTRAINT `estate_cash_sale_due_dates_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_estate_cash_sale_due_dates_cash_sale_id` FOREIGN KEY (`cash_sale_id`) REFERENCES `estate_cash_sales` (`id`);

--
-- Constraints for table `estate_installments`
--
ALTER TABLE `estate_installments`
  ADD CONSTRAINT `estate_installments_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_estate_installments_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `estate_reservations` (`id`);

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
  ADD CONSTRAINT `estate_six_months_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_estate_six_months_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `estate_reservations` (`id`);

--
-- Constraints for table `estate_six_months_due_dates`
--
ALTER TABLE `estate_six_months_due_dates`
  ADD CONSTRAINT `estate_six_months_due_dates_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_estate_six_months_due_dates_six_months_id` FOREIGN KEY (`six_months_id`) REFERENCES `estate_six_months` (`id`);

--
-- Constraints for table `installments`
--
ALTER TABLE `installments`
  ADD CONSTRAINT `fk_installments_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `lot_reservations` (`id`),
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
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `ownership_transfer_requests`
--
ALTER TABLE `ownership_transfer_requests`
  ADD CONSTRAINT `ownership_transfer_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `six_months`
--
ALTER TABLE `six_months`
  ADD CONSTRAINT `fk_six_months_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `lot_reservations` (`id`),
  ADD CONSTRAINT `six_months_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lot_reservations` (`lot_id`) ON DELETE CASCADE;

--
-- Constraints for table `six_months_due_dates`
--
ALTER TABLE `six_months_due_dates`
  ADD CONSTRAINT `fk_six_months_due_dates_six_month_id` FOREIGN KEY (`six_months_id`) REFERENCES `six_months` (`id`),
  ADD CONSTRAINT `six_months_due_dates_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lot_reservations` (`lot_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

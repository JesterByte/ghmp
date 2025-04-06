-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ghmp_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_notifications`
--

DROP TABLE IF EXISTS `admin_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  CONSTRAINT `admin_notifications_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_notifications`
--

LOCK TABLES `admin_notifications` WRITE;
/*!40000 ALTER TABLE `admin_notifications` DISABLE KEYS */;
INSERT INTO `admin_notifications` VALUES (4,NULL,'Eugine Jester Jose has chosen Cash Sale as their payment option for Asset: Phase 1 Lawn C Row 1 - Lot 1.','lot-reservations-cash-sale',0,'2025-03-30 02:12:24'),(5,NULL,'Eugine Jester Jose has chosen Cash Sale as their payment option for Asset: Phase 1 Lawn C Row 1 - Lot 1.','lot-reservations-cash-sale',0,'2025-03-30 02:14:14'),(6,NULL,'A new burial reservation has been made for Asset ID: Phase 1 Lawn C Row 1 - Lot 1.','burial-reservations',0,'2025-03-30 02:40:08'),(7,NULL,'A new burial reservation has been made for Asset ID: Phase 1 Lawn C Row 1 - Lot 1.','burial-reservations',0,'2025-03-30 02:40:12'),(8,NULL,'A new burial reservation has been made for Asset ID: Phase 1 Lawn C Row 1 - Lot 1.','burial-reservations',0,'2025-03-30 02:40:15'),(9,NULL,'A new burial reservation has been made for Asset ID: Phase 1 Lawn C Row 1 - Lot 1.','burial-reservations',0,'2025-03-30 02:40:19'),(10,NULL,'A new burial reservation has been made for Asset ID: Phase 1 Lawn C Row 1 - Lot 1.','burial-reservations',0,'2025-03-30 02:40:23'),(11,NULL,'A new burial reservation has been made for Asset ID: Phase 1 Lawn C Row 1 - Lot 1.','burial-reservations',0,'2025-03-30 02:41:15'),(12,NULL,'A new burial reservation has been made for Asset ID: Phase 1 Lawn C Row 1 - Lot 1.','burial-reservations',0,'2025-03-30 02:45:55'),(13,NULL,'A new burial reservation has been made for Asset ID: Phase 1 Lawn C Row 1 - Lot 1.','burial-reservations',0,'2025-03-30 02:59:32'),(14,NULL,'A new lot reservation has been made for Lot ID: Phase 1 Lawn C Row 1 - Lot 2.','lot-reservations-requests',0,'2025-04-01 03:30:20');
/*!40000 ALTER TABLE `admin_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_settings`
--

DROP TABLE IF EXISTS `backup_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_settings`
--

LOCK TABLES `backup_settings` WRITE;
/*!40000 ALTER TABLE `backup_settings` DISABLE KEYS */;
INSERT INTO `backup_settings` VALUES (1,'17:49:00');
/*!40000 ALTER TABLE `backup_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beneficiaries`
--

DROP TABLE IF EXISTS `beneficiaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `beneficiaries_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beneficiaries`
--

LOCK TABLES `beneficiaries` WRITE;
/*!40000 ALTER TABLE `beneficiaries` DISABLE KEYS */;
INSERT INTO `beneficiaries` VALUES (1,1,'Mary','C.','Doe',NULL,'1122334455','ejjose94@gmail.com','$2y$10$aU9ShBiq4jS1ZR4ljTJAS.XFKJwwjwpsfpCQUBxkftYA89pw0Zr7e','Inactive','Spouse','2025-01-26 16:55:33','2025-03-30 17:00:51'),(33,49,'Test','','Test','','+639121231234','test@test.com',NULL,'Inactive','Test','2025-03-30 16:52:29','2025-03-30 16:52:29');
/*!40000 ALTER TABLE `beneficiaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `burial_pricing`
--

DROP TABLE IF EXISTS `burial_pricing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `burial_pricing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` enum('Lot','Estate') NOT NULL,
  `burial_type` enum('Standard','Columbarium','Mausoleum','Bone Transfer') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `burial_pricing`
--

LOCK TABLES `burial_pricing` WRITE;
/*!40000 ALTER TABLE `burial_pricing` DISABLE KEYS */;
INSERT INTO `burial_pricing` VALUES (1,'Lot','Standard',50000.00,'2025-02-26 16:17:52','2025-03-09 00:59:38'),(2,'Lot','Columbarium',30000.00,'2025-02-26 16:17:52','2025-03-30 05:39:01'),(3,'Lot','Bone Transfer',20000.00,'2025-02-26 16:17:52','2025-02-26 16:17:52'),(5,'Estate','Mausoleum',200000.00,'2025-02-26 16:17:52','2025-02-26 16:17:52'),(6,'Estate','Bone Transfer',50000.00,'2025-02-26 16:17:52','2025-02-26 16:17:52');
/*!40000 ALTER TABLE `burial_pricing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `burial_reservations`
--

DROP TABLE IF EXISTS `burial_reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `burial_reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `receipt_path` varchar(255) DEFAULT NULL,
  `reference_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `reservee_id` (`reservee_id`),
  CONSTRAINT `burial_reservations_ibfk_1` FOREIGN KEY (`reservee_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `burial_reservations`
--

LOCK TABLES `burial_reservations` WRITE;
/*!40000 ALTER TABLE `burial_reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `burial_reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash_sale_due_dates`
--

DROP TABLE IF EXISTS `cash_sale_due_dates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cash_sale_due_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cash_sale_id` int(11) DEFAULT NULL,
  `lot_id` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `lot_reservation_id` (`lot_id`),
  KEY `fk_cash_sale_due_dates_cash_sale_id` (`cash_sale_id`),
  CONSTRAINT `cash_sale_due_dates_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lot_reservations` (`lot_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_cash_sale_due_dates_cash_sale_id` FOREIGN KEY (`cash_sale_id`) REFERENCES `cash_sales` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_sale_due_dates`
--

LOCK TABLES `cash_sale_due_dates` WRITE;
/*!40000 ALTER TABLE `cash_sale_due_dates` DISABLE KEYS */;
/*!40000 ALTER TABLE `cash_sale_due_dates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash_sales`
--

DROP TABLE IF EXISTS `cash_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cash_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) DEFAULT NULL,
  `lot_id` varchar(255) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `receipt_path` varchar(255) DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  `payment_status` enum('Pending','Paid','Overdue') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `lot_id` (`lot_id`),
  KEY `fk_cash_sales_reservation_id` (`reservation_id`),
  CONSTRAINT `cash_sales_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lot_reservations` (`lot_id`),
  CONSTRAINT `fk_cash_sales_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `lot_reservations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_sales`
--

LOCK TABLES `cash_sales` WRITE;
/*!40000 ALTER TABLE `cash_sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `cash_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_address` (`email_address`),
  KEY `fk_active_beneficiary` (`active_beneficiary`),
  CONSTRAINT `fk_active_beneficiary` FOREIGN KEY (`active_beneficiary`) REFERENCES `beneficiaries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'John','Smith','Doe','','1234567890','johndoe@mail.com','123',NULL,'Active','2025-01-26 16:55:27','2025-04-01 18:36:30'),(49,'Eugine Jester','','Jose','','09121231234','ejjose94@gmail.com','$2y$10$MBWPbzWblLjwTZoRhFC3aO/jwpJZey55qT0ZqrqvFxp2hFOt15.dG',NULL,'Active','2025-03-30 16:52:29','2025-03-30 16:52:29');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deceased`
--

DROP TABLE IF EXISTS `deceased`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deceased` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `grave_id` (`location`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deceased`
--

LOCK TABLES `deceased` WRITE;
/*!40000 ALTER TABLE `deceased` DISABLE KEYS */;
INSERT INTO `deceased` VALUES (1,'John A. Doe','John','A.','Doe',NULL,'1950-01-15','2023-10-01','2023-10-05','1C1-4','2025-01-20 03:05:58','2025-03-14 17:23:39'),(2,'Jane B. Smith','Jane','B.','Smith',NULL,'1965-06-20','2022-12-15','2022-12-20','1C6-1','2025-01-20 03:05:58','2025-03-14 17:23:47'),(3,'Robert C. Johnson','Robert','C.','Johnson','Sr.','1942-03-10','2021-05-12','2021-05-18','1C6-4','2025-01-20 03:05:58','2025-03-14 17:23:54'),(4,'Emily D. Davis','Emily','D.','Davis',NULL,'1980-09-25','2023-03-10','2023-03-15','1C6-8','2025-01-20 03:05:58','2025-03-14 17:24:01'),(5,'Michael E. Brown','Michael','E.','Brown','Jr.','1975-02-14','2020-08-25','2020-08-30','1C2-3','2025-01-20 03:05:58','2025-03-14 17:24:08');
/*!40000 ALTER TABLE `deceased` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_cash_sale_due_dates`
--

DROP TABLE IF EXISTS `estate_cash_sale_due_dates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_cash_sale_due_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cash_sale_id` int(11) DEFAULT NULL,
  `estate_id` varchar(10) NOT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `estate_id` (`estate_id`),
  KEY `fk_estate_cash_sale_due_dates_cash_sale_id` (`cash_sale_id`),
  CONSTRAINT `estate_cash_sale_due_dates_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_estate_cash_sale_due_dates_cash_sale_id` FOREIGN KEY (`cash_sale_id`) REFERENCES `estate_cash_sales` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_cash_sale_due_dates`
--

LOCK TABLES `estate_cash_sale_due_dates` WRITE;
/*!40000 ALTER TABLE `estate_cash_sale_due_dates` DISABLE KEYS */;
INSERT INTO `estate_cash_sale_due_dates` VALUES (16,17,'E-C1','2025-04-10','2025-04-03 04:23:42','2025-04-03 04:23:42');
/*!40000 ALTER TABLE `estate_cash_sale_due_dates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_cash_sales`
--

DROP TABLE IF EXISTS `estate_cash_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_cash_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) DEFAULT NULL,
  `estate_id` varchar(10) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `receipt_path` varchar(255) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_status` enum('Paid','Failed','Pending','Overdue') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `estate_id` (`estate_id`),
  KEY `fk_estate_case_sales_reservation_id` (`reservation_id`),
  CONSTRAINT `estate_cash_sales_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_estate_case_sales_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `estate_reservations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_cash_sales`
--

LOCK TABLES `estate_cash_sales` WRITE;
/*!40000 ALTER TABLE `estate_cash_sales` DISABLE KEYS */;
INSERT INTO `estate_cash_sales` VALUES (17,25,'E-C1',418593.14,'67ee7dce3cf43.jpg','2025-04-03','Paid','2025-04-03 04:23:42','2025-04-03 04:23:42');
/*!40000 ALTER TABLE `estate_cash_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_installment_payments`
--

DROP TABLE IF EXISTS `estate_installment_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_installment_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `installment_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `receipt_path` varchar(255) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  KEY `installment_id` (`installment_id`),
  CONSTRAINT `estate_installment_payments_ibfk_1` FOREIGN KEY (`installment_id`) REFERENCES `estate_installments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_installment_payments`
--

LOCK TABLES `estate_installment_payments` WRITE;
/*!40000 ALTER TABLE `estate_installment_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `estate_installment_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_installments`
--

DROP TABLE IF EXISTS `estate_installments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_installments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) DEFAULT NULL,
  `estate_id` varchar(10) NOT NULL,
  `term_years` int(11) NOT NULL,
  `down_payment` decimal(10,2) NOT NULL,
  `down_payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `down_payment_date` date DEFAULT NULL,
  `down_payment_due_date` date NOT NULL,
  `down_receipt_path` varchar(255) DEFAULT NULL,
  `down_reference_number` varchar(255) NOT NULL,
  `next_due_date` date NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `monthly_payment` decimal(10,2) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `payment_status` enum('Pending','Ongoing','Completed') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `estate_id` (`estate_id`),
  KEY `fk_estate_installments_reservation_id` (`reservation_id`),
  CONSTRAINT `estate_installments_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_estate_installments_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `estate_reservations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_installments`
--

LOCK TABLES `estate_installments` WRITE;
/*!40000 ALTER TABLE `estate_installments` DISABLE KEYS */;
/*!40000 ALTER TABLE `estate_installments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_pricing`
--

DROP TABLE IF EXISTS `estate_pricing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_pricing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `six_months_down_payment` decimal(10,2) NOT NULL,
  `six_months_balance` decimal(10,2) NOT NULL,
  `six_months_monthly_amortization` decimal(10,2) NOT NULL,
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
  `five_years_interest_rate` decimal(5,2) NOT NULL DEFAULT 0.25,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_pricing`
--

LOCK TABLES `estate_pricing` WRITE;
/*!40000 ALTER TABLE `estate_pricing` DISABLE KEYS */;
INSERT INTO `estate_pricing` VALUES (1,'Estate A',20.00,8,531016.00,0.12,10000.00,604737.92,544264.13,0.10,574501.02,0.05,114900.20,459600.82,76600.14,130947.58,0.20,473790.34,39482.53,0.00,21863.02,0.10,16424.10,0.15,14417.61,0.20,13906.37,0.25),(2,'Estate B',17.50,7,449134.00,0.12,10000.00,513030.08,461727.07,0.10,487378.58,0.05,97475.72,389902.86,64983.81,112606.02,0.20,400424.06,33368.67,0.00,18477.54,0.10,13880.83,0.15,12185.05,0.20,11752.98,0.25),(3,'Estate C',16.00,6,406342.40,0.12,10000.00,465103.49,418593.14,0.10,441848.31,0.05,88369.66,353478.65,58913.11,103020.70,0.20,362082.79,30173.57,0.00,16708.28,0.10,12551.72,0.15,11018.31,0.20,10627.61,0.25);
/*!40000 ALTER TABLE `estate_pricing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_reservations`
--

DROP TABLE IF EXISTS `estate_reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estate_id` varchar(10) NOT NULL,
  `reservee_id` int(11) NOT NULL,
  `estate_type` enum('A','B','C') NOT NULL,
  `payment_option` enum('Cash Sale','6 Months','Installment: 1 Year','Installment: 2 Years','Installment: 3 Years','Installment: 4 Years','Installment: 5 Years','Pending') NOT NULL DEFAULT 'Pending',
  `reservation_status` enum('Pending','Confirmed','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `certificate` varchar(255) DEFAULT NULL,
  `issued_at` datetime DEFAULT NULL,
  `reference_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `estate_id` (`estate_id`),
  KEY `reservee_id` (`reservee_id`),
  CONSTRAINT `estate_reservations_ibfk_1` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE,
  CONSTRAINT `estate_reservations_ibfk_2` FOREIGN KEY (`reservee_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_reservations`
--

LOCK TABLES `estate_reservations` WRITE;
/*!40000 ALTER TABLE `estate_reservations` DISABLE KEYS */;
INSERT INTO `estate_reservations` VALUES (25,'E-C1',49,'C','Cash Sale','Completed',NULL,NULL,'','2025-04-03 04:23:42','2025-04-03 04:23:42'),(26,'E-B1',1,'B','6 Months','Confirmed',NULL,NULL,'','2025-04-03 04:31:49','2025-04-03 04:31:49');
/*!40000 ALTER TABLE `estate_reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_six_months`
--

DROP TABLE IF EXISTS `estate_six_months`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_six_months` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) DEFAULT NULL,
  `estate_id` varchar(255) NOT NULL,
  `down_payment` decimal(10,2) NOT NULL,
  `down_payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `down_payment_date` date DEFAULT NULL,
  `down_payment_due_date` date NOT NULL,
  `down_reference_number` varchar(255) NOT NULL,
  `down_receipt_path` varchar(255) DEFAULT NULL,
  `next_due_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `monthly_payment` decimal(10,2) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `payment_status` enum('Pending','Ongoing','Completed') NOT NULL DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_estate_six_months` (`estate_id`),
  CONSTRAINT `fk_estate_six_months` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`estate_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_six_months`
--

LOCK TABLES `estate_six_months` WRITE;
/*!40000 ALTER TABLE `estate_six_months` DISABLE KEYS */;
INSERT INTO `estate_six_months` VALUES (1,26,'E-B1',97475.72,'Paid','2025-04-03','2025-04-10','','67ee7fb5252b2.png','2025-05-03',389902.86,64983.81,'','Ongoing','2025-04-03 20:31:49','2025-04-03 20:31:49');
/*!40000 ALTER TABLE `estate_six_months` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estate_six_months_payments`
--

DROP TABLE IF EXISTS `estate_six_months_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estate_six_months_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `six_months_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `receipt_path` varchar(255) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_status` enum('Pending','Completed','Failed') NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  KEY `fk_estate_six_months_payments` (`six_months_id`),
  CONSTRAINT `fk_estate_six_months_payments` FOREIGN KEY (`six_months_id`) REFERENCES `estate_six_months` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estate_six_months_payments`
--

LOCK TABLES `estate_six_months_payments` WRITE;
/*!40000 ALTER TABLE `estate_six_months_payments` DISABLE KEYS */;
INSERT INTO `estate_six_months_payments` VALUES (1,1,64983.81,'1743683951_green-sip.png','2025-04-03 04:39:11','');
/*!40000 ALTER TABLE `estate_six_months_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estates`
--

DROP TABLE IF EXISTS `estates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `estate_id` (`estate_id`),
  KEY `owner_id` (`owner_id`),
  CONSTRAINT `estates_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estates`
--

LOCK TABLES `estates` WRITE;
/*!40000 ALTER TABLE `estates` DISABLE KEYS */;
INSERT INTO `estates` VALUES (28,'E-C1',49,14.8715127,120.9769721,14.8715487,120.9770081,'Sold',0,6,'2025-01-31 21:45:47','2025-04-03 04:23:42'),(29,'E-B1',NULL,14.8714647,120.9769721,14.8715097,120.9770036,'Reserved',0,7,'2025-01-31 21:45:47','2025-04-03 04:31:49'),(30,'E-A1',NULL,14.8714167,120.9769721,14.8714617,120.9770081,'Available',0,8,'2025-01-31 21:45:47','2025-03-27 22:36:45');
/*!40000 ALTER TABLE `estates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `installment_payments`
--

DROP TABLE IF EXISTS `installment_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `installment_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `installment_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `receipt_path` varchar(255) DEFAULT NULL,
  `payment_date` datetime DEFAULT current_timestamp(),
  `payment_status` enum('Pending','Paid') DEFAULT 'Paid',
  PRIMARY KEY (`id`),
  KEY `installment_id` (`installment_id`),
  CONSTRAINT `installment_payments_ibfk_1` FOREIGN KEY (`installment_id`) REFERENCES `installments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `installment_payments`
--

LOCK TABLES `installment_payments` WRITE;
/*!40000 ALTER TABLE `installment_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `installment_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `installments`
--

DROP TABLE IF EXISTS `installments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `installments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) DEFAULT NULL,
  `lot_id` varchar(255) NOT NULL,
  `term_years` int(11) NOT NULL,
  `down_payment` decimal(10,2) NOT NULL,
  `down_payment_status` enum('Pending','Paid') DEFAULT 'Pending',
  `down_payment_date` date DEFAULT NULL,
  `down_payment_due_date` date NOT NULL,
  `down_receipt_path` varchar(255) DEFAULT NULL,
  `down_reference_number` varchar(255) NOT NULL,
  `next_due_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `monthly_payment` decimal(10,2) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `payment_status` enum('Pending','Ongoing','Completed') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `lot_id` (`lot_id`),
  KEY `fk_installments_reservation_id` (`reservation_id`),
  CONSTRAINT `fk_installments_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `lot_reservations` (`id`),
  CONSTRAINT `installments_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lot_reservations` (`lot_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `installments`
--

LOCK TABLES `installments` WRITE;
/*!40000 ALTER TABLE `installments` DISABLE KEYS */;
/*!40000 ALTER TABLE `installments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lot_reservations`
--

DROP TABLE IF EXISTS `lot_reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lot_reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lot_id` varchar(255) NOT NULL,
  `reservee_id` int(11) NOT NULL,
  `lot_type` enum('Supreme','Special','Standard','Pending') NOT NULL DEFAULT 'Pending',
  `payment_option` enum('Cash Sale','6 Months','Installment: 1 Year','Installment: 2 Years','Installment: 3 Years','Installment: 4 Years','Installment: 5 Years','Pending') NOT NULL DEFAULT 'Pending',
  `reservation_status` enum('Pending','Confirmed','Cancelled','Completed') NOT NULL DEFAULT 'Pending',
  `certificate` varchar(255) DEFAULT NULL,
  `issued_at` datetime DEFAULT NULL,
  `reference_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `lot_id` (`lot_id`),
  CONSTRAINT `lot_reservations_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lots` (`lot_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lot_reservations`
--

LOCK TABLES `lot_reservations` WRITE;
/*!40000 ALTER TABLE `lot_reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `lot_reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lots`
--

DROP TABLE IF EXISTS `lots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lot_id` varchar(50) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `latitude_start` decimal(10,8) NOT NULL,
  `longitude_start` decimal(11,8) NOT NULL,
  `latitude_end` decimal(10,8) NOT NULL,
  `longitude_end` decimal(11,8) NOT NULL,
  `status` enum('Available','Reserved','Sold','Sold and Occupied') DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `lot_id` (`lot_id`) USING BTREE,
  KEY `fk_customer_id` (`owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2677 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lots`
--

LOCK TABLES `lots` WRITE;
/*!40000 ALTER TABLE `lots` DISABLE KEYS */;
INSERT INTO `lots` VALUES (2228,'1C1-1',NULL,14.87157650,120.97704960,14.87159450,120.97705860,'Available','2025-01-25 19:36:58','2025-04-03 04:14:04'),(2229,'1C1-2',NULL,14.87159950,120.97704960,14.87161750,120.97705860,'Available','2025-01-25 19:36:58','2025-04-03 04:14:02'),(2230,'1C1-3',NULL,14.87162250,120.97704960,14.87164050,120.97705860,'Available','2025-01-25 19:36:58','2025-04-03 04:14:00'),(2231,'1C1-4',NULL,14.87164550,120.97704960,14.87166350,120.97705860,'Available','2025-01-25 19:36:58','2025-04-02 23:14:58'),(2232,'1C1-5',NULL,14.87166850,120.97704960,14.87168650,120.97705860,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2233,'1C1-6',NULL,14.87169150,120.97704960,14.87170950,120.97705860,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2234,'1C6-1',NULL,14.87140650,120.97711710,14.87142450,120.97712610,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2235,'1C6-2',NULL,14.87142950,120.97711710,14.87144750,120.97712610,'Available','2025-01-25 19:36:58','2025-03-27 22:37:53'),(2236,'1C6-3',NULL,14.87145250,120.97711710,14.87147050,120.97712610,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2237,'1C6-4',NULL,14.87147550,120.97711710,14.87149350,120.97712610,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2238,'1C6-5',NULL,14.87149850,120.97711710,14.87151650,120.97712610,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2239,'1C6-6',NULL,14.87152150,120.97711710,14.87153950,120.97712610,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2240,'1C6-7',NULL,14.87154450,120.97711710,14.87156250,120.97712610,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2241,'1C6-8',NULL,14.87156750,120.97711710,14.87158550,120.97712610,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2242,'1C6-9',NULL,14.87159050,120.97711710,14.87160850,120.97712610,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2243,'1C6-10',NULL,14.87161350,120.97711710,14.87163150,120.97712610,'Available','2025-01-25 19:36:58','2025-03-27 22:41:56'),(2244,'1C6-11',NULL,14.87163650,120.97711710,14.87165450,120.97712610,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2245,'1C6-12',NULL,14.87165950,120.97711710,14.87167750,120.97712610,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2246,'1C6-13',NULL,14.87168250,120.97711710,14.87170050,120.97712610,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2247,'1C6-14',NULL,14.87170550,120.97711710,14.87172350,120.97712610,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2248,'1C2-1',NULL,14.87141950,120.97706310,14.87143750,120.97707210,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2249,'1C2-2',NULL,14.87144250,120.97706310,14.87146050,120.97707210,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2250,'1C2-3',NULL,14.87146550,120.97706310,14.87148350,120.97707210,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2251,'1C2-4',NULL,14.87148850,120.97706310,14.87150650,120.97707210,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2252,'1C2-5',NULL,14.87151150,120.97706310,14.87152950,120.97707210,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2253,'1C2-6',NULL,14.87153450,120.97706310,14.87155250,120.97707210,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2254,'1C2-7',NULL,14.87155750,120.97706310,14.87157550,120.97707210,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2255,'1C2-8',NULL,14.87158050,120.97706310,14.87159850,120.97707210,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2256,'1C2-9',NULL,14.87160350,120.97706310,14.87162150,120.97707210,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2257,'1C2-10',NULL,14.87162650,120.97706310,14.87164450,120.97707210,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2258,'1C2-11',NULL,14.87164950,120.97706310,14.87166750,120.97707210,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2259,'1C2-12',NULL,14.87167250,120.97706310,14.87169050,120.97707210,'Available','2025-01-25 19:36:58','2025-03-27 22:37:55'),(2260,'1C2-13',NULL,14.87169550,120.97706310,14.87171350,120.97707210,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2261,'1C3-1',NULL,14.87141850,120.97707660,14.87143650,120.97708560,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2262,'1C3-2',NULL,14.87144150,120.97707660,14.87145950,120.97708560,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2263,'1C3-3',NULL,14.87146450,120.97707660,14.87148250,120.97708560,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2264,'1C3-4',NULL,14.87148750,120.97707660,14.87150550,120.97708560,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2265,'1C3-5',NULL,14.87151050,120.97707660,14.87152850,120.97708560,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2266,'1C3-6',NULL,14.87153350,120.97707660,14.87155150,120.97708560,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2267,'1C3-7',NULL,14.87155650,120.97707660,14.87157450,120.97708560,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2268,'1C3-8',NULL,14.87157950,120.97707660,14.87159750,120.97708560,'Available','2025-01-25 19:36:58','2025-03-27 22:41:48'),(2269,'1C3-9',NULL,14.87160250,120.97707660,14.87162050,120.97708560,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2270,'1C3-10',NULL,14.87162550,120.97707660,14.87164350,120.97708560,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2271,'1C3-11',NULL,14.87164850,120.97707660,14.87166650,120.97708560,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2272,'1C3-12',NULL,14.87167150,120.97707660,14.87168950,120.97708560,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2273,'1C3-13',NULL,14.87169450,120.97707660,14.87171250,120.97708560,'Available','2025-01-25 19:36:58','2025-03-27 22:39:00'),(2274,'1C4-1',NULL,14.87141450,120.97709010,14.87143250,120.97709910,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2275,'1C4-2',NULL,14.87143750,120.97709010,14.87145550,120.97709910,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2276,'1C4-3',NULL,14.87146050,120.97709010,14.87147850,120.97709910,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2277,'1C4-4',NULL,14.87148350,120.97709010,14.87150150,120.97709910,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2278,'1C4-5',NULL,14.87150650,120.97709010,14.87152450,120.97709910,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2279,'1C4-6',NULL,14.87152950,120.97709010,14.87154750,120.97709910,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2280,'1C4-7',NULL,14.87155250,120.97709010,14.87157050,120.97709910,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2281,'1C4-8',NULL,14.87157550,120.97709010,14.87159350,120.97709910,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2282,'1C4-9',NULL,14.87159850,120.97709010,14.87161650,120.97709910,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2283,'1C4-10',NULL,14.87162150,120.97709010,14.87163950,120.97709910,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2284,'1C4-11',NULL,14.87164450,120.97709010,14.87166250,120.97709910,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2285,'1C4-12',NULL,14.87166750,120.97709010,14.87168550,120.97709910,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2286,'1C4-13',NULL,14.87169050,120.97709010,14.87170850,120.97709910,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2287,'1C5-1',NULL,14.87141150,120.97710360,14.87142950,120.97711260,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2288,'1C5-2',NULL,14.87143450,120.97710360,14.87145250,120.97711260,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2289,'1C5-3',NULL,14.87145750,120.97710360,14.87147550,120.97711260,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2290,'1C5-4',NULL,14.87148050,120.97710360,14.87149850,120.97711260,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2291,'1C5-5',NULL,14.87150350,120.97710360,14.87152150,120.97711260,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2292,'1C5-6',NULL,14.87152650,120.97710360,14.87154450,120.97711260,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2293,'1C5-7',NULL,14.87154950,120.97710360,14.87156750,120.97711260,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2294,'1C5-8',NULL,14.87157250,120.97710360,14.87159050,120.97711260,'Available','2025-01-25 19:36:58','2025-03-27 22:41:40'),(2295,'1C5-9',NULL,14.87159550,120.97710360,14.87161350,120.97711260,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2296,'1C5-10',NULL,14.87161850,120.97710360,14.87163650,120.97711260,'Available','2025-01-25 19:36:58','2025-03-27 22:41:43'),(2297,'1C5-11',NULL,14.87164150,120.97710360,14.87165950,120.97711260,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2298,'1C5-12',NULL,14.87166450,120.97710360,14.87168250,120.97711260,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2299,'1C5-13',NULL,14.87168750,120.97710360,14.87170550,120.97711260,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2300,'1C5-14',NULL,14.87171050,120.97710360,14.87172850,120.97711260,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2301,'1C7-1',NULL,14.87140650,120.97713060,14.87142450,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2302,'1C7-2',NULL,14.87142950,120.97713060,14.87144750,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2303,'1C7-3',NULL,14.87145250,120.97713060,14.87147050,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2304,'1C7-4',NULL,14.87147550,120.97713060,14.87149350,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2305,'1C7-5',NULL,14.87149850,120.97713060,14.87151650,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2306,'1C7-6',NULL,14.87152150,120.97713060,14.87153950,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2307,'1C7-7',NULL,14.87154450,120.97713060,14.87156250,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2308,'1C7-8',NULL,14.87156750,120.97713060,14.87158550,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2309,'1C7-9',NULL,14.87159050,120.97713060,14.87160850,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2310,'1C7-10',NULL,14.87161350,120.97713060,14.87163150,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2311,'1C7-11',NULL,14.87163650,120.97713060,14.87165450,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2312,'1C7-12',NULL,14.87165950,120.97713060,14.87167750,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2313,'1C7-13',NULL,14.87168250,120.97713060,14.87170050,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2314,'1C7-14',NULL,14.87170550,120.97713060,14.87172350,120.97713960,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2315,'1C8-1',NULL,14.87140650,120.97714410,14.87142450,120.97715310,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2316,'1C8-2',NULL,14.87142950,120.97714410,14.87144750,120.97715310,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2317,'1C8-3',NULL,14.87145250,120.97714410,14.87147050,120.97715310,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2318,'1C8-4',NULL,14.87147550,120.97714410,14.87149350,120.97715310,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2319,'1C8-5',NULL,14.87149850,120.97714410,14.87151650,120.97715310,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2320,'1C8-6',NULL,14.87152150,120.97714410,14.87153950,120.97715310,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2321,'1C8-7',NULL,14.87154450,120.97714410,14.87156250,120.97715310,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2322,'1C8-8',NULL,14.87156750,120.97714410,14.87158550,120.97715310,'Available','2025-01-25 19:36:58','2025-03-27 22:41:24'),(2323,'1C8-9',NULL,14.87159050,120.97714410,14.87160850,120.97715310,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2324,'1C8-10',NULL,14.87161350,120.97714410,14.87163150,120.97715310,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2325,'1C8-11',NULL,14.87163650,120.97714410,14.87165450,120.97715310,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2326,'1C8-12',NULL,14.87165950,120.97714410,14.87167750,120.97715310,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2327,'1C8-13',NULL,14.87168250,120.97714410,14.87170050,120.97715310,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2328,'1C8-14',NULL,14.87170550,120.97714410,14.87172350,120.97715310,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2329,'1C9-1',NULL,14.87140000,120.97715760,14.87141800,120.97716660,'Available','2025-01-25 19:36:58','2025-03-27 22:37:51'),(2330,'1C9-2',NULL,14.87142300,120.97715760,14.87144100,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2331,'1C9-3',NULL,14.87144600,120.97715760,14.87146400,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2332,'1C9-4',NULL,14.87146900,120.97715760,14.87148700,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2333,'1C9-5',NULL,14.87149200,120.97715760,14.87151000,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2334,'1C9-6',NULL,14.87151500,120.97715760,14.87153300,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2335,'1C9-7',NULL,14.87153800,120.97715760,14.87155600,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2336,'1C9-8',NULL,14.87156100,120.97715760,14.87157900,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2337,'1C9-9',NULL,14.87158400,120.97715760,14.87160200,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2338,'1C9-10',NULL,14.87160700,120.97715760,14.87162500,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2339,'1C9-11',NULL,14.87163000,120.97715760,14.87164800,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2340,'1C9-12',NULL,14.87165300,120.97715760,14.87167100,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2341,'1C9-13',NULL,14.87167600,120.97715760,14.87169400,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2342,'1C9-14',NULL,14.87169900,120.97715760,14.87171700,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2343,'1C9-15',NULL,14.87172200,120.97715760,14.87174000,120.97716660,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2344,'1C10-1',NULL,14.87140000,120.97717110,14.87141800,120.97718010,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2345,'1C10-2',NULL,14.87142300,120.97717110,14.87144100,120.97718010,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2346,'1C10-3',NULL,14.87144600,120.97717110,14.87146400,120.97718010,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2347,'1C10-4',NULL,14.87146900,120.97717110,14.87148700,120.97718010,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2348,'1C10-5',NULL,14.87149200,120.97717110,14.87151000,120.97718010,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2349,'1C10-6',NULL,14.87151500,120.97717110,14.87153300,120.97718010,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2350,'1C10-7',NULL,14.87153800,120.97717110,14.87155600,120.97718010,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2351,'1C10-8',NULL,14.87156100,120.97717110,14.87157900,120.97718010,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2352,'1C10-9',NULL,14.87158400,120.97717110,14.87160200,120.97718010,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2353,'1C10-10',NULL,14.87160700,120.97717110,14.87162500,120.97718010,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2354,'1C10-11',NULL,14.87163000,120.97717110,14.87164800,120.97718010,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2355,'1C10-12',NULL,14.87165300,120.97717110,14.87167100,120.97718010,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2356,'1C10-13',NULL,14.87167600,120.97717110,14.87169400,120.97718010,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2357,'1C10-14',NULL,14.87169900,120.97717110,14.87171700,120.97718010,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2358,'1C10-15',NULL,14.87172200,120.97717110,14.87174000,120.97718010,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2359,'1C11-1',NULL,14.87140000,120.97718460,14.87141800,120.97719360,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2360,'1C11-2',NULL,14.87142300,120.97718460,14.87144100,120.97719360,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2361,'1C11-3',NULL,14.87144600,120.97718460,14.87146400,120.97719360,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2362,'1C11-4',NULL,14.87146900,120.97718460,14.87148700,120.97719360,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2363,'1C11-5',NULL,14.87149200,120.97718460,14.87151000,120.97719360,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2364,'1C11-6',NULL,14.87151500,120.97718460,14.87153300,120.97719360,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2365,'1C11-7',NULL,14.87153800,120.97718460,14.87155600,120.97719360,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2366,'1C11-8',NULL,14.87156100,120.97718460,14.87157900,120.97719360,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2367,'1C11-9',NULL,14.87158400,120.97718460,14.87160200,120.97719360,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2368,'1C11-10',NULL,14.87160700,120.97718460,14.87162500,120.97719360,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2369,'1C11-11',NULL,14.87163000,120.97718460,14.87164800,120.97719360,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2370,'1C11-12',NULL,14.87165300,120.97718460,14.87167100,120.97719360,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2371,'1C11-13',NULL,14.87167600,120.97718460,14.87169400,120.97719360,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2372,'1C11-14',NULL,14.87169900,120.97718460,14.87171700,120.97719360,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2373,'1C11-15',NULL,14.87172200,120.97718460,14.87174000,120.97719360,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2374,'1C12-1',NULL,14.87140300,120.97719810,14.87142100,120.97720710,'Available','2025-01-25 19:36:58','2025-03-27 22:41:33'),(2375,'1C12-2',NULL,14.87142600,120.97719810,14.87144400,120.97720710,'Available','2025-01-25 19:36:58','2025-03-27 21:26:18'),(2376,'1C12-3',NULL,14.87144900,120.97719810,14.87146700,120.97720710,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2377,'1C12-4',NULL,14.87147200,120.97719810,14.87149000,120.97720710,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2378,'1C12-5',NULL,14.87149500,120.97719810,14.87151300,120.97720710,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2379,'1C12-6',NULL,14.87151800,120.97719810,14.87153600,120.97720710,'Available','2025-01-25 19:36:58','2025-03-27 22:38:42'),(2380,'1C12-7',NULL,14.87154100,120.97719810,14.87155900,120.97720710,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2381,'1C12-8',NULL,14.87156400,120.97719810,14.87158200,120.97720710,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2382,'1C12-9',NULL,14.87158700,120.97719810,14.87160500,120.97720710,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2383,'1C12-10',NULL,14.87161000,120.97719810,14.87162800,120.97720710,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2384,'1C12-11',NULL,14.87163300,120.97719810,14.87165100,120.97720710,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2385,'1C12-12',NULL,14.87165600,120.97719810,14.87167400,120.97720710,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2386,'1C12-13',NULL,14.87167900,120.97719810,14.87169700,120.97720710,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2387,'1C12-14',NULL,14.87170200,120.97719810,14.87172000,120.97720710,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2388,'1C12-15',NULL,14.87172500,120.97719810,14.87174300,120.97720710,'Available','2025-01-25 19:36:58','2025-03-27 22:38:56'),(2389,'1C13-1',NULL,14.87140300,120.97721160,14.87142100,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2390,'1C13-2',NULL,14.87142600,120.97721160,14.87144400,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2391,'1C13-3',NULL,14.87144900,120.97721160,14.87146700,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2392,'1C13-4',NULL,14.87147200,120.97721160,14.87149000,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2393,'1C13-5',NULL,14.87149500,120.97721160,14.87151300,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2394,'1C13-6',NULL,14.87151800,120.97721160,14.87153600,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2395,'1C13-7',NULL,14.87154100,120.97721160,14.87155900,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2396,'1C13-8',NULL,14.87156400,120.97721160,14.87158200,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2397,'1C13-9',NULL,14.87158700,120.97721160,14.87160500,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2398,'1C13-10',NULL,14.87161000,120.97721160,14.87162800,120.97722060,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2399,'1C13-11',NULL,14.87163300,120.97721160,14.87165100,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2400,'1C13-12',NULL,14.87165600,120.97721160,14.87167400,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2401,'1C13-13',NULL,14.87167900,120.97721160,14.87169700,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2402,'1C13-14',NULL,14.87170200,120.97721160,14.87172000,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2403,'1C13-15',NULL,14.87172500,120.97721160,14.87174300,120.97722060,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2404,'1C16-1',NULL,14.87140100,120.97725210,14.87141900,120.97726110,'Available','2025-01-25 19:36:58','2025-03-27 22:41:27'),(2405,'1C16-2',NULL,14.87142400,120.97725210,14.87144200,120.97726110,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2406,'1C16-3',NULL,14.87144700,120.97725210,14.87146500,120.97726110,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2407,'1C16-4',NULL,14.87147000,120.97725210,14.87148800,120.97726110,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2408,'1C16-5',NULL,14.87149300,120.97725210,14.87151100,120.97726110,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2409,'1C16-6',NULL,14.87151600,120.97725210,14.87153400,120.97726110,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2410,'1C16-7',NULL,14.87153900,120.97725210,14.87155700,120.97726110,'Available','2025-01-25 19:36:58','2025-03-27 22:41:37'),(2411,'1C16-8',NULL,14.87156200,120.97725210,14.87158000,120.97726110,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2412,'1C16-9',NULL,14.87158500,120.97725210,14.87160300,120.97726110,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2413,'1C16-10',NULL,14.87160800,120.97725210,14.87162600,120.97726110,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2414,'1C16-11',NULL,14.87163100,120.97725210,14.87164900,120.97726110,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2415,'1C16-12',NULL,14.87165400,120.97725210,14.87167200,120.97726110,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2416,'1C16-13',NULL,14.87167700,120.97725210,14.87169500,120.97726110,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2417,'1C16-14',NULL,14.87170000,120.97725210,14.87171800,120.97726110,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2418,'1C16-15',NULL,14.87172300,120.97725210,14.87174100,120.97726110,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2419,'1C17-1',NULL,14.87140100,120.97726560,14.87141900,120.97727460,'Available','2025-01-25 19:36:58','2025-03-27 22:41:21'),(2420,'1C17-2',NULL,14.87142400,120.97726560,14.87144200,120.97727460,'Available','2025-01-25 19:36:58','2025-03-27 22:41:51'),(2421,'1C17-3',NULL,14.87144700,120.97726560,14.87146500,120.97727460,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2422,'1C17-4',NULL,14.87147000,120.97726560,14.87148800,120.97727460,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2423,'1C17-5',NULL,14.87149300,120.97726560,14.87151100,120.97727460,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2424,'1C17-6',NULL,14.87151600,120.97726560,14.87153400,120.97727460,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2425,'1C17-7',NULL,14.87153900,120.97726560,14.87155700,120.97727460,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2426,'1C17-8',NULL,14.87156200,120.97726560,14.87158000,120.97727460,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2427,'1C17-9',NULL,14.87158500,120.97726560,14.87160300,120.97727460,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2428,'1C17-10',NULL,14.87160800,120.97726560,14.87162600,120.97727460,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2429,'1C17-11',NULL,14.87163100,120.97726560,14.87164900,120.97727460,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2430,'1C17-12',NULL,14.87165400,120.97726560,14.87167200,120.97727460,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2431,'1C17-13',NULL,14.87167700,120.97726560,14.87169500,120.97727460,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2432,'1C17-14',NULL,14.87170000,120.97726560,14.87171800,120.97727460,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2433,'1C17-15',NULL,14.87172300,120.97726560,14.87174100,120.97727460,'Available','2025-01-25 19:36:58','2025-03-27 22:38:54'),(2434,'1C18-1',NULL,14.87140100,120.97727910,14.87141900,120.97728810,'Available','2025-01-25 19:36:58','2025-03-27 22:41:16'),(2435,'1C18-2',NULL,14.87142400,120.97727910,14.87144200,120.97728810,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2436,'1C18-3',NULL,14.87144700,120.97727910,14.87146500,120.97728810,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2437,'1C18-4',NULL,14.87147000,120.97727910,14.87148800,120.97728810,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2438,'1C18-5',NULL,14.87149300,120.97727910,14.87151100,120.97728810,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2439,'1C18-6',NULL,14.87151600,120.97727910,14.87153400,120.97728810,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2440,'1C18-7',NULL,14.87153900,120.97727910,14.87155700,120.97728810,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2441,'1C18-8',NULL,14.87156200,120.97727910,14.87158000,120.97728810,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2442,'1C18-9',NULL,14.87158500,120.97727910,14.87160300,120.97728810,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2443,'1C18-10',NULL,14.87160800,120.97727910,14.87162600,120.97728810,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2444,'1C18-11',NULL,14.87163100,120.97727910,14.87164900,120.97728810,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2445,'1C18-12',NULL,14.87165400,120.97727910,14.87167200,120.97728810,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2446,'1C18-13',NULL,14.87167700,120.97727910,14.87169500,120.97728810,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2447,'1C18-14',NULL,14.87170000,120.97727910,14.87171800,120.97728810,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2448,'1C18-15',NULL,14.87172300,120.97727910,14.87174100,120.97728810,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2449,'1C14-1',NULL,14.87140100,120.97722510,14.87141900,120.97723410,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2450,'1C14-2',NULL,14.87142400,120.97722510,14.87144200,120.97723410,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2451,'1C14-3',NULL,14.87144700,120.97722510,14.87146500,120.97723410,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2452,'1C14-4',NULL,14.87147000,120.97722510,14.87148800,120.97723410,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2453,'1C14-5',NULL,14.87149300,120.97722510,14.87151100,120.97723410,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2454,'1C14-6',NULL,14.87151600,120.97722510,14.87153400,120.97723410,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2455,'1C14-7',NULL,14.87153900,120.97722510,14.87155700,120.97723410,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2456,'1C14-8',NULL,14.87156200,120.97722510,14.87158000,120.97723410,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2457,'1C14-9',NULL,14.87158500,120.97722510,14.87160300,120.97723410,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2458,'1C14-10',NULL,14.87160800,120.97722510,14.87162600,120.97723410,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2459,'1C14-11',NULL,14.87163100,120.97722510,14.87164900,120.97723410,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2460,'1C14-12',NULL,14.87165400,120.97722510,14.87167200,120.97723410,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2461,'1C14-13',NULL,14.87167700,120.97722510,14.87169500,120.97723410,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2462,'1C14-14',NULL,14.87170000,120.97722510,14.87171800,120.97723410,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2463,'1C14-15',NULL,14.87172300,120.97722510,14.87174100,120.97723410,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2464,'1C19-1',NULL,14.87140100,120.97729260,14.87141900,120.97730160,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2465,'1C19-2',NULL,14.87142400,120.97729260,14.87144200,120.97730160,'Available','2025-01-25 19:36:58','2025-03-27 22:41:46'),(2466,'1C19-3',NULL,14.87144700,120.97729260,14.87146500,120.97730160,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2467,'1C19-4',NULL,14.87147000,120.97729260,14.87148800,120.97730160,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2468,'1C19-5',NULL,14.87149300,120.97729260,14.87151100,120.97730160,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2469,'1C19-6',NULL,14.87151600,120.97729260,14.87153400,120.97730160,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2470,'1C19-7',NULL,14.87153900,120.97729260,14.87155700,120.97730160,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2471,'1C19-8',NULL,14.87156200,120.97729260,14.87158000,120.97730160,'Available','2025-01-25 19:36:58','2025-01-25 19:36:58'),(2472,'1C19-9',NULL,14.87158500,120.97729260,14.87160300,120.97730160,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2473,'1C19-10',NULL,14.87160800,120.97729260,14.87162600,120.97730160,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2474,'1C19-11',NULL,14.87163100,120.97729260,14.87164900,120.97730160,'Available','2025-01-25 19:36:58','2025-03-27 22:38:46'),(2475,'1C19-12',NULL,14.87165400,120.97729260,14.87167200,120.97730160,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2476,'1C19-13',NULL,14.87167700,120.97729260,14.87169500,120.97730160,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2477,'1C19-14',NULL,14.87170000,120.97729260,14.87171800,120.97730160,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2478,'1C19-15',NULL,14.87172300,120.97729260,14.87174100,120.97730160,'Available','2025-01-25 19:36:58','2025-03-30 00:57:45'),(2479,'1C21-1',NULL,14.87140100,120.97731960,14.87141900,120.97732860,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2480,'1C21-2',NULL,14.87142400,120.97731960,14.87144200,120.97732860,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2481,'1C21-3',NULL,14.87144700,120.97731960,14.87146500,120.97732860,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2482,'1C21-4',NULL,14.87147000,120.97731960,14.87148800,120.97732860,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2483,'1C21-5',NULL,14.87149300,120.97731960,14.87151100,120.97732860,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2484,'1C21-6',NULL,14.87151600,120.97731960,14.87153400,120.97732860,'Available','2025-01-25 19:36:59','2025-01-25 19:36:59'),(2485,'1C21-7',NULL,14.87153900,120.97731960,14.87155700,120.97732860,'Available','2025-01-25 19:36:59','2025-01-25 19:36:59'),(2486,'1C21-8',NULL,14.87156200,120.97731960,14.87158000,120.97732860,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2487,'1C21-9',NULL,14.87158500,120.97731960,14.87160300,120.97732860,'Available','2025-01-25 19:36:59','2025-01-25 19:36:59'),(2488,'1C21-10',NULL,14.87160800,120.97731960,14.87162600,120.97732860,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2489,'1C21-11',NULL,14.87163100,120.97731960,14.87164900,120.97732860,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2490,'1C21-12',NULL,14.87165400,120.97731960,14.87167200,120.97732860,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2491,'1C21-13',NULL,14.87167700,120.97731960,14.87169500,120.97732860,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2492,'1C21-14',NULL,14.87170000,120.97731960,14.87171800,120.97732860,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2493,'1C21-15',NULL,14.87172300,120.97731960,14.87174100,120.97732860,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2494,'1C22-1',NULL,14.87140100,120.97733310,14.87141900,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2495,'1C22-2',NULL,14.87142400,120.97733310,14.87144200,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2496,'1C22-3',46,14.87144700,120.97733310,14.87146500,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2497,'1C22-4',NULL,14.87147000,120.97733310,14.87148800,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2498,'1C22-5',NULL,14.87149300,120.97733310,14.87151100,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2499,'1C22-6',NULL,14.87151600,120.97733310,14.87153400,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2500,'1C22-7',NULL,14.87153900,120.97733310,14.87155700,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2501,'1C22-8',NULL,14.87156200,120.97733310,14.87158000,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2502,'1C22-9',NULL,14.87158500,120.97733310,14.87160300,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2503,'1C22-10',NULL,14.87160800,120.97733310,14.87162600,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2504,'1C22-11',NULL,14.87163100,120.97733310,14.87164900,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2505,'1C22-12',NULL,14.87165400,120.97733310,14.87167200,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2506,'1C22-13',NULL,14.87167700,120.97733310,14.87169500,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2507,'1C22-14',NULL,14.87170000,120.97733310,14.87171800,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2508,'1C22-15',NULL,14.87172300,120.97733310,14.87174100,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2509,'1C22-16',NULL,14.87174600,120.97733310,14.87176400,120.97734210,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2510,'1C15-1',NULL,14.87140100,120.97723860,14.87141900,120.97724760,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2511,'1C15-2',NULL,14.87142400,120.97723860,14.87144200,120.97724760,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2512,'1C15-3',NULL,14.87144700,120.97723860,14.87146500,120.97724760,'Available','2025-01-25 19:36:59','2025-01-25 19:36:59'),(2513,'1C15-4',NULL,14.87147000,120.97723860,14.87148800,120.97724760,'Available','2025-01-25 19:36:59','2025-03-27 22:38:44'),(2514,'1C15-5',NULL,14.87149300,120.97723860,14.87151100,120.97724760,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2515,'1C15-6',NULL,14.87151600,120.97723860,14.87153400,120.97724760,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2516,'1C15-7',NULL,14.87153900,120.97723860,14.87155700,120.97724760,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2517,'1C15-8',NULL,14.87156200,120.97723860,14.87158000,120.97724760,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2518,'1C15-9',NULL,14.87158500,120.97723860,14.87160300,120.97724760,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2519,'1C15-10',NULL,14.87160800,120.97723860,14.87162600,120.97724760,'Available','2025-01-25 19:36:59','2025-01-25 19:36:59'),(2520,'1C15-11',NULL,14.87163100,120.97723860,14.87164900,120.97724760,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2521,'1C15-12',NULL,14.87165400,120.97723860,14.87167200,120.97724760,'Available','2025-01-25 19:36:59','2025-01-25 19:36:59'),(2522,'1C15-13',NULL,14.87167700,120.97723860,14.87169500,120.97724760,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2523,'1C15-14',NULL,14.87170000,120.97723860,14.87171800,120.97724760,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2524,'1C15-15',NULL,14.87172300,120.97723860,14.87174100,120.97724760,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2525,'1C24-1',NULL,14.87140100,120.97736010,14.87141900,120.97736910,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2526,'1C24-2',NULL,14.87142400,120.97736010,14.87144200,120.97736910,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2527,'1C24-3',NULL,14.87144700,120.97736010,14.87146500,120.97736910,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2528,'1C24-4',NULL,14.87147000,120.97736010,14.87148800,120.97736910,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2529,'1C24-5',NULL,14.87149300,120.97736010,14.87151100,120.97736910,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2530,'1C24-6',NULL,14.87151600,120.97736010,14.87153400,120.97736910,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2531,'1C24-7',NULL,14.87153900,120.97736010,14.87155700,120.97736910,'Available','2025-01-25 19:36:59','2025-01-25 19:36:59'),(2532,'1C24-8',NULL,14.87156200,120.97736010,14.87158000,120.97736910,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2533,'1C24-9',NULL,14.87158500,120.97736010,14.87160300,120.97736910,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2534,'1C24-10',NULL,14.87160800,120.97736010,14.87162600,120.97736910,'Available','2025-01-25 19:36:59','2025-01-25 19:36:59'),(2535,'1C24-11',NULL,14.87163100,120.97736010,14.87164900,120.97736910,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2536,'1C24-12',NULL,14.87165400,120.97736010,14.87167200,120.97736910,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2537,'1C24-13',NULL,14.87167700,120.97736010,14.87169500,120.97736910,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2538,'1C24-14',NULL,14.87170000,120.97736010,14.87171800,120.97736910,'Available','2025-01-25 19:36:59','2025-03-27 22:38:52'),(2539,'1C24-15',NULL,14.87172300,120.97736010,14.87174100,120.97736910,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2540,'1C24-16',NULL,14.87174600,120.97736010,14.87176400,120.97736910,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2541,'1C25-1',NULL,14.87140100,120.97737360,14.87141900,120.97738260,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2542,'1C25-2',NULL,14.87142400,120.97737360,14.87144200,120.97738260,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2543,'1C25-3',NULL,14.87144700,120.97737360,14.87146500,120.97738260,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2544,'1C25-4',NULL,14.87147000,120.97737360,14.87148800,120.97738260,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2545,'1C25-5',NULL,14.87149300,120.97737360,14.87151100,120.97738260,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2546,'1C25-6',NULL,14.87151600,120.97737360,14.87153400,120.97738260,'Available','2025-01-25 19:36:59','2025-01-25 19:36:59'),(2547,'1C25-7',NULL,14.87153900,120.97737360,14.87155700,120.97738260,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2548,'1C25-8',NULL,14.87156200,120.97737360,14.87158000,120.97738260,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2549,'1C25-9',NULL,14.87158500,120.97737360,14.87160300,120.97738260,'Available','2025-01-25 19:36:59','2025-01-25 19:36:59'),(2550,'1C25-10',NULL,14.87160800,120.97737360,14.87162600,120.97738260,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2551,'1C25-11',NULL,14.87163100,120.97737360,14.87164900,120.97738260,'Available','2025-01-25 19:36:59','2025-01-25 19:36:59'),(2552,'1C25-12',NULL,14.87165400,120.97737360,14.87167200,120.97738260,'Available','2025-01-25 19:36:59','2025-01-25 19:36:59'),(2553,'1C25-13',NULL,14.87167700,120.97737360,14.87169500,120.97738260,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2554,'1C25-14',NULL,14.87170000,120.97737360,14.87171800,120.97738260,'Available','2025-01-25 19:36:59','2025-03-27 22:38:50'),(2555,'1C25-15',NULL,14.87172300,120.97737360,14.87174100,120.97738260,'Available','2025-01-25 19:36:59','2025-03-27 22:38:48'),(2556,'1C25-16',NULL,14.87174600,120.97737360,14.87176400,120.97738260,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2557,'1C26-1',NULL,14.87140100,120.97738710,14.87141900,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2558,'1C26-2',NULL,14.87142400,120.97738710,14.87144200,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2559,'1C26-3',NULL,14.87144700,120.97738710,14.87146500,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2560,'1C26-4',NULL,14.87147000,120.97738710,14.87148800,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2561,'1C26-5',NULL,14.87149300,120.97738710,14.87151100,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2562,'1C26-6',NULL,14.87151600,120.97738710,14.87153400,120.97739610,'Available','2025-01-25 19:36:59','2025-03-27 22:41:30'),(2563,'1C26-7',NULL,14.87153900,120.97738710,14.87155700,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2564,'1C26-8',NULL,14.87156200,120.97738710,14.87158000,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2565,'1C26-9',NULL,14.87158500,120.97738710,14.87160300,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2566,'1C26-10',NULL,14.87160800,120.97738710,14.87162600,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2567,'1C26-11',NULL,14.87163100,120.97738710,14.87164900,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2568,'1C26-12',NULL,14.87165400,120.97738710,14.87167200,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2569,'1C26-13',NULL,14.87167700,120.97738710,14.87169500,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2570,'1C26-14',NULL,14.87170000,120.97738710,14.87171800,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2571,'1C26-15',NULL,14.87172300,120.97738710,14.87174100,120.97739610,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2572,'1C26-16',NULL,14.87174600,120.97738710,14.87176400,120.97739610,'Available','2025-01-25 19:36:59','2025-03-27 22:37:58'),(2573,'1C27-1',NULL,14.87140100,120.97740060,14.87141900,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2574,'1C27-2',NULL,14.87142400,120.97740060,14.87144200,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2575,'1C27-3',NULL,14.87144700,120.97740060,14.87146500,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2576,'1C27-4',NULL,14.87147000,120.97740060,14.87148800,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2577,'1C27-5',NULL,14.87149300,120.97740060,14.87151100,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2578,'1C27-6',NULL,14.87151600,120.97740060,14.87153400,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2579,'1C27-7',NULL,14.87153900,120.97740060,14.87155700,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2580,'1C27-8',NULL,14.87156200,120.97740060,14.87158000,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2581,'1C27-9',NULL,14.87158500,120.97740060,14.87160300,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2582,'1C27-10',NULL,14.87160800,120.97740060,14.87162600,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2583,'1C27-11',45,14.87163100,120.97740060,14.87164900,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2584,'1C27-12',NULL,14.87165400,120.97740060,14.87167200,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2585,'1C27-13',NULL,14.87167700,120.97740060,14.87169500,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2586,'1C27-14',NULL,14.87170000,120.97740060,14.87171800,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2587,'1C27-15',NULL,14.87172300,120.97740060,14.87174100,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2588,'1C27-16',NULL,14.87174600,120.97740060,14.87176400,120.97740960,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2589,'1C23-1',NULL,14.87140100,120.97734660,14.87141900,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2590,'1C23-2',NULL,14.87142400,120.97734660,14.87144200,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2591,'1C23-3',NULL,14.87144700,120.97734660,14.87146500,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2592,'1C23-4',NULL,14.87147000,120.97734660,14.87148800,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2593,'1C23-5',NULL,14.87149300,120.97734660,14.87151100,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2594,'1C23-6',NULL,14.87151600,120.97734660,14.87153400,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2595,'1C23-7',NULL,14.87153900,120.97734660,14.87155700,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2596,'1C23-8',NULL,14.87156200,120.97734660,14.87158000,120.97735560,'Available','2025-01-25 19:36:59','2025-01-25 19:36:59'),(2597,'1C23-9',NULL,14.87158500,120.97734660,14.87160300,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2598,'1C23-10',NULL,14.87160800,120.97734660,14.87162600,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2599,'1C23-11',NULL,14.87163100,120.97734660,14.87164900,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2600,'1C23-12',NULL,14.87165400,120.97734660,14.87167200,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2601,'1C23-13',NULL,14.87167700,120.97734660,14.87169500,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2602,'1C23-14',NULL,14.87170000,120.97734660,14.87171800,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2603,'1C23-15',NULL,14.87172300,120.97734660,14.87174100,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2604,'1C23-16',NULL,14.87174600,120.97734660,14.87176400,120.97735560,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2605,'1C30-1',NULL,14.87140100,120.97744110,14.87141900,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2606,'1C30-2',NULL,14.87142400,120.97744110,14.87144200,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2607,'1C30-3',NULL,14.87144700,120.97744110,14.87146500,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2608,'1C30-4',NULL,14.87147000,120.97744110,14.87148800,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2609,'1C30-5',NULL,14.87149300,120.97744110,14.87151100,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2610,'1C30-6',NULL,14.87151600,120.97744110,14.87153400,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2611,'1C30-7',NULL,14.87153900,120.97744110,14.87155700,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2612,'1C30-8',NULL,14.87156200,120.97744110,14.87158000,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2613,'1C30-9',NULL,14.87158500,120.97744110,14.87160300,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2614,'1C30-10',NULL,14.87160800,120.97744110,14.87162600,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2615,'1C30-11',NULL,14.87163100,120.97744110,14.87164900,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2616,'1C30-12',NULL,14.87165400,120.97744110,14.87167200,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2617,'1C30-13',NULL,14.87167700,120.97744110,14.87169500,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2618,'1C30-14',NULL,14.87170000,120.97744110,14.87171800,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2619,'1C30-15',NULL,14.87172300,120.97744110,14.87174100,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2620,'1C30-16',NULL,14.87174600,120.97744110,14.87176400,120.97745010,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2621,'1C28-1',NULL,14.87140100,120.97741410,14.87141900,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2622,'1C28-2',NULL,14.87142400,120.97741410,14.87144200,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2623,'1C28-3',NULL,14.87144700,120.97741410,14.87146500,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2624,'1C28-4',NULL,14.87147000,120.97741410,14.87148800,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2625,'1C28-5',NULL,14.87149300,120.97741410,14.87151100,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2626,'1C28-6',NULL,14.87151600,120.97741410,14.87153400,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2627,'1C28-7',NULL,14.87153900,120.97741410,14.87155700,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2628,'1C28-8',NULL,14.87156200,120.97741410,14.87158000,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2629,'1C28-9',NULL,14.87158500,120.97741410,14.87160300,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2630,'1C28-10',NULL,14.87160800,120.97741410,14.87162600,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2631,'1C28-11',NULL,14.87163100,120.97741410,14.87164900,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2632,'1C28-12',NULL,14.87165400,120.97741410,14.87167200,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2633,'1C28-13',NULL,14.87167700,120.97741410,14.87169500,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2634,'1C28-14',NULL,14.87170000,120.97741410,14.87171800,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2635,'1C28-15',NULL,14.87172300,120.97741410,14.87174100,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2636,'1C28-16',NULL,14.87174600,120.97741410,14.87176400,120.97742310,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2637,'1C29-1',NULL,14.87140100,120.97742760,14.87141900,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2638,'1C29-2',NULL,14.87142400,120.97742760,14.87144200,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2639,'1C29-3',NULL,14.87144700,120.97742760,14.87146500,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2640,'1C29-4',NULL,14.87147000,120.97742760,14.87148800,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2641,'1C29-5',NULL,14.87149300,120.97742760,14.87151100,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2642,'1C29-6',NULL,14.87151600,120.97742760,14.87153400,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2643,'1C29-7',NULL,14.87153900,120.97742760,14.87155700,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2644,'1C29-8',NULL,14.87156200,120.97742760,14.87158000,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2645,'1C29-9',NULL,14.87158500,120.97742760,14.87160300,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2646,'1C29-10',NULL,14.87160800,120.97742760,14.87162600,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2647,'1C29-11',NULL,14.87163100,120.97742760,14.87164900,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2648,'1C29-12',NULL,14.87165400,120.97742760,14.87167200,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2649,'1C29-13',NULL,14.87167700,120.97742760,14.87169500,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2650,'1C29-14',NULL,14.87170000,120.97742760,14.87171800,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2651,'1C29-15',NULL,14.87172300,120.97742760,14.87174100,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2652,'1C29-16',NULL,14.87174600,120.97742760,14.87176400,120.97743660,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2653,'1C20-1',NULL,14.87140100,120.97730610,14.87141900,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2654,'1C20-2',NULL,14.87142400,120.97730610,14.87144200,120.97731510,'Available','2025-01-25 19:36:59','2025-03-27 22:41:53'),(2655,'1C20-3',NULL,14.87144700,120.97730610,14.87146500,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2656,'1C20-4',NULL,14.87147000,120.97730610,14.87148800,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2657,'1C20-5',NULL,14.87149300,120.97730610,14.87151100,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2658,'1C20-6',NULL,14.87151600,120.97730610,14.87153400,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2659,'1C20-7',NULL,14.87153900,120.97730610,14.87155700,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2660,'1C20-8',NULL,14.87156200,120.97730610,14.87158000,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2661,'1C20-9',NULL,14.87158500,120.97730610,14.87160300,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2662,'1C20-10',NULL,14.87160800,120.97730610,14.87162600,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2663,'1C20-11',NULL,14.87163100,120.97730610,14.87164900,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2664,'1C20-12',NULL,14.87165400,120.97730610,14.87167200,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2665,'1C20-13',NULL,14.87167700,120.97730610,14.87169500,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2666,'1C20-14',NULL,14.87170000,120.97730610,14.87171800,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2667,'1C20-15',NULL,14.87172300,120.97730610,14.87174100,120.97731510,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2668,'1C31-1',NULL,14.87157100,120.97745460,14.87158900,120.97746360,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2669,'1C31-2',NULL,14.87159400,120.97745460,14.87161200,120.97746360,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2670,'1C31-3',NULL,14.87161700,120.97745460,14.87163500,120.97746360,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2671,'1C31-4',NULL,14.87164000,120.97745460,14.87165800,120.97746360,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2672,'1C31-5',NULL,14.87166300,120.97745460,14.87168100,120.97746360,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2673,'1C31-6',NULL,14.87168600,120.97745460,14.87170400,120.97746360,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2674,'1C31-7',NULL,14.87170900,120.97745460,14.87172700,120.97746360,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2675,'1C31-8',NULL,14.87173200,120.97745460,14.87175000,120.97746360,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45'),(2676,'1C31-9',NULL,14.87175500,120.97745460,14.87177300,120.97746360,'Available','2025-01-25 19:36:59','2025-03-30 00:57:45');
/*!40000 ALTER TABLE `lots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (130,49,'Your lot reservation for Lot #1C1-2 (Supreme) has been approved by the administrator.','my_lots_and_estates',0,'2025-04-01 03:30:32');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ownership_transfer_requests`
--

DROP TABLE IF EXISTS `ownership_transfer_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ownership_transfer_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `new_owner_email` varchar(255) NOT NULL,
  `otp_code` varchar(10) DEFAULT NULL,
  `otp_expires_at` datetime DEFAULT NULL,
  `status` enum('Pending','Verified','Completed','Expired') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `ownership_transfer_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ownership_transfer_requests`
--

LOCK TABLES `ownership_transfer_requests` WRITE;
/*!40000 ALTER TABLE `ownership_transfer_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `ownership_transfer_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phase_pricing`
--

DROP TABLE IF EXISTS `phase_pricing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phase_pricing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `six_months_down_payment` decimal(10,2) NOT NULL,
  `six_months_balance` decimal(10,2) NOT NULL,
  `six_months_monthly_amortization` decimal(10,2) NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phase_pricing`
--

LOCK TABLES `phase_pricing` WRITE;
/*!40000 ALTER TABLE `phase_pricing` DISABLE KEYS */;
INSERT INTO `phase_pricing` VALUES (1,'Phase 1','Supreme',1,66377.00,0.12,10000.00,84342.24,75908.02,0.10,80125.13,0.05,16025.03,64100.10,10683.35,16868.45,0.20,67473.79,5622.82,0.00,3113.57,0.10,2339.00,0.15,1877.85,0.15,1980.45,0.25,'2025-04-01 04:11:13'),(2,'Phase 1','Special',1,64162.00,0.12,10000.00,81861.44,73675.30,0.10,77768.37,0.05,15553.67,62214.69,10369.12,16372.29,0.20,65489.15,5457.43,0.00,3021.99,0.10,2270.20,0.15,1822.61,0.15,1922.19,0.25,'2025-04-03 00:28:55'),(3,'Phase 1','Standard',1,61945.00,0.12,10000.00,79378.40,71440.56,0.10,75409.48,0.05,15081.90,60327.58,10054.60,15875.68,0.20,63502.72,5291.89,0.00,2930.33,0.10,2201.34,0.15,1767.33,0.15,1863.89,0.25,'2025-04-03 00:31:29'),(4,'Phase 2','Supreme',1,64162.00,0.12,10000.00,81861.44,74675.30,0.10,78268.37,0.05,0.00,0.00,0.00,24372.29,0.20,57489.15,4790.76,0.00,2634.92,0.10,1836.46,0.15,1437.23,0.15,1197.69,0.25,'2025-01-24 04:18:33'),(5,'Phase 2','Standard',1,61945.00,0.12,10000.00,79378.40,72441.00,0.10,75909.00,0.05,0.00,0.00,0.00,23786.00,0.20,55503.00,4625.23,0.00,2543.87,0.10,1773.00,0.15,1387.57,0.15,1156.31,0.25,'2025-01-24 04:18:33'),(6,'Phase 3','Supreme',1,63491.00,0.12,10000.00,81109.92,73999.00,0.10,77554.00,0.05,0.00,0.00,0.00,24222.00,0.20,56888.00,4740.66,0.00,2607.36,0.10,1817.25,0.15,1422.20,0.15,1185.17,0.25,'2025-01-24 04:18:33'),(7,'Phase 3','Special',1,61372.00,0.12,10000.00,78736.64,71863.00,0.10,75300.00,0.05,0.00,0.00,0.00,23747.00,0.20,54989.00,4582.44,0.00,2520.34,0.10,1756.60,0.15,1374.73,0.15,1145.61,0.25,'2025-01-24 04:18:33'),(8,'Phase 3','Standard',1,59256.00,0.12,10000.00,76366.72,69730.00,0.10,73048.00,0.05,0.00,0.00,0.00,23273.00,0.20,53093.00,4424.45,0.00,2433.45,0.10,1696.04,0.15,1327.33,0.15,1106.11,0.25,'2025-01-24 04:18:33'),(9,'Phase 4','Supreme',1,63491.00,0.12,10000.00,81109.92,73999.00,0.10,77554.00,0.05,0.00,0.00,0.00,24222.00,0.20,56888.00,4740.66,0.00,2607.36,0.10,1817.25,0.15,1422.20,0.15,1185.17,0.25,'2025-01-24 04:18:33'),(10,'Phase 4','Special',1,61372.00,0.12,10000.00,78736.64,71863.00,0.10,75300.00,0.05,0.00,0.00,0.00,23747.00,0.20,54989.00,4582.44,0.00,2520.34,0.10,1756.60,0.15,1374.73,0.15,1145.61,0.25,'2025-01-24 04:18:33'),(11,'Phase 4','Standard',1,59256.00,0.12,10000.00,76366.72,69730.00,0.10,73048.00,0.05,0.00,0.00,0.00,23273.00,0.20,53093.00,4424.45,0.00,2433.45,0.10,1696.04,0.15,1327.33,0.15,1106.11,0.25,'2025-01-24 04:18:33');
/*!40000 ALTER TABLE `phase_pricing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `six_months`
--

DROP TABLE IF EXISTS `six_months`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `six_months` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) DEFAULT NULL,
  `lot_id` varchar(255) NOT NULL,
  `down_payment` decimal(10,2) NOT NULL,
  `down_payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `down_payment_date` date DEFAULT NULL,
  `down_payment_due_date` date NOT NULL,
  `down_reference_number` varchar(255) NOT NULL,
  `down_receipt_path` varchar(255) DEFAULT NULL,
  `next_due_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `monthly_payment` decimal(10,2) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `payment_status` enum('Pending','Ongoing','Completed') DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `lot_id` (`lot_id`),
  KEY `fk_six_months_reservation_id` (`reservation_id`),
  CONSTRAINT `fk_six_months_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `lot_reservations` (`id`),
  CONSTRAINT `six_months_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lot_reservations` (`lot_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `six_months`
--

LOCK TABLES `six_months` WRITE;
/*!40000 ALTER TABLE `six_months` DISABLE KEYS */;
/*!40000 ALTER TABLE `six_months` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `six_months_payments`
--

DROP TABLE IF EXISTS `six_months_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `six_months_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `six_months_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `receipt_path` varchar(255) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_status` enum('Pending','Paid') DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  KEY `six_months_id` (`six_months_id`),
  CONSTRAINT `six_months_payments_ibfk_1` FOREIGN KEY (`six_months_id`) REFERENCES `six_months` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `six_months_payments`
--

LOCK TABLES `six_months_payments` WRITE;
/*!40000 ALTER TABLE `six_months_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `six_months_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix_name` enum('Sr.','Jr.','I','II','III','IV','V','') NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John','Cena','Doe','','admin@mail.com','$2b$12$CXsdriK0Qd2Qd3GCHEf.Zey4jvnoxSPWxwkyYDTE3.DLbj0M6YGrC','2025-01-22 01:09:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-04 18:51:03

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2021 at 10:35 PM
-- Server version: 8.0.21
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `a/r`
--

CREATE TABLE `a/r` (
  `id` int UNSIGNED NOT NULL,
  `debit` int NOT NULL,
  `credit` int NOT NULL,
  `month_entry` varchar(20) NOT NULL DEFAULT '08-2021'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `a/r`
--

INSERT INTO `a/r` (`id`, `debit`, `credit`, `month_entry`) VALUES
(1, 1200, 0, '08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `accumulateddepofchair`
--

CREATE TABLE `accumulateddepofchair` (
  `id` int UNSIGNED NOT NULL,
  `debit` int NOT NULL,
  `credit` int NOT NULL,
  `month_entry` varchar(50) NOT NULL DEFAULT '08-2021'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accumulateddepofchair`
--

INSERT INTO `accumulateddepofchair` (`id`, `debit`, `credit`, `month_entry`) VALUES
(1, 0, 120, '08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `id` int UNSIGNED NOT NULL,
  `debit` int NOT NULL,
  `credit` int NOT NULL,
  `month_entry` varchar(50) NOT NULL DEFAULT '08-2021'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`id`, `debit`, `credit`, `month_entry`) VALUES
(3, 2970000, 0, '08-2021'),
(4, 12000, 0, '08-2021'),
(5, 3200, 0, '08-2021'),
(6, 0, 123000, '08-2021'),
(7, 0, 1200, '08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `chair`
--

CREATE TABLE `chair` (
  `id` int UNSIGNED NOT NULL,
  `debit` int NOT NULL,
  `credit` int NOT NULL,
  `month_entry` varchar(20) NOT NULL DEFAULT '08-2021'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chair`
--

INSERT INTO `chair` (`id`, `debit`, `credit`, `month_entry`) VALUES
(1, 1200, 0, '08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `depreciationofchair`
--

CREATE TABLE `depreciationofchair` (
  `id` int UNSIGNED NOT NULL,
  `debit` int NOT NULL,
  `credit` int NOT NULL,
  `month_entry` varchar(20) NOT NULL DEFAULT '08-2021'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `depreciationofchair`
--

INSERT INTO `depreciationofchair` (`id`, `debit`, `credit`, `month_entry`) VALUES
(1, 120, 0, '08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `furniture`
--

CREATE TABLE `furniture` (
  `id` int UNSIGNED NOT NULL,
  `debit` int NOT NULL,
  `credit` int NOT NULL,
  `month_entry` varchar(20) NOT NULL DEFAULT '08-2021'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `furniture`
--

INSERT INTO `furniture` (`id`, `debit`, `credit`, `month_entry`) VALUES
(2, 123000, 0, '08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `journal_entries`
--

CREATE TABLE `journal_entries` (
  `entry_id` int NOT NULL,
  `entry_date` date NOT NULL,
  `debit_info` varchar(255) NOT NULL,
  `debit_amount` varchar(255) NOT NULL,
  `credit_info` varchar(255) NOT NULL,
  `credit_amount` varchar(255) NOT NULL,
  `typeD_id` int NOT NULL,
  `typeC_id` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `month_entry` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `journal_entries`
--

INSERT INTO `journal_entries` (`entry_id`, `entry_date`, `debit_info`, `debit_amount`, `credit_info`, `credit_amount`, `typeD_id`, `typeC_id`, `description`, `month_entry`, `created_at`) VALUES
(1, '2021-08-01', '[\"Cash\"]', '[\"2970000\"]', '[\"Owner Equity\"]', '[\"2970000\"]', 1, 3, 'Investment in Business', '08-2021', '2021-08-30 01:00:20'),
(2, '2021-08-02', '[\"Cash\"]', '[\"12000\"]', '[\"Service Revenue\"]', '[\"12000\"]', 1, 5, 'Provided Services', '08-2021', '2021-08-30 01:10:39'),
(3, '2021-08-04', '[\"Cash\",\"A\\/R\"]', '[\"3200\",\"1200\"]', '[\"Service Revenue\"]', '[\"4400\"]', 1, 5, 'Provided Services', '08-2021', '2021-08-30 01:11:40'),
(4, '2021-08-05', '[\"Furniture\"]', '[\"123000\"]', '[\"Cash\"]', '[\"123000\"]', 1, 1, 'Buying Furniture', '08-2021', '2021-08-30 01:12:13'),
(5, '2021-08-12', '[\"Chair\"]', '[\"1200\"]', '[\"Cash\"]', '[\"1200\"]', 7, 1, 'Bought Chair', '08-2021', '2021-08-30 01:13:42'),
(6, '2021-08-14', '[\"Depreciation of Chair\"]', '[\"120\"]', '[\"Accumulated Dep of Chair\"]', '[\"120\"]', 6, 13, 'Depreciation of chair', '08-2021', '2021-08-30 01:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `ownerequity`
--

CREATE TABLE `ownerequity` (
  `id` int UNSIGNED NOT NULL,
  `debit` int NOT NULL,
  `credit` int NOT NULL,
  `month_entry` varchar(50) NOT NULL DEFAULT '08-2021'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ownerequity`
--

INSERT INTO `ownerequity` (`id`, `debit`, `credit`, `month_entry`) VALUES
(2, 0, 2970000, '08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `servicerevenue`
--

CREATE TABLE `servicerevenue` (
  `id` int UNSIGNED NOT NULL,
  `debit` int NOT NULL,
  `credit` int NOT NULL,
  `month_entry` varchar(50) NOT NULL DEFAULT '08-2021'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `servicerevenue`
--

INSERT INTO `servicerevenue` (`id`, `debit`, `credit`, `month_entry`) VALUES
(1, 0, 12000, '08-2021'),
(2, 0, 4400, '08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`) VALUES
(1, 'Asset'),
(2, 'Liability'),
(3, 'Owner Equity'),
(4, 'Owner Withdrawl'),
(5, 'Revenues'),
(6, 'Expenses'),
(7, 'Short Term Asset'),
(13, 'Depreciation of Chair');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a/r`
--
ALTER TABLE `a/r`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accumulateddepofchair`
--
ALTER TABLE `accumulateddepofchair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chair`
--
ALTER TABLE `chair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depreciationofchair`
--
ALTER TABLE `depreciationofchair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `furniture`
--
ALTER TABLE `furniture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD PRIMARY KEY (`entry_id`);

--
-- Indexes for table `ownerequity`
--
ALTER TABLE `ownerequity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicerevenue`
--
ALTER TABLE `servicerevenue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a/r`
--
ALTER TABLE `a/r`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `accumulateddepofchair`
--
ALTER TABLE `accumulateddepofchair`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chair`
--
ALTER TABLE `chair`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `depreciationofchair`
--
ALTER TABLE `depreciationofchair`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `furniture`
--
ALTER TABLE `furniture`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `entry_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ownerequity`
--
ALTER TABLE `ownerequity`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `servicerevenue`
--
ALTER TABLE `servicerevenue`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

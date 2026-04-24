-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 24, 2026 at 05:01 PM
-- Server version: 5.7.44
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tisamidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accessories`
--

CREATE TABLE `tbl_accessories` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset` varchar(45) NOT NULL DEFAULT '',
  `qty` varchar(45) NOT NULL DEFAULT '',
  `lastChanged` datetime DEFAULT NULL,
  `byUser` varchar(45) DEFAULT NULL,
  `colname` varchar(45) NOT NULL DEFAULT '',
  `type` varchar(45) NOT NULL DEFAULT '',
  `country` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_accessories`
--

INSERT INTO `tbl_accessories` (`id`, `asset`, `qty`, `lastChanged`, `byUser`, `colname`, `type`, `country`) VALUES
(1, 'Keyboard', '', NULL, NULL, 'keyboard', 'main', 'PH'),
(2, 'Mouse', '', NULL, NULL, 'mouse', 'main', 'PH'),
(3, 'Charger', '', NULL, NULL, 'charger', 'main', 'PH'),
(4, 'Docking Station', '', NULL, NULL, 'dockingStation', 'main', 'PH'),
(5, 'Bag', '', NULL, NULL, 'bag', 'main', 'PH'),
(6, 'UPS', '', NULL, NULL, 'ups', 'main', 'PH'),
(7, 'Monitor', '', NULL, NULL, 'monitor', 'main', 'PH');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adstatus`
--

CREATE TABLE `tbl_adstatus` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_adstatus`
--

INSERT INTO `tbl_adstatus` (`id`, `status`) VALUES
(1, 'AD Removed'),
(2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicationservice`
--

CREATE TABLE `tbl_applicationservice` (
  `id` int(10) UNSIGNED NOT NULL,
  `applicationName` varchar(100) NOT NULL DEFAULT '',
  `managedBy` varchar(45) NOT NULL DEFAULT '',
  `shortDescription` varchar(50) NOT NULL DEFAULT '',
  `applicationSupplier` varchar(45) NOT NULL DEFAULT '',
  `supportContract` varchar(45) NOT NULL DEFAULT '',
  `contractStartDate` date DEFAULT NULL,
  `contractEndDate` date DEFAULT NULL,
  `authenticationMode` varchar(45) NOT NULL DEFAULT '',
  `applicationType` varchar(50) NOT NULL DEFAULT '',
  `vpn` varchar(45) NOT NULL DEFAULT '',
  `database` varchar(45) NOT NULL DEFAULT '',
  `hosting` varchar(45) NOT NULL DEFAULT '',
  `license` varchar(45) NOT NULL DEFAULT '',
  `link` varchar(80) NOT NULL DEFAULT '',
  `annualCost` varchar(45) NOT NULL DEFAULT '',
  `monthlyCost` varchar(45) NOT NULL DEFAULT '',
  `numberUsers` varchar(45) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `lastChanged` datetime DEFAULT NULL,
  `byUser` varchar(45) NOT NULL DEFAULT '',
  `operationGroup` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assetloan`
--

CREATE TABLE `tbl_assetloan` (
  `id` int(10) UNSIGNED NOT NULL,
  `igg` varchar(45) NOT NULL DEFAULT '',
  `email` varchar(45) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `contactNo` varchar(45) NOT NULL DEFAULT '',
  `asset` varchar(45) NOT NULL DEFAULT '',
  `qty` varchar(45) NOT NULL DEFAULT '',
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `remarks` text NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '',
  `approvedBy` varchar(100) NOT NULL DEFAULT '',
  `approvedDate` datetime DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `lastChanged` datetime DEFAULT NULL,
  `byUser` varchar(100) NOT NULL DEFAULT '',
  `ref_id` varchar(45) NOT NULL DEFAULT '',
  `comments` text NOT NULL,
  `country` varchar(45) NOT NULL DEFAULT '',
  `loanStatus` varchar(45) NOT NULL DEFAULT '',
  `returnRemarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assetloan_assets`
--

CREATE TABLE `tbl_assetloan_assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `asset` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_assetloan_assets`
--

INSERT INTO `tbl_assetloan_assets` (`id`, `asset`) VALUES
(1, 'Projector'),
(2, 'Monitor'),
(3, 'Laptop'),
(4, 'Mobile TV'),
(5, 'Speaker with mic'),
(6, 'Desktop'),
(7, 'Keyboard'),
(8, 'Mouse'),
(9, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assetmain`
--

CREATE TABLE `tbl_assetmain` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(45) NOT NULL DEFAULT '',
  `model` varchar(45) NOT NULL DEFAULT '',
  `assetStatus` varchar(45) NOT NULL DEFAULT '',
  `macAddress` varchar(45) NOT NULL DEFAULT '',
  `serial` varchar(45) NOT NULL DEFAULT '',
  `assetTag` varchar(45) NOT NULL DEFAULT '',
  `computerName` varchar(45) NOT NULL DEFAULT '',
  `assetCondition` varchar(45) NOT NULL DEFAULT '',
  `deliveryDate` date DEFAULT NULL,
  `warranty` varchar(45) NOT NULL DEFAULT '',
  `os` varchar(45) NOT NULL DEFAULT '',
  `assetRemarks` text,
  `byUser` varchar(45) NOT NULL DEFAULT '',
  `datetime` datetime DEFAULT NULL,
  `lastChanged` datetime DEFAULT NULL,
  `brand` varchar(45) NOT NULL DEFAULT '',
  `activeDirectory` varchar(45) NOT NULL DEFAULT '',
  `country` varchar(45) NOT NULL DEFAULT '',
  `osVersion` varchar(40) NOT NULL DEFAULT '',
  `supplier` varchar(32) NOT NULL DEFAULT '',
  `disposalDate` datetime DEFAULT NULL,
  `department` varchar(45) NOT NULL DEFAULT '',
  `recoveryKey` varchar(55) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assetmainlogs`
--

CREATE TABLE `tbl_assetmainlogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `serial` varchar(45) NOT NULL DEFAULT '',
  `assignedTo` varchar(255) NOT NULL DEFAULT '',
  `igg` varchar(45) NOT NULL DEFAULT '',
  `department` varchar(255) NOT NULL DEFAULT '',
  `location` varchar(255) NOT NULL DEFAULT '',
  `bag` varchar(45) NOT NULL DEFAULT 'NO',
  `keyboard` varchar(45) NOT NULL DEFAULT 'NO',
  `mouse` varchar(45) NOT NULL DEFAULT 'NO',
  `ups` varchar(45) NOT NULL DEFAULT 'NO',
  `charger` varchar(45) NOT NULL DEFAULT 'NO',
  `dockingStation` varchar(45) NOT NULL DEFAULT 'NO',
  `monitor1` varchar(45) NOT NULL DEFAULT 'NO',
  `monitor2` varchar(45) NOT NULL DEFAULT 'NO',
  `permanentForms` varchar(255) NOT NULL DEFAULT '',
  `returnForms` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(45) NOT NULL DEFAULT '',
  `remarks` text NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `lastChanged` datetime DEFAULT NULL,
  `byUser` varchar(45) NOT NULL DEFAULT '',
  `country` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assetstatus`
--

CREATE TABLE `tbl_assetstatus` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_assetstatus`
--

INSERT INTO `tbl_assetstatus` (`id`, `status`) VALUES
(1, 'In Use'),
(2, 'In Stock'),
(4, 'In Maintenance'),
(5, 'In Transit'),
(6, 'Missing'),
(7, 'Retired'),
(8, 'Unreturned');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assettype`
--

CREATE TABLE `tbl_assettype` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_assettype`
--

INSERT INTO `tbl_assettype` (`id`, `type`) VALUES
(1, 'Modem'),
(2, 'Patch Panel'),
(3, 'CCTV'),
(4, 'Data Switch'),
(5, 'Deskphone'),
(6, 'Network Port'),
(7, 'Printer'),
(8, 'Server'),
(9, 'Storage'),
(10, 'Storage Server'),
(11, 'Routers'),
(12, 'Flash Drive'),
(13, 'External Hard Drive'),
(14, 'Webcam');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `category`) VALUES
(1, 'Servers'),
(2, 'Network Devices'),
(3, 'External Storage'),
(5, 'Telephony'),
(6, 'Others'),
(8, 'Printers'),
(9, 'Routers');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_condition`
--

CREATE TABLE `tbl_condition` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_condition`
--

INSERT INTO `tbl_condition` (`id`, `type`) VALUES
(1, 'Has Defects'),
(2, 'Working'),
(3, 'Defective'),
(4, 'Available'),
(5, 'Broker'),
(6, 'Donated'),
(7, 'Disposed'),
(8, 'Integration'),
(9, 'Interface'),
(10, 'Lost'),
(11, 'On Loan'),
(12, 'Partially received'),
(13, 'Pending Acceptance'),
(14, 'Pending Disposal'),
(15, 'Pending install'),
(16, 'Pending repair'),
(17, 'Pending Transfer'),
(18, 'Pre-allocated'),
(19, 'Quarantine'),
(20, 'Received'),
(21, 'Site'),
(22, 'Spare'),
(23, 'Stolen'),
(24, 'Supplier'),
(25, 'Vendor Credit');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(10) UNSIGNED NOT NULL,
  `province` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `province`, `country`) VALUES
(1, 'Abra', 'PH'),
(2, 'Agusan del Norte', 'PH'),
(3, 'Agusan del Sur', 'PH'),
(4, 'Aklan', 'PH'),
(5, 'Albay', 'PH'),
(6, 'Antique', 'PH'),
(7, 'Apayao', 'PH'),
(8, 'Aurora', 'PH'),
(9, 'Basilan', 'PH'),
(10, 'Bataan', 'PH'),
(11, 'Batanes', 'PH'),
(12, 'Batangas', 'PH'),
(13, 'Benguet', 'PH'),
(14, 'Biliran', 'PH'),
(15, 'Bohol', 'PH'),
(16, 'Bukidnon', 'PH'),
(17, 'Bulacan', 'PH'),
(18, 'Cagayan', 'PH'),
(19, 'Camarines Norte', 'PH'),
(20, 'Camarines Sur', 'PH'),
(21, 'Camiguin', 'PH'),
(22, 'Capiz', 'PH'),
(23, 'Catanduanes', 'PH'),
(24, 'Cavite', 'PH'),
(25, 'Cebu', 'PH'),
(26, 'Compostela Valley', 'PH'),
(27, 'Cotabato', 'PH'),
(28, 'Davao del Norte', 'PH'),
(29, 'Davao del Sur', 'PH'),
(30, 'Davao Occidental', 'PH'),
(31, 'Davao Oriental', 'PH'),
(32, 'Dinagat Islands', 'PH'),
(33, 'Eastern Samar', 'PH'),
(34, 'Guimaras', 'PH'),
(35, 'Ifugao', 'PH'),
(36, 'Ilocos Norte', 'PH'),
(37, 'Ilocos Sur', 'PH'),
(38, 'Iloilo', 'PH'),
(39, 'Isabela', 'PH'),
(40, 'Kalinga', 'PH'),
(41, 'La Union', 'PH'),
(42, 'Laguna', 'PH'),
(43, 'Lanao del Norte', 'PH'),
(44, 'Lanao del Sur', 'PH'),
(45, 'Leyte', 'PH'),
(46, 'Maguindanao', 'PH'),
(47, 'Marinduque', 'PH'),
(48, 'Masbate', 'PH'),
(49, 'Misamis Occidental', 'PH'),
(50, 'Misamis Oriental', 'PH'),
(51, 'Mountain Province', 'PH'),
(52, 'Negros Occidental', 'PH'),
(53, 'Negros Oriental', 'PH'),
(54, 'Northern Samar', 'PH'),
(55, 'Nueva Ecija', 'PH'),
(56, 'Nueva Vizcaya', 'PH'),
(57, 'Occidental Mindoro', 'PH'),
(58, 'Oriental Mindoro', 'PH'),
(59, 'Palawa', 'PH'),
(60, 'Pampanga', 'PH'),
(61, 'Pangasinan', 'PH'),
(62, 'Quezon', 'PH'),
(63, 'Quirino', 'PH'),
(64, 'Rizal', 'PH'),
(65, 'Romblon', 'PH'),
(66, 'Samar', 'PH'),
(67, 'Sarangani', 'PH'),
(68, 'Siquijor', 'PH'),
(69, 'Sorsogon', 'PH'),
(70, 'South Cotabato', 'PH'),
(71, 'Southern Leyte', 'PH'),
(72, 'Sultan Kudarat', 'PH'),
(73, 'Sulu', 'PH'),
(74, 'Surigao del Norte', 'PH'),
(75, 'Surigao del Sur', 'PH'),
(76, 'Tarlac', 'PH'),
(77, 'Tawi-Tawi', 'PH'),
(78, 'Zambales', 'PH'),
(79, 'Zamboanga del Norte', 'PH'),
(80, 'Zamboanga del Sur', 'PH'),
(81, 'Zamboanga Sibugay', 'PH'),
(82, 'Metro Manila', 'PH'),
(83, 'Hebei Province', 'HK'),
(84, 'Shanxi Province', 'HK'),
(85, 'Liaoning Province', 'HK'),
(86, 'Bacolod', 'PH');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_office`
--

CREATE TABLE `tbl_office` (
  `id` int(10) UNSIGNED NOT NULL,
  `office` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT '',
  `location` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_office`
--

INSERT INTO `tbl_office` (`id`, `office`, `country`, `location`) VALUES
(1, 'BGC', 'PH', 'Pangasinan'),
(2, 'PASIG', 'PH', 'Tarlac'),
(3, 'CEBU', 'PH', 'NCR');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_os`
--

CREATE TABLE `tbl_os` (
  `id` int(10) UNSIGNED NOT NULL,
  `os` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_os`
--

INSERT INTO `tbl_os` (`id`, `os`) VALUES
(1, 'WIN_7'),
(2, 'WIN_10'),
(3, 'WIN_11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `role`) VALUES
(1, 'IT'),
(2, 'user'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscription`
--

CREATE TABLE `tbl_subscription` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscription` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subscription`
--

INSERT INTO `tbl_subscription` (`id`, `subscription`) VALUES
(1, 'NONE'),
(2, 'ONGOING'),
(3, 'TERMINATE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `main` varchar(45) NOT NULL DEFAULT '',
  `mobile` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`id`, `main`, `mobile`) VALUES
(1, 'Laptop', 'MOBILE'),
(2, 'Desktop', 'SIM ONLY'),
(3, 'Monitor', ''),
(4, 'Modem', ''),
(5, 'Patch Panel', ''),
(6, 'CCTV', ''),
(7, 'Data Switch', ''),
(8, 'Deskphone', ''),
(9, 'Network Port', ''),
(10, 'Printer', ''),
(11, 'Server', ''),
(12, 'External Hard Drive', ''),
(13, 'Webcam', ''),
(14, 'Routers', ''),
(15, 'Flash Drive', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(45) NOT NULL DEFAULT '',
  `password` varchar(45) NOT NULL DEFAULT '',
  `role` varchar(45) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `lastChanged` datetime DEFAULT NULL,
  `byUser` varchar(45) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `country` varchar(45) NOT NULL DEFAULT '',
  `icon` varchar(45) NOT NULL DEFAULT '',
  `status` varchar(45) NOT NULL DEFAULT '',
  `datetime` datetime DEFAULT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `login`, `password`, `role`, `name`, `lastChanged`, `byUser`, `email`, `country`, `icon`, `status`, `datetime`, `remarks`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'IT', 'Administrator', '0000-00-00 00:00:00', '', '', 'PH', 'philippines.png', 'active', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accessories`
--
ALTER TABLE `tbl_accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_adstatus`
--
ALTER TABLE `tbl_adstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_applicationservice`
--
ALTER TABLE `tbl_applicationservice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_assetloan`
--
ALTER TABLE `tbl_assetloan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_assetloan_assets`
--
ALTER TABLE `tbl_assetloan_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_assetmain`
--
ALTER TABLE `tbl_assetmain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_assetmainlogs`
--
ALTER TABLE `tbl_assetmainlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_assetstatus`
--
ALTER TABLE `tbl_assetstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_assettype`
--
ALTER TABLE `tbl_assettype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_condition`
--
ALTER TABLE `tbl_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_office`
--
ALTER TABLE `tbl_office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_os`
--
ALTER TABLE `tbl_os`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accessories`
--
ALTER TABLE `tbl_accessories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_adstatus`
--
ALTER TABLE `tbl_adstatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_applicationservice`
--
ALTER TABLE `tbl_applicationservice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_assetloan`
--
ALTER TABLE `tbl_assetloan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_assetloan_assets`
--
ALTER TABLE `tbl_assetloan_assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_assetmain`
--
ALTER TABLE `tbl_assetmain`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3822;

--
-- AUTO_INCREMENT for table `tbl_assetmainlogs`
--
ALTER TABLE `tbl_assetmainlogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5045;

--
-- AUTO_INCREMENT for table `tbl_assetstatus`
--
ALTER TABLE `tbl_assetstatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_assettype`
--
ALTER TABLE `tbl_assettype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_condition`
--
ALTER TABLE `tbl_condition`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `tbl_office`
--
ALTER TABLE `tbl_office`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_os`
--
ALTER TABLE `tbl_os`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_subscription`
--
ALTER TABLE `tbl_subscription`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

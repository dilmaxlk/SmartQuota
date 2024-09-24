-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 25, 2024 at 12:17 AM
-- Server version: 5.7.40-log
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartquota`
--

-- --------------------------------------------------------

--
-- Table structure for table `biz_details`
--

CREATE TABLE `biz_details` (
  `id` int(11) NOT NULL,
  `biz_name` varchar(255) DEFAULT NULL,
  `biz_address` varchar(255) DEFAULT NULL,
  `biz_tel` varchar(50) DEFAULT NULL,
  `biz_hotline` varchar(50) DEFAULT NULL,
  `biz_email` varchar(255) DEFAULT NULL,
  `biz_website` varchar(255) DEFAULT NULL,
  `biz_logo` varchar(255) DEFAULT NULL,
  `biz_payment_details` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `biz_details`
--

INSERT INTO `biz_details` (`id`, `biz_name`, `biz_address`, `biz_tel`, `biz_hotline`, `biz_email`, `biz_website`, `biz_logo`, `biz_payment_details`) VALUES
(1, 'Demo Company', 'No XX XXXXX XXX USA', '011252569545', '0775777128', 'democompany@gmail.com', 'www.google.com', '836510openappzlogo1.png', 'Bank Name: ABC Bank \r\nAccount Name: XXXXXXXXXXX X X X X \r\nAccount Number: XXX XX XX XX XXX \r\nBranch: XXXXX BRANCH  \r\n\r\nBank Name: ABC Bank \r\nAccount Name: XXXXXXXXXXX X X X X \r\nAccount Number: XXX XX XX XX XXX \r\nBranch: XXXXX BRANCH  \r\n\r\nBank Name: ABC Bank \r\nAccount Name: XXXXXXXXXXX X X X X \r\nAccount Number: XXX XX XX XX XXX \r\nBranch: XXXXX BRANCH');

-- --------------------------------------------------------

--
-- Table structure for table `cp_logs`
--

CREATE TABLE `cp_logs` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `logdate` date DEFAULT NULL,
  `logtime` time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_logs`
--

INSERT INTO `cp_logs` (`id`, `userid`, `username`, `logdate`, `logtime`) VALUES
(426, 2, 'admin', '2023-09-12', '17:16:00'),
(427, 2, 'admin', '2023-09-12', '17:40:00'),
(428, 2, 'admin', '2023-09-12', '17:51:00'),
(429, 9730, 'ama', '2023-09-12', '23:17:00'),
(430, 2, 'admin', '2024-07-05', '01:27:00'),
(431, 2, 'admin', '2024-09-18', '20:14:00'),
(432, 2, 'admin', '2024-09-18', '20:24:00'),
(433, 2, 'admin', '2024-09-20', '02:34:00'),
(434, 2, 'admin', '2024-09-20', '02:38:00'),
(435, 2, 'admin', '2024-09-24', '17:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `cp_settings`
--

CREATE TABLE `cp_settings` (
  `setting_id` int(11) NOT NULL,
  `showrecords` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_settings`
--

INSERT INTO `cp_settings` (`setting_id`, `showrecords`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `cp_userpermission`
--

CREATE TABLE `cp_userpermission` (
  `per_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `OnOff` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_userpermission`
--

INSERT INTO `cp_userpermission` (`per_id`, `permission_id`, `uid`, `OnOff`) VALUES
(45, 1127, 2, 1),
(39, 1121, 2, 1),
(41, 1123, 2, 1),
(42, 1124, 2, 1),
(43, 1125, 2, 1),
(63, 1128, 2, 1),
(1928, 1147, 2, 1),
(1927, 1145, 2, 1),
(1926, 1146, 2, 1),
(1925, 1144, 2, 1),
(1924, 1143, 2, 1),
(1923, 1142, 2, 1),
(1922, 1141, 2, 1),
(1921, 1140, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cp_users`
--

CREATE TABLE `cp_users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `sign_id` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cp_users`
--

INSERT INTO `cp_users` (`id`, `username`, `password`, `firstname`, `lastname`, `sign_id`) VALUES
(2, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'System', 'Admin', 'df.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `qas_customer`
--

CREATE TABLE `qas_customer` (
  `id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL DEFAULT '0',
  `cus_address` varchar(255) NOT NULL DEFAULT '0',
  `cus_phone` varchar(255) NOT NULL DEFAULT '0',
  `cus_email` varchar(50) NOT NULL DEFAULT '0',
  `sign_image_id` varchar(255) NOT NULL DEFAULT '0',
  `cus_reg_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qas_customer`
--

INSERT INTO `qas_customer` (`id`, `cus_id`, `cus_name`, `cus_address`, `cus_phone`, `cus_email`, `sign_image_id`, `cus_reg_date`) VALUES
(68, 8335, 'John Mac', 'No 125, xxx xxxx, xxxx USA', '0711234567', 'john_mac123a@gmail.com', 'df.png', '2023-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `qjm_quotations`
--

CREATE TABLE `qjm_quotations` (
  `quo_id` int(11) NOT NULL,
  `quo_customer_id` int(11) DEFAULT NULL,
  `quo_subject` varchar(200) DEFAULT NULL,
  `quo_date_created` date DEFAULT NULL,
  `quo_stage` varchar(50) DEFAULT NULL,
  `quo_valid_untill` date DEFAULT NULL,
  `quo_proposal_text` longtext,
  `quo_customer_notes` longtext,
  `quo_admin_notes` longtext,
  `quo_tax_rate` double DEFAULT NULL,
  `quo_tax_rate_des` varchar(255) DEFAULT NULL,
  `quo_othercost` double DEFAULT NULL,
  `quo_othercost_des` varchar(255) DEFAULT NULL,
  `quo_invoice_id` int(11) NOT NULL,
  `quo_invoice_date` date DEFAULT NULL,
  `quo_payment_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qjm_quotations`
--

INSERT INTO `qjm_quotations` (`quo_id`, `quo_customer_id`, `quo_subject`, `quo_date_created`, `quo_stage`, `quo_valid_untill`, `quo_proposal_text`, `quo_customer_notes`, `quo_admin_notes`, `quo_tax_rate`, `quo_tax_rate_des`, `quo_othercost`, `quo_othercost_des`, `quo_invoice_id`, `quo_invoice_date`, `quo_payment_status`) VALUES
(7603, 8335, 'Qutotation for Fix a Roller Door', '2023-07-29', 'Delivered', '2023-08-12', '>> Aliquam vel massa sed purus elementum ornare. \r\n>> Praesent tincidunt non nisi in lacinia. \r\n>> Phasellus mattis sollicitudin erat sit amet suscipit. \r\nMaecenas eu ornare augue, eu consectetur risus. Pellentesque eget porta magna. Fusce ut turpis velit. Ut tincidunt nisi eu dui maximus, non elementum ex finibus. Pellentesque lorem diam, tristique id sem et, faucibus dictum leo. Suspendisse potenti. Vivamus sed dignissim eros.', 'Aliquam vel massa sed purus elementum ornare. Praesent tincidunt non nisi in lacinia. Phasellus mattis sollicitudin erat sit amet suscipit. Maecenas eu ornare augue, eu consectetur risus. Pellentesque eget porta magna. Fusce ut turpis velit. Ut tincidunt nisi eu dui maximus, non elementum ex finibus. Pellentesque lorem diam, tristique id sem et, faucibus dictum leo. Suspendisse potenti. Vivamus sed dignissim eros.', 'Aliquam vel massa sed purus elementum ornare. Praesent tincidunt non nisi in lacinia. Phasellus mattis sollicitudin erat sit amet suscipit. Maecenas eu ornare augue, eu consectetur risus. Pellentesque eget porta magna. Fusce ut turpis velit. Ut tincidunt nisi eu dui maximus, non elementum ex finibus. Pellentesque lorem diam, tristique id sem et, faucibus dictum leo. Suspendisse potenti. Vivamus sed dignissim eros.', 10.5, 'VAT', 2000, 'Transport Cost', 11755, '2023-08-21', 'Invoice Paid');

-- --------------------------------------------------------

--
-- Table structure for table `qjm_quotation_Items`
--

CREATE TABLE `qjm_quotation_Items` (
  `quo_item_id` int(11) NOT NULL,
  `quo_quotation_id` int(11) DEFAULT NULL,
  `quo_item_description` varchar(200) DEFAULT NULL,
  `quo_item_qty` decimal(11,0) DEFAULT NULL,
  `quo_item_unit_price` int(11) DEFAULT NULL,
  `quo_item_discount` double DEFAULT NULL,
  `quo_item_total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qjm_quotation_Items`
--

INSERT INTO `qjm_quotation_Items` (`quo_item_id`, `quo_quotation_id`, `quo_item_description`, `quo_item_qty`, `quo_item_unit_price`, `quo_item_discount`, `quo_item_total`) VALUES
(11, 7603, 'item0111', 50, 100, 5, 4750),
(12, 7603, 'Item02222', 5, 100, 2, 490),
(13, 7603, 'Item03333', 500, 5, 5, 2375),
(14, 7603, 'item04', 100, 10, 10, 900),
(264, 7603, 'item05', 100, 10, 10, 900),
(289, 5961, 'aaa', 100, 50, 10, 4500),
(290, 5961, 'bbb', 50, 100, 0, 5000),
(291, 5961, 'ccc', 50, 500, 10, 22500),
(313, 7603, 'item06', 10, 250, 10, 2250);

-- --------------------------------------------------------

--
-- Table structure for table `quota_jobs`
--

CREATE TABLE `quota_jobs` (
  `id` int(11) NOT NULL,
  `job_no` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `job_Name` varchar(500) DEFAULT NULL,
  `job_location` varchar(1000) DEFAULT NULL,
  `job_date` date DEFAULT NULL,
  `job_start_time` varchar(50) DEFAULT NULL,
  `job_end_time` varchar(50) DEFAULT NULL,
  `job_details` varchar(2000) DEFAULT NULL,
  `job_employee_details` varchar(2000) DEFAULT NULL,
  `materials_required` varchar(2000) DEFAULT NULL,
  `tools_required` varchar(2000) DEFAULT NULL,
  `special_instructions` varchar(2000) DEFAULT NULL,
  `payment_instructions` varchar(50) DEFAULT NULL,
  `job_status` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quota_jobs`
--

INSERT INTO `quota_jobs` (`id`, `job_no`, `customer_id`, `quotation_id`, `job_Name`, `job_location`, `job_date`, `job_start_time`, `job_end_time`, `job_details`, `job_employee_details`, `materials_required`, `tools_required`, `special_instructions`, `payment_instructions`, `job_status`) VALUES
(10, 9143, 8335, 7603, 'Computer Fix ', 'Kalutara home', '2023-08-17', '10.30AM', '2.00 PM', 'Integer dapibus aliquet massa, in posuere libero congue vitae. Proin purus est, finibus id dapibus id, luctus sed nibh. Aliquam varius vitae ante nec interdum. ', '>> Emp 01\r\n>> Emp 02\r\n>> Emp 03\r\n>> Emp 04', '>> M1\r\n>> M 2\r\n>> M1\r\n>> M 2\r\n>> M1\r\n>> M 2\r\n>> M1\r\n>> M 2', '>> Tools\r\n>> aaaaa\r\n>> bbbbv\r\n>> aaaaa\r\n>> bbbbv\r\n>> aaaaa\r\n>> bbbbv', 'Integer dapibus aliquet massa, in posuere libero congue vitae. Proin purus est, finibus id dapibus id, luctus sed nibh. Aliquam varius vitae ante nec interdum. ', 'Invoice Fully Paid', 'Completed'),
(12, 5846, 8335, 7603, 'Demo JOB', 'Kalutara', '2023-08-30', '10', '11', 'Job Details', 'Job Employee Details\r\n', 'Job Materials Required', 'Job Tools Required', 'Special Instructions\r\n', 'Invoice Fully Paid', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biz_details`
--
ALTER TABLE `biz_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_logs`
--
ALTER TABLE `cp_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_settings`
--
ALTER TABLE `cp_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `cp_userpermission`
--
ALTER TABLE `cp_userpermission`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `cp_users`
--
ALTER TABLE `cp_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qas_customer`
--
ALTER TABLE `qas_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qjm_quotations`
--
ALTER TABLE `qjm_quotations`
  ADD PRIMARY KEY (`quo_id`);

--
-- Indexes for table `qjm_quotation_Items`
--
ALTER TABLE `qjm_quotation_Items`
  ADD PRIMARY KEY (`quo_item_id`);

--
-- Indexes for table `quota_jobs`
--
ALTER TABLE `quota_jobs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biz_details`
--
ALTER TABLE `biz_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cp_logs`
--
ALTER TABLE `cp_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT for table `cp_settings`
--
ALTER TABLE `cp_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cp_userpermission`
--
ALTER TABLE `cp_userpermission`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1999;

--
-- AUTO_INCREMENT for table `cp_users`
--
ALTER TABLE `cp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9934;

--
-- AUTO_INCREMENT for table `qas_customer`
--
ALTER TABLE `qas_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `qjm_quotations`
--
ALTER TABLE `qjm_quotations`
  MODIFY `quo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7604;

--
-- AUTO_INCREMENT for table `qjm_quotation_Items`
--
ALTER TABLE `qjm_quotation_Items`
  MODIFY `quo_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=314;

--
-- AUTO_INCREMENT for table `quota_jobs`
--
ALTER TABLE `quota_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

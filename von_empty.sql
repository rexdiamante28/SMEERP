-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2019 at 03:38 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `von_empty`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(150) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `address`, `status`) VALUES
(1, 'Main Branch', 'Valenzuela', 1),
(2, 'Branch 1', 'BGC, Taguig', 1),
(3, 'Branch 2', 'Quiapo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_code` varchar(45) DEFAULT NULL,
  `has_unique_identifier` tinyint(4) NOT NULL,
  `bar_code` varchar(150) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `generic_name` varchar(100) DEFAULT NULL,
  `item_description` text,
  `item_image` varchar(150) DEFAULT NULL,
  `item_category` int(11) DEFAULT NULL,
  `item_unit` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_code`, `has_unique_identifier`, `bar_code`, `item_name`, `generic_name`, `item_description`, `item_image`, `item_category`, `item_unit`, `status`, `price`) VALUES
(1, 'SMSNGS8', 1, '86876786', 'Samsung S8', 'Smart Phone', '', 's82.jpg', 2, 1, 1, '28000.00'),
(2, 'SMSNGS8JLLY', 0, '675765765', 'S8 Jelly Case', 'Jelly Case', '', 's8_jelly.jpg', 3, 1, 1, '200.00');

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(45) DEFAULT NULL,
  `parent_category` int(11) DEFAULT NULL,
  `category_string` text,
  `sequence_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `category`, `parent_category`, `category_string`, `sequence_number`) VALUES
(2, 'Gadget', 0, 'Gadget', 2),
(3, 'Gadget Accessories', 0, 'Gadget Accessories', 2);

-- --------------------------------------------------------

--
-- Table structure for table `item_movements`
--

CREATE TABLE `item_movements` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL COMMENT '1 Inbound\n2 Outbound\n3 Orders\n4 Damages\n5 Quaratine',
  `date` date DEFAULT NULL,
  `internal_notes` text,
  `facilitator` int(11) DEFAULT NULL,
  `encoder` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL COMMENT '1 draft\n2. Reviewed\n3. Approved\n4. Closed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_movements`
--

INSERT INTO `item_movements` (`id`, `branch_id`, `code`, `type`, `date`, `internal_notes`, `facilitator`, `encoder`, `status`) VALUES
(1, 1, 'INBND-123231', 'Inbound', '2019-06-05', '', 1, 1, 'Approved'),
(2, 1, 'INBND-90909', 'Inbound', '2019-06-06', '', 1, 1, 'Approved'),
(3, 1, 'OUTB-i78777u7', 'Outbound', '2019-06-05', '', 1, 1, 'Approved'),
(4, 2, 'INBND-787987', 'Inbound', '2019-06-05', '', 1, 1, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `item_movement_items`
--

CREATE TABLE `item_movement_items` (
  `id` int(11) NOT NULL,
  `item_movement_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `selling_price` double NOT NULL,
  `quantity` float DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `remarks` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_movement_items`
--

INSERT INTO `item_movement_items` (`id`, `item_movement_id`, `item_id`, `price`, `selling_price`, `quantity`, `stock`, `remarks`) VALUES
(4, 2, 2, 230, 270, 5, 3, ''),
(5, 3, 1, 0, 0, 2, 2, ''),
(6, 3, 2, 0, 0, 2, 2, ''),
(3, 2, 1, 30000, 35000, 5, 2, ''),
(2, 1, 2, 200, 250, 5, 0, ''),
(1, 1, 1, 28000, 34000, 5, 2, ''),
(7, 4, 1, 28000, 32000, 2, 1, ''),
(8, 4, 2, 200, 250, 2, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `item_unique_identifiers`
--

CREATE TABLE `item_unique_identifiers` (
  `id` int(11) NOT NULL,
  `item_movement_items_id` int(11) NOT NULL,
  `identifier` varchar(150) NOT NULL,
  `available` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_unique_identifiers`
--

INSERT INTO `item_unique_identifiers` (`id`, `item_movement_items_id`, `identifier`, `available`) VALUES
(92, 1, '12321312', 2),
(93, 1, '12313123', 2),
(94, 1, '23423432', 1),
(95, 1, '34345455', 2),
(96, 1, '23423434', 1),
(97, 3, '234234434', 1),
(98, 3, '123123123', 2),
(99, 3, '123123122', 1),
(100, 3, '213123123', 6),
(101, 3, '234343545', 6),
(102, 5, '213123123', 4),
(103, 5, '234343545', 4),
(104, 7, '213123123', 1),
(105, 7, '234343545', 2);

-- --------------------------------------------------------

--
-- Table structure for table `item_units`
--

CREATE TABLE `item_units` (
  `id` int(11) NOT NULL,
  `unit` varchar(45) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_units`
--

INSERT INTO `item_units` (`id`, `unit`, `description`) VALUES
(1, 'Piece', 'Piece'),
(2, 'Kilo/s', '');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification` varchar(150) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `checked` tinyint(4) DEFAULT NULL,
  `important` tinyint(4) DEFAULT NULL,
  `user_id_from` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `notification`, `date`, `checked`, `important`, `user_id_from`) VALUES
(400, 1, 'Juan Cruz Logged out. ', '2019-06-05 17:28:51', 0, NULL, NULL),
(398, 1, 'test ser Logged out. ', '2019-06-05 17:08:16', 0, NULL, NULL),
(399, 1, 'Juan Cruz logged in. ', '2019-06-05 17:08:18', 0, NULL, NULL),
(397, 1, 'test ser logged in. ', '2019-06-05 17:04:30', 0, NULL, NULL),
(396, 1, 'Juan Cruz Logged out. ', '2019-06-05 17:04:20', 0, NULL, NULL),
(394, 1, 'Juan Cruz sold new items with or number  00000006. ', '2019-06-05 16:53:32', 0, NULL, NULL),
(395, 1, 'S8 Jelly Case of Main Branch is running out. Only  Piece/s remaining.', '2019-06-05 16:53:32', 0, NULL, NULL),
(393, 1, 'Juan Cruz sold new items with or number  00000006. ', '2019-06-05 16:53:32', 0, NULL, NULL),
(392, 1, 'Juan Cruz sold new items with or number  00000005. ', '2019-06-05 16:48:56', 0, NULL, NULL),
(391, 1, 'Juan Cruz sold new items with or number  00000005. ', '2019-06-05 16:48:56', 0, NULL, NULL),
(390, 1, 'Juan Cruz added new item movement with reference code INBND-787987. ', '2019-06-05 16:45:30', 0, NULL, NULL),
(389, 1, 'Juan Cruz added new item movement with reference code INBND-787987. ', '2019-06-05 16:45:30', 0, NULL, NULL),
(388, 1, 'Juan Cruz added new item movement with reference code OUTB-i78777u7. ', '2019-06-05 16:43:23', 0, NULL, NULL),
(387, 1, 'Juan Cruz added new item movement with reference code OUTB-i78777u7. ', '2019-06-05 16:43:23', 0, NULL, NULL),
(386, 1, 'Samsung S8 of Main Branch is running out. Only  Piece/s remaining.', '2019-06-05 16:33:41', 0, NULL, NULL),
(385, 1, 'S8 Jelly Case of Main Branch is running out. Only  Piece/s remaining.', '2019-06-05 16:33:41', 0, NULL, NULL),
(384, 1, 'Juan Cruz sold new items with or number  00000004. ', '2019-06-05 16:33:41', 0, NULL, NULL),
(383, 1, 'Juan Cruz sold new items with or number  00000004. ', '2019-06-05 16:33:41', 0, NULL, NULL),
(382, 1, 'Samsung S8 of Main Branch is running out. Only  Piece/s remaining.', '2019-06-05 16:32:16', 0, NULL, NULL),
(381, 1, 'S8 Jelly Case of Main Branch is running out. Only  Piece/s remaining.', '2019-06-05 16:32:15', 0, NULL, NULL),
(380, 1, 'Juan Cruz sold new items with or number  00000003. ', '2019-06-05 16:32:15', 0, NULL, NULL),
(379, 1, 'Juan Cruz sold new items with or number  00000003. ', '2019-06-05 16:32:15', 0, NULL, NULL),
(378, 1, 'Juan Cruz added new item movement with reference code INBND-90909. ', '2019-06-05 16:25:00', 0, NULL, NULL),
(377, 1, 'Juan Cruz added new item movement with reference code INBND-90909. ', '2019-06-05 16:25:00', 0, NULL, NULL),
(376, 1, 'Samsung S8 of Main Branch is running out. Only  Piece/s remaining.', '2019-06-05 15:42:53', 0, NULL, NULL),
(375, 1, 'S8 Jelly Case of Main Branch is running out. Only  Piece/s remaining.', '2019-06-05 15:42:53', 0, NULL, NULL),
(374, 1, 'Juan Cruz sold new items with or number  00000002. ', '2019-06-05 15:42:53', 0, NULL, NULL),
(373, 1, 'Juan Cruz sold new items with or number  00000002. ', '2019-06-05 15:42:53', 0, NULL, NULL),
(372, 1, 'Samsung S8 of Main Branch is running out. Only  Piece/s remaining.', '2019-06-05 15:28:52', 0, NULL, NULL),
(371, 1, 'S8 Jelly Case of Main Branch is running out. Only  Piece/s remaining.', '2019-06-05 15:28:52', 0, NULL, NULL),
(370, 1, 'Juan Cruz sold new items with or number  00000001. ', '2019-06-05 15:28:52', 0, NULL, NULL),
(369, 1, 'Juan Cruz sold new items with or number  00000001. ', '2019-06-05 15:28:52', 0, NULL, NULL),
(368, 1, 'S8 Jelly Case of Main Branch is running out. Only  Piece/s remaining.', '2019-06-05 15:21:34', 0, NULL, NULL),
(367, 1, 'Juan Cruz changed S8 Jelly Case\'s minimum and maximun stock threshold. \r\n		4 and 10 respectively.', '2019-06-05 15:21:34', 0, NULL, NULL),
(366, 1, 'Juan Cruz changed S8 Jelly Case\'s minimum and maximun stock threshold. \r\n		4 and 10 respectively.', '2019-06-05 15:21:34', 0, NULL, NULL),
(365, 1, 'Samsung S8 of Main Branch is running out. Only  Piece/s remaining.', '2019-06-05 15:21:19', 0, NULL, NULL),
(364, 1, 'Juan Cruz changed Samsung S8\'s minimum and maximun stock threshold. \r\n		3 and 10 respectively.', '2019-06-05 15:21:19', 0, NULL, NULL),
(363, 1, 'Juan Cruz changed Samsung S8\'s minimum and maximun stock threshold. \r\n		3 and 10 respectively.', '2019-06-05 15:21:19', 0, NULL, NULL),
(362, 1, 'Juan Cruz added new item movement with reference code INBND-123231. ', '2019-06-05 15:10:05', 0, NULL, NULL),
(361, 1, 'Juan Cruz added new item movement with reference code INBND-123231. ', '2019-06-05 15:10:05', 0, NULL, NULL),
(360, 1, 'Juan Cruz logged in. ', '2019-06-05 15:02:34', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `terminal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `storage_locations`
--

CREATE TABLE `storage_locations` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storage_locations`
--

INSERT INTO `storage_locations` (`id`, `branch_id`, `name`, `description`) VALUES
(1, 1, 'Main Storage Room', ''),
(2, 2, 'B1 Storage Room', ''),
(3, 3, 'B2 Storage Room', '');

-- --------------------------------------------------------

--
-- Table structure for table `store_items`
--

CREATE TABLE `store_items` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `threshold_min` decimal(11,2) DEFAULT NULL,
  `threshold_max` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store_items`
--

INSERT INTO `store_items` (`id`, `item_id`, `branch_id`, `stock`, `threshold_min`, `threshold_max`) VALUES
(1, 1, 1, NULL, '3.00', '10.00'),
(2, 2, 1, NULL, '4.00', '10.00'),
(3, 1, 2, NULL, NULL, NULL),
(4, 2, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `temp_orders`
--

CREATE TABLE `temp_orders` (
  `id` int(11) NOT NULL,
  `terminal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_movement_item_id` int(11) DEFAULT NULL,
  `unique_id` varchar(100) NOT NULL,
  `vat` decimal(11,2) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `quantity` decimal(11,2) DEFAULT NULL,
  `discount` decimal(11,2) DEFAULT NULL,
  `row_total` decimal(11,2) DEFAULT NULL,
  `row_total_discount` decimal(11,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `terminals`
--

CREATE TABLE `terminals` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `terminal_code` varchar(45) DEFAULT NULL,
  `terminal_number` int(11) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terminals`
--

INSERT INTO `terminals` (`id`, `branch_id`, `terminal_code`, `terminal_number`, `status`) VALUES
(2, 2, 'B101', 1, 'Inactive'),
(1, 1, 'MB01', 1, 'Inactive'),
(3, 3, 'B201', 1, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `terminal_id` int(11) DEFAULT NULL,
  `or_number` varchar(45) DEFAULT NULL,
  `total` decimal(11,2) DEFAULT NULL,
  `amount_due` decimal(11,2) DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `tax` decimal(11,2) DEFAULT NULL,
  `payment_change` decimal(11,2) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `capital` double DEFAULT NULL,
  `revenue` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `terminal_id`, `or_number`, `total`, `amount_due`, `balance`, `due_date`, `remarks`, `tax`, `payment_change`, `date_time`, `capital`, `revenue`) VALUES
(1, 1, 1, '00000001', '32000.00', '32000.00', 0, '2019-06-06', 'HOME CREDIT', '3840.00', '0.00', '2019-06-05 15:28:52', 28200, 4050),
(2, 1, 1, '00000002', '32000.00', '32000.00', 0, '0000-00-00', '', '3840.00', '0.00', '2019-06-05 15:42:53', 28200, 3800),
(3, 1, 1, '00000003', '35000.00', '35000.00', 0, '0000-00-00', '', '4200.00', '0.00', '2019-06-05 16:32:15', 30200, 4800),
(4, 1, 1, '00000004', '32000.00', '32000.00', 0, '2019-06-06', 'HOME CREDIT', '3840.00', '0.00', '2019-06-05 16:33:41', 28200, 3800),
(5, 1, 2, '00000005', '32250.00', '33000.00', 0, '0000-00-00', '', '3870.00', '750.00', '2019-06-05 16:48:56', 28200, 4050),
(6, 1, 1, '00000006', '270.00', '500.00', 0, '0000-00-00', 'BUY BACK', '32.40', '230.00', '2019-06-05 16:53:31', 230, 40);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `item_movement_item_id` int(11) DEFAULT NULL,
  `unique_id` varchar(100) NOT NULL,
  `vat` decimal(11,2) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `quantity` decimal(11,2) DEFAULT NULL,
  `discount` decimal(11,2) DEFAULT NULL,
  `row_total` decimal(11,2) DEFAULT NULL,
  `row_total_discount` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `item_movement_item_id`, `unique_id`, `vat`, `price`, `quantity`, `discount`, `row_total`, `row_total_discount`) VALUES
(1, 1, 4, '', '12.00', '150.00', '1.00', '0.00', '150.00', '0.00'),
(2, 2, 4, '', '12.00', '150.00', '1.00', '0.00', '150.00', '0.00'),
(3, 3, 4, '', '12.00', '150.00', '1.00', '0.00', '150.00', '0.00'),
(4, 7, 4, '', '12.00', '150.00', '1.00', '0.00', '150.00', '0.00'),
(5, 8, 1, '234', '12.00', '32000.00', '1.00', '0.00', '32000.00', '0.00'),
(6, 8, 4, '', '12.00', '150.00', '1.00', '100.00', '0.00', '150.00'),
(7, 9, 4, '', '12.00', '150.00', '1.00', '100.00', '0.00', '150.00'),
(8, 9, 2, '2345', '12.00', '33000.00', '1.00', '0.00', '33000.00', '0.00'),
(9, 10, 4, '', '12.00', '150.00', '1.00', '0.00', '150.00', '0.00'),
(10, 11, 4, '', '12.00', '150.00', '1.00', '0.00', '150.00', '0.00'),
(11, 12, 4, '', '12.00', '150.00', '1.00', '0.00', '150.00', '0.00'),
(12, 1, 2, '', '12.00', '250.00', '1.00', '100.00', '0.00', '250.00'),
(13, 1, 1, '12321312', '12.00', '32000.00', '1.00', '0.00', '32000.00', '0.00'),
(14, 2, 2, '', '12.00', '250.00', '1.00', '100.00', '0.00', '250.00'),
(15, 2, 1, '12313123', '12.00', '32000.00', '1.00', '0.00', '32000.00', '0.00'),
(16, 3, 2, '', '12.00', '250.00', '1.00', '100.00', '0.00', '250.00'),
(17, 3, 3, '123123123', '12.00', '35000.00', '1.00', '0.00', '35000.00', '0.00'),
(18, 4, 2, '', '12.00', '250.00', '1.00', '100.00', '0.00', '250.00'),
(19, 4, 1, '34345455', '12.00', '32000.00', '1.00', '0.00', '32000.00', '0.00'),
(20, 5, 8, '', '12.00', '250.00', '1.00', '0.00', '250.00', '0.00'),
(21, 5, 7, '234343545', '12.00', '32000.00', '1.00', '0.00', '32000.00', '0.00'),
(22, 6, 4, '', '12.00', '270.00', '1.00', '0.00', '270.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `telephone_number` varchar(20) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `avatar` varchar(150) DEFAULT NULL,
  `branches` text,
  `functions` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `telephone_number`, `mobile_number`, `email_address`, `status`, `last_login`, `avatar`, `branches`, `functions`) VALUES
(1, 'admin', '$2y$12$XFKllrdjuXdincQ7csCiLOtlgCXX8KwVB5Zw63DcXJpmrnXqT0aEG', 'Juan', 'Dela', 'Cruz', '', '', 'jdc@gmail.com', 1, NULL, 'balmes.jpg', '1,2,3,4', 'Manage Users,Manage Branches,Manage Locations,Manage Items,Manage Stocks,Sell Items,View Reports,Notification Sales,Notification Inventory,Notification Users,Notification Items'),
(2, 'testuser', '$2y$12$XFKllrdjuXdincQ7csCiLOtlgCXX8KwVB5Zw63DcXJpmrnXqT0aEG', 'test', 'u', 'ser', '', '09985962156', 'test@gmail.com', 1, NULL, '0-02-08-6e064d73008eff9b29ee315f3149cad7da6d116e358b050ab885b50bdddce2e6_full.jpg', '1', 'Sell Items,Notification Sales,Notification Inventory');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_items_item_units_idx` (`item_unit`),
  ADD KEY `fk_items_item_category_idx` (`item_category`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_movements`
--
ALTER TABLE `item_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_branches_item_movement_idx` (`branch_id`);

--
-- Indexes for table `item_movement_items`
--
ALTER TABLE `item_movement_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_unique_identifiers`
--
ALTER TABLE `item_unique_identifiers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_units`
--
ALTER TABLE `item_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage_locations`
--
ALTER TABLE `storage_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_branches_storage_locations_idx` (`branch_id`);

--
-- Indexes for table `store_items`
--
ALTER TABLE `store_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_items_store_items_idx` (`item_id`),
  ADD KEY `fk_items_branch_idx` (`branch_id`);

--
-- Indexes for table `temp_orders`
--
ALTER TABLE `temp_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terminals`
--
ALTER TABLE `terminals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_branches_terminals_idx` (`branch_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transaction_users_idx` (`user_id`),
  ADD KEY `fk_transaction_terminal_idx` (`terminal_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_movement_items`
--
ALTER TABLE `item_movement_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item_unique_identifiers`
--
ALTER TABLE `item_unique_identifiers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_item_category` FOREIGN KEY (`item_category`) REFERENCES `item_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_items_item_units` FOREIGN KEY (`item_unit`) REFERENCES `item_units` (`id`);

--
-- Constraints for table `item_movements`
--
ALTER TABLE `item_movements`
  ADD CONSTRAINT `fk_branches_item_movement` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `storage_locations`
--
ALTER TABLE `storage_locations`
  ADD CONSTRAINT `fk_branches_storage_locations` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `store_items`
--
ALTER TABLE `store_items`
  ADD CONSTRAINT `fk_items_branch` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_items_store_items` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transaction_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

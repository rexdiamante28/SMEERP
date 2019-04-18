-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2019 at 04:57 PM
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
-- Database: `smerp`
--

-- --------------------------------------------------------

--
-- Table structure for table `erp_companies`
--

CREATE TABLE `erp_companies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `industry` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `erp_companies`
--

INSERT INTO `erp_companies` (`id`, `name`, `description`, `industry`, `created`, `updated`, `status`) VALUES
(1, 'VSY Elecronic Shop', 'lsdj flkjsd lfkjdslfjsdfj;lsdkfsdkfl;dsk', 1, '2019-04-13 00:00:00', '2019-04-18 12:02:04', 0),
(2, 'New life Construction Supplies', 'lsdjf lsdjlk dsljfdsjfdsf', 2, '2019-04-20 00:00:00', '2019-04-18 21:56:16', 1),
(3, 'ksjdfhdskhf kj', 'khkjsdhfksdhfjkdsh', 1, '2019-04-14 15:02:53', '2019-04-14 15:02:53', 0),
(4, 'sdkfjsdkfjlkj', 'lkjldsjflkdsjflkj', 1, '2019-04-14 15:04:24', '2019-04-14 15:04:24', 0),
(5, 'sdfkjsdfjdsh', 'jkhkjhjk', 1, '2019-04-14 15:11:56', '2019-04-14 15:11:56', 0),
(6, 'lkkfdlskdjlk', 'jlkjlkj', 1, '2019-04-14 15:12:21', '2019-04-14 15:12:21', 0),
(7, 'kdfjgkjdfkj', 'hkjhkjhkjh', 1, '2019-04-14 15:13:40', '2019-04-14 15:13:40', 0),
(8, '7832648ks dfjh skdjf sjdfhljkh', 'kjh lksjf skh ksjh', 2, '2019-04-14 15:40:16', '2019-04-14 15:40:16', 0),
(9, 'ksjdjfhksjdhfkjdshf kdshfkjh', 'kjh kjhkjh', 1, '2019-04-14 15:48:31', '2019-04-14 16:02:17', 0),
(10, 'kjdfhgjkhkjh', 'jkkjhjkh', 1, '2019-04-14 16:06:22', '2019-04-14 16:06:25', 0),
(11, 'VSY Elecronic Shop 1', 'ldslhf lsdkf kdsh', 1, '2019-04-14 16:06:53', '2019-04-14 16:06:53', 0),
(12, 'Cloud Panda PH Inc.', 'sdfsd fsdfs dfdsf dsf', 2, '2019-04-15 10:09:30', '2019-04-15 10:09:30', 0),
(13, 'Cloud Panda PH Inc. d', ',kdsjfksf', 1, '2019-04-17 12:04:38', '2019-04-17 12:04:38', 0),
(14, 'wertrwtwertwer', 'twertwert', 1, '2019-04-17 16:38:20', '2019-04-17 16:38:20', 0),
(15, 'sdkjjfhdskjh', 'kjhkjh', 0, '2019-04-18 22:36:07', '2019-04-18 22:36:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `erp_industries`
--

CREATE TABLE `erp_industries` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `erp_industries`
--

INSERT INTO `erp_industries` (`id`, `name`, `description`, `created`, `updated`, `status`) VALUES
(1, 'Electronic', 'sdlfkjsdfljdslkfj', '2019-04-13 00:00:00', '2019-04-18 22:47:23', 1),
(2, 'Gen Merchandise', 'sdl;fk s;ldkf;lsdf;kdsf;dslkf', '2019-04-13 00:00:00', '2019-04-18 22:47:30', 1),
(3, 'lkjkjl', 'kjlkjlkjlkj', '2019-04-18 22:36:34', '2019-04-18 22:36:34', 0),
(4, 'sdlkfjlksfjl', 'jlkj', '2019-04-18 22:37:02', '2019-04-18 22:37:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sys_captcha`
--

CREATE TABLE `sys_captcha` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL,
  `filename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sys_users`
--

CREATE TABLE `sys_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL COMMENT 'email address',
  `password` varchar(100) NOT NULL,
  `avatar` varchar(150) NOT NULL,
  `functions` text,
  `last_seen` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `failed_login_attempts` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_users`
--

INSERT INTO `sys_users` (`id`, `username`, `password`, `avatar`, `functions`, `last_seen`, `active`, `failed_login_attempts`) VALUES
(10, 'root', '$2y$12$cviW0ibgFMd6A.wz/lc6Ju.dcg1zirPstVVNkr3od29jlb8j/fQVi', 'blank_avatar.png', '{\"overall_access\": 1}\r\n', NULL, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `erp_companies`
--
ALTER TABLE `erp_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `erp_industries`
--
ALTER TABLE `erp_industries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_captcha`
--
ALTER TABLE `sys_captcha`
  ADD PRIMARY KEY (`captcha_id`),
  ADD KEY `word` (`word`);

--
-- Indexes for table `sys_users`
--
ALTER TABLE `sys_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `erp_companies`
--
ALTER TABLE `erp_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `erp_industries`
--
ALTER TABLE `erp_industries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sys_captcha`
--
ALTER TABLE `sys_captcha`
  MODIFY `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sys_users`
--
ALTER TABLE `sys_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

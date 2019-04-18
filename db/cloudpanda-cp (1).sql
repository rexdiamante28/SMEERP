-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2019 at 03:53 PM
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
-- Database: `cloudpanda-cp`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_projects`
--

CREATE TABLE `app_projects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `project_status` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_projects`
--

INSERT INTO `app_projects` (`id`, `name`, `description`, `project_status`, `created`, `updated`, `status`) VALUES
(1, 'llda', 'sdfjdf lksdf', 1, '2019-03-02 00:00:00', '2019-03-03 02:33:33', 0),
(2, 'Paypanda', 'Payment Portal Yeah', 1, '2019-03-02 22:14:50', '2019-03-03 03:11:43', 1),
(3, 'sdflks', 'lkjlkjlkj', 1, '2019-03-02 22:23:17', '2019-03-02 22:23:17', 0),
(4, 'dshfkjdsfh', 'jhjkhkjh', 1, '2019-03-03 02:28:28', '2019-03-03 02:28:28', 0),
(5, 'sdjjfhhsdg', 'jhgjhgjhg', 1, '2019-03-03 02:44:49', '2019-03-03 02:44:49', 0);

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

--
-- Dumping data for table `sys_captcha`
--

INSERT INTO `sys_captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`, `filename`) VALUES
(173, 1535433897, '::1', 'sw9c56', '1535433896.7995.jpg'),
(174, 1535433931, '::1', 'wjGmoN', '1535433931.2492.jpg'),
(175, 1535434030, '::1', 'pUIuXf', '1535434030.497.jpg'),
(176, 1535434191, '::1', '99te9v', '1535434191.223.jpg'),
(177, 1535434257, '::1', 'SVyFCQ', '1535434256.5161.jpg'),
(178, 1535434800, '::1', 'cyn1at', '1535434800.2868.jpg'),
(179, 1535434806, '::1', 'dOxxBO', '1535434806.286.jpg'),
(180, 1535434808, '::1', '4Epchq', '1535434808.0074.jpg'),
(181, 1535434903, '::1', 'egkecn', '1535434902.8149.jpg'),
(182, 1535438009, '::1', '25aggz', '1535438008.8611.jpg'),
(183, 1535438153, '::1', '8mm7rl', '1535438153.4002.jpg'),
(184, 1535438164, '::1', 'enab3f', '1535438163.5324.jpg'),
(185, 1535438167, '::1', 'xx7dax', '1535438167.1524.jpg'),
(186, 1535438202, '::1', 'wjq5ix', '1535438201.6565.jpg'),
(187, 1535438327, '::1', 'nqu8dt', '1535438326.5067.jpg'),
(188, 1535438336, '::1', 'afoccy', '1535438335.7445.jpg'),
(189, 1535438380, '::1', 'mhnh0c', '1535438379.9376.jpg'),
(190, 1535438395, '::1', 'gusl2r', '1535438394.7789.jpg'),
(191, 1535438401, '::1', 'ekyf7e', '1535438401.2094.jpg'),
(192, 1535438511, '::1', 'gysnkf', '1535438511.2162.jpg'),
(193, 1535438544, '::1', 'tc8ofz', '1535438544.2634.jpg'),
(194, 1535438661, '::1', 'nb2psj', '1535438661.1914.jpg'),
(195, 1535439502, '::1', '2ockdx', '1535439501.8535.jpg'),
(196, 1535439518, '::1', 'cpuqbq', '1535439517.5845.jpg'),
(197, 1535439725, '::1', 'ilsfal', '1535439725.0713.jpg'),
(198, 1535439810, '::1', 'sepzgq', '1535439809.864.jpg'),
(199, 1535439813, '::1', '2yesix', '1535439812.6297.jpg'),
(200, 1535439848, '::1', 'qkw8pv', '1535439847.6636.jpg'),
(201, 1535439882, '::1', 'g9jemh', '1535439882.3137.jpg'),
(202, 1535439886, '::1', 'nyiucc', '1535439885.8227.jpg'),
(203, 1535439888, '::1', 'l5kzvz', '1535439887.7905.jpg'),
(204, 1535439906, '::1', 'n9tszf', '1535439905.8712.jpg'),
(205, 1535439911, '::1', '5jptlc', '1535439911.2209.jpg'),
(206, 1535439965, '::1', 'qoaq1u', '1535439964.7513.jpg'),
(207, 1535440006, '::1', '4suyuk', '1535440006.224.jpg'),
(208, 1535440013, '::1', '46rou0', '1535440013.332.jpg'),
(209, 1535440100, '::1', 'uiwbzl', '1535440100.3499.jpg'),
(210, 1535440103, '::1', 'exdwdf', '1535440102.7695.jpg'),
(211, 1535442572, '::1', 'aitlra', '1535442571.9727.jpg'),
(212, 1536226431, '::1', 'p25oou', '1536226430.5952.jpg'),
(213, 1536226433, '::1', 'd5np3d', '1536226433.2506.jpg'),
(214, 1537873364, '::1', 'mo5n6r', '1537873364.1778.jpg');

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
-- Indexes for table `app_projects`
--
ALTER TABLE `app_projects`
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
-- AUTO_INCREMENT for table `app_projects`
--
ALTER TABLE `app_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sys_captcha`
--
ALTER TABLE `sys_captcha`
  MODIFY `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `sys_users`
--
ALTER TABLE `sys_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

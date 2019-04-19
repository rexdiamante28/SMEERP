-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2019 at 08:37 PM
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
-- Table structure for table `sys_users`
--

CREATE TABLE `sys_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL COMMENT 'email address',
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mobile_number` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(150) NOT NULL,
  `functions` text,
  `last_seen` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `failed_login_attempts` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sys_users`
--

INSERT INTO `sys_users` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `mobile_number`, `phone_number`, `email`, `avatar`, `functions`, `last_seen`, `active`, `failed_login_attempts`) VALUES
(10, 'root', '$2y$10$m.PYyiq8j8q/GUwLiwkQ2Oa3bvztsDZAxP3jhaIeCKfaVWdz7uGCW', 'Edw', 'Alc', 'Dlr', '09457141432', '', 'edwndolor@gmail.com', 'blank_avatar.png', '{\"overall_access\": 1}\r\n', NULL, 1, 0),
(11, 'admin', '$2y$10$ONiVtTHiX4ICC9PafZ5quu5wEtUxV5KWpaJIiW9B5JfEARZbMH1YK', 'Edw', 'Alc', 'Dlr', '09457141432', '123456', 'jointheclog@gmail.com', 'blank_avatar.png', '{\"overall_access\": 1}\r\n', NULL, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sys_users`
--
ALTER TABLE `sys_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sys_users`
--
ALTER TABLE `sys_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

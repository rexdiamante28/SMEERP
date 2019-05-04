CREATE TABLE `erp_item_categories` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(45) NOT NULL , `parent_category` INT NOT NULL , `category_string` TEXT NOT NULL , `created` DATETIME NOT NULL , `updated` DATETIME NOT NULL , `status` TINYINT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `erp_item_categories` ADD `company` INT NOT NULL AFTER `id`;

CREATE TABLE `erp_item_units` ( `id` INT NOT NULL AUTO_INCREMENT , `company` INT NOT NULL , `name` VARCHAR(45) NOT NULL , `description` TEXT NOT NULL , `created` DATETIME NOT NULL , `updated` DATETIME NOT NULL , `status` TINYINT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2019 at 04:18 AM
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
-- Table structure for table `erp_branches`
--

CREATE TABLE `erp_branches` (
  `id` int(11) NOT NULL,
  `company` int(11) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `description` text,
  `address` text,
  `created` datetime NOT NULL,
  `updated` datetime(6) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `erp_branches`
--
ALTER TABLE `erp_branches`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `erp_branches`
--
ALTER TABLE `erp_branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



CREATE TABLE `erp_storage_locations` ( `id` INT NOT NULL AUTO_INCREMENT , `company` INT NOT NULL , `branch` INT NOT NULL , `name` VARCHAR(50) NOT NULL , `parent_location` INT NULL , `location_string` TEXT NOT NULL , `created` DATETIME NOT NULL , `updated` DATETIME NOT NULL , `status` TINYINT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
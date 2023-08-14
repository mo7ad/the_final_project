-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2023 at 02:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be19_fp_group_one`
--
CREATE DATABASE IF NOT EXISTS `be19_fp_group_one` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be19_fp_group_one`;

-- --------------------------------------------------------

--
-- Table structure for table `meal_planner`
--

CREATE TABLE `meal_planner` (
  `planner_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_recipes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipes_id` int(11) NOT NULL,
  `recipe_name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `prep_time` varchar(30) NOT NULL,
  `calories` varchar(30) NOT NULL,
  `type` enum('vegan','normal','vegetarian','') NOT NULL DEFAULT 'normal',
  `url` varchar(255) DEFAULT NULL,
  `verified` enum('verified','unverified','','') NOT NULL DEFAULT 'unverified',
  `meal_type` enum('breakfast','lunch','dinner','') NOT NULL,
  `ingredients` varchar(255) NOT NULL,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` enum('admin','user','blocked','') NOT NULL DEFAULT 'user',
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meal_planner`
--
ALTER TABLE `meal_planner`
  ADD PRIMARY KEY (`planner_id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_recipes_id` (`fk_recipes_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipes_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meal_planner`
--
ALTER TABLE `meal_planner`
  MODIFY `planner_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meal_planner`
--
ALTER TABLE `meal_planner`
  ADD CONSTRAINT `fk_recipes_id` FOREIGN KEY (`fk_recipes_id`) REFERENCES `recipes` (`recipes_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `meal_planner_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2023 at 06:04 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SecureProg`
--

create database SecureProg;
use SecureProg;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`(
    `user_id` INT(11) UNSIGNED NOT NULL,
    `username` VARCHAR(15),
    `email` text,
    `password` text,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`user_id`,`username`,`email`,`password`,`created_at`) VALUES
(1,'Lawson Schwantz','laws@gmail.com', '$2y$10$eDygX06lJ5smiSDw84BweeX8EvOH4ZBSTo0IEVg.mWHOc2ho1kVj2','2023-10-05 16:00:50'),
(2,'Thunder','bukanpetir@gmail.com','$2y$10$ojeMjJLK4nYojk8wpquzhuOtXwaD9B02UpAvhyZnUyFNjKEAmiE7K','2023-10-06 20:43:00');


-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` INT(11) NOT NULL, 
  `sender_id` INT(11) UNSIGNED NOT NULL,
  `report_type` VARCHAR(50) NOT NULL, 
  `description` text NOT NULL,
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `reports` (`report_id`,`sender_id`,`report_type`,`description`,`send_time`) VALUES
(1,2,'Kritik dan Saran', 'Ini web apaan dah, isinya putih, gaada warna sama sekali, ga rekomen dah intinya','2023-10-05 16:03:53'),
(2,1,'Lainnya','Kucingku kemarin nyangkut diatas pohon, bisa bantu turunin ga ya?','2023-10-06 21:53:02');

--
-- Indexes for table `reports`
--

ALTER TABLE `reports`
  ADD KEY `senderid` (`sender_id`);

--
-- AUTO_INCREMENT for table `users`
--

ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


--
-- AUTO_INCREMENT for table `reports`
--

ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


--
-- Constraints for table `reports`
--

ALTER TABLE `reports`
  ADD CONSTRAINT `senderid` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

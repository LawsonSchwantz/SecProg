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
    `name` text,
    `username` VARCHAR(15),
    `email` text,
    `phone_number` BIGINT NOT NULL,
    `password` text,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`user_id`,`name`,`username`,`email`,`phone_number`,`password`,`created_at`) VALUES
(0, 'Admin', 'admin', 'admin@gmail.com', 1500505, '$2y$10$TFa9fnwa1AHNS/O/BrQlX.elKR5VTFpIfB9iIRwgxNNeNoX26TcfW', '2023-10-22 22:13:50'),
(1,'Bertrand R.M.','Lawson Schwantz','laws@gmail.com', 6281234567890, '$2y$10$nKjHOYIUs2qsrb1Y5AhLhe5Kg1NO1.yEY.TMSVjNyxIUD/P5.L3Ne','2023-10-05 16:00:50'),
(2,'Fefe','Thunder','bukanpetir@gmail.com',6289876543210, '$2y$10$73CNI76svhIdYR8Mjjdq7uVpCkPfAVb9W25HqmZBX7rGv6lWzA9sS','2023-10-06 20:43:00');


-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

CREATE TABLE `aboutus`(
  `about_id` INT(11) UNSIGNED NOT NULL,
  `name` text,
  `email` text,
  `message` text,
  `send_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`about_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `aboutus` (`about_id`,`name`, `email`,`message`,`send_at`) VALUES
(1,'victor benaya', 'vicbe@gmail.com','Ngohee','2023-10-05 16:01:00'),
(2,'leo', 'betrand@gmail.com','tes123 wih keren juga ni fitur','2023-10-06 21:00:00');


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


-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE items (
  item_id INT(11) NOT NULL, 
  item_name text,
  item_picture text, 
  item_desc text,
  item_stock INT(11) NOT NULL,
  PRIMARY KEY (item_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO items (item_id,item_name,item_picture,item_desc,item_stock) VALUES
(1,'Fefe goreng','https://media.discordapp.net/attachments/1156182611383824435/1165674085464948766/FEFE3_01_-_Copy.jpg?ex=6547b597&is=65354097&hm=6818a9608a6a1fc48e15979c417f242f88c8fad5d358dbc3c07990d9ba353098&=&width=888&height=888', 'Fefe',1),
(2,'Fefe goreng v2','https://media.discordapp.net/attachments/1156182611383824435/1165674085464948766/FEFE3_01_-_Copy.jpg?ex=6547b597&is=65354097&hm=6818a9608a6a1fc48e15979c417f242f88c8fad5d358dbc3c07990d9ba353098&=&width=888&height=888', 'Fefe',1);


--
-- Indexes for table `reports`
--

ALTER TABLE `reports`
  ADD KEY `senderid` (`sender_id`);

--
-- AUTO_INCREMENT for table `users`
--

ALTER TABLE `users`
  MODIFY `user_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


--
-- AUTO_INCREMENT for table `reports`
--

ALTER TABLE `aboutus`
  MODIFY `about_id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


--
-- AUTO_INCREMENT for table `reports`
--

ALTER TABLE `reports`
  MODIFY `report_id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


--
-- AUTO_INCREMENT for table `items`
--

ALTER TABLE `reports`
  MODIFY `report_id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for table `reports`
--

ALTER TABLE `reports`
  ADD CONSTRAINT `senderid` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


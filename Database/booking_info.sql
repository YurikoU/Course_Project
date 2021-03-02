use Yuriko200448500;
#drop table if exists booking_info;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Feb 27, 2021 at 11:12 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comp1006_winter2021`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_info`
--

DROP TABLE IF EXISTS `booking_info`;
CREATE TABLE IF NOT EXISTS `booking_info` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `room_type` varchar(30) NOT NULL,
  `check_in_date` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `check_in_time` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `check_out_date` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `check_out_time` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_info`
--

INSERT INTO `booking_info` (`booking_id`, `first_name`, `last_name`, `phone`, `email`, `room_type`, `check_in_date`, `check_in_time`, `check_out_date`, `check_out_time`) VALUES
(31, 'Jackson', 'Wilson', '604-2222-2222', 'jackson@example.com', 'Room C, 1 King Bed', '2021-02-28', '15:14', '2021-03-13', '10:14'),
(54, 'Emma', 'Martin', '123-1234-1234', '', 'Room F, 1 Super King Bed', '2021-02-28', '15:19', '2021-03-01', '10:19'),
(32, 'Oliver', 'Lewis', '604-999-999', 'Lewis@example.com', 'Room B, 1 Queen Bed', '2021-03-07', '15:44', '2021-03-08', '10:44'),
(33, 'Oliver', 'Lewis', '604-9099-99', 'Lewis@gmail.com', 'Room B, 1 Queen Bed', '2021-03-08', '16:47', '2021-03-09', '10:47'),
(28, 'Kate', 'Brown', '505-1234-1234', 'Kate@example.com', 'Room B, 1 Queen Bed', '2021-02-23', '15:54', '2021-03-07', '10:54'),
(59, 'Madison', 'Tremblay', '123-1234-1234', '', 'Room F, 1 Super King Bed', '2021-03-01', '17:06', '2021-03-02', '10:07'),
(57, 'Yuriko', 'Uchida', '8888888888', '', 'Room E, 1 Super King Bed', '2021-03-02', '15:50', '2021-03-03', '10:50'),
(40, 'James', 'Johnson', '000-0000-000', '', 'Room A, 1 Queen Bed', '2021-02-28', '18:39', '2021-03-01', '09:39'),
(41, 'Ava', 'Cote', '111-111-111', 'Cote@gmail.com', 'Room D, 1 King Bed', '2021-02-28', '15:40', '2021-03-01', '10:41'),
(55, 'Jada', 'Roy', '12312341234', 'Roy@example.test.com', 'Room E, 1 Super King Bed', '2021-02-28', '16:29', '2021-03-01', '10:29'),
(56, 'Maya', 'Clark', '605-4444-4444', 'Clark.Maya@example.com', 'Room E, 1 Super King Bed', '2021-03-01', '14:40', '2021-03-02', '10:40'),
(44, 'Hailey', 'Scott', '000-000-000', 'Hailey@example.com', 'Room D, 1 King Bed', '2021-03-01', '19:12', '2021-03-02', '10:12'),
(45, 'Isabella', 'Smith', '555-555-555', 'Smith.33@gmail.com', 'Room D, 1 King Bed', '2021-03-02', '19:17', '2021-03-03', '10:17'),
(46, 'yuriko', 'uchida', '333-333-333', '', 'Room A, 1 Queen Bed', '2021-03-01', '19:23', '2021-03-02', '10:23'),
(47, 'yuriko', 'uchida', '333-333-333', '', 'Room A, 1 Queen Bed', '2021-03-02', '19:23', '2021-03-03', '10:23'),
(58, 'Emily', 'Ouellet', '777-7777-7777', '', 'Room C, 1 King Bed', '2021-03-13', '15:03', '2021-03-14', '10:03'),
(49, 'Scarlett', 'Li', '444-444-444', 'Li@test.example.ca', 'Room A, 1 Queen Bed', '2021-03-03', '15:42', '2021-03-04', '09:42'),
(50, 'Christopher', 'Tremblay', '66666666666', 'Tremblay@georgian.ca', 'Room B, 1 Queen Bed', '2021-03-09', '15:07', '2021-03-10', '10:08'),
(51, 'Joshua', 'Gagnon', '111-222-222', 'Gagnon@georgian.com', 'Room C, 1 King Bed', '2021-03-14', '15:10', '2021-03-15', '10:10'),
(52, 'Michael', 'Wilson', '111-111-111', 'Wilson@gmail.com', 'Room D, 1 King Bed', '2021-03-03', '15:13', '2021-03-04', '10:13'),
(60, 'Hannah', 'Martin', '123-1234-1234', '', 'Room F, 1 Super King Bed', '2021-03-02', '17:09', '2021-03-03', '10:09'),
(63, 'Cameron', 'Cameron', '123-1234-1234', '', 'Room B, 1 Queen Bed', '2021-03-11', '15:34', '2021-03-12', '10:34'),
(64, 'Cameron', 'Cameron', '123-1234-1234', 'Cameron@example.test.ca', 'Room C, 1 King Bed', '2021-03-15', '18:34', '2021-03-16', '10:34');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

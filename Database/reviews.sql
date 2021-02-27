use Yuriko200448500;
#drop table if exists reviews;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Feb 27, 2021 at 11:33 PM
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
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `post_date` datetime NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `review` varchar(200) NOT NULL,
  `like` int DEFAULT '0',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`post_id`, `post_date`, `username`, `review`, `like`) VALUES
(1, '2021-02-26 12:27:55', 'Yuriko', 'It was good!', 0),
(2, '2021-02-26 13:27:55', 'user1989', 'All staff were so helpful.', 0),
(3, '2021-02-26 14:27:55', 'UCHD', 'The location is the best.', 0),
(4, '2021-02-26 15:27:00', '123456', 'I enjoyed my stay!', 0),
(5, '2021-02-26 15:30:21', 'user:D', 'The room is pricy a bit.', 0),
(6, '2021-02-26 16:51:00', 'YRK', 'Thank you!!', 0),
(7, '2021-02-26 17:51:29', 'user:P', 'I like this hotel.', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

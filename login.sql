-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 06, 2022 at 06:26 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `passbook`
--

DROP TABLE IF EXISTS `passbook`;
CREATE TABLE IF NOT EXISTS `passbook` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL,
  `teacher_code` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `departure_time` datetime NOT NULL,
  `return_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passbook`
--

INSERT INTO `passbook` (`id`, `student_id`, `teacher_code`, `destination`, `departure_time`, `return_time`) VALUES
(1, 1234, 'indy', 'bathroom', '2021-03-20 10:05:06', '2021-03-20 13:00:25'),
(2, 1234, 'no', 'bathroom', '2021-03-20 12:18:04', '2021-03-20 13:00:25'),
(3, 1234, 'indy', 'front_office', '2021-03-20 13:00:37', '2021-03-20 13:00:44'),
(4, 1234, 'indy', 'front_office', '2021-03-20 13:02:32', '2021-03-20 13:02:35'),
(5, 1234, 'no', 'principal', '2021-03-20 13:03:12', '2021-03-20 13:03:14'),
(6, 1234, 'indy', 'bathroom', '2021-03-22 17:26:40', '2021-03-22 17:27:10'),
(7, 1234, 'indy', 'bathroom', '2021-03-22 17:26:44', '2021-03-22 17:27:10'),
(8, 1234, 'indy', 'bathroom', '2021-03-22 17:26:47', '2021-03-22 17:27:10'),
(9, 1234, 'indy', 'bathroom', '2021-03-22 17:26:48', '2021-03-22 17:27:10'),
(10, 1234, 'indy', 'bathroom', '2021-03-22 17:26:51', '2021-03-22 17:27:10'),
(11, 1234, 'indy', 'bathroom', '2021-03-22 17:26:54', '2021-03-22 17:27:10'),
(12, 1234, 'indy', 'bathroom', '2021-03-22 17:26:56', '2021-03-22 17:27:10'),
(13, 1234, 'indy', 'bathroom', '2021-03-22 17:26:59', '2021-03-22 17:27:10'),
(14, 1234, 'indy', 'bathroom', '2021-03-22 17:27:01', '2021-03-22 17:27:10'),
(15, 1234, 'indy', 'bathroom', '2021-03-22 17:27:04', '2021-03-22 17:27:10'),
(16, 1234, 'indy', 'bathroom', '2021-03-22 17:27:06', '2021-03-22 17:27:10'),
(17, 1234, 'indy', 'bathroom', '2021-03-22 17:29:26', '2021-03-22 17:34:23'),
(18, 1234, 'indy', 'bathroom', '2021-03-22 17:29:28', '2021-03-22 17:34:23'),
(19, 1234, 'indy', 'bathroom', '2021-03-22 17:29:30', '2021-03-22 17:34:23'),
(20, 1234, 'no', 'principal', '2021-03-22 18:09:24', '2021-03-22 18:09:31'),
(21, 1234, 'no', 'front_office', '2021-03-22 18:09:50', '2021-03-22 18:10:03'),
(22, 1234, 'no', 'bathroom', '2021-03-22 18:09:57', '2021-03-22 18:10:03'),
(23, 1234, 'no', 'bathroom', '2021-03-22 18:13:21', '2021-03-22 18:13:30'),
(24, 191237, 'indy', 'front_office', '2021-04-01 12:12:49', '2021-04-05 18:12:34'),
(25, 191237, 'indy', 'front_office', '2021-04-05 18:12:43', NULL),
(26, 1234, 'no', 'bathroom', '2021-04-19 18:19:57', '2021-04-19 18:20:26'),
(27, 1234, 'indy', 'bathroom', '2021-04-28 20:09:24', '2021-04-28 20:09:41'),
(28, 1234, 'indy', 'principal', '2021-05-10 18:18:40', '2021-11-05 18:01:43'),
(29, 1234, 'no', 'front_office', '2021-11-05 18:04:34', '2021-11-05 18:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_student`
--

DROP TABLE IF EXISTS `user_student`;
CREATE TABLE IF NOT EXISTS `user_student` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `student_lastname` varchar(50) NOT NULL,
  `student_firstname` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_student`
--

INSERT INTO `user_student` (`id`, `student_id`, `username`, `password`, `student_lastname`, `student_firstname`) VALUES
(1, 1234, 'indyg', 'pass1', 'Ghosh', 'Indy'),
(2, 191237, 'seamus', 'password', 'Fields', 'Seamus');

-- --------------------------------------------------------

--
-- Table structure for table `user_teacher`
--

DROP TABLE IF EXISTS `user_teacher`;
CREATE TABLE IF NOT EXISTS `user_teacher` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `teacher_code` varchar(20) NOT NULL,
  `teacher_lastname` varchar(50) NOT NULL,
  `teacher_firstname` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_teacher`
--

INSERT INTO `user_teacher` (`id`, `teacher_id`, `username`, `password`, `teacher_code`, `teacher_lastname`, `teacher_firstname`) VALUES
(1, 1111, 'teacherguy', 'badpass', 'indy', 'Ford', 'Vern'),
(2, 1234567, 'yes', 'yesyes', 'no', 'Man', 'Real');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

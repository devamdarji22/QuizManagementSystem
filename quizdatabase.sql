-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2021 at 12:08 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer_detail`
--

CREATE TABLE `answer_detail` (
  `code` varchar(15) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `question_number` int(5) NOT NULL,
  `answer` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_details`
--

CREATE TABLE `attendance_details` (
  `test_code` varchar(15) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `attendance` tinyint(1) NOT NULL,
  `test_marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `host`
--

CREATE TABLE `host` (
  `Email` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `host`
--

INSERT INTO `host` (`Email`, `Name`, `Password`) VALUES
('abc@gmail.com', 'abc', '1234'),
('atharva@gmail.com', 'Atharva', '1234'),
('chinmay@gmail.com', 'chinmay', '1234'),
('d@gmail.com', 'Devam darji', '1234'),
('devamdarji22@gmail.com', 'Devam darji', '1234'),
('jay@gmail.com', 'jay', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `question_detail`
--

CREATE TABLE `question_detail` (
  `code` varchar(15) NOT NULL,
  `question_number` int(5) NOT NULL,
  `question_part` varchar(2) NOT NULL,
  `question_type` varchar(15) NOT NULL,
  `question` varchar(500) NOT NULL,
  `question_marks` int(11) NOT NULL,
  `option1` varchar(500) NOT NULL,
  `option2` varchar(500) NOT NULL,
  `option3` varchar(500) NOT NULL,
  `option4` varchar(500) NOT NULL,
  `correct_answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `test_detail`
--

CREATE TABLE `test_detail` (
  `test_code` varchar(15) NOT NULL,
  `test_password` varchar(20) NOT NULL,
  `test_host_email` varchar(50) NOT NULL,
  `test_title` varchar(50) NOT NULL,
  `start` tinyint(1) NOT NULL,
  `test_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usn` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `name`, `password`, `usn`) VALUES
('d1@gmail.com', 'Devam darji', '1234', '1bg18cs027'),
('d2@gmail.com', 'abc', '1234', '1bg18cs054'),
('d@gmail.com', 'Devam darji', '1234', '1bg18cs027');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer_detail`
--
ALTER TABLE `answer_detail`
  ADD KEY `answer_quiz_code` (`code`),
  ADD KEY `answer_question_number` (`question_number`),
  ADD KEY `answer_user_email` (`user_email`);

--
-- Indexes for table `attendance_details`
--
ALTER TABLE `attendance_details`
  ADD KEY `test_code` (`test_code`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `host`
--
ALTER TABLE `host`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `question_detail`
--
ALTER TABLE `question_detail`
  ADD KEY `code` (`code`),
  ADD KEY `question_number` (`question_number`);

--
-- Indexes for table `test_detail`
--
ALTER TABLE `test_detail`
  ADD PRIMARY KEY (`test_code`),
  ADD KEY `test_host_email` (`test_host_email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer_detail`
--
ALTER TABLE `answer_detail`
  ADD CONSTRAINT `answer_question_number` FOREIGN KEY (`question_number`) REFERENCES `question_detail` (`question_number`),
  ADD CONSTRAINT `answer_quiz_code` FOREIGN KEY (`code`) REFERENCES `test_detail` (`test_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answer_user_email` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`);

--
-- Constraints for table `attendance_details`
--
ALTER TABLE `attendance_details`
  ADD CONSTRAINT `test_code` FOREIGN KEY (`test_code`) REFERENCES `test_detail` (`test_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_email` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question_detail`
--
ALTER TABLE `question_detail`
  ADD CONSTRAINT `code` FOREIGN KEY (`code`) REFERENCES `test_detail` (`test_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_detail`
--
ALTER TABLE `test_detail`
  ADD CONSTRAINT `test_host_email` FOREIGN KEY (`test_host_email`) REFERENCES `host` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2021 at 05:58 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_marks_addition` (IN `testcode` VARCHAR(15), IN `mail` VARCHAR(50))  UPDATE attendance_details
SET attendance_details.test_marks = (
SELECT mark 
FROM 

(SELECT SUM(q.question_marks) AS mark, a.user_email as user_email , q.code as testcode
FROM question_detail AS q
INNER JOIN answer_detail AS a 
    ON testcode = a.code AND q.code = a.code
WHERE q.question_type = 'mcq' AND q.correct_answer = a.answer
 AND a.question_number = q.question_number
GROUP BY a.user_email) table1

WHERE user_email = mail
)
WHERE attendance_details.user_email = mail$$

DELIMITER ;

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

--
-- Dumping data for table `answer_detail`
--

INSERT INTO `answer_detail` (`code`, `user_email`, `question_number`, `answer`) VALUES
('3J5HF0KMYF', 'd1@gmail.com', 1, '1'),
('3J5HF0KMYF', 'd1@gmail.com', 2, '42'),
('3J5HF0KMYF', 'd1@gmail.com', 3, '4'),
('3J5HF0KMYF', 'd2@gmail.com', 1, '1'),
('3J5HF0KMYF', 'd2@gmail.com', 2, 'Answer is written in pdf.'),
('3J5HF0KMYF', 'd2@gmail.com', 3, '4'),
('3J5HF0KMYF', 'd@gmail.com', 1, '1'),
('3J5HF0KMYF', 'd@gmail.com', 2, '23'),
('3J5HF0KMYF', 'd@gmail.com', 3, '1');

--
-- Triggers `answer_detail`
--
DELIMITER $$
CREATE TRIGGER `test_marks_addition_trigger` AFTER INSERT ON `answer_detail` FOR EACH ROW CALL `test_marks_addition`(NEW.code,NEW.user_email)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_details`
--

CREATE TABLE `attendance_details` (
  `test_code` varchar(15) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `attendance` tinyint(1) NOT NULL,
  `test_marks` int(11) NOT NULL,
  `test_document_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_details`
--

INSERT INTO `attendance_details` (`test_code`, `user_email`, `attendance`, `test_marks`, `test_document_name`) VALUES
('3J5HF0KMYF', 'd1@gmail.com', 1, 20, ''),
('3J5HF0KMYF', 'd2@gmail.com', 1, 20, '0701211610010168unix 1bg18cs027 assignment.pdf'),
('3J5HF0KMYF', 'd@gmail.com', 1, 10, '');

--
-- Triggers `attendance_details`
--
DELIMITER $$
CREATE TRIGGER `remove_answer` AFTER DELETE ON `attendance_details` FOR EACH ROW DELETE FROM answer_detail WHERE user_email = OLD.user_email
$$
DELIMITER ;

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
('atharva@gmail.com', 'Atharva', '1234'),
('chinmay@gmail.com', 'chinmay', '1234'),
('devamdarji22@gmail.com', 'Devam darji', '1234'),
('jay@gmail.com', 'jay', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `question_detail`
--

CREATE TABLE `question_detail` (
  `code` varchar(15) NOT NULL,
  `question_number` int(5) NOT NULL,
  `question_type` varchar(15) NOT NULL,
  `question` varchar(500) NOT NULL,
  `question_marks` int(11) NOT NULL,
  `option1` varchar(500) NOT NULL,
  `option2` varchar(500) NOT NULL,
  `option3` varchar(500) NOT NULL,
  `option4` varchar(500) NOT NULL,
  `correct_answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_detail`
--

INSERT INTO `question_detail` (`code`, `question_number`, `question_type`, `question`, `question_marks`, `option1`, `option2`, `option3`, `option4`, `correct_answer`) VALUES
('3J5HF0KMYF', 1, 'mcq', 'What is your name ?', 10, 'Devam', 'Vaidehi', 'Prakash', 'Kalpana', 1),
('3J5HF0KMYF', 2, 'subjective', 'What is your age ?', 5, '', '', '', '', 0),
('3J5HF0KMYF', 3, 'mcq', 'Which of these is not an animal ?', 10, 'Vaidehi', 'Dog', 'Cat ', 'Devam', 4);

-- --------------------------------------------------------

--
-- Table structure for table `test_detail`
--

CREATE TABLE `test_detail` (
  `test_code` varchar(15) NOT NULL,
  `test_host_email` varchar(50) NOT NULL,
  `test_title` varchar(50) NOT NULL,
  `start` tinyint(1) NOT NULL,
  `test_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_detail`
--

INSERT INTO `test_detail` (`test_code`, `test_host_email`, `test_title`, `start`, `test_date`) VALUES
('3J5HF0KMYF', 'atharva@gmail.com', 'DBMS Internal 1', 1, '2021-01-06');

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

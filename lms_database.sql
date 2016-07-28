-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2016 at 04:23 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `class` varchar(200) NOT NULL,
  `author` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `rent` float NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `class`, `author`, `description`, `price`, `rent`, `amount`) VALUES
(1, 'Prisoner of zenda', 'Science', 'Al - Beruni', 'Vintage Book', 78, 0.7, 4),
(2, 'Book 2', 'Science', 'Janzaib', 'Imported', 7000, 70, 1),
(3, 'Artificial Intelligence', 'Science', 'William Stalling', 'AI Book', 789, 7.89, 4),
(5, 'Compiler Construction', 'Science', 'Hina Khurshid', 'BSSE 5 semester Book', 900, 0.9, 4),
(8, 'Linear Algebra', 'Mathematics', 'Jabir Bin Ibn - e - Hayan', 'Very Old Mathematics Book', 1200, 12, 0),
(9, 'Akber and Beeber', 'Story', 'Akber', '--', 100, 0.1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `book_issue`
--

CREATE TABLE `book_issue` (
  `BI_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `issue_date` varchar(20) DEFAULT NULL,
  `return_date` varchar(20) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_issue`
--

INSERT INTO `book_issue` (`BI_id`, `student_id`, `book_id`, `issue_date`, `return_date`, `time`) VALUES
(4, 0, 0, NULL, '11/07/2016 01:37 am', 0),
(5, 0, 0, NULL, '11/07/2016 01:38 am', 0),
(6, 0, 0, NULL, '11/07/2016 01:38 am', 0),
(7, 0, 0, NULL, '11/07/2016 01:38 am', 0),
(8, 0, 0, NULL, '11/07/2016 01:38 am', 0),
(9, 0, 0, NULL, '11/07/2016 01:38 am', 0),
(10, 0, 0, NULL, '11/07/2016 01:38 am', 0),
(12, 1, 1, '11/07/2016 05:01 am', '11/07/2016 05:24 am', 0),
(13, 1, 1, '11/07/2016 05:24 am', '11/07/2016 05:24 am', 0),
(15, 1, 1, '11/07/2016 05:51 am', '11/07/2016 06:04 am', 0),
(16, 1, 1, '11/07/2016 05:57 am', '11/07/2016 06:06 am', 0),
(17, 1, 1, '11/07/2016 05:58 am', '11/07/2016 06:06 am', 0),
(18, 1, 1, '11/07/2016 06:04 am', '11/07/2016 06:05 am', 0),
(19, 1, 1, '11/07/2016 06:14 am', '', 1468210489),
(21, 3, 8, '11/07/2016 07:04 am', '11/07/2016 07:05 am', 0),
(23, 3, 8, '11/07/2016 07:07 am', '', 1468213643);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `student_id`, `staff_id`, `username`, `password`) VALUES
(1, 1, NULL, 'student', 'student'),
(3, NULL, 2, 'librarian', 'librarian'),
(4, NULL, 3, 'hr', 'hr'),
(5, NULL, 6, 'pappu', 'pappu'),
(6, NULL, 7, 'asma', 'asma'),
(7, 8, NULL, 'fatima', 'fatima'),
(9, 2, NULL, 'fatima1', 'fatima1'),
(10, 3, NULL, 'haris', 'haris'),
(11, NULL, 10, 'admin2', 'admin2'),
(13, NULL, 12, 'admin3', 'admin3'),
(15, NULL, 14, 'admin', 'admin'),
(16, NULL, 15, 'yaqoob', 'yaqoob');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `destination` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `destination`) VALUES
(2, 'Zubair Bin Khalid', 'librarian'),
(3, 'Ali Gohor', 'hr'),
(7, 'Asma Kashif', 'hr'),
(8, 'Fatima Binte Fahad', ''),
(9, 'Fatima Binte Fahad', ''),
(10, 'Yakoob', 'librarian'),
(14, 'Nadeem Khattak', 'admin'),
(15, 'Waqas', 'librarian');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`) VALUES
(1, 'Sallah Uddin'),
(3, 'haris');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `book_issue`
--
ALTER TABLE `book_issue`
  ADD PRIMARY KEY (`BI_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `book_issue`
--
ALTER TABLE `book_issue`
  MODIFY `BI_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

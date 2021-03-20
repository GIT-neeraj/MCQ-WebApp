-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2019 at 08:58 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcq`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'e3274be5c857fb42ab72d786e281b4b8');

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `uid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `regno` varchar(30) NOT NULL,
  `dept` varchar(5) NOT NULL,
  `year` varchar(5) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `email` varchar(35) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`uid`, `name`, `password`, `regno`, `dept`, `year`, `uname`, `email`, `gender`, `phone`) VALUES
(4, 'Sumit Pandey', '5f4dcc3b5aa765d61d8327deb882cf99', '2016PGCACA70', 'mca', '2', 'sadller', 'sumitpandey@gmail.com', 'male', '1234567890'),
(5, 'Abhishek Nayek', '5f4dcc3b5aa765d61d8327deb882cf99', '2016PGCACA72', 'mca', '2', 'reedemer', 'nayek@gmail.com', 'male', '2345678901'),
(6, 'Mayank Sharma', '5f4dcc3b5aa765d61d8327deb882cf99', '2016PGACACA68', 'mca', '2', 'dinkubc', 'mayank2@gmail.com', 'male', '3456789012'),
(7, 'Sarthak Bhardwaj', '5f4dcc3b5aa765d61d8327deb882cf99', '2016PGCACA38', 'mca', '2', 'leuitsar', 'sarthak@gmail.com', 'male', '4567890123'),
(8, 'Abhishek Sharma', '5f4dcc3b5aa765d61d8327deb882cf99', '2016PGCACA51', 'mca', '2', 'sharma', 'ab@gmail.com', 'male', '5678901234'),
(9, 'Himanshu Sharma', '5f4dcc3b5aa765d61d8327deb882cf99', '2016PGACACA35', 'mca', '2', 'gamer', 'himanshu@gmail.com', 'male', '6789012345'),
(10, 'Rahul PM', '5f4dcc3b5aa765d61d8327deb882cf99', '2016PGACACA74', 'mca', '2', 'dazzeler', 'pm@gmail.com', 'male', '7890123456'),
(12, 'Satyam Mishra', '5f4dcc3b5aa765d61d8327deb882cf99', '2016PGCACA07', 'mca', '2', 'hunter', 'sattu@gmail.com', 'male', '9012345678'),
(13, 'Prashant Babru', '5f4dcc3b5aa765d61d8327deb882cf99', '2016PGCACA13', 'mca', '2', 'babru', 'babru@gmail.com', 'male', '0123456789'),
(14, 'Neeraj Kumar Singh', '5f4dcc3b5aa765d61d8327deb882cf99', '2016PGCACA71', 'mca', '2', 'neeraj139', '1995913neerajks@gmail.com', 'male', '9453384431');

-- --------------------------------------------------------

--
-- Table structure for table `sampletest`
--

CREATE TABLE `sampletest` (
  `uid` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `a` varchar(100) NOT NULL,
  `b` varchar(100) NOT NULL,
  `c` varchar(100) NOT NULL,
  `d` varchar(100) NOT NULL,
  `correct_option` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sampletest`
--

INSERT INTO `sampletest` (`uid`, `question`, `a`, `b`, `c`, `d`, `correct_option`) VALUES
(1, 'which', 'google', 'amazon', 'facebook', 'microsoft', 'a'),
(2, 'question 2', 'a', 'b', 'c', 'd', 'b'),
(3, 'question 3', 'a', 'b', 'c', 'd', 'c'),
(4, 'question 4', 'a', 'b', 'c', 'd', 'd'),
(5, 'question 5', 'a', 'b', 'c', 'd', 'a'),
(6, 'question 6', 'a', 'b', 'c', 'd', 'b'),
(7, 'question 7', 'a', 'b', 'c', 'd', 'c'),
(8, 'question 8', 'a', 'b', 'c', 'd', 'd'),
(9, 'question 9', 'a', 'b', 'c', 'd', 'a'),
(10, 'question 10', 'a', 'b', 'c', 'd', 'b'),
(11, 'question 11', 'a', 'b', 'c', 'd', 'c'),
(12, 'question 12', 'a', 'b', 'c', 'd', 'd'),
(13, 'question 12', 'a', 'b', 'c', 'd', 'a'),
(14, 'question 14', 'a', 'b', 'c', 'd', 'b'),
(15, 'question 16', 'a', 'b', 'c', 'd', 'c'),
(16, 'question 16', 'a', 'b', 'c', 'd', 'd'),
(17, 'question 17', 'a', 'b', 'c', 'd', 'a'),
(18, 'question 18', 'aB', 'b', 'c', 'd', 'b'),
(19, 'question', 'a', 'b', 'c', 'd', 'c'),
(20, 'question 20', 'a', 'b', 'c', 'd', 'd'),
(21, 'question 21', 'a', 'b', 'c', 'd', 'a'),
(22, 'question 22', 'a', 'b', 'c', 'd', 'b'),
(23, 'question 23', 'a', 'b', 'c', 'd', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `sampletest_ans`
--

CREATE TABLE `sampletest_ans` (
  `uname` varchar(20) NOT NULL,
  `attempted` varchar(5) NOT NULL,
  `_1` varchar(5) NOT NULL,
  `_2` varchar(5) NOT NULL,
  `_3` varchar(5) NOT NULL,
  `_4` varchar(5) NOT NULL,
  `_5` varchar(5) NOT NULL,
  `_6` varchar(5) NOT NULL,
  `_7` varchar(5) NOT NULL,
  `_8` varchar(5) NOT NULL,
  `_9` varchar(5) NOT NULL,
  `_10` varchar(5) NOT NULL,
  `_11` varchar(5) NOT NULL,
  `_12` varchar(5) NOT NULL,
  `_13` varchar(5) NOT NULL,
  `_14` varchar(5) NOT NULL,
  `_15` varchar(5) NOT NULL,
  `_16` varchar(5) NOT NULL,
  `_17` varchar(5) NOT NULL,
  `_18` varchar(5) NOT NULL,
  `_19` varchar(5) NOT NULL,
  `_20` varchar(5) NOT NULL,
  `_21` varchar(5) NOT NULL,
  `_22` varchar(5) NOT NULL,
  `_23` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sampletest_ans`
--

INSERT INTO `sampletest_ans` (`uname`, `attempted`, `_1`, `_2`, `_3`, `_4`, `_5`, `_6`, `_7`, `_8`, `_9`, `_10`, `_11`, `_12`, `_13`, `_14`, `_15`, `_16`, `_17`, `_18`, `_19`, `_20`, `_21`, `_22`, `_23`) VALUES
('neeraj139', 'yes', 'a', 'b', 'c', 'd', 'd', 'c', 'c', 'd', 'd', 'b', 'c', 'd', 'a', 'b', 'b', 'd', 'a', 'b', 'd', 'd', 'd', 'b', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `uid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `duration_minutes` int(11) NOT NULL,
  `active_flag` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`uid`, `name`, `duration_minutes`, `active_flag`) VALUES
(1, 'sampletest', 100, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `sampletest`
--
ALTER TABLE `sampletest`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `sampletest_ans`
--
ALTER TABLE `sampletest_ans`
  ADD PRIMARY KEY (`uname`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `participation`
--
ALTER TABLE `participation`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sampletest`
--
ALTER TABLE `sampletest`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

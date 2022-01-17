-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2020 at 06:41 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolclub`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `photo`) VALUES
(2, '13', '4.jpg'),
(3, 'Web Development', 'c.jpg'),
(5, 'Android ', 'e.jpg'),
(6, 'bhbhbhb', '12.jpg'),
(7, 'yess', '3.jpg'),
(17, 'vsvsvsv', '13.jpeg'),
(18, 'new member', '8.jpg'),
(20, 'fb test', 'a.jpg'),
(21, 'I\'d test', '11.jpg'),
(22, 'number test', '8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `department_heads`
--

CREATE TABLE `department_heads` (
  `id` int(11) NOT NULL,
  `member_id` varchar(255) NOT NULL,
  `dept_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_heads`
--

INSERT INTO `department_heads` (`id`, `member_id`, `dept_id`) VALUES
(1, '22', NULL),
(6, '55', '8'),
(7, '77', NULL),
(8, '24', NULL),
(9, '22', NULL),
(10, '22', NULL),
(11, '22', '10'),
(12, '22', NULL),
(13, '22', NULL),
(14, '1', NULL),
(15, '1', NULL),
(16, '1', NULL),
(17, '1', NULL),
(18, '25', NULL),
(19, '1', NULL),
(20, '2', NULL),
(21, '29', NULL),
(22, '33', NULL),
(23, '29', NULL),
(24, '2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dptmntsapplications`
--

CREATE TABLE `dptmntsapplications` (
  `Id` int(11) NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AdminRemark` mediumtext,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dptmntsapplications`
--

INSERT INTO `dptmntsapplications` (`Id`, `PostingDate`, `AdminRemark`, `AdminRemarkDate`, `Status`, `IsRead`, `member_id`, `department`) VALUES
(2, '2020-03-06 13:46:44', 'iji', '2020-03-06 20:29:20 ', 2, 1, 24, '3'),
(3, '2020-03-06 13:46:50', 'kmk', '2020-03-06 20:22:04 ', 1, 1, 24, '7'),
(4, '2020-03-06 13:46:53', 'jn n', '2020-03-06 20:22:55 ', 1, 1, 24, '18'),
(5, '2020-03-06 13:46:58', 'kjl', '2020-03-06 19:55:26 ', 2, 0, 24, '20'),
(6, '2020-03-06 15:02:33', 'six', '2020-03-06 20:35:05 ', 2, 0, 29, '23'),
(7, '2020-03-06 15:04:52', 'iuytrdfcgvhjkliouy', '2020-03-07 20:36:42 ', 1, 1, 29, '22'),
(8, '2020-03-06 23:14:15', ';lkjhgfvckljhgf', '2020-03-07 20:37:20 ', 1, 1, 4, '2'),
(9, '2020-03-07 16:18:46', 'lkiojuhygf', '2020-03-07 22:07:05 ', 2, 1, NULL, '5');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `email`, `password`, `username`, `status`, `created_on`, `department_id`) VALUES
(1, 'admin@gmail.com', 'd81f9c1be2e08964bf9f24b15f0e4900', 'admin', '1', '2019-08-22 05:25:05', 5),
(4, 'one@gmail.com', '202cb962ac59075b964b07152d234b70', 'one', '0', '2019-08-22 05:25:55', 2),
(6, 'three@gmail.com', '202cb962ac59075b964b07152d234b70', 'three', '0', '2019-08-22 05:26:31', 3),
(7, 'four@gmail.com', '202cb962ac59075b964b07152d234b70', 'four', '0', '2019-08-22 05:26:49', 4),
(8, 'test@gmail.com', '202cb962ac59075b964b07152d234b70', 'test', '1', '2019-08-22 05:27:09', 0),
(9, 'five@gmail.com', '202cb962ac59075b964b07152d234b70', 'five', '1', '2019-08-22 05:27:25', 0),
(10, 'www@gmail.com', '202cb962ac59075b964b07152d234b70', 'www', '1', '2020-02-17 05:01:00', 0),
(11, 'rr@gmail.com', '202cb962ac59075b964b07152d234b70', 'rr', '1', '2020-02-17 05:03:34', 0),
(12, 'aa@gmail.com', '202cb962ac59075b964b07152d234b70', 'aa', '1', '2020-02-17 05:10:37', 0),
(13, 'mm@gmail.com', '202cb962ac59075b964b07152d234b70', 'mm', '1', '2020-02-17 05:13:58', 0),
(14, 'nn@gmail.com', '202cb962ac59075b964b07152d234b70', 'nn', '1', '2020-02-17 05:14:53', 0),
(15, 'gg@gmail.com', 'd81f9c1be2e08964bf9f24b15f0e4900', 'gg', '1', '2020-02-17 05:18:44', 0),
(16, '345@gmail.com', 'd81f9c1be2e08964bf9f24b15f0e4900', '345', '1', '2020-02-17 05:21:30', 0),
(21, 'four@gmail.com', '202cb962ac59075b964b07152d234b70', 'four', '0', '2019-08-21 22:26:49', 5);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `member_id` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_of_study` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `member_id`, `course`, `year_of_study`, `skills`, `notes`, `photo`) VALUES
(1, '3', '', '', '', '', '5.jpg'),
(2, '2', 'comp scie', 'gerbr', 'nooooo', 'erberbrb', '8.jpg'),
(3, '1', 'Comp', '2', 'javascript', 'ever coding', '3.jpg'),
(4, '4', '', '', '', '', ''),
(5, '5', '', '', '', '', '3.jpg'),
(6, '5', '', '', '', '', '3.jpg'),
(7, '28', 'BBIT', '2', 'JAVA', 'always coding', '7.jpg'),
(8, '29', 'TELCOM', '2', 'JavaScript', 'coding for life', '8.jpg'),
(9, '9', '', '', '', '', '3.jpg'),
(10, '31', 'BBIT', '', 'Ruby', 'coding is my thing', '10.jpg'),
(11, '21', 'BBIT', '4', 'Python', 'code for ever', '11.jpg'),
(12, '16', 'TELCOM', '4', 'Python', 'code  code', '12.jpg'),
(13, '10', 'TELCOM', '3', 'Python', 'code code code', '13.jpg'),
(17, '', 'yessss', 'yesss', 'yesss', 'yesss', '22'),
(18, '', 'yessss', 'yesss', 'yesss', 'yesss', '22'),
(19, '', 'yessss', 'yesss', 'yesss', 'yesss', '22'),
(20, '12', 'comp scie', '3', 'nooooo', 'grgrgr', '9.jpg'),
(21, '', 'edit', 'edit', 'edit', 'edit', 'edit'),
(22, '', 'edit', 'edit', 'edit', 'edit', 'edit'),
(23, '47', 'edit', 'edit', 'edit', 'edit', ''),
(24, '48', 'edit', 'edit', 'edit', 'edit', ''),
(25, '49', 'nooooo', 'gerbr', 'grgrg', 'grgrgr', 'a.jpg'),
(26, '50', '', '', '', '', '8.jpg'),
(27, '51', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_heads`
--
ALTER TABLE `department_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dptmntsapplications`
--
ALTER TABLE `dptmntsapplications`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `department_heads`
--
ALTER TABLE `department_heads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `dptmntsapplications`
--
ALTER TABLE `dptmntsapplications`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

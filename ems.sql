-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2023 at 11:37 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `education_qualifications`
--

CREATE TABLE `education_qualifications` (
  `id` int(100) NOT NULL,
  `eid` int(100) NOT NULL,
  `institution` varchar(1000) NOT NULL,
  `exam` varchar(1000) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `percent` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education_qualifications`
--

INSERT INTO `education_qualifications` (`id`, `eid`, `institution`, `exam`, `start`, `end`, `percent`) VALUES
(137, 144, 'kjc', 'bca', '2023-04-20', '2023-04-21', 78),
(138, 145, 'fbfxb', 'fb xf', '2023-05-24', '2023-05-30', 56),
(139, 145, 'fxb', 'fxbf', '2023-05-04', '2023-05-12', 34),
(152, 0, 'kjc', 'bc', '2023-05-31', '2023-05-30', 76);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `mobilenumber` bigint(10) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `addr` varchar(2000) NOT NULL,
  `role` varchar(100) NOT NULL,
  `sal` int(100) NOT NULL,
  `design` varchar(100) NOT NULL,
  `ut` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `lname`, `gender`, `mobilenumber`, `emailid`, `password`, `dob`, `addr`, `role`, `sal`, `design`, `ut`) VALUES
(1, 'Marina', 'John', 'Female', 9845696551, 'marina@gmail.com', 'marinajohn20', '2023-03-01', 'Bangalore', 'Developer', 10000, 'Junior Developer', 'Admin'),
(2, 'Monu', 'J K', 'Male', 6361132867, 'monu@gmail.com', 'monicajohn', '1999-09-07', '1923,Samuddhi,AECS A Block, Singasandra, Bangalore-560068', 'HR', 24000, 'HR Core', 'Admin'),
(144, 'John', 'Doe', 'Female', 1234512345, 'johndoe@gmail.com', 'johndoe123', '1990-01-31', 'America', 'Frontend Developer', 150000, 'Software Developer', 'Employee'),
(145, 'Sam', 'Abbyy', 'Male', 1234567895, 'sam@gmail.com', 'sam1234567', '1990-01-01', 'Kerala', 'Frontend Developer', 20000, 'Design', 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `family_members`
--

CREATE TABLE `family_members` (
  `id` int(100) NOT NULL,
  `eid` int(100) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `relationship` varchar(100) NOT NULL,
  `age` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `family_members`
--

INSERT INTO `family_members` (`id`, `eid`, `name`, `relationship`, `age`) VALUES
(83, 144, 'monu', 'Sister', 24),
(91, 0, 'latha late', '3', 23),
(93, 145, 'tom', '0', 50);

-- --------------------------------------------------------

--
-- Table structure for table `previous_experience`
--

CREATE TABLE `previous_experience` (
  `id` int(100) NOT NULL,
  `eid` int(100) NOT NULL,
  `company` varchar(1000) NOT NULL,
  `role` varchar(1000) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `previous_experience`
--

INSERT INTO `previous_experience` (`id`, `eid`, `company`, `role`, `start`, `end`) VALUES
(60, 145, 'bdfx', 'bdcbc', '2023-05-11', '2023-05-15'),
(61, 145, 'fbfx', 'fxbx', '2023-05-03', '2023-05-04'),
(96, 144, 'three38', 'web developer', '2023-05-03', '2023-05-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `education_qualifications`
--
ALTER TABLE `education_qualifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_members`
--
ALTER TABLE `family_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `previous_experience`
--
ALTER TABLE `previous_experience`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `education_qualifications`
--
ALTER TABLE `education_qualifications`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `family_members`
--
ALTER TABLE `family_members`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `previous_experience`
--
ALTER TABLE `previous_experience`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

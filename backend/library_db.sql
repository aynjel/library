-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 01:23 AM
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
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `id` int(11) NOT NULL,
  `library_req_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `approved_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`id`, `library_req_id`, `student_id`, `approved_datetime`) VALUES
(26, 13, 12345678, '2023-06-05 08:05:45'),
(27, 10, 12345678, '2023-06-05 08:05:45'),
(28, 11, 12345678, '2023-06-05 08:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `library_logs`
--

CREATE TABLE `library_logs` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `library_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `logs_status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `library_request`
--

CREATE TABLE `library_request` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `req_datetime` datetime NOT NULL,
  `req_description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `library_request`
--

INSERT INTO `library_request` (`id`, `student_id`, `req_datetime`, `req_description`, `status`) VALUES
(9, 12345678, '2023-06-16 16:20:00', 'Study Philosphy', 2),
(10, 12345678, '2023-03-27 05:05:00', 'sdfsafas', 1),
(11, 12345678, '2023-06-23 02:03:00', 'sdfsafsaf', 1),
(12, 12345678, '2023-06-14 03:02:00', 'asfsfafadga', 0),
(13, 12345678, '2023-06-27 12:03:00', 'sdfasfasf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `year_level` int(11) NOT NULL,
  `section` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `password`, `first_name`, `middle_name`, `last_name`, `year_level`, `section`, `course`) VALUES
(15, 12345678, 'asd', 'Anggi', 'C', 'Ortega', 3, 'B', 'Bachelor of Science in Mechanical Engineering'),
(17, 2018, 'password', 'John', 'Doe', 'Doe', 1, 'A', 'BSIT'),
(19, 123234234, 'Pa$$w0rd!', 'Teegan', 'Mannix Bailey', 'Contreras', 3, 'Doloremque assumenda', 'BSCS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`id`),
  ADD KEY `library_fk0` (`library_req_id`),
  ADD KEY `library_fk1` (`student_id`);

--
-- Indexes for table `library_logs`
--
ALTER TABLE `library_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library_request`
--
ALTER TABLE `library_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `library_logs`
--
ALTER TABLE `library_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `library_request`
--
ALTER TABLE `library_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2018 at 04:40 PM
-- Server version: 5.6.32-78.1
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `attend` int(11) NOT NULL,
  `sig` tinytext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course` varchar(10) NOT NULL,
  `title` tinytext NOT NULL,
  `section` varchar(2) NOT NULL,
  `qtr` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course`, `title`, `section`, `qtr`) VALUES
(1, 'GWDA233', 'Advanced Web Page Scripting', 'AC', 'SU15'),
(2, 'GWDA263', 'Web Standards', 'AB', 'SU15'),
(3, 'GWDA382', 'Design for Moble Devices', 'AB', 'SU15'),
(4, 'MD3324', 'Portfolio for AAS', 'AC', 'SU15'),
(5, 'MD4303', 'Senior Project- Research', 'AC', 'SU15'),
(6, 'MD4315', 'Senior Project- Application and Defense', 'AC', 'SU15'),
(7, 'MD4324', 'Portfolio', 'AC', 'SU15'),
(8, 'GWDA243', 'Object Oriented Scripting', 'AC', 'FA15'),
(9, 'GWDA273', 'Intermediate Web Design', 'AA', 'FA15'),
(10, 'GWDA313', 'Emerging Technologies', 'AB', 'FA15'),
(11, 'GWDA317', 'Interactive Communication', 'AC', 'FA15'),
(12, 'MD3324', 'Portfolio for AAS', 'AC', 'FA15'),
(13, 'MD4324', 'Portfolio', 'AC', 'FA15'),
(14, 'GWDA123', 'Programming Logic', 'AB', 'WI16'),
(15, 'GWDA382', 'Design for Mobile Devices', 'AC', 'WI16'),
(16, 'GWDA413', 'Design Team: Production', 'AB', 'WI16'),
(17, 'MD4324', 'Portfolio', 'AC', 'WI16'),
(18, 'GWDA133', 'Fundamentals of Web Design', 'AB', 'SP16'),
(20, 'GWDA243', 'Object Oriented Scripting', 'AB', 'SP16'),
(21, 'GWDA263', 'Web Standards', 'AC', 'SP16'),
(22, 'GWDA317', 'Interactive Communication', 'AC', 'SP16'),
(23, 'GWDA407', 'Interactive Communication', 'AC', 'SP16'),
(24, 'GWDA453', 'Interactive Communication', 'AC', 'SP16'),
(25, 'MD3324', 'Portfolio for AAS', 'AC', 'SP16'),
(26, 'MD4324', 'Portfolio', 'AC', 'SP16'),
(27, 'GWDA133', 'Fundamentals of Web Design', 'AB', 'SU16'),
(28, 'GWDA273', 'Intermediate Web Design', 'AC', 'SU16'),
(29, 'GWDA317', 'Interactive Communication', 'AC', 'SU16'),
(30, 'GWDA382', 'Design for Mobile Devices', 'AB', 'SU16'),
(31, 'GWDA407', 'Interactive Communication', 'AC', 'SU16'),
(32, 'GWDA453', 'Interactive Communication', 'AC', 'SU16'),
(33, 'MD3324', 'Portfolio for AAS', 'AC', 'SU16'),
(34, 'MD4324', 'Portfolio', 'AC', 'SU16'),
(38, 'GWDA133', 'Fundamentals of Web Design', 'AC', 'FA16'),
(39, 'GWDA243', 'Object Oriented Scripting', 'AB', 'FA16'),
(40, 'GWDA413', 'Design Team: Production', 'AB', 'FA16'),
(41, 'GWDA133', 'Fundamentals of Web Design', 'AA', 'WI17'),
(42, 'GWDA273', 'Intermediate Web Design', 'AC', 'WI17'),
(43, 'GWDA372', 'Content Management Systems', 'AC', 'WI17'),
(44, 'GWDA382', 'Design for Mobile Devices', 'AB', 'WI17'),
(45, 'GWDA133', 'Fundamentals of Web Design', 'AC', 'SP17'),
(46, 'GWDA243', 'Object Oriented Scripting', 'AC', 'SP17'),
(47, 'GWDA273', 'Intermediate Web Design', 'AB', 'SP17'),
(48, 'GWDA133', 'Fundamentals of Web Design', 'AC', 'SU17'),
(49, 'GWDA382', 'Design for Mobile Devices', 'AC', 'SU17'),
(50, 'GWDA413', 'Design Team: Production', 'AC', 'SU17'),
(51, 'MD4324', 'Portfolio', 'AB', 'SU17'),
(52, 'GWDA123', 'Programming Logic', 'AC', 'FA17'),
(53, 'GWDA133', 'Fundamentals of Web Design', 'AC', 'FA17'),
(54, 'GWDA243', 'Object Oriented Scripting', 'AB', 'FA17'),
(55, 'MD4324', 'Portfolio', 'AC', 'FA17'),
(56, 'GWDA133', 'Fundamentals of Web Design', 'AC', 'WI18'),
(57, 'GWDA273', 'Intermediate Web Design', 'AB', 'WI18');

-- --------------------------------------------------------

--
-- Table structure for table `roster`
--

CREATE TABLE `roster` (
  `id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(11) NOT NULL,
  `student` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `roster`
--
ALTER TABLE `roster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2273;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `roster`
--
ALTER TABLE `roster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=503;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

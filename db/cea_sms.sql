-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 13, 2015 at 05:27 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cea_sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_data`
--

CREATE TABLE IF NOT EXISTS `academic_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(50) NOT NULL,
  `admission_year` varchar(10) NOT NULL,
  `university_scheme` varchar(10) NOT NULL,
  `current_semester` varchar(10) NOT NULL,
  `semester_starting_date` date NOT NULL,
  `semester_ending_date` date NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `academic_data`
--

INSERT INTO `academic_data` (`id`, `course`, `admission_year`, `university_scheme`, `current_semester`, `semester_starting_date`, `semester_ending_date`, `timestamp`) VALUES
(1, 'B.Tech', '2012', '2012', '2', '0000-00-00', '0000-00-00', '2015-01-14 19:28:04'),
(6, 'M.Tech', '2013', '2006', '1', '2015-01-15', '0000-00-00', '2015-01-25 14:08:05'),
(7, 'B.Tech', '2014', '2012', '1', '2014-08-01', '2015-03-31', '2015-02-12 09:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_name` varchar(100) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_code` varchar(15) NOT NULL,
  `department_code` varchar(15) NOT NULL,
  `course_semester` varchar(5) NOT NULL,
  `course_seats` varchar(5) NOT NULL,
  `course_batch` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `program_name`, `course_name`, `course_code`, `department_code`, `course_semester`, `course_seats`, `course_batch`) VALUES
(1, 'B.Tech', 'Computer Science and Engineering', 'CS', 'CSE', '8', '60', '2'),
(2, 'B.Tech', 'Mechanical Engineering', 'ME', 'ME', '8', '120', '3'),
(3, 'M.Tech', 'Artificial Inteligence', 'AI', 'CSE', '4', '20', '2'),
(4, 'B.Tech', 'Electronics and Communication Engineering', 'EC', 'ECE', '8', '120', '2'),
(5, 'B.Tech', 'Electrical and Electronics Engineering', 'EEE', 'EEE', '8', '60', '1'),
(6, 'B.Tech', 'Test Name', 'TM', 'XY', '4', '50', '1'),
(7, 'ZZZ', 'TXX', 'TX', 'XY', '5', '45', '1'),
(8, 'B.Tech', 'PHP Development', 'PHPD', 'CSE', '8', '120', '2'),
(9, 'ZZZ', 'Test Course', 'CSF', 'CSE', '4', '120', '2');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) NOT NULL,
  `department_code` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department_name`, `department_code`) VALUES
(1, 'Computer Science and Engineering', 'CSE'),
(2, 'Mechanical Engineering', 'ME'),
(3, 'Electronics and Communication Engineering', 'ECE'),
(4, 'Electrical and Electronics Engineering', 'EEE'),
(5, 'Applied Science', 'AS'),
(6, 'Test', 'TE'),
(7, '123', 'XX'),
(8, 'XXY', 'XY'),
(9, 'MMM', 'MM'),
(10, 'XXXYY', 'XXXY');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_questions`
--

CREATE TABLE IF NOT EXISTS `feedback_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_code` varchar(20) NOT NULL,
  `question` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `feedback_questions`
--

INSERT INTO `feedback_questions` (`id`, `department_code`, `question`, `timestamp`) VALUES
(1, 'CSE', 'Test question', '2015-02-12 20:03:55'),
(2, 'CSE', 'Test Question 2', '2015-02-12 20:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `login_admin`
--

CREATE TABLE IF NOT EXISTS `login_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` varchar(10) NOT NULL,
  `login_log` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `login_admin`
--

INSERT INTO `login_admin` (`id`, `userid`, `name`, `email`, `phone`, `password`, `role`, `login_log`, `timestamp`) VALUES
(1, '1187ajeeshsctoep', 'Ajeesh S', 'ajeesh@ajeesh.com', '1234567890', 'f9af672207cca3f5de35261ee7b5952a', 'admin', '', '2015-01-21 11:19:32'),
(2, '987tittuvarghesexjrhy', 'Tittu Varghese', 'tittuhpd@gmail.com', '1234567890', '25f9e794323b453885f5181f1b624d0b', 'admin', '', '2015-01-21 11:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `login_college_admin`
--

CREATE TABLE IF NOT EXISTS `login_college_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` varchar(15) NOT NULL,
  `login_log` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `login_college_admin`
--

INSERT INTO `login_college_admin` (`id`, `userid`, `name`, `email`, `phone`, `password`, `role`, `login_log`, `timestamp`) VALUES
(1, '1600jyothijohn6z77v', 'Jyothi John', 'jyothi@cea.org', '1234567890', 'f2df715fa02b5617a45fb815f3e2f2dc', 'principal', '', '2015-01-21 11:18:21'),
(2, '868managernamefg7va', 'Manager Name', 'manager@cea.com', '1234567890', 'fa6ea8cd811bbb500a394dee148c8e29', 'manager', '', '2015-01-21 10:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `login_staff`
--

CREATE TABLE IF NOT EXISTS `login_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` varchar(10) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `department` varchar(10) NOT NULL,
  `joining_date` date NOT NULL,
  `login_log` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `login_staff`
--

INSERT INTO `login_staff` (`id`, `userid`, `name`, `date_of_birth`, `email`, `phone`, `password`, `role`, `designation`, `type`, `department`, `joining_date`, `login_log`, `timestamp`) VALUES
(1, 'tittuX1234', 'Ajeesh S', '1994-05-27', 'tittuhpd@gmail.com', '', '25f9e794323b453885f5181f1b624d0b', 'hod', 'Assistant Professor', 'technical', 'CSE', '2006-05-20', '', '2015-02-11 16:29:56'),
(2, 'syamasr123', 'Syama SR', '2015-01-04', 'shyama@gmail.com', '123456789', '25f9e794323b453885f5181f1b624d0b', 'staff', 'Assistant Professor', 'technical', 'CSE', '2015-01-20', '', '2015-02-11 16:29:56'),
(3, '1448girijavrhq7wj', 'Girija VR', '1970-02-05', 'girijavr@icea.ihrd.ac.in', '1234567890', '9b592ae6f3b7898ad95baf9f7d80c2cd', 'staff', 'Assistant Professor', 'technical', 'CSE', '1970-02-05', '', '2015-02-03 15:14:57'),
(4, '1257deepakrishnan8j0pp', 'Deepa Krishnan', '0000-00-00', 'deepa@gmail.com', '1234567890', '12500558b1df705008dbc74f91b91a64', 'staff', 'Assistant Professor', 'technical', 'CSE', '0000-00-00', '', '2015-01-17 10:38:26'),
(5, '795suchitrasysgvd', 'Suchitra S', '1984-05-24', 'suchi@tras.com', '9846447966', 'acdfaacce31821ae3b8de8c8a53facbe', 'staff', 'Assistant Professor', 'technical', 'CSE', '2015-05-24', '', '2015-01-17 10:41:04'),
(6, '579teststaffiity8', 'TEst Staff', '1994-05-27', 'sample@sample.com', '1234567890', '2565d13a1602fac0f07c76a604398058', 'staff', 'Professor', 'technical', 'CSE', '1994-05-27', '', '2015-02-11 16:29:50'),
(7, '698manumjohn9wzt8', 'Manu M John', '1984-01-27', 'manu@manu.com', '1234567890', '36e31393a365e1021d4e3968fb128c6e', 'staff', 'Assistant Professor', 'technical', 'ME', '2014-05-30', '', '2015-02-03 08:38:09'),
(8, '496madhuak6g874', 'Madhu AK', '1984-01-27', 'madhu@madhuak.com', '1234567890', 'c3c87bd255e5eb74453d742b5278cbcb', 'hod', 'Professor', 'technical', 'ME', '2009-05-27', '', '2015-02-03 08:38:09'),
(9, '1790irenesh981g', 'Irene S', '2010-05-05', 'irene@irene.com', '1234567890', '42e927759ab2fbbb92afb2497e60f7f4', 'staff', 'Guest Lecturer', 'technical', 'CSE', '2014-05-03', '', '2015-02-11 17:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `login_student`
--

CREATE TABLE IF NOT EXISTS `login_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) NOT NULL,
  `admission_number` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `department` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'student',
  `year_of_admission` varchar(100) NOT NULL,
  `login_log` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `login_student`
--

INSERT INTO `login_student` (`id`, `userid`, `admission_number`, `name`, `email`, `password`, `department`, `role`, `year_of_admission`, `login_log`, `timestamp`) VALUES
(1, '386tittuvarghesemeox5', 5053, 'Tittu varghese', 'tittuhpd@gmail.com', '4aeae10ea1c6433c926cdfa558d31134', 'CSE', 'student', '2011', '', '2015-02-12 15:54:51'),
(2, '1537tittuvarghese2m8o0', 5054, 'Tittu varghese', 'tittuhghpd@gmail.com', '64eec0c3fb6b12c43f51ec9e9c773fed', 'CSE', 'student', '2011', '', '2015-02-12 15:54:51'),
(3, 'mysql_real_escape_string(563tittuvarghesepjjrc)', 0, 'mysql_real_escape_string(Tittu varghese)', 'mysql_real_escape_string(tittuhpd@gmail.com)', 'mysql_real_escape_string(4aeae10ea1c6433c926cdfa558d31134)', 'mysql_real', 'student', 'mysql_real_escape_string(2011)', '', '2015-02-12 19:17:27'),
(4, 'mysql_real_escape_string(1682tittuvargheseic3p5)', 0, 'mysql_real_escape_string(Tittu varghese)', 'mysql_real_escape_string(tittuhghpd@gmail.com)', 'mysql_real_escape_string(64eec0c3fb6b12c43f51ec9e9c773fed)', 'mysql_real', 'student', 'mysql_real_escape_string(2011)', '', '2015-02-12 19:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `log_login`
--

CREATE TABLE IF NOT EXISTS `log_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(30) NOT NULL,
  `os` varchar(30) NOT NULL,
  `browser` varchar(30) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `userrole` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `log_login`
--

INSERT INTO `log_login` (`id`, `ip`, `os`, `browser`, `userid`, `userrole`, `timestamp`) VALUES
(1, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-14 07:17:18'),
(2, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-14 07:32:47'),
(3, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-14 07:45:57'),
(4, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-14 09:14:00'),
(5, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-14 09:35:15'),
(6, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-14 11:59:57'),
(7, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-14 12:40:26'),
(8, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-14 12:43:06'),
(9, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-14 14:04:50'),
(10, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-14 19:05:51'),
(11, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-15 06:01:13'),
(12, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-15 18:24:25'),
(13, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-16 09:46:01'),
(14, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-16 11:01:49'),
(15, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-17 07:26:27'),
(16, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-17 13:15:18'),
(17, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-19 03:59:52'),
(18, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-19 04:22:30'),
(19, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-19 04:26:58'),
(20, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-20 15:42:03'),
(21, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-20 17:02:02'),
(22, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234Hfd', 'admin', '2015-01-21 04:52:11'),
(23, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-01-21 11:23:15'),
(24, '::1', 'Windows 8.1', 'Firefox', '1187ajeeshsctoep', 'admin', '2015-01-21 11:23:56'),
(25, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-01-21 11:24:14'),
(26, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-01-22 15:30:24'),
(27, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-01-24 13:35:02'),
(28, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-01-24 16:40:44'),
(29, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-01-24 18:27:19'),
(30, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-01-25 13:51:26'),
(31, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-01-29 15:11:58'),
(32, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-02-03 07:18:09'),
(33, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-02-03 13:35:17'),
(34, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234', 'staff', '2015-02-03 14:10:39'),
(35, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234', 'staff', '2015-02-03 15:15:20'),
(36, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-02-08 05:23:53'),
(37, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234', 'staff', '2015-02-08 05:24:37'),
(38, '::1', 'Windows 8.1', 'Chrome', 'syamasr123', 'staff', '2015-02-08 05:28:06'),
(39, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-02-08 13:47:09'),
(40, '::1', 'Windows 8.1', 'Chrome', 'syamasr123', 'staff', '2015-02-08 13:47:59'),
(41, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234', 'staff', '2015-02-08 13:48:23'),
(42, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-02-10 05:28:02'),
(43, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-02-11 16:22:45'),
(44, '::1', 'Windows 8.1', 'Chrome', 'syamasr123', 'staff', '2015-02-11 16:23:12'),
(45, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234', 'staff', '2015-02-11 16:25:46'),
(46, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-02-12 08:34:07'),
(47, '::1', 'Windows 8.1', 'Firefox', '386tittuvarghesemeox5', 'student', '2015-02-12 15:55:42'),
(48, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-02-12 17:51:17'),
(49, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-02-12 18:43:31'),
(50, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-02-12 19:13:59'),
(51, '::1', 'Windows 8.1', 'Firefox', '987tittuvarghesexjrhy', 'admin', '2015-02-12 19:38:04'),
(52, '::1', 'Windows 8.1', 'Firefox', 'tittuX1234', 'staff', '2015-02-12 19:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `program_name`) VALUES
(1, 'B.Tech'),
(2, 'M.Tech'),
(3, 'MSE'),
(4, 'MBA'),
(5, '12'),
(6, '123'),
(7, 'XXY'),
(8, 'YYZ'),
(9, 'ZZZ'),
(10, 'Ajith');

-- --------------------------------------------------------

--
-- Table structure for table `semester_subject`
--

CREATE TABLE IF NOT EXISTS `semester_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subj_code` varchar(12) NOT NULL,
  `subj_name` varchar(100) NOT NULL,
  `type` varchar(12) NOT NULL,
  `subj_code_sub` varchar(12) NOT NULL,
  `department` varchar(50) NOT NULL,
  `scheme` varchar(12) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `course` varchar(10) NOT NULL,
  `program` varchar(10) NOT NULL,
  `hours` varchar(3) NOT NULL DEFAULT '1',
  `in_mark` varchar(5) NOT NULL,
  `ex_mark` varchar(12) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `semester_subject`
--

INSERT INTO `semester_subject` (`id`, `subj_code`, `subj_name`, `type`, `subj_code_sub`, `department`, `scheme`, `semester`, `course`, `program`, `hours`, `in_mark`, `ex_mark`, `timestamp`) VALUES
(1, 'CS 101', 'Engineering Mathematics I', 'TH', '', 'CSE', '2006', '1', 'CS', 'B.Tech', '50', '50', '100', '2015-01-15 16:24:20'),
(2, 'CS 102', 'Engineering Physics', 'TH', 'B', 'CSE', '2006', '1', 'CS', 'B.Tech', '50', '50', '100', '2015-01-15 16:42:34'),
(3, 'CS 105', 'Engineering Chemistry', 'TH', 'A', 'CSE', '2006', '1', 'CS', 'B.Tech', '35', '50', '100', '2015-01-16 18:51:14'),
(4, 'CS 103', 'Engineering Chemistry', 'TH', '', 'CSE', '2006', '1', 'CS', 'B.Tech', '55', '50', '100', '2015-01-16 10:55:37'),
(5, 'CS 104', 'Engineering Mechanics', 'TH', '', 'CSE', '2006', '1', 'CS', 'B.Tech', '60', '50', '100', '2015-01-16 11:42:24'),
(6, 'CS 105', 'Engineering Graphics', 'TH', '', 'CSE', '2006', '1', 'CS', 'B.Tech', '55', '50', '100', '2015-01-16 11:47:24'),
(7, 'CS 106', 'One Not Six A', 'TH', 'A', 'CSE', '2006', '1', 'CS', 'B.Tech', '20', '50', '100', '2015-01-16 19:05:06'),
(8, 'CS 106', 'One Not Six B', 'TH', 'B', 'CSE', '2006', '1', 'CS', 'B.Tech', '20', '50', '100', '2015-01-16 19:05:19'),
(9, 'CS 106', 'One Not Six', 'TH', '', 'CSE', '2006', '1', 'CS', 'B.Tech', '20', '50', '100', '2015-01-16 19:05:29'),
(10, 'CS 123', 'Test', 'TH', 'A', 'CSE', '2006', '1', 'CS', 'B.Tech', '55', '50', '100', '2015-01-16 19:17:15'),
(11, 'ME 101', 'Engineering Mathematics I', 'TH', '', 'ME', '2006', '1', 'ME', 'B.Tech', '60', '50', '100', '2015-01-16 19:19:42'),
(12, 'CS 101', 'Engineering Mathematics', 'TH', '', 'CSE', '2012', '1', 'CS', 'B.Tech', '50', '50', '100', '2015-01-25 18:29:57'),
(13, 'ME 101', 'Engineering Mathematics', 'TH', '', 'ME', '2012', '1', 'ME', 'B.Tech', '50', '50', '100', '2015-02-08 15:08:03');

-- --------------------------------------------------------

--
-- Table structure for table `staff_advisors`
--

CREATE TABLE IF NOT EXISTS `staff_advisors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_code` varchar(50) NOT NULL,
  `program_name` varchar(50) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `batch` varchar(5) NOT NULL,
  `staff_id` varchar(100) NOT NULL,
  `year_of_admission` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `staff_advisors`
--

INSERT INTO `staff_advisors` (`id`, `department_code`, `program_name`, `course_code`, `batch`, `staff_id`, `year_of_admission`, `timestamp`) VALUES
(1, 'CSE', 'B.Tech', 'CS', '1', '1448girijavrhq7wj', '2012', '2015-01-25 19:58:45'),
(2, 'ECE', 'B.Tech', 'EC', '1', '496madhuak6g874', '2012', '2015-01-24 14:18:30'),
(3, 'CSE', 'B.Tech', 'CS', '2', '1448girijavrhq7wj', '2012', '2015-01-25 19:48:05'),
(4, 'CSE', 'B.Tech', 'PHPD', '1', 'tittuX1234', '2012', '2015-01-25 19:49:03'),
(5, 'CSE', 'B.Tech', 'PHPD', '2', '579teststaffiity8', '2012', '2015-02-11 16:29:35'),
(6, 'CSE', 'M.Tech', 'AI', '1', 'syamasr123', '2013', '2015-02-11 16:29:29'),
(8, 'CSE', 'B.Tech', 'CS', '1', '1448girijavrhq7wj', '2012', '2015-01-25 19:54:36'),
(9, 'CSE', 'M.Tech', 'AI', '2', '1257deepakrishnan8j0pp', '2013', '2015-01-25 19:58:53'),
(10, 'ME', 'B.Tech', 'ME', '1', '496madhuak6g874', '2012', '2015-01-25 20:01:45'),
(11, 'ME', 'B.Tech', 'ME', '2', '698manumjohn9wzt8', '2012', '2015-01-25 20:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `stud_2014_attendance`
--

CREATE TABLE IF NOT EXISTS `stud_2014_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `batch` varchar(10) NOT NULL DEFAULT '1',
  `date` date NOT NULL,
  `period` varchar(20) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'TH',
  `duration` int(10) NOT NULL DEFAULT '1',
  `teacher` varchar(10) NOT NULL,
  `from` varchar(10) NOT NULL,
  `to` varchar(10) NOT NULL,
  `absents` varchar(500) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stud_2014_data`
--

CREATE TABLE IF NOT EXISTS `stud_2014_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `add_no` varchar(20) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `catogory` varchar(20) NOT NULL,
  `value` varchar(20) NOT NULL,
  `remark` varchar(20) NOT NULL,
  `batch` varchar(10) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stud_2014_main`
--

CREATE TABLE IF NOT EXISTS `stud_2014_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `program` varchar(50) NOT NULL,
  `batch` varchar(50) NOT NULL,
  `admno` varchar(50) NOT NULL,
  `rollNo` int(10) NOT NULL,
  `regno` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `cast` varchar(20) NOT NULL,
  `rsvgroup` varchar(20) NOT NULL,
  `fathername` varchar(50) NOT NULL,
  `fatheroccupation` varchar(50) NOT NULL,
  `yearOfAddmission` varchar(20) NOT NULL,
  `dateOfBirth` varchar(20) NOT NULL,
  `f_mob` varchar(15) NOT NULL,
  `lg_mob` varchar(15) NOT NULL,
  `blood_group` varchar(20) NOT NULL,
  `income` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `p_email` varchar(100) NOT NULL,
  `name_localG` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `admno` (`admno`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `stud_2014_main`
--

INSERT INTO `stud_2014_main` (`id`, `user_id`, `department`, `branch`, `program`, `batch`, `admno`, `rollNo`, `regno`, `name`, `sex`, `address`, `religion`, `cast`, `rsvgroup`, `fathername`, `fatheroccupation`, `yearOfAddmission`, `dateOfBirth`, `f_mob`, `lg_mob`, `blood_group`, `income`, `email`, `p_email`, `name_localG`, `timestamp`) VALUES
(19, '1539tittuvargheseys1ed', 'CSE', 'CS', 'B.Tech', '1', '5053', 58, '12120458', 'Tittu varghese', 'Male', 'Puthenparambil, Karuvatta, Alappuzha', 'Christian', 'Orthodox', 'No', 'Varghese PG', 'Retired Army Officer', '2011', '27-05-1994', '8547960432', '8547960432', 'O+', '100000', 'tittuhpd@gmail.com', 'tittu@tittu.com', 'Varghese PG', '2015-02-12 19:25:25'),
(20, '416tittuvarghesex6bek', 'CSE', 'CS', 'B.Tech', '1', '5054', 58, '12120458', 'Tittu varghese', 'Male', 'Puthenparambil, Karuvatta, Alappuzha', 'Christian', 'Orthodox', 'No', 'Varghese PG', 'Retired Army Officer', '2011', '27-05-1994', '8547960432', '8547960432', 'O+', '100000', 'tittuhghpd@gmail.com', 'tittu@tittu.com', 'Varghese PG', '2015-02-12 19:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `subject_allotment`
--

CREATE TABLE IF NOT EXISTS `subject_allotment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` varchar(10) NOT NULL,
  `course` varchar(10) NOT NULL,
  `program` varchar(10) NOT NULL,
  `batch` varchar(5) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `subject_code` varchar(12) NOT NULL,
  `subject_code_sub` varchar(5) NOT NULL,
  `department_from` varchar(10) NOT NULL,
  `teacher_id` varchar(50) NOT NULL,
  `scheme` varchar(5) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `subject_allotment`
--

INSERT INTO `subject_allotment` (`id`, `department_id`, `course`, `program`, `batch`, `semester`, `subject_code`, `subject_code_sub`, `department_from`, `teacher_id`, `scheme`, `timestamp`) VALUES
(15, 'CSE', 'CS', 'B.Tech', '1', '1', 'CS 101', '', 'CSE', 'tittuX1234', '2006', '2015-01-17 10:51:03'),
(16, 'CSE', 'CS', 'B.Tech', '1', '1', 'CS 102', 'B', 'CSE', '1257deepakrishnan8j0pp', '2006', '2015-01-17 10:55:53'),
(17, 'CSE', 'CS', 'B.Tech', '1', '1', 'CS 103', '', 'ME', '496madhuak6g874', '2006', '2015-01-17 10:55:59'),
(18, 'CSE', 'CS', 'B.Tech', '1', '1', 'CS 105', 'A', 'ME', '698manumjohn9wzt8', '2006', '2015-01-17 10:56:06'),
(19, 'CSE', 'CS', 'B.Tech', '1', '1', 'CS 106', 'A', 'CSE', '1448girijavrhq7wj', '2006', '2015-01-17 10:56:14'),
(20, 'CSE', 'CS', 'B.Tech', '1', '1', 'CS 101', '', 'CSE', '1448girijavrhq7wj', '2012', '2015-02-10 05:33:33');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

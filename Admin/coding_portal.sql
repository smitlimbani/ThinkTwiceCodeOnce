-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2017 at 06:27 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coding_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `comp_details`
--

CREATE TABLE `comp_details` (
  `name_of_comp` varchar(100) NOT NULL,
  `no_of_ques` int(20) NOT NULL,
  `marks_per_q` int(20) NOT NULL,
  `neg_marking` varchar(10) NOT NULL,
  `id` int(11) NOT NULL,
  `no_of_input_files` int(10) NOT NULL,
  `no_members` int(10) NOT NULL DEFAULT '1',
  `penalty_time_min` int(11) NOT NULL DEFAULT '0',
  `comp_time_hrs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comp_details`
--

INSERT INTO `comp_details` (`name_of_comp`, `no_of_ques`, `marks_per_q`, `neg_marking`, `id`, `no_of_input_files`, `no_members`, `penalty_time_min`, `comp_time_hrs`) VALUES
('CodeJAM', 4, 100, 'YES', 1, 4, 2, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `comp_users_score`
--

CREATE TABLE `comp_users_score` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `member_1` varchar(255) NOT NULL,
  `member_2` varchar(255) DEFAULT NULL,
  `problem_1` varchar(20) NOT NULL DEFAULT '0',
  `problem_2` varchar(20) NOT NULL DEFAULT '0',
  `problem_3` varchar(20) DEFAULT NULL,
  `problem_4` varchar(20) DEFAULT NULL,
  `penalty_1` varchar(20) DEFAULT '0',
  `penalty_2` varchar(20) DEFAULT '0',
  `penalty_3` varchar(20) DEFAULT NULL,
  `penalty_4` varchar(20) DEFAULT NULL,
  `password` varchar(20) NOT NULL,
  `comp_started` varchar(25) NOT NULL DEFAULT 'none'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comp_users_score`
--

INSERT INTO `comp_users_score` (`team_id`, `team_name`, `member_1`, `member_2`, `problem_1`, `problem_2`, `problem_3`, `problem_4`, `penalty_1`, `penalty_2`, `penalty_3`, `penalty_4`, `password`, `comp_started`) VALUES
(1, 'tle_aavi', 'vaibhav', 'brijesh', '1502', '500', '0', '600', NULL, NULL, NULL, NULL, '123', '600'),
(2, 'code_duo', 'Harshal', 'Abhishek', '1500', '2100', '100', '0', '0', '0', '0', '0', '123', 'none'),
(3, 'hack_it_up', 'Bhargav', 'Rushabh', '1500', '0', '15152', '1000', '0', '0', '0', '0', '1234', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `input_output_files`
--

CREATE TABLE `input_output_files` (
  `file_id` int(11) NOT NULL,
  `file_type` varchar(20) NOT NULL,
  `file_name` varchar(30) NOT NULL,
  `file_content` mediumblob NOT NULL,
  `file_size` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `id` int(10) NOT NULL,
  `problem_name` varchar(20) NOT NULL,
  `problem_file_type` varchar(20) NOT NULL,
  `problem_file_content` mediumblob NOT NULL,
  `problem_file_size` int(255) NOT NULL,
  `problem_title` varchar(200) NOT NULL,
  `problem_time_limit` int(255) DEFAULT '5',
  `problem_memory_limit` int(255) NOT NULL DEFAULT '5120'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comp_details`
--
ALTER TABLE `comp_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comp_users_score`
--
ALTER TABLE `comp_users_score`
  ADD PRIMARY KEY (`team_id`),
  ADD UNIQUE KEY `team_name` (`team_name`);

--
-- Indexes for table `input_output_files`
--
ALTER TABLE `input_output_files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comp_details`
--
ALTER TABLE `comp_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comp_users_score`
--
ALTER TABLE `comp_users_score`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `input_output_files`
--
ALTER TABLE `input_output_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

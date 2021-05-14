-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2021 at 09:28 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uphigh_set`
--

-- --------------------------------------------------------

--
-- Table structure for table `choice`
--

CREATE TABLE `choice` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `c_order` int(11) NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `text` text NOT NULL,
  `created_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `clicklogs`
--

CREATE TABLE `clicklogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `purpose` enum('registration','change_pass','forgot_pass','announcement','evaluation') NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `eval_answers`
--

CREATE TABLE `eval_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `qChoice_id` int(10) UNSIGNED NOT NULL,
  `eval_id` int(10) UNSIGNED NOT NULL,
  `created_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `eval_sheet`
--

CREATE TABLE `eval_sheet` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `year_started` int(11) NOT NULL,
  `current_sem` tinyint(4) NOT NULL,
  `year_ended` int(11) NOT NULL,
  `verified` varchar(15) NOT NULL DEFAULT 'false',
  `rating` decimal(10,0) NOT NULL,
  `status` enum('Open','Inprogress','Completed') NOT NULL,
  `created_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `details` text DEFAULT NULL,
  `created_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_ON` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(10) UNSIGNED NOT NULL,
  `controller` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `created_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL,
  `is_allowed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `q_order` int(11) NOT NULL,
  `text` text NOT NULL,
  `type` enum('singleChoice','openEnded','','') NOT NULL,
  `created_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_on` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `is_deleted`, `updated_on`, `created_on`) VALUES
(1, 'admin', 0, NULL, NULL),
(2, 'student', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) UNSIGNED NOT NULL,
  `s_order` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `grade_level` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_check` timestamp NOT NULL DEFAULT current_timestamp(),
  `latest_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('login','logout') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `user_id`, `time_check`, `latest_activity`, `ip_address`, `type`, `user_token`, `platform`, `user_agent`, `created_on`, `updated_on`, `is_deleted`) VALUES
(690, 30, '2021-04-01 15:29:38', '2021-04-01 15:29:38', '::1', 'login', 'TiNWXOi1DRlMcaxqfD7HxYhPdUFIDRIJrmURMuZwcCJbZGrRPdym1WkcZAxjVpQmqRYMFY0G77y1TSfzavtNIEGc83EUXT1jDh4F', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-01 10:29:38', '2021-04-01 10:29:38', 0),
(691, 30, '2021-04-02 03:45:58', '2021-04-02 03:45:58', '::1', 'login', 'BC08nLu1VQ4ERFi73FFDzMYmrLcjyJUFdM36zGniMff3Icxy4b5eIhbkZyHDzaTDqeEEE4rjGZieDHfSZWzKU1ip9n9aQoybdM2g', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-01 22:45:58', '2021-04-01 22:45:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `student_num` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `grade_level` int(11) NOT NULL,
  `contact_num` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(4) DEFAULT 1,
  `is_deleted` tinyint(1) DEFAULT 0,
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `student_num`, `first_name`, `last_name`, `role`, `grade_level`, `contact_num`, `username`, `email`, `password`, `created_on`, `is_active`, `is_deleted`, `updated_on`) VALUES
(29, '201804275', 'Rosalie', 'Razonabler', 1, 12, '09770194573', 'rsraz123', 'rsrazonable1@up.edu.ph', '$2y$10$/p7tqywBSyA4peNG1Nr7z.yv1Plxg0f6CiolDV/0GIPMNpTxVHf1u', '2021-03-22 04:31:34', 1, 1, '2021-03-22 04:42:22'),
(30, '201804276', 'Rosalie', 'Razonable', 1, 12, '09770194573', 'rsraz123', 'rsrazonable1218@gmail.com', '$2b$10$E5KzBD3rpWArIuP9N/ABFOS0bQOdzfUruroSZdTthKnBUREp/ZhPu', '2021-03-22 04:46:02', 1, 0, '2021-04-02 12:00:49'),
(31, '201271676', 'hek', 'hok', 1, 12, '098948374831', 'hekhok123', 'rsrazonable12@up.edu.ph', '$2y$10$lvJj7yBy3n.DtwxNXCqDtuama5VfTQls1Qt7eoif/CKb0zsAEl8Ke', '2021-04-01 04:49:47', 1, 0, '2021-04-01 04:49:47'),
(32, '238924205', 'ru', 'ru', 1, 7, '09873648323', 'jkhfkd', 'hekehok@up.edu.ph', '$2y$10$vOfHu7UIt9YG5ctbkmGfwOudC.pTDL/AElikk1Wdfe/sxQx4OOkmG', '2021-04-01 22:54:29', 1, 0, '2021-04-01 22:54:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clicklogs`
--
ALTER TABLE `clicklogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eval_answers`
--
ALTER TABLE `eval_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eval_sheet`
--
ALTER TABLE `eval_sheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentnum` (`student_num`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clicklogs`
--
ALTER TABLE `clicklogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eval_answers`
--
ALTER TABLE `eval_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eval_sheet`
--
ALTER TABLE `eval_sheet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=692;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 10, 2021 at 06:01 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

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
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `purpose` enum('registration','change_pass','forgot_pass','announcement','evaluation','verification') NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `title`, `message`, `purpose`, `created_on`, `updated_on`, `is_deleted`) VALUES
(1, 'Account Creation Notice', 'asdafgsafaadas', 'registration', '2021-04-03 04:58:15', '2021-04-03 04:58:15', 0),
(2, 'New Notice', 'asdbnqmwboijfkdnm,cv', 'registration', '2021-04-03 04:58:36', '2021-04-03 04:58:36', 0),
(3, 'adacxqweqwe', 'ersfsdfsf', 'announcement', '2021-04-03 05:53:08', '2021-04-03 05:53:08', 0),
(4, 'asdas hfgwe fds', 'asda xczc qewrqw', 'evaluation', '2021-04-03 05:55:29', '2021-04-03 05:55:29', 0),
(5, 'New Subject', 'asdh werqwdsa dxcvas eqasf dfcvxbwee qwesad g qwrqwe x xcvsfa qweqw sdfsff sdfqw', 'change_pass', '2021-04-05 21:44:49', '2021-04-05 21:44:49', 0),
(6, 'Two-step Verification', 'Kindly update click this link for verification', 'verification', '2021-04-06 08:54:22', '2021-04-06 08:54:22', 0),
(7, 'Forgot Password', 'You have forgotten your password. The steps to recover your account are as simple as normally changing your password.', 'forgot_pass', '2021-04-08 17:08:45', '2021-04-08 17:08:45', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

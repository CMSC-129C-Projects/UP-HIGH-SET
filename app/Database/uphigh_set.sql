-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2021 at 02:21 AM
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
-- Table structure for table `db_factories`
--

CREATE TABLE `db_factories` (
  `id` int(9) NOT NULL,
  `name` varchar(31) NOT NULL,
  `uid` varchar(31) NOT NULL,
  `class` varchar(63) NOT NULL,
  `icon` varchar(31) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_factories`
--

INSERT INTO `db_factories` (`id`, `name`, `uid`, `class`, `icon`, `summary`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Test Factory', 'test001', 'Factories\\Tests\\NewFactory', 'fas fa-puzzle-piece', 'Longer sample text for testing', NULL, '2021-04-28 19:53:30', '2021-04-28 19:53:30'),
(2, 'Widget Factory', 'widget', 'Factories\\Tests\\WidgetPlant', 'fas fa-puzzle-piece', 'Create widgets in your factory', NULL, NULL, NULL),
(3, 'Evil Factory', 'evil-maker', 'Factories\\Evil\\MyFactory', 'fas fa-book-dead', 'Abandon all hope, ye who enter here', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `db_migrations`
--

CREATE TABLE `db_migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_migrations`
--

INSERT INTO `db_migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(4, '2020-02-22-222222', 'Tests\\Support\\Database\\Migrations\\ExampleMigration', 'tests', 'Tests\\Support', 1619610810, 1);

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
(1, 'Sample Title', 'sample message', 'registration', '2021-04-03 04:33:29', '2021-04-03 04:33:29', 0),
(2, 'Sample Title', 'sample message', 'registration', '2021-04-03 04:35:01', '2021-04-03 04:35:01', 0),
(3, 'Sample Title', 'sample message', 'registration', '2021-04-03 04:35:18', '2021-04-03 04:35:18', 0),
(4, 'Sample Title', 'sample message', 'registration', '2021-04-03 04:36:32', '2021-04-03 04:36:32', 0),
(6, 'SET Evaluation Period', 'Please be informed that the SET Evaluation will be closed in 3 days\' time, it\'s the only time your kalagutgut sa inyu professors will be heard, make it count! ', 'registration', '2021-04-03 04:40:33', '2021-04-03 04:40:33', 0),
(7, 'SET Evaluation Period', 'Please be informed that the SET Evaluation will be closed in 3 days\' time, it\'s the only time your kalagutgut sa inyu professors will be heard, make it count! ', 'registration', '2021-04-03 04:40:33', '2021-04-03 04:40:33', 0),
(8, 'SET Evaluation Period', 'Please be informed that the SET Evaluation will be closed in 3 days\' time, it\'s the only time your kalagutgut sa inyu professors will be heard, make it count! ', 'registration', '2021-04-03 04:40:59', '2021-04-03 04:40:59', 0),
(9, 'SET Evaluation Period', 'Please make your evaluation count! ', 'evaluation', '2021-04-03 04:41:31', '2021-04-03 04:41:31', 0),
(10, 'Email with pop up', 'sample content', 'announcement', '2021-04-03 08:10:36', '2021-04-03 08:10:36', 0),
(11, 'Email with pop up', 'sample content', 'announcement', '2021-04-03 08:10:36', '2021-04-03 08:10:36', 0),
(12, 'Verify your Email', 'This is to verify that you are a legitimate user of this web application. ', 'verification', '2021-04-07 10:05:22', '2021-04-07 10:05:59', 0),
(13, 'Reset Password', 'You have requested to reset your password. If you did not do so, please approach your school clerk to deactivate it in the meantime. ', 'forgot_pass', '2021-04-07 19:05:07', NULL, 0),
(14, 'Change Password', 'Your password is changed!', 'change_pass', '2021-05-04 15:33:01', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` enum('open','closed') NOT NULL,
  `date_start` datetime NOT NULL DEFAULT current_timestamp(),
  `date_end` datetime NOT NULL DEFAULT current_timestamp(),
  `year_start` year(4) DEFAULT NULL,
  `year_end` year(4) DEFAULT NULL,
  `semester` enum('1','2') DEFAULT NULL,
  `grading` enum('1','2','3','4') DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_on` datetime DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`id`, `name`, `status`, `date_start`, `date_end`, `year_start`, `year_end`, `semester`, `grading`, `is_deleted`, `created_on`, `updated_on`) VALUES
(1, 'SET S.Y. 2020 - 2021 | First Semester', 'open', '2021-06-24 07:23:25', '2021-06-30 07:23:35', 2020, 2021, '1', NULL, 0, '2021-05-22 13:58:53', '2021-06-25 07:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `eval_answers`
--

CREATE TABLE `eval_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `eval_sheet_id` int(11) NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `qChoice_id` int(10) UNSIGNED DEFAULT NULL,
  `answer_text` text DEFAULT NULL,
  `status` varchar(7) NOT NULL,
  `created_on` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eval_answers`
--

INSERT INTO `eval_answers` (`id`, `user_id`, `eval_sheet_id`, `question_id`, `qChoice_id`, `answer_text`, `status`, `created_on`, `updated_on`, `is_deleted`) VALUES
(118, 68, 5, 1, 3, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(119, 68, 5, 2, 3, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(120, 68, 5, 3, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(121, 68, 5, 4, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(122, 68, 5, 5, 4, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(123, 68, 5, 6, 3, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(124, 68, 5, 7, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(125, 68, 5, 8, 3, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(126, 68, 5, 9, 3, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(127, 68, 5, 10, 4, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(128, 68, 5, 11, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(129, 68, 5, 12, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(130, 68, 5, 13, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(131, 68, 5, 14, 3, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(132, 68, 5, 15, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(133, 68, 5, 16, 1, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(134, 68, 5, 17, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(135, 68, 5, 18, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(136, 68, 5, 19, 3, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(137, 68, 5, 20, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(138, 68, 5, 21, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(139, 68, 5, 22, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(140, 68, 5, 23, 3, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(141, 68, 5, 24, 3, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(142, 68, 5, 25, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(143, 68, 5, 26, 4, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(144, 68, 5, 27, 3, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(145, 68, 5, 28, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(146, 68, 5, 29, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(147, 68, 5, 30, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(148, 68, 5, 31, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(149, 68, 5, 32, 3, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(150, 68, 5, 33, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(151, 68, 5, 34, 2, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(152, 68, 5, 35, 3, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(153, 68, 5, 36, 8, NULL, 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(154, 68, 5, 37, NULL, 'adgfgjghk', 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(155, 68, 5, 38, NULL, 'adsfsdfd', 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(156, 68, 5, 39, NULL, 'asdasfsdf', 'save', '2021-06-12 21:46:44', '2021-06-12 21:46:44', 0),
(157, 68, 4, 1, 3, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(158, 68, 4, 2, 4, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(159, 68, 4, 3, 3, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(160, 68, 4, 4, 3, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(161, 68, 4, 5, 4, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(162, 68, 4, 6, 4, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(163, 68, 4, 7, 3, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(164, 68, 4, 8, 2, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(165, 68, 4, 9, 3, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(166, 68, 4, 10, 2, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(167, 68, 4, 11, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(168, 68, 4, 12, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(169, 68, 4, 13, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(170, 68, 4, 14, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(171, 68, 4, 15, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(172, 68, 4, 16, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(173, 68, 4, 17, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(174, 68, 4, 18, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(175, 68, 4, 19, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(176, 68, 4, 20, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(177, 68, 4, 21, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(178, 68, 4, 22, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(179, 68, 4, 23, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(180, 68, 4, 24, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(181, 68, 4, 25, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(182, 68, 4, 26, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(183, 68, 4, 27, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(184, 68, 4, 28, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(185, 68, 4, 29, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(186, 68, 4, 30, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(187, 68, 4, 31, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(188, 68, 4, 32, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(189, 68, 4, 33, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(190, 68, 4, 34, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(191, 68, 4, 35, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(192, 68, 4, 36, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(193, 68, 4, 37, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(194, 68, 4, 38, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(195, 68, 4, 39, NULL, NULL, 'save', '2021-06-24 19:52:58', '2021-06-24 19:52:58', 0),
(196, 237, 24, 1, 2, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(197, 237, 24, 2, 3, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(198, 237, 24, 3, 2, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(199, 237, 24, 4, 2, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(200, 237, 24, 5, 3, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(201, 237, 24, 6, 3, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(202, 237, 24, 7, 3, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(203, 237, 24, 8, 3, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(204, 237, 24, 9, 2, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(205, 237, 24, 10, 5, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(206, 237, 24, 11, 2, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(207, 237, 24, 12, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(208, 237, 24, 13, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(209, 237, 24, 14, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(210, 237, 24, 15, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(211, 237, 24, 16, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(212, 237, 24, 17, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(213, 237, 24, 18, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(214, 237, 24, 19, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(215, 237, 24, 20, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(216, 237, 24, 21, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(217, 237, 24, 22, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(218, 237, 24, 23, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(219, 237, 24, 24, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(220, 237, 24, 25, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(221, 237, 24, 26, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(222, 237, 24, 27, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(223, 237, 24, 28, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(224, 237, 24, 29, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(225, 237, 24, 30, 1, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(226, 237, 24, 31, 5, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(227, 237, 24, 32, 5, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(228, 237, 24, 33, 5, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(229, 237, 24, 34, 5, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(230, 237, 24, 35, 5, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(231, 237, 24, 36, 8, NULL, 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(232, 237, 24, 37, NULL, 'adsaf', 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(233, 237, 24, 38, NULL, 'asadsfdds', 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(234, 237, 24, 39, NULL, 'sdsafdsgdf', 'submit', '2021-06-13 04:53:24', '2021-06-13 04:53:24', 0),
(235, 68, 6, 1, NULL, NULL, 'save', '2021-06-22 14:04:17', '2021-06-22 14:04:17', 0),
(236, 68, 6, 2, NULL, NULL, 'save', '2021-06-22 14:04:17', '2021-06-22 14:04:17', 0),
(237, 68, 6, 3, NULL, NULL, 'save', '2021-06-22 14:04:17', '2021-06-22 14:04:17', 0),
(238, 68, 6, 4, NULL, NULL, 'save', '2021-06-22 14:04:17', '2021-06-22 14:04:17', 0),
(239, 68, 6, 5, NULL, NULL, 'save', '2021-06-22 14:04:17', '2021-06-22 14:04:17', 0),
(240, 68, 6, 6, NULL, NULL, 'save', '2021-06-22 14:04:17', '2021-06-22 14:04:17', 0),
(241, 68, 6, 7, NULL, NULL, 'save', '2021-06-22 14:04:17', '2021-06-22 14:04:17', 0),
(242, 68, 6, 8, NULL, NULL, 'save', '2021-06-22 14:04:17', '2021-06-22 14:04:17', 0),
(243, 68, 6, 9, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(244, 68, 6, 10, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(245, 68, 6, 11, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(246, 68, 6, 12, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(247, 68, 6, 13, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(248, 68, 6, 14, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(249, 68, 6, 15, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(250, 68, 6, 16, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(251, 68, 6, 17, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(252, 68, 6, 18, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(253, 68, 6, 19, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(254, 68, 6, 20, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(255, 68, 6, 21, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(256, 68, 6, 22, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(257, 68, 6, 23, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(258, 68, 6, 24, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(259, 68, 6, 25, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(260, 68, 6, 26, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(261, 68, 6, 27, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(262, 68, 6, 28, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(263, 68, 6, 29, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(264, 68, 6, 30, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(265, 68, 6, 31, 2, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(266, 68, 6, 32, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(267, 68, 6, 33, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(268, 68, 6, 34, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(269, 68, 6, 35, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(270, 68, 6, 36, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(271, 68, 6, 37, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(272, 68, 6, 38, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0),
(273, 68, 6, 39, NULL, NULL, 'save', '2021-06-22 14:04:18', '2021-06-22 14:04:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `eval_question`
--

CREATE TABLE `eval_question` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `question_order` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eval_question`
--

INSERT INTO `eval_question` (`id`, `section_id`, `question_order`, `question_text`, `created_on`, `updated_on`, `is_deleted`) VALUES
(1, 1, 1, 'Has mastery of subject matter', '2021-05-14 21:28:15', NULL, 0),
(2, 1, 2, 'Explains clearly course objectives and expectations', '2021-05-14 21:28:15', NULL, 0),
(3, 1, 3, 'Discusses subject matter clearly and systematically', '2021-05-14 21:28:15', '2021-05-14 21:29:36', 0),
(4, 1, 4, 'Provides in-depth treatment of subject matter', '2021-05-14 21:28:15', NULL, 0),
(5, 1, 5, 'Relates course to other fields and present-day problems', '2021-05-14 21:28:15', '2021-05-14 21:29:36', 0),
(6, 1, 6, 'Uses effective teaching techniques, considering the total capacity of the students', '2021-05-14 21:28:15', NULL, 0),
(7, 1, 7, 'Encourages and respects new ideas and students\' viewpoints', '2021-05-14 21:28:15', '2021-05-14 21:29:36', 0),
(8, 1, 8, 'Stimulates students\' desires to learn more about the subject', '2021-05-14 21:28:15', '2021-05-14 21:29:36', 0),
(9, 1, 9, 'Gives challenging examinations and asks questions that require analysis', '2021-05-14 21:28:15', '2021-05-14 21:29:36', 0),
(10, 1, 10, 'Expresses and communicates effectively', '2021-05-14 21:28:15', '2021-05-14 21:29:36', 0),
(11, 2, 1, 'Corrects and gives results and feedback of examinations and/or other work within reasonable time', '2021-05-14 21:38:30', NULL, 0),
(12, 2, 2, 'Uses students\' achievements in class as basis for grades', '2021-05-14 21:38:30', NULL, 0),
(13, 2, 3, 'Maintains good conduct of students in class', '2021-05-14 21:38:30', NULL, 0),
(14, 2, 4, 'Comes to class on time', '2021-05-14 21:38:30', NULL, 0),
(15, 2, 5, 'Attends class regularly', '2021-05-14 21:38:30', NULL, 0),
(16, 2, 6, 'Maximizes class hour for learning', '2021-05-14 21:38:30', NULL, 0),
(17, 2, 7, 'Treats students equally and fairly; shows no favoritism', '2021-05-14 21:38:30', NULL, 0),
(18, 2, 8, 'Firm and consistent, strict but reasonable in disciplining students', '2021-05-14 21:38:30', NULL, 0),
(19, 2, 9, 'Encourages students to do their best to develop their potentials', '2021-05-14 21:38:30', NULL, 0),
(20, 2, 10, 'Gives and explains assignments', '2021-05-14 21:38:30', NULL, 0),
(21, 3, 1, 'Has high intellectual standard', '2021-05-14 21:46:51', NULL, 0),
(22, 3, 2, 'Is ethical or moral in the performance of his official duties', '2021-05-14 21:46:51', NULL, 0),
(23, 3, 3, 'Observes university regulations', '2021-05-14 21:46:51', NULL, 0),
(24, 3, 4, 'Has dedication/sense of commitment', '2021-05-14 21:46:51', NULL, 0),
(25, 3, 5, 'Admits mistakes and accepts constructive criticism', '2021-05-14 21:46:51', NULL, 0),
(26, 3, 6, 'Mentally alert and enthusiastic', '2021-05-14 21:46:51', NULL, 0),
(27, 3, 7, 'Employs wit and has keen sense of humor when the situation so demands', '2021-05-14 21:46:51', NULL, 0),
(28, 3, 8, 'Is approachable and pleasant', '2021-05-14 21:46:51', NULL, 0),
(29, 3, 9, 'Maintains poise or calm in different situations', '2021-05-14 21:46:51', NULL, 0),
(30, 3, 10, 'Keeps individual and/or group appointments', '2021-05-14 21:46:51', NULL, 0),
(31, 4, 1, 'Maintains cordial but professional relations with students', '2021-05-14 21:49:12', NULL, 0),
(32, 4, 2, 'Encourages and makes himself/herself available for consultation', '2021-05-14 21:49:12', NULL, 0),
(33, 4, 3, 'Elicits positive reactions from students', '2021-05-14 21:49:12', NULL, 0),
(34, 4, 4, 'Shows enthusiasm for and interest in student campus life', '2021-05-14 21:49:12', NULL, 0),
(35, 4, 5, 'Performs duties and responsibilities in school', '2021-05-14 21:49:12', NULL, 0),
(36, 5, 1, 'Taking into account instructional skills,  class management,  personal qualities,  and student-faculty relations.\r\n\r\nPlease rate your teacher by encircling, on a scale of 1 to 5 with 5 as excellent.', '2021-05-14 21:51:13', NULL, 0),
(37, 6, 1, 'My teacher\'s strong points are:', '2021-05-14 21:52:45', NULL, 0),
(38, 6, 2, 'My teacher\'s weak points are:', '2021-05-14 21:52:45', NULL, 0),
(39, 6, 3, 'Recommendation for improvement:', '2021-05-14 21:52:45', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `eval_section`
--

CREATE TABLE `eval_section` (
  `id` int(11) UNSIGNED NOT NULL,
  `sec_order` int(11) NOT NULL,
  `name` enum('Instructional Skills','Class Management','Personal Qualities','Student Faculty Relations','General Evaluation','Comments') NOT NULL,
  `question_type_id` int(11) NOT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eval_section`
--

INSERT INTO `eval_section` (`id`, `sec_order`, `name`, `question_type_id`, `created_on`, `updated_on`, `is_deleted`) VALUES
(1, 1, 'Instructional Skills', 1, '2021-05-14 18:41:33', '2021-05-15 16:17:39', 0),
(2, 2, 'Class Management', 1, '2021-05-14 18:41:49', '2021-05-14 22:16:22', 0),
(3, 3, 'Personal Qualities', 1, '2021-05-14 18:41:59', '2021-05-14 22:16:25', 0),
(4, 4, 'Student Faculty Relations', 1, '2021-05-14 18:42:15', '2021-05-14 22:16:28', 0),
(5, 5, 'General Evaluation', 2, '2021-05-14 18:42:27', '2021-05-14 22:16:34', 0),
(6, 6, 'Comments', 0, '2021-05-14 18:42:47', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `eval_sheet`
--

CREATE TABLE `eval_sheet` (
  `id` int(10) UNSIGNED NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `verified` varchar(15) NOT NULL DEFAULT 'false',
  `rating` decimal(10,0) NOT NULL,
  `status` enum('Open','Inprogress','Completed') NOT NULL DEFAULT 'Open',
  `created_on` datetime DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eval_sheet`
--

INSERT INTO `eval_sheet` (`id`, `evaluation_id`, `student_id`, `subject_id`, `verified`, `rating`, `status`, `created_on`, `updated_on`, `is_deleted`) VALUES
(4, 1, 68, 1, 'false', '0', 'Inprogress', '2021-06-01 10:28:30', '2021-06-24 19:52:58', 0),
(5, 1, 68, 2, 'false', '0', 'Completed', '2021-06-01 10:28:30', '2021-06-24 19:52:00', 0),
(6, 1, 68, 3, 'false', '0', 'Inprogress', '2021-06-01 10:28:30', '2021-06-24 19:52:00', 0),
(7, 1, 68, 4, 'false', '0', 'Open', '2021-06-01 10:28:30', '2021-06-24 19:52:00', 0),
(8, 1, 69, 1, 'false', '0', 'Open', '2021-06-01 10:31:12', '2021-06-24 19:52:00', 0),
(9, 1, 69, 2, 'false', '0', 'Completed', '2021-06-01 10:31:12', '2021-06-24 19:52:00', 0),
(10, 1, 69, 3, 'false', '0', 'Open', '2021-06-01 10:31:12', '2021-06-24 19:52:00', 0),
(11, 1, 69, 4, 'false', '0', 'Open', '2021-06-01 10:31:12', '2021-06-24 19:52:00', 0),
(12, 1, 73, 5, 'false', '0', 'Open', '2021-06-01 10:32:46', '2021-06-24 19:52:00', 0),
(13, 1, 73, 9, 'false', '0', 'Open', '2021-06-01 10:32:46', '2021-06-24 19:52:00', 0),
(14, 1, 73, 10, 'false', '0', 'Completed', '2021-06-01 10:32:46', '2021-06-25 07:56:20', 0),
(15, 1, 138, 5, 'false', '0', 'Open', '2021-06-01 10:33:30', '2021-06-24 19:52:00', 0),
(16, 1, 138, 9, 'false', '0', 'Open', '2021-06-01 10:33:30', '2021-06-24 19:52:00', 0),
(17, 1, 138, 10, 'false', '0', 'Completed', '2021-06-01 10:33:30', '2021-06-25 07:55:55', 0),
(18, 1, 77, 6, 'false', '0', 'Open', '2021-06-01 10:34:09', '2021-06-24 19:52:00', 0),
(19, 1, 77, 7, 'false', '0', 'Open', '2021-06-01 10:34:09', '2021-06-24 19:52:00', 0),
(20, 1, 77, 8, 'false', '0', 'Completed', '2021-06-01 10:34:09', '2021-06-25 07:55:48', 0),
(21, 1, 105, 6, 'false', '0', 'Open', '2021-06-01 10:35:04', '2021-06-24 19:52:00', 0),
(22, 1, 105, 7, 'false', '0', 'Completed', '2021-06-01 10:35:04', '2021-06-25 07:54:27', 0),
(23, 1, 105, 8, 'false', '0', 'Completed', '2021-06-01 10:35:04', '2021-06-24 19:52:00', 0),
(24, 1, 237, 11, 'false', '0', 'Completed', '2021-06-13 03:02:25', '2021-06-24 19:52:00', 0),
(25, 1, 138, 8, 'false', '0', 'Completed', '2021-06-25 08:09:10', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `factories`
--

CREATE TABLE `factories` (
  `id` int(9) NOT NULL,
  `name` varchar(31) NOT NULL,
  `uid` varchar(31) NOT NULL,
  `class` varchar(63) NOT NULL,
  `icon` varchar(31) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `factories`
--

INSERT INTO `factories` (`id`, `name`, `uid`, `class`, `icon`, `summary`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Test Factory', 'test001', 'Factories\\Tests\\NewFactory', 'fas fa-puzzle-piece', 'Longer sample text for testing', NULL, '2021-05-12 22:31:19', '2021-05-12 22:31:19'),
(2, 'Widget Factory', 'widget', 'Factories\\Tests\\WidgetPlant', 'fas fa-puzzle-piece', 'Create widgets in your factory', NULL, NULL, NULL),
(3, 'Evil Factory', 'evil-maker', 'Factories\\Evil\\MyFactory', 'fas fa-book-dead', 'Abandon all hope, ye who enter here', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `details` text DEFAULT NULL,
  `created_on` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `first_name`, `last_name`, `details`, `created_on`, `updated_on`, `is_deleted`) VALUES
(1, 'Roberto', 'Basadre', 'Sample details', '2021-05-18 12:45:01', NULL, 0),
(2, 'Nand', 'Fernandez', 'Sample', '2021-05-18 12:45:01', NULL, 0),
(4, 'Madam', 'La', NULL, '2021-06-01 10:21:20', NULL, 0),
(5, 'Miss', 'Jera', NULL, '2021-06-01 10:21:47', NULL, 0),
(6, 'Sample', 'Faculty', NULL, '2021-06-01 10:22:19', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(584, '2020-02-22-222222', 'Tests\\Support\\Database\\Migrations\\ExampleMigration', 'tests', 'Tests\\Support', 1620829879, 1);

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
-- Table structure for table `question_choice`
--

CREATE TABLE `question_choice` (
  `id` int(11) NOT NULL,
  `q_type_id` int(11) NOT NULL,
  `choice_order` int(11) NOT NULL,
  `weight` decimal(10,0) NOT NULL DEFAULT 0,
  `choice` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_choice`
--

INSERT INTO `question_choice` (`id`, `q_type_id`, `choice_order`, `weight`, `choice`, `created_on`, `updated_on`, `is_deleted`) VALUES
(1, 1, 1, '0', 'E', '2021-05-14 22:14:32', NULL, 0),
(2, 1, 2, '0', 'VG', '2021-05-14 22:14:32', NULL, 0),
(3, 1, 3, '0', 'G', '2021-05-14 22:14:32', NULL, 0),
(4, 1, 4, '0', 'F', '2021-05-14 22:14:32', NULL, 0),
(5, 1, 5, '0', 'P', '2021-05-14 22:14:32', NULL, 0),
(6, 2, 1, '0', '5', '2021-05-14 22:14:32', NULL, 0),
(7, 2, 2, '0', '4', '2021-05-14 22:14:32', NULL, 0),
(8, 2, 3, '0', '3', '2021-05-14 22:14:32', NULL, 0),
(9, 2, 4, '0', '2', '2021-05-14 22:14:32', NULL, 0),
(10, 2, 5, '0', '1', '2021-05-14 22:14:32', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

CREATE TABLE `question_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_type`
--

INSERT INTO `question_type` (`id`, `type`, `is_deleted`, `created_on`, `updated_on`) VALUES
(1, 'sc_alpha', 0, '2021-05-14 22:03:28', '2021-05-14 22:24:41'),
(2, 'sc_numeric', 0, '2021-05-14 22:03:28', '2021-05-14 22:24:50'),
(3, 'open_ended', 0, '2021-05-14 22:03:28', '0000-00-00 00:00:00');

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
(2, 'student', 0, NULL, NULL),
(3, 'clerk', 0, NULL, NULL);

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
-- Table structure for table `sheet_section`
--

CREATE TABLE `sheet_section` (
  `id` int(11) NOT NULL,
  `eval_sheet_id` int(11) NOT NULL,
  `eval_section_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `grade_level` int(11) NOT NULL,
  `rating` decimal(10,0) NOT NULL DEFAULT 0,
  `name` text NOT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `faculty_id`, `grade_level`, `rating`, `name`, `created_on`, `updated_on`, `is_deleted`) VALUES
(1, 1, 12, '0', 'Calculus I', NULL, '2021-06-01 10:20:16', 0),
(2, 2, 12, '0', 'Physics II', NULL, NULL, 0),
(3, 4, 12, '0', 'Economics', '2021-06-01 10:23:24', NULL, 0),
(4, 4, 8, '0', 'SocSci 12', '2021-06-01 10:23:24', '2021-06-24 21:38:18', 0),
(5, 5, 9, '0', 'Arts 11', '2021-06-01 10:24:11', '2021-06-24 21:38:21', 0),
(6, 5, 7, '0', 'Arts 7', '2021-06-01 10:24:11', NULL, 0),
(7, 6, 7, '0', 'Algebra', '2021-06-01 10:25:04', NULL, 0),
(8, 2, 7, '0', 'Programming 7', '2021-06-01 10:25:04', NULL, 0),
(9, 6, 11, '0', 'Lit 11', '2021-06-01 10:25:48', NULL, 0),
(10, 2, 11, '0', 'Java ', '2021-06-01 10:25:48', NULL, 0),
(11, 2, 10, '0', 'Python I', '2021-06-12 23:53:17', '2021-06-12 23:53:17', 0);

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
(691, 30, '2021-04-02 03:45:58', '2021-04-02 03:45:58', '::1', 'login', 'BC08nLu1VQ4ERFi73FFDzMYmrLcjyJUFdM36zGniMff3Icxy4b5eIhbkZyHDzaTDqeEEE4rjGZieDHfSZWzKU1ip9n9aQoybdM2g', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-01 22:45:58', '2021-04-01 22:45:58', 0),
(692, 30, '2021-04-03 09:21:44', '2021-04-03 09:21:44', '::1', 'login', 'MGibf3KU7dgaf3IJHXrSJNcWM4FBYZ3IfgXWe4LBfXSWTrhDjBxQB48lbSzuXNQNsb3LFinM8fggb58RnTKa2XgQmCRoRC0d7CbJ', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-03 04:21:44', '2021-04-03 04:21:44', 0),
(693, 30, '2021-04-03 09:23:42', '2021-04-03 09:23:42', '::1', 'login', 'AnO01BXQEa5qurrZD9t3OySvKQBGZqDAdGZZP9EYveXeBzY1AlAvVRn8eGh8ZpNbwXufsyXlsyfcLdVnycTv5YA9EcgkpyI3MI3M', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-03 04:23:42', '2021-04-03 04:23:42', 0),
(694, 30, '2021-04-03 13:04:23', '2021-04-03 13:04:23', '::1', 'login', 'k0rtWmOVjTr3YtdpW5vh751OFQ4BuxxcoAqBXcIjJvHnOjzV1zuXSDukYmwkihEpwd6Fo9ue5Urb6mCa8h82CypXRJ3rXmDSHQdb', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-03 08:04:23', '2021-04-03 08:04:23', 0),
(695, 30, '2021-04-03 13:15:21', '2021-04-03 13:15:21', '::1', 'login', 'G6ffWfnvtcP55ZNhqmuvBTt99MWJkqHrwWTFwb69s3BWfr5r8wwmI1rZtfWANkAXtdP1jlLrMktFkp4ohgKCb3p9zLmQD6HaNwFF', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-03 08:15:21', '2021-04-03 08:15:21', 0),
(696, 30, '2021-04-03 13:25:02', '2021-04-03 13:25:02', '::1', 'login', 'hOkzNpJvKYOo2hZM6OfN2yvkDsuTOJfVCDDQAX5ZcYvFMB7ST7N3Y1b4mkILrDtghxDx6VwtiLs8QaKDbqbBhmw8SaLratpDk2jZ', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-03 08:25:02', '2021-04-03 08:25:02', 0),
(697, 30, '2021-04-04 12:38:04', '2021-04-04 12:38:04', '::1', 'login', 'B9kc8AOkYhVVXpAyQuSy6SJ79888sE6BmJVUZMxqvDh8DLBzakjob4e5ySBDVPKdgEqddLqT5pTXdWfcBg7iaRHAqohsFvKCgWHy', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-04 07:38:04', '2021-04-04 07:38:04', 0),
(698, 30, '2021-04-06 02:49:19', '2021-04-06 02:49:19', '::1', 'login', 'SRtmn6GAKkG8nTCSkHwwMtow3LuTRSwCtUD1DnrY1QiJlDLAjrvi2facfNe9XtMbLYcNjrBIeNQCFObvzAExvxtcs50qBR5KNRAj', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-05 21:49:19', '2021-04-05 21:49:19', 0),
(699, 30, '2021-04-07 01:49:16', '2021-04-07 01:49:16', '::1', 'login', '5qLqlkWMXYoD2n70asV5QpkMhvYeVr7djPwXKEPGVRIhZUMWNaF99ywqNvaLEvLUWse0kXZCIlkHzIibyzwH9rzNoX4dmMjauRd9', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-06 20:49:16', '2021-04-06 20:49:16', 0),
(700, 30, '2021-04-07 01:57:14', '2021-04-07 01:57:14', '::1', 'login', 'clr2sHHjC2MULJAVsy1HMLaNuUWkwRoOGW9tytYmXN5w8unmDO90n3JInvSR5KkJ578EkHMKjnB622uccqIXUoAd61LcYzYO2X5Y', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-06 20:57:14', '2021-04-06 20:57:14', 0),
(701, 30, '2021-04-07 02:00:52', '2021-04-07 02:00:52', '::1', 'login', '86rIwvFVv9CYu8NC3snoiL7R7j3iItfhJ0AN1VAJavQ0pBqfhMEyXu1qyfoxC7hOmLXBAvU2LSvAuD0nh3aSUTJ6lyxwNd1orlxS', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-06 21:00:52', '2021-04-06 21:00:52', 0),
(702, 30, '2021-04-07 02:01:14', '2021-04-07 02:01:14', '::1', 'login', 'rpv5IkIbbnaDqEWTBdZ7Ckz6VaiHflhEdBY6peZ3KgoksmI9MiKXgeyY0goWn86FmGMLKf6c2Q40CUvZwWF1443skfA7E1oGINjT', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-06 21:01:14', '2021-04-06 21:01:14', 0),
(703, 30, '2021-04-07 02:06:04', '2021-04-07 02:06:04', '::1', 'login', 'mkQjwL8iSs6rKjTUNptPUtdvFpvDBA1CAa9lk3fvSZRHJJN7W8OrqjugsrrpFz2UfcrHH9oJ9rwEgOrqfmXmazDPJZ9AiMndjoTP', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-06 21:06:04', '2021-04-06 21:06:04', 0),
(704, 30, '2021-04-07 02:56:10', '2021-04-07 02:56:10', '::1', 'login', 'zL40WHxSukYjUXxxr28dPHkfMdmxIi8QQgCQIzZwoLSfLjfWGLBnwP82DEgzHlVUMWmXYobonz9XnoNp1tqMXwEmIm18sjM2DWh4', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-06 21:56:10', '2021-04-06 21:56:10', 0),
(705, 30, '2021-04-07 08:24:58', '2021-04-07 08:24:58', '::1', 'login', '1iyr64L0b06qmzQuXKawe1bmjJPijqXmQiF6p7omTVD8o24qtVKjlPLpgvlcTwwZ2XkqR6vY60FsaTtRT1u7x4uVoeRwIH1jxxEP', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 03:24:58', '2021-04-07 03:24:58', 0),
(706, 30, '2021-04-07 08:53:53', '2021-04-07 08:53:53', '::1', 'login', 'snICSwilQRDbIHUBuxjuX5NCFhudop24G7XQlA59D0hiMFWwPOu0F7PNxXPSnOZ3eHwXcLqswSwS9sWgRN1HlPSgf7exuvqV0F3z', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 03:53:53', '2021-04-07 03:53:53', 0),
(707, 30, '2021-04-07 09:40:03', '2021-04-07 09:40:03', '::1', 'login', 'crMVScG6K2azp3o8oHUqp7uVPo4MNx1w7Oke92fPSYy38edYI80nEKnWTGRGCqfoOHQgFWE2yv5u1BGD4oZYBgMlZhLfdVtTHxIQ', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 04:40:03', '2021-04-07 04:40:03', 0),
(708, 30, '2021-04-07 11:14:41', '2021-04-07 11:14:41', '::1', 'login', 'bnHTqYIuPEpJJTIcfbLEenbgeYXQejUtdao6XWIowIIgQrF1tBj1KTkaMN2rJP856SgyjhRIpkJewvlyPZIjPZAJSFp29AtHxelf', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 06:14:41', '2021-04-07 06:14:41', 0),
(709, 30, '2021-04-07 12:35:25', '2021-04-07 12:35:25', '::1', 'login', 'fXmSfa6TQnEr8Eikcg3wZzvZKwKWygJBKlxC9kJ9bPdCOr04OSDtqviKxzJzcf1Tgn6vlafOCVU5GfzFjEDJw3oRSaOEjHN4ZYKz', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 07:35:25', '2021-04-07 07:35:25', 0),
(710, 30, '2021-04-07 12:40:59', '2021-04-07 12:40:59', '::1', 'login', 'VGhrjCgosR7l7yF0wDtu1MgOoNXlRLBj23i3QFVO77A18DEshXtS7ePoa8MTHKetgDoWSstffbVX9YylOYnTuMmbuhyBFe8toM5g', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 07:40:59', '2021-04-07 07:40:59', 0),
(711, 30, '2021-04-07 12:41:00', '2021-04-07 12:41:00', '::1', 'login', '8aMt1oDyUmj2y6hgU6STHUA8tRnGqLvP8f2PXSzOQFooUOHs9RWMw2SjW4tbYphWazFJv13cOyH44bpsLrGS3uOfetay0jemsSS4', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 07:41:00', '2021-04-07 07:41:00', 0),
(712, 30, '2021-04-07 12:41:28', '2021-04-07 12:41:28', '::1', 'login', 'zIQjXu4SdbX4P7Us8GMK31mmPA4XfDrTqv8LTOuHNh2LxIwccICVSbpXhFVdoyy4wiHN8ofCoq3KXNZ0oPFNicbzORSowe6rge7D', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 07:41:28', '2021-04-07 07:41:28', 0),
(713, 30, '2021-04-07 12:44:16', '2021-04-07 12:44:16', '::1', 'login', 'bRBu7qZll5yoABMO3OWRshhtwojGsO2UxxKy9tVz5JONX0izENUrZQidOEFKPVbSf3NSlSuaejYrqKNvHLpRd94oaf3dtPvprZYl', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 07:44:16', '2021-04-07 07:44:16', 0),
(714, 30, '2021-04-07 12:48:37', '2021-04-07 12:48:37', '::1', 'login', 'yUVYuA2ymt84B9sKffQHqizlcBIJm2UaHttiD8GG9qNoOf1Q1F2DtMTiaOQryZcdqVt4ykVitjY53IGbysXH3mMu3b7Pb16StQel', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 07:48:37', '2021-04-07 07:48:37', 0),
(715, 30, '2021-04-07 12:48:56', '2021-04-07 12:48:56', '::1', 'login', 'CP6bujchGb5QXKEwP94n9NBeWKcIqSYuffv7w0W5qzLKce3Za7fVxPPwE5cbarlcvfyYKQjZAexoTct29Sf4f9HZG0p3z1ishF5R', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 07:48:56', '2021-04-07 07:48:56', 0),
(716, 30, '2021-04-07 12:49:23', '2021-04-07 12:49:23', '::1', 'login', '9nLo5CnL9q4GKMjEMFK5YRCItLwsqhXdMHUAlhvITjBKOA4omkAhP7uRFROTSn8rfFKgtINXzKvSpkc2de9inl8TmFUdOLDYJamG', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 07:49:23', '2021-04-07 07:49:23', 0),
(717, 30, '2021-04-07 12:50:24', '2021-04-07 12:50:24', '::1', 'login', '1i1awo9ldZMbHRlWAUys2jCpkyv8kFU7flRIWi7b5oGFVO4SJ5Zsu52Vo1S7zDAU1tsJg5rE1Rjeh0TcpuohoFgstSv7x5H02s69', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 07:50:24', '2021-04-07 07:50:24', 0),
(718, 30, '2021-04-07 12:51:26', '2021-04-07 12:51:26', '::1', 'login', 'antPQa3NfphBuuoa7RWQCIjZBaZyCGLyJs8rTb7BTKpB7t6SLLs0ln4P11ejJvaewOWLgOuDJDwjVjyiqEf1bHbZq7WrmcmcsVJJ', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 07:51:26', '2021-04-07 07:51:26', 0),
(719, 30, '2021-04-07 13:12:24', '2021-04-07 13:12:24', '::1', 'login', '0QYYmmDnCXZGCbJ0pnjKFOD3c5cvmtlScF7EC2qGL2vm4vzNwICukDZOHM7TZtdGFsWrUXquRsrT8C233eIjN4jCreZICWuDZdm4', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:12:24', '2021-04-07 08:12:24', 0),
(720, 30, '2021-04-07 13:19:25', '2021-04-07 13:19:25', '::1', 'login', 'PTft26hicr1SGVawBMNyLLwp9oHZ0HRI3LyR1IPK5SERK7Cj2bmwj4aYBmiinIpiB5BIXp7HDAxJg84MvWt6CMNMFDO0pNyyyKS7', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:19:25', '2021-04-07 08:19:25', 0),
(721, 30, '2021-04-07 13:21:42', '2021-04-07 13:21:42', '::1', 'login', 'twwZxerqg6QjcDw3GHIbIlPRXt48a43hE44zpIV3Q0WuQdNjthiVieqZKnyjDTwnx2NsEsjiX9QpD0s4cx76qB9ZxKpEDPYKzdu0', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:21:42', '2021-04-07 08:21:42', 0),
(722, 30, '2021-04-07 13:25:42', '2021-04-07 13:25:42', '::1', 'login', '19VX6M8eybE1LAeoa1keZLLl0VWB34FBvrlAbn7xCMqz7pcqVX0qUyd3WpVyeuvzoXITQkLuaRFQVWg6cRxt3qJR4eCLRs18bRQp', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:25:42', '2021-04-07 08:25:42', 0),
(723, 30, '2021-04-07 13:27:05', '2021-04-07 13:27:05', '::1', 'login', 'bXuNsoZLBrKFfGHNvQUQ4Ay8QVdte9ZqCic5UcDvwJjTLdn8hZxZsZlZ3VHxKTaBEzUJksqD3Sz4mYceAASQafrd4kiUxM9xY8Ma', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:27:05', '2021-04-07 08:27:05', 0),
(724, 30, '2021-04-07 13:31:15', '2021-04-07 13:31:15', '::1', 'login', 'eA4P6gh6DdIfChpFOrmWB0DzEfToVuw2y3NHpNsexOyJPmnz2RsFJPNlwglfjYywbBNv4P3r8CyxDUvCHUuXBTP2gLFSMMt2tsDJ', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:31:15', '2021-04-07 08:31:15', 0),
(725, 30, '2021-04-07 13:34:19', '2021-04-07 13:34:19', '::1', 'login', 'uQoaxalyXLUsJ0Drr4PrnqEWRQ5fQC5TcFDTMVHXMkyhBUTlc7qgDjpMRdLzZ2MsxYgySzNmFtJiDbzdoC59LbZavAdgte00jf8w', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:34:19', '2021-04-07 08:34:19', 0),
(726, 30, '2021-04-07 13:36:05', '2021-04-07 13:36:05', '::1', 'login', 'vNGYsc0h3531CAVcoMqnYnPwzRfcQSRoGEgzRGlil0p7ncVpZO9I4ZO95nbjSa15THvYyhpoiMnIbpCr9LW2jRbqMraMC1C54L8E', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:36:05', '2021-04-07 08:36:05', 0),
(727, 30, '2021-04-07 13:37:31', '2021-04-07 13:37:31', '::1', 'login', 'VIc81JXab9qDqmMHOw1kz2iBc2nbnXwMbfXSqyIF4ku3lGYiHOkyu0NbibF4xwy2molOi5V7TMWPKwYqeKRUodf2GcM2UckpxrTN', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:37:31', '2021-04-07 08:37:31', 0),
(728, 30, '2021-04-07 13:37:42', '2021-04-07 13:37:42', '::1', 'login', 'jCMd8tgvVmF02UhRmD8kpxY7fPeK10aHIt04RKE0vtFm8lytLrRNBdpFOKWcAQiijHaNM9jSZjJPojpOdT0kflCCQUwaXfpSHFGf', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:37:42', '2021-04-07 08:37:42', 0),
(729, 30, '2021-04-07 13:38:56', '2021-04-07 13:38:56', '::1', 'login', 'RlKSofDzyN1U9l3Wll2TwwjjTCrDulqcbifg8bFpziLrRN19TjuCbH1sxupUKtDd09EyyBjhQRtxkAeOpmGjEitkLTo1PZyGOcPY', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:38:56', '2021-04-07 08:38:56', 0),
(730, 30, '2021-04-07 13:40:12', '2021-04-07 13:40:12', '::1', 'login', 'j240IXqwp8OmKla9AJwACreLeuMw5G3UVGOEsz6d0bskUHIYUF9fQNLPyOZSrfjj1yAxaHA8ushjAYUzbGN1jvhdUG2p67XKpRR3', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:40:12', '2021-04-07 08:40:12', 0),
(731, 30, '2021-04-07 13:40:22', '2021-04-07 13:40:22', '::1', 'login', '0KoOTcKGWYPV4e9YKQ7OBvozbwzANwEJr8m8rRY2iaG2rvhxWQcn6ygL2k1IKernqLz4MC2sHQhYipG06IJk2hmNEiAxL8eMpkNw', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:40:22', '2021-04-07 08:40:22', 0),
(732, 30, '2021-04-07 13:42:27', '2021-04-07 13:42:27', '::1', 'login', 'fxkjDbVqKEGJV9rxfqoTNszYy7dR29vBifoHc8jf1ppfwMLEHWFAWjc6IIKHbvOlcXszkC3iwW76RJpFlQtBvI6iW38WjAwRjiMI', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 08:42:27', '2021-04-07 08:42:27', 0),
(733, 30, '2021-04-07 14:22:14', '2021-04-07 14:22:14', '::1', 'login', 'npHIXfLc2kJX3CP2JMVpgqAan0QtsAxvx1DAnBKE2Njcb2HaYKAcJOsClRWhJYRidEU5Al3zniKwFcMHXM9HKURC0VOv2Sm8wDvv', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 09:22:14', '2021-04-07 09:22:14', 0),
(734, 30, '2021-04-07 14:32:29', '2021-04-07 14:32:29', '::1', 'login', 'ERSpTT4MFiGQyKeWDqm8gXpcXXxwTe6NzQXHbBOmLk9SZuIJdJRVonxxx8WV7yiNJDGeTCObviWmURCwawLytKIVqQO1PFdODsYT', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 09:32:29', '2021-04-07 09:32:29', 0),
(735, 30, '2021-04-07 14:49:52', '2021-04-07 14:49:52', '::1', 'login', 'VB7s3zkKev7nWO8jUVu3o8Cq5rosL3nH0HirEYBw528NSIwn3kwOw1WQRSTnmuWBQ9uZ00PkzgucEV1BNie44QWT4Sjl9rMHy08r', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 09:49:52', '2021-04-07 09:49:52', 0),
(736, 30, '2021-04-07 15:01:31', '2021-04-07 15:01:31', '::1', 'login', 'FPIqnYOJUrZ3BNhFRdyTrUKok2G6Swnybwepp0dli8l6RuMHHRgBDELwpvw2IS1avSWTN6jyWxZ0qZOU9KnVNHQ4DYG4Urpvjqlz', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 10:01:31', '2021-04-07 10:01:31', 0),
(737, 30, '2021-04-07 15:03:54', '2021-04-07 15:03:54', '::1', 'login', 'eHL9h7RpEu1nFVXfmzXJkBqYtqPz17qwBUwK92iO1mQD3gbMm9MV5Hio6HfVIw1vixUoTNUohfQz4GkdKpEfY3TEmcXOBurEgscE', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 10:03:54', '2021-04-07 10:03:54', 0),
(738, 30, '2021-04-07 15:12:57', '2021-04-07 15:12:57', '::1', 'login', 'xmPFmjw7q9hd9jqFrv3AzoaL0zL7jak7CHmStgreYm3gvsEuWlRPXkxYs8lTOEbj6IdZd3ShIZeM86jBRlIhqn4ICREeMDXz9qMV', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 10:12:57', '2021-04-07 10:12:57', 0),
(739, 30, '2021-04-07 15:17:26', '2021-04-07 15:17:26', '::1', 'login', 'JYwBHXoTvy1cWVQwjqm2fIiSwRcx8NMkQWzphEJoA2EbPucksMJlkWh7kEWGYmCZA0dYbCLaKp8YzHNQ5nm5bh1HLNa4ysWb0Byh', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 10:17:26', '2021-04-07 10:17:26', 0),
(740, 30, '2021-04-07 15:31:48', '2021-04-07 15:31:48', '::1', 'login', 'oMn911PSrtdIoD4iknzdit0TpF3yN4LbauW3yJUC03ydL4OmqSExs1WRVlhSbfaXWlvvKQqeni3N0J5QgFonMFO1zugf50rmJpUi', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 10:31:48', '2021-04-07 10:31:48', 0),
(741, 30, '2021-04-07 15:36:17', '2021-04-07 15:36:17', '::1', 'login', 'EntaKAynB2VDLK5FJCz8P1gj9LjRR1zMRPXTsS9LZGjCXwcifVXYvuTa14ZoElcfljwVBx0mT4bLCC8atvuSX915Ms5Kv3FD0zmv', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 10:36:17', '2021-04-07 10:36:17', 0),
(742, 30, '2021-04-07 15:37:13', '2021-04-07 15:37:13', '::1', 'login', 'bHsAF4iH5x4EsbUFgIRHQitDgiynCXlHZlBwYmer8FWj1xxOYbcXJYsDC3IyDrtDrwZS8KlBBFDO6ltTNVAt3oTuJuVS2ezsLYKq', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 10:37:13', '2021-04-07 10:37:13', 0),
(743, 30, '2021-04-07 15:37:43', '2021-04-07 15:37:43', '::1', 'login', 'qFzpMXCz57t0LqD1YMdYAkJ16jGJzDaHFLJvqYDraAnGWJww7nARvM0QgoLuk6dyDcsosvoujuFV4tos0y1IXHkDe5kCV2WkcWzM', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 10:37:43', '2021-04-07 10:37:43', 0),
(744, 30, '2021-04-07 15:40:58', '2021-04-07 15:40:58', '::1', 'login', 'bc1hhMX8iqE8dL8fqIAPPh8Ths5I49JUDLts3RKUtBY9sZlU2aiqKEGqcduwWBWdpICsjiHpr22ZfnBo2yDOofNVRXjNnH7EOKZn', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 10:40:58', '2021-04-07 10:40:58', 0),
(745, 30, '2021-04-07 15:41:38', '2021-04-07 15:41:38', '::1', 'login', 'DZNqh70hYXZ8JesQyd8NuawT8CdrISkPQ93RcL4oHw4r40KZm3a64J7kEYvvWCpczlS7Ig22vuexMvfXSItJg5ET67oZaoAsgs0d', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 10:41:38', '2021-04-07 10:41:38', 0),
(746, 30, '2021-04-07 15:49:45', '2021-04-07 15:49:45', '::1', 'login', 'XGEDGLtxFjCai3pYyir1dptzPUjjyUcfoMkUUxmMaJ1fBDT5tJNCrxVNwCuIByGfMPzu2BpvogMHkaOzUVeDGixvsApCfF8NJjaO', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 10:49:45', '2021-04-07 10:49:45', 0),
(747, 30, '2021-04-07 15:50:24', '2021-04-07 15:50:24', '::1', 'login', 'sCPwdcz7HuXVtDSBWWwXqoBLJsNANRVGojPrHcz4v7TbTE4KAxt0lC4PPEdO3WRwhLMdrn4CexBPlM5G0OJXoplYg8YrSIsNZBy0', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 10:50:24', '2021-04-07 10:50:24', 0),
(748, 30, '2021-04-07 15:57:14', '2021-04-07 15:57:14', '::1', 'login', 'Jn5OXNNr2pR4JnCU9uFQMSgBCJoHv0uylEjSMksnysqARceBafG8ALGAakhB0RwMyKt5Ppslbxezaidu2jJqJHfHpapiWMRepned', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 10:57:14', '2021-04-07 10:57:14', 0),
(749, 30, '2021-04-07 16:14:11', '2021-04-07 16:14:11', '::1', 'login', 's0h47OovsqhgqzHNinLnJAlnXsjrqAaFVXvBh09zBVE0Sv560tgyCPXG8eWuBV9UG5IbXhtSVXrnPct19nEA93RLODy22hYoRZFU', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:14:11', '2021-04-07 11:14:11', 0),
(750, 30, '2021-04-07 16:17:47', '2021-04-07 16:17:47', '::1', 'login', 'XivgX5pq6XIoqiUs46E9685c4i3cCgAyUtIAWcrmM6Kt9K5wreoqw1CN1Pxi0ITDhcNc92wILGWyvIDot1ahT0qLeiDGEIKnRVtp', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:17:47', '2021-04-07 11:17:47', 0),
(751, 30, '2021-04-07 16:19:16', '2021-04-07 16:19:16', '::1', 'login', 'HhMYgM0tj04PQmDzvgGoDozZWjbjodSIpeANSIyW9bWqOvbMzL1c7wmbn7xdl3D1QOCpmc5imxYVWZcFANWZtcTQM6CS93yF5VQQ', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:19:16', '2021-04-07 11:19:16', 0),
(752, 30, '2021-04-07 16:21:04', '2021-04-07 16:21:04', '::1', 'login', 'D1to5XbYJakaHw80z4XxCZnN2KuIH3P7heOUZEfdYixPQKW3pEN1TSAXb5aTYj1McO8hx18fLTY1og7qjc6dNkTI5hnM1UhBe4QA', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:21:04', '2021-04-07 11:21:04', 0),
(753, 30, '2021-04-07 16:22:05', '2021-04-07 16:22:05', '::1', 'login', '6ZZfqKcemF1Nil307dsFs1ayxQS6JUROjnKQHny1Cv2dTZz5vnRKMoQag0ETue9rj4zpecjv5r0LZI0uAtOxSg82AQdsgpbR86xx', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:22:05', '2021-04-07 11:22:05', 0),
(754, 30, '2021-04-07 16:23:20', '2021-04-07 16:23:20', '::1', 'login', 'Zou2Q4OkDULLqWUzGyM0VN7Gew81E52svnQBIMrF0vbIa4QPexEnGTXlZdCDYxBsjybTqN5k6Cl77bk0Nx5FTjYKOS1ggbfX3CYI', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:23:20', '2021-04-07 11:23:20', 0),
(755, 30, '2021-04-07 16:23:54', '2021-04-07 16:23:54', '::1', 'login', 'SL7cHCzY3YQH3efXE7NWRjOqy9aIi9nqjdxKox6D44sMU4rRHYAQRl0BI7bbU4UgiaEQEy4PfhYQPW2nAHaCCfc6dzmhCMXCcyYN', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:23:54', '2021-04-07 11:23:54', 0),
(756, 30, '2021-04-07 16:24:06', '2021-04-07 16:24:06', '::1', 'login', 'xITVEE1aLeK8ixWSN3YKfJlSjMCXjODTGtL9GiBijjT08bs8xa3vdtsSJKwlvGcoP78PiXWmTK7SfPmMamo2yVJXIkXpdyIvGRdf', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:24:06', '2021-04-07 11:24:06', 0),
(757, 30, '2021-04-07 16:25:18', '2021-04-07 16:25:18', '::1', 'login', 'DJSsgWzfE79bWhke6LCIe4hVy4VRqFqvMgYsSlJvg1KPvqDRX1JaegB7592NRh47a8xEHpdB6bCYK0cpH4mDXNvg0a77MRKG00Sh', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:25:18', '2021-04-07 11:25:18', 0),
(758, 30, '2021-04-07 16:33:47', '2021-04-07 16:33:47', '::1', 'login', '5iTzSHmDBJ0ZCKTlGhCy6qsbnEIgsjCZmaRPCkwCo60mVyzrOl4aVaAM1EkVg5jBS9m5CNmWiZ950pwvSOsA28Aecwje1pohWy1z', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:33:47', '2021-04-07 11:33:47', 0),
(759, 30, '2021-04-07 16:35:43', '2021-04-07 16:35:43', '::1', 'login', 'uWoNH9uG7zeQzd70WwXebVcafjH5E6Fsr7E2WBlNdB8M51pJZpVSjEbBZS0c1hUFzE52jW1ExIf19VKJQSD2JMv5H3LTCwqZpFLn', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:35:43', '2021-04-07 11:35:43', 0),
(760, 30, '2021-04-07 16:36:20', '2021-04-07 16:36:20', '::1', 'login', 'LIKLq5ReBSciMyMvaQsyFWUi4GmoImbkJHVgxsznMzWvbErF5Exj6CsOMJtgz6IWHCdmHGVPPZlUk1cSfzlMZCTsRunVXSU0V9lZ', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:36:20', '2021-04-07 11:36:20', 0),
(761, 30, '2021-04-07 16:46:34', '2021-04-07 16:46:34', '::1', 'login', '5Dd5GaTJlmELdWJZJ6BoQ85OrAXNAL4MgfQxms3qGFphMHKdhSMuzXThFDzegwNKVZhh9wvmIPxo5ekrHIdIbIQAZ6r4cps3LzxR', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:46:34', '2021-04-07 11:46:34', 0),
(762, 30, '2021-04-07 16:49:09', '2021-04-07 16:49:09', '::1', 'login', 'Qh19oeSx6ms3ZeOTzTzrDDVHpGqvoMwk0Bcbq8Q4oP4icKq6VKr0qawjiKoK43ho1NBKblEt6u98aTV0l9NQzdxsFCv5Iff58Shx', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:49:09', '2021-04-07 11:49:09', 0),
(763, 30, '2021-04-07 16:59:04', '2021-04-07 16:59:04', '::1', 'login', 'U5VQKU5DLxVVAalhZCvnTdXmV4e0HM8mRP65bu1CjcFrzkev1SiA8VRNb8XjouKDwPAf3HdPUSunyQcVrwOXBVz8l2APyFrS0J2t', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 11:59:04', '2021-04-07 11:59:04', 0),
(764, 30, '2021-04-07 17:00:20', '2021-04-07 17:00:20', '::1', 'login', 'O4qaG6PIdoJTauPsuC0t4tIxZgr9vdNM5PSynwO7N7zRbOps0oQlgAAygDgPxDp5ehAZZm7rzECeE8tAfEZhcDxOU6E0Fm3iFH0c', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:00:20', '2021-04-07 12:00:20', 0),
(765, 30, '2021-04-07 17:04:51', '2021-04-07 17:04:51', '::1', 'login', '45In1I8HcP7pKr5DPEbrWkCLduub6eXuAlxAe5NVrghaH7PiY2ltGtHhLDgq081kSZ3EelgjCjegRYJuuiSNrXJ37wNDvcBzaO1A', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:04:51', '2021-04-07 12:04:51', 0),
(766, 30, '2021-04-07 17:06:16', '2021-04-07 17:06:16', '::1', 'login', 'gW7IyaRvZBRUR9IrDIFloh1Po2BpWKInum4unvi1u7f2PozFeWOanbWfDZdDWWjb6JTrHFLfp06t20GDRHofpTcY44REXFLYcQnW', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:06:16', '2021-04-07 12:06:16', 0),
(767, 30, '2021-04-07 17:06:41', '2021-04-07 17:06:41', '::1', 'login', 'PEJjrnNZ84xaRMJUpUZjpiiA2YyQo6fWkbiKNxS7RclIx48SDLXy1ndFKNPo9zBlprCkxAov0eVBSpThtNFv0fmkHgqICIIYSM5c', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:06:41', '2021-04-07 12:06:41', 0),
(768, 30, '2021-04-07 17:09:55', '2021-04-07 17:09:55', '::1', 'login', 'oFwoDGK4DFxJI3Xv5sATi8jfiBnmRK6k4SpAEusrliPGBIWAbjFGNGkkBhfj3qqOXBqAm2hTKBbaX9LqiOhQoGXOi9hwQWmQBOgO', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:09:55', '2021-04-07 12:09:55', 0),
(769, 30, '2021-04-07 17:10:20', '2021-04-07 17:10:20', '::1', 'login', '4NQikFBYttfrky5bgcKdX2dJXHRCU5DzsgTGNMePlVWvqurznLF8GVW5fKGQxsGJ15r8YZlVx7PoIOGG9CpEQ9Nknn7JV34JNx89', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:10:20', '2021-04-07 12:10:20', 0),
(770, 30, '2021-04-07 17:12:06', '2021-04-07 17:12:06', '::1', 'login', 'KdpNlXZ12iihawaGHSsK1ozC5KqHyq767D7vDjQrvsYUQe7SHRhiloL4vYesyjfHLEPeQyNTFQd7mVOJ55W3i60X6vcqnTwonfr7', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:12:06', '2021-04-07 12:12:06', 0),
(771, 30, '2021-04-07 17:12:32', '2021-04-07 17:12:32', '::1', 'login', '1enLFwVKOkRIolKi0AWCQ7LA5ChI59JTOrI2lx8toamvt9FNKVYc1LQpKE8OAuSgmTieMEfBEhSR9c5XcUpDFwLwu9OAi2ZN2KdO', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:12:32', '2021-04-07 12:12:32', 0),
(772, 30, '2021-04-07 17:28:45', '2021-04-07 17:28:45', '::1', 'login', 'J2S4JkMEXmHaWCddRSVEMX1LGlZ24FUSueUlvcOv6GF7UPyN9EsfRTFI1rzxIv7QFOAFaO0YfoAafozgSxrKnZqKNyuTrKOlWrb2', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:28:45', '2021-04-07 12:28:45', 0),
(773, 30, '2021-04-07 17:29:43', '2021-04-07 17:29:43', '::1', 'login', 'gDrsoRI7exWo8yhgYKcHuck845nSxgIqvveNxmPPatUNxFsB5q4zu2PNrAuGuS7c1kT9QxuH325vGRqD5ZAObclm1poSGcRMtEcH', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:29:43', '2021-04-07 12:29:43', 0),
(774, 30, '2021-04-07 17:30:23', '2021-04-07 17:30:23', '::1', 'login', 'lbwze4rhGI2og32aR2g9Z7UrOKgDHarEEJ7tFanu2L8ZChL2vcW3uaYSbh0KLHngu1YvmMTYvHSgr3LHrR6qiWxiZxBD6C0SkRif', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:30:23', '2021-04-07 12:30:23', 0),
(775, 30, '2021-04-07 17:31:00', '2021-04-07 17:31:00', '::1', 'login', '0V7tVHIbEmopGQKgQqTQjEMSsIEmCnq0ionTGT8dK3RcuKTwrChffl5YlQE3PNqbcQrIwcjBvcXtzax4adjJPmExDE4FLopnEYYi', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:31:00', '2021-04-07 12:31:00', 0),
(776, 30, '2021-04-07 17:31:10', '2021-04-07 17:31:10', '::1', 'login', 'g1UZQBDuE4qzHTmOfOVRU32SlLBcx6L6Uh7pBgTsuJUcM5nlKC5M1TGkzMo2ldslWiMugQLTh8qBoXdNQarKFD09kUOjvWd7Zuox', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:31:10', '2021-04-07 12:31:10', 0),
(777, 30, '2021-04-07 17:31:46', '2021-04-07 17:31:46', '::1', 'login', 'daep6i4V6A5qSarGQTR350VdpZcfiuA27PH1vnyyHcDayJdRTxidi5uVZ0fZrGiCOU4yEe4bPETd53smD8ejQUQmmkQiLJmTEQb8', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:31:46', '2021-04-07 12:31:46', 0),
(778, 30, '2021-04-07 17:32:11', '2021-04-07 17:32:11', '::1', 'login', 'hFW41W1xRG8bO0OHIyDNJpPULdrupUi5MLGPGDFqv2lSdQ9hqeCnWzia9rJqGAKD8yg8xGgunqwig7WOqbfJN4z1NiT08GWLoIwR', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:32:11', '2021-04-07 12:32:11', 0),
(779, 30, '2021-04-07 17:33:14', '2021-04-07 17:33:14', '::1', 'login', 'zlq3xPoH7c6WRyjFEkkhY1e9ed1cQ7rshVH7ktX5uEZbGrhVZYqeENM5wg9Dsq9TJGEccq8LqexdaFfKSnG2mzbqwhxwbdedn16x', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:33:14', '2021-04-07 12:33:14', 0),
(780, 30, '2021-04-07 17:48:52', '2021-04-07 17:48:52', '::1', 'login', 'pPFBEAfoNQOycnD6y0Ekaclb2x81PxV7q4n1dSCmnJfVuG2NgI1cuS3OYUyEEdH85DloW3tfJlAoJ0iuz5Lff279WdgpRKxvFNjb', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:48:52', '2021-04-07 12:48:52', 0),
(781, 30, '2021-04-07 17:49:16', '2021-04-07 17:49:16', '::1', 'login', 'jgo2rqtXptQ6FDz3hAaOTxA8sRlOBL9wq82d5QrLAvoLo5pC827FI5aM2LpEGNjWqFquS1KWtIUh49wVsRgJFSsoFltYVsjr5zgY', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:49:16', '2021-04-07 12:49:16', 0),
(782, 30, '2021-04-07 17:52:36', '2021-04-07 17:52:36', '::1', 'login', '98uAekre5iXCobvLcSs2fLKXgdliSxRk8K8aEGQ34V7rMbBcyGe5CmIarFjtMpmi7ivk9BOlfEoPtA0f7fYV38XYwb4VKW1sNrjr', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:52:36', '2021-04-07 12:52:36', 0),
(783, 30, '2021-04-07 17:59:29', '2021-04-07 17:59:29', '::1', 'login', 'SBLIC0QrBJU0ItssX9eTlWfMzl5gK8JZhKQXZqrolBFAHJuPNHkfwiE2mbIFUMOLTkges78rKMzDFwWBp0Trb5N5aKhWf6DSidpk', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 12:59:29', '2021-04-07 12:59:29', 0),
(784, 30, '2021-04-07 18:19:21', '2021-04-07 18:19:21', '::1', 'login', 'kIw9hBExBou9okEKt4Zcs5urF3ygy9eBrV2cmS2EHyc9Z9uCuWwJ1vuQpkTsY04L9AzCtFm5KTIOxXQpkHZJIc2yHFlljQyLNmR9', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-07 13:19:21', '2021-04-07 13:19:21', 0),
(785, 30, '2021-04-08 05:15:36', '2021-04-08 05:15:36', '::1', 'login', 'TfkfshgYj2JwAabirCEfzCmkXEP2IMXqPrXtDlBYSw9Vh3bmRZLZAqPKlBOt29geBo3OJzHiBMpSnlq2ChTUGHG6ygZo2WE30VGH', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 00:15:36', '2021-04-08 00:15:36', 0),
(786, 30, '2021-04-08 05:16:44', '2021-04-08 05:16:44', '::1', 'login', 'KLcp5HbbA1oir7e5OwNEMoMVMWfB4rBKMGMsZeukyb5sIliOJWGlvCWJhJR8tPEBMXLUKv6R6Kse8fSR4rOns38orGNGnXfXQP0d', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 00:16:44', '2021-04-08 00:16:44', 0),
(787, 30, '2021-04-08 05:17:35', '2021-04-08 05:17:35', '::1', 'login', 'Sx6CRcYZQXI7kMxk3jC7MKqiAMDEK2SERIJCmvEzieEOQlF3ma4tsi6j496iibVoTjCynIXJvw0WKrI70FIVKb2xXXmhUmUVaVHy', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 00:17:35', '2021-04-08 00:17:35', 0),
(788, 30, '2021-04-08 05:33:22', '2021-04-08 05:33:22', '::1', 'login', 'Ep7mH3KeWATcLyUnSe3flSeA2WBjEL1ShsPcxLbPfQx6c6aCmGZfIfFGuhImnehk8x8e2kv5m6Evun4Mht2sVNZNqneDg2k8DwDt', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 00:33:22', '2021-04-08 00:33:22', 0),
(789, 30, '2021-04-08 06:01:53', '2021-04-08 06:01:53', '::1', 'login', 'OqC198jWaeLW8qzV1IozqvfxJ9vmnoKHLMyHaUrWYXCDO4Upxu4YdHZRIF3QZzllrSB4qEMPeTNNj4ZalVLJg9efEUt4PGOG73S9', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:01:53', '2021-04-08 01:01:53', 0),
(790, 30, '2021-04-08 06:06:06', '2021-04-08 06:06:06', '::1', 'login', 'DwjEiuK5CbyQy47h6Pv9O81usfQ3LTd4gZo0zPMd2funitLh8DskiGpbRpZVdCwn5jGqQPzUb7Efcl8FBb8zMVbIzdXLRAyYg2bj', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:06:06', '2021-04-08 01:06:06', 0),
(791, 30, '2021-04-08 06:07:38', '2021-04-08 06:07:38', '::1', 'login', '02v1WODkgb7gxsx1dOErSNYGrwQEewWYjb1MJZw266TvqIgSvHKXImkRzUOZJJtCOAVzh71Aw8T1AS13YzBdjwWQ7JdhbNps0eeV', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:07:38', '2021-04-08 01:07:38', 0),
(792, 30, '2021-04-08 06:08:00', '2021-04-08 06:08:00', '::1', 'login', 'lmEvVOCri3oSUpCymDuGqFeyfPZmXDe8Yh8RnvKkW4B86p42yNMHXYZMCd9AGygw3yMiNPGZ3yqODZqObEFLzAoqPBbb5EvyRYcM', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:08:00', '2021-04-08 01:08:00', 0),
(793, 30, '2021-04-08 06:08:21', '2021-04-08 06:08:21', '::1', 'login', 'g2vllfyLbFdb0Jjp9cj2JiaOv15mjF347pmreNgzHRtpDzyX41wvBGnDnMxpGMXl6SPqeWCrBuWIB3FCsyvOqaWwKm5DseNT8kPk', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:08:21', '2021-04-08 01:08:21', 0),
(794, 30, '2021-04-08 06:09:26', '2021-04-08 06:09:26', '::1', 'login', 'ZghDsz5LmYhNrpTUSRkJlmFAGgB2J9JlVYe7bHxxooeP4sRJde2BTa2uSpJMzCR1l5KCCPCZI0rcxbarOonx4VJJh6X94ZTOQay0', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:09:26', '2021-04-08 01:09:26', 0),
(795, 30, '2021-04-08 06:09:50', '2021-04-08 06:09:50', '::1', 'login', 'xrnx9fCBNj4y1PElF67t0X6f2fkcb0t2W4uwffOIERkUmhoMSOaFJCFrstu8t9KDCR60zTjtwNoipe22iseAPE1DLraQKui3OrM1', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:09:50', '2021-04-08 01:09:50', 0),
(796, 30, '2021-04-08 06:10:28', '2021-04-08 06:10:28', '::1', 'login', 'IabZOoNN3rDUNCYeFehoJMgSzhFdHcDUeREbzoSbR5ODb2XsWwGjRUsTend1OfHE9eOofR14LS5CjPB760TqTTqwegqHu8YYkpkS', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:10:28', '2021-04-08 01:10:28', 0),
(797, 30, '2021-04-08 06:10:58', '2021-04-08 06:10:58', '::1', 'login', '9DO95ztA9ZMhwMiLO84PoUMokeKWCWWcMTS9CbyeS6r9cN1lKVenC5bom1mXIcY2VZzXr83U7e9iNtwYQHEemTLXZbmGKRyFvV9i', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:10:58', '2021-04-08 01:10:58', 0),
(798, 30, '2021-04-08 06:11:05', '2021-04-08 06:11:05', '::1', 'login', 'vJTxufs6UIc9tr2tNwqICsXu6WgNnVdPSTI0gdyWO0KRFgBaIQngUsmJHxcbypMer7QtbfbgnyKgV2xmvxgQvBxwxeL2CysurHqo', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:11:05', '2021-04-08 01:11:05', 0),
(799, 30, '2021-04-08 06:11:15', '2021-04-08 06:11:15', '::1', 'login', 'sIqqK0IjkoVAqMWL16WYow6HtBybNgvXeRaZ4XnPLN4fEAE7YUPvuctyAJrak7dKGSHrSMATtdnXqQEORCWSWYULLf9mtZOumddj', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:11:15', '2021-04-08 01:11:15', 0),
(800, 30, '2021-04-08 06:20:18', '2021-04-08 06:20:18', '::1', 'login', 'zXWBHZnZIkl78rDLE8EJymA05dYXG3ZBMScKK3wDbn3kf2sC8HdwdVnQGUp3Qx4NKnFDPfoACVc0okh7x4gN9YrfWS36DQJehr1U', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:20:18', '2021-04-08 01:20:18', 0),
(801, 30, '2021-04-08 06:20:35', '2021-04-08 06:20:35', '::1', 'login', 'UuwPu7Ium4gx8BR6dJqXZ73fz3tes8qzT8prMcRiSLaAghpj8RrHnEcNjxtJ0BcXeJXagBB5EWgXHd8tVWkVaWjPwBtfZD2I61W7', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:20:35', '2021-04-08 01:20:35', 0),
(802, 30, '2021-04-08 06:20:44', '2021-04-08 06:20:44', '::1', 'login', '5PIvAhOC2oNB5hdfiPHix26RPgjsWtwCEsjDfpSjXZSiY5lZIJJdLSv1QpQc1eCYFi0d8qgBRbKCnynCAl02KGleyjoBXR0m3EFy', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:20:44', '2021-04-08 01:20:44', 0),
(803, 30, '2021-04-08 06:23:40', '2021-04-08 06:23:40', '::1', 'login', 'pR8xazLPiaBytn6nIZVNENA2QPVWLcJXVOiEKZXbybvMwaqzAvAIQM3X4aIMp7KL3oHLZwgDUcc0aLLBsLzoxoJHWNKDkSPsaM2b', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:23:40', '2021-04-08 01:23:40', 0),
(804, 30, '2021-04-08 06:25:15', '2021-04-08 06:25:15', '::1', 'login', 'u4uGG406qMwjaYdIrlEI2LIO31OjHHAGeztnBnwXwuX8bw5XCMqV3H86xVquWBNnb1vE1WMHAU1KPicFKigh20pG2mORIVJixvYy', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:25:15', '2021-04-08 01:25:15', 0),
(805, 30, '2021-04-08 06:36:31', '2021-04-08 06:36:31', '::1', 'login', 'TdahGG5DRaTPCH2WefROmx49jW2onqPCwLb2Kie9SYPEq4KOaau6Xs4ExxkyYMuoq282ZLJspJuowlI8jvsnlBHQnnfiJ8gWS5Wt', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:36:31', '2021-04-08 01:36:31', 0),
(806, 30, '2021-04-08 06:38:16', '2021-04-08 06:38:16', '::1', 'login', 'h3ztVErjAoxIX34R942OVvNx8w06EzJfWGqVgTvYeAzOCZrw1b2gZKPEHjtn9xXgWF30Q20xXyCZzuVlGgl8577QOXPx3RmZlkVl', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:38:16', '2021-04-08 01:38:16', 0),
(807, 30, '2021-04-08 06:38:33', '2021-04-08 06:38:33', '::1', 'login', 'b1GDfuBAVZbfHK1xEqJOzc3WSh4s6dsa2z0Ec0dHdEDwNQqJr9aS7qVRnlm4TyoSP8gGeFMRFMAmwwS6tfY1h2k2snlrdzFy7stG', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:38:33', '2021-04-08 01:38:33', 0),
(808, 30, '2021-04-08 06:38:50', '2021-04-08 06:38:50', '::1', 'login', 'UF38KtHXU8lgZgVqCUIThvtNedxV4s3UVAfAdGEYJxtF0eRSipgUXCON6wzDuFXNPtc1mrx9O07lqoUAqo7UI38AFUvt2j3rFKUo', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:38:50', '2021-04-08 01:38:50', 0),
(809, 30, '2021-04-08 06:39:56', '2021-04-08 06:39:56', '::1', 'login', 'KU3FWCIJLvaZihv7X5rVgbNtssSgFEwXU0ajARlExKiUCxzjP8PdG1TRXIFKV6vEXIGMQTBEoF9HrUKb29lP3vJZywOioGCF52Y9', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:39:56', '2021-04-08 01:39:56', 0),
(810, 30, '2021-04-08 06:41:09', '2021-04-08 06:41:09', '::1', 'login', 'xxJHEzpFhyCMholuiJ8LoOGgcZk7x8dQiyC18HTNzGiBdK0xp2IRUVKlTLGGeEkpoXr18uikT1Mb13AbgUs9k3ZSJgGa2AtVnsIW', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:41:09', '2021-04-08 01:41:09', 0),
(811, 30, '2021-04-08 06:43:48', '2021-04-08 06:43:48', '::1', 'login', 'I0MjALDpJUTV88rXT6I0mSWQ70hKjYw04pa4yvwxv8LnaqunHtHRWLiMuHDkq7rNJZSkEWSeJLlAl1xmxmTdxXhIZAcQVU52MroB', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:43:48', '2021-04-08 01:43:48', 0),
(812, 30, '2021-04-08 06:44:21', '2021-04-08 06:44:21', '::1', 'login', 'lJoezABUJejusjCKSJVH5Bz9AfqkpWpnIfMOOeNdkHyDdWtHjqFRVgmVwGvmNWwiwUL17kTdZYVZlooWtXXJ3aRSqjkGTNtGRVvR', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:44:21', '2021-04-08 01:44:21', 0),
(813, 30, '2021-04-08 06:47:18', '2021-04-08 06:47:18', '::1', 'login', 'YPISfKDnaX25xo0a7HoP4RagJCLxpxUO4u0LvIDVnnaVZInMc2nkAl29zA59MXrFmjpXP6TKKWtbWpl12bSPqhPZoc2Hv8LQYGzt', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:47:18', '2021-04-08 01:47:18', 0),
(814, 30, '2021-04-08 06:47:53', '2021-04-08 06:47:53', '::1', 'login', 'vEG0nHjQcrNnRJYRQIWqakzHbnYV5xF2hS2UBAvuQ6Vr3GaKEHir5Y4X2z2J0d6BCGuodqIomOmJs7K7LuUZbRVFtOkKmfplrXFY', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 01:47:53', '2021-04-08 01:47:53', 0),
(815, 30, '2021-04-08 11:26:30', '2021-04-08 11:26:30', '::1', 'login', 'HIfVKzhHwgV3ysfofD3MQYHEBvIFRR5UylR9Rt9YFIdS9CdK6BOlbVqsiDDLNkVl1Y9xxpjJ9mHQldAwS7vGPPHsEpafDDMNjhtY', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 06:26:30', '2021-04-08 06:26:30', 0),
(816, 30, '2021-04-08 11:27:59', '2021-04-08 11:27:59', '::1', 'login', 'maTOry0GlNZBDp1V5Ln3fz7bFaHm8MiSUSH7V7BLiyPw7UsfTAmRCZ8l2WmuTvvcorXWJ2IVqpaC3n1jCyDUFgwFFBHoDVh75zz5', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-08 06:27:59', '2021-04-08 06:27:59', 0),
(817, 30, '2021-04-11 18:23:10', '2021-04-11 18:23:10', '::1', 'login', 'aWio1q63ilJiZoWKgz3iSLbeJgIDwYmPc3JGpFnOIXtPFyTrDJUg9QSOMJg3TQOz5CO9m9GgCTUErVRHWGwDavLjQZzR96AchNPv', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 02:23:10', '2021-04-12 02:23:10', 0),
(818, 30, '2021-04-12 04:03:27', '2021-04-12 04:03:27', '::1', 'login', 'i4BHD3qQHE5wws7UNU4nyoOYNbgO0hR7K8jhO5jTryCzfV1Oup6SE7DaFhz3jbAjjvXgxmahGFJM4a6AvHungmzuJe8bZgC54g7j', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 12:03:27', '2021-04-12 12:03:27', 0),
(819, 30, '2021-04-12 04:05:31', '2021-04-12 04:05:31', '::1', 'login', 'wUiRyAV87TsaFcjWjC0yK5Am2sxl1QbeLDJAOpvHYNFyGxQSN5puh1J9ZAxKsajjmEOCwkmgmmRs89ik0oL01iwlhavAy7WGVaS9', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 12:05:31', '2021-04-12 12:05:31', 0),
(820, 30, '2021-04-12 04:06:32', '2021-04-12 04:06:32', '::1', 'login', 'AhQsyznxvI9gkzINkUqM5FBl2YJSyX0Jlbwa972E7HaYa9q7u3DMKpzO7qmPh0IxmXP6CcX1kaELvRzqzSiGUAh54u7LPyyjmMqd', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 12:06:32', '2021-04-12 12:06:32', 0),
(821, 30, '2021-04-12 04:25:11', '2021-04-12 04:25:11', '::1', 'login', 'a9yyLOZzEBIgjmkpwPjF5IFioKzu4KXN81UR2tHWe78xFEx7bukgowiIxwEbKa16D1TLqBp1PPHaCEXII3zcmX054QlxR5Gnygg9', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 12:25:11', '2021-04-12 12:25:11', 0),
(822, 30, '2021-04-12 06:39:27', '2021-04-12 06:39:27', '::1', 'login', 'HP7nyD0NcOebGGwccsAeSLnR4mhi5LyAoISlFjTSzymgUguKkBcK4H2cnpvWS0AF6Su0ncfW6BpQ17WTPziewpJOWiu5f8JNQmPN', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 14:39:27', '2021-04-12 14:39:27', 0),
(823, 30, '2021-04-12 08:12:51', '2021-04-12 08:12:51', '::1', 'login', 'wXSXO7WaEBilLgeMtUkT7uxGDcWGSfYjdVqnPJSXXodzjCnQfq81tOcxm8MPqaJGLwLFoyvFxFjCqAvWEhkNYtXtCPYqz2uTWxEV', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 16:12:51', '2021-04-12 16:12:51', 0),
(824, 30, '2021-04-12 08:15:17', '2021-04-12 08:15:17', '::1', 'login', 'ZdCGhr3tveSmKy35cGdhNQJyVm66pwiasvmsd6jmFmc0EKRpL8JNfpHUUuzJcrobBMcFfdo286vSYR5QHwCUf8gbUeFzB1IQH5Qk', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 16:15:17', '2021-04-12 16:15:17', 0),
(825, 30, '2021-04-12 08:15:18', '2021-04-12 08:15:18', '::1', 'login', '5VbabCyNvJBJAC24BENxu3jMbPmc7SKXhcOw0VxtUUrALT1KsQ3YOJJRbRWS08AVJGcL6IMSWJ8BTqcCSkJW4tkxorYAMQ0Fssfj', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 16:15:18', '2021-04-12 16:15:18', 0),
(826, 30, '2021-04-12 08:39:48', '2021-04-12 08:39:48', '::1', 'login', '1R7OuYsayUHVEuUzI5RPN55OGyJIied9iDt3NKJC0yRUr60Ej8SXp1mfAH0m6PXOtf4LT3gpMWTgUeZOVARxa9JSMFnYG3DIYv2a', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 16:39:48', '2021-04-12 16:39:48', 0),
(827, 30, '2021-04-12 08:47:20', '2021-04-12 08:47:20', '::1', 'login', 'HEZDq2Sw9T9IwYMmjz018BNHXE8WvipuzLryE89f4AFur9ZsIaCB6MNCXcdQ2ZMEAeqKfBjPQdjzxm8mZ9L6vNFFBnGwrA3S9rbC', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 16:47:20', '2021-04-12 16:47:20', 0),
(828, 30, '2021-04-12 10:32:40', '2021-04-12 10:32:40', '::1', 'login', 'cLK94poCYehCOhcnYji63Yi9VHM9bEcx0vcxhzNAZqbuvUH2x6wFeHaKACtAoSbrHJpxpMWWjQflkkSugunRjSVgvSuE5HcDfAMl', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 18:32:40', '2021-04-12 18:32:40', 0),
(829, 30, '2021-04-12 12:06:58', '2021-04-12 12:06:58', '::1', 'login', '0jk3f6PbCsntYPKDBHvdJ0Q3MYop8rGLhDNVppM1GqcmQsQ1rQ7w4edaBnb6W3aZGDz3dMpGLfyXQWuOTveCN7xvNk0xvKVI694n', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 20:06:58', '2021-04-12 20:06:58', 0),
(830, 30, '2021-04-12 13:01:04', '2021-04-12 13:01:04', '::1', 'login', 'Qhu7jzsZgtJ7hmlT3m3v3hG2Mnu8I0ZM18IoBACZZHUAWGZqCkzgvmyAmAlER4bRlUuXNSDkwTjedBfucStshsUHFV9ES5BMu7Sa', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 21:01:04', '2021-04-12 21:01:04', 0),
(831, 30, '2021-04-12 13:53:03', '2021-04-12 13:53:03', '::1', 'login', 'l3dTLiqxcOdVrkjXL8p6qHrRfiuVROqclnrVtf6b2lfmYV335Z4vIRQkyyqWucKzucv9bsQdjNTvHlRXOkTbT5gfPM4qnQBMf83P', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 21:53:03', '2021-04-12 21:53:03', 0),
(832, 30, '2021-04-12 13:58:04', '2021-04-12 13:58:04', '::1', 'login', '0QjdNz1Bs4DtSAXLzvfmvq1JklZBbaLcc8pAKDmNyj5EyRJXf48nCsTAV8fNv46pkBtCCGJ4GHPXPZyngRMWnLiVdj3hOi2Ityyg', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 21:58:04', '2021-04-12 21:58:04', 0),
(833, 30, '2021-04-12 13:58:54', '2021-04-12 13:58:54', '::1', 'login', '80eU20GzptXXIEBzzsTJGXvtIBhOix1z5gw6KON6kiIgTBbIiPMdEdgltCWEjkJZOzFAcJpmmqvgjyKjVKMGiOBx0B5Lv0kMes6j', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 21:58:54', '2021-04-12 21:58:54', 0),
(834, 30, '2021-04-12 14:00:01', '2021-04-12 14:00:01', '::1', 'login', '2E4e2E137vEcF9UVR4oFmLURkQUlvo0BgFF0hJgMIfdi9vbHQxPz3l3HN0dvhgQNQFQLN2FJd2u72bJs0H67t0PwkraXfFyd1h41', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 22:00:01', '2021-04-12 22:00:01', 0),
(835, 30, '2021-04-12 14:05:14', '2021-04-12 14:05:14', '::1', 'login', 'NIRBCDumTLaSYaPOeWgh5L1oehnKSvOeEWgNYW8HulRQGyHV6U9e5xh8b1E5SEuhssuUXaM81wDqGyzAkUb0nKUvI4aiVYJeK19g', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 22:05:14', '2021-04-12 22:05:14', 0),
(836, 30, '2021-04-12 14:09:42', '2021-04-12 14:09:42', '::1', 'login', 'ImNZnXo3eJ0Mri5IWCMRGnPXZq84ieP6NMVf8QlojZFUXuhA5qhVOWFnVLtPrFhDnzZ1LFw8aTy8VDCNoRdz9aqIHW9sGlQbg2Sc', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 22:09:42', '2021-04-12 22:09:42', 0),
(837, 30, '2021-04-12 14:21:07', '2021-04-12 14:21:07', '::1', 'login', 'f6TxR24Fg5x2cakEdi9rvrO7tXM2S7m5rXLOZD0rAgSixSHa01BbHwDQot0gvk9pn8TLN0eKwF96TWMPzpUXlEUKvoAAsr6DROfG', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 22:21:07', '2021-04-12 22:21:07', 0),
(838, 30, '2021-04-12 14:34:29', '2021-04-12 14:34:29', '::1', 'login', 'g4yh2vtf3yRC0RXRCfT2MWd9BHkqSoYfpybkWl2liVVhOAP1Yy57WfANjC32bi5FoP8bzdum9vs1e9WVzG88uElzy5eKKhNkf7yw', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 22:34:29', '2021-04-12 22:34:29', 0),
(839, 30, '2021-04-12 14:36:20', '2021-04-12 14:36:20', '::1', 'login', 'MVATNk44yJThc61JiLM9KEvAHCDGHtYAcmeeUcIRJDYbt1N7CjPk16BvnIqO359uxafQw9lEw6QQSpXjQw95o98oLUwZRZhGX2iM', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 22:36:20', '2021-04-12 22:36:20', 0),
(840, 30, '2021-04-12 14:39:47', '2021-04-12 14:39:47', '::1', 'login', 'HMRvkEv0TraeN3WyvZXddgLMjnT55pyrAK7aMQitGPdEjdDMVuhPwMba8TRcxCjJtHSYaAYsYLSDUKyY0oLmbUMaI2CYrPxjW4tb', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 22:39:47', '2021-04-12 22:39:47', 0),
(841, 30, '2021-04-12 14:45:19', '2021-04-12 14:45:19', '::1', 'login', 'eqjkljJjE99faob4nRl2hKDWfN3UwJPZh4cgFqJsaBe5AS16v7GfHNNp8svDe5FuuEPsxV7L0Z2BkURv7sw2LgyNgPe5jJ0eC1wS', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 22:45:19', '2021-04-12 22:45:19', 0),
(842, 30, '2021-04-12 14:45:19', '2021-04-12 14:45:19', '::1', 'login', 'jaUQTjj2lUz3frnbUymGHcZfjU9ugPSqOYy4Y7AYHnGIumIulwMBrJ7yiX0yWCEzZYBhWTji7vySaHvSdAE4cyFvbuyhKQgM3DEf', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 22:45:19', '2021-04-12 22:45:19', 0),
(843, 30, '2021-04-12 15:04:42', '2021-04-12 15:04:42', '::1', 'login', 'PC6aII2DlCnWJu0hGZJARGHmPJZbBWRqxDjnUdxQNPEgnHsnD9PSGZqXDoB0GLNEXAIsgQQ0OQdfm7Pu4f81nxYeZhTpajDS1vrf', 'Windows 10', 'Chrome 89.0.4389.114', '2021-04-12 23:04:42', '2021-04-12 23:04:42', 0),
(844, 30, '2021-04-16 14:00:01', '2021-04-16 14:00:01', '::1', 'login', 'r6NYsH3ZkGLU6gvZF7CWQkaQ3RmN09Ff8Cxba5ayWV883CaN7h9P4cSir6LyMGeV1tSwfqk4Zf5jmDjFOXJdFRq7faYgaxxPNJBp', 'Windows 10', 'Chrome 90.0.4430.72', '2021-04-16 22:00:01', '2021-04-16 22:00:01', 0),
(845, 30, '2021-04-16 14:01:01', '2021-04-16 14:01:01', '::1', 'login', 'PHyhmz9Rg4dB1zXWV1z3PMuyiePG6qJ3UX93GgWsYCfG2gjFceMLlLqcjYv6jmV7iz48IzyT1oh23aQtF83jBwM1AtZiNxy5oXnG', 'Windows 10', 'Chrome 90.0.4430.72', '2021-04-16 22:01:01', '2021-04-16 22:01:01', 0),
(846, 30, '2021-04-16 15:09:28', '2021-04-16 15:09:28', '::1', 'login', 'V9IsnF9GqPscs685lRCenGZOvbZZRpheQA622YVS7KHhAyx2cqD1rxhbHWuweHpgwoaADjgN2ggdrQKc9TRB65nuXUTXuyjTbSHg', 'Windows 10', 'Chrome 90.0.4430.72', '2021-04-16 23:09:28', '2021-04-16 23:09:28', 0),
(847, 30, '2021-04-16 15:41:18', '2021-04-16 15:41:18', '::1', 'login', 'tGKKSn4ZfFjxH8WIFwE8Iox637CfggzMPPOhe5uL6rEoNvI5jLYtO8bRpNzFxPYegKHMa6GG0j8ThclkXgmc8oSq6zJbk1YaMb0M', 'Windows 10', 'Chrome 90.0.4430.72', '2021-04-16 23:41:18', '2021-04-16 23:41:18', 0),
(848, 30, '2021-04-16 15:59:23', '2021-04-16 15:59:23', '::1', 'login', 'PX85HCCnG4VXkadMb8pPJMjLVrrwsxbQuZuZspAAYtNCNefN1KTephhzG6kYmc3rICOypHpNyF1CLY53iOLt9qs89sN1YirCAePI', 'Windows 10', 'Chrome 90.0.4430.72', '2021-04-16 23:59:23', '2021-04-16 23:59:23', 0),
(849, 30, '2021-04-16 16:25:45', '2021-04-16 16:25:45', '::1', 'login', 'jaerYAnteAjItTZe8vq7Z93PuCM3tDWSfbkq61rtdtTW2TXp2qjaBQT9eowkYDf0MKcMnhySdlhZBcZsMLW8teuPyE646nU8Flne', 'Windows 10', 'Chrome 90.0.4430.72', '2021-04-17 00:25:45', '2021-04-17 00:25:45', 0),
(850, 30, '2021-04-16 16:29:23', '2021-04-16 16:29:23', '::1', 'login', 'Ib5NRBHEAPQL2fOGE5wHRIVdf8wV6Mpr3BW6ihsFlrqIicFQjvQPyftV0lC9f9DYRKaHvBOW1OGhs8Z16QvyH7xbeUg8PHkByM3j', 'Windows 10', 'Chrome 90.0.4430.72', '2021-04-17 00:29:23', '2021-04-17 00:29:23', 0),
(851, 30, '2021-04-28 17:21:52', '2021-04-28 17:21:52', '::1', 'login', 'OhilyIg91FnR86fn2b4CCG4zzw5SsvInSMV6Tr6YRIWQheCHp2TqU8goPr7ri2O11FBzutqULlwnPHq06RZWO4ufdQio6vQw6Dz5', 'Windows 10', 'Chrome 90.0.4430.93', '2021-04-29 01:21:52', '2021-04-29 01:21:52', 0),
(852, 30, '2021-04-28 17:22:51', '2021-04-28 17:22:51', '::1', 'login', 'y8xeFbtma9KbAikjb4nbuGGGeCSZ8qDogecxjtSsl13fCNOkMvmOxreL36H89QG6jshzeFhiEcFJSqiuYXwkeq6nNbv8Gva2uVHB', 'Windows 10', 'Chrome 90.0.4430.93', '2021-04-29 01:22:51', '2021-04-29 01:22:51', 0),
(853, 30, '2021-04-28 17:40:16', '2021-04-28 17:40:16', '::1', 'login', 'TzmEASlgbOtoZ4xxfy5ecXKGdImuxRMFCwD0DVkpYmm87C3rYChK2hYPI223sPcmWGEHfLtjUYkUGdPpsvuNEAa2KXP6L3tZHWvb', 'Windows 10', 'Chrome 90.0.4430.93', '2021-04-29 01:40:16', '2021-04-29 01:40:16', 0),
(854, 30, '2021-04-29 12:35:17', '2021-04-29 12:35:17', '::1', 'login', 'gbDTNrkBe5KfVH8dvxx5VYn06owcMmt1J40r6Rw4iX8LWO7W71w0umNREU2n98e3UB62CowSelS8qPXav8RrKtFscWzzp5PlwSmY', 'Windows 10', 'Chrome 90.0.4430.93', '2021-04-29 20:35:17', '2021-04-29 20:35:17', 0),
(855, 30, '2021-04-29 13:12:16', '2021-04-29 13:12:16', '::1', 'login', 'PpdWEUTxohyJc6WZNBoPBHcT2YfMfWRQNk7wZrlY0tdIkCG0ctP4x24IWd3INXqtcHn2hEu1niQN6UjmKXJ5FKwuGT7pNsfBSU5e', 'Windows 10', 'Chrome 90.0.4430.93', '2021-04-29 21:12:16', '2021-04-29 21:12:16', 0),
(856, 30, '2021-05-04 06:53:49', '2021-05-04 06:53:49', '::1', 'login', 'bKLP5ue8TvhNqsGqn6CvEp5Du09ZVQacdmq53CCbPEKwHCM020AFQyUyLFZcjQIPjkt39aLBb0g4AviT6ve991z5DJFHB8YgrtRG', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-04 14:53:49', '2021-05-04 14:53:49', 0),
(857, 68, '2021-05-04 07:09:41', '2021-05-04 07:09:41', '::1', 'login', 'eEgKuiferXxMvlDc12B8uAmkjJ4B9CwMtrsY6TbK6posUjlOhWQy5Jrc12FWs6W1mJ6IPq2Ui6pLungjisP4GJA6kNsOvO1sLbd3', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-04 15:09:41', '2021-05-04 15:09:41', 0),
(858, 68, '2021-05-04 07:39:07', '2021-05-04 07:39:07', '::1', 'login', 'qtT4lsK9fi0lnSpMoRHwDPfyQFAKXVWEHOuaZEZyPd3yqJuFz9q0ppr6x7FKiebe3pMVVDnyN5OlCfjTaE19txjzAakRK4ZldwNO', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-04 15:39:07', '2021-05-04 15:39:07', 0),
(859, 30, '2021-05-05 11:52:21', '2021-05-05 11:52:21', '::1', 'login', 'WYjHSTrhraEfsK0ECiKLqBWrDUMY1phtL9kZw5jwSuq8DsMJOn4y8UPK9Ahx0382HB3zD6o41D0Eg9Pfz1AOlMtYPnB1hNQ6Ujm6', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-05 19:52:21', '2021-05-05 19:52:21', 0),
(860, 68, '2021-05-05 11:53:47', '2021-05-05 11:53:47', '::1', 'login', '3SUPnHidOKN4zTAFGvdrpuHx03nx3b8d0tA2nB0RktYxA9cTWTIPKWQu4aCx6Hj8eYCAxBFJluJynvcPrVNp5G54eRP4aceBa45w', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-05 19:53:47', '2021-05-05 19:53:47', 0),
(861, 30, '2021-05-05 12:22:34', '2021-05-05 12:22:34', '::1', 'login', 'LGnvlQvO64soJml8xTBYVHfdiyZIX3gueDJTaVIGNpTR3AZuF1fZ6etuI5lF7TvorQZOwS6OVriRo6KhAGlPUPtibJE2NPyZwfi6', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-05 20:22:34', '2021-05-05 20:22:34', 0),
(862, 30, '2021-05-09 12:10:44', '2021-05-09 12:10:44', '::1', 'login', 'sSHRFTMyLAtmxMrZOkJN0So0YzLY8KkW9OvcTcxlJwabs0n6u3ACp2ugNkPzk522Nu2IZYPOFH66wzINYQVtSvOGoy4Tcqw4GQoj', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-09 20:10:44', '2021-05-09 20:10:44', 0),
(863, 68, '2021-05-10 00:10:40', '2021-05-10 00:10:40', '::1', 'login', 'szSHaz9iHudduiyDdRBtWkYwGclQAauWcmUIVgk8DDzlkidOj4GmKVpRsEEetNsBCDrKNvpZj2YhUgvabomncv5UmlJOStyzMu6N', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-10 08:10:40', '2021-05-10 08:10:40', 0),
(864, 68, '2021-05-10 00:11:12', '2021-05-10 00:11:12', '::1', 'login', '80qqFreawR8NKKlwTdyc17t859NxZiqGtihXkSxfUbAHmkYlf4BYzd9H0yvUBVcONaz6Z358YjqHMmTylYSG0LrSqqEQehZlkQfM', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-10 08:11:12', '2021-05-10 08:11:12', 0),
(865, 68, '2021-05-10 00:13:44', '2021-05-10 00:13:44', '::1', 'login', 'VoMAhZITIToHjhFtFk8NA2pJ8KiJPogPitqIU4qus93cjmAeX2fIOk4AaYOXyyvwhBagKPQ7Tfesu9VFqKO0Tv0VItdtNh97SKT8', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-10 08:13:44', '2021-05-10 08:13:44', 0),
(866, 68, '2021-05-10 00:15:55', '2021-05-10 00:15:55', '::1', 'login', 'rrdHZYzNuuTVtNXU66YByzTA2g5EodjmC7HS81bSfG2haWeZ9LZ1tgk7v0svPZlZiFmH0IF5Zfxa5B2OyAhez6T8Lb0vFml4i4ck', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-10 08:15:55', '2021-05-10 08:15:55', 0),
(867, 68, '2021-05-10 00:21:28', '2021-05-10 00:21:28', '::1', 'login', 'ipGjVAie0FZ4LO07LTasYvH1JBDT88eOx2uzARE7VpNu1J9UG8uyUCr6KLmWttL8EOk3QXlaLziOSqarAIk7BMg8E0OdkMA0RwMy', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-10 08:21:28', '2021-05-10 08:21:28', 0),
(868, 68, '2021-05-10 00:22:11', '2021-05-10 00:22:11', '::1', 'login', 'bz0sJIFjVMzGybsGAlJoU9gxplHV9VGeGCmgm2LykfwbLYW7049D9OGofro8KAo1cHuaAZDPsfD8HekejF27OEY8WeqqgjC5yVxR', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-10 08:22:11', '2021-05-10 08:22:11', 0),
(869, 68, '2021-05-11 03:15:37', '2021-05-11 03:15:37', '::1', 'login', 'b8eFSHtlsOaHtBOJvWhNUAvOeGJUArsXZTqce66k8sCC8ivyo9LOp1HnOV9o7dq0rzv6gWIzk4I3X6mcuARM6ZrnEFsiz60SCCKR', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-11 11:15:37', '2021-05-11 11:15:37', 0),
(870, 68, '2021-05-11 03:17:16', '2021-05-11 03:17:16', '::1', 'login', 'oauURGlXrpn7btSyIdkT6uK80X9SLHQAKURNuk4yWbbaelDlwUNZe2auwIerdkWwKhCizTcGOI3bkkaFjy2MyBZjrHIsJrGGTY3b', 'Windows 10', 'Chrome 90.0.4430.93', '2021-05-11 11:17:16', '2021-05-11 11:17:16', 0),
(871, 30, '2021-05-15 02:05:24', '2021-05-15 02:05:24', '::1', 'login', 'NCaKLh7PPoPDo2hRRdOkaxmvMk8YQbFBTb3YR5wxxVtdrv672BPf8u2kykAzHMQS5noIGi4oRqIHxpzvLShzXHNzVP9hZ5Lagnif', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:05:24', '2021-05-15 10:05:24', 0),
(872, 30, '2021-05-15 02:06:02', '2021-05-15 02:06:02', '::1', 'login', 'dJu735tbmVWZQOSRH1Yrph7bGjnGHB1dJ8xm5swqoZWKCiyQHFdjRW24u9gAU33rKRAXYkJpBfll1ED8ksshkxUHqikfmtaOgSjw', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:06:02', '2021-05-15 10:06:02', 0),
(873, 30, '2021-05-15 02:06:15', '2021-05-15 02:06:15', '::1', 'login', 'rnLMZKdY8qYFzUxwVsSMZ8LK1wLMpRFbw3dXRNAf446hLEWFZDxnJYxvN7ma9Y77a2zaixn4zl9cXXkbGipREXOapyOtpE5fbLXJ', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:06:15', '2021-05-15 10:06:15', 0),
(874, 30, '2021-05-15 02:07:05', '2021-05-15 02:07:05', '::1', 'login', 'o3LsVhtZdVq9w0fxN203I2wfcjhCUNgmq25Vsw4oxtmuDxMTE38VWV34HyfFxcfoXJwCE91f0iZmfn8bJyV4M6JbGIuxrPPxvtjp', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:07:05', '2021-05-15 10:07:05', 0),
(875, 30, '2021-05-15 02:08:25', '2021-05-15 02:08:25', '::1', 'login', 'cPlhKmE9Wa3gZ05WF4neVlcLp00gD01FpzgN1AqytcPfAPJNZYKvLHwSB1pub7T6P6n8iIFT1uKCnHYJKyvBhCnr7EDxIbwJi9U3', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:08:25', '2021-05-15 10:08:25', 0),
(876, 30, '2021-05-15 02:09:38', '2021-05-15 02:09:38', '::1', 'login', '8tNOysRCJnCPj0H7fFbd2U46fqm1W88ERy7FVHkrjSaGb77RTXrNVdKUAKkQ8K2kXA4H9VLsan6sLFJTVj8pLEfvKURN2gtg5WNV', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:09:38', '2021-05-15 10:09:38', 0),
(877, 30, '2021-05-15 02:12:24', '2021-05-15 02:12:24', '::1', 'login', 't5XWk0y9YoczbIkIyWPqn8rhBjqnYhHuB6KMS0OqpEdHJ0DfjptuTFupNyTorSXmzIWg2GuXGxTkuP2GYCheSSVWL9VfIw3iqCL8', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:12:24', '2021-05-15 10:12:24', 0),
(878, 30, '2021-05-15 02:13:05', '2021-05-15 02:13:05', '::1', 'login', '8LzGs8z7kbnDvRf4sTeZURjurtimvZPXBKq4Jj2PSMLt3BT6LzJ6FGreuGrcB66GLmYVr9WG5Wh66UsTlalhcrpeH7Zhhh3fRtbW', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:13:05', '2021-05-15 10:13:05', 0),
(879, 30, '2021-05-15 02:20:45', '2021-05-15 02:20:45', '::1', 'login', 'gcIIhm39QzFNNxxi1KY7Rc6KQzjqTrFgH3uF1fwbHggPsKiuClYJeqcuoDeaShyz0holbM0UbEsH1A3H0CD00QV6m7LDjQBBj09r', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:20:45', '2021-05-15 10:20:45', 0);
INSERT INTO `userlog` (`id`, `user_id`, `time_check`, `latest_activity`, `ip_address`, `type`, `user_token`, `platform`, `user_agent`, `created_on`, `updated_on`, `is_deleted`) VALUES
(880, 30, '2021-05-15 02:21:44', '2021-05-15 02:21:44', '::1', 'login', 'Kbcdsl8VQcdKUOJlIk4hVoMcoKY7fhJb8Ttpr4PVHbIac5bH2ybRGbmar07qHwVPKhukOS5zyuoPWi1qnLbJZLnL8SHEpAem2iwD', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:21:44', '2021-05-15 10:21:44', 0),
(881, 30, '2021-05-15 02:24:38', '2021-05-15 02:24:38', '::1', 'login', 'RgUqXMqI9PoXeV0rdMoaZnWlPBZ1qN4J3jOoI3iqwJzYgrZkS5Q1acDJcmidJaN5EM7fmjBGWfx05WK9TV5V4xeiNRYJu1nC7w6Y', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:24:38', '2021-05-15 10:24:38', 0),
(882, 30, '2021-05-15 02:31:00', '2021-05-15 02:31:00', '::1', 'login', '1VVAVHDVm2MIS8dXcIoQ1fYoTqZEpq01b98yy8fUb20zWcnzEaguyUMbcN1mRY39bg6Ub2QVZ1VFOLGn6sCqHdcllyafgj1i9kO2', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:31:00', '2021-05-15 10:31:00', 0),
(883, 30, '2021-05-15 02:33:38', '2021-05-15 02:33:38', '::1', 'login', 'a3yGeS45mbGc9G2cA6pHvbkEvFaWryr3Qz1OZnZ8dTfrK96uVxMjxUr43UgIjMQkiaF19w3mXnUlo4mJKhVs3k4B9AmqLniCoBmL', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:33:38', '2021-05-15 10:33:38', 0),
(884, 30, '2021-05-15 02:35:34', '2021-05-15 02:35:34', '::1', 'login', 'lQPg3LLaQpOPIovVu9nkAzkIusbWPENs0fVldd6Z3HQmgCDZJUt3oVwYmLZf7KAHlgI8tyKirCKdJ54y5ZEYmda5rC0KcbxidAp8', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:35:34', '2021-05-15 10:35:34', 0),
(885, 30, '2021-05-15 02:49:23', '2021-05-15 02:49:23', '::1', 'login', 'sS24T9bnZoZH2Vsjn7YYqTCSMMcAqzWDWLEETbMLDnRbIujbNeCON3PsqgI4SnIhS4AzozXOgBV51vzFTfVm1RSyP4NSgtZaj99Q', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:49:23', '2021-05-15 10:49:23', 0),
(886, 30, '2021-05-15 02:53:29', '2021-05-15 02:53:29', '::1', 'login', 'GrOMjnXIwU3RwZ29kocKtoQa52AxFxFGHpvo5Q3bqm3iGT5hEiOBp8LGoVvknfdnxYNB727qRNrvlj5Zxq1O1w2Y4IIXjzX0IJIJ', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 10:53:29', '2021-05-15 10:53:29', 0),
(887, 30, '2021-05-15 03:11:40', '2021-05-15 03:11:40', '::1', 'login', 'BU7V8LILra4aszETaC5qgTzwYIN6zane5z9BUlhNE02goAWaiNBSQwuyGYGzGnMiITrbb3mlQOs15wDRRZgwPnfHRhrepXGhM8H7', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 11:11:40', '2021-05-15 11:11:40', 0),
(888, 30, '2021-05-15 03:19:26', '2021-05-15 03:19:26', '::1', 'login', 'Vf9NFUuPe3hr1n7aTkoB3UGt6Qq4vfPPYGrn5IlFZA98yRO9NHfi4shbzFx8PuYU8ru2Tdey3ufMhoTK42H5hlP2ktaI1LSi5Tej', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 11:19:26', '2021-05-15 11:19:26', 0),
(889, 30, '2021-05-15 08:12:48', '2021-05-15 08:12:48', '::1', 'login', 'EczXwlreilLRCnJixNYZGMp9iJ8N7qkNlo0DVpfrpo5rPaZ4EeQKvwhwfJTt98qiosVYS2plDVb6tH2R0ZFnnrUYsOGBaUQddT7V', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 16:12:48', '2021-05-15 16:12:48', 0),
(890, 30, '2021-05-15 09:09:23', '2021-05-15 09:09:23', '::1', 'login', 'uOVgwHHmg2SZrgcPgOshsgIdIXZ3Us1cJVEvzjf7NTsP81KYMsEd25lvUPB88nQeZlaFbU94l72xf2jqIrncu8kdLAHlkQavl7dE', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-15 17:09:23', '2021-05-15 17:09:23', 0),
(891, 30, '2021-05-17 08:07:14', '2021-05-17 08:07:14', '::1', 'login', 'n0m7iBQ3EruD8PC4sPpz7bVEtOVt2jEDJxI9V93CFh55SFwjvLTvOYM0RfDMv9lewx23Wzu7Z0Ep1rgciJdNu4xKaAO8zW6tBxNi', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-17 16:07:14', '2021-05-17 16:07:14', 0),
(892, 68, '2021-05-17 08:25:23', '2021-05-17 08:25:23', '::1', 'login', 'exEfCKZ5EO0l3mxaNYFYaWxjvWBaqlCpsLRNnFi1Tcg4kedVZ42w008RQXeNJamH0t9qnIAC0fxZP4IlLdCQfLq6MS46BFlgTaBI', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-17 16:25:23', '2021-05-17 16:25:23', 0),
(893, 68, '2021-05-17 08:29:18', '2021-05-17 08:29:18', '::1', 'login', 'wBopdSLzGBKvKH7HpPFgWzZnEJwlFwZrM0SzlEzb4ppN8KIsyNe26ilb3wMenEnNYcG4qeEljnNb26XbPWfAf1zclUB6iT69jlmW', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-17 16:29:18', '2021-05-17 16:29:18', 0),
(894, 30, '2021-05-17 09:03:15', '2021-05-17 09:03:15', '::1', 'login', 'S7srxoSPRUfip4keVh97w2OJEymWVifalKlHoX1PaQZ6jooc4ko7Mj9wD5TJz8waVsgyfpby2lZfwie4rUxQ6wiHoeQMWJh6WmQJ', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-17 17:03:15', '2021-05-17 17:03:15', 0),
(895, 30, '2021-05-17 09:04:15', '2021-05-17 09:04:15', '::1', 'login', 'gSthhSMJS2OlKIbBX0i7v32xb5cO64XvSPVNmpg7aKhh4zdArhcX231naVp72uMGjfVsfGzZ8Rm83FfExVZpwp0WbQBAYKwwjlKU', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-17 17:04:15', '2021-05-17 17:04:15', 0),
(896, 68, '2021-05-17 09:14:27', '2021-05-17 09:14:27', '::1', 'login', 'aDeusg2vkJg7972USGAiMWU694JEW3NeRPHhXESA3wZsaOwwewnXnmMwbpc1GlOKsFlWZ2hQKUPSAgQpzcTZHHsZSbbYDAZTeh3N', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-17 17:14:27', '2021-05-17 17:14:27', 0),
(897, 68, '2021-05-18 04:48:17', '2021-05-18 04:48:17', '::1', 'login', 'FLCLTUz4fyR9Wfk3zIeJxYHwUWXjUbnhDdxNHLB5M7YXx86oziVywXj2NOwXXST7oKHiBNiuZvUrFfGCGPhHmV8MwfUix8iSv1WA', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-18 12:48:17', '2021-05-18 12:48:17', 0),
(898, 68, '2021-05-18 07:12:37', '2021-05-18 07:12:37', '::1', 'login', 'kQshnYiHN9Bagoo7bbnhWOAMKtqVGsBPn0uIermWKib8yGK4LUC8fcsUwORfjEYEsm31Swb1c1SBB8QdchPO4ocTSKc1qDhtzF3N', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-18 15:12:37', '2021-05-18 15:12:37', 0),
(899, 68, '2021-05-22 04:53:01', '2021-05-22 04:53:01', '::1', 'login', 'ybyKDdnFWTvsIPDMaNiBRCUfGxLqe4H4BoUwGsaTKOgqSBmfLxxrHHNNwr6vFw8NgXFaOX2n48kFkyyHawq2EvY6X0pwETWyO2KJ', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-22 12:53:01', '2021-05-22 12:53:01', 0),
(900, 30, '2021-05-22 08:49:43', '2021-05-22 08:49:43', '::1', 'login', 'YZjGQTx3noHTXJfJgZmhaSWbw7SIjiiUt5M4r7XyQ5me4f7WCePCXiQcpkx68Fr9mW551qfO6RE6M2JgB9bp5BTuYjrDN70duZMY', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-22 16:49:43', '2021-05-22 16:49:43', 0),
(901, 30, '2021-05-23 12:19:31', '2021-05-23 12:19:31', '::1', 'login', 'k5LHJdbqYQbpYtk7tNNxMZilD3PEz443Xks3dXirNtm4CNhMaz6Olsy78dqxiqKnsISWKYaCuUV9im9rTwd0QMpNdYZoWqLEVmZ5', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-23 20:19:31', '2021-05-23 20:19:31', 0),
(902, 68, '2021-05-23 13:16:15', '2021-05-23 13:16:15', '::1', 'login', 'xVB13tMXjuXvT3WqCN6q9xhuakHni0M4gIxOxeDyMQeGCHHcrK1unP5GYTR4QnvdLGsdMkJaNndKPAlvhPTN0APTvxEFUtWSSLNb', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-23 21:16:15', '2021-05-23 21:16:15', 0),
(903, 68, '2021-05-24 13:31:44', '2021-05-24 13:31:44', '::1', 'login', 'czSAmbuyaYwEa2THx8OtDkAUnamGf69zRNNXQ6FOk7OazVgKXVmQL9oXMTlEc4VFaCWdHBsmEZwqtNP5VCIrPn1TJEoGpCDsktti', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-24 21:31:44', '2021-05-24 21:31:44', 0),
(904, 68, '2021-05-31 10:32:53', '2021-05-31 10:32:53', '::1', 'login', 'Yc3XstyXiEt9YMOMp1OojWV7o23bGhjTzTGsM4YllocNNhpfR6AzmDUHPo1swFlXFBEAOqtxDy5Tj3LI2xKAC1LOqT3hsnkBNDsS', 'Windows 10', 'Chrome 90.0.4430.212', '2021-05-31 18:32:53', '2021-05-31 18:32:53', 0),
(905, 68, '2021-05-31 16:47:26', '2021-05-31 16:47:26', '::1', 'login', 'FQEXiLnEAoxyagmbDbmX3cIA77MirBqUTzOu4ezTaCW92vuPMtEEE9yy6Y6ISBO6WSOXddYNTwQkFCvr71EHNuXcXK1ubPvFiPpi', 'Windows 10', 'Chrome 90.0.4430.212', '2021-06-01 00:47:26', '2021-06-01 00:47:26', 0),
(906, 68, '2021-05-31 17:19:47', '2021-05-31 17:19:47', '::1', 'login', 'srUh5B4ibV0HCiNiiriWycqB7eE7oNhbOX0WhejFTA8YmkJqQkbymtK7i4Qv8Amrka1kPnLBUaVYhxLkQVvV9TBiC6SG3pYdtwhV', 'Windows 10', 'Chrome 90.0.4430.212', '2021-06-01 01:19:47', '2021-06-01 01:19:47', 0),
(907, 30, '2021-05-31 17:31:20', '2021-05-31 17:31:20', '::1', 'login', 'MAlltIDnUGmg1FvAJI9wMTGSEU6SbJhoAvnL31RvC4pjhtqM8quBNxBvLCi2yk2OboszKKdwiY5g3TYx9FUY5dhIXqnd85tJw73k', 'Windows 10', 'Chrome 90.0.4430.212', '2021-06-01 01:31:20', '2021-06-01 01:31:20', 0),
(908, 68, '2021-06-01 02:40:12', '2021-06-01 02:40:12', '::1', 'login', 'FNP9rgjGZG0RGI5cOlgP7ZlctB5nBA3eOnQPRXrTEx5swjPpNZltrBE0aIsSXNHsnevLQvmDueZWgrZOYbc65XBeL541b2OMePht', 'Windows 10', 'Chrome 90.0.4430.212', '2021-06-01 10:40:12', '2021-06-01 10:40:12', 0),
(909, 30, '2021-06-01 02:47:53', '2021-06-01 02:47:53', '::1', 'login', 'k1VjtVKP6HkIG2TSwOSCOI51UIfQ38GvefsqPhS1hKjOlksEKKjxAL7clfTyVvKUHSLivgVwAFLNZAzrkRNQ73ugkqomED247lmu', 'Windows 10', 'Chrome 90.0.4430.212', '2021-06-01 10:47:53', '2021-06-01 10:47:53', 0),
(910, 30, '2021-06-07 15:54:58', '2021-06-07 15:54:58', '::1', 'login', '2bKrjSUNGPaciFR898AFgME83owiFDiCOdN34EVUbQjgIqqA45lykCGJJGxNUANURybp0Ap5gXMFLzbmbZ3JRchfMwKUtTTedWJ5', 'Windows 10', 'Chrome 91.0.4472.77', '2021-06-07 23:54:58', '2021-06-07 23:54:58', 0),
(911, 68, '2021-06-12 13:23:08', '2021-06-12 13:23:08', '::1', 'login', 'btKwrEaXG8CEPPuPYYcyzSEhwFm0BL4NH5c21iFVdxiqyVsjgCnPwPPTZ5DKkbM4erK8keqmIwgLlFp7nom7mQBWGPJuUVL5P7Gw', 'Windows 10', 'Chrome 91.0.4472.101', '2021-06-12 21:23:08', '2021-06-12 21:23:08', 0),
(912, 68, '2021-06-12 13:23:58', '2021-06-12 13:23:58', '::1', 'login', 'gYFDswDrWMuGxNeMUaelKuXyq2uTJEk7nf3jmwPZlysN4Iu1lfdw3gbuGhPCKIymGNnIQFFsgha21Sm1YlfRysZVbeo9cpMTBijB', 'Windows 10', 'Chrome 91.0.4472.101', '2021-06-12 21:23:58', '2021-06-12 21:23:58', 0),
(913, 30, '2021-06-12 13:56:53', '2021-06-12 13:56:53', '::1', 'login', 'ebwcwivwWCQcvi6ieSFB0Nh7swF9ko4xz6zxTnHq5N9yZsna0kLnnm3X9VX6DXI3DUIR3a8nLmptBPmFkCL8PgPl90qrVNzwELps', 'Windows 10', 'Chrome 91.0.4472.101', '2021-06-12 21:56:53', '2021-06-12 21:56:53', 0),
(914, 234, '2021-06-12 15:22:57', '2021-06-12 15:22:57', '::1', 'login', 'epCjWBMCKqgqTLyUBa5aoItf0I4wtiuYZJnaohfMPPUA3hxzi5prbdIUREYGPdnvIZpDin9RKeNVfi3oNpOEa1CS0dww3Wzq0R7M', 'Windows 10', 'Chrome 91.0.4472.101', '2021-06-12 23:22:57', '2021-06-12 23:22:57', 0),
(915, 234, '2021-06-12 18:16:49', '2021-06-12 18:16:49', '::1', 'login', 'hCW1PtfJ9BQ1FrPPDBf7G7ohFmKXnlRzQKRtidBu5INEc8YoRaoLdaoObw2eihre7gEHqi4LevwFlQ2XdKM0I4MYAKpF3z0ZKCnF', 'Windows 10', 'Chrome 91.0.4472.101', '2021-06-13 02:16:49', '2021-06-13 02:16:49', 0),
(916, 237, '2021-06-12 19:00:16', '2021-06-12 19:00:16', '::1', 'login', 'Gr3milZwc8kYIvl8TK9nIdoA8FLNKWKy3y74Nazv1MbG0s3blH9sMLCCxk1CPijj5XHCpNpFRbGZfq1hCF9F1nZC76ZoFKKcq1kQ', 'Windows 10', 'Chrome 91.0.4472.101', '2021-06-13 03:00:16', '2021-06-13 03:00:16', 0),
(917, 237, '2021-06-12 20:53:02', '2021-06-12 20:53:02', '::1', 'login', 'OxrlT5dJslqi8I4o1GN14kp6RPG5WChH15pj8lmc7tAq7CA34cVrh266q6LrD9kfX2NcowjajjUaSFkZ8qVa63IABDf9btuP9WGz', 'Windows 10', 'Chrome 91.0.4472.101', '2021-06-13 04:53:02', '2021-06-13 04:53:02', 0),
(918, 237, '2021-06-13 05:27:42', '2021-06-13 05:27:42', '::1', 'login', 'mADliYZ5c6h2E0qluJYrcWw5wJjhQRiKTFJcRyIdVnwdhGZpGoleXQ9kLca2RSHJjSIgM4VJ42A9LbBgCtJkRVrD9FV09zvzF6ua', 'Windows 10', 'Chrome 91.0.4472.101', '2021-06-13 13:27:42', '2021-06-13 13:27:42', 0),
(919, 237, '2021-06-13 05:31:31', '2021-06-13 05:31:31', '::1', 'login', 'pvorgF0hkqpFRe9L3pLIMHZezR5LzgENyQT5ObEtdfbpVQdZHXzbhkYIhuLukYohhqvJAp9LEMPRMPMTuZA8jyffRk1T9Z0orv7Q', 'Windows 10', 'Chrome 91.0.4472.101', '2021-06-13 13:31:31', '2021-06-13 13:31:31', 0),
(920, 234, '2021-06-13 05:32:09', '2021-06-13 05:32:09', '::1', 'login', '0f2bBa3tk3AdssEDnoY0nzjsho6lW8ercPYn89NFHA5NWMBBsBW1W8tPHIY6PagMtY0I8Qp5KBOOQF0pQmgkshXJXxs9qduKrV2C', 'Windows 10', 'Chrome 91.0.4472.101', '2021-06-13 13:32:09', '2021-06-13 13:32:09', 0),
(921, 30, '2021-06-14 09:11:05', '2021-06-14 09:11:05', '::1', 'login', 'SUAUVNaYk538DHU9yErnuyTQwnfJim81OycsPp2KULtsi3Il3Hbbf75dx0wzlKFJOYWL02eoi3bYwiJa14lilKqSrLlnlXu9cHOR', 'Windows 10', 'Chrome 91.0.4472.101', '2021-06-14 17:11:05', '2021-06-14 17:11:05', 0),
(922, 234, '2021-06-14 13:47:18', '2021-06-14 13:47:18', '::1', 'login', 'QQkS7LjgEx1WJH4apsPkAPJUYWo4qwElDfIaAzJAo9EJDxtP9H2zNefwsR5wTs9IY2k36fT49DIpy2qWb7hpGPtAh5sPHpMjcATP', 'Windows 10', 'Chrome 91.0.4472.101', '2021-06-14 21:47:18', '2021-06-14 21:47:18', 0),
(923, 234, '2021-06-20 14:33:20', '2021-06-20 14:33:20', '::1', 'login', 'LrRCuVM7aoiGETtESb16y3wLINPP6XAuMa0ChB1eNS7CSYEaYjeHISQnbgg0wgQx1lNGsCaSTOIqPtmPkEsJm5OWEj72LlB0tWQP', 'Windows 10', 'Chrome 91.0.4472.106', '2021-06-20 22:33:20', '2021-06-20 22:33:20', 0),
(924, 234, '2021-06-21 16:03:00', '2021-06-21 16:03:00', '::1', 'login', 'hxo26YT2OKxB2nhBvaXjEYGA2ridr2eUqFfkfuZPXu5yK3Z3QQYSUzTnEne9ABUiFdiZ6pWSKEXN9y0Ne7S3Dj9Uw8gvcuH1sfzt', 'Windows 10', 'Chrome 91.0.4472.106', '2021-06-22 00:03:00', '2021-06-22 00:03:00', 0),
(925, 68, '2021-06-22 01:58:58', '2021-06-22 01:58:58', '::1', 'login', 'R5MSn3KgvevQK3izZHiSMCr6Ek78nT53klpLijng6XsWOncRIWDePBTKp964PIBjDB6SACR51leEkxSTKliS42F0EytTPjCf8Yih', 'Windows 10', 'Chrome 91.0.4472.106', '2021-06-22 09:58:58', '2021-06-22 09:58:58', 0),
(926, 234, '2021-06-22 03:14:39', '2021-06-22 03:14:39', '::1', 'login', 'qsRIh7zwQTCZ1m9vnRgJI30b5Qn7F5DbLINAxbZ1zZl1C1lBWOaOgv1KVbsm0uBKIUSqQ5YtHMcnTyC7q8DJTRHnnwhZTGrlGR2I', 'Windows 10', 'Chrome 91.0.4472.106', '2021-06-22 11:14:39', '2021-06-22 11:14:39', 0),
(927, 234, '2021-06-22 04:07:04', '2021-06-22 04:07:04', '::1', 'login', '8Z4oVNBFGisblsfevVb6iKKdcBWaEyHZnNU78NrddNMiODQAj2k8DkDfZbXpD3eBCfw5MyBN4hhOd54WyLZiGTl98y83FfFXfMyW', 'Windows 10', 'Chrome 91.0.4472.106', '2021-06-22 12:07:04', '2021-06-22 12:07:04', 0),
(928, 68, '2021-06-22 05:33:32', '2021-06-22 05:33:32', '::1', 'login', 'heHNiqnaBWkh5CCuuJ2Q1PigchhH87FGjFHBNA4Ws8maeN8oWmskAKVfRxwEvlk7rSD9fs5vcYLOUCCffTgBzQLAHDSLkugKAWik', 'Windows 10', 'Chrome 91.0.4472.106', '2021-06-22 13:33:32', '2021-06-22 13:33:32', 0),
(929, 234, '2021-06-22 05:42:42', '2021-06-22 05:42:42', '::1', 'login', '1FY9TwZSv2z8UOcK8DtxMrJmp29VvWyfCPD0hNlkgUfLbz8CpAnJfYjTHFwsG0n3LpNxH2qhs2l5FD8NBrDt4oxeGto6rrhEbzgk', 'Windows 10', 'Chrome 91.0.4472.106', '2021-06-22 13:42:42', '2021-06-22 13:42:42', 0),
(930, 234, '2021-06-22 08:42:52', '2021-06-22 08:42:52', '::1', 'login', 'FZogkBAs4z9vRZThrb7qWckfvYcprPz4RefoinJfC32Ilyw64btm6vwmYLmPuQSbcwRWBfrM2SCYqENzoDorDyYutCLBuBoMAWw9', 'Windows 10', 'Chrome 91.0.4472.106', '2021-06-22 16:42:52', '2021-06-22 16:42:52', 0),
(931, 234, '2021-06-22 16:12:22', '2021-06-22 16:12:22', '::1', 'login', 'GuFRhD8jdib5QFUmraUEbXiIjuFxJgZRaDyMjfc5KEpBd75saEWqOmwQkN4v4PUoSOXDlUu875t82OzFoI8ubHm5kLg4mECzWV1S', 'Windows 10', 'Chrome 91.0.4472.106', '2021-06-23 00:12:22', '2021-06-23 00:12:22', 0),
(932, 234, '2021-06-24 11:18:46', '2021-06-24 11:18:46', '::1', 'login', 'XKWMvPkodu0uDZrqqVuaU32izqy7kWWcJKbc0aDyi2FoWhxtL1fvohFPpApwAW1qsaB4OJcBzRHh0KjKCLg9ndyC3lfiOd2ms20I', 'Windows 10', 'Chrome 91.0.4472.114', '2021-06-24 19:18:46', '2021-06-24 19:18:46', 0),
(933, 234, '2021-06-24 11:22:03', '2021-06-24 11:22:03', '::1', 'login', 'MHJMPskzR02YkPQVaFOSygmW7KI9e2hswKwNnl4xZihnGqWt6lABKKfert4lyQ8969aiqTp3i5F6gQF5uPU81wkosSv8CrQZrwMv', 'Windows 10', 'Chrome 91.0.4472.114', '2021-06-24 19:22:03', '2021-06-24 19:22:03', 0),
(934, 68, '2021-06-24 11:49:43', '2021-06-24 11:49:43', '::1', 'login', '7IyHPAoXWnraaHRkFXEJfOvpcviilTGlqYK4sM1J9nL0llSHfnIkb9D1rJdyATycZj6vJapDjyLvLDJIGAbvayB5vwNH7cYN1qxl', 'Windows 10', 'Chrome 91.0.4472.114', '2021-06-24 19:49:43', '2021-06-24 19:49:43', 0),
(935, 30, '2021-06-24 12:37:50', '2021-06-24 12:37:50', '::1', 'login', 'hP1y6BLFPr5HWhOvW2T5sxJ76oVSj0jxv3RklcYov1F3zUaS109WJbskGn0aFZ3IpJqLp9I1xXIBvFQW2lakDhAc8QWf9fElBTBN', 'Windows 10', 'Chrome 91.0.4472.114', '2021-06-24 20:37:50', '2021-06-24 20:37:50', 0),
(936, 234, '2021-06-24 13:54:18', '2021-06-24 13:54:18', '::1', 'login', 'axhiFCIYaFQCluwAqWhl8tJ9dye92ale8JR5QtUpkVdLnvMdEJ0oscrk4EEnKzUwykKYerRvyyGaRnxicJ3lc8ip5N5P8S10CUxc', 'Windows 10', 'Chrome 91.0.4472.114', '2021-06-24 21:54:18', '2021-06-24 21:54:18', 0),
(937, 68, '2021-06-24 14:27:19', '2021-06-24 14:27:19', '::1', 'login', 'PrXD1zk9v5DLqKtcUodWnl8RTxn1VcRVREINcrz4pDIMJQDzYAXhfbLkfrDDFL3r6Sf5G4jODCYzBmVGvifo95O1V5dVKca8THnH', 'Windows 10', 'Chrome 91.0.4472.114', '2021-06-24 22:27:19', '2021-06-24 22:27:19', 0),
(938, 234, '2021-06-24 14:28:45', '2021-06-24 14:28:45', '::1', 'login', 'iJ8MosCBqEgXVXDU7upc2uh14ZmoU63HFYoS44U2KEizY5mNCORkVyO7dwpvdtquJwCd07fjn5e2l4ByEl3xYqp2C3KcrJUDIfEK', 'Windows 10', 'Chrome 91.0.4472.114', '2021-06-24 22:28:45', '2021-06-24 22:28:45', 0),
(939, 30, '2021-06-24 14:48:02', '2021-06-24 14:48:02', '::1', 'login', 'VQ3uIMyGG3aHo1o6jweM3OXFhqroOJQWgpXhirmRKNW4iv9r0LAXMDczbNjhMt4so36qnTpEqZmsutZOepmvqGZSkhVTk9K4Sgx2', 'Windows 10', 'Chrome 91.0.4472.114', '2021-06-24 22:48:02', '2021-06-24 22:48:02', 0),
(940, 234, '2021-06-24 14:53:18', '2021-06-24 14:53:18', '::1', 'login', 'CyOnPW298IFG452lonkb7G5dCvVxEowNUyt5lX9lBfGZAGH2dT7NuPlnZrcUelfZ3Y0WDID4yiD7j1LObBYqw6vVIpFJB5Eeg5gQ', 'Windows 10', 'Chrome 91.0.4472.114', '2021-06-24 22:53:18', '2021-06-24 22:53:18', 0),
(941, 30, '2021-06-24 23:30:43', '2021-06-24 23:30:43', '::1', 'login', 'uV9nIXnEr1lBIzpT8ON9phxCoQ6WUWc5twuzkTH939a2yFCRpLHCoUKYJnBFyC624go7bisLMfLRrHfOshlTh5IukJC4OT1KuE7v', 'Windows 10', 'Chrome 91.0.4472.114', '2021-06-25 07:30:43', '2021-06-25 07:30:43', 0),
(942, 234, '2021-06-24 23:47:32', '2021-06-24 23:47:32', '::1', 'login', 'ePflWX3mHk97RkrueL5wDyoJHFnORLCVunO215j9G5w8cTCgAQ6xr8IQgO08VEHJ8yGzzh3AnHyBmb0XgZKVsUCotfdrKtfe8rJ2', 'Windows 10', 'Chrome 91.0.4472.114', '2021-06-25 07:47:32', '2021-06-25 07:47:32', 0),
(943, 68, '2021-06-24 23:53:24', '2021-06-24 23:53:24', '::1', 'login', 'eR8FaByD0vwmTB9XtoBj3RDRXVmv9hvFE7D6jsMjgTd42hQ48YCL2bezKg8vuIKfKOX06eJjTc6PHlluLLOsEGGHwOWvHu5TiEbo', 'Windows 10', 'Chrome 91.0.4472.114', '2021-06-25 07:53:24', '2021-06-25 07:53:24', 0);

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
  `grade_level` int(11) DEFAULT NULL,
  `contact_num` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `allow_verify` tinyint(4) NOT NULL DEFAULT 1,
  `avatar_url` text NOT NULL DEFAULT '/public/images/avatars/hacker.png',
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

INSERT INTO `users` (`id`, `student_num`, `first_name`, `last_name`, `role`, `grade_level`, `contact_num`, `username`, `allow_verify`, `avatar_url`, `email`, `password`, `created_on`, `is_active`, `is_deleted`, `updated_on`) VALUES
(30, '201804276', 'Rosalie', 'Razonable', 1, NULL, '09770194572', NULL, 1, '/public/images/avatars/soldier.png', 'rosalie@up.edu.ph', '$2y$10$67NIxlDT/Yjjf5MIkq0Kg.1Ry5Ri5Lx7o4r9a22zS7cDpFliUctaa', '2021-03-22 04:46:02', 1, 0, '2021-06-24 20:37:30'),
(68, '112233445', 'Student', '1', 2, 12, '09112233445', 'user_student', 1, '/public/images/avatars/businesswoman.png', 'student@up.edu.ph', '$2y$10$/uzwWf1gXww7pMvb2Id8FukGac4UQQ2IifQa.bDHfRzoIgM2Az.7C', '2021-05-04 15:07:54', 1, 0, '2021-06-24 19:51:15'),
(69, '012938475', 'Student', '2', 2, 11, NULL, NULL, 1, '/public/images/avatars/hacker.png', 's@up.edu.ph', '$2y$10$rPO6j54vAbzqSUW4vpUGm.hu/qkttnQr7.ooP6F2InoImoU4DBIKC', '2021-05-06 18:32:52', 1, 0, '2021-06-24 21:09:11'),
(73, '012938470', 'Studentt', '3', 2, 9, NULL, NULL, 1, '/public/images/avatars/hacker.png', 's1@up.edu.ph', '$2y$10$oV89ScnbYFjphCnKLnkDH.01kE0h50zQhOSA64CwR/soSGGRskpoa', '2021-05-06 18:41:01', 1, 0, '2021-06-24 21:09:08'),
(77, '012938472', 'Student ', '4', 2, 8, NULL, NULL, 1, '/public/images/avatars/hacker.png', 's2@up.edu.ph', '$2y$10$CA/gVQf9emH33gydkm7n2OX5NRhf05f2m22CimpFbk/bgiM9hqU8y', '2021-05-06 18:54:14', 1, 0, '2021-06-24 21:09:13'),
(105, '012938474', 'Student', '5', 2, 12, NULL, NULL, 1, '/public/images/avatars/hacker.png', 's3@up.edu.ph', '$2y$10$z57XG2nxVPmMrN8IWiGR5eGpJhc9cUsk4F4Dqy0I53xBBAw9crnsG', '2021-05-07 07:59:44', 1, 0, '2021-06-22 16:33:20'),
(138, '082030474', 'Student', '6', 2, 7, NULL, NULL, 1, '/public/images/avatars/hacker.png', 's5@up.edu.ph', '$2y$10$fB4KE63yVyii2S9s.0W/oOiB5gAGTAAaLlr4pWTy1Fmyw/ct2uWEG', '2021-05-07 08:31:19', 1, 0, '2021-06-25 08:08:11'),
(234, '', 'Rosalie', 'Admin!', 3, NULL, '09112345678', 'clerk', 1, '/public/images/avatars/rapper.png', 'clerk@up.edu.ph', '$2y$10$67NIxlDT/Yjjf5MIkq0Kg.1Ry5Ri5Lx7o4r9a22zS7cDpFliUctaa', '2021-06-12 23:21:50', 1, 0, '2021-06-24 19:24:46'),
(235, '', 'Principal', 'Cathy', 1, NULL, '09234561723', NULL, 1, '/public/images/avatars/hacker.png', 'cathy@up.edu.ph@up.edu.ph', '$2y$10$IOOfJ2996kn/xwQagzz7ouadLR6UMvDt1PG7D2RXYFZmDqqkmPUZS', '2021-06-12 23:27:01', 1, 0, '2021-06-22 13:57:34'),
(237, '123456781', 's', '1', 2, 10, NULL, NULL, 1, '/public/images/avatars/hacker.png', 's11@up.edu.ph', '$2y$10$67NIxlDT/Yjjf5MIkq0Kg.1Ry5Ri5Lx7o4r9a22zS7cDpFliUctaa', '2021-06-13 03:00:00', 1, 0, '2021-06-24 21:09:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clicklogs`
--
ALTER TABLE `clicklogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_factories`
--
ALTER TABLE `db_factories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `uid` (`uid`),
  ADD KEY `deleted_at_id` (`deleted_at`,`id`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `db_migrations`
--
ALTER TABLE `db_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eval_answers`
--
ALTER TABLE `eval_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eval_question`
--
ALTER TABLE `eval_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eval_section`
--
ALTER TABLE `eval_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eval_sheet`
--
ALTER TABLE `eval_sheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `factories`
--
ALTER TABLE `factories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `uid` (`uid`),
  ADD KEY `deleted_at_id` (`deleted_at`,`id`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `full_name` (`first_name`,`last_name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `question_choice`
--
ALTER TABLE `question_choice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_type`
--
ALTER TABLE `question_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sheet_section`
--
ALTER TABLE `sheet_section`
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
-- AUTO_INCREMENT for table `db_factories`
--
ALTER TABLE `db_factories`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `db_migrations`
--
ALTER TABLE `db_migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `eval_answers`
--
ALTER TABLE `eval_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT for table `eval_question`
--
ALTER TABLE `eval_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `eval_section`
--
ALTER TABLE `eval_section`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `eval_sheet`
--
ALTER TABLE `eval_sheet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `factories`
--
ALTER TABLE `factories`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=585;

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
-- AUTO_INCREMENT for table `question_choice`
--
ALTER TABLE `question_choice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `question_type`
--
ALTER TABLE `question_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sheet_section`
--
ALTER TABLE `sheet_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=944;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

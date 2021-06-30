-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 29, 2021 at 02:39 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

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
(1, '', 'open', '2021-07-01 00:00:00', '2021-07-31 00:00:00', 2021, 2021, NULL, NULL, 0, '2021-06-29 19:27:59', '2021-06-29 19:27:59');

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
(1, 3, 26, 1, 1, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(2, 3, 26, 2, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(3, 3, 26, 3, 3, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(4, 3, 26, 4, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(5, 3, 26, 5, 1, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(6, 3, 26, 6, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(7, 3, 26, 7, 4, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(8, 3, 26, 8, 3, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(9, 3, 26, 9, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(10, 3, 26, 10, 3, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(11, 3, 26, 11, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(12, 3, 26, 12, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(13, 3, 26, 13, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(14, 3, 26, 14, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(15, 3, 26, 15, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(16, 3, 26, 16, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(17, 3, 26, 17, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(18, 3, 26, 18, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(19, 3, 26, 19, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(20, 3, 26, 20, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(21, 3, 26, 21, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(22, 3, 26, 22, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(23, 3, 26, 23, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(24, 3, 26, 24, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(25, 3, 26, 25, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(26, 3, 26, 26, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(27, 3, 26, 27, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(28, 3, 26, 28, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(29, 3, 26, 29, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(30, 3, 26, 30, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(31, 3, 26, 31, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(32, 3, 26, 32, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(33, 3, 26, 33, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(34, 3, 26, 34, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(35, 3, 26, 35, 2, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(36, 3, 26, 36, 7, NULL, 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(37, 3, 26, 37, NULL, 'HJGHHFGFF', 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(38, 3, 26, 38, NULL, 'gfgfghfhgf', 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0),
(39, 3, 26, 39, NULL, 'lhjkhj ghjfghdgd bdfgdfg', 'submit', '2021-06-29 19:53:17', '2021-06-29 19:53:17', 0);

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
(1, 1, 1, 'Has mastery of subject matter', '2021-05-14 21:28:15', '2021-06-25 13:56:19', 0),
(2, 1, 2, 'Explains clearly course objectives and expectations', '2021-05-14 21:28:15', '2021-06-25 13:56:19', 0),
(3, 1, 3, 'Discusses subject matter clearly and systematically', '2021-05-14 21:28:15', '2021-06-25 13:56:19', 0),
(4, 1, 4, 'Provides in-depth treatment of subject matter', '2021-05-14 21:28:15', '2021-06-25 13:56:19', 0),
(5, 1, 5, 'Relates course to other fields and present-day problems', '2021-05-14 21:28:15', '2021-06-25 13:56:19', 0),
(6, 1, 6, 'Uses effective teaching techniques, considering the total capacity of the students', '2021-05-14 21:28:15', '2021-06-25 13:56:19', 0),
(7, 1, 7, 'Encourages and respects new ideas and students\' viewpoints', '2021-05-14 21:28:15', '2021-06-25 13:56:19', 0),
(8, 1, 8, 'Stimulates students\' desires to learn more about the subject', '2021-05-14 21:28:15', '2021-06-25 13:56:19', 0),
(9, 1, 9, 'Gives challenging examinations and asks questions that require analysis', '2021-05-14 21:28:15', '2021-06-25 13:56:19', 0),
(10, 1, 10, 'Expresses and communicates effectively', '2021-05-14 21:28:15', '2021-06-25 13:56:19', 0),
(11, 2, 1, 'Corrects and gives results and feedback of examinations and/or other work within reasonable time', '2021-05-14 21:38:30', '2021-06-25 13:56:19', 0),
(12, 2, 2, 'Uses students\' achievements in class as basis for grades', '2021-05-14 21:38:30', '2021-06-25 13:56:19', 0),
(13, 2, 3, 'Maintains good conduct of students in class', '2021-05-14 21:38:30', '2021-06-25 13:56:19', 0),
(14, 2, 4, 'Comes to class on time', '2021-05-14 21:38:30', '2021-06-25 13:56:19', 0),
(15, 2, 5, 'Attends class regularly', '2021-05-14 21:38:30', '2021-06-25 13:56:19', 0),
(16, 2, 6, 'Maximizes class hour for learning', '2021-05-14 21:38:30', '2021-06-25 13:56:19', 0),
(17, 2, 7, 'Treats students equally and fairly; shows no favoritism', '2021-05-14 21:38:30', '2021-06-25 13:56:19', 0),
(18, 2, 8, 'Firm and consistent, strict but reasonable in disciplining students', '2021-05-14 21:38:30', '2021-06-25 13:56:19', 0),
(19, 2, 9, 'Encourages students to do their best to develop their potentials', '2021-05-14 21:38:30', '2021-06-25 13:56:19', 0),
(20, 2, 10, 'Gives and explains assignments', '2021-05-14 21:38:30', '2021-06-25 13:56:19', 0),
(21, 3, 1, 'Has high intellectual standard', '2021-05-14 21:46:51', '2021-06-25 13:56:19', 0),
(22, 3, 2, 'Is ethical or moral in the performance of his official duties', '2021-05-14 21:46:51', '2021-06-25 13:56:19', 0),
(23, 3, 3, 'Observes university regulations', '2021-05-14 21:46:51', '2021-06-25 13:56:19', 0),
(24, 3, 4, 'Has dedication/sense of commitment', '2021-05-14 21:46:51', '2021-06-25 13:56:19', 0),
(25, 3, 5, 'Admits mistakes and accepts constructive criticism', '2021-05-14 21:46:51', '2021-06-25 13:56:19', 0),
(26, 3, 6, 'Mentally alert and enthusiastic', '2021-05-14 21:46:51', '2021-06-25 13:56:19', 0),
(27, 3, 7, 'Employs wit and has keen sense of humor when the situation so demands', '2021-05-14 21:46:51', '2021-06-25 13:56:19', 0),
(28, 3, 8, 'Is approachable and pleasant', '2021-05-14 21:46:51', '2021-06-25 13:56:19', 0),
(29, 3, 9, 'Maintains poise or calm in different situations', '2021-05-14 21:46:51', '2021-06-25 13:56:19', 0),
(30, 3, 10, 'Keeps individual and/or group appointments', '2021-05-14 21:46:51', '2021-06-25 13:56:19', 0),
(31, 4, 1, 'Maintains cordial but professional relations with students', '2021-05-14 21:49:12', '2021-06-25 13:56:19', 0),
(32, 4, 2, 'Encourages and makes himself/herself available for consultation', '2021-05-14 21:49:12', '2021-06-25 13:56:19', 0),
(33, 4, 3, 'Elicits positive reactions from students', '2021-05-14 21:49:12', '2021-06-25 13:56:19', 0),
(34, 4, 4, 'Shows enthusiasm for and interest in student campus life', '2021-05-14 21:49:12', '2021-06-25 13:56:19', 0),
(35, 4, 5, 'Performs duties and responsibilities in school', '2021-05-14 21:49:12', '2021-06-25 13:56:19', 0),
(36, 5, 1, 'Taking into account instructional skills,  class management,  personal qualities,  and student-faculty relations.Please rate your teacher by encircling, on a scale of 1 to 5 with 5 as excellent.', '2021-05-14 21:51:13', '2021-06-25 13:56:19', 0),
(37, 6, 1, 'My teacher\'s strong points are:', '2021-05-14 21:52:45', '2021-06-25 13:56:19', 0),
(38, 6, 2, 'My teacher\'s weak points are:', '2021-05-14 21:52:45', '2021-06-25 13:56:19', 0),
(39, 6, 3, 'Recommendation for improvement:', '2021-05-14 21:52:45', '2021-06-25 13:56:19', 0);

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
(26, 1, 3, 4, 'false', '0', 'Completed', '2021-06-29 19:27:59', '2021-06-29 19:53:17', 0),
(27, 1, 4, 1, 'false', '0', 'Open', '2021-06-29 19:27:59', '2021-06-29 19:27:59', 0),
(28, 1, 5, 2, 'false', '0', 'Open', '2021-06-29 19:27:59', '2021-06-29 19:27:59', 0),
(29, 1, 6, 3, 'false', '0', 'Open', '2021-06-29 19:27:59', '2021-06-29 19:27:59', 0),
(30, 1, 7, 5, 'false', '0', 'Open', '2021-06-29 19:27:59', '2021-06-29 19:27:59', 0),
(31, 1, 8, 6, 'false', '0', 'Open', '2021-06-29 19:27:59', '2021-06-29 19:27:59', 0);

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
(1, 'SampleOne', 'ProfessorOne', 'fddfgfdgfg', '2021-06-29 19:38:37', '2021-06-29 19:38:37', 0),
(2, 'SampleTwo', 'ProfTwo', 'asbfdcvbcvbgdfg', '2021-06-29 19:19:10', '2021-06-29 19:19:10', 0),
(3, 'SampleThree', 'ProfThree', 'bvngjhjjfg', '2021-06-29 19:19:18', '2021-06-29 19:19:18', 0);

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
(1, 1, 7, '0', 'SubjectOne', '2021-06-29 19:22:32', '2021-06-29 19:40:12', 0),
(2, 1, 8, '0', 'Subject2', '2021-06-29 19:23:23', '2021-06-29 19:38:31', 0),
(3, 2, 9, '0', 'Subject3', '2021-06-29 19:23:41', '2021-06-29 19:58:13', 0),
(4, 2, 10, '2', 'Subject4', '2021-06-29 19:24:06', '2021-06-29 19:58:13', 0),
(5, 3, 11, '0', 'Subject 5', '2021-06-29 19:24:24', '2021-06-29 19:24:24', 0),
(6, 3, 12, '0', 'SUbject6', '2021-06-29 19:24:39', '2021-06-29 19:24:39', 0);

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
(1, 1, '2021-06-29 08:08:46', '2021-06-29 08:08:46', '::1', 'login', 'Ncd8u2ySvYWAWQDDGXmLCAxqlvdZW9tX6yLXnId4kcXA1QekPhsgokLu9LM1b9GFzGSS3OEzjx8aBDwL4PITrfMDJ0tliu05p3CI', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 16:08:46', '2021-06-29 16:08:46', 0),
(2, 1, '2021-06-29 08:29:31', '2021-06-29 08:29:31', '::1', 'login', 'CHLYzo8hEQJv9pYjl6tJ6wmXVm3dEQSzylUAdKG2MbNqTrtvSGf3WZzL60AOwCiN7LaYV0aRhPQ6w6Cns3EYJHfExYgkBq8siIek', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 16:29:31', '2021-06-29 16:29:31', 0),
(3, 1, '2021-06-29 09:00:40', '2021-06-29 09:00:40', '::1', 'login', '8NgsvTBRBZ7xsyURfvdTEoeNx8NTwr4pi6VeERoDBykDys7YBuVfPUH9K2f6JbGqbmjjKZIUpKilsljiyMKgbWUFlxy6CdQbRTSC', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 17:00:40', '2021-06-29 17:00:40', 0),
(4, 1, '2021-06-29 09:01:03', '2021-06-29 09:01:03', '::1', 'login', 'BanZlhUrlvbnD3tFkeByBSXbnIa24j2bGLJXbYyMCnUhAG8J5NgtVoWM8ef0hYUaMHLy7nctlx0RlufT9TZWJWZGd2HfummeYpr3', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 17:01:03', '2021-06-29 17:01:03', 0),
(5, 1, '2021-06-29 09:02:52', '2021-06-29 09:02:52', '::1', 'login', 'o5uBxzJXE6KIgRDz9mt8wrawzqxzn1tX3QtH11ChGSSGqTjxMfHnAbRxxHZX5FFu8FmwlGfSX5fBLFOCpoWPiryY0QANq3J09geD', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 17:02:52', '2021-06-29 17:02:52', 0),
(6, 1, '2021-06-29 09:03:35', '2021-06-29 09:03:35', '::1', 'login', 'H1gFggVnfvETBK30yFp0LWYtfUHyQmaN3fSr4bFayQqZO0mmB3IB3i9qDcYltI70kPyXCXRXqHoscDMUoiQAdNcrG3DrAnwtLgVa', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 17:03:35', '2021-06-29 17:03:35', 0),
(7, 1, '2021-06-29 09:04:19', '2021-06-29 09:04:19', '::1', 'login', 'KkUGQXH1gjToWORd78LrOdlYpigZiYWKRhSB8mcW6MSrlu8VsSw0isE4wDnzIogzqHglZZHnF30N3bUQmHw86W8FD4qjUuRVUBrN', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 17:04:19', '2021-06-29 17:04:19', 0),
(8, 1, '2021-06-29 09:04:54', '2021-06-29 09:04:54', '::1', 'login', 'VJW311nFkyiMqRf9y2of8iroQuZLThAcAflcDTKEyeOvhhPlOtWQSRGYAISGBxt9GsWDGldMiftz7C2rTzWNp1kIS8zkWeDywmcz', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 17:04:54', '2021-06-29 17:04:54', 0),
(9, 1, '2021-06-29 09:05:38', '2021-06-29 09:05:38', '::1', 'login', 'ryRNvL87yNN6j0rtxoFHZAOxL4JKI8OpKjlC6lGj0gZrfyskxb7mVs5HciZu7nrKadUYaD1nqV1BZd7JHSxDi29Fq0zKJVo1nAhk', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 17:05:38', '2021-06-29 17:05:38', 0),
(10, 1, '2021-06-29 10:35:13', '2021-06-29 10:35:13', '::1', 'login', 'MFj4QaUiZgGAnrQFMArMOlplTNz3fMp8SCf58L20MH8sgUYBkFDOckKKYvEOLBBq9PC4KEyAvMmdQRWreXdtppTu8atpRBOh35BY', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 18:35:13', '2021-06-29 18:35:13', 0),
(11, 1, '2021-06-29 10:36:26', '2021-06-29 10:36:26', '::1', 'login', 'ac00PmAhlFFmmnkh3lVLgMY7bFVzPBm9Ab3uaUg8iXbTFukAUBdTu1wqBBgUhySoJZegCP7sjGndxzpxvXn3V12bcKn4wYMgxXTd', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 18:36:26', '2021-06-29 18:36:26', 0),
(12, 1, '2021-06-29 10:40:44', '2021-06-29 10:40:44', '::1', 'login', 'qYHGW7QZ8fyZc8sdzbaUUUTeiQTcqtnnlmk9kml1X1uW6ADkaSyhYe6bkww6XeqqbD0OuxdpucKqXk6xDugIRgNar7rs9OS8KhZI', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 18:40:44', '2021-06-29 18:40:44', 0),
(13, 1, '2021-06-29 10:48:52', '2021-06-29 10:48:52', '192.168.1.12', 'login', '5i1W7Fi40lrDia6zOqfC2DrDcu5pnmuyndELlS3NBg5iYVNUyikiGhrGF6XN86jzUTmo2eT12ILSnb07yuMZu88PgEWMWMwaXgjh', 'Android', 'Chrome 91.0.4472.120', '2021-06-29 18:48:52', '2021-06-29 18:48:52', 0),
(14, 3, '2021-06-29 11:46:37', '2021-06-29 11:46:37', '::1', 'login', 'GUapsX6efRDIETBAriEzw2BcZZRbb1jNkrf9f46AuNJNh5qM344XxYPXQSmCr15HyZbAb3Lz2sUqbyaRl8cTMEmxHSnkhNevunZu', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 19:46:37', '2021-06-29 19:46:37', 0),
(15, 1, '2021-06-29 11:54:18', '2021-06-29 11:54:18', '::1', 'login', 'n9rw6RSZ1xDaPja0AzlOtRPFvr4SXKrUZA36qZhUD6UovCpCb7ZwQAWpU4NfzwbArVKr37K3HG3hdOWuUpVGvu8LIB6Inou0JzXE', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 19:54:18', '2021-06-29 19:54:18', 0),
(16, 1, '2021-06-29 11:54:36', '2021-06-29 11:54:36', '::1', 'login', 'fdMc8dtHucU3UDkU4NvDYP4mL9jkoFmINPVesQKlOpPk5JCmo38EN5s92XYm676vuZvgDMVVcbhOvM13wbeMif436yPfaM11Taxg', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 19:54:36', '2021-06-29 19:54:36', 0),
(17, 1, '2021-06-29 11:55:21', '2021-06-29 11:55:21', '::1', 'login', 'r9VIZja8NKmWAqgRHbHBkPX7WtGDYbMMBL9g7ye6buZEf9ETV7fuxjuvtOKv1pjhbnkHWba60rRCPmoUeheLKctTeR0enTqoRvMI', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 19:55:21', '2021-06-29 19:55:21', 0),
(18, 2, '2021-06-29 12:23:17', '2021-06-29 12:23:17', '::1', 'login', 'a8Kr2Ha8SpsaquAQ3pgkJhGB1DEqMx5bH4n03CI4BEL2EBDf1KYUPj9t6QdHNnBrfPQjiOKaRgeoqxrDf1tfVdOZpPFKRMKrvmqG', 'Mac OS X', 'Chrome 91.0.4472.114', '2021-06-29 20:23:17', '2021-06-29 20:23:17', 0);

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
  `avatar_url` varchar(100) NOT NULL DEFAULT '''/public/images/avatars/hacker.png''',
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
(1, '10101010', 'First', 'Second', 1, NULL, '09111111111', 'I am super admin', 0, '/public/images/avatars/soldier.png', 'admin@up.edu.ph', '$2y$10$.gWwNgtIjtZGau3fn2dvSOVjDjyPHbhbAcfFrx6wls1KX.5K8PqO2', '2021-06-29 16:07:25', 1, 0, '2021-06-29 20:22:51'),
(2, '', 'Clerk', 'Sample', 3, NULL, '09553344222', NULL, 1, '/public/images/avatars/hacker.png', 'clerk1@up.edu.ph', '$2y$10$.gWwNgtIjtZGau3fn2dvSOVjDjyPHbhbAcfFrx6wls1KX.5K8PqO2', '2021-06-29 19:08:44', 1, 0, '2021-06-29 20:22:57'),
(3, '112233445', 'Crispaul', 'Rubi', 2, 10, NULL, NULL, 1, '/public/images/avatars/hacker.png', 'cbrubi@up.edu.ph', '$2y$10$.gWwNgtIjtZGau3fn2dvSOVjDjyPHbhbAcfFrx6wls1KX.5K8PqO2', '2021-06-29 19:09:30', 1, 0, '2021-06-29 19:46:08'),
(4, '123112312', 'asdhasj', 'asdad', 2, 7, NULL, NULL, 1, '/public/images/avatars/hacker.png', 'sample1@up.edu.ph', '$2y$10$VSPfKxfzqbz2HZOqW...j.0GlUScA1.rrX27pXIo4kTlwARdbLdyq', '2021-06-29 19:13:57', 1, 0, '2021-06-29 19:44:25'),
(5, '083002232', 'gfdhvb', 'nbvnb', 2, 8, NULL, NULL, 1, '/public/images/avatars/hacker.png', 'sample2@up.edu.ph', '$2y$10$g9ww3ANRvXKY.I0YjfIPc.1t.CW9mCwphTRznN7RtKMzcXGELZCia', '2021-06-29 19:14:35', 1, 0, '2021-06-29 19:44:27'),
(6, '455756567', 'urttyrt', 'ertt', 2, 9, NULL, NULL, 1, '/public/images/avatars/hacker.png', 'sample3@up.edu.ph', '$2y$10$hhzy/xG0srS88uvn7E.3huR2i6SDQWbRllg9giakxdfUEHvJQHE3y', '2021-06-29 19:14:52', 1, 0, '2021-06-29 19:44:29'),
(7, '4564575756', 'sdmncererttr', 'xbcbvbm', 2, 11, NULL, NULL, 1, '/public/images/avatars/hacker.png', 'sample4@up.edu.ph', '$2y$10$TqlU0YKGt4w10Ia8Pp4k1uxY0OiGIManrUwAhitwG85kwSBmwC0am', '2021-06-29 19:15:58', 1, 0, '2021-06-29 19:44:35'),
(8, '655685656', 'fsdfdf', 'gjghjj', 2, 12, NULL, NULL, 1, '/public/images/avatars/hacker.png', 'sample5@up.edu.ph', '$2y$10$WCryfR0Pn7H.4UimQ9pe2u9e9OIQHv9zhjWFJWSIDtOn5UTJ.7yxK', '2021-06-29 19:16:09', 1, 0, '2021-06-29 19:55:53');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `eval_answers`
--
ALTER TABLE `eval_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `eval_question`
--
ALTER TABLE `eval_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `eval_section`
--
ALTER TABLE `eval_section`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `eval_sheet`
--
ALTER TABLE `eval_sheet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `factories`
--
ALTER TABLE `factories`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

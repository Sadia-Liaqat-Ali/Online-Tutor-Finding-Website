-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 07:16 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diya_tutor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Emailid` varchar(100) DEFAULT NULL,
  `Contact` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `Name`, `Password`, `Emailid`, `Contact`) VALUES
(1, 'admin', 'admin123', 'admin@example.com', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Youtube Automation'),
(2, 'Content Writing'),
(3, 'Web Developement'),
(4, 'Seo Expert'),
(5, 'Machine Learning'),
(6, 'Computer Science'),
(7, 'Software Engeenering'),
(8, 'Digital marketing'),
(9, 'Criptocurrency');

-- --------------------------------------------------------

--
-- Table structure for table `class_links`
--

CREATE TABLE `class_links` (
  `id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  `class_date` date NOT NULL,
  `class_time` time NOT NULL,
  `topic` varchar(255) NOT NULL,
  `class_link` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_links`
--

INSERT INTO `class_links` (`id`, `tutor_id`, `class_date`, `class_time`, `topic`, `class_link`, `created_at`) VALUES
(1, 4, '2025-05-09', '09:04:00', 'Need urgent Help Regarding Repayment status', 'https://meet.google.com/', '2025-05-06 04:03:22'),
(2, 3, '2025-05-09', '09:04:00', 'Need urgent Help Regarding Repayment status', 'https://meet.google.com/', '2025-05-06 04:04:27'),
(3, 4, '2025-05-05', '00:07:00', 'DEMO', 'https://meet.google.com/', '2025-05-06 05:05:19'),
(4, 4, '2025-05-08', '11:34:00', 'test', 'https://meet.google.com/', '2025-05-06 05:32:07'),
(8, 7, '2025-07-04', '16:52:00', 'SEO', 'https://github.com/new', '2025-07-14 05:51:24'),
(9, 7, '2025-07-04', '16:52:00', 'SEO', 'https://github.com/new', '2025-07-14 05:51:40'),
(10, 7, '2025-07-04', '16:52:00', 'SEO', 'https://github.com/new', '2025-07-14 05:52:22'),
(11, 7, '2025-07-04', '16:52:00', 'SEO', 'https://github.com/new', '2025-07-14 05:52:55'),
(12, 7, '2025-07-04', '16:52:00', 'SEO', 'https://github.com/new', '2025-07-14 05:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`) VALUES
(1, 'Web Development'),
(2, 'Database Systems'),
(3, 'Computer Networks'),
(4, 'Data Structures'),
(5, 'Operating Systems'),
(6, 'Artificial Intelligence'),
(7, 'Machine Learning'),
(8, 'Cyber Security'),
(9, 'Mobile App Development'),
(10, 'Software Engineering'),
(11, 'Cloud Computing'),
(12, 'Computer Architecture');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `quiz_title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `quiz_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `tutor_id`, `course_id`, `quiz_title`, `created_at`, `quiz_description`) VALUES
(4, 4, 1, 'quiz#IMP', '2025-05-06 01:40:54', 'Very'),
(5, 4, 4, 'lastquiz', '2025-05-06 05:02:20', 'diya'),
(6, 7, 2, 'Graded Quiz', '2025-07-14 13:38:38', 'it has 5 questions and mandatory to pass to be appear in final exams');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_option` enum('A','B','C','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `quiz_id`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(11, 4, 'sadia', '1', '2', '3', NULL, 'A'),
(12, 4, 'sa', '1', '2', '3', NULL, 'B'),
(13, 4, '3', '1', '2', '3', NULL, 'C'),
(14, 4, '11', '1', '2', '3', NULL, 'A'),
(15, 4, '33', '1', '23', '3', NULL, 'B'),
(16, 5, 'q1', 'A', 'B', 'C', NULL, 'A'),
(17, 5, 'Q2', 'A', 'B', 'C', NULL, 'B'),
(18, 5, 'Q3', 'A', 'B', 'C', NULL, 'C'),
(19, 5, 'Q4', '1', '2', '3', NULL, 'A'),
(20, 5, 'Q5', '1', '2', '3', NULL, 'B'),
(21, 6, 'SQL stand for', 'Structured query language', 'structured quote language', 'structured quete language', NULL, 'A'),
(22, 6, 'DBMS stand for', 'database', 'database management', 'database management system', NULL, 'C'),
(23, 6, 'Select query used to.......data?', 'delete', 'fetch', 'add', NULL, 'B'),
(24, 6, 'insert query used to', 'add data', 'delete data', 'multiply data', NULL, 'A'),
(25, 6, 'metadata mean', 'data within data', 'data about data', 'data is data', NULL, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `obtained_marks` int(11) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `user_id`, `quiz_id`, `total_marks`, `obtained_marks`, `submitted_at`) VALUES
(2, 10, 4, 5, 3, '2025-05-06 02:56:29'),
(3, 11, 5, 5, 3, '2025-05-06 05:03:41'),
(4, 10, 5, 5, 1, '2025-05-06 05:29:21'),
(5, 10, 6, 5, 4, '2025-07-14 13:51:34'),
(6, 8, 4, 5, 5, '2025-07-14 14:04:04'),
(7, 8, 5, 5, 3, '2025-07-14 16:29:28'),
(8, 8, 6, 5, 4, '2025-07-14 17:11:46');

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `id` int(11) NOT NULL,
  `tutorName` varchar(100) DEFAULT NULL,
  `tutorQualification` varchar(100) DEFAULT NULL,
  `tutorCategory` varchar(100) DEFAULT NULL,
  `tutorExperience` int(11) DEFAULT NULL,
  `tutorPicture` varchar(255) DEFAULT NULL,
  `tutorAddress` text DEFAULT NULL,
  `tutorMobile` varchar(20) DEFAULT NULL,
  `tutorFee` decimal(10,2) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `resume` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`id`, `tutorName`, `tutorQualification`, `tutorCategory`, `tutorExperience`, `tutorPicture`, `tutorAddress`, `tutorMobile`, `tutorFee`, `password`, `resume`) VALUES
(2, 'Sadia shezadi', 'Digital Marketing Diploma From AIR university', 'Content Writing', 5, '1267977_157838-OUU49K-575.jpg', 'hazro Attock DPO 7790 #street 2', '88888888888888888', '50000.00', '123', NULL),
(3, 'ateqa Kashmala', 'BSCS SOFTWARE ENGEENERING', 'Software Engeenering', 9, '25579801_projectmanager_text_1.jpg', 'PUNJABhazro Lahore stree#4', '88888888888888888', '999.00', '$2y$10$CHab08Ns93vp03zRfOvrEuKtBw.NsAuohzkeM0x3SaGdnfWYi/itC', '6817cba882c5f_VU MASTERMINDS Easyprojects List.pdf'),
(4, 'MR Umar', 'PHD CS', 'Youtube Automation', 7, 'wv52_pkc1_210811.jpg', 'RAWAT', '064332', '100000.00', '$2y$10$HDInj42CwTBFB6H6NSqdy.AZOS8TtVVelEw0RUnrxMetYDvvoiaSa', NULL),
(5, 'MS Sana Raoo', 'MSCS Computer science', 'Seo Expert', 8, '936959_ODDTXP0.jpg', 'ISLAMABAD street#7', '88888888888888888', '10000.00', '$2y$10$7F4v285A28RCyF0XxeXHf.ZQVF9yQaGC4P8wKi8gjGQ2Vt0dYDeOS', NULL),
(6, 'Asia Khan', 'PHD CS', 'Cripto currency', 7, '_61b787c4-91a6-4a3a-bcbd-0d12a6c2e1a9.jpg', 'lahore street#245', '6660004567', '900.00', '$2y$10$3lvNMH79saHvgyahE9itHODn5pEDQHPHMjMtU1RpXYWV/fWugTxmy', NULL),
(7, 'DiyaShezadi', 'PHD', 'Software Engeenering', 2, 'Our team logo.jpg', 'lahore street#5', '6660004567', '6600000.00', '$2y$10$swglQfK8no4wC86teS1Bbu8ecOzP/a/30q.GVMTnWtvn5P64xAXJ2', '687499c800024_CS614 Final Term Current subjective by Masters.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `uploadvoucher`
--

CREATE TABLE `uploadvoucher` (
  `id` int(11) NOT NULL,
  `studentName` varchar(100) DEFAULT NULL,
  `tutorID` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploadvoucher`
--

INSERT INTO `uploadvoucher` (`id`, `studentName`, `tutorID`, `filename`, `uploaded_at`, `email`, `status`, `user_id`) VALUES
(15, 'aish', 3, 'uploads/1746400896_WhatsApp Image 2024-11-20 at 2.24.33 AM.jpeg', '2025-05-04 23:21:36', 'sadia@gmail.com', 'Approved', NULL),
(16, 'aish', 3, 'uploads/1746400936_WhatsApp Image 2024-11-20 at 2.24.33 AM.jpeg', '2025-05-04 23:22:16', 'sadia@gmail.com', 'Approved', NULL),
(17, 'aish', 3, 'uploads/1746400948_WhatsApp Image 2024-11-20 at 2.24.33 AM.jpeg', '2025-05-04 23:22:28', 'sadia@gmail.com', 'Approved', NULL),
(19, 'Ateeqa', 3, '../uploads/1746406128_bg.jpg', '2025-05-05 00:48:48', 'ateeqa@gmail.com', 'Approved', NULL),
(20, 'Ateeqa', 3, '../uploads/1746406284_bg.jpg', '2025-05-05 00:51:24', 'ateeqa@gmail.com', 'Approved', NULL),
(21, 'ateeqa1', 4, '../uploads/1746406327_pexels-anna-nekrashevich-6802049 (1).jpg', '2025-05-05 00:52:07', 'ateeqa@gmail.com', 'Approved', 9),
(22, 'user', 3, '../uploads/1746491182_succulent-plant-mockup-small-gray-pot.jpg', '2025-05-06 00:26:22', 'user@gmail.com', 'Approved', 10),
(23, 'user', 3, '../uploads/1746491192_succulent-plant-mockup-small-gray-pot.jpg', '2025-05-06 00:26:32', 'user@gmail.com', 'Approved', 10),
(24, 'demo', 4, '../uploads/1746507462_succulent-plant-mockup-small-gray-pot.jpg', '2025-05-06 04:57:42', 'demo@gmail.com', 'Rejected', 11),
(25, 'user', 6, '../uploads/1752452190_831899362433875605.jpg', '2025-07-14 00:16:30', 'sadia@gmail.com', 'Approved', 8),
(26, 'user', 7, '../uploads/1752500493__61b787c4-91a6-4a3a-bcbd-0d12a6c2e1a9.jpg', '2025-07-14 13:41:33', 'user@gmail.com', 'Approved', 10),
(27, 'user', 4, '../uploads/1752512975__61b787c4-91a6-4a3a-bcbd-0d12a6c2e1a9.jpg', '2025-07-14 17:09:35', 'user@gmail.com', 'Pending', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `contact`) VALUES
(8, 'Diya', 'sadia@gmail.com', 'sadia', '1122'),
(9, 'ateqa', 'ateeqa@gmail.com', 'ateeqa', '1122'),
(10, 'user', 'user@gmail.com', 'user', '4455667'),
(11, 'demo', 'demo@gmail.com', 'demo', 'demo'),
(12, 'tset', 'tset@gmail.com', 'test', '333');

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE `user_courses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`id`, `user_id`, `course_id`) VALUES
(27, 11, 1),
(28, 11, 2),
(29, 11, 4),
(30, 11, 6),
(31, 11, 8),
(32, 11, 10),
(38, 8, 1),
(39, 8, 2),
(40, 8, 3),
(41, 8, 4),
(98, 10, 1),
(99, 10, 2),
(100, 10, 3),
(101, 10, 4),
(102, 10, 5),
(103, 10, 6),
(104, 10, 8),
(105, 10, 9),
(106, 10, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_links`
--
ALTER TABLE `class_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutor_id` (`tutor_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutors`
--
ALTER TABLE `tutors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploadvoucher`
--
ALTER TABLE `uploadvoucher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `class_links`
--
ALTER TABLE `class_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tutors`
--
ALTER TABLE `tutors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `uploadvoucher`
--
ALTER TABLE `uploadvoucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_courses`
--
ALTER TABLE `user_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quizzes_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `quiz_questions_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `uploadvoucher`
--
ALTER TABLE `uploadvoucher`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD CONSTRAINT `user_courses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

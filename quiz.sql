-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 06:55 PM
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
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(256) NOT NULL,
  `price` int(6) NOT NULL,
  `image` varchar(50) NOT NULL,
  `file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `price`, `image`, `file`) VALUES
(1, 'Model Test', 'This book is very good for admission test', 10, 'cover.jpg', 'zahid.pdf'),
(2, 'bangla book', 'first book first book first book ', 20, 'zahid.jpg', 'zahid.pdf'),
(3, 'বাংলা', 'first book first book first book ', 50, 'cover.jpg', 'zahid.pdf'),
(4, 'বিশ্ববিদ্যালয় ভর্তি কোচিং', 'This book is very good for admission test', 30, 'zahid.jpg', 'zahid.pdf'),
(5, 'বাংলা', 'first book first book first book ', 30, 'zahid.jpg', 'zahid.pdf'),
(6, 'বিশ্ববিদ্যালয় ভর্তি কোচিং', 'This book is very good for admission test', 50, 'zahid.jpg', 'zahid.pdf'),
(7, 'বাংলা', 'zahjkjhhfgfghfhgf', 15, 'zahid.jpg', 'zahid.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(6) UNSIGNED NOT NULL,
  `notice` varchar(256) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `notice`, `reg_date`) VALUES
(1, 'Today no exam now', '2023-11-20 04:22:40'),
(2, 'Welcome', '2023-11-20 04:32:55'),
(3, 'আগামিকাল সকাল ৯ টায় পরীক্ষা হবে ', '2023-11-20 17:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `questionlist`
--

CREATE TABLE `questionlist` (
  `id` int(6) UNSIGNED NOT NULL,
  `qtitle` varchar(30) NOT NULL,
  `qdescription` varchar(30) NOT NULL,
  `qtime` int(6) NOT NULL,
  `qstart` varchar(30) NOT NULL,
  `qtablename` varchar(30) NOT NULL,
  `qresulttable` varchar(30) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questionlist`
--

INSERT INTO `questionlist` (`id`, `qtitle`, `qdescription`, `qtime`, `qstart`, `qtablename`, `qresulttable`, `reg_date`) VALUES
(1, 'Varsity Admission test', 'Masud Sir', 30, '0', 'quiz_1700495525', 'quiz_1700495525_result', '2023-11-20 16:08:33'),
(2, 'Varsity Admission test', 'Masud Sir', 35, '0', 'quiz_1700496484', 'quiz_1700496484_result', '2023-11-20 17:16:07'),
(3, 'Nahid Hasan', 'Zahid Sir Quiz Notice', 10, '0', 'quiz_1700498375', 'quiz_1700498375_result', '2023-11-20 16:39:35'),
(4, 'Varsity Admission test One', 'Alim sir', 30, '0', 'quiz_1700500514', 'quiz_1700500514_result', '2023-11-20 17:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_1700496484`
--

CREATE TABLE `quiz_1700496484` (
  `si` varchar(255) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `option5` varchar(255) DEFAULT NULL,
  `option6` varchar(255) DEFAULT NULL,
  `option7` varchar(255) DEFAULT NULL,
  `option8` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_1700496484`
--

INSERT INTO `quiz_1700496484` (`si`, `question`, `answer`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`, `option7`, `option8`) VALUES
('q1', 'your name', 'one', 'one', 'two', 'three', 'four', 'Zahid', 'Nahid', 'Mehedy', 'Sakib'),
('q2', 'your name', 'two', 'one', 'two', 'three', 'four', 'Zahid', 'Nahid', 'Mehedy', 'Sakib'),
('q3', 'your name', 'three', 'one', 'two', 'three', 'four', 'Zahid', 'Nahid', 'Mehedy', 'Sakib'),
('q4', 'your name', 'four', 'one', 'two', 'three', 'four', 'Zahid', 'Nahid', 'Mehedy', 'Sakib');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_1700496484_result`
--

CREATE TABLE `quiz_1700496484_result` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `score` varchar(6) NOT NULL,
  `total` varchar(6) NOT NULL,
  `percentage` int(6) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_1700496484_result`
--

INSERT INTO `quiz_1700496484_result` (`id`, `name`, `phone`, `score`, `total`, `percentage`, `reg_date`) VALUES
(1, 'Nahid', '', '3', '2.75', 75, '2023-11-20 16:09:00'),
(2, 'Nahid', '', '3', '2.75', 75, '2023-11-20 16:20:16'),
(3, 'Nahid', '', '3', '2.75', 75, '2023-11-20 16:24:19'),
(4, 'Nahid', '+8801703500404', '2', '1.75', 50, '2023-11-20 16:25:42'),
(5, 'Nahid', '+8801703500404', '3', '2.75', 75, '2023-11-20 16:37:45'),
(6, 'Nahid', '+8801703500404', '3', '2.75', 75, '2023-11-20 16:38:44'),
(7, 'Nahid', '+8801703500404', '3', '2.75', 75, '2023-11-20 16:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_1700498375`
--

CREATE TABLE `quiz_1700498375` (
  `si` varchar(255) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `option5` varchar(255) DEFAULT NULL,
  `option6` varchar(255) DEFAULT NULL,
  `option7` varchar(255) DEFAULT NULL,
  `option8` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_1700498375`
--

INSERT INTO `quiz_1700498375` (`si`, `question`, `answer`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`, `option7`, `option8`) VALUES
('q1', 'your name', 'one', 'one', 'two', 'three', 'four', 'Zahid', 'Nahid', 'Mehedy', 'Sakib'),
('q2', 'your name', 'two', 'one', 'two', 'three', 'four', 'Zahid', 'Nahid', 'Mehedy', 'Sakib'),
('q3', 'your name', 'three', 'one', 'two', 'three', 'four', 'Zahid', 'Nahid', 'Mehedy', 'Sakib'),
('q4', 'your name', 'four', 'one', 'two', 'three', 'four', 'Zahid', 'Nahid', 'Mehedy', 'Sakib');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_1700498375_result`
--

CREATE TABLE `quiz_1700498375_result` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `score` varchar(6) NOT NULL,
  `total` varchar(6) NOT NULL,
  `percentage` int(6) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_1700500514`
--

CREATE TABLE `quiz_1700500514` (
  `si` varchar(255) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `option5` varchar(255) DEFAULT NULL,
  `option6` varchar(255) DEFAULT NULL,
  `option7` varchar(255) DEFAULT NULL,
  `option8` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_1700500514`
--

INSERT INTO `quiz_1700500514` (`si`, `question`, `answer`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`, `option7`, `option8`) VALUES
('q1', 'তৎসম শব্দের ব্যবহার কোন রীতিতে বেশি হয়? ', 'two', 'one', 'two', 'three', 'four', ' চলিত রীতি', 'সাধু রীতি', 'মিশ্র রীতি', 'আঞ্চলিক রীতি '),
('q2', 'সাধু ভাষা সাধারণত কোথায় অনুপযোগী?', 'four', 'one', 'two', 'three', 'four', 'কবিতার পংক্তিতে', 'গানের কলিতে', 'গল্পের কলিতে ', 'নাটকের সংলাপে'),
('q3', 'সাধু ভাষা ও চলিত ভাষার পার্থক', 'four', 'one', 'two', 'three', 'four', 'বাক্যের সরল ও জটিল রূপে', 'শব্দের রূপগত ভিন্নতায় ', 'তৎসম ও অতৎসম শব্দের ব্যবহারে ', ' ক্রিয়াপদ ও সর্বনাম পদের রূপগত ভিন্নতায়'),
('q4', 'সাধু ও চলিত রীতি বাংলা ভাষার কোনরূপে বিদ্যমান?  ', 'three', 'one', 'two', 'three', 'four', 'আঞ্চলিক ', 'উপভাষা ', 'লেখ্য', 'কথ্য '),
('q5', 'চলিতরীতির শব্দ নয় কোনটি?  ', 'three', 'one', 'two', 'three', 'four', 'করবার', 'করার ', 'করিবার', 'করে'),
('q6', 'ভাষার কোন রীতি তদ্ভব শব্দ বহুল?', 'two', 'one', 'two', 'three', 'four', 'সাধুরীতি ', 'চলিত রীতি ', 'কথ্য রীতি ', 'বানান রীতি '),
('q7', 'জুতো শব্দটি কোন ভাষারীতির?  ', 'two', 'one', 'two', 'three', 'four', 'সাধু', 'চলিত ', 'প্রাকৃত', 'কোল '),
('q8', 'কোনটি চলিত ভাষার বৈশিষ্ট্য? ', 'two', 'one', 'two', 'three', 'four', 'গাম্ভীর্য', 'প্রমিত উচ্চারণ ', 'তৎসম শব্দের বহুল ব্যবহার ', 'ব্যাকরণ অনুসরণ করে চলে'),
('q9', 'কোন ভাষারীতির পদবিন্যাস সুনিয়ন্ত্রিত ও সুনির্দিষ্ট?', 'three', 'one', 'two', 'three', 'four', 'তথ্য ভাষা', 'আঞ্চলিক ভাষা ', 'সাধু ভাষা ', 'চলিত ভাষা'),
('q10', '‘বুনো’ কোন ভাষারীতির শব্দ? ', 'four', 'one', 'two', 'three', 'four', 'সাধু ভাষা', 'কথ্য ভাষা ', 'আঞ্চলিক ভাষা ', 'চলিত ভাষা ');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_1700500514_result`
--

CREATE TABLE `quiz_1700500514_result` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `score` varchar(6) NOT NULL,
  `total` varchar(6) NOT NULL,
  `percentage` int(6) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_1700500514_result`
--

INSERT INTO `quiz_1700500514_result` (`id`, `name`, `phone`, `score`, `total`, `percentage`, `reg_date`) VALUES
(1, 'Nahid', '01713905601', '5', '4.75', 50, '2023-11-20 17:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(6) UNSIGNED NOT NULL,
  `uname` varchar(30) NOT NULL,
  `schoolname` varchar(30) NOT NULL,
  `thana` varchar(30) NOT NULL,
  `district` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `uname`, `schoolname`, `thana`, `district`, `email`, `phone`, `reg_date`) VALUES
(1, 'Nahid', 'Rajshahi University', 'Rajshahi', 'Rajshahi', 'patsala181@gmail.com', '+8801703500404', '2023-11-19 15:31:45'),
(2, 'Nahid', 'Rajshahi University', 'Rajshahi', 'Rajshahi', 'patsala181@gmail.com', '01713905601', '2023-11-20 16:55:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionlist`
--
ALTER TABLE `questionlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_1700496484_result`
--
ALTER TABLE `quiz_1700496484_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_1700498375_result`
--
ALTER TABLE `quiz_1700498375_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_1700500514_result`
--
ALTER TABLE `quiz_1700500514_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questionlist`
--
ALTER TABLE `questionlist`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quiz_1700496484_result`
--
ALTER TABLE `quiz_1700496484_result`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quiz_1700498375_result`
--
ALTER TABLE `quiz_1700498375_result`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_1700500514_result`
--
ALTER TABLE `quiz_1700500514_result`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2023 at 11:04 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smss_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `num_students` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lor_request`
--

CREATE TABLE `lor_request` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `professor_name` varchar(255) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `purpose` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lor_request`
--

INSERT INTO `lor_request` (`id`, `student_id`, `professor_name`, `university_name`, `department_name`, `deadline`, `purpose`, `created_at`) VALUES
(2, 3, 'Vedant', 'Gujrat', 'CSE', '2023-03-09', 'I need LOR pls', '2023-03-02 18:23:36'),
(3, 3, 'Vedant', 'Gujrat', 'CSE', '2023-03-09', 'I need LOR plssss', '2023-03-02 18:24:25'),
(4, 3, 'Rajiv Sir', 'Mumbai', 'CSE', '2023-03-25', 'Relocation', '2023-03-02 21:19:39'),
(5, 15, 'teacher1', 'Mumbai University', 'Electrical', '2023-03-08', 'ASAP', '2023-03-07 14:36:57'),
(6, 18, 'Rakesh', 'Mumbai University', 'Mechanical', '2023-03-09', 'Rthsg', '2023-03-07 18:12:08'),
(7, 3, 'Manmohan Singh (Computer)', 'FCRIT', 'Computer Engineering', '2023-03-26', 'Hemlo', '2023-03-08 14:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `lor_requests`
--

CREATE TABLE `lor_requests` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `professor_identifier` varchar(255) NOT NULL,
  `professor_name` varchar(255) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `purpose` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lor_requests`
--

INSERT INTO `lor_requests` (`id`, `student_id`, `professor_identifier`, `professor_name`, `university_name`, `department_name`, `deadline`, `purpose`, `created_at`) VALUES
(0, 3, 'teacher1', 'Manmohan Singh (Computer)', 'FCRIT', 'Computer Engineering', '2023-03-24', 'Help', '2023-03-08 16:32:19'),
(0, 3, 'teacher1', 'Manmohan Singh (Computer)', 'FCRIT', 'Computer Engineering', '2023-03-31', 'Hemlo again', '2023-03-08 16:40:05'),
(0, 3, 'teacher1', 'Manmohan Singh (Computer)', 'FCRIT', 'Computer Engineering', '2023-03-31', 'Yes yes yes', '2023-03-08 16:51:35');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests_for_lor`
--

CREATE TABLE `requests_for_lor` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `professor_identifier` varchar(255) NOT NULL,
  `professor_name` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `roll_number` varchar(255) NOT NULL,
  `university_name` varchar(255) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `purpose` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests_for_lor`
--

INSERT INTO `requests_for_lor` (`id`, `student_id`, `professor_identifier`, `professor_name`, `full_name`, `roll_number`, `university_name`, `department_name`, `deadline`, `purpose`) VALUES
(12, 3, 'teacher1', 'Manmohan Singh (Computer)', 'Rajesh Mahal Chauhan', '1020111', 'Mumbai Univesity', 'Computer Engineering', '2023-03-31', 'Dr. Vinayak, Professor, VIT-Vellore'),
(14, 15, 'teacher1', 'Manmohan Singh (Computer)', 'Aman Das', '12324', 'asd', 'asd', '2023-03-30', 'Heeloo'),
(15, 3, 'Rakesh', 'Rakesh Ranjan (EXTC)', 'Rajesh Mahal Chauhan', '1020111', 'Mumbai Univesity', 'Computer Engineering', '2023-03-17', 'Dr. Vinayak Garg, Professor, VIT-Vellore'),
(16, 15, 'Rakesh', 'Rakesh Ranjan (EXTC)', 'Aman Das', '1020133', 'Mumbai University', 'Electrical', '2023-03-28', 'Mr. Winston Churchil, Hiring Manager, Vedantu Technologies');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT '',
  `roll_number` varchar(255) DEFAULT '',
  `date_of_birth` date DEFAULT NULL,
  `street_address` varchar(255) DEFAULT '',
  `city` varchar(255) DEFAULT '',
  `state` varchar(255) DEFAULT '',
  `zip_code` varchar(255) DEFAULT '',
  `phone_number` varchar(255) DEFAULT '',
  `institute_name` varchar(255) DEFAULT '',
  `department_name` varchar(255) DEFAULT '',
  `university_name` varchar(255) DEFAULT '',
  `academic_year` varchar(255) DEFAULT '',
  `start_year` varchar(255) DEFAULT '',
  `end_year` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`id`, `user_id`, `email`, `username`, `full_name`, `roll_number`, `date_of_birth`, `street_address`, `city`, `state`, `zip_code`, `phone_number`, `institute_name`, `department_name`, `university_name`, `academic_year`, `start_year`, `end_year`) VALUES
(1, 3, 'user1@gmail.com', 'student1', 'Rajesh Mahal Chauhan', '1020111', '2004-04-09', 'Thakur Village', 'Jabalpur', 'Rajasthan', '400124', '+91804333546', 'FCRIT', 'Computer Engineering', 'Mumbai Univesity', '2020-24', '2020-01-09', '2024-06-10'),
(8, 15, 'aman@gmail.com', 'Aman', 'Aman Das', '1020133', '2003-06-03', 'Sector-17, Near Times of India Building', 'Thane', 'Maharashtra', '410206', '+91810333433', 'FCRIT', 'Electrical', 'Mumbai University', '2020-24', '2020-01-30', '2024-05-31'),
(9, 23, 'raj@email.com', 'Raj', 'Raj Malik', '1020145', '2023-03-15', 'Dheerpur', 'Chennai', 'Tamil Nadu', '401252', '09888889', 'FCRIT', 'Mechanical', 'Mumbai University', '23-24', '2023-03-22', '2023-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_profile`
--

CREATE TABLE `teacher_profile` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) DEFAULT '',
  `phone_number` varchar(255) DEFAULT '',
  `qualification` varchar(255) DEFAULT '',
  `department` varchar(255) DEFAULT '',
  `date_of_joining` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_profile`
--

INSERT INTO `teacher_profile` (`id`, `email`, `username`, `full_name`, `phone_number`, `qualification`, `department`, `date_of_joining`) VALUES
(4, 'teacher1@gmail.com', 'teacher1', 'Manmohan Singh', '9867542356', 'Mtech', 'Computer', '2023-03-14'),
(16, 'rakesh@gmail.com', 'Rakesh', 'Rakesh Ranjan', '98989898', 'Ph.D', 'EXTC', '2023-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('student','teacher','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `reset_token`, `reset_token_expires_at`, `created_at`, `reset_token_expiry`) VALUES
(1, 'guffpatri', '$2y$10$siwJyCZUhSFrBi8tIc4IHOTY5Nw0PZI6M3YLlZPltJpHjLoWfAhcG', 'guff@gmail.com', 'admin', '477a4f267779f1c631afd0d7e77c1aa1f23b1693d32be85f558d827859e07b08', '2023-02-28 18:01:58', '2023-02-28 12:57:00', NULL),
(3, 'student1', '$2y$10$93yxGu8HcNAOkl35j6KLWOPQCb7l/fToTrBvCePgjAoGblXREiZ9i', 'user1@gmail.com', 'student', NULL, NULL, '2023-02-28 13:00:56', NULL),
(4, 'teacher1', '$2y$10$ROv8C7CTQxBxfg8SZxR/PeSehM6yALygRasqPl6lA1WxxaWbOfqre', 'teacher1@gmail.com', 'teacher', NULL, NULL, '2023-02-28 13:01:31', NULL),
(11, 'admin', '$2y$10$zn3bF6Dw5ttGuj02wFZFuud2M.SdmPCRmpBZ11C.17uRJveWk4eTK', 'admin@gmail.com', 'admin', NULL, NULL, '2023-03-05 04:56:07', NULL),
(15, 'Aman', '$2y$10$e/MAfWunAZ9Ub0XnKkBA4e.BmWG5m9KacWa1fb5/NAstjLdKAwxZW', 'aman@gmail.com', 'student', NULL, NULL, '2023-03-07 12:27:10', NULL),
(16, 'Rakesh', '$2y$10$vVOK84s4ZNgkzAYncfCmreeiDkEbc9HRNxg1/.2yt6ECclRBYWeKG', 'rakesh@gmail.com', 'teacher', NULL, NULL, '2023-03-07 12:27:44', NULL),
(18, 'mohan', '$2y$10$WSOZmDHz7ZUjzQSPBzJRjuvYiAfBVASSvTypXv9.E2tFl0enTj/Aq', 'mohan@gmail.com', 'student', NULL, NULL, '2023-03-07 16:13:05', NULL),
(23, 'Raj', '$2y$10$Zi5Q5jOeG8rHW8VlClsGcOtyIHjViHChDiJwKpWR0CLcGs2mNJ1Nu', 'raj@email.com', 'student', NULL, NULL, '2023-03-17 17:51:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `lor_request`
--
ALTER TABLE `lor_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `requests_for_lor`
--
ALTER TABLE `requests_for_lor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_requests_for_lor_professor_identifier` (`professor_identifier`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lor_request`
--
ALTER TABLE `lor_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests_for_lor`
--
ALTER TABLE `requests_for_lor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_profile`
--
ALTER TABLE `student_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `lor_request`
--
ALTER TABLE `lor_request`
  ADD CONSTRAINT `lor_request_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD CONSTRAINT `student_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_details_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

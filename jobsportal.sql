-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 24, 2025 at 02:06 PM
-- Server version: 10.11.13-MariaDB-0ubuntu0.24.04.1
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobsportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `salary` int(10) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `requirements` text NOT NULL,
  `benefits` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`id`, `user_id`, `title`, `description`, `salary`, `tags`, `company`, `address`, `city`, `state`, `phone`, `email`, `requirements`, `benefits`, `created_at`) VALUES
(1, 1, 'Software Engineer', 'We are seeking a skilled software engineer to develop high-quality software solutions', 90000, 'development, coding, java, python,', 'Tech Solutions Inc.', '123 Main St', 'Albany', 'NY', '348-334-3949', 'info@techsolutions.com', 'Bachelors degree in Computer Science or related field, 3+ years of software development experience', 'Healthcare, 401(k) matching, flexible work hours', '2025-07-22 06:52:42'),
(4, 3, 'Web Developer 2', 'Join our team as a Web Developer and create amazing web applications', 37777, 'web development, programming', 'WebTech Solutions', '789 Web Ave', 'Chicago', 'IL', '456-876-5432', 'info@webtechsolutions.com', 'Bachelors degree in Computer Science or related field, proficiency in HTML, CSS, JavaScript', 'Competitive salary, professional development opportunities, friendly work environment', '2025-07-22 06:52:42'),
(8, 1, 'Web Developer', 'Join our team as a Web Developer and create amazing web applications', 37777, 'web development, programming', 'WebTech Solutions', '789 Web Ave', 'Chicago', 'IL', '456-876-5432', 'info@webtechsolutions.com', 'Bachelors degree in Computer Science or related field, proficiency in HTML, CSS, JavaScript', '', '2025-07-24 06:31:57'),
(10, 1, 'Demo', 'df', 100, 'web development, programming', 'd', 'Dhaka', 'Dhaka', 'ILA', '1628651490', 'crrakib5@gmail.com', 'd', 'd', '2025-07-24 10:59:11'),
(16, 4, 'Changed title', 'fd', 100, 'fd', 'fd', 'fd', 'fd', 'q', '16286514980', 'info@webtechsolutions.com', 'fdf', '', '2025-07-24 11:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `city`, `state`, `password`, `created_at`) VALUES
(1, 'Demo', 'demo1@demo.com', NULL, NULL, '$2y$10$EQ497Y4AX8T6olEP2grk7eq7KxxdqxIGT2MStbgbD.jkb/mNxAsQC', '2025-07-22 06:44:54'),
(2, 'Demo2', 'demo2@demo.com', NULL, NULL, '$2y$10$EQ497Y4AX8T6olEP2grk7eq7KxxdqxIGT2MStbgbD.jkb/mNxAsQC', '2025-07-22 06:44:54'),
(3, 'Demo3', 'demo3@demo.com', NULL, NULL, '$2y$10$EQ497Y4AX8T6olEP2grk7eq7KxxdqxIGT2MStbgbD.jkb/mNxAsQC', '2025-07-22 06:44:54'),
(4, 'Ali Azgar Rakib', 'aliazgarrakib@gmail.com', 'd', 'd', '$2y$10$EQ497Y4AX8T6olEP2grk7eq7KxxdqxIGT2MStbgbD.jkb/mNxAsQC', '2025-07-24 08:13:38'),
(5, 'Ali Azgar Rakib', 'demo@demo.com', 'dfd', 'dfd', '$2y$10$TIg9ngSkfmGpDwB0r/BGje/ayFJY2J9id/S.XnOdCpycP9lXQXiXa', '2025-07-24 08:49:07'),
(6, 'Ali Azgar Rakib', 'dkjfkdj@dl.co', 'dfd', 'dfd', '$2y$10$pE9koUR6.wtUAZ3CHaS7HutduGqyDs6DPFhEgzZGA2P5C1XNr5WxG', '2025-07-24 09:05:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_listings_users` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `listings`
--
ALTER TABLE `listings`
  ADD CONSTRAINT `fk_listings_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2026 at 11:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rescue_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `emergency_requests`
--

CREATE TABLE `emergency_requests` (
  `id` int(11) NOT NULL,
  `help_seeker_id` int(11) NOT NULL,
  `emergency_type` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `priority` enum('low','medium','high','critical') NOT NULL DEFAULT 'medium',
  `victim_type` enum('self','other') NOT NULL DEFAULT 'self',
  `victim_information` text DEFAULT NULL,
  `victim_count` int(11) NOT NULL DEFAULT 1,
  `contact_information` varchar(150) NOT NULL,
  `status` enum('pending','assigned','ongoing','completed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `volunteer_id` int(11) DEFAULT NULL,
  `accepted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emergency_requests`
--

INSERT INTO `emergency_requests` (`id`, `help_seeker_id`, `emergency_type`, `location`, `description`, `priority`, `victim_type`, `victim_information`, `victim_count`, `contact_information`, `status`, `created_at`, `updated_at`, `volunteer_id`, `accepted_at`) VALUES
(1, 3, 'medical', 'Mirpur', 'A person needs immediate medical assistance.', 'high', 'self', NULL, 1, '01300000000', 'assigned', '2026-08-24 15:57:34', '2026-08-28 08:41:09', 4, '2026-08-28 14:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `help_seeker_id` int(11) NOT NULL,
  `rescue_request_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('pending','reviewed','resolved') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `alert_type` enum('normal','important','emergency') NOT NULL DEFAULT 'normal',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `created_by`, `title`, `message`, `alert_type`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Flood emergency alert', 'Rescue operation active in zone A', 'emergency', 'inactive', '2026-08-21 08:19:14', '2026-08-21 09:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `rescue_reports`
--

CREATE TABLE `rescue_reports` (
  `id` int(11) NOT NULL,
  `emergency_request_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `rescue_status` enum('pending','ongoing','completed','cancelled') NOT NULL DEFAULT 'pending',
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','volunteer','witness','help_seeker') NOT NULL,
  `availability` enum('available','unavailable') NOT NULL DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `availability`, `created_at`, `updated_at`) VALUES
(1, 'System Admin', 'admin@rescue.com', '01700000000', '$2y$10$0TxWWt5Dy4zyekIjW/gJYefYvGILexixK0i/rsl1F3fPTZtSN3vai', 'admin', 'available', '2026-08-21 07:35:46', '2026-08-21 07:35:46'),
(2, 'Tanaka Rahman', 'tanaka@rescue.com', '01800000000', '$2y$10$lJMs7egNit.DoRe/xM7asO35.mHpp0cuKqiPA2alhtQ5s7/bZah.y', 'witness', 'available', '2026-08-21 08:18:48', '2026-08-21 08:18:48'),
(3, 'Parvej', 'parvej@rescue.com', '01900000000', '$2y$10$UHacZYTqkzzRovwowls1fuc41RobBnObJZQkJ8UH5u/zUU9Y/T80W', 'help_seeker', 'available', '2026-08-23 05:36:16', '2026-08-23 05:36:16'),
(4, 'Suporna', 'suporna@rescue.com', '01300000000', '$2y$10$9KF9gXFTFbPW1UwEGm5A2epXacKWrMWmjabHNztosJGFy0PAiZsJq', 'volunteer', 'unavailable', '2026-08-27 20:12:38', '2026-08-28 09:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `witness_reports`
--

CREATE TABLE `witness_reports` (
  `id` int(11) NOT NULL,
  `witness_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `incident_type` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `incident_date` datetime NOT NULL,
  `evidence_file` varchar(255) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `witness_reports`
--

INSERT INTO `witness_reports` (`id`, `witness_id`, `title`, `description`, `incident_type`, `location`, `incident_date`, `evidence_file`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Accident', 'Near kuril', 'accident', 'kuril', '2026-08-22 14:00:00', NULL, 'pending', '2026-08-22 10:36:42', '2026-08-22 10:36:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_emergency_help_seeker` (`help_seeker_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_feedback_help_seeker` (`help_seeker_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notifications_admin` (`created_by`);

--
-- Indexes for table `rescue_reports`
--
ALTER TABLE `rescue_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rescue_reports_admin` (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `witness_reports`
--
ALTER TABLE `witness_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_witness_reports_user` (`witness_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rescue_reports`
--
ALTER TABLE `rescue_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `witness_reports`
--
ALTER TABLE `witness_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emergency_requests`
--
ALTER TABLE `emergency_requests`
  ADD CONSTRAINT `fk_emergency_help_seeker` FOREIGN KEY (`help_seeker_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback_help_seeker` FOREIGN KEY (`help_seeker_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_admin` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `rescue_reports`
--
ALTER TABLE `rescue_reports`
  ADD CONSTRAINT `fk_rescue_reports_admin` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `witness_reports`
--
ALTER TABLE `witness_reports`
  ADD CONSTRAINT `fk_witness_reports_user` FOREIGN KEY (`witness_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

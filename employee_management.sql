-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 06:10 PM
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
-- Database: `employee_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` bigint(20) UNSIGNED NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'IT', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `designation_id` bigint(20) UNSIGNED NOT NULL,
  `designation` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`designation_id`, `designation`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Web Developer', 'active', NULL, NULL),
(2, 'Project Manager', 'active', NULL, NULL),
(3, 'HR', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `designation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `joining_date` date NOT NULL,
  `DoB` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` int(11) NOT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `religion` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `designation_id`, `emp_type_id`, `joining_date`, `DoB`, `gender`, `address`, `salary`, `payment_status`, `religion`, `experience`, `created_at`, `updated_at`) VALUES
(6, 6, 3, 4, '2023-10-13', '2023-10-13', 'female', 'sdfsdf', 2134123, 'unpaid', 'Islam', '1 year', '2023-10-13 04:56:54', '2023-10-13 05:26:34'),
(7, 7, 1, 3, '2023-10-13', '2023-10-13', 'male', 'dfg sdfg dsfg', 113, 'unpaid', 'Hindu', 'wer', '2023-10-13 11:36:20', '2023-10-13 11:36:20'),
(8, 8, 1, 1, '2023-10-25', '2023-10-02', 'male', 'dhaka', 70000, 'unpaid', 'Islam', '2 years', '2023-10-13 12:26:21', '2023-10-13 12:26:21'),
(9, 9, 2, 1, '2023-10-04', '2023-10-10', 'male', 'Dakshin Deshibai', 66000, 'unpaid', 'Islam', '1 year', '2023-10-13 20:09:05', '2023-10-13 20:47:35'),
(10, 10, 3, 1, '2023-10-27', '2023-10-01', 'female', 'rangpur', 50000, 'unpaid', 'Islam', '3 years', '2023-10-13 20:10:59', '2023-10-13 20:10:59'),
(13, 13, 1, 1, '2023-11-10', '2023-10-10', 'female', 'Dakshin Deshibai', 33333, 'unpaid', 'Islam', '3 years', '2023-10-13 20:44:55', '2023-10-13 20:44:55'),
(14, 14, 3, 1, '2023-11-02', '2023-10-01', 'male', 'dhaka', 44444, 'unpaid', 'Islam', '5 year', '2023-10-13 20:49:49', '2023-10-13 20:49:49'),
(15, 15, 1, 1, '2023-11-03', '2023-10-03', 'female', 'rrrr', 99999, 'unpaid', 'Islam', '1 year', '2023-10-13 20:52:19', '2023-10-13 20:52:19'),
(16, 16, 1, 1, '2023-11-01', '2023-10-11', 'male', 'kkkkkkk', 9999, 'unpaid', 'Islam', '3 years', '2023-10-13 20:55:20', '2023-10-13 20:55:20'),
(23, 23, 1, 1, '2023-10-06', '2023-10-03', 'male', 'Dakshin Deshibai', 55555, 'unpaid', 'Islam', '1 year', '2023-10-13 22:09:53', '2023-10-13 22:09:53'),
(24, 24, 1, 1, '2023-10-06', '2023-10-03', 'male', 'Dakshin Deshibai', 55555, 'unpaid', 'Islam', '1 year', '2023-10-13 22:10:11', '2023-10-13 22:10:11'),
(25, 25, 2, 3, '2023-10-31', '2023-10-01', 'female', 'Dakshin Deshibai', 77777, 'paid', 'Islam', '3 years', '2023-10-13 22:14:45', '2023-10-16 01:19:35'),
(34, 35, 1, 1, '2023-11-01', '2023-10-17', 'male', 'nai', 45000, 'unpaid', 'Islam', '1 year', '2023-10-17 00:02:22', '2023-10-17 00:02:22'),
(35, 36, 1, 1, '2023-10-17', '2023-10-17', 'male', 'fsdfsdf', 123, 'unpaid', 'Islam', '1 year', '2023-10-17 00:50:36', '2023-10-17 00:50:36'),
(36, 37, 1, 1, '2023-10-17', '2023-10-17', 'male', 'sdfsd', 42000, 'unpaid', 'Islam', '1 year', '2023-10-17 02:12:01', '2023-10-17 02:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `employee_types`
--

CREATE TABLE `employee_types` (
  `emp_type_id` bigint(20) UNSIGNED NOT NULL,
  `employee_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_types`
--

INSERT INTO `employee_types` (`emp_type_id`, `employee_type`, `created_at`, `updated_at`) VALUES
(1, 'Full time', NULL, NULL),
(2, 'Sesonal', NULL, NULL),
(3, 'Remote', NULL, NULL),
(4, 'Partime', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_10_12_070128_create_departments_table', 1),
(2, '2023_10_12_070202_create_designations_table', 2),
(3, '2023_10_12_070241_create_employee_types_table', 3),
(6, '2014_10_12_000000_create_users_table', 4),
(7, '2023_10_12_075734_create_employees_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `role` enum('admin','user') NOT NULL DEFAULT 'user' COMMENT 'admin,user',
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `status`, `role`, `department_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Imran dfgdfg', 'mdimranali4921@gmail.com', '01517841621', 'active', 'user', 1, NULL, '$2y$10$Xfbc9eSvzb0JwkJtghVXduQdSluROPO.JoZwpVht7knPBAefr0Dgy', NULL, '2023-10-13 04:56:54', '2023-10-13 06:04:07'),
(7, 'sijan', 'sijan@gmail.com', '01517841621', 'active', 'user', 1, NULL, '$2y$10$qxpFfkB1J5qdG.kChJlfy.kmOA.9bYLcCgHOwcReIaoaoV6xvanVa', NULL, '2023-10-13 11:36:20', '2023-10-13 11:36:20'),
(8, 'siju', 'siju@gmail.com', '01745674327', 'active', 'user', 1, NULL, '$2y$10$UxRPUj/2/9VchEqNeF8.4OqCCNLfszYo9Reufioe01GK8qUiLpEhO', NULL, '2023-10-13 12:26:21', '2023-10-13 12:26:21'),
(9, 'sohel', 'sohel@gmail.com', '01737470502', 'active', 'user', 1, NULL, '$2y$10$BTZOOiaH7ZUQaNF0XdmWaeB892vPPaoM1yDZC0qdA6KmN5J3MTBba', NULL, '2023-10-13 20:09:04', '2023-10-13 20:09:04'),
(10, 'shimu', 'shimu@gmail.com', '01737470502', 'active', 'user', 1, NULL, '$2y$10$o/WaexgIpwjy89ZUbZKnV.sVnRBzUEN6b2ya0w7ds4vdslOIXIrp2', NULL, '2023-10-13 20:10:59', '2023-10-13 20:10:59'),
(13, 'shima', 'shima@gmail.com', '01737470502', 'active', 'user', 1, NULL, '$2y$10$ffwO0UypLPA4VcGTYoKUTuGFWzsrf6PnN5NoLtljIgN.bnWM7kz7O', NULL, '2023-10-13 20:44:55', '2023-10-13 20:44:55'),
(14, 'rafi', 'rafi@gmail.com', '01737470502', 'active', 'user', 1, NULL, '$2y$10$Tcc0PxRkiK/1tPgQZxWidefH885sBCSAb94RnT0FXdUHyamGyoDTa', NULL, '2023-10-13 20:49:49', '2023-10-13 20:49:49'),
(15, 'sss', 'sss@gmail.com', '01737470502', 'active', 'user', 1, NULL, '$2y$10$lj0w6ugVhDnxbXaj5EnSTuxSsV4Dd3mYcGQOVH/1w6TVhB0GH5EfW', NULL, '2023-10-13 20:52:19', '2023-10-13 20:52:19'),
(16, 'pppll', 'ppp@gmail.com', '01737470502', 'active', 'user', 1, NULL, '$2y$10$l5A2maVTSXCqGuetxJiTdeFUzjCzWdkeCiBw1SI038B3We2lUYGwe', NULL, '2023-10-13 20:55:20', '2023-10-14 01:10:37'),
(23, 'ghfh', 'ghfh@gmail.com', '01737470502', 'active', 'user', 1, NULL, '$2y$10$nY44PwErKp9K3s4UQGfvSemrzKrqp5qRQgFYGm9ZTgE1iDC.JYAF2', NULL, '2023-10-13 22:09:53', '2023-10-13 22:09:53'),
(24, 'ghfh', 'ghfht@gmail.com', '01737470502', 'active', 'user', 1, NULL, '$2y$10$NaZ4mO5EnCM2wBc1vXdfI.YALb/c67nDdnQPYLEpVlrC1DSjsef8m', NULL, '2023-10-13 22:10:11', '2023-10-13 22:10:11'),
(25, 'user', 'user@gmail.com', '01737470502', 'active', 'user', 1, NULL, '$2y$10$tadysfFixatMmXZY/blhSOxF4aY523txuW7MlELxT6gWG9qYn7hBW', NULL, '2023-10-13 22:14:45', '2023-10-13 22:14:45'),
(35, 'imran', 'imran@gmail.com', '01517841621', 'active', 'admin', 1, NULL, '$2y$10$MuJOP757QordY6.Ygk1wreuvTG0xcLn0gzTakWzDV/Bha160.1CYy', NULL, '2023-10-17 00:02:22', '2023-10-17 00:02:22'),
(36, 'emp', 'emp@gmail.com', '01517841621', 'active', 'user', 1, NULL, '$2y$10$SuTJj4V5rHp7uw1nN3LQtOsF0iydABCr4CuPJuvG915yeTwM7H8hy', NULL, '2023-10-17 00:50:36', '2023-10-17 00:50:36'),
(37, 'admin', 'admin@gmail.com', '01517841621', 'active', 'admin', 1, NULL, '$2y$10$omNoYRBBtq9T1vStB3C3ZeWin4NRa/G0W9SUtPvRpzjjBap6Pc.g.', NULL, '2023-10-17 02:12:01', '2023-10-17 02:12:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_user_id_foreign` (`user_id`),
  ADD KEY `employees_designation_id_foreign` (`designation_id`),
  ADD KEY `employees_emp_type_id_foreign` (`emp_type_id`);

--
-- Indexes for table `employee_types`
--
ALTER TABLE `employee_types`
  ADD PRIMARY KEY (`emp_type_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `designation_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `employee_types`
--
ALTER TABLE `employee_types`
  MODIFY `emp_type_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`designation_id`),
  ADD CONSTRAINT `employees_emp_type_id_foreign` FOREIGN KEY (`emp_type_id`) REFERENCES `employee_types` (`emp_type_id`),
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`dept_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

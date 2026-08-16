-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 15, 2026 at 07:58 PM
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
-- Database: `lifevault`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `category` varchar(50) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_important` tinyint(1) NOT NULL,
  `is_shared` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `remember_token_hash` varchar(255) DEFAULT NULL,
  `remember_token_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `country`, `phone_number`, `password`, `profile_image`, `created_at`, `reset_token`, `reset_expires`, `remember_token_hash`, `remember_token_expires`) VALUES
(16, 'Jivesh', 'jivesh2104@gmail.com', 'USA', '09896725011', '$2y$10$rzgvsCjxsqA5bzjjYSvGfuCQgvUJXrqQQWwTjLo6ZD9sbDJo2Va/.', '', '2026-08-12 09:59:45', NULL, NULL, NULL, NULL),
(18, 'Taranpreet Singh', 'taranpreetsingh62006@gmail.com', '', '', '$2y$10$F.q7mpCLvamoKqWgTKRnSuqcnaYc3qsBXyDm4M9G6ulilrzbTlovm', '', '2026-08-12 14:09:42', NULL, NULL, '8df23cd852bd2c3198f7e5b9e9c9f7ff2ed10d5d95b486f7724cd9727174dbf3', '2026-09-13 19:18:23'),
(19, 'mayank monga', 'mayankmonga2323@gmail.com', 'India', '8989898989', '$2y$10$JSjBDhLqfkwlxmlpY4VmbO96HNsihB2L7UIgwyh7IZQdQI9NZQuLi', '', '2026-08-13 05:08:05', NULL, NULL, NULL, NULL),
(22, 'Taranpreet Singh', 'taranpreet62006@gmail.com', '', '', '$2y$10$0HgsM93Y3ODwxwRwGPogKuW3aogO7wlcF20lI/BHlr/M/CQlT.wQu', '', '2026-08-13 05:09:18', NULL, NULL, '5623eed2d90240c48a2ed96368919e871ea1265910390c3490f7d1803e929124', '2026-09-12 07:09:18'),
(23, '', '', 'Choose Country', '', '$2y$10$XfdLBCUAiSB5DXn.VBWWeuv13Yes09CiWPV/R3w7bXtLn.Y/t9SV.', '', '2026-08-13 17:12:20', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2026 at 01:31 AM
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
-- Database: `db_galeri_foto`
--

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `foto_id` int(11) NOT NULL,
  `judul_foto` varchar(255) DEFAULT NULL,
  `deskripsi_foto` text DEFAULT NULL,
  `tanggal_unggah` date DEFAULT NULL,
  `lokasi_file` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`foto_id`, `judul_foto`, `deskripsi_foto`, `tanggal_unggah`, `lokasi_file`, `user_id`) VALUES
(1, 'my avatar roblox', 'testing', '2026-04-11', '1775901392-779.png', 0),
(2, 'my avatar roblox gueh', 'holaa', '2026-04-11', '1775903419-325.png', 2),
(3, 'my mine 🤓', 'contoh loh ya', '2026-04-11', '1775903990-467.png', 3),
(4, 'contoh', 'contoh', '2026-04-13', '1776058471-127.png', 2),
(5, 'bawakdehel', 'killer nya ngikut loh ya', '2026-04-16', '1776335254-162.png', 2),
(6, 'well well well', 'my ava', '2026-04-16', '1776335291-101.png', 2),
(7, 'getea', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2026-04-16', '1776345973-262.png', 2),
(8, 'mancing loh ya', 'abcd', '2026-04-16', '1776346313-790.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `like_foto`
--

CREATE TABLE `like_foto` (
  `like_id` int(11) NOT NULL,
  `foto_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tanggal_like` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `like_foto`
--

INSERT INTO `like_foto` (`like_id`, `foto_id`, `user_id`, `tanggal_like`) VALUES
(1, 2, 2, '2026-04-11'),
(2, 2, 2, '2026-04-11'),
(3, 2, 2, '2026-04-11'),
(4, 2, 2, '2026-04-11'),
(5, 2, 3, '2026-04-11'),
(6, 3, 3, '2026-04-11'),
(7, 3, 2, '2026-04-11'),
(8, 3, 2, '2026-04-11'),
(9, 3, 2, '2026-04-11'),
(10, 3, 2, '2026-04-11'),
(11, 3, 2, '2026-04-11'),
(12, 3, 2, '2026-04-11'),
(13, 3, 2, '2026-04-11'),
(14, 2, 2, '2026-04-13'),
(15, 3, 2, '2026-04-13'),
(16, 3, 2, '2026-04-13'),
(17, 3, 2, '2026-04-13'),
(18, 2, 2, '2026-04-13'),
(19, 2, 2, '2026-04-13'),
(20, 2, 2, '2026-04-13'),
(21, 2, 2, '2026-04-13'),
(22, 4, 2, '2026-04-13'),
(23, 4, 2, '2026-04-13'),
(24, 5, 2, '2026-04-16'),
(25, 5, 2, '2026-04-16'),
(26, 5, 2, '2026-04-16'),
(27, 5, 2, '2026-04-16'),
(28, 5, 2, '2026-04-16'),
(29, 5, 2, '2026-04-16'),
(30, 5, 2, '2026-04-16'),
(31, 6, 2, '2026-04-16'),
(32, 6, 2, '2026-04-16'),
(33, 6, 2, '2026-04-16'),
(34, 6, 2, '2026-04-16'),
(35, 6, 2, '2026-04-16'),
(36, 6, 2, '2026-04-16'),
(37, 3, 2, '2026-04-16'),
(38, 3, 2, '2026-04-16'),
(39, 3, 2, '2026-04-16'),
(40, 4, 2, '2026-04-16'),
(41, 7, 2, '2026-04-16'),
(42, 7, 2, '2026-04-16'),
(43, 6, 2, '2026-04-17'),
(44, 6, 2, '2026-04-17'),
(45, 6, 2, '2026-04-17'),
(46, 6, 2, '2026-04-17'),
(47, 6, 2, '2026-04-17'),
(48, 6, 2, '2026-04-17'),
(49, 6, 2, '2026-04-17'),
(50, 8, 2, '2026-04-18'),
(51, 8, 2, '2026-04-18'),
(52, 8, 2, '2026-04-18'),
(53, 8, 2, '2026-04-18'),
(54, 8, 2, '2026-04-18'),
(55, 7, 2, '2026-04-18'),
(56, 7, 2, '2026-04-18'),
(57, 7, 2, '2026-04-18'),
(58, 7, 2, '2026-04-18'),
(59, 7, 2, '2026-04-18'),
(60, 7, 2, '2026-04-18'),
(61, 7, 2, '2026-04-18'),
(62, 7, 2, '2026-04-18'),
(63, 6, 2, '2026-04-18'),
(64, 6, 2, '2026-04-18'),
(65, 6, 2, '2026-04-18'),
(66, 6, 2, '2026-04-18'),
(67, 7, 3, '2026-04-18'),
(68, 7, 3, '2026-04-18'),
(69, 7, 3, '2026-04-18'),
(70, 7, 3, '2026-04-18'),
(71, 7, 3, '2026-04-18'),
(72, 7, 3, '2026-04-18'),
(73, 7, 3, '2026-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `role`) VALUES
(2, 'Peanuts', 'azanmahaputra22@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(3, 'Tukang Like', 'thegamers2805@gmail.com', 'dcddb75469b4b4875094e14561e573d8', 'user'),
(4, 'Azan Maha Putra', 'azanmahaputra12@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(5, 'Peanuts', 'sumbul65@gmail.com', 'dcddb75469b4b4875094e14561e573d8', 'user'),
(6, 'Sumbul', 'Sumbul67@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`foto_id`);

--
-- Indexes for table `like_foto`
--
ALTER TABLE `like_foto`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `like_foto`
--
ALTER TABLE `like_foto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

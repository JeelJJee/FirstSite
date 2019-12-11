-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2019 at 03:48 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bak`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` smallint(6) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `message` text NOT NULL,
  `dateofcom` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `whoseart` int(11) NOT NULL,
  `ipadress` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `name`, `message`, `dateofcom`, `whoseart`, `ipadress`) VALUES
(61, 'ccc', 'Привет всем!', '2019-12-11 15:01:54', 75, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` smallint(6) NOT NULL,
  `login` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nick` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `nick`, `date`, `status`) VALUES
(1, 'ccccc', '6a10e095368dc1a801bba9cffd633d93', 'ccc', 'cccc', '2019-10-23 05:43:01', NULL),
(2, 'wewe', '00093e97df83f57a5a807c0e8fbc24e0', 'ewee', 'ewew', '2019-10-23 05:43:01', NULL),
(3, 'wewe', 'a4dd44d36c4d3ff3d5a55de1988df4e0', 'ewee', 'ewew', '2019-10-23 05:43:01', 111),
(4, 'ccc', '4aa230a5626abe2b56c98cca68b39519', 'ccc', 'ccc', '2019-10-23 05:43:01', 222),
(5, 'ff', 'cb0878c48b0b9ff2265d9b928534dfc4', 'ff', 'ff', '2019-10-23 05:43:33', NULL),
(6, 'vv', 'a867401a4956d7b4169871726d92f302', 'vv', 'vv', '2019-10-23 05:45:05', NULL),
(7, '', '7e2e6188d9295a5e7d9d8fb34cdfc852', 'dkdd', '', '2019-10-25 17:11:14', NULL),
(8, 'rrr', '37d59d617136dbabd447ad0b994e564d', 'rrr', 'rrr', '2019-10-31 22:46:27', NULL),
(9, 'ccc', '2455259fddd7a539ce92f968b3e7b983', 'kok', 'ccc', '2019-11-01 15:06:16', NULL),
(14, 's', '3bfc829da041eb1f0c557b4bfbec9c60', 's', 's', '2019-11-27 08:48:55', NULL),
(15, 'hex', 'da6905f9b12287331d9a9499ebe63c08', 'тот', 'hex', '2019-12-06 10:42:05', NULL),
(16, 'ccc', '4aa230a5626abe2b56c98cca68b39519', 'ccc', 'ccc', '2019-12-10 08:33:05', NULL),
(17, 'qqq', '9e12a785358b747c87bf10dc0d392d26', 'qqq', 'qqq', '2019-12-11 10:14:53', NULL),
(18, 'чч', 'c9563f53842d2a72f8a998691757960b', 'чч', 'xx', '2019-12-11 14:45:48', NULL),
(19, 'ggg', '5e02f04cb0e8dd006616d3954225d75a', 'ggg', 'ggg', '2019-12-11 14:46:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE `words` (
  `nick` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `post_data` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `words` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `text_id` int(11) NOT NULL,
  `files` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`nick`, `title`, `post_data`, `category`, `words`, `text_id`, `files`) VALUES
('ccc', 'Заголовок', '2019-12-11 15:01:42', 'Природа', 'Текст', 75, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`login`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`text_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
  MODIFY `text_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

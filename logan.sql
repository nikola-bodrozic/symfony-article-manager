-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 25, 2016 at 12:41 PM
-- Server version: 5.7.15-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logan`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8_unicode_ci,
  `owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `name`, `time`, `location`, `details`, `owner_id`) VALUES
(20, 'Darth\'s Birthday Party!', '2016-10-04 12:00:00', 'Deathstar', 'Ha! Darth HATES surprises!!!', 23),
(21, 'Rebellion Fundraiser Bake Sale!', '2017-10-27 12:00:00', 'Endor', 'ort the rebellion!', 23),
(22, 'test', '2011-01-01 00:00:00', 'lok', 'fghfgh fghfghf', 26);

-- --------------------------------------------------------

--
-- Table structure for table `article_user`
--

CREATE TABLE `article_user` (
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article_user`
--

INSERT INTO `article_user` (`article_id`, `user_id`) VALUES
(20, 23),
(20, 24),
(21, 23),
(21, 24),
(22, 23);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  `is_active` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `roles`, `is_active`, `email`) VALUES
(23, 'ron', '$2y$13$ISvCgSU8dfvuORJrkYWyyuWgWB9C4EmolfA65a12IgT9DR04KGW.a', '["ROLE_USER"]', 1, 'ron@example.com'),
(24, 'mike', '$2y$13$LwYWEcyei1UjcC2cmGJZ5OvH.BJVyRksDKd4LMOntg3EW2OwXUZ66', '["ROLE_USER"]', 1, 'mike@example.com'),
(25, 'admin', '$2y$13$DqDmj06uFq2oGNnkXOahCe4e9VyvDKf1d/VL.ibwaIfzwwxgDtWye', '["ROLE_ADMIN"]', 1, 'admin@example.com'),
(26, 'test', '$2y$13$/cXpIYmyWdBax1AHx.8Bjeye5qnu20bgZSpHMp16Sk8b6umclk592', '["ROLE_USER"]', 1, 'qw@qw.bn45345t');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23A0E667E3C61F9` (`owner_id`);

--
-- Indexes for table `article_user`
--
ALTER TABLE `article_user`
  ADD PRIMARY KEY (`article_id`,`user_id`),
  ADD KEY `IDX_3DD151487294869C` (`article_id`),
  ADD KEY `IDX_3DD15148A76ED395` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD UNIQUE KEY `UNIQ_8D93D64935C246D5` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E667E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `article_user`
--
ALTER TABLE `article_user`
  ADD CONSTRAINT `FK_3DD151487294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3DD15148A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

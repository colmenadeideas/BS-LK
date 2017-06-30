-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2017 at 07:59 PM
-- Server version: 5.6.33
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db23550_likes`
--

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `id` int(11) NOT NULL,
  `relationship` int(11) NOT NULL,
  `data` longtext CHARACTER SET latin1 NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`id`, `relationship`, `data`, `creationdate`) VALUES
(3, 1, '{"namespace":"Colmena"}', '2017-04-13 19:07:42'),
(4, 4, '{"namespace":"otro"}', '2017-04-13 19:53:49'),
(5, 5, '{"namespace":"Otro2"}', '2017-04-13 21:45:23'),
(6, 1, '{"namespace":"TEST"}', '2017-04-20 13:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `data` longtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `from` varchar(255) CHARACTER SET latin1 NOT NULL,
  `data` longtext CHARACTER SET latin1 NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE `relationships` (
  `id` int(11) NOT NULL,
  `users` int(11) NOT NULL,
  `relationships` int(11) NOT NULL,
  `roles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`id`, `users`, `relationships`, `roles`) VALUES
(1, 19, 6, 19);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(70) DEFAULT NULL,
  `instagram_id` int(11) DEFAULT NULL,
  `access_token` longtext,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pass_hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `instagram_id`, `access_token`, `timestamp`, `status`, `pass_hash`) VALUES
(1, 'e0979', 12312, NULL, '2015-10-15 12:16:02', '', '0'),
(19, 'likesapp.co', 1987920606, '1987920606.8a6d178.cacf0bf2777b43c59e89c9d87c877a7f', '2017-04-13 19:07:11', 'active', 'sha256:1000::TRMIl0Lxzkw6cKkcPUjnHV6FS1KSS7Og');

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE `users_profile` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`id`, `username`, `email`, `fullname`, `data`) VALUES
(1, 'e0979', '', 'Delia Larez', ''),
(2, 'colmenadeideas', '', 'Colmena de Ideas\r\n', ''),
(19, 'likesapp.co', NULL, 'likes', 'a:7:{s:2:"id";s:10:"1987920606";s:8:"username";s:11:"likesapp.co";s:15:"profile_picture";s:94:"https://scontent-lga3-1.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg";s:9:"full_name";s:5:"likes";s:3:"bio";s:0:"";s:7:"website";s:18:"http://likesapp.co";s:12:"instagram_id";s:10:"1987920606";}');

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE `user_session` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `session_randomkey` varchar(255) NOT NULL,
  `url_in` mediumtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_session`
--

INSERT INTO `user_session` (`id`, `username`, `ip_address`, `session_randomkey`, `url_in`, `timestamp`) VALUES
(4, 'likesapp.co', '190.142.16.246', '193167515558ecd06806be21.45654166', 'localhost/BS-LK/html/account/update/email', '2017-04-11 12:47:46'),
(5, 'likesapp.co', '190.142.16.246', '145685421558eceabf89cd43.29970165', 'localhost/BS-LK/html/account/oauth/instagram/?code=8f0a099d46014f41ba1e919e1fb70586', '2017-04-11 14:39:59'),
(6, 'likesapp.co', '190.142.16.246', '82278177858eceaee7b0845.82263390', 'localhost/BS-LK/html/account/oauth/instagram/?code=58bdb1d4a1294c0ebde5d2148ee9df1b', '2017-04-11 14:40:46'),
(7, 'likesapp.co', '190.142.16.246', '170819026058ecfe71ddb776.30524697', 'localhost/BS-LK/html/account/oauth/instagram/?code=b0f87e5733f742759ff9682fcdced706', '2017-04-11 16:04:01'),
(8, 'likesapp.co', '190.142.16.246', '66187862658ef74978a18a2.87751086', 'localhost/BS-LK/html/account/oauth/instagram/?code=fe0ae83e5571401f8bc07a8043651953', '2017-04-13 12:52:39'),
(9, 'likesapp.co', '190.142.16.246', '78587294158efcc5f45cdf1.93607622', 'localhost/BS-LK/html/account/oauth/instagram/?code=329c75d1b5d34fd1922b1b10f284f67a', '2017-04-13 19:07:11'),
(10, 'likesapp.co', '190.142.16.246', '11254967158efcef37c3d82.96157456', 'localhost/BS-LK/html/account/oauth/instagram/?code=6665c9ec15f349ce8337157718dc3039', '2017-04-13 19:18:11'),
(11, 'likesapp.co', '190.142.16.246', '183016963558f4a94c927589.80591148', 'localhost/BS-LK/html/account/oauth/instagram/?code=4f96222d58954471ae12ca924dbe0278', '2017-04-17 11:38:52'),
(12, 'likesapp.co', '190.142.16.246', '187149641858f8b4515e4cf6.36453791', 'localhost/BS-LK/html/account/oauth/instagram/?code=49b9c659576140d083f61eac11ce60a0', '2017-04-20 13:14:57'),
(13, 'likesapp.co', '190.142.16.246', '1006995144593ec8c7ca9b76.00364080', 'localhost/BS-LK/html/account/oauth/instagram/?code=de67d7fd4b5747ba9aaa44734c41f4b6', '2017-06-12 17:00:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_profile`
--
ALTER TABLE `users_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `relationships`
--
ALTER TABLE `relationships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users_profile`
--
ALTER TABLE `users_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user_session`
--
ALTER TABLE `user_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

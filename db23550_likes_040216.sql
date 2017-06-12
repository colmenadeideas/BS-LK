-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 04, 2016 at 12:56 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db23550_likes`
--

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `relationship` int(11) NOT NULL,
  `data` longtext CHARACTER SET latin1 NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`id`, `relationship`, `data`, `creationdate`) VALUES
(1, 1, '{"namespace":"NutribitesVE","cover":"cover.jpg"}', '2015-10-09 19:46:11'),
(2, 2, '{"namespace":"ColmenadeIdeas","cover":"cover.jpg"}', '2015-10-15 01:38:21'),
(3, 0, '{"namespace":"Okidoc"}', '2015-12-07 11:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `data` longtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post`, `user`, `data`, `timestamp`) VALUES
(1, 1, 2, '{"text":"Me parece que todo esta perfecto!"}', '2015-10-19 01:35:27'),
(2, 1, 1, '{"text":"another comment"}', '2015-10-22 00:54:44'),
(95, 1, 1, '{"text":"test!"}', '2015-11-08 21:46:11'),
(96, 2, 1, '{"text":"is it"}', '2015-11-11 02:17:45'),
(97, 19, 1, '{"text":"este es 19"}', '2015-11-16 00:22:09'),
(98, 20, 1, '{"text":"20 is"}', '2015-11-16 00:22:55'),
(99, 21, 1, '{"text":"post 21"}', '2015-11-24 15:33:29'),
(100, 20, 1, '{"text":"siii"}', '2015-11-25 23:14:56'),
(101, 20, 1, '{"text":"no viste?"}', '2015-11-25 23:15:08'),
(102, 22, 1, '{"text":"no se porque"}', '2015-11-25 23:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `from` varchar(255) CHARACTER SET latin1 NOT NULL,
  `data` longtext CHARACTER SET latin1 NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `parent`, `from`, `data`, `creationdate`) VALUES
(1, 1, 'dlarez@besign.com.ve', '{"image":"test.jpg", "to":"@otrousuario"}', '2015-10-01 19:17:20'),
(2, 1, 'dlarez@besign.com.ve', '{"image":"test.jpg", "to":"@otrousuario", "like":"1"}', '2015-10-02 19:17:20'),
(3, 1, 'dlarez@besign.com.ve', '{"image":"test.jpg", "to":"@otrousuario"}', '2015-10-03 19:17:20'),
(4, 1, 'dlarez@besign.com.ve', '{"image":"test.jpg", "to":"@otrousuario"}', '2015-10-05 19:17:20'),
(5, 1, 'dlarez@besign.com.ve', '{"image":"test.jpg", "to":"@otrousuario"}', '2015-10-09 19:17:20'),
(6, 1, 'dlarez@besign.com.ve', '{"image":"test.jpg", "to":"@otrousuario"}', '2015-10-09 19:17:20'),
(19, 1, '', '{"image":"20151115-075145564921998ab307.48443738-.jpg"}', '2015-11-16 00:21:45'),
(20, 2, '', '{"image":"20151115-075239564921cf52b276.37542862-.jpg"}', '2015-11-16 00:22:39'),
(21, 1, '', '{"image":"20151124-1102305654830e536000.15514039-dlarez_besign_com_ve.jpg"}', '2015-11-24 15:32:30'),
(22, 2, '', '{"image":"20151125-06453556564117a78f38.38941091-dlarez_besign_com_ve.jpg"}', '2015-11-25 23:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `relationships`
--

CREATE TABLE `relationships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users` longtext COLLATE utf8_unicode_ci NOT NULL,
  `relationships` longtext COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `relationships`
--

INSERT INTO `relationships` (`id`, `users`, `relationships`, `roles`) VALUES
(1, '{"owner":"1","client":"2"}', '{"boards":"1"}', '{"owner":"1", "editor":"1"}'),
(2, '{"owner":"1","client":"2"}', '{"boards":"2"}', '{"owner":"1", "editor":"1"}'),
(3, '{"owner":"1"}', '{"boards":3}', '{"owner":"1"}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(70) DEFAULT NULL,
  `instagram_id` int(11) DEFAULT NULL,
  `access_token` longtext,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `instagram_id`, `access_token`, `timestamp`) VALUES
(1, 'e0979', 12312, NULL, '2015-10-15 12:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE `users_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`id`, `username`, `fullname`, `data`) VALUES
(1, 'e0979', 'Delia Larez', ''),
(2, 'colmenadeideas', 'Colmena de Ideas\r\n', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE `user_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `session_randomkey` varchar(255) NOT NULL,
  `url_in` mediumtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

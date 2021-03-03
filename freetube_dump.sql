-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 03, 2021 at 07:01 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `freetube`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(22, 'Travel'),
(24, 'Music'),
(25, 'Finance'),
(26, 'Lifestyle');

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE `channels` (
  `channel_id` int(11) NOT NULL,
  `channel_is_admin` varchar(10) NOT NULL DEFAULT 'false',
  `channel_name` varchar(255) NOT NULL,
  `channel_img` varchar(255) NOT NULL DEFAULT 'assets/images/channels/profile_default.png',
  `channel_owner` varchar(255) NOT NULL,
  `channel_email` varchar(255) NOT NULL,
  `channel_password` varchar(255) NOT NULL,
  `channel_reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`channel_id`, `channel_is_admin`, `channel_name`, `channel_img`, `channel_owner`, `channel_email`, `channel_password`, `channel_reg_date`) VALUES
(19, 'true', 'Admin', 'assets/images/channels/profile_default.png', 'Freetube Admin', 'admin@freetube.com', '$2y$10$u0A5X1nuVrpIzthE2asbtufmNtTUovzLkNs42es7dn4LaPcYjGQv2', '2021-03-03 19:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(200) NOT NULL,
  `com_vid_id` int(11) NOT NULL,
  `com_channel_id` int(11) NOT NULL,
  `com_content` text NOT NULL,
  `com_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(200) NOT NULL,
  `like_vid_id` int(11) NOT NULL,
  `like_channel_id` int(11) NOT NULL,
  `like_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `vid_id` int(11) NOT NULL,
  `vid_cat_id` int(3) NOT NULL,
  `vid_channel_id` int(11) NOT NULL,
  `vid_tags` varchar(255) NOT NULL,
  `vid_title` varchar(255) NOT NULL,
  `vid_url` text NOT NULL,
  `vid_com_count` int(11) NOT NULL DEFAULT '0',
  `vid_like_count` int(11) NOT NULL DEFAULT '0',
  `vid_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`channel_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`vid_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `vid_id` int(11) NOT NULL AUTO_INCREMENT;

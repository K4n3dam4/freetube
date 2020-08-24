-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 24, 2020 at 10:48 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

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
(25, 'Finance');

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
(5, 'false', 'SlenderMan', 'assets/images/channels/profile_default.png', 'Slender Man', 'slender@gmail.com', 'TestPasswort#123', '2020-07-26 02:56:36'),
(18, 'true', 'Admin', 'assets/images/channels/profile_default.png', 'Nils Boehm', 'john.doe@gmail.com', '$2y$10$Pbm4iEHgk0p169umJC5Eje1R0aG4oUPCK/WwcNHotuMB27opGM3jy', '2020-08-02 18:20:29'),
(19, 'false', 'Travelmate', 'assets/images/channels/19/travel_profile.jpeg', 'John Doe', 'john.d@travelmate.com', '$2y$10$TpK2JYqbDIsVTb39XTlHVuzzQ6YRYUKCeL.ubxv2M/Exjutj7vHz2', '2020-08-02 18:21:48'),
(20, 'false', 'The Globe Trotter', 'assets/images/channels/20/globe.png', 'Jordan Smith', 'jordan.smith@gmail.com', '$2y$10$LkVtvq3Zz32htcga3aJwzeiquHOVNACz8S21HklMVLP.OzGPhUHG2', '2020-08-02 19:59:31'),
(23, 'false', 'Techno Podcast', 'assets/images/channels/23/techno_profile.jpeg', 'Alex Miller', 'technopodcast@gmail.com', '$2y$10$Ux3rdSPYg24.udwa5zOKXumgI0xQTBxq/WR81NZhXvn6NDX8pSmOK', '2020-08-21 17:04:42');

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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `com_vid_id`, `com_channel_id`, `com_content`, `com_date`) VALUES
(87, 130, 20, 'So beautiful! Paris is on my travel list, too!', '2020-08-21 16:56:02'),
(88, 136, 20, 'winner winner chicken dinner!', '2020-08-21 16:57:20'),
(89, 132, 23, 'Nice!', '2020-08-21 17:05:04'),
(90, 132, 23, 'Would love to go there!', '2020-08-21 17:05:20'),
(91, 137, 23, 'Special guest Victor Ruiz!', '2020-08-21 17:08:06'),
(92, 136, 23, 'Are there any good parties you can recommend in Vegas?', '2020-08-21 17:10:07');

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

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `like_vid_id`, `like_channel_id`, `like_date`) VALUES
(32, 129, 20, '2020-08-21 16:54:43'),
(33, 130, 20, '2020-08-21 16:55:05'),
(34, 136, 20, '2020-08-21 16:57:03'),
(35, 132, 20, '2020-08-21 17:01:31'),
(36, 132, 23, '2020-08-21 17:04:56'),
(37, 137, 23, '2020-08-21 17:07:27'),
(38, 136, 23, '2020-08-21 17:09:45'),
(39, 136, 19, '2020-08-22 22:11:46');

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
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`vid_id`, `vid_cat_id`, `vid_channel_id`, `vid_tags`, `vid_title`, `vid_url`, `vid_com_count`, `vid_like_count`, `vid_date`) VALUES
(129, 22, 19, 'Paris, Bridge, Bir Hakeim, Europe, Travel', 'Trip to Paris - Part 1', 'assets/videos/channels/19/bir_hakeim.mp4', 0, 1, '2020-08-21'),
(130, 22, 19, 'Paris, Eifeltower, Europe, Travel', 'Trip to Paris - Part 2', 'assets/videos/channels/19/eifeltower.mp4', 1, 1, '2020-08-21'),
(131, 22, 19, 'Airport, Flight, Waiting, Miles & More, Singapore Airlines', 'On the Way to Singapore', 'assets/videos/channels/19/people_waiting.mp4', 0, 0, '2020-08-21'),
(132, 22, 19, 'Singapore, Party, Night, Fun', 'Party in Singapore', 'assets/videos/channels/19/Night-Out.mp4', 2, 2, '2020-08-21'),
(133, 22, 20, 'Camping, Travel, Mountains, Holidays', 'Camping in Apalachia', 'assets/videos/channels/20/terrace.mp4', 0, 0, '2020-08-21'),
(134, 22, 20, 'Portugal, Beach, Sunset, Dawn, Riff', 'Portugal - 2020', 'assets/videos/channels/20/portugal.mp4', 0, 0, '2020-08-21'),
(135, 22, 20, 'Portugal, Beach, Sea, Impressive', 'Portugal - 2019', 'assets/videos/channels/20/coverr-landscape-in-algarve-portugal-2813.mp4', 0, 0, '2020-08-21'),
(136, 22, 20, 'Vegas, Casino, Jackpot, Fun, Hangover, Party', 'Las Vegas - 2019', 'assets/videos/channels/20/Night-vision.mp4', 2, 3, '2020-08-21'),
(137, 24, 23, 'Lake, Party, Fun, Summer, Techno', 'Open Air at Lake', 'assets/videos/channels/23/coverr-drone-shot-lake-party-0293.mp4', 1, 1, '2020-08-21');

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
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `vid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 26, 2016 at 11:17 PM
-- Server version: 5.5.48-37.8
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rocknlos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `phrase_id` int(11) NOT NULL,
  `phrase` varchar(255) CHARACTER SET utf8 NOT NULL,
  `english` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE IF NOT EXISTS `noticeboard` (
  `notice_id` int(11) NOT NULL,
  `notice_title` text NOT NULL,
  `notice` text NOT NULL,
  `create_timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'AutoWeightLoss'),
(2, 'system_title', 'AutoWeightLoss'),
(3, 'address', ''),
(4, 'phone', ''),
(5, 'paypal_email', ''),
(7, 'system_email', ''),
(8, 'buyer', 'kgom1028'),
(9, 'purchase_code', '0'),
(10, 'language', 'English'),
(11, 'text_align', 'left-to-right');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `weight_now` float NOT NULL DEFAULT '0',
  `weight_goal` float NOT NULL DEFAULT '0',
  `blood_type` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `country` varchar(100) NOT NULL DEFAULT ' ',
  `state` varchar(100) NOT NULL DEFAULT ' ',
  `city` varchar(100) NOT NULL DEFAULT '',
  `zip_code` varchar(100) NOT NULL DEFAULT ' ',
  `photo_url` varchar(300) NOT NULL,
  `gcm_id` varchar(300) NOT NULL,
  `token` varchar(300) NOT NULL,
  `time` datetime NOT NULL,
  `facebook_id` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `email`, `password`, `name`, `weight_now`, `weight_goal`, `blood_type`, `height`, `birthday`, `country`, `state`, `city`, `zip_code`, `photo_url`, `gcm_id`, `token`, `time`, `facebook_id`, `gender`) VALUES
(16, 'jack@gmail.com', 'qqq', 'jack', 222, 222, 2, 222, '2008-07-26', '', '', '', '', 'public/image/1471075878.jpg', '', '14590b49ed5d5fd0db3337115081b7dc1ffb4e8848a6292882ecdbbcbc31bcc9', '2016-08-13 03:12:42', '', 1),
(22, 'jong@gmail.com', 'qqq', 'Jong', 132, 132, 0, 176, '1996-07-27', '', '', '', '', 'public/image/user_nophoto.png', '', 'd29ea3157578f8f9922c0cf114c5513320e937816fe2e9f94cd92598d71165b9', '2016-07-27 09:36:34', '', 0),
(23, 'sarahcos.1977@gmail.com', '#Cristina122', 'Suzana', 125, 120, 0, 7, '1977-07-27', '', '', '', '', 'public/image/1469643790.jpg', '', '8fa57ab2f7359716d8fbb69af599b038ccb3373ccd774d34b1f70312e2229078', '2016-07-27 01:24:48', '', 1),
(24, 'testing@testing.com', 'testing', 'Dom', 200, 100, 0, 100, '1997-10-15', '', '', '', '', 'public/image/1469719606.jpg', '', '016e3437c8db0c15d2801b9fb8b1f2127ebf6709a6f4e6f0deaf007fd9800df3', '2016-07-28 10:26:51', '', 2),
(25, 'redflame1028@gmail.com', ',0_$LO;C', 'Jong', 222, 200, 0, 200, '1989-07-29', '', '', '', '', 'public/image/user_nophoto.png', '', '', '2016-07-29 01:59:18', '', 0),
(26, 'sarahcos.1977@yahoo.com', 'fortune500', 'suzana', 125, 120, 2, 5, '1977-07-27', '', '', '', '', '/public/image/1470145979.jpg', '', '02df5f90c81f0ddeb4868887863202f437120fea7ae27159f572795d29f4059a', '2016-08-03 01:48:22', '', 1),
(27, 'betty@gmail.com', 'qqq', 'Betty', 111, 105, 3, 572, '2001-08-13', '', '', '', '', 'public/image/1471075964.jpg', '', '', '2016-08-13 03:16:13', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forum`
--

CREATE TABLE IF NOT EXISTS `tbl_forum` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo_url` varchar(300) NOT NULL,
  `time` datetime NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_forum`
--

INSERT INTO `tbl_forum` (`id`, `content`, `user_id`, `photo_url`, `time`, `parent_id`) VALUES
(1, '', 6, '0', '2016-07-21 11:17:28', -1),
(2, 'I like this image.', 11, 'public/image/1469105169.jpg', '2016-07-21 02:48:43', -1),
(3, 'I like this image.', 11, 'public/image/1469110200.jpg', '2016-07-21 04:10:05', -1),
(4, 'I like this image.\nI''m very like this app.\n', 12, 'public/image/1469117745.jpg', '2016-07-21 06:16:03', -1),
(5, 'I like your image\n', 13, '', '2016-07-21 06:53:38', 4),
(6, 'I like your image\n', 13, '', '2016-07-21 06:53:47', 4),
(7, 'I like your image\n', 13, '', '2016-07-21 06:53:52', 4),
(8, '0', 12, 'public/image/1469155607.jpg', '2016-07-22 04:46:45', -1),
(9, 'I like this image.\nDdddd', 14, 'public/image/1469200749.jpg', '2016-07-22 05:20:11', -1),
(10, 'I like your forum\n', 14, '', '2016-07-22 05:20:41', 4),
(11, 'I like this image.', 14, 'http://192.168.1.102:88/autoweightloss/public/image/1469200816.jpg', '2016-07-22 07:09:54', -1),
(12, 'I like this image.', 14, '/public/image/1469200807.jpg', '2016-07-22 07:24:10', -1),
(13, 'I like this image.', 14, '/public/image/1469200807.jpg', '2016-07-22 07:24:39', -1),
(15, 'I like it too', 23, '', '2016-07-27 01:32:11', 14),
(16, 'I like it too', 23, '', '2016-07-27 01:32:12', 14),
(17, 'I like this image.', 23, '/public/image/1469644370.jpg', '2016-07-27 01:33:36', -1),
(18, 'I like this image.', 23, '/public/image/1469644370.jpg', '2016-07-27 01:33:38', -1),
(19, 'Pretty children!!!', 16, '', '2016-07-27 10:16:34', 18),
(20, 'Awesome', 24, '', '2016-07-28 09:59:14', 17),
(21, 'Awesome', 24, '', '2016-07-28 09:59:38', 18),
(22, 'Testing the forum ', 24, 'public/image/1469718212.jpg', '2016-07-28 10:03:47', -1),
(23, 'I like this image.', 24, '/public/image/1469718442.jpg', '2016-07-28 10:09:14', -1),
(24, 'test', 26, '', '2016-08-02 08:39:43', 17),
(25, 'Bhgchh', 16, '', '2016-08-02 12:29:47', 18),
(26, 'Bhgchh', 16, '', '2016-08-02 12:30:00', 18),
(28, 'Ddddddd', 16, 'public/image/1470233673.jpg', '2016-08-03 09:14:44', 17),
(29, 'Hhhhh', 16, 'public/image/1470234117.jpg', '2016-08-03 09:22:05', 18),
(30, 'Jong upload', 16, 'public/image/1470234634.jpg', '2016-08-03 09:31:25', 18),
(31, 'test', 26, '', '2016-08-03 01:31:18', 17),
(32, 'test', 26, '', '2016-08-03 01:32:03', 18),
(33, 'I like this image.', 16, 'public/image/1470249315.jpg', '2016-08-03 01:35:21', -1),
(34, 'Dfdf', 16, 'public/image/1470249331.jpg', '2016-08-03 01:35:40', 17),
(35, 'I like this image.', 26, '/public/image/1470249308.jpg', '2016-08-03 01:38:08', -1),
(36, 'test', 26, 'public/image/1470249568.jpg', '2016-08-03 01:39:30', 22);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE IF NOT EXISTS `tbl_message` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`id`, `title`, `content`) VALUES
(2, 'Your mind effects everything including your weight.', ''),
(5, 'This program is called Automatic Weight Loss because it is automatic.', ''),
(6, 'Automatic Weight Loss is powerful and simple.', ''),
(7, 'Forget struggling to lose weight.', ''),
(8, 'Wrap your mind around your weight dropping automatically.', ''),
(9, 'Water is a weight loser''s best friend.', ''),
(10, 'Are you willing to have weight loss be effortless?', ''),
(11, 'Your mind is powerful, you will learn to use it for weight loss.', ''),
(12, 'Learn to build your mind power.', ''),
(13, 'Imagine knowing how to focus.', ''),
(14, 'Being more powerful will come automatically.', ''),
(15, 'Automatic Weight Loss is a breakthrough in thinking.', ''),
(16, 'Imagine how happy you will be when you lose weight.', ''),
(17, 'Smile a lot. Develop a twinkle in your eyes.', ''),
(18, 'Other diets had you sacrifice. Not here.', ''),
(19, 'We use advance techniques to get through to your mind.', ''),
(20, 'Remember the scene in Matrix where the hero downloads fighting skills?', ''),
(21, 'We are like the skill download machine in the movie the Matrix.', ''),
(22, 'Get ready to expand into new levels of joy.', ''),
(23, 'We are Automatic because it is not necessary to work hard.', ''),
(24, 'Automatic Weight Loss is like rafting down a river.', ''),
(25, 'Your inner river does the work. ', ''),
(26, 'Get better at relaxing, focus and noticing your breathing.', ''),
(27, 'We practice inner weight loss.', ''),
(28, 'Your weight will drop while you sleep tonight.', ''),
(29, 'Expect victory. Your cells will follow a General with passion and vision.', ''),
(30, 'The inventor of Automatic Weight Loss lost over 120 pounds.', ''),
(31, 'Accept how you are with food.', ''),
(32, 'Acceptance transforms to change.', ''),
(33, 'Your body is Homeostasis which means it knows what to do.', ''),
(34, 'Excess weight is from eating too much fat.', ''),
(35, 'Automatic Weight Loss is your personal weight loss coach.', ''),
(36, 'This is the easiest way to lose weight: No sacrificing, no guilt, no discipline, no exercise needed.', ''),
(37, 'Binging is OK. It will stop when it is ready.', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_photo_history`
--

CREATE TABLE IF NOT EXISTS `tbl_photo_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `photo_url` text NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_photo_history`
--

INSERT INTO `tbl_photo_history` (`id`, `user_id`, `date`, `photo_url`, `weight`) VALUES
(10, 15, '2016-07-26 00:00:00', 'public/image/1469538102.jpg', 0),
(11, 15, '2016-07-26 00:00:00', 'public/image/1469538115.jpg', 0),
(13, 21, '2016-07-27 00:00:00', 'public/image/1469606134.jpg', 0),
(14, 21, '2016-07-27 00:00:00', 'public/image/1469606145.jpg', 0),
(16, 23, '2016-07-27 00:00:00', 'public/image/1469644071.jpg', 0),
(17, 23, '2016-07-27 00:00:00', 'public/image/1469644370.jpg', 0),
(18, 23, '2016-07-27 00:00:00', 'public/image/1469645160.jpg', 0),
(20, 24, '2016-07-28 00:00:00', 'public/image/1469718419.jpg', 0),
(21, 24, '2016-07-28 00:00:00', 'public/image/1469718442.jpg', 0),
(22, 26, '2016-08-02 00:00:00', 'public/image/1470145498.jpg', 0),
(23, 16, '2016-08-02 00:00:00', 'public/image/1470155784.jpg', 0),
(24, 16, '2016-08-02 00:00:00', 'public/image/1470155798.jpg', 0),
(25, 16, '2016-08-02 00:00:00', 'public/image/1470155813.jpg', 0),
(26, 16, '2016-08-02 00:00:00', 'public/image/1470163309.jpg', 0),
(28, 26, '2016-08-03 00:00:00', 'public/image/1470249265.jpg', 0),
(30, 26, '2016-08-03 00:00:00', 'public/image/1470249784.jpg', 0),
(31, 27, '2016-08-13 00:00:00', 'public/image/1471076282.jpg', 0),
(32, 27, '2016-08-13 00:00:00', 'public/image/1471076344.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sound`
--

CREATE TABLE IF NOT EXISTS `tbl_sound` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_sound`
--

INSERT INTO `tbl_sound` (`id`, `url`, `title`) VALUES
(5, '/uploads/subliminals/subliminal+binaural_8hz.mp3', 'subliminal+binaural_1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `location_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `isAdmin` int(11) NOT NULL,
  `isEnable` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `email`, `password`, `location_id`, `name`, `isAdmin`, `isEnable`) VALUES
(1, 'admin@system.com', '123456', 0, 'JinJin', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vote`
--

CREATE TABLE IF NOT EXISTS `tbl_vote` (
  `user_id` int(11) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `vote_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_weight_history`
--

CREATE TABLE IF NOT EXISTS `tbl_weight_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `photo_url` varchar(300) DEFAULT NULL,
  `weight` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_weight_history`
--

INSERT INTO `tbl_weight_history` (`id`, `user_id`, `date`, `photo_url`, `weight`) VALUES
(36, 15, '2016-07-26', '', 44.44),
(37, 15, '2016-07-26', '', 556.6),
(38, 15, '2016-07-26', '', 65.76),
(39, 16, '2016-07-27', '', 33.4),
(40, 16, '2016-07-27', '', 44.22),
(41, 23, '2016-07-27', '', 125),
(42, 23, '2016-07-27', '', 130),
(43, 23, '2016-07-27', '', 120),
(44, 16, '2016-07-27', '', 222),
(45, 24, '2016-07-28', '', 200),
(46, 24, '2016-07-28', '', 190),
(47, 24, '2016-07-28', '', 180),
(48, 25, '2016-07-29', '', 222.1),
(49, 25, '2016-07-29', '', 222.4),
(50, 26, '2016-08-01', '', 125),
(51, 26, '2016-08-01', '', 140),
(52, 26, '2016-08-01', '', 118),
(53, 26, '2016-08-03', '', 101),
(54, 26, '2016-08-03', '', 110),
(55, 27, '2016-08-13', '', 109),
(56, 27, '2016-08-13', '', 108),
(57, 27, '2016-08-13', '', 105),
(58, 27, '2016-08-13', '', 105);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_forum`
--
ALTER TABLE `tbl_forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_photo_history`
--
ALTER TABLE `tbl_photo_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sound`
--
ALTER TABLE `tbl_sound`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_weight_history`
--
ALTER TABLE `tbl_weight_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tbl_forum`
--
ALTER TABLE `tbl_forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `tbl_photo_history`
--
ALTER TABLE `tbl_photo_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `tbl_sound`
--
ALTER TABLE `tbl_sound`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_weight_history`
--
ALTER TABLE `tbl_weight_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

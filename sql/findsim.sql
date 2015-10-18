-- phpMyAdmin SQL Dump
-- version 4.4.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 18, 2015 at 06:06 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `findsim`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `adminId` int(10) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `date_created` date DEFAULT NULL,
  `time_created` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`adminId`, `user_name`, `passwd`, `date_created`, `time_created`) VALUES
(1, 'admin', '63a9f0ea7bb98050796b649e85481845', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `sno` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`sno`, `email`) VALUES
(27, 'a@a.com'),
(5, 'anshulsahni45@gmail.com'),
(1, 'anshul_sahni@rediffmail.com'),
(4, 'harshi_sony@rediffmail.com'),
(29, 'iamdon@iamdon.in'),
(11, 'richasahni@gmail.com'),
(31, 'ruchi@rcplindia.in'),
(8, 'sagarkhanna@rediffmail.com'),
(9, 'sahni.bhushan@gmail.com'),
(32, 'shan@gmail.com'),
(6, 'sharbizafar.4@gmail.com'),
(34, 'sharibzafar4@gmail.com'),
(28, 't@t.com'),
(3, 'tigers2007@rediffmail.com'),
(12, 'vini@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `sno` int(11) NOT NULL,
  `comment_table` varchar(20) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `email_id` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`sno`, `comment_table`, `comment_id`, `email_id`) VALUES
(19, 'networks', 8, 'anshul_sahni@rediffmail.com'),
(20, 'networks', 10, 'anshul_sahni@rediffmail.com'),
(21, 'networks', 11, 'anshul_sahni@rediffmail.com'),
(22, 'plan_category', 6, 'anshul_sahni@rediffmail.com'),
(23, 'plan_category', 8, 'anshul_sahni@rediffmail.com'),
(24, 'networks', 9, 'anshul_sahni@rediffmail.com'),
(25, 'networks', 8, 'richasahni@gmail.com'),
(26, 'networks', 10, 'richasahni@gmail.com'),
(27, 'networks', 11, 'richasahni@gmail.com'),
(28, 'networks', 12, 'richasahni@gmail.com'),
(29, 'networks', 13, 'richasahni@gmail.com'),
(30, 'networks', 16, 'richasahni@gmail.com'),
(31, 'plan_category', 11, 'anshul_sahni@rediffmail.com'),
(32, 'plan_category', 13, 'anshul_sahni@rediffmail.com'),
(33, 'networks', 18, 'sharibzafar4@gmail.com'),
(34, 'networks', 8, 'sharibzafar4@gmail.com');

--
-- Triggers `likes`
--
DELIMITER $$
CREATE TRIGGER `likes_add` AFTER INSERT ON `likes`
 FOR EACH ROW BEGIN
declare no_of_likes int(5);
set no_of_likes=(select count(*) from likes
	where likes.comment_id=NEW.comment_id and likes.comment_table=NEW.comment_table);
if NEW.comment_table='networks' then
	update network_comments set network_comments.likes=no_of_likes
        where network_comments.sno=NEW.comment_id;
elseif NEW.comment_table='plan_category' then
	update plan_cat_comments set plan_cat_comments.likes=no_of_likes
        where plan_cat_comments.sno=NEW.comment_id;
elseif NEW.comment_table='plans' then
	update plan_comments set plan_comments.likes=no_of_likes
        where plan_comments.sno=NEW.comment_id;
END if;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `networks`
--

CREATE TABLE IF NOT EXISTS `networks` (
  `network_id` varchar(2) NOT NULL,
  `network_name` varchar(20) NOT NULL,
  `no_of_comments` int(5) NOT NULL,
  `rating` float NOT NULL,
  `selected` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `networks`
--

INSERT INTO `networks` (`network_id`, `network_name`, `no_of_comments`, `rating`, `selected`) VALUES
('ar', 'Airtel', 7, 2.84868, 1),
('bs', 'BSNL', 2, 4.95455, 1),
('id', 'Idea', 1, 4.33333, 0),
('re', 'Reliance', 0, 3.95833, 0),
('td', 'Tata Docomo', 0, 1, 0),
('vo', 'Vodafone', 0, 2, 0);

--
-- Triggers `networks`
--
DELIMITER $$
CREATE TRIGGER `er` AFTER INSERT ON `networks`
 FOR EACH ROW begin
 insert into admin_user values('2','ansh','sahni');
 end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `network_comments`
--

CREATE TABLE IF NOT EXISTS `network_comments` (
  `sno` int(11) NOT NULL,
  `network_id` varchar(2) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `likes` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `network_comments`
--

INSERT INTO `network_comments` (`sno`, `network_id`, `comment`, `email_id`, `likes`) VALUES
(8, 'ar', 'awesome network awesome networkawesome networkawesome networkawesome networkawesome networkawesome networkawesome networkawesome networkawesome network', 'anshul_sahni@rediffmail.com', 3),
(9, 'bs', 'Bekar Bakwas', 'tigers2007@rediffmail.com', 1),
(10, 'ar', 'MMMMMMUUUUAaaaaaahhhhhhh', 'anshul_sahni@rediffmail.com', 2),
(11, 'ar', 'Ab kya karein jhelna padta h', 'anshul_sahni@rediffmail.com', 2),
(12, 'ar', 'well this one needs some improvement', 'anshul_sahni@rediffmail.com', 1),
(13, 'ar', 'at last work on comments is over', 'anshul_sahni@rediffmail.com', 1),
(16, 'ar', 'anshul is awesome', 'richasahni@gmail.com', 1),
(17, 'ar', 'well this is done now', 'anshul_sahni@rediffmail.com', 0),
(18, 'id', 'one more error solved', 't@t.com', 1),
(19, 'bs', 'shayad ab', 'iamdon@iamdon.in', 0);

--
-- Triggers `network_comments`
--
DELIMITER $$
CREATE TRIGGER `network_comment_add` AFTER INSERT ON `network_comments`
 FOR EACH ROW BEGIN
DECLARE row_count INT(5);
SET row_count=(select count(*) from network_comments
where network_comments.network_id=NEW.network_id);
update networks set no_of_comments=row_count
where networks.network_id=NEW.network_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `network_comment_delete` AFTER DELETE ON `network_comments`
 FOR EACH ROW BEGIN
DECLARE row_count INT(5);
SET row_count=(select count(*) from network_comments
where network_comments.network_id=OLD.network_id);
update networks set no_of_comments=row_count
where networks.network_id=OLD.network_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `network_rating`
--

CREATE TABLE IF NOT EXISTS `network_rating` (
  `sno` int(11) NOT NULL,
  `network_id` varchar(2) NOT NULL,
  `rating` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `network_rating`
--

INSERT INTO `network_rating` (`sno`, `network_id`, `rating`) VALUES
(1, 'ar', 4),
(2, 'ar', 5),
(3, 'ar', 3),
(4, 'ar', 3),
(5, 'ar', 2),
(6, 'ar', 1),
(7, 'bs', 4),
(8, 'bs', 5),
(9, 'vo', 2),
(10, 'vo', 2),
(11, 'vo', 2),
(12, 'vo', 2),
(13, 'vo', 2),
(14, 'vo', 2),
(15, 'vo', 2),
(16, 'vo', 2),
(17, 'vo', 2),
(18, 'vo', 2),
(19, 'vo', 2),
(20, 'vo', 2),
(21, 'vo', 2),
(22, 'vo', 2),
(23, 'vo', 2),
(24, 'vo', 2),
(25, 'vo', 2),
(26, 'vo', 2),
(27, 'vo', 2),
(28, 'vo', 2),
(29, 'vo', 2),
(30, 'vo', 2),
(31, 'vo', 2),
(32, 'vo', 2),
(33, 'vo', 2),
(34, 'vo', 2),
(35, 'vo', 2),
(36, 'vo', 2),
(37, 'vo', 2),
(38, 'vo', 2),
(39, 'vo', 2),
(40, 'vo', 2),
(41, 'vo', 2),
(42, 'vo', 2),
(43, 'vo', 2),
(44, 'vo', 2),
(45, 'vo', 2),
(46, 'vo', 2),
(47, 'vo', 2),
(48, 'vo', 2),
(49, 'vo', 2),
(50, 'vo', 2),
(51, 'vo', 2),
(52, 'vo', 2),
(53, 'vo', 2),
(54, 'vo', 2),
(55, 'vo', 2),
(56, 'vo', 2),
(57, 'vo', 2),
(58, 'vo', 2),
(59, 'vo', 2),
(60, 'vo', 2),
(61, 'vo', 2),
(62, 'vo', 2),
(63, 'vo', 2),
(64, 'vo', 2),
(65, 'vo', 2),
(66, 'vo', 2),
(67, 'vo', 2),
(68, 'vo', 2),
(69, 'vo', 2),
(70, 're', 2),
(71, 'id', 5),
(72, 'vo', 2),
(73, 'ar', 2),
(74, 'ar', 2),
(75, 'ar', 2),
(76, 'ar', 2),
(77, 'ar', 2),
(78, 'ar', 2),
(79, 'ar', 2),
(80, 'ar', 2),
(81, 'ar', 2),
(82, 'ar', 2),
(83, 'ar', 2),
(84, 'ar', 2),
(85, 'ar', 2),
(86, 'ar', 2),
(87, 're', 4),
(88, 're', 4),
(89, 're', 4),
(90, 're', 4),
(91, 're', 4),
(92, 're', 4),
(93, 're', 4),
(94, 're', 4),
(95, 're', 4),
(96, 're', 4),
(97, 're', 4),
(98, 're', 4),
(99, 're', 4),
(100, 're', 4),
(101, 're', 4),
(102, 're', 4),
(103, 're', 4),
(104, 're', 4),
(105, 're', 4),
(106, 're', 4),
(107, 're', 4),
(108, 're', 4),
(109, 're', 4),
(110, 're', 4),
(111, 're', 4),
(112, 're', 4),
(113, 're', 4),
(114, 're', 4),
(115, 're', 4),
(116, 're', 4),
(117, 're', 4),
(118, 're', 4),
(119, 're', 4),
(120, 're', 4),
(121, 're', 4),
(122, 're', 4),
(123, 're', 4),
(124, 're', 4),
(125, 're', 4),
(126, 're', 4),
(127, 're', 4),
(128, 're', 4),
(129, 're', 4),
(130, 're', 4),
(131, 're', 4),
(132, 're', 4),
(133, 're', 4),
(134, 'ar', 1),
(135, 'ar', 1),
(136, 'ar', 2),
(137, 'id', 5),
(138, 'ar', 1),
(139, 'id', 3),
(140, 'ar', 1),
(141, 'td', 1),
(142, 'ar', 3),
(143, 'ar', 3),
(145, 'ar', 3),
(146, 'ar', 3),
(147, 'ar', 3),
(148, 'ar', 3),
(149, 'ar', 3),
(150, 'ar', 3),
(151, 'ar', 3),
(152, 'ar', 3),
(153, 'ar', 3),
(154, 'ar', 3),
(155, 'ar', 3),
(156, 'ar', 3),
(157, 'ar', 3),
(158, 'ar', 3),
(159, 'ar', 3),
(160, 'ar', 3),
(161, 'ar', 3),
(162, 'ar', 3),
(163, 'ar', 3),
(164, 'ar', 3),
(165, 'ar', 3),
(166, 'ar', 3),
(167, 'ar', 3),
(168, 'ar', 3),
(169, 'ar', 3),
(170, 'ar', 3),
(171, 'ar', 3),
(172, 'ar', 3),
(173, 'ar', 3),
(174, 'ar', 3),
(175, 'ar', 3),
(176, 'ar', 3),
(177, 'ar', 3),
(178, 'ar', 3),
(179, 'ar', 3),
(180, 'ar', 3),
(181, 'ar', 3),
(182, 'ar', 3),
(183, 'ar', 3),
(184, 'ar', 3),
(185, 'ar', 3),
(186, 'ar', 3),
(187, 'ar', 3),
(188, 'ar', 3),
(189, 'ar', 3),
(190, 'ar', 3),
(191, 'ar', 3),
(192, 'ar', 3),
(193, 'ar', 3),
(194, 'ar', 3),
(195, 'ar', 3),
(196, 'ar', 3),
(197, 'ar', 3),
(198, 'ar', 3),
(199, 'ar', 3),
(200, 'ar', 3),
(201, 'ar', 3),
(202, 'ar', 3),
(203, 'ar', 3),
(204, 'ar', 3),
(205, 'ar', 3),
(206, 'ar', 3),
(207, 'ar', 3),
(208, 'ar', 3),
(209, 'ar', 3),
(210, 'ar', 3),
(211, 'ar', 3),
(212, 'ar', 3),
(213, 'ar', 3),
(214, 'ar', 3),
(215, 'ar', 3),
(216, 'ar', 3),
(217, 'ar', 3),
(218, 'ar', 3),
(219, 'ar', 3),
(220, 'ar', 3),
(221, 'ar', 3),
(222, 'ar', 3),
(223, 'ar', 3),
(224, 'ar', 3),
(225, 'ar', 3),
(226, 'ar', 3),
(227, 'ar', 3),
(228, 'ar', 3),
(229, 'ar', 3),
(230, 'ar', 3),
(231, 'ar', 3),
(232, 'ar', 3),
(233, 'ar', 3),
(234, 'ar', 3),
(235, 'ar', 3),
(236, 'ar', 3),
(237, 'ar', 3),
(238, 'ar', 3),
(239, 'ar', 3),
(240, 'ar', 3),
(241, 'ar', 3),
(242, 'ar', 3),
(243, 'ar', 3),
(244, 'ar', 3),
(245, 'ar', 3),
(246, 'ar', 3),
(247, 'ar', 3),
(248, 'ar', 3),
(249, 'ar', 3),
(250, 'ar', 3),
(251, 'ar', 3),
(252, 'ar', 3),
(253, 'ar', 3),
(254, 'ar', 3),
(255, 'ar', 3),
(256, 'ar', 3),
(257, 'ar', 3),
(258, 'ar', 3),
(259, 'ar', 3),
(260, 'ar', 3),
(261, 'ar', 3),
(262, 'ar', 3),
(263, 'ar', 3),
(264, 'ar', 3),
(265, 'ar', 3),
(266, 'ar', 3),
(267, 'ar', 3),
(268, 'ar', 3),
(269, 'ar', 3),
(270, 'bs', 5),
(271, 'bs', 5),
(276, 'bs', 5),
(277, 'bs', 5),
(282, 'bs', 5),
(283, 'bs', 5),
(288, 'bs', 5),
(289, 'bs', 5),
(294, 'bs', 5),
(295, 'bs', 5),
(300, 'bs', 5),
(301, 'bs', 5),
(305, 'bs', 5),
(306, 'bs', 5),
(307, 'bs', 5),
(312, 'bs', 5),
(313, 'bs', 5),
(318, 'bs', 5),
(319, 'bs', 5),
(320, 'bs', 5);

--
-- Triggers `network_rating`
--
DELIMITER $$
CREATE TRIGGER `network_rating_add` AFTER INSERT ON `network_rating`
 FOR EACH ROW BEGIN
DECLARE avg_rate FLOAT(5);
set avg_rate=(select avg(network_rating.rating) 
from 
network_rating
where
network_rating.network_id=NEW.network_id);
update networks
set rating=avg_rate 
where 
networks.network_id=NEW.network_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE IF NOT EXISTS `plans` (
  `sno` int(3) NOT NULL,
  `zone_id` varchar(2) NOT NULL,
  `network_id` varchar(2) NOT NULL,
  `plan_cat` varchar(2) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `amt` int(4) NOT NULL,
  `talktime` varchar(25) NOT NULL,
  `data2g` varchar(25) NOT NULL,
  `data3g` varchar(25) NOT NULL,
  `validity` varchar(25) NOT NULL,
  `msgs` varchar(25) NOT NULL,
  `other` varchar(25) NOT NULL,
  `no_of_comments` int(5) NOT NULL,
  `selected` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`sno`, `zone_id`, `network_id`, `plan_cat`, `type`, `amt`, `talktime`, `data2g`, `data3g`, `validity`, `msgs`, `other`, `no_of_comments`, `selected`) VALUES
(2, 'jk', 'ar', '3g', 0, 60, '-', '23 mb', '23 mb', '23 days', '0', '-', 1, 0),
(3, 'pn', 'vo', 'tp', 1, 120, '100', '0', '0', 'Unlimited', '0', 'First 10 min fr', 0, 0),
(5, 'pn', 'bs', 'sm', 0, 20, '-', '-', '-', '1 month', '2000local', '-', 0, 0),
(6, 'pn', 'bs', 'sm', 1, 10, '-', '-', '-', '15 days', '150local/national', '-', 0, 0),
(7, 'pn', 'bs', 'sm', 1, 20, '-', '-', '-', '1 month', '1000local/national', '-', 0, 1),
(8, 'pn', 'ar', 'sp', 1, 120, '20min from 6pm to 6am', '-', '-', '-', '100local', '-', 3, 2),
(9, 'pn', 'ar', 'tp', 1, 50, '45', '45mb', '-', 'unlimited', '-', '-', 1, 2),
(10, 'pn', 'ar', 'sp', 1, 45, '25min', '-', '-', '-', '-', '-', 0, 1),
(11, 'pn', 'ar', 'sp', 1, 450, '45 min', '-', '-', '-', '-', '-', 0, 0),
(12, 'pn', 'ar', '3g', 1, 120, '-', '-', '-', '-', '-', '-', 0, 1),
(13, 'pn', 'bs', 'sm', 1, 50, '-', '-', '-', '-', '-', '-', 0, 0),
(14, 'pn', 'bs', 'sp', 1, 200, '-', '-', '-', '-', '-', '-', 0, 3),
(15, 'pn', 'id', 'sm', 1, 450, '-', '-', '-', '-', '-', '-', 0, 0),
(16, 'pn', 're', 'sm', 1, 120, 'null', '-', '-', '-', '-', '-', 0, 0),
(17, 'pn', 'td', 'tp', 1, 125, '-', '-', '-', '-', '-', '-', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `plan_category`
--

CREATE TABLE IF NOT EXISTS `plan_category` (
  `category_id` varchar(2) NOT NULL,
  `category_name` varchar(15) NOT NULL,
  `no_of_comments` int(5) NOT NULL,
  `selected` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan_category`
--

INSERT INTO `plan_category` (`category_id`, `category_name`, `no_of_comments`, `selected`) VALUES
('2g', '2G Networok', 2, 9),
('3g', '3G Network', 5, 9),
('ms', 'MMS', 0, 6),
('sm', 'SMS', 2, 7),
('sp', 'Special', 0, 9),
('tp', 'Topup', 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `plan_cat_comments`
--

CREATE TABLE IF NOT EXISTS `plan_cat_comments` (
  `sno` int(11) NOT NULL,
  `category_id` varchar(2) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan_cat_comments`
--

INSERT INTO `plan_cat_comments` (`sno`, `category_id`, `comment`, `email_id`, `likes`) VALUES
(6, '2g', 'bekar', 'anshulsahni45@gmail.com', 1),
(7, '3g', 'awesom', 'anshulsahni45@gmail.com', 0),
(8, '2g', 'bekar', 'anshulsahni45@gmail.com', 1),
(9, '3g', 'awesom', 'anshulsahni45@gmail.com', 0),
(10, 'sm', ':P :P ', 'anshul_sahni@rediffmail.com', 0),
(11, '3g', 'Ab kya karein jhelna padta h Ab kya karein jhelna padta hAb kya karein jhelna padta hAb kya karein jhelna padta hAb kya karein jhelna padta h', 'harshi_sony@rediffmail.com', 1),
(12, '3g', 'here comes the king', 'anshul_sahni@rediffmail.com', 0),
(13, 'sm', 'well this one is going with awesome speed', 'anshul_sahni@rediffmail.com', 1),
(14, '3g', 'errors removed', 'a@a.com', 0);

--
-- Triggers `plan_cat_comments`
--
DELIMITER $$
CREATE TRIGGER `plan_cat_comment_add` AFTER INSERT ON `plan_cat_comments`
 FOR EACH ROW BEGIN
DECLARE row_count INT(5);
SET row_count=(select count(*) from plan_cat_comments
where plan_cat_comments.category_id=NEW.category_id);
update plan_category set no_of_comments=row_count
where plan_category.category_id=NEW.category_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `plan_cat_comment_delete` AFTER DELETE ON `plan_cat_comments`
 FOR EACH ROW BEGIN
DECLARE row_count INT(5);
SET row_count=(select count(*) from plan_cat_comments
where plan_cat_comments.category_id=OLD.category_id);
update plan_category set no_of_comments=row_count
where plan_category.category_id=OLD.category_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `plan_comments`
--

CREATE TABLE IF NOT EXISTS `plan_comments` (
  `sno` int(11) NOT NULL,
  `plan_id` int(3) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `likes` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan_comments`
--

INSERT INTO `plan_comments` (`sno`, `plan_id`, `comment`, `email_id`, `likes`) VALUES
(1, 8, 'awesome network awesome networkawesome networkawesome networkawesome networkawesome networkawesome networkawesome networkawesome networkawesome network', 'tigers2007@rediffmail.com', 0),
(2, 8, 'zabardast', 'anshulsahni45@gmail.com', 0),
(3, 2, 'areee', 'anshul_sahni@rediffmail.com', 0),
(4, 8, 'i am the boss', 'shan@gmail.com', 0),
(5, 9, 'I am the boss', 'shan@gmail.com', 0);

--
-- Triggers `plan_comments`
--
DELIMITER $$
CREATE TRIGGER `plan_comments_add` AFTER INSERT ON `plan_comments`
 FOR EACH ROW BEGIN
DECLARE row_count INT(5);
SET row_count=(Select count(*) from plan_comments
where plan_comments.plan_id=NEW.plan_id);
update plans set no_of_comments=row_count
where plans.sno=NEW.plan_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `plan_comments_delete` AFTER DELETE ON `plan_comments`
 FOR EACH ROW BEGIN
DECLARE row_count INT(5);
SET row_count=(Select count(*) from plan_comments
where plan_comments.plan_id=OLD.plan_id);
update plans set no_of_comments=row_count
where plans.sno=OLD.plan_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE IF NOT EXISTS `zones` (
  `zone_id` varchar(2) NOT NULL,
  `zone_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`zone_id`, `zone_name`) VALUES
('ap', 'Andhra/Telangana'),
('as', 'Aasam'),
('bh', 'Bihar/Jharkhand'),
('ch', 'Chattisgarh'),
('in', 'India'),
('jk', 'Jammu '),
('kl', 'Kerala'),
('mh', 'Maharashtra/Goa'),
('mp', 'Madhya Pradesh'),
('ne', 'Other North Eastern'),
('pn', 'Punjab/Haryana'),
('rj', 'Rajasthan'),
('up', 'UP/Uttarakhand'),
('wb', 'Bengal/Orissa');

-- --------------------------------------------------------

--
-- Table structure for table `zone_network`
--

CREATE TABLE IF NOT EXISTS `zone_network` (
  `id` int(3) NOT NULL,
  `network_id` varchar(2) DEFAULT NULL,
  `zone_id` varchar(2) DEFAULT NULL,
  `type_available` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zone_network`
--

INSERT INTO `zone_network` (`id`, `network_id`, `zone_id`, `type_available`) VALUES
(108, 're', 'jk', 2),
(142, 'bs', 'ap', 2),
(162, 'ar', 'ap', 2),
(173, 'id', 'jk', 1),
(183, 'vo', 'pn', 1),
(188, 'id', 'ap', 2),
(343, 'bs', 'jk', 0),
(373, 'ar', 'jk', 0),
(438, 'td', 'wb', 2),
(585, 'bs', 'ne', 2),
(623, 'ar', 'bh', 1),
(642, 'td', 'jk', 0),
(690, 'bs', 'pn', 2),
(790, 're', 'pn', 1),
(886, 'bs', 'bh', 2),
(917, 'ar', 'pn', 1),
(924, 'td', 'pn', 2),
(942, 'id', 'pn', 2),
(977, 'bs', 'as', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `email_id` (`email_id`);

--
-- Indexes for table `networks`
--
ALTER TABLE `networks`
  ADD PRIMARY KEY (`network_id`);

--
-- Indexes for table `network_comments`
--
ALTER TABLE `network_comments`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `network_id` (`network_id`),
  ADD KEY `email_id` (`email_id`);

--
-- Indexes for table `network_rating`
--
ALTER TABLE `network_rating`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `network_id` (`network_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `zone_id` (`zone_id`),
  ADD KEY `network_id` (`network_id`),
  ADD KEY `plan_cat` (`plan_cat`);

--
-- Indexes for table `plan_category`
--
ALTER TABLE `plan_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `plan_cat_comments`
--
ALTER TABLE `plan_cat_comments`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `email` (`email_id`);

--
-- Indexes for table `plan_comments`
--
ALTER TABLE `plan_comments`
  ADD PRIMARY KEY (`sno`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `email` (`email_id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`zone_id`);

--
-- Indexes for table `zone_network`
--
ALTER TABLE `zone_network`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `network_id` (`network_id`),
  ADD KEY `zone_id` (`zone_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `network_comments`
--
ALTER TABLE `network_comments`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `network_rating`
--
ALTER TABLE `network_rating`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=321;
--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `sno` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `plan_cat_comments`
--
ALTER TABLE `plan_cat_comments`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `plan_comments`
--
ALTER TABLE `plan_comments`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`email_id`) REFERENCES `emails` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `network_comments`
--
ALTER TABLE `network_comments`
  ADD CONSTRAINT `network_comments_ibfk_1` FOREIGN KEY (`network_id`) REFERENCES `networks` (`network_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `network_comments_ibfk_2` FOREIGN KEY (`email_id`) REFERENCES `emails` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `network_rating`
--
ALTER TABLE `network_rating`
  ADD CONSTRAINT `network_rating_ibfk_1` FOREIGN KEY (`network_id`) REFERENCES `networks` (`network_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_ibfk_3` FOREIGN KEY (`zone_id`) REFERENCES `zone_network` (`zone_id`),
  ADD CONSTRAINT `plans_ibfk_4` FOREIGN KEY (`network_id`) REFERENCES `zone_network` (`network_id`),
  ADD CONSTRAINT `plans_ibfk_6` FOREIGN KEY (`plan_cat`) REFERENCES `plan_category` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `plan_cat_comments`
--
ALTER TABLE `plan_cat_comments`
  ADD CONSTRAINT `plan_cat_comments_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `plan_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_cat_comments_ibfk_2` FOREIGN KEY (`email_id`) REFERENCES `emails` (`email`);

--
-- Constraints for table `plan_comments`
--
ALTER TABLE `plan_comments`
  ADD CONSTRAINT `plan_comments_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`sno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_comments_ibfk_2` FOREIGN KEY (`email_id`) REFERENCES `emails` (`email`);

--
-- Constraints for table `zone_network`
--
ALTER TABLE `zone_network`
  ADD CONSTRAINT `zone_network_ibfk_1` FOREIGN KEY (`network_id`) REFERENCES `networks` (`network_id`),
  ADD CONSTRAINT `zone_network_ibfk_2` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`zone_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

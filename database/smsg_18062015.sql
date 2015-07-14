-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2015 at 02:26 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smsg`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE IF NOT EXISTS `akses` (
  `id` int(1) NOT NULL,
  `akses` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id`, `akses`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'guest');

-- --------------------------------------------------------

--
-- Table structure for table `akses_menu`
--

CREATE TABLE IF NOT EXISTS `akses_menu` (
  `id_am` int(2) NOT NULL AUTO_INCREMENT,
  `id_akses` int(2) NOT NULL DEFAULT '0',
  `fitur` int(1) NOT NULL,
  `id_m` int(2) NOT NULL,
  PRIMARY KEY (`id_am`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `akses_menu`
--

INSERT INTO `akses_menu` (`id_am`, `id_akses`, `fitur`, `id_m`) VALUES
(1, 1, 6, 1),
(2, 1, 6, 2),
(3, 1, 6, 3),
(4, 1, 6, 4),
(5, 1, 6, 5),
(6, 1, 6, 6),
(7, 1, 6, 7),
(8, 1, 6, 8),
(9, 1, 6, 9),
(10, 2, 6, 1),
(11, 2, 6, 2),
(12, 2, 6, 3),
(13, 2, 6, 4),
(14, 2, 0, 5),
(15, 2, 4, 6),
(16, 2, 4, 7),
(17, 2, 0, 8),
(18, 2, 0, 9),
(19, 3, 2, 1),
(20, 3, 0, 2),
(21, 3, 0, 3),
(22, 3, 0, 4),
(23, 3, 0, 5),
(24, 3, 6, 6),
(25, 3, 0, 7),
(26, 3, 0, 8),
(27, 3, 0, 9),
(28, 1, 6, 10),
(29, 2, 4, 10),
(30, 3, 4, 10),
(31, 1, 6, 11),
(32, 2, 6, 11),
(33, 3, 6, 11),
(34, 1, 6, 12),
(35, 2, 6, 12),
(36, 3, 2, 12),
(37, 1, 6, 13),
(38, 2, 6, 13),
(39, 3, 6, 13),
(40, 1, 6, 14),
(41, 1, 6, 15),
(42, 2, 6, 15),
(43, 3, 6, 15);

-- --------------------------------------------------------

--
-- Table structure for table `daemons`
--

CREATE TABLE IF NOT EXISTS `daemons` (
  `Start` text NOT NULL,
  `Info` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `daemons`
--

INSERT INTO `daemons` (`Start`, `Info`) VALUES
('off', 'gammu');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE IF NOT EXISTS `download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `counter` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`id`, `counter`) VALUES
(1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `draf`
--

CREATE TABLE IF NOT EXISTS `draf` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) NOT NULL,
  `title` varchar(55) NOT NULL,
  `content` varchar(160) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE IF NOT EXISTS `folder` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) NOT NULL,
  `name` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gammu`
--

CREATE TABLE IF NOT EXISTS `gammu` (
  `Version` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gammu`
--

INSERT INTO `gammu` (`Version`) VALUES
(13);

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ReceivingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Text` text NOT NULL,
  `SenderNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RecipientID` text NOT NULL,
  `Processed` enum('false','true') NOT NULL DEFAULT 'false',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`UpdatedInDB`, `ReceivingDateTime`, `Text`, `SenderNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `RecipientID`, `Processed`) VALUES
('2015-05-05 13:04:24', '2015-05-05 13:04:26', '007400650073002000730065007200760065007200200073006D0073002000720075006E006E0069006E00670020006F006E006C0069006E0065', '+628561146168', 'Default_No_Compression', '', '+62816124', -1, 'tes server sms running online', 1, '', 'false'),
('2015-05-05 13:05:00', '2015-05-05 13:05:02', '007400650073002000730065007200760065007200200073006D0073002000720075006E006E0069006E00670020006F006E006C0069006E0065', '+628561146168', 'Default_No_Compression', '', '+62816124', -1, 'tes server sms running online', 2, '', 'false');

--
-- Triggers `inbox`
--
DROP TRIGGER IF EXISTS `inbox_timestamp`;
DELIMITER //
CREATE TRIGGER `inbox_timestamp` BEFORE INSERT ON `inbox`
 FOR EACH ROW BEGIN
    IF NEW.ReceivingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.ReceivingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) NOT NULL,
  `kegiatan` varchar(100) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `user_id`, `kegiatan`, `waktu`) VALUES
(1, 1, 'Login Sukses', '2014-09-11 08:05:17'),
(2, 1, 'User Logout', '2014-09-11 09:39:06'),
(3, 1, 'Login Sukses', '2014-09-11 10:18:16'),
(4, 1, 'Stop Service', '2014-09-11 10:18:28'),
(5, 1, 'User Logout', '2014-09-11 10:18:41'),
(6, 1, 'Login Sukses', '2014-09-12 02:40:43'),
(7, 1, 'Login Sukses', '2014-09-12 09:19:58'),
(8, 1, 'Start Service', '2014-09-12 09:27:12'),
(9, 1, 'Edit Kontak', '2014-09-12 09:59:21'),
(10, 1, 'Edit Kontak', '2014-09-12 09:59:38'),
(11, 1, 'Edit Kontak', '2014-09-12 09:59:45'),
(12, 1, 'Stop Service', '2014-09-12 11:26:58'),
(13, 1, 'Cek Pulsa', '2014-09-12 11:27:16'),
(14, 1, 'Tes Koneksi', '2014-09-12 11:28:43'),
(15, 1, 'Tes Koneksi', '2014-09-12 11:29:01'),
(16, 1, 'User Logout', '2014-09-12 11:30:14'),
(17, 1, 'Login Sukses', '2014-09-14 03:18:47'),
(18, 1, 'Start Service', '2014-09-14 03:29:15'),
(19, 1, 'Stop Service', '2014-09-14 06:00:02'),
(20, 1, 'User Logout', '2014-09-14 06:00:11'),
(21, 1, 'Login Sukses', '2014-09-15 15:12:40'),
(22, 1, 'User Logout', '2014-09-15 15:13:20'),
(23, 1, 'Login Sukses', '2014-09-25 03:51:44'),
(24, 0, 'User Logout', '2014-09-25 03:58:37'),
(25, 1, 'Login Sukses', '2014-10-16 10:06:10'),
(26, 1, 'User Logout', '2014-10-16 10:06:20'),
(27, 1, 'Login Sukses', '2014-10-30 03:34:06'),
(28, 1, 'Login Sukses', '2014-10-30 14:12:19'),
(29, 1, 'User Logout', '2014-10-30 14:13:24'),
(30, 1, 'Login Sukses', '2014-11-06 05:39:23'),
(31, 1, 'Cari Kontak', '2014-11-06 05:41:23'),
(32, 1, 'User Logout', '2014-11-06 05:42:29'),
(33, 1, 'Login Sukses', '2014-11-15 19:43:03'),
(34, 1, 'User Logout', '2014-11-15 19:43:38'),
(35, 1, 'Login Sukses', '2014-11-22 22:47:09'),
(36, 1, 'User Logout', '2014-11-22 22:47:33'),
(37, 2, 'Login Sukses', '2014-11-22 22:47:50'),
(38, 2, 'User Logout', '2014-11-22 22:50:50'),
(39, 0, 'Tambah User', '2014-11-22 22:51:17'),
(40, 4, 'Login Sukses', '2014-11-22 22:51:25'),
(41, 4, 'User Logout', '2014-11-22 22:55:35'),
(42, 2, 'Login Sukses', '2014-11-22 22:55:41'),
(43, 2, 'User Logout', '2014-11-22 22:55:50'),
(44, 4, 'Login Sukses', '2014-11-22 22:55:56'),
(45, 4, 'User Logout', '2014-11-22 23:31:03'),
(46, 1, 'Login Sukses', '2014-11-22 23:31:08'),
(47, 1, 'User Logout', '2014-11-22 23:40:41'),
(50, 0, 'Hapus Log', '2014-11-22 23:41:53'),
(51, 0, 'User Logout', '2014-11-22 23:41:57'),
(52, 1, 'Login Sukses', '2014-12-09 10:07:53'),
(53, 1, 'User Logout', '2014-12-09 10:21:08'),
(54, 1, 'Login Sukses', '2014-12-13 18:53:57'),
(55, 1, 'User Logout', '2014-12-13 18:57:06'),
(56, 1, 'Login Sukses', '2015-01-16 02:04:35'),
(57, 1, 'Login Sukses', '2015-01-18 06:10:12'),
(58, 0, 'Login Gagal', '2015-01-19 01:44:16'),
(59, 1, 'Login Sukses', '2015-01-19 01:44:22'),
(60, 1, 'Login Sukses', '2015-01-30 09:30:26'),
(61, 1, 'User Logout', '2015-01-30 09:33:12'),
(62, 1, 'Login Sukses', '2015-02-21 18:39:43'),
(63, 1, 'Login Sukses', '2015-04-28 13:07:29'),
(64, 1, 'Add Service', '2015-04-28 13:15:47'),
(65, 1, 'Add Service', '2015-04-28 13:16:02'),
(66, 1, 'Stop Service', '2015-04-28 13:16:15'),
(67, 1, 'Uninstall Service', '2015-04-28 13:16:19'),
(68, 1, 'Tes Koneksi', '2015-04-28 13:16:28'),
(69, 1, 'User Logout', '2015-04-28 13:23:10'),
(70, 1, 'Login Sukses', '2015-04-28 13:42:28'),
(71, 1, 'Start Service', '2015-04-28 13:42:41'),
(72, 1, 'Stop Service', '2015-04-28 13:42:49'),
(73, 1, 'Uninstall Service', '2015-04-28 13:44:25'),
(74, 1, 'Login Sukses', '2015-04-29 19:52:48'),
(75, 1, 'Login Sukses', '2015-04-30 13:27:18'),
(76, 1, 'Tes Koneksi', '2015-04-30 13:33:20'),
(77, 1, 'Cek Pulsa', '2015-04-30 13:33:33'),
(78, 1, 'Add Service', '2015-04-30 13:33:57'),
(79, 1, 'Uninstall Service', '2015-04-30 13:34:05'),
(80, 1, 'Stop Service', '2015-04-30 13:34:09'),
(81, 1, 'Uninstall Service', '2015-04-30 13:34:12'),
(82, 1, 'Add Service', '2015-04-30 13:34:15'),
(83, 1, 'Start Service', '2015-04-30 13:34:26'),
(84, 1, 'Hapus Data outbox', '2015-04-30 13:44:02'),
(85, 1, 'Stop Service', '2015-04-30 13:44:40'),
(86, 1, 'Uninstall Service', '2015-04-30 13:44:45'),
(87, 1, 'Login Sukses', '2015-05-05 12:55:07'),
(88, 1, 'Tes Koneksi', '2015-05-05 12:57:04'),
(89, 1, 'Add Service', '2015-05-05 12:57:15'),
(90, 1, 'Start Service', '2015-05-05 12:57:21'),
(91, 1, 'Login Sukses', '2015-05-05 13:29:28'),
(92, 1, 'Stop Service', '2015-05-05 13:29:38'),
(93, 1, 'Uninstall Service', '2015-05-05 13:29:42'),
(94, 1, 'User Logout', '2015-05-05 13:30:01'),
(95, 1, 'Login Sukses', '2015-05-05 13:31:15'),
(96, 1, 'Login Sukses', '2015-06-12 16:03:26'),
(97, 1, 'User Logout', '2015-06-12 16:04:57'),
(98, 1, 'Login Sukses', '2015-06-17 15:03:38'),
(99, 1, 'Login Sukses', '2015-06-17 23:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_m` int(2) NOT NULL AUTO_INCREMENT,
  `menu` varchar(55) NOT NULL,
  PRIMARY KEY (`id_m`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_m`, `menu`) VALUES
(1, 'sms'),
(2, 'draf'),
(3, 'folder'),
(4, 'kontak'),
(5, 'user'),
(6, 'profile'),
(7, 'log'),
(8, 'akses'),
(9, 'gammu'),
(10, 'setting'),
(11, 'home'),
(12, 'kontakGroup'),
(13, 'cari'),
(14, 'notify'),
(15, 'getoutbox');

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE IF NOT EXISTS `notify` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `old_total` int(5) NOT NULL,
  `read` enum('0','1') NOT NULL,
  `user_id` int(4) NOT NULL,
  `internet` enum('online','offline') NOT NULL DEFAULT 'offline',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`id`, `old_total`, `read`, `user_id`, `internet`) VALUES
(1, 2, '1', 1, 'offline'),
(2, 42, '1', 2, 'offline'),
(3, 42, '1', 4, 'offline'),
(4, 42, '1', 0, 'offline');

-- --------------------------------------------------------

--
-- Table structure for table `outbox`
--

CREATE TABLE IF NOT EXISTS `outbox` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendBefore` time NOT NULL DEFAULT '23:59:59',
  `SendAfter` time NOT NULL DEFAULT '00:00:00',
  `Text` text,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MultiPart` enum('false','true') DEFAULT 'false',
  `RelativeValidity` int(11) DEFAULT '-1',
  `SenderID` varchar(255) DEFAULT NULL,
  `SendingTimeOut` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryReport` enum('default','yes','no') DEFAULT 'default',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `outbox_date` (`SendingDateTime`,`SendingTimeOut`),
  KEY `outbox_sender` (`SenderID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=143 ;

--
-- Triggers `outbox`
--
DROP TRIGGER IF EXISTS `outbox_timestamp`;
DELIMITER //
CREATE TRIGGER `outbox_timestamp` BEFORE INSERT ON `outbox`
 FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingTimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.SendingTimeOut = CURRENT_TIMESTAMP();
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `outbox_multipart`
--

CREATE TABLE IF NOT EXISTS `outbox_multipart` (
  `Text` text,
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text,
  `Class` int(11) DEFAULT '-1',
  `TextDecoded` text,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`SequencePosition`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pbk`
--

CREATE TABLE IF NOT EXISTS `pbk` (
  `id_pbk` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(3) NOT NULL DEFAULT '1',
  `user_id` int(4) NOT NULL,
  `name` varchar(55) NOT NULL,
  `number` varchar(15) NOT NULL,
  PRIMARY KEY (`id_pbk`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pbk`
--

INSERT INTO `pbk` (`id_pbk`, `group_id`, `user_id`, `name`, `number`) VALUES
(1, 1, 1, 'admin', '+628561146168'),
(2, 1, 2, 'user', '085612345678'),
(3, 1, 3, 'budi', '085687654321'),
(4, 1, 1, 'lito', '+6285285077044'),
(5, 1, 4, 'iwan', '089630371901'),
(6, 1, 1, '', '+6285693019457');

-- --------------------------------------------------------

--
-- Table structure for table `pbk_groups`
--

CREATE TABLE IF NOT EXISTS `pbk_groups` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) NOT NULL,
  `name` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pbk_groups`
--

INSERT INTO `pbk_groups` (`id`, `user_id`, `name`) VALUES
(1, 1, '-');

-- --------------------------------------------------------

--
-- Table structure for table `phones`
--

CREATE TABLE IF NOT EXISTS `phones` (
  `ID` text NOT NULL,
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Send` enum('yes','no') NOT NULL DEFAULT 'no',
  `Receive` enum('yes','no') NOT NULL DEFAULT 'no',
  `IMEI` varchar(35) NOT NULL,
  `Client` text NOT NULL,
  `Battery` int(11) NOT NULL DEFAULT '-1',
  `Signal` int(11) NOT NULL DEFAULT '-1',
  `Sent` int(11) NOT NULL DEFAULT '0',
  `Received` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IMEI`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phones`
--

INSERT INTO `phones` (`ID`, `UpdatedInDB`, `InsertIntoDB`, `TimeOut`, `Send`, `Receive`, `IMEI`, `Client`, `Battery`, `Signal`, `Sent`, `Received`) VALUES
('', '2015-05-05 13:22:33', '2015-05-05 12:57:31', '2015-05-05 13:22:43', 'yes', 'yes', '351942010551735', 'Gammu 1.33.0, Windows Server 2007, GCC 4.7, MinGW 3.11', 86, 30, 3, 67);

--
-- Triggers `phones`
--
DROP TRIGGER IF EXISTS `phones_timestamp`;
DELIMITER //
CREATE TRIGGER `phones_timestamp` BEFORE INSERT ON `phones`
 FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.TimeOut = '0000-00-00 00:00:00' THEN
        SET NEW.TimeOut = CURRENT_TIMESTAMP();
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `saved_folder`
--

CREATE TABLE IF NOT EXISTS `saved_folder` (
  `id_save` int(4) NOT NULL AUTO_INCREMENT,
  `id_folder` int(4) NOT NULL,
  `id_pesan` int(11) NOT NULL,
  `id_user` int(4) NOT NULL,
  `waktu` datetime NOT NULL,
  `number` varchar(25) NOT NULL,
  `pesan` text NOT NULL,
  `table` varchar(25) NOT NULL,
  PRIMARY KEY (`id_save`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sentitems`
--

CREATE TABLE IF NOT EXISTS `sentitems` (
  `UpdatedInDB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `InsertIntoDB` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SendingDateTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DeliveryDateTime` timestamp NULL DEFAULT NULL,
  `Text` text NOT NULL,
  `DestinationNumber` varchar(20) NOT NULL DEFAULT '',
  `Coding` enum('Default_No_Compression','Unicode_No_Compression','8bit','Default_Compression','Unicode_Compression') NOT NULL DEFAULT 'Default_No_Compression',
  `UDH` text NOT NULL,
  `SMSCNumber` varchar(20) NOT NULL DEFAULT '',
  `Class` int(11) NOT NULL DEFAULT '-1',
  `TextDecoded` text NOT NULL,
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `SenderID` varchar(255) NOT NULL,
  `SequencePosition` int(11) NOT NULL DEFAULT '1',
  `Status` enum('SendingOK','SendingOKNoReport','SendingError','DeliveryOK','DeliveryFailed','DeliveryPending','DeliveryUnknown','Error') NOT NULL DEFAULT 'SendingOK',
  `StatusError` int(11) NOT NULL DEFAULT '-1',
  `TPMR` int(11) NOT NULL DEFAULT '-1',
  `RelativeValidity` int(11) NOT NULL DEFAULT '-1',
  `CreatorID` text NOT NULL,
  PRIMARY KEY (`ID`,`SequencePosition`),
  KEY `sentitems_date` (`DeliveryDateTime`),
  KEY `sentitems_tpmr` (`TPMR`),
  KEY `sentitems_dest` (`DestinationNumber`),
  KEY `sentitems_sender` (`SenderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sentitems`
--

INSERT INTO `sentitems` (`UpdatedInDB`, `InsertIntoDB`, `SendingDateTime`, `DeliveryDateTime`, `Text`, `DestinationNumber`, `Coding`, `UDH`, `SMSCNumber`, `Class`, `TextDecoded`, `ID`, `SenderID`, `SequencePosition`, `Status`, `StatusError`, `TPMR`, `RelativeValidity`, `CreatorID`) VALUES
('2014-09-12 09:51:18', '2014-09-12 09:51:07', '2014-09-12 09:51:18', NULL, '00670061006D006D00750020006F006E006C0069006E0065002E002E002E', '+628561146168', 'Default_No_Compression', '', '+62855000000', -1, 'gammu online...', 125, '', 1, 'SendingOKNoReport', -1, 218, 255, 'Gammu 1.33.0'),
('2014-09-12 09:53:19', '2014-09-12 09:53:13', '2014-09-12 09:53:19', NULL, 'EFEFEFDFEFEFEFEFEFDFEFEF', '+628561146168', 'Default_No_Compression', '', '+62855000000', -1, '', 126, '', 1, 'SendingOKNoReport', -1, 219, 255, ''),
('2014-09-12 09:57:47', '2014-09-12 09:57:14', '2014-09-12 09:57:47', NULL, '007500640061006800200074006F002C0020006B00610062006100720020006200610069006B002C002000740061006400690020006B0075006C00690061006800200074006100700069002000630075006D0061006E002000730061006D0070006100690020007300690061006E006700200064006F0061006E002C0020006D006100730075006B0020006B0065006C00610073002000610070006100200061006A006100200074006F003F', '6285285077044', 'Default_No_Compression', '', '+62855000000', -1, 'udah to, kabar baik, tadi kuliah tapi cuman sampai siang doan, masuk kelas apa aja to?', 127, '', 1, 'SendingOKNoReport', -1, 220, 255, 'Gammu 1.33.0'),
('2014-09-12 10:10:06', '2014-09-12 10:09:50', '2014-09-12 10:10:06', NULL, '00670061002000740065007200620061006E00670020006C00610067006900200073006500700065007200740069006E00790061002C0020006E00670061006D00620069006C00200073006B00730020003100360020006D006100750020006E00670075006C0061006E0067002000740061006B00740075002000620065006E00740072006F006B0020006A0061006400770061006C006E00790061002E', '+6285285077044', 'Default_No_Compression', '', '+62855000000', -1, 'ga terbang lagi sepertinya, ngambil sks 16 mau ngulang taktu bentrok jadwalnya.', 128, '', 1, 'SendingOKNoReport', -1, 221, 255, 'Gammu 1.33.0'),
('2014-09-12 10:20:33', '2014-09-12 10:20:27', '2014-09-12 10:20:33', NULL, '006D00610075002000670061006E007400690020006D0061007400680020006B006500750061006E00670061006E002000640065006E00670061006E0020006D006100740068002000610073007500720061006E00730069002C0020006D006100750020006E006700750072007500730020006B007200730020006C0061006700690020006E0069006800200073006500700065007200740069006E00790061002E', '6285285077044', 'Default_No_Compression', '', '+62855000000', -1, 'mau ganti math keuangan dengan math asuransi, mau ngurus krs lagi nih sepertinya.', 129, '', 1, 'SendingOKNoReport', -1, 222, 255, 'Gammu 1.33.0'),
('2014-09-12 10:27:23', '2014-09-12 10:27:04', '2014-09-12 10:27:23', NULL, '0069007900610020006B0061006E002000730061006C006100680020007300610074007500200064006F0061006E00670020006B0061006C006F0020006700610020006D0061007400680020006B006500750061006E00670061006E0020006D006100740068002000610073007500720061006E00730069002C002000630075006D00610020006D0061007400610020006B0075006C006900610068002000740061006D0062006100680061006E00200064006F0061006E00670020006B006F006B002E', '6285285077044', 'Default_No_Compression', '', '+62855000000', -1, 'iya kan salah satu doang kalo ga math keuangan math asuransi, cuma mata kuliah tambahan doang kok.', 130, '', 1, 'SendingOKNoReport', -1, 223, 255, 'Gammu 1.33.0'),
('2014-09-12 10:34:51', '2014-09-12 10:34:28', '2014-09-12 10:34:51', NULL, '00690079006100200074006F002000730061006D00610020006200750020007300750064006900790061006800200074006100700069002000620075006B0061006E0020006D0061007400680020006B00650075006E00670061006E0020006200750020007300750064006900790061006800200061006E0061006C0069007300610020007200650061006C', '6285285077044', 'Default_No_Compression', '', '+62855000000', -1, 'iya to sama bu sudiyah tapi bukan math keungan bu sudiyah analisa real', 131, '', 1, 'SendingOKNoReport', -1, 224, 255, 'Gammu 1.33.0'),
('2014-09-12 10:38:05', '2014-09-12 10:37:46', '2014-09-12 10:38:05', NULL, '00620061006700750073002000630061006E00740069006B00200074006F00200077006B0077006B00770020003A0050', '6285285077044', 'Default_No_Compression', '', '+62855000000', -1, 'bagus cantik to wkwkw :P', 132, '', 1, 'SendingOKNoReport', -1, 225, 255, 'Gammu 1.33.0'),
('2014-09-12 10:41:56', '2014-09-12 10:41:25', '2014-09-12 10:41:56', NULL, '00730061006D00730020006200750020007A00650069006E0079007400610020006B0061006C006F002000670061002000730061006C006100680020006B0065006D006100720065006E0020006700610020006D006100730075006B00200064006F00730065006E006E007900610020006A006100640069002000620065006C0075006D002000620065006C0061006A00610072002000670077002E', '6285285077044', 'Default_No_Compression', '', '+62855000000', -1, 'sams bu zeinyta kalo ga salah kemaren ga masuk dosennya jadi belum belajar gw.', 133, '', 1, 'SendingOKNoReport', -1, 226, 255, 'Gammu 1.33.0'),
('2014-09-12 10:45:06', '2014-09-12 10:44:55', '2014-09-12 10:45:06', NULL, '0067006100200074006100750020007500640061006800200064006900740075006C006900730069006E0020006B00720073006E007900610020006A00610064006900200069006B007500740020006B0065006C0061007300200041002000730065006D00750061002C002000740069006E006700670061006C0020006D0061007400680020006B006500750061006E00670061006E00200064006F0061006E00670020006D0061007500200072006500760069007300690020006E0069006800200063006F007A0020006D00610075002000670061006E007400690020006D006100740068002000610073007500720061006E00730069', '6285285077044', 'Default_No_Compression', '', '+62855000000', -1, 'ga tau udah ditulisin krsnya jadi ikut kelas A semua, tinggal math keuangan doang mau revisi nih coz mau ganti math asuransi', 134, '', 1, 'SendingError', -1, -1, 255, 'Gammu 1.33.0'),
('2014-09-14 03:32:48', '2014-09-14 03:32:27', '2014-09-14 03:32:48', NULL, '00670061006D006D0075002000720075006E006E0069006E00670020006F006E006C0069006E0065', '+628561146168', 'Default_No_Compression', '', '+62855000000', -1, 'gammu running online', 135, '', 1, 'SendingOKNoReport', -1, 238, 255, 'Gammu 1.33.0'),
('2015-04-30 13:41:32', '2015-04-30 13:34:43', '2015-04-30 13:41:32', NULL, '0074006500730074002000670061006D006D007500200063006F0079', '+628561146168', 'Default_No_Compression', '', '+62855000000', -1, 'test gammu coy', 136, '', 1, 'SendingOKNoReport', -1, 246, 255, 'Gammu 1.33.0'),
('2015-04-30 13:43:22', '2015-04-30 13:43:11', '2015-04-30 13:43:22', NULL, '0061006E00650020006D0061007500200063006F0064002C', '+6285693019457', 'Default_No_Compression', '', '+62855000000', -1, 'ane mau cod,', 137, '', 1, 'SendingOKNoReport', -1, 247, 255, 'Gammu 1.33.0'),
('2015-04-30 13:43:59', '2015-04-30 13:43:11', '2015-04-30 13:43:59', NULL, '0061006E00650020006D0061007500200063006F0064002C', '+6285693019457', 'Default_No_Compression', '', '+62855000000', -1, 'ane mau cod,', 138, '', 1, 'SendingOKNoReport', -1, 248, 255, 'Gammu 1.33.0'),
('2015-05-05 12:58:16', '2015-05-05 12:57:46', '2015-05-05 12:58:16', NULL, '00740068006900730020006900730020006D007900200074007200690061006C', '+628561146168', 'Default_No_Compression', '', '+62855000000', -1, 'this is my trial', 140, '', 1, 'SendingOKNoReport', -1, 5, 255, 'Gammu 1.33.0'),
('2015-05-05 13:04:22', '2015-05-05 13:03:55', '2015-05-05 13:04:22', NULL, '007400650073002000730065007200760065007200200073006D0073002000720075006E006E0069006E00670020006F006E006C0069006E0065', '+628561146168', 'Default_No_Compression', '', '+62855000000', -1, 'tes server sms running online', 141, '', 1, 'SendingOKNoReport', -1, 6, 255, 'Gammu 1.33.0'),
('2015-05-05 13:04:58', '2015-05-05 13:04:45', '2015-05-05 13:04:58', NULL, '007400650073002000730065007200760065007200200073006D0073002000720075006E006E0069006E00670020006F006E006C0069006E0065', '+628561146168', 'Default_No_Compression', '', '+62855000000', -1, 'tes server sms running online', 142, '', 1, 'SendingOKNoReport', -1, 7, 255, 'Gammu 1.33.0');

--
-- Triggers `sentitems`
--
DROP TRIGGER IF EXISTS `sentitems_timestamp`;
DELIMITER //
CREATE TRIGGER `sentitems_timestamp` BEFORE INSERT ON `sentitems`
 FOR EACH ROW BEGIN
    IF NEW.InsertIntoDB = '0000-00-00 00:00:00' THEN
        SET NEW.InsertIntoDB = CURRENT_TIMESTAMP();
    END IF;
    IF NEW.SendingDateTime = '0000-00-00 00:00:00' THEN
        SET NEW.SendingDateTime = CURRENT_TIMESTAMP();
    END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sms_temp`
--

CREATE TABLE IF NOT EXISTS `sms_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(15) NOT NULL,
  `text` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sticker`
--

CREATE TABLE IF NOT EXISTS `sticker` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `page` varchar(55) NOT NULL,
  `isi` text NOT NULL,
  `aktif` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sticker`
--

INSERT INTO `sticker` (`id`, `page`, `isi`, `aktif`) VALUES
(1, 'login', 'SMSG gammu service <span style=''color:green''>ON</span> silahkan daftar / login dan nikmati sms gratis... oke', 'no'),
(2, 'login', 'SMSG gammu service <span style=''color:red''>OFF</span> maaf untuk sementara ini service gammu aktif di jam 10.00 s/d 12.00 wib', 'yes'),
(3, 'index', 'Jika Masih terdapat bug mohon dimaklumi, karena masih dalam pengembangan anda bisa mengirimkan email ke <span style=''color:blue''>uchiheakun@gmail.com</span>', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `user` varchar(55) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_akses` int(1) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `user`, `pass`, `email`, `id_akses`, `waktu`) VALUES
(1, 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@smsg.com', 1, '2014-08-30 17:00:00'),
(2, 'user', 'user', '12dea96fec20593566ab75692c9949596833adc9', 'user@user.com', 2, '2014-09-06 08:02:04'),
(3, 'budi', 'budi', '83161a62f22277c65a6cdb7ebc314f218c376c63', 'budi@gmail.com', 2, '2014-09-11 03:07:08'),
(4, 'iwan', 'iwan', '68fcc569df41e83e465820932dd3c12546fe0fc1', 'iwan@iwan.com', 2, '2014-11-22 22:51:17');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

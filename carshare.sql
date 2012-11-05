-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 05, 2012 at 07:10 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `carshare`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_el` varchar(255) NOT NULL,
  `area_en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `area_el`, `area_en`) VALUES
(1, 'Χανιά', 'Chania'),
(2, 'Ρέθυμνο', 'Rethymno'),
(3, 'Ηράκλειο', 'Heraklion'),
(4, 'Λασίθι', 'Lasithi');

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE IF NOT EXISTS `auth` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `resetcode` varchar(255) COLLATE utf8_bin NOT NULL,
  `cookie_hash` varchar(255) COLLATE utf8_bin NOT NULL,
  `activation_code` varchar(255) COLLATE utf8_bin NOT NULL,
  `activated` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `make` varchar(250) NOT NULL,
  `model` varchar(255) NOT NULL,
  `places` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_el` varchar(255) NOT NULL,
  `city_en` varchar(255) NOT NULL,
  `id_district` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_area` (`id_district`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=198 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_el`, `city_en`, `id_district`) VALUES
(1, '', 'Armenoi', 1),
(2, '', 'Kalyves', 1),
(3, '', 'Kares', 1),
(4, '', 'Machairoi', 1),
(5, '', 'Neo Chorio', 1),
(6, '', 'Ramni', 1),
(7, '', 'Stylos', 1),
(8, '', 'Asi Gonia', 1),
(9, '', 'Fres', 1),
(10, '', 'Melidoni', 1),
(11, '', 'Paidochori', 1),
(12, '', 'Pemonia', 1),
(13, '', 'Tzitzifes', 1),
(14, '', 'Fylaki', 1),
(15, '', 'Georgioupoli', 1),
(16, '', 'Kalamitsi', 1),
(17, '', 'Kastellos', 1),
(18, '', 'Kournas', 1),
(19, '', 'Alikampos', 1),
(20, '', 'Emprosneros', 1),
(21, '', 'Maza', 1),
(22, '', 'Nipos', 1),
(23, '', 'Vafes', 1),
(24, '', 'Vryses', 1),
(25, '', 'Gavalochori', 1),
(26, '', 'Kaina', 1),
(27, '', 'Kalamitsi', 1),
(28, '', 'Kefalas', 1),
(29, '', 'Kokkino Chorio', 1),
(30, '', 'Plaka', 1),
(31, '', 'Sellia', 1),
(32, '', 'Vamos', 1),
(33, '', 'Xirosterni', 1),
(34, '', 'Armenoi', 1),
(35, '', 'Kalyves', 1),
(36, '', 'Kares', 1),
(37, '', 'Machairoi', 1),
(38, '', 'Neo Chorio', 1),
(39, '', 'Ramni', 1),
(40, '', 'Stylos', 1),
(41, '', 'Asi Gonia', 1),
(42, '', 'Fres', 1),
(43, '', 'Melidoni', 1),
(44, '', 'Paidochori', 1),
(45, '', 'Pemonia', 1),
(46, '', 'Tzitzifes', 1),
(47, '', 'Fylaki', 1),
(48, '', 'Georgioupoli', 1),
(49, '', 'Kalamitsi', 1),
(50, '', 'Kastellos', 1),
(51, '', 'Kournas', 1),
(52, '', 'Alikampos', 1),
(53, '', 'Emprosneros', 1),
(54, '', 'Maza', 1),
(55, '', 'Nipos', 1),
(56, '', 'Vafes', 1),
(57, '', 'Vryses', 1),
(58, '', 'Gavalochori', 1),
(59, '', 'Kaina', 1),
(60, '', 'Kalamitsi', 1),
(61, '', 'Kefalas', 1),
(62, '', 'Kokkino Chorio', 1),
(63, '', 'Plaka', 1),
(64, '', 'Sellia', 1),
(65, '', 'Vamos', 1),
(66, '', 'Xirosterni', 1),
(67, '', 'Aroni', 2),
(68, '', 'Chordaki', 2),
(69, '', 'Kounoupidiana', 2),
(70, '', 'Mouzouras', 2),
(71, '', 'Sternes', 2),
(72, '', 'Chania', 2),
(73, '', 'Mournies', 2),
(74, '', 'Nerokouros', 2),
(75, '', 'Drakona', 2),
(76, '', 'Kampoi', 2),
(77, '', 'Kontopoula', 2),
(78, '', 'Malaxa', 2),
(79, '', 'Pappadiana', 2),
(80, '', 'Platyvola', 2),
(81, '', 'Agia Marina', 2),
(82, '', 'Daratsos', 2),
(83, '', 'Galatas', 2),
(84, '', 'Stalos', 2),
(85, '', 'Aptera', 2),
(86, '', 'Souda', 2),
(87, '', 'Tsikalaria', 2),
(88, '', 'Agia', 2),
(89, '', 'Perivolia', 2),
(90, '', 'Theriso', 2),
(91, '', 'Vamvakopoulo', 2),
(92, '', 'Varypetro', 2),
(93, '', 'Gavdos', 3),
(94, '', 'Epanochori', 4),
(95, '', 'Kampanos', 4),
(96, '', 'Rodovani', 4),
(97, '', 'Skafi', 4),
(98, '', 'Sougia', 4),
(99, '', 'Temenia', 4),
(100, '', 'Kakodiki', 4),
(101, '', 'Kandanos', 4),
(102, '', 'Plemeniana', 4),
(103, '', 'Palaiochora', 4),
(104, '', 'Sarakina', 4),
(105, '', 'Sklavopoula', 4),
(106, '', 'Vothiana', 4),
(107, '', 'Voutas', 4),
(108, '', 'Amygdalokefali', 5),
(109, '', 'Elos', 5),
(110, '', 'Kefali', 5),
(111, '', 'Perivolia', 5),
(112, '', 'Strovles', 5),
(113, '', 'Vathi', 5),
(114, '', 'Vlatos', 5),
(115, '', 'Gramvousa', 5),
(116, '', 'Kalathenes', 5),
(117, '', 'Gramvousa', 5),
(118, '', 'Kalathenes', 5),
(119, '', 'Kallergiana', 5),
(120, '', 'Kissamos', 5),
(121, '', 'Koukounara', 5),
(122, '', 'Lousakies', 5),
(123, '', 'Platanos', 5),
(124, '', 'Polyrrinia', 5),
(125, '', 'Sirikari', 5),
(126, '', 'Chairethiana', 5),
(127, '', 'Drapanias', 5),
(128, '', 'Faleliana', 5),
(129, '', 'Kaloudiana', 5),
(130, '', 'Malathyros', 5),
(131, '', 'Pervolakia', 5),
(132, '', 'Potamida', 5),
(133, '', 'Rokka', 5),
(134, '', 'Sasalos', 5),
(135, '', 'Sfakopigadi', 5),
(136, '', 'Topolia', 5),
(137, '', 'Voulgaro', 5),
(138, '', 'Afrata', 6),
(139, '', 'Deliana', 6),
(140, '', 'Drakona', 6),
(141, '', 'Episkopi', 6),
(142, '', 'Glossa', 6),
(143, '', 'Kalydonia', 6),
(144, '', 'Kamisiana', 6),
(145, '', 'Kares', 6),
(146, '', 'Kolymvari', 6),
(147, '', 'Nochia', 6),
(148, '', 'Panethimos', 6),
(149, '', 'Ravdoucha', 6),
(150, '', 'Rodopos', 6),
(151, '', 'Spilia', 6),
(152, '', 'Vasilopoulo', 6),
(153, '', 'Vouves', 6),
(154, '', 'Zympragou', 6),
(155, '', 'Alikianos', 6),
(156, '', 'Fournes', 6),
(157, '', 'Karanos', 6),
(158, '', 'Koufos', 6),
(159, '', 'Lakkoi', 6),
(160, '', 'Meskla', 6),
(161, '', 'Orthouni', 6),
(162, '', 'Prases', 6),
(163, '', 'Psathogiannos', 6),
(164, '', 'Sempronas', 6),
(165, '', 'Skines', 6),
(166, '', 'Vatolakkos', 6),
(167, '', 'Gerani', 6),
(168, '', 'Kontomari', 6),
(169, '', 'Kyparissos', 6),
(170, '', 'Maleme', 6),
(171, '', 'Manoliopoulo', 6),
(172, '', 'Modi', 6),
(173, '', 'Ntere', 6),
(174, '', 'Platanias', 6),
(175, '', 'Sirili', 6),
(176, '', 'Vlacheronitissa', 6),
(177, '', 'Vryses', 6),
(178, '', 'Xamoudochori', 6),
(179, '', 'Zounaki', 6),
(180, '', 'Anoskeli', 6),
(181, '', 'Chrysavgi', 6),
(182, '', 'Kakopetros', 6),
(183, '', 'Neo Chorio', 6),
(184, '', 'Neriana', 6),
(185, '', 'Palaia Roumata', 6),
(186, '', 'Polemarchi', 6),
(187, '', 'Tavronitis', 6),
(188, '', 'Voukolies', 6),
(189, '', 'Agia Roumeli', 7),
(190, '', 'Agios Ioannis', 7),
(191, '', 'Anopoli', 7),
(192, '', 'Asfendos', 7),
(193, '', 'Askyfou', 7),
(194, '', 'Chora Sfakion', 7),
(195, '', 'Impros', 7),
(196, '', 'Patsianos', 7),
(197, '', 'Skaloti', 7);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discrict_el` varchar(255) NOT NULL,
  `district_en` varchar(255) NOT NULL,
  `id_area` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `discrict_el`, `district_en`, `id_area`) VALUES
(1, 'Δήμος Αποκορώνου', 'Apokoronas', 1),
(2, 'Δήμος Χανίων', 'Chania', 1),
(3, 'Δήμος Γαύδου', 'Gavdos', 1),
(4, 'Δήμος Καντάνου-Σελίνου', 'Kantanos-Selino', 1),
(5, 'Δήμος Κισσάμου', 'Kissamos', 1),
(6, 'Δήμος Πλατανιά', 'Platanias', 1),
(7, 'Δήμος Σφακίων', 'Sfakia', 1),
(8, 'Δήμος Αγίου Βασιλείου', 'Agios Vasileios', 2),
(9, 'Δήμος Αμαρίου', 'Amari', 2),
(10, 'Δήμος Ανωγείων', 'Anogeia', 2),
(11, 'Δήμος Μυλοποτάμου', 'Mylopotamos', 2),
(12, 'Δήμος Ρεθύμνης', 'Rethymno', 2),
(13, 'Δήμος Αρχανών-Αστερουσίων', 'Archanes-Asterousia', 3),
(14, 'Δήμος Φαιστού,', 'Faistos"', 3),
(15, 'Δήμος Γόρτυνας', 'Gortyna', 3),
(16, 'Δήμος Ηρακλείου', 'Heraklion', 3),
(17, 'Δήμος Χερσονήσου', 'Hersonissos', 3),
(18, 'Δήμος Μαλεβιζίου', 'Malevizi', 3),
(19, 'Δήμος Μινώα Πεδιάδας', 'Minoa Pediada', 3),
(20, 'Δήμος Βιάννου', 'Viannos', 3),
(21, 'Δήμος Αγίου Νικολάου', 'Agios Nikolaos', 4),
(22, 'Δήμος Ιεράπετρας', 'Ierapetra', 4),
(23, 'Δήμος Οροπεδίου', 'Oropedio Lasithiou', 4),
(24, 'Δήμος Σητείας', 'Siteia', 4);

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE IF NOT EXISTS `invitations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`id`, `name`, `surname`, `email`, `token`) VALUES
(1, 'programmer@limecreative.gr', 'Etxenike', '', '8478c68ac3311fb6f2e6ccc8d2246a5f'),
(2, '0', 'Etxenike', 'programmer@limecreative.gr', '17b9fe85355346049aef95697ecca941'),
(3, '0', 'Etxenike', 'programmer@limecreative.gr', '0155942d0a5cd15c68bf606ce83a829c'),
(4, '0', 'Etxenike', 'programmer@limecreative.gr', 'a9d0f9537aa7a4e5494e71aea3499f8a');

-- --------------------------------------------------------

--
-- Table structure for table `join_areas_cities`
--

CREATE TABLE IF NOT EXISTS `join_areas_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `area_id` (`area_id`,`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `join_trips_users`
--

CREATE TABLE IF NOT EXISTS `join_trips_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trip` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_trip` (`id_trip`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `join_users_auth`
--

CREATE TABLE IF NOT EXISTS `join_users_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trip` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `id_trip`, `id_user`) VALUES
(1, 37, 1),
(2, 37, 1),
(3, 37, 1),
(4, 37, 1),
(5, 37, 1),
(6, 37, 1),
(7, 0, 1),
(8, 0, 1),
(9, 37, 1),
(10, 0, 1),
(11, 0, 1),
(12, 0, 1),
(13, 37, 1),
(14, 37, 1),
(15, 41, 1),
(16, 41, 1),
(17, 0, 1),
(18, 0, 1),
(19, 0, 1),
(20, 0, 1),
(21, 0, 1),
(22, 0, 1),
(23, 59, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE IF NOT EXISTS `trips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `when` datetime NOT NULL,
  `id_driver` int(11) NOT NULL,
  `fromLatLon` varchar(255) NOT NULL,
  `toLatLon` varchar(255) NOT NULL,
  `places` int(1) NOT NULL,
  `luggage` varchar(255) NOT NULL,
  `origin_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `origin_id` (`origin_id`,`destination_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `when`, `id_driver`, `fromLatLon`, `toLatLon`, `places`, `luggage`, `origin_id`, `destination_id`) VALUES
(57, '0000-00-00 00:00:00', 1, '', '', 1, 'small', 67, 68),
(58, '2012-10-30 11:00:00', 1, '', '', 1, 'small', 1, 72),
(59, '2012-11-01 09:00:00', 1, '', '', 1, 'small', 72, 1),
(60, '2012-10-31 11:15:00', 1, '', '', 1, 'small', 34, 68);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `activation_code` varchar(10) NOT NULL,
  `activated` tinyint(4) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `language` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `surname`, `username`, `email`, `password`, `activation_code`, `activated`, `picture`, `status`, `language`) VALUES
(1, 'Juan', 'Etxenike', 'xare', 'xaresd@gmail.com', '207be7d0953cd99aa1f40f4056ad4cf7c791945c', '', 0, 'xare.jpg', 'admin', ''),
(2, 'Name', 'Surname', 'user1', 'xaresd@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '', 1, 'user.jpg', 'ative', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

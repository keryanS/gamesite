--------------------------
-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Sam 21 Décembre 2013 à 18:06
-- Version du serveur: 5.5.8
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usr` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `regIP` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usr` (`usr`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `usr`, `pass`, `email`, `nom`, `prenom`, `regIP`, `dt`) VALUES
(1, 'dadaer', '60f092d91bc76474e57b140b7fba56ab', 'keryan.sanie@gmail.com', '', '', '127.0.0.1', '0000-00-00 00:00:00'),
(2, 'keryan', '6de64b96053082a1d071911772f43e13', 'keryan007@free.fr', '', '', '127.0.0.1', '2013-12-10 17:58:51'),
(3, 'caca', '1619e8722b54c01ab49e31afea39bcb6', 'sdgsdg@sdfg.df', '', '', '127.0.0.1', '2013-12-10 18:04:50'),
(12, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.fr', 'keryan', 'sanie', '127.0.0.1', '2013-12-17 00:00:00'),
(7, 'dadader', '5212ffaced9809ac1d54f421b1920e20', 'keryan007@zfqsdf.fr', '', '', '127.0.0.1', '2013-12-14 14:25:16'),
(8, 'keryan000', 'f23320e14bb7cf4525c4f3d25b813c5d', 'keryan000@gmail.com', '', '', '127.0.0.1', '2013-12-14 14:31:56'),
(9, 'azertyuiop', '19aeba63ffeecfe1acbba970d2de6efc', 'azertyuiop@zertyui.fgh', '', '', '127.0.0.1', '2013-12-14 14:33:10'),
(10, 'wkpxdjvnwlkvxwlkvjb', '94c0643712d5ca3cecf08a43f38a1ed9', 'jsdhbfgljsdfg@fdsg.fg', 'sgsdgq', 'qgsdgqg', '127.0.0.1', '0000-00-00 00:00:00'),
(11, 'sdgsdgdgdsgpmim', '686c61d85050a2054c8731f43f15fbe3', 'qsfhg@fgdfgd.tgsdgd', 'sdgdsfg', 'sdgsdfgsd', '127.0.0.1', '0000-00-00 00:00:00'),
(13, 'membre', 'ecfe5c5422378a7c57d8c2db4b24caa8', 'membre@qsfsdf.sfd', 'paul', 'Legrand', '127.0.0.1', '0000-00-00 00:00:00');

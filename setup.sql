-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 19. Mai 2014 um 20:07
-- Server Version: 5.5.37-0ubuntu0.12.04.1
-- PHP-Version: 5.3.10-1ubuntu3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `fi12`
--
CREATE DATABASE IF NOT EXISTS `fi12` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fi12`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `arbeiten`
--

CREATE TABLE IF NOT EXISTS `arbeiten` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `typ` varchar(50) NOT NULL,
  `fach` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `info` text NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blackboard`
--

CREATE TABLE IF NOT EXISTS `blackboard` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `confirmed` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `homeworks`
--

CREATE TABLE IF NOT EXISTS `homeworks` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `typ` varchar(50) NOT NULL,
  `fach` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `info` text NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lastupdate`
--

CREATE TABLE IF NOT EXISTS `lastupdate` (
  `typ` varchar(255) NOT NULL,
  `update` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `lastupdate`
--

INSERT INTO `lastupdate` (`typ`, `update`) VALUES
('arbeiten', '2014-05-19 18:00:00'),
('homeworks', '2014-05-19 18:00:00'),
('stunden', '2014-05-19 18:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plan_gr1`
--

CREATE TABLE IF NOT EXISTS `plan_gr1` (
  `ID` int(11) NOT NULL,
  `mon` varchar(255) DEFAULT NULL,
  `tue` varchar(255) DEFAULT NULL,
  `wed` varchar(255) DEFAULT NULL,
  `thu` varchar(255) DEFAULT NULL,
  `fri` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `plan_gr1`
--

INSERT INTO `plan_gr1` (`ID`, `mon`, `tue`, `wed`, `thu`, `fri`) VALUES
(1, 'C#', 'ÖND', 'Netze', 'Projektierung', 'Java'),
(2, 'C#', 'ÖND', 'Netze', 'Projektierung', 'Java'),
(3, 'C#', 'BWG', 'Netze', 'HTML', 'Java'),
(4, 'Deutsch', 'BWG', 'Englisch', 'HTML', 'Deutsch'),
(5, 'Deutsch', 'Sport', NULL, 'Sozialkunde', 'BWG'),
(6, 'Datenbanken', 'Sport', NULL, 'Sozialkunde', 'BWG'),
(7, 'Datenbanken', NULL, NULL, 'Englisch', NULL),
(8, NULL, NULL, NULL, 'BWG', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plan_gr2`
--

CREATE TABLE IF NOT EXISTS `plan_gr2` (
  `ID` int(11) NOT NULL,
  `mon` varchar(255) DEFAULT NULL,
  `tue` varchar(255) DEFAULT NULL,
  `wed` varchar(255) DEFAULT NULL,
  `thu` varchar(255) DEFAULT NULL,
  `fri` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `plan_gr2`
--

INSERT INTO `plan_gr2` (`ID`, `mon`, `tue`, `wed`, `thu`, `fri`) VALUES
(1, NULL, 'ÖND', 'Java', 'HTML', 'Netze'),
(2, NULL, 'ÖND', 'Java', 'HTML', 'Netze'),
(3, NULL, 'BWG', 'Java', 'Projektierung', 'Netze'),
(4, 'Deutsch', 'BWG', 'Englisch', 'Projektierung', 'Deutsch'),
(5, 'Deutsch', 'Sport', 'C#', 'Sozialkunde', 'BWG'),
(6, 'Datenbanken', 'Sport', 'C#', 'Sozialkunde', 'BWG'),
(7, 'Datenbanken', NULL, 'C#', 'Englisch', NULL),
(8, NULL, NULL, NULL, 'BWG', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plan_zeiten`
--

CREATE TABLE IF NOT EXISTS `plan_zeiten` (
  `ID` int(11) NOT NULL,
  `time` varchar(512) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `plan_zeiten`
--

INSERT INTO `plan_zeiten` (`ID`, `time`) VALUES
(1, '07:00 - 07.45'),
(2, '07:55 - 08:40'),
(3, '08:50 - 09:35'),
(4, '09:55 - 10:40'),
(5, '10:50 - 11:35'),
(6, '11:45 - 12:30'),
(7, '13:00 - 13:45'),
(8, '13:55 - 14:40');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stunden`
--

CREATE TABLE IF NOT EXISTS `stunden` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `typ` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `ausfallstunde` varchar(255) NOT NULL,
  `neuestunde` varchar(255) NOT NULL,
  `stunden` varchar(255) NOT NULL,
  `ausfalllehrer` varchar(255) NOT NULL,
  `neuerlehrer` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

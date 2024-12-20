-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 02 sep 2024 om 07:06
-- Serverversie: 8.3.0
-- PHP-versie: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzaria`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellijnen`
--

DROP TABLE IF EXISTS `bestellijnen`;
CREATE TABLE IF NOT EXISTS `bestellijnen` (
  `bestellijnId` int NOT NULL AUTO_INCREMENT,
  `bestelId` int NOT NULL,
  `pizzaId` int NOT NULL,
  `aantal` int NOT NULL,
  `verkoopprijs` float NOT NULL,
  PRIMARY KEY (`bestellijnId`),
  KEY `fk_B_Bestellingen1_idx` (`bestelId`),
  KEY `fk_B_Pizzas1_idx` (`pizzaId`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bestellijnen`
--

INSERT INTO `bestellijnen` (`bestellijnId`, `bestelId`, `pizzaId`, `aantal`, `verkoopprijs`) VALUES
(1, 4, 1, 3, 11),
(2, 4, 2, 4, 13.5),
(3, 4, 4, 5, 13),
(4, 5, 2, 0, 13.5),
(5, 6, 3, 0, 12.5),
(6, 6, 1, 1, 11),
(7, 7, 1, 0, 11),
(8, 7, 4, 1, 13),
(9, 8, 1, 1, 11),
(10, 8, 3, 2, 12.5),
(11, 9, 1, 2, 11),
(12, 9, 2, 1, 13.5),
(13, 10, 1, 2, 11),
(14, 11, 3, 2, 12.5),
(15, 11, 2, 1, 13.5),
(16, 12, 1, 1, 11),
(17, 12, 2, 1, 13.5),
(18, 13, 1, 2, 11);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

DROP TABLE IF EXISTS `bestellingen`;
CREATE TABLE IF NOT EXISTS `bestellingen` (
  `besteId` int NOT NULL AUTO_INCREMENT,
  `klantId` int NOT NULL,
  `bestelMoment` datetime NOT NULL,
  `leverMoment` datetime NOT NULL,
  `extraInfo` varchar(245) DEFAULT NULL,
  PRIMARY KEY (`besteId`),
  KEY `fk_B_Klanten_idx` (`klantId`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`besteId`, `klantId`, `bestelMoment`, `leverMoment`, `extraInfo`) VALUES
(1, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Geen olijven'),
(2, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Geen olijven'),
(3, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Geen olijven'),
(4, 26, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Geen olijven'),
(5, 26, '2024-09-01 09:24:53', '0000-00-00 00:00:00', ''),
(6, 26, '2024-09-01 09:25:40', '2024-09-01 10:00:00', ''),
(7, 26, '2024-09-01 09:31:48', '2024-09-01 10:10:00', ''),
(8, 26, '2024-09-01 09:33:13', '2024-09-01 10:10:00', ''),
(9, 26, '2024-09-01 09:33:48', '2024-09-01 10:10:00', ''),
(10, 29, '2024-09-01 09:57:03', '2024-09-01 10:30:00', ''),
(11, 29, '2024-09-01 10:24:07', '2024-09-01 11:30:00', 'Vegan kaas?'),
(12, 29, '2024-09-01 11:22:24', '2024-09-01 12:00:00', 'geen artistjok'),
(13, 29, '2024-09-01 11:28:02', '2024-09-01 12:00:00', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

DROP TABLE IF EXISTS `klanten`;
CREATE TABLE IF NOT EXISTS `klanten` (
  `klantId` int NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(45) NOT NULL,
  `achternaam` varchar(45) NOT NULL,
  `straatnaam` varchar(45) NOT NULL,
  `huisnummer` varchar(45) NOT NULL,
  `bus` varchar(45) DEFAULT NULL,
  `plaatsId` int NOT NULL,
  `telefoonnummer` varchar(12) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `wachtwoord` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`klantId`),
  KEY `fk_K_Plaatsen1_idx` (`plaatsId`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`klantId`, `voornaam`, `achternaam`, `straatnaam`, `huisnummer`, `bus`, `plaatsId`, `telefoonnummer`, `email`, `wachtwoord`) VALUES
(26, 'Lara', 'Vantichelen', 'Mosstraat', '5', '', 1, '0498/732565', 'LaraV@gmail.com', '$2y$10$duc59CQg0dh2fwwiX.uLOOh3hzEWuOAJTkCob1jUMxOAEj/AfFkre'),
(27, 'Jos', 'Klein09', 'Vlinderstraat', '42', '', 3, '0425/736447', 'joske@k3.be', '$2y$10$rNYOiu3odxqYBjJgz3gxguXOpydz7jVhQhD15iXT4CQkJ2l7WQoNe'),
(28, 'Noa', 'Vantichelen', 'Mosstraat', '5', '', 6, '0498/732565', 'NoaDeKat@huisdier.be', '$2y$10$Wth1TmKucH7.OoHJMGPWJOVG5x8yZYY7JUiy8A6BIXf/UhDuEouBC'),
(29, 'Suzie', 'Bol', 'Mossenstraat', '35', '7', 1, '0471/987241', 'SuzieBol@telenet.be', '$2y$10$JHtj32sV89SvQjCm4XshV.4ZgGx10GSzko5kWxIN1uECT3.bFAkKG');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pizzas`
--

DROP TABLE IF EXISTS `pizzas`;
CREATE TABLE IF NOT EXISTS `pizzas` (
  `pizzaId` int NOT NULL AUTO_INCREMENT,
  `pizzaNaam` varchar(95) NOT NULL,
  `prijs` float NOT NULL,
  PRIMARY KEY (`pizzaId`),
  UNIQUE KEY `pizzaNaam_UNIQUE` (`pizzaNaam`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `pizzas`
--

INSERT INTO `pizzas` (`pizzaId`, `pizzaNaam`, `prijs`) VALUES
(1, 'Margherita', 11),
(2, 'Quatro formaggi', 13.5),
(3, 'Siciliana', 12.5),
(4, 'Ruccola', 13);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `plaatsen`
--

DROP TABLE IF EXISTS `plaatsen`;
CREATE TABLE IF NOT EXISTS `plaatsen` (
  `plaatsId` int NOT NULL AUTO_INCREMENT,
  `postcode` int NOT NULL,
  `plaatsnaam` varchar(45) NOT NULL,
  PRIMARY KEY (`plaatsId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `plaatsen`
--

INSERT INTO `plaatsen` (`plaatsId`, `postcode`, `plaatsnaam`) VALUES
(1, 3520, 'Zonhoven'),
(4, 3530, 'Helechteren'),
(3, 3530, 'Houthalen'),
(5, 3550, 'Heusden'),
(6, 3550, 'Zolder'),
(7, 3582, 'Koersel');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

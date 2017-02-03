-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost:80
-- Generation Time: Feb 03, 2017 at 04:55 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lepetitcoin`
--

-- --------------------------------------------------------

--
-- Table structure for table `lepetitcoin_annonce`
--

CREATE TABLE `lepetitcoin_annonce` (
  `id` int(11) NOT NULL,
  `fk_categorie` int(11) DEFAULT NULL,
  `fk_localite` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `prix` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateparution` datetime NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lepetitcoin_annonce`
--

INSERT INTO `lepetitcoin_annonce` (`id`, `fk_categorie`, `fk_localite`, `titre`, `img`, `description`, `prix`, `user`, `dateparution`, `telephone`, `email`) VALUES
(3, 1, 1, 'Annonce de Paul', '716f85daa8d3e12c050922c1611f8256.jpg', 'TestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest\r\n\r\nTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest \r\n\r\nTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest \r\n\r\nTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest', '7357', 'Paul', '2017-02-03 11:17:47', '0467717357', 'paul.maillard34@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `lepetitcoin_categorie`
--

CREATE TABLE `lepetitcoin_categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lepetitcoin_categorie`
--

INSERT INTO `lepetitcoin_categorie` (`id`, `nom`) VALUES
(1, 'Moto'),
(2, 'Vélo'),
(4, 'Voiture'),
(5, 'Vêtement');

-- --------------------------------------------------------

--
-- Table structure for table `lepetitcoin_demande`
--

CREATE TABLE `lepetitcoin_demande` (
  `id` int(11) NOT NULL,
  `fk_categorie` int(11) DEFAULT NULL,
  `fk_localite` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `estimation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `demandeur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateparution` datetime NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lepetitcoin_demande`
--

INSERT INTO `lepetitcoin_demande` (`id`, `fk_categorie`, `fk_localite`, `titre`, `img`, `description`, `estimation`, `demandeur`, `dateparution`, `telephone`, `email`) VALUES
(3, 1, 1, 'Demande de Paul', '3ae36ae1abb5d337d3f23150c4d40b65.jpg', 'TestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest\r\n\r\nTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest\r\n\r\nTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest\r\n\r\nTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest', '7357', 'Paul', '2017-02-03 15:03:36', '0467717357', 'paul.maillard34@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `lepetitcoin_localite`
--

CREATE TABLE `lepetitcoin_localite` (
  `id` int(11) NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codepostal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lepetitcoin_localite`
--

INSERT INTO `lepetitcoin_localite` (`id`, `ville`, `codepostal`, `pays`, `adresse`) VALUES
(1, 'Lunel', '34400', 'France', '48 Rue Jean-Jacques Rousseau');

-- --------------------------------------------------------

--
-- Table structure for table `lepetitcoin_user`
--

CREATE TABLE `lepetitcoin_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codepostale` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lepetitcoin_user`
--

INSERT INTO `lepetitcoin_user` (`id`, `username`, `prenom`, `nom`, `img`, `telephone`, `codepostale`, `ville`, `password`, `salt`, `roles`, `email`) VALUES
(2, 'admin', '', '', '', '', '', '', 'admin', '', 'a:1:{i:0;s:10:"ROLE_ADMIN";}', ''),
(6, 'Paul', 'Paul', 'Personne', '17705c14a9d3fb412a9165ed05b6ffad.png', '0467714628', '34400', 'Lunel', 'paul', '', 'a:1:{i:0;s:9:"ROLE_USER";}', 'paul.maillard34@gmail.com'),
(12, 'Testicule', 'Test', 'Icule', 'ba7ab2fd633d6882d842f68b52bae714.png', '0467717357', '34400', 'Lunel', 'balls', '', 'a:1:{i:0;s:9:"ROLE_USER";}', 'testicule@bullshit.nut');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lepetitcoin_annonce`
--
ALTER TABLE `lepetitcoin_annonce`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_63BAA9AE282401A4` (`fk_categorie`),
  ADD KEY `IDX_63BAA9AEC7FFA777` (`fk_localite`);

--
-- Indexes for table `lepetitcoin_categorie`
--
ALTER TABLE `lepetitcoin_categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lepetitcoin_demande`
--
ALTER TABLE `lepetitcoin_demande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B37BEDEE282401A4` (`fk_categorie`),
  ADD KEY `IDX_B37BEDEEC7FFA777` (`fk_localite`);

--
-- Indexes for table `lepetitcoin_localite`
--
ALTER TABLE `lepetitcoin_localite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lepetitcoin_user`
--
ALTER TABLE `lepetitcoin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5FC43A8BF85E0677` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lepetitcoin_annonce`
--
ALTER TABLE `lepetitcoin_annonce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lepetitcoin_categorie`
--
ALTER TABLE `lepetitcoin_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lepetitcoin_demande`
--
ALTER TABLE `lepetitcoin_demande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lepetitcoin_localite`
--
ALTER TABLE `lepetitcoin_localite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lepetitcoin_user`
--
ALTER TABLE `lepetitcoin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `lepetitcoin_annonce`
--
ALTER TABLE `lepetitcoin_annonce`
  ADD CONSTRAINT `FK_63BAA9AE282401A4` FOREIGN KEY (`fk_categorie`) REFERENCES `lepetitcoin_categorie` (`id`),
  ADD CONSTRAINT `FK_63BAA9AEC7FFA777` FOREIGN KEY (`fk_localite`) REFERENCES `lepetitcoin_localite` (`id`);

--
-- Constraints for table `lepetitcoin_demande`
--
ALTER TABLE `lepetitcoin_demande`
  ADD CONSTRAINT `FK_B37BEDEE282401A4` FOREIGN KEY (`fk_categorie`) REFERENCES `lepetitcoin_categorie` (`id`),
  ADD CONSTRAINT `FK_B37BEDEEC7FFA777` FOREIGN KEY (`fk_localite`) REFERENCES `lepetitcoin_localite` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

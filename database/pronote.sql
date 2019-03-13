-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 18 Février 2019 à 14:21
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `pronote`
--
CREATE DATABASE IF NOT EXISTS `pronote` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `pronote`;

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

CREATE TABLE IF NOT EXISTS `absence` (
  `id_abs` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(10) unsigned NOT NULL,
  `date_abs` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_abs`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `absence`
--

INSERT INTO `absence` (`id_abs`, `id_utilisateur`, `date_abs`) VALUES
(1, 1, '2019-02-17');

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE IF NOT EXISTS `classe` (
  `id_classe` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_classe` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_classe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `classe`
--

INSERT INTO `classe` (`id_classe`, `nom_classe`) VALUES
(1, 'BTS SIO SLAM'),
(2, 'BTS SIO SISR');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE IF NOT EXISTS `cours` (
  `id_cours` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_classe` int(10) unsigned NOT NULL,
  `id_profs` int(10) unsigned NOT NULL,
  `titre` varchar(30) COLLATE utf8_bin NOT NULL,
  `texte` text COLLATE utf8_bin NOT NULL,
  `date_cours` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_cours`),
  KEY `id_classe` (`id_classe`),
  KEY `id_profs` (`id_profs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`id_cours`, `id_classe`, `id_profs`, `titre`, `texte`, `date_cours`) VALUES
(3, 2, 2, 'Math 1', '1+1=5611564654564', '2019-02-17');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE IF NOT EXISTS `matiere` (
  `id_matiere` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_matiere` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_matiere`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `matiere`
--

INSERT INTO `matiere` (`id_matiere`, `nom_matiere`) VALUES
(1, 'mathematique'),
(2, 'français');

-- --------------------------------------------------------

--
-- Structure de la table `retard`
--

CREATE TABLE IF NOT EXISTS `retard` (
  `id_retard` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(10) unsigned NOT NULL,
  `date_ret` varchar(10) COLLATE utf8_bin NOT NULL,
  `h_ret` varchar(5) COLLATE utf8_bin NOT NULL,
  `arr_ret` varchar(5) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_retard`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Contenu de la table `retard`
--

INSERT INTO `retard` (`id_retard`, `id_utilisateur`, `date_ret`, `h_ret`, `arr_ret`) VALUES
(1, 1, '2019-02-13', '10+10', '10+10');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(30) COLLATE utf8_bin NOT NULL,
  `id_matiere` int(10) unsigned DEFAULT NULL,
  `poste` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'ETU',
  `classe` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `id_matiere` (`id_matiere`),
  KEY `id_poste` (`poste`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `prenom`, `email`, `mdp`, `id_matiere`, `poste`, `classe`) VALUES
(1, 'Louis', 'Moulin', 'etu@etu', 'etu', NULL, 'ETU', 1),
(2, 'William', 'Mairie', 'pro@pro', 'pro', 1, 'PRO', 2),
(3, 'Fiza', 'Locha', 'dir@dir', 'dir', NULL, 'DIR', NULL),
(4, 'DaFonseca', 'Damien', 'd.damz@damz.fr', 'damz', NULL, 'ETU', 1),
(5, 'Starf', 'Sava', 'sava@sava', 'sava', NULL, 'ETU', 2),
(6, 'Trump', 'Laba', 'trump@usa.fr', 'warn', NULL, 'DIR', NULL),
(7, 'Loudo', 'Arjo', 'arjo@anto', 'ici', NULL, 'ETU', 2),
(8, 'Thomas', 'Pola', 'toto@pola', 'laba', NULL, 'DIR', NULL),
(9, 'John', 'Franck', 'john@franck', 'vers', NULL, 'PRO', 1);



--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `absence_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

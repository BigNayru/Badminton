-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 29 Octobre 2021 à 08:38
-- Version du serveur :  5.7.9
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `badminton2`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE IF NOT EXISTS `adherent` (
  `matriculeAdh` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nomAdh` char(50) CHARACTER SET latin1 NOT NULL,
  `prenomAdh` char(50) CHARACTER SET latin1 NOT NULL,
  `adresseAdh` varchar(100) CHARACTER SET latin1 NOT NULL,
  `villeAdh` char(100) CHARACTER SET latin1 NOT NULL,
  `cpAdh` int(11) NOT NULL,
  `niveauAdh` char(50) CHARACTER SET latin1 NOT NULL,
  `numType` int(11) NOT NULL,
  PRIMARY KEY (`matriculeAdh`),
  KEY `adherent_type_FK` (`numType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `adherent`
--

INSERT INTO `adherent` (`matriculeAdh`, `nomAdh`, `prenomAdh`, `adresseAdh`, `villeAdh`, `cpAdh`, `niveauAdh`, `numType`) VALUES
('E001', 'MARCEAU', 'Sophie', '55 rue Marc Sangnier', 'Chatenay Malabry', 92290, 'Expert', 2),
('E0010', 'MURNEAU', 'Fred', '7 Rue Duvergier', 'Paris', 75019, 'Confirmé', 3),
('E0011', 'WOLFGANG', 'David', '62, Rue Sedaine', 'Paris', 75013, 'Débutant', 1),
('E0012', 'HIGGS', 'Alex', '69 rue du temple', 'Paris', 7505, 'Expert', 2),
('E002', 'DUPIEUX', 'Quentin', '59 rue La Boétie', 'Paris', 75014, 'Expert', 1),
('E004', 'GAUTIER', 'Philip', '122 Faubourg Saint Honoré', 'Paris', 75019, 'Débutant', 1),
('E005', 'VON TRIER', 'Lars', '56 rue des moulineux', 'Arceuil', 94356, 'Débutant', 2),
('E007', 'CHAZELLE', 'Damien', '68 rue Nationale', 'Paris', 75004, 'Débutant', 2),
('E008', 'COPOLLA', 'Sofia', '32 Place de la Madeleine', 'Paris', 75010, 'Confirmé', 1),
('E009', 'NORTON', 'Edward', '98 rue La Boétie', 'Paris', 75016, 'Expert', 3);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `numType` int(11) NOT NULL,
  `libelleType` char(50) CHARACTER SET latin1 NOT NULL,
  `montantLicence` int(11) NOT NULL,
  PRIMARY KEY (`numType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`numType`, `libelleType`, `montantLicence`) VALUES
(1, 'Salarié', 27),
(2, 'Etudiant', 20),
(3, 'Retraité', 23);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD CONSTRAINT `adherent_type_FK` FOREIGN KEY (`numType`) REFERENCES `type` (`numType`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

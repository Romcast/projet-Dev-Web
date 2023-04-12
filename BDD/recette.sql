-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 12 avr. 2023 à 06:50
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `miam`
--

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomrecette` varchar(100) NOT NULL,
  `note` float DEFAULT NULL,
  `cout` float NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `niveau` varchar(50) NOT NULL,
  `lien` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `nomrecette`, `note`, `cout`, `auteur`, `type`, `niveau`, `lien`) VALUES
(8, 'cake fruit', 1, 3, 'moi', 'entree', 'facile', 'home.html'),
(7, 'cake citron', 2, 3, 'moi', 'entree', 'facile', 'home.html');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

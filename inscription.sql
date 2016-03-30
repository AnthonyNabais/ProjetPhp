-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 30 Mars 2016 à 18:14
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `users`
--

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mdp` text NOT NULL,
  `mail` varchar(255) NOT NULL,
  `ddn` datetime NOT NULL,
  `departement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `inscription`
--

INSERT INTO `inscription` (`id`, `nom`, `prenom`, `pseudo`, `mdp`, `mail`, `ddn`, `departement`) VALUES
(2, 'Grandvalet', 'Brice', 'metayoup8', '00d70c561892a94980befd12a400e26aeb4b8599', 'brice@gmail.com', '0000-00-00 00:00:00', 0),
(3, 'Gabril', 'Yann', 'Noob4Ever', '20c9f7a1452ce975e9fa9de9c21cebdd4504834d', 'yann@gmail.com', '0000-00-00 00:00:00', 0),
(4, 'Nabais', 'Anthony', 'WeRZz', '3889256d28d7e1ccc5ad2bd0b87a69fb4ab06aab', 'anthony@gmail.com', '0000-00-00 00:00:00', 0),
(5, 'Grandvalet2', 'Brice2', 'metayoup82', '00d70c561892a94980befd12a400e26aeb4b8599', 'brice2@gmail.com', '2016-03-15 00:00:00', 0),
(6, 'Grandvalet3', 'Brice3', 'metayoup83', '00d70c561892a94980befd12a400e26aeb4b8599', 'brice3@gmail.com', '2016-03-17 00:00:00', 75),
(7, 'Grandvalet4', 'Brice4', 'metayoup84', '00d70c561892a94980befd12a400e26aeb4b8599', 'brice4@gmail.com', '2016-03-04 00:00:00', 56),
(8, 'Grandvalet4', 'Brice4', 'metayoup85', '00d70c561892a94980befd12a400e26aeb4b8599', 'brice5@gmail.com', '2016-03-03 00:00:00', 985);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

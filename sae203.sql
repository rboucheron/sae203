-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 31 mai 2023 à 06:08
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae203`
--

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE `materiel` (
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `reference` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` text,
  `materiel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`name`, `type`, `reference`, `description`, `image`, `materiel_id`) VALUES
('Camera', 'audiovisuel', 38288, 'materiel audiovisuel camera avec trepied', 'camera.jpg', 2),
('Chaise', 'mobilier', 3940, 'Chaise de bureau salle 211', 'download.jpg', 3),
('Fond Vert ', 'audiovisuel', 987654, 'Fond vert pour audiovisuel à utiliser avec camera et éclairage led.', 'fond_vert.jpg', 4),
('Pc gaming', 'hightech', 8751, 'Pc gaming de la marque dell salle 212, 1to disque dure, 64go de ram', 'pcgamingdell.jpg', 5),
('Casque VR', 'hightech', 3333, 'Stockage: 256 Go RAM: 6 Go Processeur: Qualcomm Snapdragon XR2 Chaque casque est accompagné de: 2 manettes Touch', 'casque_vr.jpg', 8);

-- --------------------------------------------------------

--
-- Structure de la table `reserve`
--

CREATE TABLE `reserve` (
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `acquittement` varchar(50) NOT NULL,
  `reserve_id` int(11) NOT NULL,
  `mail` varchar(320) DEFAULT NULL,
  `materiel_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reserve`
--

INSERT INTO `reserve` (`start_date`, `end_date`, `start_time`, `end_time`, `acquittement`, `reserve_id`, `mail`, `materiel_id`) VALUES
('2023-06-01', '2023-06-05', '10:00:00', '11:00:00', 'yes', 23, 'rayanathayoh@gmail.com', 2),
('2023-06-01', '2023-06-01', '08:00:00', '18:00:00', 'no', 24, 'rayanathayoh@gmail.com', 3),
('2023-06-05', '2023-06-05', '09:00:00', '11:50:00', 'wait', 26, 'raphaelboucheron.college@outlook.fr', 5),
('2023-05-31', '2023-06-01', '11:00:00', '13:00:00', 'wait', 27, 'raphaelboucheron.college@outlook.fr', 4);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `mail` varchar(320) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mp` varchar(255) DEFAULT NULL,
  `statu` varchar(50) DEFAULT NULL,
  `naissance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`mail`, `nom`, `prenom`, `mp`, `statu`, `naissance`) VALUES
('raphaelboucheron.college@outlook.fr', 'Boucheron', 'Raphael', '$2y$10$xcqxseHhRc65yX2CgQ/nLOBy0YEXHSDyo/g.LYZ8iT8c8PCKAgPaq', 'admin', '2004-05-12'),
('rayanathayoh@gmail.com', 'Ayohinde', 'Marie', '$2y$10$eSUuOUR8ClbgVMMfzjVt1OhYJLFifK51ce.oMTqPnRkyq0x84K0fa', 'user', '2003-09-21'),
('valentinlamour@gmail.com', 'Lamour', 'Valentin', '$2y$10$YvLJLnQv6OCmM8cjWsJGWeW.fw48fRs6VaTS9iAdW.dWpbaUOLMVW', 'user', '2003-02-11');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`materiel_id`);

--
-- Index pour la table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`reserve_id`),
  ADD KEY `FK_reserve_utilisateur` (`mail`),
  ADD KEY `FK_reserve_materiel` (`materiel_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `materiel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reserve`
--
ALTER TABLE `reserve`
  ADD CONSTRAINT `FK_reserve_materiel` FOREIGN KEY (`materiel_id`) REFERENCES `materiel` (`materiel_id`),
  ADD CONSTRAINT `FK_reserve_utilisateur` FOREIGN KEY (`mail`) REFERENCES `utilisateur` (`mail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

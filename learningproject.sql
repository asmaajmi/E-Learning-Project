-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 05 août 2021 à 17:59
-- Version du serveur :  10.4.19-MariaDB
-- Version de PHP : 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `learningproject`
--

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id` int(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `detail`, `date_debut`, `date_fin`, `etat`) VALUES
(3, 'formation C++', '2021-05-04', '2021-07-04', 0),
(4, 'formation PHP', '2021-05-04', '2021-07-04', 1),
(5, 'formation Javascript', '2021-05-04', '2021-07-04', 0),
(6, 'formation HTML', '2021-05-04', '2021-07-04', 1),
(21, 'formation CSS', '2021-05-04', '2021-07-04', 0),
(25, 'formation SQL', '2021-06-03', '2021-07-03', 1);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id`, `designation`) VALUES
(9, 'Deformation plastiques'),
(3, 'Electronique de puissance'),
(12, 'German'),
(2, 'Informatique'),
(1, 'Mécanique'),
(11, 'Photographie'),
(10, 'Resistance des materiaux'),
(8, 'Science');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `role` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `id_matiere` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `phone`, `gender`, `birthdate`, `role`, `country`, `password`, `degree`, `id_matiere`) VALUES
(17, 'Cristiano', 'Ronaldo', 'CR07@juve.it', '147852369', 'Male', '1995-03-02', 'Director', 'Tunisia', '123456789', NULL, NULL),
(19, 'Aymen', 'Sfaxi', 'Sfa9@ess.tn', '147523602', 'Male', '1996-06-04', 'Student', 'Tunisia', '123456789', '2nd college', NULL),
(20, 'Lionel', 'Messi', 'Leo@barca.esp', '14520369', 'Male', '1980-06-05', 'Teacher', 'Tunisia', '123456789', NULL, 9),
(21, 'Kais', 'Said', 'Za9founa@tunisie.tn', '10203040', 'Male', '1970-12-11', 'Director', 'Tunisia', '123456789', NULL, NULL),
(22, 'Hichem', 'Mechichi', 'Hich25@july.tn', '102234055', 'Male', '1988-07-25', 'Director', 'Tunisia', '123456789', NULL, NULL),
(24, 'Salmen', 'Lazreg', 'Salamlam@gmail.tn', '1023050', 'Male', '2004-04-27', 'Student', 'Tunisia', '123456789', '3rd college', NULL),
(25, 'Mahmoud', 'Makky', 'hamoud@mail.tn', '1020306050', 'Male', '1996-12-06', 'Teacher', 'Sweden', '123456789', NULL, 2),
(26, 'Chayma', 'Aatouani', 'chayma@tunisie.tn', '14052030', 'Female', '1995-04-12', 'Teacher', 'Algeria', '123456789', NULL, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Designation` (`designation`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`email`),
  ADD KEY `fkmat` (`id_matiere`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fkmat` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
